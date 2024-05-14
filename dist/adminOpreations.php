<?php 
    include "db_conn.php";

    if(($_SERVER["REQUEST_METHOD"] == "POST") && isset($_POST['addNewUserButton'])){
            $username = $_POST['username'] ?? '';
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
            $phone = $_POST['phone'] ?? '';
            $role = $_POST['role'] ?? 'user';

            if(empty($username) || empty($password) || empty($email) || empty($phone)){
                echo "Fields Cannot be empty";
            } else{

                $stmt = mysqli_prepare($conn, "INSERT INTO users (username, email, password, phone, role) VALUES (?, ?, ?, ?, ?)");
                
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                mysqli_stmt_bind_param($stmt,"sssss", $username, $email, $hashed_password, $phone,$role);

                if(mysqli_stmt_execute($stmt)){
                    header("Location: admin.php?success=User added successfully");
                    exit();
                } else{
                    header("Location: admin.php?error=Error adding user");
                    exit();
                }
            }
    }

    if(($_SERVER["REQUEST_METHOD"] == "POST") && isset($_POST['signUpButton'])){
        $username = $_POST['username'] ?? '';
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        $phone = $_POST['phone'] ?? '';
        $role = $_POST['role'] ?? 'user';

        if(empty($username) || empty($password) || empty($email) || empty($phone)){
            header("Location: signup.php?error=All Fields Are Required");
            exit();
        } else{
            $validation ="SELECT * FROM users WHERE username = ?";
            $stmt = mysqli_prepare($conn, $validation);
            mysqli_stmt_bind_param($stmt, "s", $username);
            mysqli_stmt_execute($stmt);
            $vresult = mysqli_stmt_get_result($stmt);
            if(mysqli_num_rows($vresult) > 0){
                header("Location: signup.php?error=This Username is used before!");
                exit();
            }
            else{
                $stmt = mysqli_prepare($conn, "INSERT INTO users (username, email, password, role, phone) VALUES (?, ?, ?, ?, ?)");
            
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                mysqli_stmt_bind_param($stmt,"sssss", $username, $email, $hashed_password, $role, $phone);

                if(mysqli_stmt_execute($stmt)){
                    header("Location: login.php?success=Your Account Created Now Log In");
                    exit();
                } else{
                    header("Location: signup.php?error=Unkown error occured try again later");
                    exit();
                }
            }
            
        }
}

    if(($_SERVER["REQUEST_METHOD"] == "POST") && isset($_POST['deleteUser'])){
        $userID = $_POST['userID'] ?? '';
        $userID = intval($userID);
        if(!empty($userID)){
            $stmt = mysqli_prepare($conn, "DELETE FROM users WHERE user_id = ?");
            mysqli_stmt_bind_param($stmt, "i", $userID);

            if (mysqli_stmt_execute($stmt)) {
                header("Location: admin.php?success=User deleted successfully");
                exit();
            } else {
                header("Location: admin.php?error=Error deleting user");
                exit();
            }
        } else {
            echo "ID field for deletion cannot be empty";
        }
    }

    if(($_SERVER["REQUEST_METHOD"] == "POST") && isset($_POST['addBook'])){
        $target_dir = "assets/";
                $target_file = $target_dir . basename($_FILES['image']["name"]);
                $uploadOk = 1;
                $imageType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

                $check = getimagesize($_FILES['image']['tmp_name']);
                if($check !== false){
                    $uploadOk = 1;
                } else{
                    $uploadOk = 0;
                }

                if(file_exists($target_file)){
                    $uploadOk = 0;
                }

                if($_FILES['image']['size'] > 5000000){
                    $uploadOk = 0;
                }
                if($uploadOk == 0){
                    header("Location: admin.php?error=Error while adding the book");
                    exit();
                }

                $title = $_POST['title'] ?? '';
                $author = $_POST['author'] ?? '';
                $isbn = $_POST['isbn'] ?? '';
                $price = floatval($_POST['price']) ?? '';
                $quantity = intval($_POST['quantity']) ?? '';

                if(empty($title) || empty($author) || empty($isbn) || empty($price) || empty($quantity)){
                    echo "Fields Cannot be empty";
                } else{
                    $stmt = mysqli_prepare($conn, "INSERT INTO books (title, author, isbn, price, quantity_in_stock, image_path) VALUES (?, ?, ?, ?, ?, ?)");
                    mysqli_stmt_bind_param($stmt,"sssdis" ,$title, $author, $isbn, $price, $quantity, $target_file);

                    if(mysqli_stmt_execute($stmt)){
                        header("Location: admin.php?success=Book added successfully");
                        exit();
                    } else{
                        header("Location: admin.php?error=Error while adding the book");
                        exit();
                    }
                }
    }
    if(($_SERVER["REQUEST_METHOD"] == "POST") && isset($_POST['updateBook'])){
        $bookID = isset($_POST['bookid']) ? intval($_POST['bookid']) : 0;
                $title = $_POST['title'] ?? '';
                $author = $_POST['author'] ?? '';
                $price = isset($_POST['price']) ? floatval($_POST['price']) : 0.0;
                $quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 0;
            
                // Validate the input
                if ($bookID > 0 && !empty($title) && !empty($author) && $price >= 0 && $quantity >= 0) {
                    $stmt = mysqli_prepare($conn, "UPDATE books SET title = ?, author = ?, price = ?, quantity_in_stock = ? WHERE book_id = ?");
                    mysqli_stmt_bind_param($stmt, "ssdii", $title, $author, $price, $quantity, $bookID);
            
                    if (mysqli_stmt_execute($stmt)) {
                        header("Location: admin.php?success=Book updated successfully");
                        exit();
                    } else {
                        header("Location: admin.php?error=Error updating book");
                        exit();
                    }
                } else {
                    header("Location: admin.php?error=Invalid input or missing book ID");
                    exit();
                }
    }

    if(($_SERVER["REQUEST_METHOD"] == "POST") && isset($_POST['deleteBook'])){
        $bookID = $_POST['bookId'] ?? '';
                $bookID = intval($bookID);
                if(!empty($bookID)){
                    $stmt = mysqli_prepare($conn, "DELETE FROM books WHERE book_id = ?");
                    mysqli_stmt_bind_param($stmt, "i", $bookID);

                    if (mysqli_stmt_execute($stmt)) {
                        header("Location: admin.php?success=Book deleted successfully");
                        exit();
                    } else {
                        header("Location: admin.php?error=Error deleting book");
                        exit();
                    }
            }
    }
    
?>