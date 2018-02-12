<?php
  /**
   * Main
   *
   * @package SIM PPPPTK BMTI
   * @author a2ngsa
   * @copyright 2012
   * @version $Id: sekolah_smk.php (admin), v1.00 2011-06-05 10:12:05 gewa Exp $
   */
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
	
?>
	<!-- Boostrap modal dialog -->
	<div id="SMKModal" class="modal hide fade" style="display: none;">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal"><span class="icon12 minia-icon-close"></span></button>
              <h3>Khusus Tingkat Sekolah SMK</h3>
            </div>

            <div class="modal-body">		

                <form id="smk_form" name="smk_form" class="form-horizontal" method="post" action="">						
                <fieldset>
                    <input name="processSekolah_SMK" type="hidden" value="1">

                    
                    <?php 
                        $bsk = $content->getBSKList();
                        $psk = null;
                        $kk = null;                    
                    ?>
                    
                    <div class="form-row row-fluid">
                        <div class="span12">
                            <div class="row-fluid">								
                                <label class="form-label span4" for="checkboxes">Bidang Keahlian:</label>
                                <div class="span8 controls">
                                    <select name="bskid" id="bskid">
                                        <option value=""><?php echo lang('SELECT');?></option>
                                        <?php if ($bsk):?>
                                            <?php foreach ($bsk as $prow):?>
                                                <option value="<?php echo $prow->id;?>"><?php echo $prow->nama_bidang;?></option>
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
                                <label class="form-label span4" for="checkboxes">Program Keahlian:</label>
                                <div class="span8 controls">
                                    <select name="pskid" id="pskid">
                                        <option value=""><?php echo lang('SELECT');?></option>
                                        <?php if ($psk):?>
                                            <?php foreach ($psk as $prow):?>
                                                <option value="<?php echo $prow->id;?>"><?php echo $prow->nama_program;?></option>
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
                                <label class="form-label span4" for="checkboxes">Paket Keahlian:</label>
                                <div class="span8 controls">
                                    <select name="kkid" id="kkid">
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
                                                            
                    <input name="sekolahid" type="hidden" value="<?php echo $row->id;?>" />
                    <input name="userid" type="hidden" value="<?php echo $user->uid;?>" />

                </fieldset>
                </form>       

            </div>

            <div class="modal-footer">
              <a href="#" class="btn" data-dismiss="modal">Close</a>
              <a href="javascript: submitSMK()" class="btn btn-primary">Save</a>
            </div>
	</div>

	<script type="text/javascript">

            function loadSMKList() {
                    $('#loader').fadeIn(200);
                    $.ajax({
                            type: 'post',
                            url: "controller_sekolah.php",
                            data: 'loadSekolah_SMK=' + <?php echo Filter::$id;?>,
                            cache: false,
                            success: function (html) {
                                    $("#sekolah_smk").html(html);
                            }
                    });
                    $('#loader').fadeOut(200);
            }                        

            function submitSMK() {
                var str = $('#smk_form').serialize();
                   
                $('#SMKModal').modal('hide');
                
                $.ajax({
                    type: 'post',
                    url: "controller_sekolah.php",
                    data: str,
                    success: function (res) {
                        $("#msgholder").html(res);
                        $("html, body").animate({
                                scrollTop: 0
                        }, 600);
                        setTimeout(function () {
                                $(loadSMKList()).fadeIn("slow");
                        }, 2000);                            
                    }
                });
                                                
            }

            $(document).ready(function(){
                                                 
                $('#btnSMKadd').live('click', function () {

                    $('#SMKModal').modal();

                    return false;
                  });
                     
                $("#bskid").change(function(){
                        var id = $("#bskid").val();

                        $.ajax({
                                type: 'post',
                                url: "controller.php",
                                data: "loadPSKList=" + id,
                                cache: false,
                                success: function(html){
                                        $("#pskid").html(html); 
                                }
                        });

                        $("#pskid").val("");
                        $("#kkid").val("");

                        $.uniform.update("#pskid");
                        $.uniform.update("#kkid");

                });


                $("#pskid").change(function(){
                        var id = $("#pskid").val();

                        $.ajax({
                                type: 'post',
                                url: "controller.php",
                                data: "loadKKList=" + id,
                                cache: false,
                                success: function(html){
                                        $("#kkid").html(html); 
                                }
                        });

                        $("#kkid").val("");
                        $.uniform.update("#kkid");

                });
                                          
                     
            });
	  
	</script>		
