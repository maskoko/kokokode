<?php
  /**
   * Main
   *
   * @package SIM PPPPTK BMTI
   * @author a2ngsa
   * @copyright 2012
   * @version $Id: staff_rjabatan.php (admin), v1.00 2011-06-05 10:12:05 gewa Exp $
   */
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
	
?>
	<!-- Boostrap modal dialog -->
	<div id="RJabatanModal" class="modal hide fade" style="display: none;">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal"><span class="icon12 minia-icon-close"></span></button>
              <h3>Data Riwayat Jabatan</h3>
            </div>

            <div class="modal-body">		

                <form id="rjabatan_form" name="rjabatan_form" class="form-horizontal" method="post" action="">						
                <fieldset>
                    <input name="processRJabatan" type="hidden" value="1">
                    
                    <div class="form-row row-fluid">
                        <div class="span12">
                            <div class="row-fluid">								
                                <label class="form-label span4" for="checkboxes">Jenis:</label>
                                <div class="span4 controls">
                                    <select name="jenis" id="rjabatan_jenis" class="nostyle">
                                        <option value=""><?php echo lang('SELECT');?></option>
                                        <option value="I">Intern</option>
                                        <option value="P">Pusat</option>
                                    </select>							
                                </div>
                            </div>
                        </div>
                    </div>
                                        
                    <div class="form-row row-fluid">
                        <div class="span12">
                            <div class="row-fluid">								
                                <label class="form-label span4" for="normal">Jabatan:</label>
                                <input type="text" class="span6" name="jabatan" id="rjabatan_jabatan" maxlength="100" value=""/>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-row row-fluid">
                        <div class="span12">
                            <div class="row-fluid">
                                <label class="form-label span4" for="normal">Lembaga:</label>
                                <input type="text" class="span6" name="lembaga" id="rjabatan_lembaga" maxlength="100" value=""/>
                            </div>
                        </div>
                    </div>

                    <div class="form-row row-fluid">
                        <div class="span12">
                            <div class="row-fluid">								
                                <label class="form-label span4" for="normal">No. SK :</label>
                                <input type="text" class="span6" name="no_sk" id="rjabatan_no_sk" maxlength="50" value=""/>
                            </div>
                        </div>
                    </div>

                    <div class="form-row row-fluid">
                        <div class="span12">
                            <div class="row-fluid">								
                                <label class="form-label span4" for="normal">Tahun :</label>
                                <input type="text" class="span2" name="tahun" id="rjabatan_tahun" maxlength="4" value=""/>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-row row-fluid">
                        <div class="span12">
                            <div class="row-fluid">								
                                <label class="form-label span4" for="normal">Tempat Tugas :</label>
                                <input type="text" class="span6" name="tmp_tugas" id="rjabatan_tmp_tugas" maxlength="100" value=""/>
                            </div>
                        </div>
                    </div>

                    <div class="form-row row-fluid">
                        <div class="span12">
                            <div class="row-fluid">								
                                <label class="form-label span4" for="normal">TMT :</label>
                                <input type="text" class="span3 datepickerField" name="tmt" id="rjabatan_tmt" value=""/>
                            </div>
                        </div>
                    </div>

                    <div class="form-row row-fluid">
                        <div class="span12">
                            <div class="row-fluid">								
                                <label class="form-label span4" for="normal">TMT Akhir :</label>
                                <input type="text" class="span3 datepickerField" name="akhir_tmt" id="rjabatan_akhir_tmt" value=""/>
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
              <a href="javascript: submitRJabatan()" class="btn btn-primary">Save</a>
            </div>
	</div>

	<script type="text/javascript">

            function loadRJabatanList() {
                    $('#loader').fadeIn(200);
                    $.ajax({
                            type: 'post',
                            url: "controller_staff.php",
                            data: 'loadRJabatan=' + <?php echo Filter::$id;?>,
                            cache: false,
                            success: function (html) {
                                    $("#staff_rjabatan").html(html);
                            }
                    });
                    $('#loader').fadeOut(200);
            }                        

            function submitRJabatan() {
                var str = $('#rjabatan_form').serialize();
                   
                $('#RJabatanModal').modal('hide');
                
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
                                $(loadRJabatanList()).fadeIn("slow");
                        }, 2000);                            
                    }
                });
                                                
            }

            $(document).ready(function() {
                                                 
                $('#btnRJabatanadd').live('click', function () {

                    $('input[name=dataid]', '#rjabatan_form').val(0);
                    $('select[name=jenis]', '#rjabatan_form').val('');
                    $('input[name=jabatan]', '#rjabatan_form').val('');
                    $('input[name=lembaga]', '#rjabatan_form').val('');
                    $('input[name=no_sk]', '#rjabatan_form').val('');
                    $('input[name=tahun]', '#rjabatan_form').val('');
                    $('input[name=tmp_tugas]', '#rjabatan_form').val('');                    
                    $('input[name=tmt]', '#rjabatan_form').val('');
                    $('input[name=akhir_tmt]', '#rjabatan_form').val('');

                    $('#RJabatanModal').modal();

                    return false;
                  });
                  
                $('.tip.doEditrjabatan').live('click', function(e) {
                        e.preventDefault();

                        var tname = $(this).data('tname');
                        var id = $(this).data('id');

                        $.ajax({
                            type: 'post',
                            url: 'controller_staff.php',
                            data: 'getDatadetail=' + tname + '&id=' + id,
                            dataType: 'json',
                            success: function (res) { 
                                $('input[name=dataid]', '#rjabatan_form').val(res.data.id);
                                $('select[name=jenis]', '#rjabatan_form').val(res.data.jenis);
                                $('input[name=jabatan]', '#rjabatan_form').val(res.data.jabatan);
                                $('input[name=lembaga]', '#rjabatan_form').val(res.data.lembaga);
                                $('input[name=no_sk]', '#rjabatan_form').val(res.data.no_sk);
                                $('input[name=tahun]', '#rjabatan_form').val(res.data.tahun);
                                $('input[name=tmp_tugas]', '#rjabatan_form').val(res.data.tmp_tugas);
                                $('input[name=tmt]', '#rjabatan_form').val(res.data.tmt);
                                $('input[name=akhir_tmt]', '#rjabatan_form').val(res.data.akhir_tmt);
                            }
                        });

                        $('#RJabatanModal').modal();

                        return false;

                });                                    
                                         
            });
	  
	</script>		
