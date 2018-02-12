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
      : if ($user->is_Admin()) redirect_to("admin/index.php"); else redirect_to("account.php");
  endif;
  endif;
?>

<?php include("header_public.php");?>

        <!--Body content-->
        <div id="content" class="clearfix">
            <div class="contentwrapper"><!--Content wrapper-->

                <div class="heading">
                    <h3>Selamat Datang</h3>                    
                </div><!-- End .heading-->                
                
                <!-- Build page from here: -->
                <div class="row-fluid">
                    <div class="span12">
                        
                        <div class="box">
                            
                            <div class="title">
                                <h4>
                                    <span class="icon16 icomoon-icon-pencil"></span>
                                    <span>News</span>
                                </h4>
                            </div>
                            
                            <div class="content">
                                <p>SIM P4TK BMTI Bandung adalah aplikasi untuk mengakses informasi yang perlu diketahui oleh para Pendidik atau Tenaga Kependidikan seperti Daftar Sekolah, Guru, dan sebagainya, terutama informasi yang berkaitan dengan jadwal Pendidikan dan Pelatihan (Diklat_ yang diselenggarakan oleh P4TK BMTI Bandung.</p>
<p>Para Pendidik atau Tenaga Kependidikan bisa mendaftarkan diri sebagai Peserta Diklat secara online melalui dengan cara mengisi informasi dengan lengkap pada form registrasi yang telah disediakan atau <strong>klik</strong> <button type="button" class="btn btn-warning" onclick="location.href='register.php'">Registrasi</button> di sini. Setelah mendaftar secara online, data Pendidik atau tenaga Kependidikan calon peserta diklat langsung tesimpan pada database SIM P4TK BMI Bandung.</p>
                                <h4>Ketentuan penggunaan akses SIM P4TK BMTI :</h4>
                                <ul class="unstyled">
                                    <li><span class="icon12 minia-icon-checkmark red"></span>Untuk mengakses sistem ini Anda harus mempunyai otorisasi yang diatur oleh System Administrator.</li>
                                    <li><span class="icon12 minia-icon-checkmark red"></span>Untuk mendapatkan otorisasi dari Administrator, Operator, Staf, Pendidik atau Tenaga Kependidikan harus mendaftar sebagai user SIM P4TK BMTI, sehingga dapat mengakses informasi yang disediakan oleh sistem lebih luas.</li>
                                    <li><span class="icon12 minia-icon-checkmark red"></span>Anda bertanggungjawab untuk menjaga semua informasi yang ada dalam sistem ini</li>                                        
                                </ul>
                                <p><strong>INFO</strong> : Jika mengalami kesulitan mengakses situs TNA Online bisa menghubungi email: <strong>peserta@tedcbandung.com</strong>.</p>
                            </div>
                        </div><!-- End .box -->
                        
                    </div><!-- End .span12 -->
                </div><!-- End .row-fluid -->
                
                <div class="row-fluid">
                    <div class="span6">

                        <div class="row-fluid">

                            <div class="box boxMargin">

                                <div class="title">
                                    <h4>
                                        <span class="icon16 icomoon-icon-key-2"></span>
                                        <span>Login :</span>
                                    </h4>
                                </div>
                                
                                <div class="content" style="height:280px;">
                                    
                                    <div id="msgholder"><?php print Filter::$showMsg;?></div>
                                    
                                    <form class="form-horizontal" action="" id="loginForm" method="post" >

                                        <div class="form-row row-fluid">
                                            <div class="span12">
                                                <div class="row-fluid">
                                                    <label class="form-label span4" for="username">NUPTK atau NIP:</label>
                                                    <input class="span8 required" id="username" type="text" name="username" value="" maxlength="20"/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-row row-fluid">
                                            <div class="span12">
                                                <div class="row-fluid">
                                                    <label class="form-label span4" for="password">Password:</label>
                                                    <input class="span8 required" id="password" type="password" name="password" value="" maxlength="20"/>
                                                    <span class="forgot"><a href="forgotpassword.php">Lupa password?</a></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row row-fluid">
                                            <div class="span12">
                                                <div class="row-fluid">
                                                    <div class="form-actions">
                                                        <!-- <input type="checkbox" id="keepLoged" value="Value" class="styled" name="logged" /> Keep me logged in -->
                                                        <button type="submit" class="btn btn-info right" id="loginBtn"><span class="icon16 icomoon-icon-enter white"></span> Login</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <input name="doLogin" type="hidden" value="1" />

                                    </form>


                                </div>

                            </div><!-- End .box -->

                        </div><!-- End .row-fluid -->
                    </div><!-- End .span6 -->
                    
                    <div class="span6">

                        <div class="box">

                            <div class="title">
                                <h4>
                                    <span class="icon16 icomoon-icon-pencil"></span>
                                    <span>TNA Online</span>
                                </h4>
                            </div>
                            
                            <div class="content">
                                <div class="scroll" style="height:270px; overflow:auto; margin-top:10px;">
                                <p>TNA <strong>(Training Need Analysis)</strong> Online adalah implementasi instrumen audit Kompetensi Keahlian bagi Pendidik dan Tenaga Kependidikan di seluruh Indonesia.<br>
Instrumen Audit Kompetensi Guru ini bukan merupakan <em>instrument test</em> yang bertujuan untuk menilai guru tetapi untuk:
                                    <ul class="unstyled">
                                        <li><span class="icon12 minia-icon-checkmark green"></span>Mengidentifikasi bagian-bagian dari tiap kompetensi yang merupakan pengetahuan dan keahlian yang sudah dimiliki sebagai guru. Bagian ini menjadi kekuatan bagi guru (kompeten). Apabila  Anda merasa telah memiliki kompetensi sesuai dengan peryataan yang terdapat dalam instrumen  maka pilihlah kolom ya.</li>
                                        <li><span class="icon12 minia-icon-checkmark red"></span>Mengidentifikasi bagian-bagian dari tiap-tiap kompetensi yang masih memerlukan peningkatan pengetahuan, keahlian, dan penerapannya di kelas. Bagian-bagian ini merupakan bagian yang memerlukan pengembangan lebih lanjut (belum kompeten). Apabila Anda merasa tidak memiliki kompetensi sesuai dengan peryataan yang terdapat dalam instrumen maka pilihlah kolom tidak.</li>
                                    </ul>
                                </div>
                            </div>

                        </div><!-- End .box -->

                    </div><!-- End .span6 -->
                </div><!-- End .row-fluid -->
                
                <!--End page -->
                
            </div><!-- End contentwrapper -->
        </div><!-- End #content -->
    
    </div><!-- End #wrapper -->
    
    <script type="text/javascript">

        $(document).ready(function () {

            //------------- Custom scroll in widget box  -------------//
            if($(".scroll").length) {
                    $(".scroll").niceScroll({
                            cursoropacitymax: 0.7,
                            cursorborderradius: 6,
                            cursorwidth: "7px"
                    });
            }

        });		  

    </script>        
    
    <!-- Charts plugins -->
    <script type="text/javascript" src="plugins/charts/sparkline/jquery.sparkline.min.js"></script><!-- Sparkline plugin -->
    
    <!-- Misc plugins -->
    <script type="text/javascript" src="plugins/misc/nicescroll/jquery.nicescroll.min.js"></script>
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
    <script type="text/javascript" src="js/index.js"></script>
	
<?php include("footer_public.php");?>
