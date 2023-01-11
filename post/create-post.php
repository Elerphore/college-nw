<?php require '../layouts/header.php' ?>

<?php
require '../database/database.php';

if(isset($_POST['post'])) {
    $title = $_POST['title'];
    $information = $_POST['information'];
    $userId = $_SESSION['user_id'];

    $conn->exec("insert into posts (title, description, user_id) values ('$title', '$information', $userId)");

    header("Location: ../index.php");
}
?>

<form class="container" method="post" action="./create-post.php">

    <h1 class="text-center">Создать пост</h1>

    <div class="mb-3">
        <label for="title" class="form-label">Заголовок</label>
        <input type="text" class="form-control" id="title" name="title">
    </div>
    <div class="mb-3">
        <label for="information" class="form-label">Описание</label>
        <input type="text" class="form-control" id="information" name="information">
    </div>
    <button type="submit" class="btn btn-primary" id="post" name="post">Отправить</button>
</form>
