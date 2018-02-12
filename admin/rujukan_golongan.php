<?php
  /**
   * Main
   *
   * @package SIM PPPPTK BMTI
   * @author a2ngsa
   * @copyright 2012
   * @version $Id: rujukan_golongan.php (admin), v1.00 2011-06-05 10:12:05 gewa Exp $
   */
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
	    
?>

        <!--Body content-->
        <div id="content" class="clearfix">
            <div class="contentwrapper"><!--Content wrapper-->

                <div class="heading">

                    <h3>Rujukan - Golongan</h3>

                </div><!-- End .heading-->
    				
                <!-- Build page from here: Usual with <div class="row-fluid"></div> -->

                <div class="row-fluid">
                    <div class="span12">

                        <div id="msgholder"></div>
                                                
                        <div class="box">

<?php switch(Filter::$action): case "edit": ?>

                            <div class="title">
                                <h4> 
                                    <span>Edit Rujukan - Golongan</span>
                                </h4>								
                            </div>

                            <div class="content">

                                <?php $row = Core::getRowById("golongan", Filter::$id);?>

                                <form id="admin_form" class="form-horizontal" method="post" action="">			
                                <fieldset>
                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <label class="form-label span4" for="normal">Nama :</label>
                                                <input type="text" class="span2 required" name="kode" id="kode" value="<?php echo $row->kode;?>"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <label class="form-label span4" for="normal">Pangkat:</label>
                                                <input type="text" class="span8 required" name="nama_pangkat" id="nama_pangkat" value="<?php echo $row->nama_pangkat;?>"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <label class="form-label span4" for="normal">Jabatan Fungsional:</label>
                                                <input type="text" class="span8 required" name="nama_fungsional" id="nama_fungsional" value="<?php echo $row->nama_fungsional;?>"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <label class="form-label span4" for="normal">Widyaiswara:</label>
                                                <input type="text" class="span8 required" name="nama_widyaiswara" id="nama_widyaiswara" value="<?php echo $row->nama_widyaiswara;?>"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <label class="form-label span4" for="normal">Jabatan Struktural:</label>
                                                <input type="text" class="span8 required" name="nama_struktural" id="nama_struktural" value="<?php echo $row->nama_struktural;?>"/>
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

                            <?php echo Core::doForm("processGolongan"); ?>
			
<?php break; ?>

    <!------------------------ add ----------------------------------------------->


<?php case "add": ?>

                            <div class="title">
                                <h4> 
                                    <span>Tambah Rujukan - Golongan</span>
                                </h4>								
                            </div>

                            <div class="content">

                                <form id="admin_form" class="form-horizontal" method="post" action="">
                                <fieldset>
                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <label class="form-label span4" for="normal">Nama:</label>
                                                <input type="text" class="span2 required" name="kode" id="kode" value=""/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <label class="form-label span4" for="normal">Pangkat:</label>
                                                <input type="text" class="span8 required" name="nama_pangkat" id="nama_pangkat" value=""/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <label class="form-label span4" for="normal">Jabatan Fungsional:</label>
                                                <input type="text" class="span8 required" name="nama_fungsional" id="nama_fungsional" value=""/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <label class="form-label span4" for="normal">Widyaiswara:</label>
                                                <input type="text" class="span8 required" name="nama_widyaiswara" id="nama_widyaiswara" value=""/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <label class="form-label span4" for="normal">Jabatan Struktural:</label>
                                                <input type="text" class="span8 required" name="nama_struktural" id="nama_struktural" value=""/>
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

                            <?php echo Core::doForm("processGolongan"); ?> 	
		
<?php break; ?>


    <!------------------------ list ----------------------------------------------->
	

<?php default: ?>

                            <?php $rows = $content->getGolongan();?>

                            <div class="title">
                                <h4>
                                    <span class="icon16 icomoon-icon-list-view-2"></span>
                                    <span>Rujukan - Golongan</span>                                       
                                </h4>
                            </div>
    
                            <div class="content">

                                <table class="responsive table table-striped table-bordered table-sorting table-condensed">

                                        <thead>
                                            <tr>
                                                <th width="50">Nama</th>
                                                <th>Pangkat</th>
                                                <th>Jabatan Fungsional</th>
                                                <th>Widyaiswara</th>
                                                <th>Jabatan Struktural</th>
                                                <th width="100"><button type="button" class="btn btn-mini" onclick="location.href='index.php?do=rujukan_golongan&amp;action=add'"><span class="icon16 icomoon-icon-plus-2"></span>Tambah</button></th>
                                            </tr>
                                        </thead>

                                        <tbody>

                                        <?php if(!$rows):?>
                                            <tr>
                                                <td colspan="6"><?php echo Filter::msgInfo(lang('NO_DATA'), false);?></td>
                                            </tr>

                                        <?php else:?>
                                        <?php foreach ($rows as $row):?>

                                            <tr>
                                                <td align="center"><?php echo $row->kode;?></td>
                                                <td style="text-align: left;"><?php echo $row->nama_pangkat;?></td>
                                                <td style="text-align: left;"><?php echo $row->nama_fungsional;?></td>
                                                <td style="text-align: left;"><?php echo $row->nama_widyaiswara;?></td>
                                                <td style="text-align: left;"><?php echo $row->nama_struktural;?></td>
                                                <td align="actBtns">
                                                    <a href="index.php?do=rujukan_golongan&amp;action=edit&amp;id=<?php echo $row->id;?>" title="Edit" class="tip" ><span class="icon12 icomoon-icon-pencil"></span></a>
                                                    <a href="javascript:void(0)" title="Hapus" class="tip doDelete" data-id="<?php echo $row->id;?>"><span class="icon12 icomoon-icon-remove"></span></a>
                                                </td>
                                            </tr>

                                        <?php endforeach;?>
                                        <?php unset($row);?>
                                        <?php endif;?>					

                                        </tbody>

                                        <tfoot>
                                            <tr>
                                                <td colspan="6">
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
                                       	
                            <?php echo Core::doDelete(lang('DELCONFIRM_TITLE'), "deleteGolongan");?>	
                                
<?php break;?>
<?php endswitch;?>

                            </div><!-- End .content -->
                                                                
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
    