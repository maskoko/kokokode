-- ================================================================
--
-- @version $Id: structure.sql 2011-12-27 10:12:05 gewa $
-- @package SIM P4TK BMTI
-- @copyright 2012. a2ngsa
--
-- ================================================================
-- Database structure
-- ================================================================


--
-- Table structure for table `settings` : Owner dan default info / setting
--

CREATE TABLE IF NOT EXISTS `settings` (
  `company` varchar(75) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `site_url` varchar(75) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `site_email` varchar(80) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `address` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `city` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `state` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `postcode` varchar(6) NOT NULL,
  `phone` varchar(16) DEFAULT NULL,
  `fax` varchar(16) DEFAULT NULL,
  `logo` varchar(60) NOT NULL,
  `short_date` varchar(20) NOT NULL,
  `long_date` varchar(20) NOT NULL,
  `enable_reg` tinyint(1) NOT NULL DEFAULT '1',

  `enable_offline` tinyint(1) NOT NULL DEFAULT '1',
  `offline_info` text,
  `enable_uploads` tinyint(1) NOT NULL DEFAULT '1',
  `file_types` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `file_max` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `perpage` varchar(3) NOT NULL DEFAULT '10',

  `mailer` enum('PHP','SMTP','SMAIL') NOT NULL DEFAULT 'SMTP',
  `smtp_host` varchar(100) DEFAULT NULL,
  `smtp_user` varchar(50) DEFAULT NULL,
  `smtp_pass` varchar(50) DEFAULT NULL,
  `smtp_port` smallint(3) DEFAULT NULL,
  `sendmail` varchar(60) DEFAULT NULL,
  `is_ssl` tinyint(1) NOT NULL DEFAULT '0',
  `ver_info` varchar(5) DEFAULT NULL  
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Table structure for table `user_profiles` : template / grouping untuk users ( usermode : Admin / PTK / Opp dan TNA ) ; module / function_access : represent nilai hak akses
--

CREATE TABLE IF NOT EXISTS `user_profiles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `profilename` varchar(50) NOT NULL,
  `usermode` varchar(2) NOT NULL,
  `module_access` int(11) DEFAULT 0,
  `function_access` int(11) DEFAULT 0,
  `last_update` datetime,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

--
-- Table structure for table `users` : user akses untuk login ( create manual atau via Registrasi PTK )
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(80) NOT NULL,
  `profileid` int(11),

  `ptkid` int(11),
  
  `last_update` datetime DEFAULT '0000-00-00 00:00:00',
  `created` datetime DEFAULT '0000-00-00 00:00:00',
  `lastlogin` datetime DEFAULT '0000-00-00 00:00:00',
  `lastip` varchar(16) DEFAULT '0',
  `active` enum('y','n','t','b') NOT NULL DEFAULT 'n',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- STRUKTUR BARU SIM P4TK BMTI
-- Table structure for table `propinsi` : Rujukan data ( Last_update utk tiap update, Created utk pertama Insert, UserID utk current uid, Source_ID utk tostr nilai sumber, Source_Name utk info sumber spt XLS, Web, MDB, ... )
--

CREATE TABLE IF NOT EXISTS `propinsi` (
  `kode` varchar(3) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `nama_propinsi` varchar(60) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,

  `source_id` varchar(5) CHARACTER SET utf8 COLLATE utf8_general_ci,
  `source_name` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci,

  `last_update` datetime,
  `created` datetime NOT NULL,
  `userid` int(11),
  PRIMARY KEY (`kode`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

--
-- Table structure for table `kota` : dengan propinsi, import dari Software, data MySQL Web Lama
--

CREATE TABLE IF NOT EXISTS `kota` (
  `kode` varchar(4) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `propinsi_kode` varchar(3) CHARACTER SET utf8 COLLATE utf8_general_ci,
  `nama_kota` varchar(60) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `jenis` varchar(1) CHARACTER SET utf8 COLLATE utf8_general_ci,

  `source_id` varchar(5) CHARACTER SET utf8 COLLATE utf8_general_ci,
  `source_name` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci,

  `last_update` datetime,
  `created` datetime NOT NULL,
  `userid` int(11),
  PRIMARY KEY (`kode`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

--
-- Table structure for table `departemen` : import dari software, data MySQL Web Lama
--

CREATE TABLE IF NOT EXISTS `departemen` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode` varchar(5) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `nama_departemen` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `nama_pimpinan` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci,

  `source_id` varchar(5) CHARACTER SET utf8 COLLATE utf8_general_ci,
  `source_name` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci,

  `last_update` datetime,
  `created` datetime NOT NULL,
  `userid` int(11),
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

--
-- Table structure for table `bsk` : juga psk, dan kk, import dari SampleData.sql (export dari .xls)
--

CREATE TABLE IF NOT EXISTS `bsk` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode` varchar(5) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `nama_bidang` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,

  `source_id` varchar(5) CHARACTER SET utf8 COLLATE utf8_general_ci,
  `source_name` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci,

  `last_update` datetime,
  `created` datetime NOT NULL,
  `userid` int(11),
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;


--
-- Table structure for table `psk`
--

CREATE TABLE IF NOT EXISTS `psk` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bskid` int(11) NOT NULL,
  `kode` varchar(5) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `nama_program` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,

  `source_id` varchar(5) CHARACTER SET utf8 COLLATE utf8_general_ci,
  `source_name` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci,

  `last_update` datetime,
  `created` datetime NOT NULL,
  `userid` int(11),
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

--
-- Table structure for table `kk`
--

CREATE TABLE IF NOT EXISTS `kk` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pskid` int(11) NOT NULL,
  `departemenid` int(11),
  `kode` varchar(5) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `nama_kompetensi` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,

  `source_id` varchar(5) CHARACTER SET utf8 COLLATE utf8_general_ci,
  `source_name` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci,

  `last_update` datetime,
  `created` datetime NOT NULL,
  `userid` int(11),
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

--
-- Table structure for table `sekolah` : import dari software, data MySQL Web Lama dengan struktur disesuaikan format Software Desktop Validasi Komptensi
--

CREATE TABLE IF NOT EXISTS `sekolah` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_sekolah` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `jenisid` int(11) NOT NULL,
  `nss` varchar(13) CHARACTER SET utf8 COLLATE utf8_general_ci,
  `npsn` varchar(8) CHARACTER SET utf8 COLLATE utf8_general_ci,
  `nama_pimpinan` varchar(60) CHARACTER SET utf8 COLLATE utf8_general_ci,
  `nip_pimpinan` varchar(18) CHARACTER SET utf8 COLLATE utf8_general_ci,
  `nuptk_pimpinan` varchar(16) CHARACTER SET utf8 COLLATE utf8_general_ci,
  `telp_pimpinan` varchar(60) CHARACTER SET utf8 COLLATE utf8_general_ci,

  `propinsi_kode` varchar(3) CHARACTER SET utf8 COLLATE utf8_general_ci,
  `kota_kode` varchar(4) CHARACTER SET utf8 COLLATE utf8_general_ci,
  
  `kecamatan` varchar(60) CHARACTER SET utf8 COLLATE utf8_general_ci,
  `kelurahan` varchar(60) CHARACTER SET utf8 COLLATE utf8_general_ci,
  `alamat` varchar(60) CHARACTER SET utf8 COLLATE utf8_general_ci,
  `rt` varchar(4) CHARACTER SET utf8 COLLATE utf8_general_ci,
  `rw` varchar(4) CHARACTER SET utf8 COLLATE utf8_general_ci,
  `kodepos` varchar(6) CHARACTER SET utf8 COLLATE utf8_general_ci,
  `telepon` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci,
  `fax` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci,
  `email` varchar(80) CHARACTER SET utf8 COLLATE utf8_general_ci,
  `website` varchar(80) CHARACTER SET utf8 COLLATE utf8_general_ci,
  
  `kgeografis` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci,
  `statusmilik` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci,
  `status` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci,
  `tingkat` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci,
 
  `akreditasi` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci,  
  `sertf_iso` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci,
  `tahun_sertf_iso` int(4),
  
  `guru_pns` int(11),
  `guru_npns` int(11),
  `guru_tetap` int(11),
  `guru_ttetap` int(11),
  `guru_total` int(11),

  `tk_pns` int(11),
  `tk_npns` int(11),
  `tk_tetap` int(11),
  `tk_ttetap` int(11),
  `tk_total` int(11),

  `ptkid` int(11),  

  `source_id` varchar(5) CHARACTER SET utf8 COLLATE utf8_general_ci,
  `source_name` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci,
  
  `last_update` datetime,
  `created` datetime NOT NULL,
  `userid` int(11),
  
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

--
-- Table structure for table `sekolah_smk` : adaptasi dari software desktop Validasi Kompetensi
--

CREATE TABLE IF NOT EXISTS `sekolah_smk` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sekolahid` int(11),

  `bskid` int(11),
  `pskid` int(11),
  `kkid` int(11),

  `akreditasi` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci,  
  `tahun_akreditasi` int(4),

  `jurusan` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci,  
    
  `last_update` datetime,
  `created` datetime NOT NULL,
  `userid` int(11),

  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

--
-- Table structure for table `sekolah_ppmd`
--

CREATE TABLE IF NOT EXISTS `sekolah_ppmd` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sekolahid` int(11),

  `mata_diklat` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci,
  
  `jml_pns` int(4),
  `jml_nonpns` int(4),
  `jml_tetap` int(4),
  `jml_ttetap` int(4),
  `keterangan` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci,

  `last_update` datetime,
  `created` datetime NOT NULL,
  `userid` int(11),

  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

--
-- Table structure for table `sekolah_rkpsj`
--

CREATE TABLE IF NOT EXISTS `sekolah_rkpsj` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sekolahid` int(11),

  `tingkat_pendidikan` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci,
  
  `jml_gt_l` int(4),
  `jml_gt_p` int(4),
  `jml_gtt_l` int(4),
  `jml_gtt_p` int(4),
  `jml_total` int(4),

  `last_update` datetime,
  `created` datetime NOT NULL,
  `userid` int(11),

  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

--
-- Table structure for table `sekolah_rptl`
--

CREATE TABLE IF NOT EXISTS `sekolah_rptl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sekolahid` int(11),

  `mata_diklat` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci,
  
  `jml_sesuai` int(4),
  `jml_tsesuai` int(4),
  `jml_total` int(4),

  `last_update` datetime,
  `created` datetime NOT NULL,
  `userid` int(11),

  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

--
-- Table structure for table `sekolah_rpkpp`
--

CREATE TABLE IF NOT EXISTS `sekolah_rpkpp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sekolahid` int(11),

  `jenis_pengembangan` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci,  
  `jml_guru` int(4),

  `last_update` datetime,
  `created` datetime NOT NULL,
  `userid` int(11),

  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

--
-- Table structure for table `sekolah_rkpjt`
--

CREATE TABLE IF NOT EXISTS `sekolah_rkpjt` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sekolahid` int(11),

  `tenaga_pendukung` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci,  
  `tingkat_pendidikan` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci,
  `jml` int(4),

  `last_update` datetime,
  `created` datetime NOT NULL,
  `userid` int(11),

  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

--
-- Table structure for table `sekolah_siswa`
--

CREATE TABLE IF NOT EXISTS `sekolah_siswa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sekolahid` int(11),

  `kkid` int(11),
  `akreditasi` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci,  
  `jml_tk1_l` int(4),
  `jml_tk1_p` int(4),
  `jml_tk2_l` int(4),
  `jml_tk2_p` int(4),
  `jml_tk3_l` int(4),
  `jml_tk3_p` int(4),

  `last_update` datetime,
  `created` datetime NOT NULL,
  `userid` int(11),

  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

--
-- Table structure for table `sekolah_ruang` : jenis_ruang : ruangbelajar, laboratorium, kantor, ruangpenunjang, lapangolahraga
--

CREATE TABLE IF NOT EXISTS `sekolah_ruang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sekolahid` int(11),

  `jenis_ruang` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci,  
  `nama_jenis` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci,  
  `jml` int(4),
  `kondisi` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci,  
  `ukuran` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci,  

  `last_update` datetime,
  `created` datetime NOT NULL,
  `userid` int(11),

  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;


--
-- Table structure for table `sekolah_tanah`
--

CREATE TABLE IF NOT EXISTS `sekolah_tanah` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sekolahid` int(11),

  `kepemilikan` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci,  
  `status` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci,  
  `luas` int(4),
  `luas_tt` int(4),
  `luas_tsb` int(4),

  `last_update` datetime,
  `created` datetime NOT NULL,
  `userid` int(11),

  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;




--
-- Table structure for table `ptk` : starter import via software import, data MySQL Web Lama dan struktur dilengkapi dari software desktop Validasi Kompetensi
--

CREATE TABLE IF NOT EXISTS `ptk` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_lengkap` varchar(60) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,

  `sekolahid` int(11),

  `gelar_depan1` varchar(6) CHARACTER SET utf8 COLLATE utf8_general_ci,
  `gelar_depan2` varchar(6) CHARACTER SET utf8 COLLATE utf8_general_ci,
  `gelar_depan3` varchar(6) CHARACTER SET utf8 COLLATE utf8_general_ci,

  `gelar_belakang1` varchar(6) CHARACTER SET utf8 COLLATE utf8_general_ci,
  `gelar_belakang2` varchar(6) CHARACTER SET utf8 COLLATE utf8_general_ci,
  `gelar_belakang3` varchar(6) CHARACTER SET utf8 COLLATE utf8_general_ci,

  `nip` varchar(18) CHARACTER SET utf8 COLLATE utf8_general_ci,
  `nuptk` varchar(16) CHARACTER SET utf8 COLLATE utf8_general_ci,

  `tgl_lahir` date,
  `tmp_lahir` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci,

  `no_ktp` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci,

  `jns_klmn` varchar(1) CHARACTER SET utf8 COLLATE utf8_general_ci,
  `agama` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci,
  `status_kawin` varchar(12) CHARACTER SET utf8 COLLATE utf8_general_ci,

  `nama_ibu` varchar(60) CHARACTER SET utf8 COLLATE utf8_general_ci,
  
  `propinsi_kode` varchar(3) CHARACTER SET utf8 COLLATE utf8_general_ci,
  `kota_kode` varchar(4) CHARACTER SET utf8 COLLATE utf8_general_ci,

  `alamat` varchar(60) CHARACTER SET utf8 COLLATE utf8_general_ci,
  `kelurahan` varchar(60) CHARACTER SET utf8 COLLATE utf8_general_ci,
  `kecamatan` varchar(60) CHARACTER SET utf8 COLLATE utf8_general_ci,
  `kodepos` varchar(6) CHARACTER SET utf8 COLLATE utf8_general_ci,
  `telepon1` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci,
  `telepon2` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci,
  `fax` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci,
  `email` varchar(80) CHARACTER SET utf8 COLLATE utf8_general_ci,
  `website` varchar(80) CHARACTER SET utf8 COLLATE utf8_general_ci,

  `statuskepegawaian` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci,
  `jeniskepegawaian` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci,

  `tmt_pns` date,
  `tmt_pendidik` date,

  `golongan` varchar(5) CHARACTER SET utf8 COLLATE utf8_general_ci,

  `tugaspokok` varchar(60) CHARACTER SET utf8 COLLATE utf8_general_ci,
  `status_guru` varchar(40) CHARACTER SET utf8 COLLATE utf8_general_ci,

  `jabatanpokok` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci,

  `tmt_sekolah` date,
  `tmt_kepalasekolah` date,

  `pendidikan_akhir` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci,
  `ijazah_akhir` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci,
  `jurusan_akhir` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci,
  `tahun_lulus_akhir` int(4),

  `UKA_status` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci,
  `UKA_tahun` int(4),

  `UKG_status` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci,
  `UKG_tahun` int(4),
  
  `sertifikasi_guru` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci,
  `akta_mengajar` varchar(1) CHARACTER SET utf8 COLLATE utf8_general_ci,

  `peningkatan_kompetensi` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci,
    
  `status` varchar(1) CHARACTER SET utf8 COLLATE utf8_general_ci,
  
  `source_id` varchar(5) CHARACTER SET utf8 COLLATE utf8_general_ci,
  `source_name` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci,

  `last_update` datetime,
  `created` datetime NOT NULL,
  `userid` int(11),
  
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

--
-- Table structure for table `ptk_foto` : extracted dari table guru di mysql web lama, masih menggunakan format BLOB storage
--

CREATE TABLE IF NOT EXISTS `ptk_foto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ptkid` int(11),
  `foto_type` varchar(1) CHARACTER SET utf8 COLLATE utf8_general_ci,
  `content_type` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci,
  `foto` blob,

  `last_update` datetime,
  `created` datetime NOT NULL,
  `userid` int(11),

  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

--
-- Table structure for table `ptk_sekolah` : untuk riwayat perubahan sekolah ditambah identitas tahunnya
--

CREATE TABLE IF NOT EXISTS `ptk_sekolah` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ptkid` int(11),
  `sekolahid` int(11),
  `tahun` int(4),
  `keterangan` varchar(60) CHARACTER SET utf8 COLLATE utf8_general_ci,

  `last_update` datetime,
  `created` datetime NOT NULL,
  `userid` int(11),

  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

--
-- Table structure for table `ptk_mmds` mengajar mata diklat disekolah
--

CREATE TABLE IF NOT EXISTS `ptk_mmds` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ptkid` int(11),

  `kel_matapelajaran` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci,
  `kkid` int(11),
  `nama_matapelajaran` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci,
  `kelas` varchar(6) CHARACTER SET utf8 COLLATE utf8_general_ci,
  `tahun_mulai` int(4),
  `tahun_akhir` int(4),

  `last_update` datetime,
  `created` datetime NOT NULL,
  `userid` int(11),

  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

--
-- Table structure for table `ptk_mmdl` : mengajar mata diklat diluar
--

CREATE TABLE IF NOT EXISTS `ptk_mmdl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ptkid` int(11),

  `kel_matapelajaran` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci,
  `kkid` int(11),
  `nama_lembaga` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci,
  `nama_matapelajaran` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci,
  `kelas` varchar(6) CHARACTER SET utf8 COLLATE utf8_general_ci,
  `tahun_mulai` int(4),
  `tahun_akhir` int(4),

  `last_update` datetime,
  `created` datetime NOT NULL,
  `userid` int(11),

  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

--
-- Table structure for table `ptk_rpf` : riwayat pendidikan formal
--

CREATE TABLE IF NOT EXISTS `ptk_rpf` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ptkid` int(11),

  `nama_sekolah` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci,
  `lokasi` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci,
  `fakultas` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci,
  `jurusan` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci,
  `status` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci,
  `tingkat_pendidikan` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci,
  `tahun_lulus` int(4),

  `last_update` datetime,
  `created` datetime NOT NULL,
  `userid` int(11),

  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

--
-- Table structure for table `ptk_rpnf` : riwayat pendidikan non formal
--

CREATE TABLE IF NOT EXISTS `ptk_rpnf` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ptkid` int(11),

  `nama_instansi` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci,
  `lokasi` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci,
  `bidang_studi` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci,
  `tingkat` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci,
  `jml_jam` int(5),
  `tahun_lulus` int(4),

  `last_update` datetime,
  `created` datetime NOT NULL,
  `userid` int(11),

  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

--
-- Table structure for table `ptk_rpp` : riwayat pendidikan dan pelatihan
--

CREATE TABLE IF NOT EXISTS `ptk_rpp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ptkid` int(11),
  `nama_diklat` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci,
  `peran` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci,
  `tahun` int(4),
  `jml_jam` int(5),
  `penyelenggara` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci,
  `tingkat` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci,
  `kompetensi` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci,
  `status` varchar(1) CHARACTER SET utf8 COLLATE utf8_general_ci,

  `last_update` datetime,
  `created` datetime NOT NULL,
  `userid` int(11),

  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

--
-- Table structure for table `ptk_diklatminat` : minat diklat (sumber data import dari MySQL web lama dan xls 2012)
--

CREATE TABLE IF NOT EXISTS `ptk_diklatminat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ptkid` int(11),
  `diklatid` int(11),
  `tahun` int(4),
  `deskripsi` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci,

  `last_update` datetime,
  `created` datetime NOT NULL,
  `userid` int(11),

  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

--
-- Table structure for table `ptk_rjabatan` : riwayat jabatan ( import dari mysql web lama )
--

CREATE TABLE IF NOT EXISTS `ptk_rjabatan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ptkid` int(11),
  
  `jenis` varchar(1) CHARACTER SET utf8 COLLATE utf8_general_ci,
  `jabatan` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci,
  `lembaga` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci,
  `no_sk` varchar(40) CHARACTER SET utf8 COLLATE utf8_general_ci,
  `tahun` int(4),
  `tmp_tugas` varchar(40) CHARACTER SET utf8 COLLATE utf8_general_ci,
  `tmt` date,
  `tmt_akhir` date,

  `last_update` datetime,
  `created` datetime NOT NULL,
  `userid` int(11),

  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

--
-- Table structure for table `ptk_rkarya` : import dari mysql web lama
--

CREATE TABLE IF NOT EXISTS `ptk_rkarya` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ptkid` int(11),
  
  `nama_karya` varchar(80) CHARACTER SET utf8 COLLATE utf8_general_ci,
  `tahun` int(4),
  `keterangan` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci,

  `last_update` datetime,
  `created` datetime NOT NULL,
  `userid` int(11),

  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

--
-- Table structure for table `ptk_rsertifikat` : import dari mysql web lama
--

CREATE TABLE IF NOT EXISTS `ptk_rsertifikat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ptkid` int(11),
  
  `nama_sertifikat` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci,
  `pelaksana` varchar(40) CHARACTER SET utf8 COLLATE utf8_general_ci,
  `status` varchar(1) CHARACTER SET utf8 COLLATE utf8_general_ci,
  `tahun` int(4),

  `last_update` datetime,
  `created` datetime NOT NULL,
  `userid` int(11),

  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;


--
-- Table structure for table `diklat` : adaptasi import dari mysql lama ( revisi penambahan info tahun, linkid, pskid, kkid untuk format katalog baru )
--

CREATE TABLE IF NOT EXISTS `diklat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `departemenid` int(11),
  `tahun` int(4),

  `nama_diklat` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,

  `jml_jam` int(11),
  `tingkat` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci,
  
  `jenis` varchar(1) CHARACTER SET utf8 COLLATE utf8_general_ci,

  `linkid` int(11),
  `pskid` int(11),
  `kkid` int(11),
    
  `prasyarat1` int(11),
  `prasyarat2` int(11),

  `jurusan` varchar(2) CHARACTER SET utf8 COLLATE utf8_general_ci,
  `sumber_dana` varchar(80) CHARACTER SET utf8 COLLATE utf8_general_ci,

  `kompetensi` text,
  `deskripsi` text,
  
  `source_kode` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci,
  `source_id` varchar(5) CHARACTER SET utf8 COLLATE utf8_general_ci,
  `source_name` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci, 

  `last_update` datetime,
  `created` datetime NOT NULL,
  `userid` int(11),

  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;


--
-- Table structure for table `diklat_modul` : baru dari katalog diklat
--

CREATE TABLE IF NOT EXISTS `diklat_modul` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `diklatid` int(11),
  `kode` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `judul_modul` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,

  `last_update` datetime,
  `created` datetime NOT NULL,
  `userid` int(11),

  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;


--
-- Table structure for table `diklat_tingkat` : rujukan tingkat diklat
--

CREATE TABLE IF NOT EXISTS `diklat_tingkat` (
  `diklatid` int(11) NOT NULL,
  `tingkat` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,

  `last_update` datetime,
  `created` datetime NOT NULL,
  `userid` int(11),
  PRIMARY KEY (`diklatid`, `tingkat`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;


--
-- Table structure for table `diklat_jadwal` : event diklat dari katalog diklat yang ada
--

CREATE TABLE IF NOT EXISTS `diklat_jadwal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `diklatid` int(11) NOT NULL,

  `tahun` int(4),
  
  `tgl_mulai` date,
  `tgl_akhir` date,

  `reg_mulai` date,
  `reg_akhir` date,

  `tempat` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci,
  `deskripsi` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci,

  `keterangan` text,

  `last_update` datetime,
  `created` datetime NOT NULL,
  `userid` int(11),

  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

--
-- Table structure for table `diklat_ajuan` : list data ajuan peserta diklat dengan identitas approval 3 orang
--

CREATE TABLE IF NOT EXISTS `diklat_ajuan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jadwalid` int(11) NOT NULL,
  `jenis` varchar(1) CHARACTER SET utf8 COLLATE utf8_general_ci,
  `personid` int(11),
  `instansiid` int(11),
  `tgl_ajuan` datetime,

  `approve1` varchar(1) CHARACTER SET utf8 COLLATE utf8_general_ci,
  `approve2` varchar(1) CHARACTER SET utf8 COLLATE utf8_general_ci,
  `approve3` varchar(1) CHARACTER SET utf8 COLLATE utf8_general_ci,

  `approve1_date` datetime,
  `approve2_date` datetime,
  `approve3_date` datetime,

  `approve1id` int(11),
  `approve2id` int(11),
  `approve3id` int(11),
    
  `keterangan` text,
  `status` varchar(1) CHARACTER SET utf8 COLLATE utf8_general_ci,

  `last_update` datetime,
  `created` datetime NOT NULL,
  `userid` int(11),

  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

--
-- Table structure for table `diklat_peserta` : peserta diklat ( ptk atau staff dari field 'jenis', termasuk 'Cadangan' berdasarkan field 'status'
--

CREATE TABLE IF NOT EXISTS `diklat_peserta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jadwalid` int(11) NOT NULL,
  `jenis` varchar(1) CHARACTER SET utf8 COLLATE utf8_general_ci,
  `personid` int(11),
  `instansiid` int(11),

  `status` varchar(1) CHARACTER SET utf8 COLLATE utf8_general_ci,  
  
  `reg_undang` datetime,
  `reg_ulang` datetime,

  `gantiid` int(11),
  `tgl_ganti` datetime,

  `angkatan` varchar(5) CHARACTER SET utf8 COLLATE utf8_general_ci,  
  `kelas` varchar(5) CHARACTER SET utf8 COLLATE utf8_general_ci,  
  
  `kamarid` int(11),
  `bedid` int(11),

  `status_lulus` varchar(1) CHARACTER SET utf8 COLLATE utf8_general_ci,  
  `no_sertifikat` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci,
  `nilai` varchar(3),
  `catatan_sertifikat` varchar(100),
  
  `keterangan` text,

  `kesan` text,
  `pesan` text,
  
  `last_validate` datetime,
  `last_print` datetime,
  `last_update` datetime,
  `created` datetime NOT NULL,
  `userid` int(11),

  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

--
-- Table structure for table `lembaga` : adaptasi dari table mysql database lama
--

CREATE TABLE IF NOT EXISTS `lembaga` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_lembaga` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,

  `nama_pimpinan` varchar(60) CHARACTER SET utf8 COLLATE utf8_general_ci,
  `nip_pimpinan` varchar(18) CHARACTER SET utf8 COLLATE utf8_general_ci,
  `nuptk_pimpinan` varchar(16) CHARACTER SET utf8 COLLATE utf8_general_ci,
  `telp_pimpinan` varchar(60) CHARACTER SET utf8 COLLATE utf8_general_ci,

  `propinsi_kode` varchar(3) CHARACTER SET utf8 COLLATE utf8_general_ci,
  `kota_kode` varchar(4) CHARACTER SET utf8 COLLATE utf8_general_ci,
  
  `alamat` varchar(60) CHARACTER SET utf8 COLLATE utf8_general_ci,

  `kodepos` varchar(6) CHARACTER SET utf8 COLLATE utf8_general_ci,
  `telepon1` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci,
  `telepon2` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci,
  `fax` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci,
  `email` varchar(60) CHARACTER SET utf8 COLLATE utf8_general_ci,
  `website` varchar(80) CHARACTER SET utf8 COLLATE utf8_general_ci,


  `staffid` int(11),  

  `source_id` varchar(5) CHARACTER SET utf8 COLLATE utf8_general_ci,
  `source_name` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci,
  
  `last_update` datetime,
  `created` datetime NOT NULL,
  `userid` int(11),
  
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;


--
-- Table structure for table `staff` : staf_ajar1(4), staf_ajar2(4), staf_ajar3(4), staf_ajar4(4), staf_jns_lbg,
-- Jenis : 1 : Internal ; 2 : external ( adaptasi dari mysql database lama )
--

CREATE TABLE IF NOT EXISTS `staff` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_lengkap` varchar(60) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,

  `lembagaid` int(11),

  `gelar_depan1` varchar(6) CHARACTER SET utf8 COLLATE utf8_general_ci,
  `gelar_depan2` varchar(6) CHARACTER SET utf8 COLLATE utf8_general_ci,
  `gelar_depan3` varchar(6) CHARACTER SET utf8 COLLATE utf8_general_ci,

  `gelar_belakang1` varchar(6) CHARACTER SET utf8 COLLATE utf8_general_ci,
  `gelar_belakang2` varchar(6) CHARACTER SET utf8 COLLATE utf8_general_ci,
  `gelar_belakang3` varchar(6) CHARACTER SET utf8 COLLATE utf8_general_ci,

  `nip` varchar(18) CHARACTER SET utf8 COLLATE utf8_general_ci,
  `nuptk` varchar(16) CHARACTER SET utf8 COLLATE utf8_general_ci,

  `tgl_lahir` date,
  `tmp_lahir` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci,

  `no_ktp` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci,

  `jns_klmn` varchar(1) CHARACTER SET utf8 COLLATE utf8_general_ci,
  `agama` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci,
  `status_kawin` varchar(12) CHARACTER SET utf8 COLLATE utf8_general_ci,
  `jml_anak` tinyint(2),

  `badan_tinggi` tinyint(2),
  `badan_berat` tinyint(2),
  
  `nama_ibu` varchar(60) CHARACTER SET utf8 COLLATE utf8_general_ci,
  
  `propinsi_kode` varchar(3) CHARACTER SET utf8 COLLATE utf8_general_ci,
  `kota_kode` varchar(4) CHARACTER SET utf8 COLLATE utf8_general_ci,

  `alamat` varchar(60) CHARACTER SET utf8 COLLATE utf8_general_ci,
  `kelurahan` varchar(60) CHARACTER SET utf8 COLLATE utf8_general_ci,
  `kecamatan` varchar(60) CHARACTER SET utf8 COLLATE utf8_general_ci,
  `kodepos` varchar(6) CHARACTER SET utf8 COLLATE utf8_general_ci,
  `telepon1` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci,
  `telepon2` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci,
  `fax` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci,
  `email` varchar(80) CHARACTER SET utf8 COLLATE utf8_general_ci,
  `website` varchar(80) CHARACTER SET utf8 COLLATE utf8_general_ci,

  `jabatan` varchar(40) CHARACTER SET utf8 COLLATE utf8_general_ci,
  `instalasi` varchar(40) CHARACTER SET utf8 COLLATE utf8_general_ci,
  
  `unitkerjaid` int(11),
  
  `golongan` varchar(5) CHARACTER SET utf8 COLLATE utf8_general_ci,
  
  `pendidikan_akhir` varchar(40) CHARACTER SET utf8 COLLATE utf8_general_ci,
  `ijazah` int(11),

  `jurusan` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci,
  `tahun_lulus` tinyint(4),
  `mulai_kerja` date,

  `bidang_ahli` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci,
  `pangkat` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci,
  `jab_intern` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci,
  `jenis` varchar(1) CHARACTER SET utf8 COLLATE utf8_general_ci,
  
  `tmt` date,
  `tmtin` date,

  `status` varchar(1) CHARACTER SET utf8 COLLATE utf8_general_ci,
  
  `source_id` varchar(5) CHARACTER SET utf8 COLLATE utf8_general_ci,
  `source_name` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci,

  `last_update` datetime,
  `created` datetime NOT NULL,
  `userid` int(11),
  
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

--
-- Table structure for table `staff_rdiklat` : adaptasi dari mysql database lama
--

CREATE TABLE IF NOT EXISTS `staff_rdiklat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `staffid` int(11),

  `tingkat` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci,
  `nama_diklat` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci,
  `tempat` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci,
  `sttpl` varchar(1) CHARACTER SET utf8 COLLATE utf8_general_ci,
  `tahun` tinyint(4),

  `last_update` datetime,
  `created` datetime NOT NULL,
  `userid` int(11),

  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

--
-- Table structure for table `staff_rpf` : riwayat pendidikan formal
--

CREATE TABLE IF NOT EXISTS `staff_rpf` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `staffid` int(11),

  `jenjangid` int(11),
  `nama_sekolah` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci,
  `lokasi` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci,
  `jurusan` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci,
  `tahun_lulus` tinyint(4),

  `last_update` datetime,
  `created` datetime NOT NULL,
  `userid` int(11),

  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

--
-- Table structure for table `staff_rpnf` : riwayat pendidikan non formal
--

CREATE TABLE IF NOT EXISTS `staff_rpnf` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `staffid` int(11),

  `nama_pendidikan` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci,
  `pelaksana` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci,
  `lokasi` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci,
  `tahun` tinyint(4),
  `jml_jam` tinyint(3),

  `last_update` datetime,
  `created` datetime NOT NULL,
  `userid` int(11),

  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

--
-- Table structure for table `staff_rjabatan` : jenis : 1 pusat ; 2 : intern
--

CREATE TABLE IF NOT EXISTS `staff_rjabatan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `staffid` int(11),

  `jenis` varchar(1) CHARACTER SET utf8 COLLATE utf8_general_ci,
  `jabatan` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci,
  `lembaga` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci,
  `no_sk` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci,
  `tahun` tinyint(4),
  `tmp_tugas` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci,
  `tmt` date,
  `akhir_tmt` date,

  `last_update` datetime,
  `created` datetime NOT NULL,
  `userid` int(11),

  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

--
-- Table structure for table `staff_rkarya` : riwayat karya
--

CREATE TABLE IF NOT EXISTS `staff_rkarya` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `staffid` int(11),

  `nss` varchar(13) CHARACTER SET utf8 COLLATE utf8_general_ci,
  `nip` varchar(18) CHARACTER SET utf8 COLLATE utf8_general_ci,
  `nama_karya` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci,
  `tahun` tinyint(4),
  `keterangan` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci,

  `last_update` datetime,
  `created` datetime NOT NULL,
  `userid` int(11),

  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

--
-- Table structure for table `staff_rsertifikat` : riwayat sertifikat
--

CREATE TABLE IF NOT EXISTS `staff_rsertifikat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `staffid` int(11),

  `nss` varchar(13) CHARACTER SET utf8 COLLATE utf8_general_ci,
  `nip` varchar(18) CHARACTER SET utf8 COLLATE utf8_general_ci,
  `nama_sertifikat` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci,
  `pelaksana` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci,
  `status` varchar(1) CHARACTER SET utf8 COLLATE utf8_general_ci,
  `tahun` tinyint(4),

  `last_update` datetime,
  `created` datetime NOT NULL,
  `userid` int(11),

  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
