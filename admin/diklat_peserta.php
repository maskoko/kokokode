<?php
  /**
   * Main
   *
   * @package SIM PPPPTK BMTI
   * @author a2ngsa
   * @copyright 2012
   * @version $Id: diklat_peserta.php (admin), v1.00 2011-06-05 10:12:05 gewa Exp $
   */
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');

?>

        <!--Body content-->
        <div id="content" class="clearfix">
            <div class="contentwrapper"><!--Content wrapper-->

                <div class="heading">
                    <h3>Peserta Diklat</h3>                    
                </div><!-- End .heading-->
    				
                <!-- Build page from here: Usual with <div class="row-fluid"></div> -->

                <div class="row-fluid">
                    <div class="span12">

<?php switch(Filter::$action): case "add": ?>

	<?php include ("diklat_peserta_add.php"); ?>

<?php break; ?>

<?php case "edit": ?>

	<?php include ("diklat_peserta_edit.php"); ?>

<?php break; ?>


    <!------------------------ list --------------------------------------------- -->
	

<?php default: ?>

    <script type="text/javascript" src="js/diklat_peserta.js"></script>

	<?php
		
            if(isset(Filter::$get['jadwalid']))
                $jadwalid = Filter::$get['jadwalid'];
            else
                $jadwalid = 0;
                        
            if(isset(Filter::$get['searchfield']))
                $searchfield = Filter::$get['searchfield'];
            else
                $searchfield = 'nama';

            if(isset(Filter::$get['searchtext']))
                $searchtext = Filter::$get['searchtext'];
            else
                $searchtext = '';

            if(isset(Filter::$get['sortfield']))
                $sortfield = Filter::$get['sortfield'];
            else
                $sortfield = 'dp.nama_lengkap';

            if(isset(Filter::$get['sorttype']))
                $sorttype = Filter::$get['sorttype'];
            else
                $sorttype = 'ASC';
                        
            if(isset($_COOKIE['jadwal_tgl_dari']))
                $jadwal_tgl_dari = $_COOKIE['jadwal_tgl_dari'];
            else {
                $year = date('Y');
                $tgl_dari = mktime(0, 0, 0, 1, 1,  $year - 2);
                $jadwal_tgl_dari = date('d/m/Y', $tgl_dari);                    
            }

            if(isset($_COOKIE['jadwal_tgl_sampai'])) { 
                $jadwal_tgl_sampai = $_COOKIE['jadwal_tgl_sampai'];
            } else {                                        
                if(isset($_COOKIE['jadwal_tgl_dari'])) { 
                    $jadwal_tgl_sampai = $_COOKIE['jadwal_tgl_dari'];
                } else {
                    $year = date('Y');
                    $tgl_sampai = mktime(0, 0, 0, 12, 31,  $year);
                    $jadwal_tgl_sampai = date('d/m/Y', $tgl_sampai);
                }
            }

            $pg = (isset($_GET['pg']) and !empty($_GET['pg'])) ? intval(sanitize($_GET['pg'])) : 1;
            
	?>
		    
                        <div class="box">

                            <div class="title">
                                <h4>
                                    <span>Filter: (<?php echo $jadwal_tgl_dari . ' s.d ' . $jadwal_tgl_sampai; ?>)</span>
                                </h4>
                                <a href="#" class="minimize">Minimize</a>
                            </div>
                            
                            <div class="content">
                                <form id="filter_form" class="form form-horizontal" method="get" action="">
                                <fieldset>
                                    <input type="hidden" name="do" value="diklat_peserta">
                                    
                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">                                                
                                                <label class="form-label span2" for="checkboxes">Jadwal:</label>
                                                <div class="span8 controls">
                                                    <?php 
                                                    
                                                        $jadwal_tgl_dari = setToSQLdate($jadwal_tgl_dari);
                                                        $jadwal_tgl_sampai = setToSQLdate($jadwal_tgl_sampai);
                                                        $jadwal = $content->getDiklat_JadwalList($jadwal_tgl_dari, $jadwal_tgl_sampai);
                                                        
                                                    ?>
                                                    <select name="jadwalid" style="width:100%;" placeholder="Select...">
                                                        <option value="0"><?php echo lang('SELECT_ALL');?></option>
                                                        <?php if ($jadwal):?>
                                                            <?php foreach ($jadwal as $prow):?>
                                                                <option value="<?php echo $prow->id;?>" <?php if($prow->id == $jadwalid)echo 'selected="selected"';?>><?php echo $prow->nama_diklat." -- Kelas ".$prow->kelas;?></option>
                                                            <?php endforeach;?>
                                                            <?php unset($prow);?>
                                                        <?php endif;?>						
                                                    </select>
                                                </div>
                                                
                                            </div> <!-- end row-fluid -->
                                        </div>
                                    </div>
                                    
                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">
                                                <label class="form-label span2" for="checkboxes">Search:</label>
                                                <div class="span2 controls">
                                                    <select name="searchfield" id="searchfield" placeholder="Select..." style="width: 100%;">
                                                        <option value="dp.nama_lengkap" <?php if($searchfield == 'dp.nama_lengkap') echo 'selected="selected"';?>>Nama</option>
                                                        <option value="dp.nip" <?php if($searchfield == 'dp.nip') echo 'selected="selected"';?>>NIP</option>
                                                        <option value="dp.nuptk" <?php if($searchfield == 'dp.nuptk') echo 'selected="selected"';?>>NUPTK</option>
                                                        <option value="dp.nama_sekolah" <?php if($searchfield == 'dp.nama_sekolah') echo 'selected="selected"';?>>Nama Sekolah</option>
                                                    </select>
                                                </div>

                                                <label class="form-label span2" for="searchtext">Teks:</label>
                                                <input class="span4" type="text" name="searchtext" id="searchtext" value="<?php echo $searchtext; ?>" maxlength="50">
                                                <button type="submit" class="btn btn-info">Cari</button>
                                            </div> <!-- end .row-fluid -->                                            
                                        </div>
                                    </div> <!-- end .form-row row-fluid -->
                                    
                                    <input type="hidden" name="sortfield" id="sortfield" value="<?php echo $sortfield; ?>" >
                                    <input type="hidden" name="sorttype" id="sorttype" value="<?php echo $sorttype; ?>" >                                    
                                </fieldset>
                                </form>								
                            </div>

                        </div><!-- End filter .box -->

                    </div><!-- End .span12 -->
                </div><!-- End .row-fluid -->  

                <div class="row-fluid">
                    <div class="span12">
                        
                        <div id="msgholder"></div>

                        <?php $rows = $content->getDiklat_Peserta($jadwalid);?>

                        <table class="responsive table table-striped table-bordered table-sorting table-condensed">

                            <thead>
                                <tr>
                                    <th id="dp.nuptk" <?php
                                        if ($sortfield == "dp.nuptk") { 
                                            if ($sorttype == "ASC") 
                                                echo 'class="sorting_asc"'; 
                                            elseif ($sorttype == "DESC") 
                                                echo 'class="sorting_desc"'; 
                                            else 
                                                echo 'class="sorting"'; 
                                        } else 
                                            echo 'class="sorting"'; ?> width="60">NUPTK</th>
                                    <th id="dp.nama_lengkap" <?php 
                                        if ($sortfield == "dp.nama_lengkap") { 
                                            if ($sorttype == "ASC") 
                                                echo 'class="sorting_asc"'; 
                                            elseif ($sorttype == "DESC") 
                                                echo 'class="sorting_desc"'; 
                                            else echo 'class="sorting"'; 
                                        } else 
                                            echo 'class="sorting"'; ?>>Nama Lengkap</th>
                                    <th id="dp.nama_sekolah" <?php 
                                        if ($sortfield == "dp.nama_sekolah") { 
                                            if ($sorttype == "ASC") 
                                                echo 'class="sorting_asc"'; 
                                            elseif ($sorttype == "DESC") 
                                                echo 'class="sorting_desc"'; 
                                            else echo 'class="sorting"'; 
                                        } else 
                                            echo 'class="sorting"'; ?>>Sekolah</th>
                                    <th>Propinsi</th>
                                    <th>Kota</th>
                                    <?php if ($jadwalid == 0): ?>
                                        <th id="dk.nama_diklat" <?php 
                                            if ($sortfield == "dk.nama_diklat") { 
                                                if ($sorttype == "ASC") 
                                                    echo 'class="sorting_asc"'; 
                                                elseif ($sorttype == "DESC") 
                                                    echo 'class="sorting_desc"'; 
                                                else echo 'class="sorting"'; 
                                            } else 
                                                echo 'class="sorting"'; ?>>Diklat</th>
                                    <?php endif; ?>
                                        
                                    <th id="dj.tahun" <?php 
                                        if ($sortfield == "dj.tahun") { 
                                            if ($sorttype == "ASC") 
                                                echo 'class="sorting_asc"'; 
                                            elseif ($sorttype == "DESC") 
                                                echo 'class="sorting_desc"'; 
                                            else echo 'class="sorting"'; 
                                        } else 
                                            echo 'class="sorting"'; ?> width="30">Tahun</th>
                                    <th width="50">Status</th>
                                    <!-- <th width="80">Reg Awal</th> -->
                                    <!-- <th width="80">Reg Ulang</th> -->
                                    <?php if ($jadwalid != 0):?>
                                        <th style="<?php if(!$user->isProfileModuleExists('11', 'U')){echo 'display:none;';}?>"  width="120">
                                            <!-- <button type="button" class="btn btn-mini" title="Tambah Peserta Diklat Baru" onclick="location.href='index.php?do=diklat_peserta&amp;action=add&amp;jadwalid=<?php echo $jadwalid; ?>'"><span class="icon16 icomoon-icon-plus-2"></span></button> -->
                                            <a href="index.php?do=diklat_peserta&amp;action=add&amp;jadwalid=<?php echo $jadwalid; ?>" class="tip" title="Tambah Peserta Diklat Baru"><span class="icon16 icomoon-icon-plus-2"></span></a>|
                                            <a href="controller_print.php?action=createPrintRegistrasiDiklat<?php echo '&amp;jadwalid='.$jadwalid.'&amp;jenis=kecil'?>" class="tip" title="Print Kartu Kecil" target="_blank"><span class="icon24 icomoon-icon-printer-3"></span></a>|
                                            <a href="controller_print.php?action=createPrintRegistrasiDiklat<?php echo '&amp;jadwalid='.$jadwalid.'&amp;jenis=besar'?>" class="tip" title="Print Kartu Besar" target="_blank"><span class="icon24 icomoon-icon-printer-2"></span></a>
                                    <?php endif;?></th>
                                </tr>
                            </thead>

                            <tbody>

                            <?php if(!$rows):?>
                                <tr>
                                    <td colspan="<?php if ($jadwalid != 0) echo "8"; else echo "9"; ?>"><?php echo Filter::msgInfo(lang('NO_DATA'), false);?></td>
                                </tr>

                            <?php else:?>
                            <?php foreach ($rows as $row):?>

                                    <tr>
                                        <td align="center"><?php echo $row->nuptk;?></td>
                                        <td style="text-align: left;"><?php echo $row->nama_lengkap;?></td>
                                        <td style="text-align: left;"><?php echo $row->nama_sekolah;?></td>
                                        <td style="text-align: left;"><?php echo $row->nama_propinsi;?></td>
                                        <td style="text-align: left;"><?php echo $row->nama_kota;?></td>
                                        <?php if ($jadwalid == 0): ?>
                                            <td style="text-align: left;"><?php echo $row->nama_diklat;?></td>
                                        <?php endif; ?>
                                        <td><?php echo $row->tahun;?></td>
                                        <td><span class="label label-info"><?php echo $row->status_lulus;?></span></td>

                                        <?php 

                                        $regawal = '';
                                        $regulang = '';


                                        if(strtotime($row->reg_awal) !='')
                                            $regawal=date("d/m/Y",strtotime($row->reg_awal));
                                        if(strtotime($row->reg_ulang) !='')
                                            $regulang=date("d/m/Y",strtotime($row->reg_ulang));
                                         ?>

                                        <!-- <td><span class="label label-success"><?php echo $regawal; ?></span></td> -->
                                        <!-- <td><span class="label label-info"><?php echo $regulang; ?></span></td> -->
                                        
                                        <?php if ($jadwalid != 0):?>
                                            <td  style="<?php if(!$user->isProfileModuleExists('11', 'U')){echo 'display:none;';}?>"  width="130" align="center">
                                               <!--  <button class="btn tip btn-mini btn-primary"  title="Registrasi Cek" onclick="location.href='index.php?do=diklat_peserta&amp;action=edit&amp;id=<?php echo $row->id; ?>'" >Reg.Cek</button>&nbsp;&nbsp;   -->    

                                               <?php if($regawal == ''){ ?>
                                                <a href="javascript:void(0)" title="Registrasi Awal" class="tip doReg" data-id="<?php echo $row->id;?>" data-nama="<?php echo $row->nama_lengkap;?>"><span class="icon12 icomoon-icon-file"></span></a>|

                                                <?php }else{  ?>
                                                <span class="icon12 icomoon-icon-checkmark" title="sudah REGISTRASI AWAL"></span>|  
                                                <?php } ?>
                                               <!--  <button class="btn tip btn-mini btn-info"  title="Registrasi Ulang" onclick="location.href='index.php?do=diklat_peserta&amp;action=edit&amp;id=<?php echo $row->id; ?>'" >Reg.Ulang</button>&nbsp;| -->
                                               <a href="index.php?do=diklat_peserta&amp;action=edit&amp;id=<?php echo $row->id; ?>" title="Registrasi Ulang" class="tip doRegU"> <span class="icon12 icomoon-icon-book"></span></a>|
                                                <a href="javascript:void(0)" title="Hapus" class="tip doDelete" data-id="<?php echo $row->id;?>"><span class="icon12 icomoon-icon-remove"></span></a>|
                                                <a href="javascript:void(0)" title="Sinkron Data" class="tip doSync" data-id="<?php echo $row->id;?>"><span class="icon12 icomoon-icon-link"></span></a>
                                            </td>
                                        <?php endif;?>
                                    </tr>

                            <?php endforeach;?>
                            <?php unset($row);?>
                            <?php endif;?>					

                            </tbody>

                            <tfoot>
                                <tr>
                                    <td colspan="<?php if ($jadwalid != 0) echo "10"; else echo "9"; ?>">
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
						
<?php echo Core::doDelete(lang('DELCONFIRM_TITLE'), "deleteDiklat_Peserta", "a.tip.doDelete");?>	

                     <!-- Boostrap approve modal dialog -->
                    <div id="SyncModal" class="modal fade hide" >
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">
                                <span class="icon12 minia-icon-close"></span></button>
                            <h3>Sinkron Data Peserta</h3>
                        </div>
                        <div class="modal-body">
                            <p>Update data Profile berikut ?</p>
                        </div>
                        <div class="modal-footer">
                            <a href="#" id="updateBtn" class="btn btn-danger">Update</a>
                            <a href="#" class="btn" data-dismiss="modal">Batal</a>
                        </div>
                    </div>      

                     <!-- Boostrap reg awal modal dialog -->
                    <div id="RegCekModal" class="modal fade hide" >
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">
                                <span class="icon12 minia-icon-close"></span></button>
                            <h3>Registrasi Awal Data Peserta</h3>
                        </div>

                        <div class="modal-body">
                        <!-- <div class="form-row row-fluid">
                            <div class="span12">
                                <div class="row-fluid">
                                    <label class="span4" for="input" accept="image/*" >Upload foto Peserta :</label>
                                    <div class="span8 controls"><input type="file" id="input-id" name="foto"  accept=".jpg, .jpeg, .png"></div>
                                </div> 
                                <span class="help-block">*Foto akan tersimpan ketika anda menekan tombol <b>Register & Cetak Kartu Peserta!</b></span>
                                <div class="row-fluid"><br><img src='../foto/foto_ptk/poto_kosong.png' title='Poto Peserta' id="poto_peserta" name="poto_peserta" width="150" height="120"/></div>
                                
                            </div>
                        </div>
 -->
                        <!-- <hr> -->

                        <div class="form-row row-fluid">
                            <div class="span12">
                                <div class="row-fluid">
                                    <label> Registrasi Awal data peserta bernama <b><span id="nama"></span></b> berikut ? </label>
                                </div> <!-- end row-fluid -->
                            </div>
                        </div>
                       
                        <div class="modal-footer">
                            <a href="#" id="updateBtn" class="btn btn-warning">Register!</a>
                            <a href="#" class="btn" data-dismiss="modal">Batal</a>
                        </div>
                    </div>                   
                        
                     
    <script type="text/javascript">

        $(document).ready(function () {		  			

                $(".sorting, .sorting_asc, .sorting_desc").click(function(){

                    var sortfield  = $(this).attr("id");
                    var tclass =  $(this).attr("class");

                    if (tclass == "sorting_asc")
                      sorttype = "DESC"
                    else
                      sorttype = "ASC";

                    $('input[name=sortfield]').val(sortfield);
                    $('input[name=sorttype]').val(sorttype);

                    var values = $("#filter_form").serialize();

                    location.href = "index.php?" + values;
                });
              
                // -- sync diklat_peserta <= ptk / staff

                $('#SyncModal').on('show', function() {
                        var id = $(this).data('syncid'),
                            parent = $(this).data('parent');

                        $('#SyncModal a#updateBtn').on('click', function(e) {

                                $('#SyncModal').modal('hide'); // dismiss the dialog

                                $.ajax({
                                          type: 'post',
                                          url: 'controller.php',
                                          data: 'updateDiklat_Peserta=' + id,
                                          success: function (msg) {
                                                  $('#msgholder').html(msg);
                                                  setTimeout(function() {
                                                    var str = $('#filter_form').serialize();
                                                    window.location = "index.php?do=diklat_peserta&pg=" + <?php echo $pg; ?> + "&" + str;
                                                  }, 2000);
                                          }
                                });

                        });		

                })

                $('#SyncModal').on('hide', function() {

                        $('#SyncModal a#updateBtn').off('click');

                });

                $('.tip.doSync').click(function(e) {
                        e.preventDefault();

                        var id = $(this).data('id');
                        var parent = $(this).parent().parent();

                        $('#SyncModal').data({
                                'syncid': id,
                                'parent': parent
                        });

                        $('#SyncModal').modal('show');

                });		  		  

                // -- reg cek diklat_peserta <= ptk / staff

                $('#RegCekModal').on('show', function() {
                        var id = $(this).data('syncid'),
                            parent = $(this).data('parent'),
                            nama = $(this).data('nama');

                        // $('#nama').val(nama);
                        $('#nama').html(nama);

                        $('#RegCekModal a#updateBtn').on('click', function(e) {

                            if ($("#input-id").val()=='') {
                                alert("Foto wajib diisi terlebih dahulu!","Info");
                                return;
                            }

                                $('#RegCekModal').modal('hide'); // dismiss the dialog

                                $.ajax({
                                          type: 'post',
                                          url: 'controller.php',
                                          data: 'regawalDiklat_Peserta=' + id,
                                          success: function (msg) {
                                                  $('#msgholder').html(msg);
                                                  setTimeout(function() {
                                                    var str = $('#filter_form').serialize();
                                                    window.location = "index.php?do=diklat_peserta&pg=" + <?php echo $pg; ?> + "&" + str;
                                                  }, 2000);
                                          }
                                });

                        });     

                })

                $('#RegCekModal').on('hide', function() {

                        $('#RegCekModal a#updateBtn').off('click');

                });

                $('.tip.doReg').click(function(e) {
                        e.preventDefault();

                        var id = $(this).data('id');
                        var parent = $(this).parent().parent();
                        var nama = $(this).data('nama');


                        $('#RegCekModal').data({
                                'syncid': id,
                                'parent': parent,
                                'nama':nama
                        });

                        $('#RegCekModal').modal('show');

                });               



        });	

        $(function(){
        $("#input-id").on('change', function(event) {
            var file = event.target.files[0];
            var filePath = $(this).val();

            if(file.size>=2*1024*1024) {
                alert("Ukuran file gambar maksimum adalah 2MB");
                $("#form-id").get(0).reset(); //the tricky part is to "empty" the input file here I reset the form.
                return;
            }

            if((!file.type.match('image/*'))) {
                alert("Harus berupa file gambar JPG");
                $("#form-id").get(0).reset(); //the tricky part is to "empty" the input file here I reset the form.
                return;
            }

            var fileReader = new FileReader();
            fileReader.onload = function(e) {
                var int32View = new Uint8Array(e.target.result);
                //verify the magic number
                // for JPG is 0xFF 0xD8 0xFF 0xE0 (see https://en.wikipedia.org/wiki/List_of_file_signatures)
                if(!int32View.length>4 && !int32View[0]==0xFF && !int32View[1]==0xD8 && !int32View[2]==0xFF && !int32View[3]==0xE0) {
                    alert("Harus berupa file gambar JPG");
                    $("#form-id").get(0).reset(); //the tricky part is to "empty" the input file here I reset the form.
                    return;
                }
                else
                    {   
                        // alert(file.name);
                        // $("#poto_peserta").attr("src",file.name);
                        var reader = new FileReader();

                                        reader.onload = function (e) {
                                            $('#poto_peserta').attr('src', e.target.result);
                                        }

                                        reader.readAsDataURL(event.target.files[0]);
                    }
            };
            fileReader.readAsArrayBuffer(file);
        });
    });	  

    </script>                     
                     
<?php break;?>
<?php endswitch;?>

                    </div><!-- End .span12 -->
                </div><!-- End .row-fluid -->  

            </div><!-- End contentwrapper -->
        </div><!-- End #content -->
    
    </div><!-- End #wrapper -->
        
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
