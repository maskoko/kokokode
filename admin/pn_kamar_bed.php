<?php
  /**
   * Main
   *
   * @package SIM PPPPTK BMTI
   * @author a2ngsa
   * @copyright 2012
   * @version $Id: pn_kamar_bed.php (admin), v1.00 2011-06-05 10:12:05 gewa Exp $
   */
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
	  
  
?>

        <!--Body content-->
        <div id="content" class="clearfix">
            <div class="contentwrapper"><!--Content wrapper-->

                <div class="heading">

                    <h3>Penyelenggaraan - Tempat Tidur (Bed)</h3>                    

                </div><!-- End .heading-->
    				
                <!-- Build page from here: Usual with <div class="row-fluid"></div> -->

                <div class="row-fluid">
                    <div class="span12">

                        <div id="msgholder"></div>
                        
                        <div class="box">

<?php switch(Filter::$action): case "edit": ?>

                            <div class="title">
                                <h4> 
                                    <span>Edit - Tempat Tidur</span>
                                </h4>								
                            </div>

                            <div class="content">

                                <?php 
                                    $row = Core::getRowById("kamar_bed", Filter::$id);
                                    $kamar = $content->getKamarList();
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
                                                <label class="form-label span4" for="checkboxes">Kamar:</label>
                                                <div class="span8 controls">
                                                    <select name="kamarid" id="kamarid">
                                                        <option value=""><?php echo lang('SELECT');?></option>
                                                        <?php if ($kamar):?>
                                                            <?php foreach ($kamar as $prow):?>
                                                                <option value="<?php echo $prow->id;?>" <?php if($prow->id == $row->kamarid)echo 'selected="selected"';?>><?php echo $prow->kode.' / '.$prow->jenis;?></option>
                                                            <?php endforeach;?>
                                                            <?php unset($prow);?>
                                                        <?php endif;?>
                                                    </select>						
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-info">Save</button>
                                        <button type="button" class="btn" onclick="history.back()">Kembali</button>
                                    </div>

                                    <input name="status" type="hidden" value="<?php echo $row->status;?>" />
                                    <input name="id" type="hidden" value="<?php echo Filter::$id;?>" />
                                    <input name="userid" type="hidden" value="<?php echo $row->userid;?>" />

                                </fieldset>
                                </form>       

			<?php echo Core::doForm("processKamar_Bed"); ?> 	
                                
                            </div> <!-- end .content -->
			
<?php break; ?>

    <!------------------------ add ----------------------------------------------->


<?php case "add": ?>

	<?php
		if(isset(Filter::$get['kamarid']))
                    $kamarid = Filter::$get['kamarid'];
		else
                    $kamarid = 0;
                
                $kamar = $content->getKamarList();                
	?>


                            <div class="title">
                                <h4> 
                                    <span>Tambah Tempat Tidur</span>
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
                                                <label class="form-label span4" for="checkboxes">Kamar:</label>
                                                <div class="span8 controls">
                                                    <select name="kamarid" id="kamarid">
                                                        <option value=""><?php echo lang('SELECT');?></option>
                                                        <?php if ($kamar):?>
                                                            <?php foreach ($kamar as $prow):?>
                                                                <option value="<?php echo $prow->id;?>" <?php if($prow->id == $kamarid)echo 'selected="selected"';?>><?php echo $prow->kode.' / '.$prow->jenis;?></option>
                                                            <?php endforeach;?>
                                                            <?php unset($prow);?>
                                                        <?php endif;?>
                                                    </select>						
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-info">Save</button>
                                        <button type="button" class="btn" onclick="history.back()">Kembali</button>
                                    </div>

                                    <input name="status" type="hidden" value="K" />
                                    <input name="userid" type="hidden" value="<?php echo $user->uid;?>" />

                                </fieldset>
                                </form>       

			<?php echo Core::doForm("processKamar_Bed"); ?> 	

                            </div> <!-- end .content -->
<?php break; ?>


    <!------------------------ list ----------------------------------------------->
	

<?php default: ?>

	<?php $rows = $content->getKamar_Bed(0);?>
        
                            <div class="title">
                                <h4>
                                    <span class="icon16 icomoon-icon-calendar"></span>
                                    <span>Tempat Tidur</span>                                       
                                </h4>																				
                            </div>
    
                            <div class="content">
	
                                <table class="responsive table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th width="50">Kode</th>
                                            <th>Status</th>
                                            <th>Check-In</th>
                                            <th width="100"><button type="button" class="btn btn-mini" onclick="location.href='index.php?do=pn_kamar_bed&amp;action=add'"><span class="icon16 icomoon-icon-plus-2"></span>Tambah</button></th>
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
			
	<?php echo Core::doDelete(lang('DELCONFIRM_TITLE'), "deleteKamar_Bed");?>	

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
