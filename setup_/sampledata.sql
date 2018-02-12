-- ================================================================
--
-- @version $Id: structure.sql 2011-05-25 10:12:05 gewa $
-- @package SIM P4TK BMTI
-- @copyright 2012.
--
-- ================================================================
-- Database data
-- ================================================================

INSERT INTO `settings` (`company`, `site_url`, `site_email`, `address`, `city`, `state`, `postcode`, `phone`, `fax`, `logo`, `short_date`, `long_date`, `enable_reg`, `enable_offline`, `offline_info`, `enable_uploads`, `file_types`, `file_max`, `perpage`, `mailer`, `smtp_host`, `smtp_user`, `smtp_pass`, `smtp_port`, `is_ssl`, `ver_info`) VALUES
('P4TK BMTI Bandung', 'www.tedcbandung.com', 'a2ngsa@gmail.com', 'Jl. Pesantren. Cimahi', 'Bandung', 'Jawa Barat', '201...', '555-555-5555', '444-444-4444', 'logo.png', '%b %d %Y', '%d %B %Y %H:%M', 1, 1, 'Maaf situs sedang offline!', 1, 'gif,png,jpg,jpeg,pdf,zip,rar', '10485760', '10', 'SMTP', 'smtp.tedcbandung.com', '', '', 25, 'F', '1.0');


-- ================================================================
-- user_profiles
-- ================================================================

INSERT INTO user_profiles
 VALUES (1, 'Administrator', 'A', 1024, 1024, NOW(), NOW());

INSERT INTO user_profiles
 VALUES (2, 'PTK', 'P', 1024, 1024, NOW(), NOW());

--
-- users
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `profileid`, `ptkid`, `last_update`, `created`, `lastlogin`, `lastip`, `active`) VALUES
(1, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'admin@p4tkbmtibandung.com', 1, NULL, NOW(), NOW(), NULL,  '127.0.0.1', 'y');

--
-- rujukan
--

INSERT INTO kualifikasi_geografis
 VALUES (1, 'Terpencil', NOW(), NOW(), 1);

INSERT INTO kualifikasi_geografis
 VALUES (2, 'Perkotaan', NOW(), NOW(), 1);

INSERT INTO kualifikasi_geografis
 VALUES (3, 'Pedesaan', NOW(), NOW(), 1);

INSERT INTO kualifikasi_geografis
 VALUES (4, 'Daerah Perbatasan', NOW(), NOW(), 1);

INSERT INTO kualifikasi_geografis
 VALUES (5, 'Daerah Sulit', NOW(), NOW(), 1);

--
-- rujukan : sekolah_tingkat
--
  
INSERT INTO sekolah_tingkat
 VALUES (null, 'TK', NOW(), NOW(), 1);

INSERT INTO sekolah_tingkat
 VALUES (null, 'SD', NOW(), NOW(), 1);

INSERT INTO sekolah_tingkat
 VALUES (null, 'SMP', NOW(), NOW(), 1);

INSERT INTO sekolah_tingkat
 VALUES (null, 'SLB', NOW(), NOW(), 1);

INSERT INTO sekolah_tingkat
 VALUES (null, 'SMA', NOW(), NOW(), 1);

INSERT INTO sekolah_tingkat
 VALUES (null, 'SMK', NOW(), NOW(), 1);

INSERT INTO sekolah_tingkat
 VALUES (null, 'RA', NOW(), NOW(), 1);

INSERT INTO sekolah_tingkat
 VALUES (null, 'MI', NOW(), NOW(), 1);

INSERT INTO sekolah_tingkat
 VALUES (null, 'MTs', NOW(), NOW(), 1);

INSERT INTO sekolah_tingkat
 VALUES (null, 'MA', NOW(), NOW(), 1);
 
--
-- rujukan : sekolah_jenis
--

INSERT INTO sekolah_jenis
 VALUES (1, 'Sekolah', NOW(), NOW(), 1);

INSERT INTO sekolah_jenis
 VALUES (2, 'Madrasah', NOW(), NOW(), 1);

INSERT INTO sekolah_jenis
 VALUES (3, 'Kantor Kecamatan', NOW(), NOW(), 1);

INSERT INTO sekolah_jenis
 VALUES (4, 'Kantor Dinas Kab./Kota', NOW(), NOW(), 1);

INSERT INTO sekolah_jenis
 VALUES (5, 'Pusat Khusus', NOW(), NOW(), 1);

INSERT INTO sekolah_jenis
 VALUES (6, 'Taman Bermain', NOW(), NOW(), 1);

INSERT INTO sekolah_jenis
 VALUES (7, 'Kantor Dinas Propinsi', NOW(), NOW(), 1);

INSERT INTO sekolah_jenis
 VALUES (8, 'SKB', NOW(), NOW(), 1);
 
--
-- rujukan : sekolah_skepemilikan
--

INSERT INTO sekolah_skepemilikan
 VALUES (null, 'Pemerintah Pusat', NOW(), NOW(), 1);

INSERT INTO sekolah_skepemilikan
 VALUES (null, 'Pemerintah Daerah', NOW(), NOW(), 1);

INSERT INTO sekolah_skepemilikan
 VALUES (null, 'Yayasan', NOW(), NOW(), 1);

INSERT INTO sekolah_skepemilikan
 VALUES (null, 'Lembaga', NOW(), NOW(), 1);

--
-- rujukan : sekolah_status
--

INSERT INTO sekolah_status
 VALUES (null, 'Yayasan', NOW(), NOW(), 1);

INSERT INTO sekolah_status
 VALUES (null, 'Negeri', NOW(), NOW(), 1);

INSERT INTO sekolah_status
 VALUES (null, 'Lembaga', NOW(), NOW(), 1);

INSERT INTO sekolah_status
 VALUES (null, 'Swasta', NOW(), NOW(), 1);

--
-- rujukan : bsk -> psk -> kk
--
  
INSERT INTO bsk 
         VALUES (1, '001', 'Teknologi dan Rekayasa', '1', 'xls', now(), '2012-06-27 13:17:54', 1);
INSERT INTO bsk 
         VALUES (2, '002', 'Teknologi Informasi dan Komunikasi', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO bsk 
         VALUES (3, '003', 'Kesehatan', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO bsk 
         VALUES (4, '004', 'Seni, Kerajinan dan Pariwisata', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO bsk 
         VALUES (5, '005', 'Agribisnis dan Argoindustri', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO bsk 
         VALUES (6, '006', 'Bisnis dan Manajemen', '1', 'xls', now(), '2012-06-27 13:18:02', 1);


INSERT INTO psk
         VALUES (101, 1, '101', 'Teknik Bangunan', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO psk
         VALUES (102, 1, '102', 'Teknik Plumbing dan Sanitasi', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO psk
         VALUES (103, 1, '103', 'Teknik Survei dan Pemetaan', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO psk
         VALUES (104, 1, '104', 'Teknik Ketenagalistrikan', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO psk
         VALUES (105, 1, '105', 'Teknik Pendingin dan Tata Udara', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO psk
         VALUES (106, 1, '106', 'Teknik Mesin', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO psk
         VALUES (107, 1, '107', 'Teknik Otomotif', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO psk
         VALUES (108, 1, '108', 'Teknologi Pesawat Udara', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO psk
         VALUES (109, 1, '109', 'Teknik Perkapalan', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO psk
         VALUES (110, 1, '110', 'Teknologi Tekstil', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO psk
         VALUES (111, 1, '111', 'Teknik Grafika', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO psk
         VALUES (112, 1, '112', 'Geologi Pertambangan', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO psk
         VALUES (113, 1, '113', 'Instrumentasi Industri', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO psk
         VALUES (114, 1, '114', 'Teknik Kimia', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO psk
         VALUES (115, 1, '115', 'Pelayaran', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO psk
         VALUES (116, 1, '116', 'Teknik Industri', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO psk
         VALUES (117, 1, '117', 'Teknik Perminyakan', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO psk
         VALUES (118, 1, '118', 'Teknik Elektronika', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO psk
         VALUES (201, 2, '201', 'Teknik Telekomunikasi', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO psk
         VALUES (202, 2, '202', 'Teknik Komputer dan Informatika', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO psk
         VALUES (203, 2, '203', 'Teknik Broadcasting', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO psk
         VALUES (301, 3, '301', 'Kesehatan', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO psk
         VALUES (302, 3, '302', 'Perawatan Sosial', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO psk
         VALUES (401, 4, '401', 'Seni Rupa', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO psk
         VALUES (402, 4, '402', 'Desain dan Produksi Kria', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO psk
         VALUES (403, 4, '403', 'Seni Pertunjukan', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO psk
         VALUES (404, 4, '404', 'Pariwisata', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO psk
         VALUES (405, 4, '405', 'Tata boga', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO psk
         VALUES (406, 4, '406', 'Tata Kecantikan', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO psk
         VALUES (407, 4, '407', 'Tata Busana', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO psk
         VALUES (501, 5, '501', 'Agribisnis Produksi Tanaman', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO psk
         VALUES (502, 5, '502', 'Agribisnis Produksi Ternak', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO psk
         VALUES (503, 5, '503', 'Agribisnis Produksi Sumberdaya Perairan', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO psk
         VALUES (504, 5, '504', 'Agribisnis Hasil Pertanian', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO psk
         VALUES (505, 5, '505', 'Penyuluhan Pertanian', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO psk
         VALUES (506, 5, '506', 'Kehutanan', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO psk
         VALUES (507, 5, '507', 'Kehutanan', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO psk
         VALUES (601, 6, '601', 'Administrasi', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO psk
         VALUES (602, 6, '602', 'Keuangan', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO psk
         VALUES (603, 6, '603', 'Tata Niaga', '1', 'xls', now(), '2012-06-27 13:18:02', 1);


INSERT INTO kk
        VALUES (1011, 101, null, '1011', 'Teknik Konstruksi Baja', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO kk
        VALUES (1012, 101, null, '1012', 'Teknik Konstruksi Kayu', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO kk
        VALUES (1013, 101, null, '1013', 'Teknik Konstruksi Batu dan Beton', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO kk
        VALUES (1014, 101, null, '1014', 'Teknik Gambar Bangunan', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO kk
        VALUES (1015, 101, null, '1015', 'Teknik Furnitur', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO kk
        VALUES (1021, 102, null, '1021', 'Teknik Plumbing dan Sanitasi', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO kk
        VALUES (1031, 103, null, '1031', 'Teknik Survei dan Pemetaan', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO kk
        VALUES (1041, 104, null, '1041', 'Teknik Pembangkit Tenaga Listrik', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO kk
        VALUES (1042, 104, null, '1042', 'Teknik Distribusi Tenaga Listrik', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO kk
        VALUES (1043, 104, null, '1043', 'Teknik Transmisi Tenaga Listrik', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO kk
        VALUES (1044, 104, null, '1044', 'Teknik Instalasi Tenaga Listrik', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO kk
        VALUES (1045, 104, null, '1045', 'Teknik Otomasi Industri', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO kk
        VALUES (1051, 105, null, '1051', 'Teknik Pendingin dan Tata Udara', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO kk
        VALUES (1061, 106, null, '1061', 'Teknik Pemesinan', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO kk
        VALUES (1062, 106, null, '1062', 'Teknik Pengelasan', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO kk
        VALUES (1063, 106, null, '1063', 'Teknik Fabrikasi Logam', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO kk
        VALUES (1064, 106, null, '1064', 'Teknik Pengecoran Logam', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO kk
        VALUES (1065, 106, null, '1065', 'Teknik Gambar Mesin', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO kk
        VALUES (1066, 106, null, '1066', 'Teknik Pemeliharaan Mekanik dan Industri', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO kk
        VALUES (1071, 107, null, '1071', 'Teknik Kendaraan ringan', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO kk
        VALUES (1072, 107, null, '1072', 'Teknik Sepeda Motor', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO kk
        VALUES (1073, 107, null, '1073', 'Teknik Perbaikan Body Otomotif', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO kk
        VALUES (1074, 107, null, '1074', 'Teknik Alat Berat', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO kk
        VALUES (1075, 107, null, '1075', 'Teknik Ototronik', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO kk
        VALUES (1081, 108, null, '1081', 'Air Frame dan Power Plant', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO kk
        VALUES (1082, 108, null, '1082', 'Pemesinan Pesawat Udara', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO kk
        VALUES (1083, 108, null, '1083', 'Konstruksi Badan Pesawat Udara', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO kk
        VALUES (1084, 108, null, '1084', 'Konstruksi Rangka Pesawat Udara', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO kk
        VALUES (1085, 108, null, '1085', 'Kelistrikan Pesawat Udara', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO kk
        VALUES (1086, 108, null, '1086', 'Elektronika Pesawat Udara', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO kk
        VALUES (1087, 108, null, '1087', 'Pemeliharaan dan Perbaikan Instrumen Elektronika', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO kk
        VALUES (1091, 109, null, '1091', 'Teknik Konstruksi Kapal Baja', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO kk
        VALUES (1092, 109, null, '1092', 'Teknik Konstruksi Kapal Kayu', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO kk
        VALUES (1093, 109, null, '1093', 'Teknik Konstruksi Kapal Fiberglass', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO kk
        VALUES (1094, 109, null, '1094', 'Teknik Instalasi Pemesinan Kapal', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO kk
        VALUES (1095, 109, null, '1095', 'Teknik Pengelasan Kapal', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO kk
        VALUES (1096, 109, null, '1096', 'Kelistrikan Kapal', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO kk
        VALUES (1097, 109, null, '1097', 'Teknik Gambar Rancang Bangun Kapal', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO kk
        VALUES (1098, 109, null, '1098', 'Interior Kapal', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO kk
        VALUES (1101, 110, null, '1101', 'Teknik Pemintalan Serat Buatan', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO kk
        VALUES (1102, 110, null, '1102', 'Teknik Pembuatan Benang', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO kk
        VALUES (1103, 110, null, '1103', 'Teknik Pembuatan Kain', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO kk
        VALUES (1104, 110, null, '1104', 'Teknik Penyempurnaan Tekstil', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO kk
        VALUES (1105, 110, null, '1105', 'Garmen', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO kk
        VALUES (1111, 111, null, '1111', 'Persiapan Grafika', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO kk
        VALUES (1112, 111, null, '1112', 'Produksi Grafika', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO kk
        VALUES (1121, 112, null, '1121', 'Geologi Pertambangan', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO kk
        VALUES (1131, 113, null, '1131', 'Teknik Instrumentasi Gelas', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO kk
        VALUES (1132, 113, null, '1132', 'Teknik Instrumentasi Logam', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO kk
        VALUES (1133, 113, null, '1133', 'Kontrol Proses', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO kk
        VALUES (1134, 113, null, '1134', 'Kontrol Mekanik', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO kk
        VALUES (1141, 114, null, '1141', 'Kimia Analisis', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO kk
        VALUES (1142, 114, null, '1142', 'Kimia Industri', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO kk
        VALUES (1151, 115, null, '1151', 'Neutika Kapal Penangkap Ikan', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO kk
        VALUES (1152, 115, null, '1152', 'Teknika Kapal Penangkap Ikan', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO kk
        VALUES (1153, 115, null, '1153', 'Neutika Kapal Niaga', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO kk
        VALUES (1154, 115, null, '1154', 'Teknika Kapal Niaga', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO kk
        VALUES (1161, 116, null, '1161', 'Teknik dan Manajemen Produksi', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO kk
        VALUES (1162, 116, null, '1162', 'Teknik dan Manajemen Pergudangan', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO kk
        VALUES (1163, 116, null, '1163', 'Teknik dan Manajemen Transportasi', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO kk
        VALUES (1171, 117, null, '1171', 'Teknik Produksi Perminyakan', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO kk
        VALUES (1172, 117, null, '1172', 'Teknik Pemboran Minyak', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO kk
        VALUES (1173, 117, null, '1173', 'Teknik Pengolahan Minyak, Gas dan Petro Kimia', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO kk
        VALUES (1181, 118, null, '1181', 'Teknik Audio-Video', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO kk
        VALUES (1182, 118, null, '1182', 'Teknik Elektronika Industri', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO kk
        VALUES (1183, 118, null, '1183', 'Teknik Mekatronika', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO kk
        VALUES (2011, 201, null, '2011', 'Teknik Transmisi Telekomunikasi', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO kk
        VALUES (2012, 201, null, '2012', 'Teknik Suitsing', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO kk
        VALUES (2013, 201, null, '2013', 'Teknik Jaringan Akses', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO kk
        VALUES (2021, 202, null, '2021', 'Rekayasa Perangkat Lunak', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO kk
        VALUES (2022, 202, null, '2022', 'Teknik Komputer dan Jaringan', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO kk
        VALUES (2023, 202, null, '2023', 'Multi Media', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO kk
        VALUES (2024, 202, null, '2024', 'Animasi', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO kk
        VALUES (2031, 203, null, '2031', 'Teknik Produksi dan Penyiaran Program Pertelevisian', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO kk
        VALUES (2032, 203, null, '2032', 'Teknik Produksi dan Penyiaran Program Radio', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO kk
        VALUES (3011, 301, null, '3011', 'Perawat Kesehatan', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO kk
        VALUES (3012, 301, null, '3012', 'Perawat Gigi', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO kk
        VALUES (3013, 301, null, '3013', 'Analisis Kesehatan', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO kk
        VALUES (3014, 301, null, '3014', 'Farmasi', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO kk
        VALUES (3015, 301, null, '3015', 'Farmasi Industri', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO kk
        VALUES (3021, 302, null, '3021', 'Perawatan Sosial', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO kk
        VALUES (4011, 401, null, '4011', 'Seni Lukis', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO kk
        VALUES (4012, 401, null, '4012', 'Seni Patung', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO kk
        VALUES (4013, 401, null, '4013', 'Desain Komunikasi Visual', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO kk
        VALUES (4014, 401, null, '4014', 'Desain Produksi Interior dan Landscaping', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO kk
        VALUES (4021, 402, null, '4021', 'Desain dan Produksi Kria Tekstil', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO kk
        VALUES (4022, 402, null, '4022', 'Desain dan Produksi Kria Kulit', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO kk
        VALUES (4023, 402, null, '4023', 'Desain dan Produksi Kria Keramik', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO kk
        VALUES (4024, 402, null, '4024', 'Desain dan Produksi Kria Logam', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO kk
        VALUES (4025, 402, null, '4025', 'Desain dan Produksi Kria Kayu', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO kk
        VALUES (4031, 403, null, '4031', 'Seni Musik Klasik', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO kk
        VALUES (4032, 403, null, '4032', 'Seni Musik Non Klasik', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO kk
        VALUES (4033, 403, null, '4033', 'Seni Tari', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO kk
        VALUES (4034, 403, null, '4034', 'Seni  Karawitan', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO kk
        VALUES (4035, 403, null, '4035', 'Seni  Padalangan', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO kk
        VALUES (4036, 403, null, '4036', 'Seni  Teater', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO kk
        VALUES (4041, 404, null, '4041', 'Usaha Perjalanan Wisata', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO kk
        VALUES (4042, 404, null, '4042', 'Akomodasi Perhotelan', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO kk
        VALUES (4051, 405, null, '4051', 'Jasa Boga', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO kk
        VALUES (4052, 405, null, '4052', 'Patiseri', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO kk
        VALUES (4061, 406, null, '4061', 'Kecantikan Kulit', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO kk
        VALUES (4062, 406, null, '4062', 'Kecantikan Rambut', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO kk
        VALUES (4071, 407, null, '4071', 'Busana Butik', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO kk
        VALUES (5011, 501, null, '5011', 'Agribisnis Tanaman Pangan dan Holtikultura', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO kk
        VALUES (5012, 501, null, '5012', 'Agribisnis Tanaman Perkebunan', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO kk
        VALUES (5013, 501, null, '5013', 'Agribisnis Pembibitan dan Kultur Jaringan Tanaman', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO kk
        VALUES (5021, 502, null, '5021', 'Agribisnis Ternak Ruminansia', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO kk
        VALUES (5022, 502, null, '5022', 'Agribisnis Ternak Unggas', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO kk
        VALUES (5023, 502, null, '5023', 'Agribisnis Aneka Ternak', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO kk
        VALUES (5024, 502, null, '5024', 'Perawatan Kesehatan Ternak', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO kk
        VALUES (5031, 503, null, '5031', 'Agribisnis Perikanan', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO kk
        VALUES (5032, 503, null, '5032', 'Agribisnis Rumput Laut', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO kk
        VALUES (5041, 504, null, '5041', 'Mekanisasi Pertanian', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO kk
        VALUES (5051, 505, null, '5051', 'Teknologi Pengolahan Hasil Pertanian', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO kk
        VALUES (5052, 505, null, '5052', 'Pengawasan Mutu', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO kk
        VALUES (5061, 506, null, '5061', 'Penyuluhan Pertanian', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO kk
        VALUES (5071, 507, null, '5071', 'Kehutanan', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO kk
        VALUES (6011, 601, null, '6011', 'Administrasi Perkantoran', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO kk
        VALUES (6021, 602, null, '6021', 'Akuntansi', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO kk
        VALUES (6022, 602, null, '6022', 'Perbankan', '1', 'xls', now(), '2012-06-27 13:18:02', 1);
INSERT INTO kk
        VALUES (6031, 603, null, '6031', 'Pemasaran', '1', 'xls', now(), '2012-06-27 13:18:02', 1);

--
-- rujukan : diklat_tingkat
--

INSERT INTO diklat_tingkat VALUES
(1, 'Non Jenjang', NOW(), NOW(), 1),
(2, 'Dasar', NOW(), NOW(), 1),
(3, 'Lanjut', NOW(), NOW(), 1),
(4, 'Menengah', NOW(), NOW(), 1),
(5, 'Tinggi', NOW(), NOW(), 1);

--
-- rujukan : kel_matapelajaran
--

INSERT INTO kel_matapelajaran VALUES
(1, 'ADAPTIF', NOW(), NOW(), 1),
(2, 'NORMATIF', NOW(), NOW(), 1),
(3, 'PRODUKTIF', NOW(), NOW(), 1),
(4, 'MUATAN LOKAL', NOW(), NOW(), 1);

--
-- rujukan : matapelajaran
--

INSERT INTO matapelajaran VALUES
(1, 1,'Kewirausahaan', NOW(), NOW(), 1),
(2, 1,'Fisika', NOW(), NOW(), 1),
(3, 1,'Kimia', NOW(), NOW(), 1),
(4, 1,'Biologi', NOW(), NOW(), 1),
(5, 1,'Ekonomi', NOW(), NOW(), 1),
(6, 1,'Pelayanan Prima', NOW(), NOW(), 1),
(7, 1,'IPS', NOW(), NOW(), 1),
(8, 1,'IPA', NOW(), NOW(), 1),
(9, 1,'KKPI', NOW(), NOW(), 1),
(10, 1,'Matematika', NOW(), NOW(), 1),
(11, 1,'Bahasa Inggris', NOW(), NOW(), 1),
(12, 2,'Seni & Budaya', NOW(), NOW(), 1),
(13, 2,'BK/BP', NOW(), NOW(), 1),
(14, 2,'Pendidikan Jasmani & Olahraga', NOW(), NOW(), 1),
(15, 2,'Pendidikan Kewarganegaraan & Sejarah', NOW(), NOW(), 1),
(16, 2,'Pendidikan Agama Kristen Protestan', NOW(), NOW(), 1),
(17, 2,'Pendidikan Agama Islam', NOW(), NOW(), 1),
(18, 2,'Pendidikan Agama Kristen Katolik', NOW(), NOW(), 1),
(19, 2,'Pendidikan Agama Hindu', NOW(), NOW(), 1),
(20, 2,'Pendidikan Agama Konghuchu', NOW(), NOW(), 1),
(21, 2,'Pendidikan Agama Budha', NOW(), NOW(), 1),
(22, 2,'Bahasa Indonesia', NOW(), NOW(), 1);

