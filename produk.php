<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="icon" href="img/logo.jpg">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk - Buku Licuk</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .book-card {
            width: 100%;
            height: 0;
            padding-bottom: 100%;
            /* Rasio lebar dan tinggi 1:1 */
            position: relative;
            overflow: hidden;
            border-radius: 5px;
            box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            /* Jarak antara setiap baris */
        }

        .book-card:hover {
            transform: translateY(-5px);
        }

        .book-card img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .book-card .book-details {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            padding: 10px;
            background-color: rgba(255, 255, 255, 0.9);
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
            <form id="searchForm" action="produk.php" class="form-inline">
                <input type="text" id="searchInput" placeholder="Cari Produk" class="form-control mr-2">
                <button type="submit" class="btn btn-dark">Cari Produk</button>
            </form>
        </div>
    </div>

    <div class="container mt-4 text-center">
        <h2 class="font-weight-bold">Produk</h2>
        <div class="row justify-content-center" id="produkContainer">
            <!-- Produk akan ditampilkan di sini -->
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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        //Fungsi getAllProducts() dengan $(document).ready() terpisah
        $(document).ready(function () {
            getAllProducts();

            function getAllProducts() {
                $.ajax({
                    url: 'admin/backend/get_all_book.php',
                    method: 'GET',
                    success: function (response) {
                        $('#produkContainer').html(response);
                    },
                    error: function () {
                        $('#produkContainer').html('<p>Terjadi kesalahan saat memuat data.</p>');
                    }
                });
            }
        });
        //Fungsi searchProducts(query) dengan $(document).ready() terpisah:
        $(document).ready(function () {
            $('#searchForm').submit(function (event) {
                event.preventDefault();
                var searchValue = $('#searchInput').val();
                searchProducts(searchValue);
            });

            function searchProducts(query) {
                $.ajax({
                    url: 'admin/backend/search_product.php',
                    method: 'GET',
                    data: { search: query },
                    success: function (response) {
                        $('#produkContainer').html(response);
                    },
                    error: function () {
                        $('#produkContainer').html('<p>Terjadi kesalahan saat melakukan pencarian.</p>');
                    }
                });
            }
        });
    </script>
</body>

</html>