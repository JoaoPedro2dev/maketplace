-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 20/02/2025 às 00:52
-- Versão do servidor: 9.1.0
-- Versão do PHP: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `ecommerce`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `carrinhos`
--

DROP TABLE IF EXISTS `carrinhos`;
CREATE TABLE IF NOT EXISTS `carrinhos` (
  `id_produto` int NOT NULL,
  `id_usuario` int NOT NULL,
  `quantidade` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `carrinhos`
--

INSERT INTO `carrinhos` (`id_produto`, `id_usuario`, `quantidade`) VALUES
(11, 1, 7),
(1, 1, 3),
(6, 1, 4),
(0, 1, 2),
(4, 1, 2),
(1, 31, 2),
(1, 33, 2),
(6, 33, 1),
(12, 33, 3),
(13, 33, 1),
(14, 33, 1),
(20, 33, 2),
(19, 33, 1),
(24, 55, 1),
(24, 54, 1),
(14, 48, 1),
(22, 48, 1),
(27, 1, 1),
(27, 75, 2),
(0, 75, 2),
(15, 27, 12),
(29, 46, 12),
(19, 75, 1),
(22, 70, 4),
(21, 75, 40),
(14, 76, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `comentarios`
--

DROP TABLE IF EXISTS `comentarios`;
CREATE TABLE IF NOT EXISTS `comentarios` (
  `id_produto` int NOT NULL,
  `id_usuario` int NOT NULL,
  `likes` int NOT NULL,
  `deslikes` int NOT NULL,
  `texto_comentario` varchar(300) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `comentarios`
--

INSERT INTO `comentarios` (`id_produto`, `id_usuario`, `likes`, `deslikes`, `texto_comentario`) VALUES
(36, 76, 2, 1, 'muito legal');

-- --------------------------------------------------------

--
-- Estrutura para tabela `pedidos`
--

DROP TABLE IF EXISTS `pedidos`;
CREATE TABLE IF NOT EXISTS `pedidos` (
  `id_pedido` int NOT NULL AUTO_INCREMENT,
  `ids_produtos` varchar(10000) COLLATE utf8mb4_general_ci NOT NULL,
  `id_usuario` int NOT NULL,
  `data_pedido` date NOT NULL,
  `horario_pedido` time NOT NULL,
  `data_entrega` date NOT NULL,
  `horario_entrega` time NOT NULL,
  `endereco_de_entrega` varchar(300) COLLATE utf8mb4_general_ci NOT NULL,
  `Forma_de_envio` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `forma_de_pagamento` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `quantidades` varchar(1000) COLLATE utf8mb4_general_ci NOT NULL,
  `condicao` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `total` double(10,2) NOT NULL,
  `pagamento` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_pedido`)
) ENGINE=MyISAM AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `pedidos`
--

INSERT INTO `pedidos` (`id_pedido`, `ids_produtos`, `id_usuario`, `data_pedido`, `horario_pedido`, `data_entrega`, `horario_entrega`, `endereco_de_entrega`, `Forma_de_envio`, `forma_de_pagamento`, `quantidades`, `condicao`, `total`, `pagamento`) VALUES
(39, '22', 46, '2025-01-07', '14:01:03', '0000-00-00', '00:00:00', 'Avenida Alberto Masiero, 1292, Jardim Maria Luiza IV, Jaú - SP, 17213250', 'entrega', 'cartao', '1', 'cancelado_usuar', 1.00, 'pendente'),
(40, '23', 46, '2025-01-07', '14:02:53', '0000-00-00', '00:00:00', 'Avenida Alberto Masiero, 22, Jardim Maria Luiza IV, Jaú - SP, 17213250', 'entrega', 'cartao', '2', 'para_entrega', 4.00, 'pendente'),
(41, '32', 46, '2025-01-07', '14:27:18', '0000-00-00', '00:00:00', 'buscou no local', 'buscar', 'cartao', '1', 'para_entrega', 3.00, 'pendente');

-- --------------------------------------------------------

--
-- Estrutura para tabela `produtos`
--

DROP TABLE IF EXISTS `produtos`;
CREATE TABLE IF NOT EXISTS `produtos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_vendedor` int NOT NULL,
  `produto_nome` varchar(180) COLLATE utf8mb4_general_ci NOT NULL,
  `categoria` varchar(7) COLLATE utf8mb4_general_ci NOT NULL,
  `cores_disponiveis` varchar(1000) COLLATE utf8mb4_general_ci NOT NULL,
  `tamanhos_disponiveis` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `descricao` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `preco` decimal(10,2) NOT NULL,
  `frete` double(10,2) NOT NULL,
  `promocao` int NOT NULL,
  `quantidade_vendas` int NOT NULL,
  `data_inicio_promocao` date NOT NULL,
  `data_final_promocao` date NOT NULL,
  `valor_promocao` decimal(10,2) NOT NULL,
  `fim_promocao` date NOT NULL,
  `prazo_entrega` int NOT NULL,
  `foto_1` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `foto_2` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `foto_3` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=48 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `produtos`
--

INSERT INTO `produtos` (`id`, `id_vendedor`, `produto_nome`, `categoria`, `cores_disponiveis`, `tamanhos_disponiveis`, `descricao`, `preco`, `frete`, `promocao`, `quantidade_vendas`, `data_inicio_promocao`, `data_final_promocao`, `valor_promocao`, `fim_promocao`, `prazo_entrega`, `foto_1`, `foto_2`, `foto_3`) VALUES
(27, 1, '3', 'pao', '', '', '3', 3.00, 0.00, 0, 0, '0000-00-00', '0000-00-00', 1.00, '2025-01-11', 0, 'fotoProdutos/676c5fd70e7bb.jpg', '', ''),
(28, 1, '1', 'bolo', '', '', '1', 1.00, 0.00, 0, 0, '0000-00-00', '0000-00-00', 0.00, '0000-00-00', 0, 'fotoProdutos/676c5feb4e8f8.jpg', '', ''),
(15, 1, 'b', 'bolo', '', '', 'bolo', 22.90, 0.00, 0, 0, '0000-00-00', '0000-00-00', 0.00, '0000-00-00', 0, 'fotoProdutos/67686b54cde1e.png', '', ''),
(18, 1, 'bolo de café 1', 'bolo', '', '', 'bolo de café recheado com chantily', 12.53, 0.00, 0, 0, '0000-00-00', '0000-00-00', 0.00, '0000-00-00', 0, 'fotoProdutos/67686bb867d46.png', '', ''),
(19, 1, 'Pão', 'pao', '', '', 'pão de 500g', 5.44, 0.00, 0, 0, '0000-00-00', '0000-00-00', 2.00, '0000-00-00', 0, 'fotoProdutos/67686c82a63fc.png', '', ''),
(20, 1, 'Doce', 'doce', '', '', 'doce', 12.00, 0.00, 0, 0, '0000-00-00', '0000-00-00', 0.00, '0000-00-00', 0, 'fotoProdutos/67686cb3972b6.png', '', ''),
(21, 1, 'Coca-cola', 'frio', '', '', 'coca-cola 300ml', 3.00, 0.00, 0, 0, '0000-00-00', '0000-00-00', 0.00, '0000-00-00', 0, 'fotoProdutos/67686ce475859.jpg', '', ''),
(22, 1, 'item 1', 'salgado', '', '', '1', 1.00, 0.00, 0, 0, '0000-00-00', '0000-00-00', 0.99, '0001-01-01', 0, 'fotoProdutos/676c5f80d6c22.png', '', ''),
(23, 1, 'item 2', 'salgado', '', '', 'Descrição', 2.00, 0.00, 0, 0, '0000-00-00', '0000-00-00', 0.00, '0000-00-00', 0, 'fotoProdutos/676c5f8906cb6.jpg', '', ''),
(24, 1, '3', 'salgado', '', '', '3', 3.00, 0.00, 0, 0, '0000-00-00', '0000-00-00', 0.00, '0000-00-00', 0, 'fotoProdutos/676c5f90b42de.png', '', ''),
(25, 1, '1', 'pao', '', '', '1', 1.00, 0.00, 0, 0, '0000-00-00', '0000-00-00', 0.00, '0000-00-00', 0, 'fotoProdutos/676c5fc74adce.png', '', ''),
(26, 1, '2', 'pao', '', '', '2', 2.00, 0.00, 0, 0, '0000-00-00', '0000-00-00', 1.00, '2025-01-09', 0, 'fotoProdutos/676c5fce52a9f.png', '', ''),
(14, 1, 'Bolo', 'salgado', '', '', '1kg de Bolo', 24.90, 0.00, 0, 0, '0000-00-00', '0000-00-00', 0.00, '0000-00-00', 0, 'fotoProdutos/676af46218cf9.png', '', ''),
(29, 1, '2', 'bolo', '', '', '2', 2.00, 0.00, 0, 0, '0000-00-00', '0000-00-00', 0.00, '0000-00-00', 0, 'fotoProdutos/676c5ff32bdb6.png', '', ''),
(30, 1, '1', 'doce', '', '', '1', 1.00, 0.00, 0, 0, '0000-00-00', '0000-00-00', 0.00, '0000-00-00', 0, 'fotoProdutos/676c600f8ad8c.png', '', ''),
(31, 1, '2', 'doce', '', '', '2', 2.00, 0.00, 0, 0, '0000-00-00', '0000-00-00', 0.00, '0000-00-00', 0, 'fotoProdutos/676c602c8db04.png', '', ''),
(32, 1, '3', 'doce', '', '', '3', 3.00, 0.00, 0, 0, '0000-00-00', '0000-00-00', 0.00, '0000-00-00', 0, 'fotoProdutos/676c603b58e3c.jpg', '', ''),
(33, 1, '1', 'frio', '', '', '1', 1.00, 0.00, 0, 0, '0000-00-00', '0000-00-00', 0.00, '0000-00-00', 0, 'fotoProdutos/676c6045ef27d.jpg', '', ''),
(34, 1, '2', 'frio', '', '', '2', 2.00, 0.00, 0, 0, '0000-00-00', '0000-00-00', 0.00, '0000-00-00', 0, 'fotoProdutos/676c604d2c16f.jpg', '', ''),
(35, 1, '3', 'frio', '', '', '3', 3.00, 0.00, 0, 0, '0000-00-00', '0000-00-00', 0.00, '0000-00-00', 0, 'fotoProdutos/676c6054da1d6.png', '', ''),
(36, 1, 'Produto de teste', 'salgado', 'Vermelho,Azul,Verde,Amarelo,Preto,Branco', 'M,G,X', 'produto de teste', 244.40, 23.00, 200, 12, '0000-00-00', '0000-00-00', 0.00, '0000-00-00', 2, 'http://localhost/marketplace/img/foto1.jpg', 'http://localhost/marketplace/img/foto2.jpg', 'http://localhost/marketplace/img/foto3.jpg');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id_usuario` int NOT NULL AUTO_INCREMENT,
  `nome_usuario` varchar(180) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `admin` varchar(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(180) COLLATE utf8mb4_general_ci NOT NULL,
  `endereco` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `bairro` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `cidade` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `UF` varchar(2) COLLATE utf8mb4_general_ci NOT NULL,
  `CEP` varchar(9) COLLATE utf8mb4_general_ci NOT NULL,
  `num_casa` int NOT NULL,
  `senha` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `telefone` varchar(12) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `foto` varchar(250) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id_usuario`)
) ENGINE=MyISAM AUTO_INCREMENT=77 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nome_usuario`, `admin`, `email`, `endereco`, `bairro`, `cidade`, `UF`, `CEP`, `num_casa`, `senha`, `telefone`, `foto`) VALUES
(76, 'joão pedro', 'Não', 'joaopedrodesenvolvedordes@gmail.com', '', '', 'Jaú', 'SP', '', 0, '$2y$10$54lznQtOIz9VUZoX7yMBAeqhuCG9MB.fsYTXRy76vfQBtqCCkeR3i', 'não informad', 'fotoPerfil/67a212aba0889.png');

-- --------------------------------------------------------

--
-- Estrutura para tabela `vendedores`
--

DROP TABLE IF EXISTS `vendedores`;
CREATE TABLE IF NOT EXISTS `vendedores` (
  `id_vendedor` int NOT NULL AUTO_INCREMENT,
  `nome_vendedor` varchar(180) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `senha` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `foto_vendedor` varchar(300) COLLATE utf8mb4_general_ci NOT NULL,
  `itens_a_venda` int NOT NULL,
  `vendas` int NOT NULL,
  PRIMARY KEY (`id_vendedor`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `vendedores`
--

INSERT INTO `vendedores` (`id_vendedor`, `nome_vendedor`, `email`, `senha`, `foto_vendedor`, `itens_a_venda`, `vendas`) VALUES
(1, 'João Pedro', 'email@gmail.com', '123', 'http://localhost/e-commerce/img/675086c2708f2.png', 1, 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
