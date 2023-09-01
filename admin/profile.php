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
    <title>Buku Licuk - Profile</title>
    <!-- Bootstrap CSS dan Custom CSS-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style1.css">
    <!-- Sweet Alert CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.15.6/dist/sweetalert2.min.css">
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
            <h1>setProfile</h1>
            <div class="box">
                <form id="profileForm" method="POST" action="profile.php">
                    <div class="form-group">
                        <label for="exampleInputName">Nama Admin</label>
                        <input type="text" name="nama" class="form-control" aria-describedby="nameHelp"
                            placeholder="Enter Name" value="<?php echo $_SESSION['a_global']->admin_name ?>">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail2">Email Admin</label>
                        <input type="email" name="email" class="form-control" id="exampleInputEmail2"
                            aria-describedby="emailHelp" placeholder="Enter email"
                            value="<?php echo $_SESSION['a_global']->admin_email ?>">
                    </div>
                    <button type="button" class="btn btn-dark" onclick="updateProfile()">Ubah Profile</button>
                </form>
                <div id="profileMessage"></div>
            </div>
        </div>
        <div class="row">
            <h1>setPassword</h1>
            <div class="box">
                <form id="passwordForm" method="POST" action="changepassword.php">
                    <div class="form-group">
                        <label for="exampleInputNewPassword">Password Baru</label>
                        <input type="password" name="new_password" class="form-control" id="exampleInputNewPassword"
                            placeholder="Masukan Password Baru">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputConfirmPassword">Konfirmasi Password Baru</label>
                        <input type="password" name="confirm_password" class="form-control"
                            id="exampleInputConfirmPassword" placeholder="Konfirmasi Password Baru">
                    </div>
                    <button type="button" class="btn btn-dark" onclick="updatePassword()">Ubah Password</button>
                </form>
                <div id="passwordMessage"></div>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.15.6/dist/sweetalert2.min.js"></script>
    <script>
        function updateProfile() {
            var nama = $("input[name='nama']").val();
            var email = $("input[name='email']").val();

            // Validasi data tidak boleh kosong di sisi klien
            if (nama === '' || email === '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: 'Data tidak boleh kosong'
                });
                return;
            }

            // Kirim data profile menggunakan AJAX
            $.ajax({
                type: "POST",
                url: "backend/process_profile.php",
                data: {
                    nama: nama,
                    email: email
                },
                success: function (response) {
                    if (response === "success") {
                        Swal.fire({
                            icon: 'success',
                            title: 'Sukses',
                            text: 'Data berhasil diperbarui'
                        }).then(function () {
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: 'Gagal memperbarui data'
                        });
                    }
                },
                error: function () {
                    Swal.fire({
                        icon: 'error',
                        title: 'Terjadi Kesalahan',
                        text: 'Terjadi kesalahan selama proses'
                    });
                }
            });
        }

        function updatePassword() {
            var newPassword = $("input[name='new_password']").val();
            var confirmPassword = $("input[name='confirm_password']").val();

            if (newPassword === '' || confirmPassword === '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: 'Password tidak boleh kosong'
                });
                return;
            }

            // Kirim data password menggunakan AJAX
            $.ajax({
                type: "POST",
                url: "backend/process_password.php",
                data: {
                    new_password: newPassword,
                    confirm_password: confirmPassword
                },
                success: function (response) {
                    if (response === "success") {
                        Swal.fire({
                            icon: 'success',
                            title: 'Sukses',
                            text: 'Password berhasil diubah'
                        }).then(function () {
                            location.reload();
                        });
                    } else if (response === "mismatch") {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: 'Konfirmasi password tidak sesuai'
                        });
                    } else if (response === "empty") {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: 'Password tidak boleh kosong'
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: 'Gagal mengubah password'
                        });
                    }
                },
                error: function () {
                    Swal.fire({
                        icon: 'error',
                        title: 'Terjadi Kesalahan',
                        text: 'Terjadi kesalahan selama proses'
                    });
                }
            });
        }

    </script>
</body>

</html>