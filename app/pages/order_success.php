<?php
include_once(__DIR__ . "/../templates/index_header.php");

$pdf_file = $_SESSION['order_pdf'] ?? null;
?>

    <main class="container mt-5 text-center">
        <h1>Thank you for your order!</h1>
        <p class="lead mt-3">Your order has been placed successfully.</p>

        <?php if ($pdf_file): ?>
            <div class="mt-4">
                <a href="/orders/<?= htmlspecialchars($pdf_file) ?>"
                   class="btn btn-primary"
                   download="order_<?= htmlspecialchars($pdf_file) ?>">
                    Download Invoice (PDF)
                </a>
            </div>
        <?php endif; ?>

        <div class="mt-4">
            <a href="/products" class="btn btn-success">Continue Shopping</a>
        </div>
    </main>

<?php
unset($_SESSION['order_pdf']);
include_once(__DIR__ . "/../templates/index_footer.php");