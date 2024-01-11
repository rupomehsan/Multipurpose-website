
    <div class="domain-container" style="width: 100%;">
        <h5>Free Domain For you</h5>
        <div class="d-flex justify-content-center">
            <div class="d-flex justify-content-between"
                style="background: white; width: 100%; border-radius: 10px; padding-right: 30px; padding-top: 10px;padding-bottom: 10px;">
                <div class="d-flex justify-content-center align-items-center">
                    <span class="px-2"><i class="fas fa-check-circle"></i></span>
                    <span class="subdomain">{{$mainDomain}}.multipurc.com</span>
                    <input type="hidden" name="subdomain" value="{{ $mainDomain }}.multipurc.com"/>
                </div>
                <div>
                    <button class="create-button" style="padding:10px 15px" type="button">Selected</button>
                </div>
            </div>
        </div>
        <h6>Paid Domain</h6>
        <input type="hidden" name="domain_name" value=""/>
        <input type="hidden" name="price" value=""/>
        <div class="d-flex justify-content-center custom-domain flex-column">
            @php
                $count = 0;
            @endphp
            @foreach($response as $key => $data)
            @php
            if($count++ == 5){
                break;
            }
            @endphp
            <div class="d-flex justify-content-between align-items-center "
                style="background: white; width: 100%; border-radius: 10px; padding-right: 30px; padding-top: 10px;padding-bottom: 10px;margin-bottom:5px;">
                <div class="d-flex justify-content-center align-items-center domain-check-container">
                    <span class="px-2 domain_check_icon" style="visibility: hidden;"><i class="fas fa-check-circle"></i></span>
                    <span class="domain_name">{{$key}}</span>
                </div>
                <div>
                    @if($data['status'] == "available") 
                    <span style="background: #1B434D; color:#fff; padding:5px 10px; border-radius: 30px; font-size:10px"> 30%
                        off </span>
                        @endif
                </div>

                <div><span style="color:#000;font-size: 14px; font-family: Inter; font-weight: 700;">@if($data['status'] == "available") <span>{{$data['symbol']}}</span> <span class="domain_price">{{round($data['price'],2) }}</span>/yr @endif</span>
                </div>
                <div>
                    @if ($data['status'] == "available")
                        <button class="create-button" style="padding:10px 15px" type="button">Select</button>
                        @else
                        <span class="text-danger">Unavailable</span>
                    @endif
                    
                </div>
            </div>
            @endforeach
        </div>
    </div>


<script>
    $('.create-button').click(function(){
        $('.domain_check_icon').css("visibility", "hidden");
      $(this).parent().parent().find('.domain_check_icon').css("visibility", "visible");
        var domain_name = $(this).parent().parent().find('.domain_name').text();
        var price = $(this).parent().parent().find('.domain_price').text();
        $('input[name="domain_name"]').val(domain_name);
        $('input[name="price"]').val(price);
        console.log(domain_name, price);

    })
</script>