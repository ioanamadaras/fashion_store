<?php require '../../backend/helpers/admin_check.php'; ?>
<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../assets/styles.css">
    <title>Admin - Dashboard</title>
</head>

<body>

<h1 class="home-title">Panou Administrativ</h1>

<div class="user-box">
    Ești conectată ca: 
    <strong><?php echo $_SESSION["username"]; ?></strong>
</div>

<div class="admin-actions">

    <a class="admin-btn" href="list.php">
        Gestionează produse
    </a>

    <a class="admin-btn" href="../../backend/auth/logout.php" 
       onclick="return confirm('Sigur vrei să te deloghezi?');">
        Logout
    </a>

    <a class="admin-btn secondary" href="../../public/index.php">
        Înapoi la magazin
    </a>

</div>
<hr class="separator">

<div class="admin-grid">

    <div class="admin-card">
        <h3>Produse</h3>
        <p>Vezi, editează sau șterge produse.</p>
        <a class="admin-small-btn" href="list.php">Intră în secțiune</a>
    </div>

    <div class="admin-card">
        <h3>Comenzi</h3>
        <p>(Opțional) Poți integra gestionarea comenzilor aici.</p>
        <a class="admin-small-btn disabled">În curând</a>
    </div>

    <div class="admin-card">
        <h3>Utilizatori</h3>
        <p>(Opțional) Gestionare utilizatori.</p>
        <a class="admin-small-btn disabled">În curând</a>
    </div>
</div>
</body>
</html>
