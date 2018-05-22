<?php
  /**
   * Functions
   *
   * @package SIM P4TK BMTI
   * @author a2ngsa
   * @copyright 2012
   * @version $Id: functions.php, v1.00 2011-06-05 10:12:05 gewa Exp $
   */
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
  
  /**
   * redirect_to()
   * 
   * @param mixed $location
   * @return
   */
  function redirect_to($location)
  {
      if (!headers_sent()) {
          header('Location: ' . $location);
		  exit;
	  } else
          echo '<script type="text/javascript">';
          echo 'window.location.href="' . $location . '";';
          echo '</script>';
          echo '<noscript>';
          echo '<meta http-equiv="refresh" content="0;url=' . $location . '" />';
          echo '</noscript>';
  }
  
  /**
   * countEntries()
   * 
   * @param mixed $table
   * @param string $where
   * @param string $what
   * @return
   */
  function countEntries($table, $where = '', $what = '')
  {
      if (!empty($where) && isset($what)) {
          $q = "SELECT COUNT(*) FROM " . $table . "  WHERE " . $where . " = '" . $what . "' LIMIT 1";
      } else
          $q = "SELECT COUNT(*) FROM " . $table . " LIMIT 1";
      
      $record = Registry::get("Database")->query($q);
      $total = Registry::get("Database")->fetchrow($record);
      return $total[0];
  }
  
  /**
   * getChecked()
   * 
   * @param mixed $row
   * @param mixed $status
   * @return
   */
  function getChecked($row, $status)
  {
      if ($row == $status) {
          echo "checked=\"checked\"";
      }
  }
  
  /**
   * post()
   * 
   * @param mixed $var
   * @return
   */
  function post($var)
  {
      if (isset($_POST[$var]))
          return $_POST[$var];
  }
  
  /**
   * get()
   * 
   * @param mixed $var
   * @return
   */
  function get($var)
  {
      if (isset($_GET[$var]))
          return $_GET[$var];
  }
  
  /**
   * sanitize()
   * 
   * @param mixed $string
   * @param bool $trim
   * @return
   */
  function sanitize($string, $trim = false, $int = false, $str = false)
  {
      $string = filter_var($string, FILTER_SANITIZE_STRING);
      $string = trim($string);
      $string = stripslashes($string);
      $string = strip_tags($string);
      $string = str_replace(array('‘', '’', '“', '”'), array("'", "'", '"', '"'), $string);
      
	  if ($trim)
          $string = substr($string, 0, $trim);
      if ($int)
		  $string = preg_replace("/[^0-9\s]/", "", $string);
      if ($str)
		  $string = preg_replace("/[^a-zA-Z\s]/", "", $string);
		  
      return $string;
  }

  /**
   * cleanSanitize()
   * 
   * @param mixed $string
   * @param bool $trim
   * @return
   */
  function cleanSanitize($string, $trim = false,  $end_char = '&#8230;')
  {
	  $string = cleanOut($string);
      $string = filter_var($string, FILTER_SANITIZE_STRING);
      $string = trim($string);
      $string = stripslashes($string);
      $string = strip_tags($string);
      $string = str_replace(array('‘', '’', '“', '”'), array("'", "'", '"', '"'), $string);
      
	  if ($trim) {
        if (strlen($string) < $trim)
        {
            return $string;
        }

        $string = preg_replace("/\s+/", ' ', str_replace(array("\r\n", "\r", "\n"), ' ', $string));

        if (strlen($string) <= $trim)
        {
            return $string;
        }

        $out = "";
        foreach (explode(' ', trim($string)) as $val)
        {
            $out .= $val.' ';

            if (strlen($out) >= $trim)
            {
                $out = trim($out);
                return (strlen($out) == strlen($string)) ? $out : $out.$end_char;
            }       
        }
	  }
      return $string;
  }
  
  /**
   * getValue()
   * 
   * @param mixed $stwhatring
   * @param mixed $table
   * @param mixed $where
   * @return
   */
  function getValue($what, $table, $where)
  {
      $sql = "SELECT $what FROM $table WHERE $where";
      $row = Registry::get("Database")->first($sql);
      return ($row) ? $row->$what : '';
  }  
  
  /**
   * tooltip()
   * 
   * @param mixed $tip
   * @return
   */
  function tooltip($tip)
  {
      return '<img src="' . SITEURL . '/images/tip.png" alt="" class="tooltip" title="' . $tip . '" style="margin-left:5px"/>';
  }
  
  /**
   * required()
   * 
   * @return
   */
  function required()
  {
      return '<img src="' . SITEURL . '/images/required.png" alt="Required Field" class="tooltip" title="Required Field" />';
  }


  /**
   * getSize()
   * 
   * @param mixed $size
   * @param integer $precision
   * @param bool $long_name
   * @param bool $real_size
   * @return
   */
  function getSize($size, $precision = 2, $long_name = false, $real_size = true)
  {
      $base = $real_size ? 1024 : 1000;
      $pos = 0;
      while ($size > $base) {
          $size /= $base;
          $pos++;
      }
      $prefix = _getSizePrefix($pos);
      $size_name = $long_name ? $prefix . "bytes" : $prefix[0] . 'B';
      return round($size, $precision) . ' ' . ucfirst($size_name);
  }

  /**
   * _getSizePrefix()
   * 
   * @param mixed $pos
   * @return
   */  
  function _getSizePrefix($pos)
  {
      switch ($pos) {
          case 00:
              return "";
          case 01:
              return "kilo";
          case 02:
              return "mega";
          case 03:
              return "giga";
          default:
              return "?-";
      }
  }
    
  /**
   * stripTags()
   * 
   * @param mixed $start
   * @param mixed $end
   * @param mixed $string
   * @return
   */
  function stripTags($start, $end, $string)
  {
	  $string = stristr($string, $start);
	  $doend = stristr($string, $end);
	  return substr($string, strlen($start), -strlen($doend));
  }

  /**
   * cleanOut()
   * 
   * @param mixed $text
   * @return
   */
  function cleanOut($text) {
	 $text =  strtr($text, array('\r\n' => "", '\r' => "", '\n' => ""));
	 $text = html_entity_decode($text, ENT_QUOTES, 'UTF-8');
	 $text = str_replace('<br>', '<br />', $text);
	 return stripslashes($text);
  }
    
  /**
   * isActive()
   * 
   * @param mixed $id
   * @return
   */
  function isActive($id)
  {
	  if ($id == 1) {
		  $display = '<img src="images/yes.png" alt="" class="tooltip" title="Published"/>';
	  } else {
		  $display = '<img src="images/no.png" alt="" class="tooltip" title="Unpublished"/>';
	  }

      return $display;;
  }

  /**
   * randName()
   * 
   * @return
   */ 
  function randName() {
	  $code = '';
	  for($x = 0; $x<6; $x++) {
		  $code .= '-'.substr(strtoupper(sha1(rand(0,999999999999999))),2,6);
	  }
	  $code = substr($code,1);
	  return $code;
  }
  
  
  /**
   * getAge()
   * 
   * @return
  */ 
  function getAge ($birthday) {
        list($year,$month,$day) = explode("-", $birthday);
        $year_diff = date("Y") - $year;
        $month_diff = date("m") - $month;
        $day_diff = date("d") - $day;
        if ($month_diff < 0) 
            $year_diff--;
        elseif 
            (($month_diff==0) && ($day_diff < 0)) $year_diff--;
        
        return $year_diff;
  }  
  
  /**
   * getAge()
   * 
   * @return
  */   
  function highlight($txt,$word) {

    $char = stripos($txt, $word);
    if ($char !== false) {
      $repl = "<span class='blue'>" . substr($txt, $char, strlen($word))."</span>";
      return str_ireplace($word, $repl, $txt);
    } else
        return $txt;
        
  }  

  /**
   * setToSQLdate()
   * 
   * @param $str = dd/mm/yy
   * @return
  */   
  function setToSQLdate($str) {

	list($d, $m, $y) = explode("/", $str);
	return $y."-".$m."-".$d;
        
  }  

  /**
   * setToStrdate()
   * 
   * @param $str = Y-m-d
   * @return
  */   
  function setToStrdate($str) {

	//list($y, $m, $d) = explode("-", $str);
	//return $d."/".$m."/".$y;
        $adate = strtotime($str);
        if (!$adate)
            return '';
        else {
            $date = date('d/m/Y', $adate);
            return $date;
        }
        
  }  
 
  /**
   * setToStrLongdate()
   * 
   * @param $str = Y-m-d
   * @return
  */   
  function setToStrLongdate($str) {

	//list($y, $m, $d) = explode("-", $str);
	//return $d."/".$m."/".$y;
        $adate = strtotime($str);
        if (!$adate)
            return '';
        else {
            $date = date('d F Y', $adate);
            return $date;
        }
        
  }    
  
  /**
   * setToStrdatetime()
   * 
   * @param $str = Y-m-d
   * @return
  */   
  function setToStrdatetime($str) {

        $adate = strtotime($str);
        if (!$adate)
            return '';
        else {
            $date = date('d/m/Y', $adate);
            $time = date('H:i:s', $adate);
            return $date.' '.$time;
        }                
        
  }  
  
?>