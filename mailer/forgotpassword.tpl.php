<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>PPPPTK BMTI Bandung :: Reset Password</title>
<style type="text/css">
a { color: #2D7BE0; }
a:hover { text-decoration: none; }
</style>
</head>
<body>
<div style="font-family:Arial, Helvetica, sans-serif; font-size:13px;margin:20px" align="center">
  <table style="background-color:#F4F4F4; border: 2px solid #bbbbb;" border="0" cellpadding="10" cellspacing="5" width="650">
    <tbody>
      <tr>
        <th style="background-color:#ccc; font-size:16px;padding:5px;border-bottom-width:2px; border-bottom-color:#fff; border-bottom-style:solid">
			   Konfirmasi Reset Password
		    </th>
      </tr>
      <tr>
        <td style="text-align: left;" valign="top"> Kepada Yth, <?php echo $row->username; ?></td>
      </tr>
      <tr>
        <td style="text-align: left;" valign="top"><em>Silahkan klik link berikut untuk mengganti password anda : <a href="http://diklat.tedcbandung.com/forgotpassword.php?tokenkey=<?php echo $tokendata['tokenkey']; ?>">http://diklat.tedcbandung.com/forgotpassword.php?tokenkey=<?php echo $tokendata['tokenkey']; ?></a><br/></em></td>
      </tr>
      <tr>
        <td style="text-align: left; background-color:#fff;border-top-width:2px; border-top-color:#ccc; border-top-style:solid;font-size:12px" valign="top"> E-Mail ini dikirim secara otomatis, mohon untuk mengirim balik ke alamat email ini. &copy;<?php echo date('Y');?>. All rights reserved.</td>
      </tr>
    </tbody>
  </table>
</div>
</body>
</html>