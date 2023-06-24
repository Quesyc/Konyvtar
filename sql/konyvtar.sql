-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2023. Jún 20. 21:39
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
-- Tábla szerkezet ehhez a táblához `felhasznalok`
--

CREATE TABLE `felhasznalok` (
  `ID` int(11) NOT NULL,
  `azonosito` int(11) NOT NULL,
  `nev` varchar(30) NOT NULL,
  `jelszo` varchar(100) NOT NULL,
  `statusz` enum('aktiv','torolve','','') NOT NULL,
  `tipus` enum('konyvtaros','olvaso','','') NOT NULL,
  `lakcim` varchar(30) NOT NULL,
  `szuletesiev` date NOT NULL,
  `email` varchar(30) NOT NULL,
  `telefonszam` varchar(30) NOT NULL,
  `datum` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `felhasznalok`
--

INSERT INTO `felhasznalok` (`ID`, `azonosito`, `nev`, `jelszo`, `statusz`, `tipus`, `lakcim`, `szuletesiev`, `email`, `telefonszam`, `datum`) VALUES
(1, 1001, 'admin', '12345', 'aktiv', 'konyvtaros', 'Székesfehérvár', '1993-08-06', 'valami@mail.com', '0', '2023-06-03 16:38:59'),
(6, 45, 'Teszt', '6c90aa3760658846a86a263a4e92630e', 'aktiv', 'konyvtaros', '', '2023-06-08', 'teszt@teszt.com', '', '2023-06-08 20:35:55'),
(7, 5286, 'olvaso', 'd8d3c071ed7ad4dbcdb2c172e98a19c5', 'aktiv', 'olvaso', '', '2023-06-19', 'olvaso@olvaso.com', '', '2023-06-19 21:08:57');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `kepek`
--

CREATE TABLE `kepek` (
  `ID` int(11) NOT NULL,
  `kapcs_ID` int(11) NOT NULL,
  `statusz` enum('aktiv','torolve') NOT NULL,
  `nev` varchar(300) NOT NULL,
  `cim` varchar(100) NOT NULL,
  `utvonal` varchar(300) NOT NULL,
  `sorrend` int(11) NOT NULL,
  `kep_datum` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `kepek`
--

INSERT INTO `kepek` (`ID`, `kapcs_ID`, `statusz`, `nev`, `cim`, `utvonal`, `sorrend`, `kep_datum`) VALUES
(1, 1, 'aktiv', 'amarsi', 'A Marsi - Andy Weir', 'amarsi.jpg', 1, '2023-06-04 17:25:56'),
(2, 2, 'aktiv', 'egypolgarsorsa', 'Egy polgár sorsa - ', 'egypolgarsorsa.jpg', 1, '2023-06-04 17:25:56'),
(3, 3, 'aktiv', 'edesanna', 'Édes Anna - Kosztolányi Dezső', 'edesanna.jpg', 1, '2023-03-22 08:57:59'),
(4, 4, 'aktiv', 'Robinson Crusoe', 'Robinson Crusoe - Daniel Defoe', 'robinsoncrusoe.jpg', 1, '2023-03-22 09:01:00'),
(5, 5, 'aktiv', 'Nemzeti sport', 'Nemzeti sport', 'nemzetisport.jpg', 1, '2023-03-22 09:02:33'),
(6, 6, 'aktiv', 'Szép remények', 'Szép remények - Charles Dickens', 'szepremenyek.jpg', 1, '2023-03-22 09:04:21'),
(7, 7, 'aktiv', 'Ignite me', 'Ignite me - Tahereh Mafi', 'igniteme.jpg', 1, '2023-03-22 09:05:11'),
(8, 8, 'aktiv', 'Élet a Földön', 'Élet a Földön - David Attenborough', 'eletafoldon.jpg', 1, '2023-03-22 09:06:41'),
(9, 9, 'aktiv', 'Az utolsó mohikán', 'Az utolsó mohikán - James Fenimore Cooper', 'azutolsomohikan.jpg', 1, '2023-03-22 09:08:15'),
(10, 10, 'aktiv', 'Élet a Földön', 'Élet a Földön - David Attenborough', 'eletafoldon.jpg', 1, '2023-03-22 09:09:07'),
(11, 11, 'aktiv', 'the_witcher', 'The Witcher', 'witcher.jpg', 1, '2023-06-17 19:43:52');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `kolcsonzesek`
--

CREATE TABLE `kolcsonzesek` (
  `ID` int(11) NOT NULL,
  `felh_ID` int(11) NOT NULL,
  `konyv_ID` int(11) NOT NULL,
  `lejarat` date NOT NULL,
  `datum` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `konyvek`
--

CREATE TABLE `konyvek` (
  `ID` int(11) NOT NULL,
  `statusz` enum('aktiv','torolve') NOT NULL,
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

INSERT INTO `konyvek` (`ID`, `statusz`, `cim`, `szerzo`, `kiadas`, `mufaj_ID`, `tipus_ID`, `nyelv`, `azonosito`, `oldalszam`, `kolcsonozheto`, `darab`, `reszletek`, `datum`) VALUES
(1, 'aktiv', 'A Marsi', 'Andy Weir', 2014, 10, 1, 'magyar', 6514, 357, 1, 1, '', '2023-03-22 08:18:25'),
(2, 'aktiv', 'Egy polgár sorsa', 'Polgár Árpád', 2022, 1, 1, 'magyar', 1234, 156, 0, 1, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Placeat, suscipit cum? Sapiente eveniet nemo earum illo a eos, dolorem in!', '2023-03-22 08:18:25'),
(3, 'aktiv', 'Édes Anna', 'Kosztolányi Dezső', 2022, 2, 3, 'magyar', 1658, 281, 1, 72, 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Illo iste corrupti quae. Quisquam magnam rerum tenetur iste harum quos modi.\r\n', '2023-03-22 08:28:47'),
(4, 'aktiv', 'Robinson Crusoe', 'Daniel Defoe', 2021, 7, 3, 'magyar', 8156, 410, 0, 2, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Atque, natus. Sed officiis itaque quibusdam magni numquam, quam hic quas nesciunt?\r\n', '2023-03-22 08:28:47'),
(5, 'aktiv', 'Nemzeti sport', '', 1903, 1, 2, 'magyar', 8465, 0, 0, 1, '', '2023-03-22 08:53:24'),
(6, 'aktiv', 'Szép remények', 'Charles Dickens', 2022, 2, 1, 'magyar', 6153, 532, 1, 4, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quod sapiente corporis fugit eveniet consectetur cum, optio in? Consequatur, ut voluptatibus.\r\n', '2023-03-22 08:22:56'),
(7, 'aktiv', 'Ignite me', 'Tahereh Mafi', 0, 10, 1, 'angol', 3215, 408, 0, 1, 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Laborum explicabo illum aut inventore modi. Distinctio minima ipsum nostrum quae repellendus.\r\n', '2023-03-22 08:17:02'),
(8, 'aktiv', 'Élet a Földön', 'David Attenborough', 2023, 8, 4, 'magyar', 5123, 396, 0, 1, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ut vitae amet placeat ex quibusdam inventore nobis ducimus repellendus sint minus?\r\n', '2023-03-22 08:17:02'),
(9, 'aktiv', 'Az utolsó mohikán', 'James Fenimore Cooper', 2023, 7, 4, 'magyar', 2635, 220, 0, 1, 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Nulla rem repellat sit ad libero, distinctio sed neque velit reprehenderit nostrum?\r\n', '2023-03-22 08:24:08'),
(10, 'aktiv', 'Élet a Földön', 'David Attenborough', 2021, 8, 1, 'magyar', 3452, 433, 1, 1, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatum facere est aperiam. Tempora excepturi repellat fugiat earum nam quod similique!\r\n', '2023-03-22 08:37:23'),
(11, 'torolve', 'The Witcher - Az utolsó kívánság', 'Andrzej Sapkowski', 2019, 7, 0, 'Angol', 6939, 153, 1, 1, '', '2023-06-15 19:35:59'),
(14, 'torolve', '', '', 0, 0, 0, '', 4880, 0, 0, 0, '', '2023-06-17 20:01:42'),
(19, 'torolve', 'új könyv', '', 0, 0, 0, '', 7988, 0, 0, 0, '', '2023-06-17 21:06:51'),
(20, 'torolve', 'új könyv', '', 0, 0, 0, '', 4222, 0, 0, 0, '', '2023-06-17 21:08:43'),
(21, 'torolve', 'új könyv', '', 0, 0, 0, '', 5075, 0, 0, 0, '', '2023-06-19 20:54:30'),
(22, 'torolve', 'új könyv', '', 0, 1, 0, '', 6946, 0, 0, 0, '', '2023-06-19 21:54:30');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `mufajok`
--

CREATE TABLE `mufajok` (
  `ID` int(11) NOT NULL,
  `statusz` enum('aktiv','torolve') NOT NULL,
  `nev` varchar(30) NOT NULL,
  `leiras` varchar(300) NOT NULL,
  `datum` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `mufajok`
--

INSERT INTO `mufajok` (`ID`, `statusz`, `nev`, `leiras`, `datum`) VALUES
(1, 'aktiv', 'Közélet', '', '2023-06-03 16:23:34'),
(2, 'aktiv', 'Irodalmi', '', '2023-06-03 16:23:34'),
(3, 'aktiv', 'Politika', '', '2023-06-03 16:24:01'),
(4, 'aktiv', 'Horror', '', '2023-06-03 16:24:01'),
(5, 'aktiv', 'Romantikus', '', '2023-06-03 16:24:22'),
(6, 'torolve', 'Sci-fi', '', '2023-06-03 16:24:22'),
(7, 'aktiv', 'Fantasy', '', '2023-03-22 09:10:25'),
(8, 'aktiv', 'Természettudományi', '', '2023-03-22 09:10:25'),
(9, 'torolve', 'das', '', '2023-06-20 19:58:55'),
(10, 'aktiv', 'Sci-fi', '', '2023-06-20 20:04:08');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `tipusok`
--

CREATE TABLE `tipusok` (
  `ID` int(11) NOT NULL,
  `statusz` enum('aktiv','torolve') NOT NULL,
  `nev` varchar(30) NOT NULL,
  `leiras` varchar(300) NOT NULL,
  `datum` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `tipusok`
--

INSERT INTO `tipusok` (`ID`, `statusz`, `nev`, `leiras`, `datum`) VALUES
(1, 'aktiv', 'Könyv', '', '2023-06-03 15:52:38'),
(2, 'aktiv', 'Újság', '', '2023-06-03 15:52:38'),
(3, 'aktiv', 'Zsebkönyv', '', '2023-06-03 15:54:19'),
(4, 'aktiv', 'Hangoskönyv', '', '2023-06-03 15:54:19'),
(5, 'aktiv', 'Magazin', '', '2023-06-03 15:54:37'),
(6, 'torolve', 'Thriller', '', '2023-06-20 19:48:17'),
(7, 'torolve', 'Thriller', '', '2023-06-20 19:48:17'),
(8, 'torolve', 'Hang fájl', '', '2023-06-20 19:50:38'),
(9, 'torolve', 'Hang fájl', '', '2023-06-20 19:50:38'),
(10, 'torolve', 'Hang fájl', '', '2023-06-20 19:59:00');

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `felhasznalok`
--
ALTER TABLE `felhasznalok`
  ADD PRIMARY KEY (`ID`);

--
-- A tábla indexei `kepek`
--
ALTER TABLE `kepek`
  ADD PRIMARY KEY (`ID`);

--
-- A tábla indexei `kolcsonzesek`
--
ALTER TABLE `kolcsonzesek`
  ADD PRIMARY KEY (`ID`);

--
-- A tábla indexei `konyvek`
--
ALTER TABLE `konyvek`
  ADD PRIMARY KEY (`ID`);

--
-- A tábla indexei `mufajok`
--
ALTER TABLE `mufajok`
  ADD PRIMARY KEY (`ID`);

--
-- A tábla indexei `tipusok`
--
ALTER TABLE `tipusok`
  ADD PRIMARY KEY (`ID`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `felhasznalok`
--
ALTER TABLE `felhasznalok`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT a táblához `kepek`
--
ALTER TABLE `kepek`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT a táblához `kolcsonzesek`
--
ALTER TABLE `kolcsonzesek`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT a táblához `konyvek`
--
ALTER TABLE `konyvek`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT a táblához `mufajok`
--
ALTER TABLE `mufajok`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT a táblához `tipusok`
--
ALTER TABLE `tipusok`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
