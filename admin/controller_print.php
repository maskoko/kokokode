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
                   .'<body onload="p()"><b>Data Pendidik dan Tenaga Kependidikan (PTK)</b><br><br>'
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
                   .'<body onload="p()"><b>Data Minat Diklat PTK</b><br><br>'
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
