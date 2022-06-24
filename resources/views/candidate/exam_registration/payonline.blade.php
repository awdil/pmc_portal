<html>
    <head>
       <title>Pay Online</title>
    </head>
    <body>

        <form name="trans_complete" method="post" action="{{ route('payonline-complete') }}"> <!--complete-->
            @csrf
            <input type="hidden" id="order_id" name="order_id" value="{{ $order_id }}">
            <input type="hidden" id="amount" name="amount" value="{{ $amount }}">
            <input type="hidden" id="resultIndicator" name="resultIndicator" value="">
            <input type="hidden" id="session_id" name="session_id" value="{{ $session_id }}">
            <input type="hidden" id="sessionVersion" name="sessionVersion" value="">
        </form>        
        
        <script src="{{ $site_url }}checkout/version/{{ $api_version }}/checkout.js"
                data-error="errorCallback"
                data-cancel="https://testbill.beaconhouse.net/ism_payment_std.php" 
                data-beforeRedirect="getPageState"
                data-afterRedirect="restorePageState"
                data-complete="completeCallback">
        </script>

        <script type="text/javascript">
            var go_to_payment   = 1;
            function errorCallback(error) {
                  console.log(JSON.stringify(error));
            }
            function cancelCallback() {
                  console.log('Payment cancelled');
            }
            function completeCallback(resultIndicator, sessionVersion){
                go_to_payment = 0;
                document.getElementById('resultIndicator').value = resultIndicator;
                document.getElementById('sessionVersion').value  = sessionVersion;
                //https://wstest.beaconhouse.net/b2bs/index.php/stdinfo
            }
            function getPageState() {               
                return {
                    /* Fill other details */                    
                    orderId : document.getElementById('order_id').value,
                    session_id  : document.getElementById('session_id').value,
                    amount  : document.getElementById('amount').value
                    // key01 : value
                    // key02 : value

                };
            }

            function restorePageState(data) {                
                //alert("orderId: " + data.orderId + "\n amount: " + data.amount) ;                
                document.getElementById('order_id').value = data.orderId;
                document.getElementById('amount').value = data.amount;
                document.getElementById('session_id').value = data.session_id;
                console.log(document.trans_complete);
                document.trans_complete.submit();
                // data.key01
                // data.key02
            }
            Checkout.configure({
                merchant: '{{ $merchant_id }}',
                order: {
                    amount: function() {
                        //Dynamic calculation of amount
                        return document.getElementById('amount').value;
                    },
                    currency: 'PKR',
                    description: 'PMC Exam Registration Fee',
                    id: document.getElementById('order_id').value,
                },
                session :{
                    id : document.getElementById('session_id').value
                },
                interaction: {
                    operation: 'PURCHASE', // set this field to 'PURCHASE' for Hosted Checkout to perform a Pay Operation.
                    merchant: {
                        name: "{{ $merchant }}",
                        address: {
                            line1: 'Beaconhouse',
                            line2: 'Beaconhouse'            
                        }    
                    }
                                                                }
            });
            //console.log(document.trans_complete);
            setTimeout(function(){
                if(go_to_payment)
                    Checkout.showPaymentPage();
            },3000);
            
        </script>

    </body>
    
</html>