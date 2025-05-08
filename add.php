<?php
$email = $_POST['email'];
$pass = $_POST['pass'];
$role = $_POST['role'];

$pdo = new PDO(
    "mysql: host=localhost;dbname=enset-2025",
    "root",
    ""
);

$sql = "INSERT INTO users VALUES(NULL, '$email', '$pass', '$role')";
$stmt = $pdo->query($sql);

 header('Location: /');