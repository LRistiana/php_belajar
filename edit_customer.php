<?php
$mongoClient = new MongoDB\Driver\Manager("mongodb://localhost:27017");
$dbName = "db_manajemen_apotek";
$collectionName = "customer";

// Mendapatkan data semua customer
$query = new MongoDB\Driver\Query([]);
$cursor = $mongoClient->executeQuery("$dbName.$collectionName", $query);
$customers = $cursor->toArray();

// Mendapatkan ID customer yang akan diedit dari form
$id = $_POST['id'];

// Mendapatkan data customer berdasarkan ID
$filter = ['_id' => new MongoDB\BSON\ObjectID($id)];
$query = new MongoDB\Driver\Query($filter);
$cursor = $mongoClient->executeQuery("$dbName.$collectionName", $query);
$customer = $cursor->toArray()[0];

// Mengupdate data customer setelah pengiriman formulir
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $umur = $_POST['umur'];
    $no_telp = $_POST['no_telp'];
    $email = $_POST['email'];

    $updateData = [
        '$set' => [
            'nama' => $nama,
            'alamat' => $alamat,
            'umur' => $umur,
            'no_telp' => $no_telp,
            'email' => $email
        ]
    ];

    $bulk = new MongoDB\Driver\BulkWrite;
    $bulk->update(['_id' => new MongoDB\BSON\ObjectID($id)], $updateData);
    $mongoClient->executeBulkWrite("$dbName.$collectionName", $bulk);

    echo "Data customer berhasil diupdate.";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Data Customer</title>
</head>
<body>
    <h1>Update Data Customer</h1>
    <h2>Data Customer</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Alamat</th>
            <th>Umur</th>
            <th>No. Telp</th>
            <th>Email</th>
        </tr>
        <?php foreach ($customers as $customer): ?>
            <tr>
                <td><?php echo $customer->_id; ?></td>
                <td><?php echo $customer->nama; ?></td>
                <td><?php echo $customer->alamat; ?></td>
                <td><?php echo $customer->umur; ?></td>
                <td><?php echo $customer->no_telp; ?></td>
                <td><?php echo $customer->email; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

    <h2>Form Update Data Customer</h2>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="id">ID:</label>
        <input type="text" id="id" name="id" required><br><br>

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

        <input type="submit" value="Update">
    </form>
    <div>
        <a href="index.php">
            <button>
                Back
            </button>
        </a>
    </div>
</body>
</html>
