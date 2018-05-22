<?php
  /**
   * Controller
   *
   * @package SIM PPPPTK BMTI
   * @author a2ngsa
   * @copyright 2012
   * @version $Id: controller_report.php, v1.00 2011-06-05 10:12:05 gewa Exp $
   */
  define("_VALID_PHP", true);
  
  require_once("init.php");
  if (!$user->is_Admin())
      : die("<div style='text-align:center;margin-top:20px'>" 
      . "<span style='padding: 10px; border: 1px solid #999; background-color:#EFEFEF;" 
      . "font-family: Verdana; font-size: 12px; margin-left:auto; margin-right:auto;color:red'>" 
      . "<b>Warning:</b> Anda tidak dapat mengakses halaman ini !</span></div>");
  endif;
  
?>

<?php
  /* == Create Sekolah Report == */
  if (isset($_GET['action']) and $_GET['action'] == "createReportSekolah"):

        if(isset($_GET['propinsi_kode']))
            $propinsi_kode = $_GET['propinsi_kode'];
        else
            $propinsi_kode = '';

        if(isset($_GET['kota_kode']))
            $kota_kode = $_GET['kota_kode'];
        else
            $kota_kode = '';

        if(isset($_GET['searchfield']))
            $searchfield = $_GET['searchfield'];
        else
            $searchfield = 'nama';

        if(isset($_GET['searchtext']))
            $searchtext = $_GET['searchtext'];
        else
            $searchtext = '';
      
	ob_end_clean();  
	
	ob_start();
                
        if ($propinsi_kode != '') {
              if ($kota_kode != '') {
                    $sqlwhere = "WHERE s.propinsi_kode = '" . $propinsi_kode . "' AND s.kota_kode = '" . $kota_kode ."'";
                      
                    if (($searchtext != '') && ($searchfield != ''))
                        $sqlwhere .= " AND LOWER(s." . $searchfield .") LIKE '%". $searchtext ."%'";
              } else {
                      $sqlwhere = "WHERE s.propinsi_kode = '" . $propinsi_kode . "'";
                      
                      if (($searchtext != '') && ($searchfield != ''))
                          $sqlwhere .= " AND LOWER(s." . $searchfield .") LIKE '%". $searchtext ."%'";
              }
        } else {
              if ($kota_kode != '') {
                      $sqlwhere = "WHERE s.kota_kode = '" . $kota_kode . "'";
                      
                      if (($searchtext != '') && ($searchfield != ''))
                          $sqlwhere .= " AND LOWER(s." . $searchfield .") LIKE '%". $searchtext ."%'";
                      
              } else {

                      if (($searchtext != '') && ($searchfield != ''))
                        $sqlwhere = "WHERE LOWER(s." . $searchfield .") LIKE '%". $searchtext ."%'";
                      else
                        $sqlwhere = "";
              }
        }
        
	$sql = "SELECT s.id, s.nss, s.nama_sekolah, s.propinsi_kode, s.kota_kode, s.jenisid, s.source_id," 
		  . "\n sj.nama_jenis," 
		  . "\n p.nama_propinsi," 
		  . "\n k.nama_kota" 
		  . "\n FROM ((sekolah as s" 
		  . "\n LEFT JOIN sekolah_jenis as sj ON s.jenisid = sj.id)" 
		  . "\n LEFT JOIN propinsi as p ON s.propinsi_kode = p.kode)" 
		  . "\n LEFT JOIN kota as k ON s.kota_kode = k.kode" 
		  . "\n $sqlwhere" 
		  . "\n ORDER BY s.nama_sekolah";
	  
	$result = $db->fetch_all($sql);
	  	 
	require_once(BASEPATH . 'lib/PHPExcel.php');
		
	// Create new PHPExcel object
	$objPHPExcel = new PHPExcel();

	// Set document properties
	$objPHPExcel->getProperties()->setCreator($core->company)
                                    ->setLastModifiedBy($core->company)
                                    ->setTitle("Laporan Data Sekolah")
                                    ->setSubject("Data Sekolah")
                                    ->setDescription("Laporan Data Sekolah.")
                                    ->setKeywords("PPPPTK BMTI Data Sekolah xls")
                                    ->setCategory("Data Master");

	$objPHPExcel->setActiveSheetIndex(0);

	$worksheet = $objPHPExcel->getActiveSheet();

	// Header : title : l1  & filter : l2
	
	$worksheet->setCellValueByColumnAndRow(0, 1, 'Data Sekolah');
	$worksheet->setCellValueByColumnAndRow(0, 2, 'Propinsi');
	$worksheet->setCellValueByColumnAndRow(0, 3, '');

	$worksheet->setCellValueByColumnAndRow(0, 4, 'NSS');
	$worksheet->setCellValueByColumnAndRow(1, 4, 'Nama Sekolah');
	$worksheet->setCellValueByColumnAndRow(2, 4, 'Jenis');
	$worksheet->setCellValueByColumnAndRow(3, 4, 'Propinsi');
	$worksheet->setCellValueByColumnAndRow(4, 4, 'Kota');
        
	// Data :
	$xrow = 5;
	foreach ($result as $v) {
		$worksheet->setCellValueByColumnAndRow(0, $xrow, $v->nss);
		$worksheet->setCellValueByColumnAndRow(1, $xrow, $v->nama_sekolah);
		$worksheet->setCellValueByColumnAndRow(2, $xrow, $v->nama_jenis);
		$worksheet->setCellValueByColumnAndRow(3, $xrow, $v->nama_propinsi);
		$worksheet->setCellValueByColumnAndRow(4, $xrow, $v->nama_kota);
		$xrow++;
	}
	unset($v);
			
	// Rename worksheet
	$worksheet->setTitle('Sekolah');

	// Set active sheet index to the first sheet, so Excel opens this as the first sheet
	$objPHPExcel->setActiveSheetIndex(0);

	// Redirect output to a client�s web browser (Excel5)
	header('Content-Type: application/vnd.ms-excel');
	header('Content-Disposition: attachment;filename="sekolah.xls"');
	header('Cache-Control: max-age=0');

	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
	$objWriter->save('php://output');
	  	  
	exit();
  endif;
?>

<?php
  /* == Create PTK Report == */
  if (isset($_GET['action']) and $_GET['action'] == "createReportPTK"):
  
        if(isset($_GET['propinsi_kode']))
            $propinsi_kode = $_GET['propinsi_kode'];
        else
            $propinsi_kode = '';

        if(isset($_GET['kota_kode']))
            $kota_kode = $_GET['kota_kode'];
        else
            $kota_kode = '';

        if(isset($_GET['searchfield']))
            $searchfield = $_GET['searchfield'];
        else
            $searchfield = 'nama';

        if(isset($_GET['searchtext']))
            $searchtext = $_GET['searchtext'];
        else
            $searchtext = '';
            
	ob_end_clean();  
	
	ob_start();
                    
        if ($propinsi_kode != '') {
              if ($kota_kode != '') {
                    $sqlwhere = "WHERE pt.propinsi_kode = '" . $propinsi_kode . "' AND pt.kota_kode = '" . $kota_kode . "'";
                      
                    if (($searchtext != '') && ($searchfield != ''))
                        $sqlwhere .= " AND LOWER(pt." . $searchfield .") LIKE '%". $searchtext ."%'";
              } else {
                      $sqlwhere = "WHERE pt.propinsi_kode = '" . $propinsi_kode . "'";
                      
                      if (($searchtext != '') && ($searchfield != ''))
                          $sqlwhere .= " AND LOWER(pt." . $searchfield .") LIKE '%". $searchtext ."%'";
              }
        } else {
              if ($kota_kode != '') {
                      $sqlwhere = "WHERE pt.kota_kode = '" . $kota_kode . "'";
                      
                      if (($searchtext != '') && ($searchfield != ''))
                          $sqlwhere .= " AND LOWER(pt." . $searchfield .") LIKE '%". $searchtext ."%'";
                      
              } else {

                      if (($searchtext != '') && ($searchfield != ''))
                        $sqlwhere = "WHERE LOWER(pt." . $searchfield .") LIKE '%". $searchtext ."%'";
                      else
                        $sqlwhere = "";
              }
        }
           
        $sql = "SELECT pt.*, s.nama_sekolah," 
        . "\n p.nama_propinsi," 
        . "\n k.nama_kota" 
        . "\n FROM ((ptk as pt" 
        . "\n LEFT JOIN sekolah as s ON pt.sekolahid = s.id)" 
        . "\n LEFT JOIN propinsi as p ON pt.propinsi_kode = p.kode)"
        . "\n LEFT JOIN kota as k ON pt.kota_kode = k.kode"
        . "\n $sqlwhere"         
        . "\n ORDER BY pt.nama_lengkap";

        $result = $db->fetch_all($sql);
	  
	require_once(BASEPATH . 'lib/PHPExcel.php');
		
	// Create new PHPExcel object
	$objPHPExcel = new PHPExcel();

	// Set document properties
	$objPHPExcel->getProperties()->setCreator($core->company)
                                    ->setLastModifiedBy($core->company)
                                    ->setTitle("Laporan Data Pendidik dan Tenaga Kependidikan")
                                    ->setSubject("Data Pendidik dan Tenaga Kependidikan")
                                    ->setDescription("Laporan Data Pendidik dan Tenaga Kependidikan.")
                                    ->setKeywords("PPPPTK BMTI Data PTK xls")
                                    ->setCategory("Data Master");

	$objPHPExcel->setActiveSheetIndex(0);

	$worksheet = $objPHPExcel->getActiveSheet();

	// Header : title : l1  & filter : l2
	
	$worksheet->setCellValueByColumnAndRow(0, 1, 'Data Pendidik dan Tenaga Kependidikan');
	$worksheet->setCellValueByColumnAndRow(0, 2, 'Propinsi');
	$worksheet->setCellValueByColumnAndRow(0, 3, '');

	$worksheet->setCellValueByColumnAndRow(0, 4, 'NUPTK');
	$worksheet->setCellValueByColumnAndRow(1, 4, 'Nama Lengkap');
	$worksheet->setCellValueByColumnAndRow(2, 4, 'NIP');
	$worksheet->setCellValueByColumnAndRow(3, 4, 'Sekolah');
	$worksheet->setCellValueByColumnAndRow(4, 4, 'Propinsi');
	$worksheet->setCellValueByColumnAndRow(5, 4, 'Kota');

	// Data :
	$xrow = 5;
	foreach ($result as $v) {
		$worksheet->setCellValueByColumnAndRow(0, $xrow, $v->nuptk);
                
                $nama_lengkap = $v->nama_lengkap;
                if ($v->gelar_depan3 != '') $nama_lengkap = $v->gelar_depan3.' '.$nama_lengkap;
                if ($v->gelar_depan2 != '') $nama_lengkap = $v->gelar_depan2.' '.$nama_lengkap;
                if ($v->gelar_depan1 != '') $nama_lengkap = $v->gelar_depan1.' '.$nama_lengkap;

                if ($v->gelar_belakang1 != '') $nama_lengkap .= ' '.$v->gelar_belakang1;
                if ($v->gelar_belakang2 != '') $nama_lengkap .= ' '.$v->gelar_belakang2;
                if ($v->gelar_belakang3 != '') $nama_lengkap .= ' '.$v->gelar_belakang3;                
                
		$worksheet->setCellValueByColumnAndRow(1, $xrow, $nama_lengkap);
		$worksheet->setCellValueByColumnAndRow(2, $xrow, $v->nip);
		$worksheet->setCellValueByColumnAndRow(3, $xrow, $v->nama_sekolah);
		$worksheet->setCellValueByColumnAndRow(4, $xrow, $v->nama_propinsi);
		$worksheet->setCellValueByColumnAndRow(5, $xrow, $v->nama_kota);
                
		$xrow++;
	}
	unset($v);
        
	// Rename worksheet
	$worksheet->setTitle('GTK');

	// Set active sheet index to the first sheet, so Excel opens this as the first sheet
	$objPHPExcel->setActiveSheetIndex(0);

	// Redirect output to a clients web browser (Excel5)
	header('Content-Type: application/vnd.ms-excel');
	header('Content-Disposition: attachment;filename="GTK.xls"');
	header('Cache-Control: max-age=0');

	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
	$objWriter->save('php://output');
	  
	exit();
  endif;
?>

<?php
  /* == Create TNA_PTK Report == */
  if (isset($_GET['action']) and $_GET['action'] == "createReportTNA_PTK"):
  
        if(isset($_GET['tgl_dari']))
            $tgl_dari = $_GET['tgl_dari'];
        else
            $tgl_dari = date('Y-m-d');

        if(isset($_GET['tgl_sampai']))
            $tgl_sampai = $_GET['tgl_sampai'];
        else
            $tgl_sampai = date('Y-m-d', strtotime("+7 days"));

        if(isset($_GET['kelid']))
            $kelid = $_GET['kelid'];
        else
            $kelid = 0;

        if(isset($_GET['bskid']))
            $bskid = $_GET['bskid'];
        else
            $bskid = 0;

        if(isset($_GET['pskid']))
            $pskid = $_GET['pskid'];
        else
            $pskid = 0;

        if(isset($_GET['kkid']))
            $kkid = $_GET['kkid'];
        else
            $kkid = 0;

        if(isset($_GET['mp1id']))
            $mp1id = $_GET['mp1id'];
        else
            $mp1id = 0;

        if(isset($_GET['mp2id']))
            $mp2id = $_GET['mp2id'];
        else
            $mp2id = 0;

        if(isset($_GET['propinsi_kode']))
            $propinsi_kode = $_GET['propinsi_kode'];
        else
            $propinsi_kode = '';

        if(isset($_GET['kota_kode']))
            $kota_kode = $_GET['kota_kode'];
        else
            $kota_kode = '';

        if(isset($_GET['sortby']))
            $sortby = $_GET['sortby'];
        else
            $sortby = 'pttna.last_update';          
         
	ob_end_clean();  
	
	ob_start();

            $tgl_dari = setToSQLdate($tgl_dari);
            $tgl_sampai = setToSQLdate($tgl_sampai);

            $sqlwhere = "(DATE(pttna.created) >= '". $tgl_dari ."' AND DATE(pttna.created) <= '" . $tgl_sampai . "')";
            if ($kelid > 0) {

                $sqlwhere .= " AND pttna.kelid = " . $kelid;
                if ($kkid > 0) {
                   $sqlwhere .= " AND pttna.kkid = " . $kkid;
                }
                  
                else {
                  if ($kelid == 3) {

                    if ($pskid > 0) {

                      $sqlwhere .= " AND k.pskid = " . $pskid;
                    } else if ($bskid > 0) {

                      $sqlwhere .= " AND ps.bskid = " . $bskid;
                    }

                  }
                }
            }

            // -- propinsi & kota --

            if ($kota_kode != "") {

              $sqlwhere .= " AND pt.kota_kode = '" . $kota_kode . "'";

            } else if ($propinsi_kode != "") {

              $sqlwhere .= " AND pt.propinsi_kode = '" . $propinsi_kode . "'";

            }


            if ($kelid == 3) {

              if ($bskid > 0)
                $sql = "SELECT pttna.*, ((pttna.nilai_total /pttna.nilai_instrumen) * 100) AS nilai_persen,"
                . "\n pt.nuptk AS ptk_nuptk, pt.nama_lengkap AS ptk_nama_lengkap, pt.golongan AS ptk_golongan,"
                . "\n s.nama_sekolah," 
                . "\n k.nama_kompetensi, k.pskid," 
                . "\n ps.nama_program" 
                . "\n FROM (((ptk_tna as pttna" 
                . "\n LEFT JOIN ptk AS pt ON pttna.ptkid = pt.id AND pttna.jenis = '" . $jenis . "')" 
                . "\n LEFT JOIN sekolah AS s ON pt.sekolahid = s.id)" 
                . "\n LEFT JOIN kk AS k ON pttna.kkid = k.id)" 
                . "\n LEFT JOIN psk AS ps ON k.pskid = ps.id" 
                . "\n WHERE $sqlwhere"
                . "\n ORDER BY " . $sortby . " " . $pager->limit;
              else
                $sql = "SELECT pttna.*, ((pttna.nilai_total /pttna.nilai_instrumen) * 100) AS nilai_persen,"
                . "\n pt.nuptk AS ptk_nuptk, pt.nama_lengkap AS ptk_nama_lengkap, pt.golongan AS ptk_golongan,"
                . "\n s.nama_sekolah," 
                . "\n k.nama_kompetensi, k.pskid" 
                . "\n FROM ((ptk_tna as pttna" 
                . "\n LEFT JOIN ptk AS pt ON pttna.ptkid = pt.id AND pttna.jenis = '" . $jenis . "')" 
                . "\n LEFT JOIN sekolah AS s ON pt.sekolahid = s.id)" 
                . "\n LEFT JOIN kk AS k ON pttna.kelid = " . $kelid . " AND pttna.kkid = k.id" 
                . "\n WHERE $sqlwhere"
                . "\n ORDER BY " . $sortby . " " . $pager->limit;

            }
            else if ($kelid == 1 || $kelid == 2)
              $sql = "SELECT pttna.*, ((pttna.nilai_total /pttna.nilai_instrumen) * 100) AS nilai_persen,"
              . "\n pt.nuptk AS ptk_nuptk, pt.nama_lengkap AS ptk_nama_lengkap, pt.golongan AS ptk_golongan,"
              . "\n s.nama_sekolah," 
              . "\n mp.nama_matapelajaran" 
              . "\n FROM ((ptk_tna as pttna" 
              . "\n LEFT JOIN ptk AS pt ON pttna.ptkid = pt.id AND pttna.jenis = 'P')" 
              . "\n LEFT JOIN sekolah AS s ON pt.sekolahid = s.id)" 
              . "\n LEFT JOIN matapelajaran AS mp ON pttna.kkid = mp.id" 
              . "\n WHERE $sqlwhere"
              . "\n ORDER BY ". $sortby . " " . $pager->limit;
            else
              $sql = "SELECT pttna.*, ((pttna.nilai_total /pttna.nilai_instrumen) * 100) AS nilai_persen,"
              . "\n pt.nuptk AS ptk_nuptk, pt.nama_lengkap AS ptk_nama_lengkap, pt.golongan AS ptk_golongan,"
              //. "\n st.nuptk AS staff_nuptk, st.nama_lengkap AS staff_nama_lengkap, st.golongan AS staff_golongan,"
              . "\n s.nama_sekolah," 
              //. "\n l.nama_lembaga," 
              . "\n k.nama_kompetensi, k.pskid," 
              . "\n mp.nama_matapelajaran" 
              . "\n FROM ((ptk_tna as pttna" 
              . "\n LEFT JOIN ptk AS pt ON pttna.ptkid = pt.id AND pttna.jenis = 'P')" 
              //. "\n LEFT JOIN staff AS st ON pttna.ptkid = st.id AND pttna.jenis = 'S')" 
              . "\n LEFT JOIN sekolah AS s ON pt.sekolahid = s.id)" 
              //. "\n LEFT JOIN lembaga AS l ON st.lembagaid = l.id)" 
              . "\n LEFT JOIN kk AS k ON pttna.kelid = 3 AND pttna.kkid = k.id" 
              . "\n LEFT JOIN matapelajaran AS mp ON (pttna.kelid = 1 Or pttna.kelid = 2) AND pttna.kkid = mp.id" 
              . "\n WHERE $sqlwhere"
              . "\n ORDER BY " . $sortby . " " . $pager->limit;

        $result = $db->fetch_all($sql);
	  
	require_once(BASEPATH . 'lib/PHPExcel.php');
		
	// Create new PHPExcel object
	$objPHPExcel = new PHPExcel();

	// Set document properties
	$objPHPExcel->getProperties()->setCreator($core->company)
                                    ->setLastModifiedBy($core->company)
                                    ->setTitle("Laporan Data Hasil TNA Online")
                                    ->setSubject("Data Hasil TNA Online")
                                    ->setDescription("Laporan Data Hasil TNA Online.")
                                    ->setKeywords("PPPPTK BMTI Data Hasil TNA Online GTK xls")
                                    ->setCategory("Data Master");

	$objPHPExcel->setActiveSheetIndex(0);

	$worksheet = $objPHPExcel->getActiveSheet();

	// Header : title : l1  & filter : l2
	
	$worksheet->setCellValueByColumnAndRow(0, 1, 'Data Hasil TNA Online');
	$worksheet->setCellValueByColumnAndRow(0, 2, 'Tanggal : ' . $tgl_dari . ' s.d ' . $tgl_sampai);
	$worksheet->setCellValueByColumnAndRow(0, 3, '');

	$worksheet->setCellValueByColumnAndRow(0, 4, 'NUPTK');
	$worksheet->setCellValueByColumnAndRow(1, 4, 'Nama Lengkap');
	$worksheet->setCellValueByColumnAndRow(2, 4, 'Sekolah');
  if ($kelid == 0)
	   $worksheet->setCellValueByColumnAndRow(3, 4, 'Paket Keahlian / Mata Pelajaran');
  else if ($kelid == 1 || $kelid == 2)
     $worksheet->setCellValueByColumnAndRow(3, 4, 'Mata Pelajaran');
  else
     $worksheet->setCellValueByColumnAndRow(3, 4, 'Paket Keahlian');
  $worksheet->setCellValueByColumnAndRow(4, 4, 'Tgl Proses');
  $worksheet->setCellValueByColumnAndRow(5, 4, 'Nilai %');

	// Data :
	$xrow = 5;
	foreach ($result as $v) {
		$worksheet->setCellValueByColumnAndRow(0, $xrow, $v->ptk_nuptk);                                                
		$worksheet->setCellValueByColumnAndRow(1, $xrow, $v->ptk_nama_lengkap);
		$worksheet->setCellValueByColumnAndRow(2, $xrow, $v->nama_sekolah);
    if ($kelid == 0) {
      if ($v->nama_kompetensi)
        $worksheet->setCellValueByColumnAndRow(3, $xrow, $v->nama_kompetensi);
      else
        $worksheet->setCellValueByColumnAndRow(3, $xrow, $v->nama_matapelajaran);
    }

		$worksheet->setCellValueByColumnAndRow(4, $xrow, $v->last_update);
    $nilai = (int)(($v->nilai_total / $v->nilai_instrumen) * 100 + .5);
		$worksheet->setCellValueByColumnAndRow(5, $xrow, $nilai);
		
		$xrow++;
	}
	unset($v);
			
		// $worksheet->setCellValueByColumnAndRow(4, $xrow, $sql);
        
        
	// Rename worksheet
	$worksheet->setTitle('TNA Online GTK');

	// Set active sheet index to the first sheet, so Excel opens this as the first sheet
	$objPHPExcel->setActiveSheetIndex(0);

	// Redirect output to a clients web browser (Excel5)
	header('Content-Type: application/vnd.ms-excel');
	header('Content-Disposition: attachment;filename="hasil_tna_GTK.xls"');
	header('Cache-Control: max-age=0');

	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
	$objWriter->save('php://output');
	  
	exit();
  endif;
   
?>

<?php
  /* == Create Diklat Report == */
  if (isset($_GET['action']) and $_GET['action'] == "createReportDiklat"):
  
        if(isset($_GET['departemenid']))
            $departemenid = $_GET['departemenid'];
        else
            $departemenid = 0;
        
	ob_end_clean();  
	
	ob_start();

        if ($departemenid > 0) 
            $sqlwhere = " dk.departemenid = " . $departemenid;
        else
            $sqlwhere = "";
           
        $sql = "SELECT dk.*, d.nama_departemen" 
        . "\n FROM diklat as dk" 
        . "\n LEFT JOIN departemen as d ON dk.departemenid = d.id" 
        . "\n $sqlwhere" 
        . "\n ORDER BY dk.nama_diklat";
    
        $result = $db->fetch_all($sql);
	  
	require_once(BASEPATH . 'lib/PHPExcel.php');
		
	// Create new PHPExcel object
	$objPHPExcel = new PHPExcel();

	// Set document properties
	$objPHPExcel->getProperties()->setCreator($core->company)
                                    ->setLastModifiedBy($core->company)
                                    ->setTitle("Laporan Data Katalog Diklat")
                                    ->setSubject("Data Katalog Diklat")
                                    ->setDescription("Data Katalog Diklat.")
                                    ->setKeywords("PPPPTK BMTI Data Katalog Diklat xls")
                                    ->setCategory("Data Master");

	$objPHPExcel->setActiveSheetIndex(0);

	$worksheet = $objPHPExcel->getActiveSheet();

	// Header : title : l1  & filter : l2
	
	$worksheet->setCellValueByColumnAndRow(0, 1, 'Data Katalog Diklat');
	$worksheet->setCellValueByColumnAndRow(0, 2, 'Departemen');
	$worksheet->setCellValueByColumnAndRow(0, 3, '');

	$worksheet->setCellValueByColumnAndRow(0, 4, 'Kode');
	$worksheet->setCellValueByColumnAndRow(1, 4, 'Nama Diklat');
	$worksheet->setCellValueByColumnAndRow(2, 4, 'Departemen');
	$worksheet->setCellValueByColumnAndRow(3, 4, 'Jml Jam/Pola');
	$worksheet->setCellValueByColumnAndRow(4, 4, 'Jenjang');

	// Data :
	$xrow = 5;
	foreach ($result as $v) {
		$worksheet->setCellValueByColumnAndRow(0, $xrow, $v->kode);
		$worksheet->setCellValueByColumnAndRow(1, $xrow, $v->nama_diklat);
		$worksheet->setCellValueByColumnAndRow(2, $xrow, $v->nama_departemen);
		$worksheet->setCellValueByColumnAndRow(3, $xrow, $v->jml_jam);
		$worksheet->setCellValueByColumnAndRow(4, $xrow, $v->tingkat);
		$xrow++;
	}
	unset($v);
			
		// $worksheet->setCellValueByColumnAndRow(4, $xrow, $sql);
        
        
	// Rename worksheet
	$worksheet->setTitle('Katalog Diklat');

	// Set active sheet index to the first sheet, so Excel opens this as the first sheet
	$objPHPExcel->setActiveSheetIndex(0);

	// Redirect output to a clients web browser (Excel5)
	header('Content-Type: application/vnd.ms-excel');
	header('Content-Disposition: attachment;filename="diklat.xls"');
	header('Cache-Control: max-age=0');

	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
	$objWriter->save('php://output');
	  
	exit();
  endif;
   
?>

<?php
  /* == Create Jadwal Diklat Report == */
  if (isset($_GET['action']) and $_GET['action'] == "createReportDiklat_Jadwal"):
  
        if(isset($_GET['tgl_dari']))
            $tgl_dari = $_GET['tgl_dari'];
        else
            $tgl_dari = date('Y-m-d');

        if(isset($_GET['tgl_sampai']))
            $tgl_sampai = $_GET['tgl_sampai'];
        else
            $tgl_sampai = date('Y-m-d', strtotime("+7 days"));
        
        if(isset($_GET['departemenid']))
            $departemenid = $_GET['departemenid'];
        else
            $departemenid = 0;
        
	ob_end_clean();  
	
	ob_start();

        $sqlwhere = "(dj.tgl_mulai >= '".$tgl_dari . "' AND dj.tgl_akhir <= '" .$tgl_sampai . "')";

        if ($departemenid > 0) 
            $sqlwhere .= " AND dk.departemenid = " . $departemenid;
           
        $sql = "SELECT dj.*,"
                 . "\n dk.kode, dk.nama_diklat, dk.tingkat,"
                 . "\n d.nama_departemen"
                 . "\n FROM (diklat_jadwal as dj"
                 . "\n LEFT JOIN diklat as dk"
                 . "\n ON dj.diklatid = dk.id)"
                 . "\n LEFT JOIN departemen as d"
                 . "\n ON dk.departemenid = d.id"
                 . "\n WHERE $sqlwhere"
                 . "\n ORDER By dj.tgl_mulai";

        $result = $db->fetch_all($sql);
	  
	require_once(BASEPATH . 'lib/PHPExcel.php');
		
	// Create new PHPExcel object
	$objPHPExcel = new PHPExcel();

	// Set document properties
	$objPHPExcel->getProperties()->setCreator($core->company)
                                    ->setLastModifiedBy($core->company)
                                    ->setTitle("Laporan Data Jadwal Diklat")
                                    ->setSubject("Data Jadwal Diklat")
                                    ->setDescription("Data Jadwal Diklat.")
                                    ->setKeywords("PPPPTK BMTI Data Jadwal Diklat xls")
                                    ->setCategory("Data Master");

	$objPHPExcel->setActiveSheetIndex(0);

	$worksheet = $objPHPExcel->getActiveSheet();

	// Header : title : l1  & filter : l2
	
	$worksheet->setCellValueByColumnAndRow(0, 1, 'Data Jadwal Diklat');
	$worksheet->setCellValueByColumnAndRow(0, 2, 'Departemen');
	$worksheet->setCellValueByColumnAndRow(0, 3, '');

	$worksheet->setCellValueByColumnAndRow(0, 4, 'Kode');
	$worksheet->setCellValueByColumnAndRow(1, 4, 'Nama Diklat');
	$worksheet->setCellValueByColumnAndRow(2, 4, 'Tingkat');
	$worksheet->setCellValueByColumnAndRow(3, 4, 'Tgl Mulai');
	$worksheet->setCellValueByColumnAndRow(4, 4, 'Tgl Akhir');
	$worksheet->setCellValueByColumnAndRow(5, 4, 'Departemen');

	// Data :
	$xrow = 5;
	foreach ($result as $v) {
		$worksheet->setCellValueByColumnAndRow(0, $xrow, $v->kode);
		$worksheet->setCellValueByColumnAndRow(1, $xrow, $v->nama_diklat);
		$worksheet->setCellValueByColumnAndRow(2, $xrow, $v->tingkat);
		$worksheet->setCellValueByColumnAndRow(3, $xrow, $v->tgl_mulai);
		$worksheet->setCellValueByColumnAndRow(4, $xrow, $v->tgl_akhir);
		$worksheet->setCellValueByColumnAndRow(5, $xrow, $v->nama_departemen);
		$xrow++;
	}
	unset($v);
			
		// $worksheet->setCellValueByColumnAndRow(4, $xrow, $sql);
        
        
	// Rename worksheet
	$worksheet->setTitle('Katalog Diklat');

	// Set active sheet index to the first sheet, so Excel opens this as the first sheet
	$objPHPExcel->setActiveSheetIndex(0);

	// Redirect output to a clients web browser (Excel5)
	header('Content-Type: application/vnd.ms-excel');
	header('Content-Disposition: attachment;filename="jadwal_diklat.xls"');
	header('Cache-Control: max-age=0');

	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
	$objWriter->save('php://output');
	  
	exit();
  endif;
   
?>

<?php
  /* == Create Calon Peserta Diklat Report == */
  if (isset($_GET['action']) and $_GET['action'] == "createReportDiklat_CalonPeserta"):
          
        if(isset($_GET['jadwalid']))
            $jadwalid = $_GET['jadwalid'];
        else
            $jadwalid = 0;
        
        if(isset($_GET['propinsi_kode']))
            $propinsi_kode = $_GET['propinsi_kode'];
        else
            $propinsi_kode = '';

        if(isset($_GET['kota_kode']))
            $kota_kode = $_GET['kota_kode'];
        else
            $kota_kode = '';

        if(isset($_GET['searchfield']))
            $searchfield = $_GET['searchfield'];
        else
            $searchfield = 'da.nama_lengkap';

        if(isset($_GET['searchtext']))
            $searchtext = $_GET['searchtext'];
        else
            $searchtext = '';
                
	ob_end_clean();  
	
	ob_start();

        if ($jadwalid > 0) 
            $sqlwhere = "WHERE da.jadwalid = " . $jadwalid . " AND da.status = 'P'";
        else
            $sqlwhere = "WHERE da.status = 'P'";
        
        if ($propinsi_kode != '') {
              if ($kota_kode != '') {                  
                    $sqlwhere .= " AND da.propinsi_kode = '" . $propinsi_kode . "' AND da.kota_kode = '" . $kota_kode ."'";
                      
                    if (($searchtext != '') && ($searchfield != '')) {
                        $sqlwhere .= " AND LOWER(" . $searchfield .") LIKE '%". $searchtext ."%'";
                    }
              } else {
                    $sqlwhere .= " AND da.propinsi_kode = '" . $propinsi_kode . "'";
                      
                    if (($searchtext != '') && ($searchfield != '')) {
                        $sqlwhere .= " AND LOWER(" . $searchfield .") LIKE '%". $searchtext ."%'";
                    }
              }
        } else {
              if ($kota_kode != '') {
                    $sqlwhere .= " AND da.kota_kode = '" . $kota_kode . "'";
                      
                    if (($searchtext != '') && ($searchfield != '')) {
                        $sqlwhere .= " AND LOWER(" . $searchfield .") LIKE '%". $searchtext ."%'";
                    }
                      
              } else {

                    if (($searchtext != '') && ($searchfield != '')) {
                        $sqlwhere .= " AND LOWER(" . $searchfield .") LIKE '%". $searchtext ."%'";
                    }        
              }
        }
                
        $sql = "SELECT da.*,"
        . "\n p.nama_propinsi," 
        . "\n k.nama_kota," 
        . "\n ks.nama_kota AS sekolah_nama_kota," 
        . "\n ps.nama_propinsi AS sekolah_nama_propinsi," 
        . "\n gol.nama_pangkat,gol.nama_fungsional," 
        . "\n dj.tgl_mulai,dj.tgl_akhir,dj.tempat,dj.kelas," 
        . "\n dk.nama_diklat,dk.jml_jam" 
        . "\n FROM ((((((diklat_calonpeserta AS da" 
        . "\n LEFT JOIN propinsi AS p ON da.propinsi_kode = p.kode)" 
        . "\n LEFT JOIN kota AS k ON da.kota_kode = k.kode)" 
        . "\n LEFT JOIN propinsi AS ps ON da.propinsi_kode_sekolah = ps.kode)" 
        . "\n LEFT JOIN kota AS ks ON da.kota_kode_sekolah = ks.kode)" 
        . "\n LEFT JOIN golongan AS gol ON da.golongan = gol.kode)"                 
        . "\n LEFT JOIN diklat_jadwal AS dj ON da.jadwalid = dj.id)" 
        . "\n LEFT JOIN diklat AS dk ON dj.diklatid = dk.id"                 
        . "\n $sqlwhere" 
        . "\n ORDER BY da.nama_lengkap";

        $result = $db->fetch_all($sql);
	  
	require_once(BASEPATH . 'lib/PHPExcel.php');
		
	// Create new PHPExcel object
	$objPHPExcel = new PHPExcel();

	// Set document properties
	$objPHPExcel->getProperties()->setCreator($core->company)
                                    ->setLastModifiedBy($core->company)
                                    ->setTitle("Laporan Data Calon Peserta Diklat")
                                    ->setSubject("Data Calon Peserta Diklat")
                                    ->setDescription("Data Calon Peserta Diklat.")
                                    ->setKeywords("PPPPTK BMTI Data Calon Peserta xls")
                                    ->setCategory("Data Master");

	$objPHPExcel->setActiveSheetIndex(0);

	$worksheet = $objPHPExcel->getActiveSheet();

	// Header : title : l1  & filter : l2
	
	$worksheet->setCellValueByColumnAndRow(0, 1, 'Data Peserta Diklat');
	$worksheet->setCellValueByColumnAndRow(0, 2, 'Tanggal Cetak : ' . $core->formatLongDate(date("Y-m-d", time())));
	$worksheet->setCellValueByColumnAndRow(0, 3, '');

        // title - style 
        
        $titlestyleArray = array(
            'font' => array(
		'bold' => true,
            )
        );        
        
        $worksheet->getStyleByColumnAndRow(0, 1)->applyFromArray($titlestyleArray);       
        $worksheet->getStyleByColumnAndRow(0, 2)->applyFromArray($titlestyleArray);       
        $worksheet->getStyleByColumnAndRow(0, 3)->applyFromArray($titlestyleArray);       
               
	$worksheet->setCellValueByColumnAndRow(0, 4, 'NO');
	$worksheet->setCellValueByColumnAndRow(1, 4, 'NAMA');
	$worksheet->setCellValueByColumnAndRow(2, 4, 'NIP');
	$worksheet->setCellValueByColumnAndRow(3, 4, 'NUPTK');
	$worksheet->setCellValueByColumnAndRow(4, 4, 'GOL');
	$worksheet->setCellValueByColumnAndRow(5, 4, 'PANGKAT');
	$worksheet->setCellValueByColumnAndRow(6, 4, 'JK');
	$worksheet->setCellValueByColumnAndRow(7, 4, 'TEMPAT LHR');
	$worksheet->setCellValueByColumnAndRow(8, 4, 'TGL LHR');
	$worksheet->setCellValueByColumnAndRow(9, 4, 'JAB FUNG');
	$worksheet->setCellValueByColumnAndRow(10, 4, 'AGAMA');
	$worksheet->setCellValueByColumnAndRow(11, 4, 'PEND TERAKHIR');
	$worksheet->setCellValueByColumnAndRow(12, 4, 'JURUSAN PEND TERAKHIR');
	$worksheet->setCellValueByColumnAndRow(13, 4, 'THN LULUS');
	$worksheet->setCellValueByColumnAndRow(14, 4, 'ALAMAT GURU');
	$worksheet->setCellValueByColumnAndRow(15, 4, 'KAB/KOTA');
	$worksheet->setCellValueByColumnAndRow(16, 4, 'PROPINSI');
	$worksheet->setCellValueByColumnAndRow(17, 4, 'HP GURU');
	$worksheet->setCellValueByColumnAndRow(18, 4, 'NSS');
	$worksheet->setCellValueByColumnAndRow(19, 4, 'NAMA SEKOLAH');
	$worksheet->setCellValueByColumnAndRow(20, 4, 'STATUS');
	$worksheet->setCellValueByColumnAndRow(21, 4, 'KEPALA SEKOLAH');
	$worksheet->setCellValueByColumnAndRow(22, 4, 'ALAMAT SEKOLAH');
	$worksheet->setCellValueByColumnAndRow(23, 4, 'TELP SEKOLAH');
	$worksheet->setCellValueByColumnAndRow(24, 4, 'FAX');
	$worksheet->setCellValueByColumnAndRow(25, 4, 'KODEPOS');
	$worksheet->setCellValueByColumnAndRow(26, 4, 'EMAIL');
	$worksheet->setCellValueByColumnAndRow(27, 4, 'WEBSITE');
	$worksheet->setCellValueByColumnAndRow(28, 4, 'KOTA KAB');
	$worksheet->setCellValueByColumnAndRow(29, 4, 'PROPINSI');
	$worksheet->setCellValueByColumnAndRow(30, 4, 'NAMA DIKLAT');
	$worksheet->setCellValueByColumnAndRow(31, 4, 'MULAI');
	$worksheet->setCellValueByColumnAndRow(32, 4, 'SAMPAI');
	$worksheet->setCellValueByColumnAndRow(33, 4, 'TEMPAT');
	$worksheet->setCellValueByColumnAndRow(34, 4, 'POLA (JAM)');

        // width
        
        
        // header - style 
        
        $styleArray = array(
            'font' => array(
		'bold' => true,
            ),
            'alignment' => array(
		'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            ),
            'fill' => array(
		'type' => PHPExcel_Style_Fill::FILL_SOLID,
		'startcolor' => array(
			'argb' => 'FFA0A0A0',
		),
		'endcolor' => array(
			'argb' => 'FFFFFFFF',
		),
            ),
        );        
        
        for ($i=0; $i<=34; $i++) {
            $worksheet->getStyleByColumnAndRow($i, 4)->applyFromArray($styleArray);       
            $worksheet->getColumnDimensionByColumn($i)->setAutoSize(true);
        }        

        
        setlocale (LC_TIME, 'id_ID');
        //setlocale (LC_TIME, 'INDONESIA');
        
	// Data :
	$xrow = 5;
	foreach ($result as $v) {
		//$worksheet->setCellValueByColumnAndRow(0, $xrow, $xrow - 4);
                $worksheet->setCellValueExplicitByColumnAndRow(0, $xrow, $xrow - 4,
                         PHPExcel_Cell_DataType::TYPE_NUMERIC);
                
                $nama_lengkap = htmlspecialchars_decode($v->nama_lengkap, ENT_QUOTES);
                if ($v->gelar_depan3 != '') $nama_lengkap = $v->gelar_depan3.' '.$nama_lengkap;
                if ($v->gelar_depan2 != '') $nama_lengkap = $v->gelar_depan2.' '.$nama_lengkap;
                if ($v->gelar_depan1 != '') $nama_lengkap = $v->gelar_depan1.' '.$nama_lengkap;

                if ($v->gelar_belakang1 != '') $nama_lengkap .= ' '.$v->gelar_belakang1;
                if ($v->gelar_belakang2 != '') $nama_lengkap .= ' '.$v->gelar_belakang2;
                if ($v->gelar_belakang3 != '') $nama_lengkap .= ' '.$v->gelar_belakang3;
                
                if ($v->jns_klmn == 'L') 
                    $jns_klmn = 'Laki-Laki'; 
                else if ($v->jns_klmn == 'P') 
                    $jns_klmn = 'Perempuan';
                else
                    $jns_klmn = '';
                                
		$worksheet->setCellValueExplicitByColumnAndRow(1, $xrow, $nama_lengkap,
                        PHPExcel_Cell_DataType::TYPE_STRING);
		$worksheet->setCellValueExplicitByColumnAndRow(2, $xrow, $v->nip,
                        PHPExcel_Cell_DataType::TYPE_STRING);
		$worksheet->setCellValueExplicitByColumnAndRow(3, $xrow, $v->nuptk,
                        PHPExcel_Cell_DataType::TYPE_STRING);
		$worksheet->setCellValueExplicitByColumnAndRow(4, $xrow, $v->golongan,
                        PHPExcel_Cell_DataType::TYPE_STRING);
		$worksheet->setCellValueExplicitByColumnAndRow(5, $xrow, $v->nama_pangkat,
                        PHPExcel_Cell_DataType::TYPE_STRING);
		$worksheet->setCellValueExplicitByColumnAndRow(6, $xrow, $jns_klmn,
                        PHPExcel_Cell_DataType::TYPE_STRING);
		$worksheet->setCellValueExplicitByColumnAndRow(7, $xrow, $v->tmp_lahir,
                        PHPExcel_Cell_DataType::TYPE_STRING);
		$worksheet->setCellValueExplicitByColumnAndRow(8, $xrow, $core->formatLongDate($v->tgl_lahir),
                        PHPExcel_Cell_DataType::TYPE_STRING);
		$worksheet->setCellValueExplicitByColumnAndRow(9, $xrow, $v->nama_fungsional,
                        PHPExcel_Cell_DataType::TYPE_STRING);
		$worksheet->setCellValueExplicitByColumnAndRow(10, $xrow, $v->agama,
                        PHPExcel_Cell_DataType::TYPE_STRING);
		$worksheet->setCellValueExplicitByColumnAndRow(11, $xrow, $v->ijazah_akhir,
                        PHPExcel_Cell_DataType::TYPE_STRING);
		$worksheet->setCellValueExplicitByColumnAndRow(12, $xrow, $v->jurusan_akhir,
                        PHPExcel_Cell_DataType::TYPE_STRING);
		$worksheet->setCellValueExplicitByColumnAndRow(13, $xrow, $v->tahun_lulus_akhir,
                        PHPExcel_Cell_DataType::TYPE_STRING);
		$worksheet->setCellValueExplicitByColumnAndRow(14, $xrow, htmlspecialchars_decode($v->alamat, ENT_QUOTES),
                        PHPExcel_Cell_DataType::TYPE_STRING);
		$worksheet->setCellValueExplicitByColumnAndRow(15, $xrow, $v->nama_kota,
                        PHPExcel_Cell_DataType::TYPE_STRING);
		$worksheet->setCellValueExplicitByColumnAndRow(16, $xrow, $v->nama_propinsi,
                        PHPExcel_Cell_DataType::TYPE_STRING);
		$worksheet->setCellValueExplicitByColumnAndRow(17, $xrow, $v->telepon2,
                        PHPExcel_Cell_DataType::TYPE_STRING);
		$worksheet->setCellValueExplicitByColumnAndRow(18, $xrow, $v->nss,
                        PHPExcel_Cell_DataType::TYPE_STRING);
		$worksheet->setCellValueExplicitByColumnAndRow(19, $xrow, htmlspecialchars_decode($v->nama_sekolah, ENT_QUOTES),
                        PHPExcel_Cell_DataType::TYPE_STRING);
		$worksheet->setCellValueExplicitByColumnAndRow(20, $xrow, $v->status_sekolah,
                        PHPExcel_Cell_DataType::TYPE_STRING);
		$worksheet->setCellValueExplicitByColumnAndRow(21, $xrow, htmlspecialchars_decode($v->nama_pimpinan, ENT_QUOTES),
                        PHPExcel_Cell_DataType::TYPE_STRING);
		$worksheet->setCellValueExplicitByColumnAndRow(22, $xrow, htmlspecialchars_decode($v->alamat_sekolah, ENT_QUOTES),
                        PHPExcel_Cell_DataType::TYPE_STRING);
		$worksheet->setCellValueExplicitByColumnAndRow(23, $xrow, $v->telepon_sekolah,
                        PHPExcel_Cell_DataType::TYPE_STRING);
		$worksheet->setCellValueExplicitByColumnAndRow(24, $xrow, $v->fax_sekolah,
                        PHPExcel_Cell_DataType::TYPE_STRING);
		$worksheet->setCellValueExplicitByColumnAndRow(25, $xrow, $v->kodepos_sekolah,
                        PHPExcel_Cell_DataType::TYPE_STRING);
		$worksheet->setCellValueExplicitByColumnAndRow(26, $xrow, $v->email,
                        PHPExcel_Cell_DataType::TYPE_STRING);
		$worksheet->setCellValueExplicitByColumnAndRow(27, $xrow, $v->website,
                        PHPExcel_Cell_DataType::TYPE_STRING);
		$worksheet->setCellValueExplicitByColumnAndRow(28, $xrow, $v->sekolah_nama_kota,
                        PHPExcel_Cell_DataType::TYPE_STRING);
		$worksheet->setCellValueExplicitByColumnAndRow(29, $xrow, $v->sekolah_nama_propinsi,
                        PHPExcel_Cell_DataType::TYPE_STRING);
		$worksheet->setCellValueExplicitByColumnAndRow(30, $xrow, $v->nama_diklat,
                        PHPExcel_Cell_DataType::TYPE_STRING);
		$worksheet->setCellValueExplicitByColumnAndRow(31, $xrow, $core->formatLongDate($v->tgl_mulai),
                        PHPExcel_Cell_DataType::TYPE_STRING);
		$worksheet->setCellValueExplicitByColumnAndRow(32, $xrow, $core->formatLongDate($v->tgl_akhir),
                        PHPExcel_Cell_DataType::TYPE_STRING);
		$worksheet->setCellValueExplicitByColumnAndRow(33, $xrow, $v->tempat,
                        PHPExcel_Cell_DataType::TYPE_STRING);
		$worksheet->setCellValueExplicitByColumnAndRow(34, $xrow, $v->jml_jam,
                        PHPExcel_Cell_DataType::TYPE_NUMERIC);
                                
		$xrow++;
    $nama_diklat_file = $v->nama_diklat.'_kelas_'.$v->kelas;

	}
	unset($v);
			
		// $worksheet->setCellValueByColumnAndRow(4, $xrow, $sql);
        
        
	// Rename worksheet
	$worksheet->setTitle('Calon Peserta Diklat');

	// Set active sheet index to the first sheet, so Excel opens this as the first sheet
	$objPHPExcel->setActiveSheetIndex(0);

	// Redirect output to a clients web browser (Excel5)
	header('Content-Type: application/vnd.ms-excel');
	header('Content-Disposition: attachment;filename="calonpeserta_diklat_'.$nama_diklat_file.'.xls"');
	header('Cache-Control: max-age=0');

	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
	$objWriter->save('php://output');
	  
	exit();
  endif;
   
?>

<?php
  /* == Create Peserta Diklat Report == */
  if (isset($_GET['action']) and $_GET['action'] == "createReportDiklat_Peserta"):
          
        if(isset($_GET['jadwalid']))
            $jadwalid = $_GET['jadwalid'];
        else
            $jadwalid = 0;
        
        if(isset($_GET['propinsi_kode']))
            $propinsi_kode = $_GET['propinsi_kode'];
        else
            $propinsi_kode = '';

        if(isset($_GET['kota_kode']))
            $kota_kode = $_GET['kota_kode'];
        else
            $kota_kode = '';

        if(isset($_GET['searchfield']))
            $searchfield = $_GET['searchfield'];
        else
            $searchfield = 'dp.nama_lengkap';

        if(isset($_GET['searchtext']))
            $searchtext = $_GET['searchtext'];
        else
            $searchtext = '';
                
	ob_end_clean();  
	
	ob_start();
        
        if ($jadwalid > 0) 
            $sqlwhere = "WHERE dp.jadwalid = " . $jadwalid;
        else
            $sqlwhere = "";
           
        if ($propinsi_kode != '') {
              if ($kota_kode != '') {                  
                    if ($sqlwhere != '') 
                        $sqlwhere .= " AND dp.propinsi_kode = '" . $propinsi_kode . "' AND dp.kota_kode = '" . $kota_kode ."'";
                    else
                        $sqlwhere = "WHERE dp.propinsi_kode = '" . $propinsi_kode . "' AND dp.kota_kode = '" . $kota_kode ."'";
                      
                    if (($searchtext != '') && ($searchfield != '')) {
                        if ($sqlwhere != '') 
                            $sqlwhere .= " AND LOWER(" . $searchfield .") LIKE '%". $searchtext ."%'";
                        else
                            $sqlwhere = "WHERE LOWER(" . $searchfield .") LIKE '%". $searchtext ."%'";
                    }
              } else {
                    if ($sqlwhere != '') 
                        $sqlwhere .= " AND dp.propinsi_kode = '" . $propinsi_kode . "'";
                    else
                        $sqlwhere = "WHERE dp.propinsi_kode = '" . $propinsi_kode . "'";
                      
                    if (($searchtext != '') && ($searchfield != '')) {
                        if ($sqlwhere != '') 
                            $sqlwhere .= " AND LOWER(" . $searchfield .") LIKE '%". $searchtext ."%'";
                        else
                            $sqlwhere = "WHERE LOWER(" . $searchfield .") LIKE '%". $searchtext ."%'";
                    }
              }
        } else {
              if ($kota_kode != '') {
                    if ($sqlwhere != '') 
                        $sqlwhere .= " AND dp.kota_kode = '" . $kota_kode . "'";
                    else
                        $sqlwhere = "WHERE dp.kota_kode = '" . $kota_kode . "'";
                      
                    if (($searchtext != '') && ($searchfield != '')) {
                        if ($sqlwhere != '') 
                            $sqlwhere .= " AND LOWER(" . $searchfield .") LIKE '%". $searchtext ."%'";
                        else
                            $sqlwhere = "WHERE LOWER(" . $searchfield .") LIKE '%". $searchtext ."%'";
                    }
                      
              } else {

                    if (($searchtext != '') && ($searchfield != '')) {
                        if ($sqlwhere != '') 
                            $sqlwhere .= " AND LOWER(" . $searchfield .") LIKE '%". $searchtext ."%'";
                        else
                            $sqlwhere = "WHERE LOWER(" . $searchfield .") LIKE '%". $searchtext ."%'";
                    }        
              }
        }
                
        
        $sql = "SELECT dp.*,"
        . "\n p.nama_propinsi," 
        . "\n k.nama_kota," 
        . "\n ks.nama_kota AS sekolah_nama_kota," 
        . "\n ps.nama_propinsi AS sekolah_nama_propinsi," 
        . "\n gol.nama_pangkat,gol.nama_fungsional," 
        . "\n dj.tgl_mulai,dj.tgl_akhir,dj.tempat," 
        . "\n dk.nama_diklat,dk.jml_jam" 
        . "\n FROM ((((((diklat_peserta AS dp" 
        . "\n LEFT JOIN propinsi as p ON dp.propinsi_kode = p.kode)" 
        . "\n LEFT JOIN kota as k ON dp.kota_kode = k.kode)" 
        . "\n LEFT JOIN propinsi AS ps ON dp.propinsi_kode_sekolah = ps.kode)" 
        . "\n LEFT JOIN kota AS ks ON dp.kota_kode_sekolah = ks.kode)" 
        . "\n LEFT JOIN golongan AS gol ON dp.golongan = gol.kode)"                 
        . "\n LEFT JOIN diklat_jadwal AS dj ON dp.jadwalid = dj.id)" 
        . "\n LEFT JOIN diklat AS dk ON dj.diklatid = dk.id" 
        . "\n $sqlwhere" 
        . "\n ORDER BY dp.nama_lengkap";
        
        $result = $db->fetch_all($sql);
	  
	require_once(BASEPATH . 'lib/PHPExcel.php');
		
	// Create new PHPExcel object
	$objPHPExcel = new PHPExcel();

	// Set document properties
	$objPHPExcel->getProperties()->setCreator($core->company)
                                    ->setLastModifiedBy($core->company)
                                    ->setTitle("Laporan Data Peserta Diklat")
                                    ->setSubject("Data Peserta Diklat")
                                    ->setDescription("Data Peserta Diklat.")
                                    ->setKeywords("PPPPTK BMTI Data Peserta xls")
                                    ->setCategory("Data Master");

	$objPHPExcel->setActiveSheetIndex(0);

	$worksheet = $objPHPExcel->getActiveSheet();

	// Header : title : l1  & filter : l2
	
	$worksheet->setCellValueByColumnAndRow(0, 1, 'Data Peserta Diklat');
	$worksheet->setCellValueByColumnAndRow(0, 2, 'Tanggal Cetak : ' . $core->formatLongDate(date("Y-m-d", time())));
	$worksheet->setCellValueByColumnAndRow(0, 3, '');

        // title - style 
        
        $titlestyleArray = array(
            'font' => array(
		'bold' => true,
            )
        );        
        
        $worksheet->getStyleByColumnAndRow(0, 1)->applyFromArray($titlestyleArray);       
        $worksheet->getStyleByColumnAndRow(0, 2)->applyFromArray($titlestyleArray);       
        $worksheet->getStyleByColumnAndRow(0, 3)->applyFromArray($titlestyleArray);       
               
	$worksheet->setCellValueByColumnAndRow(0, 4, 'NO');
	$worksheet->setCellValueByColumnAndRow(1, 4, 'NAMA');
	$worksheet->setCellValueByColumnAndRow(2, 4, 'NIP');
	$worksheet->setCellValueByColumnAndRow(3, 4, 'NUPTK');
	$worksheet->setCellValueByColumnAndRow(4, 4, 'GOL');
	$worksheet->setCellValueByColumnAndRow(5, 4, 'PANGKAT');
	$worksheet->setCellValueByColumnAndRow(6, 4, 'JK');
	$worksheet->setCellValueByColumnAndRow(7, 4, 'TEMPAT LHR');
	$worksheet->setCellValueByColumnAndRow(8, 4, 'TGL LHR');
	$worksheet->setCellValueByColumnAndRow(9, 4, 'JAB FUNG');
	$worksheet->setCellValueByColumnAndRow(10, 4, 'AGAMA');
	$worksheet->setCellValueByColumnAndRow(11, 4, 'PEND TERAKHIR');
	$worksheet->setCellValueByColumnAndRow(12, 4, 'JURUSAN PEND TERAKHIR');
	$worksheet->setCellValueByColumnAndRow(13, 4, 'THN LULUS');
	$worksheet->setCellValueByColumnAndRow(14, 4, 'ALAMAT GURU');
	$worksheet->setCellValueByColumnAndRow(15, 4, 'KAB/KOTA');
	$worksheet->setCellValueByColumnAndRow(16, 4, 'PROPINSI');
	$worksheet->setCellValueByColumnAndRow(17, 4, 'HP GURU');
	$worksheet->setCellValueByColumnAndRow(18, 4, 'NSS');
	$worksheet->setCellValueByColumnAndRow(19, 4, 'NAMA SEKOLAH');
	$worksheet->setCellValueByColumnAndRow(20, 4, 'STATUS');
	$worksheet->setCellValueByColumnAndRow(21, 4, 'KEPALA SEKOLAH');
	$worksheet->setCellValueByColumnAndRow(22, 4, 'ALAMAT SEKOLAH');
	$worksheet->setCellValueByColumnAndRow(23, 4, 'TELP SEKOLAH');
	$worksheet->setCellValueByColumnAndRow(24, 4, 'FAX');
	$worksheet->setCellValueByColumnAndRow(25, 4, 'KODEPOS');
	$worksheet->setCellValueByColumnAndRow(26, 4, 'EMAIL');
	$worksheet->setCellValueByColumnAndRow(27, 4, 'WEBSITE');
	$worksheet->setCellValueByColumnAndRow(28, 4, 'KOTA KAB');
	$worksheet->setCellValueByColumnAndRow(29, 4, 'PROPINSI');
	$worksheet->setCellValueByColumnAndRow(30, 4, 'NAMA DIKLAT');
	$worksheet->setCellValueByColumnAndRow(31, 4, 'MULAI');
	$worksheet->setCellValueByColumnAndRow(32, 4, 'SAMPAI');
	$worksheet->setCellValueByColumnAndRow(33, 4, 'TEMPAT');
	$worksheet->setCellValueByColumnAndRow(34, 4, 'POLA (JAM)');

        // width
        
        
        // header - style 
        
        $styleArray = array(
            'font' => array(
		'bold' => true,
            ),
            'alignment' => array(
		'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            ),
            'fill' => array(
		'type' => PHPExcel_Style_Fill::FILL_SOLID,
		'startcolor' => array(
			'argb' => 'FFA0A0A0',
		),
		'endcolor' => array(
			'argb' => 'FFFFFFFF',
		),
            ),
        );        
        
        for ($i=0; $i<=34; $i++) {
            $worksheet->getStyleByColumnAndRow($i, 4)->applyFromArray($styleArray);       
            $worksheet->getColumnDimensionByColumn($i)->setAutoSize(true);
        }        

        
        setlocale (LC_TIME, 'id_ID');
        //setlocale (LC_TIME, 'INDONESIA');
        
	// Data :
	$xrow = 5;
	foreach ($result as $v) {
		//$worksheet->setCellValueByColumnAndRow(0, $xrow, $xrow - 4);
                $worksheet->setCellValueExplicitByColumnAndRow(0, $xrow, $xrow - 4,
                         PHPExcel_Cell_DataType::TYPE_NUMERIC);
                
                $nama_lengkap = htmlspecialchars_decode($v->nama_lengkap, ENT_QUOTES);
                if ($v->gelar_depan3 != '') $nama_lengkap = $v->gelar_depan3.' '.$nama_lengkap;
                if ($v->gelar_depan2 != '') $nama_lengkap = $v->gelar_depan2.' '.$nama_lengkap;
                if ($v->gelar_depan1 != '') $nama_lengkap = $v->gelar_depan1.' '.$nama_lengkap;

                if ($v->gelar_belakang1 != '') $nama_lengkap .= ' '.$v->gelar_belakang1;
                if ($v->gelar_belakang2 != '') $nama_lengkap .= ' '.$v->gelar_belakang2;
                if ($v->gelar_belakang3 != '') $nama_lengkap .= ' '.$v->gelar_belakang3;                
                            
                if ($v->jns_klmn == 'L') 
                    $jns_klmn = 'Laki-Laki'; 
                else if ($v->jns_klmn == 'P') 
                    $jns_klmn = 'Perempuan';
                else
                    $jns_klmn = '';
                                
		$worksheet->setCellValueExplicitByColumnAndRow(1, $xrow, $nama_lengkap,
                        PHPExcel_Cell_DataType::TYPE_STRING);
		$worksheet->setCellValueExplicitByColumnAndRow(2, $xrow, $v->nip,
                        PHPExcel_Cell_DataType::TYPE_STRING);
		$worksheet->setCellValueExplicitByColumnAndRow(3, $xrow, $v->nuptk,
                        PHPExcel_Cell_DataType::TYPE_STRING);
		$worksheet->setCellValueExplicitByColumnAndRow(4, $xrow, $v->golongan,
                        PHPExcel_Cell_DataType::TYPE_STRING);
		$worksheet->setCellValueExplicitByColumnAndRow(5, $xrow, $v->nama_pangkat,
                        PHPExcel_Cell_DataType::TYPE_STRING);
		$worksheet->setCellValueExplicitByColumnAndRow(6, $xrow, $jns_klmn,
                        PHPExcel_Cell_DataType::TYPE_STRING);
		$worksheet->setCellValueExplicitByColumnAndRow(7, $xrow, $v->tmp_lahir,
                        PHPExcel_Cell_DataType::TYPE_STRING);
		$worksheet->setCellValueExplicitByColumnAndRow(8, $xrow, $core->formatLongDate($v->tgl_lahir),
                        PHPExcel_Cell_DataType::TYPE_STRING);
		$worksheet->setCellValueExplicitByColumnAndRow(9, $xrow, $v->nama_fungsional,
                        PHPExcel_Cell_DataType::TYPE_STRING);
		$worksheet->setCellValueExplicitByColumnAndRow(10, $xrow, $v->agama,
                        PHPExcel_Cell_DataType::TYPE_STRING);
		$worksheet->setCellValueExplicitByColumnAndRow(11, $xrow, $v->ijazah_akhir,
                        PHPExcel_Cell_DataType::TYPE_STRING);
		$worksheet->setCellValueExplicitByColumnAndRow(12, $xrow, $v->jurusan_akhir,
                        PHPExcel_Cell_DataType::TYPE_STRING);
		$worksheet->setCellValueExplicitByColumnAndRow(13, $xrow, $v->tahun_lulus_akhir,
                        PHPExcel_Cell_DataType::TYPE_STRING);
		$worksheet->setCellValueExplicitByColumnAndRow(14, $xrow, htmlspecialchars_decode($v->alamat, ENT_QUOTES),
                        PHPExcel_Cell_DataType::TYPE_STRING);
		$worksheet->setCellValueExplicitByColumnAndRow(15, $xrow, $v->nama_kota,
                        PHPExcel_Cell_DataType::TYPE_STRING);
		$worksheet->setCellValueExplicitByColumnAndRow(16, $xrow, $v->nama_propinsi,
                        PHPExcel_Cell_DataType::TYPE_STRING);
		$worksheet->setCellValueExplicitByColumnAndRow(17, $xrow, $v->telepon2,
                        PHPExcel_Cell_DataType::TYPE_STRING);
		$worksheet->setCellValueExplicitByColumnAndRow(18, $xrow, $v->nss,
                        PHPExcel_Cell_DataType::TYPE_STRING);
		$worksheet->setCellValueExplicitByColumnAndRow(19, $xrow, htmlspecialchars_decode($v->nama_sekolah, ENT_QUOTES),
                        PHPExcel_Cell_DataType::TYPE_STRING);
		$worksheet->setCellValueExplicitByColumnAndRow(20, $xrow, $v->status_sekolah,
                        PHPExcel_Cell_DataType::TYPE_STRING);
		$worksheet->setCellValueExplicitByColumnAndRow(21, $xrow, htmlspecialchars_decode($v->nama_pimpinan, ENT_QUOTES),
                        PHPExcel_Cell_DataType::TYPE_STRING);
		$worksheet->setCellValueExplicitByColumnAndRow(22, $xrow, htmlspecialchars_decode($v->alamat_sekolah, ENT_QUOTES),
                        PHPExcel_Cell_DataType::TYPE_STRING);
		$worksheet->setCellValueExplicitByColumnAndRow(23, $xrow, $v->telepon_sekolah,
                        PHPExcel_Cell_DataType::TYPE_STRING);
		$worksheet->setCellValueExplicitByColumnAndRow(24, $xrow, $v->fax_sekolah,
                        PHPExcel_Cell_DataType::TYPE_STRING);
		$worksheet->setCellValueExplicitByColumnAndRow(25, $xrow, $v->kodepos_sekolah,
                        PHPExcel_Cell_DataType::TYPE_STRING);
		$worksheet->setCellValueExplicitByColumnAndRow(26, $xrow, $v->email,
                        PHPExcel_Cell_DataType::TYPE_STRING);
		$worksheet->setCellValueExplicitByColumnAndRow(27, $xrow, $v->website,
                        PHPExcel_Cell_DataType::TYPE_STRING);
		$worksheet->setCellValueExplicitByColumnAndRow(28, $xrow, $v->sekolah_nama_kota,
                        PHPExcel_Cell_DataType::TYPE_STRING);
		$worksheet->setCellValueExplicitByColumnAndRow(29, $xrow, $v->sekolah_nama_propinsi,
                        PHPExcel_Cell_DataType::TYPE_STRING);
		$worksheet->setCellValueExplicitByColumnAndRow(30, $xrow, $v->nama_diklat,
                        PHPExcel_Cell_DataType::TYPE_STRING);
		$worksheet->setCellValueExplicitByColumnAndRow(31, $xrow, $core->formatLongDate($v->tgl_mulai),
                        PHPExcel_Cell_DataType::TYPE_STRING);
		$worksheet->setCellValueExplicitByColumnAndRow(32, $xrow, $core->formatLongDate($v->tgl_akhir),
                        PHPExcel_Cell_DataType::TYPE_STRING);
		$worksheet->setCellValueExplicitByColumnAndRow(33, $xrow, $v->tempat,
                        PHPExcel_Cell_DataType::TYPE_STRING);
		$worksheet->setCellValueExplicitByColumnAndRow(34, $xrow, $v->jml_jam,
                        PHPExcel_Cell_DataType::TYPE_NUMERIC);
                                
		$xrow++;
	}
	unset($v);
			                
	// Rename worksheet
	$worksheet->setTitle('Peserta Diklat');

	// Set active sheet index to the first sheet, so Excel opens this as the first sheet
	$objPHPExcel->setActiveSheetIndex(0);

	// Redirect output to a clients web browser (Excel5)
	header('Content-Type: application/vnd.ms-excel');
	header('Content-Disposition: attachment;filename="peserta_diklat.xls"');
	header('Cache-Control: max-age=0');

	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
	$objWriter->save('php://output');
	  
	exit();
  endif;
   
?>


<?php
  /* == Create Registrasi Peserta Diklat Report == */
  if (isset($_GET['action']) and $_GET['action'] == "createReportRegistrasiDiklat"):
  
        if(isset($_GET['jadwalid']))
            $jadwalid = $_GET['jadwalid'];
        else
            $jadwalid = 0;
        
        if(isset($_GET['propinsi_kode']))
            $propinsi_kode = $_GET['propinsi_kode'];
        else
            $propinsi_kode = '';

        if(isset($_GET['kota_kode']))
            $kota_kode = $_GET['kota_kode'];
        else
            $kota_kode = '';

        $searchtext = '';  

  ob_end_clean();  
  
  ob_start();

       if ($propinsi_kode != '') {
                if ($kota_kode != '') {
                        $sqlwhere = "WHERE dp.propinsi_kode = '" . $propinsi_kode . "' AND dp.kota_kode = '" . $kota_kode . "'";

                      if (($searchtext != '') && ($searchfield != '')) {
                          $sqlwhere .= " AND LOWER(" . $searchfield .") LIKE '%". $searchtext ."%'";
                      }
                } else {
                        $sqlwhere = "WHERE dp.propinsi_kode = '" . $propinsi_kode . "'";

                        if (($searchtext != '') && ($searchfield != '')) {
                            $sqlwhere .= " AND LOWER(" . $searchfield .") LIKE '%". $searchtext ."%'";
                        }
                }
              
                if ($jadwalid > 0) {
                    $sqlwhere .= " AND dp.jadwalid = " . $jadwalid;
                }
                                                                        
            } else {
                  if ($kota_kode != '') {
                        $sqlwhere = "WHERE dp.kota_kode = '" . $kota_kode . "'";

                        if (($searchtext != '') && ($searchfield != '')) {
                            $sqlwhere .= " AND LOWER(" . $searchfield .") LIKE '%". $searchtext ."%'";
                        }
                          
                        if ($jadwalid > 0) {
                            $sqlwhere .= " AND dp.jadwalid = " . $jadwalid;
                        }
                          
                  } else {
                          if (($searchtext != '') && ($searchfield != '')) {
                                $sqlwhere = "WHERE LOWER(" . $searchfield .") LIKE '%". $searchtext ."%'";


                                if ($jadwalid > 0) {
                                    $sqlwhere .= " AND dp.jadwalid = " . $jadwalid;
                                }
                                
                          } else {
                                if ($jadwalid > 0) {
                                    $sqlwhere = " WHERE dp.jadwalid = " . $jadwalid;
                                } else {                              
                                    $sqlwhere = "";
                                }
                            
                          }
                  }                                    
            }
                                                
            if (($searchtext != '') && ($searchfield != '')) {
                $sqlwhere .= " AND LOWER(" . $searchfield .") LIKE '%". $searchtext ."%'";
            } 

            // echo 'wew';
            // break;

            if($sqlwhere == ""){
              $sqlwhere .= " WHERE dp.reg_awal IS NOT NULL AND dp.reg_ulang IS NULL ";}
            else
              {$sqlwhere .= " AND dp.reg_awal IS NOT NULL AND dp.reg_ulang IS NULL ";}
            
            // if($uKota == 0){
                        
                $sql1 = "SELECT COUNT(p.nama_propinsi) as total,"
                . "\n p.nama_propinsi," 
                . "\n k.nama_kota,"
                . "\n dk.kode, dk.nama_diklat, dp.kelas" 
                . "\n FROM (((diklat_peserta AS dp" 
                . "\n LEFT JOIN propinsi AS p ON dp.propinsi_kode = p.kode)" 
                . "\n LEFT JOIN kota AS k ON dp.kota_kode = k.kode)" 
                . "\n LEFT JOIN diklat_jadwal AS dj ON dp.jadwalid = dj.id)" 
                . "\n LEFT JOIN diklat AS dk ON dj.diklatid = dk.id" 
                . "\n $sqlwhere"
                . "\n GROUP BY p.nama_propinsi"
                . "\n ORDER BY p.kode";
              // } else {
                $sql2 = "SELECT COUNT(k.nama_kota) as total,"
                . "\n p.nama_propinsi," 
                . "\n k.nama_kota,"
                . "\n dk.kode, dk.nama_diklat, dp.kelas"  
                . "\n FROM (((diklat_peserta AS dp" 
                . "\n LEFT JOIN propinsi AS p ON dp.propinsi_kode = p.kode)" 
                . "\n LEFT JOIN kota AS k ON dp.kota_kode = k.kode)" 
                . "\n LEFT JOIN diklat_jadwal AS dj ON dp.jadwalid = dj.id)" 
                . "\n LEFT JOIN diklat AS dk ON dj.diklatid = dk.id" 
                . "\n $sqlwhere"
                . "\n GROUP BY k.nama_kota"
                . "\n ORDER BY p.kode";

              // }
    
        // echo 'wew';
        $result1 = $db->fetch_all($sql1);
        $result2 = $db->fetch_all($sql2);
        
  require_once(BASEPATH . 'lib/PHPExcel.php');
    
  // Create new PHPExcel object
  $objPHPExcel = new PHPExcel();

  // Set document properties
  $objPHPExcel->getProperties()->setCreator($core->company)
                                    ->setLastModifiedBy($core->company)
                                    ->setTitle("Laporan Data Registrasi Peserta Diklat")
                                    ->setSubject("Data Registrasi Peserta Diklat")
                                    ->setDescription("Data Registrasi Peserta Diklat.")
                                    ->setKeywords("PPPPTK BMTI Data Registrasi Peserta Diklat xls")
                                    ->setCategory("Data Master");

  $objPHPExcel->setActiveSheetIndex(0);

  $worksheet = $objPHPExcel->getActiveSheet();

  // Header : title : l1  & filter : l2
  if ($jadwalid > 0) 
    $judul = 1;
    // $worksheet->setCellValueByColumnAndRow(0, 1, 'Data Registrasi Peserta Diklat - ');
    //   else
  
  $filename="registrasi_pesertadiklat_semua.xls";
  $worksheet->setCellValueByColumnAndRow(0, 1, 'Data Registrasi Peserta Diklat (Semua)');
  $worksheet->setCellValueByColumnAndRow(0, 2, '');
  $worksheet->setCellValueByColumnAndRow(0, 3, 'Statistik Berdasarkan Provinsi');
  $worksheet->setCellValueByColumnAndRow(4, 3, 'Statistik Berdasarkan Kota');

  $worksheet->setCellValueByColumnAndRow(0, 4, 'Provinsi');
  $worksheet->setCellValueByColumnAndRow(1, 4, 'Jumlah Peserta');
  $worksheet->setCellValueByColumnAndRow(4, 4, 'Kota');
  $worksheet->setCellValueByColumnAndRow(5, 4, 'Provinsi');
  $worksheet->setCellValueByColumnAndRow(6, 4, 'Jumlah Peserta');

  // Data :
  $xrow = 5;
  foreach ($result1 as $v) {
    if ($judul > 0) {
      $worksheet->setCellValueByColumnAndRow(0, 1, 'Data Registrasi Peserta Diklat - KODE: '.$v->kode.'/'.$v->nama_diklat.' - Kelas '.$v->kelas);
      $filename = "registrasi_pesertadiklat_KODE_".$v->kode."_".$v->nama_diklat."_KELAS_".$v->kelas.".xls";
      $judul = 0;
    } 
    $worksheet->setCellValueByColumnAndRow(0, $xrow, $v->nama_propinsi);
    $worksheet->setCellValueByColumnAndRow(1, $xrow, $v->total);
    $xrow++;
  }
  unset($v);
  

  $xrow = 5;
  foreach ($result2 as $v) {
    $worksheet->setCellValueByColumnAndRow(4, $xrow, $v->nama_kota);
    $worksheet->setCellValueByColumnAndRow(5, $xrow, $v->nama_propinsi);
    $worksheet->setCellValueByColumnAndRow(6, $xrow, $v->total);
    $xrow++;
  }
  unset($v);
      
    // $worksheet->setCellValueByColumnAndRow(4, $xrow, $sql);
        
        
  // Rename worksheet
  $worksheet->setTitle('Registrasi Peserta Diklat');

  // Set active sheet index to the first sheet, so Excel opens this as the first sheet
  $objPHPExcel->setActiveSheetIndex(0);

  // Redirect output to a clients web browser (Excel5)


  header('Content-Type: application/vnd.ms-excel');
  header('Content-Disposition: attachment;filename='.$filename);
  header('Cache-Control: max-age=0');

  ob_end_clean();  
  $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
  $objWriter->save('php://output');
    
  exit();
  endif;
   
?>


<?php
  /* == Create Lembaga Report == */
  if (isset($_GET['action']) and $_GET['action'] == "createReportLembaga"):

        if(isset($_GET['propinsi_kode']))
            $propinsi_kode = $_GET['propinsi_kode'];
        else
            $propinsi_kode = '';

        if(isset($_GET['kota_kode']))
            $kota_kode = $_GET['kota_kode'];
        else
            $kota_kode = '';

        if(isset($_GET['searchfield']))
            $searchfield = $_GET['searchfield'];
        else
            $searchfield = 'nama';

        if(isset($_GET['searchtext']))
            $searchtext = $_GET['searchtext'];
        else
            $searchtext = '';
      
	ob_end_clean();  
	
	ob_start();
                
        if ($propinsi_kode != '') {
              if ($kota_kode != '') {
                    $sqlwhere = "WHERE l.propinsi_kode = '" . $propinsi_kode . "' AND l.kota_kode = '" . $kota_kode ."'";
                      
                    if (($searchtext != '') && ($searchfield != ''))
                        $sqlwhere .= " AND LOWER(s." . $searchfield .") LIKE '%". $searchtext ."%'";
              } else {
                      $sqlwhere = "WHERE l.propinsi_kode = '" . $propinsi_kode . "'";
                      
                      if (($searchtext != '') && ($searchfield != ''))
                          $sqlwhere .= " AND LOWER(s." . $searchfield .") LIKE '%". $searchtext ."%'";
              }
        } else {
              if ($kota_kode != '') {
                      $sqlwhere = "WHERE l.kota_kode = '" . $kota_kode . "'";
                      
                      if (($searchtext != '') && ($searchfield != ''))
                          $sqlwhere .= " AND LOWER(s." . $searchfield .") LIKE '%". $searchtext ."%'";
                      
              } else {

                      if (($searchtext != '') && ($searchfield != ''))
                        $sqlwhere = "WHERE LOWER(l." . $searchfield .") LIKE '%". $searchtext ."%'";
                      else
                        $sqlwhere = "";
              }
        }
        
	$sql = "SELECT l.id, l.nama_lembaga, l.propinsi_kode, l.kota_kode, l.alamat, l.nama_pimpinan," 
		  . "\n p.nama_propinsi," 
		  . "\n k.nama_kota" 
		  . "\n FROM (lembaga as l" 
		  . "\n LEFT JOIN propinsi as p ON l.propinsi_kode = p.kode)" 
		  . "\n LEFT JOIN kota as k ON l.kota_kode = k.kode" 
		  . "\n $sqlwhere" 
		  . "\n ORDER BY l.nama_lembaga";
	  
	$result = $db->fetch_all($sql);
	  	 
	require_once(BASEPATH . 'lib/PHPExcel.php');
		
	// Create new PHPExcel object
	$objPHPExcel = new PHPExcel();

	// Set document properties
	$objPHPExcel->getProperties()->setCreator($core->company)
                                    ->setLastModifiedBy($core->company)
                                    ->setTitle("Laporan Data Lembaga")
                                    ->setSubject("Data Lembaga")
                                    ->setDescription("Laporan Data Lembaga.")
                                    ->setKeywords("PPPPTK BMTI Data Lembaga xls")
                                    ->setCategory("Data Master");

	$objPHPExcel->setActiveSheetIndex(0);

	$worksheet = $objPHPExcel->getActiveSheet();

	// Header : title : l1  & filter : l2
	
	$worksheet->setCellValueByColumnAndRow(0, 1, 'Data Lembaga');
	$worksheet->setCellValueByColumnAndRow(0, 2, 'Propinsi');
	$worksheet->setCellValueByColumnAndRow(0, 3, '');

	$worksheet->setCellValueByColumnAndRow(0, 4, 'Nama Lembaga');
	$worksheet->setCellValueByColumnAndRow(1, 4, 'Alamat');
	$worksheet->setCellValueByColumnAndRow(2, 4, 'Propinsi');
	$worksheet->setCellValueByColumnAndRow(3, 4, 'Kota');
	$worksheet->setCellValueByColumnAndRow(4, 4, 'Nama Pimpinan');
        
	// Data :
	$xrow = 5;
	foreach ($result as $v) {
		$worksheet->setCellValueByColumnAndRow(0, $xrow, $v->nama_lembaga);
		$worksheet->setCellValueByColumnAndRow(1, $xrow, $v->alamat);
		$worksheet->setCellValueByColumnAndRow(2, $xrow, $v->nama_propinsi);
		$worksheet->setCellValueByColumnAndRow(3, $xrow, $v->nama_kota);
		$worksheet->setCellValueByColumnAndRow(4, $xrow, $v->nama_pimpinan);
		$xrow++;
	}
	unset($v);
			
	// Rename worksheet
	$worksheet->setTitle('Lembaga');

	// Set active sheet index to the first sheet, so Excel opens this as the first sheet
	$objPHPExcel->setActiveSheetIndex(0);

	// Redirect output to a client�s web browser (Excel5)
	header('Content-Type: application/vnd.ms-excel');
	header('Content-Disposition: attachment;filename="lembaga.xls"');
	header('Cache-Control: max-age=0');

	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
	$objWriter->save('php://output');
	  	  
	exit();
  endif;
?>

<?php
  /* == Create Staff Report == */
  if (isset($_GET['action']) and $_GET['action'] == "createReportStaff"):
  
        if(isset($_GET['propinsi_kode']))
            $propinsi_kode = $_GET['propinsi_kode'];
        else
            $propinsi_kode = '';

        if(isset($_GET['kota_kode']))
            $kota_kode = $_GET['kota_kode'];
        else
            $kota_kode = '';

        if(isset($_GET['searchfield']))
            $searchfield = $_GET['searchfield'];
        else
            $searchfield = 'nama';

        if(isset($_GET['searchtext']))
            $searchtext = $_GET['searchtext'];
        else
            $searchtext = '';
            
	ob_end_clean();  
	
	ob_start();
                    
        if ($propinsi_kode != '') {
              if ($kota_kode != '') {
                    $sqlwhere = "WHERE s.propinsi_kode = '" . $propinsi_kode . "' AND s.kota_kode = '" . $kota_kode . "'";
                      
                    if (($searchtext != '') && ($searchfield != ''))
                        $sqlwhere .= " AND LOWER(s." . $searchfield .") LIKE '%". $searchtext ."%'";
              } else {
                      $sqlwhere = "WHERE s.propinsi_kode = '" . $propinsi_kode . "'";
                      
                      if (($searchtext != '') && ($searchfield != ''))
                          $sqlwhere .= " AND LOWER(s." . $searchfield .") LIKE '%". $searchtext ."%'";
              }
        } else {
              if ($kota_kode != '') {
                      $sqlwhere = "WHERE s.kota_kode = '" . $kota_kode . "'";
                      
                      if (($searchtext != '') && ($searchfield != ''))
                          $sqlwhere .= " AND LOWER(s." . $searchfield .") LIKE '%". $searchtext ."%'";
                      
              } else {

                      if (($searchtext != '') && ($searchfield != ''))
                        $sqlwhere = "WHERE LOWER(s." . $searchfield .") LIKE '%". $searchtext ."%'";
                      else
                        $sqlwhere = "";
              }
        }
           
        $sql = "SELECT s.*, l.nama_lembaga," 
        . "\n p.nama_propinsi," 
        . "\n k.nama_kota" 
        . "\n FROM ((staff as s" 
        . "\n LEFT JOIN lembaga as l ON s.lembagaid = l.id)" 
        . "\n LEFT JOIN propinsi as p ON s.propinsi_kode = p.kode)"
        . "\n LEFT JOIN kota as k ON s.kota_kode = k.kode"
        . "\n $sqlwhere"         
        . "\n ORDER BY s.nama_lengkap";

        $result = $db->fetch_all($sql);
	  
	require_once(BASEPATH . 'lib/PHPExcel.php');
		
	// Create new PHPExcel object
	$objPHPExcel = new PHPExcel();

	// Set document properties
	$objPHPExcel->getProperties()->setCreator($core->company)
                                    ->setLastModifiedBy($core->company)
                                    ->setTitle("Laporan Data Staff")
                                    ->setSubject("Data Staff")
                                    ->setDescription("Laporan Staff.")
                                    ->setKeywords("PPPPTK BMTI Data Staff xls")
                                    ->setCategory("Data Master");

	$objPHPExcel->setActiveSheetIndex(0);

	$worksheet = $objPHPExcel->getActiveSheet();

	// Header : title : l1  & filter : l2
	
	$worksheet->setCellValueByColumnAndRow(0, 1, 'Data Staff');
	$worksheet->setCellValueByColumnAndRow(0, 2, 'Propinsi');
	$worksheet->setCellValueByColumnAndRow(0, 3, '');

	$worksheet->setCellValueByColumnAndRow(0, 4, 'NIP');
	$worksheet->setCellValueByColumnAndRow(1, 4, 'Nama Lengkap');
	$worksheet->setCellValueByColumnAndRow(2, 4, 'Alamat');
	$worksheet->setCellValueByColumnAndRow(3, 4, 'Lembaga');
	$worksheet->setCellValueByColumnAndRow(4, 4, 'Propinsi');
	$worksheet->setCellValueByColumnAndRow(5, 4, 'Kota');

	// Data :
	$xrow = 5;
	foreach ($result as $v) {
		$worksheet->setCellValueByColumnAndRow(0, $xrow, $v->nip);
                
                $nama_lengkap = $v->nama_lengkap;
                if ($v->gelar_depan3 != '') $nama_lengkap = $v->gelar_depan3.' '.$nama_lengkap;
                if ($v->gelar_depan2 != '') $nama_lengkap = $v->gelar_depan2.' '.$nama_lengkap;
                if ($v->gelar_depan1 != '') $nama_lengkap = $v->gelar_depan1.' '.$nama_lengkap;

                if ($v->gelar_belakang1 != '') $nama_lengkap .= ' '.$v->gelar_belakang1;
                if ($v->gelar_belakang2 != '') $nama_lengkap .= ' '.$v->gelar_belakang2;
                if ($v->gelar_belakang3 != '') $nama_lengkap .= ' '.$v->gelar_belakang3;                
                                
		$worksheet->setCellValueByColumnAndRow(1, $xrow, $nama_lengkap);
		$worksheet->setCellValueByColumnAndRow(2, $xrow, $v->alamat);
		$worksheet->setCellValueByColumnAndRow(3, $xrow, $v->nama_lembaga);
		$worksheet->setCellValueByColumnAndRow(4, $xrow, $v->nama_propinsi);
		$worksheet->setCellValueByColumnAndRow(5, $xrow, $v->nama_kota);
                
		$xrow++;
	}
	unset($v);
        
	// Rename worksheet
	$worksheet->setTitle('Staff');

	// Set active sheet index to the first sheet, so Excel opens this as the first sheet
	$objPHPExcel->setActiveSheetIndex(0);

	// Redirect output to a clients web browser (Excel5)
	header('Content-Type: application/vnd.ms-excel');
	header('Content-Disposition: attachment;filename="staff.xls"');
	header('Cache-Control: max-age=0');

	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
	$objWriter->save('php://output');
	  
	exit();
  endif;
?>

<?php
  /* == Create PTK_DiklatMinat Report == */
  if (isset($_GET['action']) and $_GET['action'] == "createReportPTK_DiklatMinat"):
  
        if(isset($_GET['diklatid']))
            $diklatid = $_GET['diklatid'];
        else
            $diklatid = 0;

        if(isset($_GET['diklat_tahun']))
            $diklat_tahun = $_GET['diklat_tahun'];
        else
            $diklat_tahun = date('Y');
            
        if(isset($_GET['propinsi_kode']))
            $propinsi_kode = $_GET['propinsi_kode'];
        else
            $propinsi_kode = '';

        if(isset($_GET['kota_kode']))
            $kota_kode = $_GET['kota_kode'];
        else
            $kota_kode = '';

        if(isset($_GET['searchfield']))
            $searchfield = $_GET['searchfield'];
        else
            $searchfield = 'nama';

        if(isset($_GET['searchtext']))
            $searchtext = $_GET['searchtext'];
        else
            $searchtext = '';
            
	ob_end_clean();  
	
	ob_start();
                    
        if ($propinsi_kode != '') {
              if ($kota_kode != '') {
                    $sqlwhere = "WHERE pt.propinsi_kode = '" . $propinsi_kode . "' AND pt.kota_kode = '" . $kota_kode . "'";
                      
                    if ($diklatid > 0) {
                     
                        $sqlwhere .= " AND (ptdm.diklatid = " . $diklatid . " AND ptdm.tahun = " . $diklat_tahun . ")";
                        
                    }
                                        
                    if (($searchtext != '') && ($searchfield != ''))
                        $sqlwhere .= " AND LOWER(pt." . $searchfield .") LIKE '%". $searchtext ."%'";
              } else {
                    $sqlwhere = "WHERE pt.propinsi_kode = '" . $propinsi_kode . "'";

                    if ($diklatid > 0) {
                     
                        $sqlwhere .= " AND (ptdm.diklatid = " . $diklatid . " AND ptdm.tahun = " . $diklat_tahun . ")";
                        
                    }
                                        
                    if (($searchtext != '') && ($searchfield != ''))
                        $sqlwhere .= " AND LOWER(pt." . $searchfield .") LIKE '%". $searchtext ."%'";
              }
        } else {
              if ($kota_kode != '') {
                    $sqlwhere = "WHERE pt.kota_kode = '" . $kota_kode . "'";
                      
                    if ($diklatid > 0) {
                     
                        $sqlwhere .= " AND (ptdm.diklatid = " . $diklatid . " AND ptdm.tahun = " . $diklat_tahun . ")";
                        
                    }
                                            
                    if (($searchtext != '') && ($searchfield != ''))
                        $sqlwhere .= " AND LOWER(pt." . $searchfield .") LIKE '%". $searchtext ."%'";
                      
              } else {

                    if ($diklatid > 0) {
                     
                        $sqlwhere = " WHERE (ptdm.diklatid = " . $diklatid . " AND ptdm.tahun = " . $diklat_tahun . ")";
                        
                    }
                                    
                    if (($searchtext != '') && ($searchfield != '')) {
                        $sqlwhere = "WHERE LOWER(pt." . $searchfield .") LIKE '%". $searchtext ."%'";
                      
                    } else {
                        
                        if ($diklatid == 0)  
                            $sqlwhere = "";
                      
                    }
              }
        }
           
        $sql = "SELECT ptdm.id, ptdm.ptkid, ptdm.diklatid, ptdm.tahun,"
                . "\n pt.sekolahid,pt.gelar_depan1,pt.gelar_depan2,pt.gelar_depan3,pt.nama_lengkap,pt.gelar_belakang1,pt.gelar_belakang2,pt.gelar_belakang3,pt.nuptk,pt.nip,pt.alamat," 
                . "\n s.nama_sekolah," 
                . "\n p.nama_propinsi," 
                . "\n k.nama_kota," 
                
                . "\n dk.kode, dk.nama_diklat" 
                
                . "\n FROM ((((ptk_diklatminat AS ptdm" 
                . "\n LEFT JOIN ptk AS pt ON ptdm.ptkid = pt.id)" 
                . "\n LEFT JOIN sekolah AS s ON pt.sekolahid = s.id)" 
                . "\n LEFT JOIN propinsi AS p ON pt.propinsi_kode = p.kode)" 
                . "\n LEFT JOIN kota AS k ON pt.kota_kode = k.kode)" 
                . "\n LEFT JOIN diklat AS dk ON ptdm.diklatid = dk.id" 
                . "\n $sqlwhere" 
                . "\n ORDER BY pt.nama_lengkap";
        
        $result = $db->fetch_all($sql);
	  
	require_once(BASEPATH . 'lib/PHPExcel.php');
		
	// Create new PHPExcel object
	$objPHPExcel = new PHPExcel();

	// Set document properties
	$objPHPExcel->getProperties()->setCreator($core->company)
                                    ->setLastModifiedBy($core->company)
                                    ->setTitle("Laporan Data Minat Diklat GTK")
                                    ->setSubject("Data Minat Diklat GTK")
                                    ->setDescription("Laporan Data Minat Diklat GTK.")
                                    ->setKeywords("PPPPTK BMTI Data Minat Diklat xls")
                                    ->setCategory("Data Master");

	$objPHPExcel->setActiveSheetIndex(0);

	$worksheet = $objPHPExcel->getActiveSheet();

	// Header : title : l1  & filter : l2
	
	$worksheet->setCellValueByColumnAndRow(0, 1, 'Data Minat Diklat GTK');
	$worksheet->setCellValueByColumnAndRow(0, 2, 'Propinsi');
	$worksheet->setCellValueByColumnAndRow(0, 3, '');

	$worksheet->setCellValueByColumnAndRow(0, 4, 'NUPTK');
	$worksheet->setCellValueByColumnAndRow(1, 4, 'Nama Lengkap');
	$worksheet->setCellValueByColumnAndRow(2, 4, 'NIP');
	$worksheet->setCellValueByColumnAndRow(3, 4, 'Sekolah');
	$worksheet->setCellValueByColumnAndRow(4, 4, 'Propinsi');
	$worksheet->setCellValueByColumnAndRow(5, 4, 'Kota');

        if ($diklatid == 0) {
            
            $worksheet->setCellValueByColumnAndRow(6, 4, 'Kode Diklat');
            $worksheet->setCellValueByColumnAndRow(7, 4, 'Nama Diklat');
            
        }
        
	// Data :
	$xrow = 5;
	foreach ($result as $v) {
		$worksheet->setCellValueByColumnAndRow(0, $xrow, $v->nuptk);
                
                $nama_lengkap = $v->nama_lengkap;
                if ($v->gelar_depan3 != '') $nama_lengkap = $v->gelar_depan3.' '.$nama_lengkap;
                if ($v->gelar_depan2 != '') $nama_lengkap = $v->gelar_depan2.' '.$nama_lengkap;
                if ($v->gelar_depan1 != '') $nama_lengkap = $v->gelar_depan1.' '.$nama_lengkap;

                if ($v->gelar_belakang1 != '') $nama_lengkap .= ' '.$v->gelar_belakang1;
                if ($v->gelar_belakang2 != '') $nama_lengkap .= ' '.$v->gelar_belakang2;
                if ($v->gelar_belakang3 != '') $nama_lengkap .= ' '.$v->gelar_belakang3;                
                                
		$worksheet->setCellValueByColumnAndRow(1, $xrow, $nama_lengkap);
		$worksheet->setCellValueByColumnAndRow(2, $xrow, $v->nip);
		$worksheet->setCellValueByColumnAndRow(3, $xrow, $v->nama_sekolah);
		$worksheet->setCellValueByColumnAndRow(4, $xrow, $v->nama_propinsi);
		$worksheet->setCellValueByColumnAndRow(5, $xrow, $v->nama_kota);

                if ($diklatid == 0) {

                    $worksheet->setCellValueByColumnAndRow(6, $xrow, $v->kode);
                    $worksheet->setCellValueByColumnAndRow(7, $xrow, $v->nama_diklat);

                }
                                
		$xrow++;
	}
	unset($v);
        
	// Rename worksheet
	$worksheet->setTitle('Minat Diklat GTK');

	// Set active sheet index to the first sheet, so Excel opens this as the first sheet
	$objPHPExcel->setActiveSheetIndex(0);

	// Redirect output to a clients web browser (Excel5)
	header('Content-Type: application/vnd.ms-excel');
	header('Content-Disposition: attachment;filename="minat_diklat_ptk.xls"');
	header('Cache-Control: max-age=0');

	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
	$objWriter->save('php://output');
	  
	exit();
  endif;
?>

<?php
  /* == Create Absensi_Diklat Print == */
  if (isset($_GET['action']) and $_GET['action'] == "createAbsensiDiklat_Peserta"):

        if(isset($_GET['jadwalid']))
            $jadwalid = $_GET['jadwalid'];
        else
            $jadwalid = 0;

        if(isset($_GET['tanggal']))
            $tanggal = $_GET['tanggal'];
        else
            $tanggal = date('Y/m/d');

    
            $sql = "SELECT dp.*,"
                    . "\n p.nama_propinsi," 
                    . "\n k.nama_kota," 
                    . "\n da.id as absenid, da.status, da.tanggal, da.waktu" 
                    . "\n FROM ((diklat_peserta AS dp" 
                    . "\n LEFT JOIN propinsi AS p ON dp.propinsi_kode = p.kode)" 
                    . "\n LEFT JOIN kota AS k ON dp.kota_kode = k.kode)" 
                    . "\n LEFT JOIN diklat_absen AS da ON da.pesertaid = dp.id AND da.tanggal = '" . $tanggal . "'"
                    . "\n WHERE dp.jadwalid = " . $jadwalid
                    . "\n ORDER BY dp.nama_lengkap";



        $result = $db->fetch_all($sql);
        
        if ($result) {
            print '<html><style type="text/css">'
                   .'body, th, td {font-family:arial,sans-serif; font-size: 100%; margin:20;}'
                   .'a:link, a:active, a:visited{color:#0000CC}'
                   .'.si td {border: solid 1px #aaaaaa;padding:10px; line-height:140%; white-space: nowrap;}</style>'
                   .'<script type="text/javascript"> function p() { window.print(); } </script></head>'
                   .'<body onload="p()"><b>Absensi Peserta Diklat</b><br><br>'
                   .'<div class="si"><table>';

            print '<tr><td>No.</td><td>NUPTK</td><td>Nama Lengkap</td>'
             .'<td>Sekolah</td><td>Propinsi</td><td>Kota</td><td>Status</td><td>Waktu</td></tr>';
            
            $no = 0;
            foreach ($result as $v) {

                    $no++;
                    print '<tr><td>' . $no . '.</td><td>' . $v->nuptk . '</td><td>' . $v->nama_lengkap . '</td><td>'
                     .$v->nama_sekolah . '</td><td>'
                     .$v->nama_propinsi . '</td><td>' .$v->nama_kota . '</td><td>' .$v->status . '</td><td>' .$v->waktu . '</td></tr>';

            }
            unset($v);
            
        }
         
        print '</table></div></body></html>';
        
  endif;
?>

<?php
  /* == Create Absensi Peserta Diklat == */
  if (isset($_GET['action']) and $_GET['action'] == "createAbsensiDiklat_Peserta"):
          
        if(isset($_GET['jadwalid']))
            $jadwalid = $_GET['jadwalid'];
        else
            $jadwalid = 0;
        
  ob_end_clean();  
  
  ob_start();

        // if ($jadwalid > 0) 
        //     $sqlwhere = "WHERE dp.jadwalid = " . $jadwalid;
        // else
        //     $sqlwhere = "";
           
       $sql = "SELECT dp.*,"
                    . "\n p.nama_propinsi," 
                    . "\n k.nama_kota," 
                    . "\n da.id as absenid, da.status, da.tanggal, da.waktu" 
                    . "\n FROM ((diklat_peserta AS dp" 
                    . "\n LEFT JOIN propinsi AS p ON dp.propinsi_kode = p.kode)" 
                    . "\n LEFT JOIN kota AS k ON dp.kota_kode = k.kode)" 
                    . "\n LEFT JOIN diklat_absen AS da ON da.pesertaid = dp.id AND da.tanggal = '" . $tanggal . "'"
                    . "\n WHERE dp.jadwalid = " . $jadwalid
                    . "\n ORDER BY dp.nama_lengkap";
        
        $result = $db->fetch_all($sql);
    
  require_once(BASEPATH . 'lib/PHPExcel.php');
    
  // Create new PHPExcel object
  $objPHPExcel = new PHPExcel();

  // Set document properties
  $objPHPExcel->getProperties()->setCreator($core->company)
                                    ->setLastModifiedBy($core->company)
                                    ->setTitle("Absensi Peserta Diklat")
                                    ->setSubject("Absensi Peserta Diklat")
                                    ->setDescription("Absensi Peserta Diklat.")
                                    ->setKeywords("PPPPTK BMTI Absensi Peserta Diklat xls")
                                    ->setCategory("Data Master");

  $objPHPExcel->setActiveSheetIndex(0);

  $worksheet = $objPHPExcel->getActiveSheet();

  // Header : title : l1  & filter : l2
  
    $worksheet->setCellValueByColumnAndRow(0, 1, 'Absensi Peserta Diklat');
    $worksheet->setCellValueByColumnAndRow(0, 2, 'Diklat');
    $worksheet->setCellValueByColumnAndRow(0, 3, '');

    $worksheet->setCellValueByColumnAndRow(0, 4, 'No.');
    $worksheet->setCellValueByColumnAndRow(1, 4, 'NUPTK');
    $worksheet->setCellValueByColumnAndRow(2, 4, 'Nama Lengkap');
    $worksheet->setCellValueByColumnAndRow(3, 4, 'Sekolah');
    $worksheet->setCellValueByColumnAndRow(4, 4, 'Propinsi');
    $worksheet->setCellValueByColumnAndRow(5, 4, 'Kota');
    $worksheet->setCellValueByColumnAndRow(6, 4, 'Status');
    $worksheet->setCellValueByColumnAndRow(7, 4, 'Waktu');

  // Data :
    $no = 0;
  $xrow = 5;
  foreach ($result as $v) {
    $no +=1;
            
                $nama_lengkap = $v->nama_lengkap;
                if ($v->gelar_depan3 != '') $nama_lengkap = $v->gelar_depan3.' '.$nama_lengkap;
                if ($v->gelar_depan2 != '') $nama_lengkap = $v->gelar_depan2.' '.$nama_lengkap;
                if ($v->gelar_depan1 != '') $nama_lengkap = $v->gelar_depan1.' '.$nama_lengkap;

                if ($v->gelar_belakang1 != '') $nama_lengkap .= ' '.$v->gelar_belakang1;
                if ($v->gelar_belakang2 != '') $nama_lengkap .= ' '.$v->gelar_belakang2;
                if ($v->gelar_belakang3 != '') $nama_lengkap .= ' '.$v->gelar_belakang3;                
                        
    // $worksheet->setCellValueByColumnAndRow(0, $xrow, $no);
    // $worksheet->setCellValueByColumnAndRow(1, $xrow, $v->nuptk);

    // $worksheet->setCellValueByColumnAndRow(2, $xrow, $nama_lengkap);
    // $worksheet->setCellValueByColumnAndRow(3, $xrow, $v->nama_sekolah);
    // $worksheet->setCellValueByColumnAndRow(4, $xrow, $v->nama_propinsi);
    // $worksheet->setCellValueByColumnAndRow(5, $xrow, $v->nama_kota);
                
    // $worksheet->setCellValueByColumnAndRow(6, $xrow, $v->status);
    // $worksheet->setCellValueByColumnAndRow(7, $xrow, $v->waktu);

    $worksheet->setCellValueByColumnAndRow(0, $xrow, $no);
    $worksheet->setCellValueExplicitByColumnAndRow(1, $xrow, $v->nuptk,
                        PHPExcel_Cell_DataType::TYPE_STRING);
    $worksheet->setCellValueExplicitByColumnAndRow(2, $xrow, $nama_lengkap,
                        PHPExcel_Cell_DataType::TYPE_STRING);
    $worksheet->setCellValueExplicitByColumnAndRow(3, $xrow, $v->nama_sekolah,
                        PHPExcel_Cell_DataType::TYPE_STRING);
    $worksheet->setCellValueExplicitByColumnAndRow(4, $xrow, $v->nama_propinsi,
                        PHPExcel_Cell_DataType::TYPE_STRING);
    $worksheet->setCellValueExplicitByColumnAndRow(5, $xrow, $v->nama_kota,
                        PHPExcel_Cell_DataType::TYPE_STRING);
    $worksheet->setCellValueExplicitByColumnAndRow(6, $xrow, $v->status,
                        PHPExcel_Cell_DataType::TYPE_STRING);
    $worksheet->setCellValueExplicitByColumnAndRow(7, $xrow, $v->waktu,
                        PHPExcel_Cell_DataType::TYPE_STRING);

                
    $xrow++;
  }
  unset($v);
      
    // $worksheet->setCellValueByColumnAndRow(4, $xrow, $sql);
        
        
  // Rename worksheet
  $worksheet->setTitle('Absensi Peserta Diklat');

  // Set active sheet index to the first sheet, so Excel opens this as the first sheet
  $objPHPExcel->setActiveSheetIndex(0);

  // Redirect output to a clients web browser (Excel5)
  header('Content-Type: application/vnd.ms-excel');
  header('Content-Disposition: attachment;filename="absensi_peserta_diklat.xls"');
  header('Cache-Control: max-age=0');

  $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
  $objWriter->save('php://output');
    
  exit();
  endif;
   
?>


<?php
  /* == Create Validasi Sertifikat Report == */
  if (isset($_GET['action']) and $_GET['action'] == "createReportDiklat_Sertitifat_Validasi"):
          
        if(isset($_GET['jadwalid']))
            $jadwalid = $_GET['jadwalid'];
        else
            $jadwalid = 0;
        
	ob_end_clean();  
	
	ob_start();

        if ($jadwalid > 0) 
            $sqlwhere = "WHERE dp.jadwalid = " . $jadwalid;
        else
            $sqlwhere = "";
           
        $sql = "SELECT dp.*,"
        . "\n p.nama_propinsi," 
        . "\n k.nama_kota," 
        . "\n gol.nama_pangkat,gol.nama_fungsional," 
        . "\n dk.nama_diklat,dk.jml_jam," 
        . "\n dj.tgl_mulai,dj.tgl_akhir,dj.tempat" 
        . "\n FROM ((((diklat_peserta AS dp" 
        . "\n LEFT JOIN propinsi AS p ON dp.propinsi_kode = p.kode)" 
        . "\n LEFT JOIN kota AS k ON dp.kota_kode = k.kode)" 
        . "\n LEFT JOIN diklat_jadwal AS dj ON dp.jadwalid = dj.id)" 
        . "\n LEFT JOIN diklat AS dk ON dj.diklatid = dk.id)" 
        . "\n LEFT JOIN golongan AS gol ON dp.golongan = gol.kode" 
        . "\n $sqlwhere" 
        . "\n ORDER BY dp.nama_lengkap";
        
        $result = $db->fetch_all($sql);
	  
	require_once(BASEPATH . 'lib/PHPExcel.php');
		
	// Create new PHPExcel object
	$objPHPExcel = new PHPExcel();

	// Set document properties
	$objPHPExcel->getProperties()->setCreator($core->company)
                                    ->setLastModifiedBy($core->company)
                                    ->setTitle("Laporan Data Validasi Peserta Diklat")
                                    ->setSubject("Data Validasi Peserta Diklat")
                                    ->setDescription("Data Validasi Peserta Diklat.")
                                    ->setKeywords("PPPPTK BMTI Data Validasi Peserta xls")
                                    ->setCategory("Data Master");

	$objPHPExcel->setActiveSheetIndex(0);

	$worksheet = $objPHPExcel->getActiveSheet();

	// Header : title : l1  & filter : l2
	
	$worksheet->setCellValueByColumnAndRow(0, 1, 'Data Peserta Diklat');
	$worksheet->setCellValueByColumnAndRow(0, 2, 'Diklat');
	$worksheet->setCellValueByColumnAndRow(0, 3, '');

	$worksheet->setCellValueByColumnAndRow(0, 4, 'Nama Lengkap');
        $worksheet->setCellValueByColumnAndRow(1, 4, 'NIP');
        $worksheet->setCellValueByColumnAndRow(2, 4, 'NUPTK');
        $worksheet->setCellValueByColumnAndRow(3, 4, 'GOL');
        $worksheet->setCellValueByColumnAndRow(4, 4, 'Pangkat');
        $worksheet->setCellValueByColumnAndRow(5, 4, 'JK');

        $worksheet->setCellValueByColumnAndRow(6, 4, 'Tmp Lahir');
        $worksheet->setCellValueByColumnAndRow(7, 4, 'Tgl Lahir');
        $worksheet->setCellValueByColumnAndRow(8, 4, 'Jabatan Fungsional');
        $worksheet->setCellValueByColumnAndRow(9, 4, 'Agama');
        $worksheet->setCellValueByColumnAndRow(10, 4, 'Pendidikan Terakhir');
        $worksheet->setCellValueByColumnAndRow(11, 4, 'Jurusan');

        $worksheet->setCellValueByColumnAndRow(12, 4, 'Thn Lulus');
        $worksheet->setCellValueByColumnAndRow(13, 4, 'Alamat');
	$worksheet->setCellValueByColumnAndRow(14, 4, 'Kab/Kota');
	$worksheet->setCellValueByColumnAndRow(15, 4, 'Propinsi');
	$worksheet->setCellValueByColumnAndRow(16, 4, 'No. HP');
	$worksheet->setCellValueByColumnAndRow(17, 4, 'NSS');        

        $worksheet->setCellValueByColumnAndRow(18, 4, 'Sekolah');
	$worksheet->setCellValueByColumnAndRow(19, 4, 'Status');
	$worksheet->setCellValueByColumnAndRow(20, 4, 'Kepala Sekolah');
	$worksheet->setCellValueByColumnAndRow(21, 4, 'Alamat Sekolah');
	$worksheet->setCellValueByColumnAndRow(22, 4, 'Telepon');
	$worksheet->setCellValueByColumnAndRow(23, 4, 'Fax');

        $worksheet->setCellValueByColumnAndRow(24, 4, 'KodePos');
	$worksheet->setCellValueByColumnAndRow(25, 4, 'E-Mail');
	$worksheet->setCellValueByColumnAndRow(26, 4, 'WebSite');
	$worksheet->setCellValueByColumnAndRow(27, 4, 'Kab/Kota');
	$worksheet->setCellValueByColumnAndRow(28, 4, 'Propinsi');

        $worksheet->setCellValueByColumnAndRow(29, 4, 'Nama Diklat');
	$worksheet->setCellValueByColumnAndRow(30, 4, 'Mulai');
	$worksheet->setCellValueByColumnAndRow(31, 4, 'Sampai');
	$worksheet->setCellValueByColumnAndRow(32, 4, 'Tempat');
	$worksheet->setCellValueByColumnAndRow(33, 4, 'Pola(Jam)');

	// Data :
	$xrow = 5;
	foreach ($result as $v) {
            
                $nama_lengkap = $v->nama_lengkap;
                if ($v->gelar_depan3 != '') $nama_lengkap = $v->gelar_depan3.' '.$nama_lengkap;
                if ($v->gelar_depan2 != '') $nama_lengkap = $v->gelar_depan2.' '.$nama_lengkap;
                if ($v->gelar_depan1 != '') $nama_lengkap = $v->gelar_depan1.' '.$nama_lengkap;

                if ($v->gelar_belakang1 != '') $nama_lengkap .= ' '.$v->gelar_belakang1;
                if ($v->gelar_belakang2 != '') $nama_lengkap .= ' '.$v->gelar_belakang2;
                if ($v->gelar_belakang3 != '') $nama_lengkap .= ' '.$v->gelar_belakang3;                
                        
		$worksheet->setCellValueByColumnAndRow(0, $xrow, $nama_lengkap);
		$worksheet->setCellValueByColumnAndRow(1, $xrow, $v->nip);
		$worksheet->setCellValueByColumnAndRow(2, $xrow, $v->nuptk);
		$worksheet->setCellValueByColumnAndRow(3, $xrow, $v->golongan);
		$worksheet->setCellValueByColumnAndRow(4, $xrow, $v->nama_pangkat);
		$worksheet->setCellValueByColumnAndRow(5, $xrow, $v->jns_klmn);
                
		$worksheet->setCellValueByColumnAndRow(6, $xrow, $v->tmp_lahir);
		$worksheet->setCellValueByColumnAndRow(7, $xrow, $v->tgl_lahir);
		$worksheet->setCellValueByColumnAndRow(8, $xrow, $v->nama_fungsional);
		$worksheet->setCellValueByColumnAndRow(9, $xrow, $v->agama);
		$worksheet->setCellValueByColumnAndRow(10, $xrow, $v->pendidikan_akhir);
		$worksheet->setCellValueByColumnAndRow(11, $xrow, $v->jurusan_akhir);

		$worksheet->setCellValueByColumnAndRow(12, $xrow, $v->tahun_lulus_akhir);
		$worksheet->setCellValueByColumnAndRow(13, $xrow, $v->alamat);
		$worksheet->setCellValueByColumnAndRow(14, $xrow, $v->nama_kota);
		$worksheet->setCellValueByColumnAndRow(15, $xrow, $v->nama_propinsi);
		$worksheet->setCellValueByColumnAndRow(16, $xrow, $v->telepon2);
		$worksheet->setCellValueByColumnAndRow(17, $xrow, $v->nss);

		$worksheet->setCellValueByColumnAndRow(18, $xrow, $v->nama_sekolah);
		$worksheet->setCellValueByColumnAndRow(19, $xrow, $v->status_sekolah);
		$worksheet->setCellValueByColumnAndRow(20, $xrow, $v->nama_pimpinan);
		$worksheet->setCellValueByColumnAndRow(21, $xrow, $v->alamat_sekolah);
		$worksheet->setCellValueByColumnAndRow(22, $xrow, $v->telepon_sekolah);
		$worksheet->setCellValueByColumnAndRow(23, $xrow, $v->fax_sekolah);

		$worksheet->setCellValueByColumnAndRow(24, $xrow, $v->kodepos_sekolah);
		$worksheet->setCellValueByColumnAndRow(25, $xrow, $v->email);
		$worksheet->setCellValueByColumnAndRow(26, $xrow, $v->website);
		$worksheet->setCellValueByColumnAndRow(27, $xrow, $v->nama_kota);
		$worksheet->setCellValueByColumnAndRow(28, $xrow, $v->nama_propinsi);
                
		$worksheet->setCellValueByColumnAndRow(29, $xrow, $v->nama_diklat);
		$worksheet->setCellValueByColumnAndRow(30, $xrow, $v->tgl_mulai);
		$worksheet->setCellValueByColumnAndRow(31, $xrow, $v->tgl_akhir);
		$worksheet->setCellValueByColumnAndRow(32, $xrow, $v->tempat);
		$worksheet->setCellValueByColumnAndRow(33, $xrow, $v->jml_jam);
                
		$xrow++;
	}
	unset($v);
			
		// $worksheet->setCellValueByColumnAndRow(4, $xrow, $sql);
        
        
	// Rename worksheet
	$worksheet->setTitle('Validasi Peserta Diklat');

	// Set active sheet index to the first sheet, so Excel opens this as the first sheet
	$objPHPExcel->setActiveSheetIndex(0);

	// Redirect output to a clients web browser (Excel5)
	header('Content-Type: application/vnd.ms-excel');
	header('Content-Disposition: attachment;filename="validasi_peserta_diklat.xls"');
	header('Cache-Control: max-age=0');

	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
	$objWriter->save('php://output');
	  
	exit();
  endif;
   
?>

<?php
  /* == Create Report Anggota == */
  if (isset($_GET['action']) and $_GET['action'] == "createReportAnggota"):
          
        if(isset($_GET['id']))
            $id = $_GET['id'];
        else
            $id = 0;
        
  ob_end_clean();  
  
  ob_start();

        if ($id > 0) 
            $sqlwhere = "WHERE dp.id = " . $id;
        else
            $sqlwhere = "";
           
        $sql = "SELECT dp.*,ptk.*,"
        . "\n p.nama_propinsi," 
        . "\n k.nama_kota," 
        . "\n gol.nama_pangkat,gol.nama_fungsional," 
        . "\n dk.nama_diklat,dk.jml_jam," 
        . "\n dj.tgl_mulai,dj.tgl_akhir,dj.tempat" 
        . "\n FROM (((((diklat_peserta AS dp" 
        . "\n LEFT JOIN ptk AS ptk ON ptk.id = dp.`personid`)"
        . "\n LEFT JOIN propinsi AS p ON dp.propinsi_kode = p.kode)" 
        . "\n LEFT JOIN kota AS k ON dp.kota_kode = k.kode)" 
        . "\n LEFT JOIN diklat_jadwal AS dj ON dp.jadwalid = dj.id)" 
        . "\n LEFT JOIN diklat AS dk ON dj.diklatid = dk.id)" 
        . "\n LEFT JOIN golongan AS gol ON dp.golongan = gol.kode" 
        . "\n $sqlwhere" 
        . "\n ORDER BY dp.nama_lengkap";
        
        $result = $db->fetch_all($sql);
    
  require_once(BASEPATH . 'lib/PHPExcel.php');
    
  // Create new PHPExcel object
  $objPHPExcel = new PHPExcel();

  // Set document properties
  $objPHPExcel->getProperties()->setCreator($core->company)
                                    ->setLastModifiedBy($core->company)
                                    ->setTitle("Laporan Biodata Peserta Diklat")
                                    ->setSubject("Biodata Peserta Diklat")
                                    ->setDescription("Biodata Peserta Diklat.")
                                    ->setKeywords("PPPPTK BMTI Biodata Peserta xls")
                                    ->setCategory("Data Master");

  $objPHPExcel->setActiveSheetIndex(0);

  $worksheet = $objPHPExcel->getActiveSheet();

  // Header : title : l1  & filter : l2
  
  $worksheet->setCellValueByColumnAndRow(0, 1, 'Biodata Peserta Diklat');
  $worksheet->setCellValueByColumnAndRow(0, 2, 'Diklat');
  $worksheet->setCellValueByColumnAndRow(0, 3, '');

  $worksheet->setCellValueByColumnAndRow(0, 4, 'Nama Lengkap : ');
        $worksheet->setCellValueByColumnAndRow(0, 5, 'NIP : ');
        $worksheet->setCellValueByColumnAndRow(0, 6, 'NUPTK : ');
        $worksheet->setCellValueByColumnAndRow(0, 7, 'GOL : ');
        $worksheet->setCellValueByColumnAndRow(0, 8, 'Pangkat : ');
        $worksheet->setCellValueByColumnAndRow(0, 9, 'JK : ');

        $worksheet->setCellValueByColumnAndRow(0, 10, 'Tmp Lahir : ');
        $worksheet->setCellValueByColumnAndRow(0, 11, 'Tgl Lahir : ');
        $worksheet->setCellValueByColumnAndRow(0, 12, 'Jabatan Fungsional : ');
        $worksheet->setCellValueByColumnAndRow(0, 13, 'Agama : ');
        $worksheet->setCellValueByColumnAndRow(0, 14, 'Pendidikan Terakhir : ');
        $worksheet->setCellValueByColumnAndRow(0, 15, 'Jurusan : ');

        $worksheet->setCellValueByColumnAndRow(0, 16, 'Thn Lulus : ');
        $worksheet->setCellValueByColumnAndRow(0, 17, 'Alamat : ');
  $worksheet->setCellValueByColumnAndRow(0, 18, 'Kab/Kota : ');
  $worksheet->setCellValueByColumnAndRow(0, 19, 'Propinsi : ');
  $worksheet->setCellValueByColumnAndRow(0, 20, 'No. HP : ');
  $worksheet->setCellValueByColumnAndRow(0, 21, 'NSS : ');        

        $worksheet->setCellValueByColumnAndRow(0, 22, 'Sekolah : ');
  $worksheet->setCellValueByColumnAndRow(0, 23, 'Status : ');
  $worksheet->setCellValueByColumnAndRow(0, 24, 'Kepala Sekolah : ');
  $worksheet->setCellValueByColumnAndRow(0, 25, 'Alamat Sekolah : ');
  $worksheet->setCellValueByColumnAndRow(0, 26, 'Telepon : ');
  $worksheet->setCellValueByColumnAndRow(0, 27, 'Fax : ');

        $worksheet->setCellValueByColumnAndRow(0, 28, 'KodePos : ');
  $worksheet->setCellValueByColumnAndRow(0, 29, 'E-Mail : ');
  $worksheet->setCellValueByColumnAndRow(0, 30, 'WebSite : ');
  $worksheet->setCellValueByColumnAndRow(0, 31, 'Kab/Kota : ');
  $worksheet->setCellValueByColumnAndRow(0, 32, 'Propinsi : ');

        $worksheet->setCellValueByColumnAndRow(0, 33, 'Nama Diklat : ');
  $worksheet->setCellValueByColumnAndRow(0, 34, 'Mulai : ');
  $worksheet->setCellValueByColumnAndRow(0, 35, 'Sampai : ');
  $worksheet->setCellValueByColumnAndRow(0, 36, 'Tempat : ');
  $worksheet->setCellValueByColumnAndRow(0, 37, 'Pola(Jam) : ');

  // Data :
  $xrow = 4;
  foreach ($result as $v) {
            
                $nama_lengkap = $v->nama_lengkap;
                if ($v->gelar_depan3 != '') $nama_lengkap = $v->gelar_depan3.' '.$nama_lengkap;
                if ($v->gelar_depan2 != '') $nama_lengkap = $v->gelar_depan2.' '.$nama_lengkap;
                if ($v->gelar_depan1 != '') $nama_lengkap = $v->gelar_depan1.' '.$nama_lengkap;

                if ($v->gelar_belakang1 != '') $nama_lengkap .= ' '.$v->gelar_belakang1;
                if ($v->gelar_belakang2 != '') $nama_lengkap .= ' '.$v->gelar_belakang2;
                if ($v->gelar_belakang3 != '') $nama_lengkap .= ' '.$v->gelar_belakang3;   
    $tipNip = $v->nip;             
                        
    $worksheet->setCellValueByColumnAndRow(2, $xrow++, $nama_lengkap);
    $worksheet->setCellValueByColumnAndRow(2, $xrow++, $v->nip);
    $worksheet->setCellValueByColumnAndRow(2, $xrow++, $v->nuptk);
    $worksheet->setCellValueByColumnAndRow(2, $xrow++, $v->golongan);
    $worksheet->setCellValueByColumnAndRow(2, $xrow++, $v->nama_pangkat);
    $worksheet->setCellValueByColumnAndRow(2, $xrow++, $v->jns_klmn);
                
    $worksheet->setCellValueByColumnAndRow(2, $xrow++, $v->tmp_lahir);
    $worksheet->setCellValueByColumnAndRow(2, $xrow++, $v->tgl_lahir);
    $worksheet->setCellValueByColumnAndRow(2, $xrow++, $v->nama_fungsional);
    $worksheet->setCellValueByColumnAndRow(2, $xrow++, $v->agama);
    $worksheet->setCellValueByColumnAndRow(2, $xrow++, $v->pendidikan_akhir);
    $worksheet->setCellValueByColumnAndRow(2, $xrow++, $v->jurusan_akhir);

    $worksheet->setCellValueByColumnAndRow(2, $xrow++, $v->tahun_lulus_akhir);
    $worksheet->setCellValueByColumnAndRow(2, $xrow++, $v->alamat);
    $worksheet->setCellValueByColumnAndRow(2, $xrow++, $v->nama_kota);
    $worksheet->setCellValueByColumnAndRow(2, $xrow++, $v->nama_propinsi);
    $worksheet->setCellValueByColumnAndRow(2, $xrow++, $v->telepon2);
    $worksheet->setCellValueByColumnAndRow(2, $xrow++, $v->nss);

    $worksheet->setCellValueByColumnAndRow(2, $xrow++, $v->nama_sekolah);
    $worksheet->setCellValueByColumnAndRow(2, $xrow++, $v->status_sekolah);
    $worksheet->setCellValueByColumnAndRow(2, $xrow++, $v->nama_pimpinan);
    $worksheet->setCellValueByColumnAndRow(2, $xrow++, $v->alamat_sekolah);
    $worksheet->setCellValueByColumnAndRow(2, $xrow++, $v->telepon_sekolah);
    $worksheet->setCellValueByColumnAndRow(2, $xrow++, $v->fax_sekolah);

    $worksheet->setCellValueByColumnAndRow(2, $xrow++, $v->kodepos_sekolah);
    $worksheet->setCellValueByColumnAndRow(2, $xrow++, $v->email);
    $worksheet->setCellValueByColumnAndRow(2, $xrow++, $v->website);
    $worksheet->setCellValueByColumnAndRow(2, $xrow++, $v->nama_kota);
    $worksheet->setCellValueByColumnAndRow(2, $xrow++, $v->nama_propinsi);
                
    $worksheet->setCellValueByColumnAndRow(2, $xrow++, $v->nama_diklat);
    $worksheet->setCellValueByColumnAndRow(2, $xrow++, $v->tgl_mulai);
    $worksheet->setCellValueByColumnAndRow(2, $xrow++, $v->tgl_akhir);
    $worksheet->setCellValueByColumnAndRow(2, $xrow++, $v->tempat);
    $worksheet->setCellValueByColumnAndRow(2, $xrow++, $v->jml_jam);
                
    $xrow++;
  }
  unset($v);
      
    // $worksheet->setCellValueByColumnAndRow(4, $xrow, $sql);
        
        
  // Rename worksheet
  $worksheet->setTitle('Biodata Peserta Diklat');

  // Set active sheet index to the first sheet, so Excel opens this as the first sheet
  $objPHPExcel->setActiveSheetIndex(0);

  // Redirect output to a clients web browser (Excel5)
  header('Content-Type: application/vnd.ms-excel'); 
  header('Content-Disposition: attachment;filename="biodata_"'.$tipNip.'".xls"');
  header('Cache-Control: max-age=0');

  $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
  $objWriter->save('php://output');
    
  exit();
  endif;
   
?>
