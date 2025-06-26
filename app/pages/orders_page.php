<?php

if (!isset($_SESSION['user_id'])) {
    header('Location: /auth_page');
    exit;
}

include_once(__DIR__ . "/../templates/index_header.php");


$db = Database::db_connect();
$user_id = $_SESSION['user_id'];

$orders = [];
$stmt = $db->prepare("
    SELECT o.id, o.created_at, SUM(oi.product_price * oi.quantity) AS total
    FROM orders o
    JOIN order_items oi ON o.id = oi.order_id
    WHERE o.user_id = ?
    GROUP BY o.id
    ORDER BY o.created_at DESC
");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result) {
    $orders = $result->fetch_all(MYSQLI_ASSOC);
}
$stmt->close();
?>

    <main class="container mt-5">
        <h1 class="mb-4">Your Orders</h1>

        <?php if (empty($orders)): ?>
            <div class="alert alert-info">
                You haven't placed any orders yet.
                <a href="/products" class="alert-link">Browse products</a>
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Date</th>
                        <th>Total</th>
                        <th>Invoice</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($orders as $order): ?>
                        <tr>
                            <td><?= $order['id'] ?></td>
                            <td><?= date('M d, Y H:i', strtotime($order['created_at'])) ?></td>
                            <td>$<?= number_format($order['total'], 2) ?></td>
                            <td>
                                <?php
                                $pdf_file = 'order_' . $order['id'] . '.pdf';
                                $pdf_path = __DIR__ . '/../../public/orders/' . $pdf_file;
                                ?>
                                <?php if (file_exists($pdf_path)): ?>
                                    <a href="/orders/<?= htmlspecialchars($pdf_file) ?>"
                                       class="btn btn-sm btn-outline-primary"
                                       download>
                                        Download PDF
                                    </a>
                                <?php else: ?>
                                    <span class="text-muted">Not available</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </main>

<?php include_once(__DIR__ . "/../templates/index_footer.php"); ?>