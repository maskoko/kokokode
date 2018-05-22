    <script type="text/javascript" src="js/diklat.js"></script>

                        <div class="box">

                            <div id="msgholder"></div>
        
                            <div class="title">
                                <h4> 
                                    <span>Edit Katalog Diklat</span>
                                </h4>								
                            </div>

                            <div class="content">

                                <?php 
                                
                                    $row = Core::getRowById("diklat", Filter::$id);
                                    if ($row) {
                                        if ($row->pskid) {
                                            $pskrow = Core::getRowById("psk", $row->pskid);
                                            if ($pskrow) {
                                                $bskid = $pskrow->bskid;
                                                unset ($pskrow);
                                            }
                                        } else
                                            $bskid = 0;
                                    } else
                                        $bskid = 0;
                                                                        
                                    $departemen = $content->getDepartemenList();
                                    $tingkat = $content->getDiklat_TingkatList();
                                    $diklatlist = $content->getDiklatList();
                                                                        
                                ?>

                                <form id="admin_form" class="form-horizontal" method="post" action="">			
                                <fieldset>
                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">
                                                <label class="form-label span4" for="normal">Kode:</label>
                                                <input type="text" class="span2 required" name="kode" id="kode" value="<?php echo $row->kode;?>"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <label class="form-label span4" for="normal">Nama Diklat:</label>
                                                <input type="text" class="span8 required" name="nama_diklat" id="nama_diklat" value="<?php echo $row->nama_diklat;?>"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <label class="form-label span4" for="normal">Kode DAI:</label>
                                                <input type="text" class="span2" name="source_kode" id="source_kode" value="<?php echo $row->source_kode;?>"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <label class="form-label span4" for="checkboxes">Departemen:</label>											
                                                <div class="span8 controls">								
                                                    <select name="departemenid" id="departemenid">
                                                        <option value=""><?php echo lang('SELECT');?></option>
                                                        <?php if ($departemen):?>
                                                            <?php foreach ($departemen as $prow):?>
                                                                <option value="<?php echo $prow->id;?>" <?php if($prow->id == $row->departemenid)echo 'selected="selected"';?>><?php echo $prow->nama_departemen;?></option>
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
                                                <input type="text" class="span2 required" name="jml_jam" id="jml_jam" value="<?php echo $row->jml_jam;?>"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <label class="form-label span4" for="checkboxes">Jenjang:</label>
                                                <div class="span2 controls">
                                                    <select name="tingkat" id="tingkat">
                                                        <option value=""><?php echo lang('SELECT');?></option>
                                                        <?php if ($tingkat):?>
                                                            <?php foreach ($tingkat as $prow):?>
                                                                <option value="<?php echo $prow->tingkat;?>" <?php if($prow->tingkat == $row->tingkat)echo 'selected="selected"';?>><?php echo $prow->tingkat;?></option>
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
                                                <input type="text" class="span2 required" name="tahun" id="tahun" value="<?php echo $row->tahun;?>"/>
                                            </div> 																								
                                        </div>
                                    </div>
                                                                        
                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <label class="form-label span4" for="checkboxes">Jenis:</label>
                                                <div class="span2 controls">									
                                                    <select name="jenis" id="jenis">
                                                        <?php echo $content->DiklatJenisList($row->jenis); ?>
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
                                                                <option value="<?php echo $prow->id;?>" <?php if($prow->id == $bskid)echo 'selected="selected"';?>><?php echo $prow->nama_bidang;?></option>
                                                            <?php endforeach;?>
                                                            <?php unset($prow);?>
                                                        <?php endif;?>
                                                    </select>					
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <?php 
                                    
                                        //if ($bskid != 0)
                                            $psk = $content->getPSKList($bskid);
                                    
                                    ?>
                                                                        
                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">
                                                <label class="form-label span4" for="checkbox">Program Keahlian:</label>
                                                <div class="span8 controls">
                                                    <select name="pskid" id="pskid" class="required">
                                                        <option value=""><?php echo lang('SELECT');?></option>
                                                        <?php if ($psk):?>
                                                            <?php foreach ($psk as $prow):?>
                                                                <option value="<?php echo $prow->id;?>" <?php if($prow->id == $row->pskid)echo 'selected="selected"';?>><?php echo $prow->nama_program;?></option>
                                                            <?php endforeach;?>
                                                            <?php unset($prow);?>
                                                        <?php endif;?>
                                                    </select>					
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <?php 
                                    
                                        if ($row->pskid)
                                            $kk = $content->getKKList($row->pskid);
                                    
                                    ?>
                                                                        
                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">
                                                <label class="form-label span4" for="checkbox">Paket Keahlian:</label>
                                                <div class="span8 controls">
                                                    <select name="kkid" id="kkid" class="required">
                                                        <option value=""><?php echo lang('SELECT');?></option>
                                                        <?php if ($kk):?>
                                                            <?php foreach ($kk as $prow):?>
                                                                <option value="<?php echo $prow->id;?>" <?php if($prow->id == $row->kkid)echo 'selected="selected"';?>><?php echo $prow->nama_kompetensi;?></option>
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
                                                                <?php if ($prow->id != Filter::$id) : ?>
                                                                    <option value="<?php echo $prow->id;?>" <?php if($prow->id == $row->linkid)echo 'selected="selected"';?>><?php echo $prow->nama_diklat;?></option>
                                                                <?php endif; ?>    
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
                                              <textarea class="span8" name="kompetensi" cols="45" rows="5"><?php echo $row->kompetensi;?></textarea>
                                            </div>
                                        </div>
                                    </div>                                    
                                                                        
                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <label class="form-label span4" for="normal">Keterangan:</label>
                                                <textarea name="deskripsi" class="span8" cols="45" rows="5"><?php echo $row->deskripsi;?></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-info">Save</button>
                                        <button type="button" class="btn" onclick="history.back()">Kembali</button>
                                    </div>

                                    <input name="id" type="hidden" value="<?php echo Filter::$id;?>" />
                                    <input name="userid" type="hidden" value="<?php echo $row->userid;?>" />

                                </fieldset>
                                </form>       
				
                            </div><!-- End .content -->
                        </div><!-- End .box -->
                                                                        
<?php echo Core::doForm("processUpdateDiklat"); ?>

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
                        