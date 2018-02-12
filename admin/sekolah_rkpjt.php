<?php
  /**
   * Main
   *
   * @package SIM PPPPTK BMTI
   * @author a2ngsa
   * @copyright 2012
   * @version $Id: sekolah_rkpjt.php (admin), v1.00 2011-06-05 10:12:05 gewa Exp $
   */
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
	
?>
	<!-- Boostrap modal dialog -->
	<div id="RKPJTModal" class="modal hide fade" style="display: none;">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal"><span class="icon12 minia-icon-close"></span></button>
              <h3>Data Kualifikasi Pendidik dan Jumlah Tenaga Kependidikan</h3>
            </div>

            <div class="modal-body">		

                <form id="rkpjt_form" name="rkpjt_form" class="form-horizontal" method="post" action="">						
                <fieldset>
                    <input name="processSekolah_RKPJT" type="hidden" value="1">

                    <div class="form-row row-fluid">
                        <div class="span12">
                            <div class="row-fluid">								
                                <label class="form-label span4" for="normal">Tenaga Pendukung :</label>
                                <input type="text" class="span6" name="tenaga_pendukung" id="rkpjt_tenaga_pendukung" maxlength="100" value=""/>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-row row-fluid">
                        <div class="span12">
                            <div class="row-fluid">								
                                <label class="form-label span4" for="checkboxes">Tingkat Pendidikan:</label>
                                <div class="span4 controls">
                                    <select name="tingkat_pendidikan" id="rkpjt_tingkat_pendidikan">
                                        <?php echo $content->Sekolah_IjazahList(); ?>
                                    </select>							
                                </div>
                            </div>
                        </div>
                    </div>
                                       
                    <div class="form-row row-fluid">
                        <div class="span12">
                            <div class="row-fluid">								
                                <label class="form-label span4" for="normal">Jumlah :</label>
                                <input type="text" class="span2" name="jml" id="rkpjt_jml" maxlength="4" value="0"/>
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
              <a href="javascript: submitRKPJT()" class="btn btn-primary">Save</a>
            </div>
	</div>

	<script type="text/javascript">

            function loadRKPJTList() {
                    $('#loader').fadeIn(200);
                    $.ajax({
                            type: 'post',
                            url: "controller_sekolah.php",
                            data: 'loadSekolah_RKPJT=' + <?php echo Filter::$id;?>,
                            cache: false,
                            success: function (html) {
                                    $("#sekolah_rkpjt").html(html);
                            }
                    });
                    $('#loader').fadeOut(200);
            }                        

            function submitRKPJT() {
                var str = $('#rkpjt_form').serialize();
                   
                $('#RKPJTModal').modal('hide');
                
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
                                $(loadRKPJTList()).fadeIn("slow");
                        }, 2000);                            
                    }
                });
                                                
            }

            $(document).ready(function() {
                                                 
                $('#btnRKPJTadd').live('click', function () {

                    $('#RKPJTModal').modal();

                    return false;
                  });
                                         
            });
	  
	</script>		
