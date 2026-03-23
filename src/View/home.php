<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-green-50 text-gray-800">

    <!-- HEADER -->
    <header class="bg-white shadow-md fixed w-full top-0 z-50">
        <div class="max-w-6xl mx-auto flex justify-between items-center p-4">
            <h1 class="text-xl font-bold text-green-700"><?= $title ?></h1>
            <nav class="space-x-6 text-sm font-semibold">
                <a href="#sobre" class="hover:text-green-600">Sobre</a>
                <a href="#depoimentos" class="hover:text-green-600">Depoimentos</a>
                <a href="/register" class="hover:text-green-600">Cadastro</a>
                <a href="/login" class="hover:text-green-600">Login</a>
                <a href="#contato" class="hover:text-green-600">Contato</a>
            </nav>
        </div>
    </header>

    <!-- ESPAÇO HEADER -->
    <div class="h-20"></div>

    <!-- SOBRE -->
    <section id="sobre" class="py-16">
        <div class="max-w-4xl mx-auto text-center px-4">
            <h2 class="text-3xl font-bold text-green-700 mb-4">Quem Somos</h2>
            <p class="text-gray-600 leading-relaxed">
                O Natal do Bem conecta doadores e crianças em situação de vulnerabilidade,
                transformando sonhos em realidade através de gestos simples de amor e solidariedade.
                <br><br>
                Ao apadrinhar uma criança, você entrega mais do que um presente: oferece esperança,
                carinho e um futuro mais acolhedor.
            </p>
        </div>
    </section>

    <!-- PRINCÍPIOS -->
    <section id="institucional" class="py-16 bg-white">
        <div class="max-w-6xl mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold text-green-700 mb-10">Nossos Princípios</h2>

            <div class="grid md:grid-cols-3 gap-6">

                <div class="bg-green-50 p-6 rounded-xl shadow">
                    <h3 class="font-bold text-lg mb-2">Missão</h3>
                    <p class="text-sm text-gray-600">
                        Levar alegria e esperança a crianças através do espírito natalino.
                    </p>
                </div>

                <div class="bg-green-50 p-6 rounded-xl shadow">
                    <h3 class="font-bold text-lg mb-2">Visão</h3>
                    <p class="text-sm text-gray-600">
                        Ser referência em solidariedade e inclusão social.
                    </p>
                </div>

                <div class="bg-green-50 p-6 rounded-xl shadow">
                    <h3 class="font-bold text-lg mb-2">Valores</h3>
                    <ul class="text-sm text-gray-600 space-y-1">
                        <li>Empatia</li>
                        <li>Transparência</li>
                        <li>Amor</li>
                        <li>Inclusão</li>
                    </ul>
                </div>

            </div>
        </div>
    </section>

    <!-- DEPOIMENTOS -->
    <section id="depoimentos" class="py-16">
        <div class="max-w-4xl mx-auto text-center px-4">
            <h2 class="text-3xl font-bold text-green-700 mb-4">Depoimentos</h2>
            <p class="text-gray-500 mb-8">Histórias reais de transformação</p>

            <div class="space-y-6">

                <div class="bg-white p-6 rounded-xl shadow">
                    <p class="italic">
                        “Quando fui apadrinhado, senti que alguém acreditava em mim.”
                    </p>
                    <span class="block mt-2 font-semibold">– Carlos Henrique</span>
                </div>

                <div class="bg-white p-6 rounded-xl shadow">
                    <p class="italic">
                        “A magia do Natal está no amor compartilhado.”
                    </p>
                    <span class="block mt-2 font-semibold">– Juliana Ribeiro</span>
                </div>

            </div>
        </div>
    </section>

    <!-- CONTATO -->
    <section id="contato" class="py-16 bg-white">
        <div class="max-w-6xl mx-auto grid md:grid-cols-2 gap-10 px-4">

            <div>
                <h2 class="text-3xl font-bold text-green-700 mb-4">Contato</h2>
                <p class="text-gray-600 mb-4">
                    Entre em contato conosco ou envie um e-mail para:
                </p>
                <p class="font-semibold text-green-700">nataldobem@gmail.com</p>
            </div>

            <form class="space-y-4">
                <input type="text" placeholder="Nome" required
                    class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-green-400 outline-none">

                <input type="email" placeholder="Email" required
                    class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-green-400 outline-none">

                <textarea placeholder="Mensagem" required
                    class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-green-400 outline-none"></textarea>

                <button class="w-full bg-green-600 text-white py-2 rounded-lg hover:bg-green-700 transition">
                    Enviar
                </button>
            </form>

        </div>
    </section>

    <!-- BOTÃO TOPO -->
    <button onclick="window.scrollTo({top:0, behavior:'smooth'})"
        class="fixed bottom-5 right-5 bg-green-600 text-white px-3 py-2 rounded-full shadow-lg hover:bg-green-700">
        ↑
    </button>

    <!-- FOOTER -->
    <footer class="bg-green-700 text-white mt-10">
        <div class="max-w-6xl mx-auto grid md:grid-cols-3 gap-6 p-6">

            <div>
                <h3 class="font-bold mb-2">Natal do Bem</h3>
                <p class="text-sm">
                    Espalhando esperança e amor.
                </p>
            </div>

            <div>
                <h4 class="font-semibold mb-2">Links</h4>
                <ul class="text-sm space-y-1">
                    <li><a href="#sobre">Sobre</a></li>
                    <li><a href="/login">Login</a></li>
                    <li><a href="/register">Cadastro</a></li>
                </ul>
            </div>

            <div>
                <h4 class="font-semibold mb-2">Contato</h4>
                <p class="text-sm">nataldobem@gmail.com</p>
            </div>

        </div>

        <div class="text-center text-sm py-3 bg-green-800">
            © 2025 Natal do Bem
        </div>
    </footer>

</body>
</html>