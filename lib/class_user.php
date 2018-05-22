<?php
  /**
   * User Class
   *
   * @package SIM PPPPTK BMTI
   * @author a2ngsa
   * @copyright 2012
   * @version $Id: class_user.php, v1.00 2011-06-05 10:12:05 gewa Exp $
   */
  
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');

  class Users
  {
      const uTable = "users";
      const uprofileTable = "user_profiles";
      const uprofilemoduleTable = "user_profilemodules";
	  
      public $logged_in = null;
      public $uid = 0;
      public $userid = 0;
      public $username;
      public $sesid;
      public $email;
      public $name;
      public $profileid;
      public $lastlogin = "NOW()";
	  
      public $usermode = "G";
      public $ptkid = 0;
      public $sekolahid = 0;

      public $profilemodules = array();
      
      
      private static $db;

      /**
       * Users::__construct()
       * 
       * @return
       */
      function __construct()
      {
          self::$db = Registry::get("Database");

          $this->getUserId();
          $this->startSession();
      }

      /**
       * Users::getUserId()
       * 
       * @return
       */
      private function getUserId()
      {
          if (isset($_GET['userid'])) {
              $userid = (is_numeric($_GET['userid']) && $_GET['userid'] > -1) ? intval($_GET['userid']) : false;
              $userid = sanitize($userid);

              if ($userid == false) {
                  Filter::error("You have selected an Invalid Userid", "Users::getUserId()");
              } else
                  return $this->userid = $userid;
          }
      }


      /**
       * Users::startSession()
       * 
       * @return
       */
      private function startSession()
      {
          session_start();
          $this->logged_in = $this->loginCheck();

          if (!$this->logged_in) {
              $this->username = $_SESSION['username'] = "Guest";
              $this->sesid = sha1(session_id());
              $this->profileid = 0;
          }
      }

      /**
       * Users::loginCheck()
       * 
       * @return
       */
      private function loginCheck()
      {
          if (isset($_SESSION['username']) && $_SESSION['username'] != "Guest") {

              $row = $this->getUserInfo($_SESSION['username']);
              $this->uid = $row->id;
              $this->username = $row->username;
              $this->email = $row->email;
              $this->name = $row->username;
              $this->profileid = $row->profileid;
              $this->lastlogin = $row->lastlogin;

              $this->usermode = $row->usermode;
              $this->ptkid = $row->ptkid;
			  
              $this->sesid = sha1(session_id());
			 
              /* -- get user_profilemodules -- */

              $this->updateUser_ProfileModules();
                                                  
              /* --- ptk or staff -- */

              $this->updatePTKInfo();			  
			  
              return true;
          } else {
              return false;
          }
      }

      /**
       * Users::is_Admin()
       * 
       * @return
       */
      public function is_Admin()
      {
          return ($this->usermode == "A");

      }

      /**
       * Users::is_PTK()
       * 
       * @return
       */
      public function is_PTK()
      {
          return ($this->usermode == "P");

      }	  
	  
      /**
       * Users::login()
       * 
       * @param mixed $username
       * @param mixed $password
       * @return
       */
      public function login($username, $password)
      {
          if ($username == "" && $password == "") {
              Filter::$msgs['username'] = lang('LOGIN_R5');
          } else {
              $status = $this->checkStatus($username, $password);
			  
              switch ($status) {
                  case 0:
                      Filter::$msgs['username'] = lang('LOGIN_R1');
                      break;

                  case 1:
                      Filter::$msgs['username'] = lang('LOGIN_R2');
                      break;

                  case 2:
                      Filter::$msgs['username'] = lang('LOGIN_R3');
                      break;

                  case 3:
                      Filter::$msgs['username'] = lang('LOGIN_R4');
                      break;
              }
          }
          if (empty(Filter::$msgs) && $status == 5) {
              $row = $this->getUserInfo($username);
              $this->uid = $_SESSION['userid'] = $row->id;
              $this->username = $_SESSION['username'] = $row->username;
              $this->email = $_SESSION['email'] = $row->email;
              $this->profileid = $_SESSION['profileid'] = $row->profileid;
              $this->lastlogin = $_SESSION['lastlogin'] = $row->lastlogin;

              $this->usermode = $_SESSION['usermode'] = $row->usermode;
			  
              $data = array('lastlogin' => 'NOW()', 'lastip' => sanitize($_SERVER['REMOTE_ADDR']));
              self::$db->update(self::uTable, $data, "username='" . $this->username . "'");

              /* -- get user_profilemodules -- */
              
              $this->updateUser_ProfileModules();
              
              /* --- ptk -- */

              if ($this->usermode == 'P')
                $this->updatePTKInfo();
			  
              return true;
          } else
              Filter::msgStatus();
      }

      /**
       * Users::logout()
       * 
       * @return
       */
      public function logout()
      {
          unset($_SESSION['username']);
          unset($_SESSION['email']);
          unset($_SESSION['name']);
          unset($_SESSION['userid']);
          unset($_SESSION['uid']);

          unset($_SESSION['ptkid']);
          unset($_SESSION['sekolahid']);

		  
          session_destroy();
          session_regenerate_id();

          $this->logged_in = false;
          $this->username = "Guest";
          $this->profileid = 0;
      }

      /**
       * Users::forgotPasswd()
       * 
       * @param mixed $email
       * @return
       */
      public function forgotPasswd($email)
      {

          if ($email == "")
              Filter::$msgs['email'] = "Silahkan isi E-Mail!";
          else {            
              $row = $this->getUserInfoByEmail($email);  
              if (!$row)
                  Filter::$msgs['email'] = "E-Mail tidak ditemukan!";
              else {

                  // -- check if already exists in user_token --

                  $tokenrow = $this->getUser_TokenByEmail($email);                  
                  if ($tokenrow) {
                      if ($tokenrow->executed != "0000-00-00 00:00:00")
                        Filter::$msgs['email'] = "E-Mail sedang dalam proses, silahkan periksa kotak E-Mail anda!";
                  }

              }              
          }
                    
          if (empty(Filter::$msgs)) {

              // -- insert record --
         
              $tokendata = array(
                'userid' => $row->id, 
                'tokenkey' => $this->getUniqueCode(100),
                'created' => 'NOW()',
                'ip' => sanitize($_SERVER['REMOTE_ADDR'])
              );
                
              self::$db->insert("user_token", $tokendata);

              // -- send email --

              require_once (BASEPATH . "lib/class_mailer.php");
              $mailer = $mail->sendMail();
              $subject = "Konfirmasi Reset Password akses PPPPTK BMTI Bandung";

              ob_start();
              require_once (BASEPATH . 'mailer/forgotpassword.tpl.php');
              $html_message = ob_get_contents();
              ob_end_clean();

              $msg = Swift_Message::newInstance()
                ->setSubject($subject)
                ->setTo(array($email => $row->username))
                //->setFrom(array(Registry::get("Core")->site_email => Registry::get("Core")->company))
                ->setFrom(array("noreply@tedcbandung.com" => Registry::get("Core")->company))
                ->setBody($html_message, 'text/html');

              $numSent = $mailer->send($msg);

              redirect_to("forgotpassword.php?userid=" . $row->id . "&sent=1");

          }
          else
            Filter::msgStatus();

      }


    /**
       * Users::processForgotPasswd()
       * 
       * @param mixed $key, $newpasswd
       * @return
       */
      public function processForgotPasswd($key, $newpasswd, $retypenewpasswd)
      {

          if ($key == "")
              Filter::$msgs['tokenkey'] = "Token tidak valid!";
          else {
              $row = $this->getUser_Token($key);
              if (!$row)
                  Filter::$msgs['tokenkey'] = "Token tidak valid!";
          }

          if ($newpasswd == "")
              Filter::$msgs['newpasswd'] = "Password baru masih kosong!";
          else {
              if ($newpasswd != $retypenewpasswd)
                Filter::$msgs['newpasswd'] = "Password tidak sama dengan yang diketik ulang!";
              else {
                if (strlen($newpasswd) < 6)
                  Filter::$msgs['newpasswd'] = "Password kurang dari 6 karakter!";
              }
          }
                    
          if (empty(Filter::$msgs)) {

              // -- set new password --

              $userdata = array('password' => sha1($newpasswd),
                'last_update' => 'NOW()',
                'lastip' => sanitize($_SERVER['REMOTE_ADDR']));
              self::$db->update("users", $userdata, "id=" . $row->userid);

              // -- update user_token --
                
              $tokendata = array('executed' => 'NOW()');
              self::$db->update("user_token", $tokendata, "tokenkey='" . $key . "'");

              redirect_to("forgotpassword.php?tokenkey=" . $key . "&executed=1");

          }
          else
            Filter::msgStatus();

      }


      /**
       * Users::getUserInfo()
       * 
       * @param mixed $username
       * @return
       */
      public function getUserInfo($username)
      {
          $username = sanitize($username);
          $username = self::$db->escape($username);

          $sql = "SELECT u.*, "
                ."\n upr.usermode"
                ."\n FROM " . self::uTable ." as u"
                ."\n LEFT JOIN " . self::uprofileTable . " as upr ON u.profileid = upr.id"
                ."\n WHERE u.username = '" . $username . "'";


          // $sql = "SELECT u.*, upr.* FROM " . self::uTable ." AS u  "
          //       ."\n LEFT JOIN ("
          //       ."\n SELECT upro.*, uprom.* FROM " . self::uprofileTable . " AS upro LEFT JOIN  " . self::uprofilemodulesTable . " AS uprom" 
          //       ."\nON upro.id = uprom.profileid) AS upr"
          //       ."\n ON u.`profileid` = upr.profileid"
          //       ."\n WHERE u.username = '" . $username . "'";

						
          $row = self::$db->first($sql);
          if (!$username)
              return false;

          return ($row) ? $row : 0;
      }

      /**
       * Users::getUserInfoByEmail()
       * 
       * @param mixed $email
       * @return
       */
      public function getUserInfoByEmail($email)
      {
          $email = sanitize($email);
          $email = self::$db->escape($email);

          $sql = "SELECT *"
                ."\n FROM " . self::uTable
                ."\n WHERE email = '" . $email . "'";

          $row = self::$db->first($sql);
          return ($row) ? $row : 0;
      }

      /**
       * Users::getUser_Token()
       * 
       * @param mixed $key
       * @return
       */
      public function getUser_Token($key)
      {
          $sql = "SELECT *"
                ."\n FROM user_token"
                ."\n WHERE tokenkey = '" . $key . "'";

          $row = self::$db->first($sql);
          return ($row) ? $row : 0;
      }

      /**
       * Users::getUser_TokenActive()
       * 
       * @param mixed $key
       * @return
       */
      public function getUser_TokenActive($key)
      {
          $row = $this->getUser_Token($key);
          if ($row) {
            if ($row->executed != "0000-00-00 00:00:00")
              return false;
            else
              return true;
          } else 
            return false; 
      }

      /**
       * Users::getUser_TokenByEmail()
       * 
       * @param mixed $email
       * @return
       */
      public function getUser_TokenByEmail($email)
      {
          $sql = "SELECT ut.*"
                ."\n FROM user_token ut LEFT JOIN users u ON ut.userid=u.id"
                ."\n WHERE u.email = '" . $email . "'";

          $row = self::$db->first($sql);
          return ($row) ? $row : 0;
      }

      /**
       * Users::getUserList()
       * 
       * @param mixed $profileid
       * @return
       */
      public function getUserList($profileid)
      {
            if ($profileid != 0 )
                $sql = "SELECT id, username as name, email  FROM " . self::uTable . " WHERE profileid = '" . $profileid . "'";
            else
                $sql = "SELECT id, username as name, email  FROM " . self::uTable;
		   
            $row = self::$db->fetch_all($sql);

            return ($row) ? $row : 0;
      }

      /**
       * Users::checkStatus()
       * 
       * @param mixed $username
       * @param mixed $password
       * @return
       */
      public function checkStatus($username, $password)
      {

          $username = sanitize($username);
          $username = self::$db->escape($username);
          $password = sanitize($password);
		  
          $sql = "SELECT password, active FROM " . self::uTable . " WHERE username = '" . $username . "'";
          $result = self::$db->query($sql);

          if (self::$db->numrows($result) == 0)
              return 0;

          $row = self::$db->fetch($result);
          $entered_pass = sha1($password);

          switch ($row->active) {
              case "b":
                  return 1;
                  break;

              case "n":
                  return 2;
                  break;

              case "t":
                  return 3;
                  break;

              case "y" && $entered_pass == $row->password:
                  return 5;
                  break;
          }
      }


      /**
       * Content::getUser_ProfileList()
       * 
       * @return
       */
      public function getUser_ProfileList()
      {
          $sql = "SELECT *"
                    ."\n FROM ".self::uprofileTable
                    ."\n ORDER BY profilename";
				 
          $row = self::$db->fetch_all($sql);

          return ($row) ? $row : 0;
      }
	  

      /**
       * Users::getUser_Profiles()
       * 
       * @return
       */
      public function getUser_Profiles()
      {
		  
          $pager = Paginator::instance();
          $pager->items_total = countEntries(self::uprofileTable);
          $pager->default_ipp = Registry::get("Core")->perpage;
          $pager->paginate();
		  		  
          $sql = "SELECT *"
		   ."\n FROM ".self::uprofileTable
		   ."\n ORDER BY profilename". $pager->limit;
		   
          $row = self::$db->fetch_all($sql);

          return ($row) ? $row : 0;
      }

      /**
       * Users::getUser_ProfileModules()
       * 
       * @return
       */
      public function getUser_ProfileModules($profileid)
      {		  		  		  
          $sql = "SELECT *"
		   ."\n FROM user_profilemodules"
		   ."\n WHERE profileid = " . $profileid
		   ."\n ORDER BY moduleid";
		   
          $row = self::$db->fetch_all($sql);

          return ($row) ? $row : 0;
      }
      
      
	  /**
	   * Content::User_ProfileUserModeList()
	   * 
	   * @param string $selected
	   * @return
	   */
	  public function User_ProfileUserModeList($selected = '')
	  {
	      $arr = array('A' => 'A : Administrator / Staff', 'P' => 'P : GTK');

		  $list = '';
		  foreach ($arr as $key => $val) {
			  $sel = ($key == $selected) ? ' selected="selected"' : '';
			  $list .= "<option value=\"" . $key . "\"" . $sel . ">" . $val . "</option>\n";
		  }
		  unset($val);
		  return $list;
	  }
	  
	  
      /**
       * Users::processUser_Profile()
       * 
       * @return
       */
      public function processUser_Profile()
      { 
          if (!Filter::$id) {
              if (empty($_POST['profilename']))
                  Filter::$msgs['profilename'] = 'Nama Profile masih kosong!';

              if ($value = $this->profilenameExists($_POST['profilename'])) {
                  if ($value == 1)
                      Filter::$msgs['profilename'] = lang('PROFILENAME_R2');
                  if ($value == 2)
                      Filter::$msgs['profilename'] = lang('PROFILENAME_R3');
                  if ($value == 3)
                      Filter::$msgs['profilename'] = lang('PROFILENAME_R4');
              }
          }
		
          if (empty(Filter::$msgs)) {

              $data = array(
                            'profilename' => sanitize($_POST['profilename']), 
                            'usermode' => sanitize($_POST['usermode']), 
                            'module_access' => intval($_POST['module_access']), 
                            'function_access' => intval($_POST['function_access']), 
                            'last_update' => 'NOW()' 
			     );
			  	
              if (!Filter::$id)
                  $data['created'] = "NOW()";


              if (Filter::$id) {
                  $profileid = Filter::$id;
                  self::$db->update(self::uprofileTable, $data, "id='" . Filter::$id . "'");
              } else {
                  $profileid = self::$db->insert(self::uprofileTable, $data);
              }


              $message = (Filter::$id) ? lang('DATA_UPDATED') : lang('DATA_ADDED');

              $rowsaffected = self::$db->affected();
              
              // -- process user_profilemodules --
              
              if ($profileid != 1) {
              
                $access = array();

                foreach ($_POST['moduleid'] as $key => $val) {
                    $moduleid = $val;//intval($_POST['moduleid'][$key]);
                    $access[$moduleid] = '';                                                      
                }
                  unset($key);
                  unset($val);


                    if (!empty($_POST['cU'])) {
                        foreach ($_POST['cU'] as $key => $val) {
                            if (array_key_exists($val, $access)) {
                               if ($access[$val] == '')
                                  $access[$val] .= 'C';
                               else
                                  $access[$val] .= ',C';    
                            }
                        }
                        unset ($key);
                        unset ($val);                                                                 
                    }

                    if (!empty($_POST['cR'])) {
                        foreach ($_POST['cR'] as $key => $val) {
                            if (array_key_exists($val, $access)) {
                               if ($access[$val] == '')
                                  $access[$val] .= 'R';
                               else
                                  $access[$val] .= ',R';    
                            }
                        }
                        unset ($key);
                        unset ($val);                                                                 
                    }

                    if (!empty($_POST['cU'])) {
                        foreach ($_POST['cU'] as $key => $val) {
                            if (array_key_exists($val, $access)) {
                               if ($access[$val] == '')
                                  $access[$val] .= 'U';
                               else
                                  $access[$val] .= ',U';    
                            }
                        }
                        unset ($key);
                        unset ($val);                                                                 
                    }

                    if (!empty($_POST['cU'])) {
                        foreach ($_POST['cU'] as $key => $val) {
                            if (array_key_exists($val, $access)) {
                               if ($access[$val] == '')
                                  $access[$val] .= 'D';
                               else
                                  $access[$val] .= ',D';    
                            }
                        }
                        unset ($key);
                        unset ($val);                                                                 
                    }

                    if (!empty($_POST['cL'])) {
                        foreach ($_POST['cL'] as $key => $val) {
                            if (array_key_exists($val, $access)) {
                               if ($access[$val] == '')
                                  $access[$val] .= 'L';
                               else
                                  $access[$val] .= ',L';    
                            }
                        }
                        unset ($key);
                        unset ($val);                                                                 
                    }


                // -- delete previous --    

                self::$db->delete("user_profilemodules", "profileid='" . $profileid . "'");

               // -- create new --     

                foreach ($access as $key => $val) {
                    if ($val != '') {

                      $edata = array('profileid' => $profileid,
                                'moduleid' => $key,
                                'accesslist' => $val);

                      self::$db->insert("user_profilemodules", $edata);                       
                    }

                }                

              }
                  
              if ($rowsaffected) {
                  Filter::msgOk($message);
              } else
                  Filter::msgAlert(lang('NOPROCCESS'));
          } else
              print Filter::msgStatus();
      }
	  	  
	  
      /**
       * Users::getUsers()
       * 
       * @return
       */
      public function getUsers()
      {

          if (isset($_GET['profileid']))
              $profileid = intval($_GET['profileid']);
          else
              $profileid = 0;

          if (isset($_GET['searchfield']))
              $searchfield = strtolower(sanitize($_GET['searchfield']));
          else
              $searchfield = '';

          if (isset($_GET['searchtext']))
              $searchtext = strtolower(sanitize($_GET['searchtext']));
          else
              $searchtext = '';

          if ($profileid != 0) {

                  $q = "SELECT count(*) FROM " . self::uTable . " WHERE profileid = " . $profileid;
                  $sqlwhere = "WHERE u.profileid = " . $profileid;

                  if (($searchtext != '') && ($searchfield != '')) {
                      $q .= " AND LOWER(" . $searchfield .") LIKE '%". $searchtext ."%'";
                      $sqlwhere .= " AND LOWER(" . $searchfield .") LIKE '%". $searchtext ."%'";
                  }

          } else {

                  $q = "SELECT count(*) FROM " . self::uTable;

                  if (($searchtext != '') && ($searchfield != '')) {
                      $q .= " WHERE LOWER(" . $searchfield .") LIKE '%". $searchtext ."%'";
                      $sqlwhere = "WHERE LOWER(" . $searchfield .") LIKE '%". $searchtext ."%'";
                  } else
                      $sqlwhere = "";

          }

          $record = Registry::get("Database")->query($q);
          $total = Registry::get("Database")->fetchrow($record);
          $counter = $total[0];

          $pager = Paginator::instance();
          $pager->items_total = $counter;
          $pager->default_ipp = Registry::get("Core")->perpage;
          $pager->paginate();

          $sql = "SELECT u.*,"
		    ."\n p.profilename, p.usermode"
		    ."\n FROM " . self::uTable . " as u"
		    ."\n LEFT JOIN ".self::uprofileTable." as p ON u.profileid = p.id"
            ."\n $sqlwhere"
            ."\n ORDER BY u.created". $pager->limit;
		   
          $row = self::$db->fetch_all($sql);

          return ($row) ? $row : 0;
      }
	  
      /**
       * Users::processUser()
       * 
       * @return
       */
      public function processUser()
      { 
          if (!Filter::$id) {
              if (empty($_POST['username']))
                  Filter::$msgs['username'] = lang('USERNAME_R1');

              if ($value = $this->usernameExists($_POST['username'])) {
                  if ($value == 1)
                      Filter::$msgs['username'] = lang('USERNAME_R2');
                  if ($value == 2)
                      Filter::$msgs['username'] = lang('USERNAME_R3');
                  if ($value == 3)
                      Filter::$msgs['username'] = lang('USERNAME_R4');
              }
          }

		/*
          if (empty($_POST['fname']))
              Filter::$msgs['fname'] = lang('FNAME_R');

          if (empty($_POST['lname']))
              Filter::$msgs['lname'] = lang('LNAME_R');

			 */
			  
          if (!Filter::$id) {
              if (empty($_POST['password']))
                  Filter::$msgs['password'] = lang('PASSWORD_R1');
          }

          if (empty($_POST['email']))
              Filter::$msgs['email'] = lang('EMAIL_R1');
          if (!Filter::$id) {
              if ($this->emailExists($_POST['email']))
                  Filter::$msgs['email'] = lang('EMAIL_R2');
          }
          if (!$this->isValidEmail($_POST['email']))
              Filter::$msgs['email'] = lang('EMAIL_R3');

          if (empty(Filter::$msgs)) {

              $data = array(
					'username' => sanitize($_POST['username']), 
					'email' => sanitize($_POST['email']), 
					//'lname' => sanitize($_POST['lname']), 
					//'fname' => sanitize($_POST['fname']), 
					//'company' => isset($_POST['company']) ? sanitize($_POST['company']) : 'NULL', 
					//'address' => sanitize($_POST['address']),
					//'city' => sanitize($_POST['city']), 
					//'state' => sanitize($_POST['state']), 
					//'country' => sanitize($_POST['country']),
					//'zip' => sanitize($_POST['zip']), 
					'profileid' => intval($_POST['profileid']), 
					'last_update' => 'NOW()', 
					'created' => sanitize($_POST['created']), 
					'active' => 'y'
			  );

            if (!empty($_POST['ptkid'])) {
                if (intval($_POST['ptkid']) > 0)
                    $data['ptkid'] = intval($_POST['ptkid']);
            }
              
              
              if (!Filter::$id)
                  $data['created'] = "NOW()";

              if (Filter::$id)
                  $userrow = Registry::get("Core")->getRowById(self::uTable, Filter::$id);

              if ($_POST['password'] != "") {
                  $data['password'] = sha1($_POST['password']);
              } else
                  $data['password'] = $userrow->password;

              (Filter::$id) ? self::$db->update(self::uTable, $data, "id='" . Filter::$id . "'") : self::$db->insert(self::uTable, $data);
              $message = (Filter::$id) ? lang('DATA_UPDATED') : lang('DATA_ADDED');

              if (self::$db->affected()) {
                  Filter::msgOk($message);
				  
				  /*
                  if (isset($_POST['notify']) && intval($_POST['notify']) == 1) {
                      require_once (BASEPATH . "lib/class_mailer.php");
					  $pass = sanitize($_POST['password']);
                      $mailer = $mail->sendMail();
                      $subject = 'Account Activation : ' . $data['username'];

                      ob_start();
                      require_once (BASEPATH . 'mailer/Member_Welcome_Message.tpl.php');
                      $html_message = ob_get_contents();
                      ob_end_clean();

                      $msg = Swift_Message::newInstance()
							  ->setSubject($subject)
							  ->setTo(array($data['email'] => $data['fname'] . ' ' . $data['lname']))
							  ->setFrom(array(Registry::get("Core")->site_email => Registry::get("Core")->company))
							  ->setBody($html_message, 'text/html');

                      $numSent = $mailer->send($msg);
					  
                  } */
              } else
                  Filter::msgAlert(lang('NOPROCCESS'));
          } else
              print Filter::msgStatus();
      }

      /**
       * Users::updateProfile()
       * 
       * @return
       */
      public function updateProfile()
      {

          if (empty($_POST['email']))
              Filter::$msgs['email'] = lang('EMAIL_R1');

          if (!$this->isValidEmail($_POST['email']))
              Filter::$msgs['email'] = lang('EMAIL_R3');

          if (empty(Filter::$msgs)) {

              $data = array(
					'email' => sanitize($_POST['email'])
					//'lname' => sanitize($_POST['lname']), 
					//'fname' => sanitize($_POST['fname']), 
					//'company' => sanitize($_POST['company']), 
					//'address' => sanitize($_POST['address']), 
					//'city' => sanitize($_POST['city']), 
					//'state' => sanitize($_POST['state']), 
					//'country' => sanitize($_POST['country']),
					//'zip' => sanitize($_POST['zip']), 
					//'phone' => sanitize($_POST['phone'])
			  );
			  
              $userpass = getValue("password", self::uTable, "id = '" . $this->uid . "'");

              if ($_POST['password'] != "") {
                  $data['password'] = sha1($_POST['password']);
              } else
                  $data['password'] = $userpass;

              self::$db->update(self::uTable, $data, "id='" . $this->uid . "'");

              (self::$db->affected()) ? Filter::msgOk('Data Login User berhasil diupdate.') : Filter::msgAlert(lang('NOPROCCESS'));
          } else
              print Filter::msgStatus();
      }

      /**
       * Users::register()
       * 
       * @return
       */
      public function register()
      {
          if (empty($_POST['username']))
              Filter::$msgs['username'] = lang('USERNAME_R1');

          if ($value = $this->usernameExists($_POST['username'])) {
              if ($value == 1)
                  Filter::$msgs['username'] = 'Username minimal 4 karakter!';
              if ($value == 2)
                  Filter::$msgs['username'] = 'Ada karakter invalid pada Username!';
              if ($value == 3)
                  Filter::$msgs['username'] = 'Username sudah terdaftar!';
          }

		  /*
          if (empty($_POST['fname']))
              Filter::$msgs['fname'] = lang('FNAME_R');

          if (empty($_POST['lname']))
              Filter::$msgs['lname'] = lang('LNAME_R');
		*/
          if (empty($_POST['password']))
              Filter::$msgs['pass'] = 'Password masih kosong!';

          if (strlen($_POST['password']) < 6)
              Filter::$msgs['pass'] = 'Password minimal 6 karakter!';
          elseif (!preg_match("/^([0-9a-z])+$/i", ($_POST['password'] = trim($_POST['password']))))
              Filter::$msgs['pass'] = 'Password harus karakter alfanumerik!';
          elseif ($_POST['password'] != $_POST['password2'])
              Filter::$msgs['pass'] = 'Password tidak sama dengan yang diulangi!';

          if (empty($_POST['nama_lengkap']))
              Filter::$msgs['nama_lengkap'] = 'Nama Lengkap belum diisi!';
			  			  
          if (!empty($_POST['email'])) {
            if (!$this->isValidEmail($_POST['email']))
                Filter::$msgs['email'] = 'Alamat E-Mail tidak valid!';
            else {
                if ($this->emailExists($_POST['email']))
                    Filter::$msgs['email'] = 'Alamat E-Mail sudah terdaftar!';
            }              
          }

          if (empty($_POST['captcha']))
              Filter::$msgs['captcha'] = 'Kode Verifikasi tidak diisi!';
			  
          if ($_SESSION['captchacode'] != $_POST['captcha'])
              Filter::$msgs['captcha'] = 'Kode Verifikasi tidak cocok!';
			  			  
          if (empty(Filter::$msgs)) {

              $pass = sanitize($_POST['password']);
              $profileid = $this->getDefaultPTKProfileid();
			  
              $data = array(
                            'username' => sanitize($_POST['username']), 
                            'password' => sha1($_POST['password']), 
                            'ptkid' => $ptkid, 
                            'profileid' => $profileid, 
                            'email' => sanitize($_POST['email']), 
                            //'fname' => sanitize($_POST['fname']), 
                            //'lname' => sanitize($_POST['lname']), 
                            //'company' => sanitize($_POST['company']), 
                            //'address' => sanitize($_POST['address']),
                            //'city' => sanitize($_POST['city']), 
                            //'state' => sanitize($_POST['state']), 
                            //'country' => sanitize($_POST['country']),
                            //'zip' => sanitize($_POST['zip']), 
                            //'phone' => sanitize($_POST['phone']), 
                            'last_update' => 'NOW()', 
                            'active' => 'y', 
                            'created' => "NOW()"
			  );
			  
              self::$db->insert(self::uTable, $data);
              (self::$db->affected()) ? print "OK" : Filter::msgError('<span>Error!</span>Registrasi ulang tidak berhasil. Silahkan kontak Administrator.', false);

			  /*
              require_once (BASEPATH . "lib/class_mailer.php");
              $mailer = $mail->sendMail();
              $subject = lang('REG_ESUBJECT') . Registry::get("Core")->company;

              ob_start();
              require_once (BASEPATH . 'mailer/User_Welcome_Message.tpl.php');
              $html_message = ob_get_contents();
              ob_end_clean();

              $msg = Swift_Message::newInstance()
					->setSubject($subject)
					->setTo(array($data['email'] => $data['username'] ))
					->setFrom(array(Registry::get("Core")->site_email => Registry::get("Core")->company))
					->setBody($html_message, 'text/html');

              $mailer->send($msg); */

          } else
              print Filter::msgStatus();
      }

      /**
       * Users::registerPTK()
       * 
       * @return
       */
      public function registerPTK()
      {
            $nuptk = null;
            $nip = null;
            
            if (empty($_POST['nuptk']))
                Filter::$msgs['nuptk'] = 'NUPTK masih kosong!';
            else {

                // -- check user : nuptk --

                $nuptk = sanitize($_POST['nuptk']);
                if (strlen(self::$db->escape($nuptk)) != 16)
                    Filter::$msgs['nuptk'] = 'NUPTK harus 16 digit!';

                if (empty(Filter::$msgs)) {
                    if ($value = $this->usernameExists($nuptk)) {
                        if ($value == 2)
                            Filter::$msgs['nuptk'] = 'NUPTK terdapat karakter yang invalid!';
                        if ($value == 3)
                            Filter::$msgs['nuptk'] = 'NUPTK sudah terdaftar pada database User!';
                    }
                    
                    // -- umode --
                    
                    if (empty(Filter::$msgs)) { 

                        if (!empty($_POST['umode']))
                          $umode = intval($_POST['umode']);
                        else {
                          if (!empty($_POST['nuptk']))
                            $umode = 1;
                          else
                            $umode = 2;
                        }

                        if ($umode == 1) {
                            
                            // -- check PTK exists --
                           
                            $ptkid = $this->getPTKidByNUPTK($nuptk);
                            if ($ptkid) {
                                
                                // -- validate data 'nama_lengkap' dan 'nip' ??? --
                                
                                $res_ptk = $this->validatePTK($ptkid, $nuptk, 
                                        sanitize($_POST['nip']),
                                        sanitize($_POST['nama_lengkap']),
                                        sanitize($_POST['email']));
                                
                                if (!$res_ptk)
                                    Filter::$msgs['nuptk'] = 'Data NUPTK, NIP, Nama dan E-Mail tidak sesuai dengan data kami!';
                                
                            } else {
                                
                                // -- validate data kelengkapan data lain ??? --
                                
                                if (empty($_POST['nama_lengkap']))
                                    Filter::$msgs['nama_lengkap'] = 'Nama Lengkap masih kosong!';
                            }
                                                            
                        } else { 
                            
                            // -- username by 'nip', ... nip MUST NOT EMPTY!!!
                            
                            if (empty($_POST['nip']))
                                Filter::$msgs['nip'] = 'NIP masih kosong!';
                            else {

                                // -- check nuptk --

                                $nip = sanitize($_POST['nip']);
                                if (strlen(self::$db->escape($nip)) != 18)
                                    Filter::$msgs['nip'] = 'NIP harus 18 digit!';

                                if (empty(Filter::$msgs)) {
                                    if ($value = $this->usernameExists($nip)) {
                                        if ($value == 2)
                                            Filter::$msgs['nuptk'] = 'NIP terdapat karakter yang invalid!';
                                        if ($value == 3)
                                            Filter::$msgs['nuptk'] = 'NIP sudah terdaftar pada database User!';
                                    }
                                    
                                    // -- can i continue with 'nip' --
                                    
                                    if (empty(Filter::$msgs)) { 
                                     
                                        // -- check PTK exists --
                                        
                                        $ptkid = $this->getPTKidByNIP($nip);
                                        if ($ptkid) {

                                            // -- validate data 'nama_lengkap' dan 'nip' ??? --

                                            $res_ptk = $this->validatePTK($ptkid, $nuptk, 
                                                    sanitize($_POST['nip']), // -- nip kosong,
                                                    sanitize($_POST['nama_lengkap']),
                                                    sanitize($_POST['email']));

                                            if (!$res_ptk)
                                                Filter::$msgs['nuptk'] = 'Data NUPTK, NIP, Nama dan E-Mail tidak sesuai dengan data kami!';                                            
                                            
                                        } else {

                                            // -- validate data kelengkapan data lain ??? --

                                            if (empty($_POST['nuptk']))
                                                Filter::$msgs['nuptk'] = 'NUPTK masih kosong!';

                                            if (empty($_POST['nama_lengkap']))
                                                Filter::$msgs['nama_lengkap'] = 'Nama Lengkap masih kosong!';
                                            
                                        }
                                        
                                        
                                    } // -- end .checking usernameExists nip
                                    
                                } // -- end .checking nip 18 digit
                                                                
                            } // -- end .checking nip not empty
                            
                        } // -- end .if umode <> 1
                        
                    }  // -- end .checking usernameExists nuptk
                    
                } // -- end .checking nuptk 16 digit
                
            } // -- end .checking nuptk not empty

                
          if (empty($_POST['password']))
              $this->msgs['pass'] = 'Password masih kosong!';

          if (strlen($_POST['password']) < 6)
              Filter::$msgs['pass'] = 'Password minimal 6 karakter!';
          elseif (!preg_match("/^([0-9a-z])+$/i", ($_POST['password'] = trim($_POST['password']))))
              Filter::$msgs['pass'] = 'Password tidak valid!';
          elseif ($_POST['password'] != $_POST['password2'])
              Filter::$msgs['pass'] = 'Password tidak sesuai dengan yang diulangi!';

          if (empty($_POST['nama_lengkap']))
              Filter::$msgs['nama_lengkap'] = 'Nama Lengkap belum diisi.';
		
          // -- email CAN BLANK !!! --
          
          if (!empty($_POST['email'])) {
              
            if (!$this->isValidEmail($_POST['email']))
                Filter::$msgs['email'] = 'Alamat E-Mail tidak valid!';
            else {
                if ($this->emailExists($_POST['email']))
                    Filter::$msgs['email'] = 'E-Mail sudah terdaftar pada user lain!';                
            }

          }
              
          if (empty($_POST['captcha']))
              Filter::$msgs['captcha'] = 'Kode Verifikasi tidak diisi!';
			  
          if ($_SESSION['captchacode'] != $_POST['captcha'])
              Filter::$msgs['captcha'] = 'Kode Verifikasi tidak cocok!';
			  			  
          if (empty(Filter::$msgs)) {

              $pass = sanitize($_POST['password']);
              $profileid = $this->getDefaultPTKProfileid();
              ($nuptk) ? $username = $nuptk : $username = $nip;
		
              /* -- create PTK -- */
              
              if (!$ptkid) {
                  
                    $ptkdata = array(
                                        'nuptk' => sanitize($_POST['nuptk']), 
                                        'nip' => sanitize($_POST['nip']), 
                                        'nama_lengkap' => sanitize($_POST['nama_lengkap']), 
                                        'email' => sanitize($_POST['email']),                         
                        
                                        'tgl_lahir' => null,
                                        'tmt_pns' => null,
                                        'tmt_pendidik' => null,
                                        'tmt_sekolah' => null,
                                        'tmt_kepalasekolah' => null,
                        
                                        'source_name' => 'SIM', 
                                        'last_update' => 'NOW()', 
                                        'created' => "NOW()",
                                        'userid' => 1
                                );

                    if (!empty($_POST['sekolahid']))
                        $ptkdata['sekolahid'] = intval($_POST['sekolahid']);

                    $ptkid = self::$db->insert('ptk', $ptkdata);
                    if (self::$db->affected()) {
                        //$msg = "Data PTK berhasil diproses.";

                        /* -- create user -- */
                        
                        $data = array(
                                        'username' => $username, 
                                        'password' => sha1($_POST['password']), 
                                        'ptkid' => $ptkid, 
                                        'profileid' => $profileid, 
                                        'email' => sanitize($_POST['email']), 
                                        'last_update' => 'NOW()', 
                                        'active' => 'y', 
                                        'created' => "NOW()"
                                    );

                        self::$db->insert(self::uTable, $data);
                        if (self::$db->affected()) {
                            //$msg .= " User berhasil diproses.";
                            print 'OK';                            
                        } else
                            Filter::msgError('User tidak berhasil diproses!', false);
                        
                    } else
                        Filter::msgError('Data PTK tidak berhasil diproses!', false);
                  
              } else {
                    /* -- create user only -- */
                  
                    $data = array(
                                    'username' => $username, 
                                    'password' => sha1($_POST['password']), 
                                    'ptkid' => $ptkid, 
                                    'profileid' => $profileid, 
                                    'email' => sanitize($_POST['email']), 
                                    'last_update' => 'NOW()', 
                                    'active' => 'y', 
                                    'created' => "NOW()"
                                );

                    self::$db->insert(self::uTable, $data);
                    (self::$db->affected()) ? print 'OK' : Filter::msgError('Data GTK tidak berhasil diproses! Silahkan kontak Administrator.', false);                        
                  
              }
              
			  /*
              require_once (BASEPATH . "lib/class_mailer.php");
              $mailer = $mail->sendMail();
              $subject = lang('REG_ESUBJECT') . Registry::get("Core")->company;

              ob_start();
              require_once (BASEPATH . 'mailer/PTK_Welcome_Message.tpl.php');
              $html_message = ob_get_contents();
              ob_end_clean();

              $msg = Swift_Message::newInstance()
					->setSubject($subject)
					->setTo(array($data['email'] => $data['username'] ))
					->setFrom(array(Registry::get("Core")->site_email => Registry::get("Core")->company))
					->setBody($html_message, 'text/html');

              $mailer->send($msg); */

          } else
              print Filter::msgStatus();
      }
            
      /**
       * Users::passReset()
       * 
       * @return
       */
      public function passReset()
      {
          if (empty($_POST['username']))
              Filter::$msgs['username'] = lang('USERNAME_R1');

          $uname = $this->usernameExists($_POST['username']);
          if (strlen($_POST['username']) < 4 || strlen($_POST['username']) > 30 || !preg_match("/^([0-9a-z])+$/i", $_POST['username']) || $uname != 3)
              Filter::$msgs['username'] = lang('USERNAME_R5');

          /* if (empty($_POST['email']))
              Filter::$msgs['email'] = lang('EMAIL_R1'); 

          if (!$this->emailExists($_POST['email']))
              Filter::$msgs['uname'] = lang('EMAIL_R4'); */

          if (empty($_POST['captcha']))
              Filter::$msgs['captcha'] = lang('FORM_ERROR6');
			  
		  if ($_SESSION['captchacode'] != $_POST['captcha'])
			  Filter::$msgs['captcha'] = lang('FORM_ERROR7');

          if (empty(Filter::$msgs)) {

              $userdata = $this->getUserInfo($_POST['username']);
              $randpass = $this->getUniqueCode(12);
              $newpass = sha1($randpass);

              $data['password'] = $newpass;

              self::$db->update(self::uTable, $data, "username = '" . $userdata->username . "'");

			  /*
              require_once (BASEPATH . "lib/class_mailer.php");
              $mailer = $mail->sendMail();
              $subject = lang('PASS_ESUBJECT') . Registry::get("Core")->company;

              ob_start();
              require_once (BASEPATH . 'mailer/Password_Reset.tpl.php');
              $html_message = ob_get_contents();
              ob_end_clean();

              $msg = Swift_Message::newInstance()
					  ->setSubject($subject)
					  ->setTo(array($userdata->email => $userdata->username))
					  ->setFrom(array(Registry::get("Core")->site_email => Registry::get("Core")->company))
					  ->setBody($html_message, 'text/html');
			  */

              (self::$db->affected() /*&& $mailer->send($msg) */) ? Filter::msgOk(lang('PASS_OK'), false) : Filter::msgError(lang('PASS_ERR'), false);

          } else
              print Filter::msgStatus();
      }
	  
      /**
       * Users::getUserData()
       * 
       * @return
       */
      public function getUserData()
      {
          $sql = "SELECT *, DATE_FORMAT(created, '" . Registry::get("Core")->long_date . "') as cdate," 
		  . "\n DATE_FORMAT(lastlogin, '" . Registry::get("Core")->long_date . "') as ldate" 
		  . "\n FROM " . self::uTable 
		  . "\n WHERE id = '" . $this->uid . "'";
          $row = self::$db->first($sql);

          return ($row) ? $row : 0;
      }

      /**
       * Users::profilenameExists()
       * 
       * @param mixed $username
       * @return
       */
      private function profilenameExists($profilename)
      {
          $profilename = sanitize($profilename);
          if (strlen(self::$db->escape($profilename)) < 2)
              return 1;

          $alpha_num = str_replace(" ", "", $profilename);
          if (!ctype_alnum($alpha_num))
              return 2;

          $sql = self::$db->query("SELECT profilename FROM user_profiles WHERE profilename = '" . $profilename . "' LIMIT 1");

          $count = self::$db->numrows($sql);

          return ($count > 0) ? 3 : false;
      }


      /**
       * Users::usernameExists()
       * 
       * @param mixed $username
       * @return
       */
      private function usernameExists($username)
      {
          $username = sanitize($username);
          if (strlen(self::$db->escape($username)) < 4)
              return 1;

          $alpha_num = str_replace(" ", "", $username);
          if (!ctype_alnum($alpha_num))
              return 2;

          $sql = self::$db->query("SELECT username FROM users WHERE username = '" . $username . "' LIMIT 1");

          $count = self::$db->numrows($sql);

          return ($count > 0) ? 3 : false;
      }
            
      /**
       * Users::emailExists()
       * 
       * @param mixed $email
       * @return
       */
      private function emailExists($email)
      {
          $email = self::$db->escape($email);
          $sql = self::$db->query("SELECT email FROM users WHERE email = '" . sanitize($email) . "' LIMIT 1");

          if (self::$db->numrows($sql) == 1) {
              return true;
          } else
              return false;
      }

      /**
       * Users::isValidEmail()
       * 
       * @param mixed $email
       * @return
       */
      private function isValidEmail($email)
      {
          if (function_exists('filter_var')) {
              if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                  return true;
              } else
                  return false;
          } else
              return preg_match('/^[a-zA-Z0-9._+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/', $email);
      }
	  
      /**
       * Users::getPTKidByNUPTK()
       * 
       * @param $nuptk
       * @return
       */
      private function getPTKidByNUPTK($nuptk)
      {
            $nuptk = self::$db->escape($nuptk);

            $sql = "SELECT id FROM ptk WHERE nuptk = '" . sanitize($nuptk) . "' LIMIT 1";

            $result = self::$db->query($sql);

            $row = self::$db->fetchrow($result);
            if ($row)
                return $row[0];
            else
                return false;
      }

      /**
       * Users::validatePTK()
       * 
       * @param $ptkid, $nputk....
       * @return
       */
      private function validatePTK($ptkid, $nuptk, $nip, $nama_lengkap, $email)
      {
            $nuptk = self::$db->escape($nuptk);
            $nip = self::$db->escape($nip);
            $nama_lengkap = strtolower( self::$db->escape($nama_lengkap) );
            $email = strtolower( self::$db->escape($email) );

            $sql = "SELECT nuptk, nip, LOWER(nama_lengkap) AS nama_lengkap FROM ptk WHERE id = " . $ptkid . " LIMIT 1";
            $row = self::$db->first($sql);
            
            if ($row) {

                if (($row->nuptk == $nuptk) && ($row->nama_lengkap == $nama_lengkap)) {
                    if ($nip != "") {
                        if ($row->nip) {
                            if ($row->nip == $nip)
                                return true;
                            else
                                return false;
                        } else // -- nip on DB still empty --
                            return true;
                    } else // -- no need check nip
                        return true;
                }                
                
            } else
                return false;
      }
                  
      /**
       * Users::getPTKidByNIP()
       * 
       * @param $nip
       * @return
       */
      private function getPTKidByNIP($nip)
      {
            $nip = self::$db->escape($nip);

            $sql = "SELECT id FROM ptk WHERE nip = '" . sanitize($nip) . "' LIMIT 1";

            $result = self::$db->query($sql);

            $row = self::$db->fetchrow($result);
            if ($row)
                return $row[0];
            else
                return false;
      }
            
      /**
       * Users::getDefaultPTKProfileid()
       * 
       * @param 
       * @return
       */
      private function getDefaultPTKProfileid()
      {
		  
		$result = self::$db->query("SELECT id FROM " . self::uprofileTable . " WHERE usermode = 'P'");
		  			
		$row = self::$db->fetchrow($result);
        if ($row) {
			return $row[0];
        } else
			return false;
      }

	  
      /**
       * Users::getUniqueCode()
       * 
       * @param string $length
       * @return
       */
      private function getUniqueCode($length = "")
      {
          $code = md5(uniqid(rand(), true));
          if ($length != "") {
              return substr($code, 0, $length);
          } else
              return $code;
      }

      /**
       * Users::generateRandID()
       * 
       * @return
       */
      private function generateRandID()
      {
          return sha1($this->getUniqueCode(24));
      }

      /**
       * Users::getClientFilter()
       * 
       * @return
       */
      public function getClientFilter()
      {
          $arr = array(
				//'company-ASC' => lang('COMPANY').' &uarr;', 
				//'company-DESC' => lang('COMPANY').' &darr;', 
				//'fname-ASC' => lang('FNAME').' &uarr;', 
				//'fname-DESC' => lang('FNAME').' &darr;', 
				//'lname-ASC' => lang('LNAME').' &uarr;', 
				//'lname-DESC' => lang('LNAME').' &darr;', 
				'email-ASC' => lang('EMAIL').' &uarr;', 
				'email-DESC' => lang('EMAIL').' &darr;'
		  );

          $filter = '';
          foreach ($arr as $key => $val) {
              if ($key == get('sort')) {
                  $filter .= "<option selected=\"selected\" value=\"$key\">$val</option>\n";
              } else
                  $filter .= "<option value=\"$key\">$val</option>\n";
          }
          unset($val);
          return $filter;
      }
	  
      /**
       * Users::updateUser_ProfileModules()
       * 
       * @param 
       * @return
       */
      public function updateUser_ProfileModules()
      {
            
            unset($this->profilemodules);
            $this->profilemodules = array();              
              
            if ($this->profileid > 0) {              
                $sql = "SELECT *"
                        ."\n FROM user_profilemodules"
                        ."\n WHERE profileid = " . $this->profileid
                        ."\n ORDER BY moduleid";
                $pmrows = self::$db->fetch_all($sql);
                if ($pmrows) {
                    foreach ($pmrows as $pmrow) {
                        $this->profilemodules[$pmrow->moduleid] = $pmrow->accesslist;
                    }
                    unset ($pmrow);
                    unset($pmrows);
                }
                
              }
          
      }

      /**
       * Users::isUser_ProfileModuleExists()
       * 
       * @param $moduleid, $accessid
       * @return
       */
      public function isProfileModuleExists($moduleid, $accessid)
      {
         
            if (array_key_exists($moduleid, $this->profilemodules)) {
                if (strrpos($this->profilemodules[$moduleid], $accessid) !== FALSE)
                    return TRUE;
                else
                    return FALSE;
              } else
                  return FALSE;
          
      }
            
      /**
       * Users::updatePTKInfo()
       * 
       * @param
       * @return
       */
      public function updatePTKInfo()
      {
		
		      if ($this->ptkid <= 0)
		        $this->sekolahid = 0;
		      else {

            if ($this->usermode == 'S') 
              $sql = "SELECT lembagaid"
                  ."\n FROM staff"
                  ."\n WHERE id = " . $this->ptkid;
            else
              $sql = "SELECT sekolahid"
                  ."\n FROM ptk"
                  ."\n WHERE id = " . $this->ptkid;
						
            $row = self::$db->first($sql);
 
            if ($row) {

              if ($this->usermode == 'S')
                $this->sekolahid = $row->lembagaid;
              else
                $this->sekolahid = $row->sekolahid;

            } else
		          $this->sekolahid = 0;
		      }

      }
      
      
	  
  }
?>