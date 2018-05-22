<?php
  /**
   * Calendar Class
   *
   * @package SIM TEDC
   * @author a2ng
   * @copyright 2012
   * @version $Id: class_calendar.php, v1.00 2011-12-20 10:12:05 gewa Exp $
   */
  
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
  
  class Calendar
  {

      public $weekDayNameLength;
      public $monthNameLength;
      private $arrWeekDays = array();
      private $arrMonths = array();
      private $pars = array();
      private $today = array();
      private $prevYear = array();
      private $nextYear = array();
      private $prevMonth = array();
      private $nextMonth = array();
      protected $eventDiklat_Jadwal;


      /**
       * Calendar::__construct()
       * 
       * @return
       */
      function __construct()
      {
		  $this->weekStartedDay = Registry::get("Core")->weekstart;
		  $this->weekDayNameLength = "long";
		  $this->monthNameLength = "long";
		  $this->init();
          $this->eventDiklat_Jadwal = $this->getCalDataDiklat_Jadwal();
      }

	  /**
	   * Calendar::init()
	   * 
	   * @return
	   */
	  private function init()
	  {
          $year = (isset($_POST['year']) && self::checkYear($_POST['year'])) ? intval($_POST['year']) : date("Y");
          $month = (isset($_POST['month']) && self::checkMonth($_POST['month'])) ? intval($_POST['month']) : date("m");
          $day = (isset($_POST['day']) && self::checkDay($_POST['day'])) ? intval($_POST['day']) : date("d");
		  $ldim = $this->calcDays($month, $day);
		  
		  if($day > $ldim) {
		  	$day = $ldim;
		  }
		  
          $cdate = getdate(mktime(0, 0, 0, $month, $day, $year));

          $this->pars["year"] = $cdate['year'];
          $this->pars["month"] = self::toDecimal($cdate['mon']);
          $this->pars["nmonth"] = $cdate['mon'];
          $this->pars["month_full_name"] = $cdate['month'];
          $this->pars["day"] = $day;
          $this->today = getdate();

          $this->prevYear = getdate(mktime(0, 0, 0, $this->pars['month'], $this->pars["day"], $this->pars['year'] - 1));
          $this->nextYear = getdate(mktime(0, 0, 0, $this->pars['month'], $this->pars["day"], $this->pars['year'] + 1));
          $this->prevMonth = getdate(mktime(0, 0, 0, $this->pars['month'] - 1, $this->calcDays($this->pars['month']-1,$this->pars["day"]), $this->pars['year']));
          $this->nextMonth = getdate(mktime(0, 0, 0, $this->pars['month'] + 1, $this->calcDays($this->pars['month']+1,$this->pars["day"]), $this->pars['year']));
		  

          $this->arrWeekDays[0] = array("mini" => "S", "short" => "Sun", "long" => lang('SUN'));
          $this->arrWeekDays[1] = array("mini" => "M", "short" => "Mon", "long" => lang('MON'));
          $this->arrWeekDays[2] = array("mini" => "T", "short" => "Tue", "long" => lang('TUE'));
          $this->arrWeekDays[3] = array("mini" => "W", "short" => "Wed", "long" => lang('WED'));
          $this->arrWeekDays[4] = array("mini" => "T", "short" => "Thu", "long" => lang('THU'));
          $this->arrWeekDays[5] = array("mini" => "F", "short" => "Fri", "long" => lang('FRI'));
          $this->arrWeekDays[6] = array("mini" => "S", "short" => "Sat", "long" => lang('SAT'));
		  
		  $this->arrMonths[1] = array("short" => lang('JAN'), "long" => lang('JAN_L'));
		  $this->arrMonths[2] = array("short" => lang('FEB'), "long" => lang('FEB_L'));
		  $this->arrMonths[3] = array("short" => lang('MAR'), "long" => lang('MAR_L'));
		  $this->arrMonths[4] = array("short" => lang('APR'), "long" => lang('APR_L'));
		  $this->arrMonths[5] = array("short" => lang('MAY'), "long" => lang('MAY_L'));
		  $this->arrMonths[6] = array("short" => lang('JUN'), "long" => lang('JUN_L'));
		  $this->arrMonths[7] = array("short" => lang('JUL'), "long" => lang('JUL_L'));
		  $this->arrMonths[8] = array("short" => lang('AUG'), "long" => lang('AUG_L'));
		  $this->arrMonths[9] = array("short" => lang('SEP'), "long" => lang('SEP_L'));
		  $this->arrMonths[10] = array("short" => lang('OCT'), "long" => lang('OCT_L'));
		  $this->arrMonths[11] = array("short" => lang('NOV'), "long" => lang('NOV_L'));
		  $this->arrMonths[12] = array("short" => lang('DEC'), "long" => lang('DEC_L'));
	  }
	  
      /**
       * Calendar::renderCalendar()
       * 
       * @return
       */
      public function renderCalendar()
      {
		  $this->drawMonth();
      }


      /**
       * Calendar::checkDiklat_JadwalData()
       * 
       * @param mixed $day
       * @return
       */
      private function checkDiklat_JadwalData($day)
      {
          if ($this->eventDiklat_Jadwal) {
              foreach ($this->eventDiklat_Jadwal as $v) {
                  if ($day == $v->eday) {
                      return true;
                  }
              }

              return false;
          }
      }


      /**
       * Calendar::getCalDataDiklat_Jadwal()
       * 
       * @return
       */
      private function getCalDataDiklat_Jadwal()
      {
		  $sql = "SELECT dj.*, DAY(dj.tgl_mulai) as eday, d.nama_diklat"
		  . "\n FROM diklat_jadwal AS dj"
		  . "\n LEFT JOIN diklat AS d"
		  . "\n ON dj.diklatid = d.id"
		  . "\n WHERE YEAR(dj.tgl_mulai) = " . $this->pars['year']
		  . "\n AND MONTH(dj.tgl_mulai) = " . $this->pars['month']
		  /* . "\n AND status = 'Unpaid'" */
		  . "\n ORDER BY dj.tgl_mulai ASC";

		  $row = Registry::get("Database")->fetch_all($sql);
		  
		  return ($row) ? $row : 0;

      }

  
      /**
       * Calendar::drawMonth()
       * 
       * @return
       */
	  private function drawMonth()
	  {
		  $is_day = 0;
		  $first_day = getdate(mktime(0, 0, 0, $this->pars['month'], 1, $this->pars['year']));
		  $last_day = getdate(mktime(0, 0, 0, $this->pars['month'] + 1, 0, $this->pars['year']));
	
		  echo "<table class=\"month\" cellspacing=\"0\">";
		  echo "<thead>";
		  echo "<tr>";
		  echo " <td><a href=\"javascript:void(0);\" id=\"item_" . self::toDecimal($this->prevMonth['mon']) . ":" . $this->prevMonth['year'] . "\" class=\"changedate prev\"></a></td>";
		  echo "<td colspan=\"5\">" . $this->arrMonths[$this->pars['nmonth']][$this->monthNameLength] . " - " . $this->pars['year'] . "</td>";
		  echo "<td><a href=\"javascript:void(0);\" id=\"item_" . self::toDecimal($this->nextMonth['mon']) . ":" . $this->nextMonth['year'] . "\" class=\"changedate next\"></a></td>";
		  echo "</tr>";
		  echo "<tr>";
		  for ($i = $this->weekStartedDay - 1; $i < $this->weekStartedDay + 6; $i++) {
			  echo "<th width=\"14%\">" . $this->arrWeekDays[($i % 7)][$this->weekDayNameLength] . "</th>";
		  }
		  echo "</tr>";
		  echo "</thead>";
		  echo "<tbody>";
	
		  if ($first_day['wday'] == 0) {
			  $first_day['wday'] = 7;
		  }
		  $max_days = $first_day['wday'] - ($this->weekStartedDay - 1);
		  if ($max_days < 7) {
			  echo "<tr>";
			  for ($i = 1; $i <= $max_days; $i++) {
				  echo "<td class=\"empty\">.</td>";
			  }
			  $is_day = 0;
			  for ($i = $max_days + 1; $i <= 7; $i++) {
				  $is_day++;
				  $class = '';
				  $tclass = '';
				  $align = '';
				  if (($is_day == $this->today['mday']) && ($this->today['mon'] == $this->pars["month"])) {
					  $tclass = " today";
					  $data = $is_day;
				  }
				  if ($this->checkDiklat_JadwalData($is_day) ) {


					  $res = '';
					  if ($this->checkDiklat_JadwalData($is_day)) {
						  foreach ($this->eventDiklat_Jadwal as $erow) {
							  if ($erow->eday == $is_day) {

							  
								  $eurl = "index.php?do=diklat_jadwal&amp;action=edit&amp;id=" . $erow->id;
								  $res .= "<small class=\"project-bullet\"><a href=\"" . $eurl . "\" title=\"" . $erow->nama_diklat . "\" class=\"tooltip\">" . sanitize($erow->nama_diklat, 25) . "</a></small>\n";
	
							  }
	
						  }
					  }
	
					  $data = "<div><span>" . $is_day . "</span>" . $res . "</div>";
					  $class = " events";
					  $align = " valign=\"top\"";
				  } else {
					  $data = $is_day;
				  }
				  echo "<td class=\"caldata" . $class . $tclass . "\"" . $align . ">" . $data . "</td>";
			  }
			  echo "</tr>";
		  }
	
		  $fullWeeks = floor(($last_day['mday'] - $is_day) / 7);
	
		  for ($i = 0; $i < $fullWeeks; $i++) {
			  echo "<tr>";
			  for ($j = 0; $j < 7; $j++) {
				  $is_day++;
				  $class = '';
				  $tclass = '';
				  $align = '';
				  if (($is_day == $this->today['mday']) && ($this->today['mon'] == $this->pars["month"])) {
					  $tclass = " today";
					  $data = $is_day;
				  }
				  if ($this->checkDiklat_JadwalData($is_day) ) {
				  
					  $res = '';
					  if ($this->checkDiklat_JadwalData($is_day)) {
						  						  
						  foreach ($this->eventDiklat_Jadwal as $erow) {
							  if ($erow->eday == $is_day) {

							  
								  $eurl = "index.php?do=diklat_jadwal&amp;action=edit&amp;id=" . $erow->id;
								  $res .= "<small class=\"project-bullet\"><a href=\"" . $eurl . "\" title=\"" . $erow->nama_diklat . "\" class=\"tooltip\">" . sanitize($erow->nama_diklat, 25) . "</a></small>\n";
	
							  }
	
						  }
					  }
	
					  $data = "<div><span>" . $is_day . "</span>" . $res . "</div>";
					  $class = " events";
					  $align = " valign=\"top\"";
				  } else {
					  $data = $is_day;
				  }
	
				  echo "<td class=\"caldata" . $class . $tclass . "\"" . $align . ">" . $data . "</td>";
			  }
			  echo "</tr>";
		  }
	
		  if ($is_day < $last_day['mday']) {
			  echo "<tr>";
			  for ($i = 0; $i < 7; $i++) {
				  $is_day++;
				  $class = '';
				  $tclass = '';
				  $align = '';
				  if (($is_day == $this->today['mday']) && ($this->today['mon'] == $this->pars["month"])) {
					  $tclass = " today";
					  $data = $is_day;
				  }
	
				  if ($this->checkDiklat_JadwalData($is_day) ) {

					  
					  $res = '';
					  if ($this->checkDiklat_JadwalData($is_day)) {
						  foreach ($this->eventDiklat_Jadwal as $erow) {
							  if ($erow->eday == $is_day) {
								  $eurl = "index.php?do=diklat_jadwal&amp;action=edit&amp;id=" . $erow->id;
								  $res .= "<small class=\"project-bullet\"><a href=\"" . $eurl . "\" title=\"" . $erow->nama_diklat . "\" class=\"tooltip\">" . sanitize($erow->nama_diklat, 25) . "</a></small>\n";
	
							  }
	
						  }
					  }
	
					  $data = "<div><span>" . $is_day . "</span>" . $res . "</div>";
					  $class = " events";
					  $align = " valign=\"top\"";
				  } else {
					  $data = $is_day;
				  }

				echo ($is_day <= $last_day['mday']) ? "<td class=\"caldata" . $class . $tclass . "\"" . $align . ">" . $data . "</td>" : "<td class=\"empty\">.</td>";

			  }
			  echo "</tr>";
		  }
		  echo "</tbody>";
		  echo "</table>";
	  }

	/**
	 * Calendar::calcDays()
	 * 
	 * @param string $month
	 * @param string $day
	 * @return
	 */
	  private function calcDays($month, $day)
	  {
		  if ($day < 29) {
			  return $day;
		  } elseif ($day == 29) {
			  return ((int)$month == 2) ? 28 : 29;
		  } elseif ($day == 30) {
			  return ((int)$month != 2) ? 30 : 28;
		  } elseif ($day == 31) {
			  return ((int)$month == 2 ? 28 : ((int)$month == 4 || (int)$month == 6 || (int)$month == 9 || (int)$month == 11 ? 30 : 31));
		  } else {
			  return 30;
		  }
	
	  }
	  
      /**
       * Calendar::toDecimal()
       * 
       * @param mixed $number
       * @return
       */
      private static function toDecimal($number)
      {
          return (($number < 10) ? "0" : "") . $number;
      }
	  
      /**
       * Calendar::checkYear()
       * 
       * @param string $year
       * @return
       */
      private static function checkYear($year)
      {
          return (strlen($year) == 4 or ctype_digit($year)) ? true : false;
      }


      /**
       * Calendar::checkMonth()
       * 
       * @param string $month
       * @return
       */
      private static function checkMonth($month)
      {
          return ((strlen($month) == 2) or ctype_digit($month) or ($month < 12)) ? true : false;
      }


      /**
       * Calendar::checkDay()
       * 
       * @param string $day
       * @return
       */
      private static function checkDay($day)
      {
          return ((strlen($day) == 2) or ctype_digit($day) or ($day < 31)) ? true : false;
      }
  }
?>