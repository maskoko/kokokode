<?php
  /**
   * User
   *
   * @package SIM PPPPTK BMTI
   * @author a2ngsa
   * @copyright 2012
   * @version $Id: user.php, v2.00 2011-04-20 10:12:05 gewa Exp $
   */
  define("_VALID_PHP", true);
  require_once("../init.php");
?>
<?php
  /* Registration */
  if (isset($_POST['doRegister'])):
      if (intval($_POST['doRegister']) == 0 || empty($_POST['doRegister'])):
          redirect_to("../register.php");
      endif;
      $user->registerPTK();
  endif;
?>
<?php
  /* Password Reset */
  if (isset($_POST['passReset'])):
      if (intval($_POST['passReset']) == 0 || empty($_POST['passReset'])):
          redirect_to("../index.php");
      endif;
      $user->passReset();
  endif;
?>

<?php
  /* Check Username */
  if (isset($_POST['checkUsername'])):

      $username = trim(strtolower($_POST['checkUsername']));
      $username = $db->escape($username);

      $usernamemode = intval($_POST['usernamemode']);
      $nama_lengkap = trim(strtolower($_POST['nama_lengkap']));
	  
	  
      $sql = "SELECT username FROM users WHERE username = '" . $username . "' LIMIT 1";
      $result = $db->query($sql);
      $num = $db->numrows($result);

      print $num;

  endif;
?>

<?php
  /* Check nuptk */
  if (isset($_POST['checknuptk'])):

      $nuptk = trim(strtolower($_POST['checknuptk']));
      $nuptk = $db->escape($nuptk);
	 	  
      $sql = "SELECT pt.id, pt.nama_lengkap,"
             ."\n s.nama_sekolah"
             ."\n FROM ptk AS pt LEFT JOIN sekolah AS s"
             ."\n ON pt.sekolahid = s.id"
             ."\n WHERE pt.nuptk = '" . $nuptk . "' LIMIT 1";
      $result = $db->query($sql);
      $num = $db->numrows($result); 
      
      if ($num == 0) {
        $db->free($result);
        
        print "NUPTK Tidak terdaftar!";
      } else {
       
        $rows = array();
        while ($row = $db->fetch($result, false)) :
              $rows[] = $row;
        endwhile;
        unset($row);
        $db->free($result);
          
        // -- check if already registered --
        
        $sql = "SELECT id FROM users WHERE ptkid = " . $rows[0]->id . " LIMIT 1";
        $result = $db->query($sql);
        $num = $db->numrows($result);
        $db->free($result);          
        
        if ($num == 0)
            print "OK : " . $rows[0]->nama_lengkap . " : " .$rows[0]->nama_sekolah;
        else
            print "PTK sudah memiliki akses Login!";
      }

  endif;
  
  /* Check nip */
  if (isset($_POST['checknip'])):

      $nip = trim(strtolower($_POST['checknip']));
      $nip = $db->escape($nip);
	 	  
      $sql = "SELECT id FROM ptk WHERE nip = '" . $nip . "' LIMIT 1";
      $result = $db->query($sql);
      $num = $db->numrows($result);

      if ($num == 0) {
        $db->free($result);
        
        print "NIP Tidak terdaftar!";
      } else {
       
        $rows = array();
        while ($row = $db->fetch($result, false)) :
              $rows[] = $row;
        endwhile;
        unset($row);
        $db->free($result);
          
        // -- check if already registered --
        
        $sql = "SELECT id FROM users WHERE ptkid = " . $rows[0]->id . " LIMIT 1";
        $result = $db->query($sql);
        $num = $db->numrows($result);
        $db->free($result);          
        
        if ($num == 0) {
            
            $sql = "SELECT pt.nama_lengkap, s.nama_sekolah"
                   ."\n FROM ptk AS pt LEFT JOIN sekolah AS s"
                   ."\n ON pt.sekolahid = s.id"
                   ."\n WHERE pt.id = " . $rows[0]->id . " LIMIT 1";
            $result = $db->query($sql);
            unset ($rows);
            $rows = array();
            while ($row = $db->fetch($result, false)) :
                  $rows[] = $row;
            endwhile;
            unset($row);            
            $db->free($result);          
            
            print "OK : " . $rows[0]->nama_lengkap. ' : ' . $rows[0]->nama_sekolah;
        } else
            print "PTK sudah memiliki akses Login!";
      }

  endif;
  
?>
