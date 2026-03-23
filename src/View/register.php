<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastro - Natal Feliz Solidário</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-green-50 min-h-screen flex items-center justify-center">

    <div class="bg-white shadow-2xl rounded-2xl w-full max-w-lg p-8">
        
        <h2 class="text-3xl font-bold text-center text-green-700 mb-2">
            🎄 Natal Feliz Solidário
        </h2>

        <p class="text-center text-gray-600 mb-6">
            Cadastre-se e participe do projeto
        </p>

        <form method="post" action="/register" class="space-y-4">

            <div>
                <label class="block text-sm font-semibold text-gray-700">Nome completo</label>
                <input type="text" name="nome" required
                    class="w-full mt-1 p-2 border rounded-lg focus:ring-2 focus:ring-green-400 outline-none"
                    placeholder="Digite seu nome completo">
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700">Idade</label>
                    <input type="number" name="idade" min="0" required
                        class="w-full mt-1 p-2 border rounded-lg focus:ring-2 focus:ring-green-400 outline-none"
                        placeholder="Ex: 10">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700">Telefone</label>
                    <input type="text" name="telefone" required
                        class="w-full mt-1 p-2 border rounded-lg focus:ring-2 focus:ring-green-400 outline-none"
                        placeholder="(XX) XXXXX-XXXX">
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700">E-mail</label>
                <input type="email" name="email" required
                    class="w-full mt-1 p-2 border rounded-lg focus:ring-2 focus:ring-green-400 outline-none"
                    placeholder="exemplo@email.com">
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700">Senha</label>
                <input type="password" name="senha" required
                    class="w-full mt-1 p-2 border rounded-lg focus:ring-2 focus:ring-green-400 outline-none"
                    placeholder="Crie uma senha">
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700">Tipo de usuário</label>
                <select name="tipo" required
                    class="w-full mt-1 p-2 border rounded-lg focus:ring-2 focus:ring-green-400 outline-none">
                    <option value="">Selecione...</option>
                    <option value="crianca">Criança / Responsável</option>
                    <option value="doador">Doador</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700">Endereço</label>
                <textarea name="endereco" rows="3" required
                    class="w-full mt-1 p-2 border rounded-lg focus:ring-2 focus:ring-green-400 outline-none"
                    placeholder="Digite seu endereço completo"></textarea>
            </div>

            <button type="submit"
                class="w-full bg-green-600 text-white py-2 rounded-lg font-semibold hover:bg-green-700 transition">
                Cadastrar
            </button>

            <p class="text-center text-sm text-gray-600">
                Já tem uma conta?
                <a href="/login" class="text-green-600 font-semibold hover:underline">
                    Entrar
                </a>
            </p>

        </form>
    </div>

</body>
</html>