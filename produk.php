<?php
include 'koneksi.php'; // Menghubungkan ke database

// Tambah Produk
if (isset($_POST['tambah_produk'])) {
    $nama_produk = htmlspecialchars($_POST['nama_produk']);
    $harga = intval($_POST['harga']);
    $stok = intval($_POST['stok']);

    if (!empty($nama_produk) && $harga > 0 && $stok >= 0) {
        $stmt = $conn->prepare("INSERT INTO produk (nama_produk, harga, stok) VALUES (?, ?, ?)");
        $stmt->bind_param("sii", $nama_produk, $harga, $stok);
        $stmt->execute();
        echo "<p style='color:green;'>✅ Produk berhasil ditambahkan!</p>";
    } else {
        echo "<p style='color:red;'>❌ Data produk tidak valid!</p>";
    }
}

// Pencarian Produk
$search = "";
if (isset($_POST['cari_produk'])) {
    $search = htmlspecialchars($_POST['search']);
}
$query = "SELECT * FROM produk WHERE nama_produk LIKE ? ORDER BY nama_produk ASC";
$stmt = $conn->prepare($query);
$search_param = "%" . $search . "%";
$stmt->bind_param("s", $search_param);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Produk</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <h2>Tambah Produk</h2>
    <form method="POST">
        Nama Produk: <input type="text" name="nama_produk" required>
        Harga: <input type="number" name="harga" required>
        Stok: <input type="number" name="stok" required>
        <input type="submit" name="tambah_produk" value="Tambah Produk">
    </form>

    <h2>Cari Produk</h2>
    <form method="POST">
        <input type="text" name="search" placeholder="Cari produk..." value="<?php echo htmlspecialchars($search); ?>">
        <input type="submit" name="cari_produk" value="Cari">
    </form>

    <h2>Laporan Stok/Persediaan Produk</h2>
    <table>
        <tr><th>Nama Produk</th><th>Harga</th><th>Stok</th></tr>
        <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?php echo htmlspecialchars($row['nama_produk']); ?></td>
                <td>Rp <?php echo number_format($row['harga'], 0, ',', '.'); ?></td>
                <td><?php echo $row['stok']; ?></td>
            </tr>
        <?php } ?>
    </table>
</div>

<div class="btn-container">
    <a href="index.php" class="btn-home">Kembali ke Home</a>
</div>

</body>
</html>
