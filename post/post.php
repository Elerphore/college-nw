<?php require '../layouts/header.php' ?>
<?php

require '../database/database.php';

$user_id = $_SESSION['user_id'];
$postId = null;

if(isset($_GET['postId']) || isset($_POST['input_post_id'])) {
    if(isset($_GET['postId'])) {
        $postId = $_GET['postId'];
    }

    if($postId == null) {
        $postId = $_POST['input_post_id'];
    }

    $stmt = $conn->query("select * from posts where id = '$postId'");
    $post = $stmt->fetch();

}

if(isset($_POST['post_comment'])) {
    $comment = $_POST['comment'];
    $sql = "insert into comments(user_id, post_id, text) value ($user_id, $postId, '$comment')";
    $conn->exec($sql);
}

$commentsFetch = $conn
                    ->query(
                    "
                                select 
                                    *
                                from
                                    comments c
                                join users u on u.id = c.user_id 
                                where user_id = '$user_id' and post_id = '$postId'"
                    );

?>
    <div class="container text-center fs-1">
        <div class="mb-5"><?php echo $post['title'] ?></div>
        <div class="mb-5"><?php echo $post['description'] ?></div>

        <form method="post" action="post.php">
            <div class="mb-3">
                <input type="hidden" name="input_post_id" id="input_post_id" value="<?php echo $postId ?>">
                <label for="comment" class="form-label">Комментарий</label>
                <input type="text" class="form-control" id="comment" name="comment">
            </div>
            <div class="d-grid gap-2 mt-4">
                <button name="post_comment" id="comment" type="submit" class="btn btn-primary">Откоментировать</button>
            </div>

            <div class="d-grid" style="text-align: left">
                <?php while($comment = $commentsFetch->fetch()) { ?>
                    <div><?php echo $comment['username'].': '.$comment['text'] ?></div>
                <?php } ?>
            </div>
        </form>
    </div>
<?php require '../layouts/footer.php' ?>
