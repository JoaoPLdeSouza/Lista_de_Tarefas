-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 06/11/2023 às 19:34
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
-- Estrutura para tabela `tarefas`
--

CREATE TABLE `tarefas` (
  `id_tarefas` int(11) NOT NULL,
  `nome_tarefa` varchar(255) DEFAULT NULL,
  `cod_status` int(11) DEFAULT NULL,
  `prioridade` varchar(255) DEFAULT NULL,
  `prazo` date DEFAULT NULL,
  `cod_usuarios` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tarefas`
--

INSERT INTO `tarefas` (`id_tarefas`, `nome_tarefa`, `cod_status`, `prioridade`, `prazo`, `cod_usuarios`) VALUES
(1, '', 1, '', '2023-11-05', 1),
(2, 'Segundo', 3, 'Alta', '2023-11-07', 1),
(3, 'TPA1', 1, 'Alta', '2023-11-21', 1),
(4, 'TPA3', 1, 'Baixa', '2023-11-14', 1),
(7, 'TesteUpdate', 2, 'Media', '2023-11-21', 1);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `tarefas`
--
ALTER TABLE `tarefas`
  ADD PRIMARY KEY (`id_tarefas`),
  ADD KEY `fk_tarstat` (`cod_status`),
  ADD KEY `fk_tarusu` (`cod_usuarios`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `tarefas`
--
ALTER TABLE `tarefas`
  MODIFY `id_tarefas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `tarefas`
--
ALTER TABLE `tarefas`
  ADD CONSTRAINT `fk_tarstat` FOREIGN KEY (`cod_status`) REFERENCES `status` (`id_status`),
  ADD CONSTRAINT `fk_tarusu` FOREIGN KEY (`cod_usuarios`) REFERENCES `usuarios` (`id_usuarios`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
