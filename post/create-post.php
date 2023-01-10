<?php require '../layouts/header.php' ?>

<?php
require '../database/database.php';

if(isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->query("select * from users where username = '$username' and password = '$password'");
    $user = $stmt->fetch();

    $_SESSION['username'] = $user['username'];
    $_SESSION['password'] = $user['password'];

    header("Location: ../index.php");
}
?>

<form class="container">
    <div class="mb-3">
        <label for="title" class="form-label">Заголовок</label>
        <input type="text" class="form-control" id="title" name="title">
    </div>
    <div class="mb-3">
        <label for="information" class="form-label">Описание</label>
        <input type="text" class="form-control" id="information" name="information">
    </div>
    <button type="submit" class="btn btn-primary">Отправить</button>
</form>
