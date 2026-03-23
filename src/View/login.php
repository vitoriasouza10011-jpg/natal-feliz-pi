<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Login - Natal Feliz Solidário</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-green-50 min-h-screen flex items-center justify-center">

    <div class="bg-white shadow-2xl rounded-2xl w-full max-w-md p-8">

        <!-- Título -->
        <h1 class="text-3xl font-bold text-center text-green-700 mb-2">
            🎄 Natal Feliz Solidário
        </h1>

        <p class="text-center text-gray-600 mb-6">
            Entre na sua conta
        </p>

        <!-- Formulário -->
        <form action="/login" method="POST" class="space-y-5">

            <!-- Email -->
            <div>
                <label class="block text-sm font-semibold text-gray-700">E-mail</label>
                <input 
                    type="email" 
                    name="email" 
                    required
                    placeholder="exemplo@email.com"
                    class="w-full mt-1 px-4 py-2 border rounded-lg focus:ring-2 focus:ring-green-400 outline-none"
                >
            </div>

            <!-- Senha -->
            <div>
                <label class="block text-sm font-semibold text-gray-700">Senha</label>
                <input 
                    type="password" 
                    name="senha" 
                    required
                    placeholder="Digite sua senha"
                    class="w-full mt-1 px-4 py-2 border rounded-lg focus:ring-2 focus:ring-green-400 outline-none"
                >
            </div>

            <!-- Botão -->
            <button 
                type="submit"
                class="w-full bg-green-600 text-white font-semibold py-2 rounded-lg hover:bg-green-700 transition shadow-md"
            >
                Entrar
            </button>

            <!-- Links -->
            <div class="text-center text-sm text-gray-600">
                <p>
                    Não tem conta?
                    <a href="/register" class="text-green-600 font-semibold hover:underline">
                        Cadastre-se
                    </a>
                </p>
            </div>

        </form>

    </div>

</body>
</html>