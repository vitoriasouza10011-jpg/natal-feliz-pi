PRAGMA foreign_keys = ON;

CREATE TABLE usuarios (
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


-- cartas definition

CREATE TABLE "cartas" (
    id_carta INTEGER PRIMARY KEY,
    id_crianca INTEGER,
    titulo TEXT,
    conteudo TEXT,
    status TEXT CHECK(status IN ('aguardando','adotada','entregue','agradecida')),
    mensagem_agradecimento TEXT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- doacoes definition

CREATE TABLE doacoes (
    id_doacao INTEGER PRIMARY KEY AUTOINCREMENT,
    id_doador INTEGER NOT NULL,
    id_carta INTEGER NOT NULL UNIQUE,
    valor REAL,
    metodo_pagamento TEXT,
    mensagem_doador TEXT,
    data_doacao DATETIME DEFAULT CURRENT_TIMESTAMP,
    status TEXT NOT NULL DEFAULT 'confirmada'
        CHECK (status IN ('confirmada','entregue')), entregue BOOLEAN DEFAULT 0,
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
