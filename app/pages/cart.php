<?php
include_once(__DIR__ . "/../templates/index_header.php");

$db = Database::db_connect();


$user_id = $_SESSION['user_id'];
if (isset($user_id) && $_SESSION['is_logged']) {
    $cart_items = Database::db_fetch_all("SELECT * FROM `cart_items` WHERE `user_id` = ?", ['types' => 'i', 'fields' => [$user_id]]);
    ?>
    <div class="container mt-4">
        <h2>Your Cart</h2>
        <?php if (count($cart_items) > 0): ?>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Delete</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($cart_items as $item): ?>
                    <tr>
                        <td><?= htmlspecialchars($item['product_name']) ?></td>
                        <td>
                            <form method="post" action="/?action=edit_quantity" class="d-flex align-items-center gap-2">
                                <input type="hidden" name="product_id" value="<?= (int)$item['product_id'] ?>">
                                <label>
                                    <input type="number" name="quantity" value="<?= (int)$item['quantity'] ?>"
                                           min="1" class="form-control w-auto" required
                                           onchange="this.form.submit()">
                                </label>

                            </form>


                        </td>
                        <td>
                            <form method="post" action="/?action=remove_from_cart" class="container mt-4" style="max-width: 500px;">
                                <input id="product_id" name="product_id" class="form-control" type="hidden" value="<?= $item['product_id'] ?>">
                                <input id="user_id" name="user_id" class="form-control" type="hidden" value="<?= $user_id ?>">
                                <button type="submit" class="btn btn-outline-danger mt-2">Remove</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>Your cart is empty.</p>
        <?php endif; ?>
    </div>

    <?php
} else {
    echo "<p>Please log in to see your cart.</p>";
}
?>

    <div class="mt-4 d-flex justify-content-start">
        <button onclick="history.back()" class="btn btn-outline-primary">&laquo; Go Back</button>
    </div>

<?php
include_once(__DIR__ . "/../templates/index_footer.php");

