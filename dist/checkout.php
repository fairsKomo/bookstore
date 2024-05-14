<?php
session_start();
header('Content-Type: application/json');  // Set header for JSON response

include "db_conn.php";

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'User not logged in']);
    exit;
}

$uid = $_SESSION['user_id'];

// Read data from the client
$data = json_decode(file_get_contents("php://input"), true);
$items = $data['items'];
$total = $data['total'];

if (empty($items)) {
    echo json_encode(['success' => false, 'message' => 'No items in cart']);
    exit;
}

try {
    // Start transaction
    $conn->begin_transaction();

    // Insert into sales table
    $stmt1 = $conn->prepare("INSERT INTO sales (user_id, total_price) VALUES (?, ?)");
    $stmt1->bind_param("id", $uid, $total);
    $stmt1->execute();
    $saleID = $stmt1->insert_id;  // Retrieve the ID of the inserted sales record

    // Prepare statement for inserting sale items
    $stmt2 = $conn->prepare("INSERT INTO sale_items (sale_id, book_id, quantity, price) VALUES (?, ?, ?, ?)");
    foreach ($items as $item) {
        $stmt2->bind_param('iiid', $saleID, $item['book_id'], $item['quantity'], $item['price']);
        $stmt2->execute();
    }

    // Delete user's cart items
    $stmt3 = $conn->prepare("DELETE FROM cartitems WHERE user_id = ?");
    $stmt3->bind_param("i", $uid);
    $stmt3->execute();

    // Attempt to commit the transaction
    if ($conn->commit()) {
        echo json_encode(['success' => true, 'message' => 'Checkout completed successfully']);
    } else {
        throw new Exception("Transaction commit failed");
    }
} catch (Exception $e) {
    $conn->rollback();  // Rollback the transaction on error
    echo json_encode(['success' => false, 'message' => 'An error occurred: ' . $e->getMessage()]);
}
?>
