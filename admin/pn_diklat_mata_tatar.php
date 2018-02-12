<?php
  /**
   * Main
   *
   * @package SIM PPPPTK BMTI
   * @author a2ngsa
   * @copyright 2012
   * @version $Id: pn_diklat_mata_tatar.php (admin), v1.00 2011-06-05 10:12:05 gewa Exp $
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
                    <h3>Mata Tatar Diklat</h3>                    
                </div><!-- End .heading-->
    				
                <!-- Build page from here: Usual with <div class="row-fluid"></div> -->

                <div class="row-fluid">
                    <div class="span12">

                        <div id="msgholder"></div>
                        
                        <div class="box">

<?php switch(Filter::$action): case "edit": ?>

                            <div class="title">
                                <h4> 
                                    <span>Edit Mata Tatar</span>
                                </h4>								
                            </div>

                            <div class="content">

                                <?php 
                                    $row = Core::getRowById("diklat_mata_tatar", Filter::$id);
                                    $jadwal = $content->getDiklat_JadwalList($jadwal_tgl_dari, $jadwal_tgl_sampai);
                                ?>

                                <form id="admin_form" class="form-horizontal" method="post" action="">
                                <fieldset>
                                    
                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <label class="form-label span4" for="normal">Kode:</label>
                                                <input type="text" class="span2 required" name="kode" id="kode" value="<?php echo $row->kode;?>" maxlength="10" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <label class="form-label span4" for="checkboxes">Jadwal Diklat:</label>
                                                <div class="span8 controls">
                                                    <select name="jadwalid" id="jadwalid">
                                                        <option value=""><?php echo lang('SELECT');?></option>
                                                        <?php if ($jadwal):?>
                                                            <?php foreach ($jadwal as $prow):?>
                                                                <option value="<?php echo $prow->id;?>" <?php if($prow->id == $row->jadwalid)echo 'selected="selected"';?>><?php echo $prow->nama_diklat.'( '.$prow->tgl_mulai.' )';?></option>
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
                                                <label class="form-label span4" for="normal">Nama Mata Tatar:</label>
                                                <input type="text" class="span8 required" name="nama_mata_tatar" id="nama_mata_tatar" value="<?php echo $row->nama_mata_tatar;?>" maxlength="80" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <label class="form-label span4" for="normal">Nama Pengajar:</label>
                                                <input type="text" class="span8 required" name="nama_pengajar" id="nama_pengajar" value="<?php echo $row->nama_mata_tatar;?>" maxlength="60" />
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

		<?php echo Core::doForm("processDiklat_Mata_Tatar"); ?> 	
                                
                            </div> <!-- end .content -->
		
<?php break; ?>

    <!------------------------ add ----------------------------------------------->


<?php case "add": ?>

                            <div class="title">
                                <h4> 
                                    <span>Tambah Mata Tatar</span>
                                </h4>								
                            </div>

                            <div class="content">

                                <?php 
                                
                                    $jadwal_tgl_dari = setToSQLdate($jadwal_tgl_dari);
                                    $jadwal_tgl_sampai = setToSQLdate($jadwal_tgl_sampai);
                                    $jadwal = $content->getDiklat_JadwalList($jadwal_tgl_dari, $jadwal_tgl_sampai);
                                    
                                ?>

                                <form id="admin_form" class="form-horizontal" method="post" action="">
                                <fieldset>
                                    
                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <label class="form-label span4" for="normal">Kode:</label>
                                                <input type="text" class="span2 required" name="kode" id="kode" value="" maxlength="10" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <label class="form-label span4" for="checkboxes">Jadwal Diklat:</label>
                                                <div class="span8 controls">
                                                    <select name="jadwalid" id="jadwalid">
                                                        <option value=""><?php echo lang('SELECT');?></option>
                                                        <?php if ($jadwal):?>
                                                            <?php foreach ($jadwal as $prow):?>
                                                                <option value="<?php echo $prow->id;?>"><?php echo $prow->nama_diklat.'( '.$prow->tgl_mulai.' )';?></option>
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
                                                <label class="form-label span4" for="normal">Nama Mata Tatar:</label>
                                                <input type="text" class="span8 required" name="nama_mata_tatar" id="nama_mata_tatar" maxlength="80" value=""/>
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

		<?php echo Core::doForm("processDiklat_Mata_Tatar"); ?> 	
                                
                            </div> <!-- end .content -->
		
<?php break; ?>


    <!------------------------ list ----------------------------------------------->
	

<?php default: ?>

                            <?php $rows = $content->getDiklat_Mata_Tatar();?>
        
                            <div class="title">
                                <h4>
                                    <span class="icon16 icomoon-icon-calendar"></span>
                                    <span>Mata Tatar</span>                                       
                                </h4>																				
                            </div>
    
                            <div class="content">

                                <table class="responsive table table-striped table-bordered table-sorting table-condensed">

                                    <thead>
                                        <tr>
                                            <th width="50">Kode</th>
                                            <th>Nama Mata Tatar</th>
                                            <th>Pengajar</th>
                                            <th width="100"><button type="button" class="btn btn-mini" onclick="location.href='index.php?do=pn_diklat_mata_tatar&amp;action=add'"><span class="icon16 icomoon-icon-plus-2"></span>Tambah</button></th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                        <?php if(!$rows):?>
                                        <tr>
                                            <td colspan="4"><?php echo Filter::msgInfo(lang('NO_DATA'), false);?></td>
                                        </tr>

                                        <?php else:?>
                                        <?php foreach ($rows as $row):?>

                                        <tr>
                                            <td><?php echo $row->kode;?></td>
                                            <td style="text-align: left;"><?php echo $row->nama_mata_tatar;?></td>
                                            <td style="text-align: left;"><?php echo $row->nama_pengajar;?></td>
                                            <td>
                                                <a href="index.php?do=pn_diklat_mata_tatar&amp;action=edit&amp;id=<?php echo $row->id;?>" title="Edit" class="tip"><span class="icon12 icomoon-icon-pencil"></span></a>
                                                <a href="javascript:void(0)" title="Hapus" class="tip doDelete" id="<?php echo $row->id;?>"><span class="icon12 icomoon-icon-remove"></span></a>
                                            </td>
                                        </tr>

                                        <?php endforeach;?>
                                        <?php unset($row);?>
                                        <?php endif;?>					

                                    </tbody>

                                    <tfoot>
                                        <tr>
                                            <td colspan="5">
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
												
	<?php echo Core::doDelete(lang('DELCONFIRM_TITLE'), "deleteDiklat_Mata_Tatar");?>

                            </div> <!-- end .content -->
                                
<?php break;?>
<?php endswitch;?>

                        </div><!-- End .box -->

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
