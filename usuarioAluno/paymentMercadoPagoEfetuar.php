<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/boot.css">
    <link rel="stylesheet" href="../assets/css/form.css">
    <title>Efetuar pagamento</title>
</head>
<style>
    body{
        background: linear-gradient(to right, #f0f0f0, #ede5c1, #ebdba8);
        background-size: 500% 100%;
    }

    .center_all{
        display: flex;
        justify-content: center;
        align-items: center;

    }

    .container_all{
        width: 100vw;
        height: 100vh;
        flex-direction: column;
    }

    .card_center{
        display: flex;
        width: 50%;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        padding: 30px 35px;
        background-color: #fbfbfb;
        border-radius: 20px;
        box-shadow: 0px 10px 30px rgb(213, 213, 213);
    }

    
    .container_all h1{
        color: rgb(212, 180, 109);
        font-size: 3rem;
        margin-top: 0px;
        display: flex;
        text-align: center;
    }

    .container_all article p{
        color: rgb(212, 180, 109);
        color: black;
        font-size: 1.5em;
        font-weight: 400;
        margin: 0;
    }

    .bt_assinar{
    width: 30%;
    padding: 14px 0px;
    margin: 5px;
    border-radius: 8px;
    outline: none;
    font-size: 1.6em;
    text-transform: uppercase;
    text-align: center;
    font-weight: 800;
    letter-spacing: 3px;
    background-color: rgb(239, 226, 153);
    color: black;
    /* border: 2.3px solid black; */
    cursor: pointer;
    opacity: 0.8;
    box-shadow: 0px 10px 40px -12px rgb(240, 229, 167);
    text-decoration: none;
    list-style: none;
    }

    .bt_prosseguir{
        
        background: linear-gradient(to right, rgb(182, 244, 146), rgb(51, 139, 147));
        width: 30%;
        border: 1.22362px solid #F2F2F2;
        padding: 14px;
        border-radius: 8px;
        color: #fff;
        font-weight: 600;
        font-size: 1.7rem;
        cursor: pointer;
        text-decoration: none;
    }

</style>
<body>
    <header class="main_header">
        <div class="main_header_content">
            <a href="../index.php">
                <img src="../assets/img/logos/logo_borda.png" alt="Olimpo Training" title="Olimpo Training"></a>
                <h4>Olimpo Training</h4>

            <nav class="main_header_content_menu">
                <ul>
                    <li><a href="../views/sele.html">Voltar</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <main class="center_all container_all">
        <h1>Quase lá...</h1><br />
        <article class="card_center">
            <br />
            <p>Efetue a assinatura e comece sua transformação.</p>
            <br />
            <?php if($_GET['assinatura'] == "MENSAL"): ?>
            <a href="https://www.mercadopago.com.br/subscriptions/checkout?preapproval_plan_id=2c9380848bebed8e018bf3e8e3c00639" name="MP-payButton" class='bt_assinar'>Assinar</a>
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
            </script>

            <?php else: ?>

            <a href="https://www.mercadopago.com.br/subscriptions/checkout?preapproval_plan_id=2c9380848bebed70018bf97862ce0a69" name="MP-payButton" class='bt_assinar'>Assinar</a>
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
            </script>

            <?php endif; ?>
            <br />
            <!-- <a href="../index.php?success=Bem vindo! Cadastro realizado." class="bt_prosseguir" id="bt_prosseguir">Prosseguir</a> -->

        </article>

    </main>
</body>
<script>
    //colocar aqui uma condição para se o clicar no assinar aparecer um botão de recirecionamento para finalizaar a assinatura
    let bt_assinar = document.querySelector('.bt_assinar');
    bt_assinar.addEventListener('click', ()=>{

        setTimeout(() => {
            console.log('Sim');
            addBtProsseguir();
        }, 3000);

    });

    function addBtProsseguir(){
        let bt_prosseguir = document.createElement('a');
        bt_prosseguir.href = "../index.php?success=Bem vindo! Cadastro realizado com sucesso.";
        bt_prosseguir.classList.add('bt_prosseguir');
        let bt_prosseguir_content =  document.createTextNode("Prosseguir");
        bt_prosseguir.appendChild(bt_prosseguir_content);

        let card_center = document.querySelector('.card_center');
        card_center.appendChild(bt_prosseguir);
    }

</script>
</html>