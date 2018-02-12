<?php
  /**
   * Main
   *
   * @package SIM PPPPTK BMTI
   * @author a2ngsa
   * @copyright 2012
   * @version $Id: report_diklat.php (admin), v1.00 2011-06-05 10:12:05 gewa Exp $
   */
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
	  
  
?>

	<?php		
        
            if(isset(Filter::$get['departemenid']))
                $departemenid = Filter::$get['departemenid'];
            else
                $departemenid = 0;
                                			
	?>

        <!--Body content-->
        <div id="content" class="clearfix">
            <div class="contentwrapper"><!--Content wrapper-->

                <div class="heading">

                    <h3>Laporan Data Katalog Diklat</h3>                    

                </div><!-- End .heading-->
    				
                <!-- Build page from here: Usual with <div class="row-fluid"></div> -->

                <div class="row-fluid">
                    <div class="span12">

                        <div class="box">
                            
                            <div class="title">
                                <h4>
                                    <span>Filter :</span>
                                </h4>
                                <a href="#" class="minimize">Minimize</a>
                            </div>

                            <div class="content">
                                <form class="form form-horizontal" method="get" action="">
                                <fieldset>
                                    <input type="hidden" name="do" value="report_diklat">

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">
                                                <label class="form-label span2" for="checkboxes">Departemen:</label>
                                                <div class="span4 controls">
                                                    <?php $departemen = $content->getDepartemenList();?>						
                                                    <select name="departemenid" id="departemenid" style="width:100%;" placeholder="Select...">
                                                        <option value="0"><?php echo lang('SELECT_ALL');?></option>
                                                        <?php if ($departemen):?>
                                                            <?php foreach ($departemen as $prow):?>
                                                                <option value="<?php echo $prow->id;?>" <?php if($prow->id == $departemenid)echo 'selected="selected"';?>><?php echo $prow->nama_departemen;?></option>
                                                            <?php endforeach;?>
                                                            <?php unset($prow);?>
                                                        <?php endif;?>						
                                                    </select>
                                                </div>&nbsp;&nbsp;

                                                <button type="submit" class="btn btn-info">Cari</button>
                                                
                                            </div> <!-- end row-fluid -->
                                        </div>
                                    </div>

                                </fieldset>
                                </form>								
                            </div>

                        </div><!-- End filter .box -->
                        
                        
                        <?php $rows = $content->getDiklat();?>
        
                        <div class="box">

                            <div class="title">
                                <h4>
                                    <span class="icon16 icomoon-icon-file"></span>
                                    <span>Data Katalog Diklat</span>                                       

                                    <div class="right">
                                        <a href="controller_report.php?action=createReportDiklat<?php echo '&amp;departemen='.$departemenid;?>" class="tip" title="Export"><span class="icon16 icomoon-icon-file-excel"></span></a>
                                        <a href="controller_print.php?action=createPrintDiklat<?php echo '&amp;departemen='.$departemenid;?>" class="tip" title="Print" target="_blank"><span class="icon24 icomoon-icon-printer-2"></span></a>
                                    </div>

                                </h4>                                
                            </div>
                            
                            <div class="content">
	
                                <table class="responsive table table-striped table-bordered">

                                    <thead>
                                        <tr>
                                            <th width="60">Kode</th>
                                            <th>Nama Diklat</th>
                                            <th>Departemen</th>
                                            <th width="30">Jml Jam</th>
                                            <th width="50">Jenjang</th>
                                            <th width="50">Kode Lama</th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                    <?php if(!$rows):?>
                                        <tr>
                                            <td colspan="6"><?php echo Filter::msgInfo(lang('NO_DATA'), false);?></td>
                                        </tr>

                                    <?php else:?>
                                    <?php foreach ($rows as $row):?>

                                        <tr>
                                            <td style="text-align: left;"><?php echo $row->kode;?></td>
                                            <td style="text-align: left;"><?php echo $row->nama_diklat;?></td>
                                            <td style="text-align: left;"><?php echo $row->nama_departemen;?></td>
                                            <td><?php echo $row->jml_jam;?></td>
                                            <td><?php echo $row->tingkat;?></td>
                                            <td><?php echo $row->source_kode;?></td>
                                        </tr>

                                    <?php endforeach;?>
                                    <?php unset($row);?>
                                    <?php endif;?>					

                                    </tbody>

                                    <tfoot>
                                        <tr>
                                            <td colspan="6">
                                                <div class="span4">
                                                    <strong>Data&nbsp;:&nbsp;<span class="label label-info"><?php echo number_format($pager->items_total);?></span></strong>
                                                </div>
                                                <div class="span8">
                                                    <div class="right">
                                                        <?php echo $pager->display_pages();?>
                                                    </div>
                                                </div><
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
            	