<?php
  /**
   * Database Backup
   *
   * @package SIM Diklat P4TK BMTI
   * @author a2ngsa
   * @copyright 2012
   * @version $Id: backup.php, v1.00 2011-06-05 10:12:05 gewa Exp $
   */
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
	  
  require_once(BASEPATH . "lib/class_dbtools.php");
  Registry::set('dbTools',new dbTools());
  $tools = Registry::get("dbTools");
?>
<?php if(!$user->is_Admin()):?>
<?php Filter::msgAlert(lang('ADMINONLY'));?>
<?php else:?>
<?php
  if (isset($_GET['backupok']) && $_GET['backupok'] == "1")
      Filter::msgOk('Database berhasil dibuat.',1,1);

  if (isset($_GET['restore']) && $_GET['restore'] == "1")
      Filter::msgOk('Database berhasil direstore.',1,1);
	    
  if (isset($_GET['create']) && $_GET['create'] == "1")
      $tools->doBackup('',false);

  if (isset($_POST['backup_file']))
      $tools->doRestore($_POST['backup_file']);
?>

        <!--Body content-->
        <div id="content" class="clearfix">
            <div class="contentwrapper"><!--Content wrapper-->

                <div class="heading">

                    <h3>Backup Database</h3>

                </div><!-- End .heading-->
    				
                <!-- Build page from here: Usual with <div class="row-fluid"></div> -->

                <div class="row-fluid">
                    <div class="span12">

                        <div id="msgholder"></div>

                        <div class="box">

                            <div class="title">
                                <h4> 
                                    <span>Database</span>
                                </h4>								
                            </div>

                            <div class="content">
                                
                                <div id="backup">
                                    <?php
                                        $dir = BASEPATH . 'admin/backups/';
                                        if (is_dir($dir)):
                                                $getDir = dir($dir);
                                                while (false !== ($file = $getDir->read())):
                                                        if ($file != "." && $file != ".." && $file != "index.php"):
                                                                if ($file == $core->sbackup):
                                                                        echo '<div class="db-backup new" id="item_' . $file . '">';
                                                                        echo '<span class="fileinfo">';
                                                                        echo str_replace(".sql", "", $file) . '</span>';
                                                                        echo '<a href="' . ADMINURL . '/backups/' . $file . '" title="Download: '. $file . '" class="download tooltip">Download</a>';
                                                                        echo '<a href="javascript:void(0);" title="' .lang('DELETE').': '. $file . '" class="delete tooltip">' . lang('DELETE') . '</a>';
                                                                        echo '</div>';
                                                                else:
                                                                        echo '<div class="db-backup" id="item_' . $file . '">';
                                                                        echo '<span class="fileinfo">' . str_replace(".sql", "", $file) . '</span>';
                                                                        echo ' <a href="' . ADMINURL . '/backups/' . $file . '" title="Download: '. $file . '" class="download tooltip">Download</a>';
                                                                        echo '<a href="javascript:void(0);" title="' .lang('DELETE').': '. $file . '" class="delete tooltip">' . lang('DELETE') . '</a>';
                                                                        echo '</div>';

                                                                endif;
                                                        endif;
                                                endwhile;
                                                $getDir->close();
                                        endif;
                                    ?>
                                </div> <!-- end .backup -->
                                
                                <form id="admin_form" class="form-horizontal" action="" method="post" name="admin_form">
                                    
                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">
                                                <label class="form-label span4" for="checkboxes">Restore File:</label>
                                                <div class="span4 controls">
                                                    <select name="backup_file">
                                                        <option value=""><?php echo lang('SELECT');?></option>
                                                        <?php
                                                              if (is_dir($dir)):
                                                                    $getDir = dir($dir);
                                                                    while (false !== ($file = $getDir->read())):
                                                                            if ($file != "." && $file != ".." && $file != "index.php"):
                                                                                    echo '<option value="' . $file . '">' . $file . '</option>';
                                                                            endif;
                                                                    endwhile;
                                                                    $getDir->close();
                                                              endif;
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-info">Restore!</button>
                                        <button type="button" class="btn btn-success" onclick="window.location='index.php?do=backup&amp;create=1'">Backup</button>                                        
                                    </div>                                                                                                            
                                </form>

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
                                
                                
                                
<script type="text/javascript"> 
// <![CDATA[
$(document).ready(function () {
    $('a.delete').live('click', function () {
        var parent = $(this).parent();
        var id = parent.attr('id').replace('item_', '')
        var title = $(this).attr('rel');
        var text = '<div><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span><?php echo lang('DELCONFIRM');?></div>';
        $.confirm({
            title: '<?php echo lang('DB_DELETE');?>',
            message: text,
            buttons: {
                '<?php echo lang('DELETE');?>': {
                    'class': 'yes',
                    'action': function () {
                        $.ajax({
                            type: 'post',
                            url: "controller.php",
                            data: 'deleteBackup=' + id,
                            beforeSend: function () {
                                parent.animate({
                                    'backgroundColor': '#FFBFBF'
                                }, 400);
                            },
                            success: function (msg) {
                                parent.fadeOut(400, function () {
                                    parent.remove();
                                });
                                $("html, body").animate({
                                    scrollTop: 0
                                }, 600);
                                $("#msgholder").html(msg);
                            }
                        });
                    }
                },
                '<?php echo lang('CANCEL');?>': {
                    'class': 'no',
                    'action': function () {}
                }
            }
        });
    });
});
// ]]>
</script>
<?php endif;?>