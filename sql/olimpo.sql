-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 01/11/2023 às 10:35
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
-- Banco de dados: `olimpo`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `assinaturas`
--

CREATE TABLE `assinaturas` (
  `id` int(11) NOT NULL,
  `tipo` varchar(70) NOT NULL,
  `idUsuarios` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `assinaturas`
--

INSERT INTO `assinaturas` (`id`, `tipo`, `idUsuarios`) VALUES
(11, 'MENSAL', 31),
(13, 'ANUAL', 33),
(14, 'ANUAL', 34);

-- --------------------------------------------------------

--
-- Estrutura para tabela `crefs`
--

CREATE TABLE `crefs` (
  `id` int(11) NOT NULL,
  `idUsuarios` int(11) NOT NULL,
  `numero` int(6) NOT NULL,
  `natureza` varchar(25) NOT NULL,
  `UF_registro` varchar(2) NOT NULL,
  `autenticado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `crefs`
--

INSERT INTO `crefs` (`id`, `idUsuarios`, `numero`, `natureza`, `UF_registro`, `autenticado`) VALUES
(8, 16, 123456, 'Bacharelado', 'RJ', 1),
(9, 35, 324, 'Licenciatura', 'ES', 1),
(10, 36, 99999, 'Licenciatura', 'DF', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `exercicios`
--

CREATE TABLE `exercicios` (
  `idExercicios` int(11) NOT NULL,
  `nome` varchar(250) NOT NULL,
  `descricao` mediumtext NOT NULL,
  `link_tutorial` varchar(500) NOT NULL,
  `ativ_fisica` varchar(50) NOT NULL,
  `nome_arq` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `exercicios`
--

INSERT INTO `exercicios` (`idExercicios`, `nome`, `descricao`, `link_tutorial`, `ativ_fisica`, `nome_arq`) VALUES
(1, 'Agachamento búlgaro', '\r\nO agachamento búlgaro é um exercício onde você fica em uma posição de agachamento com uma perna estendida para trás. Ele ajuda a fortalecer as pernas, glúteos e core.', 'hY1mAqbXhvQ?si=5KD8pBazjimuby6C', 'Calistenia', 'agachamentoBulgaro.gif'),
(2, 'Burpee', 'Os exercícios burpee são uma combinação de agachamentos, flexões e saltos, sendo uma excelente opção para trabalhar todo o corpo de forma intensa.iga os passos abaixo para corretamente o exerc burpee:\r\nCome em pé, com os p alinhados com os ombros.\r\nAgache-se, levando as mãos ao chão, mantendo a coluna ret e a cabeça alinhada com a coluna.\r\nEm seguida, empurre as pernas para trás, estendendo-as totalmente para a posição de flexão.\r\nFaça uma flexão, abaixando o corpo em direção ao chão, mantendo os cotovelos próximos ao corpo.\r\nVolte à posição de flexão, impulsionando o corpo para cima, estendendo os braços e mantendo o corpo alinhado.\r\nSalte para ficar com os pés próximos às mãos.\r\nFinalmente, salte para cima o máximo que puder, estendendo os braços acima da cabeça.\r\nRepita o movimento, alternando entre agachamento, flexão, salto e volta ao agachamento.\r\nÉ importante lembrar de manter uma boa postura durante todo o exercício, especialmente para evitar lesões na coluna ou articulações. Comece fazendo poucas repetições e vá aumentando gradativamente conforme ganha condicionamento físico.', 'QyuQSvEuzAc?si=76hpo3Q_hoBTa5XV', 'Calistenia', 'burpee.gif'),
(3, 'Flexao Diamante', 'A flexão diamante é um exercício onde você junta as mãos em forma de diamante e realiza as flexões. Ele ajuda a fortalecer os músculos do peito e tríceps.', 'YK0T74TlbNQ?si=gCcOb93hzIL6EVPa', 'Calistenia', 'flexaoDiamante.webp'),
(4, 'Polichinelo', 'O polichinelo é um exercício rítmico onde você salta no lugar, abrindo e fechando as pernas e os braços ao mesmo tempo. Ele ajuda a melhorar a coordenação, a resistência cardiovascular e queimar calorias.', 'S2uqQ9zHZMc?si=bNwvlWp2VXpoCjYA', 'Calistenia', 'polichinelo.gif');

-- --------------------------------------------------------

--
-- Estrutura para tabela `fichas_treino`
--

CREATE TABLE `fichas_treino` (
  `idFichas_treino` int(11) NOT NULL,
  `idPersonal` int(11) NOT NULL,
  `idAluno` int(11) NOT NULL,
  `titulo` varchar(77) NOT NULL,
  `data_criacao` date NOT NULL,
  `descExercicios` int(4) NOT NULL,
  `observacoes` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `fichas_treino`
--

INSERT INTO `fichas_treino` (`idFichas_treino`, `idPersonal`, `idAluno`, `titulo`, `data_criacao`, `descExercicios`, `observacoes`) VALUES
(70, 1, 1, 'Treino A', '2023-10-11', 45, 'kalsjdlkjfds'),
(75, 1, 1, 'Treino B ', '2023-10-12', 76, 'Kakkakkdjfkkdf'),
(78, 1, 1, 'Treino de integração', '2023-10-29', 45, '1234'),
(79, 1, 1, 'Treino z', '2023-10-29', 50, 'Testando no integração');

-- --------------------------------------------------------

--
-- Estrutura para tabela `ft_exe`
--

CREATE TABLE `ft_exe` (
  `idFT_EXE` int(11) NOT NULL,
  `idFichas_Treino` int(11) NOT NULL,
  `idExercicios` int(11) NOT NULL,
  `series` tinyint(4) NOT NULL,
  `repeticoes` smallint(6) NOT NULL,
  `carga` smallint(6) NOT NULL,
  `descSeries` smallint(6) NOT NULL,
  `modo` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `ft_exe`
--

INSERT INTO `ft_exe` (`idFT_EXE`, `idFichas_Treino`, `idExercicios`, `series`, `repeticoes`, `carga`, `descSeries`, `modo`) VALUES
(32, 70, 1, 3, 12, 0, 30, 'REPETICOES'),
(33, 70, 1, 3, 12, 0, 30, 'REPETICOES'),
(34, 70, 1, 3, 12, 0, 30, 'REPETICOES'),
(155, 78, 2, 3, 12, 0, 30, 'REPETICOES'),
(156, 78, 1, 3, 12, 0, 30, 'REPETICOES'),
(198, 75, 1, 3, 12, 0, 30, 'TEMPO'),
(199, 75, 1, 3, 12, 0, 30, 'TEMPO'),
(200, 75, 1, 3, 12, 10, 30, 'TEMPO'),
(201, 75, 1, 3, 12, 0, 30, 'TEMPO'),
(202, 75, 1, 3, 12, 0, 30, 'REPETICOES'),
(228, 79, 3, 3, 12, 0, 30, 'REPETICOES'),
(229, 79, 4, 3, 12, 0, 30, 'REPETICOES'),
(230, 79, 1, 3, 12, 0, 30, 'REPETICOES'),
(231, 79, 2, 3, 12, 0, 30, 'REPETICOES'),
(232, 79, 4, 3, 12, 0, 30, 'REPETICOES');

-- --------------------------------------------------------

--
-- Estrutura para tabela `pagamentos`
--

CREATE TABLE `pagamentos` (
  `id` int(11) NOT NULL,
  `tipo` varchar(11) NOT NULL,
  `idUsuarios` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `pagamentos`
--

INSERT INTO `pagamentos` (`id`, `tipo`, `idUsuarios`) VALUES
(11, 'BOLETO', 31),
(13, 'PIX', 33),
(14, 'PIX', 34);

-- --------------------------------------------------------

--
-- Estrutura para tabela `perfis`
--

CREATE TABLE `perfis` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `perfis`
--

INSERT INTO `perfis` (`id`, `nome`) VALUES
(1, 'ADMINISTRADOR'),
(8, 'PERSONAL-TRAINER'),
(9, 'PERSONAL-TRAINER'),
(10, 'ALUNO'),
(16, 'PERSONAL-TRAINER'),
(31, 'ALUNO'),
(33, 'ALUNO'),
(34, 'ALUNO'),
(35, 'PERSONAL-TRAINER'),
(36, 'PERSONAL-TRAINER');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(80) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `autenticado` tinyint(1) NOT NULL,
  `CPF` varchar(15) NOT NULL,
  `sexo` varchar(25) NOT NULL,
  `altura` int(11) NOT NULL,
  `peso` float NOT NULL,
  `saldo_solici` int(11) NOT NULL,
  `foto` varchar(70) NOT NULL,
  `descricao` varchar(500) NOT NULL,
  `objetivo` varchar(250) NOT NULL,
  `idPerso_trainer` int(11) NOT NULL,
  `idPerfis` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `email`, `password`, `nome`, `autenticado`, `CPF`, `sexo`, `altura`, `peso`, `saldo_solici`, `foto`, `descricao`, `objetivo`, `idPerso_trainer`, `idPerfis`) VALUES
(1, 'admin@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Administrador', 1, '9999999999', 'MASCULINO', 200, 200, 7, '', '', '', 1, 1),
(7, 'fdsf', 'fads', 'dfad', 0, '988493580', 'MASCULINO', 178, 0, 7, 'dfdsdsaf', '', '', 8, 0),
(8, 'aa@gmail', 'haha', 'Cariani', 0, '9884777', 'MASCULINO', 199, 0, 7, 'fdsfasd.jpg', 'eu sou formado em tal na faculdade tal', '', 0, 0),
(9, 'lkjflds@gmail', 'dfads', 'carianis', 0, '988493580', 'MASCULINO', 178, 77, 7, 'hhah.jpg', 'esse é o personal mais bvislumbrado do mercado atualmente', '', 0, 0),
(10, 'abc@gmail', '202cb962ac59075b964b07152d234b70', 'Marcos', 0, '988493580', 'MASCULINO', 178, 77, 7, 'marcos.png', 'Olá, eu sou o marcos', '', 0, 10),
(11, 'isac@gmail.com', '202cb962ac59075b964b07152d234b70', 'isac', 0, '555555', '', 0, 0, 0, '', '', '', 0, 0),
(16, 'p@p', '202cb962ac59075b964b07152d234b70', 'Kleberson', 0, '999945545./', 'Masculino', 0, 0, 0, 'treinando.jpg', 'Kleberson KlebersonKlebersonKlebersonKlebersonKleberson', '', 1, 0),
(19, 'a@a', '202cb962ac59075b964b07152d234b70', 'aaa', 0, '324.', 'Feminino', 3422, 34, 3, 'RonnieColeman.jpg', '', 'adfsda', 0, 0),
(31, 'as@gmail', 'c386950aa5131b703f031267f77e1075', 'fadi', 0, '235.356.67', 'Feminino', 23, 33, 3, 'RonnieColeman.jpg', '', '3333333', 0, 0),
(33, 's@s', '202cb962ac59075b964b07152d234b70', 'sim', 0, '123.765.', 'Masculino', 123, 78, 7, 'RonnieColeman.jpg', '', 'fdsfdsafda', 0, 0),
(34, 'w@w', '202cb962ac59075b964b07152d234b70', 'seila', 0, '123.475.443--6', 'Feminino', 123, 213, 7, 'sla.jpg', '', 'fdsfasadfas', 0, 0),
(35, 'pa@p', '2f3680790ac607007e3443a317871dd5', 'p', 0, '124523', 'Feminino', 0, 0, 0, 'RonnieColeman.jpg', 'gfda', '', 1, 0),
(36, 'n@n', 'ca46c1b9512a7a8315fa3c5a946e8265', 'Não', 0, '9999', 'Feminino', 0, 0, 0, 'trabaio.jpg', 'não', '', 1, 0);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `assinaturas`
--
ALTER TABLE `assinaturas`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `crefs`
--
ALTER TABLE `crefs`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `exercicios`
--
ALTER TABLE `exercicios`
  ADD PRIMARY KEY (`idExercicios`);

--
-- Índices de tabela `fichas_treino`
--
ALTER TABLE `fichas_treino`
  ADD PRIMARY KEY (`idFichas_treino`);

--
-- Índices de tabela `ft_exe`
--
ALTER TABLE `ft_exe`
  ADD PRIMARY KEY (`idFT_EXE`);

--
-- Índices de tabela `pagamentos`
--
ALTER TABLE `pagamentos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `perfis`
--
ALTER TABLE `perfis`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `assinaturas`
--
ALTER TABLE `assinaturas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de tabela `crefs`
--
ALTER TABLE `crefs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `exercicios`
--
ALTER TABLE `exercicios`
  MODIFY `idExercicios` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `fichas_treino`
--
ALTER TABLE `fichas_treino`
  MODIFY `idFichas_treino` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT de tabela `ft_exe`
--
ALTER TABLE `ft_exe`
  MODIFY `idFT_EXE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=233;

--
-- AUTO_INCREMENT de tabela `pagamentos`
--
ALTER TABLE `pagamentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de tabela `perfis`
--
ALTER TABLE `perfis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
