<?php
  /**
   * Main
   *
   * @package SIM PPPPTK BMTI
   * @author a2ngsa
   * @copyright 2012
   * @version $Id: staff_rpf.php (admin), v1.00 2011-06-05 10:12:05 gewa Exp $
   */
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
	
?>
	<!-- Boostrap modal dialog -->
	<div id="RPFModal" class="modal hide fade" style="display: none;">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal"><span class="icon12 minia-icon-close"></span></button>
              <h3>Data Riwayat Pendidikan Formal</h3>
            </div>

            <div class="modal-body">		

                <form id="rpf_form" name="rpf_form" class="form-horizontal" method="post" action="">						
                <fieldset>
                    <input name="processRPF" type="hidden" value="1">
                    
                    <div class="form-row row-fluid">
                        <div class="span12">
                            <div class="row-fluid">								
                                <label class="form-label span4" for="checkboxes">Jenjang:</label>
                                <div class="span4 controls">
                                    <select name="jenjangid" id="rpf_jenjangid" class="nostyle">
                                        <?php echo $content->Sekolah_JenjangByIDList(); ?>
                                    </select>							
                                </div>
                            </div>
                        </div>
                    </div>
                                                                                
                    <div class="form-row row-fluid">
                        <div class="span12">
                            <div class="row-fluid">								
                                <label class="form-label span4" for="normal">Nama Sekolah:</label>
                                <input type="text" class="span8" name="nama_sekolah" id="rpf_nama_sekolah" maxlength="100" value=""/>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-row row-fluid">
                        <div class="span12">
                            <div class="row-fluid">								
                                <label class="form-label span4" for="normal">Lokasi:</label>
                                <input type="text" class="span8" name="lokasi" id="rpf_lokasi" maxlength="100" value=""/>
                            </div>
                        </div>
                    </div>

                    <div class="form-row row-fluid">
                        <div class="span12">
                            <div class="row-fluid">								
                                <label class="form-label span4" for="normal">Jurusan:</label>
                                <input type="text" class="span8" name="jurusan" id="rpf_jurusan" maxlength="50" value=""/>
                            </div>
                        </div>
                    </div>                    
                                                                                                             
                    <div class="form-row row-fluid">
                        <div class="span12">
                            <div class="row-fluid">								
                                <label class="form-label span4" for="normal">Tahun Lulus:</label>
                                <input type="text" class="span2" name="tahun_lulus" id="rpf_tahun_lulus" value="<?php echo date('Y');?>"/>
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
              <a href="javascript: submitRPF()" class="btn btn-primary">Save</a>
            </div>
	</div>

	<script type="text/javascript">

            function loadRPFList() {
                    $('#loader').fadeIn(200); 
                    $.ajax({
                            type: 'post',
                            url: "controller_staff.php",
                            data: 'loadRPF=' + <?php echo Filter::$id;?>,
                            cache: false,
                            success: function (html) {
                                    $("#staff_rpf").html(html);
                            }
                    });
                    $('#loader').fadeOut(200);
            }                        

            function submitRPF() {
                var str = $('#rpf_form').serialize();
                   
                $('#RPFModal').modal('hide');
                
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
                                $(loadRPFList()).fadeIn("slow");
                        }, 2000);                            
                    }
                });
                                                
            }

            $(document).ready(function(){
                                                 
                $('#btnRPFadd').live('click', function () {

                    $('input[name=dataid]', '#rpf_form').val(0);
                    $('select[name=jenjangid]', '#rpf_form').val('');
                    $('input[name=nama_sekolah]', '#rpf_form').val('');
                    $('input[name=lokasi]', '#rpf_form').val('');
                    $('input[name=jurusan]', '#rpf_form').val('');
                    $('input[name=tahun_lulus]', '#rpf_form').val('');

                    $('#RPFModal').modal();

                    return false;
                  });
                  
                $('.tip.doEditrpf').live('click', function(e) {
                        e.preventDefault();

                        var tname = $(this).data('tname');
                        var id = $(this).data('id');

                        $.ajax({
                            type: 'post',
                            url: 'controller_staff.php',
                            data: 'getDatadetail=' + tname + '&id=' + id,
                            dataType: 'json',
                            success: function (res) { 
                                $('input[name=dataid]', '#rpf_form').val(res.data.id);
                                $('select[name=jenjangid]', '#rpf_form').val(res.data.jenjangid);
                                $('input[name=nama_sekolah]', '#rpf_form').val(res.data.nama_sekolah);
                                $('input[name=lokasi]', '#rpf_form').val(res.data.lokasi);
                                $('input[name=jurusan]', '#rpf_form').val(res.data.jurusan);
                                $('input[name=tahun_lulus]', '#rpf_form').val(res.data.tahun_lulus);
                            }
                        });

                        $('#RPFModal').modal();

                        return false;

                });
                                                                                      
            });
	  
	</script>		
