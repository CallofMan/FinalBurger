-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Окт 10 2019 г., 23:16
-- Версия сервера: 10.3.13-MariaDB
-- Версия PHP: 7.1.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `discount`
--

-- --------------------------------------------------------

--
-- Структура таблицы `buyers`
--

CREATE TABLE `buyers` (
  `id_buyer` int(11) NOT NULL,
  `first_name` varchar(25) NOT NULL,
  `surname` varchar(25) NOT NULL,
  `buyers_code` int(5) DEFAULT NULL,
  `summ_score` decimal(6,2) DEFAULT NULL,
  `quantity_bonuses` int(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `buyers`
--

INSERT INTO `buyers` (`id_buyer`, `first_name`, `surname`, `buyers_code`, `summ_score`, `quantity_bonuses`) VALUES
(1, 'admin', 'korol', 10000, NULL, NULL),
(14, 'test', 'test', 54738, NULL, NULL),
(15, 'Жирный', 'Мэддисон', 67241, NULL, NULL),
(16, 'курок', 'говна', 75777, NULL, NULL),
(17, 'курок', 'мочи', 31224, NULL, NULL),
(19, '345', '345', 97429, NULL, NULL),
(22, 'Генерал', 'Ли', 87224, NULL, NULL),
(23, 'Говно', 'Говна', 32202, NULL, NULL),
(24, 'Тупое говно', 'Тупого говна', 69630, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `cashiers`
--

CREATE TABLE `cashiers` (
  `id_cashier` int(11) NOT NULL,
  `first_name` varchar(25) NOT NULL,
  `surname` varchar(25) NOT NULL,
  `login` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `cashiers`
--

INSERT INTO `cashiers` (`id_cashier`, `first_name`, `surname`, `login`, `password`) VALUES
(1, 'Коля', 'Дятлов', '123', '321');

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE `products` (
  `id_product` int(11) NOT NULL,
  `name_product` varchar(25) NOT NULL,
  `price` int(6) NOT NULL,
  `category` varchar(20) NOT NULL,
  `day_discount` varchar(12) DEFAULT NULL,
  `discount_summ` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id_product`, `name_product`, `price`, `category`, `day_discount`, `discount_summ`) VALUES
(27, 'Бомж в говне', 1200, 'Копрофилия', '', 10),
(28, 'Говно в говне', 1500, 'Копрофилия', 'Понедельник', 10),
(29, 'Рука быдла', 500, 'Каннибализм', 'Вторник', 20),
(30, 'Рука не быдла', 10000, 'Каннибализм', 'Среда', 30),
(31, 'Хрен моржовый', 300, 'Зверушки', 'Четверг', 50),
(32, 'Петух', 100, 'Зверушки', 'Пятница', 50),
(33, 'Вишня', 50, 'Фрукты', 'Суббота', 5),
(34, 'Капуста', 90, 'Овощи', 'Воскресенье', 60),
(36, 'Мы в говне', 100000, 'Копрофилия', 'Вторник', 50);

-- --------------------------------------------------------

--
-- Структура таблицы `sales`
--

CREATE TABLE `sales` (
  `id_sale` int(11) NOT NULL,
  `id_cashier` int(11) NOT NULL,
  `id_buyer` int(11) DEFAULT NULL,
  `summ` decimal(6,2) NOT NULL,
  `discount` decimal(2,2) DEFAULT NULL,
  `summ_discount` decimal(6,2) DEFAULT NULL,
  `promocode` int(6) DEFAULT NULL,
  `day_sale` varchar(12) NOT NULL,
  `time_sale` decimal(2,2) NOT NULL,
  `week_sale` int(1) NOT NULL,
  `month_sale` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `buyers`
--
ALTER TABLE `buyers`
  ADD PRIMARY KEY (`id_buyer`);

--
-- Индексы таблицы `cashiers`
--
ALTER TABLE `cashiers`
  ADD PRIMARY KEY (`id_cashier`);

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id_product`);

--
-- Индексы таблицы `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id_sale`),
  ADD KEY `id_buyer` (`id_buyer`),
  ADD KEY `id_cashier` (`id_cashier`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `buyers`
--
ALTER TABLE `buyers`
  MODIFY `id_buyer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT для таблицы `cashiers`
--
ALTER TABLE `cashiers`
  MODIFY `id_cashier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `id_product` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT для таблицы `sales`
--
ALTER TABLE `sales`
  MODIFY `id_sale` int(11) NOT NULL AUTO_INCREMENT;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `sales_ibfk_1` FOREIGN KEY (`id_buyer`) REFERENCES `buyers` (`id_buyer`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sales_ibfk_2` FOREIGN KEY (`id_cashier`) REFERENCES `cashiers` (`id_cashier`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
