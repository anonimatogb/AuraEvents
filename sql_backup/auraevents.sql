-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 25/03/2026 às 12:57
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `auraevents`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `eventos`
--

CREATE TABLE `eventos` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `descricao` text NOT NULL,
  `data_evento` date NOT NULL,
  `horario` time NOT NULL,
  `local_evento` varchar(255) NOT NULL,
  `max_participantes` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Despejando dados para a tabela `eventos`
--

INSERT INTO `eventos` (`id`, `nome`, `descricao`, `data_evento`, `horario`, `local_evento`, `max_participantes`) VALUES
(1, 'Festa', 'Irá acontecer uma reunião de jovens adolescentes em uma certa residência perto do padilha', '2026-03-21', '10:05:00', 'Casa do tata', 5),
(2, 'Expo 2025', 'o evento conta com uma programação diversificada de shows musicais com artistas renomados, praça de alimentação com comidas típicas e atrações para toda a família. A Expo também movimenta a economia local, atraindo visitantes de diversas cidades e promovendo o turismo regional.', '2026-03-28', '18:30:00', 'Centro Convergência', 10),
(3, 'Dia de Desenvolvimento Pessoal', 'Este é um evento exclusivo, planejado para uma única pessoa que deseja investir em si mesma, buscando crescimento pessoal, equilíbrio e bem-estar.', '2026-03-29', '05:10:00', 'casa do tata', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `inscricoes`
--

CREATE TABLE `inscricoes` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_evento` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Despejando dados para a tabela `inscricoes`
--

INSERT INTO `inscricoes` (`id`, `id_usuario`, `id_evento`) VALUES
(0, 2, 1),
(0, 2, 2),
(0, 6, 1),
(0, 2, 3);

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `cargo` varchar(255) NOT NULL,
  `telefone` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`, `cargo`, `telefone`) VALUES
(1, 'Admin', 'admin@gmail.com', '123', 'admin', ''),
(2, 'Gabriel', 'gabrielcavalcante22@gmail.com', '123', 'cliente', '1323214'),
(6, 'Dhiogo', 'dhiogo@dhiogo', '12345', 'cliente', '18 99999-9999'),
(8, 'Vitor Hugo', 'vitor@vitor', '213', 'admin', '18 99999-9991');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `eventos`
--
ALTER TABLE `eventos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`,`telefone`) USING BTREE;

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `eventos`
--
ALTER TABLE `eventos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
