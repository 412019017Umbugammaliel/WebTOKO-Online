<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="icon" href="img/logo.jpg">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hubungi Kami - Buku Licuk</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
        <h2 class="font-weight-bold">Hubungi Kami</h2>
        <form id="contactForm" method="POST">
            <div class="form-group">
                <label for="name">Nama:</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="message">Pesan:</label>
                <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
            </div>
            <button type="submit" class="btn btn-warning">Kirim</button>
        </form>
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
            $('#contactForm').submit(function (e) {
                e.preventDefault();
                sendContactForm();
            });

            function sendContactForm() {
                var name = $('#name').val();
                var email = $('#email').val();
                var message = $('#message').val();

                $.ajax({
                    url: './admin/backend/process_contact.php',
                    type: 'POST',
                    data: {
                        name: name,
                        email: email,
                        message: message
                    },
                    success: function (response) {
                        // Respon sukses dari server
                        console.log(response);
                        if (response.status === 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Sukses',
                                text: response.message
                            }).then(function () {
                                // Mengosongkan nilai input form setelah Sweet Alert ditutup
                                $('#name').val('');
                                $('#email').val('');
                                $('#message').val('');
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: response.message
                            });
                        }
                    },
                    error: function (xhr, status, error) {
                        // Penanganan error
                        console.error(error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Terjadi kesalahan saat mengirim data'
                        });
                    }
                });
            }
        });
    </script>
</body>

</html>