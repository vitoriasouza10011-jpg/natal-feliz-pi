-- Script SQL final - Natal Solidário (2025) - Com mensagens personalizadas
CREATE TABLE IF NOT EXISTS Usuarios (
    id_usuario INTEGER PRIMARY KEY AUTOINCREMENT,
    nome TEXT NOT NULL,
    idade INTEGER,
    email TEXT UNIQUE NOT NULL,
    senha TEXT NOT NULL,
    tipo TEXT CHECK(tipo IN ('crianca', 'doador')) NOT NULL,
    endereco TEXT,
    telefone TEXT
);

CREATE TABLE IF NOT EXISTS Cartas (
    id_carta INTEGER PRIMARY KEY AUTOINCREMENT,
    id_crianca INTEGER NOT NULL,
    titulo TEXT NOT NULL,
    conteudo TEXT NOT NULL,
    mensagem_agradecimento TEXT, -- mensagem opcional deixada pela crianca/responsavel
    data_criacao DATETIME DEFAULT CURRENT_TIMESTAMP,
    status TEXT CHECK(status IN ('aguardando','adotada','entregue')) DEFAULT 'aguardando',
    FOREIGN KEY (id_crianca) REFERENCES Usuarios(id_usuario)
);

CREATE TABLE IF NOT EXISTS Doacoes (
    id_doacao INTEGER PRIMARY KEY AUTOINCREMENT,
    id_doador INTEGER NOT NULL,
    id_carta INTEGER NOT NULL,
    valor REAL,
    metodo_pagamento TEXT,
    mensagem_doador TEXT, -- mensagem opcional deixada pelo doador ao adotar
    data_doacao DATETIME DEFAULT CURRENT_TIMESTAMP,
    status TEXT CHECK(status IN ('entregue')) DEFAULT 'entregue',
    FOREIGN KEY (id_doador) REFERENCES Usuarios(id_usuario),
    FOREIGN KEY (id_carta) REFERENCES Cartas(id_carta)
);
