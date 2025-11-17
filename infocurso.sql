-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 14/11/2025 às 20:44
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `infocurso`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `alunos`
--

CREATE TABLE `alunos` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `rg` varchar(30) NOT NULL,
  `cpf` varchar(20) NOT NULL,
  `endereco` varchar(255) NOT NULL,
  `tel` varchar(80) NOT NULL,
  `escolaridade` varchar(50) NOT NULL,
  `turma` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `alunos`
--

INSERT INTO `alunos` (`id`, `nome`, `rg`, `cpf`, `endereco`, `tel`, `escolaridade`, `turma`) VALUES
(11, 'ITALO MENDES SIQUEIRA', '123987658', '147.365.897-74', 'RUA PADRE PEREIRA', '(88) 99865-3214', 'SUPERIOR_INC', 29),
(12, 'RAQUEL DOS SANTOS AMORIM', '147854368925', '258.741.336-95', 'PADRE PEREIRA', '(88) 99874-5633', 'SUPERIOR_INC', 23),
(13, 'DAYANE VIEIRA DA SILVA', '1478956322', '147.888.759-66', 'RUA DO CEMITÉRIO', '(88) 99685-7422', 'SUPERIOR_INC', 29),
(14, 'MARIA DE SOUSA', '1478569333', '125.789.357-99', 'RUA JOAO CASTELO', '(88) 98174-5236', 'MEDIO', 18),
(15, 'MARIA PEREIRA', '1258749632', '102.369.744-58', 'DISTRITO BOA VISTA', '(88) 99874-5698', 'MEDIO', 18),
(16, 'JOAO DA SILVA PONTES', '14785236988', '021.369.987-45', 'RUA CASEMIRO FIUSA', '(88) 99656-8932', 'SUPERIOR', 19),
(17, 'JOSE COSTA DA SILVA', '12365478899', '014.789.653-33', 'RUA NOVA UNIÃO', '(88) 96369-8555', 'SUPERIOR', 19);

-- --------------------------------------------------------

--
-- Estrutura para tabela `ocorrencia`
--

CREATE TABLE `ocorrencia` (
  `id` int(11) NOT NULL,
  `data` date NOT NULL,
  `descricao` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `ocorrencia`
--

INSERT INTO `ocorrencia` (`id`, `data`, `descricao`) VALUES
(2, '2025-11-10', 'ALUNOS DESOBEDECERAM'),
(3, '2025-11-10', 'ALUNOS DESOBEDECERAM'),
(4, '2025-11-10', 'AAA'),
(5, '2025-11-10', 'A'),
(6, '2025-11-10', 'A'),
(7, '2025-11-10', 'AAAS'),
(8, '2025-11-10', 'AA'),
(9, '2025-11-10', 'A'),
(10, '2025-11-10', 'AAA'),
(11, '2025-11-10', 'TESTE AO ALTERAR'),
(12, '2025-11-10', 'AAA'),
(13, '2025-11-10', 'TESTE PóS ALTERA~çAO'),
(14, '2025-11-10', 'AAA'),
(15, '0000-00-00', ''),
(16, '2025-11-10', 'AAA'),
(17, '2025-11-10', 'AA'),
(18, '2025-11-10', 'AAAA'),
(19, '2025-11-10', 'AAAA'),
(26, '2025-11-10', 'AAA'),
(27, '2025-11-10', 'TESTE VERDADEIRO'),
(28, '2025-11-10', 'ANDOU FAZENDO MERDA'),
(31, '2025-11-11', 'ALUNO VEIO SEM FARDA'),
(33, '2025-11-13', 'DEMONSTRAçãO PARA AS COORDENADORAS.');

-- --------------------------------------------------------

--
-- Estrutura para tabela `ocorrencia_aluno`
--

CREATE TABLE `ocorrencia_aluno` (
  `id` int(11) NOT NULL,
  `ocorrencia_id` int(11) NOT NULL,
  `alunos_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `ocorrencia_aluno`
--

INSERT INTO `ocorrencia_aluno` (`id`, `ocorrencia_id`, `alunos_id`) VALUES
(1, 26, 11),
(2, 26, 17),
(3, 26, 15),
(7, 28, 13),
(8, 28, 11),
(9, 28, 16),
(23, 27, 13),
(35, 33, 13),
(36, 33, 11),
(37, 33, 12),
(38, 31, 11),
(39, 31, 17);

-- --------------------------------------------------------

--
-- Estrutura para tabela `turma`
--

CREATE TABLE `turma` (
  `id` int(50) NOT NULL,
  `ano` varchar(50) NOT NULL,
  `turma` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `turma`
--

INSERT INTO `turma` (`id`, `ano`, `turma`) VALUES
(1, 'Reserva', '*'),
(29, '6', 'B'),
(31, '2', 'A');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `login` varchar(50) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `nivel` enum('admin','usuario') DEFAULT 'usuario',
  `foto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `login`, `senha`, `nivel`, `foto`) VALUES
(1, 'Administrador', 'admin', '$2y$10$4fQqPrGoRST3hJQAHtdZ3eJDf.YYpTnCGOJctpsZs/2M2lF6sVLlq', 'admin', 'uploads/foto_1.png'),
(2, 'Italo', 'italo', '$2y$10$KTYAT/x4g6cQ/n6qLCR59OfLVQz6dLn45h3xGEKFM1K/UDKWVL2LG', 'admin', 'uploads/foto_2.jpg'),
(3, 'Periany', 'periany', '$2y$10$vZywuG.jGkS01DLFIApOCe.WX6MJQ9FfsTQ/3A5hW1AKOFgYhg/KC', 'admin', NULL),
(4, 'Denise', 'denise', '$2y$10$vZywuG.jGkS01DLFIApOCe.WX6MJQ9FfsTQ/3A5hW1AKOFgYhg/KC', 'admin', NULL),
(5, 'Larisa', 'larisa', '$2y$10$vZywuG.jGkS01DLFIApOCe.WX6MJQ9FfsTQ/3A5hW1AKOFgYhg/KC', 'admin', NULL),
(6, 'Marta', 'marta', '$2y$10$vZywuG.jGkS01DLFIApOCe.WX6MJQ9FfsTQ/3A5hW1AKOFgYhg/KC', 'admin', 'uploads/foto_6.png'),
(9, 'Teste novo', 'teste', '$2y$10$P5Fo6o8QY6Zyu8jyRD/veeB5wPorJZKD/f24RuTDhxnuu0Ar7dSiy', 'usuario', 'uploads/6917304c01dfc-13OvfNo.jpg');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `alunos`
--
ALTER TABLE `alunos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `ocorrencia`
--
ALTER TABLE `ocorrencia`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `ocorrencia_aluno`
--
ALTER TABLE `ocorrencia_aluno`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ocorrencia_id` (`ocorrencia_id`),
  ADD KEY `alunos_id` (`alunos_id`);

--
-- Índices de tabela `turma`
--
ALTER TABLE `turma`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `alunos`
--
ALTER TABLE `alunos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de tabela `ocorrencia`
--
ALTER TABLE `ocorrencia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de tabela `ocorrencia_aluno`
--
ALTER TABLE `ocorrencia_aluno`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT de tabela `turma`
--
ALTER TABLE `turma`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `ocorrencia_aluno`
--
ALTER TABLE `ocorrencia_aluno`
  ADD CONSTRAINT `ocorrencia_aluno_ibfk_1` FOREIGN KEY (`ocorrencia_id`) REFERENCES `ocorrencia` (`id`),
  ADD CONSTRAINT `ocorrencia_aluno_ibfk_2` FOREIGN KEY (`alunos_id`) REFERENCES `alunos` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
