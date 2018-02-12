    <script type="text/javascript" src="js/ptk_edit.js"></script>

                <div class="heading">
                    <h3><span>Data Pengajar dan Tenaga Kependidikan (PTK)</span>
                        <span id="loader" class="loader" style="display:none"><img src="images/loader_circular.gif" width="16" height="16" alt=""></span>
                    </h3>                                        
                </div><!-- End .heading-->
    				
                <!-- Build page from here: Usual with <div class="row-fluid"></div> -->

                <div class="row-fluid">
                    <div class="span12">

                        <div id="msgholder"></div>

                        <div style="margin-bottom: 20px;">
                            <ul id="myTab" class="nav nav-tabs pattern">
                                <li class="active"><a href="#tab1" data-toggle="tab">Biodata Pokok</a></li>
                                <li><a href="#tab2" data-toggle="tab">Ajuan Diklat</a></li>
                                <li><a href="#tab3" data-toggle="tab">Mengajar</a></li>
                                <li><a href="#tab4" data-toggle="tab">Riwayat Diklat Lain</a></li>
                                <li><a href="#tab5" data-toggle="tab">Riwayat Pendidikan</a></li>
                                <li><a href="#tab6" data-toggle="tab">Sertifikasi/Uji Kompetensi</a></li>
                            </ul>

                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="tab1">

                                    <?php 
                                        
                                        $row = $content->getPTKById(Filter::$id);
                                        $propinsi = $content->getPropinsiList();
                                        $kota = null;
                                        $golongan = $content->getGolonganList();

                                        if ($row->sekolahid) {
                                            $sek_row = Core::getRowById("sekolah", $row->sekolahid);
                                            if ($sek_row) {
                                                $sek_propinsi_kode = $sek_row->propinsi_kode;
                                                $sek_kota_kode = $sek_row->kota_kode;
                                                
                                                $kota = $content->getKotaList($sek_propinsi_kode); 
                                                
                                                unset($sek_row);
                                            } else {
                                                $sek_propinsi_kode = "";
                                                $sek_kota_kode = "";
                                            }                                            
                                        } else {
                                                $sek_propinsi_kode = "";
                                                $sek_kota_kode = "";
                                            }                                            
                                        
                                    ?>

                                    <form id="admin_form" class="form-horizontal" method="post" action="">			
                                    <fieldset>
                                        
                                        <div class="form-row row-fluid">
                                            <div class="span12">
                                                <div class="row-fluid">								
                                                    <label class="form-label span2" for="normal">NUPTK:
                                                        <span class="help-block">16 digit numerik</span></label>
                                                    <div class="span4 controls">
                                                        <input type="text" class="required" name="nuptk" id="nuptk" value="<?php echo $row->nuptk;?>" maxlength="16" style="width: 150px;"/>
                                                    </div>
													
                                                    <label class="form-label span2" for="normal">NIP:
                                                        <span class="help-block">18 digit numerik</span></label>
                                                    <div class="span4 controls">
                                                        <input type="text" name="nip" id="nip" value="<?php echo $row->nip;?>" maxlength="18" style="width: 200px;"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
										
                                        <div class="form-row row-fluid">
                                            <div class="span12">
                                                <div class="row-fluid">								
                                                    <label class="form-label span2" for="normal">Nama Lengkap:
                                                        <span class="help-block">Opsi 3 gelar.</span>
                                                    </label>
                                                    <input type="text" class="span2" name="gelar_depan1" id="gelar_depan1" value="<?php echo $row->gelar_depan1;?>" maxlength="6" style="width:50px;" data-provide="typeahead"/>
                                                    <input type="text" class="span2" name="gelar_depan2" id="gelar_depan2" value="<?php echo $row->gelar_depan2;?>" maxlength="6" style="width:50px;" data-provide="typeahead"/>
                                                    <input type="text" class="span2" name="gelar_depan3" id="gelar_depan3" value="<?php echo $row->gelar_depan3;?>" maxlength="6" style="width:50px;" data-provide="typeahead"/>
                                                    <input type="text" class="span6 required" name="nama_lengkap" id="nama_lengkap" value="<?php echo $row->nama_lengkap;?>" maxlength="60"/>
                                                    <input type="text" class="span2" name="gelar_belakang1" id="gelar_belakang1" value="<?php echo $row->gelar_belakang1;?>" maxlength="6" style="width:50px;" data-provide="typeahead"/>
                                                    <input type="text" class="span2" name="gelar_belakang2" id="gelar_belakang2" value="<?php echo $row->gelar_belakang2;?>" maxlength="6" style="width:50px;" data-provide="typeahead"/>
                                                    <input type="text" class="span2" name="gelar_belakang3" id="gelar_belakang3" value="<?php echo $row->gelar_belakang3;?>" maxlength="6" style="width:50px;" data-provide="typeahead"/>
                                                </div>
                                            </div>
                                        </div>

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">
                                                <span class="orange"><label class="form-label span2" for="checkboxes">Propinsi Sekolah :</label></span>
                                                <div class="span4 controls">
                                                    <select name="sek_propinsi_kode" id="sek_propinsi_kode" class="nostyle">
                                                        <option value=""><?php echo lang('SELECT');?></option>
                                                            <?php if ($propinsi):?>
                                                                <?php foreach ($propinsi as $prow):?>
                                                                    <option value="<?php echo $prow->kode;?>" <?php if($prow->kode == $sek_propinsi_kode) echo 'selected="selected"';?>><?php echo $prow->nama_propinsi;?></option>
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
                                                <span class="orange"><label class="form-label span2" for="checkboxes">Kota/Kab Sekolah:</label></span>
                                                <div class="span4 controls">
                                                    <select name="sek_kota_kode" id="sek_kota_kode" class="nostyle">
                                                        <option value=""><?php echo lang('SELECT');?></option>
                                                        <?php if ($kota):?>
                                                            <?php foreach ($kota as $prow):?>
                                                                <option value="<?php echo $prow->kode;?>" <?php if($prow->kode == $sek_kota_kode) echo 'selected="selected"';?>><?php echo $prow->nama_kota;?></option>
                                                            <?php endforeach;?>
                                                            <?php unset($prow);?>
                                                        <?php endif;?>
                                                    </select>						
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                                      
                                    <?php 
                                        if (($sek_propinsi_kode != "") && ($sek_kota_kode != ""))
                                            $sekolah = $content->getSekolahList($sek_propinsi_kode, $sek_kota_kode);
                                        else
                                            $sekolah = null;
                                    ?>

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <span class="orange"><label class="form-label span2" for="checkboxes">Sekolah:</label></span>
                                                <div class="span4 controls">
                                                    <select name="sekolahid" id="sekolahid" class="nostyle" style="width:100%;" placeholder="Select Sekolah...">
                                                        <option value=""><?php echo lang('SELECT');?></option>
                                                        <?php if ($sekolah):?>
                                                            <?php foreach ($sekolah as $prow):?>
                                                                <option value="<?php echo $prow->id;?>" <?php if($prow->id == $row->sekolahid)echo 'selected="selected"';?>><?php echo $prow->nama_sekolah;?></option>
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
                                                    <label class="form-label span2" for="checkboxes">Tempat & Tgl Lahir:</label>
                                                    <input type="text" class="span6" name="tmp_lahir" id="tmp_lahir" value="<?php echo $row->tmp_lahir;?>"/>&nbsp;
                                                    <input type="text" class="span2 datepickerField" name="tgl_lahir" id="tgl_lahir" value="<?php if ($row->tgl_lahir) echo setToStrdate($row->tgl_lahir);?>"/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-row row-fluid">
                                            <div class="span12">
                                                <div class="row-fluid">								
                                                    <label class="form-label span2" for="normal">No. KTP:</label>
                                                    <div class="span4 controls">
                                                        <input type="text" name="no_ktp" id="no_ktp" style="width: 200px;" value="<?php echo $row->no_ktp;?>"/>
                                                    </div>													
                                                    <label class="form-label span2" for="checkboxes">Jenis Kelamin:</label>
                                                    <div class="span2 controls">
                                                        <select name="jns_klmn" id="jns_klmn">
                                                            <?php echo $content->Jenis_KelaminList($row->jns_klmn); ?>
                                                        </select>							
                                                    </div>													
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-row row-fluid">
                                            <div class="span12">
                                                <div class="row-fluid">								
                                                    <label class="form-label span2" for="checkboxes">Agama:</label>
                                                    <div class="span2 controls">
                                                        <select name="agama" id="agama">
                                                            <?php echo $content->AgamaList($row->agama); ?>
                                                        </select>							
                                                    </div>													
                                                    <label class="form-label span2" for="checkboxes">Status Kawin:</label>
                                                    <div class="span2 controls">
                                                        <select name="status_kawin" id="status_kawin">
                                                            <?php echo $content->Status_KawinList($row->status_kawin); ?>
                                                        </select>							
                                                    </div>													
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-row row-fluid">
                                            <div class="span12">
                                                <div class="row-fluid">								
                                                    <label class="form-label span2" for="checkboxes">Pangkat & Golongan:</label>
                                                    <div class="span4 controls">
                                                        <select name="golongan" id="golongan">
                                                            <option value=""><?php echo lang('SELECT');?></option>
                                                            <?php if ($golongan):?>
                                                                <?php foreach ($golongan as $prow):?>
                                                                    <option value="<?php echo $prow->kode;?>" <?php if($prow->kode == $row->golongan)echo 'selected="selected"';?>><?php echo $prow->nama_pangkat . ', ' . $prow->kode;?></option>
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
                                                        <input type="text" name="alamat" id="alamat" value="<?php echo $row->alamat;?>"/>
                                                    </div>
													
                                                    <label class="form-label span2" for="normal">Kode Pos:</label>
                                                    <div class="span2 controls">
                                                        <input type="text" name="kodepos" id="kodepos" value="<?php echo $row->kodepos;?>" maxlength="5" style="width:70px"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-row row-fluid">
                                            <div class="span12">
                                                <div class="row-fluid">								
                                                    <label class="form-label span2" for="checkboxes">Propinsi:</label>
                                                    <div class="span8 controls">
                                                        <select name="propinsi_kode" id="propinsi_kode">
                                                            <option value=""><?php echo lang('SELECT');?></option>
                                                            <?php if ($propinsi):?>
                                                                <?php foreach ($propinsi as $prow):?>
                                                                        <option value="<?php echo $prow->kode;?>"  <?php if($prow->kode == $row->propinsi_kode)echo 'selected="selected"';?>><?php echo $prow->nama_propinsi;?></option>
                                                                <?php endforeach;?>
                                                                <?php unset($prow);?>
                                                            <?php endif;?>
                                                        </select>						
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <?php $kota = $content->getKotaByPropinsiList($row->propinsi_kode);?>

                                        <div class="form-row row-fluid">
                                            <div class="span12">
                                                <div class="row-fluid">								
                                                    <label class="form-label span2" for="checkboxes">Kota/Kabupaten:</label>
                                                    <div class="span8 controls">
                                                        <select name="kota_kode" id="kota_kode">
                                                            <option value=""><?php echo lang('SELECT');?></option>
                                                            <?php if ($kota):?>
                                                                <?php foreach ($kota as $prow):?>
                                                                        <option value="<?php echo $prow->kode;?>" <?php if($prow->kode == $row->kota_kode)echo 'selected="selected"';?>><?php echo $prow->nama_kota;?></option>
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
                                                    <div class="span4 controls">
                                                        <input type="text" name="kelurahan" id="alamat" value="<?php echo $row->kelurahan;?>"/>
                                                    </div>

                                                    <label class="form-label span2" for="normal">Kecamatan:</label>
                                                    <div class="span4 controls">
                                                        <input type="text" name="kecamatan" id="kecamatan" value="<?php echo $row->kecamatan;?>"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-row row-fluid">
                                            <div class="span12">
                                                <div class="row-fluid">								
                                                    <label class="form-label span2" for="normal">Telepon Rumah:</label>
                                                    <div class="span2 controls">
                                                        <input type="text" name="telepon1" id="telepon1" value="<?php echo $row->telepon1;?>"/>
                                                    </div>

                                                    <label class="form-label span2" for="normal">Handphone:</label>
                                                    <div class="span2 controls">
                                                        <input type="text" name="telepon2" id="telepon2" value="<?php echo $row->telepon2;?>"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-row row-fluid">
                                            <div class="span12">
                                                <div class="row-fluid">								
                                                    <label class="form-label span2" for="normal">E-Mail:</label>
                                                    <input type="text" class="span8" name="email" id="email" value="<?php echo $row->email;?>"/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-row row-fluid">
                                            <div class="span12">
                                                <div class="row-fluid">								
                                                    <label class="form-label span2" for="normal">Web Site:</label>
                                                    <input type="text" class="span8" name="website" id="website" value="<?php echo $row->website;?>"/>
                                                </div>
                                            </div>
                                        </div>
                                                                                
                                        <div class="form-row row-fluid">
                                            <div class="span12">
                                                <div class="row-fluid">								
                                                    <label class="form-label span2" for="checkboxes">Status Kepegawaian:</label>
                                                    <div class="span2 controls">
                                                        <select name="statuskepegawaian" id="statuskepegawaian">
                                                            <option value=""><?php echo lang('SELECT');?></option>
                                                            <?php echo $content->StatusKepegawaianList($row->statuskepegawaian); ?>
                                                        </select>							
                                                    </div>
													
                                                    <label class="form-label span4" for="checkboxes">Jenis Kepegawaian:</label>
                                                    <div class="span2 controls">
                                                        <select name="jeniskepegawaian" id="jeniskepegawaian">
                                                            <option value=""><?php echo lang('SELECT');?></option>
                                                            <?php echo $content->JenisKepegawaianList($row->jeniskepegawaian); ?>
                                                        </select>							
                                                    </div>													
                                                </div>
                                            </div>
                                        </div>
                                                                                                                        
                                        <div class="form-row row-fluid">
                                            <div class="span12">
                                                <div class="row-fluid">								
                                                    <label class="form-label span2" for="checkboxes">Tugas Pokok:</label>
                                                    <div class="span4 controls">
                                                        <select name="tugaspokok" id="tugaspokok">
                                                            <option value=""><?php echo lang('SELECT');?></option>
                                                            <?php echo $content->TugasPokokList($row->tugaspokok); ?>
                                                        </select>							
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-row row-fluid">
                                            <div class="span12">
                                                <div class="row-fluid">								
                                                    <label class="form-label span2" for="checkboxes">Status Guru:</label>
                                                    <div class="span2 controls">
                                                        <select name="status_guru" id="status_guru">
                                                            <option value=""><?php echo lang('SELECT');?></option>
                                                            <?php echo $content->Status_GuruList($row->status_guru); ?>
                                                        </select>							
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-row row-fluid">
                                            <div class="span12">
                                                <div class="row-fluid">								
                                                    <label class="form-label span2" for="checkboxes">Jabatan Pokok:</label>
                                                    <div class="span4 controls">
                                                        <select name="jabatanpokok" id="jabatanpokok" <?php if ($row->tugaspokok != "Tenaga Kependidikan Formal") echo 'Disabled="disabled"'; ?>>
                                                            <option value=""><?php echo lang('SELECT');?></option>
                                                            <?php echo $content->JabatanPokokList($row->jabatanpokok); ?>
                                                        </select>							
                                                    </div>
                                                </div>
                                            </div>
                                        </div>                                        
                                                                                
                                        <div class="form-row row-fluid">
                                            <div class="span12">
                                                <div class="row-fluid">								
                                                    <span class="green"><label class="form-label span2" for="checkboxes">Tingkat Pendidikan Terakhir:</label></span>
                                                    <div class="span4 controls">
                                                        <select name="ijazah_akhir" id="ijazah_akhir">
                                                            <option value=""><?php echo lang('SELECT');?></option>
                                                            <?php echo $content->Sekolah_IjazahList($row->ijazah_akhir); ?>
                                                        </select>							
                                                    </div>
                                                    
                                                    <span class="green"><label class="form-label span2" for="normal">Tahun Lulus:</label></span>
                                                    <input type="text" class="span2" name="tahun_lulus_akhir" id="tahun_lulus_akhir" maxlength="4" style="width: 60px;" value="<?php echo $row->tahun_lulus_akhir;?>"/>                                                    
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="form-row row-fluid">
                                            <div class="span12">
                                                <div class="row-fluid">								
                                                    <span class="green"><label class="form-label span2" for="normal">Jurusan:</label></span>
                                                    <input type="text" class="span8" name="jurusan_akhir" id="jurusan_akhir" value="<?php echo $row->jurusan_akhir;?>"/>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="form-row row-fluid">
                                            <div class="span12">
                                                <div class="row-fluid">								
                                                    <span class="green"><label class="form-label span2" for="normal">Institusi/Universitas Terakhir:</label></span>
                                                    <input type="text" class="span8" name="pendidikan_akhir" id="pendidikan_akhir" value="<?php echo $row->pendidikan_akhir;?>"/>
                                                </div>
                                            </div>
                                        </div>                                        
                                        
                                        <div class="form-row row-fluid">
                                            <div class="span12">
                                                <div class="row-fluid">								
                                                    <label class="form-label span2" for="tmt_pns">TMT PNS:</label>
                                                    <div class="span2 controls">
                                                        <input type="text" class="datepickerField" name="tmt_pns" id="tmt_pns" value="<?php if($row->tmt_pns) echo setToStrdate($row->tmt_pns);?>"/>
                                                    </div>
                                                    <label class="form-label span4" for="tmt_pendidik">TMT Pendidik:</label>
                                                    <div class="span2 controls">
                                                        <input type="text" class="datepickerField" name="tmt_pendidik" id="tmt_pendidik" value="<?php if ($row->tmt_pendidik) echo setToStrdate($row->tmt_pendidik);?>"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-row row-fluid">
                                            <div class="span12">
                                                <div class="row-fluid">								
                                                    <label class="form-label span2" for="normal">TMT Sekolah:</label>
                                                    <div class="span2 controls">
                                                        <input type="text" class="datepickerField" name="tmt_sekolah" id="tmt_sekolah" value="<?php if ($row->tmt_sekolah) echo setToStrdate($row->tmt_sekolah);?>"/>
                                                    </div>
                                                    <label class="form-label span4" for="normal">TMT Kepala Sekolah:</label>
                                                    <div class="span2 controls">
                                                        <input type="text" class="datepickerField" name="tmt_kepalasekolah" id="tmt_kepalasekolah" value="<?php if ($row->tmt_kepalasekolah) echo setToStrdate($row->tmt_kepalasekolah);?>"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="form-row row-fluid">
                                            <div class="span12">
                                                <div class="row-fluid">								
                                                    <label class="form-label span2" for="checkboxes">Sertifikasi Profesi Guru:</label>
                                                    <div class="span2 controls">
                                                        <select name="sertifikasi_guru" id="sertifikasi_guru">
                                                            <option value=""><?php echo lang('SELECT');?></option>
                                                            <?php echo $content->Sertifikasi_GuruList($row->sertifikasi_guru); ?>
                                                        </select>							
                                                    </div>
													
                                                    <label class="form-label span4" for="checkboxes">Akta Mengajar:</label>
                                                    <div class="span2 controls">
                                                        <select name="akta_mengajar" id="akta_mengajar">
                                                            <option value=""><?php echo lang('SELECT');?></option>
                                                            <option value="Y" <?php if ($row->akta_mengajar && $row->akta_mengajar == 'Y') echo 'selected="selected"'; ?>>Ya</option>
                                                            <option value="T" <?php if ($row->akta_mengajar && $row->akta_mengajar == 'T') echo 'selected="selected"'; ?>>Tidak</option>
                                                        </select>							
                                                    </div>													
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-row row-fluid">
                                            <div class="span12">
                                                <div class="row-fluid">								
                                                    <label class="form-label span2" for="checkboxes">Status UKA:</label>
                                                    <div class="span2 controls">
                                                        <select name="UKA_status" id="UKA_status">
                                                            <option value=""><?php echo lang('SELECT');?></option>
                                                            <option value="Lulus" <?php if ($row->UKA_status && $row->UKA_status == 'Lulus') echo 'selected="selected"'; ?>>Lulus</option>
                                                            <option value="Tdk Lulus" <?php if ($row->UKA_status && $row->UKA_status == 'Tdk Lulus') echo 'selected="selected"'; ?>>Tidak Lulus</option>
                                                        </select>							
                                                    </div>
                                                    <label class="form-label span4" for="UKA_tahun">Tahun Lulus:</label>
                                                    <div class="span2 controls">
                                                        <input type="text" name="UKA_tahun" id="UKA_tahun" maxlength="4" style="width: 60px;" value="<?php echo $row->UKA_tahun;?>"/>
                                                    </div>    
                                                </div>
                                            </div>
                                        </div>                                        

                                        <div class="form-row row-fluid">
                                            <div class="span12">
                                                <div class="row-fluid">								
                                                    <label class="form-label span2" for="checkboxes">Status UKG:</label>
                                                    <div class="span2 controls">
                                                        <select name="UKG_status" id="UKG_status">
                                                            <option value=""><?php echo lang('SELECT');?></option>
                                                            <option value="Lulus" <?php if ($row->UKG_status && $row->UKG_status == 'Lulus') echo 'selected="selected"'; ?>>Lulus</option>
                                                            <option value="Tdk Lulus" <?php if ($row->UKG_status && $row->UKG_status == 'Tdk Lulus') echo 'selected="selected"'; ?>>Tidak Lulus</option>
                                                        </select>							
                                                    </div>
                                                    <label class="form-label span4" for="UKG_tahun">Tahun Lulus:</label>
                                                    <div class="span2 controls">
                                                        <input type="text" name="UKG_tahun" id="UKG_tahun" maxlength="4" style="width: 60px;" value="<?php echo $row->UKG_tahun;?>"/>
                                                    </div>    
                                                </div>
                                            </div>
                                        </div>                                        
                                                                                
                                        <div class="form-row row-fluid">
                                            <div class="span12">
                                                <div class="row-fluid">								
                                                    <label class="form-label span2" for="normal">Last Update:</label>
                                                    <div class="span2 controls">
                                                        <input type="text" name="last_update" id="last_update" value="<?php echo setToStrdatetime($row->last_update);?>" disabled="disabled"/>
                                                    </div>

                                                    <label class="form-label span2" for="normal">Tgl Entry :</label>
                                                    <div class="span2 controls">
                                                        <input type="text" name="created" id="created" value="<?php echo setToStrdatetime($row->created);?>" disabled="disabled"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-actions">
                                            <button type="submit" class="btn btn-info">Save</button>
                                            <button type="button" class="btn" onclick="history.back()">Kembali</button>
                                        </div>

                                        <input name="id" type="hidden" value="<?php echo Filter::$id;?>" />
                                        <input name="status" type="hidden" value="<?php echo $row->status;?>" />
                                        <input name="userid" type="hidden" value="<?php echo $row->userid;?>" />

                                    </fieldset>
                                    </form>       

                                </div>

                                <div class="tab-pane fade" id="tab2">

                                    <div class="row-fluid">
                                        <div class="span12">

                                            <?php $minatrows = $content->getPTK_DiklatMinat($row->id);?>

                                            <div id="ptk_diklatminat">
                                            <table class="responsive table table-striped table-bordered">

                                                <thead>
                                                    <tr>
                                                        <th width="30">Kode</th>
                                                        <th>Nama Diklat</th>
                                                        <th width="40">Tahun Ajuan</th>
                                                        <th>Nama Departemen</th>
                                                        <th>Deskripsi</th>
                                                        <th width="40"><button type="button" class="btn" id="btnMinatadd" data-toggle="modal"><span class="icon16 icomoon-icon-plus-2"></span>Tambah</button></th>
                                                    </tr>
                                                </thead>

                                                <tbody>

                                                <?php if(!$minatrows):?>
                                                    <tr>
                                                        <td colspan="6"><?php echo Filter::msgInfo(lang('NO_DATA'), false);?></td>
                                                    </tr>

                                                <?php else:?>
                                                <?php foreach ($minatrows as $minatrow):?>

                                                    <tr>
                                                        <td><?php echo $minatrow->kode;?></td>
                                                        <td style="text-align: left;"><?php echo $minatrow->nama_diklat;?></td>
                                                        <td><?php echo $minatrow->tahun;?></td>
                                                        <td style="text-align: left;"><?php echo $minatrow->nama_departemen;?></td>
                                                        <td style="text-align: left;"><?php echo $minatrow->deskripsi;?></td>
                                                        <td align="center">
                                                            <a href="javascript:void(0)" title="Edit" class="tip doEditdiklatminat" data-tname="ptk_diklatminat" data-id="<?php echo $minatrow->id;?>" data-toggle="modal"><span class="icon12 icomoon-icon-pencil"></span></a>
                                                            <a href="javascript:void(0)" title="Hapus" class="tip doDelete" data-tname="ptk_diklatminat" data-id="<?php echo $minatrow->id;?>" data-toggle="modal"><span class="icon12 icomoon-icon-remove"></span></a>
                                                        </td>
                                                    </tr>

                                                <?php endforeach;?>
                                                <?php unset($minatrow);?>
                                                <?php endif;?>					

                                                </tbody>

                                            </table>
                                            </div>

                                        </div><!-- End .span12 -->
                                    </div><!-- End .row-fluid -->

                                </div>

                                <div class="tab-pane fade" id="tab3">

                                    <div class="row-fluid">
                                        <div class="span12">

                                            <div class="box gradient">                                                
                                                <div class="title">
                                                    <h4>
                                                        <span>Di Sekolah Induk</span>
                                                    </h4>
                                                    <a href="#" class="minimize">Minimize</a>
                                                </div>
                                                <div class="content" id="ptk_mmds">

                                                    <?php $mmdsrows = $content->getPTK_MMDS($row->id);?>

                                                    <table class="responsive table table-striped table-bordered">

                                                        <thead>
                                                            <tr>
                                                                <th width="60">Kelompok</th>
                                                                <th>Paket Keahlian (KK)</th>
                                                                <th>Mata Pelajaran</th>
                                                                <th width="30">Kelas</th>
                                                                <th width="70">Tahun</th>
                                                                <th width="40"><button type="button" class="btn" id="btnMMDSadd" data-toggle="modal"><span class="icon16 icomoon-icon-plus-2"></span>Tambah</button></th>
                                                            </tr>
                                                        </thead>

                                                        <tbody>

                                                        <?php if(!$mmdsrows):?>
                                                            <tr>
                                                                <td colspan="6"><?php echo Filter::msgInfo(lang('NO_DATA'), false);?></td>
                                                            </tr>

                                                        <?php else:?>
                                                        <?php foreach ($mmdsrows as $mmdsrow):?>

                                                                <tr>
                                                                    <td align="center"><?php echo $mmdsrow->kel_matapelajaran;?></td>
                                                                    <td style="text-align: left;"><?php echo $mmdsrow->nama_kompetensi;?></td>
                                                                    <td style="text-align: left;"><?php echo $mmdsrow->nama_matapelajaran;?></td>
                                                                    <td><?php echo $mmdsrow->kelas;?></td>
                                                                    <td><?php echo $mmdsrow->tahun_mulai . ' - ' . $mmdsrow->tahun_akhir;?></td>
                                                                    <td align="center">
                                                                        <a href="javascript:void(0)" title="Edit" class="tip doEditmmds" data-tname="ptk_mmds" data-id="<?php echo $mmdsrow->id;?>" data-toggle="modal"><span class="icon12 icomoon-icon-pencil"></span></a>
                                                                        <a href="javascript:void(0)" title="Hapus" class="tip doDelete" data-tname="ptk_mmds" data-id="<?php echo $mmdsrow->id;?>" data-toggle="modal"><span class="icon12 icomoon-icon-remove"></span></a>
                                                                    </td>
                                                                </tr>

                                                        <?php endforeach;?>
                                                        <?php unset($mmdsrow);?>
                                                        <?php endif;?>					

                                                        </tbody>

                                                    </table>

                                                </div>
                                            </div><!-- End .box -->  

                                        </div><!-- End .span12 -->
                                    </div><!-- End .row-fluid -->

                                    <div class="row-fluid">
                                        <div class="span12">

                                            <div class="box gradient">                                                
                                                <div class="title">

                                                    <h4>
                                                        <span>Di Sekolah Lain</span>
                                                    </h4>
                                                    <a href="#" class="minimize">Minimize</a>
                                                </div>
                                                <div class="content" id="ptk_mmdl">

                                                    <?php $mmdlrows = $content->getPTK_MMDL($row->id);?>

                                                    <table class="responsive table table-striped table-bordered">

                                                        <thead>
                                                            <tr>
                                                                <th width="60">Kelompok</th>
                                                                <th>Paket Keahlian</th>
                                                                <th>Lembaga</th>
                                                                <th>Mata Pelajaran</th>
                                                                <th width="30">Kelas</th>
                                                                <th width="70">Tahun</th>
                                                                <th width="40"><button type="button" class="btn" id="btnMMDLadd" data-toggle="modal"><span class="icon16 icomoon-icon-plus-2"></span>Tambah</button></th>
                                                            </tr>
                                                        </thead>

                                                        <tbody>

                                                        <?php if(!$mmdlrows):?>
                                                            <tr>
                                                                <td colspan="7"><?php echo Filter::msgInfo(lang('NO_DATA'), false);?></td>
                                                            </tr>

                                                        <?php else:?>
                                                        <?php foreach ($mmdlrows as $mmdlrow):?>

                                                            <tr>
                                                                <td align="center"><?php echo $mmdlrow->kel_matapelajaran;?></td>
                                                                <td style="text-align: left;"><?php echo $mmdlrow->nama_kompetensi;?></td>
                                                                <td style="text-align: left;"><?php echo $mmdlrow->nama_lembaga;?></td>
                                                                <td style="text-align: left;"><?php echo $mmdlrow->nama_matapelajaran;?></td>
                                                                <td><?php echo $mmdlrow->kelas;?></td>
                                                                <td><?php echo $mmdlrow->tahun_mulai . ' - ' . $mmdlrow->tahun_akhir;?></td>
                                                                <td align="center">
                                                                    <a href="javascript:void(0)" title="Edit" class="tip doEditmmdl" data-tname="ptk_mmdl" data-id="<?php echo $mmdlrow->id;?>" data-toggle="modal"><span class="icon12 icomoon-icon-pencil"></span></a>
                                                                    <a href="javascript:void(0)" title="Hapus" class="tip doDelete" data-tname="ptk_mmdl" data-id="<?php echo $mmdlrow->id;?>" data-toggle="modal"><span class="icon12 icomoon-icon-remove"></span></a>
                                                                </td>
                                                            </tr>

                                                        <?php endforeach;?>
                                                        <?php unset($mmdlrow);?>
                                                        <?php endif;?>					

                                                        </tbody>

                                                    </table>

                                                </div>
                                            </div><!-- End .box -->  

                                        </div><!-- End .span12 -->
                                    </div><!-- End .row-fluid -->

                                </div>
                                
                                                                                                
                                <div class="tab-pane fade" id="tab4">
                                    <div class="row-fluid">
                                        <div class="span12">

                                            <?php $rpprows = $content->getPTK_RPP($row->id);?>
                                            
                                            <div id="ptk_rpp">
                                            <table class="responsive table table-striped table-bordered">

                                                <thead>
                                                    <tr>
                                                        <th>Nama Diklat</th>
                                                        <th width="50">Peran</th>
                                                        <th width="40">Tahun</th>
                                                        <th width="40">Pola/Jam</th>
                                                        <th>Penyelenggara</th>
                                                        <th width="40">Tingkat</th>
                                                        <th>Kompetensi</th>
                                                        <th width="40"><button type="button" class="btn" id="btnRPPadd" data-toggle="modal"><span class="icon16 icomoon-icon-plus-2"></span>Tambah</button></th>
                                                    </tr>
                                                </thead>

                                                <tbody>

                                                <?php if(!$rpprows):?>
                                                    <tr>
                                                        <td colspan="8"><?php echo Filter::msgInfo(lang('NO_DATA'), false);?></td>
                                                    </tr>

                                                <?php else:?>
                                                <?php foreach ($rpprows as $rpprow):?>

                                                    <tr>
                                                        <td style="text-align: left;"><?php echo $rpprow->nama_diklat;?></td>
                                                        <td style="text-align: left;"><?php echo $rpprow->peran;?></td>
                                                        <td><?php echo $rpprow->tahun;?></td>
                                                        <td><?php echo $rpprow->jml_jam;?></td>
                                                        <td style="text-align: left;"><?php echo $rpprow->penyelenggara;?></td>
                                                        <td><?php echo $rpprow->tingkat;?></td>
                                                        <td style="text-align: left;"><?php echo $rpprow->kompetensi;?></td>
                                                        <td align="center">
                                                            <a href="javascript:void(0)" title="Edit" class="tip doEditrpp" data-tname="ptk_rpp" data-id="<?php echo $rpprow->id;?>" data-toggle="modal"><span class="icon12 icomoon-icon-pencil"></span></a>
                                                            <a href="javascript:void(0)" title="Hapus" class="tip doDelete" data-tname="ptk_rpp" data-id="<?php echo $rpprow->id;?>" data-toggle="modal"><span class="icon12 icomoon-icon-remove"></span></a>
                                                        </td>
                                                    </tr>

                                                <?php endforeach;?>
                                                <?php unset($rpprow);?>
                                                <?php endif;?>					

                                                </tbody>

                                            </table>
                                            </div>

                                        </div><!-- End .span12 -->
                                    </div><!-- End .row-fluid -->
                                    
                                </div>

                                <div class="tab-pane fade" id="tab5">

                                    <div class="row-fluid">
                                        <div class="span12">

                                            <div class="box gradient">
                                                <div class="title">
                                                    <h4>
                                                        <span>Formal</span>
                                                    </h4>
                                                    <a href="#" class="minimize">Minimize</a>
                                                </div>
                                                <div class="content" id="ptk_rpf">

                                                    <?php $rpfrows = $content->getPTK_RPF($row->id);?>

                                                    <table class="responsive table table-striped table-bordered">

                                                        <thead>
                                                            <tr>
                                                                <th>Sekolah</th>
                                                                <th>Lokasi</th>
                                                                <th>Fakultas</th>
                                                                <th>Jurusan</th>
                                                                <th width="30">Status</th>
                                                                <th width="70">Tingkat Pendidikan</th>
                                                                <th width="30">Tahun Lulus</th>
                                                                <th width="40"><button type="button" class="btn" id="btnRPFadd" data-toggle="modal"><span class="icon16 icomoon-icon-plus-2"></span>Tambah</button></th>
                                                            </tr>
                                                        </thead>

                                                        <tbody>

                                                        <?php if(!$rpfrows):?>
                                                            <tr>
                                                                <td colspan=8"><?php echo Filter::msgInfo(lang('NO_DATA'), false);?></td>
                                                            </tr>

                                                        <?php else:?>
                                                        <?php foreach ($rpfrows as $rpfrow):?>

                                                                <tr>
                                                                    <td style="text-align: left;"><?php echo $rpfrow->nama_sekolah;?></td>
                                                                    <td style="text-align: left;"><?php echo $rpfrow->lokasi;?></td>
                                                                    <td style="text-align: left;"><?php echo $rpfrow->fakultas;?></td>
                                                                    <td style="text-align: left;"><?php echo $rpfrow->jurusan;?></td>
                                                                    <td><?php echo $rpfrow->status;?></td>
                                                                    <td><?php echo $rpfrow->tingkat_pendidikan;?></td>
                                                                    <td><?php echo $rpfrow->tahun_lulus;?></td>
                                                                    <td align="center">
                                                                        <a href="javascript:void(0)" title="Edit" class="tip doEditrpf" data-tname="ptk_rpf" data-id="<?php echo $rpfrow->id;?>" data-toggle="modal"><span class="icon12 icomoon-icon-pencil"></span></a>
                                                                        <a href="javascript:void(0)" title="Hapus" class="tip doDelete" data-tname="ptk_rpf" data-id="<?php echo $rpfrow->id;?>" data-toggle="modal"><span class="icon12 icomoon-icon-remove"></span></a>
                                                                    </td>
                                                                </tr>

                                                        <?php endforeach;?>
                                                        <?php unset($rpfrow);?>
                                                        <?php endif;?>					

                                                        </tbody>

                                                    </table>

                                                </div>
                                            </div><!-- End .box -->  

                                        </div><!-- End .span12 -->
                                    </div><!-- End .row-fluid -->

                                    <div class="row-fluid">
                                        <div class="span12">

                                            <div class="box gradient">
                                                <div class="title">
                                                    <h4>
                                                        <span>Non-Formal</span>
                                                    </h4>
                                                    <a href="#" class="minimize">Minimize</a>
                                                </div>
                                                <div class="content" id="ptk_rpnf">

                                                    <?php $rpnfrows = $content->getPTK_RPNF($row->id);?>

                                                    <table class="responsive table table-striped table-bordered">

                                                        <thead>
                                                            <tr>
                                                                <th>Instansi</th>
                                                                <th>Lokasi</th>
                                                                <th>Bidang Studi</th>
                                                                <th>Tingkat</th>
                                                                <th width="30">Pola/Jam</th>
                                                                <th width="40">Tahun Lulus</th>
                                                                <th width="40"><button type="button" class="btn" id="btnRPNFadd" data-toggle="modal"><span class="icon16 icomoon-icon-plus-2"></span>Tambah</button></th>
                                                            </tr>
                                                        </thead>

                                                        <tbody>

                                                        <?php if(!$rpnfrows):?>
                                                            <tr>
                                                                <td colspan="7"><?php echo Filter::msgInfo(lang('NO_DATA'), false);?></td>
                                                            </tr>

                                                        <?php else:?>
                                                        <?php foreach ($rpnfrows as $rpnfrow):?>

                                                            <tr>
                                                                <td style="text-align: left;"><?php echo $rpnfrow->nama_instansi;?></td>
                                                                <td style="text-align: left;"><?php echo $rpnfrow->lokasi;?></td>
                                                                <td style="text-align: left;"><?php echo $rpnfrow->bidang_studi;?></td>
                                                                <td><?php echo $rpnfrow->tingkat;?></td>
                                                                <td><?php echo $rpnfrow->jml_jam;?></td>
                                                                <td><?php echo $rpnfrow->tahun_lulus;?></td>
                                                                <td align="center">
                                                                    <a href="javascript:void(0)" title="Edit" class="tip doEditrpnf" data-tname="ptk_rpnf" data-id="<?php echo $rpnfrow->id;?>" data-toggle="modal"><span class="icon12 icomoon-icon-pencil"></span></a>
                                                                    <a href="javascript:void(0)" title="Hapus" class="tip doDelete" data-tname="ptk_rpnf" data-id="<?php echo $rpnfrow->id;?>" data-toggle="modal"><span class="icon12 icomoon-icon-remove"></span></a>
                                                                </td>
                                                            </tr>

                                                        <?php endforeach;?>
                                                        <?php unset($rpnfrow);?>
                                                        <?php endif;?>					

                                                        </tbody>

                                                    </table>

                                                </div>

                                            </div><!-- End .box -->  

                                        </div><!-- End .span12 -->
                                    </div><!-- End .row-fluid -->
                                    
                                </div>

                                <div class="tab-pane fade" id="tab6">

                                    <div class="row-fluid">
                                        <div class="span12">

                                            <?php $rsertifikatrows = $content->getPTK_RSertifikat($row->id);?>
                                            <div id="ptk_rsertifikat">
                                            <table class="responsive table table-striped table-bordered">

                                                <thead>
                                                    <tr>
                                                        <th>Nama Test</th>
                                                        <th>Penyelenggara</th>
                                                        <th width="40">Tahun</th>
                                                        <th width="40">Status</th>
                                                        <th width="40"><button type="button" class="btn" id="btnRSertifikatadd" data-toggle="modal"><span class="icon16 icomoon-icon-plus-2"></span>Tambah</button></th>
                                                    </tr>
                                                </thead>

                                                <tbody>

                                                <?php if(!$rsertifikatrows):?>
                                                    <tr>
                                                        <td colspan="5"><?php echo Filter::msgInfo(lang('NO_DATA'), false);?></td>
                                                    </tr>

                                                <?php else:?>
                                                <?php foreach ($rsertifikatrows as $rsertifikatrow):?>

                                                    <tr>
                                                        <td style="text-align: left;"><?php echo $rsertifikatrow->nama_sertifikat;?></td>
                                                        <td style="text-align: left;"><?php echo $rsertifikatrow->pelaksana;?></td>
                                                        <td><?php echo $rsertifikatrow->tahun;?></td>
                                                        <td><?php echo $rsertifikatrow->status;?></td>
                                                        <td align="center">
                                                            <a href="javascript:void(0)" title="Edit" class="tip doEditrsertifikat" data-tname="ptk_rsertifikat" data-id="<?php echo $rsertifikatrow->id;?>" data-toggle="modal"><span class="icon12 icomoon-icon-pencil"></span></a>
                                                            <a href="javascript:void(0)" title="Hapus" class="tip doDelete" data-tname="ptk_rsertifikat" data-id="<?php echo $rsertifikatrow->id;?>" data-toggle="modal"><span class="icon12 icomoon-icon-remove"></span></a>
                                                        </td>
                                                    </tr>

                                                <?php endforeach;?>
                                                <?php unset($rsertifikatrow);?>
                                                <?php endif;?>					

                                                </tbody>

                                            </table>
                                            </div>
                                            
                                        </div><!-- End .span12 -->
                                    </div><!-- End .row-fluid -->
                                    
                                </div>

                            </div>
                        </div> <!-- end tab -->

                </div><!-- End .span12 -->
            </div><!-- End .row-fluid -->  

            <!-- modal : del item  -->
            
            <div id="delModal" class="modal fade hide" style="display: none;">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span class="icon12 minia-icon-close"></span></button>
                    <h3>Konfirmasi</h3>
                </div>
                <div class="modal-body">					
                    <p>Yakin untuk hapus data berikut ?</p>
                </div>
                <div class="modal-footer">
                    <a href="#" id="delConfirmBtn" class="btn btn-danger"><?php echo lang('DELETE'); ?></a>
                    <a href="#" class="btn" data-dismiss="modal"><?php echo lang('CANCEL'); ?></a>
                </div>
            </div>
                        
        <?php include ("ptk_diklatminat.php"); ?>
        <?php include ("ptk_mmds.php"); ?>
        <?php include ("ptk_mmdl.php"); ?>
        <?php include ("ptk_rpp.php"); ?>
        <?php include ("ptk_rpf.php"); ?>
        <?php include ("ptk_rpnf.php"); ?>
        <?php include ("ptk_rsertifikat.php"); ?>
                            
    <script type="text/javascript">

        $(document).ready(function(){

            $("#nama_lengkap").focus();

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

            $("#sek_propinsi_kode").change(function(){
                    var kode = $("#sek_propinsi_kode").val();

                    $.ajax({
                            type: 'post',
                            url: "controller.php",
                            data: "loadKotaList=" + kode,
                            cache: false,
                            success: function(html){
                                    $("#sek_kota_kode").html(html); 
                            }
                    });

                    $("#sek_kota_kode").val("");

            });

            $("#sek_kota_kode").change(function(){
                    var propinsi_kode = $("#sek_propinsi_kode").val();
                    var kota_kode = $("#sek_kota_kode").val();

                    $.ajax({
                            type: 'post',
                            url: "controller.php",
                            data: "loadSekolahList=" + propinsi_kode + "&kota=" + kota_kode,
                            cache: false,
                            success: function(html){ 
                                    $("#sekolahid").html(html); 
                            }
                    });

                    $("#sekolahid").val("");

            });

            $('#tugaspokok').change(function () {
                var value = $("#tugaspokok option:selected").val();

                ((value == "Tenaga Kependidikan Formal") || (value == "Pendidik dan Tenaga Kependidikan Formal")) ? $('#jabatanpokok').removeAttr("disabled") : $('#jabatanpokok').attr('disabled','disabled');

                $.uniform.update("#jabatanpokok");

            })                                                  

            // -- del data --

            $('#delModal').on('show', function() {

                    var id = $(this).data('id'),
                        tname = $(this).data('tname'),
                        parent = $(this).data('parent');

                    $('#delModal a#delConfirmBtn').on('click', function(e) {

                            $('#delModal').modal('hide'); // dismiss the dialog

                            $.ajax({
                                      type: 'post',
                                      url: 'controller_ptk.php',
                                      data: 'deletePTKdetail=' + tname + '&id=' + id,
                                      success: function (msg) {                                          
                                            parent.fadeOut(400, function () {
                                                    parent.remove();
                                            });
                                            $('html, body').animate({scrollTop:0}, 600);
                                            $('#msgholder').html(msg);
                                      }
                            });

                    });		

            })

            $('#delModal').on('hide', function() {

                    $('#delModal a#delConfirmBtn').off('click');

            });

            $('.tip.doDelete').live('click', function(e) {
                    e.preventDefault();

                    var tname = $(this).data('tname');
                    var id = $(this).data('id');
                    var parent = $(this).parent().parent();

                    $('#delModal').data({
                            'tname': tname,
                            'id': id,
                            'parent': parent
                    });

                    $('#delModal').modal('show');

            });

            var gelar = ['Drs', 'Dr', 'MSi', 'SPd', 'M.Pd', 'S.Ag', 'Ir', 'SE', 'S.Kom', 'S.Pd.Ekop', 'Dra', 'S.Sos'];   
            $('#gelar_depan1').typeahead({source: gelar});
            $('#gelar_depan2').typeahead({source: gelar});
            $('#gelar_depan3').typeahead({source: gelar});
            
            $('#gelar_belakang1').typeahead({source: gelar});
            $('#gelar_belakang2').typeahead({source: gelar});
            $('#gelar_belakang3').typeahead({source: gelar});            

        });

    </script>		
				
<?php echo Core::doForm("processUpdatePTK"); ?>

        