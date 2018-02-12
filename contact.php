<?php
  /**
   * Index
   *
   * @package SIM PPPPTK BMTI
   * @author a2ngsa
   * @copyright 2012
   * @version $Id: index.php, v1.00 2011-07-10 10:12:05 gewa Exp $
   */
  define("_VALID_PHP", true);
  require_once("init.php");
  
  if ($user->logged_in)
      redirect_to("account.php");
	  	  
  if (isset($_POST['doLogin']))
      : $result = $user->login($_POST['username'], $_POST['password']);
  
  /* Login Successful */
  if ($result)
      : redirect_to("account.php");
  endif;
  endif;
?>

<?php include("header_public.php");?>

    <!-- Google maps -->
    <script src="http://maps.google.com/maps/api/js?sensor=false"></script>
    <script src="plugins/misc/gmaps/gmap3.min.js"></script>
    <script src="js/gmap3-custom.js"></script>   


        <!--Body content-->
        <div id="content" class="clearfix">
            <div class="contentwrapper"><!--Content wrapper-->

                <div class="heading">
                    <h3>Kontak</h3>                                       
                </div><!-- End .heading-->

                <!-- Build page from here: -->
                <div class="row-fluid">
                    <div class="span12">

                        <div class="box plain">

                            <div class="title">

                                <h4>
                                    <span class="icon16 icomoon-icon-info"></span>
                                    <span>PPPPTK BMTI Bandung :</span>
                                </h4>
                            </div>
                            <div class="content">
                                <h4>PPPPTK Bidang Mesin dan Teknik Industri Bandung :</h4>
                                <p>Jl. Pasantren KM. 2 Cibabat Cimahi - Bandung 40513 Jawa Barat<br>Telp. 022-665 2326 (Operator), 6654486 (Kapus); Fax. 022-665 4698</p>
                                <h4>API (Afiliasi Produksi dan Industri) PPPPTK Bidang Mesin dan Teknik Industri Bandung :</h4>
                                <p>Jl. Pasantren KM. 2 Cibabat Cimahi - Bandung 40513 Jawa Barat<br>Telp/Fax:. 022-6650540</p>
                                <h4>E-Mail :</h4>
                                <p><a href="mailto:info@tedcbandung.com">info@tedcbandung.com</a></p>

                                <div id="gmap-1" class="gmap"></div>
                            </div>

                        </div><!-- End .box -->

                    </div><!-- End .span12 -->				
                </div><!-- End .row-fluid -->
                <!--End page -->
                
            </div><!-- End contentwrapper -->
        </div><!-- End #content -->
        
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
	
<?php include("footer_public.php");?>
