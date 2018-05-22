<?php
  /**
   * Main
   *
   * @package SIM PPPTK BMTI
   * @author a2ngsa
   * @copyright 2012
   * @version $Id: rujukan_kk.php (admin), v1.00 2011-06-05 10:12:05 gewa Exp $
   */
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
	  
  
?>

        <!--Body content-->
        <div id="content" class="clearfix">
            <div class="contentwrapper"><!--Content wrapper-->

                <div class="heading">
                    <h3>Rujukan - Paket Keahlian</h3>                    
                </div><!-- End .heading-->
    				
                <!-- Build page from here: Usual with <div class="row-fluid"></div> -->


<?php switch(Filter::$action): case "edit": ?>

                <div class="row-fluid">
                    <div class="span12">

                        <div id="msgholder"></div>
                                                
                        <div class="box">
                                
                            <div class="title">
                                <h4> 
                                    <span>Edit Rujukan - Paket Keahlian</span>
                                </h4>								
                            </div>

                            <div class="content">

                                <?php 
                                    
                                    $row = Core::getRowById("kk", Filter::$id);
                                    $psk = $content->getPSKList();
                                    $departemen = $content->getDepartemenList();
                                    
                                ?>
			
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
                                                <label class="form-label span4" for="normal">Nama Paket Keahlian:</label>
                                                <input type="text" class="span8 required" name="nama_kompetensi" id="nama_kompetensi" value="<?php echo $row->nama_kompetensi;?>"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <label class="form-label span4" for="checkboxes">Program Keahlian:</label>
                                                <div class="span8 controls">
                                                    <select name="pskid" id="pskid">
                                                        <option value=""><?php echo lang('SELECT');?></option>
                                                        <?php if ($psk):?>
                                                            <?php foreach ($psk as $prow):?>
                                                                <option value="<?php echo $prow->id;?>" <?php if($prow->id == $row->pskid)echo 'selected="selected"';?>><?php echo $prow->nama_program;?></option>
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
                                                <label class="form-label span4" for="checkboxes">Departemen:</label>
                                                <div class="span8 controls">
                                                    <select name="departemenid" id="departemenid">
                                                        <option value=""><?php echo lang('SELECT');?></option>
                                                        <?php if ($departemen):?>
                                                            <?php foreach ($departemen as $prow):?>
                                                                <option value="<?php echo $prow->id;?>" <?php if($prow->id == $row->departemenid)echo 'selected="selected"';?>><?php echo $prow->nama_departemen;?></option>
                                                            <?php endforeach;?>
                                                            <?php unset($prow);?>
                                                        <?php endif;?>
                                                    </select>						
                                                </div>
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

                                <?php echo Core::doForm("processKK"); ?> 	

                            </div> <!-- end .content -->

                        </div><!-- End .box -->

                    </div><!-- End .span12 -->
                </div><!-- End .row-fluid -->  
                                                                
<?php break; ?>

    <!------------------------ add ----------------------------------------------->


<?php case "add": ?>

                <div class="row-fluid">
                    <div class="span12">

                        <div id="msgholder"></div>
                        
                        <div class="box">
    
                            <div class="title">
                                <h4> 
                                    <span>Tambah Rujukan - Paket Keahlian</span>
                                </h4>								
                            </div>

                            <div class="content">

                                <?php 
                                
                                    $psk = $content->getPSKList();                                
                                    $departemen = $content->getDepartemenList();
                                    
                                ?>

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
                                                <label class="form-label span4" for="normal">Nama Paket Keahlian:</label>
                                                <input type="text" class="span8 required" name="nama_kompetensi" id="nama_kompetensi" value=""/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <label class="form-label span4" for="checkboxes">Program Keahlian:</label>
                                                <div class="span8 controls">
                                                    <select name="pskid" id="pskid">
                                                        <option value=""><?php echo lang('SELECT');?></option>
                                                        <?php if ($psk):?>
                                                            <?php foreach ($psk as $prow):?>
                                                                <option value="<?php echo $prow->id;?>"><?php echo $prow->nama_program;?></option>
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
                                                <label class="form-label span4" for="checkboxes">Departemen:</label>
                                                <div class="span8 controls">
                                                    <select name="departemenid" id="departemenid">
                                                        <option value=""><?php echo lang('SELECT');?></option>
                                                        <?php if ($departemen):?>
                                                            <?php foreach ($departemen as $prow):?>
                                                                <option value="<?php echo $prow->id;?>"><?php echo $prow->nama_departemen;?></option>
                                                            <?php endforeach;?>
                                                            <?php unset($prow);?>
                                                        <?php endif;?>
                                                    </select>						
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                                                        
                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-info">Save</button>
                                        <button type="button" class="btn" onclick="history.back()">Kembali</button>
                                    </div>

                                    <input name="userid" type="hidden" value="<?php echo $user->uid;?>" />
                                </fieldset>
                                </form>       

                                <?php echo Core::doForm("processKK"); ?>
			
                            </div> <!-- end .content -->

                        </div><!-- End .box -->

                    </div><!-- End .span12 -->
                </div><!-- End .row-fluid -->  
                                
<?php break; ?>


    <!------------------------ list ----------------------------------------------->
	

<?php default: ?>

	<?php		
        
            if(isset(Filter::$get['bskid']))
                $bskid = Filter::$get['bskid'];
            else
                $bskid = 0;

            if(isset(Filter::$get['pskid']))
                $pskid = Filter::$get['pskid'];
            else
                $pskid = 0;
                        
            if(isset(Filter::$get['searchtext']))
                $searchtext = Filter::$get['searchtext'];
            else
                $searchtext = '';
                		
            if(isset(Filter::$get['sortfield']))
                $sortfield = Filter::$get['sortfield'];
            else
                $sortfield = 'k.nama_kompetensi';

            if(isset(Filter::$get['sorttype']))
                $sorttype = Filter::$get['sorttype'];
            else
                $sorttype = 'ASC';
                        
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
                                    <input type="hidden" name="do" value="rujukan_kk">

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">
                                                <label class="form-label span4" for="checkboxes">Bidang Keahlian:</label>
                                                <div class="span6 controls">
                                                    <?php $bsk = $content->getBSKList();?>
                                                    <select name="bskid" id="bskid" style="width:100%;" placeholder="Select...">
                                                        <option value="0"><?php echo lang('SELECT');?></option>
                                                        <?php if ($bsk):?>
                                                            <?php foreach ($bsk as $prow):?>
                                                                <option value="<?php echo $prow->id;?>" <?php if($prow->id == $bskid)echo 'selected="selected"';?>><?php echo $prow->nama_bidang;?></option>
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
                                                <label class="form-label span4" for="checkboxes">Program Keahlian:</label>
                                                <div class="span6 controls">
                                                    <?php if ($bskid > 0) $psk = $content->getPSKList($bskid); else $psk = null; ?>
                                                    <select name="pskid" id="pskid" style="width:100%;" placeholder="Select...">
                                                        <option value="0"><?php echo lang('SELECT_ALL');?></option>
                                                        <?php if ($psk):?>
                                                            <?php foreach ($psk as $prow):?>
                                                                <option value="<?php echo $prow->id;?>" <?php if($prow->id == $pskid)echo 'selected="selected"';?>><?php echo $prow->nama_program;?></option>
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
    
                            <?php $rows = $content->getKK($pskid);?>
        
                            <div class="title">
                                <h4>
                                    <span class="icon16 icomoon-icon-list-view-2"></span>
                                    <span>Rujukan - Paket Keahlian</span>                                       
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
                                            <th id="p.nama_program" <?php
                                                if ($sortfield == "p.nama_program") { 
                                                    if ($sorttype == "ASC") 
                                                        echo 'class="sorting_asc"'; 
                                                    elseif ($sorttype == "DESC") 
                                                        echo 'class="sorting_desc"'; 
                                                    else 
                                                        echo 'class="sorting"'; 
                                                } else 
                                                    echo 'class="sorting"'; ?>>Program Keahlian</th>
                                            <th id="k.nama_kompetensi" <?php
                                                if ($sortfield == "k.nama_kompetensi") { 
                                                    if ($sorttype == "ASC") 
                                                        echo 'class="sorting_asc"'; 
                                                    elseif ($sorttype == "DESC") 
                                                        echo 'class="sorting_desc"'; 
                                                    else 
                                                        echo 'class="sorting"'; 
                                                } else 
                                                    echo 'class="sorting"'; ?>>Paket Keahlian</th>
                                            <th id="d.nama_departemen" <?php
                                                if ($sortfield == "d.nama_departemen") { 
                                                    if ($sorttype == "ASC") 
                                                        echo 'class="sorting_asc"'; 
                                                    elseif ($sorttype == "DESC") 
                                                        echo 'class="sorting_desc"'; 
                                                    else 
                                                        echo 'class="sorting"'; 
                                                } else 
                                                    echo 'class="sorting"'; ?>>Departemen</th>
                                            <th style="<?php if(!$user->isProfileModuleExists('3', 'U')){echo 'display:none;';}?>" width="100"><button type="button" class="btn btn-mini" onclick="location.href='index.php?do=rujukan_kk&amp;action=add'"><span class="icon16 icomoon-icon-plus-2"></span>Tambah</button></th>
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
                                            <td style="text-align: left;"><?php echo $row->nama_program;?></td>
                                            <td style="text-align: left;"><?php echo $row->nama_kompetensi;?></td>
                                            <td style="text-align: left;"><?php echo $row->nama_departemen;?></td>
                                            <td style="<?php if(!$user->isProfileModuleExists('3', 'U')){echo 'display:none;';}?>" align="center">
                                                <a href="index.php?do=rujukan_kk&amp;action=edit&amp;id=<?php echo $row->id;?>" title="Edit" class="tip"><span class="icon12 icomoon-icon-pencil"></span></a>
                                                <a href="javascript:void(0)" title="Hapus" class="tip doDelete" data-id="<?php echo $row->id;?>"><span class="icon12 icomoon-icon-remove"></span></a>
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

                            <?php echo Core::doDelete(lang('DELCONFIRM_TITLE'), "deleteKK");?>	

                            </div> <!-- end .content -->

                        </div><!-- End .box -->

                    </div><!-- End .span12 -->
                </div><!-- End .row-fluid -->  
                                
    <script type="text/javascript">

        $(document).ready(function () {

            $("#bskid").change(function() {
                
                var id = $("#bskid").val();

                $.ajax({
                        type: 'post',
                        url: "controller.php",
                        data: "loadPSKList=" + id,
                        cache: false,
                        success: function(html){
                                $("#pskid").html(html); 
                        }
                });

                $("#pskid").val("");

                $.uniform.update("#pskid");

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
