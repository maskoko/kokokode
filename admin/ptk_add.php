    <script type="text/javascript" src="js/ptk_edit.js"></script>

                <div class="heading">
                    <h3>Data Pengajar dan Tenaga Kependidikan (PTK)</h3>                                        
                </div><!-- End .heading-->
    				
                <!-- Build page from here: Usual with <div class="row-fluid"></div> -->

                <div class="row-fluid">
                    <div class="span12">
    
                        <div id="msgholder"></div>
                        
                        <div class="box">

                            <?php 
                                $propinsi = $content->getPropinsiList();
                                $kota = $content->getKotaByPropinsiList(0);
                                $golongan = $content->getGolonganList();
                                
                                $sek_propinsi_kode = "";
                                $sek_kota_kode = "";
                            
                            ?>

                            <div class="title">
                                <h4> 
                                    <span>Tambah Data PTK</span>
                                    <span id="loader" class="loader" style="display:none"><img src="images/loader_circular.gif" width="16" height="16" alt=""></span>
                                </h4>								
                            </div>
   
                            <div class="content">

                                <form id="admin_form" class="form-horizontal" method="post" action="">			
                                <fieldset>

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <label class="form-label span2" for="nuptk">NUPTK:
                                                    <span class="help-block">16 digit numerik</span>
                                                </label>
                                                <div class="span2 controls">
                                                    <input type="text" class="required" name="nuptk" id="nuptk" value="" maxlength="16"/>
                                                </div>
                                                                                                
                                                <label class="form-label span2" for="normal">NIP:
                                                    <span class="help-block">18 digit numerik</span>
                                                </label>
                                                <div class="span2 controls">
                                                    <input type="text" name="nip" id="nip" value="" maxlength="18"/>
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
                                                <input type="text" class="span2" name="gelar_depan1" id="gelar_depan1" value="" maxlength="6" style="width:50px;" data-provide="typeahead"/>
                                                <input type="text" class="span2" name="gelar_depan2" id="gelar_depan2" value="" maxlength="6" style="width:50px;" data-provide="typeahead"/>
                                                <input type="text" class="span2" name="gelar_depan3" id="gelar_depan3" value="" maxlength="6" style="width:50px;" data-provide="typeahead"/>
                                                <input type="text" class="span6 required" name="nama_lengkap" id="nama_lengkap" value="" maxlength="60"/>
                                                <input type="text" class="span2" name="gelar_belakang1" id="gelar_belakang1" value="" maxlength="6" style="width:50px;" data-provide="typeahead"/>
                                                <input type="text" class="span2" name="gelar_belakang2" id="gelar_belakang2" value="" maxlength="6" style="width:50px;" data-provide="typeahead"/>
                                                <input type="text" class="span2" name="gelar_belakang3" id="gelar_belakang3" value="" maxlength="6" style="width:50px;" data-provide="typeahead"/>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">
                                                <span class="orange"><label class="form-label span2" for="checkboxes">Propinsi Sekolah :</label></span>
                                                <div class="span8 controls">
                                                    <select name="sek_propinsi_kode" id="sek_propinsi_kode" class="nostyle">
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
                                                <span class="orange"><label class="form-label span2" for="checkboxes">Kota/Kab Sekolah:</label></span>
                                                <div class="span8 controls">
                                                    <select name="sek_kota_kode" id="sek_kota_kode" class="nostyle">
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
                                                <div class="span8 controls">
                                                    <select name="sekolahid" id="sekolahid" class="nostyle" style="width:100%;" placeholder="Select...">
                                                        <option value=""><?php echo lang('SELECT');?></option>
                                                        <?php if ($sekolah):?>
                                                            <?php foreach ($sekolah as $prow):?>
                                                                <option value="<?php echo $prow->id;?>"><?php echo $prow->nama_sekolah;?></option>
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
                                                <input type="text" class="span6" name="tmp_lahir" id="tmp_lahir" value=""/>&nbsp;
                                                <input type="text" class="span2 datepickerField" name="tgl_lahir" id="tgl_lahir" value=""/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <label class="form-label span2" for="normal">No. KTP:</label>
                                                <div class="span4 controls">
                                                    <input type="text" name="no_ktp" id="no_ktp" style="width: 200px;" value=""/>
                                                </div>
                                                <label class="form-label span2" for="checkboxes">Jenis Kelamin:</label>
                                                <div class="span2 controls">
                                                    <select name="jns_klmn" id="jns_klmn">
                                                        <?php echo $content->Jenis_KelaminList(); ?>
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
                                                        <?php echo $content->AgamaList(); ?>
                                                    </select>							
                                                </div>                                                
                                                <label class="form-label span2" for="checkboxes">Status Kawin:</label>
                                                <div class="span2 controls">
                                                    <select name="status_kawin" id="status_kawin">
                                                        <?php echo $content->Status_KawinList(); ?>
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
                                                                <option value="<?php echo $prow->kode;?>"<?php if ($prow->kode == 'NON PNS') echo ' Selected="selected"'; ?>><?php if ($prow->nama_pangkat != '') echo $prow->nama_pangkat . ', ' .$prow->kode; else echo $prow->kode; ?></option>
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
                                                    <input type="text" name="alamat" id="alamat" value=""/>
                                                </div>
                                                
                                                <label class="form-label span2" for="normal">Kode Pos:</label>
                                                <div class="span2 controls">
                                                    <input type="text" name="kodepos" id="kodepos" value=""/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <label class="form-label span2" for="checkboxes">Propinsi:</label>
                                                <div class="span8 controls">
                                                    <select name="propinsi_kode" id="propinsi_kode" style="width:350px;">
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
                                                <label class="form-label span2" for="checkboxes">Kota/Kabupaten:</label>
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
                                                <label class="form-label span2" for="normal">Kelurahan:</label>
                                                <div class="span3 controls">
                                                    <input type="text" name="kelurahan" id="alamat" style="width:200px;" value=""/>
                                                </div>
                                                <label class="form-label span2" for="normal">Kecamatan:</label>
                                                <div class="span2 controls">
                                                    <input type="text" name="kecamatan" id="kecamatan" style="width:200px;" value=""/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <label class="form-label span2" for="normal">Telepon Rumah:</label>
                                                <div class="span2 controls">
                                                    <input type="text" name="telepon1" id="telepon1" value=""/>
                                                </div>
                                                    
                                                <label class="form-label span2" for="normal">Handphone:</label>
                                                <div class="span2 controls">    
                                                    <input type="text" name="telepon2" id="telepon2" value=""/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <label class="form-label span2" for="normal">E-Mail:</label>
                                                <input type="text" class="span8" name="email" id="email" value=""/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <label class="form-label span2" for="normal">Web Site:</label>
                                                <input type="text" class="span8" name="website" id="website" value=""/>
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
                                                        <?php echo $content->StatusKepegawaianList(); ?>
                                                    </select>							
                                                </div>
                                                
                                                <label class="form-label span3" for="checkboxes">Jenis Kepegawaian:</label>
                                                <div class="span2 controls">
                                                    <select name="jeniskepegawaian" id="jeniskepegawaian">
                                                        <option value=""><?php echo lang('SELECT');?></option>
                                                        <?php echo $content->JenisKepegawaianList(); ?>
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
                                                        <?php echo $content->TugasPokokList(); ?>
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
                                                        <?php echo $content->Status_GuruList(); ?>
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
                                                    <select name="jabatanpokok" id="jabatanpokok">
                                                        <option value=""><?php echo lang('SELECT');?></option>
                                                        <?php echo $content->JabatanPokokList(); ?>
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
                                                        <?php echo $content->Sekolah_IjazahList(); ?>
                                                    </select>							
                                                </div>
                                                
                                                <span class="green"><label class="form-label span2" for="tahun_lulus_akhir">Tahun Lulus:</label></span>
                                                <input type="text" class="span2" name="tahun_lulus_akhir" id="tahun_lulus_akhir" maxlength="4" style="width: 60px;" value=""/>
                                                
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <span class="green"><label class="form-label span2" for="normal">Jurusan:</label></span>
                                                <input type="text" class="span8" name="jurusan_akhir" id="jurusan_akhir" value=""/>
                                            </div>
                                        </div>
                                    </div>
                                                     
                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <span class="green"><label class="form-label span2" for="normal">Institusi/Universitas Terakhir:</label></span>
                                                <input type="text" class="span8" name="pendidikan_akhir" id="pendidikan_akhir" value=""/>
                                            </div>
                                        </div>
                                    </div>                                    
                                    
                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <label class="form-label span2" for="normal">TMT PNS:</label>
                                                <div class="span2 controls">
                                                    <input type="text" class="datepickerField" name="tmt_pns" id="tmt_pns" value=""/>
                                                </div>
                                                <label class="form-label span2" for="normal">TMT Pendidik:</label>
                                                <div class="span2 controls">
                                                    <input type="text" class="datepickerField" name="tmt_pendidik" id="tmt_pendidik" value=""/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <label class="form-label span2" for="normal">TMT Sekolah:</label>
                                                <div class="span2 controls">
                                                    <input type="text" class="datepickerField" name="tmt_sekolah" id="tmt_sekolah" value=""/>
                                                </div>
                                                    
                                                <label class="form-label span2" for="normal">TMT Kepala Sekolah:</label>
                                                <div class="span2 controls">
                                                    <input type="text" class="datepickerField" name="tmt_kepalasekolah" id="tmt_kepalasekolah" value=""/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <label class="form-label span2" for="checkboxes">Sertifikasi Profesi Guru:</label>
                                                <div class="span3 controls">
                                                    <select name="sertifikasi_guru" id="sertifikasi_guru">
                                                        <option value=""><?php echo lang('SELECT');?></option>
                                                        <?php echo $content->Sertifikasi_GuruList(); ?>
                                                    </select>							
                                                </div>                                                
                                                <label class="form-label span3" for="checkboxes">Akta Mengajar:</label>
                                                <div class="span2 controls">
                                                    <select name="akta_mengajar" id="akta_mengajar">
                                                        <option value=""><?php echo lang('SELECT');?></option>
                                                        <?php echo $content->YaTidakList(); ?>
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
                                                            <option value="" selected="selected"><?php echo lang('SELECT');?></option>
                                                            <option value="Lulus">Lulus</option>
                                                            <option value="Tdk Lulus">Tidak Lulus</option>
                                                        </select>							
                                                </div>
                                                <label class="form-label span3" for="UKA_tahun">Tahun Lulus:</label>
                                                <div class="span2 controls">
                                                    <input type="text" name="UKA_tahun" maxlength="4" style="width: 60px;" id="UKA_tahun" value=""/>
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
                                                        <option value="" selected="selected"><?php echo lang('SELECT');?></option>
                                                        <option value="Lulus">Lulus</option>
                                                        <option value="Tdk Lulus">Tidak Lulus</option>
                                                    </select>							
                                                </div>
                                                <label class="form-label span3" for="UKG_tahun">Tahun Lulus:</label>
                                                <div class="span2 controls">
                                                    <input type="text" name="UKG_tahun" maxlength="4" style="width: 60px;" id="UKG_tahun" value=""/>
                                                </div>                                                
                                            </div>
                                        </div>
                                    </div>                                        
                                                                        
                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-info">Save</button>
                                        <button type="button" class="btn" onclick="history.back()">Kembali</button>
                                    </div>

                                    <input name="status" type="hidden" value="A" />
                                    <input name="userid" type="hidden" value="<?php echo $user->uid; ?>" />

                                </fieldset>
                                </form>       
                            </div><!-- End .box -->

                        </div><!-- End .box -->

                </div><!-- End .span12 -->
            </div><!-- End .row-fluid -->  
                                                
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

                        })                                                  
                         
                         
                        var options = {
                                target: "#msgholder",
                                beforeSubmit:  showLoader,
                                success: showResponse,
                                url: "controller.php",
                                resetForm : 0,
                                clearForm : 0,
                                data: {
                                        processAddPTK: 1
                                }
                        };

                        $("#admin_form").ajaxForm(options);
                                                  
                        function showLoader() {
                                $("#loader").fadeIn(200);
                        }
		  
                        function hideLoader() {
                              $("#loader").fadeOut(200);
                        };	

                        function showResponse(msg) {    
                            hideLoader();
                                                            
                            if (msg.indexOf('OK_') >= 0) {
                                var id = msg.replace('OK_', '');
                                window.location = 'index.php?do=ptk&action=edit&id=' + id;
                            } else {
                              $(this).html(msg);
                              $("html, body").animate({
                                      scrollTop: 0
                              }, 600);                                  
                            }                                  
                              
                        }
                             
                    var gelar = ['Drs', 'Dr', 'MSi', 'SPd', 'M.Pd', 'S.Ag', 'Ir', 'SE', 'S.Kom', 'S.Pd.Ekop', 'Dra', 'S.Sos'];   
                    $('#gelar_depan1').typeahead({source: gelar});
                    $('#gelar_depan2').typeahead({source: gelar});
                    $('#gelar_depan3').typeahead({source: gelar});

                    $('#gelar_belakang1').typeahead({source: gelar});
                    $('#gelar_belakang2').typeahead({source: gelar});
                    $('#gelar_belakang3').typeahead({source: gelar});            
                                                          
		});
	                      
	</script>		
		
