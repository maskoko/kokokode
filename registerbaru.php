<?php
  /**
   * Register
   *
   * @package SIM PPPP4TK BMTI
   * @author a2ngsa
   * @copyright 2012
   * @version $Id: register.php, v2.00 2011-07-10 10:12:05 gewa Exp $
   */
  define("_VALID_PHP", true);
  require_once("init.php");
  
  if(!$core->enable_reg)
      redirect_to("index.php");
	  
  if ($user->logged_in)
      redirect_to("account.php");
?>

<?php include("header_public.php");?>

        <!--Body content-->
        <div id="content" class="clearfix">
            <div class="contentwrapper"><!--Content wrapper-->
                
                <div class="heading">
                    <h3>Registrasi untuk PTK</h3>                    
                </div><!-- End .heading-->
    				
                <!-- Build page from here: Usual with <div class="row-fluid"></div> -->

                <div class="row-fluid">
                    <div class="span12">

                        <div id="msgholder"><?php print Filter::$showMsg;?></div>                        
                        
                        <div class="box">

                            <div class="title">
                                <h4>
                                    <span>Data</span>
                                    <span id="loader" class="loader" style="display:none"><img src="images/loader_circular.gif" width="16" height="16" alt=""></span>
                                </h4>
                            </div>
                            
                            <div class="content">

                                <form id="user_form" class="form-horizontal" action="" method="post" >
                                <fieldset>
                                                                        
                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">
                                                <label class="form-label span3" for="normal">NUPTK:</label>
                                                <input name="nuptk" id="nuptk" type="text" class="span2 required"  maxlength="16"/>
                                                <span class="help-inline blue">: 16 digit numerik</span>
                                            </div>
                                        </div>
                                    </div>				

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">
                                                <label class="form-label span3" for="normal">NIP:</label>
                                                <input name="nip" id="nip" type="text" class="span2"  maxlength="18"/>
                                                <span class="help-inline blue">: 18 digit numerik</span>
                                            </div>
                                        </div>
                                    </div>				
                                                                                                            
                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid" id="checkrow">
                                                <label class="form-label span3" for="normal">Nama Lengkap:</label>
                                                <span id="getnamaptk">
                                                <input name="nama_lengkap" id="nama_lengkap" type="text" class="span6" maxlength="60"/>
                                                    <img src="images/ok-ico.png" alt="" id="yes" style="display:none" title="PTK terdaftar" /> 
                                                    <img src="images/error-ico.png" alt="" id="no" style="display:none" title="PTK tidak terdaftar" /> 
                                                    <span class="help-inline orange" id="checkmsg"></span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">                                
                                                <label class="form-label span3" for="normal">Sekolah : <span class="help-block">(Quick Search sekolah)</span></label></label>
                                                <input name="nama_sekolah" id="nama_sekolah" type="text" class="span6" value=""/>
                                            </div>
                                        </div>
                                    </div>                                    
                                    
                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">
                                                <label class="form-label span3" for="normal">E-Mail:</label>
                                                <input name="email" id="email" type="text" class="span9" maxlength="80"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">
                                                <label class="form-label span3" for="password">Password:</label>
                                                <input name="password" type="password" class="span4" maxlength="20" placeholder="Masukkan password"/>
                                                <input name="password2" type="password" class="span4" maxlength="20" placeholder="Ulangi password"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">
                                                <label class="form-label span3" for="normal">Kode Verifikasi: 
                                                    <span class="help-block">Ketik 5 angka tertera dikanan.</span></label>
                                                <input name="captcha" type="text" class="span2" maxlength="5"/>
                                                <img src="lib/captcha.php" alt="" class="captcha" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">
                                                <div class="form-actions">
                                                <div class="span3"></div>
                                                <div class="span9 controls">
                                                    <button type="submit" class="btn btn-info">Daftar !</button>
                                                </div>
                                                </div>
                                            </div>
                                        </div> 
                                    </div>

                                    <input name="sekolahid" id="sekolahid" type="hidden" value="" />
                                    <input name="doRegister" type="hidden" value="1" />
                                </fieldset>
                                </form>       

                            </div> <!-- End .content -->

                        </div><!-- End .box -->

                    </div><!-- End .span12 -->
                </div><!-- End .row-fluid -->  
																		
            </div><!-- End contentwrapper -->
        </div><!-- End #content -->
       
    </div><!-- End #wrapper -->
        
    <script type="text/javascript">
        // <![CDATA[
        function showLoader() {
            $("#loader").fadeIn(200);
        }

        function hideLoader() {
            $("#loader").fadeOut(200);
        };
        
        $(document).ready(function() {
            
                $("#user_form").submit(function () {

                    var str = $(this).serialize();

                    showLoader();

                    $.ajax({
                            type: "POST",
                            url: "ajax/user.php",
                            data: str,
                            success: function (msg) {
                                  $("#msgholder").ajaxComplete(function(event, request, settings) {

                                      if(msg.trim() === 'OK') {
                                          hideLoader();
                                          result = '<div class="alert alert-success"><h4 class="alert-heading">Registrasi PTK berhasil</h4>Anda bisa melakukan login dan melengkapi data identitas selanjutnya.</div>';
                                          $(".box").hide();
                                      } else {
                                        hideLoader();
                                        result = msg;					  
                                      }

                                      $(this).html(result);
                                  });
                              }
                      });
                      
                    return false;
                    
              });
                            
            $('#nuptk').keyup(nuptk_check);
            $('#nip').keyup(nip_check);
              
        });


        function nuptk_check() {
            
            var opt_nuptk = $("#opt_nuptk").attr("checked");
                        
            if (opt_nuptk == "checked") {
            
                var nuptk = $('#nuptk').val();

                if (nuptk != "" && nuptk.length == 16) {
                    
                    showLoader();
                    
                    $.ajax({
                            type: "POST",
                            url: "ajax/user.php",
                            data: 'checknuptk=' + nuptk,
                            success: function (msg) {
                                
                                hideLoader();

                                var posstr = msg.indexOf("OK : ");
                                
                                if (posstr > -1) {
                                    $('#no').hide();
                                    $('#yes').fadeIn();
                                                                        
                                    var nama_lengkap = msg.substr(posstr + 5);
                                    
                                    posstr = nama_lengkap.indexOf(" : ");
                                    if (posstr > -1) {
                                        var nama_sekolah = nama_lengkap.substr(posstr + 2);
                                        nama_lengkap = nama_lengkap.substr(0, posstr);
                                    } else
                                        var nama_sekolah = "";
                                    
                                    $('#nama_lengkap').val(nama_lengkap);
                                    $('#nama_sekolah').val(nama_sekolah);
                                } else {
                                    // -- nuptk not found / or already registered --
                                    $('#yes').hide();
                                    $('#no').fadeIn();
                                    
                                    $("#checkrow #checkmsg").text(msg);
                                }

                            }
                    });

                } else {
                    $('#yes').hide();
                    $('#no').fadeIn();
                    $("#checkrow #checkmsg").text('');
                }
            }
            
        }
        
        function nip_check() {
            
            var opt_nip = $("#opt_nip").attr("checked");
                        
            if (opt_nip == "checked") {
            
                var nip = $('#nip').val();

                if (nip != "" && nip.length == 18) {
                        //$('#yes').hide();
                                              $('#yes').hide();
                                              $('#no').fadeIn();

                                              //alert (opt_nuptk);
                                     $('#nama_sekolah').val(opt_nuptk);         
                                              

                } else {
                                              $('#no').hide();
                                              $('#yes').fadeIn();

                    /*
                        $.ajax ...

                        */
                }
            } else {
                $('#nama_sekolah').val('');
            }
            
        }
        

                
                $('#nama_sekolah').typeahead({
                   //
                   source: function(query, process){
                        data = [];
                        map = {};

                        $.ajax({
                            type: 'get',
                            url: "ajax/controller_public.php",
                            data: "sekolahsearch=" + query,
                            dataType: 'json',
                            success: function (res) { 

                                $.each(res, function (i, dt) {
                                    map[dt.nama_sekolah] = dt;
                                    data.push(dt.nama_sekolah);
                                }); 

                                process(data);

                            }
                        });
                   },

                   // panjang string (query) minimal untuk dikirim ke server
                   minLength:3,

                   updater: function (item) {
                        // lakukan apapun yang ingin dilakukan dengan ID data terpilih
                        selectedItem = map[item].nama_sekolah;

                        //$('#nama_lengkap').val(map[item].nama_lengkap);
                        //$('#sekolahid').val(map[item].id);
                        $('input[name=sekolahid]').val(map[item].id);

                        // penting! jangan hapus kode di bawah ini (used by typeahead)
                        return item;
                   }
                });                
                                                        

        // ]]>
    </script>

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
    <script type="text/javascript" src="js/register.js"></script>
                
<?php include("footer_public.php");?>
