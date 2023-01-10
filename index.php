<?php
    require './layouts/header.php';
    require './database/database.php';

    $stmt = $conn->query("select * from posts");
?>

    <div class="mt-4 container">
        <h1 class="text-center">Новости</h1>

        <div class="news d-flex justify-content-center mt-4 text-center flex-wrap">
            <?php while ($post = $stmt->fetch()) { ?>
                <div class="fs-2 w-75 mb-5">
                    <div><?php echo $post['title'] ?></div>
                    <div><?php echo $post['description'] ?></div>

                    <div class="d-grid gap-2 mt-4">
                        <a href="./post/post.php?postId=<?php echo $post['id'] ?>" class="btn btn-primary" type="button">Подробней</a>
                    </div>
                </div>

            <?php } ?>
        </div>

    </div>
<?php require './layouts/footer.php' ?>
