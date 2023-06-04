<?php
$mongoClient = new MongoDB\Driver\Manager("mongodb://localhost:27017");
$dbName = "db_manajemen_apotek";
$collectionName = "customer";

// Mendapatkan data semua customer
$query = new MongoDB\Driver\Query([]);
$cursor = $mongoClient->executeQuery("$dbName.$collectionName", $query);
$customers = $cursor->toArray();

// Menghapus data customer berdasarkan ID
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];

    $deleteData = ['_id' => new MongoDB\BSON\ObjectID($id)];

    $bulk = new MongoDB\Driver\BulkWrite;
    $bulk->delete($deleteData);
    $mongoClient->executeBulkWrite("$dbName.$collectionName", $bulk);

    echo "Data customer berhasil dihapus.";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Delete Data Customer</title>
</head>
<body>
    <h1>Delete Data Customer</h1>
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

    <h2>Form Delete Data Customer</h2>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="id">ID:</label>
        <input type="text" id="id" name="id" required><br><br>

        <input type="submit" value="Delete">
    </form>
    <a href="delete_customer.php">
        <button>
            Delete Data
        </button>
    </a>
</body>
</html>