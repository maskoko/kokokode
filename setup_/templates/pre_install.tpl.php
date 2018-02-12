<script type="text/javascript" src="script.js"></script>
<div class="inner-content"><b>pre-installation check</b> &raquo; license &raquo; configuration &raquo; completed</div>
<h2 id="install"><img src="img/pre-install.png" alt="" />Pre-installation check</h2>
<table width="100%" cellpadding="0" cellspacing="0">
  <tr>
    <td><h3>1. Server configuration</h3></td>
  </tr>
  <tr>
    <td class="item-desc">If any of these items are highlighted in red then please take actions to correct them. Failure to do so could lead to your installation not functioning correctly.            </td>
  </tr>
  <tr>
    <td><table width="100%" class="inner-content">
          <tr>
            <th width="35%" align="left"><b>PHP Settings</b></th>
            <th width="25%" align="left"><b>Current Settings</b></th>
            <th width="25%" align="left"><b>Required Settings</b></th>
            <th width="15%" align="center"><b>Status</b></th>
          </tr>
          <tr>
            <td>PHP Version:</td>
            <td><?php echo phpversion(); ?></td>
            <td>5.2+</td>
            <td align="center"><?php echo (phpversion() >= '5.2') ? '<img src="img/yes.png" alt="Good" />' : '<img src="img/no.png" alt="Bad" />'; ?></td>
          </tr>
          <tr>
            <td>Register Globals:</td>
            <td><?php echo (ini_get('register_globals')) ? 'On' : 'Off'; ?></td>
            <td>Off</td>
            <td align="center"><?php echo (!ini_get('register_globals')) ? '<img src="img/yes.png" alt="Good" />' : '<img src="img/no.png" alt="Bad" />'; ?></td>
          </tr>
          <tr>
            <td>Magic Quotes GPC:</td>
            <td><?php echo (ini_get('magic_quotes_gpc')) ? 'On' : 'Off'; ?></td>
            <td>Off</td>
            <td align="center"><?php echo (!ini_get('magic_quotes_gpc')) ? '<img src="img/yes.png" alt="Good" />' : '<img src="img/no.png" alt="Bad" />'; ?></td>
          </tr>
          <tr>
            <td>File Uploads:</td>
            <td><?php echo (ini_get('file_uploads')) ? 'On' : 'Off'; ?></td>
            <td>On</td>
            <td align="center"><?php echo (ini_get('file_uploads')) ? '<img src="img/yes.png" alt="Good" />' : '<img src="img/no.png" alt="Bad" />'; ?></td>
          </tr>
          <tr>
            <td>Session Auto Start:</td>
            <td><?php echo (ini_get('session_auto_start')) ? 'On' : 'Off'; ?></td>
            <td>Off</td>
            <td align="center"><?php echo (!ini_get('session_auto_start')) ? '<img src="img/yes.png" alt="Good" />' : '<img src="img/no.png" alt="Bad" />'; ?></td>
          </tr>
        </table></td>
  </tr>
  <tr>
    <td><h3>2. Server Extensions</h3></td>
  </tr>
  <tr>
    <td class="item-desc">These settings are recommended for PHP in order to ensure full compatibility with SIM PPPPTK BMTI Bandung.
      However, SIM PPPPTK BMTI Bandung will still operate if your settings do not quite match the recommended.</td>
  </tr>
  <tr>
    <td>            <table width="100%" class="inner-content">
          <tr>
            <th width="35%" align="left"><b>Extension</b></th>
            <th width="25%" align="left"><b>Current Settings</b></th>
            <th width="25%" align="left"><b>Required Settings</b></th>
            <th width="15%" align="center"><b>Status</b></th>
          </tr>
          <tr>
            <td>MySQL:</td>
            <td><?php echo extension_loaded('mysql') ? 'On' : 'Off'; ?></td>
            <td>On</td>
            <td align="center"><?php echo extension_loaded('mysql') ? '<img src="img/yes.png" alt="Good" />' : '<img src="img/no.png" alt="Bad" />'; ?></td>
          </tr>
          <tr>
            <td>GD:</td>
            <td><?php echo extension_loaded('gd') ? 'On' : 'Off'; ?></td>
            <td>On</td>
            <td align="center"><?php echo extension_loaded('gd') ? '<img src="img/yes.png" alt="Good" />' : '<img src="img/no.png" alt="Bad" />'; ?></td>
          </tr>
          <tr>
            <td>ZIP:</td>
            <td><?php echo extension_loaded('zlib') ? 'On' : 'Off'; ?></td>
            <td>On</td>
            <td align="center"><?php echo extension_loaded('zlib') ? '<img src="img/yes.png" alt="Good" />' : '<img src="img/no.png" alt="Bad" />'; ?></td>
          </tr>
          <tr>
            <td>DOMDocument:</td>
            <td><?php echo class_exists('DOMDocument') ? 'On' : 'Off'; ?></td>
            <td>On</td>
            <td align="center"><?php echo class_exists('DOMDocument') ? '<img src="img/yes.png" alt="Good" />' : '<img src="img/no.png" alt="Bad" />'; ?></td>
          </tr>
          <tr>
            <td>Zlib:</td>
            <td><?php echo function_exists('gzcompress') ? 'On' : 'Off'; ?></td>
            <td>On</td>
            <td align="center"><?php echo function_exists('gzcompress') ? '<img src="img/yes.png" alt="Good" />' : '<img src="img/no.png" alt="Bad" />'; ?></td>
          </tr>
        </table></td>
  </tr>
  <tr>
    <td><h3>3. Directory &amp; File Permissions</h3></td>
  </tr>
  <tr>
    <td class="item-desc">In order for SIM PPPPTK BMTI Bandung to function correctly it needs to be able to access or write to certain files or directories. If you see "Unwriteable" you need to change the permissions on the file or directory to allow SIM PPPPTK BMTI Bandung to write to it. </td>
  </tr>
  <tr>
    <td>
        <table width="100%" class="inner-content">
        <?php
			getWritableCell('lib');
		?>
        <?php
			getWritableCell('uploads');
		?>
        <?php
			getWritableCell('uploads'.CMS_DS.'data');
		?>
        <?php
			getWritableCell('uploads'.CMS_DS.'avatars');
		?>
      </table>
    </td>
  </tr>
</table>
<div class="btn lgn">
  <button type="button" onclick="document.location.href='install.php';" name="check">Check</button>
  &nbsp;&nbsp;
  <button type="button" onclick="document.location.href='install.php?step=1';" name="next" tabindex="3" >Next</button>
</div>