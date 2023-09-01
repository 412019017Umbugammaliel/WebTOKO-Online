<?php
require_once '../db.php';

// Periksa apakah parameter pencarian ada
if (isset($_GET['search'])) {
    $searchQuery = $_GET['search'];

    // Query untuk mencari produk berdasarkan nama
    $query = "SELECT * FROM tabel_product WHERE product_name LIKE '%$searchQuery%'";
    $result = mysqli_query($conn, $query);

    // Periksa apakah ada hasil pencarian
    if (mysqli_num_rows($result) > 0) {
        // Loop untuk menampilkan hasil pencarian produk
        while ($row = mysqli_fetch_assoc($result)) {
            $productName = $row['product_name'];
            $productImage = $row['product_image'];
            $productPrice = $row['product_price'];
            ?>
            <div class="col-md-4">
                <a href="detail-produk.php?id=<?php echo $row['product_id']; ?>">
                    <div class="book-card gallery">
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
        echo '<p>Tidak ada hasil yang cocok dengan pencarian Anda.</p>';
    }
} else {
    echo '<p>Pencarian tidak valid.</p>';
}

mysqli_close($conn);
?>