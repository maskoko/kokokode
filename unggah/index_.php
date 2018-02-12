    <html>
    <head>
    <title>Contoh Form Upload dengan PHP</title>
    </head>
    <body>
    <p> Form Upload instrumen TNA Online </p>
    <fieldset>
    <legend>Kirim Instrumen TNA ke Server</legend>
    <form enctype="multipart/form-data" action="ProsesUpload.php"
    method="post">
    <input type="hidden" name="MAX_FILE_SIZE" value="2000000000" />
    Pilih file instrumen TNA: 
    <input name="userfile" type="file" /><p>
    <input type="submit" value="Kirim" /> </p>
    </form>
    </fieldset>
    <p> </p>
    </body>
    </html>