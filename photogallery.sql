-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Май 28 2021 г., 19:26
-- Версия сервера: 5.6.43
-- Версия PHP: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `photogallery`
--

-- --------------------------------------------------------

--
-- Структура таблицы `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `login` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `admin`
--

INSERT INTO `admin` (`id`, `login`, `password`) VALUES
(1, 'admin', 'admin'),
(2, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Структура таблицы `author`
--

CREATE TABLE `author` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `author`
--

INSERT INTO `author` (`id`, `name`) VALUES
(1, 'admin'),
(2, 'Dmitry');

-- --------------------------------------------------------

--
-- Структура таблицы `card`
--

CREATE TABLE `card` (
  `id` int(11) NOT NULL,
  `img` int(50) NOT NULL,
  `title` varchar(50) NOT NULL,
  `category` int(50) NOT NULL,
  `like` int(11) DEFAULT NULL,
  `comment` int(11) DEFAULT NULL,
  `author` int(50) NOT NULL,
  `date` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `card`
--

INSERT INTO `card` (`id`, `img`, `title`, `category`, `like`, `comment`, `author`, `date`) VALUES
(15, 6, 'Тест', 3, NULL, NULL, 2, '0000-00-00'),
(16, 7, 'Картинка 3', 1, NULL, NULL, 1, '28.05.2021');

-- --------------------------------------------------------

--
-- Структура таблицы `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'Природа'),
(2, 'Животные'),
(3, 'Города'),
(4, 'Пейзажи');

-- --------------------------------------------------------

--
-- Структура таблицы `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `card_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `text` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `photo`
--

CREATE TABLE `photo` (
  `id` int(11) NOT NULL,
  `src` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `photo`
--

INSERT INTO `photo` (`id`, `src`) VALUES
(3, './img/BdYyMDmypC4.jpg'),
(4, './img/1sQrhJTnWgU.jpg'),
(5, '../img/1sQrhJTnWgU.jpg'),
(6, '../img/lOFv1rDGCgs.jpg'),
(7, '../img/rjVMgLlpQb8.jpg'),
(8, '../img/BdYyMDmypC4.jpg'),
(9, '../img/lOFv1rDGCgs.jpg'),
(10, '../img/rjVMgLlpQb8.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `login` varchar(50) NOT NULL,
  `password` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `login`, `password`) VALUES
(1, 'test', 'test'),
(2, 'Кирилл', '$2y$10$DY1pWy/a.y29ZvJT0rDuu.xljJt27pjqfH4nl5kvm65vntmOnUxk.'),
(3, 'Кирилл', '$2y$10$sjlfMkqlr/OvtA0NDvwoGedB4uDQSAY1gNH/ZVR2rQdy/qQ2lRaQC'),
(4, '', '$2y$10$4rFwgS6xJie9C/C5JhkD0uGTmaAbdmRPsWPuaar8Nu8HPxv4rmzeG'),
(5, '', '$2y$10$lyLIMm0ItNcGojlo.vLfMOjWy2PYW/KJDqWTjTr0e9Y4L5kDD8J9K'),
(6, '', '$2y$10$Q8FO2O.NeqvP7WAdOE0ri.aq4GtEilBzPg7uBlw/JTalXV6or7M8e'),
(7, '', '$2y$10$ZhtEI.AyfZpU/i3TmtZ2zu/pI9DWad9.zjim33mFOMLA.LZZvAZ4.'),
(8, 'asda', '$2y$10$WjT94Xu0BvrHd75AVKaiB.O26jbMdGZrzX8lyZqMNAL9b0NXndLzq'),
(9, '123', '$2y$10$BlFYA5AQQOuqbL8n3x2Uw.3o.veawX2lGPEdWVwZ.MQQ96MzM9fty'),
(10, '', '$2y$10$9GlC8BUjow1rMNAyZbJ7juVOx.B1Q3YjBPz5.39L8xDGGgwvk8SiC'),
(11, '', '$2y$10$qkDCGxjZtA65Ffb40D6RH.hbu0i5yu5zYWdHsSpKLNcLsH.EzBYX.'),
(12, '123', '$2y$10$bCbhueyolF5chPd9dX0qCeELdEmcFvSce1AuiJOoupcSjP9XB4mKq'),
(13, '', '$2y$10$VYtBtrK1VAakJjAvr5Wxte5v0Lueop1SCeek0UsrIGtErXf78fa/m'),
(14, 'asfasfa', '$2y$10$rc1qWl.ZS7X/7EgGX7bcNe00s73Ml.7WVMEgkbHH1uZ8MAMmSnp.m'),
(15, 'dima', '$2y$10$MSY2d9wk9A95O3r6AB1kgOT3CssSAIT4V9drJNGQYlTMwoqK1pgtK'),
(16, 'user', '$2y$10$aGv5JmG7caWhHPbzqUbI0ukY5WW7HBLECL67X5go1i3xv4SW1VJLm');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Индексы таблицы `card`
--
ALTER TABLE `card`
  ADD PRIMARY KEY (`id`),
  ADD KEY `img` (`img`),
  ADD KEY `category` (`category`),
  ADD KEY `author` (`author`);

--
-- Индексы таблицы `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Индексы таблицы `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `card_id` (`card_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `photo`
--
ALTER TABLE `photo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `author`
--
ALTER TABLE `author`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `card`
--
ALTER TABLE `card`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT для таблицы `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `photo`
--
ALTER TABLE `photo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `card`
--
ALTER TABLE `card`
  ADD CONSTRAINT `card_ibfk_1` FOREIGN KEY (`category`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `card_ibfk_2` FOREIGN KEY (`img`) REFERENCES `photo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `card_ibfk_3` FOREIGN KEY (`author`) REFERENCES `author` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`card_id`) REFERENCES `card` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
