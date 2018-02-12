<?php
  /**
   * Main
   *
   * @package SIM PPPPTK BMTI
   * @author a2ngsa
   * @copyright 2012
   * @version $Id: sekolah_rptl.php (admin), v1.00 2011-06-05 10:12:05 gewa Exp $
   */
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
	
?>
	<!-- Boostrap modal dialog -->
	<div id="RPTLModal" class="modal hide fade" style="display: none;">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal"><span class="icon12 minia-icon-close"></span></button>
              <h3>Data Pendidik Mengajar Sesuai/Tidak Sesuai Latar Belakang Pendidikan</h3>
            </div>

            <div class="modal-body">		

                <form id="rptl_form" name="rptl_form" class="form-horizontal" method="post" action="">						
                <fieldset>
                    <input name="processSekolah_RPTL" type="hidden" value="1">
                    
                    <div class="form-row row-fluid">
                        <div class="span12">
                            <div class="row-fluid">								
                                <label class="form-label span4" for="normal">Mata Diklat/Pelajaran :</label>
                                <input type="text" class="span6" name="mata_diklat" id="rptl_mata_diklat" maxlength="100" value=""/>
                            </div>
                        </div>
                    </div>
                                       
                    <div class="form-row row-fluid">
                        <div class="span12">
                            <div class="row-fluid">								
                                <label class="form-label span4" for="normal">Jml Yg Sesuai :</label>
                                <input type="text" class="span2 jmlCalc" name="jml_sesuai" id="rptl_jml_sesuai" maxlength="4" value="0"/>
                            </div>
                        </div>
                    </div>
                    <div class="form-row row-fluid">
                        <div class="span12">
                            <div class="row-fluid">								
                                <label class="form-label span4" for="normal">Jml Yg Tdk Sesuai :</label>
                                <input type="text" class="span2 jmlCalc" name="jml_tsesuai" id="rptl_jml_tsesuai" maxlength="4" value="0"/>
                            </div>
                        </div>
                    </div>
                                        
                    <div class="form-row row-fluid">
                        <div class="span12">
                            <div class="row-fluid">								
                                <label class="form-label span4" for="normal">Jml Total :</label>
                                <input type="text" class="span2" name="jml_total" id="rptl_jml_total" maxlength="4" value="0" readonly/>
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
              <a href="javascript: submitRPTL()" class="btn btn-primary">Save</a>
            </div>
	</div>

	<script type="text/javascript">

            function loadRPTLList() {
                    $('#loader').fadeIn(200);
                    $.ajax({
                            type: 'post',
                            url: "ajax/controller.php",
                            data: 'loadSekolah_RPTL=' + <?php echo $user->sekolahid;?>,
                            cache: false,
                            success: function (html) {
                                    $("#sekolah_rptl").html(html);
                            }
                    });
                    $('#loader').fadeOut(200);
            }                        

            function submitRPTL() {
                var str = $('#rptl_form').serialize();
                   
                $('#RPTLModal').modal('hide');
                
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
                                $(loadRPTLList()).fadeIn("slow");
                        }, 2000);                            
                    }
                });
                                                
            }

            $(document).ready(function() {
                                                 
                $('#btnRPTLadd').live('click', function () {

                    $('#RPTLModal').modal();

                    return false;
                  });
                  
                  
                $('input.jmlCalc').each(function() {
                    $(this).keyup(function(){   
                        calculateTotal();
                    });
                });
                
                function calculateTotal() {
                    var jml_sesuai = parseInt( $('#rptl_jml_sesuai').val() ),
                        jml_tsesuai = parseInt( $('#rptl_jml_tsesuai').val() ),
                        jml_total = 0;
                        
                    if ( !isNaN( jml_sesuai ) ) {
                        
                        if ( !isNaN( jml_tsesuai ) )
                            jml_total = jml_sesuai + jml_tsesuai;
                        else
                            jml_total = jml_sesuai;
                        
                    } else {

                        if ( !isNaN( jml_tsesuai ) )
                            jml_total = jml_tsesuai;

                    }
                    
                    document.getElementById('rptl_jml_total').value = jml_total;
                    
                }

            });
	  
	</script>		
