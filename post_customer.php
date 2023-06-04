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

<!DOCTYPE html>
<html>

<head>
    <title>Tambah Data Customer</title>
</head>

<body>
    <h1>Tambah Data Customer</h1>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="nama">Nama:</label>
        <input type="text" id="nama" name="nama" required><br><br>

        <label for="alamat">Alamat:</label>
        <input type="text" id="alamat" name="alamat" required><br><br>

        <label for="umur">Umur:</label>
        <input type="number" id="umur" name="umur" required><br><br>

        <label for="no_telp">No. Telp:</label>
        <input type="tel" id="no_telp" name="no_telp" required><br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>

        <input type="submit" value="Simpan">
    </form>
    <br>
    <div>
        <a href="index.php">
            <button>
                Back
            </button>
        </a>
    </div>
</body>

</html>