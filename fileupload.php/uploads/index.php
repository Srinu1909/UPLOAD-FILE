<?php
require '../config/config.php';

$query = $pdo->query("SELECT posts.*, users.username FROM posts JOIN users ON posts.user_id = users.id ORDER BY created_at DESC");
$posts = $query->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Blog</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <div class="container">
        <h1>My Blog</h1>
        <?php if (isset($_SESSION['user_id'])): ?>
            <p><a href="add_post.php">Add New Post</a> | <a href="logout.php">Logout</a></p>
        <?php else: ?>
            <p><a href="login.php">Login</a> | <a href="register.php">Register</a></p>
        <?php endif; ?>

        <?php foreach ($posts as $post): ?>
            <div class="post">
                <h2><?php echo htmlspecialchars($post['title']); ?></h2>
                <p><?php echo nl2br(htmlspecialchars($post['content'])); ?></p>
                <small>Posted by: <?php echo htmlspecialchars($post['username']); ?> on <?php echo $post['created_at']; ?></small>
            </div>
            <hr>
        <?php endforeach; ?>
    </div>
</body>
</html>
