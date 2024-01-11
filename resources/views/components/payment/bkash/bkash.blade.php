<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Meta Tag -->
    <title>Secure Checkout - multipurc</title>
    <meta name="title" content="Secure Checkout - multipurc">
    <meta name="description" content="">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- CSS -->
    <link href="{{ url('assets/common/css/tailwindcss.css') }}" rel="stylesheet">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ url('assets/common/css/toastr.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">


    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <link
        href="https://fonts.googleapis.com/css2?family=Baloo+Da+2:wght@400;500;600;700;800&family=Inter:wght@100;200;300;400&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <!-- Custom CSS -->
    <style type="text/css">
        * {
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: linear-gradient(350deg, #f4f9ff, #edf4ffc9), url('assets/img/body.png');
        }

        .font-bangla {
            font-family: 'Baloo Da 2', cursive;
        }
    </style>
</head>

<body class="w-full min-h-screen sm:h-auto sm:p-12 sm:flex sm:items-center sm:justify-center">
    <!-- Overlay Start-->
    <div id="page-overlay" class="visible incoming">
        <div class="loader-wrapper-outer">
            <div class="loader-wrapper-inner">
                <div class="lds-double-ring">
                    <div></div>
                    <div></div>
                    <div>
                        <div></div>
                    </div>
                    <div>
                        <div></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Overlay End -->
    <!-- Full Design -->
    <div
        class="up-container max-w-md overflow-hidden mx-auto p-8 relative sm:bg-white sm:rounded-lg sm:shadow-lg sm:shadow-[#0057d0]/10 sm:min-w-[650px] sm:flex sm:flex-wrap">
        <!-- Nav -->
        <div
            class="w-full h-12 shadow-md shadow-[#0057d0]/5 rounded-lg overflow-hidden flex justify-between items-center p-5 bg-white sm:bg-[#fbfcff]  sm:shadow-none sm:ring-1 sm:ring-[#0057d0]/10">
            <div class="">
                <a href="https://multipurc.com">
                    <svg width="16" viewBox="0 0 17 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M6 18V10H11V18" stroke="#94A9C7" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round"></path>
                        <path
                            d="M1 6.95L8.5 1L16 6.95V16.3C16 16.7509 15.8244 17.1833 15.5118 17.5021C15.1993 17.8209 14.7754 18 14.3333 18H2.66667C2.22464 18 1.80072 17.8209 1.48816 17.5021C1.17559 17.1833 1 16.7509 1 16.3V6.95Z"
                            stroke="#6D7F9A" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                </a>
            </div>
            <div class="flex items-center">

                <form action="{{ session()->get('bkash')['cancel_url'] }}" method="post" accept-charset="utf-8">
                    <input type="hidden" name="invoice_id" value="" />
                    <input type="hidden" name="csrf_rt_66b314f7e4_token" value="48f0473172e05a3b950a3c9608daa409" />
                    <button type="submit">
                        <svg width="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M13 1L1 13" stroke="#94A9C7" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"></path>
                            <path d="M1 1L13 13" stroke="#6D7F9A" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"></path>
                        </svg>
                    </button>
                </form>
            </div>
        </div>
        <!--END Nav -->

        <!-- Profile -->
        <div class="flex flex-col items-center mt-7 mb-6 sm:mb-3 sm:flex-row w-full">
            <div class="mb-4 sm:mr-8">
                <img src="{{ asset('assets/img/logo.png') }}" alt="multipurc"
                    class="w-24 sm:w-[85px] rounded-full overflow-hidden object-cover ring-1 cursor-pointer transition-all duration-300 hover:scale-105">
            </div>
            <div class="flex flex-col items-center sm:items-start">
                <div class="mb-4 sm:mb-3">
                    <h3 class="font-semibold text-xl text-[#6D7F9A]">multipurc</h3>
                </div>

            </div>
        </div>
        <!-- END Profile -->

        <!-- Banking btn-->
        <div class="flex w-full justify-between bg-[#0057d0] text-white overflow-hidden rounded-md">
            <a href="#" data-tab="mobile_banking" id="mobile_banking_btn"
                class="font-bangla up-nav-tab active rounded-md w-[100%] py-1.5 text-center text-[12px] sm:text-[15px] h-full transition-all duration-300 leading-[23px]">Mobile
                Banking</a>
        </div>
        <!-- END Banking btn-->
        <!-- Main Section -->
        <div class="overflow-auto p-0.5 mt-6 w-full pb-7 sm:pb-0">
            <!-- Mobile Banking -->
            <div id="mobile_banking" class="up-tab active">
                <div class="grid grid-cols-2 gap-5 sm:grid-cols-4 pb-6">
                    <!-- bKash -->
                    <button class="bank-img-div" type="button" id="bKash_button" onclick="BkashPayment()">
                        <div
                            class="card-input w-full ring-1 ring-[#0057d0]/10 rounded-md flex justify-center items-center">
                            <img src="https://cpay.multipurc.com/assets/template/images/bkash.png" alt="bKash"
                                class="bank-img">
                        </div>
                    </button>
                </div>
            </div>
            <!-- END Mobile Banking -->



            <!-- Transaction Details -->
            <div id="transactionsSection" class="up-tab">
                <div class="bg-white rounded-lg shadow-md shadow-[#0057d0]/5">
                    <div
                        class="px-5 py-4 sm:py-0 text-center rounded-lg bg-[#e5efff] sm:bg-transparent text-[#0057d0] font-semibold">
                        <h2 class="font-bangla">Transection Details</h2>
                    </div>
                    <ul class="py-4 px-5 sm:mb-5">
                        <li class="flex justify-between text-sm text-[#6D7F9A] sm:text-base font-semibold">
                            <p class="font-bangla">Invoice</p>
                            <p>{{ session('bkash')['payment_details']->name }}</p>
                        </li>
                        <hr class="my-3 sm:my-1.5 border-[#6D7F9A]/10">
                        <li class="flex justify-between text-sm text-[#6D7F9A]">
                            <p class="font-bangla">Amount</p>
                            <p>Pay{{ session()->get('bkash')['invoice_amount'] }} BDT</p>
                        </li>
                        <hr class="my-3 sm:my-1.5 border-[#6D7F9A]/10">
                        <li class="flex justify-between text-sm text-[#6D7F9A]">
                            <p class="font-semibold font-bangla">Pay</p>
                            <p class="font-semibold text-[#0057d0]">{{ session()->get('bkash')['invoice_amount'] }} BDT
                            </p>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- END Transaction Details -->


        </div>
        <!-- END Main Section -->
        <div
            class="w-full fixed rounded-t-2xl backdrop-blur-sm py-[18px] bottom-0 left-0 sm:static sm:rounded-[10px] sm:px-4 sm:py-3.5 text-center bg-[#cde1ff]/80 font-semibold text-[#0057D0]">
            Pay
            {{ session()->get('bkash')['invoice_amount'] }} BDT </div>
    </div>
    <!-- END Full Design -->

    <script src="{{ url('assets/common/js/jquery-3.6.1.min.js') }}"></script>
    <!-- Toastr -->
    <script src="{{ url('assets/common/js/toastr.min.js') }}"></script>
    <!-- Redirect -->
    <script src="{{ url('assets/common/js/jquery.redirect.js') }}"></script>
    <script id="myScript" src="https://scripts.pay.bka.sh/versions/1.2.0-beta/checkout/bKash-checkout.js"></script>
    @include('components.payment.bkash.bkash-script')

    <!-- modal popup script -->
    <script></script>
    <script>
        function Tabs() {
            var bindAll = function() {
                var menuElements = document.querySelectorAll('[data-tab]');
                for (var i = 0; i < menuElements.length; i++) {
                    menuElements[i].addEventListener('click', change, false);
                }
            }

            var clear = function() {
                var menuElements = document.querySelectorAll('[data-tab]');
                for (var i = 0; i < menuElements.length; i++) {
                    menuElements[i].classList.remove('active');
                    var id = menuElements[i].getAttribute('data-tab');
                    document.getElementById(id).classList.remove('active');
                }
            }

            var change = function(e) {
                clear();
                e.target.classList.add('active');
                var id = e.currentTarget.getAttribute('data-tab');
                document.getElementById(id).classList.add('active');
            }

            bindAll();
        }

        var connectTabs = new Tabs();
    </script>
</body>

</html>
