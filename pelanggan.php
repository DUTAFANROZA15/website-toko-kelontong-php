<?php
include 'koneksi.php'; // Menghubungkan ke database

// Tambah Pelanggan
if (isset($_POST['tambah_pelanggan'])) {
    $nama_pelanggan = htmlspecialchars($_POST['nama_pelanggan']);
    $kontak = htmlspecialchars($_POST['kontak']);

    if (!empty($nama_pelanggan) && !empty($kontak)) {
        $stmt = $conn->prepare("INSERT INTO pelanggan (nama_pelanggan, kontak) VALUES (?, ?)");
        $stmt->bind_param("ss", $nama_pelanggan, $kontak);
        $stmt->execute();
        echo "<p style='color:green;'>✅ Pelanggan berhasil ditambahkan!</p>";
    } else {
        echo "<p style='color:red;'>❌ Data pelanggan tidak valid!</p>";
    }
}

// Menampilkan Data Pelanggan
$query = "SELECT * FROM pelanggan ORDER BY nama_pelanggan ASC";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Pelanggan</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <h2>Tambah Pelanggan</h2>
    <form method="POST">
        Nama Pelanggan: <input type="text" name="nama_pelanggan" required>
        Kontak: <input type="text" name="kontak" required>
        <input type="submit" name="tambah_pelanggan" value="Tambah Pelanggan">
    </form>

    <h2>Daftar Pelanggan</h2>
    <table>
        <tr><th>Nama Pelanggan</th><th>Kontak</th></tr>
        <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?php echo htmlspecialchars($row['nama_pelanggan']); ?></td>
                <td><?php echo htmlspecialchars($row['kontak']); ?></td>
            </tr>
        <?php } ?>
    </table>
</div>

<div class="btn-container">
    <a href="index.php" class="btn-home">Kembali ke Home</a>
</div>

</body>
</html>
