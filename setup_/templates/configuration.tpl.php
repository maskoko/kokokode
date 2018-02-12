<div class="inner-content"><a href="install.php">pre-installation check</a> &raquo; <a href="install.php?step=1">license</a> &raquo; <b>configuration</b> &raquo; completed</div>
<h2 id="install"><img src="img/config.png" alt="" />General Configuration</h2>
<?php echo ($msg) ?  "<div class=\"error\">{$msg}</div>" : '';?>
<form action="install.php?step=2" method="post">
  <table width="100%" cellpadding="0" cellspacing="0">
    <tr>
      <td><h3>1. MySQL database configuration:</h3></td>
    </tr>
    <tr>
      <td class="item-desc">Setting up SIM PPPPTK BMTI Bandung to run on your server involves 3 simple steps...Please enter the hostname of the server SIM PPPPTK BMTI Bandung is to be installed on. Enter the MySQL username, password and database name you wish to use with SIM PPPPTK BMTI Bandung. It's strongly recommended to install sample data. </td>
    </tr>
    <tr>
      <td><table width="100%" class="inner-content">
          <tr>
            <td width="200" nowrap="nowrap">MySQL Hostname:</td>
            <td nowrap="nowrap"><input type="text" name="dbhost" size="30" value="<?php echo isset($_POST['dbhost']) ? sanitize($_POST['dbhost']) : 'localhost'; ?>" id="t1" /></td>
            <td width="100%"><div class="err" id="err1">Please input correct MySQL hostname.</div></td>
          </tr>
          <tr>
            <td nowrap="nowrap">MySQL User Name:</td>
            <td><input type="text" name="dbuser" size="30" value="<?php echo isset($_POST['dbuser']) ? sanitize($_POST['dbuser']) : ''; ?>" id="t2" /></td>
            <td><div class="err" id="err2">Please input correct MySQL username.</div></td>
          </tr>
          <tr>
            <td>MySQL Password:</td>
            <td><input type="password" name="dbpwd" size="30" value="" /></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td nowrap="nowrap">MySQL Database Name:</td>
            <td><input type="text" name="dbname" size="30" value="<?php echo isset($_POST['dbname']) ? sanitize($_POST['dbname']) : ''; ?>" id="t3"/></td>
            <td><div class="err" id="err3">Please input correct database name.</div></td>
          </tr>
          <tr>
            <td nowrap="nowrap">Install sample data:</td>
            <td><input type="checkbox" id="install_data" name="install_data" checked="checked" /></td>
            <td>&nbsp;</td>
          </tr>
        </table>
        <input type="hidden" name="db_action" id="db_action" value="1" /></td>
    </tr>
    <tr>
      <td><h3>2. Common configuration</h3></td>
    </tr>
    <tr>
      <td class="item-desc">Configure correct paths and URLs to your SIM PPPPTK BMTI Bandung.</td>
    </tr>
    <tr>
      <td><table width="100%" class="inner-content">
          <tr>
            <td width="200">URL:</td>
            <td><input type="text" name="site_url" value="http://<?php echo $_SERVER['SERVER_NAME'].$script_path;?>" size="30"/></td>
          </tr>
          <tr>
            <td>Site Name:</td>
            <td><input type="text" name="site_name" value="Your Site Name" size="30"/></td>
          </tr>
          <tr>
            <td>Company Name:</td>
            <td><input type="text" name="company" value="Your Company Name" size="30"/></td>
          </tr>
          <tr>
            <td>Site Email:</td>
            <td><input type="text" name="site_email" value="site@mail.com" size="30"/></td>
          </tr>
        </table></td>
    </tr>
    <tr>
      <td><h3>3. Administrator configuration</h3></td>
    </tr>
    <tr>
      <td class="item-desc">Please set your admin username. It will be used for loggin to your admin panel.You should input admin password. Make sure your entered passwords match each other.Input your email. All the notifications will be sent from this email. It can be changed in your admin panel later.</td>
    </tr>
    <tr>
      <td><table width="100%" class="inner-content">
          <tr>
            <td width="200" nowrap="nowrap">Admin Username:</td>
            <td nowrap="nowrap"><input type="text" name="admin_username" value="<?php echo isset($_POST['admin_username']) ? sanitize($_POST['admin_username']) : 'admin'; ?>" size="30" id="t4" /></td>
            <td width="100%"><div class="err" id="err4">Please input correct admin username.</div></td>
          </tr>
          <tr>
            <td nowrap="nowrap">Admin Password:</td>
            <td nowrap="nowrap"><input type="password" name="admin_password" value="<?php echo isset($_POST['admin_password']) ? sanitize($_POST['admin_password']) : ''; ?>" size="30" id="t5" /></td>
            <td><div class="err" id="err5">Please input password.</div></td>
          </tr>
          <tr>
            <td nowrap="nowrap">Admin Password[confirm]:</td>
            <td nowrap="nowrap"><input type="password" name="admin_password2" value="" size="30" id="t6" /></td>
            <td><div class="err" id="err6">Entered passwords do not match.</div></td>
          </tr>
      </table></td>
    </tr>
  </table>
  <div class="btn lgn">
    <button type="button" onclick="document.location.href='install.php?step=1';" name="back">Back</button>
    &nbsp;&nbsp;
    <button type="submit" name="next">Next</button>
  </div>
</form>