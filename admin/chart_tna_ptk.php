<?php
  /**
   * Main
   *
   * @package SIM PPPPTK BMTI
   * @author a2ngsa
   * @copyright 2012
   * @version $Id: chart_tna_ptk.php (admin), v1.00 2011-06-05 10:12:05 gewa Exp $
   */
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
	    
?>

    <script type="text/javascript" src="js/chart_tna_ptk.js"></script>

	<?php
		
        if(isset(Filter::$get['tgl_dari']))
            $tgl_dari = Filter::$get['tgl_dari'];
        else
            $tgl_dari = date('d/m/Y');

        if(isset(Filter::$get['tgl_sampai']))
            $tgl_sampai = Filter::$get['tgl_sampai'];
        else
            $tgl_sampai = date('d/m/Y', strtotime("+10 days"));        

        if(isset(Filter::$get['kelid']))
            $kelid = Filter::$get['kelid'];
        else
            $kelid = 0; 
			
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

        $valuestrchart = '';
        $recordcount = 0;

	?>

        <!--Body content-->
        <div id="content" class="clearfix">
            <div class="contentwrapper"><!--Content wrapper-->

                <div class="heading">
                    <h3>TNA Online - Grafik dari Self-Assesment</h3>                    
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
                                
                                <form id="tna_form" class="form-horizontal" method="get" action="">								
                                <fieldset>
                                    
                                    <input name="do" type="hidden" value="chart_tna_ptk" />
                                    <input name="action" type="hidden" value="view" />								


                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">
                                                <label class="form-label span4" for="tgl_dari">Periode :</label>
                                                <input type="text" class="span2 datepickerField" name="tgl_dari" id="tgl_dari" value="<?php echo $tgl_dari;?>"/>&nbsp;-&nbsp;
                                                <input type="text" class="span2 datepickerField" name="tgl_sampai" id="tgl_sampai" value="<?php echo $tgl_sampai;?>"/>&nbsp;&nbsp;
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

                                    <input name="kelid" type="hidden" value="<?php echo $kelid; ?>">

                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-info">View</button>
                                    </div>

                                </fieldset>
                                </form>																
                            </div> <!-- end .content -->

                        </div><!-- End .box -->
								
		<?php 

            if ((Filter::$action) == "view") :		
			

                  $values = array();
                  $values = array_fill(0, 4, 0);

                $tgl_dari = setToSQLdate($tgl_dari);
                $tgl_sampai = setToSQLdate($tgl_sampai);

                if ($kelid == 1)
                    $rows = $content->getTNA_PTKData($kelid, $tgl_dari, $tgl_sampai, $bskid, $pskid, $mp1id, $propinsi_kode, $kota_kode);
                else if ($kelid == 2)
                    $rows = $content->getTNA_PTKData($kelid, $tgl_dari, $tgl_sampai, $bskid, $pskid, $mp2id, $propinsi_kode, $kota_kode);
                else
                    $rows = $content->getTNA_PTKData($kelid, $tgl_dari, $tgl_sampai, $bskid, $pskid, $kkid, $propinsi_kode, $kota_kode);

                  if ($rows) {

                    $recordcount = count($rows);

                    foreach ($rows as $row) {

                      $percent = (int)(($row->nilai_total / $row->nilai_instrumen) * 100 + .5);
                      if ($percent >= 75)
                        $values[0]++;
                      else if ($percent >= 60)
                        $values[1]++;
                      else if ($percent >= 45)
                        $values[2]++;
                      else if ($percent >= 30)
                        $values[3]++;

                    }
                    unset($row);
                  }

                  $colors = array('#88bbc8', '#ed7a53', '#9FC569', '#2c7282');
                  $labels = array("(>= 75%)", "(>= 60%)", "(>= 45%)", "(>= 30%)");

                  $valuestrchart = "[";
                  for ($i = 0; $i <= 3; $i++) {

                    $valuestrchart .= '{data: [[' . $i . ',' . $values[$i] . ']], color: "' . $colors[$i] . '", label: "' .$labels[$i] . '"},';

                  }

                  $valuestrchart .= "]";

					
		        if ($recordcount > 0) :
        ?>
	
                    <div class="box chart">                        
                        <div class="title">
                            <h4>
                                <span class="icon16 icomoon-icon-bars"></span>
                                <span>Grafik Hasil ( <?php echo $recordcount; ?> data )</span>
                            </h4>
                        </div>
                        
                        <div class="content">
                           <div class="tna-bar1" style="height: 420px;width:100%;"> </div>
                        </div>

                    </div><!-- End .box bar chart -->

                    <div class="box chart">                        
                        <div class="title">
                            <h4>
                                <span class="icon16 icomoon-icon-bars"></span>
                                <span>Grafik Pie Hasil ( <?php echo $recordcount; ?> data )</span>
                            </h4>
                        </div>
                        
                        <div class="content">
                           <div class="tna-pie1" style="height: 420px;width:100%;"> </div>
                        </div>

                    </div><!-- End .box chart -->


        <?php else : ?>

                    <div class="box">
                        <div class="span12">

                            <div class="well">
                                Tidak ada data!
                            </div>

                        </div>
                    </div>

		<?php				
		        endif;
						
            endif;

        ?>
						
                        </div><!-- End .span12 -->
                </div><!-- End .row-fluid -->  

            </div><!-- End contentwrapper -->
        </div><!-- End #content -->
    
    </div><!-- End #wrapper -->

	
    <!-- Charts plugins -->
    <script type="text/javascript" src="plugins/charts/flot/jquery.flot.js"></script>
    <script type="text/javascript" src="plugins/charts/flot/jquery.flot.grow.js"></script>
    <script type="text/javascript" src="plugins/charts/flot/jquery.flot.pie.js"></script>
    <script type="text/javascript" src="plugins/charts/flot/jquery.flot.resize.js"></script>
    <script type="text/javascript" src="plugins/charts/flot/jquery.flot.tooltip_0.4.4.js"></script>
    <script type="text/javascript" src="plugins/charts/flot/jquery.flot.orderBars.js"></script>
    <script type="text/javascript" src="plugins/charts/flot/jquery.flot.axislabels.js"></script>
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

    <script type="text/javascript">

        $(document).ready(function(){

                $("#bskid").change(function(){
                        var id = $("#bskid").val();

                        $.ajax({
                                type: 'post',
                                url: "controller.php",
                                data: "loadPSKList=" + id + ":true",
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
                                data: "loadKKList=" + id + ":true",
                                cache: false,
                                success: function(html){
                                        $("#kkid").html(html); 
                                }
                        });

                        $("#kkid").val("");
                        $.uniform.update("#kkid");

                });

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
                      $.uniform.update("#kota_kode");

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

                });

                // -- end filter --

                //$("#tna_form").validate(); 

                // -- chart --

                <?php if ($recordcount > 0) : ?>


                //var chartColours = ['#88bbc8', '#ed7a53', '#9FC569', '#bbdce3', '#9a3b1b', '#5a8022', '#2c7282'];


/*
var ds = [{data: [[0,1]], color: '#88bbc8', label: ">= 75%"}, 
            {data: [[1,2]], color: '#ed7a53', label: ">= 60%"},
            {data: [[2,3]], color: '#9FC569', label: ">= 45%"},
            {data: [[3,13]], color: '#bbdce3', label: ">= 30%"}];
        */

        var ds = <?php echo $valuestrchart; ?>//new Array();

        /*
        ds.push({data: [[0,1]], color: '#88bbc8', label: ">= 75%"});
        ds.push({data: [[1,2]], color: '#ed7a53', label: ">= 60%"});
        ds.push({data: [[2,3]], color: '#9FC569', label: ">= 45%"});
        ds.push({data: [[3,4]], color: '#bbdce3', label: ">= 30%"});
        */

        var stack = 0, bars = true, lines = false, steps = false;

        var options = {
                grid: {
                    show: true,
                    aboveData: false,
                    color: "#3f3f3f" ,
                    labelMargin: 5,
                    axisMargin: 0, 
                    borderWidth: 0,
                    borderColor:null,
                    minBorderMargin: 5 ,
                    clickable: true, 
                    hoverable: true,
                    autoHighlight: true,
                    mouseActiveRadius: 20
                },
                series: {
                    grow: {active:false},
                    stack: stack,
                    lines: { show: lines, fill: true, steps: steps },
                    bars: { show: bars, barWidth: 0.5, fill:1}
                },
                xaxis: {ticks:11, tickDecimals: 0},
                legend: { position: "se" },
                //colors: chartColours,
                shadowSize:1,
                tooltip: true, //activate tooltip
                tooltipOpts: {
                    content: "%s : %y.0",
                    shifts: {
                        x: -30,
                        y: -50
                    }
                },
                xaxis: {
                mode: "categories",
                ticks: [
                    [0, '>= 75%'],
                    [1, '>= 60%'],
                    [2, '>= 45%'],
                    [3, '>= 30%']
                ],
                tickLength: 0
                }
        };

        $.plot($(".tna-bar1"), ds, options);

        // -- pie chart --

        $.plot($(".tna-pie1"), ds, 
        {
            series: {
                pie: { 
                    show: true,
                    highlight: {
                        opacity: 0.1
                    },
                    radius: 1,
                    stroke: {
                        color: '#fff',
                        width: 2
                    },
                    startAngle: 2,
                    combine: {
                        color: '#353535',
                        threshold: 0.05
                    },
                    label: {
                        show: true,
                        radius: 1,
                        formatter: function(label, series){
                            return '<div class="pie-chart-label">'+label+'&nbsp;'+Math.round(series.percent)+'%</div>';
                        }
                    }
                },
                grow: { active: false}
            },
            legend:{show:false},
            grid: {
                hoverable: true,
                clickable: true
            },
            tooltip: true, //activate tooltip
            tooltipOpts: {
                content: "%s : %y.1"+"%",
                shifts: {
                    x: -30,
                    y: -50
                }
            }
        });

   
                <?php endif; ?>


            });

    </script>		

    
