<?php
  /**
   * Controller
   *
   * @package SIM PPPPTK BMTI
   * @author a2ngsa
   * @copyright 2012
   * @version $Id: controller.php, v1.00 2011-06-05 10:12:05 gewa Exp $
   */
  define("_VALID_PHP", true);
  
  require_once("init.php");
  if (!$user->is_Admin())
    //redirect_to("login.php");
      : die("<div style='text-align:center;margin-top:20px'>" 
      . "<span style='padding: 10px; border: 1px solid #999; background-color:#EFEFEF;" 
      . "font-family: Verdana; font-size: 12px; margin-left:auto; margin-right:auto;color:red'>" 
      . "<b>Warning:</b> Anda tidak dapat mengakses halaman ini !</span></div>");
  endif;
  
?>

<?php
  /* == Proccess Configuration == */
  if (isset($_POST['processConfig'])):
	$core->processConfig();
  endif;
?>

<?php
  /* == Load Calendar == */
  if (isset($_POST['month'])):
	require_once(BASEPATH . "lib/class_calendar.php");
	Registry::set('Calendar',new Calendar());
	$cal = Registry::get("Calendar");
	
	$cal->renderCalendar();
  endif;
?>


<?php
  /* == Proccess Message == */
  if (isset($_POST['processMessage']))
      : if (intval($_POST['processMessage']) == 0 || empty($_POST['processMessage']))
      : die();
  endif;
  Filter::$id = (isset($_POST['id'])) ? $_POST['id'] : 0; 
  $content->processMessage();
  endif;

  /* == Delete Message == */
  if (isset($_POST['deleteMessage']))
      : if (intval($_POST['deleteMessage']) == 0 || empty($_POST['deleteMessage']))
      : die();
  endif;
  
  $id = intval($_POST['deleteMessage']);
  $db->delete("messages", "id='" . $id . "'");
  
  print ($db->affected()) ? Filter::msgOk(lang('DEL_OK')) : Filter::msgAlert(lang('NOPROCCESS'));
  endif;
?>

<?php
  /* == Proccess User_Profile == */
  if (isset($_POST['processUser_Profile'])):
      if (intval($_POST['processUser_Profile']) == 0 || empty($_POST['processUser_Profile'])):
          die();
      endif;
      Filter::$id = (isset($_POST['id'])) ? $_POST['id'] : 0;
      $user->processUser_Profile();
  endif;

  /* == Delete User_Profile == */
  if (isset($_POST['deleteUser_Profile'])):
      if (intval($_POST['deleteUser_Profile']) == 0 || empty($_POST['deleteUser_Profile'])):
          die();
      endif;

      $id = intval($_POST['deleteUser_Profile']);
      if ($id == 1):
            Filter::msgError('Profile ini tidak bisa dihapus (System)!');
      else:
            $db->delete("user_profilemodules", "profileid='" . $id . "'");
            $db->delete("user_profiles", "id='" . $id . "'");
            print ($db->affected()) ? Filter::msgOk(lang('DEL_OK')) : Filter::msgAlert(lang('NOPROCCESS'));
      endif;
  endif;
?>


<?php
  /* == Proccess User == */
  if (isset($_POST['processUser'])):
      if (intval($_POST['processUser']) == 0 || empty($_POST['processUser'])):
          die();
      endif;
      Filter::$id = (isset($_POST['id'])) ? $_POST['id'] : 0;
      $user->processUser();
  endif;

  /* == Delete User== */
  if (isset($_POST['deleteUser'])):
      if (intval($_POST['deleteUser']) == 0 || empty($_POST['deleteUser'])):
          die();
      endif;

      $id = intval($_POST['deleteUser']);
      if ($id == 1):
          Filter::msgError('User SYSTEM Admin tidak dapat dihapus!');
      else:
          /*
		  if ($projects = $db->fetch_all("SELECT id FROM projects WHERE client_id = '$id'")):
              foreach ($projects as $row):
                  $db->delete("invoice_data", "project_id='" . $row->id . "'");
                  $db->delete("invoice_payments", "project_id='" . $row->id . "'");
                  $db->delete("invoices", "project_id='" . $row->id . "'");
                  $db->delete("project_files", "project_id='" . $row->id . "'");
                  $db->delete("submissions", "project_id='" . $row->id . "'");
                  $db->delete("tasks", "project_id='" . $row->id . "'");
				  $db->delete("time_billing", "project_id='" . $row->id . "'");
              endforeach;
          endif;
          $db->delete("projects", "client_id='" . $id . "'");
          $db->delete("users", "id='" . $id . "'");
          $username = sanitize($_POST['title']);
		  */

          $db->delete("users", "id='" . $id . "'");
		  
          print ($db->affected()) ? Filter::msgOk(lang('DEL_OK')) : Filter::msgAlert(lang('NOPROCCESS'));
      endif;
  endif;
?>

<?php
  /* == Proccess Add Propinsi ===================================================================================================================== */
  if (isset($_POST['processAddPropinsi'])):
	  if (intval($_POST['processAddPropinsi']) == 0 || empty($_POST['processAddPropinsi'])):
          die();
      endif;
      $content->processAddPropinsi();
  endif;

  /* == Proccess Update Propinsi ===================================================================================================================== */
  if (isset($_POST['processUpdatePropinsi'])):
	  if (empty($_POST['processUpdatePropinsi'])):
          die();
      endif;
      $content->processUpdatePropinsi();
  endif;
    
  /* == Delete Propinsi == */
  if (isset($_POST['deletePropinsi'])):
      if ($_POST['deletePropinsi'] == '' || empty($_POST['deletePropinsi'])):
          die();
      endif;

      $kode = $_POST['deletePropinsi'];
      $db->delete("propinsi", "kode='" . $kode . "'");

      print ($db->affected()) ? Filter::msgOk(lang('DEL_OK')) : Filter::msgAlert(lang('NOPROCCESS'));
  endif;

?>

<?php
  /* == Proccess Add Kota == */
  if (isset($_POST['processAddKota'])):
      if (intval($_POST['processAddKota']) == 0 || empty($_POST['processAddKota'])):
          die();
      endif;
      $content->processAddKota();
  endif;

  /* == Proccess Update Kota == */
  if (isset($_POST['processUpdateKota'])):
      if (empty($_POST['processUpdateKota'])):
          die();
      endif;
      $content->processUpdateKota();
  endif;  
  
  /* == Delete Kota == */
  if (isset($_POST['deleteKota'])):
      if ($_POST['deleteKota'] == '' || empty($_POST['deleteKota'])):
          die();
      endif;

      $kode = $_POST['deleteKota'];
      $db->delete("kota", "kode='" . $kode . "'");

      print ($db->affected()) ? Filter::msgOk(lang('DEL_OK')) : Filter::msgAlert(lang('NOPROCCESS'));
  endif;

  /* == Load KotaList == */
  if (isset($_POST['loadKotaList'])):
      if ($_POST['loadKotaList'] == '' || empty($_POST['loadKotaList'])):
          die();
      endif;

      list($kode, $firstall) = explode(":", $_POST['loadKotaList']);

      $kota_kode = (string)($kode);
      ($firstall == "true") ? $kota_firstall = true : $kota_firstall = false;
	  	  
      $content->loadKotaList($kota_kode, $kota_firstall);
  endif;

?>

<?php
  /* == Proccess Departemen ===================================================================================================================== */
  if (isset($_POST['processDepartemen'])):
      if (intval($_POST['processDepartemen']) == 0 || empty($_POST['processDepartemen'])):
          die();
      endif;
      Filter::$id = (isset($_POST['id'])) ? $_POST['id'] : 0;
      $content->processDepartemen();
  endif;

  /* == Delete Departemen == */
  if (isset($_POST['deleteDepartemen'])):
      if (intval($_POST['deleteDepartemen']) == 0 || empty($_POST['deleteDepartemen'])):
          die();
      endif;

      $id = intval($_POST['deleteDepartemen']);
      $db->delete("departemen", "id='" . $id . "'");

      print ($db->affected()) ? Filter::msgOk(lang('DEL_OK')) : Filter::msgAlert(lang('NOPROCCESS'));
  endif;

?>

<?php
  /* == Proccess Golongan ===================================================================================================================== */
  if (isset($_POST['processGolongan'])):
      if (intval($_POST['processGolongan']) == 0 || empty($_POST['processGolongan'])):
          die();
      endif;
      Filter::$id = (isset($_POST['id'])) ? $_POST['id'] : 0;
      $content->processGolongan();
  endif;

  /* == Delete Golongan == */
  if (isset($_POST['deleteGolongan'])):
      if (intval($_POST['deleteGolongan']) == 0 || empty($_POST['deleteGolongan'])):
          die();
      endif;

      $id = intval($_POST['deleteGolongan']);
      $db->delete("golongan", "id='" . $id . "'");

      print ($db->affected()) ? Filter::msgOk(lang('DEL_OK')) : Filter::msgAlert(lang('NOPROCCESS'));
  endif;

?>

<?php
  /* == Proccess bsk == */
  if (isset($_POST['processBSK'])):
      if (intval($_POST['processBSK']) == 0 || empty($_POST['processBSK'])):
          die();
      endif;
      Filter::$id = (isset($_POST['id'])) ? $_POST['id'] : 0;
      $content->processBSK();
  endif;

  /* == Delete bsk == */
  if (isset($_POST['deleteBSK'])):
      if (intval($_POST['deleteBSK']) == 0 || empty($_POST['deleteBSK'])):
          die();
      endif;

      $id = intval($_POST['deleteBSK']);
      $db->delete("bsk", "id='" . $id . "'");

      /* -- delete psk -- */

      if ($psk = $db->fetch_all("SELECT id FROM psk WHERE bskid = '$id'")):
            foreach ($psk as $row):
                    $db->delete("kk", "pskid='" . $row->id . "'");
            endforeach;
      endif;	  

      /* -- delete kk -- */
	  
      $db->delete("psk", "bskid='" . $id . "'");
	  	  
      print ($db->affected()) ? Filter::msgOk(lang('DEL_OK')) : Filter::msgAlert(lang('NOPROCCESS'));
  endif;

  /* == Load bskList == */
  if (isset($_POST['loadBSKList'])):
      if (intval($_POST['loadBSKList']) == 0 || empty($_POST['loadBSKList'])):
          die();
      endif;
      $id = intval($_POST['loadBSKList']);
	  	  
      $content->loadBSKList($id);
  endif;
?>

<?php
  /* == Proccess psk == */
  if (isset($_POST['processPSK'])):
      if (intval($_POST['processPSK']) == 0 || empty($_POST['processPSK'])):
          die();
      endif;
      Filter::$id = (isset($_POST['id'])) ? $_POST['id'] : 0;
      $content->processPSK();
  endif;

  /* == Delete psk == */
  if (isset($_POST['deletePSK'])):
      if (intval($_POST['deletePSK']) == 0 || empty($_POST['deletePSK'])):
          die();
      endif;

      $id = intval($_POST['deletePSK']);
      $db->delete("psk", "id='" . $id . "'");
	  
	  /* -- delete kk -- */
	  
      $db->delete("kk", "pskid='" . $id . "'");
	  	  
      print ($db->affected()) ? Filter::msgOk(lang('DEL_OK')) : Filter::msgAlert(lang('NOPROCCESS'));
  endif;

  /* == Load pskList == */
  if (isset($_POST['loadPSKList'])):
      if (empty($_POST['loadPSKList'])):
          die();
      endif;

      list($id, $firstall) = explode(":", $_POST['loadPSKList']);

      $pskid = intval($id);
      ($firstall == "true") ? $pskfirstall = true : $pskfirstall = false;
	  	  
      $content->loadPSKList($pskid, $pskfirstall);
  endif;
?>

<?php
  /* == Proccess kk == */
  if (isset($_POST['processKK'])):
      if (intval($_POST['processKK']) == 0 || empty($_POST['processKK'])):
          die();
      endif;
      Filter::$id = (isset($_POST['id'])) ? $_POST['id'] : 0;
      $content->processKK();
  endif;

  /* == Delete kk == */
  if (isset($_POST['deleteKK'])):
      if (intval($_POST['deleteKK']) == 0 || empty($_POST['deleteKK'])):
          die();
      endif;

      $id = intval($_POST['deleteKK']);
      $db->delete("kk", "id='" . $id . "'");

      print ($db->affected()) ? Filter::msgOk(lang('DEL_OK')) : Filter::msgAlert(lang('NOPROCCESS'));
  endif;

  /* == Load kkList == */
  if (isset($_POST['loadKKList'])):
      if (empty($_POST['loadKKList'])):
          die();
      endif;

      list($id, $firstall) = explode(":", $_POST['loadKKList']);

      $kkid = intval($id);
      ($firstall == "true") ? $kkfirstall = true : $kkfirstall = false;
	  	  
      $content->loadKKList($kkid, $kkfirstall);
  endif;
?>

<?php
  /* == Proccess Sekolah_Jenis ===================================================================================================================== */
  if (isset($_POST['processSekolah_Jenis'])):
      if (intval($_POST['processSekolah_Jenis']) == 0 || empty($_POST['processSekolah_Jenis'])):
          die();
      endif;
      Filter::$id = (isset($_POST['id'])) ? $_POST['id'] : 0;
      $content->processSekolah_Jenis();
  endif;

  /* == Delete Sekolah_Jenis == */
  if (isset($_POST['deleteSekolah_Jenis'])):
      if (intval($_POST['deleteSekolah_Jenis']) == 0 || empty($_POST['deleteSekolah_Jenis'])):
          die();
      endif;

      $id = intval($_POST['deleteSekolah_Jenis']);
      $db->delete("sekolah_jenis", "id='" . $id . "'");

      print ($db->affected()) ? Filter::msgOk(lang('DEL_OK')) : Filter::msgAlert(lang('NOPROCCESS'));
  endif;

?>

<?php
  /* == Update Sekolah ==================================================================================================================== */
    
  if (isset($_POST['processUpdateSekolah']))
      : if (intval($_POST['processUpdateSekolah']) == 0 || empty($_POST['processUpdateSekolah']))
      : die();
  endif;
   
  Filter::$id = (isset($_POST['id'])) ? $_POST['id'] : 0; 
   
  $content->processUpdateSekolah();
  endif;

  /* == Add Sekolah == */
  if (isset($_POST['processAddSekolah']))
      : if (intval($_POST['processAddSekolah']) == 0 || empty($_POST['processAddSekolah']))
      : die();
  endif;
  
  $content->processAddSekolah();
  endif;
  
 
  /* == Delete Sekolah == */
  if (isset($_POST['deleteSekolah']))
      : if (empty($_POST['deleteSekolah']))
      : die();
  endif;
  
  $id = intval($_POST['deleteSekolah']);

  $res = $db->delete("sekolah", "id=" . $id);

    $db->delete("sekolah_ppmd", "sekolahid='" . $id . "'");
    $db->delete("sekolah_rkpjt", "sekolahid='" . $id . "'");
    $db->delete("sekolah_rkpsj", "sekolahid='" . $id . "'");
    $db->delete("sekolah_rpkpp", "sekolahid='" . $id . "'");
    $db->delete("sekolah_rptl", "sekolahid='" . $id . "'");
    $db->delete("sekolah_ruang", "sekolahid='" . $id . "'");
    $db->delete("sekolah_siswa", "sekolahid='" . $id . "'");
    $db->delete("sekolah_smk", "sekolahid='" . $id . "'");
    $db->delete("sekolah_tanah", "sekolahid='" . $id . "'");
  
  print ($res) ? Filter::msgOk(lang('DEL_OK')) : Filter::msgAlert(lang('NOPROCCESS'));
  endif;

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
    
?>

<?php
  /* == Update PTK == */
  if (isset($_POST['processUpdatePTK']))
      : if (intval($_POST['processUpdatePTK']) == 0 || empty($_POST['processUpdatePTK']))
      : die();
  endif;
  Filter::$id = (isset($_POST['id'])) ? $_POST['id'] : 0; 
  $content->processUpdatePTK();
  endif;

  /* == Add PTK == */
  if (isset($_POST['processAddPTK']))
      : if (intval($_POST['processAddPTK']) == 0 || empty($_POST['processAddPTK']))
      : die();
  endif;

  $content->processAddPTK();
  endif;
  
 
  /* == Delete PTK == */
  if (isset($_POST['deletePTK']))
      : if (empty($_POST['deletePTK']))
      : die();
  endif;
  
  $id = intval($_POST['deletePTK']);
      
  $res = $db->delete("ptk", "id='" . $id . "'");
  
  $db->delete("ptk_diklatminat", "ptkid='" . $id . "'");
  $db->delete("ptk_mmds", "ptkid='" . $id . "'");
  $db->delete("ptk_mmdl", "ptkid='" . $id . "'");
  $db->delete("ptk_rpf", "ptkid='" . $id . "'");
  $db->delete("ptk_rpnf", "ptkid='" . $id . "'");
  $db->delete("ptk_rpp", "ptkid='" . $id . "'");
  $db->delete("ptk_sekolah", "ptkid='" . $id . "'");
  $db->delete("ptk_foto", "ptkid='" . $id . "'");

  $db->delete("ptk_tna", "ptkid='" . $id . "'");
  $db->delete("ptk_kd", "ptkid='" . $id . "'");
    
  print ($res) ? Filter::msgOk(lang('DEL_OK')) : Filter::msgAlert(lang('NOPROCCESS'));
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
  /* == Update Diklat == */
  if (isset($_POST['processUpdateDiklat']))
      : if (intval($_POST['processUpdateDiklat']) == 0 || empty($_POST['processUpdateDiklat']))
      : die();
  endif;
  Filter::$id = (isset($_POST['id'])) ? $_POST['id'] : 0; 
  $content->processUpdateDiklat();
  endif;

  /* == Add Diklat == */
  if (isset($_POST['processAddDiklat']))
      : if (intval($_POST['processAddDiklat']) == 0 || empty($_POST['processAddDiklat']))
      : die();
  endif;

  $content->processAddDiklat();
  endif;
  
 
  /* == Delete Diklat == */
  if (isset($_POST['deleteDiklat']))
      : if (empty($_POST['deleteDiklat']))
      : die();
  endif;
  
  $id = intval($_POST['deleteDiklat']);
  $res = $db->delete("diklat", "id='" . $id . "'");
    
  print ($res) ? Filter::msgOk(lang('DEL_OK')) : Filter::msgAlert(lang('NOPROCCESS'));
  endif;
   
?>

<?php

  /* == Update Diklat_Jadwal == */

  if (isset($_POST['processDiklat_Jadwal'])):
      if (intval($_POST['processDiklat_Jadwal']) == 0 || empty($_POST['processDiklat_Jadwal'])):
          die();
      endif;
      Filter::$id = (isset($_POST['id'])) ? $_POST['id'] : 0;
      $content->processDiklat_Jadwal();
  endif;
   
  /* == Delete Diklat_Jadwal == */
  if (isset($_POST['deleteDiklat_Jadwal']))
      : if (empty($_POST['deleteDiklat_Jadwal']))
      : die();
  endif;
  
  $id = intval($_POST['deleteDiklat_Jadwal']);

  $res = $db->delete("diklat_jadwal", "id='" . (int)$id . "'");
  
  print ($res) ? Filter::msgOk(lang('DATA_DELOK')) : Filter::msgAlert(lang('NOPROCCESS'));
  endif;
    
?>

<?php
  /* == Proccess Diklat_CalonPeserta == */
  if (isset($_POST['processDiklat_CalonPeserta'])):
      if (intval($_POST['processDiklat_CalonPeserta']) == 0 || empty($_POST['processDiklat_CalonPeserta'])):
          die();
      endif;
      Filter::$id = (isset($_POST['id'])) ? $_POST['id'] : 0;
      $content->processDiklat_CalonPeserta();
  endif;

  /* == Delete Diklat_CalonPeserta == */
  if (isset($_POST['deleteDiklat_CalonPeserta'])):
      if (intval($_POST['deleteDiklat_CalonPeserta']) == 0 || empty($_POST['deleteDiklat_CalonPeserta'])):
          die();
      endif;

      $id = intval($_POST['deleteDiklat_CalonPeserta']);
      $db->delete("diklat_calonpeserta", "id='" . $id . "'");

      print ($db->affected()) ? Filter::msgOk(lang('DEL_OK')) : Filter::msgAlert(lang('NOPROCCESS'));
  endif;

  /* == Proccess Diklat_CalonPesertaToggleApprove == */
  if (isset($_POST['processDiklat_CalonPesertaToggleApprove'])):
      if (intval($_POST['processDiklat_CalonPesertaToggleApprove']) == 0 || empty($_POST['processDiklat_CalonPesertaToggleApprove'])):
          die();
      endif;
	  
      $id = intval($_POST['processDiklat_CalonPesertaToggleApprove']);
      $idx = intval($_POST['idx']);
	  	  
	  $sql = "SELECT approve" . $idx . " as approve FROM diklat_calonpeserta WHERE id = '" . $id . "'"; 
	  $row = $db->first($sql);
	  if ($row) {
		if ($row->approve)
			$db->query("UPDATE diklat_calonpeserta SET approve" . $idx ." = NULL WHERE id = '" . $id . "'");
		else
			$db->query("UPDATE diklat_calonpeserta SET approve" . $idx ." = 'A', approve" . $idx ."_date = NOW() WHERE id = '" . $id . "'");
								
		print ($db->affected()) ? Filter::msgOk('Calon Peserta berhasil di approve.') : Filter::msgAlert(lang('NOPROCCESS'));
	  } else {
		print Filter::msgAlert('Data Calon Peserta tidak ditemukan!');
	  }

  endif;

  
?>

<?php
  /* == Proccess Diklat_PesertaAdd == */
  if (isset($_POST['processDiklat_PesertaAdd'])):
      if (intval($_POST['processDiklat_PesertaAdd']) == 0 || empty($_POST['processDiklat_PesertaAdd'])):
          die();
      endif;
      $content->processDiklat_PesertaAdd();
  endif;

  if (isset($_POST['processDiklat_Peserta'])):
      if (intval($_POST['processDiklat_Peserta']) == 0 || empty($_POST['processDiklat_Peserta'])):
          die();
      endif;
      Filter::$id = (isset($_POST['id'])) ? $_POST['id'] : 0;
      $content->processDiklat_Peserta();
  endif;  
  
  /* == Delete Diklat_Peserta == */
  if (isset($_POST['deleteDiklat_Peserta'])):
      if (intval($_POST['deleteDiklat_Peserta']) == 0 || empty($_POST['deleteDiklat_Peserta'])):
          die();
      endif;

      $id = intval($_POST['deleteDiklat_Peserta']);
      $db->delete("diklat_peserta", "id='" . $id . "'");

      print ($db->affected()) ? Filter::msgOk(lang('DEL_OK')) : Filter::msgAlert(lang('NOPROCCESS'));
  endif;

  /* == Proccess Diklat_CalonPesertaGanti == */
  if (isset($_POST['processDiklat_CalonPesertaGanti'])):
      if (intval($_POST['processDiklat_CalonPesertaGanti']) == 0 || empty($_POST['processDiklat_CalonPesertaGanti'])):
          die();
      endif;
      Filter::$id = (isset($_POST['id'])) ? $_POST['id'] : 0;
      $content->processDiklat_CalonPesertaGanti();
  endif;

  /* == update Diklat_CalonPeserta == */
  if (isset($_POST['updateDiklat_CalonPeserta'])):
      if (intval($_POST['updateDiklat_CalonPeserta']) == 0 || empty($_POST['updateDiklat_CalonPeserta'])):
          die();
      endif;

      Filter::$id = intval($_POST['updateDiklat_CalonPeserta']);
      $content->updateDiklat_CalonPeserta();

  endif;

  /* == update Diklat_Peserta == */
  if (isset($_POST['updateDiklat_Peserta'])):
      if (intval($_POST['updateDiklat_Peserta']) == 0 || empty($_POST['updateDiklat_Peserta'])):
          die();
      endif;

      Filter::$id = intval($_POST['updateDiklat_Peserta']);
      $content->updateDiklat_Peserta();

  endif;  
  
?>

<?php
  /* == Proccess kk_tna == */
  if (isset($_POST['processTNA_KK'])):
      if (intval($_POST['processTNA_KK']) == 0 || empty($_POST['processTNA_KK'])):
          die();
      endif;
	 	 
      Filter::$id = (isset($_POST['id'])) ? $_POST['id'] : 0;
      $content->processTNA_KK();
  endif;

  /* == Delete kk_tna == */
  if (isset($_POST['deleteTNA_KK'])):
      if (intval($_POST['deleteTNA_KK']) == 0 || empty($_POST['deleteTNA_KK'])):
          die();
      endif;

      $id = intval($_POST['deleteTNA_KK']);
      $db->delete("kk_tna", "id='" . $id . "'");

      print ($db->affected()) ? Filter::msgOk(lang('DEL_OK')) : Filter::msgAlert(lang('NOPROCCESS'));
  endif;

?>

<?php
  /* == Proccess kd == */
  if (isset($_POST['processKD'])):
      if (intval($_POST['processKD']) == 0 || empty($_POST['processKD'])):
          die();
      endif;
      Filter::$id = (isset($_POST['id'])) ? $_POST['id'] : 0;
      $content->processKD();
  endif;

  /* == Delete kd == */
  if (isset($_POST['deleteKD'])):
      if (intval($_POST['deleteKD']) == 0 || empty($_POST['deleteKD'])):
          die();
      endif;

      $id = intval($_POST['deleteKD']);
      $db->delete("kd", "id='" . $id . "'");
      $db->delete("kd_indikator", "kdid='" . $id . "'");
      
      print ($db->affected()) ? Filter::msgOk(lang('DEL_OK')) : Filter::msgAlert(lang('NOPROCCESS'));
  endif;

  /* == Proccess kd_indikator == */
  if (isset($_POST['processKD_Indikator'])):
      if (intval($_POST['processKD_Indikator']) == 0 || empty($_POST['processKD_Indikator'])):
          die();
      endif;
      Filter::$id = (isset($_POST['id'])) ? $_POST['id'] : 0;
      $content->processKD_Indikator();
  endif;

  /* == Delete kd_indikator == */
  if (isset($_POST['deleteKD_Indikator'])):
      if (intval($_POST['deleteKD_Indikator']) == 0 || empty($_POST['deleteKD_Indikator'])):
          die();
      endif;

      $id = intval($_POST['deleteKD_Indikator']);
      $db->delete("kd_indikator", "id='" . $id . "'");
      
      print ($db->affected()) ? Filter::msgOk(lang('DEL_OK')) : Filter::msgAlert(lang('NOPROCCESS'));
  endif;

?>

<?php
  /* == Update TNA_PTK == */
  if (isset($_POST['processUpdateTNA_PTK']))
      : if (intval($_POST['processUpdateTNA_PTK']) == 0 || empty($_POST['processUpdateTNA_PTK']))
      : die();
  endif;
  Filter::$id = (isset($_POST['id'])) ? $_POST['id'] : 0; 
  $content->processUpdateTNA_PTK();
  endif;
   
  /* == Delete TNA_PTK == */
  if (isset($_POST['deleteTNA_PTK']))
      : if (empty($_POST['deleteTNA_PTK']))
      : die();
  endif;
  
  $id = intval($_POST['deleteTNA_PTK']);

  $res = $db->delete("ptk_tna", "id='" . $id . "'");
  $db->delete("ptk_kd", "ptk_tnaid='" . $id . "'");
    
  print ($res) ? Filter::msgOk(lang('DEL_OK')) : Filter::msgAlert(lang('NOPROCCESS'));
  endif;
    
?>

<?php
  /* == Proccess gedung ==  PENYELENGGARAAN ====================================================================*/
  if (isset($_POST['processGedung'])):
      if (intval($_POST['processGedung']) == 0 || empty($_POST['processGedung'])):
          die();
      endif;
      Filter::$id = (isset($_POST['id'])) ? $_POST['id'] : 0;
      $content->processGedung();
  endif;

  /* == Delete Gedung == */
  if (isset($_POST['deleteGedung'])):
      if (intval($_POST['deleteGedung']) == 0 || empty($_POST['deleteGedung'])):
          die();
      endif;

      $id = intval($_POST['deleteGedung']);
      $db->delete("gedung", "id='" . $id . "'");
	  
      /* -- delete kamar_bed -- */

      if ($kamar = $db->fetch_all("SELECT id FROM kamar WHERE gedungid = '$id'")):
            foreach ($kamar as $row):
                    $db->delete("kamar_bed", "kamarid='" . $row->id . "'");
            endforeach;
      endif;	  

      /* -- delete kamar -- */
	  
      $db->delete("kamar", "gedungid='" . $id . "'");
	  
      print ($db->affected()) ? Filter::msgOk(lang('DEL_OK')) : Filter::msgAlert(lang('NOPROCCESS'));
  endif;

?>

<?php
  /* == Proccess kamar == */
  if (isset($_POST['processKamar'])):
      if (intval($_POST['processKamar']) == 0 || empty($_POST['processKamar'])):
          die();
      endif;
      Filter::$id = (isset($_POST['id'])) ? $_POST['id'] : 0;
      $content->processKamar();
  endif;

  /* == Delete Kamar == */
  if (isset($_POST['deleteKamar'])):
      if (intval($_POST['deleteKamar']) == 0 || empty($_POST['deleteKamar'])):
          die();
      endif;

      $id = intval($_POST['deleteKamar']);
      $db->delete("gedung", "id='" . $id . "'");
	  
	  /* -- delete bed -- */
      $db->delete("kamar_bed", "kamarid='" . $id . "'");
	  
      print ($db->affected()) ? Filter::msgOk(lang('DEL_OK')) : Filter::msgAlert(lang('NOPROCCESS'));
  endif;

  /* == Load KamarList == */
  if (isset($_POST['loadKamarList'])):
      if (intval($_POST['loadKamarList']) == 0 || empty($_POST['loadKamarList'])):
          die();
      endif;
      $id = intval($_POST['loadKamarList']);
	  	  
      $content->loadKamarList($id);
  endif;
    
?>

<?php
  /* == Proccess kamar_Bed == */
  if (isset($_POST['processKamar_Bed'])):
      if (intval($_POST['processKamar_Bed']) == 0 || empty($_POST['processKamar_Bed'])):
          die();
      endif;
      Filter::$id = (isset($_POST['id'])) ? $_POST['id'] : 0;
      $content->processKamar_Bed();
  endif;

  /* == Delete Kamar_Bed == */
  if (isset($_POST['deleteKamar_Bed'])):
      if (intval($_POST['deleteKamar_Bed']) == 0 || empty($_POST['deleteKamar_Bed'])):
          die();
      endif;

      $id = intval($_POST['deleteKamar_Bed']);
      $db->delete("kamar_bed", "id='" . $id . "'");
	  	  
      print ($db->affected()) ? Filter::msgOk(lang('DEL_OK')) : Filter::msgAlert(lang('NOPROCCESS'));
  endif;

  /* == Load Kamar_BedList == */
  if (isset($_POST['loadKamar_BedList'])):
      if (intval($_POST['loadKamar_BedList']) == 0 || empty($_POST['loadKamar_BedList'])):
          die();
      endif;
      $id = intval($_POST['loadKamar_BedList']);
	  	  
      $content->loadKamar_BedList($id);
  endif;
    
?>

<?php
  /* == Proccess diklat_mata_tatar == */
  if (isset($_POST['processDiklat_Mata_Tatar'])):
      if (intval($_POST['processDiklat_Mata_Tatar']) == 0 || empty($_POST['processDiklat_Mata_Tatar'])):
          die();
      endif;
      Filter::$id = (isset($_POST['id'])) ? $_POST['id'] : 0;
      $content->processDiklat_Mata_Tatar();
  endif;

  /* == Delete diklat_mata_tatar == */
  if (isset($_POST['deleteDiklat_Mata_Tatar'])):
      if (intval($_POST['deleteDiklat_Mata_Tatar']) == 0 || empty($_POST['deleteDiklat_Mata_Tatar'])):
          die();
      endif;

      $id = intval($_POST['deleteDiklat_Mata_Tatar']);
      $db->delete("diklat_mata_tatar", "id='" . $id . "'");
	  	  
      print ($db->affected()) ? Filter::msgOk(lang('DEL_OK')) : Filter::msgAlert(lang('NOPROCCESS'));
  endif;

?>

<?php
  /* == Proccess diklat_absen == */
  if (isset($_POST['processDiklat_Absen'])):
      if (intval($_POST['processDiklat_Absen']) == 0 || empty($_POST['processDiklat_Absen'])):
          die();
      endif;
      Filter::$id = (isset($_POST['id'])) ? $_POST['id'] : 0;
      $content->processDiklat_Absen();
  endif;

?>

<?php
  /* == Proccess diklat_nilai == */
  if (isset($_POST['processDiklat_Nilai'])):
      if (intval($_POST['processDiklat_Nilai']) == 0 || empty($_POST['processDiklat_Nilai'])):
          die();
      endif;
      Filter::$id = (isset($_POST['id'])) ? $_POST['id'] : 0;
      $content->processDiklat_Nilai();
  endif;
?>

<?php
  /* == Proccess diklat_sertifikat == */
  if (isset($_POST['processDiklat_Sertifikat'])):
      if (intval($_POST['processDiklat_Sertifikat']) == 0 || empty($_POST['processDiklat_Sertifikat'])):
          die();
      endif;
      Filter::$id = (isset($_POST['id'])) ? $_POST['id'] : 0;
      $content->processDiklat_Sertifikat();
  endif;
  
  /* == Proccess diklat_sertifikatvalidasi == */
  if (isset($_POST['processDiklat_SertifikatValidasi'])):
      if (intval($_POST['processDiklat_SertifikatValidasi']) == 0 || empty($_POST['processDiklat_SertifikatValidasi'])):
          die();
      endif;
      Filter::$id = (isset($_POST['id'])) ? $_POST['id'] : 0;
      $content->processDiklat_SertifikatValidasi();
  endif;
  
?>

<?php
  /* == Proccess diklat_agenda == */
  if (isset($_POST['processDiklat_Agenda'])):
      if (intval($_POST['processDiklat_Agenda']) == 0 || empty($_POST['processDiklat_Agenda'])):
          die();
      endif;
      Filter::$id = (isset($_POST['id'])) ? $_POST['id'] : 0;
      $content->processDiklat_Agenda();
  endif;

  /* == Delete diklat_agenda == */
  if (isset($_POST['deleteDiklat_Agenda'])):
      if (intval($_POST['deleteDiklat_Agenda']) == 0 || empty($_POST['deleteDiklat_Agenda'])):
          die();
      endif;

      $id = intval($_POST['deleteDiklat_Agenda']);
      $db->delete("diklat_agenda", "id='" . $id . "'");
	  	  
      print ($db->affected()) ? Filter::msgOk(lang('DEL_OK')) : Filter::msgAlert(lang('NOPROCCESS'));
  endif;

?>

<?php
  /* == Update Lembaga ==================================================================================================================== */
    
  if (isset($_POST['processUpdateLembaga']))
      : if (intval($_POST['processUpdateLembaga']) == 0 || empty($_POST['processUpdateLembaga']))
      : die();
  endif;
   
  Filter::$id = (isset($_POST['id'])) ? $_POST['id'] : 0; 
   
  $content->processUpdateLembaga();
  endif;

  /* == Add Lembaga == */
  if (isset($_POST['processAddLembaga']))
      : if (intval($_POST['processAddLembaga']) == 0 || empty($_POST['processAddLembaga']))
      : die();
  endif;
  
  $content->processAddLembaga();
  endif;
  
  /* == Delete Lembaga == */
  if (isset($_POST['deleteLembaga']))
      : if (empty($_POST['deleteLembaga']))
      : die();
  endif;
  
  $id = intval($_POST['deleteLembaga']);

  $res = $db->delete("lembaga", "id=" . $id );
    
  print ($res) ? Filter::msgOk(lang('DEL_OK')) : Filter::msgAlert(lang('NOPROCCESS'));
  endif;
    
  /* == Load LembagaList == */
  if (isset($_POST['loadLembagaList'])):
      if ($_POST['loadLembagaList'] == '' || empty($_POST['loadLembagaList'])):
          die();
      endif;
      
      $propinsi_kode = (string)($_POST['loadLembagaList']);
      if (isset($_POST['kota']))
        $kota_kode = (string)($_POST['kota']);
      else
        $kota_kode = "";
	  	  
      $content->loadLembagaList($propinsi_kode, $kota_kode);
  endif;
    
?>

<?php
  /* == Update Staff == */
  if (isset($_POST['processUpdateStaff']))
      : if (intval($_POST['processUpdateStaff']) == 0 || empty($_POST['processUpdateStaff']))
      : die();
  endif;
  Filter::$id = (isset($_POST['id'])) ? $_POST['id'] : 0; 
  $content->processUpdateStaff();
  endif;

  /* == Add Staff == */
  if (isset($_POST['processAddStaff']))
      : if (intval($_POST['processAddStaff']) == 0 || empty($_POST['processAddStaff']))
      : die();
  endif;

  $content->processAddStaff();
  endif;
  
 
  /* == Delete StaffK == */
  if (isset($_POST['deleteStaff']))
      : if (empty($_POST['deleteStaff']))
      : die();
  endif;
  
  $id = intval($_POST['deleteStaff']);
      
  $res = $db->delete("staff", "id='" . $id . "'");
  
  $db->delete("staff_rdiklat", "staffid='" . $id . "'");
  $db->delete("staff_rjabatan", "staffid='" . $id . "'");
  $db->delete("staff_rpf", "staffid='" . $id . "'");
  $db->delete("staff_rpnf", "staffid='" . $id . "'");
  $db->delete("staff_rkarya", "staffid='" . $id . "'");
  $db->delete("staff_rsertifikat", "staffid='" . $id . "'");
  
  
  print ($res) ? Filter::msgOk(lang('DEL_OK')) : Filter::msgAlert(lang('NOPROCCESS'));
  endif;
  
  /* == Load staff_rpf == */
  if (isset($_POST['loadStaf_RPF'])):
      if (intval($_POST['loadStaf_RPF']) == 0 || empty($_POST['loadStaf_RPF'])):
          die();
      endif;
      $id = intval($_POST['loadStaf_RPF']);
      $content->loadStaf_RPF($id);
  endif;
  
  /* == Process staff_rpnf == */
  if (isset($_POST['processStaff_RPF'])):
      if (intval($_POST['processStaff_RPF']) == 0 || empty($_POST['processStaff_RPF'])):
          die();
      endif;
      Filter::$id = (isset($_POST['id'])) ? $_POST['id'] : 0; 
      $content->processStaff_RPF();
  endif;

  /* == Delete staff_rpf == */
  if (isset($_POST['deleteStaff_RPF'])):
      if (empty($_POST['deleteStaff_RPF'])):
          die();
      endif;
      $id = intval($_POST['deleteStaff_RPF']);
      $res = $db->delete("staff_rpf", "id='" . $id . "'");
      
    print ($res) ? Filter::msgOk('Data Riwayat Pendidikan Formal Staff berhasil dihapus.') : Filter::msgAlert(lang('NOPROCCESS'));
  endif;

  /* == Load staff_rpnf ======================================================= */
  if (isset($_POST['loadStaff_RPNF'])):
      if (intval($_POST['loadStaff_RPNF']) == 0 || empty($_POST['loadStaff_RPNF'])):
          die();
      endif;
      $id = intval($_POST['loadStaff_RPNF']);
      $content->loadStaff_RPNF($id);
  endif;
  
  /* == Process staff_rpnf == */
  if (isset($_POST['processStaff_RPNF'])):
      if (intval($_POST['processStaff_RPNF']) == 0 || empty($_POST['processStaff_RPNF'])):
          die();
      endif;
      Filter::$id = (isset($_POST['id'])) ? $_POST['id'] : 0; 
      $content->processStaff_RPNF();
  endif;
    
  /* == Delete staff_rpnf == */
  if (isset($_POST['deleteStaff_RPNF'])):
      if (empty($_POST['deleteStaff_RPNF'])):
          die();
      endif;
      $id = intval($_POST['deleteStaff_RPNF']);
      $res = $db->delete("staff_rpnf", "id='" . $id . "'");
      
    print ($res) ? Filter::msgOk('Data Riwayat Pendidikan Non-Formal Staff berhasil dihapus.') : Filter::msgAlert(lang('NOPROCCESS'));
  endif;
    
?>


