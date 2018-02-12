<?php
  /**
   * Main
   *
   * @package SIM PPPPTK BMTI
   * @author a2ngsa
   * @copyright 2012
   * @version $Id: sekolah_rpkpp.php (admin), v1.00 2011-06-05 10:12:05 gewa Exp $
   */
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
	
?>
	<!-- Boostrap modal dialog -->
	<div id="RPKPPModal" class="modal hide fade" style="display: none;">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal"><span class="icon12 minia-icon-close"></span></button>
              <h3>Data Pengembangan Kompetensi dan Profesionalisme Pendidik</h3>
            </div>

            <div class="modal-body">		

                <form id="rpkpp_form" name="rpkpp_form" class="form-horizontal" method="post" action="">						
                <fieldset>
                    <input name="processSekolah_RPKPP" type="hidden" value="1">
                                                           
                    <div class="form-row row-fluid">
                        <div class="span12">
                            <div class="row-fluid">								
                                <label class="form-label span4" for="normal">Jenis Pengembangan Kompetensi :</label>
                                <input type="text" class="span6" name="jenis_pengembangan" id="rpkpp_jenis_pengembangan" maxlength="100" value=""/>
                            </div>
                        </div>
                    </div>
                    <div class="form-row row-fluid">
                        <div class="span12">
                            <div class="row-fluid">								
                                <label class="form-label span4" for="normal">Jumlah Guru :</label>
                                <input type="text" class="span2" name="jml_guru" id="rpkpp_jml_guru" maxlength="4" value="0"/>
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
              <a href="javascript: submitRPKPP()" class="btn btn-primary">Save</a>
            </div>
	</div>

	<script type="text/javascript">

            function loadRPKPPList() {
                    $('#loader').fadeIn(200);
                    $.ajax({
                            type: 'post',
                            url: "controller_sekolah.php",
                            data: 'loadSekolah_RPKPP=' + <?php echo Filter::$id;?>,
                            cache: false,
                            success: function (html) {
                                    $("#sekolah_rpkpp").html(html);
                            }
                    });
                    $('#loader').fadeOut(200);
            }                        

            function submitRPKPP() {
                var str = $('#rpkpp_form').serialize();
                   
                $('#RPKPPModal').modal('hide');
                
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
                                $(loadRPKPPList()).fadeIn("slow");
                        }, 2000);                            
                    }
                });
                                                
            }

            $(document).ready(function() {
                                                 
                $('#btnRPKPPadd').live('click', function () {

                    $('#RPKPPModal').modal();

                    return false;
                  });
                                         
            });
	  
	</script>		
