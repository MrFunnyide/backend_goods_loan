<?php
include "../config/koneksi.php";

try {
    $queryAudio = "SELECT * FROM Barang WHERE category_brg LIKE '%Audio'";

    $eksekusi = mysqli_query($Conn, $queryAudio);

    $response['status'] = 'sukses';
    $response['pesan'] = 'Menampilkan Data';
    $response['data'] = array();

    while($ambil = mysqli_fetch_object($eksekusi)){
        $F["kode_brg"] = $ambil->kode_brg;
        $F["nama_brg"] = $ambil->nama_brg;
        $F["kondisi_brg"] = $ambil->kondisi_brg;
        $F["deskripsi_brg"] = $ambil->deskripsi_brg;
        $F["gambar_brg"] = $ambil->gambar_brg;
        $F["category_brg"] = $ambil->category_brg;

        // push ke dalam data array
        array_push($response['data'], $F);

    }
} catch (Exception $e) {
    $response['status'] = 'gagal';
    $response['pesan'] = $e->getMessage();
}

$json = json_encode($response, JSON_PRETTY_PRINT);
echo $json;
