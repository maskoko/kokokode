    <script type="text/javascript" src="js/pn_diklat_absen_edit.js"></script>

                        <?php $row = $content->getDiklat_AbsenPeserta(Filter::$id);	?>

                        <div class="box">

                            <div id="msgholder"></div>

                            <div class="title">
                                <h4> 
                                    <span>Absensi Diklat</span>
                                </h4>								
                            </div>

                            <div class="content">

                                <form id="admin_form" class="form-horizontal" method="post" action="">
                                <fieldset>

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <label class="form-label span4" for="normal">NUPTK:</label>
                                                <input type="text" class="span2" name="nuptk" id="nuptk" value="<?php if ($row) echo $row->nuptk;?>" disabled="disabled" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <label class="form-label span4" for="normal">Nama:</label>
                                                <input type="text" class="span8" name="nama_lengkap" id="nuptk" value="<?php if ($row) echo $row->nama_lengkap;?>" disabled="disabled" />
                                            </div>
                                        </div>
                                    </div>									

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <label class="form-label span4" for="normal">NIP:</label>
                                                <input type="text" class="span2" name="nip" id="nip" value="<?php if ($row) echo $row->nip;?>" disabled="disabled" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <label class="form-label span4" for="normal">Sekolah:</label>
                                                <input type="text" class="span8" name="nama_sekolah" id="nama_sekolah" value="<?php if ($row) echo $row->nama_sekolah;?>" disabled="disabled" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <label class="form-label span4" for="normal">Propinsi:</label>
                                                <input type="text" class="span8" name="nama_propinsi" id="nama_propinsi" value="<?php if ($row) echo $row->nama_propinsi;?>" disabled="disabled" />
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <label class="form-label span4" for="checkboxes">Status:</label>
                                                <div class="span2 controls">
                                                    <select name="status" id="status">
                                                        <?php if ($row->status) echo $content->Diklat_AbsenStatusList($row->status); else echo $content->Diklat_AbsenStatusList(); ?>
                                                    </select>							
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <label class="form-label span4" for="tanggal">Waktu Absen:</label>
                                                <input type="text" class="span2 datepickerField required" name="tanggal" id="tanggal" value="<?php if ($row->tanggal) echo date("d/m/Y", strtotime($row->tanggal)); else echo date('d/m/Y');?>"/>
                                                <input type="text" class="span2 required" name="waktu" id="waktu" autocomplete="off" value="<?php if ($row->waktu) echo $row->waktu; else echo date('H:i:s');?>"/>
                                            </div> 													
                                        </div>
                                    </div>

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <label class="form-label span4" for="normal">Keterangan:</label>
                                                <textarea name="catatan" class="span8" cols="45" rows="5"><?php if ($row->catatan) echo $row->catatan;?></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-info">Save</button>
                                        <button type="button" class="btn" onclick="history.back()">Kembali</button>
                                    </div>

                                    <?php if ($row->absenid) : ?>
                                        <input name="id" type="hidden" value="<?php echo $row->absenid;?>" />
                                    <?php endif; ?>									
                                    <input name="pesertaid" type="hidden" value="<?php echo $row->id;?>" /> <!-- pesertaid -->
                                    <input name="userid" type="hidden" value="<?php echo $user->uid;?>" />

                                </fieldset>	
                                </form>

                            </div><!-- End .content -->								
                        </div><!-- End .box -->		
						
<?php echo Core::doForm("processDiklat_Absen"); ?> 	
