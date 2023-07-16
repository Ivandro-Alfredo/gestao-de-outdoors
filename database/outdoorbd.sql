-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 13-Jul-2023 às 00:24
-- Versão do servidor: 10.4.11-MariaDB
-- versão do PHP: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `outdoorbd`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `cliente`
--

CREATE TABLE `cliente` (
  `idcliente` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `username` varchar(45) NOT NULL,
  `email` varchar(60) NOT NULL,
  `tipoCliente` varchar(45) NOT NULL,
  `atividade` varchar(65) NOT NULL,
  `phone` varchar(14) NOT NULL,
  `morada` varchar(45) NOT NULL,
  `password` varchar(255) NOT NULL,
  `provincia` varchar(45) NOT NULL,
  `municipio` varchar(45) NOT NULL,
  `comuna` varchar(45) NOT NULL,
  `nacionalidade` varchar(45) NOT NULL,
  `categoria` varchar(45) NOT NULL,
  `estado` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `cliente`
--

INSERT INTO `cliente` (`idcliente`, `nome`, `username`, `email`, `tipoCliente`, `atividade`, `phone`, `morada`, `password`, `provincia`, `municipio`, `comuna`, `nacionalidade`, `categoria`, `estado`) VALUES
(1, 'Fabio Portela', 'Naruto Uzumaki', 'ivandroalfredo@outlook.com', 'Particular', '---', '945364732', 'Rocha Pinto', '$2y$10$ys8WdOuGkE1hcoX3boUf1uqCcjLHXFawDMZdckgHnFeqdq9bxT0Wm', 'Bie', 'Andulo', 'Calucinga', 'angolana', 'cliente', 'ativo');

-- --------------------------------------------------------

--
-- Estrutura da tabela `comprovativo`
--

CREATE TABLE `comprovativo` (
  `idcomprovativo` int(11) NOT NULL,
  `idaluguel` int(11) NOT NULL,
  `data` date NOT NULL,
  `comprovativo` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `comuna`
--

CREATE TABLE `comuna` (
  `idcomuna` int(11) NOT NULL,
  `idmunicipio` int(11) NOT NULL,
  `comuna` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `comuna`
--

INSERT INTO `comuna` (`idcomuna`, `idmunicipio`, `comuna`) VALUES
(1, 1, 'Ambriz'),
(2, 1, 'Bela Vista'),
(3, 1, 'Tabi'),
(4, 2, 'Bula-Atumba '),
(5, 2, 'Quiage'),
(6, 3, 'Barra do Dande'),
(7, 3, 'Caxito'),
(8, 3, 'Mabubas'),
(9, 3, 'Quicabo'),
(10, 3, 'Úcua'),
(11, 4, 'Paredes'),
(12, 4, 'Piri'),
(13, 4, 'Quibaxe'),
(14, 4, 'São José das Matas'),
(15, 5, 'Cage'),
(16, 5, 'Canacassala'),
(17, 5, 'Gombe'),
(18, 5, 'Muxaluando'),
(19, 5, 'Quicunzo'),
(20, 5, 'Quixico'),
(21, 5, 'Zala'),
(22, 6, 'Cazuangongo'),
(23, 6, 'Pango Aluquém'),
(24, 7, 'Andulo'),
(25, 7, 'Calucinga'),
(26, 7, 'Cassumbe'),
(27, 7, 'Chivaúlo'),
(28, 8, 'Camacupa'),
(29, 8, 'Cuanza'),
(30, 8, 'Ringoma'),
(31, 8, 'Santo António de Muinha'),
(32, 8, 'Umpulo'),
(33, 9, 'Catabola'),
(34, 9, 'Caivera'),
(35, 9, 'Chipeta'),
(36, 9, 'Chiuca'),
(37, 9, 'Sande'),
(38, 10, 'Chinguar'),
(39, 10, 'Cutato'),
(40, 10, 'Kangote'),
(41, 11, 'Chitembo'),
(42, 11, 'Cachingues'),
(43, 11, 'Malengue'),
(44, 11, 'Mutambo'),
(45, 11, 'Mumbué'),
(46, 11, 'Soma Cuanza'),
(47, 12, 'Cuemba'),
(48, 12, 'Luando'),
(49, 12, 'Munhango'),
(50, 12, 'Sachinemuna'),
(51, 13, 'Cuito'),
(52, 13, 'Chicala'),
(53, 13, 'Kambândua'),
(54, 13, 'Kunje'),
(55, 13, 'Trumba'),
(56, 14, 'Cunhinga'),
(57, 14, 'Belo Horizonte'),
(58, 15, 'Nharea'),
(59, 15, 'Gamba'),
(60, 15, 'Dando'),
(61, 15, 'Lúbia'),
(62, 15, 'Caieie'),
(63, 16, 'Balombo'),
(64, 16, 'Chindumbo'),
(65, 16, 'Chingongo'),
(66, 16, 'Maka Mombolo'),
(67, 17, 'Baía Farta'),
(68, 17, 'Dombe Grande'),
(69, 17, 'Equimina'),
(70, 17, 'Kalohanga'),
(71, 18, 'Benguela'),
(72, 19, 'Bocoio'),
(73, 19, 'Monte Belo (Utue Wombua)'),
(74, 19, 'Chila'),
(75, 19, 'Cubal do Lumbo'),
(76, 19, 'Passe'),
(77, 20, 'Caimbambo'),
(78, 20, 'Canhamela'),
(79, 20, 'Catengue'),
(80, 20, 'Caiave'),
(81, 20, 'Wiyangombe'),
(82, 21, 'Biópio'),
(83, 21, 'Catumbela'),
(84, 21, 'Gama'),
(85, 21, 'Egito'),
(86, 22, 'Chorongói'),
(87, 22, 'Bolonguera'),
(88, 22, 'Camuíne'),
(89, 23, 'Cubal'),
(90, 23, 'Capupa'),
(91, 23, 'Imbala'),
(92, 23, 'Tumbulo'),
(93, 24, 'Ganda'),
(94, 24, 'Babaera'),
(95, 24, 'Casseque'),
(96, 24, 'Chikuma'),
(97, 24, 'Ebanga'),
(98, 25, 'Lobito'),
(99, 25, 'Culango'),
(100, 25, 'Canjala'),
(101, 26, 'Gabela'),
(102, 26, 'Assango'),
(103, 27, 'Cassongue'),
(104, 27, 'Atome'),
(105, 27, 'Dumbi'),
(106, 27, 'Pambagala'),
(107, 28, 'Waku Kungo'),
(108, 28, 'Quissanga Kungo'),
(109, 28, 'Sanga'),
(110, 29, 'Conda'),
(111, 29, 'Cunje'),
(112, 30, 'Ebo'),
(113, 30, 'Conde'),
(114, 30, 'Kassange'),
(115, 31, 'Calulo'),
(116, 31, 'Cabuta'),
(117, 31, 'Munenga'),
(118, 31, 'Quissongo'),
(119, 32, 'Mussende'),
(120, 32, 'Quienha'),
(121, 32, 'Quipaxe'),
(122, 33, 'Porto Amboim'),
(123, 33, 'Capolo'),
(124, 34, 'Quibala'),
(125, 34, 'Cariango'),
(126, 34, 'Dala Cachibo'),
(127, 34, 'Lonhe'),
(128, 35, 'Quilenda'),
(129, 35, 'Quirimbo'),
(130, 36, 'Seles'),
(131, 36, 'Amboiva'),
(132, 36, 'Botera'),
(133, 145, 'Sumbe'),
(134, 145, 'Gangula'),
(135, 145, 'Gungo'),
(136, 145, 'Kicombo'),
(137, 37, 'Ambaca'),
(138, 37, 'Bindo'),
(139, 37, 'Luinga'),
(140, 37, 'Maua'),
(141, 37, 'Tango'),
(142, 38, 'Bolongongo'),
(143, 38, 'Kiquiemba'),
(144, 38, 'Terreiro'),
(145, 39, 'Dondo'),
(146, 39, 'Dange-ia-Menha'),
(147, 39, 'Massangano'),
(148, 39, 'São Pedro da Quilemba'),
(149, 39, 'Zenza do Itombe'),
(150, 40, 'Golungo Alto'),
(151, 40, 'Cambondo'),
(152, 40, 'Cerca'),
(153, 40, 'Kiluange'),
(154, 41, 'Lucala'),
(155, 41, 'Kiangombe'),
(156, 42, 'Quiculungo'),
(157, 43, 'Samba Cajú'),
(158, 43, 'Samba Lucala'),
(159, 44, 'Bolongongo'),
(160, 44, 'Kiquiemba'),
(161, 44, 'Terreiro'),
(162, 45, 'Calai'),
(163, 45, 'Maúe'),
(164, 45, 'Mavengue'),
(165, 46, 'Cuangar'),
(166, 46, 'Bondo'),
(167, 46, 'Savate'),
(168, 47, 'Cuchi'),
(169, 47, 'Cutato'),
(170, 47, 'Chinguanja'),
(171, 47, 'Muila'),
(172, 48, 'Cuito Cuanavale'),
(173, 48, 'Baixo Longa'),
(174, 48, 'Longa'),
(175, 48, 'Lupire'),
(176, 49, 'Dirico'),
(177, 49, 'Mucusso'),
(178, 49, 'Xamavera'),
(179, 50, 'Mavinga'),
(180, 50, 'Cunjamba/Dime'),
(181, 50, 'Cutuile'),
(182, 50, 'Luenguee'),
(183, 51, 'Menongue'),
(184, 51, 'Caiundo'),
(185, 51, 'Cueio'),
(186, 52, 'Nancova'),
(187, 52, 'Rito'),
(188, 53, 'Rivungo'),
(189, 53, 'Chipundo/Neriquinha'),
(190, 53, 'Luiana'),
(291, 54, 'Belize'),
(292, 54, 'Luali'),
(293, 54, 'Miconje'),
(294, 55, 'Buco-Zau'),
(295, 55, 'Inhuca'),
(296, 55, 'Necuto'),
(297, 56, 'Cabinda'),
(298, 56, 'Malembo'),
(299, 56, 'Tanto-Zinze'),
(300, 57, 'Lândana'),
(301, 57, 'Dinge'),
(302, 57, 'Massabi'),
(303, 58, 'Cahama'),
(304, 58, 'Otchindjau'),
(305, 59, 'Ondjiva'),
(306, 59, 'Chimpolo'),
(307, 59, 'Evale'),
(308, 59, 'Môngua'),
(309, 59, 'Nehone'),
(310, 60, 'Oncócua'),
(311, 60, 'Chitado'),
(312, 61, 'Mukolongondjo'),
(313, 61, 'Kalonga'),
(314, 61, 'Kubati'),
(315, 61, 'Mupa'),
(316, 62, 'Namacunde'),
(317, 62, 'Shiede'),
(318, 63, 'Xangongo'),
(319, 63, 'Humbe'),
(320, 63, 'Mucope'),
(321, 63, 'Naulila'),
(322, 63, 'Ombala-yo-Mungo'),
(323, 64, 'Bailundo'),
(324, 64, 'Lunge'),
(325, 64, 'Luvemba'),
(326, 64, 'Bimbe'),
(327, 64, 'Hengue'),
(328, 65, 'Caála'),
(329, 65, 'Kalenga'),
(330, 65, 'Katata'),
(331, 65, 'Kuima'),
(332, 66, 'Ekunha'),
(333, 66, 'Tchipeio'),
(334, 67, 'Huambo'),
(335, 67, 'Chipipa'),
(336, 67, 'Terreiro'),
(337, 67, 'Kalima'),
(338, 68, 'Londuimbale'),
(339, 68, 'Alto Uama'),
(340, 68, 'Galanga'),
(341, 68, 'Kumbila'),
(342, 68, 'Kumbila'),
(343, 68, 'Ussoke'),
(344, 69, 'Longojo'),
(345, 69, 'Chilata'),
(346, 69, 'Katabola'),
(347, 69, 'Lepi'),
(348, 70, 'Mungo'),
(349, 70, 'Kambuengo'),
(350, 71, 'Tchicala-Tcholoanga'),
(351, 71, 'Mbave'),
(352, 71, 'Sambo'),
(353, 71, 'Samboto'),
(354, 72, 'Caconda'),
(355, 72, 'Cusse'),
(356, 72, 'Gungui'),
(357, 72, 'Uaba'),
(358, 73, 'Caluquembe'),
(359, 74, 'Chibia'),
(360, 74, 'Capunda'),
(361, 74, 'Cavilongo'),
(362, 74, 'Jau'),
(363, 74, 'Quihita'),
(364, 47, 'Chinguanja'),
(365, 47, 'Muila'),
(366, 75, 'Chicomba'),
(367, 75, 'Cutenda'),
(368, 75, 'Libongue'),
(369, 76, 'Chipindo'),
(370, 76, 'Bambi'),
(371, 77, 'Cuvango'),
(372, 77, 'Xamavera'),
(373, 77, 'Galangue'),
(374, 77, 'Vicungo'),
(375, 78, 'Matala'),
(376, 78, 'Capelongo'),
(377, 78, 'Mulongo'),
(378, 79, 'Humpata'),
(379, 80, 'Lubango'),
(380, 80, 'Arimba'),
(381, 80, 'Hoque'),
(382, 80, 'Huila'),
(383, 81, 'Quilengues'),
(384, 81, 'Dinde'),
(385, 81, 'Impulo'),
(386, 82, 'Quenguela'),
(387, 82, 'Morro dos Veados'),
(388, 82, 'Barra do Kwanza'),
(389, 82, 'Vila Verde'),
(390, 82, 'Ramiros'),
(391, 82, 'Cobolombo'),
(392, 82, 'Kilamba'),
(393, 83, 'Funda'),
(394, 83, 'Kikolo'),
(395, 83, 'Cacuaco'),
(396, 83, 'Mulenvos'),
(397, 83, 'Sequele'),
(398, 84, 'Cazenga'),
(399, 84, 'Hoji-ya-Henda'),
(400, 84, '11 de Novembro'),
(401, 84, 'Kima Kieza'),
(402, 84, 'Tala Hadi '),
(403, 84, 'T Kalawenda '),
(404, 85, ' Cassoneca'),
(405, 85, ' Cabiri'),
(406, 85, ' Bom Jesus'),
(407, 85, ' Caculo Cahango'),
(408, 85, ' Quiminha'),
(409, 85, ' Catete'),
(410, 85, ' Bela Vista'),
(411, 86, 'Golfe'),
(412, 86, 'Sapú'),
(413, 86, 'Palanca'),
(414, 86, 'Nova Vida'),
(415, 87, ' Sambizanga'),
(416, 87, 'Rangel'),
(417, 87, 'Maianga'),
(418, 87, 'Ingombota'),
(419, 87, 'Samba'),
(420, 87, 'Neves Bendinha'),
(421, 87, 'Ngola Kiluanje'),
(422, 88, 'Muxima'),
(423, 88, 'Demba Chio'),
(424, 88, 'Chixinge'),
(425, 88, 'Mumbondo'),
(426, 88, 'Cabo Ledo'),
(427, 89, 'Mussulo'),
(428, 89, 'Benfica'),
(429, 89, 'Futungo de Belas'),
(430, 89, 'Lar do Patriota'),
(431, 89, 'Talatona'),
(432, 89, ' Camama'),
(433, 89, ' Cidade Universitária'),
(434, 90, ' Calumbo'),
(435, 90, 'Viana'),
(436, 90, 'Estalagem'),
(437, 90, 'Baia'),
(438, 90, 'Kikuxi'),
(439, 90, 'Zango'),
(440, 90, 'Vila Flor'),
(441, 91, 'Camaxilo'),
(442, 92, 'Lauchimo'),
(443, 93, 'Cuango'),
(444, 93, 'Luremo'),
(445, 94, 'Cuílo'),
(446, 94, 'Caluango'),
(447, 95, 'Lubalo'),
(448, 95, 'Luangue'),
(449, 95, 'Muruleje'),
(450, 96, 'Lucapa'),
(451, 96, 'Camissombo'),
(452, 96, 'Capaia'),
(453, 96, 'Xá-Cassau'),
(454, 151, 'Cambulo'),
(455, 151, 'Cachimo'),
(456, 151, 'Canzar'),
(457, 151, 'Luia'),
(458, 152, 'Capenda-Camulemba'),
(459, 152, 'Xinge'),
(460, 153, 'Lóvua'),
(461, 154, 'Xá-Muteba'),
(462, 154, 'Cassangue-Calocala'),
(463, 152, 'Longo'),
(464, 97, 'Cacolo'),
(465, 97, 'Alto Chicapa'),
(466, 97, 'Cucumbi'),
(467, 97, 'Xassengue'),
(468, 98, 'Dala'),
(469, 98, 'Cazage'),
(470, 98, 'Luma-Cassai'),
(471, 99, 'Muconda'),
(472, 99, 'Cassai-Sul'),
(473, 99, 'Chiluange'),
(474, 99, 'Murieje'),
(475, 100, 'Saurimo'),
(476, 100, 'Mona-Quimbundo'),
(477, 100, 'Sombo'),
(478, 101, 'Calandula'),
(479, 101, 'Cota'),
(480, 101, 'Kinge'),
(481, 101, 'Kateco-Kangola'),
(482, 101, 'Kuale'),
(483, 102, 'Cangandala'),
(484, 102, 'Caribo'),
(485, 102, 'Culamagia'),
(486, 102, 'Mbembo'),
(487, 103, 'Cacuso'),
(488, 103, 'Lombe'),
(489, 103, 'Pungo-Andongo'),
(490, 103, 'Quizenga'),
(491, 104, 'Cabundi-Catembo'),
(492, 104, 'Dumba Cabango'),
(493, 104, 'Kitape'),
(494, 104, 'Tala-Mungongo'),
(495, 105, 'Cuaba Nzogo'),
(496, 105, 'Mufuma'),
(497, 106, 'Luquembo'),
(498, 106, 'Dombo'),
(499, 106, 'Capunda'),
(500, 106, 'Quimbango'),
(501, 106, 'Ringa'),
(502, 107, 'Malanje'),
(503, 107, 'Cambaxe'),
(504, 107, 'Cambondo'),
(505, 107, 'Cangando'),
(506, 107, 'Ngola-Luíje'),
(507, 107, 'Quimbamba'),
(508, 108, 'Marimba'),
(509, 108, 'Dala Samba'),
(510, 108, 'Tembo-Aluma'),
(511, 109, 'Massango'),
(512, 109, 'Quihuhu'),
(513, 109, 'Quinguengue'),
(514, 110, 'Mucari (Caculama)'),
(515, 110, 'Catala'),
(516, 110, 'Caxinga'),
(517, 110, 'Muquixi'),
(518, 111, 'Quela'),
(519, 111, 'Missão dos Bangalas'),
(520, 111, 'Moma'),
(521, 111, 'Xandele'),
(522, 112, 'Quirima'),
(523, 112, 'Sautar'),
(524, 113, 'Cazombo'),
(525, 113, 'Caianda'),
(526, 113, 'Calunda'),
(527, 113, 'Kaquengue'),
(528, 113, 'Kavungo'),
(529, 113, 'Lóvua'),
(530, 113, 'Macondo'),
(531, 114, 'Chiume'),
(532, 114, 'Lumbala Nguimbo'),
(533, 114, 'Lutembo'),
(534, 114, 'Luvuei'),
(535, 114, 'Mussuma'),
(536, 114, 'Ninda'),
(537, 114, 'Sessa'),
(538, 115, 'Camongue'),
(539, 116, 'Cameia'),
(540, 117, 'Luacano'),
(541, 117, 'Lago-Dilolo'),
(542, 118, 'Luchazes'),
(543, 118, 'Camgombo'),
(544, 118, 'Cassamba'),
(545, 118, 'Muié'),
(546, 118, 'Tempue'),
(547, 119, 'Luena'),
(548, 119, 'Cangumbe/Kachipoque'),
(549, 119, 'Lucusse'),
(550, 119, 'Lutuai (muangai)'),
(551, 120, 'Léua'),
(552, 120, 'Liangongo (Sandando)'),
(553, 121, 'Bibala'),
(554, 121, 'Caitou'),
(555, 121, 'Lola'),
(556, 121, 'Kapagombe'),
(557, 122, 'Camacuio'),
(558, 122, 'Chingo'),
(559, 122, 'Chinquite'),
(560, 123, 'Moçâmedes'),
(561, 124, 'Namibe'),
(562, 124, 'Lucira'),
(563, 124, 'Bentiaba'),
(564, 125, 'Tômbua'),
(565, 125, 'Baía dos Tigres'),
(566, 126, 'Virei'),
(567, 126, 'Cainde'),
(568, 127, 'Ambuíla'),
(569, 127, 'Quipedro'),
(570, 128, 'Bumbe'),
(571, 128, 'Lucanga'),
(572, 128, 'Mabaia'),
(573, 129, 'Cuilo Cambozo'),
(574, 129, 'Nova Esperança'),
(575, 129, 'Quimbianda'),
(576, 130, 'Bungo'),
(577, 131, 'Damba'),
(578, 131, 'Camatambo'),
(579, 131, 'Lemboa'),
(580, 131, 'Lombe'),
(581, 131, 'Pete Cusso'),
(582, 132, 'Maquela do Zombo'),
(583, 132, 'Béu'),
(584, 132, 'Cuilo Futa'),
(585, 132, 'Quibocolo'),
(586, 132, 'Sacandica'),
(587, 133, 'Uando'),
(588, 133, 'Quinzala'),
(589, 134, 'Negaje'),
(590, 134, 'Dimuca'),
(591, 134, 'Quisseque'),
(592, 135, 'Puri'),
(593, 136, 'Qumbele'),
(594, 136, 'Alto-Zaza'),
(595, 136, 'Cuango'),
(596, 136, 'Icoca'),
(597, 137, 'Sanza Pombo'),
(598, 137, 'Alfândega'),
(599, 137, 'Cuilo Pombo'),
(600, 137, 'Wamba'),
(601, 138, 'Songo'),
(602, 138, 'Kinvuenga'),
(603, 155, 'Uíge'),
(604, 139, 'Cuimba'),
(605, 139, 'Buela'),
(606, 139, 'Kanda'),
(607, 139, 'Luvaca'),
(608, 140, 'MBanza Congo'),
(609, 140, 'Kalambata'),
(610, 140, 'Kaluka'),
(611, 140, 'Kiende'),
(612, 140, 'Luvo'),
(613, 140, 'Madimba'),
(614, 141, 'Nzeto'),
(615, 141, 'Kindenje'),
(616, 141, 'Musserra'),
(617, 141, 'Quibala Norte'),
(618, 142, 'Nóqui'),
(619, 142, 'Lufico'),
(620, 142, 'Lulendo '),
(621, 143, 'Soyo'),
(622, 143, 'Mangue Grande'),
(623, 143, 'Pedra de Feitiço'),
(624, 143, 'Quêlo'),
(625, 143, 'Sumba'),
(626, 144, 'Tomboco'),
(627, 144, 'Kiximba'),
(628, 144, 'Kinzau');

-- --------------------------------------------------------

--
-- Estrutura da tabela `gestor`
--

CREATE TABLE `gestor` (
  `idgestor` int(11) NOT NULL,
  `nome` varchar(45) NOT NULL,
  `username` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `telefone` varchar(13) NOT NULL,
  `morada` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `provincia` varchar(45) NOT NULL,
  `municipio` varchar(45) NOT NULL,
  `comuna` varchar(45) NOT NULL,
  `nacionalidade` varchar(45) NOT NULL,
  `categoria` varchar(45) NOT NULL,
  `estado` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `gestor`
--

INSERT INTO `gestor` (`idgestor`, `nome`, `username`, `email`, `telefone`, `morada`, `password`, `provincia`, `municipio`, `comuna`, `nacionalidade`, `categoria`, `estado`) VALUES
(1, 'Alfredo Calunga', 'Alfredo', 'ivandroalfredo10@gmail.com', '946689793', 'Belas', '$2y$10$pZGtPd0/9XepOOAsIEPiEOoXZSoafKzPCjXaRX', 'Luanda', 'Talatona', 'Talatona', 'angola', 'gestor', 'ativo');

-- --------------------------------------------------------

--
-- Estrutura da tabela `login`
--

CREATE TABLE `login` (
  `idutilizador` int(11) NOT NULL,
  `nome` varchar(45) NOT NULL,
  `username` varchar(45) NOT NULL,
  `email` varchar(60) NOT NULL,
  `password` varchar(255) NOT NULL,
  `categoria` varchar(60) NOT NULL,
  `estado` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `login`
--

INSERT INTO `login` (`idutilizador`, `nome`, `username`, `email`, `password`, `categoria`, `estado`) VALUES
(1, 'Ivando', 'Ivy', 'ivandroalfredo14@gmail.com', '$2y$10$rfXepYhPx3ytMmwYSXpJn.HvX.VcbA/gG1.TDnvWys5zs2bOqctsC', 'administrador', 'ativo'),
(2, 'Alfredo Calunga', 'Alfredo', 'ivandroalfredo10@gmail.com', '$2y$10$pZGtPd0/9XepOOAsIEPiEOoXZSoafKzPCjXaRXzdnz7m3bEYbyB.O', 'gestor', 'ativo'),
(6, 'Fabio Portela', 'Naruto Uzumaki', 'ivandroalfredo@outlook.com', '$2y$10$ys8WdOuGkE1hcoX3boUf1uqCcjLHXFawDMZdckgHnFeqdq9bxT0Wm', 'cliente', 'ativo');

-- --------------------------------------------------------

--
-- Estrutura da tabela `municipio`
--

CREATE TABLE `municipio` (
  `idmunicipio` int(11) NOT NULL,
  `idprovincia` int(11) NOT NULL,
  `municipio` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `municipio`
--

INSERT INTO `municipio` (`idmunicipio`, `idprovincia`, `municipio`) VALUES
(1, 1, 'Ambriz'),
(2, 1, 'Bula Atumba'),
(3, 1, 'Dande'),
(4, 1, 'Dembos'),
(5, 1, 'Nambuangongo'),
(6, 1, 'Pango Aluquém'),
(7, 2, 'Andulo'),
(8, 2, 'Camacupa'),
(9, 2, 'Catabola'),
(10, 2, 'Chinguar'),
(11, 2, 'Chitembo'),
(12, 2, 'Cuemba'),
(13, 2, 'Cuito'),
(14, 2, 'Cunhinga'),
(15, 2, 'Nharea'),
(16, 3, 'Balombo'),
(17, 3, 'Baía Farta'),
(18, 3, 'Benguela'),
(19, 3, 'Bocoio'),
(20, 3, 'Caimbambo'),
(21, 3, 'Catumbela'),
(22, 3, 'Chongoroi'),
(23, 3, 'Cubal'),
(24, 3, 'Ganda'),
(25, 3, 'Lobito'),
(26, 4, 'Amboim'),
(27, 4, 'Cassongue'),
(28, 4, 'Cela'),
(29, 4, 'Conda'),
(30, 4, 'Ebo'),
(31, 4, 'Libolo'),
(32, 4, 'Mussende'),
(33, 4, 'Porto Amboim'),
(34, 4, 'Quibala'),
(35, 4, 'Quilenda'),
(36, 4, 'Seles'),
(37, 5, 'Ambaca'),
(38, 5, 'Bolongongo'),
(39, 5, 'Dondo'),
(40, 5, 'Golungo Alto'),
(41, 5, 'Lucala'),
(42, 5, 'Quiculungo'),
(43, 5, 'Samba Cajú'),
(44, 5, 'Bolongongo '),
(45, 6, 'Calai'),
(46, 6, 'Cuangar'),
(47, 6, 'Cuchi'),
(48, 6, 'Cuito Cuanavale'),
(49, 6, 'Dirico'),
(50, 6, 'Mavinga'),
(51, 6, 'Menongue'),
(52, 6, 'Nancova'),
(53, 6, 'Rivungo'),
(54, 7, 'Belize'),
(55, 7, 'Buco-Zau'),
(56, 7, 'Cabinda'),
(57, 7, 'Cacongo'),
(58, 8, 'Cahama'),
(59, 8, 'Cuanhama'),
(60, 8, 'Curoca'),
(61, 8, 'Cuvelai'),
(62, 8, 'Namacunde'),
(63, 8, 'Ombadja'),
(64, 9, 'Bailundo'),
(65, 9, 'Caála'),
(66, 9, 'Ekunha'),
(67, 9, 'Huambo'),
(68, 9, 'Londuimbali'),
(69, 9, 'Longonjo'),
(70, 9, 'Mungo'),
(71, 9, 'Tchicala Tcholoanga'),
(72, 10, 'Caconda'),
(73, 10, 'Caluquembe'),
(74, 10, 'Chibia'),
(75, 10, 'Chicomba'),
(76, 10, 'Chipindo'),
(77, 10, 'Cuvango'),
(78, 10, 'Matala'),
(79, 10, 'Humpata'),
(80, 10, 'Lubango'),
(81, 10, 'Quilengues'),
(82, 11, 'Belas'),
(83, 11, 'Cacuaco'),
(84, 11, 'Cazenga'),
(85, 11, 'Icolo e Bengo'),
(86, 11, 'Kilamba Kiaxi'),
(87, 11, 'Luanda'),
(88, 11, 'Quiçama'),
(89, 11, 'Talatona'),
(90, 11, 'Viana'),
(91, 12, 'Caungula'),
(92, 12, 'Chitato'),
(93, 12, 'Cuango'),
(94, 12, 'Cuílo'),
(95, 12, 'Lubalo'),
(96, 12, 'Lucapa'),
(97, 13, 'Cacolo'),
(98, 13, 'Dala'),
(99, 13, 'Muconda'),
(100, 13, 'Saurimo'),
(101, 14, 'Calandula'),
(102, 14, 'Cangandala'),
(103, 14, 'Cacuso'),
(104, 14, 'Cambundi Catembo'),
(105, 14, 'Cuaba Nzogo'),
(106, 14, 'Luquembo'),
(107, 14, 'Malanje'),
(108, 14, 'Marimba'),
(109, 14, 'Massango'),
(110, 14, 'Mucari'),
(111, 14, 'Quela'),
(112, 14, 'Quirima'),
(113, 15, 'Alto Zambeze'),
(114, 15, 'Bundas'),
(115, 15, 'Camanongue'),
(116, 15, 'Cameia'),
(117, 15, 'Luacano'),
(118, 15, 'Luchazes'),
(119, 15, 'Luena'),
(120, 15, 'Léua'),
(121, 16, 'Bibala'),
(122, 16, 'Camucuio'),
(123, 16, 'Moçâmedes'),
(124, 16, 'Namibe'),
(125, 16, 'Tômbua'),
(126, 16, 'Virei'),
(127, 17, 'Ambuila'),
(128, 17, 'Bumbe'),
(129, 17, 'Buengas'),
(130, 17, 'Bungo'),
(131, 17, 'Damba'),
(132, 17, 'Maquela do Zombo'),
(133, 17, 'Mucaba'),
(134, 17, 'Negaje'),
(135, 17, 'Puri'),
(136, 17, 'Quimbele'),
(137, 17, 'Sanza Pombo'),
(138, 17, 'Songo'),
(139, 18, 'Cuimba'),
(140, 18, 'M\'banza-Kongo'),
(141, 18, 'N\'zeto'),
(142, 18, 'Noqui'),
(143, 18, 'Soyo'),
(144, 18, 'Tomboco'),
(145, 4, 'Sumbe'),
(151, 12, 'Cambulo'),
(152, 12, 'Capenda-Camulemba '),
(153, 12, 'Lóvua'),
(154, 12, 'Xá-Muteba'),
(155, 17, 'Uíge');

-- --------------------------------------------------------

--
-- Estrutura da tabela `outdoor`
--

CREATE TABLE `outdoor` (
  `idoutdoor` int(11) NOT NULL,
  `tipo` varchar(45) NOT NULL,
  `preco` double NOT NULL,
  `provincia` varchar(45) NOT NULL,
  `municipio` varchar(45) NOT NULL,
  `comuna` varchar(45) NOT NULL,
  `estado` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `outdoor`
--

INSERT INTO `outdoor` (`idoutdoor`, `tipo`, `preco`, `provincia`, `municipio`, `comuna`, `estado`) VALUES
(2, 'Paines Não Luminosos', 6500, 'Benguela', 'Benguela', 'Benguela', 'disponivel'),
(4, 'Faixadas', 8000, 'Luanda', 'Belas', 'Ramiros', 'disponivel'),
(9, 'Placas Indicativas', 2500, 'Huambo', 'Huambo', 'Huambo', 'disponivel');

-- --------------------------------------------------------

--
-- Estrutura da tabela `provincia`
--

CREATE TABLE `provincia` (
  `idprovincia` int(11) NOT NULL,
  `provincia` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `provincia`
--

INSERT INTO `provincia` (`idprovincia`, `provincia`) VALUES
(1, 'Bengo'),
(2, 'Bie'),
(3, 'Benguela'),
(4, 'C. Sul'),
(5, 'C. Norte'),
(6, 'Cuando Cubango'),
(7, 'Cabinda'),
(8, 'Cunene'),
(9, 'Huambo'),
(10, 'Huíla'),
(11, 'Luanda'),
(12, 'Lunda Norte'),
(13, 'Lunda Sul'),
(14, 'Malanje'),
(15, 'Moxico'),
(16, 'Namibe'),
(17, 'Uíge'),
(18, 'Zaire');

-- --------------------------------------------------------

--
-- Estrutura da tabela `solicitacaoaluguel`
--

CREATE TABLE `solicitacaoaluguel` (
  `idaluguel` int(11) NOT NULL,
  `idcliente` int(11) NOT NULL,
  `idoutdoor` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `total` double NOT NULL,
  `provincia` varchar(60) NOT NULL,
  `municipio` varchar(60) NOT NULL,
  `comuna` varchar(60) NOT NULL,
  `dataInicio` date NOT NULL,
  `dataFim` date NOT NULL,
  `imagem` varchar(66) NOT NULL,
  `estado` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`idcliente`);

--
-- Índices para tabela `comprovativo`
--
ALTER TABLE `comprovativo`
  ADD PRIMARY KEY (`idcomprovativo`),
  ADD KEY `idaluguel` (`idaluguel`);

--
-- Índices para tabela `comuna`
--
ALTER TABLE `comuna`
  ADD PRIMARY KEY (`idcomuna`),
  ADD KEY `idmunicipio` (`idmunicipio`);

--
-- Índices para tabela `gestor`
--
ALTER TABLE `gestor`
  ADD PRIMARY KEY (`idgestor`);

--
-- Índices para tabela `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`idutilizador`);

--
-- Índices para tabela `municipio`
--
ALTER TABLE `municipio`
  ADD PRIMARY KEY (`idmunicipio`),
  ADD KEY `idprovincia` (`idprovincia`);

--
-- Índices para tabela `outdoor`
--
ALTER TABLE `outdoor`
  ADD PRIMARY KEY (`idoutdoor`),
  ADD UNIQUE KEY `idOutdoor_UNIQUE` (`idoutdoor`);

--
-- Índices para tabela `provincia`
--
ALTER TABLE `provincia`
  ADD PRIMARY KEY (`idprovincia`);

--
-- Índices para tabela `solicitacaoaluguel`
--
ALTER TABLE `solicitacaoaluguel`
  ADD PRIMARY KEY (`idaluguel`),
  ADD KEY `idoutdoor` (`idoutdoor`),
  ADD KEY `idcliente` (`idcliente`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `cliente`
--
ALTER TABLE `cliente`
  MODIFY `idcliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de tabela `comprovativo`
--
ALTER TABLE `comprovativo`
  MODIFY `idcomprovativo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT de tabela `comuna`
--
ALTER TABLE `comuna`
  MODIFY `idcomuna` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=629;

--
-- AUTO_INCREMENT de tabela `gestor`
--
ALTER TABLE `gestor`
  MODIFY `idgestor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `login`
--
ALTER TABLE `login`
  MODIFY `idutilizador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `municipio`
--
ALTER TABLE `municipio`
  MODIFY `idmunicipio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=156;

--
-- AUTO_INCREMENT de tabela `outdoor`
--
ALTER TABLE `outdoor`
  MODIFY `idoutdoor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `provincia`
--
ALTER TABLE `provincia`
  MODIFY `idprovincia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de tabela `solicitacaoaluguel`
--
ALTER TABLE `solicitacaoaluguel`
  MODIFY `idaluguel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `comprovativo`
--
ALTER TABLE `comprovativo`
  ADD CONSTRAINT `comprovativo_ibfk_1` FOREIGN KEY (`idaluguel`) REFERENCES `solicitacaoaluguel` (`idaluguel`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `comuna`
--
ALTER TABLE `comuna`
  ADD CONSTRAINT `comuna_ibfk_1` FOREIGN KEY (`idmunicipio`) REFERENCES `municipio` (`idmunicipio`);

--
-- Limitadores para a tabela `municipio`
--
ALTER TABLE `municipio`
  ADD CONSTRAINT `municipio_ibfk_1` FOREIGN KEY (`idprovincia`) REFERENCES `provincia` (`idprovincia`);

--
-- Limitadores para a tabela `solicitacaoaluguel`
--
ALTER TABLE `solicitacaoaluguel`
  ADD CONSTRAINT `solicitacaoaluguel_ibfk_1` FOREIGN KEY (`idoutdoor`) REFERENCES `outdoor` (`idoutdoor`) ON DELETE CASCADE,
  ADD CONSTRAINT `solicitacaoaluguel_ibfk_2` FOREIGN KEY (`idcliente`) REFERENCES `cliente` (`idcliente`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
