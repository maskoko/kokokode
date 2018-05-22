<?php
  /**
   * Main
   *
   * @package SIM PPPPTK BMTI
   * @author a2ngsa
   * @copyright 2012
   * @version $Id: pn_diklat_agenda.php (admin), v1.00 2011-06-05 10:12:05 gewa Exp $
   */
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
	  
  
?>

	<?php
                
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
                                
	?>

        <!--Body content-->
        <div id="content" class="clearfix">
            <div class="contentwrapper"><!--Content wrapper-->

                <div class="heading">
                    <h3>Agenda Diklat</h3>
                </div><!-- End .heading-->
    				
                <!-- Build page from here: Usual with <div class="row-fluid"></div> -->


<?php switch(Filter::$action): case "edit": ?>

                <script type="text/javascript" src="js/pn_diklat_agenda_edit.js"></script>

                <div class="row-fluid">
                    <div class="span12">

                        <div id="msgholder"></div>
                                                
                        <div class="box">

                            <div class="title">
                                <h4> 
                                    <span>Edit Agenda</span>
                                </h4>								
                            </div>

                            <div class="content">

                                <?php 
                                    $row = Core::getRowById("diklat_agenda", Filter::$id);
                                    
                                    $jadwal_tgl_dari = setToSQLdate($jadwal_tgl_dari);
                                    $jadwal_tgl_sampai = setToSQLdate($jadwal_tgl_sampai);                                    
                                    $jadwal = $content->getDiklat_JadwalList($jadwal_tgl_dari, $jadwal_tgl_sampai);
                                    
                                    $mata_tatar = $content->getDiklat_Mata_TatarList();
                                ?>

                                <form id="admin_form" class="form-horizontal" method="post" action="">
                                <fieldset>

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <label class="form-label span4" for="checkboxes">Jadwal Diklat:</label>
                                                <div class="span8 controls">
                                                    <select name="jadwalid" id="jadwalid">
                                                        <option value=""><?php echo lang('SELECT');?></option>
                                                        <?php if ($jadwal):?>
                                                            <?php foreach ($jadwal as $prow):?>
                                                                <option value="<?php echo $prow->id;?>" <?php if($prow->id == $row->jadwalid)echo 'selected="selected"';?>><?php echo $prow->nama_diklat." -- Kelas ".$prow->kelas.'( '.$prow->tgl_mulai.' )';?></option>
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
                                                <label class="form-label span4" for="normal">Tanggal:</label>
                                                <input type="text" class="span2 required" name="tanggal" id="tanggal" value="<?php echo $row->tanggal; ?>"/>
                                            </div> 													
                                        </div>
                                    </div>

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <label class="form-label span4" for="normal">Waktu Absen:</label>
                                                <input type="text" class="span2 required" name="waktu_dari" id="waktu_dari" autocomplete="off" value="<?php echo $row->waktu_dari; ?>"/>
                                                <input type="text" class="span2 required" name="waktu_sampai" id="waktu_sampai" autocomplete="off" value="<?php echo $row->waktu_sampai; ?>"/>
                                            </div> 													
                                        </div>
                                    </div>

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <label class="form-label span4" for="checkboxes">Mata Tatar:</label>
                                                <div class="span8 controls">
                                                    <select name="mata_tatarid" id="mata_tatarid">
                                                        <option value=""><?php echo lang('SELECT');?></option>
                                                        <?php if ($mata_tatar):?>
                                                            <?php foreach ($mata_tatar as $prow):?>
                                                                <option value="<?php echo $prow->id;?>" <?php if($prow->id == $row->jadwalid)echo 'selected="selected"';?>><?php echo $prow->nama_mata_tatar;?></option>
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
                                                <label class="form-label span4" for="normal">Nama Tempat:</label>
                                                <input type="text" class="span8 required" name="nama_tempat" id="nama_tempat" value="<?php echo $row->nama_tempat;?>"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <label class="form-label span4" for="normal">Nama Pengajar:</label>
                                                <input type="text" class="span8 required" name="nama_pengajar" id="nama_pengajar" value="<?php echo $row->nama_pengajar;?>"/>
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

<?php echo Core::doForm("processDiklat_Agenda"); ?> 	

                            </div> <!-- end .content -->
                                    
                        </div><!-- End .box -->

                    </div><!-- End .span12 -->
                </div><!-- End .row-fluid -->  
		
<?php break; ?>

    <!------------------------ add --------------------------------------------- -->


<?php case "add": ?>

    <script type="text/javascript" src="js/pn_diklat_agenda_edit.js"></script>

	<?php
		
		if(isset(Filter::$get['jadwalid']))
                    $jadwalid = Filter::$get['jadwalid'];
		else
                    $jadwalid = 0;
			
	?>
		
                <div class="row-fluid">
                    <div class="span12">

                        <div id="msgholder"></div>
                        
                        <div class="box">

                            <div class="title">
                                <h4> 
                                    <span>Tambah Agenda</span>
                                </h4>								
                            </div>

                            <div class="content">

                                <?php 
                                
                                    $jadwal_tgl_dari = setToSQLdate($jadwal_tgl_dari);
                                    $jadwal_tgl_sampai = setToSQLdate($jadwal_tgl_sampai);                                
                                    $jadwal = $content->getDiklat_JadwalList($jadwal_tgl_dari, $jadwal_tgl_sampai);
                                    
                                    $mata_tatar = $content->getDiklat_Mata_TatarList();
                                ?>

                                <form id="admin_form" class="form-horizontal" method="post" action="">
                                <fieldset>

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <label class="form-label span4" for="checkboxes">Jadwal Diklat:</label>
                                                <div class="span8 controls">
                                                    <select name="jadwalid" id="jadwalid">
                                                        <option value=""><?php echo lang('SELECT');?></option>
                                                        <?php if ($jadwal):?>
                                                            <?php foreach ($jadwal as $prow):?>
                                                                <option value="<?php echo $prow->id;?>" <?php if($prow->id == $jadwalid)echo 'selected="selected"';?>><?php echo $prow->nama_diklat." -- Kelas ".$prow->kelas.'( '.$prow->tgl_mulai.' )';?></option>
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
                                                <label class="form-label span4" for="normal">Tanggal:</label>
                                                <input type="text" class="span2 datepickerField required" name="tanggal" id="tanggal" value="<?php echo date('d/m/Y'); ?>"/>
                                            </div> 													
                                        </div>
                                    </div>

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <label class="form-label span4" for="normal">Waktu Dari - Sampai:</label>
                                                <input type="text" class="span2 required" name="waktu_dari" id="waktu_dari" autocomplete="off" value="<?php echo date('H-i'); ?>"/>
                                                <input type="text" class="span2 required" name="waktu_sampai" id="waktu_sampai" autocomplete="off" value="<?php echo date('H-i'); ?>"/>
                                            </div> 													
                                        </div>
                                    </div>

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <label class="form-label span4" for="checkboxes">Mata Tatar:</label>
                                                <div class="span8 controls">
                                                    <select name="mata_tatarid" id="mata_tatarid">
                                                        <option value=""><?php echo lang('SELECT');?></option>
                                                        <?php if ($mata_tatar):?>
                                                            <?php foreach ($mata_tatar as $prow):?>
                                                                <option value="<?php echo $prow->id;?>"><?php echo $prow->nama_mata_tatar;?></option>
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
                                                <label class="form-label span4" for="normal">Nama Tempat:</label>
                                                <input type="text" class="span8 required" name="nama_tempat" id="nama_tempat" maxlength="60" value=""/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <label class="form-label span4" for="normal">Nama Pengajar:</label>
                                                <input type="text" class="span8 required" name="nama_pengajar" id="nama_pengajar" maxlength="60" value=""/>
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

<?php echo Core::doForm("processDiklat_Agenda"); ?> 	

                            </div><!-- End .content -->

                        </div><!-- End .box -->

                    </div><!-- End .span12 -->
                </div><!-- End .row-fluid -->  

<?php break; ?>


    <!------------------------ list --------------------------------------------- -->
	

<?php default: ?>

	<?php
	
	
		if(isset(Filter::$get['jadwalid']))
                    $jadwalid = Filter::$get['jadwalid'];
		else
                    $jadwalid = 0;
	?>

                <div class="row-fluid">
                    <div class="span12">

                        <div class="box">

                            <div class="title">
                                <h4>
                                    <span>Filter: (<?php echo $jadwal_tgl_dari . ' s.d ' . $jadwal_tgl_sampai; ?>)</span>
                                </h4>
                                <a href="#" class="minimize">Minimize</a>
                            </div>
                            
                            <div class="content">
                                
                                <form class="form form-horizontal" method="get" action="">
                                <fieldset>
                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">
                                                
                                                <div class="span8">
                                                    <label class="form-label span2" for="checkboxes">Jadwal:</label>
                                                    <div class="span8">
                                                        <?php 
                                                        
                                                            $jadwal_tgl_dari = setToSQLdate($jadwal_tgl_dari);
                                                            $jadwal_tgl_sampai = setToSQLdate($jadwal_tgl_sampai);
                                                            $jadwal = $content->getDiklat_JadwalList($jadwal_tgl_dari, $jadwal_tgl_sampai);
                                                            
                                                        ?>
                                                        <select name="jadwalid" onchange="window.location='index.php?do=pn_diklat_agenda&amp;jadwalid='+this[this.selectedIndex].value+''" style="width:100%;" placeholder="Select...">
                                                            <option value="0"><?php echo lang('SELECT_ALL');?></option>
                                                            <?php if ($jadwal):?>
                                                                <?php foreach ($jadwal as $prow):?>
                                                                    <option value="<?php echo $prow->id;?>" <?php if($prow->id == $jadwalid)echo 'selected="selected"';?>><?php echo $prow->nama_diklat." -- Kelas ".$prow->kelas;?></option>
                                                                <?php endforeach;?>
                                                                <?php unset($prow);?>
                                                            <?php endif;?>						
                                                        </select>
                                                    </div>
                                                </div>
                                                
                                            </div> <!-- end row-fluid -->
                                        </div>
                                    </div>		
                                </fieldset>
                                </form>
                                
                            </div>

                        </div><!-- End filter .box -->

                    </div><!-- End .span12 -->
                </div><!-- End .row-fluid -->  

                <div class="row-fluid">
                    <div class="span12">

                        <div id="msgholder"></div>

                        <?php $rows = $content->getDiklat_Agenda();?>
                            
                        <table class="responsive table table-striped table-bordered table-sorting table-condensed">

                            <thead>
                                <tr>
                                    <th width="50">Tanggal</th>
                                    <th>Dari</th>
                                    <th>Sampai</th>
                                    <th>Mata Tatar</th>
                                    <th>Pengajar</th>
                                    <th>Tempat</th>
                                    <th  style="<?php if(!$user->isProfileModuleExists('14', 'U')){echo 'display:none;';}?>" width="100">
                                        <?php if ($jadwalid > 0) : ?>
                                            <button type="button" class="btn btn-mini" onclick="location.href='index.php?do=pn_diklat_agenda&amp;action=add&amp;jadwalid=<?php echo $jadwalid; ?>'"><span class="icon16 icomoon-icon-plus-2"></span>Tambah</button>
                                        <?php endif; ?>
                                    </th>
                                </tr>
                            </thead>

                            <tbody>

                                <?php if(!$rows):?>
                                <tr>
                                    <td colspan="7"><?php echo Filter::msgInfo(lang('NO_DATA'), false);?></td>
                                </tr>

                                <?php else:?>
                                <?php foreach ($rows as $row):?>

                                <tr>
                                    <td align="center"><?php echo $row->tanggal;?></td>
                                    <td align="center"><?php echo $row->waktu_dari;?></td>
                                    <td align="center"><?php echo $row->waktu_sampai;?></td>
                                    <td style="text-align: left;"><?php echo $row->nama_mata_tatar;?></td>
                                    <td style="text-align: left;"><?php echo $row->nama_pengajar;?></td>
                                    <td style="text-align: left;"><?php echo $row->nama_tempat;?></td>											
                                    <td  style="<?php if(!$user->isProfileModuleExists('14', 'U')){echo 'display:none;';}?>" align="center">
                                        <a href="index.php?do=pn_diklat_agenda&amp;action=edit&amp;id=<?php echo $row->id;?>" title="Edit" class="tip"><span class="icon12 icomoon-icon-pencil"></span></a>
                                        <a href="javascript:void(0)" title="Hapus" class="tip doDelete" data-id="<?php echo $row->id;?>"><span class="icon12 icomoon-icon-remove"></span></a>
                                    </td>
                                </tr>

                                <?php endforeach;?>
                                <?php unset($row);?>
                                <?php endif;?>					

                            </tbody>

                            <tfoot>
                                <tr>
                                    <td colspan="7">
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

<?php echo Core::doDelete(lang('DELCONFIRM_TITLE'), "deleteDiklat_Agenda");?>

                    </div><!-- End .span12 -->
                </div><!-- End .row-fluid -->  
		
	<script type="text/javascript">
		
		  $(document).ready(function () {
	
			if($('#tgl_dari').length) {
				$("#tgl_dari").datepicker({
					dateFormat: "dd/mm/yy",
					defaultDate: "+1w",
					changeMonth: true,
                                        changeYear: true,
					numberOfMonths: 1,
					onSelect: function( selectedDate ) {
						$( "#tgl_sampai" ).datepicker( "option", "minDate", selectedDate );			
					}
				});
			}

			if($('#tgl_sampai').length) {
				$("#tgl_sampai").datepicker({
					dateFormat: "dd/mm/yy",
					defaultDate: "+1w",
					changeMonth: true,
                                        changeYear: true,
					numberOfMonths: 1,
					onSelect: function( selectedDate ) {
						$( "#tgl_dari" ).datepicker( "option", "maxDate", selectedDate );
					}			
				});
			}
			
		  });
	
	</script>
		
<?php break;?>
<?php endswitch;?>

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
    <script type="text/javascript" src="plugins/forms/timeentry/jquery.timeentry.min.js"></script>
            
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
