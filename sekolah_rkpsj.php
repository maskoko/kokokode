<?php
  /**
   * Main
   *
   * @package SIM PPPPTK BMTI
   * @author a2ngsa
   * @copyright 2012
   * @version $Id: sekolah_rpksj.php (admin), v1.00 2011-06-05 10:12:05 gewa Exp $
   */
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
	
?>
	<!-- Boostrap modal dialog -->
	<div id="RKPSJModal" class="modal hide fade" style="display: none;">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal"><span class="icon12 minia-icon-close"></span></button>
              <h3>Data Kualifikasi, Status, Jns Kelamin dan Jumlah Pendidik</h3>
            </div>

            <div class="modal-body">		

                <form id="rkpsj_form" name="rkpsj_form" class="form-horizontal" method="post" action="">						
                <fieldset>
                    <input name="processSekolah_RKPSJ" type="hidden" value="1">
                    
                    <div class="form-row row-fluid">
                        <div class="span12">
                            <div class="row-fluid">								
                                <label class="form-label span4" for="checkboxes">Tingkat Pendidikan:</label>
                                <div class="span4 controls">
                                    <select name="tingkat_pendidikan" id="rkpsj_tingkat_pendidikan">
                                        <?php echo $content->Sekolah_IjazahList(); ?>
                                    </select>							
                                </div>
                            </div>
                        </div>
                    </div>
                                       
                    <div class="form-row row-fluid">
                        <div class="span12">
                            <div class="row-fluid">								
                                <label class="form-label span4" for="normal">GT PNS (L) - (P) :</label>
                                <input type="text" class="span2 jmlCalc" name="jml_gt_l" id="rkpsj_jml_gt_l" maxlength="4" value="0"/>
                                <input type="text" class="span2 jmlCalc" name="jml_gt_p" id="rkpsj_jml_gt_p" maxlength="4" value="0"/>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-row row-fluid">
                        <div class="span12">
                            <div class="row-fluid">								
                                <label class="form-label span4" for="normal">GTT PNS (L) - (P) :</label>
                                <input type="text" class="span2 jmlCalc" name="jml_gtt_l" id="rkpsj_jml_gtt_l" maxlength="4" value="0"/>
                                <input type="text" class="span2 jmlCalc" name="jml_gtt_p" id="rkpsj_jml_gtt_p" maxlength="4" value="0"/>
                            </div>
                        </div>
                    </div>

                    <div class="form-row row-fluid">
                        <div class="span12">
                            <div class="row-fluid">								
                                <label class="form-label span4" for="normal">Total :</label>
                                <input type="text" class="span2" name="jml_total" id="rkpsj_jml_total" maxlength="4" value="0" readonly/>
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
              <a href="javascript: submitRKPSJ()" class="btn btn-primary">Save</a>
            </div>
	</div>

	<script type="text/javascript">

            function loadRKPSJList() {
                    $('#loader').fadeIn(200);
                    $.ajax({
                            type: 'post',
                            url: "ajax/controller.php",
                            data: 'loadSekolah_RKPSJ=' + <?php echo $user->sekolahid;?>,
                            cache: false,
                            success: function (html) { 
                                    $("#sekolah_rkpsj").html(html);
                            }
                    });
                    $('#loader').fadeOut(200);
            }                        

            function submitRKPSJ() { 
                var str = $('#rkpsj_form').serialize();
                   
                $('#RKPSJModal').modal('hide');
                
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
                                $(loadRKPSJList()).fadeIn("slow");
                        }, 2000);                            
                    }
                });
                                                
            }

            $(document).ready(function() {
                                                 
                $('#btnRKPSJadd').live('click', function () {

                    $('#RKPSJModal').modal();

                    return false;
                  });
                 
                $('input.jmlCalc').each(function() {
                    $(this).keyup(function(){   
                        calculateTotal();
                    });
                });
                
                function calculateTotal() {
                    var jml_gt_l = parseInt( $('#rkpsj_jml_gt_l').val() ),
                        jml_gt_p = parseInt( $('#rkpsj_jml_gt_p').val() ),
                        jml_gtt_l = parseInt( $('#rkpsj_jml_gtt_l').val() ),
                        jml_gtt_p = parseInt( $('#rkpsj_jml_gtt_p').val() ),
                        jml_total = 0;
                        
                    if ( !isNaN( jml_gt_l ) && !isNaN( jml_gt_p ) && !isNaN( jml_gtt_l ) && !isNaN( jml_gtt_p ) )                        
                        jml_total = jml_gt_l + jml_gt_p + jml_gtt_l + jml_gtt_p;
                                            
                    document.getElementById('rkpsj_jml_total').value = jml_total;
                    
                }
                                  
            });
	  
	</script>		
