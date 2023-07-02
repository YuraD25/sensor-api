-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: db
-- Время создания: Июл 02 2023 г., 09:16
-- Версия сервера: 8.0.31-0ubuntu0.20.04.2
-- Версия PHP: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `db`
--

-- --------------------------------------------------------

--
-- Структура таблицы `readings`
--

CREATE TABLE `readings` (
                            `id` int NOT NULL,
                            `sensor_uuid` binary(16) NOT NULL,
                            `temperature` decimal(5,2) DEFAULT NULL,
                            `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `readings`
--

INSERT INTO `readings` (`id`, `sensor_uuid`, `temperature`, `created_at`) VALUES
                                                                              (1, 0x54162e35ff8148f196d55febd3f00fd3, 50.00, '2023-07-01 22:15:48'),
                                                                              (2, 0x54162e35ff8148f196d55febd3f00fd3, 11.00, '2023-07-01 22:24:56'),
                                                                              (3, 0x54162e35ff8148f196d55febd3f00fd3, 21.00, '2023-07-01 22:24:57'),
                                                                              (4, 0x54162e35ff8148f196d55febd3f00fd3, 36.00, '2023-07-01 22:28:20'),
                                                                              (5, 0x54162e35ff8148f196d55febd3f00fd3, 58.00, '2023-07-01 22:29:10'),
                                                                              (6, 0x54162e35ff8148f196d55febd3f00fd3, 50.00, '2023-07-01 22:29:12'),
                                                                              (7, 0x54162e35ff8148f196d55febd3f00fd3, 53.00, '2023-07-01 22:29:13'),
                                                                              (8, 0x54162e35ff8148f196d55febd3f00fd3, 15.00, '2023-07-01 22:29:14'),
                                                                              (9, 0x54162e35ff8148f196d55febd3f00fd3, 39.00, '2023-07-01 22:29:15'),
                                                                              (10, 0x54162e35ff8148f196d55febd3f00fd3, 70.00, '2023-07-01 22:29:16'),
                                                                              (11, 0x54162e35ff8148f196d55febd3f00fd3, 22.00, '2023-07-01 22:31:15'),
                                                                              (12, 0x54162e35ff8148f196d55febd3f00fd3, 54.00, '2023-07-01 22:31:17'),
                                                                              (13, 0x54162e35ff8148f196d55febd3f00fd3, 34.00, '2023-07-01 22:31:43'),
                                                                              (14, 0x54162e35ff8148f196d55febd3f00fd3, 31.00, '2023-07-01 22:32:21'),
                                                                              (15, 0x54162e35ff8148f196d55febd3f00fd3, 63.00, '2023-07-01 22:32:22'),
                                                                              (16, 0x54162e35ff8148f196d55febd3f00fd3, 73.00, '2023-07-01 22:32:24'),
                                                                              (17, 0x54162e35ff8148f196d55febd3f00fd3, 78.00, '2023-07-01 22:32:25'),
                                                                              (18, 0x54162e35ff8148f196d55febd3f00fd3, 21.00, '2023-07-01 22:32:26'),
                                                                              (19, 0x54162e35ff8148f196d55febd3f00fd3, -6.00, '2023-07-01 22:32:54'),
                                                                              (20, 0x54162e35ff8148f196d55febd3f00fd3, -7.00, '2023-07-01 22:32:56'),
                                                                              (21, 0x54162e35ff8148f196d55febd3f00fd3, 74.00, '2023-07-01 22:32:57'),
                                                                              (22, 0x54162e35ff8148f196d55febd3f00fd3, 51.00, '2023-07-01 22:32:59');

-- --------------------------------------------------------

--
-- Структура таблицы `sensors`
--

CREATE TABLE `sensors` (
                           `uuid` binary(16) NOT NULL,
                           `reading_id` int DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `sensors`
--

INSERT INTO `sensors` (`uuid`, `reading_id`) VALUES
                                                 (0x54162e35ff8148f196d55febd3f00fd3, 25),
                                                 (0x54162e35ff8148f196d55febd3f00fd6, 1),
                                                 (0x54162e35ff8148f196d55febd3f00fd8, 4);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `readings`
--
ALTER TABLE `readings`
    ADD PRIMARY KEY (`id`),
    ADD KEY `sensor_uuid` (`sensor_uuid`) USING BTREE;

--
-- Индексы таблицы `sensors`
--
ALTER TABLE `sensors`
    ADD PRIMARY KEY (`uuid`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `readings`
--
ALTER TABLE `readings`
    MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
