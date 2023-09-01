<?php
require_once '../db.php';

// Query untuk mendapatkan data kategori
$query = "SELECT * FROM tabel_category ORDER BY id_category DESC";
$result = mysqli_query($conn, $query);

// Periksa apakah ada data kategori
if (mysqli_num_rows($result) > 0) {
    // Loop untuk menampilkan data kategori
    $counter = 0;
    while ($row = mysqli_fetch_assoc($result)) {
        $idCategory = $row['id_category'];
        $nameCategory = $row['name_category'];
        ?>
        <?php if ($counter % 3 == 0): ?>
            <div class="row justify-content-center">
            <?php endif; ?>

            <div class="col-4">
                <a href="produk_kategori.php?id=<?php echo $idCategory; ?>" class="text-decoration-none">
                    <div class="book-card">
                        <img src="img/open-book.png" alt="Book Cover" class="gambar-bergerak">
                        <div class="category-name">
                            <?php echo $nameCategory; ?>
                        </div>
                    </div>
                </a>
            </div>

            <?php if (($counter + 1) % 3 == 0 || $counter == mysqli_num_rows($result) - 1): ?>
            </div>
        <?php endif; ?>

        <?php
        $counter++;
    }
} else {
    echo '<p>Kategori tidak ada</p>';
}

mysqli_close($conn);
?>