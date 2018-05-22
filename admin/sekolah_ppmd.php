<?php
  /**
   * Main
   *
   * @package SIM PPPPTK BMTI
   * @author a2ngsa
   * @copyright 2012
   * @version $Id: sekolah_ppmd.php (admin), v1.00 2011-06-05 10:12:05 gewa Exp $
   */
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
	
?>
	<!-- Boostrap modal dialog -->
	<div id="PPMDModal" class="modal hide fade" style="display: none;">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal"><span class="icon12 minia-icon-close"></span></button>
              <h3>Data Pendidik/Guru Mata Diklat</h3>
            </div>

            <div class="modal-body">		

                <form id="ppmd_form" name="ppmd_form" class="form-horizontal" method="post" action="">						
                <fieldset>
                    <input name="processSekolah_PPMD" type="hidden" value="1">
                                                           
                    <div class="form-row row-fluid">
                        <div class="span12">
                            <div class="row-fluid">								
                                <label class="form-label span4" for="normal">Mata Diklat :</label>
                                <input type="text" class="span6" name="mata_diklat" id="ppmd_mata_diklat" maxlength="100" value=""/>
                            </div>
                        </div>
                    </div>
                    <div class="form-row row-fluid">
                        <div class="span12">
                            <div class="row-fluid">								
                                <label class="form-label span4" for="normal">Jml PNS - Non-PNS :</label>
                                <input type="text" class="span2" name="jml_pns" id="ppmd_jml_pns" maxlength="4" value="0"/>
                                <input type="text" class="span2" name="jml_nonpns" id="ppmd_jml_nonpns" maxlength="4" value="0"/>
                            </div>
                        </div>
                    </div>

                    <div class="form-row row-fluid">
                        <div class="span12">
                            <div class="row-fluid">								
                                <label class="form-label span4" for="normal">Jml Penugasan Tetap - Tidak Tetap :</label>
                                <input type="text" class="span2" name="jml_tetap" id="ppmd_jml_tetap" maxlength="4" value="0"/>
                                <input type="text" class="span2" name="jml_ttetap" id="ppmd_jml_ttetap" maxlength="4" value="0"/>
                            </div>
                        </div>
                    </div>
                         
                    <div class="form-row row-fluid">
                        <div class="span12">
                            <div class="row-fluid">								
                                <label class="form-label span4" for="checkboxes">Keterangan:</label>
                                <div class="span4 controls">
                                    <select name="keterangan" id="ppmd_keterangan">
                                        <?php echo $content->Kelompok_MataPelajaranList('NORMATIF'); ?>
                                    </select>							
                                </div>
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
              <a href="javascript: submitPPMD()" class="btn btn-primary">Save</a>
            </div>
	</div>

	<script type="text/javascript">

            function loadPPMDList() {
                    $('#loader').fadeIn(200);
                    $.ajax({
                            type: 'post',
                            url: "controller_sekolah.php",
                            data: 'loadSekolah_PPMD=' + <?php echo Filter::$id;?>,
                            cache: false,
                            success: function (html) {
                                    $("#sekolah_ppmd").html(html);
                            }
                    });
                    $('#loader').fadeOut(200);
            }                        

            function submitPPMD() {
                var str = $('#ppmd_form').serialize();
                   
                $('#PPMDModal').modal('hide');
                
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
                                $(loadPPMDList()).fadeIn("slow");
                        }, 2000);                            
                    }
                });
                                                
            }

            $(document).ready(function() {
                                                 
                $('#btnPPMDadd').live('click', function () {

                    $('#PPMDModal').modal();

                    return false;
                  });
                                         
            });
	  
	</script>		
