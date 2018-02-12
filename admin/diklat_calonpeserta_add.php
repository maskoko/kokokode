
    <script type="text/javascript" src="js/diklat_calonpeserta_add.js"></script>

	<?php
            if(isset(Filter::$get['jadwalid']))
                $jadwalid = Filter::$get['jadwalid'];
            else
                $jadwalid = 0;

            if(isset(Filter::$get['status']))
                $status = Filter::$get['status'];
            else
                $status = 'P';

            if(isset(Filter::$get['jenis']))
                $jenis = Filter::$get['jenis'];
            else
                $jenis = 'P';
                                    
            if(isset(Filter::$get['diklatid']))
                $diklatid = Filter::$get['diklatid'];
            else
                $diklatid = 0;
            
            if(isset(Filter::$get['diklat_tahun']))
                $diklat_tahun = Filter::$get['diklat_tahun'];
            else
                $diklat_tahun = date('Y');
            
            if(isset(Filter::$get['propinsi_kode']))
                $propinsi_kode = Filter::$get['propinsi_kode'];
            else
                $propinsi_kode = '';

            if(isset(Filter::$get['kota_kode']))
                $kota_kode = Filter::$get['kota_kode'];
            else
                $kota_kode = '';

            if(isset(Filter::$get['searchfield']))
                $searchfield = Filter::$get['searchfield'];
            else
                $searchfield = 'nama';
                
            if(isset(Filter::$get['searchtext']))
                $searchtext = Filter::$get['searchtext'];
            else
                $searchtext = '';
                                
	?>

                        <div class="box">

                            <div class="title">
                                <h4>
                                    <span>Filter :</span>
                                </h4>
                                <a href="#" class="minimize">Minimize</a>
                            </div>
                            
                            <div class="content">
                                <form class="form form-horizontal" method="get" action="">
                                <fieldset>
                                    <input type="hidden" name="do" value="diklat_calonpeserta">
                                    <input type="hidden" name="action" value="add">
                                    <input type="hidden" name="jadwalid" value="<?php echo $jadwalid; ?>">

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">
                                                <label class="form-label span2" for="checkboxes">Propinsi:</label>
                                                <div class="span4 controls">
                                                    <?php $propinsi = $content->getPropinsiList();?>						
                                                    <select name="propinsi_kode" id="propinsi_kode" style="width:100%;" placeholder="Select...">
                                                        <option value=""><?php echo lang('SELECT_ALL');?></option>
                                                        <?php if ($propinsi):?>
                                                            <?php foreach ($propinsi as $prow):?>
                                                                <option value="<?php echo $prow->kode;?>" <?php if($prow->kode == $propinsi_kode)echo 'selected="selected"';?>><?php echo $prow->nama_propinsi;?></option>
                                                            <?php endforeach;?>
                                                            <?php unset($prow);?>
                                                        <?php endif;?>						
                                                    </select>
                                                </div>

                                                <label class="form-label span2" for="checkboxes">Kota/Kab:</label>
                                                <div class="span4 controls">
                                                    <?php $kota = $content->getKotaByPropinsiList($propinsi_kode);?>
                                                    <select name="kota_kode" id="kota_kode" style="width:100%;" placeholder="Select...">
                                                        <option value="" <?php if($kota_kode == "")echo 'selected="selected"';?>><?php echo lang('SELECT_ALL');?></option>
                                                        <?php if ($kota):?>
                                                            <?php foreach ($kota as $prow):?>
                                                                <option value="<?php echo $prow->kode;?>" <?php if($prow->kode == $kota_kode)echo 'selected="selected"';?>><?php echo $prow->nama_kota;?></option>
                                                            <?php endforeach;?>
                                                            <?php unset($prow);?>
                                                        <?php endif;?>						
                                                    </select>
                                                </div>
                                            </div> <!-- end row-fluid -->
                                        </div>
                                    </div>

                                    <?php if ($jenis == 'P'):?>
                                    
                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">
                                                <label class="form-label span2" for="checkboxes">Diklat:</label>
                                                <div class="span4 controls">
                                                    <?php $diklat = $content->getDiklatList();?>						
                                                    <select name="diklatid" id="diklatid" style="width:100%;" placeholder="Select...">
                                                        <option value=""><?php echo lang('SELECT_ALL');?></option>
                                                        <?php if ($diklat):?>
                                                            <?php foreach ($diklat as $prow):?>
                                                                <option value="<?php echo $prow->id;?>" <?php if($prow->id == $diklatid)echo 'selected="selected"';?>><?php echo $prow->nama_diklat;?></option>
                                                            <?php endforeach;?>
                                                            <?php unset($prow);?>
                                                        <?php endif;?>						
                                                    </select>
                                                </div>

                                                <label class="form-label span2" for="normal">Tahun:</label>
                                                <input class="span2" style="width: 60px;" type="text" name="diklat_tahun" id="diklat_tahun" value="<?php echo $diklat_tahun; ?>" maxlength="4">
                                            </div> <!-- end row-fluid -->
                                        </div>
                                    </div>
                                    
                                    <?php endif;?>
                                    
                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">
                                                <label class="form-label span2" for="checkboxes">Search:</label>
                                                <div class="span2 controls">
                                                    <select name="searchfield" id="searchfield" placeholder="Select..." style="width: 100%;">
                                                        <option value="nama_lengkap" <?php if($searchfield == 'nama_lengkap') echo 'selected="selected"';?>>Nama</option>
                                                        <option value="nip" <?php if($searchfield == 'nip') echo 'selected="selected"';?>>NIP</option>
                                                        <option value="nuptk" <?php if($searchfield == 'nuptk') echo 'selected="selected"';?>>NUPTK</option>
                                                    </select>
                                                </div>

                                                <label class="form-label span2" for="searchtext">Teks:</label>
                                                <input class="span4" type="text" name="searchtext" id="searchtext" value="<?php echo $searchtext; ?>" maxlength="50">
                                                <button type="submit" class="btn btn-info">Cari</button>
                                                
                                            </div>
                                            
                                        </div>
                                    </div>
                                    
                                    <input name="status" type="hidden" value="<?php echo $status; ?>" />
                                    <input name="jenis" type="hidden" value="<?php echo $jenis; ?>" />
                                </fieldset>
                                </form>								
                            </div>

                        </div><!-- End filter .box -->
      
                    </div><!-- End .span12 -->
                </div><!-- End .row-fluid -->  

                <div class="row-fluid">
                    <div class="span12">

                        <div id="msgholder"></div>                        
                        
                        <div class="box">

                            <div class="title">
                                <h4>
                                    <span class="icon16 icomoon-icon-graduation"></span>
                                    
                                    <?php $row = $content->getDiklat_JadwalById($jadwalid); ?>
                                    
                                    <span>Pilih <?php if ($jenis == 'P') echo "(PTK)"; else echo "(Staff)";?> Calon Peserta Diklat : <?php echo $row->kode . ' / ' . $row->nama_diklat; ?></span>
                                    
                                    <?php unset($row); ?>
                                </h4>
                            </div>
                            
                            <div class="content">

                                <?php 
                                
                                    if ($jenis == 'P')
                                        $rows = $content->getPTKByDiklatMinat();
                                    else
                                        $rows = $rows = $content->getStaff();
                                                                
                                ?>

                                <form id="admin_form" method="post" action="">
                                <fieldset>

                                    <table class="responsive table table-striped table-bordered table-sorting table-condensed" id="checkAll">

                                        <thead>
                                            <tr>
                                                <th width="40" id="masterCh" class="ch"><input type="checkbox" name="checkbox" value="all" class="styled" /></th>
                                                <th width="70">NUPTK</th>
                                                <th>Nama Lengkap</th>
                                                <th><?php if ($jenis == 'P') echo 'Sekolah'; else echo 'Lembaga'; ?></th>
                                                <th>Propinsi</th>
                                                <th>Kota</th>
                                                <?php 
                                                    if ($jenis == 'P') {
                                                        if ($diklatid == 0) echo "<th>Kode Diklat</th><th>Nama Diklat</th>"; 
                                                    }
                                                ?>
                                                <th width="70">NIP</th>
                                                <th width="50">Info</th>
                                            </tr>
                                        </thead>

                                        <tbody>

                                        <?php if(!$rows):?>
                                            <tr>
                                                <td colspan="<?php if ($jenis == 'P') { if ($diklatid == 0) echo "10"; else echo "8";} else echo "8"; ?>"><?php echo Filter::msgInfo(lang('NO_DATA'), false);?></td>
                                            </tr>

                                        <?php else:?>
                                        <?php foreach ($rows as $row):?>

                                            <tr>
                                                <input type="hidden" name="instansiid[]" id="instansi_<?php if ($jenis == 'P') echo $row->ptkid; else echo $row->id; ?>" value="<?php if ($jenis == 'P') echo $row->sekolahid; else echo $row->lembagaid; ?>" disabled="disabled">
                                                
                                                <td class="chChildren"><input type="checkbox" name="personid[]" value="<?php if ($jenis == 'P') echo $row->ptkid; else echo $row->id; ?>" class="styled"/></td>
                                                <td style="text-align: left;"><?php echo $row->nuptk;?></td>
                                                <td style="text-align: left;"><?php echo $row->nama_lengkap;?></td>
                                                <td style="text-align: left;"><?php if ($jenis == 'P') echo $row->nama_sekolah; else echo $row->nama_lembaga;?></td>
                                                <td style="text-align: left;"><?php echo $row->nama_propinsi;?></td>
                                                <td style="text-align: left;"><?php echo $row->nama_kota;?></td>
                                                
                                                <?php 
                                                    if ($jenis == 'P') {
                                                        if ($diklatid == 0) 
                                                            echo '<td style="text-align: left;">' .$row->kode . '</td><td style="text-align: left;">' .$row->nama_diklat . '</td>';
                                                    }
                                                ?>
                                                
                                                <td style="text-align: left;"><?php echo $row->nip;?></td>
                                                <td align="center">
                                                    <a href="javascript:void(0)" title="" class="tip view" data-id="<?php if ($jenis == 'P') echo $row->ptkid; else echo $row->id; ?>" data-toggle="modal"><span class="icon12 icomoon-icon-search-3"></span></a>
                                                </td>
                                            </tr>

                                        <?php endforeach;?>
                                        <?php unset($row);?>
                                        <?php endif;?>					

                                        </tbody>

                                        <tfoot>
                                            <tr>
                                                <td colspan="<?php if ($jenis == 'P') { if ($diklatid == 0) echo "10"; else echo "8";} else echo "8"; ?>">
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
                                        <button type="button" class="btn" onclick="document.location.href='index.php?do=diklat_calonpeserta&amp;jadwalid=<?php echo $jadwalid; ?>&amp;status=<?php echo $status; ?>'">Kembali</button>
                                    </div>

                                    <input name="jadwalid" type="hidden" value="<?php echo $jadwalid; ?>" />
                                    <input name="jenis" type="hidden" value="<?php echo $jenis; ?>" />
                                    <input name="status" type="hidden" value="<?php echo $status; ?>" />
                                    <input name="userid" type="hidden" value="<?php echo $user->uid; ?>" />

                                </fieldset>				
                                </form>
			
                            <?php echo Core::doForm("processDiklat_CalonPeserta"); ?> 	

                            </div> <!-- end .content -->
                        </div> <!-- end .box -->
                        
                    <!-- Boostrap approve modal dialog -->
                    <div id="ptkModal" class="modal hide fade" style="display: none; ">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal"><span class="icon12 minia-icon-close"></span></button>
                          <h3>Info PTK/Staff</h3>
                        </div>

                        <div class="modal-body">		
                            <div id="modalContent" style="display:none;">
                            </div>
                        </div>

                        <div class="modal-footer">
                          <a href="#" class="btn" data-dismiss="modal">Close</a>
                        </div>
                      </div>
                        
                        
	<script type="text/javascript">

                $(document).ready(function () {
		  
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

                    $('a.tip.view').live('click', function () {

                            $('#ptkModal').modal();

                            return false;
                    });
		  
                  
                    $("a[data-toggle=modal]").click(function() {
                    
                            var id = $(this).data('id');
                            
                            $.ajax({
                                    cache: false,
                                    type: 'GET',
                                    url: '<?php if ($jenis == "P") echo "controller_ptk.php"; else echo "controller_staff.php"; ?>',
                                    data: '<?php if ($jenis == "P") echo "viewPTKInfoMinat="; else echo "viewStaffInfo="; ?>' + id,
                                    success: function(html) 
                                    {
                                            $('#ptkModal').show();
                                            $('#modalContent').show().html(html);
                                    }
                            });
                            
                    }); 
                                                                                
                                        
                });		  
		  		 		 

		$('#admin_form').submit(function() {
			var checkCount = 0;
			
                        // -- reset disabled --
                        
                        $('#admin_form input[type=checkbox]').each(function() {
                                var name = $(this).attr('name');

                                if (name == 'personid[]') {
                                    var value = this.value;
                                    
                                    $("#admin_form input[id=instansi_" + value + "]").attr("disabled", "disabled");
                                    
                                    //alert ($("#admin_form input[id=instansi_" + value + "]").attr("id") + ' :: ' +
                                    // $("#admin_form input[id=instansi_" + value + "]").attr("disabled"));
                                }                            
                            }
                        );                        
                        
                        
			$("#checkAll tr .chChildren input:checkbox").each(function() {

                                var name = $(this).attr('name');

				if (this.checked) {
                                    checkCount++;
					
                                    var value = this.value;
                                    $("#admin_form input[id=instansi_" + value + "]").removeAttr("disabled");

                                    //this.checked = false;
                                    //if (false == this.checked) {
                                    //        $(this).closest('.checker > span').removeClass('checked');
                                    //}


                            }
			});
                        
			if (checkCount == 0) 
			 return false;
		});
						 
	</script>
                        