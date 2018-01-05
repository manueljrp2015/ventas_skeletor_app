-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-02-2017 a las 18:14:47
-- Versión del servidor: 10.1.9-MariaDB
-- Versión de PHP: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `freelancer`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbapp_country`
--

CREATE TABLE `tbapp_country` (
  `id` int(11) NOT NULL,
  `_country` varchar(254) NOT NULL,
  `_country_status` enum('ac','in') NOT NULL DEFAULT 'ac',
  `_prefix` varchar(8) NOT NULL,
  `_codephone` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbapp_country`
--

INSERT INTO `tbapp_country` (`id`, `_country`, `_country_status`, `_prefix`, `_codephone`) VALUES
(1, 'Venezuela', 'ac', 'VEN', '+58');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbapp_registeruser_app`
--

CREATE TABLE `tbapp_registeruser_app` (
  `id` int(11) NOT NULL,
  `_nickname` varchar(254) NOT NULL,
  `_mail` varchar(254) NOT NULL,
  `_key` varchar(254) NOT NULL,
  `_account_id` int(11) NOT NULL,
  `_country_id` int(11) NOT NULL,
  `_created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `_update_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `_user_status` enum('ac','in','block') NOT NULL DEFAULT 'ac'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbapp_registeruser_app`
--

INSERT INTO `tbapp_registeruser_app` (`id`, `_nickname`, `_mail`, `_key`, `_account_id`, `_country_id`, `_created_at`, `_update_at`, `_user_status`) VALUES
(1, 'manueljrp', 'manueljrp@gmail.com', '$2y$12$ZuhH/03z/S5wFInOHVUEbO7zYkkKXLMXX75BjccwPru75GLAeb6ga', 1, 1, '2017-02-16 22:52:42', '2017-02-16 18:22:42', 'ac');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbapp_registeruser_app_other_info`
--

CREATE TABLE `tbapp_registeruser_app_other_info` (
  `id` int(11) NOT NULL,
  `_IDUser` int(11) NOT NULL,
  `_firt_name` varchar(180) NOT NULL,
  `_last_name` varchar(180) NOT NULL,
  `_IDTypeid` int(11) NOT NULL,
  `_identity` varchar(180) NOT NULL,
  `_website` text NOT NULL,
  `_social` text NOT NULL,
  `_create_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `_update_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbapp_sessions`
--

CREATE TABLE `tbapp_sessions` (
  `id` varchar(128) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `data` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbapp_sessions`
--

INSERT INTO `tbapp_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES
('ifba520n6u2umsplt74647r7e9vlrghg', '127.0.0.1', 1487687362, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373638373336313b),
('uilee41absj4kmedo98252rdr73abjkl', '127.0.0.1', 1487687830, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373638373833303b),
('onmv9k2chhtugqd188kapjbmt93sftnm', '127.0.0.1', 1487689328, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373638393136383b69647c733a313a2231223b6e69636b6e616d657c733a393a226d616e75656c6a7270223b6d61696c7c733a31393a226d616e75656c6a727040676d61696c2e636f6d223b6163636f756e745f69647c733a313a2231223b636f756e7472795f69647c733a313a2231223b),
('ov381dh4juvgnj6hna8po5cmgse808se', '127.0.0.1', 1487693168, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373639323039373b69647c733a313a2231223b6e69636b6e616d657c733a393a226d616e75656c6a7270223b6d61696c7c733a31393a226d616e75656c6a727040676d61696c2e636f6d223b6163636f756e745f69647c733a313a2231223b636f756e7472795f69647c733a313a2231223b),
('091ejqf6t9n61oppr2tmpeh57er75cdr', '127.0.0.1', 1487694236, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373639343233353b69647c733a313a2231223b6e69636b6e616d657c733a393a226d616e75656c6a7270223b6d61696c7c733a31393a226d616e75656c6a727040676d61696c2e636f6d223b6163636f756e745f69647c733a313a2231223b636f756e7472795f69647c733a313a2231223b),
('dimi8ke8taoc30bikj8ha5l8sa5jn11r', '127.0.0.1', 1487699241, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373639393234313b69647c733a313a2231223b6e69636b6e616d657c733a393a226d616e75656c6a7270223b6d61696c7c733a31393a226d616e75656c6a727040676d61696c2e636f6d223b6163636f756e745f69647c733a313a2231223b636f756e7472795f69647c733a313a2231223b),
('j3qf410r6ge9ad2lj2acfmb19dtnn2uj', '127.0.0.1', 1487699788, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373639393536303b69647c733a313a2231223b6e69636b6e616d657c733a393a226d616e75656c6a7270223b6d61696c7c733a31393a226d616e75656c6a727040676d61696c2e636f6d223b6163636f756e745f69647c733a313a2231223b636f756e7472795f69647c733a313a2231223b),
('ne1agl98ejjputbqjr5b2hjvausqgvcs', '127.0.0.1', 1487700685, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373730303435373b69647c733a313a2231223b6e69636b6e616d657c733a393a226d616e75656c6a7270223b6d61696c7c733a31393a226d616e75656c6a727040676d61696c2e636f6d223b6163636f756e745f69647c733a313a2231223b636f756e7472795f69647c733a313a2231223b),
('pdm21pe74bto3d84jj8auck5af3hecnt', '127.0.0.1', 1487701689, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373730313637323b69647c733a313a2231223b6e69636b6e616d657c733a393a226d616e75656c6a7270223b6d61696c7c733a31393a226d616e75656c6a727040676d61696c2e636f6d223b6163636f756e745f69647c733a313a2231223b636f756e7472795f69647c733a313a2231223b),
('d4kruj95tmajo8qi5jceaeakr7a6inot', '127.0.0.1', 1487702528, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373730323334383b69647c733a313a2231223b6e69636b6e616d657c733a393a226d616e75656c6a7270223b6d61696c7c733a31393a226d616e75656c6a727040676d61696c2e636f6d223b6163636f756e745f69647c733a313a2231223b636f756e7472795f69647c733a313a2231223b),
('24f64f458c5p42v3fjavdmp3lvklcqua', '127.0.0.1', 1487703356, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373730333234383b69647c733a313a2231223b6e69636b6e616d657c733a393a226d616e75656c6a7270223b6d61696c7c733a31393a226d616e75656c6a727040676d61696c2e636f6d223b6163636f756e745f69647c733a313a2231223b636f756e7472795f69647c733a313a2231223b),
('gmrtvgj9llak1651ncnm16e7dcdnf08i', '127.0.0.1', 1487704078, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373730333933343b69647c733a313a2231223b6e69636b6e616d657c733a393a226d616e75656c6a7270223b6d61696c7c733a31393a226d616e75656c6a727040676d61696c2e636f6d223b6163636f756e745f69647c733a313a2231223b636f756e7472795f69647c733a313a2231223b),
('a5frb4binif5jm88sa938uuhevpf5el2', '127.0.0.1', 1487704401, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373730343235363b69647c733a313a2231223b6e69636b6e616d657c733a393a226d616e75656c6a7270223b6d61696c7c733a31393a226d616e75656c6a727040676d61696c2e636f6d223b6163636f756e745f69647c733a313a2231223b636f756e7472795f69647c733a313a2231223b),
('hu5s7aqrgsgtrvtti20feen0gm9qnhdj', '127.0.0.1', 1487704870, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373730343630383b69647c733a313a2231223b6e69636b6e616d657c733a393a226d616e75656c6a7270223b6d61696c7c733a31393a226d616e75656c6a727040676d61696c2e636f6d223b6163636f756e745f69647c733a313a2231223b636f756e7472795f69647c733a313a2231223b),
('uu7j1kdplqho8k1hglv3p81cn5a78s3s', '127.0.0.1', 1487705589, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373730353335313b69647c733a313a2231223b6e69636b6e616d657c733a393a226d616e75656c6a7270223b6d61696c7c733a31393a226d616e75656c6a727040676d61696c2e636f6d223b6163636f756e745f69647c733a313a2231223b636f756e7472795f69647c733a313a2231223b),
('4vsogluhoomd62qf8nrrc06fuj4e7vgj', '127.0.0.1', 1487706801, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373730363739323b),
('1l1kh4108cfqkhp0o52crdlkh60f8tvi', '127.0.0.1', 1487713769, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373731333530333b69647c733a313a2231223b6e69636b6e616d657c733a393a226d616e75656c6a7270223b6d61696c7c733a31393a226d616e75656c6a727040676d61696c2e636f6d223b6163636f756e745f69647c733a313a2231223b636f756e7472795f69647c733a313a2231223b),
('l504d4asltrig94eqjpvrtqodnp08da8', '127.0.0.1', 1487775448, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373737353138383b),
('gtmjgt5sv2kvf7kjp46dsqc1rm3stp8f', '127.0.0.1', 1487775556, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373737353535363b),
('4f71n6un4b18ala9pmqqnchdk49d9vlt', '127.0.0.1', 1487775969, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373737353934383b),
('bhmpl3dm6955f840ahgh1ai14h0i4phv', '127.0.0.1', 1487776558, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373737363535383b),
('9bpcpuspb5jpl5afjmv8fj0rido9vee4', '127.0.0.1', 1487777437, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373737373336303b),
('2eakmtfg773i49likqku0o3ocnpdcsd4', '127.0.0.1', 1487777694, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373737373636363b),
('df5eqt4uqlgra34fgt93fdll5nntp311', '127.0.0.1', 1487779377, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373737393130333b),
('qgeilfb0krav5fberuh7vqvik3gg4h55', '127.0.0.1', 1487779719, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373737393434363b),
('2alnl5c9nk066e6jqre3gcpmncbmcd3n', '127.0.0.1', 1487780048, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373737393735313b),
('sm4jucrcv0b94tsq6ast1pk7g6bbrcad', '127.0.0.1', 1487780336, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373738303035363b),
('p2ddnb9pcp3efulfobnkckbbeg4f0mcm', '127.0.0.1', 1487780686, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373738303339363b),
('6ff1emo1k30qi9ok6rukv9lc4qgtpqv6', '127.0.0.1', 1487780477, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373738303437373b),
('rk1tsgmhdav1j43hvrj8dm5s0k6tvt4u', '127.0.0.1', 1487780819, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373738303831393b),
('ifas6c1ur5jpee5fmo9v63bn824b32uu', '127.0.0.1', 1487781426, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373738313136383b),
('b15cvmqqmkjn6ltac5vn6rd31v7h134r', '127.0.0.1', 1487781880, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373738313538303b),
('1av4etj7hrrvgo0i1bd03626l2iacfrk', '127.0.0.1', 1487782138, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373738313931323b),
('1s8p34mr0985bbuhhr755alr0otcfmib', '127.0.0.1', 1487782622, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373738323337353b),
('n22acj6f4i47fuk4cqgslh3ecjv03gg1', '127.0.0.1', 1487782693, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373738323639333b),
('848sa5bupr8gftgponrp1iri8cd52vp7', '127.0.0.1', 1487783408, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373738333137373b),
('mp91hcc8nb11mes7t3pnf16slltqu821', '127.0.0.1', 1487783623, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373738333437393b),
('9ou8dhvbq9h3ptgkhps22s7tftgfpqv5', '127.0.0.1', 1487784051, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373738333832303b),
('ck7t0jabsund2injgknhr3cuc374d41t', '127.0.0.1', 1487784292, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373738343135353b),
('4sre7ot2adlv1kc8huhdki76cr3rjthi', '127.0.0.1', 1487784672, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373738343532323b),
('r0ln1lsb4tntimvupmfugnir0up0os83', '127.0.0.1', 1487785123, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373738343933333b),
('ldct9lvosa6skeprn7srfl3ea1ra5aej', '127.0.0.1', 1487785815, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373738353534353b),
('h913omm2d5651ur1rh1ks0qp73dgjg2q', '127.0.0.1', 1487790014, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373739303031343b),
('engshbu5tmif298r8lk1lf6o3r597cog', '127.0.0.1', 1487799545, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373739393236333b),
('fcgmpol3t8ntnibok9u2ulguvdjk97q1', '127.0.0.1', 1487799616, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373739393538313b),
('k24mhpb2slc9pt4fqtnf4vk1ai2l1mit', '127.0.0.1', 1487800561, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373830303336333b),
('0mvfm5sqnj51m1fm4jh1bupjb23fmq2o', '127.0.0.1', 1487800772, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373830303737323b),
('0qp2njukrvbfbl5ud88vvvmblffnul5r', '127.0.0.1', 1487801403, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373830313430333b),
('tfp37q8qq88ik5js2hihfk4srpobcmdj', '127.0.0.1', 1487802700, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373830323530383b),
('7r8ag2urrc26qajm5mvdme6la8t7lei3', '127.0.0.1', 1487803100, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373830323831303b),
('kst8t8kblp0i03v7on7g51i6m78h5cmj', '127.0.0.1', 1487803359, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373830333133393b),
('jljdsslk3iro6r7u5r968ciemaekoq4r', '127.0.0.1', 1487803781, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373830333531383b69647c733a313a2231223b6e69636b6e616d657c733a393a226d616e75656c6a7270223b6d61696c7c733a31393a226d616e75656c6a727040676d61696c2e636f6d223b6163636f756e745f69647c733a313a2231223b636f756e7472795f69647c733a313a2231223b),
('mqn7ucvtbctflpsn6qdbri8d4qfk1j7f', '127.0.0.1', 1487804101, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373830333832313b69647c733a313a2231223b6e69636b6e616d657c733a393a226d616e75656c6a7270223b6d61696c7c733a31393a226d616e75656c6a727040676d61696c2e636f6d223b6163636f756e745f69647c733a313a2231223b636f756e7472795f69647c733a313a2231223b),
('58eu3iot60d4dvvc5pphdnu550o6185t', '127.0.0.1', 1487804182, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373830343138323b69647c733a313a2231223b6e69636b6e616d657c733a393a226d616e75656c6a7270223b6d61696c7c733a31393a226d616e75656c6a727040676d61696c2e636f6d223b6163636f756e745f69647c733a313a2231223b636f756e7472795f69647c733a313a2231223b),
('o45knngs1i25kk81tvfm3u5gh5d17qhr', '127.0.0.1', 1487814791, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373831343439333b),
('b2qop6jmgm8kfr8ama1855lvfrglhkdj', '127.0.0.1', 1487814863, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373831343834363b),
('jmh40gerintumm8di2tvsdk48btkque5', '127.0.0.1', 1487815302, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373831353135303b),
('dja658ghj74n7qik16bh4cb079k5dltj', '127.0.0.1', 1487853518, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373835333437343b69647c733a313a2231223b6e69636b6e616d657c733a393a226d616e75656c6a7270223b6d61696c7c733a31393a226d616e75656c6a727040676d61696c2e636f6d223b6163636f756e745f69647c733a313a2231223b636f756e7472795f69647c733a313a2231223b),
('m0gtpc3ecddsoppjivvflkinbo7lktqi', '127.0.0.1', 1487861786, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373836313734333b69647c733a313a2231223b6e69636b6e616d657c733a393a226d616e75656c6a7270223b6d61696c7c733a31393a226d616e75656c6a727040676d61696c2e636f6d223b6163636f756e745f69647c733a313a2231223b636f756e7472795f69647c733a313a2231223b),
('vj3dje4156lusfn5cugdf6bip95des7q', '127.0.0.1', 1487862080, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373836323035313b69647c733a313a2231223b6e69636b6e616d657c733a393a226d616e75656c6a7270223b6d61696c7c733a31393a226d616e75656c6a727040676d61696c2e636f6d223b6163636f756e745f69647c733a313a2231223b636f756e7472795f69647c733a313a2231223b),
('h678mudbp6430tbjk7d91eeeuecnct2a', '127.0.0.1', 1487862831, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373836323534303b69647c733a313a2231223b6e69636b6e616d657c733a393a226d616e75656c6a7270223b6d61696c7c733a31393a226d616e75656c6a727040676d61696c2e636f6d223b6163636f756e745f69647c733a313a2231223b636f756e7472795f69647c733a313a2231223b),
('dhrvjvpd728c43k7vs9pc2oaostf6qr9', '127.0.0.1', 1487863518, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373836333236333b69647c733a313a2231223b6e69636b6e616d657c733a393a226d616e75656c6a7270223b6d61696c7c733a31393a226d616e75656c6a727040676d61696c2e636f6d223b6163636f756e745f69647c733a313a2231223b636f756e7472795f69647c733a313a2231223b),
('rhtkqe54f0c9gfth0are42fktskurtrk', '127.0.0.1', 1487863667, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373836333635313b69647c733a313a2231223b6e69636b6e616d657c733a393a226d616e75656c6a7270223b6d61696c7c733a31393a226d616e75656c6a727040676d61696c2e636f6d223b6163636f756e745f69647c733a313a2231223b636f756e7472795f69647c733a313a2231223b),
('65bkgoepn7d5cfsqqe0loccur4k4tmag', '127.0.0.1', 1487864419, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373836343339333b69647c733a313a2231223b6e69636b6e616d657c733a393a226d616e75656c6a7270223b6d61696c7c733a31393a226d616e75656c6a727040676d61696c2e636f6d223b6163636f756e745f69647c733a313a2231223b636f756e7472795f69647c733a313a2231223b),
('93gkboqm975eqdv4b2cbd2b35aaq7l88', '127.0.0.1', 1487865173, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373836353137323b),
('2h4p1gv8re20uc0es60tn5julgosm5l8', '127.0.0.1', 1487865788, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373836353736333b69647c733a313a2231223b6e69636b6e616d657c733a393a226d616e75656c6a7270223b6d61696c7c733a31393a226d616e75656c6a727040676d61696c2e636f6d223b6163636f756e745f69647c733a313a2231223b636f756e7472795f69647c733a313a2231223b),
('867hkbchca9pqqndq4v68b5ef6ie80k3', '127.0.0.1', 1487867185, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373836363931353b69647c733a313a2231223b6e69636b6e616d657c733a393a226d616e75656c6a7270223b6d61696c7c733a31393a226d616e75656c6a727040676d61696c2e636f6d223b6163636f756e745f69647c733a313a2231223b636f756e7472795f69647c733a313a2231223b),
('1f454mrbclm8pk6g9h6cuguv40crpvbu', '127.0.0.1', 1487867944, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373836373634343b69647c733a313a2231223b6e69636b6e616d657c733a393a226d616e75656c6a7270223b6d61696c7c733a31393a226d616e75656c6a727040676d61696c2e636f6d223b6163636f756e745f69647c733a313a2231223b636f756e7472795f69647c733a313a2231223b),
('doirmb8ibs09m1ihqf2c7p4fin5mgnf7', '127.0.0.1', 1487868256, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373836373936343b69647c733a313a2231223b6e69636b6e616d657c733a393a226d616e75656c6a7270223b6d61696c7c733a31393a226d616e75656c6a727040676d61696c2e636f6d223b6163636f756e745f69647c733a313a2231223b636f756e7472795f69647c733a313a2231223b),
('leemiqj4d37o402hh35l5ffk9008hd32', '127.0.0.1', 1487868487, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373836383330323b69647c733a313a2231223b6e69636b6e616d657c733a393a226d616e75656c6a7270223b6d61696c7c733a31393a226d616e75656c6a727040676d61696c2e636f6d223b6163636f756e745f69647c733a313a2231223b636f756e7472795f69647c733a313a2231223b),
('t04iitm6i9iej99dda3dskbpfcnhtr0g', '127.0.0.1', 1487868724, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373836383639303b69647c733a313a2231223b6e69636b6e616d657c733a393a226d616e75656c6a7270223b6d61696c7c733a31393a226d616e75656c6a727040676d61696c2e636f6d223b6163636f756e745f69647c733a313a2231223b636f756e7472795f69647c733a313a2231223b),
('02v71cd48olos1m5e6v71fdhtj7nso46', '127.0.0.1', 1487869313, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373836393031353b69647c733a313a2231223b6e69636b6e616d657c733a393a226d616e75656c6a7270223b6d61696c7c733a31393a226d616e75656c6a727040676d61696c2e636f6d223b6163636f756e745f69647c733a313a2231223b636f756e7472795f69647c733a313a2231223b),
('60p4pfodngir1jjln087mudnji91hheq', '127.0.0.1', 1487869636, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373836393337323b69647c733a313a2231223b6e69636b6e616d657c733a393a226d616e75656c6a7270223b6d61696c7c733a31393a226d616e75656c6a727040676d61696c2e636f6d223b6163636f756e745f69647c733a313a2231223b636f756e7472795f69647c733a313a2231223b),
('mrl0atbicuol5ctjeild3p7aoldpo4b8', '127.0.0.1', 1487869970, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373836393638373b69647c733a313a2231223b6e69636b6e616d657c733a393a226d616e75656c6a7270223b6d61696c7c733a31393a226d616e75656c6a727040676d61696c2e636f6d223b6163636f756e745f69647c733a313a2231223b636f756e7472795f69647c733a313a2231223b),
('qvdtbgu7pg43c8lp10csg2r9ap93cofh', '127.0.0.1', 1487870166, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373837303030313b69647c733a313a2231223b6e69636b6e616d657c733a393a226d616e75656c6a7270223b6d61696c7c733a31393a226d616e75656c6a727040676d61696c2e636f6d223b6163636f756e745f69647c733a313a2231223b636f756e7472795f69647c733a313a2231223b),
('3fmioquc7rg63drerjove9tgt8704b2q', '127.0.0.1', 1487871534, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373837313238343b69647c733a313a2231223b6e69636b6e616d657c733a393a226d616e75656c6a7270223b6d61696c7c733a31393a226d616e75656c6a727040676d61696c2e636f6d223b6163636f756e745f69647c733a313a2231223b636f756e7472795f69647c733a313a2231223b),
('mie9f2v70f1js720kg6c3bvukohjtu98', '127.0.0.1', 1487872007, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373837313732333b69647c733a313a2231223b6e69636b6e616d657c733a393a226d616e75656c6a7270223b6d61696c7c733a31393a226d616e75656c6a727040676d61696c2e636f6d223b6163636f756e745f69647c733a313a2231223b636f756e7472795f69647c733a313a2231223b),
('25dsl5errj8v5tang9sphbv6ejms5f3u', '127.0.0.1', 1487872351, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373837323035373b69647c733a313a2231223b6e69636b6e616d657c733a393a226d616e75656c6a7270223b6d61696c7c733a31393a226d616e75656c6a727040676d61696c2e636f6d223b6163636f756e745f69647c733a313a2231223b636f756e7472795f69647c733a313a2231223b),
('0d7n8q1tadsargo379ef4cboouuf87gv', '127.0.0.1', 1487872654, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373837323432353b69647c733a313a2231223b6e69636b6e616d657c733a393a226d616e75656c6a7270223b6d61696c7c733a31393a226d616e75656c6a727040676d61696c2e636f6d223b6163636f756e745f69647c733a313a2231223b636f756e7472795f69647c733a313a2231223b),
('fib9pnia2hhbhl1lu6og5u2el6jqjp86', '127.0.0.1', 1487878263, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373837383033333b69647c733a313a2231223b6e69636b6e616d657c733a393a226d616e75656c6a7270223b6d61696c7c733a31393a226d616e75656c6a727040676d61696c2e636f6d223b6163636f756e745f69647c733a313a2231223b636f756e7472795f69647c733a313a2231223b),
('n33ham01abje5kjuuiikg25ncv58laol', '127.0.0.1', 1487878364, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373837383336333b69647c733a313a2231223b6e69636b6e616d657c733a393a226d616e75656c6a7270223b6d61696c7c733a31393a226d616e75656c6a727040676d61696c2e636f6d223b6163636f756e745f69647c733a313a2231223b636f756e7472795f69647c733a313a2231223b),
('mbk6odm9ivlffvpg0nuifn0hf2ulkmtl', '127.0.0.1', 1487880304, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373838303032323b69647c733a313a2231223b6e69636b6e616d657c733a393a226d616e75656c6a7270223b6d61696c7c733a31393a226d616e75656c6a727040676d61696c2e636f6d223b6163636f756e745f69647c733a313a2231223b636f756e7472795f69647c733a313a2231223b),
('26aboidldluls2gp7t5ae88ap2pveobj', '127.0.0.1', 1487881429, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373838313339393b69647c733a313a2231223b6e69636b6e616d657c733a393a226d616e75656c6a7270223b6d61696c7c733a31393a226d616e75656c6a727040676d61696c2e636f6d223b6163636f756e745f69647c733a313a2231223b636f756e7472795f69647c733a313a2231223b),
('eh4tulvrcqgtvk5539ncuo1rfmavjrg2', '127.0.0.1', 1487882059, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373838313737323b69647c733a313a2231223b6e69636b6e616d657c733a393a226d616e75656c6a7270223b6d61696c7c733a31393a226d616e75656c6a727040676d61696c2e636f6d223b6163636f756e745f69647c733a313a2231223b636f756e7472795f69647c733a313a2231223b),
('5q446f9vq4ivfpoo1dadbdnun13p15co', '127.0.0.1', 1487882507, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373838323334313b69647c733a313a2231223b6e69636b6e616d657c733a393a226d616e75656c6a7270223b6d61696c7c733a31393a226d616e75656c6a727040676d61696c2e636f6d223b6163636f756e745f69647c733a313a2231223b636f756e7472795f69647c733a313a2231223b),
('u4uhiid290upibfmeh169csjskkaq63g', '127.0.0.1', 1487882772, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373838323734313b69647c733a313a2231223b6e69636b6e616d657c733a393a226d616e75656c6a7270223b6d61696c7c733a31393a226d616e75656c6a727040676d61696c2e636f6d223b6163636f756e745f69647c733a313a2231223b636f756e7472795f69647c733a313a2231223b),
('i7ijkruqqd8culr4g8clp3468ajau3cu', '127.0.0.1', 1487886422, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373838363337373b69647c733a313a2231223b6e69636b6e616d657c733a393a226d616e75656c6a7270223b6d61696c7c733a31393a226d616e75656c6a727040676d61696c2e636f6d223b6163636f756e745f69647c733a313a2231223b636f756e7472795f69647c733a313a2231223b),
('knmhnu5tqbr0rabunck94d2cr3l7pjhv', '127.0.0.1', 1487887022, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373838363738363b69647c733a313a2231223b6e69636b6e616d657c733a393a226d616e75656c6a7270223b6d61696c7c733a31393a226d616e75656c6a727040676d61696c2e636f6d223b6163636f756e745f69647c733a313a2231223b636f756e7472795f69647c733a313a2231223b),
('6d4kjnk6jrcjaa8un7ceem2kqjm7fmdu', '127.0.0.1', 1487887424, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373838373330303b69647c733a313a2231223b6e69636b6e616d657c733a393a226d616e75656c6a7270223b6d61696c7c733a31393a226d616e75656c6a727040676d61696c2e636f6d223b6163636f756e745f69647c733a313a2231223b636f756e7472795f69647c733a313a2231223b),
('errsvsrbpe5tcght3aot5421qs1jrchg', '127.0.0.1', 1487888103, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373838373835323b69647c733a313a2231223b6e69636b6e616d657c733a393a226d616e75656c6a7270223b6d61696c7c733a31393a226d616e75656c6a727040676d61696c2e636f6d223b6163636f756e745f69647c733a313a2231223b636f756e7472795f69647c733a313a2231223b),
('7flu1nhqpojq4artp5gv3dr862min179', '127.0.0.1', 1487888593, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373838383530383b69647c733a313a2231223b6e69636b6e616d657c733a393a226d616e75656c6a7270223b6d61696c7c733a31393a226d616e75656c6a727040676d61696c2e636f6d223b6163636f756e745f69647c733a313a2231223b636f756e7472795f69647c733a313a2231223b),
('kq19qu71s9n1f4abqt2g65js7a6t0ua5', '127.0.0.1', 1487888855, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373838383835343b69647c733a313a2231223b6e69636b6e616d657c733a393a226d616e75656c6a7270223b6d61696c7c733a31393a226d616e75656c6a727040676d61696c2e636f6d223b6163636f756e745f69647c733a313a2231223b636f756e7472795f69647c733a313a2231223b),
('porti2vb6tsfa0k6fvsqha5bbpvsmpip', '127.0.0.1', 1487890666, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373839303436383b69647c733a313a2231223b6e69636b6e616d657c733a393a226d616e75656c6a7270223b6d61696c7c733a31393a226d616e75656c6a727040676d61696c2e636f6d223b6163636f756e745f69647c733a313a2231223b636f756e7472795f69647c733a313a2231223b),
('3ul8f3bbct2fem5hnluk9ejrhsn96ofk', '127.0.0.1', 1487890935, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373839303831323b69647c733a313a2231223b6e69636b6e616d657c733a393a226d616e75656c6a7270223b6d61696c7c733a31393a226d616e75656c6a727040676d61696c2e636f6d223b6163636f756e745f69647c733a313a2231223b636f756e7472795f69647c733a313a2231223b),
('ab767drqqrdnijbj8u7in5ba052fta2h', '127.0.0.1', 1487891482, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373839313231353b69647c733a313a2231223b6e69636b6e616d657c733a393a226d616e75656c6a7270223b6d61696c7c733a31393a226d616e75656c6a727040676d61696c2e636f6d223b6163636f756e745f69647c733a313a2231223b636f756e7472795f69647c733a313a2231223b),
('ne64q2p4l6hoa4pcep9dshpoeou9rs5r', '127.0.0.1', 1487892174, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373839313837333b69647c733a313a2231223b6e69636b6e616d657c733a393a226d616e75656c6a7270223b6d61696c7c733a31393a226d616e75656c6a727040676d61696c2e636f6d223b6163636f756e745f69647c733a313a2231223b636f756e7472795f69647c733a313a2231223b),
('ml3tbr0t5tarl3d4djq068b0eaegpita', '127.0.0.1', 1487892197, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373839323139363b69647c733a313a2231223b6e69636b6e616d657c733a393a226d616e75656c6a7270223b6d61696c7c733a31393a226d616e75656c6a727040676d61696c2e636f6d223b6163636f756e745f69647c733a313a2231223b636f756e7472795f69647c733a313a2231223b),
('csv88jcrha1slgk4hg4mro2mhf33hual', '127.0.0.1', 1487892482, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373839323139373b69647c733a313a2231223b6e69636b6e616d657c733a393a226d616e75656c6a7270223b6d61696c7c733a31393a226d616e75656c6a727040676d61696c2e636f6d223b6163636f756e745f69647c733a313a2231223b636f756e7472795f69647c733a313a2231223b);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbapp_typeid`
--

CREATE TABLE `tbapp_typeid` (
  `id` int(11) NOT NULL,
  `_typeid` varchar(160) NOT NULL,
  `_prefix_typeid` varchar(20) NOT NULL,
  `_created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `_status_typeid` enum('ac','in') NOT NULL DEFAULT 'ac'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbapp_typeid`
--

INSERT INTO `tbapp_typeid` (`id`, `_typeid`, `_prefix_typeid`, `_created_at`, `_status_typeid`) VALUES
(1, 'cedula', 'CED', '2017-02-23 11:36:12', 'ac'),
(2, 'pasarporte', 'PASS', '2017-02-23 11:36:12', 'ac'),
(3, 'Documento Nacional de Identidad', 'DNI', '2017-02-23 11:36:25', 'ac'),
(4, 'Rol Unico Tributario', 'RUT', '2017-02-23 11:36:25', 'ac'),
(5, 'Regimen de Incorporación Fiscal', 'RIF', '2017-02-23 11:36:36', 'ac'),
(6, 'Normas Internacionales de Contabilidad', 'NIC', '2017-02-23 11:36:36', 'in'),
(7, 'Carteira de Identidade o Registro Geral', 'RG', '2017-02-23 11:39:34', 'in'),
(8, 'Carteira de Identidade o Registro Geral', 'CC', '2017-02-23 11:39:34', 'in'),
(9, 'Documento Unico de Identidad', 'DUI', '2017-02-23 11:40:46', 'in'),
(10, 'Documento Personal de Identificacion', 'DPI', '2017-02-23 11:40:46', 'in'),
(11, 'Tarjeta de Identidad', 'TEI', '2017-02-23 11:41:19', 'in'),
(12, 'Clave Unica de Registro de Poblacion', 'CURP', '2017-02-23 11:41:19', 'in'),
(13, 'Cedula de Identidad Personal', 'CIP', '2017-02-23 11:41:43', 'in'),
(14, 'Cedula de Identidad Civil', 'CIC/CI', '2017-02-23 11:42:20', 'in'),
(15, 'Cedula de Identidad y Electoral', 'CIE', '2017-02-23 11:42:20', 'in'),
(16, 'Passport Card', 'PASSC', '2017-02-23 11:42:34', 'ac');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbapp_type_account`
--

CREATE TABLE `tbapp_type_account` (
  `id` int(11) NOT NULL,
  `_account` varchar(254) NOT NULL,
  `_account_status` enum('ac','in') NOT NULL DEFAULT 'ac',
  `_account_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbapp_type_account`
--

INSERT INTO `tbapp_type_account` (`id`, `_account`, `_account_status`, `_account_create`) VALUES
(1, 'Freelance', 'ac', '2017-02-14 13:54:03'),
(2, 'Empleador', 'ac', '2017-02-14 13:54:03');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tbapp_country`
--
ALTER TABLE `tbapp_country`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tbapp_registeruser_app`
--
ALTER TABLE `tbapp_registeruser_app`
  ADD PRIMARY KEY (`id`),
  ADD KEY `_account_id` (`_account_id`),
  ADD KEY `_country_id` (`_country_id`);

--
-- Indices de la tabla `tbapp_registeruser_app_other_info`
--
ALTER TABLE `tbapp_registeruser_app_other_info`
  ADD PRIMARY KEY (`id`),
  ADD KEY `_IDUser` (`_IDUser`),
  ADD KEY `_IDTypeid` (`_IDTypeid`);

--
-- Indices de la tabla `tbapp_sessions`
--
ALTER TABLE `tbapp_sessions`
  ADD KEY `ci_sessions_timestamp` (`timestamp`);

--
-- Indices de la tabla `tbapp_typeid`
--
ALTER TABLE `tbapp_typeid`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tbapp_type_account`
--
ALTER TABLE `tbapp_type_account`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tbapp_country`
--
ALTER TABLE `tbapp_country`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `tbapp_registeruser_app`
--
ALTER TABLE `tbapp_registeruser_app`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `tbapp_registeruser_app_other_info`
--
ALTER TABLE `tbapp_registeruser_app_other_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tbapp_typeid`
--
ALTER TABLE `tbapp_typeid`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT de la tabla `tbapp_type_account`
--
ALTER TABLE `tbapp_type_account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tbapp_registeruser_app`
--
ALTER TABLE `tbapp_registeruser_app`
  ADD CONSTRAINT `tbapp_registeruser_app_ibfk_1` FOREIGN KEY (`_account_id`) REFERENCES `tbapp_type_account` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tbapp_registeruser_app_ibfk_2` FOREIGN KEY (`_country_id`) REFERENCES `tbapp_country` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `tbapp_registeruser_app_other_info`
--
ALTER TABLE `tbapp_registeruser_app_other_info`
  ADD CONSTRAINT `tbapp_registeruser_app_other_info_ibfk_1` FOREIGN KEY (`_IDTypeid`) REFERENCES `tbapp_typeid` (`id`),
  ADD CONSTRAINT `tbapp_registeruser_app_other_info_ibfk_2` FOREIGN KEY (`_IDUser`) REFERENCES `tbapp_registeruser_app` (`id`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;