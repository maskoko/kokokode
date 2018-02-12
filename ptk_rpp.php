<?php
  /**
   * Main
   *
   * @package SIM PPPPTK BMTI
   * @author a2ngsa
   * @copyright 2012
   * @version $Id: ptk_rpp.php (admin), v1.00 2011-06-05 10:12:05 gewa Exp $
   */
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
	
?>
	<!-- Boostrap modal dialog -->
	<div id="RPPModal" class="modal hide fade" style="display: none;">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal"><span class="icon12 minia-icon-close"></span></button>
              <h3>Data Riwayat Diklat Lain</h3>
            </div>

            <div class="modal-body">		

                <form id="rpp_form" name="rpp_form" class="form-horizontal" method="post" action="">						
                <fieldset>
                    <input name="processPTK_RPP" type="hidden" value="1">
                    
                    <div class="form-row row-fluid">
                        <div class="span12">
                            <div class="row-fluid">								
                                <label class="form-label span4" for="normal">Nama Diklat:</label>
                                <input type="text" class="span6" name="nama_diklat" id="rpp_nama_diklat" maxlength="200" value=""/>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-row row-fluid">
                        <div class="span12">
                            <div class="row-fluid">
                                <label class="form-label span4" for="normal">Peran:</label>
                                <input type="text" class="span6" name="peran" id="rpp_peran" maxlength="50" value=""/>
                            </div>
                        </div>
                    </div>

                    <div class="form-row row-fluid">
                        <div class="span12">
                            <div class="row-fluid">								
                                <label class="form-label span4" for="normal">Tahun :</label>
                                <input type="text" class="span2" name="tahun" id="rpp_tahun" maxlength="4" value=""/>
                            </div>
                        </div>
                    </div>

                    <div class="form-row row-fluid">
                        <div class="span12">
                            <div class="row-fluid">								
                                <label class="form-label span4" for="normal">Pola/Jam :</label>
                                <input type="text" class="span2" name="jml_jam" id="rpp_jml_jam" maxlength="5" value="1"/>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-row row-fluid">
                        <div class="span12">
                            <div class="row-fluid">								
                                <label class="form-label span4" for="normal">Penyelenggara :</label>
                                <input type="text" class="span6" name="penyelenggara" id="rpp_penyelenggara" maxlength="100" value=""/>
                            </div>
                        </div>
                    </div>

                    <div class="form-row row-fluid">
                        <div class="span12">
                            <div class="row-fluid">								
                                <label class="form-label span4" for="normal">Tingkat :</label>
                                <input type="text" class="span2" name="tingkat" id="rpp_tingkat" maxlength="15" value=""/>
                            </div>
                        </div>
                    </div>

                    <div class="form-row row-fluid">
                        <div class="span12">
                            <div class="row-fluid">								
                                <label class="form-label span4" for="normal">Kompetensi :</label>
                                <input type="text" class="span6" name="kompetensi" id="rpp_kompetensi" maxlength="200" value=""/>
                            </div>
                        </div>
                    </div>
                     
                    <div class="form-row row-fluid">
                        <div class="span12">
                            <div class="row-fluid">								
                                <label class="form-label span4" for="checkboxes">Status:</label>
                                <div class="span4 controls">
                                    <select name="status" id="rpp_status" class="nostyle">
                                        <?php echo $content->Status_LulusList(); ?>
                                    </select>							
                                </div>
                            </div>
                        </div>
                    </div>
                                     
                    <input name="dataid" type="hidden" value="0" />
                    <input name="ptkid" type="hidden" value="<?php echo $user->ptkid;?>" />
                    <input name="userid" type="hidden" value="<?php echo $user->uid;?>" />

                </fieldset>
                </form>       

            </div>

            <div class="modal-footer">
              <a href="#" class="btn" data-dismiss="modal">Close</a>
              <a href="javascript: submitRPP()" class="btn btn-primary">Save</a>
            </div>
	</div>

	<script type="text/javascript">

            function loadRPPList() {
                    $('#loader').fadeIn(200);
                    $.ajax({
                            type: 'post',
                            url: "ajax/controller.php",
                            data: 'loadPTK_RPP=' + <?php echo $user->ptkid;?>,
                            cache: false,
                            success: function (html) {
                                    $("#ptk_rpp").html(html);
                            }
                    });
                    $('#loader').fadeOut(200);
            }                        

            function submitRPP() {
                var str = $('#rpp_form').serialize();
                   
                $('#RPPModal').modal('hide');
                
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
                                $(loadRPPList()).fadeIn("slow");
                        }, 2000);                            
                    }
                });
                                                
            }

            $(document).ready(function() {
                                                 
                $('#btnRPPadd').live('click', function () {

                    $('input[name=dataid]', '#rpp_form').val(0);
                    $('input[name=nama_diklat]', '#rpp_form').val('');
                    $('input[name=peran]', '#rpp_form').val('');
                    $('input[name=tahun]', '#rpp_form').val('');
                    $('input[name=jml_jam]', '#rpp_form').val('');
                    $('input[name=penyelenggara]', '#rpp_form').val('');                    
                    $('input[name=tingkat]', '#rpp_form').val('');
                    $('input[name=kompetensi]', '#rpp_form').val('');
                    $('select[name=status]', '#rpp_form').val('');

                    $('#RPPModal').modal();

                    return false;
                  });
                  
                $('.tip.doEditrpp').live('click', function(e) {
                        e.preventDefault();

                        var tname = $(this).data('tname');
                        var id = $(this).data('id');

                        $.ajax({
                            type: 'post',
                            url: 'ajax/controller.php',
                            data: 'getPTKdetail=' + tname + '&id=' + id,
                            dataType: 'json',
                            success: function (res) {
                                $('input[name=dataid]', '#rpp_form').val(res.data.id);
                                $('input[name=nama_diklat]', '#rpp_form').val(res.data.nama_diklat);
                                $('input[name=peran]', '#rpp_form').val(res.data.peran);
                                $('input[name=tahun]', '#rpp_form').val(res.data.tahun);
                                $('input[name=jml_jam]', '#rpp_form').val(res.data.jml_jam);
                                $('input[name=penyelenggara]', '#rpp_form').val(res.data.penyelenggara);                    
                                $('input[name=tingkat]', '#rpp_form').val(res.data.tingkat);
                                $('input[name=kompetensi]', '#rpp_form').val(res.data.kompetensi);
                                $('select[name=status]', '#rpp_form').val(res.data.status);
                            }
                        });

                        $('#RPPModal').modal();

                        return false;

                });
                                         
            });
	  
	</script>		
