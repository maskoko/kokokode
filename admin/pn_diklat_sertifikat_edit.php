
	<?php $row = $content->getDiklat_SertifikatPeserta(Filter::$id);	?>

                        <div class="box">

                            <div id="msgholder"></div>

                            <div class="title">
                                <h4> 
                                    <span>Sertifikat Diklat</span>
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
                                                        <?php if ($row->status) echo $content->Diklat_SertifikatStatusList($row->status); else echo $content->Diklat_SertifikatStatusList(); ?>
                                                    </select>							
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <label class="form-label span4" for="normal">No. Sertifikat:</label>
                                                <input type="text" class="span4 required" name="no_sertifikat" id="no_sertifikat" value="<?php if ($row->no_sertifikat) echo $row->no_sertifikat; ?>"/>
                                            </div> 													
                                        </div>
                                    </div>

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <label class="form-label span4" for="normal">Nilai:</label>
												<!--Author Muiz-->
                                                <input type="text" class="span2 required" disabled name="nilai" id="nilai" value="<?php if ($row->totalnilai) echo $row->totalnilai; ?>"/>
                                            </div> 													
                                        </div>
                                    </div>


                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <label class="form-label span4" for="normal">Catatan:</label>
                                                <textarea name="catatan_sertifikat" class="span8" cols="45" rows="5"><?php if ($row->catatan_sertifikat) echo $row->catatan_sertifikat;?></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-info">Save</button>
                                        <button type="button" class="btn" onclick="history.back()">Kembali</button>
										<!--Author Muiz-->
										<a href="controller_print.php?action=createPrintSertifikat<?php echo '&amp;id='.Filter::$id; ?>" class="btn btn-print" role="button" target="_blank">Print Depan</a>										<a href="controller_print.php?action=createPrintSertifikatBelakang<?php echo '&amp;id='.Filter::$id; ?>" class="btn btn-print" role="button" target="_blank">Print Belakang</a>
                                    </div>
                                            
                                    <input name="id" type="hidden" value="<?php echo Filter::$id;?>" /> <!-- pesertaid -->
                                    <input name="userid" type="hidden" value="<?php echo $user->uid;?>" />

                                </fieldset>	
                                </form>

                            </div><!-- End .content -->								
                            
                        </div><!-- End .box -->		
						
<?php echo Core::doForm("processDiklat_Sertifikat"); ?> 	