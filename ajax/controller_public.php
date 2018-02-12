<?php
  /**
   * Controller for Public Access
   *
   * @package SIM PPPPTK BMTI
   * @author a2ngsa
   * @copyright 2012
   * @version $Id: controller.php, v1.00 2011-11-10 10:12:05 gewa Exp $
   */
  define("_VALID_PHP", true);
  require_once("../init.php");

?>

<?php
  /* == Load KotaList == */
  if (isset($_POST['loadKotaList'])):
      if ($_POST['loadKotaList'] == '' || empty($_POST['loadKotaList'])):
          die();
      endif;
      
    $id = $_POST['loadKotaList'];
	  	  
    $content->loadKotaList($id);
  endif;
?>

<?php
  /* == view Sekolah == */
  if (isset($_GET['viewSekolah'])):
      if (intval($_GET['viewSekolah']) == 0 || empty($_GET['viewSekolah'])):
          die();
      endif;
		  
    $sql = "SELECT s.*,"
            . "\n k.nama_kota,"
            . "\n p.nama_propinsi"
            . "\n FROM (sekolah AS s LEFT JOIN kota AS k"
            . "\n ON s.kota_kode=k.kode)"
            . "\n LEFT JOIN propinsi AS p"
            . "\n ON s.propinsi_kode=p.kode"
            . "\n WHERE s.id = " . (int)$_GET['viewSekolah'];
    
    $row = $db->first($sql);

    print '<div class="row-fluid">
                <div class="span12">';
    
    print '<table border="0" cellpadding="4" cellspacing="0" width="100%">
                <tbody>
                    <tr>
                        <td align="right" width="26"></td>
                        <td width="98"></td>
                        <td>Update terakhir: ' . setToStrdatetime($row->last_update) . '</td>
                    </tr>

                    <tr>
                        <td align="right" width="26">1. </td>
                        <td width="98">NSS</td>
                        <td> : ' . $row->nss . '</td>
                    </tr>
                    <tr>
                        <td align="right" width="26">2. </td>
                        <td width="98">NPSN</td>
                        <td> : ' . $row->npsn . '</td>
                    </tr>
                    <tr>
                        <td align="right" width="26">3. </td>
                        <td width="98">Nama Sekolah </td>
                        <td> : ' . $row->nama_sekolah . ',  STATUS: ' . $row->status . '</td>
                    </tr>
                    <tr>
                        <td align="right" width="26">4. </td>
                        <td width="98">Alamat </td>
                        <td> : ' . $row->alamat . '</td>
                    </tr>

                    <tr>
                        <td align="right" width="26">&nbsp;</td>
                        <td width="98">&nbsp;</td>
                        <td> : KEC. ' . $row->kecamatan . ', ' . $row->nama_kota . ', ' . $row->nama_propinsi . '</td>
                    </tr>
                    <tr>
                        <td align="right" width="26">5. </td>
                        <td width="98">Kodepos</td>
                        <td> : ' . $row->kodepos . '</td>
                    </tr>
                    <tr>
                        <td align="right" width="26">6. </td>
                        <td width="98">Telp/Fax</td>
                        <td> : ' . $row->telepon . ' / ' . $row->fax . '</td>
                    </tr>
                    <tr>
                        <td align="right" width="26">7. </td>
                        <td width="98">Website/Email</td>
                        <td> : ' . $row->website . '<br>&nbsp;&nbsp;&nbsp;' . $row->email . '</td>
                    </tr>
                    <tr>
                        <td align="right" width="26">8. </td>
                        <td width="98">Sertifikasi ISO</td>
                        <td> : ' . $row->sertf_iso . '</td>
                    </tr>
                    <tr>
                        <td align="right" width="26">9. </td>
                        <td width="98">Akreditasi</td>
                        <td> : ' . $row->akreditasi . '</td>
                    </tr>
                    <tr>
                        <td align="right" width="26">&nbsp;</td>
                        <td width="98">&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>

                    <tr>
                        <td align="right" width="26"></td>
                        <td width="98"></td>
                        <td><a href="ajax/controller_public.php?createPrintSekolah=' .$_GET['viewSekolah']. '" class="btn btn-info" target="_blank"><span class="icon16 icomoon-icon-printer"></span>Print</a></td>
                    </tr>
                </tbody>
            </table>';
    
    print ' </div>
        </div>';
    		  
  endif;
  
?>

<?php
  /* ================================= view PTK ============================= */
  if (isset($_GET['viewPTK'])):
      if (intval($_GET['viewPTK']) == 0 || empty($_GET['viewPTK'])):
          die();
      endif;
		  
    $sql = "SELECT pt.*,"
            . "\n k.nama_kota,"
            . "\n p.nama_propinsi"
            . "\n FROM (ptk AS pt LEFT JOIN propinsi AS p"
            . "\n ON pt.propinsi_kode=p.kode)"
            . "\n LEFT JOIN kota AS k"
            . "\n ON pt.kota_kode=k.kode"
            . "\n WHERE pt.id = " . (int)$_GET['viewPTK'];
    
    $row = $db->first($sql);
        
    print '<div class="row-fluid">
                <div class="span12">';
    
    if ($row) {
        
        if ($row->sekolahid) {

            $s_sql = "SELECT s.*,"
                    . "\n k.nama_kota,"
                    . "\n p.nama_propinsi"
                    . "\n FROM (sekolah AS s LEFT JOIN kota AS k"
                    . "\n ON s.kota_kode=k.kode)"
                    . "\n LEFT JOIN propinsi AS p"
                    . "\n ON s.propinsi_kode=p.kode"
                    . "\n WHERE s.id = " . (int)$row->sekolahid;
            
            $s_row = $db->first($s_sql);
                        
            if ($s_row) {
            
                print '<table border="0" cellpadding="4" cellspacing="0" width="100%">
                            <tbody>
                                <tr>
                                    <td colspan="2"><strong>A. Data Sekolah</strong></td>
                                    <td>Update terakhir: ' . setToStrdatetime($s_row->last_update) . '</td>
                                </tr>

                                <tr>
                                    <td align="right" width="26">1. </td>
                                    <td width="98">NSS</td>
                                    <td> : ' . $s_row->nss . '</td>
                                </tr>
                                <tr>
                                    <td align="right" width="26">2. </td>
                                    <td width="98">Nama Sekolah </td>
                                    <td> : ' . $s_row->nama_sekolah . ',  STATUS: ' . $s_row->status . '</td>
                                </tr>
                                <tr>
                                    <td align="right" width="26">3. </td>
                                    <td width="98">Alamat </td>
                                    <td> : ' . $s_row->alamat . '</td>
                                </tr>

                                <tr>
                                    <td align="right" width="26">&nbsp;</td>
                                    <td width="98">&nbsp;</td>
                                    <td> : KEC. ' . $s_row->kecamatan . ', ' . $s_row->nama_kota . ', ' . $s_row->nama_propinsi . '</td>
                                </tr>
                                <tr>
                                    <td align="right" width="26">4. </td>
                                    <td width="98">Kodepos</td>
                                    <td> : ' . $s_row->kodepos . '</td>
                                </tr>
                                <tr>
                                    <td align="right" width="26">5. </td>
                                    <td width="98">Telp/Fax</td>
                                    <td> : ' . $s_row->telepon . ' / ' . $s_row->fax . '</td>
                                </tr>
                                <tr>
                                    <td align="right" width="26">6. </td>
                                    <td width="98">Website/Email</td>
                                    <td> : ' . $s_row->website . '<br>&nbsp;&nbsp;&nbsp;' . $s_row->email . '</td>
                                </tr>
                                <tr>
                                    <td align="right" width="26">&nbsp;</td>
                                    <td width="98">&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>                
                            </tbody>
                        </table>';

                unset ($s_row);
                
            } else
                print '<p>Data ID Sekolah tidak valid!</p>';
        
        } else
            print '<p>Data Sekolah tidak ditemukan!</p>';
        
        $jabatan = '-'; // ????
        
        print '<table border="0" cellpadding="4" cellspacing="0" width="100%">
                    <tbody>
                        <tr>
                            <td colspan="2"><strong>B. Identitas</strong></td>
                            <td>Update terakhir: ' . setToStrdatetime($row->last_update) . '</td>
                        </tr>

                        <tr>
                            <td align="right">1. </td>
                            <td>NUPTK</td>
                            <td> : ' . $row->nuptk . '</td>
                        </tr>
                        <tr>
                            <td align="right">2. </td>
                            <td>NIP</td>
                            <td> : ' . $row->nip . '</td>
                        </tr>
                        <tr>
                            <td align="right">3. </td>
                            <td>Nama</td>
                            <td> : ' . $row->nama_lengkap . '</td>
                        </tr>
                        <tr>
                            <td align="right">4. </td>
                            <td>Tempat.Tgl. Lahir</td>
                            <td> : ' . $row->tmp_lahir . ', ' . setToStrdate($row->tgl_lahir) . '</td>
                        </tr>
                        <tr>
                            <td align="right">5. </td>
                            <td>Jenis Kelamin</td>
                            <td> : ' . $row->jns_klmn . '</td>
                        </tr>
                        <tr>
                            <td align="right">6. </td>
                            <td>Jabatan</td>
                            <td> : ' . $jabatan . '</td>
                        </tr>
                        <tr>
                            <td align="right">7. </td>
                            <td>Pangkat / Gol.</td>
                            <td> : Penata Muda Tk. I, III/b</td>
                        </tr>

                        <tr>
                            <td align="right">8. </td>
                            <td>Agama</td>
                            <td> : ' . $row->agama . '</td>
                        </tr>
                        <tr>
                            <td align="right">9. </td>
                            <td>Pend. Terakhir </td>
                            <td> : ' . $row->ijazah_akhir . ', ' . $row->pendidikan_akhir . '</td>
                        </tr>
                        <tr>
                            <td align="right">10. </td>
                            <td>Email Pribadi</td>
                            <td> : ' . $row->email . '</td>
                        </tr>
                        <tr>
                            <td align="right">11. </td>
                            <td>Web Pribadi</td>
                            <td> : ' . $row->website . '</td>
                        </tr>
                        <tr>
                            <td align="right">12. </td>
                            <td>Sertifikasi Profesi Guru</td>
                            <td> :  </td>
                        </tr>
                        <tr>
                            <td align="right">13. </td>
                            <td>Akta Mengajar</td>
                            <td> : </td>
                        </tr>
                        <tr>
                            <td align="right">14. </td>
                            <td>Uji Kompetensi Awal</td>
                            <td> : </td>
                        </tr>
                        <tr>
                            <td align="right">15. </td>
                            <td>Uji Kompetensi Guru</td>
                            <td> : </td>
                        </tr>
                        
                        <tr>
                            <td colspan="2"></td>
                            <td><a href="ajax/controller_public.php?createPrintPTK=' .$_GET['viewPTK']. '" class="btn btn-info" target="_blank"><span class="icon16 icomoon-icon-printer"></span>Print</a></td>
                        </tr>
                    </tbody>
                   </table>';
    
      unset ($row);  
        
    } else
        print '<p>Data PTK tidak ditemukan!</p>';

    print '
                </div>
            </div>';
        
  endif;
  
?>

<?php
  /* == view Diklat == */
  if (isset($_GET['viewDiklat'])):
      if (intval($_GET['viewDiklat']) == 0 || empty($_GET['viewDiklat'])):
          die();
      endif;
	  
    $sql = "SELECT * FROM diklat WHERE id = " . (int)$_GET['viewDiklat'];
    $row = $db->first($sql);

    print '<div class="row-fluid">
                <div class="span12">
                    <table border="0" cellpadding="4" cellspacing="0" width="100%">
                        <tbody>
                            <tr>
                                <td align="right" width="26"></td>
                                <td width="98"></td>
                                <td>Update terakhir: ' . setToStrdatetime($row->last_update) . '</td>
                            </tr>

                            <tr>
                                <td align="right" width="26">1. </td>
                                <td width="98">Kode</td>
                                <td> : ' . $row->kode . '</td>
                            </tr>
                            <tr>
                                <td align="right" width="26">2. </td>
                                <td width="98">Nama Diklat</td>
                                <td> : ' . $row->nama_diklat . '</td>
                            </tr>
                            <tr>
                                <td align="right" width="26">3. </td>
                                <td width="98">Pola/Jml Jam</td>
                                <td> : ' . $row->jml_jam . '</td>
                            </tr>
                            <tr>
                                <td align="right" width="26">4. </td>
                                <td width="98">Tingkat</td>
                                <td> : ' . $row->tingkat . '</td>
                            </tr>

                            <tr>
                                <td align="right" width="26"></td>
                                <td width="98"></td>
                                <td><a href="ajax/controller_public.php?createPrintDiklat=' .$_GET['viewDiklat']. '" class="btn btn-info" target="_blank"><span class="icon16 icomoon-icon-printer"></span>Print</a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>';
		  
  endif;
  
?>

<?php
  /* == view Diklat_Jadwal == */
  if (isset($_GET['viewDiklat_Jadwal'])):
      if (intval($_GET['viewDiklat_Jadwal']) == 0 || empty($_GET['viewDiklat_Jadwal'])):
          die();
      endif;
	  
    $sql = "SELECT dj.*, dk.kode, dk.nama_diklat, dk.jml_jam, dk.tingkat, dk.jenis"
            ."\n FROM diklat_jadwal as dj LEFT JOIN diklat as dk"
            ."\n ON dj.diklatid = dk.id"
            ."\n WHERE dj.id = " . (int)$_GET['viewDiklat_Jadwal'];

    $row = $db->first($sql);

    print '<div class="row-fluid">
                <div class="span12">
                    <table border="0" cellpadding="4" cellspacing="0" width="100%">
                        <tbody>
                            <tr>
                                <td align="right" width="26">1. </td>
                                <td width="98">Kode Diklat</td>
                                <td> : ' . $row->kode . '</td>
                            </tr>
                            <tr>
                                <td align="right" width="26">2. </td>
                                <td width="98">Nama Diklat</td>
                                <td> : ' . $row->nama_diklat . '</td>
                            </tr>
                            <tr>
                                <td align="right" width="26">3. </td>
                                <td width="98">Pola/Jml Jam</td>
                                <td> : ' . $row->jml_jam . ' Tingkat : ' . $row->tingkat . '</td>
                            </tr>
                            <tr>
                                <td align="right" width="26">4. </td>
                                <td width="98">Jadwal Mulai</td>
                                <td> : ';
    if ($row->tgl_mulai) print setToStrdate($row->tgl_mulai); else print '-';
    print ' - ';
    if ($row->tgl_akhir) print setToStrdate($row->tgl_akhir); else print '-';
    print '</td>
                            </tr>
                            <tr>
                                <td align="right" width="26">4. </td>
                                <td width="98">Registrasi</td>
                                <td> : ';
    if ($row->reg_mulai) print setToStrdate($row->reg_mulai); else print '-';
    print ' - ';
    if ($row->reg_akhir) print setToStrdate($row->reg_akhir); else print '-';
    print '</td>
                            </tr>

                            <tr>
                                <td align="right" width="26"></td>
                                <td width="98"></td>
                                <td><a href="ajax/controller_public.php?createPrintDiklat_Jadwal=' .$_GET['viewDiklat_Jadwal']. '" class="btn btn-info" target="_blank"><span class="icon16 icomoon-icon-printer"></span>Print</a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>';
        		  
  endif;
  
?>


<?php

  /* == Load Diklat_JadwalList == */
  if (isset($_POST['loadDiklat_JadwalList'])):
      if (intval($_POST['loadDiklat_JadwalList']) == 0 || empty($_POST['loadDiklat_JadwalList'])):
          die();
      endif;
	  	  
	$events = array();

	$sql = "SELECT dj.*, DATE_FORMAT(dj.tgl_mulai, '%Y-%m-%d' ) AS j_tgl_mulai, dk.kode, dk.nama_diklat, dk.tingkat"
		."\n FROM diklat_jadwal as dj LEFT JOIN diklat as dk"
		."\n ON dj.diklatid = dk.id"
		."\n ORDER BY dj.tgl_mulai";
		
	$rows = $db->fetch_all($sql);
	if($rows) {
		foreach ($rows as $row) {
		
			$eventArray['id'] = $row->id;
			$eventArray['title'] =  $row->nama_diklat;
			$eventArray['start'] =  $row->j_tgl_mulai;
			//$eventArray['url'] = ;
			$eventArray['color'] = "#9FC569";
			
			$events[] = $eventArray;			
			
		}
		
		echo json_encode($events);
	}
		  
  endif;
?>

<?php
  /* ======================== view Diklat_Peserta ============================= */
  if (isset($_GET['viewDiklat_Peserta'])):
      if (intval($_GET['viewDiklat_Peserta']) == 0 || empty($_GET['viewDiklat_Peserta'])):
          die();
      endif;

    $p_sql = "SELECT dp.*,"
            . "\n dj.tahun,dj.tgl_mulai,dj.tgl_akhir,"
            . "\n dk.kode,dk.nama_diklat"
            . "\n FROM (diklat_peserta AS dp LEFT JOIN diklat_jadwal AS dj"
            . "\n ON dp.jadwalid=dj.id)"
            . "\n LEFT JOIN diklat AS dk"
            . "\n ON dj.diklatid=dk.id"
            . "\n WHERE dp.id = " . (int)$_GET['viewDiklat_Peserta'];
    
    $p_row = $db->first($p_sql);
      
    $ptkid = $p_row->personid;
      
    $sql = "SELECT pt.*,"
            . "\n k.nama_kota,"
            . "\n p.nama_propinsi"
            . "\n FROM (ptk AS pt LEFT JOIN propinsi AS p"
            . "\n ON pt.propinsi_kode=p.kode)"
            . "\n LEFT JOIN kota AS k"
            . "\n ON pt.kota_kode=k.kode"
            . "\n WHERE pt.id = " . $ptkid;
    
    $row = $db->first($sql);

    print '<div class="row-fluid">
                <div class="span12">';
        
    if ($row) {
        
        if ($row->sekolahid) {

            $s_sql = "SELECT s.*,"
                    . "\n k.nama_kota,"
                    . "\n p.nama_propinsi"
                    . "\n FROM (sekolah AS s LEFT JOIN kota AS k"
                    . "\n ON s.kota_kode=k.kode)"
                    . "\n LEFT JOIN propinsi AS p"
                    . "\n ON s.propinsi_kode=p.kode"
                    . "\n WHERE s.id = " . (int)$row->sekolahid;
            
            $s_row = $db->first($s_sql);
                        
            if ($s_row) {
            
                print '<table border="0" cellpadding="4" cellspacing="0" width="100%">
                            <tbody>
                                <tr>
                                    <td colspan="2"><strong>A. Data Sekolah</strong></td>
                                    <td>Update terakhir: ' . setToStrdatetime($s_row->last_update) . '</td>
                                </tr>

                                <tr>
                                    <td align="right" width="26">1. </td>
                                    <td width="98">NSS</td>
                                    <td> : ' . $s_row->nss . '</td>
                                </tr>
                                <tr>
                                    <td align="right" width="26">2. </td>
                                    <td width="98">Nama Sekolah </td>
                                    <td> : ' . $s_row->nama_sekolah . ',  STATUS: ' . $s_row->status . '</td>
                                </tr>
                                <tr>
                                    <td align="right" width="26">3. </td>
                                    <td width="98">Alamat </td>
                                    <td> : ' . $s_row->alamat . '</td>
                                </tr>

                                <tr>
                                    <td align="right" width="26">&nbsp;</td>
                                    <td width="98">&nbsp;</td>
                                    <td> : KEC. ' . $s_row->kecamatan . ', ' . $s_row->nama_kota . ', ' . $s_row->nama_propinsi . '</td>
                                </tr>
                                <tr>
                                    <td align="right" width="26">4. </td>
                                    <td width="98">Kodepos</td>
                                    <td> : ' . $s_row->kodepos . '</td>
                                </tr>
                                <tr>
                                    <td align="right" width="26">5. </td>
                                    <td width="98">Telp/Fax</td>
                                    <td> : ' . $s_row->telepon . ' / ' . $s_row->fax . '</td>
                                </tr>
                                <tr>
                                    <td align="right" width="26">6. </td>
                                    <td width="98">Website/Email</td>
                                    <td> : ' . $s_row->website . '<br>&nbsp;&nbsp;&nbsp;' . $s_row->email . '</td>
                                </tr>
                                <tr>
                                    <td align="right" width="26">&nbsp;</td>
                                    <td width="98">&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>                
                            </tbody>
                        </table>';

                unset ($s_row);
                
            } else
                print '<p>Data ID Sekolah tidak valid!</p>';
        
        } else
            print '<p>Data Sekolah tidak ditemukan!</p>';
        
        $jabatan = '-'; // ????
        
        print '<table border="0" cellpadding="4" cellspacing="0" width="100%">
                    <tbody>
                        <tr>
                            <td colspan="2"><strong>B. Identitas</strong></td>
                            <td>Update terakhir: ' . setToStrdatetime($row->last_update) . '</td>
                        </tr>

                        <tr>
                            <td align="right">1. </td>
                            <td>NUPTK</td>
                            <td> : ' . $row->nuptk . '</td>
                        </tr>
                        <tr>
                            <td align="right">2. </td>
                            <td>NIP</td>
                            <td> : ' . $row->nip . '</td>
                        </tr>
                        <tr>
                            <td align="right">3. </td>
                            <td>Nama</td>
                            <td> : ' . $row->nama_lengkap . '</td>
                        </tr>
                        <tr>
                            <td align="right">4. </td>
                            <td>Tempat.Tgl. Lahir</td>
                            <td> : ' . $row->tmp_lahir . ', ' . setToStrdate($row->tgl_lahir) . '</td>
                        </tr>
                        <tr>
                            <td align="right">5. </td>
                            <td>Jenis Kelamin</td>
                            <td> : ' . $row->jns_klmn . '</td>
                        </tr>
                        <tr>
                            <td align="right">6. </td>
                            <td>Jabatan</td>
                            <td> : ' . $jabatan . '</td>
                        </tr>
                        <tr>
                            <td align="right">7. </td>
                            <td>Pangkat / Gol.</td>
                            <td> : Penata Muda Tk. I, III/b</td>
                        </tr>

                        <tr>
                            <td align="right">8. </td>
                            <td>Agama</td>
                            <td> : ' . $row->agama . '</td>
                        </tr>
                        <tr>
                            <td align="right">9. </td>
                            <td>Pend. Terakhir </td>
                            <td> : ' . $row->ijazah_akhir . ', ' . $row->pendidikan_akhir . '</td>
                        </tr>
                        <tr>
                            <td align="right">10. </td>
                            <td>Email Pribadi</td>
                            <td> : ' . $row->email . '</td>
                        </tr>
                        <tr>
                            <td align="right">11. </td>
                            <td>Web Pribadi</td>
                            <td> : ' . $row->website . '</td>
                        </tr>
                        <tr>
                            <td align="right">12. </td>
                            <td>Sertifikasi Profesi Guru</td>
                            <td> :  </td>
                        </tr>
                        <tr>
                            <td align="right">13. </td>
                            <td>Akta Mengajar</td>
                            <td> : </td>
                        </tr>
                        <tr>
                            <td align="right">14. </td>
                            <td>Uji Kompetensi Awal</td>
                            <td> : </td>
                        </tr>
                        <tr>
                            <td align="right">15. </td>
                            <td>Uji Kompetensi Guru</td>
                            <td> : </td>
                        </tr>
                    </tbody>
                   </table>';
    
      unset ($row);  
        
    } else
        print '<p>Data PTK tidak ditemukan!</p>';

    print '
                </div>
            </div>';
        
  endif;
  
?>

<?php
  /* == Create PTK Print == */
  if (isset($_GET['createPrintPTK'])):
      if (intval($_GET['createPrintPTK']) == 0 || empty($_GET['createPrintPTK'])):
          die();
      endif;
                    
    $sql = "SELECT pt.*,"
            . "\n k.nama_kota,"
            . "\n p.nama_propinsi"
            . "\n FROM (ptk AS pt LEFT JOIN propinsi AS p"
            . "\n ON pt.propinsi_kode=p.kode)"
            . "\n LEFT JOIN kota AS k"
            . "\n ON pt.kota_kode=k.kode"
            . "\n WHERE pt.id = " . (int)$_GET['createPrintPTK'];
    
    $row = $db->first($sql);
        
    if ($row) {
        
        print '<style type="text/css">'
               .'body, th, td {font-family:arial,sans-serif; font-size: 100%; margin:20;}'
               .'a:link, a:active, a:visited{color:#0000CC}'
               .'.si td {white-space: nowrap;}</style>'
               .'<script type="text/javascript"> function p() { window.print(); } </script></head>'
               .'<body onload="p()"><b>Data Data Pendidik dan Tenaga Kependidikan</b><br><br>'
               .'<div class="si">';
                
        if ($row->sekolahid) {

            $s_sql = "SELECT s.*,"
                    . "\n k.nama_kota,"
                    . "\n p.nama_propinsi"
                    . "\n FROM (sekolah AS s LEFT JOIN kota AS k"
                    . "\n ON s.kota_kode=k.kode)"
                    . "\n LEFT JOIN propinsi AS p"
                    . "\n ON s.propinsi_kode=p.kode"
                    . "\n WHERE s.id = " . (int)$row->sekolahid;
            
            $s_row = $db->first($s_sql);
                        
            if ($s_row) {
            
                print '<table border="0" cellpadding="4" cellspacing="0" width="100%">
                            <tbody>
                                <tr>
                                    <td colspan="2"><strong>A. Data Sekolah</strong></td>
                                    <td>Update terakhir: ' . setToStrdatetime($s_row->last_update) . '</td>
                                </tr>

                                <tr>
                                    <td align="right" width="26">1. </td>
                                    <td width="98">NSS</td>
                                    <td> : ' . $s_row->nss . '</td>
                                </tr>
                                <tr>
                                    <td align="right" width="26">2. </td>
                                    <td width="98">Nama Sekolah </td>
                                    <td> : ' . $s_row->nama_sekolah . ',  STATUS: ' . $s_row->status . '</td>
                                </tr>
                                <tr>
                                    <td align="right" width="26">3. </td>
                                    <td width="98">Alamat </td>
                                    <td> : ' . $s_row->alamat . '</td>
                                </tr>

                                <tr>
                                    <td align="right" width="26">&nbsp;</td>
                                    <td width="98">&nbsp;</td>
                                    <td> : KEC. ' . $s_row->kecamatan . ', ' . $s_row->nama_kota . ', ' . $s_row->nama_propinsi . '</td>
                                </tr>
                                <tr>
                                    <td align="right" width="26">4. </td>
                                    <td width="98">Kodepos</td>
                                    <td> : ' . $s_row->kodepos . '</td>
                                </tr>
                                <tr>
                                    <td align="right" width="26">5. </td>
                                    <td width="98">Telp/Fax</td>
                                    <td> : ' . $s_row->telepon . ' / ' . $s_row->fax . '</td>
                                </tr>
                                <tr>
                                    <td align="right" width="26">6. </td>
                                    <td width="98">Website/Email</td>
                                    <td> : ' . $s_row->website . '<br>&nbsp;&nbsp;&nbsp;' . $s_row->email . '</td>
                                </tr>
                                <tr>
                                    <td align="right" width="26">&nbsp;</td>
                                    <td width="98">&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>                
                            </tbody>
                        </table>';

                unset ($s_row);
                
            } else
                print '<p>Data ID Sekolah tidak valid!</p>';
        
        } else
            print '<p>Data Sekolah tidak ditemukan!</p>';
        
        $jabatan = '-'; // ????
        
        print '<table border="0" cellpadding="4" cellspacing="0" width="100%">
                    <tbody>
                        <tr>
                            <td colspan="2"><strong>B. Identitas</strong></td>
                            <td>Update terakhir: ' . setToStrdatetime($row->last_update) . '</td>
                        </tr>

                        <tr>
                            <td align="right">1. </td>
                            <td>NUPTK</td>
                            <td> : ' . $row->nuptk . '</td>
                        </tr>
                        <tr>
                            <td align="right">2. </td>
                            <td>NIP</td>
                            <td> : ' . $row->nip . '</td>
                        </tr>
                        <tr>
                            <td align="right">3. </td>
                            <td>Nama</td>
                            <td> : ' . $row->nama_lengkap . '</td>
                        </tr>
                        <tr>
                            <td align="right">4. </td>
                            <td>Tempat.Tgl. Lahir</td>
                            <td> : ' . $row->tmp_lahir . ', ' . setToStrdate($row->tgl_lahir) . '</td>
                        </tr>
                        <tr>
                            <td align="right">5. </td>
                            <td>Jenis Kelamin</td>
                            <td> : ' . $row->jns_klmn . '</td>
                        </tr>
                        <tr>
                            <td align="right">6. </td>
                            <td>Jabatan</td>
                            <td> : ' . $jabatan . '</td>
                        </tr>
                        <tr>
                            <td align="right">7. </td>
                            <td>Pangkat / Gol.</td>
                            <td> : Penata Muda Tk. I, III/b</td>
                        </tr>

                        <tr>
                            <td align="right">8. </td>
                            <td>Agama</td>
                            <td> : ' . $row->agama . '</td>
                        </tr>
                        <tr>
                            <td align="right">9. </td>
                            <td>Pend. Terakhir </td>
                            <td> : ' . $row->ijazah_akhir . ', ' . $row->pendidikan_akhir . '</td>
                        </tr>
                        <tr>
                            <td align="right">10. </td>
                            <td>Email Pribadi</td>
                            <td> : ' . $row->email . '</td>
                        </tr>
                        <tr>
                            <td align="right">11. </td>
                            <td>Web Pribadi</td>
                            <td> : ' . $row->website . '</td>
                        </tr>
                        <tr>
                            <td align="right">12. </td>
                            <td>Sertifikasi Profesi Guru</td>
                            <td> :  </td>
                        </tr>
                        <tr>
                            <td align="right">13. </td>
                            <td>Akta Mengajar</td>
                            <td> : </td>
                        </tr>
                        <tr>
                            <td align="right">14. </td>
                            <td>Uji Kompetensi Awal</td>
                            <td> : </td>
                        </tr>
                        <tr>
                            <td align="right">15. </td>
                            <td>Uji Kompetensi Guru</td>
                            <td> : </td>
                        </tr>
                    </tbody>
                   </table>';
    
        print '</div></body></html>';
        
        unset ($row);  
        
    } else
        print '<p>Data PTK tidak ditemukan!</p>';
                
  endif;
?>

<?php
  /* == Create Sekolah Print == */
  if (isset($_GET['createPrintSekolah'])):
      if (intval($_GET['createPrintSekolah']) == 0 || empty($_GET['createPrintSekolah'])):
          die();
      endif;
                            		  
    $sql = "SELECT s.*,"
            . "\n k.nama_kota,"
            . "\n p.nama_propinsi"
            . "\n FROM (sekolah AS s LEFT JOIN kota AS k"
            . "\n ON s.kota_kode=k.kode)"
            . "\n LEFT JOIN propinsi AS p"
            . "\n ON s.propinsi_kode=p.kode"
            . "\n WHERE s.id = " . (int)$_GET['createPrintSekolah'];
    
    $row = $db->first($sql);

    print '<style type="text/css">'
           .'body, th, td {font-family:arial,sans-serif; font-size: 100%; margin:20;}'
           .'a:link, a:active, a:visited{color:#0000CC}'
           .'.si td {white-space: nowrap;}</style>'
           .'<script type="text/javascript"> function p() { window.print(); } </script></head>'
           .'<body onload="p()"><b>Data Sekolah</b><br><br>'
           .'<div class="si">';
        
    print '<table border="0" cellpadding="4" cellspacing="0" width="100%">
                <tbody>
                    <tr">
                        <td colspan="3">(Update terakhir: ' . setToStrdatetime($row->last_update) . ')</td>
                    </tr>
                    <tr>
                        <td align="right" width="26">1. </td>
                        <td width="98">NSS</td>
                        <td> : ' . $row->nss . '</td>
                    </tr>
                    <tr>
                        <td align="right" width="26">2. </td>
                        <td width="98">NPSN</td>
                        <td> : ' . $row->npsn . '</td>
                    </tr>
                    <tr>
                        <td align="right" width="26">3. </td>
                        <td width="98">Nama Sekolah </td>
                        <td> : ' . $row->nama_sekolah . ',  STATUS: ' . $row->status . '</td>
                    </tr>
                    <tr>
                        <td align="right" width="26">4. </td>
                        <td width="98">Alamat </td>
                        <td> : ' . $row->alamat . '</td>
                    </tr>
                    <tr>
                        <td align="right" width="26">&nbsp;</td>
                        <td width="98">&nbsp;</td>
                        <td> : KEC. ' . $row->kecamatan . ', ' . $row->nama_kota . ', ' . $row->nama_propinsi . '</td>
                    </tr>
                    <tr>
                        <td align="right" width="26">5. </td>
                        <td width="98">Kodepos</td>
                        <td> : ' . $row->kodepos . '</td>
                    </tr>
                    <tr>
                        <td align="right" width="26">6. </td>
                        <td width="98">Telp/Fax</td>
                        <td> : ' . $row->telepon . ' / ' . $row->fax . '</td>
                    </tr>
                    <tr>
                        <td align="right" width="26">7. </td>
                        <td width="98">Website/Email</td>
                        <td> : ' . $row->website . '<br>&nbsp;&nbsp;&nbsp;' . $row->email . '</td>
                    </tr>
                    <tr>
                        <td align="right" width="26">8. </td>
                        <td width="98">Sertifikasi ISO</td>
                        <td> : ' . $row->sertf_iso . '</td>
                    </tr>
                    <tr>
                        <td align="right" width="26">9. </td>
                        <td width="98">Akreditasi</td>
                        <td> : ' . $row->akreditasi . '</td>
                    </tr>
                    <tr>
                        <td align="right" width="26">&nbsp;</td>
                        <td width="98">&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>                    
                </tbody>
            </table>';
    
    print '</div></body></html>';
    		  
  endif;

/* == sekolahsearch == */
  if (isset($_GET['sekolahsearch'])):
      if (empty($_GET['sekolahsearch'])):
          die();
      endif;
      
    $nama_sekolah = (string)($_GET['sekolahsearch']);

      $sql = "SELECT id, nama_sekolah"
            . "\n FROM sekolah"
            . "\n WHERE UPPER(nama_sekolah) LIKE '%" . $nama_sekolah . "%'"
            . "\n ORDER BY nama_sekolah";

    $rows = $db->fetch_all($sql);
      
    $arr = array();
   foreach($rows as $row) {
      // key harus dinamakan "id dan nama"
      $arr[] = array('id'=>$row->id, 'nama_sekolah'=>$row->nama_sekolah);
   }
   unset ($row);
   unset ($rows);
   
   print json_encode($arr);   
   
  endif;      
  
?>
