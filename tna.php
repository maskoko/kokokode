<?php
  /**
   * Main
   *
   * @package SIM PPPPTK BMTI
   * @author a2ngsa
   * @copyright 2012
   * @version $Id: tna.php, v1.00 2011-06-05 10:12:05 gewa Exp $
   */
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
?>

	<?php
		if(isset(Filter::$get['step']))
			$step = Filter::$get['step'];
		else
			$step = 1; 
			
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
			
        if(isset(Filter::$get['kelid']))
            $kelid = Filter::$get['kelid'];
        else
            $kelid = 0;

        if(isset(Filter::$get['mp1id']))
            $mp1id = Filter::$get['mp1id'];
        else
            $mp1id = 0; 

        if(isset(Filter::$get['mp2id']))
            $mp2id = Filter::$get['mp2id'];
        else
            $mp2id = 0;

        if(isset(Filter::$get['id']))
            $ptk_tnaid = Filter::$get['id'];
        else
            $ptk_tnaid = 0;        

	?>

        <!--Body content-->
        <div id="content" class="clearfix">
            <div class="contentwrapper"><!--Content wrapper-->

                <div class="heading">

                    <h3>TNA Online ( Training Need Analys )</h3>                    

                </div><!-- End .heading-->
    				
                <!-- Build page from here: Usual with <div class="row-fluid"></div> -->

                <div class="row-fluid">
                    <div class="span12">

		<?php if ($step == 1) : ?>
		
                        <div class="box">

                            <div class="title">
                                <h4> 
                                    <span>History</span>
                                </h4>								
                            </div>

                            <div class="content">
                                
                            <?php 
                            
                                $rows = $content->getTNA_PTKByPTKId($user->ptkid, $user->usermode);
              
                            ?>

                                <table class="responsive table table-striped table-bordered table-sorting table-condensed">
                                    <thead>
                                        <tr>
                                            <th width="80">Waktu</th>
                                            <th>Paket Keahlian / Mata Pelajaran</th>
                                            <th>Sekolah/Lembaga</th>
                                            <th width="60">Nilai (%)</th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                    <?php if(!$rows):?>
                                        <tr>
                                            <td colspan="4"><?php echo Filter::msgInfo(lang('NO_DATA'), false);?></td>
                                        </tr>

                                    <?php else:?>
                                    <?php foreach ($rows as $row):?>

                                        <tr>
                                            <td><?php echo date("d/m/Y", strtotime($row->created));?></td>
                                            <td style="text-align: left;"><?php if ($row->kelid == 3) echo $row->nama_kompetensi; else echo $row->nama_matapelajaran; ?></td>
                                            <td style="text-align: left;"><?php if ($user->usermode == "S") echo $row->nama_lembaga; else echo $row->nama_sekolah; ?></td>
                                            <td style="text-align: center;"><?php echo (int)(($row->nilai_total / $row->nilai_instrumen) * 100 + .5); ?></td>
                                        </tr>

                                    <?php endforeach;?>
                                    <?php unset($row);?>
                                    <?php endif;?>                  

                                    </tbody>

                                    <tfoot>
                                        <tr>
                                            <td colspan="7">
                                                <div class="span4">
                                                    <?php if ($rows): ?>
                                                    <strong>Data&nbsp;:&nbsp;<span class="label label-info"><?php echo number_format(count($rows));?></span></strong>
                                                    <?php else: ?>
                                                    <strong>Tidak ada data.</strong>
                                                    <?php endif; ?>
                                                </div>
                                            </td>                                           
                                        </tr>                                       
                                    </tfoot>

                                </table>

                            </div>

                        </div>

                        <div class="box">

                            <div id="msgholder"></div>

                            <div class="title">
                                <h4>
                                    <span class="icon16 icomoon-icon-equalizer-2"></span>
                                    <span>Pilihan Kompetensi :</span>
                                    <span id="loader" class="loader" style="display:none"><img src="images/loader_circular.gif" width="16" height="16" alt=""></span>
                                </h4>
                            </div>

                            <div class="content">

                                <?php $bsk = $content->getBSKList();?>

                                <form id="step1_form" class="form-horizontal" method="post" action="">
                                <fieldset>

                                    <input name="do" type="hidden" value="tna" />

    
                                <ul id="tna_tab" class="nav nav-tabs pattern">
                                        <li class="active"><a href="#P_3" data-toggle="tab">PRODUKTIF</a></li>
                                        <li><a href="#P_1" data-toggle="tab">ADAPTIF</a></li>
                                        <li><a href="#P_2" data-toggle="tab">NORMATIF</a></li>
                                    </ul>

                                    <div class="tab-content">
                                        <div class="tab-pane fade in active" id="P_3">
                                            
                                        <div class="form-row row-fluid">
                                            <div class="span12">
                                                <div class="row-fluid">
                                                    <label class="form-label span3" for="checkbox">Bidang Keahlian:</label>
                                                    <div class="span8 controls">
                                                        <select name="bskid" id="bskid">
                                                            <option value=""><?php echo lang('SELECT');?></option>
                                                            <?php if ($bsk):?>
                                                                <?php foreach ($bsk as $prow):?>
                                                                    <option value="<?php echo $prow->id;?>"><?php echo $prow->nama_bidang;?></option>
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
                                                            <option value=""><?php echo lang('SELECT');?></option>
                                                            <?php if (isset($psk)):?>
                                                                <?php foreach ($psk as $prow):?>
                                                                    <option value="<?php echo $prow->id;?>"><?php echo $prow->nama_program;?></option>
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
                                                            <option value=""><?php echo lang('SELECT');?></option>
                                                            <?php if (isset($kk)):?>
                                                                <?php foreach ($kk as $prow):?>
                                                                    <option value="<?php echo $prow->id;?>"><?php echo $prow->nama_kompetensi;?></option>
                                                                <?php endforeach;?>
                                                                <?php unset($prow);?>
                                                            <?php endif;?>
                                                        </select>                   
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        </div>
                                        <div class="tab-pane fade" id="P_1">
                                            
                                            <div class="form-row row-fluid">
                                                <div class="span12">
                                                    <div class="row-fluid">
                                                        <label class="form-label span3" for="checkbox">Mata Pelajaran:</label>
                                                        <div class="span8 controls">
                                                            <select name="mp1id" id="mp1id">
                                                                <option value=""><?php echo lang('SELECT');?></option>
                                                                <?php

                                                                  $mp1 = $content->getMataPelajaranList(1);
                                                                  if (isset($mp1)):
                                                                ?>
                                                                    <?php foreach ($mp1 as $prow):?>
                                                                        <option value="<?php echo $prow->id;?>"><?php echo $prow->nama_matapelajaran;?></option>
                                                                    <?php endforeach;?>
                                                                    <?php unset($prow);?>
                                                                <?php endif;?>
                                                            </select>                   
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                        </div>
                                        <div class="tab-pane fade" id="P_2">
                                            
                                            <div class="form-row row-fluid">
                                                <div class="span12">
                                                    <div class="row-fluid">
                                                        <label class="form-label span3" for="checkbox">Mata Pelajaran:</label>
                                                        <div class="span8 controls">
                                                            <select name="mp2id" id="mp2id">
                                                                <option value=""><?php echo lang('SELECT');?></option>
                                                                <?php 

                                                                   $mp2 = $content->getMataPelajaranList(2);
                                                                   if (isset($mp2)):

                                                                 ?>
                                                                    <?php foreach ($mp2 as $prow):?>
                                                                        <option value="<?php echo $prow->id;?>"><?php echo $prow->nama_matapelajaran;?></option>
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

                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-info">Lanjut >></button>
                                    </div>

                                    <input name="kelid" type="hidden" value="3">
                                    <input name="step" type="hidden" value="2" />
                                    <input name="ptkid" type="hidden" value="<?php echo $user->ptkid;?>" />
                                    <input name="sekolahid" type="hidden" value="<?php echo $user->sekolahid;?>" />

                                </fieldset>
                                </form>    

                            </div> <!-- end .content -->

                        </div> <!-- end box -->
                
		<?php elseif ($step == 2) : ?>

                        <?php

                            $row = $content->getTNA_KKByKKId($kelid, $kkid);
                            if ($row) :

                        ?>

                        <div class="box">

                            <div class="title">
                                    <h4> 
                                        <span>Petunjuk</span>
                                    </h4>								
                            </div>

                            <div class="content">

                                <?php echo "<p>".$row->notes."</p>"; ?>

                            </div>

                        </div>
                        <?php endif; ?>

                        <div class="box">

                            <div id="msgholder"></div>

                            <div class="title">
                                <h4>
                                    <span class="icon16 icomoon-icon-equalizer-2"></span>
                                    <span>Instrumen Self-Assesment :</span>                                       
                                </h4>
                            </div>

                            <div class="content">

                                <form id="kd_form" class="form-horizontal" method="post" action="">
                                <fieldset>

                                    <input name="do" type="hidden" value="tna" />

                                    <table class="responsive table table-bordered">

                                        <thead>					
                                            <tr>
                                                <th rowspan="2" width="50" style="text-align: center;">No.</th>
                                                <th rowspan="2">KOMPETENSI DASAR</th>
                                                <th colspan="2" width="100">TINGKAT PENCAPAIAN KOMPETENSI</th>
                                            </tr>

                                            <tr>
                                                <th width="50" style="text-align: center;">Ya</th>
                                                <th width="50" style="text-align: center;">Tdk</th>
                                            </tr>										
                                        </thead>

                                        <tbody>

                                <?php 

                                    $kdrows = $content->getTNA_KD($kelid, $kkid);
                                    $nilai_instrumen = 0;

                                ?>

                                <?php if ($kdrows) : ?>


                                        <?php foreach ($kdrows as $kdrow):?>

                                                        <?php

                                                            $nilai_instrumen++;
                                                            
                                                            $indikator = '<p><u><strong>Indikator :&nbsp;</strong></u></p><ul>';

                                                            $kd_indikator = $content->getKD_Indikator($kdrow->id);
                                                            foreach ($kd_indikator as $indikator_row) {

                                                                $indikator .= '<li>' . $indikator_row->nama_indikator . '</li>';

                                                            }
                                                            $indikator .= '</ul>';
                                                        ?>

                                                        <tr>
                                                            <td style="text-align: right;"><?php echo $kdrow->kdno; ?></td>
                                                            <td style="text-align: left;" title="<?php echo $indikator; ?>" class="tip"><span id="<?php echo 'span_kd_'.$kdrow->id; ?>"><?php echo $kdrow->nama_kompetensi; ?></span></td>
                                                            <td align="center"><input type="radio" name="<?php echo 'kd_'.$kdrow->id; ?>" id="radioYes" value="1" class="required" style="color: red;" /></td>
                                                            <td align="center"><input type="radio" name="<?php echo 'kd_'.$kdrow->id; ?>" id="radioNo" value="0" class="required" /></td>
                                                        </tr>

                                        <?php endforeach;?>
                                        <?php unset($skrow);?>

                                                        <tr>
                                                                <td colspan="5"><button type="submit" class="btn btn-info">Simpan !</button></td>
                                                        </tr>

                                <?php endif; ?>


                                        </tbody>

                                    </table>

                                    <input name="step" type="hidden" value="3" />
                                    <input name="ptkid" type="hidden" value="<?php echo $user->ptkid;?>" />
                                    <input name="jenis" type="hidden" value="<?php echo $user->usermode;?>" />
                                    <input name="sekolahid" type="hidden" value="<?php echo $user->sekolahid;?>" />
                                    <input name="nilai_instrumen" type="hidden" value="<?php echo $nilai_instrumen;?>" />

                                    <input name="kelid" type="hidden" value="<?php echo $kelid;?>" />
                                    <input name="bskid" type="hidden" value="<?php echo $bskid;?>" />
                                    <input name="pskid" type="hidden" value="<?php echo $pskid;?>" />
                                    <input name="kkid" type="hidden" value="<?php echo $kkid;?>" />

                                </fieldset>
                                </form>    

                            </div> <!-- end .content -->
                        </div> <!-- end box -->
									
		<?php elseif ($step == 3) : ?>
		
                        <div class="box">

                            <div class="title">
                                <h4> 
                                    <span>Summary</span>
                                </h4>								
                            </div>

                            <div class="content">                                
                                <p>
                                <ul class="unstyled">
                                    <li><h3>Proses TNA Online berhasil</h3>Data akan kami proses lebih lanjut. Berikut adalah hasilnya :</li>
                                    <li><span class="icon16 icomoon-icon-arrow-right-2"></span>Kelompok: <strong class="red"><?php if ($kelid == 3) echo "PRODUKTIF"; else if ($kelid == 1) echo "ADAPTIF"; else echo "NORMATIF"; ?></strong></li>                                    
                                    <li><span class="icon16 icomoon-icon-arrow-right-2"></span><?php if ($kelid == 3) echo 'Paket Keahlian'; else echo 'Mata Pelajaran'; ?>: <strong class="red"><?php if ($kelid == 3) { $kk = $content->getKKInfo($kkid); if ($kk) echo $kk->nama_kompetensi; } else { $mp = $content->getMataPelajaranInfo($kkid); if ($mp) echo $mp->nama_matapelajaran; } ?></strong></li>
                                    <li><span class="icon16 icomoon-icon-arrow-right-2"></span>Nilai Kompetensi: <strong class="red"><?php $tna = $content->getPTK_TNAInfo($ptk_tnaid); $percent = (int)(($tna->nilai_total / $tna->nilai_instrumen) * 100 + .5); echo $percent . ' % ( ' . $tna->nilai_total . ' dari ' . $tna->nilai_instrumen . ' )'; ?></strong></li>
                                </ul>
                                </p>
                            </div>

                        </div>
							
		<?php endif; ?>
				
                    </div> <!-- span12 -->					
                </div>  <!-- row fluid -->
                    
            </div> <!-- End contentwrapper -->
        </div> <!-- End content -->

    </div><!-- End #wrapper -->
                        
    <script type="text/javascript">

        $(document).ready(function(){

            $("#bskid").change(function(){

                var id = $("#bskid").val();

                $.ajax({
                        type: 'post',
                        url: "ajax/controller.php",
                        data: "loadPSKList=" + id,
                        cache: false,
                        success: function(html) {
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
                        url: "ajax/controller.php",
                        data: "loadKKList=" + id,
                        cache: false,
                        success: function(html){
                                $("#kkid").html(html); 
                        }
                });

                $("#kkid").val("");
                $.uniform.update("#kkid");

            });


            $("#step1_form").validate({

                submitHandler: function(form) {

                    var myoptions = {                                              
                                  target: "#msgholder",
                                  beforeSubmit:  showLoader,
                                  success: showCheckResponse,
                                  url: "ajax/controller.php",
                                  resetForm : 0,
                                  clearForm : 0,
                                  data: {
                                          checkPTK_TNA: 1
                                  }
                    };

                    var kelid = $('input[name=kelid]').val();
                    var kkid = 0;

                    if (kelid == 1) {
                        var kkid = $('#mp1id').val();

                    } else if (kelid == 2) {
                        var kkid = $('#mp2id').val();

                    } else {
                        var kkid = $('#kkid').val();

                    }

                    if (kkid != "") {

                        $(form).ajaxSubmit(myoptions);

                    }
                    else {
                        if (kelid == 1 || kelid == 2)
                            alert("Mata Pelajaran belum dipilih!");
                        else
                            alert("Paket Keahlian belum dipilih!");

                        return false;
                    }

                }

            }); 

                function showCheckResponse(msg) {
                    
                    hideLoader();

                    if ($.trim(msg) == "OK") {
                        
                        var kelid = $('input[name=kelid]').val();

                        var kkid;
                        if (kelid == 3) {
                            var bskid = $("#bskid").val();
                            var pskid = $("#pskid").val();
                            var kkid = $("#kkid").val();
                            window.location.href="account.php?do=tna&step=2&bskid=" + bskid + "&pskid=" + pskid + "&kkid=" + kkid + "&kelid=" + kelid;
                        }                            
                        else if (kelid == 1) {
                            var kkid = $("#mp1id").val();
                            window.location.href="account.php?do=tna&step=2&kkid=" + kkid + "&kelid=" + kelid;
                        }                            
                        else {
                            var kkid = $("#mp2id").val();
                            window.location.href="account.php?do=tna&step=2&kkid=" + kkid + "&kelid=" + kelid;
                        }
                                                                            
                    } else {

                        $(this).html(msg);
                        $("html, body").animate({
                            scrollTop: 0
                        }, 600);

                    }

              }

            $("#kd_form").validate({

                    submitHandler: function(form) {

                      var myoptions = {                                
                                      target: "#msgholder",
                                      beforeSubmit:  showLoader,
                                      success: showResponse,
                                      url: "ajax/controller.php",
                                      resetForm : 0,
                                      clearForm : 0,
                                      data: {
                                              processPTK_TNA: 1
                                      }
                                    };

                      $(form).ajaxSubmit(myoptions);

                    },                            

                    errorElement: "span",
                    errorClass: "red",


                    errorPlacement: function(error, element) {
                       if (element.attr('type') === 'radio') {

                          element.closest('td').prev().append( error ); 

                       }
                       else {
                          error.insertAfter(element);
                       }
                    }
                        
                        /*
                        highlight: function (element) { // hightlight error inputs
                            //alert($(element).closest('span').html());
                            //$(element).closest('span').addClass('red');
                            $(element).closest('td').prev().closest('span').addClass('red');
                                //.closest('.span').removeClass("has-success").addClass('has-error'); // set error class to the control group   
                        },

                        unhighlight: function (element) { // revert the change done by hightlight
                            
                        },

                        success: function (label, element) {
                            //$(element).closest('span').removeClass('red');
                            $(element).closest('td').prev().closest('span').removeClass('red');
                            //$(element).closest('.span').removeClass('red').addClass('has-success'); // set success class to the control group
                        }*/
    


                });


                $('.required').each(function() {
                    $(this).rules('add', {
                        messages: {
                            required: " : (belum isi !)"
                        }
                    });
                });

                  function showLoader() {
                        $("#loader").fadeIn(200);
                  }

                  function hideLoader() {
                          $("#loader").fadeOut(200);
                  };	

                  function showResponse(msg) {
                          hideLoader();

                          var posstr = msg.indexOf("OK : ");
                          if (posstr > -1) {
    
                            var ptk_tnaid = msg.substr(posstr + 5);

                            window.location.href="account.php?do=tna&step=3&bskid=<?php echo $bskid; ?>&pskid=<?php echo $pskid; ?>&kkid=<?php echo $kkid; ?>&kelid=<?php echo $kelid; ?>" + "&id=" + ptk_tnaid;

                          } else {

                              $(this).html(msg);
                              $("html, body").animate({
                                      scrollTop: 0
                              }, 600);

                          }
                          
                  }


            // -- tab --

            $('#tna_tab a').click(function (e) {
                e.preventDefault();
                
                var href = $(this).attr("href");


                if (href == "#P_1")
                    $('input[name=kelid]').val('1');
                else if (href == "#P_2")
                    $('input[name=kelid]').val('2');
                else
                    $('input[name=kelid]').val('3');

            })

        });

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
    <script type="text/javascript" src="js/main.js"></script><!-- Core js functions -->
