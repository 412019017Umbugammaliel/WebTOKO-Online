<?php
require_once '../db.php';

// Periksa apakah ada parameter category_id yang diterima
if (isset($_GET['category_id'])) {
    $categoryId = $_GET['category_id'];

    // Query untuk mendapatkan produk berdasarkan ID kategori
    $query = "SELECT * FROM tabel_product WHERE id_category = '$categoryId' AND product_status = 1 ORDER BY product_id DESC";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $productId = $row['product_id'];
            $productName = $row['product_name'];
            $productPrice = $row['product_price'];
            $productImage = $row['product_image'];
            ?>
            <div class="col-md-4">
                <a href="detail-produk.php?id=<?php echo $productId; ?>" class="text-decoration-none">
                    <div class="book-card">
                        <img src="./admin/product_images/<?php echo $productImage; ?>" class="img-fluid" alt="Product Image">
                        <div class="book-details">
                            <p class="font-weight-bold text-dark mb-2" style="font-size: 16px;">
                                <?php echo substr($productName, 0, 30); ?>
                            </p>
                            <p class="harga text-dark" style="font-size: 14px;">Rp.
                                <?php echo number_format($productPrice); ?>
                            </p>
                        </div>
                    </div>
                </a>
            </div>
            <?php
        }
    } else {
        echo '<p>Produk tidak ditemukan</p>';
    }
} else {
    echo '<p>Parameter category_id tidak ditemukan</p>';
}

mysqli_close($conn);
?>