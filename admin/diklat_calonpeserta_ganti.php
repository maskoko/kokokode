
	<?php
		if(isset(Filter::$get['jadwalid']))
                    $jadwalid = Filter::$get['jadwalid'];
		else
                    $jadwalid = 0;
			
		if(isset(Filter::$get['id']))
                    $id = Filter::$get['id'];
		else
                    $id = 0;
			
	?>

                        <div class="box">

                            <div class="title">
                                <h4>
                                    <span>Data GTK Peserta</span>
                                </h4>
                                <a href="#" class="minimize">Minimize</a>
                            </div>

                            <div class="content">

                                <?php $ptkrow = $content->getDiklat_CalonPesertaById($id); ?>

                                <?php if ($ptkrow) : ?>

                                <form name="ptkinfo_form" class="form form-horizontal" method="get" action="">
                                    <fieldset>

                                        <div class="form-row row-fluid">
                                            <div class="span12">
                                                <div class="row-fluid">
                                                    <label class="form-label span4" for="normal">NUPTK:</label>
                                                    <input type="text" class="span2" name="nuptk" id="nuptk" value="<?php echo $ptkrow->nuptk;?>" disabled="disabled" />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-row row-fluid">
                                            <div class="span12">
                                                <div class="row-fluid">
                                                    <label class="form-label span4" for="normal">Nama:</label>
                                                    <input type="text" class="span8" name="nama_lengkap" id="nuptk" value="<?php echo $ptkrow->nama_lengkap;?>" disabled="disabled" />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-row row-fluid">
                                            <div class="span12">
                                                <div class="row-fluid">
                                                    <label class="form-label span4" for="normal">NIP:</label>
                                                    <input type="text" class="span2" name="nip" id="nip" value="<?php echo $ptkrow->nip;?>" disabled="disabled" />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-row row-fluid">
                                            <div class="span12">
                                                <div class="row-fluid">
                                                    <label class="form-label span4" for="normal">Sekolah:</label>
                                                    <input type="text" class="span8" name="nama_sekolah" id="nama_sekolah" value="<?php echo $ptkrow->nama_sekolah;?>" disabled="disabled" />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-row row-fluid">
                                            <div class="span12">
                                                <div class="row-fluid">
                                                    <label class="form-label span4" for="normal">Propinsi:</label>
                                                    <input type="text" class="span8" name="nama_propinsi" id="nama_propinsi" value="<?php echo $ptkrow->nama_propinsi;?>" disabled="disabled" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row row-fluid">
                                            <div class="span12">
                                                <div class="row-fluid">
                                                    <label class="form-label span4" for="normal">Kota:</label>
                                                    <input type="text" class="span8" name="nama_kota" id="nama_kota" value="<?php echo $ptkrow->nama_kota;?>" disabled="disabled" />
                                                </div>
                                            </div>
                                        </div>


                                    </fieldset>
                                </form>

                                <?php endif; ?>
                            </div>

                        </div><!-- End filter .box -->

                    </div><!-- End .span12 -->
                </div><!-- End .row-fluid -->

                <div class="row-fluid">
                    <div class="span12">

                        <div class="box">

                            <div id="msgholder"></div>

                            <div class="title">
                                <h4>
                                    <span class="icon16 icomoon-icon-graduation"></span>
                                    
                                    <?php $row = $content->getDiklat_JadwalById($jadwalid); ?>
                                    
                                    <span>Pilih Pengganti untuk Diklat : <?php echo $row->kode . ' / ' . $row->nama_diklat; ?></span>

                                    <?php unset($row); ?>
                                    
                                </h4>
                            </div>
                            
                            <div class="content">

                                <?php $rows = $content->getDiklat_CalonPeserta($jadwalid, "C"); ?>

                                <form id="admin_form" method="post" action="">
                                <fieldset>

                                    <table class="responsive table table-striped table-bordered" id="checkAll">

                                        <thead>
                                            <tr>
                                                <th width="30"></th>
                                                <th>NUPTK</th>
                                                <th>Nama Lengkap</th>
                                                <th>Sekolah/Instansi</th>
                                                <th>Propinsi</th>
                                                <th>Kota</th>
                                                <th>NIP</th>
                                                <th>Info</th>
                                            </tr>
                                        </thead>

                                        <tbody>

                                        <?php if(!$rows):?>
                                            <tr>
                                                <td colspan="8"><?php echo Filter::msgInfo(lang('NO_DATA'), false);?></td>
                                            </tr>

                                        <?php else:?>
                                        <?php foreach ($rows as $row):?>

                                            <tr>
                                                <td style="text-align: center;"><input type="radio" name="peserta_gantiid" value="<?php echo $row->id; ?>" class="required"/></td>
                                                <td><?php echo $row->nuptk;?></td>
                                                <td style="text-align: left;"><?php echo $row->nama_lengkap;?></td>
                                                <td style="text-align: left;"><?php echo $row->nama_sekolah;?></td>
                                                <td style="text-align: left;"><?php echo $row->nama_propinsi;?></td>
                                                <td style="text-align: left;"><?php echo $row->nama_kota;?></td>
                                                <td><?php echo $row->nip;?></td>
                                                <td align="center">
                                                    <a href="javascript:void(0)" title="" class="tip test" id="btnPTKinfo_<?php echo $row->personid; ?>" data-toggle="modal"><span class="icon12 icomoon-icon-search-3"></span></a>
                                                </td>
                                            </tr>

                                        <?php endforeach;?>
                                        <?php unset($row);?>
                                        <?php endif;?>					

                                        </tbody>

                                    </table>

                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-info">Ganti!</button>
                                        <button type="button" class="btn" onclick="document.location.href='index.php?do=diklat_calonpeserta&amp;jadwalid=<?php echo $jadwalid; ?>&amp;status=P'">Kembali</button>
                                    </div>

                                    <input name="userid" type="hidden" value="<?php echo $user->uid; ?>" />			
                                    <input name="id" type="hidden" value="<?php echo $id; ?>" />

                                </fieldset>
                                </form>
                                
                            </div><!-- End .content -->

                        </div><!-- End .box -->
                            
                    <!-- Boostrap approve modal dialog -->
                    <div id="ptkModal" class="modal hide fade" style="display: none; ">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal"><span class="icon12 minia-icon-close"></span></button>
                          <h3>Info GTK</h3>
                        </div>

                        <div class="modal-body">		
                            <div id="modalContent" style="display:none;">
                            </div>
                        </div>

                        <div class="modal-footer">
                          <a href="#" class="btn" data-dismiss="modal">Close</a>
                        </div>
                      </div>
                                                
	<?php echo Core::doForm("processDiklat_CalonPesertaGanti"); ?>

	<script type="text/javascript">

                $(document).ready(function () {
		  
                    $('a.tip.test').live('click', function () {

                            var id = $(this).attr('id').replace('btnPTKinfo_', '')
                            var parent = $(this).parent().parent();

                            $("#ptkModal").data({
                                    'id': id,
                                    'parent': parent
                            });

                            $('#ptkModal').modal();

                            return false;
                    });
		  
                  
                    $("a[data-toggle=modal]").click(function() {
                    
                            var id = $(this).attr('id').replace('btnPTKinfo_', '');
                            
                            $.ajax({
                                    cache: false,
                                    type: 'GET',
                                    url: 'controller_ptk.php',
                                    data: 'viewPTKInfoMinat=' + id,
                                    success: function(data) 
                                    {
                                            $('#ptkModal').show();
                                            $('#modalContent').show().html(data);
                                    }
                            });
                            
                            return true;
                    }); 
                                                                                
                                        
                });		  
		  		 		  
	</script>
                    