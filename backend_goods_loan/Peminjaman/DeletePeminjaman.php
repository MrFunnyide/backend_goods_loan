<?php
include "../config/koneksi.php";
//header('Access-Control-Allow-Origin: *');
//header('Access-Control-Allow-Methods: GET, POST');
//header("Access-Control-Allow-Headers: X-Requested-With");
//header("Content-Type: application/json; charset=UTF-8");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // kode
    $no_peminjaman = $_POST['no_peminjaman'];

    $perintah = "DELETE FROM Peminjaman WHERE no_peminjaman =  '$no_peminjaman'";
    $eksekusi = mysqli_query($Conn, $perintah);
    $cek = mysqli_affected_rows($Conn);

    if ($cek > 0) {
        $response['status'] = 'sukses';
        $response['pesan'] = 'Data berhasil di hapus';
    } else {
        $response['status'] = 'gagal';
        $response['pesan'] = 'Gagal Menghapus Data';
    }
} else {
    $response['status'] = 'gagal';
    $response['pesan'] = 'Tidak ada data yang di post';
}

echo json_encode($response);
mysqli_close($Conn);