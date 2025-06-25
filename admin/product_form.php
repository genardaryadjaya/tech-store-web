<?php
require_once __DIR__.'/inc/db.php';
include '_header.php'; // Header sudah menangani session dan HTML head

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$name = $price = $discount_price = $description = $image = '';
$product_images = [];
$is_edit = $id > 0;

if ($is_edit) {
    $res = mysqli_query($conn, "SELECT * FROM products WHERE id=$id");
    if ($row = mysqli_fetch_assoc($res)) {
        $name = $row['name'];
        $price = $row['price'];
        $discount_price = $row['discount_price'];
        $description = $row['description'];
        $image = $row['image'];

        $img_res = mysqli_query($conn, "SELECT id, image_name FROM product_images WHERE product_id=$id");
        while($img_row = mysqli_fetch_assoc($img_res)) {
            $product_images[] = $img_row;
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $price = floatval($_POST['price']);
    $discount_price = !empty($_POST['discount_price']) ? floatval($_POST['discount_price']) : 'NULL';
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $stock = intval($_POST['stock']);

    $main_image_sql = "";
    if (!empty($_FILES['image']['name'])) {
        $img_name = time().'_'.basename($_FILES['image']['name']);
        if (move_uploaded_file($_FILES['image']['tmp_name'], '../img/'.$img_name)) {
            $main_image_sql = ", image='$img_name'";
        }
    }

    if ($is_edit) {
        $sql = "UPDATE products SET name='$name', price=$price, discount_price=$discount_price, description='$description', stock=$stock $main_image_sql WHERE id=$id";
        mysqli_query($conn, $sql);
    } else {
        $img_name = $img_name ?? '';
        $sql = "INSERT INTO products (name, price, discount_price, description, stock, image) VALUES ('$name', $price, $discount_price, '$description', $stock, '$img_name')";
        mysqli_query($conn, $sql);
        $id = mysqli_insert_id($conn);
    }

    if (!empty($_FILES['images']['name'][0])) {
        foreach ($_FILES['images']['tmp_name'] as $key => $tmp_name) {
            if ($_FILES['images']['error'][$key] === 0) {
                $img_preview = time().'_'.basename($_FILES['images']['name'][$key]);
                move_uploaded_file($tmp_name, '../img/'.$img_preview);
                mysqli_query($conn, "INSERT INTO product_images (product_id, image_name) VALUES ($id, '$img_preview')");
            }
        }
    }
    header('Location: products.php');
    exit();
}
?>

<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card shadow-sm">
                <div class="card-header bg-dark text-white">
                    <h5 class="mb-0"><?= $is_edit ? 'Edit' : 'Tambah' ?> Produk</h5>
                </div>
                <div class="card-body">
                    <form method="post" enctype="multipart/form-data">
                        <div class="form-group mb-3">
                            <label for="name" class="form-label">Nama Produk</label>
                            <input type="text" id="name" name="name" class="form-control" value="<?= htmlspecialchars($name) ?>" required>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="price" class="form-label">Harga</label>
                                <input type="number" id="price" name="price" class="form-control" value="<?= htmlspecialchars($price) ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label for="discount_price" class="form-label">Harga Diskon (Opsional)</label>
                                <input type="number" id="discount_price" name="discount_price" class="form-control" value="<?= htmlspecialchars($discount_price) ?>">
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="stock" class="form-label">Stok</label>
                            <input type="number" id="stock" name="stock" class="form-control" value="<?= htmlspecialchars($row['stock'] ?? 0) ?>" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="description" class="form-label">Deskripsi</label>
                            <textarea id="description" name="description" class="form-control" rows="4" required><?= htmlspecialchars($description) ?></textarea>
                        </div>
                        <div class="form-group mb-3">
                            <label for="image" class="form-label">Gambar Utama</label>
                            <input type="file" id="image" name="image" class="form-control">
                            <?php if($image): ?>
                                <img src="../img/<?= htmlspecialchars($image) ?>" width="100" class="mt-2 rounded">
                            <?php endif; ?>
                        </div>
                        <div class="form-group mb-4">
                            <label for="images" class="form-label">Gambar Tambahan</label>
                            <input type="file" id="images" name="images[]" class="form-control" multiple>
                        </div>

                        <hr>
                        <a href="products.php" class="btn btn-secondary">Batal</a>
                        <button type="submit" class="btn btn-primary"><?= $is_edit ? 'Simpan Perubahan' : 'Tambah Produk' ?></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include '_footer.php'; ?> 