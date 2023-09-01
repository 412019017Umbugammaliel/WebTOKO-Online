<?php
session_start();
if (!isset($_SESSION['status_login'])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/logo.jpg">
    <title>Buku Licuk</title>
    <!-- Bootstrap CSS dan Custom yang dibuat -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style1.css">
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
            <div class="container-fluid">
                <a class="navbar-brand" href="dashboard.php">Buku Licuk</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="dashboard.php">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="profile.php">Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="kategori_buku.php">Kategori Buku</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="data_buku.php">Data Buku</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="kontak_kami.php">Kontak Kami</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php">Keluar</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <div class="container-fluid">
        <div class="row">
            <h1 class="my-heading"> Dashboard </h1>
            <div class="box">
                <h2>
                    Selamat datang
                    <?php echo $_SESSION['a_global']->admin_name ?>
                    di Buku Licuk
                </h2>
            </div>
        </div>
    </div>
    <footer class="footer mt-auto py-3 bg-light">
        <div class="container text-center">
            <span class="text-muted">© 2023 PEMROGRAMAN WEB II. Umbu Gammaliel 412019017</span>
            <div class="social-icons">
                <a href="https://www.facebook.com/"><img src="img/fb.png" alt="Facebook"></a>
                <a href="https://twitter.com/"><img src="img/tw.png" alt="Twitter"></a>
                <a href="https://www.instagram.com/"><img src="img/ig.png" alt="Instagram"></a>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>