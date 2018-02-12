
--
-- Table structure for table `gedung` : untuk table 'diklat_peserta' dimana lokasi tinggal peserta
--

CREATE TABLE IF NOT EXISTS `gedung` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `nama_gedung` varchar(60) CHARACTER SET utf8 COLLATE utf8_general_ci,

  `jml_kamar` int(11) DEFAULT 0,

  `last_update` datetime,
  `created` datetime NOT NULL,
  `userid` int(11),
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;


--
-- Table structure for table `kamar` : untuk table 'diklat_peserta' dimana lokasi tinggal peserta
--

CREATE TABLE IF NOT EXISTS `kamar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gedungid` int(11) NOT NULL,
  `kode` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,

  `jenis` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci,
  `jml_bed` int(11) DEFAULT 0,
  
  `last_update` datetime,
  `created` datetime NOT NULL,
  `userid` int(11),
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;


--
-- Table structure for table `kamar_bed` : untuk table 'diklat_peserta' dimana lokasi tinggal peserta
--

CREATE TABLE IF NOT EXISTS `kamar_bed` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kamarid` int(11) NOT NULL,
  `kode` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `status` varchar(1) CHARACTER SET utf8 COLLATE utf8_general_ci,

  `guestid` int(11),
  `checkin` datetime,
  `checkout` datetime,

  `last_update` datetime,
  `created` datetime NOT NULL,
  `userid` int(11),
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;


--
-- Table structure for table `diklat_mata_tatar` : mata tatar per 'diklat_jadwal'
--

CREATE TABLE IF NOT EXISTS `diklat_mata_tatar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jadwalid` int(11) NOT NULL,
  `kode` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `nama_mata_tatar` varchar(80) CHARACTER SET utf8 COLLATE utf8_general_ci,

  `pengajarid` int(11) NOT NULL,
  `nama_pengajar` varchar(60) CHARACTER SET utf8 COLLATE utf8_general_ci,
  
  `last_update` datetime,
  `created` datetime NOT NULL,
  `userid` int(11),
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;


--
-- Table structure for table `diklat_agenda` : agenda diklat per 'diklat_jadwal'
--

CREATE TABLE IF NOT EXISTS `diklat_agenda` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jadwalid` int(11) NOT NULL,
  `tanggal` date,
  `waktu_dari` time,
  `waktu_sampai` time,
  `mata_tatarid` int(11) NOT NULL,

  `pengajarid` int(11) NOT NULL,
  `nama_pengajar` varchar(60) CHARACTER SET utf8 COLLATE utf8_general_ci,

  `nama_tempat` varchar(60) CHARACTER SET utf8 COLLATE utf8_general_ci,
  
  `keterangan` text,
  
  `last_update` datetime,
  `created` datetime NOT NULL,
  `userid` int(11),
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;


--
-- Table structure for table `diklat_absen` : absensi diklat per 'diklat_jadwal'
--

CREATE TABLE IF NOT EXISTS `diklat_absen` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pesertaid` int(11) NOT NULL,
  `tanggal` date,
  `waktu` time,
  `status` varchar(1),
  `catatan` varchar(100),
  
  `created` datetime NOT NULL,
  `userid` int(11),
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

--
-- Table structure for table `diklat_nilai` : nilai peserta diklat per 'diklat_jadwal'
--

CREATE TABLE IF NOT EXISTS `diklat_nilai` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pesertaid` int(11) NOT NULL,
  `mata_tatarid` int(11) NOT NULL,
  `nilai` varchar(2),
  `catatan` varchar(100),
  
  `last_update` datetime,
  `created` datetime NOT NULL,
  `userid` int(11),
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

