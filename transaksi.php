<?php
include 'koneksi.php'; // Menghubungkan ke database

// Tambah Transaksi
if (isset($_POST['tambah_transaksi'])) {
    $id_pelanggan = $_POST['id_pelanggan'];
    $id_produk = $_POST['id_produk'];
    $jumlah = $_POST['jumlah'];
    
    // Ambil harga produk
    $produk_query = $conn->query("SELECT harga, stok FROM produk WHERE id = '$id_produk'");
    $produk = $produk_query->fetch_assoc();
    
    if ($produk['stok'] >= $jumlah) {
        $total = $produk['harga'] * $jumlah;
        
        // Insert transaksi ke database
        $stmt = $conn->prepare("INSERT INTO transaksi (id_pelanggan, id_produk, jumlah, total) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("iiii", $id_pelanggan, $id_produk, $jumlah, $total);
        $stmt->execute();

        // Kurangi stok produk
        $new_stok = $produk['stok'] - $jumlah;
        $conn->query("UPDATE produk SET stok = '$new_stok' WHERE id = '$id_produk'");

        echo "<p style='color:green;'>✅ Transaksi berhasil ditambahkan!</p>";
    } else {
        echo "<p style='color:red;'>❌ Stok tidak mencukupi!</p>";
    }
}

// Ambil data pelanggan dan produk untuk dropdown
$pelanggan = $conn->query("SELECT * FROM pelanggan");
$produk = $conn->query("SELECT * FROM produk");

// Ambil daftar transaksi
$transaksi = $conn->query("SELECT transaksi.*, pelanggan.nama_pelanggan, produk.nama_produk FROM transaksi
                          JOIN pelanggan ON transaksi.id_pelanggan = pelanggan.id
                          JOIN produk ON transaksi.id_produk = produk.id
                          ORDER BY transaksi.tanggal DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaksi</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <h2>Tambah Transaksi</h2>
    <form method="POST">
        Pelanggan: 
        <select name="id_pelanggan" required>
            <option value="">-- Pilih Pelanggan --</option>
            <?php while ($row = $pelanggan->fetch_assoc()) { ?>
                <option value="<?php echo $row['id']; ?>"> <?php echo $row['nama_pelanggan']; ?> </option>
            <?php } ?>
        </select>
        
        Produk:
        <select name="id_produk" required>
            <option value="">-- Pilih Produk --</option>
            <?php while ($row = $produk->fetch_assoc()) { ?>
                <option value="<?php echo $row['id']; ?>"> <?php echo $row['nama_produk']; ?> </option>
            <?php } ?>
        </select>
        
        Jumlah: <input type="number" name="jumlah" min="1" required>
        <input type="submit" name="tambah_transaksi" value="Tambah Transaksi">
    </form>
</div>

<div class="container">
    <h2>Laporan Transaksi</h2>
    <table>
        <tr>
            <th>Pelanggan</th><th>Produk</th><th>Jumlah</th><th>Total</th><th>Tanggal</th>
        </tr>
        <?php while ($row = $transaksi->fetch_assoc()) { ?>
            <tr>
                <td><?php echo htmlspecialchars($row['nama_pelanggan']); ?></td>
                <td><?php echo htmlspecialchars($row['nama_produk']); ?></td>
                <td><?php echo $row['jumlah']; ?></td>
                <td>Rp <?php echo number_format($row['total'], 0, ',', '.'); ?></td>
                <td><?php echo $row['tanggal']; ?></td>
            </tr>
        <?php } ?>
    </table>
</div>

<div class="btn-container">
    <a href="index.php" class="btn-home">Kembali ke Home</a>
</div>

</body>
</html>