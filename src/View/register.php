<main>
    <section class="cadastro" id="cadastro">
        <div class="container-form">
            <h2>Cadastro de Usuário</h2>
            <p class="descricao">
                Preencha as informações abaixo para participar do projeto <strong>Natal do Bem</strong>.
            </p>

            <form class="form-cadastro" method="post" action="/auth/register">

                <label for="nome">Nome completo:</label>
                <input type="text" id="nome" name="nome" placeholder="Digite seu nome completo" required>

                <label for="idade">Idade:</label>
                <input type="number" id="idade" name="idade" min="0" placeholder="Ex: 10" required>

                <label for="email">E-mail:</label>
                <input type="email" id="email" name="email" placeholder="exemplo@email.com" required>

                <label for="senha">Senha:</label>
                <input type="password" id="senha" name="senha" placeholder="Crie uma senha" required>

                <label for="tipo">Tipo de usuário:</label>
                <select id="tipo" name="tipo" required>
                    <option value="">Selecione...</option>
                    <option value="crianca">Criança / Responsável</option>
                    <option value="doador">Doador</option>
                </select>

                <label for="endereco">Endereço:</label>
                <textarea id="endereco" name="endereco" rows="3" placeholder="Digite seu endereço completo" required></textarea>

                <label for="telefone">Telefone:</label>
                <input type="text" id="telefone" name="telefone" placeholder="(XX) XXXXX-XXXX" required>

                <button type="submit" class="btn-cadastrar">Cadastrar</button>

                <div class="link-login">
                    <p>Já tem uma conta? <a href="/login">Entrar</a></p>
                </div>

            </form>
        </div>
    </section>
</main>