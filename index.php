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
    <?php if (isset($_GET['msg']) || isset($_GET['error'])) : ?>
                        <div align="center" class="<?= (isset($_GET['error']) ? 'msg__success' : 'msg__error') ?>">
                            <p><font color="red"><?= $_GET['msg'] ?? $_GET['error'] ?></font></p>
                        </div>
                    <?php endif; ?>

    
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

                    <p>Cuide do seu corpo</p>
                    <p><a href="#" class="btn">Saiba Mais</a></p>
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
                    <img src="assets/img/Mauricio-Rossi-foto-para-site-3.jpg" width="200" alt="Imagem post" title="Imagem Post">
                </a>

                <h2><a href="" class="title">
                        Renato Cariani é Fisiculturista e Empresário. É um dos principais Influenciadores de Fisiculturismo e Idealizador da “Casa dos Campeões”, considerado o maior projeto no formato de Reality Show da história do Youtube da musculação. Renato nasceu em 1976 no bairro Cidade Dutra, em São Paulo capital.!
                    </a></h2>
            </article>
            <article>
                <a href="#">
                    <img src="assets/img/Mauricio-Rossi-foto-para-site-3.jpg" width="200" alt="Imagem post" title="Imagem Post">
                </a>

                <h2><a href="" class="title">
                        Renato Cariani é Fisiculturista e Empresário. É um dos principais Influenciadores de Fisiculturismo e Idealizador da “Casa dos Campeões”, considerado o maior projeto no formato de Reality Show da história do Youtube da musculação. Renato nasceu em 1976 no bairro Cidade Dutra, em São Paulo capital.!
                    </a></h2>
            </article>
            <article>
                <a href="#">
                    <img src="assets/img/Mauricio-Rossi-foto-para-site-3.jpg" width="200" alt="Imagem post" title="Imagem Post">
                </a>

                <h2><a href="" class="title">
                        Renato Cariani é Fisiculturista e Empresário. É um dos principais Influenciadores de Fisiculturismo e Idealizador da “Casa dos Campeões”, considerado o maior projeto no formato de Reality Show da história do Youtube da musculação. Renato nasceu em 1976 no bairro Cidade Dutra, em São Paulo capital.!
                    </a></h2>
            </article>
            <article>
                <a href="#">
                    <img src="assets/img/Mauricio-Rossi-foto-para-site-3.jpg" width="200" alt="Imagem post" title="Imagem Post">
                </a>

                <h2><a href="" class="title">
                        Renato Cariani é Fisiculturista e Empresário. É um dos principais Influenciadores de Fisiculturismo e Idealizador da “Casa dos Campeões”, considerado o maior projeto no formato de Reality Show da história do Youtube da musculação. Renato nasceu em 1976 no bairro Cidade Dutra, em São Paulo capital.!
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
                        <a href="#"><img src="assets/img/athlete-muscular-fitness-male-model-pulling-up-on-horizontal-bar_1498767369.jpg-850x514.jpg" alt=""></a>
                    </header>
                </article>
                <article>
                    <header>
                        <h2>Corrida</h2>
                        <p>
                            Veja a forma correta de executar exercícios
                        </p>
                        <a href="#" class="costas"><img src="assets/img/corrida.jpg" alt=""></a>
                </article>
                <article>
                    <header>
                        <h2>Musculação</h2>
                        <p>
                            Veja a forma correta de executar exercícios
                        </p>
                        <a href="#" class="costas"><img src="assets/img/musculação.jpg" alt=""></a>
                </article>
                <article>
                    <header>
                        <h2>Luta</h2>
                        <p>
                            Veja a forma correta de executar exercícios
                        </p>
                        <a href="#" class="costas"><img src="assets/img/luta.jpg" alt=""></a>
                    </header>
                </article>
            </div>
            <!-- FIM SESSÃO DOBRA  CURSOS-->

            <!--INICIO DOBRA REVIEWS-->
            <div class="main_course_fullwidth" id="ancora">
                <div class="main_course_ratting_content">
                    <article class="main_course_rating_title">
                        <header>
                            <h2>Curso considerado 5 estrelas por nossos 100 alunos matriculados</h2>
                        </header>
                        <img src="assets/img/star.png" alt="Estrela" title="Estrela">
                        <img src="assets/img/star.png" alt="Estrela" title="Estrela">
                        <img src="assets/img/star.png" alt="Estrela" title="Estrela">
                        <img src="assets/img/star.png" alt="Estrela" title="Estrela">
                        <img src="assets/img/star.png" alt="Estrela" title="Estrela">
                    </article>

                    <section class="main_course_ratting_content_comment">
                        <header>
                            <h2>Veja o que estão falando sobre o curso</h2>
                        </header>
                        <article>
                            <header>
                                <h3> Instrutor Web</h3>
                                <p>03/03/2023</p>
                                <img src="assets/img/star.png" alt="Imagem" title="Imagem">
                                <img src="assets/img/star.png" alt="Imagem" title="Imagem">
                                <img src="assets/img/star.png" alt="Imagem" title="Imagem">
                                <img src="assets/img/star.png" alt="Imagem" title="Imagem">
                                <img src="assets/img/star.png" alt="Imagem" title="Imagem">
                            </header>
                            <p>O conteúdo é fantático, eu não tinha conhecimento nenhum e agora estou desenvolvendo
                                minhas
                                páginas em html5 e Css3</p>
                        </article>

                        <article>
                            <header>
                                <h3> Instrutor Web</h3>
                                <p>03/03/2023</p>
                                <img src="assets/img/star.png" alt="Imagem" title="Imagem">
                                <img src="assets/img/star.png" alt="Imagem" title="Imagem">
                                <img src="assets/img/star.png" alt="Imagem" title="Imagem">
                                <img src="assets/img/star.png" alt="Imagem" title="Imagem">
                                <img src="assets/img/star.png" alt="Imagem" title="Imagem">
                            </header>
                            <p>O conteúdo é fantático, eu não tinha conhecimento nenhum e agora estou desenvolvendo
                                minhas
                                páginas em html5 e Css3</p>
                        </article>

                        <article>
                            <header>
                                <h3> Instrutor Web</h3>
                                <p>03/03/2023</p>
                                <img src="assets/img/star.png" alt="Imagem" title="Imagem">
                                <img src="assets/img/star.png" alt="Imagem" title="Imagem">
                                <img src="assets/img/star.png" alt="Imagem" title="Imagem">
                                <img src="assets/img/star.png" alt="Imagem" title="Imagem">
                                <img src="assets/img/star.png" alt="Imagem" title="Imagem">
                            </header>
                            <p>O conteúdo é fantático, eu não tinha conhecimento nenhum e agora estou desenvolvendo
                                minhas
                                páginas em html5 e Css3</p>
                        </article>


                    </section>
                </div>
            </div>
        </section>
        <!--DOBRA A ESCOLA-->
        <div class="main_school">
            <section class="main_school_content">
                <header class="main_school_header">
                    <h1>Bem vindo a ETC - Escola técnica de Ceilândia</h1>
                    <p>A sua Escola de programação e Marketing Digital</p>
                </header>
                <div class="main_school_content_left">
                    <article class="main_school_content_left_content">
                        <header>
                            <p>
                                <span class="icon-facebook"><a href="#">Facebook</a>&nbsp;</span><span class="icon-google-plus2"><a href="#">Google+</a></span>&nbsp;<span class="icon-twitter"><a href="#">Twitter</a></span>
                            </p>
                            <h2>Tudo o que você precisa para ser um Webmaster FullStack em um só lugar</h2>
                        </header>
                        <p>Desde 1980 a ETC - vem criando os melhores cursos do mercado, entregamos ao aluno
                            conhecimento
                            prático e testado sem enrolção.Você tem acesso a aulas com a melhor qualidade, recursos que
                            aceleram seu aprendizado e muito mais...</p>
                        <p>Que tal estudar, e ter o certificado da escola eleita a melhor do Brasil com reconhecimento
                            em
                            mais de 17 países pela Latin American Quality Institute?</p>
                    </article>


                    <section class="main_school_list">
                        <header>
                            <h2>Confira nossos prêmios</h2>
                        </header>
                        <article>
                            <header>
                                <h3 class="icon-trophy">Qualidade e Excelência - Master Pesquisas</h3>
                            </header>
                        </article>

                        <article>
                            <header>
                                <h3 class="icon-trophy">Qualidade e Atendimento - Master Pesquisas</h3>
                            </header>
                        </article>

                        <article>
                            <header>
                                <h3 class="icon-trophy">Prêmio Diamante - Master Pesquisas</h3>
                            </header>
                        </article>

                        <article>
                            <header>
                                <h3 class="icon-trophy">Estrela do Sul - Master Pesquisas</h3>
                            </header>
                        </article>

                        <article>
                            <header>
                                <h3 class="icon-trophy">Medalha de Ouro a Excelência - LAQ</h3>
                            </header>
                        </article>

                        <article>
                            <header>
                                <h3 class="icon-trophy">Brazil Quality Certification - LAQI</h3>
                            </header>
                        </article>

                        <article>
                            <header>
                                <h3 class="icon-trophy">Melhor Plataforma EAD - Digital Awards</h3>
                            </header>
                        </article>
                    </section>
                </div>
                <div class="main_school_content_right">
                    <img src="assets/img/etclogo.png" width="200" alt="Imagem" title="Imagem">
                </div>
                <article class="main_school_adress">
                    <header>
                        <h2 class="icon-map2">Nos Encontre</h2>
                    </header>
                    <p>St. N, Área Especial QNN 14 - Ceilândia, Brasília - DF</p>
                </article>
            </section>
        </div>
        <!-- FIM DOBRA A ESCOLA -->



    </main>

    <!-- INICIO DOBRA RODAPÉ -->
    <section class="main_optin_footer">
        <div class="main_optin_footer_content">
            <header>
                <h1>Quer receber nosso conteúdo exclusivo? Assina nossa lista VIP :)</h1>
            </header>
            <article>
                <header>
                    <h2><a href="#" class="btn">Entrar para a lista VIP</a></h2>
                </header>
            </article>
        </div>
    </section>

    <section class="main_footer">
        <header>
            <h1>Quer saber mais?</h1>
        </header>

        <article class="main_footer_our_pages">
            <header>
                <h2>Nossas Páginas</h2>
            </header>
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#">Blog</a></li>
                <li><a href="#">A Escola</a></li>
                <li><a href="#">Contato</a></li>
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

        <article class="main_footer_about">
            <header>
                <h2>Sobre o Projeto</h2>
            </header>
            <p>Aprenda a trabalhar com HTML5 e CSS3 para desenvolver seus projetos e entregar páginas que estejam dentro
                dos padrões da WEB seguindo as boas práticas</p>
        </article>
    </section>
    <footer class="main_footer_rights">
        <br>
        <div class="icone">
            <span class="icon-facebook"><a href="#">Facebook</a>&nbsp;</span><span class="icon-google-plus2"><a href="#">Google+</a></span>&nbsp;<span class="icon-twitter"><a href="#">Twitter</a></span>
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