<?php
  /**
   * Main
   *
   * @package SIM PPPPTK BMTI
   * @author puspoko.ponco@gmail.com
   * @copyright 2018
   * @version $Id: report_registrasi_peserta.php (admin), v1.00 2018-02-22 10:12:05 gewa Exp $
   */
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
	  
  
?>

	<?php
        
		if(isset(Filter::$get['jadwalid']))
                    $jadwalid = Filter::$get['jadwalid'];
		else
                    $jadwalid = 0;
                
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
                    $searchfield = 'dp.nama_propinsi';

                if(isset(Filter::$get['searchtext']))
                    $searchtext = Filter::$get['searchtext'];
                else
                    $searchtext = '';

                if(isset(Filter::$get['sortfield']))
                    $sortfield = Filter::$get['sortfield'];
                else
                    $sortfield = '';

                if(isset(Filter::$get['sorttype']))
                    $sorttype = Filter::$get['sorttype'];
                else
                    $sorttype = 'ASC';

                if(isset(Filter::$get['uKota']))
                    $ukota = Filter::$get['uKota'];
                else
                    $ukota = '0';
                                
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
                    <h3>Laporan Registrasi Peserta</h3>                    
                </div><!-- End .heading-->
    				
                <!-- Build page from here: Usual with <div class="row-fluid"></div> -->

                <div class="row-fluid">
                    <div class="span12">

                        <div class="box">

                            <div class="title">
                                <h4>
                                    <span>Filter:</span>
                                </h4>
                                <a href="#" class="minimize">Minimize</a>
                            </div>

                            <div class="content">
                                <form id="filter_form" class="form-horizontal" method="get" action="">
                                <fieldset>
                                    <input type="hidden" name="do" value="report_registrasi_peserta" >
                                    
                                                                        
                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">                                                
                                                <label class="form-label span2" for="checkboxes">Jadwal Diklat:</label>
                                                <div class="span6 controls">                                                    
                                                    <?php 
                                                    
                                                        $jadwal_tgl_dari = setToSQLdate($jadwal_tgl_dari);
                                                        $jadwal_tgl_sampai = setToSQLdate($jadwal_tgl_sampai);
                                                        $jadwal = $content->getDiklat_JadwalList($jadwal_tgl_dari, $jadwal_tgl_sampai);
                                                        
                                                    ?>                                                    
                                                    <select name="jadwalid" style="width:100%;" placeholder="Select...">
                                                        <option value="0"><?php echo lang('SELECT_ALL');?></option>
                                                        <?php if ($jadwal):?>
                                                            <?php foreach ($jadwal as $prow):?>
                                                                <option value="<?php echo $prow->id;?>" <?php if($prow->id == $jadwalid)echo 'selected="selected"';?>><?php echo $prow->nama_diklat." -- Kelas ".$prow->kelas;?></option>
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
                                                <label class="form-label span2" for="checkboxes">Propinsi:</label>
                                                <div class="control form-inline">
                                                    <div class="span4">
                                                        <?php $propinsi = $content->getPropinsiList();?>						
                                                        <select name="propinsi_kode" id="propinsi_kode" style="width:100%;" placeholder="Select...">
                                                            <option value=""><?php echo lang('SELECT');?></option>
                                                            <?php if ($propinsi):?>
                                                                <?php foreach ($propinsi as $prow):?>
                                                                    <option value="<?php echo $prow->kode;?>" <?php if($prow->kode == $propinsi_kode)echo 'selected="selected"';?>><?php echo $prow->nama_propinsi;?></option>
                                                                <?php endforeach;?>
                                                                <?php unset($prow);?>
                                                            <?php endif;?>						
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">
                                                <div class="form-inline">
                                                    <label class="span2" ></label>
                                                    <div class="span4">
                                                        <button type="submit" class="btn btn-info">Cari</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <input type="hidden" name="sortfield" id="sortfield" value="<?php echo $sortfield; ?>" >
                                    <input type="hidden" name="sorttype" id="sorttype" value="<?php echo $sorttype; ?>" >
                                    <input type="hidden" name="uKota" name="uKota" value="<?php echo $ukota; ?>" >
                                                                        
                                </fieldset>
                                </form>								
                            </div>

                        </div><!-- End filter .box -->

                        <?php //$rows = $content->getRegAwalDiklat_Peserta($jadwalid);?>

                        <div class="box">


                             <!-- <div class="row-fluid"> -->

                    <div class="span12">
                        
                        
                        <div id="msgholder"></div>

                        <?php $rows = $content->getRegAwalDiklat_Peserta($jadwalid,0);?>

                        <div class="box">
                            <div class="title">
                                <h4>
                                    <span class="icon16 icomoon-icon-file"></span>
                                    <span>Data Registrasi Peserta Diklat</span>                                       

                                    <div class="right">
                                        <a href="controller_report.php?action=createReportRegistrasiDiklat<?php echo '&amp;jadwalid='.$jadwalid.'&amp;propinsi_kode='.$propinsi_kode.'&amp;kota_kode='.$kota_kode.'&amp;searchfield='.$searchfield.'&amp;uKota='.$ukota ?>" class="tip" title="Export"><span class="icon16 icomoon-icon-file-excel"></span></a>
                                        <!-- <a href="controller_print.php?action=createPrintRegistrasiDiklat<?php echo '&amp;jadwalid='.$jadwalid.'&amp;propinsi_kode='.$propinsi_kode.'&amp;kota_kode='.$kota_kode.'&amp;searchfield='.$searchfield.'&amp;uKota='.$ukota ?>" class="tip" title="Print" target="_blank"><span class="icon24 icomoon-icon-printer-2"></span></a> -->
                                    </div>
                                                                       
                                </h4>
                            </div>

                            <div class="content">

                                <table class="responsive table table-striped table-bordered table-sorting table-condensed">

                                    <thead>
                                        <tr>
                                            <tr><th colspan="2">Statistik Berdasarkan Propinsi</th></tr>
                                            <input type="hidden" name="uKota" value="0" >
                                            <th width="50%" id="p.nama_propinsi" <?php 
                                                if ($sortfield == "p.nama_propinsi") { 
                                                    if ($sorttype == "ASC") 
                                                        echo 'class="sorting_asc"'; 
                                                    elseif ($sorttype == "DESC") 
                                                        echo 'class="sorting_desc"'; 
                                                    else echo 'class="sorting"'; 
                                                } else 
                                                    echo 'class="sorting"'; ?>>Propinsi</th>

                                            <th width="50%" id="total" <?php 
                                                if ($sortfield == "total") { 
                                                    if ($sorttype == "ASC") 
                                                        echo 'class="sorting_asc"'; 
                                                    elseif ($sorttype == "DESC") 
                                                        echo 'class="sorting_desc"'; 
                                                    else echo 'class="sorting"'; 
                                                } else 
                                                    echo 'class="sorting"'; ?>>Jumlah Peserta</th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                    <?php if(!$rows):?>
                                        <tr>
                                            <td colspan="<?php if ($jadwalid != 0) echo "4"; else echo "3"; ?>"><?php echo Filter::msgInfo(lang('NO_DATA'), false);?></td>
                                        </tr>

                                    <?php else:?>
                                    <?php 
                                    

                                        foreach ($rows as $row):?>

                                            <tr>
                                                <td style="text-align: left;"><?php echo $row->nama_propinsi;?></td>
                                                <!--  <?php if($kota_kode != ''){ ?>
                                                <td align="center"><?php echo $row->nama_kota;?></td>
                                                <?php }; ?> -->
                                                <td style="text-align: center;"><?php echo $row->total;?></td>

                                                <?php 

                                                $regawal = '';
                                                $regulang = '';


                                                if(strtotime($row->reg_awal) !='')
                                                    $regawal=date("d/m/Y",strtotime($row->reg_awal));
                                                if(strtotime($row->reg_ulang) !='')
                                                    $regulang=date("d/m/Y",strtotime($row->reg_ulang));
                                                 ?>

                                            </tr>

                                    <?php endforeach;?>
                                    <?php unset($row);?>
                                    <?php endif;?>                  

                                    </tbody>

                                    <tfoot>
                                        <tr>
                                            <td colspan="<?php if ($jadwalid != 0) echo "10"; else echo "9"; ?>">
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

                        
                        
<!--                     </div>End .span12
                    <div class="span12"> -->


                        <table class="responsive table table-striped table-bordered table-sorting table-condensed">

                            <thead>
                                <tr><th colspan="2"><br></th></tr>

                            </thead>
                        </table>
                        
                        <div id="msgholder"></div>

                        <?php $rows = $content->getRegAwalDiklat_Peserta($jadwalid,1);?>

                        <table class="responsive table table-striped table-bordered table-sorting table-condensed">

                            <thead>
                                <tr><th colspan="3">Statistik Berdasarkan Kota</th></tr>
                                <tr>
                                    <!-- <th>Propinsi</th> -->
                                    <input type="hidden" name="uKota" value="1" >
                                    <th width="33%" id="k.nama_kota" data-ukota = "1" <?php 
                                        if ($sortfield == "k.nama_kota") { 
                                            if ($sorttype == "ASC") 
                                                echo 'class="sorting_asc"'; 
                                            elseif ($sorttype == "DESC") 
                                                echo 'class="sorting_desc"'; 
                                            else echo 'class="sorting"'; 
                                        } else 
                                            echo 'class="sorting"'; ?>>Kota</th>

                                    <th width="33%" id="p.nama_propinsi" data-ukota = "1" <?php 
                                        if ($sortfield == "p.nama_propinsi") { 
                                            if ($sorttype == "ASC") 
                                                echo 'class="sorting_asc"'; 
                                            elseif ($sorttype == "DESC") 
                                                echo 'class="sorting_desc"'; 
                                            else echo 'class="sorting"'; 
                                        } else 
                                            echo 'class="sorting"'; ?>>Propinsi</th>

                                    <th width="33%" id="jumTot" data-ukota = "1" <?php 
                                        if ($sortfield == "total") { 
                                            if ($sorttype == "ASC") 
                                                echo 'class="sorting_asc"'; 
                                            elseif ($sorttype == "DESC") 
                                                echo 'class="sorting_desc"'; 
                                            else echo 'class="sorting"'; 
                                        } else 
                                            echo 'class="sorting"'; ?>>Jumlah Peserta</th>
                                </tr>
                            </thead>

                            <tbody>

                            <?php if(!$rows):?>
                                <tr>
                                    <td colspan="<?php if ($jadwalid != 0) echo "5"; else echo "4"; ?>"><?php echo Filter::msgInfo(lang('NO_DATA'), false);?></td>
                                </tr>

                            <?php else:?>
                            <?php foreach ($rows as $row):?>

                                    <tr>
                                        
                                        <td style="text-align: left;"><?php echo $row->nama_kota;?></td>
                                        <td style="text-align: left;"><?php echo $row->nama_propinsi;?></td>
                                        <td align="center"><?php echo $row->total;?></td>

                                        <?php 

                                        $regawal = '';
                                        $regulang = '';


                                        if(strtotime($row->reg_awal) !='')
                                            $regawal=date("d/m/Y",strtotime($row->reg_awal));
                                        if(strtotime($row->reg_ulang) !='')
                                            $regulang=date("d/m/Y",strtotime($row->reg_ulang));
                                         ?>

                                    </tr>

                            <?php endforeach;?>
                            <?php unset($row);?>
                            <?php endif;?>                  

                            </tbody>

                            <tfoot>
                                <tr>
                                    <td colspan="<?php if ($jadwalid != 0) echo "10"; else echo "9"; ?>">
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

                        </div>

                        </div><!-- End .box -->

                        </div><!-- End .box -->
                        
                    </div><!-- End .span12 -->
                </div><!-- End .row-fluid -->  

            </div><!-- End contentwrapper -->
        </div><!-- End #content -->
    
    </div><!-- End #wrapper -->

    <script type="text/javascript">

        $(document).ready(function () {

              $("#propinsi_kode").change(function() {

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

              $(".sorting, .sorting_asc, .sorting_desc").click(function(){

                  var sortfield  = $(this).attr("id");
                  var tclass =  $(this).attr("class");
                  var dukota = $(this).attr("data-ukota");


                  if (tclass == "sorting_asc")
                    sorttype = "DESC"
                  else
                    sorttype = "ASC";

                  $('input[name=sortfield]').val(sortfield);
                  $('input[name=sorttype]').val(sorttype);
                  $('input[name=uKota]').val(dukota);
                  


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
