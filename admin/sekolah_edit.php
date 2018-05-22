                            <div id="msgholder"></div>
                            
                            <div class="page-header">
                                <h4>Edit Data Sekolah</h4>
                            </div>
                            
                            <div style="margin-bottom: 20px;">
                                <ul id="myTab" class="nav nav-tabs pattern">
                                    <li class="active"><a href="#tab1" data-toggle="tab">Profil Umum</a></li>
                                    <li><a href="#tab2" data-toggle="tab">Khusus SMK</a></li>
                                    <li><a href="#tab3" data-toggle="tab">Rekapitulasi</a></li>
                                    <li><a href="#tab4" data-toggle="tab">Pendidik/Guru per Mata Diklat</a></li>
                                    <li><a href="#tab5" data-toggle="tab">Siswa dan Fasilitas</a></li>
                                </ul>

                                <div class="tab-content">
                                    <div class="tab-pane fade in active" id="tab1">
                                        
                                        <?php 
                                            $row = Core::getRowById("sekolah", Filter::$id);

                                            $jenis = $content->getSekolah_Jenis();
                                            $propinsi = $content->getPropinsiList();                                            
                                        ?>

                                        <form id="admin_form" class="form-horizontal" method="post" action="">			
                                        <fieldset>
                                            <div class="form-row row-fluid">
                                                <div class="span12">
                                                    <div class="row-fluid">								
                                                        <label class="form-label span4" for="normal">NSS:</label>
                                                        <input type="text" class="span2 required" name="nss" id="nss" value="<?php echo $row->nss;?>" maxlength="13"/>
                                                        <span class="help-inline blue">: 12-13 digit numerik</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-row row-fluid">
                                                <div class="span12">
                                                    <div class="row-fluid">								
                                                        <label class="form-label span4" for="normal">NPSN:</label>
                                                        <input type="text" class="span2 required" name="npsn" id="npsn" value="<?php echo $row->npsn;?>" maxlength="8"/>
                                                        <span class="help-inline blue">: 8 digit numerik</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-row row-fluid">
                                                <div class="span12">
                                                    <div class="row-fluid">								
                                                        <label class="form-label span4" for="normal">Nama Sekolah:</label>
                                                        <input type="text" class="span8 required" name="nama_sekolah" id="nama_sekolah" value="<?php echo $row->nama_sekolah;?>"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-row row-fluid">
                                                <div class="span12">
                                                    <div class="row-fluid">								
                                                        <label class="form-label span4" for="checkboxes">Jenis:</label>
                                                        <div class="span4 controls">
                                                            <select name="jenisid" id="jenisid">
                                                                <option value=""><?php echo lang('SELECT');?></option>
                                                                <?php if ($jenis):?>
                                                                    <?php foreach ($jenis as $prow):?>
                                                                            <option value="<?php echo $prow->id;?>" <?php if($prow->id == $row->jenisid)echo 'selected="selected"';?>><?php echo $prow->nama_jenis;?></option>
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
                                                        <label class="form-label span4" for="normal">Nama Pimpinan:</label>
                                                        <input type="text" class="span8" name="nama_pimpinan" id="nama_pimpinan" value="<?php echo $row->nama_pimpinan;?>"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-row row-fluid">
                                                <div class="span12">
                                                    <div class="row-fluid">								
                                                        <label class="form-label span4" for="normal">NIP & NUPTK Pimpinan:</label>
                                                        <input type="text" class="span2" name="nip_pimpinan" id="nip_pimpinan" value="<?php echo $row->nip_pimpinan;?>" maxlength="18"/>
                                                        <input type="text" class="span2" name="nuptk_pimpinan" id="nuptk_pimpinan" value="<?php echo $row->nuptk_pimpinan;?>" maxlength="16"/>
                                                        <span class="help-inline blue">: 16 utk NUPTK & 18 utk NIP digit numerik</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-row row-fluid">
                                                <div class="span12">
                                                    <div class="row-fluid">								
                                                        <label class="form-label span4" for="normal">No. Telp Pimpinan:</label>
                                                        <input type="text" class="span2" name="telp_pimpinan" id="telp_pimpinan" value="<?php echo $row->telp_pimpinan;?>"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-row row-fluid">
                                                <div class="span12">
                                                    <div class="row-fluid">								
                                                        <label class="form-label span4" for="checkboxes">Status Kepemilikan:</label>
                                                        <div class="span4 controls">
                                                            <select name="statusmilik" id="statusmilik">
                                                                <?php echo $content->SekolahStatus_MilikList($row->statusmilik); ?>
                                                            </select>							
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="form-row row-fluid">
                                                <div class="span12">
                                                    <div class="row-fluid">								
                                                        <label class="form-label span4" for="checkboxes">Status Sekolah:</label>
                                                        <div class="span2 controls">
                                                            <select name="status" id="status">
                                                                <?php echo $content->SekolahStatusList($row->status); ?>
                                                            </select>							
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-row row-fluid">
                                                <div class="span12">
                                                    <div class="row-fluid">								
                                                        <label class="form-label span4" for="checkboxes">Tingkat Sekolah:</label>
                                                        <div class="span2 controls">
                                                            <select name="tingkat" id="tingkat">
                                                                <?php echo $content->Sekolah_TingkatList($row->tingkat); ?>
                                                            </select>							
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-row row-fluid">
                                                <div class="span12">
                                                    <div class="row-fluid">								
                                                        <label class="form-label span4" for="checkboxes">Akreditasi:</label>
                                                        <div class="span4 controls">
                                                            <select name="akreditasi" id="akreditasi">
                                                                <?php echo $content->SekolahAkreditasiList($row->akreditasi); ?>
                                                            </select>							
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                                                                        
                                            <div class="form-row row-fluid">
                                                <div class="span12">
                                                    <div class="row-fluid">								
                                                        <label class="form-label span4" for="checkboxes">Sertifikasi ISO & Tahun:</label>
                                                        <div class="grid-inputs span8">
                                                            <div class="span4 controls">                                                                 
                                                                <select name="sertf_iso" id="sertf_iso">
                                                                    <?php echo $content->SekolahSertf_ISOList($row->sertf_iso); ?>
                                                                </select>							
                                                            </div>&nbsp;
                                                            <input type="text" class="span2" name="tahun_sertf_iso" id="tahun_sertf_iso" value="<?php echo $row->tahun_sertf_iso;?>"/>                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                                                                                                                                                                
                                            <div class="form-row row-fluid">
                                                <div class="span12">
                                                    <div class="row-fluid">								
                                                        <label class="form-label span4" for="checkboxes">Kualifikasi Geografis:</label>
                                                        <div class="span4 controls">
                                                            <select name="kgeografis" id="kgeografis">
                                                                <?php echo $content->SekolahKGeografisList($row->kgeografis); ?>
                                                            </select>							
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="form-row row-fluid">
                                                <div class="span12">
                                                    <div class="row-fluid">								
                                                        <label class="form-label span4" for="normal">Alamat:</label>
                                                        <input type="text" class="span8 required" name="alamat" id="alamat" value="<?php echo $row->alamat;?>"/>
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
                                                        <label class="form-label span4" for="checkboxes">Kota:</label>
                                                        <div class="span8 controls">
                                                            <select name="kota_kode" id="kota_kode">
                                                                <option value=""><?php echo lang('SELECT');?></option>
                                                                <?php if ($kota):?>
                                                                    <?php foreach ($kota as $prow):?>
                                                                            <option value="<?php echo $prow->kode;?>"  <?php if($prow->kode == $row->kota_kode)echo 'selected="selected"';?>><?php echo $prow->nama_kota;?></option>
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
                                                        <label class="form-label span4" for="normal">Kelurahan:</label>
                                                        <input type="text" class="span8" name="kelurahan" id="alamat" value="<?php echo $row->kelurahan;?>"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-row row-fluid">
                                                <div class="span12">
                                                    <div class="row-fluid">								
                                                        <label class="form-label span4" for="normal">Kecamatan:</label>
                                                        <input type="text" class="span8" name="kecamatan" id="kecamatan" value="<?php echo $row->kecamatan;?>"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-row row-fluid">
                                                <div class="span12">
                                                    <div class="row-fluid">								
                                                        <label class="form-label span4" for="normal">RT & RW:</label>
                                                        <input type="text" class="span2" name="rt" id="rt" value="<?php echo $row->rt;?>"/>
                                                        <input type="text" class="span2" name="rw" id="rw" value="<?php echo $row->rw;?>"/>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="form-row row-fluid">
                                                <div class="span12">
                                                    <div class="row-fluid">								
                                                        <label class="form-label span4" for="normal">Kode Pos:</label>
                                                        <input type="text" class="span2" name="kodepos" id="kodepos" value="<?php echo $row->kodepos;?>"/>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="form-row row-fluid">
                                                <div class="span12">
                                                    <div class="row-fluid">								
                                                        <label class="form-label span4" for="normal">Telepon & Fax:</label>
                                                        <input type="text" class="span2" name="telepon" id="telepon" value="<?php echo $row->telepon;?>"/>
                                                        <input type="text" class="span2" name="fax" id="fax" value="<?php echo $row->fax;?>"/>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="form-row row-fluid">
                                                <div class="span12">
                                                    <div class="row-fluid">								
                                                        <label class="form-label span4" for="normal">E-Mail:</label>
                                                        <input type="text" class="span8" name="email" id="email" value="<?php echo $row->email;?>"/>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="form-row row-fluid">
                                                <div class="span12">
                                                    <div class="row-fluid">								
                                                        <label class="form-label span4" for="normal">Web Site:</label>
                                                        <input type="text" class="span8" name="website" id="website" value="<?php echo $row->website;?>"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-row row-fluid">
                                                <div class="span12">
                                                    <div class="row-fluid">								
                                                        <label class="form-label span4" for="normal">Jml Guru PNS & Non PNS:</label>
                                                        <input type="text" class="span2" name="guru_pns" id="guru_pns" value="<?php echo $row->guru_pns;?>"/>
                                                        <input type="text" class="span2" name="guru_npns" id="guru_npns" value="<?php echo $row->guru_npns;?>"/>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="form-row row-fluid">
                                                <div class="span12">
                                                    <div class="row-fluid">								
                                                        <label class="form-label span4" for="normal">Jml Guru Tetap & Tidak Tetap:</label>
                                                        <input type="text" class="span2 guruCalc" name="guru_tetap" id="guru_tetap" value="<?php echo $row->guru_tetap;?>"/>
                                                        <input type="text" class="span2 guruCalc" name="guru_ttetap" id="guru_ttetap" value="<?php echo $row->guru_ttetap;?>"/>
                                                        <input type="text" class="span2" name="guru_total" id="guru_total" value="<?php echo $row->guru_total;?>" readonly/>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="form-row row-fluid">
                                                <div class="span12">
                                                    <div class="row-fluid">								
                                                        <label class="form-label span4" for="normal">Jml Tenaga Kependidikan PNS & Non PNS:</label>
                                                        <input type="text" class="span2" name="tk_pns" id="tk_pns" value="<?php echo $row->tk_pns;?>"/>
                                                        <input type="text" class="span2" name="tk_npns" id="tk_npns" value="<?php echo $row->tk_npns;?>"/>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="form-row row-fluid">
                                                <div class="span12">
                                                    <div class="row-fluid">								
                                                        <label class="form-label span4" for="normal">Jml Tenaga Kependidikan Tetap & Tidak Tetap:</label>
                                                        <input type="text" class="span2 tkCalc" name="tk_tetap" id="tk_tetap" value="<?php echo $row->tk_tetap;?>"/>
                                                        <input type="text" class="span2 tkCalc" name="tk_ttetap" id="tk_ttetap" value="<?php echo $row->tk_ttetap;?>"/>
                                                        <input type="text" class="span2" name="tk_total" id="tk_total" value="<?php echo $row->tk_total;?>" readonly/>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="form-row row-fluid">
                                                <div class="span12">
                                                    <div class="row-fluid">								
                                                        <label class="form-label span4" for="normal">Last Update & Created:</label>
                                                        <input type="text" class="span2" name="last_update" id="last_update" value="<?php echo setToStrdatetime($row->last_update);?>" disabled="disabled"/>
                                                        <input type="text" class="span2" name="created" id="created" value="<?php echo setToStrdatetime($row->created);?>" disabled="disabled"/>
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
										
                                    </div>
                                    
                                    <div class="tab-pane fade" id="tab2">
                                        
                                        <div class="row-fluid">
                                            <div class="span12">

                                                <?php $smkrows = $content->getSekolah_SMK($row->id);?>
                                                <div id="sekolah_smk">
                                                <table class="responsive table table-striped table-bordered">

                                                    <thead>
                                                        <tr>
                                                            <th>Bidang Keahlian</th>
                                                            <th>Program Keahlian</th>
                                                            <th>Paket Keahlian</th>
                                                            <th width="40"><button type="button" class="btn" id="btnSMKadd" data-toggle="modal"><span class="icon16 icomoon-icon-plus-2"></span>Tambah</button></th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>

                                                    <?php if(!$smkrows):?>
                                                        <tr>
                                                            <td colspan="4"><?php echo Filter::msgInfo(lang('NO_DATA'), false);?></td>
                                                        </tr>

                                                    <?php else:?>
                                                    <?php foreach ($smkrows as $smkrow):?>

                                                        <tr>
                                                            <td style="text-align: left;"><?php echo $smkrow->nama_bidang;?></td>
                                                            <td style="text-align: left;"><?php echo $smkrow->nama_program;?></td>
                                                            <td style="text-align: left;"><?php echo $smkrow->nama_kompetensi;?></td>
                                                            <td align="center">
                                                                <a href="javascript:void(0)" title="Hapus" class="tip doDelete" data-tname="sekolah_smk" data-id="<?php echo $smkrow->id;?>" data-toggle="modal"><span class="icon12 icomoon-icon-remove"></span></a>
                                                            </td>
                                                        </tr>

                                                    <?php endforeach;?>
                                                    <?php unset($smkrow);?>
                                                    <?php endif;?>					

                                                    </tbody>

                                                </table>
                                                </div>

                                            </div><!-- End .span12 -->
                                        </div><!-- End .row-fluid -->
                                        
                                    </div><!-- end .tab2 -->
                                    
                                    <div class="tab-pane fade" id="tab3">
                                        
                                        <div class="row-fluid">
                                            <div class="span12">

                                                <div class="box gradient">
                                                    <div class="title">
                                                        <h4>
                                                            <span>Kualifikasi, Status, Jns Kelamin dan Jumlah Pendidik</span>
                                                        </h4>
                                                        <a href="#" class="minimize">Minimize</a>
                                                    </div>
                                                    <div class="content" id="sekolah_rkpsj">

                                                        <?php $rkpsjrows = $content->getSekolah_RKPSJ($row->id);?>

                                                        <table class="responsive table table-striped table-bordered">

                                                            <thead>
                                                                <tr>
                                                                    <th>Tingkat Pendidikan</th>
                                                                    <th>Jml GT PNS Laki-Laki</th>
                                                                    <th>Jml GT PNS Perempuan</th>
                                                                    <th width="40"><button type="button" class="btn" id="btnRKPSJadd" data-toggle="modal"><span class="icon16 icomoon-icon-plus-2"></span>Tambah</button></th>
                                                                </tr>
                                                            </thead>

                                                            <tbody>

                                                            <?php if(!$rkpsjrows):?>
                                                                <tr>
                                                                    <td colspan="4"><?php echo Filter::msgInfo(lang('NO_DATA'), false);?></td>
                                                                </tr>

                                                            <?php else:?>
                                                            <?php foreach ($rkpsjrows as $rkpsjrow):?>

                                                                <tr>
                                                                    <td style="text-align: left;"><?php echo $rkpsjrow->tingkat_pendidikan;?></td>
                                                                    <td style="text-align: left;"><?php echo $rkpsjrow->jml_gt_l;?></td>
                                                                    <td style="text-align: left;"><?php echo $rkpsjrow->jml_gt_p;?></td>
                                                                    <td align="center">
                                                                        <a href="javascript:void(0)" title="Hapus" class="tip doDelete" data-tname="sekolah_rkpsj" data-id="<?php echo $rkpsjrow->id;?>" data-toggle="modal"><span class="icon12 icomoon-icon-remove"></span></a>
                                                                    </td>
                                                                </tr>

                                                            <?php endforeach;?>
                                                            <?php unset($rkpsjrow);?>
                                                            <?php endif;?>					

                                                            </tbody>

                                                        </table>                                                

                                                    </div><!-- End .content -->
                                                </div><!-- End .box -->
                                                                                                        
                                            </div><!-- End .span12 -->
                                        </div><!-- End .row-fluid -->

                                        <div class="row-fluid">
                                            <div class="span12">

                                                <div class="box gradient">
                                                    <div class="title">
                                                        <h4>
                                                            <span>Pendidik dengan Tugas Mengajar Sesuai/Tidak Sesuai Latar Belakang Pendidikan</span>
                                                        </h4>
                                                        <a href="#" class="minimize">Minimize</a>
                                                    </div>
                                                    <div class="content" id="sekolah_rptl">

                                                        <?php $rptlrows = $content->getSekolah_RPTL($row->id);?>

                                                        <table class="responsive table table-striped table-bordered">

                                                            <thead>
                                                                <tr>
                                                                    <th>Mata Diklat/Pelajaran</th>
                                                                    <th>Jml Guru Sesuai</th>
                                                                    <th>Jml Guru Tdk Sesuai</th>
                                                                    <th width="40"><button type="button" class="btn" id="btnRPTLadd" data-toggle="modal"><span class="icon16 icomoon-icon-plus-2"></span>Tambah</button></th>
                                                                </tr>
                                                            </thead>

                                                            <tbody>

                                                            <?php if(!$rptlrows):?>
                                                                <tr>
                                                                    <td colspan="4"><?php echo Filter::msgInfo(lang('NO_DATA'), false);?></td>
                                                                </tr>

                                                            <?php else:?>
                                                            <?php foreach ($rptlrows as $rptlrow):?>

                                                                <tr>
                                                                    <td style="text-align: left;"><?php echo $rptlrow->mata_diklat;?></td>
                                                                    <td style="text-align: left;"><?php echo $rptlrow->jml_sesuai;?></td>
                                                                    <td style="text-align: left;"><?php echo $rptlrow->jml_tsesuai;?></td>
                                                                    <td align="center">
                                                                        <a href="javascript:void(0)" title="Hapus" class="tip doDelete" data-tname="sekolah_rptl" data-id="<?php echo $rptlrow->id;?>" data-toggle="modal"><span class="icon12 icomoon-icon-remove"></span></a>
                                                                    </td>
                                                                </tr>

                                                            <?php endforeach;?>
                                                            <?php unset($rptlrow);?>
                                                            <?php endif;?>					

                                                            </tbody>

                                                        </table>                                                

                                                    </div><!-- End .content -->
                                                </div><!-- End .box -->
                                                                                                        
                                            </div><!-- End .span12 -->
                                        </div><!-- End .row-fluid -->

                                        <div class="row-fluid">
                                            <div class="span12">

                                                <div class="box gradient">
                                                    <div class="title">
                                                        <h4>
                                                            <span>Pengembangan Kompetensi dan Profesionalisme Pendidik</span>
                                                        </h4>
                                                        <a href="#" class="minimize">Minimize</a>
                                                    </div>
                                                    <div class="content" id="sekolah_rpkpp">

                                                        <?php $rpkpprows = $content->getSekolah_RPKPP($row->id);?>

                                                        <table class="responsive table table-striped table-bordered">

                                                            <thead>
                                                                <tr>
                                                                    <th>Jenis Pengembangan Kompetensi</th>
                                                                    <th>Jml Guru</th>
                                                                    <th width="40"><button type="button" class="btn" id="btnRPKPPadd" data-toggle="modal"><span class="icon16 icomoon-icon-plus-2"></span>Tambah</button></th>
                                                                </tr>
                                                            </thead>

                                                            <tbody>

                                                            <?php if(!$rpkpprows):?>
                                                                <tr>
                                                                    <td colspan="3"><?php echo Filter::msgInfo(lang('NO_DATA'), false);?></td>
                                                                </tr>

                                                            <?php else:?>
                                                            <?php foreach ($rpkpprows as $rpkpprow):?>

                                                                <tr>
                                                                    <td style="text-align: left;"><?php echo $rpkpprow->jenis_pengembangan;?></td>
                                                                    <td style="text-align: left;"><?php echo $rpkpprow->jml_guru;?></td>
                                                                    <td align="center">
                                                                        <a href="javascript:void(0)" title="Hapus" class="tip doDelete" data-tname="sekolah_rpkpp" data-id="<?php echo $rpkpprow->id;?>" data-toggle="modal"><span class="icon12 icomoon-icon-remove"></span></a>
                                                                    </td>
                                                                </tr>

                                                            <?php endforeach;?>
                                                            <?php unset($rpkpprow);?>
                                                            <?php endif;?>					

                                                            </tbody>

                                                        </table>                                                

                                                    </div><!-- End .content -->
                                                </div><!-- End .box -->
                                                                                                        
                                            </div><!-- End .span12 -->
                                        </div><!-- End .row-fluid -->
                                           
                                        <div class="row-fluid">
                                            <div class="span12">

                                                <div class="box gradient">
                                                    <div class="title">
                                                        <h4>
                                                            <span>Kualifikasi Pendidik dan Jumlah Tenaga Kependidikan</span>
                                                        </h4>
                                                        <a href="#" class="minimize">Minimize</a>
                                                    </div>
                                                    <div class="content" id="sekolah_rkpjt">

                                                        <?php $rkpjtrows = $content->getSekolah_RKPJT($row->id);?>

                                                        <table class="responsive table table-striped table-bordered">

                                                            <thead>
                                                                <tr>
                                                                    <th>Tenaga Pendukung</th>
                                                                    <th>Tingkat Pendidikan</th>
                                                                    <th>Jumlah</th>
                                                                    <th width="40"><button type="button" class="btn" id="btnRKPJTadd" data-toggle="modal"><span class="icon16 icomoon-icon-plus-2"></span>Tambah</button></th>
                                                                </tr>
                                                            </thead>

                                                            <tbody>

                                                            <?php if(!$rkpjtrows):?>
                                                                <tr>
                                                                    <td colspan="4"><?php echo Filter::msgInfo(lang('NO_DATA'), false);?></td>
                                                                </tr>

                                                            <?php else:?>
                                                            <?php foreach ($rkpjtrows as $rkpjtrow):?>

                                                                <tr>
                                                                    <td style="text-align: left;"><?php echo $rkpjtrow->tenaga_pendukung;?></td>
                                                                    <td style="text-align: left;"><?php echo $rkpjtrow->tingkat_pendidikan;?></td>
                                                                    <td style="text-align: left;"><?php echo $rkpjtrow->jml;?></td>
                                                                    <td align="center">
                                                                        <a href="javascript:void(0)" title="Hapus" class="tip doDelete" data-tname="sekolah_rkpjt" data-id="<?php echo $rkpjtrow->id;?>" data-toggle="modal"><span class="icon12 icomoon-icon-remove"></span></a>
                                                                    </td>
                                                                </tr>

                                                            <?php endforeach;?>
                                                            <?php unset($rkpjtrow);?>
                                                            <?php endif;?>					

                                                            </tbody>

                                                        </table>                                                

                                                    </div><!-- End .content -->
                                                </div><!-- End .box -->
                                                                                                        
                                            </div><!-- End .span12 -->
                                        </div><!-- End .row-fluid -->
                                        
                                        
                                    </div><!-- end .tab3 -->

                                    <div class="tab-pane fade" id="tab4">

                                        <div class="row-fluid">
                                            <div class="span12">

                                                <?php $ppmdrows = $content->getSekolah_PPMD($row->id);?>
                                                <div id="sekolah_ppmd">
                                                <table class="responsive table table-striped table-bordered">

                                                    <thead>
                                                        <tr>
                                                            <th>Mata Diklat/Pelajaran</th>
                                                            <th>Jml PNS</th>
                                                            <th>Jml Non-PNS</th>
                                                            <th width="40"><button type="button" class="btn" id="btnPPMDadd" data-toggle="modal"><span class="icon16 icomoon-icon-plus-2"></span>Tambah</button></th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>

                                                    <?php if(!$ppmdrows):?>
                                                        <tr>
                                                            <td colspan="4"><?php echo Filter::msgInfo(lang('NO_DATA'), false);?></td>
                                                        </tr>

                                                    <?php else:?>
                                                    <?php foreach ($ppmdrows as $ppmdrow):?>

                                                        <tr>
                                                            <td style="text-align: left;"><?php echo $ppmdrow->mata_diklat;?></td>
                                                            <td style="text-align: left;"><?php echo $ppmdrow->jml_pns;?></td>
                                                            <td style="text-align: left;"><?php echo $ppmdrow->jml_nonpns;?></td>
                                                            <td align="center">
                                                                <a href="javascript:void(0)" title="Hapus" class="tip doDelete" data-tname="sekolah_ppmd" data-id="<?php echo $ppmdrow->id;?>" data-toggle="modal"><span class="icon12 icomoon-icon-remove"></span></a>
                                                            </td>
                                                        </tr>

                                                    <?php endforeach;?>
                                                    <?php unset($ppmdrow);?>
                                                    <?php endif;?>					

                                                    </tbody>

                                                </table>
                                                </div>

                                            </div><!-- End .span12 -->
                                        </div><!-- End .row-fluid -->
                                                                                
                                    </div><!-- end .tab4 -->

                                    <div class="tab-pane fade" id="tab5">
                                    
                                        <div class="row-fluid">
                                            <div class="span12">

                                                <div class="box gradient">
                                                    <div class="title">
                                                        <h4>
                                                            <span>Siswa</span>
                                                        </h4>
                                                        <a href="#" class="minimize">Minimize</a>
                                                    </div>
                                                    <div class="content" id="sekolah_siswa">

                                                        <?php $siswarows = $content->getSekolah_Siswa($row->id);?>

                                                        <table class="responsive table table-striped table-bordered">

                                                            <thead>
                                                                <tr>
                                                                    <th>Paket Keahlian</th>
                                                                    <th>Akreditasi</th>
                                                                    <th>Jml Tk1 (L)</th>
                                                                    <th width="40"><button type="button" class="btn" id="btnSiswaadd" data-toggle="modal"><span class="icon16 icomoon-icon-plus-2"></span>Tambah</button></th>
                                                                </tr>
                                                            </thead>

                                                            <tbody>

                                                            <?php if(!$siswarows):?>
                                                                <tr>
                                                                    <td colspan="4"><?php echo Filter::msgInfo(lang('NO_DATA'), false);?></td>
                                                                </tr>

                                                            <?php else:?>
                                                            <?php foreach ($siswarows as $siswarow):?>

                                                                <tr>
                                                                    <td style="text-align: left;"><?php echo $siswarow->nama_kompetensi;?></td>
                                                                    <td style="text-align: left;"><?php echo $siswarow->akreditasi;?></td>
                                                                    <td style="text-align: left;"><?php echo $siswarow->jml_tk1_l;?></td>
                                                                    <td align="center">
                                                                        <a href="javascript:void(0)" title="Hapus" class="tip doDelete" data-tname="sekolah_siswa" data-id="<?php echo $siswarow->id;?>" data-toggle="modal"><span class="icon12 icomoon-icon-remove"></span></a>
                                                                    </td>
                                                                </tr>

                                                            <?php endforeach;?>
                                                            <?php unset($siswarow);?>
                                                            <?php endif;?>					

                                                            </tbody>

                                                        </table>                                                

                                                    </div><!-- End .content -->
                                                </div><!-- End .box -->
                                                                                                        
                                            </div><!-- End .span12 -->
                                        </div><!-- End .row-fluid -->

                                        <div class="row-fluid">
                                            <div class="span12">

                                                <div class="box gradient">
                                                    <div class="title">
                                                        <h4>
                                                            <span>Ruangan Belajar, Laboratorium, Kantor dan Lainnya</span>
                                                        </h4>
                                                        <a href="#" class="minimize">Minimize</a>
                                                    </div>
                                                    <div class="content" id="sekolah_ruang">

                                                        <?php $ruangrows = $content->getSekolah_Ruang($row->id);?>

                                                        <table class="responsive table table-striped table-bordered">

                                                            <thead>
                                                                <tr>
                                                                    <th>Jenis</th>
                                                                    <th>Nama Jenis</th>
                                                                    <th>Jumlah</th>
                                                                    <th width="40"><button type="button" class="btn" id="btnRuangadd" data-toggle="modal"><span class="icon16 icomoon-icon-plus-2"></span>Tambah</button></th>
                                                                </tr>
                                                            </thead>

                                                            <tbody>

                                                            <?php if(!$ruangrows):?>
                                                                <tr>
                                                                    <td colspan="4"><?php echo Filter::msgInfo(lang('NO_DATA'), false);?></td>
                                                                </tr>

                                                            <?php else:?>
                                                            <?php foreach ($ruangrows as $ruangrow):?>

                                                                <tr>
                                                                    <td style="text-align: left;"><?php echo $ruangrow->jenis_ruang;?></td>
                                                                    <td style="text-align: left;"><?php echo $ruangrow->nama_jenis;?></td>
                                                                    <td style="text-align: left;"><?php echo $ruangrow->jml;?></td>
                                                                    <td align="center">
                                                                        <a href="javascript:void(0)" title="Hapus" class="tip doDelete" data-tname="sekolah_ruang" data-id="<?php echo $ruangrow->id;?>" data-toggle="modal"><span class="icon12 icomoon-icon-remove"></span></a>
                                                                    </td>
                                                                </tr>

                                                            <?php endforeach;?>
                                                            <?php unset($ruangrow);?>
                                                            <?php endif;?>					

                                                            </tbody>

                                                        </table>                                                

                                                    </div><!-- End .content -->
                                                </div><!-- End .box -->
                                                                                                        
                                            </div><!-- End .span12 -->
                                        </div><!-- End .row-fluid -->

                                        <div class="row-fluid">
                                            <div class="span12">

                                                <div class="box gradient">
                                                    <div class="title">
                                                        <h4>
                                                            <span>Tanah</span>
                                                        </h4>
                                                        <a href="#" class="minimize">Minimize</a>
                                                    </div>
                                                    <div class="content" id="sekolah_tanah">

                                                        <?php $tanahrows = $content->getSekolah_Tanah($row->id);?>

                                                        <table class="responsive table table-striped table-bordered">

                                                            <thead>
                                                                <tr>
                                                                    <th>Kepemilikan</th>
                                                                    <th>Status</th>
                                                                    <th>Luas (m2)</th>
                                                                    <th width="40"><button type="button" class="btn" id="btnTanahadd" data-toggle="modal"><span class="icon16 icomoon-icon-plus-2"></span>Tambah</button></th>
                                                                </tr>
                                                            </thead>

                                                            <tbody>

                                                            <?php if(!$tanahrows):?>
                                                                <tr>
                                                                    <td colspan="4"><?php echo Filter::msgInfo(lang('NO_DATA'), false);?></td>
                                                                </tr>

                                                            <?php else:?>
                                                            <?php foreach ($tanahrows as $tanahrow):?>

                                                                <tr>
                                                                    <td style="text-align: left;"><?php echo $tanahrow->kepemilikan;?></td>
                                                                    <td style="text-align: left;"><?php echo $tanahrow->status;?></td>
                                                                    <td style="text-align: left;"><?php echo $tanahrow->luas;?></td>
                                                                    <td align="center">
                                                                        <a href="javascript:void(0)" title="Hapus" class="tip doDelete" data-tname="sekolah_tanah" data-id="<?php echo $tanahrow->id;?>" data-toggle="modal"><span class="icon12 icomoon-icon-remove"></span></a>
                                                                    </td>
                                                                </tr>

                                                            <?php endforeach;?>
                                                            <?php unset($tanahrow);?>
                                                            <?php endif;?>					

                                                            </tbody>

                                                        </table>                                                

                                                    </div><!-- End .content -->
                                                </div><!-- End .box -->
                                                                                                        
                                            </div><!-- End .span12 -->
                                        </div><!-- End .row-fluid -->
                                                                                
                                    </div><!-- end .tab5 -->
                                    
                                    
                                </div>
                            </div> <!-- end tab -->

                            
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
                            
            
        <?php include ("sekolah_smk.php"); ?>
        <?php include ("sekolah_rkpsj.php"); ?>
        <?php include ("sekolah_rptl.php"); ?>
        <?php include ("sekolah_rpkpp.php"); ?>
        <?php include ("sekolah_rkpjt.php"); ?>
        <?php include ("sekolah_ppmd.php"); ?>
            
        <?php include ("sekolah_ruang.php"); ?>
        <?php include ("sekolah_siswa.php"); ?>
        <?php include ("sekolah_tanah.php"); ?>
                                                                                    
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
                    
                    // -- del data --

                    $('#delModal').on('show', function() {

                            var id = $(this).data('id'),
                                tname = $(this).data('tname'),
                                parent = $(this).data('parent');

                            $('#delModal a#delConfirmBtn').on('click', function(e) {

                                    $('#delModal').modal('hide'); // dismiss the dialog

                                    $.ajax({
                                              type: 'post',
                                              url: 'controller_sekolah.php',
                                              data: 'deleteSekolahdetail=' + tname + '&id=' + id,
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
                    
                    // ---  calculate ---
                     
                    $('input.guruCalc').each(function() {
                        $(this).keyup(function(){   
                            calculateGuruTotal();
                        });
                    });

                    function calculateGuruTotal() {
                        var guru_tetap = parseInt( $('#guru_tetap').val() ),
                            guru_ttetap = parseInt( $('#guru_ttetap').val() ),
                            guru_total = 0;

                        if ( !isNaN( guru_tetap ) ) {

                            if ( !isNaN( guru_ttetap ) )
                                guru_total = guru_tetap + guru_ttetap;
                            else
                                guru_total = guru_tetap;

                        } else {

                            if ( !isNaN( guru_ttetap ) )
                                guru_total = guru_ttetap;

                        }

                        document.getElementById('guru_total').value = guru_total;

                    }

                    $('input.tkCalc').each(function() {
                        $(this).keyup(function(){   
                            calculateTKTotal();
                        });
                    });

                    function calculateTKTotal() {
                        var tk_tetap = parseInt( $('#tk_tetap').val() ),
                            tk_ttetap = parseInt( $('#tk_ttetap').val() ),
                            tk_total = 0;

                        if ( !isNaN( tk_tetap ) ) {

                            if ( !isNaN( tk_ttetap ) )
                                tk_total = tk_tetap + tk_ttetap;
                            else
                                tk_total = tk_tetap;

                        } else {

                            if ( !isNaN( tk_ttetap ) )
                                tk_total = tk_ttetap;

                        }

                        document.getElementById('tk_total').value = tk_total;

                    }
                                                            
		});
	  
	</script>		
	
	<?php echo Core::doForm("processUpdateSekolah"); ?> 	