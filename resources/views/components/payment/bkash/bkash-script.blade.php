<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>

@php
    $paymentFor = session('bkash_payment_details')['payment_for'];
    $home = $paymentFor == 'tenant' ? 'tenant.frontend.homepage' : 'landlord.homepage';
@endphp
<script type="text/javascript">
    const in_amount = "{{ session('bkash')['invoice_amount'] }}";

    if (!in_amount) {
        window.location.href = "{{ route($home) }}";
    }
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    const spinner = $('#page-overlay');

    function BkashPayment() {

        spinner.show();

        // get token
        $.ajax({
            url: "{{ route($paymentFor . '.bkash-get-token') }}",
            type: 'POST',
            contentType: 'application/json',
            success: function(data) {
                $('pay-with-bkash-button').trigger('click');

                if (data.hasOwnProperty('msg')) {
                    showErrorMessage(data) // show error message
                }
            },
            error: function(err) {
                showErrorMessage(err);
                spinner.hide();
            }
        });
    }


    let paymentID = '';
    bKash.init({
        paymentMode: 'checkout',
        paymentRequest: {},
        createRequest: function(request) {
            setTimeout(function() {
                createPayment(request);
            }, 2000)
        },

        executeRequestOnAuthorization: function(request) {
            $.ajax({
                url: '{{ route($paymentFor . '.bkash-execute-payment') }}',
                type: 'POST',
                contentType: 'application/json',
                data: JSON.stringify({
                    "paymentID": paymentID
                }),
                success: function(data) {
                    if (data) {
                        if (data.paymentID != null) {
                            BkashSuccess(data);
                        } else {
                            showErrorMessage(data);
                            bKash.execute().onError();
                        }
                    } else {
                        $.get('{{ route($paymentFor . '.bkash-query-payment') }}', {
                            payment_info: {
                                payment_id: paymentID
                            }
                        }, function(data) {
                            if (data.transactionStatus === 'Completed') {
                                BkashSuccess(data);
                            } else {
                                createPayment(request);
                            }
                        });
                    }
                },
                error: function(err) {
                    bKash.execute().onError();
                }
            });
        },
        onClose: function() {
            spinner.hide();
            sweetAlert("Payment Cancelled!", "Your payment has been cancelled.", "error");
            const cancel_url =
                "{{ isset(session()->get('bkash')['cancel_url']) ? session()->get('bkash')['cancel_url'] : '' }}"

            window.location.href = cancel_url ? cancel_url : "{{ route($home) }}";

        }
    });

    function createPayment(request) {
        // Amount already checked and verified by the controller
        // because of createRequest function finds amount from this request
        request['amount'] =
            "{{ isset(Session::get('bkash')['invoice_amount']) ? Session::get('bkash')['invoice_amount'] : '' }}"; // max two decimal points allowed
        console.log(request);
        $.ajax({
            url: '{{ route($paymentFor . '.bkash-create-payment') }}',
            data: JSON.stringify(request),
            type: 'POST',
            contentType: 'application/json',
            success: function(data) {
                spinner.hide();

                if (data && data.paymentID != null) {
                    paymentID = data.paymentID;
                    bKash.create().onSuccess(data);
                } else {
                    bKash.create().onError();
                }
            },
            error: function(err) {
                spinner.hide();

                showErrorMessage(err.responseJSON);
                bKash.create().onError();
            }
        });
    }

    function BkashSuccess(data) {
        $.post('{{ route($paymentFor . '.bkash-success') }}', {
            payment_info: data
        }, function(res) {
            spinner.hide();
            sweetAlert("Payment Successful!", "Your payment has been completed successfully.", "success");
            const success_url =
                "{{ isset(session()->get('bkash')['success_url']) ? session()->get('bkash')['success_url'] : '' }}"

            window.location.href = success_url ? success_url : "{{ route($home) }}";
        });
    }

    function showErrorMessage(response) {
        let message = 'Unknown Error';

        if (response.hasOwnProperty('errorMessage')) {
            let errorCode = parseInt(response.errorCode);
            let bkashErrorCode = [2001, 2002, 2003, 2004, 2005, 2006, 2007, 2008, 2009, 2010, 2011, 2012, 2013, 2014,
                2015, 2016, 2017, 2018, 2019, 2020, 2021, 2022, 2023, 2024, 2025, 2026, 2027, 2028, 2029, 2030,
                2031, 2032, 2033, 2034, 2035, 2036, 2037, 2038, 2039, 2040, 2041, 2042, 2043, 2044, 2045, 2046,
                2047, 2048, 2049, 2050, 2051, 2052, 2053, 2054, 2055, 2056, 2057, 2058, 2059, 2060, 2061, 2062,
                2063, 2064, 2065, 2066, 2067, 2068, 2069, 503,
            ];

            if (bkashErrorCode.includes(errorCode)) {
                message = response.errorMessage
            }
        }

        sweetAlert("Payment Failed!", message, "error");
    }
</script>
