<?php
include_once(__DIR__ . "/../templates/index_header.php");
$db = Database::db_connect();

$page = $_GET['page'] ?? 0;
$offset = $page * 9;
$products = Database::db_fetch_all("SELECT * FROM products LIMIT 9 OFFSET $offset");
$categories = Database::db_fetch_all("SELECT * FROM categories");
?>
    <div class="container mt-4">
        <h1 class="mb-4">Products</h1>
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <?php foreach ($products as $product): ?>
                <div class="col">
                    <div class="card h-100">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">
                                <a href="/product?product_id=<?php echo urlencode($product['id']); ?>">
                                    <?php echo htmlspecialchars($product['name']); ?>
                                </a>
                            </h5>
                            <p class="card-text flex-grow-1"><?php echo htmlspecialchars($product['description']); ?></p>
                            <p class="card-text"><strong>Price: </strong>$<?php echo htmlspecialchars($product['price']); ?></p>
                            <p class="card-text"><small class="text-muted">Category: <?php echo htmlspecialchars($categories[$product['category_id'] - 1]["category"]); ?></small></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
<?php
$total_products_result = Database::db_fetch_all("SELECT COUNT(*) as count FROM products");
$total_products = $total_products_result[0]['count'];
$total_pages = ceil($total_products / 9);

$current_page = isset($_GET['page']) ? (int)$_GET['page'] : 0;
?>

    <div class="mt-4 d-flex justify-content-between">
        <?php if ($current_page > 0): ?>
            <a href="?page=<?php echo $current_page - 1; ?>" class="btn btn-outline-primary">&laquo; Previous</a>
        <?php else: ?>
            <span></span>
        <?php endif; ?>

        <?php if ($current_page < $total_pages - 1): ?>
            <a href="?page=<?php echo $current_page + 1; ?>" class="btn btn-outline-primary">Next &raquo;</a>
        <?php endif; ?>
    </div>

<?php
include_once(__DIR__ . "/../templates/index_footer.php");

