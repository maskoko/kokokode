<?php
  /**
   * Main
   *
   * @package SIM PPPPTK BMTI
   * @author a2ngsa
   * @copyright 2012
   * @version $Id: report_diklat_jadwal.php (admin), v1.00 2011-06-05 10:12:05 gewa Exp $
   */
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
	  
  
?>

	<?php
		if(isset(Filter::$get['departemenid']))
                    $departemenid = Filter::$get['departemenid'];
		else
                    $departemenid = 0;
                
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
                                
	?>

        <!--Body content-->
        <div id="content" class="clearfix">
            <div class="contentwrapper"><!--Content wrapper-->

                <div class="heading">
                    <h3>Laporan Jadwal Diklat</h3>                    
                </div><!-- End .heading-->
    				
                <!-- Build page from here: Usual with <div class="row-fluid"></div> -->

                <div class="row-fluid">
                    <div class="span12">

                        <div class="box">

                            <div class="title">
                                <h4>
                                    <span>Filter: (<?php echo $jadwal_tgl_dari . ' s.d ' . $jadwal_tgl_sampai; ?>)</span>
                                </h4>
                                <a href="#" class="minimize">Minimize</a>
                            </div>
                            
                            <div class="content">
                                <form class="form-horizontal" method="get" action="">
                                <fieldset>
                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">
                                                <label class="form-label span2" for="checkboxes">Departemen:</label>
                                                <div class="span4 controls">
                                                    <?php $departemen = $content->getDepartemenList();?>						
                                                    <select name="departemenid" onchange="window.location='index.php?do=report_diklat_jadwal&amp;departemenid='+this[this.selectedIndex].value+''" style="width:100%;" placeholder="Select...">
                                                        <option value="0"><?php echo lang('SELECT_ALL');?></option>
                                                        <?php if ($departemen):?>
                                                            <?php foreach ($departemen as $prow):?>
                                                                <option value="<?php echo $prow->id;?>" <?php if($prow->id == $departemenid)echo 'selected="selected"';?>><?php echo $prow->nama_departemen;?></option>
                                                            <?php endforeach;?>
                                                            <?php unset($prow);?>
                                                        <?php endif;?>						
                                                    </select>														
                                                </div>
                                            </div>
                                        </div>
                                    </div>		
                                </fieldset>
                                </form>																
                            </div>

                        </div><!-- End .box -->                        
                        
                        
                        <?php 
                        
                            $jadwal_tgl_dari = setToSQLdate($jadwal_tgl_dari);
                            $jadwal_tgl_sampai = setToSQLdate($jadwal_tgl_sampai);
                            $rows = $content->getDiklat_Jadwal($jadwal_tgl_dari, $jadwal_tgl_sampai, $departemenid);
                            
                        ?>
        
                        <div class="box">

                            <div class="title">
                                <h4>
                                    <span class="icon16 icomoon-icon-file"></span>
                                    <span>Data Jadwal Diklat</span>                                       

                                    <div class="right">
                                        <a href="controller_report.php?action=createReportDiklat_Jadwal<?php echo "&amp;tgl_dari=".$jadwal_tgl_dari."&amp;tgl_sampai=".$jadwal_tgl_sampai."&amp;departemenid=".$departemenid; ?>" class="tip" title="Export"><span class="icon16 icomoon-icon-file-excel"></span></a>
                                        <a href="controller_print.php?action=createPrintDiklat_Jadwal<?php echo "&amp;tgl_dari=".$jadwal_tgl_dari."&amp;tgl_sampai=".$jadwal_tgl_sampai."&amp;departemenid=".$departemenid; ?>" class="tip" title="Print" target="_blank"><span class="icon24 icomoon-icon-printer-2"></span></a>
                                    </div>
                                    
                                </h4>																				
                            </div>

                            <div class="content">

                                <table class="responsive table table-bordered">

                                    <thead>
                                        <tr>
                                            <th width="50">Kode</th>
                                            <th>Nama Diklat</th>
                                            <th width="50">Tingkat</th>
                                            <th width="50">Kelas</th>
                                            <th width="50">Tahun</th>
                                            <th width="75">Tgl Mulai</th>
                                            <th width="75">Tgl Akhir</th>
                                            <th>Departemen</th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                    <?php if(!$rows):?>
                                        <tr>
                                            <td colspan="7"><?php echo Filter::msgInfo(lang('NO_DATA'), false);?></td>
                                        </tr>

                                    <?php else:?>
                                    <?php foreach ($rows as $row):?>

                                        <tr>
                                            <td><?php echo $row->kode;?></td>
                                            <td style="text-align: left;"><?php echo $row->nama_diklat;?></td>
                                            <td><?php echo $row->tingkat;?></td>
                                            <td><?php echo $row->kelas;?></td>
                                            <td><?php echo $row->tahun;?></td>
                                            <td><?php echo $row->tgl_mulai;?></td>
                                            <td><?php echo $row->tgl_akhir;?></td>
                                            <td style="text-align: left;"><?php echo $row->nama_departemen;?></td>
                                        </tr>

                                    <?php endforeach;?>
                                    <?php unset($row);?>
                                    <?php endif;?>					

                                    </tbody>

                                    <tfoot>
                                        <tr>
                                            <td colspan="7">
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

                            </div><!-- End .content -->
                            
                        </div><!-- End .box -->

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
								
