-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Дек 26 2023 г., 15:57
-- Версия сервера: 5.7.21-20-beget-5.7.21-20-1-log
-- Версия PHP: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `uniblock24_db`
--

-- --------------------------------------------------------

--
-- Структура таблицы `Roles`
--
-- Создание: Дек 08 2023 г., 06:52
--

DROP TABLE IF EXISTS `Roles`;
CREATE TABLE `Roles` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `Roles`
--

INSERT INTO `Roles` (`id`, `name`) VALUES
(0, 'Администратор'),
(1, 'Юрист'),
(2, 'Клиент');

-- --------------------------------------------------------

--
-- Структура таблицы `SmartContracts`
--
-- Создание: Дек 26 2023 г., 06:37
-- Последнее обновление: Дек 26 2023 г., 09:12
--

DROP TABLE IF EXISTS `SmartContracts`;
CREATE TABLE `SmartContracts` (
  `id` int(11) NOT NULL,
  `hash` varchar(512) NOT NULL,
  `created_date` date NOT NULL,
  `fileName` varchar(64) NOT NULL,
  `name` varchar(256) NOT NULL,
  `description` varchar(2048) NOT NULL,
  `admin` int(11) NOT NULL,
  `adminApproved` int(11) NOT NULL DEFAULT '0',
  `clientApproved` int(11) NOT NULL DEFAULT '0',
  `adminSign` varchar(512) NOT NULL DEFAULT '-',
  `clientSign` varchar(512) NOT NULL DEFAULT '-',
  `clientKey` varchar(512) NOT NULL DEFAULT '-',
  `genFile` varchar(256) NOT NULL DEFAULT '-',
  `tokens` int(11) NOT NULL DEFAULT '0',
  `senderAddress` varchar(512) NOT NULL DEFAULT '-',
  `senderPrivateKey` varchar(512) NOT NULL DEFAULT '-',
  `ticket` varchar(255) NOT NULL DEFAULT '-'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `Users`
--
-- Создание: Дек 19 2023 г., 20:30
--

DROP TABLE IF EXISTS `Users`;
CREATE TABLE `Users` (
  `id` int(11) NOT NULL,
  `FIO` varchar(256) NOT NULL,
  `Email` varchar(256) NOT NULL,
  `Password` varchar(128) NOT NULL,
  `memberID` int(11) NOT NULL DEFAULT '-1',
  `privateKey` varchar(512) NOT NULL DEFAULT '-',
  `roleId` int(11) NOT NULL DEFAULT '2',
  `unikey` varchar(64) NOT NULL,
  `walletAddress` varchar(256) NOT NULL DEFAULT '-'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `Users`
--

INSERT INTO `Users` (`id`, `FIO`, `Email`, `Password`, `memberID`, `privateKey`, `roleId`, `unikey`, `walletAddress`) VALUES
(43, 'Мустафин Рустем Сергеевич', 'rustem@mail.ru', '123', -1, '0xe654a00e529edfc5ddbbccb17cdbb844b5098ef06c5426385524a7412ad37786', 2, '6572d860d20da', '0x4bCBFBD0FAd8dcaB77bEBf54134Fa66Ef0717D2a'),
(46, 'Михаил', 'tomas.shellenberg@mail.ru', 'suomenvoi19', -1, '0x348fe7691e8db0d6eddb01c99ffee9a06e5f3428d205f54317290fcfbd2ba779', 2, '6579bc041f7a3', '0x7aF6BeFe6e7070DA95a7aC4f942d055dE383CA29'),
(47, 'Лузиев Мансур Харисович', 'mans@mail.ru', '123', -1, '0x1df2d86874fd431fc5632c85c9a6a98627f2eeee8d413740cd0658b6300d09a7', 2, '657aa394b0d1f', '0xFDfFeBA60F7c20245bCa7ce94fdDbF1f96830307');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `Roles`
--
ALTER TABLE `Roles`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `SmartContracts`
--
ALTER TABLE `SmartContracts`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `SmartContracts`
--
ALTER TABLE `SmartContracts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT для таблицы `Users`
--
ALTER TABLE `Users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
