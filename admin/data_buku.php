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
            <h1 class="my-heading">Data Buku</h1>
            <div class="box">
                <p>
                    <a href="#" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#tambahBukuModal">Tambah
                        Buku</a>
                </p>
                <div class="table-responsive">
                    <table class="table" id="bukuTable">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Kategori</th>
                                <th scope="col">Judul Buku</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Deskripsi</th>
                                <th scope="col">Gambar</th>
                                <th scope="col">Status</th>
                                <th scope="col">Tanggal Ditambahkan</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="9">Tidak ada Buku</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Tambah Buku -->
    <div class="modal fade" id="tambahBukuModal" tabindex="-1" aria-labelledby="tambahBukuModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahBukuModalLabel">Tambah Buku</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" id="formTambahBuku" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="edit_product_status" class="form-label">Kategori</label>
                            <select class="form-select" name="kategori" required>
                                <option value="">-- Pilih --</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="edit_product_name" class="form-label">Judul Buku</label>
                            <input type="text" class="form-control" id="edit_product_name" name="product_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_product_price" class="form-label">Harga</label>
                            <input type="text" class="form-control" id="edit_product_price" name="product_price"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <textarea class="form-control" id="deskripsi" name="product_description"
                                required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="edit_product_image" class="form-label">Gambar</label>
                            <input type="file" class="form-control" id="edit_product_image" name="product_image">
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" id="status" name="product_status" required>
                                <option value="" selected disabled>Pilih Status</option>
                                <option value="1">Aktif</option>
                                <option value="0">Nonaktif</option>
                            </select>
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

    <!-- Modal Edit -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Buku</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="backend/edit_book.php" method="POST" id="formEditBuku" enctype="multipart/form-data">
                    <div class="modal-body">
                        <input type="hidden" name="update_id" id="update_id">
                        <div class="mb-3">
                            <label for="edit_product_status" class="form-label">Kategori</label>
                            <select class="form-select" name="edit_kategori" required>
                                <option value="">-- Pilih --</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="edit_product_name" class="form-label">Nama Buku</label>
                            <input type="text" class="form-control" id="edit_product_name" name="edit_product_name"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_product_price" class="form-label">Harga</label>
                            <input type="number" class="form-control" id="edit_product_price" name="edit_product_price"
                                required>
                        </div>

                        <div class="mb-3">
                            <label for="edit_product_description" class="form-label">Deskripsi</label>
                            <textarea class="form-control" id="edit_product_description" name="edit_product_description"
                                rows="3" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="edit_product_image" class="form-label">Gambar</label>
                            <input type="file" class="form-control" id="edit_product_image" name="edit_product_image">
                        </div>

                        <div class="mb-3">
                            <label for="edit_product_status" class="form-label">Status</label>
                            <select class="form-select" id="edit_product_status" name="edit_product_status" required>
                                <option value="" selected disabled>Pilih Status</option>
                                <option value="1">Tersedia</option>
                                <option value="0">Tidak Tersedia</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-dark">Simpan</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    </div>
                </form>
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
    <script>
        $(document).ready(function () {
            loadBuku();

            function loadBuku() {
                $.ajax({
                    url: "backend/load_buku.php",
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        if (data.length > 0) {
                            var tableBody = "";
                            $.each(data, function (index, item) {
                                var row = "<tr>" +
                                    "<td>" + (index + 1) + "</td>" +
                                    "<td>" + item.name_category + "</td>" +
                                    "<td>" + item.product_name + "</td>" +
                                    "<td>" + item.product_price + "</td>" +
                                    "<td>" + item.product_description + "</td>" +
                                    "<td><img src='product_images/" + item.product_image + "' width='100'></td>" +
                                    "<td>" + item.product_status + "</td>" +
                                    "<td>" + item.data_created + "</td>" +
                                    "<td>" +
                                    "<button type='button' class='btn btn-warning btn-edit' data-bs-toggle='modal' data-bs-target='#editModal' data-id='" + item.product_id + "' data-name='" + item.product_name + "'>Edit</button>&nbsp;" +
                                    "<button type='button' class='btn btn-danger btn-delete' data-id='" + item.product_id + "'>Delete</button>" +
                                    "</td>" +
                                    "</tr>";
                                tableBody += row;
                            });
                            $("#bukuTable tbody").html(tableBody);
                        } else {
                            $("#bukuTable tbody").html("<tr><td colspan='9'>Tidak ada Buku</td></tr>");
                        }
                    },
                    error: function (xhr, status, error) {
                        console.log(xhr.responseText);
                    }
                });
            }
        });

        $(document).ready(function () {
            loadKategori();

            function loadKategori() {
                $.ajax({
                    url: "backend/load_category_book.php",
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        if (data.length > 0) {
                            var options = "";
                            $.each(data, function (index, item) {
                                options += "<option value='" + item.id_category + "'>" + item.name_category + "</option>";
                            });
                            $("select[name='kategori']").append(options);
                        }
                    },
                    error: function (xhr, status, error) {
                        console.log(xhr.responseText);
                    }
                });
            }
        });

        $(document).ready(function () {
            // Fungsi untuk menangani pengiriman formulir untuk membuat buku baru
            $("#formTambahBuku").submit(function (e) {
                e.preventDefault();
                $.ajax({
                    url: "backend/add_book.php",
                    type: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (response) {
                        var result = JSON.parse(response);
                        if (result.status === "success") {
                            Swal.fire("Success!", result.message, "success").then(function () {
                                location.reload();
                            });
                        } else {
                            Swal.fire("Error!", result.message, "error");
                        }
                    },
                    error: function (xhr, status, error) {
                        Swal.fire("Error!", "AJAX request failed: " + error, "error");
                    }
                });
            });


            $(document).ready(function () {
                // Mendapatkan data kategori saat modal edit ditampilkan
                $('#editModal').on('show.bs.modal', function (event) {
                    var button = $(event.relatedTarget);
                    var id = button.data('id');
                    var modal = $(this);

                    // Mengosongkan select kategori pada modal edit
                    modal.find('select[name="edit_kategori"]').empty();

                    // Mengambil data kategori melalui AJAX
                    $.ajax({
                        url: 'backend/load_category_book.php',
                        method: 'GET',
                        success: function (response) {
                            var kategori = JSON.parse(response);
                            var options = "";
                            for (var i = 0; i < kategori.length; i++) {
                                options += "<option value='" + kategori[i].id_category + "'>" + kategori[i].name_category + "</option>";
                            }
                            modal.find('select[name="edit_kategori"]').html(options);
                        }
                    });

                    // Mendapatkan data buku yang akan di-edit melalui AJAX
                    $.ajax({
                        url: 'backend/load_edit_book.php',
                        method: 'GET',
                        data: { id: id },
                        success: function (response) {
                            var buku = JSON.parse(response);
                            modal.find('#update_id').val(buku.product_id);
                            modal.find('select[name="edit_kategori"]').val(buku.id_category);
                            modal.find('#edit_product_name').val(buku.product_name);
                            modal.find('#edit_product_price').val(buku.product_price);
                            modal.find('#edit_product_description').val(buku.product_description);
                            modal.find('#edit_product_status').val(buku.product_status);
                        }
                    });
                });

                // Mengirim data buku yang telah di-edit melalui AJAX
                $('#formEditBuku').on('submit', function (event) {
                    event.preventDefault();
                    var form = $(this);
                    var url = form.attr('action');
                    var formData = new FormData(form[0]);

                    $.ajax({
                        url: url,
                        method: 'POST',
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function (response) {
                            var result = JSON.parse(response);
                            if (result.status === "success") {
                                Swal.fire("Success!", result.message, "success").then(function () {
                                    location.reload(); // Reload the page after success
                                });
                            } else {
                                Swal.fire("Error!", result.message, "error");
                            }
                        }
                    });
                });
            });
        });

        $(document).on('click', '.btn-delete', function () {
            var deleteId = $(this).data('id');

            // Tampilkan SweetAlert konfirmasi penghapusan
            Swal.fire({
                title: 'Konfirmasi',
                text: 'Apakah Anda yakin ingin menghapus data ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Batal'
            }).then(function (result) {
                if (result.isConfirmed) {
                    $.ajax({
                        url: 'backend/delete_book.php',
                        method: 'POST',
                        data: { delete_id: deleteId },
                        success: function (response) {
                            console.log(response);

                            // Tampilkan SweetAlert berhasil dihapus
                            Swal.fire({
                                title: 'Berhasil',
                                text: 'Data berhasil dihapus',
                                icon: 'success'
                            }).then(function () {
                                location.reload();
                            });
                        },
                        error: function (xhr, status, error) {
                            console.log('AJAX request failed: ' + error);
                            Swal.fire({
                                title: 'Error',
                                text: 'Terjadi kesalahan saat menghapus data',
                                icon: 'error'
                            });
                        }
                    });
                }
            });
        });

    </script>

</body>

</html>