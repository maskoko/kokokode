--
-- Table structure for table `golongan` : import dari mysql database lama via software import
--

CREATE TABLE IF NOT EXISTS `golongan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode` varchar(50)  CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `nama_pangkat` varchar(20) CHARACTER SET utf8 COLLATE utf8_bin ,
  `nama_fungsional` varchar(20) CHARACTER SET utf8 COLLATE utf8_bin ,
  `nama_widyaiswara` varchar(25) CHARACTER SET utf8 COLLATE utf8_bin ,
  `nama_struktural` varchar(25) CHARACTER SET utf8 COLLATE utf8_bin ,
  
  `last_update` datetime,
  `created` datetime NOT NULL,
  `userid` int(11),  
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

--
-- Table structure for table `kualifikasi_geografis` : referensi hanya table saja untuk sekolah
--

CREATE TABLE `kualifikasi_geografis` 
(
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_geografis`	varchar(50)  CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  
  `last_update` datetime,
  `created` datetime NOT NULL,
  `userid` int(11),  
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

--
-- Table structure for table `sekolah_tingkat` : TK, SD ... MTs, MA
--
   
CREATE TABLE `sekolah_tingkat` 
(
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_tingkat`	varchar(50)  CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  
  `last_update` datetime,
  `created` datetime NOT NULL,
  `userid` int(11),  
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

--
-- Table structure for table `sekolah_jenis` : sekolah, madrasah, .... kantor dinas propinsi, SKB
--

CREATE TABLE IF NOT EXISTS `sekolah_jenis` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_jenis` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,

  `last_update` datetime,
  `created` datetime NOT NULL,
  `userid` int(11),
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

--
-- Table structure for table `sekolah_skepemilikan` : Pemerintah Pusat, Pemerintah Daerah...
--
  
CREATE TABLE `sekolah_skepemilikan` 
(
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_status`	varchar(50)  CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  
  `last_update` datetime,
  `created` datetime NOT NULL,
  `userid` int(11),  
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

--
-- Table structure for table `sekolah_status` : Yayasan, Negeri...
--
  
CREATE TABLE `sekolah_status` 
(
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_status`	varchar(50)  CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  
  `last_update` datetime,
  `created` datetime NOT NULL,
  `userid` int(11),  
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
   
--
-- Table structure for table `sekolah_jenjang` : tingkatsekolah / tis --------------------------------------------------------------
--

CREATE TABLE `sekolah_jenjang` 
(
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_jenjang`	varchar(50)  CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `ijazahid` int(11),
  
  `last_update` datetime,
  `created` datetime NOT NULL,
  `userid` int(11),  
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

UPDATE sekolah_jenjang
 SET id = 0
 WHERE nama_jenjang = 'TK';

--
-- Table structure for table `sekolah_ijazah` : tingkatijazah / tiz
--

CREATE TABLE `sekolah_ijazah` 
(
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_ijazah`	varchar(50)  CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  
  `last_update` datetime,
  `created` datetime NOT NULL,
  `userid` int(11),  
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

--
-- Table structure for table `sekolah_jurusan` : jurusanunv
--
 
CREATE TABLE `sekolah_jurusan` 
(
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_jurusan`	varchar(50)  CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  
  `last_update` datetime,
  `created` datetime NOT NULL,
  `userid` int(11),  
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

--
-- Table structure for table `sekolah_matapelajaran` : matapelajaran : 08 dan 8 => 800
--

CREATE TABLE `sekolah_matapelajaran` 
(
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_matapelajaran`	varchar(50)  CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  
  `last_update` datetime,
  `created` datetime NOT NULL,
  `userid` int(11),  
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

 
 --
-- Table structure for table `unitkerja` : untuk staff
--

CREATE TABLE `unitkerja` 
(
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_unit`	varchar(70)  CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `nama_pimpinan`	varchar(50)  CHARACTER SET utf8 COLLATE utf8_bin,
  
  `last_update` datetime,
  `created` datetime NOT NULL,
  `userid` int(11),  
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;


--
-- Table structure for table `kel_matapelajaran`
--

CREATE TABLE `kel_matapelajaran` 
(
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kelompok`	varchar(50)  CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  
  `last_update` datetime,
  `created` datetime NOT NULL,
  `userid` int(11),  
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;


--
-- Table structure for table `matapelajaran`
--

CREATE TABLE `matapelajaran` 
(
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kelid` int(11) NOT NULL,
  `nama_matapelajaran`	varchar(100)  CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  
  `last_update` datetime,
  `created` datetime NOT NULL,
  `userid` int(11),  
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

