<?php

$pdo = new PDO("mysql:host=localhost;dbname=enset-2025", "root", "");

// Ajouter 
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'add') {
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $role = $_POST['role'];
    $sql = "INSERT INTO users VALUES(NULL, '$email', '$pass', '$role')";
    $stmt = $pdo->query($sql);
    header("Location: tp.php");
    exit();
}

// Supprimer
if (isset($_GET['del'])) {
    $id = $_GET['del'];
    $sql = "DELETE FROM users WHERE id=$id";
    $stmt = $pdo->exec($sql);
    header("Location: tp.php");
    exit();
}

// Liste de users
$stmt = $pdo->query("SELECT * FROM users");
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Modifier
$editMode = false;
if (isset($_GET['edit'])) {
    $editMode = true;
    $id = $_GET['edit'];
    $stmt = $pdo->query("SELECT * FROM users WHERE id=$id");
    $editUser = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$editUser) {
        header("Location: tp.php");
        exit();
    }
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'save') {
    $id = $_POST['idd'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $role = $_POST['role'];
    $sql = "UPDATE  users SET email='$email', password='$pass', role='$role' WHERE id=$id";
    $stmt = $pdo->query($sql);

    header("Location: tp.php");    
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Users list</title>
    <link rel="stylesheet" href="https://bootswatch.com/5/darkly/bootstrap.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<div class="container">
    <h1 class="mt-3">Users List</h1>

    <form action="tp.php" method="post" class="mb-4">
        <input type="hidden" name="action" value="<?= $editMode ? 'save' : 'add' ?>">
        <?php if ($editMode): ?>
            <input type="hidden" name="idd" value="<?= $editUser['id'] ?>">
        <?php endif; ?>
        <input type="text" name="email" placeholder="Email" value="<?= $editMode ? $editUser['email'] : '' ?>" class="form-control mb-2" required>
        <input type="password" name="pass" placeholder="Password" value="<?= $editMode ? $editUser['pass'] : '' ?>" class="form-control mb-2" required>
        <select name="role" class="form-select mb-2" required>
            <option value="guest" <?= $editMode && $editUser['role'] === 'guest' ? 'selected' : '' ?>>Guest</option>
            <option value="author" <?= $editMode && $editUser['role'] === 'author' ? 'selected' : '' ?>>Author</option>
            <option value="admin" <?= $editMode && $editUser['role'] === 'admin' ? 'selected' : '' ?>>Admin</option>
        </select>
        <button class="btn btn-<?= $editMode ? 'primary' : 'success' ?>">
            <?= $editMode ? 'Enregistrer' : 'Ajouter' ?>
        </button>
        <?php if ($editMode): ?>
            <a href="tp.php" class="btn btn-secondary">Annuler</a>
        <?php endif; ?>
    </form>

    <table class="table table-dark">
        <thead>
        <tr>
            <th>ID</th>
            <th>EMAIL</th>
            <th>PASSWORD</th>
            <th>ROLE</th>
            <th colspan="2" class="text-center">Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?= $user['id'] ?></td>
                <td><?= $user['email'] ?></td>
                <td><?= $user['pass'] ?></td>
                <td><?= $user['role'] ?></td>
                <td class="text-center">
                    <a onclick="return confirmDelete(event)" href="?del=<?= $user['id'] ?>" class="btn btn-danger">X</a>
                </td>
                <td class="text-center">
                    <a href="?edit=<?= $user['id'] ?>" class="btn btn-primary">E</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script>
    function confirmDelete(e) {
        if (!confirm("Êtes-vous sûr de vouloir supprimer cet utilisateur ?")) {
            e.preventDefault();
            return false;
        }
        return true;
    }
</script>
</body>
</html>
