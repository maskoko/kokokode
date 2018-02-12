<?php
  /**
   * Main
   *
   * @package SIM PPPPTK BMTI
   * @author a2ngsa
   * @copyright 2012
   * @version $Id: chart_diklat_peserta.php, v1.00 2011-06-05 10:12:05 gewa Exp $
   */
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
	    
?>

        <!--Body content-->
        <div id="content" class="clearfix">
            <div class="contentwrapper"><!--Content wrapper-->

                <div class="heading">
                    <h3>Grafik Calon dan Peserta Diklat</h3>                    
                </div><!-- End .heading-->
    				
                <!-- Build page from here: Usual with <div class="row-fluid"></div> -->
							
	<?php		
            if(isset(Filter::$get['propinsi_kode']))
                $propinsi_kode = Filter::$get['propinsi_kode'];
            else
                $propinsi_kode = '';

            if(isset(Filter::$get['kota_kode']))
                $kota_kode = Filter::$get['kota_kode'];
            else
                $kota_kode = '';

            $yearto = date('Y');
            $yearfrom = $yearto - 8;            
            
            $peserta_data = array();
            
            for ($i = $yearfrom; $i <= $yearto; $i++) {
                $peserta_data[$i] = 0;
            }
            
            $rows = $content->getDiklat_Peserta_YearPeriod($yearfrom, $yearto);
            if ($rows) {
                
                foreach ($rows as $row) {

                    foreach ($peserta_data as $key => $val) {
                        if ($key == $row->tahun)
                            $peserta_data[$key] += 1;
                    }
                    unset ($val);

                }
                unset($row);
                
            }
            unset($rows);

            // -- calon --
            
            $calon_data = array();
            
            for ($i = $yearfrom; $i <= $yearto; $i++) {
                $calon_data[$i] = 0;
            }
            
            $rows = $content->getDiklat_CalonPeserta_YearPeriod($yearfrom, $yearto);
            if ($rows) {
                
                foreach ($rows as $row) {

                    foreach ($calon_data as $key => $val) {
                        if ($key == $row->tahun)
                            $calon_data[$key] += 1;
                    }
                    unset ($val);

                }
                unset($row);
                
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
                                    <input type="hidden" name="do" value="chart_ptk_ijazah">

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">
                                                <label class="form-label span2" for="checkboxes">Propinsi:</label>
                                                <div class="control form-inline">
                                                    <div class="span3">
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
                                                    <div class="span3">
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
                                                    
                                                    <button type="submit" class="btn btn-info">Update</button>
                                                </div>
                                            </div> <!-- end row-fluid -->
                                        </div>
                                    </div>
                                                                                                            
                                </fieldset>
                                </form>								
                            </div>

                        </div><!-- End filter .box -->

                    </div><!-- End .span12 -->
                </div><!-- End .row-fluid -->  

                <div class="row-fluid">
                    <div class="span12">

                        <div class="box chart">

                            <div class="title">
                                <h4>
                                    <span class="icon16 icomoon-icon-bars"></span>
                                    <span>Grafik</span>
                                </h4>
                            </div>
                            <div class="content">
                               <div class="lines-chart" style="height: 430px;width:100%;"></div>
                            </div>

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
                            url: "ajax/controller.php",
                            data: "loadKotaList=" + kode,
                            cache: false,
                            success: function(html){
                                    $("#kota_kode").html(html); 
                            }
                    });

                    $("#kota_kode").val("");

            });
              
            // -- grafik ---
                        
            var divElement = $('div'); //log all div elements

            var chartColours = ['#88bbc8', '#ed7a53', '#9FC569', '#bbdce3', '#9a3b1b', '#5a8022', '#2c7282'];

            if (divElement.hasClass('lines-chart')) {
                $(function () {

                        var d1 = [<?php  

                                $numItems = count($peserta_data);
                                $i = 0; $index = 1;
                                foreach ($peserta_data as $key => $val) {
                                    $str = '[' . $key .',' . $val . ']';
                                    if (++$i !== $numItems)
                                        $str .= ",\n";
                                    echo $str;
                                    $index++;
                                }
                                unset ($val);
                        ?>];
                        var d2 = [<?php  

                                $numItems = count($calon_data);
                                $i = 0; $index = 1;
                                foreach ($calon_data as $key => $val) {
                                    $str = '[' . $key .',' . $val . ']';
                                    if (++$i !== $numItems)
                                        $str .= ",\n";
                                    echo $str;
                                    $index++;
                                }
                                unset ($val);
                        ?>];
                        //define placeholder class
                        var placeholder = $(".lines-chart");
                        //graph options
                        var options = {
                                        grid: {
                                                show: true,
                                            aboveData: true,
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
                                    lines: {
                                        show: true,
                                        fill: true,
                                        lineWidth: 2,
                                        steps: false
                                        },
                                    points: {show:false}
                                },
                                legend: { position: "se" },
                                yaxis: { min: 0 },
                                xaxis: {ticks:11, tickDecimals: 0},
                                colors: chartColours,
                                shadowSize:1,
                                tooltip: true, //activate tooltip
                                        tooltipOpts: {
                                                content: "%s : %y.0",
                                                shifts: {
                                                        x: -30,
                                                        y: -50
                                                }
                                        }
                            };   

                        $.plot(placeholder, [ 

                                {
                                        label: "Peserta", 
                                        data: d1,
                                        lines: {fillColor: "#f2f7f9"},
                                        points: {fillColor: "#88bbc8"}
                                }, 
                                {	
                                        label: "Calon", 
                                        data: d2,
                                        lines: {fillColor: "#fff8f2"},
                                        points: {fillColor: "#ed7a53"}
                                } 

                        ], options);

                });
                }//end if
             
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
