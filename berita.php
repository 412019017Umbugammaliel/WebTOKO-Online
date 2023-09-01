<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="icon" href="img/logo.jpg">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buku Terbaru - Buku Licuk</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .book-card {
            padding: 10px;
            margin-bottom: 20px;
            text-align: center;
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 5px;
            display: inline-block;
            position: relative;
            transition: transform 0.3s;
        }

        .book-card:hover {
            transform: translateY(-5px);
        }

        .book-card img {
            width: 200px;
            height: 300px;
            object-fit: cover;
            margin-bottom: 10px;
        }

        .book-details {
            padding: 10px;
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
                <input type="text" name="search" placeholder="Cari Produk" class="form-control mr-2">
                <button type="submit" name="cari" class="btn btn-dark">Cari Produk</button>
            </form>
        </div>
    </div>

    <div class="container mt-4 text-center">
        <h2 class="font-weight-bold">Buku Terbaru</h2>
        <div class="row justify-content-center" id="newsContainer"></div>
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
        $(document).ready(function () {
            function loadBooks() {
                $.ajax({
                    url: 'admin/backend/get_book.php',
                    method: 'GET',
                    success: function (response) {
                        $('#newsContainer').html(response);
                    },
                    error: function () {
                        $('#newsContainer').html('<p>Gagal memuat data</p>');
                    }
                });
            }

            loadBooks();

            $('#searchForm').submit(function (event) {
                event.preventDefault();
                var searchTerm = $('input[name="search"]').val();

                $.ajax({
                    url: 'admin/backend/search_product.php',
                    method: 'GET',
                    data: {
                        search: searchTerm
                    },
                    success: function (response) {
                        $('#newsContainer').html(response);
                    },
                    error: function () {
                        $('#newsContainer').html('<p>Gagal mencari buku</p>');
                    }
                });
            });
        });
    </script>
</body>

</html>