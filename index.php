<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Toko Kelontong</title>
    <style>
        /* General Styles */
        body {
            font-family: 'Poppins', sans-serif;
            background: url('https://wallpapercave.com/wp/wp3196966.jpg') no-repeat center center fixed;
            background-size: cover;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            flex-direction: column;
        }

        /* Navigasi Menu */
        .navbar {
            position: fixed;
            top: 20px;
            right: 40px;
            background: rgb(0, 0, 0);
            padding: 10px 20px;
            border-radius: 30px;
            box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.3);
        }

        .navbar a {
            color: white;
            text-decoration: none;
            font-size: 16px;
            font-weight: 600;
            padding: 12px 18px;
            border-radius: 20px;
            transition: all 0.3s ease-in-out;
            display: inline-block;
        }

        .navbar a:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: scale(1.1);
        }

        /* Container Utama */
        .container {
            width: 90%;
            max-width: 800px;
            background: rgba(255, 255, 255, 0.85);
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.25);
            text-align: center;
            backdrop-filter: blur(10px);
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        }

        .container:hover {
            transform: scale(1.02);
            box-shadow: 0px 12px 25px rgba(0, 0, 0, 0.3);
        }

        /* Heading */
        h1 {
            color: #007BFF;
            font-size: 36px;
            font-weight: bold;
            margin-bottom: 15px;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        /* Paragraph */
        p {
            font-size: 18px;
            color: #333;
            line-height: 1.6;
            font-weight: 500;
        }

        /* Waktu di Luar Container (Kiri Bawah) */
        #waktu-sekarang {
            position: fixed;
            bottom: 20px;
            left: 20px;
            font-size: 18px;
            font-weight: bold;
            color: white;
            background: rgba(0, 0, 0, 0.7);
            padding: 10px 15px;
            border-radius: 8px;
            box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.3);
        }

        /* Animasi Halus */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .container, .navbar, #waktu-sekarang {
            animation: fadeIn 0.8s ease-in-out;
        }
    </style>
</head>
<body>
    <!-- Menu Navigasi -->
    <div class="navbar">
        <a href="index.php">Home</a>
        <a href="produk.php">Produk</a>
        <a href="pelanggan.php">Pelanggan</a>
        <a href="transaksi.php">Transaksi</a>
        <a href="laporan.php">Laporan</a>
    </div>

    <!-- Konten Utama -->
    <div class="container">
        <h1>Selamat Datang di Aplikasi Toko Kelontong</h1>
        <p>Aplikasi ini membantu Anda mengelola data produk, pelanggan, transaksi, serta laporan penjualan dengan mudah dan efisien.</p>
    </div>

    <!-- Menampilkan Waktu di Luar Container -->
    <div id="waktu-sekarang"></div>

    <script>
        function updateTime() {
            let now = new Date();
            let waktu = now.toLocaleString('id-ID', {
                weekday: 'long', 
                day: 'numeric', 
                month: 'long', 
                year: 'numeric', 
                hour: '2-digit', 
                minute: '2-digit', 
                second: '2-digit'
            });
            document.getElementById('waktu-sekarang').innerHTML = waktu;
        }
        
        setInterval(updateTime, 1000);
        updateTime();
    </script>
</body>
</html>
