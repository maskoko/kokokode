<?php
  /**
   * Main
   *
   * @package SIM PPPPTK BMTI
   * @author a2ngsa
   * @copyright 2012
   * @version $Id: diklat_jadwal.php (admin), v1.00 2011-06-05 10:12:05 gewa Exp $
   */
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
	  
  
?>

    <script type="text/javascript" src="js/diklat_jadwal.js"></script>

        <!--Body content-->
        <div id="content" class="clearfix">
            <div class="contentwrapper"><!--Content wrapper-->

                <div class="heading">

                    <h3>Jadwal Diklat</h3>                    

                </div><!-- End .heading-->
    				
                <!-- Build page from here: Usual with <div class="row-fluid"></div> -->

                <div class="row-fluid">
                    <div class="span12">

<?php switch(Filter::$action): case "edit": ?>

	<?php include ("diklat_jadwal_edit.php"); ?>

<?php break; ?>

    <!------------------------ add ----------------------------------------------->


<?php case "add": ?>

	<?php include ("diklat_jadwal_add.php"); ?>

<?php break; ?>


    <!------------------------ list ----------------------------------------------->
	

<?php default: ?>

	<?php
        
            if(isset(Filter::$get['departemenid']))
                $departemenid = Filter::$get['departemenid'];
            else
                $departemenid = 0;
          
            if(isset(Filter::$get['searchfield']))
                $searchfield = Filter::$get['searchfield'];
            else
                $searchfield = 'd.nama_diklat';
                
            if(isset(Filter::$get['searchtext']))
                $searchtext = Filter::$get['searchtext'];
            else
                $searchtext = '';
                
            if(isset(Filter::$get['sortfield']))
                $sortfield = Filter::$get['sortfield'];
            else
                $sortfield = 'dj.tgl_mulai';

            if(isset(Filter::$get['sorttype']))
                $sorttype = Filter::$get['sorttype'];
            else
                $sorttype = 'DESC';
                        
            //if(isset($_COOKIE['jadwal_tgl_dari']))
            if(isset(Filter::$get['jadwal_tgl_dari']))
                $jadwal_tgl_dari = Filter::$get['jadwal_tgl_dari'];  //$_COOKIE['jadwal_tgl_dari'];
            else {
                $year = date('Y');
                $tgl_dari = mktime(0, 0, 0, 1, 1,  $year - 1);
                $jadwal_tgl_dari = date('d/m/Y', $tgl_dari);                    
            }

            //if(isset($_COOKIE['jadwal_tgl_sampai'])) { 
            if(isset(Filter::$get['jadwal_tgl_sampai'])) { 
                $jadwal_tgl_sampai = Filter::$get['jadwal_tgl_sampai'];
            } else {                                        
                //if(isset($_COOKIE['jadwal_tgl_dari'])) { 
                if(isset(Filter::$get['jadwal_tgl_sampai'])) { 
                    $jadwal_tgl_sampai = Filter::$get['jadwal_tgl_sampai'];
                } else {
                    $year = date('Y');
                    $tgl_sampai = mktime(0, 0, 0, 12, 31,  $year);
                    $jadwal_tgl_sampai = date('d/m/Y', $tgl_sampai);
                }
            }
                                
	?>
        
                        <div class="box">

                            <div class="title">
                                <h4>
                                    <span>Filter: </span>
                                </h4>
                                <a href="#" class="minimize">Minimize</a>
                            </div>
                            
                            <div class="content">
                                <form id="filter_form" class="form-horizontal" method="get" action="">
                                <fieldset>
                                    <input type="hidden" name="do" value="diklat_jadwal">
                                    
                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">
                                                <label class="form-label span2" for="checkboxes">Departemen:</label>
                                                <div class="span8 controls">
                                                    <?php $departemen = $content->getDepartemenList();?>						
                                                    <select name="departemenid" style="width:100%;" placeholder="Select...">
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
                                    
                                   <div class="form-row row-fluid">
                                       <div class="span12">
                                           <div class="row-fluid">
                                                <label class="form-label span2" for="normal">Periode:</label>
                                                <input type="text" class="span2 datepickerField" name="jadwal_tgl_dari" id="jadwal_tgl_dari" value="<?php echo $jadwal_tgl_dari;?>"/>&nbsp;-&nbsp;
                                                <input type="text" class="span2 datepickerField" name="jadwal_tgl_sampai" id="jadwal_tgl_sampai" value="<?php echo $jadwal_tgl_sampai;?>"/>
                                           </div> <!-- end row-fluid -->
                                       </div>                                                                              
                                   </div>
                                                                        
                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">
                                                <label class="form-label span2" for="checkboxes">Search:</label>
                                                <div class="span2 controls"> 
                                                     <select name="searchfield" id="searchfield" placeholder="Select..." style="width: 100%;">
                                                         <option value="nama_diklat" <?php if($searchfield == 'nama_diklat') echo 'selected="selected"';?>>Nama Diklat</option>
                                                         <option value="kode" <?php if($searchfield == 'kode') echo 'selected="selected"';?>>Kode Diklat</option>
                                                     </select>
                                                 </div>
                                                
                                                <label class="form-label span2" for="checkboxes">Teks:</label>
                                                <input class="span4" type="text" name="searchtext" id="searchtext" value="<?php echo $searchtext; ?>" maxlength="50">
                                                <button type="submit" class="btn btn-info">Cari</button>                                                                                                                                                                                                
                                            </div> <!-- end .row-fluid -->
                                        </div>
                                    </div>
                                                                        
                                    <input type="hidden" name="sortfield" id="sortfield" value="<?php echo $sortfield; ?>" >
                                    <input type="hidden" name="sorttype" id="sorttype" value="<?php echo $sorttype; ?>" >                                    
                                </fieldset>
                                </form>																
                            </div>

                        </div><!-- End .box -->
                        
                    </div><!-- End .span12 -->
                </div><!-- End .row-fluid -->  

                <div class="row-fluid">
                    <div class="span12">

                        <div id="msgholder"></div>
                        
                        <?php 
                        
                            $jadwal_tgl_dari = setToSQLdate($jadwal_tgl_dari);
                            $jadwal_tgl_sampai = setToSQLdate($jadwal_tgl_sampai);
                            $rows = $content->getDiklat_Jadwal($jadwal_tgl_dari, $jadwal_tgl_sampai, $departemenid);
                            
                        ?>
                                                
                        <table class="responsive table table-striped table-bordered table-sorting table-condensed">

                            <thead>
                                <tr>
                                    <th id="dk.kode" <?php
                                        if ($sortfield == "dk.kode") { 
                                            if ($sorttype == "ASC") 
                                                echo 'class="sorting_asc"'; 
                                            elseif ($sorttype == "DESC") 
                                                echo 'class="sorting_desc"'; 
                                            else 
                                                echo 'class="sorting"'; 
                                        } else 
                                            echo 'class="sorting"'; ?> width="50">Kode</th>
                                    <th id="dk.nama_diklat" <?php
                                        if ($sortfield == "dk.nama_diklat") { 
                                            if ($sorttype == "ASC") 
                                                echo 'class="sorting_asc"'; 
                                            elseif ($sorttype == "DESC") 
                                                echo 'class="sorting_desc"'; 
                                            else 
                                                echo 'class="sorting"'; 
                                        } else 
                                            echo 'class="sorting"'; ?>>Nama Diklat</th>
                                    <th width="50">Tingkat</th>
                                    <th width="50">Tahun</th>
                                    <th id="dj.tgl_mulai" <?php
                                        if ($sortfield == "dj.tgl_mulai") { 
                                            if ($sorttype == "ASC") 
                                                echo 'class="sorting_asc"'; 
                                            elseif ($sorttype == "DESC") 
                                                echo 'class="sorting_desc"'; 
                                            else 
                                                echo 'class="sorting"'; 
                                        } else 
                                            echo 'class="sorting"'; ?> width="75">Tgl Mulai</th>
                                    <th id="dj.tgl_akhir" <?php
                                        if ($sortfield == "dj.tgl_akhir") { 
                                            if ($sorttype == "ASC") 
                                                echo 'class="sorting_asc"'; 
                                            elseif ($sorttype == "DESC") 
                                                echo 'class="sorting_desc"'; 
                                            else 
                                                echo 'class="sorting"'; 
                                        } else 
                                            echo 'class="sorting"'; ?> width="75">Tgl Akhir</th>
                                    <th>Departemen</th>
                                    <th width="100"><button type="button" class="btn btn-mini" onclick="location.href='index.php?do=diklat_jadwal&amp;action=add'"><span class="icon16 icomoon-icon-plus-2"></span>Tambah</button></th>
                                </tr>
                            </thead>

                            <tbody>

                            <?php if(!$rows):?>
                                <tr>
                                    <td colspan="8"><?php echo Filter::msgInfo(lang('NO_DATA'), false);?></td>
                                </tr>

                            <?php else:?>
                            <?php foreach ($rows as $row):?>

                                <tr>
                                    <td align="center"><?php echo $row->kode;?></td>
                                    <td style="text-align: left;"><?php echo $row->nama_diklat;?></td>
                                    <td><?php echo $row->tingkat;?></td>
                                    <td><?php echo $row->tahun;?></td>
                                    <td><?php echo $row->tgl_mulai;?></td>
                                    <td><?php echo $row->tgl_akhir;?></td>
                                    <td style="text-align: left;"><?php echo $row->nama_departemen;?></td>
                                    <td class="actBtns">
                                        <a href="index.php?do=diklat_jadwal&amp;action=edit&amp;id=<?php echo $row->id;?>" title="" class="tip"><span class="icon12 icomoon-icon-pencil"></span></a>
                                        <a href="javascript:void(0)" title="Hapus" class="tip doDelete" data-id="<?php echo $row->id;?>"><span class="icon12 icomoon-icon-remove"></span></a>
                                    </td>
                                </tr>

                            <?php endforeach;?>
                            <?php unset($row);?>
                            <?php endif;?>					

                            </tbody>

                            <tfoot>
                                <tr>
                                    <td colspan="8">
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
            	
                <?php echo Core::doDelete(lang('DELCONFIRM_TITLE'), "deleteDiklat_Jadwal");?>

<?php break;?>
<?php endswitch;?>

                    </div><!-- End .span12 -->
                </div><!-- End .row-fluid -->  

            </div><!-- End contentwrapper -->
        </div><!-- End #content -->
    
    </div><!-- End #wrapper -->

    <script type="text/javascript">

              $(document).ready(function () {

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
    <script type="text/javascript" src="plugins/forms/select/select2.min.js"></script>
            
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
