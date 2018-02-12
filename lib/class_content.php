<?php
  /**
   * Content Class
   *
   * @package SIM PPPPTK BMTI
   * @author a2ng
   * @copyright 2012
   * @version $Id: class_content.php, v1.00 2011-06-05 10:12:05 gewa Exp $
   */
  
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');

  class Content
  {
      private static $db;


      /**
       * Content::__construct()
       * 
       * @return
       */
      public function __construct()
      {
          self::$db = Registry::get("Database");
      }
	  	  
      /* ---- SIM P4TK BMTI ------------------------------------------------------------------------------------------------------------------- */

      
       /**
       * Content::getModules()-------------------------------------------------------------------------------------------------------------
       * 
       * @return
       */
      public function getModules()
      {
          /*$pager = Paginator::instance();
          $pager->items_total = countEntries("golongan");
          $pager->default_ipp = Registry::get("Core")->perpage;
          $pager->paginate(); */

          $sql = "SELECT *"
                ."\n FROM modules"
                ."\n ORDER BY morder"; //.$pager->limit;
          $row = self::$db->fetch_all($sql);

          return ($row) ? $row : 0;
	  
      }
            
      /**
       * Content::getPropinsi()-------------------------------------------------------------------------------------------------------------
       * 
       * @return
       */
      public function getPropinsi()
      {

            $counter = countEntries("propinsi");

            $pager = Paginator::instance();
            $pager->items_total = $counter;
            $pager->default_ipp = Registry::get("Core")->perpage;
            $pager->paginate();
		  
            if (isset($_GET['sortfield'])) {
                $sortfield = sanitize($_GET['sortfield']);
                if (isset($_GET['sorttype']))
                    $sorttype = sanitize($_GET['sorttype']);
                else
                    $sorttype = "ASC";

                if (in_array($sortfield, array("kode", "nama_propinsi"))) {
                    $sort = ($sorttype == 'DESC') ? " DESC " : " ASC ";

                    $sqlorder = "LOWER(" . $sortfield . ") " . $sort;
                } else
                    $sqlorder = "LOWER(nama_propinsi)";
            } else
                $sqlorder = "LOWER(nama_propinsi)";
          
            $sql = "SELECT *"
                  . "\n FROM propinsi" 
                  . "\n ORDER BY " . $sqlorder . $pager->limit;
            
            $row = self::$db->fetch_all($sql);

            return ($row) ? $row : 0;
      }


      /**
       * Content::getPropinsiList()
       * 
       * @return
       */
      public function getPropinsiList()
      {	  
          $sql = "SELECT *"
                . "\n FROM propinsi" 
                . "\n ORDER BY nama_propinsi";
          $row = self::$db->fetch_all($sql);

          return ($row) ? $row : 0;
      }


      /**
       * Content::processAddPropinsi()
       * 
       * @return
       */
      public function processAddPropinsi()
      {

          if (empty($_POST['kode']))
              Filter::$msgs['kode'] = 'Silahkan masukkan Kode';

          if (empty($_POST['nama_propinsi']))
              Filter::$msgs['nama_propinsi'] = 'Silahkan masukkan nama Propinsi';
                    
          if (empty(Filter::$msgs)) {
              $data = array('kode' => sanitize($_POST['kode']),
                            'nama_propinsi' => sanitize($_POST['nama_propinsi']),
                            'source_name' => 'SIM',
                            'last_update' => 'NOW()',
                            'created' => 'NOW()',
                            'userid' => intval($_POST['userid']));
				
              self::$db->insert("propinsi", $data);
              $message = lang('DATA_ADDED');

              (self::$db->affected()) ? Filter::msgOk($message) : Filter::msgAlert(lang('NOPROCCESS'));
          } else
              print Filter::msgStatus();
      }

      /**
       * Content::processUpdatePropinsi()
       * 
       * @return
       */
      public function processUpdatePropinsi()
      {

          if (empty($_POST['kode']))
              Filter::$msgs['kode'] = 'Silahkan masukkan Kode';

          if (empty($_POST['nama_propinsi']))
              Filter::$msgs['nama_propinsi'] = 'Silahkan masukkan nama Propinsi';
                    
          if (empty(Filter::$msgs)) {
              $data = array('nama_propinsi' => sanitize($_POST['nama_propinsi']),
                            'last_update' => 'NOW()',
                            'userid' => intval($_POST['userid']));
				
              self::$db->update("propinsi", $data, "kode='" . Filter::$post['kode'] . "'");
              $message = lang('DATA_UPDATED');

              (self::$db->affected()) ? Filter::msgOk($message) : Filter::msgAlert(lang('NOPROCCESS'));
          } else
              print Filter::msgStatus();
      }
            
      /**
       * Content::getKota()-------------------------------------------------------------------------------------------------------------
       * 
       * @return
       */
      public function getKota($propinsi_kode = "")
      {

            if (isset($_GET['searchtext']))
                  $searchtext = strtolower(sanitize($_GET['searchtext']));
            else
                  $searchtext = '';

            if ($propinsi_kode != "") {
                $q = "SELECT count(*) FROM kota WHERE propinsi_kode = " . $propinsi_kode;
                $sqlwhere = "WHERE propinsi_kode = " . $propinsi_kode;

                if ($searchtext != '') {
                    $q .= " AND LOWER(nama_kota) LIKE '%" . $searchtext . "%'";
                    $sqlwhere .= " AND LOWER(nama_kota) LIKE '%" . $searchtext . "%'";
                    }

            } else {
                $q = "SELECT count(*) FROM kota";
                $sqlwhere = "";

                if ($searchtext != '') {
                    $q .= " WHERE LOWER(nama_kota) LIKE '%" . $searchtext . "%'";
                    $sqlwhere .= "WHERE LOWER(nama_kota) LIKE '%" . $searchtext . "%'";
                }
            }
            
            $record = Registry::get("Database")->query($q);
            $total = Registry::get("Database")->fetchrow($record);
            $counter = $total[0];

            $pager = Paginator::instance();
            $pager->items_total = $counter;
            $pager->default_ipp = Registry::get("Core")->perpage;
            $pager->paginate();
            
            if (isset($_GET['sortfield'])) {
                $sortfield = sanitize($_GET['sortfield']);
                if (isset($_GET['sorttype']))
                    $sorttype = sanitize($_GET['sorttype']);
                else
                    $sorttype = "ASC";

                if (in_array($sortfield, array("k.kode", "k.nama_kota", "p.nama_propinsi"))) {
                    $sort = ($sorttype == 'DESC') ? " DESC " : " ASC ";

                    $sqlorder = "LOWER(" . $sortfield . ") " . $sort;
                } else
                    $sqlorder = "LOWER(k.nama_kota)";
            } else
                $sqlorder = "LOWER(k.nama_kota)";
                    
            $sql = "SELECT k.*, p.nama_propinsi" 
                  . "\n FROM kota as k" 
                  . "\n LEFT JOIN propinsi as p ON k.propinsi_kode = p.kode" 
                  . "\n ". $sqlwhere
                  . "\n ORDER BY " .$sqlorder . $pager->limit;	  
            
            $row = self::$db->fetch_all($sql);

            return ($row) ? $row : 0;
      }

      /**
       * Content::getKotaList()
       * 
       * @return
       */
      public function getKotaList()
      {

          $sql = "SELECT kode, nama_kota" 
                . "\n FROM kota" 
                . "\n ORDER BY nama_kota";

          $row = self::$db->fetch_all($sql);

          return ($row) ? $row : 0;
      }

      /**
       * Content::getKotaByPropinsiList()
       * 
       * @return
       */
      public function getKotaByPropinsiList($propinsi_kode)
      {

     	  $sql = "SELECT kode, nama_kota" 
                . "\n FROM kota" 
                . "\n WHERE propinsi_kode = '".$propinsi_kode."'"
                . "\n ORDER BY nama_kota";
			
          $row = self::$db->fetch_all($sql);

          return ($row) ? $row : 0;
      }

	  
       /**
       * Content::processAddKota()
       * 
       * @return
       */
      public function processAddKota()
      {

          if (empty($_POST['kode']))
              Filter::$msgs['kode'] = 'Silahkan masukkan Kode!';
          
          if (empty($_POST['nama_kota']))
              Filter::$msgs['nama_kota'] = 'Silahkan masukkan Nama Kota!';

          if (empty($_POST['propinsi_kode']))
              Filter::$msgs['propinsi_kode'] = 'Silahkan pilih Propinsi!';

          if (empty($_POST['jenis']))
              Filter::$msgs['jenis'] = 'Silahkan pilih Jenis!';

          if (empty(Filter::$msgs)) {
              $data = array('kode' => sanitize($_POST['kode']), 
                            'nama_kota' => sanitize($_POST['nama_kota']), 
                            'propinsi_kode' => sanitize($_POST['propinsi_kode']), 
                            'jenis' => sanitize($_POST['jenis']), 
                            'source_name' => 'SIM',
                            'last_update' => 'NOW()',
                            'created' => 'NOW()',
                            'userid' => intval($_POST['userid']));

              self::$db->insert("kota", $data);
              $message = lang('DATA_ADDED');

              (self::$db->affected()) ? Filter::msgOk($message) : Filter::msgAlert(lang('NOPROCCESS'));
          } else
              print Filter::msgStatus();
      }

       /**
       * Content::processUpdateKota()
       * 
       * @return
       */
      public function processUpdateKota()
      {
          
          if (empty($_POST['kode']))
              Filter::$msgs['kode'] = 'Silahkan masukkan Kode!';
          
          if (empty($_POST['nama_kota']))
              Filter::$msgs['nama_kota'] = 'Silahkan masukkan Nama Kota!';

          if (empty($_POST['propinsi_kode']))
              Filter::$msgs['propinsi_kode'] = 'Silahkan pilih Propinsi!';

          if (empty($_POST['jenis']))
              Filter::$msgs['jenis'] = 'Silahkan pilih Jenis!';

          if (empty(Filter::$msgs)) {
              $data = array('nama_kota' => sanitize($_POST['nama_kota']), 
                            'propinsi_kode' => sanitize($_POST['propinsi_kode']), 
                            'jenis' => sanitize($_POST['jenis']), 
                            'last_update' => 'NOW()',
                            'userid' => intval($_POST['userid']));

              self::$db->update("kota", $data, "kode='" . Filter::$post['kode'] . "'");
              $message = lang('DATA_UPDATED');

              (self::$db->affected()) ? Filter::msgOk($message) : Filter::msgAlert(lang('NOPROCCESS'));
          } else
              print Filter::msgStatus();
        }
            
	  /**
	   * Content::KotaJenisList()
	   * 
	   * @param string $selected
	   * @return
	   */
	  public function KotaJenisList($selected = '')
	  {
        $arr = array('K' => 'K : Kota', 'B' => 'B : Kabupaten');

        $list = '';
        foreach ($arr as $key => $val) {
                $sel = ($key == $selected) ? ' selected="selected"' : '';
                $list .= "<option value=\"" . $key . "\"" . $sel . ">" . $val . "</option>\n";
        }
        unset($val);
        return $list;
	  }

      /**
       * Content::loadKotaList()
       * 
       * @param $propinsi_kode
       * @return
       */
	  public function loadKotaList($propinsi_kode, $firstall = false)
	  {

		  $pdata = $this->getKotaByPropinsiList($propinsi_kode);
		  
      if ($firstall)                      
		    print '<option value="" selected="selected">'.lang('SELECT_ALL').'</option>\n';
      else
        print '<option value="" selected="selected">'.lang('SELECT').'</option>\n';

		  if ($pdata) {
			foreach ($pdata as $prow) {
				print '<option value="'.$prow->kode.'">'.$prow->nama_kota.'</option>\n';
			}
			unset($prow); 
		  }

	  }

       /**
       * Content::getDepartemen()-------------------------------------------------------------------------------------------------------------
       * 
       * @return
       */
      public function getDepartemen()
      {
          
            $pager = Paginator::instance();
            $pager->items_total = countEntries("departemen");
            $pager->default_ipp = Registry::get("Core")->perpage;
            $pager->paginate();

            if (isset($_GET['sortfield'])) {
                $sortfield = sanitize($_GET['sortfield']);
                if (isset($_GET['sorttype']))
                    $sorttype = sanitize($_GET['sorttype']);
                else
                    $sorttype = "ASC";

                if (in_array($sortfield, array("kode", "nama_departemen"))) {
                    $sort = ($sorttype == 'DESC') ? " DESC " : " ASC ";

                    $sqlorder = "LOWER(" . $sortfield . ") " . $sort;
                } else
                    $sqlorder = "LOWER(nama_departemen)";
            } else
                $sqlorder = "LOWER(nama_departemen)";
                    
            $sql = "SELECT *"
                    ."\n FROM departemen"
                    ."\n ORDER BY " . $sqlorder . $pager->limit;
            
            $row = self::$db->fetch_all($sql);

            return ($row) ? $row : 0;
	  
      }

      /**
       * Content::getDepartemenList()
       * 
       * @return
       */
      public function getDepartemenList()
      {	  
          $sql = "SELECT *"
                . "\n FROM departemen" 
                . "\n ORDER BY nama_departemen ";
          $row = self::$db->fetch_all($sql);

          return ($row) ? $row : 0;
      }
	  	  
      /**
       * Content::processDepartemen()
       * 
       * @return
       */
      public function processDepartemen()
      {

          if (empty($_POST['nama_departemen']))
              Filter::$msgs['nama_departemen'] = 'Silahkan masukkan nama Departemen';

          if (empty(Filter::$msgs)) {
              $data = array('kode' => sanitize($_POST['kode']), 
							'nama_departemen' => sanitize($_POST['nama_departemen']), 
							'nama_pimpinan' => sanitize($_POST['nama_pimpinan']), 
							'last_update' => 'NOW()',
							'userid' => intval($_POST['userid']));

              if (!Filter::$id)
                  $data['created'] = "NOW()";				
							
              (Filter::$id) ? self::$db->update("departemen", $data, "id='" . Filter::$id . "'") : self::$db->insert("departemen", $data);
              $message = (Filter::$id) ? lang('DATA_UPDATED') : lang('DATA_ADDED');

              (self::$db->affected()) ? Filter::msgOk($message) : Filter::msgAlert(lang('NOPROCCESS'));
          } else
              print Filter::msgStatus();
      }

       /**
       * Content::getGolongan()-------------------------------------------------------------------------------------------------------------
       * 
       * @return
       */
      public function getGolongan()
      {
          $pager = Paginator::instance();
          $pager->items_total = countEntries("golongan");
          $pager->default_ipp = Registry::get("Core")->perpage;
          $pager->paginate();

          $sql = "SELECT *"
                ."\n FROM golongan"
                ."\n ORDER BY kode ".$pager->limit;
          $row = self::$db->fetch_all($sql);

          return ($row) ? $row : 0;
	  
      }

      /**
       * Content::getGolonganList()
       * 
       * @return
       */
      public function getGolonganList()
      {
	  
            $sql = "SELECT *"
                    . "\n FROM golongan" 
                    . "\n ORDER BY kode";
            $row = self::$db->fetch_all($sql);

            return ($row) ? $row : 0;
      }
	  	  
      /**
       * Content::processGolongan()
       * 
       * @return
       */
      public function processGolongan()
      {

          if (empty($_POST['kode']))
              Filter::$msgs['kode'] = 'Silahkan masukkan nama Golongan';

          if (empty(Filter::$msgs)) {
              $data = array('kode' => sanitize($_POST['kode']), 
                            'nama_pangkat' => sanitize($_POST['nama_pangkat']), 
                            'nama_fungsional' => sanitize($_POST['nama_fungsional']), 
                            'nama_widyaiswara' => sanitize($_POST['nama_widyaiswara']), 
                            'nama_struktural' => sanitize($_POST['nama_struktural']), 
                  
                            'last_update' => 'NOW()',
                            'userid' => intval($_POST['userid']));

              if (!Filter::$id)
                  $data['created'] = "NOW()";				
							
              (Filter::$id) ? self::$db->update("golongan", $data, "id='" . Filter::$id . "'") : self::$db->insert("golongan", $data);
              $message = (Filter::$id) ? lang('DATA_UPDATED') : lang('DATA_ADDED');

              (self::$db->affected()) ? Filter::msgOk($message) : Filter::msgAlert(lang('NOPROCCESS'));
          } else
              print Filter::msgStatus();
      }
                  
      /**
       * Content::getBSK()-------------------------------------------------------------------------------------------------------------
       * 
       * @return
       */
      public function getBSK()
      {
            $counter = countEntries("bsk");

            $pager = Paginator::instance();
            $pager->items_total = $counter;
            $pager->default_ipp = Registry::get("Core")->perpage;
            $pager->paginate();
		  	
            if (isset($_GET['sortfield'])) {
                $sortfield = sanitize($_GET['sortfield']);
                if (isset($_GET['sorttype']))
                    $sorttype = sanitize($_GET['sorttype']);
                else
                    $sorttype = "ASC";

                if (in_array($sortfield, array("kode", "nama_bidang"))) {
                    $sort = ($sorttype == 'DESC') ? " DESC " : " ASC ";

                    $sqlorder = "LOWER(" . $sortfield . ") " . $sort;
                } else
                    $sqlorder = "LOWER(nama_bidang)";
            } else
                $sqlorder = "LOWER(nama_bidang)";
                    
            $sql = "SELECT *" 
                  . "\n FROM bsk" 
                  . "\n ORDER BY " . $sqlorder . $pager->limit;	  
            $row = self::$db->fetch_all($sql);

            return ($row) ? $row : 0;
            
      }

      /**
       * Content::getBSKList()
       * 
       * @return
       */
      public function getBSKList()
      {

          $sql = "SELECT id, nama_bidang" 
                . "\n FROM bsk" 
                . "\n ORDER BY nama_bidang";

          $row = self::$db->fetch_all($sql);

          return ($row) ? $row : 0;
      }
	  
	  /**
       * Content::processBSK()
       * 
       * @return
       */
      public function processBSK()
      {
          if (empty($_POST['kode']))
              Filter::$msgs['kode'] = 'Silahkan masukkan Kode';
			  
          if (empty($_POST['nama_bidang']))
              Filter::$msgs['nama_bidang'] = 'Silahkan masukkan Nama Bidang Keahlian';

          if (empty(Filter::$msgs)) {
              $data = array('kode' => sanitize($_POST['kode']), 
                            'nama_bidang' => sanitize($_POST['nama_bidang']), 
                            'last_update' => 'NOW()',
                            'userid' => intval($_POST['userid']));

              if (!Filter::$id)
                  $data['created'] = "NOW()";											
							
              (Filter::$id) ? self::$db->update("bsk", $data, "id='" . Filter::$id . "'") : self::$db->insert("bsk", $data);
              $message = (Filter::$id) ? lang('DATA_UPDATED') : lang('DATA_ADDED');

              (self::$db->affected()) ? Filter::msgOk($message) : Filter::msgAlert(lang('NOPROCCESS'));
          } else
              print Filter::msgStatus();
      }

      /**
       * Content::getPSK($bskid = 0)-------------------------------------------------------------------------------------------------------------
       * 
       * @return
       */
      public function getPSK($bskid = 0)
      {
        
        if (isset($_GET['searchtext']))
              $searchtext = strtolower(sanitize($_GET['searchtext']));
        else
              $searchtext = '';
                
        if ($bskid > 0) {
            $q = "SELECT count(*) FROM psk WHERE bskid = " . $bskid;
            $sqlwhere = "WHERE bskid = " . $bskid;

            if ($searchtext != '') {
                $q .= " AND LOWER(nama_program) LIKE '%" . $searchtext . "%'";
                $sqlwhere .= " AND LOWER(nama_program) LIKE '%" . $searchtext . "%'";
                }
                      
        } else {
            $q = "SELECT count(*) FROM psk";
            $sqlwhere = "";

            if ($searchtext != '') {
                $q .= " WHERE LOWER(nama_program) LIKE '%" . $searchtext . "%'";
                $sqlwhere .= "WHERE LOWER(nama_program) LIKE '%" . $searchtext . "%'";
            }
        }
        
        $record = Registry::get("Database")->query($q);
        $total = Registry::get("Database")->fetchrow($record);
        $counter = $total[0];

        $pager = Paginator::instance();
        $pager->items_total = $counter;
        $pager->default_ipp = Registry::get("Core")->perpage;
        $pager->paginate();

        if (isset($_GET['sortfield'])) {
            $sortfield = sanitize($_GET['sortfield']);
            if (isset($_GET['sorttype']))
                $sorttype = sanitize($_GET['sorttype']);
            else
                $sorttype = "ASC";

            if (in_array($sortfield, array("p.kode", "p.nama_program", "b.nama_bidang"))) {
                $sort = ($sorttype == 'DESC') ? " DESC " : " ASC ";

                $sqlorder = "LOWER(" . $sortfield . ") " . $sort;
            } else
                $sqlorder = "LOWER(p.nama_program)";
        } else
            $sqlorder = "LOWER(p.nama_program)";
                
        if ($bskid == 0)
            $sql = "SELECT p.*, b.nama_bidang" 
             . "\n FROM psk as p" 
             . "\n LEFT JOIN bsk as b ON p.bskid = b.id"
             . "\n ". $sqlwhere
             . "\n ORDER BY " . $sqlorder . $pager->limit;
        else
            $sql = "SELECT p.*, b.nama_bidang" 
             . "\n FROM psk as p" 
             . "\n LEFT JOIN bsk as b ON p.bskid = b.id" 
             . "\n ". $sqlwhere
             . "\n ORDER BY " . $sqlorder . $pager->limit;
        
        $row = self::$db->fetch_all($sql);

        return ($row) ? $row : 0;
        
      }

      /**
       * Content::getPSKList($bskid)
       * 
       * @return
       */
      public function getPSKList($bskid = 0)
      {

            if ($bskid != 0)
              $sql = "SELECT id, nama_program" 
                . "\n FROM psk" 
                . "\n WHERE bskid = ".$bskid 
                . "\n ORDER BY nama_program";
            else
              $sql = "SELECT id, nama_program" 
                . "\n FROM psk" 
                . "\n ORDER BY nama_program";

            $row = self::$db->fetch_all($sql);

            return ($row) ? $row : 0;
      }

      /**
       * Content::getPSKByBSKList()
       * 
       * @return
       */
      public function getPSKByBSKList($bskid)
      {

     	  $sql = "SELECT id, kode, nama_program" 
		    . "\n FROM psk" 
		    . "\n WHERE bskid = '".$bskid."'"
		    . "\n ORDER BY nama_program";
			
          $row = self::$db->fetch_all($sql);

          return ($row) ? $row : 0;
      }
	  	  
      /**
       * Content::loadPSKList()
       * 
       * @param $bskid
       * @return
       */
	  public function loadPSKList($bskid, $firstall = false)
	  {

		  $pdata = $this->getPSKByBSKList($bskid);
		 
      if ($firstall) 
		    print '<option value="" selected="selected">'.lang('SELECT_ALL').'</option>\n';
      else
        print '<option value="" selected="selected">'.lang('SELECT').'</option>\n';

		  if ($pdata) {
			foreach ($pdata as $prow) {
				print '<option value="'.$prow->id.'">'.$prow->nama_program.'</option>\n';
			}
			unset($prow); 
		  }

	  }

	  
	  /**
       * Content::processPSK()
       * 
       * @return
       */
      public function processPSK()
      {
          if (empty($_POST['kode']))
              Filter::$msgs['kode'] = 'Silahkan masukkan Kode';
			  
          if (empty($_POST['nama_program']))
              Filter::$msgs['nama_program'] = 'Silahkan masukkan Nama Program Keahlian';

          if (empty($_POST['bskid']))
              Filter::$msgs['bskid'] = 'Silahkan pilih Bidang Studi';

          if (empty(Filter::$msgs)) {
              $data = array('kode' => sanitize($_POST['kode']), 
                            'nama_program' => sanitize($_POST['nama_program']), 
                            'bskid' => intval($_POST['bskid']), 
                            'last_update' => 'NOW()',
                            'userid' => intval($_POST['userid']));

              if (!Filter::$id)
                  $data['created'] = "NOW()";											
							
              (Filter::$id) ? self::$db->update("psk", $data, "id='" . Filter::$id . "'") : self::$db->insert("psk", $data);
              $message = (Filter::$id) ? lang('DATA_UPDATED') : lang('DATA_ADDED');

              (self::$db->affected()) ? Filter::msgOk($message) : Filter::msgAlert(lang('NOPROCCESS'));
          } else
              print Filter::msgStatus();
      }

      /**
       * Content::getKK($pskid = 0)-------------------------------------------------------------------------------------------------------------
       * 
       * @return
       */
      public function getKK($pskid = 0)
      {
                  
        if (isset($_GET['searchtext']))
              $searchtext = strtolower(sanitize($_GET['searchtext']));
        else
              $searchtext = '';
                
        if ($pskid > 0) {
            $q = "SELECT count(*) FROM kk WHERE pskid = " . $pskid;
            $sqlwhere = "WHERE k.pskid = " . $pskid;

            if ($searchtext != '') {
                $q .= " AND LOWER(nama_kompetensi) LIKE '%" . $searchtext . "%'";
                $sqlwhere .= " AND LOWER(k.nama_kompetensi) LIKE '%" . $searchtext . "%'";
                }
                      
        } else {
            $q = "SELECT count(*) FROM kk";
            $sqlwhere = "";

            if ($searchtext != '') {
                $q .= " WHERE LOWER(nama_kompetensi) LIKE '%" . $searchtext . "%'";
                $sqlwhere .= "WHERE LOWER(k.nama_kompetensi) LIKE '%" . $searchtext . "%'";
            }
        }
        
        $record = Registry::get("Database")->query($q);
        $total = Registry::get("Database")->fetchrow($record);
        $counter = $total[0];

        $pager = Paginator::instance();
        $pager->items_total = $counter;
        $pager->default_ipp = Registry::get("Core")->perpage;
        $pager->paginate();
                    	
        if (isset($_GET['sortfield'])) {
            $sortfield = sanitize($_GET['sortfield']);
            if (isset($_GET['sorttype']))
                $sorttype = sanitize($_GET['sorttype']);
            else
                $sorttype = "ASC";

            if (in_array($sortfield, array("k.kode", "k.nama_kompetensi", "p.nama_program", "d.nama_departemen"))) {
                $sort = ($sorttype == 'DESC') ? " DESC " : " ASC ";

                $sqlorder = "LOWER(" . $sortfield . ") " . $sort;
            } else
                $sqlorder = "LOWER(k.nama_kompetensi)";
        } else
            $sqlorder = "LOWER(k.nama_kompetensi)";
                
        if ($pskid == 0)
              $sql = "SELECT k.*," 
               . "\n p.nama_program," 
               . "\n d.nama_departemen"
               . "\n FROM (kk as k" 
               . "\n LEFT JOIN psk as p ON k.pskid = p.id)" 
               . "\n LEFT JOIN departemen as d ON k.departemenid = d.id" 
               . "\n " . $sqlwhere 
               . "\n ORDER BY " . $sqlorder . $pager->limit;
        else
              $sql = "SELECT k.*,"
               . "\n p.nama_program," 
               . "\n d.nama_departemen" 
               . "\n FROM (kk as k" 
               . "\n LEFT JOIN psk as p ON k.pskid = p.id)" 
               . "\n LEFT JOIN departemen as d ON k.departemenid = d.id" 
               . "\n " . $sqlwhere
               . "\n ORDER BY " . $sqlorder . $pager->limit;	  

        $row = self::$db->fetch_all($sql);

        return ($row) ? $row : 0;
      }

      /**
       * Content::getKKList()
       * 
       * @return
       */
      public function getKKList()
      {

            $sql = "SELECT id, nama_kompetensi" 
              . "\n FROM kk" 
              . "\n ORDER BY nama_kompetensi";


            $row = self::$db->fetch_all($sql);

            return ($row) ? $row : 0;
      }

      /**
       * Content::getKKByPSKList()
       * 
       * @return
       */
      public function getKKByPSKList($pskid)
      {

     	  $sql = "SELECT id, kode, nama_kompetensi" 
		    . "\n FROM kk" 
		    . "\n WHERE pskid = '".$pskid."'"
		    . "\n ORDER BY nama_kompetensi";
			
          $row = self::$db->fetch_all($sql);

          return ($row) ? $row : 0;
      }
	  	  
      /**
       * Content::loadPSKList()
       * 
       * @param $pskid
       * @return
       */
	  public function loadKKList($pskid, $firstall = false)
	  {

		  $pdata = $this->getKKByPSKList($pskid);
		  
      if ($firstall)
		    print '<option value="" selected="selected">'.lang('SELECT_ALL').'</option>\n';
      else
        print '<option value="" selected="selected">'.lang('SELECT').'</option>\n';

		  if ($pdata) {
			foreach ($pdata as $prow) {
				print '<option value="'.$prow->id.'">'.$prow->nama_kompetensi.'</option>\n';
			}
			unset($prow); 
		  }

	  }
	  
	  /**
       * Content::processKK()
       * 
       * @return
       */
      public function processKK()
      {
          if (empty($_POST['kode']))
              Filter::$msgs['kode'] = 'Silahkan masukkan Kode';
			  
          if (empty($_POST['nama_kompetensi']))
              Filter::$msgs['nama_kompetensi'] = 'Silahkan masukkan Nama Paket Keahlian';

          if (empty($_POST['pskid']))
              Filter::$msgs['pskid'] = 'Silahkan pilih Program Keahlian';

          if (empty($_POST['departemenid']))
              Filter::$msgs['departemenid'] = 'Silahkan pilih Departemen';
                    
          if (empty(Filter::$msgs)) {
              $data = array('kode' => sanitize($_POST['kode']), 
                            'nama_kompetensi' => sanitize($_POST['nama_kompetensi']), 
                            'pskid' => intval($_POST['pskid']), 
                            'departemenid' => intval($_POST['departemenid']), 
                            'last_update' => 'NOW()',
                            'userid' => intval($_POST['userid']));

              if (!Filter::$id)
                  $data['created'] = "NOW()";				
														
              (Filter::$id) ? self::$db->update("kk", $data, "id='" . Filter::$id . "'") : self::$db->insert("kk", $data);
              $message = (Filter::$id) ? lang('DATA_UPDATED') : lang('DATA_ADDED');

              (self::$db->affected()) ? Filter::msgOk($message) : Filter::msgAlert(lang('NOPROCCESS'));
          } else
              print Filter::msgStatus();
      }
	  	  	  
      /**
       * Content::getSekolah_Jenis()-------------------------------------------------------------------------------------------------------------
       * 
       * @return
       */
      public function getSekolah_Jenis()
      {

          $counter = countEntries("sekolah_jenis");

          $pager = Paginator::instance();
          $pager->items_total = $counter;
          $pager->default_ipp = Registry::get("Core")->perpage;
          $pager->paginate();
		  
          $sql = "SELECT *"
                . "\n FROM sekolah_jenis" 
                . "\n ORDER BY nama_jenis " . $pager->limit;
          $row = self::$db->fetch_all($sql);

          return ($row) ? $row : 0;
      }
	  
	  
      /**
       * Content::getSekolah_JenisList()
       * 
       * @return
       */
      public function getSekolah_JenisList()
      {
          $sql = "SELECT *"
                ."\n FROM sekolah_jenis"
                ."\n ORDER BY nama_jenis";
				 
          $row = self::$db->fetch_all($sql);

          return ($row) ? $row : 0;
      }
	  
	  
      /**
       * Content::processSekolah_Jenis()
       * 
       * @return
       */
      public function processSekolah_Jenis()
      {

          if (empty($_POST['nama_jenis']))
              Filter::$msgs['nama_jenis'] = 'Silahkan masukkan Nama Jenis';

          if (empty(Filter::$msgs)) {
              $data = array('nama_jenis' => sanitize($_POST['nama_jenis']),
                            'last_update' => 'NOW()',
                            'userid' => intval($_POST['userid']));

              if (!Filter::$id)
                  $data['created'] = "NOW()";				
			  			 
              (Filter::$id) ? self::$db->update("sekolah_jenis", $data, "id='" . Filter::$id . "'") : self::$db->insert("sekolah_jenis", $data);
              $message = (Filter::$id) ? lang('DATA_UPDATED') : lang('DATA_ADDED');

              (self::$db->affected()) ? Filter::msgOk($message) : Filter::msgAlert(lang('NOPROCCESS'));
          } else
              print Filter::msgStatus();
      }


       /**
       * Content::getSekolah()-------------------------------------------------------------------------------------------------------------
       * 
       * @return
       */
      public function getSekolah()
      {
          
        if (isset($_GET['propinsi_kode']))
              $propinsi_kode = sanitize($_GET['propinsi_kode']);
        else
              $propinsi_kode = '';

        if (isset($_GET['kota_kode']))
              $kota_kode = sanitize($_GET['kota_kode']);
        else
              $kota_kode = '';

        if (isset($_GET['searchfield']))
              $searchfield = strtolower(sanitize($_GET['searchfield']));
        else
              $searchfield = '';
        
        if (isset($_GET['searchtext']))
              $searchtext = strtolower(sanitize($_GET['searchtext']));
        else
              $searchtext = '';
                
        if ($propinsi_kode != '') {
              if ($kota_kode != '') {
                $q = "SELECT count(*) FROM sekolah WHERE propinsi_kode = '" . $propinsi_kode . "' AND kota_kode = '" . $kota_kode . "'";
                $sqlwhere = "WHERE s.propinsi_kode = '" . $propinsi_kode . "' AND s.kota_kode = '" . $kota_kode . "'";
                
                if (($searchfield != '') && ($searchtext != '')) {
                    $q .= " AND LOWER(" . $searchfield . ") LIKE '%" . $searchtext . "%'";
                    $sqlwhere .= " AND LOWER(s." . $searchfield . ") LIKE '%" . $searchtext . "%'";
                }

              } else {
                $q = "SELECT count(*) FROM sekolah WHERE propinsi_kode = '" . $propinsi_kode . "'";
                $sqlwhere = "WHERE s.propinsi_kode = '" . $propinsi_kode ."'";
                      
                if (($searchfield != '') && ($searchtext != '')) {
                    $q .= " AND LOWER(" . $searchfield . ") LIKE '%" . $searchtext . "%'";
                    $sqlwhere .= " AND LOWER(s." . $searchfield . ") LIKE '%" . $searchtext . "%'";
                }
                      
              }
        } else {
              if ($kota_kode != '') {
                $q = "SELECT count(*) FROM sekolah WHERE kota_kode = '" . $kota_kode . "'";
                $sqlwhere = "WHERE s.kota_kode = '" . $kota_kode . "'";
                      
                if (($searchfield != '') && ($searchtext != '')) {
                    $q .= " AND LOWER(" . $searchfield . ") LIKE '%" . $searchtext . "%'";
                    $sqlwhere .= " AND LOWER(s." . $searchfield . ") LIKE '%" . $searchtext . "%'";
                }
                      
              } else {
                $q = "SELECT count(*) FROM sekolah";
                $sqlwhere = "";
                
                if (($searchfield != '') && ($searchtext != '')) {
                    $q .= " WHERE LOWER(" . $searchfield . ") LIKE '%" . $searchtext . "%'";
                    $sqlwhere .= "WHERE LOWER(s." . $searchfield . ") LIKE '%" . $searchtext . "%'";
                }
                
              }
        }

        $record = Registry::get("Database")->query($q);
        $total = Registry::get("Database")->fetchrow($record);
        $counter = $total[0];

        $pager = Paginator::instance();
        $pager->items_total = $counter;
        $pager->default_ipp = Registry::get("Core")->perpage;
        $pager->paginate();

        if (isset($_GET['sortfield'])) {
            $sortfield = sanitize($_GET['sortfield']);
            if (isset($_GET['sorttype']))
                $sorttype = sanitize($_GET['sorttype']);
            else
                $sorttype = "ASC";

            if (in_array($sortfield, array("s.nss", "s.nama_sekolah", 
                                           "sj.nama_jenis", "p.nama_propinsi",
                                           "k.nama_kota"))) {
                $sort = ($sorttype == 'DESC') ? " DESC " : " ASC ";

                $sqlorder = "LOWER(" . $sortfield . ") " . $sort;
            } else
                $sqlorder = "LOWER(s.nama_sekolah)";
        } else
            $sqlorder = "LOWER(s.nama_sekolah)";
                
        $sql = "SELECT s.id, s.nss, s.nama_sekolah, s.propinsi_kode, s.kota_kode, s.jenisid, s.source_id, s.nama_pimpinan, s.ptkid," 
                . "\n sj.nama_jenis," 
                . "\n p.nama_propinsi," 
                . "\n k.nama_kota" 
                . "\n FROM ((sekolah as s" 
                . "\n LEFT JOIN sekolah_jenis as sj ON s.jenisid = sj.id)" 
                . "\n LEFT JOIN propinsi as p ON s.propinsi_kode = p.kode)" 
                . "\n LEFT JOIN kota as k ON s.kota_kode = k.kode" 
                . "\n $sqlwhere" 
                . "\n ORDER BY " . $sqlorder . $pager->limit;

        $row = self::$db->fetch_all($sql);

        return ($row) ? $row : 0;
	  
      }

     /**
       * Content::getSekolahList($propinsikode, $kota_kode)-------------------------------------------------------------------------------------------------------------
       * 
       * @return
       */
      public function getSekolahList($propinsi_kode, $kota_kode)
      {
          if ($propinsi_kode != "")
              $sqlwhere = "propinsi_kode = '" . $propinsi_kode . "'";
          else
              $sqlwhere = "";
          
          if ($kota_kode != "") {
              if ($sqlwhere != "")
                $sqlwhere .= " AND kota_kode = '" . $kota_kode . "'";
              else
                $sqlwhere = "kota_kode = '" . $kota_kode . "'";
          }
          
          $sql = "SELECT id, nama_sekolah"
                ."\n FROM sekolah"
                ."\n WHERE ". $sqlwhere
                ."\n ORDER BY nama_sekolah";
		
          $row = self::$db->fetch_all($sql);

          return ($row) ? $row : 0;
      }
	 
      /**
       * Content::loadSekolahList()
       * 
       * @param $propinsi_kode, $kota_kode
       * @return
       */
        public function loadSekolahList($propinsi_kode, $kota_kode)
        {

                $pdata = $this->getSekolahList($propinsi_kode, $kota_kode);

                print '<option value="" selected="selected">'.lang('SELECT').'</option>\n';

                if ($pdata) {
                      foreach ($pdata as $prow) {
                              print '<option value="'.$prow->id.'">'.$prow->nama_sekolah.'</option>\n';
                      }
                      unset($prow); 
                }

        }
            
      /**
       * Users::checkSekolah_NSS()
       * 
       * @param mixed $nss, $sekolahid
       * @return
       */
      private function checkSekolah_NSS($nss, $sekolahid)
      {
          $nss = sanitize($nss);
          if (strlen(self::$db->escape($nss)) < 12)
              return 1; // -- digit kurang --

          // -- check apa numerik semua ? --

          if ($sekolahid > 0)
            $sql = self::$db->query("SELECT id FROM sekolah WHERE nss = '" . $nss . "' AND id <> " . $sekolahid ." LIMIT 1");
          else
            $sql = self::$db->query("SELECT id FROM sekolah WHERE nss = '" . $nss . "' LIMIT 1");
                
          $count = self::$db->numrows($sql);
          
          return ($count > 0) ? 3 : false;
      }

      /**
       * Users::checkSekolah_NPSN()
       * 
       * @param mixed $npsn, $sekolahid
       * @return
       */
      private function checkSekolah_NPSN($npsn, $sekolahid)
      {
          $npsn = sanitize($npsn);
          if (strlen(self::$db->escape($npsn)) < 8)
              return 1; // -- digit kurang --

          // -- check apa numerik semua ? --

          if ($sekolahid > 0)
            $sql = self::$db->query("SELECT id FROM sekolah WHERE npsn = '" . $npsn . "' AND id <> " . $sekolahid ." LIMIT 1");
          else
            $sql = self::$db->query("SELECT id FROM sekolah WHERE npsn = '" . $npsn . "' LIMIT 1");
                
          $count = self::$db->numrows($sql);
          
          return ($count > 0) ? 3 : false;
      }
                        
      /**
       * Content::processUpdateSekolah()
       * 
       * @return
       */
      public function processUpdateSekolah()
      {

          if (empty($_POST['nama_sekolah']))
              Filter::$msgs['nama_sekolah'] = 'Silahkan masukkan Nama Sekolah';

          if (empty($_POST['jenisid']))
              Filter::$msgs['jenisid'] = 'Silahkan pilih Jenis Sekolah';

          if (empty($_POST['nss']))
              Filter::$msgs['nss'] = 'Silahkan masukkan NSS';

            if ($value = $this->checkSekolah_NSS($_POST['nss'], Filter::$id)) {
                if ($value == 1)
                    Filter::$msgs['nss'] = 'Jumlah digit NSS kurang dari 13 karakter!';
                if ($value == 2)
                    Filter::$msgs['nss'] = 'NSS tidak valid!';
                if ($value == 3)
                    Filter::$msgs['nss'] = 'NSS sudah terdaftar!';
            }
                    
          if (empty($_POST['propinsi_kode']))
              Filter::$msgs['propinsi_kode'] = 'Silahkan pilih Propinsi';

          if (empty($_POST['kota_kode']))
              Filter::$msgs['kota_kode'] = 'Silahkan pilih Kota';

          
            if ($value = $this->checkSekolah_NPSN($_POST['npsn'], Filter::$id)) {
                if ($value == 1)
                    Filter::$msgs['npsn'] = 'Jumlah digit NPSN kurang dari 8 karakter!';
                if ($value == 2)
                    Filter::$msgs['npsn'] = 'NPSN tidak valid!';
                if ($value == 3)
                    Filter::$msgs['npsn'] = 'NPSN sudah terdaftar!';
            }
                    
          if (empty(Filter::$msgs)) {
              $data = array('nama_sekolah' => sanitize($_POST['nama_sekolah']), 
                            'jenisid' => intval($_POST['jenisid']), 
                            'nss' => sanitize($_POST['nss']), 
                            'npsn' => sanitize($_POST['npsn']), 
                            'nama_pimpinan' => sanitize($_POST['nama_pimpinan']),
                            'nip_pimpinan' => sanitize($_POST['nip_pimpinan']),
                            'nuptk_pimpinan' => sanitize($_POST['nuptk_pimpinan']),
                            'telp_pimpinan' => sanitize($_POST['telp_pimpinan']),

                            'propinsi_kode' => sanitize($_POST['propinsi_kode']), 
                            'kota_kode' => sanitize($_POST['kota_kode']), 
                  
                            'kecamatan' => sanitize($_POST['kecamatan']),
                            'kelurahan' => sanitize($_POST['kelurahan']),
                            'alamat' => sanitize($_POST['alamat']),
                            'rt' => sanitize($_POST['rt']),
                            'rw' => sanitize($_POST['rw']),
                            'kodepos' => sanitize($_POST['kodepos']),
                            'telepon' => sanitize($_POST['telepon']),
                            'fax' => sanitize($_POST['fax']),
                            'email' => sanitize($_POST['email']),
                            'website' => sanitize($_POST['website']),
                            'kgeografis' => sanitize($_POST['kgeografis']),
                            'statusmilik' => sanitize($_POST['statusmilik']),
                            'status' => sanitize($_POST['status']),
                            'tingkat' => sanitize($_POST['tingkat']),
                            'akreditasi' => sanitize($_POST['akreditasi']),
                            'sertf_iso' => sanitize($_POST['sertf_iso']),
                            'tahun_sertf_iso' => intval($_POST['tahun_sertf_iso']),

                            'guru_pns' => intval($_POST['guru_pns']), 
                            'guru_npns' => intval($_POST['guru_npns']), 
                            'guru_tetap' => intval($_POST['guru_tetap']), 
                            'guru_ttetap' => intval($_POST['guru_ttetap']), 
                            'guru_total' => intval($_POST['guru_total']), 

                            'tk_pns' => intval($_POST['tk_pns']), 
                            'tk_npns' => intval($_POST['tk_npns']), 
                            'tk_tetap' => intval($_POST['tk_tetap']), 
                            'tk_ttetap' => intval($_POST['tk_ttetap']), 
                            'tk_total' => intval($_POST['tk_total']), 

                            'last_update' => 'NOW()',
                            'userid' => intval($_POST['userid']));

              self::$db->update("sekolah", $data, "id='" . Filter::$id . "'");
              (self::$db->affected()) ? Filter::msgOk(lang('DATA_UPDATED')) : Filter::msgAlert(lang('NOPROCCESS'));

		  
          } else
              print Filter::msgStatus();
		  
      }

      /**
       * Content::processAddSekolah()
       * 
       * @return
       */
      public function processAddSekolah()
      {
          if (empty($_POST['nama_sekolah']))
              Filter::$msgs['nama_sekolah'] = 'Silahkan masukkan Nama Sekolah';

          if (empty($_POST['jenisid']))
              Filter::$msgs['jenisid'] = 'Silahkan pilih Jenis Sekolah';

          if (empty($_POST['nss']))
              Filter::$msgs['nss'] = 'Silahkan masukkan NSS / NPSN';

            if ($value = $this->checkSekolah_NSS($_POST['nss'], 0)) {
                if ($value == 1)
                    Filter::$msgs['nss'] = 'Jumlah digit NSS kurang dari 12 karakter!';
                if ($value == 2)
                    Filter::$msgs['nss'] = 'NSS tidak valid!';
                if ($value == 3)
                    Filter::$msgs['nss'] = 'NSS sudah terdaftar!';
            }
                    
          if (empty($_POST['propinsi_kode']))
              Filter::$msgs['propinsi_kode'] = 'Silahkan pilih Propinsi';

          if (empty($_POST['kota_kode']))
              Filter::$msgs['kota_kode'] = 'Silahkan pilih Kota';	  
		  
          
            if ($value = $this->checkSekolah_NPSN($_POST['npsn'], 0)) {
                if ($value == 1)
                    Filter::$msgs['npsn'] = 'Jumlah digit NPSN kurang dari 8 karakter!';
                if ($value == 2)
                    Filter::$msgs['npsn'] = 'NPSN tidak valid!';
                if ($value == 3)
                    Filter::$msgs['npsn'] = 'NPSN sudah terdaftar!';
            }
                    
          if (empty(Filter::$msgs)) {
			  
              $data = array('nama_sekolah' => sanitize($_POST['nama_sekolah']), 
                            'jenisid' => intval($_POST['jenisid']), 
                            'nss' => sanitize($_POST['nss']), 
                            'npsn' => sanitize($_POST['npsn']), 
                            'nama_pimpinan' => sanitize($_POST['nama_pimpinan']),
                            'nip_pimpinan' => sanitize($_POST['nip_pimpinan']),
                            'nuptk_pimpinan' => sanitize($_POST['nuptk_pimpinan']),
                            'telp_pimpinan' => sanitize($_POST['telp_pimpinan']),

                            'propinsi_kode' => sanitize($_POST['propinsi_kode']), 
                            'kota_kode' => sanitize($_POST['kota_kode']), 
                  
                            'kecamatan' => sanitize($_POST['kecamatan']),
                            'kelurahan' => sanitize($_POST['kelurahan']),
                            'alamat' => sanitize($_POST['alamat']),
                            'rt' => sanitize($_POST['rt']),
                            'rw' => sanitize($_POST['rw']),
                            'kodepos' => sanitize($_POST['kodepos']),
                            'telepon' => sanitize($_POST['telepon']),
                            'fax' => sanitize($_POST['fax']),
                            'email' => sanitize($_POST['email']),
                            'website' => sanitize($_POST['website']),
                            'kgeografis' => sanitize($_POST['kgeografis']),
                            'statusmilik' => sanitize($_POST['statusmilik']),
                            'status' => sanitize($_POST['status']),
                            'tingkat' => sanitize($_POST['tingkat']),
                            'akreditasi' => sanitize($_POST['akreditasi']),
                            'sertf_iso' => sanitize($_POST['sertf_iso']),
                            'tahun_sertf_iso' => sanitize($_POST['tahun_sertf_iso']),

                            'guru_pns' => intval($_POST['guru_pns']), 
                            'guru_npns' => intval($_POST['guru_npns']), 
                            'guru_tetap' => intval($_POST['guru_tetap']), 
                            'guru_ttetap' => intval($_POST['guru_ttetap']), 
                            'guru_total' => intval($_POST['guru_total']), 

                            'tk_pns' => intval($_POST['tk_pns']), 
                            'tk_npns' => intval($_POST['tk_npns']), 
                            'tk_tetap' => intval($_POST['tk_tetap']), 
                            'tk_ttetap' => intval($_POST['tk_ttetap']), 
                            'tk_total' => intval($_POST['tk_total']), 

                            'last_update' => 'NOW()',
                            'created' => 'NOW()',
                            'userid' => intval($_POST['userid']));
						              
              $lastid = self::$db->insert("sekolah", $data);
              (self::$db->affected()) ? Filter::msgOk(lang('DATA_ADDED')) : Filter::msgAlert(lang('NOPROCCESS'));
			  			  
          } else
              print Filter::msgStatus();
      }


	  /**
	   * Content::SekolahKGeografisList()
	   * 
	   * @param string $selected
	   * @return
	   */
	  public function SekolahKGeografisList($selected = '')
	  {
		  $arr = array('Terpencil', 'Perkotaan', 'Pedesaan', 
                                'Daerah Perbatasan', 'Daerah Sulit');

		  $list = '';
		  foreach ($arr as $val) {
                        $sel = ($val == $selected) ? ' selected="selected"' : '';
                        $list .= "<option value=\"" . $val . "\"" . $sel . ">" . $val . "</option>\n";
		  }
		  unset($val);
		  return $list;
	  }


	  /**
	   * Content::SekolahStatusMilikList()
	   * 
	   * @param string $selected
	   * @return
	   */
	  public function SekolahStatusMilikList($selected = '')
	  {
		  $arr = array('Pemerintah Pusat', 'Pemerintah Daerah', 
                                'Yayasan', 'Lembaga');

		  $list = '';
		  foreach ($arr as $val) {
                        $sel = ($val == $selected) ? ' selected="selected"' : '';
                        $list .= "<option value=\"" . $val . "\"" . $sel . ">" . $val . "</option>\n";
		  }
		  unset($val);
		  return $list;
	  }

      /**
       * Content::getSekolah_JenisList()
       * 
       * @return
       */
      public function getSekolah_TingkatList()
      {
          $sql = "SELECT *"
                ."\n FROM sekolah_tingkat"
                ."\n ORDER BY nama_tingkat";
				 
          $row = self::$db->fetch_all($sql);

          return ($row) ? $row : 0;
      }
                              
	  /**
	   * Content::Sekolah_TingkatList()
	   * 
	   * @param string $selected
	   * @return
	   */
	  public function Sekolah_TingkatList($selected = '')
	  {
      $arr = $this->getSekolah_TingkatList();
              
      if ($arr) {
                            
		    $list = '';
		    foreach ($arr as $val) {
			     $sel = ($val->nama_tingkat == $selected) ? ' selected="selected"' : '';
			     $list .= "<option value=\"" . $val->nama_tingkat . "\"" . $sel . ">" . $val->nama_tingkat . "</option>\n";
		    }
		    unset($val);
		    return $list;
      }
                  
	  }

      /**
       * Content::getSekolah_IjazahList()
       * 
       * @return
       */
      public function getSekolah_IjazahList()
      {
          $sql = "SELECT *"
                ."\n FROM sekolah_ijazah"
                ."\n ORDER BY nama_ijazah";
				 
          $row = self::$db->fetch_all($sql);

          return ($row) ? $row : 0;
      }
                              
	  /**
	   * Content::Sekolah_IjazahList()
	   * 
	   * @param string $selected
	   * @return
	   */
	  public function Sekolah_IjazahList($selected = '')
	  {
              $arr = $this->getSekolah_IjazahList();
              
              if ($arr) {
                            
		  $list = '';
		  foreach ($arr as $val) {
			  $sel = ($val->nama_ijazah == $selected) ? ' selected="selected"' : '';
			  $list .= "<option value=\"" . $val->nama_ijazah . "\"" . $sel . ">" . $val->nama_ijazah . "</option>\n";
		  }
		  unset($val);
		  return $list;
                  
              }
                  
	  }

          
      /**
       * Content::getSekolah_JenjangList()
       * 
       * @return
       */
      public function getSekolah_JenjangList()
      {
          $sql = "SELECT *"
                ."\n FROM sekolah_jenjang"
                ."\n ORDER BY nama_jenjang";
				 
          $row = self::$db->fetch_all($sql);

          return ($row) ? $row : 0;
      }
                              
	  /**
	   * Content::Sekolah_JenjangList()
	   * 
	   * @param string $selected
	   * @return
	   */
	  public function Sekolah_JenjangList($selected = '')
	  {
      $arr = $this->getSekolah_JenjangList();
              
      if ($arr) {
                            
		    $list = '';
		    foreach ($arr as $val) {
			     $sel = ($val->nama_jenjang == $selected) ? ' selected="selected"' : '';
			     $list .= "<option value=\"" . $val->nama_jenjang . "\"" . $sel . ">" . $val->nama_jenjang . "</option>\n";
		    }
		    unset($val);
		    return $list;

      }
                  
	  }

	  /**
	   * Content::Sekolah_JenjangByIDList()
	   * 
	   * @param string $selected
	   * @return
	   */
	  public function Sekolah_JenjangByIDList($selected = '')
	  {
      $arr = $this->getSekolah_JenjangList();
              
      if ($arr) {
                            
		    $list = '';
		    foreach ($arr as $val) {
			     $sel = ($val->id == $selected) ? ' selected="selected"' : '';
			     $list .= "<option value=\"" . $val->id . "\"" . $sel . ">" . $val->nama_jenjang . "</option>\n";
		    }
		    unset($val);
		    return $list;

      }
                  
	  }
                    
      /**
       * Content::getSekolah_SMK()
       * 
       * @return
       */
      public function getSekolah_SMK($sekolahid)
      {
          $sql = "SELECT smk.*,"
                . "\n b.kode, b.nama_bidang,"
                . "\n p.kode, p.nama_program,"
                . "\n k.kode, k.nama_kompetensi"                  
                . "\n FROM ((sekolah_smk as smk"
                . "\n LEFT JOIN bsk as b ON smk.bskid = b.id)" 
                . "\n LEFT JOIN psk as p ON smk.pskid = p.id)" 
                . "\n LEFT JOIN kk as k ON smk.kkid = k.id" 
                . "\n WHERE smk.sekolahid = " . $sekolahid;

          $row = self::$db->fetch_all($sql);

          return ($row) ? $row : 0;
      }

      /**
       * Content::getSekolah_PPMD()
       * 
       * @return
       */
      public function getSekolah_PPMD($sekolahid)
      {
          $sql = "SELECT *"
                . "\n FROM sekolah_ppmd"
                . "\n WHERE sekolahid = " . $sekolahid;

          $row = self::$db->fetch_all($sql);

          return ($row) ? $row : 0;
      }
      
      /**
       * Content::getSekolah_RKPJT()
       * 
       * @return
       */
      public function getSekolah_RKPJT($sekolahid)
      {
          $sql = "SELECT *"
                . "\n FROM sekolah_rkpjt"
                . "\n WHERE sekolahid = " . $sekolahid;

          $row = self::$db->fetch_all($sql);

          return ($row) ? $row : 0;
      }

      /**
       * Content::getSekolah_RKPSJ()
       * 
       * @return
       */
      public function getSekolah_RKPSJ($sekolahid)
      {
          $sql = "SELECT *"
                . "\n FROM sekolah_rkpsj"
                . "\n WHERE sekolahid = " . $sekolahid;

          $row = self::$db->fetch_all($sql);

          return ($row) ? $row : 0;
      }
      
      /**
       * Content::getSekolah_RPKPP()
       * 
       * @return
       */
      public function getSekolah_RPKPP($sekolahid)
      {
          $sql = "SELECT *"
                . "\n FROM sekolah_rpkpp"
                . "\n WHERE sekolahid = " . $sekolahid;

          $row = self::$db->fetch_all($sql);

          return ($row) ? $row : 0;
      }
      
      /**
       * Content::getSekolah_RPTL()
       * 
       * @return
       */
      public function getSekolah_RPTL($sekolahid)
      {
          $sql = "SELECT *"
                . "\n FROM sekolah_rptl"
                . "\n WHERE sekolahid = " . $sekolahid;

          $row = self::$db->fetch_all($sql);

          return ($row) ? $row : 0;
      }
      
      /**
       * Content::getSekolah_Ruang()
       * 
       * @return
       */
      public function getSekolah_Ruang($sekolahid)
      {
          $sql = "SELECT *"
                . "\n FROM sekolah_ruang"
                . "\n WHERE sekolahid = " . $sekolahid;

          $row = self::$db->fetch_all($sql);

          return ($row) ? $row : 0;
      }
      
      /**
       * Content::getSekolah_Siswa()
       * 
       * @return
       */
      public function getSekolah_Siswa($sekolahid)
      {
          $sql = "SELECT sw.*,"
                . "\n k.nama_kompetensi"
                . "\n FROM sekolah_siswa AS sw"
                . "\n LEFT JOIN kk AS k ON sw.kkid=k.id"
                . "\n WHERE sw.sekolahid = " . $sekolahid;

          $row = self::$db->fetch_all($sql);

          return ($row) ? $row : 0;
      }
      
      /**
       * Content::getSekolah_Tanah()
       * 
       * @return
       */
      public function getSekolah_Tanah($sekolahid)
      {
          $sql = "SELECT *"
                . "\n FROM sekolah_tanah"
                . "\n WHERE sekolahid = " . $sekolahid;

          $row = self::$db->fetch_all($sql);

          return ($row) ? $row : 0;
      }
            
      /**
       * Content::loadSekolah_SMK() ---------------------------------------------
       * 
       * @param mixed $sekolahid
       * @return
       */
	  public function loadSekolah_SMK($sekolahid)
	  {

		  $data = $this->getSekolah_SMK($sekolahid);
		  print '
                    <table class="responsive table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Bidang Keahlian</th>
                                <th>Program Keahlian</th>
                                <th>Paket Keahlian</th>
                                <th width="40"><button type="button" class="btn" id="btnSMKadd" data-toggle="modal"><span class="icon16 icomoon-icon-plus-2"></span>Tambah</button></th>
                            </tr>
                        </thead>';

		  if (!$data) {
			  print '<tbody>
				<tr>
				  <td colspan="4">' . Filter::msgInfo(lang('NO_DATA'), false) . '</td>
				</tr>';
		  } else {
			  foreach ($data as $irow) {
				  print '
					<tr>
					  <td style="text-align: left;">' . $irow->nama_bidang . '</td>
					  <td style="text-align: left;">' . $irow->nama_program . '</td>
					  <td style="text-align: left;">' . $irow->nama_kompetensi . '</td>
                                          <td align="center">                                            
                                            <a href="javascript:void(0)" title="Hapus" class="tip doDelete" data-tname="sekolah_smk" data-id="'. $irow->id. '" data-toggle="modal"><span class="icon12 icomoon-icon-remove"></span></a>
                                          </td>
					</tr>';
			  }
			  unset($irow);
		  }
		  print '</tbody>
			</table>';
	  }

      /**
       * Content::loadSekolah_PPMD() 
       * 
       * @param mixed $sekolahid
       * @return
       */
	  public function loadSekolah_PPMD($sekolahid)
	  {

		  $data = $this->getSekolah_PPMD($sekolahid);
		  print '
                    <table class="responsive table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Mata Diklat/Pelajaran</th>
                                <th>Jml PNS</th>
                                <th>Jml Non-PNS</th>
                                <th width="40"><button type="button" class="btn" id="btnPPMDadd" data-toggle="modal"><span class="icon16 icomoon-icon-plus-2"></span>Tambah</button></th>
                            </tr>
                        </thead>';

		  if (!$data) {
			  print '<tbody>
				<tr>
				  <td colspan="4">' . Filter::msgInfo(lang('NO_DATA'), false) . '</td>
				</tr>';
		  } else {
			  foreach ($data as $irow) {
				  print '
					<tr>
					  <td style="text-align: left;">' . $irow->mata_diklat . '</td>
					  <td style="text-align: left;">' . $irow->jml_pns . '</td>
					  <td style="text-align: left;">' . $irow->jml_nonpns . '</td>
                                          <td align="center">                                            
                                            <a href="javascript:void(0)" title="Hapus" class="tip doDelete" data-tname="sekolah_ppmd" data-id="'. $irow->id. '" data-toggle="modal"><span class="icon12 icomoon-icon-remove"></span></a>
                                          </td>
					</tr>';
			  }
			  unset($irow);
		  }
		  print '</tbody>
			</table>';
	  }
          
      /**
       * Content::loadSekolah_RKPJT() 
       * 
       * @param mixed $sekolahid
       * @return
       */
	  public function loadSekolah_RKPJT($sekolahid)
	  {

		  $data = $this->getSekolah_RKPJT($sekolahid);
		  print '
                    <table class="responsive table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Tenaga Pendukung</th>
                                <th>Tingkat Pendidikan</th>
                                <th>Jumlah</th>
                                <th width="40"><button type="button" class="btn" id="btnRKPJTadd" data-toggle="modal"><span class="icon16 icomoon-icon-plus-2"></span>Tambah</button></th>
                            </tr>
                        </thead>';

		  if (!$data) {
			  print '<tbody>
				<tr>
				  <td colspan="4">' . Filter::msgInfo(lang('NO_DATA'), false) . '</td>
				</tr>';
		  } else {
			  foreach ($data as $irow) {
				  print '
					<tr>
					  <td style="text-align: left;">' . $irow->tenaga_pendukung . '</td>
					  <td style="text-align: left;">' . $irow->tingkat_pendidikan . '</td>
					  <td style="text-align: left;">' . $irow->jml . '</td>
                                          <td align="center">                                            
                                            <a href="javascript:void(0)" title="Hapus" class="tip doDelete" data-tname="sekolah_rkpjt" data-id="'. $irow->id. '" data-toggle="modal"><span class="icon12 icomoon-icon-remove"></span></a>
                                          </td>
					</tr>';
			  }
			  unset($irow);
		  }
		  print '</tbody>
			</table>';
	  }
          
      /**
       * Content::loadSekolah_RKPSJ() 
       * 
       * @param mixed $sekolahid
       * @return
       */
	  public function loadSekolah_RKPSJ($sekolahid)
	  {

		  $data = $this->getSekolah_RKPSJ($sekolahid);
		  print '
                    <table class="responsive table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Tingkat Pendidikan</th>
                                <th>Jml GT (L)</th>
                                <th>Jml GT (P)</th>
                                <th width="40"><button type="button" class="btn" id="btnRKPSJadd" data-toggle="modal"><span class="icon16 icomoon-icon-plus-2"></span>Tambah</button></th>
                            </tr>
                        </thead>';

		  if (!$data) {
			  print '<tbody>
				<tr>
				  <td colspan="4">' . Filter::msgInfo(lang('NO_DATA'), false) . '</td>
				</tr>';
		  } else {
			  foreach ($data as $irow) {
				  print '
					<tr>
					  <td style="text-align: left;">' . $irow->tingkat_pendidikan . '</td>
					  <td style="text-align: left;">' . $irow->jml_gt_l . '</td>
					  <td style="text-align: left;">' . $irow->jml_gt_p . '</td>
                                          <td align="center">                                            
                                            <a href="javascript:void(0)" title="Hapus" class="tip doDelete" data-tname="sekolah_rkpsj" data-id="'. $irow->id. '" data-toggle="modal"><span class="icon12 icomoon-icon-remove"></span></a>
                                          </td>
					</tr>';
			  }
			  unset($irow);
		  }
		  print '</tbody>
			</table>';
	  }
          
      /**
       * Content::loadSekolah_RPKPP() 
       * 
       * @param mixed $sekolahid
       * @return
       */
	  public function loadSekolah_RPKPP($sekolahid)
	  {

		  $data = $this->getSekolah_RPKPP($sekolahid);
		  print '
                    <table class="responsive table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Jenis Pengembangan</th>
                                <th>Jml Guru</th>
                                <th width="40"><button type="button" class="btn" id="btnRPKPPadd" data-toggle="modal"><span class="icon16 icomoon-icon-plus-2"></span>Tambah</button></th>
                            </tr>
                        </thead>';

		  if (!$data) {
			  print '<tbody>
				<tr>
				  <td colspan="3">' . Filter::msgInfo(lang('NO_DATA'), false) . '</td>
				</tr>';
		  } else {
			  foreach ($data as $irow) {
				  print '
					<tr>
					  <td style="text-align: left;">' . $irow->jenis_pengembangan . '</td>
					  <td style="text-align: left;">' . $irow->jml_guru . '</td>
                                          <td align="center">                                            
                                            <a href="javascript:void(0)" title="Hapus" class="tip doDelete" data-tname="sekolah_rpkpp" data-id="'. $irow->id. '" data-toggle="modal"><span class="icon12 icomoon-icon-remove"></span></a>
                                          </td>
					</tr>';
			  }
			  unset($irow);
		  }
		  print '</tbody>
			</table>';
	  }
          
      /**
       * Content::loadSekolah_RPTL() 
       * 
       * @param mixed $sekolahid
       * @return
       */
	  public function loadSekolah_RPTL($sekolahid)
	  {

		  $data = $this->getSekolah_RPTL($sekolahid);
		  print '
                    <table class="responsive table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Mata Diklat/Pelajaran</th>
                                <th>Jml Sesuai</th>
                                <th>Jml Tdk Sesuai</th>
                                <th width="40"><button type="button" class="btn" id="btnRPTLadd" data-toggle="modal"><span class="icon16 icomoon-icon-plus-2"></span>Tambah</button></th>
                            </tr>
                        </thead>';

		  if (!$data) {
			  print '<tbody>
				<tr>
				  <td colspan="4">' . Filter::msgInfo(lang('NO_DATA'), false) . '</td>
				</tr>';
		  } else {
			  foreach ($data as $irow) {
				  print '
					<tr>
					  <td style="text-align: left;">' . $irow->mata_diklat . '</td>
					  <td style="text-align: left;">' . $irow->jml_sesuai . '</td>
					  <td style="text-align: left;">' . $irow->jml_tsesuai . '</td>
                                          <td align="center">                                            
                                            <a href="javascript:void(0)" title="Hapus" class="tip doDelete" data-tname="sekolah_rptl" data-id="'. $irow->id. '" data-toggle="modal"><span class="icon12 icomoon-icon-remove"></span></a>
                                          </td>
					</tr>';
			  }
			  unset($irow);
		  }
		  print '</tbody>
			</table>';
	  }

      /**
       * Content::loadSekolah_Ruang() 
       * 
       * @param mixed $sekolahid
       * @return
       */
	  public function loadSekolah_Ruang($sekolahid)
	  {

		  $data = $this->getSekolah_Ruang($sekolahid);
		  print '
                    <table class="responsive table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Jenis</th>
                                <th>Nama Ruangan</th>
                                <th>Jumlah</th>
                                <th width="40"><button type="button" class="btn" id="btnRuangadd" data-toggle="modal"><span class="icon16 icomoon-icon-plus-2"></span>Tambah</button></th>
                            </tr>
                        </thead>';

		  if (!$data) {
			  print '<tbody>
				<tr>
				  <td colspan="4">' . Filter::msgInfo(lang('NO_DATA'), false) . '</td>
				</tr>';
		  } else {
			  foreach ($data as $irow) {
				  print '
					<tr>
					  <td style="text-align: left;">' . $irow->jenis_ruang . '</td>
					  <td style="text-align: left;">' . $irow->nama_jenis . '</td>
					  <td style="text-align: left;">' . $irow->jml . '</td>
                                          <td align="center">                                            
                                            <a href="javascript:void(0)" title="Hapus" class="tip doDelete" data-tname="sekolah_ruang" data-id="'. $irow->id. '" data-toggle="modal"><span class="icon12 icomoon-icon-remove"></span></a>
                                          </td>
					</tr>';
			  }
			  unset($irow);
		  }
		  print '</tbody>
			</table>';
	  }
          
      /**
       * Content::loadSekolah_Siswa() 
       * 
       * @param mixed $sekolahid
       * @return
       */
	  public function loadSekolah_Siswa($sekolahid)
	  {

		  $data = $this->getSekolah_Siswa($sekolahid);
		  print '
                    <table class="responsive table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Paket Keahlian</th>
                                <th>Akreditasi</th>
                                <th>Jml Tk1 (L)</th>
                                <th width="40"><button type="button" class="btn" id="btnSiswaadd" data-toggle="modal"><span class="icon16 icomoon-icon-plus-2"></span>Tambah</button></th>
                            </tr>
                        </thead>';

		  if (!$data) {
			  print '<tbody>
				<tr>
				  <td colspan="4">' . Filter::msgInfo(lang('NO_DATA'), false) . '</td>
				</tr>';
		  } else {
			  foreach ($data as $irow) {
				  print '
					<tr>
					  <td style="text-align: left;">' . $irow->nama_kompetensi . '</td>
					  <td style="text-align: left;">' . $irow->akreditasi . '</td>
					  <td style="text-align: left;">' . $irow->jml_tk1_l . '</td>
                                          <td align="center">                                            
                                            <a href="javascript:void(0)" title="Hapus" class="tip doDelete" data-tname="sekolah_siswa" data-id="'. $irow->id. '" data-toggle="modal"><span class="icon12 icomoon-icon-remove"></span></a>
                                          </td>
					</tr>';
			  }
			  unset($irow);
		  }
		  print '</tbody>
			</table>';
	  }

      /**
       * Content::loadSekolah_Tanah() 
       * 
       * @param mixed $sekolahid
       * @return
       */
	  public function loadSekolah_Tanah($sekolahid)
	  {

		  $data = $this->getSekolah_Tanah($sekolahid);
		  print '
                    <table class="responsive table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Kepemilikan</th>
                                <th>Status</th>
                                <th>Luas (m2)</th>
                                <th width="40"><button type="button" class="btn" id="btnTanahadd" data-toggle="modal"><span class="icon16 icomoon-icon-plus-2"></span>Tambah</button></th>
                            </tr>
                        </thead>';

		  if (!$data) {
			  print '<tbody>
				<tr>
				  <td colspan="4">' . Filter::msgInfo(lang('NO_DATA'), false) . '</td>
				</tr>';
		  } else {
			  foreach ($data as $irow) {
				  print '
					<tr>
					  <td style="text-align: left;">' . $irow->kepemilikan . '</td>
					  <td style="text-align: left;">' . $irow->status . '</td>
					  <td style="text-align: left;">' . $irow->luas . '</td>
                                          <td align="center">                                            
                                            <a href="javascript:void(0)" title="Hapus" class="tip doDelete" data-tname="sekolah_tanah" data-id="'. $irow->id. '" data-toggle="modal"><span class="icon12 icomoon-icon-remove"></span></a>
                                          </td>
					</tr>';
			  }
			  unset($irow);
		  }
		  print '</tbody>
			</table>';
	  }
                              
	  /**
	   * Content::processSekolah_SMK() -------------------------------------
	   * 
	   * @return
	   */
	  public function processSekolah_SMK()
	  {
		  if (empty($_POST['sekolahid']))
                    Filter::$msgs['sekolahid'] = 'Sekolah belum dipilih!';

		  if (empty(Filter::$msgs)) {
                                         
                    $data = array(
                                  'sekolahid' => intval($_POST['sekolahid']), 
                                  'bskid' => intval($_POST['bskid']),
                                  'pskid' => intval($_POST['pskid']),
                                  'kkid' => intval($_POST['kkid']),
                                  'last_update' => 'NOW()',
                                  'userid' => intval($_POST['userid']) );

                    if (!Filter::$id)
                        $data['created'] = "NOW()";											
                                                    
                    (Filter::$id) ? self::$db->update("sekolah_smk", $data, "id='" . Filter::$id . "'") : self::$db->insert("sekolah_smk", $data);
                    $message = (Filter::$id) ? lang('DATA_UPDATED') : lang('DATA_ADDED');
                    (self::$db->affected()) ? Filter::msgOk($message) : Filter::msgAlert(lang('NOPROCCESS'));

		  } else
                    print Filter::msgStatus();
	  }
          
	  /**
	   * Content::processSekolah_PPMD() 
	   * 
	   * @return
	   */
	  public function processSekolah_PPMD()
	  {
		  if (empty($_POST['sekolahid']))
                    Filter::$msgs['sekolahid'] = 'Sekolah belum dipilih!';

		  if (empty(Filter::$msgs)) {
                                         
                    $data = array(
                                  'sekolahid' => intval($_POST['sekolahid']), 
                                  'mata_diklat' => sanitize($_POST['mata_diklat']),
                                  'jml_pns' => intval($_POST['jml_pns']),
                                  'jml_nonpns' => intval($_POST['jml_nonpns']),
                                  'jml_tetap' => intval($_POST['jml_tetap']),
                                  'jml_ttetap' => intval($_POST['jml_ttetap']),
                                  'keterangan' => sanitize($_POST['keterangan']),
                                  'last_update' => 'NOW()',
                                  'userid' => intval($_POST['userid']) );

                    if (!Filter::$id)
                        $data['created'] = "NOW()";											
                                                    
                    (Filter::$id) ? self::$db->update("sekolah_ppmd", $data, "id='" . Filter::$id . "'") : self::$db->insert("sekolah_ppmd", $data);
                    $message = (Filter::$id) ? lang('DATA_UPDATED') : lang('DATA_ADDED');
                    (self::$db->affected()) ? Filter::msgOk($message) : Filter::msgAlert(lang('NOPROCCESS'));

		  } else
                    print Filter::msgStatus();
	  }

	  /**
	   * Content::processSekolah_RKPJT() 
	   * 
	   * @return
	   */
	  public function processSekolah_RKPJT()
	  {
		  if (empty($_POST['sekolahid']))
                    Filter::$msgs['sekolahid'] = 'Sekolah belum dipilih!';

		  if (empty(Filter::$msgs)) {
                                         
                    $data = array(
                                  'sekolahid' => intval($_POST['sekolahid']), 
                                  'tenaga_pendukung' => sanitize($_POST['tenaga_pendukung']),
                                  'tingkat_pendidikan' => sanitize($_POST['tingkat_pendidikan']),
                                  'jml' => intval($_POST['jml']),
                                  'last_update' => 'NOW()',
                                  'userid' => intval($_POST['userid']) );

                    if (!Filter::$id)
                        $data['created'] = "NOW()";											
                                                    
                    (Filter::$id) ? self::$db->update("sekolah_rkpjt", $data, "id='" . Filter::$id . "'") : self::$db->insert("sekolah_rkpjt", $data);
                    $message = (Filter::$id) ? lang('DATA_UPDATED') : lang('DATA_ADDED');
                    (self::$db->affected()) ? Filter::msgOk($message) : Filter::msgAlert(lang('NOPROCCESS'));

		  } else
                    print Filter::msgStatus();
	  }
          
	  /**
	   * Content::processSekolah_RKPSJ() 
	   * 
	   * @return
	   */
	  public function processSekolah_RKPSJ()
	  {
		  if (empty($_POST['sekolahid']))
                    Filter::$msgs['sekolahid'] = 'Sekolah belum dipilih!';

		  if (empty(Filter::$msgs)) {
                                         
                    $data = array(
                                  'sekolahid' => intval($_POST['sekolahid']), 
                                  'tingkat_pendidikan' => sanitize($_POST['tingkat_pendidikan']),
                                  'jml_gt_l' => intval($_POST['jml_gt_l']),
                                  'jml_gt_p' => intval($_POST['jml_gt_p']),
                                  'jml_gtt_l' => intval($_POST['jml_gt_l']),
                                  'jml_gtt_p' => intval($_POST['jml_gt_p']),
                                  'jml_total' => intval($_POST['jml_total']),
                                  'last_update' => 'NOW()',
                                  'userid' => intval($_POST['userid']) );

                    if (!Filter::$id)
                        $data['created'] = "NOW()";											
                                                    
                    (Filter::$id) ? self::$db->update("sekolah_rkpsj", $data, "id='" . Filter::$id . "'") : self::$db->insert("sekolah_rkpsj", $data);
                    $message = (Filter::$id) ? lang('DATA_UPDATED') : lang('DATA_ADDED');
                    (self::$db->affected()) ? Filter::msgOk($message) : Filter::msgAlert(lang('NOPROCCESS'));

		  } else
                    print Filter::msgStatus();
	  }
          
	  /**
	   * Content::processSekolah_RPKPP() 
	   * 
	   * @return
	   */
	  public function processSekolah_RPKPP()
	  {
		  if (empty($_POST['sekolahid']))
                    Filter::$msgs['sekolahid'] = 'Sekolah belum dipilih!';

		  if (empty(Filter::$msgs)) {
                                         
                    $data = array(
                                  'sekolahid' => intval($_POST['sekolahid']), 
                                  'jenis_pengembangan' => sanitize($_POST['jenis_pengembangan']),
                                  'jml_guru' => intval($_POST['jml_guru']),
                                  'last_update' => 'NOW()',
                                  'userid' => intval($_POST['userid']) );

                    if (!Filter::$id)
                        $data['created'] = "NOW()";											
                                                    
                    (Filter::$id) ? self::$db->update("sekolah_rpkpp", $data, "id='" . Filter::$id . "'") : self::$db->insert("sekolah_rpkpp", $data);
                    $message = (Filter::$id) ? lang('DATA_UPDATED') : lang('DATA_ADDED');
                    (self::$db->affected()) ? Filter::msgOk($message) : Filter::msgAlert(lang('NOPROCCESS'));

		  } else
                    print Filter::msgStatus();
	  }

	  /**
	   * Content::processSekolah_RPTL() 
	   * 
	   * @return
	   */
	  public function processSekolah_RPTL()
	  {
		  if (empty($_POST['sekolahid']))
                    Filter::$msgs['sekolahid'] = 'Sekolah belum dipilih!';

		  if (empty(Filter::$msgs)) {
                                         
                    $data = array(
                                  'sekolahid' => intval($_POST['sekolahid']), 
                                  'mata_diklat' => sanitize($_POST['mata_diklat']),
                                  'jml_sesuai' => intval($_POST['jml_sesuai']),
                                  'jml_tsesuai' => intval($_POST['jml_tsesuai']),
                                  'jml_total' => intval($_POST['jml_total']),
                                  'last_update' => 'NOW()',
                                  'userid' => intval($_POST['userid']) );

                    if (!Filter::$id)
                        $data['created'] = "NOW()";											
                                                    
                    (Filter::$id) ? self::$db->update("sekolah_rptl", $data, "id='" . Filter::$id . "'") : self::$db->insert("sekolah_rptl", $data);
                    $message = (Filter::$id) ? lang('DATA_UPDATED') : lang('DATA_ADDED');
                    (self::$db->affected()) ? Filter::msgOk($message) : Filter::msgAlert(lang('NOPROCCESS'));

		  } else
                    print Filter::msgStatus();
	  }
          
	  /**
	   * Content::processSekolah_Ruang() 
	   * 
	   * @return
	   */
	  public function processSekolah_Ruang()
	  {
		  if (empty($_POST['sekolahid']))
                    Filter::$msgs['sekolahid'] = 'Sekolah belum dipilih!';

		  if (empty(Filter::$msgs)) {
                                         
                    $data = array(
                                  'sekolahid' => intval($_POST['sekolahid']), 
                                  'jenis_ruang' => sanitize($_POST['jenis_ruang']),
                                  'nama_jenis' => sanitize($_POST['nama_jenis']),
                                  'jml' => intval($_POST['jml']),
                                  'kondisi' => sanitize($_POST['kondisi']),
                                  'ukuran' => sanitize($_POST['ukuran']),
                                  'last_update' => 'NOW()',
                                  'userid' => intval($_POST['userid']) );

                    if (!Filter::$id)
                        $data['created'] = "NOW()";											
                                                    
                    (Filter::$id) ? self::$db->update("sekolah_ruang", $data, "id='" . Filter::$id . "'") : self::$db->insert("sekolah_ruang", $data);
                    $message = (Filter::$id) ? lang('DATA_UPDATED') : lang('DATA_ADDED');
                    (self::$db->affected()) ? Filter::msgOk($message) : Filter::msgAlert(lang('NOPROCCESS'));

		  } else
                    print Filter::msgStatus();
	  }

	  /**
	   * Content::processSekolah_Siswa() 
	   * 
	   * @return
	   */
	  public function processSekolah_Siswa()
	  {
		  if (empty($_POST['sekolahid']))
                    Filter::$msgs['sekolahid'] = 'Sekolah belum dipilih!';

		  if (empty(Filter::$msgs)) {
                                         
                    $data = array(
                                  'sekolahid' => intval($_POST['sekolahid']), 
                                  'kkid' => intval($_POST['kkid']), 
                                  'akreditasi' => sanitize($_POST['akreditasi']),
                                  'jml_tk1_l' => intval($_POST['jml_tk1_l']),
                                  'jml_tk1_p' => intval($_POST['jml_tk1_p']),
                                  'jml_tk2_l' => intval($_POST['jml_tk2_l']),
                                  'jml_tk2_p' => intval($_POST['jml_tk2_p']),
                                  'jml_tk3_l' => intval($_POST['jml_tk3_l']),
                                  'jml_tk3_p' => intval($_POST['jml_tk3_p']),
                                  'last_update' => 'NOW()',
                                  'userid' => intval($_POST['userid']) );

                    if (!Filter::$id)
                        $data['created'] = "NOW()";											
                                                    
                    (Filter::$id) ? self::$db->update("sekolah_siswa", $data, "id='" . Filter::$id . "'") : self::$db->insert("sekolah_siswa", $data);
                    $message = (Filter::$id) ? lang('DATA_UPDATED') : lang('DATA_ADDED');
                    (self::$db->affected()) ? Filter::msgOk($message) : Filter::msgAlert(lang('NOPROCCESS'));

		  } else
                    print Filter::msgStatus();
	  }
          
	  /**
	   * Content::processSekolah_Tanah() 
	   * 
	   * @return
	   */
	  public function processSekolah_Tanah()
	  {
		  if (empty($_POST['sekolahid']))
                    Filter::$msgs['sekolahid'] = 'Sekolah belum dipilih!';

		  if (empty(Filter::$msgs)) {
                                         
                    $data = array(
                                  'sekolahid' => intval($_POST['sekolahid']), 
                                  'kepemilikan' => sanitize($_POST['kepemilikan']),
                                  'status' => sanitize($_POST['status']),
                                  'luas' => intval($_POST['luas']),
                                  'luas_tt' => intval($_POST['luas_tt']),
                                  'luas_tsb' => intval($_POST['luas_tsb']),
                                  'last_update' => 'NOW()',
                                  'userid' => intval($_POST['userid']) );

                    if (!Filter::$id)
                        $data['created'] = "NOW()";											
                                                    
                    (Filter::$id) ? self::$db->update("sekolah_tanah", $data, "id='" . Filter::$id . "'") : self::$db->insert("sekolah_tanah", $data);
                    $message = (Filter::$id) ? lang('DATA_UPDATED') : lang('DATA_ADDED');
                    (self::$db->affected()) ? Filter::msgOk($message) : Filter::msgAlert(lang('NOPROCCESS'));

		  } else
                    print Filter::msgStatus();
	  }
                    
      /**
       * Content::getPTK()-------------------------------------------------------------------------------------------------------------
       * 
       * @return
       */
      public function getPTK()
      {	  
        if (isset($_GET['propinsi_kode']))
              $propinsi_kode = sanitize($_GET['propinsi_kode']);
        else
              $propinsi_kode = '';

        if (isset($_GET['kota_kode']))
              $kota_kode = sanitize($_GET['kota_kode']);
        else
              $kota_kode = '';

        if (isset($_GET['searchfield']))
              $searchfield = strtolower(sanitize($_GET['searchfield']));
        else
              $searchfield = '';
        
        if (isset($_GET['searchtext']))
              $searchtext = strtolower(sanitize($_GET['searchtext']));
        else
              $searchtext = '';
        
        if ($propinsi_kode != '') {
              if ($kota_kode != '') {
                      $q = "SELECT count(*) FROM ptk AS pt LEFT JOIN sekolah AS s ON pt.sekolahid = s.id WHERE pt.propinsi_kode = '" . $propinsi_kode . "' AND pt.kota_kode = '" . $kota_kode . "'";
                      $sqlwhere = "WHERE pt.propinsi_kode = '" . $propinsi_kode . "' AND pt.kota_kode = '" . $kota_kode . "'";
                      
                    if (($searchtext != '') && ($searchfield != '')) {
                        $q .= " AND LOWER(" . $searchfield .") LIKE '%". $searchtext ."%'";
                        $sqlwhere .= " AND LOWER(" . $searchfield .") LIKE '%". $searchtext ."%'";
                    }
              } else {
                      $q = "SELECT count(*) FROM ptk AS pt LEFT JOIN sekolah AS s ON pt.sekolahid = s.id WHERE pt.propinsi_kode = '" . $propinsi_kode . "'";
                      $sqlwhere = "WHERE pt.propinsi_kode = '" . $propinsi_kode . "'";
                      
                      if (($searchtext != '') && ($searchfield != '')) {
                          $q .= " AND LOWER(" . $searchfield .") LIKE '%". $searchtext ."%'";
                          $sqlwhere .= " AND LOWER(" . $searchfield .") LIKE '%". $searchtext ."%'";
                      }
              }
        } else {
              if ($kota_kode != '') {
                      $q = "SELECT count(*) FROM ptk AS pt LEFT JOIN sekolah AS s ON pt.sekolahid = s.id WHERE pt.kota_kode = '" . $kota_kode . "'";
                      $sqlwhere = "WHERE pt.kota_kode = '" . $kota_kode . "'";
                      
                      if (($searchtext != '') && ($searchfield != '')) {
                          $q .= " AND LOWER(" . $searchfield .") LIKE '%". $searchtext ."%'";
                          $sqlwhere .= " AND LOWER(" . $searchfield .") LIKE '%". $searchtext ."%'";
                      }
              } else {
                      $q = "SELECT count(*) FROM ptk AS pt LEFT JOIN sekolah AS s ON pt.sekolahid = s.id";

                      if (($searchtext != '') && ($searchfield != '')) {
                        $q .= " WHERE LOWER(" . $searchfield .") LIKE '%". $searchtext ."%'";
                        $sqlwhere = "WHERE LOWER(" . $searchfield .") LIKE '%". $searchtext ."%'";
                      } else
                        $sqlwhere = "";
              }
        }
        
        $record = Registry::get("Database")->query($q);
        $total = Registry::get("Database")->fetchrow($record);
        $counter = $total[0];

        $pager = Paginator::instance();
        $pager->items_total = $counter;
        $pager->default_ipp = Registry::get("Core")->perpage;
        $pager->paginate();

        if (isset($_GET['sortfield'])) {
            $sortfield = sanitize($_GET['sortfield']);
            if (isset($_GET['sorttype']))
                $sorttype = sanitize($_GET['sorttype']);
            else
                $sorttype = "ASC";

            if (in_array($sortfield, array("pt.nuptk", "pt.nama_lengkap", 
                                           "s.nama_sekolah", "p.nama_propinsi",
                                           "k.nama_kota"))) {
                $sort = ($sorttype == 'DESC') ? " DESC " : " ASC ";

                $sqlorder = "LOWER(" . $sortfield . ") " . $sort;
            } else
                $sqlorder = "LOWER(pt.nama_lengkap)";
        } else
            $sqlorder = "LOWER(pt.nama_lengkap)";
                                
        $sql = "SELECT pt.id,pt.nuptk,pt.gelar_depan1,pt.gelar_depan2,pt.gelar_depan3,pt.nama_lengkap,pt.gelar_belakang1,pt.gelar_belakang2,pt.gelar_belakang3,pt.nip,pt.sekolahid,"
                . "\n s.nama_sekolah,s.nss,s.alamat," 
                . "\n p.nama_propinsi," 
                . "\n k.nama_kota" 
                . "\n FROM ((ptk AS pt" 
                . "\n LEFT JOIN sekolah AS s ON pt.sekolahid = s.id)" 
                . "\n LEFT JOIN propinsi AS p ON s.propinsi_kode = p.kode)" 
                . "\n LEFT JOIN kota AS k ON s.kota_kode = k.kode" 
                . "\n $sqlwhere" 
                . "\n ORDER BY " . $sqlorder . $pager->limit;
                
        $row = self::$db->fetch_all($sql);

        return ($row) ? $row : 0;
	  
      }

     /**
       * Content::getPTKById()
       * 
       * @return
       */
      public function getPTKById($id)
      {
          $sql = "SELECT p.*," 
		  . "\n s.nss, s.nama_sekolah" 
		  . "\n FROM ptk as p LEFT JOIN sekolah as s" 
		  . "\n ON p.sekolahid=s.id" 
		  . "\n WHERE p.id = '" . $id . "'";

          $row = self::$db->first($sql);

          return ($row) ? $row : 0;
      }
	  
	  /**
	   * Content::Jenis_KelaminList()
	   * 
	   * @param string $selected
	   * @return
	   */
	  public function Jenis_KelaminList($selected = '')
	  {
                $arr = array('L' => 'L : Laki-Laki', 'P' => 'P : Perempuan');

                $list = '';
                foreach ($arr as $key => $val) {
                        $sel = ($key == $selected) ? ' selected="selected"' : '';
                        $list .= "<option value=\"" . $key . "\"" . $sel . ">" . $val . "</option>\n";
                }
                unset($val);
                return $list;
	  }

  
      /**
       * Content::getPTK_DiklatMinat()
       * 
       * @return
       */
      public function getPTK_DiklatMinat($ptkid)
      {
          $sql = "SELECT minat.*,"
                . "\n dk.kode,"
                . "\n dk.nama_diklat,"
                . "\n d.nama_departemen"
                . "\n FROM (ptk_diklatminat as minat"
                . "\n LEFT JOIN diklat as dk ON minat.diklatid = dk.id)" 
                . "\n LEFT JOIN departemen as d ON dk.departemenid = d.id" 
                . "\n WHERE minat.ptkid = '" . $ptkid . "'";

          $row = self::$db->fetch_all($sql);

          return ($row) ? $row : 0;
      }

      /**
       * Content::getPTK_MMDS()
       * 
       * @return
       */
      public function getPTK_MMDS($ptkid)
      {
          $sql = "SELECT mmds.*,"
                . "\n k.kode, k.nama_kompetensi"
                . "\n FROM ptk_mmds as mmds"
                . "\n LEFT JOIN kk as k ON mmds.kkid = k.id" 
                . "\n WHERE mmds.ptkid = '" . $ptkid . "'";

          $row = self::$db->fetch_all($sql);

          return ($row) ? $row : 0;
      }
                        
      /**
       * Content::getPTK_MMDL()
       * 
       * @return
       */
      public function getPTK_MMDL($ptkid)
      {
          $sql = "SELECT mmdl.*,"
                . "\n k.kode,"
                . "\n k.nama_kompetensi"
                . "\n FROM ptk_mmdl as mmdl"
                . "\n LEFT JOIN kk as k ON mmdl.kkid = k.id" 
                . "\n WHERE mmdl.ptkid = '" . $ptkid . "'";

          $row = self::$db->fetch_all($sql);

          return ($row) ? $row : 0;
      }

      /**
       * Content::getPTK_RPP()
       * 
       * @return
       */
      public function getPTK_RPP($ptkid)
      {
          $sql = "SELECT *"
                . "\n FROM ptk_rpp"
                . "\n WHERE ptkid = '" . $ptkid . "'";

          $row = self::$db->fetch_all($sql);

          return ($row) ? $row : 0;
      }

      /**
       * Content::getPTK_RPF()
       * 
       * @return
       */
      public function getPTK_RPF($ptkid)
      {
          $sql = "SELECT *"
                . "\n FROM ptk_rpf"
                . "\n WHERE ptkid = '" . $ptkid . "'";

          $row = self::$db->fetch_all($sql);

          return ($row) ? $row : 0;
      }
      
      /**
       * Content::getPTK_RPNF()
       * 
       * @return
       */
      public function getPTK_RPNF($ptkid)
      {
          $sql = "SELECT *"
                . "\n FROM ptk_rpnf"
                . "\n WHERE ptkid = '" . $ptkid . "'";

          $row = self::$db->fetch_all($sql);

          return ($row) ? $row : 0;
      }

      /**
       * Content::getPTK_RSertifikat()
       * 
       * @return
       */
      public function getPTK_RSertifikat($ptkid)
      {
          $sql = "SELECT *"
                . "\n FROM ptk_rsertifikat"
                . "\n WHERE ptkid = '" . $ptkid . "'";

          $row = self::$db->fetch_all($sql);

          return ($row) ? $row : 0;
      }      
      
      /**
       * Content::getMMDKelasOption()
       * 
       * @return
       */
      public function getMMDKelasOption($selected = '')
      {          
	      $arr = array('I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI', 'XII');

		  $list = '';
		  foreach ($arr as $val) {
                        $sel = ($val == $selected) ? ' selected="selected"' : '';
                        $list .= "<option value=\"" . $val . "\"" . $sel . ">" . $val . "</option>\n";
		  }
		  unset($val);
		  return $list;          
      }
      
      
      /**
       * Users::checkPTK_NUPTK()
       * 
       * @param mixed $nuptk, $ptkid
       * @return
       */
      private function checkPTK_NUPTK($nuptk, $ptkid)
      {
          $nuptk = sanitize($nuptk);
          if (strlen(self::$db->escape($nuptk)) < 16)
              return 1; // -- digit kurang --

          // -- check apa numerik semua ? --

          if ($ptkid > 0)
            $sql = self::$db->query("SELECT id FROM ptk WHERE nuptk = '" . $nuptk . "' AND id <> " . $ptkid ." LIMIT 1");
          else
            $sql = self::$db->query("SELECT id FROM ptk WHERE nuptk = '" . $nuptk . "' LIMIT 1");
                
          $count = self::$db->numrows($sql);
          
          return ($count > 0) ? 3 : false;
      }

      /**
       * Users::checkPTK_NIP()
       * 
       * @param mixed $nip, $ptkid
       * @return
       */
      private function checkPTK_NIP($nip, $ptkid)
      {
          $nip = sanitize($nip);
          if (strlen(self::$db->escape($nip)) < 18)
              return 1; // -- digit kurang --

          // -- check apa numerik semua ? --

          if ($ptkid > 0)
            $sql = self::$db->query("SELECT id FROM ptk WHERE nip = '" . $nip . "' AND id <> " . $ptkid ." LIMIT 1");
          else
            $sql = self::$db->query("SELECT id FROM ptk WHERE nip = '" . $nip . "' LIMIT 1");
                
          $count = self::$db->numrows($sql);
          
          return ($count > 0) ? 3 : false;
      }
            
      /**
       * Content::processUpdatePTK()
       * 
       * @return
       */
      public function processUpdatePTK()
      {

            if (empty($_POST['nuptk']))
                Filter::$msgs['nuptk'] = 'Silahkan masukkan NUPTK';
		
            if ($value = $this->checkPTK_NUPTK($_POST['nuptk'], Filter::$id)) {
                if ($value == 1)
                    Filter::$msgs['nuptk'] = 'Jumlah digit NUPTK kurang dari 16 karakter!';
                if ($value == 2)
                    Filter::$msgs['nuptk'] = 'NUPTK tidak valid!';
                if ($value == 3)
                    Filter::$msgs['nuptk'] = 'NUPTK sudah terdaftar!';
            }
                    
          if (empty($_POST['nama_lengkap']))
              Filter::$msgs['nama_lengkap'] = 'Silahkan masukkan Nama Lengkap';

          if (empty($_POST['sekolahid']))
              Filter::$msgs['sekolahid'] = 'Silahkan pilih Sekolah';

          //if (empty($_POST['nip']))
          //    Filter::$msgs['nip'] = 'Silahkan masukkan NIP';

            if ((!empty($_POST['nip'])) && ($value = $this->checkPTK_NIP($_POST['nip'], Filter::$id))) {
                if ($value == 1)
                    Filter::$msgs['nip'] = 'Jumlah digit NIP kurang dari 18 karakter!';
                if ($value == 2)
                    Filter::$msgs['nip'] = 'NIP tidak valid!';
                if ($value == 3)
                    Filter::$msgs['nip'] = 'NIP sudah terdaftar!';
            }
                    
          if (empty(Filter::$msgs)) {
              
                if (empty($_POST['tgl_lahir']))
                    $tgl_lahir = null;
                else {
                    $tgl_lahir = sanitize($_POST['tgl_lahir']);
                    $tgl_lahir = setToSQLdate($tgl_lahir);
                }
                 
                if (empty($_POST['tmt_pns']))
                    $tmt_pns = null;
                else {
                    $tmt_pns = sanitize($_POST['tmt_pns']);
                    $tmt_pns = setToSQLdate($tmt_pns);
                }

                if (empty($_POST['tmt_pendidik']))
                    $tmt_pendidik = null;
                else {
                    $tmt_pendidik = sanitize($_POST['tmt_pendidik']);
                    $tmt_pendidik = setToSQLdate($tmt_pendidik);
                }
               
                if (empty($_POST['tmt_sekolah']))
                    $tmt_sekolah = null;
                else {
                    $tmt_sekolah = sanitize($_POST['tmt_sekolah']);
                    $tmt_sekolah = setToSQLdate($tmt_sekolah);
                }

                if (empty($_POST['tmt_kepalasekolah']))
                    $tmt_kepalasekolah = null;
                else {
                    $tmt_kepalasekolah = sanitize($_POST['tmt_kepalasekolah']);
                    $tmt_kepalasekolah = setToSQLdate($tmt_kepalasekolah);
                }
                                
                $data = array('nuptk' => sanitize($_POST['nuptk']),
                              'nip' => sanitize($_POST['nip']),
                              'nama_lengkap' => sanitize($_POST['nama_lengkap']), 
                              'sekolahid' => intval($_POST['sekolahid']), 
                              'tmp_lahir' => sanitize($_POST['tmp_lahir']), 
                              'tgl_lahir' => $tgl_lahir,
  
                              'gelar_depan1' => sanitize($_POST['gelar_depan1']), 	
                              'gelar_depan2' => sanitize($_POST['gelar_depan2']), 	
                              'gelar_depan3' => sanitize($_POST['gelar_depan3']), 	

                              'gelar_belakang1' => sanitize($_POST['gelar_belakang1']), 	
                              'gelar_belakang2' => sanitize($_POST['gelar_belakang2']), 	
                              'gelar_belakang3' => sanitize($_POST['gelar_belakang3']), 	

                              'no_ktp' => sanitize($_POST['no_ktp']), 
                              'jns_klmn' => sanitize($_POST['jns_klmn']), 
                              'agama' => sanitize($_POST['agama']), 
                              'status_kawin' => sanitize($_POST['status_kawin']), 

                              'golongan' => sanitize($_POST['golongan']), 
                              'alamat' => sanitize($_POST['alamat']), 
                              'kodepos' => sanitize($_POST['kodepos']), 

                              'propinsi_kode' => sanitize($_POST['propinsi_kode']), 
                              'kota_kode' => sanitize($_POST['kota_kode']), 

                              'kelurahan' => sanitize($_POST['kelurahan']), 
                              'kecamatan' => sanitize($_POST['kecamatan']), 
                              'telepon1' => sanitize($_POST['telepon1']), 
                              'telepon2' => sanitize($_POST['telepon2']), 
                              'email' => sanitize($_POST['email']),
                              'website' => sanitize($_POST['website']),

                              'statuskepegawaian' => sanitize($_POST['statuskepegawaian']),
                              'jeniskepegawaian' => sanitize($_POST['jeniskepegawaian']),
                              'tugaspokok' => sanitize($_POST['tugaspokok']), 
                              'status_guru' => sanitize($_POST['status_guru']), 

                              'pendidikan_akhir' => sanitize($_POST['pendidikan_akhir']),
                              'ijazah_akhir' => sanitize($_POST['ijazah_akhir']),
                              'jurusan_akhir' => sanitize($_POST['jurusan_akhir']),
                              'tahun_lulus_akhir' => intval($_POST['tahun_lulus_akhir']),

                              'tmt_pns' => $tmt_pns,
                              'tmt_pendidik' => $tmt_pendidik,
                              'tmt_sekolah' => $tmt_sekolah,
                              'tmt_kepalasekolah' => $tmt_kepalasekolah,

                              'sertifikasi_guru' => sanitize($_POST['sertifikasi_guru']), 
                              'akta_mengajar' => sanitize($_POST['akta_mengajar']), 

                              'UKA_status' => sanitize($_POST['UKA_status']),
                              'UKA_tahun' => intval($_POST['UKA_tahun']),
                              'UKG_status' => sanitize($_POST['UKG_status']),
                              'UKG_tahun' => intval($_POST['UKG_tahun']),

                              'status' => sanitize($_POST['status']),
                              'last_update' => 'NOW()',
                              'userid' => intval($_POST['userid']));
                            
              if (empty($_POST['jabatanpokok']))
                    $data['jabatanpokok'] = null;
              else
                    $data['jabatanpokok'] = sanitize($_POST['jabatanpokok']);
                            
              self::$db->update("ptk", $data, "id='" . Filter::$id . "'");
              (self::$db->affected()) ? Filter::msgOk(lang('DATA_UPDATED')) : Filter::msgAlert(lang('NOPROCCESS'));
		  
          } else
              print Filter::msgStatus();
		  
      }

      /**
       * Content::processAddPTK()
       * 
       * @return
       */
      public function processAddPTK()
      {
          if (empty($_POST['nuptk']))
              Filter::$msgs['nuptk'] = 'Silahkan masukkan NUPTK';

            if ($value = $this->checkPTK_NUPTK($_POST['nuptk'], 0)) {
                if ($value == 1)
                    Filter::$msgs['nuptk'] = 'Jumlah digit NUPTK kurang dari 16 karakter!';
                if ($value == 2)
                    Filter::$msgs['nuptk'] = 'NUPTK tidak valid!';
                if ($value == 3)
                    Filter::$msgs['nuptk'] = 'NUPTK sudah terdaftar!';
            }
                    
          if (empty($_POST['nama_lengkap']))
              Filter::$msgs['nama_lengkap'] = 'Silahkan masukkan Nama Lengkap';

          if (empty($_POST['sekolahid']))
              Filter::$msgs['sekolahid'] = 'Silahkan pilih Sekolah';

          //if (empty($_POST['nip']))
          //    Filter::$msgs['nip'] = 'Silahkan masukkan NIP';
          		
            if ((!empty($_POST['nip'])) && ($value = $this->checkPTK_NIP($_POST['nip'], 0))) {
                if ($value == 1)
                    Filter::$msgs['nip'] = 'Jumlah digit NIP kurang dari 18 karakter!';
                if ($value == 2)
                    Filter::$msgs['nip'] = 'NIP tidak valid!';
                if ($value == 3)
                    Filter::$msgs['nip'] = 'NIP sudah terdaftar!';
            }
                    
          if (empty(Filter::$msgs)) {

                if (empty($_POST['tgl_lahir']))
                    $tgl_lahir = null;
                else {
                    $tgl_lahir = sanitize($_POST['tgl_lahir']);
                    $tgl_lahir = setToSQLdate($tgl_lahir);
                }

                if (empty($_POST['tmt_pns']))
                    $tmt_pns = null;
                else {
                    $tmt_pns = sanitize($_POST['tmt_pns']);
                    $tmt_pns = setToSQLdate($tmt_pns);
                }

                if (empty($_POST['tmt_pendidik']))
                    $tmt_pendidik = null;
                else {
                    $tmt_pendidik = sanitize($_POST['tmt_pendidik']);
                    $tmt_pendidik = setToSQLdate($tmt_pendidik);
                }

                if (empty($_POST['tmt_sekolah']))
                    $tmt_sekolah = null;
                else {
                    $tmt_sekolah = sanitize($_POST['tmt_sekolah']);
                    $tmt_sekolah = setToSQLdate($tmt_sekolah);
                }

                if (empty($_POST['tmt_kepalasekolah']))
                    $tmt_kepalasekolah = null;
                else {
                    $tmt_kepalasekolah = sanitize($_POST['tmt_kepalasekolah']);
                    $tmt_kepalasekolah = setToSQLdate($tmt_kepalasekolah);
                }
                            
                $data = array('nuptk' => sanitize($_POST['nuptk']),
                              'nip' => sanitize($_POST['nip']),
                              'nama_lengkap' => sanitize($_POST['nama_lengkap']), 
                              'sekolahid' => intval($_POST['sekolahid']), 
                              'tmp_lahir' => sanitize($_POST['tmp_lahir']), 
                              'tgl_lahir' => $tgl_lahir,

                              'gelar_depan1' => sanitize($_POST['gelar_depan1']), 	
                              'gelar_depan2' => sanitize($_POST['gelar_depan2']), 	
                              'gelar_depan3' => sanitize($_POST['gelar_depan3']), 	

                              'gelar_belakang1' => sanitize($_POST['gelar_belakang1']), 	
                              'gelar_belakang2' => sanitize($_POST['gelar_belakang2']), 	
                              'gelar_belakang3' => sanitize($_POST['gelar_belakang3']), 	                             	

                              'no_ktp' => sanitize($_POST['no_ktp']), 
                              'jns_klmn' => sanitize($_POST['jns_klmn']), 
                              'agama' => sanitize($_POST['agama']), 
                              'status_kawin' => sanitize($_POST['status_kawin']), 

                              'golongan' => sanitize($_POST['golongan']), 
                              'alamat' => sanitize($_POST['alamat']), 
                              'kodepos' => sanitize($_POST['kodepos']), 

                              'propinsi_kode' => sanitize($_POST['propinsi_kode']), 
                              'kota_kode' => sanitize($_POST['kota_kode']), 
                              'kelurahan' => sanitize($_POST['kelurahan']), 
                              'kecamatan' => sanitize($_POST['kecamatan']), 
                              'telepon1' => sanitize($_POST['telepon1']), 
                              'telepon2' => sanitize($_POST['telepon2']), 
                              'email' => sanitize($_POST['email']), 
                              'website' => sanitize($_POST['website']),
                              'statuskepegawaian' => sanitize($_POST['statuskepegawaian']),
                              'jeniskepegawaian' => sanitize($_POST['jeniskepegawaian']),
                              'tugaspokok' => sanitize($_POST['tugaspokok']), 
                              'status_guru' => sanitize($_POST['status_guru']), 
                              'jabatanpokok' => sanitize($_POST['jabatanpokok']),
                              'pendidikan_akhir' => sanitize($_POST['pendidikan_akhir']),
                              'ijazah_akhir' => sanitize($_POST['ijazah_akhir']),
                              'jurusan_akhir' => sanitize($_POST['jurusan_akhir']),
                              'tahun_lulus_akhir' => intval($_POST['tahun_lulus_akhir']),

                              'tmt_pns' => $tmt_pns,
                              'tmt_pendidik' => $tmt_pendidik,
                              'tmt_sekolah' => $tmt_sekolah,
                              'tmt_kepalasekolah' => $tmt_kepalasekolah,

                              'sertifikasi_guru' => sanitize($_POST['sertifikasi_guru']), 
                              'akta_mengajar' => sanitize($_POST['akta_mengajar']), 

                              'UKA_status' => sanitize($_POST['UKA_status']),
                              'UKA_tahun' => intval($_POST['UKA_tahun']),
                              'UKG_status' => sanitize($_POST['UKG_status']),
                              'UKG_tahun' => intval($_POST['UKG_tahun']),

                              'status' => sanitize($_POST['status']), 
                              'source_name' => 'SIM', 

                              'last_update' => 'NOW()',
                              'created' => "NOW()",
                              'userid' => intval($_POST['userid']));
							
                $lastid = self::$db->insert("ptk", $data);
                (self::$db->affected()) ? print 'OK_' . $lastid : Filter::msgAlert(lang('NOPROCCESS'));
			  			  
          } else
              print Filter::msgStatus();
      }

      /**
       * Content::loadPTK_DiklatMinat() ---------------------------------------------
       * 
       * @param $ptkid
       * @return
       */
	  public function loadPTK_DiklatMinat($ptkid)
	  {

		  $data = $this->getPTK_DiklatMinat($ptkid);
		  print '
                    <table class="responsive table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th width="30">Kode</th>
                                <th>Nama Diklat</th>
                                <th width="40">Tahun</th>
                                <th>Nama Departemen</th>
                                <th>Deskripsi</th>
                                <th width="40"><button type="button" class="btn" id="btnMinatadd" data-toggle="modal"><span class="icon16 icomoon-icon-plus-2"></span>Tambah</button></th>
                            </tr>
                        </thead>';

		  if (!$data) {
			  print '<tbody>
				<tr>
				  <td colspan="6">' . Filter::msgInfo(lang('NO_DATA'), false) . '</td>
				</tr>';
		  } else {
			  foreach ($data as $irow) {
				  print '
					<tr>
					  <td>' . $irow->kode . '</td>
					  <td style="text-align: left;">' . $irow->nama_diklat . '</td>
					  <td>' . $irow->tahun . '</td>
					  <td style="text-align: left;">' . $irow->nama_departemen . '</td>
					  <td style="text-align: left;">' . $irow->deskripsi. '</td>
                                          <td align="center">
                                            <a href="javascript:void(0)" title="Edit" class="tip doEditdiklatminat" data-tname="ptk_diklatminat" data-id="'.$irow->id.'" data-toggle="modal"><span class="icon12 icomoon-icon-pencil"></span></a>
                                            <a href="javascript:void(0)" title="Hapus" class="tip doDelete" data-tname="ptk_diklatminat" data-id="' .$irow->id. '" data-toggle="modal"><span class="icon12 icomoon-icon-remove"></span></a>
                                          </td>
					</tr>';
			  }
			  unset($irow);
		  }
		  print '</tbody>
			</table>';
	  }

	  /**
	   * Content::processPTK_DiklatMinat()
	   * 
	   * @return
	   */
	  public function processPTK_DiklatMinat()
	  {
		  if (empty($_POST['ptkid']))
                    Filter::$msgs['ptkid'] = 'PTK belum dipilih';

		  if (empty(Filter::$msgs)) {
                      
                    $data = array(
                                  'ptkid' => intval($_POST['ptkid']), 
                                  'diklatid' => intval($_POST['diklatid']),
                                  'tahun' => intval($_POST['tahun']),
                                  'deskripsi' => sanitize($_POST['deskripsi']),
                                  'last_update' => 'NOW()',
                                  'userid' => intval($_POST['userid']) );

                    if (!Filter::$id)
                        $data['created'] = "NOW()";											
                                                    
                    (Filter::$id) ? self::$db->update("ptk_diklatminat", $data, "id='" . Filter::$id . "'") : self::$db->insert("ptk_diklatminat", $data);
                    $message = (Filter::$id) ? lang('DATA_UPDATED') : lang('DATA_ADDED');
                    (self::$db->affected()) ? Filter::msgOk($message) : Filter::msgAlert(lang('NOPROCCESS'));

		  } else
                    print Filter::msgStatus();
	  }
                  
          
      /**
       * Content::loadPTK_MMDS() ---------------------------------------------
       * 
       * @param mixed $ptkid
       * @return
       */
	  public function loadPTK_MMDS($ptkid)
	  {

		  $data = $this->getPTK_MMDS($ptkid);
		  print '
                    <table class="responsive table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th width="60">Kelompok</th>
                                <th>Paket Keahlian (KK)</th>
                                <th>Mata Pelajaran</th>
                                <th width="30">Kelas</th>
                                <th width="70">Tahun</th>
                                <th width="40"><button type="button" class="btn" id="btnMMDSadd" data-toggle="modal"><span class="icon16 icomoon-icon-plus-2"></span>Tambah</button></th>
                            </tr>
                        </thead>';

		  if (!$data) {
			  print '<tbody>
				<tr>
				  <td colspan="6">' . Filter::msgInfo(lang('NO_DATA'), false) . '</td>
				</tr>';
		  } else {
			  foreach ($data as $irow) {
				  print '
					<tr>
					  <td>' . $irow->kel_matapelajaran . '</td>
					  <td style="text-align: left;">' . $irow->nama_kompetensi . '</td>
					  <td style="text-align: left;">' . $irow->nama_matapelajaran . '</td>
					  <td>' . $irow->kelas . '</td>
					  <td>' . $irow->tahun_mulai.' - '.$irow->tahun_akhir. '</td>
                                          <td align="center">
                                            <a href="javascript:void(0)" title="Edit" class="tip doEditmmds" data-tname="ptk_mmds" data-id="'.$irow->id.'" data-toggle="modal"><span class="icon12 icomoon-icon-pencil"></span></a>
                                            <a href="javascript:void(0)" title="Hapus" class="tip doDelete" data-tname="ptk_mmds" data-id="' . $irow->id .'" data-toggle="modal"><span class="icon12 icomoon-icon-remove"></span></a>
                                          </td>
					</tr>';
			  }
			  unset($irow);
		  }
		  print '</tbody>
			</table>';
	  }

	  /**
	   * Content::processPTK_MMDS()
	   * 
	   * @return
	   */
	  public function processPTK_MMDS()
	  {
		  if (empty($_POST['ptkid']))
                    Filter::$msgs['ptkid'] = 'PTK belum dipilih';

		  if (empty(Filter::$msgs)) {
                   
                    // --- check kel_matapelajaran == "ADAPTIF" or "NORMATIF" => null
                      
                    $data = array(
                                  'ptkid' => intval($_POST['ptkid']), 
                                  'kel_matapelajaran' => sanitize($_POST['kel_matapelajaran']),
                                  'nama_matapelajaran' => sanitize($_POST['nama_matapelajaran']),
                                  'kelas' => sanitize($_POST['kelas']),
                                  'tahun_mulai' => intval($_POST['tahun_mulai']),
                                  'tahun_akhir' => intval($_POST['tahun_akhir']),
                                  'last_update' => 'NOW()',
                                  'userid' => intval($_POST['userid']) );

                    if (!empty($_POST['kkid']))
                        $data['kkid'] = intval($_POST['kkid']);
                                        
                    if (!Filter::$id)
                        $data['created'] = "NOW()";											
                          
                          
                    (Filter::$id) ? self::$db->update("ptk_mmds", $data, "id='" . Filter::$id . "'") : self::$db->insert("ptk_mmds", $data);
                    $message = (Filter::$id) ? lang('DATA_UPDATED') : lang('DATA_ADDED');
                    (self::$db->affected()) ? Filter::msgOk($message) : Filter::msgAlert(lang('NOPROCCESS'));

		  } else
			  print Filter::msgStatus();
	  }

      /**
       * Content::loadPTK_MMDL() ---------------------------------------------
       * 
       * @param mixed $ptkid
       * @return
       */
	  public function loadPTK_MMDL($ptkid)
	  {

		  $data = $this->getPTK_MMDL($ptkid);
		  print '
                    <table class="responsive table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th width="60">Kelompok</th>
                                <th>Paket Keahlian (KK)</th>
                                <th>Lembaga</th>
                                <th>Mata Pelajaran</th>
                                <th width="30">Kelas</th>
                                <th width="70">Tahun</th>
                                <th width="40"><button type="button" class="btn" id="btnMMDLadd" data-toggle="modal"><span class="icon16 icomoon-icon-plus-2"></span>Tambah</button></th>
                            </tr>
                        </thead>';

		  if (!$data) {
			  print '<tbody>
				<tr>
				  <td colspan="7">' . Filter::msgInfo(lang('NO_DATA'), false) . '</td>
				</tr>';
		  } else {
			  foreach ($data as $irow) {
				  print '
					<tr>
					  <td>' . $irow->kel_matapelajaran . '</td>
					  <td style="text-align: left;">' . $irow->nama_kompetensi . '</td>
					  <td style="text-align: left;">' . $irow->nama_lembaga . '</td>
					  <td style="text-align: left;">' . $irow->nama_matapelajaran . '</td>
					  <td>' . $irow->kelas . '</td>
					  <td>' . $irow->tahun_mulai.' - '.$irow->tahun_akhir. '</td>
                                          <td align="center">
                                            <a href="javascript:void(0)" title="Edit" class="tip doEditmmdl" data-tname="ptk_mmdl" data-id="'.$irow->id.'" data-toggle="modal"><span class="icon12 icomoon-icon-pencil"></span></a>
                                            <a href="javascript:void(0)" title="Hapus" class="tip doDelete" data-tname="ptk_mmdl" data-id="'.$irow->id.'" data-toggle="modal"><span class="icon12 icomoon-icon-remove"></span></a>
                                          </td>
					</tr>';
			  }
			  unset($irow);
		  }
		  print '</tbody>
			</table>';
	  }

	  /**
	   * Content::processPTK_MMDL()
	   * 
	   * @return
	   */
	  public function processPTK_MMDL()
	  {
		  if (empty($_POST['ptkid']))
			  Filter::$msgs['ptkid'] = 'PTK belum dipilih';

		  if (empty(Filter::$msgs)) {
                    $data = array(
                                'ptkid' => intval($_POST['ptkid']), 
                                'kel_matapelajaran' => sanitize($_POST['kel_matapelajaran']),
                                'nama_lembaga' => sanitize($_POST['nama_lembaga']),
                                'nama_matapelajaran' => sanitize($_POST['nama_matapelajaran']),
                                'kelas' => sanitize($_POST['kelas']),
                                'tahun_mulai' => intval($_POST['tahun_mulai']),
                                'tahun_akhir' => intval($_POST['tahun_akhir']),
                                'last_update' => 'NOW()',
                                'userid' => intval($_POST['userid']) );

                    if (!empty($_POST['kkid']))
                        $data['kkid'] = intval($_POST['kkid']);                    
                    
                    if (!Filter::$id)
                        $data['created'] = "NOW()";											
                                              
                    (Filter::$id) ? self::$db->update("ptk_mmdl", $data, "id='" . Filter::$id . "'") : self::$db->insert("ptk_mmdl", $data);
                    $message = (Filter::$id) ? lang('DATA_UPDATED') : lang('DATA_ADDED');
                    (self::$db->affected()) ? Filter::msgOk($message) : Filter::msgAlert(lang('NOPROCCESS'));
                    
		  } else
			  print Filter::msgStatus();
	  }

      /**
       * Content::loadPTK_RPP() ---------------------------------------------
       * 
       * @param mixed $ptkid
       * @return
       */
	  public function loadPTK_RPP($ptkid)
	  {

		  $data = $this->getPTK_RPP($ptkid);
		  print '
                    <table class="responsive table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Nama Diklat</th>
                                <th width="50">Peran</th>
                                <th width="40">Tahun</th>
                                <th width="40">Pola/Jam</th>
                                <th>Penyelenggara</th>
                                <th width="40">Tingkat</th>
                                <th>Kompetensi</th>
                                <th width="40"><button type="button" class="btn" id="btnRPPadd" data-toggle="modal"><span class="icon16 icomoon-icon-plus-2"></span>Tambah</button></th>
                            </tr>
                        </thead>';

		  if (!$data) {
			  print '<tbody>
				<tr>
				  <td colspan="8">' . Filter::msgInfo(lang('NO_DATA'), false) . '</td>
				</tr>';
		  } else {
			  foreach ($data as $irow) {
				  print '
					<tr>
					  <td style="text-align: left;">' . $irow->nama_diklat . '</td>
					  <td style="text-align: left;">' . $irow->peran . '</td>
					  <td>' . $irow->tahun . '</td>
					  <td>' . $irow->jml_jam . '</td>
					  <td style="text-align: left;">' . $irow->penyelenggara . '</td>
					  <td>' . $irow->tingkat. '</td>
                                          <td style="text-align: left;">' . $irow->kompetensi. '</td>
                                          <td align="center">
                                            <a href="javascript:void(0)" title="Edit" class="tip doEditrpp" data-tname="ptk_rpp" data-id="'.$irow->id.'" data-toggle="modal"><span class="icon12 icomoon-icon-pencil"></span></a>
                                            <a href="javascript:void(0)" title="Hapus" class="tip doDelete" data-tname="ptk_rpp" data-id="'.$irow->id.'" data-toggle="modal"><span class="icon12 icomoon-icon-remove"></span></a>
                                          </td>
					</tr>';
			  }
			  unset($irow);
		  }
		  print '</tbody>
			</table>';
	  }

	  /**
	   * Content::processPTK_RPP()
	   * 
	   * @return
	   */
	  public function processPTK_RPP()
	  {
		  if (empty($_POST['ptkid']))
			  Filter::$msgs['ptkid'] = 'PTK belum dipilih';

		  if (empty(Filter::$msgs)) {
                    $data = array(
                                'ptkid' => intval($_POST['ptkid']),                                                 
                                'nama_diklat' => sanitize($_POST['nama_diklat']),
                                'peran' => sanitize($_POST['peran']),
                                'tahun' => intval($_POST['tahun']),
                                'jml_jam' => intval($_POST['jml_jam']),
                                'penyelenggara' => sanitize($_POST['penyelenggara']),
                                'tingkat' => sanitize($_POST['tingkat']),
                                'kompetensi' => sanitize($_POST['kompetensi']),
                                'status' => sanitize($_POST['status']),                        
                                'last_update' => 'NOW()',
                                'userid' => intval($_POST['userid']) );

                    if (!Filter::$id)
                        $data['created'] = "NOW()";											
                          
                          
                    (Filter::$id) ? self::$db->update("ptk_rpp", $data, "id='" . Filter::$id . "'") : self::$db->insert("ptk_rpp", $data);
                    $message = (Filter::$id) ? lang('DATA_UPDATED') : lang('DATA_ADDED');
                    (self::$db->affected()) ? Filter::msgOk($message) : Filter::msgAlert(lang('NOPROCCESS'));

		  } else
                    print Filter::msgStatus();
	  }

      /**
       * Content::loadPTK_RPF() ---------------------------------------------
       * 
       * @param mixed $ptkid
       * @return
       */
	  public function loadPTK_RPF($ptkid)
	  {

		  $data = $this->getPTK_RPF($ptkid);
		  print '
                    <table class="responsive table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Sekolah</th>
                                <th>Lokasi</th>
                                <th>Fakultas</th>
                                <th>Jurusan</th>
                                <th width="30">Status</th>
                                <th width="70">Tingkat Pendidikan</th>
                                <th width="30">Tahun Lulus</th>
                                <th width="40"><button type="button" class="btn" id="btnRPFadd" data-toggle="modal"><span class="icon16 icomoon-icon-plus-2"></span>Tambah</button></th>
                            </tr>
                        </thead>';

		  if (!$data) {
			  print '<tbody>
				<tr>
				  <td colspan="8">' . Filter::msgInfo(lang('NO_DATA'), false) . '</td>
				</tr>';
		  } else {
			  foreach ($data as $irow) {
				  print '
					<tr>
					  <td>' . $irow->nama_sekolah . '</td>
					  <td style="text-align: left;">' . $irow->lokasi . '</td>
					  <td style="text-align: left;">' . $irow->fakultas . '</td>
					  <td style="text-align: left;">' . $irow->jurusan . '</td>
					  <td>' . $irow->status . '</td>
					  <td>' . $irow->tingkat_pendidikan. '</td>
                                          <td>' . $irow->tahun_lulus. '</td>
                                          <td align="center">
                                            <a href="javascript:void(0)" title="Edit" class="tip doEditrpf" data-tname="ptk_rpf" data-id="'.$irow->id.'" data-toggle="modal"><span class="icon12 icomoon-icon-pencil"></span></a>
                                            <a href="javascript:void(0)" title="Hapus" class="tip doDelete" data-tname="ptk_rpf" data-id="' .$irow->id.'" data-toggle="modal"><span class="icon12 icomoon-icon-remove"></span></a>
                                          </td>
					</tr>';
			  }
			  unset($irow);
		  }
		  print '</tbody>
			</table>';
	  }

	  /**
	   * Content::processPTK_RPF()
	   * 
	   * @return
	   */
	  public function processPTK_RPF()
	  {
		  if (empty($_POST['ptkid']))
			  Filter::$msgs['ptkid'] = 'PTK belum dipilih';

		  if (empty(Filter::$msgs)) {
                    $data = array(
                                'ptkid' => intval($_POST['ptkid']),                        
                                'nama_sekolah' => sanitize($_POST['nama_sekolah']),
                                'lokasi' => sanitize($_POST['lokasi']),
                                'fakultas' => sanitize($_POST['fakultas']),
                                'jurusan' => sanitize($_POST['jurusan']),
                                'status' => sanitize($_POST['status']),
                                'tingkat_pendidikan' => sanitize($_POST['tingkat_pendidikan']),
                                'tahun_lulus' => intval($_POST['tahun_lulus']),
                                'last_update' => 'NOW()',
                                'userid' => intval($_POST['userid']) );

                    if (!Filter::$id)
                        $data['created'] = "NOW()";											
                                                    
                    (Filter::$id) ? self::$db->update("ptk_rpf", $data, "id='" . Filter::$id . "'") : self::$db->insert("ptk_rpf", $data);
                    $message = (Filter::$id) ? lang('DATA_UPDATED') : lang('DATA_ADDED');
                    (self::$db->affected()) ? Filter::msgOk($message) : Filter::msgAlert(lang('NOPROCCESS'));

		  } else
			  print Filter::msgStatus();
	  }
          
      /**
       * Content::loadPTK_RPNF() ---------------------------------------------
       * 
       * @param mixed $ptkid
       * @return
       */
	  public function loadPTK_RPNF($ptkid)
	  {

		  $data = $this->getPTK_RPNF($ptkid);
		  print '
                    <table class="responsive table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Instansi</th>
                                <th>Lokasi</th>
                                <th>Bidang Studi</th>
                                <th>Tingkat</th>
                                <th width="30">Pola/Jam</th>
                                <th width="40">Tahun Lulus</th>
                                <th width="40"><button type="button" class="btn" id="btnRPNFadd" data-toggle="modal"><span class="icon16 icomoon-icon-plus-2"></span>Tambah</button></th>
                            </tr>
                        </thead>';

		  if (!$data) {
			  print '<tbody>
				<tr>
				  <td colspan="7">' . Filter::msgInfo(lang('NO_DATA'), false) . '</td>
				</tr>';
		  } else {
			  foreach ($data as $irow) {
				  print '
					<tr>
					  <td>' . $irow->nama_instansi . '</td>
					  <td style="text-align: left;">' . $irow->lokasi . '</td>
					  <td style="text-align: left;">' . $irow->bidang_studi . '</td>
					  <td style="text-align: left;">' . $irow->tingkat . '</td>
					  <td>' . $irow->jml_jam . '</td>
					  <td>' . $irow->tahun_lulus. '</td>
                                          <td align="center">
                                            <a href="javascript:void(0)" title="Edit" class="tip doEditrpnf" data-tname="ptk_rpnf" data-id="'.$irow->id.'" data-toggle="modal"><span class="icon12 icomoon-icon-pencil"></span></a>
                                            <a href="javascript:void(0)" title="Hapus" class="tip doDelete" data-tname="ptk_rpnf" data-id="'.$irow->id.'" data-toggle="modal"><span class="icon12 icomoon-icon-remove"></span></a>
                                          </td>
					</tr>';
			  }
			  unset($irow);
		  }
		  print '</tbody>
			</table>';
	  }

	  /**
	   * Content::processPTK_RPNF()
	   * 
	   * @return
	   */
	  public function processPTK_RPNF()
	  {
		  if (empty($_POST['ptkid']))
			  Filter::$msgs['ptkid'] = 'PTK belum dipilih';

		  if (empty(Filter::$msgs)) {
                    $data = array(
                                'ptkid' => intval($_POST['ptkid']),                                                                        
                                'nama_instansi' => sanitize($_POST['nama_instansi']),
                                'lokasi' => sanitize($_POST['lokasi']),
                                'bidang_studi' => sanitize($_POST['bidang_studi']),
                                'tingkat' => sanitize($_POST['tingkat']),
                                'jml_jam' => intval($_POST['jml_jam']),
                                'tahun_lulus' => intval($_POST['tahun_lulus']),
                                'last_update' => 'NOW()',
                                'userid' => intval($_POST['userid']) );

                    if (!Filter::$id)
                        $data['created'] = "NOW()";											
                                                    
                    (Filter::$id) ? self::$db->update("ptk_rpnf", $data, "id='" . Filter::$id . "'") : self::$db->insert("ptk_rpnf", $data);
                    $message = (Filter::$id) ? lang('DATA_UPDATED') : lang('DATA_ADDED');
                    (self::$db->affected()) ? Filter::msgOk($message) : Filter::msgAlert(lang('NOPROCCESS'));

		  } else
			  print Filter::msgStatus();
	  }

      /**
       * Content::loadPTK_RSertifikat() ---------------------------------------------
       * 
       * @param mixed $ptkid
       * @return
       */
	  public function loadPTK_RSertifikat($ptkid)
	  {

		  $data = $this->getPTK_RSertifikat($ptkid);
		  print '
                    <table class="responsive table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Nama Test</th>
                                <th>Penyelenggara</th>
                                <th width="40">Tahun</th>
                                <th width="40">Status</th>
                                <th width="40"><button type="button" class="btn" id="btnRPPadd" data-toggle="modal"><span class="icon16 icomoon-icon-plus-2"></span>Tambah</button></th>                            
                            </tr>
                        </thead>';

		  if (!$data) {
			  print '<tbody>
				<tr>
				  <td colspan="5">' . Filter::msgInfo(lang('NO_DATA'), false) . '</td>
				</tr>';
		  } else {
			  foreach ($data as $irow) {
				  print '
					<tr>
					  <td>' . $irow->nama_sertifikat . '</td>
					  <td style="text-align: left;">' . $irow->pelaksana . '</td>
					  <td>' . $irow->tahun . '</td>
					  <td>' . $irow->status . '</td>
                                          <td align="center">
                                            <a href="javascript:void(0)" title="Edit" class="tip doEditrsertifikat" data-tname="ptk_rsertifikat" data-id="'.$irow->id.'" data-toggle="modal"><span class="icon12 icomoon-icon-pencil"></span></a>
                                            <a href="javascript:void(0)" title="Hapus" class="tip doDelete" data-tname="ptk_rsertifikat" data-id="'.$irow->id.'" data-toggle="modal"><span class="icon12 icomoon-icon-remove"></span></a>
                                          </td>
					</tr>';
			  }
			  unset($irow);
		  }
		  print '</tbody>
			</table>';
	  }

	  /**
	   * Content::processPTK_RSertifikat()
	   * 
	   * @return
	   */
	  public function processPTK_RSertifikat()
	  {
		  if (empty($_POST['ptkid']))
			  Filter::$msgs['ptkid'] = 'PTK belum dipilih';

		  if (empty(Filter::$msgs)) {
                    $data = array(
                                'ptkid' => intval($_POST['ptkid']),                                                                        
                                'nama_sertifikat' => sanitize($_POST['nama_sertifikat']),
                                'pelaksana' => sanitize($_POST['pelaksana']),
                                'status' => sanitize($_POST['status']),
                                'tahun' => intval($_POST['tahun']),
                                'last_update' => 'NOW()',
                                'userid' => intval($_POST['userid']) );

                    if (!Filter::$id)
                        $data['created'] = "NOW()";											
                                                    
                    (Filter::$id) ? self::$db->update("ptk_rsertifikat", $data, "id='" . Filter::$id . "'") : self::$db->insert("ptk_rsertifikat", $data);
                    $message = (Filter::$id) ? lang('DATA_UPDATED') : lang('DATA_ADDED');
                    (self::$db->affected()) ? Filter::msgOk($message) : Filter::msgAlert(lang('NOPROCCESS'));

		  } else
			  print Filter::msgStatus();
	  }
        
          
      /**
       * Content::getGelar()-------------------------------------------------------------------------------------------------------------
       * 
       * @return
       */
      public function getGelar()
      {

          $sql = "SELECT * FROM gelar ORDER BY nama_gelar";
				 
          $row = self::$db->fetch_all($sql);

          return ($row) ? $row : 0;
	  
      }
	  
	  
      /**
       * Content::getDiklat()-------------------------------------------------------------------------------------------------------------
       * 
       * @return
       */
      public function getDiklat()
      {

        if (isset($_GET['departemenid']))
            $departemenid = intval($_GET['departemenid']);
        else
            $departemenid = 0;

        if (isset($_GET['searchfield']))
            $searchfield = strtolower(sanitize($_GET['searchfield']));
        else
            $searchfield = '';
        
        if (isset($_GET['searchtext']))
            $searchtext = strtolower(sanitize($_GET['searchtext']));
        else
            $searchtext = '';
              
        if ($departemenid > 0) {
            $q = "SELECT count(*) FROM diklat WHERE departemenid = " . $departemenid;
            $sqlwhere = "WHERE dk.departemenid = " . $departemenid;

            if (($searchfield != '') && ($searchtext != '')) {
                $q .= " AND LOWER(" . $searchfield . ") LIKE '%" . $searchtext . "%'";
                $sqlwhere .= " AND LOWER(dk." . $searchfield . ") LIKE '%" . $searchtext . "%'";
                }
                      
        } else {
            $q = "SELECT count(*) FROM diklat";
            $sqlwhere = "";

            if (($searchfield != '') && ($searchtext != '')) {
                $q .= " WHERE LOWER(" . $searchfield . ") LIKE '%" . $searchtext . "%'";
                $sqlwhere .= "WHERE LOWER(dk." . $searchfield . ") LIKE '%" . $searchtext . "%'";
            }
        }
        
        $record = Registry::get("Database")->query($q);
        $total = Registry::get("Database")->fetchrow($record);
        $counter = $total[0];

        $pager = Paginator::instance();
        $pager->items_total = $counter;
        $pager->default_ipp = Registry::get("Core")->perpage;
        $pager->paginate();
      
        if (isset($_GET['sortfield'])) {
            $sortfield = sanitize($_GET['sortfield']);
            if (isset($_GET['sorttype']))
                $sorttype = sanitize($_GET['sorttype']);
            else
                $sorttype = "ASC";

            if (in_array($sortfield, array("dk.kode", "dk.nama_diklat"))) {
                $sort = ($sorttype == 'DESC') ? " DESC " : " ASC ";

                $sqlorder = "LOWER(" . $sortfield . ") " . $sort;
            } else
                $sqlorder = "LOWER(dk.nama_diklat)";
        } else
            $sqlorder = "LOWER(dk.nama_diklat)";
                
        $sql = "SELECT dk.*,"
                . "\n d.nama_departemen" 
                . "\n FROM diklat as dk" 
                . "\n LEFT JOIN departemen as d ON dk.departemenid = d.id" 
                . "\n $sqlwhere" 
                . "\n ORDER BY " . $sqlorder . $pager->limit; 
        
        $row = self::$db->fetch_all($sql);

        return ($row) ? $row : 0;
	  
      }

      /**
       * Content::getDiklatList()
       * 
       * @return
       */
      public function getDiklatList()
      {

          $sql = "SELECT *" 
                . "\n FROM diklat" 
                . "\n ORDER BY nama_diklat";
          $row = self::$db->fetch_all($sql);

          return ($row) ? $row : 0;
	  
      }


      /**
       * Content::getDiklatById()
       * 
       * @return
       */
      public function getDiklatById()
      {
          $sql = "SELECT *" 
		  . "\n FROM diklat" 
		  . "\n WHERE id = '" . Filter::$id . "'";

          $row = self::$db->first($sql);

          return ($row) ? $row : 0;
      }

      /**
       * Content::processUpdateDiklat()
       * 
       * @return
       */
      public function processUpdateDiklat()
      {

          if (empty($_POST['kode']))
              Filter::$msgs['Kode'] = 'Silahkan masukkan Kode';

          if (empty($_POST['nama_diklat']))
              Filter::$msgs['nama_diklat'] = 'Silahkan masukkan Nama Diklat';

          if (empty($_POST['tahun']))
              Filter::$msgs['tahun'] = 'Silahkan masukkan Tahun';
          
          if (empty(Filter::$msgs)) {
              $data = array('kode' => sanitize($_POST['kode']), 
                            'nama_diklat' => sanitize($_POST['nama_diklat']), 
                            'departemenid' => intval($_POST['departemenid']), 
                            'tahun' => intval($_POST['tahun']), 
                            'jml_jam' => intval($_POST['jml_jam']), 
                            'tingkat' => sanitize($_POST['tingkat']), 
                            'jenis' => sanitize($_POST['jenis']), 
                            'linkid' => sanitize($_POST['linkid']), 
                            'pskid' => sanitize($_POST['pskid']), 
                            'kkid' => sanitize($_POST['kkid']), 

                            //'prasyarat1' => intval($_POST['prasyarat1']), 
                            //'prasyarat2' => intval($_POST['prasyarat2']), 

                            //'sumber_dana' => sanitize($_POST['sumber_dana']), 
                            'kompetensi' => sanitize($_POST['kompetensi']), 
                            'deskripsi' => sanitize($_POST['deskripsi']),

                            'source_kode' => sanitize($_POST['source_kode']),
                  
                            'last_update' => "NOW()",
                            'userid' => intval($_POST['userid']));

              self::$db->update("diklat", $data, "id='" . Filter::$id . "'");
              (self::$db->affected()) ? Filter::msgOk(lang('DATA_UPDATED')) : Filter::msgAlert(lang('NOPROCCESS'));
		  
          } else
              print Filter::msgStatus();
		  
      }

      /**
       * Content::processAddDiklat()
       * 
       * @return
       */
      public function processAddDiklat()
      {
          if (empty($_POST['kode']))
              Filter::$msgs['kode'] = 'Silahkan masukkan Kode';

          if (empty($_POST['nama_diklat']))
              Filter::$msgs['nama_diklat'] = 'Silahkan masukkan Nama Diklat';

          if (empty($_POST['tahun']))
              Filter::$msgs['tahun'] = 'Silahkan masukkan Tahun';
          
          if (empty(Filter::$msgs)) {
			  
              $data = array('kode' => sanitize($_POST['kode']), 
                            'nama_diklat' => sanitize($_POST['nama_diklat']), 
                            'departemenid' => intval($_POST['departemenid']), 
                            'tahun' => intval($_POST['tahun']), 
                            'jml_jam' => intval($_POST['jml_jam']), 
                            'tingkat' => sanitize($_POST['tingkat']), 
                            'jenis' => sanitize($_POST['jenis']), 
                            'linkid' => sanitize($_POST['linkid']), 
                            'pskid' => sanitize($_POST['pskid']), 
                            'kkid' => sanitize($_POST['kkid']), 

                            //'prasyarat1' => intval($_POST['prasyarat1']), 
                            //'prasyarat2' => intval($_POST['prasyarat2']), 

                            //'sumber_dana' => sanitize($_POST['sumber_dana']), 
                            'kompetensi' => sanitize($_POST['kompetensi']), 
                            'deskripsi' => sanitize($_POST['deskripsi']), 

                            'source_kode' => sanitize($_POST['source_kode']), 
                            'source_name' => sanitize($_POST['source_name']), 

                            'last_update' => "NOW()",
                            'created' => "NOW()",
                            'userid' => intval($_POST['userid']));

              $lastid = self::$db->insert("diklat", $data);
              (self::$db->affected()) ? Filter::msgOk(lang('DATA_ADDED')) : Filter::msgAlert(lang('NOPROCCESS'));
			  		  
          } else
              print Filter::msgStatus();
      }

	  /**
	   * Content::DiklatJenisList()
	   * 
	   * @param string $selected
	   * @return
	   */
	  public function DiklatJenisList($selected = '')
	  {
	      $arr = array('D' => 'D : Dalam', 'L' => 'L : Luar');

		  $list = '';
		  foreach ($arr as $key => $val) {
			  $sel = ($key == $selected) ? ' selected="selected"' : '';
			  $list .= "<option value=\"" . $key . "\"" . $sel . ">" . $val . "</option>\n";
		  }
		  unset($val);
		  return $list;
	  }

      /**
       * Content::getDiklat_TingkatList()
       * 
       * @return
       */
      public function getDiklat_TingkatList()
      {
	  
          $sql = "SELECT *"
                . "\n FROM diklat_tingkat" 
                . "\n ORDER BY tingkat";
          $row = self::$db->fetch_all($sql);

          return ($row) ? $row : 0;
      }
	  	  
	  /**
	   * Content::Diklat_TingkatList()
	   * 
	   * @param string $selected
	   * @return
	   */
	  public function Diklat_TingkatList($selected = '')
	  {
              $arr = $this->getDiklat_TingkatList();
              
              if ($arr) {
                            
		  $list = '';
		  foreach ($arr as $val) {
			  $sel = ($val->tingkat == $selected) ? ' selected="selected"' : '';
			  $list .= "<option value=\"" . $val->tingkat . "\"" . $sel . ">" . $val->tingkat . "</option>\n";
		  }
		  unset($val);
		  return $list;
                  
              }
                  
	  }
            
	  /**
	   * Content::DiklatPesertaStatusList()
	   * 
	   * @param string $selected
	   * @return
	   */
	  public function DiklatPesertaStatusList($selected = '')
	  {
	        $arr = array('D' => 'D : Daftar', 'U' => 'U : Undang', 'R' => 'R : Registrasi', 'U' => 'V : Validasi', 'G' => 'G : Ganti' );

                $list = '';
                foreach ($arr as $key => $val) {
                        $sel = ($key == $selected) ? ' selected="selected"' : '';
                        $list .= "<option value=\"" . $key . "\"" . $sel . ">" . $val . "</option>\n";
                }
                unset($val);
                return $list;
	  }

	  /**
	   * Content::DiklatPesertaModeList()
	   * 
	   * @param string $selected
	   * @return
	   */
	  public function DiklatPesertaModeList($selected = '')
	  {
	        $arr = array('P' => 'P : Pilih', 'C' => 'C : Cadangan');

                $list = '';
                foreach ($arr as $key => $val) {
                        $sel = ($key == $selected) ? ' selected="selected"' : '';
                        $list .= "<option value=\"" . $key . "\"" . $sel . ">" . $val . "</option>\n";
                }
                unset($val);
                return $list;
	  }

      /**
       * Content::getDiklat_Jadwal() ------------------------------------------------------------------------------------------------------------------
       * 
       * @param $tgl_dari, $tgl_sampai, $departemenid
       * @return
       */
      public function getDiklat_Jadwal($tgl_dari, $tgl_sampai, $departemenid = 0)
      {	  

            if (isset($_GET['searchfield']))
                  $searchfield = strtolower(sanitize($_GET['searchfield']));
            else
                  $searchfield = '';

            if (isset($_GET['searchtext']))
                  $searchtext = strtolower(sanitize($_GET['searchtext']));
            else
                  $searchtext = '';
                                                        
            $q = "SELECT count(*) FROM diklat_jadwal AS dj LEFT JOIN diklat AS dk ON dj.diklatid = dk.id"
                ." WHERE (dj.tgl_mulai >= '" . $tgl_dari ."' AND dj.tgl_akhir <= '" . $tgl_sampai . "')";
        
            if ($departemenid > 0) {
                $q .= " AND dk.departemenid = " . $departemenid;                
                $sqlwhere = "(dj.tgl_mulai >= '" . $tgl_dari ."' AND dj.tgl_akhir <= '" . $tgl_sampai . "') AND dk.departemenid = " . $departemenid;
                
                if (($searchfield != '') && ($searchtext != '')) {
                    $q .= " AND LOWER(dk." . $searchfield . ") LIKE '%" . $searchtext . "%'";
                    $sqlwhere .= " AND LOWER(dk." . $searchfield . ") LIKE '%" . $searchtext . "%'";
                }
                                
            } else {
                $sqlwhere = "(dj.tgl_mulai >= '" . $tgl_dari ."' AND dj.tgl_akhir <= '" . $tgl_sampai . "')";
                
                if (($searchfield != '') && ($searchtext != '')) {
                    $q .= " AND LOWER(dk." . $searchfield . ") LIKE '%" . $searchtext . "%'";
                    $sqlwhere .= " AND LOWER(dk." . $searchfield . ") LIKE '%" . $searchtext . "%'";
                }
                
            }
	                        
            $record = Registry::get("Database")->query($q);
            $total = Registry::get("Database")->fetchrow($record);
            $counter = $total[0];

            $pager = Paginator::instance();
            $pager->items_total = $counter;
            $pager->default_ipp = Registry::get("Core")->perpage;
            $pager->paginate();

            if (isset($_GET['sortfield'])) {
                $sortfield = sanitize($_GET['sortfield']);
                if (isset($_GET['sorttype']))
                    $sorttype = sanitize($_GET['sorttype']);
                else
                    $sorttype = "DESC";
                
                if (in_array($sortfield, array("dk.kode", "dk.nama_diklat", 
                                               "dj.tgl_mulai", "dj.tgl_akhir"))) {
                    $sort = ($sorttype == 'DESC') ? " DESC " : " ASC ";
                    
                    if (($sortfield == "dk.kode") || ($sortfield == "dk.nama_diklat"))
                        $sqlorder = "LOWER(" . $sortfield . ") " . $sort;
                    else
                        $sqlorder = $sortfield . $sort;
                } else
                    $sqlorder = "dj.tgl_mulai DESC";
            } else
                    $sqlorder = "dj.tgl_mulai DESC";
                                    
            $sql = "SELECT dj.id, dj.diklatid, dj.tahun, DATE_FORMAT(dj.tgl_mulai, '%d/%m/%Y') AS tgl_mulai,"
                     . "\n DATE_FORMAT(dj.tgl_akhir, '%d/%m/%Y') AS tgl_akhir, dj.tempat,"
                     . "\n dk.kode, dk.nama_diklat, dk.tingkat,"
                     . "\n d.nama_departemen"
                     . "\n FROM (diklat_jadwal as dj"
                     . "\n LEFT JOIN diklat as dk ON dj.diklatid = dk.id)"
                     . "\n LEFT JOIN departemen as d ON dk.departemenid = d.id"
                     . "\n WHERE $sqlwhere"
                     . "\n ORDER By " . $sqlorder . $pager->limit;
             
             $row = self::$db->fetch_all($sql);

             return ($row) ? $row : 0;
  
      }


      /**
       * Content::getDiklat_JadwalList() ------------------------------------------------------------------------------------------------------------------
       * 
       * @param $tgl_dari, $tgl_sampai
       * @return
       */
      public function getDiklat_JadwalList($tgl_dari, $tgl_sampai)
      {

            $sql = "SELECT dj.*," 
                    . "\n d.kode, d.nama_diklat" 
                    . "\n FROM diklat_jadwal as dj" 
                    . "\n LEFT JOIN diklat as d" 
                    . "\n ON dj.diklatid = d.id" 
                    . "\n WHERE (dj.tgl_mulai >= '" . $tgl_dari ."' AND dj.tgl_akhir <= '" . $tgl_sampai . "')"
                    . "\n ORDER BY d.nama_diklat";
		  	
            $row = self::$db->fetch_all($sql);

            return ($row) ? $row : 0;
  
      }

     /**
       * Content::getDiklat_JadwalById()
       * 
       * @return
       */
      public function getDiklat_JadwalById($id)
      {
		  
            $sql = "SELECT dj.*,"
            . "\n d.kode, d.nama_diklat, d.tingkat, d.jenis"
            . "\n FROM diklat_jadwal as dj" 
            . "\n LEFT JOIN diklat as d ON dj.diklatid = d.id" 
            . "\n WHERE dj.id = '" . $id . "'";
          		  
            $row = self::$db->first($sql);

            return $row;
      }
	  	  
	  /**
	   * Content::processDiklat_Jadwal()
	   * 
	   * @return
	   */
	  public function processDiklat_Jadwal()
	  {
		  
                if (empty($_POST['diklatid']))
                        Filter::$msgs['diklatid'] = 'Diklat belum dipilih!';

                if (empty($_POST['tahun']))
                        Filter::$msgs['tahun'] = 'Tahun Diklat belum diisi!';

                if (empty($_POST['tgl_mulai']))
                        Filter::$msgs['tgl_mulai'] = 'Tgl Mulai belum diisi!';

                if (empty($_POST['tgl_akhir']))
                        Filter::$msgs['tgl_akhir'] = 'Tgl Akhir belum diisi!';

                if (empty($_POST['reg_mulai']))
                        Filter::$msgs['reg_mulai'] = 'Tgl Mulai Registrasi belum diisi!';

                if (empty($_POST['reg_akhir']))
                        Filter::$msgs['reg_akhir'] = 'Tgl Akhir Registrasi belum diisi!';

                if (empty(Filter::$msgs)) {

                    $tgl_mulai = sanitize($_POST['tgl_mulai']);
                    $tgl_mulai = setToSQLdate($tgl_mulai);
                    $tgl_akhir = sanitize($_POST['tgl_akhir']);
                    $tgl_akhir = setToSQLdate($tgl_akhir);
                    $reg_mulai = sanitize($_POST['reg_mulai']); 
                    $reg_mulai = setToSQLdate($reg_mulai);
                    $reg_akhir = sanitize($_POST['reg_akhir']);
                    $reg_akhir = setToSQLdate($reg_akhir);
                                        
                    $edata = array(
                                  'diklatid' => intval($_POST['diklatid']), 
                                  'tahun' => intval($_POST['tahun']), 
                                  'tgl_mulai' => $tgl_mulai, 
                                  'tgl_akhir' => $tgl_akhir,
                                  'reg_mulai' => $reg_mulai, 
                                  'reg_akhir' => $reg_akhir,
                                  'tempat' => sanitize($_POST['tempat']),
                                  'keterangan' => sanitize($_POST['keterangan']),

                                  'last_update' => "NOW()",
                                  'userid' => intval($_POST['userid'])
                    );

                    if (!Filter::$id)
                        $edata['created'] = "NOW()";											

                    (Filter::$id) ? self::$db->update("diklat_jadwal", $edata, "id='" . Filter::$id . "'") : self::$db->insert("diklat_jadwal", $edata);
                    $message = (Filter::$id) ? lang('DATA_UPDATED') : lang('DATA_ADDED');
                    (self::$db->affected()) ? Filter::msgOk($message) : Filter::msgAlert(lang('NOPROCCESS'));

                } else
                        print Filter::msgStatus();
	  }	  
	  
          
	  /**
	   * Content::AgamaList()-------------------------------------------------------------------------------------------------------------
	   * 
	   * @param string $selected
	   * @return
	   */
	  public function AgamaList($selected = '')
	  {
                $arr = array('Islam' => 'Islam', 'Protestan' => 'Protestan', 'Katholik' => 'Katholik', 'Hindu' => 'Hindu', 'Budha' => 'Budha',
                             'Khong Hu Chu' => 'Khong Hu Chu');

                $list = '';
                foreach ($arr as $key => $val) {
                        $sel = ($key == $selected) ? ' selected="selected"' : '';
                        $list .= "<option value=\"" . $key . "\"" . $sel . ">" . $val . "</option>\n";
                }
                unset($val);
                return $list;
	  }

        /**
         * Content::Status_KawinList()
         * 
         * @param string $selected
         * @return
         */
        public function Status_KawinList($selected = '')
        {
                $arr = array('Kawin', 'Belum Kawin', 'Janda', 'Duda');

                $list = '';
                foreach ($arr as $val) {
                        $sel = ($val == $selected) ? ' selected="selected"' : '';
                        $list .= "<option value=\"" . $val . "\"" . $sel . ">" . $val . "</option>\n";
                }
                unset($val);
                return $list;
        }

        /**
         * Content::Status_LulusList()
         * 
         * @param string $selected
         * @return
         */
        public function Status_LulusList($selected = '')
        {
                $arr = array('Lulus', 'Tidak Lulus');

                $list = '';
                foreach ($arr as $val) {
                        $sel = ($val == $selected) ? ' selected="selected"' : '';
                        $list .= "<option value=\"" . $val . "\"" . $sel . ">" . $val . "</option>\n";
                }
                unset($val);
                return $list;
        }
        
        
      /**
       * Content::StatusKepegawaianList()
       * 
       * @return
       */
      public function StatusKepegawaianList($selected = '')
      {          
            //$arr = array('PNS', 'PNS DPK', 'PNS DEPAG', 'GTY',
            //              'GTT', 'GTT PNS', 'PTT', 'GURU BINA',
            //              'GURU BANTU', 'GURU');
            $arr = array('PNS', 'NON-PNS');

            $list = '';
            foreach ($arr as $val) {
                  $sel = ($val == $selected) ? ' selected="selected"' : '';
                  $list .= "<option value=\"" . $val . "\"" . $sel . ">" . $val . "</option>\n";
            }
            unset($val);
            return $list;          
      }

      /**
       * Content::JenisKepegawaianList()
       * 
       * @return
       */
      public function JenisKepegawaianList($selected = '')
      {          
            $arr = array('GTT PNS', 'PNS DPK', 'PNS DEPAG', 'PTT', 'GURU');

            $list = '';
            foreach ($arr as $val) {
                  $sel = ($val == $selected) ? ' selected="selected"' : '';
                  $list .= "<option value=\"" . $val . "\"" . $sel . ">" . $val . "</option>\n";
            }
            unset($val);
            return $list;          
      }
            
      /**
       * Content::TugasPokokList()
       * 
       * @return
       */
      public function TugasPokokList($selected = '')
      {          
            $arr = array('Pendidik/Guru', 'Tenaga Kependidikan Formal', 'Pendidik dan Tenaga Kependidikan Formal', 'Pendidik dan Tenaga Kependidikan Non Formal');

            $list = '';
            foreach ($arr as $val) {
                  $sel = ($val == $selected) ? ' selected="selected"' : '';
                  $list .= "<option value=\"" . $val . "\"" . $sel . ">" . $val . "</option>\n";
            }
            unset($val);
            return $list;          
      }
      
      /**
       * Content::Status_GuruList()
       * 
       * @return
       */
      public function Status_GuruList($selected = '')
      {          
            $arr = array('Guru', 'Guru Bina', 'GTY', 'Guru Bantu', 'GTT');

            $list = '';
            foreach ($arr as $val) {
                  $sel = ($val == $selected) ? ' selected="selected"' : '';
                  $list .= "<option value=\"" . $val . "\"" . $sel . ">" . $val . "</option>\n";
            }
            unset($val);
            return $list;          
      }

      /**
       * Content::JabatanPokokList()
       * 
       * @return
       */
      public function JabatanPokokList($selected = '')
      {          
            $arr = array('Kepala Sekolah', 'Wakil Kepala Sekolah', 'Kepala TU', 
                         'Staf Administrasi TU', 'Bendahara', 'Laboran', 'Pustakawan',
                         'Petugas Instalasi', 'Juru Bengkel', 'Pesuruh/Penjaga Sekolah',
                         'Pengawas Sekolah');

            $list = '';
            foreach ($arr as $val) {
                  $sel = ($val == $selected) ? ' selected="selected"' : '';
                  $list .= "<option value=\"" . $val . "\"" . $sel . ">" . $val . "</option>\n";
            }
            unset($val);
            return $list;          
      }
            
      /**
       * Content::Kelompok_MataPelajaranList()
       * 
       * @return
       */
      public function Kelompok_MataPelajaranList($selected = '')
      {          
	      $arr = array('ADAPTIF', 'NORMATIF', 'PRODUKTIF', 'MUATAN LOKAL');

		  $list = '';
		  foreach ($arr as $val) {
                        $sel = ($val == $selected) ? ' selected="selected"' : '';
                        $list .= "<option value=\"" . $val . "\"" . $sel . ">" . $val . "</option>\n";
		  }
		  unset($val);
		  return $list;          
      }


      /**
       * Content::getMataPelajaranList()
       * 
       * @return
       */
      public function getMataPelajaranList($kelid)
      {

          $sql = "SELECT id, nama_matapelajaran" 
                . "\n FROM matapelajaran" 
                . "\n WHERE kelid = "  . $kelid
                . "\n ORDER BY nama_matapelajaran";

          $row = self::$db->fetch_all($sql);

          return ($row) ? $row : 0;
      }

        /**
         * Content::Sertifikasi_GuruList()
         * 
         * @param string $selected
         * @return
         */
        public function Sertifikasi_GuruList($selected = '')
        {
              $arr = array('Sudah' => 'Sudah Sertifikasi', 'Proses' => 'Proses Sertifikasi', 'Belum' => 'Belum Sertifikasi');

              $list = '';
              foreach ($arr as $key => $val) {
                      $sel = ($key == $selected) ? ' selected="selected"' : '';
                      $list .= "<option value=\"" . $key . "\"" . $sel . ">" . $val . "</option>\n";
              }
              unset($val);
              return $list;
        }
      
      
      
      /**
       * Content::SekolahStatus_MilikList() ----------- lookup sekolah ---------
       * 
       * @return
       */
      public function SekolahStatus_MilikList($selected = '')
      {          
            $arr = array('Lembaga', 'Pemerintah Daerah', 'Pemerintah Pusat', 'Yayasan');

            $list = '';
            foreach ($arr as $val) {
                  $sel = ($val == $selected) ? ' selected="selected"' : '';
                  $list .= "<option value=\"" . $val . "\"" . $sel . ">" . $val . "</option>\n";
            }
            unset($val);
            return $list;          
      }
      
      /**
       * Content::SekolahStatusList()
       * 
       * @return
       */
      public function SekolahStatusList($selected = '')
      {          
            $arr = array('Lembaga', 'Negeri', 'Swasta', 'Yayasan');

            $list = '';
            foreach ($arr as $val) {
                  $sel = ($val == $selected) ? ' selected="selected"' : '';
                  $list .= "<option value=\"" . $val . "\"" . $sel . ">" . $val . "</option>\n";
            }
            unset($val);
            return $list;          
      }
      
      /**
       * Content::SekolahAkreditasiList()
       * 
       * @return
       */
      public function SekolahAkreditasiList($selected = '')
      {          
            $arr = array('A', 'B', 'C', 'Proses', 'Belum');

            $list = '';
            foreach ($arr as $val) {
                  $sel = ($val == $selected) ? ' selected="selected"' : '';
                  $list .= "<option value=\"" . $val . "\"" . $sel . ">" . $val . "</option>\n";
            }
            unset($val);
            return $list;          
      }

      /**
       * Content::SekolahSertf_ISOList()
       * 
       * @return
       */
      public function SekolahSertf_ISOList($selected = '')
      {          
            $arr = array('Bersertifikat', 'Proses Sertifikasi', 'Belum Sertifikasi');

            $list = '';
            foreach ($arr as $val) {
                  $sel = ($val == $selected) ? ' selected="selected"' : '';
                  $list .= "<option value=\"" . $val . "\"" . $sel . ">" . $val . "</option>\n";
            }
            unset($val);
            return $list;          
      }
      
      /**
       * Content::getTugas_PokokList()
       * 
       * @return
       */
      public function getTugas_PokokList()
      {	  
          $sql = "SELECT *"
                . "\n FROM tugas_pokok" 
                . "\n ORDER BY nama_tugas";
          $row = self::$db->fetch_all($sql);

          return ($row) ? $row : 0;
      }

      /**
       * Content::getJabatan_PokokList()
       * 
       * @return
       */
      public function getJabatan_PokokList()
      {
          $sql = "SELECT *"
                . "\n FROM jabatan_pokok" 
                . "\n ORDER BY nama_jabatan";
          $row = self::$db->fetch_all($sql);

          return ($row) ? $row : 0;
      }

	  /**
	   * Content::YaTidakList()
	   * 
	   * @param string $selected
	   * @return
	   */
	  public function YaTidakList($selected = '')
	  {
	      $arr = array('Ya', 'Tidak');

		  $list = '';
		  foreach ($arr as $val) {
			  $sel = ($val == $selected) ? ' selected="selected"' : '';
			  $list .= "<option value=\"" . $val . "\"" . $sel . ">" . $val . "</option>\n";
		  }
		  unset($val);
		  return $list;                                                                        
	  }
  
  
       /**
       * Content::getDiklat_CalonPeserta()-------------------------------------------------------------------------------------------------------------
       * 
       * @return
       */
      public function getDiklat_CalonPeserta($jadwalid = 0, $status = 'P')
      {

            if (isset($_GET['propinsi_kode']))
                  $propinsi_kode = sanitize($_GET['propinsi_kode']);
            else
                  $propinsi_kode = '';

            if (isset($_GET['kota_kode']))
                  $kota_kode = sanitize($_GET['kota_kode']);
            else
                  $kota_kode = '';
                    
            if (isset($_GET['searchfield']))
                $searchfield = strtolower(sanitize($_GET['searchfield']));
            else
                $searchfield = '';

            if (isset($_GET['searchtext']))
                $searchtext = strtolower(sanitize($_GET['searchtext']));
            else
                $searchtext = '';
                                      
            if ($jadwalid > 0) {
              $q = "SELECT COUNT(*)"
                ."\n FROM diklat_calonpeserta AS da"
                ."\n WHERE da.jadwalid = ". $jadwalid . " AND da.status = '" . $status . "'";
              
              $sqlwhere = "WHERE da.jadwalid = " . $jadwalid . " AND da.status = '" . $status . "'";
            } else {
              $q = "SELECT COUNT(*)"
                ."\n FROM diklat_calonpeserta AS da"
                ."\n WHERE da.status = '" . $status . "'";
              
              $sqlwhere = "WHERE da.status = '" . $status . "'";
            }
            
            if ($propinsi_kode != '') {
                  if ($kota_kode != '') {
                          $q .= " AND da.propinsi_kode = '" . $propinsi_kode . "' AND da.kota_kode = '" . $kota_kode . "'";
                          $sqlwhere .= " AND da.propinsi_kode = '" . $propinsi_kode . "' AND da.kota_kode = '" . $kota_kode . "'";

                  } else {
                          $q .= " AND da.propinsi_kode = '" . $propinsi_kode . "'";
                          $sqlwhere .= " AND da.propinsi_kode = '" . $propinsi_kode . "'";
                  }
            } else {
                  if ($kota_kode != '') {
                          $q .= " AND da.kota_kode = '" . $kota_kode . "'";
                          $sqlwhere .= " AND da.kota_kode = '" . $kota_kode . "'";
                  }
            }
                                                
            if (($searchtext != '') && ($searchfield != '')) {
                $q .= " AND LOWER(" . $searchfield .") LIKE '%". $searchtext ."%'";
                
                $sqlwhere .= " AND LOWER(" . $searchfield .") LIKE '%". $searchtext ."%'";
            }

            $record = Registry::get("Database")->query($q);
            $total = Registry::get("Database")->fetchrow($record);
            $counter = $total[0];		

            $pager = Paginator::instance();
            $pager->items_total = $counter;		   
            $pager->default_ipp = Registry::get("Core")->perpage;
            $pager->paginate();
          
            if (isset($_GET['sortfield'])) {
                $sortfield = sanitize($_GET['sortfield']);
                if (isset($_GET['sorttype']))
                    $sorttype = sanitize($_GET['sorttype']);
                else
                    $sorttype = "ASC";

                if (in_array($sortfield, array("da.tgl_ajuan", "da.nama_lengkap", "da.tgl_lahir", 
                                                "p.nama_propinsi", "k.nama_kota",
                                                "da.nama_sekolah", "da.pendidikan_akhir",
                                                "da.ijazah_akhir"))) {
                    
                    if ($sortfield == "pt.tgl_lahir" )
                        $sort = ($sorttype == 'DESC') ? " ASC " : " DESC ";
                    else
                        $sort = ($sorttype == 'DESC') ? " DESC " : " ASC ";

                    if (($sortfield != "da.tgl_ajuan") || ($sortfield != "pt.tgl_lahir" ))
                        $sqlorder = "LOWER(" . $sortfield . ") " . $sort;
                    else
                        $sqlorder = $sortfield . $sort;
                } else
                    $sqlorder = "da.tgl_ajuan DESC";
            } else
                $sqlorder = "da.tgl_ajuan DESC";
                                    
            $sql = "SELECT da.*,"
                    . "\n p.nama_propinsi,"
                    . "\n k.nama_kota" 
                    . "\n FROM (((diklat_calonpeserta AS da" 
                    . "\n LEFT JOIN propinsi AS p ON da.propinsi_kode = p.kode)" 
                    . "\n LEFT JOIN kota AS k ON da.kota_kode = k.kode)" 
                    . "\n LEFT JOIN diklat_jadwal AS dj ON da.jadwalid = dj.id)" 
                    . "\n LEFT JOIN diklat AS dk ON dj.diklatid = dk.id" 
                    . "\n $sqlwhere"
                    . "\n ORDER BY " . $sqlorder . $pager->limit;

            $row = self::$db->fetch_all($sql);

            return ($row) ? $row : 0;
	  
      }

     /**
       * Content::getDiklat_CalonPesertaById()
       * 
       * @return
       */
      public function getDiklat_CalonPesertaById($id)
      {
		  
          $sql = "SELECT dc.*,"
                . "\n p.nama_propinsi,"
                . "\n k.nama_kota"
                . "\n FROM (((diklat_calonpeserta AS dc"
                . "\n LEFT JOIN propinsi AS p ON dc.propinsi_kode = p.kode)"
                . "\n LEFT JOIN kota AS k ON dc.kota_kode = k.kode)"
                . "\n LEFT JOIN diklat_jadwal AS dj ON dc.jadwalid = dj.id)" 
                . "\n LEFT JOIN diklat AS dk ON dj.diklatid = dk.id" 
                . "\n WHERE dc.id = '" . $id . "'";
          		  
          $row = self::$db->first($sql);

          return $row;
      }
      
      
      /**
       * Users::Diklat_CalonPesertaPTKExists($personid, $jadwalid)
       * 
       * @param 
       * @return
       */
      private function Diklat_CalonPesertaPTKExists($personid, $jenis, $jadwalid)
      {

          $sql = self::$db->query("SELECT id FROM diklat_calonpeserta WHERE personid = " . $personid . " AND jenis = '" . $jenis . "' AND jadwalid = '" .$jadwalid . "' LIMIT 1");

          $count = self::$db->numrows($sql);

          return ($count > 0) ? 3 : false;
      }	  
	  
	  /**
       * Content::processDiklat_CalonPeserta()
       * 
       * @return
       */
      public function processDiklat_CalonPeserta()
      {

          if (empty($_POST['jadwalid']))
              Filter::$msgs['jadwalid'] = 'Jadwal Diklat belum dipilih!';
          
          if (empty($_POST['personid']))
              Filter::$msgs['personid'] = 'Tidak ada orang yang dipilih!';

          if (empty(Filter::$msgs)) {

                $jenis = sanitize($_POST['jenis']);
                $status = sanitize($_POST['status']);
                $jadwalid = intval($_POST['jadwalid']);
                $scount = 0;

                foreach ($_POST['personid'] as $key => $val) {

                    $personid = intval($_POST['personid'][$key]);
                    $instansiid = intval($_POST['instansiid'][$key]);

                    $nama_lengkap = null;
                    $gelar_depan1 = null;
                    $gelar_depan2 = null;
                    $gelar_depan3 = null;

                    $gelar_belakang1 = null;
                    $gelar_belakang2 = null;
                    $gelar_belakang3 = null;

                    $nip = null;
                    $nuptk = null;

                    $golongan = null;
                    $pendidikan_akhir = null;
                    $ijazah_akhir = null;
                    $fakultas_akhir = null;
                    $jurusan_akhir = null;
                    $tahun_lulus_akhir = null;

                    $tgl_lahir = null;
                    $tmp_lahir = null;
                    $jns_klmn = null;
                    $nama_ibu = null;                    
                    
                    $agama = null;
                    $propinsi_kode = null;
                    $kota_kode = null;
                    $alamat = null;
                    $telepon1 = null;
                    $telepon2 = null;

                    $nss = null;
                    $nama_sekolah = null;
                    $status_sekolah = null;
                    $nama_pimpinan = null;                    
                    $alamat_sekolah = null;
                    $propinsi_kode_sekolah = null;
                    $kota_kode_sekolah = null;
                    $telepon_sekolah = null;
                    $fax_sekolah = null;
                    $kodepos_sekolah = null;
                    $email = null;
                    $website = null;
                                        
                    if (!$this->Diklat_CalonPesertaPTKExists($personid, $jenis, $jadwalid)) {
                        
                        // -- get data --
                        
                        if ($jenis == 'P') {
                            
                            $sql = "SELECT pt.id,pt.gelar_depan1,pt.gelar_depan2,pt.gelar_depan3," 
                                  . "\n pt.gelar_belakang1,pt.gelar_belakang2,pt.gelar_belakang3,"
                                  . "\n pt.nuptk, pt.nip, pt.nama_lengkap,pt.golongan,pt.pendidikan_akhir," 
                                  . "\n pt.ijazah_akhir, pt.fakultas_akhir, pt.jurusan_akhir,pt.tahun_lulus_akhir,"
                                  . "\n pt.tgl_lahir, pt.tmp_lahir, pt.jns_klmn,pt.nama_ibu,"                                    
                                  . "\n pt.agama, pt.propinsi_kode, pt.kota_kode, pt.alamat, pt.telepon1,pt.telepon2," 
                                  . "\n s.nss, s.nama_sekolah, s.status AS status_sekolah, s.nama_pimpinan, s.alamat AS alamat_sekolah," 
                                  . "\n s.propinsi_kode AS propinsi_kode_sekolah, s.kota_kode AS kota_kode_sekolah, s.telepon AS telepon_sekolah,"
                                  . "\n s.fax AS fax_sekolah, s.kodepos AS kodepos_sekolah, s.email, s.website" 
                                  . "\n FROM ptk AS pt" 
                                  . "\n LEFT JOIN sekolah AS s ON pt.sekolahid = s.id" 
                                  . "\n WHERE pt.id = " . $personid ;
                            
                            $erow = self::$db->first($sql);
                            if ($erow) {
                               
                                $nama_lengkap = $erow->nama_lengkap;
                                $gelar_depan1 = $erow->gelar_depan1;
                                $gelar_depan2 = $erow->gelar_depan2;
                                $gelar_depan3 = $erow->gelar_depan3;

                                $gelar_belakang1 = $erow->gelar_belakang1;
                                $gelar_belakang2 = $erow->gelar_belakang2;
                                $gelar_belakang3 = $erow->gelar_belakang3;

                                $nip = $erow->nip;
                                $nuptk = $erow->nuptk;

                                $golongan = $erow->golongan;
                                $pendidikan_akhir = $erow->pendidikan_akhir;
                                $ijazah_akhir = $erow->ijazah_akhir;
                                $fakultas_akhir = $erow->fakultas_akhir;
                                $jurusan_akhir = $erow->jurusan_akhir;
                                $tahun_lulus_akhir = $erow->tahun_lulus_akhir;

                                $tgl_lahir = $erow->tgl_lahir; 
                                $tmp_lahir = $erow->tmp_lahir;
                                $jns_klmn = $erow->jns_klmn;
                                $nama_ibu = $erow->nama_ibu;
                                                                
                                $agama = $erow->agama;
                                $propinsi_kode = $erow->propinsi_kode;
                                $kota_kode = $erow->kota_kode;
                                $alamat = $erow->alamat;
                                $telepon1 = $erow->telepon1;
                                $telepon2 = $erow->telepon2;

                                $nss = $erow->nss;
                                $nama_sekolah = $erow->nama_sekolah;
                                $status_sekolah = $erow->status_sekolah;
                                $nama_pimpinan = $erow->nama_pimpinan;
                                $alamat_sekolah = $erow->alamat_sekolah;
                                $propinsi_kode_sekolah = $erow->propinsi_kode_sekolah;
                                $kota_kode_sekolah = $erow->kota_kode_sekolah;
                                $telepon_sekolah = $erow->telepon_sekolah;
                                $fax_sekolah = $erow->fax_sekolah;
                                $kodepos_sekolah = $erow->kodepos_sekolah;
                                $email = $erow->email;
                                $website = $erow->website;
                                                                
                                unset($erow);
                            }                         
                            
                        } else {
                            // -- staff --

                            $sql = "SELECT st.id,st.gelar_depan1,st.gelar_depan2,st.gelar_depan3," 
                                  . "\n st.gelar_belakang1,st.gelar_belakang2,st.gelar_belakang3,"
                                  . "\n st.nuptk, st.nip, st.nama_lengkap,st.golongan,st.pendidikan_akhir," 
                                  . "\n st.ijazah_akhir, st.fakultas_akhir, st.jurusan_akhir,st.tahun_lulus_akhir," 
                                  . "\n st.tgl_lahir, st.tmp_lahir, st.jns_klmn, st.nama_ibu, st.agama,"
                                  . "\n st.propinsi_kode, st.kota_kode, st.alamat, st.telepon1,st.telepon2," 
                                  . "\n l.nama_lembaga, l.alamat AS alamat_lembaga, l.nama_pimpinan," 
                                  . "\n l.propinsi_kode AS propinsi_kode_lembaga, l.kota_kode AS kota_kode_lembaga,"
                                  . "\n l.telepon1 AS telepon_lembaga, l.fax AS fax_lembaga, l.kodepos AS kodepos_lembaga, l.email, l.website" 
                                  . "\n FROM staff AS st" 
                                  . "\n LEFT JOIN lembaga AS l ON st.lembagaid = l.id" 
                                  . "\n WHERE st.id = " . $personid ;
                            
                            $erow = self::$db->first($sql);
                            if ($erow) {
                               
                                $nama_lengkap = $erow->nama_lengkap;
                                $gelar_depan1 = $erow->gelar_depan1;
                                $gelar_depan2 = $erow->gelar_depan2;
                                $gelar_depan3 = $erow->gelar_depan3;

                                $gelar_belakang1 = $erow->gelar_belakang1;
                                $gelar_belakang2 = $erow->gelar_belakang2;
                                $gelar_belakang3 = $erow->gelar_belakang3;

                                $nip = $erow->nip;
                                $nuptk = $erow->nuptk;

                                $golongan = $erow->golongan;
                                $pendidikan_akhir = $erow->pendidikan_akhir;
                                $ijazah_akhir = $erow->ijazah_akhir;
                                $fakultas_akhir = $erow->fakultas_akhir;
                                $jurusan_akhir = $erow->jurusan_akhir;
                                $tahun_lulus_akhir = $erow->tahun_lulus_akhir;

                                $tgl_lahir = $erow->tgl_lahir; 
                                $tmp_lahir = $erow->tmp_lahir;
                                $jns_klmn = $erow->jns_klmn;
                                $nama_ibu = $erow->nama_ibu;                                
                                
                                $agama = $erow->agama;
                                $alamat = $erow->alamat;
                                $propinsi_kode = $erow->propinsi_kode;
                                $kota_kode = $erow->kota_kode;
                                $telepon1 = $erow->telepon1;
                                $telepon2 = $erow->telepon2;

                                $nama_sekolah = $erow->nama_lembaga;
                                $alamat_sekolah = $erow->alamat_lembaga;
                                $nama_pimpinan = $erow->nama_pimpinan;
                                $propinsi_kode_sekolah = $erow->propinsi_kode_lembaga;
                                $kota_kode_sekolah = $erow->kota_kode_lembaga;
                                $telepon_sekolah = $erow->telepon_lembaga;
                                $fax_sekolah = $erow->fax_lembaga;
                                $kodepos_sekolah = $erow->kodepos_lembaga;                                
                                $email = $erow->email;
                                $website = $erow->website;
                                                                
                                unset($erow);
                            }                         
                                                        
                        }
                                                
                        $edata = array(
                                        'jadwalid' => $jadwalid, 
                                        'personid' => $personid,
                                        'instansiid' => $instansiid,
                                        'jenis' => $jenis,
                                        'tgl_ajuan' => 'NOW()',
                            
                                    'nama_lengkap' => $nama_lengkap,
                                    'gelar_depan1' => $gelar_depan1,
                                    'gelar_depan2' => $gelar_depan2,
                                    'gelar_depan3' => $gelar_depan3,

                                    'gelar_belakang1' => $gelar_belakang1,
                                    'gelar_belakang2' => $gelar_belakang2,
                                    'gelar_belakang3' => $gelar_belakang3,

                                    'nip' => $nip,
                                    'nuptk' => $nuptk,

                                    'golongan' => $golongan,
                                    'pendidikan_akhir' => $pendidikan_akhir,
                                    'ijazah_akhir' => $ijazah_akhir,
                                    'fakultas_akhir' => $fakultas_akhir,
                                    'jurusan_akhir' => $jurusan_akhir,
                                    'tahun_lulus_akhir' => $tahun_lulus_akhir,

                                    'tgl_lahir' => $tgl_lahir,
                                    'tmp_lahir' => $tmp_lahir,
                                    'jns_klmn' => $jns_klmn,
                                    'nama_ibu' => $nama_ibu,
                                                        
                                    'agama' => $agama,
                                    'propinsi_kode' => $propinsi_kode,
                                    'kota_kode' => $kota_kode,
                                    'alamat' => $alamat,
                                    'telepon1' => $telepon1,
                                    'telepon2' => $telepon2,

                                    'nss' => $nss,
                                    'nama_sekolah' => $nama_sekolah,
                                    'status_sekolah' => $status_sekolah,
                                    'nama_pimpinan' => $nama_pimpinan ,
                                    'alamat_sekolah' => $alamat_sekolah,
                                    'propinsi_kode_sekolah' => $propinsi_kode_sekolah,
                                    'kota_kode_sekolah' => $kota_kode_sekolah,
                                    'telepon_sekolah' => $telepon_sekolah,
                                    'fax_sekolah' => $fax_sekolah,
                                    'kodepos_sekolah' => $kodepos_sekolah,
                                                        
                                    'email' => $email,
                                    'website' => $website,                                                        
                            
                                        'status' => $status,

                                        'last_update' => 'NOW()',
                                        'created' => 'NOW()',
                                        'userid' => intval($_POST['userid']));
                        
                        self::$db->insert("diklat_calonpeserta", $edata);

                        if (self::$db->affected()) $scount++;

                    }
                }
			
                $message = $scount . ' Data Calon Peserta diklat berhasil diproses.';
	        ($scount > 0) ? Filter::msgOk($message) : Filter::msgAlert(lang('NOPROCCESS'));
 
			  
          } else
              print Filter::msgStatus();
      }

      
        /**
       * Content::processDiklat_CalonPesertaGanti()
       * 
       * @return
       */
      public function processDiklat_CalonPesertaGanti()
      {
          
          if (empty($_POST['id']))
              Filter::$msgs['id'] = 'Data Calon Peserta Diklat belum dipilih!';

          if (empty($_POST['peserta_gantiid']))
              Filter::$msgs['peserta_gantiid'] = 'Data Peserta Diklat Pengganti belum dipilih!';
			  			  
          if (empty(Filter::$msgs)) {

                $id = intval($_POST['id']);
                $peserta_gantiid = intval($_POST['peserta_gantiid']);
                $userid = intval($_POST['userid']);

                // 1. peserta : id => "P" to "C", set ganti NOW()

                self::$db->query("UPDATE diklat_calonpeserta SET status = 'C', gantiid = '". $peserta_gantiid . "', tgl_ganti = NOW(), userid = '" . $userid . "' WHERE id = '" . $id . "'"); 

                // 2. peserta : gantiid => "C" to "P", set ganti NOW()

                self::$db->query("UPDATE diklat_calonpeserta SET status = 'P', gantiid = '". $id . "', tgl_ganti = NOW(), userid = '" . $userid . "' WHERE id = '" . $peserta_gantiid . "'"); 
												
	        Filter::msgOk('Data Data berhasil diproses.');
 			  
          } else
              print Filter::msgStatus();
      }
     
       /**
       * Content::updateDiklat_CalonPeserta()
       * 
       * @return
       */
      public function updateDiklat_CalonPeserta()
      {

            $sql = "SELECT id, personid, instansiid, jenis" 
                  . "\n FROM diklat_calonpeserta" 
                  . "\n WHERE id = " . Filter::$id;

            $cprow = self::$db->first($sql);
            if ($cprow) {
          
                $nama_lengkap = null;
                $gelar_depan1 = null;
                $gelar_depan2 = null;
                $gelar_depan3 = null;

                $gelar_belakang1 = null;
                $gelar_belakang2 = null;
                $gelar_belakang3 = null;

                $nip = null;
                $nuptk = null;

                $golongan = null;
                $pendidikan_akhir = null;
                $ijazah_akhir = null;
                $fakultas_akhir = null;
                $jurusan_akhir = null;
                $tahun_lulus_akhir = null;

                $tgl_lahir = null;
                $tmp_lahir = null;
                $jns_klmn = null;
                $nama_ibu = null;                    

                $agama = null;
                $propinsi_kode = null;
                $kota_kode = null;
                $alamat = null;
                $telepon1 = null;
                $telepon2 = null;

                $nss = null;
                $nama_sekolah = null;
                $status_sekolah = null;
                $nama_pimpinan = null;                    
                $alamat_sekolah = null;
                $propinsi_kode_sekolah = null;
                $kota_kode_sekolah = null;
                $telepon_sekolah = null;
                $fax_sekolah = null;
                $kodepos_sekolah = null;
                $email = null;
                $website = null;

                // -- get data --

                if ($cprow->jenis == 'P') {

                    $sql = "SELECT pt.id,pt.gelar_depan1,pt.gelar_depan2,pt.gelar_depan3," 
                          . "\n pt.gelar_belakang1,pt.gelar_belakang2,pt.gelar_belakang3,"
                          . "\n pt.nuptk, pt.nip, pt.nama_lengkap,pt.golongan,pt.pendidikan_akhir," 
                          . "\n pt.ijazah_akhir, pt.fakultas_akhir, pt.jurusan_akhir,pt.tahun_lulus_akhir,"
                          . "\n pt.tgl_lahir, pt.tmp_lahir, pt.jns_klmn,pt.nama_ibu,"                                    
                          . "\n pt.agama, pt.propinsi_kode, pt.kota_kode, pt.alamat, pt.telepon1,pt.telepon2," 
                          . "\n s.nss, s.nama_sekolah, s.status AS status_sekolah, s.nama_pimpinan, s.alamat AS alamat_sekolah," 
                          . "\n s.propinsi_kode AS propinsi_kode_sekolah, s.kota_kode AS kota_kode_sekolah, s.telepon AS telepon_sekolah,"
                          . "\n s.fax AS fax_sekolah, s.kodepos AS kodepos_sekolah, s.email, s.website" 
                          . "\n FROM ptk AS pt" 
                          . "\n LEFT JOIN sekolah AS s ON pt.sekolahid = s.id" 
                          . "\n WHERE pt.id = " . $cprow->personid ;

                    $erow = self::$db->first($sql);
                    if ($erow) {

                        $nama_lengkap = $erow->nama_lengkap;
                        $gelar_depan1 = $erow->gelar_depan1;
                        $gelar_depan2 = $erow->gelar_depan2;
                        $gelar_depan3 = $erow->gelar_depan3;

                        $gelar_belakang1 = $erow->gelar_belakang1;
                        $gelar_belakang2 = $erow->gelar_belakang2;
                        $gelar_belakang3 = $erow->gelar_belakang3;

                        $nip = $erow->nip;
                        $nuptk = $erow->nuptk;

                        $golongan = $erow->golongan;
                        $pendidikan_akhir = $erow->pendidikan_akhir;
                        $ijazah_akhir = $erow->ijazah_akhir;
                        $fakultas_akhir = $erow->fakultas_akhir;
                        $jurusan_akhir = $erow->jurusan_akhir;
                        $tahun_lulus_akhir = $erow->tahun_lulus_akhir;

                        $tgl_lahir = $erow->tgl_lahir; 
                        $tmp_lahir = $erow->tmp_lahir;
                        $jns_klmn = $erow->jns_klmn;
                        $nama_ibu = $erow->nama_ibu;

                        $agama = $erow->agama;
                        $propinsi_kode = $erow->propinsi_kode;
                        $kota_kode = $erow->kota_kode;
                        $alamat = $erow->alamat;
                        $telepon1 = $erow->telepon1;
                        $telepon2 = $erow->telepon2;

                        $nss = $erow->nss;
                        $nama_sekolah = $erow->nama_sekolah;
                        $status_sekolah = $erow->status_sekolah;
                        $nama_pimpinan = $erow->nama_pimpinan;
                        $alamat_sekolah = $erow->alamat_sekolah;
                        $propinsi_kode_sekolah = $erow->propinsi_kode_sekolah;
                        $kota_kode_sekolah = $erow->kota_kode_sekolah;
                        $telepon_sekolah = $erow->telepon_sekolah;
                        $fax_sekolah = $erow->fax_sekolah;
                        $kodepos_sekolah = $erow->kodepos_sekolah;
                        $email = $erow->email;
                        $website = $erow->website;

                        unset($erow);
                    }                         

                } else {
                    // -- staff --

                    $sql = "SELECT st.id,st.gelar_depan1,st.gelar_depan2,st.gelar_depan3," 
                          . "\n st.gelar_belakang1,st.gelar_belakang2,st.gelar_belakang3,"
                          . "\n st.nuptk, st.nip, st.nama_lengkap,st.golongan,st.pendidikan_akhir," 
                          . "\n st.ijazah_akhir, st.fakultas_akhir, st.jurusan_akhir,st.tahun_lulus_akhir," 
                          . "\n st.tgl_lahir, st.tmp_lahir, st.jns_klmn, st.nama_ibu, st.agama,"
                          . "\n st.propinsi_kode, st.kota_kode, st.alamat, st.telepon1,st.telepon2," 
                          . "\n l.nama_lembaga, l.alamat AS alamat_lembaga, l.nama_pimpinan," 
                          . "\n l.propinsi_kode AS propinsi_kode_lembaga, l.kota_kode AS kota_kode_lembaga,"
                          . "\n l.telepon1 AS telepon_lembaga, l.fax AS fax_lembaga, l.kodepos AS kodepos_lembaga, l.email, l.website" 
                          . "\n FROM staff AS st" 
                          . "\n LEFT JOIN lembaga AS l ON st.lembagaid = l.id" 
                          . "\n WHERE st.id = " . $cprow->personid ;

                    $erow = self::$db->first($sql);
                    if ($erow) {

                        $nama_lengkap = $erow->nama_lengkap;
                        $gelar_depan1 = $erow->gelar_depan1;
                        $gelar_depan2 = $erow->gelar_depan2;
                        $gelar_depan3 = $erow->gelar_depan3;

                        $gelar_belakang1 = $erow->gelar_belakang1;
                        $gelar_belakang2 = $erow->gelar_belakang2;
                        $gelar_belakang3 = $erow->gelar_belakang3;

                        $nip = $erow->nip;
                        $nuptk = $erow->nuptk;

                        $golongan = $erow->golongan;
                        $pendidikan_akhir = $erow->pendidikan_akhir;
                        $ijazah_akhir = $erow->ijazah_akhir;
                        $fakultas_akhir = $erow->fakultas_akhir;
                        $jurusan_akhir = $erow->jurusan_akhir;
                        $tahun_lulus_akhir = $erow->tahun_lulus_akhir;

                        $tgl_lahir = $erow->tgl_lahir; 
                        $tmp_lahir = $erow->tmp_lahir;
                        $jns_klmn = $erow->jns_klmn;
                        $nama_ibu = $erow->nama_ibu;                                

                        $agama = $erow->agama;
                        $alamat = $erow->alamat;
                        $propinsi_kode = $erow->propinsi_kode;
                        $kota_kode = $erow->kota_kode;
                        $telepon1 = $erow->telepon1;
                        $telepon2 = $erow->telepon2;

                        $nama_sekolah = $erow->nama_lembaga;
                        $alamat_sekolah = $erow->alamat_lembaga;
                        $nama_pimpinan = $erow->nama_pimpinan;
                        $propinsi_kode_sekolah = $erow->propinsi_kode_lembaga;
                        $kota_kode_sekolah = $erow->kota_kode_lembaga;
                        $telepon_sekolah = $erow->telepon_lembaga;
                        $fax_sekolah = $erow->fax_lembaga;
                        $kodepos_sekolah = $erow->kodepos_lembaga;                                
                        $email = $erow->email;
                        $website = $erow->website;

                        unset($erow);
                    }                         

                }

                $edata = array(

                            'nama_lengkap' => $nama_lengkap,
                            'gelar_depan1' => $gelar_depan1,
                            'gelar_depan2' => $gelar_depan2,
                            'gelar_depan3' => $gelar_depan3,

                            'gelar_belakang1' => $gelar_belakang1,
                            'gelar_belakang2' => $gelar_belakang2,
                            'gelar_belakang3' => $gelar_belakang3,

                            'nip' => $nip,
                            'nuptk' => $nuptk,

                            'golongan' => $golongan,
                            'pendidikan_akhir' => $pendidikan_akhir,
                            'ijazah_akhir' => $ijazah_akhir,
                            'fakultas_akhir' => $fakultas_akhir,
                            'jurusan_akhir' => $jurusan_akhir,
                            'tahun_lulus_akhir' => $tahun_lulus_akhir,

                            'tgl_lahir' => $tgl_lahir,
                            'tmp_lahir' => $tmp_lahir,
                            'jns_klmn' => $jns_klmn,
                            'nama_ibu' => $nama_ibu,

                            'agama' => $agama,
                            'propinsi_kode' => $propinsi_kode,
                            'kota_kode' => $kota_kode,
                            'alamat' => $alamat,
                            'telepon1' => $telepon1,
                            'telepon2' => $telepon2,

                            'nss' => $nss,
                            'nama_sekolah' => $nama_sekolah,
                            'status_sekolah' => $status_sekolah,
                            'nama_pimpinan' => $nama_pimpinan ,
                            'alamat_sekolah' => $alamat_sekolah,
                            'propinsi_kode_sekolah' => $propinsi_kode_sekolah,
                            'kota_kode_sekolah' => $kota_kode_sekolah,
                            'telepon_sekolah' => $telepon_sekolah,
                            'fax_sekolah' => $fax_sekolah,
                            'kodepos_sekolah' => $kodepos_sekolah,

                            'email' => $email,
                            'website' => $website,                                                        

                            'last_update' => 'NOW()');

                self::$db->update("diklat_calonpeserta", $edata, "id = " . Filter::$id);

                if (self::$db->affected()) 
                    Filter::msgOk('Data Calon Peserta berhasil diupdate.');
                else 
                    Filter::msgAlert(lang('NOPROCCESS'));
			  
          } else
              print Filter::msgStatus();
      }
                  
      /**
       * Content::getDiklat_CalonPesertaSorting()
       * 
       * @return
       */
        public function getDiklat_CalonPesertaSortOption($sortby)
        {
                $arr = array(
                              'da.tgl_ajuan-ASC' => 'Tgl Ajuan &uarr;', 
                              'da.tgl_ajuan-DESC' => 'Tgl Ajuan &darr;', 
                              'pt.tgl_lahir-DESC' => 'Usia &uarr;', 
                              'pt.tgl_lahir-ASC' => 'Usia &darr;', 
                              's.nama_sekolah-ASC' => 'Nama Sekolah &uarr;', 
                              's.nama_sekolah-DESC' => 'Nama Sekolah &darr;',
                              'pt.pendidikan_akhir-DESC' => 'Jurusan &uarr;', 
                              'pt.pendidikan_akhir-ASC' => 'Jurusan &darr;', 
                              'pt.ijazah_akhir-DESC' => 'Lulusan &uarr;', 
                              'pt.ijazah_akhir-ASC' => 'Lulusan &darr;'
                );

                $filter = '';
                foreach ($arr as $key => $val) {
                        if ($key == $sortby) {
                                $filter .= "<option selected=\"selected\" value=\"$key\">$val</option>\n";
                        } else
                                $filter .= "<option value=\"$key\">$val</option>\n";
                }
                unset($val);
                return $filter;
        }
      
      
      
      /**
       * Content::getPTKByDiklatMinat()-------------------------------------------------------------------------------------------------------------
       * 
       * @return
       */
      public function getPTKByDiklatMinat()
      {	  

        if (isset($_GET['diklatid']))
              $diklatid = intval($_GET['diklatid']);
        else
              $diklatid = 0;
          
        if (isset($_GET['diklat_tahun']))
              $diklat_tahun = sanitize($_GET['diklat_tahun']);
        else
              $diklat_tahun = '';
                    
        if (isset($_GET['propinsi_kode']))
              $propinsi_kode = sanitize($_GET['propinsi_kode']);
        else
              $propinsi_kode = '';

        if (isset($_GET['kota_kode']))
              $kota_kode = sanitize($_GET['kota_kode']);
        else
              $kota_kode = '';

        if (isset($_GET['searchfield']))
              $searchfield = strtolower(sanitize($_GET['searchfield']));
        else
              $searchfield = '';
        
        if (isset($_GET['searchtext']))
              $searchtext = strtolower(sanitize($_GET['searchtext']));
        else
              $searchtext = '';
        
        if ($propinsi_kode != '') {
              if ($kota_kode != '') {
                  
                    $q = "SELECT count(*)"
                         ."\n FROM (ptk_diklatminat AS ptdm LEFT JOIN ptk AS pt ON ptdm.ptkid = pt.id)"
                         ."\n LEFT JOIN sekolah AS s ON pt.sekolahid = s.id"
                         ."\n WHERE pt.propinsi_kode = '" . $propinsi_kode . "' AND pt.kota_kode = '" . $kota_kode . "'";
                    $sqlwhere = "WHERE pt.propinsi_kode = '" . $propinsi_kode . "' AND pt.kota_kode = '" . $kota_kode . "'";
                  
                    if ($diklatid > 0) {
                     
                        $q .= " AND (ptdm.diklatid = " . $diklatid . " AND ptdm.tahun = " . $diklat_tahun . ")";
                        $sqlwhere .= " AND (ptdm.diklatid = " . $diklatid . " AND ptdm.tahun = " . $diklat_tahun . ")";
                        
                    }
                        
                    if (($searchtext != '') && ($searchfield != '')) {
                        $q .= " AND LOWER(" . $searchfield .") LIKE '%". $searchtext ."%'";
                        $sqlwhere .= " AND LOWER(" . $searchfield .") LIKE '%". $searchtext ."%'";
                    }
              } else {
                    $q = "SELECT count(*)"
                          ."\n FROM (ptk_diklatminat AS ptdm LEFT JOIN ptk AS pt ON ptdm.ptkid = pt.id)"
                          ."\n LEFT JOIN sekolah AS s ON pt.sekolahid = s.id"
                          ."\n WHERE pt.propinsi_kode = '" . $propinsi_kode . "'";
                    $sqlwhere = "WHERE pt.propinsi_kode = '" . $propinsi_kode . "'";

                    if ($diklatid > 0) {
                     
                        $q .= " AND (ptdm.diklatid = " . $diklatid . " AND ptdm.tahun = " . $diklat_tahun . ")";
                        $sqlwhere .= " AND (ptdm.diklatid = " . $diklatid . " AND ptdm.tahun = " . $diklat_tahun . ")";
                        
                    }
                                            
                    if (($searchtext != '') && ($searchfield != '')) {
                        $q .= " AND LOWER(" . $searchfield .") LIKE '%". $searchtext ."%'";
                        $sqlwhere .= " AND LOWER(" . $searchfield .") LIKE '%". $searchtext ."%'";
                    }
              }
        } else {
              if ($kota_kode != '') {
                    $q = "SELECT count(*)"
                          ."\n FROM (ptk_diklatminat AS ptdm LEFT JOIN ptk AS ptk ON ptdm.ptkid = pt.id)"
                          ."\n LEFT JOIN sekolah AS s ON pt.sekolahid = s.id"
                          ."\n WHERE pt.kota_kode = '" . $kota_kode . "'";
                    $sqlwhere = "WHERE pt.kota_kode = '" . $kota_kode . "'";

                    if ($diklatid > 0) {
                     
                        $q .= " AND (ptdm.diklatid = " . $diklatid . " AND ptdm.tahun = " . $diklat_tahun . ")";
                        $sqlwhere .= " AND (ptdm.diklatid = " . $diklatid . " AND ptdm.tahun = " . $diklat_tahun . ")";
                        
                    }
                                            
                    if (($searchtext != '') && ($searchfield != '')) {
                        $q .= " AND LOWER(" . $searchfield .") LIKE '%". $searchtext ."%'";
                        $sqlwhere .= " AND LOWER(" . $searchfield .") LIKE '%". $searchtext ."%'";
                    }
                    
              } else {
                    $q = "SELECT count(*)"
                          ."\n FROM ptk_diklatminat AS ptdm LEFT JOIN ptk AS pt ON ptdm.ptkid = pt.id"
                          ."\n LEFT JOIN sekolah AS s ON pt.sekolahid = s.id";

                    if ($diklatid > 0) {
                     
                        $q .= " WHERE (ptdm.diklatid = " . $diklatid . " AND ptdm.tahun = " . $diklat_tahun . ")";
                        $sqlwhere = " WHERE (ptdm.diklatid = " . $diklatid . " AND ptdm.tahun = " . $diklat_tahun . ")";
                        
                    }
                                            
                    if (($searchtext != '') && ($searchfield != '')) {
                     
                      if ($diklatid > 0) {
                        $q .= " AND LOWER(" . $searchfield .") LIKE '%". $searchtext ."%'";
                        $sqlwhere .= " AND LOWER(" . $searchfield .") LIKE '%". $searchtext ."%'";
                        
                      } else {
                        $q .= " WHERE LOWER(" . $searchfield .") LIKE '%". $searchtext ."%'";
                        $sqlwhere = "WHERE LOWER(" . $searchfield .") LIKE '%". $searchtext ."%'";
                      }
                    } else {
                      
                      if ($diklatid == 0)
                        $sqlwhere = "";
                      
                    }
                    
              }
        }
                
        $record = Registry::get("Database")->query($q);
        $total = Registry::get("Database")->fetchrow($record);
        $counter = $total[0];

        $pager = Paginator::instance();
        $pager->items_total = $counter;
        $pager->default_ipp = Registry::get("Core")->perpage;
        $pager->paginate();

        $sql = "SELECT ptdm.id, ptdm.ptkid, ptdm.diklatid, ptdm.tahun,"
                . "\n pt.sekolahid, pt.nama_lengkap, pt.nuptk, pt.nip, pt.alamat," 
                . "\n s.nama_sekolah," 
                . "\n p.nama_propinsi," 
                . "\n k.nama_kota," 
                
                . "\n dk.kode, dk.nama_diklat" 
                
                . "\n FROM ((((ptk_diklatminat AS ptdm" 
                . "\n LEFT JOIN ptk AS pt ON ptdm.ptkid = pt.id)" 
                . "\n LEFT JOIN sekolah AS s ON pt.sekolahid = s.id)" 
                . "\n LEFT JOIN propinsi AS p ON pt.propinsi_kode = p.kode)" 
                . "\n LEFT JOIN kota AS k ON pt.kota_kode = k.kode)" 
                . "\n LEFT JOIN diklat AS dk ON ptdm.diklatid = dk.id" 
                . "\n $sqlwhere" 
                . "\n ORDER BY pt.nama_lengkap " . $pager->limit;
        
        $row = self::$db->fetch_all($sql);

        return ($row) ? $row : 0;
	  
      }
                  
      /**
       * Content::getDiklat_Peserta()-------------------------------------------------------------------------------------------------------------
       * 
       * @return
       */
      public function getDiklat_Peserta($jadwalid = 0)
      {
	
            if (isset($_GET['propinsi_kode']))
                  $propinsi_kode = sanitize($_GET['propinsi_kode']);
            else
                  $propinsi_kode = '';

            if (isset($_GET['kota_kode']))
                  $kota_kode = sanitize($_GET['kota_kode']);
            else
                  $kota_kode = '';
                    
            if (isset($_GET['searchfield']))
                $searchfield = strtolower(sanitize($_GET['searchfield']));
            else
                $searchfield = '';

            if (isset($_GET['searchtext']))
                $searchtext = strtolower(sanitize($_GET['searchtext']));
            else
                $searchtext = '';
          
            if ($propinsi_kode != '') {
                if ($kota_kode != '') {
                        $q = "SELECT count(*) FROM diklat_peserta AS dp WHERE propinsi_kode = '" . $propinsi_kode . "' AND kota_kode = '" . $kota_kode . "'";
                        $sqlwhere = "WHERE dp.propinsi_kode = '" . $propinsi_kode . "' AND dp.kota_kode = '" . $kota_kode . "'";

                      if (($searchtext != '') && ($searchfield != '')) {
                          $q .= " AND LOWER(" . $searchfield .") LIKE '%". $searchtext ."%'";
                          $sqlwhere .= " AND LOWER(" . $searchfield .") LIKE '%". $searchtext ."%'";
                      }
                } else {
                        $q = "SELECT count(*) FROM diklat_peserta AS dp WHERE propinsi_kode = '" . $propinsi_kode . "'";
                        $sqlwhere = "WHERE dp.propinsi_kode = '" . $propinsi_kode . "'";

                        if (($searchtext != '') && ($searchfield != '')) {
                            $q .= " AND LOWER(" . $searchfield .") LIKE '%". $searchtext ."%'";
                            $sqlwhere .= " AND LOWER(" . $searchfield .") LIKE '%". $searchtext ."%'";
                        }
                }
              
                if ($jadwalid > 0) {
                    $q .= " AND dp.jadwalid = " . $jadwalid;
                    $sqlwhere .= " AND dp.jadwalid = " . $jadwalid;
                }
                                                                        
            } else {
                  if ($kota_kode != '') {
                        $q = "SELECT count(*) FROM diklat_peserta AS dp WHERE kota_kode = '" . $kota_kode . "'";
                        $sqlwhere = "WHERE dp.kota_kode = '" . $kota_kode . "'";

                        if (($searchtext != '') && ($searchfield != '')) {
                            $q .= " AND LOWER(" . $searchfield .") LIKE '%". $searchtext ."%'";
                            $sqlwhere .= " AND LOWER(" . $searchfield .") LIKE '%". $searchtext ."%'";
                        }
                          
                        if ($jadwalid > 0) {
                            $q .= " AND dp.jadwalid = " . $jadwalid;
                            $sqlwhere .= " AND dp.jadwalid = " . $jadwalid;
                        }
                          
                  } else {
                          $q = "SELECT count(*) FROM diklat_peserta AS dp";

                          if (($searchtext != '') && ($searchfield != '')) {
                                $q .= " WHERE LOWER(" . $searchfield .") LIKE '%". $searchtext ."%'";
                                $sqlwhere = "WHERE LOWER(" . $searchfield .") LIKE '%". $searchtext ."%'";


                                if ($jadwalid > 0) {
                                    $q .= " AND dp.jadwalid = " . $jadwalid;
                                    $sqlwhere .= " AND dp.jadwalid = " . $jadwalid;
                                }
                                
                          } else {
                                if ($jadwalid > 0) {
                                    $q .= " WHERE dp.jadwalid = " . $jadwalid;
                                    $sqlwhere = " WHERE dp.jadwalid = " . $jadwalid;
                                } else {                              
                                    $sqlwhere = "";
                                }
                            
                          }
                  }                                    
            }
                                                
            if (($searchtext != '') && ($searchfield != '')) {
                $q .= " AND LOWER(" . $searchfield .") LIKE '%". $searchtext ."%'";                
                $sqlwhere .= " AND LOWER(" . $searchfield .") LIKE '%". $searchtext ."%'";
            }

            $record = Registry::get("Database")->query($q);
            $total = Registry::get("Database")->fetchrow($record);
            $counter = $total[0];		

            $pager = Paginator::instance();
            $pager->items_total = $counter;		   
            $pager->default_ipp = Registry::get("Core")->perpage;
            $pager->paginate();
            
            if (isset($_GET['sortfield'])) {
                $sortfield = sanitize($_GET['sortfield']);
                if (isset($_GET['sorttype']))
                    $sorttype = sanitize($_GET['sorttype']);
                else
                    $sorttype = "ASC";
                
                if (in_array($sortfield, array("dp.nuptk", "dp.nama_lengkap", 
                                               "dp.nama_sekolah", "p.nama_propinsi", 
                                                "k.nama_kota", "dj.tahun", "dk.nama_diklat"))) {
                    $sort = ($sorttype == 'DESC') ? " DESC" : " ASC";
                    $sqlorder = "LOWER(" . $sortfield . ") " . $sort;
                } else
                    $sqlorder = "LOWER(dp.nama_lengkap)";
            } else
                    $sqlorder = "LOWER(dp.nama_lengkap)";
                        
            $sql = "SELECT dp.*,"
            . "\n p.nama_propinsi," 
            . "\n k.nama_kota," 
            . "\n dj.tahun," 
            . "\n dk.nama_diklat" 
            . "\n FROM (((diklat_peserta AS dp" 
            . "\n LEFT JOIN propinsi AS p ON dp.propinsi_kode = p.kode)" 
            . "\n LEFT JOIN kota AS k ON dp.kota_kode = k.kode)" 
            . "\n LEFT JOIN diklat_jadwal AS dj ON dp.jadwalid = dj.id)" 
            . "\n LEFT JOIN diklat AS dk ON dj.diklatid = dk.id" 
            . "\n $sqlwhere" 
            . "\n ORDER BY " . $sqlorder . " " . $pager->limit;

            $row = self::$db->fetch_all($sql);

            return ($row) ? $row : 0;
	  
      }

     /**
       * Content::getDiklat_PesertaById()
       * 
       * @return
       */
      public function getDiklat_PesertaById($id)
      {
		  
          $sql = "SELECT dp.*,"
                . "\n p.nama_propinsi,"
                . "\n k.nama_kota"
                . "\n FROM (diklat_peserta AS dp"
                . "\n LEFT JOIN propinsi AS p ON dp.propinsi_kode = p.kode)"
                . "\n LEFT JOIN kota AS k ON dp.kota_kode = k.kode"
                . "\n WHERE dp.id = '" . $id . "'";
          		  
          $row = self::$db->first($sql);

          return $row;
      }


      /**
       * Users::Diklat_PesertaPTKExists($ptkid, $jadwalid)
       * 
       * @param 
       * @return
       */
      private function Diklat_PesertaPTKExists($personid, $jadwalid)
      {

          $sql = self::$db->query("SELECT id FROM diklat_peserta WHERE personid = '" . $personid . "' AND jadwalid = '" .$jadwalid . "' LIMIT 1");

          $count = self::$db->numrows($sql);

          return ($count > 0) ? 3 : false;
      }	  

	  
       /**
       * Content::processDiklat_Peserta()
       * 
       * @return
       */
      public function processDiklat_PesertaAdd()
      {

          if (empty($_POST['jadwalid']))
              Filter::$msgs['jadwalid'] = 'Jadwal Diklat belum dipilih!';

          if (empty($_POST['personid']))
              Filter::$msgs['personid'] = 'Tidak ada PTK/Staff yang dipilih!';

          if (empty(Filter::$msgs)) {

                $jadwalid = intval($_POST['jadwalid']);
                $scount = 0;

                foreach ($_POST['personid'] as $key => $val) {

                    $personid = intval($_POST['personid'][$key]);
                    $instansiid = intval($_POST['instansiid'][$key]);
                    $jenis = $_POST['jenis'][$key];

                    $nama_lengkap = null;
                    $gelar_depan1 = null;
                    $gelar_depan2 = null;
                    $gelar_depan3 = null;

                    $gelar_belakang1 = null;
                    $gelar_belakang2 = null;
                    $gelar_belakang3 = null;

                    $nip = null;
                    $nuptk = null;

                    $golongan = null;
                    $pendidikan_akhir = null;
                    $ijazah_akhir = null;
                    $fakultas_akhir = null;
                    $jurusan_akhir = null;
                    $tahun_lulus_akhir = null;

                    $tgl_lahir = null;
                    $tmp_lahir = null;
                    $jns_klmn = null;
                    $nama_ibu = null;                    
                    
                    $agama = null;
                    $propinsi_kode = null;
                    $kota_kode = null;
                    $alamat = null;
                    $telepon1 = null;
                    $telepon2 = null;

                    $nss = null;
                    $nama_sekolah = null;
                    $status_sekolah = null;
                    $nama_pimpinan = null;                    
                    $alamat_sekolah = null;
                    $propinsi_kode_sekolah = null;
                    $kota_kode_sekolah = null;
                    $telepon_sekolah = null;
                    $fax_sekolah = null;
                    $kodepos_sekolah = null;
                    $email = null;
                    $website = null;
                                        
                    if (!$this->Diklat_PesertaPTKExists($personid, $jadwalid))  {

                        // -- get data --
                        
                        if ($jenis == 'P') {
                            
                            $sql = "SELECT pt.id,pt.gelar_depan1,pt.gelar_depan2,pt.gelar_depan3," 
                                  . "\n pt.gelar_belakang1,pt.gelar_belakang2,pt.gelar_belakang3,"
                                  . "\n pt.nuptk, pt.nip, pt.nama_lengkap,pt.golongan,pt.pendidikan_akhir," 
                                  . "\n pt.ijazah_akhir, pt.fakultas_akhir, pt.jurusan_akhir,pt.tahun_lulus_akhir,"
                                  . "\n pt.tgl_lahir, pt.tmp_lahir, pt.jns_klmn,pt.nama_ibu,"                                    
                                  . "\n pt.agama, pt.propinsi_kode, pt.kota_kode, pt.alamat, pt.telepon1,pt.telepon2," 
                                  . "\n s.nss, s.nama_sekolah, s.status AS status_sekolah, s.nama_pimpinan, s.alamat AS alamat_sekolah," 
                                  . "\n s.propinsi_kode AS propinsi_kode_sekolah, s.kota_kode AS kota_kode_sekolah, s.telepon AS telepon_sekolah,"
                                  . "\n s.fax AS fax_sekolah, s.kodepos AS kodepos_sekolah, s.email, s.website" 
                                  . "\n FROM ptk AS pt" 
                                  . "\n LEFT JOIN sekolah AS s ON pt.sekolahid = s.id" 
                                  . "\n WHERE pt.id = " . $personid ;
                            
                            $erow = self::$db->first($sql);
                            if ($erow) {
                               
                                $nama_lengkap = $erow->nama_lengkap;
                                $gelar_depan1 = $erow->gelar_depan1;
                                $gelar_depan2 = $erow->gelar_depan2;
                                $gelar_depan3 = $erow->gelar_depan3;

                                $gelar_belakang1 = $erow->gelar_belakang1;
                                $gelar_belakang2 = $erow->gelar_belakang2;
                                $gelar_belakang3 = $erow->gelar_belakang3;

                                $nip = $erow->nip;
                                $nuptk = $erow->nuptk;

                                $golongan = $erow->golongan;
                                $pendidikan_akhir = $erow->pendidikan_akhir;
                                $ijazah_akhir = $erow->ijazah_akhir;
                                $fakultas_akhir = $erow->fakultas_akhir;
                                $jurusan_akhir = $erow->jurusan_akhir;
                                $tahun_lulus_akhir = $erow->tahun_lulus_akhir;

                                $tgl_lahir = $erow->tgl_lahir; 
                                $tmp_lahir = $erow->tmp_lahir;
                                $jns_klmn = $erow->jns_klmn;
                                $nama_ibu = $erow->nama_ibu;
                                                                
                                $agama = $erow->agama;
                                $propinsi_kode = $erow->propinsi_kode;
                                $kota_kode = $erow->kota_kode;
                                $alamat = $erow->alamat;
                                $telepon1 = $erow->telepon1;
                                $telepon2 = $erow->telepon2;

                                $nss = $erow->nss;
                                $nama_sekolah = $erow->nama_sekolah;
                                $status_sekolah = $erow->status_sekolah;
                                $nama_pimpinan = $erow->nama_pimpinan;
                                $alamat_sekolah = $erow->alamat_sekolah;
                                $propinsi_kode_sekolah = $erow->propinsi_kode_sekolah;
                                $kota_kode_sekolah = $erow->kota_kode_sekolah;
                                $telepon_sekolah = $erow->telepon_sekolah;
                                $fax_sekolah = $erow->fax_sekolah;
                                $kodepos_sekolah = $erow->kodepos_sekolah;
                                $email = $erow->email;
                                $website = $erow->website;
                                                                
                                unset($erow);
                            }                         
                            
                        } else {
                            // -- staff --

                            $sql = "SELECT st.id,st.gelar_depan1,st.gelar_depan2,st.gelar_depan3," 
                                  . "\n st.gelar_belakang1,st.gelar_belakang2,st.gelar_belakang3,"
                                  . "\n st.nuptk, st.nip, st.nama_lengkap,st.golongan,st.pendidikan_akhir," 
                                  . "\n st.ijazah_akhir, st.fakultas_akhir, st.jurusan_akhir,st.tahun_lulus_akhir," 
                                  . "\n st.tgl_lahir, st.tmp_lahir, st.jns_klmn, st.nama_ibu, st.agama,"
                                  . "\n st.propinsi_kode, st.kota_kode, st.alamat, st.telepon1,st.telepon2," 
                                  . "\n l.nama_lembaga, l.alamat AS alamat_lembaga, l.nama_pimpinan," 
                                  . "\n l.propinsi_kode AS propinsi_kode_lembaga, l.kota_kode AS kota_kode_lembaga,"
                                  . "\n l.telepon1 AS telepon_lembaga, l.fax AS fax_lembaga, l.kodepos AS kodepos_lembaga, l.email, l.website" 
                                  . "\n FROM staff AS st" 
                                  . "\n LEFT JOIN lembaga AS l ON st.lembagaid = l.id" 
                                  . "\n WHERE st.id = " . $personid ;
                            
                            $erow = self::$db->first($sql);
                            if ($erow) {
                               
                                $nama_lengkap = $erow->nama_lengkap;
                                $gelar_depan1 = $erow->gelar_depan1;
                                $gelar_depan2 = $erow->gelar_depan2;
                                $gelar_depan3 = $erow->gelar_depan3;

                                $gelar_belakang1 = $erow->gelar_belakang1;
                                $gelar_belakang2 = $erow->gelar_belakang2;
                                $gelar_belakang3 = $erow->gelar_belakang3;

                                $nip = $erow->nip;
                                $nuptk = $erow->nuptk;

                                $golongan = $erow->golongan;
                                $pendidikan_akhir = $erow->pendidikan_akhir;
                                $ijazah_akhir = $erow->ijazah_akhir;
                                $fakultas_akhir = $erow->fakultas_akhir;
                                $jurusan_akhir = $erow->jurusan_akhir;
                                $tahun_lulus_akhir = $erow->tahun_lulus_akhir;

                                $tgl_lahir = $erow->tgl_lahir; 
                                $tmp_lahir = $erow->tmp_lahir;
                                $jns_klmn = $erow->jns_klmn;
                                $nama_ibu = $erow->nama_ibu;                                
                                
                                $agama = $erow->agama;
                                $alamat = $erow->alamat;
                                $propinsi_kode = $erow->propinsi_kode;
                                $kota_kode = $erow->kota_kode;
                                $telepon1 = $erow->telepon1;
                                $telepon2 = $erow->telepon2;

                                $nama_sekolah = $erow->nama_lembaga;
                                $alamat_sekolah = $erow->alamat_lembaga;
                                $nama_pimpinan = $erow->nama_pimpinan;
                                $propinsi_kode_sekolah = $erow->propinsi_kode_lembaga;
                                $kota_kode_sekolah = $erow->kota_kode_lembaga;
                                $telepon_sekolah = $erow->telepon1_lembaga;
                                $fax_sekolah = $erow->fax_lembaga;
                                $kodepos_sekolah = $erow->kodepos_lembaga;                                
                                $email = $erow->email;
                                $website = $erow->website;
                                                                
                                unset($erow);
                            }                         
                                                        
                        }
                        
                        $edata = array(
                                    'jadwalid' => $jadwalid, 
                                    'personid' => $personid,
                                    'instansiid' => $instansiid,
                                    'jenis' => $jenis,

                                    'nama_lengkap' => $nama_lengkap,
                                    'gelar_depan1' => $gelar_depan1,
                                    'gelar_depan2' => $gelar_depan2,
                                    'gelar_depan3' => $gelar_depan3,

                                    'gelar_belakang1' => $gelar_belakang1,
                                    'gelar_belakang2' => $gelar_belakang2,
                                    'gelar_belakang3' => $gelar_belakang3,

                                    'nip' => $nip,
                                    'nuptk' => $nuptk,

                                    'golongan' => $golongan,
                                    'pendidikan_akhir' => $pendidikan_akhir,
                                    'ijazah_akhir' => $ijazah_akhir,
                                    'fakultas_akhir' => $fakultas_akhir,
                                    'jurusan_akhir' => $jurusan_akhir,
                                    'tahun_lulus_akhir' => $tahun_lulus_akhir,

                                    'tgl_lahir' => $tgl_lahir,
                                    'tmp_lahir' => $tmp_lahir,
                                    'jns_klmn' => $jns_klmn,
                                    'nama_ibu' => $nama_ibu,
                                                        
                                    'agama' => $agama,
                                    'propinsi_kode' => $propinsi_kode,
                                    'kota_kode' => $kota_kode,
                                    'alamat' => $alamat,
                                    'telepon1' => $telepon1,
                                    'telepon2' => $telepon2,

                                    'nss' => $nss,
                                    'nama_sekolah' => $nama_sekolah,
                                    'status_sekolah' => $status_sekolah,
                                    'nama_pimpinan' => $nama_pimpinan ,
                                    'alamat_sekolah' => $alamat_sekolah,
                                    'propinsi_kode_sekolah' => $propinsi_kode_sekolah,
                                    'kota_kode_sekolah' => $kota_kode_sekolah,
                                    'telepon_sekolah' => $telepon_sekolah,
                                    'fax_sekolah' => $fax_sekolah,
                                    'kodepos_sekolah' => $kodepos_sekolah,
                                                        
                                    'email' => $email,
                                    'website' => $website,                                                        
                            
                                    'last_update' => 'NOW()',
                                    'created' => 'NOW()',
                                    'userid' => intval($_POST['userid']));

                        self::$db->insert("diklat_peserta", $edata); 

                        if (self::$db->affected()) $scount++;					  
                    }
                }
												
	        Filter::msgOk($scount . ' Data berhasil diproses.');
 			  
          } else
              print Filter::msgStatus();
      }
	  
      /**
       * Content::processDiklat_Peserta()
       * 
       * @return
       */
      public function processDiklat_Peserta()
      {

          $reg_undang = null;
          $reg_ulang = null;
          
          /*if (empty($_POST['peserta']))
              Filter::$msgs['jenisid'] = 'Silahkan pilih Jenis Sekolah'; */
                   
          if (empty(Filter::$msgs)) {
              
                if (!empty($_POST['reg_undang'])) {
                    $reg_undang = sanitize($_POST['reg_undang']);
                    $reg_undang = setToSQLdate($reg_undang);
                }
                    
                if (!empty($_POST['reg_ulang'])) {
                    $reg_ulang = sanitize($_POST['reg_ulang']);
                    $reg_ulang = setToSQLdate($reg_ulang);
                }
              
              $data = array('angkatan' => sanitize($_POST['angkatan']), 
                            'kelas' => sanitize($_POST['kelas']), 
                            'reg_undang' => $reg_undang,
                            'reg_ulang' => $reg_ulang, 
                            'kamarid' => intval($_POST['kamarid']), 
                            'bedid' => intval($_POST['bedid']), 
                            'keterangan' => sanitize($_POST['keterangan']),

                            'nama_lengkap' => sanitize($_POST['nama_lengkap']),
                            'nip' => sanitize($_POST['nip']),
                            'nuptk' => sanitize($_POST['nuptk']),
                                    
                            'last_update' => 'NOW()',
                            'userid' => intval($_POST['userid']));

              self::$db->update("diklat_peserta", $data, "id='" . Filter::$id . "'");
              (self::$db->affected()) ? Filter::msgOk(lang('DATA_UPDATED')) : Filter::msgAlert(lang('NOPROCCESS'));

		  
          } else
              print Filter::msgStatus();
		  
      }

       /**
       * Content::updateDiklat_Peserta()
       * 
       * @return
       */
      public function updateDiklat_Peserta()
      {

            $sql = "SELECT id, personid, instansiid, jenis, nama_lengkap" 
                  . "\n FROM diklat_peserta" 
                  . "\n WHERE id = " . Filter::$id;

            $prow = self::$db->first($sql);
            if ($prow) {
                    
                $nama_lengkap = null;
                $gelar_depan1 = null;
                $gelar_depan2 = null;
                $gelar_depan3 = null;

                $gelar_belakang1 = null;
                $gelar_belakang2 = null;
                $gelar_belakang3 = null;

                $nip = null;
                $nuptk = null;

                $golongan = null;
                $pendidikan_akhir = null;
                $ijazah_akhir = null;
                $fakultas_akhir = null;
                $jurusan_akhir = null;
                $tahun_lulus_akhir = null;

                $tgl_lahir = null;
                $tmp_lahir = null;
                $jns_klmn = null;
                $nama_ibu = null;                    

                $agama = null;
                $propinsi_kode = null;
                $kota_kode = null;
                $alamat = null;
                $telepon1 = null;
                $telepon2 = null;

                $nss = null;
                $nama_sekolah = null;
                $status_sekolah = null;
                $nama_pimpinan = null;                    
                $alamat_sekolah = null;
                $propinsi_kode_sekolah = null;
                $kota_kode_sekolah = null;
                $telepon_sekolah = null;
                $fax_sekolah = null;
                $kodepos_sekolah = null;
                $email = null;
                $website = null;
                                        
                // -- get data --

                if ($prow->jenis == 'P') {

                    $sql = "SELECT pt.id,pt.gelar_depan1,pt.gelar_depan2,pt.gelar_depan3," 
                          . "\n pt.gelar_belakang1,pt.gelar_belakang2,pt.gelar_belakang3,"
                          . "\n pt.nuptk, pt.nip, pt.nama_lengkap,pt.golongan,pt.pendidikan_akhir," 
                          . "\n pt.ijazah_akhir, pt.fakultas_akhir, pt.jurusan_akhir,pt.tahun_lulus_akhir,"
                          . "\n pt.tgl_lahir, pt.tmp_lahir, pt.jns_klmn,pt.nama_ibu,"                                    
                          . "\n pt.agama, pt.propinsi_kode, pt.kota_kode, pt.alamat, pt.telepon1,pt.telepon2," 
                          . "\n s.nss, s.nama_sekolah, s.status AS status_sekolah, s.nama_pimpinan, s.alamat AS alamat_sekolah," 
                          . "\n s.propinsi_kode AS propinsi_kode_sekolah, s.kota_kode AS kota_kode_sekolah, s.telepon AS telepon_sekolah,"
                          . "\n s.fax AS fax_sekolah, s.kodepos AS kodepos_sekolah, s.email, s.website" 
                          . "\n FROM ptk AS pt" 
                          . "\n LEFT JOIN sekolah AS s ON pt.sekolahid = s.id" 
                          . "\n WHERE pt.id = " . $prow->personid;

                    $erow = self::$db->first($sql);
                    if ($erow) {

                        $nama_lengkap = $erow->nama_lengkap;
                        $gelar_depan1 = $erow->gelar_depan1;
                        $gelar_depan2 = $erow->gelar_depan2;
                        $gelar_depan3 = $erow->gelar_depan3;

                        $gelar_belakang1 = $erow->gelar_belakang1;
                        $gelar_belakang2 = $erow->gelar_belakang2;
                        $gelar_belakang3 = $erow->gelar_belakang3;

                        $nip = $erow->nip;
                        $nuptk = $erow->nuptk;

                        $golongan = $erow->golongan;
                        $pendidikan_akhir = $erow->pendidikan_akhir;
                        $ijazah_akhir = $erow->ijazah_akhir;
                        $fakultas_akhir = $erow->fakultas_akhir;
                        $jurusan_akhir = $erow->jurusan_akhir;
                        $tahun_lulus_akhir = $erow->tahun_lulus_akhir;

                        $tgl_lahir = $erow->tgl_lahir; 
                        $tmp_lahir = $erow->tmp_lahir;
                        $jns_klmn = $erow->jns_klmn;
                        $nama_ibu = $erow->nama_ibu;

                        $agama = $erow->agama;
                        $propinsi_kode = $erow->propinsi_kode;
                        $kota_kode = $erow->kota_kode;
                        $alamat = $erow->alamat;
                        $telepon1 = $erow->telepon1;
                        $telepon2 = $erow->telepon2;

                        $nss = $erow->nss;
                        $nama_sekolah = $erow->nama_sekolah;
                        $status_sekolah = $erow->status_sekolah;
                        $nama_pimpinan = $erow->nama_pimpinan;
                        $alamat_sekolah = $erow->alamat_sekolah;
                        $propinsi_kode_sekolah = $erow->propinsi_kode_sekolah;
                        $kota_kode_sekolah = $erow->kota_kode_sekolah;
                        $telepon_sekolah = $erow->telepon_sekolah;
                        $fax_sekolah = $erow->fax_sekolah;
                        $kodepos_sekolah = $erow->kodepos_sekolah;
                        $email = $erow->email;
                        $website = $erow->website;

                        unset($erow);
                    }                         

                } else {
                    // -- staff --

                    $sql = "SELECT st.id,st.gelar_depan1,st.gelar_depan2,st.gelar_depan3," 
                          . "\n st.gelar_belakang1,st.gelar_belakang2,st.gelar_belakang3,"
                          . "\n st.nuptk, st.nip, st.nama_lengkap,st.golongan,st.pendidikan_akhir," 
                          . "\n st.ijazah_akhir, st.fakultas_akhir, st.jurusan_akhir,st.tahun_lulus_akhir," 
                          . "\n st.tgl_lahir, st.tmp_lahir, st.jns_klmn, st.nama_ibu, st.agama,"
                          . "\n st.propinsi_kode, st.kota_kode, st.alamat, st.telepon1,st.telepon2," 
                          . "\n l.nama_lembaga, l.alamat AS alamat_lembaga, l.nama_pimpinan," 
                          . "\n l.propinsi_kode AS propinsi_kode_lembaga, l.kota_kode AS kota_kode_lembaga,"
                          . "\n l.telepon1 AS telepon_lembaga, l.fax AS fax_lembaga, l.kodepos AS kodepos_lembaga, l.email, l.website" 
                          . "\n FROM staff AS st" 
                          . "\n LEFT JOIN lembaga AS l ON st.lembagaid = l.id" 
                          . "\n WHERE st.id = " . $prow->personid;

                    $erow = self::$db->first($sql);
                    if ($erow) {

                        $nama_lengkap = $erow->nama_lengkap;
                        $gelar_depan1 = $erow->gelar_depan1;
                        $gelar_depan2 = $erow->gelar_depan2;
                        $gelar_depan3 = $erow->gelar_depan3;

                        $gelar_belakang1 = $erow->gelar_belakang1;
                        $gelar_belakang2 = $erow->gelar_belakang2;
                        $gelar_belakang3 = $erow->gelar_belakang3;

                        $nip = $erow->nip;
                        $nuptk = $erow->nuptk;

                        $golongan = $erow->golongan;
                        $pendidikan_akhir = $erow->pendidikan_akhir;
                        $ijazah_akhir = $erow->ijazah_akhir;
                        $fakultas_akhir = $erow->fakultas_akhir;
                        $jurusan_akhir = $erow->jurusan_akhir;
                        $tahun_lulus_akhir = $erow->tahun_lulus_akhir;

                        $tgl_lahir = $erow->tgl_lahir; 
                        $tmp_lahir = $erow->tmp_lahir;
                        $jns_klmn = $erow->jns_klmn;
                        $nama_ibu = $erow->nama_ibu;                                

                        $agama = $erow->agama;
                        $alamat = $erow->alamat;
                        $propinsi_kode = $erow->propinsi_kode;
                        $kota_kode = $erow->kota_kode;
                        $telepon1 = $erow->telepon1;
                        $telepon2 = $erow->telepon2;

                        $nama_sekolah = $erow->nama_lembaga;
                        $alamat_sekolah = $erow->alamat_lembaga;
                        $nama_pimpinan = $erow->nama_pimpinan;
                        $propinsi_kode_sekolah = $erow->propinsi_kode_lembaga;
                        $kota_kode_sekolah = $erow->kota_kode_lembaga;
                        $telepon_sekolah = $erow->telepon1_lembaga;
                        $fax_sekolah = $erow->fax_lembaga;
                        $kodepos_sekolah = $erow->kodepos_lembaga;                                
                        $email = $erow->email;
                        $website = $erow->website;

                        unset($erow);
                    }                         

                }

                $edata = array(
                            'nama_lengkap' => $nama_lengkap,
                            'gelar_depan1' => $gelar_depan1,
                            'gelar_depan2' => $gelar_depan2,
                            'gelar_depan3' => $gelar_depan3,

                            'gelar_belakang1' => $gelar_belakang1,
                            'gelar_belakang2' => $gelar_belakang2,
                            'gelar_belakang3' => $gelar_belakang3,

                            'nip' => $nip,
                            'nuptk' => $nuptk,

                            'golongan' => $golongan,
                            'pendidikan_akhir' => $pendidikan_akhir,
                            'ijazah_akhir' => $ijazah_akhir,
                            'fakultas_akhir' => $fakultas_akhir,
                            'jurusan_akhir' => $jurusan_akhir,
                            'tahun_lulus_akhir' => $tahun_lulus_akhir,

                            'tgl_lahir' => $tgl_lahir,
                            'tmp_lahir' => $tmp_lahir,
                            'jns_klmn' => $jns_klmn,
                            'nama_ibu' => $nama_ibu,

                            'agama' => $agama,
                            'propinsi_kode' => $propinsi_kode,
                            'kota_kode' => $kota_kode,
                            'alamat' => $alamat,
                            'telepon1' => $telepon1,
                            'telepon2' => $telepon2,

                            'nss' => $nss,
                            'nama_sekolah' => $nama_sekolah,
                            'status_sekolah' => $status_sekolah,
                            'nama_pimpinan' => $nama_pimpinan ,
                            'alamat_sekolah' => $alamat_sekolah,
                            'propinsi_kode_sekolah' => $propinsi_kode_sekolah,
                            'kota_kode_sekolah' => $kota_kode_sekolah,
                            'telepon_sekolah' => $telepon_sekolah,
                            'fax_sekolah' => $fax_sekolah,
                            'kodepos_sekolah' => $kodepos_sekolah,

                            'email' => $email,
                            'website' => $website,                                                        

                            'last_update' => 'NOW()');

                self::$db->update("diklat_peserta", $edata, "id = " . Filter::$id);

                if (self::$db->affected()) 
                    Filter::msgOk('Data Peserta berhasil diupdate.');
                else 
                    Filter::msgAlert(lang('NOPROCCESS'));
 			  
          } else
              print Filter::msgStatus();
      }
      
      	  
      /**
       * Content::getTNA_KK($pskid = 0)--------------------------------------------------------------------------
       * 
       * @return
       */
      public function getTNA_KK($pskid = 0)
      {


        if (isset($_GET['searchtext']))
              $searchtext = strtolower(sanitize($_GET['searchtext']));
        else
              $searchtext = '';
                
        if ($pskid > 0) {
            $q = "SELECT count(*) FROM kk_tna AS kt LEFT JOIN kk AS k ON kt.kkid=k.id WHERE k.pskid = " . $pskid;
            $sqlwhere = "WHERE k.pskid = " . $pskid;

            if ($searchtext != '') {
                $q .= " AND LOWER(k.nama_kompetensi) LIKE '%" . $searchtext . "%'";
                $sqlwhere .= " AND LOWER(k.nama_kompetensi) LIKE '%" . $searchtext . "%'";
                }
                      
        } else {
            $q = "SELECT count(*) FROM kk_tna AS kt LEFT JOIN kk AS k ON kt.kkid=k.id";
            $sqlwhere = "";

            if ($searchtext != '') {
                $q .= " WHERE LOWER(k.nama_kompetensi) LIKE '%" . $searchtext . "%'";
                $sqlwhere .= "WHERE LOWER(k.nama_kompetensi) LIKE '%" . $searchtext . "%'";
            }
        }

        $record = Registry::get("Database")->query($q);
        $total = Registry::get("Database")->fetchrow($record);
        $counter = $total[0];

        $pager = Paginator::instance();
        $pager->items_total = $counter;
        $pager->default_ipp = Registry::get("Core")->perpage;
        $pager->paginate();

                      
        if (isset($_GET['sortfield'])) {
            $sortfield = sanitize($_GET['sortfield']);
            if (isset($_GET['sorttype']))
                $sorttype = sanitize($_GET['sorttype']);
            else
                $sorttype = "ASC";

            if (in_array($sortfield, array("k.kode", "k.nama_kompetensi"))) {
                $sort = ($sorttype == 'DESC') ? " DESC " : " ASC ";

                $sqlorder = "LOWER(" . $sortfield . ") " . $sort;
            } else
                $sqlorder = "LOWER(k.nama_kompetensi)";
        } else
            $sqlorder = "LOWER(k.nama_kompetensi)";

          $sql = "SELECT kkt.*, k.kode, k.nama_kompetensi" 
                . "\n FROM kk_tna as kkt" 
                . "\n LEFT JOIN kk as k ON kkt.kkid = k.id" 
                . "\n " . $sqlwhere
                . "\n ORDER BY " . $sqlorder . " " . $pager->limit;
          $row = self::$db->fetch_all($sql);
          
          return ($row) ? $row : 0;
      }

      /**
       * Content::getTNA_KKByKKId()
       * 
       * @return
       */
      public function getTNA_KKByKKId($kelid, $kkid)
      {
		  
          $sql = "SELECT *" 
                . "\n FROM kk_tna" 
                . "\n WHERE kelid = " . $kelid . " AND kkid = ".$kkid; 
          
          $row = self::$db->first($sql);

          return $row;
      }

      /**
       * Users::TNA_KKExists($kkid)
       * 
       * @param 
       * @return
       */
      private function TNA_KKExists($kkid)
      {

          $sql = self::$db->query("SELECT id FROM kk_tna WHERE kkid = '" . $kkid . "' LIMIT 1");

          $count = self::$db->numrows($sql);

          return ($count > 0) ? 3 : false;
      }

      /**
       * Content::getTNA_KKCount()
       *
       * @return
       */
      public function getTNA_KKCount($kelid, $kkid)
      {

          $sql = "SELECT count(*) AS kdcount"
              . "\n FROM kd"
              . "\n Where kkid = ".$kkid;

          $row = self::$db->first($sql);

          return $row->kdcount;
      }

       /**
       * Content::processTNA_KK()
       * 
       * @return
       */
      public function processTNA_KK()
      {
          if (empty($_POST['kkid']))
              Filter::$msgs['kkid'] = 'Paket Keahlian belum dipilih!';
			  
		  if ($this->TNA_KKExists($_POST['kkid']))
              Filter::$msgs['kkid'] = 'Paket Keahlian sudah ada!';

          if (empty(Filter::$msgs)) {
              $data = array('kkid' => intval($_POST['kkid']), 
                            'notes' => sanitize($_POST['notes']),

                            'last_update' => 'NOW()',
                            'userid' => intval($_POST['userid']));

              if (!Filter::$id)
                  $data['created'] = "NOW()";											
							
              (Filter::$id) ? self::$db->update("kk_tna", $data, "id='" . Filter::$id . "'") : self::$db->insert("kk_tna", $data);
              $message = (Filter::$id) ? lang('DATA_UPDATED') : lang('DATA_ADDED');

              (self::$db->affected()) ? Filter::msgOk($message) : Filter::msgAlert(lang('NOPROCCESS'));
          } else
              print Filter::msgStatus();
      }

      /**
       * Content::getKD($skid = 0)-------------------------------------------------------------------------------------------------------------
       * 
       * @return
       */
      public function getKD($kelid, $kkid)
      {
		
          $q = "SELECT COUNT(*) FROM kd WHERE kelid = " . $kelid . " AND kkid = " . $kkid;
          $record = self::$db->query($q);
          $total = self::$db->fetchrow($record);
          $counter = $total[0];

          $pager = Paginator::instance();
          $pager->items_total = $counter;
          $pager->default_ipp = Registry::get("Core")->perpage;
          $pager->paginate();
		  	  
          $sql = "SELECT k.*, s.nama_kompetensi as nama_kk" 
              . "\n FROM kd as k" 
              . "\n LEFT JOIN kk as s ON k.kkid = s.id" 
              . "\n WHERE k.kelid = " . $kelid . " AND k.kkid = ". $kkid 
              . "\n ORDER BY k.kdindex " . $pager->limit;	  

          $row = self::$db->fetch_all($sql);

          return ($row) ? $row : 0;
      }

      /**
       * Content::getKDList()
       * 
       * @return
       */
      public function getKDList()
      {

          $sql = "SELECT id, nama_kompetensi" 
                . "\n FROM kd" 
                . "\n ORDER BY nama_kompetensi";

          $row = self::$db->fetch_all($sql);

          return ($row) ? $row : 0;
      }
	
     /**
       * Content::getKDCount()
       * 
       * @return
       */
      public function getKDCount($skid)
      {
          $sql = "SELECT count(*) As kdcount" 
                . "\n FROM kd" 
                . "\n WHERE skid = '" . $skid . "'";

          $row = self::$db->first($sql);

          return $row->kdcount;
      }
            
       /**
       * Content::processKD()
       * 
       * @return
       */
      public function processKD()
      {
			  
          if (empty($_POST['nama_kompetensi']))
              Filter::$msgs['nama_kompetensi'] = 'Silahkan masukkan Nama Kompetensi';

          if (empty($_POST['kkid']))
              Filter::$msgs['kkid'] = 'Silahkan pilih Paket Keahlian';

          if (empty(Filter::$msgs)) {
              
              $kkid = intval($_POST['kkid']);
              $data = array('kdindex' => intval($_POST['kdindex']),
                            'nama_kompetensi' => sanitize($_POST['nama_kompetensi']), 
                            'kkid' => $kkid, 

                            'last_update' => 'NOW()',
                            'userid' => intval($_POST['userid']));

              if (!Filter::$id)
                  $data['created'] = "NOW()";				
														
              (Filter::$id) ? self::$db->update("kd", $data, "id='" . Filter::$id . "'") : self::$db->insert("kd", $data);
              $message = (Filter::$id) ? lang('DATA_UPDATED') : lang('DATA_ADDED');

              if (self::$db->affected()) {
                  Filter::msgOk($message);

              } else
                  Filter::msgAlert(lang('NOPROCCESS'));
              
          } else
              print Filter::msgStatus();
      }	  
	  
      /**
       * Content::getTNA_KD($kkid)-------------------------------------------------------------------------------------------------------------
       * 
       * @return
       */
      public function getTNA_KD($kelid, $kkid)
      {
            
        $sql = "SELECT *" 
          . "\n FROM kd" 
          . "\n WHERE kelid = " . $kelid . " AND kkid = " . $kkid
          . "\n ORDER BY kdindex";
      
        $row = self::$db->fetch_all($sql);
        return ($row) ? $row : 0;
        
      }

      /**
       * Content::getKD_Indikator($kkid)-------------------------------------------------------------------------------------------------------------
       * 
       * @return
       */
      public function getKD_Indikator($kdid)
      {
            
        $sql = "SELECT *" 
          . "\n FROM kd_indikator" 
          . "\n WHERE kdid = " . $kdid
          . "\n ORDER BY indikator_idx";
      
        $row = self::$db->fetch_all($sql);
        return ($row) ? $row : 0;
        
      }

       /**
       * Content::processKD_Indikator()
       * 
       * @return
       */
      public function processKD_Indikator()
      {
        
          if (empty($_POST['nama_indikator']))
              Filter::$msgs['nama_indikator'] = 'Silahkan masukkan Nama Indikator!';

          if (empty($_POST['kdid']))
              Filter::$msgs['kdid'] = 'Silahkan pilih Kompetensi Dasar!';

          if (empty(Filter::$msgs)) {
              
              $kdid = intval($_POST['kdid']);
              $data = array('indikator_idx' => intval($_POST['indikator_idx']),
                            'nama_indikator' => sanitize($_POST['nama_indikator']), 
                            'kdid' => $kdid);
                            
              (Filter::$id) ? self::$db->update("kd_indikator", $data, "id='" . Filter::$id . "'") : self::$db->insert("kd_indikator", $data);
              $message = (Filter::$id) ? lang('DATA_UPDATED') : lang('DATA_ADDED');

              if (self::$db->affected()) {
                  Filter::msgOk($message);

              } else
                  Filter::msgAlert(lang('NOPROCCESS'));
              
          } else
              print Filter::msgStatus();
      }   

      /**
       * Content::getTNA_PTK(...)------------------------------------------------------------------------------------------------------
       *  
       * @return
       */
      public function getTNA_PTK($kelid = 0, $tgl_dari, $tgl_sampai, $bskid, $pskid, $kkid, $propinsi_kode, $kota_kode, $jenis = "P", $sortby = "pttna.last_update")
      {

            if (isset($_GET['searchfield']))
                  $searchfield = strtolower(sanitize($_GET['searchfield']));
            else
                  $searchfield = '';
            
            if (isset($_GET['searchtext']))
                  $searchtext = strtolower(sanitize($_GET['searchtext']));
            else
                  $searchtext = '';

            if ($kelid == 3) {

              if ($bskid > 0)
                $q = "SELECT COUNT(pttna.id) FROM ((ptk_tna AS pttna LEFT JOIN kk AS k ON pttna.kkid = k.id)"
                  . "\n LEFT JOIN psk AS ps ON k.pskid = ps.id)"
                  . "\n LEFT JOIN ptk AS pt ON pttna.ptkid = pt.id"
                  . "\n WHERE (DATE(pttna.created) >= '". $tgl_dari ."' AND DATE(pttna.created) <= '" . $tgl_sampai . "')";
              else
                $q = "SELECT COUNT(pttna.id) FROM (ptk_tna AS pttna LEFT JOIN kk AS k ON pttna.kkid = k.id)"
                  . "\n LEFT JOIN ptk AS pt ON pttna.ptkid = pt.id"
                  . "\n WHERE (DATE(pttna.created) >= '". $tgl_dari ."' AND DATE(pttna.created) <= '" . $tgl_sampai . "')";

            }
            else if ($kelid == 1 || $kelid == 2)
              $q = "SELECT COUNT(pttna.id) FROM (ptk_tna AS pttna LEFT JOIN matapelajaran AS mp ON pttna.kkid = mp.id)"
                . "\n LEFT JOIN ptk AS pt ON pttna.ptkid = pt.id"
                . "\n WHERE (DATE(pttna.created) >= '". $tgl_dari ."' AND DATE(pttna.created) <= '" . $tgl_sampai . "')";
            else
              $q = "SELECT COUNT(pttna.id) FROM ptk_tna AS pttna LEFT JOIN ptk AS pt ON pttna.ptkid = pt.id"
                . "\n WHERE (DATE(pttna.created) >= '". $tgl_dari ."' AND DATE(pttna.created) <= '" . $tgl_sampai . "')";

            $sqlwhere = "(DATE(pttna.created) >= '". $tgl_dari ."' AND DATE(pttna.created) <= '" . $tgl_sampai . "')";
            if ($kelid > 0) {
                $q .= " AND pttna.kelid = " . $kelid;

                $sqlwhere .= " AND pttna.kelid = " . $kelid;
                if ($kkid > 0) {
                   $q .= " AND pttna.kkid = ". $kkid;
                   $sqlwhere .= " AND pttna.kkid = " . $kkid;
                }
                  
                else {
                  if ($kelid == 3) {

                    if ($pskid > 0) {
                      $q .= " AND k.pskid = " . $pskid;

                      $sqlwhere .= " AND k.pskid = " . $pskid;
                    } else if ($bskid > 0) {
                      $q .= " AND ps.bskid = " . $bskid;

                      $sqlwhere .= " AND ps.bskid = " . $bskid;
                    }

                  }
                }
            }

            // -- propinsi & kota --

            if ($kota_kode != "") {

              $q .= " AND pt.kota_kode = '" . $kota_kode . "'";

              $sqlwhere .= " AND pt.kota_kode = '" . $kota_kode . "'";

            } else if ($propinsi_kode != "") {
              $q .= " AND pt.propinsi_kode = '" . $propinsi_kode . "'";

              $sqlwhere .= " AND pt.propinsi_kode = '" . $propinsi_kode . "'";
            }

            // -- search --

            if (($searchtext != '') && ($searchfield != '')) {
                $q .= " AND LOWER(" . $searchfield .") LIKE '%". $searchtext ."%'";
                $sqlwhere .= " AND LOWER(" . $searchfield .") LIKE '%". $searchtext ."%'";
            }

//print_r ($q);
            $record = Registry::get("Database")->query($q);
            $total = Registry::get("Database")->fetchrow($record);
            $counter = $total[0];		
				  		  
            $pager = Paginator::instance();
            $pager->items_total = $counter;
            $pager->default_ipp = Registry::get("Core")->perpage;
            $pager->paginate();

            if ($kelid == 3) {

              if ($bskid > 0)
                $sql = "SELECT pttna.*, ((pttna.nilai_total /pttna.nilai_instrumen) * 100) AS nilai_persen,"
                . "\n pt.nuptk AS ptk_nuptk, pt.nama_lengkap AS ptk_nama_lengkap, pt.golongan AS ptk_golongan,"
                . "\n s.nama_sekolah," 
                . "\n k.nama_kompetensi, k.pskid," 
                . "\n ps.nama_program" 
                . "\n FROM (((ptk_tna as pttna" 
                . "\n LEFT JOIN ptk AS pt ON pttna.ptkid = pt.id AND pttna.jenis = '" . $jenis . "')" 
                . "\n LEFT JOIN sekolah AS s ON pt.sekolahid = s.id)" 
                . "\n LEFT JOIN kk AS k ON pttna.kkid = k.id)" 
                . "\n LEFT JOIN psk AS ps ON k.pskid = ps.id" 
                . "\n WHERE $sqlwhere"
                . "\n ORDER BY " . $sortby . " " . $pager->limit;
              else
                $sql = "SELECT pttna.*, ((pttna.nilai_total /pttna.nilai_instrumen) * 100) AS nilai_persen,"
                . "\n pt.nuptk AS ptk_nuptk, pt.nama_lengkap AS ptk_nama_lengkap, pt.golongan AS ptk_golongan,"
                . "\n s.nama_sekolah," 
                . "\n k.nama_kompetensi, k.pskid" 
                . "\n FROM ((ptk_tna as pttna" 
                . "\n LEFT JOIN ptk AS pt ON pttna.ptkid = pt.id AND pttna.jenis = '" . $jenis . "')" 
                . "\n LEFT JOIN sekolah AS s ON pt.sekolahid = s.id)" 
                . "\n LEFT JOIN kk AS k ON pttna.kelid = " . $kelid . " AND pttna.kkid = k.id" 
                . "\n WHERE $sqlwhere"
                . "\n ORDER BY " . $sortby . " " . $pager->limit;

            }
            else if ($kelid == 1 || $kelid == 2)
              $sql = "SELECT pttna.*, ((pttna.nilai_total /pttna.nilai_instrumen) * 100) AS nilai_persen,"
              . "\n pt.nuptk AS ptk_nuptk, pt.nama_lengkap AS ptk_nama_lengkap, pt.golongan AS ptk_golongan,"
              . "\n s.nama_sekolah," 
              . "\n mp.nama_matapelajaran" 
              . "\n FROM ((ptk_tna as pttna" 
              . "\n LEFT JOIN ptk AS pt ON pttna.ptkid = pt.id AND pttna.jenis = 'P')" 
              . "\n LEFT JOIN sekolah AS s ON pt.sekolahid = s.id)" 
              . "\n LEFT JOIN matapelajaran AS mp ON pttna.kkid = mp.id" 
              . "\n WHERE $sqlwhere"
              . "\n ORDER BY ". $sortby . " " . $pager->limit;
            else
              $sql = "SELECT pttna.*, ((pttna.nilai_total /pttna.nilai_instrumen) * 100) AS nilai_persen,"
              . "\n pt.nuptk AS ptk_nuptk, pt.nama_lengkap AS ptk_nama_lengkap, pt.golongan AS ptk_golongan,"
              //. "\n st.nuptk AS staff_nuptk, st.nama_lengkap AS staff_nama_lengkap, st.golongan AS staff_golongan,"
              . "\n s.nama_sekolah," 
              //. "\n l.nama_lembaga," 
              . "\n k.nama_kompetensi, k.pskid," 
              . "\n mp.nama_matapelajaran" 
              . "\n FROM ((ptk_tna as pttna" 
              . "\n LEFT JOIN ptk AS pt ON pttna.ptkid = pt.id AND pttna.jenis = 'P')" 
              //. "\n LEFT JOIN staff AS st ON pttna.ptkid = st.id AND pttna.jenis = 'S')" 
              . "\n LEFT JOIN sekolah AS s ON pt.sekolahid = s.id)" 
              //. "\n LEFT JOIN lembaga AS l ON st.lembagaid = l.id)" 
              . "\n LEFT JOIN kk AS k ON pttna.kelid = 3 AND pttna.kkid = k.id" 
              . "\n LEFT JOIN matapelajaran AS mp ON (pttna.kelid = 1 Or pttna.kelid = 2) AND pttna.kkid = mp.id" 
              . "\n WHERE $sqlwhere"
              . "\n ORDER BY " . $sortby . " " . $pager->limit;

            $row = self::$db->fetch_all($sql);
  
            return ($row) ? $row : 0;
	  
      }

      /**
       * Content::getTNA_PTKData(...)
       *  
       * @return
       */
      public function getTNA_PTKData($kelid = 0, $tgl_dari, $tgl_sampai, $bskid, $pskid, $kkid, $propinsi_kode, $kota_kode, $jenis = "P", $sortby = "pttna.last_update")
      {

            $sqlwhere = "(DATE(pttna.created) >= '". $tgl_dari ."' AND DATE(pttna.created) <= '" . $tgl_sampai . "')";
            if ($kelid > 0) {

                $sqlwhere .= " AND pttna.kelid = " . $kelid;
                if ($kkid > 0) {
                   $sqlwhere .= " AND pttna.kkid = " . $kkid;
                }
                  
                else {
                  if ($kelid == 3) {

                    if ($pskid > 0) {

                      $sqlwhere .= " AND k.pskid = " . $pskid;
                    } else if ($bskid > 0) {

                      $sqlwhere .= " AND ps.bskid = " . $bskid;
                    }

                  }
                }
            }

            // -- propinsi & kota --

            if ($kota_kode != "") {

              $sqlwhere .= " AND pt.kota_kode = '" . $kota_kode . "'";

            } else if ($propinsi_kode != "") {

              $sqlwhere .= " AND pt.propinsi_kode = '" . $propinsi_kode . "'";
            }

            if ($kelid == 3) {

              if ($bskid > 0)
                $sql = "SELECT pttna.*, ((pttna.nilai_total /pttna.nilai_instrumen) * 100) AS nilai_persen,"
                . "\n pt.nuptk AS ptk_nuptk, pt.nama_lengkap AS ptk_nama_lengkap, pt.golongan AS ptk_golongan,"
                . "\n s.nama_sekolah," 
                . "\n k.nama_kompetensi, k.pskid," 
                . "\n ps.nama_program" 
                . "\n FROM (((ptk_tna as pttna" 
                . "\n LEFT JOIN ptk AS pt ON pttna.ptkid = pt.id AND pttna.jenis = '" . $jenis . "')" 
                . "\n LEFT JOIN sekolah AS s ON pt.sekolahid = s.id)" 
                . "\n LEFT JOIN kk AS k ON pttna.kkid = k.id)" 
                . "\n LEFT JOIN psk AS ps ON k.pskid = ps.id" 
                . "\n WHERE $sqlwhere"
                . "\n ORDER BY " . $sortby;
              else
                $sql = "SELECT pttna.*, ((pttna.nilai_total /pttna.nilai_instrumen) * 100) AS nilai_persen,"
                . "\n pt.nuptk AS ptk_nuptk, pt.nama_lengkap AS ptk_nama_lengkap, pt.golongan AS ptk_golongan,"
                . "\n s.nama_sekolah," 
                . "\n k.nama_kompetensi, k.pskid" 
                . "\n FROM ((ptk_tna as pttna" 
                . "\n LEFT JOIN ptk AS pt ON pttna.ptkid = pt.id AND pttna.jenis = '" . $jenis . "')" 
                . "\n LEFT JOIN sekolah AS s ON pt.sekolahid = s.id)" 
                . "\n LEFT JOIN kk AS k ON pttna.kelid = " . $kelid . " AND pttna.kkid = k.id" 
                . "\n WHERE $sqlwhere"
                . "\n ORDER BY " . $sortby;

            }
            else if ($kelid == 1 || $kelid == 2)
              $sql = "SELECT pttna.*, ((pttna.nilai_total /pttna.nilai_instrumen) * 100) AS nilai_persen,"
              . "\n pt.nuptk AS ptk_nuptk, pt.nama_lengkap AS ptk_nama_lengkap, pt.golongan AS ptk_golongan,"
              . "\n s.nama_sekolah," 
              . "\n mp.nama_matapelajaran" 
              . "\n FROM ((ptk_tna as pttna" 
              . "\n LEFT JOIN ptk AS pt ON pttna.ptkid = pt.id AND pttna.jenis = 'P')" 
              . "\n LEFT JOIN sekolah AS s ON pt.sekolahid = s.id)" 
              . "\n LEFT JOIN matapelajaran AS mp ON pttna.kkid = mp.id" 
              . "\n WHERE $sqlwhere"
              . "\n ORDER BY ". $sortby;
            else
              $sql = "SELECT pttna.*, ((pttna.nilai_total /pttna.nilai_instrumen) * 100) AS nilai_persen,"
              . "\n pt.nuptk AS ptk_nuptk, pt.nama_lengkap AS ptk_nama_lengkap, pt.golongan AS ptk_golongan,"
              //. "\n st.nuptk AS staff_nuptk, st.nama_lengkap AS staff_nama_lengkap, st.golongan AS staff_golongan,"
              . "\n s.nama_sekolah," 
              //. "\n l.nama_lembaga," 
              . "\n k.nama_kompetensi, k.pskid," 
              . "\n mp.nama_matapelajaran" 
              . "\n FROM ((ptk_tna as pttna" 
              . "\n LEFT JOIN ptk AS pt ON pttna.ptkid = pt.id AND pttna.jenis = 'P')" 
              //. "\n LEFT JOIN staff AS st ON pttna.ptkid = st.id AND pttna.jenis = 'S')" 
              . "\n LEFT JOIN sekolah AS s ON pt.sekolahid = s.id)" 
              //. "\n LEFT JOIN lembaga AS l ON st.lembagaid = l.id)" 
              . "\n LEFT JOIN kk AS k ON pttna.kelid = 3 AND pttna.kkid = k.id" 
              . "\n LEFT JOIN matapelajaran AS mp ON (pttna.kelid = 1 Or pttna.kelid = 2) AND pttna.kkid = mp.id" 
              . "\n WHERE $sqlwhere"
              . "\n ORDER BY " . $sortby;

            $row = self::$db->fetch_all($sql);
  
            return ($row) ? $row : 0;
    
      }


      /**
       * Content::getTNA_PTK_KK(...)
       *  
       * @return
       */
      public function getTNA_PTKData_KK($kelid = 0, $tgl_dari, $tgl_sampai, $kkid, $jenis = "P")
      {

            $values = array();

            $sqlwhere = "(DATE(pttna.created) >= '". $tgl_dari ."' AND DATE(pttna.created) <= '" . $tgl_sampai . "')"
                ." AND pttna.kelid = " . $kelid . " AND pttna.kkid = " . $kkid;

            if ($kelid == 3)
                $sql = "SELECT pttna.*,"
                . "\n pt.nama_lengkap"
                . "\n FROM ptk_tna as pttna" 
                . "\n LEFT JOIN ptk AS pt ON pttna.ptkid = pt.id AND pttna.jenis = '" . $jenis . "'" 
                . "\n WHERE $sqlwhere"
                . "\n ORDER BY pt.nama_lengkap";
            else //if ($kelid == 1 || $kelid == 2) {}
              $sql = "SELECT pttna.*,"
              . "\n pt.nama_lengkap"
              . "\n FROM ptk_tna as pttna" 
              . "\n LEFT JOIN ptk AS pt ON pttna.ptkid = pt.id AND pttna.jenis = '" . $jenis . "'" 
              . "\n WHERE $sqlwhere"
              . "\n ORDER BY pt.nama_lengkap";

            $rows = self::$db->fetch_all($sql);

            foreach ($rows as $row) {
              $values[] = array("ptkid" => $row->ptkid,
                  "nama_lengkap" => $row->nama_lengkap);
            }            

            return $values;    
      }

      /**
       * Content::getTNA_PTK_KK(...)
       *  
       * @return
       */
      public function getTNA_PTKData_KKCount($kelid = 0, $tgl_dari, $tgl_sampai, $kkid, $jenis = "P")
      {

            $sqlkk = "SELECT * FROM kd"
              . "\n WHERE kkid = " . $kkid . " AND kelid = " . $kelid
              . "\n ORDER BY kdindex";

            $values = array();

            $kkrows = self::$db->fetch_all($sqlkk);
            if ($kkrows)
            {

                // -- get ptk list --

                $ptk_list = $this->getTNA_PTKData_KK($kelid, $tgl_dari, $tgl_sampai, $kkid, $jenis);
                $ptk_count = count($ptk_list);

                foreach ($kkrows as $row) {

                  if ($ptk_count > 0) {
                      $ptk_list_count = array($ptk_count);
                      for ($i = 0; $i < $ptk_count; $i++) {
                        $ptk_list_count[$i] = array("id" => $ptk_list[$i]["ptkid"], "jml" => 0);
                      }

                      $values[] = array("kdid" => $row->id,
                        "kdno" => $row->kdno,
                        "nama_kompetensi" => $row->nama_kompetensi,
                        "jml" => 0,
                        "ptk_list" => $ptk_list_count);
                  } else {
                      $values[] = array("kdid" => $row->id,
                        "kdno" => $row->kdno,
                        "nama_kompetensi" => $row->nama_kompetensi,
                        "jml" => 0);                    
                  }

                }
                unset($row);

                // -- get results --

                $sql = "SELECT id, ptkid FROM ptk_tna" 
                . "\n WHERE (DATE(created) >= '". $tgl_dari ."' AND DATE(created) <= '" . $tgl_sampai . "')"
                . "\n AND kelid = " . $kelid . " AND kkid = " . $kkid
                . "\n ORDER BY ptkid";

                $rows = self::$db->fetch_all($sql);
                if ($rows)
                {
                    foreach ($rows as $row)  // -- get : ptkid
                    {
                      $sqlkd = "SELECT kdid, kd_value FROM ptk_kd WHERE ptk_tnaid = " . $row->id . " ORDER by kdid";
                      $kdrows = self::$db->fetch_all($sqlkd);
                      if ($kdrows)
                      {
                          foreach ($kdrows as $kdrow) // -- get : kdid
                          {                            
                              // -- loop thru kdlist value --
                              foreach ($values as &$value)
                              {                                
                                  if ($value['kdid'] == $kdrow->kdid)
                                  {
                                      if ($value['ptk_list'])
                                      {
                                          foreach ($value['ptk_list'] as &$ptkc)
                                          {
                                              if ($ptkc["id"] == $row->ptkid)
                                              {
                                                  if ($kdrow->kd_value == 1)
                                                    $ptkc["jml"]++;                                                  

                                                  break;
                                              }
                                          }
                                          unset($ptkc);   
                                      }
                                      break;
                                  }
                              }  // -- end foreach .$values
                              unset($value);

                          } // -- end foreach .$kdrows
                          unset($kdrow);
                      }

                    } // -- end foreach .$rows
                    unset($row);
                } // -- end if ($rows)
            }
      
            return $values;    
      }
	  	  
     /**
       * Content::getTNA_PTK_KD($tnaid)
       * 
       * @return
       */
      public function getTNA_PTK_KD($tnaid)
      {

          $sql = "SELECT pkd.*,"
                . "\n k.kdno, k.nama_kompetensi"
                . "\n FROM ptk_kd AS pkd LEFT JOIN kd AS k" 
                . "\n ON pkd.kdid = k.id" 
                . "\n WHERE pkd.ptk_tnaid = '" . $tnaid . "'"
                . "\n ORDER BY k.kdindex";
		  		  
          $row = self::$db->fetch_all($sql);
  
          return ($row) ? $row : 0;
	  
      }
	  
     /**
       * Content::getTNA_PTKById($id)
       * 
       * @return
       */
      public function getTNA_PTKById($id)
      {
		  
          $sql = "SELECT pttna.*," 
                . "\n pt.nuptk, pt.nama_lengkap," 
                . "\n k.nama_kompetensi," 
                . "\n s.nama_sekolah" 
                . "\n FROM ((ptk_tna as pttna" 
                . "\n LEFT JOIN kk as k ON pttna.kkid = k.id)" 
                . "\n LEFT JOIN ptk as pt ON pttna.ptkid = pt.id)" 
                . "\n LEFT JOIN sekolah as s ON pttna.sekolahid = s.id" 
                . "\n WHERE pttna.id = " . $id;

          $row = self::$db->first($sql);

          return $row;
      }  
	
     /**
       * Content::getTNA_PTKByPTKId($ptkid, $jenis)
       * 
       * @return
       */
      public function getTNA_PTKByPTKId($ptkid, $jenis)
      {
      
          if ($jenis == "S")
            $sql = "SELECT pttna.*," 
                . "\n l.nama_lembaga," 
                . "\n k.nama_kompetensi," 
                . "\n mp.nama_matapelajaran"
                . "\n FROM ((ptk_tna as pttna" 
                . "\n LEFT JOIN kk as k ON pttna.kelid = 3 AND pttna.kkid = k.id)" 
                . "\n LEFT JOIN lembaga as l ON pttna.sekolahid = l.id)" 
                . "\n LEFT JOIN matapelajaran AS mp ON (pttna.kelid = 1 OR pttna.kelid = 2) AND pttna.kkid = mp.id" 
                . "\n WHERE pttna.ptkid = " . $ptkid . " AND pttna.jenis = '" . $jenis . "'";
          else
            $sql = "SELECT pttna.*," 
                . "\n s.nama_sekolah," 
                . "\n k.nama_kompetensi," 
                . "\n mp.nama_matapelajaran"
                . "\n FROM ((ptk_tna as pttna" 
                . "\n LEFT JOIN kk as k ON pttna.kelid = 3 AND pttna.kkid = k.id)" 
                . "\n LEFT JOIN sekolah as s ON pttna.sekolahid = s.id)" 
                . "\n LEFT JOIN matapelajaran AS mp ON (pttna.kelid = 1 OR pttna.kelid = 2) AND pttna.kkid = mp.id" 
                . "\n WHERE pttna.ptkid = " . $ptkid . " AND pttna.jenis = '" . $jenis . "'";

          $row = self::$db->fetch_all($sql);
  
          return ($row) ? $row : 0;

      }  

     /**
       * Content::getTNA_PTK_KK($ptkid, $kkid)
       * 
       * @return
       */
      public function getTNA_PTK_KK($ptkid, $kelid, $kkid)
      {
      
          $sql = "SELECT *" 
                . "\n FROM ptk_tna" 
                . "\n WHERE ptkid = " . $ptkid . " AND kelid = " . $kelid . " AND kkid = " .$kkid;

          $row = self::$db->first($sql);

          return $row;
      }  

      /**
       * Content::getGedung()-------------------------------------------------------------------------------------------------------------
       * 
       * @return
       */
      public function getGedung()
      {
	
          $counter = countEntries("gedung");

          $pager = Paginator::instance();
          $pager->items_total = $counter;
          $pager->default_ipp = Registry::get("Core")->perpage;
          $pager->paginate();
		  	  
          $sql = "SELECT g.*" 
                . "\n FROM gedung as g" 
                . "\n ORDER BY g.nama_gedung " . $pager->limit;

          $row = self::$db->fetch_all($sql);

          return ($row) ? $row : 0;
      }

      /**
       * Content::getGedungList()
       * 
       * @return
       */
      public function getGedungList()
      {

          $sql = "SELECT id, kode, nama_gedung" 
                . "\n FROM gedung" 
                . "\n ORDER BY nama_gedung";

          $row = self::$db->fetch_all($sql);

          return ($row) ? $row : 0;
      }
	  
	  /**
       * Content::processGedung()
       * 
       * @return
       */
      public function processGedung()
      {
			  
          if (empty($_POST['kode']))
              Filter::$msgs['kode'] = 'Silahkan masukkan Kode Gedung';

          if (empty($_POST['nama_gedung']))
              Filter::$msgs['nama_gedung'] = 'Silahkan masukkan Nama Gedung';
			  			  
          if (empty(Filter::$msgs)) {
              $data = array('kode' => sanitize($_POST['kode']),
                            'nama_gedung' => sanitize($_POST['nama_gedung']), 
                            'jml_kamar' => intval($_POST['jml_kamar']), 

                            'last_update' => 'NOW()',
                            'userid' => intval($_POST['userid']));

              if (!Filter::$id)
                  $data['created'] = "NOW()";				
														
              (Filter::$id) ? self::$db->update("gedung", $data, "id='" . Filter::$id . "'") : self::$db->insert("gedung", $data);
              $message = (Filter::$id) ? lang('DATA_UPDATED') : lang('DATA_ADDED');

              (self::$db->affected()) ? Filter::msgOk($message) : Filter::msgAlert(lang('NOPROCCESS'));
          } else
              print Filter::msgStatus();
      }

      /**
       * Content::getKamar()
       * 
       * @return
       */
      public function getKamar($gedungid = 0)
      {
	
          if ($gedungid == 0)
            $counter = countEntries("kamar");
          else
            $counter = countEntries("kamar", "gedungid", $gedungid);

          $pager = Paginator::instance();
          $pager->items_total = $counter;
          $pager->default_ipp = Registry::get("Core")->perpage;
          $pager->paginate();
		  	  
          if ($gedungid == 0)
            $sql = "SELECT k.*,"
                . "g.kode as kode_gedung, g.nama_gedung" 
                . "\n FROM kamar as k" 
                . "\n LEFT JOIN gedung as g ON k.gedungid = g.id" 
                . "\n ORDER BY k.kode " . $pager->limit;
          else		  
            $sql = "SELECT k.*,"
                . "g.kode as kode_gedung, g.nama_gedung" 
                . "\n FROM kamar as k" 
                . "\n LEFT JOIN gedung as g ON k.gedungid = g.id" 
                . "\n WHERE k.gedungid = " . $gedungid
                . "\n ORDER BY k.kode " . $pager->limit;

          $row = self::$db->fetch_all($sql);

          return ($row) ? $row : 0;
      }
	  
      /**
       * Content::getKamarList()
       * 
       * @return
       */
      public function getKamarList($gedungid = 0)
      {

          if ($gedungid > 0)
            $sql = "SELECT id, kode, jenis" 
                . "\n FROM kamar" 
                . "\n WHERE gedungid = ". $gedungid 
                . "\n ORDER BY kode";
          else
            $sql = "SELECT id, kode, jenis" 
                . "\n FROM kamar" 
                . "\n ORDER BY kode";

          $row = self::$db->fetch_all($sql);

          return ($row) ? $row : 0;
      }

      /**
       * Content::loadKamarList()
       * 
       * @param $gedungid
       * @return
       */
	  public function loadKamarList($gedungid)
	  {

                $pdata = $this->getKamarList($gedungid);

                print '<option value="" selected="selected">'.lang('SELECT').'</option>\n';

                if ($pdata) {
                      foreach ($pdata as $prow) {
                              print '<option value="'.$prow->id.'">'.$prow->kode.' / '.$prow->jenis.'</option>\n';
                      }
                      unset($prow); 
                }

	  }	  
	  
     /**
       * Content::getGedungIdByKamarId()
       * 
       * @return
       */
      public function getGedungIdByKamarId($id)
      {
		  
          $sql = "SELECT gedungid FROM kamar WHERE id = ". $id;
		  
          $row = self::$db->first($sql);
          
          if ($row)
            return $row->gedungid;
          else
            return 0;
          
      }

	  
	  /**
       * Content::processKamar()
       * 
       * @return
       */
      public function processKamar()
      {
			  
          if (empty($_POST['kode']))
              Filter::$msgs['kode'] = 'Silahkan masukkan Kode Kamar';
			  			  
          if (empty(Filter::$msgs)) {
              $data = array('gedungid' => intval($_POST['gedungid']),
                            'kode' => sanitize($_POST['kode']),
                            'jenis' => sanitize($_POST['jenis']), 
                            'jml_bed' => intval($_POST['jml_bed']), 

                            'last_update' => 'NOW()',
                            'userid' => intval($_POST['userid']));

              if (!Filter::$id)
                  $data['created'] = "NOW()";				
														
              (Filter::$id) ? self::$db->update("kamar", $data, "id='" . Filter::$id . "'") : self::$db->insert("kamar", $data);
              $message = (Filter::$id) ? lang('DATA_UPDATED') : lang('DATA_ADDED');

              (self::$db->affected()) ? Filter::msgOk($message) : Filter::msgAlert(lang('NOPROCCESS'));
          } else
              print Filter::msgStatus();
      }

      /**
       * Content::getKamar_Bed($kkid)
       * 
       * @return
       */
      public function getKamar_Bed($kamarid = 0)
      {
	
          if ($kamarid == 0)
                $counter = countEntries("kamar_bed");
          else
                $counter = countEntries("kamar_bed", "kamarid", $kamarid);

          $pager = Paginator::instance();
          $pager->items_total = $counter;
          $pager->default_ipp = Registry::get("Core")->perpage;
          $pager->paginate();
		  	  
          if ($kamarid == 0)
            $sql = "SELECT kb.*,"
                . "k.kode as kode_kamar, k.jenis" 
                . "\n FROM kamar_bed as kb" 
                . "\n LEFT JOIN kamar as k ON kb.kamarid = k.id" 
                . "\n ORDER BY kb.kode " . $pager->limit;
          else		  
            $sql = "SELECT kb.*,"
                . "k.kode as kode_kamar, k.jenis" 
                . "\n FROM kamar_bed as kb" 
                . "\n LEFT JOIN kamar as k ON kb.kamarid = k.id" 
                . "\n WHERE kb.kamarid = " . $kamarid
                . "\n ORDER BY kb.kode " . $pager->limit;

          $row = self::$db->fetch_all($sql);

          return ($row) ? $row : 0;
      }

      /**
       * Content::getKamar_BedList()
       * 
       * @return
       */
      public function getKamar_BedList($kamarid = 0)
      {

          if ($kamarid > 0)
            $sql = "SELECT id, kode, status" 
                . "\n FROM kamar_bed" 
                . "\n WHERE kamarid = " . $kamarid 
                . "\n ORDER BY kode";
          else
            $sql = "SELECT id, kode, status" 
                . "\n FROM kamar_bed" 
                . "\n ORDER BY kode";

          $row = self::$db->fetch_all($sql);

          return ($row) ? $row : 0;
      }

      /**
       * Content::loadKamar_BedList()
       * 
       * @param $kamarid
       * @return
       */
	  public function loadKamar_BedList($kamarid)
	  {

		  $pdata = $this->getKamar_BedList($kamarid);
		  
		  print '<option value="" selected="selected">'.lang('SELECT').'</option>\n';

		  if ($pdata) {
			foreach ($pdata as $prow) {
				print '<option value="'.$prow->id.'">'.$prow->kode.' / '.$prow->status.'</option>\n';
			}
			unset($prow); 
		  }

	  }	  

	  
	  /**
       * Content::processKamar_Bed()
       * 
       * @return
       */
      public function processKamar_Bed()
      {
			  
          if (empty($_POST['kode']))
              Filter::$msgs['kode'] = 'Silahkan masukkan Kode Kamar';
			  			  
          if (empty(Filter::$msgs)) {
              $data = array('kamarid' => intval($_POST['kamarid']),
                            'kode' => sanitize($_POST['kode']),
                            'status' => sanitize($_POST['status']), 

                            'last_update' => 'NOW()',
                            'userid' => intval($_POST['userid']));

              if (!Filter::$id)
                  $data['created'] = "NOW()";				
														
              (Filter::$id) ? self::$db->update("kamar_bed", $data, "id='" . Filter::$id . "'") : self::$db->insert("kamar_bed", $data);
              $message = (Filter::$id) ? lang('DATA_UPDATED') : lang('DATA_ADDED');

              (self::$db->affected()) ? Filter::msgOk($message) : Filter::msgAlert(lang('NOPROCCESS'));
          } else
              print Filter::msgStatus();
      }
	
       /**
       * Content::getDiklat_Mata_Tatar()-------------------------------------------------------------------------------------------------------------
       * 
       * @return
       */
      public function getDiklat_Mata_Tatar($jadwalid = 0)
      {

            $pager = Paginator::instance();
            if ($jadwalid > 0)
                $pager->items_total = countEntries("diklat_mata_tatar", "jadwalid", $jadwalid);
            else
                $pager->items_total = countEntries("diklat_mata_tatar");

            $pager->default_ipp = Registry::get("Core")->perpage;
            $pager->paginate();

            if ($jadwalid > 0)
              $sql = "SELECT dmt.*,"
                . "\n dj.tgl_mulai, dj.tgl_akhir,"
                . "\n d.kode as kode_diklat, d.nama_diklat" 
                . "\n FROM (diklat_mata_tatar as dmt" 
                . "\n LEFT JOIN diklat_jadwal as dj ON dmt.jadwalid = dj.id)" 
                . "\n LEFT JOIN diklat as d ON dj.diklatid = d.id" 
                . "\n WHERE dmt.jadwalid = '" . $jadwalid . "'"
                . "\n ORDER BY dmt.nama_mata_tatar " . $pager->limit;
            else
              $sql = "SELECT dmt.*,"
                . "\n dj.tgl_mulai, dj.tgl_akhir,"
                . "\n d.kode as kode_diklat, d.nama_diklat" 
                . "\n FROM (diklat_mata_tatar as dmt" 
                . "\n LEFT JOIN diklat_jadwal as dj ON dmt.jadwalid = dj.id)" 
                . "\n LEFT JOIN diklat as d ON dj.diklatid = d.id" 
                . "\n ORDER BY dmt.nama_mata_tatar " . $pager->limit;

            $row = self::$db->fetch_all($sql);

            return ($row) ? $row : 0;
	  
      }

      /**
       * Content::getDiklat_Mata_TatarList()
       * 
       * @return
       */
      public function getDiklat_Mata_TatarList()
      {

          $sql = "SELECT id, kode, nama_mata_tatar" 
                . "\n FROM diklat_mata_tatar" 
                . "\n ORDER BY nama_mata_tatar";

          $row = self::$db->fetch_all($sql);

          return ($row) ? $row : 0;
      }
	  
	  
	  /**
       * Content::processDiklat_Mata_Tatar()
       * 
       * @return
       */
      public function processDiklat_Mata_Tatar()
      {

          if (empty($_POST['jadwalid']))
              Filter::$msgs['jadwalid'] = 'Jadwal Diklat belum dipilih';


          if (empty(Filter::$msgs)) {
              $data = array('jadwalid' => intval($_POST['jadwalid']),
							'kode' => sanitize($_POST['kode']),
							'nama_mata_tatar' => sanitize($_POST['nama_mata_tatar']), 
							'nama_pengajar' => sanitize($_POST['nama_pengajar']), 
							
							'last_update' => 'NOW()',
							'userid' => intval($_POST['userid']));

              if (!Filter::$id)
                  $data['created'] = "NOW()";				
														
              (Filter::$id) ? self::$db->update("diklat_mata_tatar", $data, "id='" . Filter::$id . "'") : self::$db->insert("diklat_mata_tatar", $data);
              $message = (Filter::$id) ? lang('DATA_UPDATED') : lang('DATA_ADDED');

              (self::$db->affected()) ? Filter::msgOk($message) : Filter::msgAlert(lang('NOPROCCESS')); 
			  
          } else
              print Filter::msgStatus();
      }
	
      /**
       * Content::getDiklat_Absen()-------------------------------------------------------------------------------------------------------------
       * 
       * @return
       */
      public function getDiklat_Absen($jadwalid = 0, $tanggal)
      {
	
	    $q = "SELECT COUNT(*) FROM diklat_peserta WHERE jadwalid = ". $jadwalid;
			
            $record = Registry::get("Database")->query($q);
            $total = Registry::get("Database")->fetchrow($record);
            $counter = $total[0];		

            $pager = Paginator::instance();
            $pager->items_total = $counter;		   
            $pager->default_ipp = Registry::get("Core")->perpage;
            $pager->paginate();
	  
            $sql = "SELECT dp.*,"
                    . "\n p.nama_propinsi," 
                    . "\n k.nama_kota," 
                    . "\n da.id as absenid, da.status, da.tanggal, da.waktu" 
                    . "\n FROM ((diklat_peserta AS dp" 
                    . "\n LEFT JOIN propinsi AS p ON dp.propinsi_kode = p.kode)" 
                    . "\n LEFT JOIN kota AS k ON dp.kota_kode = k.kode)" 
                    . "\n LEFT JOIN diklat_absen AS da ON da.pesertaid = dp.id AND da.tanggal = '" . $tanggal . "'"
                    . "\n WHERE dp.jadwalid = " . $jadwalid
                    //. "\n $order" 
                    . "\n ORDER BY dp.nama_lengkap " . $pager->limit;

          $row = self::$db->fetch_all($sql);

          return ($row) ? $row : 0;
	  
      }

     /**
       * Content::getDiklat_AbsenPeserta()
       * 
       * @return
       */
      public function getDiklat_AbsenPeserta($id)
      {
		  
          $sql = "SELECT dp.id, dp.jadwalid, dp.personid,"
                . "\n pt.nuptk, pt.nama_lengkap, pt.nip, pt.alamat,"
                . "\n s.nama_sekolah," 
                . "\n p.nama_propinsi," 
                . "\n da.id as absenid, da.status, da.tanggal, da.waktu, da.catatan" 
                . "\n FROM (((diklat_peserta as dp" 
                . "\n LEFT JOIN ptk as pt ON dp.personid = pt.id)" 
                . "\n LEFT JOIN sekolah as s ON dp.instansiid = s.id)" 
                . "\n LEFT JOIN propinsi as p ON pt.propinsi_kode = p.kode)" 
                . "\n LEFT JOIN diklat_absen as da ON da.pesertaid = dp.id" 
                . "\n WHERE dp.id = '" . $id . "'";
          		
          $row = self::$db->first($sql);

          return $row;
      }

	  /**
	   * Content::DiklatAbsensiStatusList()
	   * 
	   * @param string $selected
	   * @return
	   */
	  public function Diklat_AbsenStatusList($selected = '')
	  {
	      $arr = array('M' => 'M : Masuk', 'S' => 'S : Sakit', 'T' => 'T : Terlambat', 'I' => 'I : Izin', 'A' => 'A : Alfa');

		  $list = '';
		  foreach ($arr as $key => $val) {
			  $sel = ($key == $selected) ? ' selected="selected"' : '';
			  $list .= "<option value=\"" . $key . "\"" . $sel . ">" . $val . "</option>\n";
		  }
		  unset($val);
		  return $list;
	  }
	
	  /**
       * Content::processDiklat_Absen()
       * 
       * @return
       */
      public function processDiklat_Absen()
      {
			  
          if (empty($_POST['pesertaid']))
              Filter::$msgs['pesertaid'] = 'Peserta Diklat tidak valid!';
			  
          if (empty(Filter::$msgs)) {
              $data = array('pesertaid' => intval($_POST['pesertaid']),
                            'tanggal' => sanitize($_POST['tanggal']),
                            'waktu' => sanitize($_POST['waktu']),
                            'status' => sanitize($_POST['status']), 
                            'catatan' => sanitize($_POST['catatan']), 

                            'userid' => intval($_POST['userid']));
							
              if (!Filter::$id)
                  $data['created'] = "NOW()";				
														
              (Filter::$id) ? self::$db->update("diklat_absen", $data, "id='" . Filter::$id . "'") : self::$db->insert("diklat_absen", $data);
              $message = (Filter::$id) ? lang('DATA_UPDATED') : lang('DATA_ADDED');

              (self::$db->affected()) ? Filter::msgOk($message) : Filter::msgAlert(lang('NOPROCCESS'));
          } else
              print Filter::msgStatus();
      }

      /**
       * Content::getDiklat_NilaiPeserta()-------------------------------------------------------------------------------------------------------------
       * 
       * @return
       */
      public function getDiklat_NilaiPeserta($pesertaid = 0, $jadwalid = 0)
      {
		  
            $sql = "SELECT dmt.id, dmt.kode, dmt.nama_mata_tatar, dmt.pengajarid, dmt.nama_pengajar,"
                . "\n dn.id as nilaiid, dn.nilai, dn.catatan" 
                . "\n FROM diklat_mata_tatar as dmt" 
                . "\n LEFT JOIN diklat_nilai as dn ON dn.pesertaid = '" . $pesertaid . "'"
                . "\n WHERE dmt.jadwalid = '" . $jadwalid . "'"
                . "\n ORDER BY dmt.nama_mata_tatar";

            $row = self::$db->fetch_all($sql);

            return ($row) ? $row : 0;
	  
      }
	
	  /**
       * Content::processDiklat_Nilai()
       * 
       * @return
       */
      public function processDiklat_Nilai()
      {
			  
          if (empty($_POST['pesertaid']))
              Filter::$msgs['pesertaid'] = 'Peserta Diklat tidak valid!';
			  
          if (empty(Filter::$msgs)) {
	
			$pesertaid = intval($_POST['pesertaid']);
	
			foreach ($_POST['mata_tatarid'] as $key => $val) {
				$edata = array(
						'pesertaid' => $pesertaid,
						'mata_tatarid' => intval($_POST['mata_tatarid'][$key]),
						'nilai' => sanitize($_POST['nilai'][$key]),
						'catatan' => sanitize($_POST['catatan'][$key]),
						
						'last_update' => 'NOW()',
						'userid' => intval($_POST['userid']));
						
				if (!$_POST['nilaiid'][$key])
					$edata['created'] = "NOW()";											
							
				($_POST['nilaiid'][$key]) ? self::$db->update("diklat_nilai", $edata, "id='" . $_POST['nilaiid'][$key] . "'") : self::$db->insert("diklat_nilai", $edata);

			}
						
			$affectedrows = self::$db->affected();
						
	        ($affectedrows) ? Filter::msgOk($affectedrows . ' Data berhasil diproses.') : Filter::msgAlert(lang('NOPROCCESS'));

          } else
              print Filter::msgStatus();
      }
	  
      /**
       * Content::getDiklat_Sertifikat()-------------------------------------------------------------------------------------------------------------
       * 
       * @return
       */
      public function getDiklat_Sertifikat($jadwalid = 0)
      {
	
	    $q = "SELECT COUNT(*) FROM diklat_peserta WHERE jadwalid = ". $jadwalid;
				
            $record = Registry::get("Database")->query($q);
            $total = Registry::get("Database")->fetchrow($record);
            $counter = $total[0];		

            $pager = Paginator::instance();
            $pager->items_total = $counter;		   
            $pager->default_ipp = Registry::get("Core")->perpage;
            $pager->paginate();

            $sql = "SELECT dp.*,"
                    . "\n p.nama_propinsi," 
                    . "\n k.nama_kota" 
                    . "\n FROM (diklat_peserta AS dp" 
                    . "\n LEFT JOIN propinsi AS p ON dp.propinsi_kode = p.kode)" 
                    . "\n LEFT JOIN kota AS k ON dp.kota_kode = k.kode" 
                    . "\n WHERE dp.jadwalid = " . $jadwalid
                    //. "\n $order" 
                    . "\n ORDER BY dp.nama_lengkap " . $pager->limit;

            $row = self::$db->fetch_all($sql);

            return ($row) ? $row : 0;
	  
      }

     /**
       * Content::getDiklat_SertifikatPeserta()
       * 
       * @return
       */
      public function getDiklat_SertifikatPeserta($id)
      {
		  
          $sql = "SELECT dp.*,"
                . "\n pt.nuptk, pt.nama_lengkap, pt.nip, pt.alamat, pt.tmp_lahir, pt.tgl_lahir, pt.jns_klmn, pt.golongan, pt.agama, pt.alamat, pt.telepon1, pt.nama_ibu,"
                . "\n s.nama_sekolah," 
                . "\n p.nama_propinsi" 
                . "\n FROM ((diklat_peserta as dp" 
                . "\n LEFT JOIN ptk as pt ON dp.personid = pt.id)" 
                . "\n LEFT JOIN sekolah as s ON dp.instansiid = s.id)" 
                . "\n LEFT JOIN propinsi as p ON pt.propinsi_kode = p.kode" 
                . "\n WHERE dp.id = '" . $id . "'";
       
          $row = self::$db->first($sql);

          return $row;
      }

	  /**
	   * Content::DiklatSertifikatStatusList()
	   * 
	   * @param string $selected
	   * @return
	   */
	  public function Diklat_SertifikatStatusList($selected = '')
	  {
	      $arr = array('L' => 'L : Lulus', 'T' => 'T : Tidak Lulus', 'M' => 'M : Mengundurkan Diri', 'S' => 'S : Sakit');

		  $list = '';
		  foreach ($arr as $key => $val) {
			  $sel = ($key == $selected) ? ' selected="selected"' : '';
			  $list .= "<option value=\"" . $key . "\"" . $sel . ">" . $val . "</option>\n";
		  }
		  unset($val);
		  return $list;
	  }
	
	  /**
       * Content::processDiklat_Sertifikat()
       * 
       * @return
       */
      public function processDiklat_Sertifikat()
      {
			  
          if (empty($_POST['no_sertifikat']))
              Filter::$msgs['no_sertifikat'] = 'No. Sertifikat masih kosong!';
			  
          if (empty(Filter::$msgs)) {
              $data = array('no_sertifikat' => sanitize($_POST['no_sertifikat']),
                            'nilai' => sanitize($_POST['nilai']),
                            'catatan_sertifikat' => sanitize($_POST['catatan_sertifikat']), 

                            'last_update' => 'NOW()',							
                            'userid' => intval($_POST['userid']));
																					
              self::$db->update("diklat_peserta", $data, "id='" . Filter::$id . "'");
              $message = (Filter::$id) ? lang('DATA_UPDATED') : lang('DATA_ADDED');

          } else
              print Filter::msgStatus();
      }
	  
	  /**
       * Content::processDiklat_SertifikatValidasi()
       * 
       * @return
       */
      public function processDiklat_SertifikatValidasi()
      {
			  
          if (empty($_POST['pesertaid']))
              Filter::$msgs['pesertaid'] = 'Peserta Diklat tidak valid!';

          if (empty($_POST['ptkid']))
              Filter::$msgs['ptkid'] = 'Data PTK tidak valid!';
			  			  
          if (empty(Filter::$msgs)) {
		  
              $ptkid = intval($_POST['ptkid']);
              $data = array('nama_lengkap' => sanitize($_POST['nama_lengkap']),
                            'nuptk' => sanitize($_POST['nuptk']),
                            'nip' => sanitize($_POST['nip']), 
                            'tmp_lahir' => sanitize($_POST['tmp_lahir']),
                            'tgl_lahir' => sanitize($_POST['tgl_lahir']), 
                            'jns_klmn' => sanitize($_POST['jns_klmn']), 

                            'agama' => sanitize($_POST['agama']), 
                            'alamat' => sanitize($_POST['alamat']), 
                            'telepon2' => sanitize($_POST['telepon2']), 
                            'nama_ibu' => sanitize($_POST['nama_ibu']), 

                            'last_update' => 'NOW()',							
                            'userid' => intval($_POST['userid']));
														
              self::$db->update("ptk", $data, "id='" . $ptkid . "'");
              $message = lang('DATA_UPDATED');

              Filter::msgOk($message);
			   
          } else
              print Filter::msgStatus();
      }
	 
       /**
       * Content::getDiklat_Agenda()-------------------------------------------------------------------------------------------------------------
       * 
       * @return
       */
      public function getDiklat_Agenda($jadwalid = 0)
      {

            $pager = Paginator::instance();
            if ($jadwalid > 0)
                    $pager->items_total = countEntries("diklat_agenda", "jadwalid", $jadwalid);
            else
                    $pager->items_total = countEntries("diklat_agenda");

            $pager->default_ipp = Registry::get("Core")->perpage;
            $pager->paginate();

            if ($jadwalid > 0)
              $sql = "SELECT dag.*,"
              . "\n dmt.kode, dmt.nama_mata_tatar,"
              . "\n dj.tgl_mulai, dj.tgl_akhir,"
              . "\n d.kode as kode_diklat, d.nama_diklat" 
              . "\n FROM ((diklat_agenda as dag" 
              . "\n LEFT JOIN diklat_jadwal as dj ON dag.jadwalid = dj.id)" 
              . "\n LEFT JOIN diklat as d ON dj.diklatid = d.id)" 
              . "\n LEFT JOIN diklat_mata_tatar as dmt ON dag.mata_tatarid = dmt.id" 
              . "\n WHERE dag.jadwalid = '" . $jadwalid . "'"
              . "\n ORDER BY dag.nama_mata_tatar " . $pager->limit;
            else
              $sql = "SELECT dag.*,"
              . "\n dmt.kode, dmt.nama_mata_tatar,"
              . "\n dj.tgl_mulai, dj.tgl_akhir,"
              . "\n d.kode as kode_diklat, d.nama_diklat" 
              . "\n FROM (diklat_agenda as dag" 
              . "\n LEFT JOIN diklat_jadwal as dj ON dag.jadwalid = dj.id)" 
              . "\n LEFT JOIN diklat as d ON dj.diklatid = d.id" 
              . "\n LEFT JOIN diklat_mata_tatar as dmt ON dag.mata_tatarid = dmt.id" 
              . "\n ORDER BY dmt.nama_mata_tatar " . $pager->limit;

            $row = self::$db->fetch_all($sql);

            return ($row) ? $row : 0;
	  
      }

      /**
       * Content::getDiklat_AgendaList()
       * 
       * @return
       */
      public function getDiklat_AgendaList()
      {

          $sql = "SELECT *" 
                . "\n FROM diklat_agenda" 
                . "\n ORDER BY tanggal";

          $row = self::$db->fetch_all($sql);

          return ($row) ? $row : 0;
      }
	  
	  
	  /**
       * Content::processDiklat_Agenda()
       * 
       * @return
       */
      public function processDiklat_Agenda()
      {

          if (empty($_POST['jadwalid']))
              Filter::$msgs['jadwalid'] = 'Jadwal Diklat belum dipilih';

          if (empty(Filter::$msgs)) {
              $data = array('jadwalid' => intval($_POST['jadwalid']),
                            'tanggal' => sanitize($_POST['tanggal']),
                            'waktu_dari' => sanitize($_POST['waktu_dari']), 
                            'waktu_sampai' => sanitize($_POST['waktu_sampai']), 
                            'mata_tatarid' => intval($_POST['mata_tatarid']),
                            'nama_tempat' => sanitize($_POST['nama_tempat']), 
                            'nama_pengajar' => sanitize($_POST['nama_pengajar']), 

                            //'keterangan' => sanitize($_POST['keterangan']), 
                            'last_update' => 'NOW()',
                            'userid' => intval($_POST['userid']));

              if (!Filter::$id)
                  $data['created'] = "NOW()";				
														
              (Filter::$id) ? self::$db->update("diklat_agenda", $data, "id='" . Filter::$id . "'") : self::$db->insert("diklat_agenda", $data);
              $message = (Filter::$id) ? lang('DATA_UPDATED') : lang('DATA_ADDED');

              (self::$db->affected()) ? Filter::msgOk($message) : Filter::msgAlert(lang('NOPROCCESS')); 
			  
          } else
              print Filter::msgStatus();
      }
      
      
       /**
       * Content::getLembaga()-------------------------------------------------------------------------------------------------------------
       * 
       * @return
       */
      public function getLembaga()
      {
          
        if (isset($_GET['propinsi_kode']))
              $propinsi_kode = sanitize($_GET['propinsi_kode']);
        else
              $propinsi_kode = '';

        if (isset($_GET['kota_kode']))
              $kota_kode = sanitize($_GET['kota_kode']);
        else
              $kota_kode = '';

        if (isset($_GET['searchfield']))
              $searchfield = strtolower(sanitize($_GET['searchfield']));
        else
              $searchfield = '';
        
        if (isset($_GET['searchtext']))
              $searchtext = strtolower(sanitize($_GET['searchtext']));
        else
              $searchtext = '';
                
        if ($propinsi_kode != '') {
              if ($kota_kode != '') {
                $q = "SELECT count(*) FROM lembaga WHERE propinsi_kode = '" . $propinsi_kode . "' AND kota_kode = '" . $kota_kode . "'";
                $sqlwhere = "WHERE l.propinsi_kode = '" . $propinsi_kode . "' AND l.kota_kode = '" . $kota_kode . "'";
                
                if (($searchfield != '') && ($searchtext != '')) {
                    $q .= " AND LOWER(" . $searchfield . ") LIKE '%" . $searchtext . "%'";
                    $sqlwhere .= " AND LOWER(l." . $searchfield . ") LIKE '%" . $searchtext . "%'";
                }

              } else {
                $q = "SELECT count(*) FROM lembaga WHERE propinsi_kode = '" . $propinsi_kode . "'";
                $sqlwhere = "WHERE l.propinsi_kode = '" . $propinsi_kode . "'";
                      
                if (($searchfield != '') && ($searchtext != '')) {
                    $q .= " AND LOWER(" . $searchfield . ") LIKE '%" . $searchtext . "%'";
                    $sqlwhere .= " AND LOWER(l." . $searchfield . ") LIKE '%" . $searchtext . "%'";
                }
                      
              }
        } else {
              if ($kota_kode != '') {
                $q = "SELECT count(*) FROM lembaga WHERE kota_kode = '" . $kota_kode . "'";
                $sqlwhere = "WHERE l.kota_kode = '" . $kota_kode . "'";
                      
                if (($searchfield != '') && ($searchtext != '')) {
                    $q .= " AND LOWER(" . $searchfield . ") LIKE '%" . $searchtext . "%'";
                    $sqlwhere .= " AND LOWER(l." . $searchfield . ") LIKE '%" . $searchtext . "%'";
                }
                      
              } else {
                $q = "SELECT count(*) FROM lembaga";
                $sqlwhere = "";
                
                if (($searchfield != '') && ($searchtext != '')) {
                    $q .= " WHERE LOWER(" . $searchfield . ") LIKE '%" . $searchtext . "%'";
                    $sqlwhere .= "WHERE LOWER(l." . $searchfield . ") LIKE '%" . $searchtext . "%'";
                }
                
              }
        }

        $record = Registry::get("Database")->query($q);
        $total = Registry::get("Database")->fetchrow($record);
        $counter = $total[0];

        $pager = Paginator::instance();
        $pager->items_total = $counter;
        $pager->default_ipp = Registry::get("Core")->perpage;
        $pager->paginate();

        if (isset($_GET['sortfield'])) {
            $sortfield = sanitize($_GET['sortfield']);
            if (isset($_GET['sorttype']))
                $sorttype = sanitize($_GET['sorttype']);
            else
                $sorttype = "ASC";

            if (in_array($sortfield, array("l.nama_lembaga", "p.nama_propinsi", "k.nama_kota"))) {
                $sort = ($sorttype == 'DESC') ? " DESC " : " ASC ";

                $sqlorder = "LOWER(" . $sortfield . ") " . $sort;
            } else
                $sqlorder = "LOWER(l.nama_lembaga)";
        } else
            $sqlorder = "LOWER(l.nama_lembaga)";
        
        $sql = "SELECT l.id, l.nama_lembaga, l.propinsi_kode, l.kota_kode, l.alamat, l.nama_pimpinan, l.staffid," 
        . "\n p.nama_propinsi," 
        . "\n k.nama_kota" 
        . "\n FROM (lembaga as l" 
        . "\n LEFT JOIN propinsi as p ON l.propinsi_kode = p.kode)" 
        . "\n LEFT JOIN kota as k ON l.kota_kode = k.kode" 
        . "\n $sqlwhere" 
        . "\n ORDER BY " . $sqlorder . $pager->limit;

        $row = self::$db->fetch_all($sql);

        return ($row) ? $row : 0;
	  
      }

     /**
       * Content::getLembagaList($propinsi_kode, $kota_kode)-------------------
       * 
       * @return
       */
      public function getLembagaList($propinsi_kode, $kota_kode)
      {
          
          if ($propinsi_kode != "")
              $sqlwhere = "propinsi_kode = '" . $propinsi_kode . "'";
          else
              $sqlwhere = "";
          
          if ($kota_kode != "") {
              if ($sqlwhere != "")
                $sqlwhere .= " AND kota_kode = '" . $kota_kode . "'";
              else
                $sqlwhere = "kota_kode = '" . $kota_kode . "'";
          }
          
          $sql = "SELECT id, nama_lembaga"
                    ."\n FROM lembaga"
                    ."\n WHERE ". $sqlwhere
                    ."\n ORDER BY nama_lembaga";
				 
          $row = self::$db->fetch_all($sql);

          return ($row) ? $row : 0;
      }
	  	  
      /**
       * Content::loadLembagaList()
       * 
       * @param $propinsi_kode, $kota_kode
       * @return
       */
        public function loadLembagaList($propinsi_kode, $kota_kode)
        {

                $pdata = $this->getLembagaList($propinsi_kode, $kota_kode);

                print '<option value="" selected="selected">'.lang('SELECT').'</option>\n';

                if ($pdata) {
                      foreach ($pdata as $prow) {
                              print '<option value="'.$prow->id.'">'.$prow->nama_lembaga.'</option>\n';
                      }
                      unset($prow); 
                }

        }
                  
      /**
       * Content::processUpdateLembaga()
       * 
       * @return
       */
      public function processUpdateLembaga()
      {

          if (empty($_POST['nama_lembaga']))
              Filter::$msgs['nama_lembaga'] = 'Silahkan masukkan Nama Lembaga';

          if (empty($_POST['propinsi_kode']))
              Filter::$msgs['propinsi_kode'] = 'Silahkan pilih Propinsi';

          if (empty($_POST['kota_kode']))
              Filter::$msgs['kota_kode'] = 'Silahkan pilih Kota';

          if (empty(Filter::$msgs)) {
              $data = array('nama_lembaga' => sanitize($_POST['nama_lembaga']), 
                            'nama_pimpinan' => sanitize($_POST['nama_pimpinan']),
                            'nip_pimpinan' => sanitize($_POST['nip_pimpinan']),
                            'nuptk_pimpinan' => sanitize($_POST['nuptk_pimpinan']),
                            'telp_pimpinan' => sanitize($_POST['telp_pimpinan']),

                            'propinsi_kode' => sanitize($_POST['propinsi_kode']), 
                            'kota_kode' => sanitize($_POST['kota_kode']), 
                  
                            'alamat' => sanitize($_POST['alamat']),
                            'kodepos' => sanitize($_POST['kodepos']),
                            'telepon1' => sanitize($_POST['telepon1']),
                            'telepon2' => sanitize($_POST['telepon2']),
                            'fax' => sanitize($_POST['fax']),
                            'email' => sanitize($_POST['email']),
                            'website' => sanitize($_POST['website']),
                            //'staffid' => intval($_POST['staffid']),

                            //'sourceid' => sanitize($_POST['sourceid']),
                            //'source_namet' => sanitize($_POST['source_name']),

                            'last_update' => 'NOW()',
                            'userid' => intval($_POST['userid']));

              self::$db->update("lembaga", $data, "id='" . Filter::$id . "'");
              (self::$db->affected()) ? Filter::msgOk(lang('DATA_UPDATED')) : Filter::msgAlert(lang('NOPROCCESS'));

		  
          } else
              print Filter::msgStatus();
		  
      }

      /**
       * Content::processAddLembaga()
       * 
       * @return
       */
      public function processAddLembaga()
      {
          if (empty($_POST['nama_lembaga']))
              Filter::$msgs['nama_lembaga'] = 'Silahkan masukkan Nama Lembaga';

          if (empty($_POST['propinsi_kode']))
              Filter::$msgs['propinsi_kode'] = 'Silahkan pilih Propinsi';

          if (empty($_POST['kota_kode']))
              Filter::$msgs['kota_kode'] = 'Silahkan pilih Kota';	  
		  
          if (empty(Filter::$msgs)) {
			  
              $data = array('nama_lembaga' => sanitize($_POST['nama_lembaga']), 
                            'nama_pimpinan' => sanitize($_POST['nama_pimpinan']),
                            'nip_pimpinan' => sanitize($_POST['nip_pimpinan']),
                            'nuptk_pimpinan' => sanitize($_POST['nuptk_pimpinan']),
                            'telp_pimpinan' => sanitize($_POST['telp_pimpinan']),

                            'propinsi_kode' => sanitize($_POST['propinsi_kode']), 
                            'kota_kode' => sanitize($_POST['kota_kode']), 
                  
                            'alamat' => sanitize($_POST['alamat']),
                            'kodepos' => sanitize($_POST['kodepos']),
                            'telepon1' => sanitize($_POST['telepon1']),
                            'telepon2' => sanitize($_POST['telepon2']),
                            'fax' => sanitize($_POST['fax']),
                            'email' => sanitize($_POST['email']),
                            'website' => sanitize($_POST['website']),
                            // 'staffid' => intval($_POST['staffid']),

                            'source_id' => sanitize($_POST['source_id']),
                            'source_name' => sanitize($_POST['source_name']),

                            'last_update' => 'NOW()',
                            'created' => 'NOW()',
                            'userid' => intval($_POST['userid']));
						              
              $lastid = self::$db->insert("lembaga", $data);
              (self::$db->affected()) ? Filter::msgOk(lang('DATA_ADDED')) : Filter::msgAlert(lang('NOPROCCESS'));
			  			  
          } else
              print Filter::msgStatus();
      }
      
      /**
       * Content::getStaff()-------------------------------------------------------------------------------------------------------------
       * 
       * @return
       */
      public function getStaff()
      {	  
        if (isset($_GET['propinsi_kode']))
              $propinsi_kode = sanitize($_GET['propinsi_kode']);
        else
              $propinsi_kode = '';

        if (isset($_GET['kota_kode']))
              $kota_kode = sanitize($_GET['kota_kode']);
        else
              $kota_kode = '';

        if (isset($_GET['searchfield']))
              $searchfield = strtolower(sanitize($_GET['searchfield']));
        else
              $searchfield = '';
        
        if (isset($_GET['searchtext']))
              $searchtext = strtolower(sanitize($_GET['searchtext']));
        else
              $searchtext = '';
        
        if ($propinsi_kode != '') {
              if ($kota_kode != '') {
                      $q = "SELECT count(*) FROM staff AS s LEFT JOIN lembaga AS l ON s.lembagaid = l.id WHERE s.propinsi_kode = '" . $propinsi_kode . "' AND s.kota_kode = '" . $kota_kode . "'";
                      $sqlwhere = "WHERE s.propinsi_kode = '" . $propinsi_kode . "' AND s.kota_kode = '" . $kota_kode . "'";
                      
                    if (($searchtext != '') && ($searchfield != '')) {
                        $q .= " AND LOWER(" . $searchfield .") LIKE '%". $searchtext ."%'";
                        $sqlwhere .= " AND LOWER(" . $searchfield .") LIKE '%". $searchtext ."%'";
                    }
              } else {
                      $q = "SELECT count(*) FROM staff AS s LEFT JOIN lembaga AS l ON s.lembagaid = l.id WHERE s.propinsi_kode = '" . $propinsi_kode . "'";
                      $sqlwhere = "WHERE s.propinsi_kode = '" . $propinsi_kode . "'";
                      
                      if (($searchtext != '') && ($searchfield != '')) {
                          $q .= " AND LOWER(" . $searchfield .") LIKE '%". $searchtext ."%'";
                          $sqlwhere .= " AND LOWER(" . $searchfield .") LIKE '%". $searchtext ."%'";
                      }
              }
        } else {
              if ($kota_kode != '') {
                      $q = "SELECT count(*) FROM staff AS s LEFT JOIN lembaga AS l ON s.lembagaid = l.id WHERE s.kota_kode = '" . $kota_kode . "'";
                      $sqlwhere = "WHERE s.kota_kode = '" . $kota_kode . "'";
                      
                      if (($searchtext != '') && ($searchfield != '')) {
                          $q .= " AND LOWER(" . $searchfield .") LIKE '%". $searchtext ."%'";
                          $sqlwhere .= " AND LOWER(" . $searchfield .") LIKE '%". $searchtext ."%'";
                      }
              } else {
                      $q = "SELECT count(*) FROM staff AS s LEFT JOIN lembaga AS l ON s.lembagaid = l.id";

                      if (($searchtext != '') && ($searchfield != '')) {
                        $q .= " WHERE LOWER(" . $searchfield .") LIKE '%". $searchtext ."%'";
                        $sqlwhere = "WHERE LOWER(" . $searchfield .") LIKE '%". $searchtext ."%'";
                      } else
                        $sqlwhere = "";
              }
        }
        
        $record = Registry::get("Database")->query($q);
        $total = Registry::get("Database")->fetchrow($record);
        $counter = $total[0];

        $pager = Paginator::instance();
        $pager->items_total = $counter;
        $pager->default_ipp = Registry::get("Core")->perpage;
        $pager->paginate();

        if (isset($_GET['sortfield'])) {
            $sortfield = sanitize($_GET['sortfield']);
            if (isset($_GET['sorttype']))
                $sorttype = sanitize($_GET['sorttype']);
            else
                $sorttype = "ASC";

            if (in_array($sortfield, array("s.nama_lengkap", "s.nip", "l.nama_lembaga", 
                                           "p.nama_propinsi", "k.nama_kota"))) {
                $sort = ($sorttype == 'DESC') ? " DESC " : " ASC ";

                $sqlorder = "LOWER(" . $sortfield . ") " . $sort;
            } else
                $sqlorder = "LOWER(s.nama_lengkap)";
        } else
            $sqlorder = "LOWER(s.nama_lengkap)";
                
        $sql = "SELECT s.*, l.nama_lembaga," 
        . "\n p.nama_propinsi," 
        . "\n k.nama_kota" 
        . "\n FROM ((staff as s" 
        . "\n LEFT JOIN lembaga as l ON s.lembagaid = l.id)" 
        . "\n LEFT JOIN propinsi as p ON s.propinsi_kode = p.kode)" 
        . "\n LEFT JOIN kota as k ON s.kota_kode = k.kode" 
        . "\n $sqlwhere" 
        . "\n ORDER BY " . $sqlorder . $pager->limit;
           
        $row = self::$db->fetch_all($sql);

        return ($row) ? $row : 0;
	  
      }

     /**
       * Content::getStaffById()
       * 
       * @return
       */
      public function getStaffById($id)
      {
          $sql = "SELECT s.*," 
		  . "\n l.nama_lembaga" 
		  . "\n FROM staff as s LEFT JOIN lembaga as l" 
		  . "\n ON s.lembagaid=l.id" 
		  . "\n WHERE s.id = '" . $id . "'";

          $row = self::$db->first($sql);

          return ($row) ? $row : 0;
      }

      /**
       * Content::processUpdateStaff()
       * 
       * @return
       */
      public function processUpdateStaff()
      {
			  
          if (empty($_POST['nama_lengkap']))
              Filter::$msgs['nama_lengkap'] = 'Silahkan masukkan Nama Lengkap!';

          if (empty($_POST['lembagaid']))
              Filter::$msgs['lembagaid'] = 'Silahkan pilih Lembaga!';

          if (empty($_POST['nip']))
              Filter::$msgs['nip'] = 'Silahkan masukkan NIP!';

                    
            if (empty($_POST['tgl_lahir']))
                $tgl_lahir = null;
            else {
                $tgl_lahir = sanitize($_POST['tgl_lahir']);
                $tgl_lahir = setToSQLdate($tgl_lahir);
            }

            if (empty($_POST['tmt']))
                $tmt = null;
            else {
                $tmt = sanitize($_POST['tmt']);
                $tmt = setToSQLdate($tmt);
            }
            
            if (empty($_POST['tmtin']))
                $tmtin = null;
            else {
                $tmtin = sanitize($_POST['tmtin']);
                $tmtin = setToSQLdate($tmtin);
            }
            
          if (empty(Filter::$msgs)) {
              $data = array('nama_lengkap' => sanitize($_POST['nama_lengkap']), 
                            'lembagaid' => intval($_POST['lembagaid']), 

                            'gelar_depan1' => sanitize($_POST['gelar_depan1']), 	
                            'gelar_depan2' => sanitize($_POST['gelar_depan2']), 	
                            'gelar_depan3' => sanitize($_POST['gelar_depan3']), 	

                            'gelar_belakang1' => sanitize($_POST['gelar_belakang1']), 	
                            'gelar_belakang2' => sanitize($_POST['gelar_belakang2']), 	
                            'gelar_belakang3' => sanitize($_POST['gelar_belakang3']), 	

                            'nip' => sanitize($_POST['nip']),  
                            'nuptk' => sanitize($_POST['nuptk']), 
                            'tgl_lahir' => $tgl_lahir, 
                            'tmp_lahir' => sanitize($_POST['tmp_lahir']), 

                            'no_ktp' => sanitize($_POST['no_ktp']), 
                            'agama' => sanitize($_POST['agama']), 
                            'status_kawin' => sanitize($_POST['status_kawin']), 

                            'propinsi_kode' => sanitize($_POST['propinsi_kode']), 
                            'kota_kode' => sanitize($_POST['kota_kode']), 
                  
                            'alamat' => sanitize($_POST['alamat']), 
                            'kelurahan' => sanitize($_POST['kelurahan']), 
                            'kecamatan' => sanitize($_POST['kecamatan']), 
                            'kodepos' => sanitize($_POST['kodepos']), 
                            'telepon1' => sanitize($_POST['telepon1']), 
                            'telepon2' => sanitize($_POST['telepon2']), 
                            //'fax' => sanitize($_POST['fax']), 
                            'email' => sanitize($_POST['email']), 
                            //'web' => sanitize($_POST['web']), 

                            //'jabatan' => sanitize($_POST['jabatan']), 
                            //'instalasi' => sanitize($_POST['instalasi']),
                            
                            //'unitkerjaid' => intval($_POST['unitkerjaid']),
                            //'jml_anak' => intval($_POST['jml_anak']),
                            //'badan_berat' => intval($_POST['badan_berat']),
                            //'badan_tinggi' => intval($_POST['badan_tinggi']),

                            'golongan' => sanitize($_POST['golongan']), 

                  
                    /*	'pendidikan_akhir' => sanitize($_POST['pendidikan_akhir']), 
                            'ijazah' => sanitize($_POST['ijazah']), 

                            'jurusan' => sanitize($_POST['jurusan']), 
                            'tahun_lulus' => intval($_POST['tahun_lulus']), 
                     * 
                            'mulai_kerja' => sanitize($_POST['mulai_kerja']), 

                            'bidang_ahli' => sanitize($_POST['bidang_ahli']), 
                            'pangkat' => sanitize($_POST['pangkat']), 

                            'jab_intern' => sanitize($_POST['jab_intern']), 
                            'jenis' => sanitize($_POST['jenis']), */
                            'tmt' => $tmt, 
                            'tmtin' => $tmtin,                   

                            //'status' => sanitize($_POST['status']), 
                            'last_update' => 'NOW()',
                            'userid' => intval($_POST['userid']));
			  
              self::$db->update("staff", $data, "id='" . Filter::$id . "'");
              (self::$db->affected()) ? Filter::msgOk(lang('DATA_UPDATED')) : Filter::msgAlert(lang('NOPROCCESS'));

		  
          } else
              print Filter::msgStatus();
		  
      }

      /**
       * Content::processAddStaff()
       * 
       * @return
       */
      public function processAddStaff()
      {
          
          if (empty($_POST['nama_lengkap']))
              Filter::$msgs['nama_lengkap'] = 'Silahkan masukkan Nama Lengkap';

          if (empty($_POST['lembagaid']))
              Filter::$msgs['lembagaid'] = 'Silahkan pilih Lembaga';

          if (empty($_POST['nip']))
              Filter::$msgs['nip'] = 'Silahkan masukkan NIP';

            if (empty($_POST['tgl_lahir']))
                $tgl_lahir = null;
            else {
                $tgl_lahir = sanitize($_POST['tgl_lahir']);
                $tgl_lahir = setToSQLdate($tgl_lahir);
            }

            if (empty($_POST['tmt']))
                $tmt = null;
            else {
                $tmt = sanitize($_POST['tmt']);
                $tmt = setToSQLdate($tmt);
            }
            
            if (empty($_POST['tmtin']))
                $tmtin = null;
            else {
                $tmtin = sanitize($_POST['tmtin']);
                $tmtin = setToSQLdate($tmtin);
            }
          		  
          if (empty(Filter::$msgs)) {
			  
              $data = array('nama_lengkap' => sanitize($_POST['nama_lengkap']), 
                            'lembagaid' => intval($_POST['lembagaid']), 

                            'gelar_depan1' => sanitize($_POST['gelar_depan1']), 	
                            'gelar_depan2' => sanitize($_POST['gelar_depan2']), 	
                            'gelar_depan3' => sanitize($_POST['gelar_depan3']), 	

                            'gelar_belakang1' => sanitize($_POST['gelar_belakang1']), 	
                            'gelar_belakang2' => sanitize($_POST['gelar_belakang2']), 	
                            'gelar_belakang3' => sanitize($_POST['gelar_belakang3']), 	

                            'nip' => sanitize($_POST['nip']),  
                            'nuptk' => sanitize($_POST['nuptk']), 
                            'tgl_lahir' => $tgl_lahir, 
                            'tmp_lahir' => sanitize($_POST['tmp_lahir']), 

                            'no_ktp' => sanitize($_POST['no_ktp']), 
                            'agama' => sanitize($_POST['agama']), 
                            'status_kawin' => sanitize($_POST['status_kawin']), 

                            'propinsi_kode' => sanitize($_POST['propinsi_kode']), 
                            'kota_kode' => sanitize($_POST['kota_kode']), 
                  
                            'alamat' => sanitize($_POST['alamat']), 
                            'kelurahan' => sanitize($_POST['kelurahan']), 
                            'kecamatan' => sanitize($_POST['kecamatan']), 
                            'kodepos' => sanitize($_POST['kodepos']), 
                            'telepon1' => sanitize($_POST['telepon1']), 
                            'telepon2' => sanitize($_POST['telepon2']), 
                            //'fax' => sanitize($_POST['fax']), 
                            'email' => sanitize($_POST['email']), 
                            //'web' => sanitize($_POST['web']), 

                            //'jabatan' => sanitize($_POST['jabatan']), 
                            //'instalasi' => sanitize($_POST['instalasi']),
                            
                            //'unitkerjaid' => intval($_POST['unitkerjaid']),
                            //'jml_anak' => intval($_POST['jml_anak']),
                            //'badan_berat' => intval($_POST['badan_berat']),
                            //'badan_tinggi' => intval($_POST['badan_tinggi']),

                            'golongan' => sanitize($_POST['golongan']), 

                    /*	'pendidikan_akhir' => sanitize($_POST['pendidikan_akhir']), 
                            'ijazah' => sanitize($_POST['ijazah']), 

                            'jurusan' => sanitize($_POST['jurusan']), 
                            'tahun_lulus' => intval($_POST['tahun_lulus']), 
                     * 
                            'mulai_kerja' => sanitize($_POST['mulai_kerja']), 

                            'bidang_ahli' => sanitize($_POST['bidang_ahli']), 
                            'pangkat' => sanitize($_POST['pangkat']), 

                            'jab_intern' => sanitize($_POST['jab_intern']), 
                            'jenis' => sanitize($_POST['jenis']), */
                            'tmt' => $tmt, 
                            'tmtin' => $tmtin, 

                            'status' => 'A',  
                            'last_update' => 'NOW()',
                            'created' => "NOW()",
                            'userid' => intval($_POST['userid']));
				              
              $lastid = self::$db->insert("staff", $data);
              (self::$db->affected()) ? print 'OK_' . $lastid : Filter::msgAlert(lang('NOPROCCESS'));              
              
          } else
              print Filter::msgStatus();
      }
      
      /**
       * Content::getStaff_RPF()
       * 
       * @return
       */
      public function getStaff_RPF($staffid)
      {
          $sql = "SELECT rpf.*,"
                . "\n sj.nama_jenjang"
                . "\n FROM staff_rpf as rpf"
                . "\n LEFT JOIN sekolah_jenjang as sj ON rpf.jenjangid = sj.id" 
                . "\n WHERE rpf.staffid = " . $staffid;

          $row = self::$db->fetch_all($sql);

          return ($row) ? $row : 0;
      }

      /**
       * Content::getStaff_RPNF()
       * 
       * @return
       */
      public function getStaff_RPNF($staffid)
      {
          $sql = "SELECT *"
                . "\n FROM staff_rpnf"
                . "\n WHERE staffid = '" . $staffid . "'";

          $row = self::$db->fetch_all($sql);

          return ($row) ? $row : 0;
      }

      /**
       * Content::getStaff_RDiklat()
       * 
       * @return
       */
      public function getStaff_RDiklat($staffid)
      {
          $sql = "SELECT *"
                . "\n FROM staff_rdiklat"
                . "\n WHERE staffid = '" . $staffid . "'";

          $row = self::$db->fetch_all($sql);

          return ($row) ? $row : 0;
      }      
      
      /**
       * Content::getStaff_RJabatan()
       * 
       * @return
       */
      public function getStaff_RJabatan($staffid)
      {
          $sql = "SELECT *"
                . "\n FROM staff_rjabatan"
                . "\n WHERE staffid = '" . $staffid . "'";

          $row = self::$db->fetch_all($sql);

          return ($row) ? $row : 0;
      }      

      /**
       * Content::getStaff_RKarya()
       * 
       * @return
       */
      public function getStaff_RKarya($staffid)
      {
          $sql = "SELECT *"
                . "\n FROM staff_rkarya"
                . "\n WHERE staffid = '" . $staffid . "'";

          $row = self::$db->fetch_all($sql);

          return ($row) ? $row : 0;
      }      
      
      /**
       * Content::getStaff_RSertifikat()
       * 
       * @return
       */
      public function getStaff_RSertifikat($staffid)
      {
          $sql = "SELECT *"
                . "\n FROM staff_rsertifikat"
                . "\n WHERE staffid = '" . $staffid . "'";

          $row = self::$db->fetch_all($sql);

          return ($row) ? $row : 0;
      }            
      
      /**
       * Content::loadStaff_RPF() ---------------------------------------------
       * 
       * @param mixed $staffid
       * @return
       */
	  public function loadStaff_RPF($staffid)
	  {

		  $rpfrows = $this->getStaff_RPF($staffid);
		  print '
                    <table class="responsive table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th width="60">Jenjang</th>
                                <th>Nama Sekolah</th>
                                <th>lokasi</th>
                                <th>Jurusan</th>
                                <th width="60">Tahun</th>
                                <th width="40"><button type="button" class="btn" id="btnRPFadd" data-toggle="modal"><span class="icon16 icomoon-icon-plus-2"></span>Tambah</button></th>
                            </tr>
                        </thead>';

		  if (!$rpfrows) {
			  print '<tbody>
				<tr>
				  <td colspan="6">' . Filter::msgInfo(lang('NO_DATA'), false) . '</td>
				</tr>';
		  } else {
			  foreach ($rpfrows as $rpfrow) {
				  print '
					<tr>
					  <td style="text-align: left;">' . $rpfrow->nama_jenjang . '</td>
					  <td style="text-align: left;">' . $rpfrow->nama_sekolah . '</td>
					  <td style="text-align: left;">' . $rpfrow->lokasi . '</td>
					  <td style="text-align: left;">' . $rpfrow->jurusan . '</td>
					  <td>' . $rpfrow->tahun_lulus . '</td>
                                          <td align="center">
                                            <a href="javascript:void(0)" title="Edit" class="tip doEditrpf" data-tname="staff_rpf" data-id="'.$rpfrow->id.'" data-toggle="modal"><span class="icon12 icomoon-icon-pencil"></span></a>
                                            <a href="javascript:void(0)" title="Hapus" class="tip doDelete" data-tname="staff_rpf" data-id="' .$rpfrow->id.'" data-toggle="modal"><span class="icon12 icomoon-icon-remove"></span></a>
                                          </td>
					</tr>';
			  }
			  unset($rpfrow);
		  }
		  print '</tbody>
			</table>';
	  }

	  /**
	   * Content::processStaff_RPF()
	   * 
	   * @return
	   */
	  public function processStaff_RPF()
	  {
		  if (empty($_POST['staffid']))
			  Filter::$msgs['staffid'] = 'Staff belum dipilih!';

		  if (empty(Filter::$msgs)) {
                    $data = array(
                                'staffid' => intval($_POST['staffid']),
                                'jenjangid' => intval($_POST['jenjangid']),
                                'nama_sekolah' => sanitize($_POST['nama_sekolah']),
                                'lokasi' => sanitize($_POST['lokasi']),
                                'jurusan' => sanitize($_POST['jurusan']),
                                'tahun_lulus' => intval($_POST['tahun_lulus']),
                                'last_update' => 'NOW()',
                                'userid' => intval($_POST['userid']) );

                    if (!Filter::$id)
                        $data['created'] = "NOW()";											
                                                    
                    (Filter::$id) ? self::$db->update("staff_rpf", $data, "id='" . Filter::$id . "'") : self::$db->insert("staff_rpf", $data);
                    $message = (Filter::$id) ? lang('DATA_UPDATED') : lang('DATA_ADDED');
                    (self::$db->affected()) ? Filter::msgOk($message) : Filter::msgAlert(lang('NOPROCCESS'));

		  } else
			  print Filter::msgStatus();
	  }
          
      /**
       * Content::loadStaff_RPNF() ---------------------------------------------
       * 
       * @param mixed $staffid
       * @return
       */
	  public function loadStaff_RPNF($staffid)
	  {

		  $rpnfrows = $this->getStaff_RPNF($staffid);
		  print '
                    <table class="responsive table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Nama Pendidikan</th>
                                <th>Pelaksana</th>
                                <th>Lokasi</th>
                                <th width="70">Tahun</th>
                                <th width="30">Jml Jam</th>
                                <th width="40"><button type="button" class="btn" id="btnRPNFadd" data-toggle="modal"><span class="icon16 icomoon-icon-plus-2"></span>Tambah</button></th>
                            </tr>
                        </thead>';

		  if (!$rpnfrows) {
			  print '<tbody>
				<tr>
				  <td colspan="6">' . Filter::msgInfo(lang('NO_DATA'), false) . '</td>
				</tr>';
		  } else {
			  foreach ($rpnfrows as $rpnfrow) {
				  print '
					<tr>
					  <td style="text-align: left;">' . $rpnfrow->nama_pendidikan . '</td>
					  <td style="text-align: left;">' . $rpnfrow->pelaksana . '</td>
					  <td style="text-align: left;">' . $rpnfrow->lokasi . '</td>
					  <td>' . $rpnfrow->tahun . '</td>
					  <td>' . $rpnfrow->jml_jam . '</td>
                                          <td align="center">
                                            <a href="javascript:void(0)" title="Edit" class="tip doEditrpnf" data-tname="staff_rpnf" data-id="'.$rpnfrow->id.'" data-toggle="modal"><span class="icon12 icomoon-icon-pencil"></span></a>
                                            <a href="javascript:void(0)" title="Hapus" class="tip doDelete" data-tname="staff_rpnf" data-id="'.$rpnfrow->id.'" data-toggle="modal"><span class="icon12 icomoon-icon-remove"></span></a>
                                          </td>
					</tr>';
			  }
			  unset($rpnfrow);
		  }
		  print '</tbody>
			</table>';
	  }

	  /**
	   * Content::processStaff_RPNF()
	   * 
	   * @return
	   */
	  public function processStaff_RPNF()
	  {
		  if (empty($_POST['staffid']))
			  Filter::$msgs['staffid'] = 'Staff belum dipilih!';

		  if (empty(Filter::$msgs)) {
                    $data = array(
                                'staffid' => intval($_POST['staffid']),
                                'nama_pendidikan' => sanitize($_POST['nama_pendidikan']),
                                'pelaksana' => sanitize($_POST['pelaksana']),
                                'lokasi' => sanitize($_POST['lokasi']),
                                'tahun' => intval($_POST['tahun']),
                                'jml_jam' => intval($_POST['jml_jam']),
                                'last_update' => 'NOW()',
                                'userid' => intval($_POST['userid']) );

                    if (!Filter::$id)
                        $data['created'] = "NOW()";											
                                                    
                    (Filter::$id) ? self::$db->update("staff_rpnf", $data, "id='" . Filter::$id . "'") : self::$db->insert("staff_rpnf", $data);
                    $message = (Filter::$id) ? lang('DATA_UPDATED') : lang('DATA_ADDED');
                    (self::$db->affected()) ? Filter::msgOk($message) : Filter::msgAlert(lang('NOPROCCESS'));

		  } else
			  print Filter::msgStatus();
	  }

      /**
       * Content::loadStaff_RDiklat() ---------------------------------------------
       * 
       * @param mixed $staffid
       * @return
       */
	  public function loadStaff_RDiklat($staffid)
	  {

		  $rdiklatrows = $this->getStaff_RDiklat($staffid);
		  print '
                    <table class="responsive table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th width="60">Tingkat</th>
                                <th>Nama Diklat</th>
                                <th>Tempat</th>
                                <th width="50">Status</th>
                                <th width="60">Tahun</th>
                                <th width="40"><button type="button" class="btn" id="btnRDiklatadd" data-toggle="modal"><span class="icon16 icomoon-icon-plus-2"></span>Tambah</button></th>
                            </tr>
                        </thead>';

		  if (!$rdiklatrows) {
			  print '<tbody>
				<tr>
				  <td colspan="6">' . Filter::msgInfo(lang('NO_DATA'), false) . '</td>
				</tr>';
		  } else {
			  foreach ($rdiklatrows as $rdiklatrow) {
				  print '
					<tr>
					  <td style="text-align: left;">' . $rdiklatrow->tingkat . '</td>
					  <td style="text-align: left;">' . $rdiklatrow->nama_diklat . '</td>
					  <td style="text-align: left;">' . $rdiklatrow->tempat . '</td>
					  <td>' . $rdiklatrow->sttpl . '</td>
					  <td>' . $rdiklatrow->tahun . '</td>
                                          <td align="center">
                                            <a href="javascript:void(0)" title="Edit" class="tip doEditrdiklat" data-tname="staff_rdiklat" data-id="'.$rdiklatrow->id.'" data-toggle="modal"><span class="icon12 icomoon-icon-pencil"></span></a>
                                            <a href="javascript:void(0)" title="Hapus" class="tip doDelete" data-tname="staff_rdiklat" data-id="'.$rdiklatrow->id.'" data-toggle="modal"><span class="icon12 icomoon-icon-remove"></span></a>
                                          </td>
					</tr>';
			  }
			  unset($rdiklatrow);
		  }
		  print '</tbody>
			</table>';
	  }

	  /**
	   * Content::processStaff_RDiklat()
	   * 
	   * @return
	   */
	  public function processStaff_RDiklat()
	  {
		  if (empty($_POST['staffid']))
			  Filter::$msgs['staffid'] = 'Staff belum dipilih!';

		  if (empty(Filter::$msgs)) {
                    $data = array(
                                'staffid' => intval($_POST['staffid']),
                                'tingkat' => sanitize($_POST['tingkat']),
                                'nama_diklat' => sanitize($_POST['nama_diklat']),
                                'tempat' => sanitize($_POST['tempat']),
                                'sttpl' => sanitize($_POST['sttpl']),
                                'tahun' => intval($_POST['tahun']),
                                'last_update' => 'NOW()',
                                'userid' => intval($_POST['userid']) );

                    if (!Filter::$id)
                        $data['created'] = "NOW()";											
                                                    
                    (Filter::$id) ? self::$db->update("staff_rdiklat", $data, "id='" . Filter::$id . "'") : self::$db->insert("staff_rdiklat", $data);
                    $message = (Filter::$id) ? lang('DATA_UPDATED') : lang('DATA_ADDED');
                    (self::$db->affected()) ? Filter::msgOk($message) : Filter::msgAlert(lang('NOPROCCESS'));

		  } else
			  print Filter::msgStatus();
	  }
          
      /**
       * Content::loadStaff_RJabatan() ---------------------------------------------
       * 
       * @param mixed $staffid
       * @return
       */
	  public function loadStaff_RJabatan($staffid)
	  {

		  $rjabatanrows = $this->getStaff_RJabatan($staffid);
		  print '
                    <table class="responsive table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Jenis</th>
                                <th>Jabatan</th>
                                <th>Lembaga</th>
                                <th width="70">Tahun</th>
                                <th>Tempat Tugas</th>
                                <th width="40"><button type="button" class="btn" id="btnRJabatanadd" data-toggle="modal"><span class="icon16 icomoon-icon-plus-2"></span>Tambah</button></th>
                            </tr>
                        </thead>';

		  if (!$rjabatanrows) {
			  print '<tbody>
				<tr>
				  <td colspan="6">' . Filter::msgInfo(lang('NO_DATA'), false) . '</td>
				</tr>';
		  } else {
			  foreach ($rjabatanrows as $rjabatanrow) {
				  print '
					<tr>
					  <td style="text-align: left;">' . $rjabatanrow->jenis . '</td>
					  <td style="text-align: left;">' . $rjabatanrow->jabatan . '</td>
					  <td style="text-align: left;">' . $rjabatanrow->lembaga . '</td>
					  <td>' . $rjabatanrow->tahun . '</td>
					  <td>' . $rjabatanrow->tmp_tugas . '</td>
                                          <td align="center">
                                            <a href="javascript:void(0)" title="Edit" class="tip doEditrjabatan" data-tname="staff_rjabatan" data-id="'.$rjabatanrow->id.'" data-toggle="modal"><span class="icon12 icomoon-icon-pencil"></span></a>
                                            <a href="javascript:void(0)" title="Hapus" class="tip doDelete" data-tname="staff_rjabatan" data-id="'.$rjabatanrow->id.'" data-toggle="modal"><span class="icon12 icomoon-icon-remove"></span></a>
                                          </td>
					</tr>';
			  }
			  unset($rjabatanrow);
		  }
		  print '</tbody>
			</table>';
	  }

	  /**
	   * Content::processStaff_RJabatan()
	   * 
	   * @return
	   */
	  public function processStaff_RJabatan()
	  {
		  if (empty($_POST['staffid']))
			  Filter::$msgs['staffid'] = 'Staff belum dipilih!';

                  if (empty($_POST['tmt']))
                        $tmt = null;
                  else {
                        $tmt = sanitize($_POST['tmt']);
                        $tmt = setToSQLdate($tmt);
                   }
                   
                  if (empty($_POST['akhir_tmt']))
                        $akhir_tmt = null;
                  else {
                        $akhir_tmt = sanitize($_POST['akhir_tmt']);
                        $akhir_tmt = setToSQLdate($akhir_tmt);
                   }
                   
		  if (empty(Filter::$msgs)) {
                    $data = array(
                                'staffid' => intval($_POST['staffid']),
                                'jenis' => sanitize($_POST['jenis']),
                                'jabatan' => sanitize($_POST['jabatan']),
                                'lembaga' => sanitize($_POST['lembaga']),
                                'no_sk' => sanitize($_POST['no_sk']),
                                'tahun' => intval($_POST['tahun']),
                                'tmp_tugas' => sanitize($_POST['tmp_tugas']),
                                'tmt' => $tmt,
                                'akhir_tmt' => $akhir_tmt,
                                'last_update' => 'NOW()',
                                'userid' => intval($_POST['userid']) );

                    if (!Filter::$id)
                        $data['created'] = "NOW()";											
                                                    
                    (Filter::$id) ? self::$db->update("staff_rjabatan", $data, "id='" . Filter::$id . "'") : self::$db->insert("staff_rjabatan", $data);
                    $message = (Filter::$id) ? lang('DATA_UPDATED') : lang('DATA_ADDED');
                    (self::$db->affected()) ? Filter::msgOk($message) : Filter::msgAlert(lang('NOPROCCESS'));

		  } else
			  print Filter::msgStatus();
	  }
          
      /**
       * Content::loadStaff_RKarya() ---------------------------------------------
       * 
       * @param mixed $staffid
       * @return
       */
	  public function loadStaff_RKarya($staffid)
	  {

		  $rkaryarows = $this->getStaff_RKarya($staffid);
		  print '
                    <table class="responsive table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th width="60">NSS</th>
                                <th width="60">NIP</th>
                                <th>Nama Karya</th>
                                <th width="60">Tahun</th>
                                <th>Keterangan</th>
                                <th width="40"><button type="button" class="btn" id="btnRKaryaadd" data-toggle="modal"><span class="icon16 icomoon-icon-plus-2"></span>Tambah</button></th>
                            </tr>
                        </thead>';

		  if (!$rkaryarows) {
			  print '<tbody>
				<tr>
				  <td colspan="6">' . Filter::msgInfo(lang('NO_DATA'), false) . '</td>
				</tr>';
		  } else {
			  foreach ($rkaryarows as $rkaryarow) {
				  print '
					<tr>
					  <td>' . $rkaryarow->nss . '</td>
					  <td>' . $rkaryarow->nip . '</td>
					  <td style="text-align: left;">' . $rkaryarow->nama_karya . '</td>
					  <td>' . $rkaryarow->tahun . '</td>
					  <td style="text-align: left;">' . $rkaryarow->keterangan . '</td>
                                          <td align="center">
                                            <a href="javascript:void(0)" title="Edit" class="tip doEditrkarya" data-tname="staff_rkarya" data-id="'.$rkaryarow->id.'" data-toggle="modal"><span class="icon12 icomoon-icon-pencil"></span></a>
                                            <a href="javascript:void(0)" title="Hapus" class="tip doDelete" data-tname="staff_rkarya" data-id="'.$rkaryarow->id.'" data-toggle="modal"><span class="icon12 icomoon-icon-remove"></span></a>
                                          </td>
					</tr>';
			  }
			  unset($rkaryarow);
		  }
		  print '</tbody>
			</table>';
	  }

	  /**
	   * Content::processStaff_RKarya()
	   * 
	   * @return
	   */
	  public function processStaff_RKarya()
	  {
		  if (empty($_POST['staffid']))
			  Filter::$msgs['staffid'] = 'Staff belum dipilih!';

		  if (empty(Filter::$msgs)) {
                    $data = array(
                                'staffid' => intval($_POST['staffid']),
                                'nss' => sanitize($_POST['nss']),
                                'nip' => sanitize($_POST['nip']),
                                'nama_karya' => sanitize($_POST['nama_karya']),
                                'tahun' => intval($_POST['tahun']),
                                'keterangan' => sanitize($_POST['keterangan']),
                                'last_update' => 'NOW()',
                                'userid' => intval($_POST['userid']) );

                    if (!Filter::$id)
                        $data['created'] = "NOW()";											
                                                    
                    (Filter::$id) ? self::$db->update("staff_rkarya", $data, "id='" . Filter::$id . "'") : self::$db->insert("staff_rkarya", $data);
                    $message = (Filter::$id) ? lang('DATA_UPDATED') : lang('DATA_ADDED');
                    (self::$db->affected()) ? Filter::msgOk($message) : Filter::msgAlert(lang('NOPROCCESS'));

		  } else
			  print Filter::msgStatus();
	  }
                    
      /**
       * Content::loadStaff_RSertifikat() ---------------------------------------------
       * 
       * @param mixed $staffid
       * @return
       */
	  public function loadStaff_RSertifikat($staffid)
	  {

		  $rsertifikatrows = $this->getStaff_RSertifikat($staffid);
		  print '
                    <table class="responsive table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>NSS</th>
                                <th>NIP</th>
                                <th>Nama Sertifikat</th>
                                <th>Pelaksana</th>
                                <th width="30">Status</th>
                                <th width="70">Tahun</th>
                                <th width="40"><button type="button" class="btn" id="btnRSertifikatadd" data-toggle="modal"><span class="icon16 icomoon-icon-plus-2"></span>Tambah</button></th>
                            </tr>
                        </thead>';

		  if (!$rsertifikatrows) {
			  print '<tbody>
				<tr>
				  <td colspan="7">' . Filter::msgInfo(lang('NO_DATA'), false) . '</td>
				</tr>';
		  } else {
			  foreach ($rsertifikatrows as $rsertifikatrow) {
				  print '
					<tr>
					  <td style="text-align: left;">' . $rsertifikatrow->nss . '</td>
					  <td style="text-align: left;">' . $rsertifikatrow->nip . '</td>
					  <td style="text-align: left;">' . $rsertifikatrow->nama_sertifikat . '</td>
					  <td style="text-align: left;">' . $rsertifikatrow->pelaksana . '</td>
					  <td>' . $rsertifikatrow->status . '</td>
					  <td>' . $rsertifikatrow->tahun . '</td>
                                          <td align="center">
                                            <a href="javascript:void(0)" title="Edit" class="tip doEditrsertifikat" data-tname="staff_rsertifikat" data-id="'.$rsertifikatrow->id.'" data-toggle="modal"><span class="icon12 icomoon-icon-pencil"></span></a>
                                            <a href="javascript:void(0)" title="Hapus" class="tip doDelete" data-tname="staff_rsertifikat" data-id="'.$rsertifikatrow->id.'" data-toggle="modal"><span class="icon12 icomoon-icon-remove"></span></a>
                                          </td>
					</tr>';
			  }
			  unset($rsertifikatrow);
		  }
		  print '</tbody>
			</table>';
	  }

	  /**
	   * Content::processStaff_RSertifikat()
	   * 
	   * @return
	   */
	  public function processStaff_RSertifikat()
	  {
		  if (empty($_POST['staffid']))
			  Filter::$msgs['staffid'] = 'Staff belum dipilih!';

		  if (empty(Filter::$msgs)) {
                    $data = array(
                                'staffid' => intval($_POST['staffid']),
                                'nss' => sanitize($_POST['nss']),
                                'nip' => sanitize($_POST['nip']),
                                'nama_sertifikat' => sanitize($_POST['nama_sertifikat']),
                                'pelaksana' => sanitize($_POST['pelaksana']),
                                'status' => sanitize($_POST['status']),
                                'tahun' => intval($_POST['tahun']),
                                'last_update' => 'NOW()',
                                'userid' => intval($_POST['userid']) );

                    if (!Filter::$id)
                        $data['created'] = "NOW()";											
                                                    
                    (Filter::$id) ? self::$db->update("staff_rsertifikat", $data, "id='" . Filter::$id . "'") : self::$db->insert("staff_rsertifikat", $data);
                    $message = (Filter::$id) ? lang('DATA_UPDATED') : lang('DATA_ADDED');
                    (self::$db->affected()) ? Filter::msgOk($message) : Filter::msgAlert(lang('NOPROCCESS'));

		  } else
			  print Filter::msgStatus();
	  }
      
      
      
      /**
       * Content::getPTKcreated_year()
       * 
       * @return count
       */
      public function getPTKcreated_year($year, $jenis)
      {
          
          if ($jenis == 'created') {
                $dfrom = mktime(0, 0, 0, 1, 1,  $year);
                $dto = mktime(23, 59, 59, 12, 31,  $year);

                $sql = "SELECT count(*) AS count"
                        . "\n FROM ptk"
                        . "\n WHERE (created >= '" . date('Y-m-d H:i:s', $dfrom) . "' AND created <= '" . date('Y-m-d H:i:s', $dto) ."')";
          } else {
                $dto = mktime(23, 59, 59, 12, 31,  $year);

                $sql = "SELECT count(*) AS count"
                        . "\n FROM ptk"
                        . "\n WHERE (created <= '" . date('Y-m-d H:i:s', $dto) . "')";
          }            
          $row = self::$db->first($sql);
          
          if ($row)
            return $row->count;
          else
            return 0;
      }
      
      /**
       * Content::getSekolahcreated_year()
       * 
       * @return count
       */
      public function getSekolahcreated_year($year, $jenis)
      {
          
          if ($jenis == 'created') {
                $dfrom = mktime(0, 0, 0, 1, 1,  $year);
                $dto = mktime(23, 59, 59, 12, 31,  $year);

                $sql = "SELECT count(*) AS count"
                      . "\n FROM sekolah"
                      . "\n WHERE (created >= '" . date('Y-m-d H:i:s', $dfrom) . "' AND created <= '" . date('Y-m-d H:i:s', $dto) ."')";
          } else {
                $dto = mktime(23, 59, 59, 12, 31,  $year);

                $sql = "SELECT count(*) AS count"
                      . "\n FROM sekolah"
                      . "\n WHERE (created <= '" . date('Y-m-d H:i:s', $dto) . "')";              
          }
          $row = self::$db->first($sql);
          
          if ($row)
            return $row->count;
          else
            return 0;
      }

      /**
       * Content::getDiklat_Peserta_year()
       * 
       * @return count
       */
      public function getDiklat_Peserta_year($year, $jenis)
      {
                              
          if ($jenis == 'created')
                $sql = "SELECT count(*) AS count"
                      . "\n FROM diklat_peserta AS dp"
                      . "\n LEFT JOIN diklat_jadwal AS dj ON dp.jadwalid = dj.id"
                      . "\n WHERE dj.tahun = '" . $year . "'";
          else
                $sql = "SELECT count(*) AS count"
                      . "\n FROM diklat_peserta AS dp"
                      . "\n LEFT JOIN diklat_jadwal AS dj ON dp.jadwalid = dj.id"
                      . "\n WHERE dj.tahun <= '" . $year . "'";
          $row = self::$db->first($sql);
          
          if ($row)
            return $row->count;
          else
            return 0;
      }
      
      /**
       * Content::getPTKijazah_Array()
       * 
       * @return count
       */
    public function getPTKijazah_Array($propinsi_kode = '', $kota_kode = '')
    {
          
            if ($propinsi_kode != '')
              $sqlwhere = "WHERE propinsi_kode = '" . $propinsi_kode . "'";
            else
              $sqlwhere = "";

            if ($kota_kode != '') {
                if ($sqlwhere != "")
                    $sqlwhere = $sqlwhere . " AND kota_kode = '" . $kota_kode . "'";
                else
                    $sqlwhere = "WHERE kota_kode = '" . $kota_kode . "'";            
            }

            $sql = "SELECT ijazah_akhir"
                    . "\n FROM ptk"
                    . "\n $sqlwhere ORDER BY ijazah_akhir";

            $row = self::$db->fetch_all($sql);

            return ($row) ? $row : 0;
            
    }
                  
      /**
       * Content::getDiklat_Peserta_YearPeriod()
       * 
       * @return count
       */
    public function getDiklat_Peserta_YearPeriod($yearfrom, $yearto)
    {
          
            $sqlwhere = "WHERE (dj.tahun >= '" . $yearfrom . "' AND dj.tahun <= '" . $yearto . "')";

            $sql = "SELECT dp.id, dj.tahun"
                    . "\n FROM diklat_peserta AS dp"
                    . "\n LEFT JOIN diklat_jadwal AS dj ON dp.jadwalid = dj.id"
                    . "\n $sqlwhere ORDER BY dj.tahun";

            $row = self::$db->fetch_all($sql);

            return ($row) ? $row : 0;
            
    }

      /**
       * Content::getDiklat_CalonPeserta_YearPeriod()
       * 
       * @return count
       */
    public function getDiklat_CalonPeserta_YearPeriod($yearfrom, $yearto)
    {
          
            $sqlwhere = "WHERE (dj.tahun >= '" . $yearfrom . "' AND dj.tahun <= '" . $yearto . "')";

            $sql = "SELECT da.id, dj.tahun"
                    . "\n FROM diklat_calonpeserta AS da"
                    . "\n LEFT JOIN diklat_jadwal AS dj ON da.jadwalid = dj.id"
                    . "\n $sqlwhere ORDER BY dj.tahun";

            $row = self::$db->fetch_all($sql);

            return ($row) ? $row : 0;
            
    }
   
    // -- dashboard stats --

    public function getPTKRegistedThisMonth()
    {

      $datefrom = date("Y-m-")."1";
      $dateto = date("Y-m-t");
      $q = "SELECT COUNT(*) FROM ptk WHERE (DATE(created) >= '". $datefrom . "' AND DATE(created) <= '" . $dateto . "')";      
      $record = self::$db->query($q);
      $total = self::$db->fetchrow($record);
      return $total[0];
    }

    public function getPTK_TNAThisMonth()
    {

      $datefrom = date("Y-m-")."1";
      $dateto = date("Y-m-t");
      $q = "SELECT COUNT(*) FROM ptk_tna WHERE (DATE(last_update) >= '". $datefrom . "' AND DATE(last_update) <= '" . $dateto . "')";      
      $record = self::$db->query($q);
      $total = self::$db->fetchrow($record);
      return $total[0];
    }

    public function getPTKRegistedDailyMonth()
    {

      $datefrom = date("Y-m-")."1";
      $dateto = date("Y-m-t");
      $days = (int)date("t");
      $daycounts = array();
      $daycounts = array_fill(1, $days, 0);

      $sql = "SELECT DATE_FORMAT(created, '%d') AS cday FROM ptk WHERE (DATE(created) >= '". $datefrom . "' AND DATE(created) <= '" . $dateto . "') ORDER BY created";
      $rows = self::$db->fetch_all($sql);
      foreach ($rows as $row) {
        $day = (int)$row->cday;
        $daycounts[$day]++;
      }      
      unset($row);

      $str = "[";
      for ($i = 1; $i <= $days; $i++) {
        $str .= "[" . $i . "," . $daycounts[$i] . "],";
      }
      $str .= "]";

      return $str;
    }

    public function getPTK_TNADailyMonth()
    {

      $datefrom = date("Y-m-")."1";
      $dateto = date("Y-m-t");
      $days = (int)date("t");
      $daycounts = array();
      $daycounts = array_fill(1, $days, 0);

      $sql = "SELECT DATE_FORMAT(last_update, '%d') AS cday FROM ptk_tna WHERE (DATE(last_update) >= '". $datefrom . "' AND DATE(last_update) <= '" . $dateto . "') ORDER BY created";
      $rows = self::$db->fetch_all($sql);
      foreach ($rows as $row) {
        $day = (int)$row->cday;
        $daycounts[$day]++;
      }      
      unset($row);

      $str = "[";
      for ($i = 1; $i <= $days; $i++) {
        $str .= "[" . $i . "," . $daycounts[$i] . "],";
      }
      $str .= "]";

      return $str;
    }

    public function getKKInfo($id)
    {
      $row = self::$db->first("SELECT * FROM kk WHERE id = " . $id);
      return ($row) ? $row : 0;
    }

    public function getMataPelajaranInfo($id)
    {
      $row = self::$db->first("SELECT * FROM matapelajaran WHERE id = " . $id);
      return ($row) ? $row : 0;
    }

    public function getPTK_TNAInfo($id)
    {
      $row = self::$db->first("SELECT * FROM ptk_tna WHERE id = " . $id);
      return ($row) ? $row : 0;
    }    
  }
?>