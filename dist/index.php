<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../src/output.css">
    <title>Home</title>
</head>
<body class="text-gray-600">
    <?php 
        session_start();
        include "db_conn.php";
        if(isset($_POST['uname']) && isset($_POST['pass'])){

            function validate($data){
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }

            $uname = validate($_POST['uname']);
            $pass = validate($_POST['pass']);

            if(empty($uname)){
                header("Location: login.php?error=User Name is Required");
                exit();
            }else if(empty($pass)){
                header("Location: login.php?error=Password is Required");
                exit();
            }

            $query = "SELECT * FROM users WHERE username = ?";
            $stmt = mysqli_prepare($conn, $query);
            mysqli_stmt_bind_param($stmt, "s", $uname);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if(mysqli_num_rows($result) === 1){
                $row = mysqli_fetch_assoc($result);
                if (password_verify($pass, $row['password'])) {
                $_SESSION['user_id'] = $row['user_id'];
                $_SESSION['role'] = $row['role'];
                header("Location: " . ($row['role'] == 'admin' ? "admin.php" : "index.php"));
                exit();
            } else {
                header("Location: login.php?error=Incorrect Username or Password");
                exit();
            }
        } else {
            header("Location: login.php?error=Incorrect Username or Password");
            exit();
        }
    }

    ?>
    <div class="grid md:grid-cols-3"><!-- Content Wrapper -->
        <div class="md:col-span-1">
            <nav>
                <div class="flex justify-between items-center">
                    <h1 class="font-bold uppercase p-4 md:border-b">
                        <a href="/" class="hover:text-gray-800">Bookstore</a>
                    </h1>
                    <div class="px-4 cursor-pointer md:hidden" id="burger">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                          </svg>                          
                    </div>
                </div>
                <ul class="flex-col justify-center hidden md:block" id="menue">
                    <li class="hover:text-gray-800 font-bold hover:border-r-4 hover:border-primary"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="icon">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                      </svg><a href="#"><span > Home</span></a>
                      </li>
                    <li class="hover:text-gray-800 font-bold hover:border-r-4 hover:border-primary"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="icon">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 5.25h.008v.008H12v-.008Z" />
                      </svg>
                      <a href="about.html"><span>About</span></a></li>
                    <li class="hover:text-gray-800 font-bold hover:border-r-4 hover:border-primary"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="icon">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" />
                      </svg>
                      <a href="contact.html"><span>Contact</span></a></li>
                </ul>
            </nav>
        </div>
        <main class="px-16 py-6 bg-gray-100 md:col-span-2">
            <div class="flex justify-center items-center md:justify-end">
                <a href="#" id="cart" class="btn text-primary border-primary md:border-2 hover:bg-primary hover:text-white"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                  </svg>
                  </a>
                <a href="login.php" class="btn text-primary border-primary md:border-2 ml-2 hover:bg-primary hover:text-white">Log-out</a>
            </div>

            <header>
                <h2 class="text-gray-700 text-6xl font-semibold py-2">Books</h2>
                <h3 class="text-2xl font-semibold">For bookworms</h3>
            </header>

            <div>
                <h4 class="font-bold mt-12 pb-2 border-b">Brandnew Books</h4>

                <div class="mt-8 grid md:grid-cols-2 lg:grid-cols-3 gap-10" id="listProduct">
                    <!-- Book Cards goes here -->
                    <?php 

                        $query = "SELECT * FROM books";
                        $res = mysqli_query($conn, $query);

                        if($res && $res->num_rows > 0) {
                            while($row = $res->fetch_assoc()) {
                                echo '<div class="card">';
                                echo '<img src="../'.htmlspecialchars($row['image_path']).'" alt="" class="image">';
                                echo '<div class="m-4">';
                                echo '<span class="font-bold">'.htmlspecialchars($row['title']).'</span>'; // Changed to 'title' assuming you want to display the book title
                                echo '<span class="block text-gray-500 text-sm">By '.htmlspecialchars($row['author']).'</span>'; // Changed to display the author
                                echo '<div class="flex justify-between">';
                                echo '<span class="text-green-500 font-bold">$'.htmlspecialchars($row['price']).'</span>'; // Display price correctly
                                echo '<svg xmlns="http://www.w3.org/2000/svg" 
                                        fill="none" 
                                        viewBox="0 0 24 24" 
                                        stroke-width="1.5" 
                                        stroke="currentColor" 
                                        class="w-10 h-10 cursor-pointer hover:text-primary addToCart"
                                        data-id="'.htmlspecialchars($row['book_id']).'" data-title="' . htmlspecialchars($row['title']) . '" data-price="' . htmlspecialchars($row['price']) . '" data-path="' . htmlspecialchars($row['image_path']) . '">';
                                echo '<path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />';
                                echo '</svg>';   
                                echo '</div>';                           
                                echo '</div>';
                                echo '</div>';
                            }
                        } else {
                            echo "<p>No books found.</p>";
                        }

                    ?>

                </div>


                
            </div>
            <div class="flex justify-center">
                <div class="btn bg-secondary-100 text-secondary-200 hover:bg-secondary-200 hover:text-secondary-100 mt-4">Load More</div>
            </div>
        </main>
        <div id="cartContainer" class="w-96 bg-gray-200 fixed inset-y-0 right-0 grid grid-rows-komo hidden">
            <h1 class=" text-3xl font-bold p-4">Shopping Cart</h1>
            <div id="listCarte" class="listCart">

                <!-- Cart Item Dynamically added here -->
                
            </div>
        

            <div class="grid grid-cols-2 bg-primary text-gray-900">
                <button id="close" class="hover:bg-red-600">close</button>
                <button id="checkout" class="hover:bg-red-600">Check out</button>
            </div>
        </div>
    </div>
    <script type="module" src="nindex.js"></script>
</body>
</html>