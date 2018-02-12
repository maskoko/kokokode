
	<?php $diklat = $content->getDiklatList();?>

                        <div class="box">

                            <div id="msgholder"></div>

                            <div class="title">
                                <h4> 
                                    <span>Tambah Jadwal Diklat</span>
                                </h4>								
                            </div>

                            <div class="content">
							
                                <form id="admin_form" class="form-horizontal" method="post" action="">			
                                <fieldset>

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
                                                <input type="text" class="span2 required" name="tahun" id="tahun" value="<?php echo date('Y');?>" maxlength="4" style="width: 60px;"/>
                                            </div> 																								
                                        </div>
                                    </div>

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <label class="form-label span4" for="normal">Tanggal Mulai-Sampai:</label>
                                                <input type="text" class="span2 datepickerField" name="tgl_mulai" id="tgl_mulai" value="<?php echo date('d/m/Y');?>"/>&nbsp;&nbsp;
                                                <input type="text" class="span2 datepickerField" name="tgl_akhir" id="tgl_akhir" value="<?php echo date('d/m/Y', strtotime("+10 days"));?>"/>
                                            </div> 												
                                        </div>
                                    </div>

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <label class="form-label span4" for="normal">Registrasi Mulai-Sampai:</label>
                                                <input type="text" class="span2 datepickerField" name="reg_mulai" id="reg_mulai" value="<?php echo date('d/m/Y', strtotime("+5 days"));?>"/>&nbsp;&nbsp;
                                                <input type="text" class="span2 datepickerField" name="reg_akhir" id="reg_akhir" value="<?php echo date('d/m/Y', strtotime("+7 days"));?>"/>
                                            </div> 													
                                        </div>
                                    </div>																																												

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <label class="form-label span4" for="tempat">Tempat:</label>
                                                <input type="text" class="span4" name="tempat" id="tempat" value="" maxlength="100"/>
                                            </div> 																								
                                        </div>
                                    </div>                                                                        
                                    
                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <label class="form-label span4" for="normal">Keterangan:</label>
                                                <textarea name="keterangan" class="span8" cols="45" rows="5"></textarea>
                                            </div>
                                        </div>											  
                                    </div>

                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-info">Save</button>
                                        <button type="button" class="btn" onclick="history.back()">Kembali</button>
                                    </div>

                                    <input name="userid" type="hidden" value="1" />

                                </fieldset>	
                                </form>       
				
                            </div> <!-- end .content -->
                        </div> <!-- end .box -->
                                   
<?php echo Core::doForm("processDiklat_Jadwal"); ?> 	
