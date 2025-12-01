<?php
require_once __DIR__ . "/../config/db_connect.php";



class GetProducts
{
    private $pdo; //proprietate pentru conexiunea PDO

    public function __construct($pdo)
    {
        $this->pdo = $pdo; //
    }

    // Returnează TOATE produsele
    public function getAll()
    {
        $stmt = $this->pdo->query("SELECT * FROM products"); // interogare simplă - ia toate produsele
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // returnează toate produsele ca un array asociativ
    }

    // Returnează UN produs după ID
    public function getById($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM products WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
