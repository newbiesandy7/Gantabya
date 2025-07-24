<?php
session_start(); // Start the session at the very beginning of the script

if (isset($_SESSION['user_id']) && isset($_SESSION['username'])) {

    if(isset($_POST['title']) &&
       isset($_FILES['cover']) &&
       isset($_POST['category']) &&
       isset($_POST['text'])){
        include "../../db_conn.php";
        $title = $_POST['title'];
        $text = $_POST['text'];
        $category = $_POST['category'];
        $user_id = $_SESSION['user_id'];

        if(empty($title)){
           $em = "Title is required";
           header("Location:create_post.php?error=$em");
           exit;
        }else if(empty($text)){ // Corrected: This was 'title' again, changed to 'text'
           $em = "Text content is required";
           header("Location: create_post.php?error=$em");
           exit;
        }else if(empty($category)){
          $category = 0; // Or handle as an error if category is mandatory
        }

        $image_name = $_FILES['cover']['name'];
        $post_successful = false; // Flag to track post creation success

        if($image_name != ""){
           $image_size = $_FILES['cover']['size'];
           $image_temp = $_FILES['cover']['tmp_name'];
           $error = $_FILES['cover']['error'];
           if ($error === 0) {
                if ($image_size > 230000) {
                    $em = "Sorry, your file is too large.";
                    header("Location: create_post.php?error=$em");
                    exit;
                }else {
                  $image_ex = pathinfo($image_name, PATHINFO_EXTENSION);
                  $image_ex = strtolower($image_ex);

                  $allowed_exs = array('jpg', 'jpeg', 'png');

                  if (in_array($image_ex, $allowed_exs )) {
                      $new_image_name = uniqid("COVER-", true).'.'.$image_ex;
                      $image_path = '../../upload/blog/'.$new_image_name;
                      move_uploaded_file($image_temp, $image_path);

                      $sql = "INSERT INTO post(user_id,post_title, post_text,category_id, cover_url) VALUES (?,?,?,?,?)";
                      $stmt = $conn->prepare($sql);
                      $res = $stmt->execute([$user_id, $title, $text, $category, $new_image_name]);
                      if ($res) {
                          $post_successful = true; // Set success flag
                      }
                  }else {
                    $em = "You can't upload files of this type";
                    header("Location: create_post.php?error=$em");
                    exit;
                  }
                }
           }

        }else {
             $sql = "INSERT INTO post(user_id,post_title, post_text, category_id) VALUES (?,?,?,?)"; // Corrected column name
             $stmt = $conn->prepare($sql);
             $res = $stmt->execute([$user_id, $title, $text, $category]);
             if ($res) {
                 $post_successful = true; // Set success flag
             }
        }

        // Check the success flag and set session variable
        if ($post_successful) {
            $_SESSION['post_created_success'] = true; // Set session variable
            header("Location:blog.php"); // Redirect to blog.php
            exit;
        }else {
          $em = "Unknown error occurred";
          header("Location:create_post.php?error=$em");
          exit;
        }


    }else {
        header("Location:create_post.php");
        exit;
    }


}else {
    header("Location:login.php");
    exit;
}
