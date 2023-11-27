<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300;400;500&display=swap" rel="stylesheet">
    <link href="assets/css/boot.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/fonticon.css" rel="stylesheet">
    <link  href="assets/css/modal.css" rel="stylesheet">
    <link href="assets/css/login.css" rel="stylesheet" >
    
    <title>Olimpo Training</title>
</head>
<!-- incluindo sweet alert para aparecer as mensagens -->
<?php include_once __DIR__.'/assets/script/sweetAlert.php'; ?>
<body>
    <!--DOBRA CABEÇALHO-->

    <header class="main_header">
        <div class="main_header_content">
            <a href="index.php">
                <img src="assets/img/logos/logo_borda.png" alt="Olimpo Training" title="Olimpo Training"></a>
            <h4>Olimpo Training</h4>

            <nav class="main_header_content_menu">
                <ul>
                    <li><a href="views/index.php">Home</a></li>
                    <li><a href="">Exercícios</a></li>
                    <li><a href="">Fichas</a></li>
                    <li><a href="views/sele.html">Cadastre-se</a></li>
                    <li><a href="#" class="modal-link">Login</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <!--FIM DOBRA CABEÇALHO-->

    <!-- POP LOGIN -->
    <div class="overlay"></div>
    <div class="modal">
        <div class="div_login">
                <h1>Login</h1>
                <br>
                <form action="auth/login.php" method="post">
                    <input type="email" name="email" placeholder="Nome" class="input" required>
                    <br><br>
                    <input type="password" name="password" placeholder="Senha" class="input" required>
                    <br><br>
                    <button class="button">Enviar</button>
                </form>
        </div>
    </div>
    
    <!-- FIM POP LOGIN -->



    <!--DOBRA PALCO PRINCIPAL-->

    <!--1ª DOBRA-->
    <main>
        <div class="main_cta">
            <article class="main_cta_content">
                <div class="main_cta_content_spacer">

                    <header>
                        <h1>
                            Olimpo Training
                        </h1>
                    </header>

                    <p>Rumo a sua Transformação</p>
                    <p><a href="#content" class="btn">Saiba Mais</a></p>
                </div>
            </article>
        </div>
        <!--FIM 1ª DOBRA-->

        <!--INICIO SESSÃO SESSÃO DE ARTIGOS-->
        <section class="main_blog">
            <header class="main_blog_header" id="img">
                <h1 class="icon-zoom-in">Veja alguns de nossos Personal Trainers</h1>
                <p>Aqui você encontra profissionais de diversas áreas de atividades físicas</p>
            </header>

            <article>
                <a href="#">
                    <img src="assets/img/barbara.jpg" width="200" alt="Imagem post" title="Imagem Post">
                </a>

                <h2><a href="" class="title">
                Bárbara é uma personal trainer altamente qualificada e especialista em emagrecimento. Com sua paixão pela saúde e bem-estar, ela combina seu conhecimento científico e experiência prática para ajudar seus clientes a atingirem seus objetivos de perda de peso de forma eficaz e sustentável.
                    </a></h2>
            </article>
            <article>
                <a href="#">
                    <img src="assets/img/pm2.jpg" width="200" alt="Imagem post" title="Imagem Post">
                </a>

                <h2><a href="" class="title">
                Lucas Gabriel é um renomado personal trainer especializado em hipertrofia e ganho de massa muscular. Com vasta experiência na área, ele se destaca por ajudar seus clientes a alcançarem seus objetivos de forma eficiente e saudável.Com um conhecimento aprofundado em treinamento resistido e exercícios específicos para a hipertrofia muscular. 
                    </a></h2>
            </article>
            <article>
                <a href="#">
                    <img src="assets/img/pf.jpg" width="200" alt="Imagem post" title="Imagem Post">
                </a>

                <h2><a href="" class="title">
                Micaele é uma personal trainer altamente qualificada em formação de atletas de corrida. Com um vasto conhecimento na área, ela dedica-se a ajudar seus clientes a alcançarem seus objetivos e superarem limites.
                Com uma abordagem personalizada, Micaele cria programas de treinamento individualizados, levando em consideração as necessidades e metas específicas de cada atleta.
                    </a></h2>
            </article>
            <article>
                <a href="#">
                    <img src="assets/img/pm.jpg" width="200" alt="Imagem post" title="Imagem Post">
                </a>

                <h2><a href="" class="title">
                Gláuber Viana Magalhães é um personal trainer altamente qualificado e especializado em exercícios com peso do corpo. Com uma vasta experiência no campo do treinamento físico, ele auxilia seus clientes a alcançarem seus objetivos de forma eficaz, utilizando apenas o peso do próprio corpo.Gláuber é dedicado em fornecer treinamentos personalizados e adaptados às necessidades individuais de cada cliente. 
                
                    </a></h2>
            </article>



        </section>

        <!--FIM SESSÃO SESSÃO DE ARTIGOS-->

        <!--INICIO SESSÃO OPTIN-->
        <article class="opt_in">
            <div class="opt_in_content">
                <hr>
            </div>
        </article>

        <!--FIM SESSÃO OPTIN-->

        <!-- INICIO SESSÃO DOBRA  CURSOS-->
        <section class="main_course">
            <header class="main_course_header">
                <img src="assets/img/logo_borda.png" alt="img" title="img">
                <h1 class="icon-books">Treinos mais Populares</h1>
                <p>

                </p>
            </header>
            <div class="main_course_content">
                <article>
                    <header>
                        <h2>Calistenia</h2>
                        <p>
                            Diversos exercícios com peso do corpo
                        </p>
                        <a href="views/sele.html"><img src="assets/img/athlete-muscular-fitness-male-model-pulling-up-on-horizontal-bar_1498767369.jpg-850x514.jpg" alt=""></a>
                    </header>
                </article>
                <article>
                    <header>
                        <h2>Corrida</h2>
                        <p>
                            Veja a forma correta de executar exercícios
                        </p>
                        <a href="views/sele.html" class="costas"><img src="assets/img/corrida.jpg" alt=""></a>
                </article>
                <article>
                    <header>
                        <h2>Musculação</h2>
                        <p>
                            Veja a forma correta de executar exercícios
                        </p>
                        <a href="views/sele.html" class="costas"><img src="assets/img/musculação.jpg" alt=""></a>
                </article>
                <article>
                    <header>
                        <h2>Luta</h2>
                        <p>
                            Veja a forma correta de executar exercícios
                        </p>
                        <a href="views/sele.html" class="costas"><img src="assets/img/luta.jpg" alt=""></a>
                    </header>
                </article>
            </div>
            <hr>
            <!-- INICIO SESSÃO PREÇOS -->
            <div class="card">

                <div class="mensal">
                <h4>Plano Mensal</h4>
                <p>R$ 34,99</p>
                <img src="assets/img/mensal.gif" alt="mensal" title="mensal">
                </div>
                <div class="anual">
                <h4>Plano Anual</h4>
                <p>R$   345,99</p>
                <img src="assets/img/anual.gif" alt="anual" title="anual">
                </div>
            </div>
            <!-- FIM SESSÃO PREÇOS -->

            <!-- FIM SESSÃO DOBRA  CURSOS-->

            <!--INICIO DOBRA REVIEWS-->
           
        <!--DOBRA A ESCOLA-->
        <div class="main">
        <div class="main_school">
            <section class="main_school_content">
                <header class="main_school_header">
                    <h1 id="content">Olimpo</h1>
                    <p>Personal Trainers totalmente online</p>
                </header>
                <div class="main_school_content_left">
                    <article class="main_school_content_left_content">
                        <header>
                            <p>
                                <span class="icon-facebook"><a href="#">Facebook</a>&nbsp;</span><span class="icon-google-plus2"><a href="#">Google+</a></span>&nbsp;<span class="icon-twitter"><a href="#">Twitter</a></span>
                            </p>
                            <h2>Tudo o que você precisa para praticar exercícios em um só lugar</h2>
                        </header>
                        <p>Bem-vindo ao Olimpo Training! Aqui você encontrará tudo o que precisa para atingir seus objetivos de condicionamento físico.
                        Oferecemos uma ampla variedade de treinos especializados para todas as idades e níveis de condicionamento. Seja você um iniciante procurando se exercitar pela primeira vez ou um atleta experiente em busca de um novo desafio, temos programas personalizados que se adequarão às suas necessidades.</p>
                        <p>Nosso site apresenta uma abordagem equilibrada, combinando treinamento cardiovasculares, força, flexibilidade e exercícios de mobilidade. Você terá acesso a vídeos instrutivos, guias de treinamento e dicas valiosas dos nossos especialistas em fitness, que o ajudarão a maximizar seus esforços e alcançar resultados duradouros.</p>


                    </article>


                    <section class="main_school_list">
                       
                <div class="main_school_content_right">
                    
                </div>
                <article class="main_school_adress">
                    <header>
                        <h2 class="icon-location">Nossa Localização</h2>
                    </header>
                    <p>St. N, Área Especial QNN 14 - Ceilândia, Brasília - DF</p>
                </article>
            </section>
        </div>
        <!-- FIM DOBRA A ESCOLA -->



    </main>

    <!-- INICIO DOBRA RODAPÉ -->
   

    <section class="main_footer">
        <header>
            <h1>Quer saber mais?</h1>
        </header>

        <article class="main_footer_our_pages">
            <header>
                <h2>Entre em Contato</h2>
            </header>
            <ul>
                <li class="icon-google3">E-mail: <a href="#">olimpo_training@gmail.com</a></li>
                <li class="icon-whatsapp">Whatsapp: <a href="#">(61) 9 9589-7654</a></li>
                <li class="icon-instagram">Instagram: <a href="#">Olimpo_Training</a></li>
                
            </ul>
        </article>

        <article class="main_footer_links">
            <header>
                <h2>Links Úteis</h2>
            </header>
            <ul>
                <li><a href="#">Política de Privacidade</a></li>
                <li><a href="#">Aviso Legal</a></li>
                <li><a href="#">Termos de Uso</a></li>
            </ul>
        </article>

    </section>
</div>
    <footer class="main_footer_rights">
        <br>
        </div>
        <div class="icone">
           
        </div>
        <p>Olimpo - Todos os direitos reservados.</p>
    </footer>
    <!-- FIM DOBRA RODAPÉ -->
</body>
<script>
    // Seleciona o link e a janela modal
    var link = document.querySelector('.modal-link');
    var modal = document.querySelector('.modal');
    var overlay = document.querySelector('.overlay');

    // Adiciona um listener de evento para o link
    link.addEventListener('click', function(event) {
        event.preventDefault(); // previne o comportamento padrão do link (navegar para outra página)

        overlay.style.display = 'block'; // exibe a camada escura
        modal.style.display = 'block'; // exibe a janela modal
    });

    // Adiciona um listener de evento para a camada escura
    overlay.addEventListener('click', function() {
        overlay.style.display = 'none'; // oculta a camada escura
        modal.style.display = 'none'; // oculta a janela modal
    });
</script>

</html>