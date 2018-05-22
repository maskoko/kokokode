<?php
  /**
   * Main
   *
   * @package SIM PPPPTK BMTI
   * @author a2ngsa
   * @copyright 2012
   * @version $Id: main.php (admin), v1.00 2011-06-05 10:12:05 gewa Exp $
   */
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
	    
?>

    <script type="text/javascript" src="js/main_filter.js"></script>

        <!--Body content-->
        <div id="content" class="clearfix">
            <div class="contentwrapper"><!--Content wrapper-->

                <div class="heading">
                    <h3>Staff dan Administrator</h3>                    
                </div><!-- End .heading-->
    				
                <!-- Build page from here: Usual with <div class="row-fluid"></div> -->

                <div class="row-fluid">
                    <div class="span12">

                        <h1>Selamat Datang di Halaman Staff dan Administrator</h1>
                        <p>Akses hanya digunakan oleh staff dan administrator SIM Ajuan, dan Penyelenggaraan.</p>
                                                
                        <div class="box">

                            <div class="title">
                                <h4>
                                    <span>Filter Jadwal Diklat :</span>
                                </h4>
                                <a href="#" class="minimize">Minimize</a>                                
                            </div>
                            
                            <div class="content">
                                
                                <!-- filter .diklat_jadwal -->

                                <?php

                                    if(isset(Filter::$get['jadwal_tgl_dari'])) {                                            
                                            $jadwal_tgl_dari = Filter::$get['jadwal_tgl_dari'];
                                            $expired = 2592000 + time(); // -- a month --
                                            
                                            setcookie('jadwal_tgl_dari', $jadwal_tgl_dari, $expired);
                                    } else {
                                        
                                        if(isset($_COOKIE['jadwal_tgl_dari'])) { 
                                            $jadwal_tgl_dari = $_COOKIE['jadwal_tgl_dari'];
                                        } else {
                                            $year = date('Y');
                                            $tgl_dari = mktime(0, 0, 0, 1, 1,  $year - 2 );
                                            $jadwal_tgl_dari = date('d/m/Y', $tgl_dari);                    
                                        }
                                        
                                    }

                                    if(isset(Filter::$get['jadwal_tgl_sampai'])) {                                            
                                            $jadwal_tgl_sampai = Filter::$get['jadwal_tgl_sampai'];
                                            $expired = 2592000 + time(); // -- a month --
                                            
                                            setcookie('jadwal_tgl_sampai', $jadwal_tgl_sampai, $expired);
                                    } else {
                                                                        
                                        if(isset($_COOKIE['jadwal_tgl_sampai'])) { 
                                            $jadwal_tgl_sampai = $_COOKIE['jadwal_tgl_sampai'];
                                        } else {                                        
                                            if(isset($_COOKIE['jadwal_tgl_dari'])) { 
                                                $jadwal_tgl_sampai = $_COOKIE['jadwal_tgl_dari'];
                                            } else {
                                                $year = date('Y');
                                                $tgl_sampai = mktime(0, 0, 0, 12, 31,  $year );
                                                $jadwal_tgl_sampai = date('d/m/Y', $tgl_sampai);
                                            }
                                        }
                                    }

                                ?>

                               <form class="form form-horizontal" method="get" action="">
                               <fieldset>

                                   <div class="form-row row-fluid">
                                       <div class="span12">
                                           <div class="row-fluid">
                                                <label class="form-label span4" for="normal">Periode:</label>
                                                <input type="text" class="span2 datepickerField" name="jadwal_tgl_dari" id="jadwal_tgl_dari" value="<?php echo $jadwal_tgl_dari;?>"/>&nbsp;-&nbsp;
                                                <input type="text" class="span2 datepickerField" name="jadwal_tgl_sampai" id="jadwal_tgl_sampai" value="<?php echo $jadwal_tgl_sampai;?>"/>&nbsp;
                                                <button type="submit" class="btn btn-info">Set!</button>
                                                
                                                <span class="help-block blue span8">Periode ini digunakan untuk filtering Jadwal Diklat pada combo Ajuan dan Peserta Diklat.</span>
                                           </div> <!-- end row-fluid -->
                                       </div>                                                                              
                                   </div>

                               </fieldset>
                               </form>								
                                                                  
                            </div> <!-- end content -->

                        </div><!-- End .box -->

                    </div><!-- End .span12 -->
                </div><!-- End .row-fluid -->  


                <div class="row-fluid">

                    <div class="span12">

                        <div class="box chart gradient">

                            <div class="title">

                                <h4>
                                    <span class="icon16 icomoon-icon-bars"></span>
                                    <span>Grafik Data</span>
                                </h4>
                                <a href="#" class="minimize">Minimize</a>
                            </div>
                            <div class="content" style="padding-bottom:0;">
                               <div class="dashboard-chart" style="height: 230px;width:100%;margin-top:15px; margin-bottom:15px;"></div>
                               <ul class="chartShortcuts">
                                    <li>
                                        <a href="index.php?do=ptk">
                                            <span class="head">Total PTK</span>
                                            <span class="number"><?php echo number_format(countEntries('ptk')); ?></span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="index.php?do=ptk&viewmode=new">
                                            <span class="head">PTK Baru Bulan Ini</span>
                                            <span class="number"><?php echo number_format($content->getPTKRegistedThisMonth()); ?></span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="index.php?do=sekolah">
                                            <span class="head">Total Sekolah</span>
                                            <span class="number"><?php echo number_format(countEntries('sekolah')); ?></span>
                                        </a>
                                    </li>
<!--                                     <li>
                                        <a href="index.php?do=tna_ptk">
                                            <span class="head">TNA Online Bulan Ini</span>
                                            <span class="number"><?php echo number_format($content->getPTK_TNAThisMonth()); ?></span>
                                        </a>
                                    </li> -->
                                </ul>
                               
                            </div>

                        </div><!-- End .box -->

                    </div><!-- End .span12 -->

                </div><!-- End .row-fluid -->

            </div><!-- End contentwrapper -->
        </div><!-- End #content -->
    
    </div><!-- End #wrapper -->

    <script type="text/javascript">

        $(document).ready(function(){


randNum = function(){
    //return Math.floor(Math.random()*101);
    return (Math.floor( Math.random()* (1+40-20) ) ) + 20;
}

var chartColours = ['#88bbc8', '#ed7a53', '#9FC569', '#bbdce3', '#9a3b1b', '#5a8022', '#2c7282'];

        // new reg PTK

        <?php

            $ptk_values = $content->getPTKRegistedDailyMonth(); 
            $tna_values = $content->getPTK_TNADailyMonth();

        ?>

        
        //var d1 = new Array();
        /*
        for (var i = 0; i < <?php echo date("t"); ?>;i++) {
            d1.push([i+1, 3+randNum()]);
        }
        */

        var d1 = <?php echo $ptk_values; ?>;

        
        // new tna online

        var d2 = <?php echo $tna_values; ?>;

        //define placeholder class
        var placeholder = $(".dashboard-chart");
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
                    grow: {
                        active: false,
                        stepMode: "linear",
                        steps: 50,
                        stepDelay: true
                    },
                    lines: {
                        show: true,
                        fill: true,
                        lineWidth: 4,
                        steps: false
                        },
                    points: {
                        show:true,
                        radius: 5,
                        symbol: "circle",
                        fill: true,
                        borderColor: "#fff"
                    }
                },
                legend: { 
                    position: "ne", 
                    margin: [0,-25], 
                    noColumns: 0,
                    labelBoxBorderColor: null,
                    labelFormatter: function(label, series) {
                        // just add some space to labes
                        return label+'&nbsp;&nbsp;';
                     }
                },
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
                    label: "PTK Baru", 
                    data: d1,
                    lines: {fillColor: "#f2f7f9"},
                    points: {fillColor: "#88bbc8"}
                } 
                // {   
                //     label: "TNA Online", 
                //     data: d2,
                //     lines: {fillColor: "#fff8f2"},
                //     points: {fillColor: "#ed7a53"}
                // } 

            ], options);


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
    <script type="text/javascript" src="plugins/charts/knob/jquery.knob.js"></script><!-- Circular sliders and stats -->


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
    <script type="text/javascript" src="plugins/fix/touch-punch/jquery.ui.touch-punch.min.js"></script><!-- Unable touch for JQueryUI -->
	
    <!-- Init plugins -->
    <script type="text/javascript" src="js/main.js"></script><!-- Core js functions -->
