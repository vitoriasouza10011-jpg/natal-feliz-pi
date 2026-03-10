<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="/assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
</head>

<body>
    <header>
        <div class="logo-texto"><?= $title ?></div>
        <nav>
            <a href="#sobre">SOBRE NÓS</a>
            <a href="#depoimentos">DEPOIMENTOS</a>
            <a href="/register">CADASTRO</a>
            <a href="/login">LOGIN</a>
            <a href="#contato">CONTATO</a>
        </nav>
    </header>

    <main>
        <!-- Sobre Nós-->
        <section class="sobre" id="sobre">
            <div class="container-sobre">
                <div class="texto-sobre">
                    <h2>Quem Somos Nós</h2>
                    <h4 class="subtitulo">Compartilhando amor, construindo futuros.</h4>
                    <p>
                        O Natal é tempo de esperança e renovação. Para muitas crianças em situação de vulnerabilidade,
                        essa época pode passar em silêncio — sem presentes,
                        sem ceia, sem o calor de uma família reunida. Mas com um gesto simples, você pode transformar
                        essa realidade e reacender sonhos que pareciam esquecidos. <br><br>

                        Ao apadrinhar uma criança, você oferece mais do que um presente. Você entrega carinho, atenção e
                        a certeza de que ela importa. Com ações, você diz que o mundo pode ser mais gentil, que ela
                        merece sonhar e ser lembrada.
                        A solidariedade é a ponte entre quem pode ajudar e quem precisa ser acolhido — e quando essa
                        ponte é feita com amor, ela sustenta memórias que duram para sempre. <br><br>

                        O Natal do Bem é uma iniciativa social que conecta corações: o de quem quer ajudar e o de quem
                        mais precisa.
                        Aproximamos doadores e crianças em situação de vulnerabilidade, oferecendo uma forma segura e
                        acolhedora de tornar o Natal um momento de inclusão, empatia e afeto. <br><br>

                        Por meio de cartinhas, doações e apadrinhamentos, o projeto realiza pequenos sonhos e espalha o
                        verdadeiro espírito natalino. Seja luz no Natal de uma criança.
                        Doe afeto, espalhe esperança — e descubra que o maior presente é ver um sorriso nascer.
                    </p>
                </div>
            </div>
        </section>
        <!-- Seção Empresa -->
        <section class="institucional" id="institucional">
            <h2>Princípios que nos Guiam.</h2>
            <div class="cards">
                <div class="card">
                    <h3>Missão</h3>
                    <p>
                        Levar alegria, esperança e solidariedade a crianças em situação de vulnerabilidade,
                        proporcionando uma experiência de Natal verdadeiramente significativa e transformadora.
                    </p>
                </div>
                <div class="card">
                    <h3>Visão</h3>
                    <p>
                        Ser reconhecida como uma referência nacional em ações de solidariedade e inclusão social,
                        inspirando pessoas e empresas a cultivar o espírito natalino durante todo o ano.
                    </p>
                </div>
                <div class="card">
                    <h3>Valores</h3>
                    <ul>
                        <li>Empatia e solidariedade</li>
                        <li>Inclusão social e acessibilidade</li>
                        <li>Transparência e responsabilidade</li>
                        <li>Ética e compromisso com o bem</li>
                        <li>Amor e esperança compartilhada</li>
                    </ul>
                </div>
            </div>
        </section>

        <!-- Seção Depoimentos -->
        <section class="depoimentos" id="depoimentos">
            <h2>Depoimentos.</h2>
            <p class="subtitulo">Histórias reais de quem recebeu e transformou o Natal com amor.</p>

            <div class="slider">
                <div class="slide ativo">
                    <blockquote>
                        “Quando fui apadrinhado, passei algo bom adiante sem desaguar...<br>
                        Apadrinhei outro ser para que ele possa ser útil, para que ele possa amar,<br>
                        e outro alguém também possa sentir esse amor que recebi.”
                    </blockquote>
                    <p class="autor">– Carlos Henrique</p>
                </div>

                <div class="slide">
                    <blockquote>
                        “O Natal do Bem me ensinou que a magia não vem das luzes ou dos presentes, mas dos encontros.”
                    </blockquote>
                    <p class="autor">– Juliana Ribeiro</p>
                </div>

                <div class="slide">
                    <blockquote>
                        “Quando li a cartinha da Maria, não consegui segurar as lágrimas.”
                    </blockquote>
                    <p class="autor">– Ana Paula</p>
                </div>
            </div>
    </main>


    <!-- Contato -->
    <section class="contato" id="contato">
        <div class="container">
            <div class="info-contato">
                <h2>Contato.</h2>
                <p>Entre em contato conosco ou envie um e-mail para <br><strong>nataldobem.com</strong></p>
                <p>Se preferir, preencha o formulário ao lado.</p>
            </div>

            <form class="formulario">
                <input type="text" placeholder="Nome" required>
                <input type="email" placeholder="Email" required>
                <input type="tel" placeholder="Telefone">
                <textarea placeholder="Digite sua mensagem aqui..." required></textarea>
                <button type="submit">Enviar</button>
            </form>
        </div>
    </section>

    <button id="btn-topo" title="Voltar ao topo">↑</button>

    <!-- Botao topo-->
    <script>
        const btnTopo = document.getElementById("btn-topo");

        btnTopo.addEventListener("click", () => {
            window.scrollTo({ top: 0, behavior: "smooth" });
        });
    </script>

    <!-- Cadastro de usuario -->
    <script>
        document.querySelector(".form-cadastro").addEventListener("submit", async function (e) {
            e.preventDefault();
            
            let formData = new FormData();
            formData.append("nome", document.getElementById("nome").value);
            formData.append("idade", document.getElementById("idade").value);
            formData.append("email", document.getElementById("email").value);
            formData.append("senha", document.getElementById("senha").value);
            formData.append("tipo", document.getElementById("tipo").value);
            formData.append("endereco", document.getElementById("endereco").value);
            formData.append("telefone", document.getElementById("telefone").value);

            try {
                let req = await fetch("backend/cadastrar_usuario.php", { method: "POST", body: formData });
                let res = await req.json();

                if (res.status == "success") {
                    alert("Cadastro realizado com sucesso! Faça login para continuar.");
                    window.location.href = "/login";
            <button type="submit">Entrar</button>
                } else {
                    alert("Erro ao cadastrar: " + (res.mensagem || "Tente novamente"));
                }
            } catch (error) {
                alert("Erro ao realizar cadastro. Verifique sua conexão.");
            }
        });
    </script>

    <footer class="footer">
        <div class="container-footer">
            <div class="coluna-footer">
                <h3>Natal do Bem</h3>
                <p>
                    Espalhando esperança e amor através da solidariedade.<br>
                    Faça parte dessa corrente do bem.
                </p>
            </div>

            <div class="coluna-footer">
                <h4>Links Rápidos</h4>
                <ul>
                    <li><a href="/#sobre">Sobre Nós</a></li>
                    <li><a href="/#depoimentos">Depoimentos</a></li>
                    <li><a href="/#cadastro">Cadastro</a></li>
                    <li><a href="/login">Login</a></li>
                    <li><a href="/#contato">Contato</a></li>
                </ul>
            </div>

            <div class="coluna-footer">
                <h4>Contato</h4>
                <p>Email: <a href="mailto:nataldobem@gmail.com">nataldobem@gmail.com</a></p>
                <p>Telefone: (11) 99999-9999</p>
                <p>Endereço: São Paulo - SP</p>
            </div>
        </div>

        <div class="copy">
            <p>&copy; 2025 Natal do Bem. Todos os direitos reservados.</p>
        </div>
    </footer>

</body>

</html>