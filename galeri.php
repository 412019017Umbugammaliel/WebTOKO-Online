<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="icon" href="img/logo.jpg">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galeri Kami - Buku Licuk</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap');

        .gallery {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            grid-gap: 20px;
            justify-items: center;
            margin-top: 20px;
        }

        .gallery img {
            width: 100%;
            max-height: 200px;
            object-fit: cover;
            border-radius: 5px;
        }

        .gallery .caption {
            font-family: 'Poppins', sans-serif;
            font-size: 14px;
            text-align: center;
        }

        .item:hover img {
            transform: scale(1.2);
            z-index: 1;
        }

        .contact {
            background-image: url('img/contact-background.jpg');
            background-size: cover;
            background-position: center;
            padding: 40px 0;
            text-align: center;
            color: #726565;
        }

        .contact h3 {
            font-family: 'Poppins', sans-serif;
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .contact p {
            font-family: 'Poppins', sans-serif;
            font-size: 16px;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <header class="bg-info text-white py-4">
        <div class="container header-container text-center">
            <h1><a href="index.php" class="text-white">Buku Licuk</a></h1>
            <nav>
                <a href="index.php" class="text-white">Beranda</a> |
                <a href="berita.php" class="text-white">Buku Terbaru</a> |
                <a href="produk.php" class="text-white">Produk</a> |
                <a href="galeri.php" class="text-white">Galeri Kami</a> |
                <a href="contact.php" class="text-white">Hubungi Kami</a> |
                <a href="admin/login.php" class="text-white">Login/Register</a>
            </nav>
        </div>
    </header>

    <div class="container mt-4 text-center">
        <h2 class="font-weight-bold">Galeri Kami</h2>
        <div class="gallery">
            <div class="item">
                <img src="img/perpus/photo1.jpeg" alt="Photo 1">
                <div class="caption">Membaca membuka pintu menuju pengetahuan yang tak terbatas.</div>
            </div>
            <div class="item">
                <img src="img/perpus/photo2.jpeg" alt="Photo 2">
                <div class="caption">Melalui membaca, kita dapat menjelajahi dunia tanpa batas.</div>
            </div>
            <div class="item">
                <img src="img/perpus/photo3.jpeg" alt="Photo 3">
                <div class="caption">Membaca memperluas wawasan dan memperkaya imajinasi kita.</div>
            </div>
            <div class="item">
                <img src="img/perpus/photo4.jpeg" alt="Photo 4">
                <div class="caption">Buku adalah jendela ke dunia baru yang menakjubkan.</div>
            </div>
            <div class="item">
                <img src="img/perpus/photo5.jpeg" alt="Photo 5">
                <div class="caption">Membaca membantu kita belajar, tumbuh, dan berkembang.</div>
            </div>
            <div class="item">
                <img src="img/perpus/photo6.jpeg" alt="Photo 6">
                <div class="caption">Buku adalah sahabat yang selalu ada untuk kita di setiap perjalanan.</div>
            </div>
        </div>
    </div>

    <div class="contact">
        <div class="container">
            <h3>Kontak Kami</h3>
            <p>Anda dapat menghubungi PIC untuk informasi lebih lanjut mengenai Buku Licuk</p>
            <p>Email: <a href="mailto:umbu.412019017@civitas.ac.id">umbu.412019017@civitas.ac.id</a></p>
            <p>Telepon: 0812-3456-7890</p>
        </div>
    </div>

    <footer class="footer mt-4 py-3 bg-dark">
        <div class="container text-center footer-container">
            <span class="text-light">© 2023 PEMROGRAMAN WEB II. Umbu Gammaliel 412019017</span>
            <div class="social-icons">
                <a href="https://www.facebook.com/"><img src="img/fb.png" alt="Facebook"
                        style="width: 30px; height: 30px;"></a>
                <a href="https://twitter.com/"><img src="img/tw.png" alt="Twitter"
                        style="width: 30px; height: 30px;"></a>
                <a href="https://www.instagram.com/"><img src="img/ig.png" alt="Instagram"
                        style="width: 30px; height: 30px;"></a>
            </div>
        </div>
    </footer>

</body>

</html>