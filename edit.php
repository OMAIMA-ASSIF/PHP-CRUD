<?php
    $id = $_GET['idd'];
    if(!$id) header("location:/");
    $pdo = new PDO(
        "mysql: host=localhost;dbname=enset-2025",
        "root",
        ""
    );
    
    $sql = "SELECT * FROM users WHERE id=$id";
    $stmt = $pdo->query($sql);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if(!$user) header('location:/');

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users list</title>
    <link rel="stylesheet" href="https://bootswatch.com/5/darkly/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h1>Edit user</h1>
        <form action="save.php" method="post">
            <input type="hidden" name="idd" value="<?= $id ?>">
            <input type="text" name="email" placeholder="Email" 
            value="<?= $user['email'] ?>" class="form-control mb-3">
            <input type="password" value="<?= $user['password'] ?>" placeholder="Password" name="pass" class="form-control mb-3">
            <select name="role" id="" class="form-select mb-3">
                <option value="guest" 
                <?= ($user['role'] == 'guest') ? 'selected' : '' ?>
                >Guest</option>
                <option value="author" 
                <?= ($user['role'] == 'author') ? 'selected' : '' ?>
                >Author</option>
                <option value="admin"
                <?= ($user['role'] == 'admin') ? 'selected' : '' ?>
                >Admin</option>
            </select>
            <button class="btn btn-primary">Enregistrer</button>
        </form>
        <hr>
    </div>
</body>

</html>