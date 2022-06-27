<?php
include "../config/koneksi.php";

try {
    $queryPeminjam = "SELECT * FROM peminjam";

    $eksekusi = mysqli_query($Conn, $queryPeminjam);

    $response['status'] = 'sukses';
    $response['pesan'] = 'Menampilkan Data';
    $response['data'] = array();

    while($ambil = mysqli_fetch_object($eksekusi)){
        $F["id"] = $ambil->id;
        $F["nama"] = $ambil->nama;
        $F["no_telp"] = $ambil->no_telp;
        $F["alamat"] = $ambil->alamat;
        $F["email"] = $ambil->email;
        $F["jenis_kelamin"] = $ambil->jenis_kelamin;

        // push ke dalam data array
        array_push($response['data'], $F);

    }
} catch (Exception $e) {
    $response['status'] = 'gagal';
    $response['pesan'] = $e->getMessage();
}

$json = json_encode($response, JSON_PRETTY_PRINT);
echo $json;