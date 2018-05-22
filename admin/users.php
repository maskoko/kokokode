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


<?php switch(Filter::$action): case "edit": ?>

	<?php include ("users_edit.php"); ?>

<?php break; ?>

    <!------------------------ add ----------------------------------------------->


<?php case "add": ?>

	<?php include ("users_add.php"); ?>

<?php break; ?>


    <!------------------------ list --------------------------------------------- -->
	

<?php default: ?>

        <?php

            if(isset(Filter::$get['profileid']))
                $profileid = Filter::$get['profileid'];
            else
                $profileid = 0;

            if(isset(Filter::$get['searchfield']))
                $searchfield = Filter::$get['searchfield'];
            else
                $searchfield = 'username';

            if(isset(Filter::$get['searchtext']))
                $searchtext = Filter::$get['searchtext'];
            else
                $searchtext = '';

        ?>

            <div class="row-fluid">
                <div class="span12">

                    <div class="box">

                        <div class="title">
                            <h4>
                                <span>Filter :</span>

                                <form class="box-form right" action="">
                                    <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                                        <span class="icon16 icomoon-icon-cog-2"></span>
                                        <span class="caret"></span>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a href="index.php?do=user_profiles"><span class="icon-user"></span> Profile User</a></li>
                                    </ul>
                                </form>

                            </h4>
                            <a href="#" class="minimize">Minimize</a>
                        </div>

                        <div class="content">
                            <form class="form form-horizontal" method="get" action="">
                                <fieldset>
                                    <input type="hidden" name="do" value="users">

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">
                                                <label class="form-label span2" for="checkboxes">profile:</label>
                                                <div class="span6 controls">
                                                    <?php $profiles = $user->getUser_ProfileList(); ?>
                                                    <select name="profileid" id="profileid" style="width:100%;" placeholder="Select...">
                                                        <option value=""><?php echo lang('SELECT_ALL');?></option>
                                                        <?php if ($profiles):?>
                                                        <?php foreach ($profiles as $prow):?>
                                                            <option value="<?php echo $prow->id;?>" <?php if($prow->id == $profileid)echo 'selected="selected"';?>><?php echo $prow->profilename;?></option>
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
                                                        <option value="username" <?php if($searchfield == 'username') echo 'selected="selected"';?>>Username</option>
                                                        <option value="email" <?php if($searchfield == 'email') echo 'selected="selected"';?>>E-Mail</option>
                                                    </select>
                                                </div>

                                                <label class="form-label span2" for="searchtext">Teks:</label>
                                                <input class="span4" type="text" name="searchtext" id="searchtext" value="<?php echo $searchtext; ?>" maxlength="50">
                                                <button type="submit" class="btn btn-info">Cari</button>
                                            </div>
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

                    <?php $rows = $user->getUsers();?>

                    <table class="responsive table table-striped table-bordered table-sorting table-condensed">

                        <thead>
                            <tr>
                                <th width="50">ID</th>
                                <th width="80">Username</th>
                                <th>Profile</th>
                                <th width="110">E-Mail</th>
                                <th width="120">Last Login</th>
                                <th width="50">Aktif</th>
                                <th width="100">
                                    <button type="button" class="btn btn-mini" onclick="location.href='index.php?do=users&amp;action=add'"><span class="icon16 icomoon-icon-plus-2"></span>Tambah</button>                                    
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
                                <td><?php echo $row->id;?></td>
                                <td style="text-align: left;"><?php echo $row->username;?></td>
                                <td style="text-align: left;"><?php echo $row->usermode . " : ". $row->profilename;?></td>
                                <td style="text-align: left;"><?php echo $row->email;?></td>
                                <td><?php echo $row->lastlogin;?></td>
                                <td><?php echo $row->active;?></td>
                                <td align="center">
                                    <a href="index.php?do=users&amp;action=edit&amp;id=<?php echo $row->id;?>" title="Edit" class="tip"><span class="icon12 icomoon-icon-pencil"></span></a>
                                    <?php if ($row->id != 1) : ?>
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
			
<?php echo Core::doDelete(lang('DELCONFIRM_TITLE'), "deleteUser");?>	

                </div><!-- End .span12 -->
            </div><!-- End .row-fluid -->

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
