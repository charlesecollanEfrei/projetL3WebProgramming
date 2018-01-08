-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Client :  localhost:8889
-- Généré le :  Ven 19 Mai 2017 à 04:36
-- Version du serveur :  5.6.35
-- Version de PHP :  7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données :  `hotel`
--

-- --------------------------------------------------------

--
-- Structure de la table `BILL`
--

CREATE TABLE `BILL` (
  `id_bill` int(11) NOT NULL,
  `price_bill` float NOT NULL,
  `discount_bill` float NOT NULL,
  `final_price_bill` float NOT NULL,
  `id_booking` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `BILL`
--

INSERT INTO `BILL` (`id_bill`, `price_bill`, `discount_bill`, `final_price_bill`, `id_booking`) VALUES
(1, 825, 45, 780, 1),
(2, 825, 45, 780, 1),
(3, 825, 0, 825, 1),
(4, 53250, 100, 53150, 6),
(5, 340, 40, 300, 7);

-- --------------------------------------------------------

--
-- Structure de la table `BOOKING`
--

CREATE TABLE `BOOKING` (
  `id_booking` int(11) NOT NULL,
  `booking_date_booking` date NOT NULL,
  `check_in_booking` date NOT NULL,
  `check_out_booking` date NOT NULL,
  `people_booking` int(11) NOT NULL,
  `status` int(11) NOT NULL COMMENT '0 = Booking, 1 = Check In, 2 = Check Out',
  `id_customer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `BOOKING`
--

INSERT INTO `BOOKING` (`id_booking`, `booking_date_booking`, `check_in_booking`, `check_out_booking`, `people_booking`, `status`, `id_customer`) VALUES
(1, '2017-04-22', '2017-04-22', '2017-04-27', 1, 0, 1),
(5, '2017-05-01', '2017-05-01', '2017-05-02', 1, 0, 6),
(6, '2017-05-01', '2017-06-05', '2017-06-12', 2, 0, 7),
(7, '2017-05-19', '2017-05-27', '2017-05-30', 1, 1, 8);

-- --------------------------------------------------------

--
-- Structure de la table `CATEGORY`
--

CREATE TABLE `CATEGORY` (
  `id_category` int(11) NOT NULL,
  `name_category` varchar(255) NOT NULL,
  `floor_category` int(11) NOT NULL,
  `max_people_category` int(11) NOT NULL,
  `smoking_category` tinyint(1) NOT NULL,
  `price_category` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `CATEGORY`
--

INSERT INTO `CATEGORY` (`id_category`, `name_category`, `floor_category`, `max_people_category`, `smoking_category`, `price_category`) VALUES
(1, 'Deluxe - 2', 5, 2, 0, 50),
(2, 'Deluxe - 4', 5, 4, 0, 80),
(3, 'Presidential', 60, 8, 0, 4000),
(4, 'Suite', 18, 4, 0, 400);

-- --------------------------------------------------------

--
-- Structure de la table `CUSTOMER`
--

CREATE TABLE `CUSTOMER` (
  `id_customer` int(11) NOT NULL,
  `first_name_customer` varchar(255) NOT NULL,
  `last_name_customer` varchar(255) NOT NULL,
  `e_mail_customer` varchar(255) NOT NULL,
  `phone_customer` varchar(255) NOT NULL,
  `address_customer` varchar(255) NOT NULL,
  `city_customer` varchar(255) NOT NULL,
  `country_customer` varchar(255) NOT NULL,
  `passport_customer` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `CUSTOMER`
--

INSERT INTO `CUSTOMER` (`id_customer`, `first_name_customer`, `last_name_customer`, `e_mail_customer`, `phone_customer`, `address_customer`, `city_customer`, `country_customer`, `passport_customer`) VALUES
(1, 'David', 'Ha', 'david.ha@gmail.coms', '+33183039848', 'av. street garden', 'Paris', 'France', 'PL09SNJS6'),
(2, '', '', '', '', '', '', '', ''),
(3, 'Nathalie', 'Alonso', 'nathalie.alonso@mail.com', '+336392836472', 'av. street queen', 'Kuala Lumpur', 'Malaysia', '87HQGQ53'),
(4, 'Bernard', 'Henri', 'benard.henri@mail.com', '+334722627494', '78 av. Kuala', 'Singapor', 'Singapor', '877YSHHSJS'),
(5, 'Henri', 'Monsinieur', 'henri@mail.com', '+334549283844', 'Castle Versailles', 'Paris', 'France', '887S7HSUIQQIU7'),
(6, 'kkk', 'kkkk', 'kkkk@ll.fr', 'llll', 'lllll', 'llll', 'lll', 'lll'),
(7, 'Charles', 'Ecollan', 'charles.ecollan@outlook.com', '+33614360621', '48 rue des rabats', 'Antony', 'France', '1JHUS777S'),
(8, 'hhiih', 'hhiii', 'hii@outlook.com', '+33444555', '8HHH', 'iiihi', 'jijji', '876SJJS');

-- --------------------------------------------------------

--
-- Structure de la table `EMPLOYEE`
--

CREATE TABLE `EMPLOYEE` (
  `id_employee` int(11) NOT NULL,
  `first_name_employee` varchar(255) NOT NULL,
  `last_name_employee` varchar(255) NOT NULL,
  `e_mail_employee` varchar(255) NOT NULL,
  `phone_employee` varchar(255) NOT NULL,
  `job_employee` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `id_hotel` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `EMPLOYEE`
--

INSERT INTO `EMPLOYEE` (`id_employee`, `first_name_employee`, `last_name_employee`, `e_mail_employee`, `phone_employee`, `job_employee`, `password`, `id_hotel`) VALUES
(1, 'Charles', 'Ecollan', 'charles.ecollan@outlook.com', '+33614360621', 'administrator', 'azerty', 1),
(2, 'David', 'Ha', 'david.ha@gmail.com', '+33100000001', 'receptionist', 'azerty', 1);

-- --------------------------------------------------------

--
-- Structure de la table `EXTRAS`
--

CREATE TABLE `EXTRAS` (
  `id_extras` int(11) NOT NULL,
  `name_extras` varchar(255) NOT NULL,
  `price_extras` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `EXTRAS`
--

INSERT INTO `EXTRAS` (`id_extras`, `name_extras`, `price_extras`) VALUES
(2, 'Massage', 200),
(3, 'Diner', 375),
(4, 'Massage', 250),
(5, 'Gift', 25000),
(6, 'Massage', 100);

-- --------------------------------------------------------

--
-- Structure de la table `HOTEL`
--

CREATE TABLE `HOTEL` (
  `id_hotel` int(11) NOT NULL,
  `nom_hotel` varchar(255) NOT NULL,
  `address_hotel` varchar(255) NOT NULL,
  `city_hotel` varchar(255) NOT NULL,
  `country_hotel` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `HOTEL`
--

INSERT INTO `HOTEL` (`id_hotel`, `nom_hotel`, `address_hotel`, `city_hotel`, `country_hotel`) VALUES
(1, 'Charli Hotel', '337 Avenue Foch', 'Paris', 'France');

-- --------------------------------------------------------

--
-- Structure de la table `ROOM`
--

CREATE TABLE `ROOM` (
  `id_room` int(11) NOT NULL,
  `phone_room` varchar(25) NOT NULL,
  `id_hotel` int(11) NOT NULL,
  `id_category` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `ROOM`
--

INSERT INTO `ROOM` (`id_room`, `phone_room`, `id_hotel`, `id_category`) VALUES
(1, '+33123456789', 1, 1),
(2, '+3309876543', 1, 1),
(3, '+33167041654', 1, 2),
(4, '+33187408765', 1, 3),
(5, '+33183039849', 1, 2),
(6, '+3367282828228', 1, 1),
(7, '+6373839294', 1, 2),
(8, '+4444444', 1, 4);

-- --------------------------------------------------------

--
-- Structure de la table `to_concern`
--

CREATE TABLE `to_concern` (
  `id_booking` int(11) NOT NULL,
  `id_room` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `to_concern`
--

INSERT INTO `to_concern` (`id_booking`, `id_room`) VALUES
(5, 1),
(7, 3),
(6, 4);

-- --------------------------------------------------------

--
-- Structure de la table `to_use`
--

CREATE TABLE `to_use` (
  `id_extras` int(11) NOT NULL,
  `id_booking` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `to_use`
--

INSERT INTO `to_use` (`id_extras`, `id_booking`) VALUES
(2, 1),
(3, 1),
(4, 6),
(5, 6),
(6, 7);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `BILL`
--
ALTER TABLE `BILL`
  ADD PRIMARY KEY (`id_bill`),
  ADD KEY `FK_BILL_id_booking` (`id_booking`);

--
-- Index pour la table `BOOKING`
--
ALTER TABLE `BOOKING`
  ADD PRIMARY KEY (`id_booking`),
  ADD KEY `FK_BOOKING_id_customer` (`id_customer`);

--
-- Index pour la table `CATEGORY`
--
ALTER TABLE `CATEGORY`
  ADD PRIMARY KEY (`id_category`);

--
-- Index pour la table `CUSTOMER`
--
ALTER TABLE `CUSTOMER`
  ADD PRIMARY KEY (`id_customer`);

--
-- Index pour la table `EMPLOYEE`
--
ALTER TABLE `EMPLOYEE`
  ADD PRIMARY KEY (`id_employee`),
  ADD KEY `FK_EMPLOYEE_id_hotel` (`id_hotel`);

--
-- Index pour la table `EXTRAS`
--
ALTER TABLE `EXTRAS`
  ADD PRIMARY KEY (`id_extras`);

--
-- Index pour la table `HOTEL`
--
ALTER TABLE `HOTEL`
  ADD PRIMARY KEY (`id_hotel`);

--
-- Index pour la table `ROOM`
--
ALTER TABLE `ROOM`
  ADD PRIMARY KEY (`id_room`),
  ADD KEY `FK_ROOM_id_hotel` (`id_hotel`),
  ADD KEY `FK_ROOM_id_category` (`id_category`);

--
-- Index pour la table `to_concern`
--
ALTER TABLE `to_concern`
  ADD PRIMARY KEY (`id_booking`,`id_room`),
  ADD KEY `FK_to_concern_id_room` (`id_room`);

--
-- Index pour la table `to_use`
--
ALTER TABLE `to_use`
  ADD PRIMARY KEY (`id_extras`,`id_booking`),
  ADD KEY `FK_to_use_id_booking` (`id_booking`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `BILL`
--
ALTER TABLE `BILL`
  MODIFY `id_bill` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `BOOKING`
--
ALTER TABLE `BOOKING`
  MODIFY `id_booking` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT pour la table `CATEGORY`
--
ALTER TABLE `CATEGORY`
  MODIFY `id_category` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `CUSTOMER`
--
ALTER TABLE `CUSTOMER`
  MODIFY `id_customer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT pour la table `EMPLOYEE`
--
ALTER TABLE `EMPLOYEE`
  MODIFY `id_employee` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `EXTRAS`
--
ALTER TABLE `EXTRAS`
  MODIFY `id_extras` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `HOTEL`
--
ALTER TABLE `HOTEL`
  MODIFY `id_hotel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `ROOM`
--
ALTER TABLE `ROOM`
  MODIFY `id_room` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `BILL`
--
ALTER TABLE `BILL`
  ADD CONSTRAINT `FK_BILL_id_booking` FOREIGN KEY (`id_booking`) REFERENCES `BOOKING` (`id_booking`);

--
-- Contraintes pour la table `BOOKING`
--
ALTER TABLE `BOOKING`
  ADD CONSTRAINT `FK_BOOKING_id_customer` FOREIGN KEY (`id_customer`) REFERENCES `CUSTOMER` (`id_customer`);

--
-- Contraintes pour la table `EMPLOYEE`
--
ALTER TABLE `EMPLOYEE`
  ADD CONSTRAINT `FK_EMPLOYEE_id_hotel` FOREIGN KEY (`id_hotel`) REFERENCES `HOTEL` (`id_hotel`);

--
-- Contraintes pour la table `ROOM`
--
ALTER TABLE `ROOM`
  ADD CONSTRAINT `FK_ROOM_id_category` FOREIGN KEY (`id_category`) REFERENCES `CATEGORY` (`id_category`),
  ADD CONSTRAINT `FK_ROOM_id_hotel` FOREIGN KEY (`id_hotel`) REFERENCES `HOTEL` (`id_hotel`);

--
-- Contraintes pour la table `to_concern`
--
ALTER TABLE `to_concern`
  ADD CONSTRAINT `FK_to_concern_id_booking` FOREIGN KEY (`id_booking`) REFERENCES `BOOKING` (`id_booking`),
  ADD CONSTRAINT `FK_to_concern_id_room` FOREIGN KEY (`id_room`) REFERENCES `ROOM` (`id_room`);

--
-- Contraintes pour la table `to_use`
--
ALTER TABLE `to_use`
  ADD CONSTRAINT `FK_to_use_id_booking` FOREIGN KEY (`id_booking`) REFERENCES `BOOKING` (`id_booking`),
  ADD CONSTRAINT `FK_to_use_id_extras` FOREIGN KEY (`id_extras`) REFERENCES `EXTRAS` (`id_extras`);
