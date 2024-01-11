<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DomainManageController extends Controller
{
    public function checkDomainStatus(Request $request)
    {
        $domain = $request->domain;
        $domains = [];
        $dotPresent = strpos($domain, '.');
        $mainDomain = '';
        if ($dotPresent != false) {
            $textAfterDot = substr($domain, $dotPresent + 1);
            if ($textAfterDot) {
                array_push($domains, ['domain'=>$domain,'ext'=>$textAfterDot]);
                $domainWithoutExtension = substr($domain, 0, $dotPresent);
                $mainDomain = $domainWithoutExtension;
                $createdDomain = $this->makeDomain($domainWithoutExtension, $textAfterDot);
                $domains = [...$domains, ...$createdDomain];

            } else {
                $domain = str_replace('.', '', $domain);
                $mainDomain = $domain;
                $domains = $this->makeDomain($domain);
            }
        } else {
            $mainDomain = $domain;
            $domains = $this->makeDomain($domain);
        }

        $curr = $this->getCurrencies();
        $curr = ((array) json_decode($curr))['currencies'];
        $curr = ((array) $curr)['currency'][1];
        
        // Get pricing 
        $pricing = $this->apiCall(['action' => 'GetTLDPricing','currencyid' => $curr->id]);

        $pricing = (array) (json_decode($pricing))->pricing;
        $response = [];
        // avaialbity
        $convert_price = $curr->code == "BDT" ? 1 : $curr->rate;
        foreach($domains as $key => $domain){
            
            $price ='';
            if (array_key_exists($domain['ext'], $pricing)) {
                $priceData = $pricing[$domain['ext']];
                $price = isset($priceData->register) ? (array) $priceData->register : [];
            } else {
                $price = isset($pricing['com']->register) ? (array) $pricing['com']->register : [];
            }
                        
            $res = json_decode($this->isAvailableDomain($domain['domain']));
            if(($key == 0 ) || ($key > 0 && $res->status == "available")){
                $response[$domain['domain']]['result'] = $res->result;
                $response[$domain['domain']]['status'] = $res->status;
                $response[$domain['domain']]['ext'] = $domain['ext'];
                $response[$domain['domain']]['price'] = (float) $price[1];
                $response[$domain['domain']]['symbol'] = $curr->prefix;
                $response[$domain['domain']]['curr'] = $curr->suffix;
            }
            
        }
        $view = view('landlord.frontend.user.domain-list',compact('response',"mainDomain"))->render();
        return ["status"=>'success','data'=>$view];

    }
    private function apiCall(array $data){
        $apiIdentifier = env('WHMCS_Identifier');
        $apiSecret = env('WHMCS_Secret');
        $apiAccess = env('WHMCS_ACCESSKEY');

        // API endpoint URL
        $apiUrl = 'https://app.multipurc.com/includes/api.php';

        // API request data
        $requestData = [
            'identifier' => $apiIdentifier,
            'accesskey' => $apiAccess,
            'secret' => $apiSecret,
            'responsetype' => 'json',
            ...$data
        ];

        // Initialize cURL session
        $ch = curl_init();

        // Set cURL options
        curl_setopt_array($ch, [
            CURLOPT_URL => $apiUrl,
            CURLOPT_POST => 1,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_SSL_VERIFYPEER => 1,
            CURLOPT_SSL_VERIFYHOST => 2,
            CURLOPT_POSTFIELDS => http_build_query($requestData),
        ]);

        $response = curl_exec($ch);

        curl_close($ch);
        return $response;
    }
    private function isAvailableDomain(string $domain){
        return $this->apiCall(['action' => 'DomainWhois','domain' => $domain]);
    }
    private function getCurrencies(){
        return $this->apiCall(['action' => 'GetCurrencies']);

    }
    private function makeDomain(string $domain, string $ext = ''): array
    {
        $extensions = ['com', 'org', 'net', 'edu', 'xyz', 'io', 'info', 'blog', 'co', 'online', 'live', 'tech', 'shop'];
        $domains = [];
        if ($ext) {
            $extensions = array_filter($extensions, function ($value) use ($ext) {
                return $value != $ext;
            });
        }

        
        foreach ($extensions as $extension) {
            $newDomain = $domain . '.' . $extension;
            array_push($domains, ['domain'=>$newDomain,'ext'=>$extension]);
        }

        return $domains;
    }
}
