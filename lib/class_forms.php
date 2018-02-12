<?php
  /**
   * Forms Class
   *
   * @package SIM P4TK BMTI
   * @author a2ngsa
   * @copyright 2012
   * @version $Id: forms_class.php, v1.00 2011-12-20 10:12:05 gewa Exp $
   */
  
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
  
  class Forms
  {
	  const mTable = "forms";
	  const dTable = "forms_data";
	  public $dateformat = 'd MM, yy'; //default date format. For more options see http://docs.jquery.com/UI/Datepicker/formatDate
      protected $_container;
      public $_structure;
      protected $_str_serialized;
      protected $_hash;
	  public $fileInfo = array();
      
	  /**
       * Forms::__construct()
       * 
       * @return
       */
      public function __construct()
      {
		  
      }

	  
      /**
       * Forms::getForms()
       * 
       * @return
       */
      public function getForms()
      {
		  $sql = "SELECT *,"
		  ." \n DATE_FORMAT(created, '" . Registry::get("Core")->long_date . "') as cdate"
		  ." \n FROM " . self::mTable
		  . "\n ORDER BY created";
          $row = Registry::get("Database")->fetch_all($sql);
          
		  return ($row) ? $row : 0;
      }

      /**
       * Forms::getSingleForms()
       * 
	   * @param bool $form_id
       * @return
       */
      public function getSingleForms($form_id = false)
      {
		  $id = ($form_id) ? $form_id : Filter::$id;
		  
		  $sql = "SELECT * FROM " . self::mTable
		  . "\n WHERE id = '".(int)$id."'";
          $row = Registry::get("Database")->first($sql);
          
		  return ($row) ? $row : 0;
      }
	  
      /**
       * Forms::getFormData()
       * 
	   * @param bool $form_id
       * @return
       */
      public function getFormData($form_id = false)
      {
		  
		  $id = ($form_id) ? $form_id : Filter::$id;
		  
		  $sql = "SELECT form_data, form_hash"
		  ." \n FROM " . self::mTable
		  . "\n WHERE id = '".(int)$id."'";
          $row = Registry::get("Database")->first($sql);
		  
		  if($row) {
			$this->_container = $row;
			$this->_str_serialized = $row->form_data;
			$this->_hash = $this->hash();
			$this->_structure = $this->retrieve();
			$this->render_json();
		  }
      }

      /**
       * Forms::saveFormData()
       * 
       * @return
       */
      public function saveFormData()
      {
		  
		  if (empty($_POST['vfd']))
			  Filter::$msgs['vfd'] = lang('FORM_DATAERR');
			  			  			  		  
		  if (empty(Filter::$msgs)) {
              $this->_structure = $_POST['vfd'];
              $this->_str_serialized = $this->save();
              $this->rebuild();
			  $data = $this->save();
			  
			  Registry::get("Database")->update(self::mTable, $data, "id='" . Filter::$id . "'");
			  (Registry::get("Database")->affected()) ? Filter::msgOk(lang('FORM_DATASAVED')) :  Filter::msgAlert(lang('NOPROCCESS'));

		  } else
			   print Filter::msgStatus();
      }

      /**
       * Forms::processForm()
       * 
       * @return
       */
      public function processForm()
      {
		  
		  if (empty($_POST['title']))
			  Filter::$msgs['title'] = lang('FORM_NAME_R');

		  if (empty($_POST['sendmessage']))
			  Filter::$msgs['sendmessage'] = lang('FORM_MSG_R');

		  if (empty($_POST['submit_btn']))
			  Filter::$msgs['submit_btn'] = lang('FORM_BTN_R');
			  			  
		  if (empty($_POST['mailto']))
			  Filter::$msgs['mailto'] = lang('FORM_EMAIL_R');

		  if (!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/", $_POST['mailto']))
			  Filter::$msgs['mailto'] = lang('FORM_EMAIL_R1');
			  	  			  			  		  
		  if (empty(Filter::$msgs)) {

			  $data = array(
					  'title' => sanitize($_POST['title']), 
					  'template' => $_POST['template'],
					  'mailto' => sanitize($_POST['mailto']), 
					  'captcha' => intval($_POST['captcha']),
					  'sendmessage' => sanitize($_POST['sendmessage']),
					  'submit_btn' => sanitize($_POST['submit_btn'])
			  );
			  if (!Filter::$id) {
					$data['created'] = "NOW()";
			  }	
			  (Filter::$id) ? Registry::get("Database")->update(self::mTable, $data, "id='" . Filter::$id . "'") : Registry::get("Database")->insert(self::mTable, $data);
			  $message = (Filter::$id) ? lang('FORM_UPDATED') : lang('FORM_ADDED');
			  
			  (Registry::get("Database")->affected()) ? Filter::msgOk($message) :  Filter::msgAlert(lang('NOPROCCESS'));

		  } else
			  print Filter::msgStatus();
      }
	  	  	  	  	  
      /**
       * Forms::save()
       * 
       * @return
       */
      private function save()
      {
          $this->_str_serialized = serialize($this->_structure);
          $this->_hash = $this->hash($this->_str_serialized);
          return array('form_data' => $this->_str_serialized, 'form_hash' => $this->_hash);
      }
      /**
       * Forms::hash()
       * 
       * @return
       */
      private function hash()
      {
          return sha1($this->_str_serialized);
      }
	  
      /**
       * Forms::retrieve()
       * 
       * @return
       */
      private function retrieve()
      {
          if (is_object($this->_container) && array_key_exists('form_hash', $this->_container)) {
              if ($this->_container->form_hash == $this->hash($this->_container->form_data)) {
                  return unserialize($this->_container->form_data);
              }
          }
          return false;
      }
	  
      /**
       * Forms::render_json()
       * 
       * @return
       */
      private function render_json()
      {
          header("Content-Type: application/json");
          print $this->generate_json();
      }
	  
      /**
       * Forms::generate_json()
       * 
       * @return
       */
      private function generate_json()
      {
          return json_encode($this->_structure);
      }
	  
      /**
       * Forms::generate_html()
       * 
       * @return
       */
      public function generate_html($form_data)
      {
          $html = '';
		  $this->_structure = unserialize($form_data);
          if (is_array($this->_structure)) {
              $html .= '<div class="visual-form">';
              $html .= '<ul>' . "\n";
              foreach ($this->_structure as $field) {
                  $html .= $this->loadField($field);
              }
              $html .= '</ul>' . "\n";
              $html .= '</div>';
          }
          return $html;
      }
	  
      /**
       * Forms::showform()
       * 
	   * @param array $form_data
       * @return
       */
      public function showform($form_data)
      {
          $html = '';
		  $this->_structure = unserialize($form_data);
          if (is_array($this->_structure)) {
              $html .= '<table width="100%" cellpadding="3" cellspacing="3">' . "\n";
              foreach ($this->_structure as $field) {
                  $html .= $this->loadField($field, true);
              }
			  $html .= '<tr><td style="border-bottom:1px dotted rgb(102, 102, 102)">Senders IP:</td>
			  <td style="border-bottom:1px dotted rgb(102, 102, 102)">' . $_SERVER['REMOTE_ADDR'] . '</td></tr>' . "\n";
              $html .= '</table>' . "\n";
          }
          return $html;
      }
	  
      /**
       * Forms::process()
       * 
	   * @param array $form_data
       * @return
       */
	  public function process($form_data)
	  {
		  $results = array();
		  $this->_structure = unserialize($form_data);
		  
		  if (is_array($this->_structure)) {
			  //Filter::$msgs[] = '';
			  foreach ($this->_structure as $k => $field) {
				  $field['required'] = $field['required'] == 'checked' ? true : false;
				  if ($field['cssClass'] == 'input_text' || $field['cssClass'] == 'textarea' || $field['cssClass'] == 'datepicker') {
					  $val = $this->getPostValue($this->elemId($field['values']));
					  if ($field['required'] && empty($val)) {
						  Filter::$msgs[] .= lang('FORM_ERROR1').' "' . $field['values'] . '" ' . lang('FORM_ERROR2') . '</li>';
					  } else {
						  $results[$this->elemId($field['values'])] = $val;
					  }
				  } elseif ($field['cssClass'] == 'radio' || $field['cssClass'] == 'select') {
					  $val = $this->getPostValue($this->elemId($field['title']));
					  if ($field['required'] && empty($val)) {
						  Filter::$msgs[] .= lang('FORM_ERROR1').' "' . $field['title'] . '" ' . lang('FORM_ERROR3') . '/li>';
					  } else {
						  $results[$this->elemId($field['title'])] = $val;
					  }
				  } elseif ($field['cssClass'] == 'uploader') {
					  $uploadName = $this->elemId($field['values']);
					  if ($field['required'] && empty($_FILES[$uploadName]['name'])) {
						  Filter::$msgs[] .= lang('FORM_ERROR1').' "' . $field['values'] . '" ' . lang('FORM_ERROR3') . '</li>';
					  }
					  if (!empty($_FILES[$uploadName]['name']) and empty(Filter::$msgs)) {
						  $dir = UPLOADS . 'formdata/';
						  $this->upload($uploadName,$dir);
					  }
				  } elseif ($field['cssClass'] == 'checkbox') {
					  if (is_array($field['values'])) {
						  $at_least_one_checked = false;
						  foreach ($field['values'] as $item) {
							  $elem_id = $this->elemId($item['value'], $field['title']);
							  $val = $this->getPostValue($elem_id);
							  if (!empty($val)) {
								  $at_least_one_checked = true;
							  }
							  $results[$this->elemId($item['value'])] = $this->getPostValue($elem_id);
						  }
						  if (!$at_least_one_checked && $field['required']) {
							  Filter::$msgs[] .= lang('FORM_ERROR4').' "' . $field['title'] . '" ' . lang('FORM_ERROR5') . '</li>';
						  }
					  }
				  }
			  }
			  if (isset($_POST['has_captcha'])) {
				  if ($_POST['captcha'] == "")
					  Filter::$msgs[] = lang('FORM_ERROR6');
				  
				  if ($_SESSION['captchacode'] != $_POST['captcha'])
					  Filter::$msgs[] = lang('FORM_ERROR7');
			  }
			  if (empty(Filter::$msgs)) {
				  return array('results' => $results);
			  } else
				  print Filter::msgStatus();
		  }
	  }
      
      /**
       * Forms::loadField()
       * 
       * @param array $field
       * @param bool $is_html
       * @return
       */
      public function loadField($field, $is_html = false)
      {
          if (is_array($field) && isset($field['cssClass'])) {
              switch ($field['cssClass']) {
                  case 'input_text':
                      return($is_html) ? $this->renderInputText($field) : $this->loadInputText($field);
                      break;
                  case 'textarea':
                      return($is_html) ? $this->renderTextarea($field) : $this->loadTextarea($field);
                      break;
                  case 'checkbox':
                      return($is_html) ? $this->renderCheckboxGroup($field) : $this->loadCheckboxGroup($field);
                      break;
                  case 'radio':
                      return($is_html) ? $this->renderRadioGroup($field) : $this->loadRadioGroup($field);
                      break;
                  case 'select':
                      return($is_html) ? $this->renderSelectBox($field) : $this->loadSelectBox($field);
                      break;
                  case 'datepicker':
                      return($is_html) ? $this->renderDatepickerText($field) : $this->loadDatepickerText($field);
                      break;
                  case 'uploader':
                      return($is_html) ? $this->renderUploaderText($field) : $this->loadUploaderText($field);
                      break;
              }
          }
          return false;
      }
	  
      /**
       * Forms::loadInputText()
       * 
       * @param mixed $field
       * @return
       */
      protected function loadInputText($field)
      {
          $field['required'] = $field['required'] == 'checked' ? ' required' : false;
          $html = '';
          $html .= sprintf('<li class="%s%s" id="fld-%s">' . "\n", $this->elemId($field['cssClass']), $field['required'], $this->elemId($field['values']));
		  $html .= '<label for="'.$this->elemId($field['values']).'">'.$field['values'].'</label>' . "\n";
		  $html .= '<input type="text" id="'.$this->elemId($field['values']).'" name="'.$this->elemId($field['values']).'" value="'.$this->getPostValue($this->elemId($field['values'])).'" />' . "\n";
          $html .= '</li>' . "\n";
          return $html;
      }
	  
      /**
       * Forms::renderInputText()
       * 
       * @param mixed $field
       * @return
       */
      protected function renderInputText($field)
      {
          $html = '';
          $html .= '<tr>' . "\n";
          $html .= '<td style="border-bottom:1px dotted rgb(102, 102, 102)">';
          $html .= $field['values'];
          $html .= '</td><td style="border-bottom:1px dotted rgb(102, 102, 102)">';
          $html .= $this->getPostValue($this->elemId($field['values']));
          $html .= '</td>' . "\n";
          $html .= '</tr>' . "\n";
          return $html;
      }
	  
      /**
       * Forms::loadTextarea()
       * 
       * @param mixed $field
       * @return
       */
      protected function loadTextarea($field)
      {
          $field['required'] = $field['required'] == 'checked' ? ' required' : false;
          $html = '';
          $html .= sprintf('<li class="%s%s" id="fld-%s">' . "\n", $this->elemId($field['cssClass']), $field['required'], $this->elemId($field['values']));
          $html .= sprintf('<label for="%s">%s</label>' . "\n", $this->elemId($field['values']), $field['values']);
          $html .= sprintf('<textarea id="%s" name="%s" rows="5" cols="50">%s</textarea>' . "\n", $this->elemId($field['values']), $this->elemId($field['values']), $this->getPostValue($this->elemId($field['values'])));
          $html .= '</li>' . "\n";
          return $html;
      }
	  
      /**
       * Forms::renderTextarea()
       * 
       * @param mixed $field
       * @return
       */
      protected function renderTextarea($field)
      {
          $html = '';
          $html .= '<tr>' . "\n";
          $html .= '<td style="border-bottom:1px dotted rgb(102, 102, 102)">';
          $html .= $field['values'];
          $html .= '</td><td style="border-bottom:1px dotted rgb(102, 102, 102)">';
          $html .= $this->getPostValue($this->elemId($field['values']));
          $html .= '</td>' . "\n";
          $html .= '</tr>' . "\n";
          return $html;
      }
	  
      /**
       * Forms::loadCheckboxGroup()
       * 
       * @param mixed $field
       * @return
       */
      protected function loadCheckboxGroup($field)
      {
          $field['required'] = $field['required'] == 'checked' ? ' required' : false;
          $html = '';
          $html .= sprintf('<li class="%s%s" id="fld-%s">' . "\n", $this->elemId($field['cssClass']), $field['required'], $this->elemId($field['title']));
          if (isset($field['title']) && !empty($field['title'])) {
              $html .= sprintf('<span class="title-label">%s</span>' . "\n", $field['title']);
          }
          if (isset($field['values']) && is_array($field['values'])) {
              $html .= sprintf('<span class="multi-row">') . "\n";
              foreach ($field['values'] as $item) {
                  $val = $this->getPostValue($this->elemId($item['value']));
                  $checked = !empty($val);
                  $checked = $item['baseline'] == 'checked' ? ' checked="checked"' : '';
                  $checkbox = '<span class="rowspan"><input type="checkbox" id="%s-%s" name="%s-%s" value="%s"%s class="checkbox"/><label for="%s-%s">%s</label></span>' . "\n";
                  $html .= sprintf($checkbox, $this->elemId($field['title']), $this->elemId($item['value']), $this->elemId($field['title']), $this->elemId($item['value']), $item['value'], $checked, $this->elemId($field['title']), $this->elemId($item['value']), $item['value']);
              }
              $html .= sprintf('</span>') . "\n";
          }
          $html .= '</li>' . "\n";
          return $html;
      }
	  
      /**
       * Forms::renderCheckboxGroup()
       * 
       * @param mixed $field
       * @return
       */
      protected function renderCheckboxGroup($field)
      {
          $html = '';
          $html .= '<tr>' . "\n";
          $html .= '<td style="border-bottom:1px dotted rgb(102, 102, 102)">';
          if (isset($field['title']) && !empty($field['title'])) {
              $html .= $field['title'];
          }
          $html .= '</td><td style="border-bottom:1px dotted rgb(102, 102, 102)">';
          if (isset($field['values']) && is_array($field['values'])) {
              foreach ($field['values'] as $item) {
                  if (array_key_exists($this->elemId($field['title']) . '-' . $this->elemId($item['value']), $_POST)) {
                      $html .= $_POST[$this->elemId($field['title']) . '-' . $this->elemId($item['value'])] . ', ';
                  }
              }
              $html .= '</td>';
          }
          $html .= '</tr>' . "\n";
          return $html;
      }
	  
      /**
       * Forms::loadRadioGroup()
       * 
       * @param mixed $field
       * @return
       */
      protected function loadRadioGroup($field)
      {
          $field['required'] = $field['required'] == 'checked' ? ' required' : false;
          $html = '';
          $html .= sprintf('<li class="%s%s" id="fld-%s">' . "\n", $this->elemId($field['cssClass']), $field['required'], $this->elemId($field['title']));
          if (isset($field['title']) && !empty($field['title'])) {
              $html .= sprintf('<span class="title-label">%s</span>' . "\n", $field['title']);
          }
          if (isset($field['values']) && is_array($field['values'])) {
              $html .= sprintf('<span class="multi-row">') . "\n";
              foreach ($field['values'] as $item) {
                  $val = $this->getPostValue($this->elemId($field['title']));
                  $checked = !empty($val);
                  $checked = $item['baseline'] == 'checked' ? ' checked="checked"' : '';
                  $radio = '<span class="rowspan"><input type="radio" id="%s-%s" name="%1$s" value="%s"%s /><label for="%1$s-%2$s">%3$s</label></span>' . "\n";
                  $html .= sprintf($radio, $this->elemId($field['title']), $this->elemId($item['value']), $item['value'], $checked);
              }
              $html .= sprintf('</span>') . "\n";
          }
          $html .= '</li>' . "\n";
          return $html;
      }
	  
      /**
       * Forms::renderRadioGroup()
       * 
       * @param mixed $field
       * @return
       */
      protected function renderRadioGroup($field)
      {
          $html = '';
          $html .= '<tr>' . "\n";
          $html .= '<td style="border-bottom:1px dotted rgb(102, 102, 102)">';
          if (isset($field['title']) && !empty($field['title'])) {
              $html .= $field['title'];
          }
          $html .= '</td><td style="border-bottom:1px dotted rgb(102, 102, 102)">';
          if (isset($field['values']) && is_array($field['values'])) {
			  $html .= $this->getPostValue($this->elemId($field['title']));
              $html .= '</td>';
          }
          $html .= '</tr>' . "\n";
          return $html;
      }
	  
      /**
       * Forms::loadSelectBox()
       * 
       * @param mixed $field
       * @return
       */
      protected function loadSelectBox($field)

      {
          $field['required'] = $field['required'] == 'checked' ? ' required' : false;
          $html = '';
          $html .= sprintf('<li class="%sbox%s" id="fld-%s">' . "\n", $this->elemId($field['cssClass']), $field['required'], $this->elemId($field['title']));
          if (isset($field['title']) && !empty($field['title'])) {
              $html .= sprintf('<label for="%s">%s</label>' . "\n", $this->elemId($field['title']), $field['title']);
          }
          if (isset($field['values']) && is_array($field['values'])) {
              $multiple = $field['multiple'] == "checked" ? ' multiple="multiple"' : '';
              $html .= sprintf('<select name="%s[]" id="%s"%s>' . "\n", $this->elemId($field['title']), $this->elemId($field['title']), $multiple);
              foreach ($field['values'] as $item) {
                  $val = $this->getPostValue($this->elemId($field['title']));
                  $checked = !empty($val);
                  $checked = $item['baseline'] == 'checked' ? ' selected="selected"' : '';
                  $option = '<option value="%s"%s>%s</option>' . "\n";
                  $html .= sprintf($option, $item['value'], $checked, $item['value']);
              }
              $html .= '</select>' . "\n";
              $html .= '</li>' . "\n";
          }
          return $html;
      }
	  
      /**
       * Forms::renderSelectBox()
       * 
       * @param mixed $field
       * @return
       */
      protected function renderSelectBox($field)
      {
          $html = '';
          $html .= '<tr>' . "\n";
          $html .= '<td style="border-bottom:1px dotted rgb(102, 102, 102)">';
          if (isset($field['title']) && !empty($field['title'])) {
              $html .= $field['title'];
          }
          $html .= '</td><td style="border-bottom:1px dotted rgb(102, 102, 102)">';
          if (isset($field['values']) && is_array($field['values'])) {
              $multiple = $field['multiple'] == "checked" ? ' multiple="multiple"' : '';
              if (array_key_exists($this->elemId($field['title']), $_POST)) {
                  foreach ($_POST[$this->elemId($field['title'])] as $k => $item) {
                      $html .= $_POST[$this->elemId($field['title'])][$k] . ', ';
                  }
              }
              $html .= '</td>';
              $html .= '</tr>' . "\n";
          }
          return $html;
      }

      /**
       * Forms::loadDatepickerText()
       * 
       * @param mixed $field
       * @return
       */
      protected function loadDatepickerText($field)
      {
          $field['required'] = $field['required'] == 'checked' ? ' required' : false;
          $html = '';
          $html .= sprintf('<li class="%s%s" id="fld-%s">' . "\n", $this->elemId($field['cssClass']), $field['required'], $this->elemId($field['values']));
		  $html .= '<label for="'.$this->elemId($field['values']).'">'.$field['values'].'</label>' . "\n";
		  $html .= '<input type="text" id="'.$this->elemId($field['values']).'" class="pickdate" name="'.$this->elemId($field['values']).'" value="'.$this->getPostValue($this->elemId($field['values'])).'" />' . "\n";
          $html .= '</li>' . "\n";
          return $html;
      }
	  
      /**
       * Forms::renderDatepickerText()
       * 
       * @param mixed $field
       * @return
       */
      protected function renderDatepickerText($field)
      {
          $html = '';
          $html .= '<tr>' . "\n";
          $html .= '<td style="border-bottom:1px dotted rgb(102, 102, 102)">';
          $html .= $field['values'];
          $html .= '</td><td style="border-bottom:1px dotted rgb(102, 102, 102)">';
          $html .= $this->getPostValue($this->elemId($field['values']));
          $html .= '</td>' . "\n";
          $html .= '</tr>' . "\n";
          return $html;
      }

      /**
       * Forms::loadUploaderText()
       * 
       * @param mixed $field
       * @return
       */
      protected function loadUploaderText($field)
      {
          $field['required'] = $field['required'] == 'checked' ? ' required' : false;
          $html = '';
		  $fs = Registry::get("Core")->file_max/1048576;
          $html .= sprintf('<li class="%s%s" id="fld-%s">' . "\n", $this->elemId($field['cssClass']), $field['required'], $this->elemId($field['values']));
		  $html .= '<label for="'.$this->elemId($field['values']).'">'.$field['values'].'</label>' . "\n";
		  $html .= '<input type="file" id="'.$this->elemId($field['values']).'" class="pickfile fileinput mask" name="'.$this->elemId($field['values']).'" />' . "\n";
          $html .= '<br /><small>' . lang('CONF_AFT').': ' . Registry::get("Core")->file_types . ' | ' . lang('CONF_MFS').': ' . $fs . 'MB'.'</small></li>' . "\n";
          return $html;
      }
	  
      /**
       * Forms::renderUploaderText()
       * 
       * @param mixed $field
       * @return
       */
      protected function renderUploaderText($field)
      {
          $html = '';
          $html .= '<tr>' . "\n";
          $html .= '<td style="border-bottom:1px dotted rgb(102, 102, 102)">';
          $html .= $field['values'];
          $html .= '</td><td style="border-bottom:1px dotted rgb(102, 102, 102)">';
		  if(!empty($this->fileInfo)) {
			  $html .= '<a href="' . UPLOADURL . 'formdata/' . @$this->fileInfo['fname'].'">' . lang('FORM_DOWNLOAD') . '</a>' . "\n";
		  }
          $html .= '</td>' . "\n";
          $html .= '</tr>' . "\n";
          return $html;
      }
	  
      /**
       * Forms::elemId()
       * 
       * @param mixed $label
       * @param bool $prepend
       * @return
       */
      private function elemId($label, $prepend = false)
      {
          if (is_string($label)) {
              $prepend = is_string($prepend) ? $this->elemId($prepend) . '-' : false;
              return $prepend . strtolower(preg_replace("/[^A-Za-z0-9_]/", "", str_replace(" ", "_", $label)));
          }
          return false;
      }

      /**
       * Forms::rebuild()
       * 
       * @return
       */
      protected function rebuild()
      {
          $this->_container = array();
          $this->_container['form_hash'] = $this->_hash;
          $this->_container['form_data'] = $this->_str_serialized;
          return true;
      }
	  	  
      /**
       * Forms::getPostValue()
       * 
       * @param mixed $key
       * @return
       */
      protected function getPostValue($key)
      {
          return array_key_exists($key, $_POST) ? $_POST[$key] : false;
      }

      /**
       * Forms::getFormSubmittedData()
       * 
       * @return
       */
      public function getFormSubmittedData()
      {

		  $sql = "SELECT *, DATE_FORMAT(created, '" . Registry::get("Core")->long_date . "') as cdate"
		  . "\n FROM " . self::dTable 
		  . "\n WHERE form_id = '" . Filter::$id . "'"
		  . "\n ORDER BY created";
          $row = Registry::get("Database")->fetch_all($sql);
          
		  return ($row) ? $row : 0;
      }
	  
      /**
       * Forms::upload()
       * 
       * @param mixed $name
       * @param mixed $dir
       * @param bool $fname
	   * @param mixed $prefix
       * @return
       */
      public function upload($name, $dir, $prefix = 'SOURCE_', $fname = false)
      {
          if (!is_dir($dir)) {
			  Filter::$msgs['name'] = lang('FORM_ERROR12'); //Directory doesn't exist!
          }
          if ($this->check($name)) {
              if (!$fname) {
                  $this->fileInfo['fname'] = $prefix . randName() . '.' . $this->fileInfo['ext'];
              } else {
                  $this->fileInfo['fname'] = $fname;
              }
              while (file_exists($dir . $this->fileInfo['fname'])) {
                  $this->fileInfo['fname'] = $prefix . randName() . '.' . $this->fileInfo['ext'];
              }
              if (@!move_uploaded_file($this->fileInfo['temp'], $dir . $this->fileInfo['fname'])) {
				  Filter::$msgs['name'] = lang('FORM_ERROR13'); //File not moved
              }
          }
      }
	  
      /**
       * Uploader::check()
       * 
       * @param mixed $uploadName
       * @return
       */
      public function check($uploadName)
      {
          if (isset($_FILES[$uploadName])) {
              $this->fileInfo['ext'] = substr(strrchr($_FILES[$uploadName]["name"], '.'), 1);
              $this->fileInfo['name'] = basename($_FILES[$uploadName]["name"]);
              $this->fileInfo['size'] = $_FILES[$uploadName]["size"];
              $this->fileInfo['temp'] = $_FILES[$uploadName]["tmp_name"];
              if ($this->fileInfo['size'] < Registry::get("Core")->file_max) {
                  if (strlen(Registry::get("Core")->file_types) > 0) {
                      $exts = explode(',', Registry::get("Core")->file_types);
                      if (in_array(strtolower($this->fileInfo['ext']), $exts)) {
                          return true;
                      }
					  Filter::$msgs['name'] = lang('FORM_ERROR8') . Registry::get("Core")->file_types;
                      return false;

                  }
				  Filter::$msgs['name'] = lang('FORM_ERROR9') ;//no extension specified
                  return false;

              } else {
                  if (Registry::get("Core")->file_max < 1000000) {
                      $rsi = round(Registry::get("Core")->file_max / 1024, 2) . ' Kb';
                  } else
                      if (Registry::get("Core")->file_max < 1000000000) {
                          $rsi = round(Registry::get("Core")->file_max / 1048576, 2) . ' Mb';
                      } else {
                          $rsi = round(Registry::get("Core")->file_max / 1073741824, 2) . ' Gb';
                      }
					  Filter::$msgs['name'] = lang('FORM_ERROR10') . $rsi;
                  return false;
              }
          }
		  Filter::$msgs['name'] = lang('FORM_ERROR11');//Either form not submitted or file/s not found
          return false;

      }
  }
?>