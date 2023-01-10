<?php
require '../database/database.php';

if(isset($_POST['registration'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];;
    $sql = "insert into users(username, password) values ('$username', '$password')";

    $conn->exec($sql);
    header("Location: ../index.php");
}
?>

<?php
    require '../layouts/header.php'
?>
<form class="container" method="post" action="./reg.php">
    <h1>Регистрация</h1>
    <div class="mb-3">
        <label for="username" class="form-label">Логин</label>
        <input type="text" class="form-control" id="username" name="username">
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Пароль</label>
        <input type="password" class="form-control" id="password" name="password">
    </div>
    <button name="registration" id="registration" type="submit" class="btn btn-primary">Регистрация</button>
</form>
<?php require '../layouts/footer.php' ?>
