-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           5.6.17 - MySQL Community Server (GPL)
-- OS do Servidor:               Win32
-- HeidiSQL Versão:              9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Copiando estrutura do banco de dados para nova_loja
CREATE DATABASE IF NOT EXISTS `nova_loja` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_bin */;
USE `nova_loja`;

-- Copiando estrutura para tabela nova_loja.brands
CREATE TABLE IF NOT EXISTS `brands` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela nova_loja.brands: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `brands` DISABLE KEYS */;
INSERT INTO `brands` (`id`, `name`) VALUES
	(1, 'LG'),
	(2, 'Samsung'),
	(3, 'AOC'),
	(4, 'Apple');
/*!40000 ALTER TABLE `brands` ENABLE KEYS */;

-- Copiando estrutura para tabela nova_loja.categories
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `sub` int(11) DEFAULT NULL,
  `name` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela nova_loja.categories: ~6 rows (aproximadamente)
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` (`id`, `sub`, `name`) VALUES
	(6, NULL, 'Monitor'),
	(14, NULL, 'Som'),
	(15, 14, 'Headphones'),
	(16, 14, 'Microfones'),
	(17, 15, 'Com Fio'),
	(18, 15, 'Sem Fio');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;

-- Copiando estrutura para tabela nova_loja.coupons
CREATE TABLE IF NOT EXISTS `coupons` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL DEFAULT '',
  `coupon_type` int(11) NOT NULL,
  `coupon_value` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela nova_loja.coupons: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `coupons` DISABLE KEYS */;
/*!40000 ALTER TABLE `coupons` ENABLE KEYS */;

-- Copiando estrutura para tabela nova_loja.options
CREATE TABLE IF NOT EXISTS `options` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela nova_loja.options: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `options` DISABLE KEYS */;
INSERT INTO `options` (`id`, `name`) VALUES
	(1, 'Cor'),
	(2, 'Tamanho'),
	(3, 'Memória RAM'),
	(4, 'Polegadas');
/*!40000 ALTER TABLE `options` ENABLE KEYS */;

-- Copiando estrutura para tabela nova_loja.pages
CREATE TABLE IF NOT EXISTS `pages` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL DEFAULT '',
  `body` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela nova_loja.pages: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `pages` DISABLE KEYS */;
/*!40000 ALTER TABLE `pages` ENABLE KEYS */;

-- Copiando estrutura para tabela nova_loja.products
CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_category` int(11) NOT NULL,
  `id_brand` int(11) NOT NULL,
  `name` varchar(100) NOT NULL DEFAULT '',
  `description` text,
  `stock` int(11) NOT NULL,
  `price` float NOT NULL,
  `price_from` float NOT NULL,
  `rating` float NOT NULL,
  `featured` tinyint(1) NOT NULL,
  `sale` tinyint(1) NOT NULL,
  `bestseller` tinyint(1) NOT NULL,
  `new_product` tinyint(1) NOT NULL,
  `options` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela nova_loja.products: ~8 rows (aproximadamente)
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` (`id`, `id_category`, `id_brand`, `name`, `description`, `stock`, `price`, `price_from`, `rating`, `featured`, `sale`, `bestseller`, `new_product`, `options`) VALUES
	(1, 6, 1, 'Monitor 21 polegadas', 'Alguma descrição do produto.', 10, 499, 599, 0, 1, 1, 1, 0, '1,2,4'),
	(2, 6, 2, 'Monitor 18 polegadas', 'Alguma outra descrição', 10, 399, 999, 2, 1, 1, 1, 0, '1,2'),
	(3, 6, 2, 'Monitor 19 polegadas', 'Alguma outra descrição', 10, 599, 699, 0, 0, 0, 0, 1, '1,2'),
	(4, 6, 3, 'Monitor 17 polegadas', 'Alguma outra descrição', 10, 3779, 900, 2, 1, 0, 0, 0, '1,4'),
	(5, 6, 1, 'Monitor 20 polegadas', 'Alguma outra descrição', 10, 299, 499, 0, 1, 0, 0, 1, '1'),
	(6, 6, 3, 'Monitor 20 polegadas', 'Alguma outra descrição', 10, 699, 0, 0, 0, 0, 0, 0, '1,2,4'),
	(7, 6, 3, 'Monitor 19 polegadas', 'Alguma outra descrição', 10, 889, 999, 5, 1, 1, 0, 0, '2,4'),
	(8, 6, 1, 'Monitor 18 polegadas', 'Alguma outra descrição', 10, 599, 699, 0, 0, 0, 0, 0, '4');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;

-- Copiando estrutura para tabela nova_loja.products_images
CREATE TABLE IF NOT EXISTS `products_images` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_product` int(11) NOT NULL,
  `url` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela nova_loja.products_images: ~8 rows (aproximadamente)
/*!40000 ALTER TABLE `products_images` DISABLE KEYS */;
INSERT INTO `products_images` (`id`, `id_product`, `url`) VALUES
	(1, 1, '1.jpg'),
	(2, 2, '2.jpg'),
	(3, 3, '3.jpg'),
	(4, 4, '4.jpg'),
	(5, 5, '1.jpg'),
	(6, 6, '3.jpg'),
	(7, 7, '7.jpg'),
	(8, 8, '7.jpg'),
	(9, 2, '3.jpg'),
	(10, 2, '4.jpg'),
	(11, 2, '7.jpg');
/*!40000 ALTER TABLE `products_images` ENABLE KEYS */;

-- Copiando estrutura para tabela nova_loja.products_options
CREATE TABLE IF NOT EXISTS `products_options` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_product` int(11) NOT NULL,
  `id_option` int(11) NOT NULL,
  `p_value` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela nova_loja.products_options: ~7 rows (aproximadamente)
/*!40000 ALTER TABLE `products_options` DISABLE KEYS */;
INSERT INTO `products_options` (`id`, `id_product`, `id_option`, `p_value`) VALUES
	(1, 1, 1, 'Azul'),
	(2, 1, 2, '23cm'),
	(3, 1, 4, '21'),
	(4, 2, 1, 'Azul'),
	(5, 2, 2, '19cm'),
	(6, 3, 1, 'Vermelho'),
	(7, 3, 2, '19cm');
/*!40000 ALTER TABLE `products_options` ENABLE KEYS */;

-- Copiando estrutura para tabela nova_loja.purchases
CREATE TABLE IF NOT EXISTS `purchases` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_coupon` int(11) DEFAULT NULL,
  `total_amount` float NOT NULL,
  `payment_type` int(11) DEFAULT NULL,
  `payment_status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela nova_loja.purchases: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `purchases` DISABLE KEYS */;
/*!40000 ALTER TABLE `purchases` ENABLE KEYS */;

-- Copiando estrutura para tabela nova_loja.purchases_products
CREATE TABLE IF NOT EXISTS `purchases_products` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_purchase` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela nova_loja.purchases_products: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `purchases_products` DISABLE KEYS */;
/*!40000 ALTER TABLE `purchases_products` ENABLE KEYS */;

-- Copiando estrutura para tabela nova_loja.purchase_transactions
CREATE TABLE IF NOT EXISTS `purchase_transactions` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_purchase` int(11) NOT NULL,
  `amount` float NOT NULL,
  `transaction_code` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela nova_loja.purchase_transactions: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `purchase_transactions` DISABLE KEYS */;
/*!40000 ALTER TABLE `purchase_transactions` ENABLE KEYS */;

-- Copiando estrutura para tabela nova_loja.rates
CREATE TABLE IF NOT EXISTS `rates` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_product` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `date_rated` datetime NOT NULL,
  `points` int(11) NOT NULL,
  `comment` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela nova_loja.rates: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `rates` DISABLE KEYS */;
/*!40000 ALTER TABLE `rates` ENABLE KEYS */;

-- Copiando estrutura para tabela nova_loja.user
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(100) COLLATE utf8_bin NOT NULL DEFAULT '0',
  `senha` varchar(32) COLLATE utf8_bin NOT NULL DEFAULT '0',
  KEY `Index 1` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Copiando dados para a tabela nova_loja.user: 0 rows
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

-- Copiando estrutura para tabela nova_loja.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL DEFAULT '',
  `password` varchar(32) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela nova_loja.users: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
