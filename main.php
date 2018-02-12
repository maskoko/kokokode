<?php
  /**
   * Main
   *
   * @package SIM PPPPTK BMTI
   * @author a2ngsa
   * @copyright 2012
   * @version $Id: main.php, v1.00 2011-06-05 10:12:05 gewa Exp $
   */
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
?>

        <!--Body content-->
        <div id="content" class="clearfix">
            <div class="contentwrapper"><!--Content wrapper-->

                <div class="heading">
                    <h3>Halaman User Terdaftar</h3>
                </div><!-- End .heading-->
    				
                <!-- Build page from here: Usual with <div class="row-fluid"></div> -->

                <div class="row-fluid">
                    <div class="span12">

                        <div class="box plain">

                            <div class="title">
                                <h4>
                                    <span>:: Selamat Datang, User : <?php echo $user->username; ?> !</span>
                                </h4>
                            </div>
                            
                            <div class="content">
                                <p>SIM P4TK BMTI Bandung adalah aplikasi untuk mengakses informasi yang perlu diketahui oleh para Pendidik atau Tenaga Kependidikan seperti Daftar Sekolah, Guru, dan sebagainya, terutama informasi yang berkaitan dengan jadwal Pendidikan dan Pelatihan (Diklat_ yang diselenggarakan oleh P4TK BMTI Bandung.</p>
                                <p>Para Pendidik atau Tenaga Kependidikan bisa mendaftarkan diri sebagai Peserta Diklat secara online melalui dengan cara mengisi informasi dengan lengkap pada form registrasi yang telah disediakan atau klik di sini. Setelah mendaftar secara online, data Pendidik atau tenaga Kependidikan calon peserta diklat langsung tesimpan pada database SIM P4TK BMI Bandung.</p>
                                <h4>Ketentuan penggunaan akses SIM P4TK BMTI :</h4>
                                <ul class="unstyled">
                                    <li><span class="icon12 minia-icon-checkmark red"></span>Untuk mengakses sistem ini Anda harus mempunyai otorisasi yang diatur oleh System Administrator.</li>
                                    <li><span class="icon12 minia-icon-checkmark red"></span>Untuk mendapatkan otorisasi dari Administrator, Operator, Staf, Pendidik atau Tenaga Kependidikan harus mendaftar sebagai user SIM P4TK BMTI, sehingga dapat mengakses informasi yang disediakan oleh sistem lebih luas.</li>
                                    <li><span class="icon12 minia-icon-checkmark red"></span>Anda bertanggungjawab untuk menjaga semua informasi yang ada dalam sistem ini</li>                                        
                                </ul>
                            </div> <!-- end content -->

                        </div><!-- End .box -->

                    </div><!-- End .span12 -->
                </div><!-- End .row-fluid -->  
																		
            </div><!-- End contentwrapper -->
        </div><!-- End #content -->
    
    </div><!-- End #wrapper -->
	
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
