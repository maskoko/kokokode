    <script type="text/javascript" src="js/pn_diklat_nilai.js"></script>

                        <?php $row = $content->getDiklat_PesertaByID(Filter::$id);	?>

                        <div class="box">

                            <div id="msgholder"></div>

                            <div class="title">
                                <h4> 
                                    <span>Data Peserta</span>
                                </h4>
                                <a href="#" class="minimize">Minimize</a>								
                            </div>

                            <div class="content">

                                <form id="peserta_form" class="form-horizontal" method="post" action="">								
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

                                    <div class="form-actions">
                                        <button type="button" class="btn" onclick="history.back()">Kembali</button>
                                    </div>

                                </fieldset>	
                                </form>
                                
                            </div><!-- End .content -->
                        </div><!-- End .box -->


                        <div class="box">

                            <div id="msgholder"></div>

                            <div class="title">
                                <h4> 
                                    <span>Nilai Mata Diklat</span>
                                </h4>
                            </div>

                            <div class="content">

                                <?php $dmtrows = $content->getDiklat_NilaiPeserta(Filter::$id, $row->jadwalid);?>

                                <form id="admin_form" class="form-horizontal" method="post" action="">								
                                <fieldset>							

                                    <table class="responsive table table-striped table-bordered">

                                        <thead>
                                            <tr>
                                                <th width="50">No</th>
                                                <th width="60">Kode</th>
                                                <th>Mata Tatar</th>
                                                <th width="60">Nilai</th>
                                                <th>Catatan</th>
                                            </tr>
                                        </thead>

                                        <tbody>

                                        <?php if(!$dmtrows):?>
                                            <tr>
                                                <td colspan="5"><?php echo Filter::msgInfo(lang('NO_DATA'), false);?></td>
                                            </tr>

                                        <?php else:?>
                                        <?php $i = 0; foreach ($dmtrows as $dmtrow): ?>
                                            <input name="mata_tatarid[]" type="hidden" value="<?php echo $dmtrow->id;?>" />
                                            <input name="nilaiid[]" type="hidden" value="<?php echo $dmtrow->nilaiid;?>" />

                                            <tr>
                                                <td align="center"><?php $i++; echo $i;?></td>
                                                <td><?php echo $dmtrow->kode;?></td>
                                                <td><?php echo $dmtrow->nama_mata_tatar;?></td>
                                                <td>
                                                    <input type="text" class="span2 required" name="nilai[]" id="nilai_<?php echo $dmtrow->id;?>" value="<?php if ($dmtrow->nilai) echo $dmtrow->nilai;?>" style="width: 56px;"/>
                                                </td>
                                                <td>
                                                    <input type="text" class="span4 required" name="catatan[]" id="catatan_<?php echo $dmtrow->id;?>" value="<?php if ($dmtrow->catatan) echo $dmtrow->catatan;?>"/>
                                                </td>
                                            </tr>

                                        <?php endforeach;?>
                                        <?php unset($dmtrow);?>
                                        <?php endif;?>					

                                        </tbody>

                                    </table>

                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-info">Save</button>
                                        <button type="button" class="btn" onclick="history.back()">Kembali</button>
                                    </div>

                                    <input name="pesertaid" type="hidden" value="<?php echo Filter::$id;?>" /> <!-- pesertaid -->
                                    <input name="userid" type="hidden" value="<?php echo $user->uid;?>" />

                                </fieldset>	
                                </form>

                            </div><!-- End .content -->
                            
                        </div><!-- End .box -->		
																				
<?php echo Core::doForm("processDiklat_Nilai"); ?> 	
