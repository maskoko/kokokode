<?php
  /**
   * Main
   *
   * @package SIM PPPPTK BMTI
   * @author a2ngsa
   * @copyright 2012
   * @version $Id: chart_ptk_ijazah.php, v1.00 2011-06-05 10:12:05 gewa Exp $
   */
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
	    
?>

        <!--Body content-->
        <div id="content" class="clearfix">
            <div class="contentwrapper"><!--Content wrapper-->

                <div class="heading">
                    <h3>Grafik Komparasi Tingkat Pendidikan PTK</h3>                    
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
            
            $data = array("<= SLTA" => 0,
                        "D1" => 0,
                        "D2" => 0,
                        "D3" => 0,
                        "D4" => 0,
                        "S1" => 0,
                        "S2" => 0,
                        "S3" => 0,
                        "-Tidak Diketahui-" => 0);
            
            $rows = $content->getPTKijazah_Array($propinsi_kode, $kota_kode);
            if ($rows) {
                
                foreach ($rows as $row) {

                    foreach ($data as $key => $val) {
                        if ($key == $row->ijazah_akhir)
                            $data[$key] += 1;
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
                               <div class="ptk-pie" style="height: 430px;width:100%;"></div>
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

            if (divElement.hasClass('ptk-pie')) {
                $(function () {

                    
                        var data = [
                            <?php
                                $colours = array('#88bbc8', '#ed7a53', '#9FC569', '#bbdce3', '#9a3b1b', '#5a8022', '#2c7282', '#f9b85c', '#6f6f6f');
                            
                                $numItems = count($data);
                                $i = 0;
                                foreach ($data as $key => $val) {
                                    
                                    if ($i <= 8)
                                        $colour = $colours[$i];
                                    else
                                        $colour = $colours[0];
                                    
                                    $str = '{ label: "' . $key .'",  data: ' . $val . ', color: "' . $colour . '"}';
                                    if (++$i !== $numItems)
                                        $str .= ",\n";
                                    echo $str;
                                }
                                unset ($val);

                            ?>
                        ]; 

                    $.plot($(".ptk-pie"), data, 
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
                                label: {
                                    show: true,
                                    radius: 1,
                                    formatter: function(label, series){
                                        return '<div class="pie-chart-label">'+label+'&nbsp;'+Math.round(series.percent)+'%</div>';
                                    }
                                }
                                        },
                                        grow: {	active: false}
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
