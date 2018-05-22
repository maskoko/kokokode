<?php
  /**
   * Main
   *
   * @package SIM PPPPTK BMTI
   * @author a2ngsa
   * @copyright 2012
   * @version $Id: ptk_rsertifikat.php (admin), v1.00 2011-06-05 10:12:05 gewa Exp $
   */
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
	
?>
	<!-- Boostrap modal dialog -->
	<div id="RSertifikatModal" class="modal hide fade" style="display: none;">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal"><span class="icon12 minia-icon-close"></span></button>
              <h3>Data Sertifikasi/Uji Kompetensi</h3>
            </div>

            <div class="modal-body">		

                <form id="rsertifikat_form" name="rsertifikat_form" class="form-horizontal" method="post" action="">						
                <fieldset>
                    <input name="processPTK_RSertifikat" type="hidden" value="1">
                    
                    <div class="form-row row-fluid">
                        <div class="span12">
                            <div class="row-fluid">								
                                <label class="form-label span4" for="normal">Nama Sertifikat:</label>
                                <input type="text" class="span6" name="nama_sertifikat" id="rsert_nama_sertifikat" maxlength="50" value=""/>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-row row-fluid">
                        <div class="span12">
                            <div class="row-fluid">
                                <label class="form-label span4" for="normal">Pelaksana:</label>
                                <input type="text" class="span6" name="pelaksana" id="rsert_pelaksana" maxlength="40" value=""/>
                            </div>
                        </div>
                    </div>
                     
                    <div class="form-row row-fluid">
                        <div class="span12">
                            <div class="row-fluid">								
                                <label class="form-label span4" for="checkboxes">Status:</label>
                                <div class="span4 controls">
                                    <select name="status" id="rsert_status" class="nostyle">
                                        <option value=""><?php echo lang('SELECT');?></option>
                                        <option value="Y">Ya</option>
                                        <option value="T">Tidak</option>
                                    </select>							
                                </div>
                            </div>
                        </div>
                    </div>
                                        
                    <div class="form-row row-fluid">
                        <div class="span12">
                            <div class="row-fluid">								
                                <label class="form-label span4" for="normal">Tahun :</label>
                                <input type="text" class="span2" name="tahun" id="rsert_tahun" maxlength="4" value=""/>
                            </div>
                        </div>
                    </div>
                                        
                    <input name="dataid" type="hidden" value="0" />
                    <input name="ptkid" type="hidden" value="<?php echo Filter::$id;?>" />
                    <input name="userid" type="hidden" value="<?php echo $user->uid;?>" />

                </fieldset>
                </form>       

            </div>

            <div class="modal-footer">
              <a href="#" class="btn" data-dismiss="modal">Close</a>
              <a href="javascript: submitRSertifikat()" class="btn btn-primary">Save</a>
            </div>
	</div>

	<script type="text/javascript">

            function loadRSertifikatList() {
                    $('#loader').fadeIn(200);
                    $.ajax({
                            type: 'post',
                            url: "controller_ptk.php",
                            data: 'loadPTK_RSertifikat=' + <?php echo Filter::$id;?>,
                            cache: false,
                            success: function (html) {
                                    $("#ptk_rsertifikat").html(html);
                            }
                    });
                    $('#loader').fadeOut(200);
            }                        

            function submitRSertifikat() {
                var str = $('#rsertifikat_form').serialize();
                   
                $('#RSertifikatModal').modal('hide');
                
                $.ajax({
                    type: 'post',
                    url: "controller_ptk.php",
                    data: str,
                    success: function (res) {
                        $("#msgholder").html(res);
                        $("html, body").animate({
                                scrollTop: 0
                        }, 600);
                        setTimeout(function () {
                                $(loadRSertifikatList()).fadeIn("slow");
                        }, 2000);                            
                    }
                });
                                                
            }

            $(document).ready(function() {
                                                 
                $('#btnRSertifikatadd').live('click', function () {

                    $('input[name=dataid]', '#rsertifikat_form').val(0);
                    $('input[name=nama_sertifikat]', '#rsertifikat_form').val('');
                    $('input[name=pelaksana]', '#rsertifikat_form').val('');
                    $('select[name=status]', '#rsertifikat_form').val('');
                    $('input[name=tahun]', '#rsertifikat_form').val('');

                    $('#RSertifikatModal').modal();

                    return false;
                  });
                  
                $('.tip.doEditrsertifikat').live('click', function(e) {
                        e.preventDefault();

                        var tname = $(this).data('tname');
                        var id = $(this).data('id');

                        $.ajax({
                            type: 'post',
                            url: 'controller_ptk.php',
                            data: 'getPTKdetail=' + tname + '&id=' + id,
                            dataType: 'json',
                            success: function (res) {
                                $('input[name=dataid]', '#rsertifikat_form').val(res.data.id);
                                $('input[name=nama_sertifikat]', '#rsertifikat_form').val(res.data.nama_sertifikat);
                                $('input[name=pelaksana]', '#rsertifikat_form').val(res.data.pelaksana);
                                $('select[name=status]', '#rsertifikat_form').val(res.data.status);
                                $('input[name=tahun]', '#rsertifikat_form').val(res.data.tahun);
                            }
                        });

                        $('#RSertifikatModal').modal();

                        return false;

                });                                                      
                                         
            });	            
          
	</script>		
