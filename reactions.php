<?php
include './connection.php';
// require_once('./verifyToken.php');
// verifyToken();

$postId = $_POST['postId'];
$userId = $_POST['userId'];
if (isset($_GET['unlike'])) {
    if ($_GET['unlike'] == 'true') {
       $unlikeQuery = "DELETE FROM `reactions` WHERE `user_id`='$userId' AND `post_id`='$postId'";
       if (mysqli_query($link, $unlikeQuery)) {
        echo json_encode("UNLIKED");
       }
    }
} else {
    $query = "INSERT INTO `reactions` (`post_id`, `user_id`) VALUES (
        '" . mysqli_real_escape_string($link, $postId) . "', 
        '" . mysqli_real_escape_string($link, $userId) . "'
    )";
    
    if (mysqli_query($link, $query)) {
        echo json_encode("LIKED!");
    } else {
        echo json_encode("An Error Occured");
    }
}

