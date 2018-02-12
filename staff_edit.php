<?php
  /**
   * Edit Data PTK by himself
   *
   * @package SIM PPPPTK BMTI
   * @author a2ngsa
   * @copyright 2012
   * @version $Id: staff_edit.php (registered), v1.00 2011-06-05 10:12:05 gewa Exp $
   */
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
  
?>

<script type="text/javascript" src="js/staff_edit.js"></script>

        <!--Body content-->
        <div id="content" class="clearfix">
            <div class="contentwrapper"><!--Content wrapper-->    
    
                <div class="heading">
                    <h3>
                        <span>Identitas Staff</span>
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
                                <li><a href="#tab2" data-toggle="tab">Riwayat Pendidikan</a></li>
                                <li><a href="#tab3" data-toggle="tab">Riwayat Diklat & Jabatan</a></li>
                                <li><a href="#tab4" data-toggle="tab">Riwayat Karya & Sertifikat</a></li>
                            </ul>

                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="tab1">

                                    <?php 
                                    
                                        $row = $content->getStaffById($user->ptkid);
                                        $propinsi = $content->getPropinsiList();
                                        $golongan = $content->getGolonganList();
                                        
                                        if ($row->lembagaid) {
                                            $lbg_row = Core::getRowById("lembaga", $row->lembagaid);
                                            if ($lbg_row) {
                                                $lbg_propinsi_kode = $lbg_row->propinsi_kode;
                                                $lbg_kota_kode = $lbg_row->kota_kode;
                                                
                                                $kota = $content->getKotaList($lbg_propinsi_kode); 
                                                
                                                unset($lbg_row);
                                            } else {
                                                $lbg_propinsi_kode = "";
                                                $lbg_kota_kode = "";
                                            }                                            
                                        } else {
                                                $lbg_propinsi_kode = "";
                                                $lbg_kota_kode = "";
                                            }                                                                                    
                                        
                                    ?>

                                    <form id="admin_form" class="form-horizontal" method="post" action="">          
                                    <fieldset>
                                        <div class="form-row row-fluid">
                                            <div class="span12">
                                                <div class="row-fluid">                             
                                                    <label class="form-label span2" for="normal">Nama Lengkap:
                                                        <span class="help-block">Opsi 3 gelar.</span>
                                                    </label>
                                                    <input type="text" class="span2" name="gelar_depan1" id="gelar_depan1" value="<?php echo $row->gelar_depan1;?>" maxlength="6" style="width:50px;" data-provide="typeahead"/>
                                                    <input type="text" class="span2" name="gelar_depan2" id="gelar_depan2" value="<?php echo $row->gelar_depan2;?>" maxlength="6" style="width:50px;" data-provide="typeahead"/>
                                                    <input type="text" class="span2" name="gelar_depan3" id="gelar_depan3" value="<?php echo $row->gelar_depan3;?>" maxlength="6" style="width:50px;" data-provide="typeahead"/>
                                                    <input type="text" class="span6 required" name="nama_lengkap" id="nama_lengkap" value="<?php echo $row->nama_lengkap;?>"/>
                                                    <input type="text" class="span2" name="gelar_belakang1" id="gelar_belakang1" value="<?php echo $row->gelar_belakang1;?>" maxlength="6" style="width:50px;" data-provide="typeahead"/>
                                                    <input type="text" class="span2" name="gelar_belakang2" id="gelar_belakang2" value="<?php echo $row->gelar_belakang2;?>" maxlength="6" style="width:50px;" data-provide="typeahead"/>
                                                    <input type="text" class="span2" name="gelar_belakang3" id="gelar_belakang3" value="<?php echo $row->gelar_belakang3;?>" maxlength="6" style="width:50px;" data-provide="typeahead"/>
                                                </div>
                                            </div>
                                        </div>

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
                                                        <input type="text" name="nip" id="nip" value="<?php echo $row->nip;?>" style="width: 200px;"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="form-row row-fluid">
                                            <div class="span12">
                                                <div class="row-fluid">
                                                    <span class="orange"><label class="form-label span2" for="checkboxes">Propinsi Lembaga :</label></span>
                                                    <div class="span4 controls">
                                                        <select name="lbg_propinsi_kode" id="lbg_propinsi_kode" class="nostyle">
                                                            <option value=""><?php echo lang('SELECT');?></option>
                                                                <?php if ($propinsi):?>
                                                                    <?php foreach ($propinsi as $prow):?>
                                                                        <option value="<?php echo $prow->kode;?>" <?php if($prow->kode == $lbg_propinsi_kode) echo 'selected="selected"';?>><?php echo $prow->nama_propinsi;?></option>
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
                                                    <span class="orange"><label class="form-label span2" for="checkboxes">Kota/Kab Lembaga:</label></span>
                                                    <div class="span4 controls">
                                                        <select name="lbg_kota_kode" id="lbg_kota_kode" class="nostyle">
                                                            <option value=""><?php echo lang('SELECT');?></option>
                                                            <?php if ($kota):?>
                                                                <?php foreach ($kota as $prow):?>
                                                                    <option value="<?php echo $prow->kode;?>" <?php if($prow->kode == $lbg_kota_kode) echo 'selected="selected"';?>><?php echo $prow->nama_kota;?></option>
                                                                <?php endforeach;?>
                                                                <?php unset($prow);?>
                                                            <?php endif;?>
                                                        </select>                       
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <?php 
                                            if (($lbg_propinsi_kode != "") && ($lbg_kota_kode != ""))
                                                $lembaga = $content->getLembagaList($lbg_propinsi_kode, $lbg_kota_kode);
                                            else
                                                $lembaga = null;
                                        ?>

                                        <div class="form-row row-fluid">
                                            <div class="span12">
                                                <div class="row-fluid">                             
                                                    <span class="orange"><label class="form-label span2" for="checkboxes">Lembaga:</label></span>
                                                    <div class="span4 controls">
                                                        <select name="lembagaid" id="lembagaid" class="nostyle" style="width:100%;" placeholder="Select...">
                                                            <option value=""><?php echo lang('SELECT');?></option>
                                                            <?php if ($lembaga):?>
                                                                <?php foreach ($lembaga as $prow):?>
                                                                    <option value="<?php echo $prow->id;?>" <?php if($prow->id == $row->lembagaid)echo 'selected="selected"';?>><?php echo $prow->nama_lembaga;?></option>
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
                                                    <label class="form-label span2" for="checkboxes">Tempat:</label>
                                                    <div class="span4 controls">
                                                        <input type="text" name="tmp_lahir" id="tmp_lahir" value="<?php echo $row->tmp_lahir;?>"/>
                                                    </div>    
                                                    <label class="form-label span2" for="checkboxes">Tgl Lahir:</label>
                                                    <div class="span2 controls">
                                                        <input type="text" class="datepickerField" name="tgl_lahir" id="tgl_lahir" value="<?php echo setToStrdate($row->tgl_lahir);?>"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="form-row row-fluid">
                                            <div class="span12">
                                                <div class="row-fluid">                             
                                                    <label class="form-label span2" for="normal">No. KTP:</label>
                                                    <div class="span4 controls">
                                                        <input type="text" name="no_ktp" id="no_ktp" value="<?php echo $row->no_ktp;?>"/>
                                                    </div>                                                    
                                                    <label class="form-label span2" for="checkboxes">Status Kawin:</label>
                                                    <div class="span2 controls">
                                                        <select name="status_kawin" id="status_kawin" class="nostyle">
                                                            <?php echo $content->Status_KawinList($row->status_kawin); ?>
                                                        </select>                           
                                                    </div>                                                    
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-row row-fluid">
                                            <div class="span12">
                                                <div class="row-fluid">                             
                                                    <label class="form-label span2" for="checkboxes">Jenis Kelamin:</label>
                                                    <div class="span2 controls">
                                                        <select name="jns_klmn" id="jns_klmn" class="nostyle">
                                                            <?php echo $content->Jenis_KelaminList($row->jns_klmn); ?>
                                                        </select>                           
                                                    </div>
                                                    
                                                    <label class="form-label span2" for="checkboxes">Agama:</label>
                                                    <div class="span2 controls">
                                                        <select name="agama" id="agama" class="nostyle">
                                                            <?php echo $content->AgamaList($row->agama); ?>
                                                        </select>                           
                                                    </div>                                                    
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-row row-fluid">
                                            <div class="span12">
                                                <div class="row-fluid">                             
                                                    <label class="form-label span2" for="checkboxes">Golongan:</label>
                                                    <div class="span2 controls">
                                                        <select name="golongan" id="golongan" class="nostyle">
                                                            <option value=""><?php echo lang('SELECT');?></option>
                                                            <?php if ($golongan):?>
                                                                <?php foreach ($golongan as $prow):?>
                                                                    <option value="<?php echo $prow->kode;?>" <?php if($prow->kode == $row->golongan)echo 'selected="selected"';?>><?php echo $prow->kode;?></option>
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
                                                    <div class="span6 controls">
                                                        <input type="text" name="alamat" id="alamat" value="<?php echo $row->alamat;?>"/>
                                                    </div>
                                                    <label class="form-label span2" for="normal">Kode Pos:</label>
                                                    <div class="span2 controls">
                                                        <input type="text" name="kodepos" id="kodepos" value="<?php echo $row->kodepos;?>"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-row row-fluid">
                                            <div class="span12">
                                                <div class="row-fluid">                             
                                                    <label class="form-label span2" for="checkboxes">Propinsi:</label>
                                                    <div class="span8 controls">
                                                        <select name="propinsi_kode" id="propinsi_kode" class="nostyle">
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
                                                    <label class="form-label span2" for="checkboxes">Kota:</label>
                                                    <div class="span8 controls">
                                                        <select name="kota_kode" id="kota_kode" class="nostyle">
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
                                                    <input type="text" class="span8" name="kelurahan" id="alamat" value="<?php echo $row->kelurahan;?>"/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-row row-fluid">
                                            <div class="span12">
                                                <div class="row-fluid">                             
                                                    <label class="form-label span2" for="normal">Kecamatan:</label>
                                                    <input type="text" class="span8" name="kecamatan" id="kecamatan" value="<?php echo $row->kecamatan;?>"/>
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
                                                    <label class="form-label span2" for="normal">TMT:</label>
                                                    <div class="span2 controls">
                                                        <input type="text" class="datepickerField" name="tmt" id="tmt" value="<?php if ($row->tmt) echo setToStrdate($row->tmt);?>"/>
                                                    </div>
                                                    <label class="form-label span2" for="normal">TMT Internal:</label>
                                                    <div class="span2 controls">
                                                        <input type="text" class="datepickerField" name="tmtin" id="tmtin" value="<?php if ($row->tmtin) echo setToStrdate($row->tmtin);?>"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-row row-fluid">
                                            <div class="span12">
                                                <div class="row-fluid">                             
                                                    <label class="form-label span2" for="normal">Last Update / Entry :</label>
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

                                            <div class="box gradient">
                                                <div class="title">

                                                    <h4>
                                                        <span>Formal</span>
                                                    </h4>
                                                    <a href="#" class="minimize">Minimize</a>
                                                </div>
                                                <div class="content" id="staff_rpf">

                                                    <?php $rpfrows = $content->getStaff_RPF($row->id);?>

                                                    <table class="responsive table table-striped table-bordered">

                                                        <thead>
                                                            <tr>
                                                                <th width="60">Jenjang</th>
                                                                <th>Nama Sekolah</th>
                                                                <th>lokasi</th>
                                                                <th>Jurusan</th>
                                                                <th width="60">Tahun</th>
                                                                <th width="40"><button type="button" class="btn" id="btnRPFadd" data-toggle="modal"><span class="icon16 icomoon-icon-plus-2"></span>Tambah</button></th>
                                                            </tr>
                                                        </thead>

                                                        <tbody>

                                                        <?php if(!$rpfrows):?>
                                                            <tr>
                                                                <td colspan="6"><?php echo Filter::msgInfo(lang('NO_DATA'), false);?></td>
                                                            </tr>

                                                        <?php else:?>
                                                        <?php foreach ($rpfrows as $rpfrow):?>

                                                            <tr>
                                                                <td style="text-align: left;"><?php echo $rpfrow->nama_jenjang;?></td>
                                                                <td style="text-align: left;"><?php echo $rpfrow->nama_sekolah;?></td>
                                                                <td style="text-align: left;"><?php echo $rpfrow->lokasi;?></td>
                                                                <td style="text-align: left;"><?php echo $rpfrow->jurusan;?></td>
                                                                <td><?php echo $rpfrow->tahun_lulus;?></td>
                                                                <td align="center">
                                                                    <a href="javascript:void(0)" title="Edit" class="tip doEditrpf" data-tname="staff_rpf" data-id="<?php echo $rpfrow->id;?>" data-toggle="modal"><span class="icon12 icomoon-icon-pencil"></span></a>
                                                                    <a href="javascript:void(0)" title="Hapus" class="tip doDelete" data-tname="staff_rpf" data-id="<?php echo $rpfrow->id;?>" data-toggle="modal"><span class="icon12 icomoon-icon-remove"></span></a>
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
                                                        <span>Non Formal</span>
                                                    </h4>
                                                    <a href="#" class="minimize">Minimize</a>
                                                </div>
                                                <div class="content" id="staff_rpnf">

                                                    <?php $rpnfrows = $content->getStaff_RPNF($row->id);?>

                                                    <table class="responsive table table-striped table-bordered">

                                                        <thead>
                                                            <tr>
                                                                <th>Nama Pendidikan</th>
                                                                <th>Pelaksana</th>
                                                                <th>Lokasi</th>
                                                                <th width="70">Tahun</th>
                                                                <th width="30">Jml Jam</th>
                                                                <th width="40"><button type="button" class="btn" id="btnRPNFadd" data-toggle="modal"><span class="icon16 icomoon-icon-plus-2"></span>Tambah</button></th>
                                                            </tr>
                                                        </thead>

                                                        <tbody>

                                                        <?php if(!$rpnfrows):?>
                                                            <tr>
                                                                <td colspan="6"><?php echo Filter::msgInfo(lang('NO_DATA'), false);?></td>
                                                            </tr>

                                                        <?php else:?>
                                                        <?php foreach ($rpnfrows as $rpnfrow):?>

                                                            <tr>
                                                                <td style="text-align: left;"><?php echo $rpnfrow->nama_pendidikan;?></td>
                                                                <td style="text-align: left;"><?php echo $rpnfrow->pelaksana;?></td>
                                                                <td style="text-align: left;"><?php echo $rpnfrow->lokasi;?></td>
                                                                <td><?php echo $rpnfrow->tahun;?></td>
                                                                <td><?php echo $rpnfrow->jml_jam;?></td>
                                                                <td align="center">
                                                                    <a href="javascript:void(0)" title="Edit" class="tip doEditrpnf" data-tname="staff_rpnf" data-id="<?php echo $rpnfrow->id;?>" data-toggle="modal"><span class="icon12 icomoon-icon-pencil"></span></a>
                                                                    <a href="javascript:void(0)" title="Hapus" class="tip doDelete" data-tname="staff_rpnf" data-id="<?php echo $rpnfrow->id;?>" data-toggle="modal"><span class="icon12 icomoon-icon-remove"></span></a>
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

                                <div class="tab-pane fade" id="tab3">
                                    
                                    <div class="row-fluid">
                                        <div class="span12">

                                            <div class="box gradient">
                                                <div class="title">

                                                    <h4>
                                                        <span>Diklat</span>
                                                    </h4>
                                                    <a href="#" class="minimize">Minimize</a>
                                                </div>
                                                <div class="content" id="staff_rdiklat">

                                                    <?php $rdiklatrows = $content->getStaff_RDiklat($row->id);?>

                                                    <table class="responsive table table-striped table-bordered">

                                                        <thead>
                                                            <tr>
                                                                <th width="60">Tingkat</th>
                                                                <th>Nama Diklat</th>
                                                                <th>Tempat</th>
                                                                <th width="50">Status</th>
                                                                <th width="60">Tahun</th>
                                                                <th width="40"><button type="button" class="btn" id="btnRDiklatadd" data-toggle="modal"><span class="icon16 icomoon-icon-plus-2"></span>Tambah</button></th>
                                                            </tr>
                                                        </thead>

                                                        <tbody>

                                                        <?php if(!$rdiklatrows):?>
                                                            <tr>
                                                                <td colspan="6"><?php echo Filter::msgInfo(lang('NO_DATA'), false);?></td>
                                                            </tr>

                                                        <?php else:?>
                                                        <?php foreach ($rdiklatrows as $rdiklatrow):?>

                                                            <tr>
                                                                <td style="text-align: left;"><?php echo $rdiklatrow->tingkat;?></td>
                                                                <td style="text-align: left;"><?php echo $rdiklatrow->nama_diklat;?></td>
                                                                <td style="text-align: left;"><?php echo $rdiklatrow->tempat;?></td>
                                                                <td><?php echo $rdiklatrow->sttpl;?></td>
                                                                <td><?php echo $rdiklatrow->tahun;?></td>
                                                                <td align="center">
                                                                    <a href="javascript:void(0)" title="Edit" class="tip doEditrdiklat" data-tname="staff_rdiklat" data-id="<?php echo $rdiklatrow->id;?>" data-toggle="modal"><span class="icon12 icomoon-icon-pencil"></span></a>
                                                                    <a href="javascript:void(0)" title="Hapus" class="tip doDelete" data-tname="staff_rdiklat" data-id="<?php echo $rdiklatrow->id;?>" data-toggle="modal"><span class="icon12 icomoon-icon-remove"></span></a>
                                                                </td>
                                                            </tr>

                                                        <?php endforeach;?>
                                                        <?php unset($rdiklatrow);?>
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
                                                        <span>Jabatan</span>
                                                    </h4>
                                                    <a href="#" class="minimize">Minimize</a>
                                                </div>
                                                <div class="content" id="staff_rjabatan">

                                                    <?php $rjabatanrows = $content->getStaff_RJabatan($row->id);?>

                                                    <table class="responsive table table-striped table-bordered">

                                                        <thead>
                                                            <tr>
                                                                <th>Jenis</th>
                                                                <th>Jabatan</th>
                                                                <th>Lembaga</th>
                                                                <th width="70">Tahun</th>
                                                                <th>Tempat Tugas</th>
                                                                <th width="40"><button type="button" class="btn" id="btnRJabatanadd" data-toggle="modal"><span class="icon16 icomoon-icon-plus-2"></span>Tambah</button></th>
                                                            </tr>
                                                        </thead>

                                                        <tbody>

                                                        <?php if(!$rjabatanrows):?>
                                                            <tr>
                                                                <td colspan="6"><?php echo Filter::msgInfo(lang('NO_DATA'), false);?></td>
                                                            </tr>

                                                        <?php else:?>
                                                        <?php foreach ($rjabatanrows as $rjabatanrow):?>

                                                            <tr>
                                                                <td style="text-align: left;"><?php echo $rjabatanrow->jenis;?></td>
                                                                <td style="text-align: left;"><?php echo $rjabatanrow->jabatan;?></td>
                                                                <td style="text-align: left;"><?php echo $rjabatanrow->lembaga;?></td>
                                                                <td><?php echo $rjabatanrow->tahun;?></td>
                                                                <td style="text-align: left;"><?php echo $rjabatanrow->tmp_tugas;?></td>
                                                                <td align="center">
                                                                    <a href="javascript:void(0)" title="Edit" class="tip doEditrjabatan" data-tname="staff_rjabatan" data-id="<?php echo $rjabatanrow->id;?>" data-toggle="modal"><span class="icon12 icomoon-icon-pencil"></span></a>
                                                                    <a href="javascript:void(0)" title="Hapus" class="tip doDelete" data-tname="staff_rjabatan" data-id="<?php echo $rjabatanrow->id;?>" data-toggle="modal"><span class="icon12 icomoon-icon-remove"></span></a>
                                                                </td>
                                                            </tr>

                                                        <?php endforeach;?>
                                                        <?php unset($rjabatanrow);?>
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

                                            <div class="box gradient">
                                                <div class="title">

                                                    <h4>
                                                        <span>Karya</span>
                                                    </h4>
                                                    <a href="#" class="minimize">Minimize</a>
                                                </div>
                                                <div class="content" id="staff_rkarya">

                                                    <?php $rkaryarows = $content->getStaff_RKarya($row->id);?>

                                                    <table class="responsive table table-striped table-bordered">

                                                        <thead>
                                                            <tr>
                                                                <th width="60">NSS</th>
                                                                <th width="60">NIP</th>
                                                                <th>Nama Karya</th>
                                                                <th width="60">Tahun</th>
                                                                <th>Keterangan</th>
                                                                <th width="40"><button type="button" class="btn" id="btnRKaryaadd" data-toggle="modal"><span class="icon16 icomoon-icon-plus-2"></span>Tambah</button></th>
                                                            </tr>
                                                        </thead>

                                                        <tbody>

                                                        <?php if(!$rkaryarows):?>
                                                            <tr>
                                                                <td colspan="6"><?php echo Filter::msgInfo(lang('NO_DATA'), false);?></td>
                                                            </tr>

                                                        <?php else:?>
                                                        <?php foreach ($rkaryarows as $rkaryarow):?>

                                                            <tr>
                                                                <td><?php echo $rkaryarow->nss;?></td>
                                                                <td><?php echo $rkaryarow->nip;?></td>
                                                                <td style="text-align: left;"><?php echo $rkaryarow->nama_karya;?></td>
                                                                <td><?php echo $rkaryarow->tahun;?></td>
                                                                <td style="text-align: left;"><?php echo $rkaryarow->keterangan;?></td>
                                                                <td align="center">
                                                                    <a href="javascript:void(0)" title="Edit" class="tip doEditrkarya" data-tname="staff_rkarya" data-id="<?php echo $rkaryarow->id;?>" data-toggle="modal"><span class="icon12 icomoon-icon-pencil"></span></a>
                                                                    <a href="javascript:void(0)" title="Hapus" class="tip doDelete" data-tname="staff_rkarya" data-id="<?php echo $rkaryarow->id;?>" data-toggle="modal"><span class="icon12 icomoon-icon-remove"></span></a>
                                                                </td>
                                                            </tr>

                                                        <?php endforeach;?>
                                                        <?php unset($rkaryarow);?>
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
                                                        <span>Sertifikat</span>
                                                    </h4>
                                                    <a href="#" class="minimize">Minimize</a>
                                                </div>
                                                <div class="content" id="staff_rsertifikat">

                                                    <?php $rsertifikatrows = $content->getStaff_RSertifikat($row->id);?>

                                                    <table class="responsive table table-striped table-bordered">

                                                        <thead>
                                                            <tr>
                                                                <th>NSS</th>
                                                                <th>NIP</th>
                                                                <th>Nama Sertifikat</th>
                                                                <th>Pelaksana</th>
                                                                <th width="30">Status</th>
                                                                <th width="70">Tahun</th>
                                                                <th width="40"><button type="button" class="btn" id="btnRSertifikatadd" data-toggle="modal"><span class="icon16 icomoon-icon-plus-2"></span>Tambah</button></th>
                                                            </tr>
                                                        </thead>

                                                        <tbody>

                                                        <?php if(!$rsertifikatrows):?>
                                                            <tr>
                                                                <td colspan="7"><?php echo Filter::msgInfo(lang('NO_DATA'), false);?></td>
                                                            </tr>

                                                        <?php else:?>
                                                        <?php foreach ($rsertifikatrows as $rsertifikatrow):?>

                                                            <tr>
                                                                <td style="text-align: left;"><?php echo $rsertifikatrow->nss;?></td>
                                                                <td style="text-align: left;"><?php echo $rsertifikatrow->nip;?></td>
                                                                <td style="text-align: left;"><?php echo $rsertifikatrow->nama_sertifikat;?></td>
                                                                <td style="text-align: left;"><?php echo $rsertifikatrow->pelaksana;?></td>
                                                                <td><?php echo $rsertifikatrow->status;?></td>
                                                                <td><?php echo $rsertifikatrow->tahun;?></td>
                                                                <td align="center">
                                                                    <a href="javascript:void(0)" title="Edit" class="tip doEditrsertifikat" data-tname="staff_rsertifikat" data-id="<?php echo $rsertifikatrow->id;?>" data-toggle="modal"><span class="icon12 icomoon-icon-pencil"></span></a>
                                                                    <a href="javascript:void(0)" title="Hapus" class="tip doDelete" data-tname="staff_rsertifikat" data-id="<?php echo $rsertifikatrow->id;?>" data-toggle="modal"><span class="icon12 icomoon-icon-remove"></span></a>
                                                                </td>
                                                            </tr>

                                                        <?php endforeach;?>
                                                        <?php unset($rsertifikatrow);?>
                                                        <?php endif;?>                  

                                                        </tbody>

                                                    </table>

                                                </div>
                                            </div><!-- End .box -->  

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
                        
        <?php include ("staff_rpf.php"); ?>
        <?php include ("staff_rpnf.php"); ?>
        <?php include ("staff_rdiklat.php"); ?>
        <?php include ("staff_rjabatan.php"); ?>
        <?php include ("staff_rkarya.php"); ?>
        <?php include ("staff_rsertifikat.php"); ?>
                            
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
                                    $("#kota_kode").html(html); 
                            }
                    });

                    $("#kota_kode").val("");

            });
                
            $("#lbg_propinsi_kode").change(function(){
                    var kode = $("#lbg_propinsi_kode").val();

                    $.ajax({
                            type: 'post',
                            url: "controller.php",
                            data: "loadKotaList=" + kode,
                            cache: false,
                            success: function(html){
                                    $("#lbg_kota_kode").html(html); 
                            }
                    });

                    $("#lbg_kota_kode").val("");

            });

            $("#lbg_kota_kode").change(function(){
                    var propinsi_kode = $("#lbg_propinsi_kode").val();
                    var kota_kode = $("#lbg_kota_kode").val();

                    $.ajax({
                            type: 'post',
                            url: "controller.php",
                            data: "loadLembagaList=" + propinsi_kode + "&kota=" + kota_kode,
                            cache: false,
                            success: function(html){
                                    $("#lembagaid").html(html); 
                            }
                    });

                    $("#lembagaid").val("");

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
                                      url: 'controller_staff.php',
                                      data: 'deleteDatadetail=' + tname + '&id=' + id,
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
                
<?php echo Core::doForm("processUpdateStaff", "ajax/controller.php"); ?>

    <!-- Charts plugins -->
    <script type="text/javascript" src="plugins/charts/sparkline/jquery.sparkline.min.js"></script><!-- Sparkline plugin -->
    
    <!-- Misc plugins -->
    <script type="text/javascript" src="plugins/misc/qtip/jquery.qtip.min.js"></script><!-- Custom tooltip plugin -->
    <script type="text/javascript" src="plugins/misc/totop/jquery.ui.totop.min.js"></script> 

    <!-- Search plugin -->
    <script type="text/javascript" src="plugins/misc/search/tipuesearch_set.js"></script>
    <script type="text/javascript" src="plugins/misc/search/tipuesearch_data.js"></script><!-- JSON for searched results -->
    <script type="text/javascript" src="plugins/misc/search/tipuesearch.js"></script>

    <!-- Form plugins -->
    <script type="text/javascript" src="plugins/forms/watermark/jquery.watermark.min.js"></script>
    <script type="text/javascript" src="plugins/forms/uniform/jquery.uniform.min.js"></script>    
    <script type="text/javascript" src="plugins/forms/select/select2.min.js"></script>
            
    <!-- Fix plugins -->
    <script type="text/javascript" src="plugins/fix/ios-fix/ios-orientationchange-fix.js"></script>

    <!-- Table plugins -->
    <script type="text/javascript" src="plugins/tables/responsive-tables/responsive-tables.js"></script><!-- Make tables responsive -->

    <!-- Important Place before main.js  -->
    <script type="text/javascript" src="js/jquery-ui.min.js"></script>
    <script type="text/javascript" src="js/jquery.form.js"></script> 
    <script type="text/javascript" src="plugins/fix/touch-punch/jquery.ui.touch-punch.min.js"></script><!-- Unable touch for JQueryUI -->
    
    <!-- Init plugins -->
    <script type="text/javascript" src="js/main.js"></script><!-- Core js functions -->
