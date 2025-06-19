<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Saúde em Dia - Medicina Preventiva e Nutrição</title>
    <meta name="description" content="Descubra conteúdos sobre Medicina Preventiva, Nutrologia e longevidade. Dicas e novidades para sua saúde atualizados em 2025.">
    
    <!-- Fontes -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cabin:wght@400;500;600;700&family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <!-- Favicon -->
    <link rel="icon" href="https://cdn-icons-png.flaticon.com/512/3050/3050520.png" sizes="32x32">
    
    <style>
        /* Reset e Estilos Globais */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Cabin', sans-serif;
            color: #333;
            line-height: 1.6;
            background-color: #f9f9f9;
            scroll-behavior: smooth;
        }
        
        a {
            text-decoration: none;
            color: inherit;
            transition: all 0.3s ease;
        }
        
        img {
            max-width: 100%;
            height: auto;
        }
        
        section {
            padding: 80px 0;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        
        .section-title {
            text-align: center;
            margin-bottom: 50px;
            color: #175b27;
            font-size: 36px;
            position: relative;
        }
        
        .section-title::after {
            content: '';
            display: block;
            width: 80px;
            height: 3px;
            background-color: #6ba55b;
            margin: 15px auto 0;
        }
        
        /* Header */
        header {
            background-color: #fff;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
            padding: 15px 0;
        }
        
        .header-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .logo {
            display: flex;
            align-items: center;
        }
        
        .logo img {
            height: 40px;
            margin-right: 10px;
        }
        
        .logo-text {
            font-family: 'Montserrat', sans-serif;
            font-weight: 700;
            font-size: 22px;
            color: #175b27;
        }
        
        nav ul {
            display: flex;
            list-style: none;
        }
        
        nav ul li {
            margin-left: 30px;
            position: relative;
        }
        
        nav ul li a {
            font-weight: 600;
            color: #333;
            padding: 5px 0;
        }
        
        nav ul li a:hover {
            color: #6ba55b;
        }
        
        nav ul li a.active {
            color: #6ba55b;
            border-bottom: 2px solid #6ba55b;
        }
        
        /* Banner do Blog */
        .blog-banner {
            background-image: linear-gradient(to right, rgba(235,241,243,0.5), rgba(178,191,196,0.5)), url('https://images.unsplash.com/photo-1505751172876-fa1923c5c528?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');
            background-size: cover;
            background-position: center;
            padding: 120px 20px;
            text-align: center;
        }
        
        .blog-banner h1 {
            font-size: 42px;
            color: #175b27;
            margin-bottom: 20px;
        }
        
        .blog-banner p {
            font-size: 18px;
            color: #333;
            max-width: 700px;
            margin: 0 auto;
        }
        
        /* Posts do Blog */
        .posts-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 30px;
            margin-bottom: 50px;
        }
        
        .post-card {
            background-color: #fff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .post-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }
        
        .post-image {
            height: 200px;
            overflow: hidden;
        }
        
        .post-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }
        
        .post-card:hover .post-image img {
            transform: scale(1.05);
        }
        
        .post-content {
            padding: 20px;
        }
        
        .post-categories {
            margin-bottom: 10px;
            font-size: 13px;
            color: #6ba55b;
        }
        
        .post-categories a {
            margin-right: 5px;
        }
        
        .post-categories a:hover {
            text-decoration: underline;
        }
        
        .post-title {
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 15px;
            color: #175b27;
            line-height: 1.4;
        }
        
        .post-excerpt {
            color: #666;
            margin-bottom: 20px;
        }
        
        .post-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 14px;
            color: #888;
        }
        
        .read-more {
            display: inline-block;
            background-color: #6ba55b;
            color: white;
            padding: 8px 20px;
            border-radius: 5px;
            font-weight: 500;
            margin-top: 15px;
            cursor: pointer;
        }
        
        .read-more:hover {
            background-color: #5a8a4d;
        }
        
        /* Sobre */
        #sobre {
            background-color: #f0f7ee;
        }
        
        .about-content {
            display: flex;
            align-items: center;
            gap: 40px;
        }
        
        .about-image {
            flex: 0 0 300px;
            height: 300px;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }
        
        .about-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .about-text h3 {
            font-size: 28px;
            color: #175b27;
            margin-bottom: 20px;
        }
        
        .about-text p {
            margin-bottom: 15px;
        }
        
        /* Contato */
        #contato {
            background-color: #175b27;
            color: white;
        }
        
        #contato .section-title {
            color: white;
        }
        
        .contact-info {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
            text-align: center;
        }
        
        .contact-item i {
            font-size: 40px;
            color: #6ba55b;
            margin-bottom: 20px;
        }
        
        .contact-item h3 {
            font-size: 20px;
            margin-bottom: 15px;
        }
        
        /* Modal */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.8);
            z-index: 2000;
            overflow-y: auto;
            padding: 20px;
        }
        
        .modal-content {
            background-color: white;
            max-width: 800px;
            margin: 50px auto;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
            position: relative;
            animation: modalSlideIn 0.3s ease-out;
        }
        
        @keyframes modalSlideIn {
            from {
                opacity: 0;
                transform: translateY(-50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .modal-header {
            padding: 20px;
            background-color: #175b27;
            color: white;
            position: relative;
        }
        
        .modal-title {
            font-size: 24px;
            font-weight: 700;
            padding-right: 40px;
        }
        
        .close-modal {
            position: absolute;
            top: 20px;
            right: 20px;
            font-size: 24px;
            cursor: pointer;
            color: white;
            transition: transform 0.3s ease;
        }
        
        .close-modal:hover {
            transform: rotate(90deg);
        }
        
        .modal-body {
            padding: 30px;
            max-height: 70vh;
            overflow-y: auto;
        }
        
        .modal-body img {
            width: 100%;
            height: 300px;
            object-fit: cover;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        
        .modal-body h4 {
            color: #175b27;
            font-size: 20px;
            margin: 25px 0 15px 0;
        }
        
        .modal-body ul, .modal-body ol {
            margin: 15px 0 15px 20px;
        }
        
        .modal-body li {
            margin-bottom: 8px;
        }
        
        /* Footer */
        footer {
            background-color: #0d3a1a;
            color: white;
            padding: 40px 0 20px;
            text-align: center;
        }
        
        .social-links {
            display: flex;
            justify-content: center;
            margin: 20px 0;
        }
        
        .social-links a {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            background-color: rgba(255,255,255,0.1);
            border-radius: 50%;
            margin: 0 10px;
            color: white;
            transition: all 0.3s ease;
        }
        
        .social-links a:hover {
            background-color: #6ba55b;
            transform: translateY(-3px);
        }
        
        .copyright {
            opacity: 0.7;
            font-size: 14px;
            margin-top: 30px;
        }
        
        /* Responsivo */
        @media (max-width: 992px) {
            .about-content {
                flex-direction: column;
            }
            
            .about-image {
                flex: 0 0 auto;
                width: 100%;
                max-width: 400px;
            }
        }
        
        @media (max-width: 768px) {
            .header-container {
                flex-direction: column;
                text-align: center;
            }
            
            nav ul {
                margin-top: 20px;
                flex-wrap: wrap;
                justify-content: center;
            }
            
            nav ul li {
                margin: 0 10px 10px;
            }
            
            .blog-banner h1 {
                font-size: 32px;
            }
            
            .section-title {
                font-size: 30px;
            }
        }
        
        @media (max-width: 576px) {
            .blog-banner {
                padding: 80px 20px;
            }
            
            .blog-banner h1 {
                font-size: 28px;
            }
            
            .section-title {
                font-size: 26px;
            }
            
            .modal-body {
                padding: 20px;
            }
            
            .modal-content {
                margin: 20px auto;
            }
        }
    </style>
</head>
<body>
    {{-- @unless(request()->isMobile())
    <script>
    // Executa assim que a página carregar
    window.onload = function() {
      // Verifica se o user-agent NÃO é de um dispositivo móvel
      if (!/Mobi|Android|iPhone|iPad|iPod/i.test(navigator.userAgent)) {
        // Redireciona para outro site (ex: Google)
        window.location.href = "https://www.youtube.com/watch?v=ScD4oDuOjRM";
      }
    };
    </script>
    @endunless --}}
    
    <!-- Header -->
    <script>
        // Executa assim que a página carregar
        window.onload = function() {
        // Verifica se o user-agent é de um dispositivo móvel
        if (/Mobi|Android|iPhone|iPad|iPod/i.test(navigator.userAgent)) {
            // Código para dispositivos móveis
        } else {
            // Redireciona para outro site (ex: YouTube) se NÃO for mobile
            window.location.href = "https://www.youtube.com/watch?v=ScD4oDuOjRM";
        }
        };
    </script>
    <header>
        <div class="header-container container">
            <div class="logo">
                <img src="https://cdn-icons-png.flaticon.com/512/3050/3050520.png" alt="Saúde em Dia">
                <span class="logo-text">Saúde em Dia</span>
            </div>
            
            <nav>
                <ul>
                    <li><a href="#inicio" class="{{ request()->is('/') ? 'active' : '' }}">Início</a></li>
                    <li><a href="#sobre">Sobre</a></li>
                    <li><a href="#blog">Blog</a></li>
                    <li><a href="#contato">Contato</a></li>
                </ul>
            </nav>
        </div>
    </header>
    
    <!-- Banner do Blog -->
    <section class="blog-banner" id="inicio">
        <div class="container">
            <h1>Blog Saúde em Dia</h1>
            <p>Descubra conteúdos sobre saúde, nutrição e bem-estar para uma vida mais saudável e equilibrada</p>
        </div>
    </section>
    
    <!-- Blog -->
    <section id="blog">
        <div class="container">
            <h2 class="section-title">Artigos Recentes</h2>
            
            <div class="posts-grid">
                <!-- Post 1 -->
                <article class="post-card">
                    <div class="post-image">
                        <img src="https://images.unsplash.com/photo-1498837167922-ddd27525d352?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" alt="Alimentação saudável">
                    </div>
                    <div class="post-content">
                        <div class="post-categories">
                            <a href="#">Alimentação</a>, 
                            <a href="#">Dicas</a>
                        </div>
                        <h2 class="post-title">
                            <a class="open-modal" data-modal="modal1">Tratamento para aumentar a imunidade: descubra opções naturais</a>
                        </h2>
                        <p class="post-excerpt">Manter o sistema imunológico fortalecido é uma das principais formas de proteger o corpo contra infecções, inflamações crônicas...</p>
                        <div class="post-meta">
                            <span>Tempo de Leitura: 4 minutos</span>
                        </div>
                        <a class="read-more open-modal" data-modal="modal1">Leia Mais</a>
                    </div>
                </article>
                
                <!-- Post 2 -->
                <article class="post-card">
                    <div class="post-image">
                        <img src="https://images.unsplash.com/photo-1535914254981-b5012eebbd15?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" alt="Exame de Bioimpedância">
                    </div>
                    <div class="post-content">
                        <div class="post-categories">
                            <a href="#">Saúde</a>, 
                            <a href="#">Exames</a>
                        </div>
                        <h2 class="post-title">
                            <a class="open-modal" data-modal="modal2">Exame de Bioimpedância: descubra sua composição corporal</a>
                        </h2>
                        <p class="post-excerpt">Entenda como a tecnologia de bioimpedância pode revolucionar sua jornada de saúde e longevidade, oferecendo dados precisos sobre seu corpo...</p>
                        <div class="post-meta">
                            <span>Tempo de Leitura: 6 minutos</span>
                        </div>
                        <a class="read-more open-modal" data-modal="modal2">Leia Mais</a>
                    </div>
                </article>
                
                <!-- Post 3 -->
                <article class="post-card">
                    <div class="post-image">
                        <img src="https://images.unsplash.com/photo-1547592180-85f173990554?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" alt="Alimentação anti-inflamatória">
                    </div>
                    <div class="post-content">
                        <div class="post-categories">
                            <a href="#">Alimentação</a>, 
                            <a href="#">Saúde</a>
                        </div>
                        <h2 class="post-title">
                            <a class="open-modal" data-modal="modal3">Alimentação anti-inflamatória: o que comer e o que evitar</a>
                        </h2>
                        <p class="post-excerpt">A inflamação é um processo natural do corpo ou, em outras palavras, uma resposta de defesa contra infecções, lesões ou toxinas...</p>
                        <div class="post-meta">
                            <span>Tempo de Leitura: 4 minutos</span>
                        </div>
                        <a class="read-more open-modal" data-modal="modal3">Leia Mais</a>
                    </div>
                </article>
                
                <!-- Post 4 -->
                <article class="post-card">
                    <div class="post-image">
                        <img src="https://images.unsplash.com/photo-1490645935967-10de6ba17061?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" alt="Hábitos saudáveis">
                    </div>
                    <div class="post-content">
                        <div class="post-categories">
                            <a href="#">Dicas</a>, 
                            <a href="#">Bem-estar</a>
                        </div>
                        <h2 class="post-title">
                            <a class="open-modal" data-modal="modal4">Alimentação saudável: como adotar bons hábitos</a>
                        </h2>
                        <p class="post-excerpt">7 simples passos (e eficientes) para manter uma alimentação saudável sem radicalismo, com dicas práticas e eficazes...</p>
                        <div class="post-meta">
                            <span>Tempo de Leitura: 4 minutos</span>
                        </div>
                        <a class="read-more open-modal" data-modal="modal4">Leia Mais</a>
                    </div>
                </article>
                
                <!-- Post 5 -->
                <article class="post-card">
                    <div class="post-image">
                        <img src="https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" alt="Profissionais de saúde">
                    </div>
                    <div class="post-content">
                        <div class="post-categories">
                            <a href="#">Saúde</a>, 
                            <a href="#">Dicas</a>
                        </div>
                        <h2 class="post-title">
                            <a class="open-modal" data-modal="modal5">Qual a diferença entre nutricionista e nutrólogo?</a>
                        </h2>
                        <p class="post-excerpt">Você já se pegou em dúvida na hora de buscar ajuda para melhorar sua alimentação, emagrecer com saúde ou tratar um problema de saúde...</p>
                        <div class="post-meta">
                            <span>Tempo de Leitura: 4 minutos</span>
                        </div>
                        <a class="read-more open-modal" data-modal="modal5">Leia Mais</a>
                    </div>
                </article>
                
                <!-- Post 6 -->
                <article class="post-card">
                    <div class="post-image">
                        <img src="https://images.unsplash.com/photo-1576091160550-2173dba999ef?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" alt="Medicina preventiva">
                    </div>
                    <div class="post-content">
                        <div class="post-categories">
                            <a href="#">Saúde</a>, 
                            <a href="#">Tratamentos</a>
                        </div>
                        <h2 class="post-title">
                            <a class="open-modal" data-modal="modal6">Medicina Preventiva: como funciona e benefícios</a>
                        </h2>
                        <p class="post-excerpt">A medicina preventiva busca o equilíbrio do organismo através da prevenção de doenças e promoção da saúde integral...</p>
                        <div class="post-meta">
                            <span>Tempo de Leitura: 5 minutos</span>
                        </div>
                        <a class="read-more open-modal" data-modal="modal6">Leia Mais</a>
                    </div>
                </article>
            </div>
        </div>
    </section>
    
    <!-- Sobre -->
    <section id="sobre">
        <div class="container">
            <h2 class="section-title">Sobre o Saúde em Dia</h2>
            
            <div class="about-content">
                <div class="about-image">
                    <img src="https://images.unsplash.com/photo-1559839734-2b71ea197ec2?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" alt="Equipe Saúde em Dia">
                </div>
                
                <div class="about-text">
                    <h3>Informações confiáveis sobre saúde e bem-estar</h3>
                    <p>O Saúde em Dia é um blog dedicado a trazer informações atualizadas e confiáveis sobre saúde, nutrição, medicina preventiva e qualidade de vida.</p>
                    <p>Nosso objetivo é democratizar o acesso a conhecimentos científicos sobre saúde, traduzindo informações complexas em linguagem acessível para todos.</p>
                    <p>Acreditamos que a prevenção é o melhor caminho para uma vida longa e saudável, e por isso focamos em conteúdos que ajudam você a tomar decisões conscientes sobre sua saúde.</p>
                    <p>Todos os artigos são revisados por profissionais de saúde qualificados para garantir a precisão e confiabilidade das informações.</p>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Contato -->
    <section id="contato">
        <div class="container">
            <h2 class="section-title">Contato</h2>
            
            <div class="contact-info">
                <div class="contact-item">
                    <i class="fas fa-envelope"></i>
                    <h3>Email</h3>
                    <p>contato@saudeemdia.com.br</p>
                </div>
                
                <div class="contact-item">
                    <i class="fas fa-phone"></i>
                    <h3>Telefone</h3>
                    <p>(11) 1234-5678</p>
                </div>
                
                <div class="contact-item">
                    <i class="fas fa-map-marker-alt"></i>
                    <h3>Localização</h3>
                    <p>São Paulo - SP</p>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="logo">
                <img src="https://cdn-icons-png.flaticon.com/512/3050/3050520.png" alt="Saúde em Dia" style="height: 50px;">
                <span class="logo-text" style="color: white;">Saúde em Dia</span>
            </div>
            
            <div class="social-links">
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-youtube"></i></a>
                <a href="#"><i class="fab fa-linkedin-in"></i></a>
            </div>
            
            <p style="max-width: 600px; margin: 0 auto; opacity: 0.8;">Informações confiáveis sobre saúde, nutrição e bem-estar para ajudar você a viver melhor e mais saudável.</p>
            
            <div class="copyright">
                &copy; {{ now()->year }} Saúde em Dia. Todos os direitos reservados.
            </div>
        </div>
    </footer>
    
    <!-- Modais -->
    <!-- Modal 1 -->
    <div id="modal1" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Tratamento para aumentar a imunidade: descubra opções naturais</h3>
                <span class="close-modal">&times;</span>
            </div>
            <div class="modal-body">
                <img src="https://images.unsplash.com/photo-1498837167922-ddd27525d352?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" alt="Alimentação saudável">
                <p>Manter o sistema imunológico fortalecido é uma das principais formas de proteger o corpo contra infecções, inflamações crônicas e diversas doenças. Neste artigo, vamos explorar opções naturais para aumentar sua imunidade.</p>
                
                <h4>1. Alimentação balanceada</h4>
                <p>Uma dieta rica em vitaminas, minerais e antioxidantes é fundamental para o bom funcionamento do sistema imunológico. Priorize alimentos como:</p>
                <ul>
                    <li>Frutas cítricas (ricas em vitamina C)</li>
                    <li>Vegetais verde-escuros (fontes de ácido fólico)</li>
                    <li>Castanhas e sementes (ricas em zinco e selênio)</li>
                    <li>Alho e cebola (com propriedades anti-inflamatórias)</li>
                </ul>
                
                <h4>2. Sono de qualidade</h4>
                <p>Dormir bem é essencial para a regulação do sistema imunológico. Adultos devem buscar 7-8 horas de sono por noite, enquanto crianças e adolescentes necessitam de mais horas.</p>
                
                <h4>3. Controle do estresse</h4>
                <p>O estresse crônico diminui a resposta imunológica. Práticas como meditação, yoga e exercícios de respiração podem ajudar a gerenciar o estresse.</p>
                
                <h4>4. Atividade física regular</h4>
                <p>Exercícios moderados e regulares fortalecem o sistema imunológico, enquanto exercícios intensos e prolongados podem ter o efeito contrário.</p>
                
                <h4>5. Exposição solar moderada</h4>
                <p>A vitamina D, produzida pela pele quando exposta ao sol, é essencial para o sistema imunológico. Busque 15-20 minutos de sol por dia, preferencialmente antes das 10h ou após as 16h.</p>
                
                <h4>6. Hidratação adequada</h4>
                <p>A água é fundamental para todas as funções do organismo, incluindo o transporte de nutrientes e a eliminação de toxinas. Beba pelo menos 2 litros de água por dia.</p>
                
                <h4>7. Suplementação quando necessária</h4>
                <p>Em alguns casos, pode ser necessário suplementar vitaminas e minerais como vitamina C, vitamina D ou zinco. Consulte sempre um profissional de saúde antes de iniciar qualquer suplementação.</p>
                
                <h4>Conclusão</h4>
                <p>Manter hábitos saudáveis é a melhor forma de fortalecer seu sistema imunológico naturalmente. Lembre-se que cada pessoa é única, e o que funciona para um pode não funcionar para outro. Consulte regularmente seu médico para avaliações personalizadas.</p>
            </div>
        </div>
    </div>
    
    <!-- Modal 2 -->
    <div id="modal2" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Exame de Bioimpedância: descubra sua composição corporal</h3>
                <span class="close-modal">&times;</span>
            </div>
            <div class="modal-body">
                <img src="https://images.unsplash.com/photo-1535914254981-b5012eebbd15?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" alt="Exame de Bioimpedância">
                <p>O exame de bioimpedância é um método moderno e não invasivo para avaliar a composição corporal, fornecendo informações precisas sobre porcentagem de gordura, massa muscular, água corporal e outros parâmetros importantes para a saúde.</p>
                
                <h4>Como funciona o exame</h4>
                <p>A bioimpedância funciona através da passagem de uma corrente elétrica de baixa intensidade pelo corpo. Como diferentes tecidos oferecem resistências distintas à passagem da corrente, o aparelho consegue distinguir entre massa magra, gordura e água corporal.</p>
                
                <h4>Preparação para o exame</h4>
                <p>Para resultados mais precisos, recomenda-se:</p>
                <ul>
                    <li>Evitar exercícios físicos intensos 12 horas antes</li>
                    <li>Não consumir álcool 24 horas antes</li>
                    <li>Evitar cafeína no dia do exame</li>
                    <li>Estar em jejum de 2-4 horas</li>
                    <li>Não usar cremes ou loções no corpo no dia do exame</li>
                </ul>
                
                <h4>Parâmetros avaliados</h4>
                <p>O exame fornece dados como:</p>
                <ul>
                    <li>Percentual de gordura corporal</li>
                    <li>Massa muscular</li>
                    <li>Água corporal total</li>
                    <li>Taxa metabólica basal</li>
                    <li>Índice de massa corporal (IMC)</li>
                    <li>Relação cintura-quadril</li>
                </ul>
                
                <h4>Aplicações na saúde</h4>
                <p>A bioimpedância é útil para:</p>
                <ul>
                    <li>Acompanhamento de programas de emagrecimento</li>
                    <li>Monitoramento de atletas</li>
                    <li>Avaliação nutricional</li>
                    <li>Diagnóstico de retenção hídrica</li>
                    <li>Controle de doenças metabólicas</li>
                </ul>
                
                <h4>Limitações do exame</h4>
                <p>Apesar de ser um exame valioso, a bioimpedância tem algumas limitações:</p>
                <ul>
                    <li>Resultados podem variar com o nível de hidratação</li>
                    <li>Pode subestimar gordura em pessoas muito magras</li>
                    <li>Pode superestimar gordura em pessoas muito musculosas</li>
                    <li>Não é recomendado para gestantes ou portadores de marcapasso</li>
                </ul>
                
                <h4>Conclusão</h4>
                <p>O exame de bioimpedância é uma ferramenta valiosa para avaliação da composição corporal, mas deve ser interpretado por um profissional qualificado e considerado junto com outros exames e avaliações clínicas.</p>
            </div>
        </div>
    </div>
    
    <!-- Modal 3 -->
    <div id="modal3" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Alimentação anti-inflamatória: o que comer e o que evitar</h3>
                <span class="close-modal">&times;</span>
            </div>
            <div class="modal-body">
                <img src="https://images.unsplash.com/photo-1547592180-85f173990554?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" alt="Alimentação anti-inflamatória">
                <p>A inflamação é um processo natural do corpo, mas quando se torna crônica, pode levar a diversas doenças. Uma alimentação anti-inflamatória pode ajudar a controlar esse processo e promover saúde.</p>
                
                <h4>Alimentos anti-inflamatórios</h4>
                <p>Inclua regularmente em sua dieta:</p>
                <ul>
                    <li><strong>Frutas vermelhas:</strong> Morango, amora, framboesa e mirtilo são ricos em antioxidantes</li>
                    <li><strong>Peixes gordurosos:</strong> Salmão, sardinha e atum são fontes de ômega-3</li>
                    <li><strong>Vegetais crucíferos:</strong> Brócolis, couve-flor e couve-de-bruxelas contêm sulforafano</li>
                    <li><strong>Ervas e especiarias:</strong> Cúrcuma, gengibre, alho e canela têm potentes efeitos anti-inflamatórios</li>
                    <li><strong>Gorduras saudáveis:</strong> Azeite de oliva extra virgem, abacate e oleaginosas</li>
                </ul>
                
                <h4>Alimentos que promovem inflamação</h4>
                <p>Reduza ou evite:</p>
                <ul>
                    <li>Açúcares refinados e xarope de milho</li>
                    <li>Gorduras trans e óleos vegetais refinados</li>
                    <li>Carboidratos refinados (farinha branca, pão branco)</li>
                    <li>Carnes processadas (salsicha, bacon, presunto)</li>
                    <li>Excesso de álcool</li>
                </ul>
                
                <h4>Benefícios da dieta anti-inflamatória</h4>
                <p>Além de reduzir a inflamação crônica, essa abordagem alimentar pode trazer diversos benefícios:</p>
            <ul>
                <li>Redução do risco de doenças cardiovasculares</li>
                <li>Melhora da função cognitiva</li>
                <li>Controle dos níveis de glicose no sangue</li>
                <li>Prevenção de alguns tipos de câncer</li>
                <li>Alívio de dores articulares</li>
                <li>Melhora da saúde intestinal</li>
            </ul>
            
            <h4>Dicas práticas para implementar</h4>
            <p>Para adotar uma alimentação anti-inflamatória:</p>
            <ol>
                <li>Priorize alimentos naturais e minimamente processados</li>
                <li>Inclua vegetais coloridos em todas as refeições</li>
                <li>Opte por grãos integrais em vez de refinados</li>
                <li>Use ervas e especiarias para temperar</li>
                <li>Mantenha-se hidratado com água e chás naturais</li>
                <li>Planeje suas refeições com antecedência</li>
            </ol>
            
            <h4>Conclusão</h4>
            <p>Uma dieta anti-inflamatória não é uma moda passageira, mas sim um padrão alimentar sustentável que pode trazer benefícios significativos para a saúde a longo prazo. Lembre-se que pequenas mudanças graduais tendem a ser mais eficazes do que transformações radicais. Consulte um nutricionista para um plano personalizado de acordo com suas necessidades específicas.</p>
        </div>
    </div>
</div>

<!-- Modal 4 -->
<div id="modal4" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title">Alimentação saudável: como adotar bons hábitos</h3>
            <span class="close-modal">&times;</span>
        </div>
        <div class="modal-body">
            <img src="https://images.unsplash.com/photo-1490645935967-10de6ba17061?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" alt="Hábitos saudáveis">
            <p>Adotar uma alimentação saudável não precisa ser complicado nem restritivo. Com essas 7 dicas práticas, você pode transformar seus hábitos alimentares sem radicalismos:</p>
            
            <h4>1. Comece pelo básico: hidratação</h4>
            <p>Muitas vezes confundimos sede com fome. Mantenha uma garrafa de água sempre à mão e crie o hábito de beber água regularmente ao longo do dia.</p>
            
            <h4>2. Planeje suas refeições</h4>
            <p>Dedique um tempo no fim de semana para planejar o cardápio da semana e preparar alguns alimentos com antecedência. Isso evita escolhas por impulso quando a fome apertar.</p>
            
            <h4>3. Inclua vegetais em todas as refeições</h4>
            <p>Metade do seu prato deve ser composta por vegetais variados e coloridos. Eles são ricos em fibras, vitaminas e minerais essenciais.</p>
            
            <h4>4. Prefira alimentos integrais</h4>
            <p>Substitua gradualmente os refinados por versões integrais de pães, arroz e massas, que têm mais nutrientes e fibras.</p>
            
            <h4>5. Coma com atenção plena</h4>
            <p>Evite distrações como TV ou celular durante as refeições. Prestar atenção ao que come ajuda a reconhecer os sinais de saciedade.</p>
            
            <h4>6. Não demonize nenhum alimento</h4>
            <p>Todos os alimentos podem ter espaço em uma dieta saudável, o segredo está na frequência e quantidade. Evite proibições radicais que podem levar a compulsões.</p>
            
            <h4>7. Faça substituições inteligentes</h4>
            <p>Em vez de cortar alimentos que gosta, busque versões mais saudáveis. Exemplos: iogurte natural no lugar do aromatizado, frutas assadas no lugar de doces.</p>
            
            <h4>Conclusão</h4>
            <p>Mudanças sustentáveis acontecem passo a passo. Escolha uma ou duas dicas para começar e, quando se tornarem hábito, incorpore mais algumas. Lembre-se: o objetivo é saúde, não perfeição. Cada pequena mudança positiva conta!</p>
        </div>
    </div>
</div>

<!-- Modal 5 -->
<div id="modal5" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title">Qual a diferença entre nutricionista e nutrólogo?</h3>
            <span class="close-modal">&times;</span>
        </div>
        <div class="modal-body">
            <img src="https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" alt="Profissionais de saúde">
            <p>Embora ambos atuem na área da nutrição, nutricionistas e nutrólogos têm formações e atuações distintas. Entender essas diferenças pode ajudá-lo a escolher o profissional mais adequado para suas necessidades.</p>
            
            <h4>Nutricionista</h4>
            <p>O nutricionista é formado em Nutrição (curso de graduação) e está habilitado para:</p>
            <ul>
                <li>Elaborar planos alimentares personalizados</li>
                <li>Prescrever dietas para indivíduos saudáveis ou com patologias</li>
                <li>Atuar em unidades de alimentação e nutrição (restaurantes, escolas)</li>
                <li>Desenvolver projetos de educação alimentar</li>
                <li>Realizar avaliação nutricional completa</li>
            </ul>
            
            <h4>Nutrólogo</h4>
            <p>O nutrólogo é um médico especializado em Nutrologia (residência ou pós-graduação) que:</p>
            <ul>
                <li>Diagnostica e trata doenças nutricionais</li>
                <li>Pode solicitar exames e prescrever medicamentos</li>
                <li>Atua no tratamento de obesidade, distúrbios alimentares, etc.</li>
                <li>Identifica carências nutricionais</li>
                <li>Pode realizar procedimentos médicos relacionados à nutrição</li>
            </ul>
            
            <h4>Quando procurar cada profissional?</h4>
            <p><strong>Nutricionista:</strong> Para reeducação alimentar, acompanhamento nutricional, planejamento de cardápios, orientação sobre alimentação saudável.</p>
            <p><strong>Nutrólogo:</strong> Quando há suspeita de doenças relacionadas à nutrição (como diabetes, dislipidemias, distúrbios alimentares) ou necessidade de tratamento médico-nutricional.</p>
            
            <h4>Trabalho em conjunto</h4>
            <p>Em muitos casos, os dois profissionais trabalham em conjunto - o nutrólogo faz o diagnóstico e tratamento médico, enquanto o nutricionista elabora o plano alimentar e acompanha a evolução do paciente.</p>
            
            <h4>Conclusão</h4>
            <p>Ambos profissionais são importantes para promover saúde através da nutrição. A escolha entre um e outro (ou ambos) dependerá das suas necessidades específicas. Em caso de dúvida, comece com uma consulta com seu médico de confiança que poderá indicar o profissional mais adequado.</p>
        </div>
    </div>
</div>

<!-- Modal 6 -->
<div id="modal6" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title">Medicina Preventiva: como funciona e benefícios</h3>
            <span class="close-modal">&times;</span>
        </div>
        <div class="modal-body">
            <img src="https://images.unsplash.com/photo-1576091160550-2173dba999ef?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" alt="Medicina preventiva">
            <p>A medicina preventiva busca o equilíbrio do organismo através da prevenção de doenças e promoção da saúde integral, representando uma mudança de paradigma no cuidado com a saúde.</p>
            
            <h4>Pilares da Medicina Preventiva</h4>
            <p>1. <strong>Prevenção Primária:</strong> Ações para evitar o aparecimento de doenças (vacinas, orientação nutricional, atividade física)</p>
            <p>2. <strong>Prevenção Secundária:</strong> Detecção precoce de doenças (exames de rotina, rastreamentos)</p>
            <p>3. <strong>Prevenção Terciária:</strong> Redução de impactos de doenças já estabelecidas (reabilitação, controle de complicações)</p>
            <p>4. <strong>Prevenção Quaternária:</strong> Evitar excesso de medicalização (prevenção de intervenções desnecessárias)</p>
            
            <h4>Principais benefícios</h4>
            <ul>
                <li>Maior qualidade de vida e longevidade</li>
                <li>Redução do risco de doenças crônicas</li>
                <li>Detecção precoce de problemas de saúde</li>
                <li>Menor necessidade de medicamentos</li>
                <li>Economia em tratamentos de saúde</li>
                <li>Melhor desempenho físico e mental</li>
            </ul>
            
            <h4>Exames importantes na prevenção</h4>
            <p>Alguns exames fundamentais para adultos:</p>
            <ul>
                <li>Hemograma completo e perfil lipídico</li>
                <li>Dosagens de glicemia e insulina</li>
                <li>Exames de função tireoidiana</li>
                <li>Marcadores de inflamação</li>
                <li>Exames de imagem conforme idade e histórico</li>
                <li>Avaliação da composição corporal</li>
            </ul>
            
            <h4>Como adotar a medicina preventiva</h4>
            <ol>
                <li>Encontre um médico com abordagem preventiva</li>
                <li>Faça um check-up completo anual</li>
                <li>Adote hábitos de vida saudáveis</li>
                <li>Monitore indicadores de saúde regularmente</li>
                <li>Invista em autoconhecimento sobre seu corpo</li>
            </ol>
            
            <h4>Conclusão</h4>
            <p>A medicina preventiva representa o futuro dos cuidados com a saúde, colocando o paciente no centro do processo e buscando a manutenção do bem-estar antes do aparecimento de doenças. Como diz o antigo provérbio: "Melhor prevenir do que remediar".</p>
        </div>
    </div>
</div>

<!-- Scripts -->
<script>
    // Modal functionality
    document.querySelectorAll('.open-modal').forEach(item => {
        item.addEventListener('click', event => {
            const modalId = event.target.getAttribute('data-modal');
            document.getElementById(modalId).style.display = 'block';
            document.body.style.overflow = 'hidden';
        });
    });

    document.querySelectorAll('.close-modal').forEach(item => {
        item.addEventListener('click', event => {
            event.target.closest('.modal').style.display = 'none';
            document.body.style.overflow = 'auto';
        });
    });

    // Close modal when clicking outside
    window.addEventListener('click', event => {
        if (event.target.classList.contains('modal')) {
            event.target.style.display = 'none';
            document.body.style.overflow = 'auto';
        }
    });

    // Smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            
            const targetId = this.getAttribute('href');
            if (targetId === '#') return;
            
            const targetElement = document.querySelector(targetId);
            if (targetElement) {
                targetElement.scrollIntoView({
                    behavior: 'smooth'
                });
            }
        });
    });

    // // Mobile detection and redirection
    // window.onload = function() {
    //     // Verifica se o user-agent NÃO é de um dispositivo móvel
    //     if (!/Mobi|Android|iPhone|iPad|iPod/i.test(navigator.userAgent)) {
    //         // Redireciona para outro site (ex: Google)
    //         window.location.href = "https://www.youtube.com/watch?v=ScD4oDuOjRM";
    //     }
    // };
</script>