
    <script type="text/javascript" src="js/diklat_peserta_add.js"></script>

	<?php
		if(isset(Filter::$get['jadwalid']))
			$jadwalid = Filter::$get['jadwalid'];
		else
			$jadwalid = 0;
	?>

                        <div class="box">

                            <div id="msgholder"></div>

                            <div class="title">
                                <h4>
                                    <span class="icon16 icomoon-icon-graduation"></span>

                                    <?php $row = $content->getDiklat_JadwalById($jadwalid); ?>
                                    
                                    <span>Pilih dari Calon Peserta Diklat : <?php echo $row->kode . ' / ' . $row->nama_diklat; ?></span>

                                    <?php unset($row); ?>
                                    
                                </h4>																				
                            </div>
                            
                            <div class="content">

                                <?php $rows = $content->getDiklat_CalonPeserta($jadwalid);?>

                                <form id="admin_form" method="post" action="">
                                <fieldset>

                                    <table class="responsive table table-striped table-bordered" id="checkAll">

                                        <thead>
                                            <tr>
                                                <th width="40" align="center" id="masterCh" class="ch"><input type="checkbox" name="checkbox" value="all" class="styled" /></th>
                                                <th>NUPTK</th>
                                                <th>Nama Lengkap</th>
                                                <th>Sekolah</th>
                                                <th>Propinsi</th>
                                                <th>Kota</th>
                                                <th>NIP</th>
                                                <th width="30">Ap 1</th>
                                                <th width="30">Ap 2</th>
                                                <th width="30">Ap 3</th>
                                                <th></th>
                                            </tr>
                                        </thead>

                                        <tbody>

                                        <?php if(!$rows):?>
                                            <tr>
                                                <td colspan="11"><?php echo Filter::msgInfo(lang('NO_DATA'), false);?></td>
                                            </tr>

                                        <?php else:?>
                                        <?php foreach ($rows as $row):?>
                                            <input type="hidden" name="instansiid[]" value="<?php echo $row->instansiid; ?>" />
                                            <input type="hidden" name="jenis[]" value="P" />
                                            
                                            <tr>
                                                <td class="chChildren"><input type="checkbox" name="personid[]" value="<?php echo $row->personid; ?>"  class="styled"/></td>
                                                <td><?php echo $row->nuptk;?></td>
                                                <td style="text-align: left;"><?php echo $row->nama_lengkap;?></td>
                                                <td style="text-align: left;"><?php echo $row->nama_sekolah;?></td>
                                                <td style="text-align: left;"><?php echo $row->nama_propinsi;?></td>
                                                <td style="text-align: left;"><?php echo $row->nama_kota;?></td>
                                                <td style="text-align: left;"><?php echo $row->nip;?></td>
                                                <td><?php if ($row->approve1) echo "<button class=\"btn btn-mini\" href=\"\" disabled=\"disabled\">A</button>"; else echo "<button class=\"btn btn-info btn-mini\" href=\"#\" disabled=\"disabled\">U</button>"; ?></td>
                                                <td><?php if ($row->approve2) echo "<button class=\"btn btn-mini\" href=\"\" disabled=\"disabled\">A</button>"; else echo "<button class=\"btn btn-info btn-mini\" href=\"#\" disabled=\"disabled\">U</button>"; ?></td>
                                                <td><?php if ($row->approve3) echo "<button class=\"btn btn-mini\" href=\"\" disabled=\"disabled\">A</button>"; else echo "<button class=\"btn btn-info btn-mini\" href=\"#\" disabled=\"disabled\">U</button>"; ?></td>												
                                                <td align="center">
                                                    <a href="javascript:void(0)" title="" class="tip test" id="btnPTKinfo_<?php echo $row->id; ?>" data-toggle="modal"><span class="icon12 icomoon-icon-search-3"></span></a>
                                                </td>
                                            </tr>

                                        <?php endforeach;?>
                                        <?php unset($row);?>
                                        <?php endif;?>					

                                        </tbody>

                                        <tfoot>
                                            <tr>
                                                <td colspan="11">
                                                    <div class="span4">
                                                        <strong>Data&nbsp;:&nbsp;<span class="label label-info"><?php echo number_format($pager->items_total);?></span></strong>
                                                    </div>
                                                    <div class="span8">
                                                        <div class="right">
                                                            <?php echo $pager->display_pages();?>
                                                        </div>
                                                    </div>
                                                </td>											
                                            </tr>										
                                        </tfoot>
                                                                                
                                    </table>

                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-info">Tambah</button>
                                        <button type="button" class="btn" onclick="document.location.href='index.php?do=diklat_peserta&jadwalid=<?php echo $jadwalid; ?>'">Kembali</button>
                                    </div>

                                    <input name="userid" type="hidden" value="<?php echo $user->uid; ?>" />			
                                    <input name="jadwalid" type="hidden" value="<?php echo $jadwalid; ?>" />
                                    <input name="status" type="hidden" value="P" />

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
                                                
	<?php echo Core::doForm("processDiklat_PesertaAdd"); ?>

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
                                    data: 'viewDiklat_CalonPeserta=1&id=' + id,
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
                    