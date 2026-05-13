SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Base de données : `livreor_web1`
--
DROP DATABASE IF EXISTS `livreor_web1`;
CREATE DATABASE IF NOT EXISTS `livreor_web1` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `livreor_web1`;

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

DROP TABLE IF EXISTS `message`;
CREATE TABLE IF NOT EXISTS `message` (
  `id_message` mediumint(9) NOT NULL AUTO_INCREMENT,
  `email_message` varchar(100) NOT NULL,
  `texte_message` varchar(800) NOT NULL,
  `date_message` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_message`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
SET FOREIGN_KEY_CHECKS=1;
COMMIT;