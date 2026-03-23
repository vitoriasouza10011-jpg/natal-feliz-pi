<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Minha Carta - Natal Feliz Solidário</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-green-50 min-h-screen flex items-center justify-center p-4">

    <div class="bg-white shadow-2xl rounded-2xl max-w-xl w-full p-8">

        <h1 class="text-3xl font-bold text-center text-green-700 mb-4">
            🎄 Minha Carta
        </h1>

        <?php if (!$carta): ?>

            <p class="text-center text-gray-600">
                Você ainda não criou uma carta.
            </p>

            <a href="/criar-carta" class="block text-center mt-4 bg-green-600 text-white py-2 rounded-lg">
                Criar Carta ✉️
            </a>

        <?php else: ?>

            <!-- Carta -->
            <div class="bg-green-50 rounded-xl p-6 shadow-inner">

                <h2 class="text-xl font-bold text-green-700 mb-2">
                    <?= htmlspecialchars($carta['titulo']) ?>
                </h2>

                <p class="text-gray-700 mb-4 whitespace-pre-line">
                    <?= htmlspecialchars($carta['conteudo']) ?>
                </p>

                <!-- Status -->
                <div class="mb-4">
                    <?php if ($carta['status'] === 'aguardando'): ?>
                        <span class="bg-yellow-200 text-yellow-800 px-3 py-1 rounded-full text-sm">
                            ⏳ Aguardando adoção
                        </span>

                    <?php elseif ($carta['status'] === 'adotada'): ?>
                        <span class="bg-blue-200 text-blue-800 px-3 py-1 rounded-full text-sm">
                            🎁 Adotada
                        </span>

                    <?php elseif ($carta['status'] === 'entregue'): ?>
                        <span class="bg-green-200 text-green-800 px-3 py-1 rounded-full text-sm">
                            ✅ Entregue
                        </span>

                    <?php elseif ($carta['status'] === 'agradecida'): ?>
                        <span class="bg-purple-200 text-purple-800 px-3 py-1 rounded-full text-sm">
                            💌 Agradecida
                        </span>
                    <?php endif; ?>
                </div>

            </div>

            <!-- AÇÕES -->
            <div class="mt-6 space-y-4">

                <!-- 🎁 CONFIRMAR ENTREGA -->
                <?php if ($carta['status'] === 'adotada'): ?>
                    <form method="POST" action="/cartas/<?= $carta['id_carta'] ?>/entregar">
                        <button class="w-full bg-green-600 text-white py-3 rounded-lg hover:bg-green-700">
                            Confirmar recebimento 🎁
                        </button>
                    </form>
                <?php endif; ?>

                <!-- 💌 AGRADECIMENTO -->
                <?php if ($carta['status'] === 'entregue'): ?>
                    <form method="POST" action="/cartas/<?= $carta['id_carta'] ?>/agradecer">

                        <textarea name="mensagem" required placeholder="Escreva uma mensagem de agradecimento..."
                            class="w-full border rounded-lg p-3 mb-3"></textarea>

                        <button class="w-full bg-purple-600 text-white py-3 rounded-lg hover:bg-purple-700">
                            Enviar agradecimento 💌
                        </button>

                    </form>
                <?php endif; ?>

                <!-- 💌 MOSTRAR AGRADECIMENTO -->
                <?php if ($carta['status'] === 'agradecida'): ?>
                    <div class="bg-purple-50 p-4 rounded-lg">
                        <p class="text-purple-800 font-semibold mb-1">Mensagem enviada:</p>
                        <p class="text-gray-700">
                            <?= htmlspecialchars($carta['mensagem_agradecimento']) ?>
                        </p>
                    </div>
                <?php endif; ?>

            </div>

        <?php endif; ?>

    </div>

</body>

</html>