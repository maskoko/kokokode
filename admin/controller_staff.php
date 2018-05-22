<?php
  /**
   * Controller
   *
   * @package SIM PPPPTK BMTI
   * @author a2ngsa
   * @copyright 2012
   * @version $Id: controller_staff.php, v1.00 2011-06-05 10:12:05 gewa Exp $
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
  /* == view viewStaffInfo == */
  if (isset($_GET['viewStaffInfo'])):
      if (intval($_GET['viewStaffInfo']) == 0 || empty($_GET['viewStaffInfo'])):
          die();
      endif;
	
    $staffid = (int)$_GET['viewStaffInfo'];  
    $sql = "SELECT st.*,"
            ."\n l.nama_lembaga, l.alamat AS alamat_lembaga,"
            ."\n p.nama_propinsi,"
            ."\n k.nama_kota"

            ."\n FROM ((staff AS st LEFT JOIN lembaga AS l"
            ."\n ON st.lembagaid=l.id)"
            ."\n LEFT JOIN propinsi AS p"
            ."\n ON st.propinsi_kode=p.kode)"
            ."\n LEFT JOIN kota AS k"
            ."\n ON st.kota_kode=k.kode"

            ."\n WHERE st.id = " . $staffid;

    $row = $db->first($sql);

    print '<div class="row-fluid">
                <div class="span12">';
                
    print '<table border="0" cellpadding="4" cellspacing="0" width="100%">
                <tbody>
                    <tr>
                        <td align="right" width="26">1. </td>
                        <td width="98">Nama Lengkap</td>
                        <td> : ' . $row->nama_lengkap . '</td>
                    </tr>
                    <tr>
                        <td align="right" width="26">2. </td>
                        <td width="98">NUPTK</td>
                        <td> : ' . $row->nuptk . '  NIP : ' . $row->nip . '</td>
                    </tr>
                    <tr>
                        <td align="right" width="26">3. </td>
                        <td width="98">Nama Lembaga</td>
                        <td> : ' . $row->nama_lembaga . '</td>
                    </tr>
                    <tr>
                        <td align="right" width="26">4. </td>
                        <td width="98">Alamat Lembaga</td>
                        <td> : ' . $row->alamat_lembaga . '</td>
                    </tr>
                    <tr>
                        <td align="right" width="26">5. </td>
                        <td width="98">Propinsi</td>
                        <td> : ' . $row->nama_propinsi . '  Kota : ' . $row->nama_kota . '</td>
                    </tr>
                </tbody>
            </table>
            </div>
        </div>';

    unset($row);
        
  endif;
  
?>

<?php
          
  /* == Load staff_rpf ======================================================= */
  if (isset($_POST['loadRPF'])):
      if (intval($_POST['loadRPF']) == 0 || empty($_POST['loadRPF'])):
          die();
      endif;
      $id = intval($_POST['loadRPF']);
      $content->loadStaff_RPF($id);
  endif;
  
  /* == Process staff_rpf == */
  if (isset($_POST['processRPF'])):
      if (intval($_POST['processRPF']) == 0 || empty($_POST['processRPF'])):
          die();
      endif;
      Filter::$id = (isset($_POST['dataid'])) ? $_POST['dataid'] : 0; 
      $content->processStaff_RPF();
  endif;
    
  /* == Load staff_rpnf ======================================================= */
  if (isset($_POST['loadRPNF'])):
      if (intval($_POST['loadRPNF']) == 0 || empty($_POST['loadRPNF'])):
          die();
      endif;
      $id = intval($_POST['loadRPNF']);
      $content->loadStaff_RPNF($id);
  endif;
  
  /* == Process staff_rpnf == */
  if (isset($_POST['processRPNF'])):
      if (intval($_POST['processRPNF']) == 0 || empty($_POST['processRPNF'])):
          die();
      endif;
      Filter::$id = (isset($_POST['dataid'])) ? $_POST['dataid'] : 0; 
      $content->processStaff_RPNF();
  endif;
    
  /* == Load staff_rdiklat ======================================================= */
  if (isset($_POST['loadRDiklat'])):
      if (intval($_POST['loadRDiklat']) == 0 || empty($_POST['loadRDiklat'])):
          die();
      endif;
      $id = intval($_POST['loadRDiklat']);
      $content->loadStaff_RDiklat($id);
  endif;
  
  /* == Process staff_rdiklat == */
  if (isset($_POST['processRDiklat'])):
      if (intval($_POST['processRDiklat']) == 0 || empty($_POST['processRDiklat'])):
          die();
      endif;
      Filter::$id = (isset($_POST['dataid'])) ? $_POST['dataid'] : 0; 
      $content->processStaff_RDiklat();
  endif;      

  /* == Load staff_rjabatan ======================================================= */
  if (isset($_POST['loadRJabatan'])):
      if (intval($_POST['loadRJabatan']) == 0 || empty($_POST['loadRJabatan'])):
          die();
      endif;
      $id = intval($_POST['loadRJabatan']);
      $content->loadStaff_RJabatan($id);
  endif;
  
  /* == Process staff_rjabatan == */
  if (isset($_POST['processRJabatan'])):
      if (intval($_POST['processRJabatan']) == 0 || empty($_POST['processRJabatan'])):
          die();
      endif;
      Filter::$id = (isset($_POST['dataid'])) ? $_POST['dataid'] : 0; 
      $content->processStaff_RJabatan();
  endif;      
    
  /* == Load staff_rkarya ======================================================= */
  if (isset($_POST['loadRKarya'])):
      if (intval($_POST['loadRKarya']) == 0 || empty($_POST['loadRKarya'])):
          die();
      endif;
      $id = intval($_POST['loadRKarya']);
      $content->loadStaff_RKarya($id);
  endif;
  
  /* == Process staff_rkarya == */
  if (isset($_POST['processRKarya'])):
      if (intval($_POST['processRKarya']) == 0 || empty($_POST['processRKarya'])):
          die();
      endif;
      Filter::$id = (isset($_POST['dataid'])) ? $_POST['dataid'] : 0; 
      $content->processStaff_RKarya();
  endif;      
  
  /* == Load staff_rsertifikat ======================================================= */
  if (isset($_POST['loadRSertifikat'])):
      if (intval($_POST['loadRSertifikat']) == 0 || empty($_POST['loadRSertifikat'])):
          die();
      endif;
      $id = intval($_POST['loadRSertifikat']);
      $content->loadStaff_RSertifikat($id);
  endif;
  
  /* == Process staff_rsertifikat == */
  if (isset($_POST['processRSertifikat'])):
      if (intval($_POST['processRSertifikat']) == 0 || empty($_POST['processRSertifikat'])):
          die();
      endif;
      Filter::$id = (isset($_POST['dataid'])) ? $_POST['dataid'] : 0; 
      $content->processStaff_RSertifikat();
  endif;      
    
?>

<?php

  /* == deleteDatadetail == */
  if (isset($_POST['deleteDatadetail'])):
      if (empty($_POST['deleteDatadetail'])):
          die();
      endif;
      
      $tname = (string)($_POST['deleteDatadetail']);
      $id = intval($_POST['id']);
      
      $res = $db->delete($tname, "id=" . $id);
      
    print ($res) ? Filter::msgOk('Data berhasil dihapus.') : Filter::msgAlert(lang('NOPROCCESS'));
  endif;    

  /* == getDatadetail == */
  if (isset($_POST['getDatadetail'])):
      if (empty($_POST['getDatadetail'])):
          die();
      endif;
      
      $tname = (string)($_POST['getDatadetail']);
      $id = intval($_POST['id']);
      
      $str = '';
      $sql = 'SELECT * FROM '.$tname.' WHERE id = ' . $id;
      $row = $db->first($sql);
                  
      if ($tname == "staff_rpf")
        $str = '{"data":{"id":'.$row->id.',"jenjangid": '.$row->jenjangid
                .',"nama_sekolah": "'.$row->nama_sekolah.'", "lokasi": "'.$row->lokasi
                .'","jurusan": "'.$row->jurusan.'","tahun_lulus": '.$row->tahun_lulus.'}}';
      else if ($tname == "staff_rpnf")
        $str = '{"data":{"id":'.$row->id.',"nama_pendidikan": "'.$row->nama_pendidikan
                .'","pelaksana": "'.$row->pelaksana.'","lokasi": "'.$row->lokasi
                .'","tahun": '.$row->tahun.',"jml_jam": '.$row->jml_jam.'}}';
      else if ($tname == "staff_rdiklat")
        $str = '{"data":{"id":'.$row->id.',"tingkat": "'.$row->tingkat
                .'","nama_diklat": "'.$row->nama_diklat.'","tempat": "'.$row->tempat
                .'","sttpl": "'.$row->sttpl.'","tahun": '.$row->tahun.'}}';
      else if ($tname == "staff_rjabatan") {
        $tmt = setToStrdate($row->tmt);
        $akhir_tmt = setToStrdate($row->akhir_tmt);
        
        $str = '{"data":{"id":'.$row->id.',"jenis": "'.$row->jenis
                .'","jabatan": "'.$row->jabatan.'","lembaga": "'.$row->lembaga
                .'","no_sk": "'.$row->no_sk.'","tahun": '.$row->tahun.',"tmp_tugas": "'.$row->tmp_tugas
                .'","tmt": "'.$tmt.'","akhir_tmt": "'.$akhir_tmt.'"}}';
        
      } else if ($tname == "staff_rkarya")
        $str = '{"data":{"id":'.$row->id.',"nss": "'.$row->nss
                .'","nip":"'.$row->nip.'","nama_karya":"'.$row->nama_karya
                .'","tahun": '.$row->tahun.',"keterangan": "'.$row->keterangan.'"}}';
      else if ($tname == "staff_rsertifikat")
        $str = '{"data":{"id":'.$row->id.',"nss": "'.$row->nss
                .'","nip":"'.$row->nip.'","nama_sertifikat":"'.$row->nama_sertifikat
                .'","pelaksana": "'.$row->pelaksana.'","status": "'.$row->status
                .'","tahun": '.$row->tahun.'}}';
      
      print $str;
  endif;    
        
?>

