
                        <div class="box">

                            <div id="msgholder"></div>

                            <?php $propinsi = $content->getPropinsiList();?>
                            <?php $kota = $content->getKotaByPropinsiList(0);?>

                            <div class="title">
                                <h4> 
                                    <span>Tambah Data Lembaga</span>
                                </h4>								
                            </div>

                            <div class="content">

                                <form id="admin_form" class="form-horizontal" method="post" action="">			
                                <fieldset>

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <label class="form-label span4" for="normal">Nama Lembaga:</label>
                                                <input type="text" class="span8 required" name="nama_lembaga" id="nama_lembaga" value=""/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <label class="form-label span4" for="normal">Nama Pimpinan:</label>
                                                <input type="text" class="span8 required" name="nama_pimpinan" id="nama_pimpinan" value=""/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <label class="form-label span4" for="normal">NIP & NUPTK Pimpinan:</label>
                                                <input type="text" class="span2" name="nip_pimpinan" id="nip_pimpinan" value="" maxlength="18"/>
                                                <input type="text" class="span2" name="nuptk_pimpinan" id="nuptk_pimpinan" value="" maxlength="16"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <label class="form-label span4" for="normal">No. Telp Pimpinan:</label>
                                                <input type="text" class="span2" name="telp_pimpinan" id="telp_pimpinan" value=""/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <label class="form-label span4" for="normal">Alamat:</label>
                                                <input type="text" class="span8 required" name="alamat" id="alamat" value=""/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <label class="form-label span4" for="checkboxes">Propinsi:</label>
                                                <div class="span8 controls">
                                                    <select name="propinsi_kode" id="propinsi_kode">
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
                                                <label class="form-label span4" for="checkboxes">Kota:</label>
                                                <div class="span8 controls">
                                                    <select name="kota_kode" id="kota_kode">
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
                                                <label class="form-label span4" for="normal">Kode Pos:</label>
                                                <input type="text" class="span2" name="kodepos" id="kodepos" value=""/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <label class="form-label span4" for="normal">Telepon (1-2) & Fax:</label>
                                                <input type="text" class="span2" name="telepon1" id="telepon1" value=""/>
                                                <input type="text" class="span2" name="telepon2" id="telepon2" value=""/>
                                                <input type="text" class="span2" name="fax" id="fax" value=""/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <label class="form-label span4" for="normal">E-Mail:</label>
                                                <input type="text" class="span8" name="email" id="email" value=""/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <label class="form-label span4" for="normal">Web Site:</label>
                                                <input type="text" class="span8" name="website" id="website" value=""/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-info">Save</button>
                                        <button type="button" class="btn" onclick="history.back()">Kembali</button>
                                    </div>

                                    <input name="source_id" type="hidden" value="" />
                                    <input name="source_name" type="hidden" value="SIM" />
                                    <input name="userid" type="hidden" value="<?php echo $user->uid;?>" />
                                </fieldset>	
                                </form> 
                            </div><!-- End content -->

                        </div><!-- End .box -->

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
						jQuery("#kota_kode").html(html); 
					}
				});

			$("#kota_kode").val("");

			});
		});
	  
	</script>		
	
<?php echo Core::doForm("processAddLembaga"); ?> 	
