
	<script type="text/javascript" src="js/pn_diklat_sertifikat_validasi.js"></script>
	
                        <?php $row = $content->getDiklat_SertifikatPeserta(Filter::$id); ?>

                        <div class="box">

                            <div id="msgholder"></div>

                            <div class="title">
                                <h4> 
                                    <span>Identitas Peserta</span>
                                </h4>								
                                <a href="#" class="minimize">Minimize</a>
                            </div>

                            <div class="content">

                                <form id="ptk_form" class="form-horizontal" method="post" action="">
                                <fieldset>

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <label class="form-label span4" for="normal">Nama:</label>
                                                <input type="text" class="span8 required" name="nama_lengkap" id="nama_lengkap" value="<?php if ($row) echo $row->nama_lengkap;?>" maxlength="60"/>
                                            </div>
                                        </div>
                                    </div>									

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <label class="form-label span4" for="normal">Tempat &amp; Tgl Lahir:</label>
                                                <input type="text" class="span4 required" name="tmp_lahir" id="tmp_lahir" value="<?php if ($row) echo $row->tmp_lahir;?>"  maxlength="50"/>&nbsp;&nbsp;
                                                <input type="text" class="span2 datepickerField required" name="tgl_lahir" id="tgl_lahir" value="<?php if ($row) echo $row->tgl_lahir;?>" />
                                            </div>
                                        </div>
                                    </div>									

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <label class="form-label span4" for="checkboxes">Jenis Kelamin:</label>
                                                <div class="span2 controls">
                                                    <select name="jns_klmn" id="jns_klmn" class="required">
                                                        <?php if ($row) echo $content->Jenis_KelaminList($row->jns_klmn); else echo $content->JenisKelaminList(); ?>
                                                    </select>							
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <label class="form-label span4" for="normal">NIP/NIK:</label>
                                                <input type="text" class="span2 required" name="nip" id="nip" value="<?php if ($row) echo $row->nip;?>"  maxlength="18"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <label class="form-label span4" for="normal">NUPTK:</label>
                                                <input type="text" class="span2 required" name="nuptk" id="nuptk" value="<?php if ($row) echo $row->nuptk;?>"  maxlength="16"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <label class="form-label span4" for="checkboxes">Agama:</label>
                                                <div class="span2 controls">
                                                    <select name="agama" id="agama" class="required">
                                                        <?php if ($row) echo $content->AgamaList($row->jns_klmn); else echo $content->AgamaList(); ?>
                                                    </select>							
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <label class="form-label span4" for="normal">Alamat:</label>
                                                <input type="text" class="span8 required" name="alamat" id="alamat" value="<?php if ($row) echo $row->alamat;?>" maxlength="60"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <label class="form-label span4" for="normal">Telepon:</label>
                                                <input type="text" class="span4 required" name="telepon1" id="telepon1" value="<?php if ($row) echo $row->telepon1;?>" maxlength="20" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <label class="form-label span4" for="normal">Nama Ibu Kandung:</label>
                                                <input type="text" class="span8 required" name="nama_ibu" id="nama_ibu" value="<?php if ($row) echo $row->nama_ibu;?>" maxlength="60" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-info">Save</button>
                                        <button type="button" class="btn" onclick="history.back()">Kembali</button>
                                    </div>

                                    <input name="id" type="hidden" value="<?php echo Filter::$id;?>" /> <!-- pesertaid -->
                                    <input name="personid" type="hidden" value="<?php echo $row->personid;?>" /> <!-- ptkid -->
                                    <input name="userid" type="hidden" value="<?php echo $user->uid;?>" />

                                </fieldset>	
                                </form>

                                <?php echo Core::doForm("processDiklat_SertifikatValidasi", "controller.php", 0, 0, "ptk_form", "msgholder"); ?> 	

                            </div><!-- End .content -->								
                                
                        </div><!-- End .box -->		

                        <div class="box"> <!-- Data Sekolah -->

                            <div id="msgholder"></div>

                            <div class="title">
                                <h4> 
                                    <span>Data Sekolah Pengirim</span>
                                </h4>								
                                <a href="#" class="minimize">Minimize</a>
                            </div>

                            <div class="content">

                                <form id="sekolah_form" class="form-horizontal" method="post" action="">
                                <fieldset>

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <label class="form-label span4" for="normal">Nama Sekolah:</label>
                                                <input type="text" class="span8" name="nama_Sekolah" id="nama_Sekolah" value="" disabled="disabled"/>
                                            </div>
                                        </div>
                                    </div>									

                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-info">Save</button>
                                        <button type="button" class="btn" onclick="history.back()">Kembali</button>
                                    </div>

                                        
                                    <input name="id" type="hidden" value="<?php echo Filter::$id;?>" /> <!-- pesertaid -->
                                    <input name="pesertaid" type="hidden" value="<?php echo $row->id;?>" /> <!-- pesertaid -->
                                    <input name="userid" type="hidden" value="<?php echo $user->uid;?>" />

                                </fieldset>	
                                </form>

                            </div><!-- End .content -->
                            
                        </div><!-- End .box -->		
					