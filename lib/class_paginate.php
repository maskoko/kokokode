<?php
  /**
   * Class Pagination
   *
   * @package SIM PPPPTK BMTI
   * @author a2ng
   * @copyright 2012
   * @version $Id: class_paginate.php, v2.00 2011-07-10 10:12:05 gewa Exp $
   */
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
  
  class Paginator
  {
      public $items_per_page;
      public $items_total;
      public $num_pages;
      public $limit;
      public $default_ipp;
	  public $path = 0;
      private $mid_range;
      private $low;
      private $high;
      private $retdata;
      private $querystring;
      private $current_page;
	  private static $instance; 
      
      
      /**
       * Paginator::__construct()
       * 
       * @return
       */
      private function __construct()
      {
          $this->current_page = 1;
          $this->mid_range = 7;
          $this->items_per_page = (isset($_GET['ipp']) and !empty($_GET['ipp'])) ? sanitize($_GET['ipp']) : $this->default_ipp;
      }

      /**
       * Paginator::instance()
       * 
       * @return
       */
	  public static function instance(){
		  if (!self::$instance){ 
			  self::$instance = new Paginator(); 
		  } 
	  
		  return self::$instance;  
	  }
	     
      /**
       * Paginator::paginate()
       * 
       * @param bool $path
       * @return
       */
      public function paginate()
      {	
          if (!is_numeric($this->items_per_page) || $this->items_per_page <= 0)
              $this->items_per_page = $this->default_ipp;
          $this->num_pages = ceil($this->items_total / $this->items_per_page);
          
          $this->current_page = intval(sanitize(get('pg')));
          if ($this->current_page < 1 or !is_numeric($this->current_page))
              $this->current_page = 1;
          if ($this->current_page > $this->num_pages)
              $this->current_page = $this->num_pages;
          $prev_page = $this->current_page - 1;
          $next_page = $this->current_page + 1;
          
          if ($_GET) {
              $args = explode("&amp;", $_SERVER['QUERY_STRING']);
              foreach ($args as $arg) {
                  $keyval = explode("=", $arg);
                  if ($keyval[0] != "pg" && $keyval[0] != "ipp")
                      $this->querystring .= "&amp;" . sanitize($arg);
              }
          }
          
          if ($_POST) {
              foreach ($_POST as $key => $val) {
                  if ($key != "pg" && $key != "ipp")
                      $this->querystring .= "&amp;$key=" . sanitize($val);
              }
          }
          
          if ($this->num_pages > 1) {
              if ($this->current_page != 1 && $this->items_total >= $this->default_ipp) {
                  if ($this->path) {
                      //$this->retdata = "<a href=\"".$path.$prev_page."-".$this->items_per_page.".html\">" . lang('PREV') . "</a>";
					  $this->retdata = "<li><a href=\"".$path.$prev_page."-".$this->items_per_page.".html\">&lsaquo;</a></li>";
                  } else {
                      //$this->retdata = "<a href=\"$_SERVER[PHP_SELF]?pg=$prev_page&amp;ipp=$this->items_per_page$this->querystring\"></a>";
                      $this->retdata = "<li><a href=\"$_SERVER[PHP_SELF]?pg=$prev_page&amp;ipp=$this->items_per_page$this->querystring\">&lsaquo;</a></li>";
                  }
              } else {
                  //$this->retdata = "<a href=\"#\" class=\"no-more\">" . lang('PREV') . "</a>";
                  $this->retdata = "<li><a href=\"#\">&lsaquo;</a></li>";
              }
              
              $this->start_range = $this->current_page - floor($this->mid_range / 2);
              $this->end_range = $this->current_page + floor($this->mid_range / 2);
              
              if ($this->start_range <= 0) {
                  $this->end_range += abs($this->start_range) + 1;
                  $this->start_range = 1;
              }
              if ($this->end_range > $this->num_pages) {
                  $this->start_range -= $this->end_range - $this->num_pages;
                  $this->end_range = $this->num_pages;
              }
              $this->range = range($this->start_range, $this->end_range);
              
              for ($i = 1; $i <= $this->num_pages; $i++) {
                  if ($this->range[0] > 2 && $i == $this->range[0])
                      $this->retdata .= " <li><span>...</span></li> ";

                  if ($i == 1 or $i == $this->num_pages or in_array($i, $this->range)) {
                      if ($i == $this->current_page) {
                          //$this->retdata .= "<a href=\"#\" title=\"" . lang('GOTO') . $i . lang('OF') . $this->num_pages . "\" class=\"current tooltip\">$i</a>";
                          $this->retdata .= "<li class=\"active\"><a href=\"#\" title=\"" . lang('GOTO') ."&nbsp;". $i . lang('OF') ."&nbsp;". $this->num_pages . "\" class=\"active\">$i</a></li>";
                      } else {
                          if ($this->path) {
                              //$this->retdata .= "<a class=\"tooltip\" title=\"Go To $i of $this->num_pages\" href=\"".$path.$i."-".$this->items_per_page.".html\">$i</a>";
                              $this->retdata .= "<li><a title=\"Go To $i of $this->num_pages\" href=\"".$path.$i."-".$this->items_per_page.".html\">$i</a></li>";
                          } else {
                              //$this->retdata .= "<a class=\"tooltip\" title=\"Go To $i of $this->num_pages\" href=\"$_SERVER[PHP_SELF]?pg=$i&amp;ipp=$this->items_per_page$this->querystring\">$i</a>";
                              $this->retdata .= "<li><a title=\"Go To $i of $this->num_pages\" href=\"$_SERVER[PHP_SELF]?pg=$i&amp;ipp=$this->items_per_page$this->querystring\">$i</a></li>";
                          }
                      }
                  }

                  if ($this->range[$this->mid_range - 1] < $this->num_pages - 1 && $i == $this->range[$this->mid_range - 1])
                      $this->retdata .= " <li><span>...</span></li> ";
              }

              if ($this->current_page != $this->num_pages && $this->items_total >= $this->default_ipp) {
                  if ($this->path) {
                      //$this->retdata .= "<a href=\"".$path.$next_page."-".$this->items_per_page.".html\">" . lang('NEXT') . "</a>\n";
                      $this->retdata .= "<li><a href=\"".$path.$next_page."-".$this->items_per_page.".html\">&rsaquo;</a></li>\n";
                  } else {
                      //$this->retdata .= "<a href=\"$_SERVER[PHP_SELF]?pg=$next_page&amp;ipp=$this->items_per_page$this->querystring\">" . lang('NEXT') . "</a>\n";
                      $this->retdata .= "<li><a href=\"$_SERVER[PHP_SELF]?pg=$next_page&amp;ipp=$this->items_per_page$this->querystring\">&rsaquo;</a></li>\n";
                  }
              } else {
                  //$this->retdata .= "<a href=\"#\" class=\"no-more\">" . lang('NEXT') . "</a>";
                  $this->retdata .= "<li><a href=\"#\" class=\"disable\">&rsaquo;</a></li>";
              }
			  
          } else {
              for ($i = 1; $i <= $this->num_pages; $i++) {
                  if ($i == $this->current_page) {
                      $this->retdata .= "<a href=\"#\" class=\"active\">$i</a>";
                  } else {
					  if ($this->path) {
						  $this->retdata .= "<a href=\"".$path . $i."-".$this->items_per_page.".html\">$i</a>";
					  } else {
                          $this->retdata .= "<a href=\"$_SERVER[PHP_SELF]?pg=$i&amp;ipp=$this->items_per_page$this->querystring\">$i</a>";
					  }
                  }
              }
          }
          $this->low = ($this->current_page - 1) * $this->items_per_page;
          $this->high = $this->current_page * $this->items_per_page - 1;
          $this->limit = ($this->items_total == 0) ? '' : " LIMIT $this->low,$this->items_per_page";
      }
      
      /**
       * Paginator::items_per_page()
       * 
       * @return
       */
      public function items_per_page()
      {
          $items = '';
          $ipp_array = array(10, 25, 50, 100);
          foreach ($ipp_array as $ipp_opt)
              $items .= ($ipp_opt == $this->items_per_page) ? "<option selected=\"selected\" value=\"$ipp_opt\">$ipp_opt</option>\n" : "<option value=\"$ipp_opt\">$ipp_opt</option>\n";
          //return ($this->num_pages >= 1) ? "<strong>" . lang('IPP') . "</strong>: <div class=\"mybox\"><select class=\"custombox\" style=\"width:80px\" onchange=\"window.location='$_SERVER[PHP_SELF]?pg=1&amp;ipp='+this[this.selectedIndex].value+'$this->querystring';return false\">$items</select></div>\n" : '';
          //return ($this->num_pages >= 1) ? "<div class=\"grid3\"><label>".lang('IPP')." :</label></div><div class=\"grid9\"><select onchange=\"window.location='$_SERVER[PHP_SELF]?pg=1&amp;ipp='+this[this.selectedIndex].value+'$this->querystring';return false\">$items</select></div>\n" : '';
          return ($this->num_pages >= 1) ? lang('IPP').":&nbsp;<select id=\"_ipp\" onchange=\"window.location='$_SERVER[PHP_SELF]?pg=1&amp;ipp='+this[this.selectedIndex].value+'$this->querystring';return false\">$items</select>\n" : '';
      }
      
      /**
       * Paginator::jump_menu()
       * 
       * @return
       */
      public function jump_menu()
      {
          $option = '';
          for ($i = 1; $i <= $this->num_pages; $i++) {
              $option .= ($i == $this->current_page) ? "<option value=\"$i\" selected=\"selected\">$i</option>\n" : "<option value=\"$i\">$i</option>\n";
          }
          //return ($this->num_pages >= 1) ? "<strong>" . lang('GOTO') . "</strong>&nbsp;:&nbsp;<div class=\"grid9\"><select onchange=\"window.location='$_SERVER[PHP_SELF]?pg='+this[this.selectedIndex].value+'&amp;ipp=$this->items_per_page$this->querystring';return false\">$option</select></div>\n" : '';
          return ($this->num_pages >= 1) ? lang('GOTO') . ":&nbsp;<select onchange=\"window.location='$_SERVER[PHP_SELF]?pg='+this[this.selectedIndex].value+'&amp;ipp=$this->items_per_page$this->querystring';return false\">$option</select>\n" : '';
      }
      
      /**
       * Paginator::display_pages()
       * 
       * @return
       */
      public function display_pages()
      {
          return($this->items_total > $this->items_per_page) ? '<div class="pagination" style="height: 10px;"><ul>' . $this->retdata . '</ul></div>' : "";
      }
  }
?>