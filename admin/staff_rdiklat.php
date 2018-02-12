<?php
  /**
   * Main
   *
   * @package SIM PPPPTK BMTI
   * @author a2ngsa
   * @copyright 2012
   * @version $Id: staf_rdiklat.php (admin), v1.00 2011-06-05 10:12:05 gewa Exp $
   */
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
	
?>
	<!-- Boostrap modal dialog -->
	<div id="RDiklatModal" class="modal hide fade" style="display: none;">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal"><span class="icon12 minia-icon-close"></span></button>
              <h3>Data Riwayat Diklat</h3>
            </div>

            <div class="modal-body">		

                <form id="rdiklat_form" name="rdiklat_form" class="form-horizontal" method="post" action="">						
                <fieldset>
                    <input name="processRDiklat" type="hidden" value="1">
                    
                    <div class="form-row row-fluid">
                        <div class="span12">
                            <div class="row-fluid">								
                                <label class="form-label span4" for="checkboxes">Tingkat:</label>
                                <div class="span4 controls">
                                    <select name="tingkat" id="rdiklat_status" class="nostyle">
                                        <?php echo $content->Diklat_TingkatList(); ?>
                                    </select>							
                                </div>
                            </div>
                        </div>
                    </div>
                                        
                    <div class="form-row row-fluid">
                        <div class="span12">
                            <div class="row-fluid">								
                                <label class="form-label span4" for="normal">Nama Diklat:</label>
                                <input type="text" class="span6" name="nama_diklat" id="rdiklat_nama_diklat" maxlength="200" value=""/>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-row row-fluid">
                        <div class="span12">
                            <div class="row-fluid">
                                <label class="form-label span4" for="normal">Tempat:</label>
                                <input type="text" class="span6" name="tempat" id="rdiklat_tempat" maxlength="100" value=""/>
                            </div>
                        </div>
                    </div>

                    <div class="form-row row-fluid">
                        <div class="span12">
                            <div class="row-fluid">								
                                <label class="form-label span4" for="normal">Tahun :</label>
                                <input type="text" class="span2" name="tahun" id="rdiklat_tahun" maxlength="4" value=""/>
                            </div>
                        </div>
                    </div>
                     
                    <div class="form-row row-fluid">
                        <div class="span12">
                            <div class="row-fluid">								
                                <label class="form-label span4" for="checkboxes">Status:</label>
                                <div class="span4 controls">
                                    <select name="sttpl" id="rdiklat_sttpl" class="nostyle">
                                        <option value="L">Lulus</option>
                                        <option value="T">Tidak Lulus</option>
                                    </select>							
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <input name="dataid" type="hidden" value="0" />
                    <input name="staffid" type="hidden" value="<?php echo Filter::$id;?>" />
                    <input name="userid" type="hidden" value="<?php echo $user->uid;?>" />

                </fieldset>
                </form>       

            </div>

            <div class="modal-footer">
              <a href="#" class="btn" data-dismiss="modal">Close</a>
              <a href="javascript: submitRDiklat()" class="btn btn-primary">Save</a>
            </div>
	</div>

	<script type="text/javascript">

            function loadRDiklatList() {
                    $('#loader').fadeIn(200);
                    $.ajax({
                            type: 'post',
                            url: "controller_staff.php",
                            data: 'loadRDiklat=' + <?php echo Filter::$id;?>,
                            cache: false,
                            success: function (html) {
                                    $("#staff_rdiklat").html(html);
                            }
                    });
                    $('#loader').fadeOut(200);
            }                        

            function submitRDiklat() {
                var str = $('#rdiklat_form').serialize();
                
                $('#RDiklatModal').modal('hide');
                
                $.ajax({
                    type: 'post',
                    url: "controller_staff.php",
                    data: str,
                    success: function (res) {
                        $("#msgholder").html(res);
                        $("html, body").animate({
                                scrollTop: 0
                        }, 600);
                        setTimeout(function () {
                                $(loadRDiklatList()).fadeIn("slow");
                        }, 2000);                            
                    }
                });
                                                
            }

            $(document).ready(function() {
                                                 
                $('#btnRDiklatadd').live('click', function () {

                    $('input[name=dataid]', '#rdiklat_form').val(0);
                    $('select[name=tingkat]', '#rdiklat_form').val('');
                    $('input[name=nama_diklat]', '#rdiklat_form').val('');
                    $('input[name=tempat]', '#rdiklat_form').val('');
                    $('select[name=sttpl]', '#rdiklat_form').val('');
                    $('input[name=tahun]', '#rdiklat_form').val('');

                    $('#RDiklatModal').modal();

                    return false;
                  });
                  
                $('.tip.doEditrdiklat').live('click', function(e) {
                        e.preventDefault();

                        var tname = $(this).data('tname');
                        var id = $(this).data('id');

                        $.ajax({
                            type: 'post',
                            url: 'controller_staff.php',
                            data: 'getDatadetail=' + tname + '&id=' + id,
                            dataType: 'json',
                            success: function (res) {
                                $('input[name=dataid]', '#rdiklat_form').val(res.data.id);
                                $('input[name=tingkat]', '#rdiklat_form').val(res.data.tingkat);
                                $('input[name=nama_diklat]', '#rdiklat_form').val(res.data.nama_diklat);
                                $('input[name=tempat]', '#rdiklat_form').val(res.data.tempat);
                                $('select[name=sttpl]', '#rdiklat_form').val(res.data.sttpl);
                                $('input[name=tahun]', '#rdiklat_form').val(res.data.tahun);
                            }
                        });

                        $('#RDiklatModal').modal();

                        return false;

                });                                    
                                         
            });
	  
	</script>		
