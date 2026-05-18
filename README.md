# Natal Feliz - Sistema de Cartas de Natal

## 📖 Sobre o Projeto

O **Natal Feliz** é uma plataforma web que conecta crianças e doadores em um ambiente seguro e acolhedor, permitindo que crianças escrevam suas cartinhas de Natal e doadores as adotem para realizar seus desejos.

O sistema gerencia todo o fluxo: desde a criação da carta pela criança, passando pela adoção por um doador, até a confirmação de entrega e o agradecimento final.

---

## 👥 Autores

| Nome |
|------|
| Henrique Ribeiro Velloso |
| Leticia Oliveira Murat |
| Pedro Gabriel Faria Vieira |
| Gabriel Costa Prado |
| Thaynata Teixeira da Silva |
| Vitoria Souza Alves da Silva |
| Nicolas Pantoja Bandeira |

---

## 🚀 Tecnologias Utilizadas

- **PHP 8.0+**
- **Slim Framework 4** - Micro-framework para rotas e middleware
- **PHP-DI** - Container de injeção de dependências
- **SQLite** - Banco de dados leve e embarcado
- **Composer** - Gerenciador de dependências

---

## 📁 Estrutura do Projeto

```
natal-feliz-pi-v2/
├── public/
│   └── index.php              # Entry point da aplicação
├── src/
│   ├── Controllers/           # Controladores da aplicação
│   │   ├── AuthController.php
│   │   ├── CartaController.php
│   │   ├── DoacaoController.php
│   │   └── HomeController.php
│   ├── Models/                # Modelos de dados
│   │   ├── User.php
│   │   ├── Carta.php
│   │   └── Doacao.php
│   ├── Database/              # Configuração do banco
│   │   └── Database.php
│   └── Helpers/               # Classes auxiliares
│       └── View.php
├── routes/
│   └── web.php                # Definição das rotas
├── database/
│   └── database.sqlite        # Arquivo do banco de dados
├── views/                     # Templates HTML
├── composer.json
└── composer.lock
```

---

## 🗄️ Estrutura do Banco de Dados

### Tabela `usuarios`
| Campo | Tipo | Descrição |
|-------|------|-----------|
| id_usuario | INTEGER PRIMARY KEY | Identificador único |
| nome | TEXT | Nome completo |
| idade | INTEGER | Idade |
| email | TEXT (UNIQUE) | E-mail para login |
| senha | TEXT | Hash da senha |
| tipo | TEXT | `crianca`, `doador` ou `admin` |
| endereco | TEXT | Endereço (opcional) |
| telefone | TEXT | Telefone (opcional) |

### Tabela `cartas`
| Campo | Tipo | Descrição |
|-------|------|-----------|
| id_carta | INTEGER PRIMARY KEY | Identificador único |
| id_crianca | INTEGER FK | Referência ao usuário criança |
| titulo | TEXT | Título da cartinha |
| conteudo | TEXT | Conteúdo da carta |
| status | TEXT | `aguardando`, `adotada`, `entregue`, `agradecida` |
| mensagem_agradecimento | TEXT | Mensagem de agradecimento |
| created_at | TIMESTAMP | Data de criação |

### Tabela `doacoes`
| Campo | Tipo | Descrição |
|-------|------|-----------|
| id_doacao | INTEGER PRIMARY KEY | Identificador único |
| id_doador | INTEGER FK | Referência ao doador |
| id_carta | INTEGER FK | Referência à carta adotada |
| entregue | BOOLEAN | Indica se foi entregue |

---

## 🔄 Fluxo da Aplicação

### 👶 Para Crianças
1. **Cadastro** como tipo `crianca`
2. **Criação da carta** - Cada criança pode ter apenas uma carta ativa
3. **Acompanhamento** - Visualiza o status da sua carta
4. **Confirmação de entrega** - Quando receber o presente
5. **Agradecimento** - Envia mensagem de agradecimento ao doador

### 🎅 Para Doadores
1. **Cadastro** como tipo `doador`
2. **Visualização** - Lista todas as cartas disponíveis (`aguardando`)
3. **Adoção** - Escolhe uma carta para realizar o desejo
4. **Status muda** para `adotada`

### 📊 Status das Cartas
| Status | Significado |
|--------|-------------|
| `aguardando` | Carta criada, aguardando adoção |
| `adotada` | Carta foi adotada, aguardando entrega |
| `entregue` | Presente entregue, aguardando agradecimento |
| `agradecida` | Criança já agradeceu, ciclo concluído |

---

## 🛠️ Instalação e Configuração

### Pré-requisitos
- PHP 8.0 ou superior
- Composer
- Extensão PDO SQLite habilitada

### Passos

1. **Clone o repositório**
```bash
git clone https://github.com/seu-usuario/natal-feliz-pi-v2.git
cd natal-feliz-pi-v2
```

2. **Instale as dependências**
```bash
composer install
```

3. **Configure o banco de dados**
```bash
# Crie o diretório database se não existir
mkdir -p database

# O arquivo database.sqlite será criado automaticamente na primeira execução
```

4. **Crie as tabelas** (execute no terminal interativo do PHP ou via script)
```sql
-- Tabela usuarios
CREATE TABLE usuarios (
    id_usuario INTEGER PRIMARY KEY AUTOINCREMENT,
    nome TEXT NOT NULL,
    idade INTEGER,
    email TEXT UNIQUE NOT NULL,
    senha TEXT NOT NULL,
    tipo TEXT CHECK(tipo IN ('crianca', 'doador', 'admin')) NOT NULL,
    endereco TEXT,
    telefone TEXT
);

-- Tabela cartas
CREATE TABLE cartas (
    id_carta INTEGER PRIMARY KEY AUTOINCREMENT,
    id_crianca INTEGER NOT NULL,
    titulo TEXT NOT NULL,
    conteudo TEXT NOT NULL,
    status TEXT CHECK(status IN ('aguardando', 'adotada', 'entregue', 'agradecida')) DEFAULT 'aguardando',
    mensagem_agradecimento TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_crianca) REFERENCES usuarios(id_usuario)
);

-- Tabela doacoes
CREATE TABLE doacoes (
    id_doacao INTEGER PRIMARY KEY AUTOINCREMENT,
    id_doador INTEGER NOT NULL,
    id_carta INTEGER NOT NULL,
    entregue BOOLEAN DEFAULT 0,
    FOREIGN KEY (id_doador) REFERENCES usuarios(id_usuario),
    FOREIGN KEY (id_carta) REFERENCES cartas(id_carta)
);
```

5. **Configure o servidor web**
```bash
# Usando o servidor embutido do PHP
php -S localhost:8000 -t public
```

6. **Acesse a aplicação**
```
http://localhost:8000
```

---

## 📋 Rotas da Aplicação

| Método | Rota | Descrição |
|--------|------|-----------|
| GET | `/` | Página inicial |
| GET | `/login` | Tela de login |
| GET | `/register` | Tela de cadastro |
| POST | `/login` | Processa login |
| POST | `/register` | Processa cadastro |
| GET | `/criar-carta` | Formulário para criar carta (criança) |
| POST | `/criar-carta` | Salva nova carta |
| GET | `/minha-carta` | Visualiza própria carta (criança) |
| GET | `/cartas-view` | Lista cartas disponíveis (doador) |
| GET | `/api/cartas` | API - Lista cartas disponíveis |
| POST | `/doacao/adotar/{id}` | Adota uma carta |
| POST | `/carta/confirmar-entrega/{id}` | Confirma entrega (criança) |
| POST | `/carta/agradecer/{id}` | Envia agradecimento |

---

## 🔐 Segurança

- **Senhas** armazenadas com `password_hash()` (bcrypt)
- **Sessões** gerenciadas via `session_start()`
- **Validação de permissões** por tipo de usuário em cada rota
- **SQL Injection** prevenido com prepared statements

---

## 🧪 Possíveis Melhorias Futuras

- [ ] Interface gráfica com Bootstrap/Tailwind
- [ ] Envio de e-mails para notificações
- [ ] Dashboard administrativo
- [ ] Upload de imagens (fotos dos presentes)
- [ ] Chat entre doador e criança
- [ ] Relatórios de adoções
- [ ] Testes automatizados (PHPUnit)

---

## 📄 Licença

Projeto acadêmico desenvolvido para fins educacionais.