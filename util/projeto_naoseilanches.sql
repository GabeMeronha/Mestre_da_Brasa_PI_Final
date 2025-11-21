php -S localhost:8000 -t publicphp -S localhost:8000 -t public CREATE DATABASE IF NOT EXISTS projeto_naoseilanches 
	CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

SHOW DATABASES;

USE projeto_naoseilanches;

CREATE TABLE usuarios (
    id_usuario BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY, -- identificador único
    nome VARCHAR(255) NOT NULL, -- nome completo do usuário
    cpf VARCHAR(14), -- CPF no formato 000.000.000-00
    data_nascimento DATE, -- data no formato yyyy-mm-dd
    celular VARCHAR(20), -- celular com DDD
    rua VARCHAR(255), -- nome da rua
    numero VARCHAR(10), -- número da residência
    complemento VARCHAR(50), -- complemento (ex: apto)
    bairro VARCHAR(255), -- bairro
    cidade VARCHAR(255), -- cidade
    cep VARCHAR(10), -- CEP
    estado CHAR(2), -- estado (ex: SP, RJ)
    email VARCHAR(255) NOT NULL, -- e-mail válido
    tipo ENUM('Administrador', 'Funcionário', 'Cliente') NOT NULL, -- tipo de usuário
    senha VARCHAR(255) NOT NULL, -- senha criptografada
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, -- data de criação
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, -- data de alteração
    deleted_at TIMESTAMP NULL DEFAULT NULL -- marcação de exclusão lógica
);
 
CREATE TABLE produtos (
    id_produto BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    descricao TEXT,
    preco DECIMAL(10,2) NOT NULL,
    quantidade_estoque INT UNSIGNED NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    deleted_at TIMESTAMP NULL DEFAULT NULL
);
 
CREATE TABLE vendas (
    id_venda BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    id_usuario BIGINT UNSIGNED NOT NULL,
    cliente_nome VARCHAR(255) NOT NULL,
    cpf VARCHAR(14),
    id_produto BIGINT UNSIGNED NOT NULL,
    quantidade INT UNSIGNED NOT NULL,
    data_venda DATE NOT NULL,
    forma_pagamento ENUM('Dinheiro', 'Cartão', 'Pix') NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    deleted_at TIMESTAMP NULL DEFAULT NULL,
    -- Relação com a tabela de produtos
    FOREIGN KEY (id_produto) REFERENCES produtos(id_produto)
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario)
);
 
CREATE TABLE IF NOT EXISTS forma_pagamentos(
	id_forma_pagamento INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    descricao varchar(100) not null,
    taxa decimal(5,2),
    desconto decimal(5,2),
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    deleted_at TIMESTAMP NULL DEFAULT NULL
);
 
CREATE TABLE IF NOT EXISTS vendas(
	id_vendas BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	forma_pagamento_id INT unsigned NOT NULL,
    foreign key (forma_pagamento_id) references formas_pagamentos (id_forma_pagamentos)
);