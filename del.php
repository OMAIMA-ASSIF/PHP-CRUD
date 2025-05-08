<?php 

$id = $_GET['idd'];
$pdo = new PDO(
    "mysql: host=localhost;dbname=enset-2025",
    "root",
    ""
);

$sql = "DELETE FROM users WHERE id=$id";

$stmt = $pdo->exec($sql);

header("location:/");