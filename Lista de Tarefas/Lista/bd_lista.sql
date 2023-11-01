-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Tempo de geração: 01/11/2023 às 02:12
-- Versão do servidor: 10.4.28-MariaDB
-- Versão do PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `bd_lista`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `status`
--

CREATE TABLE `status` (
  `id_status` int(11) NOT NULL,
  `nome_status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `status`
--

INSERT INTO `status` (`id_status`, `nome_status`) VALUES
(0, 'Em espera'),
(1, 'Iniciada'),
(2, 'Em andamento'),
(3, 'Finalizada'),
(4, 'Concluido'),
(5, 'Concluido com atraso');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tarefas`
--

CREATE TABLE `tarefas` (
  `id_tarefas` int(11) NOT NULL,
  `nome_tarefa` varchar(255) DEFAULT NULL,
  `cod_status` int(11) DEFAULT NULL,
  `prioridade` int(11) DEFAULT NULL,
  `prazo` date DEFAULT NULL,
  `cod_usuarios` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tarefas_concluidas`
--

CREATE TABLE `tarefas_concluidas` (
  `id_tarefasc` int(11) NOT NULL,
  `nome_tarefa` varchar(255) DEFAULT NULL,
  `cod_statusf` int(11) DEFAULT NULL,
  `prazo` date DEFAULT NULL,
  `entrega` date DEFAULT NULL,
  `cod_usuariof` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuarios` int(11) NOT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `senha` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id_status`);

--
-- Índices de tabela `tarefas`
--
ALTER TABLE `tarefas`
  ADD PRIMARY KEY (`id_tarefas`),
  ADD KEY `fk_tarstat` (`cod_status`),
  ADD KEY `fk_tarusu` (`cod_usuarios`);

--
-- Índices de tabela `tarefas_concluidas`
--
ALTER TABLE `tarefas_concluidas`
  ADD PRIMARY KEY (`id_tarefasc`),
  ADD KEY `fr_tafstat` (`cod_statusf`),
  ADD KEY `fk_tafusu` (`cod_usuariof`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuarios`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `tarefas`
--
ALTER TABLE `tarefas`
  MODIFY `id_tarefas` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tarefas_concluidas`
--
ALTER TABLE `tarefas_concluidas`
  MODIFY `id_tarefasc` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuarios` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `tarefas`
--
ALTER TABLE `tarefas`
  ADD CONSTRAINT `fk_tarstat` FOREIGN KEY (`cod_status`) REFERENCES `status` (`id_status`),
  ADD CONSTRAINT `fk_tarusu` FOREIGN KEY (`cod_usuarios`) REFERENCES `usuarios` (`id_usuarios`);

--
-- Restrições para tabelas `tarefas_concluidas`
--
ALTER TABLE `tarefas_concluidas`
  ADD CONSTRAINT `fk_tafusu` FOREIGN KEY (`cod_usuariof`) REFERENCES `usuarios` (`id_usuarios`),
  ADD CONSTRAINT `fr_tafstat` FOREIGN KEY (`cod_statusf`) REFERENCES `status` (`id_status`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
