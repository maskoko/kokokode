<?php
  /**
   * Main
   *
   * @package SIM PPPPTK BMTI
   * @author a2ngsa
   * @copyright 2012
   * @version $Id: staff_rkarya.php (admin), v1.00 2011-06-05 10:12:05 gewa Exp $
   */
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
	
?>
	<!-- Boostrap modal dialog -->
	<div id="RKaryaModal" class="modal hide fade" style="display: none;">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal"><span class="icon12 minia-icon-close"></span></button>
              <h3>Data Riwayat Karya</h3>
            </div>

            <div class="modal-body">		

                <form id="rkarya_form" name="rkarya_form" class="form-horizontal" method="post" action="">						
                <fieldset>
                    <input name="processRKarya" type="hidden" value="1">
                    
                    <div class="form-row row-fluid">
                        <div class="span12">
                            <div class="row-fluid">								
                                <label class="form-label span4" for="normal">NSS:</label>
                                <input type="text" class="span4" name="nss" id="rkarya_nss" maxlength="30" value=""/>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-row row-fluid">
                        <div class="span12">
                            <div class="row-fluid">
                                <label class="form-label span4" for="normal">NIP:</label>
                                <input type="text" class="span4" name="nip" id="rkarya_nip" maxlength="20" value=""/>
                            </div>
                        </div>
                    </div>

                    <div class="form-row row-fluid">
                        <div class="span12">
                            <div class="row-fluid">								
                                <label class="form-label span4" for="normal">Nama Karya :</label>
                                <input type="text" class="span6" name="nama_karya" id="rkarya_nama_karya" maxlength="100" value=""/>
                            </div>
                        </div>
                    </div>

                    <div class="form-row row-fluid">
                        <div class="span12">
                            <div class="row-fluid">								
                                <label class="form-label span4" for="normal">Tahun:</label>
                                <input type="text" class="span2" name="tahun" id="rkarya_tahun" maxlength="4" value=""/>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-row row-fluid">
                        <div class="span12">
                            <div class="row-fluid">								
                                <label class="form-label span4" for="normal">Keterangan:</label>
                                <input type="text" class="span6" name="keterangan" id="rkarya_keterangan" maxlength="100" value=""/>
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
              <a href="javascript: submitRKarya()" class="btn btn-primary">Save</a>
            </div>
	</div>

	<script type="text/javascript">

            function loadRKaryaList() {
                    $('#loader').fadeIn(200);
                    $.ajax({
                            type: 'post',
                            url: "controller_staff.php",
                            data: 'loadRKarya=' + <?php echo Filter::$id;?>,
                            cache: false,
                            success: function (html) {
                                    $("#staff_rkarya").html(html);
                            }
                    });
                    $('#loader').fadeOut(200);
            }                        

            function submitRKarya() {
                var str = $('#rkarya_form').serialize();
                   
                $('#RKaryaModal').modal('hide');
                
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
                                $(loadRKaryaList()).fadeIn("slow");
                        }, 2000);                            
                    }
                });
                                                
            }

            $(document).ready(function() {
                                                 
                $('#btnRKaryaadd').live('click', function () {

                    $('input[name=dataid]', '#rkarya_form').val(0);
                    $('input[name=nss]', '#rkarya_form').val('');
                    $('input[name=nip]', '#rkarya_form').val('');
                    $('input[name=nama_karya]', '#rkarya_form').val('');
                    $('input[name=tahun]', '#rkarya_form').val('');
                    $('input[name=keterangan]', '#rkarya_form').val('');                    

                    $('#RKaryaModal').modal();

                    return false;
                  });
                  
                $('.tip.doEditrkarya').live('click', function(e) {
                        e.preventDefault();

                        var tname = $(this).data('tname');
                        var id = $(this).data('id');

                        $.ajax({
                            type: 'post',
                            url: 'controller_staff.php',
                            data: 'getDatadetail=' + tname + '&id=' + id,
                            dataType: 'json',
                            success: function (res) {
                                $('input[name=dataid]', '#rkarya_form').val(res.data.id);
                                $('input[name=nss]', '#rkarya_form').val(res.data.nss);
                                $('input[name=nip]', '#rkarya_form').val(res.data.nip);
                                $('input[name=nama_karya]', '#rkarya_form').val(res.data.nama_karya);
                                $('input[name=tahun]', '#rkarya_form').val(res.data.tahun);
                                $('input[name=keterangan]', '#rkarya_form').val(res.data.keterangan);
                            }
                        });

                        $('#RKaryaModal').modal();

                        return false;

                });                                    
                                         
            });
	  
	</script>		
