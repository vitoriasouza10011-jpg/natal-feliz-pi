<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Cartas Disponíveis - Natal Feliz Solidário</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-green-50 min-h-screen p-4">

    <!-- Header -->
    <div class="max-w-6xl mx-auto mb-8 text-center">
        <h1 class="text-3xl font-bold text-green-700">
            🎄 Cartas Disponíveis
        </h1>
        <p class="text-gray-600 mt-2">
            Escolha uma cartinha e transforme o Natal de uma criança ✨
        </p>
    </div>

    <!-- Grid -->
    <div id="cartas" class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6"></div>
    <div id="alerta" class="max-w-6xl mx-auto mb-4"></div>

    <script>

        const params = new URLSearchParams(window.location.search);
        const alerta = document.getElementById('alerta');

        if (params.get('sucesso') === 'adotada') {
            alerta.innerHTML = `
            <div class="bg-green-100 text-green-700 p-4 rounded-lg shadow">
                🎉 Carta adotada com sucesso! Obrigado por espalhar alegria.
            </div>
        `;
        }

        if (params.get('erro') === 'ja_adotada') {
            alerta.innerHTML = `
            <div class="bg-red-100 text-red-700 p-4 rounded-lg shadow">
                ⚠️ Essa carta já foi adotada por outra pessoa.
            </div>
        `;
        }

        if (params.get('erro') === 'falha') {
            alerta.innerHTML = `
            <div class="bg-red-100 text-red-700 p-4 rounded-lg shadow">
                ❌ Erro ao adotar carta. Tente novamente.
            </div>
        `;
        }
        async function carregarCartas() {
            const response = await fetch('/cartas');
            const cartas = await response.json();
            const container = document.getElementById('cartas');
            container.innerHTML = '';
            cartas.forEach(carta => {
                const div = document.createElement('div');

                div.className = `
                bg-white p-6 rounded-2xl shadow-md 
                hover:shadow-xl transition duration-300 
                flex flex-col justify-between
                border border-green-100
            `;

                // 🎨 Status visual
                let statusColor = '';
                let statusText = '';

                if (carta.status === 'adotada') {
                    statusColor = 'bg-red-100 text-red-600';
                    statusText = '🎁 Adotada';
                } else {
                    statusColor = 'bg-green-100 text-green-700';
                    statusText = '✨ Disponível';
                }

                div.innerHTML = `
                <div>
                    <h3 class="text-xl font-bold text-green-700 mb-2">
                        ${carta.titulo}
                    </h3>

                    <p class="text-gray-700 mb-4 line-clamp-4">
                        ${carta.conteudo}
                    </p>
                </div>

                <div class="flex items-center justify-between mt-4">
                    
                    <span class="px-3 py-1 rounded-full text-xs font-semibold ${statusColor}">
                        ${statusText}
                    </span>

                    ${carta.status === 'aguardando' ? `
                        <form method="POST" action="/cartas/${carta.id_carta}/adotar">
                            <button type="submit" 
                                class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition shadow">
                                🎁 Adotar
                            </button>
                        </form>
                    ` : ''}
                </div>
            `;

                container.appendChild(div);
            });
        }

        carregarCartas();
    </script>

</body>

</html>