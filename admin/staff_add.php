    <script type="text/javascript" src="js/staff_edit.js"></script>

                <div class="heading">
                    <h3>Data Staff</h3>                                        
                </div><!-- End .heading-->
    				
                <!-- Build page from here: Usual with <div class="row-fluid"></div> -->

                <div class="row-fluid">
                    <div class="span12">

                        <div id="msgholder"></div>
                                                
                        <div class="box">

                            <?php 
                            
                                $propinsi = $content->getPropinsiList();
                                $kota = $content->getKotaByPropinsiList(0);
                                $golongan = $content->getGolonganList();
                                
                                $lbg_propinsi_kode = "";
                                $lbg_kota_kode = "";
                                                                
                            ?>

                            <div class="title">
                                <h4> 
                                    <span>Tambah Data Staff</span>
                                    <span id="loader" class="loader" style="display:none"><img src="images/loader_circular.gif" width="16" height="16" alt=""></span>
                                </h4>								
                            </div>

                            <div class="content">

                                <form id="admin_form" class="form-horizontal" method="post" action="">			
                                <fieldset>

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <label class="form-label span2" for="normal">Nama Lengkap:
                                                    <span class="help-block">Opsi 3 gelar.</span>
                                                </label>
                                                <input type="text" class="span2" name="gelar_depan1" id="gelar_depan1" value="" maxlength="6" style="width:50px;" data-provide="typeahead"/>
                                                <input type="text" class="span2" name="gelar_depan2" id="gelar_depan2" value="" maxlength="6" style="width:50px;" data-provide="typeahead"/>
                                                <input type="text" class="span2" name="gelar_depan3" id="gelar_depan3" value="" maxlength="6" style="width:50px;" data-provide="typeahead"/>
                                                <input type="text" class="span6 required" name="nama_lengkap" id="nama_lengkap" value=""/>
                                                <input type="text" class="span2" name="gelar_belakang1" id="gelar_belakang1" value="" maxlength="6" style="width:50px;" data-provide="typeahead"/>
                                                <input type="text" class="span2" name="gelar_belakang2" id="gelar_belakang2" value="" maxlength="6" style="width:50px;" data-provide="typeahead"/>
                                                <input type="text" class="span2" name="gelar_belakang3" id="gelar_belakang3" value="" maxlength="6" style="width:50px;" data-provide="typeahead"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <label class="form-label span2" for="normal">NIP:
                                                    <span class="help-block">18 digit numerik</span>
                                                </label>
                                                <div class="span2 controls">
                                                    <input type="text" name="nip" id="nip" value="" maxlength="18"/>
                                                </div>
                                                <label class="form-label span2" for="nuptk">NUPTK:
                                                    <span class="help-block">16 digit numerik</span>
                                                </label>
                                                <div class="span2 controls">
                                                    <input type="text" name="nuptk" id="nuptk" value="" maxlength="16"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>			

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">
                                                <span class="orange"><label class="form-label span2" for="checkboxes">Propinsi Lembaga:</label></span>
                                                <div class="span8 controls">
                                                    <select name="lbg_propinsi_kode" id="lbg_propinsi_kode" class="nostyle">
                                                        <option value=""><?php echo lang('SELECT');?></option>
                                                        <?php if ($propinsi):?>
                                                            <?php foreach ($propinsi as $prow):?>
                                                                <option value="<?php echo $prow->kode;?>"><?php echo $prow->nama_propinsi;?></option>
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
                                                <span class="orange"><label class="form-label span2" for="checkboxes">Kota/Kab Lembaga:</label></span>
                                                <div class="span8 controls">
                                                    <select name="lbg_kota_kode" id="lbg_kota_kode" class="nostyle">
                                                        <option value=""><?php echo lang('SELECT');?></option>
                                                        <?php if ($kota):?>
                                                            <?php foreach ($kota as $prow):?>
                                                                <option value="<?php echo $prow->kode;?>"><?php echo $prow->nama_kota;?></option>
                                                            <?php endforeach;?>
                                                            <?php unset($prow);?>
                                                        <?php endif;?>
                                                    </select>						
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                                      
                                    <?php 
                                        if (($lbg_propinsi_kode != "") && ($lbg_kota_kode != ""))
                                            $lembaga = $content->getLembagaList($lbg_propinsi_kode, $lbg_kota_kode);
                                        else
                                            $lembaga = null;
                                    ?>

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <span class="orange"><label class="form-label span2" for="checkboxes">Lembaga:</label></span>
                                                <div class="span8 controls">
                                                    <select name="lembagaid" id="lembagaid" class="nostyle" style="width:100%;" placeholder="Select...">
                                                        <option value=""><?php echo lang('SELECT');?></option>
                                                        <?php if ($lembaga):?>
                                                            <?php foreach ($lembaga as $prow):?>
                                                                <option value="<?php echo $prow->id;?>"><?php echo $prow->nama_lembaga;?></option>
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
                                                <label class="form-label span2" for="checkboxes">Tempat:</label>
                                                <div class="span4 controls">
                                                    <input type="text" name="tmp_lahir" id="tmp_lahir" value=""/>
                                                </div>
                                                <label class="form-label span2" for="checkboxes">Tgl Lahir:</label>
                                                <div class="span2 controls">
                                                    <input type="text" class="datepickerField" name="tgl_lahir" id="tgl_lahir" value=""/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <label class="form-label span2" for="normal">No. KTP:</label>
                                                <div class="span4 controls">
                                                    <input type="text" name="no_ktp" id="no_ktp" value="""/>
                                                </div>
                                                
                                                <label class="form-label span2" for="checkboxes">Status Kawin:</label>
                                                <div class="span2 controls">
                                                    <select name="status_kawin" id="status_kawin" class="nostyle">
                                                        <?php echo $content->Status_KawinList(); ?>
                                                    </select>							
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <label class="form-label span2" for="checkboxes">Jenis Kelamin:</label>
                                                <div class="span2 controls">
                                                    <select name="jns_klmn" id="jns_klmn" class="nostyle">
                                                        <?php echo $content->Jenis_KelaminList(); ?>
                                                    </select>							
                                                </div>
                                                
                                                <label class="form-label span2" for="checkboxes">Agama:</label>
                                                <div class="span2 controls">
                                                    <select name="agama" id="agama" class="nostyle">
                                                        <?php echo $content->AgamaList(); ?>
                                                    </select>							
                                                </div>                                                
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <label class="form-label span2" for="checkboxes">Golongan:</label>
                                                <div class="span2 controls">
                                                    <select name="golongan" id="golongan" class="nostyle">
                                                        <option value=""><?php echo lang('SELECT');?></option>
                                                        <?php if ($golongan):?>
                                                            <?php foreach ($golongan as $prow):?>
                                                                <option value="<?php echo $prow->kode;?>"><?php echo $prow->kode;?></option>
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
                                                <label class="form-label span2" for="normal">Alamat:</label>
                                                <div class="span4 controls">
                                                    <input type="text" name="alamat" id="alamat" value=""/>
                                                </div>
                                                <label class="form-label span2" for="normal">Kode Pos:</label>
                                                <div class="span2 controls">
                                                    <input type="text" name="kodepos" id="kodepos" value=""/>                                                
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <label class="form-label span2" for="checkboxes">Propinsi:</label>
                                                <div class="span8 controls">
                                                    <select name="propinsi_kode" id="propinsi_kode" class="nostyle">
                                                        <option value=""><?php echo lang('SELECT');?></option>
                                                        <?php if ($propinsi):?>
                                                            <?php foreach ($propinsi as $prow):?>
                                                                <option value="<?php echo $prow->kode;?>"><?php echo $prow->nama_propinsi;?></option>
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
                                                <label class="form-label span2" for="checkboxes">Kota:</label>
                                                <div class="span8 controls">
                                                    <select name="kota_kode" id="kota_kode" class="nostyle">
                                                        <option value=""><?php echo lang('SELECT');?></option>
                                                        <?php if ($kota):?>
                                                            <?php foreach ($kota as $prow):?>
                                                                <option value="<?php echo $prow->kode;?>"><?php echo $prow->nama_kota;?></option>
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
                                                <label class="form-label span2" for="normal">Kelurahan:</label>
                                                <input type="text" class="span8" name="kelurahan" id="alamat" value=""/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <label class="form-label span2" for="normal">Kecamatan:</label>
                                                <input type="text" class="span8" name="kecamatan" id="kecamatan" value=""/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <label class="form-label span2" for="normal">Telepon Rumah:</label>
                                                <div class="span2 controls">
                                                    <input type="text" name="telepon1" id="telepon1" value=""/>
                                                </div>
                                                <label class="form-label span2" for="normal">Handphone:</label>
                                                <div class="span2 controls">
                                                    <input type="text" name="telepon2" id="telepon2" value=""/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <label class="form-label span2" for="normal">E-Mail:</label>
                                                <input type="text" class="span8" name="email" id="email" value=""/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <label class="form-label span2" for="normal">TMT:</label>
                                                <div class="span2 controls">
                                                    <input type="text" class="datepickerField" name="tmt" id="tmt" value=""/>
                                                </div>                                                
                                                <label class="form-label span2" for="normal">TMT Internal:</label>
                                                <div class="span2 controls">
                                                    <input type="text" class="datepickerField" name="tmtin" id="tmtin" value=""/>
                                                </div>                                                
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-info">Save</button>
                                        <button type="button" class="btn" onclick="history.back()">Kembali</button>
                                    </div>

                                    <input name="userid" type="hidden" value="<?php echo $user->uid; ?>" />

                                </fieldset>
                                </form>       
                            </div><!-- End .box -->

                        </div><!-- End .box -->

                    </div><!-- End .span12 -->
                </div><!-- End .row-fluid -->  
                                                
	<script type="text/javascript">

		$(document).ready(function(){
			$("#propinsi_kode").change(function(){
				var kode = $("#propinsi_kode").val();
				
				$.ajax({
					type: 'post',
					url: "controller.php",
					data: "loadKotaList=" + kode,
					cache: false,
					success: function(html){
						$("#kota_kode").html(html); 
					}
				});

                                $("#kota_kode").val("");


			});
                        
			$("#lbg_propinsi_kode").change(function(){
				var kode = $("#lbg_propinsi_kode").val();
				
				$.ajax({
					type: 'post',
					url: "controller.php",
					data: "loadKotaList=" + kode,
					cache: false,
					success: function(html){
						$("#lbg_kota_kode").html(html); 
					}
				});

                                $("#lbg_kota_kode").val("");

			});

			$("#lbg_kota_kode").change(function(){
				var propinsi_kode = $("#lbg_propinsi_kode").val();
				var kota_kode = $("#lbg_kota_kode").val();
				
				$.ajax({
					type: 'post',
					url: "controller.php",
					data: "loadLembagaList=" + propinsi_kode + "&kota=" + kota_kode,
					cache: false,
					success: function(html){
						$("#lembagaid").html(html); 
					}
				});

                                $("#lembagaid").val("");

			});
                        
                        var options = {
                                target: "#msgholder",
                                beforeSubmit:  showLoader,
                                success: showResponse,
                                url: "controller.php",
                                resetForm : 0,
                                clearForm : 0,
                                data: {
                                        processAddStaff: 1
                                }
                        };

                        $("#admin_form").ajaxForm(options);
                                                  
                        function showLoader() {
                                $("#loader").fadeIn(200);
                        }
		  
                        function hideLoader() {
                              $("#loader").fadeOut(200);
                        };	

                        function showResponse(msg) {    
                            hideLoader();
                                                            
                            if (msg.indexOf('OK_') >= 0) {
                                var id = msg.replace('OK_', '');
                                window.location = 'index.php?do=staff&action=edit&id=' + id;
                            } else {
                              $(this).html(msg);
                              $("html, body").animate({
                                      scrollTop: 0
                              }, 600);                                  
                            }                                  
                              
                        }                                                
                       
                    var gelar = ['Drs', 'Dr', 'MSi', 'SPd', 'M.Pd', 'S.Ag', 'Ir', 'SE', 'S.Kom', 'S.Pd.Ekop', 'Dra', 'S.Sos'];   
                    $('#gelar_depan1').typeahead({source: gelar});
                    $('#gelar_depan2').typeahead({source: gelar});
                    $('#gelar_depan3').typeahead({source: gelar});

                    $('#gelar_belakang1').typeahead({source: gelar});
                    $('#gelar_belakang2').typeahead({source: gelar});
                    $('#gelar_belakang3').typeahead({source: gelar});            
                                              
		});
	  
	</script>		
		
