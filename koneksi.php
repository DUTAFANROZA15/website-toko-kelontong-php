<?php
$host = "localhost";  // Server database (default: localhost)
$user = "root";       // Username MySQL (default: root)
$pass = "";           // Password MySQL (kosong untuk XAMPP)
$dbname = "toko_kelontong"; // Nama database, sesuaikan dengan database Anda

// Membuat koneksi ke database
$conn = new mysqli($host, $user, $pass, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
