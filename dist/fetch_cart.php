<?php
include 'db_conn.php';  //database connection script
session_start();
if (!isset($_SESSION['user_id'])) {
    echo json_encode([]);  // No user is logged in
    exit;
}

$userId = 3;
// $userId = $_SESSION['user_id'];

$query = "
            SELECT 
            books.book_id,
            books.title,
            books.author,
            books.price,
            books.image_path,
            cartItems.quantity
            FROM 
                cartItems
            JOIN 
                books ON cartItems.product_id = books.book_id
            WHERE 
                cartItems.user_id = $userId
            ORDER BY 
                books.title;
                    ";
$res = mysqli_query($conn, $query);
$cartItems = [];
while ($row = $res->fetch_assoc()) {
    $cartItems[] = $row;
}
echo json_encode($cartItems);
?>
