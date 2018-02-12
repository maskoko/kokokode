<?php
  /**
   * Profile
   *
   * @package SIM PPPPTK BMTI
   * @author a2ngsa
   * @copyright 2012
   * @version $Id: profile.php, v1.00 2011-06-05 10:12:05 gewa Exp $
   */
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
 
  $row = $user->getUserData();

?>

        <!--Body content-->
        <div id="content" class="clearfix">
            <div class="contentwrapper"><!--Content wrapper-->

                <div class="heading">
                    <h3>Login User</h3>                    
                </div><!-- End .heading-->
    				
                <!-- Build page from here: Usual with <div class="row-fluid"></div> -->

                <div class="row-fluid">
                    <div class="span12">

                        <div id="msgholder"></div>                        
                        
                        <div class="box">
                                        
                            <div class="title">
                                <h4>
                                    <span class="icon16 icomoon-icon-users"></span>
                                    <span>Info Login</span>
                                    <span id="loader" class="loader" style="display:none"><img src="images/loader_circular.gif" width="16" height="16" alt=""></span>
                                </h4>
                            </div>
                            
                            <div class="content">

                                <form id="admin_form" class="form-horizontal" method="post" action="">									
                                <fieldset>
                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">
                                                <label class="form-label span3" for="normal">Username:</label>
                                                <input name="username" type="text" disabled="disabled" class="span2" value="<?php echo $row->username;?>" readonly="readonly" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">
                                                <label class="form-label span3" for="normal">Password:</label>
                                                <input name="password" type="password" class="span2 required" maxlength="20" placeholder="Masukkan password" />
                                                <input name="password2" type="password" class="span2 required" maxlength="20" placeholder="Ulangi password" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">
                                                <label class="form-label span3" for="normal">E-Mail:</label>
                                                <input name="email" type="text" class="span8 required" value="<?php echo $row->email;?>" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">
                                                <label class="form-label span3" for="normal">Created:</label>
                                                <input name="created" type="text" disabled="disabled" class="span2" value="<?php echo Filter::doDate($core->long_date, $row->created);?>" size="20" readonly="readonly" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">
                                                <label class="form-label span3" for="normal">Waktu Login terakhir:</label>
                                                <input name="lastlogin" type="text" disabled="disabled" class="span4" value="<?php echo Filter::doDate($core->long_date, $row->lastlogin);?>" size="20" readonly="readonly" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">
                                                <label class="form-label span3" for="normal">IP Login terakhir:</label>
                                                <input name="lastip" type="text" disabled="disabled" class="span2" value="<?php echo $row->lastip;?>" size="20" readonly="readonly" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-info">Save</button>
                                        <button type="button" class="btn" onclick="history.back()">Kembali</button>
                                    </div>

                                </fieldset>
                                </form>       

                            </div> <!-- end .content -->
                        </div> <!-- end .box -->

<?php echo Core::doForm("processUser", "ajax/controller.php");?>

                    </div> <!-- span12 -->					
                </div>  <!-- row fluid -->
                
            </div> <!-- End contentwrapper -->
        </div> <!-- End content -->

    </div><!-- End #wrapper -->
                
    <!-- Load plugins -->

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

    <!-- Init plugins -->    
    <script type="text/javascript" src="js/main.js"></script>