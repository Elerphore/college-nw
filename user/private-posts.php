<?php
require '../layouts/header.php';
require '../database/database.php';

if(isset($_POST['delete'])) {
    $post_id = $_POST['post_id'];
    $conn->exec("delete from posts where id = $post_id");
}

$user_id = $_SESSION['user_id'];
$stmt = $conn->query("select * from posts where user_id = '$user_id'");



?>

<div class="mt-4 container">
    <h1 class="text-center">Ваши новости</h1>

    <div class="news d-flex justify-content-center mt-4 text-center flex-wrap">
        <?php while ($post = $stmt->fetch()) { ?>
            <div class="fs-2 w-75 mb-5">
                <div><?php echo $post['title'] ?></div>
                <div><?php echo $post['description'] ?></div>

                <form action="./private-posts.php" method="post">
                    <div class="d-grid gap-2 mt-4">
                        <input type="hidden" name="post_id" id="post_id" value="<?php echo $post['id'] ?>">
                        <a href="../post/post.php?postId=<?php echo $post['id'] ?>" class="btn btn-primary" type="button">Подробней</a>
                        <button class="btn btn-danger" type="submit" name="delete" id="delete">Удалить</button>
                    </div>
                </form>

            </div>

        <?php } ?>
    </div>

</div>
<?php require '../layouts/footer.php' ?>
