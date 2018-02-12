<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">


    <head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Upload Data Verval</title>
		<link rel="stylesheet" type="text/css" href="css/blue.css" />
    </head>


    <body>
    <p>http://diklat2.tedcbandung.com/uploads</p>
    <fieldset>
    <legend><strong>Upload File Data Verval ke Server</strong></legend>
    <form enctype="multipart/form-data" action="ProsesUpload.php" method="post">
    <input type="hidden" name="MAX_FILE_SIZE" value="2000000000" />
	<p>
	
	Pastikan nama file yang akan di-upload/ unggah, mengikuti format sebagai berikut,<br> 
	Kelas Sasaran[02-E-1] 17-03-2014_hendra.ptk (untuk data file data lokal)<br>
	Kelas Sasaran[02-E-1] 17-03-2014_hendra - Penilaian.xlsx (untuk data file Penilaian)<br>
	
</p>
	
    Pilih file yang akan di-upload: <input name="userfile" type="file" class="smallInput wide"/>
<p>
    <input type="submit" value=".   - Kirim -   ." />

 </p>
    </form>
    </fieldset>
    <p> </p>
    </body>
    </html>