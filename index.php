<?php require('./db.php'); ?>
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
        <h1>Users List</h1>
        <form action="add.php" method="post">
            <input type="text" name="email" placeholder="Email" class="form-control mb-3">
            <input type="password" placeholder="Password" name="pass" class="form-control mb-3">
            <select name="role" id="" class="form-select mb-3">
                <option value="guest">Guest</option>
                <option value="author">Author</option>
                <option value="admin">Admin</option>
            </select>
            <button class="btn btn-success">Ajouter</button>
        </form>
        <hr>
        <table class="table table-dark">
            <tr>
                <th>ID</th>
                <th>EMAIL</th>
                <th>PASSWORD</th>
                <th>ROLE</th>
                <th colspan="2" class="text-center">Actions</th>
                
            </tr>
            <?php foreach ($users as $user) : ?>
                <tr>
                    <td><?= $user['id'] ?></td>
                    <td><?= $user['email'] ?></td>
                    <td><?= $user['pass'] ?></td>
                    <td><?= $user['role'] ?></td>
                    <td  class="text-center">
                        <a onclick="f(event)" href="/del.php?idd=<?= $user['id'] ?>" class="btn btn-danger">X</a>
                    </td>
                    <td  class="text-center"><a href="/edit.php?idd=<?= $user['id'] ?>" class="btn btn-primary">E</a></td>
                </tr>
            <?php endforeach ?>
        </table>
        <hr>
        <pre>
            <?php print_r($users) ?>
        </pre>
    </div>

    <script>
        function f(e) {
            e.preventDefault()
            if(confirm('Etes-cous sur de vouloir supprimer')) {
                location.href = e.target.href
            }
        }
    </script>
</body>

</html>