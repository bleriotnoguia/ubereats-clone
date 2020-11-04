-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Sam 12 Octobre 2019 à 11:24
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `ubereats`
--

-- --------------------------------------------------------

--
-- Structure de la table `addresses`
--

CREATE TABLE IF NOT EXISTS `addresses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` text,
  `addressable_id` int(11) NOT NULL,
  `addressable_type` varchar(255) NOT NULL,
  `gmap_address` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=85 ;

--
-- Contenu de la table `addresses`
--

INSERT INTO `addresses` (`id`, `description`, `addressable_id`, `addressable_type`, `gmap_address`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'une desasss', 1, 'App\\Models\\User', NULL, '2019-07-01 14:13:02', '2019-08-29 12:39:19', NULL),
(2, NULL, 2, 'App\\Models\\User', NULL, '2019-07-03 10:56:51', '2019-07-03 10:56:51', NULL),
(3, 'une description', 3, 'App\\Models\\User', '{"address_components":[{"long_name":"Avenue King Akwa","short_name":"Ave King Akwa","types":["route"]},{"long_name":"Akwa I","short_name":"Akwa I","types":["political","sublocality","sublocality_level_1"]},{"long_name":"Douala","short_name":"Douala","types":["locality","political"]},{"long_name":"Wouri","short_name":"Wouri","types":["administrative_area_level_2","political"]},{"long_name":"Littoral","short_name":"Littoral","types":["administrative_area_level_1","political"]},{"long_name":"Cameroun","short_name":"CM","types":["country","political"]}],"formatted_address":"Ave King Akwa, Douala, Cameroun","geometry":{"bounds":{"south":4.0510873,"west":9.69832580000002,"north":4.0517908,"east":9.698835499999973},"location":{"lat":4.051439300000001,"lng":9.698580300000003},"location_type":"GEOMETRIC_CENTER","viewport":{"south":4.050090069708498,"west":9.697231669708458,"north":4.052788030291502,"east":9.699929630291535}},"place_id":"ChIJpQfSe_USYRARJBesWRC5PAs","types":["route"]}', '2019-07-03 10:57:20', '2019-08-26 15:20:06', NULL),
(4, 'une maison en construction', 8, 'App\\Models\\User', NULL, '2019-07-03 12:37:49', '2019-07-03 12:52:35', NULL),
(5, NULL, 5, 'App\\Models\\User', '{"address_components":[{"long_name":"Unnamed Road","short_name":"Unnamed Road","types":["route"]},{"long_name":"Akwa II","short_name":"Akwa II","types":["political","sublocality","sublocality_level_1"]},{"long_name":"Douala","short_name":"Douala","types":["locality","political"]},{"long_name":"Wouri","short_name":"Wouri","types":["administrative_area_level_2","political"]},{"long_name":"Littoral","short_name":"Littoral","types":["administrative_area_level_1","political"]},{"long_name":"Cameroun","short_name":"CM","types":["country","political"]}],"formatted_address":"Unnamed Road, Douala, Cameroun","geometry":{"bounds":{"south":4.047714399999999,"west":9.70806319999997,"north":4.0483993,"east":9.709397800000033},"location":{"lat":4.0480731,"lng":9.708722099999932},"location_type":"GEOMETRIC_CENTER","viewport":{"south":4.046707869708497,"west":9.70738151970852,"north":4.049405830291501,"east":9.710079480291483}},"place_id":"ChIJhSprGIkSYRARcIc5nJKcQ6A","types":["route"]}', '2019-07-03 12:45:41', '2019-09-26 13:48:42', NULL),
(6, 'une desc', 1, 'App\\Models\\Restaurant', '{"address_components":[{"long_name":"Douala","short_name":"Douala","types":["locality","political"]},{"long_name":"Cameroun","short_name":"CM","types":["country","political"]}],"formatted_address":"Rue Ernest BETOTE Akwa, Douala, Cameroun","geometry":{"location":{"lat":4.047312,"lng":9.697728999999981},"location_type":"GEOMETRIC_CENTER","viewport":{"south":4.045963019708497,"west":9.6963800197085,"north":4.048660980291502,"east":9.699077980291463}},"place_id":"ChIJuTyHjqMTYRARQxusbjF_veI","plus_code":{"compound_code":"2MWX+W3 Douala, Cameroun","global_code":"6FPF2MWX+W3"},"types":["establishment","point_of_interest"]}', '2019-07-03 13:46:37', '2019-10-11 07:51:10', NULL),
(7, 'une descr', 2, 'App\\Models\\Restaurant', '{"address_components":[{"long_name":"Rue Bertaut","short_name":"Rue Bertaut","types":["route"]},{"long_name":"Akwa II","short_name":"Akwa II","types":["political","sublocality","sublocality_level_1"]},{"long_name":"Douala","short_name":"Douala","types":["locality","political"]},{"long_name":"Wouri","short_name":"Wouri","types":["administrative_area_level_2","political"]},{"long_name":"Littoral","short_name":"Littoral","types":["administrative_area_level_1","political"]},{"long_name":"Cameroun","short_name":"CM","types":["country","political"]}],"formatted_address":"Rue Bertaut, Douala, Cameroun","geometry":{"bounds":{"south":4.0378642,"west":9.693729399999938,"north":4.0378832,"east":9.694779899999958},"location":{"lat":4.0378737,"lng":9.694254600000022},"location_type":"GEOMETRIC_CENTER","viewport":{"south":4.036524719708498,"west":9.692905669708466,"north":4.039222680291502,"east":9.695603630291544}},"place_id":"ChIJK_Jlvu4SYRARJEZbgsHeSos","types":["route"]}', '2019-07-03 13:50:45', '2019-10-07 13:33:50', NULL),
(8, 'une desc', 18, 'App\\Models\\Restaurant', '{"address_components":[{"long_name":"Boulevard de la R\\u00e9publique","short_name":"Boulevard de la R\\u00e9publique","types":["route"]},{"long_name":"Akwa II","short_name":"Akwa II","types":["political","sublocality","sublocality_level_1"]},{"long_name":"Douala","short_name":"Douala","types":["locality","political"]},{"long_name":"Wouri","short_name":"Wouri","types":["administrative_area_level_2","political"]},{"long_name":"R\\u00e9gion du Littoral","short_name":"R\\u00e9gion du Littoral","types":["administrative_area_level_1","political"]},{"long_name":"Cameroun","short_name":"CM","types":["country","political"]}],"formatted_address":"Boulevard de la R\\u00e9publique, Douala, Cameroun","geometry":{"bounds":{"south":4.0505515,"west":9.702479900000071,"north":4.051139099999999,"east":9.702970600000071},"location":{"lat":4.0508453,"lng":9.702725200000032},"location_type":"GEOMETRIC_CENTER","viewport":{"south":4.049496319708497,"west":9.701376269708476,"north":4.052194280291502,"east":9.704074230291553}},"place_id":"ChIJw6VQkYoSYRAR3DogC_mEeA4","types":["route"]}', '2019-07-03 13:51:47', '2019-08-19 13:27:20', NULL),
(9, NULL, 19, 'App\\Models\\Restaurant', NULL, '2019-07-03 13:55:03', '2019-09-16 07:59:56', NULL),
(10, 'descrip', 1, 'App\\Models\\Shipping', '{"address_components":[{"long_name":"Boulevard de la Libert\\u00e9","short_name":"Boulevard de la Libert\\u00e9","types":["route"]},{"long_name":"Akwa I","short_name":"Akwa I","types":["political","sublocality","sublocality_level_1"]},{"long_name":"Douala","short_name":"Douala","types":["locality","political"]},{"long_name":"Wouri","short_name":"Wouri","types":["administrative_area_level_2","political"]},{"long_name":"R\\u00e9gion du Littoral","short_name":"R\\u00e9gion du Littoral","types":["administrative_area_level_1","political"]},{"long_name":"Cameroun","short_name":"CM","types":["country","political"]}],"formatted_address":"Boulevard de la Libert\\u00e9, Douala, Cameroun","geometry":{"bounds":{"south":4.0480607,"west":9.694293000000016,"north":4.0486447,"east":9.694518700000003},"location":{"lat":4.0483515,"lng":9.69440910000003},"location_type":"GEOMETRIC_CENTER","viewport":{"south":4.047003719708497,"west":9.693056869708471,"north":4.049701680291502,"east":9.695754830291435}},"place_id":"ChIJwUx8lvYSYRARomqM6GNiprI","types":["route"]}', '2019-07-04 08:19:02', '2019-07-04 08:19:02', NULL),
(11, 'une description', 8, 'App\\Models\\Shipping', '{"address_components":[{"long_name":"Boulevard de la Libert\\u00e9","short_name":"Boulevard de la Libert\\u00e9","types":["route"]},{"long_name":"Akwa I","short_name":"Akwa I","types":["political","sublocality","sublocality_level_1"]},{"long_name":"Douala","short_name":"Douala","types":["locality","political"]},{"long_name":"Wouri","short_name":"Wouri","types":["administrative_area_level_2","political"]},{"long_name":"R\\u00e9gion du Littoral","short_name":"R\\u00e9gion du Littoral","types":["administrative_area_level_1","political"]},{"long_name":"Cameroun","short_name":"CM","types":["country","political"]}],"formatted_address":"Boulevard de la Libert\\u00e9, Douala, Cameroun","geometry":{"bounds":{"south":4.0480607,"west":9.694293000000016,"north":4.0486447,"east":9.694518700000003},"location":{"lat":4.0483515,"lng":9.69440910000003},"location_type":"GEOMETRIC_CENTER","viewport":{"south":4.047003719708497,"west":9.693056869708471,"north":4.049701680291502,"east":9.695754830291435}},"place_id":"ChIJwUx8lvYSYRARomqM6GNiprI","types":["route"]}', '2019-07-04 08:24:44', '2019-07-04 08:24:44', NULL),
(12, 'une description', 7, 'App\\Models\\Shipping', '{"address_components":[{"long_name":"Rue Bertaut","short_name":"Rue Bertaut","types":["route"]},{"long_name":"Akwa II","short_name":"Akwa II","types":["political","sublocality","sublocality_level_1"]},{"long_name":"Douala","short_name":"Douala","types":["locality","political"]},{"long_name":"Wouri","short_name":"Wouri","types":["administrative_area_level_2","political"]},{"long_name":"Littoral","short_name":"Littoral","types":["administrative_area_level_1","political"]},{"long_name":"Cameroun","short_name":"CM","types":["country","political"]}],"formatted_address":"Rue Bertaut, Douala, Cameroun","geometry":{"bounds":{"south":4.0378642,"west":9.693729399999938,"north":4.0378832,"east":9.694779899999958},"location":{"lat":4.0378737,"lng":9.694254600000022},"location_type":"GEOMETRIC_CENTER","viewport":{"south":4.036524719708498,"west":9.692905669708466,"north":4.039222680291502,"east":9.695603630291544}},"place_id":"ChIJK_Jlvu4SYRARJEZbgsHeSos","types":["route"]}', '2019-07-04 08:24:55', '2019-07-04 08:24:55', NULL),
(13, 'une description', 6, 'App\\Models\\Shipping', '{"address_components":[{"long_name":"Boulevard de la Libert\\u00e9","short_name":"Boulevard de la Libert\\u00e9","types":["route"]},{"long_name":"Akwa I","short_name":"Akwa I","types":["political","sublocality","sublocality_level_1"]},{"long_name":"Douala","short_name":"Douala","types":["locality","political"]},{"long_name":"Wouri","short_name":"Wouri","types":["administrative_area_level_2","political"]},{"long_name":"R\\u00e9gion du Littoral","short_name":"R\\u00e9gion du Littoral","types":["administrative_area_level_1","political"]},{"long_name":"Cameroun","short_name":"CM","types":["country","political"]}],"formatted_address":"Boulevard de la Libert\\u00e9, Douala, Cameroun","geometry":{"bounds":{"south":4.0480607,"west":9.694293000000016,"north":4.0486447,"east":9.694518700000003},"location":{"lat":4.0483515,"lng":9.69440910000003},"location_type":"GEOMETRIC_CENTER","viewport":{"south":4.047003719708497,"west":9.693056869708471,"north":4.049701680291502,"east":9.695754830291435}},"place_id":"ChIJwUx8lvYSYRARomqM6GNiprI","types":["route"]}', '2019-07-04 08:25:05', '2019-07-04 08:25:05', NULL),
(14, 'une description', 5, 'App\\Models\\Shipping', '{"address_components":[{"long_name":"Rue Bertaut","short_name":"Rue Bertaut","types":["route"]},{"long_name":"Akwa II","short_name":"Akwa II","types":["political","sublocality","sublocality_level_1"]},{"long_name":"Douala","short_name":"Douala","types":["locality","political"]},{"long_name":"Wouri","short_name":"Wouri","types":["administrative_area_level_2","political"]},{"long_name":"Littoral","short_name":"Littoral","types":["administrative_area_level_1","political"]},{"long_name":"Cameroun","short_name":"CM","types":["country","political"]}],"formatted_address":"Rue Bertaut, Douala, Cameroun","geometry":{"bounds":{"south":4.0378642,"west":9.693729399999938,"north":4.0378832,"east":9.694779899999958},"location":{"lat":4.0378737,"lng":9.694254600000022},"location_type":"GEOMETRIC_CENTER","viewport":{"south":4.036524719708498,"west":9.692905669708466,"north":4.039222680291502,"east":9.695603630291544}},"place_id":"ChIJK_Jlvu4SYRARJEZbgsHeSos","types":["route"]}', '2019-07-04 08:25:14', '2019-07-04 08:25:14', NULL),
(15, 'une description', 4, 'App\\Models\\Shipping', '{"address_components":[{"long_name":"Rue Bertaut","short_name":"Rue Bertaut","types":["route"]},{"long_name":"Akwa II","short_name":"Akwa II","types":["political","sublocality","sublocality_level_1"]},{"long_name":"Douala","short_name":"Douala","types":["locality","political"]},{"long_name":"Wouri","short_name":"Wouri","types":["administrative_area_level_2","political"]},{"long_name":"Littoral","short_name":"Littoral","types":["administrative_area_level_1","political"]},{"long_name":"Cameroun","short_name":"CM","types":["country","political"]}],"formatted_address":"Rue Bertaut, Douala, Cameroun","geometry":{"bounds":{"south":4.0378642,"west":9.693729399999938,"north":4.0378832,"east":9.694779899999958},"location":{"lat":4.0378737,"lng":9.694254600000022},"location_type":"GEOMETRIC_CENTER","viewport":{"south":4.036524719708498,"west":9.692905669708466,"north":4.039222680291502,"east":9.695603630291544}},"place_id":"ChIJK_Jlvu4SYRARJEZbgsHeSos","types":["route"]}', '2019-07-04 08:25:23', '2019-07-04 08:25:23', NULL),
(16, 'une description', 12, 'App\\Models\\Shipping', '{"address_components":[{"long_name":"Boulevard de la Libert\\u00e9","short_name":"Boulevard de la Libert\\u00e9","types":["route"]},{"long_name":"Akwa I","short_name":"Akwa I","types":["political","sublocality","sublocality_level_1"]},{"long_name":"Douala","short_name":"Douala","types":["locality","political"]},{"long_name":"Wouri","short_name":"Wouri","types":["administrative_area_level_2","political"]},{"long_name":"R\\u00e9gion du Littoral","short_name":"R\\u00e9gion du Littoral","types":["administrative_area_level_1","political"]},{"long_name":"Cameroun","short_name":"CM","types":["country","political"]}],"formatted_address":"Boulevard de la Libert\\u00e9, Douala, Cameroun","geometry":{"bounds":{"south":4.0480607,"west":9.694293000000016,"north":4.0486447,"east":9.694518700000003},"location":{"lat":4.0483515,"lng":9.69440910000003},"location_type":"GEOMETRIC_CENTER","viewport":{"south":4.047003719708497,"west":9.693056869708471,"north":4.049701680291502,"east":9.695754830291435}},"place_id":"ChIJwUx8lvYSYRARomqM6GNiprI","types":["route"]}', '2019-07-04 08:38:45', '2019-07-04 08:38:45', NULL),
(17, 'une description', 11, 'App\\Models\\Shipping', '{"address_components":[{"long_name":"Boulevard de la Libert\\u00e9","short_name":"Boulevard de la Libert\\u00e9","types":["route"]},{"long_name":"Akwa I","short_name":"Akwa I","types":["political","sublocality","sublocality_level_1"]},{"long_name":"Douala","short_name":"Douala","types":["locality","political"]},{"long_name":"Wouri","short_name":"Wouri","types":["administrative_area_level_2","political"]},{"long_name":"R\\u00e9gion du Littoral","short_name":"R\\u00e9gion du Littoral","types":["administrative_area_level_1","political"]},{"long_name":"Cameroun","short_name":"CM","types":["country","political"]}],"formatted_address":"Boulevard de la Libert\\u00e9, Douala, Cameroun","geometry":{"bounds":{"south":4.0480607,"west":9.694293000000016,"north":4.0486447,"east":9.694518700000003},"location":{"lat":4.0483515,"lng":9.69440910000003},"location_type":"GEOMETRIC_CENTER","viewport":{"south":4.047003719708497,"west":9.693056869708471,"north":4.049701680291502,"east":9.695754830291435}},"place_id":"ChIJwUx8lvYSYRARomqM6GNiprI","types":["route"]}', '2019-07-04 08:43:32', '2019-07-04 08:43:32', NULL),
(18, 'une description', 2, 'App\\Models\\Shipping', '{"address_components":[{"long_name":"Rue Bertaut","short_name":"Rue Bertaut","types":["route"]},{"long_name":"Akwa II","short_name":"Akwa II","types":["political","sublocality","sublocality_level_1"]},{"long_name":"Douala","short_name":"Douala","types":["locality","political"]},{"long_name":"Wouri","short_name":"Wouri","types":["administrative_area_level_2","political"]},{"long_name":"Littoral","short_name":"Littoral","types":["administrative_area_level_1","political"]},{"long_name":"Cameroun","short_name":"CM","types":["country","political"]}],"formatted_address":"Rue Bertaut, Douala, Cameroun","geometry":{"bounds":{"south":4.0378642,"west":9.693729399999938,"north":4.0378832,"east":9.694779899999958},"location":{"lat":4.0378737,"lng":9.694254600000022},"location_type":"GEOMETRIC_CENTER","viewport":{"south":4.036524719708498,"west":9.692905669708466,"north":4.039222680291502,"east":9.695603630291544}},"place_id":"ChIJK_Jlvu4SYRARJEZbgsHeSos","types":["route"]}', '2019-07-04 08:46:10', '2019-07-04 08:46:10', NULL),
(19, 'une description', 13, 'App\\Models\\Shipping', '{"address_components":[{"long_name":"Boulevard de la Libert\\u00e9","short_name":"Boulevard de la Libert\\u00e9","types":["route"]},{"long_name":"Akwa I","short_name":"Akwa I","types":["political","sublocality","sublocality_level_1"]},{"long_name":"Douala","short_name":"Douala","types":["locality","political"]},{"long_name":"Wouri","short_name":"Wouri","types":["administrative_area_level_2","political"]},{"long_name":"R\\u00e9gion du Littoral","short_name":"R\\u00e9gion du Littoral","types":["administrative_area_level_1","political"]},{"long_name":"Cameroun","short_name":"CM","types":["country","political"]}],"formatted_address":"Boulevard de la Libert\\u00e9, Douala, Cameroun","geometry":{"bounds":{"south":4.0480607,"west":9.694293000000016,"north":4.0486447,"east":9.694518700000003},"location":{"lat":4.0483515,"lng":9.69440910000003},"location_type":"GEOMETRIC_CENTER","viewport":{"south":4.047003719708497,"west":9.693056869708471,"north":4.049701680291502,"east":9.695754830291435}},"place_id":"ChIJwUx8lvYSYRARomqM6GNiprI","types":["route"]}', '2019-07-04 08:53:20', '2019-07-04 08:53:20', NULL),
(20, 'une description', 10, 'App\\Models\\Shipping', '{"address_components":[{"long_name":"Boulevard de la Libert\\u00e9","short_name":"Boulevard de la Libert\\u00e9","types":["route"]},{"long_name":"Akwa I","short_name":"Akwa I","types":["political","sublocality","sublocality_level_1"]},{"long_name":"Douala","short_name":"Douala","types":["locality","political"]},{"long_name":"Wouri","short_name":"Wouri","types":["administrative_area_level_2","political"]},{"long_name":"R\\u00e9gion du Littoral","short_name":"R\\u00e9gion du Littoral","types":["administrative_area_level_1","political"]},{"long_name":"Cameroun","short_name":"CM","types":["country","political"]}],"formatted_address":"Boulevard de la Libert\\u00e9, Douala, Cameroun","geometry":{"bounds":{"south":4.0480607,"west":9.694293000000016,"north":4.0486447,"east":9.694518700000003},"location":{"lat":4.0483515,"lng":9.69440910000003},"location_type":"GEOMETRIC_CENTER","viewport":{"south":4.047003719708497,"west":9.693056869708471,"north":4.049701680291502,"east":9.695754830291435}},"place_id":"ChIJwUx8lvYSYRARomqM6GNiprI","types":["route"]}', '2019-07-04 08:57:52', '2019-07-04 08:57:52', NULL),
(21, 'une description', 3, 'App\\Models\\Shipping', '{"address_components":[{"long_name":"Boulevard de la Libert\\u00e9","short_name":"Boulevard de la Libert\\u00e9","types":["route"]},{"long_name":"Akwa I","short_name":"Akwa I","types":["political","sublocality","sublocality_level_1"]},{"long_name":"Douala","short_name":"Douala","types":["locality","political"]},{"long_name":"Wouri","short_name":"Wouri","types":["administrative_area_level_2","political"]},{"long_name":"R\\u00e9gion du Littoral","short_name":"R\\u00e9gion du Littoral","types":["administrative_area_level_1","political"]},{"long_name":"Cameroun","short_name":"CM","types":["country","political"]}],"formatted_address":"Boulevard de la Libert\\u00e9, Douala, Cameroun","geometry":{"bounds":{"south":4.0480607,"west":9.694293000000016,"north":4.0486447,"east":9.694518700000003},"location":{"lat":4.0483515,"lng":9.69440910000003},"location_type":"GEOMETRIC_CENTER","viewport":{"south":4.047003719708497,"west":9.693056869708471,"north":4.049701680291502,"east":9.695754830291435}},"place_id":"ChIJwUx8lvYSYRARomqM6GNiprI","types":["route"]}', '2019-07-04 08:58:00', '2019-07-04 08:58:00', NULL),
(22, 'vers la rue de..', 14, 'App\\Models\\Shipping', '{"address_components":[{"long_name":"Rue Bertaut","short_name":"Rue Bertaut","types":["route"]},{"long_name":"Akwa II","short_name":"Akwa II","types":["political","sublocality","sublocality_level_1"]},{"long_name":"Douala","short_name":"Douala","types":["locality","political"]},{"long_name":"Wouri","short_name":"Wouri","types":["administrative_area_level_2","political"]},{"long_name":"Littoral","short_name":"Littoral","types":["administrative_area_level_1","political"]},{"long_name":"Cameroun","short_name":"CM","types":["country","political"]}],"formatted_address":"Rue Bertaut, Douala, Cameroun","geometry":{"bounds":{"south":4.0378642,"west":9.693729399999938,"north":4.0378832,"east":9.694779899999958},"location":{"lat":4.0378737,"lng":9.694254600000022},"location_type":"GEOMETRIC_CENTER","viewport":{"south":4.036524719708498,"west":9.692905669708466,"north":4.039222680291502,"east":9.695603630291544}},"place_id":"ChIJK_Jlvu4SYRARJEZbgsHeSos","types":["route"]}', '2019-07-05 09:00:43', '2019-07-05 09:01:26', NULL),
(23, 'une description', 17, 'App\\Models\\Shipping', '{"address_components":[{"long_name":"Boulevard de la Libert\\u00e9","short_name":"Boulevard de la Libert\\u00e9","types":["route"]},{"long_name":"Akwa I","short_name":"Akwa I","types":["political","sublocality","sublocality_level_1"]},{"long_name":"Douala","short_name":"Douala","types":["locality","political"]},{"long_name":"Wouri","short_name":"Wouri","types":["administrative_area_level_2","political"]},{"long_name":"R\\u00e9gion du Littoral","short_name":"R\\u00e9gion du Littoral","types":["administrative_area_level_1","political"]},{"long_name":"Cameroun","short_name":"CM","types":["country","political"]}],"formatted_address":"Boulevard de la Libert\\u00e9, Douala, Cameroun","geometry":{"bounds":{"south":4.0480607,"west":9.694293000000016,"north":4.0486447,"east":9.694518700000003},"location":{"lat":4.0483515,"lng":9.69440910000003},"location_type":"GEOMETRIC_CENTER","viewport":{"south":4.047003719708497,"west":9.693056869708471,"north":4.049701680291502,"east":9.695754830291435}},"place_id":"ChIJwUx8lvYSYRARomqM6GNiprI","types":["route"]}', '2019-07-30 15:06:15', '2019-07-30 15:06:15', NULL),
(24, 'une description', 18, 'App\\Models\\Shipping', '{"address_components":[{"long_name":"Boulevard de la Libert\\u00e9","short_name":"Boulevard de la Libert\\u00e9","types":["route"]},{"long_name":"Akwa I","short_name":"Akwa I","types":["political","sublocality","sublocality_level_1"]},{"long_name":"Douala","short_name":"Douala","types":["locality","political"]},{"long_name":"Wouri","short_name":"Wouri","types":["administrative_area_level_2","political"]},{"long_name":"R\\u00e9gion du Littoral","short_name":"R\\u00e9gion du Littoral","types":["administrative_area_level_1","political"]},{"long_name":"Cameroun","short_name":"CM","types":["country","political"]}],"formatted_address":"Boulevard de la Libert\\u00e9, Douala, Cameroun","geometry":{"bounds":{"south":4.0480607,"west":9.694293000000016,"north":4.0486447,"east":9.694518700000003},"location":{"lat":4.0483515,"lng":9.69440910000003},"location_type":"GEOMETRIC_CENTER","viewport":{"south":4.047003719708497,"west":9.693056869708471,"north":4.049701680291502,"east":9.695754830291435}},"place_id":"ChIJwUx8lvYSYRARomqM6GNiprI","types":["route"]}', '2019-07-30 15:14:02', '2019-07-30 15:14:02', NULL),
(25, NULL, 19, 'App\\Models\\Shipping', '{"address_components":[{"long_name":"12498","short_name":"12498","types":["street_number"]},{"long_name":"Rue des \\u00c9coles","short_name":"Rue des \\u00c9coles","types":["route"]},{"long_name":"Akwa I","short_name":"Akwa I","types":["political","sublocality","sublocality_level_1"]},{"long_name":"Douala","short_name":"Douala","types":["locality","political"]},{"long_name":"Wouri","short_name":"Wouri","types":["administrative_area_level_2","political"]},{"long_name":"R\\u00e9gion du Littoral","short_name":"R\\u00e9gion du Littoral","types":["administrative_area_level_1","political"]},{"long_name":"Cameroun","short_name":"CM","types":["country","political"]}],"formatted_address":"12498 Rue des \\u00c9coles, Douala, Cameroun","geometry":{"location":{"lat":4.046096599999999,"lng":9.695526800000039},"location_type":"ROOFTOP","viewport":{"south":4.044747619708497,"west":9.694177819708557,"north":4.047445580291502,"east":9.69687578029152}},"place_id":"ChIJlWlY4vMSYRAR--cW_LY5SO4","plus_code":{"compound_code":"2MWW+C6 Douala, Cameroun","global_code":"6FPF2MWW+C6"},"types":["street_address"]}', '2019-08-01 08:30:00', '2019-08-01 08:30:00', NULL),
(26, NULL, 20, 'App\\Models\\Shipping', '{"address_components":[{"long_name":"12498","short_name":"12498","types":["street_number"]},{"long_name":"Rue des \\u00c9coles","short_name":"Rue des \\u00c9coles","types":["route"]},{"long_name":"Akwa I","short_name":"Akwa I","types":["political","sublocality","sublocality_level_1"]},{"long_name":"Douala","short_name":"Douala","types":["locality","political"]},{"long_name":"Wouri","short_name":"Wouri","types":["administrative_area_level_2","political"]},{"long_name":"R\\u00e9gion du Littoral","short_name":"R\\u00e9gion du Littoral","types":["administrative_area_level_1","political"]},{"long_name":"Cameroun","short_name":"CM","types":["country","political"]}],"formatted_address":"12498 Rue des \\u00c9coles, Douala, Cameroun","geometry":{"location":{"lat":4.045461899999999,"lng":9.694641499999989},"location_type":"ROOFTOP","viewport":{"south":4.044112919708497,"west":9.693292519708507,"north":4.046810880291502,"east":9.69599048029147}},"place_id":"ChIJtdjFaPESYRARlCSfYu1xP4k","plus_code":{"compound_code":"2MWV+5V Douala, Cameroun","global_code":"6FPF2MWV+5V"},"types":["establishment","point_of_interest"]}', '2019-08-01 12:50:10', '2019-08-01 12:50:10', NULL),
(27, NULL, 21, 'App\\Models\\Shipping', '{"address_components":[{"long_name":"Boulevard du President Ahmadou Ahidjo","short_name":"Boulevard du President Ahmadou Ahidjo","types":["route"]},{"long_name":"Akwa I","short_name":"Akwa I","types":["political","sublocality","sublocality_level_1"]},{"long_name":"Douala","short_name":"Douala","types":["locality","political"]},{"long_name":"Wouri","short_name":"Wouri","types":["administrative_area_level_2","political"]},{"long_name":"Littoral","short_name":"Littoral","types":["administrative_area_level_1","political"]},{"long_name":"Cameroun","short_name":"CM","types":["country","political"]}],"formatted_address":"Boulevard du President Ahmadou Ahidjo, Douala, Cameroun","geometry":{"bounds":{"south":4.046075699999999,"west":9.695802400000048,"north":4.0473795,"east":9.698647299999948},"location":{"lat":4.0467907,"lng":9.697253799999999},"location_type":"GEOMETRIC_CENTER","viewport":{"south":4.045378619708497,"west":9.695802400000048,"north":4.048076580291502,"east":9.698647299999948}},"place_id":"ChIJgTmfifMSYRARhs-BpY9r1D0","types":["route"]}', '2019-08-01 13:05:48', '2019-08-01 13:05:48', NULL),
(28, NULL, 22, 'App\\Models\\Shipping', '{"address_components":[{"long_name":"Boulevard du President Ahmadou Ahidjo","short_name":"Boulevard du President Ahmadou Ahidjo","types":["route"]},{"long_name":"Akwa I","short_name":"Akwa I","types":["political","sublocality","sublocality_level_1"]},{"long_name":"Douala","short_name":"Douala","types":["locality","political"]},{"long_name":"Wouri","short_name":"Wouri","types":["administrative_area_level_2","political"]},{"long_name":"Littoral","short_name":"Littoral","types":["administrative_area_level_1","political"]},{"long_name":"Cameroun","short_name":"CM","types":["country","political"]}],"formatted_address":"Boulevard du President Ahmadou Ahidjo, Douala, Cameroun","geometry":{"bounds":{"south":4.046075699999999,"west":9.695802400000048,"north":4.0473795,"east":9.698647299999948},"location":{"lat":4.0467907,"lng":9.697253799999999},"location_type":"GEOMETRIC_CENTER","viewport":{"south":4.045378619708497,"west":9.695802400000048,"north":4.048076580291502,"east":9.698647299999948}},"place_id":"ChIJgTmfifMSYRARhs-BpY9r1D0","types":["route"]}', '2019-08-01 13:09:06', '2019-08-01 13:09:06', NULL),
(29, NULL, 23, 'App\\Models\\Shipping', '{"address_components":[{"long_name":"12498","short_name":"12498","types":["street_number"]},{"long_name":"Rue des \\u00c9coles","short_name":"Rue des \\u00c9coles","types":["route"]},{"long_name":"Akwa I","short_name":"Akwa I","types":["political","sublocality","sublocality_level_1"]},{"long_name":"Douala","short_name":"Douala","types":["locality","political"]},{"long_name":"Wouri","short_name":"Wouri","types":["administrative_area_level_2","political"]},{"long_name":"R\\u00e9gion du Littoral","short_name":"R\\u00e9gion du Littoral","types":["administrative_area_level_1","political"]},{"long_name":"Cameroun","short_name":"CM","types":["country","political"]}],"formatted_address":"12498 Rue des \\u00c9coles, Douala, Cameroun","geometry":{"location":{"lat":4.045461899999999,"lng":9.694641499999989},"location_type":"ROOFTOP","viewport":{"south":4.044112919708497,"west":9.693292519708507,"north":4.046810880291502,"east":9.69599048029147}},"place_id":"ChIJtdjFaPESYRARlCSfYu1xP4k","plus_code":{"compound_code":"2MWV+5V Douala, Cameroun","global_code":"6FPF2MWV+5V"},"types":["establishment","point_of_interest"]}', '2019-08-01 14:58:27', '2019-08-01 14:58:27', NULL),
(30, 'une description', 24, 'App\\Models\\Shipping', '{"address_components":[{"long_name":"Boulevard de la Libert\\u00e9","short_name":"Boulevard de la Libert\\u00e9","types":["route"]},{"long_name":"Akwa I","short_name":"Akwa I","types":["political","sublocality","sublocality_level_1"]},{"long_name":"Douala","short_name":"Douala","types":["locality","political"]},{"long_name":"Wouri","short_name":"Wouri","types":["administrative_area_level_2","political"]},{"long_name":"R\\u00e9gion du Littoral","short_name":"R\\u00e9gion du Littoral","types":["administrative_area_level_1","political"]},{"long_name":"Cameroun","short_name":"CM","types":["country","political"]}],"formatted_address":"Boulevard de la Libert\\u00e9, Douala, Cameroun","geometry":{"bounds":{"south":4.0480607,"west":9.694293000000016,"north":4.0486447,"east":9.694518700000003},"location":{"lat":4.0483515,"lng":9.69440910000003},"location_type":"GEOMETRIC_CENTER","viewport":{"south":4.047003719708497,"west":9.693056869708471,"north":4.049701680291502,"east":9.695754830291435}},"place_id":"ChIJwUx8lvYSYRARomqM6GNiprI","types":["route"]}', '2019-08-07 14:58:14', '2019-08-07 14:58:14', NULL),
(31, 'une description', 25, 'App\\Models\\Shipping', '{"address_components":[{"long_name":"Boulevard de la Libert\\u00e9","short_name":"Boulevard de la Libert\\u00e9","types":["route"]},{"long_name":"Akwa I","short_name":"Akwa I","types":["political","sublocality","sublocality_level_1"]},{"long_name":"Douala","short_name":"Douala","types":["locality","political"]},{"long_name":"Wouri","short_name":"Wouri","types":["administrative_area_level_2","political"]},{"long_name":"R\\u00e9gion du Littoral","short_name":"R\\u00e9gion du Littoral","types":["administrative_area_level_1","political"]},{"long_name":"Cameroun","short_name":"CM","types":["country","political"]}],"formatted_address":"Boulevard de la Libert\\u00e9, Douala, Cameroun","geometry":{"bounds":{"south":4.0480607,"west":9.694293000000016,"north":4.0486447,"east":9.694518700000003},"location":{"lat":4.0483515,"lng":9.69440910000003},"location_type":"GEOMETRIC_CENTER","viewport":{"south":4.047003719708497,"west":9.693056869708471,"north":4.049701680291502,"east":9.695754830291435}},"place_id":"ChIJwUx8lvYSYRARomqM6GNiprI","types":["route"]}', '2019-08-07 15:00:49', '2019-08-07 15:00:49', NULL),
(32, 'une description', 26, 'App\\Models\\Shipping', '{"address_components":[{"long_name":"Boulevard de la Libert\\u00e9","short_name":"Boulevard de la Libert\\u00e9","types":["route"]},{"long_name":"Akwa I","short_name":"Akwa I","types":["political","sublocality","sublocality_level_1"]},{"long_name":"Douala","short_name":"Douala","types":["locality","political"]},{"long_name":"Wouri","short_name":"Wouri","types":["administrative_area_level_2","political"]},{"long_name":"R\\u00e9gion du Littoral","short_name":"R\\u00e9gion du Littoral","types":["administrative_area_level_1","political"]},{"long_name":"Cameroun","short_name":"CM","types":["country","political"]}],"formatted_address":"Boulevard de la Libert\\u00e9, Douala, Cameroun","geometry":{"bounds":{"south":4.0480607,"west":9.694293000000016,"north":4.0486447,"east":9.694518700000003},"location":{"lat":4.0483515,"lng":9.69440910000003},"location_type":"GEOMETRIC_CENTER","viewport":{"south":4.047003719708497,"west":9.693056869708471,"north":4.049701680291502,"east":9.695754830291435}},"place_id":"ChIJwUx8lvYSYRARomqM6GNiprI","types":["route"]}', '2019-08-07 15:01:49', '2019-08-07 15:01:49', NULL),
(33, NULL, 27, 'App\\Models\\Shipping', '{"address_components":[{"long_name":"12498","short_name":"12498","types":["street_number"]},{"long_name":"Rue des \\u00c9coles","short_name":"Rue des \\u00c9coles","types":["route"]},{"long_name":"Akwa I","short_name":"Akwa I","types":["political","sublocality","sublocality_level_1"]},{"long_name":"Douala","short_name":"Douala","types":["locality","political"]},{"long_name":"Wouri","short_name":"Wouri","types":["administrative_area_level_2","political"]},{"long_name":"R\\u00e9gion du Littoral","short_name":"R\\u00e9gion du Littoral","types":["administrative_area_level_1","political"]},{"long_name":"Cameroun","short_name":"CM","types":["country","political"]}],"formatted_address":"12498 Rue des \\u00c9coles, Douala, Cameroun","geometry":{"location":{"lat":4.046096599999999,"lng":9.695526800000039},"location_type":"ROOFTOP","viewport":{"south":4.044747619708497,"west":9.694177819708557,"north":4.047445580291502,"east":9.69687578029152}},"place_id":"ChIJlWlY4vMSYRAR--cW_LY5SO4","plus_code":{"compound_code":"2MWW+C6 Douala, Cameroun","global_code":"6FPF2MWW+C6"},"types":["street_address"]}', '2019-08-13 13:22:10', '2019-08-13 13:22:10', NULL),
(34, 'une description', 28, 'App\\Models\\Shipping', '{"address_components":[{"long_name":"Boulevard de la Libert\\u00e9","short_name":"Boulevard de la Libert\\u00e9","types":["route"]},{"long_name":"Akwa I","short_name":"Akwa I","types":["political","sublocality","sublocality_level_1"]},{"long_name":"Douala","short_name":"Douala","types":["locality","political"]},{"long_name":"Wouri","short_name":"Wouri","types":["administrative_area_level_2","political"]},{"long_name":"R\\u00e9gion du Littoral","short_name":"R\\u00e9gion du Littoral","types":["administrative_area_level_1","political"]},{"long_name":"Cameroun","short_name":"CM","types":["country","political"]}],"formatted_address":"Boulevard de la Libert\\u00e9, Douala, Cameroun","geometry":{"bounds":{"south":4.0480607,"west":9.694293000000016,"north":4.0486447,"east":9.694518700000003},"location":{"lat":4.0483515,"lng":9.69440910000003},"location_type":"GEOMETRIC_CENTER","viewport":{"south":4.047003719708497,"west":9.693056869708471,"north":4.049701680291502,"east":9.695754830291435}},"place_id":"ChIJwUx8lvYSYRARomqM6GNiprI","types":["route"]}', '2019-08-14 08:21:57', '2019-08-14 08:21:57', NULL),
(35, 'une description', 29, 'App\\Models\\Shipping', '{"address_components":[{"long_name":"Boulevard de la Libert\\u00e9","short_name":"Boulevard de la Libert\\u00e9","types":["route"]},{"long_name":"Akwa I","short_name":"Akwa I","types":["political","sublocality","sublocality_level_1"]},{"long_name":"Douala","short_name":"Douala","types":["locality","political"]},{"long_name":"Wouri","short_name":"Wouri","types":["administrative_area_level_2","political"]},{"long_name":"R\\u00e9gion du Littoral","short_name":"R\\u00e9gion du Littoral","types":["administrative_area_level_1","political"]},{"long_name":"Cameroun","short_name":"CM","types":["country","political"]}],"formatted_address":"Boulevard de la Libert\\u00e9, Douala, Cameroun","geometry":{"bounds":{"south":4.0480607,"west":9.694293000000016,"north":4.0486447,"east":9.694518700000003},"location":{"lat":4.0483515,"lng":9.69440910000003},"location_type":"GEOMETRIC_CENTER","viewport":{"south":4.047003719708497,"west":9.693056869708471,"north":4.049701680291502,"east":9.695754830291435}},"place_id":"ChIJwUx8lvYSYRARomqM6GNiprI","types":["route"]}', '2019-08-14 08:22:41', '2019-08-14 08:22:41', NULL),
(36, NULL, 27, 'App\\Models\\Shipping', '{"address_components":[{"long_name":"12498","short_name":"12498","types":["street_number"]},{"long_name":"Rue des \\u00c9coles","short_name":"Rue des \\u00c9coles","types":["route"]},{"long_name":"Akwa I","short_name":"Akwa I","types":["political","sublocality","sublocality_level_1"]},{"long_name":"Douala","short_name":"Douala","types":["locality","political"]},{"long_name":"Wouri","short_name":"Wouri","types":["administrative_area_level_2","political"]},{"long_name":"R\\u00e9gion du Littoral","short_name":"R\\u00e9gion du Littoral","types":["administrative_area_level_1","political"]},{"long_name":"Cameroun","short_name":"CM","types":["country","political"]}],"formatted_address":"12498 Rue des \\u00c9coles, Douala, Cameroun","geometry":{"location":{"lat":4.046096599999999,"lng":9.695526800000039},"location_type":"ROOFTOP","viewport":{"south":4.044747619708497,"west":9.694177819708557,"north":4.047445580291502,"east":9.69687578029152}},"place_id":"ChIJlWlY4vMSYRAR--cW_LY5SO4","plus_code":{"compound_code":"2MWW+C6 Douala, Cameroun","global_code":"6FPF2MWW+C6"},"types":["street_address"]}', '2019-08-14 13:53:49', '2019-08-14 13:53:49', NULL),
(37, NULL, 28, 'App\\Models\\Shipping', '{"address_components":[{"long_name":"12498","short_name":"12498","types":["street_number"]},{"long_name":"Rue des \\u00c9coles","short_name":"Rue des \\u00c9coles","types":["route"]},{"long_name":"Akwa I","short_name":"Akwa I","types":["political","sublocality","sublocality_level_1"]},{"long_name":"Douala","short_name":"Douala","types":["locality","political"]},{"long_name":"Wouri","short_name":"Wouri","types":["administrative_area_level_2","political"]},{"long_name":"R\\u00e9gion du Littoral","short_name":"R\\u00e9gion du Littoral","types":["administrative_area_level_1","political"]},{"long_name":"Cameroun","short_name":"CM","types":["country","political"]}],"formatted_address":"12498 Rue des \\u00c9coles, Douala, Cameroun","geometry":{"location":{"lat":4.046096599999999,"lng":9.695526800000039},"location_type":"ROOFTOP","viewport":{"south":4.044747619708497,"west":9.694177819708557,"north":4.047445580291502,"east":9.69687578029152}},"place_id":"ChIJlWlY4vMSYRAR--cW_LY5SO4","plus_code":{"compound_code":"2MWW+C6 Douala, Cameroun","global_code":"6FPF2MWW+C6"},"types":["street_address"]}', '2019-08-16 15:27:30', '2019-08-16 15:27:30', NULL),
(38, NULL, 30, 'App\\Models\\Shipping', '{"address_components":[{"long_name":"12498","short_name":"12498","types":["street_number"]},{"long_name":"Rue des \\u00c9coles","short_name":"Rue des \\u00c9coles","types":["route"]},{"long_name":"Akwa I","short_name":"Akwa I","types":["political","sublocality","sublocality_level_1"]},{"long_name":"Douala","short_name":"Douala","types":["locality","political"]},{"long_name":"Wouri","short_name":"Wouri","types":["administrative_area_level_2","political"]},{"long_name":"R\\u00e9gion du Littoral","short_name":"R\\u00e9gion du Littoral","types":["administrative_area_level_1","political"]},{"long_name":"Cameroun","short_name":"CM","types":["country","political"]}],"formatted_address":"12498 Rue des \\u00c9coles, Douala, Cameroun","geometry":{"location":{"lat":4.046096599999999,"lng":9.695526800000039},"location_type":"ROOFTOP","viewport":{"south":4.044747619708497,"west":9.694177819708557,"north":4.047445580291502,"east":9.69687578029152}},"place_id":"ChIJlWlY4vMSYRAR--cW_LY5SO4","plus_code":{"compound_code":"2MWW+C6 Douala, Cameroun","global_code":"6FPF2MWW+C6"},"types":["street_address"]}', '2019-08-17 09:01:39', '2019-08-17 09:01:39', NULL),
(39, NULL, 31, 'App\\Models\\Shipping', '{"address_components":[{"long_name":"Boulevard du President Ahmadou Ahidjo","short_name":"Boulevard du President Ahmadou Ahidjo","types":["route"]},{"long_name":"Akwa I","short_name":"Akwa I","types":["political","sublocality","sublocality_level_1"]},{"long_name":"Douala","short_name":"Douala","types":["locality","political"]},{"long_name":"Wouri","short_name":"Wouri","types":["administrative_area_level_2","political"]},{"long_name":"Littoral","short_name":"Littoral","types":["administrative_area_level_1","political"]},{"long_name":"Cameroun","short_name":"CM","types":["country","political"]}],"formatted_address":"Boulevard du President Ahmadou Ahidjo, Douala, Cameroun","geometry":{"bounds":{"south":4.046075699999999,"west":9.695802400000048,"north":4.0473795,"east":9.698647299999948},"location":{"lat":4.0467907,"lng":9.697253799999999},"location_type":"GEOMETRIC_CENTER","viewport":{"south":4.045378619708497,"west":9.695802400000048,"north":4.048076580291502,"east":9.698647299999948}},"place_id":"ChIJgTmfifMSYRARhs-BpY9r1D0","types":["route"]}', '2019-08-17 10:21:05', '2019-08-17 10:21:05', NULL),
(40, NULL, 32, 'App\\Models\\Shipping', '{"address_components":[{"long_name":"Boulevard du President Ahmadou Ahidjo","short_name":"Boulevard du President Ahmadou Ahidjo","types":["route"]},{"long_name":"Akwa I","short_name":"Akwa I","types":["political","sublocality","sublocality_level_1"]},{"long_name":"Douala","short_name":"Douala","types":["locality","political"]},{"long_name":"Wouri","short_name":"Wouri","types":["administrative_area_level_2","political"]},{"long_name":"Littoral","short_name":"Littoral","types":["administrative_area_level_1","political"]},{"long_name":"Cameroun","short_name":"CM","types":["country","political"]}],"formatted_address":"Boulevard du President Ahmadou Ahidjo, Douala, Cameroun","geometry":{"bounds":{"south":4.046075699999999,"west":9.695802400000048,"north":4.0473795,"east":9.698647299999948},"location":{"lat":4.0467907,"lng":9.697253799999999},"location_type":"GEOMETRIC_CENTER","viewport":{"south":4.045378619708497,"west":9.695802400000048,"north":4.048076580291502,"east":9.698647299999948}},"place_id":"ChIJgTmfifMSYRARhs-BpY9r1D0","types":["route"]}', '2019-08-20 13:36:21', '2019-08-20 13:36:21', NULL),
(41, NULL, 33, 'App\\Models\\Shipping', '{"address_components":[{"long_name":"12498","short_name":"12498","types":["street_number"]},{"long_name":"Rue des \\u00c9coles","short_name":"Rue des \\u00c9coles","types":["route"]},{"long_name":"Akwa I","short_name":"Akwa I","types":["political","sublocality","sublocality_level_1"]},{"long_name":"Douala","short_name":"Douala","types":["locality","political"]},{"long_name":"Wouri","short_name":"Wouri","types":["administrative_area_level_2","political"]},{"long_name":"R\\u00e9gion du Littoral","short_name":"R\\u00e9gion du Littoral","types":["administrative_area_level_1","political"]},{"long_name":"Cameroun","short_name":"CM","types":["country","political"]}],"formatted_address":"12498 Rue des \\u00c9coles, Douala, Cameroun","geometry":{"location":{"lat":4.046096599999999,"lng":9.695526800000039},"location_type":"ROOFTOP","viewport":{"south":4.044747619708497,"west":9.694177819708557,"north":4.047445580291502,"east":9.69687578029152}},"place_id":"ChIJlWlY4vMSYRAR--cW_LY5SO4","plus_code":{"compound_code":"2MWW+C6 Douala, Cameroun","global_code":"6FPF2MWW+C6"},"types":["street_address"]}', '2019-08-20 13:42:02', '2019-08-20 13:42:02', NULL),
(42, NULL, 43, 'App\\Models\\Shipping', '{"address_components":[{"long_name":"12498","short_name":"12498","types":["street_number"]},{"long_name":"Rue des \\u00c9coles","short_name":"Rue des \\u00c9coles","types":["route"]},{"long_name":"Akwa I","short_name":"Akwa I","types":["political","sublocality","sublocality_level_1"]},{"long_name":"Douala","short_name":"Douala","types":["locality","political"]},{"long_name":"Wouri","short_name":"Wouri","types":["administrative_area_level_2","political"]},{"long_name":"R\\u00e9gion du Littoral","short_name":"R\\u00e9gion du Littoral","types":["administrative_area_level_1","political"]},{"long_name":"Cameroun","short_name":"CM","types":["country","political"]}],"formatted_address":"12498 Rue des \\u00c9coles, Douala, Cameroun","geometry":{"location":{"lat":4.046096599999999,"lng":9.695526800000039},"location_type":"ROOFTOP","viewport":{"south":4.044747619708497,"west":9.694177819708557,"north":4.047445580291502,"east":9.69687578029152}},"place_id":"ChIJlWlY4vMSYRAR--cW_LY5SO4","plus_code":{"compound_code":"2MWW+C6 Douala, Cameroun","global_code":"6FPF2MWW+C6"},"types":["street_address"]}', '2019-08-20 14:32:49', '2019-08-20 14:32:49', NULL),
(43, NULL, 35, 'App\\Models\\Shipping', '{"address_components":[{"long_name":"Boulevard du President Ahmadou Ahidjo","short_name":"Boulevard du President Ahmadou Ahidjo","types":["route"]},{"long_name":"Akwa I","short_name":"Akwa I","types":["political","sublocality","sublocality_level_1"]},{"long_name":"Douala","short_name":"Douala","types":["locality","political"]},{"long_name":"Wouri","short_name":"Wouri","types":["administrative_area_level_2","political"]},{"long_name":"Littoral","short_name":"Littoral","types":["administrative_area_level_1","political"]},{"long_name":"Cameroun","short_name":"CM","types":["country","political"]}],"formatted_address":"Boulevard du President Ahmadou Ahidjo, Douala, Cameroun","geometry":{"bounds":{"south":4.046075699999999,"west":9.695802400000048,"north":4.0473795,"east":9.698647299999948},"location":{"lat":4.0467907,"lng":9.697253799999999},"location_type":"GEOMETRIC_CENTER","viewport":{"south":4.045378619708497,"west":9.695802400000048,"north":4.048076580291502,"east":9.698647299999948}},"place_id":"ChIJgTmfifMSYRARhs-BpY9r1D0","types":["route"]}', '2019-08-21 08:35:52', '2019-08-21 08:35:52', NULL),
(44, NULL, 36, 'App\\Models\\Shipping', '{"address_components":[{"long_name":"Boulevard du President Ahmadou Ahidjo","short_name":"Boulevard du President Ahmadou Ahidjo","types":["route"]},{"long_name":"Akwa I","short_name":"Akwa I","types":["political","sublocality","sublocality_level_1"]},{"long_name":"Douala","short_name":"Douala","types":["locality","political"]},{"long_name":"Wouri","short_name":"Wouri","types":["administrative_area_level_2","political"]},{"long_name":"Littoral","short_name":"Littoral","types":["administrative_area_level_1","political"]},{"long_name":"Cameroun","short_name":"CM","types":["country","political"]}],"formatted_address":"Boulevard du President Ahmadou Ahidjo, Douala, Cameroun","geometry":{"bounds":{"south":4.046075699999999,"west":9.695802400000048,"north":4.0473795,"east":9.698647299999948},"location":{"lat":4.0467907,"lng":9.697253799999999},"location_type":"GEOMETRIC_CENTER","viewport":{"south":4.045378619708497,"west":9.695802400000048,"north":4.048076580291502,"east":9.698647299999948}},"place_id":"ChIJgTmfifMSYRARhs-BpY9r1D0","types":["route"]}', '2019-08-21 08:53:09', '2019-08-21 08:53:09', NULL),
(45, NULL, 37, 'App\\Models\\Shipping', '{"address_components":[{"long_name":"12498","short_name":"12498","types":["street_number"]},{"long_name":"Rue des \\u00c9coles","short_name":"Rue des \\u00c9coles","types":["route"]},{"long_name":"Akwa I","short_name":"Akwa I","types":["political","sublocality","sublocality_level_1"]},{"long_name":"Douala","short_name":"Douala","types":["locality","political"]},{"long_name":"Wouri","short_name":"Wouri","types":["administrative_area_level_2","political"]},{"long_name":"R\\u00e9gion du Littoral","short_name":"R\\u00e9gion du Littoral","types":["administrative_area_level_1","political"]},{"long_name":"Cameroun","short_name":"CM","types":["country","political"]}],"formatted_address":"12498 Rue des \\u00c9coles, Douala, Cameroun","geometry":{"location":{"lat":4.045461899999999,"lng":9.694641499999989},"location_type":"ROOFTOP","viewport":{"south":4.044112919708497,"west":9.693292519708507,"north":4.046810880291502,"east":9.69599048029147}},"place_id":"ChIJtdjFaPESYRARlCSfYu1xP4k","plus_code":{"compound_code":"2MWV+5V Douala, Cameroun","global_code":"6FPF2MWV+5V"},"types":["establishment","point_of_interest"]}', '2019-08-21 09:52:46', '2019-08-21 09:52:46', NULL),
(46, NULL, 38, 'App\\Models\\Shipping', '{"address_components":[{"long_name":"12498","short_name":"12498","types":["street_number"]},{"long_name":"Rue des \\u00c9coles","short_name":"Rue des \\u00c9coles","types":["route"]},{"long_name":"Akwa I","short_name":"Akwa I","types":["political","sublocality","sublocality_level_1"]},{"long_name":"Douala","short_name":"Douala","types":["locality","political"]},{"long_name":"Wouri","short_name":"Wouri","types":["administrative_area_level_2","political"]},{"long_name":"R\\u00e9gion du Littoral","short_name":"R\\u00e9gion du Littoral","types":["administrative_area_level_1","political"]},{"long_name":"Cameroun","short_name":"CM","types":["country","political"]}],"formatted_address":"12498 Rue des \\u00c9coles, Douala, Cameroun","geometry":{"location":{"lat":4.045461899999999,"lng":9.694641499999989},"location_type":"ROOFTOP","viewport":{"south":4.044112919708497,"west":9.693292519708507,"north":4.046810880291502,"east":9.69599048029147}},"place_id":"ChIJtdjFaPESYRARlCSfYu1xP4k","plus_code":{"compound_code":"2MWV+5V Douala, Cameroun","global_code":"6FPF2MWV+5V"},"types":["establishment","point_of_interest"]}', '2019-08-21 13:58:34', '2019-08-21 13:58:34', NULL),
(47, NULL, 39, 'App\\Models\\Shipping', '{"address_components":[{"long_name":"12498","short_name":"12498","types":["street_number"]},{"long_name":"Rue des \\u00c9coles","short_name":"Rue des \\u00c9coles","types":["route"]},{"long_name":"Akwa I","short_name":"Akwa I","types":["political","sublocality","sublocality_level_1"]},{"long_name":"Douala","short_name":"Douala","types":["locality","political"]},{"long_name":"Wouri","short_name":"Wouri","types":["administrative_area_level_2","political"]},{"long_name":"R\\u00e9gion du Littoral","short_name":"R\\u00e9gion du Littoral","types":["administrative_area_level_1","political"]},{"long_name":"Cameroun","short_name":"CM","types":["country","political"]}],"formatted_address":"12498 Rue des \\u00c9coles, Douala, Cameroun","geometry":{"location":{"lat":4.046096599999999,"lng":9.695526800000039},"location_type":"ROOFTOP","viewport":{"south":4.044747619708497,"west":9.694177819708557,"north":4.047445580291502,"east":9.69687578029152}},"place_id":"ChIJlWlY4vMSYRAR--cW_LY5SO4","plus_code":{"compound_code":"2MWW+C6 Douala, Cameroun","global_code":"6FPF2MWW+C6"},"types":["street_address"]}', '2019-08-22 07:16:31', '2019-08-22 07:16:31', NULL);
INSERT INTO `addresses` (`id`, `description`, `addressable_id`, `addressable_type`, `gmap_address`, `created_at`, `updated_at`, `deleted_at`) VALUES
(48, NULL, 40, 'App\\Models\\Shipping', '{"address_components":[{"long_name":"12498","short_name":"12498","types":["street_number"]},{"long_name":"Rue des \\u00c9coles","short_name":"Rue des \\u00c9coles","types":["route"]},{"long_name":"Akwa I","short_name":"Akwa I","types":["political","sublocality","sublocality_level_1"]},{"long_name":"Douala","short_name":"Douala","types":["locality","political"]},{"long_name":"Wouri","short_name":"Wouri","types":["administrative_area_level_2","political"]},{"long_name":"R\\u00e9gion du Littoral","short_name":"R\\u00e9gion du Littoral","types":["administrative_area_level_1","political"]},{"long_name":"Cameroun","short_name":"CM","types":["country","political"]}],"formatted_address":"12498 Rue des \\u00c9coles, Douala, Cameroun","geometry":{"location":{"lat":4.046096599999999,"lng":9.695526800000039},"location_type":"ROOFTOP","viewport":{"south":4.044747619708497,"west":9.694177819708557,"north":4.047445580291502,"east":9.69687578029152}},"place_id":"ChIJlWlY4vMSYRAR--cW_LY5SO4","plus_code":{"compound_code":"2MWW+C6 Douala, Cameroun","global_code":"6FPF2MWW+C6"},"types":["street_address"]}', '2019-08-22 07:19:10', '2019-08-22 07:19:10', NULL),
(49, NULL, 41, 'App\\Models\\Shipping', '{"address_components":[{"long_name":"12498","short_name":"12498","types":["street_number"]},{"long_name":"Rue des \\u00c9coles","short_name":"Rue des \\u00c9coles","types":["route"]},{"long_name":"Akwa I","short_name":"Akwa I","types":["political","sublocality","sublocality_level_1"]},{"long_name":"Douala","short_name":"Douala","types":["locality","political"]},{"long_name":"Wouri","short_name":"Wouri","types":["administrative_area_level_2","political"]},{"long_name":"R\\u00e9gion du Littoral","short_name":"R\\u00e9gion du Littoral","types":["administrative_area_level_1","political"]},{"long_name":"Cameroun","short_name":"CM","types":["country","political"]}],"formatted_address":"12498 Rue des \\u00c9coles, Douala, Cameroun","geometry":{"location":{"lat":4.046096599999999,"lng":9.695526800000039},"location_type":"ROOFTOP","viewport":{"south":4.044747619708497,"west":9.694177819708557,"north":4.047445580291502,"east":9.69687578029152}},"place_id":"ChIJlWlY4vMSYRAR--cW_LY5SO4","plus_code":{"compound_code":"2MWW+C6 Douala, Cameroun","global_code":"6FPF2MWW+C6"},"types":["street_address"]}', '2019-08-22 11:06:52', '2019-08-22 11:06:52', NULL),
(50, NULL, 42, 'App\\Models\\Shipping', '{"address_components":[{"long_name":"PRISO MOUKOKO","short_name":"PRISO MOUKOKO","types":["premise"]},{"long_name":"Rue Castelnau","short_name":"Rue Castelnau","types":["route"]},{"long_name":"Akwa I","short_name":"Akwa I","types":["political","sublocality","sublocality_level_1"]},{"long_name":"Douala","short_name":"Douala","types":["locality","political"]},{"long_name":"Wouri","short_name":"Wouri","types":["administrative_area_level_2","political"]},{"long_name":"R\\u00e9gion du Littoral","short_name":"R\\u00e9gion du Littoral","types":["administrative_area_level_1","political"]},{"long_name":"Cameroun","short_name":"CM","types":["country","political"]}],"formatted_address":"PRISO MOUKOKO, Rue Castelnau, Douala, Cameroun","geometry":{"bounds":{"south":4.0507506,"west":9.694808299999977,"north":4.0512804,"east":9.695197099999973},"location":{"lat":4.051031,"lng":9.695011499999964},"location_type":"ROOFTOP","viewport":{"south":4.049666519708497,"west":9.693653719708436,"north":4.052364480291502,"east":9.696351680291514}},"place_id":"ChIJh1JhCfYSYRARGui-UFXLXbU","types":["premise"]}', '2019-08-26 12:05:24', '2019-08-26 12:05:24', NULL),
(57, NULL, 20, 'App\\Models\\Restaurant', NULL, '2019-08-26 14:35:27', '2019-09-10 11:32:45', '2019-09-10 11:32:45'),
(58, 'une dees', 24, 'App\\Models\\Restaurant', '{"address_components":[{"long_name":"12","short_name":"12","types":["street_number"]},{"long_name":"Rue du Sentier","short_name":"Rue du Sentier","types":["route"]},{"long_name":"Paris","short_name":"Paris","types":["locality","political"]},{"long_name":"Arrondissement de Paris","short_name":"Arrondissement de Paris","types":["administrative_area_level_2","political"]},{"long_name":"\\u00cele-de-France","short_name":"\\u00cele-de-France","types":["administrative_area_level_1","political"]},{"long_name":"France","short_name":"FR","types":["country","political"]},{"long_name":"75002","short_name":"75002","types":["postal_code"]}],"formatted_address":"12 Rue du Sentier, 75002 Paris, France","geometry":{"location":{"lat":48.86899,"lng":2.345931000000064},"location_type":"ROOFTOP","viewport":{"south":48.86764101970849,"west":2.3445820197084686,"north":48.87033898029149,"east":2.3472799802914324}},"place_id":"ChIJTcfb1hVu5kcRLOcVEDujrx4","plus_code":{"compound_code":"V89W+H9 Paris, France","global_code":"8FW4V89W+H9"},"types":["establishment","point_of_interest"]}', '2019-08-27 13:18:38', '2019-10-11 15:18:59', NULL),
(59, NULL, 44, 'App\\Models\\Shipping', '{"address_components":[{"long_name":"12498","short_name":"12498","types":["street_number"]},{"long_name":"Rue des \\u00c9coles","short_name":"Rue des \\u00c9coles","types":["route"]},{"long_name":"Akwa I","short_name":"Akwa I","types":["political","sublocality","sublocality_level_1"]},{"long_name":"Douala","short_name":"Douala","types":["locality","political"]},{"long_name":"Wouri","short_name":"Wouri","types":["administrative_area_level_2","political"]},{"long_name":"R\\u00e9gion du Littoral","short_name":"R\\u00e9gion du Littoral","types":["administrative_area_level_1","political"]},{"long_name":"Cameroun","short_name":"CM","types":["country","political"]}],"formatted_address":"12498 Rue des \\u00c9coles, Douala, Cameroun","geometry":{"location":{"lat":4.046096599999999,"lng":9.695526800000039},"location_type":"ROOFTOP","viewport":{"south":4.044747619708497,"west":9.694177819708557,"north":4.047445580291502,"east":9.69687578029152}},"place_id":"ChIJlWlY4vMSYRAR--cW_LY5SO4","plus_code":{"compound_code":"2MWW+C6 Douala, Cameroun","global_code":"6FPF2MWW+C6"},"types":["street_address"]}', '2019-08-29 09:46:08', '2019-08-29 09:46:08', NULL),
(60, NULL, 10, 'App\\Models\\User', NULL, '2019-08-29 12:05:32', '2019-08-29 12:05:32', NULL),
(61, NULL, 11, 'App\\Models\\User', NULL, '2019-08-29 13:38:10', '2019-08-29 13:38:10', NULL),
(62, NULL, 45, 'App\\Models\\Shipping', '{"address_components":[{"long_name":"12498","short_name":"12498","types":["street_number"]},{"long_name":"Rue des \\u00c9coles","short_name":"Rue des \\u00c9coles","types":["route"]},{"long_name":"Akwa I","short_name":"Akwa I","types":["political","sublocality","sublocality_level_1"]},{"long_name":"Douala","short_name":"Douala","types":["locality","political"]},{"long_name":"Wouri","short_name":"Wouri","types":["administrative_area_level_2","political"]},{"long_name":"R\\u00e9gion du Littoral","short_name":"R\\u00e9gion du Littoral","types":["administrative_area_level_1","political"]},{"long_name":"Cameroun","short_name":"CM","types":["country","political"]}],"formatted_address":"12498 Rue des \\u00c9coles, Douala, Cameroun","geometry":{"location":{"lat":4.046096599999999,"lng":9.695526800000039},"location_type":"ROOFTOP","viewport":{"south":4.044747619708497,"west":9.694177819708557,"north":4.047445580291502,"east":9.69687578029152}},"place_id":"ChIJlWlY4vMSYRAR--cW_LY5SO4","plus_code":{"compound_code":"2MWW+C6 Douala, Cameroun","global_code":"6FPF2MWW+C6"},"types":["street_address"]}', '2019-09-02 13:21:37', '2019-09-02 13:21:37', NULL),
(63, NULL, 46, 'App\\Models\\Shipping', '{"address_components":[{"long_name":"12498","short_name":"12498","types":["street_number"]},{"long_name":"Rue des \\u00c9coles","short_name":"Rue des \\u00c9coles","types":["route"]},{"long_name":"Akwa I","short_name":"Akwa I","types":["political","sublocality","sublocality_level_1"]},{"long_name":"Douala","short_name":"Douala","types":["locality","political"]},{"long_name":"Wouri","short_name":"Wouri","types":["administrative_area_level_2","political"]},{"long_name":"R\\u00e9gion du Littoral","short_name":"R\\u00e9gion du Littoral","types":["administrative_area_level_1","political"]},{"long_name":"Cameroun","short_name":"CM","types":["country","political"]}],"formatted_address":"12498 Rue des \\u00c9coles, Douala, Cameroun","geometry":{"location":{"lat":4.046096599999999,"lng":9.695526800000039},"location_type":"ROOFTOP","viewport":{"south":4.044747619708497,"west":9.694177819708557,"north":4.047445580291502,"east":9.69687578029152}},"place_id":"ChIJlWlY4vMSYRAR--cW_LY5SO4","plus_code":{"compound_code":"2MWW+C6 Douala, Cameroun","global_code":"6FPF2MWW+C6"},"types":["street_address"]}', '2019-09-03 06:29:14', '2019-09-03 06:29:14', NULL),
(64, NULL, 47, 'App\\Models\\Shipping', '{"address_components":[{"long_name":"12498","short_name":"12498","types":["street_number"]},{"long_name":"Rue des \\u00c9coles","short_name":"Rue des \\u00c9coles","types":["route"]},{"long_name":"Akwa I","short_name":"Akwa I","types":["political","sublocality","sublocality_level_1"]},{"long_name":"Douala","short_name":"Douala","types":["locality","political"]},{"long_name":"Wouri","short_name":"Wouri","types":["administrative_area_level_2","political"]},{"long_name":"R\\u00e9gion du Littoral","short_name":"R\\u00e9gion du Littoral","types":["administrative_area_level_1","political"]},{"long_name":"Cameroun","short_name":"CM","types":["country","political"]}],"formatted_address":"12498 Rue des \\u00c9coles, Douala, Cameroun","geometry":{"location":{"lat":4.046096599999999,"lng":9.695526800000039},"location_type":"ROOFTOP","viewport":{"south":4.044747619708497,"west":9.694177819708557,"north":4.047445580291502,"east":9.69687578029152}},"place_id":"ChIJlWlY4vMSYRAR--cW_LY5SO4","plus_code":{"compound_code":"2MWW+C6 Douala, Cameroun","global_code":"6FPF2MWW+C6"},"types":["street_address"]}', '2019-09-03 09:09:29', '2019-09-03 09:09:29', NULL),
(65, NULL, 48, 'App\\Models\\Shipping', '{"address_components":[{"long_name":"12498","short_name":"12498","types":["street_number"]},{"long_name":"Rue des \\u00c9coles","short_name":"Rue des \\u00c9coles","types":["route"]},{"long_name":"Akwa I","short_name":"Akwa I","types":["political","sublocality","sublocality_level_1"]},{"long_name":"Douala","short_name":"Douala","types":["locality","political"]},{"long_name":"Wouri","short_name":"Wouri","types":["administrative_area_level_2","political"]},{"long_name":"R\\u00e9gion du Littoral","short_name":"R\\u00e9gion du Littoral","types":["administrative_area_level_1","political"]},{"long_name":"Cameroun","short_name":"CM","types":["country","political"]}],"formatted_address":"12498 Rue des \\u00c9coles, Douala, Cameroun","geometry":{"location":{"lat":4.046096599999999,"lng":9.695526800000039},"location_type":"ROOFTOP","viewport":{"south":4.044747619708497,"west":9.694177819708557,"north":4.047445580291502,"east":9.69687578029152}},"place_id":"ChIJlWlY4vMSYRAR--cW_LY5SO4","plus_code":{"compound_code":"2MWW+C6 Douala, Cameroun","global_code":"6FPF2MWW+C6"},"types":["street_address"]}', '2019-09-03 09:13:27', '2019-09-03 09:13:27', NULL),
(66, NULL, 49, 'App\\Models\\Shipping', '{"address_components":[{"long_name":"12498","short_name":"12498","types":["street_number"]},{"long_name":"Rue des \\u00c9coles","short_name":"Rue des \\u00c9coles","types":["route"]},{"long_name":"Akwa I","short_name":"Akwa I","types":["political","sublocality","sublocality_level_1"]},{"long_name":"Douala","short_name":"Douala","types":["locality","political"]},{"long_name":"Wouri","short_name":"Wouri","types":["administrative_area_level_2","political"]},{"long_name":"R\\u00e9gion du Littoral","short_name":"R\\u00e9gion du Littoral","types":["administrative_area_level_1","political"]},{"long_name":"Cameroun","short_name":"CM","types":["country","political"]}],"formatted_address":"12498 Rue des \\u00c9coles, Douala, Cameroun","geometry":{"location":{"lat":4.046096599999999,"lng":9.695526800000039},"location_type":"ROOFTOP","viewport":{"south":4.044747619708497,"west":9.694177819708557,"north":4.047445580291502,"east":9.69687578029152}},"place_id":"ChIJlWlY4vMSYRAR--cW_LY5SO4","plus_code":{"compound_code":"2MWW+C6 Douala, Cameroun","global_code":"6FPF2MWW+C6"},"types":["street_address"]}', '2019-09-03 09:15:07', '2019-09-03 09:15:07', NULL),
(67, NULL, 50, 'App\\Models\\Shipping', '{"address_components":[{"long_name":"Rue Pau","short_name":"Rue Pau","types":["route"]},{"long_name":"Akwa II","short_name":"Akwa II","types":["political","sublocality","sublocality_level_1"]},{"long_name":"Douala","short_name":"Douala","types":["locality","political"]},{"long_name":"Wouri","short_name":"Wouri","types":["administrative_area_level_2","political"]},{"long_name":"Littoral","short_name":"Littoral","types":["administrative_area_level_1","political"]},{"long_name":"Cameroun","short_name":"CM","types":["country","political"]}],"formatted_address":"Rue Pau, Douala, Cameroun","geometry":{"bounds":{"south":4.045361199999999,"west":9.702110400000038,"north":4.0455666,"east":9.702531099999987},"location":{"lat":4.0454639,"lng":9.702320800000052},"location_type":"GEOMETRIC_CENTER","viewport":{"south":4.044114919708497,"west":9.70097176970853,"north":4.046812880291502,"east":9.703669730291494}},"place_id":"ChIJM0E9wIwSYRARgMvHr9Scp1Q","types":["route"]}', '2019-09-04 08:51:49', '2019-09-04 08:51:49', NULL),
(68, NULL, 12, 'App\\Models\\User', '{"address_components":[{"long_name":"Rue Pau","short_name":"Rue Pau","types":["route"]},{"long_name":"Akwa II","short_name":"Akwa II","types":["political","sublocality","sublocality_level_1"]},{"long_name":"Douala","short_name":"Douala","types":["locality","political"]},{"long_name":"Wouri","short_name":"Wouri","types":["administrative_area_level_2","political"]},{"long_name":"Littoral","short_name":"Littoral","types":["administrative_area_level_1","political"]},{"long_name":"Cameroun","short_name":"CM","types":["country","political"]}],"formatted_address":"Rue Pau, Douala, Cameroun","geometry":{"bounds":{"south":4.045361199999999,"west":9.702110400000038,"north":4.0455666,"east":9.702531099999987},"location":{"lat":4.0454639,"lng":9.702320800000052},"location_type":"GEOMETRIC_CENTER","viewport":{"south":4.044114919708497,"west":9.70097176970853,"north":4.046812880291502,"east":9.703669730291494}},"place_id":"ChIJM0E9wIwSYRARgMvHr9Scp1Q","types":["route"]}', '2019-09-04 14:14:58', '2019-09-04 14:14:58', NULL),
(69, NULL, 51, 'App\\Models\\Shipping', '{"address_components":[{"long_name":"12498","short_name":"12498","types":["street_number"]},{"long_name":"Rue des \\u00c9coles","short_name":"Rue des \\u00c9coles","types":["route"]},{"long_name":"Akwa I","short_name":"Akwa I","types":["political","sublocality","sublocality_level_1"]},{"long_name":"Douala","short_name":"Douala","types":["locality","political"]},{"long_name":"Wouri","short_name":"Wouri","types":["administrative_area_level_2","political"]},{"long_name":"R\\u00e9gion du Littoral","short_name":"R\\u00e9gion du Littoral","types":["administrative_area_level_1","political"]},{"long_name":"Cameroun","short_name":"CM","types":["country","political"]}],"formatted_address":"12498 Rue des \\u00c9coles, Douala, Cameroun","geometry":{"location":{"lat":4.046096599999999,"lng":9.695526800000039},"location_type":"ROOFTOP","viewport":{"south":4.044747619708497,"west":9.694177819708557,"north":4.047445580291502,"east":9.69687578029152}},"place_id":"ChIJlWlY4vMSYRAR--cW_LY5SO4","plus_code":{"compound_code":"2MWW+C6 Douala, Cameroun","global_code":"6FPF2MWW+C6"},"types":["street_address"]}', '2019-09-13 10:06:50', '2019-09-13 10:06:50', NULL),
(70, NULL, 52, 'App\\Models\\Shipping', '{"address_components":[{"long_name":"12498","short_name":"12498","types":["street_number"]},{"long_name":"Rue des \\u00c9coles","short_name":"Rue des \\u00c9coles","types":["route"]},{"long_name":"Akwa I","short_name":"Akwa I","types":["political","sublocality","sublocality_level_1"]},{"long_name":"Douala","short_name":"Douala","types":["locality","political"]},{"long_name":"Wouri","short_name":"Wouri","types":["administrative_area_level_2","political"]},{"long_name":"R\\u00e9gion du Littoral","short_name":"R\\u00e9gion du Littoral","types":["administrative_area_level_1","political"]},{"long_name":"Cameroun","short_name":"CM","types":["country","political"]}],"formatted_address":"12498 Rue des \\u00c9coles, Douala, Cameroun","geometry":{"location":{"lat":4.046096599999999,"lng":9.695526800000039},"location_type":"ROOFTOP","viewport":{"south":4.044747619708497,"west":9.694177819708557,"north":4.047445580291502,"east":9.69687578029152}},"place_id":"ChIJlWlY4vMSYRAR--cW_LY5SO4","plus_code":{"compound_code":"2MWW+C6 Douala, Cameroun","global_code":"6FPF2MWW+C6"},"types":["street_address"]}', '2019-09-13 10:08:15', '2019-09-13 10:08:15', NULL),
(71, NULL, 53, 'App\\Models\\Shipping', '{"address_components":[{"long_name":"12498","short_name":"12498","types":["street_number"]},{"long_name":"Rue des \\u00c9coles","short_name":"Rue des \\u00c9coles","types":["route"]},{"long_name":"Akwa I","short_name":"Akwa I","types":["political","sublocality","sublocality_level_1"]},{"long_name":"Douala","short_name":"Douala","types":["locality","political"]},{"long_name":"Wouri","short_name":"Wouri","types":["administrative_area_level_2","political"]},{"long_name":"R\\u00e9gion du Littoral","short_name":"R\\u00e9gion du Littoral","types":["administrative_area_level_1","political"]},{"long_name":"Cameroun","short_name":"CM","types":["country","political"]}],"formatted_address":"12498 Rue des \\u00c9coles, Douala, Cameroun","geometry":{"location":{"lat":4.046096599999999,"lng":9.695526800000039},"location_type":"ROOFTOP","viewport":{"south":4.044747619708497,"west":9.694177819708557,"north":4.047445580291502,"east":9.69687578029152}},"place_id":"ChIJlWlY4vMSYRAR--cW_LY5SO4","plus_code":{"compound_code":"2MWW+C6 Douala, Cameroun","global_code":"6FPF2MWW+C6"},"types":["street_address"]}', '2019-09-13 11:43:45', '2019-09-13 11:43:45', NULL),
(72, NULL, 54, 'App\\Models\\Shipping', '{"address_components":[{"long_name":"12498","short_name":"12498","types":["street_number"]},{"long_name":"Rue des \\u00c9coles","short_name":"Rue des \\u00c9coles","types":["route"]},{"long_name":"Akwa I","short_name":"Akwa I","types":["political","sublocality","sublocality_level_1"]},{"long_name":"Douala","short_name":"Douala","types":["locality","political"]},{"long_name":"Wouri","short_name":"Wouri","types":["administrative_area_level_2","political"]},{"long_name":"R\\u00e9gion du Littoral","short_name":"R\\u00e9gion du Littoral","types":["administrative_area_level_1","political"]},{"long_name":"Cameroun","short_name":"CM","types":["country","political"]}],"formatted_address":"12498 Rue des \\u00c9coles, Douala, Cameroun","geometry":{"location":{"lat":4.046096599999999,"lng":9.695526800000039},"location_type":"ROOFTOP","viewport":{"south":4.044747619708497,"west":9.694177819708557,"north":4.047445580291502,"east":9.69687578029152}},"place_id":"ChIJlWlY4vMSYRAR--cW_LY5SO4","plus_code":{"compound_code":"2MWW+C6 Douala, Cameroun","global_code":"6FPF2MWW+C6"},"types":["street_address"]}', '2019-09-14 10:40:59', '2019-09-14 10:40:59', NULL),
(73, NULL, 55, 'App\\Models\\Shipping', '{"address_components":[{"long_name":"Douala","short_name":"Douala","types":["locality","political"]},{"long_name":"Cameroun","short_name":"CM","types":["country","political"]}],"formatted_address":"Boneleke, Douala, Cameroun","geometry":{"location":{"lat":4.0468297,"lng":9.697567299999946},"location_type":"GEOMETRIC_CENTER","viewport":{"south":4.045480719708498,"west":9.696218319708464,"north":4.048178680291502,"east":9.698916280291542}},"place_id":"ChIJQ2fyh_MSYRARoS2B7GLuzjQ","plus_code":{"compound_code":"2MWX+P2 Douala, Cameroun","global_code":"6FPF2MWX+P2"},"types":["establishment","hair_care","point_of_interest"]}', '2019-09-17 10:50:19', '2019-09-17 10:50:19', NULL),
(74, 'une description', 56, 'App\\Models\\Shipping', '{"address_components":[{"long_name":"Boulevard de la Libert\\u00e9","short_name":"Boulevard de la Libert\\u00e9","types":["route"]},{"long_name":"Akwa I","short_name":"Akwa I","types":["political","sublocality","sublocality_level_1"]},{"long_name":"Douala","short_name":"Douala","types":["locality","political"]},{"long_name":"Wouri","short_name":"Wouri","types":["administrative_area_level_2","political"]},{"long_name":"R\\u00e9gion du Littoral","short_name":"R\\u00e9gion du Littoral","types":["administrative_area_level_1","political"]},{"long_name":"Cameroun","short_name":"CM","types":["country","political"]}],"formatted_address":"Boulevard de la Libert\\u00e9, Douala, Cameroun","geometry":{"bounds":{"south":4.0480607,"west":9.694293000000016,"north":4.0486447,"east":9.694518700000003},"location":{"lat":4.0483515,"lng":9.69440910000003},"location_type":"GEOMETRIC_CENTER","viewport":{"south":4.047003719708497,"west":9.693056869708471,"north":4.049701680291502,"east":9.695754830291435}},"place_id":"ChIJwUx8lvYSYRARomqM6GNiprI","types":["route"]}', '2019-09-18 06:38:36', '2019-09-18 06:38:36', NULL),
(75, 'une description', 57, 'App\\Models\\Shipping', '{"address_components":[{"long_name":"Boulevard de la Libert\\u00e9","short_name":"Boulevard de la Libert\\u00e9","types":["route"]},{"long_name":"Akwa I","short_name":"Akwa I","types":["political","sublocality","sublocality_level_1"]},{"long_name":"Douala","short_name":"Douala","types":["locality","political"]},{"long_name":"Wouri","short_name":"Wouri","types":["administrative_area_level_2","political"]},{"long_name":"R\\u00e9gion du Littoral","short_name":"R\\u00e9gion du Littoral","types":["administrative_area_level_1","political"]},{"long_name":"Cameroun","short_name":"CM","types":["country","political"]}],"formatted_address":"Boulevard de la Libert\\u00e9, Douala, Cameroun","geometry":{"bounds":{"south":4.0480607,"west":9.694293000000016,"north":4.0486447,"east":9.694518700000003},"location":{"lat":4.0483515,"lng":9.69440910000003},"location_type":"GEOMETRIC_CENTER","viewport":{"south":4.047003719708497,"west":9.693056869708471,"north":4.049701680291502,"east":9.695754830291435}},"place_id":"ChIJwUx8lvYSYRARomqM6GNiprI","types":["route"]}', '2019-09-18 07:19:36', '2019-09-18 07:19:36', NULL),
(76, NULL, 58, 'App\\Models\\Shipping', '{"address_components":[{"long_name":"12498","short_name":"12498","types":["street_number"]},{"long_name":"Rue des \\u00c9coles","short_name":"Rue des \\u00c9coles","types":["route"]},{"long_name":"Akwa I","short_name":"Akwa I","types":["political","sublocality","sublocality_level_1"]},{"long_name":"Douala","short_name":"Douala","types":["locality","political"]},{"long_name":"Wouri","short_name":"Wouri","types":["administrative_area_level_2","political"]},{"long_name":"R\\u00e9gion du Littoral","short_name":"R\\u00e9gion du Littoral","types":["administrative_area_level_1","political"]},{"long_name":"Cameroun","short_name":"CM","types":["country","political"]}],"formatted_address":"12498 Rue des \\u00c9coles, Douala, Cameroun","geometry":{"location":{"lat":4.046096599999999,"lng":9.695526800000039},"location_type":"ROOFTOP","viewport":{"south":4.044747619708497,"west":9.694177819708557,"north":4.047445580291502,"east":9.69687578029152}},"place_id":"ChIJlWlY4vMSYRAR--cW_LY5SO4","plus_code":{"compound_code":"2MWW+C6 Douala, Cameroun","global_code":"6FPF2MWW+C6"},"types":["street_address"]}', '2019-09-20 12:47:51', '2019-09-20 12:47:51', NULL),
(77, NULL, 59, 'App\\Models\\Shipping', '{"address_components":[{"long_name":"3630","short_name":"3630","types":["street_number"]},{"long_name":"Avenue King Akwa","short_name":"Ave King Akwa","types":["route"]},{"long_name":"Akwa I","short_name":"Akwa I","types":["political","sublocality","sublocality_level_1"]},{"long_name":"Douala","short_name":"Douala","types":["locality","political"]},{"long_name":"Wouri","short_name":"Wouri","types":["administrative_area_level_2","political"]},{"long_name":"Littoral","short_name":"Littoral","types":["administrative_area_level_1","political"]},{"long_name":"Cameroun","short_name":"CM","types":["country","political"]}],"formatted_address":"3630 Ave King Akwa, Douala, Cameroun","geometry":{"location":{"lat":4.0490083,"lng":9.696576899999968},"location_type":"ROOFTOP","viewport":{"south":4.047659319708498,"west":9.695227919708486,"north":4.050357280291502,"east":9.69792588029145}},"place_id":"ChIJmZiSNvQSYRARi5Yv8mYb82c","plus_code":{"compound_code":"2MXW+JJ Douala, Cameroun","global_code":"6FPF2MXW+JJ"},"types":["street_address"]}', '2019-09-24 11:35:52', '2019-09-24 11:35:52', NULL),
(78, NULL, 4, 'App\\Models\\User', '{fooo: bar}', '2019-09-25 12:40:02', '2019-09-25 12:46:31', NULL),
(79, NULL, 60, 'App\\Models\\Shipping', '{"address_components":[{"long_name":"561","short_name":"561","types":["street_number"]},{"long_name":"Rue Joffre","short_name":"Rue Joffre","types":["route"]},{"long_name":"Akwa I","short_name":"Akwa I","types":["political","sublocality","sublocality_level_1"]},{"long_name":"Douala","short_name":"Douala","types":["locality","political"]},{"long_name":"Wouri","short_name":"Wouri","types":["administrative_area_level_2","political"]},{"long_name":"Littoral","short_name":"Littoral","types":["administrative_area_level_1","political"]},{"long_name":"Cameroun","short_name":"CM","types":["country","political"]}],"formatted_address":"561 Rue Joffre, Douala, Cameroun","geometry":{"location":{"lat":4.0500862,"lng":9.69393500000001},"location_type":"ROOFTOP","viewport":{"south":4.048737219708499,"west":9.692586019708529,"north":4.051435180291502,"east":9.695283980291492}},"place_id":"ChIJe_e2QvYSYRAR_0DQob0f3yA","plus_code":{"compound_code":"3M2V+2H Douala, Cameroun","global_code":"6FPF3M2V+2H"},"types":["street_address"]}', '2019-09-26 14:28:25', '2019-09-26 14:28:25', NULL),
(80, NULL, 61, 'App\\Models\\Shipping', '{"address_components":[{"long_name":"Rue Joss","short_name":"Rue Joss","types":["route"]},{"long_name":"Akwa I","short_name":"Akwa I","types":["political","sublocality","sublocality_level_1"]},{"long_name":"Douala","short_name":"Douala","types":["locality","political"]},{"long_name":"Wouri","short_name":"Wouri","types":["administrative_area_level_2","political"]},{"long_name":"Littoral","short_name":"Littoral","types":["administrative_area_level_1","political"]},{"long_name":"Cameroun","short_name":"CM","types":["country","political"]}],"formatted_address":"Rue Joss, Douala, Cameroun","geometry":{"bounds":{"south":4.044426400000001,"west":9.693116700000019,"north":4.0455938,"east":9.693473400000016},"location":{"lat":4.0449994,"lng":9.693332599999962},"location_type":"GEOMETRIC_CENTER","viewport":{"south":4.043661119708498,"west":9.691946069708479,"north":4.046359080291503,"east":9.694644030291556}},"place_id":"ChIJlxJUBfESYRAREg5fY83l0ko","types":["route"]}', '2019-09-27 10:22:19', '2019-09-27 10:22:19', NULL),
(81, NULL, 15, 'App\\Models\\User', NULL, '2019-10-07 14:45:56', '2019-10-07 14:45:56', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `type` enum('items','supplements') NOT NULL,
  `restaurant_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `restaurant_id` (`restaurant_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Contenu de la table `categories`
--

INSERT INTO `categories` (`id`, `name`, `type`, `restaurant_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'desserts', 'items', 2, '2019-09-13 09:12:23', '2019-09-13 09:12:23', NULL),
(2, 'main dishes', 'items', 2, '2019-09-13 09:12:23', '2019-09-13 09:12:23', NULL),
(3, 'entrees', 'items', 2, '2019-09-13 09:12:23', '2019-09-13 09:12:23', NULL),
(4, 'entrees', 'supplements', 2, '2019-09-13 09:12:23', '2019-09-13 09:12:23', NULL),
(5, 'appetizers', 'items', 2, '2019-09-13 09:12:23', '2019-09-13 09:12:23', NULL),
(6, 'side dishes', 'supplements', 2, '2019-09-13 09:12:23', '2019-09-13 09:12:23', NULL),
(7, 'others', 'items', 2, '2019-09-13 09:12:23', '2019-09-13 09:12:23', NULL),
(8, 'drinks', 'supplements', 2, '2019-09-13 09:12:23', '2019-09-13 09:12:23', NULL),
(9, 'Autres', 'supplements', 2, '2019-09-13 09:12:23', '2019-09-13 09:12:23', NULL),
(10, 'Epices', 'items', 18, '2019-09-16 12:28:01', '2019-09-16 12:28:01', NULL),
(11, 'Legumes', 'items', 18, '2019-09-16 12:28:35', '2019-09-16 12:28:35', NULL),
(12, 'Farine', 'items', 18, '2019-09-16 12:29:50', '2019-09-16 12:29:50', NULL),
(13, 'cat', 'items', 19, '2019-09-23 08:41:32', '2019-09-23 08:41:32', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `criteria`
--

CREATE TABLE IF NOT EXISTS `criteria` (
  `id` int(11) NOT NULL AUTO_INCREMENT '0',
  `name` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `criteria`
--

INSERT INTO `criteria` (`id`, `name`, `type`) VALUES
(1, 'temperature', 'order'),
(2, 'portion size', 'order'),
(3, 'taste', 'order'),
(4, 'presentation', 'order'),
(5, 'other', 'order'),
(6, 'temperature', 'shipping'),
(7, 'lack of professionalism', 'shipping'),
(8, 'Waiting too long', 'shipping'),
(9, 'damaged command', 'shipping'),
(10, 'delivered at the wrong door', 'shipping'),
(11, 'damaged dish', 'shipping'),
(12, 'ignored delivery instructions', 'shipping'),
(13, 'invalid vehicle', 'shipping'),
(14, 'delivery id error', 'shipping'),
(15, 'other', 'shipping');

-- --------------------------------------------------------

--
-- Structure de la table `cuisines`
--

CREATE TABLE IF NOT EXISTS `cuisines` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `cuisines`
--

INSERT INTO `cuisines` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'camerounaise', '2019-09-13 09:11:13', '2019-09-13 09:11:13', NULL),
(2, 'americaine', '2019-09-13 09:11:13', '2019-09-13 09:11:13', NULL),
(3, 'Autres', '2019-09-13 09:11:13', '2019-10-04 14:46:38', NULL),
(4, 'canadienne', '2019-10-04 14:19:02', '2019-10-04 14:19:02', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `days`
--

CREATE TABLE IF NOT EXISTS `days` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Contenu de la table `days`
--

INSERT INTO `days` (`id`, `name`) VALUES
(1, 'lundi'),
(2, 'mardi'),
(3, 'mercredi'),
(4, 'jeudi'),
(5, 'vendredi'),
(6, 'samedi'),
(7, 'dimanche');

-- --------------------------------------------------------

--
-- Structure de la table `invoices`
--

CREATE TABLE IF NOT EXISTS `invoices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` enum('paid','unpaid') DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL,
  `number` varchar(255) NOT NULL,
  `total` double NOT NULL,
  `issue_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `due_date` datetime DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Invoices_delivery1_idx` (`order_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=60 ;

--
-- Contenu de la table `invoices`
--

INSERT INTO `invoices` (`id`, `status`, `order_id`, `number`, `total`, `issue_date`, `due_date`, `deleted_at`) VALUES
(1, 'paid', 2, '007677', 1700, '2019-04-29 14:30:01', '2019-04-26 10:00:00', NULL),
(10, 'unpaid', 31, '007678', 1000, '2019-06-20 09:36:59', NULL, NULL),
(11, 'unpaid', 32, '007678', 1900, '2019-06-20 09:39:38', NULL, NULL),
(16, 'unpaid', 43, '000015', 12300, '2019-07-30 17:14:02', NULL, NULL),
(17, 'unpaid', 44, '000017', 6200, '2019-08-01 10:30:01', NULL, NULL),
(18, 'unpaid', 45, '000018', 1900, '2019-08-01 14:50:10', NULL, NULL),
(19, 'unpaid', 46, '000019', 4800, '2019-08-01 15:05:48', NULL, NULL),
(20, 'unpaid', 47, '000020', 1500, '2019-08-01 15:09:06', NULL, NULL),
(21, 'unpaid', 48, '000021', 1500, '2019-08-01 16:58:27', NULL, NULL),
(22, 'paid', 49, '000022', 12300, '2019-08-07 16:58:14', NULL, NULL),
(23, 'paid', 50, '000023', 12300, '2019-08-08 09:44:29', NULL, NULL),
(24, 'unpaid', 51, '000024', 1500, '2019-08-08 11:11:53', NULL, NULL),
(25, 'unpaid', 52, '000025', 4800, '2019-08-13 15:22:11', NULL, '2019-09-13 09:38:31'),
(26, 'unpaid', 53, '000026', 5000, '2019-08-14 15:53:49', NULL, NULL),
(27, 'unpaid', 54, '000027', 1200, '2019-08-16 17:27:30', NULL, NULL),
(29, 'unpaid', 56, '000028', 1500, '2019-08-17 11:01:39', NULL, NULL),
(30, 'paid', 57, '000030', 1900, '2019-08-17 12:21:05', NULL, NULL),
(31, 'unpaid', 58, '000031', 1200, '2019-08-20 15:36:21', NULL, NULL),
(32, 'paid', 59, '000032', 3000, '2019-08-20 15:42:03', NULL, NULL),
(33, 'unpaid', 60, '000033', 2500, '2019-08-20 16:32:49', NULL, NULL),
(34, 'unpaid', 61, '000034', 5298, '2019-08-21 10:35:52', NULL, NULL),
(35, 'unpaid', 62, '000035', 4500, '2019-08-21 10:53:09', NULL, NULL),
(36, 'unpaid', 63, '000036', 1900, '2019-08-21 11:52:46', NULL, NULL),
(37, 'unpaid', 64, '000037', 1500, '2019-08-21 15:58:34', NULL, NULL),
(38, 'unpaid', 65, '000038', 5000, '2019-08-22 09:16:31', NULL, NULL),
(39, 'unpaid', 66, '000039', 5000, '2019-08-22 09:19:10', NULL, NULL),
(40, 'unpaid', 67, '000040', 5000, '2019-08-22 13:06:52', NULL, NULL),
(41, 'paid', 68, '000041', 15500, '2019-08-26 14:05:24', NULL, NULL),
(42, 'paid', 69, '000042', 6900, '2019-08-26 15:28:53', NULL, NULL),
(43, 'unpaid', 70, '000043', 2200, '2019-08-29 11:46:08', NULL, NULL),
(44, 'paid', 71, '000044', 8500, '2019-09-02 15:21:37', NULL, NULL),
(45, 'paid', 72, '000045', 500, '2019-09-03 08:29:14', NULL, '2019-09-11 14:26:03'),
(46, 'paid', 73, '000046', 2200, '2019-09-03 11:09:29', NULL, NULL),
(47, 'unpaid', 74, '000047', 900, '2019-09-03 11:13:27', NULL, NULL),
(48, 'unpaid', 75, '000048', 4498, '2019-09-03 11:15:08', NULL, NULL),
(49, 'unpaid', 76, '000049', 18400, '2019-09-04 10:51:49', NULL, NULL),
(50, 'unpaid', 77, '000050', 4050, '2019-09-13 12:06:50', NULL, NULL),
(51, 'unpaid', 78, '000051', 4550, '2019-09-13 12:08:15', NULL, NULL),
(52, 'unpaid', 79, '000052', 17050, '2019-09-13 13:43:45', NULL, NULL),
(53, 'unpaid', 80, '000053', 8550, '2019-09-14 12:40:59', NULL, NULL),
(54, 'unpaid', 81, '000054', 1750, '2019-09-17 12:50:20', NULL, NULL),
(55, 'paid', 83, '000055', 3026, '2019-09-18 09:19:36', NULL, NULL),
(56, 'unpaid', 84, '000056', 10550, '2019-09-20 14:47:51', NULL, NULL),
(57, 'unpaid', 85, '000057', 10450, '2019-09-24 13:35:52', NULL, NULL),
(58, 'unpaid', 86, '000058', 130, '2019-09-26 16:28:25', NULL, NULL),
(59, 'unpaid', 87, '000059', 7050, '2019-09-27 12:22:19', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `items`
--

CREATE TABLE IF NOT EXISTS `items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `price` double NOT NULL DEFAULT '0',
  `old_price` double NOT NULL DEFAULT '0',
  `description` text,
  `is_available` tinyint(1) DEFAULT NULL,
  `cuisine_id` int(11) DEFAULT NULL,
  `restaurant_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `menu_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_meal_restaurant_idx` (`restaurant_id`),
  KEY `fk_meal_category1_idx` (`category_id`),
  KEY `fk_meals_cuisine1_idx` (`cuisine_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=82 ;

--
-- Contenu de la table `items`
--

INSERT INTO `items` (`id`, `name`, `price`, `old_price`, `description`, `is_available`, `cuisine_id`, `restaurant_id`, `category_id`, `menu_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Koki', 500, 0, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorum, repudiandae!', 0, 1, 1, 2, 2, '2019-03-22 12:39:35', '2019-08-14 08:02:45', NULL),
(3, 'Coucous ndole', 700, 0, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorum, repudiandae!', 1, 1, 1, 2, 2, '2019-03-22 12:39:35', '2019-08-05 08:09:08', NULL),
(4, 'Taro', 700, 0, 'lorem', 0, 1, 2, 2, 7, '2019-04-05 14:37:39', '2019-09-16 10:11:52', NULL),
(6, 'Risotton', 1200, 0, 'le plat de risotto est ... lorem ipsum', 0, 1, 2, 2, 3, '2019-04-27 08:15:48', '2019-10-07 14:41:31', NULL),
(8, 'Rotis de pommes au miel', 500, 0, 'Un repas pas comme les autres', 1, 1, 18, 1, 9, '2019-05-22 13:21:02', '2019-08-05 08:07:31', NULL),
(9, 'Macaronis', 5400, 0, 'C''est notre culture et cela n''a pas de secret pour nous', 0, 1, 18, 12, 9, '2019-05-22 13:29:47', '2019-09-16 13:30:09', NULL),
(10, 'Steack', 1550, 0, 'une description', 1, 1, 19, 2, 15, '2019-06-12 16:36:23', '2019-09-05 15:41:32', NULL),
(11, 'Hamburger', 2000, 0, 'description hamburger', 1, 1, 19, 2, 16, '2019-06-13 08:01:17', '2019-08-05 08:15:49', NULL),
(12, 'Ndole', 4000, 2500, 'Ndolé (ou ndolè) est le nom camerounais de variétés alimentaires de Vernonia. Il s''agit d''un plat préparé à base de la plante légumière dont les feuilles sont consommées vertes, mais aussi dans une moindre mesure séchées\r\nLes feuilles sont préparées avec de l’arachide et peux être fait aux crevettes, aux poisson fumé, à la viande fumé, etc..\r\nIl est servi accompagné de banane plantains, bâtons de manioc, miondo, du riz ou du foufou à défaut', 1, 1, 1, 2, 2, '2019-06-21 09:17:03', '2019-06-21 09:51:28', NULL),
(13, 'Thieb poulet', 2500, 0, '.', 1, 1, 1, 2, 2, '2019-06-21 10:49:57', '2019-06-22 12:04:47', NULL),
(21, 'Salade de haricots verts', 1000, 0, '.', 1, 3, 18, 3, 9, '2019-06-21 11:28:11', '2019-08-05 08:05:29', NULL),
(22, 'Moka', 1000, 0, '.', 1, 1, 18, 1, 1, '2019-06-21 11:41:52', '2019-06-21 11:43:29', '2019-06-21 10:43:29'),
(23, 'Moka', 1000, 0, '.', 1, 1, 18, 1, 1, '2019-06-21 11:41:53', '2019-06-21 11:43:38', '2019-06-21 10:43:38'),
(28, 'Salade d''avocats', 1500, 0, '.', 1, 1, 1, 3, 19, '2019-06-21 12:04:16', '2019-08-21 13:26:36', NULL),
(35, 'Riz cantonais', 3000, 0, '.', 1, 1, 19, 2, 17, '2019-06-21 12:21:53', '2019-08-05 08:14:24', NULL),
(36, 'Coucous ndole', 500, 0, 'une description', 1, 1, 19, 2, 16, '2019-06-21 12:22:30', '2019-08-05 08:13:39', NULL),
(37, 'Coucous ndole', 500, 0, 'une description', 1, 1, 19, 2, 2, '2019-06-21 12:23:23', '2019-06-21 12:23:37', '2019-06-21 11:23:37'),
(38, 'Légumes sautés méditerranée', 4500, 0, '.', 1, 1, 19, 2, 16, '2019-06-21 12:23:54', '2019-10-08 14:07:50', NULL),
(39, 'Riz Blanc', 0, 0, '.', 1, 1, 19, 2, 16, '2019-06-21 12:25:19', '2019-08-05 08:17:39', NULL),
(41, 'Ndole', 4500, 0, '.', 1, 1, 2, 2, 7, '2019-06-21 12:34:57', '2019-08-02 07:44:47', NULL),
(42, 'Poulet aux arachides', 3500, 0, '.', 1, 1, 2, 2, 7, '2019-06-21 12:36:39', '2019-08-05 08:00:25', NULL),
(43, 'Bouillon de queue de boeuf', 3998, 0, '.', 1, 1, 2, 2, 7, '2019-06-21 12:37:59', '2019-08-02 07:44:32', NULL),
(44, 'Mbongo tchobi', 3500, 0, '.', 1, 1, 2, 2, 7, '2019-06-21 12:39:31', '2019-08-02 07:44:15', NULL),
(45, 'Folong sautés', 2500, 0, '.', 1, 1, 2, 2, 7, '2019-06-21 12:40:57', '2019-08-02 07:44:00', NULL),
(48, 'Riz Blanc', 1500, 0, '.', 1, 1, 2, 2, 4, '2019-06-21 12:44:03', '2019-09-16 12:17:25', NULL),
(59, 'risotto', 0, 0, 'une dsc', 1, NULL, 24, 1, 29, '2019-08-27 15:14:17', '2019-10-11 15:16:33', NULL),
(60, 'Beer', 600, 0, 'Our beers include Guiness, 33 export and Beaufort light.', 1, NULL, 21, 4, 35, '2019-08-28 08:17:24', '2019-08-28 08:17:24', NULL),
(64, 'Tea', 500, 0, 'We offer a variety of tea such as Green tea, lemon tea. you can other your tea with milk and sugar.', 1, NULL, 21, 7, 32, '2019-08-28 08:39:01', '2019-08-28 08:49:47', NULL),
(65, 'Omelettes', 400, 0, 'simple omelette or omelette with jambon or omelette with spaghetti.', 1, NULL, 24, 7, 28, '2019-08-28 09:01:52', '2019-08-28 09:04:46', NULL),
(66, 'Tea', 400, 0, 'Tea with milk and ovaltine , green tea, lemon grass tea, coffee or lemon tea.', 1, NULL, 24, 7, 28, '2019-08-28 09:31:03', '2019-08-28 09:31:03', NULL),
(68, 'Salad', 800, 0, 'Fruits salad , vegetable salad.', 1, NULL, 24, 7, 28, '2019-08-28 09:57:34', '2019-08-28 10:11:48', NULL),
(71, 'Omellete', 600, 0, 'Your  omellete can be spiced or simple.', 1, NULL, 21, 7, 32, '2019-08-28 10:19:41', '2019-08-28 10:25:15', NULL),
(72, 'Pap', 200, 0, 'light or heavy pap with milk or lemon or simple pap.', 1, NULL, 24, 7, 28, '2019-08-28 10:24:52', '2019-08-28 10:24:52', NULL),
(74, 'Beans', 300, 0, 'fried red beans or white beans', 1, NULL, 24, 7, 28, '2019-08-28 10:37:25', '2019-08-28 10:37:25', NULL),
(75, 'Cameroonian Pap', 200, 0, 'you can add sugar, soyabeans or honey to your pap, or just simple.', 1, NULL, 21, 7, 32, '2019-08-28 10:42:48', '2019-08-28 10:48:22', NULL),
(76, 'Eru', 1500, 0, 'Eru with meat, dried fish and canda.', 1, NULL, 24, 2, 29, '2019-08-28 10:45:42', '2019-08-28 10:45:42', NULL),
(77, 'Ekwang', 2000, 0, 'Ekwang with dried meat and fish.', 1, NULL, 24, 2, 29, '2019-08-28 10:50:49', '2019-08-28 10:50:49', NULL),
(78, 'Cube de cuisine', 40, 0, 'Le cube magie est le meilleur sur le marché', 1, NULL, 18, 10, 9, '2019-09-16 14:25:05', '2019-09-16 14:25:05', NULL),
(79, 'Sel de cuisine', 13, 0, 'Le seul de cuisine de marque', 1, NULL, 18, 10, 9, '2019-09-16 14:27:07', '2019-09-16 14:27:07', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `items_has_supplements`
--

CREATE TABLE IF NOT EXISTS `items_has_supplements` (
  `item_id` int(11) NOT NULL,
  `supplement_id` int(11) NOT NULL,
  PRIMARY KEY (`item_id`,`supplement_id`),
  KEY `fk_items_has_supplements_items1_idx` (`item_id`),
  KEY `fk_items_has_supplements_supplements1_idx` (`supplement_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `items_has_supplements`
--

INSERT INTO `items_has_supplements` (`item_id`, `supplement_id`) VALUES
(3, 27),
(75, 67);

-- --------------------------------------------------------

--
-- Structure de la table `jobs`
--

CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=16 ;

--
-- Contenu de la table `jobs`
--

INSERT INTO `jobs` (`id`, `queue`, `payload`, `attempts`, `reserved_at`, `available_at`, `created_at`) VALUES
(1, 'default', '{"displayName":"Illuminate\\\\Notifications\\\\Events\\\\BroadcastNotificationCreated","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"delay":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"Illuminate\\\\Broadcasting\\\\BroadcastEvent","command":"O:38:\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\":7:{s:5:\\"event\\";O:60:\\"Illuminate\\\\Notifications\\\\Events\\\\BroadcastNotificationCreated\\":9:{s:10:\\"notifiable\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":4:{s:5:\\"class\\";s:15:\\"App\\\\Models\\\\User\\";s:2:\\"id\\";i:1;s:9:\\"relations\\";a:0:{}s:10:\\"connection\\";s:5:\\"mysql\\";}s:12:\\"notification\\";O:32:\\"App\\\\Notifications\\\\UserRegistered\\":9:{s:7:\\"\\u0000*\\u0000user\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":4:{s:5:\\"class\\";s:15:\\"App\\\\Models\\\\User\\";s:2:\\"id\\";i:15;s:9:\\"relations\\";a:3:{i:0;s:5:\\"roles\\";i:1;s:7:\\"address\\";i:2;s:5:\\"media\\";}s:10:\\"connection\\";s:5:\\"mysql\\";}s:2:\\"id\\";s:36:\\"d5f007db-00b0-44d5-9693-df1e4afd7d99\\";s:6:\\"locale\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}s:4:\\"data\\";a:1:{s:4:\\"user\\";a:6:{s:2:\\"id\\";i:15;s:9:\\"full_name\\";s:9:\\"Loic Wafo\\";s:8:\\"location\\";N;s:11:\\"profile_img\\";s:28:\\"\\/storage\\/users\\/15\\/avatar.png\\";s:10:\\"created_at\\";O:25:\\"Illuminate\\\\Support\\\\Carbon\\":3:{s:4:\\"date\\";s:26:\\"2019-09-23 15:11:48.000000\\";s:13:\\"timezone_type\\";i:3;s:8:\\"timezone\\";s:3:\\"UTC\\";}s:13:\\"created_since\\";s:18:\\"il y a 11 secondes\\";}}s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}', 0, NULL, 1569251519, 1569251519),
(2, 'default', '{"displayName":"Illuminate\\\\Notifications\\\\Events\\\\BroadcastNotificationCreated","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"delay":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"Illuminate\\\\Broadcasting\\\\BroadcastEvent","command":"O:38:\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\":7:{s:5:\\"event\\";O:60:\\"Illuminate\\\\Notifications\\\\Events\\\\BroadcastNotificationCreated\\":9:{s:10:\\"notifiable\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":4:{s:5:\\"class\\";s:15:\\"App\\\\Models\\\\User\\";s:2:\\"id\\";i:3;s:9:\\"relations\\";a:1:{i:0;s:5:\\"roles\\";}s:10:\\"connection\\";s:5:\\"mysql\\";}s:12:\\"notification\\";O:30:\\"App\\\\Notifications\\\\OrderCreated\\":9:{s:8:\\"\\u0000*\\u0000order\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":4:{s:5:\\"class\\";s:16:\\"App\\\\Models\\\\Order\\";s:2:\\"id\\";i:85;s:9:\\"relations\\";a:3:{i:0;s:10:\\"restaurant\\";i:1;s:15:\\"restaurant.user\\";i:2;s:21:\\"restaurant.user.roles\\";}s:10:\\"connection\\";N;}s:2:\\"id\\";s:36:\\"8881518e-588b-433d-962c-9709d9ccb926\\";s:6:\\"locale\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}s:4:\\"data\\";a:1:{s:5:\\"order\\";a:6:{s:2:\\"id\\";i:85;s:6:\\"number\\";s:7:\\"#00085a\\";s:10:\\"created_at\\";O:25:\\"Illuminate\\\\Support\\\\Carbon\\":3:{s:4:\\"date\\";s:26:\\"2019-09-24 12:35:43.000000\\";s:13:\\"timezone_type\\";i:3;s:8:\\"timezone\\";s:3:\\"UTC\\";}s:10:\\"updated_at\\";O:25:\\"Illuminate\\\\Support\\\\Carbon\\":3:{s:4:\\"date\\";s:26:\\"2019-09-24 12:35:43.000000\\";s:13:\\"timezone_type\\";i:3;s:8:\\"timezone\\";s:3:\\"UTC\\";}s:13:\\"restaurant_id\\";i:1;s:6:\\"status\\";N;}}s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}', 0, NULL, 1569328550, 1569328550),
(3, 'default', '{"displayName":"Illuminate\\\\Notifications\\\\Events\\\\BroadcastNotificationCreated","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"delay":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"Illuminate\\\\Broadcasting\\\\BroadcastEvent","command":"O:38:\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\":7:{s:5:\\"event\\";O:60:\\"Illuminate\\\\Notifications\\\\Events\\\\BroadcastNotificationCreated\\":9:{s:10:\\"notifiable\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":4:{s:5:\\"class\\";s:15:\\"App\\\\Models\\\\User\\";s:2:\\"id\\";i:1;s:9:\\"relations\\";a:1:{i:0;s:5:\\"roles\\";}s:10:\\"connection\\";s:5:\\"mysql\\";}s:12:\\"notification\\";O:30:\\"App\\\\Notifications\\\\OrderCreated\\":9:{s:8:\\"\\u0000*\\u0000order\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":4:{s:5:\\"class\\";s:16:\\"App\\\\Models\\\\Order\\";s:2:\\"id\\";i:85;s:9:\\"relations\\";a:3:{i:0;s:10:\\"restaurant\\";i:1;s:15:\\"restaurant.user\\";i:2;s:21:\\"restaurant.user.roles\\";}s:10:\\"connection\\";N;}s:2:\\"id\\";s:36:\\"d534d105-d765-4bb6-867a-083da86e51a2\\";s:6:\\"locale\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}s:4:\\"data\\";a:1:{s:5:\\"order\\";a:6:{s:2:\\"id\\";i:85;s:6:\\"number\\";s:7:\\"#00085a\\";s:10:\\"created_at\\";O:25:\\"Illuminate\\\\Support\\\\Carbon\\":3:{s:4:\\"date\\";s:26:\\"2019-09-24 12:35:43.000000\\";s:13:\\"timezone_type\\";i:3;s:8:\\"timezone\\";s:3:\\"UTC\\";}s:10:\\"updated_at\\";O:25:\\"Illuminate\\\\Support\\\\Carbon\\":3:{s:4:\\"date\\";s:26:\\"2019-09-24 12:35:43.000000\\";s:13:\\"timezone_type\\";i:3;s:8:\\"timezone\\";s:3:\\"UTC\\";}s:13:\\"restaurant_id\\";i:1;s:6:\\"status\\";N;}}s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}', 0, NULL, 1569328552, 1569328552),
(4, 'default', '{"displayName":"Illuminate\\\\Notifications\\\\Events\\\\BroadcastNotificationCreated","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"delay":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"Illuminate\\\\Broadcasting\\\\BroadcastEvent","command":"O:38:\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\":7:{s:5:\\"event\\";O:60:\\"Illuminate\\\\Notifications\\\\Events\\\\BroadcastNotificationCreated\\":9:{s:10:\\"notifiable\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":4:{s:5:\\"class\\";s:15:\\"App\\\\Models\\\\User\\";s:2:\\"id\\";i:14;s:9:\\"relations\\";a:1:{i:0;s:5:\\"roles\\";}s:10:\\"connection\\";s:5:\\"mysql\\";}s:12:\\"notification\\";O:30:\\"App\\\\Notifications\\\\OrderCreated\\":9:{s:8:\\"\\u0000*\\u0000order\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":4:{s:5:\\"class\\";s:16:\\"App\\\\Models\\\\Order\\";s:2:\\"id\\";i:86;s:9:\\"relations\\";a:3:{i:0;s:10:\\"restaurant\\";i:1;s:15:\\"restaurant.user\\";i:2;s:21:\\"restaurant.user.roles\\";}s:10:\\"connection\\";N;}s:2:\\"id\\";s:36:\\"e0dcefd7-caab-4363-abdd-0ceaa65c0330\\";s:6:\\"locale\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}s:4:\\"data\\";a:1:{s:5:\\"order\\";a:6:{s:2:\\"id\\";i:86;s:6:\\"number\\";s:7:\\"#00086q\\";s:10:\\"created_at\\";O:25:\\"Illuminate\\\\Support\\\\Carbon\\":3:{s:4:\\"date\\";s:26:\\"2019-09-26 15:27:59.000000\\";s:13:\\"timezone_type\\";i:3;s:8:\\"timezone\\";s:3:\\"UTC\\";}s:10:\\"updated_at\\";O:25:\\"Illuminate\\\\Support\\\\Carbon\\":3:{s:4:\\"date\\";s:26:\\"2019-09-26 15:27:59.000000\\";s:13:\\"timezone_type\\";i:3;s:8:\\"timezone\\";s:3:\\"UTC\\";}s:13:\\"restaurant_id\\";i:18;s:6:\\"status\\";N;}}s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}', 0, NULL, 1569511700, 1569511700),
(5, 'default', '{"displayName":"Illuminate\\\\Notifications\\\\Events\\\\BroadcastNotificationCreated","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"delay":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"Illuminate\\\\Broadcasting\\\\BroadcastEvent","command":"O:38:\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\":7:{s:5:\\"event\\";O:60:\\"Illuminate\\\\Notifications\\\\Events\\\\BroadcastNotificationCreated\\":9:{s:10:\\"notifiable\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":4:{s:5:\\"class\\";s:15:\\"App\\\\Models\\\\User\\";s:2:\\"id\\";i:1;s:9:\\"relations\\";a:1:{i:0;s:5:\\"roles\\";}s:10:\\"connection\\";s:5:\\"mysql\\";}s:12:\\"notification\\";O:30:\\"App\\\\Notifications\\\\OrderCreated\\":9:{s:8:\\"\\u0000*\\u0000order\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":4:{s:5:\\"class\\";s:16:\\"App\\\\Models\\\\Order\\";s:2:\\"id\\";i:86;s:9:\\"relations\\";a:3:{i:0;s:10:\\"restaurant\\";i:1;s:15:\\"restaurant.user\\";i:2;s:21:\\"restaurant.user.roles\\";}s:10:\\"connection\\";N;}s:2:\\"id\\";s:36:\\"f35acc70-43b1-41bd-a6ba-7c1f8c3c968f\\";s:6:\\"locale\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}s:4:\\"data\\";a:1:{s:5:\\"order\\";a:6:{s:2:\\"id\\";i:86;s:6:\\"number\\";s:7:\\"#00086q\\";s:10:\\"created_at\\";O:25:\\"Illuminate\\\\Support\\\\Carbon\\":3:{s:4:\\"date\\";s:26:\\"2019-09-26 15:27:59.000000\\";s:13:\\"timezone_type\\";i:3;s:8:\\"timezone\\";s:3:\\"UTC\\";}s:10:\\"updated_at\\";O:25:\\"Illuminate\\\\Support\\\\Carbon\\":3:{s:4:\\"date\\";s:26:\\"2019-09-26 15:27:59.000000\\";s:13:\\"timezone_type\\";i:3;s:8:\\"timezone\\";s:3:\\"UTC\\";}s:13:\\"restaurant_id\\";i:18;s:6:\\"status\\";N;}}s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}', 0, NULL, 1569511703, 1569511703),
(6, 'default', '{"displayName":"App\\\\Jobs\\\\sendUntakeShipmentNotificationJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"delay":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\sendUntakeShipmentNotificationJob","command":"O:42:\\"App\\\\Jobs\\\\sendUntakeShipmentNotificationJob\\":9:{s:10:\\"restaurant\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":4:{s:5:\\"class\\";s:21:\\"App\\\\Models\\\\Restaurant\\";s:2:\\"id\\";i:1;s:9:\\"relations\\";a:0:{}s:10:\\"connection\\";s:5:\\"mysql\\";}s:5:\\"order\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":4:{s:5:\\"class\\";s:16:\\"App\\\\Models\\\\Order\\";s:2:\\"id\\";i:85;s:9:\\"relations\\";a:1:{i:0;s:10:\\"restaurant\\";}s:10:\\"connection\\";s:5:\\"mysql\\";}s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";O:25:\\"Illuminate\\\\Support\\\\Carbon\\":3:{s:4:\\"date\\";s:26:\\"2019-09-26 16:12:32.847194\\";s:13:\\"timezone_type\\";i:3;s:8:\\"timezone\\";s:3:\\"UTC\\";}s:7:\\"chained\\";a:0:{}}"}}', 0, NULL, 1569514352, 1569514343),
(7, 'default', '{"displayName":"App\\\\Jobs\\\\sendUntakeShipmentNotificationJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"delay":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\sendUntakeShipmentNotificationJob","command":"O:42:\\"App\\\\Jobs\\\\sendUntakeShipmentNotificationJob\\":9:{s:10:\\"restaurant\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":4:{s:5:\\"class\\";s:21:\\"App\\\\Models\\\\Restaurant\\";s:2:\\"id\\";i:1;s:9:\\"relations\\";a:0:{}s:10:\\"connection\\";s:5:\\"mysql\\";}s:5:\\"order\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":4:{s:5:\\"class\\";s:16:\\"App\\\\Models\\\\Order\\";s:2:\\"id\\";i:71;s:9:\\"relations\\";a:1:{i:0;s:10:\\"restaurant\\";}s:10:\\"connection\\";s:5:\\"mysql\\";}s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";O:25:\\"Illuminate\\\\Support\\\\Carbon\\":3:{s:4:\\"date\\";s:26:\\"2019-09-26 16:13:23.221901\\";s:13:\\"timezone_type\\";i:3;s:8:\\"timezone\\";s:3:\\"UTC\\";}s:7:\\"chained\\";a:0:{}}"}}', 0, NULL, 1569514403, 1569514393),
(8, 'default', '{"displayName":"Illuminate\\\\Notifications\\\\Events\\\\BroadcastNotificationCreated","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"delay":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"Illuminate\\\\Broadcasting\\\\BroadcastEvent","command":"O:38:\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\":7:{s:5:\\"event\\";O:60:\\"Illuminate\\\\Notifications\\\\Events\\\\BroadcastNotificationCreated\\":9:{s:10:\\"notifiable\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":4:{s:5:\\"class\\";s:15:\\"App\\\\Models\\\\User\\";s:2:\\"id\\";i:7;s:9:\\"relations\\";a:1:{i:0;s:5:\\"roles\\";}s:10:\\"connection\\";s:5:\\"mysql\\";}s:12:\\"notification\\";O:30:\\"App\\\\Notifications\\\\OrderCreated\\":9:{s:8:\\"\\u0000*\\u0000order\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":4:{s:5:\\"class\\";s:16:\\"App\\\\Models\\\\Order\\";s:2:\\"id\\";i:87;s:9:\\"relations\\";a:3:{i:0;s:10:\\"restaurant\\";i:1;s:15:\\"restaurant.user\\";i:2;s:21:\\"restaurant.user.roles\\";}s:10:\\"connection\\";N;}s:2:\\"id\\";s:36:\\"ea1036df-5da0-4b8e-a4eb-adb41b2fc96e\\";s:6:\\"locale\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}s:4:\\"data\\";a:1:{s:5:\\"order\\";a:6:{s:2:\\"id\\";i:87;s:6:\\"number\\";s:7:\\"#00087w\\";s:10:\\"created_at\\";O:25:\\"Illuminate\\\\Support\\\\Carbon\\":3:{s:4:\\"date\\";s:26:\\"2019-09-27 11:22:09.000000\\";s:13:\\"timezone_type\\";i:3;s:8:\\"timezone\\";s:3:\\"UTC\\";}s:10:\\"updated_at\\";O:25:\\"Illuminate\\\\Support\\\\Carbon\\":3:{s:4:\\"date\\";s:26:\\"2019-09-27 11:22:09.000000\\";s:13:\\"timezone_type\\";i:3;s:8:\\"timezone\\";s:3:\\"UTC\\";}s:13:\\"restaurant_id\\";i:2;s:6:\\"status\\";N;}}s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}', 0, NULL, 1569583336, 1569583336),
(9, 'default', '{"displayName":"Illuminate\\\\Notifications\\\\Events\\\\BroadcastNotificationCreated","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"delay":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"Illuminate\\\\Broadcasting\\\\BroadcastEvent","command":"O:38:\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\":7:{s:5:\\"event\\";O:60:\\"Illuminate\\\\Notifications\\\\Events\\\\BroadcastNotificationCreated\\":9:{s:10:\\"notifiable\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":4:{s:5:\\"class\\";s:15:\\"App\\\\Models\\\\User\\";s:2:\\"id\\";i:1;s:9:\\"relations\\";a:1:{i:0;s:5:\\"roles\\";}s:10:\\"connection\\";s:5:\\"mysql\\";}s:12:\\"notification\\";O:30:\\"App\\\\Notifications\\\\OrderCreated\\":9:{s:8:\\"\\u0000*\\u0000order\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":4:{s:5:\\"class\\";s:16:\\"App\\\\Models\\\\Order\\";s:2:\\"id\\";i:87;s:9:\\"relations\\";a:3:{i:0;s:10:\\"restaurant\\";i:1;s:15:\\"restaurant.user\\";i:2;s:21:\\"restaurant.user.roles\\";}s:10:\\"connection\\";N;}s:2:\\"id\\";s:36:\\"0122fc45-d8be-4552-a85a-d887a3356df8\\";s:6:\\"locale\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}s:4:\\"data\\";a:1:{s:5:\\"order\\";a:6:{s:2:\\"id\\";i:87;s:6:\\"number\\";s:7:\\"#00087w\\";s:10:\\"created_at\\";O:25:\\"Illuminate\\\\Support\\\\Carbon\\":3:{s:4:\\"date\\";s:26:\\"2019-09-27 11:22:09.000000\\";s:13:\\"timezone_type\\";i:3;s:8:\\"timezone\\";s:3:\\"UTC\\";}s:10:\\"updated_at\\";O:25:\\"Illuminate\\\\Support\\\\Carbon\\":3:{s:4:\\"date\\";s:26:\\"2019-09-27 11:22:09.000000\\";s:13:\\"timezone_type\\";i:3;s:8:\\"timezone\\";s:3:\\"UTC\\";}s:13:\\"restaurant_id\\";i:2;s:6:\\"status\\";N;}}s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}', 0, NULL, 1569583339, 1569583339),
(10, 'default', '{"displayName":"Illuminate\\\\Notifications\\\\Events\\\\BroadcastNotificationCreated","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"delay":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"Illuminate\\\\Broadcasting\\\\BroadcastEvent","command":"O:38:\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\":7:{s:5:\\"event\\";O:60:\\"Illuminate\\\\Notifications\\\\Events\\\\BroadcastNotificationCreated\\":9:{s:10:\\"notifiable\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":4:{s:5:\\"class\\";s:15:\\"App\\\\Models\\\\User\\";s:2:\\"id\\";i:18;s:9:\\"relations\\";a:0:{}s:10:\\"connection\\";s:5:\\"mysql\\";}s:12:\\"notification\\";O:35:\\"App\\\\Notifications\\\\RestaurantCreated\\":9:{s:13:\\"\\u0000*\\u0000restaurant\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":4:{s:5:\\"class\\";s:21:\\"App\\\\Models\\\\Restaurant\\";s:2:\\"id\\";i:27;s:9:\\"relations\\";a:3:{i:0;s:4:\\"user\\";i:1;s:7:\\"address\\";i:2;s:5:\\"media\\";}s:10:\\"connection\\";s:5:\\"mysql\\";}s:2:\\"id\\";s:36:\\"698e1289-a096-467e-a4ea-bd386d7b8689\\";s:6:\\"locale\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}s:4:\\"data\\";a:1:{s:10:\\"restaurant\\";a:7:{s:2:\\"id\\";i:27;s:4:\\"name\\";s:12:\\"Margot O''Kon\\";s:8:\\"location\\";N;s:10:\\"created_at\\";O:25:\\"Illuminate\\\\Support\\\\Carbon\\":3:{s:4:\\"date\\";s:26:\\"2019-10-11 11:28:31.000000\\";s:13:\\"timezone_type\\";i:3;s:8:\\"timezone\\";s:13:\\"Africa\\/Douala\\";}s:13:\\"created_since\\";s:17:\\"il y a 6 secondes\\";s:11:\\"is_merchant\\";b:1;s:11:\\"profile_img\\";s:32:\\"\\/storage\\/restaurants\\/default.png\\";}}s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}', 0, NULL, 1570789718, 1570789718),
(11, 'default', '{"displayName":"Illuminate\\\\Notifications\\\\Events\\\\BroadcastNotificationCreated","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"delay":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"Illuminate\\\\Broadcasting\\\\BroadcastEvent","command":"O:38:\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\":7:{s:5:\\"event\\";O:60:\\"Illuminate\\\\Notifications\\\\Events\\\\BroadcastNotificationCreated\\":9:{s:10:\\"notifiable\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":4:{s:5:\\"class\\";s:15:\\"App\\\\Models\\\\User\\";s:2:\\"id\\";i:1;s:9:\\"relations\\";a:0:{}s:10:\\"connection\\";s:5:\\"mysql\\";}s:12:\\"notification\\";O:35:\\"App\\\\Notifications\\\\RestaurantCreated\\":9:{s:13:\\"\\u0000*\\u0000restaurant\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":4:{s:5:\\"class\\";s:21:\\"App\\\\Models\\\\Restaurant\\";s:2:\\"id\\";i:27;s:9:\\"relations\\";a:3:{i:0;s:4:\\"user\\";i:1;s:7:\\"address\\";i:2;s:5:\\"media\\";}s:10:\\"connection\\";s:5:\\"mysql\\";}s:2:\\"id\\";s:36:\\"38504a3b-e550-4a11-8e9e-fe31303e6879\\";s:6:\\"locale\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}s:4:\\"data\\";a:1:{s:10:\\"restaurant\\";a:7:{s:2:\\"id\\";i:27;s:4:\\"name\\";s:12:\\"Margot O''Kon\\";s:8:\\"location\\";N;s:10:\\"created_at\\";O:25:\\"Illuminate\\\\Support\\\\Carbon\\":3:{s:4:\\"date\\";s:26:\\"2019-10-11 11:28:31.000000\\";s:13:\\"timezone_type\\";i:3;s:8:\\"timezone\\";s:13:\\"Africa\\/Douala\\";}s:13:\\"created_since\\";s:17:\\"il y a 9 secondes\\";s:11:\\"is_merchant\\";b:1;s:11:\\"profile_img\\";s:32:\\"\\/storage\\/restaurants\\/default.png\\";}}s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}', 0, NULL, 1570789720, 1570789720),
(12, 'default', '{"displayName":"Illuminate\\\\Notifications\\\\Events\\\\BroadcastNotificationCreated","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"delay":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"Illuminate\\\\Broadcasting\\\\BroadcastEvent","command":"O:38:\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\":7:{s:5:\\"event\\";O:60:\\"Illuminate\\\\Notifications\\\\Events\\\\BroadcastNotificationCreated\\":9:{s:10:\\"notifiable\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":4:{s:5:\\"class\\";s:15:\\"App\\\\Models\\\\User\\";s:2:\\"id\\";i:19;s:9:\\"relations\\";a:0:{}s:10:\\"connection\\";s:5:\\"mysql\\";}s:12:\\"notification\\";O:35:\\"App\\\\Notifications\\\\RestaurantCreated\\":9:{s:13:\\"\\u0000*\\u0000restaurant\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":4:{s:5:\\"class\\";s:21:\\"App\\\\Models\\\\Restaurant\\";s:2:\\"id\\";i:28;s:9:\\"relations\\";a:3:{i:0;s:4:\\"user\\";i:1;s:7:\\"address\\";i:2;s:5:\\"media\\";}s:10:\\"connection\\";s:5:\\"mysql\\";}s:2:\\"id\\";s:36:\\"a034c177-b66d-443c-be06-d2cf3ca0780b\\";s:6:\\"locale\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}s:4:\\"data\\";a:1:{s:10:\\"restaurant\\";a:7:{s:2:\\"id\\";i:28;s:4:\\"name\\";s:11:\\"Ryan Jacobs\\";s:8:\\"location\\";N;s:10:\\"created_at\\";O:25:\\"Illuminate\\\\Support\\\\Carbon\\":3:{s:4:\\"date\\";s:26:\\"2019-10-11 11:37:07.000000\\";s:13:\\"timezone_type\\";i:3;s:8:\\"timezone\\";s:13:\\"Africa\\/Douala\\";}s:13:\\"created_since\\";s:17:\\"il y a 3 secondes\\";s:11:\\"is_merchant\\";b:0;s:11:\\"profile_img\\";s:32:\\"\\/storage\\/restaurants\\/default.png\\";}}s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}', 0, NULL, 1570790230, 1570790230),
(13, 'default', '{"displayName":"Illuminate\\\\Notifications\\\\Events\\\\BroadcastNotificationCreated","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"delay":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"Illuminate\\\\Broadcasting\\\\BroadcastEvent","command":"O:38:\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\":7:{s:5:\\"event\\";O:60:\\"Illuminate\\\\Notifications\\\\Events\\\\BroadcastNotificationCreated\\":9:{s:10:\\"notifiable\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":4:{s:5:\\"class\\";s:15:\\"App\\\\Models\\\\User\\";s:2:\\"id\\";i:1;s:9:\\"relations\\";a:0:{}s:10:\\"connection\\";s:5:\\"mysql\\";}s:12:\\"notification\\";O:35:\\"App\\\\Notifications\\\\RestaurantCreated\\":9:{s:13:\\"\\u0000*\\u0000restaurant\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":4:{s:5:\\"class\\";s:21:\\"App\\\\Models\\\\Restaurant\\";s:2:\\"id\\";i:28;s:9:\\"relations\\";a:3:{i:0;s:4:\\"user\\";i:1;s:7:\\"address\\";i:2;s:5:\\"media\\";}s:10:\\"connection\\";s:5:\\"mysql\\";}s:2:\\"id\\";s:36:\\"25b5a35e-a9ff-4120-8132-1781f5984db2\\";s:6:\\"locale\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}s:4:\\"data\\";a:1:{s:10:\\"restaurant\\";a:7:{s:2:\\"id\\";i:28;s:4:\\"name\\";s:11:\\"Ryan Jacobs\\";s:8:\\"location\\";N;s:10:\\"created_at\\";O:25:\\"Illuminate\\\\Support\\\\Carbon\\":3:{s:4:\\"date\\";s:26:\\"2019-10-11 11:37:07.000000\\";s:13:\\"timezone_type\\";i:3;s:8:\\"timezone\\";s:13:\\"Africa\\/Douala\\";}s:13:\\"created_since\\";s:17:\\"il y a 5 secondes\\";s:11:\\"is_merchant\\";b:0;s:11:\\"profile_img\\";s:32:\\"\\/storage\\/restaurants\\/default.png\\";}}s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}', 0, NULL, 1570790232, 1570790232),
(14, 'default', '{"displayName":"Illuminate\\\\Notifications\\\\Events\\\\BroadcastNotificationCreated","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"delay":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"Illuminate\\\\Broadcasting\\\\BroadcastEvent","command":"O:38:\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\":7:{s:5:\\"event\\";O:60:\\"Illuminate\\\\Notifications\\\\Events\\\\BroadcastNotificationCreated\\":9:{s:10:\\"notifiable\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":4:{s:5:\\"class\\";s:15:\\"App\\\\Models\\\\User\\";s:2:\\"id\\";i:20;s:9:\\"relations\\";a:0:{}s:10:\\"connection\\";s:5:\\"mysql\\";}s:12:\\"notification\\";O:35:\\"App\\\\Notifications\\\\RestaurantCreated\\":9:{s:13:\\"\\u0000*\\u0000restaurant\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":4:{s:5:\\"class\\";s:21:\\"App\\\\Models\\\\Restaurant\\";s:2:\\"id\\";i:29;s:9:\\"relations\\";a:3:{i:0;s:4:\\"user\\";i:1;s:7:\\"address\\";i:2;s:5:\\"media\\";}s:10:\\"connection\\";s:5:\\"mysql\\";}s:2:\\"id\\";s:36:\\"193e20ca-2e1e-4093-aeeb-5906cc5fff30\\";s:6:\\"locale\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}s:4:\\"data\\";a:1:{s:10:\\"restaurant\\";a:7:{s:2:\\"id\\";i:29;s:4:\\"name\\";s:12:\\"Ronny Senger\\";s:8:\\"location\\";N;s:10:\\"created_at\\";O:25:\\"Illuminate\\\\Support\\\\Carbon\\":3:{s:4:\\"date\\";s:26:\\"2019-10-11 12:12:01.000000\\";s:13:\\"timezone_type\\";i:3;s:8:\\"timezone\\";s:13:\\"Africa\\/Douala\\";}s:13:\\"created_since\\";s:17:\\"il y a 6 secondes\\";s:11:\\"is_merchant\\";b:0;s:11:\\"profile_img\\";s:50:\\"storage\\/restaurants\\/29\\/127\\/5d63fa5b4135e_aa6TJ.png\\";}}s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}', 0, NULL, 1570792327, 1570792327),
(15, 'default', '{"displayName":"Illuminate\\\\Notifications\\\\Events\\\\BroadcastNotificationCreated","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"delay":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"Illuminate\\\\Broadcasting\\\\BroadcastEvent","command":"O:38:\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\":7:{s:5:\\"event\\";O:60:\\"Illuminate\\\\Notifications\\\\Events\\\\BroadcastNotificationCreated\\":9:{s:10:\\"notifiable\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":4:{s:5:\\"class\\";s:15:\\"App\\\\Models\\\\User\\";s:2:\\"id\\";i:1;s:9:\\"relations\\";a:0:{}s:10:\\"connection\\";s:5:\\"mysql\\";}s:12:\\"notification\\";O:35:\\"App\\\\Notifications\\\\RestaurantCreated\\":9:{s:13:\\"\\u0000*\\u0000restaurant\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":4:{s:5:\\"class\\";s:21:\\"App\\\\Models\\\\Restaurant\\";s:2:\\"id\\";i:29;s:9:\\"relations\\";a:3:{i:0;s:4:\\"user\\";i:1;s:7:\\"address\\";i:2;s:5:\\"media\\";}s:10:\\"connection\\";s:5:\\"mysql\\";}s:2:\\"id\\";s:36:\\"c2d2653d-f653-4c77-b4f1-72334a07cee3\\";s:6:\\"locale\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}s:4:\\"data\\";a:1:{s:10:\\"restaurant\\";a:7:{s:2:\\"id\\";i:29;s:4:\\"name\\";s:12:\\"Ronny Senger\\";s:8:\\"location\\";N;s:10:\\"created_at\\";O:25:\\"Illuminate\\\\Support\\\\Carbon\\":3:{s:4:\\"date\\";s:26:\\"2019-10-11 12:12:01.000000\\";s:13:\\"timezone_type\\";i:3;s:8:\\"timezone\\";s:13:\\"Africa\\/Douala\\";}s:13:\\"created_since\\";s:17:\\"il y a 8 secondes\\";s:11:\\"is_merchant\\";b:0;s:11:\\"profile_img\\";s:50:\\"storage\\/restaurants\\/29\\/127\\/5d63fa5b4135e_aa6TJ.png\\";}}s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}', 0, NULL, 1570792329, 1570792329);

-- --------------------------------------------------------

--
-- Structure de la table `media`
--

CREATE TABLE IF NOT EXISTS `media` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  `collection_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mime_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `disk` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `size` int(10) unsigned NOT NULL,
  `manipulations` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `custom_properties` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `responsive_images` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_column` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `media_model_type_model_id_index` (`model_type`,`model_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=165 ;

--
-- Contenu de la table `media`
--

INSERT INTO `media` (`id`, `model_type`, `model_id`, `collection_name`, `name`, `file_name`, `mime_type`, `disk`, `size`, `manipulations`, `custom_properties`, `responsive_images`, `order_column`, `created_at`, `updated_at`) VALUES
(12, 'App\\Models\\User', 1, 'image', '5c9a229ceaffa_nigerian', '5c9a229ceaffa_nigerian.jpg', 'image/jpeg', 'public', 65055, '[]', '[]', '[]', 8, '2019-03-26 12:01:23', '2019-03-26 12:01:23'),
(13, 'App\\Models\\User', 2, 'image', '5c9dec17ac2a9_ghdfg', '5c9dec17ac2a9_ghdfg.jpg', 'image/jpeg', 'public', 56799, '[]', '[]', '[]', 9, '2019-03-29 08:57:46', '2019-03-29 08:57:46'),
(14, 'App\\Models\\Restaurant', 2, 'image', '5c9e1aaeaa2b3_restaurant-5', '5c9e1aaeaa2b3_restaurant-5.jpg', 'image/jpeg', 'public', 115351, '[]', '[]', '[]', 10, '2019-03-29 12:16:41', '2019-03-29 12:16:41'),
(18, 'App\\Models\\Item', 4, 'image', '5cb827809b65e_taro', '5cb827809b65e_taro.jpg', 'image/jpeg', 'public', 75202, '[]', '[]', '[]', 14, '2019-04-18 06:30:11', '2019-04-18 06:30:11'),
(19, 'App\\Models\\Supplement', 2, 'image', '5cb827b654b0f_cafe_du_jeudi', '5cb827b654b0f_cafe_du_jeudi.jpg', 'image/jpeg', 'public', 285198, '[]', '[]', '[]', 15, '2019-04-18 06:31:04', '2019-04-18 06:31:04'),
(20, 'App\\Models\\Item', 6, 'image', '5cc40f8bb0d83_kruti-rizoto-head', '5cc40f8bb0d83_kruti-rizoto-head.jpg', 'image/jpeg', 'public', 636455, '[]', '[]', '[]', 16, '2019-04-27 07:15:48', '2019-04-27 07:15:48'),
(33, 'App\\Models\\Item', 1, 'image', '5cdbef81adf15_koki', '5cdbef81adf15_koki.jpg', 'image/png', 'public', 291585, '[]', '[]', '[]', 22, '2019-05-15 09:52:54', '2019-05-15 09:52:54'),
(38, 'App\\Models\\Item', 9, 'image', '5ce54e6a55bfd_macaronis-au-fromage', '5ce54e6a55bfd_macaronis-au-fromage.jpeg', 'image/png', 'public', 449734, '[]', '[]', '[]', 27, '2019-05-22 12:29:47', '2019-05-22 12:29:47'),
(40, 'App\\Models\\Item', 10, 'image', '5d020195130cf_5cfa585bcaf2c_201305-r-florentine-beefsteak_0', '5d020195130cf_5cfa585bcaf2c_201305-r-florentine-beefsteak_0.jpg', 'image/png', 'public', 664714, '[]', '[]', '[]', 29, '2019-06-13 06:56:09', '2019-06-13 06:56:09'),
(41, 'App\\Models\\Item', 11, 'image', '5d02024bbfb55_5cfa57a7dbd7d_i113795-cheeseburger', '5d02024bbfb55_5cfa57a7dbd7d_i113795-cheeseburger.jpg', 'image/png', 'public', 621015, '[]', '[]', '[]', 30, '2019-06-13 07:01:17', '2019-06-13 07:01:17'),
(42, 'App\\Models\\Item', 11, 'image', '5d02029c68836_the-ultimate-hamburger', '5d02029c68836_the-ultimate-hamburger.jpg', 'image/png', 'public', 501571, '[]', '[]', '[]', 31, '2019-06-13 07:01:18', '2019-06-13 07:01:18'),
(43, 'App\\Models\\Item', 10, 'image', '5d0202f46bc57_steack', '5d0202f46bc57_steack.jpg', 'image/png', 'public', 666331, '[]', '[]', '[]', 32, '2019-06-13 07:01:59', '2019-06-13 07:01:59'),
(44, 'App\\Models\\Item', 3, 'image', '5d0c892ceeef4_couscous-ndole', '5d0c892ceeef4_couscous-ndole.jpg', 'image/png', 'public', 410260, '[]', '[]', '[]', 33, '2019-06-21 06:37:32', '2019-06-21 06:37:32'),
(46, 'App\\Models\\Item', 12, 'image', '5d0ca89d57e3e_la-gazelle-crevette-saute-a-l-africaine-96aa6', '5d0ca89d57e3e_la-gazelle-crevette-saute-a-l-africaine-96aa6.jpg', 'image/png', 'public', 396398, '[]', '[]', '[]', 34, '2019-06-21 08:51:28', '2019-06-21 08:51:28'),
(49, 'App\\Models\\Item', 13, 'image', '5d0cb6e411652_12508813_919507548141148_8507122889710205772_n', '5d0cb6e411652_12508813_919507548141148_8507122889710205772_n.jpg', 'image/png', 'public', 256996, '[]', '[]', '[]', 35, '2019-06-21 09:52:59', '2019-06-21 09:52:59'),
(54, 'App\\Models\\Supplement', 14, 'image', '5d0cb9dbf40c1_téléchargement (7)', '5d0cb9dbf40c1_téléchargement-(7).jpg', 'image/png', 'public', 62666, '[]', '[]', '[]', 36, '2019-06-21 10:05:44', '2019-06-21 10:05:44'),
(56, 'App\\Models\\Supplement', 17, 'image', '5d0cbb762b332_banane_plantin_frites', '5d0cbb762b332_banane_plantin_frites.jpg', 'image/png', 'public', 466501, '[]', '[]', '[]', 38, '2019-06-21 10:12:00', '2019-06-21 10:12:00'),
(57, 'App\\Models\\Supplement', 18, 'image', '5d0cbbed20e0c_téléchargement (6)', '5d0cbbed20e0c_téléchargement-(6).jpg', 'image/png', 'public', 75157, '[]', '[]', '[]', 39, '2019-06-21 10:14:24', '2019-06-21 10:14:24'),
(58, 'App\\Models\\Supplement', 19, 'image', '5d0cbe0383d74_images (2)', '5d0cbe0383d74_images-(2).jpg', 'image/png', 'public', 99396, '[]', '[]', '[]', 40, '2019-06-21 10:23:25', '2019-06-21 10:23:25'),
(59, 'App\\Models\\Supplement', 20, 'image', '5d0cbe94cdf39_images (4)', '5d0cbe94cdf39_images-(4).jpg', 'image/png', 'public', 50816, '[]', '[]', '[]', 41, '2019-06-21 10:25:55', '2019-06-21 10:25:55'),
(60, 'App\\Models\\Item', 21, 'image', '5d0cbf29bb0e4_téléchargement (3)', '5d0cbf29bb0e4_téléchargement-(3).jpg', 'image/png', 'public', 113388, '[]', '[]', '[]', 42, '2019-06-21 10:28:11', '2019-06-21 10:28:11'),
(61, 'App\\Models\\Item', 22, 'image', '5d0cc25399563_i78059-gateau-moka', '5d0cc25399563_i78059-gateau-moka.jpg', 'image/png', 'public', 215265, '[]', '[]', '[]', 43, '2019-06-21 10:41:52', '2019-06-21 10:41:52'),
(62, 'App\\Models\\Supplement', 24, 'image', '5d0cc2b605cc5_i78059-gateau-moka', '5d0cc2b605cc5_i78059-gateau-moka.jpg', 'image/png', 'public', 211607, '[]', '[]', '[]', 44, '2019-06-21 10:42:58', '2019-06-21 10:42:58'),
(63, 'App\\Models\\Supplement', 25, 'image', '5d0cc6153e0bf_téléchargement (1)', '5d0cc6153e0bf_téléchargement-(1).jpg', 'image/png', 'public', 78948, '[]', '[]', '[]', 45, '2019-06-21 10:58:20', '2019-06-21 10:58:20'),
(64, 'App\\Models\\Item', 26, 'image', '5d0cc6b09122f_téléchargement (8)', '5d0cc6b09122f_téléchargement-(8).jpg', 'image/png', 'public', 65407, '[]', '[]', '[]', 46, '2019-06-21 11:00:23', '2019-06-21 11:00:23'),
(65, 'App\\Models\\Item', 28, 'image', '5d0cc742f245a_images (1)', '5d0cc742f245a_images-(1).jpg', 'image/png', 'public', 110779, '[]', '[]', '[]', 47, '2019-06-21 11:04:16', '2019-06-21 11:04:16'),
(66, 'App\\Models\\Supplement', 29, 'image', '5d0cc80b633a8_téléchargement (16)', '5d0cc80b633a8_téléchargement-(16).jpg', 'image/png', 'public', 66471, '[]', '[]', '[]', 48, '2019-06-21 11:05:57', '2019-06-21 11:05:57'),
(67, 'App\\Models\\Supplement', 30, 'image', '5d0cc8c9e472b_i115008-', '5d0cc8c9e472b_i115008-.jpeg', 'image/png', 'public', 206997, '[]', '[]', '[]', 49, '2019-06-21 11:09:23', '2019-06-21 11:09:23'),
(68, 'App\\Models\\Item', 31, 'image', '5d0cc9165f6a1_images', '5d0cc9165f6a1_images.jpg', 'image/png', 'public', 73636, '[]', '[]', '[]', 50, '2019-06-21 11:10:53', '2019-06-21 11:10:53'),
(69, 'App\\Models\\Supplement', 27, 'image', '5d0cc9c738bc6_jus', '5d0cc9c738bc6_jus.jpg', 'image/png', 'public', 115571, '[]', '[]', '[]', 51, '2019-06-21 11:13:00', '2019-06-21 11:13:00'),
(70, 'App\\Models\\Supplement', 33, 'image', '5d0cc9f035754_659296782Fotolia_38486821_Subscription_Monthly_XL', '5d0cc9f035754_659296782Fotolia_38486821_Subscription_Monthly_XL.jpg', 'image/png', 'public', 198189, '[]', '[]', '[]', 52, '2019-06-21 11:14:45', '2019-06-21 11:14:45'),
(71, 'App\\Models\\Supplement', 34, 'image', '5d0cca7b94206_shutterstock_158416475', '5d0cca7b94206_shutterstock_158416475.jpg', 'image/png', 'public', 392631, '[]', '[]', '[]', 53, '2019-06-21 11:17:10', '2019-06-21 11:17:10'),
(72, 'App\\Models\\Item', 35, 'image', '5d0ccba953ac4_riz-cantonais-a-la-sauce-soja', '5d0ccba953ac4_riz-cantonais-a-la-sauce-soja.jpeg', 'image/png', 'public', 337078, '[]', '[]', '[]', 54, '2019-06-21 11:21:53', '2019-06-21 11:21:53'),
(73, 'App\\Models\\Item', 36, 'image', '5d0ccbcfda7d9_couscous-ndole', '5d0ccbcfda7d9_couscous-ndole.jpg', 'image/png', 'public', 412838, '[]', '[]', '[]', 55, '2019-06-21 11:22:30', '2019-06-21 11:22:30'),
(75, 'App\\Models\\Item', 39, 'image', '5d0ccc95f09b4_téléchargement', '5d0ccc95f09b4_téléchargement.jpg', 'image/png', 'public', 111120, '[]', '[]', '[]', 57, '2019-06-21 11:25:19', '2019-06-21 11:25:19'),
(77, 'App\\Models\\Item', 41, 'image', '5d0ccea3cf3e3_la-gazelle-crevette-saute-a-l-africaine-96aa6', '5d0ccea3cf3e3_la-gazelle-crevette-saute-a-l-africaine-96aa6.jpg', 'image/png', 'public', 396398, '[]', '[]', '[]', 59, '2019-06-21 11:34:57', '2019-06-21 11:34:57'),
(78, 'App\\Models\\Item', 41, 'image', '5d0ccebf2b29a_IMG_0057-1024x742', '5d0ccebf2b29a_IMG_0057-1024x742.jpg', 'image/png', 'public', 521140, '[]', '[]', '[]', 60, '2019-06-21 11:34:57', '2019-06-21 11:34:57'),
(79, 'App\\Models\\Item', 42, 'image', '5d0ccf2b794ac_téléchargement (15)', '5d0ccf2b794ac_téléchargement-(15).jpg', 'image/png', 'public', 81800, '[]', '[]', '[]', 61, '2019-06-21 11:36:39', '2019-06-21 11:36:39'),
(80, 'App\\Models\\Item', 43, 'image', '5d0ccf7c789aa_téléchargement (14)', '5d0ccf7c789aa_téléchargement-(14).jpg', 'image/png', 'public', 90326, '[]', '[]', '[]', 62, '2019-06-21 11:37:59', '2019-06-21 11:37:59'),
(81, 'App\\Models\\Item', 44, 'image', '5d0ccfd26f3e5_téléchargement (11)', '5d0ccfd26f3e5_téléchargement-(11).jpg', 'image/png', 'public', 91811, '[]', '[]', '[]', 63, '2019-06-21 11:39:31', '2019-06-21 11:39:31'),
(82, 'App\\Models\\Item', 45, 'image', '5d0cd02b6d25e_téléchargement (13)', '5d0cd02b6d25e_téléchargement-(13).jpg', 'image/png', 'public', 86972, '[]', '[]', '[]', 64, '2019-06-21 11:40:57', '2019-06-21 11:40:57'),
(83, 'App\\Models\\Supplement', 46, 'image', '5d0cd075aee03_banane_plantin_frites', '5d0cd075aee03_banane_plantin_frites.jpg', 'image/png', 'public', 467863, '[]', '[]', '[]', 65, '2019-06-21 11:41:41', '2019-06-21 11:41:41'),
(84, 'App\\Models\\Supplement', 47, 'image', '5d0cd0a937034_téléchargement (1)', '5d0cd0a937034_téléchargement-(1).jpg', 'image/png', 'public', 76424, '[]', '[]', '[]', 66, '2019-06-21 11:42:48', '2019-06-21 11:42:48'),
(86, 'App\\Models\\Item', 8, 'image', '5d0cea0f9276c_ob_ebceb9_pommes-roties-miel-fruits', '5d0cea0f9276c_ob_ebceb9_pommes-roties-miel-fruits.jpg', 'image/png', 'public', 578038, '[]', '[]', '[]', 68, '2019-06-21 13:30:41', '2019-06-21 13:30:41'),
(87, 'App\\Models\\Supplement', 7, 'image', '5d0df1797bf0e_DSC09438m1', '5d0df1797bf0e_DSC09438m1.jpg', 'image/png', 'public', 396809, '[]', '[]', '[]', 69, '2019-06-22 08:14:42', '2019-06-22 08:14:42'),
(88, 'App\\Models\\Supplement', 5, 'image', '5d0df1bc3bcb8_i4659-glace-a-la-cerise', '5d0df1bc3bcb8_i4659-glace-a-la-cerise.jpg', 'image/png', 'public', 481629, '[]', '[]', '[]', 70, '2019-06-22 08:15:46', '2019-06-22 08:15:46'),
(91, 'App\\Models\\Item', 48, 'image', '5d357df1cc885_lot7_2_2_article-riz-v3_20', '5d357df1cc885_lot7_2_2_article-riz-v3_20.jpg', 'image/png', 'public', 225577, '[]', '[]', '[]', 71, '2019-07-22 08:12:21', '2019-07-22 08:12:21'),
(98, 'App\\Models\\User', 4, 'image', '5d3584ef0f8d5_profile', '5d3584ef0f8d5_profile.png', 'image/png', 'public', 41764, '[]', '[]', '[]', 72, '2019-07-22 08:42:07', '2019-07-22 08:42:07'),
(108, 'App\\Models\\User', 3, 'image', '5d39cc42deb72_profile', '5d39cc42deb72_profile.png', 'image/jpeg', 'public', 45393, '[]', '[]', '[]', 73, '2019-07-25 14:35:31', '2019-07-25 14:35:31'),
(113, 'App\\Models\\Supplement', 19, 'image', '5d42acdac8893_i30467-salade-de-fruits-de-saison', '5d42acdac8893_i30467-salade-de-fruits-de-saison.jpg', 'image/png', 'public', 189421, '[]', '[]', '[]', 78, '2019-08-01 08:11:57', '2019-08-01 08:11:57'),
(114, 'App\\Models\\Restaurant', 1, 'image', '5d42b04292c56_r1', '5d42b04292c56_r1.jpg', 'image/png', 'public', 523540, '[]', '[]', '[]', 79, '2019-08-01 08:27:00', '2019-08-01 08:27:00'),
(115, 'App\\Models\\Restaurant', 1, 'image', '5d42b04e944ca_r2', '5d42b04e944ca_r2.jpg', 'image/png', 'public', 457606, '[]', '[]', '[]', 80, '2019-08-01 08:27:00', '2019-08-01 08:27:00'),
(116, 'App\\Models\\Restaurant', 1, 'image', '5d42b05e7a219_r3', '5d42b05e7a219_r3.jpg', 'image/png', 'public', 321937, '[]', '[]', '[]', 81, '2019-08-01 08:27:00', '2019-08-01 08:27:00'),
(117, 'App\\Models\\Restaurant', 2, 'image', '5d42b4d04886b_t1', '5d42b4d04886b_t1.jpg', 'image/png', 'public', 327819, '[]', '[]', '[]', 82, '2019-08-01 08:46:47', '2019-08-01 08:46:47'),
(118, 'App\\Models\\Restaurant', 2, 'image', '5d42b698a92ec_t2', '5d42b698a92ec_t2.jpg', 'image/png', 'public', 220398, '[]', '[]', '[]', 83, '2019-08-01 08:53:36', '2019-08-01 08:53:36'),
(119, 'App\\Models\\Restaurant', 18, 'image', '5d42b72b9c720_k1', '5d42b72b9c720_k1.jpg', 'image/png', 'public', 436923, '[]', '[]', '[]', 84, '2019-08-01 08:57:49', '2019-08-01 08:57:49'),
(120, 'App\\Models\\Restaurant', 18, 'image', '5d42b79285029_k2', '5d42b79285029_k2.jpg', 'image/png', 'public', 493079, '[]', '[]', '[]', 85, '2019-08-01 08:57:50', '2019-08-01 08:57:50'),
(122, 'App\\Models\\Item', 6, 'image', '5d53ca604b857_risoto-de-abobora-carne-seca', '5d53ca604b857_risoto-de-abobora-carne-seca.jpg', 'image/png', 'public', 517088, '[]', '[]', '[]', 87, '2019-08-14 07:46:26', '2019-08-14 07:46:26'),
(131, 'App\\Models\\Item', 56, 'image', '5d6546be6bdc9_pc-phone', '5d6546be6bdc9_pc-phone.png', 'image/png', 'public', 20694, '[]', '[]', '[]', 93, '2019-08-27 14:05:36', '2019-08-27 14:05:36'),
(132, 'App\\Models\\Item', 58, 'image', '5d6547a086c9a_restaurant-2', '5d6547a086c9a_restaurant-2.jpg', 'image/png', 'public', 515121, '[]', '[]', '[]', 94, '2019-08-27 14:09:24', '2019-08-27 14:09:24'),
(133, 'App\\Models\\Item', 59, 'image', '5d6548b914f0b_risoto-de-abobora-carne-seca', '5d6548b914f0b_risoto-de-abobora-carne-seca.jpg', 'image/png', 'public', 517956, '[]', '[]', '[]', 95, '2019-08-27 14:14:17', '2019-08-27 14:14:17'),
(135, 'App\\Models\\Item', 60, 'image', '5d663829d1818_61a5bc5c144dbfcb481874823cbbf9071438338557', '5d663829d1818_61a5bc5c144dbfcb481874823cbbf9071438338557.jpg', 'image/png', 'public', 423256, '[]', '[]', '[]', 97, '2019-08-28 07:17:24', '2019-08-28 07:17:24'),
(136, 'App\\Models\\Supplement', 61, 'image', '5d6638a4da89e_fries-300x239', '5d6638a4da89e_fries-300x239.png', 'image/png', 'public', 114799, '[]', '[]', '[]', 98, '2019-08-28 07:18:53', '2019-08-28 07:18:53'),
(137, 'App\\Models\\Supplement', 62, 'image', '5d663a0dad2b9_two-bread-rolls-on-a-white-background-DK8XEK', '5d663a0dad2b9_two-bread-rolls-on-a-white-background-DK8XEK.jpg', 'image/png', 'public', 399292, '[]', '[]', '[]', 99, '2019-08-28 07:24:51', '2019-08-28 07:24:51'),
(138, 'App\\Models\\Item', 64, 'image', '5d663974bb9e2_61a5bc5c144dbfcb481874823cbbf9071438338557', '5d663974bb9e2_61a5bc5c144dbfcb481874823cbbf9071438338557.jpg', 'image/png', 'public', 134866, '[]', '[]', '[]', 100, '2019-08-28 07:39:01', '2019-08-28 07:39:01'),
(139, 'App\\Models\\Supplement', 63, 'image', '5d663e9b5c9af_pancake', '5d663e9b5c9af_pancake.jpeg', 'image/png', 'public', 191823, '[]', '[]', '[]', 101, '2019-08-28 07:43:11', '2019-08-28 07:43:11'),
(140, 'App\\Models\\Item', 65, 'image', '5d66434c9e76b_basic-french-omelet-930x550', '5d66434c9e76b_basic-french-omelet-930x550.jpg', 'image/png', 'public', 468822, '[]', '[]', '[]', 102, '2019-08-28 08:04:46', '2019-08-28 08:04:46'),
(141, 'App\\Models\\Item', 65, 'image', '5d66436c74c2a_depositphotos_185965736-stock-photo-frittata-di-spaghetti', '5d66436c74c2a_depositphotos_185965736-stock-photo-frittata-di-spaghetti.jpg', 'image/png', 'public', 494330, '[]', '[]', '[]', 103, '2019-08-28 08:04:46', '2019-08-28 08:04:46'),
(142, 'App\\Models\\Item', 65, 'image', '5d66438ea292f_souffle-omelette-94592-1', '5d66438ea292f_souffle-omelette-94592-1.jpeg', 'image/png', 'public', 481532, '[]', '[]', '[]', 104, '2019-08-28 08:04:46', '2019-08-28 08:04:46'),
(143, 'App\\Models\\Item', 66, 'image', '5d66495d9f482_Cup-of-tea', '5d66495d9f482_Cup-of-tea.jpg', 'image/png', 'public', 135307, '[]', '[]', '[]', 105, '2019-08-28 08:31:03', '2019-08-28 08:31:03'),
(144, 'App\\Models\\Item', 68, 'image', '5d664f399d995_12-2012_yogurt-fruit-salad_images_main', '5d664f399d995_12-2012_yogurt-fruit-salad_images_main.jpg', 'image/png', 'public', 535441, '[]', '[]', '[]', 106, '2019-08-28 08:57:34', '2019-08-28 08:57:34'),
(145, 'App\\Models\\Item', 68, 'image', '5d664ff76c651_3422474-fresh-green-salad-with-tomato-and-mozzarella-cheese', '5d664ff76c651_3422474-fresh-green-salad-with-tomato-and-mozzarella-cheese.jpg', 'image/png', 'public', 494642, '[]', '[]', '[]', 107, '2019-08-28 08:57:34', '2019-08-28 08:57:34'),
(146, 'App\\Models\\Supplement', 69, 'image', '5d6651141ca67_index', '5d6651141ca67_index.jpg', 'image/png', 'public', 347828, '[]', '[]', '[]', 108, '2019-08-28 09:07:23', '2019-08-28 09:07:23'),
(147, 'App\\Models\\Supplement', 69, 'image', '5d6653149942a_index', '5d6653149942a_index.jpg', 'image/png', 'public', 233029, '[]', '[]', '[]', 109, '2019-08-28 09:13:35', '2019-08-28 09:13:35'),
(148, 'App\\Models\\Supplement', 70, 'image', '5d6654e5052c4_maxresdefault', '5d6654e5052c4_maxresdefault.jpg', 'image/png', 'public', 473878, '[]', '[]', '[]', 110, '2019-08-28 09:18:44', '2019-08-28 09:18:44'),
(149, 'App\\Models\\Item', 71, 'image', '5d66543886e36_c360_2017-06-25-11-41-29-829301012057', '5d66543886e36_c360_2017-06-25-11-41-29-829301012057.jpg', 'image/png', 'public', 513942, '[]', '[]', '[]', 111, '2019-08-28 09:19:41', '2019-08-28 09:19:41'),
(150, 'App\\Models\\Item', 72, 'image', '5d66566f33fa7_IMG_4647', '5d66566f33fa7_IMG_4647.jpg', 'image/png', 'public', 152166, '[]', '[]', '[]', 112, '2019-08-28 09:24:52', '2019-08-28 09:24:52'),
(151, 'App\\Models\\Supplement', 73, 'image', '5d66572ca8cb6_index', '5d66572ca8cb6_index.jpg', 'image/png', 'public', 466735, '[]', '[]', '[]', 113, '2019-08-28 09:33:51', '2019-08-28 09:33:51'),
(152, 'App\\Models\\Item', 74, 'image', '5d6658e1cac09_maxresdefault', '5d6658e1cac09_maxresdefault.jpg', 'image/png', 'public', 483351, '[]', '[]', '[]', 114, '2019-08-28 09:37:25', '2019-08-28 09:37:25'),
(153, 'App\\Models\\Item', 74, 'image', '5d66594f4c307_maxresdefault', '5d66594f4c307_maxresdefault.jpg', 'image/png', 'public', 497145, '[]', '[]', '[]', 115, '2019-08-28 09:37:25', '2019-08-28 09:37:25'),
(154, 'App\\Models\\Item', 75, 'image', '5d66596b32329_c360_2017-06-25-11-41-29-829301012057', '5d66596b32329_c360_2017-06-25-11-41-29-829301012057.jpg', 'image/png', 'public', 166082, '[]', '[]', '[]', 116, '2019-08-28 09:42:48', '2019-08-28 09:42:48'),
(155, 'App\\Models\\Item', 76, 'image', '5d665b2810d33_IMG_1867', '5d665b2810d33_IMG_1867.jpg', 'image/png', 'public', 479206, '[]', '[]', '[]', 117, '2019-08-28 09:45:42', '2019-08-28 09:45:42'),
(156, 'App\\Models\\Item', 77, 'image', '5d665c81c700f_Ekwang', '5d665c81c700f_Ekwang.jpg', 'image/png', 'public', 461522, '[]', '[]', '[]', 118, '2019-08-28 09:50:49', '2019-08-28 09:50:49'),
(157, 'App\\Models\\Supplement', 78, 'image', '5d6661cfbf441_61a5bc5c144dbfcb481874823cbbf9071438338557', '5d6661cfbf441_61a5bc5c144dbfcb481874823cbbf9071438338557.jpg', 'image/png', 'public', 103982, '[]', '[]', '[]', 119, '2019-08-28 10:15:49', '2019-08-28 10:15:49'),
(158, 'App\\Models\\Supplement', 80, 'image', '5d6787643e9a9_i30467-salade-de-fruits-de-saison', '5d6787643e9a9_i30467-salade-de-fruits-de-saison.jpg', 'image/png', 'public', 189186, '[]', '[]', '[]', 120, '2019-08-29 07:05:57', '2019-08-29 07:05:57'),
(159, 'App\\Models\\User', 8, 'image', '5d67d200a9a23_man', '5d67d200a9a23_man.png', 'image/png', 'public', 13218, '[]', '[]', '[]', 121, '2019-08-29 12:24:18', '2019-08-29 12:24:18'),
(160, 'App\\Models\\Item', 48, 'image', '5d7f7d5270a73_riz-blanc-au-compact-cook', '5d7f7d5270a73_riz-blanc-au-compact-cook.jpeg', 'image/png', 'public', 589384, '[]', '[]', '[]', 122, '2019-09-16 11:17:25', '2019-09-16 11:17:25'),
(161, 'App\\Models\\Item', 78, 'image', '5d7f9b01742f6_07613035067585_A1L1_s43692362 png', '5d7f9b01742f6_07613035067585_A1L1_s43692362-png.png', 'image/png', 'public', 544888, '[]', '[]', '[]', 123, '2019-09-16 13:25:05', '2019-09-16 13:25:05'),
(162, 'App\\Models\\Item', 79, 'image', '5d7f9ba46208d_IMG-20180807-WA0032', '5d7f9ba46208d_IMG-20180807-WA0032.jpg', 'image/png', 'public', 236408, '[]', '[]', '[]', 124, '2019-09-16 13:27:07', '2019-09-16 13:27:07'),
(163, 'App\\Models\\Restaurant', 21, 'image', '5d808f5b139e9_multimedia.grande.aced2d43d796cf01.72657374617572616e74652062617220636f6d657263696f5f6772616e64652e6a7067', '5d808f5b139e9_multimedia.grande.aced2d43d796cf01.72657374617572616e74652062617220636f6d657263696f5f6772616e64652e6a7067.jpg', 'image/png', 'public', 701053, '[]', '[]', '[]', 125, '2019-09-17 06:46:43', '2019-09-17 06:46:43'),
(164, 'App\\Models\\Restaurant', 21, 'image', '5d808f5fb6667_louie-demun-best-new-restaurant-lg-1', '5d808f5fb6667_louie-demun-best-new-restaurant-lg-1.jpg', 'image/png', 'public', 725466, '[]', '[]', '[]', 126, '2019-09-17 06:46:43', '2019-09-17 06:46:43');

-- --------------------------------------------------------

--
-- Structure de la table `menus`
--

CREATE TABLE IF NOT EXISTS `menus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `restaurant_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `restaurant_id` (`restaurant_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=38 ;

--
-- Contenu de la table `menus`
--

INSERT INTO `menus` (`id`, `name`, `restaurant_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 'lunch', 1, '2019-09-13 09:13:13', '2019-09-13 09:13:13', NULL),
(3, 'dinner', 2, '2019-09-13 09:13:13', '2019-09-13 09:13:13', NULL),
(4, 'others', 2, '2019-09-13 09:13:13', '2019-09-13 09:13:13', NULL),
(5, 'dinner', 1, '2019-09-13 09:13:13', '2019-09-13 09:13:13', NULL),
(7, 'lunch', 2, '2019-09-13 09:13:13', '2019-09-13 09:13:13', NULL),
(8, 'breakfast', 2, '2019-09-13 09:13:13', '2019-09-13 09:13:13', NULL),
(9, 'breakfast', 18, '2019-09-13 09:13:13', '2019-09-13 09:13:13', NULL),
(10, 'lunch', 18, '2019-09-13 09:13:13', '2019-09-13 09:13:13', NULL),
(11, 'dinner', 18, '2019-09-13 09:13:13', '2019-09-13 09:13:13', NULL),
(12, 'others', 18, '2019-09-13 09:13:13', '2019-09-13 09:13:13', NULL),
(14, 'dinner', 19, '2019-09-13 09:13:13', '2019-09-13 09:13:13', NULL),
(15, 'breakfast', 19, '2019-09-13 09:13:13', '2019-09-13 09:13:13', NULL),
(16, 'lunch', 19, '2019-09-13 09:13:13', '2019-09-13 09:13:13', NULL),
(17, 'others', 19, '2019-09-13 09:13:13', '2019-09-13 09:13:13', NULL),
(18, 'others', 1, '2019-09-13 09:13:13', '2019-09-13 09:13:13', NULL),
(19, 'breakfast', 1, '2019-09-13 09:13:13', '2019-09-13 09:13:13', NULL),
(28, 'Breakfast', 24, '2019-09-13 09:13:13', '2019-09-13 09:13:13', NULL),
(29, 'Lunch', 24, '2019-09-13 09:13:13', '2019-09-13 09:13:13', NULL),
(30, 'Supper', 24, '2019-09-13 09:13:13', '2019-09-13 09:13:13', NULL),
(31, 'Others', 24, '2019-09-13 09:13:13', '2019-09-13 09:13:13', NULL),
(32, 'Breakfast', 21, '2019-09-13 09:13:13', '2019-09-13 09:13:13', NULL),
(33, 'Lunch', 21, '2019-09-13 09:13:13', '2019-09-13 09:13:13', NULL),
(34, 'Supper', 21, '2019-09-13 09:13:13', '2019-09-13 09:13:13', NULL),
(35, 'Others', 21, '2019-09-13 09:13:13', '2019-09-13 09:13:13', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `meta`
--

CREATE TABLE IF NOT EXISTS `meta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(255) DEFAULT NULL,
  `value` varchar(255) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_meta_user1_idx` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Contenu de la table `meta`
--

INSERT INTO `meta` (`id`, `key`, `value`, `user_id`, `created_at`, `updated_at`) VALUES
(2, 'theme', 'red', 3, '2019-04-11 14:22:43', '2019-04-11 15:03:45'),
(5, 'theme', 'blue', 2, '2019-06-20 13:58:41', '2019-06-20 13:58:41'),
(7, 'player_id', '4e9c630b-5fe1-4f5c-a758-943b1ceb41cb', 2, '2019-06-20 14:11:13', '2019-06-20 14:11:13'),
(8, 'player_id', 'ec3af189-5257-4f1c-8d27-f238d078dccc', 3, '2019-06-21 09:28:49', '2019-06-21 09:28:49'),
(9, 'current_resto_id', '2', 3, '2019-08-27 10:08:11', '2019-08-30 12:15:29'),
(10, 'current_resto_id', '24', 2, '2019-08-27 15:46:11', '2019-08-27 15:46:11');

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=29 ;

--
-- Contenu de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2016_06_01_000001_create_oauth_auth_codes_table', 1),
(4, '2016_06_01_000002_create_oauth_access_tokens_table', 1),
(5, '2016_06_01_000003_create_oauth_refresh_tokens_table', 1),
(6, '2016_06_01_000004_create_oauth_clients_table', 1),
(7, '2016_06_01_000005_create_oauth_personal_access_clients_table', 1),
(8, '2019_03_20_093007_create_media_table', 1),
(9, '2019_03_25_151116_create_permission_tables', 2),
(10, '2019_05_08_155911_create_notifications_table', 3),
(13, '2016_05_17_221000_create_promocodes_table', 4),
(14, '2019_05_24_150521_add_restaurant_to_promocodes_table', 4),
(15, '2013_11_26_161501_create_currency_table', 5),
(16, '2017_05_06_172817_create_cities_table', 6),
(17, '2017_05_06_173711_create_states_table', 6),
(18, '2017_05_06_173745_create_countries_table', 6),
(19, '2018_11_06_222923_create_transactions_table', 7),
(20, '2018_11_07_192923_create_transfers_table', 7),
(21, '2018_11_07_202152_update_transfers_table', 7),
(22, '2018_11_15_124230_create_wallets_table', 7),
(23, '2018_11_19_164609_update_transactions_table', 7),
(24, '2018_11_20_133759_add_fee_transfers_table', 7),
(25, '2018_11_22_131953_add_status_transfers_table', 7),
(26, '2018_11_22_133438_drop_refund_transfers_table', 7),
(27, '2019_05_13_111553_update_status_transfers_table', 7),
(28, '2019_09_19_161459_create_jobs_table', 8);

-- --------------------------------------------------------

--
-- Structure de la table `model_has_permissions`
--

CREATE TABLE IF NOT EXISTS `model_has_permissions` (
  `permission_id` int(10) unsigned NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `model_has_roles`
--

CREATE TABLE IF NOT EXISTS `model_has_roles` (
  `role_id` int(10) unsigned NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(2, 'App\\Models\\User', 1),
(5, 'App\\Models\\User', 2),
(5, 'App\\Models\\User', 3),
(4, 'App\\Models\\User', 4),
(4, 'App\\Models\\User', 5),
(5, 'App\\Models\\User', 7),
(4, 'App\\Models\\User', 11),
(5, 'App\\Models\\User', 12),
(5, 'App\\Models\\User', 13),
(5, 'App\\Models\\User', 14),
(5, 'App\\Models\\User', 15);

-- --------------------------------------------------------

--
-- Structure de la table `notations`
--

CREATE TABLE IF NOT EXISTS `notations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `notable_type` varchar(255) NOT NULL,
  `notable_id` int(11) NOT NULL,
  `comment` varchar(255) DEFAULT NULL,
  `star` int(11) DEFAULT NULL,
  `like` tinyint(1) DEFAULT NULL,
  `is_published` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_notations_user1_idx` (`user_id`),
  KEY `fk_notations_deliveries1_idx` (`notable_type`),
  KEY `fk_notations_restaurants1_idx` (`notable_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Contenu de la table `notations`
--

INSERT INTO `notations` (`id`, `user_id`, `notable_type`, `notable_id`, `comment`, `star`, `like`, `is_published`, `created_at`, `updated_at`, `deleted_at`) VALUES
(7, 3, 'App\\Models\\Shipping', 1, 'commentaire sur la livraison', 3, 0, 1, '2019-05-17 12:46:58', '2019-08-20 09:00:01', NULL),
(9, 3, 'App\\Models\\Order', 32, 'Supert le plat', 4, 1, 1, '2019-07-30 07:00:39', '2019-08-14 09:55:09', NULL),
(12, 3, 'App\\Models\\Order', 51, NULL, 0, 0, 0, '2019-09-09 15:15:40', '2019-09-10 08:54:07', '2019-09-10 08:54:07'),
(13, 3, 'App\\Models\\Order', 51, 'Doula cameroun', 4, 1, 0, '2019-09-10 08:54:18', '2019-09-10 09:15:01', '2019-09-10 09:15:01'),
(14, 3, 'App\\Models\\Order', 51, 'Supper cuison', 5, 1, 0, '2019-09-10 09:15:19', '2019-09-10 10:02:32', '2019-09-10 10:02:32'),
(15, 3, 'App\\Models\\Order', 51, 'Je suis vraiment dessus ce plat', 0, 0, 0, '2019-09-10 10:03:26', '2019-10-08 13:03:26', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `notations_has_criteria`
--

CREATE TABLE IF NOT EXISTS `notations_has_criteria` (
  `notation_id` int(11) NOT NULL,
  `criteria_id` int(11) NOT NULL,
  PRIMARY KEY (`notation_id`,`criteria_id`),
  KEY `fk_notations_has_criteria_criteria1_idx` (`criteria_id`),
  KEY `fk_notations_has_criteria_notations1_idx` (`notation_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `notations_has_criteria`
--

INSERT INTO `notations_has_criteria` (`notation_id`, `criteria_id`) VALUES
(12, 2),
(15, 2),
(15, 3),
(7, 6),
(7, 7);

-- --------------------------------------------------------

--
-- Structure de la table `notifications`
--

CREATE TABLE IF NOT EXISTS `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint(20) unsigned NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `notifiable_type`, `notifiable_id`, `data`, `read_at`, `created_at`, `updated_at`) VALUES
('006e719c-4c97-4217-a862-0ea01dba145e', 'App\\Notifications\\OrderCreated', 'App\\Models\\User', 3, '{"order":{"id":23,"number":"#00023q","created_at":"2019-06-18T08:21:45.000000Z","updated_at":"2019-06-18T08:21:45.000000Z","restaurant_id":2,"state":null}}', NULL, '2019-06-18 07:21:46', '2019-06-18 07:21:46'),
('0122fc45-d8be-4552-a85a-d887a3356df8', 'App\\Notifications\\OrderCreated', 'App\\Models\\User', 1, '{"order":{"id":87,"number":"#00087w","created_at":"2019-09-27T11:22:09.000000Z","updated_at":"2019-09-27T11:22:09.000000Z","restaurant_id":2,"status":null}}', NULL, '2019-09-27 10:22:19', '2019-09-27 10:22:19'),
('f29e2f78-5c55-4403-aa81-402aa6c454c7', 'App\\Notifications\\RestaurantCreated', 'App\\Models\\User', 3, '{"restaurant":{"id":17,"name":"Papa poulet","address":"akwa","created_at":{"date":"2019-05-22 12:43:22.000000","timezone_type":3,"timezone":"UTC"},"is_merchant":false,"profile_img":"\\/storage\\/restaurants\\/default.png"}}', '2019-06-17 06:48:38', '2019-05-22 11:43:22', '2019-06-17 06:48:38'),
('f2b22565-21f8-4b7f-b9c1-cc82b993de1c', 'App\\Notifications\\OrderCreated', 'App\\Models\\User', 3, '{"order":{"id":45,"number":"#00045n","created_at":"2019-08-01T13:50:10.000000Z","updated_at":"2019-08-01T13:50:10.000000Z","restaurant_id":1,"status":null}}', NULL, '2019-08-01 12:50:10', '2019-08-01 12:50:10'),
('f35acc70-43b1-41bd-a6ba-7c1f8c3c968f', 'App\\Notifications\\OrderCreated', 'App\\Models\\User', 1, '{"order":{"id":86,"number":"#00086q","created_at":"2019-09-26T15:27:59.000000Z","updated_at":"2019-09-26T15:27:59.000000Z","restaurant_id":18,"status":null}}', NULL, '2019-09-26 14:28:23', '2019-09-26 14:28:23');

-- --------------------------------------------------------

--
-- Structure de la table `oauth_access_tokens`
--

CREATE TABLE IF NOT EXISTS `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `client_id` int(10) unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_access_tokens_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `oauth_access_tokens`
--

INSERT INTO `oauth_access_tokens` (`id`, `user_id`, `client_id`, `name`, `scopes`, `revoked`, `created_at`, `updated_at`, `expires_at`) VALUES
('019bb95366e4016df23b95a88aff4e2f15946db04d516d1216dd013028fc508966dcba6809d528be', 5, 1, 'RestoAccessToken', '[]', 0, '2019-07-29 06:54:07', '2019-07-29 06:54:07', '2020-07-29 07:54:07'),
('036f03fd4f07c658c6e33f14061158495e32173407b89f5f89532b9d1727c70cac2e05151dfecb49', 3, 1, 'RestoAccessToken', '[]', 0, '2019-04-17 13:03:57', '2019-04-17 13:03:57', '2020-04-17 14:03:57'),
('03f8e52e2ca3826a6462162824594506d2314e727d283f4717b759c973da5ef579bbe1b482454880', 5, 1, 'RestoAccessToken', '[]', 0, '2019-07-12 11:51:56', '2019-07-12 11:51:56', '2020-07-12 12:51:56'),
('04ec9fe3664aedac071902af81160bcd17b386ca4944232f7aae079346f7da564e432b15ce292923', 5, 1, 'RestoAccessToken', '[]', 0, '2019-09-02 14:19:02', '2019-09-02 14:19:02', '2020-09-02 15:19:02'),
('05c59e0555785cebf24e045f714496ec766533fa97caf4af5a767069c8b3a975f1fa1a44db80d6a3', 3, 1, 'RestoAccessToken', '[]', 0, '2019-06-19 12:43:48', '2019-06-19 12:43:48', '2020-06-19 13:43:48'),
('0803ac2c3626c700ed148c7bb644e433742a151ab1514efaeb8ace5e5f08938b317ef7ae998695d8', 3, 1, 'RestoAccessToken', '[]', 1, '2019-07-24 14:14:48', '2019-07-24 14:14:48', '2020-07-24 15:14:48'),
('081bf4e7b6ff01096823198177d4d5db96e929418f1a781dec7dcd2755a7ef3eecfebe5442ab8156', 2, 1, 'RestoAccessToken', '[]', 0, '2019-07-24 08:37:43', '2019-07-24 08:37:43', '2020-07-24 09:37:43'),
('081d7bcca1b238794b5a9be75f8ed09c61ffd601312be669e11ca6c94f022d6be260b2b2fcf79b2b', 3, 1, 'RestoAccessToken', '[]', 0, '2019-04-17 13:26:22', '2019-04-17 13:26:22', '2020-04-17 14:26:22'),
('084b099ee264f495639c1a3da212dc135b5167837032af7de3f4e67ac13a0bf0b001276d1bbd5582', 5, 1, 'RestoAccessToken', '[]', 0, '2019-07-26 08:24:47', '2019-07-26 08:24:47', '2020-07-26 09:24:47'),
('08fc43666c35c5518d7f5e2cfff1b008fc0bc84eec67591667158380a35690c2a6c176cb7b55bafc', 3, 1, 'RestoAccessToken', '[]', 0, '2019-04-17 13:14:23', '2019-04-17 13:14:23', '2020-04-17 14:14:23'),
('0a6ad01e6248c0be743e8642ef0f799383a6709ff17af339850268c5f76abee5fb8e173d7e1322f2', 3, 1, 'RestoAccessToken', '[]', 0, '2019-07-05 13:08:46', '2019-07-05 13:08:46', '2020-07-05 14:08:46'),
('0ad521c55690bb532d9372c8d11cb3f48ae34af0828d88240d09016a7732d34265c58ed9b5ea2b16', 5, 1, 'RestoAccessToken', '[]', 0, '2019-07-13 09:31:39', '2019-07-13 09:31:39', '2020-07-13 10:31:39'),
('ffb4baad464245678bd6034013187377be2e7fcd4c46ba71ab786d18e6613709d9a05e60285836bc', 5, 1, 'RestoAccessToken', '[]', 0, '2019-09-02 12:12:50', '2019-09-02 12:12:50', '2020-09-02 13:12:50');

-- --------------------------------------------------------

--
-- Structure de la table `oauth_auth_codes`
--

CREATE TABLE IF NOT EXISTS `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `client_id` int(10) unsigned NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `oauth_clients`
--

CREATE TABLE IF NOT EXISTS `oauth_clients` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_clients_user_id_index` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=3 ;

--
-- Contenu de la table `oauth_clients`
--

INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
(1, NULL, 'E-Resto Personal Access Client', 'jn51shq5b4qebN7MOW4tK8AYSrimcwBXYJuPqjnN', 'http://localhost', 1, 0, 0, '2019-04-03 07:02:42', '2019-04-03 07:02:42'),
(2, NULL, 'E-Resto Password Grant Client', 'oasnSwKpGU1nX1whcJvdJIlYNN38gAXT0XZmx2A5', 'http://localhost', 0, 1, 0, '2019-04-03 07:02:43', '2019-04-03 07:02:43');

-- --------------------------------------------------------

--
-- Structure de la table `oauth_personal_access_clients`
--

CREATE TABLE IF NOT EXISTS `oauth_personal_access_clients` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_personal_access_clients_client_id_index` (`client_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=2 ;

--
-- Contenu de la table `oauth_personal_access_clients`
--

INSERT INTO `oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2019-04-03 07:02:42', '2019-04-03 07:02:42');

-- --------------------------------------------------------

--
-- Structure de la table `oauth_refresh_tokens`
--

CREATE TABLE IF NOT EXISTS `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `obligatory_supplements_categories`
--

CREATE TABLE IF NOT EXISTS `obligatory_supplements_categories` (
  `item_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`item_id`,`category_id`),
  KEY `fk_obligatory_supplements_categories_categories1_idx` (`category_id`),
  KEY `fk_obligatory_supplements_categories_items1_idx` (`item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `obligatory_supplements_categories`
--

INSERT INTO `obligatory_supplements_categories` (`item_id`, `category_id`) VALUES
(35, 1),
(12, 6),
(38, 6),
(42, 6),
(43, 6),
(44, 6),
(45, 6),
(75, 6);

-- --------------------------------------------------------

--
-- Structure de la table `onesignals`
--

CREATE TABLE IF NOT EXISTS `onesignals` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `player_id` varchar(255) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_onsignals_users1_idx` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
-- Contenu de la table `onesignals`
--

INSERT INTO `onesignals` (`id`, `player_id`, `user_id`) VALUES
(7, 'f56f7055-2600-4366-a2a2-acfb51b36fe7', 5),
(8, 'a55a55eb-ceb0-4642-aa89-d8b481f1fdc2', 3),
(9, 'be34a106-69a5-4d7d-b576-a39dd6b9668b', 5),
(10, '5253bf86-3bce-4ef5-98b9-0e006e046f45', 5),
(11, 'a80d761e-b8a4-4430-9dc1-7f5fb1cce565', 3),
(12, '2427e7f0-4680-4539-bdd8-8bffddecf603', 5),
(13, 'a9c71b0b-c147-42c1-bee3-ffb068d12c0b', 5),
(14, '53af46a1-e1db-4e6e-bf35-1941347d5d82', 3),
(15, '1c0dd32d-12be-4c31-9b08-dc4b8db256a2', 5),
(16, 'c5d8b6d8-b94c-4204-b260-002a07207101', 5),
(17, '2427e7f0-4680-4539-bdd8-8bffddecf603', 4),
(18, '22f837e3-e2be-4417-ba89-7c272d0fa760', 5),
(19, '9f9aaf21-36f6-407a-89d8-e9a93cb96fbb', 5),
(20, '1cfed14c-0732-415a-861b-729087fba3f9', 3);

-- --------------------------------------------------------

--
-- Structure de la table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `number` varchar(255) DEFAULT NULL,
  `comment` text,
  `coupon_data` varchar(255) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `restaurant_id` int(11) NOT NULL,
  `status` enum('pending','canceled','confirmed','ready','in_shipment','shipped') DEFAULT 'pending',
  `delay_added` time DEFAULT NULL,
  `ready_at` time DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `number_UNIQUE` (`number`),
  KEY `fk_orders_users1_idx` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=88 ;

--
-- Contenu de la table `orders`
--

INSERT INTO `orders` (`id`, `number`, `comment`, `coupon_data`, `user_id`, `restaurant_id`, `status`, `delay_added`, `ready_at`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, '00002a', 'simple commentaires', NULL, 1, 2, 'confirmed', NULL, NULL, '2019-03-22 12:37:50', '2019-04-25 13:41:14', NULL),
(31, '00031u', NULL, NULL, 3, 18, 'pending', NULL, NULL, '2019-06-20 09:36:59', '2019-06-20 09:36:59', NULL),
(32, '00032p', NULL, NULL, 3, 2, 'canceled', NULL, NULL, '2019-06-20 09:39:38', '2019-09-12 08:40:34', NULL),
(43, '00041q', NULL, NULL, 2, 18, 'confirmed', NULL, NULL, '2019-07-30 16:14:02', '2019-09-10 13:53:28', NULL),
(44, '00044m', NULL, NULL, 3, 1, 'pending', NULL, NULL, '2019-08-01 09:30:00', '2019-08-01 09:30:00', NULL),
(45, '00045n', NULL, NULL, 3, 1, 'pending', '00:05:00', NULL, '2019-08-01 13:50:10', '2019-10-08 15:37:13', NULL),
(46, '00046y', NULL, NULL, 3, 2, 'confirmed', NULL, NULL, '2019-08-01 14:05:48', '2019-09-12 08:39:32', NULL),
(47, '00047n', NULL, NULL, 3, 1, 'confirmed', NULL, NULL, '2019-08-01 14:09:06', '2019-08-01 16:09:28', NULL),
(48, '00048x', NULL, NULL, 3, 1, 'confirmed', NULL, NULL, '2019-08-01 15:58:27', '2019-09-26 16:14:40', NULL),
(49, '00049a', NULL, NULL, 2, 18, 'confirmed', '00:15:00', NULL, '2019-08-07 15:58:14', '2019-09-13 14:11:41', NULL),
(50, '00050w', NULL, NULL, 2, 18, 'pending', '00:20:00', NULL, '2019-08-08 08:44:29', '2019-09-13 13:59:23', NULL),
(51, '00051z', NULL, NULL, 3, 1, 'shipped', NULL, '17:15:00', '2019-08-08 10:11:51', '2019-08-17 12:07:11', NULL),
(52, '00052w', NULL, NULL, 3, 2, 'pending', NULL, NULL, '2019-08-13 14:22:07', '2019-09-13 10:38:31', '2019-09-13 09:38:31'),
(53, '00053r', NULL, NULL, 3, 2, 'confirmed', NULL, NULL, '2019-08-14 14:53:47', '2019-09-14 11:22:39', NULL),
(54, '00054x', NULL, NULL, 3, 1, 'confirmed', NULL, '01:15:00', '2019-08-16 16:27:26', '2019-08-21 08:33:41', NULL),
(56, '00055r', NULL, NULL, 3, 18, 'pending', NULL, NULL, '2019-08-17 10:01:38', '2019-08-17 10:01:38', NULL),
(57, '00057v', NULL, NULL, 3, 1, 'confirmed', NULL, '23:15:00', '2019-08-17 11:21:03', '2019-08-19 14:59:05', NULL),
(58, '00058t', NULL, NULL, 3, 1, 'ready', NULL, NULL, '2019-08-20 14:36:19', '2019-09-11 13:07:24', NULL),
(59, '00059n', NULL, NULL, 3, 1, 'confirmed', NULL, NULL, '2019-08-20 14:42:01', '2019-08-20 16:16:28', NULL),
(60, '00060x', NULL, NULL, 3, 18, 'in_shipment', NULL, '22:45:00', '2019-08-20 15:32:45', '2019-09-23 10:36:57', NULL),
(61, '00061a', NULL, NULL, 3, 2, 'confirmed', NULL, NULL, '2019-08-21 09:35:50', '2019-09-14 12:24:55', NULL),
(62, '00062o', NULL, NULL, 3, 18, 'confirmed', NULL, NULL, '2019-08-21 09:53:08', '2019-08-21 09:55:24', NULL),
(63, '00063n', NULL, NULL, 3, 1, 'ready', NULL, '11:00:00', '2019-08-21 10:52:44', '2019-08-22 08:34:51', NULL),
(64, '00064c', NULL, NULL, 3, 18, 'confirmed', NULL, NULL, '2019-08-21 14:58:31', '2019-09-10 13:53:03', NULL),
(65, '00065v', NULL, NULL, 3, 2, 'pending', '00:15:00', NULL, '2019-08-22 08:16:28', '2019-09-13 13:20:20', NULL),
(66, '00066r', NULL, NULL, 3, 2, 'in_shipment', NULL, '22:45:00', '2019-08-22 08:19:09', '2019-08-22 12:13:03', NULL),
(67, '00067l', NULL, NULL, 3, 2, 'in_shipment', NULL, '15:00:00', '2019-08-22 12:06:50', '2019-08-22 12:22:07', NULL),
(68, '00068e', NULL, NULL, 3, 19, 'confirmed', NULL, NULL, '2019-08-26 13:05:10', '2019-08-26 13:06:59', NULL),
(69, '00069t', NULL, NULL, 3, 1, 'in_shipment', NULL, '01:45:00', '2019-08-26 14:28:45', '2019-08-26 15:24:38', NULL),
(70, '00070q', NULL, NULL, 3, 1, 'confirmed', NULL, NULL, '2019-08-29 10:45:52', '2019-09-11 10:21:19', NULL),
(71, '00071k', NULL, NULL, 3, 1, 'ready', NULL, '16:13:13', '2019-09-02 14:21:28', '2019-09-26 16:13:13', NULL),
(72, '00072b', NULL, NULL, 3, 1, 'confirmed', NULL, NULL, '2019-09-03 07:29:05', '2019-09-11 15:26:03', '2019-09-11 14:26:03'),
(73, '00073g', NULL, NULL, 3, 1, 'ready', NULL, NULL, '2019-09-03 10:09:23', '2019-09-11 12:16:51', NULL),
(74, '00074i', NULL, NULL, 3, 24, 'pending', NULL, NULL, '2019-09-03 10:13:20', '2019-09-03 10:13:20', NULL),
(75, '00075u', NULL, NULL, 3, 2, 'pending', NULL, NULL, '2019-09-03 10:15:01', '2019-09-03 10:15:01', NULL),
(76, '00076b', NULL, NULL, 3, 1, 'canceled', NULL, NULL, '2019-09-04 09:51:38', '2019-09-09 15:58:18', NULL),
(77, '00077y', NULL, NULL, 3, 1, 'confirmed', NULL, NULL, '2019-09-13 11:06:36', '2019-09-26 16:09:58', NULL),
(78, '00078w', NULL, NULL, 3, 2, 'confirmed', NULL, NULL, '2019-09-13 11:08:09', '2019-09-14 08:59:04', NULL),
(79, '00079v', NULL, NULL, 3, 2, 'ready', NULL, '08:58:43', '2019-09-13 12:43:37', '2019-09-14 08:58:43', NULL),
(80, '00080u', NULL, NULL, 3, 2, 'confirmed', NULL, NULL, '2019-09-14 11:40:51', '2019-09-14 11:51:53', NULL),
(81, '00081o', NULL, NULL, 3, 1, 'ready', NULL, '08:17:20', '2019-09-17 11:49:55', '2019-09-19 08:17:20', NULL),
(82, '00082b', NULL, '{"code":"CSU9-VZ8L","discount_amount":"24","currency":"EUR","restaurant_id":2,"discount_type":"amount","response_code":4}', 4, 2, 'pending', NULL, NULL, '2019-09-18 07:38:25', '2019-09-18 07:38:25', NULL),
(83, '00083p', NULL, '{"code":"CSU9-VZ8L","discount_amount":"24","currency":"EUR","restaurant_id":2,"discount_type":"amount","response_code":4}', 4, 2, 'pending', NULL, NULL, '2019-09-18 08:19:30', '2019-09-18 08:19:30', NULL),
(84, '00084m', NULL, NULL, 3, 2, 'pending', NULL, NULL, '2019-09-20 13:47:41', '2019-09-20 13:47:41', NULL),
(85, '00085a', NULL, NULL, 3, 1, 'ready', NULL, '16:12:22', '2019-09-24 12:35:43', '2019-09-26 16:12:22', NULL),
(86, '00086q', NULL, NULL, 3, 18, 'pending', NULL, NULL, '2019-09-26 15:27:59', '2019-09-26 15:27:59', NULL),
(87, '00087w', NULL, NULL, 3, 2, 'pending', NULL, NULL, '2019-09-27 11:22:09', '2019-09-27 11:22:09', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `order_lines`
--

CREATE TABLE IF NOT EXISTS `order_lines` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `quantity` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `model_id` int(11) NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_price` double DEFAULT NULL,
  `comment` text,
  PRIMARY KEY (`id`),
  KEY `fk_order_line_order1_idx` (`order_id`),
  KEY `fk_order_line_meal1_idx` (`model_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=152 ;

--
-- Contenu de la table `order_lines`
--

INSERT INTO `order_lines` (`id`, `quantity`, `order_id`, `model_id`, `model_type`, `model_price`, `comment`) VALUES
(23, 1, 2, 6, 'App\\Models\\Item', 1200, NULL),
(38, 1, 31, 8, 'App\\Models\\Item', 500, NULL),
(39, 2, 32, 4, 'App\\Models\\Item', 700, NULL),
(77, 2, 43, 9, 'App\\Models\\Item', 5400, 'un commentaire, lorem ipsum dolar'),
(78, 2, 43, 8, 'App\\Models\\Item', 500, 'un commentaire, lorem ipsum dolar'),
(79, 2, 44, 1, 'App\\Models\\Item', 500, NULL),
(80, 3, 44, 5, 'App\\Models\\Supplement', 500, NULL),
(81, 2, 44, 3, 'App\\Models\\Item', 700, NULL),
(82, 3, 44, 7, 'App\\Models\\Supplement', 500, NULL),
(83, 2, 44, 2, 'App\\Models\\Supplement', 150, NULL),
(84, 2, 45, 3, 'App\\Models\\Item', 700, NULL),
(85, 1, 46, 42, 'App\\Models\\Item', 3500, NULL),
(86, 1, 46, 47, 'App\\Models\\Supplement', 800, NULL),
(87, 1, 47, 1, 'App\\Models\\Item', 500, NULL),
(88, 1, 47, 5, 'App\\Models\\Supplement', 500, NULL),
(89, 1, 48, 1, 'App\\Models\\Item', 500, NULL),
(90, 1, 48, 5, 'App\\Models\\Supplement', 500, NULL),
(91, 2, 49, 9, 'App\\Models\\Item', 5400, 'un commentaire, lorem ipsum dolar'),
(92, 2, 49, 8, 'App\\Models\\Item', 500, 'un commentaire, lorem ipsum dolar'),
(93, 2, 50, 9, 'App\\Models\\Item', 5400, 'un commentaire, lorem ipsum dolar'),
(94, 2, 50, 8, 'App\\Models\\Item', 500, 'un commentaire, lorem ipsum dolar'),
(95, 2, 51, 1, 'App\\Models\\Item', 500, NULL),
(96, 1, 52, 44, 'App\\Models\\Item', 3500, 'test comment'),
(97, 1, 52, 47, 'App\\Models\\Supplement', 800, NULL),
(98, 1, 53, 41, 'App\\Models\\Item', 4500, NULL),
(99, 1, 54, 3, 'App\\Models\\Item', 700, NULL),
(101, 2, 56, 8, 'App\\Models\\Item', 500, NULL),
(102, 2, 57, 3, 'App\\Models\\Item', 700, NULL),
(103, 1, 58, 3, 'App\\Models\\Item', 700, NULL),
(104, 1, 59, 13, 'App\\Models\\Item', 2500, NULL),
(105, 2, 60, 21, 'App\\Models\\Item', 1000, NULL),
(106, 1, 61, 43, 'App\\Models\\Item', 3998, NULL),
(107, 1, 61, 47, 'App\\Models\\Supplement', 800, NULL),
(108, 1, 62, 20, 'App\\Models\\Supplement', 1000, NULL),
(109, 1, 62, 19, 'App\\Models\\Supplement', 1000, NULL),
(110, 2, 62, 21, 'App\\Models\\Item', 1000, NULL),
(111, 2, 63, 3, 'App\\Models\\Item', 700, NULL),
(112, 2, 64, 8, 'App\\Models\\Item', 500, NULL),
(113, 1, 65, 41, 'App\\Models\\Item', 4500, NULL),
(114, 1, 66, 41, 'App\\Models\\Item', 4500, NULL),
(115, 1, 67, 41, 'App\\Models\\Item', 4500, NULL),
(116, 2, 68, 38, 'App\\Models\\Item', 4500, NULL),
(117, 1, 68, 39, 'App\\Models\\Item', 0, NULL),
(118, 3, 68, 11, 'App\\Models\\Item', 2000, NULL),
(119, 1, 69, 12, 'App\\Models\\Item', 4000, NULL),
(120, 1, 69, 25, 'App\\Models\\Supplement', 0, NULL),
(121, 2, 69, 3, 'App\\Models\\Item', 700, NULL),
(122, 2, 69, 5, 'App\\Models\\Supplement', 500, NULL),
(123, 1, 70, 3, 'App\\Models\\Item', 700, NULL),
(124, 1, 70, 27, 'App\\Models\\Supplement', 1000, NULL),
(125, 2, 71, 12, 'App\\Models\\Item', 4000, NULL),
(126, 1, 73, 3, 'App\\Models\\Item', 700, NULL),
(127, 1, 73, 27, 'App\\Models\\Supplement', 1000, NULL),
(128, 1, 74, 65, 'App\\Models\\Item', 400, NULL),
(129, 1, 75, 43, 'App\\Models\\Item', 3998, NULL),
(130, 2, 76, 3, 'App\\Models\\Item', 700, NULL),
(131, 1, 76, 27, 'App\\Models\\Supplement', 1000, NULL),
(132, 2, 76, 12, 'App\\Models\\Item', 4000, NULL),
(133, 1, 76, 25, 'App\\Models\\Supplement', 0, NULL),
(134, 3, 76, 13, 'App\\Models\\Item', 2500, NULL),
(135, 1, 77, 12, 'App\\Models\\Item', 4000, NULL),
(136, 1, 78, 41, 'App\\Models\\Item', 4500, NULL),
(137, 1, 79, 42, 'App\\Models\\Item', 3500, NULL),
(138, 3, 79, 44, 'App\\Models\\Item', 3500, NULL),
(139, 2, 79, 48, 'App\\Models\\Item', 1500, NULL),
(140, 1, 80, 44, 'App\\Models\\Item', 3500, NULL),
(141, 2, 80, 45, 'App\\Models\\Item', 2500, NULL),
(142, 1, 81, 3, 'App\\Models\\Item', 700, NULL),
(143, 1, 81, 27, 'App\\Models\\Supplement', 1000, NULL),
(144, 2, 82, 48, 'App\\Models\\Item', 1500, 'un commentaire, lorem ipsum dolar'),
(145, 2, 83, 48, 'App\\Models\\Item', 1500, 'un commentaire, lorem ipsum dolar'),
(146, 3, 84, 44, 'App\\Models\\Item', 3500, NULL),
(147, 2, 85, 3, 'App\\Models\\Item', 700, NULL),
(148, 1, 85, 27, 'App\\Models\\Supplement', 1000, NULL),
(149, 2, 85, 12, 'App\\Models\\Item', 4000, NULL),
(150, 2, 86, 78, 'App\\Models\\Item', 40, NULL),
(151, 2, 87, 42, 'App\\Models\\Item', 3500, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `password_resets`
--

CREATE TABLE IF NOT EXISTS `password_resets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=6 ;

--
-- Contenu de la table `password_resets`
--

INSERT INTO `password_resets` (`id`, `email`, `token`, `created_at`, `updated_at`) VALUES
(2, 'hello@example.com', 'Qpb8q4dHUM981qMqAeEb7RqM2FcqrYKgMuSNrBsnmLjgrDt3c1xwNwG24PZi', '2019-06-25 06:53:32', '2019-06-25 07:53:32'),
(3, 'john@johndoe.com', 'iI3O0mp7RW1fO9Q8VkI6mkCgEZG6SFeXEvlQj6NQ1ewoJ2UFTQN6fZljJXto', '2019-06-25 06:56:03', '2019-06-25 12:27:31'),
(4, 'admin@example.com', '$2y$10$crYh6.8I6q55EXu0epWg..uyFooiGa9IyxOy8SItYUpEu3haNx1qG', '2019-06-25 11:08:43', NULL),
(5, 'user@example.com', '$2y$10$Q1HK7VYn22vtKoenDO3zVuvesvuy5dmUUh6w/36rvrJFWHKJlDsZm', '2019-08-30 12:01:27', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `payments`
--

CREATE TABLE IF NOT EXISTS `payments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `payment_id` varchar(255) DEFAULT NULL,
  `amount_paid` int(11) DEFAULT NULL,
  `meta` text,
  `status` enum('deposit','undeposit') NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `payment_method_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`,`invoice_id`,`payment_method_id`),
  KEY `fk_payments_invoices1_idx` (`invoice_id`),
  KEY `fk_payments_payment_method1_idx` (`payment_method_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=48 ;

--
-- Contenu de la table `payments`
--

INSERT INTO `payments` (`id`, `user_id`, `payment_id`, `amount_paid`, `meta`, `status`, `invoice_id`, `payment_method_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, '5ydnhd-sdnf-dskjn-iu', 1000, '{"foo":"bar"}', 'deposit', 1, 2, '2019-07-30 16:09:55', '2019-07-30 16:10:47', NULL),
(3, 3, 'ppp-dsf-dfd-dfds-df', 1000, '{"foo":"bar"}', 'deposit', 1, 3, '2019-07-30 16:09:55', '2019-07-30 16:10:47', NULL),
(4, 2, NULL, NULL, '{"foo":"bar"}', 'undeposit', 16, 1, '2019-07-30 15:14:02', '2019-07-30 15:14:02', NULL),
(5, 3, NULL, NULL, '"{}"', 'undeposit', 17, 1, '2019-08-01 08:30:01', '2019-08-01 08:30:01', NULL),
(6, 3, NULL, NULL, '"{}"', 'undeposit', 18, 1, '2019-08-01 12:50:10', '2019-08-01 12:50:10', NULL),
(7, 3, NULL, NULL, '"{}"', 'undeposit', 19, 1, '2019-08-01 13:05:48', '2019-08-01 13:05:48', NULL),
(8, 3, NULL, NULL, '"{}"', 'undeposit', 20, 1, '2019-08-01 13:09:06', '2019-08-01 13:09:06', NULL),
(9, 3, NULL, NULL, '"{}"', 'undeposit', 21, 1, '2019-08-01 14:58:27', '2019-08-01 14:58:27', NULL),
(10, 2, 'tnhd-sdnf-dskjn-iuop-kcdd', 3000, '{"foo":"bar"}', 'deposit', 22, 2, '2019-08-07 14:58:14', '2019-08-07 14:58:14', NULL),
(11, 2, 'tnhd-sdnf-dskjn-iuop-kcdd', 3000, '{"foo":"bar"}', 'deposit', 23, 2, '2019-08-08 07:44:29', '2019-08-08 07:44:29', NULL),
(12, 3, NULL, NULL, '"{}"', 'undeposit', 24, 1, '2019-08-08 09:11:53', '2019-08-08 09:11:53', NULL),
(13, 3, NULL, NULL, '"{}"', 'undeposit', 25, 1, '2019-08-13 13:22:11', '2019-09-13 09:38:31', '2019-09-13 09:38:31'),
(14, 3, NULL, NULL, '"{}"', 'undeposit', 26, 1, '2019-08-14 13:53:49', '2019-08-14 13:53:49', NULL),
(15, 3, NULL, NULL, '"{}"', 'undeposit', 27, 1, '2019-08-16 15:27:30', '2019-08-16 15:27:30', NULL),
(17, 3, NULL, NULL, '"{}"', 'undeposit', 29, 1, '2019-08-17 09:01:39', '2019-08-17 09:01:39', NULL),
(18, 3, NULL, NULL, '"{}"', 'deposit', 30, 1, '2019-08-17 10:21:05', '2019-08-20 13:44:21', NULL),
(19, 3, NULL, NULL, '"{}"', 'undeposit', 31, 1, '2019-08-20 13:36:21', '2019-08-20 13:36:21', NULL),
(20, 3, NULL, 3000, '"{}"', 'deposit', 32, 1, '2019-08-20 13:42:03', '2019-08-20 14:11:48', NULL),
(21, 3, NULL, NULL, '"{}"', 'undeposit', 33, 1, '2019-08-20 14:32:49', '2019-08-20 14:32:49', NULL),
(22, 3, NULL, NULL, '"{}"', 'undeposit', 34, 1, '2019-08-21 08:35:52', '2019-08-21 08:35:52', NULL),
(23, 3, NULL, NULL, '"{}"', 'undeposit', 35, 1, '2019-08-21 08:53:09', '2019-08-21 08:53:09', NULL),
(24, 3, NULL, NULL, '"{}"', 'undeposit', 36, 1, '2019-08-21 09:52:46', '2019-08-21 09:52:46', NULL),
(25, 3, NULL, NULL, '"{}"', 'undeposit', 37, 1, '2019-08-21 13:58:34', '2019-08-21 13:58:34', NULL),
(26, 3, NULL, NULL, '"{}"', 'undeposit', 38, 1, '2019-08-22 07:16:31', '2019-08-22 07:16:31', NULL),
(27, 3, NULL, NULL, '"{}"', 'undeposit', 39, 1, '2019-08-22 07:19:10', '2019-08-22 07:19:10', NULL),
(28, 3, NULL, NULL, '"{}"', 'undeposit', 40, 1, '2019-08-22 11:06:52', '2019-08-22 11:06:52', NULL),
(29, 3, NULL, 15500, '"{}"', 'deposit', 41, 1, '2019-08-26 12:05:24', '2019-08-27 06:59:40', NULL),
(30, 3, NULL, 6900, '"{}"', 'deposit', 42, 1, '2019-08-26 13:28:53', '2019-08-27 06:56:26', NULL),
(31, 3, NULL, NULL, '"{}"', 'undeposit', 43, 1, '2019-08-29 09:46:08', '2019-08-29 09:46:08', NULL),
(32, 3, 'PAYID-LVWSKXQ2CB24154UV435940D', 8002, '"{\\"client\\":{\\"environment\\":\\"sandbox\\",\\"paypal_sdk_version\\":\\"2.15.3\\",\\"platform\\":\\"Android\\",\\"product_name\\":\\"PayPal-Android-SDK\\"},\\"response\\":{\\"create_time\\":\\"2019-09-02T14:21:18Z\\",\\"id\\":\\"PAYID-LVWSKXQ2CB24154UV435940D\\",\\"intent\\":\\"sale\\",\\"state\\":\\"approved\\"},\\"response_type\\":\\"payment\\"}"', 'deposit', 44, 5, '2019-09-02 13:21:37', '2019-09-02 13:21:37', NULL),
(33, 3, 'PAYID-LVXBMLA2BN35822KV198393T', 1702, '"{\\"client\\":{\\"environment\\":\\"sandbox\\",\\"paypal_sdk_version\\":\\"2.15.3\\",\\"platform\\":\\"Android\\",\\"product_name\\":\\"PayPal-Android-SDK\\"},\\"response\\":{\\"create_time\\":\\"2019-09-03T07:28:44Z\\",\\"id\\":\\"PAYID-LVXBMLA2BN35822KV198393T\\",\\"intent\\":\\"sale\\",\\"state\\":\\"approved\\"},\\"response_type\\":\\"payment\\"}"', 'deposit', 45, 5, '2019-09-03 06:29:14', '2019-09-11 14:26:03', '2019-09-11 14:26:03'),
(34, 3, 'ch_1FEYwvBtvNfyZFZRl8r3pPLU', 170220, '"{\\"stripeToken\\":\\"tok_1FEGTaBtvNfyZFZRlgoYnGks\\",\\"amount\\":1702.2}"', 'deposit', 46, 4, '2019-09-03 09:09:29', '2019-09-03 09:09:29', NULL),
(35, 3, NULL, NULL, '"{}"', 'undeposit', 47, 1, '2019-09-03 09:13:27', '2019-09-03 09:13:27', NULL),
(36, 3, NULL, NULL, '"{}"', 'undeposit', 48, 1, '2019-09-03 09:15:08', '2019-09-03 09:15:08', NULL),
(37, 3, NULL, NULL, '"{}"', 'undeposit', 49, 1, '2019-09-04 08:51:49', '2019-09-04 08:51:49', NULL),
(38, 3, NULL, NULL, '"{}"', 'undeposit', 50, 1, '2019-09-13 10:06:50', '2019-09-13 10:06:50', NULL),
(39, 3, NULL, NULL, '"{}"', 'undeposit', 51, 1, '2019-09-13 10:08:15', '2019-09-13 10:08:15', NULL),
(40, 3, NULL, NULL, '"{}"', 'undeposit', 52, 1, '2019-09-13 11:43:45', '2019-09-13 11:43:45', NULL),
(41, 3, NULL, NULL, '"{}"', 'undeposit', 53, 1, '2019-09-14 10:40:59', '2019-09-14 10:40:59', NULL),
(42, 3, NULL, NULL, '"{}"', 'undeposit', 54, 1, '2019-09-17 10:50:20', '2019-09-17 10:50:20', NULL),
(43, 4, 'tnhd-sdnf-dskjn-iuop-kcdd', 3000, '{"foo":"bar"}', 'deposit', 55, 2, '2019-09-18 07:19:36', '2019-09-18 07:19:36', NULL),
(44, 3, NULL, NULL, '"{}"', 'undeposit', 56, 1, '2019-09-20 12:47:51', '2019-09-20 12:47:51', NULL),
(45, 3, NULL, NULL, '"{}"', 'undeposit', 57, 1, '2019-09-24 11:35:52', '2019-09-24 11:35:52', NULL),
(46, 3, NULL, NULL, '"{}"', 'undeposit', 58, 1, '2019-09-26 14:28:26', '2019-09-26 14:28:26', NULL),
(47, 3, NULL, NULL, '"{}"', 'undeposit', 59, 1, '2019-09-27 10:22:19', '2019-09-27 10:22:19', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `payment_methods`
--

CREATE TABLE IF NOT EXISTS `payment_methods` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `code` varchar(255) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `description` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `payment_methods`
--

INSERT INTO `payment_methods` (`id`, `name`, `code`, `active`, `description`, `created_at`, `updated_at`) VALUES
(1, 'paiement à la livraison ', 'cashondelivery', 1, 'Lorem ipsum dolor', '2019-07-31 14:37:43', '2019-10-07 12:47:10'),
(2, 'paiement via orange money', 'orangemoney', 1, 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Saepe, eos ipsam laborum tempora sed voluptas.', '2019-07-31 14:37:43', '2019-10-08 06:18:06'),
(3, 'paiement via mtn money', 'mtnmoney', 1, 'Lorem ipsum dolor, sit amet consectetur.', '2019-07-31 14:37:43', '2019-10-03 14:33:55'),
(4, 'paiement via stripe', 'stripe', 1, 'Lorem ipsum dolor.', '2019-07-31 14:37:43', '2019-07-31 14:37:43'),
(5, 'paiement via paypal', 'paypal', 1, 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Saepe, eos ipsam laborum tempora sed voluptas.', '2019-07-31 14:37:43', '2019-07-31 14:37:43');

-- --------------------------------------------------------

--
-- Structure de la table `permissions`
--

CREATE TABLE IF NOT EXISTS `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=13 ;

--
-- Contenu de la table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'create users', 'web', '2019-03-26 13:14:53', '2019-03-26 13:14:53'),
(2, 'edit users', 'web', '2019-03-26 13:14:53', '2019-03-26 13:14:53'),
(3, 'delete users', 'web', '2019-03-26 13:14:53', '2019-03-26 13:14:53'),
(4, 'create restauramts', 'web', '2019-03-26 13:14:53', '2019-03-26 13:14:53'),
(5, 'edit restauramts', 'web', '2019-03-26 13:14:53', '2019-03-26 13:14:53'),
(6, 'delete restauramts', 'web', '2019-03-26 13:14:53', '2019-03-26 13:14:53'),
(7, 'create items', 'web', '2019-03-26 13:14:53', '2019-04-01 11:59:55'),
(8, 'edit items', 'web', '2019-03-26 13:14:53', '2019-04-01 12:00:17'),
(9, 'delete items', 'web', '2019-03-26 13:14:53', '2019-04-01 12:00:28'),
(10, 'create orders', 'web', '2019-03-26 13:14:53', '2019-03-28 08:17:28'),
(11, 'edit orders', 'web', '2019-03-26 13:14:53', '2019-03-26 13:14:53'),
(12, 'delete orders', 'web', '2019-03-26 13:14:53', '2019-03-26 13:14:53');

-- --------------------------------------------------------

--
-- Structure de la table `programmes`
--

CREATE TABLE IF NOT EXISTS `programmes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `day_id` int(11) NOT NULL,
  `open_time` time DEFAULT NULL,
  `close_time` time NOT NULL,
  `restaurant_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_schedule_restaurants1_idx` (`restaurant_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=82 ;

--
-- Contenu de la table `programmes`
--

INSERT INTO `programmes` (`id`, `day_id`, `open_time`, `close_time`, `restaurant_id`) VALUES
(3, 1, '06:00:00', '16:00:00', 1),
(4, 2, '07:15:00', '17:00:00', 1),
(9, 3, '08:00:00', '22:30:00', 1),
(10, 1, '09:00:00', '16:15:00', 2),
(11, 2, '08:15:00', '17:15:00', 2),
(24, 1, '06:00:00', '16:30:00', 18),
(25, 1, '06:00:00', '16:00:00', 19),
(26, 4, '08:15:00', '21:15:00', 1),
(27, 5, '08:15:00', '21:15:00', 1),
(28, 3, '07:30:00', '19:30:00', 2),
(29, 4, '08:30:00', '18:30:00', 2),
(30, 5, '08:30:00', '18:30:00', 2),
(31, 2, '07:15:00', '17:15:00', 18),
(32, 6, '07:15:00', '22:15:00', 2),
(33, 6, '06:15:00', '23:15:00', 1),
(34, 7, '07:15:00', '20:15:00', 1),
(35, 3, '07:15:00', '17:15:00', 18),
(36, 4, '07:15:00', '17:15:00', 18),
(37, 5, '07:15:00', '17:15:00', 18),
(38, 6, '07:15:00', '17:15:00', 18),
(39, 7, '07:15:00', '18:15:00', 18),
(53, 1, '06:00:00', '16:00:00', 21),
(68, 1, '08:00:00', '22:00:00', 24),
(69, 2, '08:00:00', '22:00:00', 24),
(70, 3, '08:00:00', '22:00:00', 24),
(71, 4, '08:00:00', '22:00:00', 24),
(72, 5, '08:00:00', '22:00:00', 24),
(73, 6, '10:00:00', '22:00:00', 24),
(74, 7, '13:00:00', '18:00:00', 24),
(75, 2, '06:00:00', '17:00:00', 21),
(76, 3, '06:00:00', '17:00:00', 21),
(77, 4, '06:00:00', '17:00:00', 21),
(78, 5, '06:00:00', '17:00:00', 21),
(79, 6, '08:00:00', '18:00:00', 21),
(80, 7, '12:00:00', '19:00:00', 21);

-- --------------------------------------------------------

--
-- Structure de la table `promocodes`
--

CREATE TABLE IF NOT EXISTS `promocodes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `restaurant_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `reward` double(10,2) DEFAULT NULL,
  `data` text COLLATE utf8mb4_unicode_ci,
  `is_disposable` tinyint(1) NOT NULL DEFAULT '0',
  `expires_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `promocodes_code_unique` (`code`),
  KEY `promocodes_restaurant_id_index` (`restaurant_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=21 ;

--
-- Contenu de la table `promocodes`
--

INSERT INTO `promocodes` (`id`, `code`, `restaurant_id`, `quantity`, `reward`, `data`, `is_disposable`, `expires_at`) VALUES
(18, 'STL9-9MNK', 18, NULL, NULL, '{"discount_type":"percent","coupon_type":"all_user","coupon_description":"test descript","validity_date":"25\\/09\\/2019 - 08\\/10\\/2019","start_at":"25\\/09\\/2019","end_at":"08\\/10\\/2019","discount_percent":"10", "coupon_creation_type":"automatic"}', 0, '2019-10-08 12:38:04'),
(19, 'just4you', 1, NULL, NULL, '{"discount_type":"percent","coupon_type":"all_user","coupon_description":"special promotion","validity_date":"10\\/10\\/2019 - 12\\/10\\/2019","start_at":"10\\/10\\/2019","end_at":"12\\/10\\/2019","discount_percent":"10", "coupon_creation_type":"manual"}', 0, '2019-10-12 07:04:10'),
(20, 'JYS3-86GP', 1, NULL, NULL, '{"discount_type":"percent","coupon_type":"one_user","coupon_description":"special promotion","validity_date":"11\\/10\\/2019 - 12\\/10\\/2019","start_at":"11\\/10\\/2019","end_at":"12\\/10\\/2019","discount_percent":"2", "coupon_creation_type": "automatic"}', 1, '2019-10-12 10:04:14');

-- --------------------------------------------------------

--
-- Structure de la table `promocode_user`
--

CREATE TABLE IF NOT EXISTS `promocode_user` (
  `user_id` int(11) NOT NULL,
  `promocode_id` int(10) unsigned NOT NULL,
  `used_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`user_id`,`promocode_id`),
  KEY `promocode_user_promocode_id_foreign` (`promocode_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `restaurants`
--

CREATE TABLE IF NOT EXISTS `restaurants` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `description` text,
  `is_merchant` tinyint(1) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `is_open` tinyint(1) NOT NULL DEFAULT '1',
  `shipping_fee` double DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deliveries_time` time DEFAULT NULL,
  `preparation_time` time DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=30 ;

--
-- Contenu de la table `restaurants`
--

INSERT INTO `restaurants` (`id`, `name`, `description`, `is_merchant`, `user_id`, `active`, `is_open`, `shipping_fee`, `created_at`, `updated_at`, `deleted_at`, `deliveries_time`, `preparation_time`) VALUES
(1, 'Rosty', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorum, repudiandae!', 0, 3, 1, 1, NULL, '2019-03-22 12:32:01', '2019-10-11 08:51:10', NULL, '01:05:00', '00:20:00'),
(2, 'Tchopetyamo', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorum, repudiandae!', 0, 7, 1, 1, NULL, '2019-03-22 12:32:01', '2019-10-07 15:27:02', NULL, '01:00:00', '00:50:00'),
(18, 'KADJIJA', 'le restaurant le plus chic de AKWA. Nous vous proposons de...', 1, 14, 1, 1, NULL, '2019-05-22 12:50:15', '2019-08-19 14:27:20', NULL, '00:25:00', '10:00:00'),
(19, 'Les Petits Rousseaux', 'Les petits rousseaux mettent a votre disposition plusieurs plat américain', 1, 13, 1, 1, NULL, '2019-05-27 12:15:17', '2019-10-07 12:50:19', NULL, '00:35:00', '01:00:00'),
(21, 'One Stop Restaurant', 'One Stop Restaurant is where you can find the best of Cameroonian dishes.Place your orders now', 0, 2, 1, 1, NULL, '2019-08-27 13:24:41', '2019-09-17 07:47:31', NULL, '01:00:00', '00:30:00'),
(24, 'Nessa Kitchen', 'Nessa Kitchen is a Restaurant which provides 80% Cameroonian dishes and a 20% intercontinental.', 0, 12, 1, 1, NULL, '2019-08-27 14:18:38', '2019-10-11 16:18:58', NULL, '00:45:00', '00:45:00');

-- --------------------------------------------------------

--
-- Structure de la table `restaurants_has_cuisines`
--

CREATE TABLE IF NOT EXISTS `restaurants_has_cuisines` (
  `restaurant_id` int(11) NOT NULL,
  `cuisine_id` int(11) NOT NULL,
  PRIMARY KEY (`restaurant_id`,`cuisine_id`),
  KEY `fk_restaurants_has_cuisine_cuisine1_idx` (`cuisine_id`),
  KEY `fk_restaurants_has_cuisine_restaurants1_idx` (`restaurant_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `restaurants_has_cuisines`
--

INSERT INTO `restaurants_has_cuisines` (`restaurant_id`, `cuisine_id`) VALUES
(1, 1),
(2, 1),
(18, 1),
(21, 1),
(24, 1);

-- --------------------------------------------------------

--
-- Structure de la table `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=6 ;

--
-- Contenu de la table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(2, 'super-admin', 'web', '2019-03-26 13:14:17', '2019-03-26 13:14:17'),
(4, 'shipper', 'web', '2019-03-26 13:14:53', '2019-03-26 13:14:53'),
(5, 'shop-admin', 'web', '2019-03-26 13:14:53', '2019-03-26 13:14:53');

-- --------------------------------------------------------

--
-- Structure de la table `role_has_permissions`
--

CREATE TABLE IF NOT EXISTS `role_has_permissions` (
  `permission_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 2),
(2, 2),
(3, 2),
(4, 2),
(5, 2),
(6, 2),
(7, 2),
(8, 2),
(9, 2),
(10, 2),
(11, 2),
(12, 2),
(4, 5),
(5, 5),
(6, 5),
(7, 5),
(8, 5),
(9, 5),
(10, 5),
(11, 5),
(12, 5);

-- --------------------------------------------------------

--
-- Structure de la table `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(255) NOT NULL,
  `value` longtext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Contenu de la table `settings`
--

INSERT INTO `settings` (`id`, `key`, `value`) VALUES
(1, 'strype_id', '12345679'),
(2, 'privacy_policy', '<p>Write your privacy policy <strong>here</strong></p>'),
(3, 'terms_of_use', '<p>Write your terms of use here djskhfalsjl</p>'),
(4, 'email_support', 'info@ubereats.com'),
(5, 'phone_number_support', '111222'),
(6, 'language_code', 'fr-FR'),
(7, 'currency_code', 'EUR'),
(8, 'shipping_fee', '50'),
(9, 'service_zone_radius', '30'),
(10, 'service_zone_gmap_address', '{"address_components":[{"long_name":"60","short_name":"60","types":["street_number"]},{"long_name":"Rue de Rivoli","short_name":"Rue de Rivoli","types":["route"]},{"long_name":"Paris","short_name":"Paris","types":["locality","political"]},{"long_name":"Arrondissement de Paris","short_name":"Arrondissement de Paris","types":["administrative_area_level_2","political"]},{"long_name":"Île-de-France","short_name":"Île-de-France","types":["administrative_area_level_1","political"]},{"long_name":"France","short_name":"FR","types":["country","political"]},{"long_name":"75004","short_name":"75004","types":["postal_code"]}],"formatted_address":"60 Rue de Rivoli, 75004 Paris, France","geometry":{"location":{"lat":48.856908,"lng":2.3524260000000368},"location_type":"ROOFTOP","viewport":{"south":48.85555901970849,"west":2.351077019708555,"north":48.85825698029149,"east":2.3537749802915187}},"place_id":"ChIJm2azmx1u5kcRUSXLOaqIVhI","plus_code":{"compound_code":"V942+QX Paris, France","global_code":"8FW4V942+QX"},"types":["street_address"]}'),
(11, 'ubereats_fee_percent', '5'),
(12, 'max_simultaneous_shipments', '1');

-- --------------------------------------------------------

--
-- Structure de la table `shippings`
--

CREATE TABLE IF NOT EXISTS `shippings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fee` double DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `order_id` int(11) NOT NULL,
  `status` enum('pending','canceled','planned','in_progress','done') NOT NULL,
  `shipped_at` datetime DEFAULT NULL,
  `planned_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_deliveries_user1_idx` (`user_id`),
  KEY `fk_deliveries_order1_idx` (`order_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=62 ;

--
-- Contenu de la table `shippings`
--

INSERT INTO `shippings` (`id`, `fee`, `user_id`, `order_id`, `status`, `shipped_at`, `planned_at`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 500, NULL, 2, 'pending', '2019-06-12 08:00:19', NULL, '2019-06-12 16:29:29', '2019-06-12 16:29:29', NULL),
(10, 500, NULL, 31, 'pending', NULL, NULL, '2019-06-20 08:36:59', '2019-06-20 08:36:59', NULL),
(11, 500, NULL, 32, 'canceled', NULL, NULL, '2019-06-20 08:39:38', '2019-09-12 07:40:34', NULL),
(18, 500, NULL, 43, 'pending', NULL, '2019-07-30 12:30:30', '2019-07-30 15:14:02', '2019-09-10 12:53:28', NULL),
(19, 500, NULL, 44, 'pending', NULL, NULL, '2019-08-01 08:30:00', '2019-08-01 08:30:00', NULL),
(20, 500, NULL, 45, 'pending', NULL, NULL, '2019-08-01 12:50:10', '2019-08-01 12:50:10', NULL),
(21, 500, NULL, 46, 'pending', NULL, NULL, '2019-08-01 13:05:48', '2019-09-12 07:39:32', NULL),
(22, 500, NULL, 47, 'pending', NULL, NULL, '2019-08-01 13:09:06', '2019-08-01 15:09:28', NULL),
(23, 500, NULL, 48, 'pending', NULL, NULL, '2019-08-01 14:58:27', '2019-09-26 15:14:41', NULL),
(24, 500, NULL, 49, 'pending', NULL, '2019-07-30 12:30:30', '2019-08-07 14:58:14', '2019-09-13 13:11:41', NULL),
(25, 500, NULL, 50, 'pending', NULL, '2019-07-30 12:30:30', '2019-08-08 07:44:29', '2019-08-08 07:44:29', NULL),
(26, 500, 5, 51, 'done', '2019-08-17 12:07:11', NULL, '2019-08-08 09:11:52', '2019-08-17 11:07:11', NULL),
(27, 500, NULL, 53, 'pending', NULL, NULL, '2019-08-14 13:53:49', '2019-09-14 10:22:39', NULL),
(28, 500, NULL, 54, 'canceled', NULL, NULL, '2019-08-16 15:27:30', '2019-08-20 08:47:23', NULL),
(30, 500, NULL, 56, 'pending', NULL, NULL, '2019-08-17 09:01:39', '2019-08-17 09:01:39', NULL),
(31, 500, 5, 57, 'planned', NULL, NULL, '2019-08-17 10:21:04', '2019-08-20 09:30:52', NULL),
(32, 500, NULL, 58, 'pending', NULL, NULL, '2019-08-20 13:36:21', '2019-08-20 13:36:21', NULL),
(33, 500, NULL, 59, 'pending', NULL, NULL, '2019-08-20 13:42:02', '2019-08-20 15:16:28', NULL),
(34, 500, 5, 60, 'in_progress', NULL, NULL, '2019-08-20 14:32:49', '2019-09-23 09:36:57', NULL),
(35, 500, NULL, 61, 'pending', NULL, NULL, '2019-08-21 08:35:52', '2019-09-14 11:24:55', NULL),
(36, 500, NULL, 62, 'pending', NULL, NULL, '2019-08-21 08:53:08', '2019-08-21 08:55:24', NULL),
(37, 500, NULL, 63, 'pending', NULL, NULL, '2019-08-21 09:52:46', '2019-08-21 09:55:33', NULL),
(38, 500, NULL, 64, 'pending', NULL, NULL, '2019-08-21 13:58:34', '2019-09-10 12:53:03', NULL),
(39, 500, NULL, 65, 'pending', NULL, '2019-07-30 12:30:30', '2019-08-22 07:16:31', '2019-08-22 07:16:31', NULL),
(40, 500, 5, 66, 'planned', NULL, NULL, '2019-08-22 07:19:10', '2019-08-22 11:17:29', NULL),
(41, 500, 5, 67, 'planned', NULL, NULL, '2019-08-22 11:06:52', '2019-09-17 11:06:34', NULL),
(42, 500, NULL, 68, 'pending', NULL, NULL, '2019-08-26 12:05:24', '2019-08-26 12:06:59', NULL),
(43, 500, 5, 69, 'in_progress', NULL, NULL, '2019-08-26 13:28:52', '2019-08-26 14:24:38', NULL),
(44, 500, NULL, 70, 'pending', NULL, NULL, '2019-08-29 09:46:08', '2019-09-11 09:21:20', NULL),
(45, 500, NULL, 71, 'pending', NULL, NULL, '2019-09-02 13:21:37', '2019-09-10 08:10:13', NULL),
(46, 500, NULL, 72, 'pending', NULL, NULL, '2019-09-03 06:29:14', '2019-09-11 12:39:59', '2019-09-11 12:39:59'),
(47, 500, NULL, 73, 'pending', NULL, NULL, '2019-09-03 09:09:29', '2019-09-10 08:06:13', NULL),
(48, 500, NULL, 74, 'pending', NULL, NULL, '2019-09-03 09:13:26', '2019-09-03 09:13:26', NULL),
(49, 500, NULL, 75, 'pending', NULL, NULL, '2019-09-03 09:15:07', '2019-09-03 09:15:07', NULL),
(50, 500, NULL, 76, 'pending', NULL, NULL, '2019-09-04 08:51:49', '2019-09-09 14:58:18', NULL),
(51, 50, NULL, 77, 'pending', NULL, NULL, '2019-09-13 10:06:49', '2019-09-26 15:09:58', NULL),
(52, 50, NULL, 78, 'pending', NULL, NULL, '2019-09-13 10:08:15', '2019-09-14 07:59:04', NULL),
(53, 50, 4, 79, 'planned', NULL, NULL, '2019-09-13 11:43:45', '2019-09-17 14:33:11', NULL),
(54, 50, NULL, 80, 'pending', NULL, NULL, '2019-09-14 10:40:59', '2019-09-14 10:51:53', NULL),
(55, 50, NULL, 81, 'pending', NULL, NULL, '2019-09-17 10:50:19', '2019-09-19 07:16:54', NULL),
(56, 50, NULL, 82, 'pending', NULL, NULL, '2019-09-18 06:38:36', '2019-09-18 06:38:36', NULL),
(57, 50, NULL, 83, 'pending', NULL, NULL, '2019-09-18 07:19:36', '2019-09-18 07:19:36', NULL),
(58, 50, NULL, 84, 'pending', NULL, NULL, '2019-09-20 12:47:50', '2019-09-20 12:47:50', NULL),
(59, 50, 4, 85, 'planned', NULL, NULL, '2019-09-24 11:35:52', '2019-09-30 09:59:19', NULL),
(60, 50, NULL, 86, 'pending', NULL, NULL, '2019-09-26 14:28:24', '2019-09-26 14:28:24', NULL),
(61, 50, NULL, 87, 'pending', NULL, NULL, '2019-09-27 10:22:19', '2019-09-27 10:22:19', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `shippings_recipients`
--

CREATE TABLE IF NOT EXISTS `shippings_recipients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `shipping_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_ shippings_recipients_shippings1_idx` (`shipping_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=49 ;

--
-- Contenu de la table `shippings_recipients`
--

INSERT INTO `shippings_recipients` (`id`, `name`, `phone_number`, `email`, `shipping_id`) VALUES
(1, 'cris try', '58966545', 'cris@gmail.com', 1),
(5, 'jean paul', '12345678', 'paul@gmail.com', 18),
(6, 'Douanla Jemimah', '+237695421365', 'guest@example.com', 19),
(7, 'Douanla Jemimah', '+237695421365', 'guest@example.com', 20),
(8, 'Douanla Jemimah', '+237695421365', 'guest@example.com', 21),
(9, 'Douanla Jemimah', '+237695421365', 'guest@example.com', 22),
(10, 'Douanla Jemimah', '+237695421365', 'guest@example.com', 23),
(11, 'jean paul', '12345678', 'paul@gmail.com', 24),
(12, 'jean paul', '12345678', 'paul@gmail.com', 25),
(13, 'Douanla Jemimah', '+237695421365', 'guest@example.com', 26),
(14, 'Douanla Jemimah', '+237695421365', 'guest@example.com', 27),
(15, 'Douanla Jemimah', '+237695421365', 'guest@example.com', 28),
(17, 'Douanla Jemimah', '+237695421365', 'guest@example.com', 30),
(18, 'Douanla Jemimah', '+237695421365', 'guest@example.com', 31),
(19, 'Douanla Jemimah', '+237695421365', 'guest@example.com', 32),
(20, 'Douanla Jemimah', '+237695421365', 'guest@example.com', 33),
(21, 'Douanla Jemimah', '+237695421365', 'guest@example.com', 34),
(22, 'Douanla Jemimah', '+237695421365', 'guest@example.com', 35),
(23, 'Douanla Jemimah', '+237695421365', 'guest@example.com', 36),
(24, 'Douanla Jemimah', '+237695421365', 'guest@example.com', 37),
(25, 'Douanla Jemimah', '+237695421365', 'guest@example.com', 38),
(26, 'Douanla Jemimah', '+237695421365', 'guest@example.com', 39),
(27, 'Douanla Jemimah', '+237695421365', 'guest@example.com', 40),
(28, 'Douanla Jemimah', '+237695421365', 'guest@example.com', 41),
(29, 'Douanla Jemimah', '+237695421365', 'guest@example.com', 42),
(30, 'Douanla Jemimah', '+237695421365', 'guest@example.com', 43),
(31, 'Douanla Jemimah', '+237695421365', 'guest@example.com', 44),
(32, 'Douanla Jemimah', '+237695421365', 'guest@example.com', 45),
(33, 'Douanla Jemimah', '+237695421365', 'guest@example.com', 46),
(34, 'Douanla Jemimah', '+237695421365', 'guest@example.com', 47),
(35, 'Douanla Jemimah', '+237695421365', 'guest@example.com', 48),
(36, 'Douanla Jemimah', '+237695421365', 'guest@example.com', 49),
(37, 'Douanla Jemimah', '+237695421365', 'guest@example.com', 50),
(38, 'Douanla Jemimah', '+237695421365', 'guest@example.com', 51),
(39, 'Douanla Jemimah', '+237695421365', 'guest@example.com', 52),
(40, 'Douanla Jemimah', '+237695421365', 'guest@example.com', 59),
(41, 'Douanla Jemimah', '+237695421365', 'guest@example.com', 54),
(42, 'Douanla Jemimah', '+237695421365', 'guest@example.com', 55),
(43, 'jean paul', '12345678', 'paul@gmail.com', 56),
(44, 'jean paul', '12345678', 'paul@gmail.com', 57),
(45, 'Douanla Jemimah', '+237695421365', 'guest@example.com', 58),
(46, 'Douanla Jemimah', '+237695421365', 'guest@example.com', 59),
(47, 'Douanla Jemimah', '+237695421365', 'guest@example.com', 60),
(48, 'Douanla Jemimah', '+237695421365', 'guest@example.com', 61);

-- --------------------------------------------------------

--
-- Structure de la table `supplements`
--

CREATE TABLE IF NOT EXISTS `supplements` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `price` double NOT NULL DEFAULT '0',
  `description` text,
  `is_available` tinyint(1) NOT NULL DEFAULT '1',
  `category_id` int(11) DEFAULT NULL,
  `restaurant_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_supplements_categories1_idx` (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=81 ;

--
-- Contenu de la table `supplements`
--

INSERT INTO `supplements` (`id`, `name`, `price`, `description`, `is_available`, `category_id`, `restaurant_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 'Café', 150, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorum, repudiandae!', 1, 4, 1, '2019-08-29 06:14:55', '2019-08-29 09:39:19', NULL),
(5, 'Glace à la cerise', 500, 'lorem lorem', 1, 1, 1, '2019-08-29 06:14:56', '2019-08-29 11:03:49', NULL),
(7, 'Patates douces', 500, 'lorem ipsum', 1, 6, 1, '2019-08-29 06:14:56', '2019-08-29 06:14:56', NULL),
(14, 'Jus de bissap', 1000, '.', 1, 4, 18, '2019-08-29 06:14:56', '2019-08-29 06:14:56', NULL),
(17, 'Frites de banane plantains', 0, '.', 1, 6, 18, '2019-08-29 06:14:56', '2019-08-29 06:14:56', NULL),
(18, 'Tiramisu', 1496, '.', 1, 1, 18, '2019-08-29 06:14:56', '2019-08-29 06:14:56', NULL),
(19, 'Salade de fruits', 1000, '.', 1, 1, 18, '2019-08-29 06:14:56', '2019-08-29 06:14:56', NULL),
(20, 'Dakere', 1000, 'yaourt au mil.', 1, 1, 18, '2019-08-29 06:14:56', '2019-08-29 06:14:56', NULL),
(24, 'Moka', 1000, 'un desc', 1, 1, 18, '2019-08-29 06:14:56', '2019-08-29 06:14:56', NULL),
(25, 'Tubercules de manioc', 0, '.', 1, 6, 1, '2019-08-29 06:14:56', '2019-08-29 06:14:56', NULL),
(27, 'Jus de cassimango', 1000, '.', 1, 4, 1, '2019-08-29 06:14:56', '2019-08-29 06:14:56', NULL),
(29, 'Pain', 0, '.', 1, 6, 1, '2019-08-29 06:14:56', '2019-08-29 06:14:56', NULL),
(30, 'Nems au poulet', 2000, '.', 1, 3, 19, '2019-08-29 06:14:56', '2019-08-29 06:14:56', NULL),
(32, 'Verrine d''avocats', 0, '.', 1, 3, 1, '2019-08-29 06:14:56', '2019-08-29 06:14:56', NULL),
(33, 'Frites de pommes', 0, '.', 1, 6, 19, '2019-08-29 06:14:56', '2019-08-29 06:14:56', NULL),
(34, 'Tarte aux pommes', 2500, '.', 1, 1, 19, '2019-08-29 06:14:56', '2019-08-29 06:14:56', NULL),
(40, 'Jus de corossol', 1500, '.', 1, 4, 19, '2019-08-29 06:14:56', '2019-08-29 06:14:56', NULL),
(46, 'Frites de banane plantains', 0, '.', 1, 6, 2, '2019-08-29 06:14:56', '2019-08-29 06:14:56', NULL),
(47, 'Tubercules de manioc', 800, '.', 1, 6, 2, '2019-08-29 06:14:56', '2019-08-29 06:14:56', NULL),
(61, 'French Fries', 400, 'Fried Irish or fried yam or fried plantains.', 1, 6, 24, '2019-08-29 06:14:56', '2019-08-29 06:14:56', NULL),
(62, 'Bread', 200, 'brown bread and white bread', 1, 6, 24, '2019-08-29 06:14:56', '2019-08-29 06:14:56', NULL),
(63, 'Pancake', 400, 'Simple Pancake and chocolate pancake', 1, 6, 24, '2019-08-29 06:14:56', '2019-08-29 06:14:56', NULL),
(67, 'Bread', 300, 'we offer white bread,brown bread,and yeast bread', 1, 6, 21, '2019-08-29 06:14:56', '2019-08-29 06:14:56', NULL),
(69, 'Fries', 500, 'Fried ripe plantains or chips.Chips can be mixed with flour or simply fried', 1, 6, 21, '2019-08-29 06:14:56', '2019-08-29 06:14:56', NULL),
(70, 'Puff puff', 300, 'Sweet puffpuff', 1, 6, 24, '2019-08-29 06:14:56', '2019-08-29 06:14:56', NULL),
(73, 'Puff puff', 200, 'Puff with sugar or without.', 1, 6, 21, '2019-08-29 06:14:56', '2019-08-29 06:14:56', NULL),
(78, 'Plantains', 1000, 'Plantains can be ripe or unripe.', 1, 6, 21, '2019-08-29 06:14:56', '2019-08-29 06:14:56', NULL),
(79, 'Cocoyams', 500, 'choose from White or yellow cocoyams', 1, 2, 21, '2019-08-29 06:14:56', '2019-08-29 06:14:56', NULL),
(80, 'Juss', 0, 'une desc', 1, 8, 21, '2019-08-29 06:14:56', '2019-08-29 07:04:04', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `trackings`
--

CREATE TABLE IF NOT EXISTS `trackings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `latitude` double DEFAULT NULL,
  `longitude` double DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_trackings_users1_idx` (`user_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `trackings`
--

INSERT INTO `trackings` (`id`, `user_id`, `latitude`, `longitude`) VALUES
(1, 4, 2.23, 3.5),
(2, 5, 4.0462238, 9.6951729),
(3, 11, 3, 0.5);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `is_enable` tinyint(1) NOT NULL DEFAULT '1',
  `active` tinyint(1) NOT NULL,
  `available` tinyint(1) DEFAULT NULL,
  `activation_token` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `phone_number_UNIQUE` (`phone_number`),
  UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `gender`, `email`, `phone_number`, `email_verified_at`, `password`, `remember_token`, `is_enable`, `active`, `available`, `activation_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Bleriot', 'Noguia', NULL, 'admin@example.com', '12345678', '2019-09-23 15:02:29', '$2y$10$R1Ltd4Ruk6n0tDw.odmgc.mQ3JQo1ini6UHH6Bspv.k1pBy.1ZBu.', 'v0pgwADbdc3Vi41Mj98pRHJV32SY5EJsxP5HSLvCN5a4IYU0XHEoFfixcm0n', 1, 1, NULL, '', '2019-03-22 12:32:01', '2019-09-23 16:02:29', NULL),
(2, 'User', 'Simple', NULL, 'user@example.com', '12345677', NULL, '$2y$10$bKOAJ7Su9NXJdGF8hWwfCucglWNJq5Smpw8mYn08Vq2wbwZwQqmZ2', '4pcsDysQu04LvktQJrk0cV2EWjFcPVsWr1m07mRqSIpPo9PGszygUKLqvgDC', 1, 1, NULL, '', '2019-03-22 12:32:01', '2019-06-28 08:26:35', NULL),
(3, 'Jemimah', 'Douanla', NULL, 'guest@example.com', '+237695421365', '2019-09-25 06:48:28', '$2y$10$LYNwsqCNYFKp2trj7Ji7meuNZ5r.Ly/WSpvST.OCYwP9J1/dlcVWy', 'LiYJQgV8VV4PPvBFCp2KNQuDHUw71EP4yS2wuQteov3NQnIwrCKvZgjGyVK6', 1, 1, NULL, '', '2019-03-22 12:32:01', '2019-09-25 07:48:28', NULL),
(4, 'Jean', 'Luc', NULL, 'jean@example.com', '674565453', NULL, '$2y$10$oONw9pkxmn8clHkEUKglHebxIK0pagl6u5surzr.HMD.A5IVrFlwW', 'IArCcrhWTrDvCVmIXhc9V5R9BI6soLxp4qHH5dd9AekbQH9aS296X4PeHRnW', 1, 1, 1, '', '2019-04-10 13:26:27', '2019-09-25 12:39:22', NULL),
(5, 'Durvil', 'Rossini', NULL, 'rostapig@gmail.com', '23232323', NULL, '$2y$10$uwyh1VuwHAHD.8AdY3wFIu/2XifjKynyeRpT/c0ZBez72PY8V7AQi', NULL, 1, 1, 1, '', '2019-04-17 16:24:49', '2019-09-26 10:02:06', NULL),
(7, 'John', 'Doe', NULL, 'john@johndoe.com', '45454545', '2019-10-03 11:24:36', '$2y$10$X8LaBNO8sqF5gdbz1yM7uecMeBk0.ge.3pFdS2l.oaGDaP6OX3ciK', '8ZOVtX66j15aEK4bAkR6IcMMjw04ntc41ZWPrjERGKGdOUCF1A9URnbzRYEf', 1, 1, NULL, '', '2019-04-23 10:00:05', '2019-10-03 12:24:36', NULL),
(8, 'Wembo', 'Romaric', NULL, 'romaric@example.com', '+237698652410', NULL, '$2y$10$ut7RD3KKiR8ZuPcsdIIKJ.v1oXc6gpae.C3tDu9S16JUBPkCIuIpq', NULL, 1, 0, NULL, 'tCeCnFXwDQrO0qOIMnDvikptpDor3IzIFxmc8SxBdosLCS89GGoWiEaBJ3ZV', '2019-08-01 14:44:15', '2019-09-05 13:20:46', NULL),
(10, 'Stephane', 'Kevin', NULL, 'lajowexi@click-mail.top', '+237684510012', '2019-08-29 12:16:27', '$2y$10$xVanATjwiZI.bwMbyAlCwus1VYD1vaIg8n6ghBGBie/gYLsslFv32', NULL, 1, 1, NULL, '', '2019-08-29 13:05:32', '2019-08-29 13:16:27', NULL),
(11, 'Salvardord', 'Salvardord', NULL, 'examen@gmail.dc', '+237684541201', NULL, '$2y$10$jkQ.MZ8Go7CEZ2EkVXJnH.2Ae9Skfu9WJpMvFQfzmiZ9l7.i.81CO', NULL, 1, 0, NULL, '0DqkMmKm56whLprsQetH5uciCcLnK4atTJYbdCgPrVHXWkcC6lAOh3VbmlUT', '2019-08-29 14:38:09', '2019-08-29 14:38:09', NULL),
(12, 'Tamo', 'Cris', NULL, 'tamo@gmail.com', '123456789', NULL, '$2y$10$CDs3eAr.vPaUd0JXmZWTkeatrtPeq.woB61aiEcxJNII.y9IimfZm', 'TZcyKEqZVrLtqzqWEcQYiyoFdpRnY8bTJF9xxglsqyhsNJkCi8oPSOyWEdwo', 1, 0, NULL, 'YPNhSri52Pu6RgWvAWRxkgadsSWoZrFISh6hwNnSvXCpmTqsUMM582GxNoSP', '2019-08-30 08:24:39', '2019-09-04 15:11:21', NULL),
(13, 'Nikos', 'Nikos', NULL, 'nikos@gmail.com', '123456', '2019-10-08 10:00:00', '$2y$10$gw2ROk0.Z9X5lvDRYnwpPOeco5fa2te3XE/lOUvtcrZBPIPmne1vy', 'VwVCTZ3ikLtinLE5u0nr4BJ5kq8FEnTkEzUNU3TtMyqAChK9JOkzZPIGA5fD', 1, 0, NULL, 'Z5HgcXpEWBBp9gs7dwgFpAbqWOIUXDfB53GT1bG4l8Ktyn54Bm4ESBvzIzic', '2019-09-05 09:26:46', '2019-09-11 09:33:57', NULL),
(14, 'Kadjija', 'Kadjija', NULL, 'kadjija@gmail.com', '12345678910', '2019-09-10 11:49:43', '$2y$10$8sZmByWKiDTVG9niIhWPFuaShgTzLcZ/rNwwhpyhm5CXgbOQcIEO6', 'uB4BaAMhnk82VKJxek7jVkptMkdTzdOEepUa05Hq42HRNMD9LteMVvVJ353Q', 1, 1, NULL, '', '2019-09-10 12:44:51', '2019-09-10 12:54:37', NULL),
(15, 'Loic', 'Wafo', NULL, 'wafo@ubereats.com', '1234567891011', '2019-09-23 23:00:00', '$2y$10$uzWeFo1wQ7z30S.7CIQcoeEklANGftzjnOEZ1StmgH/HE5G9crVj6', 'RMFa3iKldcWQb4ROPelz2UMM71onDgvUE92cSr9QS5NAcCNuWDvrUO9FlIci', 1, 1, NULL, '', '2019-09-23 15:11:48', '2019-10-07 15:45:57', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `wallets`
--

CREATE TABLE IF NOT EXISTS `wallets` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `balance` bigint(20) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id_UNIQUE` (`user_id`),
  KEY `fk_wallets_users1_idx` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Contenu de la table `wallets`
--

INSERT INTO `wallets` (`id`, `user_id`, `balance`, `created_at`, `updated_at`) VALUES
(1, 5, 846, '2019-09-09 12:38:35', '2019-09-14 09:16:16'),
(2, 3, 35845, '2019-09-09 14:58:18', '2019-09-26 15:14:43'),
(3, 12, 0, '2019-09-10 11:47:12', '2019-09-10 11:47:12'),
(4, 14, 20600, '2019-09-10 12:53:03', '2019-09-14 09:48:29'),
(5, 4, 0, '2019-09-10 13:03:42', '2019-09-10 13:03:42'),
(6, 11, 0, '2019-09-10 13:04:08', '2019-09-10 13:04:08'),
(7, 7, 21083, '2019-09-12 07:39:32', '2019-09-16 06:48:20'),
(8, 1, 3245, '2019-09-14 07:59:10', '2019-09-26 15:14:43');

-- --------------------------------------------------------

--
-- Structure de la table `wallet_transactions`
--

CREATE TABLE IF NOT EXISTS `wallet_transactions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `wallet_id` int(10) unsigned NOT NULL,
  `amount` bigint(20) DEFAULT NULL,
  `hash` varchar(255) DEFAULT NULL,
  `type` enum('deposit','withdraw') DEFAULT NULL,
  `accepted` tinyint(4) DEFAULT NULL,
  `meta` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_transactions_wallets1_idx` (`wallet_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=43 ;

--
-- Contenu de la table `wallet_transactions`
--

INSERT INTO `wallet_transactions` (`id`, `wallet_id`, `amount`, `hash`, `type`, `accepted`, `meta`, `created_at`, `updated_at`) VALUES
(1, 1, 300, 'lwch_5d76571855ef61.26175158', 'deposit', 1, '', '2019-09-09 12:43:52', '2019-09-09 12:43:52'),
(2, 1, 50, 'lwch_5d76576fed59c3.02641574', 'deposit', 1, '', '2019-09-09 12:45:19', '2019-09-09 12:45:19'),
(3, 2, 17900, 'lwch_5d76769a77dcb1.72066924', 'deposit', 1, '', '2019-09-09 14:58:18', '2019-09-09 14:58:18'),
(4, 2, 0, 'lwch_5d776785266193.65196684', 'deposit', 1, '', '2019-09-10 08:06:13', '2019-09-10 08:06:13'),
(5, 2, 0, 'lwch_5d77680f3de8a5.43607416', 'deposit', 1, '', '2019-09-10 08:08:31', '2019-09-10 08:08:31'),
(6, 2, 0, 'lwch_5d77687580cd05.25749696', 'deposit', 1, '', '2019-09-10 08:10:13', '2019-09-10 08:10:13'),
(7, 2, 300, 'trans_5d77953e16e3a2.70934296', 'withdraw', 1, '{"note":"une note"}', '2019-09-10 11:21:18', '2019-09-10 11:21:18'),
(8, 4, 1000, 'trans_5d77aabfb39db4.98088569', 'deposit', 1, '""', '2019-09-10 12:53:03', '2019-09-10 12:53:03'),
(9, 4, 11800, 'trans_5d77aad8ed13f3.97772517', 'deposit', 1, '""', '2019-09-10 12:53:28', '2019-09-10 12:53:28'),
(10, 5, 10, 'trans_5d77ad3e55c494.68462141', 'withdraw', 0, '{"note":null}', '2019-09-10 13:03:42', '2019-09-10 13:03:42'),
(11, 5, 10, 'trans_5d77ada05601b5.38902149', 'withdraw', 0, '{"note":null}', '2019-09-10 13:05:20', '2019-09-10 13:05:20'),
(12, 2, 100, 'trans_5d77b4299b04c4.15517429', 'withdraw', 1, '{"note":"test"}', '2019-09-10 13:33:13', '2019-09-10 13:33:13'),
(13, 1, 100, 'trans_5d77ba2f2df1e2.71077776', 'withdraw', 1, '{"note":null}', '2019-09-10 13:58:55', '2019-09-10 13:58:55'),
(14, 2, 1700, 'trans_5d78caa062f959.21724476', 'deposit', 1, '""', '2019-09-11 09:21:20', '2019-09-11 09:21:20'),
(15, 2, 700, 'trans_5d78f18d193390.99064413', 'deposit', 1, '""', '2019-08-11 12:07:25', '2019-09-11 12:07:25'),
(16, 7, 4300, 'trans_5d7a04448b5c32.88716459', 'deposit', 1, '{"ubereats_fee":0,"ubereats_fee_percent":"5","order_total":4300}', '2019-09-12 07:39:32', '2019-09-12 07:39:32'),
(17, 4, 11800, 'trans_5d7ba3a4463a21.83690803', 'deposit', 1, '""', '2019-09-13 13:11:48', '2019-09-13 13:11:48'),
(18, 8, 225, 'trans_5d7cabde2183e2.67035874', 'deposit', 1, '{"ubereats_fee":225,"ubereats_fee_percent":"5","order_total":4500}', '2019-09-14 07:59:10', '2019-09-14 07:59:10'),
(19, 7, 4275, 'trans_5d7cabde2f53f1.86253426', 'deposit', 1, '{"ubereats_fee":225,"ubereats_fee_percent":"5","order_total":4500}', '2019-09-14 07:59:10', '2019-09-14 07:59:10'),
(20, 5, 5, 'trans_5d7cb94edd1de9.34163182', 'withdraw', 0, '{"note":"une note"}', '2019-09-14 08:56:30', '2019-09-14 08:56:30'),
(21, 5, 0, 'trans_5d7cbc3150a474.12691887', 'withdraw', 1, '{"note":null}', '2019-09-14 09:08:49', '2019-09-14 09:08:49'),
(22, 1, 0, 'trans_5d7cbcf0ed47f3.26436369', 'withdraw', 1, '{"note":null}', '2019-09-14 09:12:00', '2019-09-14 09:12:00'),
(23, 1, 4, 'trans_5d7cbdf10a3d50.51261312', 'withdraw', 1, '{"note":null}', '2019-09-14 09:16:17', '2019-09-14 09:16:17'),
(24, 4, 4000, 'trans_5d7cc57d5ff650.04959362', 'withdraw', 1, '{"note":null}', '2019-09-14 09:48:29', '2019-09-14 09:48:29'),
(25, 8, 225, 'trans_5d7ccd8489d0f3.45755209', 'deposit', 1, '{"ubereats_fee":225,"ubereats_fee_percent":"5","order_total":4500}', '2019-09-14 10:22:44', '2019-09-14 10:22:44'),
(26, 7, 4275, 'trans_5d7ccd84992473.34375583', 'deposit', 1, '{"ubereats_fee":225,"ubereats_fee_percent":"5","order_total":4500,"order_number":"#00053r","order_id":53}', '2019-09-14 10:22:44', '2019-09-14 10:22:44'),
(27, 8, 425, 'trans_5d7cd20f8b6e31.38421407', 'deposit', 1, '{"ubereats_fee":425,"ubereats_fee_percent":"5","order_total":8500}', '2019-09-14 10:42:07', '2019-09-14 10:42:07'),
(28, 7, 8075, 'trans_5d7cd20f977706.53287040', 'deposit', 1, '{"ubereats_fee":425,"ubereats_fee_percent":"5","order_total":8500,"order_number":"#00080u","order_id":80}', '2019-09-14 10:42:07', '2019-09-14 10:42:07'),
(29, 8, 425, 'trans_5d7cd2c7cc7367.57038112', 'deposit', 1, '{"ubereats_fee":425,"ubereats_fee_percent":"5","order_total":8500}', '2019-09-14 10:45:11', '2019-09-14 10:45:11'),
(30, 8, 421, 'trans_5d7cd3c49031e3.16918752', 'deposit', 1, '{"ubereats_fee":425,"ubereats_fee_percent":"5","order_total":8500}', '2019-09-14 10:49:24', '2019-09-14 10:49:24'),
(31, 8, 240, 'trans_5d7cdc1c562eb8.25243997', 'deposit', 1, '{"ubereats_fee":239.9,"ubereats_fee_percent":"5","order_total":4798,"order_number":"#00061a","order_id":61}', '2019-09-14 11:25:00', '2019-09-14 11:25:00'),
(32, 7, 4558, 'trans_5d7cdc1c7a6119.75991125', 'deposit', 1, '{"ubereats_fee":239.9,"ubereats_fee_percent":"5","order_total":4798,"order_number":"#00061a","order_id":61}', '2019-09-14 11:25:00', '2019-09-14 11:25:00'),
(33, 7, 400, 'trans_5d7f3dfc69e309.60633699', 'withdraw', 1, '{"note":"une note"}', '2019-09-16 06:47:08', '2019-09-16 06:47:08'),
(34, 7, 4000, 'trans_5d7f3e4424a897.54351793', 'withdraw', 1, '{"note":"la note"}', '2019-09-16 06:48:20', '2019-09-16 06:48:20'),
(35, 8, 85, 'trans_5d83397c878177.56498818', 'deposit', 1, '{"ubereats_fee":85,"ubereats_fee_percent":"5","order_total":1700,"order_number":"#00081o","order_id":81}', '2019-09-19 07:17:00', '2019-09-19 07:17:00'),
(36, 2, 1615, 'trans_5d83397c961f72.31830839', 'deposit', 1, '{"ubereats_fee":85,"ubereats_fee_percent":"5","order_total":1700,"order_number":"#00081o","order_id":81}', '2019-09-19 07:17:00', '2019-09-19 07:17:00'),
(37, 8, 520, 'trans_5d8ce2bc7377e7.23162498', 'deposit', 1, '{"ubereats_fee":520,"ubereats_fee_percent":"5","order_total":10400,"order_number":"#00085a","order_id":85}', '2019-09-26 15:09:32', '2019-09-26 15:09:32'),
(38, 2, 9880, 'trans_5d8ce2bc9b9a23.66556761', 'deposit', 1, '{"ubereats_fee":520,"ubereats_fee_percent":"5","order_total":10400,"order_number":"#00085a","order_id":85}', '2019-09-26 15:09:32', '2019-09-26 15:09:32'),
(39, 8, 200, 'trans_5d8ce2d903f7e2.31149735', 'deposit', 1, '{"ubereats_fee":200,"ubereats_fee_percent":"5","order_total":4000,"order_number":"#00077y","order_id":77}', '2019-09-26 15:10:01', '2019-09-26 15:10:01'),
(40, 2, 3800, 'trans_5d8ce2d913c735.74296360', 'deposit', 1, '{"ubereats_fee":200,"ubereats_fee_percent":"5","order_total":4000,"order_number":"#00077y","order_id":77}', '2019-09-26 15:10:01', '2019-09-26 15:10:01'),
(41, 8, 50, 'trans_5d8ce3f3520082.93644358', 'deposit', 1, '{"ubereats_fee":50,"ubereats_fee_percent":"5","order_total":1000,"order_number":"#00048x","order_id":48}', '2019-09-26 15:14:43', '2019-09-26 15:14:43'),
(42, 2, 950, 'trans_5d8ce3f369dba3.61029880', 'deposit', 1, '{"ubereats_fee":50,"ubereats_fee_percent":"5","order_total":1000,"order_number":"#00048x","order_id":48}', '2019-09-26 15:14:43', '2019-09-26 15:14:43');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `fk_categories_restaurants1` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `invoices`
--
ALTER TABLE `invoices`
  ADD CONSTRAINT `fk_Invoices_orders1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Contraintes pour la table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `fk_meals_cuisine1` FOREIGN KEY (`cuisine_id`) REFERENCES `cuisines` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_meal_category1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_meal_restaurant` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Contraintes pour la table `items_has_supplements`
--
ALTER TABLE `items_has_supplements`
  ADD CONSTRAINT `fk_items_has_supplements_items1` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_items_has_supplements_supplements1` FOREIGN KEY (`supplement_id`) REFERENCES `supplements` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `menus`
--
ALTER TABLE `menus`
  ADD CONSTRAINT `fk_menus_restaurants1` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `meta`
--
ALTER TABLE `meta`
  ADD CONSTRAINT `fk_meta_user1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Contraintes pour la table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `notations`
--
ALTER TABLE `notations`
  ADD CONSTRAINT `fk_notations_user1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Contraintes pour la table `notations_has_criteria`
--
ALTER TABLE `notations_has_criteria`
  ADD CONSTRAINT `fk_notations_has_criteria_criteria1` FOREIGN KEY (`criteria_id`) REFERENCES `criteria` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_notations_has_criteria_notations1` FOREIGN KEY (`notation_id`) REFERENCES `notations` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Contraintes pour la table `obligatory_supplements_categories`
--
ALTER TABLE `obligatory_supplements_categories`
  ADD CONSTRAINT `fk_obligatory_supplements_categories_categories1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_obligatory_supplements_categories_items1` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `onesignals`
--
ALTER TABLE `onesignals`
  ADD CONSTRAINT `fk_onesignals_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Contraintes pour la table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk_order_user1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Contraintes pour la table `order_lines`
--
ALTER TABLE `order_lines`
  ADD CONSTRAINT `fk_order_line_order1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Contraintes pour la table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `fk_payments_invoices1` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_payments_payment_method1` FOREIGN KEY (`payment_method_id`) REFERENCES `payment_methods` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `programmes`
--
ALTER TABLE `programmes`
  ADD CONSTRAINT `fk_schedule_restaurants1` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Contraintes pour la table `promocodes`
--
ALTER TABLE `promocodes`
  ADD CONSTRAINT `promocodes_restaurant_id_foreign` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `promocode_user`
--
ALTER TABLE `promocode_user`
  ADD CONSTRAINT `promocode_user_promocode_id_foreign` FOREIGN KEY (`promocode_id`) REFERENCES `promocodes` (`id`),
  ADD CONSTRAINT `promocode_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `restaurants`
--
ALTER TABLE `restaurants`
  ADD CONSTRAINT `ubereats_restaurants_users_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `restaurants_has_cuisines`
--
ALTER TABLE `restaurants_has_cuisines`
  ADD CONSTRAINT `fk_restaurants_has_cuisines_cuisines1` FOREIGN KEY (`cuisine_id`) REFERENCES `cuisines` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_restaurants_has_cuisines_restaurants1` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Contraintes pour la table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `shippings`
--
ALTER TABLE `shippings`
  ADD CONSTRAINT `fk_deliveries_order1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_deliveries_user1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `shippings_recipients`
--
ALTER TABLE `shippings_recipients`
  ADD CONSTRAINT `fk_ shippings_recipients_shippings1` FOREIGN KEY (`shipping_id`) REFERENCES `shippings` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Contraintes pour la table `supplements`
--
ALTER TABLE `supplements`
  ADD CONSTRAINT `fk_supplements_categories1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `trackings`
--
ALTER TABLE `trackings`
  ADD CONSTRAINT `fk_trackings_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `wallets`
--
ALTER TABLE `wallets`
  ADD CONSTRAINT `fk_wallets_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `wallet_transactions`
--
ALTER TABLE `wallet_transactions`
  ADD CONSTRAINT `fk_transactions_wallets1` FOREIGN KEY (`wallet_id`) REFERENCES `wallets` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
