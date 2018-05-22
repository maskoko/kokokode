<?php
  /**
   * Logout
   *
   * @package SIM PPPPTK BMTI
   * @author a2ngsa
   * @copyright 2012
   * @version $Id: logout.php, v1.00 2011-04-20 10:12:05 gewa Exp $
   */
  define("_VALID_PHP", true);
  
  require_once("init.php");
?>
<?php
  if ($user->logged_in)
      $user->logout();
	  
  redirect_to("../index.php");
?>