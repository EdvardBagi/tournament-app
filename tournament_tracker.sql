-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2023. Okt 20. 12:13
-- Kiszolgáló verziója: 10.4.28-MariaDB
-- PHP verzió: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `tournament_tracker`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `contestants`
--

CREATE TABLE `contestants` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `round` varchar(60) NOT NULL,
  `tournament_name` varchar(60) NOT NULL,
  `tournament_year` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- A tábla adatainak kiíratása `contestants`
--

INSERT INTO `contestants` (`user_id`, `round`, `tournament_name`, `tournament_year`) VALUES
(1, 'Finals', 'Champions League', 2020),
(8, 'Finals', 'Champions League', 2020);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- A tábla adatainak kiíratása `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(5, '2014_10_12_000000_create_users_table', 1);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `rounds`
--

CREATE TABLE `rounds` (
  `name` varchar(60) NOT NULL,
  `tournament_name` varchar(60) NOT NULL,
  `tournament_year` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- A tábla adatainak kiíratása `rounds`
--

INSERT INTO `rounds` (`name`, `tournament_name`, `tournament_year`) VALUES
('Finals', 'Champions League', 2020),
('Semi Finals', 'Champions League', 2020);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `tournaments`
--

CREATE TABLE `tournaments` (
  `name` varchar(60) NOT NULL,
  `year` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- A tábla adatainak kiíratása `tournaments`
--

INSERT INTO `tournaments` (`name`, `year`) VALUES
('Champions League', 2020),
('World Cup', 2016),
('World Cup', 2021);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- A tábla adatainak kiíratása `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@gmail.com', NULL, '$2y$10$HdF0E32YjO4eVDKcapjcpO4pmUYHi2XOmZJN00F0Q.MtHdb8eoTXW', NULL, '2023-10-17 12:46:46', '2023-10-17 12:46:46'),
(8, 'John Doe', 'johndoe@gmail.com', NULL, '$2y$10$8fObdUz0ng97fvbG6aYE4uipYdS4Vi7zH0.iQD7ij3zD349bNUROu', NULL, '2023-10-17 14:02:58', '2023-10-17 14:02:58'),
(12, 'Jon Snow', 'jonsnow@gmail.com', NULL, '$2y$10$KRzYtmdU5nNpQ7HPJ01g6Ozm6UU6BRgdhouMyzrMXFsFfknx9xwaK', NULL, '2023-10-17 15:53:27', '2023-10-17 15:53:27'),
(14, 'John Smith', 'johnsmith@gmail.com', NULL, '$2y$10$YA/SpHP8evegI7KuVImDt.1rM0HQV1rs/jMmiR/GAMELhT9eMK6wG', NULL, '2023-10-17 15:53:27', '2023-10-17 15:53:27');

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `contestants`
--
ALTER TABLE `contestants`
  ADD UNIQUE KEY `UN_contestant` (`user_id`,`round`,`tournament_name`,`tournament_year`),
  ADD KEY `FK_contestant_round` (`round`,`tournament_name`,`tournament_year`);

--
-- A tábla indexei `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `rounds`
--
ALTER TABLE `rounds`
  ADD UNIQUE KEY `UN_round` (`name`,`tournament_name`,`tournament_year`),
  ADD KEY `FK_round_tournament` (`tournament_name`,`tournament_year`);

--
-- A tábla indexei `tournaments`
--
ALTER TABLE `tournaments`
  ADD PRIMARY KEY (`name`,`year`);

--
-- A tábla indexei `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_name_unique` (`name`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT a táblához `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `contestants`
--
ALTER TABLE `contestants`
  ADD CONSTRAINT `FK_contestant_round` FOREIGN KEY (`round`,`tournament_name`,`tournament_year`) REFERENCES `rounds` (`name`, `tournament_name`, `tournament_year`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_contestant_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Megkötések a táblához `rounds`
--
ALTER TABLE `rounds`
  ADD CONSTRAINT `FK_round_tournament` FOREIGN KEY (`tournament_name`,`tournament_year`) REFERENCES `tournaments` (`name`, `year`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
