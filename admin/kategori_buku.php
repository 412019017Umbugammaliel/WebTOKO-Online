<?php
session_start();
if (!isset($_SESSION['status_login'])) {
    header("Location: login.php");
    exit;
}

require_once "db.php";
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/logo.jpg">
    <title>Buku Licuk</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style1.css">
    <!-- SweetAlert CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.css">
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
            <h1 class="my-heading">Kategori Buku</h1>
            <div class="box">
                <p>
                    <a href="#" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#tambahKategoriModal">Tambah
                        Kategori</a>
                </p>
                <table class="table" id="kategoriTable">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Kategori</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="3">Tidak ada Kategori</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Kategori -->
    <div class="modal fade" id="tambahKategoriModal" tabindex="-1" aria-labelledby="tambahKategoriModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahKategoriModalLabel">Tambah Kategori</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST" id="formTambahKategori">
                        <div class="mb-3">
                            <label for="category_name" class="form-label">Nama Kategori</label>
                            <input type="text" class="form-control" id="category_name" name="category_name" required>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-dark">Tambah</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit Kategori -->
    <div class="modal fade" id="editKategoriModal" tabindex="-1" aria-labelledby="editKategoriModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editKategoriModalLabel">Edit Kategori</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" id="formEditKategori">
                        <div class="mb-3">
                            <input type="hidden" id="update_id" name="update_id">
                            <label for="edit_category_name" class="form-label">Nama Kategori</label>
                            <input type="text" class="form-control" id="edit_category_name" name="edit_category_name"
                                required>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-dark">Simpan</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        </div>
                    </form>
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
            loadKategori();

            function loadKategori() {
                $.ajax({
                    url: "backend/load_category.php",
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        if (data.length > 0) {
                            var tableBody = "";
                            $.each(data, function (index, item) {
                                var row = "<tr>" +
                                    "<td>" + (index + 1) + "</td>" +
                                    "<td>" + item.name_category + "</td>" +
                                    "<td>" +
                                    "<button type='button' class='btn btn-warning btn-edit' data-bs-toggle='modal' data-bs-target='#editKategoriModal' data-id='" + item.id_category + "' data-name='" + item.name_category + "'>Edit</button>&nbsp;" +
                                    "<button type='button' class='btn btn-danger btn-delete' data-id='" + item.id_category + "' data-name='" + item.name_category + "'>Hapus</button>" +
                                    "</td>" +
                                    "</tr>";
                                tableBody += row;
                            });
                            $("#kategoriTable tbody").html(tableBody);
                        } else {
                            $("#kategoriTable tbody").html("<tr><td colspan='3'>Tidak ada Kategori</td></tr>");
                        }
                    },
                    error: function (xhr, status, error) {
                        console.log(xhr.responseText);
                    }
                });
            }
        });
        // Fungsi untuk menampilkan pesan sukses
        function showSuccessMessage(message) {
            Swal.fire({
                icon: 'success',
                text: message,
                timer: 2000,
                showConfirmButton: false
            });
        }

        // Fungsi untuk menampilkan pesan error
        function showErrorMessage(message) {
            Swal.fire({
                icon: 'error',
                text: message,
                timer: 2000,
                showConfirmButton: false
            });
        }

        // Fungsi untuk melakukan tambah kategori
        $(document).on('submit', '#formTambahKategori', function (e) {
            e.preventDefault();
            var form = $(this);
            var url = 'backend/add_category.php';
            var data = form.serialize();


            $.ajax({
                type: 'POST',
                url: url,
                data: data,
                dataType: 'json',
                success: function (response) {
                    if (response.status == 'success') {
                        $('#tambahKategoriModal').modal('hide');
                        Swal.fire({
                            title: 'Success',
                            text: response.message,
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then(function () {
                            location.reload();
                        });
                    } else {
                        Swal.fire('Error', response.message, 'error');
                    }
                },
                error: function () {
                    Swal.fire('Error', 'Terjadi kesalahan. Gagal mengirim permintaan.', 'error');
                }
            });
        });

        // Fungsi untuk menampilkan data kategori pada modal edit
        $(document).on('click', '.btn-edit', function () {
            var id = $(this).data('id');
            var name = $(this).data('name');

            $('#update_id').val(id);
            $('#edit_category_name').val(name);
        });

        // Fungsi untuk melakukan edit kategori
        $(document).on('submit', '#formEditKategori', function (e) {
            e.preventDefault();

            var form = $(this);
            var url = 'backend/edit_category.php';
            var data = form.serialize();

            $.ajax({
                type: 'POST',
                url: url,
                data: data,
                dataType: 'json',
                success: function (response) {
                    if (response.status == 'success') {
                        $('#editKategoriModal').modal('hide');
                        Swal.fire({
                            title: 'Success',
                            text: response.message,
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then(function () {
                            location.reload();
                        });
                    } else {
                        Swal.fire('Error', response.message, 'error');
                    }
                },
                error: function () {
                    Swal.fire('Error', 'Terjadi kesalahan. Gagal mengirim permintaan.', 'error');
                }
            });
        });

        // Fungsi untuk menghapus kategori
        $(document).on('click', '.btn-delete', function () {
            var id = $(this).data('id');
            var name = $(this).data('name');

            Swal.fire({
                title: 'Konfirmasi',
                text: 'Apakah Anda yakin ingin menghapus kategori ' + name + '?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'POST',
                        url: 'backend/delete_category.php',
                        data: { id: id },
                        dataType: 'json',
                        success: function (response) {
                            if (response.status == 'success') {
                                $('#editKategoriModal').modal('hide');
                                Swal.fire({
                                    title: 'Success',
                                    text: response.message,
                                    icon: 'success',
                                    confirmButtonText: 'OK'
                                }).then(function () {
                                    location.reload();
                                });
                            } else {
                                Swal.fire('Error', response.message, 'error');
                            }
                        },
                        error: function () {
                            Swal.fire('Error', 'Terjadi kesalahan. Gagal mengirim permintaan.', 'error');
                        }
                    });
                }
            });
        });
    </script>


</body>

</html>