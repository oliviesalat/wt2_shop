<?php
session_start();
require_once __DIR__ . '/../../vendor/autoload.php';

use FPDF;

$db = Database::db_connect();
$user_id = $_SESSION['user_id'];

$cart = Database::db_fetch_all("SELECT * FROM `cart_items` WHERE `user_id` = ?", ['types' => 'i', 'fields' => [$user_id]]);

$stmt = $db->prepare("INSERT INTO orders (user_id) VALUES (?)");
$stmt->bind_param("i", $user_id);
if (!$stmt->execute()) {
    die("Failed to create order: " . $stmt->error);
}
$order_id = $stmt->insert_id;
$stmt->close();

$stmt = $db->prepare("INSERT INTO order_items (order_id, product_id, product_name, product_price, quantity) VALUES (?, ?, ?, ?, ?)");
foreach ($cart as $item) {
    $stmt->bind_param(
        "iisdi",
        $order_id,
        $item['product_id'],
        $item['product_name'],
        $item['product_price'],
        $item['quantity']
    );
    if (!$stmt->execute()) {
        die("Failed to insert order item: " . $stmt->error);
    }
}
$stmt->close();

$stmt = $db->prepare("DELETE FROM cart_items WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->close();

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(0, 10, 'Order Confirmation', 0, 1, 'C');
$pdf->SetFont('Arial', '', 12);
$pdf->Ln(10);

$total = 0;
foreach ($cart as $item) {
    $line = $item['product_name'] . ' x' . $item['quantity'] . ' - $' . number_format($item['quantity'] * $item['product_price'], 2);
    $pdf->Cell(0, 10, $line, 0, 1);
    $total += $item['quantity'] * $item['product_price'];
}

$pdf->Ln(10);
$pdf->Cell(0, 10, 'Total: $' . number_format($total, 2), 0, 1, 'R');

$pdf_filename = 'order_' . $order_id . '.pdf';
$pdf_path = __DIR__ . '/../../public/orders/' . $pdf_filename; // Путь изменен

if (!is_dir(dirname($pdf_path))) {
    mkdir(dirname($pdf_path), 0777, true);
}

$pdf->Output($pdf_path, 'F');

$_SESSION['order_pdf'] = $pdf_filename;

header('Location: /order_success');
exit;