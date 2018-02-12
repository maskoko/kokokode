<?php
  /**
   * Main
   *
   * @package SIM PPPPTK BMTI
   * @author a2ngsa
   * @copyright 2012
   * @version $Id: report_lembaga.php (admin), v1.00 2011-06-05 10:12:05 gewa Exp $
   */
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');	    
  
        
    if(isset(Filter::$get['propinsi_kode']))
        $propinsi_kode = Filter::$get['propinsi_kode'];
    else
        $propinsi_kode = '';

    if(isset(Filter::$get['kota_kode']))
        $kota_kode = Filter::$get['kota_kode'];
    else
        $kota_kode = '';

    if(isset(Filter::$get['searchfield']))
        $searchfield = Filter::$get['searchfield'];
    else
        $searchfield = 'nama';

    if(isset(Filter::$get['searchtext']))
        $searchtext = Filter::$get['searchtext'];
    else
        $searchtext = '';
                			  
?>

        <!--Body content-->
        <div id="content" class="clearfix">
            <div class="contentwrapper"><!--Content wrapper-->

                <div class="heading">
                    <h3>Laporan Data Lembaga</h3>                    
                </div><!-- End .heading-->
    				
                <!-- Build page from here: Usual with <div class="row-fluid"></div> -->

                <div class="row-fluid">
                    <div class="span12">
                
                        <div class="box">
                            <div class="title">
                                <h4>
                                    <span>Filter :</span>

                                    <div class="right">
                                        <a href="controller_report.php?action=createReportLembaga<?php echo '&amp;propinsi_kode='.$propinsi_kode.'&amp;kota_kode='.$kota_kode.'&amp;searchfield='.$searchfield.'&amp;searchtext='.$searchtext; ?>" class="tip" title="Export"><span class="icon16 icomoon-icon-file-excel"></span></a>
                                        <a href="controller_print.php?action=createPrintLembaga<?php echo '&amp;propinsi_kode='.$propinsi_kode.'&amp;kota_kode='.$kota_kode.'&amp;searchfield='.$searchfield.'&amp;searchtext='.$searchtext; ?>" class="tip" title="Print" target="_blank"><span class="icon24 icomoon-icon-printer-2"></span></a>
                                    </div>
                                    
                                </h4>
                            </div>

                            <div class="content">
                                <form class="form form-horizontal" method="get" action="">
                                <fieldset>
                                    <input type="hidden" name="do" value="report_lembaga">

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">
                                                <label class="form-label span2" for="checkboxes">Propinsi:</label>
                                                <div class="span4 controls">
                                                    <?php $propinsi = $content->getPropinsiList();?>						
                                                    <select name="propinsi_kode" id="propinsi_kode" style="width:100%;" placeholder="Select...">
                                                        <option value=""><?php echo lang('SELECT_ALL');?></option>
                                                        <?php if ($propinsi):?>
                                                            <?php foreach ($propinsi as $prow):?>
                                                                <option value="<?php echo $prow->kode;?>" <?php if($prow->kode == $propinsi_kode)echo 'selected="selected"';?>><?php echo $prow->nama_propinsi;?></option>
                                                            <?php endforeach;?>
                                                            <?php unset($prow);?>
                                                        <?php endif;?>						
                                                    </select>
                                                </div>

                                                <label class="form-label span2" for="checkboxes">Kota/Kab:</label>
                                                <div class="span4 controls">
                                                    <?php $kota = $content->getKotaByPropinsiList($propinsi_kode);?>
                                                    <select name="kota_kode" id="kota_kode" style="width:100%;" placeholder="Select...">
                                                        <option value=""><?php echo lang('SELECT_ALL');?></option>
                                                        <?php if ($kota):?>
                                                            <?php foreach ($kota as $prow):?>
                                                                <option value="<?php echo $prow->kode;?>" <?php if($prow->kode == $kota_kode)echo 'selected="selected"';?>><?php echo $prow->nama_kota;?></option>
                                                            <?php endforeach;?>
                                                            <?php unset($prow);?>
                                                        <?php endif;?>						
                                                    </select>
                                                </div>
                                            </div> <!-- end row-fluid -->
                                        </div>
                                    </div>
                
                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">
                                                <label class="form-label span2" for="checkboxes">Search:</label>
                                                <div class="span2 controls">
                                                    <select name="searchfield" id="searchfield" placeholder="Select..." style="width: 100%;">
                                                        <option value="nama_lembaga" <?php if($searchfield == 'nama_lembaga') echo 'selected="selected"';?>>Nama</option>
                                                        <option value="nama_pimpinan" <?php if($searchfield == 'nama_pimpinan') echo 'selected="selected"';?>>Nama Pimpinan</option>
                                                    </select>
                                                </div>

                                                <label class="form-label span2" for="searchtext">Teks:</label>
                                                <input class="span4" type="text" name="searchtext" id="searchtext" value="<?php echo $searchtext; ?>" maxlength="50">
                                                <button type="submit" class="btn btn-info">Cari</button>
                                            </div>
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

                        <?php $rows = $content->getLembaga();?>
    
                        <table class="responsive table table-bordered">

                            <thead>
                                <tr>
                                    <th>Nama Lembaga</th>
                                    <th>Alamat</th>
                                    <th>Propinsi</th>
                                    <th>Kota</th>
                                    <th>Nama Pimpinan</th>
                                </tr>
                            </thead>

                            <tbody>

                            <?php if(!$rows):?>
                                <tr>
                                    <td colspan="5"><?php echo Filter::msgInfo(lang('NO_DATA'), false);?></td>
                                </tr>

                            <?php else:?>
                            <?php foreach ($rows as $row):?>

                                <tr>
                                    <td style="text-align: left;"><?php echo $row->nama_lembaga;?></td>
                                    <td style="text-align: left;"><?php echo $row->alamat;?></td>
                                    <td style="text-align: left;"><?php echo $row->nama_propinsi;?></td>
                                    <td style="text-align: left;"><?php echo $row->nama_kota;?></td>
                                    <td style="text-align: left;"><?php echo $row->nama_pimpinan;?></td>
                                </tr>

                            <?php endforeach;?>
                            <?php unset($row);?>
                            <?php endif;?>					

                            </tbody>

                            <tfoot>
                                <tr>
                                    <td colspan="5">
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
			            	
                    </div><!-- End .span12 -->

                </div><!-- End .row-fluid -->  

            </div><!-- End contentwrapper -->
        </div><!-- End #content -->
    
    </div><!-- End #wrapper -->

    <script type="text/javascript">

              $(document).ready(function () {

                    $("#propinsi_kode").change(function(){
                            var kode = $("#propinsi_kode").val();

                            $.ajax({
                                    type: 'post',
                                    url: "controller.php",
                                    data: "loadKotaList=" + kode,
                                    cache: false,
                                    success: function(html){
                                            $("#kota_kode").html(html); 
                                    }
                            });

                            $("#kota_kode").val("");

                    });

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
