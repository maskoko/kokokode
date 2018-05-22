<?php
  /**
   * Main
   *
   * @package SIM PPPPTK BMTI
   * @author a2ngsa
   * @copyright 2012
   * @version $Id: sekolah_ruang.php (admin), v1.00 2011-06-05 10:12:05 gewa Exp $
   */
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
	
?>
	<!-- Boostrap modal dialog -->
	<div id="RuangModal" class="modal hide fade" style="display: none;">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal"><span class="icon12 minia-icon-close"></span></button>
              <h3>Data Kualifikasi, Status, Jns Kelamin dan Jumlah Pendidik</h3>
            </div>

            <div class="modal-body">		

                <form id="ruang_form" name="ruang_form" class="form-horizontal" method="post" action="">						
                <fieldset>
                    <input name="processSekolah_Ruang" type="hidden" value="1">
                    
                    <div class="form-row row-fluid">
                        <div class="span12">
                            <div class="row-fluid">								
                                <label class="form-label span4" for="checkboxes">Jenis:</label>
                                <div class="span4 controls">
                                    <select name="jenis_ruang" id="ruang_jenis_ruang">
                                        <option value="Belajar">Ruang Belajar</option>
                                        <option value="Laboratorium">Laboratorium</option>
                                        <option value="Kantor">Kantor</option>
                                        <option value="Penunjang">Ruang Penunjang Lain</option>
                                    </select>							
                                </div>
                            </div>
                        </div>
                    </div>
                                       
                    <div class="form-row row-fluid">
                        <div class="span12">
                            <div class="row-fluid">								
                                <label class="form-label span4" for="normal">Jenis Ruangan :</label>
                                <input type="text" class="span4" name="nama_jenis" id="ruang_nama_jenis" maxlength="50" value=""/>
                            </div>
                        </div>
                    </div>
                    <div class="form-row row-fluid">
                        <div class="span12">
                            <div class="row-fluid">								
                                <label class="form-label span4" for="normal">Jumlah :</label>
                                <input type="text" class="span2" name="jml" id="ruang_jml" maxlength="4" value="1"/>
                            </div>
                        </div>
                    </div>

                    <div class="form-row row-fluid">
                        <div class="span12">
                            <div class="row-fluid">								
                                <label class="form-label span4" for="normal">Kondisi :</label>
                                <input type="text" class="span4" name="kondisi" id="ruang_kondisi" maxlength="20" value="Baik"/>
                            </div>
                        </div>
                    </div>
                    <div class="form-row row-fluid">
                        <div class="span12">
                            <div class="row-fluid">								
                                <label class="form-label span4" for="normal">Ukuran :</label>
                                <input type="text" class="span2" name="ukuran" id="ruang_ukuran" maxlength="20" value=""/>
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
              <a href="javascript: submitRuang()" class="btn btn-primary">Save</a>
            </div>
	</div>

	<script type="text/javascript">

            function loadRuangList() {
                    $('#loader').fadeIn(200);
                    $.ajax({
                            type: 'post',
                            url: "controller_sekolah.php",
                            data: 'loadSekolah_Ruang=' + <?php echo Filter::$id;?>,
                            cache: false,
                            success: function (html) {
                                    $("#sekolah_ruang").html(html);
                            }
                    });
                    $('#loader').fadeOut(200);
            }                        

            function submitRuang() {
                var str = $('#ruang_form').serialize();
                   
                $('#RuangModal').modal('hide');
                
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
                                $(loadRuangList()).fadeIn("slow");
                        }, 2000);                            
                    }
                });
                                                
            }

            $(document).ready(function() {
                                                 
                $('#btnRuangadd').live('click', function () {

                    $('#RuangModal').modal();

                    return false;
                  });
                                         
            });
	  
	</script>		
