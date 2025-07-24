<?php
session_start();
require_once 'db_conn.php';
$logged = false;
if (isset($_SESSION['user_id']) && isset($_SESSION['username'])) {
    $logged = true;
    $user_id = $_SESSION['user_id'];
}
$notFound = 0;

// Ensure user_id and username are set before using them
if (!isset($_SESSION['user_id']) || !isset($_SESSION['username'])) {
    // Redirect to login or handle unauthenticated access
    header("Location: login.php"); // Or wherever your login page is
    exit();
}

$user_id = $_SESSION['user_id'];
$username = htmlspecialchars($_SESSION['username']);

$message = '';
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    unset($_SESSION['message']);
}

$user_posts = [];
try {
    $stmt = $conn->prepare("SELECT * FROM post WHERE user_id = ? ORDER BY created_at DESC");
    $stmt->execute([$user_id]);
    $user_posts = $stmt->fetchAll();
} catch (PDOException $e) {
    $message = "Error fetching your posts: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Dashboard - <?php echo $username; ?></title>
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
            /* Still defined, but not directly used for main container */
            --border-color: #e0e0e0;
            --light-green-bg: #F8FCF8;
            --light-green-border: #DCEEDA;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            /* padding: 20px; /* Provides some padding from the screen edges */
            color: var(--text-color);
            line-height: 1.6;
        }

        /* REMOVED .container-blog STYLES */
        h2 {
            text-align: center;
            color: var(--dark-accent);
            margin-bottom: 30px;
            font-size: 2.2em;
            position: relative;
            padding-bottom: 10px;
            /* Add some padding for full-width content */
            padding-left: 20px;
            padding-right: 20px;
        }

        h2::after {
            content: '';
            position: absolute;
            left: 50%;
            bottom: 0;
            transform: translateX(-50%);
            width: 80px;
            height: 3px;
            background-color: var(--primary-color);
            border-radius: 2px;
        }

        .welcome-section {
            text-align: center;
            margin-bottom: 30px;
        }

        .welcome-section p {
            font-size: 1.1em;
            color: #555;
        }

        .nav-linkes {
            text-align: center;
            margin-bottom: 40px;
            border-bottom: 1px solid var(--border-color);
            padding-bottom: 20px;
            /* Add some padding for full-width content */
            padding-left: 20px;
            padding-right: 20px;
        }

        .nav-linkes a {
            display: inline-block;
            padding: 12px 22px;
            margin: 0 10px;
            background-color: var(--button-color);
            color: white;
            text-decoration: none;
            border-radius: 6px;
            font-weight: bold;
            transition: background-color 0.3s ease, transform 0.2s ease, box-shadow 0.2s ease;
        }

        .nav-linkes a:hover {
            background-color: #A37546;
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .post-list h3 {
            margin-bottom: 25px;
            color: var(--dark-accent);
            border-bottom: 2px solid var(--primary-color);
            padding-bottom: 10px;
            font-size: 1.8em;
            text-align: center;
            /* Add some padding for full-width content */
            padding-left: 20px;
            padding-right: 20px;
        }

        .post-item {
            background-color: var(--light-green-bg);
            border: 1px solid var(--light-green-border);
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            display: flex;
            flex-direction: column;
            /* Ensure post items are still contained and readable */
            max-width: 800px;
            /* Keep a max-width for readability */
            margin-left: auto;
            /* Center individual post items */
            margin-right: auto;
            /* Center individual post items */
            box-sizing: border-box;
            /* Include padding/border in width */
        }

        .post-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .post-content-wrapper {
            display: flex;
            flex-direction: column;
            gap: 25px;
            margin-bottom: 15px;
        }

        .post-text-content {
            flex: 1;
            min-width: 0;
        }

        .coverimg {
            flex-shrink: 0;
            width: 100%;
            height: 200px;
            background-color: var(--border-color);
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 4px;
            overflow: hidden;
            border: 1px solid var(--border-color);
        }

        .coverimg img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        @media (min-width: 768px) {
            .post-content-wrapper {
                flex-direction: row;
                align-items: flex-start;
            }

            .coverimg {
                width: 250px;
                height: 180px;
                margin-left: 30px;
            }
        }


        .post-item h4 {
            margin-top: 0;
            margin-bottom: 10px;
            font-size: 1.5em;
        }

        .post-item h4 a {
            text-decoration: none;
            color: var(--highlight-color);
            transition: color 0.3s ease;
            font-weight: bold;
        }

        .post-item h4 a:hover {
            color: #E6A700;
            text-decoration: underline;
        }

        .post-item p {
            font-size: 1em;
            color: #555;
            margin-bottom: 15px;
        }

        .post-item .btn {
            display: inline-block;
            padding: 8px 15px;
            background-color: var(--primary-color);
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            font-size: 0.9em;
            margin-top: 5px;
        }

        .post-item .btn:hover {
            background-color: var(--dark-accent);
        }

        .d-flex.justify-content-between {
            align-items: center;
            margin-top: 15px;
        }

        .react-btns {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 0.9em;
            color: #666;
        }

        .react-btns i {
            cursor: pointer;
            transition: color 0.2s ease;
        }

        .react-btns i.like:hover {
            color: var(--primary-color);
        }

        .react-btns i.liked {
            color: var(--highlight-color);
        }

        .react-btns a {
            color: #666;
            text-decoration: none;
            transition: color 0.2s ease;
        }

        .react-btns a:hover {
            color: var(--dark-accent);
        }

        .post-item small {
            display: block;
            text-align: right;
            color: #888;
            margin-top: 15px;
            font-size: 0.85em;
        }

        .no-posts {
            text-align: center;
            color: #777;
            padding: 30px;
            border: 2px dashed var(--primary-color);
            border-radius: 8px;
            font-style: italic;

            max-width: 800px;
            margin: 20px auto;
            box-sizing: border-box;
        }

        .message {
            margin-bottom: 25px;
            padding: 15px;
            border-radius: 8px;
            text-align: center;
            font-weight: bold;
            animation: fadeIn 0.5s ease-out;
            /* Adjust max-width and margin for full-width layout */
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
            box-sizing: border-box;
        }

        .message.success {
            background-color: #E6F3E6;
            color: var(--dark-accent);
            border: 1px solid var(--primary-color);
        }

        .message.error {
            background-color: #FFEFEF;
            color: #D8000C;
            border: 1px solid #FFDCDC;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .post-actions {
            text-align: right;
            margin-top: 15px;
            font-size: 0.9em;
            padding-top: 10px;
            border-top: 1px solid var(--border-color);
        }

        .post-actions a {
            color: var(--primary-color);
            text-decoration: none;
            margin-left: 15px;
            transition: color 0.3s ease;
            font-weight: 500;
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
    <link rel="stylesheet" href="css/richtext.min.css">
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="js/jquery.richtext.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
      <link rel="stylesheet" href="css/navbar_custom.css">
</head>

<body>
    <?php
    include 'inc/NavBar.php';
    include_once "admin/data/Post.php";
    include_once "admin/data/Comment.php";
    ?>
    <div class="container-blog">
        <div class="notifications-section" style="max-width:800px;margin:30px auto 40px;">
            <h3 style="color:var(--primary-color);margin-bottom:15px;">Notifications</h3>
            <?php
            // Fetch notifications for the user
            $notifications = [];
            try {
                $stmt = $conn->prepare("SELECT * FROM notifications WHERE user_id = ? ORDER BY created_at DESC LIMIT 5");
                $stmt->execute([$user_id]);
                $notifications = $stmt->fetchAll();
            } catch (PDOException $e) {
                echo '<div class="message error">Error fetching notifications: ' . htmlspecialchars($e->getMessage()) . '</div>';
            }
            ?>
            <?php if (empty($notifications)): ?>
                <div class="message" style="background:#f8f8f8;">No notifications yet.</div>
            <?php else: ?>
                <ul class="list-group">
                    <?php foreach ($notifications as $note): ?>
                        <li class="list-group-item <?php echo $note['is_read'] ? '' : 'list-group-item-warning'; ?>">
                            <strong><?php echo htmlspecialchars($note['title']); ?></strong><br>
                            <?php echo htmlspecialchars($note['message']); ?><br>
                            <small><?php echo date('F j, Y, g:i a', strtotime($note['created_at'])); ?></small>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <div style="margin-top:10px;text-align:right;"><a href="notifications.php" class="btn btn-outline-primary btn-sm">View All</a></div>
            <?php endif; ?>
        </div>
        <h2>Welcome to Your Dashboard, <?php echo $username; ?>!</h2>

        <?php if (!empty($message)): ?>
            <div class="message <?php echo (strpos($message, 'Error') === false) ? 'success' : 'error'; ?>">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>

        <div class="nav-linkes">
            <a href="create_post.php">Create New Post</a>
            <a href="index.php">View All Posts</a>
            <a href="logout.php">Logout</a>
        </div>

        <div class="post-list">
            <h3>Your Blog Posts:</h3>
            <?php if (empty($user_posts)): ?>
                <p class="no-posts">You haven't published any posts yet. Time to create one!</p>
            <?php else: ?>
                <?php foreach ($user_posts as $post): ?>
                    <div class="post-item">
                        <div class="post-content-wrapper">
                            <div class="post-text-content">
                                <h4><a
                                        href="view_post.php?id=<?php echo $post['post_id']; ?>"><?php echo htmlspecialchars($post['post_title']); ?></a>
                                </h4>
                                <?php
                                $p = strip_tags($post['post_text']);
                                $p = substr($p, 0, 200);
                                ?>
                                <p class="card-text"><?= $p ?>...</p>
                                <a href="blog-view.php?post_id=<?= $post['post_id'] ?>" class="btn btn-primary">Read more</a>
                                <hr>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="react-btns">
                                        <?php
                                        $post_id = $post['post_id'];
                                        if ($logged) {
                                            $liked = isLikedByUserID($conn, $post_id, $user_id);
                                            if ($liked) {
                                                ?>
                                                <i class="fa fa-thumbs-up liked like-btn" post-id="<?= $post_id ?>" liked="1"
                                                    aria-hidden="true"></i>
                                            <?php } else { ?>
                                                <i class="fa fa-thumbs-up like like-btn" post-id="<?= $post_id ?>" liked="0"
                                                    aria-hidden="true"></i>
                                            <?php }
                                        } else { ?>
                                            <i class="fa fa-thumbs-up" aria-hidden="true"></i>
                                        <?php } ?>
                                        Likes (
                                        <span><?php
                                        echo likeCountByPostID($conn, $post['post_id']);
                                        ?></span> )
                                        <a href="blog-view.php?post_id=<?= $post['post_id'] ?>#comments">
                                            <i class="fa fa-comment" aria-hidden="true"></i> Comments (
                                            <?php
                                            echo CountByPostID($conn, $post['post_id']);
                                            ?>
                                            )
                                        </a>
                                    </div>

                                </div>
                            </div>
                            <div class="coverimg">
                                <img src="upload/blog/<?= $post['cover_url'] ?>" alt="Post Cover Image">
                            </div>
                        </div>
                        <small>Posted on: <?php echo date('F j, Y, g:i a', strtotime($post['created_at'])); ?></small>
                        <div class="post-actions">
            <form action="delete.php" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this post?');">
                <input type="hidden" name="post_id" value="<?php echo $post['post_id']; ?>">
                <button type="submit" class="btn btn-danger btn-sm delete-link">Delete</button>
            </form>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
        crossorigin="anonymous"></script>
    <?php
    include 'inc/footer.php';
    ?>
</body>

</html>