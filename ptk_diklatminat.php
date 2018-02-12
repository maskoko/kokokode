<?php
  /**
   * Main
   *
   * @package SIM PPPPTK BMTI
   * @author a2ngsa
   * @copyright 2012
   * @version $Id: ptk_diklatminat.php (admin), v1.00 2011-06-05 10:12:05 gewa Exp $
   */
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
	
?>
	<!-- Boostrap modal dialog -->
	<div id="MinatModal" class="modal hide fade" style="display: none;">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal"><span class="icon12 minia-icon-close"></span></button>
              <h3>Data Minat Diklat</h3>
            </div>

            <div class="modal-body">		

                <form id="minat_form" name="minat_form" class="form-horizontal" method="post" action="">						
                <fieldset>
                    <input name="processPTK_DiklatMinat" type="hidden" value="1">

                    <?php $diklat = $content->getDiklatList();?>
                    
                    <div class="form-row row-fluid">
                        <div class="span12">
                            <div class="row-fluid">								
                                <label class="form-label span4" for="checkboxes">Diklat:</label>
                                <div class="span8 controls">
                                    <select name="diklatid" id="diklatid" class="nostyle" style="width:100%;" placeholder="Select Diklat...">
                                        <option value=""><?php echo lang('SELECT');?></option>
                                        <?php if ($diklat):?>
                                            <?php foreach ($diklat as $prow):?>
                                                <option value="<?php echo $prow->id;?>"><?php echo $prow->nama_diklat;?></option>
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
                                    <label class="form-label span4" for="normal">Tahun:</label>
                                    <input type="text" class="span2" name="tahun" id="tahun" value="<?php echo date('Y');?>"/>
                            </div>
                        </div>
                    </div>

                    <div class="form-row row-fluid">
                        <div class="span12">
                            <div class="row-fluid">								
                                    <label class="form-label span4" for="normal">Deskripsi:</label>
                                    <input type="text" class="span8" name="deskripsi" id="deskripsi" value=""/>
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
              <a href="javascript: submitDiklatMinat()" class="btn btn-primary">Save</a>
            </div>
	</div>

	<script type="text/javascript">

            function loadMinatList() {
                    $('#loader').fadeIn(200); 
                    $.ajax({
                            type: 'post',
                            url: "ajax/controller.php",
                            data: 'loadPTK_DiklatMinat=' + <?php echo $user->ptkid;?>,
                            cache: false,
                            success: function (html) {
                                    $("#ptk_diklatminat").html(html);
                            }
                    });
                    $('#loader').fadeOut(200);
            }                        

            function submitDiklatMinat() {
                var str = $('#minat_form').serialize();
                   
                $('#MinatModal').modal('hide');
                
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
                                $(loadMinatList()).fadeIn("slow");
                        }, 2000);                            
                    }
                });
                                                
            }

            $(document).ready(function(){
                                                 
                $('#btnMinatadd').live('click', function () {

                    $('input[name=dataid]', '#minat_form').val(0);
                    $('select[name=diklatid]', '#minat_form').val('');
                    $('input[name=deskripsi]', '#minat_form').val('');
                    $('input[name=tahun]', '#minat_form').val('');

                    $('#MinatModal').modal();

                    return false;
                  });
                  
                $('.tip.doEditdiklatminat').live('click', function(e) {
                        e.preventDefault();

                        
                        var tname = $(this).data('tname');
                        var id = $(this).data('id');

                        $.ajax({
                            type: 'post',
                            url: 'ajax/controller.php',
                            data: 'getPTKdetail=' + tname + '&id=' + id,
                            dataType: 'json',
                            success: function (res) {
                                $('input[name=dataid]' , '#minat_form').val(res.data.id);
                                $('select[name=diklatid]' , '#minat_form').val(res.data.diklatid);
                                $('input[name=deskripsi]' , '#minat_form').val(res.data.deskripsi);
                                $('input[name=tahun]' , '#minat_form').val(res.data.tahun);
                            }
                        });

                        $('#MinatModal').modal();
                        
                        return false;

                });                  
                                                  
            });
	  
	</script>		
