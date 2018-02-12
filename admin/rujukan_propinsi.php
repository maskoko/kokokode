<?php
  /**
   * Main
   *
   * @package SIM PPPPTK BMTI
   * @author a2ngsa
   * @copyright 2012
   * @version $Id: rujukan_propinsi.php (admin), v1.00 2011-06-05 10:12:05 gewa Exp $
   */
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
	  
  
?>
	
        <!--Body content-->
        <div id="content" class="clearfix">
            <div class="contentwrapper"><!--Content wrapper-->

                <div class="heading">

                    <h3>Rujukan - Propinsi</h3>                    

                </div><!-- End .heading-->
    				
                <!-- Build page from here: Usual with <div class="row-fluid"></div> -->

                <div class="row-fluid">
                    <div class="span12">

                        <div id="msgholder"></div>
					
                        <div class="box">

<?php switch(Filter::$action): case "edit": ?>

                            <div class="title">
                                <h4> 
                                    <span>Edit Propinsi</span>
                                    <span id="loader" class="loader" style="display:none"><img src="images/loader_circular.gif" width="16" height="16" alt=""></span>
                                </h4>								
                            </div>

                            <div class="content">

                                <?php $row = Core::getRowByKey("propinsi", "kode", Filter::$get['kode']);?>

                                <form id="admin_form" class="form-horizontal" method="post" action="">
                                <fieldset>
                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <label class="form-label span4" for="normal">Kode:</label>
                                                <input type="text" class="span2 required" name="kode" id="kode" value="<?php echo $row->kode;?>" disabled="disabled"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <label class="form-label span4" for="normal">Nama Propinsi:</label>
                                                <input type="text" class="span8 required" name="nama_propinsi" id="nama_propinsi" value="<?php echo $row->nama_propinsi;?>"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <label class="form-label span4" for="normal">Source:</label>
                                                <input type="text" class="span2" name="source_name" id="source_name" value="<?php echo $row->source_name;?>" readonly="readonly"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <label class="form-label span4" for="normal">Source ID:</label>
                                                <input type="text" class="span2" name="source_id" id="source_id" value="<?php echo $row->source_id;?>" readonly="readonly"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-info">Save</button>
                                        <button type="button" class="btn" onclick="history.back()">Kembali</button>
                                    </div>

                                    <input name="kode" type="hidden" value="<?php echo Filter::$get['kode'];?>" />
                                    <input name="userid" type="hidden" value="<?php echo $row->userid;?>" />	
                                </fieldset>
                                </form>       
							
		  <script type="text/javascript">

			  $(document).ready(function () {
                                var options = {
                                        target: "#msgholder",
                                        beforeSubmit:  showLoader,
                                        success: showResponse,
                                        url: "controller.php",
                                        resetForm : 0,
                                        clearForm : 0,
                                        data: {
                                                processUpdatePropinsi: '<?php echo Filter::$get['kode']; ?>'
                                        }
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
                                $(this).html(msg);
                                $("html, body").animate({
                                        scrollTop: 0
                                }, 600);
			  }		  
			  
		  </script> 
                                                                
<?php break; ?>

    <!------------------------ add ----------------------------------------------->


<?php case "add": ?>

                            <div class="title">
                                <h4> 
                                    <span>Tambah Propinsi</span>
                                </h4>								
                            </div>

                            <div class="content">

                                <form id="admin_form" class="form-horizontal" method="post" action="">
                                <fieldset>

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <label class="form-label span4" for="normal">Kode:</label>
                                                <input type="text" class="span2 required" name="kode" id="kode" value=""/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <label class="form-label span4" for="normal">Nama Propinsi:</label>
                                                <input type="text" class="span8 required" name="nama_propinsi" id="nama_propinsi" value=""/>
                                            </div>
                                        </div>
                                    </div>

                                    <input name="source_id" type="hidden" value="" />
                                    <input name="source_name" type="hidden" value="SIM" />
                                    <input name="userid" type="hidden" value="<?php echo $user->uid;?>" />

                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-info">Save</button>
                                        <button type="button" class="btn" onclick="history.back()">Kembali</button>
                                    </div>

                                </fieldset>
                                </form>       

		  <script type="text/javascript">

			  $(document).ready(function () {
                                var options = {
                                        target: "#msgholder",
                                        beforeSubmit:  showLoader,
                                        success: showResponse,
                                        url: "controller.php",
                                        resetForm : 0,
                                        clearForm : 0,
                                        data: {
                                                processAddPropinsi: 1
                                        }
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
                                $(this).html(msg);
                                $("html, body").animate({
                                        scrollTop: 0
                                }, 600);
			  }		  
			  
		  </script> 

<?php break; ?>


    <!------------------------ list ----------------------------------------------->
	

<?php default: ?>

	<?php 
        
            if(isset(Filter::$get['sortfield']))
                $sortfield = Filter::$get['sortfield'];
            else
                $sortfield = 'nama_propinsi';

            if(isset(Filter::$get['sorttype']))
                $sorttype = Filter::$get['sorttype'];
            else
                $sorttype = 'ASC';
        
            $rows = $content->getPropinsi();        
        
        ?>
    
                            <div class="title">
                                <h4>
                                    <span class="icon16 icomoon-icon-list-view-2"></span>
                                    <span>Propinsi</span>                                       
                                </h4>
                            </div>
    
                            <div class="content">

                                <table class="responsive table table-bordered table-striped table-sorting table-condensed">

                                    <thead>
                                        <tr>
                                            <th id="kode" <?php
                                                if ($sortfield == "kode") { 
                                                    if ($sorttype == "ASC") 
                                                        echo 'class="sorting_asc"'; 
                                                    elseif ($sorttype == "DESC") 
                                                        echo 'class="sorting_desc"'; 
                                                    else 
                                                        echo 'class="sorting"'; 
                                                } else 
                                                    echo 'class="sorting"'; ?> width="50">Kode</th>
                                            <th id="nama_propinsi" <?php
                                                if ($sortfield == "nama_propinsi") { 
                                                    if ($sorttype == "ASC") 
                                                        echo 'class="sorting_asc"'; 
                                                    elseif ($sorttype == "DESC") 
                                                        echo 'class="sorting_desc"'; 
                                                    else 
                                                        echo 'class="sorting"'; 
                                                } else 
                                                    echo 'class="sorting"'; ?>>Nama Propinsi</th>
                                            <th width="110"><button type="button" class="btn btn-mini" onclick="location.href='index.php?do=rujukan_propinsi&amp;action=add'"><span class="icon16 icomoon-icon-plus-2"></span>Tambah</button></th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php if(!$rows):?>
                                            <tr>
                                                <td colspan="3"><?php echo Filter::msgInfo(lang('NO_DATA'), false);?></td>
                                            </tr>

                                        <?php else:?>
                                        <?php foreach ($rows as $row):?>

                                            <tr>
                                                <td align="center"><?php echo $row->kode;?></td>
                                                <td style="text-align: left;"><?php echo $row->nama_propinsi;?></td>
                                                <td align="center">
                                                    <a href="index.php?do=rujukan_propinsi&amp;action=edit&amp;kode=<?php echo $row->kode;?>" title="Edit" class="tip"><span class="icon12 icomoon-icon-pencil"></span></a>
                                                    <a href="" title="Hapus" class="tip doDelete" data-id="<?php echo $row->kode;?>"><span class="icon12 icomoon-icon-remove"></span></a>
                                                </td>
                                            </tr>

                                        <?php endforeach;?>
                                        <?php unset($row);?>
                                        <?php endif;?>									
                                    </tbody>

                                    <tfoot>
                                        <tr>
                                            <td colspan="3">
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
							                            
                            <?php echo Core::doDelete(lang('DELCONFIRM_TITLE'), "deletePropinsi");?>	

    <script type="text/javascript">

        $(document).ready(function () {

              $(".sorting, .sorting_asc, .sorting_desc").click(function(){

                    var sortfield  = $(this).attr("id");
                    var tclass =  $(this).attr("class");

                    if (tclass == "sorting_asc")
                        sorttype = "DESC"
                    else
                        sorttype = "ASC";

                    location.href = "index.php?do=rujukan_propinsi&sortfield=" + sortfield + "&sorttype=" + sorttype;

              });

        });		  

    </script>                                
                                  
<?php break;?>
<?php endswitch;?>

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
