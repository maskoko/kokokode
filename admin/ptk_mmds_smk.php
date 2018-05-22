<?php
  /**
   * Main
   *
   * @package SIM PPPPTK BMTI
   * @author a2ngsa
   * @copyright 2012
   * @version $Id: ptk_mmds.php (admin), v1.00 2011-06-05 10:12:05 gewa Exp $
   */
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
	
?>
	<!-- Boostrap modal dialog -->
	<div id="MMDSModal" class="modal hide fade" style="display: none;">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal"><span class="icon12 minia-icon-close"></span></button>
              <h3>Data Mengajar di Sekolah Induk</h3>
            </div>

            <div class="modal-body">		

                <form id="mmds_form" name="mmds_form" class="form-horizontal" method="post" action="">						
                <fieldset>
                    <input name="processPTK_MMDS" type="hidden" value="1">
                    <?php 
                    
                        // $row = Core::getRowById("diklat", Filter::$id);
                        // if ($row) {
                            // if ($row->kkid) {
                            //     $pskrow = Core::getRowById("psk", $row->kkid);
                            //     if ($pskrow) {
                            //         $kel_matapelajaran = $pskrow->kel_matapelajaran;
                            //         unset ($pskrow);
                            //     }
                            // } else
                                $kel_matapelajaran = 0;
                                $kkid = 0;
                        // } else
                        //     $kel_matapelajaran = 0;
                                                            
                        // $departemen = $content->getDepartemenList();
                        // $tingkat = $content->getDiklat_TingkatList();
                        // $diklatlist = $content->getDiklatList();
                                                            
                    ?>

                   <!--  <div class="form-row row-fluid">
                        <div class="span12">
                            <div class="row-fluid">								
                                <label class="form-label span4" for="checkboxes">Bidang Keahlian:</label>
                                <div class="span4 controls">
                                    <select name="kel_matapelajaran" id="kel_matapelajaran" class="nostyle">
                                        <?php echo $content->Kelompok_MataPelajaranList('PRODUKTIF'); ?>
                                    </select>							
                                </div>
                            </div>
                        </div>
                    </div>	 -->	
                    

                    <?php $bsk = $content->getBSKList();?>
                                    
                    <div class="form-row row-fluid">
                        <div class="span12">
                            <div class="row-fluid">
                                <label class="form-label span4" for="checkbox">Bidang Keahlian:</label>
                                <div class="span8 controls">
                                    <select name="kel_matapelajaran" id="kel_matapelajaran" class="required">
                                        <option value=""><?php echo lang('SELECT');?></option>
                                        <?php if ($bsk):?>
                                            <?php foreach ($bsk as $prow):?>
                                                <option value="<?php echo $prow->nama_bidang;?>"><?php echo $prow->nama_bidang;?></option>
                                            <?php endforeach;?>
                                            <?php unset($prow);?>
                                        <?php endif;?>
                                    </select>                   
                                </div>
                            </div>
                        </div>
                    </div>		

                    <?php 
                    
                        // if ($kel_matapelajaran != 0)
                            // $psk = $content->getPSKList($kel_matapelajaran);
                    
                    ?>
                                                        
                    <div class="form-row row-fluid">
                        <div class="span12">
                            <div class="row-fluid">
                                <label class="form-label span4" for="checkbox">Program Keahlian:</label>
                                <div class="span8 controls">
                                    <select name="kkid" id="kkid" class="required">
                                        <option value=""><?php echo lang('SELECT');?></option>
                                        <?php if ($psk):?>
                                            <?php foreach ($psk as $prow):?>
                                                <option value="<?php echo $prow->nama_program;?>"><?php echo $prow->nama_program;?></option>
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
                                <label class="form-label span4" for="checkbox">Kompetensi Keahlian:</label>
                                <div class="span8 controls">
                                    <select name="nama_matapelajaran" id="nama_matapelajaran" class="required">
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

                   <!--  <?php $kk = $content->getKKList();?>

                    <div class="form-row row-fluid">
                        <div class="span12">
                            <div class="row-fluid">								
                                <label class="form-label span4" for="checkboxes">Program Keahlian:</label>
                                <div class="span8 controls">
                                    <select name="kkid" id="kkid" class="nostyle">
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
                                <div id="mata_pelajaran_entry">
                                    <label class="form-label span4" for="normal">Mata Pelajaran:</label>
                                    <input type="text" class="span6" name="nama_matapelajaran" id="nama_matapelajaran" value=""/>
                                </div>                                
                            </div>
                        </div>
                    </div> -->

                    <div class="form-row row-fluid">
                        <div class="span12">
                            <div class="row-fluid">								
                                <label class="form-label span4" for="checkboxes">Kelas:</label>
                                <div class="span2 controls">
                                    <select name="kelas" class="nostyle">
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
                                <input type="text" class="span2" name="tahun_mulai" id="tahun_mulai" value=""/>
                                <input type="text" class="span2" name="tahun_akhir" id="tahun_akhir" value=""/>
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
              <a href="javascript: submitMMDS()" class="btn btn-primary">Save</a>
            </div>
	</div>

	<script type="text/javascript">

            function loadMMDSList() {
                    $('#loader').fadeIn(200);
                    $.ajax({
                            type: 'post',
                            url: "controller_ptk.php",
                            data: 'loadPTK_MMDS=' + <?php echo Filter::$id;?>,
                            cache: false,
                            success: function (html) {
                                    $("#ptk_mmds").html(html);
                            }
                    });
                    $('#loader').fadeOut(200);
            }                        

            function submitMMDS() {
                var str = $('#mmds_form').serialize();
                   
                $('#MMDSModal').modal('hide');
                
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
                                $(loadMMDSList()).fadeIn("slow");
                        }, 2000);                            
                    }
                });
                                                
            }
          

            $(document).ready(function(){

                $("#kel_matapelajaran").change(function(){
                    var id = $("#kel_matapelajaran").val();
                                        
                    $.ajax({
                        type: 'post',
                        url: "controller.php",
                        data: "loadPSKList=" + id,
                        cache: false,
                        success: function(html){
                            $("#kkid").html(html); 
                        }
                    });

                    $("#kkid").val("");
                    $("#nama_matapelajaran").val("");
                    
                    $.uniform.update("#kkid");
                    $.uniform.update("#nama_matapelajaran");
                                        
                });


                $("#kkid").change(function(){
                    var id = $("#kkid").val();
                                        
                    $.ajax({
                        type: 'post',
                        url: "controller.php",
                        data: "loadKKList=" + id,
                        cache: false,
                        success: function(html){
                            $("#nama_matapelajaran").html(html); 
                        }
                    });

                    $("#nama_matapelajaran").val("");
                    $.uniform.update("#nama_matapelajaran");
                                        
                });
                
                                                 
                $('#btnMMDSadd').live('click', function () {

                    $('input[name=dataid]', '#mmds_form').val(0);
                    $('select[name=kel_matapelajaran]', '#mmds_form').val('');
                    $('select[name=kkid]', '#mmds_form').val('');
                    $('input[name=nama_matapelajaran]', '#mmds_form').val('');
                    $('select[name=kelas]', '#mmds_form').val('');                    
                    $('input[name=tahun_mulai]', '#mmds_form').val('');
                    $('input[name=tahun_akhir]', '#mmds_form').val('');

                    $('#MMDSModal').modal();

                    return false;
                  });

                $('.tip.doEditmmds').live('click', function(e) {
                        e.preventDefault();
                        
                        var tname = $(this).data('tname');
                        var id = $(this).data('id');

                        $.ajax({
                            type: 'post',
                            url: 'controller_ptk.php',
                            data: 'getPTKdetail=' + tname + '&id=' + id,
                            dataType: 'json',
                            success: function (res) {
                                $('input[name=dataid]', '#mmds_form').val(res.data.id);
                                $('select[name=kel_matapelajaran]', '#mmds_form').val(res.data.kel_matapelajaran);
                                $('select[name=kkid]', '#mmds_form').val(res.data.kkid);
                                $('input[name=nama_matapelajaran]' , '#mmds_form').val(res.data.nama_matapelajaran);
                                $('select[name=kelas]' , '#mmds_form').val(res.data.kelas);
                                $('input[name=tahun_mulai]', '#mmds_form').val(res.data.tahun_mulai);
                                $('input[name=tahun_akhir]', '#mmds_form').val(res.data.tahun_akhir);
                            }
                        });

                        $('#MMDSModal').modal();
                        
                        return false;

                });

                $('#kel_matapelajaran').change(function () {
                    var value = $("#kel_matapelajaran option:selected").val();
                    
                    // (value == "PRODUKTIF" ) ? $('#kkid').removeAttr("disabled") : $('#kkid').attr('disabled','disabled');
                    $.uniform.update("#nama_matapelajaran"); 
                                                              
                    $.ajax({
                            cache: false,
                            type: 'GET',
                            url: 'controller.php',
                            data: 'loadMataPelajaran=' + value,
                            success: function(data) {
                                $("#mata_pelajaran_entry").html(data); 
                                $.uniform.update("#nama_matapelajaran");
                            }
                    });
                                                                                                                                            
                })
                                                  
            });
	  
	</script>		
