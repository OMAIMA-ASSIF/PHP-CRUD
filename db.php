<?php 

$pdo = new PDO(
    "mysql: host=localhost;dbname=enset-2025",
    "root",
    ""
);
$stmt = $pdo->query("SELECT * FROM users");
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>


