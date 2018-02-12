<?php
  /**
   * Configuration
   *
   * @package SIM PPPPTK BMTI
   * @author a2ng
   * @copyright 2012
   * @version $Id: config.php, v1.00 2011-06-05 10:12:05 gewa Exp $
   */
  
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
?>

<?php if(!$user->is_Admin()):?>
	<?php Filter::msgAlert(lang('ADMINONLY'));?>
<?php else:?>

        <!--Body content-->
        <div id="content" class="clearfix">
            <div class="contentwrapper"><!--Content wrapper-->

                <div class="heading">

                    <h3>Konfigurasi Sistem</h3>

                </div><!-- End .heading-->
    				
                <!-- Build page from here: Usual with <div class="row-fluid"></div> -->

                <div class="row-fluid">
                    <div class="span12">

                        <div id="msgholder"></div>

                        <div class="box">

                            <div class="title">
                                <h4> 
                                    <span>Data Konfigurasi</span>
                                </h4>								
                            </div>

                            <div class="content">

                                <form id="admin_form" class="form-horizontal" method="post" action="">			
                                <fieldset>
                                        <div class="form-row row-fluid">
                                                <div class="span12">
                                                        <div class="row-fluid">								
                                                                <label class="form-label span4" for="normal">Nama Owner :</label>
                                                                <input type="text" class="span8 required" name="company" id="company" value="<?php echo $core->company;?>"/>
                                                        </div>
                                                </div>
                                        </div>

                                        <div class="form-row row-fluid">
                                                <div class="span12">
                                                        <div class="row-fluid">								
                                                                <label class="form-label span4" for="normal">Web Site:</label>
                                                                <input name="site_url" type="text" class="span8" value="<?php echo $core->site_url;?>"/>
                                                        </div>
                                                </div>
                                        </div>
                                        <div class="form-row row-fluid">
                                                <div class="span12">
                                                        <div class="row-fluid">								
                                                                <label class="form-label span4" for="normal">E-Mail Kontak:</label>
                                                                <input name="site_email" type="text" class="span8" value="<?php echo $core->site_email;?>"/>
                                                        </div>
                                                </div>
                                        </div>
                                        <div class="form-row row-fluid">
                                                <div class="span12">
                                                        <div class="row-fluid">								
                                                                <label class="form-label span4" for="normal">Alamat:</label>
                                                                <input name="address" type="text" class="span8" value="<?php echo $core->address;?>"/>
                                                        </div>
                                                </div>
                                        </div>
                                        <div class="form-row row-fluid">
                                                <div class="span12">
                                                        <div class="row-fluid">								
                                                                <label class="form-label span4" for="normal">Kota:</label>
                                                                <input name="city" type="text" class="span4" value="<?php echo $core->city;?>"/>
                                                        </div>
                                                </div>
                                        </div>
                                        <div class="form-row row-fluid">
                                                <div class="span12">
                                                        <div class="row-fluid">								
                                                                <label class="form-label span4" for="normal">Propinsi:</label>
                                                                <input name="state" type="text" class="span4" value="<?php echo $core->state;?>"/>
                                                        </div>
                                                </div>
                                        </div>
                                        <div class="form-row row-fluid">
                                                <div class="span12">
                                                        <div class="row-fluid">								
                                                                <label class="form-label span4" for="normal">Kode Pos:</label>
                                                                <input name="postcode" type="text" class="span2" value="<?php echo $core->postcode;?>"/>
                                                        </div>
                                                </div>
                                        </div>
                                        <div class="form-row row-fluid">
                                                <div class="span12">
                                                        <div class="row-fluid">								
                                                                <label class="form-label span4" for="normal">Telepon:</label>
                                                                <input name="phone" type="text" class="span2" value="<?php echo $core->phone;?>"/>
                                                        </div>
                                                </div>
                                        </div>
                                        <div class="form-row row-fluid">
                                                <div class="span12">
                                                        <div class="row-fluid">								
                                                                <label class="form-label span4" for="normal">Fax:</label>
                                                                <input name="fax" type="text" class="span2" value="<?php echo $core->fax;?>"/>
                                                        </div>
                                                </div>
                                        </div>
                                        <div class="form-row row-fluid">
                                                <div class="span12">
                                                        <div class="row-fluid">								
                                                            <label class="form-label span4" for="textarea">File Logo:
                                                                <span class="help-block">File untuk display banner logo.</span></label>
                                                            <div class="grid-inputs span8">
                                                            <input name="logo" class="span4" type="file" />
                                                            &nbsp;&nbsp;
                                                            <input name="dellogo" type="checkbox" value="1" class="styled"/>&nbsp; Hapus file Logo
                                                            </div>
                                                                    
                                                        </div>
                                                </div>
                                        </div>

                                        <div class="form-row row-fluid">
                                                <div class="span12">
                                                        <div class="row-fluid">
                                                                <label class="form-label span4" for="checkboxes">Format Tanggal Pendek:</label>
                                                                <div class="span4 controls">
                                                                        <select name="short_date">
                                                                                <?php echo $core->getShortDate();?>
                                                                        </select>
                                                                </div>
                                                        </div>
                                                </div>
                                        </div>
                                    
                                        <div class="form-row row-fluid">
                                                <div class="span12">
                                                        <div class="row-fluid">
                                                                <label class="form-label span4" for="checkboxes">Format Tanggal Panjang:</label>
                                                                <div class="span4 controls">
                                                                        <select name="long_date">
                                                                                <?php echo $core->getLongDate();?>
                                                                        </select>
                                                                </div>
                                                        </div>
                                                </div>
                                        </div>
                                    
                                        <div class="form-row row-fluid">
                                                <div class="span12">
                                                        <div class="row-fluid">								
                                                                <label class="form-label span4" for="checkboxes">Status Registrasi:
                                                                    <span class="help-block">Registrasi user untuk PTK.</span></label>
                                                                <div class="span8 controls">
                                                                        Aktif
                                                                        <input type="radio" name="enable_reg" value="1" <?php getChecked($core->enable_reg, 1); ?> />
                                                                        Tdk Aktif
                                                                        <input type="radio" name="enable_reg" value="0" <?php getChecked($core->enable_reg, 0); ?> />                                                                        
                                                                </div>
                                                        </div>
                                                </div>
                                        </div>

                                        <div class="form-row row-fluid">
                                                <div class="span12">
                                                        <div class="row-fluid">
                                                                <label class="form-label span4" for="checkboxes">Status Upload:
                                                                    <span class="help-block">Upload data dari software Validasi Lapangan.</span></label>
                                                                <div class="span8 controls">
                                                                        Aktif
                                                                        <input type="radio" name="enable_uploads" id="enable_uploads-1" value="1" <?php getChecked($core->enable_uploads, 1); ?> />
                                                                        Tdk Aktif
                                                                        <input type="radio" name="enable_uploads" id="enable_uploads-2" value="0" <?php getChecked($core->enable_uploads, 0); ?> />
                                                                </div>
                                                        </div>
                                                </div>
                                        </div>
                                        <div class="form-row row-fluid">
                                                <div class="span12">
                                                        <div class="row-fluid">								
                                                                <label class="form-label span4" for="normal">File-Type utk Upload:</label>									
                                                                <input name="file_types" type="text" class="span4" value="<?php echo $core->file_types;?>" size="55"/>
                                                        </div>
                                                </div>
                                        </div>
                                        <div class="form-row row-fluid">
                                                <div class="span12">
                                                        <div class="row-fluid">								
                                                                <label class="form-label span4" for="normal">Diplay Item Per Halaman:
                                                                    <span class="help-block">Jumlah baris pada diplay tabel data.</span></label>
                                                                <input name="perpage" type="text" class="span2" value="<?php echo $core->perpage;?>"/>
                                                        </div>
                                                </div>
                                        </div>

                                        <div class="form-row row-fluid">
                                                <div class="span12">
                                                        <div class="row-fluid">
                                                                <label class="form-label span4" for="checkboxes">Mailer:
                                                                    <span class="help-block">Sistem E-Mail otomatis.</span></label>
                                                                <div class="span2 controls">
                                                                        <select name="mailer" id="mailerchange">
                                                                            <option value="PHP"<?php if ($core->mailer == "PHP") echo "selected=\"selected\"";?>>PHP Mailer</option>
                                                                            <option value="SMTP"<?php if ($core->mailer == "SMTP") echo "selected=\"selected\"";?>>SMTP Mailer</option>
                                                                            <option value="SMAIL"<?php if ($core->mailer == "SMAIL") echo "selected=\"selected\"";?>>Sendmail</option>
                                                                        </select>
                                                                </div>
                                                        </div>
                                                </div>
                                        </div>
                                    
                                        <!-- <div class="form-row row-fluid">
                                                <div class="span12">
                                                        <div class="row-fluid">								
                                                                <label class="form-label span4" for="normal">Path Sendmail:</label>
                                                                <input name="sendmail" type="text" class="span4" value="<?php echo $core->sendmail;?>" size="55"/>
                                                        </div>
                                                </div>
                                        </div> -->

                                        <div class="form-row row-fluid">
                                                <div class="span12">
                                                        <div class="row-fluid">								
                                                                <label class="form-label span4" for="normal">Host SMTP:</label>
                                                                <input name="smtp_host" type="text" class="span4" value="<?php echo $core->smtp_host;?>" size="55"/>
                                                        </div>
                                                </div>
                                        </div>
                                        <div class="form-row row-fluid">
                                                <div class="span12">
                                                        <div class="row-fluid">								
                                                                <label class="form-label span4" for="normal">User SMTP:</label>
                                                                <input name="smtp_user" type="text" class="span4" value="<?php echo $core->smtp_user;?>" size="55"/>
                                                        </div>
                                                </div>
                                        </div>
                                        <div class="form-row row-fluid">
                                                <div class="span12">
                                                        <div class="row-fluid">								
                                                                <label class="form-label span4" for="normal">Password SMTP:</label>
                                                                <input name="smtp_pass" type="text" class="span4" value="<?php echo $core->smtp_pass;?>" size="55"/>
                                                        </div>
                                                </div>
                                        </div>
                                        <div class="form-row row-fluid">
                                                <div class="span12">
                                                        <div class="row-fluid">								
                                                                <label class="form-label span4" for="normal">Port SMTP:</label>
                                                                <input name="smtp_port" type="text" class="span2" value="<?php echo $core->smtp_port;?>" size="5"/>
                                                        </div>
                                                </div>
                                        </div>
                                    

                                        <div class="form-actions">
                                            <button type="submit" class="btn btn-info">Save</button>
                                            <button type="button" class="btn" onclick="history.back()">Kembali</button>
                                        </div>

                                    </fieldset>
                                    </form>       

                            <?php echo Core::doForm("processConfig");?> 

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
	
<?php endif;?>
