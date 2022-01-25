-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Tempo de geração: 25-Jan-2022 às 02:11
-- Versão do servidor: 10.5.12-MariaDB
-- versão do PHP: 7.3.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `id18069925_lojasmoveis`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `cliente`
--

CREATE TABLE `cliente` (
  `codCliente` int(11) NOT NULL,
  `nome_cliente` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `cpf_cliente` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `endereco_cliente` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `cidade_cliente` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `cep_cliente` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `estado_cliente` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `dataNasc_cliente` date NOT NULL,
  `email_cliente` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `telefone_cliente` varchar(14) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `cliente`
--

INSERT INTO `cliente` (`codCliente`, `nome_cliente`, `cpf_cliente`, `endereco_cliente`, `cidade_cliente`, `cep_cliente`, `estado_cliente`, `dataNasc_cliente`, `email_cliente`, `telefone_cliente`) VALUES
(1, 'ISRAEL CLAUDEMIR ALVES', '77988899909', 'RUA Cancioneiro Popular 210', 'NOVO HAMBURGO', '92456899', 'RS', '1980-07-23', 'alves.israel83@gmail.com', '5195678900'),
(2, 'Daniela Vieira Gavlivski', '011.144.850-63', 'Rua Capiberibe', 'Canoas', '92410-360', 'RS', '1986-04-04', 'dngg55@gmail.com', '51992950269');

-- --------------------------------------------------------

--
-- Estrutura da tabela `fornecedor`
--

CREATE TABLE `fornecedor` (
  `codFornecedor` int(11) NOT NULL,
  `nome_fornecedor` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `cnpj` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `ie_fornecedor` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `tipoProd_fornecedor` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `endereco_fornecedor` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `cidade_fornecedor` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `cep_fornecedor` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `uf_fornecedor` varchar(10) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `fornecedor`
--

INSERT INTO `fornecedor` (`codFornecedor`, `nome_fornecedor`, `cnpj`, `ie_fornecedor`, `tipoProd_fornecedor`, `endereco_fornecedor`, `cidade_fornecedor`, `cep_fornecedor`, `uf_fornecedor`) VALUES
(1, 'ITALINEA MOVEIS', '0000-898998-88', '20007868', 'MOVEIS COZINHA', 'RUA JACUTINGA 232', 'GRAMADO', '92340-900', 'RS'),
(2, 'SOFAS VIEIRA', '90/9897777-98', '300676', 'ESTOFADOS', 'RUA PIRIM 232', 'GRAMADO', '92340-989', 'RS'),
(4, 'FABRICA SOFAS', '90/9898887-91', '10009866', 'ESTOFADOS', 'RUA FERNANDES SN', 'FARROUPILHA', '92450-709', 'RS'),
(5, 'TOK IMPERIAL', '1110-899989/22', '10098782', 'MOVEIS SALA', 'RUA CAMBOTI SN', 'BENTO GONCALVES', '92567-678', 'RS'),
(6, 'FABRICA SOFAS', '90/9898887-91', '10009866', 'ESTOFADOS', 'RUA FERNANDES SN', 'FARROUPILHA', '92450-709', 'RS'),
(7, 'TOK IMPERIAL', '1110-899989/22', '10098782', 'MOVEIS SALA', 'RUA CAMBOTI SN', 'BENTO GONCALVES', '92567-678', 'RS');

-- --------------------------------------------------------

--
-- Estrutura da tabela `loginusu`
--

CREATE TABLE `loginusu` (
  `id_func` int(11) NOT NULL,
  `nome_func` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `email_func` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `senha` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `funcao_func` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `ativo` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `loginusu`
--

INSERT INTO `loginusu` (`id_func`, `nome_func`, `email_func`, `senha`, `funcao_func`, `ativo`) VALUES
(100, 'JOAO PEREIRA', 'JoaoP@gmail.com', '123', 'vendedor', 1),
(200, 'MARIA SILVA', 'maria@gmail.com', '456', 'vendedor', 1),
(300, 'ANA MARIA SILVA', 'ana@gmail.com', '1234', 'gerente', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedidos`
--

CREATE TABLE `pedidos` (
  `codPedido` int(11) NOT NULL,
  `idVenda` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `quantidade_pedido` int(11) NOT NULL DEFAULT 0,
  `preco_total` float NOT NULL DEFAULT 0,
  `codProduto` int(11) NOT NULL DEFAULT 0,
  `codCliente` int(11) NOT NULL,
  `data_Pedido` date NOT NULL DEFAULT current_timestamp(),
  `id_func` int(11) NOT NULL,
  `val_pedido` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `pedidos`
--

INSERT INTO `pedidos` (`codPedido`, `idVenda`, `quantidade_pedido`, `preco_total`, `codProduto`, `codCliente`, `data_Pedido`, `id_func`, `val_pedido`) VALUES
(1, '1', 0, 0, 0, 1, '2022-01-23', 300, 2500),
(2, '2', 0, 0, 0, 1, '2022-01-23', 300, 2500),
(3, '3', 0, 0, 0, 1, '2022-01-23', 300, 10600),
(4, '4', 0, 0, 0, 1, '2022-01-23', 300, 6900),
(5, '5', 0, 0, 0, 1, '2022-01-23', 300, 10000),
(6, '6', 0, 0, 0, 2, '2022-01-23', 200, 2800),
(7, '7', 0, 0, 0, 2, '2022-01-23', 200, 2500),
(8, '8', 0, 0, 0, 2, '2022-01-24', 300, 4200),
(9, '9', 0, 0, 0, 2, '2022-01-24', 300, 5700),
(10, '10', 0, 0, 0, 2, '2022-01-24', 300, 7500),
(11, '11', 0, 0, 0, 2, '2022-01-24', 300, 29900),
(12, '12', 0, 0, 0, 2, '2022-01-24', 100, 12500);

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto`
--

CREATE TABLE `produto` (
  `codProduto` int(11) NOT NULL,
  `nome_produto` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `tipo_produto` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `descricao_produto` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `dataEntrada_produto` date NOT NULL DEFAULT current_timestamp(),
  `imagem_produto` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `codFornecedor` int(11) NOT NULL,
  `quantidade_disponivel` int(11) NOT NULL,
  `valor_produto` float NOT NULL,
  `cod_envio` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `produto`
--

INSERT INTO `produto` (`codProduto`, `nome_produto`, `tipo_produto`, `descricao_produto`, `dataEntrada_produto`, `imagem_produto`, `codFornecedor`, `quantidade_disponivel`, `valor_produto`, `cod_envio`) VALUES
(1, 'BALCAO PIA ', 'BALCAO PIA ', 'BALCÃO PIA MODELO RETRO - PINUS TRATADO 200 L x 160 A x 70 P - SEM TAMPO', '2022-01-23', 'https://www.victordecor.com.br/image/cache//produtos/4517/balcao-para-pia-sem-tampo-country-clean-120cm-pinhao-900x900.jpg', 4, 15, 2800, 0),
(2, 'MESA VENEZA + CADEIRAS', 'COZINHA', 'MESA COZINHA 100 x 100 x 130CM VERMELHA + 4 CADEIRAS PLASTICAS', '2022-01-23', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRZEQpnROo5nIuaWRzlCE0sYXB_EsLhmCGtMA&usqp=CAU', 1, 5, 700, 0),
(3, 'SOFA FOFINHO', 'SOFA/ESTOFADO', 'SOFA 6 LUGARES CANTO CINZA 260 CM x 70 ALT 70 PROF', '2022-01-23', 'https://reidosestofados.com.br/wp-content/uploads/Sofa-Retratil-Cinza-3.20-m-de-Largura-Modelo-Berlim-1.jpg', 2, 12, 2500, 0),
(4, 'RACK PARA TV MILAO ATE 72P0', 'RACK / ESTANTE', 'RACK TV 72PL 2 L X 1MT A X 80 P  MADEIRA MACIÇA -COR PEROBA ', '2022-01-23', 'https://images.tcdn.com.br/img/img_prod/755613/rack_para_tv_ate_72_milao_2m_peroba_rosa_5_1_9a1e64bcd688a9a64552db06a1e27811.png', 4, 15, 1900, 0),
(5, 'BALCAO PIA ', 'COZINHA', 'BALCÃO PIA MODELO RETRO - PINUS TRATADO 200 L x 160 A x 70 P - SEM TAMPO', '2022-01-24', 'https://www.victordecor.com.br/image/cache//produtos/4517/balcao-para-pia-sem-tampo-country-clean-120cm-pinhao-900x900.jpg', 3, 9, 2800, 0),
(7, 'hhhhhhhhhhhhhhh', 'COZINHA', 'BALCÃO PIA MODELO RETRO - PINUS TRATADO 200 L x 160 A x 70 P - SEM TAMPO', '2022-01-24', 'https://www.victordecor.com.br/image/cache//produtos/4517/balcao-para-pia-sem-tampo-country-clean-120cm-pinhao-900x900.jpg', 1, 20, 2800, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `venda`
--

CREATE TABLE `venda` (
  `id_tblVendas` int(11) NOT NULL,
  `idVenda` int(11) NOT NULL,
  `codProduto` int(11) NOT NULL,
  `quant_item` int(11) NOT NULL,
  `valor` double NOT NULL,
  `Total_venda` double NOT NULL,
  `desconto` double NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `venda`
--

INSERT INTO `venda` (`id_tblVendas`, `idVenda`, `codProduto`, `quant_item`, `valor`, `Total_venda`, `desconto`) VALUES
(1, 1, 1, 1, 2800, 2800, 0),
(2, 1, 1, 1, 2800, 2800, 0),
(3, 1, 1, 1, 2800, 2800, 0),
(4, 1, 3, 1, 2500, 2500, 0),
(5, 2, 3, 1, 2500, 2500, 0),
(6, 3, 1, 1, 2800, 2800, 0),
(7, 3, 3, 2, 2500, 10600, 0),
(8, 4, 4, 1, 1900, 1900, 0),
(9, 4, 3, 2, 2500, 5000, 0),
(10, 5, 3, 4, 2500, 0, 0),
(11, 6, 4, 3, 1900, 0, 0),
(12, 6, 1, 1, 2800, 0, 0),
(13, 7, 3, 1, 2500, 0, 0),
(14, 8, 2, 2, 700, 0, 0),
(15, 8, 5, 1, 2800, 0, 0),
(16, 9, 3, 2, 2500, 0, 0),
(17, 9, 2, 1, 700, 0, 0),
(18, 10, 3, 3, 2500, 0, 0),
(19, 11, 5, 10, 2800, 0, 0),
(20, 11, 4, 1, 1900, 0, 0),
(21, 12, 3, 5, 2500, 0, 0);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`codCliente`);

--
-- Índices para tabela `fornecedor`
--
ALTER TABLE `fornecedor`
  ADD PRIMARY KEY (`codFornecedor`);

--
-- Índices para tabela `loginusu`
--
ALTER TABLE `loginusu`
  ADD PRIMARY KEY (`id_func`);

--
-- Índices para tabela `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`codPedido`);

--
-- Índices para tabela `produto`
--
ALTER TABLE `produto`
  ADD PRIMARY KEY (`codProduto`);

--
-- Índices para tabela `venda`
--
ALTER TABLE `venda`
  ADD PRIMARY KEY (`id_tblVendas`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `cliente`
--
ALTER TABLE `cliente`
  MODIFY `codCliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `fornecedor`
--
ALTER TABLE `fornecedor`
  MODIFY `codFornecedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `loginusu`
--
ALTER TABLE `loginusu`
  MODIFY `id_func` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=301;

--
-- AUTO_INCREMENT de tabela `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `codPedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `produto`
--
ALTER TABLE `produto`
  MODIFY `codProduto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `venda`
--
ALTER TABLE `venda`
  MODIFY `id_tblVendas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
