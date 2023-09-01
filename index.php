<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="icon" href="img/logo.jpg">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buku Licuk</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .book-card {
            padding: 10px;
            margin-bottom: 20px;
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .book-card img {
            width: 200px;
            height: auto;
            margin-bottom: 10px;
            border-radius: 50%;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .book-card img:hover {
            transform: scale(1.1);
        }

        .book-card .category-name {
            font-size: 18px;
            font-weight: bold;
            color: #60D3F4;
            text-align: center;
            transition: color 0.3s ease;
        }

        .book-card:hover .category-name {
            color: #F46060;
        }

        .col-4 {
            padding: 15px;
        }

        .kategori-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: flex-start;
            margin-top: 20px;
        }

        .gambar-bergerak {
            transition: transform 0.3s ease;
        }

        .gambar-bergerak:hover {
            transform: rotate(360deg);
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


    <div class="search bg-light py-4">
        <div class="container search-container d-flex justify-content-center">
            <form action="produk.php" method="GET" class="form-inline" id="searchForm">
                <input type="text" name="search" id="searchInput" placeholder="Cari Produk" class="form-control mr-2">
                <button type="submit" name="cari" class="btn btn-dark">Cari Produk</button>
            </form>
        </div>
    </div>

    <div class="container mt-4 text-center">
        <h2 class="font-weight-bold mb-4">Daftar Kategori Buku</h2>
        <div class="row justify-content-center">
            <div class="kategori-container" id="kategoriContainer">
                <!-- Kategori akan ditampilkan di sini -->
            </div>
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

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            // Menggunakan AJAX untuk mendapatkan data kategori
            $.ajax({
                url: 'admin/backend/get_category.php',
                method: 'GET',
                success: function (response) {
                    $('#kategoriContainer').html(response);
                },
                error: function (xhr, status, error) {
                    console.error(error);
                    $('#kategoriContainer').html('<p>Gagal memuat data kategori.</p>');
                },
            });

            // Menggunakan Ajax untuk memproses form pencarian
            $('#searchForm').submit(function (event) {
                event.preventDefault();

                var searchValue = $('#searchInput').val();
                searchProducts(searchValue);
            });
        });

        // Fungsi untuk mencari produk berdasarkan query melalui Ajax
        function searchProducts(query) {
            $.ajax({
                url: 'admin/backend/search_product.php',
                method: 'GET',
                data: { search: query },
                success: function (response) {
                    $('#kategoriContainer').html(response);
                },
                error: function () {
                    $('#kategoriContainer').html('<p>Terjadi kesalahan saat melakukan pencarian.</p>');
                },
            });
        }
    </script>
</body>

</html>