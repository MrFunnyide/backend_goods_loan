<?php
include "../config/koneksi.php";

$no_peminjaman = $_POST["no_peminjaman"];
$nama_barang = $_POST["nama_barang"];
$tgl_pinjam = $_POST['tgl_pinjam'];
$tgl_kembali = $_POST['tgl_kembali'];
$kode_brg = $_POST['kode_brg'];
$nama_peminjam = $_POST['nama_peminjam'];

try {
    if (trim($no_peminjaman) != '' && trim($nama_barang) != '' && trim($tgl_pinjam) != '' && trim($tgl_kembali) != '' && trim($kode_brg) != '' && trim($nama_peminjam) != '') {

        $QueryTambahPeminjam = "INSERT INTO `Peminjaman` (`no_peminjaman`, `nama_barang`,`tgl_pinjam`,`tgl_kembali`,`kode_brg`,`nama_peminjam`) VALUES ('$no_peminjaman', '$nama_barang', '$tgl_pinjam', '$tgl_kembali', '$kode_brg', '$nama_peminjam')";

        $execute= mysqli_query($Conn, $QueryTambahPeminjam);

        if ($execute) {
            $response['status'] = "sukses";
            $response['pesan'] = "Berhasil Menambahkan Data Peminjaman";
        } else {
            $response['status'] = "gagal";
            $response['pesan'] = "Gagal Menambahkan Data Peminjaman";
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