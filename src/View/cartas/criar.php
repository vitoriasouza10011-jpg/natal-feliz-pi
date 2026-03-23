<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Criar Carta - Natal Feliz Solidário</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-green-50 min-h-screen flex items-center justify-center p-4">

  <div class="bg-white shadow-2xl rounded-2xl max-w-lg w-full p-8">

    <!-- Cabeçalho -->
    <h1 class="text-3xl font-bold text-center text-green-700 mb-2">
      🎄 Natal Feliz Solidário
    </h1>

    <p class="text-center text-gray-600 mb-6">
      Escreva sua cartinha com carinho ✉️
    </p>

    <form method="POST" action="/cartas" class="space-y-5">

      <!-- Título -->
      <div>
        <label class="block text-sm font-semibold text-gray-700">Título da carta</label>
        <input 
          type="text" 
          name="titulo" 
          required 
          placeholder="Ex: Meu pedido de Natal"
          class="w-full mt-1 px-4 py-2 border rounded-lg focus:ring-2 focus:ring-green-400 outline-none"
        >
      </div>

      <!-- Conteúdo -->
      <div>
        <label class="block text-sm font-semibold text-gray-700">Mensagem</label>
        <textarea 
          name="conteudo" 
          rows="6" 
          required 
          placeholder="Ex: Querido Papai Noel, eu gostaria de..."
          class="w-full mt-1 px-4 py-3 border rounded-lg focus:ring-2 focus:ring-green-400 outline-none resize-none"
        ></textarea>
      </div>

      <!-- Botão -->
      <button 
        type="submit" 
        class="w-full bg-green-600 text-white font-semibold py-3 rounded-lg hover:bg-green-700 transition shadow-md"
      >
        ✉️ Enviar Carta
      </button>

      <!-- Ação extra -->
      <a href="/minha-carta" 
         class="block text-center text-sm text-gray-600 hover:text-green-600 transition">
        ← Ver minha carta
      </a>

    </form>
  </div>

</body>
</html>