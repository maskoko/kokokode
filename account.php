<?php
  /**
   * Account Profile
   *
   * @package SIM PPPPTK BMTI
   * @author a2ng
   * @copyright 2012
   * @version $Id: account.php, v1.00 2011-11-10 10:12:05 gewa Exp $
   */
  define("_VALID_PHP", true);
  require_once("init.php");
  
  if (!$user->logged_in)
      redirect_to("index.php");
?>
<?php include("header.php");?>

<?php if(isset($_GET['msg']) and $_GET['msg'] == 1) Filter::msgAlert('<span>Alert!</span>Selected File does not exist!',0,1);?>
<?php switch(Filter::$do): case "sekolah": ?>
  <?php (file_exists("sekolah.php")) ? include("sekolah.php") : include("main.php");?>
  <?php break;?>
 
  <?php case"ptk":?>
  <?php (file_exists("ptk.php")) ? include("ptk.php") : include("main.php");?>
  <?php break;?>

  <?php case"ptk_edit":?>
  <?php (file_exists("ptk_edit.php")) ? include("ptk_edit.php") : include("main.php");?>
  <?php break;?>

  <?php case"staff_edit":?>
  <?php (file_exists("staff_edit.php")) ? include("staff_edit.php") : include("main.php");?>
  <?php break;?>

  <?php case"sekolah_edit":?>
  <?php (file_exists("sekolah_edit.php")) ? include("sekolah_edit.php") : include("main.php");?>
  <?php break;?>

  <?php case"diklat":?>
  <?php (file_exists("diklat.php")) ? include("diklat.php") : include("main.php");?>
  <?php break;?>

  <?php case"diklat_jadwal":?>
  <?php (file_exists("diklat_jadwal.php")) ? include("diklat_jadwal.php") : include("main.php");?>
  <?php break;?>

  <?php case"diklat_peserta":?>
  <?php (file_exists("diklat_peserta.php")) ? include("diklat_peserta.php") : include("main.php");?>
  <?php break;?>

  <?php case"user_account":?>
  <?php (file_exists("user_account.php")) ? include("user_account.php") : include("main.php");?>
  <?php break;?>

  <?php case"tna":?>
  <?php (file_exists("tna.php")) ? include("tna.php") : include("main.php");?>
  <?php break;?>

  <?php case"chart_ptk_sekolah_peserta":?>
  <?php (file_exists("chart_ptk_sekolah_peserta.php")) ? include("chart_ptk_sekolah_peserta.php") : include("main.php");?>
  <?php break;?>

  <?php case"chart_ptk_ijazah":?>
  <?php (file_exists("chart_ptk_ijazah.php")) ? include("chart_ptk_ijazah.php") : include("main.php");?>
  <?php break;?>

  <?php case"chart_diklat_peserta":?>
  <?php (file_exists("chart_diklat_peserta.php")) ? include("chart_diklat_peserta.php") : include("main.php");?>
  <?php break;?>

  <?php default:?>
  <?php include("main.php");?>
  <?php break;?>
<?php endswitch;?>

<?php include("footer.php");?>