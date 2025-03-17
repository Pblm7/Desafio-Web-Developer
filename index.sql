/* Script para criação do banco de dados e tabela */

CREATE DATABASE gestao_verbas;

USE gestao_verbas;

CREATE TABLE acoes_marketing (
    id INT AUTO_INCREMENT PRIMARY KEY,
    acao ENUM('Palestra', 'Evento', 'Apoio Gráfico') NOT NULL,
    data_prevista DATE NOT NULL,
    investimento DECIMAL(10,2) NOT NULL,
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);