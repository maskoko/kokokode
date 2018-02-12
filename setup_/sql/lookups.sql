
--
-- Table structure for table `sekolah_jenis`
--

CREATE TABLE IF NOT EXISTS `sekolah_jenis` (
  `nama_jenis` varchar(30) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `rtag` tinyint(1) DEFAULT '0',
  `created_date` datetime,
  PRIMARY KEY (`nama_jenis`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `sekolah_skepemilikan` (
  `nama_status` varchar(20) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `rtag` tinyint(1) DEFAULT '0',
  `created_date` datetime,
  PRIMARY KEY (`nama_status`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `sekolah_status` (
  `nama_status` varchar(20) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `rtag` tinyint(1) DEFAULT '0',
  `created_date` datetime,
  PRIMARY KEY (`nama_status`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `sekolah_tingkat` (
  `nama_tingkat` varchar(10) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `rtag` tinyint(1) DEFAULT '0',
  `created_date` datetime,
  PRIMARY KEY (`nama_tingkat`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `kualifikasi_geografis` (
  `nama_geografis` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `rtag` tinyint(1) DEFAULT '0',
  `created_date` datetime,
  PRIMARY KEY (`nama_geografis`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `tingkat_pendidikan` (
  `nama_tingkat` varchar(15) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `rtag` tinyint(1) DEFAULT '0',
  `created_date` datetime,
  PRIMARY KEY (`nama_tingkat`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `gelar` (
  `nama_gelar` varchar(20) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `rtag` tinyint(1) DEFAULT '0',
  `created_date` datetime,
  PRIMARY KEY (`nama_gelar`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `jabatan_fungsional` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_jabatan` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `rtag` int(11) DEFAULT '0',
  `created_date` datetime,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

CREATE INDEX jabfs_nama_idx ON jabatan_fungsional(nama_jabatan);


CREATE TABLE IF NOT EXISTS `golongan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_golongan` varchar(10) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `jabatanid` int(11) NOT NULL,
  
  `rtag` int(11) DEFAULT '0',
  `created_date` datetime,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `jabatan_pokok` (
  `nama_jabatan` varchar(40) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `rtag` int(11) DEFAULT '0',
  `created_date` datetime,
  PRIMARY KEY (`nama_jabatan`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

--
-- Table structure for table `tugas_pokok`
--

CREATE TABLE IF NOT EXISTS `tugas_pokok` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_tugas` varchar(60) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `rtag` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tugas_pokok`
--

INSERT INTO `tugas_pokok` (`id`, `nama_tugas`, `rtag`) VALUES
(1, 'Pendidik/Guru', 0),
(2, 'Tenaga Kependidikan Formal', 0),
(3, 'Pendidik dan Tenaga Kependidikan Non Formal', 0);




/* ---------------------------------------- DATA LOOKUPS ---------------------------------------- */

INSERT INTO sekolah_jenis
 VALUES ('Sekolah', 0, '2012-06-01 06:00:00');

INSERT INTO sekolah_jenis
 VALUES ('Madrasah', 0, '2012-06-01 06:00:00');

INSERT INTO sekolah_jenis
 VALUES ('Kantor Kecamatan', 0, '2012-06-01 06:00:00');

INSERT INTO sekolah_jenis
 VALUES ('Kantor Dinas Kab./Kota', 0, '2012-06-01 06:00:00');

INSERT INTO sekolah_jenis
 VALUES ('Pusat Khusus', 0, '2012-06-01 06:00:00');

INSERT INTO sekolah_jenis
 VALUES ('Taman Bermain', 0, '2012-06-01 06:00:00');

INSERT INTO sekolah_jenis
 VALUES ('Kantor Dinas Propinsi', 0, '2012-06-01 06:00:00');

INSERT INTO sekolah_jenis
 VALUES ('SKB', 0, '2012-06-01 06:00:00');

/* --------------------------------------------- */

INSERT INTO sekolah_skepemilikan
 VALUES ('Pemerintah Pusat', 0, '2012-06-01 06:00:00');


INSERT INTO sekolah_skepemilikan
 VALUES ('Pemerintah Daerah', 0, '2012-06-01 06:00:00');

INSERT INTO sekolah_skepemilikan
 VALUES ('Yayasan', 0, '2012-06-01 06:00:00');

INSERT INTO sekolah_skepemilikan
 VALUES ('Lembaga', 0, '2012-06-01 06:00:00');

/* --------------------------------------------- */


INSERT INTO sekolah_status
 VALUES ('Yayasan', 0, '2012-06-01 06:00:00');


INSERT INTO sekolah_status
 VALUES ('Negeri', 0, '2012-06-01 06:00:00');

INSERT INTO sekolah_status
 VALUES ('Lembaga', 0, '2012-06-01 06:00:00');

INSERT INTO sekolah_status
 VALUES ('Swasta', 0, '2012-06-01 06:00:00');

/* --------------------------------------------- */


INSERT INTO sekolah_tingkat
 VALUES ('TK', 0, '2012-06-01 06:00:00');

INSERT INTO sekolah_tingkat
 VALUES ('SD', 0, '2012-06-01 06:00:00');

INSERT INTO sekolah_tingkat
 VALUES ('SMP', 0, '2012-06-01 06:00:00');

INSERT INTO sekolah_tingkat
 VALUES ('SLB', 0, '2012-06-01 06:00:00');

INSERT INTO sekolah_tingkat
 VALUES ('SMA', 0, '2012-06-01 06:00:00');

INSERT INTO sekolah_tingkat
 VALUES ('SMK', 0, '2012-06-01 06:00:00');

INSERT INTO sekolah_tingkat
 VALUES ('RA', 0, '2012-06-01 06:00:00');

INSERT INTO sekolah_tingkat
 VALUES ('MI', 0, '2012-06-01 06:00:00');

INSERT INTO sekolah_tingkat
 VALUES ('MTs', 0, '2012-06-01 06:00:00');

INSERT INTO sekolah_tingkat
 VALUES ('MA', 0, '2012-06-01 06:00:00');


/* --------------------------------------------- */


INSERT INTO kualifikasi_geografis
 VALUES ('Terpencil', 0, '2012-06-01 06:00:00');

INSERT INTO kualifikasi_geografis
 VALUES ('Perkotaan', 0, '2012-06-01 06:00:00');

INSERT INTO kualifikasi_geografis
 VALUES ('Pedesaan', 0, '2012-06-01 06:00:00');

INSERT INTO kualifikasi_geografis
 VALUES ('Daerah Perbatasan', 0, '2012-06-01 06:00:00');

INSERT INTO kualifikasi_geografis
 VALUES ('Daerah Sulit', 0, '2012-06-01 06:00:00');


/* --------------------------------------------- */

INSERT INTO tingkat_pendidikan
 VALUES ('TK', 0, '2012-06-01 06:00:00');

INSERT INTO tingkat_pendidikan
 VALUES ('SD', 0, '2012-06-01 06:00:00');

INSERT INTO tingkat_pendidikan
 VALUES ('SMP', 0, '2012-06-01 06:00:00');


INSERT INTO tingkat_pendidikan
 VALUES ('SMA', 0, '2012-06-01 06:00:00');

INSERT INTO tingkat_pendidikan
 VALUES ('SMK', 0, '2012-06-01 06:00:00');

INSERT INTO tingkat_pendidikan
 VALUES ('D1', 0, '2012-06-01 06:00:00');

INSERT INTO tingkat_pendidikan
 VALUES ('D2', 0, '2012-06-01 06:00:00');

INSERT INTO tingkat_pendidikan
 VALUES ('D3', 0, '2012-06-01 06:00:00');

INSERT INTO tingkat_pendidikan
 VALUES ('D4', 0, '2012-06-01 06:00:00');

INSERT INTO tingkat_pendidikan
 VALUES ('S1', 0, '2012-06-01 06:00:00');

INSERT INTO tingkat_pendidikan
 VALUES ('S2', 0, '2012-06-01 06:00:00');

INSERT INTO tingkat_pendidikan
 VALUES ('S3', 0, '2012-06-01 06:00:00');


/* --------------------------------------------- */


INSERT INTO gelar
 VALUES ('Drs', 0, '2012-06-01 06:00:00');
INSERT INTO gelar
 VALUES ('Dr', 0, '2012-06-01 06:00:00');
INSERT INTO gelar
 VALUES ('MSi', 0, '2012-06-01 06:00:00');
INSERT INTO gelar
 VALUES ('SPd', 0, '2012-06-01 06:00:00');


/* --------------------------------------------- */

INSERT INTO jabatan_fungsional
 VALUES (1, 'Guru Pertama', 0, '2012-06-01 06:00:00');

INSERT INTO jabatan_fungsional
 VALUES (2, 'Guru Muda', 0, '2012-06-01 06:00:00');

INSERT INTO jabatan_fungsional
 VALUES (3, 'Guru Madya', 0, '2012-06-01 06:00:00');

INSERT INTO jabatan_fungsional
 VALUES (4, 'Guru Utama', 0, '2012-06-01 06:00:00');


INSERT INTO golongan
 VALUES (null, 'III A', 1, 0, '2012-06-01 06:00:00');

INSERT INTO golongan
 VALUES (null, 'III B', 1, 0, '2012-06-01 06:00:00');

INSERT INTO golongan
 VALUES (null, 'III C', 2, 0, '2012-06-01 06:00:00');

INSERT INTO golongan
 VALUES (null, 'III D', 2, 0, '2012-06-01 06:00:00');

INSERT INTO golongan
 VALUES (null, 'IV A', 3, 0, '2012-06-01 06:00:00');

INSERT INTO golongan
 VALUES (null, 'IV B', 3, 0, '2012-06-01 06:00:00');

INSERT INTO golongan
 VALUES (null, 'IV D', 4, 0, '2012-06-01 06:00:00');

INSERT INTO golongan
 VALUES (null, 'IV E', 4, 0, '2012-06-01 06:00:00');


/* --------------------------------------------- */

INSERT INTO jabatan_pokok
 VALUES ('Kepala Sekolah', 0, '2012-06-01 06:00:00');

INSERT INTO jabatan_pokok
 VALUES ('Wakil Kepala Sekolah', 0, '2012-06-01 06:00:00');

INSERT INTO jabatan_pokok
 VALUES ('Kepala TU', 0, '2012-06-01 06:00:00');

INSERT INTO jabatan_pokok
 VALUES ('Staf Administrasi TU', 0, '2012-06-01 06:00:00');

INSERT INTO jabatan_pokok
 VALUES ('Bendahara', 0, '2012-06-01 06:00:00');

INSERT INTO jabatan_pokok
 VALUES ('Laboran', 0, '2012-06-01 06:00:00');

INSERT INTO jabatan_pokok
 VALUES ('Pustakawan', 0, '2012-06-01 06:00:00');

INSERT INTO jabatan_pokok
 VALUES ('Petugas Instalasi', 0, '2012-06-01 06:00:00');

INSERT INTO jabatan_pokok
 VALUES ('Juru Bengkel', 0, '2012-06-01 06:00:00');

INSERT INTO jabatan_pokok
 VALUES ('Pesuruh/Penjaga Sekolah', 0, '2012-06-01 06:00:00');

INSERT INTO jabatan_pokok
 VALUES ('Pengawas Sekolah', 0, '2012-06-01 06:00:00');



