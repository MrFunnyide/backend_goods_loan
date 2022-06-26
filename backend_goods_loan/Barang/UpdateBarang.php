<?php
include "../config/koneksi.php";
//header('Access-Control-Allow-Origin: *');
//header('Access-Control-Allow-Methods: GET, POST');
//header("Access-Control-Allow-Headers: X-Requested-With");
//header("Content-Type: application/json; charset=UTF-8");

$kode_brg = $_POST["kode_brg"];
$nama_brg = $_POST["nama_brg"];
$kondisi_brg = $_POST["kondisi_brg"];
$deskripsi_brg = $_POST["deskripsi_brg"];
$category_brg = $_POST["category_brg"];

$response = [];

try {

    if (trim($kode_brg) != '' && trim($nama_brg) != '' && trim($kondisi_brg) != '' && trim($deskripsi_brg) != '' && trim($category_brg) != '') {
        // uploud image
        $target_dir = "img/";
        $target_file = $target_dir . rand(999, 9999) . basename($_FILES['gambar_brg']['name']);
        $uploudOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        // cek jika image betu betul gambar
        $check = getimagesize($_FILES['gambar_brg']['tmp_name']);
        if ($check != false) {
            // pindah img ke folder
            if (move_uploaded_file($_FILES['gambar_brg']['tmp_name'], $target_file)) {
                // sambung url
                $ip_server = 'http://127.0.0.1/';
                $folder_root = 'backend_goods_loan/Barang/';
                $url = $ip_server . $folder_root . $target_file;


                $queryUpdate = "UPDATE `Barang` SET `nama_brg`='$nama_brg',`kondisi_brg` = '$kondisi_brg',`deskripsi_brg` = '$deskripsi_brg',`category_brg`='$category_brg' WHERE `kode_brg` = $kode_brg";

                $execute= mysqli_query($Conn, $queryUpdate);

                if ($execute) {
                    $response['status'] = "sukses";
                    $response['pesan'] = "Berhasil Update Barang";
                } else {
                    $response['status'] = "failed";
                    $response['status'] = "Gagal Update Barang";
                }
            } else {
                $response['status'] = 'gagal';
                $response['pesan'] = 'gagal menguploud file';

            }
        } else {
            $response["status"] = "failed";
            $response["pesan"] = "Tolong upload image";
        }
    } else {
        $response["status"] = "failed";
        $response["pesan"] = "Data tidak boleh kosong";
    }
} catch (mysqli_sql_exception $exception) {
    $response['status'] = 'failed';
    $response["pesan"] = 'Gagal terhubung ke server';
}

$json = json_encode($response, JSON_PRETTY_PRINT);
echo $json;