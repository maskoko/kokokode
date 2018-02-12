<?php
  /**
   * Main
   *
   * @package SIM PPPPTK BMTI
   * @author a2ngsa
   * @copyright 2012
   * @version $Id: pn_kamar.php (admin), v1.00 2011-06-05 10:12:05 gewa Exp $
   */
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
	  
  
?>

<script type="text/javascript" src="js/pn_kamar.js"></script>

        <!--Body content-->
        <div id="content" class="clearfix">
            <div class="contentwrapper"><!--Content wrapper-->

                <div class="heading">
                    <h3>Penyelenggaraan - Kamar</h3>                    
                </div><!-- End .heading-->
    				
                <!-- Build page from here: Usual with <div class="row-fluid"></div> -->

                <div class="row-fluid">
                    <div class="span12">

                        <div id="msgholder"></div>
                        
                        <div class="box">

<?php switch(Filter::$action): case "edit": ?>

                            <div class="title">
                                <h4> 
                                    <span>Edit - Kamar</span>
                                </h4>								
                            </div>

                            <div class="content">

                                <?php 
                                    $row = Core::getRowById("kamar", Filter::$id);
                                    $gedung = $content->getGedungList();
                                ?>

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
                                                <label class="form-label span4" for="checkboxes">Gedung:</label>
                                                <div class="span8 controls">
                                                    <select name="gedungid" id="gedungid">
                                                        <option value=""><?php echo lang('SELECT');?></option>
                                                        <?php if ($gedung):?>
                                                            <?php foreach ($gedung as $prow):?>
                                                                <option value="<?php echo $prow->id;?>" <?php if($prow->id == $row->gedungid)echo 'selected="selected"';?>><?php echo $prow->nama_gedung;?></option>
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
                                                <label class="form-label span4" for="normal">Jenis:</label>
                                                <input type="text" class="span8 required" name="jenis" id="jenis" value="<?php echo $row->jenis;?>"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <label class="form-label span4" for="normal">Jml Bed:</label>										
                                                <input type="text" class="span2 required" id="jml_bed" name="jml_bed" value="<?php echo $row->jml_bed; ?>"/>
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

                            <?php echo Core::doForm("processKamar"); ?> 	

                            </div><!-- End .box -->

                        </div><!-- End .span12 -->
                    </div><!-- End .row-fluid -->  

                    <div class="row-fluid">
                        <div class="span12">

                            <div class="box">

                                <?php $rows = $content->getKamar_Bed($row->id);?>

                                <div class="title">
                                    <h4>
                                        <span class="icon16 icomoon-icon-calendar"></span>
                                        <span>Bed (Tempat Tidur)</span>                                       
                                    </h4>																				
                                </div>

                                <div class="content">

                                    <table class="responsive table table-striped table-bordered">	
                                        <thead>
                                            <tr>
                                                <th width="50">Kode</th>
                                                <th>Status</th>
                                                <th>Check-In</th>
                                                <th width="100"><button type="button" class="btn btn-mini" onclick="location.href='index.php?do=pn_kamar_bed&amp;action=add&amp;kamarid=<?php echo $row->id; ?>'"><span class="icon16 icomoon-icon-plus-2"></span>Tambah</button></th>
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
                                                <td><?php echo $row->status;?></td>
                                                <td><?php echo $row->checkin;?></td>
                                                <td align="center">
                                                    <a href="index.php?do=pn_kamar_bed&amp;action=edit&amp;id=<?php echo $row->id;?>" title="Edit" class="tip"><span class="icon12 icomoon-icon-pencil"></span></a>
                                                    <a href="javascript:void(0)" title="Hapus" class="tip doDelete" data-id="<?php echo $row->id;?>"><span class="icon12 icomoon-icon-remove"></span></a>
                                                </td>
                                            </tr>

                                        <?php endforeach;?>
                                        <?php unset($row);?>
                                        <?php endif;?>					

                                        </tbody>

                                    </table>
            
	<?php echo Core::doDelete(lang('DELCONFIRM_TITLE'), "deleteKamar_Bed");?>
                                    
                                </div> <!-- end .content -->
			
<?php break; ?>

    <!------------------------ add ----------------------------------------------->


<?php case "add": ?>

	<?php
		if(isset(Filter::$get['gedungid']))
                    $gedungid = Filter::$get['gedungid'];
		else
                    $gedungid = 0;
                
                $gedung = $content->getGedungList();
                
	?>

                                <div class="title">
                                    <h4> 
                                        <span>Tambah Kamar</span>
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
                                                    <label class="form-label span4" for="checkboxes">Gedung:</label>
                                                    <div class="span8 controls">
                                                        <select name="gedungid" id="gedungid">
                                                            <option value=""><?php echo lang('SELECT');?></option>
                                                            <?php if ($gedung):?>
                                                                <?php foreach ($gedung as $prow):?>
                                                                    <option value="<?php echo $prow->id;?>" <?php if($prow->id == $gedungid)echo 'selected="selected"';?>><?php echo $prow->nama_gedung;?></option>
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
                                                    <label class="form-label span4" for="normal">Jenis:</label>
                                                    <input type="text" class="span8 required" name="jenis" id="jenis" value=""/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-row row-fluid">
                                            <div class="span12">
                                                <div class="row-fluid">								
                                                    <label class="form-label span4" for="normal">Jml Bed:</label>
                                                    <div class="span8 controls">
                                                        <input type="text" class="span2 required" id="jml_bed" name="jml_bed" value="0"/>																			
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

			<?php echo Core::doForm("processKamar"); ?> 	

                                </div> <!-- end .content -->
<?php break; ?>


    <!------------------------ list ----------------------------------------------->
	

<?php default: ?>

                            <?php $rows = $content->getKamar(0);?>

                            <div class="title">
                                <h4>
                                    <span class="icon16 icomoon-icon-calendar"></span>
                                    <span>Kamar</span>                                       
                                </h4>																				
                            </div>

                            <div class="content">

                                <table class="responsive table table-striped table-bordered table-sorting table-condensed">
                                        <thead>
                                            <tr>
                                                <th width="50">Kode</th>
                                                <th>Jenis</th>
                                                <th>Jml Bed</th>
                                                <th width="100"><button type="button" class="btn btn-mini" onclick="location.href='index.php?do=pn_kamar&amp;action=add'"><span class="icon16 icomoon-icon-plus-2"></span>Tambah</button></th>
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
                                                    <a href="index.php?do=pn_kamar&amp;action=edit&amp;id=<?php echo $row->id;?>" title="" class="tip"><span class="icon12 icomoon-icon-pencil"></span></a>
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
			
	<?php echo Core::doDelete(lang('DELCONFIRM_TITLE'), "deleteKamar");?>	

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
