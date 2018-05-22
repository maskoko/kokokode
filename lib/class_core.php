<?php
  /**
   * Core Class
   *
   * @package SIM PPPPTK BMTI
   * @author a2ngsa
   * @copyright 2012
   * @version $Id: core_class.php, v1.00 2011-06-05 10:12:05 gewa Exp $
   */
  
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');

   require_once("init.php");

  class Core
  {

      const sTable = "settings";
      public $year = null;
      public $month = null;
      public $day = null;
      public $language;
      public $LongDayNames = array();
      public $LongMonthNames = array();
      public $ShortMonthNames = array();
      
      /**
       * Core::__construct()
       * 
       * @return
       */
      function __construct()
      {
          $this->getSettings();
          $this->getLanguage();

          $this->year = (get('year')) ? get('year') : strftime('%Y');
          $this->month = (get('month')) ? get('month') : strftime('%m');
          $this->day = (get('day')) ? get('day') : strftime('%d');

          $this->LongDayNames = array(lang('SUN'), lang('MON'), lang('TUE'), lang('WED'), lang('THU'), lang('FRI'), lang('SAT'));
          $this->LongMonthNames = array(1 => lang('JAN_L'), lang('FEB_L'), lang('MAR_L'), lang('APR_L'), lang('MAY_L'), lang('JUN_L'),
                                lang('JUL_L'), lang('AUG_L'), lang('SEP_L'), lang('OCT_L'), lang('NOV_L'), lang('DEC_L'));
          $this->ShortMonthNames = array(1 => lang('JAN'), lang('FEB'), lang('MAR'), lang('APR'), lang('MAY'), lang('JUN'),
                                lang('JUL'), lang('AUG'), lang('SEP'), lang('OCT'), lang('NOV'), lang('DEC'));          
          
          return mktime(0, 0, 0, $this->month, $this->day, $this->year);
      }


      /**
       * Core::getSettings()
       * 
       * @return
       */
      private function getSettings()
      {
          $sql = "SELECT * FROM " . self::sTable;
          $row = Registry::get("Database")->first($sql);

          $this->company = $row->company;
          $this->site_url = $row->site_url;
          $this->site_email = $row->site_email;
          $this->address = $row->address;
          $this->city = $row->city;
          $this->state = $row->state;
          $this->postcode = $row->postcode;
          $this->phone = $row->phone;
          $this->fax = $row->fax;
          $this->logo = $row->logo;
          $this->short_date = $row->short_date;
          $this->long_date = $row->long_date;
          $this->enable_reg = $row->enable_reg;
          $this->enable_uploads = $row->enable_uploads;
          $this->file_types = $row->file_types;
          $this->file_max = $row->file_max;
          $this->perpage = $row->perpage;
          $this->mailer = $row->mailer;
          $this->smtp_host = $row->smtp_host;
          $this->smtp_user = $row->smtp_user;
          $this->smtp_pass = $row->smtp_pass;
          $this->smtp_port = $row->smtp_port;
          $this->smtp_port = $row->smtp_port;
          $this->sendmail = $row->sendmail;
          $this->is_ssl = $row->is_ssl;

          $this->ver_info = $row->ver_info;
          
      }

      /**
       * Core::processConfig()
       * 
       * @return
       */
      public function processConfig()
      {

          if (empty($_POST['company']))
              Filter::$msgs['company'] = lang('CONF_COMPANY_R');

          if (empty($_POST['site_url']))
              Filter::$msgs['site_url'] = lang('CONF_URL_R');

          if (empty($_POST['site_email']))
              Filter::$msgs['site_email'] = lang('CONF_EMAIL_R');

          if (isset($_POST['mailer']) && $_POST['mailer'] == "SMTP") {
              if (empty($_POST['smtp_host']))
                  Filter::$msgs['smtp_host'] = lang('CONF_SMTP_HOST_R');
              if (empty($_POST['smtp_user']))
                  Filter::$msgs['smtp_user'] = lang('CONF_SMTP_USER_R');
              if (empty($_POST['smtp_pass']))
                  Filter::$msgs['smtp_pass'] = lang('CONF_SMTP_PASS_R');
              if (empty($_POST['smtp_port']))
                  Filter::$msgs['smtp_port'] = lang('CONF_SMTP_PORT_R');
          }

          if (!empty($_FILES['logo']['name'])) {
              $file_info = getimagesize($_FILES['logo']['tmp_name']);
              if (empty($file_info))
                  Filter::$msgs['logo'] = lang('CONF_LOGO_R');
          }

          if (empty(Filter::$msgs)) {
              $data = array(
                            'company' => sanitize($_POST['company']),
                            'site_url' => sanitize($_POST['site_url']),
                            'site_email' => sanitize($_POST['site_email']),
                            'address' => sanitize($_POST['address']), 
                            'city' => sanitize($_POST['city']),
                            'state' => sanitize($_POST['state']),
                            'postcode' => sanitize($_POST['postcode']),
                            'phone' => sanitize($_POST['phone']),
                            'fax' => sanitize($_POST['fax']),
                            'short_date' => sanitize($_POST['short_date']),
                            'long_date' => sanitize($_POST['long_date']),
                            //'dtz' => trim($_POST['dtz']),
                            //'weekstart' => intval($_POST['weekstart']),
                            //'lang' => sanitize($_POST['lang']),
                            'enable_reg' => intval($_POST['enable_reg']),
                            'enable_uploads' => intval($_POST['enable_uploads']),
                            'file_types' => trim($_POST['file_types']),
                            //'file_max' => intval($_POST['file_max']*1048576),				  
                            'perpage' => intval($_POST['perpage']),
                           /* 'mailer' => sanitize($_POST['mailer']),
                            'smtp_host' => sanitize($_POST['smtp_host']),
                            'smtp_user' => sanitize($_POST['smtp_user']),
                            'smtp_pass' => sanitize($_POST['smtp_pass']),
                            'smtp_port' => intval($_POST['smtp_port']) */
                            );

				  				  
			  if (isset($_POST['dellogo']) and $_POST['dellogo'] == 1) {
				  $data['logo'] = "NULL";
			  } elseif (!empty($_FILES['logo']['name'])) {
				  if ($this->logo) {
					  @unlink(UPLOADS . $this->logo);
				  }
					  move_uploaded_file($_FILES['logo']['tmp_name'], UPLOADS.$_FILES['logo']['name']);

				  $data['logo'] = sanitize($_FILES['logo']['name']);
			  } else {
				$data['logo'] = $this->logo;
			  }
			  			  
              Registry::get("Database")->update(self::sTable, $data);
              (Registry::get("Database")->affected()) ? Filter::msgOk(lang('DATA_UPDATED')) : Filter::msgAlert(lang('NOPROCCESS'));
          } else
              print Filter::msgStatus();
      }
	        
	  /**
	   * Core:::getLanguage()
	   * 
	   * @return
	   */
	  private function getLanguage()
	  {
		  $this->langdir = BASEPATH . "lang/";
		  
		  if (isset($_COOKIE['LANG_FM_'])) {
			  $sel_lang = sanitize($_COOKIE['LANG_FM_'], 2);
			  $vlang = $this->fetchLanguage();
			  if(in_array($sel_lang, $vlang)) {
				  $this->language = $sel_lang;
			  } else {
				  $this->language = "id";
			  }
			  if (file_exists($this->langdir . $this->language . ".lang.php")) {
				  include($this->langdir . $this->language . ".lang.php");
			  } else {
				  include($this->langdir . "id.lang.php");
			  }
		  } else {
			  $this->language = "id";
			  include($this->langdir . "id.lang.php");
		  }
	  }
	  
      /**
       * Core::fetchLanguage()
       * 
       * @return
       */
	  public function fetchLanguage()
	  {
		  if (!is_dir(BASEPATH . 'lang/')) {
			  return false;
		  } else {
			  $lang_array = array();
			  $ext = array('html','png');
			  if ($handle = opendir(BASEPATH . 'lang/')) {
				  while (false !== ($file = readdir($handle))) {
					  if ($file != "." && $file != ".." && !in_array(pathinfo($file, PATHINFO_EXTENSION), $ext)) {
						  $lang_array[] = substr($file, 0, 2);
					  }
				  }
				  closedir($handle);
			  }
			  return $lang_array;
		  }
	  }
            
      /**
       * Core::getShortDate()
       * 
       * @return
       */
      public function getShortDate()
      {
          $arr = array(
				 '%m-%d-%Y' => '12-21-2009 (MM-DD-YYYY)',
				 '%e-%m-%Y' => '21-12-2009 (D-MM-YYYY)',
				 '%m-%e-%y' => '12-21-09 (MM-D-YY)',
				 '%e-%m-%y' => '21-12-09 (D-MM-YY)',
				 '%b %d %Y' => 'Dec 21 2009'
		  );

          $shortdate = '';
          foreach ($arr as $key => $val) {
              if ($key == $this->short_date) {
                  $shortdate .= "<option selected=\"selected\" value=\"" . $key . "\">" . $val . "</option>\n";
              } else
                  $shortdate .= "<option value=\"" . $key . "\">" . $val . "</option>\n";
          }
          unset($val);
          return $shortdate;
      }


      /**
       * Core::getLongDate()
       * 
       * @return
       */
      public function getLongDate()
      {
          $arr = array(
				'%B %d, %Y' => 'December 21, 2009',
				'%d %B %Y %H:%M' => '21 December 2009 19:00',
				'%B %d, %Y %I:%M %p' => 'December 21, 2009 4:00 am',
				'%A %d %B, %Y' => 'Monday 21 December, 2009',
				'%A %d %B, %Y %H:%M' => 'Monday 21 December 2009 07:00',
				'%a %d, %B' => 'Mon. 12, December'
		  );

          $longdate = '';
          foreach ($arr as $key => $val) {
              if ($key == $this->long_date) {
                  $longdate .= "<option selected=\"selected\" value=\"" . $key . "\">" . $val . "</option>\n";
              } else
                  $longdate .= "<option value=\"" . $key . "\">" . $val . "</option>\n";
          }
          unset($val);
          return $longdate;
      }

      /**
       * Core::yearList()
       * 
       * @param mixed $start_year
       * @param mixed $end_year
       * @return
       */
      function yearList($start_year, $end_year)
      {
          $selected = is_null(get('year')) ? date('Y') : get('year');
          $r = range($start_year, $end_year);

          $select = '';
          foreach ($r as $year) {
              $select .= "<option value=\"$year\"";
              $select .= ($year == $selected) ? ' selected="selected"' : '';
              $select .= ">$year</option>\n";
          }
          return $select;
      }


      /**
       * Core::monthList()
       * 
       * @return
       */
      public function monthList()
      {
          $selected = is_null(get('month')) ? strftime('%m') : get('month');

          $arr = array(
		          '01' => lang('JAN'), 
		          '02' => lang('FEB'), 
		          '03' => lang('MAR'), 
		          '04' => lang('APR'), 
		          '05' => lang('MAY'), 
		          '06' => lang('JUN'), 
		          '07' => lang('JUL'), 
		          '08' => lang('AUG'), 
		          '09' => lang('SEP'), 
		          '10' => lang('OCT'), 
		          '11' => lang('NOV'), 
		          '12' => lang('DEC')
          );

          $monthlist = '';
          foreach ($arr as $key => $val) {
              $monthlist .= "<option value=\"$key\"";
              $monthlist .= ($key == $selected) ? ' selected="selected"' : '';
              $monthlist .= ">$val</option>\n";
          }
          unset($val);
          return $monthlist;
      }

      /**
       * Core::weekList()
       * 
       * @return
       */
      public function weekList()
      {
          $arr = array(
		          '1' => lang('SUN'), 
		          '2' => lang('MON'), 
		          '3' => lang('TUE'), 
		          '4' => lang('WED'), 
		          '5' => lang('THU'), 
		          '6' => lang('FRI'), 
		          '7' => lang('SAT')
          );

          $weeklist = '';
          foreach ($arr as $key => $val) {
              $weeklist .= "<option value=\"$key\"";
              $weeklist .= ($key == $this->weekstart) ? ' selected="selected"' : '';
              $weeklist .= ">$val</option>\n";
          }
          unset($val);
          return $weeklist;
      }
	  

      /**
       * Core::getTimezones()
       * 
       * @return
       */
      public function getTimezones()
      {
          $data = '';
          $tzone = DateTimeZone::listIdentifiers();
          $data .= '<select name="dtz">';
          foreach ($tzone as $zone) {
              $selected = ($zone == $this->dtz) ? ' selected="selected"' : '';
              $data .= '<option value="' . $zone . '"' . $selected . '>' . $zone . '</option>';
          }
          $data .= '</select>';
          return $data;
      }

      /**
       * Core::formatMoney()
       * 
       * @param mixed $amount
       * @return
       */
      function formatMoney($amount)
      {
          return $this->cur_symbol . number_format($amount, 2, '.', ',') . $this->currency;
      }

      
      /**
       * Core::formatLongDate()
       * 
       * @param $str = Y-m-d
       * @return
       */
      public function formatLongDate($str)
      {
            $adate = strtotime($str);
            if (!$adate)
                return '';
            else {
                // $this->LongDayNames[date("w", $adate)]
                $strdate = date("j", $adate)." ".$this->LongMonthNames[date("n", $adate)]." ".date("Y", $adate);
                //date('d F Y', $adate);
                return $strdate;
            }
      }
      
      
      /**
       * Core::getRowById()
       * 
       * @param mixed $table
       * @param mixed $id
       * @param bool $and
       * @param bool $is_admin
       * @return
       */
      public static function getRowById($table, $id, $and = false, $is_admin = true)
      {
          $id = sanitize($id, 8, true);
          if ($and) {
              $sql = "SELECT * FROM " . (string )$table . " WHERE id = '" . Registry::get("Database")->escape((int)$id) . "' AND " . Registry::get("Database")->escape($and) . "";
          } else
              $sql = "SELECT * FROM " . (string )$table . " WHERE id = '" . Registry::get("Database")->escape((int)$id) . "'";

          $row = Registry::get("Database")->first($sql);

          if ($row) {
              return $row;
          } else {
              if ($is_admin)
                  Filter::error("You have selected an Invalid Id - #" . $id, "Core::getRowById()");
          }
      }

      /**
       * Core::getRowByKey()
       * 
       * @param mixed $table
       * @param mixed $id
       * @param bool $and
       * @param bool $is_admin
       * @return
       */
      public static function getRowByKey($table, $field, $keyvalue, $and = false, $is_admin = true)
      {
          $keyvalue = sanitize($keyvalue);
          if ($and) {
              $sql = "SELECT * FROM " . (string )$table . " WHERE " . (string)$field . " = '" . (string)$keyvalue . "' AND " . Registry::get("Database")->escape($and) . "";
          } else
              $sql = "SELECT * FROM " . (string )$table . " WHERE " . (string)$field . " = '" . (string)$keyvalue . "'";

          $row = Registry::get("Database")->first($sql);

          if ($row) {
              return $row;
          } else {
              if ($is_admin)
                  Filter::error("You have selected an Invalid Id - #" . $id, "Core::getRowById()");
          }
      }
      
      	  	  
      /**
       * Core::doForm()
       * 
       * @param mixed $data
       * @param string $url
       * @param integer $reset
       * @param integer $clear
       * @param string $form_id
       * @param string $msgholder
       * @return
       */
      public static function doForm($data, $url = "controller.php", $reset = 0, $clear = 0, $form_id = "admin_form", $msgholder = "msgholder")
      {
          $display = '
		  <script type="text/javascript">
		  // <![CDATA[

			  $(document).ready(function () {
                                var options = {
                                        target: "#' . $msgholder . '",
                                        beforeSubmit:  showLoader,
                                        success: showResponse,
                                        url: "' . $url . '",
                                        resetForm : ' . $reset . ',
                                        clearForm : ' . $clear . ',
                                        data: {
                                                ' . $data . ': 1
                                        }
                                };

                                $("#' . $form_id . '").ajaxForm(options);
			  });
			  
			  function showLoader() {
                                $("#loader").fadeIn(200);
			  }
		  
			  function hideLoader() {
                                $("#loader").fadeOut(200);
			  };	
			  		  
			  function showResponse(msg) {    
                                hideLoader();
                                $(this).html(msg);
                                $("html, body").animate({
                                        scrollTop: 0
                                }, 600);
			  }


		  
			  ';
          $display .= '
		  // ]]>
		  </script>';

          print $display;
      }


      /**
       * Core::doDelete()
       * 
       * @param mixed $title
       * @param mixed $varpost
       * @param string $classname
       * @param string $submit
       * @param string $dialog
       * @param string $url
       * @return
       */
      public static function doDelete($title, $varpost, $classname = '.tip.doDelete', $submitid = 'confirmBtn', $dialog = 'confirmModal', $url = "controller.php")
      {
          $display = "
                <div class=\"modal fade hide\" id=\"" . $dialog . "\">
                    <div class=\"modal-header\">
                        <button type=\"button\" class=\"close\" data-dismiss=\"modal\"><span class=\"icon12 minia-icon-close\"></span></button>
                        <h3>" . $title . "</h3>
                    </div>
                    <div class=\"modal-body\">					
                        <p>" . lang('DELCONFIRM') . "</p>
                    </div>
                    <div class=\"modal-footer\">
                        <a href=\"#\" id=\"" . $submitid . "\" class=\"btn btn-danger\">" . lang('DELETE') . "</a>
                        <a href=\"#\" class=\"btn\" data-dismiss=\"modal\">" . lang('CANCEL') . "</a>
                    </div>
                </div>
				
		  <script type=\"text/javascript\"> 
		  // <![CDATA[
		  
			$('#" . $dialog . "').on('show', function() {
				var id = $(this).data('delid'),
                                    parent = $(this).data('parent');
					
				$('#" . $dialog . " a#" . $submitid . "').on('click', function(e) {
												
					$('#" . $dialog . "').modal('hide'); // dismiss the dialog

					$.ajax({
						  type: 'post',
						  url: '" . $url . "',
						  data: '" . $varpost . "=' + id,
						  beforeSend: function () {
							  parent.animate({
								  'backgroundColor': '#FFBFBF'
							  }, 400);
						  },
						  success: function (msg) {
							  parent.fadeOut(400, function () {
								  parent.remove();
							  });
							  $('html, body').animate({scrollTop:0}, 600);
							  $(\"#msgholder\").html(msg);
						  }
					});
										
				});		
														
			})

			$('#" . $dialog . "').on('hide', function() {

				$('#" . $dialog . " a#" . $submitid . "').off('click');

			});

			$('" . $classname . "').click(function(e) {
				e.preventDefault();
				
				var id = $(this).data('id');
                                var parent = $(this).parent().parent();
				
				$('#" . $dialog . "').data({
					'delid': id,
					'parent': parent
				});
				
				$('#" . $dialog . "').modal('show');
												
			});		  		  
		  </script>";



      // if (Filter::$do && file_exists(Filter::$do.".php")) {

      //   if ($user->profileid == 1)
      //     $moduleid = 1024; // -- all access --
      //   else {

      //     $do = Filter::$do;
      //     $action = Filter::$action;
      //     if ($do == "sekolah") {
      //         $moduleid = 5;
      //         $access = 'R';
      //     }
      //     else if ($do == "ptk") {
      //         $moduleid = 4;
      //         $access = 'R';
      //     } else if ($do == "lembaga") {
      //         $moduleid = 7;
      //         $access = 'R';
      //     } else if ($do == "staff") {
      //         $moduleid = 6;
      //         $access = 'R';
      //     } else if (($do == "rujukan_propinsi") || ($do == "rujukan_kota") || ($do == "rujukan_sekolah_jenis") 
      //         || ($do == "rujukan_departemen") || ($do == "rujukan_bsk") || ($do == "rujukan_psk")|| ($do == "rujukan_kk") 
      //         || ($do == "rujukan_golongan")) {
      //         $moduleid = 3;
      //         $access = 'R';          
      //     } else if ($do == "diklat") {
      //         $moduleid = 8;
      //         $access = 'R';
      //     } else if ($do == "diklat_jadwal") {
      //         $moduleid = 9;
      //         $access = 'R';
      //     } else if ($do == "diklat_calonpeserta") {
      //         $moduleid = 10;
      //         $access = 'R';
      //     } else if ($do == "diklat_peserta") {
      //         $moduleid = 11;
      //         $access = 'R';
      //     } else if (($do == "config") || ($do == "backup")) {
      //         $moduleid = 1;
      //         $access = 'R';
      //     }  else if ($do == "users" && $action == "") {
      //         $moduleid = 1;
      //         $access = 'R';
      //     }  else if ($do == "users" && $action == "edit") {
      //         $moduleid = 99;
      //         $access = 'R';
      //     } else if ($do == "pn_gedung") {
      //         $moduleid = 12;
      //         $access = 'R';
      //     } else if ($do == "pn_diklat_mata_tatar") {
      //         $moduleid = 13;
      //         $access = 'R';
      //     } else if ($do == "pn_diklat_agenda") {
      //         $moduleid = 14;
      //         $access = 'R';
      //     } else if ($do == "pn_diklat_absen") {
      //         $moduleid = 15;
      //         $access = 'R';
      //     } else if ($do == "pn_diklat_nilai") {
      //         $moduleid = 16;
      //         $access = 'R';
      //     } else if ($do == "pn_diklat_sertifikat") {
      //         $moduleid = 17;
      //         $access = 'R';
      //     } else if (substr($do,0,6) == "report") {
      //         $moduleid = 18;
      //         $access = 'R';
      //     } else if (substr($do,0,5) == "chart") {
      //         $moduleid = 19;
      //         $access = 'R';
      //     } else {
      //         $moduleid = 0;
      //         $access = 'R';
      //     }

      //     if (!$user->isProfileModuleExists($moduleid, $access)){
      //       if ($moduleid != 99)
      //           $moduleid = 0;
      //         else
      //           $moduleid = 99;

      //     }

      //   }

      //   if ($moduleid > 0){
      //     if(Filter::$action && $user->profileid != 1){
      //     $action = Filter::$action;
      //     // include(Filter::$do.".php");
      //       // if(($action == "edit" || $action == "add") ){
               $access = 'D';
               $moduleid = 8;
      //          if (!$user->isProfileModuleExists($moduleid, $access)){
      //            if ($moduleid != 99)
               
      //           $moduleid = 0;
      //         else
      //           $moduleid = 99;
      //       }

      //          if ($moduleid > 0)
      //             print $display;
      //               else 
      //             include("restricted.php");
      // //         // }
      //       }
      //       else
               print $display;
        // }
        // else
          // include("restricted.php");

      // }
          
      }
  }
?>