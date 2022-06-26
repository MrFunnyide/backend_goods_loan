<?php
include "../config/koneksi.php";

try {
    $queryPeminjaman = "SELECT * FROM Peminjaman";

    $eksekusi = mysqli_query($Conn, $queryPeminjaman);

    $response['status'] = 'sukses';
    $response['pesan'] = 'Menampilkan Data';
    $response['data'] = array();

    while($ambil = mysqli_fetch_object($eksekusi)){
        $F["no_peminjaman"] = $ambil->no_peminjaman;
        $F["nama_barang"] = $ambil->nama_barang;
        $F["tgl_pinjam"] = $ambil->tgl_pinjam;
        $F["tgl_kembali"] = $ambil->tgl_kembali;
        $F["kode_brg"] = $ambil->kode_brg;
        $F["nama_peminjam"] = $ambil->nama_peminjam;

        // push ke dalam data array
        array_push($response['data'], $F);

    }
} catch (Exception $e) {
    $response['status'] = 'gagal';
    $response['pesan'] = $e->getMessage();
}

$json = json_encode($response, JSON_PRETTY_PRINT);
echo $json;
