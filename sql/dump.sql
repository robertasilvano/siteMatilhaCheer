-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 17-Maio-2021 às 17:08
-- Versão do servidor: 8.0.21
-- versão do PHP: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `aviii_desenvweb`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `faltas`
--

DROP TABLE IF EXISTS `faltas`;
CREATE TABLE IF NOT EXISTS `faltas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_atleta` int NOT NULL,
  `data` date NOT NULL,
  `data_inserida` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `justificativa` text NOT NULL,
  `arquivo` text,
  PRIMARY KEY (`id`),
  KEY `id_atleta` (`id_atleta`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `faltas`
--

INSERT INTO `faltas` (`id`, `id_atleta`, `data`, `data_inserida`, `justificativa`, `arquivo`) VALUES
(4, 133, '2021-12-31', '2021-05-17 11:16:04', 'viajando', 'NULL'),
(16, 131, '2021-05-01', '2021-05-17 17:00:19', 'doente', 'uploads/imagem_2021-05-17_140015.png'),
(17, 131, '2021-03-01', '2021-05-17 17:00:35', 'viajando', 'uploads/imagem_2021-05-17_140326.png'),
(18, 133, '2021-04-16', '2021-05-17 17:02:37', 'doente', 'NULL'),
(13, 133, '2012-07-16', '2021-05-17 14:52:05', 'doente', 'uploads/WhatsApp Image 2021-05-13 at 19.04.31.jpeg');
COMMIT;

--
-- Estrutura da tabela `atletas`
--

DROP TABLE IF EXISTS `atletas`;
CREATE TABLE IF NOT EXISTS `atletas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `user` varchar(16) NOT NULL,
  `pass` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `nascimento` date NOT NULL,
  `telefone` varchar(16) NOT NULL,
  `convenio` varchar(16) DEFAULT NULL,
  `tipo_sangue` varchar(3) NOT NULL,
  `cpf` varchar(14) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `diretoria` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user` (`user`)
) ENGINE=MyISAM AUTO_INCREMENT=139 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `atletas`
--

INSERT INTO `atletas` (`id`, `nome`, `user`, `pass`, `nascimento`, `telefone`, `convenio`, `tipo_sangue`, `cpf`, `diretoria`) VALUES
(131, 'user', 'user', '$2y$10$gwJWrJfmzaouAYYBqfGwzORnPvL4T824ihVzW7H9LK4uXNKNgP/zG', '2021-12-31', '33333333333', 'SC Saúde', 'asi', '22222222222', 0),
(132, 'admin', 'admin', '$2y$10$JJYSQqJR6x7GvqxtbyGV0.hvr1OG1KteLePGPwjYpIuCz1lctexKm', '2021-12-31', '11111111111', '', 'O+', '11111111111', 1),
(133, 'Roberta Silvano', 'robs', '$2y$10$gmJYeYYAYUL.UFQgeUfX4.NGSDJMtwkfIEWjKqv1B85m.Qc4aOn6.', '2021-12-31', '11111111111', 'SC Saúde', 'O+', '11111111111', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;