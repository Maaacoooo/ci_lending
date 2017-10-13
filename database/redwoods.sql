-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 05, 2017 at 11:00 PM
-- Server version: 5.6.26
-- PHP Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `redwoods`
--

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `id` varchar(128) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  `data` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES
('0dq0goneubj41e6jmgh9qo1l10ga1qo7', '::1', 1506725557, 0x5f5f63695f6c6173745f726567656e65726174657c693a313530363732353535373b61646d696e5f6c6f676765645f696e7c613a313a7b733a383a22757365726e616d65223b733a343a226d61636f223b7d),
('cv9cu986r6t6u7v3lloe6j1of0h3jbr2', '::1', 1506725860, 0x5f5f63695f6c6173745f726567656e65726174657c693a313530363732353836303b61646d696e5f6c6f676765645f696e7c613a313a7b733a383a22757365726e616d65223b733a343a226d61636f223b7d),
('kvjdb1dls01ov8s3p4goa6v3rnf6csfc', '::1', 1506726189, 0x5f5f63695f6c6173745f726567656e65726174657c693a313530363732363138393b61646d696e5f6c6f676765645f696e7c613a313a7b733a383a22757365726e616d65223b733a343a226d61636f223b7d),
('gdovckcqfmcgtd7lvg3051n1vr9l2or3', '::1', 1506726495, 0x5f5f63695f6c6173745f726567656e65726174657c693a313530363732363439353b61646d696e5f6c6f676765645f696e7c613a313a7b733a383a22757365726e616d65223b733a343a226d61636f223b7d),
('hvnum5vfvfuvcfbkkb3j3jab8sbgcood', '::1', 1506726850, 0x5f5f63695f6c6173745f726567656e65726174657c693a313530363732363835303b61646d696e5f6c6f676765645f696e7c613a313a7b733a383a22757365726e616d65223b733a343a226d61636f223b7d),
('ccqp291jqop1pkijpbgffgagk488ur2i', '::1', 1506726877, 0x5f5f63695f6c6173745f726567656e65726174657c693a313530363732363837373b61646d696e5f6c6f676765645f696e7c613a313a7b733a383a22757365726e616d65223b733a353a22626962626f223b7d),
('e62lgk1dq4djdn620ks044a14m6vhbqs', '::1', 1506727169, 0x5f5f63695f6c6173745f726567656e65726174657c693a313530363732373136393b61646d696e5f6c6f676765645f696e7c613a313a7b733a383a22757365726e616d65223b733a343a226d61636f223b7d),
('hnb6a9r974kmle7rfcb5p2esapukrpli', '::1', 1506727166, 0x5f5f63695f6c6173745f726567656e65726174657c693a313530363732363837373b61646d696e5f6c6f676765645f696e7c613a313a7b733a383a22757365726e616d65223b733a353a22626962626f223b7d),
('jj0s1b1cdf4up5nlnobrnh90vc5rtf0l', '::1', 1506727489, 0x5f5f63695f6c6173745f726567656e65726174657c693a313530363732373438393b61646d696e5f6c6f676765645f696e7c613a313a7b733a383a22757365726e616d65223b733a343a226d61636f223b7d),
('20qmbj2ivbl91igvt693pf4jpjaij2oc', '::1', 1506727807, 0x5f5f63695f6c6173745f726567656e65726174657c693a313530363732373830373b61646d696e5f6c6f676765645f696e7c613a313a7b733a383a22757365726e616d65223b733a343a226d61636f223b7d),
('vpadskn1k9h8mg88ja2n30mlnir8ebnr', '::1', 1506728143, 0x5f5f63695f6c6173745f726567656e65726174657c693a313530363732383134333b61646d696e5f6c6f676765645f696e7c613a313a7b733a383a22757365726e616d65223b733a343a226d61636f223b7d),
('lp0vic7cqtojehuldjdub2amjfop8hvb', '::1', 1506728467, 0x5f5f63695f6c6173745f726567656e65726174657c693a313530363732383436373b61646d696e5f6c6f676765645f696e7c613a313a7b733a383a22757365726e616d65223b733a343a226d61636f223b7d),
('cpcoplf113no57mh6cegr92o24kl44j1', '::1', 1506728777, 0x5f5f63695f6c6173745f726567656e65726174657c693a313530363732383737373b61646d696e5f6c6f676765645f696e7c613a313a7b733a383a22757365726e616d65223b733a343a226d61636f223b7d),
('ej1ngfb618k7bh8c9762m6av3ilmetor', '::1', 1506728853, 0x5f5f63695f6c6173745f726567656e65726174657c693a313530363732383737373b61646d696e5f6c6f676765645f696e7c613a313a7b733a383a22757365726e616d65223b733a343a226d61636f223b7d),
('dmrsg18db0ts4uvo8gvjae9r82lbhphu', '::1', 1506747283, 0x5f5f63695f6c6173745f726567656e65726174657c693a313530363734373238333b61646d696e5f6c6f676765645f696e7c613a313a7b733a383a22757365726e616d65223b733a343a226d61636f223b7d),
('pqgkosgg9u37bpbn12p4blc7n8us2ett', '::1', 1506751322, 0x5f5f63695f6c6173745f726567656e65726174657c693a313530363735313332323b61646d696e5f6c6f676765645f696e7c613a313a7b733a383a22757365726e616d65223b733a343a226d61636f223b7d),
('03s2b6nu32gk9v8r9tktgnhvt1h35cjf', '::1', 1506751866, 0x5f5f63695f6c6173745f726567656e65726174657c693a313530363735313836363b61646d696e5f6c6f676765645f696e7c613a313a7b733a383a22757365726e616d65223b733a343a226d61636f223b7d),
('niou66eb3ala7kqireoonobtfdlk1lvs', '::1', 1506752553, 0x5f5f63695f6c6173745f726567656e65726174657c693a313530363735323535333b61646d696e5f6c6f676765645f696e7c613a313a7b733a383a22757365726e616d65223b733a343a226d61636f223b7d),
('93iv0hd36munhl7gaf3ecsjl88gv5ocb', '::1', 1506753183, 0x5f5f63695f6c6173745f726567656e65726174657c693a313530363735333138333b61646d696e5f6c6f676765645f696e7c613a313a7b733a383a22757365726e616d65223b733a343a226d61636f223b7d),
('r6v4v9bhr7l49efe2cbs7l4h6doel7ih', '::1', 1506753666, 0x5f5f63695f6c6173745f726567656e65726174657c693a313530363735333636363b61646d696e5f6c6f676765645f696e7c613a313a7b733a383a22757365726e616d65223b733a343a226d61636f223b7d),
('h9prg3ic54edhsc2ans5dvk3rukmaova', '::1', 1506754017, 0x5f5f63695f6c6173745f726567656e65726174657c693a313530363735343031373b61646d696e5f6c6f676765645f696e7c613a313a7b733a383a22757365726e616d65223b733a343a226d61636f223b7d),
('k689g17u8qnbfjl17c3gjnkhfq6qpsuv', '::1', 1506754935, 0x5f5f63695f6c6173745f726567656e65726174657c693a313530363735343933353b61646d696e5f6c6f676765645f696e7c613a313a7b733a383a22757365726e616d65223b733a343a226d61636f223b7d),
('5nncahtjhva8h4mcsogbnmf6ab7nmaef', '::1', 1506755236, 0x5f5f63695f6c6173745f726567656e65726174657c693a313530363735353233363b61646d696e5f6c6f676765645f696e7c613a313a7b733a383a22757365726e616d65223b733a343a226d61636f223b7d),
('aln7m98l7pqr9bbft2jf00978ln907qb', '::1', 1506755549, 0x5f5f63695f6c6173745f726567656e65726174657c693a313530363735353534393b61646d696e5f6c6f676765645f696e7c613a313a7b733a383a22757365726e616d65223b733a343a226d61636f223b7d),
('5sji1to5f1f0qgskelmpup5gs9k9pn59', '::1', 1506755900, 0x5f5f63695f6c6173745f726567656e65726174657c693a313530363735353930303b61646d696e5f6c6f676765645f696e7c613a313a7b733a383a22757365726e616d65223b733a343a226d61636f223b7d),
('f1otq6s0uijche9am35l6l8ulicj0s00', '::1', 1506756205, 0x5f5f63695f6c6173745f726567656e65726174657c693a313530363735363230353b61646d696e5f6c6f676765645f696e7c613a313a7b733a383a22757365726e616d65223b733a343a226d61636f223b7d),
('loh96gsrahnebp84fq8k0ffqle55i7ud', '::1', 1506756537, 0x5f5f63695f6c6173745f726567656e65726174657c693a313530363735363533373b61646d696e5f6c6f676765645f696e7c613a313a7b733a383a22757365726e616d65223b733a343a226d61636f223b7d),
('2r5r6rv9thest8qmr0d7ss9rmc3fjbk5', '::1', 1506756895, 0x5f5f63695f6c6173745f726567656e65726174657c693a313530363735363839353b61646d696e5f6c6f676765645f696e7c613a313a7b733a383a22757365726e616d65223b733a343a226d61636f223b7d),
('h0t8o3nrrlbct9ockkoo0kjl8rbfjsmb', '::1', 1506757221, 0x5f5f63695f6c6173745f726567656e65726174657c693a313530363735373232313b61646d696e5f6c6f676765645f696e7c613a313a7b733a383a22757365726e616d65223b733a343a226d61636f223b7d),
('6drm6a5f4sim5j93hpdai4k3q46tsiof', '::1', 1506757534, 0x5f5f63695f6c6173745f726567656e65726174657c693a313530363735373533343b61646d696e5f6c6f676765645f696e7c613a313a7b733a383a22757365726e616d65223b733a343a226d61636f223b7d),
('lvlvac7ccqiv8iddk9q6kn6gh2629dh1', '::1', 1506757851, 0x5f5f63695f6c6173745f726567656e65726174657c693a313530363735373835313b61646d696e5f6c6f676765645f696e7c613a313a7b733a383a22757365726e616d65223b733a343a226d61636f223b7d),
('ekp2ju5s0laq0ernfsanutd5ps35l8mn', '::1', 1506758342, 0x5f5f63695f6c6173745f726567656e65726174657c693a313530363735383334323b61646d696e5f6c6f676765645f696e7c613a313a7b733a383a22757365726e616d65223b733a343a226d61636f223b7d),
('a027pj07mfj940il3cjn69jtvn4ncbpn', '::1', 1506758815, 0x5f5f63695f6c6173745f726567656e65726174657c693a313530363735383831353b61646d696e5f6c6f676765645f696e7c613a313a7b733a383a22757365726e616d65223b733a343a226d61636f223b7d),
('vn26hcvhoidjbnurelctockn0qifv787', '::1', 1506759188, 0x5f5f63695f6c6173745f726567656e65726174657c693a313530363735393138383b61646d696e5f6c6f676765645f696e7c613a313a7b733a383a22757365726e616d65223b733a343a226d61636f223b7d),
('4p8qo01brcimtr8kmfcsf1drvmo2sgrh', '::1', 1506760047, 0x5f5f63695f6c6173745f726567656e65726174657c693a313530363736303034373b61646d696e5f6c6f676765645f696e7c613a313a7b733a383a22757365726e616d65223b733a343a226d61636f223b7d),
('80b66qt88t0e58b2etid1mh180abiskm', '::1', 1506760420, 0x5f5f63695f6c6173745f726567656e65726174657c693a313530363736303432303b61646d696e5f6c6f676765645f696e7c613a313a7b733a383a22757365726e616d65223b733a343a226d61636f223b7d),
('kglsao06j0gi1ilcesl7muhf1l7bfnb9', '::1', 1506760795, 0x5f5f63695f6c6173745f726567656e65726174657c693a313530363736303739353b61646d696e5f6c6f676765645f696e7c613a313a7b733a383a22757365726e616d65223b733a343a226d61636f223b7d),
('engo93n71grq4422t8p4eoq323vgkjr8', '::1', 1506761117, 0x5f5f63695f6c6173745f726567656e65726174657c693a313530363736313131373b61646d696e5f6c6f676765645f696e7c613a313a7b733a383a22757365726e616d65223b733a343a226d61636f223b7d),
('fes0tbk2a662mt9f7h4jv0hc08r2aju0', '::1', 1506761456, 0x5f5f63695f6c6173745f726567656e65726174657c693a313530363736313435363b61646d696e5f6c6f676765645f696e7c613a313a7b733a383a22757365726e616d65223b733a343a226d61636f223b7d),
('rdcuvefui2srtoaqqvk9mask6voqoi9k', '::1', 1506761770, 0x5f5f63695f6c6173745f726567656e65726174657c693a313530363736313737303b61646d696e5f6c6f676765645f696e7c613a313a7b733a383a22757365726e616d65223b733a343a226d61636f223b7d),
('vadcmoq14ughes8k3ini6ea3frf70mje', '::1', 1506762141, 0x5f5f63695f6c6173745f726567656e65726174657c693a313530363736323134313b61646d696e5f6c6f676765645f696e7c613a313a7b733a383a22757365726e616d65223b733a343a226d61636f223b7d),
('slsfim9mvo63tfdc38ik06hcfq7s8eag', '::1', 1506762442, 0x5f5f63695f6c6173745f726567656e65726174657c693a313530363736323434323b61646d696e5f6c6f676765645f696e7c613a313a7b733a383a22757365726e616d65223b733a343a226d61636f223b7d),
('qeuhep78ku1sbo8ahc0vj5dciq9kdeui', '::1', 1506762748, 0x5f5f63695f6c6173745f726567656e65726174657c693a313530363736323734383b61646d696e5f6c6f676765645f696e7c613a313a7b733a383a22757365726e616d65223b733a343a226d61636f223b7d),
('cht9kn2suuece9asns6eegapobuddtoo', '::1', 1506762861, 0x5f5f63695f6c6173745f726567656e65726174657c693a313530363736323734383b61646d696e5f6c6f676765645f696e7c613a313a7b733a383a22757365726e616d65223b733a343a226d61636f223b7d),
('c1e7fmuvppcpi4dfab34j14oqmhacejj', '::1', 1507232080, 0x5f5f63695f6c6173745f726567656e65726174657c693a313530373233313830393b61646d696e5f6c6f676765645f696e7c613a313a7b733a383a22757365726e616d65223b733a353a2261646d696e223b7d),
('vlpe4pl5r6g7gg9i0j7faaeiv1ei54ep', '::1', 1507232424, 0x5f5f63695f6c6173745f726567656e65726174657c693a313530373233323132343b61646d696e5f6c6f676765645f696e7c613a313a7b733a383a22757365726e616d65223b733a353a2261646d696e223b7d),
('g74755277bqq9vossmo2bv11q4q3bt67', '::1', 1507232481, 0x5f5f63695f6c6173745f726567656e65726174657c693a313530373233323433333b61646d696e5f6c6f676765645f696e7c613a313a7b733a383a22757365726e616d65223b733a353a2261646d696e223b7d),
('dqbjlj97t6et6op38mnm6hmfu36nd6dr', '::1', 1507233005, 0x5f5f63695f6c6173745f726567656e65726174657c693a313530373233333030313b61646d696e5f6c6f676765645f696e7c613a313a7b733a383a22757365726e616d65223b733a353a2261646d696e223b7d),
('39t1iko0ni61915pvd0fl61r725qb6bu', '::1', 1507234639, 0x5f5f63695f6c6173745f726567656e65726174657c693a313530373233343339393b61646d696e5f6c6f676765645f696e7c613a313a7b733a383a22757365726e616d65223b733a353a2261646d696e223b7d),
('f4kgp3qbgrlaoo6pfu1icsvp8q0lib3v', '::1', 1507234701, 0x5f5f63695f6c6173745f726567656e65726174657c693a313530373233343730303b61646d696e5f6c6f676765645f696e7c613a313a7b733a383a22757365726e616d65223b733a353a2261646d696e223b7d),
('3qq0ifi5frhlrffsvqjm8q1hepekfqpp', '::1', 1507234798, 0x5f5f63695f6c6173745f726567656e65726174657c693a313530373233343739313b61646d696e5f6c6f676765645f696e7c613a313a7b733a383a22757365726e616d65223b733a353a2261646d696e223b7d),
('uf3svdiqdnhm55ri0otkm8ig8m7ogc09', '::1', 1507235207, 0x5f5f63695f6c6173745f726567656e65726174657c693a313530373233343935353b61646d696e5f6c6f676765645f696e7c613a313a7b733a383a22757365726e616d65223b733a353a2261646d696e223b7d),
('vq69irrasc88ecamm6o46qo0gfa2foh4', '::1', 1507235550, 0x5f5f63695f6c6173745f726567656e65726174657c693a313530373233353238333b61646d696e5f6c6f676765645f696e7c613a313a7b733a383a22757365726e616d65223b733a353a2261646d696e223b7d),
('b6n4vqibhkcmc5tgfvcn8giccq4mvcdd', '::1', 1507236202, 0x5f5f63695f6c6173745f726567656e65726174657c693a313530373233353936353b61646d696e5f6c6f676765645f696e7c613a313a7b733a383a22757365726e616d65223b733a31303a224e657762696532303137223b7d),
('56cd74mjh7osf7gr0b5s1ao6r0d4jfpv', '::1', 1507236623, 0x5f5f63695f6c6173745f726567656e65726174657c693a313530373233363332363b),
('ket7i8di4fvgu0rc7glvt74qq6gb4uu8', '::1', 1507236683, 0x5f5f63695f6c6173745f726567656e65726174657c693a313530373233363632393b61646d696e5f6c6f676765645f696e7c613a313a7b733a383a22757365726e616d65223b733a31303a224e657762696532303137223b7d),
('enfk3fe6o6pf3h57dij592ejdu3m5a1q', '::1', 1507237170, 0x5f5f63695f6c6173745f726567656e65726174657c693a313530373233363838333b61646d696e5f6c6f676765645f696e7c613a313a7b733a383a22757365726e616d65223b733a31303a224e657762696532303137223b7d),
('rl90eq445gks52uq1n58jc1jcop3m13v', '::1', 1507237202, 0x5f5f63695f6c6173745f726567656e65726174657c693a313530373233373138383b);

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE IF NOT EXISTS `logs` (
  `id` int(11) NOT NULL,
  `user` varchar(255) DEFAULT NULL,
  `tag` varchar(255) DEFAULT NULL,
  `tag_id` varchar(225) DEFAULT NULL,
  `action` varchar(255) DEFAULT NULL,
  `ip_address` varchar(15) NOT NULL,
  `date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=158 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`id`, `user`, `tag`, `tag_id`, `action`, `ip_address`, `date_time`) VALUES
(2, 'maco', 'user', 'asd', 'User Registration', '', '2017-09-14 12:43:57'),
(3, 'maco', 'user', 'asd', 'Updated User Information', '', '2017-09-15 01:41:14'),
(4, 'maco', 'user', 'test', 'Resetted Password to Default', '', '2017-09-15 01:42:22'),
(5, 'maco', 'user', 'test', 'Deleted User', '', '2017-09-15 01:42:41'),
(6, 'maco', '', '', 'Updated Personal Profile', '', '2017-09-15 02:38:10'),
(7, 'maco', '', '', 'Updated Personal Profile', '', '2017-09-15 02:38:40'),
(8, 'maco', 'brand', '4', 'Brand Registration', '', '2017-09-15 05:01:56'),
(9, 'maco', 'brand', '0', 'Updated Brand Information', '', '2017-09-15 06:35:31'),
(10, 'maco', 'brand', '0', 'Updated Brand Information', '', '2017-09-15 06:35:36'),
(11, 'maco', 'brand', '0', 'Updated Brand Information', '', '2017-09-15 06:35:51'),
(12, 'maco', 'brand', '4', 'Updated Brand Information', '', '2017-09-15 06:36:48'),
(13, 'maco', 'brand', '4', 'Updated Brand Information', '', '2017-09-15 06:37:20'),
(14, 'maco', 'brand', '4', 'Updated Brand Information', '', '2017-09-15 06:37:39'),
(15, 'maco', 'brand', '4', 'Updated Brand Information', '', '2017-09-15 06:37:44'),
(16, 'maco', 'brand', '4', 'Updated Brand Information', '', '2017-09-15 06:37:49'),
(17, 'maco', 'brand', '4', 'Updated Brand Information', '', '2017-09-15 06:38:08'),
(18, 'maco', 'brand', '4', 'Updated Brand Information', '', '2017-09-15 06:38:13'),
(19, 'maco', 'brand', '4', 'Deleted Brand', '', '2017-09-15 06:40:21'),
(20, 'maco', 'brand', '1', 'Deleted Brand', '', '2017-09-15 06:41:00'),
(21, 'maco', 'item', '0', 'Product Registration', '', '2017-09-15 07:50:54'),
(22, 'maco', 'item', 'ITEM00012111', 'Updated Item Information', '', '2017-09-15 08:28:22'),
(23, 'maco', 'item', 'ITEM00004', 'Product Registration', '', '2017-09-15 08:32:45'),
(24, 'maco', 'item', 'ITEM00002', 'Updated Item Information', '', '2017-09-15 08:44:05'),
(25, 'maco', 'item', 'ITEM00004', 'Deleted Item', '', '2017-09-15 08:46:40'),
(26, 'maco', 'item', 'ITEM00002', 'Updated Item Information', '', '2017-09-15 09:08:55'),
(27, 'maco', 'location', '4', 'Location Registration', '', '2017-09-15 10:48:13'),
(28, 'maco', 'item', '1', 'Updated Location Information', '', '2017-09-15 12:21:15'),
(29, 'maco', 'item', '1', 'Updated Location Information', '', '2017-09-15 12:22:38'),
(30, 'maco', 'item', '1', 'Updated Location Information', '', '2017-09-15 12:22:41'),
(31, 'maco', 'item', '1', 'Updated Location Information', '', '2017-09-15 12:22:47'),
(32, 'maco', 'item', '1', 'Deleted Location', '', '2017-09-15 12:22:52'),
(33, 'maco', 'location', '1', 'Updated Location Information', '', '2017-09-15 12:23:55'),
(34, 'maco', 'location', '1', 'Updated Location Information', '', '2017-09-15 12:23:58'),
(35, 'maco', 'item', 'ITEM00005', 'Product Registration', '', '2017-09-15 14:13:27'),
(36, 'maco', 'item', 'ITEM00005', 'Updated Item Information', '', '2017-09-15 14:21:03'),
(37, 'maco', 'item', 'ITEM00005', 'Updated Item Information', '', '2017-09-15 14:21:07'),
(38, 'maco', 'user', 'asd', 'Resetted Password to Default', '', '2017-09-15 14:30:08'),
(39, 'asd', '', '', 'Updated Personal Profile', '', '2017-09-15 14:32:54'),
(40, 'maco', 'location', '5', 'Location Registration', '', '2017-09-16 08:18:29'),
(41, 'maco', 'brand', '4', 'Updated Brand Information', '', '2017-09-16 08:19:35'),
(42, 'maco', 'item', 'ITEM00001', 'Updated Item Information', '', '2017-09-16 08:29:52'),
(43, 'maco', 'item', 'ITEM00006', 'Product Registration', '', '2017-09-16 08:30:33'),
(44, 'maco', 'brand', '5', 'Brand Registration', '', '2017-09-16 08:31:30'),
(45, 'maco', 'export', '2', 'Updated Export Information', '', '2017-09-22 11:44:47'),
(46, 'maco', 'user', 'bibbo', 'User Registration', '', '2017-09-22 13:25:45'),
(47, 'bibbo', '', '', 'Updated Personal Profile', '', '2017-09-22 13:28:55'),
(48, 'bibbo', 'item', 'ITEM00007', 'Product Registration', '', '2017-09-22 13:30:39'),
(49, 'bibbo', 'item', 'ITEM00008', 'Product Registration', '', '2017-09-22 13:31:27'),
(50, 'bibbo', 'item', 'ITEM00009', 'Product Registration', '', '2017-09-22 13:32:10'),
(51, 'maco', 'user', 'bibbo', 'Updated User Information', '', '2017-09-22 13:48:03'),
(52, 'maco', 'user', 'bibbo', 'Updated User Information', '', '2017-09-22 13:49:02'),
(53, 'bibbo', 'export', '2', 'Updated Export Information', '', '2017-09-22 14:13:48'),
(54, 'maco', 'import', '1', 'Imported an Export', '', '2017-09-22 16:00:02'),
(55, 'maco', 'import', '2', 'Imported an Export', '', '2017-09-22 17:30:24'),
(56, 'maco', 'import', '2', 'Imported to actual inventory - Warehouse - Dipolog', '', '2017-09-22 17:50:25'),
(57, 'maco', 'location', '1', 'Imported Items - IMP #00002', '', '2017-09-22 17:50:25'),
(58, 'maco', 'import', '3', 'Imported an Export', '', '2017-09-22 17:50:59'),
(59, 'maco', 'import', '3', 'Imported to actual inventory - Warehouse - Dipolog', '', '2017-09-22 17:51:15'),
(60, 'maco', 'location', '1', 'Imported Items - IMP #00003', '', '2017-09-22 17:51:15'),
(61, 'maco', 'import', '4', 'Imported an Export', '', '2017-09-22 17:55:18'),
(62, 'maco', 'import', '4', 'Imported to actual inventory - Warehouse - Zamboanga', '', '2017-09-22 17:55:35'),
(63, 'maco', 'location', '3', 'Imported Items - IMP #00004', '', '2017-09-22 17:55:35'),
(64, 'maco', 'user', 'testacc', 'User Registration', '', '2017-09-23 07:43:12'),
(65, 'testacc', '', '', 'Updated Personal Profile', '', '2017-09-23 07:47:13'),
(66, 'maco', 'user', 'testacc', 'Updated User Information', '', '2017-09-23 07:48:21'),
(67, 'testacc', 'item', 'ITEM00010', 'Product Registration', '', '2017-09-23 07:49:34'),
(68, 'testacc', 'item', 'ITEM00011', 'Product Registration', '', '2017-09-23 07:50:33'),
(69, 'testacc', 'item', 'ITEM00012', 'Product Registration', '', '2017-09-23 07:51:23'),
(70, 'maco', 'import', '5', 'Imported an Export', '', '2017-09-23 07:58:47'),
(71, 'maco', 'import', '5', 'Imported to actual inventory - Warehouse - Dipolog', '', '2017-09-23 07:59:39'),
(72, 'maco', 'location', '1', 'Imported Items - IMP #00005', '', '2017-09-23 07:59:39'),
(73, 'maco', 'item', 'ITEM00005', 'Updated Item Information', '', '2017-09-26 06:45:22'),
(74, 'maco', 'item', 'ITEM00002', 'Updated Item Information', '', '2017-09-26 06:45:48'),
(75, 'maco', 'item', 'ITEM00005', 'Updated Item Information', '', '2017-09-26 06:46:13'),
(76, 'maco', 'item', 'ITEM00013', 'Product Registration', '', '2017-09-26 10:53:23'),
(77, 'maco', 'user', 'bibbo', 'Updated User Information', '', '2017-09-26 10:54:13'),
(78, 'bibbo', 'item', 'ITEM00013', 'Updated Item Information', '', '2017-09-26 10:54:40'),
(79, 'bibbo', 'item', 'ITEM00002', 'Updated Item Information', '', '2017-09-26 11:36:51'),
(80, 'bibbo', 'item', 'ITEM00004', 'Updated Item Information', '', '2017-09-26 11:37:04'),
(81, 'maco', 'import', '6', 'Imported an Export', '', '2017-09-26 11:38:45'),
(82, 'maco', 'import', '6', 'Imported to actual inventory - Warehouse - Dipolog', '', '2017-09-26 11:39:10'),
(83, 'maco', 'location', '1', 'Imported Items - IMP #00006', '', '2017-09-26 11:39:10'),
(84, 'maco', 'item', 'ITEM00012', 'Updated Item Information', '', '2017-09-26 11:39:45'),
(85, 'maco', 'request', '1', 'Created Request', '', '2017-09-26 13:25:50'),
(86, 'maco', 'request', '2', 'Created Request', '', '2017-09-26 14:39:35'),
(87, 'maco', 'request', '2', 'Updated Request Information', '', '2017-09-26 23:48:15'),
(88, 'maco', 'request', '3', 'Updated Request Information', '', '2017-09-27 05:34:35'),
(89, 'bibbo', 'request', '3', 'Request Accepted byBibbo', '', '2017-09-27 06:00:40'),
(90, 'bibbo', 'export', '0', 'Export Queue created thru Request #00003', '', '2017-09-27 06:00:40'),
(91, 'bibbo', 'request', '3', 'Request Accepted byBibbo', '', '2017-09-27 06:01:40'),
(92, 'bibbo', 'export', '7', 'Export Queue created thru Request #00003', '', '2017-09-27 06:01:40'),
(93, 'bibbo', 'export', '7', 'Updated Export Information', '', '2017-09-27 06:01:57'),
(94, 'bibbo', 'export', '7', 'Updated Export Information', '', '2017-09-27 06:02:00'),
(95, 'bibbo', 'export', '7', 'Updated Export Information', '', '2017-09-27 06:02:03'),
(96, 'maco', 'request', '4', 'Created Request', '', '2017-09-27 06:08:29'),
(97, 'maco', 'request', '4', 'Updated Request Information', '', '2017-09-27 06:08:44'),
(98, 'maco', 'request', '4', 'Verified Request', '', '2017-09-27 06:08:47'),
(99, 'bibbo', 'request', '4', 'Request Accepted byBibbo', '', '2017-09-27 06:08:59'),
(100, 'bibbo', 'export', '8', 'Export Queue created thru Request #00004', '', '2017-09-27 06:08:59'),
(101, 'maco', 'user', 'admin', 'User Registration', '', '2017-09-27 07:22:36'),
(102, 'admin', '', '', 'Updated Personal Profile', '', '2017-09-27 07:23:23'),
(103, 'admin', 'brand', '6', 'Brand Registration', '', '2017-09-27 07:26:42'),
(104, 'admin', 'item', 'ITEM00014', 'Product Registration', '', '2017-09-27 07:29:40'),
(105, 'admin', 'item', 'ITEM00015', 'Product Registration', '', '2017-09-27 07:34:36'),
(106, 'admin', 'location', '6', 'Location Registration', '', '2017-09-27 07:35:18'),
(107, 'admin', 'user', 'crownrubber', 'User Registration', '', '2017-09-27 07:39:34'),
(108, 'crownrubber', '', '', 'Updated Personal Profile', '', '2017-09-27 07:40:42'),
(109, 'crownrubber', 'item', 'ITEM00014', 'Updated Item Information', '', '2017-09-27 07:43:29'),
(110, 'crownrubber', 'export', '9', 'Updated Export Information', '', '2017-09-27 07:44:55'),
(111, 'admin', 'import', '7', 'Imported an Export', '', '2017-09-27 07:45:58'),
(112, 'admin', 'import', '7', 'Imported to actual inventory - Minaog', '', '2017-09-27 07:47:17'),
(113, 'admin', 'location', '6', 'Imported Items - IMP #00007', '', '2017-09-27 07:47:17'),
(114, 'admin', 'request', '5', 'Created Request', '', '2017-09-27 07:48:33'),
(115, 'admin', 'request', '5', 'Verified Request', '', '2017-09-27 07:49:29'),
(116, 'crownrubber', 'request', '5', 'Request Accepted byJuan Luna', '', '2017-09-27 07:50:07'),
(117, 'crownrubber', 'export', '10', 'Export Queue created thru Request #00005', '', '2017-09-27 07:50:07'),
(118, 'crownrubber', 'export', '10', 'Updated Export Information', '', '2017-09-27 07:50:40'),
(119, 'admin', 'import', '8', 'Imported an Export', '', '2017-09-27 07:51:07'),
(120, 'admin', 'import', '8', 'Imported to actual inventory - Store - Dipolog', '', '2017-09-27 07:51:31'),
(121, 'admin', 'location', '4', 'Imported Items - IMP #00008', '', '2017-09-27 07:51:31'),
(122, 'admin', 'request', '6', 'Created Request', '', '2017-09-27 07:53:28'),
(123, 'maco', 'location', '1', 'Updated Location Information', '', '2017-09-27 20:07:30'),
(124, 'maco', 'location', '1', 'Updated Location Information', '', '2017-09-27 20:07:34'),
(125, 'maco', 'location', '3', 'Updated Location Information', '', '2017-09-27 21:48:45'),
(126, 'maco', 'location', '3', 'Updated Location Information', '', '2017-09-27 21:48:48'),
(127, 'maco', 'location', '3', 'Updated Location Information', '', '2017-09-27 21:54:27'),
(128, 'maco', 'location', '3', 'Moved items to Testing - MOVE #00010', '', '2017-09-27 23:03:25'),
(129, 'maco', 'location', '4', 'Moved items to Warehouse - Cebu - MOVE #00011', '', '2017-09-28 22:10:41'),
(130, 'maco', 'location', '4', 'Disposed Items - MOVE #00012', '', '2017-09-28 22:14:09'),
(131, 'maco', 'request', '6', 'Verified Request', '', '2017-09-28 23:14:14'),
(132, 'maco', 'request', '7', 'Created Request', '', '2017-09-29 23:10:18'),
(133, 'maco', 'request', '7', 'Canceled Request', '', '2017-09-29 23:10:30'),
(134, 'maco', 'request', '8', 'Created Request', '', '2017-09-29 23:10:44'),
(135, 'maco', 'request', '8', 'Verified Request', '', '2017-09-29 23:10:58'),
(136, 'bibbo', 'request', '8', 'Request Accepted byBibbo', '', '2017-09-29 23:11:10'),
(137, 'bibbo', 'export', '11', 'Export Queue created thru Request #00008', '', '2017-09-29 23:11:10'),
(138, 'maco', 'request', '9', 'Created Request', '', '2017-09-29 23:14:19'),
(139, 'maco', 'request', '9', 'Updated Request Information', '', '2017-09-29 23:14:24'),
(140, 'maco', 'request', '9', 'Verified Request', '', '2017-09-29 23:14:29'),
(141, 'bibbo', 'request', '9', 'Request Accepted byBibbo', '', '2017-09-29 23:17:44'),
(142, 'bibbo', 'export', '13', 'Export Queue created thru Request #00009', '', '2017-09-29 23:17:44'),
(143, 'bibbo', 'export', '13', 'Updated Export Information', '', '2017-09-29 23:18:20'),
(144, 'bibbo', 'export', '11', 'Updated Export Information', '', '2017-09-29 23:19:17'),
(145, 'maco', 'import', '9', 'Imported an Export', '', '2017-09-29 23:19:39'),
(146, 'maco', 'import', '9', 'Imported to actual inventory - Warehouse - Dipolog', '192.168.001.001', '2017-09-29 23:19:45'),
(147, 'maco', 'location', '1', 'Imported Items - IMP #00009', '', '2017-09-29 23:19:45'),
(148, 'maco', 'item', 'ITEM00016', 'Product Registration', '::1', '2017-09-29 23:27:38'),
(149, 'maco', 'item', 'ITEM00017', 'Product Registration', '::1', '2017-09-29 23:43:08'),
(150, 'maco', 'item', 'ITEM00018', 'Product Registration', '::1', '2017-09-30 04:54:05'),
(151, 'maco', 'item', 'ITEM00001', 'Updated Item Information', '::1', '2017-09-30 07:36:36'),
(152, 'maco', 'sale', '2', 'Purchased by Walk-in', '::1', '2017-09-30 08:42:37'),
(153, 'maco', 'sale', '3', 'Purchased by Walk-in', '::1', '2017-09-30 08:43:44'),
(154, 'maco', 'sale', '4', 'Purchased by Walk-in', '::1', '2017-09-30 08:45:27'),
(155, 'admin', 'item', 'ITEM00019', 'Product Registration', '::1', '2017-10-05 19:35:24'),
(156, 'admin', 'sale', '5', 'Purchased by Walk-in', '::1', '2017-10-05 19:38:53'),
(157, 'admin', 'user', 'Newbie2017', 'User Registration', '::1', '2017-10-05 20:41:26');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) NOT NULL,
  `setting_field` varchar(255) NOT NULL,
  `value` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `setting_field`, `value`) VALUES
(1, 'site_name', 'Inventory System');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `username` varchar(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `brand` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `contact` varchar(255) DEFAULT NULL,
  `usertype` varchar(255) NOT NULL,
  `img` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `is_deleted` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `password`, `name`, `location`, `brand`, `email`, `contact`, `usertype`, `img`, `created_at`, `updated_at`, `is_deleted`) VALUES
('admin', '$2y$10$mt9rqihNCu6CVMnAcyqOreGwmO4yh2rgD9zvODgvxcpcDHvMIMcm6', 'Administrator', NULL, NULL, 'admin@admin.com', '1234567890', 'Administrator', '', '2017-09-27 15:22:36', '2017-09-27 07:23:23', 0),
('asd', '$2y$10$uo82doJurg9UTSKB5ZsHVuOUbc1S.bY5eb5oWmcqNVDZE//yQdJte', 'Mia Luisa Sanchez', NULL, 'Tire King', 'mia@mia.com', '12121454asd', 'Administrator', '57ee82b17727cfa683faea80e720ff96.jpg', '2017-09-14 20:43:57', '2017-09-15 14:32:54', 0),
('bibbo', '$2y$10$oBxDYZpitapcaOuaKSL0OuXJx5nvKnm8J9pjEgVBgEgKcxgvYhqp6', 'Bibbo', NULL, 'Tire King', 'bibbo@bibbo.com', '231321564', 'Supplier User', '', '2017-09-22 21:25:45', '2017-09-26 10:54:13', 0),
('crownrubber', '$2y$10$l20HV2AeyvExZ/UizfnhgeOBgP38RNmRC5g.z3ri0fz6/0QUGV13K', 'Juan Luna', NULL, 'Crown Rubber Corporation', 'crown@crow.com', '123456789', 'Supplier User', '', '2017-09-27 15:39:34', '2017-09-27 07:40:42', 0),
('maco', '$2y$10$QF6KBzs5FZpLH31c/1CqiutrlVOnq0gWtXde4qtg9LIxvDUdLnG3S', 'Maco Cortes', 'Warehouse - Zamboanga', NULL, 'maco.techdepot@gmail.com', '09058208455', 'Administrator', '95d9e91ba95089b52db4c74ff03f13ea.jpg', '2017-09-14 20:10:01', '2017-09-30 08:37:48', 0),
('Newbie2017', '$2y$10$tzN0z/zHD8A3xaI6EnV8uei/HeWZYpxigjxBAJWuU0MnMB5BawjAG', 'Newbie 2017', NULL, NULL, 'newbie2017@gmail.com', '09123456789', 'Supplier User', 'a25bedbebb21a59884c17655044422ba.jpg', '2017-10-06 04:41:26', NULL, 0),
('test', '$2y$10$.ebM/6yhzaLnBCHVfxRpzOtgrsetbGo5g4QV/STLxsVLnPN5Bf6G6', 'Testing Assistant', NULL, 'Nestle', 'test@test.com', '564564564', 'Administrator', '55f7f100c785d43bc3ee1bd7bcc2015b.jpg', '2017-09-14 20:12:52', '2017-09-15 01:42:41', 1),
('testacc', '$2y$10$sPE0x.pcFdMxIMdoe0CHa.zCG6gBTwpWNcXEWoKam.bBM01IHLjmm', 'Testing Account', NULL, 'Lee Plaza', 'test@test.com', '1234567890', 'Supplier User', '', '2017-09-23 15:43:12', '2017-09-23 07:48:21', 0);

-- --------------------------------------------------------

--
-- Table structure for table `usertypes`
--

CREATE TABLE IF NOT EXISTS `usertypes` (
  `title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `usertypes`
--

INSERT INTO `usertypes` (`title`) VALUES
('Administrator'),
('Supplier User');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ci_sessions`
--
ALTER TABLE `ci_sessions`
  ADD KEY `ci_sessions_timestamp` (`timestamp`) USING BTREE;

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`),
  ADD KEY `FKUsertype` (`usertype`),
  ADD KEY `FKuserbrn` (`brand`),
  ADD KEY `name` (`name`),
  ADD KEY `FKUserLocation` (`location`);

--
-- Indexes for table `usertypes`
--
ALTER TABLE `usertypes`
  ADD PRIMARY KEY (`title`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=158;
--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
