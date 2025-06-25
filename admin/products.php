<?php
require_once __DIR__.'/inc/db.php';
include '_header.php';

// Hapus produk
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    
    // 1. Ambil nama file gambar utama
    $q = mysqli_query($conn, "SELECT image FROM products WHERE id=$id");
    if($img = mysqli_fetch_assoc($q)) {
        $image_path = __DIR__.'/../img/'.$img['image'];
        if(file_exists($image_path)) unlink($image_path);
    }
    
    // 2. Ambil nama file gambar tambahan
    $q_images = mysqli_query($conn, "SELECT image_name FROM product_images WHERE product_id=$id");
    while($img_row = mysqli_fetch_assoc($q_images)) {
        $image_path = __DIR__.'/../img/'.$img_row['image_name'];
        if(file_exists($image_path)) unlink($image_path);
    }

    // 3. Hapus record dari database
    mysqli_query($conn, "DELETE FROM product_images WHERE product_id=$id");
    mysqli_query($conn, "DELETE FROM products WHERE id=$id");

    header('Location: products.php');
    exit();
}
$result = mysqli_query($conn, "SELECT * FROM products ORDER BY id DESC");
?>

<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h3 mb-0">Manajemen Produk</h2>
        <a href="product_form.php" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Produk Baru</a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover align-middle">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Gambar</th>
                    <th scope="col">Nama Produk</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Stok</th>
                    <th scope="col" style="width: 15%;">Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php if(mysqli_num_rows($result) > 0): while($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td>
                        <img src="../img/<?= htmlspecialchars($row['image']) ?>" alt="<?= htmlspecialchars($row['name']) ?>" class="img-thumbnail">
                    </td>
                    <td class="align-middle">
                        <strong><?= htmlspecialchars($row['name']) ?></strong>
                        <p class="text-muted small mb-0"><?= substr(htmlspecialchars($row['description']), 0, 80) ?>...</p>
                    </td>
                    <td class="align-middle">
                        <?php if($row['discount_price'] && $row['discount_price'] < $row['price']): ?>
                            <del class="text-muted">Rp<?= number_format($row['price']) ?></del><br>
                            <span class="text-primary font-weight-bold">Rp<?= number_format($row['discount_price']) ?></span>
                        <?php else: ?>
                            <span class="text-primary font-weight-bold">Rp<?= number_format($row['price']) ?></span>
                        <?php endif; ?>
                    </td>
                    <td class="align-middle"><?= $row['stock'] ?></td>
                    <td class="align-middle">
                        <a href="product_form.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm" title="Edit">
                            <i class="fa fa-pencil"></i> Edit
                        </a>
                        <a href="products.php?delete=<?= $row['id'] ?>" class="btn btn-danger btn-sm" title="Hapus" onclick="return confirm('Anda yakin ingin menghapus produk ini? Semua gambar terkait juga akan dihapus.')">
                            <i class="fa fa-trash"></i> Hapus
                        </a>
                    </td>
                </tr>
            <?php endwhile; else: ?>
                <tr>
                    <td colspan="5" class="text-center">Belum ada produk. Silakan tambahkan produk baru.</td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include '_footer.php'; ?> 