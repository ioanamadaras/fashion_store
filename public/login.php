<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <title>Login - Fashion Store</title>
</head>
<body>
<h1>Autentificare</h1>

<form action="../backend/auth/login.php" method="POST">
    <label>
        Username:<br>
        <input type="text" name="username" required>
    </label>
    <br><br>

    <label>
        Parola:<br>
        <input type="password" name="password" required>
    </label>
    <br><br>

    <button type="submit">Login</button>
</form>

<p>Nu ai cont? <a href="register.php">Înregistrează-te aici</a></p>
</body>
</html>
