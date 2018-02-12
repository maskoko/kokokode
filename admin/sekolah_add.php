
						<div class="box">

                                                    <div id="msgholder"></div>

                                                    <?php 
                                                        $jenis = $content->getSekolah_Jenis();
                                                        $propinsi = $content->getPropinsiList();
                                                        $kota = $content->getKotaByPropinsiList(0);
                                                     ?>

                                                    <div class="title">
                                                        <h4> 
                                                            <span>Tambah Data Sekolah</span>
                                                        </h4>								
                                                    </div>

                                                    <div class="content">

                                                        <form id="admin_form" class="form-horizontal" method="post" action="">			
                                                        <fieldset>

                                                            <div class="form-row row-fluid">
                                                                <div class="span12">
                                                                    <div class="row-fluid">								
                                                                        <label class="form-label span4" for="normal">NSS:</label>
                                                                        <input type="text" class="span2 required" name="nss" id="nss" value="" maxlength="13"/>
                                                                        <span class="help-inline blue">: 12-13 digit numerik</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-row row-fluid">
                                                                <div class="span12">
                                                                    <div class="row-fluid">								
                                                                        <label class="form-label span4" for="normal">NPSN:</label>
                                                                        <input type="text" class="span2 required" name="npsn" id="npsn" value="" maxlength="8"/>
                                                                        <span class="help-inline blue">: 8 digit numerik</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="form-row row-fluid">
                                                                <div class="span12">
                                                                    <div class="row-fluid">								
                                                                        <label class="form-label span4" for="normal">Nama Sekolah:</label>
                                                                        <input type="text" class="span8 required" name="nama_sekolah" id="nama_sekolah" value=""/>
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
                                                                                            <option value="<?php echo $prow->id;?>"><?php echo $prow->nama_jenis;?></option>
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
                                                                        <input type="text" class="span8 required" name="nama_pimpinan" id="nama_pimpinan" value=""/>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="form-row row-fluid">
                                                                <div class="span12">
                                                                    <div class="row-fluid">								
                                                                        <label class="form-label span4" for="normal">NIP & NUPTK Pimpinan:</label>
                                                                        <input type="text" class="span2" name="nip_pimpinan" id="nip_pimpinan" value="" maxlength="18"/>
                                                                        <input type="text" class="span2" name="nuptk_pimpinan" id="nuptk_pimpinan" value="" maxlength="16"/>
                                                                        <span class="help-inline blue">: 16 utk NUPTK & 18 utk NIP digit numerik</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-row row-fluid">
                                                                <div class="span12">
                                                                    <div class="row-fluid">								
                                                                        <label class="form-label span4" for="normal">No. Telp Pimpinan:</label>
                                                                        <input type="text" class="span2" name="telp_pimpinan" id="telp_pimpinan" value=""/>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="form-row row-fluid">
                                                                <div class="span12">
                                                                    <div class="row-fluid">								
                                                                        <label class="form-label span4" for="checkboxes">Status Kepemilikan:</label>
                                                                        <div class="span4 controls">
                                                                            <select name="statusmilik" id="statusmilik">
                                                                                <?php echo $content->SekolahStatus_MilikList(); ?>
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
                                                                                <?php echo $content->SekolahStatusList(); ?>
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
                                                                                <?php echo $content->Sekolah_TingkatList(); ?>
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
                                                                                <?php echo $content->SekolahAkreditasiList(); ?>
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
                                                                                    <?php echo $content->SekolahSertf_ISOList(); ?>
                                                                                </select>							
                                                                            </div>&nbsp;
                                                                            <input type="text" class="span2" name="tahun_sertf_iso" id="tahun_sertf_iso" value=""/>
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
                                                                                <?php echo $content->SekolahKGeografisList(); ?>
                                                                            </select>							
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="form-row row-fluid">
                                                                <div class="span12">
                                                                    <div class="row-fluid">								
                                                                        <label class="form-label span4" for="normal">Alamat:</label>
                                                                        <input type="text" class="span8 required" name="alamat" id="alamat" value=""/>
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
                                                                        <label class="form-label span4" for="checkboxes">Kota:</label>
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
                                                                        <label class="form-label span4" for="normal">Kelurahan:</label>
                                                                        <input type="text" class="span8" name="kelurahan" id="alamat" value=""/>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="form-row row-fluid">
                                                                <div class="span12">
                                                                    <div class="row-fluid">								
                                                                        <label class="form-label span4" for="normal">Kecamatan:</label>
                                                                        <input type="text" class="span8" name="kecamatan" id="kecamatan" value=""/>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="form-row row-fluid">
                                                                <div class="span12">
                                                                    <div class="row-fluid">								
                                                                        <label class="form-label span4" for="normal">RT & RW:</label>
                                                                        <input type="text" class="span2" name="rt" id="rt" value=""/>
                                                                        <input type="text" class="span2" name="rw" id="rw" value=""/>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="form-row row-fluid">
                                                                <div class="span12">
                                                                    <div class="row-fluid">								
                                                                        <label class="form-label span4" for="normal">Kode Pos:</label>
                                                                        <input type="text" class="span2" name="kodepos" id="kodepos" value=""/>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="form-row row-fluid">
                                                                <div class="span12">
                                                                    <div class="row-fluid">								
                                                                        <label class="form-label span4" for="normal">Telepon & Fax:</label>
                                                                        <input type="text" class="span2" name="telepon" id="telepon" value=""/>
                                                                        <input type="text" class="span2" name="fax" id="fax" value=""/>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="form-row row-fluid">
                                                                <div class="span12">
                                                                    <div class="row-fluid">								
                                                                        <label class="form-label span4" for="normal">E-Mail:</label>
                                                                        <input type="text" class="span8" name="email" id="email" value=""/>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="form-row row-fluid">
                                                                <div class="span12">
                                                                    <div class="row-fluid">								
                                                                        <label class="form-label span4" for="normal">Web Site:</label>
                                                                        <input type="text" class="span8" name="website" id="website" value=""/>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="form-row row-fluid">
                                                                <div class="span12">
                                                                    <div class="row-fluid">								
                                                                        <label class="form-label span4" for="normal">Jml Guru PNS & Non PNS:</label>
                                                                        <input type="text" class="span2" name="guru_pns" id="guru_pns" value="0"/>
                                                                        <input type="text" class="span2" name="guru_npns" id="guru_npns" value="0"/>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="form-row row-fluid">
                                                                <div class="span12">
                                                                    <div class="row-fluid">								
                                                                        <label class="form-label span4" for="normal">Jml Guru Tetap & Tidak Tetap:</label>
                                                                        <input type="text" class="span2 guruCalc" name="guru_tetap" id="guru_tetap" value="0"/>
                                                                        <input type="text" class="span2 guruCalc" name="guru_ttetap" id="guru_ttetap" value="0"/>
                                                                        <input type="text" class="span2" name="guru_total" id="guru_total" value="0" readonly/>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="form-row row-fluid">
                                                                <div class="span12">
                                                                    <div class="row-fluid">								
                                                                        <label class="form-label span4" for="normal">Jml Tenaga Kependidikan PNS & Non PNS:</label>
                                                                        <input type="text" class="span2" name="tk_pns" id="tk_pns" value="0"/>
                                                                        <input type="text" class="span2" name="tk_npns" id="tk_npns" value="0"/>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="form-row row-fluid">
                                                                <div class="span12">
                                                                    <div class="row-fluid">								
                                                                        <label class="form-label span4" for="normal">Jml Tenaga Kependidikan Tetap & Tidak Tetap:</label>
                                                                        <input type="text" class="span2 tkCalc" name="tk_tetap" id="tk_tetap" value="0"/>
                                                                        <input type="text" class="span2 tkCalc" name="tk_ttetap" id="tk_ttetap" value="0"/>
                                                                        <input type="text" class="span2" name="tk_total" id="tk_total" value="0" readonly/>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                                                                                        
                                                            <div class="form-actions">
                                                                <button type="submit" class="btn btn-info">Save</button>
                                                                <button type="button" class="btn" onclick="history.back()">Kembali</button>
                                                            </div>

                                                            <input name="userid" type="hidden" value="<?php echo $user->uid;?>" />
                                                        </fieldset>	
                                                        </form> 
                                                    </div><!-- End content -->
								
						</div><!-- End .box -->

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
	
<?php echo Core::doForm("processAddSekolah"); ?> 	
