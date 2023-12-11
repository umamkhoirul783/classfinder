<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Login - ClassFinder</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,300;0,400;0,700;1,700&display=swap" rel="stylesheet"/>
</head>
<body>
    <section class="login">
        <div class="login-left">
            <h1>Class<span>Finder</span></h1>
        </div>
        <div class="login-right">
            <div class="row">
                <div class="container">
                    <h2>Login</h2>
                    <form action="login_process.php" method="post">
                        <label for="username">Username:</label>
                        <input type="text" id="username" name="username" required>

                        <label for="password">Password:</label>
                        <input type="password" id="password" name="password" required>

                        <button type="submit">Login</button>
                    </form>
                    <p>Belum punya akun? <a href="register.php">Register</a></p>
                </div>
            </div>
        </div>
    </section>
</body>
</html>
