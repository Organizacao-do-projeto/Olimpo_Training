-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 03/11/2023 às 21:40
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
(18, 'ANUAL', 53),
(19, 'MENSAL', 54),
(20, 'ANUAL', 55);

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
(13, 56, 123456, 'Bacharelado', 'SP', 1),
(14, 57, 876543, 'Bacharelado', 'DF', 1),
(15, 58, 69965, 'Licenciatura', 'AC', 1);

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
(85, 1, 1, 'Treino geral', '2023-11-03', 50, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce ac sapien id risus rutrum iaculis sit amet et nunc. Vivamus sed metus pharetra, mollis risus sed, ullamcorper erat. Vestibulum imperdiet neque nec ex consequat sagittis. In hac habitasse platea dictumst. Phasellus vel enim nec lorem mollis commodo non et nunc.'),
(86, 1, 1, 'Treino de musculação', '2023-11-03', 33, 'Não faça o pulo do burpee :)'),
(87, 1, 1, 'Treino Segunda-Feira', '2023-11-03', 45, 'Treino educativo no começo da semana');

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
(243, 85, 1, 3, 12, 0, 30, 'REPETICOES'),
(244, 85, 2, 3, 30, 0, 15, 'TEMPO'),
(245, 85, 3, 3, 25, 0, 45, 'REPETICOES'),
(246, 86, 1, 3, 12, 0, 30, 'REPETICOES'),
(247, 86, 3, 3, 12, 0, 30, 'REPETICOES'),
(248, 86, 4, 3, 12, 0, 30, 'REPETICOES'),
(249, 86, 2, 3, 12, 0, 30, 'REPETICOES'),
(260, 87, 1, 3, 12, 0, 30, 'REPETICOES'),
(261, 87, 2, 3, 12, 0, 30, 'REPETICOES'),
(262, 87, 3, 3, 12, 0, 30, 'REPETICOES'),
(263, 87, 1, 3, 12, 0, 30, 'REPETICOES'),
(264, 87, 2, 3, 12, 0, 30, 'REPETICOES');

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
(18, 'PIX', 53),
(19, 'BOLETO', 54),
(20, 'PIX', 55);

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
(50, 'COMUM'),
(51, 'COMUM'),
(52, 'COMUM'),
(53, 'ALUNO'),
(54, 'ALUNO'),
(55, 'ALUNO'),
(56, 'PERSONAL-TRAINER'),
(57, 'PERSONAL-TRAINER'),
(58, 'PERSONAL-TRAINER');

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
(1, 'admin@gmail.com', '202cb962ac59075b964b07152d234b70', 'Administrador', 1, '000.000.000-00', 'Masculino', 200, 200, 7, '', '', '', 1, 1),
(50, 'jose@gmail.com', '202cb962ac59075b964b07152d234b70', 'José Silva da SIlva', 0, '', 'Masculino', 175, 75, 0, 'treinando.jpg', '', 'Quero melhorar minha saúde e bem-estar, além de me sentir mais confiante e energizado. Estou animado para começar a treinar e alcançar meus objetivos de fitness.', 0, 0),
(51, 'maria@gmail.com', '202cb962ac59075b964b07152d234b70', 'Maria Fernandes', 0, '', 'Masculino', 155, 76, 0, 'moca.jpg', '', 'Quero melhorar minha saúde e bem-estar, além de me sentir mais confiante e energizado. Estou animado para começar a treinar e alcançar meus objetivos de fitness.', 0, 0),
(52, 'jailson@gmail.com', '202cb962ac59075b964b07152d234b70', 'Jailson Hermes', 0, '', 'Masculino', 188, 93, 0, 'JailsonHermes.jpg', '', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce ac sapien id risus rutrum iaculis sit amet et nunc. Vivamus sed metus pharetra, mollis risus sed, ullamcorper erat. Vestibulum imperdiet neque nec ex consequat sagittis. In hac habitasse ', 0, 0),
(53, 'ana@gmail.com', '202cb962ac59075b964b07152d234b70', 'Ana Não Sei das Quantas', 0, '456.789.012-34', 'Feminino', 171, 55, 7, 'anaNseidasquantas.jpg', '', 'Quero melhorar minha saúde e bem-estar, além de me sentir mais confiante e energizada. Estou animada para começar a treinar e alcançar meus objetivos de fitness.', 0, 0),
(54, 'jorlan@gmail.com', '202cb962ac59075b964b07152d234b70', 'Jorlan Chevette', 0, '123.456.789-00', 'Masculino', 182, 82, 3, 'jorlanChevette.jpg', '', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce ac sapien id risus rutrum iaculis sit amet et nunc. Vivamus sed metus pharetra, mollis risus sed, ullamcorper erat. Vestibulum imperdiet neque nec ex consequat sagittis. In hac habitasse ', 0, 0),
(55, 'helena@gmail.com', '202cb962ac59075b964b07152d234b70', 'Helena dos Anjos Costa', 0, '123.456.789-11', 'Feminino', 157, 54, 7, 'helenasla.jpg', '', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce ac sapien id risus rutrum iaculis sit amet et nunc. Vivamus sed metus pharetra, mollis risus sed, ullamcorper erat. Vestibulum imperdiet neque nec ex consequat sagittis. In hac habitasse ', 0, 0),
(56, 'fabio@gmail.com', '202cb962ac59075b964b07152d234b70', 'Fabio Giga', 0, '123.456.789-88', 'Masculino', 0, 0, 0, 'fabioGiga.jpg', 'Olá, sou formado em educação física na universidade Federal de Masachussetz da esquina. Atuo como personal trainer há 5 anos e já preparei diversos atletas para competições.', '', 1, 0),
(57, 'rodrigo@gmail.com', '202cb962ac59075b964b07152d234b70', 'Rodrigo Goes', 0, '123.456.765-43', 'Masculino', 0, 0, 0, 'rodrigoGoes.png', 'Meu nome é Rodrigo. Tenho pós graduação em acrobacias e movimentos. Estou a disposição para atender atletas naturais. ', '', 1, 0),
(58, 'lean@gmail.com', '202cb962ac59075b964b07152d234b70', 'Lean Beef Patty', 0, '222.222.222-22', 'Feminino', 0, 0, 0, 'leanBeefPatty.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce ac sapien id risus rutrum iaculis sit amet et nunc. Vivamus sed metus pharetra, mollis risus sed, ullamcorper erat. Vestibulum imperdiet neque nec ex consequat sagittis. In hac habitasse platea dictumst. Phasellus vel enim nec lorem mollis commodo non et nunc.', '', 1, 0);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de tabela `crefs`
--
ALTER TABLE `crefs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de tabela `exercicios`
--
ALTER TABLE `exercicios`
  MODIFY `idExercicios` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `fichas_treino`
--
ALTER TABLE `fichas_treino`
  MODIFY `idFichas_treino` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT de tabela `ft_exe`
--
ALTER TABLE `ft_exe`
  MODIFY `idFT_EXE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=265;

--
-- AUTO_INCREMENT de tabela `pagamentos`
--
ALTER TABLE `pagamentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de tabela `perfis`
--
ALTER TABLE `perfis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
