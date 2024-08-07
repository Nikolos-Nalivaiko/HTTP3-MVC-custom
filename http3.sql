-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Час створення: Лип 24 2024 р., 20:18
-- Версія сервера: 10.4.32-MariaDB
-- Версія PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База даних: `http3`
--

-- --------------------------------------------------------

--
-- Структура таблиці `bodies`
--

CREATE TABLE `bodies` (
  `body_id` int(11) NOT NULL,
  `body_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Дамп даних таблиці `bodies`
--

INSERT INTO `bodies` (`body_id`, `body_name`) VALUES
(1, 'Автовоз'),
(2, 'Борт'),
(3, 'Фургон'),
(4, 'Кунг'),
(5, 'Зерновоз'),
(6, 'Кормовоз'),
(7, 'Металовоз'),
(8, 'Платформа'),
(9, 'Рибовоз'),
(10, 'Скловоз'),
(11, 'Тягач'),
(12, 'Цистерна'),
(13, 'Бензовоз'),
(14, 'Контейнеровоз'),
(15, 'Лісовоз'),
(16, 'Мультиліфт'),
(17, 'Рефрижератор'),
(18, 'Самоскид'),
(19, 'Тентований'),
(20, 'Хлібовоз'),
(21, 'Шасі'),
(22, 'Інше');

-- --------------------------------------------------------

--
-- Структура таблиці `brands`
--

CREATE TABLE `brands` (
  `brand_id` int(11) NOT NULL,
  `brand_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Дамп даних таблиці `brands`
--

INSERT INTO `brands` (`brand_id`, `brand_name`) VALUES
(1, 'BAW'),
(2, 'Citroen'),
(3, 'DAF'),
(4, 'Dodge'),
(5, 'FAW'),
(6, 'Fiat'),
(7, 'Ford'),
(8, 'Foton'),
(9, 'Freightliner'),
(10, 'GMC'),
(11, 'Hyundai'),
(12, 'International'),
(13, 'Isuzu'),
(14, 'Iveco'),
(15, 'JAC'),
(16, 'Mack'),
(17, 'MAN'),
(18, 'Mercedes-Benz'),
(19, 'Mitsubishi'),
(20, 'Nissan'),
(21, 'Peterbilt'),
(22, 'Peugeot'),
(23, 'Renault'),
(24, 'Scania'),
(25, 'TATA'),
(26, 'Tatra'),
(27, 'Toyota'),
(28, 'Volkswagen'),
(29, 'Volvo'),
(30, 'ГАЗ'),
(31, 'ЗИЛ'),
(32, 'КамАЗ'),
(33, 'КрАЗ'),
(34, 'МАЗ'),
(35, 'УАЗ'),
(36, 'Урал'),
(37, 'Opel');

-- --------------------------------------------------------

--
-- Структура таблиці `cargos`
--

CREATE TABLE `cargos` (
  `cargo_id` int(11) NOT NULL,
  `cargo_name` varchar(255) NOT NULL,
  `weight` int(11) NOT NULL,
  `load_region` varchar(255) NOT NULL,
  `load_city` varchar(255) NOT NULL,
  `unload_region` varchar(255) NOT NULL,
  `unload_city` varchar(255) NOT NULL,
  `load_date` date DEFAULT NULL,
  `unload_date` date DEFAULT NULL,
  `body` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `pay_method` varchar(255) NOT NULL,
  `distance` int(11) NOT NULL,
  `description` text DEFAULT NULL,
  `urgent` varchar(10) NOT NULL,
  `qr_cargo` varchar(255) DEFAULT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Структура таблиці `cars`
--

CREATE TABLE `cars` (
  `car_id` int(11) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `model` varchar(255) NOT NULL,
  `engine_capacity` float NOT NULL,
  `wheel_mode` varchar(255) NOT NULL,
  `power` int(11) NOT NULL,
  `gearbox` varchar(255) NOT NULL,
  `body` varchar(255) NOT NULL,
  `engine_type` varchar(255) NOT NULL,
  `load_capacity` float NOT NULL,
  `price` int(11) NOT NULL,
  `region` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `year` int(11) NOT NULL,
  `mileage` int(11) NOT NULL,
  `description` text DEFAULT NULL,
  `qr_car` varchar(255) DEFAULT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Структура таблиці `car_images`
--

CREATE TABLE `car_images` (
  `image_id` int(11) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `preview` varchar(255) NOT NULL DEFAULT 'No',
  `car_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Структура таблиці `cities`
--

CREATE TABLE `cities` (
  `city_id` int(11) NOT NULL,
  `city_name` varchar(255) NOT NULL,
  `region_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Дамп даних таблиці `cities`
--

INSERT INTO `cities` (`city_id`, `city_name`, `region_id`) VALUES
(1, 'Одеса', 1),
(2, 'Ананьєв', 1),
(3, 'Арциз', 1),
(4, 'Балта', 1),
(5, 'Білгород-Дністровський', 1),
(6, 'Біляївка', 1),
(7, 'Березівка', 1),
(8, 'Болград', 1),
(9, 'Вилкове', 1),
(10, 'Ізмаїл', 1),
(11, 'Кілія', 1),
(12, 'Кодима', 1),
(13, 'Подільськ', 1),
(14, 'Роздільна', 1),
(15, 'Рені', 1),
(16, 'Татарбунари', 1),
(17, 'Теплодар', 1),
(18, 'Чорноморськ', 1),
(19, 'Південне', 1),
(20, 'Апостолове', 2),
(21, 'Верхньодніпровськ', 2),
(22, 'Верховцеве', 2),
(23, 'Вільногірськ', 2),
(24, 'Дніпро', 2),
(25, 'Жовті Води', 2),
(26, 'Зеленодольськ', 2),
(27, 'Кам\'янське', 2),
(28, 'Кривий Ріг', 2),
(29, 'Марганець', 2),
(30, 'Нікополь', 2),
(31, 'Новомосковськ', 2),
(32, 'Павлоград', 2),
(33, 'Перещепине', 2),
(34, 'Першотравенськ', 2),
(35, 'Покров', 2),
(36, 'Підгородне', 2),
(37, 'П\'ятихатки', 2),
(38, 'Синельникове', 2),
(39, 'Тернівка', 2),
(40, 'Чернігів', 3),
(41, 'Батурін', 3),
(42, 'Бахмач', 3),
(43, 'Бобровиця', 3),
(44, 'Борзна', 3),
(45, 'Городня', 3),
(46, 'Ічня', 3),
(47, 'Корюківка', 3),
(48, 'Мена', 3),
(49, 'Ніжин', 3),
(50, 'Новгород-Сіверський', 3),
(51, 'Носівка', 3),
(52, 'Остер', 3),
(53, 'Прилуки', 3),
(54, 'Семенівка', 3),
(55, 'Сновськ', 3),
(56, 'Харків', 4),
(57, 'Балаклія', 4),
(58, 'Барвінкове', 4),
(59, 'Богодухів', 4),
(60, 'Валки', 4),
(61, 'Вовчанськ', 4),
(62, 'Дергачі', 4),
(63, 'Зміїв', 4),
(64, 'Родзинки', 4),
(65, 'Красноград', 4),
(66, 'Куп\'янськ', 4),
(67, 'Лозова', 4),
(68, 'Люботин', 4),
(69, 'Мерефа', 4),
(70, 'Першотравневий', 4),
(71, 'Чугуїв', 4),
(72, 'Південний', 4),
(73, 'Житомир', 5),
(74, 'Андрушівка', 5),
(75, 'Баранівка', 5),
(76, 'Бердичів', 5),
(77, 'Коростень', 5),
(78, 'Коростишів', 5),
(79, 'Малін', 5),
(80, 'Новоград-Волинський', 5),
(81, 'Овруч', 5),
(82, 'Олевськ', 5),
(83, 'Радомишль', 5),
(84, 'Чуднів', 5),
(85, 'Полтава', 6),
(86, 'Гадяч', 6),
(87, 'Глобине', 6),
(88, 'Горішні Плавні', 6),
(89, 'Гребінка', 6),
(90, 'Заводське', 6),
(91, 'Зіньків', 6),
(92, 'Карлівка', 6),
(93, 'Кобеляки', 6),
(94, 'Кременчук', 6),
(95, 'Лохвиця', 6),
(96, 'Лубни', 6),
(97, 'Миргород', 6),
(98, 'Пирятин', 6),
(99, 'Хорол', 6),
(100, 'Шишаки', 6),
(101, 'Херсон', 7),
(102, 'Каховка', 7),
(103, 'Нова Каховка', 7),
(104, 'Гола Пристань', 7),
(105, 'Альошки', 7),
(106, 'Берислав', 7),
(107, 'Генічеськ', 7),
(108, 'Скадовськ', 7),
(109, 'Таврійськ', 7),
(110, 'Біла Церква', 8),
(111, 'Березань', 8),
(112, 'Богуслав', 8),
(113, 'Бориспіль', 8),
(114, 'Боярка', 8),
(115, 'Бровари', 8),
(116, 'Буча', 8),
(117, 'Васильків', 8),
(118, 'Вишневе', 8),
(119, 'Вишгород', 8),
(120, 'Ірпінь', 8),
(121, 'Кагарлик', 8),
(122, 'Миронівка', 8),
(123, 'Обухів', 8),
(124, 'Переяслав', 8),
(125, 'Ржищів', 8),
(126, 'Сквира', 8),
(127, 'Славутич', 8),
(128, 'Тараща', 8),
(129, 'Тетіїв', 8),
(130, 'Узин', 8),
(131, 'Українка', 8),
(132, 'Фастів', 8),
(133, 'Чорнобиль', 8),
(134, 'Яготин', 8),
(135, 'Запоріжжя', 9),
(136, 'Бердянськ', 9),
(137, 'Василівка', 9),
(138, 'Вільнянськ', 9),
(139, 'Гуляйполе', 9),
(140, 'Дніпрорудне', 9),
(141, 'Кам\'янка-Дніпровська', 9),
(142, 'Мелітополь', 9),
(143, 'Молочанськ', 9),
(144, 'Оріхів', 9),
(145, 'Пологи', 9),
(146, 'Приморськ', 9),
(147, 'Токмак', 9),
(148, 'Енергодар', 9),
(149, 'Олександрівськ', 10),
(150, 'Алмазна', 10),
(151, 'Алчевськ', 10),
(152, 'Антрацит', 10),
(153, 'Артемівськ', 10),
(154, 'Вахрушево', 10),
(155, 'Брянка', 10),
(156, 'Гірське', 10),
(157, 'Зимогір\'я', 10),
(158, 'Золоте', 10),
(159, 'Зоринськ', 10),
(160, 'Ірміно', 10),
(161, 'Кіровськ', 10),
(162, 'Краснодон', 10),
(163, 'Червоний луч', 10),
(164, 'Кремінна', 10),
(165, 'Лисичанськ', 10),
(166, 'Луганськ', 10),
(167, 'Лутугине', 10),
(168, 'Міусинськ', 10),
(169, 'Молодогвардійськ', 10),
(170, 'Новодружеськ', 10),
(171, 'Первомайськ', 10),
(172, 'Перевальськ', 10),
(173, 'Петрівське', 10),
(174, 'Попасна', 10),
(175, 'Привілля', 10),
(176, 'Ровеньки', 10),
(177, 'Рубіжне', 10),
(178, 'Сватове', 10),
(179, 'Свердловськ', 10),
(180, 'Сєвєродонецьк', 10),
(181, 'Старобільськ', 10),
(182, 'Стаханов', 10),
(183, 'Суходільськ', 10),
(184, 'Щастя', 10),
(185, 'Червонопартизанськ', 10),
(186, 'Донецьк', 11),
(187, 'Авдіївка', 11),
(188, 'Бахмут', 11),
(189, 'Вугледар', 11),
(190, 'Горлівка', 11),
(191, 'Дебальцеве', 11),
(192, 'Торецьк', 11),
(193, 'Мирноград', 11),
(194, 'Добропілля', 11),
(195, 'Докучаєвськ', 11),
(196, 'Дружківка', 11),
(197, 'Єнакієве', 11),
(198, 'Жданівка', 11),
(199, 'Кіровське', 11),
(200, 'Костянтинівка', 11),
(201, 'Краматорськ', 11),
(202, 'Красногорівка', 11),
(203, 'Лиман', 11),
(204, 'Покровськ', 11),
(205, 'Макіївка', 11),
(206, 'Маріуполь', 11),
(207, 'Новогродівка', 11),
(208, 'Селидове', 11),
(209, 'Слов\'янськ', 11),
(210, 'Сніжне', 11),
(211, 'Торез', 11),
(212, 'Харцизьк', 11),
(213, 'Шахтарськ', 11),
(214, 'Ясинувата', 11),
(215, 'Олександрівський район', 11),
(216, 'Амвросіївський район', 11),
(217, 'Бахмутський район', 11),
(218, 'Великоновосілківський район', 11),
(219, 'Волноваський район', 11),
(220, 'Добропільський район', 11),
(221, 'Костянтинівський район', 11),
(222, 'Мангуський район', 11),
(223, 'Мар\'їнський район', 11),
(224, 'Микільський район', 11),
(225, 'Новоазовський район', 11),
(226, 'Покровський район', 11),
(227, 'Слов\'янський район', 11),
(228, 'Старобешівський район', 11),
(229, 'Тельманівський район', 11),
(230, 'Шахтарський район', 11),
(231, 'Ясинуватський район', 11),
(232, 'Вінниця', 12),
(233, 'Бар', 12),
(234, 'Бершадь', 12),
(235, 'Гайсин', 12),
(236, 'Гнівань', 12),
(237, 'Жмеринка', 12),
(238, 'Іллінці', 12),
(239, 'Козятин', 12),
(240, 'Калинівка', 12),
(241, 'Ладижин', 12),
(242, 'Липовець', 12),
(243, 'Могилів-Подільський', 12),
(244, 'Немирів', 12),
(245, 'Погребище', 12),
(246, 'Тульчин', 12),
(247, 'Хмільник', 12),
(248, 'Шаргород', 12),
(249, 'Ямпіль', 12),
(250, 'Бахчисарайський район', 13),
(251, 'Білогірський район', 13),
(252, 'Джанкойський район', 13),
(253, 'Кіровський район', 13),
(254, 'Червоногвардійський район', 13),
(255, 'Красноперекопський район', 13),
(256, 'Ленінський район', 13),
(257, 'Нижньогірський район', 13),
(258, 'Першотравневий район', 13),
(259, 'Раздольненський район', 13),
(260, 'Сакський район', 13),
(261, 'Сімферопольський район', 13),
(262, 'радянський район', 13),
(263, 'Чорноморський район', 13),
(264, 'Алуштинська міськрада', 13),
(265, 'Вірменська міськрада', 13),
(266, 'Джанкойська міськрада', 13),
(267, 'Євпаторійська міськрада', 13),
(268, 'Керченська міськрада', 13),
(269, 'Красноперекопська міськрада', 13),
(270, 'Сакська міськрада', 13),
(271, 'Сімферопольська міськрада', 13),
(272, 'Судакська міськрада', 13),
(273, 'Феодосійська міськрада', 13),
(274, 'Ялтинська міськрада', 13),
(275, 'Кропивницький', 14),
(276, 'Олександрія', 14),
(277, 'Благовіщенське', 14),
(278, 'Бобринець', 14),
(279, 'Гайворон', 14),
(280, 'Долинська', 14),
(281, 'Знам\'янка', 14),
(282, 'Мала Виска', 14),
(283, 'Новомиргород', 14),
(284, 'Новоукраїнка', 14),
(285, 'Помічна', 14),
(286, 'Світловодськ', 14),
(287, 'Миколаїв', 15),
(288, 'Баштанка', 15),
(289, 'Вознесенськ', 15),
(290, 'Нова Одеса', 15),
(291, 'Новий Буг', 15),
(292, 'Очаків', 15),
(293, 'Первомайськ', 15),
(294, 'Снігурівка', 15),
(295, 'Южноукраїнськ', 15),
(296, 'Охтирка', 16),
(297, 'Білопілля', 16),
(298, 'Буринь', 16),
(299, 'Ворожба', 16),
(300, 'Глухів', 16),
(301, 'Дружба', 16),
(302, 'Конотоп', 16),
(303, 'Кролевець', 16),
(304, 'Лебедін', 16),
(305, 'Путивль', 16),
(306, 'Ромни', 16),
(307, 'Середина-Буда', 16),
(308, 'Суми', 16),
(309, 'Тростянець', 16),
(310, 'Шостка', 16),
(311, 'Львів', 17),
(312, 'Белз', 17),
(313, 'Бобрка', 17),
(314, 'Борислав', 17),
(315, 'Броди', 17),
(316, 'Буськ', 17),
(317, 'Великі Мости', 17),
(318, 'Винники', 17),
(319, 'Глиняни', 17),
(320, 'Містечко', 17),
(321, 'Добромиль', 17),
(322, 'Дрогобич', 17),
(323, 'Дубляни', 17),
(324, 'Жидачів', 17),
(325, 'Жовква', 17),
(326, 'Золочів', 17),
(327, 'Кам\'янка-Бузька', 17),
(328, 'Комарно', 17),
(329, 'Моршин', 17),
(330, 'Мостиська', 17),
(331, 'Миколаїв', 17),
(332, 'Новояворівськ', 17),
(333, 'Новий Калинів', 17),
(334, 'Новий Розділ', 17),
(335, 'Перемишляни', 17),
(336, 'Пустомити', 17),
(337, 'Рава-Руська', 17),
(338, 'Радехів', 17),
(339, 'Рудки', 17),
(340, 'Самбір', 17),
(341, 'Сколе', 17),
(342, 'Сокаль', 17),
(343, 'Соснівка', 17),
(344, 'Старий Самбір', 17),
(345, 'Стебник', 17),
(346, 'Стрий', 17),
(347, 'Суднова Вишня', 17),
(348, 'Трускавець', 17),
(349, 'Турка', 17),
(350, 'Угнів', 17),
(351, 'Ходорів', 17),
(352, 'Хирів', 17),
(353, 'Червоноград', 17),
(354, 'Яворів', 17),
(355, 'Черкаси', 18),
(356, 'Ватутіне', 18),
(357, 'Городище', 18),
(358, 'Жашків', 18),
(359, 'Звенигородка', 18),
(360, 'Золотоноша', 18),
(361, 'Кам\'янка', 18),
(362, 'Канів', 18),
(363, 'Корсунь-Шевченківський', 18),
(364, 'Монастирище', 18),
(365, 'Сміла', 18),
(366, 'Тальне', 18),
(367, 'Умань', 18),
(368, 'Христинівка', 18),
(369, 'Чигирин', 18),
(370, 'Шпола', 18),
(371, 'Волочиськ', 19),
(372, 'Містечко', 19),
(373, 'Деражня', 19),
(374, 'Дунаївці', 19),
(375, 'Ізяслав', 19),
(376, 'Кам\'янець-Подільський', 19),
(377, 'Красилів', 19),
(378, 'Нетішин', 19),
(379, 'Полонне', 19),
(380, 'Славута', 19),
(381, 'Старокостянтинів', 19),
(382, 'Хмельницький', 19),
(383, 'Шепетівка', 19),
(384, 'Луцьк', 20),
(385, 'Берестечко', 20),
(386, 'Володимир', 20),
(387, 'Горохів', 20),
(388, 'Камінь-Каширський', 20),
(389, 'Ківерці', 20),
(390, 'Ковель', 20),
(391, 'Любомль', 20),
(392, 'Нововолинськ', 20),
(393, 'Рожище', 20),
(394, 'Устилуг', 20),
(395, 'Рівне', 21),
(396, 'Вараш', 21),
(397, 'Березне', 21),
(398, 'Дубно', 21),
(399, 'Дубровиця', 21),
(400, 'Здолбунів', 21),
(401, 'Корець', 21),
(402, 'Костопіль', 21),
(403, 'Острог', 21),
(404, 'Радивилів', 21),
(405, 'Сарни', 21),
(406, 'Івано-Франківськ', 22),
(407, 'Болехів', 22),
(408, 'Бурштин', 22),
(409, 'Галич', 22),
(410, 'Городенка', 22),
(411, 'Долина', 22),
(412, 'Калуш', 22),
(413, 'Коломия', 22),
(414, 'Косів', 22),
(415, 'Надвірна', 22),
(416, 'Рогатин', 22),
(417, 'Снятин', 22),
(418, 'Тлумач', 22),
(419, 'Тисмениця', 22),
(420, 'Яремче', 22),
(421, 'Тернопіль', 23),
(422, 'Бережани', 23),
(423, 'Борщів', 23),
(424, 'Бучач', 23),
(425, 'Заліщики', 23),
(426, 'Збараж', 23),
(427, 'Зборів', 23),
(428, 'Копичинці', 23),
(429, 'Кременець', 23),
(430, 'Ланівці', 23),
(431, 'Монастириська', 23),
(432, 'Підгайці', 23),
(433, 'Почаїв', 23),
(434, 'Скалат', 23),
(435, 'Теребовля', 23),
(436, 'Хоростків', 23),
(437, 'Чортків', 23),
(438, 'Шумськ', 23),
(439, 'Берегове', 24),
(440, 'Виноградів', 24),
(441, 'Іршава', 24),
(442, 'Мукачеве', 24),
(443, 'Перечин', 24),
(444, 'Рахів', 24),
(445, 'Свалява', 24),
(446, 'Тячів', 24),
(447, 'Ужгород', 24),
(448, 'Хуст', 24),
(449, 'Чоп', 24),
(450, 'Чернівці', 25),
(451, 'Вашківці', 25),
(452, 'Вижниця', 25),
(453, 'Герця', 25),
(454, 'Заставна', 25),
(455, 'Кіцмань', 25),
(456, 'Новодністровськ', 25),
(457, 'Новоселиця', 25),
(458, 'Сокиряни', 25),
(459, 'Сторожинець', 25),
(460, 'Хотин', 25);

-- --------------------------------------------------------

--
-- Структура таблиці `comment`
--

CREATE TABLE `comment` (
  `comment_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `rating` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Структура таблиці `models`
--

CREATE TABLE `models` (
  `model_id` int(11) NOT NULL,
  `model_name` varchar(255) NOT NULL,
  `brand_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Дамп даних таблиці `models`
--

INSERT INTO `models` (`model_id`, `model_name`, `brand_id`) VALUES
(1, 'Fenix', 1),
(2, 'Tonik', 1),
(3, 'Berlingo', 2),
(4, 'Jumper', 2),
(5, 'Jumpy', 2),
(6, 'Nemo', 2),
(7, 'XF 105', 3),
(8, 'XF 95', 3),
(9, 'XF 106', 3),
(10, 'ATI', 3),
(11, 'CF 65', 3),
(12, 'CF 85', 3),
(13, 'FX', 3),
(14, 'LF', 3),
(15, 'TE', 3),
(16, 'Sprinter', 4),
(17, '1041', 5),
(18, 'J5', 5),
(19, '1031', 5),
(20, '1051', 5),
(21, 'Doblo', 6),
(22, 'Ducato', 6),
(23, 'Fiorino', 6),
(24, 'Scudo', 6),
(25, 'Transit', 7),
(26, 'Tourneo', 7),
(27, 'Escort Express', 7),
(28, 'Cargo', 7),
(29, 'F-350', 7),
(30, 'F-450', 7),
(31, 'F-650', 7),
(32, 'F-700', 7),
(33, 'F-Max', 7),
(34, 'E-150', 7),
(35, 'E-250', 7),
(36, 'E-350', 7),
(37, 'E-450', 7),
(38, 'Auman', 8),
(39, 'Aumark', 8),
(40, 'BJ', 8),
(41, 'Century', 9),
(42, 'Columbia', 9),
(43, 'Conventional', 9),
(44, 'Sprinter', 9),
(45, 'Savana', 10),
(46, 'H-350', 11),
(47, 'Xcient', 11),
(48, 'Porter', 11),
(49, 'HD35', 11),
(50, 'HD65', 11),
(51, 'HD72', 11),
(52, 'HD78', 11),
(53, 'HD120', 11),
(54, 'HD170', 11),
(55, 'HD270', 11),
(56, 'HD500', 11),
(57, '9200', 12),
(58, '9400', 12),
(59, '9600', 12),
(60, 'LoneStar', 12),
(61, 'ELF', 13),
(62, 'Forward', 13),
(63, 'Giga', 13),
(64, 'CYZ', 13),
(65, 'NQR', 13),
(66, 'NPS', 13),
(67, 'FVR', 13),
(68, 'NPR', 13),
(69, 'Trakker', 14),
(70, 'Daily', 14),
(71, 'Stralis', 14),
(72, 'Eurocargo', 14),
(73, 'TurboDaily', 14),
(74, 'Cursor', 14),
(75, 'EuroStar', 14),
(76, 'EuroCargo', 14),
(77, 'EuroTech', 14),
(78, 'Astra', 14),
(79, 'N120', 15),
(80, 'N200', 15),
(81, 'N56', 15),
(82, 'N75', 15),
(83, 'N82', 15),
(84, 'CX', 16),
(85, 'Granite', 16),
(86, 'CH', 16),
(87, 'CM', 16),
(88, 'CS', 16),
(89, 'CV', 16),
(90, 'Metroliner', 16),
(91, 'RD', 16),
(92, 'Titan', 16),
(93, 'Vision', 16),
(94, 'Valueliner', 16),
(95, 'SuperLiner', 16),
(96, 'TGL', 17),
(97, 'TGM', 17),
(98, 'TGS', 17),
(99, 'TGX', 17),
(100, 'TGA', 17),
(101, 'Sprinter', 18),
(102, 'Actros', 18),
(103, 'Atego', 18),
(104, 'Citan', 18),
(105, '1114', 18),
(106, '1117', 18),
(107, '1120', 18),
(108, '1124', 18),
(109, '1314', 18),
(110, '1317', 18),
(111, '1320', 18),
(112, '1324', 18),
(113, '1413', 18),
(114, '1520', 18),
(115, '2219', 18),
(116, '2222', 18),
(117, '2225', 18),
(118, '2420', 18),
(119, '2433', 18),
(120, '2435', 18),
(121, '808', 18),
(122, '817', 18),
(123, '820', 18),
(124, '914', 18),
(125, '917', 18),
(126, 'MB', 18),
(127, 'T1', 18),
(128, 'T2', 18),
(129, 'Vario', 18),
(130, 'Vito', 18),
(131, 'Axor', 18),
(132, 'Canter', 19),
(133, 'Fuso', 19),
(134, 'NV200', 20),
(135, 'NV300', 20),
(136, 'NV400', 20),
(137, 'Primastar', 20),
(138, 'Atleon', 20),
(139, 'Cabstar', 20),
(140, 'Interstar', 20),
(141, 'Trade', 20),
(142, 'Vanette', 20),
(143, '270', 21),
(144, '320', 21),
(145, '330', 21),
(146, '335', 21),
(147, '357', 21),
(148, '362', 21),
(149, '378', 21),
(150, '379', 21),
(151, '387', 21),
(152, 'Boxer', 22),
(153, 'Expert', 22),
(154, 'Bipper', 22),
(155, 'Kangoo', 23),
(156, 'Mascott', 23),
(157, 'Master', 23),
(158, 'Trafic', 23),
(159, 'K', 23),
(160, 'Kerax', 23),
(161, 'Magnum', 23),
(162, 'Maxity', 23),
(163, 'Midliner', 23),
(164, 'Midlum', 23),
(165, 'Premium', 23),
(166, 'Range T', 23),
(167, 'R', 24),
(168, 'P', 24),
(169, 'G', 24),
(170, 'S', 24),
(171, 'LPT', 25),
(172, 'T ', 25),
(173, '813', 26),
(174, '815', 26),
(175, 'Hiace', 27),
(176, 'Proace', 27),
(177, 'Caddy', 28),
(178, 'T1', 28),
(179, 'T2', 28),
(180, 'T3', 28),
(181, 'T4', 28),
(182, 'T5', 28),
(183, 'T6', 28),
(184, 'Crafter', 28),
(185, 'LT', 28),
(186, 'FL', 29),
(187, 'FE', 29),
(188, 'FM', 29),
(189, 'FMX', 29),
(190, 'FH', 29),
(191, 'VNL', 29),
(192, 'ГАЗель', 30),
(193, 'Соболь', 30),
(194, 'Next', 30),
(195, 'ГАЗон-Next', 30),
(196, '3310', 30),
(197, '3221', 30),
(198, '3308', 30),
(199, '2217', 30),
(200, '2310', 30),
(201, '2705', 30),
(202, '2752', 30),
(203, '3221', 30),
(204, '3302', 30),
(205, '3307', 30),
(206, '3308', 30),
(207, '3309', 30),
(208, '66', 30),
(209, '53', 30),
(210, '130', 31),
(211, '131', 31),
(212, '133', 31),
(213, '4131', 31),
(214, '4331', 31),
(215, '4502', 31),
(216, '4505', 31),
(217, '5301', 31),
(218, '4308', 32),
(219, '4310', 32),
(220, '4311', 32),
(221, '4325', 32),
(222, '44108', 32),
(223, '4514', 32),
(224, '5321', 32),
(225, '53605', 32),
(226, '5460', 32),
(227, '5490', 32),
(228, '5511', 32),
(229, '6460', 32),
(230, '6511', 32),
(231, '6520', 32),
(232, '6522', 32),
(233, '6540', 32),
(234, '6580', 32),
(235, '4326', 32),
(236, '689011', 32),
(237, '55102', 32),
(238, '53228', 32),
(239, '54115', 32),
(240, '5410', 32),
(241, '5320', 32),
(242, 'C18', 33),
(243, 'C20', 33),
(244, 'H22', 33),
(245, 'H23', 33),
(246, '5233', 33),
(247, '6230C40', 33),
(248, '6322', 33),
(249, '64372', 33),
(250, '6443', 33),
(251, '6446', 33),
(252, '65032', 33),
(253, '6505', 33),
(254, '6510', 33),
(255, '7133', 33),
(256, '255', 33),
(257, '260', 33),
(258, '5401H2', 33),
(259, 'C26', 33),
(260, '6135B6', 33),
(261, 'M19', 33),
(262, 'H12', 33),
(263, '6233M6', 33),
(264, '7140H6', 33),
(265, '256', 33),
(266, '4570', 34),
(267, '5440', 34),
(268, '5550', 34),
(269, '6303', 34),
(270, '6312', 34),
(271, '6317', 34),
(272, '6501', 34),
(273, '6516', 34),
(274, '6310', 34),
(275, '4371', 34),
(276, '6517', 34),
(277, '6430', 34),
(278, '4571', 34),
(279, '5340', 34),
(280, '6422', 34),
(281, '4380', 34),
(282, '6425', 34),
(283, '5516', 34),
(284, '5316', 34),
(285, '5551', 34),
(286, '4370', 34),
(287, '5434', 34),
(288, '5337', 34),
(289, '5336', 34),
(290, 'Profi', 35),
(291, 'Cargo', 35),
(292, '3909', 35),
(293, '3741', 35),
(294, '2206', 35),
(295, '39625', 35),
(296, '39094', 35),
(297, '3303', 35),
(298, '3962', 35),
(299, '452', 35),
(300, 'Next', 36),
(301, '44202', 36),
(302, '4320', 36),
(303, '5557', 36),
(304, '4320', 36),
(305, 'Combo', 37);

-- --------------------------------------------------------

--
-- Структура таблиці `regions`
--

CREATE TABLE `regions` (
  `region_id` int(11) NOT NULL,
  `region_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Дамп даних таблиці `regions`
--

INSERT INTO `regions` (`region_id`, `region_name`) VALUES
(1, 'Одеська область'),
(2, 'Дніпропетровська область'),
(3, 'Чернігівська область'),
(4, 'Харківська область'),
(5, 'Житомирська область'),
(6, 'Полтавська область'),
(7, 'Херсонська область'),
(8, 'Київська область'),
(9, 'Запорізька область'),
(10, 'Луганська область'),
(11, 'Донецька область'),
(12, 'Вінницька область'),
(13, 'АР Крим'),
(14, 'Кіровоградська область'),
(15, 'Миколаївська область'),
(16, 'Сумська область'),
(17, 'Львівська область'),
(18, 'Черкаська область'),
(19, 'Хмельницька область'),
(20, 'Волинська область'),
(21, 'Рівненська область'),
(22, 'Івано-Франківська область'),
(23, 'Тернопільська область'),
(24, 'Закарпатська область'),
(25, 'Чернівецька область');

-- --------------------------------------------------------

--
-- Структура таблиці `reviews`
--

CREATE TABLE `reviews` (
  `review_id` int(11) NOT NULL,
  `recipient_id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `rating` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Структура таблиці `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `password` varchar(255) NOT NULL,
  `login` varchar(255) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `type` varchar(255) NOT NULL,
  `region` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `creation_data` date NOT NULL,
  `image` varchar(255) NOT NULL,
  `premium_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Дамп даних таблиці `users`
--

INSERT INTO `users` (`id_user`, `password`, `login`, `user_name`, `middle_name`, `last_name`, `type`, `region`, `city`, `phone`, `email`, `creation_data`, `image`, `premium_status`) VALUES
(81, 'ZC9wQ3BJT296Z09IMlRFVTZUMTZXZz09OjrL8RQ8Dave9EEtqFLx0Eea', 'rrrr', 'rrrr', 'rrrr', 'rrrr', 'user', 'Дніпропетровська область', 'Вільногірськ', '5345', 'dfg@fdg.gfd', '2022-03-22', 'default.jpg', 'standart'),
(82, 'SUtxTlJHaWdTaXJTUUF3TXJrS01aQT09Ojob+EwrWvSN72O1ZowSSNpA', 'rrrr', 'rrrr', 'rrrr', 'rrrr', 'user', 'Харківська область', 'Богодухів', '4323', 'fd@gkh.lk', '2022-03-22', 'default.jpg', 'standart'),
(84, 'ZVgrMElRQS9ST1Q2d3hTVzNBWTVuUT09Ojp+5/hMhTeXgCJQYfYlowoz', 'nkteam', 'nkteam', 'nkteam', 'nkteam', 'user', 'Чернігівська область', 'Городня', '0678522222', 'nkteam@team.com', '2022-03-22', 'card.jpg', 'standart');

--
-- Індекси збережених таблиць
--

--
-- Індекси таблиці `bodies`
--
ALTER TABLE `bodies`
  ADD PRIMARY KEY (`body_id`);

--
-- Індекси таблиці `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`brand_id`);

--
-- Індекси таблиці `cargos`
--
ALTER TABLE `cargos`
  ADD PRIMARY KEY (`cargo_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Індекси таблиці `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`car_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Індекси таблиці `car_images`
--
ALTER TABLE `car_images`
  ADD PRIMARY KEY (`image_id`),
  ADD KEY `car_id` (`car_id`);

--
-- Індекси таблиці `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`city_id`),
  ADD KEY `region_id` (`region_id`);

--
-- Індекси таблиці `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Індекси таблиці `models`
--
ALTER TABLE `models`
  ADD PRIMARY KEY (`model_id`),
  ADD KEY `brand_id` (`brand_id`);

--
-- Індекси таблиці `regions`
--
ALTER TABLE `regions`
  ADD PRIMARY KEY (`region_id`);

--
-- Індекси таблиці `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `recipient_id` (`recipient_id`),
  ADD KEY `sender_id` (`sender_id`);

--
-- Індекси таблиці `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT для збережених таблиць
--

--
-- AUTO_INCREMENT для таблиці `bodies`
--
ALTER TABLE `bodies`
  MODIFY `body_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT для таблиці `brands`
--
ALTER TABLE `brands`
  MODIFY `brand_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT для таблиці `cargos`
--
ALTER TABLE `cargos`
  MODIFY `cargo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT для таблиці `cars`
--
ALTER TABLE `cars`
  MODIFY `car_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT для таблиці `car_images`
--
ALTER TABLE `car_images`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT для таблиці `cities`
--
ALTER TABLE `cities`
  MODIFY `city_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=461;

--
-- AUTO_INCREMENT для таблиці `comment`
--
ALTER TABLE `comment`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблиці `models`
--
ALTER TABLE `models`
  MODIFY `model_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=306;

--
-- AUTO_INCREMENT для таблиці `regions`
--
ALTER TABLE `regions`
  MODIFY `region_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT для таблиці `reviews`
--
ALTER TABLE `reviews`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблиці `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- Обмеження зовнішнього ключа збережених таблиць
--

--
-- Обмеження зовнішнього ключа таблиці `cargos`
--
ALTER TABLE `cargos`
  ADD CONSTRAINT `cargos_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id_user`);

--
-- Обмеження зовнішнього ключа таблиці `cars`
--
ALTER TABLE `cars`
  ADD CONSTRAINT `cars_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id_user`);

--
-- Обмеження зовнішнього ключа таблиці `car_images`
--
ALTER TABLE `car_images`
  ADD CONSTRAINT `car_images_ibfk_1` FOREIGN KEY (`car_id`) REFERENCES `cars` (`car_id`);

--
-- Обмеження зовнішнього ключа таблиці `cities`
--
ALTER TABLE `cities`
  ADD CONSTRAINT `cities_ibfk_1` FOREIGN KEY (`region_id`) REFERENCES `regions` (`region_id`);

--
-- Обмеження зовнішнього ключа таблиці `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id_user`);

--
-- Обмеження зовнішнього ключа таблиці `models`
--
ALTER TABLE `models`
  ADD CONSTRAINT `models_ibfk_1` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`brand_id`);

--
-- Обмеження зовнішнього ключа таблиці `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`recipient_id`) REFERENCES `users` (`id_user`),
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
