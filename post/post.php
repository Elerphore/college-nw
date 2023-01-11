<?php require '../layouts/header.php' ?>
<?php

require '../database/database.php';

$user_id = $_SESSION['user_id'];
$postId = null;

if(isset($_POST['like']) || isset($_POST['dislike'])) {
    $type = null;
    $postId = $_POST['postId'];

    $users_posts = $conn->query("select * from users_posts where user_id = $user_id and post_id = $postId")->fetch();

    if(isset($_POST['like'])) {
        $type = 'like';
    } else {
        $type = 'dislike';
    }

    if($users_posts == null) {
        $conn->exec("insert into users_posts (user_id, post_id, type) values ($user_id, $postId, '$type')");
    } else {
        $conn->exec("update users_posts set type = '$type' where user_id = $user_id and post_id = $postId");
    }


    $_GET['postId'] = $postId;
}

if(isset($_GET['postId']) || isset($_POST['input_post_id'])) {
    if(isset($_GET['postId'])) {
        $postId = $_GET['postId'];
    }

    if($postId == null) {
        $postId = $_POST['input_post_id'];
    }

    $stmt = $conn->query(
            "
                    select 
                        p.id as postId,
                        title,
                        description,
                        (select count(*) from users_posts where users_posts.post_id = p.id and users_posts.type = 'like') as likes_quantity,
                        (select count(*) from users_posts where users_posts.post_id = p.id and users_posts.type = 'dislike') as dislikes_quantity
                    from posts p where id = '$postId'
            ");

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
                                where user_id = '$user_id' and post_id = '$postId'
                                "
                    );

?>
    <div class="container text-center fs-1">
        <div class="mb-5"><?php echo $post['title'] ?></div>
        <div class="mb-5"><?php echo $post['description'] ?></div>

        <div class="input-group mb-3">
            <span class="input-group-text">Лайки</span>
            <input disabled type="text" class="form-control" value="<?php echo $post['likes_quantity'] ?>">
            <span class="input-group-text">Дизлайки</span>
            <input disabled type="text" class="form-control" value="<?php echo $post['dislikes_quantity'] ?>">
        </div>

        <form action="./post.php" method="post" class="mb-5">
            <div class="d-flex gap-1">
                <input type="hidden" id="postId" name="postId" value="<?php echo $post['postId'] ?>">
                <button type="submit" name="like" id="like" class="w-100 btn btn-primary">Лайк</button>
                <button type="submit" name="dislike" id="dislike" class="w-100 btn btn-danger">Дизлайк</button>
            </div>
        </form>

        <form method="post" action="post.php">
            <div class="mb-3">
                <input type="hidden" name="input_post_id" id="input_post_id" value="<?php echo $postId ?>">
                <label for="comment" class="form-label">Комментарий</label>
                <input type="text" class="form-control" id="comment" name="comment">
            </div>

            <div class="d-grid gap-2 mt-4 mb-2">
                <button name="post_comment" id="comment" type="submit" class="btn btn-primary">Откоментировать</button>
            </div>

            <div class="d-grid fs-5" style="text-align: left">
                <?php while($comment = $commentsFetch->fetch()) { ?>
                    <div><?php echo $comment['username'].': '.$comment['text'] ?></div>
                <?php } ?>
            </div>
        </form>
    </div>
<?php require '../layouts/footer.php' ?>
