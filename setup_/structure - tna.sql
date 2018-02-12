
--
-- Table structure for table `kk_tna` : data tambahan untuk Kompetensi Keahlian ( notes untuk deskripsi per KK saat proses TNA.. lihat file .doc tiap KK )
--

CREATE TABLE IF NOT EXISTS `kk_tna` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kkid` int(11) NOT NULL,
  `notes` text,

  `last_update` datetime,
  `created` datetime NOT NULL,
  `userid` int(11),
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;


--
-- Table structure for table `sk` : standar kompetensi terbagi atas 'jenis' : DKK dan KK ... lihat file .doc
--

CREATE TABLE IF NOT EXISTS `sk` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kkid` int(11) NOT NULL,
  `skindex` int(11) NOT NULL,
  `nama_kompetensi` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,

  `jenis` varchar(3) CHARACTER SET utf8 COLLATE utf8_general_ci,
  
  `last_update` datetime,
  `created` datetime NOT NULL,
  `userid` int(11),
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;


--
-- Table structure for table `kd` : kompetensi dasar
--

CREATE TABLE IF NOT EXISTS `kd` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `skid` int(11) NOT NULL,
  `kdindex` int(11) NOT NULL,
  `nama_kompetensi` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,

  `last_update` datetime,
  `created` datetime NOT NULL,
  `userid` int(11),
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;


--
-- Table structure for table `ptk_tna` : setiap PTK melakukan proses TNA Online, ini data masternya
--

CREATE TABLE IF NOT EXISTS `ptk_tna` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ptkid` int(11) NOT NULL,
  `sekolahid` int(11) NOT NULL,
  `kkid` int(11) NOT NULL,

  `nilai_dkk` int(11) DEFAULT 0,
  `nilai_kk` int(11) DEFAULT 0,
  `nilai_total` int(11) DEFAULT 0,
  
  `last_update` datetime,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;


--
-- Table structure for table `ptk_kd` : ptr entry tna : detailnya
--

CREATE TABLE IF NOT EXISTS `ptk_kd` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ptk_tnaid` int(11) NOT NULL,
  `kdid` int(11) NOT NULL,
  `kd_value` tinyint(1),
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

