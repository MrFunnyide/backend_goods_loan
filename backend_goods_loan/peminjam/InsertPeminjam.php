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

        $QueryTambahPeminjam = "INSERT INTO `peminjam` (`id`, `nama`,`no_telp`,`alamat`,`email`,`jenis_kelamin`) VALUES ('$id', '$nama', '$no_telp', '$alamat', '$email', '$jenis_kelamin')";

        $execute= mysqli_query($Conn, $QueryTambahPeminjam);

        if ($execute) {
            $response['status'] = "sukses";
            $response['pesan'] = "Berhasil Menambahkan Data Peminjam";
        } else {
            $response['status'] = "gagal";
            $response['pesan'] = "Gagal Menambahkan Data Peminjam";
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