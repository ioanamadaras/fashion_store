<!DOCTYPE html>
<html lang="ro">
<head>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
    <meta charset="UTF-8">
    <link rel="stylesheet" href="assets/styles.css">
    <title>Autentificare - Fashion Store</title>
</head>
<body>
<h1 class="page-title">Autentificare</h1>

<div class="login-container">
    <form class="login-form" action="../backend/auth/login.php" method="POST">

        <label>Username:</label>
        <input type="text" name="username" required>

        <label>Parola:</label>
        <input type="password" name="password" required>

        <button type="submit">Login</button>
    </form>
</div>

<p class="login-footer">
    Nu ai cont? <a href="register.php">Înregistrează-te aici</a>
</p>

</body>
</html>
