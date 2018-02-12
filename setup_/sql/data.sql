
--
-- Dumping data for table `project_types`
--

INSERT INTO `sekolahjenis` (`id`, `nama_jenis`) VALUES
(1, 'Sekolah'),
(2, 'Madrasah'),
(3, 'Kantor Kecamatan'),
(4, 'Kantor Dinas Kab/Kota'),
(5, 'Kantor Dinas Propinsi'),
(6, 'Pusat Kursus'),
(7, 'Taman Bermain'),
(8, 'SKB');


INSERT INTO `sekolahbkeahlian` (`id`, `nama_bkeahlian`) VALUES
(1, 'Teknologi dan Rekayasa'),
(2, 'Teknologi Informasi dan Komunikasi'),
(3, 'Kesehatan'),
(4, 'Seni, Kerajinan dan Pariwisata'),
(5, 'Agribisnis dan Argoindustri'),
(6, 'Bisnis dan Manajemen');


INSERT INTO `diklatmata` (`id`, `nama_mata`) VALUES
(1, 'Teknologi Informasi'),
(2, 'Manajemen Bisnis');

INSERT INTO  `gelar` (`id`, `nama_gelar`, `mode`) VALUES
(1, 'Drs', 'D'),
(2, 'Dr', 'D'),
(3, 'MSi', 'B'),
(4, 'SPd', 'B');

INSERT INTO  `departemen` (`id`, `nama_departemen`, `nama_pimpinan`, `description`) VALUES
(1, 'Departement 1', 'Mr. One', ''),
(2, 'Departement 2', 'Mr. Two', 'test 2');


INSERT INTO propinsi VALUES("1", "DKI JAKARTA", "0");
INSERT INTO propinsi VALUES("2", "JAWA BARAT", "0");
INSERT INTO propinsi VALUES("3", "JAWA TENGAH", "0");
INSERT INTO propinsi VALUES("4", "DI YOGYAKARTA", "0");
INSERT INTO propinsi VALUES("5", "JAWA TIMUR", "0");
INSERT INTO propinsi VALUES("6", "NANGGROE ACEH DARUSSALAM", "0");
INSERT INTO propinsi VALUES("7", "SUMATERA UTARA", "0");
INSERT INTO propinsi VALUES("8", "SUMATERA BARAT", "0");
INSERT INTO propinsi VALUES("9", "R I A U", "0");
INSERT INTO propinsi VALUES("10", "J A M B I", "0");
INSERT INTO propinsi VALUES("11", "SUMATERA SELATAN", "0");
INSERT INTO propinsi VALUES("12", "LAMPUNG", "1");
INSERT INTO propinsi VALUES("13", "KALIMANTAN BARAT", "0");
INSERT INTO propinsi VALUES("14", "KALIMANTAN TENGAH", "0");
INSERT INTO propinsi VALUES("15", "KALIMANTAN SELATAN", "0");
INSERT INTO propinsi VALUES("16", "KALIMANTAN TIMUR", "0");
INSERT INTO propinsi VALUES("17", "SULAWESI UTARA", "0");
INSERT INTO propinsi VALUES("18", "SULAWESI TENGAH", "0");
INSERT INTO propinsi VALUES("19", "SULAWESI SELATAN", "0");
INSERT INTO propinsi VALUES("20", "SULAWESI TENGGARA", "0");
INSERT INTO propinsi VALUES("21", "MALUKU", "0");
INSERT INTO propinsi VALUES("22", "B A L I", "0");
INSERT INTO propinsi VALUES("23", "NUSA TENGGARA BARAT", "0");
INSERT INTO propinsi VALUES("24", "NUSA TENGGARA TIMUR", "0");
INSERT INTO propinsi VALUES("25", "PAPUA", "0");
INSERT INTO propinsi VALUES("26", "BENGKULU", "0");
INSERT INTO propinsi VALUES("27", "MALUKU UTARA", "0");
INSERT INTO propinsi VALUES("28", "BANTEN", "0");
INSERT INTO propinsi VALUES("29", "BANGKA BELITUNG", "0");
INSERT INTO propinsi VALUES("30", "GORONTALO", "0");
INSERT INTO propinsi VALUES("31", "SULAWESI BARAT", "0");
INSERT INTO propinsi VALUES("32", "IRIAN JAYA BARAT", "0");
INSERT INTO propinsi VALUES("33", "KEPULAUAN RIAU", "0");


INSERT INTO statuskepegawaian VALUES("PNS", 0);
INSERT INTO statuskepegawaian VALUES("PNS DPK", 0);
INSERT INTO statuskepegawaian VALUES("PNS DEPAG", 0);
INSERT INTO statuskepegawaian VALUES("GTY", 0);
INSERT INTO statuskepegawaian VALUES("GTT", 0);
INSERT INTO statuskepegawaian VALUES("GTT PNS", 0);
INSERT INTO statuskepegawaian VALUES("PTT", 0);
INSERT INTO statuskepegawaian VALUES("GURU BINA", 0);
INSERT INTO statuskepegawaian VALUES("GURU BANTU", 0);
INSERT INTO statuskepegawaian VALUES("GURU", 0);

INSERT INTO tugaspokok VALUES(null, "Pendidik/Guru", 0);
INSERT INTO tugaspokok VALUES(null, "Tenaga Kependidikan Formal", 0);
INSERT INTO tugaspokok VALUES(null, "Pendidik dan Tenaga Kependidikan Non Formal", 0);

INSERT INTO jabatanpokok VALUES(null, "Kepala Sekolah", 0);
INSERT INTO jabatanpokok VALUES(null, "Kepala TU", 0);
INSERT INTO jabatanpokok VALUES(null, "Bendahara", 0);
INSERT INTO jabatanpokok VALUES(null, "Pustakawan", 0);
INSERT INTO jabatanpokok VALUES(null, "Juru Bengkel", 0);
INSERT INTO jabatanpokok VALUES(null, "Pengawas Sekolah", 0);
INSERT INTO jabatanpokok VALUES(null, "Wakil Kepala Sekolah", 0);
INSERT INTO jabatanpokok VALUES(null, "Staf Administrasi TU", 0);
INSERT INTO jabatanpokok VALUES(null, "Laboran", 0);
INSERT INTO jabatanpokok VALUES(null, "Petugas Instalasi", 0);
INSERT INTO jabatanpokok VALUES(null, "Pesuruh/Penjaga Sekolah", 0);

INSERT INTO jenjangsekolah VALUES(null, "TK", 0);
INSERT INTO jenjangsekolah VALUES(null, "SD", 0);
INSERT INTO jenjangsekolah VALUES(null, "MI", 0);
INSERT INTO jenjangsekolah VALUES(null, "SLTP", 0);
INSERT INTO jenjangsekolah VALUES(null, "MTS", 0);
INSERT INTO jenjangsekolah VALUES(null, "SLTP Terbuka", 0);
INSERT INTO jenjangsekolah VALUES(null, "SLTA", 0);
INSERT INTO jenjangsekolah VALUES(null, "MAN", 0);
INSERT INTO jenjangsekolah VALUES(null, "SMK (STM)", 0);
INSERT INTO jenjangsekolah VALUES(null, "SMK (SMKK)", 0);
INSERT INTO jenjangsekolah VALUES(null, "SMK (SMEA)", 0);
INSERT INTO jenjangsekolah VALUES(null, "SMK", 0);
INSERT INTO jenjangsekolah VALUES(null, "D1", 0);
INSERT INTO jenjangsekolah VALUES(null, "D2", 0);
INSERT INTO jenjangsekolah VALUES(null, "D3", 0);
INSERT INTO jenjangsekolah VALUES(null, "D4", 0);
INSERT INTO jenjangsekolah VALUES(null, "S1", 0);
INSERT INTO jenjangsekolah VALUES(null, "S2", 0);
INSERT INTO jenjangsekolah VALUES(null, "S3", 0);





