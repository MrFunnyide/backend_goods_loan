<?php
include "config/koneksi.php";

if ($_POST) {
    // data
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // simpan data
    $response = [];

    // cek id di database
    $userQuery = $conn->prepare("SELECT * FROM user WHERE username= ?");

    $userQuery->execute(array($username));
    $query = $userQuery->fetch();

    if ($userQuery->rowCount() == 0) {
        // code
        $response['status'] = false;
        $response['message'] = "Username tidak ditemukan";
    } else {
        // ambil password
        $passwordDb = $query['password'];

        // cek password
        if (strcmp($password, $passwordDb) === 0 ) {
            // code
            $response['status'] = true;
            $response['message'] = "login berhasil";
            $response['data'] = [
                'id' => $query['id'],
                'nama' => $query['nama'],
                'username' => $query['username'],
                'no_telp' => $query['no_telp'],
                'alamat' => $query['alamat'],
                'email' => $query['email']
            ];
        } else {
            $response['status'] = false;
            $response['message'] = "password salah";
        }
    }

    // jadikan data jadi json
    $json = json_encode($response, JSON_PRETTY_PRINT);

    // print
    echo $json;
}