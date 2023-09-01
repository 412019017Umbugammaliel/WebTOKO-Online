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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
            <h1 class="my-heading">Kontak Kami</h1>
            <div class="box">
                <div class="table-responsive">
                    <table class="table" id="kategoriTable">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Email</th>
                                <th scope="col">Pesan</th>
                                <th scope="col">Tanggal Ditambahkan</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="6">Tidak ada Pesan</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
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

    <!-- Script JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            // Fungsi untuk memuat data dari database
            function loadData() {
                $.ajax({
                    url: 'backend/load_contact.php',
                    method: 'GET',
                    dataType: 'json',
                    success: function (response) {
                        if (response.length > 0) {
                            var tableRows = '';
                            $.each(response, function (index, data) {
                                tableRows += '<tr>';
                                tableRows += '<td>' + (index + 1) + '</td>';
                                tableRows += '<td>' + data.name + '</td>';
                                tableRows += '<td>' + data.email + '</td>';
                                tableRows += '<td>' + data.message + '</td>';
                                tableRows += '<td>' + data.created_at + '</td>';
                                tableRows += '<td><button class="btn btn-danger btn-delete" data-id="' + data.id + '">Hapus</button></td>';
                                tableRows += '</tr>';
                            });
                            $('#kategoriTable tbody').html(tableRows);

                            // Menambahkan event handler untuk tombol Delete
                            $('.btn-delete').click(function () {
                                var id = $(this).data('id');
                                showConfirmation(id);
                            });
                        } else {
                            $('#kategoriTable tbody').html('<tr><td colspan="6">Tidak ada Pesan</td></tr>');
                        }
                    },
                    error: function (xhr, status, error) {
                        console.log(xhr.responseText);
                    }
                });
            }

            // Fungsi untuk menampilkan konfirmasi penghapusan
            function showConfirmation(id) {
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Data akan dihapus secara permanen!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Hapus',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        deleteData(id);
                    }
                });
            }

            // Fungsi untuk menghapus data dari database
            function deleteData(id) {
                $.ajax({
                    url: 'backend/delete_contact.php',
                    method: 'POST',
                    data: { id: id },
                    success: function (response) {
                        loadData();
                        Swal.fire('Sukses!', 'Data berhasil dihapus.', 'success').then(function () {
                            location.reload();
                        });
                    },
                    error: function (xhr, status, error) {
                        console.log(xhr.responseText);
                    }
                });
            }
            // Memanggil fungsi loadData saat halaman dimuat
            loadData();
        });

    </script>

</body>

</html>