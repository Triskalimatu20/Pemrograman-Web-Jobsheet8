<?php
// Lokasi penyimpanan file gambar
$targetDirectory = "uploads/";

// Membuat folder uploads jika belum ada
if (!file_exists($targetDirectory)) {
    mkdir($targetDirectory, 0777, true);
}

// Periksa apakah ada file yang diunggah
if (!empty($_FILES['images']['name'][0])) {
    $totalFiles = count($_FILES['images']['name']);
    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];

    // Loop untuk setiap file gambar
    for ($i = 0; $i < $totalFiles; $i++) {
        $fileName = $_FILES['images']['name'][$i];
        $tmpName = $_FILES['images']['tmp_name'][$i];
        $fileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        $targetFile = $targetDirectory . basename($fileName);

        // Validasi tipe file
         if (in_array($fileType, $allowedExtensions)) {
            if (move_uploaded_file($tmpName, $targetFile)) {
                echo "File <b>$fileName</b> berhasil diunggah.<br>";
            } else {
                echo "Gagal mengunggah file <b>$fileName</b>.<br>";
            }
        } else {
            echo "File <b>$fileName</b> tidak valid. Hanya file gambar yang diizinkan.<br>";
        }
    }
} else {
    echo "Tidak ada file yang diunggah.";
}
?>