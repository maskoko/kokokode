<?php
  /**
   * Main
   *
   * @package SIM PPPPTK BMTI
   * @author a2ngsa
   * @copyright 2012
   * @version $Id: diklat_peserta.php, v1.00 2011-06-05 10:12:05 gewa Exp $
   */
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
	    
?>

<script type="text/javascript" src="js/diklat_peserta.js"></script>

        <!--Body content-->
        <div id="content" class="clearfix">
            <div class="contentwrapper"><!--Content wrapper-->

                <div class="heading">
                    <h3>Data Peserta Diklat</h3>                    
                </div><!-- End .heading-->
    				
                <!-- Build page from here: Usual with <div class="row-fluid"></div> -->
							
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
                $searchfield = 'nama';
                
            if(isset(Filter::$get['searchtext']))
                $searchtext = Filter::$get['searchtext'];
            else
                $searchtext = '';
                
            if(isset(Filter::$get['sortfield']))
                $sortfield = Filter::$get['sortfield'];
            else
                $sortfield = 'dp.nama_lengkap';

            if(isset(Filter::$get['sorttype']))
                $sorttype = Filter::$get['sorttype'];
            else
                $sorttype = 'ASC';

            if(isset(Filter::$get['jadwal_tgl_dari']))
                $jadwal_tgl_dari = Filter::$get['jadwal_tgl_dari'];
            else {
                $year = date('Y');
                $tgl_dari = mktime(0, 0, 0, 1, 1,  $year - 2);
                $jadwal_tgl_dari = date('d/m/Y', $tgl_dari);                    
            }

            if(isset(Filter::$get['jadwal_tgl_sampai'])) { 
                $jadwal_tgl_sampai = Filter::$get['jadwal_tgl_sampai'];
            } else {                                        
                if(isset(Filter::$get['jadwal_tgl_dari'])) { 
                    $jadwal_tgl_sampai = Filter::$get['jadwal_tgl_dari'];
                } else {
                    $year = date('Y');
                    $tgl_sampai = mktime(0, 0, 0, 12, 31,  $year );
                    $jadwal_tgl_sampai = date('d/m/Y', $tgl_sampai);
                }
            }            
            
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
                                    <input type="hidden" name="do" value="diklat_peserta">

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">
                                                <label class="form-label span2" for="normal">Periode Diklat:</label>
                                                <input type="text" class="span2 datepickerField" name="jadwal_tgl_dari" id="jadwal_tgl_dari" value="<?php echo $jadwal_tgl_dari;?>"/>&nbsp;-&nbsp;
                                                <input type="text" class="span2 datepickerField" name="jadwal_tgl_sampai" id="jadwal_tgl_sampai" value="<?php echo $jadwal_tgl_sampai;?>"/>
                                            </div> <!-- end row-fluid -->
                                        </div>
                                     </div>

                                     <div class="form-row row-fluid">
                                         <div class="span12">
                                             <div class="row-fluid">                                                
                                                 <label class="form-label span2" for="checkboxes">Jadwal Diklat:</label>
                                                 <div class="span8 controls">                                                     
                                                     <?php 
                                                     
                                                        $jadwal_tgl_dari = setToSQLdate($jadwal_tgl_dari);
                                                        $jadwal_tgl_sampai = setToSQLdate($jadwal_tgl_sampai);
                                                        $jadwal = $content->getDiklat_JadwalList($jadwal_tgl_dari, $jadwal_tgl_sampai);
                                                        
                                                    ?>
                                                     <select name="jadwalid" style="width:100%;" placeholder="Select...">
                                                         <option value="0"><?php echo lang('SELECT_ALL');?></option>
                                                         <?php if ($jadwal):?>
                                                             <?php foreach ($jadwal as $prow):?>
                                                                 <option value="<?php echo $prow->id;?>" <?php if($prow->id == $jadwalid)echo 'selected="selected"';?>><?php echo $prow->nama_diklat;?></option>
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
                                                     
                                                    <label class="form-label span2" for="checkboxes">Kota/Kab:</label>
                                                    <div class="span4">
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
                                                </div>
                                            </div>
                                        </div>
                                     </div>

                                     <div class="form-row row-fluid">
                                         <div class="span12">
                                             <div class="row-fluid">
                                                <label class="form-label span2" for="checkboxes">Search:</label>
                                                <div class="span2 controls">
                                                    <select name="searchfield" id="searchfield" placeholder="Select..." style="width: 100%;">
                                                        <option value="dp.nama_lengkap" <?php if($searchfield == 'dp.nama_lengkap') echo 'selected="selected"';?>>Nama</option>
                                                        <option value="dp.nip" <?php if($searchfield == 'dp.nip') echo 'selected="selected"';?>>NIP</option>
                                                        <option value="dp.nuptk" <?php if($searchfield == 'dp.nuptk') echo 'selected="selected"';?>>NUPTK</option>
                                                        <option value="dp.nama_sekolah" <?php if($searchfield == 'dp.nama_sekolah') echo 'selected="selected"';?>>Nama Sekolah</option>
                                                    </select>
                                                </div>
                                                
                                                <label class="form-label span2" for="searchtext">Teks:</label>
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

                <?php $rows = $content->getDiklat_Peserta($jadwalid, "P"); ?>
                
                <div class="row-fluid">
                    <div class="span12">

                        <table class="responsive table table-bordered table-striped table-sorting table-condensed">

                            <thead>
                                <tr>
                                    <th id="dp.nuptk" <?php
                                        if ($sortfield == "dp.nuptk") { 
                                            if ($sorttype == "ASC") 
                                                echo 'class="sorting_asc"'; 
                                            elseif ($sorttype == "DESC") 
                                                echo 'class="sorting_desc"'; 
                                            else 
                                                echo 'class="sorting"'; 
                                        } else 
                                            echo 'class="sorting"'; ?> width="70">NUPTK</th>
                                    <th id="dp.nama_lengkap" <?php 
                                        if ($sortfield == "dp.nama_lengkap") { 
                                            if ($sorttype == "ASC") 
                                                echo 'class="sorting_asc"'; 
                                            elseif ($sorttype == "DESC") 
                                                echo 'class="sorting_desc"'; 
                                            else echo 'class="sorting"'; 
                                        } else 
                                            echo 'class="sorting"'; ?>>Nama Lengkap</th>
                                    <th id="dp.nama_sekolah" <?php 
                                        if ($sortfield == "dp.nama_sekolah") { 
                                            if ($sorttype == "ASC") 
                                                echo 'class="sorting_asc"'; 
                                            elseif ($sorttype == "DESC") 
                                                echo 'class="sorting_desc"'; 
                                            else echo 'class="sorting"'; 
                                        } else 
                                            echo 'class="sorting"'; ?>>Sekolah</th>
                                    <th>Propinsi</th>
                                    <th>Kota</th>
                                    <th id="dk.nama_diklat" <?php 
                                        if ($sortfield == "dk.nama_diklat") { 
                                            if ($sorttype == "ASC") 
                                                echo 'class="sorting_asc"'; 
                                            elseif ($sorttype == "DESC") 
                                                echo 'class="sorting_desc"'; 
                                            else echo 'class="sorting"'; 
                                        } else 
                                            echo 'class="sorting"'; ?>>Diklat</th>
                                    <th id="dj.tahun" <?php 
                                        if ($sortfield == "dj.tahun") { 
                                            if ($sorttype == "ASC") 
                                                echo 'class="sorting_asc"'; 
                                            elseif ($sorttype == "DESC") 
                                                echo 'class="sorting_desc"'; 
                                            else echo 'class="sorting"'; 
                                        } else 
                                            echo 'class="sorting"'; ?> width="30">Tahun</th>
                                    <th width="50"></th>
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
                                    <td><?php echo $row->nuptk;?></td>
                                    <td style="text-align: left;"><?php echo $row->nama_lengkap;?></td>
                                    <td style="text-align: left;"><?php echo $row->nama_sekolah;?></td>
                                    <td style="text-align: left;"><?php echo $row->nama_propinsi;?></td>
                                    <td style="text-align: left;"><?php echo $row->nama_kota;?></td>
                                    <td style="text-align: left;"><?php echo $row->nama_diklat;?></td>
                                    <td><?php echo $row->tahun;?></td>
                                    <td align="center">
                                        <a href="javascript:void(0)" data-id="<?php echo $row->id; ?>" title="Info" class="tip view" data-toggle="modal"><span class="icon12 icomoon-icon-search-3"></span></a>
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

                    </div><!-- End .span12 -->
                </div><!-- End .row-fluid -->  
								
            </div><!-- End contentwrapper -->
        </div><!-- End #content -->
    
    </div><!-- End #wrapper -->

    <!-- Boostrap view modal dialog -->
    <div id="ptkviewModal" class="modal hide fade" style="display: none;">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span class="icon12 minia-icon-close"></span></button>
                <h3>Data Peserta Diklat</h3>
            </div>

            <div class="modal-body">		
                <div id="modalContent" style="display:none;">
                </div>
            </div>

            <div class="modal-footer">
                <a href="#" class="btn" data-dismiss="modal">Close</a>
            </div>
    </div>
        
    <script type="text/javascript">

        $(document).ready(function () {

              $("#propinsi_kode").change(function(){
                      var kode = $("#propinsi_kode").val();

                      $.ajax({
                              type: 'post',
                              url: "ajax/controller.php",
                              data: "loadKotaList=" + kode,
                              cache: false,
                              success: function(html){
                                      $("#kota_kode").html(html); 
                              }
                      });

                      $("#kota_kode").val("");

              });

              $('a.tip.view').live('click', function () {
 
                    $('#ptkviewModal').modal();
                    
                    return false;
                        
                });

              $("a[data-toggle=modal]").click(function() {   
                      var id = $(this).data('id');

                      $.ajax({
                              cache: false,
                              type: 'GET',
                              url: 'ajax/controller.php',
                              data: 'viewDiklat_Peserta=' + id,
                              success: function(data) {
                                      $('#ptkviewModal').show();
                                      $('#modalContent').show().html(data);
                              }
                      });
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

                  location.href = "account.php?" + values;
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