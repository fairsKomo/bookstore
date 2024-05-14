<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../src/output.css">
    <title>Signup</title>
</head>
<body>
    <div class="flex justify-center items-center h-screen bg-gray-200">
        <div class="w-96 p-6 shadow-lg bg-white rounded-md">
            <div class="flex justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10 text-primary">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                  </svg>
                <h1 class="text-3xl block text-center font-semibold pb-3">Create Account</h1>                  
            </div>
            <hr>
            <form action="adminOpreations.php" method="post">
                <?php if(isset($_GET['error'])) {?>
                    <p class="block text-center mt-4 font-semibold text-primary"> <?php echo $_GET['error'] ?></p>
                <?php } ?>
                <div class="mt-3">
                    <label for="username" class="block text-base mb-3">Username</label>
                    <input type="text" name="username" id="username" class="border w-full text-base px-2 py-1 focus:outline-none focus:ring-0 focus:border-gray-600" placeholder="Enter Username">
                </div>
                <div class="mt-3">
                    <label for="email" class="block text-base mb-3">E-mail</label>
                    <input type="email" name="email" id="email" class="border w-full text-base px-2 py-1 focus:outline-none focus:ring-0 focus:border-gray-600" placeholder="Enter E-mail">
                </div>
                <div class="mt-3">
                    <label for="password" class="block text-base mb-3">Password</label>
                    <input type="password" name="password" id="password" class="border w-full text-base px-2 py-1 focus:outline-none focus:ring-0 focus:border-gray-600" placeholder="Enter Password">
                </div>
                <div class="mt-3">
                    <label for="phone" class="block text-base mb-3">Phone Number</label>
                    <input type="text" name="phone" id="phone" class="border w-full text-base px-2 py-1 focus:outline-none focus:ring-0 focus:border-gray-600" placeholder="+966 555 555 5555">
                </div>

                <div class="text-center mt-5">
                    <p class="inline">Already have account?</p><a href="login.php" class="text-primary">Login</a>
                </div>
                <div class="mt-5">
                    <button type="submit" name ="signUpButton" class="border-2 border-primary bg-primary py-1 px-5 text-white w-full hover:bg-red-600 hover:border-red-600">Create Account</button>
                </div>
            </form>
        </div>
        
    </div>
</body>
</html>