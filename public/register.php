<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <title>Înregistrare - Fashion Store</title>
</head>
<body>
<h1>Înregistrare utilizator</h1>

<form action="../backend/auth/register.php" method="POST">
    <label>
        Username:<br>
        <input type="text" name="username" required>
    </label>
    <br><br>

    <label>
        Email:<br>
        <input type="email" name="email" required>
    </label>
    <br><br>

    <label>
        Parola:<br>
        <input type="password" name="password" required>
    </label>
    <br><br>

    <button type="submit">Creează cont</button>
</form>

<p>Ai deja cont? <a href="login.php">Mergi la login</a></p>
</body>
</html>
