<?php 
include "db_conn.php";
session_start();
if (!isset($_SESSION['user_id'])) {
    // Assume some form of user session management
    exit('User not logged in.');
}

$userId = $_SESSION['user_id']; // User ID from session
$productId = (int) $_POST['product_id'];
$quantity = (int) $_POST['quantity'];

if (!$productId) {
    exit('Product ID is required.');
}

// Check if the product is already in the cart
$sql = "SELECT * FROM cartItems WHERE user_id = ? AND product_id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, 'ii', $userId, $productId);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if ($row = mysqli_fetch_assoc($result)) {
    $newQuantity = $quantity;
    $updateSql = "UPDATE cartItems SET quantity = ? WHERE user_id = ? AND product_id = ?";
    $updateStmt = mysqli_prepare($conn, $updateSql);
    mysqli_stmt_bind_param($updateStmt, 'iii', $newQuantity, $userId, $productId);
    mysqli_stmt_execute($updateStmt);
} else {
    // Insert a new record
    $insertSql = "INSERT INTO cartItems (user_id, product_id, quantity) VALUES (?, ?, ?)";
    $insertStmt = mysqli_prepare($conn, $insertSql);
    mysqli_stmt_bind_param($insertStmt, 'iii', $userId, $productId, $quantity);
    mysqli_stmt_execute($insertStmt);
}

echo "Item added to cart successfully.";
?>