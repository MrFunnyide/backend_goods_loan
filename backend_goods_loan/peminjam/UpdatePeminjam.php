<?php
include "../config/koneksi.php";

$id = $_POST["id"];
$nama = $_POST["nama"];
$no_telp = $_POST['no_telp'];
$alamat = $_POST['alamat'];
$email = $_POST['email'];
$jenis_kelamin = $_POST['jenis_kelamin'];

try {
    if (trim($id) != '' && trim($nama) != '' && trim($no_telp) != '' && trim($alamat) != '' && trim($email) != '' && trim($jenis_kelamin) != '') {

        $QuaryUpdatePeminjam = "UPDATE `peminjam` set `nama` = '$nama',`no_telp`= '$no_telp',`alamat` = '$alamat',`email` = '$email',`jenis_kelamin` = '$jenis_kelamin' WHERE `id` = '$id'";
        $execute= mysqli_query($Conn, $QuaryUpdatePeminjam);

        if ($execute) {
            $response['status'] = "sukses";
            $response['pesan'] = "Berhasil Update Data Peminjam";
        } else {
            $response['status'] = "gagal";
            $response['pesan'] = "Gagal Update Data Peminjam";
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