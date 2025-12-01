<!DOCTYPE html>
<html lang="ro">
<head>
    <link rel="stylesheet" href="styles.css">
    <meta charset="UTF-8">
    <title>Înregistrare - Fashion Store</title>
</head>
<body>

<h1 class="page-title">Înregistrare utilizator</h1>

<div class="center-box">
    <form action="../backend/auth/register.php" method="POST">

        <label>Username:</label>
        <input type="text" name="username" required>

        <label>Email:</label>
        <input type="email" name="email" required>

        <label>Parola:</label>
        <input type="password" name="password" required>

        <button type="submit">Creează cont</button>
    </form>

    <p class="form-footer">
        Ai deja cont?  
        <a href="login.php">Mergi la login</a>
    </p>
</div>
</body>
</html>
