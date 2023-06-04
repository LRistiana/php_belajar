<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mongoClient = new MongoDB\Driver\Manager("mongodb://localhost:27017");
    $dbName = "db_manajemen_apotek";
    $collectionName = "customer";

    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $umur = $_POST['umur'];
    $no_telp = $_POST['no_telp'];
    $email = $_POST['email'];

    $customer = [
        'nama' => $nama,
        'alamat' => $alamat,
        'umur' => $umur,
        'no_telp' => $no_telp,
        'email' => $email
    ];

    $bulk = new MongoDB\Driver\BulkWrite;
    $bulk->insert($customer);
    $mongoClient->executeBulkWrite("$dbName.$collectionName", $bulk);

    echo "Data customer berhasil disimpan.";
}
?>
