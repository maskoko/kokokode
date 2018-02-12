<?php
  /**
   * Main
   *
   * @package SIM PPPPTK BMTI
   * @author a2ngsa
   * @copyright 2012
   * @version $Id: ptk_mmdl.php (admin), v1.00 2011-06-05 10:12:05 gewa Exp $
   */
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
	
?>
	<!-- Boostrap modal dialog -->
	<div id="MMDLModal" class="modal hide fade" style="display: none;">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal"><span class="icon12 minia-icon-close"></span></button>
              <h3>Data Mengajar di Sekolah Lain</h3>
            </div>

            <div class="modal-body">		

                <form id="mmdl_form" name="mmdl_form" class="form-horizontal" method="post" action="">						
                <fieldset>
                    <input name="processPTK_MMDL" type="hidden" value="1">

                    <div class="form-row row-fluid">
                        <div class="span12">
                            <div class="row-fluid">								
                                <label class="form-label span4" for="checkboxes">Kelompok:</label>
                                <div class="span4 controls">
                                    <select name="kel_matapelajaran" id="mmdl_kel_matapelajaran" class="nostyle">
                                        <?php echo $content->Kelompok_MataPelajaranList(); ?>
                                    </select>							
                                </div>
                            </div>
                        </div>
                    </div>								

                    <?php $kk = $content->getKKList();?>

                    <div class="form-row row-fluid">
                        <div class="span12">
                            <div class="row-fluid">								
                                <label class="form-label span4" for="checkboxes">Paket Keahlian:</label>
                                <div class="span8 controls">
                                    <select name="kkid" id="mmdl_kkid" class="nostyle">
                                        <option value=""><?php echo lang('SELECT');?></option>
                                        <?php if ($kk):?>
                                            <?php foreach ($kk as $prow):?>
                                                    <option value="<?php echo $prow->id;?>"><?php echo $prow->nama_kompetensi;?></option>
                                            <?php endforeach;?>
                                            <?php unset($prow);?>
                                        <?php endif;?>
                                    </select>					
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-row row-fluid">
                        <div class="span12">
                            <div class="row-fluid">								
                                <label class="form-label span4" for="normal">Lembaga:</label>
                                <input type="text" class="span6" name="nama_lembaga" id="mmdl_nama_lembaga" value=""/>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-row row-fluid">
                        <div class="span12">
                            <div class="row-fluid">
                                <div id="mmdl_mata_pelajaran_entry">
                                    <label class="form-label span4" for="normal">Mata Pelajaran:</label>
                                    <input type="text" class="span6" name="nama_matapelajaran" id="mmdl_nama_matapelajaran" value=""/>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-row row-fluid">
                        <div class="span12">
                            <div class="row-fluid">								
                                <label class="form-label span4" for="checkboxes">Kelas:</label>
                                <div class="span2 controls">
                                    <select name="kelas" id="mmdl_kelas" class="nostyle">
                                        <?php echo $content->getMMDKelasOption(); ?>
                                    </select>							
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-row row-fluid">
                        <div class="span12">
                            <div class="row-fluid">								
                                <label class="form-label span4" for="normal">Tahun (Mulai-Sampai):</label>
                                <input type="text" class="span2" name="tahun_mulai" id="mmdl_tahun_mulai" value=""/>
                                <input type="text" class="span2" name="tahun_akhir" id="mmdl_tahun_akhir" value=""/>
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
              <a href="javascript: submitMMDL()" class="btn btn-primary">Save</a>
            </div>
	</div>

	<script type="text/javascript">

            function loadMMDLList() {
                    $('#loader').fadeIn(200);
                    $.ajax({
                            type: 'post',
                            url: "controller_ptk.php",
                            data: 'loadPTK_MMDL=' + <?php echo Filter::$id;?>,
                            cache: false,
                            success: function (html) {
                                    $("#ptk_mmdl").html(html);
                            }
                    });
                    $('#loader').fadeOut(200);
            }                        

            function submitMMDL() {
                var str = $('#mmdl_form').serialize();
                   
                $('#MMDLModal').modal('hide');
                
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
                                $(loadMMDLList()).fadeIn("slow");
                        }, 2000);                            
                    }
                });
                                                
            }

            $(document).ready(function(){
                                                 
                $('#btnMMDLadd').live('click', function () {

                    $('input[name=dataid]' , '#mmdl_form').val(0);
                    $('select[name=kel_matapelajaran]' , '#mmdl_form').val('');
                    $('select[name=kkid]' , '#mmdl_form').val('');
                    $('input[name=nama_lembaga]' , '#mmdl_form').val('');
                    $('input[name=nama_matapelajaran]' , '#mmdl_form').val('');
                    $('select[name=kelas]' , '#mmdl_form').val('');                    
                    $('input[name=tahun_mulai]' , '#mmdl_form').val('');
                    $('input[name=tahun_akhir]' , '#mmdl_form').val('');

                    $('#MMDLModal').modal();

                    return false;
                  });
                  
                $('.tip.doEditmmdl').live('click', function(e) {
                        e.preventDefault();

                        
                        var tname = $(this).data('tname');
                        var id = $(this).data('id');

                        $.ajax({
                            type: 'post',
                            url: 'controller_ptk.php',
                            data: 'getPTKdetail=' + tname + '&id=' + id,
                            dataType: 'json',
                            success: function (res) {
                                $('input[name=dataid]' , '#mmdl_form').val(res.data.id);
                                $('select[name=kel_matapelajaran]' , '#mmdl_form').val(res.data.kel_matapelajaran);
                                $('select[name=kkid]' , '#mmdl_form').val(res.data.kkid);
                                $('input[name=nama_lembaga]' , '#mmdl_form').val(res.data.nama_lembaga);
                                $('input[name=nama_matapelajaran]' , '#mmdl_form').val(res.data.nama_matapelajaran);
                                $('select[name=kelas]' , '#mmdl_form').val(res.data.kelas);                    
                                $('input[name=tahun_mulai]' , '#mmdl_form').val(res.data.tahun_mulai);
                                $('input[name=tahun_akhir]' , '#mmdl_form').val(res.data.tahun_akhir);
                            }
                        });

                        $('#MMDLModal').modal();
                        
                        return false;

                });
                                       
                $('#mmdl_kel_matapelajaran').change(function () {
                    var value = $("#mmdl_kel_matapelajaran option:selected").val();
                    
                    (value == "PRODUKTIF" ) ? $('#mmdl_kkid').removeAttr("disabled") : $('#mmdl_kkid').attr('disabled','disabled');
                    $.uniform.update("#mmdl_kkid"); 
                                                              
                    $.ajax({
                            cache: false,
                            type: 'GET',
                            url: 'controller.php',
                            data: 'loadMataPelajaran=' + value,
                            success: function(data) {
                                $("#mmdl_mata_pelajaran_entry").html(data); 
                                $.uniform.update("#mmdl_nama_matapelajaran");
                            }
                    });
                }); 
                    
            });
	  
	</script>		
