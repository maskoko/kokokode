<?php
  /**
   * Controller
   *
   * @package SIM PPPPTK BMTI
   * @author a2ngsa
   * @copyright 2012
   * @version $Id: controller_sekolah.php, v1.00 2011-06-05 10:12:05 gewa Exp $
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
    
?>

<?php

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

?>
