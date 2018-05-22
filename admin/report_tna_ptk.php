<?php
  /**
   * Main
   *
   * @package SIM PPPPTK BMTI
   * @author a2ngsa
   * @copyright 2012
   * @version $Id: report_tna_ptk.php (admin), v1.00 2011-06-05 10:12:05 gewa Exp $
   */
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
	    
?>

<?php switch(Filter::$action): case "print": ?>

	<?php include ("report_tna_ptk_print.php"); ?>

<?php break; ?>

    <!------------------------ list ----------------------------------------------->
	

<?php default: ?>

	<?php
		if(isset(Filter::$get['tgl_dari']))
                    $tgl_dari = Filter::$get['tgl_dari'];
		else
                    $tgl_dari = date('d/m/Y');
			
		if(isset(Filter::$get['tgl_sampai']))
                    $tgl_sampai = Filter::$get['tgl_sampai'];
		else
                    $tgl_sampai = date('d/m/Y', strtotime("+10 days"));
			
		$kkid = 0;	
			
	?>
		
        <!--Body content-->
        <div id="content" class="clearfix">
            <div class="contentwrapper"><!--Content wrapper-->

                <div class="heading">
                    <h3>Laporan Data Hasil TNA Online untuk PTK</h3>
                </div><!-- End .heading-->
    				
                <!-- Build page from here: Usual with <div class="row-fluid"></div> -->

                <div class="row-fluid">
                    <div class="span12">

                        <div class="box">

                            <div class="title">
                                <h4>
                                    <span>Filter Jadwal Diklat:</span>
                                    
                                    <div class="right">
                                        <a href="controller_report.php?action=createReportTNA_PTK<?php echo '&amp;tgl_dari='.$tgl_dari.'&amp;tgl_sampai='.$tgl_sampai.'&amp;kkid='.$kkid; ?>" class="tip" title="Export"><span class="icon16 icomoon-icon-file-excel"></span></a>
                                        <a href="controller_print.php?action=createPrintTNA_PTK<?php echo '&amp;tgl_dari='.$tgl_dari.'&amp;tgl_sampai='.$tgl_sampai.'&amp;kkid='.$kkid; ?>" class="tip" title="Print" target="_blank"><span class="icon24 icomoon-icon-printer-2"></span></a>
                                    </div>
                                                                        
                                </h4>
                            </div>
                                    
                            <div class="content">
                                <form class="form form-horizontal" method="get" action="">
                                <fieldset>
                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">
                                                <label class="form-label span2" for="tgl_dari">Periode:</label>
                                                <input type="text" class="span2 datepickerField" name="tgl_dari" id="tgl_dari" value="<?php echo $tgl_dari;?>" style="width: 100px"/>&nbsp;sampai :&nbsp;
                                                <input type="text" class="span2 datepickerField" name="tgl_sampai" id="tgl_sampai" value="<?php echo $tgl_sampai;?>" style="width: 100px"/>
                                            </div> <!-- end row-fluid -->
                                        </div>
                                    </div>		
                                </fieldset>
                                </form>								
                            </div>

                        </div><!-- End filter .box -->

                    </div><!-- End .span12 -->
                </div><!-- End .row-fluid -->  

                
                <div class="row-fluid">
                    <div class="span12">

                        <?php 
                        
                            $tgl_dari = setToSQLdate($tgl_dari);
                            $tgl_sampai = setToSQLdate($tgl_sampai);                        
                            $rows = $content->getTNA_PTK($kkid, $tgl_dari, $tgl_sampai);
                            
                        ?>

                        <table class="responsive table table-striped table-bordered">

                            <thead>
                                <tr>
                                    <th width="70">NUPTK</th>
                                    <th>Nama Lengkap</th>
                                    <th>Sekolah</th>
                                    <th>Propinsi</th>
                                    <th>Paket Keahlian</th>
                                    <th width="80">Tgl Proses</th>
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
                                    <td><?php echo $row->nuptk;?></td>
                                    <td style="text-align: left;"><?php echo $row->nama_lengkap;?></td>
                                    <td style="text-align: left;"><?php echo $row->nama_sekolah;?></td>
                                    <td style="text-align: left;"><?php echo $row->nama_propinsi;?></td>
                                    <td style="text-align: left;"><?php echo $row->nama_kompetensi;?></td>
                                    <td><?php echo $row->created;?></td>
                                </tr>

                            <?php endforeach;?>
                            <?php unset($row);?>
                            <?php endif;?>					

                            </tbody>

                        </table>

                    </div><!-- End .span12 -->
                </div><!-- End .row-fluid -->  

            </div><!-- End contentwrapper -->
        </div><!-- End #content -->
    
    </div><!-- End #wrapper -->

	<script type="text/javascript">
	
		$(document).ready(function(){
		
			if($('#tgl_dari').length) {
				$("#tgl_dari").datepicker({
					dateFormat: "dd/mm/yy",
					defaultDate: "+1w",
					changeMonth: true,
                                        changeYear: true,
					numberOfMonths: 1,
					onSelect: function( selectedDate ) {
						$( "#tgl_sampai" ).datepicker( "option", "minDate", selectedDate );
						window.location = "index.php?do=report_tna_ptk&tgl_dari="+ selectedDate + "&tgl_sampai=" + document.getElementById("tgl_sampai").value;
					}
				});
			}

			if($('#tgl_sampai').length) {
				$("#tgl_sampai").datepicker({
					dateFormat: "dd/mm/yy",
					defaultDate: "+1w",
					changeMonth: true,
                                        changeYear: true,
					numberOfMonths: 1,
					onSelect: function( selectedDate ) {
						$( "#tgl_dari" ).datepicker( "option", "maxDate", selectedDate );
						window.location = "index.php?do=report_tna_ptk&tgl_dari="+ document.getElementById("tgl_dari").value + "&tgl_sampai=" + selectedDate;
					}			
				});
			}		
		
		});
		
	</script>
		
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

<?php break;?>
<?php endswitch;?>