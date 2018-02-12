<?php
  /**
   * Main
   *
   * @package SIM PPPPTK BMTI
   * @author a2ngsa
   * @copyright 2012
   * @version $Id: chart_ptk_sekolah_peserta.php, v1.00 2011-06-05 10:12:05 gewa Exp $
   */
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
	    
?>

        <!--Body content-->
        <div id="content" class="clearfix">
            <div class="contentwrapper"><!--Content wrapper-->

                <div class="heading">
                    <h3>Grafik Komparasi PTK, Sekolah dan Peserta Diklat</h3>                    
                </div><!-- End .heading-->
    				
                <!-- Build page from here: Usual with <div class="row-fluid"></div> -->
							
	<?php		
            if(isset(Filter::$get['jenis']))
                $jenis = Filter::$get['jenis'];
            else
                $jenis = 'created';
                        
            $year1 = date('Y');
            $year2 = $year1 - 1;
            $year3 = $year1 - 2;
            			   
            $ptk_data = array($year1 => $content->getPTKcreated_year($year1, $jenis), 
                              $year2 => $content->getPTKcreated_year($year2, $jenis),
                              $year3 => $content->getPTKcreated_year($year3, $jenis));

            $sekolah_data = array($year1 => $content->getSekolahcreated_year($year1, $jenis), 
                              $year2 => $content->getSekolahcreated_year($year2, $jenis),
                              $year3 => $content->getSekolahcreated_year($year3, $jenis));
            
            $peserta_data = array($year1 => $content->getDiklat_Peserta_year($year1, $jenis), 
                              $year2 => $content->getDiklat_Peserta_year($year2, $jenis),
                              $year3 => $content->getDiklat_Peserta_year($year3, $jenis));
                        
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
                                    <input type="hidden" name="do" value="chart_ptk">

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">
                                                <label class="form-label span2" for="checkboxes">Jenis:</label>
                                                <div class="control form-inline">
                                                    <div class="span4">
                                                        <select name="jenis" id="jenis" onchange="window.location='index.php?do=chart_ptk_sekolah_peserta&amp;jenis='+this[this.selectedIndex].value+''" placeholder="Select...">
                                                            <option value="created" <?php if ($jenis == "created") echo "selected"; ?>>Entry</option>
                                                            <option value="count" <?php if ($jenis == "count") echo "selected"; ?>>Jumlah</option>
                                                        </select>
                                                    </div>                                                    
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
                                    <span>Grafik 3 Tahun Terakhir</span>
                                </h4>
                            </div>
                            <div class="content">
                               <div class="ptk-bars-chart" style="height: 430px;width:100%;"></div>
                            </div>

                        </div><!-- End .box -->
                                                
                    </div><!-- End .span12 -->
                </div><!-- End .row-fluid -->  
																				
            </div><!-- End contentwrapper -->
        </div><!-- End #content -->
    
    </div><!-- End #wrapper -->

    
    <script type="text/javascript">

        $(document).ready(function () {
              
            // -- grafik ---
              
            var divElement = $('div'); //log all div elements
            
            var chartColours = ['#88bbc8', '#ed7a53', '#9FC569', '#bbdce3', '#9a3b1b', '#5a8022', '#2c7282'];

            //Ordered bars chart
            if (divElement.hasClass('ptk-bars-chart')) {
                $(function () {

                    // data
                    var d1 = [];                        
                    <?php
                    
                        foreach ($ptk_data as $year => $val) {
                            echo 'd1.push([' . $year . ', ' .$val . ']);';
                        }
                        unset($val);
                    
                    ?>
                                            
                    var d2 = [];                    
                    <?php
                    
                        foreach ($sekolah_data as $year => $val) {
                            echo 'd2.push([' . $year . ', ' .$val . ']);';
                        }
                        unset($val);
                    
                    ?>
                                        
                    var d3 = [];
                    <?php
                    
                        foreach ($peserta_data as $year => $val) {
                            echo 'd3.push([' . $year . ', ' .$val . ']);';
                        }
                        unset($val);
                    
                    ?>

                    var ds = new Array();

                     ds.push({
                        label: "PTK",
                        data:d1,
                        bars: {order: 1}
                    });
                    ds.push({
                        label: "Sekolah",
                        data:d2,
                        bars: {order: 2}
                    });
                    ds.push({
                        label: "Peserta Diklat",
                        data:d3,
                        bars: {order: 3}
                    });

                        var options = {
                                        bars: {
                                                show:true,
                                                barWidth: 0.2,
                                                fill:1
                                        },
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
                                            autoHighlight: false,
                                            mouseActiveRadius: 20
                                        },
                                series: {
                                        grow: {active:false}
                                },
                                legend: { position: "ne" },
                                colors: chartColours,
                                tooltip: true, //activate tooltip
                                        tooltipOpts: {
                                                content: "%s : %y.0",
                                                shifts: {
                                                        x: -30,
                                                        y: -50
                                                }
                                        },
                                        
                                xaxis: {
                                        label: "",
                                        labelPos: "high",
                                                ticks: [[<?php echo $year3; ?>, "<?php echo $year3; ?>"], [<?php echo $year2; ?>, "<?php echo $year2; ?>"], [<?php echo $year1; ?>, "<?php echo $year1; ?>"]]
                                 },

                                 yaxis: {
                                        label: "Jml",
                                        labelPos: "low"
                                 }
                                        
                                        
                        };

                        $.plot($(".ptk-bars-chart"), ds, options);
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
