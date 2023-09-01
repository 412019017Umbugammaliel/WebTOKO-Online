<?php
require_once '../db.php';

$produk = mysqli_query($conn, "SELECT * FROM tabel_product WHERE product_status = 1 ORDER BY product_id DESC LIMIT 4");
if (mysqli_num_rows($produk) > 0) {
    while ($p = mysqli_fetch_array($produk)) {
        ?>
        <div class="col-md-4">
            <a href="detail-produk.php?id=<?php echo $p['product_id']; ?>">
                <div class="book-card gallery">
                    <img src="./admin/product_images/<?php echo $p['product_image']; ?>" class="img-fluid" alt="Product Image">
                    <div class="book-details">
                        <p class="font-weight-bold text-dark mb-2" style="font-size: 16px;">
                            <?php echo substr($p['product_name'], 0, 30) ?>
                        </p>
                        <p class="harga text-dark" style="font-size: 14px;">Rp.
                            <?php echo number_format($p['product_price']) ?>
                        </p>
                    </div>
                </div>
            </a>
        </div>
    <?php }
} else { ?>
    <div class="col-md-12">
        <p>Produk Tidak ada</p>
    </div>
<?php } ?>