

<?php
// Gunakan variabel $handle untuk mendapatkan permission
$handle = @opendir('.'); 

// Action jika $handle TRUE (permission granted)
if ($handle) {
	// Variabel $files bertipe array untuk menampung nama berkas
	$files = Array();

	echo 'Files: <br>';

	// Gunakan variabel $file penampungan sementara nama berkas hasil fungsi readdir
	while (($file = readdir($handle)) !== false) {
		// Kelompokkan berkas berdasarkan tipe,
		// untuk tipe folder(dir) diberikan prefix (FOLDER).
		// Semua nama berkas disimpan pada variabel $files
		if(filetype($file)=='dir') {
			//array_push($files, '(FOLDER) '.$file);
			array_push($files, $file);
		} else{
			array_push($files, $file);
			//<a href="file/'.$file.'">'.$file.'</a>
			
		}
	}

	// Urutkan elemen $files, memastikan folder berada di index awal
	sort($files);

	// Menampilkan semua elemen $files (folder & file)
	foreach($files as $f) {
		//echo $f.' <br>';
		echo"<a href='$f'>$f </a>";
		echo"<br>";
	}

	// Tutup handle folder
	closedir($handle);
} 

// action jika $handle FALSE (permission denied/folder not found)
else {
	echo 'Gagal mengakses folder';
}

?>