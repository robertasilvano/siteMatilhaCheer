Banco de dados: `avii_desenvweb`
Estrutura da tabela `atletas`

DROP TABLE IF EXISTS `atletas`;
CREATE TABLE IF NOT EXISTS `atletas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `user` varchar(16) NOT NULL,
  `pass` varchar(16) NOT NULL,
  `nascimento` date NOT NULL,
  `telefone` varchar(16) NOT NULL,
  `convenio` varchar(16) DEFAULT NULL,
  `tipo_sangue` varchar(3) NOT NULL,
  `cpf` varchar(14) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `diretoria` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user` (`user`)
) ENGINE=MyISAM AUTO_INCREMENT=49 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `atletas` (`nome`, `user`, `pass`, `nascimento`, `telefone`, `convenio`, `tipo_sangue`, `cpf`, `diretoria`) VALUES
('Roberta Silvano Pereira', 'robs', 'a', '1996-07-01', '11111111111', 'SC Saúde', 'O+', '11111111111', 1),
('Raul Weschenfelder', 'raul', '123', '1999-10-10', '11111111111', '', 'O-', '11111111111', 0),
('Victor Seabra', 'seabra', '111', '2015-12-30', '11111111111', 'Unimed', 'AB+', '11111111111', 1),
('Otavio Moratelli', 'otavio', '222', '2020-12-28', '11111111111', 'm', 'a', '11111111111', 1);