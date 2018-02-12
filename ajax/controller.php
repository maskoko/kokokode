<?php
  /**
   * Controller
   *
   * @package SIM PPPPTK BMTI
   * @author a2ngsa
   * @copyright 2012
   * @version $Id: controller.php, v1.00 2011-11-10 10:12:05 gewa Exp $
   */
  define("_VALID_PHP", true);
  require_once("../init.php");

  if (!$user->logged_in)
      redirect_to("../index.php");
?>

<?php
  /* == Proccess User == */
  if (isset($_POST['processUser'])):
      if (intval($_POST['processUser']) == 0 || empty($_POST['processUser'])):
          redirect_to("../account.php");
      endif;
	  
      $user->updateProfile();
  endif;
?>

<?php
  /* == Make Pdf == */
  if (isset($_GET['dopdf'])):
      if (intval($_GET['dopdf']) == 0 || empty($_GET['dopdf'])):
          redirect_to("../account.php");
      endif;
	  
	  Filter::$id = intval($_GET['dopdf']);
	  $title = sanitize($_GET['title']);
	  ob_start();
	  require_once(BASEPATH . 'print_pdf.php');
	  $pdf_html = ob_get_contents();
	  ob_end_clean();

	  require_once(BASEPATH . 'lib/dompdf/dompdf_config.inc.php');
	  $dompdf = new DOMPDF();
	  $dompdf->load_html($pdf_html);
	  $dompdf->render();
	  $dompdf->stream($title . ".pdf");
  endif;
?>

<?php
  /* == Load pskList == */
  if (isset($_POST['loadPSKList'])):
      if (intval($_POST['loadPSKList']) == 0 || empty($_POST['loadPSKList'])):
          die();
      endif; 
	  
		$id = intval($_POST['loadPSKList']);
	
		$sql = "SELECT id, nama_program" 
		    . "\n FROM psk" 
		    . "\n WHERE bskid = ".$id 
		    . "\n ORDER BY nama_program";
	
	    $resrow = $db->fetch_all($sql);

      if ($resrow):

		  print '<option value="" selected="selected">'.lang('SELECT').'</option>\n';

		  foreach ($resrow as $prow) {
			print '<option value="'.$prow->id.'">'.$prow->nama_program.'</option>\n';
		  }
	      unset($prow);  

      endif;	  
      
  endif;
?>

<?php
  /* == Load kkList == */
  if (isset($_POST['loadKKList'])):
      if (intval($_POST['loadKKList']) == 0 || empty($_POST['loadKKList'])):
          die();
      endif; 
	  
		$id = intval($_POST['loadKKList']);
	
		$sql = "SELECT id, nama_kompetensi" 
		    . "\n FROM kk" 
		    . "\n WHERE pskid = ".$id 
		    . "\n ORDER BY nama_kompetensi";
	
	    $resrow = $db->fetch_all($sql);

      if ($resrow):

		  print '<option value="" selected="selected">'.lang('SELECT').'</option>\n';

		  foreach ($resrow as $prow) {
			print '<option value="'.$prow->id.'">'.$prow->nama_kompetensi.'</option>\n';
		  }
	      unset($prow);  

      endif;	  
      
  endif;
?>

<?php
  /* == check ptk_tna == */
  if (isset($_POST['checkPTK_TNA'])):  
      if (intval($_POST['checkPTK_TNA']) == 0 || empty($_POST['checkPTK_TNA'])):
          die();
      endif;

      if (empty($_POST['ptkid']))
          Filter::$msgs['ptkid'] = 'Data PTK belum dipilih!';

      $kelid = $_POST['kelid'];
      $kkid = 0;

      if ($kelid == 1) {
        if (empty($_POST['mp1id']))
            Filter::$msgs['mp1id'] = 'Mata Pelajaran belum dipilih!';
        else
          $kkid = $_POST['mp1id'];
      } else if ($kelid == 2) {
        if (empty($_POST['mp2id']))
            Filter::$msgs['mp2id'] = 'Mata Pelajaran belum dipilih!';
        else
          $kkid = $_POST['mp2id'];
      } else {
        if (empty($_POST['kkid']))
            Filter::$msgs['kkid'] = 'Data KK belum dipilih!';
        else
          $kkid = $_POST['kkid'];
      }
      
      if (empty(Filter::$msgs)) {

          //$row = $content->getTNA_PTK_KK($_POST['ptkid'], $kelid, $kkid);
          //if ($row) 
          //  Filter::msgAlert("TNA untuk Paket Keahlian/Mata Pelajaran ini sudah dilakukan!");
          //else
            print "OK";

      }

  endif;
?>


<?php
  /* == Proccess ptk_tna == */
  if (isset($_POST['processPTK_TNA'])):  
      if (intval($_POST['processPTK_TNA']) == 0 || empty($_POST['processPTK_TNA'])):
          die();
      endif;
	  
      if (empty($_POST['ptkid']))
          Filter::$msgs['ptkid'] = 'Data PTK belum dipilih!';

      if (empty($_POST['kelid']))
          Filter::$msgs['kelid'] = 'Data Kelompok belum dipilih!';
      else {

        $kelid = intval($_POST['kelid']);

        if ($kelid == 3) {

          if (empty($_POST['bskid']))
              Filter::$msgs['bskid'] = 'Data Bidang Keahlian belum dipilih!';

          if (empty($_POST['pskid']))
              Filter::$msgs['pskid'] = 'Data Program Keahlian belum dipilih!';

        }

        if (empty($_POST['kkid']))
          Filter::$msgs['kkid'] = 'Data Paket Keahlian/Mata Pelajaran belum dipilih!';

      }
		  
      if (empty(Filter::$msgs)) {

        $ptkid = intval($_POST['ptkid']);
        $kkid = intval($_POST['kkid']);

			   $data = array(
               'jenis' => sanitize($_POST['jenis']),
					     'ptkid' => $ptkid,
					     'sekolahid' => intval($_POST['sekolahid']),
               'kelid' => $kelid,
               'kkid' => $kkid,
    					 'nilai_instrumen' => intval($_POST['nilai_instrumen']), 
    					
    					 'last_update' => 'NOW()', 
    					 'created' => 'NOW()'
    		  ); 
				
			    $nilai_total = 0;	
    			$kddata = array();
    			foreach ($_POST as $key => $value){
    				$kd_key = $key;
    				if (strpos($key, "kd_") !== false) {
    					$kdid = str_replace("kd_","", $kd_key);
    					$nilai_total += intval($value);
    					
    					$kddata[] = array(
    						'kdid' => intval($kdid),
    						'kd_value' => intval($value));
    				}
    			}	  
    			unset ($value);
    			
    			$data['nilai_total'] = $nilai_total;
    						

          // -- delete previous --

          $tnarow = $content->getTNA_PTK_KK ($ptkid, $kelid, $kkid);
          if ($tnarow)
          {
              $lastid = $tnarow->id;

              $db->delete("ptk_kd", "ptk_tnaid=" . $tnarow->id);
              $db->update("ptk_tna", $data, "id=" . $tnarow->id);
              //$db->delete("ptk_tna", "id=" . $tnarow->id);
          }
          else
            $lastid = $db->insert("ptk_tna", $data); 

          //$lastid = $db->insert("ptk_tna", $data); 
    			
    			/* -- add ptk_kd -- */
    							
    			$kdcount = count($kddata);
    			for ($i=0;$i<$kdcount;$i++) {
    				$edata = array(
    						'ptk_tnaid' => $lastid, 
    						'kdid' => $kddata[$i]['kdid'],
    						'kd_value' => $kddata[$i]['kd_value']); 
    										  
    				$db->insert("ptk_kd", $edata);
    			} 
    			unset ($value);

    			($db->affected()) ? print "OK : " . $lastid : Filter::msgAlert(lang('NOPROCCESS'));
			  		  
      } else 
          print Filter::msgStatus();

  endif;
  
?>

<?php

  /* == Proccess PTK == */
  if (isset($_POST['processUpdatePTK'])):
      if (intval($_POST['processUpdatePTK']) == 0 || empty($_POST['processUpdatePTK'])):
          die();
      endif;
  
    Filter::$id = (isset($_POST['id'])) ? $_POST['id'] : 0; 
    $content->processUpdatePTK();
      	  
  endif;
?>

<?php
  /* == view PTK == */
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
                            <td><a href="ajax/controller.php?createPrintPTK=' .$_GET['viewPTK']. '" class="btn btn-info" target="_blank"><span class="icon16 icomoon-icon-printer"></span>Print</a></td>
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
                        <td colspan="2"></td>
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
                        <td><a href="ajax/controller.php?createPrintSekolah=' .$_GET['viewSekolah']. '" class="btn btn-info" target="_blank"><span class="icon16 icomoon-icon-printer"></span>Print</a></td>
                    </tr>
                </tbody>
            </table>';
      
    print ' </div>
        </div>';
    
  endif;
  
?>

<?php

  /* == Load KotaList == */
  if (isset($_POST['loadKotaList'])):
      if ($_POST['loadKotaList'] == '' || empty($_POST['loadKotaList'])):
          die();
      endif;
      $kode = (string)($_POST['loadKotaList']);
	  	  
      $content->loadKotaList($kode);
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

    if ($row->jenis == "D") $diklat_jenis = "D : Dalam"; else $diklat_jenis = "L : Luar";

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
                                <td> : ' . $row->tingkat . '  Jenis : ' . $diklat_jenis . '</td>
                            </tr>

                            <tr>
                                <td align="right" width="26"></td>
                                <td width="98"></td>
                                <td><a href="ajax/controller.php?createPrintDiklat=' .$_GET['viewDiklat']. '" class="btn btn-info" target="_blank"><span class="icon16 icomoon-icon-printer"></span>Print</a></td>
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
                                <td align="right" width="26">2. </td>
                                <td width="98">Keterangan</td>
                                <td> : ' . $row->deskripsi . '</td>
                            </tr>

                            <tr>
                                <td align="right" width="26"></td>
                                <td width="98"></td>
                                <td><a href="ajax/controller.php?createPrintDiklat_Jadwal=' .$_GET['viewDiklat_Jadwal']. '" class="btn btn-info" target="_blank"><span class="icon16 icomoon-icon-printer"></span>Print</a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>';
        		  
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
                        
                        <tr>
                            <td align="right" width="26"></td>
                            <td width="98"></td>
                            <td><a href="ajax/controller.php?createPrintDiklat_Peserta=' .$_GET['viewDiklat_Peserta']. '" class="btn btn-info" target="_blank"><span class="icon16 icomoon-icon-printer"></span>Print</a></td>
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
    
  /* == deletePTKdetail == */
  if (isset($_POST['deletePTKdetail'])):
      if (empty($_POST['deletePTKdetail'])):
          die();
      endif;
      
      $tname = (string)($_POST['deletePTKdetail']);
      $id = intval($_POST['id']);
      
      $res = $db->delete($tname, "id=" . $id);
      
    print ($res) ? Filter::msgOk('Data berhasil dihapus.') : Filter::msgAlert(lang('NOPROCCESS'));
  endif;    

  /* == getPTKdetail == */
  if (isset($_POST['getPTKdetail'])):
      if (empty($_POST['getPTKdetail'])):
          die();
      endif;
      
      $tname = (string)($_POST['getPTKdetail']);
      $id = intval($_POST['id']);
      
      $str = '';
      $sql = 'SELECT * FROM '.$tname.' WHERE id = ' . $id;
      $row = $db->first($sql);
            
      if ($row->kkid)
          $kkid = $row->kkid;
      else
          $kkid = 0;
      
      if ($tname == "ptk_diklatminat")
        $str =  '{"data":{"id":'.$row->id.', "diklatid":'.$row->diklatid.', "tahun":'.$row->tahun
                .', "deskripsi":"'.$row->deskripsi.'"}}';
      else if ($tname == "ptk_mmds")
        $str = '{"data":{"id":'.$row->id.', "kel_matapelajaran": "'.$row->kel_matapelajaran
                .'", "kkid":'.$kkid.',"nama_matapelajaran": "'.$row->nama_matapelajaran
                .'", "kelas": "'.$row->kelas.'","tahun_mulai": '.$row->tahun_mulai
                .', "tahun_akhir": '.$row->tahun_akhir.'}}'; 
      else if ($tname == "ptk_mmdl")
        $str = '{"data":{"id":'.$row->id.',"kel_matapelajaran":"'.$row->kel_matapelajaran
                .'","kkid":'.$kkid.',"nama_lembaga":"'.$row->nama_lembaga
                .'","nama_matapelajaran":"'.$row->nama_matapelajaran 
                .'","kelas":"'.$row->kelas.'", "tahun_mulai": '.$row->tahun_mulai
                .', "tahun_akhir": '.$row->tahun_akhir.'}}';
      else if ($tname == "ptk_rpp")
        $str = '{"data":{"id":'.$row->id.',"nama_diklat":"'.$row->nama_diklat
                .'","peran":"'.$row->peran.'","tahun":'.$row->tahun.',"jml_jam":'.$row->jml_jam
                .',"penyelenggara":"'.$row->penyelenggara.'","tingkat":"'.$row->tingkat
                .'","kompetensi":"'.$row->kompetensi.'","status":"'.$row->status.'"}}';
      else if ($tname == "ptk_rpf")
        $str = '{"data":{"id":'.$row->id.',"nama_sekolah":"'.$row->nama_sekolah
                .'","lokasi":"'.$row->lokasi.'","fakultas":"'.$row->fakultas
                .'","jurusan":"'.$row->jurusan.'","status":"'.$row->status
                .'","tingkat_pendidikan":"'.$row->tingkat_pendidikan.'","tahun_lulus":'.$row->tahun_lulus.'}}';
      else if ($tname == "ptk_rpnf")
        $str = '{"data":{"id":'.$row->id.',"nama_instansi":"'.$row->nama_instansi
                .'","lokasi":"'.$row->lokasi.'","bidang_studi":"'.$row->bidang_studi
                .'","tingkat":"'.$row->tingkat.'","jml_jam":'.$row->jml_jam.',"tahun_lulus":'.$row->tahun_lulus.'}}';
      else if ($tname == "ptk_rsertifikat")
        $str = '{"data":{"id":'.$row->id.',"nama_sertifikat":"'.$row->nama_sertifikat
                .'","pelaksana":"'.$row->pelaksana.'","status":"'.$row->status.'","tahun":'.$row->tahun.'}}'; 
      
      print $str;
  endif;    
  
  
?>

<?php
  /* == Process ptk_diklatminat == */
  if (isset($_POST['processPTK_DiklatMinat'])):
      if (intval($_POST['processPTK_DiklatMinat']) == 0 || empty($_POST['processPTK_DiklatMinat'])):
          die();
      endif;
      Filter::$id = (isset($_POST['dataid'])) ? $_POST['dataid'] : 0; 
      $content->processPTK_DiklatMinat();
  endif;
  
  /* == Load ptk_diklatminat ================================================ */
  if (isset($_POST['loadPTK_DiklatMinat'])):
      if (intval($_POST['loadPTK_DiklatMinat']) == 0 || empty($_POST['loadPTK_DiklatMinat'])):
          die();
      endif;
      $id = intval($_POST['loadPTK_DiklatMinat']);
      $content->loadPTK_DiklatMinat($id);
  endif;
    
  /* == Process ptk_mmds == */
  if (isset($_POST['processPTK_MMDS'])):
      if (intval($_POST['processPTK_MMDS']) == 0 || empty($_POST['processPTK_MMDS'])):
          die();
      endif;
      Filter::$id = (isset($_POST['dataid'])) ? $_POST['dataid'] : 0; 
      $content->processPTK_MMDS();
  endif;
  
  /* == load ptk_mmds ================================================ */
  if (isset($_POST['loadPTK_MMDS'])):
      if (intval($_POST['loadPTK_MMDS']) == 0 || empty($_POST['loadPTK_MMDS'])):
          die();
      endif;
      $id = intval($_POST['loadPTK_MMDS']);
      $content->loadPTK_MMDS($id);
  endif;
  

  /* == Process ptk_mmdl == */
  if (isset($_POST['processPTK_MMDL'])):
      if (intval($_POST['processPTK_MMDL']) == 0 || empty($_POST['processPTK_MMDL'])):
          die();
      endif;
      Filter::$id = (isset($_POST['dataid'])) ? $_POST['dataid'] : 0; 
      $content->processPTK_MMDL();
  endif;
  
  /* == load ptk_mmdl ================================================ */
  if (isset($_POST['loadPTK_MMDL'])):
      if (intval($_POST['loadPTK_MMDL']) == 0 || empty($_POST['loadPTK_MMDL'])):
          die();
      endif;
      $id = intval($_POST['loadPTK_MMDL']);
      $content->loadPTK_MMDL($id);
  endif;
  

  /* == Process ptk_rpp == */
  if (isset($_POST['processPTK_RPP'])):
      if (intval($_POST['processPTK_RPP']) == 0 || empty($_POST['processPTK_RPP'])):
          die();
      endif;
      Filter::$id = (isset($_POST['dataid'])) ? $_POST['dataid'] : 0; 
      $content->processPTK_RPP();
  endif;
  
  /* == load ptk_rpp ================================================ */
  if (isset($_POST['loadPTK_RPP'])):
      if (intval($_POST['loadPTK_RPP']) == 0 || empty($_POST['loadPTK_RPP'])):
          die();
      endif;
      $id = intval($_POST['loadPTK_RPP']);
      $content->loadPTK_RPP($id);
  endif;
  
  /* == Process ptk_rpf == */
  if (isset($_POST['processPTK_RPF'])):
      if (intval($_POST['processPTK_RPF']) == 0 || empty($_POST['processPTK_RPF'])):
          die();
      endif;
      Filter::$id = (isset($_POST['dataid'])) ? $_POST['dataid'] : 0; 
      $content->processPTK_RPF();
  endif;
  
  /* == load ptk_rpf ================================================ */
  if (isset($_POST['loadPTK_RPF'])):
      if (intval($_POST['loadPTK_RPF']) == 0 || empty($_POST['loadPTK_RPF'])):
          die();
      endif;
      $id = intval($_POST['loadPTK_RPF']);
      $content->loadPTK_RPF($id);
  endif;
  
  /* == Process ptk_rpnf == */
  if (isset($_POST['processPTK_RPNF'])):
      if (intval($_POST['processPTK_RPNF']) == 0 || empty($_POST['processPTK_RPNF'])):
          die();
      endif;
      Filter::$id = (isset($_POST['dataid'])) ? $_POST['dataid'] : 0; 
      $content->processPTK_RPNF();
  endif;
  
  /* == load ptk_rpnf ================================================ */
  if (isset($_POST['loadPTK_RPNF'])):
      if (intval($_POST['loadPTK_RPNF']) == 0 || empty($_POST['loadPTK_RPNF'])):
          die();
      endif;
      $id = intval($_POST['loadPTK_RPNF']);
      $content->loadPTK_RPNF($id);
  endif;

  /* == Process ptk_rsertifikat == */
  if (isset($_POST['processPTK_RSertifikat'])):
      if (intval($_POST['processPTK_RSertifikat']) == 0 || empty($_POST['processPTK_RSertifikat'])):
          die();
      endif;
      Filter::$id = (isset($_POST['dataid'])) ? $_POST['dataid'] : 0; 
      $content->processPTK_RSertifikat();
  endif;
  
  /* == load ptk_rsertifikat ================================================ */
  if (isset($_POST['loadPTK_RSertifikat'])):
      if (intval($_POST['loadPTK_RSertifikat']) == 0 || empty($_POST['loadPTK_RSertifikat'])):
          die();
      endif;
      $id = intval($_POST['loadPTK_RSertifikat']);
      $content->loadPTK_RSertifikat($id);
  endif;
  
?>

<?php
  /* == get Input Method loadMataPelajaran == */
  if (isset($_GET['loadMataPelajaran'])):
      if (empty($_GET['loadMataPelajaran'])):
          die();
      endif;
	
     $kel_nama = (string)$_GET['loadMataPelajaran'];
     
     if (($kel_nama == "ADAPTIF") || ($kel_nama == "NORMATIF")) {

        ($kel_nama == "ADAPTIF") ? $kel = 1 : $kel = 2; 
         
        $sql = "SELECT *"
              . "\n FROM matapelajaran"
              . "\n WHERE kelid = " . $kel
              . "\n ORDER BY nama_matapelajaran";

        $rows = $db->fetch_all($sql);
         
        print '<label class="form-label span4" for="checkboxes">Mata Pelajaran:</label>
                <div class="span8 controls">
                    <select name="nama_matapelajaran" id="nama_matapelajaran">';

        if ($rows) {
            foreach ($rows as $row) {
                    print '<option value="' . $row->nama_matapelajaran . '">' . $row->nama_matapelajaran . '</option>\n';
					
            }
            unset($row);
        }
        
        print '     </select>
                </div>';
         
     } else
         print '<label class="form-label span4" for="normal">Mata Pelajaran:</label>
                <input type="text" class="span6" name="nama_matapelajaran" id="nama_matapelajaran" value=""/>';
     
  endif;
  
?>

<?php

  /* == Load SekolahList == */
  if (isset($_POST['loadSekolahList'])):
      if ($_POST['loadSekolahList'] == '' || empty($_POST['loadSekolahList'])):
          die();
      endif;
      
      $propinsi_kode = (string)($_POST['loadSekolahList']);
      if (isset($_POST['kota']))
        $kota_kode = (string)($_POST['kota']);
      else
        $kota_kode = "";

      $content->loadSekolahList($propinsi_kode, $kota_kode);
  endif;

  /* == Load sekolah_smk ====================================================== */
  if (isset($_POST['loadSekolah_SMK'])):
      if (intval($_POST['loadSekolah_SMK']) == 0 || empty($_POST['loadSekolah_SMK'])):
          die();
      endif;
      $id = intval($_POST['loadSekolah_SMK']);
      $content->loadSekolah_SMK($id);
  endif;
  
  /* == Process sekolah_smk == */
  if (isset($_POST['processSekolah_SMK'])):
      if (intval($_POST['processSekolah_SMK']) == 0 || empty($_POST['processSekolah_SMK'])):
          die();
      endif;
      Filter::$id = (isset($_POST['id'])) ? $_POST['id'] : 0; 
      $content->processSekolah_SMK();
  endif;

  /* == Load sekolah_ppmd ====================================================== */
  if (isset($_POST['loadSekolah_PPMD'])):
      if (intval($_POST['loadSekolah_PPMD']) == 0 || empty($_POST['loadSekolah_PPMD'])):
          die();
      endif;
      $id = intval($_POST['loadSekolah_PPMD']);
      $content->loadSekolah_PPMD($id);
  endif;
  
  /* == Process sekolah_ppmd == */
  if (isset($_POST['processSekolah_PPMD'])):
      if (intval($_POST['processSekolah_PPMD']) == 0 || empty($_POST['processSekolah_PPMD'])):
          die();
      endif;
      Filter::$id = (isset($_POST['id'])) ? $_POST['id'] : 0; 
      $content->processSekolah_PPMD();
  endif;
  
  /* == Load sekolah_rkpjt ====================================================== */
  if (isset($_POST['loadSekolah_RKPJT'])):
      if (intval($_POST['loadSekolah_RKPJT']) == 0 || empty($_POST['loadSekolah_RKPJT'])):
          die();
      endif;
      $id = intval($_POST['loadSekolah_RKPJT']);
      $content->loadSekolah_RKPJT($id);
  endif;
  
  /* == Process sekolah_rkpjt == */
  if (isset($_POST['processSekolah_RKPJT'])):
      if (intval($_POST['processSekolah_RKPJT']) == 0 || empty($_POST['processSekolah_RKPJT'])):
          die();
      endif;
      Filter::$id = (isset($_POST['id'])) ? $_POST['id'] : 0; 
      $content->processSekolah_RKPJT();
  endif;

  /* == Load sekolah_rkpsj ====================================================== */
  if (isset($_POST['loadSekolah_RKPSJ'])):
      if (intval($_POST['loadSekolah_RKPSJ']) == 0 || empty($_POST['loadSekolah_RKPSJ'])):
          die();
      endif;
      $id = intval($_POST['loadSekolah_RKPSJ']);
      $content->loadSekolah_RKPSJ($id);
  endif;
  
  /* == Process sekolah_rkpsj == */
  if (isset($_POST['processSekolah_RKPSJ'])):
      if (intval($_POST['processSekolah_RKPSJ']) == 0 || empty($_POST['processSekolah_RKPSJ'])):
          die();
      endif;
      Filter::$id = (isset($_POST['id'])) ? $_POST['id'] : 0; 
      $content->processSekolah_RKPSJ();
  endif;

  /* == Load sekolah_rpkpp ====================================================== */
  if (isset($_POST['loadSekolah_RPKPP'])):
      if (intval($_POST['loadSekolah_RPKPP']) == 0 || empty($_POST['loadSekolah_RPKPP'])):
          die();
      endif;
      $id = intval($_POST['loadSekolah_RPKPP']);
      $content->loadSekolah_RPKPP($id);
  endif;
  
  /* == Process sekolah_rpkpp == */
  if (isset($_POST['processSekolah_RPKPP'])):
      if (intval($_POST['processSekolah_RPKPP']) == 0 || empty($_POST['processSekolah_RPKPP'])):
          die();
      endif;
      Filter::$id = (isset($_POST['id'])) ? $_POST['id'] : 0; 
      $content->processSekolah_RPKPP();
  endif;
  
  /* == Load sekolah_rptl ====================================================== */
  if (isset($_POST['loadSekolah_RPTL'])):
      if (intval($_POST['loadSekolah_RPTL']) == 0 || empty($_POST['loadSekolah_RPTL'])):
          die();
      endif;
      $id = intval($_POST['loadSekolah_RPTL']);
      $content->loadSekolah_RPTL($id);
  endif;
  
  /* == Process sekolah_rptl == */
  if (isset($_POST['processSekolah_RPTL'])):
      if (intval($_POST['processSekolah_RPTL']) == 0 || empty($_POST['processSekolah_RPTL'])):
          die();
      endif;
      Filter::$id = (isset($_POST['id'])) ? $_POST['id'] : 0; 
      $content->processSekolah_RPTL();
  endif;
  
  /* == Load sekolah_ruang ====================================================== */
  if (isset($_POST['loadSekolah_Ruang'])):
      if (intval($_POST['loadSekolah_Ruang']) == 0 || empty($_POST['loadSekolah_Ruang'])):
          die();
      endif;
      $id = intval($_POST['loadSekolah_Ruang']);
      $content->loadSekolah_Ruang($id);
  endif;
  
  /* == Process sekolah_ruang == */
  if (isset($_POST['processSekolah_Ruang'])):
      if (intval($_POST['processSekolah_Ruang']) == 0 || empty($_POST['processSekolah_Ruang'])):
          die();
      endif;
      Filter::$id = (isset($_POST['id'])) ? $_POST['id'] : 0; 
      $content->processSekolah_Ruang();
  endif;

  /* == Load sekolah_siswa ====================================================== */
  if (isset($_POST['loadSekolah_Siswa'])):
      if (intval($_POST['loadSekolah_Siswa']) == 0 || empty($_POST['loadSekolah_Siswa'])):
          die();
      endif;
      $id = intval($_POST['loadSekolah_Siswa']);
      $content->loadSekolah_Siswa($id);
  endif;
  
  /* == Process sekolah_siswa == */
  if (isset($_POST['processSekolah_Siswa'])):
      if (intval($_POST['processSekolah_Siswa']) == 0 || empty($_POST['processSekolah_Siswa'])):
          die();
      endif;
      Filter::$id = (isset($_POST['id'])) ? $_POST['id'] : 0; 
      $content->processSekolah_Siswa();
  endif;

  /* == Load sekolah_tanah ====================================================== */
  if (isset($_POST['loadSekolah_Tanah'])):
      if (intval($_POST['loadSekolah_Tanah']) == 0 || empty($_POST['loadSekolah_Tanah'])):
          die();
      endif;
      $id = intval($_POST['loadSekolah_Tanah']);
      $content->loadSekolah_Tanah($id);
  endif;
  
  /* == Process sekolah_tanah == */
  if (isset($_POST['processSekolah_Tanah'])):
      if (intval($_POST['processSekolah_Tanah']) == 0 || empty($_POST['processSekolah_Tanah'])):
          die();
      endif;
      Filter::$id = (isset($_POST['id'])) ? $_POST['id'] : 0; 
      $content->processSekolah_Tanah();
  endif;
  
  /* == deleteSekolahdetail == */
  if (isset($_POST['deleteSekolahdetail'])):
      if (empty($_POST['deleteSekolahdetail'])):
          die();
      endif;
      
      $tname = (string)($_POST['deleteSekolahdetail']);
      $id = intval($_POST['id']);
      
      $res = $db->delete($tname, "id=" . $id);
      
    print ($res) ? Filter::msgOk('Data berhasil dihapus.') : Filter::msgAlert(lang('NOPROCCESS'));
  endif;    
  
  /* == Update Sekolah ==================================================================================================================== */
    
  if (isset($_POST['processUpdateSekolah']))
      : if (intval($_POST['processUpdateSekolah']) == 0 || empty($_POST['processUpdateSekolah']))
      : die();
  endif;
   
  Filter::$id = (isset($_POST['id'])) ? $_POST['id'] : 0; 
   
  $content->processUpdateSekolah();
  endif;  
  
?>

<?php

  /* == Proccess Staff == */
  if (isset($_POST['processUpdateStaff'])):
      if (intval($_POST['processUpdateStaff']) == 0 || empty($_POST['processUpdateStaff'])):
          die();
      endif;
  
    Filter::$id = (isset($_POST['id'])) ? $_POST['id'] : 0; 
    $content->processUpdateStaff();
          
  endif;
?>
