<?php
  /**
   * Main
   *
   * @package SIM PPPPTK BMTI
   * @author a2ngsa
   * @copyright 2012
   * @version $Id: ptk_rpnf.php (admin), v1.00 2011-06-05 10:12:05 gewa Exp $
   */
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
	
?>
	<!-- Boostrap modal dialog -->
	<div id="RPNFModal" class="modal hide fade" style="display: none;">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal"><span class="icon12 minia-icon-close"></span></button>
              <h3>Data Riwayat Pendidikan Non-Formal</h3>
            </div>

            <div class="modal-body">		

                <form id="rpnf_form" name="rpnf_form" class="form-horizontal" method="post" action="">						
                <fieldset>
                    <input name="processPTK_RPNF" type="hidden" value="1">
                    
                    <div class="form-row row-fluid">
                        <div class="span12">
                            <div class="row-fluid">								
                                <label class="form-label span4" for="normal">Nama Instansi:</label>
                                <input type="text" class="span8" name="nama_instansi" id="rpnf_nama_instansi" maxlength="100" value=""/>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-row row-fluid">
                        <div class="span12">
                            <div class="row-fluid">								
                                <label class="form-label span4" for="normal">Lokasi:</label>
                                <input type="text" class="span8" name="lokasi" id="rpnf_lokasi" maxlength="50" value=""/>
                            </div>
                        </div>
                    </div>

                    <div class="form-row row-fluid">
                        <div class="span12">
                            <div class="row-fluid">								
                                <label class="form-label span4" for="normal">Bidang Studi:</label>
                                <input type="text" class="span8" name="bidang_studi" id="rpnf_bidang_studi" maxlength="100" value=""/>
                            </div>
                        </div>
                    </div>                    

                    <div class="form-row row-fluid">
                        <div class="span12">
                            <div class="row-fluid">								
                                <label class="form-label span4" for="normal">Tingkat:</label>
                                <input type="text" class="span2" name="tingkat" id="rpnf_tingkat" maxlength="15" value=""/>
                            </div>
                        </div>
                    </div>                    
                                                  
                    <div class="form-row row-fluid">
                        <div class="span12">
                            <div class="row-fluid">								
                                <label class="form-label span4" for="normal">Pola/Jam :</label>
                                <input type="text" class="span2" name="jml_jam" id="rpnf_jml_jam" maxlength="5" value="1"/>
                            </div>
                        </div>
                    </div>
                                        
                    <div class="form-row row-fluid">
                        <div class="span12">
                            <div class="row-fluid">								
                                <label class="form-label span4" for="normal">Tahun Lulus:</label>
                                <input type="text" class="span2" name="tahun_lulus" id="rpnf_tahun_lulus" value="<?php echo date('Y');?>"/>
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
              <a href="javascript: submitRPNF()" class="btn btn-primary">Save</a>
            </div>
	</div>

	<script type="text/javascript">

            function loadRPNFList() {
                    $('#loader').fadeIn(200); 
                    $.ajax({
                            type: 'post',
                            url: "ajax/controller.php",
                            data: 'loadPTK_RPNF=' + <?php echo $user->ptkid;?>,
                            cache: false,
                            success: function (html) {
                                    $("#ptk_rpnf").html(html);
                            }
                    });
                    $('#loader').fadeOut(200);
            }                        

            function submitRPNF() {
                var str = $('#rpnf_form').serialize();
                   
                $('#RPNFModal').modal('hide');
                
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
                                $(loadRPNFList()).fadeIn("slow");
                        }, 2000);                            
                    }
                });
                                                
            }

            $(document).ready(function(){
                                                 
                $('#btnRPNFadd').live('click', function () {

                    $('input[name=dataid]', '#rpnf_form').val(0);
                    $('input[name=nama_instansi]', '#rpnf_form').val('');
                    $('input[name=lokasi]', '#rpnf_form').val('');
                    $('input[name=bidang_studi]', '#rpnf_form').val('');
                    $('input[name=tingkat]', '#rpnf_form').val('');
                    $('input[name=jml_jam]', '#rpnf_form').val('');                    
                    $('input[name=tahun_lulus]', '#rpnf_form').val('');

                    $('#RPNFModal').modal();

                    return false;
                  });
                  
                $('.tip.doEditrpnf').live('click', function(e) {
                        e.preventDefault();

                        var tname = $(this).data('tname');
                        var id = $(this).data('id');

                        $.ajax({
                            type: 'post',
                            url: 'ajax/controller.php',
                            data: 'getPTKdetail=' + tname + '&id=' + id,
                            dataType: 'json',
                            success: function (res) {
                                $('input[name=dataid]', '#rpnf_form').val(res.data.id);
                                $('input[name=nama_instansi]', '#rpnf_form').val(res.data.nama_instansi);
                                $('input[name=lokasi]', '#rpnf_form').val(res.data.lokasi);
                                $('input[name=bidang_studi]', '#rpnf_form').val(res.data.bidang_studi);
                                $('input[name=tingkat]', '#rpnf_form').val(res.data.tingkat);
                                $('input[name=jml_jam]', '#rpnf_form').val(res.data.jml_jam);
                                $('input[name=tahun_lulus]', '#rpnf_form').val(res.data.tahun_lulus);
                            }
                        });

                        $('#RPNFModal').modal();

                        return false;

                });
                                                                    
            });
	  
	</script>		
