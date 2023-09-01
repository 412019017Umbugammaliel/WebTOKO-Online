<?php
require_once './admin/db.php';

// Periksa apakah parameter ID telah diberikan
if (isset($_GET['id'])) {
    $product_id = $_GET['id'];

    // Query untuk mendapatkan detail produk berdasarkan ID
    $query = "SELECT * FROM tabel_product WHERE product_id = $product_id AND product_status = 1";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $product = mysqli_fetch_assoc($result);
        ?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <link rel="icon" href="img/logo.jpg">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Detail Produk - Buku Licuk</title>
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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

            <div class="container mt-4">
                <div class="row">
                    <div class="col-md-6">
                        <img src="./admin/product_images/<?php echo $product['product_image']; ?>" class="img-fluid"
                            alt="Product Image">
                    </div>
                    <div class="col-md-6">
                        <h2 class="font-weight-bold">
                            <?php echo $product['product_name']; ?>
                        </h2>
                        <p class="harga">Rp.
                            <?php echo number_format($product['product_price']); ?>
                        </p>
                        <p class="deskripsi">
                            <?php echo $product['product_description']; ?>
                        </p>
                        <p>
                            <a href="https://api.whatsapp.com/send?phone=6285303870612&text=Hai,%20saya%20tertarik%20dengan%20produk%20anda."
                                target="_blank">
                                Hubungi Penjual via WhatsApp
                                <img src="img/wa.png" width="50px">
                            </a>
                        </p>
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

        </body>

        </html>
        <?php
    } else {
        // Produk tidak ditemukan
        echo "Produk tidak ditemukan.";
    }
} else {
    // Parameter ID tidak diberikan
    echo "Parameter ID tidak diberikan.";
}
?>