<?php
session_start();
require_once 'db_conn.php';
$post = null;
$message = '';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    $message = "Invalid post ID.";
} else {
    $postId = (int) $_GET['id'];

    try {
        $stmt = $pdo->prepare("SELECT p.*, u.username FROM posts p JOIN users u ON p.user_id = u.id WHERE p.id = ?");
        $stmt->execute([$postId]);
        $post = $stmt->fetch();

        if (!$post) {
            $message = "Post not found.";
        }
    } catch (PDOException $e) {
        $message = "Error fetching post: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $post ? htmlspecialchars($post['title']) : 'Post Not Found'; ?></title>
    <style>
        /* Color Palette */
        :root {
            --primary-color: #6D9773;
            /* Muted Green */
            --dark-accent: #0C3B2E;
            /* Dark Forest Green */
            --button-color: #BB8A52;
            /* Earthy Brown */
            --highlight-color: #FFBA00;
            /* Vibrant Yellow */
            --text-color: #333;
            --background-light: #f8f8f8;
            --container-bg: #fff;
            --border-color: #e0e0e0;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: var(--background-light);
            color: var(--text-color);
        }

        .container {
            max-width: 800px;
            margin: 30px auto;
            padding: 30px;
            background-color: var(--container-bg);
            border-radius: 10px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: var(--dark-accent);
            margin-bottom: 10px;
            font-size: 2.5em;
            text-align: center;
        }

        .post-meta {
            font-size: 0.95em;
            color: #666;
            margin-bottom: 25px;
            border-bottom: 1px solid var(--primary-color);
            /* Green divider */
            padding-bottom: 15px;
            text-align: center;
        }

        .post-meta span {
            margin: 0 15px;
        }

        .post-meta strong {
            color: var(--dark-accent);
        }

        .post-content {
            font-size: 1.1em;
            line-height: 1.9;
            color: #444;
            padding: 0 15px;
        }

        .back-link {
            display: block;
            margin-top: 40px;
            text-align: center;
        }

        .back-link a {
            display: inline-block;
            padding: 12px 22px;
            background-color: var(--button-color);
            /* Back link uses earthy brown */
            color: white;
            text-decoration: none;
            border-radius: 6px;
            font-weight: bold;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .back-link a:hover {
            background-color: #A37546;
            transform: translateY(-2px);
        }

        .message.error {
            color: #D8000C;
            background-color: #FFEFEF;
            border: 1px solid #FFDCDC;
            padding: 12px;
            border-radius: 5px;
            margin-bottom: 20px;
            text-align: center;
            font-weight: bold;
        }

        .post-actions {
            text-align: right;
            margin-top: 25px;
            font-size: 0.95em;
            border-top: 1px solid #eee;
            padding-top: 15px;
        }

        .post-actions a {
            color: var(--primary-color);
            text-decoration: none;
            margin-left: 20px;
            font-weight: bold;
            transition: color 0.3s ease;
        }

        .post-actions a:hover {
            color: var(--dark-accent);
            text-decoration: underline;
        }

        .post-actions a.delete-link {
            color: #dc3545;
        }

        .post-actions a.delete-link:hover {
            color: #b02a37;
        }
    </style>
        <link rel="stylesheet" href="css/navbar_custom.css">
</head>

<body>
    <div class="container">
        <?php if ($post): ?>
            <h2><?php echo htmlspecialchars($post['post_title']); ?></h2>
            <div class="post-meta">
                <span>By: <strong><?php echo htmlspecialchars($post['username']); ?></strong></span>
                <span>Posted on: <?php echo date('F j, Y, g:i a', strtotime($post['created_at'])); ?></span>
            </div>
            <div class="post-content">
                <?php echo nl2br(htmlspecialchars($post['post_text'])); ?>
            </div>
            <?php if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $post['user_id']): ?>
                <div class="post-actions">
                    <a href="edit_post.php?id=<?php echo $post['id']; ?>">Edit Post</a> |
                    <a href="delete_post.php?id=<?php echo $post['id']; ?>" class="delete-link"
                        onclick="return confirm('Are you sure you want to delete this post?');">Delete Post</a>
                </div>
            <?php endif; ?>
        <?php else: ?>
            <div class="message error">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>

        <div class="back-link">
            <a href="index.php">Back to All Posts</a>
        </div>
    </div>
</body>

</html>