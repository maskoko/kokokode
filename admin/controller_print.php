<?php
  /**
   * Controller
   *
   * @package SIM PPPPTK BMTI
   * @author a2ngsa
   * @copyright 2012
   * @version $Id: controller_print.php, v1.00 2011-06-05 10:12:05 gewa Exp $
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
  /* == Create Sekolah Print == */
  if (isset($_GET['action']) and $_GET['action'] == "createPrintSekolah"):

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
                      $sqlwhere = "WHERE s.kota_kode = '" . $kota_kode ."'";
                      
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
	  	 
	
        if ($result) {
            print '<html><style type="text/css">'
                   .'body, th, td {font-family:arial,sans-serif; font-size: 100%; margin:20;}'
                   .'a:link, a:active, a:visited{color:#0000CC}'
                   .'.si td {border: solid 1px #aaaaaa;padding:10px; line-height:140%; white-space: nowrap;}</style>'
                   .'<script type="text/javascript"> function p() { window.print(); } </script></head>'
                   .'<body onload="p()"><b>Data Sekolah</b><br><br>'
                   .'<div class="si"><table>';

            print '<tr><td>No.</td><td>NSS</td><td>Nama Sekolah</td><td>'
             .'Jenis</td><td>Propinsi</td><td>Kota</td></tr>';
            
            $no = 0;
            foreach ($result as $v) {

                    $no++;
                    print '<tr><td>' . $no . '.</td><td>' . $v->nss . '</td><td>' . $v->nama_sekolah . '</td><td>'
                     .$v->nama_jenis . '</td><td>' . $v->nama_propinsi . '</td><td>'
                     .$v->nama_kota . '</td></tr>';

            }
            unset($v);
            
        }
         
        print '</table></div></body></html>';
        
  endif;
?>

<?php
  /* == Create PTK Print == */
  if (isset($_GET['action']) and $_GET['action'] == "createPrintPTK"):

        if(isset($_GET['propinsi_kode']))
            $propinsi_kode = $_GET['propinsi_kode'];
        else
            $propinsi_kode = 0;

        if(isset($_GET['kota_kode']))
            $kota_kode = $_GET['kota_kode'];
        else
            $kota_kode = 0;

        if(isset($_GET['searchfield']))
            $searchfield = $_GET['searchfield'];
        else
            $searchfield = 'nama';

        if(isset($_GET['searchtext']))
            $searchtext = $_GET['searchtext'];
        else
            $searchtext = '';
                                
        if ($propinsi_kode != '') {
              if ($kota_kode != '') {
                    $sqlwhere = "WHERE pt.propinsi_kode = '" . $propinsi_kode . "' AND pt.kota_kode = '" . $kota_kode . "'";
                      
                    if (($searchtext != '') && ($searchfield != ''))
                        $sqlwhere .= " AND LOWER(pt." . $searchfield .") LIKE '%". $searchtext ."%'";
              } else {
                      $sqlwhere = "WHERE pt.propinsi_kode = '" . $propinsi_kode ."'";
                      
                      if (($searchtext != '') && ($searchfield != ''))
                          $sqlwhere .= " AND LOWER(pt." . $searchfield .") LIKE '%". $searchtext ."%'";
              }
        } else {
              if ($kota_kode != '') {
                      $sqlwhere = "WHERE pt.kota_kode = '" . $kota_kode ."'";
                      
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
	  	 	
        if ($result) {
            print '<html><style type="text/css">'
                   .'body, th, td {font-family:arial,sans-serif; font-size: 100%; margin:20;}'
                   .'a:link, a:active, a:visited{color:#0000CC}'
                   .'.si td {border: solid 1px #aaaaaa;padding:10px; line-height:140%; white-space: nowrap;}</style>'
                   .'<script type="text/javascript"> function p() { window.print(); } </script></head>'
                   .'<body onload="p()"><b>Data Guru dan Tenaga Kependidikan (GTK)</b><br><br>'
                   .'<div class="si"><table>';

            print '<tr><td>No.</td><td>NUPTK</td><td>Nama Lengkap</td><td>'
             .'NIP</td><td>Sekolah</td><td>Propinsi</td><td>Kota</td></tr>';
            
            $no = 0;
            foreach ($result as $v) {

                    $no++;
                    print '<tr><td>' . $no . '.</td><td>' . $v->nuptk . '</td><td>' . $v->nama_lengkap . '</td><td>'
                     .$v->nip . '</td><td>' . $v->nama_sekolah . '</td><td>'
                     .$v->nama_propinsi . '</td><td>' .$v->nama_kota . '</td></tr>';

            }
            unset($v);
            
        }
         
        print '</table></div></body></html>';
        
  endif;
?>

<?php
  /* == Create Lembaga Print == */
  if (isset($_GET['action']) and $_GET['action'] == "createPrintLembaga"):

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
                      
        if ($propinsi_kode != '') {
              if ($kota_kode != '') {
                    $sqlwhere = "WHERE s.propinsi_kode = '" . $propinsi_kode . "' AND l.kota_kode = '" . $kota_kode . "'";
                      
                    if (($searchtext != '') && ($searchfield != ''))
                        $sqlwhere .= " AND LOWER(l." . $searchfield .") LIKE '%". $searchtext ."%'";
              } else {
                      $sqlwhere = "WHERE l.propinsi_kode = '" . $propinsi_kode . "'";
                      
                      if (($searchtext != '') && ($searchfield != ''))
                          $sqlwhere .= " AND LOWER(l." . $searchfield .") LIKE '%". $searchtext ."%'";
              }
        } else {
              if ($kota_kode != '') {
                      $sqlwhere = "WHERE l.kota_kode = '" . $kota_kode ."'";
                      
                      if (($searchtext != '') && ($searchfield != ''))
                          $sqlwhere .= " AND LOWER(l." . $searchfield .") LIKE '%". $searchtext ."%'";
                      
              } else {

                      if (($searchtext != '') && ($searchfield != ''))
                        $sqlwhere = "WHERE LOWER(l." . $searchfield .") LIKE '%". $searchtext ."%'";
                      else
                        $sqlwhere = "";
              }
        }
        
	$sql = "SELECT l.id, l.nama_lembaga, l.alamat, l.propinsi_kode, l.kota_kode," 
		  . "\n p.nama_propinsi," 
		  . "\n k.nama_kota" 
		  . "\n FROM (lembaga as l" 
		  . "\n LEFT JOIN propinsi as p ON l.propinsi_kode = p.kode)" 
		  . "\n LEFT JOIN kota as k ON l.kota_kode = k.kode" 
		  . "\n $sqlwhere" 
		  . "\n ORDER BY l.nama_lembaga";
	  
	$result = $db->fetch_all($sql);
	  	 
	
        if ($result) {
            print '<html><style type="text/css">'
                   .'body, th, td {font-family:arial,sans-serif; font-size: 100%; margin:20;}'
                   .'a:link, a:active, a:visited{color:#0000CC}'
                   .'.si td {border: solid 1px #aaaaaa;padding:10px; line-height:140%; white-space: nowrap;}</style>'
                   .'<script type="text/javascript"> function p() { window.print(); } </script></head>'
                   .'<body onload="p()"><b>Data Lembaga</b><br><br>'
                   .'<div class="si"><table>';

            print '<tr><td>No.</td><td>Nama Lembaga</td><td>Alamat</td>'
             .'<td>Propinsi</td><td>Kota</td></tr>';
            
            $no = 0;
            foreach ($result as $v) {

                    $no++;
                    print '<tr><td>' . $no . '.</td><td>' . $v->nama_lembaga . '</td><td>' . $v->alamat . '</td><td>'
                     .$v->nama_propinsi . '</td><td>' . $v->nama_kota . '</td></tr>';

            }
            unset($v);
            
        }
         
        print '</table></div></body></html>';
        
  endif;
?>

<?php
  /* == Create Staff Print == */
  if (isset($_GET['action']) and $_GET['action'] == "createPrintStaff"):

        if(isset($_GET['propinsi_kode']))
            $propinsi_kode = $_GET['propinsi_kode'];
        else
            $propinsi_kode = 0;

        if(isset($_GET['kota_kode']))
            $kota_kode = $_GET['kota_kode'];
        else
            $kota_kode = 0;

        if(isset($_GET['searchfield']))
            $searchfield = $_GET['searchfield'];
        else
            $searchfield = 'nama';

        if(isset($_GET['searchtext']))
            $searchtext = $_GET['searchtext'];
        else
            $searchtext = '';
                                
        if ($propinsi_kode != '') {
              if ($kota_kode != '') {
                    $sqlwhere = "WHERE s.propinsi_kode = '" . $propinsi_kode . "' AND s.kota_kode = '" . $kota_kode . "'";
                      
                    if (($searchtext != '') && ($searchfield != ''))
                        $sqlwhere .= " AND LOWER(s." . $searchfield .") LIKE '%". $searchtext ."%'";
              } else {
                      $sqlwhere = "WHERE s.propinsi_kode = '" . $propinsi_kode ."'";
                      
                      if (($searchtext != '') && ($searchfield != ''))
                          $sqlwhere .= " AND LOWER(s." . $searchfield .") LIKE '%". $searchtext ."%'";
              }
        } else {
              if ($kota_kode != '') {
                      $sqlwhere = "WHERE s.kota_kode = '" . $kota_kode ."'";
                      
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
	  	 	
        if ($result) {
            print '<html><style type="text/css">'
                   .'body, th, td {font-family:arial,sans-serif; font-size: 100%; margin:20;}'
                   .'a:link, a:active, a:visited{color:#0000CC}'
                   .'.si td {border: solid 1px #aaaaaa;padding:10px; line-height:140%; white-space: nowrap;}</style>'
                   .'<script type="text/javascript"> function p() { window.print(); } </script></head>'
                   .'<body onload="p()"><b>Data Staff</b><br><br>'
                   .'<div class="si"><table>';

            print '<tr><td>No.</td><td>NIP</td><td>Nama Lengkap</td><td>'
             .'Alamat</td><td>Lembaga</td><td>Propinsi</td><td>Kota</td></tr>';
            
            $no = 0;
            foreach ($result as $v) {

                    $no++;
                    print '<tr><td>' . $no . '.</td><td>' . $v->nip . '</td><td>' . $v->nama_lengkap . '</td><td>'
                     .$v->alamat . '</td><td>' . $v->nama_lembaga . '</td><td>'
                     .$v->nama_propinsi . '</td><td>' .$v->nama_kota . '</td></tr>';

            }
            unset($v);
            
        }
         
        print '</table></div></body></html>';
        
  endif;
?>

<?php
  /* == Create PTK_DiklatMinat Print == */
  if (isset($_GET['action']) and $_GET['action'] == "createPrintPTK_DiklatMinat"):

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
            $propinsi_kode = 0;

        if(isset($_GET['kota_kode']))
            $kota_kode = $_GET['kota_kode'];
        else
            $kota_kode = 0;

        if(isset($_GET['searchfield']))
            $searchfield = $_GET['searchfield'];
        else
            $searchfield = 'nama';

        if(isset($_GET['searchtext']))
            $searchtext = $_GET['searchtext'];
        else
            $searchtext = '';
                                
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
                . "\n pt.sekolahid, pt.nama_lengkap, pt.nuptk, pt.nip, pt.alamat," 
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
	  	 	
        if ($result) {
            print '<html><style type="text/css">'
                   .'body, th, td {font-family:arial,sans-serif; font-size: 100%; margin:20;}'
                   .'a:link, a:active, a:visited{color:#0000CC}'
                   .'.si td {border: solid 1px #aaaaaa;padding:10px; line-height:140%; white-space: nowrap;}</style>'
                   .'<script type="text/javascript"> function p() { window.print(); } </script></head>'
                   .'<body onload="p()"><b>Data Minat Diklat GTK</b><br><br>'
                   .'<div class="si"><table>';

            if ($diklatid == 0)
                print '<tr><td>No.</td><td>NUPTK</td><td>Nama Lengkap</td><td>'
                 .'NIP</td><td>Sekolah</td><td>Propinsi</td><td>Kota</td><td>Kode Diklat</td><td>Nama Diklat</td></tr>';
            else
                print '<tr><td>No.</td><td>NUPTK</td><td>Nama Lengkap</td><td>'
                 .'NIP</td><td>Sekolah</td><td>Propinsi</td><td>Kota</td></tr>';
                
            $no = 0;
            foreach ($result as $v) {

                    $no++;
                    
                    if ($diklatid == 0)
                        print '<tr><td>' . $no . '.</td><td>' . $v->nuptk . '</td><td>' . $v->nama_lengkap . '</td><td>'
                         .$v->nip . '</td><td>' . $v->nama_sekolah . '</td><td>'
                         .$v->nama_propinsi . '</td><td>' .$v->nama_kota . '</td><td>' .$v->kode . '</td><td>' .$v->nama_diklat . '</td></tr>';
                    else
                        print '<tr><td>' . $no . '.</td><td>' . $v->nuptk . '</td><td>' . $v->nama_lengkap . '</td><td>'
                         .$v->nip . '</td><td>' . $v->nama_sekolah . '</td><td>'
                         .$v->nama_propinsi . '</td><td>' .$v->nama_kota . '</td></tr>';

            }
            unset($v);
            
        }
         
        print '</table></div></body></html>';
        
  endif;
?>

<?php
  /* == Create Diklat_CalonPeserta Print == */
  if (isset($_GET['action']) and $_GET['action'] == "createPrintDiklat_CalonPeserta"):

        if(isset($_GET['jadwalid']))
            $jadwalid = $_GET['jadwalid'];
        else
            $jadwalid = 0;
                                
        if ($jadwalid > 0) {
            $sqlwhere = "WHERE da.jadwalid = '" . $jadwalid . "'";
        } else {
            $sqlwhere = "";
        }
           
        $sql = "SELECT da.*,"
        . "\n pt.nuptk, pt.nip, pt.nama_lengkap,"
        . "\n s.nama_sekolah," 
        . "\n p.nama_propinsi," 
        . "\n k.nama_kota" 
        . "\n FROM (((diklat_calonpeserta AS da" 
        . "\n LEFT JOIN ptk AS pt ON da.personid = pt.id AND da.jenis = 'P')" 
        . "\n LEFT JOIN sekolah AS s ON da.instansiid = s.id)" 
        . "\n LEFT JOIN propinsi as p ON pt.propinsi_kode = p.kode)"
        . "\n LEFT JOIN kota as k ON pt.kota_kode = k.kode"
        . "\n $sqlwhere"         
        . "\n ORDER BY pt.nama_lengkap";

        $result = $db->fetch_all($sql);
	  	 	
        if ($result) {
            print '<html><style type="text/css">'
                   .'body, th, td {font-family:arial,sans-serif; font-size: 100%; margin:20;}'
                   .'a:link, a:active, a:visited{color:#0000CC}'
                   .'.si td {border: solid 1px #aaaaaa;padding:10px; line-height:140%; white-space: nowrap;}</style>'
                   .'<script type="text/javascript"> function p() { window.print(); } </script></head>'
                   .'<body onload="p()"><b>Data Calon Peserta Diklat</b><br><br>'
                   .'<div class="si"><table>';

            print '<tr><td>No.</td><td>NUPTK</td><td>Nama Lengkap</td><td>'
             .'NIP</td><td>Sekolah</td><td>Propinsi</td><td>Kota</td></tr>';
            
            $no = 0;
            foreach ($result as $v) {

                    $no++;
                    print '<tr><td>' . $no . '.</td><td>' . $v->nuptk . '</td><td>' . $v->nama_lengkap . '</td><td>'
                     .$v->nip . '</td><td>' . $v->nama_sekolah . '</td><td>'
                     .$v->nama_propinsi . '</td><td>' .$v->nama_kota . '</td></tr>';

            }
            unset($v);
            
        }
         
        print '</table></div></body></html>';
        
  endif;
?>

<?php
  /* == Create Diklat_Peserta Print == */
  if (isset($_GET['action']) and $_GET['action'] == "createPrintDiklat_Peserta"):

        if(isset($_GET['jadwalid']))
            $jadwalid = $_GET['jadwalid'];
        else
            $jadwalid = 0;
                                
        if ($jadwalid > 0) {
            $sqlwhere = "WHERE dp.jadwalid = '" . $jadwalid . "'";
        } else {
            $sqlwhere = "";
        }
           
        $sql = "SELECT dp.*,"
        . "\n p.nama_propinsi," 
        . "\n k.nama_kota" 
        . "\n FROM (diklat_peserta AS dp" 
        . "\n LEFT JOIN propinsi as p ON dp.propinsi_kode = p.kode)"
        . "\n LEFT JOIN kota as k ON dp.kota_kode = k.kode"
        . "\n $sqlwhere"         
        . "\n ORDER BY dp.nama_lengkap";

        $result = $db->fetch_all($sql);
	  	 	
        if ($result) {
            print '<html><style type="text/css">'
                   .'body, th, td {font-family:arial,sans-serif; font-size: 100%; margin:20;}'
                   .'a:link, a:active, a:visited{color:#0000CC}'
                   .'.si td {border: solid 1px #aaaaaa;padding:10px; line-height:140%; white-space: nowrap;}</style>'
                   .'<script type="text/javascript"> function p() { window.print(); } </script></head>'
                   .'<body onload="p()"><b>Data Peserta Diklat</b><br><br>'
                   .'<div class="si"><table>';

            print '<tr><td>No.</td><td>NUPTK</td><td>Nama Lengkap</td><td>'
             .'NIP</td><td>Sekolah</td><td>Propinsi</td><td>Kota</td></tr>';
            
            $no = 0;
            foreach ($result as $v) {

                    $no++;
                    print '<tr><td>' . $no . '.</td><td>' . $v->nuptk . '</td><td>' . $v->nama_lengkap . '</td><td>'
                     .$v->nip . '</td><td>' . $v->nama_sekolah . '</td><td>'
                     .$v->nama_propinsi . '</td><td>' .$v->nama_kota . '</td></tr>';

            }
            unset($v);
            
        }
         
        print '</table></div></body></html>';
        
  endif;
?>

<?php
  /* == Create Absensi_Diklat Print == */
  if (isset($_GET['action']) and $_GET['action'] == "createAbsensiDiklat_Peserta"):

        if(isset($_GET['jadwalid'])){
            $jadwalid = $_GET['jadwalid'];
            $jadwaltext = $_GET['jadwaltext'];}
        else{
            $jadwalid = 0;
            $jadwaltext = "";
          }

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
                   .'<body onload="p()"><b>Absensi Peserta Diklat '.$jadwaltext.'</b><br><br>'
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
  /* == Create Diklat_Jadwal Print == */
  if (isset($_GET['action']) and $_GET['action'] == "createPrintDiklat_Jadwal"):

        if(isset($_GET['departemenid']))
            $departemenid = $_GET['departemenid'];
        else
            $departemenid = 0;

        if(isset($_GET['tgl_dari']))
            $tgl_dari = $_GET['tgl_dari'];
        else {
            $year = date('Y');
            $t_dari = mktime(0, 0, 0, 1, 1,  $year - 2);
            $tgl_dari = date('Y-m-d', $t_dari);                    
        }
        
        if(isset($_GET['tgl_sampai'])) { 
            $tgl_sampai = $_GET['tgl_sampai'];
        } else {                                        
            if(isset($_GET['tgl_dari'])) { 
                $tgl_sampai = $_GET['tgl_dari'];
            } else {
                $year = date('Y');
                $t_sampai = mktime(0, 0, 0, 12, 31,  $year);
                $tgl_sampai = date('Y-m-d', $t_sampai);
            }
        }
                        
        $sqlwhere = "WHERE (dj.tgl_mulai >= '" . $tgl_dari . "' AND dj.tgl_akhir <= '" .$tgl_sampai . "')";
        
        if ($departemenid > 0)
            $sqlwhere = " AND dj.departemenid = '" . $departemenid . "'";
           
        $sql = "SELECT dj.id, dj.diklatid, dj.tahun, DATE_FORMAT(dj.tgl_mulai, '%d/%m/%Y') AS tgl_mulai,"
                 . "\n DATE_FORMAT(dj.tgl_akhir, '%d/%m/%Y') AS tgl_akhir, dj.tempat,"
                 . "\n dk.kode, dk.nama_diklat, dk.tingkat,"
                 . "\n d.nama_departemen"
                 . "\n FROM (diklat_jadwal as dj"
                 . "\n LEFT JOIN diklat as dk ON dj.diklatid = dk.id)"
                 . "\n LEFT JOIN departemen as d ON dk.departemenid = d.id"
                 . "\n $sqlwhere"
                 . "\n ORDER By dj.tgl_mulai";
               
        $result = $db->fetch_all($sql);
	  	 	
        if ($result) {
            print '<html><style type="text/css">'
                   .'body, th, td {font-family:arial,sans-serif; font-size: 100%; margin:20;}'
                   .'a:link, a:active, a:visited{color:#0000CC}'
                   .'.si td {border: solid 1px #aaaaaa;padding:10px; line-height:140%; white-space: nowrap;}</style>'
                   .'<script type="text/javascript"> function p() { window.print(); } </script></head>'
                   .'<body onload="p()"><h3><b>Data Jadwal Diklat</b></h3><h4>Periode : ' . setToStrdate($tgl_dari). ' s.d ' . setToStrdate($tgl_sampai)
                   .'</h4><div class="si"><table>';

            print '<tr><td>No.</td><td>Kode</td><td>Nama Diklat</td><td>'
             .'Tingkat</td><td>Tahun</td><td>Tgl Mulai</td><td>Tgl Akhir</td><td>Departemen</td></tr>';
            
            $no = 0;
            foreach ($result as $v) {

                    $no++;
                    print '<tr><td>' . $no . '.</td><td>' . $v->kode . '</td><td>' . $v->nama_diklat . '</td><td>'
                     .$v->tingkat . '</td><td>' . $v->tahun . '</td><td>'
                     .$v->tgl_mulai . '</td><td>' .$v->tgl_akhir . '</td><td>' .$v->nama_departemen . '</td></tr>';

            }
            unset($v);
            
        }
         
        print '</table></div></body></html>';
        
  endif;
?>


<?php
  /* == Create Registrasi Peserta Diklat Print == */
  if (isset($_GET['action']) and $_GET['action'] == "createPrintRegistrasiDiklat"):
  
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
        $jenis = $_GET['jenis'];

       if ($propinsi_kode != '') {
                if ($kota_kode != '') {
                        $sqlwhere = "WHERE dkp.propinsi_kode = '" . $propinsi_kode . "' AND dkp.kota_kode = '" . $kota_kode . "'";

                      if (($searchtext != '') && ($searchfield != '')) {
                          $sqlwhere .= " AND LOWER(" . $searchfield .") LIKE '%". $searchtext ."%'";
                      }
                } else {
                        $sqlwhere = "WHERE dkp.propinsi_kode = '" . $propinsi_kode . "'";

                        if (($searchtext != '') && ($searchfield != '')) {
                            $sqlwhere .= " AND LOWER(" . $searchfield .") LIKE '%". $searchtext ."%'";
                        }
                }
              
                if ($jadwalid > 0) {
                    $sqlwhere .= " AND dkp.jadwalid = " . $jadwalid;
                }
                                                                        
            } else {
                  if ($kota_kode != '') {
                        $sqlwhere = "WHERE dkp.kota_kode = '" . $kota_kode . "'";

                        if (($searchtext != '') && ($searchfield != '')) {
                            $sqlwhere .= " AND LOWER(" . $searchfield .") LIKE '%". $searchtext ."%'";
                        }
                          
                        if ($jadwalid > 0) {
                            $sqlwhere .= " AND dkp.jadwalid = " . $jadwalid;
                        }
                          
                  } else {
                          if (($searchtext != '') && ($searchfield != '')) {
                                $sqlwhere = "WHERE LOWER(" . $searchfield .") LIKE '%". $searchtext ."%'";


                                if ($jadwalid > 0) {
                                    $sqlwhere .= " AND dkp.jadwalid = " . $jadwalid;
                                }
                                
                          } else {
                                if ($jadwalid > 0) {
                                    $sqlwhere = " WHERE dkp.jadwalid = " . $jadwalid;
                                } else {                              
                                    $sqlwhere = "";
                                }
                            
                          }
                  }                                    
            }
                                                
            if (($searchtext != '') && ($searchfield != '')) {
                $sqlwhere .= " AND LOWER(" . $searchfield .") LIKE '%". $searchtext ."%'";
            } 
                        
                $sql = "SELECT * " 
                . "\n FROM diklat_kartu_peserta AS dkp" 
                . "\n $sqlwhere"
                . "\n ORDER BY dkp.nama_lengkap";

        $result = $db->fetch_all($sql);
        $result2 = $db->query($sql);
        $num = $db->fetchrow($result2);
        $baris = 0;
        $kolom = 0;
        
        $periodepel = '';

        print '<html moznomarginboxes mozdisallowselectionprint>
                            <style type="text/css">.pagebreak { page-break-before: always; }.body, th, td {font-family:Arial;}table { border-collapse:collapse; } table thead th { border-bottom: 0px solid #000; }
                            </style>
                            <script type="text/javascript"> </script></head>
                            <body style="font-family:arial;">';

          if ($result) {
            print '<table>';
                  foreach ($result as $v) {
                    
                     $tglmulai = $v->tglmulai;
                     $tglakhir = $v->tglakhir;
                     $blnmulai = $v->nmblnmulai;
                     $blnakhir = $v->nmblnakhir;
                     $thnmulai = $v->thnmulai;
                     $thnakhir = $v->thnakhir;
                     $srca = ($v->dir_foto).'/'.($v->foto);
                     $periodepel = '';


                    if(($blnmulai == $blnakhir) AND ($thnmulai == $thnakhir)){
                        $periodepel = $tglmulai.' s.d '.$tglakhir.' '.$blnmulai.' '.$thnmulai;}
                      elseif (($blnmulai != $blnakhir) AND ($thnmulai == $thnakhir)){
                        $periodepel = $tglmulai." ".$blnmulai." s.d ".$tglakhir." ".$blnakhir." ".$thnmulai;
                      }else{
                        $periodepel = $tglmulai.' '.$blnmulai.' '.$thnmulai.' s.d '.$tglakhir.' '.$blnakhir.' '.$thnakhir;
                      }

                    
                      

                    if($kolom%3 != 0 && $kolom<=$num){
                      print '<td>';
                    }
                    if(($kolom%3 == 0) && $kolom<=$num){
                      // $kolom=0;
                      print '<tr><td>';
                    }

                    if(empty($v->foto))
                      $srca = 'poto_kosong.png';
                    else
                      $srca = ($v->dir_foto).'/'.($v->foto);

                    if($jenis == 'kecil'){

                      print '<br>
                      <table border="1" width="320px" height="200px" style="padding: 3px 0 0 0;">
                                <tr><td>
                              <table border="0" width="320px" height="200px">
                                <thead>
                                <tr>
                                  <th colspan="2" align="center" style="font-family: Arial;font-size: 14px;font-weight: bold;padding: 5px 1px 5px 1px;"><b>PPPPTK BMTI</b></th>
                                </tr>
                                <tr>
                                  <td colspan="2" align="center" style="font-family: Arial;font-size: 7px;font-weight: bold;padding: 0 0 1px 0;">Jl. Pesantren Km.2 Cimahi 40513 ~ Telp.(022) 6652326; Fax.(022) 6654698</td>
                                </tr>
                                <tr>
                                    <td colspan="2" align="center" style="font-family: Arial;font-size: 7px;font-weight: bold;">Laman: www.tedcbandung.com, Surel: tedc@tedcbandung.com</td></tr>
                                    <tr><td colspan="2"><hr></td></tr>
                                </tr>
                                </thead>
                                <tbody>
                                      <tr>
                                        <td rowspan="3" style="padding: 0px 3px 0px 3px; height: 60px; width:50px" valign="top" ><img src="../foto/foto_peserta_diklat/'.$srca.'" title="Poto Peserta" id="poto_peserta" name="poto_peserta" width="50px" height="60px"/></td>
                                        <td style="padding: 0px 0px 0px 0px;height:20px; background-color: #b3eaff;font-weight:bold;font-size: 11px;" align="center" width="100%" >'.$v->diklatkelas.'</td>
                                      </tr>
                                      <tr><td style="padding:2px 0px 2px 0px;font-size: 8px; height:10px;" align="center" valign="bottom" >Periode : '.$periodepel.'</td></tr>
                                      <tr><td style="padding:0px 0px 0px 0px;font-size: 8px;height:10px;" align="center" valign="top">PB : '.$v->nama_departemen.' - PPPPTK BMTI</td></tr>
                                      
                                      <tr>
                                        <td style="padding: 1px 2px 1px 2px;font-size:30px; font-weight:bold;height:30px" align="center" >'.$v->no_absen.'</td>
                                        <td style="padding:0px 0px 0px 0px;font-size: 14px;font-weight:bold;" align="center">'.$v->nopesukg.'</td>
                                      </tr>
                                      <tr><td colspan="2" style="padding: 2px 2px 2px 2px;height:20px; background-color: #b3eaff;font-weight:bold;font-size: 14px;" align="center" >'.$v->nama_lengkap.'</td></tr>
                                </tbody>
                              </table>
                              </td></tr>
                              </table>';

                            if($kolom%3 != 0 && $kolom<=$num){
                                    print '</td>';
                                  }
                            if($baris>0){
                                if(($kolom%3 == 0) && $kolom<=$num){
                                  print '</td></tr>';
                                   $baris +=1;
                                   }
                                 }else{
                                  if($kolom<=$num){
                                    print '</td>';
                                  }
                                }
                                $kolom +=1;
                                if($kolom%9 == 0){
                                  echo '<div class="page-break"></div>';
                                }
                          } else {

                            print '<br>
                            <table border="1" width="500px" height="600px" style="padding: 3px 0 0 0;">
                                      <tr><td>
                                    <table border="0" width="500px" height="600px">
                                      <thead>
                                      <tr>
                                        <th align="center" style="font-family: Arial;font-size: 30px;font-weight: bold;padding: 8px 2px 8px 2px;"><b>PPPPTK BMTI</b></th>
                                      </tr>
                                      <tr>
                                        <td align="center" style="font-family: Arial;font-size: 12px;font-weight: bold;padding: 0 0 1px 0;">Jl. Pesantren Km.2 Cimahi 40513 ~ Telp.(022) 6652326; Fax.(022) 6654698</td>
                                      </tr>
                                      <tr>
                                          <td align="center" style="font-family: Arial;font-size: 12px;font-weight: bold;">Laman: www.tedcbandung.com, Surel: tedc@tedcbandung.com</td>
                                      </tr>
                                          <tr><td><hr></td></tr>
                                      
                                      </thead>

                                      <tbody>
                                            <tr>
                                              <td style="padding: 0px 3px 5px 3px; height: 150px; width:140px" align="center" valign="top" ><img src="../foto/foto_peserta_diklat/'.$srca.'" title="Poto Peserta" id="poto_peserta" name="poto_peserta" width="140px" height="150px"/></td>
                                            </tr>
                                            <tr>
                                              <td style="padding: 5px 0px 5px 0px;height:38px; background-color: #b3eaff;font-weight:bold;font-size: 18px;" align="center" width="100%" >'.$v->diklatkelas.'</td>
                                            </tr>
                                            <tr><td style="padding:10px 0px 2px 0px;font-size: 14px; height:14px;" align="center" valign="bottom" >Periode : '.$periodepel.'</td></tr>
                                            <tr><td style="padding:0px 0px 10px 0px;font-size: 14px;height:14px;" align="center" valign="top">PB : '.$v->nama_departemen.' - PPPPTK BMTI</td></tr>
                                            <tr>
                                              <td style="padding: 5px 0px 5px 0px;height:28px; background-color: #b3eaff;font-weight:bold;font-size: 28px;" align="center" width="100%" >'.$v->nama_lengkap.'</td>
                                            </tr>
                                            <tr>
                                              <td style="padding:0px 0px 0px 0px;font-size: 24px;font-weight:bold;" align="center">'.$v->nopesukg.'</td>
                                            </tr>
                                            <tr>
                                              <td style="padding: 1px 2px 1px 2px;font-size:50px; font-weight:bold;height:30px" align="center" >'.$v->no_absen.'</td></tr>
                                            <tr>
                                              <td style="padding: 1px 2px 1px 2px;font-size:16px; background-color: #b3eaff; font-weight:bold;height:30px" align="center" >Instansi Asal :</td>
                                            </tr> 
                                            <tr>
                                              <td style="padding: 0px 2px 4px 2px;font-size:20px; background-color: #b3eaff; font-weight:bold;height:30px" align="center" >SMA Negeri 3 Bandung</td>
                                            </tr>
                                      </tbody>
                                    </table>
                                    </td></tr>
                                    </table>';

                                  if($kolom%2 != 0 && $kolom<=$num){
                                          print '</td>';
                                        }
                                  if($baris>0){
                                      if(($kolom%2 == 0) && $kolom<=$num){
                                        print '</td></tr>';
                                         $baris +=1;
                                         }
                                       }else{
                                        if($kolom<=$num){
                                          print '</td>';
                                        }
                                      }
                                      $kolom +=1;
                                      if($kolom%4 == 0){
                                        echo '<div class="page-break"></div>';
                                      }

                                }

                          }





                print '</table>';

            print '</body>
                    </html>';
            unset($v);
          }

  endif;
   
?>

<?php
  /* == Create Diklat_PesertaValidasi Print == */
  if (isset($_GET['action']) and $_GET['action'] == "createPrintDiklat_PesertaValidasi"):

        if(isset($_GET['id']))
            $id = $_GET['id'];
        else
            $id = 0;
                                           
        $sql = "SELECT dp.*,"
        . "\n p.nama_propinsi," 
        . "\n k.nama_kota," 
        . "\n dk.nama_diklat," 
        . "\n dj.tgl_mulai, dj.tgl_akhir, dj.tempat," 
        . "\n dep.nama_departemen" 
        . "\n FROM ((((diklat_peserta AS dp" 
        . "\n LEFT JOIN propinsi AS p ON dp.propinsi_kode = p.kode)"
        . "\n LEFT JOIN kota AS k ON dp.kota_kode = k.kode)"
        . "\n LEFT JOIN diklat_jadwal AS dj ON dp.jadwalid = dj.id)"
        . "\n LEFT JOIN diklat AS dk ON dj.diklatid = dk.id)"
        . "\n LEFT JOIN departemen AS dep ON dk.departemenid = dep.id"
        . "\n WHERE dp.id = " . $id;

        $row = $db->first($sql);
	  	 	
        if ($row) {
            
            $pangkat = '';
            $jabatan_fungsional = '';
            
            if ($row->golongan) {
                $sql = "SELECT *"
                . "\n FROM golongan" 
                . "\n WHERE kode = '" . $row->golongan . "'";

                $grow = $db->first($sql);
                if ($grow) {
                    $pangkat = $grow->nama_pangkat;
                    $jabatan_fungsional = $grow->nama_fungsional;
                    
                    unset ($grow);
                }
            }
            
            print '<html><style type="text/css">'
                   .'body, th, td {font-family:arial,sans-serif; font-size: 100%; margin:20;}'
                   .'a:link, a:active, a:visited{color:#0000CC}'
                   .'.si td {border: solid 1px #aaaaaa;padding:10px; line-height:140%; white-space: nowrap;}</style>'
                   .'<script type="text/javascript"> function p() { window.print(); } </script></head>'
                   .'<body onload="p()"><b>VALIDASI BIODATA UNTUK SERTIFIKAT</b><br><br>'
                   .'<div class="si"><table>';

            print '<tr><td><strong>Nama Diklat</strong></td><td>: '. $row->nama_diklat . '</td></tr>'
                    .'<tr><td><strong>Waktu Pelaksanaan</strong></td><td>: '. setToStrdate($row->tgl_mulai) . ' s.d ' . setToStrdate($row->tgl_akhir) . '</td></tr>'
                    .'<tr><td><strong>Tempat/Departemen Pelaksana</strong></td><td>: '. $row->tempat . ' / ' . $row->nama_departemen . '</td></tr>';

            print '<tr><td colspan="3"><strong>I. TATA TULIS PENULISAN</strong></td></tr>'
                    .'<tr><td width="30" align="right">1.</td><td colspan="2">Data harus diisi dengan benar dan lengkap karena akan digunakan untuk Sertifikat, apabila dalam pengisian data tidak benar, bukan tanggung jawab kami</td></tr>';
                       
            print '<tr><td colspan="3"><strong>II. IDENTITAS PESERTA</strong></td></tr>'
                    .'<tr><td width="30" align="right">1.</td><td>Nama (Lengkap dengan gelar)</td><td>: ' . $row->nama_lengkap . '</td></tr>'
                    .'<tr><td width="30" align="right">2.</td><td>Tempat, Tanggal Lahir</td><td>: ' . $row->tmp_lahir . ', ' . setToStrdate($row->tgl_lahir) .'</td></tr>'
                    .'<tr><td width="30" align="right">3.</td><td>Jenis Kelamin</td><td>: ' . $row->jns_klmn . '</td></tr>'
                    .'<tr><td width="30" align="right">4.</td><td>NIP/NIK *)</td><td>: ' . $row->nip . '</td></tr>'
                    .'<tr><td width="30" align="right">5.</td><td>Pangkat, Golongan</td><td>: ' . $pangkat . ', ' . $row->golongan . '</td></tr>'
                    .'<tr><td width="30" align="right">6.</td><td>Jabatan Fungsional</td><td>: ' . $jabatan_fungsional . '</td></tr>'
                    .'<tr><td width="30" align="right">7.</td><td>Pendidikan Terakhir</td><td>: ' . $row->pendidikan_akhir . '</td></tr>'
                    .'<tr><td width="30" align="right">8.</td><td>Jurusan</td><td>: ' . $row->jurusan_akhir . '</td></tr>'
                    .'<tr><td width="30" align="right">9.</td><td>Agama</td><td>: ' . $row->agama . '</td></tr>'
                    .'<tr><td width="30" align="right">10.</td><td>Alamat Rumah</td><td>: ' . $row->alamat . '</td></tr>'
                    .'<tr><td width="30" align="right">11.</td><td>No. Telepon/No. HP</td><td>: ' . $row->telepon1 . ' / ' . $row->telepon2 . '</td></tr>';

            print '<tr><td colspan="3"><strong>III. IDENTITAS LEMBAGA/SEKOLAH PENGIRIM</strong></td></tr>'
                    .'<tr><td width="30" align="right">1.</td><td>Nama Sekolah/Institusi yang menugaskan</td><td>: ' . $row->nama_sekolah . '</td></tr>'
                    .'<tr><td width="30" align="right">2.</td><td>Status Sekolah/Institusi*)</td><td>: ' . $row->status_sekolah . '</td></tr>'
                    .'<tr><td width="30" align="right">3.</td><td>Alamat Sekolah/Institusi yang menugaskan</td><td>: ' . $row->alamat_sekolah . '</td></tr>'
                    .'<tr><td width="30" align="right"></td><td>No. Telepon/No. Fax</td><td>: ' . $row->telepon_sekolah . '</td></tr>'
                    .'<tr><td width="30" align="right">4.</td><td>Kota/Kabupaten *)</td><td>: ' . $row->golongan . '</td></tr>'
                    .'<tr><td width="30" align="right">5.</td><td>Propinsi</td><td>: ' . $row->golongan . '</td></tr>'
                    .'<tr><td width="30" align="right">6.</td><td>Email/Website</td><td>: ' . $row->email . ' / '. $row->website . '</td></tr>'
                    .'<tr><td width="30" align="right">7.</td><td>NSS</td><td>: ' . $row->nss . '</td></tr>';
            
        }
         
        print '</table></div></body></html>';
        
  endif;
?>

<?php
  /* == Create Diklat_PesertaValidasi Print == */
  if (isset($_GET['action']) and $_GET['action'] == "createPrintBiodataDiklat_Peserta"):

        if(isset($_GET['id']))
            $id = $_GET['id'];
        else
            $id = 0;
                                           
        $sql = "SELECT dp.*,"
        . "\n p.nama_propinsi," 
        . "\n k.nama_kota," 
        . "\n dk.nama_diklat," 
        . "\n dj.tgl_mulai, dj.tgl_akhir, dj.tempat," 
        . "\n dep.nama_departemen" 
        . "\n FROM ((((diklat_peserta AS dp" 
        . "\n LEFT JOIN propinsi AS p ON dp.propinsi_kode = p.kode)"
        . "\n LEFT JOIN kota AS k ON dp.kota_kode = k.kode)"
        . "\n LEFT JOIN diklat_jadwal AS dj ON dp.jadwalid = dj.id)"
        . "\n LEFT JOIN diklat AS dk ON dj.diklatid = dk.id)"
        . "\n LEFT JOIN departemen AS dep ON dk.departemenid = dep.id"
        . "\n WHERE dp.id = " . $id;

        $row = $db->first($sql);
        
        if ($row) {
            
            $pangkat = '';
            $jabatan_fungsional = '';
            
            if ($row->golongan) {
                $sql = "SELECT *"
                . "\n FROM golongan" 
                . "\n WHERE kode = '" . $row->golongan . "'";

                $grow = $db->first($sql);
                if ($grow) {
                    $pangkat = $grow->nama_pangkat;
                    $jabatan_fungsional = $grow->nama_fungsional;
                    
                    unset ($grow);
                }
            }
            
            print '<html><style type="text/css">'
                   .'body, th, td {font-family:arial,sans-serif; font-size: 100%; margin:20;}'
                   .'a:link, a:active, a:visited{color:#0000CC}'
                   .'.si td {border: solid 0px #aaaaaa;padding:10px; line-height:140%; white-space: nowrap;}</style>'
                   .'<script type="text/javascript"> function p() { window.print(); } </script></head>'
                   .'<body onload="p()"><b>BIODATA PESERTA DIKLAT</b><br><br>'
                   .'<div class="si"><table>';

            // print '<tr><td><strong>Nama Diklat</strong></td><td>: '. $row->nama_diklat . '</td></tr>'
            //         .'<tr><td><strong>Waktu Pelaksanaan</strong></td><td>: '. setToStrdate($row->tgl_mulai) . ' s.d ' . setToStrdate($row->tgl_akhir) . '</td></tr>'
            //         .'<tr><td><strong>Tempat/Departemen Pelaksana</strong></td><td>: '. $row->tempat . ' / ' . $row->nama_departemen . '</td></tr>';

            // print '<tr><td colspan="3"><strong>I. TATA TULIS PENULISAN</strong></td></tr>'
            //         .'<tr><td colspan="3">Data harus diisi dengan benar dan lengkap karena akan digunakan untuk Sertifikat, apabila dalam pengisian data tidak benar, bukan tanggung jawab kami</td></tr>';
                       
            print '<tr><td colspan="3"><strong>I. IDENTITAS PESERTA</strong></td></tr>'
                    .'<tr><td width="10" align="right">1.</td><td>Nama (Lengkap dengan gelar)</td><td>: ' . $row->nama_lengkap . '</td></tr>'
                    .'<tr><td width="10" align="right">2.</td><td>Tempat, Tanggal Lahir</td><td>: ' . $row->tmp_lahir . ', ' . setToStrdate($row->tgl_lahir) .'</td></tr>'
                    .'<tr><td width="10" align="right">3.</td><td>Jenis Kelamin</td><td>: ' . $row->jns_klmn . '</td></tr>'
                    .'<tr><td width="10" align="right">4.</td><td>NIP/NIK *)</td><td>: ' . $row->nip . '</td></tr>'
                    .'<tr><td width="10" align="right">5.</td><td>Pangkat, Golongan</td><td>: ' . $pangkat . ', ' . $row->golongan . '</td></tr>'
                    .'<tr><td width="10" align="right">6.</td><td>Jabatan Fungsional</td><td>: ' . $jabatan_fungsional . '</td></tr>'
                    .'<tr><td width="10" align="right">7.</td><td>Pendidikan Terakhir</td><td>: ' . $row->pendidikan_akhir . '</td></tr>'
                    .'<tr><td width="10" align="right">8.</td><td>Jurusan</td><td>: ' . $row->jurusan_akhir . '</td></tr>'
                    .'<tr><td width="10" align="right">9.</td><td>Agama</td><td>: ' . $row->agama . '</td></tr>'
                    .'<tr><td width="10" align="right">10.</td><td>Alamat Rumah</td><td>: ' . $row->alamat . '</td></tr>'
                    .'<tr><td width="10" align="right">11.</td><td>No. Telepon/No. HP</td><td>: ' . $row->telepon1 . ' / ' . $row->telepon2 . '</td></tr>';

            print '<tr><td colspan="3"><strong>II. IDENTITAS LEMBAGA/SEKOLAH PENGIRIM</strong></td></tr>'
                    .'<tr><td width="10" align="right">1.</td><td>Nama Sekolah/Institusi yang menugaskan</td><td>: ' . $row->nama_sekolah . '</td></tr>'
                    .'<tr><td width="10" align="right">2.</td><td>Status Sekolah/Institusi*)</td><td>: ' . $row->status_sekolah . '</td></tr>'
                    .'<tr><td width="10" align="right">3.</td><td>Alamat Sekolah/Institusi yang menugaskan</td><td>: ' . $row->alamat_sekolah . '</td></tr>'
                    .'<tr><td width="10" align="right"></td><td>No. Telepon/No. Fax</td><td>: ' . $row->telepon_sekolah . '</td></tr>'
                    .'<tr><td width="10" align="right">4.</td><td>Kota/Kabupaten *)</td><td>: ' . $row->golongan . '</td></tr>'
                    .'<tr><td width="10" align="right">5.</td><td>Propinsi</td><td>: ' . $row->golongan . '</td></tr>'
                    .'<tr><td width="10" align="right">6.</td><td>Email/Website</td><td>: ' . $row->email . ' / '. $row->website . '</td></tr>'
                    .'<tr><td width="10" align="right">7.</td><td>NSS</td><td>: ' . $row->nss . '</td></tr>';
            
        }
         
        print '</table></div></body></html>';
        
  endif;
?>
<?php
//Author Muiz
  /* == Create Sertifikat == */
  if (isset($_GET['action']) and $_GET['action'] == "createPrintSertifikat"):
        if(isset($_GET['id']))
            $id = $_GET['id'];
        else
            $id = 0;			
		
				$sql = "SELECT dp.*,"
                . "\n pt.nuptk, pt.nama_lengkap, pt.nip, pt.alamat, pt.tmp_lahir, pt.tgl_lahir, pt.jns_klmn, pt.golongan, pt.agama, pt.alamat, pt.telepon1, pt.nama_ibu,"
                . "\n s.nama_sekolah," 
                . "\n p.nama_propinsi,"
                . "\n d.nama_diklat, DATE_FORMAT( dj.tgl_mulai,'%d %M %Y') as tgl_mulai,DATE_FORMAT( dj.tgl_akhir,'%d %M %Y') as tgl_akhir, dj.tempat,(SELECT nama_kota from kota where dp.kota_kode=kota.kode)as kota,"				. "\n (SELECT SUM(nilai * bobot)/100 AS nilai FROM `diklat_nilai` AS dn INNER JOIN diklat_mata_tatar dmt ON dmt.id = dn.mata_tatarid WHERE dn.pesertaid = dp.id) AS totalnilai"
                . "\n FROM ((diklat_peserta as dp" 
                . "\n LEFT JOIN ptk as pt ON dp.personid = pt.id)" 
                . "\n LEFT JOIN sekolah as s ON dp.instansiid = s.id)" 
                . "\n LEFT JOIN propinsi as p ON pt.propinsi_kode = p.kode" 
                . "\n LEFT JOIN diklat_jadwal as dj ON dp.jadwalid = dj.id"
                . "\n LEFT JOIN diklat as d ON dj.diklatid = d.id"                
				. "\n WHERE dp.id = '" . $id . "'";
       
        $row = $db->first($sql);
 
        //materi
        $sql2 = "SELECT DISTINCT nama_materi, deskripsi_materi From materi m, diklat_mata_tatar dmt Where dmt.kategoriid = m.kategoriid and jadwalid = '" . $row->jadwalid . "'";
        $row2 = $db->fetch_all($sql2);
            
       if ($row) {
           $nilai = $row->totalnilai;
           $predikat = '';
           if($nilai >= 80){
               $predikat = "BAIK";
           }else if($nilai >= 60){
               $predikat = "CUKUP";
           }else if($nilai <= 50){
               $predikat = "KURANG";
           }
 
           print '<html moznomarginboxes mozdisallowselectionprint><script type="text/javascript"> </script></head><body style="font-family:arial;"><style type="text/css">.pagebreak { page-break-before: always; }.body, th, td {font-family:Arial;}table { border-collapse:collapse; } table thead th { border-bottom: 0px solid #000; }'
                   .'body, th, td {font-family:arial,sans-serif; font-size: 100%; margin:0;}'
                   .'a:link, a:active, a:visited{color:#0000CC}'
                   .'p,h4,h3,h2 {text-align:center}'
                   .'.centert {center}'
                   .'</style>'
                   .'<script type="text/javascript"> function p(){window.print();}</script></head>'
                   .'<body onload="p()"><p>NOMOR : '.$row->no_sertifikat.'</p>'
                   .'<p>Diberikan kepada : </p>'
                   .'<h2>'.$row->nama_lengkap.'</h2>'
                   .'<table align="center"><tr><td>Nomor Peserta</td><td>:</td><td>'.$row->nuptk.'</td></tr>'
                   .'<tr><td>Nama Sekolah</td><td>:</td><td>'.$row->nama_sekolah.'</td></tr>'
                   .'<tr><td>Kabupaten/Kota</td><td>:</td><td>'.$row->nama_propinsi.'</td></tr></table>'
                   .'<p>sebagai Peserta Program</p>'
                   .'<h4>'.$row->nama_diklat.'</h4>';
                   
                   foreach ($row2 as $v) {					print '<p><i>'.$v->nama_materi.'';				   if($v->nama_materi != ''){					    print ' : ';				   }				   
                   print ''.$v->deskripsi_materi.'</i></p>';					//print '<p><i>'.$v->nama_materi.' : '.$v->deskripsi_materi.'</i></p>';
                   }
                   
                  print '<p>yang diselenggarakan</p>'
                   .'<p>pada tanggal '.$row->tgl_mulai.' sampai dengan '.$row->tgl_akhir.'</p>'
                   .'<p>di '.$row->tempat.', dengan predikat : </p>'
                   .'<h2>--- '.$predikat.' ---</h2><br><br>'
                   .'<p>'.$row->kota.',</p>'
                   .'<p>Kepala,</p><br><br><br><br>'
                   .'<p><b><u>'.$row->nama_pimpinan.'</b></u></p>'
                   .'<p>NIP '.$row->nss.'</p>';        }        print '</body></html>';  endif;?>

<?php
/* == Create Sertifikat Belakang == 
Author Muiz
*/  
if (isset($_GET['action']) and $_GET['action'] == "createPrintSertifikatBelakang"):        
if(isset($_GET['id']))            
	$id = $_GET['id'];        
else            
	$id = 0;			
$sql = "SELECT jadwalid FROM diklat_peserta dp WHERE dp.id = '" . $id . "'";               
$row = $db->first($sql);        

$sql2 = "SELECT DISTINCT nama_kategori,nama_materi, deskripsi_materi,jam From materi m, diklat_mata_tatar dmt, kategori k Where dmt.kategoriid = m.kategoriid and m.kategoriid = k.kode and jadwalid = '" . $row->jadwalid . "' ORDER BY k.kode";        
$row2 = $db->fetch_all($sql2);		
$jumlah = 0;		
$totaljamkategori = 0;		
$kategoriarray = array();            
print '<html moznomarginboxes mozdisallowselectionprint><script type="text/javascript"> </script></head><body style="font-family:arial;"><style type="text/css">.pagebreak { page-break-before: always; }</style>'                   
.'<script type="text/javascript"> function p(){window.print();}</script></head>'                   
.'<body onload="p()">'                   .
'<h2 style="text-align:center">STRUKTUR PROGRAM</h2>'					
.'<table border = "2" align="center" style="height: 130px; width: 589px;">'					
.'<tbody>'					
.'<tr>'					
.'<td style="width: 62px; text-align: center;"><strong>NO.</strong></td>'					
.'<td style="width: 424px; text-align: center;"><strong>MATERI</strong></td>'					
.'<td style="width: 91px; text-align: center;"><strong>JAM PELAJARAN</strong></td>'					
.'</tr>';						

foreach ($row2 as $v) {				
$jumlah += $v->jam;			
array_push($kategoriarray,$v->nama_kategori);			
}						
$kategoriarray = array_unique($kategoriarray);			
$kategoriarray = array_values($kategoriarray);			
$arrlength = count($kategoriarray);						

for($x = 0; $x < $arrlength; $x++) {						
$totaljamkategori = 0;			

foreach ($row2 as $v) {				
if($kategoriarray[$x] == $v->nama_kategori){				
$totaljamkategori += $v->jam;			
}
		}							
print	'<tr>'					.
'<td style="width: 486px; text-align: left;" colspan="2"><strong>'.$kategoriarray[$x].'</strong></td>'					
.'<td style="width: 91px; text-align: center;"><strong>'.$totaljamkategori.'</strong></td>'					
.'</tr>';											

foreach ($row2 as $v) {							

if($kategoriarray[$x] == $v->nama_kategori){							
print	'<tr>'					
.'<td style="width: 62px; text-align: center;">'.$v->nama_materi.'</td>'					
.'<td style="width: 424px;">'.$v->deskripsi_materi.'</td>'					
.'<td style="width: 91px; text-align: center;">'.$v->jam.'</td>'					
.'</tr>';			
}								
}		
}						
print	'<tr>'					
.'<td style="width: 62px; text-align: center;">&nbsp;</td>'					
.'<td style="width: 424px; text-align: center;"><strong>Jumlah</strong></td>'					
.'<td style="width: 91px; text-align: center;">'.$jumlah.'</td>'					
.'</tr>';			
print '</table></body></html>';  
endif;?>
 
