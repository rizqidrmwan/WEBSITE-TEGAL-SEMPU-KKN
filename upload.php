<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $judul = $_POST['judul'];
    $tanggal = $_POST['tanggal'];

    $target_dir = "uploads/";
    $file_name = basename($_FILES["file"]["name"]);
    $target_file = $target_dir . time() . "_" . $file_name;

    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
        $stmt = $conn->prepare("INSERT INTO dokumentasi (judul, tanggal, file_path) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $judul, $tanggal, $target_file);
        $stmt->execute();
        echo "Upload berhasil!";
    } else {
        echo "Gagal upload file!";
    }
}
?>

<form method="post" enctype="multipart/form-data">
  <input type="text" name="judul" placeholder="Judul Kegiatan" required><br>
  <input type="date" name="tanggal" required><br>
  <input type="file" name="file" required><br>
  <button type="submit">Upload</button>
</form>
