<?php
    require './layouts/header.php';
    require './database/database.php';

    $stmt = $conn->query("select * from posts order by id desc");
?>

    <div class="mt-4 container">
        <h1 class="text-center">Новости</h1>

        <div class="news d-flex justify-content-center mt-4 text-center flex-wrap">
            <?php while ($post = $stmt->fetch()) { ?>
                <div class="fs-2 w-75 mb-5">
                    <div class="fs-1 fw-bold mb-5"><?php echo $post['title'] ?></div>
                    <div
                            style="
                                display: -webkit-box;
                                -webkit-line-clamp: 2; /* number of lines to show */
                                line-clamp: 2;
                                -webkit-box-orient: vertical;
                                overflow: hidden;
                                text-overflow: ellipsis;"
                    ><?php echo $post['description'] ?></div>

                    <div class="d-grid gap-2 mt-4">
                        <a href="/post/post.php?postId=<?php echo $post['id'] ?>" class="btn btn-primary" type="button">Подробней</a>
                    </div>
                </div>

            <?php } ?>
        </div>

    </div>
<?php require './layouts/footer.php' ?>
git 
