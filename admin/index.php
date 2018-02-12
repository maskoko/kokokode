<?php
  /**
   * Index
   *
   * @package SIM PPPPTK BMTI
   * @author a2ngsa
   * @copyright 2012
   * @version $Id: index.php, v1.00 2011-06-05 10:12:05 gewa Exp $
   */
  define("_VALID_PHP", true);

  if (is_dir("../setup"))
      : die("<div style='text-align:center;margin-top:20px'>" 
		  . "<span style='padding: 10px; border: 1px solid #999; background-color:#EFEFEF;" 
		  . "font-family: Verdana; font-size: 12px; margin-left:auto; margin-right:auto;color:red'>" 
		  . "<b>Warning:</b> Silahkan hapus folder 'setup' !</span></div>");
  endif;
    
  require_once("init.php");

  if (!$user->is_Admin())
      //redirect_to("login.php");
      //redirect_to("../account.php");
      : die("<div style='text-align:center;margin-top:20px'>" 
      . "<span style='padding: 10px; border: 1px solid #999; background-color:#EFEFEF;" 
      . "font-family: Verdana; font-size: 12px; margin-left:auto; margin-right:auto;color:red'>" 
      . "<b>Warning:</b> Anda tidak dapat mengakses halaman ini !</span></div>");
  endif;

?>
<?php include("header.php");?>
  <!-- Start Content-->
  <?php 

    if (Filter::$do && file_exists(Filter::$do.".php")) {

      if ($user->is_Admin())
        $moduleid = 1024; // -- all access --
      else {

        $do = Filter::$do;
        if ($do == "sekolah") {
            $moduleid = 5;
            $access = 'R';
        }
        else if ($do == "ptk") {
            $moduleid = 4;
            $access = 'R';
        } else if ($do == "lembaga") {
            $moduleid = 7;
            $access = 'R';
        } else if ($do == "staff") {
            $moduleid = 6;
            $access = 'R';
        } else if (($do == "rujukan_propinsi") || ($do == "rujukan_kota") || ($do == "rujukan_sekolah_jenis") 
            || ($do == "rujukan_departemen") || ($do == "rujukan_bsk") || ($do == "rujukan_psk")|| ($do == "rujukan_kk") 
            || ($do == "rujukan_golongan")) {
            $moduleid = 3;
            $access = 'R';          
        } else if ($do == "diklat") {
            $moduleid = 8;
            $access = 'R';
        } else if ($do == "jadwal") {
            $moduleid = 9;
            $access = 'R';
        } else if ($do == "diklat_calonpeserta") {
            $moduleid = 10;
            $access = 'R';
        } else if ($do == "diklat_peserta") {
            $moduleid = 11;
            $access = 'R';
        } else if (($do == "config") || ($do == "backup") || ($do == "users")) {
            $moduleid = 1;
            $access = 'R';
        } else {
            $moduleid = 0;
            $access = 'R';
        }

        if (!$user->isProfileModuleExists($moduleid, $access))
          $moduleid = 0;

      }

      if ($moduleid > 0)
        include(Filter::$do.".php");
      else
        include("restricted.php");

    } else
      include("main.php");

  ?>
  <!-- End Content/-->
<?php include("footer.php");?>