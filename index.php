<!DOCTYPE html>
<html>

<head>
    <title>Manajemen Apotek</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px;
        }
    </style>
</head>

<body>
    <h1>Data Manajemen Apotek</h1>
    <br>

    <div>
        <div>
            Tabel obat
        </div>
        <div>
            <table>
                <tr>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>Umur</th>
                    <th>no_telp</th>
                    <th>email</th>
                </tr>
                <?php
                $mongoClient = new MongoDB\Driver\Manager("mongodb://localhost:27017");
                $dbName = "db_manajemen_apotek";
                $collectionName = "customer";

                $query = new MongoDB\Driver\Query([]);
                $cursor = $mongoClient->executeQuery("$dbName.$collectionName", $query);

                foreach ($cursor as $document) {
                    echo "<tr>";
                    echo "<td>" . $document->nama . "</td>";
                    echo "<td>" . $document->alamat . "</td>";
                    echo "<td>" . $document->umur . "</td>";
                    echo "<td>" . $document->no_telp . "</td>";
                    echo "<td>" . $document->email . "</td>";
                    echo "</tr>";
                }
                ?>
            </table>
        </div>
    </div>
    <div>
        <a href="post_customer.php">
            <button>
                Insert Data
            </button>
        </a>
        <a href="edit_customer.php">
            <button>
                Edit Data
            </button>
        </a>
        <a href="delete_customer.php">
            <button>
                Delete Data
            </button>
        </a>
    </div>
</body>

</html>