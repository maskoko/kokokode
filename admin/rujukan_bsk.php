<?php
  /**
   * Main
   *
   * @package SIM PPPPTK BMTI
   * @author a2ngsa
   * @copyright 2012
   * @version $Id: rujukan_bsk.php (admin), v1.00 2011-06-05 10:12:05 gewa Exp $
   */
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
	  
  
?>

        <!--Body content-->
        <div id="content" class="clearfix">
            <div class="contentwrapper"><!--Content wrapper-->

                <div class="heading">

                    <h3>Rujukan - Bidang Keahlian</h3>                    

                </div><!-- End .heading-->
    				
                <!-- Build page from here: Usual with <div class="row-fluid"></div> -->

                <div class="row-fluid">
                    <div class="span12">

                        <div id="msgholder"></div>
                        
                        <div class="box">

<?php switch(Filter::$action): case "edit": ?>

                            <div class="title">
                                <h4> 
                                    <span>Edit Rujukan - Bidang Keahlian</span>
                                </h4>								
                            </div>

                            <div class="content">

                                <?php $row = Core::getRowById("bsk", Filter::$id);?>

                                <form id="admin_form" class="form-horizontal" method="post" action="">			
                                <fieldset>
                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <label class="form-label span4" for="normal">Kode:</label>
                                                <input type="text" class="span2 required" name="kode" id="kode" value="<?php echo $row->kode;?>"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <label class="form-label span4" for="normal">Bidang Keahlian:</label>
                                                <input type="text" class="span8 required" name="nama_bidang" id="nama_bidang" value="<?php echo $row->nama_bidang;?>"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-info">Save</button>
                                        <button type="button" class="btn" onclick="history.back()">Kembali</button>
                                    </div>

                                    <input name="id" type="hidden" value="<?php echo Filter::$id;?>" />
                                    <input name="userid" type="hidden" value="<?php echo $row->userid;?>" />

                                </fieldset>       
                                </form>       

                            </div><!-- End .content -->
                            
			<?php echo Core::doForm("processBSK"); ?> 	

                        </div><!-- End .box -->

                    </div><!-- End .span12 -->
                </div><!-- End .row-fluid -->  

                <div class="row-fluid">

                    <div class="span12">
                        <div class="box">
                            
                            <?php $rows = $content->getPSK($row->id);?>
                            
                            <div class="title">
                                <h4>
                                    <span class="icon16 icomoon-icon-list-view-2"></span>
                                    <span>Program Keahlian</span>                                       
                                </h4>
                            </div>
                            
                            <div class="content">

                                <table class="responsive table table-striped table-bordered">	
                                    <thead>
                                        <tr>
                                            <th width="50">Kode</th>
                                            <th>Program Keahlian</th>
                                            <th width="100">Action</th>
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
                                            <td style="text-align: left;"><?php echo $row->nama_program;?></td>
                                            <td align="center">
                                                <a href="index.php?do=rujukan_psk&amp;action=edit&amp;id=<?php echo $row->id;?>" title="Edit" class="tip"><span class="icon12 icomoon-icon-pencil"></span></a>
                                                <a href="javascript:void(0)" title="Hapus" class="tip doDelete" data-id="<?php echo $row->id;?>"><span class="icon12 icomoon-icon-remove"></span></a>
                                            </td>
                                        </tr>

                                    <?php endforeach;?>
                                    <?php unset($row);?>
                                    <?php endif;?>					

                                    </tbody>

                                </table>
						
<?php break; ?>

    <!------------------------ add ----------------------------------------------->


<?php case "add": ?>

                            <div class="title">
                                <h4> 
                                    <span>Tambah Rujukan - Bidang Keahlian</span>
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
                                                <label class="form-label span4" for="normal">Bidang Keahlian:</label>
                                                <input type="text" class="span8 required" name="nama_bidang" id="nama_bidang" value=""/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-info">Save</button>
                                        <button type="button" class="btn" onclick="history.back()">Kembali</button>
                                    </div>

                                    <input name="userid" type="hidden" value="<?php echo $user->uid; ?>" />

                                </fieldset>
                                </form>       

                            <?php echo Core::doForm("processBSK"); ?> 	

<?php break; ?>


    <!------------------------ list ----------------------------------------------->
	

<?php default: ?>

                            <?php 
                              
                                if(isset(Filter::$get['sortfield']))
                                    $sortfield = Filter::$get['sortfield'];
                                else
                                    $sortfield = 'nama_bidang';

                                if(isset(Filter::$get['sorttype']))
                                    $sorttype = Filter::$get['sorttype'];
                                else
                                    $sorttype = 'ASC';
                
                                $rows = $content->getBSK();
                                
                            ?>

                            <div class="title">
                                <h4>
                                    <span class="icon16 icomoon-icon-list-view-2"></span>
                                    <span>Rujukan - Bidang Keahlian</span>
                                </h4>
                            </div>
    
                            <div class="content">

                                <table class="responsive table table-striped table-bordered table-sorting table-condensed">

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
                                            <th id="nama_bidang" <?php
                                                if ($sortfield == "nama_bidang") { 
                                                    if ($sorttype == "ASC") 
                                                        echo 'class="sorting_asc"'; 
                                                    elseif ($sorttype == "DESC") 
                                                        echo 'class="sorting_desc"'; 
                                                    else 
                                                        echo 'class="sorting"'; 
                                                } else 
                                                    echo 'class="sorting"'; ?>>Bidang Keahlian</th>
                                            <th width="100"><button type="button" class="btn btn-mini" onclick="location.href='index.php?do=rujukan_bsk&amp;action=add'"><span class="icon16 icomoon-icon-plus-2"></span>Tambah</button></th>
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
                                            <td style="text-align: left;"><?php echo $row->nama_bidang;?></td>
                                            <td align="center">
                                                <a href="index.php?do=rujukan_bsk&amp;action=edit&amp;id=<?php echo $row->id;?>" title="" class="tip"><span class="icon12 icomoon-icon-pencil"></span></a>
                                                <a href="javascript:void(0)" title="Hapus" class="tip doDelete" data-id="<?php echo $row->id;?>"><span class="icon12 icomoon-icon-remove"></span></a>
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
		
                            <?php echo Core::doDelete(lang('DELCONFIRM_TITLE'), "deleteBSK");?>	

    <script type="text/javascript">

        $(document).ready(function () {

              $(".sorting, .sorting_asc, .sorting_desc").click(function(){

                    var sortfield  = $(this).attr("id");
                    var tclass =  $(this).attr("class");

                    if (tclass == "sorting_asc")
                        sorttype = "DESC"
                    else
                        sorttype = "ASC";

                    //$('input[name=sortfield]').val(sortfield);
                    //$('input[name=sorttype]').val(sorttype);

                    //var values = $("#filter_form").serialize();

                    location.href = "index.php?do=rujukan_bsk&sortfield=" + sortfield + "&sorttype=" + sorttype;

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
