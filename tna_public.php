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

        <!--Body content-->
        <div id="content" class="clearfix">
            <div class="contentwrapper"><!--Content wrapper-->

                <div class="heading">

                    <h3>TNA (Training Need Analysis) Online</h3>                    
                    
                </div><!-- End .heading-->

                <!-- Build page from here: -->
                <div class="row-fluid">
                    <div class="span12">

                        <div class="box">

                            <div class="title">
                                <h4>
                                    <span class="icon16 icomoon-icon-info"></span>
                                    <span>Info :</span>
                                </h4>
                            </div>
                            
                            <div class="content">
                                <p>TNA <strong>(Training Need Analysis)</strong> Online adalah implementasi instrumen audit Kompetensi Keahlian bagi Pendidik dan Tenaga Kependidikan di seluruh Indonesia.<br>
Instrumen Audit Kompetensi Guru ini bukan merupakan <em>instrument test</em> yang bertujuan untuk menilai guru tetapi untuk:
                                <ul class="unstyled">
                                    <li><span class="icon12 minia-icon-checkmark green"></span>Mengidentifikasi bagian-bagian dari tiap kompetensi yang merupakan pengetahuan dan keahlian yang sudah dimiliki sebagai guru. Bagian ini menjadi kekuatan bagi guru (kompeten). Apabila  Anda merasa telah memiliki kompetensi sesuai dengan peryataan yang terdapat dalam instrumen  maka pilihlah kolom ya.</li>
                                    <li><span class="icon12 minia-icon-checkmark red"></span>Mengidentifikasi bagian-bagian dari tiap-tiap kompetensi yang masih memerlukan peningkatan pengetahuan, keahlian, dan penerapannya di kelas. Bagian-bagian ini merupakan bagian yang memerlukan pengembangan lebih lanjut (belum kompeten). Apabila Anda merasa tidak memiliki kompetensi sesuai dengan peryataan yang terdapat dalam instrumen maka pilihlah kolom tidak.</li>
                                </ul>
                                Untuk dapat mengakses fasilitas ini silahkan melakukan login menggunakan NUPTK atau NIP, atau <a href="register.php">registrasikan</a> data anda jika belum terdaftar atau silahkan <a href="index.php">Login</a> bila sudah terdaftar.<br>
                                <p><strong>INFO</strong> : Jika mengalami kesulitan mengakses situs TNA Online bisa menghubungi email: <strong>peserta@tedcbandung.com</strong>.</p>
                                <image src="images/p4tk_bmti/TNA Online Public.png">
                            </div>

                        </div><!-- End .box -->

                    </div><!-- End .span12 -->
                </div><!-- End .row-fluid -->
                
                <!--End page -->
                
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
	
<?php include("footer_public.php");?>
