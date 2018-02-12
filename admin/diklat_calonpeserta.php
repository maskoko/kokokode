<?php
  /**
   * Main
   *
   * @package SIM PPPPTK BMTI
   * @author a2ngsa
   * @copyright 2012
   * @version $Id: diklat_calonpeserta.php (admin), v1.00 2011-06-05 10:12:05 gewa Exp $
   */
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
	  
  
?>

        <!--Body content-->
        <div id="content" class="clearfix">
            <div class="contentwrapper"><!--Content wrapper-->

                <div class="heading">
                    <h3>Calon Peserta Diklat</h3>                    
                </div><!-- End .heading-->
    				
                <!-- Build page from here: Usual with <div class="row-fluid"></div> -->

                <div class="row-fluid">
                    <div class="span12">

<?php switch(Filter::$action): case "add": ?>

	<?php include ("diklat_calonpeserta_add.php"); ?>

<?php break; ?>

<?php case "ganti": ?>

	<?php include ("diklat_calonpeserta_ganti.php"); ?>

<?php break; ?>
                        
    <!------------------------ list ----------------------------------------------->	
    
<?php default: ?>

	<?php 
        
            if(isset(Filter::$get['jadwalid']))
                $jadwalid = Filter::$get['jadwalid'];
            else
                $jadwalid = 0;

            if(isset(Filter::$get['status']))
                $status = Filter::$get['status'];
            else
                $status = 'P';
                        
            if(isset(Filter::$get['searchfield']))
                $searchfield = Filter::$get['searchfield'];
            else
                $searchfield = 'nama';

            if(isset(Filter::$get['searchtext']))
                $searchtext = Filter::$get['searchtext'];
            else
                $searchtext = '';
                              
            if(isset(Filter::$get['sortfield']))
                $sortfield = Filter::$get['sortfield'];
            else
                $sortfield = 'da.tgl_ajuan';

            if(isset(Filter::$get['sorttype']))
                $sorttype = Filter::$get['sorttype'];
            else
                $sorttype = 'DESC';
                                                
            if(isset($_COOKIE['jadwal_tgl_dari']))
                $jadwal_tgl_dari = $_COOKIE['jadwal_tgl_dari'];
            else {
                $year = date('Y');
                $tgl_dari = mktime(0, 0, 0, 1, 1,  $year - 2);
                $jadwal_tgl_dari = date('d/m/Y', $tgl_dari);                    
            }

            if(isset($_COOKIE['jadwal_tgl_sampai'])) { 
                $jadwal_tgl_sampai = $_COOKIE['jadwal_tgl_sampai'];
            } else {                                        
                if(isset($_COOKIE['jadwal_tgl_dari'])) { 
                    $jadwal_tgl_sampai = $_COOKIE['jadwal_tgl_dari'];
                } else {
                    $year = date('Y');
                    $tgl_sampai = mktime(0, 0, 0, 12, 31,  $year);
                    $jadwal_tgl_sampai = date('d/m/Y', $tgl_sampai);
                }
            }
                          
            $pg = (isset($_GET['pg']) and !empty($_GET['pg'])) ? intval(sanitize($_GET['pg'])) : 1;
                                    
	?>
		
                        <?php $rows = $content->getDiklat_CalonPeserta($jadwalid, $status);?>

                        <div class="box">

                            <div class="title">
                                <h4>
                                    <span>Filter: (<?php echo $jadwal_tgl_dari . ' s.d ' . $jadwal_tgl_sampai; ?>)</span>
                                </h4>
                                <a href="#" class="minimize">Minimize</a>
                            </div>
                            
                            <div class="content">
                                <form id="filter_form" class="form form-horizontal" method="get" action="">
                                <fieldset>
                                    <input type="hidden" name="do" value="diklat_calonpeserta">
                                    
                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">
                                                <label class="form-label span2" for="checkboxes">Jadwal Diklat:</label>
                                                <div class="span6 controls">
                                                    <?php 
                                                        
                                                        $jadwal_tgl_dari = setToSQLdate($jadwal_tgl_dari);
                                                        $jadwal_tgl_sampai = setToSQLdate($jadwal_tgl_sampai);
                                                        $jadwal = $content->getDiklat_JadwalList($jadwal_tgl_dari, $jadwal_tgl_sampai);
                                                        
                                                    ?>
                                                    <select name="jadwalid" style="width:100%;" placeholder="Select...">
                                                        <option value="0"><?php echo lang('SELECT_ALL');?></option>
                                                        <?php if ($jadwal):?>
                                                            <?php foreach ($jadwal as $prow):?>
                                                                <option value="<?php echo $prow->id;?>" <?php if($prow->id == $jadwalid)echo 'selected="selected"';?>><?php echo $prow->nama_diklat;?></option>
                                                            <?php endforeach;?>
                                                            <?php unset($prow);?>
                                                        <?php endif;?>						
                                                    </select>														
                                                </div>
                                                
                                                <label class="form-label span2" for="checkboxes">Status:</label>
                                                <div class="span2 controls">
                                                    <select name="status" id="status">
                                                        <option value="P" <?php if($status == "P")echo 'selected="selected"';?>>Peserta</option>
                                                        <option value="C" <?php if($status == "C")echo 'selected="selected"';?>>Cadangan</option>
                                                    </select>
                                                </div>
                                                
                                            </div>  <!-- end .row-fluid --> 
                                            
                                        </div>
                                    </div> <!-- end .form-row row-fluid --> 
                                    
                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">
                                                <label class="form-label span2" for="searchfield">Search:</label>
                                                <div class="span2 controls">
                                                    <select name="searchfield" id="searchfield" placeholder="Select..." style="width: 100%;">
                                                        <option value="da.nama_lengkap" <?php if($searchfield == 'da.nama_lengkap') echo 'selected="selected"';?>>Nama</option>
                                                        <option value="da.nip" <?php if($searchfield == 'da.nip') echo 'selected="selected"';?>>NIP</option>
                                                        <option value="da.nuptk" <?php if($searchfield == 'da.nuptk') echo 'selected="selected"';?>>NUPTK</option>
                                                        <option value="s.nama_sekolah" <?php if($searchfield == 's.nama_sekolah') echo 'selected="selected"';?>>Nama Sekolah</option>
                                                    </select>
                                                </div>
                                                <label class="form-label span2" for="searchtext">Text:</label>
                                                <input class="span4" type="text" name="searchtext" id="searchtext" value="<?php echo $searchtext; ?>" maxlength="50">
                                                <button type="submit" class="btn btn-info">Cari</button>
                                            </div> <!-- end .row-fluid -->                                            
                                        </div>
                                    </div> <!-- end .form-row row-fluid -->
                                                                        
                                    <input type="hidden" name="sortfield" id="sortfield" value="<?php echo $sortfield; ?>" >
                                    <input type="hidden" name="sorttype" id="sorttype" value="<?php echo $sorttype; ?>" >                                
                                </fieldset>
                                </form>								
                            </div>
                        </div><!-- End filter .box -->

                    </div><!-- End .span12 -->
                </div><!-- End .row-fluid -->  
                        
                <div class="row-fluid">
                    <div class="span12">
                                                    
                        <div class="box">

                            <div class="title">                                
                                <h4 class="clearfix">
                                    <span class="left icon16 icomoon-icon-graduation"></span>
                                    <span class="left">Peserta Diklat</span>
                                    
                                    <?php if ($jadwalid != 0):?>                                    
                                        <form class="box-form right" action="">
                                            <div class="btn-group">
                                                <a class="btn btn-mini" href="#"> Tambah</a>
                                                <a class="btn btn-mini dropdown-toggle" data-toggle="dropdown" href="#">
                                                    <span class="icon16 icomoon-icon-plus-2"></span>
                                                    <span class="caret"></span>
                                                </a>
                                                <ul class="dropdown-menu">
                                                    <li><a href="index.php?do=diklat_calonpeserta&amp;action=add&amp;jadwalid=<?php echo $jadwalid; ?>&amp;status=<?php echo $status; ?>&amp;jenis=P"><span class="icon16 icomoon-icon-user-4"></span> PTK</a></li>
                                                    <li><a href="index.php?do=diklat_calonpeserta&amp;action=add&amp;jadwalid=<?php echo $jadwalid; ?>&amp;status=<?php echo $status; ?>&amp;jenis=S"><span class="icon16 icomoon-icon-user-2"></span> Staff</a></li>
                                                </ul>
                                            </div>
                                        </form>
                                    <?php endif;?>

                                </h4>
                            </div>
                            
                            <div class="content">
                                          
                                <div id="msgholder"></div>                                
                                
                                <table class="responsive table table-striped table-bordered table-sorting table-condensed">
                                    <thead>
                                        <tr>
                                            <th width="70">NUPTK</th>
                                            <th id="da.nama_lengkap" <?php
                                                if ($sortfield == "da.nama_lengkap") { 
                                                    if ($sorttype == "ASC") 
                                                        echo 'class="sorting_asc"'; 
                                                    elseif ($sorttype == "DESC") 
                                                        echo 'class="sorting_desc"'; 
                                                    else 
                                                        echo 'class="sorting"'; 
                                                } else 
                                                    echo 'class="sorting"'; ?>>Nama Lengkap</th>
                                            <th id="da.nama_sekolah" <?php
                                                if ($sortfield == "da.nama_sekolah") { 
                                                    if ($sorttype == "ASC") 
                                                        echo 'class="sorting_asc"'; 
                                                    elseif ($sorttype == "DESC") 
                                                        echo 'class="sorting_desc"'; 
                                                    else 
                                                        echo 'class="sorting"'; 
                                                } else 
                                                    echo 'class="sorting"'; ?>>Sekolah/Instansi</th>
                                            <th id="p.nama_propinsi" <?php
                                                if ($sortfield == "p.nama_propinsi") { 
                                                    if ($sorttype == "ASC") 
                                                        echo 'class="sorting_asc"'; 
                                                    elseif ($sorttype == "DESC") 
                                                        echo 'class="sorting_desc"'; 
                                                    else 
                                                        echo 'class="sorting"'; 
                                                } else 
                                                    echo 'class="sorting"'; ?>>Propinsi</th>
                                            <th id="k.nama_kota" <?php
                                                if ($sortfield == "k.nama_kota") { 
                                                    if ($sorttype == "ASC") 
                                                        echo 'class="sorting_asc"'; 
                                                    elseif ($sorttype == "DESC") 
                                                        echo 'class="sorting_desc"'; 
                                                    else 
                                                        echo 'class="sorting"'; 
                                                } else 
                                                    echo 'class="sorting"'; ?>>Kota/Kabupaten</th>
                                            <th id="da.tgl_lahir" <?php
                                                if ($sortfield == "da.tgl_lahir") { 
                                                    if ($sorttype == "ASC") 
                                                        echo 'class="sorting_asc"'; 
                                                    elseif ($sorttype == "DESC") 
                                                        echo 'class="sorting_desc"'; 
                                                    else 
                                                        echo 'class="sorting"'; 
                                                } else 
                                                    echo 'class="sorting"'; ?> width="50">Usia</th>
                                            <th id="da.ijazah_akhir" <?php
                                                if ($sortfield == "da.ijazah_akhir") { 
                                                    if ($sorttype == "ASC") 
                                                        echo 'class="sorting_asc"'; 
                                                    elseif ($sorttype == "DESC") 
                                                        echo 'class="sorting_desc"'; 
                                                    else 
                                                        echo 'class="sorting"'; 
                                                } else 
                                                    echo 'class="sorting"'; ?>>Pend Terakhir</th>
                                            <th id="da.jurusan_akhir" <?php
                                                if ($sortfield == "da.jurusan_akhir") { 
                                                    if ($sorttype == "ASC") 
                                                        echo 'class="sorting_asc"'; 
                                                    elseif ($sorttype == "DESC") 
                                                        echo 'class="sorting_desc"'; 
                                                    else 
                                                        echo 'class="sorting"'; 
                                                } else 
                                                    echo 'class="sorting"'; ?>>Jurusan</th>

                                            <th id="da.tgl_ajuan" <?php
                                                if ($sortfield == "da.tgl_ajuan") { 
                                                    if ($sorttype == "ASC") 
                                                        echo 'class="sorting_asc"'; 
                                                    elseif ($sorttype == "DESC") 
                                                        echo 'class="sorting_desc"'; 
                                                    else 
                                                        echo 'class="sorting"'; 
                                                } else 
                                                    echo 'class="sorting"'; ?> width="70">Tgl Ajuan</th>
                                            <th width="30">Ap 1</th>
                                            <th width="30">Ap 2</th>
                                            <th width="30">Ap 3</th>
                                            <?php if ($jadwalid != 0):?>
                                                <th width="160">Action</th>
                                            <?php endif;?>
                                        </tr>
                                    </thead>

                                    <tbody>

                                    <?php if(!$rows):?>
                                        <tr>
                                            <td colspan="<?php if ($jadwalid != 0) echo '13'; else echo '12'; ?>"><?php echo Filter::msgInfo(lang('NO_DATA'), false);?></td>
                                        </tr>

                                    <?php else:?>
                                    <?php foreach ($rows as $row):?>

                                        <tr>
                                            <td><?php echo $row->nuptk; ?></td>
                                            <td style="text-align: left;"><?php  if ($jadwalid != 0) { if ($row->jenis == 'P') $pjenis = 'ptk'; else $pjenis = 'staff'; echo '<a href="index.php?do='.$pjenis.'&action=edit&id='.$row->personid.'">'.$row->nama_lengkap.'</a>'; } else echo $row->nama_lengkap;?></td>
                                            <td style="text-align: left;"><?php if ($jadwalid != 0) echo '<a href="index.php?do=sekolah&action=edit&id='.$row->instansiid.'">'.$row->nama_sekolah.'</a>'; else echo $row->nama_sekolah; ?></td>
                                            <td style="text-align: left;"><?php echo $row->nama_propinsi;?></td>
                                            <td style="text-align: left;"><?php echo $row->nama_kota;?></td>

                                            <td style="text-align: center;"><?php if ($row->tgl_lahir) echo getAge($row->tgl_lahir); ?></td> 

                                            <td style="text-align: center;"><?php echo $row->ijazah_akhir;?></td>
                                            <td style="text-align: left;"><?php echo $row->jurusan_akhir;?></td>

                                            <td><?php echo date("d/m/Y", strtotime($row->tgl_ajuan));?></td>
                                            <td>
                                                <?php 
                                                    if ($row->approve1) {
                                                            echo '<a href="javascript:void(0)" title="Approve!" class="btn tip btn-info btn-mini appv" data-appvidx="1" data-id="'. $row->id.'" data-toggle="modal">A</a>';
                                                    } else {
                                                            echo '<a href="javascript:void(0)" title="Disapprove!" class="btn tip btn-info btn-mini appv" data-appvidx="1" data-id="'. $row->id.'" data-toggle="modal">U</a>';
                                                    }
                                                ?>
                                            </td>
                                            <td>
                                                <?php 
                                                    if ($row->approve2) {
                                                            echo '<a href="javascript:void(0)" title="Approve!" class="btn tip btn-info btn-mini appv" data-appvidx="2" data-id="'. $row->id.'" data-toggle="modal">A</a>';
                                                    } else {
                                                            echo '<a href="javascript:void(0)" title="Disapprove!" class="btn tip btn-info btn-mini appv" data-appvidx="2" data-id="'. $row->id.'" data-toggle="modal">U</a>';
                                                    }
                                                ?>											
                                            </td>
                                            <td>
                                                <?php 
                                                    if ($row->approve3) {
                                                            echo '<a href="javascript:void(0)" title="Approve!" class="btn tip btn-info btn-mini appv" data-appvidx="3" data-id="'. $row->id.'" data-toggle="modal">A</a>';
                                                    } else {
                                                            echo '<a href="javascript:void(0)" title="Disapprove!" class="btn tip btn-info btn-mini appv" data-appvidx="3" data-id="'. $row->id.'" data-toggle="modal">U</a>';
                                                    }
                                                ?>																						
                                            </td>
                                            <?php if ($jadwalid != 0):?>
                                                    <td align="center">
                                                        <?php if ($status == "P"):?>
                                                            <button class="btn tip btn-mini btn-info" title="Ganti dari cadangan!" onclick="location.href='index.php?do=diklat_calonpeserta&amp;action=ganti&amp;id=<?php echo $row->id; ?>&amp;jadwalid=<?php echo $jadwalid; ?>'" >Ganti</button>&nbsp;&nbsp;
                                                        <?php endif; ?>
                                                        <a href="javascript:void(0)" title="Hapus" class="tip doDelete" data-id="<?php echo $row->id;?>"><span class="icon12 icomoon-icon-remove"></span></a>
                                                        <a href="javascript:void(0)" title="Sinkron Data" class="tip doSync" data-id="<?php echo $row->id;?>"><span class="icon12 icomoon-icon-link"></span></a>
                                                    </td>
                                            <?php endif;?>
                                        </tr>

                                    <?php endforeach;?>
                                    <?php unset($row);?>
                                    <?php endif;?>					

                                    </tbody>

                                    <tfoot>
                                        <tr>
                                            <td colspan="13">
                                                <div class="span4">
                                                    <strong>Data&nbsp;:&nbsp;<span class="label label-info"><?php echo number_format($pager->items_total);?></span></strong>
                                                </div>
                                                <div class="span8">
                                                    <div class="right">
                                                        <?php echo $pager->display_pages();?>
                                                    </div>
                                                </div>
                                            </td>											
                                        </tr>										
                                    </tfoot>

                                </table>

                            </div> <!-- end .content -->
                        
                        </div> <!-- end .box -->

                            
<?php echo Core::doDelete(lang('DELCONFIRM_TITLE'), "deleteDiklat_CalonPeserta");?>	

                    <!-- Boostrap approve modal dialog -->
                    <div id="appvModal" class="modal hide fade" style="display: none; width: 600px;">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal"><span class="icon12 minia-icon-close"></span></button>
                          <h3>Approval Calon Peserta Diklat</h3>
                        </div>

                        <div class="modal-body">		
                            <div id="modalContent" style="display:none;">
                            </div>
                        </div>

                        <div class="modal-footer">
                          <a href="#" class="btn" data-dismiss="modal">Close</a>
                          <a href="javascript:void(0)" class="btn btn-primary" id="btnappv">Proses!</a>
                        </div>
                    </div>

                     <!-- Boostrap approve modal dialog -->
                    <div id="SyncModal" class="modal fade hide" >
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">
                                <span class="icon12 minia-icon-close"></span></button>
                            <h3>Sinkron Data Peserta</h3>
                        </div>
                        <div class="modal-body">
                            <p>Update data Profile berikut ?</p>
                        </div>
                        <div class="modal-footer">
                            <a href="#" id="updateBtn" class="btn btn-danger">Update</a>
                            <a href="#" class="btn" data-dismiss="modal">Batal</a>
                        </div>
                    </div>
				
		                                          
	<script type="text/javascript">

                $(document).ready(function () {

                    $('a.btn.btn-info.btn-mini.appv').live('click', function () {

                          $('#appvModal').modal();

                          return false;

                      });
                      
                    $("a[data-toggle=modal]").click(function() {   

                          var id = $(this).data('id'),
                            appvidx = $(this).data('appvidx');

                          $("#appvModal").data({
                                     'id': id,
                                     'appvidx': appvidx
                          });

                          $.ajax({
                                  cache: false,
                                  type: 'GET',
                                  url: 'controller_ptk.php',
                                  data: 'viewDiklat_CalonPeserta=' + appvidx + '&id=' + id,
                                  success: function(html) 
                                  {
                                          $('#appvModal').show();
                                          $('#modalContent').show().html(html);
                                  }
                          });
                    });
                      
                    $('#btnappv').click(function(event) {

                          var id = $("#appvModal").data('id'),
                              appvidx = $("#appvModal").data('appvidx');

                          $.ajax({
                                  type: 'post',
                                  url: 'controller.php',
                                  data: 'processDiklat_CalonPesertaToggleApprove=' + id  + '&idx=' + appvidx,
                                  success: function (msg) {
                                          window.location.href = 'index.php?do=diklat_calonpeserta&jadwalid=' + <?php echo $jadwalid;?>;
                                  }
                          });

                      });		 
		  
                    $(".sorting, .sorting_asc, .sorting_desc").click(function(){

                          var sortfield  = $(this).attr("id");
                          var tclass =  $(this).attr("class");

                          if (tclass == "sorting_asc")
                              sorttype = "DESC"
                          else
                              sorttype = "ASC";

                          $('input[name=sortfield]').val(sortfield);
                          $('input[name=sorttype]').val(sorttype);

                          var values = $("#filter_form").serialize();

                        location.href = "index.php?" + values;

                    });
                            
                    // -- sync diklat_calonpeserta <= ptk / staff
                            
                    $('#SyncModal').on('show', function() {
                            var id = $(this).data('syncid'),
                                parent = $(this).data('parent');

                            $('#SyncModal a#updateBtn').on('click', function(e) {

                                    $('#SyncModal').modal('hide'); // dismiss the dialog

                                    $.ajax({
                                              type: 'post',
                                              url: 'controller.php',
                                              data: 'updateDiklat_CalonPeserta=' + id,
                                              success: function (msg) {
                                                    $('#msgholder').html(msg);
                                                    setTimeout(function() {
                                                      var str = $('#filter_form').serialize();
                                                      window.location = "index.php?do=diklat_calonpeserta&pg=" + <?php echo $pg; ?> + "&" + str;
                                                    }, 2000);
                                              }
                                    });

                            });		

                    })

                    $('#SyncModal').on('hide', function() {

                            $('#SyncModal a#updateBtn').off('click');

                    });

                    $('.tip.doSync').click(function(e) {
                            e.preventDefault();

                            var id = $(this).data('id');
                            var parent = $(this).parent().parent();

                            $('#SyncModal').data({
                                    'syncid': id,
                                    'parent': parent
                            });

                            $('#SyncModal').modal('show');

                    });		  		  
                                                                                                            
                });		  
		  		 		  
	</script>
									  
<?php break;?>
<?php endswitch;?>

                    </div><!-- End .span12 -->
                </div><!-- End .row-fluid -->  

            </div><!-- End contentwrapper -->
        </div><!-- End #content -->
    
    </div><!-- End #wrapper -->

    <!-- Charts plugins -->
    <script type="text/javascript" src="plugins/charts/sparkline/jquery.sparkline.min.js"></script><!-- Sparkline plugin -->
    
    <!-- Misc plugins -->
    <script type="text/javascript" src="plugins/misc/qtip/jquery.qtip.min.js"></script><!-- Custom tooltip plugin -->
    <script type="text/javascript" src="plugins/misc/totop/jquery.ui.totop.min.js"></script> 

    <!-- Search plugin -->
    <script type="text/javascript" src="plugins/misc/search/tipuesearch_set.js"></script>
    <script type="text/javascript" src="plugins/misc/search/tipuesearch_data.js"></script><!-- JSON for searched results -->
    <script type="text/javascript" src="plugins/misc/search/tipuesearch.js"></script>

    <!-- Form plugins -->
    <script type="text/javascript" src="plugins/forms/watermark/jquery.watermark.min.js"></script>
    <script type="text/javascript" src="plugins/forms/uniform/jquery.uniform.min.js"></script>    
            
    <!-- Fix plugins -->
    <script type="text/javascript" src="plugins/fix/ios-fix/ios-orientationchange-fix.js"></script>

    <!-- Table plugins -->
    <script type="text/javascript" src="plugins/tables/responsive-tables/responsive-tables.js"></script><!-- Make tables responsive -->

    <!-- Important Place before main.js  -->
    <script type="text/javascript" src="js/jquery-ui.min.js"></script>
    <script type="text/javascript" src="js/jquery.form.js"></script> 
    <script type="text/javascript" src="plugins/fix/touch-punch/jquery.ui.touch-punch.min.js"></script><!-- Unable touch for JQueryUI -->
	
    <!-- Init plugins -->
    <script type="text/javascript" src="js/main.js"></script><!-- Core js functions -->
