<?php
include 'koneksi.php'; // Menghubungkan ke database

// Ambil data stok produk
$produk = $conn->query("SELECT * FROM produk ORDER BY nama_produk ASC");

// Ambil data pelanggan
$pelanggan = $conn->query("SELECT * FROM pelanggan ORDER BY nama_pelanggan ASC");

// Ambil data faktur jual (transaksi)
$faktur = $conn->query("SELECT transaksi.*, pelanggan.nama_pelanggan, produk.nama_produk FROM transaksi
                          JOIN pelanggan ON transaksi.id_pelanggan = pelanggan.id
                          JOIN produk ON transaksi.id_produk = produk.id
                          ORDER BY transaksi.tanggal DESC");

// Ambil data rekapitulasi
$rekap_harian = $conn->query("SELECT DATE(tanggal) as tanggal, SUM(total) as total FROM transaksi GROUP BY DATE(tanggal)");
$rekap_bulanan = $conn->query("SELECT MONTH(tanggal) as bulan, YEAR(tanggal) as tahun, SUM(total) as total FROM transaksi GROUP BY bulan, tahun");
$rekap_tahunan = $conn->query("SELECT YEAR(tanggal) as tahun, SUM(total) as total FROM transaksi GROUP BY tahun");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penjualan</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h2>Laporan Stok Produk</h2>
    <table>
        <tr><th>Nama Produk</th><th>Harga</th><th>Stok</th></tr>
        <?php while ($row = $produk->fetch_assoc()) { ?>
            <tr>
                <td><?php echo htmlspecialchars($row['nama_produk']); ?></td>
                <td>Rp <?php echo number_format($row['harga'], 0, ',', '.'); ?></td>
                <td><?php echo $row['stok']; ?></td>
            </tr>
        <?php } ?>
    </table>
</div>

<div class="container">
    <h2>Laporan Data Pelanggan</h2>
    <table>
        <tr><th>Nama Pelanggan</th><th>Kontak</th></tr>
        <?php while ($row = $pelanggan->fetch_assoc()) { ?>
            <tr>
                <td><?php echo htmlspecialchars($row['nama_pelanggan']); ?></td>
                <td><?php echo htmlspecialchars($row['kontak']); ?></td>
            </tr>
        <?php } ?>
    </table>
</div>

<div class="container">
    <h2>Laporan Faktur Jual</h2>
    <table>
        <tr><th>Pelanggan</th><th>Produk</th><th>Jumlah</th><th>Total</th><th>Tanggal</th></tr>
        <?php while ($row = $faktur->fetch_assoc()) { ?>
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

<div class="container">
    <h2>Rekapitulasi Penjualan Harian</h2>
    <table>
        <tr><th>Tanggal</th><th>Total Penjualan</th></tr>
        <?php while ($row = $rekap_harian->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $row['tanggal']; ?></td>
                <td>Rp <?php echo number_format($row['total'], 0, ',', '.'); ?></td>
            </tr>
        <?php } ?>
    </table>
</div>

<div class="container">
    <h2>Rekapitulasi Penjualan Bulanan</h2>
    <table>
        <tr><th>Bulan</th><th>Tahun</th><th>Total Penjualan</th></tr>
        <?php while ($row = $rekap_bulanan->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $row['bulan']; ?></td>
                <td><?php echo $row['tahun']; ?></td>
                <td>Rp <?php echo number_format($row['total'], 0, ',', '.'); ?></td>
            </tr>
        <?php } ?>
    </table>
</div>

<div class="container">
    <h2>Rekapitulasi Penjualan Tahunan</h2>
    <table>
        <tr><th>Tahun</th><th>Total Penjualan</th></tr>
        <?php while ($row = $rekap_tahunan->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $row['tahun']; ?></td>
                <td>Rp <?php echo number_format($row['total'], 0, ',', '.'); ?></td>
            </tr>
        <?php } ?>
    </table>
</div>

<div class="btn-container">
    <a href="index.php" class="btn-home">Kembali ke Home</a>
</div>
</body>
</html>
