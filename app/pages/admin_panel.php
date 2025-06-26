<?php
include_once(__DIR__ . "/../templates/index_header.php");

if ($_SESSION['role_id'] == 1) {
    header("Location : /products");
}

if (!empty($_SESSION['added_product'])) {
    echo "<h2>Product <strong>" . htmlspecialchars($_SESSION['added_product']) . "</strong> successfully added to the database.</h2>";
    unset($_SESSION['added_product']);
}
?>

<form method="post" action="/?action=add_product" class="container mt-4">
    <h2 class="mb-4">Add product to database</h2>
    <div class="mb-3">
        <label for="name">Product name</label>
        <input id="name" name="name" type="text" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="category_id">Product category_id</label>
        <input id="category_id" name="category_id" type="number" min="1" max="4" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="description">Product description</label>
        <input id="description" name="description" type="text" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="price">Product price</label>
        <input id="price" name="price" type="number" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary w-100">Submit</button>
</form>

<?php
include_once(__DIR__ . "/../templates/index_footer.php");

