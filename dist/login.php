<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../src/output.css">
    <title>Login</title>
</head>
<body>
    <div class="flex justify-center items-center h-screen bg-gray-200">
        <div class="w-96 p-6 shadow-lg bg-white rounded-md">
            <div class="flex justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10 text-primary">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                  </svg>
                <h1 class="text-3xl block text-center font-semibold pb-3">Login</h1>                  
            </div>
            <hr>
            <form action="index.php" method="post">
                <?php if(isset($_GET['error'])) {?>
                    <p class="block text-center mt-4 font-semibold text-primary"> <?php echo $_GET['error'] ?></p>
                <?php } ?>
                <?php if(isset($_GET['success'])) {?>
                    <p class="block text-center mt-4 font-semibold text-green-500"> <?php echo $_GET['success'] ?></p>
                <?php } ?>
                <div class="mt-3">
                    <label for="username" class="block text-base mb-3">Username</label>
                    <input type="text" name="uname" id="username" class="border w-full text-base px-2 py-1 focus:outline-none focus:ring-0 focus:border-gray-600" placeholder="Enter Username">
                </div>
                <div class="mt-3">
                    <label for="password" class="block text-base mb-3">password</label>
                    <input type="password" name="pass" id="username" class="border w-full text-base px-2 py-1 focus:outline-none focus:ring-0 focus:border-gray-600" placeholder="Enter Password">
                </div>
                <div class="mt-3 flex justify-between items-center">
                    <div>
                        <input type="checkbox">
                        <label for="">Remember me</label>
                    </div>
                    <div>
                        <a href="signup.php" class="text-primary">Create an account</a>
                    </div>
                </div>
                <div class="mt-5">
                    <button type="submit" class="border-2 border-primary bg-primary py-1 px-5 text-white w-full hover:bg-red-600 hover:border-red-600">Login</button>
                </div>
            </form>
        </div>
        
    </div>
</body>
</html>