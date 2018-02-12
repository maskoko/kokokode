<?php
  /**
   * Main
   *
   * @package SIM PPPPTK BMTI
   * @author a2ngsa
   * @copyright 2012
   * @version $Id: users.php (admin), v1.00 2011-06-05 10:12:05 gewa Exp $
   */
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
	  
  
?>

        <!--Body content-->
        <div id="content" class="clearfix">
            <div class="contentwrapper"><!--Content wrapper-->

                <div class="heading">
                    <h3>Data User Login</h3>                    
                </div><!-- End .heading-->
    				
                <!-- Build page from here: Usual with <div class="row-fluid"></div> -->

                <div class="row-fluid">
                    <div class="span12">

                        <div id="msgholder"></div>
                                                
                        <div class="box">

<?php switch(Filter::$action): case "edit": ?>

                            <div class="title">
                                <h4> 
                                    <span>Edit Profile User</span>
                                </h4>								
                            </div>

                            <div class="content">

                                <?php $row = Core::getRowById("user_profiles", Filter::$id); ?>

                                <form id="admin_form" class="form-horizontal" method="post" action="">			
                                <fieldset>
                                    
                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <label class="form-label span4" for="normal">Nama Profile:</label>
                                                <input type="text" class="span8 required" name="profilename" id="profilename" value="<?php echo $row->profilename;?>"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">
                                                <label class="form-label span4" for="checkboxes">Mode:</label>
                                                <div class="span4 controls">
                                                    <select name="usermode" id="usermode" <?php if ((Filter::$id == 1) || (Filter::$id == 2)) echo "disabled=\"disabled\""; ?>>
                                                        <?php echo $user->User_ProfileUserModeList($row->usermode); ?>
                                                    </select>							
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            
                                            <?php 
                                                
                                                $mrows = $content->getModules(); 
                                                
                                                if (($row->id == 1) || ($row->id ==2))
                                                    $caneditaccess = FALSE;
                                                else
                                                    $caneditaccess = TRUE;

                                                $profilemodules = array();
                                                $profilemodulerows = $user->getUser_ProfileModules(Filter::$id);
                                                if ($profilemodulerows) {
                                                    foreach ($profilemodulerows as $pmrow) {
                                                        $profilemodules[$pmrow->moduleid] = $pmrow->accesslist;
                                                    }
                                                    unset ($pmrow);
                                                }
                                            
                                            ?>
                                            
                                            <table class="responsive table table-bordered">

                                                <thead>					
                                                    <tr>
                                                        <th>Modul</th>
                                                        <th width="30">C</th>
                                                        <th width="30">R</th>
                                                        <th width="30">U</th>
                                                        <th width="30">D</th>
                                                        <th width="30">L</th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    
                                                    <?php if(!$mrows):?>
                                                    <tr>
                                                        <td colspan="5"><?php echo Filter::msgInfo(lang('NO_DATA'), false);?></td>
                                                    </tr>

                                                    <?php else:?>
                                                    <?php foreach ($mrows as $mrow):?>
                                                                                                        
                                                    <tr>
                                                        <input name="moduleid[]" type="hidden" value="<?php echo $mrow->id; ?>" />
                                                        <td style="text-align: left;"><?php echo $mrow->id . ' : ' . $mrow->modulename; ?></td>
                                                        <td align="center"><input type="checkbox" name="cC[]" value="<?php echo $mrow->id; ?>" <?php if(!$caneditaccess) echo "disabled"; ?>
                                                            <?php if (array_key_exists($mrow->id, $profilemodules)) {if (strrpos($profilemodules[$mrow->id], 'C') !== FALSE) echo " checked";} ?>/></td>
                                                        <td align="center"><input type="checkbox" name="cR[]" value="<?php echo $mrow->id; ?>" <?php if(!$caneditaccess) echo "disabled"; ?>
                                                            <?php if (array_key_exists($mrow->id, $profilemodules)) {if (strrpos($profilemodules[$mrow->id], 'R') !== FALSE) echo " checked";} ?>/></td>
                                                        <td align="center"><input type="checkbox" name="cU[]" value="<?php echo $mrow->id; ?>" <?php if(!$caneditaccess) echo "disabled"; ?>
                                                            <?php if (array_key_exists($mrow->id, $profilemodules)) {if (strrpos($profilemodules[$mrow->id], 'U') !== FALSE) echo " checked";} ?>/></td>
                                                        <td align="center"><input type="checkbox" name="cD[]" value="<?php echo $mrow->id; ?>" <?php if(!$caneditaccess) echo "disabled"; ?>
                                                            <?php if (array_key_exists($mrow->id, $profilemodules)) {if (strrpos($profilemodules[$mrow->id], 'D') !== FALSE) echo " checked";} ?>/></td>
                                                        <td align="center"><input type="checkbox" name="cL[]" value="<?php echo $mrow->id; ?>" <?php if(!$caneditaccess) echo "disabled"; ?>
                                                            <?php if (array_key_exists($mrow->id, $profilemodules)) {if (strrpos($profilemodules[$mrow->id], 'L') !== FALSE) echo " checked";} ?>/></td>                                                        
                                                    </tr>
                                                    
                                                    <?php endforeach;?>
                                                    <?php unset($mrow);?>
                                                    <?php endif;?>					
                                                                                                        
                                                </tbody>

                                            </table>
                                            
                                        </div>
                                    </div>
                                    
                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-info">Save</button>
                                        <button type="button" class="btn" onclick="history.back()">Kembali</button>
                                    </div>

                                    <input name="id" type="hidden" value="<?php echo Filter::$id;?>" />
                                    <input name="module_access" type="hidden" value="0" />
                                    <input name="function_access" type="hidden" value="0" />
                                    
                                </fieldset>
                                </form>       
			
			<?php echo Core::doForm("processUser_Profile"); ?> 	
                           
                            </div> <!-- end .content -->

<?php break; ?>

    <!------------------------ add ----------------------------------------------->


<?php case "add": ?>

                            <div class="title">
                                <h4> 
                                    <span>Tambah Profile User</span>
                                </h4>								
                            </div>

                            <div class="content">
			
                                <form id="admin_form" class="form-horizontal" method="post" action="">			
                                <fieldset>
                                    
                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <label class="form-label span4" for="normal">Nama Profile:</label>
                                                <input type="text" class="span8 required" name="profilename" id="profilename" value=""/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">								
                                                <label class="form-label span4" for="checkboxes">Mode:</label>
                                                <div class="span4 controls">								
                                                    <select name="usermode" id="usermode">
                                                        <?php echo $user->User_ProfileUserModeList(); ?>
                                                    </select>							
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            
                                            <?php $rows = $content->getModules(); ?>
                                            
                                            <table class="responsive table table-bordered">

                                                <thead>					
                                                    <tr>
                                                        <th>Modul</th>
                                                        <th width="30">C</th>
                                                        <th width="30">R</th>
                                                        <th width="30">U</th>
                                                        <th width="30">D</th>
                                                        <th width="30">L</th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    
                                                    <?php if(!$rows):?>
                                                    <tr>
                                                        <td colspan="5"><?php echo Filter::msgInfo(lang('NO_DATA'), false);?></td>
                                                    </tr>

                                                    <?php else:?>
                                                    <?php foreach ($rows as $row):?>
                                                                                                        
                                                    <tr>
                                                        <input name="moduleid[]" type="hidden" value="<?php echo $row->id; ?>" />
                                                        <td style="text-align: left;"><?php echo $row->modulename; ?></td>
                                                        <td align="center"><input type="checkbox" name="cC[]" value="<?php echo $row->id; ?>"/></td>
                                                        <td align="center"><input type="checkbox" name="cR[]" value="<?php echo $row->id; ?>"/></td>
                                                        <td align="center"><input type="checkbox" name="cU[]" value="<?php echo $row->id; ?>"/></td>
                                                        <td align="center"><input type="checkbox" name="cD[]" value="<?php echo $row->id; ?>"/></td>
                                                        <td align="center"><input type="checkbox" name="cL[]" value="<?php echo $row->id; ?>"/></td>
                                                    </tr>
                                                    
                                                    <?php endforeach;?>
                                                    <?php unset($row);?>
                                                    <?php endif;?>					
                                                                                                        
                                                </tbody>

                                            </table>
                                            
                                        </div>
                                    </div>
                                                                        
                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-info">Save</button>
                                        <button type="button" class="btn" onclick="history.back()">Kembali</button>
                                    </div><div class="fix"></div>

                                    <input name="module_access" type="hidden" value="0" />
                                    <input name="function_access" type="hidden" value="0" />
                                    
                                </fieldset>
                                </form>       

			<?php echo Core::doForm("processUser_Profile"); ?> 	

                            </div> <!-- end .content -->
                                
<?php break; ?>


    <!------------------------ list ----------------------------------------------->
	

<?php default: ?>

	<?php $rows = $user->getUser_Profiles();?>
    
                            <div class="title">
                                <h4>
                                    <span class="icon16 icomoon-icon-users"></span>
                                    <span>Data Profile User</span>                                       
                                </h4>
                            </div>
    
                            <div class="content">
	
                                <table class="responsive table table-striped table-bordered table-sorting table-condensed">
                                    <thead>
                                        <tr>
                                            <th width="50">ID</th>
                                            <th>Nama Profile</th>
                                            <th width="40">Mode</th>
                                            <th width="120">Last Update</th>
                                            <th width="100"><button type="button" class="btn btn-mini" onclick="location.href='index.php?do=user_profiles&amp;action=add'"><span class="icon16 icomoon-icon-plus-2"></span>Tambah</button></th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                    <?php if(!$rows):?>
                                        <tr>
                                            <td colspan="5"><?php echo Filter::msgInfo(lang('NO_DATA'), false);?></td>
                                        </tr>

                                    <?php else:?>
                                    <?php foreach ($rows as $row):?>

                                        <tr>
                                            <td><?php echo $row->id;?></td>
                                            <td style="text-align: left;"><?php echo $row->profilename;?></td>
                                            <td><?php echo $row->usermode;?></td>
                                            <td><?php echo $row->last_update;?></td>
                                            <td align="center">
                                                <a href="index.php?do=user_profiles&amp;action=edit&amp;id=<?php echo $row->id;?>" title="Edit" class="tip"><span class="icon12 icomoon-icon-pencil"></span></a>
                                                <?php if (($row->id != 1) && ($row->id != 2)) : ?>
                                                    <a href="javascript:void(0)" title="Hapus" class="tip doDelete" data-id="<?php echo $row->id;?>"><span class="icon12 icomoon-icon-remove"></span></a>
                                                <?php endif; ?>
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
                                
                            </div> <!-- end .content -->
                                
<?php echo Core::doDelete(lang('DELCONFIRM_TITLE'), "deleteUser_Profile");?>	

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
