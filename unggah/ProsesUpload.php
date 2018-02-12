    <?php
    $uploaddir = 'verval/';
    $uploadfile = $uploaddir . $_FILES['userfile']['name'];
    if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile))
    {
    echo "File sudah sukses diupload ke server pada folder dan nama file
    $uploadfile <br>";
	echo "<a href='./verval'> Lihat file yang sudah di-upload</a>";
    }
    else
    {
    echo "File tidak ada atau Proses upload gagal, kode error = " .
    $_FILES['userfile']['error'];
    }
    ?>