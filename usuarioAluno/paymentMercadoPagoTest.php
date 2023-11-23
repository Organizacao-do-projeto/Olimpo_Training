<!-- Botão que redireciona para o pagamento

    <a href="https://www.mercadopago.com.br/subscriptions/checkout?preapproval_plan_id=2c9380848bebed8e018bf3e8e3c00639" name="MP-payButton" class='blue-ar-l-rn-none'>Assinar</a>
<script type="text/javascript">
   (function() {
      function $MPC_load() {
         window.$MPC_loaded !== true && (function() {
         var s = document.createElement("script");
         s.type = "text/javascript";
         s.async = true;
         s.src = document.location.protocol + "//secure.mlstatic.com/mptools/render.js";
         var x = document.getElementsByTagName('script')[0];
         x.parentNode.insertBefore(s, x);
         window.$MPC_loaded = true;
      })();
   }
   window.$MPC_loaded !== true ? (window.attachEvent ? window.attachEvent('onload', $MPC_load) : window.addEventListener('load', $MPC_load, false)) : null;
   })();
  /*
        // to receive event with message when closing modal from congrants back to site
        function $MPC_message(event) {
          // onclose modal ->CALLBACK FUNCTION
         // !!!!!!!!FUNCTION_CALLBACK HERE Received message: {event.data} preapproval_id !!!!!!!!
        }
        window.$MPC_loaded !== true ? (window.addEventListener("message", $MPC_message)) : null; 
        */
</script> -->
<?php

    echo "<br /> <br />";

    //incluindo todas as dependências
    include_once "../src/plugins/Mercado-pago-sdk-php/src/MercadoPago/Net/HttpRequest.php";
    include_once "../src/plugins/Mercado-pago-sdk-php/src/MercadoPago/Net/HttpMethod.php";
    include_once "../src/plugins/Mercado-pago-sdk-php/src/MercadoPago/Net/MPRequest.php";
    include_once "../src/plugins/Mercado-pago-sdk-php/src/MercadoPago/Net/MPResource.php";
    include_once "../src/plugins/Mercado-pago-sdk-php/src/MercadoPago/Net/MPResponse.php";

    include_once "../src/plugins/Mercado-pago-sdk-php/src/MercadoPago/Net/CurlRequest.php";
    include_once "../src/plugins/Mercado-pago-sdk-php/src/MercadoPago/Net/MPHttpClient.php";
    include_once "../src/plugins/Mercado-pago-sdk-php/src/MercadoPago/Net/MPDefaultHttpClient.php";
    include_once "../src/plugins/Mercado-pago-sdk-php/src/MercadoPago/Client/MercadoPagoClient.php";
    include_once "../src/plugins/Mercado-pago-sdk-php/src/MercadoPago/Client/MerchantOrder/MerchantOrderClient.php";
    include_once "../src/plugins/Mercado-pago-sdk-php/src/MercadoPago/Client/Payment/PaymentClient.php";
    include_once "../src/plugins/Mercado-pago-sdk-php/src/MercadoPago/Exceptions/MPApiException.php";
    include_once "../src/plugins/Mercado-pago-sdk-php/src/MercadoPago/MercadoPagoConfig.php";

    use MercadoPago\Client\MerchantOrder\MerchantOrderClient;
    use MercadoPago\Client\Payment\PaymentClient;
    use MercadoPago\Exceptions\MPApiException;
    use MercadoPago\MercadoPagoConfig;

    $access_token = "TEST-2969363013046132-112015-d26c2f78f30ba83e3d893199532700e5-221204540";
    
    //token de acesso de produção ou teste
    MercadoPagoConfig::setAccessToken($access_token);

    // inicialize o client api
    $client = new PaymentClient();

    try{

        

        //crie uma request array
        $request = [
            "transaction_amount" => 100,
            "token" => "9b2d63e00d66a8c721607214cedaecda", /* 9b2d63e00d66a8c721607214cedaecda */
            "description" => "description",
            "installments" => 1,
            "payment_method_id" => "visa",
            "payer" => [
                "email" => "testando@gmail.com",
            ]
        ];

        //faz a requisição
        $payment = $client->create($request);
        echo $client->id;


        //pegando excessão
    }catch (MPApiException $e) {
        echo "Status code: ". $e->getApiResponse()->getStatusCode()."\n";
        echo "<pre>";
        echo "Response: "
        . var_dump($e->getApiResponse()->getContent())."\n";
        echo "</pre>";
        

    }catch(\Exception $e){
        echo $e->getMessage();
    }
    
    // echo "<br /> 
    //     <pre>";
    // var_dump();