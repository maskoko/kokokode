<?php
  /**
   * Main
   *
   * @package SIM PPPPTK BMTI
   * @author a2ngsa
   * @copyright 2012
   * @version $Id: pn_gedung.php (admin), v1.00 2011-06-05 10:12:05 gewa Exp $
   */
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
	  
  
?>

<script type="text/javascript" src="js/pn_gedung.js"></script>

        <!--Body content-->
        <div id="content" class="clearfix">
            <div class="contentwrapper"><!--Content wrapper-->

                <div class="heading">
                    <h3>Penyelenggaraan - Gedung</h3>                    
                </div><!-- End .heading-->
    				
                <!-- Build page from here: Usual with <div class="row-fluid"></div> -->

                <div class="row-fluid">
                    <div class="span12">

                        <div id="msgholder"></div>
                        
                        <div class="box">

<?php switch(Filter::$action): case "edit": ?>

                            <div class="title">
                                <h4> 
                                    <span>Edit - Gedung</span>
                                </h4>								
                            </div>

                            <div class="content">

                                <?php $row = Core::getRowById("gedung", Filter::$id);?>
    
                                <form id="admin_form" class="form-horizontal" method="post" action="">			
                                <fieldset>

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <label class="form-label span4" for="normal">Kode:</label>
                                                <input type="text" class="span2 required" id="kode" name="kode" value="<?php echo $row->kode; ?>"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <label class="form-label span4" for="normal">Nama Gedung:</label>
                                                <input type="text" class="span8 required" name="nama_gedung" id="nama_gedung" value="<?php echo $row->nama_gedung;?>"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <label class="form-label span4" for="normal">Jml Kamar:</label>										
                                                <input type="text" class="span2 required" id="jml_kamar" name="jml_kamar" value="<?php echo $row->jml_kamar; ?>"/>
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

                                    <?php echo Core::doForm("processGedung"); ?> 	

                            </div><!-- End .content -->
                                
                        </div><!-- End .box -->

                    </div><!-- End .span12 -->
                </div><!-- End .row-fluid -->  

                <div class="row-fluid">
                    <div class="span12">

                        <div class="box">

                            <?php $rows = $content->getKamar($row->id);?>

                            <div class="title">
                                <h4>
                                    <span class="icon16 icomoon-icon-calendar"></span>
                                    <span>Kamar</span>                                       
                                </h4>																				
                            </div>

                            <div class="content">

                                <table class="responsive table table-striped table-bordered table-striped table-condensed">	
                                    <thead>
                                        <tr>
                                            <th width="50">Kode</th>
                                            <th>Jenis</th>
                                            <th>Jml Bed</th>
                                            <th width="100"><button type="button" class="btn btn-mini" onclick="location.href='index.php?do=pn_kamar&amp;action=add&amp;gedungid=<?php echo $row->id; ?>'"><span class="icon16 icomoon-icon-plus-2"></span>Tambah</button></th>
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
                                            <td align="right"><?php echo $row->kode;?>.</td>
                                            <td><?php echo $row->jenis;?></td>
                                            <td><?php echo $row->jml_bed;?></td>
                                            <td align="center">
                                                <a href="index.php?do=pn_kamar&amp;action=edit&amp;id=<?php echo $row->id;?>" title="Edit" class="tip"><span class="icon12 icomoon-icon-pencil"></span></a>
                                                <a href="javascript:void(0)" title="Hapus" class="tip doDelete" data-id="<?php echo $row->id;?>"><span class="icon12 icomoon-icon-remove"></span></a>
                                            </td>
                                        </tr>

                                    <?php endforeach;?>
                                    <?php unset($row);?>
                                    <?php endif;?>					

                                    </tbody>

                                </table>

    <?php echo Core::doDelete(lang('DELCONFIRM_TITLE'), "deleteKamar");?>	

                            </div> <!-- end .content -->
			
<?php break; ?>

    <!------------------------ add ----------------------------------------------->


<?php case "add": ?>

                                <div class="title">
                                    <h4> 
                                        <span>Tambah Gedung</span>
                                    </h4>								
                                </div>

                                <div class="content">
    
                                    <form id="admin_form" class="form-horizontal" method="post" action="">			
                                    <fieldset>

                                        <div class="form-row row-fluid">
                                            <div class="span12">
                                                <div class="row-fluid">								
                                                    <label class="form-label span4" for="normal">Kode:</label>
                                                    <input type="text" class="span2 required" id="kode" name="kode" value=""/>
                                                </div>
                                            </div>
                                        </div>			

                                        <div class="form-row row-fluid">
                                            <div class="span12">
                                                <div class="row-fluid">								
                                                    <label class="form-label span4" for="normal">Nama Gedung:</label>
                                                    <input type="text" class="span8 required" name="nama_gedung" id="nama_gedung" value=""/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-row row-fluid">
                                            <div class="span12">
                                                <div class="row-fluid">								
                                                    <label class="form-label span4" for="normal">Jml Kamar:</label>
                                                    <div class="span8 controls">
                                                        <input type="text" class="span2 required" id="jml_kamar" name="jml_kamar" value="0"/>																			
                                                    </div>
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

			<?php echo Core::doForm("processGedung"); ?> 	
                                    
                                </div> <!-- end .content -->
						
<?php break; ?>


    <!------------------------ list ----------------------------------------------->
	

<?php default: ?>

                                <?php $rows = $content->getGedung();?>
        
                                <div class="title">
                                    <h4>
                                        <span class="icon16 icomoon-icon-calendar"></span>
                                        <span>Gedung</span>                                       
                                    </h4>																				
                                </div>
    
                                <div class="content">
	
                                    <table class="responsive table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th width="50">Kode</th>
                                                <th>Nama Gedung</th>
                                                <th>Jml Kamar</th>
                                                <th width="100"><button type="button" class="btn btn-mini" onclick="location.href='index.php?do=pn_gedung&amp;action=add'"><span class="icon16 icomoon-icon-plus-2"></span>Tambah</button></th>
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
                                                <td align="right"><?php echo $row->kode;?>.</td>
                                                <td><?php echo $row->nama_gedung;?></td>
                                                <td><?php echo $row->jml_kamar;?></td>
                                                <td align="center">
                                                    <a href="index.php?do=pn_gedung&amp;action=edit&amp;id=<?php echo $row->id;?>" title="" class="tip"><span class="icon12 icomoon-icon-pencil"></span></a>
                                                    <a href="javascript:void(0)" title="Hapus" class="tip doDelete" data-id="<?php echo $row->id;?>"><span class="icon12 icomoon-icon-remove"></span></a>
                                                </td>
                                            </tr>

                                        <?php endforeach;?>
                                        <?php unset($row);?>
                                        <?php endif;?>					

                                        </tbody>

                                        <tfoot>
                                            <tr>
                                                <td colspan="4">
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
			
	<?php echo Core::doDelete(lang('DELCONFIRM_TITLE'), "deleteGedung");?>	

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
    <script type="text/javascript" src="plugins/forms/validate/jquery.validate.min.js"></script>
            
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
