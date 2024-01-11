<?php

namespace Modules\ExternalImport\Http\Controllers;

use DB;
use App\Models\Status;
use Illuminate\Http\Request;
use App\Models\MediaUploader;
use App\Facades\GlobalLanguage;
use Illuminate\Routing\Controller;
use Modules\Product\Entities\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Support\Renderable;
use Modules\Product\Entities\ProductGallery;
use Modules\Product\Http\Services\Admin\AdminProductServices;

class ExternalImportController extends Controller
{

    public function __construct(){
        $this->middleware("auth:admin");
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(): Renderable
    {
        return view('externalimport::admin.index');
    }




    /**
     * Make slug using streing
     * 
     * @param string
     * @return string
     */
    public function makeSlug($string){
      $newString =  str_replace(' ', '-', $string);
      return strtolower($newString);
    }

    /**
       * Store CJ Dropshipping product 
       * 
       * @param array
       */
      public function store_cj_product($request){
        $variants = array();
        try { 
           // single product details from cj dropshipping
           $cjToken = $this->cjaccessToken();
         

           $curl = curl_init();
           curl_setopt_array($curl, array(
           CURLOPT_URL => 'https://developers.cjdropshipping.com/api2.0/v1/product/query?pid=' . $request->pid,
           CURLOPT_RETURNTRANSFER => true,
           CURLOPT_ENCODING => '',
           CURLOPT_MAXREDIRS => 10,
           CURLOPT_TIMEOUT => 0,
           CURLOPT_FOLLOWLOCATION => true,
           CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
           CURLOPT_CUSTOMREQUEST => 'GET',
           CURLOPT_HTTPHEADER => array(
              'Content-Type: application/json',
              'CJ-Access-Token: '.$cjToken.''
           ),
           ));

           $response = curl_exec($curl);

           $err = curl_error($curl);
           curl_close($curl);
           
           $response = json_decode($response);
           
           if ($err) {
              $errorMsg = "cURL Error #:" . $err;
           }else{
              $products = $response->data;
              $variants = $products->variants;
           }           

           $term=new Product;
           $term->name=$request->name;
           $term->slug=$this->makeSlug($request->name);
           $term->product_type = 1;
           $term->status_id=1;
           $term->description = $response->data->description;
           $term->price = $request->price;
           $term->sale_price = $request->price;
         //   $term->is_variation=count($variants) > 0 ? 1 : 0;
           if($response->data->productImageSet && count($response->data->productImageSet) > 0){
               $imgIdes = array();
               $tenant_path = '';
               if(tenant()){
                  $tenant_user = tenant()->user()->first() ?? null;
                  $tenant_path = !is_null($tenant_user) ? tenant()->id.'/' : '';
               }
               $folder_path = 'assets/'. $this->folderPrefix().'/uploads/media-uploader/'.$tenant_path;

               foreach($response->data->productImageSet as $k => $simg){
                  $contents = file_get_contents($simg);
                  $name = substr($simg, strrpos($simg, '/') + 1);
                  $storage = Storage::disk('root_url')->put($folder_path .  $name, $contents, 'private');
                  
                  $imageData = [
                     'title' => $name,
                     'size' => null,
                     'user_type' => 0, //0 == admin 1 == user
                     'path' => $name,
                     'dimensions' => null,
                     'user_id' =>  \Auth::guard('admin')->id(),
                 ];
 
                 $img = MediaUploader::create($imageData);
                 array_push($imgIdes, $img->id);
               }  

               if(count($imgIdes) > 0){
                  $term->image_id = $imgIdes[0];
                  unset($imgIdes[0]);
               }
                
           }
           
           $term->save();            
           $gallery = [];
           foreach($imgIdes as $s => $im){
            $gallery[] = [ 
               "product_id" => $term->id,
               "image_id" => $im
            ];
           }
           ProductGallery::insert($gallery);
               
           
        } 
        catch (\Throwable $th) {
           DB::rollback();   
           $errors['errors']['error']='Opps something wrong';
           return response()->json($errors,401);
        }
     }


   private function folderPrefix(){
      return is_null(tenant()) ? 'landlord' : 'tenant';
   }

    /**
     * Store product to db
     */
    public function store(Request $request){
        if($request->source == 'cj'){
            $this->store_cj_product($request);
            return redirect()->route('externalimport.cjdropshipping'); 
        }else{
            $this->store_aliexpress_product($request);
            return redirect()->route('externalimport.aliexpress'); 
        }
    }


    /**
     * Store ali express product 
     * 
     * @param array
     */
    public function store_aliexpress_product($request){
        $term=new Product;
        $term->name=$request->name;
        $term->slug=$this->makeSlug($request->name);
        $term->product_type = 1;
        $term->status_id=1;
        $term->price = $request->price;
        $term->sale_price = $request->price;
        

        $weight = $request->weight ?? 0;

        //   Product image handle
        $tenant_path = '';
        if(tenant()){
            $tenant_user = tenant()->user()->first() ?? null;
            $tenant_path = !is_null($tenant_user) ? tenant()->id.'/' : '';
        }
        $folder_path = 'assets/'. $this->folderPrefix().'/uploads/media-uploader/'.$tenant_path;
        

        $preview = strpos($request->preview, "https:") ? $request->preview : 'https:' . $request->preview;
        
        $contents = file_get_contents($preview);
        
        
        $name = substr($request->preview, strrpos($request->preview, '/') + 1);
      
        $storage = Storage::disk('root_url')->put($folder_path .  $name, $contents, 'private');
        if($storage){
            $imageData = [
               'title' => $name,
               'size' => null,
               'user_type' => 0, //0 == admin 1 == user
               'path' => $name,
               'dimensions' => null,
               'user_id' =>  \Auth::guard('admin')->id(),
            ];

            $img = MediaUploader::create($imageData);
            $term->image_id = $img->id;
        }
        
        $term->save();
    }


    /**
     * @return accessToken string
    */
    public function cjaccessToken(){
        $curl = curl_init();
  
        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://developers.cjdropshipping.com/api2.0/v1/authentication/getAccessToken',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS =>'{
           "email": "ronymaha@gmail.com",
           "password": "64f4b136b6404fe9ac0adfdda9eaf1cd"
        }',
        CURLOPT_HTTPHEADER => array(
           'Content-Type: application/json'
        ),
        ));
        
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        
        $errorMsg = '';
        $response = json_decode($response);
        if ($err) {
           $errorMsg = "cURL Error #:" . $err;
           $exOption = get_static_option('cj_token');
  
           if($exOption)
              return $exOption;
  
           return false;
        }
        elseif(!$response->success){
           $errorMsg = $response->message;
           $exOption = get_static_option('cj_token');
           if($exOption)
              return $exOption;
  
           return false;
        }
        else {
           $exOption = get_static_option('cj_token');
           if($exOption){
                update_static_option('cj_token', $response->data->accessToken);
                return $response->data->accessToken;
           }
  
           //Save option 
           update_static_option('cj_token', $response->data->accessToken);
  
           return $response->data->accessToken;
        }
       }


    /**
     * CJ Dropshipping callback functions
     */
    public function cj(Request $request){
         $pagesize = 10;
         $pagenum = 1;
         $ex_products = array();
         $returnError = '';
         $products = array();

         try{
            if($request->pagesize)
               $pagesize = $request->pagesize;
      
            if($request->pagenum)
               $pagenum = $request->pagenum;

            $cjToken = $this->cjaccessToken();

            $curl = curl_init();

            curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://developers.cjdropshipping.com/api2.0/v1/product/list?pageSize='.$pagesize.'&pageNum=' . $pagenum,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
               'Content-Type: application/json',
               'CJ-Access-Token: '.$cjToken.''
            ),
            ));

            $response = curl_exec($curl);

            $err = curl_error($curl);
            curl_close($curl);
            
            $response = json_decode($response);
            if ($err) {
               $errorMsg = "cURL Error #:" . $err;
            }else{
               $products = $response->data->list;
            }



            // Existing Product 
            // $ex_products = Product::select('name, slug')->where('termmetas.key', 'source')->where('termmetas.value', 'cj')->get()->toArray();
            // $ex_products = array_map(function($v){
            //    return $v['title'];
            // }, $ex_products);

         }
         catch (\Throwable $th) {
            DB::rollback();
            
            $errors['errors']['error']='Opps something wrong';
            return response()->json($errors,401);
        }
        return view("externalimport::admin.cjdropshipping", compact('products', 'returnError', 'request', 'ex_products'));
   }


   /**
    * Ali express route
    */
   public function aliexpress(Request $request){
      $returnError = '';
      $products = array();
      $src = 'Xiomi';
      $page = 1;
      $ex_products = array();

      try{
         if($request->pagenum)
            $page = $request->pagenum;

         if($request->src)
            $src = $request->src;

         $curl = curl_init();
         curl_setopt_array($curl, [
            CURLOPT_URL => "https://ali-express1.p.rapidapi.com/search?query=".$src."&page=" . $page,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
               "X-RapidAPI-Host: ali-express1.p.rapidapi.com",
               "X-RapidAPI-Key: fbf5b0f92dmsha0084a2fd6ed62fp174202jsnec4740a29c6d"
            ],
         ]);
         
         $response = curl_exec($curl);
         $err = curl_error($curl);
      
         curl_close($curl);
         
         $response = json_decode($response);

         if ($err) {
            $returnError = "cURL Error #:" . $err;
         }
         elseif(!isset($response->data)){
            $returnError = $response->message;
         }
         else {
            $products = $response->data->result->searchResult->mods->itemList->content;
         }
      }
      catch (\Throwable $th) {
            DB::rollback();
            
            $errors['errors']['error']='Opps something wrong';
            return response()->json($errors,401);
      }
      
      return view("externalimport::admin.aliexpress", compact('products', 'returnError', 'request', 'ex_products'));
   }



    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('externalimport::create');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('externalimport::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('externalimport::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
