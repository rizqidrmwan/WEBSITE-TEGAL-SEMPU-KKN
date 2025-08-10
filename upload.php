<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $judul = $_POST["judul"];
    $tanggal = $_POST["tanggal"];
    $targetDir = "uploads/";
    $fileName = time() . "_" . basename($_FILES["gambar"]["name"]);
    $targetFilePath = $targetDir . $fileName;

    if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $targetFilePath)) {
        $info = [
            "judul" => $judul,
            "tanggal" => $tanggal
        ];
        file_put_contents($targetFilePath . "/info.json", json_encode($info));
        header("Location: Dokumentasi.php");
    } else {
        echo "Gagal upload.";
    }
}
?>
