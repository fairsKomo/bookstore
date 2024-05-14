<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .hidden { display: none; }
    </style>
</head>
<body class="bg-gray-100">
    <div class="p-8">
        <!-- Admin Operations -->
        <div class="space-y-8">
            <!-- Section Buttons -->
            <div class="text-center">
                <h1 class="text-5xl">Welcome Admin</h1>
            </div>
            <div class="h-64 grid grid-rows-3 grid-flow-col gap-4 ">
                <button onclick="toggleVisibility('addUserForm')" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Add New User</button>
                <button onclick="toggleVisibility('deleteUserForm')" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Delete User</button>
                <button onclick="toggleVisibility('addBookForm')" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Add New Book</button>
                <button onclick="toggleVisibility('deleteBookForm')" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Delete Book</button>
                <button onclick="toggleVisibility('editBookForm')" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Edit Book Info</button>
                <button onclick="toggleVisibility('checkSalesForm')" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Check Book Sales</button>
                <button onclick="toggleVisibility('showAllbooks')" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Show All Books</button>
                <button onclick="toggleVisibility('showAllusers')" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Show All users</button>
                <button onclick="toggleVisibility('showAllslaes')" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Show All Sales</button>
            </div>

            <?php if(isset($_GET['success'])) {?>
                    <p class="text-lg block text-center mt-4 mb-4 font-semibold text-green-500"> <?php echo $_GET['success']; ?></p>
            <?php } else if(isset($_GET['error'])){?>
                    <p class="text-lg block text-center mt-4 mb-4 font-semibold text-red-500"> <?php echo $_GET['error']; ?></p>
            <?php } ?>

            <!-- Add New User -->
            <div id="addUserForm" class="bg-white p-6 rounded shadow hidden">

                <form action="adminOpreations.php" method="post">
                    <input type="text" placeholder="Username" class="border p-2 rounded w-full mb-4" name="username">
                    <input type="email" placeholder="Email" class="border p-2 rounded w-full mb-4" name="email">
                    <input type="password" placeholder="Password" class="border p-2 rounded w-full mb-4" name="password">
                    <input type="text" placeholder="Phone Number" class="border p-2 rounded w-full mb-4" name="phone">
                    <select class="border p-2 rounded w-full mb-4" name="role">
                        <option value="user">User</option>
                        <option value="admin">Admin</option>
                    </select>
                    
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" name="addNewUserButton">Add User</button>
                </form>
            </div>

            <!-- Delete a User -->
            <div id="deleteUserForm" class="bg-white p-6 rounded shadow hidden">
                <h2 class="text-lg font-semibold mb-4">Delete a User</h2>
                <form action="adminOpreations.php" method="post">
                    <input type="number" placeholder="Enter user's ID to delete" class="border p-2 rounded w-full mb-4" name="userID">
                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" name="deleteUser">Delete User</button>
                </form>
            </div>

            <!-- Add New Book -->
            <div id="addBookForm" class="bg-white p-6 rounded shadow hidden">
                <h2 class="text-lg font-semibold mb-4">Add New Book</h2>
                <form action="adminOpreations.php" method="post" enctype="multipart/form-data">
                    <input type="text" placeholder="Title" class="border p-2 rounded w-full mb-4" name="title">
                    <input type="text" placeholder="Author" class="border p-2 rounded w-full mb-4" name="author">
                    <input type="text" placeholder="ISBN" class="border p-2 rounded w-full mb-4" name="isbn">
                    <input type="number" placeholder="Price" class="border p-2 rounded w-full mb-4" name="price">
                    <input type="number" placeholder="Quantity in Stock" class="border p-2 rounded w-full mb-4" name="quantity">
                    <input type="file" name="image">
                    <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded" name="addBook">Add Book</button>
                </form>
            </div>

            <!-- Delete a Book -->
            <div id="deleteBookForm" class="bg-white p-6 rounded shadow hidden">
                <h2 class="text-lg font-semibold mb-4">Delete a Book</h2>
                <form action="adminOpreations.php" method="post">
                    <input type="text" name="bookId" placeholder="Enter book ID to delete" class="border p-2 rounded w-full mb-4">
                    <button type="submit" name="deleteBook" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Delete Book</button>
                </form>
            </div>

            <!-- Edit Book Info -->
            <div id="editBookForm" class="bg-white p-6 rounded shadow hidden">
                <h2 class="text-lg font-semibold mb-4">Edit Book Info</h2>
                <form action="adminOpreations.php" method="post">
                    <input type="text" name = "bookid" placeholder="Book ID" class="border p-2 rounded w-full mb-4">
                    <input type="text" name = "title" placeholder="New Title" class="border p-2 rounded w-full mb-4">
                    <input type="text" name = "author" placeholder="New Author" class="border p-2 rounded w-full mb-4">
                    <input type="number" name = "price" placeholder="New Price" class="border p-2 rounded w-full mb-4">
                    <input type="number" name = "quantity" placeholder="New Quantity" class="border p-2 rounded w-full mb-4">
                    <button type="submit" name="updateBook" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">Update Info</button>
                </form>
            </div>

            <!-- Check Book Sales -->
            <div id="checkSalesForm" class="bg-white p-6 rounded shadow hidden">
                <h2 class="text-lg font-semibold mb-4">Check Book Sales</h2>
                <form action="admin.php" method="get">
                    <input type="text" name="bookID" placeholder="Enter The Book ID" class="border p-2 rounded w-full mb-4">
                    <button type="submit" name="checkBookSales" class="bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded">Check Sales</button>
                </form>
                <?php 
                include "db_conn.php";

                if(($_SERVER["REQUEST_METHOD"] == "GET") && isset($_GET['checkBookSales'])){
                    $bookID = $_GET['bookID'] ?? '';
                    $bookID = intval($bookID);
                    if(!empty($bookID)){
                        $stmt = mysqli_prepare($conn, "SELECT books.title, books.author, books.image_path, sale_items.quantity, sale_items.price, sale_items.sale_id FROM books JOIN sale_items ON books.book_id = sale_items.book_id WHERE books.book_id = ?");
                        mysqli_stmt_bind_param($stmt, "i", $bookID);
                        
                        $title = '';
                        $image_path = '';
                        $total = 0.0;
                        $quan = 0;

                        if (mysqli_stmt_execute($stmt)) {
                            $result = mysqli_stmt_get_result($stmt);
                            if($row = mysqli_fetch_assoc($result)){
                                $title = $row['title'];
                                $image_path = $row['image_path'];

                                do {
                                    $total += floatval($row['price']) * intval($row['quantity']);
                                    $quan += intval($row['quantity']);
                                } while ($row = mysqli_fetch_assoc($result));
                            }
                            
                            echo <<<HTML
                                    <div class="max-w-sm rounded overflow-hidden shadow-lg my-5 mx-auto">
                                        <img class="w-full h-48 object-cover" src="../${image_path}" alt="Book Image">
                                        <div class="px-6 py-4">
                                            <div class="font-bold text-xl mb-2">${title}</div>
                                        </div>
                                        <div class="px-6 pt-4 pb-2">
                                            <span class="inline-block bg-green-200 rounded-full px-3 py-1 text-sm font-semibold text-green-800 mr-2 mb-2">$${total}</span>
                                        </div>
                                        <div class="px-6 pt-4 pb-2">
                                            <span class = "text-xl font-semibold">Purchased ${quan} Times</span>
                                        </div>
                                    </div>
                                    HTML;
                        } else {
                            header("Location: admin.php?error=This Book has now sales or Some unknown error occuerd");
                            exit();
                        }
                    }
                }
                
                
                ?>
            </div>

            <div id="showAllbooks" class="bg-white p-6 rounded shadow">
                <form action="admin.php" method="get">
                    <button type="submit" name="showAllBooks" class="bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded">Show The Books</button>
                </form>
                <?php 
                include "db_conn.php";

                if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['showAllBooks'])) {
                    $sql = "SELECT * FROM books";
                    $result = mysqli_query($conn, $sql);

                    if (!$result) {
                        echo "Error running query: " . mysqli_error($conn);
                    } elseif (mysqli_num_rows($result) > 0) {
                        echo '<div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-4 p-4">';
                        while ($row = mysqli_fetch_assoc($result)) {
                            $title = htmlspecialchars($row['title']);
                            $author = htmlspecialchars($row['author']);
                            $imagePath = htmlspecialchars($row['image_path']);
                            $price = htmlspecialchars($row['price']);
                            $stockQuan = htmlspecialchars($row['quantity_in_stock']);
                            $bookID = htmlspecialchars($row['book_id']);
                            echo <<<HTML
                            <div class="max-w-sm rounded overflow-hidden shadow-lg my-3">
                                <img class="w-full h-48 object-cover" src="../$imagePath" alt="Book image">
                                <div class="px-6 py-4">
                                    <div class="font-bold text-xl mb-2">$title</div>
                                    <p class="text-gray-700 text-base mb-2">
                                        Author: $author
                                    </p>
                                    <p class="text-gray-700 text-base mb-2">
                                        Book-ID: $bookID
                                    </p>
                                    <p class="text-gray-700 text-base mb-2">
                                        Quantity In Stock: $stockQuan
                                    </p>
                                </div>
                                <div class="px-6 pt-4 pb-2">
                                    <span class="inline-block bg-green-200 rounded-full px-3 py-1 text-sm font-semibold text-green-800 mr-2 mb-2">$$price</span>
                                </div>
                            </div>
                            HTML;
                        }
                        echo '</div>';
                    } else {
                        echo "<p class='text-center text-xl mt-10'>No books found in the database.</p>";
                    }
                }
                ?>
            </div>


            <div id="showAllusers" class="bg-white p-6 rounded shadow hidden">
                <form action="admin.php" method="get">
                    <button type="submit" name="showAllUsers" class="bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded">Show The Users</button>
                </form>
                <?php
                    include "db_conn.php";

                    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['showAllUsers'])) {
                        echo '<div class="mt-8">';
                        echo '<h2 class="text-lg font-semibold mb-4">All Registered Users</h2>';

                        $sql = "SELECT user_id, username, email, role FROM users"; // Add any other user fields you need
                        $result = mysqli_query($conn, $sql);

                        if (mysqli_num_rows($result) > 0) {
                            // Start table
                            echo '<table class="min-w-full leading-normal">';
                            echo '<thead>';
                            echo '<tr>';
                            echo '<th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">User ID</th>';
                            echo '<th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Username</th>';
                            echo '<th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Email</th>';
                            echo '<th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Role</th>';
                            echo '</tr>';
                            echo '</thead>';
                            echo '<tbody>';
                            // Output data of each row
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo '<tr>';
                                echo '<td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">' . $row['user_id'] . '</td>';
                                echo '<td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">' . htmlspecialchars($row['username']) . '</td>';
                                echo '<td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">' . htmlspecialchars($row['email']) . '</td>';
                                echo '<td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">' . htmlspecialchars($row['role']) . '</td>';
                                echo '</tr>';
                            }
                            echo '</tbody>';
                            echo '</table>';
                        } else {
                            echo "0 results";
                        }
                        echo '</div>';
                    }
                ?>            
            </div>



            <div id="showAllslaes" class="bg-white p-6 rounded shadow hidden">
                <form action="admin.php" method="get">
                    <button type="submit" name="showAllsales" class="bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded">Show The Sales</button>
                </form>
                <?php 
                    include "db_conn.php";
                    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['showAllsales'])) {
                        echo '<div class="mt-8">';
                        echo '<h2 class="text-lg font-semibold mb-4">All Sales Records</h2>';

                        $sql = "SELECT sales.sale_id, sales.total_price, sales.sale_date, users.username AS user FROM sales LEFT JOIN users ON sales.user_id = users.user_id";
                        $result = mysqli_query($conn, $sql);

                        if (mysqli_num_rows($result) > 0) {
                            echo '<table class="min-w-full leading-normal">';
                            echo '<thead>';
                            echo '<tr>';
                            echo '<th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Sale ID</th>';
                            echo '<th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Total Price</th>';
                            echo '<th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Sale Date</th>';
                            echo '<th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">User</th>';
                            echo '</tr>';
                            echo '</thead>';
                            echo '<tbody>';
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo '<tr>';
                                echo '<td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">' . $row['sale_id'] . '</td>';
                                echo '<td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">' . htmlspecialchars(number_format($row['total_price'], 2)) . '</td>';
                                echo '<td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">' . htmlspecialchars(date('Y-m-d H:i:s', strtotime($row['sale_date']))) . '</td>';
                                echo '<td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">' . htmlspecialchars($row['user']) . '</td>';
                                echo '</tr>';
                            }
                            echo '</tbody>';
                            echo '</table>';
                        } else {
                            echo "<p class='text-center text-xl mt-10'>No sales records found.</p>";
                        }
                        echo '</div>';
                    }

                ?>
            </div>
        </div>
    </div>

    <script>
        function toggleVisibility(id) {
            var element = document.getElementById(id);
            if (element.style.display === 'block') {
                element.style.display = 'none';
            } else {
                element.style.display = 'block';
            }
        }
    </script>
</body>
</html>
