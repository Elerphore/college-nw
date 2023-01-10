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
    $_SESSION['user_id'] = $user['id'];

    header("Location: ../index.php");
}
?>

<form class="container" method="post" action="./login.php">
    <h1>Авторизация</h1>
    <div class="mb-3">
        <label for="username" class="form-label">Логин</label>
        <input type="text" class="form-control" id="username" name="username">
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Пароль</label>
        <input type="password" class="form-control" id="password" name="password">
    </div>
    <button name="login" id="login" type="submit" class="btn btn-primary">Войти</button>
</form>
<?php require '../layouts/footer.php' ?>
