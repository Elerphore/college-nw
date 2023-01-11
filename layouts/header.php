<?php

    session_start();

    if(isset($_POST['logout'])) {
        $_SESSION = [];
        session_destroy();
    }
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>news</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
<body>
    <header>
        <nav class="navbar navbar-light bg-light">
            <div class="container-fluid">
                <a href="../index.php" class="navbar-brand">PINTEREST</a>
                <div class="d-flex gap-1 align-items-center">
                    <?php if(isset($_SESSION['username'])) { ?>
                        <a href="../index.php" class="btn btn-primary" type="submit">Главная</a>
                        <a href="../post/create-post.php" class="btn btn-primary" type="submit">Создать новость</a>

                        <a href="../user/private-posts.php" name="logout" id="logout" class="btn btn-primary" type="submit">Ваши новости</a>

                        <?php if($_SESSION['role'] == 'admin') { ?>
                            <a href="../admin/admin.php" name="logout" id="logout" class="btn btn-primary" type="submit">Админ панель</a>
                        <?php } ?>

                        <form action="../index.php" method="post">
                            <button name="logout" id="logout" class="btn btn-danger" type="submit">Выйти</button>
                        </form>
                    <?php } else { ?>
                        <a href="../authorization/login.php" class="btn btn-outline-success" type="submit">Войти</a>
                        <a href="../authorization/reg.php" class="btn btn-outline-success" type="submit">Регистрация</a>
                    <?php } ?>
                </div>
            </div>
        </nav>
    </header>
