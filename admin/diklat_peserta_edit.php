    <script type="text/javascript" src="js/diklat_peserta_edit.js"></script>

	<?php $row = $content->getDiklat_PesertaById(Filter::$id);	
	
		if (($row) && ($row->kamarid))
			$gedungid = $content->getGedungIdByKamarId($row->kamarid);
		else
			$gedungid = 0;
				
	?>

                        <div class="box">

                            <div id="msgholder"></div>

                            <div class="title">
                                <h4> 
                                    <span>Registrasi Peserta Diklat</span>
                                </h4>								
                            </div>

                            <div class="content">
							
                                <form id="admin_form" class="form-horizontal" method="post" action="">
                                <fieldset>

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <label class="form-label span4" for="normal">NUPTK:</label>
                                                <input type="text" class="span2" name="nuptk" id="nuptk" value="<?php if ($row) echo $row->nuptk;?>"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <label class="form-label span4" for="normal">Nama Lengkap:</label>
                                                <input type="text" class="span8" name="nama_lengkap" id="nuptk" value="<?php if ($row) echo $row->nama_lengkap;?>"/>
                                            </div>
                                        </div>
                                    </div>									

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <label class="form-label span4" for="normal">NIP:</label>
                                                <input type="text" class="span2" name="nip" id="nip" value="<?php if ($row) echo $row->nip;?>"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <label class="form-label span4" for="normal">Sekolah:</label>
                                                <input type="text" class="span8" name="nama_sekolah" id="nama_sekolah" value="<?php if ($row) echo $row->nama_sekolah;?>" disabled="disabled"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <label class="form-label span4" for="normal">Propinsi:</label>
                                                <input type="text" class="span8" name="nama_propinsi" id="nama_propinsi" value="<?php if ($row) echo $row->nama_propinsi;?>" disabled="disabled"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <label class="form-label span4" for="normal">Kota:</label>
                                                <input type="text" class="span8" name="nama_kota" id="nama_kota" value="<?php if ($row) echo $row->nama_kota;?>" disabled="disabled"/>
                                            </div>
                                        </div>
                                    </div>
                                                                        
                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <label class="form-label span4" for="normal">Angkatan:</label>
                                                <input type="text" class="span2" name="angkatan" id="angkatan" maxlength="5" value="<?php if ($row->angkatan) echo $row->angkatan; ?>"/>
                                            </div> 													
                                        </div>
                                    </div>

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <label class="form-label span4" for="normal">Kelas:</label>
                                                <input type="text" class="span2" name="kelas" id="kelas" maxlength="5" value="<?php if ($row->kelas) echo $row->kelas; ?>"/>
                                            </div> 													
                                        </div>
                                    </div>

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <label class="form-label span4" for="normal">Tanggal Undangan:</label>
                                                <input type="text" class="span2 datepickerField" name="reg_undang" id="reg_undang" value="<?php if ($row->reg_undang) echo setToStrdatetime($row->reg_undang);?>"/>
                                            </div> 													
                                        </div>
                                    </div>

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <label class="form-label span4" for="normal">Tanggal Reg Ulang:</label>
                                                <input type="text" class="span2 datepickerField" name="reg_ulang" id="reg_ulang" value="<?php if ($row->reg_ulang) echo setToStrdatetime($row->reg_ulang);?>"/>
                                            </div> 													
                                        </div>
                                    </div>

                                    <?php $gedung = $content->getGedungList();?>

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <label class="form-label span4" for="checkboxes">Gedung:</label>
                                                <div class="span8 controls">
                                                    <select name="gedungid" id="gedungid">
                                                        <option value=""><?php echo lang('SELECT');?></option>
                                                        <?php if ($gedung):?>
                                                            <?php foreach ($gedung as $prow):?>
                                                                <option value="<?php echo $prow->id;?>" <?php if ($prow->id == $gedungid) echo 'selected="selected"';?>><?php echo $prow->nama_gedung;?></option>
                                                            <?php endforeach;?>
                                                            <?php unset($prow);?>
                                                        <?php endif;?>
                                                    </select>						
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <?php $kamar = $content->getKamarList();?>

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <label class="form-label span4" for="checkboxes">Kamar:</label>
                                                <div class="span8 controls">
                                                    <select name="kamarid" id="kamarid">
                                                        <option value=""><?php echo lang('SELECT');?></option>
                                                        <?php if ($kamar):?>
                                                            <?php foreach ($kamar as $prow):?>
                                                                <option value="<?php echo $prow->id;?>" <?php if(($row->kamarid) && ($prow->id == $row->kamarid))echo 'selected="selected"';?>><?php echo $prow->kode.' / '.$prow->jenis;?></option>
                                                            <?php endforeach;?>
                                                            <?php unset($prow);?>
                                                        <?php endif;?>
                                                    </select>						
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <?php $bed = $content->getKamar_BedList();?>

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <label class="form-label span4" for="checkboxes">Bed:</label>
                                                <div class="span8 controls">
                                                    <select name="bedid" id="bedid">
                                                        <option value=""><?php echo lang('SELECT');?></option>
                                                        <?php if ($bed):?>
                                                            <?php foreach ($bed as $prow):?>
                                                                <option value="<?php echo $prow->id;?>" <?php if(($row->bedid) && ($prow->id == $row->bedid))echo 'selected="selected"';?>><?php echo $prow->kode.' / '.$prow->status;?></option>
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
                                                <label class="form-label span4" for="normal">Catatan:</label>
                                                <textarea name="keterangan" class="span8" cols="45" rows="5"><?php if ($row->keterangan) echo $row->keterangan;?></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-info">Save</button>
                                        <button type="button" class="btn" onclick="history.back()">Kembali</button>
                                    </div>

                                    <input name="id" type="hidden" value="<?php echo Filter::$id;?>" /> <!-- pesertaid -->
                                    <input name="userid" type="hidden" value="<?php echo $user->uid;?>" />

                                </fieldset>	
                                </form>

                            </div><!-- End .content -->	
                            
                        </div><!-- End .box -->		

	<script type="text/javascript">

		$(document).ready(function(){
			$("#gedungid").change(function(){
				var id = $("#gedungid").val();
				
				$.ajax({
					type: 'post',
					url: "controller.php",
					data: "loadKamarList=" + id,
					cache: false,
					success: function(html){
						$("#kamarid").html(html); 
					}
				});

			$("#kamarid").val("");

			});
			
			$("#kamarid").change(function(){
				var id = $("#kamarid").val();
				
				$.ajax({
					type: 'post',
					url: "controller.php",
					data: "loadKamar_BedList=" + id,
					cache: false,
					success: function(html){
						$("#bedid").html(html); 
					}
				});

			$("#bedid").val("");

			});
			
		});
	  
	</script>		
						
												
<?php echo Core::doForm("processDiklat_Peserta"); ?> 	
