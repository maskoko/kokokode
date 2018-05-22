<?php
  /**
   * Main
   *
   * @package SIM PPPPTK BMTI
   * @author a2ngsa
   * @copyright 2012
   * @version $Id: tna_ptk.php (admin), v1.00 2011-06-05 10:12:05 gewa Exp $
   */
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
	    
?>

    <script type="text/javascript" src="js/tna_ptk.js"></script>

        <!--Body content-->
        <div id="content" class="clearfix">
            <div class="contentwrapper"><!--Content wrapper-->

                <div class="heading">

                    <h3>TNA Online - Hasil Self-Assesment</h3>                    

                </div><!-- End .heading-->
    				
                <!-- Build page from here: Usual with <div class="row-fluid"></div> -->

                <div class="row-fluid">
                    <div class="span12">

<?php switch(Filter::$action): case "view": ?>

	<?php include ("tna_ptk_view.php"); ?>

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
			
            if(isset(Filter::$get['bskid']))
                $bskid = Filter::$get['bskid'];
            else
                $bskid = 0; 
                
            if(isset(Filter::$get['pskid']))
                $pskid = Filter::$get['pskid'];
            else
                $pskid = 0; 

            if(isset(Filter::$get['kkid']))
                $kkid = Filter::$get['kkid'];
            else
                $kkid = 0; 
                
            if(isset(Filter::$get['kelid']))
                $kelid = Filter::$get['kelid'];
            else
                $kelid = 0;

            if(isset(Filter::$get['mp1id']))
                $mp1id = Filter::$get['mp1id'];
            else
                $mp1id = 0;

            if(isset(Filter::$get['mp2id']))
                $mp2id = Filter::$get['mp2id'];
            else
                $mp2id = 0;

            if(isset(Filter::$get['propinsi_kode']))
                $propinsi_kode = Filter::$get['propinsi_kode'];
            else
                $propinsi_kode = '';

            if(isset(Filter::$get['kota_kode']))
                $kota_kode = Filter::$get['kota_kode'];
            else
                $kota_kode = '';

            if(isset(Filter::$get['sortby']))
                $sortby = Filter::$get['sortby'];
            else
                $sortby = 'pttna.last_update';

	?>

                        <div class="box">
                            <div class="title">
                                <h4>
                                    <span>Filter:</span>
                                    <div class="right">
                                        <a href="controller_report.php?action=createReportTNA_PTK<?php echo '&amp;propinsi_kode='.$propinsi_kode.'&amp;kota_kode='.$kota_kode.'&amp;tgl_dari='.$tgl_dari.'&amp;tgl_sampai='.$tgl_sampai.'&amp;bskid='.$bskid.'&amp;pskid='.$pskid.'&amp;kkid='.$kkid.'&amp;kelid='.$kelid.'&amp;mp1id='.$mp1id.'&amp;mp2id='.$mp2id ; ?>" class="tip" title="Export"><span class="icon16 icomoon-icon-file-excel"></span></a>
                                    </div>                                    
                                </h4>
                            </div>
                            
                            <div class="content">
                                <form class="form-horizontal" method="get" action="">
                                <fieldset>
                                    <input name="do" type="hidden" value="tna_ptk" />

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">
                                                <label class="form-label span4" for="tgl_dari">Periode :</label>
                                                <input type="text" class="span2 datepickerField" name="tgl_dari" id="tgl_dari" value="<?php echo $tgl_dari;?>"/>&nbsp;s.d&nbsp;
                                                <input type="text" class="span2 datepickerField" name="tgl_sampai" id="tgl_sampai" value="<?php echo $tgl_sampai;?>"/>&nbsp;&nbsp;

                                                <button type="submit" class="btn btn-info">Cari</button>
                                            </div>
                                        </div>
                                    </div>

                                    </br>

                                    <ul id="tna_tab" class="nav nav-tabs pattern">
                                        <li <?php if ($kelid == 0) echo 'class="active"'; ?>><a href="#P_0" data-toggle="tab">Semua</a></li>
                                        <li <?php if ($kelid == 3) echo 'class="active"'; ?>><a href="#P_3" data-toggle="tab">PRODUKTIF</a></li>
                                        <li <?php if ($kelid == 1) echo 'class="active"'; ?>><a href="#P_1" data-toggle="tab">ADAPTIF</a></li>
                                        <li <?php if ($kelid == 2) echo 'class="active"'; ?>><a href="#P_2" data-toggle="tab">NORMATIF</a></li>
                                    </ul>

                                    <div class="tab-content">

                                        <div class="tab-pane fade <?php if ($kelid == 0) echo 'in active'; ?>" id="P_0">
                                            
                                            <p>Kelompok ADAPTIF, NORMATIF dan PRODUKTIF.</p>

                                        </div>

                                        <div class="tab-pane fade <?php if ($kelid == 3) echo 'in active'; ?>" id="P_3">
                                            
                                        <div class="form-row row-fluid">
                                            <div class="span12">
                                                <div class="row-fluid">
                                                    <label class="form-label span3" for="checkbox">Bidang Keahlian:</label>
                                                    <div class="span8 controls">
                                                        <select name="bskid" id="bskid">
                                                            <option value="0"><?php echo lang('SELECT_ALL');?></option>
                                                            <?php 
                                                              $bsk = $content->getBSKList();
                                                              if ($bsk):
                                                            ?>
                                                                <?php foreach ($bsk as $prow):?>
                                                                    <option value="<?php echo $prow->id;?>" <?php if($prow->id == $bskid) echo 'selected="selected"';?>><?php echo $prow->nama_bidang;?></option>
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
                                                    <label class="form-label span3" for="checkbox">Program Keahlian:</label>
                                                    <div class="span8 controls">
                                                        <select name="pskid" id="pskid">
                                                            <option value="0"><?php echo lang('SELECT_ALL');?></option>
                                                            <?php 

                                                              if ($bskid != 0) $psk = $content->getPSKList(); else $psk = NULL;
                                                              if (isset($psk)):
                                                            ?>
                                                                <?php foreach ($psk as $prow):?>
                                                                    <option value="<?php echo $prow->id;?>" <?php if($prow->id == $pskid) echo 'selected="selected"';?>><?php echo $prow->nama_program;?></option>
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
                                                    <label class="form-label span3" for="checkbox">Paket Keahlian:</label>
                                                    <div class="span8 controls">
                                                        <select name="kkid" id="kkid">
                                                            <option value="0"><?php echo lang('SELECT_ALL');?></option>
                                                            <?php 
                                                              if ($pskid != 0) $kk = $content->getKKByPSKList($pskid); else $kk = NULL;
                                                              if (isset($kk)):
                                                            ?>
                                                                <?php foreach ($kk as $prow):?>
                                                                    <option value="<?php echo $prow->id;?>" <?php if($prow->id == $kkid) echo 'selected="selected"';?>><?php echo $prow->nama_kompetensi;?></option>
                                                                <?php endforeach;?>
                                                                <?php unset($prow);?>
                                                            <?php endif;?>
                                                        </select>                   
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        </div>
                                        <div class="tab-pane fade <?php if ($kelid == 1) echo 'in active'; ?>" id="P_1">
                                            
                                            <div class="form-row row-fluid">
                                                <div class="span12">
                                                    <div class="row-fluid">
                                                        <label class="form-label span3" for="checkbox">Mata Pelajaran:</label>
                                                        <div class="span8 controls">
                                                            <select name="mp1id" id="mp1id">
                                                                <option value="0"><?php echo lang('SELECT_ALL');?></option>
                                                                <?php

                                                                  $mp1 = $content->getMataPelajaranList(1);
                                                                  if (isset($mp1)):
                                                                ?>
                                                                    <?php foreach ($mp1 as $prow):?>
                                                                        <option value="<?php echo $prow->id;?>" <?php if($prow->id == $mp1id) echo 'selected="selected"';?>><?php echo $prow->nama_matapelajaran;?></option>
                                                                    <?php endforeach;?>
                                                                    <?php unset($prow);?>
                                                                <?php endif;?>
                                                            </select>                   
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                        </div>

                                        <div class="tab-pane fade <?php if ($kelid == 2) echo 'in active'; ?>" id="P_2">
                                            
                                            <div class="form-row row-fluid">
                                                <div class="span12">
                                                    <div class="row-fluid">
                                                        <label class="form-label span3" for="checkbox">Mata Pelajaran:</label>
                                                        <div class="span8 controls">
                                                            <select name="mp2id" id="mp2id">
                                                                <option value="0"><?php echo lang('SELECT_ALL');?></option>
                                                                <?php 

                                                                   $mp2 = $content->getMataPelajaranList(2);
                                                                   if (isset($mp2)):

                                                                 ?>
                                                                    <?php foreach ($mp2 as $prow):?>
                                                                        <option value="<?php echo $prow->id;?>" <?php if($prow->id == $mp2id) echo 'selected="selected"';?>><?php echo $prow->nama_matapelajaran;?></option>
                                                                    <?php endforeach;?>
                                                                    <?php unset($prow);?>
                                                                <?php endif;?>
                                                            </select>                   
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    </br>

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
                                        </div> <!-- end .span12 -->                                        
                                    </div> <!-- end form-row row-fluid -->


                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">
                                                <label class="form-label span2" for="checkboxes">Sorting:</label>
                                                <div class="span2 controls">
                                                    <select name="sortby" id="sortby">
                                                        <option value="pttna.last_update" <?php if($sortby == 'pttna.last_update') echo 'selected="selected"';?>>Tgl Proses</option>
                                                        <option value="nilai_persen" <?php if($sortby == 'nilai_persen') echo 'selected="selected"';?>>Nilai Kompetensi</option>
                                                    </select>
                                                </div>                                            
                                            </div> <!-- end row-fluid -->
                                        </div> <!-- end .span12 -->                                        
                                    </div> <!-- end form-row row-fluid -->


                                    <input name="kelid" type="hidden" value="<?php echo $kelid; ?>">

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
                        
                            $tgl_dari = setToSQLdate($tgl_dari);
                            $tgl_sampai = setToSQLdate($tgl_sampai);

                            if ($kelid == 1)
                                $rows = $content->getTNA_PTK($kelid, $tgl_dari, $tgl_sampai, $bskid, $pskid, $mp1id, $propinsi_kode, $kota_kode, "P", $sortby);
                            else if ($kelid == 2)
                                $rows = $content->getTNA_PTK($kelid, $tgl_dari, $tgl_sampai, $bskid, $pskid, $mp2id, $propinsi_kode, $kota_kode, "P", $sortby);
                            else
                                $rows = $content->getTNA_PTK($kelid, $tgl_dari, $tgl_sampai, $bskid, $pskid, $kkid, $propinsi_kode, $kota_kode, "P", $sortby);
                            
                        ?>
                              
                        <table class="responsive table table-striped table-bordered table-sorting table-condensed">

                            <thead>
                                <tr>
                                    <th width="70">NUPTK</th>
                                    <th>Nama Lengkap</th>
                                    <th>Sekolah / Lembaga</th>
                                    <?php if ($kelid == 0) : ?>
                                        <th>Paket Keahlian / Mata Pelajaran</th>
                                    <?php elseif ($kelid == 1 || $kelid == 2) : ?>
                                        <th>Mata Pelajaran</th>
                                    <?php else: ?>
                                        <th>Paket Keahlian</th>
                                    <?php endif; ?>
                                    <th width="80">Tgl Proses</th>
                                    <th width="60">Nilai (%)</th>
                                    <th width="100">Action</th>
                                </tr>
                            </thead>

                            <tbody>

                            <?php if(!$rows):?>
                                <tr>
                                    <td colspan="7"><?php echo Filter::msgInfo(lang('NO_DATA'), false);?></td>
                                </tr>

                            <?php else:?>
                            <?php foreach ($rows as $row):?>

                                <tr>
                                    <td><?php if ($row->jenis == 'P') echo $row->ptk_nuptk; else $row->staff_nuptk; ?></td>                                    
                                    <td style="text-align: left;"><?php if ($row->jenis == 'P') echo $row->ptk_nama_lengkap; else echo $row->staff_nama_lengkap?></td>
                                    <td style="text-align: left;"><?php if ($row->jenis == 'P') echo $row->nama_sekolah; else echo $row->nama_lembaga; ?></td>
                                    <td style="text-align: left;"><?php if ($row->kelid == 3) echo $row->nama_kompetensi; else echo $row->nama_matapelajaran; ?></td>
                                    <td><?php echo date("d/m/Y",strtotime($row->last_update));?></td>
                                    <td style="text-align: center;"><?php if ($row->nilai_instrumen != 0) echo (int)(($row->nilai_total / $row->nilai_instrumen) * 100 + .5); else echo "0"; ?></td>
                                    <td align="center">
                                        <a href="index.php?do=tna_ptk&amp;action=view&amp;id=<?php echo $row->id;?>" title="View" class="tip"><span class="icon12 icomoon-icon-info"></span></a>
                                        <a href="javascript:void(0)" title="Hapus" class="tip doDelete" data-id="<?php echo $row->id;?>"><span class="icon12 icomoon-icon-remove"></span></a>
                                    </td>
                                </tr>

                            <?php endforeach;?>
                            <?php unset($row);?>
                            <?php endif;?>					

                            </tbody>

                            <tfoot>
                                <tr>
                                    <td colspan="7">
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
                                								
	<?php echo Core::doDelete(lang('DELCONFIRM_TITLE'), "deleteTNA_PTK");?>

<?php break;?>
<?php endswitch;?>

                    </div><!-- End .span12 -->
                </div><!-- End .row-fluid -->  

            </div><!-- End contentwrapper -->
        </div><!-- End #content -->

    </div><!-- End #wrapper -->        

    <script type="text/javascript">

        $(document).ready(function(){

            $("#bskid").change(function(){
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
                    $("#kkid").val("");

                    $.uniform.update("#pskid");
                    $.uniform.update("#kkid");

            });


            $("#pskid").change(function(){
                    var id = $("#pskid").val();

                    $.ajax({
                            type: 'post',
                            url: "controller.php",
                            data: "loadKKList=" + id,
                            cache: false,
                            success: function(html){
                                    $("#kkid").html(html); 
                            }
                    });

                    $("#kkid").val("");
                    $.uniform.update("#kkid");

            });


            $('#tna_tab a').click(function (e) {
                e.preventDefault();
                
                var href = $(this).attr("href");

                if (href == "#P_1")
                    $('input[name=kelid]').val('1');
                else if (href == "#P_2")
                    $('input[name=kelid]').val('2');
                else if (href == "#P_3")
                    $('input[name=kelid]').val('3');
                else
                    $('input[name=kelid]').val('0');

            })

            // -- propinsi --

            $("#propinsi_kode").change(function() {

                  var kode = $("#propinsi_kode").val();

                  $.ajax({
                          type: 'post',
                          url: "controller.php",
                          data: "loadKotaList=" + kode + ":true",
                          cache: false,
                          success: function(html){
                                  $("#kota_kode").html(html); 
                          }
                  });

                  $("#kota_kode").val("");
                  $.uniform.update("#kota_kode");

            });


        });

    </script>
        
    <!-- Charts plugins -->
    <script type="text/javascript" src="plugins/charts/flot/jquery.flot.js"></script>
    <script type="text/javascript" src="plugins/charts/flot/jquery.flot.grow.js"></script>
    <script type="text/javascript" src="plugins/charts/flot/jquery.flot.pie.js"></script>
    <script type="text/javascript" src="plugins/charts/flot/jquery.flot.resize.js"></script>
    <script type="text/javascript" src="plugins/charts/flot/jquery.flot.tooltip_0.4.4.js"></script>
    <script type="text/javascript" src="plugins/charts/flot/jquery.flot.orderBars.js"></script>
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
