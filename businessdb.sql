-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 27/11/2025 às 14:55
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
-- Banco de dados: `businessdb`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `suspects`
--

CREATE TABLE `suspects` (
  `id` int(11) NOT NULL,
  `name` varchar(120) NOT NULL,
  `gender` enum('Masculino','Feminino') NOT NULL,
  `age` int(3) NOT NULL,
  `birthdate` date DEFAULT NULL,
  `nationality` varchar(60) DEFAULT NULL,
  `occupation` varchar(100) DEFAULT NULL,
  `risk_level` enum('Baixo','Médio','Alto','Crítico','Desconhecido') NOT NULL,
  `status` enum('Suspeito','Detido','Procurado','Observação','Falecido','Desconhecido') NOT NULL,
  `motive` enum('Espionagem','Colaboração Estrangeira','Traição','Tentativa de Golpe','Sabotagem de Infraestrutura','Terrorismo','Financiamento do Terrorismo','Recrutamento Insurgente','Facilitação Logística','Tráfico de Informação Secreta','Divulgação de Segredos Estatais','Subversão Política','Desinformação Organizada','Propaganda Hostil','Corrupção Pública','Peculato','Conluio com Setor Privado','Lavagem de Dinheiro','Evasão de Sanções','Contrabando Estratégico','Tráfico de Armas','Terrorismo Cibernético','Intrusão Cibernética','Malware Estatal','Espionagem Interna','Apoio a Inimigo','Refúgio a Subversivos','Deserção em Tempo de Guerra','Recusa de Obediência Militar','Insurreição Armada','Incitamento à Violência','Ataques a Figuras Públicas','Coleta Ilícita de Dados','Manipulação Eleitoral','Crime Econômico Estratégico','Hacker por Contratação','Violação de Controles de Exportação','Bioterrorismo','Produção Nuclear Ilegal','Ataque Químico','Roubo de Recursos Nacionais','Monopólio Crítico Ilegal','Hoarding Estratégico','Greve Ilegal em Setores Críticos','Milícias Privadas','Uso Ilegal de Vigilância','Falsificação de Documentos','Interpretação Pública de Normas','Assassinato Político','Amizade Inimiga Pública','Obstrução de Justiça','Violação de Sigilo Judicial','Desobediência Civil Organizada','Uso de Meios Financeiros para Desestabilizar') NOT NULL,
  `reg_data` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `suspects`
--

INSERT INTO `suspects` (`id`, `name`, `gender`, `age`, `birthdate`, `nationality`, `occupation`, `risk_level`, `status`, `motive`, `reg_data`) VALUES
(60, 'Ana', 'Masculino', 2222, '0222-02-22', '222', '222', 'Baixo', 'Suspeito', 'Evasão de Sanções', '2025-11-19 11:13:09');

-- --------------------------------------------------------

--
-- Estrutura para tabela `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` char(255) NOT NULL,
  `reg_data` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `reg_data`) VALUES
(52, 'Vinicius Pietro', 'viniciuspietro02052006@gmail.com', '$2y$10$UdinoZXCO6FVjyY.9gBLduTjPZIKOXlVBpUp3ET9uWWEi5NX2VBPS', '2025-11-18 10:49:44');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `suspects`
--
ALTER TABLE `suspects`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user` (`username`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `suspects`
--
ALTER TABLE `suspects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
