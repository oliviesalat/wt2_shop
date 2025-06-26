<?php
include_once(__DIR__ . "/../templates/index_header.php");

$product_id = $_GET['product_id'];
$db = Database::db_connect();

$product = Database::db_fetch_single("SELECT * FROM products WHERE id = ?", "i", $product_id);
$categories = Database::db_fetch_all("SELECT * FROM categories");

if ($product):
    ?>
    <div class="container mt-4">
        <h1><?= htmlspecialchars($product['name']) ?></h1>
        <p><strong>Description:</strong> <?= htmlspecialchars($product['description']) ?></p>
        <p><strong>Price:</strong> $<?= htmlspecialchars($product['price']) ?></p>
        <p>
            <strong>Category:</strong> <?= htmlspecialchars($categories[$product['category_id'] - 1]["category"] ?? 'Unknown') ?>
        </p>
    </div>
<?php
else:
    echo "<p>Product not found.</p>";
endif;
?>
    <div class="mt-4 d-flex justify-content-start">
        <button onclick="history.back()" class="btn btn-outline-primary">&laquo; Go Back</button>
    </div>

    <div class="mt-3">
        <?php if (isset($_SESSION['user_id'])): { ?>
            <form action="/?action=add_to_cart" method="post" class="d-flex align-items-center gap-2">
                <label>
                    <input type="number" name="quantity" value="1" min="1" class="form-control w-auto" required>
                </label>
                <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($product['id']); ?>">
                <input type="hidden" name="product_name" value="<?php echo htmlspecialchars($product['name']); ?>">
                <input type="hidden" name="product_price" value="<?php echo htmlspecialchars($product['price']); ?>">
                <button type="submit" class="btn btn-outline-success">
                    <i class="bi bi-cart-plus"></i> Add to Cart
                </button>
            </form>
            <?php
        } else : ?>
            <p>Log in to start shopping.</p>
        <?php endif; ?>
        <?php if (!empty($_SESSION['error_cart'])): ?>
            <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                <?= htmlspecialchars($_SESSION['error_cart']) ?>
                <?php unset($_SESSION['error_cart']); ?>
            </div>
        <?php endif; ?>
    </div>

<?php
include_once(__DIR__ . "/../templates/index_footer.php");
?>