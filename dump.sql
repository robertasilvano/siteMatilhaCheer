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
('Roberta Silvano', 'robs', 'a', '1996-07-01', '11111111111', 'SC Saúde', 'O+', '11111111111', 1),
('Raul Brum Weschenfelder', 'raul', '123', '1999-10-10', '1231232', NULL, 'O-', '12321312312', 0),
('Victor Seabra', 'seabra', '000', '2021-04-02', '99999999', 'Unimed', 'AB', '99999999', 1);
COMMIT;