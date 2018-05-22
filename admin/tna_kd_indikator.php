<?php
  /**
   * Main
   *
   * @package SIM PPPPTK BMTI
   * @author a2ngsa
   * @copyright 2012
   * @version $Id: tna_kd_indikator.php (admin), v1.00 2011-06-05 10:12:05 gewa Exp $
   */
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
	  
?>

<script type="text/javascript" src="js/tna_kd.js">

    $(function() {
    
        $("#admin_form").validate({
            rules: {
                indikator_idx: {
                    required: true,
                    number: true
                }
            }
        });

    });

</script>

        <!--Body content-->
        <div id="content" class="clearfix">
            <div class="contentwrapper"><!--Content wrapper-->

                <div class="heading">
                    <h3>TNA Online - Indikator Kompetensi Dasar(KD)</h3>                    
                </div><!-- End .heading-->
    				
                <!-- Build page from here: Usual with <div class="row-fluid"></div> -->

                <div class="row-fluid">
                    <div class="span12">

                        <div id="msgholder"></div>
                        
                        <div class="box">
							
<?php switch(Filter::$action): case "edit": ?>

                            <div class="title">
                                <h4> 
                                    <span>Edit Indikator Kompetensi Dasar</span>
                                </h4>								
                            </div>

                            <div class="content">
							
                                <?php 
                                    $row = Core::getRowById("kd_indikator", Filter::$id);
                                    $kdid = Filter::$get["kdid"];
                                ?>
    
                                <form id="admin_form" class="form-horizontal" method="post" action="">			
                                <fieldset>

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <label class="form-label span4" for="normal">No. Urut:</label>
                                                <input type="text" class="span2 required" name="indikator_idx" id="indikator_idx" value="<?php echo $row->indikator_idx;?>"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <label class="form-label span4" for="normal">Nama Indikator:</label>
                                                <input type="text" class="span8 required" name="nama_indikator" id="nama_indikator" value="<?php echo $row->nama_indikator;?>"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-info">Save</button>
                                        <button type="button" class="btn" onclick="location.href='index.php?do=tna_kd&amp;action=edit&amp;id=<?php echo $kdid; ?>'">Kembali</button>
                                    </div>

                                    <input name="kdid" type="hidden" value="<?php echo $row->kdid;?>" />
                                    <input name="id" type="hidden" value="<?php echo Filter::$id;?>" />

                                </fieldset>
                                </form>       
                                
                            </div> <!-- end .content -->

            <script type="text/javascript">

                $(document).ready(function () {
                    
                    var options = {
                        target: "#msgholder",
                        beforeSubmit:  showLoader,
                        success: showResponse,
                        url: "controller.php",
                        resetForm : 0,
                        clearForm : 0,
                        data: { processKD_Indikator: 1 }
                    };

                    $("#admin_form").ajaxForm(options);
                });
              
                function showLoader() {

                    $("#loader").fadeIn(200);

                }
          
                function hideLoader() {

                    $("#loader").fadeOut(200);

                };    
                      
                function showResponse(msg) {    
                                
                    hideLoader();

                     alert(msg);

                     /*
                    $(this).html(msg);
                    $("html, body").animate({
                        scrollTop: 0
                    }, 600);

                    */

                }

            </script>

<?php break; ?>

    <!------------------------ add ----------------------------------------------->


<?php case "add": ?>

                            <?php 
                                $kdid = Filter::$get["kdid"];                                    
                            ?>

                            <div class="title">
                                <h4> 
                                    <span>Tambah Indikator Kompetensi Dasar</span>
                                </h4>								
                            </div>

                            <div class="content">
   
                                <form id="admin_form" class="form-horizontal" method="post" action="">			
                                <fieldset>

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <label class="form-label span4" for="normal">No. Urut:</label>
                                                <input type="text" class="span2 required" name="indikator_idx" id="indikator_idx" value=""/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <label class="form-label span4" for="normal">Nama Indikator:</label>
                                                <input type="text" class="span8 required" name="nama_indikator" id="nama_indikator" value=""/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-info">Save</button>
                                        <button type="button" class="btn" onclick="history.back()">Kembali</button>
                                    </div>

                                    <input name="kkid" type="hidden" value="<?php echo $kdid; ?>" />

                                </fieldset>
                                </form>       

                            </div> <!-- end .content -->
                              
            <script type="text/javascript">

                $(document).ready(function () {
                    
                    var options = {
                        target: "#msgholder",
                        beforeSubmit:  showLoader,
                        success: showResponse,
                        url: "controller.php",
                        resetForm : 0,
                        clearForm : 0,
                        data: { processKD_Indikator: 1 }
                    };

                    $("#admin_form").ajaxForm(options);
                });
              
                function showLoader() {

                    $("#loader").fadeIn(200);

                }
          
                function hideLoader() {

                    $("#loader").fadeOut(200);

                };    
                      
                function showResponse(msg) {    
                                
                    hideLoader();

                    // -- check if error --


                    alert(msg);

                    /*
                    $(this).html(msg);
                    $("html, body").animate({
                        scrollTop: 0
                    }, 600);

*/

                }

            </script>


<?php break; ?>


    <!------------------------ list ----------------------------------------------->
	

<?php default: ?>
        
                            <div class="title">
                                <h4>
                                    <span class="icon16 icomoon-icon-equalizer-2"></span>
                                    <span>TNA Online - Indikator Kompetensi Dasar (KD)</span>                                       
                                </h4>																				
                            </div>
    
                            <div class="content">
	
                                <table class="responsive table table-striped table-bordered table-sorting table-condensed">

                                    <thead>
                                        <tr>
                                            <th width="50">No.</th>
                                            <th>Nama Indikator</th>
                                            <th width="100"><button type="button" class="btn btn-mini" onclick="location.href='index.php?do=tna_kd_indikator&amp;action=add'"><span class="icon16 icomoon-icon-plus-2"></span>Tambah</button></th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                    <?php if(!$rows):?>
                                        <tr>
                                            <td colspan="3"><?php echo Filter::msgInfo(lang('NO_DATA'), false);?></td>
                                        </tr>

                                    <?php else:?>
                                    <?php 

                                        $i = 0;
                                        foreach ($rows as $row):

                                    ?>

                                        <tr>
                                            <td style="text-align: right;"><?php $i++; echo $i;?>. </td>
                                            <td style="text-align: left;"><?php echo $row->nama_indikator;?></td>
                                            <td align="center">
                                                <a href="index.php?do=tna_kd_indikator&amp;action=edit&amp;id=<?php echo $row->id;?>" title="Edit" class="tip"><span class="icon12 icomoon-icon-pencil"></span></a>
                                                <a href="javascript:void(0)" title="Hapus" class="tip doDelete" data-id="<?php echo $row->id;?>"><span class="icon12 icomoon-icon-remove"></span></a>
                                            </td>
                                        </tr>

                                    <?php endforeach;?>
                                    <?php unset($row);?>
                                    <?php endif;?>					

                                    </tbody>

                                    <tfoot>
                                        <tr>
                                            <td colspan="4">
                                                <div class="span4">
                                                    <strong>Data&nbsp;:&nbsp;<span class="label label-info"><?php echo number_format($pager->items_total);?></span></strong>
                                                </div><!-- End .span4 -->
                                                <div class="span8">
                                                    <div class="right">
                                                        <?php echo $pager->display_pages();?>
                                                    </div>
                                                </div><!-- End .span8 -->
                                            </td>											
                                        </tr>										
                                    </tfoot>

                                </table>
			
                            <?php echo Core::doDelete(lang('DELCONFIRM_TITLE'), "deleteKD_Indikator");?>
                                
                            </div> <!-- end .content -->

<?php break;?>
<?php endswitch;?>

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
    <script type="text/javascript" src="plugins/forms/validate/jquery.validate.min.js"></script>
            
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
