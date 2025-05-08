<?php
$id = $_POST['idd'];
$email = $_POST['email'];
$pass = $_POST['pass'];
$role = $_POST['role'];

$pdo = new PDO(
    "mysql: host=localhost;dbname=enset-2025",
    "root",
    ""
);

$sql = "UPDATE  users SET email='$email', password='$pass', role='$role' WHERE id=$id";
$stmt = $pdo->query($sql);

 header('Location: /');

