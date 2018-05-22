<?php
  /**
   * Main
   *
   * @package SIM PPPPTK BMTI
   * @author a2ngsa
   * @copyright 2012
   * @version $Id: ptk_rpf.php (admin), v1.00 2011-06-05 10:12:05 gewa Exp $
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
                    <input name="processPTK_RPF" type="hidden" value="1">
                    
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
                                <input type="text" class="span8" name="lokasi" id="rpf_lokasi" maxlength="50" value=""/>
                            </div>
                        </div>
                    </div>

                    <div class="form-row row-fluid">
                        <div class="span12">
                            <div class="row-fluid">								
                                <label class="form-label span4" for="normal">Fakultas:</label>
                                <input type="text" class="span8" name="fakultas" id="rpf_fakultas" maxlength="100" value=""/>
                            </div>
                        </div>
                    </div>                    

                    <div class="form-row row-fluid">
                        <div class="span12">
                            <div class="row-fluid">								
                                <label class="form-label span4" for="normal">Jurusan:</label>
                                <input type="text" class="span8" name="jurusan" id="rpf_jurusan" maxlength="100" value=""/>
                            </div>
                        </div>
                    </div>                    
                              
                    <div class="form-row row-fluid">
                        <div class="span12">
                            <div class="row-fluid">								
                                <label class="form-label span4" for="checkboxes">Status:</label>
                                <div class="span4 controls">
                                    <select name="status" id="rpf_status" class="nostyle">
                                        <?php echo $content->Status_LulusList(); ?>
                                    </select>							
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-row row-fluid">
                        <div class="span12">
                            <div class="row-fluid">								
                                <label class="form-label span4" for="checkboxes">Tingkat Pendidikan:</label>
                                <div class="span8 controls">
                                    <select name="tingkat_pendidikan" id="rpf_tingkat_pendidikan" class="nostyle">
                                        <?php echo $content->Sekolah_JenjangList(); ?>
                                    </select>					
                                </div>
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
                    <input name="ptkid" type="hidden" value="<?php echo Filter::$id;?>" />
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
                            url: "controller_ptk.php",
                            data: 'loadPTK_RPF=' + <?php echo Filter::$id;?>,
                            cache: false,
                            success: function (html) {
                                    $("#ptk_rpf").html(html);
                            }
                    });
                    $('#loader').fadeOut(200);
            }                        

            function submitRPF() {
                var str = $('#rpf_form').serialize();
                   
                $('#RPFModal').modal('hide');
                
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
                                $(loadRPFList()).fadeIn("slow");
                        }, 2000);                            
                    }
                });
                                                
            }

            $(document).ready(function(){
                                                 
                $('#btnRPFadd').live('click', function () {

                    $('input[name=dataid]', '#rpf_form').val(0);
                    $('input[name=nama_sekolah]', '#rpf_form').val('');
                    $('input[name=lokasi]', '#rpf_form').val('');
                    $('input[name=fakultas]', '#rpf_form').val('');
                    $('input[name=jurusan]', '#rpf_form').val('');
                    $('select[name=status]', '#rpf_form').val('');                    
                    $('select[name=tingkat_pendidikan]', '#rpf_form').val('');                    
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
                            url: 'controller_ptk.php',
                            data: 'getPTKdetail=' + tname + '&id=' + id,
                            dataType: 'json',
                            success: function (res) {
                                $('input[name=dataid]', '#rpf_form').val(res.data.id);
                                $('input[name=nama_sekolah]', '#rpf_form').val(res.data.nama_sekolah);
                                $('input[name=lokasi]', '#rpf_form').val(res.data.lokasi);
                                $('input[name=fakultas]', '#rpf_form').val(res.data.fakultas);
                                $('input[name=jurusan]', '#rpf_form').val(res.data.jurusan);
                                $('select[name=status]', '#rpf_form').val(res.data.status);
                                $('select[name=tingkat_pendidikan]', '#rpf_form').val(res.data.tingkat_pendidikan);
                                $('input[name=tahun_lulus]', '#rpf_form').val(res.data.tahun_lulus);
                            }
                        });

                        $('#RPFModal').modal();

                        return false;

                });
                                                                                      
            });
	  
	</script>		
