<?php
include './connection.php';
require_once('./verifyToken.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    verifyToken();
    // ! NOTE: In this code $usersFeed is used for every response even if we are returning just one post.

    if (isset($_GET['userId'])) {
        $userId = $_GET['userId'];
        // !To GET EVERYTING WITH THE MEDIA 
        $query = "SELECT posts.id, posts.user_id, users.firstName, users.lastName, users.profile_picture, users.username, `caption`, `location`, `type`, `createdDate`, `media_url`, `orientation` FROM `posts` INNER JOIN post_media ON posts.id=post_media.post_id INNER JOIN users ON posts.user_id=users.id WHERE posts.user_id = '$userId' ORDER BY posts.id DESC";
        $result = mysqli_query($link, $query);
        $usersFeed = [];
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($usersFeed, [
                'id' => $row['id'],
                'user_id' => $row['user_id'],
                'caption' => $row['caption'],
                'location' => $row['location'],
                'type' => $row['type'],
                'createdDate' => $row['createdDate'],
                'images' => unserialize($row['media_url']),
                'orientation' => unserialize($row['orientation']),
                'fName' => $row['firstName'],
                'lName' => $row['lastName'],
                'profile_picture' => $row['profile_picture'],
                'username' => $row['username']
                // 'comment' => $row['comments']
                // ! LATER WE WILL INCLUDE THE NUMBER OF COMMENTS ON THE POST AND THE LATEST COMMENT.
            ]);
        }

        echo json_encode($usersFeed);
    }


    if (isset($_GET['postId'])) {
        $postId = $_GET['postId'];
        // !To GET EVERYTING WITH THE MEDIA 
        $query = "SELECT posts.id, posts.user_id, users.firstName, users.lastName, users.profile_picture, users.username, `caption`, `location`, `type`, `createdDate`, `media_url`, `orientation` FROM `posts` INNER JOIN post_media ON posts.id=post_media.post_id INNER JOIN users ON posts.user_id=users.id WHERE posts.id = '$postId'";
        $result = mysqli_query($link, $query);
        $usersFeed = [];
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($usersFeed, [
                'id' => $row['id'],
                'user_id' => $row['user_id'],
                'caption' => $row['caption'],
                'location' => $row['location'],
                'type' => $row['type'],
                'createdDate' => $row['createdDate'],
                'images' => unserialize($row['media_url']),
                'orientation' => unserialize($row['orientation']),
                'fName' => $row['firstName'],
                'lName' => $row['lastName'],
                'profile_picture' => $row['profile_picture'],
                'username' => $row['username']
                // 'comment' => $row['comments']
                // ! LATER WE WILL INCLUDE THE NUMBER OF COMMENTS ON THE POST AND THE LATEST COMMENT.
            ]);
        }

        echo json_encode($usersFeed);
    }
} else {
    header('HTTP/1.0 500 Forbbiden Request');
    echo 'Forbbiden';
    exit; 
}
