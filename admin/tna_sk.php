<?php
  /**
   * Main
   *
   * @package SIM PPPPTK BMTI
   * @author a2ngsa
   * @copyright 2012
   * @version $Id: tna_sk.php (admin), v1.00 2011-06-05 10:12:05 gewa Exp $
   */
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
	  
  
?>

<script type="text/javascript" src="js/tna_sk.js"></script>

        <!--Body content-->
        <div id="content" class="clearfix">
            <div class="contentwrapper"><!--Content wrapper-->

                <div class="heading">
                    <h3>TNA Online - Standar Kompetensi(SK)</h3>                    
                </div><!-- End .heading-->
    				
                <!-- Build page from here: Usual with <div class="row-fluid"></div> -->

                <div class="row-fluid">
                    <div class="span12">

                        <div id="msgholder"></div>                        
                        
                        <div class="box">

<?php switch(Filter::$action): case "edit": ?>

                            <div class="title">
                                <h4> 
                                    <span>Edit Standar Kompetensi (SK)</span>
                                </h4>								
                            </div>

                            <div class="content">

                                <?php 
                                    $row = Core::getRowById("sk", Filter::$id);                                    
                                    $kk = $content->getKKList();
                                ?>
    
                                <form id="admin_form" class="form-horizontal" method="post" action="">			
                                <fieldset>

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <label class="form-label span4" for="normal">No. Urut:</label>
                                                <input type="text" class="span2 required" id="skindex" name="skindex" value="<?php echo $row->skindex; ?>"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <label class="form-label span4" for="checkboxes">Kompetensi Keahlian:</label>
                                                <div class="span8 controls">
                                                    <select name="kkid" id="kkid">
                                                        <option value=""><?php echo lang('SELECT');?></option>
                                                        <?php if ($kk):?>
                                                            <?php foreach ($kk as $prow):?>
                                                                <option value="<?php echo $prow->id;?>" <?php if($prow->id == $row->kkid)echo 'selected="selected"';?>><?php echo $prow->nama_kompetensi;?></option>
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
                                                <label class="form-label span4" for="normal">Nama Kompetensi:</label>
                                                <input type="text" class="span8 required" name="nama_kompetensi" id="nama_kompetensi" value="<?php echo $row->nama_kompetensi;?>"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <label class="form-label span4" for="checkboxes">Jenis:</label>
                                                <div class="span4 controls">											
                                                    <select name="jenis" id="jenis">
                                                        <?php echo $content->SKJenisList($row->jenis); ?>
                                                    </select>					
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-info">Save</button>
                                        <button type="button" class="btn btn-mini" onclick="history.back()">Kembali</button>
                                    </div>

                                    <input name="id" type="hidden" value="<?php echo Filter::$id;?>" />
                                    <input name="userid" type="hidden" value="<?php echo $row->userid;?>" />

                                </fieldset>
                                </form>       

                            <?php echo Core::doForm("processSK"); ?> 	
                                
                            </div> <!-- end .content -->

                        </div><!-- End .box -->

                    </div><!-- End .span12 -->
                </div><!-- End .row-fluid -->  

                <div class="row-fluid">
                    <div class="span12">

                        <div class="box">
		
                            <?php $rows = $content->getKD($row->id);?>
		
                            <div class="title">
                                <h4>
                                    <span class="icon16 icomoon-icon-equalizer-2"></span>
                                    <span>Kompetensi Dasar (KD)</span>                                       
                                </h4>
                            </div>
                            
                            <div class="content">
	
                                <table class="responsive table table-striped table-bordered table-sorting table-condensed">	
                                    <thead>
                                        <tr>
                                            <th width="50">No.</th>
                                            <th>Nama Kompetensi</th>
                                            <th width="100">Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                    <?php if(!$rows):?>
                                        <tr>
                                            <td colspan="3"><?php echo Filter::msgInfo(lang('NO_DATA'), false);?></td>
                                        </tr>

                                    <?php else:?>
                                    <?php foreach ($rows as $row):?>

                                        <tr>
                                            <td style="text-align: right;"><?php echo $row->kdindex;?>.</td>
                                            <td style="text-align: left;"><?php echo $row->nama_kompetensi;?></td>
                                            <td align="center">
                                                <a href="index.php?do=tna_kd&amp;action=edit&amp;id=<?php echo $row->id;?>" title="Edit" class="tip"><span class="icon12 icomoon-icon-pencil"></span></a>
                                                <a href="javascript:void(0)" title="Hapus" class="tip doDelete" data-id="<?php echo $row->id;?>"><span class="icon12 icomoon-icon-remove"></span></a>
                                            </td>
                                        </tr>

                                    <?php endforeach;?>
                                    <?php unset($row);?>
                                    <?php endif;?>					

                                    </tbody>

                                </table>
            
	<?php echo Core::doDelete(lang('DELCONFIRM_TITLE'), "deleteKD");?>
                                
                            </div> <!-- end .content -->
			
<?php break; ?>

    <!------------------------ add ----------------------------------------------->


<?php case "add": ?>

                            <div class="title">
                                <h4> 
                                    <span>Tambah Standar Kompetensi (SK)</span>
                                </h4>								
                            </div>

                            <div class="content">

        			<?php $kk = $content->getKKList();?>
    
                                <form id="admin_form" class="form-horizontal" method="post" action="">			
                                <fieldset>

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <label class="form-label span4" for="normal">No. Urut:</label>									
                                                <input type="text" class="span2 required" id="skindex" name="skindex" value=""/>
                                            </div>
                                        </div>
                                    </div>			

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <label class="form-label span4" for="checkboxes">Kompetensi Keahlian:</label>
                                                <div class="span8 controls">
                                                    <select name="kkid" id="kkid">
                                                        <option value=""><?php echo lang('SELECT');?></option>
                                                        <?php if ($kk):?>
                                                            <?php foreach ($kk as $prow):?>
                                                                <option value="<?php echo $prow->id;?>"><?php echo $prow->nama_kompetensi;?></option>
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
                                                <label class="form-label span4" for="normal">Nama Kompetensi:</label>
                                                <input type="text" class="span8 required" name="nama_kompetensi" id="nama_kompetensi" value=""/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">
                                                <label class="form-label span4" for="checkboxes">Jenis:</label>
                                                <div class="span4 controls">
                                                    <select name="jenis" id="jenis">
                                                        <?php echo $content->SKJenisList(); ?>
                                                    </select>					
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

			<?php echo Core::doForm("processSK"); ?> 	

                            </div> <!-- end .content -->
<?php break; ?>


    <!------------------------ list ----------------------------------------------->
	

<?php default: ?>

                            <?php $rows = $content->getSK();?>
        
                            <div class="title">
                                <h4>
                                    <span class="icon16 icomoon-icon-equalizer-2"></span>
                                    <span>TNA Online - Standar Kompetensi (SK)</span>                                       
                                </h4>
                            </div>
    
                            <div class="content">
	
                                <table class="responsive table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th width="50">No. Urut</th>
                                            <th>Nama Kompetensi</th>
                                            <th>Kompetensi Keahlian</th>
                                            <th width="50">Jenis</th>
                                            <th width="100"><button type="button" class="btn" onclick="location.href='index.php?do=tna_sk&amp;action=add'"><span class="icon16 icomoon-icon-plus-2"></span>Tambah</button></th>
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
                                            <td style="text-align: right;"><?php echo $row->skindex;?>.</td>
                                            <td style="text-align: left;"><?php echo $row->nama_kompetensi;?></td>
                                            <td style="text-align: left;"><?php echo $row->nama_kk;?></td>
                                            <td align="center"><?php echo $row->jenis;?></td>
                                            <td align="center">
                                                <a href="index.php?do=tna_sk&amp;action=edit&amp;id=<?php echo $row->id;?>" title="" class="tip"><span class="icon12 icomoon-icon-pencil"></span></a>
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
			
	<?php echo Core::doDelete(lang('DELCONFIRM_TITLE'), "deleteSK");?>
                                
                            </div>  <!-- end .content -->

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
