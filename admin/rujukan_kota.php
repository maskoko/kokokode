<?php
  /**
   * Main
   *
   * @package SIM PPPPTK BMTI
   * @author a2ngsa
   * @copyright 2012
   * @version $Id: rujukan_kota.php (admin), v1.00 2011-06-05 10:12:05 gewa Exp $
   */
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
	  
  
?>

        <!--Body content-->
        <div id="content" class="clearfix">
            <div class="contentwrapper"><!--Content wrapper-->

                <div class="heading">

                    <h3>Rujukan - Kota/Kabupaten</h3>                    

                </div><!-- End .heading-->
    				
                <!-- Build page from here: Usual with <div class="row-fluid"></div> -->

<?php switch(Filter::$action): case "edit": ?>

                <div class="row-fluid">
                    <div class="span12">

                        <div id="msgholder"></div>
                        
                        <div class="box">                                
                            <div class="title">
                                <h4> 
                                    <span>Edit Kota/Kabupaten</span>
                                </h4>								
                            </div>

                            <div class="content">

                                <?php 
                                    
                                    $row = Core::getRowByKey("kota", "kode", Filter::$get['kode']);
                                    $propinsi = $content->getPropinsiList();
                                    
                                ?>

                                <form id="admin_form" class="form-horizontal" method="post" action="">
                                <fieldset>

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <label class="form-label span4" for="normal">Kode:</label>
                                                <input type="text" class="span2 required" name="kode" id="kota" value="<?php echo $row->kode;?>" disabled="disabled"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <label class="form-label span4" for="normal">Nama Kota/Kabupaten:</label>
                                                <input type="text" class="span8 required" name="nama_kota" id="nama_kota" value="<?php echo $row->nama_kota;?>"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <label class="form-label span4" for="checkboxes">Propinsi:</label>
                                                <div class="span8 controls">
                                                    <select name="propinsi_kode" id="propinsi_kode">
                                                        <option value=""><?php echo lang('SELECT');?></option>
                                                        <?php if ($propinsi):?>
                                                            <?php foreach ($propinsi as $prow):?>
                                                                <option value="<?php echo $prow->kode;?>" <?php if($prow->kode == $row->propinsi_kode)echo 'selected="selected"';?>><?php echo $prow->nama_propinsi;?></option>
                                                            <?php endforeach;?>
                                                            <?php unset($prow);?>
                                                        <?php endif;?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <label class="form-label span4" for="checkboxes">Jenis:</label>
                                                <div class="span2 controls">
                                                    <select name="jenis" id="jenis">
                                                        <?php echo $content->KotaJenisList($row->jenis); ?>
                                                    </select>							
                                                </div>
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
                                                processUpdateKota: '<?php echo Filter::$get['kode']; ?>'
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
                                
                                
                            </div><!-- End .content -->
                        </div><!-- End .box -->

                    </div><!-- End .span12 -->
                </div><!-- End .row-fluid -->  
                                                                
<?php break; ?>

    <!------------------------ add --------------------------------------------- -->


<?php case "add": ?>

                <div class="row-fluid">
                    <div class="span12">

                        <div id="msgholder"></div>
                        
                        <div class="box">                                    
                            <div class="title">
                                <h4> 
                                    <span>Tambah Kota/Kabupaten</span>
                                </h4>								
                            </div>

                            <div class="content">

                                <?php $propinsi = $content->getPropinsiList();?>

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
                                                <label class="form-label span4" for="normal">Nama Kota/Kabupaten:</label>
                                                <input type="text" class="span8 required" name="nama_kota" id="nama_kota" value=""/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <label class="form-label span4" for="checkboxes">Propinsi:</label>
                                                <div class="span8 controls">
                                                    <select name="propinsi_kode" id="propinsi_kode" >
                                                        <option value=""><?php echo lang('SELECT');?></option>
                                                        <?php if ($propinsi):?>
                                                            <?php foreach ($propinsi as $prow):?>
                                                                <option value="<?php echo $prow->kode;?>"><?php echo $prow->nama_propinsi;?></option>
                                                            <?php endforeach;?>
                                                        <?php unset($prow);?>
                                                        <?php endif;?>
                                                    </select>
                                                </div>	
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <label class="form-label span4" for="checkboxes">Jenis:</label>
                                                <div class="span2 controls">
                                                    <select name="jenis" id="jenis">
                                                        <?php echo $content->KotaJenisList(); ?>
                                                    </select>
                                                </div>	
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-info">Save</button>
                                        <button type="button" class="btn" onclick="history.back()">Kembali</button>
                                    </div>

                                    <input name="source_id" type="hidden" value="" />
                                    <input name="source_name" type="hidden" value="SIM" />
                                    <input name="userid" type="hidden" value="<?php echo $user->uid;?>" />

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
                                                processAddKota: 1
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
                                		
                            </div><!-- End .content -->
                        </div><!-- End .box -->

                    </div><!-- End .span12 -->
                </div><!-- End .row-fluid -->  
                                                                
<?php break; ?>


    <!------------------------ list ----------------------------------------------->
	

<?php default: ?>

        <?php 

            if(isset(Filter::$get['propinsi_kode']))
                $propinsi_kode = Filter::$get['propinsi_kode'];
            else
                $propinsi_kode = "";

            if(isset(Filter::$get['searchtext']))
                $searchtext = Filter::$get['searchtext'];
            else
                $searchtext = '';

            if(isset(Filter::$get['sortfield']))
                $sortfield = Filter::$get['sortfield'];
            else
                $sortfield = 'k.nama_kota';

            if(isset(Filter::$get['sorttype']))
                $sorttype = Filter::$get['sorttype'];
            else
                $sorttype = 'ASC';

            $rows = $content->getKota($propinsi_kode);

        ?>

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
                                <form id="filter_form" class="form form-horizontal" method="get" action="">
                                <fieldset>
                                    <input type="hidden" name="do" value="rujukan_kota">

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">
                                                <label class="form-label span4" for="checkboxes">Propinsi:</label>
                                                <div class="span6 controls">
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
                                            </div> <!-- end row-fluid -->
                                        </div>
                                    </div>

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">
                                                <label class="form-label span4" for="checkboxes">Search:</label>
                                                <input class="span4" type="text" name="searchtext" id="searchtext" value="<?php echo $searchtext; ?>" maxlength="50">
                                                <button type="submit" class="btn btn-info">Cari</button>
                                            </div>

                                        </div>
                                    </div>

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

                        <div id="msgholder"></div>
                        
                        <div class="box">                                    
                            <div class="title">
                                <h4>
                                    <span class="icon16 icomoon-icon-list-view-2"></span>
                                    <span>Rujukan Kota/Kabupaten</span>                                       
                                </h4>
																				
                            </div>
    
                            <div class="content">

                                <table class="responsive table table-striped table-bordered table-sorting table-condensed">

                                    <thead>
                                        <tr>
                                            <th id="k.kode" <?php
                                                if ($sortfield == "k.kode") { 
                                                    if ($sorttype == "ASC") 
                                                        echo 'class="sorting_asc"'; 
                                                    elseif ($sorttype == "DESC") 
                                                        echo 'class="sorting_desc"'; 
                                                    else 
                                                        echo 'class="sorting"'; 
                                                } else 
                                                    echo 'class="sorting"'; ?> width="50">Kode</th>
                                            <th id="k.nama_kota" <?php
                                                if ($sortfield == "k.nama_kota") { 
                                                    if ($sorttype == "ASC") 
                                                        echo 'class="sorting_asc"'; 
                                                    elseif ($sorttype == "DESC") 
                                                        echo 'class="sorting_desc"'; 
                                                    else 
                                                        echo 'class="sorting"'; 
                                                } else 
                                                    echo 'class="sorting"'; ?>>Nama Kota/Kabupaten</th>
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
                                            <th width="50">Jenis</th>
                                            <th style="<?php if(!$user->isProfileModuleExists('3', 'U')){echo 'display:none;';}?>" width="100"><button type="button" class="btn btn-mini" onclick="location.href='index.php?do=rujukan_kota&amp;action=add'"><span class="icon16 icomoon-icon-plus-2"></span>Tambah</button></th>
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
                                            <td align="center"><?php echo $row->kode;?></td>
                                            <td style="text-align: left;"><?php echo $row->nama_kota;?></td>
                                            <td style="text-align: left;"><?php echo $row->nama_propinsi;?></td>
                                            <td><?php echo $row->jenis;?></td>
                                            <td style="<?php if(!$user->isProfileModuleExists('3', 'U')){echo 'display:none;';}?>" align="center">
                                                <a href="index.php?do=rujukan_kota&amp;action=edit&amp;kode=<?php echo $row->kode;?>" title="Edit" class="tip"><span class="icon12 icomoon-icon-pencil"></span></a>
                                                <a href="javascript:void(0)" title="Hapus" class="tip doDelete" data-id="<?php echo $row->kode;?>"><span class="icon12 icomoon-icon-remove"></span></a>
                                            </td>
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

                            </div><!-- End .content -->
                        </div><!-- End .box -->

                    </div><!-- End .span12 -->
                </div><!-- End .row-fluid -->  
                                                                
                <?php echo Core::doDelete(lang('DELCONFIRM_TITLE'), "deleteKota");?>	
			
    <script type="text/javascript">

        $(document).ready(function () {

              $(".sorting, .sorting_asc, .sorting_desc").click(function(){

                    var sortfield  = $(this).attr("id");
                    var tclass =  $(this).attr("class");

                    if (tclass == "sorting_asc")
                        sorttype = "DESC"
                    else
                        sorttype = "ASC";

                    location.href = "index.php?do=rujukan_kota&sortfield=" + sortfield + "&sorttype=" + sorttype;

              });

        });		  

    </script>                                
                                                                
<?php break;?>
<?php endswitch;?>

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
