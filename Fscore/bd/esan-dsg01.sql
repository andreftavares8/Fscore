-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: mysql-hosting.ua.pt:3306
-- Generation Time: Jan 29, 2020 at 04:14 PM
-- Server version: 10.1.18-MariaDB
-- PHP Version: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `esan-dsg01`
--

-- --------------------------------------------------------

--
-- Table structure for table `competitions`
--

CREATE TABLE `competitions` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `competition_type` varchar(50) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `number_journeys` int(11) NOT NULL,
  `logo_competition` varchar(50) NOT NULL,
  `logo_federation` varchar(50) NOT NULL,
  `logo_trophie` varchar(50) NOT NULL,
  `season` varchar(50) NOT NULL,
  `idcountry` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `competitions`
--

INSERT INTO `competitions` (`id`, `name`, `competition_type`, `start_date`, `end_date`, `number_journeys`, `logo_competition`, `logo_federation`, `logo_trophie`, `season`, `idcountry`) VALUES
(1, 'Liga Nos', 'Liga Portuguesa', '2019-08-09', '2020-06-10', 34, 'liga_nos.png', 'f_portugal.png', 'trofeu_portugal.png', '2019/2020', 1),
(2, 'Liga Pro', '2ª Liga Portuguesa', '2019-08-08', '2020-06-10', 34, 'liga_pro.png', 'f_portugal.png', 'trofeu_campeonato.png', '2019/2020', 1),
(3, 'Campeonato Nacional', '3ª Liga Portuguesa', '2019-08-18', '2020-07-10', 34, 'campeonato_nacional.png', 'f_portugal.png', 'trofeu_campeonato.png', '2019/2020', 1),
(4, 'Campeonato Sabseg', 'Distrital - AF Aveiro', '2019-09-18', '2020-06-10', 34, 'campeonato_sabseg.png', 'af_aveiro.png', 'trofeu_portugal.png', '2019/2020', 1),
(5, 'Campeonato Distrital AFA', '1ª Distrital - AF Aveiro', '2019-09-29', '2020-06-10', 34, 'distrital_1.png', 'af_aveiro.png', 'trofeu_portugal.png', '2019/2020', 1),
(6, 'Campeonato Distrital 2º Divisão', '2ª Distrital - AF Aveiro', '2019-09-18', '2020-06-10', 34, 'distrital_2.png', 'af_aveiro.png', 'trofeu_portugal.png', '2019/2020', 1),
(7, 'Premier League', 'Liga Inglesa', '2019-08-09', '2020-05-19', 38, 'premier_league.png', 'f_inglaterra.png', 'trofeu_inglaterra.png', '2019/2020', 2),
(8, 'La Liga', 'Liga Espanhola', '2019-08-16', '2020-05-25', 38, 'la_liga.png', 'f_espanha.png', 'trofeu_espanha.png', '2019/2020', 3),
(9, 'Serie A', 'Liga Italiana', '2019-09-24', '2020-06-10', 38, 'serie_a.png', 'f_italia.png', 'trofeu_italia.png', '2019/2020', 4),
(10, 'Bundesliga', 'Liga Alemã', '2019-08-16', '2020-05-16', 34, 'bundesliga.png', 'f_alemanha.png', 'trofeu_alemanhal.png', '2019/2020', 5),
(11, 'Ligue 1', 'Liga Francesa', '2019-08-09', '2020-06-01', 38, 'ligue_1.png', 'f_franca.png', 'trofeu_franca.png', '2019/2020', 6),
(12, 'Eredivisie', 'Liga Holandesa', '2019-08-02', '2020-05-25', 34, 'eredivisie.png', 'f_holanda.png', 'trofeu_holanda.png', '2019/2020', 7),
(13, 'Campeonato Distrital 2º Divisão', '2ª Distrital - AF Aveiro', '2018-09-18', '2019-06-10', 34, 'distrital_2.png', 'af_aveiro.png', 'trofeu_portugal.png', '2018/2019', 1),
(14, 'Campeonato Distrital 2º Divisão', '2ª Distrital - AF Aveiro', '2017-09-18', '2018-06-10', 34, 'distrital_2.png', 'af_aveiro.png', 'trofeu_portugal.png', '2017/2018', 1),
(15, 'Campeonato Distrital 2º Divisão', '2ª Distrital - AF Aveiro', '2016-09-18', '2017-06-10', 34, 'distrital_2.png', 'af_aveiro.png', 'trofeu_portugal.png', '2016/2017', 1),
(16, 'Campeonato Distrital 2º Divisão', '2ª Distrital - AF Aveiro', '2015-09-18', '2016-06-10', 34, 'distrital_2.png', 'af_aveiro.png', 'trofeu_campeonato.png', '2015/2016', 1),
(17, 'Liga Pro', '2ª Liga Portuguesa', '2016-09-18', '2017-06-10', 34, 'liga_pro.png', 'f_portugal.png', 'trofeu_portugal.png', '2016/2017', 1),
(18, 'Campeonato Nacional', '3ª Liga Portuguesa', '2015-09-18', '2016-06-10', 34, 'campeonato_nacional.png', 'f_portugal.png', 'trofeu_campeonato.png', '2015/2016', 1),
(19, 'Campeonato Nacional', '3ª Liga Portuguesa', '2014-09-18', '2015-06-10', 34, 'campeonato_nacional.png', 'f_portugal.png', 'trofeu_campeonato.png', '2014/2015', 1),
(20, 'Campeonato Sabseg', 'Distrital - AF Aveiro', '2013-09-18', '2014-06-10', 34, 'campeonato_sabseg.png', 'af_aveiro.png', 'trofeu_campeonato.png', '2013/2014', 1),
(21, 'Campeonato Distrital AFA', '1ª Distrital - AF Aveiro', '2012-09-29', '2013-06-10', 34, 'campeonato_sabseg.png', 'af_aveiro.png', 'trofeu_campeonato.png', '2012/2013', 1),
(22, 'A Kategoria', 'Liga cipriota', '2014-09-18', '2015-06-10', 34, 'liga_chipre.png', 'f_chipre', 'no_trofeu.png', '2014/2015', 8),
(23, 'Liga Pro', '2ª Liga Portuguesa', '2013-09-18', '2014-06-10', 34, 'liga_pro.png', 'f_portugal.png', 'trofeu_campeonato.png', '2013/2014', 1),
(24, 'Campeonato Nacional', '3ª Liga Portuguesa', '2012-09-18', '2013-06-10', 34, 'campeonato_nacional.png', 'f_portugal.png', 'trofeu_campeonato.png', '2012/2013', 1),
(25, 'Campeonato Nacional', '3ª Liga Portuguesa', '2011-09-18', '2012-06-10', 34, 'campeonato_nacional.png', 'f_portugal.png', 'trofeu_campeonato.png', '2011/2012', 1),
(26, 'Liga Pro', '2ª Liga Portuguesa', '2011-09-29', '2012-06-10', 34, 'liga_pro.png', 'f_portugal.png', 'trofeu_portugal.png', '2011/2012', 1),
(27, 'Campeonato Nacional', '3ª Liga Portuguesa', '2010-09-18', '2011-06-10', 34, 'campeonato_nacional.png', 'f_portugal.png', 'trofeu_portugal.png', '2010/2011', 1),
(28, 'Campeonato Nacional', '3ª Liga Portuguesa', '2009-09-18', '2010-06-10', 34, 'campeonato_nacional.png', 'f_portugal.png', 'trofeu_portugal.png', '2009/2010', 1),
(29, 'Campeonato Nacional', '3ª Liga Portuguesa', '2008-09-18', '2009-06-10', 34, 'campeonato_nacional.png', 'f_portugal.png', 'trofeu_portugal.png', '2008/2009', 1),
(30, 'Campeonato Nacional', '3ª Liga Portuguesa', '2007-09-18', '2008-06-10', 34, 'campeonato_nacional.png', 'f_portugal.png', 'trofeu_portugal.png', '2007/2008', 1);

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `flag_country` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `name`, `flag_country`) VALUES
(1, 'Portugal', 'portugal.png'),
(2, 'Inglaterra', 'inglaterra.png'),
(3, 'Espanha', 'espanha.png'),
(4, 'Itália', 'italia.png'),
(5, 'Alemanha', 'alemanha.png'),
(6, 'França', 'franca.png'),
(7, 'Holanda', 'holanda.png'),
(8, 'Chipre', 'chipre.png'),
(9, 'Argentina', 'argentina.png'),
(10, 'Angola', 'angola.png'),
(11, 'Albânia', 'albania.png'),
(12, 'Andorra', 'andorra.png'),
(13, 'Arábia Saudita', 'arabia_saudita.png'),
(14, 'Argélia', 'argelia.png'),
(15, 'Arménia', 'armenia.png'),
(16, 'Austrália', 'australia.png'),
(17, 'Austria', 'austria.png'),
(18, 'Azerbaijão', 'azerbeijao.png'),
(19, 'Austrália', 'australia.png'),
(20, 'Bélgica', 'belgica.png'),
(21, 'Brasil', 'brasil.png'),
(22, 'Bielorrússia', 'bielorrussia.png'),
(23, 'Bolívia', 'bolivia.png'),
(24, 'Bósnia e Herzegovina', 'bosnia.png'),
(25, 'Brunei', 'brunei.png'),
(26, 'Bulgária', 'bulgaria.png'),
(27, 'Burkina Faso', 'burquina_faso.png'),
(28, 'Burundi', 'burundi.png'),
(29, 'Croácia', 'croacia.png'),
(30, 'Colômbia', 'colombia.png'),
(31, 'Camarões', 'camaroes.png'),
(32, 'Cabo Verde', 'cabo_verde.png'),
(33, 'Costa de Marfim', 'costa_marfim.png'),
(34, 'Coreia do Sul', 'coreia_sul.png'),
(35, 'Costa Rica', 'costa_rica.png'),
(36, 'Camarões', 'camaroes.png'),
(37, 'Cuba', 'cuba.png'),
(38, 'Curaçao', 'curacao.png'),
(39, 'Dinamarca', 'dinamarca.png'),
(40, 'Equador', 'equador.png'),
(41, 'Estados Unidos', 'usa.png'),
(42, 'Egito', 'egipto.png'),
(43, 'Emirados dos Emirados Árabes Unidos', 'emirados_arabes_unidos.png'),
(44, 'Escócia', 'escocia.png'),
(45, 'Eslováquia', 'eslovaquia.png'),
(46, 'Eslovénia', 'eslovenia.png'),
(47, 'Estónia', 'estonia.png'),
(48, 'Grécia', 'grecia.png'),
(49, 'Gana', 'gana.png'),
(50, 'Gambia', 'gambia.png'),
(51, 'Gabão', 'gabao.png'),
(52, 'Geórgia', 'georgia.png'),
(53, 'Gibraltar', 'gribaltar.png'),
(54, 'Guiné-Bissau', 'guine_bissau.png'),
(55, 'Hungria', 'hungria.png'),
(56, 'Indonésia', 'indonesia.png'),
(57, 'Islândia', 'islandia.png'),
(58, 'Israel', 'israel.png'),
(59, 'Japão', 'japao.png'),
(60, 'Jamaica', 'jamaica.png'),
(61, 'Jordânia', 'jordania.png'),
(62, 'Letónia', 'letonia.png'),
(63, 'Luxemburgo', 'lexemburgo.png'),
(64, 'Lituânia', 'lituania.png'),
(65, 'Marrocos', 'marrocos.png'),
(66, 'México', 'mexico.png'),
(67, 'Mali', 'mali.png'),
(68, 'Macedonia', 'macedonia.png'),
(69, 'Moldávia', 'moldavia.png'),
(70, 'Moçambique', 'mocambique.png'),
(71, 'Nigéria', 'nigeria.png'),
(72, 'Noruega', 'noruega.png'),
(73, 'Paraguai', 'paraguai.png'),
(74, 'Peru', 'peru.png'),
(75, 'Polónia', 'polonia.png'),
(76, 'País de Gales', 'pais_gales.png'),
(77, 'Kosovo', 'kosovo.png'),
(78, 'Kuwait', 'kuwait.png'),
(79, 'Rússia', 'russia.png'),
(80, 'Républica  do Congo', 'rg_do_congo.png'),
(81, 'Républica Checa	', 'rp_checa.png'),
(82, 'Romenia', 'romenia.png'),
(83, 'República da Irlanda', 'irlanda.png'),
(84, 'Suiça', 'suica.png'),
(85, 'Sérvia', 'servia.png'),
(86, 'Senegal', 'senegal.png'),
(87, 'Suécia', 'suecia.png'),
(88, 'África do Sul', 'africa_do_sul.png'),
(89, 'Suécia', 'suecia.png'),
(90, 'Uruguai ', 'uruguai.png'),
(91, 'Ucrânia', 'ucrania.png'),
(92, 'Tunísia', 'tunisia.png'),
(93, 'Turquia', 'turquia.png'),
(94, 'Venezuela', 'venezuela.png'),
(95, 'no country', 'no_country.png');

-- --------------------------------------------------------

--
-- Table structure for table `favorites_competitions`
--

CREATE TABLE `favorites_competitions` (
  `id` int(11) NOT NULL,
  `iduser` int(11) NOT NULL,
  `idcompetition` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `favorites_competitions`
--

INSERT INTO `favorites_competitions` (`id`, `iduser`, `idcompetition`) VALUES
(1, 1, 1),
(2, 1, 6),
(3, 1, 9),
(6, 2, 1),
(13, 19, 22),
(15, 19, 5),
(19, 2, 11),
(33, 2, 6);

-- --------------------------------------------------------

--
-- Table structure for table `favorites_managers`
--

CREATE TABLE `favorites_managers` (
  `id` int(11) NOT NULL,
  `iduser` int(11) NOT NULL,
  `idmanager` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `favorites_managers`
--

INSERT INTO `favorites_managers` (`id`, `iduser`, `idmanager`) VALUES
(1, 1, 1),
(2, 1, 33),
(3, 1, 24),
(5, 2, 33),
(13, 19, 20),
(15, 19, 37),
(21, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `favorites_players`
--

CREATE TABLE `favorites_players` (
  `id` int(11) NOT NULL,
  `iduser` int(11) NOT NULL,
  `idplayer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `favorites_players`
--

INSERT INTO `favorites_players` (`id`, `iduser`, `idplayer`) VALUES
(1, 1, 15),
(2, 1, 20),
(3, 1, 86),
(9, 19, 25),
(11, 19, 82),
(23, 2, 15);

-- --------------------------------------------------------

--
-- Table structure for table `favorites_teams`
--

CREATE TABLE `favorites_teams` (
  `id` int(11) NOT NULL,
  `iduser` int(11) NOT NULL,
  `idteam` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `favorites_teams`
--

INSERT INTO `favorites_teams` (`id`, `iduser`, `idteam`) VALUES
(1, 1, 1),
(3, 1, 47),
(5, 2, 33),
(6, 2, 47),
(9, 19, 3),
(11, 19, 25),
(57, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `games_clashes`
--

CREATE TABLE `games_clashes` (
  `id` int(11) NOT NULL,
  `idteam_home` int(11) NOT NULL,
  `idteam_away` int(11) NOT NULL,
  `idcompetition` int(11) NOT NULL,
  `number_journey` int(11) NOT NULL,
  `date_game` date NOT NULL,
  `time_game` time NOT NULL,
  `season` varchar(20) NOT NULL,
  `idstadium` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `games_clashes`
--

INSERT INTO `games_clashes` (`id`, `idteam_home`, `idteam_away`, `idcompetition`, `number_journey`, `date_game`, `time_game`, `season`, `idstadium`) VALUES
(1, 13, 14, 6, 1, '2019-09-29', '15:00:00', '2019/2020', 13),
(2, 18, 9, 6, 1, '2019-09-29', '15:00:00', '2019/2020', 18),
(3, 10, 11, 6, 1, '2019-09-29', '15:00:00', '2019/2020', 10),
(4, 12, 3, 6, 1, '2019-09-29', '15:00:00', '2019/2020', 12),
(5, 7, 17, 6, 1, '2019-09-29', '15:00:00', '2019/2020', 7),
(6, 6, 16, 6, 1, '2019-09-29', '15:00:00', '2019/2020', 6),
(7, 2, 1, 6, 1, '2019-09-29', '15:00:00', '2019/2020', 2),
(8, 5, 15, 6, 1, '2019-09-29', '15:00:00', '2019/2020', 5),
(9, 8, 4, 6, 1, '2019-09-29', '15:00:00', '2019/2020', 8),
(10, 3, 7, 6, 2, '2019-10-05', '15:00:00', '2019/2020', 3),
(11, 14, 12, 6, 2, '2019-10-05', '15:00:00', '2019/2020', 14),
(12, 9, 13, 6, 2, '2019-10-05', '15:00:00', '2019/2020', 9),
(13, 17, 5, 6, 2, '2019-10-05', '15:00:00', '2019/2020', 17),
(14, 15, 2, 6, 2, '2019-10-05', '15:00:00', '2019/2020', 15),
(15, 4, 10, 6, 2, '2019-10-06', '15:00:00', '2019/2020', 4),
(16, 1, 6, 6, 2, '2019-10-06', '15:00:00', '2019/2020', 1),
(17, 11, 18, 6, 2, '2019-10-06', '15:00:00', '2019/2020', 11),
(18, 16, 8, 6, 2, '2019-10-06', '15:00:00', '2019/2020', 16),
(19, 12, 9, 6, 3, '2019-10-13', '15:00:00', '2019/2020', 12),
(20, 13, 11, 6, 3, '2019-10-13', '15:00:00', '2019/2020', 13),
(21, 10, 18, 6, 3, '2019-10-13', '15:00:00', '2019/2020', 10),
(22, 7, 14, 6, 3, '2019-10-13', '15:00:00', '2019/2020', 7),
(23, 5, 3, 6, 3, '2019-10-13', '15:00:00', '2019/2020', 5),
(24, 8, 1, 6, 3, '2019-10-13', '15:00:00', '2019/2020', 8),
(25, 6, 15, 6, 3, '2019-10-13', '15:00:00', '2019/2020', 6),
(26, 2, 17, 6, 3, '2019-10-13', '15:00:00', '2019/2020', 2),
(27, 4, 16, 6, 3, '2019-10-13', '15:00:00', '2019/2020', 4),
(28, 3, 2, 6, 4, '2019-10-19', '15:00:00', '2019/2020', 3),
(29, 11, 12, 6, 4, '2019-10-20', '15:00:00', '2019/2020', 11),
(30, 18, 13, 6, 4, '2019-10-20', '15:00:00', '2019/2020', 18),
(31, 9, 7, 6, 4, '2019-10-20', '15:00:00', '2019/2020', 9),
(32, 14, 5, 6, 4, '2019-10-20', '15:00:00', '2019/2020', 14),
(33, 1, 4, 6, 4, '2019-10-20', '15:00:00', '2019/2020', 1),
(34, 15, 8, 6, 4, '2019-10-20', '15:00:00', '2019/2020', 15),
(35, 17, 6, 6, 4, '2019-10-20', '15:00:00', '2019/2020', 17),
(36, 16, 10, 6, 4, '2019-10-20', '15:00:00', '2019/2020', 16),
(37, 7, 11, 6, 5, '2019-10-27', '15:00:00', '2019/2020', 7),
(38, 12, 18, 6, 5, '2019-10-27', '15:00:00', '2019/2020', 12),
(39, 10, 13, 6, 5, '2019-10-27', '15:00:00', '2019/2020', 10),
(40, 5, 9, 6, 5, '2019-10-27', '15:00:00', '2019/2020', 5),
(41, 2, 14, 6, 5, '2019-10-27', '15:00:00', '2019/2020', 2),
(42, 4, 15, 6, 5, '2019-10-27', '15:00:00', '2019/2020', 4),
(43, 8, 17, 6, 5, '2019-10-27', '15:00:00', '2019/2020', 8),
(44, 6, 3, 6, 5, '2019-10-27', '15:00:00', '2019/2020', 6),
(45, 16, 1, 6, 5, '2019-10-27', '15:00:00', '2019/2020', 16),
(46, 3, 8, 6, 6, '2019-11-02', '15:00:00', '2019/2020', 3),
(47, 18, 7, 6, 6, '2019-11-03', '15:00:00', '2019/2020', 18),
(48, 13, 12, 6, 6, '2019-11-03', '15:00:00', '2019/2020', 13),
(49, 11, 5, 6, 6, '2019-11-03', '15:00:00', '2019/2020', 11),
(50, 9, 2, 6, 6, '2019-11-03', '15:00:00', '2019/2020', 9),
(51, 15, 16, 6, 6, '2019-11-03', '15:00:00', '2019/2020', 15),
(52, 17, 4, 6, 6, '2019-11-03', '15:00:00', '2019/2020', 17),
(53, 14, 6, 6, 6, '2019-11-03', '15:00:00', '2019/2020', 14),
(54, 1, 10, 6, 6, '2019-11-03', '15:00:00', '2019/2020', 1),
(55, 8, 14, 6, 7, '2019-11-09', '15:00:00', '2019/2020', 8),
(56, 7, 13, 6, 7, '2019-11-10', '15:00:00', '2019/2020', 7),
(57, 10, 12, 6, 7, '2019-11-10', '15:00:00', '2019/2020', 10),
(58, 5, 18, 6, 7, '2019-11-10', '15:00:00', '2019/2020', 5),
(59, 2, 11, 6, 7, '2019-11-10', '15:00:00', '2019/2020', 2),
(60, 16, 17, 6, 7, '2019-11-10', '15:00:00', '2019/2020', 16),
(61, 4, 3, 6, 7, '2019-11-10', '15:00:00', '2019/2020', 4),
(62, 6, 9, 6, 7, '2019-11-10', '15:00:00', '2019/2020', 6),
(63, 1, 15, 6, 7, '2019-11-10', '15:00:00', '2019/2020', 1),
(64, 3, 16, 6, 8, '2019-11-23', '15:00:00', '2019/2020', 2),
(65, 13, 5, 6, 8, '2019-11-24', '15:00:00', '2019/2020', 13),
(66, 12, 7, 6, 8, '2019-11-24', '15:00:00', '2019/2020', 12),
(67, 18, 2, 6, 8, '2019-11-24', '15:00:00', '2019/2020', 18),
(68, 11, 6, 6, 8, '2019-11-24', '15:00:00', '2019/2020', 11),
(69, 17, 1, 6, 8, '2019-11-24', '15:00:00', '2019/2020', 17),
(70, 14, 4, 6, 8, '2019-11-24', '15:00:00', '2019/2020', 14),
(71, 9, 8, 6, 8, '2019-11-24', '15:00:00', '2019/2020', 9),
(72, 15, 10, 6, 8, '2019-11-24', '15:00:00', '2019/2020', 15),
(73, 8, 11, 6, 9, '2019-12-30', '15:00:00', '2019/2020', 8),
(74, 5, 12, 6, 9, '2019-12-01', '15:00:00', '2019/2020', 5),
(75, 10, 7, 6, 9, '2019-12-01', '15:00:00', '2019/2020', 10),
(76, 2, 13, 6, 9, '2019-12-01', '15:00:00', '2019/2020', 2),
(77, 6, 18, 6, 9, '2019-12-01', '15:00:00', '2019/2020', 6),
(78, 1, 3, 6, 9, '2019-12-01', '15:00:00', '2019/2020', 1),
(79, 16, 14, 6, 9, '2019-12-01', '15:00:00', '2019/2020', 16),
(80, 4, 9, 6, 9, '2019-12-01', '15:00:00', '2019/2020', 14),
(81, 15, 17, 6, 9, '2019-12-01', '15:00:00', '2019/2020', 15),
(82, 3, 15, 6, 10, '2019-12-08', '15:00:00', '2019/2020', 18),
(83, 18, 8, 6, 10, '2019-12-08', '15:00:00', '2019/2020', 13),
(84, 7, 5, 6, 10, '2019-12-08', '15:00:00', '2019/2020', 7),
(85, 13, 6, 6, 10, '2019-12-08', '15:00:00', '2019/2020', 11),
(86, 11, 4, 6, 10, '2019-12-08', '15:00:00', '2019/2020', 9),
(87, 17, 10, 6, 10, '2019-12-08', '15:00:00', '2019/2020', 17),
(88, 14, 1, 6, 10, '2019-12-08', '15:00:00', '2019/2020', 3),
(89, 9, 16, 6, 10, '2019-12-08', '15:00:00', '2019/2020', 14),
(90, 12, 2, 6, 10, '2019-12-29', '15:00:00', '2019/2020', 12),
(91, 8, 13, 6, 11, '2019-12-15', '15:00:00', '2019/2020', 6),
(92, 2, 7, 6, 11, '2019-12-15', '15:00:00', '2019/2020', 2),
(93, 10, 5, 6, 11, '2019-12-15', '15:00:00', '2019/2020', 10),
(94, 6, 12, 6, 11, '2019-12-15', '15:00:00', '2019/2020', 8),
(95, 4, 18, 6, 11, '2019-12-15', '15:00:00', '2019/2020', 4),
(96, 15, 14, 6, 11, '2019-12-15', '15:00:00', '2019/2020', 15),
(97, 1, 9, 6, 11, '2019-12-15', '15:00:00', '2019/2020', 1),
(98, 16, 11, 6, 11, '2019-12-15', '15:00:00', '2019/2020', 16),
(99, 17, 3, 6, 11, '2019-12-15', '15:00:00', '2019/2020', 17),
(100, 3, 10, 6, 12, '2019-12-22', '15:00:00', '2019/2020', 12),
(101, 7, 6, 6, 12, '2019-12-22', '15:00:00', '2019/2020', 7),
(102, 5, 2, 6, 12, '2019-12-22', '15:00:00', '2019/2020', 5),
(103, 12, 8, 6, 12, '2019-12-22', '15:00:00', '2019/2020', 13),
(104, 13, 4, 6, 12, '2019-12-22', '15:00:00', '2019/2020', 18),
(105, 14, 17, 6, 12, '2019-12-22', '15:00:00', '2019/2020', 14),
(106, 9, 15, 6, 12, '2019-12-22', '15:00:00', '2019/2020', 9),
(107, 11, 1, 6, 12, '2019-12-22', '15:00:00', '2019/2020', 11),
(108, 18, 16, 6, 12, '2019-12-22', '15:00:00', '2019/2020', 3),
(109, 3, 14, 6, 13, '2020-01-05', '15:00:00', '2019/2020', 8),
(110, 17, 9, 6, 13, '2020-01-05', '15:00:00', '2019/2020', 6),
(111, 8, 7, 6, 13, '2020-01-05', '15:00:00', '2019/2020', 10),
(112, 10, 2, 6, 13, '2020-01-05', '15:00:00', '2019/2020', 4),
(113, 6, 5, 6, 13, '2020-01-05', '15:00:00', '2019/2020', 16),
(114, 1, 18, 6, 13, '2020-01-05', '15:00:00', '2019/2020', 17),
(115, 16, 13, 6, 13, '2020-01-05', '15:00:00', '2019/2020', 15),
(116, 4, 12, 6, 13, '2020-01-05', '15:00:00', '2019/2020', 1),
(117, 15, 11, 6, 13, '2020-01-05', '15:00:00', '2019/2020', 3),
(118, 7, 4, 6, 14, '2020-01-12', '15:00:00', '2019/2020', 7),
(119, 5, 8, 6, 14, '2020-01-12', '15:00:00', '2019/2020', 5),
(120, 2, 6, 6, 14, '2020-01-12', '15:00:00', '2019/2020', 2),
(121, 12, 16, 6, 14, '2020-01-12', '15:00:00', '2019/2020', 12),
(122, 13, 1, 6, 14, '2020-01-12', '15:00:00', '2019/2020', 13),
(123, 9, 3, 6, 14, '2020-01-12', '15:00:00', '2019/2020', 9),
(124, 11, 17, 6, 14, '2020-01-12', '15:00:00', '2019/2020', 11),
(125, 18, 15, 6, 14, '2020-01-12', '15:00:00', '2019/2020', 18),
(126, 14, 10, 6, 14, '2020-01-12', '15:00:00', '2019/2020', 14),
(127, 1, 3, 6, 17, '2020-01-25', '16:00:00', '2019/2020', 1),
(128, 20, 19, 1, 1, '2020-01-25', '19:30:00', '2019/2020', 20),
(129, 23, 24, 7, 1, '2020-01-25', '15:30:00', '2019/2020', 23),
(130, 21, 22, 8, 1, '2020-01-25', '16:30:00', '2019/2020', 21),
(131, 25, 26, 9, 1, '2020-01-25', '17:30:00', '2019/2020', 26),
(132, 27, 28, 10, 1, '2020-01-25', '18:30:00', '2019/2020', 27),
(133, 29, 30, 11, 1, '2020-01-25', '14:30:00', '2019/2020', 29),
(134, 31, 32, 12, 1, '2020-01-25', '15:30:00', '2019/2020', 31),
(135, 1, 3, 6, 10, '2018-09-10', '18:00:00', '2018/2019', 1),
(136, 3, 1, 6, 10, '2018-09-10', '18:00:00', '2018/2019', 3),
(137, 3, 1, 6, 5, '2017-11-25', '17:00:00', '2017/2018', 3),
(138, 1, 3, 6, 15, '2018-05-25', '16:00:00', '2017/2018', 1),
(139, 47, 48, 6, 15, '2019-09-29', '16:00:00', '2019/2020', 1);

-- --------------------------------------------------------

--
-- Table structure for table `internation_teams`
--

CREATE TABLE `internation_teams` (
  `id` int(11) NOT NULL,
  `idteam` int(11) NOT NULL,
  `idplayer` int(11) NOT NULL,
  `summoned` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `internation_teams`
--

INSERT INTO `internation_teams` (`id`, `idteam`, `idplayer`, `summoned`) VALUES
(1, 47, 63, 1),
(2, 47, 64, 1),
(3, 47, 65, 1),
(4, 47, 66, 1),
(5, 47, 67, 1),
(6, 47, 68, 1),
(7, 47, 69, 1),
(8, 47, 70, 1),
(9, 47, 71, 1),
(10, 47, 72, 1),
(11, 47, 73, 1),
(12, 47, 74, 1),
(13, 47, 75, 1),
(16, 47, 78, 1),
(17, 47, 79, 1),
(18, 47, 80, 1),
(19, 47, 81, 1),
(20, 47, 82, 1),
(21, 47, 83, 1),
(22, 47, 84, 1),
(23, 47, 85, 1),
(24, 47, 86, 1);

-- --------------------------------------------------------

--
-- Table structure for table `managers`
--

CREATE TABLE `managers` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `nickname` varchar(50) NOT NULL,
  `birth_date` date NOT NULL,
  `photo_manager` varchar(50) NOT NULL,
  `favorite_tatic` varchar(10) NOT NULL,
  `idcountry` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `managers`
--

INSERT INTO `managers` (`id`, `name`, `nickname`, `birth_date`, `photo_manager`, `favorite_tatic`, `idcountry`) VALUES
(1, 'Bruno Alexandre Moreira Batista', 'Bruno Batista', '1982-12-03', 'chico_batista.png', '4-4-3', 1),
(2, 'Rui Eusébio', 'Rui Eusébio', '1977-11-23', 'photo_manager.png', '3-5-2', 1),
(3, 'Nuno Gonçalves', 'Nuno Gonçalves', '1977-11-23', 'nuno_goncalves.png', '4-4-2', 1),
(4, 'Tiago da Silva Dias Ribas', 'Tiago Ribas', '1988-05-09', 'tiago_ribas.png', '4-4-2', 1),
(5, 'name', 'nickname', '0000-00-00', 'photo_manager.png', '4-4-2', 1),
(6, 'Sérgio Miguel Ferreira da Silva', 'Sérgio Silva', '1981-09-07', 'sergio_silva.png', '4-4-3', 1),
(7, 'Marco André Gomes Teixeira', 'André Teixeira', '1976-08-10', 'andre_teixeira.png', '4-4-2', 1),
(8, 'Joaquim dos Santos Martins', 'Joaquim Martins', '1970-08-16', 'joaquim_martins.png', '4-4-3', 1),
(9, 'name', 'nickname', '1976-08-10', 'photo_manager.png', '4-4-3', 1),
(10, 'name', 'nickname', '1970-08-16', 'photo_manager.png', '4-2-3-1', 1),
(11, 'name', 'nickname', '1971-07-00', 'photo_manager.png', '4-1-3-2', 1),
(12, 'Torcato Duarte Moreira', 'Torcato Moreira', '1971-07-03', 'torcato_moreira.png', '4-4-2', 1),
(13, 'Rogério Rodrigues', 'Rogério Rodrigues', '1976-08-01', 'photo_manager.png', '4-5-1', 1),
(14, 'João Paulo Martins Brandão', 'João Brandão', '1987-08-04', 'joao_brandao.png', '4-4-2', 1),
(15, 'name', 'nickname', '1976-08-01', 'photo_manager.png', '4-4-2', 1),
(16, 'Carlos André Nunes Lopes', 'André Lopes', '1983-08-26', 'andre_lopes.png', '4-4-3', 1),
(17, 'name', 'nickname', '1987-08-04', 'photo_manager.png', '4-4-2', 1),
(18, 'name', 'nickname', '1983-08-26', 'photo_manager.png', '4-4-3', 1),
(19, 'Sérgio Paulo Marceneiro Conceição', 'Sérgio Conceição', '1974-11-15', 'sergio_conceicao.png', '4-4-2', 1),
(20, 'Bruno Miguel Silva do Nascimento', 'Bruno Lage', '1976-05-12', 'bruno_lage.png', '4-4-1-1', 1),
(21, 'Zinédine Yazid Zidane', 'Zinédine Zidane', '1972-06-23', 'zinedine_zidane.png', '4-3-3', 6),
(22, 'Ernesto Valverde Tejedor', 'Ernesto Valverde', '1964-02-09', 'ernesto_valverde.png', '4-3-3', 3),
(23, 'Josep Guardiola i Sala', 'Pep Guardiola', '1971-01-18', 'pep_guardiola.png', '4-4-3', 3),
(24, 'Jürgen Norbert Klopp', 'Jürgen Klopp', '1967-06-16', 'jurgen_klopp.png', '4-4-3', 5),
(25, 'Maurizio Sarri', 'Maurizio Sarri', '1959-01-10', 'maurizio_sarri.png', '4-4-3', 4),
(26, 'Antonio Conte', 'Antonio Conte', '1969-07-31', 'antonio_conte.png', '3-5-2', 4),
(27, 'Hans-Dieter Flick', 'Hans-Dieter Flick', '1965-02-24', 'hans_dieter_flick.png', '4-4-3', 3),
(28, 'Lucien Favre', 'Lucien Favre', '1957-11-02', 'lucien_favre.png', '4-2-3-1', 84),
(29, 'Thomas Tuchel', 'Thomas Tuchel', '1973-08-29', 'thomas_tuchel.png', '4-3-3', 5),
(30, 'Luís André Pina Cabral Villas-Boas', 'Andre Villas-Boas', '1977-10-17', 'andre_villas_boas.png', '4-3-3', 1),
(31, 'Erik ten Hag', 'Erik ten Hag', '1970-02-02', 'erik_ten_hag.png', '4-4-3', 7),
(32, 'Ernest Anthonius Jacobus Faber', 'Ernest Faber', '0000-00-00', 'ernest_faber.png', '4-2-3-1', 7),
(33, 'Fernando Manuel Fernandes da Costa Santos', 'Fernando Santos', '1954-10-10', 'fernando_santos.png', '4-4-2', 1),
(34, 'Luis Enrique Martínez García', 'Luis Enrique', '1970-05-08', 'luis_enrique.png', '4-3-3', 3),
(35, 'Gareth Southgate', 'Gareth Southgate', '1970-09-00', 'gareth_southgate.png', '4-4-3', 2),
(36, 'Roberto Mancini', 'Roberto Mancini', '1964-11-27', 'roberto_mancini.png', '4-3-3', 4),
(37, 'Joachim Löw', 'Joachim Löw', '1960-02-03', 'joachim_low.png', '4-2-3-1', 5),
(38, 'Didier Claude Deschamps', 'Didier Deschamps', '1968-10-15', 'didier_deschamps.png', '4-2-3-1', 6),
(39, 'Ronald Koeman', 'Ronald Koeman', '1963-03-21', 'ronald_koeman.png', '4-3-3', 7);

-- --------------------------------------------------------

--
-- Table structure for table `managers_competitions`
--

CREATE TABLE `managers_competitions` (
  `id` int(11) NOT NULL,
  `idmanager` int(11) NOT NULL,
  `idcompetition` int(11) NOT NULL,
  `league_title` varchar(30) NOT NULL,
  `individual_title` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `managers_competitions`
--

INSERT INTO `managers_competitions` (`id`, `idmanager`, `idcompetition`, `league_title`, `individual_title`) VALUES
(1, 1, 6, 'a decorrer', 'a decorrer'),
(2, 1, 10, 'vencedor', 'vencedor'),
(3, 1, 11, 'sem titulo', 'sem tiulo'),
(4, 1, 14, 'sem titulo', 'sem tiulo'),
(5, 1, 16, 'sem titulo', 'sem tiulo');

-- --------------------------------------------------------

--
-- Table structure for table `managers_games_clashes`
--

CREATE TABLE `managers_games_clashes` (
  `id` int(11) NOT NULL,
  `idgame_clashe` int(11) NOT NULL,
  `idcompetition` int(11) NOT NULL,
  `idteam_home` int(11) NOT NULL,
  `idteam_away` int(11) NOT NULL,
  `idmanager` int(11) NOT NULL,
  `type_game_clashe` varchar(10) NOT NULL,
  `punished` tinyint(4) NOT NULL,
  `expulsion` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `managers_games_clashes`
--

INSERT INTO `managers_games_clashes` (`id`, `idgame_clashe`, `idcompetition`, `idteam_home`, `idteam_away`, `idmanager`, `type_game_clashe`, `punished`, `expulsion`) VALUES
(1, 7, 6, 2, 1, 1, 'fora', 1, 1),
(2, 16, 6, 1, 6, 1, 'casa', 0, 0),
(3, 24, 6, 8, 1, 1, 'fora', 0, 0),
(4, 33, 6, 1, 4, 1, 'casa', 0, 0),
(5, 45, 6, 16, 1, 1, 'fora', 0, 0),
(6, 54, 6, 1, 10, 1, 'casa', 0, 0),
(7, 63, 6, 1, 15, 1, 'casa', 0, 0),
(8, 69, 6, 17, 1, 1, 'fora', 0, 0),
(9, 78, 6, 1, 3, 1, 'casa', 0, 0),
(10, 88, 6, 14, 1, 1, 'fora', 0, 0),
(11, 97, 6, 1, 9, 1, 'casa', 0, 0),
(12, 107, 6, 11, 1, 1, 'fora', 0, 0),
(13, 114, 6, 1, 18, 1, 'casa', 0, 0),
(14, 122, 6, 13, 1, 1, 'fora', 0, 0),
(15, 4, 6, 12, 3, 3, 'fora', 0, 0),
(16, 10, 6, 3, 7, 3, 'casa', 0, 0),
(17, 23, 6, 5, 3, 3, 'fora', 0, 0),
(18, 28, 6, 3, 2, 3, 'casa', 0, 0),
(19, 44, 6, 6, 3, 3, 'fora', 0, 0),
(20, 46, 6, 3, 8, 3, 'casa', 0, 0),
(21, 61, 6, 4, 3, 3, 'fora', 0, 0),
(22, 64, 6, 3, 16, 3, 'casa', 0, 0),
(23, 78, 6, 1, 3, 3, 'fora', 0, 0),
(24, 82, 6, 3, 15, 3, 'casa', 0, 0),
(25, 99, 6, 17, 3, 3, 'fora', 0, 0),
(26, 100, 6, 3, 10, 3, 'casa', 0, 0),
(27, 109, 6, 3, 14, 3, 'casa', 0, 0),
(28, 123, 6, 9, 3, 3, 'fora', 0, 0),
(29, 7, 6, 2, 1, 2, 'casa', 0, 0),
(30, 14, 6, 15, 2, 2, 'fora', 0, 0),
(31, 26, 6, 2, 17, 2, 'casa', 0, 0),
(32, 28, 6, 3, 2, 2, 'fora', 0, 0),
(33, 41, 6, 2, 14, 2, 'casa', 0, 0),
(34, 50, 6, 9, 2, 2, 'fora', 0, 0),
(35, 59, 6, 2, 11, 2, 'casa', 0, 0),
(36, 67, 6, 18, 2, 2, 'fora', 0, 0),
(37, 76, 6, 2, 13, 2, 'casa', 0, 0),
(38, 90, 6, 12, 2, 2, 'fora', 0, 0),
(39, 92, 6, 2, 7, 2, 'casa', 0, 0),
(40, 102, 6, 5, 2, 2, 'fora', 0, 0),
(41, 112, 6, 10, 2, 2, 'fora', 0, 0),
(42, 120, 6, 2, 6, 2, 'casa', 0, 0),
(42, 127, 6, 1, 3, 3, 'fora', 0, 1),
(43, 127, 6, 1, 3, 1, 'casa', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `managers_matchs_results`
--

CREATE TABLE `managers_matchs_results` (
  `id` int(11) NOT NULL,
  `idmatch_result` int(11) NOT NULL,
  `idgame_clashe` int(11) NOT NULL,
  `idcompetition` int(11) NOT NULL,
  `idteam_home` int(11) NOT NULL,
  `idteam_away` int(11) NOT NULL,
  `idmanager` int(11) NOT NULL,
  `type_match_result` varchar(10) NOT NULL,
  `yellow_card` int(11) NOT NULL,
  `red_card` int(11) NOT NULL,
  `minutes_yellow` varchar(50) NOT NULL,
  `minutes_red` varchar(50) NOT NULL,
  `rating_points` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `managers_matchs_results`
--

INSERT INTO `managers_matchs_results` (`id`, `idmatch_result`, `idgame_clashe`, `idcompetition`, `idteam_home`, `idteam_away`, `idmanager`, `type_match_result`, `yellow_card`, `red_card`, `minutes_yellow`, `minutes_red`, `rating_points`) VALUES
(1, 7, 7, 6, 2, 1, 1, 'fora', 1, 0, '68', '0', 1),
(2, 16, 16, 6, 1, 6, 1, 'casa', 0, 0, '0', '0', 3),
(3, 24, 24, 6, 8, 1, 1, 'fora', 0, 0, '0', '0', 3),
(4, 33, 33, 6, 1, 4, 1, 'casa', 0, 0, '0', '0', 3),
(5, 45, 45, 6, 16, 1, 1, 'fora', 0, 0, '0', '0', 3),
(6, 54, 54, 6, 1, 10, 1, 'casa', 0, 0, '0', '0', 3),
(7, 63, 63, 6, 1, 15, 1, 'casa', 0, 0, '0', '0', 3),
(8, 69, 69, 6, 17, 1, 1, 'fora', 0, 0, '0', '0', 3),
(9, 78, 78, 6, 1, 3, 1, 'casa', 0, 0, '0', '0', 3),
(10, 88, 88, 6, 14, 1, 1, 'fora', 0, 0, '0', '0', 3),
(11, 97, 97, 6, 1, 9, 1, 'casa', 0, 0, '0', '0', 3),
(12, 107, 107, 6, 11, 1, 1, 'fora', 0, 0, '0', '0', 3),
(13, 114, 114, 6, 1, 18, 1, 'casa', 0, 0, '0', '0', 3),
(14, 122, 122, 6, 13, 1, 1, 'fora', 0, 0, '0', '0', 3),
(15, 4, 4, 6, 12, 3, 3, 'fora', 0, 0, '0', '0', 3),
(16, 10, 10, 6, 3, 7, 3, 'casa', 0, 0, '0', '0', 0),
(17, 23, 23, 6, 5, 3, 3, 'fora', 0, 0, '0', '0', 3),
(18, 28, 28, 6, 3, 2, 3, 'casa', 0, 0, '0', '0', 0),
(19, 44, 44, 6, 6, 3, 3, 'fora', 0, 0, '0', '0', 3),
(20, 46, 46, 6, 3, 8, 3, 'casa', 0, 0, '0', '0', 3),
(21, 61, 61, 6, 4, 3, 3, 'fora', 0, 0, '0', '0', 3),
(22, 64, 64, 6, 3, 16, 3, 'casa', 0, 0, '0', '0', 3),
(23, 78, 78, 6, 1, 3, 3, 'fora', 0, 0, '0', '0', 0),
(24, 82, 82, 6, 3, 15, 3, 'casa', 0, 0, '0', '0', 3),
(25, 99, 99, 6, 17, 3, 3, 'fora', 0, 0, '0', '0', 3),
(26, 100, 100, 6, 3, 10, 3, 'casa', 0, 0, '0', '0', 3),
(27, 109, 109, 6, 3, 14, 3, 'casa', 0, 0, '0', '0', 3),
(28, 123, 123, 6, 9, 3, 3, 'fora', 0, 0, '0', '0', 3);

-- --------------------------------------------------------

--
-- Table structure for table `managers_transfers`
--

CREATE TABLE `managers_transfers` (
  `id` int(11) NOT NULL,
  `idmanager` int(11) NOT NULL,
  `idtransfer` int(11) NOT NULL,
  `idteam_out` int(11) NOT NULL,
  `idteam_entry` int(11) NOT NULL,
  `contract_date` date NOT NULL,
  `valor_actual` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `managers_transfers`
--

INSERT INTO `managers_transfers` (`id`, `idmanager`, `idtransfer`, `idteam_out`, `idteam_entry`, `contract_date`, `valor_actual`) VALUES
(1, 1, 39, 33, 1, '2020-06-01', 500),
(2, 1, 40, 34, 33, '2019-06-01', 1900),
(3, 1, 41, 35, 34, '2017-06-01', 100),
(4, 1, 42, 36, 35, '2016-06-01', 100),
(5, 1, 43, 54, 36, '2015-06-01', 100),
(6, 2, 44, 54, 2, '2020-06-01', 100),
(7, 3, 45, 54, 3, '2020-06-01', 100),
(8, 4, 46, 54, 4, '2020-06-01', 100),
(9, 5, 47, 54, 5, '2020-06-01', 100),
(10, 6, 48, 54, 6, '2020-06-01', 100),
(11, 7, 49, 54, 7, '2020-06-01', 100),
(12, 8, 50, 54, 8, '2020-06-01', 100),
(13, 9, 51, 54, 9, '2020-06-01', 100),
(14, 10, 52, 54, 10, '2020-06-01', 100),
(15, 11, 53, 54, 11, '2020-06-01', 100),
(16, 12, 54, 54, 12, '2020-06-01', 100),
(17, 13, 55, 54, 13, '2020-06-01', 100),
(18, 14, 56, 54, 14, '2020-06-01', 100),
(19, 15, 57, 54, 15, '2020-06-01', 100),
(20, 16, 58, 54, 16, '2020-06-01', 100),
(21, 17, 59, 54, 17, '2020-06-01', 100),
(22, 18, 60, 54, 18, '2020-06-01', 100);

-- --------------------------------------------------------

--
-- Table structure for table `matchs_results`
--

CREATE TABLE `matchs_results` (
  `id` int(11) NOT NULL,
  `idgame_clashe` int(11) NOT NULL,
  `idcompetition` int(11) NOT NULL,
  `idteam_home` int(11) NOT NULL,
  `formation_home` varchar(20) NOT NULL,
  `scores_home` int(11) NOT NULL,
  `idteam_away` int(11) NOT NULL,
  `formation_away` varchar(20) NOT NULL,
  `scores_away` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `matchs_results`
--

INSERT INTO `matchs_results` (`id`, `idgame_clashe`, `idcompetition`, `idteam_home`, `formation_home`, `scores_home`, `idteam_away`, `formation_away`, `scores_away`) VALUES
(1, 1, 6, 13, '4-4-2', 3, 14, '4-4-2', 1),
(2, 2, 6, 18, '4-4-3', 0, 9, '4-4-2', 3),
(3, 3, 6, 10, '4-4-2', 2, 11, '4-4-2', 1),
(4, 4, 6, 12, '4-4-3', 0, 3, '4-4-3', 3),
(5, 5, 6, 7, '4-4-2', 4, 17, '4-4-2', 2),
(6, 6, 6, 6, '4-4-3', 2, 16, '4-4-2', 0),
(7, 7, 6, 2, '4-4-2', 2, 1, '4-1-3-2', 2),
(8, 8, 6, 5, '4-4-3', 3, 15, '4-4-2', 1),
(9, 9, 6, 8, '4-4-2', 0, 4, '4-4-2', 2),
(10, 10, 6, 3, '4-4-3', 1, 7, '4-4-2', 0),
(11, 11, 6, 14, '4-4-2', 0, 12, '4-4-3', 0),
(12, 12, 6, 9, '4-4-3', 3, 13, '4-4-2', 0),
(13, 13, 6, 17, '4-4-2', 1, 5, '4-4-3', 2),
(14, 14, 6, 15, '4-4-3', 1, 2, '4-4-2', 4),
(15, 15, 6, 4, '4-4-2', 4, 10, '4-4-3', 0),
(16, 16, 6, 1, '4-1-3-2', 2, 6, '4-4-2', 1),
(17, 17, 6, 11, '4-4-3', 4, 18, '4-4-3', 1),
(18, 18, 6, 16, '4-4-2', 1, 8, '4-4-2', 2),
(19, 19, 6, 12, '4-4-3', 0, 9, '4-4-2', 1),
(20, 20, 6, 13, '4-4-2', 0, 11, '4-4-3', 2),
(21, 21, 6, 10, '4-4-3', 0, 18, '4-4-2', 0),
(22, 22, 6, 7, '4-4-2', 2, 14, '4-4-3', 1),
(23, 23, 6, 5, '4-4-3', 0, 3, '4-4-3', 2),
(24, 24, 6, 8, '4-4-2', 1, 1, '4-1-3-2', 3),
(25, 25, 6, 6, '4-4-2', 3, 15, '4-4-2', 1),
(26, 26, 6, 2, '4-4-3', 1, 17, '4-4-3', 0),
(27, 27, 6, 4, '4-4-2', 5, 16, '4-4-2', 0),
(28, 28, 6, 3, '4-4-3', 2, 2, '4-4-2', 3),
(29, 29, 6, 11, '4-4-2', 2, 12, '4-4-3', 1),
(30, 30, 6, 18, '4-4-3', 0, 13, '4-4-2', 4),
(31, 31, 6, 9, '4-4-2', 1, 7, '4-4-3', 1),
(32, 32, 6, 14, '4-4-3', 0, 5, '4-4-3', 1),
(33, 33, 6, 1, '4-1-3-2', 5, 4, '4-3-3', 2),
(34, 34, 6, 15, '4-4-2', 1, 8, '4-4-2', 1),
(35, 35, 6, 17, '4-4-3', 3, 6, '4-4-3', 4),
(36, 36, 6, 16, '4-4-2', 1, 10, '4-4-2', 1),
(37, 37, 6, 7, '4-4-3', 1, 11, '4-4-2', 0),
(38, 38, 6, 12, '4-4-2', 2, 18, '4-4-3', 1),
(39, 39, 6, 10, '4-4-3', 1, 13, '4-4-2', 0),
(40, 40, 6, 5, '4-4-2', 1, 9, '4-4-3', 3),
(41, 41, 6, 2, '4-4-3', 1, 14, '4-4-2', 0),
(42, 42, 6, 4, '4-4-2', 2, 15, '4-3-3', 1),
(43, 43, 6, 8, '4-4-3', 1, 17, '4-4-2', 1),
(44, 44, 6, 6, '4-4-2', 1, 3, '4-4-3', 2),
(45, 45, 6, 16, '4-4-3', 0, 1, '4-1-3-2', 7),
(46, 46, 6, 3, '4-4-3', 7, 8, '4-4-2', 0),
(47, 47, 6, 18, '4-4-2', 1, 7, '4-4-3', 3),
(48, 48, 6, 13, '4-4-3', 1, 12, '4-4-2', 1),
(49, 49, 6, 11, '4-4-2', 0, 5, '4-4-3', 4),
(50, 50, 6, 9, '4-4-3', 1, 2, '4-4-2', 3),
(51, 51, 6, 15, '4-4-2', 1, 16, '4-3-3', 1),
(52, 52, 6, 17, '4-4-3', 1, 4, '4-4-2', 1),
(53, 53, 6, 14, '4-4-2', 1, 6, '4-4-3', 1),
(54, 54, 6, 1, '4-1-3-2', 8, 10, '4-4-2', 1),
(55, 55, 6, 8, '4-4-3', 1, 14, '4-4-2', 0),
(56, 56, 6, 7, '4-4-2', 1, 13, '4-4-3', 1),
(57, 57, 6, 10, '4-4-3', 0, 12, '4-4-2', 1),
(58, 58, 6, 5, '4-4-2', 3, 18, '4-4-3', 0),
(59, 59, 6, 2, '4-4-3', 1, 11, '4-4-2', 0),
(60, 60, 6, 16, '4-4-2', 3, 17, '4-3-3', 2),
(61, 61, 6, 4, '4-4-3', 0, 3, '4-4-3', 2),
(62, 62, 6, 6, '4-4-2', 3, 9, '4-4-2', 1),
(63, 63, 6, 1, '4-1-3-2', 4, 15, '4-4-3', 0),
(64, 64, 6, 3, '4-4-3', 3, 16, '4-4-2', 0),
(65, 65, 6, 13, '4-4-2', 0, 5, '4-4-3', 0),
(66, 66, 6, 12, '4-4-3', 1, 7, '4-4-2', 0),
(67, 67, 6, 18, '4-4-2', 1, 2, '4-4-3', 5),
(68, 68, 6, 11, '4-4-3', 1, 6, '4-4-2', 0),
(69, 69, 6, 17, '4-4-2', 4, 1, '4-1-3-2', 5),
(70, 70, 6, 14, '4-4-3', 0, 4, '4-4-3', 2),
(71, 71, 6, 9, '4-4-2', 1, 8, '4-4-2', 3),
(72, 72, 6, 15, '4-3-3', 0, 10, '4-4-3', 4),
(73, 73, 6, 8, '4-4-3', 1, 11, '4-4-2', 0),
(74, 74, 6, 5, '4-4-2', 2, 12, '4-4-3', 0),
(75, 75, 6, 10, '4-4-3', 0, 7, '4-4-2', 0),
(76, 76, 6, 2, '4-4-2', 3, 13, '4-4-3', 0),
(77, 77, 6, 6, '4-4-3', 6, 18, '4-4-2', 0),
(78, 78, 6, 1, '4-1-3-2', 4, 3, '4-4-3', 2),
(79, 79, 6, 16, '4-4-3', 2, 14, '4-4-2', 3),
(80, 80, 6, 4, '4-4-2', 2, 9, '4-4-3', 0),
(81, 81, 6, 15, '4-3-3', 2, 17, '4-4-2', 1),
(82, 82, 6, 3, '4-4-3', 5, 15, '4-4-2', 0),
(83, 83, 6, 18, '4-4-2', 0, 8, '4-4-3', 7),
(84, 84, 6, 7, '4-4-3', 0, 5, '4-4-2', 3),
(85, 85, 6, 13, '4-4-2', 4, 6, '4-4-3', 2),
(86, 86, 6, 11, '4-4-3', 2, 4, '4-4-2', 2),
(87, 87, 6, 17, '4-4-2', 4, 10, '4-4-3', 2),
(88, 88, 6, 14, '4-4-3', 0, 1, '4-1-3-2', 4),
(89, 89, 6, 9, '4-4-2', 3, 16, '4-4-3', 0),
(90, 90, 6, 12, '4-3-3', 0, 2, '4-4-2', 6),
(91, 91, 6, 8, '4-4-3', 1, 13, '4-4-2', 0),
(92, 92, 6, 2, '4-4-2', 3, 7, '4-4-3', 1),
(93, 93, 6, 10, '4-4-3', 0, 5, '4-4-2', 0),
(94, 94, 6, 6, '4-4-2', 5, 12, '4-4-3', 1),
(95, 95, 6, 4, '4-4-3', 6, 18, '4-4-2', 2),
(96, 96, 6, 15, '4-4-2', 1, 14, '4-4-3', 1),
(97, 97, 6, 1, '4-1-3-2', 4, 9, '4-4-2', 0),
(98, 98, 6, 16, '4-4-2', 4, 11, '4-4-2', 0),
(99, 99, 6, 17, '4-3-3', 0, 3, '4-4-3', 3),
(100, 100, 6, 3, '4-4-3', 5, 10, '4-4-2', 1),
(101, 101, 6, 7, '4-4-2', 4, 6, '4-4-3', 3),
(102, 102, 6, 5, '4-4-3', 1, 2, '4-4-2', 0),
(103, 103, 6, 12, '4-4-2', 0, 8, '4-4-3', 1),
(104, 104, 6, 13, '4-4-3', 1, 4, '4-4-2', 2),
(105, 105, 6, 14, '4-4-2', 1, 17, '4-4-3', 0),
(106, 106, 6, 9, '4-3-3', 2, 15, '4-4-2', 0),
(107, 107, 6, 11, '4-4-2', 0, 1, '4-1-3-2', 2),
(108, 108, 6, 18, '4-3-3', 1, 16, '4-4-3', 2),
(109, 109, 6, 3, '4-4-3', 4, 14, '4-4-2', 0),
(110, 110, 6, 17, '4-4-2', 1, 9, '4-4-3', 3),
(111, 111, 6, 8, '4-4-3', 1, 7, '4-4-2', 0),
(112, 112, 6, 10, '4-4-2', 0, 2, '4-4-3', 0),
(113, 113, 6, 6, '4-4-3', 0, 5, '4-4-2', 4),
(114, 114, 6, 1, '4-1-3-2', 11, 18, '4-4-3', 0),
(115, 115, 6, 16, '4-3-3', 1, 13, '4-4-2', 2),
(116, 116, 6, 4, '4-4-2', 3, 12, '4-1-3-2', 2),
(117, 117, 6, 15, '4-3-3', 0, 11, '4-4-3', 1),
(118, 118, 6, 7, '4-4-3', 1, 4, '4-4-2', 1),
(119, 119, 6, 5, '4-4-2', 1, 8, '4-4-3', 0),
(120, 120, 6, 2, '4-4-3', 4, 6, '4-4-2', 1),
(121, 121, 6, 12, '4-4-2', 1, 16, '4-4-3', 3),
(122, 122, 6, 13, '4-4-3', 0, 1, '4-1-3-2', 2),
(123, 123, 6, 9, '4-4-2', 0, 3, '4-4-3', 3),
(124, 124, 6, 11, '4-3-3', 2, 17, '4-4-2', 3),
(125, 125, 6, 18, '4-4-2', 2, 15, '4-4-3', 2),
(126, 126, 6, 14, '4-3-3', 1, 10, '4-4-2', 1),
(127, 135, 6, 1, '4-1-3-2', 5, 3, '4-4-3', 0),
(128, 136, 6, 3, '4-4-3', 1, 1, '4-1-3-2', 3),
(129, 137, 6, 3, '4-4-3', 2, 1, '4-1-3-2', 6),
(130, 138, 6, 1, '4-1-3-2', 8, 3, '4-4-3', 4);

-- --------------------------------------------------------

--
-- Table structure for table `players`
--

CREATE TABLE `players` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `nickname` varchar(500) NOT NULL,
  `birth_date` date NOT NULL,
  `photo_player` varchar(50) NOT NULL,
  `weight` int(11) NOT NULL,
  `height` int(11) NOT NULL,
  `position` varchar(20) NOT NULL,
  `favorite_foot` varchar(10) NOT NULL,
  `idcountry` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `players`
--

INSERT INTO `players` (`id`, `name`, `nickname`, `birth_date`, `photo_player`, `weight`, `height`, `position`, `favorite_foot`, `idcountry`) VALUES
(1, 'Luís Belinha Reis', 'Luís Belinha', '1991-08-28', 'luis_belinha.png', 75, 175, 'Guarda-Redes', 'Direito', 1),
(2, 'Rui Pedro Neves Carvalho', 'Rui Pedro', '1981-02-21', 'rui_pedro.png', 76, 181, 'Guarda-Redes', 'Direito', 1),
(3, 'Ricardo André Silva Oliveira', 'Pringle', '1991-12-29', 'pringle.png', 73, 175, 'Guarda-Redes', 'Ambos', 1),
(4, 'João Pedro Almeida Santos', 'Jota', '1996-09-20', 'jota.png', 58, 163, 'Defesa', 'Direito', 1),
(5, 'José Carlos Fontes Almeida Neves Ferreira', 'Zé Carlos', '1983-05-11', 'ze_carlos.png', 63, 169, 'Defesa', 'Direito', 1),
(6, 'Marcelo Filipe Silvério Magalhães', 'Marcelo', '1995-05-18', 'marcelo.png', 70, 180, 'Defesa', 'Direito', 1),
(7, 'João Carlos Almeida Leandro', 'Joca', '1995-09-13', 'joca.png', 73, 185, 'Defesa', 'Direito', 1),
(8, 'David Sousa Rocha', 'David Rocha', '1985-07-21', 'david_rocha.png', 73, 170, 'Defesa', 'Esquerdo', 1),
(9, 'Edmilson Jesus Lopes Furtado', 'Gelson', '1996-09-01', 'gelson.png', 75, 175, 'Defesa', 'Esquerdo', 32),
(10, 'Renato Reis de Andrade', 'Rena', '1994-07-01', 'rena.png', 74, 174, 'Defesa', 'Direito', 1),
(11, 'Eduardo Xavier Alves Silva', 'Edu Silva', '1994-01-16', 'edu_silva.png', 82, 187, 'Médio', 'Esquerdo', 1),
(12, 'Pedro Jesus Soto Maior Silva Couto', 'Pedro Couto', '1993-10-27', 'pedro_couto.png', 64, 170, 'Médio', 'Esquerdo', 1),
(13, 'Miguel Tavares Silva', 'Manecas', '1989-07-19', 'manecas.png', 65, 170, 'Médio', 'Direito', 1),
(14, 'André Silva Mota', 'André Mota', '1998-04-03', 'andre_mota.png', 67, 176, 'Médio', 'Direito', 1),
(15, 'Fernando André Peixoto Vilar', 'Andrézinho', '1988-03-24', 'andrezinho.png', 72, 170, 'Médio', 'Ambos', 1),
(16, 'Diogo Miguel Sá Guerra', 'Guerra', '1996-08-18', 'guerra.png', 70, 176, 'Médio', 'Direito', 1),
(17, 'Nuno Miguel Costa Moreira', 'Nuno Fruta', '1984-09-15', 'nuno_fruta.png', 72, 170, 'Médio', 'Direito', 1),
(18, 'Ricardo Jorge Silva Gomes', 'Ricardo Gomes', '1995-03-03', 'ricardo_gomes.png', 79, 186, 'Médio', 'Esquerdo', 1),
(19, 'Ricardo Alves Dias', 'Ricardo Sá Dias', '1989-09-22', 'ricardo_sa_dias.png', 72, 170, 'Avançado', 'Ambos', 1),
(20, 'Nuno Miguel Capela de Sá', 'Nuno Capela', '1985-08-02', 'nuno_capela.png', 77, 181, 'Avançado', 'Ambos', 1),
(21, 'Leonardo Santa Rita Quirino', 'Leo Quirino', '1979-07-21', 'leo_quirino.png', 74, 175, 'Avançado', 'Esquerdo', 21),
(22, 'Quelvin Eveline Pinheiro Barbosa', 'Quelvin Barbosa', '1999-08-13', 'quelvin_barbosa.png', 75, 178, 'Avançado', 'Direito', 32),
(23, 'Pedro Miguel Rocha Ramalho', 'Ramalho', '1995-10-22', 'ramalho.png', 68, 168, 'Avançado', 'Ambos', 1),
(24, 'Paulo Jorge Costa Reis', 'Paulo Reis', '1997-01-13', 'paulo_reis.png', 73, 170, 'Avançado', 'Direito', 1),
(25, 'André Ribeiro Silva', 'André Silva', '2000-05-15', 'andre_silva.jpg', 175, 72, 'Avançado', 'Direito', 1),
(26, 'Tiago Miguel Soares Castro', 'Tiago Castro', '1997-05-02', 'tiago_castro.png', 72, 178, 'Guarda Redes', 'Direito', 1),
(27, 'Daniel Vieira', 'Daniel Vieira', '1992-05-11', 'daniel_vieira.jpg', 77, 181, 'Guarda Redes', 'Direito', 1),
(28, 'Christophe', 'Christophe', '1996-03-27', 'christophe.jpg', 74, 175, 'Defesa', 'Direito', 7),
(29, 'Ricardo Grilo', 'Ricardo Grilo', '1998-01-28', 'ricardo_grilo.jpg', 75, 178, 'Defesa', 'Direito', 1),
(30, 'Manuel Castro', 'Manuel Castro', '1995-07-17', 'manuel_castro.jpg', 68, 168, 'Defesa', 'Ambos', 1),
(31, 'Hugo Pinho', 'Hugo Pinho', '1984-04-00', 'hugo_pinho.jpg', 73, 170, 'Defesa', 'Direito', 1),
(32, 'Neves', 'Neves', '1995-03-17', 'neves.jpg', 175, 72, 'Defesa', 'Esquerdo', 1),
(33, 'Renato Silva', 'Renato Silva', '1998-04-06', 'no_player.png', 72, 178, 'Defesa', 'Esquerdo', 1),
(34, 'Pardal', 'Pardal', '1989-11-01', 'pardal.jpg', 77, 181, 'Médio', 'Direito', 1),
(35, 'Mota', 'Mota', '1997-05-18', 'mota.jpg', 74, 175, 'Médio', 'Direito', 1),
(36, 'Serginho', 'Serginho', '1992-06-11', 'serginho.jpg', 75, 178, 'Avançado', 'Direito', 1),
(37, 'António Ferreira', 'António Ferreira', '1998-04-17', 'antonio_ferreira.png', 68, 168, 'Avançado', 'Esquerdo', 1),
(38, 'Pedro Costa', 'Pedro Costa', '1986-07-13', 'pedro_costa.png', 73, 170, 'Avançado', 'Esquerdo', 1),
(39, 'João Paulo Ferreira Guimarães', 'Guima', '1997-08-18', 'guima.jpg', 72, 180, 'Guarda Redes', 'Direito', 1),
(40, 'André Mota', 'André Mota', '1997-01-23', 'andre_mota.jpg', 77, 181, 'Guarda Redes', 'Direito', 1),
(41, 'João Teixeira', 'João Teixeira', '1997-12-12', 'joao_teixeira.jpg', 74, 175, 'Defesa', 'Direito', 7),
(42, 'Rui Moreira', 'Rui Moreira', '1990-03-23', 'rui_moreira.jpg', 75, 178, 'Defesa', 'Esquerdo', 1),
(43, 'Joel Vieira', 'Joel Vieira', '1997-06-13', 'joel_vieira.jpg', 68, 168, 'Defesa', 'Ambos', 1),
(44, 'Filipe Pereira', 'Filipe Pereira', '1994-07-20', 'filipe_pereira.jpg', 73, 170, 'Defesa', 'Esquerdo', 1),
(45, 'Edgar Rios', 'Edgar Rios', '1997-07-14', 'edgar_rios.jpg', 175, 72, 'Defesa', 'Direito', 1),
(46, 'Xico', 'Xico', '1989-11-20', 'xico.jpg', 72, 178, 'Defesa', 'Direito', 1),
(47, 'Cruz', 'Cruz', '1994-11-23', 'cruz.jpg', 74, 175, 'Defesa', 'Direito', 1),
(48, 'Rafa', 'Rafa', '1994-07-30', 'rafa.jpg', 75, 178, 'Médio', 'Direito', 1),
(49, 'Vieira', 'Vieira', '1990-12-02', 'vieira.jpg', 68, 168, 'Médio', 'Direito', 1),
(50, 'Ricardo Pinto', 'Ricardo Pinto', '1994-05-30', 'ricardo_pinto.jpg', 73, 170, 'Médio', 'Esquerdo', 1),
(51, 'Batista', 'Batista', '1993-08-01', 'batista.jpg', 72, 180, 'Médio', 'Direito', 1),
(52, 'João Paulo', 'João Paulo', '1990-02-03', 'joao_paulo.jpg', 77, 181, 'Médio', 'Direito', 1),
(53, 'Machado', 'Machado', '1994-10-01', 'machado.jpg', 74, 175, 'Médio', 'Direito', 7),
(54, 'Perry', 'Perry', '1995-10-13', 'perry.jpg', 75, 178, 'Médio', 'Esquerdo', 1),
(55, 'Ninó', 'Ninó', '1986-08-13', 'nino.jpg', 68, 168, 'Médio', 'Ambos', 1),
(56, 'Bruno Barros', 'Bruno Barros', '1995-11-26', 'bruno_barros.jpg', 73, 170, 'Avançado', 'Esquerdo', 1),
(57, 'Nélson Diogo', 'Nélson Diogo', '1993-06-23', 'nelson_diogo.jpg', 175, 72, 'Avançado', 'Direito', 1),
(58, 'Adriano Rodrigues', 'Adriano Rodrigues', '1993-07-10', 'adriano_rodrigues.jpg', 72, 178, 'Avançado', 'Direito', 1),
(59, 'Xavito', 'Xavito', '1995-10-08', 'xavito.jpg', 77, 181, 'Avançado', 'Direito', 1),
(60, 'Wilson Santos', 'Wilson Santos', '1994-05-19', 'wilson_santos.jpg', 74, 175, 'Avançado', 'Direito', 1),
(61, 'João Batista', 'João Batista', '1997-08-17', 'joao_batista.jpg', 75, 178, 'Avançado', 'Direito', 1),
(62, 'Armando Santos', 'Armando Santos', '1997-01-09', 'armando_santos.jpg', 75, 178, 'Avançado', 'Direito', 1),
(63, 'António Alberto Bastos Pimparel', 'Beto', '1982-05-01', 'beto.png', 76, 180, 'Guarda-Redes', 'Direito', 1),
(64, 'José Pedro Malheiro de Sá', 'José Sá', '1981-02-21', 'jose_sa.png', 84, 192, 'Guarda-Redes', 'Direito', 1),
(65, 'Rui Pedro dos Santos Patrício', 'Rui Patrício', '1988-02-15', 'rui_patricio.png', 85, 190, 'Guarda-Redes', 'Esquerdo', 1),
(66, 'José Miguel da Rocha Fonte', 'José Fonte', '1983-12-22', 'jose_fonte.png', 81, 187, 'Defesa', 'Direito', 1),
(67, 'Domingos de Sousa Coutinho Menezes Duarte', 'Domingos Duarte', '1995-03-10', 'domingos_duarte.png', 80, 192, 'Defesa', 'Direito', 1),
(68, 'Ruben Semedo', 'Ruben Semedo', '1994-04-04', 'ruben_semedo.png', 70, 189, 'Defesa', 'Direito', 1),
(69, 'Mário Rui Silva Duarte', 'Mário Rui', '1991-05-27', 'mario_rui.png', 67, 170, 'Defesa', 'Esquerdo', 1),
(70, 'Rúben Santos Gato Alves Dias', 'Rúben Dias', '1997-05-14', 'ruben_dias.png', 83, 187, 'Defesa', 'Direito', 1),
(71, 'Raphaël Guerreiro', 'Raphaël Guerreiro', '1993-12-22', 'raphael_guerreiro.png', 70, 170, 'Defesa', 'Esquerdo', 1),
(72, 'Ricardo Domingos Barbosa Pereira', 'Ricardo Pereira', '1993-10-06', 'ricardo_pereira.png', 67, 175, 'Defesa', 'Direito', 1),
(73, 'João Pedro Cavaco Cancelo', 'João Cancelo', '1994-05-27', 'joao_cancelo.png', 74, 182, 'Defesa', 'Direito', 1),
(74, 'João Filipe Iria Santos Moutinho', 'João Moutinho', '1986-09-08', 'joao_moutinho.png', 63, 170, 'Médio', 'Direito', 1),
(75, 'Armindo Tué Na Bangna', 'Bruma', '1994-10-02', 'bruma.png', 63, 173, 'Médio', 'Direito', 1),
(78, 'Luís Miguel Afonso Fernandes', 'Pizzi', '1989-10-06', 'pizzi.png', 69, 176, 'Médio', 'Direito', 1),
(79, 'Danilo Luís Hélio Pereira', 'Danilo Pereira', '1991-09-09', 'danilo_pereira.png', 82, 188, 'Médio', 'Direito', 1),
(80, 'Rúben Diogo da Silva Neves', 'Rúben Neves', '1997-03-13', 'ruben_neves.png', 76, 180, 'Médio', 'Direito', 1),
(81, 'Bruno Miguel Borges Fernandes', 'Bruno Fernandes', '1994-09-08', 'bruno_fernandes.png', 69, 179, 'Médio', 'Direito', 1),
(82, 'Bernardo Mota Veiga de Carvalho e Silva', 'Bernardo Silva', '1994-08-10', 'bernardo_silva.png', 65, 173, 'Avançado', 'Esquerdo', 1),
(83, 'Gonçalo Mendes Paciência', 'Gonçalo Paciência', '1994-08-01', 'gonçalo_paciencia.png', 79, 184, 'Avançado', 'Direito', 1),
(84, 'André Miguel Valente da Silva', 'André Silva', '1995-11-06', 'andre_silvaa.png', 84, 184, 'Avançado', 'Direito', 1),
(85, 'Diogo José Teixeira da Silva', 'Diogo Jota', '1996-12-04', 'diogo_jota.png', 68, 178, 'Avançado', 'Direito', 1),
(86, 'Cristiano Ronaldo dos Santos Aveiro', 'Cristiano Ronaldo', '1985-02-05', 'cristiano_ronaldo.png', 83, 187, 'Avançado', 'Ambos', 1);

-- --------------------------------------------------------

--
-- Table structure for table `players_competitions`
--

CREATE TABLE `players_competitions` (
  `id` int(11) NOT NULL,
  `idplayer` int(11) NOT NULL,
  `idcompetition` int(11) NOT NULL,
  `league_title` varchar(30) NOT NULL,
  `individual_title` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `players_competitions`
--

INSERT INTO `players_competitions` (`id`, `idplayer`, `idcompetition`, `league_title`, `individual_title`) VALUES
(1, 1, 6, 'a decorrer', 'a decorrer'),
(2, 2, 6, 'a decorrer', 'a decorrer'),
(3, 3, 6, 'a decorrer', 'a decorrer'),
(4, 4, 6, 'a decorrer', 'a decorrer'),
(5, 5, 6, 'a decorrer', 'a decorrer'),
(6, 6, 6, 'a decorrer', 'a decorrer'),
(7, 7, 6, 'a decorrer', 'a decorrer'),
(8, 8, 6, 'a decorrer', 'a decorrer'),
(9, 9, 6, 'a decorrer', 'a decorrer'),
(10, 10, 6, 'a decorrer', 'a decorrer'),
(11, 11, 6, 'a decorrer', 'a decorrer'),
(12, 12, 6, 'a decorrer', 'a decorrer'),
(13, 13, 6, 'a decorrer', 'a decorrer'),
(14, 14, 6, 'a decorrer', 'a decorrer'),
(15, 15, 6, 'a decorrer', 'a decorrer'),
(16, 16, 6, 'a decorrer', 'a decorrer'),
(17, 17, 6, 'a decorrer', 'a decorrer'),
(18, 18, 6, 'a decorrer', 'a decorrer'),
(19, 19, 6, 'a decorrer', 'a decorrer'),
(20, 20, 6, 'a decorrer', 'a decorrer'),
(21, 21, 6, 'a decorrer', 'a decorrer'),
(22, 22, 6, 'a decorrer', 'a decorrer'),
(23, 23, 6, 'a decorrer', 'a decorrer'),
(24, 24, 6, 'a decorrer', 'a decorrer'),
(25, 25, 6, 'a decorrer', 'a decorrer'),
(26, 15, 17, 'sem titulo', 'sem titulo'),
(27, 15, 18, 'vencedor', 'vencedor'),
(28, 15, 19, 'sem titulo', 'sem titulo'),
(29, 15, 20, 'vencedor', 'vencedor'),
(30, 15, 21, 'vencedor', 'sem titulo'),
(31, 20, 22, 'sem titulo', 'sem titulo'),
(32, 20, 23, 'sem titulo', 'sem titulo'),
(33, 20, 24, 'sem titulo', 'sem titulo'),
(34, 20, 25, 'sem titulo', 'sem titulo'),
(35, 20, 26, 'sem titulo', 'sem titulo'),
(36, 20, 27, 'sem titulo', 'sem titulo'),
(37, 20, 28, 'sem titulo', 'sem titulo'),
(38, 20, 29, 'sem titulo', 'sem titulo'),
(39, 20, 30, 'sem titulo', 'sem titulo');

-- --------------------------------------------------------

--
-- Table structure for table `players_games_clashes`
--

CREATE TABLE `players_games_clashes` (
  `id` int(11) NOT NULL,
  `idgame_clashe` int(11) NOT NULL,
  `idcompetition` int(11) NOT NULL,
  `idteam_home` int(11) NOT NULL,
  `idteam_away` int(11) NOT NULL,
  `idplayer` int(11) NOT NULL,
  `type_game_clashe` varchar(10) NOT NULL,
  `initial_formation` tinyint(4) NOT NULL,
  `alternate_formation` tinyint(4) NOT NULL,
  `punished` tinyint(4) NOT NULL,
  `accumulation` tinyint(4) NOT NULL,
  `expulsion` tinyint(4) NOT NULL,
  `injured` tinyint(4) NOT NULL,
  `doubt` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `players_games_clashes`
--

INSERT INTO `players_games_clashes` (`id`, `idgame_clashe`, `idcompetition`, `idteam_home`, `idteam_away`, `idplayer`, `type_game_clashe`, `initial_formation`, `alternate_formation`, `punished`, `accumulation`, `expulsion`, `injured`, `doubt`) VALUES
(1, 7, 6, 2, 1, 2, 'fora', 1, 0, 0, 0, 0, 0, 0),
(2, 7, 6, 2, 1, 6, 'fora', 1, 0, 0, 0, 0, 0, 0),
(3, 7, 6, 2, 1, 8, 'fora', 1, 0, 0, 0, 0, 0, 0),
(4, 7, 6, 2, 1, 7, 'fora', 1, 0, 0, 0, 0, 0, 0),
(5, 7, 6, 2, 1, 5, 'fora', 1, 0, 0, 0, 0, 0, 0),
(6, 7, 6, 2, 1, 11, 'fora', 1, 0, 0, 0, 0, 0, 0),
(7, 7, 6, 2, 1, 16, 'fora', 1, 0, 0, 0, 0, 0, 0),
(8, 7, 6, 2, 1, 18, 'fora', 1, 0, 0, 0, 0, 0, 0),
(9, 7, 6, 2, 1, 15, 'fora', 1, 0, 0, 0, 0, 0, 0),
(10, 7, 6, 2, 1, 12, 'fora', 1, 0, 0, 0, 0, 0, 0),
(11, 7, 6, 2, 1, 13, 'fora', 1, 0, 0, 0, 0, 0, 0),
(12, 7, 6, 2, 1, 3, 'fora', 0, 1, 0, 0, 0, 0, 0),
(13, 7, 6, 2, 1, 10, 'fora', 0, 1, 0, 0, 0, 0, 0),
(14, 7, 6, 2, 1, 9, 'fora', 0, 1, 0, 0, 0, 0, 0),
(15, 7, 6, 2, 1, 17, 'fora', 0, 1, 0, 0, 0, 0, 0),
(16, 7, 6, 2, 1, 23, 'fora', 0, 1, 0, 0, 0, 0, 0),
(17, 7, 6, 2, 1, 20, 'fora', 0, 1, 0, 0, 0, 0, 0),
(18, 16, 6, 1, 6, 2, 'casa', 1, 0, 0, 0, 0, 0, 0),
(19, 16, 6, 1, 6, 6, 'casa', 1, 0, 0, 0, 0, 0, 0),
(20, 16, 6, 1, 6, 10, 'casa', 1, 0, 0, 0, 0, 0, 0),
(21, 16, 6, 1, 6, 5, 'casa', 1, 0, 0, 0, 0, 0, 0),
(22, 16, 6, 1, 6, 7, 'casa', 1, 0, 0, 0, 0, 0, 0),
(23, 16, 6, 1, 6, 5, 'casa', 1, 0, 0, 0, 0, 0, 0),
(23, 16, 6, 1, 6, 9, 'casa', 1, 0, 0, 0, 0, 0, 0),
(25, 16, 6, 1, 6, 11, 'casa', 1, 0, 0, 0, 0, 0, 0),
(26, 16, 6, 1, 6, 16, 'casa', 1, 0, 0, 0, 0, 0, 0),
(27, 16, 6, 1, 6, 12, 'casa', 1, 0, 0, 0, 0, 0, 0),
(28, 16, 6, 1, 6, 13, 'casa', 1, 0, 0, 0, 0, 0, 0),
(29, 16, 6, 1, 6, 3, 'casa', 0, 1, 0, 0, 0, 0, 0),
(30, 16, 6, 1, 6, 4, 'casa', 0, 1, 0, 0, 0, 0, 0),
(31, 16, 6, 1, 6, 14, 'casa', 0, 1, 0, 0, 0, 0, 0),
(32, 16, 6, 1, 6, 17, 'casa', 0, 1, 0, 0, 0, 0, 0),
(33, 16, 6, 1, 6, 18, 'casa', 0, 1, 0, 0, 0, 0, 0),
(34, 16, 6, 1, 6, 22, 'casa', 0, 1, 0, 0, 0, 0, 0),
(35, 16, 6, 1, 6, 20, 'casa', 0, 0, 0, 0, 1, 0, 0),
(36, 24, 6, 8, 1, 2, 'fora', 1, 0, 0, 0, 0, 0, 0),
(37, 24, 6, 8, 1, 6, 'fora', 1, 0, 0, 0, 0, 0, 0),
(38, 24, 6, 8, 1, 10, 'fora', 1, 0, 0, 0, 0, 0, 0),
(39, 24, 6, 8, 1, 8, 'fora', 1, 0, 0, 0, 0, 0, 0),
(40, 24, 6, 8, 1, 7, 'fora', 1, 0, 0, 0, 0, 0, 0),
(41, 24, 6, 8, 1, 5, 'fora', 1, 0, 0, 0, 0, 0, 0),
(42, 24, 6, 8, 1, 11, 'fora', 1, 0, 0, 0, 0, 0, 0),
(43, 24, 6, 8, 1, 16, 'fora', 1, 0, 0, 0, 0, 0, 0),
(44, 24, 6, 8, 1, 18, 'fora', 1, 0, 0, 0, 0, 0, 0),
(45, 24, 6, 8, 1, 15, 'fora', 1, 0, 0, 0, 0, 0, 0),
(46, 24, 6, 8, 1, 12, 'fora', 1, 0, 0, 0, 0, 0, 0),
(47, 24, 6, 8, 1, 3, 'fora', 0, 1, 0, 0, 0, 0, 0),
(48, 24, 6, 8, 1, 4, 'fora', 0, 1, 0, 0, 0, 0, 0),
(49, 24, 6, 8, 1, 9, 'fora', 0, 1, 0, 0, 0, 0, 0),
(50, 24, 6, 8, 1, 17, 'fora', 0, 1, 0, 0, 0, 0, 0),
(51, 24, 6, 8, 1, 23, 'fora', 0, 1, 0, 0, 0, 0, 0),
(52, 24, 6, 8, 1, 20, 'fora', 0, 0, 0, 0, 1, 0, 0),
(54, 24, 6, 8, 1, 24, 'fora', 0, 1, 0, 0, 0, 0, 0),
(55, 33, 6, 1, 4, 2, 'casa', 1, 0, 0, 0, 0, 0, 0),
(56, 33, 6, 1, 4, 6, 'casa', 1, 0, 0, 0, 0, 0, 0),
(57, 33, 6, 1, 4, 10, 'casa', 1, 0, 0, 0, 0, 0, 0),
(58, 33, 6, 1, 4, 8, 'casa', 1, 0, 0, 0, 0, 0, 0),
(59, 33, 6, 1, 4, 7, 'casa', 1, 0, 0, 0, 0, 0, 0),
(60, 33, 6, 1, 4, 9, 'casa', 1, 0, 0, 0, 0, 0, 0),
(61, 33, 6, 1, 4, 11, 'casa', 1, 0, 0, 0, 0, 0, 0),
(62, 33, 6, 1, 4, 16, 'casa', 1, 0, 0, 0, 0, 0, 0),
(63, 33, 6, 1, 4, 18, 'casa', 1, 0, 0, 0, 0, 0, 0),
(64, 33, 6, 1, 4, 15, 'casa', 1, 0, 0, 0, 0, 0, 0),
(65, 33, 6, 1, 4, 12, 'casa', 1, 0, 0, 0, 0, 0, 0),
(66, 33, 6, 1, 4, 3, 'casa', 0, 1, 0, 0, 0, 0, 0),
(67, 33, 6, 1, 4, 4, 'casa', 0, 1, 0, 0, 0, 0, 0),
(68, 33, 6, 1, 4, 17, 'casa', 0, 1, 0, 0, 0, 0, 0),
(69, 33, 6, 1, 4, 23, 'casa', 0, 1, 0, 0, 0, 0, 0),
(70, 33, 6, 1, 4, 20, 'casa', 0, 1, 0, 0, 0, 0, 0),
(71, 33, 6, 1, 4, 25, 'casa', 0, 1, 0, 0, 0, 0, 0),
(72, 33, 6, 1, 4, 22, 'casa', 0, 1, 0, 0, 0, 0, 0),
(73, 33, 6, 1, 4, 22, 'casa', 0, 0, 0, 0, 1, 0, 0),
(74, 45, 6, 16, 1, 2, 'fora', 1, 0, 0, 0, 0, 0, 0),
(75, 45, 6, 16, 1, 6, 'fora', 1, 0, 0, 0, 0, 0, 0),
(76, 45, 6, 16, 1, 10, 'fora', 1, 0, 0, 0, 0, 0, 0),
(77, 45, 6, 16, 1, 8, 'fora', 1, 0, 0, 0, 0, 0, 0),
(78, 45, 6, 16, 1, 7, 'fora', 1, 0, 0, 0, 0, 0, 0),
(79, 45, 6, 16, 1, 9, 'fora', 1, 0, 0, 0, 0, 0, 0),
(80, 45, 6, 16, 1, 11, 'fora', 1, 0, 0, 0, 0, 0, 0),
(81, 45, 6, 16, 1, 16, 'fora', 1, 0, 0, 0, 0, 0, 0),
(82, 45, 6, 16, 1, 18, 'fora', 1, 0, 0, 0, 0, 0, 0),
(83, 45, 6, 16, 1, 15, 'fora', 1, 0, 0, 0, 0, 0, 0),
(84, 45, 6, 16, 1, 12, 'fora', 1, 0, 0, 0, 0, 0, 0),
(85, 45, 6, 16, 1, 1, 'fora', 0, 1, 0, 0, 0, 0, 0),
(86, 45, 6, 16, 1, 4, 'fora', 0, 1, 0, 0, 0, 0, 0),
(87, 45, 6, 16, 1, 17, 'fora', 0, 1, 0, 0, 0, 0, 0),
(88, 45, 6, 16, 1, 24, 'fora', 0, 1, 0, 0, 0, 0, 0),
(89, 45, 6, 16, 1, 20, 'fora', 0, 1, 0, 0, 0, 0, 0),
(90, 45, 6, 16, 1, 25, 'fora', 0, 1, 0, 0, 0, 0, 0),
(91, 45, 6, 16, 1, 22, 'fora', 0, 1, 0, 0, 0, 0, 0),
(92, 45, 6, 16, 1, 5, 'fora', 0, 0, 0, 0, 1, 0, 0),
(93, 54, 6, 1, 10, 2, 'casa', 1, 0, 0, 0, 0, 0, 0),
(94, 54, 6, 1, 10, 6, 'casa', 1, 0, 0, 0, 0, 0, 0),
(95, 54, 6, 1, 10, 10, 'casa', 1, 0, 0, 0, 0, 0, 0),
(96, 54, 6, 1, 10, 8, 'casa', 1, 0, 0, 0, 0, 0, 0),
(97, 54, 6, 1, 10, 7, 'casa', 1, 0, 0, 0, 0, 0, 0),
(98, 54, 6, 1, 10, 9, 'casa', 1, 0, 0, 0, 0, 0, 0),
(99, 54, 6, 1, 10, 11, 'casa', 1, 0, 0, 0, 0, 0, 0),
(100, 54, 6, 1, 10, 16, 'casa', 1, 0, 0, 0, 0, 0, 0),
(101, 54, 6, 1, 10, 18, 'casa', 1, 0, 0, 0, 0, 0, 0),
(102, 54, 6, 1, 10, 15, 'casa', 1, 0, 0, 0, 0, 0, 0),
(103, 54, 6, 1, 10, 12, 'casa', 1, 0, 0, 0, 0, 0, 0),
(104, 54, 6, 1, 10, 1, 'casa', 0, 1, 0, 0, 0, 0, 0),
(105, 54, 6, 1, 10, 5, 'casa', 0, 1, 0, 0, 0, 0, 0),
(106, 54, 6, 1, 10, 17, 'casa', 0, 1, 0, 0, 0, 0, 0),
(107, 54, 6, 1, 10, 20, 'casa', 0, 1, 0, 0, 0, 0, 0),
(108, 54, 6, 1, 10, 25, 'casa', 0, 1, 0, 0, 0, 0, 0),
(109, 54, 6, 1, 10, 22, 'casa', 0, 1, 0, 0, 0, 0, 0),
(110, 7, 6, 2, 1, 26, 'casa', 1, 0, 0, 0, 0, 0, 0),
(111, 7, 6, 2, 1, 27, 'casa', 1, 0, 0, 0, 0, 0, 0),
(112, 7, 6, 2, 1, 28, 'casa', 1, 0, 0, 0, 0, 0, 0),
(114, 7, 6, 2, 1, 30, 'casa', 1, 0, 0, 0, 0, 0, 0),
(115, 7, 6, 2, 1, 33, 'casa', 1, 0, 0, 0, 0, 0, 0),
(116, 7, 6, 2, 1, 34, 'casa', 1, 0, 0, 0, 0, 0, 0),
(117, 7, 6, 2, 1, 35, 'casa', 1, 0, 0, 0, 0, 0, 0),
(118, 7, 6, 2, 1, 36, 'casa', 1, 0, 0, 0, 0, 0, 0),
(119, 7, 6, 2, 1, 37, 'casa', 1, 0, 0, 0, 0, 0, 0),
(120, 7, 6, 2, 1, 38, 'casa', 1, 0, 0, 0, 0, 0, 0),
(121, 7, 6, 2, 1, 31, 'casa', 0, 1, 0, 0, 0, 0, 0),
(122, 7, 6, 2, 1, 32, 'casa', 0, 1, 0, 0, 0, 0, 0),
(123, 7, 6, 2, 1, 29, 'casa', 1, 0, 0, 0, 0, 0, 0),
(123, 127, 6, 1, 3, 2, 'casa', 1, 0, 0, 0, 0, 0, 0),
(124, 127, 6, 1, 3, 6, 'casa', 1, 0, 0, 0, 0, 0, 0),
(125, 127, 6, 1, 3, 8, 'casa', 1, 0, 0, 0, 0, 0, 0),
(126, 127, 6, 1, 3, 7, 'casa', 1, 0, 0, 0, 0, 0, 0),
(127, 127, 6, 1, 3, 5, 'casa', 1, 0, 0, 0, 0, 0, 0),
(128, 127, 6, 1, 3, 11, 'casa', 1, 0, 0, 0, 0, 0, 0),
(129, 127, 6, 1, 3, 16, 'casa', 1, 0, 0, 0, 0, 0, 0),
(130, 127, 6, 1, 3, 18, 'casa', 1, 0, 0, 0, 0, 0, 0),
(131, 127, 6, 1, 3, 15, 'casa', 1, 0, 0, 0, 0, 0, 0),
(132, 127, 6, 1, 3, 12, 'casa', 1, 0, 0, 0, 0, 0, 0),
(133, 127, 6, 1, 3, 13, 'casa', 1, 0, 0, 0, 0, 0, 0),
(134, 127, 6, 1, 3, 3, 'casa', 0, 1, 0, 0, 0, 0, 0),
(135, 127, 6, 1, 3, 10, 'casa', 0, 1, 0, 0, 0, 0, 0),
(136, 127, 6, 1, 3, 9, 'casa', 0, 1, 0, 0, 0, 0, 0),
(137, 127, 6, 1, 3, 17, 'casa', 0, 1, 0, 0, 0, 0, 0),
(138, 127, 6, 1, 3, 23, 'casa', 0, 1, 0, 0, 0, 0, 0),
(139, 127, 6, 1, 3, 20, 'casa', 0, 1, 0, 0, 0, 0, 0),
(140, 127, 6, 1, 3, 25, 'casa', 0, 0, 1, 0, 0, 0, 0),
(141, 127, 6, 1, 3, 24, 'casa', 0, 0, 0, 1, 0, 0, 0),
(143, 127, 6, 1, 3, 39, 'fora', 1, 0, 0, 0, 0, 0, 0),
(144, 127, 6, 1, 3, 41, 'fora', 1, 0, 0, 0, 0, 0, 0),
(145, 127, 6, 1, 3, 42, 'fora', 1, 0, 0, 0, 0, 0, 0),
(146, 127, 6, 1, 3, 43, 'fora', 1, 0, 0, 0, 0, 0, 0),
(147, 127, 6, 1, 3, 44, 'fora', 1, 0, 0, 0, 0, 0, 0),
(148, 127, 6, 1, 3, 48, 'fora', 1, 0, 0, 0, 0, 0, 0),
(149, 127, 6, 1, 3, 49, 'fora', 1, 0, 0, 0, 0, 0, 0),
(150, 127, 6, 1, 3, 50, 'fora', 1, 0, 0, 0, 0, 0, 0),
(151, 127, 6, 1, 3, 56, 'fora', 1, 0, 0, 0, 0, 0, 0),
(152, 127, 6, 1, 3, 57, 'fora', 1, 0, 0, 0, 0, 0, 0),
(153, 127, 6, 1, 3, 60, 'fora', 1, 0, 0, 0, 0, 0, 0),
(154, 127, 6, 1, 3, 45, 'fora', 0, 1, 0, 0, 0, 0, 0),
(155, 127, 6, 1, 3, 46, 'fora', 0, 1, 0, 0, 0, 0, 0),
(156, 127, 6, 1, 3, 51, 'fora', 0, 1, 0, 0, 0, 0, 0),
(157, 127, 6, 1, 3, 52, 'fora', 0, 1, 0, 0, 0, 0, 0),
(158, 127, 6, 1, 3, 53, 'fora', 0, 1, 0, 0, 0, 0, 0),
(158, 127, 6, 1, 3, 59, 'fora', 0, 0, 0, 0, 1, 0, 0),
(159, 127, 6, 1, 3, 53, 'fora', 0, 0, 0, 0, 0, 1, 0),
(159, 127, 6, 1, 3, 62, 'fora', 0, 1, 0, 0, 0, 0, 0),
(161, 127, 6, 1, 3, 40, 'fora', 0, 0, 0, 0, 0, 0, 1),
(163, 127, 6, 1, 3, 21, 'casa', 0, 0, 0, 0, 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `players_matchs_results`
--

CREATE TABLE `players_matchs_results` (
  `id` int(11) NOT NULL,
  `idmatch_result` int(11) NOT NULL,
  `idgame_clashe` int(11) NOT NULL,
  `idcompetition` int(11) NOT NULL,
  `idteam_home` int(11) NOT NULL,
  `idteam_away` int(11) NOT NULL,
  `idplayer` int(11) NOT NULL,
  `type_match_result` varchar(10) NOT NULL,
  `position` varchar(5) NOT NULL,
  `number_shirt` int(11) NOT NULL,
  `initial_eleven` tinyint(4) NOT NULL,
  `goals_conceded` int(11) NOT NULL,
  `goals_scored` int(11) NOT NULL,
  `assist` int(11) NOT NULL,
  `yellow_card` int(11) NOT NULL,
  `red_card` int(11) NOT NULL,
  `minutes_goals` varchar(50) NOT NULL,
  `minutes_assist` varchar(50) NOT NULL,
  `minutes_yellow` varchar(50) NOT NULL,
  `minutes_red` varchar(50) NOT NULL,
  `subs_entry` varchar(50) NOT NULL,
  `subs_out` varchar(50) NOT NULL,
  `rating_perfomance` float NOT NULL,
  `player_of_match` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `players_matchs_results`
--

INSERT INTO `players_matchs_results` (`id`, `idmatch_result`, `idgame_clashe`, `idcompetition`, `idteam_home`, `idteam_away`, `idplayer`, `type_match_result`, `position`, `number_shirt`, `initial_eleven`, `goals_conceded`, `goals_scored`, `assist`, `yellow_card`, `red_card`, `minutes_goals`, `minutes_assist`, `minutes_yellow`, `minutes_red`, `subs_entry`, `subs_out`, `rating_perfomance`, `player_of_match`) VALUES
(1, 7, 7, 6, 2, 1, 2, 'fora', 'GK', 44, 1, 1, 0, 0, 1, 0, '0', '0', '67', '0', '0', '0', 6.3, 0),
(2, 7, 7, 6, 2, 1, 6, 'fora', 'DD', 20, 1, 0, 0, 0, 0, 0, '0', '0', '0', '0', '0', '71', 7.3, 0),
(3, 7, 7, 6, 2, 1, 8, 'fora', 'DE', 6, 1, 0, 0, 0, 0, 0, '0', '0', '0', '0', '0', '0', 7.3, 0),
(4, 7, 7, 6, 2, 1, 7, 'fora', 'DCE', 32, 1, 0, 1, 0, 0, 0, '90+2', '0', '0', '0', '0', '0', 7.3, 0),
(5, 7, 7, 6, 2, 1, 5, 'fora', 'DCD', 13, 1, 0, 0, 0, 1, 0, '0', '0', '79', '0', '0', '0', 7.3, 0),
(6, 7, 7, 6, 2, 1, 11, 'fora', 'MCE', 4, 1, 0, 0, 0, 0, 0, '0', '0', '0', '0', '0', '0', 7.3, 0),
(7, 7, 7, 6, 2, 1, 16, 'fora', 'FWR', 18, 1, 0, 0, 0, 0, 0, '0', '0', '0', '0', '0', '0', 7.3, 0),
(8, 7, 7, 6, 2, 1, 18, 'fora', 'MCD', 39, 1, 0, 0, 0, 0, 0, '0', '0', '0', '0', '0', '45', 5.3, 0),
(9, 7, 7, 6, 2, 1, 15, 'fora', 'MC', 5, 1, 0, 0, 2, 1, 0, '0', '56 92+2', '88', '0', '0', '0', 8.3, 1),
(10, 7, 7, 6, 2, 1, 12, 'fora', 'MDC', 8, 1, 0, 1, 0, 0, 0, '56', '0', '0', '0', '0', '80', 7.3, 0),
(11, 7, 7, 6, 2, 1, 13, 'fora', 'FWE', 25, 1, 0, 0, 0, 1, 0, '0', '0', '45', '0', '60', '65', 7.3, 0),
(12, 7, 7, 6, 2, 1, 3, 'fora', 'GK', 12, 0, 0, 0, 0, 0, 0, '0', '0', '0', '0', '0', '0', 0, 0),
(13, 7, 7, 6, 2, 1, 10, 'fora', 'DC', 28, 0, 0, 0, 0, 0, 0, '0', '0', '0', '0', '60', '0', 6.5, 0),
(14, 7, 7, 6, 2, 1, 9, 'fora', 'DE', 19, 0, 0, 0, 0, 0, 0, '0', '0', '0', '0', '45', '0', 6.5, 0),
(15, 7, 7, 6, 2, 1, 17, 'fora', 'MC', 29, 0, 0, 0, 0, 0, 0, '0', '0', '0', '0', '0', '0', 0, 0),
(16, 7, 7, 6, 2, 1, 23, 'fora', 'FW', 9, 0, 0, 0, 0, 0, 0, '0', '0', '0', '0', '80', '0', 6.3, 0),
(17, 7, 7, 6, 2, 1, 20, 'fora', 'FW', 10, 0, 0, 0, 0, 1, 1, '0', '0', '90+7', '90+7', '71', '0', 5.3, 0),
(18, 16, 16, 6, 1, 6, 2, 'casa', 'GK', 44, 1, 1, 0, 0, 0, 0, '0', '0', '0', '0', '0', '0', 6.3, 0),
(19, 16, 16, 6, 1, 6, 6, 'casa', 'DD', 20, 1, 0, 0, 0, 0, 0, '0', '0', '0', '0', '0', '0', 7.3, 0),
(20, 16, 16, 6, 1, 6, 10, 'casa', 'MCD', 28, 1, 0, 0, 0, 0, 0, '0', '0', '0', '0', '0', '0', 7.3, 0),
(21, 16, 16, 6, 1, 6, 8, 'casa', 'DE', 6, 1, 0, 0, 0, 0, 0, '0', '0', '0', '0', '0', '45', 7.3, 0),
(22, 16, 16, 6, 1, 6, 7, 'casa', 'DC', 32, 1, 0, 0, 0, 0, 0, '0', '0', '0', '0', '0', '0', 7.3, 0),
(23, 16, 16, 6, 1, 6, 5, 'casa', 'DC', 13, 1, 0, 0, 0, 0, 0, '0', '0', '0', '0', '0', '71', 7.3, 0),
(24, 16, 16, 6, 1, 6, 9, 'casa', 'MCE', 19, 1, 0, 0, 0, 0, 0, '0', '0', '0', '0', '0', '63', 7.3, 0),
(25, 16, 16, 6, 1, 6, 11, 'casa', 'MCD', 4, 1, 0, 1, 1, 0, 0, '63', '74', '0', '0', '0', '0', 8.3, 0),
(26, 16, 16, 6, 1, 6, 16, 'casa', 'FW', 18, 1, 0, 1, 1, 0, 0, '74', '63', '0', '0', '0', '0', 8.3, 1),
(27, 16, 16, 6, 1, 6, 12, 'casa', 'MDC', 8, 1, 0, 1, 0, 0, 0, '56', '0', '0', '0', '0', '0', 7.3, 0),
(28, 16, 16, 6, 1, 6, 13, 'casa', 'FW', 25, 1, 0, 0, 0, 0, 0, '0', '0', '0', '0', '0', '0', 7.3, 0),
(29, 16, 16, 6, 1, 6, 3, 'casa', 'GK', 12, 0, 0, 0, 0, 0, 0, '0', '0', '0', '0', '0', '0', 0, 0),
(30, 16, 16, 6, 1, 6, 7, 'casa', 'DD', 2, 0, 0, 0, 0, 0, 0, '0', '0', '0', '0', '0', '0', 0, 0),
(31, 16, 16, 6, 1, 6, 14, 'casa', 'FW', 30, 0, 0, 0, 0, 0, 0, '0', '0', '0', '0', '0', '0', 0, 0),
(32, 16, 16, 6, 1, 6, 17, 'casa', 'MCD', 29, 0, 0, 0, 0, 0, 0, '0', '0', '0', '0', '71', '0', 6, 0),
(33, 16, 16, 6, 1, 6, 18, 'casa', 'MC', 39, 0, 0, 0, 0, 0, 0, '0', '0', '0', '0', '45', '0', 6.3, 0),
(34, 16, 16, 6, 1, 6, 22, 'casa', 'FW', 99, 0, 0, 0, 0, 0, 0, '0', '0', '0', '0', '63', '0', 5.3, 0),
(35, 24, 24, 6, 8, 1, 2, 'fora', 'GK', 44, 1, 1, 0, 0, 0, 0, '0', '0', '0', '0', '0', '0', 7.3, 0),
(36, 24, 24, 6, 8, 1, 6, 'fora', 'DD', 20, 1, 0, 0, 0, 0, 0, '0', '0', '0', '0', '0', '0', 7.3, 0),
(37, 24, 24, 6, 8, 1, 10, 'fora', 'MCD', 28, 1, 0, 0, 0, 0, 0, '0', '0', '0', '0', '0', '0', 7.3, 0),
(38, 24, 24, 6, 8, 1, 8, 'fora', 'DE', 6, 1, 0, 0, 0, 0, 0, '0', '0', '0', '0', '0', '0', 7.3, 0),
(39, 24, 24, 6, 8, 1, 5, 'fora', 'DC', 13, 1, 0, 0, 0, 1, 1, '0', '0', '36', '36', '0', '0', 3.3, 0),
(40, 24, 24, 6, 8, 1, 7, 'fora', 'DC', 32, 1, 0, 0, 0, 0, 0, '0', '0', '0', '0', '0', '0', 7.3, 0),
(41, 24, 24, 6, 8, 1, 11, 'fora', 'MCE', 4, 1, 0, 0, 0, 0, 0, '0', '0', '0', '0', '0', '0', 7.3, 0),
(42, 24, 24, 6, 8, 1, 16, 'fora', 'FW', 18, 1, 0, 0, 0, 0, 0, '0', '0', '0', '0', '0', '45', 7.3, 0),
(43, 24, 24, 6, 8, 1, 18, 'fora', 'FW', 39, 1, 0, 1, 0, 1, 0, '69', '0', '45', '0', '0', '72', 8.3, 0),
(44, 24, 24, 6, 8, 1, 15, 'fora', 'MC', 5, 1, 0, 1, 3, 1, 0, '64', '64 69 75', '30', '0', '0', '89', 9.3, 1),
(45, 24, 24, 6, 8, 1, 12, 'fora', 'MDC', 8, 1, 0, 0, 0, 0, 0, '0', '0', '0', '0', '0', '86', 7.3, 0),
(46, 24, 24, 6, 8, 1, 3, 'fora', 'GK', 12, 0, 0, 0, 0, 0, 0, '0', '0', '0', '0', '0', '0', 0, 0),
(47, 24, 24, 6, 8, 1, 7, 'fora', 'DC', 2, 0, 0, 0, 0, 0, 0, '0', '0', '0', '0', '86', '0', 6.5, 0),
(48, 24, 24, 6, 8, 1, 9, 'fora', 'DE', 19, 0, 0, 1, 0, 1, 0, '75', '0', '82', '0', '45', '0', 6.5, 0),
(49, 24, 24, 6, 8, 1, 17, 'fora', 'MC', 29, 0, 0, 0, 0, 0, 0, '0', '0', '0', '0', '72', '0', 6.2, 0),
(50, 24, 24, 6, 8, 1, 23, 'fora', 'FW', 9, 0, 0, 0, 0, 0, 0, '0', '0', '0', '0', '0', '0', 0, 0),
(51, 24, 24, 6, 8, 1, 24, 'fora', 'FW', 17, 0, 0, 0, 0, 0, 0, '0', '0', '0', '0', '0', '0', 0, 0),
(52, 33, 33, 6, 1, 4, 2, 'casa', 'GK', 44, 1, 2, 0, 0, 0, 0, '0', '0', '0', '0', '0', '0', 7.3, 0),
(53, 33, 33, 6, 1, 4, 6, 'casa', 'DD', 20, 1, 0, 0, 0, 0, 0, '0', '0', '0', '0', '0', '0', 7.3, 0),
(54, 33, 33, 6, 1, 4, 10, 'casa', 'DC', 28, 1, 0, 0, 0, 0, 0, '0', '0', '0', '0', '0', '0', 7.3, 0),
(55, 33, 33, 6, 1, 4, 8, 'casa', 'DE', 6, 1, 0, 0, 0, 0, 0, '0', '0', '0', '0', '0', '0', 7.3, 0),
(56, 33, 33, 6, 1, 4, 7, 'casa', 'DC', 32, 1, 0, 0, 0, 0, 0, '0', '0', '0', '0', '0', '0', 7.3, 0),
(57, 33, 33, 6, 1, 4, 9, 'casa', 'MCE', 19, 1, 0, 0, 0, 0, 0, '0', '0', '0', '0', '0', '80', 7.3, 0),
(58, 33, 33, 6, 1, 4, 11, 'casa', 'MCD', 4, 1, 0, 1, 0, 0, 0, '65 (p.b)87', '0', '0', '0', '0', '0', 8.3, 0),
(59, 33, 33, 6, 1, 4, 16, 'casa', 'FW', 18, 1, 0, 2, 1, 0, 0, '21 47', '65', '0', '0', '0', '71', 8.3, 0),
(60, 33, 33, 6, 1, 4, 18, 'casa', 'FW', 39, 1, 0, 0, 0, 0, 0, '0', '0', '0', '0', '0', '68', 8.3, 0),
(61, 33, 33, 6, 1, 4, 15, 'casa', 'MC', 5, 1, 0, 1, 3, 0, 0, '89', '21 47 91+1', '0', '0', '0', '0', 9.3, 1),
(62, 33, 33, 6, 1, 4, 12, 'casa', 'MDC', 8, 1, 0, 0, 0, 0, 0, '0', '0', '0', '0', '0', '80', 7.3, 0),
(63, 33, 33, 6, 1, 4, 3, 'casa', 'GK', 12, 0, 0, 0, 0, 0, 0, '0', '0', '0', '0', '0', '0', 0, 0),
(64, 33, 33, 6, 1, 4, 7, 'casa', 'DD', 2, 0, 0, 0, 0, 0, 0, '0', '0', '0', '0', '0', '0', 0, 0),
(65, 33, 33, 6, 1, 4, 25, 'casa', 'FW', 26, 0, 0, 0, 0, 0, 0, '0', '0', '0', '0', '80', '0', 7, 0),
(66, 33, 33, 6, 1, 4, 17, 'casa', 'MC', 29, 0, 0, 0, 0, 0, 0, '0', '0', '0', '0', '71', '0', 6, 0),
(67, 33, 33, 6, 1, 4, 20, 'casa', 'FW', 10, 0, 0, 1, 0, 0, 0, '90+1', '0', '0', '0', '71', '0', 8.3, 0),
(68, 33, 33, 6, 1, 4, 22, 'casa', 'FW', 99, 0, 0, 0, 0, 0, 0, '0', '0', '0', '0', '80', '0', 7.3, 0),
(69, 7, 7, 6, 2, 1, 26, 'casa', 'GK', 44, 1, 2, 0, 0, 0, 0, '0', '0', '0', '0', '0', '0', 7.3, 0),
(70, 7, 7, 6, 2, 1, 27, 'casa', 'DD', 20, 1, 0, 0, 0, 0, 0, '0', '0', '0', '0', '0', '0', 7.3, 0),
(71, 7, 7, 6, 2, 1, 28, 'casa', 'DE', 28, 1, 0, 0, 0, 0, 0, '0', '0', '0', '0', '0', '0', 7.3, 0),
(72, 7, 7, 6, 2, 1, 29, 'casa', 'DC', 6, 1, 0, 0, 0, 0, 0, '0', '0', '0', '0', '0', '0', 7.3, 0),
(73, 7, 7, 6, 2, 1, 30, 'casa', 'DC', 13, 1, 0, 0, 0, 0, 0, '0', '0', '0', '0', '0', '0', 7.3, 0),
(74, 7, 7, 6, 2, 1, 33, 'casa', 'MC', 32, 1, 0, 0, 1, 0, 0, '0', '30', '0', '0', '0', '0', 7.3, 0),
(75, 7, 7, 6, 2, 1, 34, 'casa', 'MC', 4, 1, 0, 0, 0, 0, 1, '0', '0', '0', '82', '0', '0', 7.3, 0),
(76, 7, 7, 6, 2, 1, 35, 'casa', 'ME', 18, 1, 0, 0, 0, 1, 0, '0', '0', '74', '0', '0', '0', 7.3, 0),
(77, 7, 7, 6, 2, 1, 36, 'casa', 'MD', 39, 1, 0, 1, 0, 1, 0, '0', '45', '40', '0', '0', '86', 7.3, 0),
(78, 7, 7, 6, 2, 1, 37, 'casa', 'FW', 5, 1, 0, 1, 0, 0, 0, '80', '0', '0', '0', '0', '0', 7.3, 0),
(79, 7, 7, 6, 2, 1, 38, 'casa', 'FW', 8, 1, 0, 1, 0, 0, 0, '45', '0', '0', '0', '0', '76', 7.3, 0),
(80, 7, 7, 6, 2, 1, 31, 'casa', 'DC', 12, 0, 0, 0, 0, 0, 0, '0', '0', '0', '0', '76', '0', 0, 0),
(81, 7, 7, 6, 2, 1, 32, 'casa', 'FW', 2, 0, 0, 0, 0, 0, 0, '0', '0', '0', '0', '86', '0', 6.5, 0);

-- --------------------------------------------------------

--
-- Table structure for table `players_statistics`
--

CREATE TABLE `players_statistics` (
  `id` int(11) NOT NULL,
  `idmatch_result` int(11) NOT NULL,
  `idgame_clashe` int(11) NOT NULL,
  `idcompetition` int(11) NOT NULL,
  `idteam_home` int(11) NOT NULL,
  `idteam_away` int(11) NOT NULL,
  `idplayer` int(11) NOT NULL,
  `position` varchar(10) NOT NULL,
  `minutes_played` varchar(10) NOT NULL,
  `defenses` int(11) NOT NULL,
  `punches` int(11) NOT NULL,
  `exits` int(11) NOT NULL,
  `successful_exits` int(11) NOT NULL,
  `claimed_ai_balls` int(11) NOT NULL,
  `defenses_in_box` int(11) NOT NULL,
  `capital_errors` int(11) NOT NULL,
  `touches_ball` int(11) NOT NULL,
  `passes_right` int(11) NOT NULL,
  `passes_right_percentage` int(11) NOT NULL,
  `crossings` int(11) NOT NULL,
  `precise_crossings` int(11) NOT NULL,
  `long_balls` int(11) NOT NULL,
  `precise_long_balls` int(11) NOT NULL,
  `cut_balls` int(11) NOT NULL,
  `shots_saved` int(11) NOT NULL,
  `interceptions` int(11) NOT NULL,
  `tackles` int(11) NOT NULL,
  `dribbling_suffered` int(11) NOT NULL,
  `floor_duels` int(11) NOT NULL,
  `won_floor_duels` int(11) NOT NULL,
  `air_duels` int(11) NOT NULL,
  `won_air_duels` int(11) NOT NULL,
  `loss_of_possession` int(11) NOT NULL,
  `fouls_committed` int(11) NOT NULL,
  `fouls_suffered` int(11) NOT NULL,
  `shots_total` int(11) NOT NULL,
  `shots_inside_box` int(11) NOT NULL,
  `shots_outside_box` int(11) NOT NULL,
  `goal_strikes` int(11) NOT NULL,
  `goal_strikes_out` int(11) NOT NULL,
  `shots_blocked` int(11) NOT NULL,
  `dribbling_attempts` int(11) NOT NULL,
  `successful_dribbling_attempts` int(11) NOT NULL,
  `offside` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `players_statistics`
--

INSERT INTO `players_statistics` (`id`, `idmatch_result`, `idgame_clashe`, `idcompetition`, `idteam_home`, `idteam_away`, `idplayer`, `position`, `minutes_played`, `defenses`, `punches`, `exits`, `successful_exits`, `claimed_ai_balls`, `defenses_in_box`, `capital_errors`, `touches_ball`, `passes_right`, `passes_right_percentage`, `crossings`, `precise_crossings`, `long_balls`, `precise_long_balls`, `cut_balls`, `shots_saved`, `interceptions`, `tackles`, `dribbling_suffered`, `floor_duels`, `won_floor_duels`, `air_duels`, `won_air_duels`, `loss_of_possession`, `fouls_committed`, `fouls_suffered`, `shots_total`, `shots_inside_box`, `shots_outside_box`, `goal_strikes`, `goal_strikes_out`, `shots_blocked`, `dribbling_attempts`, `successful_dribbling_attempts`, `offside`) VALUES
(1, 7, 7, 6, 2, 1, 2, 'GK', '90', 5, 4, 5, 3, 2, 3, 1, 9, 5, 40, 0, 0, 10, 5, 4, 4, 1, 0, 0, 0, 0, 0, 0, 0, 0, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(2, 7, 7, 6, 2, 1, 15, 'MC', '90', 0, 0, 0, 0, 0, 0, 0, 40, 30, 70, 4, 3, 5, 3, 7, 5, 3, 3, 4, 1, 5, 3, 5, 3, 1, 7, 9, 5, 3, 2, 1, 0, 1, 5, 5),
(3, 7, 7, 6, 2, 1, 16, 'FW', '90', 0, 0, 0, 0, 0, 0, 0, 15, 5, 50, 3, 3, 5, 1, 0, 0, 1, 2, 1, 5, 2, 5, 2, 2, 3, 7, 5, 3, 2, 3, 1, 2, 7, 5, 3),
(4, 7, 7, 6, 2, 1, 7, 'DC', '90', 0, 0, 0, 0, 0, 0, 0, 10, 6, 40, 0, 0, 5, 3, 2, 1, 3, 1, 1, 2, 1, 2, 1, 2, 4, 1, 1, 1, 0, 1, 0, 0, 2, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `players_transfers`
--

CREATE TABLE `players_transfers` (
  `id` int(11) NOT NULL,
  `idplayer` int(11) NOT NULL,
  `idtransfer` int(11) NOT NULL,
  `idteam_out` int(11) NOT NULL,
  `idteam_entry` int(11) NOT NULL,
  `contract_date` date NOT NULL,
  `valor_actual` float NOT NULL,
  `number_shirt` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `players_transfers`
--

INSERT INTO `players_transfers` (`id`, `idplayer`, `idtransfer`, `idteam_out`, `idteam_entry`, `contract_date`, `valor_actual`, `number_shirt`) VALUES
(1, 1, 1, 54, 1, '2020-06-01', 100, 1),
(2, 2, 2, 54, 1, '2021-06-01', 100, 44),
(3, 3, 3, 54, 1, '2020-06-01', 100, 12),
(4, 4, 4, 54, 1, '2020-06-01', 100, 2),
(5, 5, 5, 54, 1, '2021-06-01', 100, 13),
(6, 6, 6, 54, 1, '2020-06-01', 100, 20),
(7, 7, 7, 54, 1, '2020-06-01', 100, 32),
(8, 8, 8, 54, 1, '2020-06-01', 100, 6),
(9, 9, 9, 54, 1, '2020-06-01', 100, 19),
(10, 10, 10, 54, 1, '2020-06-01', 100, 28),
(11, 11, 11, 54, 1, '2022-06-01', 100, 4),
(12, 12, 12, 54, 1, '2020-06-01', 100, 8),
(13, 13, 13, 54, 1, '2020-06-01', 100, 25),
(14, 14, 14, 54, 1, '2020-06-01', 100, 30),
(15, 15, 15, 33, 1, '2020-06-01', 500, 5),
(16, 16, 16, 54, 1, '2020-06-01', 100, 18),
(17, 17, 17, 54, 1, '2020-06-01', 100, 29),
(18, 18, 18, 54, 1, '2020-06-01', 100, 39),
(19, 19, 19, 54, 1, '2020-06-01', 100, 7),
(20, 20, 20, 42, 1, '2022-06-01', 500, 10),
(21, 21, 21, 54, 1, '2020-06-01', 100, 22),
(22, 22, 22, 54, 1, '2020-06-01', 100, 99),
(23, 23, 23, 54, 1, '2020-06-01', 100, 9),
(24, 24, 24, 54, 1, '2020-06-01', 100, 17),
(25, 25, 25, 54, 1, '2020-06-01', 100, 26),
(26, 15, 26, 33, 33, '2012-06-01', 7000, 22),
(27, 15, 28, 33, 33, '2014-06-01', 100, 9),
(28, 15, 27, 33, 33, '2013-06-01', 7000, 9),
(29, 15, 29, 33, 33, '2017-06-01', 100, 9),
(30, 20, 30, 54, 34, '2008-06-01', 700, 9),
(31, 20, 31, 34, 35, '2009-06-01', 700, 9),
(32, 20, 32, 35, 36, '2010-06-01', 800, 9),
(33, 20, 33, 36, 37, '2011-06-01', 800, 9),
(34, 20, 34, 37, 38, '2012-07-01', 1300, 9),
(35, 20, 35, 38, 39, '2013-06-01', 1000, 9),
(36, 20, 36, 39, 40, '2014-06-01', 1000, 10),
(37, 20, 37, 40, 39, '2015-06-01', 1300, 10),
(38, 20, 38, 39, 41, '2016-07-01', 1500, 9);

-- --------------------------------------------------------

--
-- Table structure for table `stadiums`
--

CREATE TABLE `stadiums` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `logo_stadium` varchar(20) NOT NULL,
  `capacity` int(11) NOT NULL,
  `city` varchar(20) NOT NULL,
  `foundation` date NOT NULL,
  `grass_type` varchar(20) NOT NULL,
  `idcountry` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `stadiums`
--

INSERT INTO `stadiums` (`id`, `name`, `logo_stadium`, `capacity`, `city`, `foundation`, `grass_type`, `idcountry`) VALUES
(1, 'Parque Desportivo do Buçaquinho', 'florgrade_fc3.png', 500, 'Cortegaça', '1923-01-05', 'Sintético', 1),
(2, 'Campo São Tiago de Lobão', 'lobao3.png', 6000, 'Lobão, Santa Maria d', '1923-01-05', 'Sintético', 1),
(3, 'Campo de Futebol de Pousadela', 'ad_nogueira_regedour', 500, 'Nogueira da Regedour', '1974-01-05', 'Pelado', 1),
(4, 'Campo Minas do Pintor', 'real_nogueirense3.pn', 500, 'Nogueira do Cravo - ', '1923-01-05', 'Sintético', 1),
(5, 'Complexo Desportivo do Sargaçal', 'ccr_valega3.png', 1500, 'Válega, Ovar', '1969-09-30', 'Sintético', 1),
(6, 'Campo de Jogos da ADC Sanguedo', 'sanguedo3.png', 3000, 'Sanguedo, Santa Mari', '1975-05-02', 'Sintético', 1),
(7, 'Campo Floriano Borges', 'milheiroense3.png', 500, 'Milheirós de Poiares', '1975-10-23', 'Pelado', 1),
(8, 'Academia Forte Paixão', 'lusitania_de_lourosa', 700, 'Lourosa, Santa Maria', '2016-01-05', 'Sintético', 1),
(9, 'Parque de Jogos de Santo André', 'mosteiro_fc3.png.png', 2500, 'Mosteirô, Santa Mari', '1923-01-05', 'Sintético', 1),
(10, 'Campo da Raposeira', 'macieira_cambra3.png', 1000, 'Macieira de Cambra, ', '1981-05-04', 'Sintético', 1),
(11, 'Campo dos Valos', 'romariz_sta_maria_fe', 1500, 'Romariz - Santa Mari', '1976-09-16', 'Pelado', 1),
(12, 'Parque Desportivo de Caldas S. Jorge', 'caldas_s_jorge3.png', 1500, 'Caldas de São Jorge,', '1980-10-24', 'Sintético', 1),
(13, 'Campo do Rejumil', 'ud_fermedo3.png', 196, 'Cabeçais, Fermedo', '1992-06-01', 'Sintético', 1),
(14, 'Parque da Concórdia', 'relampago_nogueirens', 1000, 'Nogueira da Regedour', '1978-03-01', 'Pelado', 1),
(15, 'Campo Dona Maria da Guia', 'cd_tarei3.png', 780, 'Tarei, Santa Maria d', '1972-09-25', 'Sintético', 1),
(16, 'Parque de Jogos de Vila Viçosa', 'ccr_vila_vicosa3.png', 500, 'Vila Viçosa, Arouca', '1977-08-13', 'Pelado', 1),
(17, 'Campo Manuel Emilio dos Santos', 'ccr_sao_martinho3.pn', 1000, 'São Martinho de Sard', '2001-01-05', 'Pelado', 1),
(18, 'Parque Desportivo da Associação Atlética de Avanca', 'santiais3.png', 1000, 'Avanca, Estarreja', '1937-01-05', 'Sintético', 1),
(19, 'Estádio do Sport Lisboa e Benfica (Luz)', 'benfica3.png', 64000, 'Lisboa', '2003-01-25', 'Relva Natural', 1),
(20, 'Estádio do Dragão', 'porto3.png', 50000, 'Porto', '2003-01-25', 'Relva Natural', 1),
(21, 'Santiago Bernabéu', 'real_madrid3.png', 81000, 'Madrid', '1947-01-25', 'Relva Natural', 3),
(22, 'Camp Nou', 'barcelona3.png', 99000, 'Barcelona', '1957-01-25', 'Relva Natural', 3),
(23, 'Etihad Stadium', 'man_city3.png', 55000, 'Manchester', '2003-01-25', 'Relva Natural', 2),
(24, 'Anfield', 'liverpool3.png', 54800, 'Liverpool', '1884-01-25', 'Relva Natural', 2),
(25, 'Allianz Stadium', 'juventus3.png', 75000, 'Torino', '2013-01-25', 'Relva Natural', 4),
(26, 'Stadio Giuseppe Meazza', 'inter3.png', 80, 'Milano', '1925-01-25', 'Relva Natural', 4),
(27, 'Allianz Arena', 'bayern3.png', 75, 'Munique', '2005-01-25', 'Relva Natural', 5),
(28, 'Signal Iduna Park', 'dortmund3.png', 81, 'Dortmund', '1974-01-25', 'Relva Natural', 5),
(29, 'Parc des Princes', 'psg3.png', 48, 'Paris', '1897-01-25', 'Relva Natural', 6),
(30, 'Orange Vélodrome', 'marseille3.png', 67, 'Marseille', '1974-01-25', 'Relva Natural', 6),
(31, 'Johan Cruyff Arena', 'ajax3.png', 53, 'Amesterdão', '1996-01-25', 'Relva Natural', 7),
(32, 'Philips Stadion', 'psv3.png', 35, 'Eindhoven', '1910-01-25', 'Relva Natural', 7),
(33, 'Estádio do Lusitânia FC Lourosa', '', 0, 'Lourosa - Santa Mari', '1999-01-05', 'Relva', 1),
(34, 'Estádio Conde Dias Garcia', 'ad_sanjoanense3.png', 15, 'São João da Madeira', '1910-01-25', 'Relva', 1),
(35, 'Estádio da Barrinha', '', 0, 'Esmoriz', '1999-01-05', 'Relva', 1),
(36, 'Parque Silva Matos', '', 0, 'Santa Marinha - Vila', '1999-01-05', 'Relva', 1),
(37, 'Estádio Rei Ramiro', '', 0, 'Santa Marinha - Vila', '1999-01-05', 'Relva', 1),
(38, 'Estádio da Ribes', '', 0, '	Santa Maria de Oliv', '1999-01-05', 'Relva', 1),
(39, 'Estádio Comendador Manuel de Oliveira Violas', '', 0, 'Espinho', '1999-01-05', 'Relva', 1),
(40, 'Estádio Manuel Marques', '', 0, 'Torres Vedras', '1999-01-05', 'Relva', 1),
(41, 'Complexo Desportivo de Nine', '', 0, 'Nine - Vila Nova de ', '1999-01-05', 'Relva', 1),
(42, 'Gymnastikos Sullogos ta Pagkypria (Neo GSP)', '', 0, 'Nicósia', '1999-01-05', 'Relva', 8),
(43, 'Estádio Jaime Rocha', '', 0, 'Pinheiro da Bemposta', '1999-01-05', 'Relva', 1),
(44, 'CR Antes', '', 0, 'CR Antes', '1999-01-05', 'Relva', 1),
(45, 'Ovarense', '', 0, 'Ovarense', '1999-01-05', 'Relva', 1),
(46, 'Amigos Visconde', '', 0, 'Amigos Visconde', '1999-01-05', 'Relva', 1);

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `nickname` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `foundation` date NOT NULL,
  `president` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `website` varchar(255) NOT NULL,
  `logo_team` varchar(50) NOT NULL,
  `logo_kit_home` varchar(50) NOT NULL,
  `logo_kit_away` varchar(50) NOT NULL,
  `idcountry` int(11) NOT NULL,
  `idstadium` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='	';

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`id`, `name`, `nickname`, `city`, `foundation`, `president`, `email`, `website`, `logo_team`, `logo_kit_home`, `logo_kit_away`, `idcountry`, `idstadium`) VALUES
(1, 'Florgrade Futebol Clube', 'Florgrade FC', 'Rio Meão, Santa Maria da Feira', '2019-05-01', 'Vítor Couto', 'geral@florgradefc.pt', '---', 'florgrade_fc.png', 'florgrade_fc1.png', 'florgrade_fc2.png', 1, 1),
(2, 'Associação Desportiva e Cultural de Lobão', 'Lobão', 'Lobão,Santa Maria da Feira', '0000-00-00', 'Manuel  Pinho', 'adclobaoficial@gmail.com', 'http://www.adclobao.pt', 'lobao.png', 'lobao1.png', 'lobao2.png', 1, 2),
(3, 'Associação Desportiva de Nogueira da Regedoura', 'AD Nogueira Regedoura', 'Pousadela,Santa Maria da Feira', '0000-00-00', 'Fernando Campos', 'a.desp.nogueiraregedoura@gmail.com', '---', 'ad_nogueira_regedoura.png', 'ad_nogueira_regedoura1.png', 'ad_nogueira_regedoura2.png', 1, 3),
(4, 'Real Clube Nogueirense', 'Real Nogueirense', 'Oliveira de Azeméis', '1976-09-07', 'Daniel Moreira', 'rcnogueirense2018@gmail.com', 'http://www.facebook.com/rcnogueirense', 'real_nogueirense.png', 'real_nogueirense1.png', 'real_nogueirense2.png', 1, 4),
(5, 'Centro Cultura e Recreativo de Válega', 'CCR Válega', 'Válega', '1969-09-30', 'Paulo Matos', 'geral@ccrvalega.net', 'http://www.ccrvalega.net/', 'ccr_valega.png', 'ccr_valega1.png', 'ccr_valega2.png', 1, 5),
(6, 'Associação Desportiva e Cultural de Sanguedo', 'Sanguedo', 'Sanguedo, Santa Maria da Feira', '1975-05-02', 'Mário Silva', 'adcsanguedo@hotmail.com', '---', 'sanguedo.png', 'sanguedo1.png', 'sanguedo2.png', 1, 6),
(7, 'Grupo Desportivo Milheiroense', 'Milheiroense', 'Milheirós de Poiares, Santa Maria da Feira', '1975-10-23', 'Fernando Campos', 'milheiroense@gmail.com', 'http://www.gdmilheiroense.net', 'milheiroense.png', 'milheiroense1.png', 'milheiroense2.png', 1, 7),
(8, 'Lusitânia de Lourosa Futebol Clube B', 'Lusitânia de Lourosa B', 'Lourosa, Santa Maria da Feira', '1924-04-24', 'Hugo Mendes', 'llourosafc@llourosafc.pt', 'http://www.llourosafc.pt/', 'lusitania_de_lourosab.png', 'lusitania_de_lourosab1.png', 'lusitania_de_lourosab2.png', 1, 8),
(9, 'Mosteirô FC', 'Mosteirô Futebol Clube', 'Mosteirô, Santa Maria da Feira', '1982-04-16', 'Fernando Andrade', 'mosteiro.f.clube@gmail.com', 'http://mosteirofutebolclube.blogspot.com/', 'mosteiro.png', 'mosteiro1.png', 'mosteiro2.png', 1, 9),
(10, 'Clube Desportivo e Cultural de Macieira de Cambra', 'Macieira Cambra', 'Macieira de Cambra,Vale de Cambra', '1981-05-04', 'Leonel Costa', 'geral.macieiracambra@gmail.com', '---', 'macieira_cambra.png', 'null', 'null', 1, 10),
(11, 'Romariz Futebol Clube', 'Romariz Sta Maria Feira', 'Romariz, Santa Maria da Feira', '1976-09-16', 'Álvaro Relvas', 'romarizfc1415@gmail.com', 'https://romarizfutebolclub.wixsite.com/romarizfc1976', 'romariz_sta_maria_feira.png', 'romariz_sta_maria_feira1.png', 'romariz_sta_maria_feira2.png', 1, 11),
(12, 'Caldas de São Jorge Sport Clube', 'Caldas S. Jorge', 'Caldas de São Jorge, Santa Maria da Feira', '1980-10-24', 'Horácio Silva', 'c.s.jorge@hotmail.com', 'http://caldassaojorgesc.simplesite.com/', 'caldas_s_jorge.png', 'caldas_s_jorge1.png', 'caldas_s_jorge2.png', 1, 12),
(13, 'União Desportiva de Fermedo', 'UD Fermedo', 'Fermêdo, Arouca', '1992-06-01', 'Álvaro Ferreira', '---', '---', 'ud_fermedo.png', 'ud_fermedo1.png', 'ud_fermedo2.png', 1, 13),
(14, 'Relâmpago União Futebol Clube Nogueirense', 'Relâmpago Nogueirense', 'Nogueira da Regedoura, Santa Maria da Feira', '1978-03-01', 'Américo Brandão', '---', '---', 'relampago_nogueirense.png', 'relampago_nogueirense1.png', 'relampago_nogueirense2.png', 1, 14),
(15, 'Clube Desportivo de Tarei', 'CD Tarei', 'Maria da Feira', '1972-09-25', 'Américo Paulo', '---', '---', 'cd_tarei.png', 'tarei1.png', 'tarei.png', 1, 15),
(16, 'Centro Cultural e Recreativo de Vila Viçosa', 'CCR Vila Viçosa', 'Vila Viçosa, Arouca', '1977-08-13', 'Hugo Amaral', 'ccrvv@live.com.pt', 'http://tertuliaalvinegra.blogspot.pt/', 'ccr_vila_vicosa.png', 'ccr_vila_vicosa1.png', 'ccr_vila_vicosa2.png', 1, 16),
(17, 'Centro Cultural Recreativo São Martinho', 'CCR São Martinho', 'São Martinho de Sardoura, Castelo de Paiva', '1990-01-04', 'Fernando Vieira', 'ccrsaomartinho@gmail.com', 'http://saomartinho17.wixsite.com/ccrsaomartinho', 'ccr_sao_martinho.png', 'ccr_sao_martinho1.png', 'ccr_sao_martinho2.png', 1, 17),
(18, 'Associação Desportiva de Santiais', 'Santiais', 'Beduído - Estarreja', '1997-06-12', 'António  Ferreira', 'adssantiais@gmail.com', '---', 'santiais.png', 'santiais1.png', 'santiais2.png', 1, 18),
(19, 'Sport Lisboa e Benfica', 'Benfica', 'Lisboa', '1904-02-28', 'Luís Filipe Vieira', 'sec.geral@slbenfica.pt', 'http://www.slbenfica.pt/', 'benfica.png', 'benfica1.png', 'benfica2.png', 1, 19),
(20, 'Futebol Clube do Porto', 'FC Porto', 'Porto', '1893-09-28', 'Jorge Nuno de Lima Pinto da Costa', 'fcporto@fcporto.pt', 'http://www.fcporto.pt', 'porto.png', 'porto1.png', 'porto2.png', 1, 20),
(21, 'Real Madrid Club de Fútbol', 'Real Madrid', 'Madrid', '1902-03-06', 'Florentino Pérez', 'mensajes@realmadrid.com', 'http://www.realmadrid.com/', 'real_madrid.png', 'real_madrid1.png', 'real_madrid2.png', 3, 21),
(22, 'Futbol Club Barcelona', 'Barcelona', 'Barcelona', '1899-11-29', 'Josep Maria Bartomeu i Floreta', 'oab@fcbarcelona.cat', 'http://www.fcbarcelona.com', 'barcelona.png', 'barcelona1.png', 'barcelona2.png', 3, 22),
(23, 'Manchester City Football Club', 'Manchester City', 'Manchester', '1880-11-18', 'Khaldoon Al Mubarak', 'mcfc@mcfc.co.uk', 'http://www.mcfc.co.uk', 'man_city.png', 'man_city1.png', 'man_city2.png', 2, 23),
(24, 'Liverpool Football Club', 'Liverpool', 'Liverpool', '1892-06-03', 'Tom Werner', '---', 'http://www.liverpoolfc.com/', 'liverpool.png', 'liverpool1.png', 'liverpool2.png', 2, 34),
(25, 'Juventus Football Club', 'Juventus', 'Torino', '1897-11-01', 'Andrea Agnelli', 'customercare@juventus.com', 'http://www.juventus.com', 'juventus.png', 'juventus1.png', 'juventus2.png', 4, 25),
(26, 'Football Club Internazionale Milano', 'Internazionale', 'Milano', '1908-03-09', 'Zhang Kangyang', '---', 'http://www.inter.it/it', 'inter.png', 'inter1.png', 'inter2.png', 4, 26),
(27, 'Fussball Club Bayern München', 'Bayern München', 'München', '1900-02-27', 'Karl Hopfner', '---', '---', 'bayern.png', 'bayern1.png', 'bayern2.png', 5, 27),
(28, 'Ballspiel-Verein Borussia 1909 e. V. Dortmund', 'Borussia Dortmund', 'Dortmund', '1909-12-19', 'Hans-Joachim Watzke', '---', '---', 'dortmund.png', 'dortmund1.png', 'dortmund2.png', 5, 28),
(29, 'Paris Saint-Germain Football Club', 'Paris SG', 'Paris', '1900-02-27', 'Jacques', '---', '---', 'psg.png', 'psg1.png', 'psg2.png', 6, 29),
(30, 'Olympique de Marseille', 'Marseille', 'Marseille', '1899-08-31', 'Jacques-Henri Eyraud', '---', '---', 'marseille.png', 'marseille1.png', 'marseille2.png', 6, 30),
(31, 'Amsterdamsche Football Club Ajax NV', 'Ajax', 'Amsterdam', '1900-03-18', 'Jan', '---', '---', 'ajax.png', 'ajax1.png', 'ajax2.png', 7, 31),
(32, 'Philips Sports Vereniging Eindhoven', 'PSV', 'Eindhoven', '1913-08-31', 'Jan Reker', '---', '---', 'psv.png', 'psv1.png', 'psv2.png', 7, 32),
(33, 'Lusitânia de Lourosa Futebol Clube', 'Lusitânia de Lourosa', 'Lourosa, Santa Maria da Feira', '1924-04-24', 'Hugo Mendes', 'llourosafc@llourosafc.pt', 'http://www.llourosafc.pt/', 'lusitania_de_lourosa.png', 'lusitania_de_lourosab1.png', 'lusitania_de_lourosab2.png', 1, 33),
(34, 'Associação Desportiva Sanjoanense', 'AD Sanjoanense', 'São João da Madeira', '1924-02-25', 'Luís Vargas', '---', '---', 'ad_sanjoanense.png', 'ad_sanjoanense1.png', 'ad_sanjoanense2.png', 1, 34),
(35, 'Sporting Clube de Esmoriz', 'Esmoriz', 'Esmoriz', '1932-06-26', 'João Godinho', 'info@scesmoriz.com', '---', 'esmoriz.png', 'esmoriz1.png', 'esmoriz2.png', 1, 35),
(36, 'SC Coimbrões', 'SC Coimbrões', 'Vila Nova de Gaia', '1932-06-26', 'Vitor Oliveira', 'sccoimbroes@gmail.com', 'http://www.sccoimbroes.pt', 'sc_coimbroes.png', 'sc_coimbroes1.png', 'sc_coimbroes2.png', 1, 36),
(37, 'CD Candal', 'CD Candal', 'Vila Nova de Gaia', '1932-06-26', 'Vitor Oliveira', 'secretaria@cdcandal.pt', 'http://www.cdcandal.pt/', 'cd_candal.png', 'cd_candal1.png', 'cd_candal2.png', 1, 37),
(38, 'AD Oliveirense', 'AD Oliveirense', 'Santa Maria de Oliveira, Vila Nova de Famalicão', '1932-06-26', 'Nelson Pereira', 'geral.adoliveirense@hotmail.com', '---', 'ad_oliveirense.png', 'ad_oliveirense1.png', 'ad_oliveirense2.png', 1, 38),
(39, 'SC Espinho', 'SC Espinho', 'Espinho', '1914-11-11', 'Bernardo Almeida', 'scespinho@scespinho.pt', 'http://scespinho.pt', 'espinho.png', 'espinho1.png', 'espinho2.png', 1, 39),
(40, 'Torreense', 'Torreense', 'Torres Vedras', '1917-05-01', 'Mário Miranda', '---', '---', 'torrense.png', 'torrense1.png', 'torrense2.png', 1, 40),
(41, 'AD Ninense', 'AD Ninense', 'Nine - Vila Nova de Famalicão', '1917-05-01', 'Manuel Faria', '---', '---', 'ad_ninense.png', 'ad_ninense1.png', 'ad_ninense2.png', 1, 41),
(42, 'Olympiakos Nicosia FC', 'Olympiakos Nicosia', 'Nicosia', '1931-07-01', 'Petros Savva', '---', 'http://www.olympiakos.com.cy', 'olympiakos_nicosia.png', 'olympiakos_nicosia1.png', 'olympiakos_nicosia2.png', 8, 42),
(43, 'Pinheirensee', 'Pinheirense', 'Pinheiro da Bemposta, Oliveira de Azeméis', '1924-04-24', 'Sr. Amaral', '---', '---', 'pinheirense.png', 'pinheirense1.png', 'pinheirense2.png', 1, 43),
(44, 'CR Antes', 'CR Antes', 'CR Antes', '1932-06-26', 'João Godinho', '---', '---', 'cr_antes.png.png', 'cr_antes1.png', 'cr_antes2.png', 1, 44),
(45, 'Ovarense', 'Ovarense', 'Ovarense', '1932-06-26', 'Vitor Oliveira', '---', '---', 'ovarense.png', 'ovarense1.png', 'ovarense2.png', 1, 45),
(46, 'Amigos Visconde', 'Amigos Visconde', 'Vila Nova de Gaia', '1932-06-26', 'Vitor Oliveira', '---', '---', 'amigos_visconde.png', 'amigos_visconde1.png', 'amigos_visconde2.png', 1, 46),
(47, 'Federação Portuguesa de Futebol', 'Portugal', 'Lisboa', '1914-03-31', 'Fernando Gomes', 'info@fpf.pt', 'http://www.fpf.pt', 'f_portugal.png', 'f_portugal1.png', 'f_portuga2.png', 1, NULL),
(48, 'The Football Association', 'Inglaterra', 'Londres', '1863-10-26', 'Geoffrey Thompson', '---', '---', 'f_inglaterra.png', 'f_inglaterra1.png', 'f_inglaterra2.png', 2, NULL),
(49, 'Real Federación Española de Fútbol', 'Espanha', 'Madrid', '1913-01-01', 'Luis Manuel Rubiales Béjar', '---', '---', 'f_espanha.png', 'f_espanha1.png', 'f_espanha2.png', 3, NULL),
(50, 'Federazione Italiana Giuoco Calcio', 'Itália', 'Roma', '1898-01-01', 'Giancarlo Abete', '---', '---', 'f_italia.png', 'f_italia1.png', 'f_italia2.png', 4, NULL),
(51, 'Deutscher Fussball-Bund', 'Alemanha', 'Berlim', '1900-01-01', 'Theo Zwanziger', '---', '---', 'f_alemanha.png', 'f_alemanha1.png', 'f_alemanha2.png', 5, NULL),
(52, 'Fédération Française de Football', 'França', 'Paris', '1919-00-00', 'Jean-Pierre Escalettes', '---', '---', 'f_franca.png', 'f_franca1.png', 'f_franca2.png', 6, NULL),
(53, 'Koninklijke Nederlandse Voetbalbond', 'Holanda', 'Amsterdão', '1889-01-01', 'Michael van Praag', '---', '---', 'f_holanda.png', 'f_holanda1.png', 'f_holanda2.png', 7, NULL),
(54, 'no team', 'no team', '', '0000-00-00', '', '---', '---', 'no_team.png', 'no_team1.png', 'no_team2.png', 95, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `teams_competitions`
--

CREATE TABLE `teams_competitions` (
  `id` int(11) NOT NULL,
  `idteam` int(11) NOT NULL,
  `idcompetition` int(11) NOT NULL,
  `league_group` varchar(30) NOT NULL,
  `league_title` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `teams_competitions`
--

INSERT INTO `teams_competitions` (`id`, `idteam`, `idcompetition`, `league_group`, `league_title`) VALUES
(1, 1, 6, 'Zona Norte', 'a decorrer'),
(2, 2, 6, 'Zona Norte', 'a decorrer'),
(3, 3, 6, 'Zona Norte', 'a decorrer'),
(4, 4, 6, 'Zona Norte', 'a decorrer'),
(5, 5, 6, 'Zona Norte', 'a decorrer'),
(6, 6, 6, 'Zona Norte', 'a decorrer'),
(7, 7, 6, 'Zona Norte', 'a decorrer'),
(8, 8, 6, 'Zona Norte', 'a decorrer'),
(9, 9, 6, 'Zona Norte', 'a decorrer'),
(10, 10, 6, 'Zona Norte', 'a decorrer'),
(11, 11, 6, 'Zona Norte', 'a decorrer'),
(12, 12, 6, 'Zona Norte', 'a decorrer'),
(13, 13, 6, 'Zona Norte', 'a decorrer'),
(14, 14, 6, 'Zona Norte', 'a decorrer'),
(15, 15, 6, 'Zona Norte', 'a decorrer'),
(16, 16, 6, 'Zona Norte', 'a decorrer'),
(17, 17, 6, 'Zona Norte', 'a decorrer'),
(18, 18, 6, 'Zona Norte', 'a decorrer'),
(19, 43, 13, 'Zona Sul', 'vencedor'),
(20, 44, 14, 'Zona Sul', 'vencedor'),
(21, 45, 15, 'Zona Norte', 'vencedor'),
(22, 46, 16, 'Zona Norte', 'vencedor');

-- --------------------------------------------------------

--
-- Table structure for table `teams_statistics`
--

CREATE TABLE `teams_statistics` (
  `id` int(11) NOT NULL,
  `idmatch_result` int(11) NOT NULL,
  `idgame_clashe` int(11) NOT NULL,
  `idcompetition` int(11) NOT NULL,
  `idteam_home` int(11) NOT NULL,
  `ball_possession_home` float NOT NULL,
  `goal_opportunities_home` int(11) NOT NULL,
  `corners_home` int(11) NOT NULL,
  `counterattacks_home` int(11) NOT NULL,
  `idteam_away` int(11) NOT NULL,
  `ball_possession_away` float NOT NULL,
  `corners_away` int(11) NOT NULL,
  `goal_opportunities_away` int(11) NOT NULL,
  `counterattacks_away` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `teams_statistics`
--

INSERT INTO `teams_statistics` (`id`, `idmatch_result`, `idgame_clashe`, `idcompetition`, `idteam_home`, `ball_possession_home`, `goal_opportunities_home`, `corners_home`, `counterattacks_home`, `idteam_away`, `ball_possession_away`, `corners_away`, `goal_opportunities_away`, `counterattacks_away`) VALUES
(1, 7, 7, 6, 2, 40, 15, 17, 10, 1, 60, 18, 23, '14');

-- --------------------------------------------------------

--
-- Table structure for table `transfers`
--

CREATE TABLE `transfers` (
  `id` int(11) NOT NULL,
  `date_transfer` date NOT NULL,
  `transfer_type` varchar(20) NOT NULL,
  `valor_transfer` float NOT NULL,
  `idteam_out` int(11) NOT NULL,
  `idteam_entry` int(11) NOT NULL,
  `season` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `transfers`
--

INSERT INTO `transfers` (`id`, `date_transfer`, `transfer_type`, `valor_transfer`, `idteam_out`, `idteam_entry`, `season`) VALUES
(1, '2019-07-01', 'Transf', 0, 54, 1, '2019/2020'),
(2, '2019-07-01', 'Transf', 0, 54, 1, '2019/2020'),
(3, '2019-07-01', 'Transf', 0, 54, 1, '2019/2020'),
(4, '2019-07-01', 'Transf', 0, 54, 1, '2019/2020'),
(5, '2019-07-01', 'Transf', 0, 54, 1, '2019/2020'),
(6, '2019-07-01', 'Transf', 0, 54, 1, '2019/2020'),
(7, '2019-07-01', 'Transf', 0, 54, 1, '2019/2020'),
(8, '2019-07-01', 'Transf', 0, 54, 1, '2019/2020'),
(9, '2019-07-01', 'Transf', 0, 54, 1, '2019/2020'),
(10, '2019-07-01', 'Transf', 0, 54, 1, '2019/2020'),
(11, '2019-07-01', 'Transf', 0, 54, 1, '2019/2020'),
(12, '2019-07-01', 'Transf', 0, 54, 1, '2019/2020'),
(13, '2019-07-01', 'Transf', 0, 54, 1, '2019/2020'),
(14, '2019-07-01', 'Transf', 0, 54, 1, '2019/2020'),
(15, '2019-07-01', 'Transf', 0, 33, 1, '2019/2020'),
(16, '2019-07-01', 'Transf', 0, 54, 1, '2019/2020'),
(17, '2019-07-01', 'Transf', 0, 54, 1, '2019/2020'),
(18, '2019-07-01', 'Transf', 0, 54, 1, '2019/2020'),
(19, '2019-07-01', 'Transf', 0, 54, 1, '2019/2020'),
(20, '2019-07-01', 'Transf', 0, 42, 1, '2019/2020'),
(21, '2019-07-01', 'Transf', 0, 54, 1, '2019/2020'),
(22, '2019-07-01', 'Transf', 0, 54, 1, '2019/2020'),
(23, '2019-07-01', 'Transf', 0, 54, 1, '2019/2020'),
(24, '2019-07-01', 'Transf', 0, 54, 1, '2019/2020'),
(25, '2019-07-01', 'Transf', 0, 54, 1, '2019/2020'),
(26, '2011-07-01', 'Transf', 0, 33, 33, '2011/2012'),
(27, '2012-07-01', 'Transf', 0, 33, 33, '2012/2013'),
(28, '2013-07-01', 'Transf', 0, 33, 33, '2013/2014'),
(29, '2014-07-01', 'Juniores', 0, 33, 33, '2014/2015'),
(30, '2007-07-01', 'Transf', 0, 54, 34, '2007/2008'),
(31, '2008-07-01', 'Transf', 0, 34, 35, '2008/2009'),
(32, '2009-07-01', 'Transf', 0, 35, 36, '2009/2010'),
(33, '2010-07-01', 'Transf', 0, 36, 37, '2010/20011'),
(34, '2011-07-01', 'Transf', 0, 37, 38, '2011/2012'),
(35, '2012-01-01', 'Emp', 0, 38, 39, '2012/2013'),
(36, '2013-07-01', 'Emp', 0, 39, 40, '2013/2014'),
(37, '2014-07-01', 'Reg Emp', 0, 40, 39, '2014/2015'),
(38, '2014-07-01', 'Transf', 1.5, 39, 41, '2015/2016'),
(39, '2019-07-01', 'Transf', 0, 33, 1, '2019/2020'),
(40, '2017-07-01', 'Transf', 900, 34, 33, '2017/2018'),
(41, '2016-07-01', 'Transf', 0, 35, 34, '2016/2017'),
(42, '2015-07-01', 'Renov', 100, 36, 35, '2015/2016'),
(43, '2014-07-01', 'Transf', 0, 54, 36, '2014/2015'),
(44, '2019-07-01', 'Transf', 0, 54, 2, '2019/2020'),
(45, '2017-07-01', 'Transf', 0, 54, 3, '2019/2020'),
(46, '2016-07-01', 'Transf', 0, 54, 4, '2019/2020'),
(47, '2015-07-01', 'Transf', 0, 54, 5, '2019/2020'),
(48, '2014-07-01', 'Transf', 0, 54, 6, '2019/2020'),
(49, '2019-07-01', 'Transf', 0, 54, 7, '2019/2020'),
(50, '2017-07-01', 'Transf', 0, 54, 8, '2019/2020'),
(51, '2016-07-01', 'Transf', 0, 54, 9, '2019/2020'),
(52, '2015-07-01', 'Transf', 0, 54, 10, '2019/2020'),
(53, '2014-07-01', 'Transf', 0, 54, 11, '2019/2020'),
(54, '2019-07-01', 'Transf', 0, 54, 12, '2019/2020'),
(55, '2017-07-01', 'Transf', 0, 54, 13, '2019/2020'),
(56, '2016-07-01', 'Transf', 0, 54, 14, '2019/2020'),
(57, '2015-07-01', 'Transf', 0, 54, 15, '2019/2020'),
(58, '2014-07-01', 'Transf', 0, 54, 16, '2019/2020'),
(59, '2019-07-01', 'Transf', 0, 54, 17, '2019/2020'),
(60, '2017-07-01', 'Transf', 0, 54, 18, '2019/2020');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `photo_user` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `photo_user`) VALUES
(1, 'André Tavares', 'a@ua.pt', '$2y$10$uk9Pb9c3y7u0yJ3hcaou9upKW5alrFVtWM.3FqsahMYtH/hKtrXjS', 'no_user.png'),
(2, 'Filipe Santos', 'asd@ua.pt', '$2y$10$FSTxHONWn/spLdSfpSwP/Oi2OYS4fwKufb6IxbNLPz81jz7UvmGuS', 'no_user.png'),
(19, 'andretavares', 'f@of.pt', '$2y$10$gyLjMk8ly9smN3lMuXyTmeiMAgLyac9p4Wq0SbWksR/GwvDWZAZ4S', 'no_user.png'),
(23, 'mjp', 'mjp@ua.pt', '$2y$10$hg7sYumRSP5qb7DB8754F.ATXw26KlEKEaW.GiU5c8bR7pg7kDr7a', 'no_user.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `competitions`
--
ALTER TABLE `competitions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_competitions_countries1` (`idcountry`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `favorites_competitions`
--
ALTER TABLE `favorites_competitions`
  ADD PRIMARY KEY (`id`,`iduser`,`idcompetition`),
  ADD KEY `fk_users_has_competitions_users1` (`iduser`),
  ADD KEY `fk_users_has_competitions_competitions1` (`idcompetition`);

--
-- Indexes for table `favorites_managers`
--
ALTER TABLE `favorites_managers`
  ADD PRIMARY KEY (`id`,`iduser`,`idmanager`),
  ADD KEY `fk_users_has_managers_users1` (`iduser`),
  ADD KEY `fk_users_has_managers_managers1` (`idmanager`);

--
-- Indexes for table `favorites_players`
--
ALTER TABLE `favorites_players`
  ADD PRIMARY KEY (`id`,`iduser`,`idplayer`),
  ADD KEY `fk_users_has_players_users1` (`iduser`),
  ADD KEY `fk_users_has_players_players1` (`idplayer`);

--
-- Indexes for table `favorites_teams`
--
ALTER TABLE `favorites_teams`
  ADD PRIMARY KEY (`id`,`iduser`,`idteam`),
  ADD KEY `fk_users_has_clubs_users` (`iduser`),
  ADD KEY `fk_users_has_clubs_clubs1` (`idteam`);

--
-- Indexes for table `games_clashes`
--
ALTER TABLE `games_clashes`
  ADD PRIMARY KEY (`id`,`idteam_home`,`idteam_away`,`idcompetition`),
  ADD KEY `fk_game_clashes_competitions1` (`idcompetition`),
  ADD KEY `fk_game_clashes_clubs1` (`idteam_away`),
  ADD KEY `fk_game_clashes_clubs2` (`idteam_home`),
  ADD KEY `fk_game_clashes_stadiums1` (`idstadium`);

--
-- Indexes for table `internation_teams`
--
ALTER TABLE `internation_teams`
  ADD PRIMARY KEY (`id`,`idteam`,`idplayer`),
  ADD KEY `fk_teams_has_players_teams1` (`idteam`),
  ADD KEY `fk_teams_has_players_players1` (`idplayer`);

--
-- Indexes for table `managers`
--
ALTER TABLE `managers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_managers_countries1` (`idcountry`);

--
-- Indexes for table `managers_competitions`
--
ALTER TABLE `managers_competitions`
  ADD PRIMARY KEY (`id`,`idmanager`,`idcompetition`),
  ADD KEY `fk_managers_has_competitions_managers1` (`idmanager`),
  ADD KEY `fk_managers_has_competitions_competitions1` (`idcompetition`);

--
-- Indexes for table `managers_games_clashes`
--
ALTER TABLE `managers_games_clashes`
  ADD PRIMARY KEY (`id`,`idgame_clashe`,`idcompetition`,`idteam_home`,`idteam_away`,`idmanager`),
  ADD KEY `fk_managers_has_games_clashes_managers1` (`idmanager`),
  ADD KEY `fk_managers_games_clashes_games_clashes1` (`idgame_clashe`,`idteam_home`,`idteam_away`,`idcompetition`);

--
-- Indexes for table `managers_matchs_results`
--
ALTER TABLE `managers_matchs_results`
  ADD PRIMARY KEY (`id`,`idmatch_result`,`idgame_clashe`,`idcompetition`,`idteam_home`,`idteam_away`,`idmanager`),
  ADD KEY `fk_managers_has_matchs_results_managers1` (`idmanager`),
  ADD KEY `fk_managers_matchs_results_matchs_results1` (`idmatch_result`,`idgame_clashe`,`idcompetition`,`idteam_home`,`idteam_away`);

--
-- Indexes for table `managers_transfers`
--
ALTER TABLE `managers_transfers`
  ADD PRIMARY KEY (`id`,`idmanager`,`idtransfer`,`idteam_out`,`idteam_entry`),
  ADD KEY `fk_managers_has_transfers_managers1` (`idmanager`),
  ADD KEY `fk_managers_has_transfers_transfers1` (`idtransfer`,`idteam_out`,`idteam_entry`);

--
-- Indexes for table `matchs_results`
--
ALTER TABLE `matchs_results`
  ADD PRIMARY KEY (`id`,`idgame_clashe`,`idcompetition`,`idteam_home`,`idteam_away`),
  ADD KEY `fk_matchs_results_games_clashes1` (`idgame_clashe`,`idteam_home`,`idteam_away`,`idcompetition`);

--
-- Indexes for table `players`
--
ALTER TABLE `players`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_players_countries1` (`idcountry`);

--
-- Indexes for table `players_competitions`
--
ALTER TABLE `players_competitions`
  ADD PRIMARY KEY (`id`,`idplayer`,`idcompetition`),
  ADD KEY `fk_players_has_competitions_players1` (`idplayer`),
  ADD KEY `fk_players_has_competitions_competitions1` (`idcompetition`);

--
-- Indexes for table `players_games_clashes`
--
ALTER TABLE `players_games_clashes`
  ADD PRIMARY KEY (`id`,`idgame_clashe`,`idcompetition`,`idteam_home`,`idteam_away`,`idplayer`),
  ADD KEY `fk_players_has_games_clashes_players1` (`idplayer`),
  ADD KEY `fk_players_games_clashes_games_clashes1` (`idgame_clashe`,`idteam_home`,`idteam_away`,`idcompetition`);

--
-- Indexes for table `players_matchs_results`
--
ALTER TABLE `players_matchs_results`
  ADD PRIMARY KEY (`id`,`idmatch_result`,`idgame_clashe`,`idcompetition`,`idteam_home`,`idteam_away`,`idplayer`),
  ADD KEY `fk_players_has_match_results_players1` (`idplayer`),
  ADD KEY `fk_players_matchs_results_matchs_results1` (`idmatch_result`,`idgame_clashe`,`idcompetition`,`idteam_home`,`idteam_away`);

--
-- Indexes for table `players_statistics`
--
ALTER TABLE `players_statistics`
  ADD PRIMARY KEY (`id`,`idmatch_result`,`idgame_clashe`,`idcompetition`,`idteam_home`,`idteam_away`,`idplayer`),
  ADD KEY `fk_players_has_matchs_results_players1` (`idplayer`),
  ADD KEY `fk_players_has_matchs_results_matchs_results1` (`idmatch_result`,`idgame_clashe`,`idcompetition`,`idteam_home`,`idteam_away`);

--
-- Indexes for table `players_transfers`
--
ALTER TABLE `players_transfers`
  ADD PRIMARY KEY (`id`,`idplayer`,`idtransfer`,`idteam_out`,`idteam_entry`),
  ADD KEY `fk_players_has_transfers_players1` (`idplayer`),
  ADD KEY `fk_players_has_transfers_transfers1` (`idtransfer`,`idteam_out`,`idteam_entry`);

--
-- Indexes for table `stadiums`
--
ALTER TABLE `stadiums`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_stadiums_countries1` (`idcountry`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_clubs_countries1` (`idcountry`),
  ADD KEY `fk_teams_stadiums1` (`idstadium`);

--
-- Indexes for table `teams_competitions`
--
ALTER TABLE `teams_competitions`
  ADD PRIMARY KEY (`id`,`idteam`,`idcompetition`),
  ADD KEY `fk_clubs_has_competitions_clubs1` (`idteam`),
  ADD KEY `fk_clubs_has_competitions_competitions1` (`idcompetition`);

--
-- Indexes for table `teams_statistics`
--
ALTER TABLE `teams_statistics`
  ADD PRIMARY KEY (`id`,`idmatch_result`,`idgame_clashe`,`idcompetition`,`idteam_home`,`idteam_away`),
  ADD KEY `fk_teams_has_matchs_results_matchs_results1` (`idmatch_result`,`idgame_clashe`,`idcompetition`,`idteam_home`,`idteam_away`);

--
-- Indexes for table `transfers`
--
ALTER TABLE `transfers`
  ADD PRIMARY KEY (`id`,`idteam_out`,`idteam_entry`),
  ADD KEY `fk_transfers_clubs1` (`idteam_entry`),
  ADD KEY `fk_transfers_teams1` (`idteam_out`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `competitions`
--
ALTER TABLE `competitions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT for table `favorites_competitions`
--
ALTER TABLE `favorites_competitions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `favorites_managers`
--
ALTER TABLE `favorites_managers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `favorites_players`
--
ALTER TABLE `favorites_players`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `favorites_teams`
--
ALTER TABLE `favorites_teams`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `games_clashes`
--
ALTER TABLE `games_clashes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=158;

--
-- AUTO_INCREMENT for table `internation_teams`
--
ALTER TABLE `internation_teams`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `managers`
--
ALTER TABLE `managers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `managers_competitions`
--
ALTER TABLE `managers_competitions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `managers_games_clashes`
--
ALTER TABLE `managers_games_clashes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `managers_matchs_results`
--
ALTER TABLE `managers_matchs_results`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `managers_transfers`
--
ALTER TABLE `managers_transfers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `matchs_results`
--
ALTER TABLE `matchs_results`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;

--
-- AUTO_INCREMENT for table `players`
--
ALTER TABLE `players`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `players_competitions`
--
ALTER TABLE `players_competitions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `players_games_clashes`
--
ALTER TABLE `players_games_clashes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=165;

--
-- AUTO_INCREMENT for table `players_matchs_results`
--
ALTER TABLE `players_matchs_results`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `players_transfers`
--
ALTER TABLE `players_transfers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `stadiums`
--
ALTER TABLE `stadiums`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `teams_competitions`
--
ALTER TABLE `teams_competitions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `teams_statistics`
--
ALTER TABLE `teams_statistics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `transfers`
--
ALTER TABLE `transfers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `competitions`
--
ALTER TABLE `competitions`
  ADD CONSTRAINT `fk_competitions_countries1` FOREIGN KEY (`idcountry`) REFERENCES `countries` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `favorites_competitions`
--
ALTER TABLE `favorites_competitions`
  ADD CONSTRAINT `fk_users_has_competitions_competitions1` FOREIGN KEY (`idcompetition`) REFERENCES `competitions` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_has_competitions_users1` FOREIGN KEY (`iduser`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `favorites_managers`
--
ALTER TABLE `favorites_managers`
  ADD CONSTRAINT `fk_users_has_managers_managers1` FOREIGN KEY (`idmanager`) REFERENCES `managers` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_has_managers_users1` FOREIGN KEY (`iduser`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `favorites_players`
--
ALTER TABLE `favorites_players`
  ADD CONSTRAINT `fk_users_has_players_players1` FOREIGN KEY (`idplayer`) REFERENCES `players` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_has_players_users1` FOREIGN KEY (`iduser`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `favorites_teams`
--
ALTER TABLE `favorites_teams`
  ADD CONSTRAINT `fk_users_has_clubs_clubs1` FOREIGN KEY (`idteam`) REFERENCES `teams` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_has_clubs_users` FOREIGN KEY (`iduser`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `games_clashes`
--
ALTER TABLE `games_clashes`
  ADD CONSTRAINT `fk_game_clashes_clubs1` FOREIGN KEY (`idteam_away`) REFERENCES `teams` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_game_clashes_clubs2` FOREIGN KEY (`idteam_home`) REFERENCES `teams` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_game_clashes_competitions1` FOREIGN KEY (`idcompetition`) REFERENCES `competitions` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_game_clashes_stadiums1` FOREIGN KEY (`idstadium`) REFERENCES `stadiums` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `internation_teams`
--
ALTER TABLE `internation_teams`
  ADD CONSTRAINT `fk_teams_has_players_players1` FOREIGN KEY (`idplayer`) REFERENCES `players` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_teams_has_players_teams1` FOREIGN KEY (`idteam`) REFERENCES `teams` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `managers`
--
ALTER TABLE `managers`
  ADD CONSTRAINT `fk_managers_countries1` FOREIGN KEY (`idcountry`) REFERENCES `countries` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `managers_competitions`
--
ALTER TABLE `managers_competitions`
  ADD CONSTRAINT `fk_managers_has_competitions_competitions1` FOREIGN KEY (`idcompetition`) REFERENCES `competitions` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_managers_has_competitions_managers1` FOREIGN KEY (`idmanager`) REFERENCES `managers` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `managers_games_clashes`
--
ALTER TABLE `managers_games_clashes`
  ADD CONSTRAINT `fk_managers_games_clashes_games_clashes1` FOREIGN KEY (`idgame_clashe`,`idteam_home`,`idteam_away`,`idcompetition`) REFERENCES `games_clashes` (`id`, `idteam_home`, `idteam_away`, `idcompetition`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_managers_has_games_clashes_managers1` FOREIGN KEY (`idmanager`) REFERENCES `managers` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `managers_matchs_results`
--
ALTER TABLE `managers_matchs_results`
  ADD CONSTRAINT `fk_managers_has_matchs_results_managers1` FOREIGN KEY (`idmanager`) REFERENCES `managers` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_managers_matchs_results_matchs_results1` FOREIGN KEY (`idmatch_result`,`idgame_clashe`,`idcompetition`,`idteam_home`,`idteam_away`) REFERENCES `matchs_results` (`id`, `idgame_clashe`, `idcompetition`, `idteam_home`, `idteam_away`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `managers_transfers`
--
ALTER TABLE `managers_transfers`
  ADD CONSTRAINT `fk_managers_has_transfers_managers1` FOREIGN KEY (`idmanager`) REFERENCES `managers` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_managers_has_transfers_transfers1` FOREIGN KEY (`idtransfer`,`idteam_out`,`idteam_entry`) REFERENCES `transfers` (`id`, `idteam_out`, `idteam_entry`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `matchs_results`
--
ALTER TABLE `matchs_results`
  ADD CONSTRAINT `fk_matchs_results_games_clashes1` FOREIGN KEY (`idgame_clashe`,`idteam_home`,`idteam_away`,`idcompetition`) REFERENCES `games_clashes` (`id`, `idteam_home`, `idteam_away`, `idcompetition`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `players`
--
ALTER TABLE `players`
  ADD CONSTRAINT `fk_players_countries1` FOREIGN KEY (`idcountry`) REFERENCES `countries` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `players_competitions`
--
ALTER TABLE `players_competitions`
  ADD CONSTRAINT `fk_players_has_competitions_competitions1` FOREIGN KEY (`idcompetition`) REFERENCES `competitions` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_players_has_competitions_players1` FOREIGN KEY (`idplayer`) REFERENCES `players` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `players_games_clashes`
--
ALTER TABLE `players_games_clashes`
  ADD CONSTRAINT `fk_players_games_clashes_games_clashes1` FOREIGN KEY (`idgame_clashe`,`idteam_home`,`idteam_away`,`idcompetition`) REFERENCES `games_clashes` (`id`, `idteam_home`, `idteam_away`, `idcompetition`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_players_has_games_clashes_players1` FOREIGN KEY (`idplayer`) REFERENCES `players` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `players_matchs_results`
--
ALTER TABLE `players_matchs_results`
  ADD CONSTRAINT `fk_players_has_match_results_players1` FOREIGN KEY (`idplayer`) REFERENCES `players` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_players_matchs_results_matchs_results1` FOREIGN KEY (`idmatch_result`,`idgame_clashe`,`idcompetition`,`idteam_home`,`idteam_away`) REFERENCES `matchs_results` (`id`, `idgame_clashe`, `idcompetition`, `idteam_home`, `idteam_away`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `players_statistics`
--
ALTER TABLE `players_statistics`
  ADD CONSTRAINT `fk_players_has_matchs_results_matchs_results1` FOREIGN KEY (`idmatch_result`,`idgame_clashe`,`idcompetition`,`idteam_home`,`idteam_away`) REFERENCES `matchs_results` (`id`, `idgame_clashe`, `idcompetition`, `idteam_home`, `idteam_away`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_players_has_matchs_results_players1` FOREIGN KEY (`idplayer`) REFERENCES `players` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `players_transfers`
--
ALTER TABLE `players_transfers`
  ADD CONSTRAINT `fk_players_has_transfers_players1` FOREIGN KEY (`idplayer`) REFERENCES `players` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_players_has_transfers_transfers1` FOREIGN KEY (`idtransfer`,`idteam_out`,`idteam_entry`) REFERENCES `transfers` (`id`, `idteam_out`, `idteam_entry`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `stadiums`
--
ALTER TABLE `stadiums`
  ADD CONSTRAINT `fk_stadiums_countries1` FOREIGN KEY (`idcountry`) REFERENCES `countries` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `teams`
--
ALTER TABLE `teams`
  ADD CONSTRAINT `fk_clubs_countries1` FOREIGN KEY (`idcountry`) REFERENCES `countries` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_teams_stadiums1` FOREIGN KEY (`idstadium`) REFERENCES `stadiums` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `teams_competitions`
--
ALTER TABLE `teams_competitions`
  ADD CONSTRAINT `fk_clubs_has_competitions_clubs1` FOREIGN KEY (`idteam`) REFERENCES `teams` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_clubs_has_competitions_competitions1` FOREIGN KEY (`idcompetition`) REFERENCES `competitions` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `teams_statistics`
--
ALTER TABLE `teams_statistics`
  ADD CONSTRAINT `fk_teams_has_matchs_results_matchs_results1` FOREIGN KEY (`idmatch_result`,`idgame_clashe`,`idcompetition`,`idteam_home`,`idteam_away`) REFERENCES `matchs_results` (`id`, `idgame_clashe`, `idcompetition`, `idteam_home`, `idteam_away`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `transfers`
--
ALTER TABLE `transfers`
  ADD CONSTRAINT `fk_transfers_clubs1` FOREIGN KEY (`idteam_entry`) REFERENCES `teams` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_transfers_teams1` FOREIGN KEY (`idteam_out`) REFERENCES `teams` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
