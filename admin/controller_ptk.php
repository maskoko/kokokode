<?php
  /**
   * Controller
   *
   * @package SIM PPPPTK BMTI
   * @author a2ngsa
   * @copyright 2012
   * @version $Id: controller_ptk.php, v1.00 2011-06-05 10:12:05 gewa Exp $
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
  /* == view Diklat_CalonPeserta == */
  if (isset($_GET['viewDiklat_CalonPeserta'])):
      if (intval($_GET['viewDiklat_CalonPeserta']) == 0 || empty($_GET['viewDiklat_CalonPeserta'])):
          die();
      endif;
		  
    $sql = "SELECT da.*,"
            ."\n pt.nama_lengkap, pt.nuptk, pt.nip, pt.alamat,"
            ."\n s.nss, s.nama_sekolah,"
            ."\n p.nama_propinsi,"
            ."\n k.nama_kota"

            ."\n FROM (((diklat_calonpeserta AS da LEFT JOIN ptk AS pt"
            ."\n ON da.personid=pt.id)"
            ."\n LEFT JOIN sekolah AS s"
            ."\n ON da.instansiid=s.id)"
            ."\n LEFT JOIN propinsi AS p"
            ."\n ON pt.propinsi_kode=p.kode)"
            ."\n LEFT JOIN kota AS k"
            ."\n ON pt.kota_kode=k.kode"

            ."\n WHERE da.id = " . (int)$_GET['id'];
        
    $row = $db->first($sql);
    $personid = $row->personid;
    $appvidx = intval($_GET['viewDiklat_CalonPeserta']);

    print '<div class="row-fluid">
                <div class="span12">';
            
    if ($appvidx == 1) {
        if ($row->approve1 == 'A')
            print '<p align="right"><strong>Sudah Approve (1): ' . setToStrdatetime($row->approve1_date) . '</strong></p>';
    } else if ($appvidx == 2) {
        if ($row->approve2 == 'A')
            print '<p align="right"><strong>Sudah Approve (2): ' . setToStrdatetime($row->approve2_date) . '</strong></p>';        
    } else {
        if ($row->approve3 == 'A')
            print '<p align="right"><strong>Sudah Approve (3): ' . setToStrdatetime($row->approve3_date) . '</strong></p>';        
    }
    
    print '<table border="0" cellpadding="4" cellspacing="0" width="100%">
                        <tbody>
                            <tr>
                                <td align="right" width="26"></td>
                                <td width="98">Tgl diajukan</td>
                                <td> : ' . setToStrdate($row->tgl_ajuan) . '</td>
                            </tr>
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
                                <td width="98">Nama Sekolah</td>
                                <td> : ' . $row->nama_sekolah . '</td>
                            </tr>
                            <tr>
                                <td align="right" width="26">4. </td>
                                <td width="98">NSS</td>
                                <td> : ' . $row->nss . '</td>
                            </tr>
                            <tr>
                                <td align="right" width="26">5. </td>
                                <td width="98">Propinsi</td>
                                <td> : ' . $row->nama_propinsi . '  Kota : ' . $row->nama_kota . '</td>
                            </tr>
                        </tbody>
                    </table>
                    </div>
                </div></br>';

      unset($row);

      if ($personid) {

          $sql = "SELECT ptdm.*,"
              . "\n dk.kode, dk.nama_diklat"
              . "\n FROM ptk_diklatminat ptdm LEFT JOIN diklat dk"
              . "\n ON ptdm.diklatid = dk.id"
              . "\n WHERE ptdm.ptkid = " . $personid
              . "\n ORDER BY ptdm.tahun";

          $rows = $db->fetch_all($sql);

          print '<p><strong>Ajuan Diklat :</strong></p>
	          <div class="row-fluid">
                    <div class="span12">
                        <table border="0" cellpadding="4" cellspacing="0" width="100%">
                            <thead>
                                <tr bgcolor="#3D598B" style="color: #FFFFFF;">
                                    <th width="30">Kode</th>
                                    <th>Nama Diklat</th>
                                    <th width="40">Tahun</th>
                                    <th>Deskripsi</th>
                                </tr>
                            </thead>
                            <tbody>';

          if (!$rows)
              print '
                  <tr>
                    <td colspan="4">Tidak ada data!</td>
                  </tr>';
          else {
              foreach ($rows as $row) {
                  print '
                          <tr>
                            <td>' . $row->kode . '</td>
                            <td style="text-align: left;">' . $row->nama_diklat . '</td>
                            <td>' . $row->tahun . '</td>
                            <td style="text-align: left;">' . $row->deskripsi. '</td>
                          </tr>';
              }
              unset($row);
              unset($rows);
          }
          
          print '
                            </tbody>
                        </table></br>
                        <p><strong>Riwayat Diklat di PPPPTK BMTI :</strong></p>
                        <table border="0" cellpadding="4" cellspacing="0" width="100%">
                            <thead>
                                <tr bgcolor="#3D598B" style="color: #FFFFFF;">
                                    <th width="30">Kode</th>
                                    <th>Nama Diklat</th>
                                    <th width="40">Tahun</th>
                                    <th>Jenjang</th>
                                </tr>
                            </thead>
                            <tbody>';
                                
          $sql = "SELECT dp.*,"
              . "\n dj.tahun,"
              . "\n dk.kode, dk.nama_diklat, dk.tingkat, dk.jml_jam"
              . "\n FROM (diklat_peserta dp LEFT JOIN diklat_jadwal dj"
              . "\n ON dp.jadwalid = dj.id)"
              . "\n LEFT JOIN diklat dk"
              . "\n ON dj.diklatid = dk.id"
              . "\n WHERE dp.personid = " . $personid . " AND dp.jenis = 'P'"
              . "\n ORDER BY dj.tahun";

          $rows = $db->fetch_all($sql);

          if (!$rows)
              print '
                  <tr>
                    <td colspan="4">Tidak ada data!</td>
                  </tr>';
          else {
              foreach ($rows as $row) {
                  print '
                          <tr>
                            <td>' . $row->kode . '</td>
                            <td style="text-align: left;">' . $row->nama_diklat . '</td>
                            <td>' . $row->tahun . '</td>
                            <td style="text-align: left;">' . $row->tingkat. '</td>
                          </tr>';
              }
              unset($row);
              unset($rows);
          }
          
          print '
                            </tbody>
                        </table></br>
                        <p><strong>Riwayat Diklat Lain :</strong></p>
                        <table border="0" cellpadding="4" cellspacing="0" width="100%">
                            <thead>
                                <tr bgcolor="#3D598B" style="color: #FFFFFF;">
                                    <th width="30">Tahun</th>
                                    <th>Nama Diklat</th>
                                    <th>Penyelenggara</th>
                                    <th>Tingkat</th>
                                </tr>
                            </thead>
                            <tbody>';

          $sql = "SELECT *"
              . "\n FROM ptk_rpp"
              . "\n WHERE ptkid = " . $personid
              . "\n ORDER BY tahun";

          $rows = $db->fetch_all($sql);

          if (!$rows)
              print '
                  <tr>
                    <td colspan="4">Tidak ada data!</td>
                  </tr>';
          else {
              foreach ($rows as $row) {
                  print '
                          <tr>
                            <td>' . $row->tahun . '</td>
                            <td style="text-align: left;">' . $row->nama_diklat . '</td>
                            <td style="text-align: left;">' . $row->penyelenggara . '</td>
                            <td>' . $row->tingkat. '</td>
                          </tr>';
              }
              unset($row);
              unset($rows);
          }
          

          print '
                            </tbody>
                        </table>                    
                    </div>
                </div>';

      }

  endif;
  
?>

<?php
  /* == view viewPTKInfoMinat == */
  if (isset($_GET['viewPTKInfoMinat'])):
      if (intval($_GET['viewPTKInfoMinat']) == 0 || empty($_GET['viewPTKInfoMinat'])):
          die();
      endif;
	
    $ptkid = (int)$_GET['viewPTKInfoMinat'];  
    $sql = "SELECT pt.*,"
            ."\n s.nama_sekolah, s.nss, s.alamat,"
            ."\n p.nama_propinsi,"
            ."\n k.nama_kota"

            ."\n FROM ((ptk AS pt LEFT JOIN sekolah AS s"
            ."\n ON pt.sekolahid=s.id)"
            ."\n LEFT JOIN propinsi AS p"
            ."\n ON pt.propinsi_kode=p.kode)"
            ."\n LEFT JOIN kota AS k"
            ."\n ON pt.kota_kode=k.kode"

            ."\n WHERE pt.id = " . $ptkid;

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
                        <td width="98">Nama Sekolah</td>
                        <td> : ' . $row->nama_sekolah . '</td>
                    </tr>
                    <tr>
                        <td align="right" width="26">4. </td>
                        <td width="98">NSS</td>
                        <td> : ' . $row->nss . '</td>
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

    $sql = "SELECT ptdm.*,"
          . "\n dk.kode, dk.nama_diklat"
          . "\n FROM ptk_diklatminat ptdm LEFT JOIN diklat dk"
          . "\n ON ptdm.diklatid = dk.id"
          . "\n WHERE ptdm.ptkid = " . $ptkid
          . "\n ORDER BY dk.nama_diklat";

    $rows = $db->fetch_all($sql);
    
    print '<div class="row-fluid">
                <div class="span12">
                  <p><strong>Ajuan Diklat :</strong></p>
                  <table border="0" cellpadding="4" cellspacing="0" width="100%">
                      <thead>
                          <tr bgcolor="#3D598B" style="color: #FFFFFF;">
                              <th width="30">Kode</th>
                              <th>Nama Diklat</th>
                              <th width="40">Tahun</th>
                              <th>Deskripsi</th>
                          </tr>
                      </thead>';

    if (!$rows) {
            print '<tbody>
                  <tr>
                    <td colspan="4">Tidak ada data!</td>
                  </tr>';
    } else {
            foreach ($rows as $row) {
                    print '
                          <tr>
                            <td>' . $row->kode . '</td>
                            <td style="text-align: left;">' . $row->nama_diklat . '</td>
                            <td>' . $row->tahun . '</td>
                            <td style="text-align: left;">' . $row->deskripsi. '</td>
                          </tr>';
            }
            unset($row);
    }
    print '        </tbody>
                </table>
            </div>
          </div>';
        
  endif;
  
?>

<?php

  /* == Load ptk_diklatminat ================================================ */
  if (isset($_POST['loadPTK_DiklatMinat'])):
      if (intval($_POST['loadPTK_DiklatMinat']) == 0 || empty($_POST['loadPTK_DiklatMinat'])):
          die();
      endif;
      $id = intval($_POST['loadPTK_DiklatMinat']);
      $content->loadPTK_DiklatMinat($id);
  endif;
  
  /* == Process ptk_diklatminat == */
  if (isset($_POST['processPTK_DiklatMinat'])):
      if (intval($_POST['processPTK_DiklatMinat']) == 0 || empty($_POST['processPTK_DiklatMinat'])):
          die();
      endif;
      Filter::$id = (isset($_POST['dataid'])) ? $_POST['dataid'] : 0; 
      $content->processPTK_DiklatMinat();
  endif;
  
  /* == Load ptk_mmds ====================================================== */
  if (isset($_POST['loadPTK_MMDS'])):
      if (intval($_POST['loadPTK_MMDS']) == 0 || empty($_POST['loadPTK_MMDS'])):
          die();
      endif;
      $id = intval($_POST['loadPTK_MMDS']);
      $content->loadPTK_MMDS($id);
  endif;
  
  /* == Process ptk_mmds == */
  if (isset($_POST['processPTK_MMDS'])):
      if (intval($_POST['processPTK_MMDS']) == 0 || empty($_POST['processPTK_MMDS'])):
          die();
      endif;
      Filter::$id = (isset($_POST['id'])) ? $_POST['id'] : 0; 
      $content->processPTK_MMDS();
  endif;

  /* == Load ptk_mmdl ======================================================= */
  if (isset($_POST['loadPTK_MMDL'])):
      if (intval($_POST['loadPTK_MMDL']) == 0 || empty($_POST['loadPTK_MMDL'])):
          die();
      endif;
      $id = intval($_POST['loadPTK_MMDL']);
      $content->loadPTK_MMDL($id);
  endif;
  
  /* == Process ptk_mmdl == */
  if (isset($_POST['processPTK_MMDL'])):
      if (intval($_POST['processPTK_MMDL']) == 0 || empty($_POST['processPTK_MMDL'])):
          die();
      endif;
      Filter::$id = (isset($_POST['dataid'])) ? $_POST['dataid'] : 0; 
      $content->processPTK_MMDL();
  endif;
    
  /* == Load ptk_rpp ======================================================= */
  if (isset($_POST['loadPTK_RPP'])):
      if (intval($_POST['loadPTK_RPP']) == 0 || empty($_POST['loadPTK_RPP'])):
          die();
      endif;
      $id = intval($_POST['loadPTK_RPP']);
      $content->loadPTK_RPP($id);
  endif;
  
  /* == Process ptk_rpp == */
  if (isset($_POST['processPTK_RPP'])):
      if (intval($_POST['processPTK_RPP']) == 0 || empty($_POST['processPTK_RPP'])):
          die();
      endif;
      Filter::$id = (isset($_POST['dataid'])) ? $_POST['dataid'] : 0; 
      $content->processPTK_RPP();
  endif;
      
  /* == Load ptk_rpf ======================================================= */
  if (isset($_POST['loadPTK_RPF'])):
      if (intval($_POST['loadPTK_RPF']) == 0 || empty($_POST['loadPTK_RPF'])):
          die();
      endif;
      $id = intval($_POST['loadPTK_RPF']);
      $content->loadPTK_RPF($id);
  endif;
  
  /* == Process ptk_rpf == */
  if (isset($_POST['processPTK_RPF'])):
      if (intval($_POST['processPTK_RPF']) == 0 || empty($_POST['processPTK_RPF'])):
          die();
      endif;
      Filter::$id = (isset($_POST['dataid'])) ? $_POST['dataid'] : 0; 
      $content->processPTK_RPF();
  endif;
    
  /* == Load ptk_rpnf ======================================================= */
  if (isset($_POST['loadPTK_RPNF'])):
      if (intval($_POST['loadPTK_RPNF']) == 0 || empty($_POST['loadPTK_RPNF'])):
          die();
      endif;
      $id = intval($_POST['loadPTK_RPNF']);
      $content->loadPTK_RPNF($id);
  endif;
  
  /* == Process ptk_rpnf == */
  if (isset($_POST['processPTK_RPNF'])):
      if (intval($_POST['processPTK_RPNF']) == 0 || empty($_POST['processPTK_RPNF'])):
          die();
      endif;
      Filter::$id = (isset($_POST['dataid'])) ? $_POST['dataid'] : 0; 
      $content->processPTK_RPNF();
  endif;
    
  /* == Load ptk_rsertifikat ======================================================= */
  if (isset($_POST['loadPTK_RSertifikat'])):
      if (intval($_POST['loadPTK_RSertifikat']) == 0 || empty($_POST['loadPTK_RSertifikat'])):
          die();
      endif;
      $id = intval($_POST['loadPTK_RSertifikat']);
      $content->loadPTK_RSertifikat($id);
  endif;
  
  /* == Process ptk_rsertifikat == */
  if (isset($_POST['processPTK_RSertifikat'])):
      if (intval($_POST['processPTK_RSertifikat']) == 0 || empty($_POST['processPTK_RSertifikat'])):
          die();
      endif;
      Filter::$id = (isset($_POST['dataid'])) ? $_POST['dataid'] : 0; 
      $content->processPTK_RSertifikat();
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
      
  /* == nupksearch == */
  if (isset($_GET['nuptksearch'])):
      if (empty($_GET['nuptksearch'])):
          die();
      endif;
      
    $nuptk = (string)($_GET['nuptksearch']);

    if (isset($_GET['from']))
      $from = (string)($_GET['from']);
    else
      $from = "P"; // -- from : ptk --
      
    if (isset($_GET['field']))
      $field = (string)($_GET['field']);
    else
      $field = "nuptk";

    if ($from == "S")
      $sql = "SELECT id, " . $field . ", nama_lengkap"
            . "\n FROM staff"
            . "\n WHERE " . $field . " LIKE '%" . $nuptk . "%'"
            . "\n ORDER BY nama_lengkap";
    else
      $sql = "SELECT id, " . $field . ", nama_lengkap"
            . "\n FROM ptk"
            . "\n WHERE " . $field . " LIKE '%" . $nuptk . "%'"
            . "\n ORDER BY nama_lengkap";

    $rows = $db->fetch_all($sql);
      
    $arr = array();
   foreach($rows as $row) {
      // key harus dinamakan "id dan nama"
      if ($field == "nip")
        $nuptk = $row->nip;
      else
        $nuptk = $row->nuptk;
      $arr[] = array('id'=>$row->id, 'nuptk'=>$nuptk, 'nama_lengkap'=>$row->nama_lengkap);
   }
   unset ($row);
   unset ($rows);
   
   print json_encode($arr);   
   
  endif;      
  
?>
