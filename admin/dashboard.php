<?php
require_once __DIR__.'/inc/db.php';
include '_header.php'; 

// Mengambil 5 produk terbaru
$latest_products = mysqli_query($conn, "SELECT * FROM products ORDER BY created_at DESC LIMIT 5");
?>

<div class="container py-4">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 font-weight-bold"><i class="fa fa-clock-o" style="margin-right: 10px;"></i>Produk Terbaru Ditambahkan</h5>
                    <a href="products.php" class="btn btn-sm btn-light">Buka Manajemen Produk <i class="fa fa-arrow-right"></i></a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead>
                                <tr>
                                    <th style="width: 10%;">Gambar</th>
                                    <th>Nama Produk</th>
                                    <th>Harga</th>
                                    <th>Stok</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(mysqli_num_rows($latest_products) > 0): while($product = mysqli_fetch_assoc($latest_products)): ?>
                                <tr>
                                    <td><img src="../img/<?= htmlspecialchars($product['image']) ?>" class="img-thumbnail" alt="<?= htmlspecialchars($product['name']) ?>"></td>
                                    <td><strong><?= htmlspecialchars($product['name']) ?></strong></td>
                                    <td>Rp<?= number_format($product['price']) ?></td>
                                    <td><?= $product['stock'] ?></td>
                                </tr>
                                <?php endwhile; else: ?>
                                <tr>
                                    <td colspan="4" class="text-center">Belum ada produk yang ditambahkan.</td>
                                </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include '_footer.php'; ?> 