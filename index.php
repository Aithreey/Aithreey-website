<?php
session_start();
include 'db_anjay/db.php';

// Cek login
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: login.php');
    exit;
}

// ambil data produk dari database
$stmt = $pdo->query("SELECT * FROM produk");
$produk = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Di Dunia Aisyah</title>
    <link rel="stylesheet" href="css_anjay/style1.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
     <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #A78C72; /* Warna header tabel */
            color: white;
        }

        td img {
            width: 100px;
            height: auto;
        }

        /* Styling tombol */
        table td a {
            display: inline-block;
            background-color: #A78C72; 
            color: #F5F5F0; 
            padding: 8px 16px;
            border-radius: 8px;
            text-decoration: none;
            text-align: center;
            margin-right: 8px; 
            transition: background-color 0.3s ease, transform 0.2s ease;
            }

        
        table td a:hover {
            background-color: #687B55; 
            transform: translateY(-2px); 
        }

        
        table td a:active {
            transform: translateY(2px); 
        }
    </style>
</head>
<body>
<nav>
    <ul>
        <li><a href="index.php"><i class='bx bx-home'></i> Home</a></li>
        <li><a href="tambah-produk.php"><i class='bx bx-plus'></i> Add Product</a></li>
        <li><a href="profile.php"><i class='bx bx-user'></i> Profile</a></li>
        <li><a href="#" onclick="confirmLogout()"><i class='bx bx-log-out'></i> Logout</a></li>
    </ul>
</nav>

<div class="wrapper">
    <h1>Daftar Produk</h1>
    <table>
        <thead>
            <tr>
                <th>Nama Produk</th>
                <th>Harga</th>
                <th>Gambar</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
    <?php
    if ($produk) {
        foreach ($produk as $item) {
            echo "<tr>
                    <td>" . htmlspecialchars($item['nama_produk']) . "</td>
                    <td>" . htmlspecialchars($item['harga']) . "</td>
                    <td><img src='" . htmlspecialchars($item['gambar']) . "' width='50' alt='Gambar Produk'></td>
                    <td>
                        <a href='edit-produk.php?id=" . $item['id'] . "'>Edit</a>|
                        <a href='hapus-produk.php?id=" . $item['id'] . "'>Hapus</a>
                    </td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='4'>Tidak ada produk</td></tr>";
    }
    ?>
</tbody>

    </table>
</div>

<script>
function confirmLogout() {
    const confirmation = confirm("Yahh masa kamu mau logout sihhh :( Yakin Mau Logout?");
    if (confirmation) {
        window.location.href = "logout.php"; 
    }
}
</script>

</body>
</html>
