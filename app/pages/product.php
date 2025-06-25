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

<?php

include_once(__DIR__ . "/../templates/index_footer.php");
?>