<?php
  /**
   * Main
   *
   * @package SIM PPPPTK BMTI
   * @author a2ngsa
   * @copyright 2012
   * @version $Id: sekolah_tanah.php (admin), v1.00 2011-06-05 10:12:05 gewa Exp $
   */
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
	
?>
	<!-- Boostrap modal dialog -->
	<div id="TanahModal" class="modal hide fade" style="display: none;">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal"><span class="icon12 minia-icon-close"></span></button>
              <h3>Data Kualifikasi, Status, Jns Kelamin dan Jumlah Pendidik</h3>
            </div>

            <div class="modal-body">		

                <form id="tanah_form" name="tanah_form" class="form-horizontal" method="post" action="">						
                <fieldset>
                    <input name="processSekolah_Tanah" type="hidden" value="1">
                                                           
                    <div class="form-row row-fluid">
                        <div class="span12">
                            <div class="row-fluid">								
                                <label class="form-label span4" for="normal">Kepemilikan :</label>
                                <input type="text" class="span4" name="kepemilikan" id="tanah_kepemilikan" maxlength="50" value=""/>
                            </div>
                        </div>
                    </div>
                    <div class="form-row row-fluid">
                        <div class="span12">
                            <div class="row-fluid">								
                                <label class="form-label span4" for="normal">Status :</label>
                                <input type="text" class="span4" name="status" id="tanah_status" maxlength="50" value=""/>
                            </div>
                        </div>
                    </div>

                    <div class="form-row row-fluid">
                        <div class="span12">
                            <div class="row-fluid">								
                                <label class="form-label span4" for="normal">Luas (m2) :</label>
                                <input type="text" class="span2" name="luas" id="tanah_luas" maxlength="5" value="0"/>
                            </div>
                        </div>
                    </div>
                    <div class="form-row row-fluid">
                        <div class="span12">
                            <div class="row-fluid">								
                                <label class="form-label span4" for="normal">Luas Tanah Terbangun (m2) :</label>
                                <input type="text" class="span2" name="luas_tt" id="tanah_luas_tt" maxlength="5" value="0"/>
                            </div>
                        </div>
                    </div>
                    <div class="form-row row-fluid">
                        <div class="span12">
                            <div class="row-fluid">								
                                <label class="form-label span4" for="normal">Luas Tanah Siap Bangun (m2) :</label>
                                <input type="text" class="span2" name="luas_tsb" id="tanah_luas_tsb" maxlength="5" value="0"/>
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
              <a href="javascript: submitTanah()" class="btn btn-primary">Save</a>
            </div>
	</div>

	<script type="text/javascript">

            function loadTanahList() {
                    $('#loader').fadeIn(200);
                    $.ajax({
                            type: 'post',
                            url: "ajax/controller.php",
                            data: 'loadSekolah_Tanah=' + <?php echo $user->sekolahid;?>,
                            cache: false,
                            success: function (html) {
                                    $("#sekolah_tanah").html(html);
                            }
                    });
                    $('#loader').fadeOut(200);
            }                        

            function submitTanah() {
                var str = $('#tanah_form').serialize();
                   
                $('#TanahModal').modal('hide');
                
                $.ajax({
                    type: 'post',
                    url: "ajax/controller.php",
                    data: str,
                    success: function (res) {
                        $("#msgholder").html(res);
                        $("html, body").animate({
                                scrollTop: 0
                        }, 600);
                        setTimeout(function () {
                                $(loadTanahList()).fadeIn("slow");
                        }, 2000);                            
                    }
                });
                                                
            }

            $(document).ready(function() {
                                                 
                $('#btnTanahadd').live('click', function () {

                    $('#TanahModal').modal();

                    return false;
                  });
                                         
            });
	  
	</script>		
