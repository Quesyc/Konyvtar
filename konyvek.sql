-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2023. Jún 14. 18:22
-- Kiszolgáló verziója: 10.4.27-MariaDB
-- PHP verzió: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `konyvtar`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `konyvek`
--

CREATE TABLE `konyvek` (
  `ID` int(11) NOT NULL,
  `cim` varchar(50) NOT NULL,
  `szerzo` varchar(30) NOT NULL,
  `kiadas` int(4) NOT NULL,
  `mufaj_ID` int(11) NOT NULL,
  `tipus_ID` int(11) NOT NULL,
  `nyelv` varchar(10) NOT NULL,
  `azonosito` int(11) NOT NULL,
  `oldalszam` int(11) NOT NULL,
  `kolcsonozheto` int(1) NOT NULL,
  `darab` int(11) NOT NULL,
  `reszletek` varchar(1000) NOT NULL,
  `datum` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `konyvek`
--

INSERT INTO `konyvek` (`ID`, `cim`, `szerzo`, `kiadas`, `mufaj_ID`, `tipus_ID`, `nyelv`, `azonosito`, `oldalszam`, `kolcsonozheto`, `darab`, `reszletek`, `datum`) VALUES
(1, 'A Marsi', 'Andy Weir', 2014, 6, 1, 'magyar', 6514, 357, 1, 1, '', '2023-03-22 08:18:25'),
(2, 'Egy polgár sorsa', 'Polgár Árpád', 2022, 1, 1, 'magyar', 1234, 156, 0, 1, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Placeat, suscipit cum? Sapiente eveniet nemo earum illo a eos, dolorem in!', '2023-03-22 08:18:25'),
(3, 'Édes Anna', 'Kosztolányi Dezső', 2022, 2, 3, 'magyar', 1658, 281, 1, 3, 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Illo iste corrupti quae. Quisquam magnam rerum tenetur iste harum quos modi.\r\n', '2023-03-22 08:28:47'),
(4, 'Robinson Crusoe', 'Daniel Defoe', 2021, 0, 3, 'magyar', 8156, 410, 0, 0, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Atque, natus. Sed officiis itaque quibusdam magni numquam, quam hic quas nesciunt?\r\n', '2023-03-22 08:28:47'),
(5, 'Nemzeti sport', '', 1903, 0, 2, 'magyar', 8465, 0, 0, 1, '', '2023-03-22 08:53:24'),
(6, 'Szép remények', 'Charles Dickens', 2022, 2, 1, 'magyar', 6153, 532, 1, 5, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quod sapiente corporis fugit eveniet consectetur cum, optio in? Consequatur, ut voluptatibus.\r\n', '2023-03-22 08:22:56'),
(7, 'Ignite me', 'Tahereh Mafi', 0, 6, 1, 'angol', 3215, 408, 0, 1, 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Laborum explicabo illum aut inventore modi. Distinctio minima ipsum nostrum quae repellendus.\r\n', '2023-03-22 08:17:02'),
(8, 'Élet a Földön', 'David Attenborough', 2023, 0, 4, 'magyar', 5123, 396, 0, 1, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ut vitae amet placeat ex quibusdam inventore nobis ducimus repellendus sint minus?\r\n', '2023-03-22 08:17:02'),
(9, 'Az utolsó mohikán', 'James Fenimore Cooper', 2023, 0, 4, 'magyar', 2635, 0, 0, 1, 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Nulla rem repellat sit ad libero, distinctio sed neque velit reprehenderit nostrum?\r\n', '2023-03-22 08:24:08'),
(10, 'Élet a Földön', 'David Attenborough', 2021, 0, 1, 'magyar', 3452, 433, 1, 2, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatum facere est aperiam. Tempora excepturi repellat fugiat earum nam quod similique!\r\n', '2023-03-22 08:37:23');

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `konyvek`
--
ALTER TABLE `konyvek`
  ADD PRIMARY KEY (`ID`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `konyvek`
--
ALTER TABLE `konyvek`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
