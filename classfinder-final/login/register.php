<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Sign Up - ClassFinder</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,300;0,400;0,700;1,700&display=swap"
        rel="stylesheet"/>
</head>
<body>
    <section class="signup">
        <div class="signup-left">
            <div class="row">
                <div class="container">
                    <h2>Sign Up</h2>
                    <form action="register_process.php" method="post">
                        <label for="username">Username:</label>
                        <input type="text" id="username" name="username" required>
            
                        <label for="password">Password:</label>
                        <input type="password" id="password" name="password" required>
            
                        <!-- Tambahkan formulir untuk memilih peran -->
                        <label for="role">Role:</label>
                        <select name="role" required>
                            <option value="user">User</option>
                            <option value="admin">Admin</option>
                        </select>
            
                        <button type="submit">Register</button>
                    </form>
                    <p>Sudah punya akun? <a href="login.php">Login</a></p>
                </div>
            </div>
        </div>
        <div class="signup-right">
            <h1>Class<span>Finder</span></h1>
        </div>
    </section>
</body>
</html>
