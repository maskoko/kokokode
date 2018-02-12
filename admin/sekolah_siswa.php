<?php
  /**
   * Main
   *
   * @package SIM PPPPTK BMTI
   * @author a2ngsa
   * @copyright 2012
   * @version $Id: sekolah_siswa.php (admin), v1.00 2011-06-05 10:12:05 gewa Exp $
   */
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
	
?>
	<!-- Boostrap modal dialog -->
	<div id="SiswaModal" class="modal hide fade" style="display: none;">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal"><span class="icon12 minia-icon-close"></span></button>
              <h3>Data Kualifikasi, Status, Jns Kelamin dan Jumlah Pendidik</h3>
            </div>

            <div class="modal-body">		

                <form id="siswa_form" name="siswa_form" class="form-horizontal" method="post" action="">						
                <fieldset>
                    <input name="processSekolah_Siswa" type="hidden" value="1">
                    
                    <?php $kk = $content->getKKList();?>

                    <div class="form-row row-fluid">
                        <div class="span12">
                            <div class="row-fluid">								
                                <label class="form-label span4" for="checkboxes">Paket Keahlian:</label>
                                <div class="span8 controls">
                                    <select name="kkid" id="siswa_kkid">
                                        <option value=""><?php echo lang('SELECT');?></option>
                                        <?php if ($kk):?>
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
                    
                    <div class="form-row row-fluid">
                        <div class="span12">
                            <div class="row-fluid">								
                                <label class="form-label span4" for="checkboxes">Akreditasi:</label>
                                <div class="span4 controls">
                                    <select name="akreditasi" id="siswa_akreditasi">
                                        <?php echo $content->SekolahAkreditasiList(); ?>
                                    </select>							
                                </div>
                            </div>
                        </div>
                    </div>
                                                                                                   
                    <div class="form-row row-fluid">
                        <div class="span12">
                            <div class="row-fluid">								
                                <label class="form-label span4" for="normal">Jml Tingkat 1 (L) - (P) :</label>
                                <input type="text" class="span2" name="jml_tk1_l" id="siswa_jml_tk1_l" maxlength="4" value="0"/>
                                <input type="text" class="span2" name="jml_tk1_p" id="siswa_jml_tk1_p" maxlength="4" value="0"/>
                            </div>
                        </div>
                    </div>

                    <div class="form-row row-fluid">
                        <div class="span12">
                            <div class="row-fluid">								
                                <label class="form-label span4" for="normal">Jml Tingkat 2 (L) - (P) :</label>
                                <input type="text" class="span2" name="jml_tk2_l" id="siswa_jml_tk2_l" maxlength="4" value="0"/>
                                <input type="text" class="span2" name="jml_tk2_p" id="siswa_jml_tk2_p" maxlength="4" value="0"/>
                            </div>
                        </div>
                    </div>

                    <div class="form-row row-fluid">
                        <div class="span12">
                            <div class="row-fluid">								
                                <label class="form-label span4" for="normal">Jml Tingkat 3 (L) - (P) :</label>
                                <input type="text" class="span2" name="jml_tk3_l" id="siswa_jml_tk3_l" maxlength="4" value="0"/>
                                <input type="text" class="span2" name="jml_tk3_p" id="siswa_jml_tk3_p" maxlength="4" value="0"/>
                            </div>
                        </div>
                    </div>
                    
                    <input name="sekolahid" type="hidden" value="<?php echo $row->id;?>" />
                    <input name="userid" type="hidden" value="<?php echo $user->uid;?>" />

                </fieldset>
                </form>       

            </div>

            <div class="modal-footer">
              <a href="#" class="btn" data-dismiss="modal">Close</a>
              <a href="javascript: submitSiswa()" class="btn btn-primary">Save</a>
            </div>
	</div>

	<script type="text/javascript">

            function loadSiswaList() {
                    $('#loader').fadeIn(200);
                    $.ajax({
                            type: 'post',
                            url: "controller_sekolah.php",
                            data: 'loadSekolah_Siswa=' + <?php echo Filter::$id;?>,
                            cache: false,
                            success: function (html) {
                                    $("#sekolah_siswa").html(html);
                            }
                    });
                    $('#loader').fadeOut(200);
            }                        

            function submitSiswa() {
                var str = $('#siswa_form').serialize();
                   
                $('#SiswaModal').modal('hide');
                
                $.ajax({
                    type: 'post',
                    url: "controller_sekolah.php",
                    data: str,
                    success: function (res) {
                        $("#msgholder").html(res);
                        $("html, body").animate({
                                scrollTop: 0
                        }, 600);
                        setTimeout(function () {
                                $(loadSiswaList()).fadeIn("slow");
                        }, 2000);                            
                    }
                });
                                                
            }

            $(document).ready(function() {
                                                 
                $('#btnSiswaadd').live('click', function () {

                    $('#SiswaModal').modal();

                    return false;
                  });
                                         
            });
	  
	</script>		
