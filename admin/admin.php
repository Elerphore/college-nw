<?php
require '../layouts/header.php';
require '../database/database.php';

if(isset($_POST['save'])) {
    $postId = $_POST['postId'];
    $title = $_POST['title'];
    $description = $_POST['description'];

    $conn->exec("update posts set title = '$title', description = '$description'  where id = $postId");
}

if(isset($_POST['delete'])) {
    $postId = $_POST['postId'];
    $conn->exec("delete from posts where id = $postId");
}


$stmt = $conn->query("
            select
                p.id as postId,
                title,
                description,
                username,
                (select count(*) from comments where comments.post_id = p.id) as commentQuantity,
                (select count(*) from users_posts where users_posts.post_id = p.id and users_posts.type = 'like') as likes_quantity,
                (select count(*) from users_posts where users_posts.post_id = p.id and users_posts.type = 'dislike') as dislikes_quantity
            from posts p
            join users u on u.id = p.user_id 
        ");
?>

<div class="mt-4 container">
    <h1 class="text-center">Новости</h1>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">Заголовок</th>
            <th scope="col">Текст</th>
            <th scope="col">Автор</th>
            <th scope="col">Лайков</th>
            <th scope="col">Дизлайков</th>
            <th scope="col">Комментарии</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        <?php while ($post = $stmt->fetch()) { ?>
            <form action="./admin.php" method="post">
                <input type="hidden" name="postId" id="postId" value="<?php echo $post['postId'] ?>">
                <tr>
                    <td>
                        <input type="text" name="title" id="title" value="<?php echo $post['title'] ?>">
                    </td>
                    <td>
                        <input type="text" name="description" id="description" value="<?php echo $post['description'] ?>">
                    </td>
                    <td>
                        <input disabled type="text" value="<?php echo $post['username'] ?>">
                    </td>
                    <td>
                        <input disabled type="text" value="<?php echo $post['likes_quantity'] ?>">
                    </td>
                    <td>
                        <input disabled type="text" value="<?php echo $post['dislikes_quantity'] ?>">
                    </td>
                    <td>
                        <input disabled type="text" value="<?php echo $post['commentQuantity'] ?>">
                    </td>

                    <td class="d-flex gap-1">
                        <button type="submit" name="save" class="btn btn-primary">Сохранить</button>
                        <button type="submit" name="delete" class="btn btn-danger">Удалить</button>
                    </td>
                </tr>
            </form>
        <?php } ?>
        </tbody>
    </table>

</div>
<?php require '../layouts/footer.php' ?>
