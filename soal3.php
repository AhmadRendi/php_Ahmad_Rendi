<?

$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'dba1';

$alamat = '';
$name = '';

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function getData()
{
    global $conn;
    $sql = "SELECT p.name, p.alamat, h.name_hobi FROM tbl_person as p JOIN tbl_hobi AS h ON h.id_person = p.id";
    $result = $conn->query($sql);

    $data = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    }
    return $data;
}

$name = isset($_GET['name']) ? $_GET['name'] : "";
$alamat = isset($_GET['alamat']) ? $_GET['alamat'] : "";

function search()
{
    global $conn;
    global $alamat;
    global $name;
    $query = "SELECT p.name, p.alamat, h.name_hobi FROM tbl_person as p JOIN tbl_hobi AS h ON h.id_person = p.id WHERE p.name LIKE ? OR p.alamat LIKE ?";

    $stmt = $conn->prepare($query);
    $searchName = "%$name%";
    $searchAlamat = "%$alamat%";
    $stmt->bind_param("ss", $searchName, $searchAlamat);
    $stmt->execute();
    $result = $stmt->get_result();

    $data = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    }
    return $data;
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Multi-Step</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 20px;
        }

        .form-container {
            max-width: 500px;
            margin: 50px auto;
            background: white;
            border: 2px solid black;
            padding: 30px;
        }

        .form-group {
            margin-bottom: 30px;
        }

        label {
            font-size: 18px;
            font-weight: normal;
            margin-right: 10px;
        }

        input[type="text"],
        input[type="number"] {
            border: 2px solid black;
            padding: 8px 12px;
            font-size: 16px;
            width: 200px;
        }

        .submit-btn {
            border: 2px solid black;
            background: white;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            margin-top: 20px;
        }

        .submit-btn:hover {
            background: #f0f0f0;
        }

        .result-container {
            max-width: 500px;
            margin: 50px auto;
            background: white;
            border: 2px solid black;
            padding: 30px;
        }

        .result-item {
            font-size: 18px;
            margin-bottom: 10px;
            border-bottom: 1px solid black;
            padding-bottom: 5px;
        }

        .restart-btn {
            border: 2px solid black;
            background: white;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            margin-top: 20px;
            text-decoration: none;
            display: inline-block;
        }

        .restart-btn:hover {
            background: #f0f0f0;
        }
    </style>
</head>

<body>
    <div>
        <table border="1" cellpadding="10" cellspacing="0">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Alamat</th>
                    <th>Hobi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (search() != null) {
                    foreach (search() as $item) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($item['name']) . "</td>";
                        echo "<td>" . htmlspecialchars($item['alamat']) . "</td>";
                        echo "<td>" . htmlspecialchars($item['name_hobi']) . "</td>";
                        echo "</tr>";
                    }
                } else {
                    foreach (getData() as $item) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($item['name']) . "</td>";
                        echo "<td>" . htmlspecialchars($item['alamat']) . "</td>";
                        echo "<td>" . htmlspecialchars($item['name_hobi']) . "</td>";
                        echo "</tr>";
                    }
                }
                ?>
            </tbody>
        </table>
    </div>

    <div style="margin-top: 50px;">
        <form action="">
            <div style="display: flex; align-items: center; gap: 10px;">
                <p>Inputkan Nama : </p>
                <input type="text" style="height: 30px; width: 200px; box-sizing: border-box;" name="name"
                    placeholder="Search...">
            </div>
            <div style="display: flex; align-items: center; gap: 10px;">
                <p>Inputkan Alamat : </p>
                <input type="text" style="height: 30px; width: 200px; box-sizing: border-box;" name="alamat"
                    placeholder="Search...">
            </div>
            <button type="submit" class="submit-btn">Search</button>
        </form>
    </div>

</body>

</html>