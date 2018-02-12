    <script type="text/javascript" src="js/diklat.js"></script>
	
	<?php 
        
            $departemen = $content->getDepartemenList();
            $tingkat = $content->getDiklat_TingkatList();            
            $diklatlist = $content->getDiklatList();
        
        ?>

                        <div class="box">

                            <div id="msgholder"></div>
                                                           
                            <div class="title">
                                <h4> 
                                    <span>Tambah Katalog Diklat</span>
                                </h4>								
                            </div>

                            <div class="content">

                                <form id="admin_form" class="form-horizontal" method="post" action="">			
                                <fieldset>

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <label class="form-label span4" for="normal">Kode:</label>
                                                <input type="text" class="span2 required" name="kode" id="kode" value=""/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <label class="form-label span4" for="normal">Nama Diklat:</label>
                                                <input type="text" class="span8 required" name="nama_diklat" id="nama_diklat" value=""/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <label class="form-label span4" for="normal">Kode DAI:</label>
                                                <input type="text" class="span2" required" name="source_kode" id="source_kode" value=""/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <label class="form-label span4" for="checkboxes">Departemen:</label>
                                                <div class="span8 controls">
                                                    <select name="departemenid" id="departemenid"">
                                                        <option value=""><?php echo lang('SELECT');?></option>
                                                        <?php if ($departemen):?>
                                                            <?php foreach ($departemen as $prow):?>
                                                                <option value="<?php echo $prow->id;?>"><?php echo $prow->nama_departemen;?></option>
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
                                                <label class="form-label span4" for="normal">Jml Jam (Pola):</label>												
                                                <input type="text" class="span2" name="jml_jam" id="jml_jam" size="3" value="10"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <label class="form-label span4" for="checkboxes">Jenjang:</label>
                                                <div class="span4 controls">
                                                    <select name="tingkat" id="tingkat"">
                                                        <option value=""><?php echo lang('SELECT');?></option>
                                                        <?php if ($tingkat):?>
                                                            <?php foreach ($tingkat as $prow):?>
                                                                <option value="<?php echo $prow->tingkat;?>"><?php echo $prow->tingkat;?></option>
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
                                                <input type="text" class="span2 required" name="tahun" id="tahun" value="<?php echo date('Y');?>"/>
                                            </div> 																								
                                        </div>
                                    </div>
                                                                        
                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <label class="form-label span4" for="checkboxes">Jenis:</label>
                                                <div class="span2 controls">
                                                    <select name="jenis" id="jenis">
                                                        <?php echo $content->DiklatJenisList(); ?>
                                                    </select>							
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <?php $bsk = $content->getBSKList();?>
                                    
                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">
                                                <label class="form-label span4" for="checkbox">Bidang Keahlian:</label>
                                                <div class="span8 controls">
                                                    <select name="bskid" id="bskid" class="required">
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
                                                <label class="form-label span4" for="checkbox">Program Keahlian:</label>
                                                <div class="span8 controls">
                                                    <select name="pskid" id="pskid" class="required">
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
                                                <label class="form-label span4" for="checkbox">Paket Keahlian:</label>
                                                <div class="span8 controls">
                                                    <select name="kkid" id="kkid" class="required">
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
                                                <label class="form-label span4" for="checkbox">Link Diklat:</label>
                                                <div class="span8 controls">
                                                    <select name="linkid" id="linkid" class="required">
                                                        <option value=""><?php echo lang('SELECT');?></option>
                                                        <?php if ($diklatlist):?>
                                                            <?php foreach ($diklatlist as $prow):?>
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
                                              <label class="form-label span4" for="normal">Kompetensi:</label>
                                              <textarea class="span8" name="kompetensi" cols="45" rows="5"></textarea>
                                            </div>
                                        </div>
                                    </div>                                    
                                    
                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                              <label class="form-label span4" for="normal">Keterangan:</label>
                                              <textarea class="span8" name="deskripsi" cols="45" rows="5"></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-info">Save</button>
                                        <button type="button" class="btn" onclick="history.back()">Kembali</button>
                                    </div>

                                    <input name="source_name" type="hidden" value="SIM" />
                                    <input name="userid" type="hidden" value="<?php echo $user->uid; ?>" />

                                </fieldset>
                                </form>       		
		
                            </div><!-- End .content -->
                        </div><!-- End .box -->
				
<?php echo Core::doForm("processAddDiklat"); ?> 	

	<script type="text/javascript">

		$(document).ready(function(){
		
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
                        