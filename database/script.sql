PRAGMA foreign_keys = ON;

-- =========================
-- TABELA DE USUÁRIOS
-- =========================
CREATE TABLE IF NOT EXISTS usuarios (
    id_usuario INTEGER PRIMARY KEY AUTOINCREMENT,
    nome TEXT NOT NULL,
    idade INTEGER,
    email TEXT NOT NULL UNIQUE,
    senha TEXT NOT NULL,
    tipo TEXT NOT NULL CHECK (tipo IN ('crianca','doador','admin')),
    endereco TEXT,
    telefone TEXT,
    data_criacao DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- =========================
-- TABELA DE CARTAS
-- =========================
CREATE TABLE IF NOT EXISTS cartas (
    id_carta INTEGER PRIMARY KEY AUTOINCREMENT,
    id_crianca INTEGER NOT NULL,
    titulo TEXT NOT NULL,
    conteudo TEXT NOT NULL,
    mensagem_agradecimento TEXT,
    data_criacao DATETIME DEFAULT CURRENT_TIMESTAMP,
    status TEXT NOT NULL DEFAULT 'aguardando'
        CHECK (status IN ('aguardando','adotada','entregue')),
    FOREIGN KEY (id_crianca) REFERENCES usuarios(id_usuario)
);

-- =========================
-- TABELA DE DOAÇÕES
-- =========================
CREATE TABLE IF NOT EXISTS doacoes (
    id_doacao INTEGER PRIMARY KEY AUTOINCREMENT,
    id_doador INTEGER NOT NULL,
    id_carta INTEGER NOT NULL UNIQUE,
    valor REAL,
    metodo_pagamento TEXT,
    mensagem_doador TEXT,
    data_doacao DATETIME DEFAULT CURRENT_TIMESTAMP,
    status TEXT NOT NULL DEFAULT 'confirmada'
        CHECK (status IN ('confirmada','entregue')),
    FOREIGN KEY (id_doador) REFERENCES usuarios(id_usuario),
    FOREIGN KEY (id_carta) REFERENCES cartas(id_carta)
);

-- =========================
-- ÍNDICES PARA PERFORMANCE
-- =========================
CREATE INDEX IF NOT EXISTS idx_cartas_status 
ON cartas(status);

CREATE INDEX IF NOT EXISTS idx_cartas_crianca 
ON cartas(id_crianca);

CREATE INDEX IF NOT EXISTS idx_doacoes_doador 
ON doacoes(id_doador);

CREATE INDEX IF NOT EXISTS idx_doacoes_carta 
ON doacoes(id_carta);
