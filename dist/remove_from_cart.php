<?php
include 'db_conn.php'; // Ensure you have your database connection file

session_start();
if (!isset($_SESSION['user_id'])) {
    exit('User not logged in.');
}

$userId = $_SESSION['user_id'];
$productId = isset($_POST['product_id']) ? (int) $_POST['product_id'] : null;

if (!$productId) {
    exit('Product ID is required.');
}

// Perform the deletion
$deleteSql = "DELETE FROM CartItems WHERE user_id = ? AND product_id = ?";
$deleteStmt = mysqli_prepare($conn, $deleteSql);
mysqli_stmt_bind_param($deleteStmt, 'ii', $userId, $productId);
if (mysqli_stmt_execute($deleteStmt)) {
    echo "Item removed from cart successfully.";
} else {
    echo "Error removing item: " . mysqli_stmt_error($deleteStmt);
}
?>