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
        $query = "SELECT posts.id, posts.user_id, users.firstName, users.lastName, users.profile_picture, users.username, `caption`, `location`, `type`, `createdDate`, `media_url`, `orientation`, `comment`, `reply_id`, `dateCreated` FROM `posts` LEFT JOIN post_media ON posts.id=post_media.post_id LEFT JOIN users ON posts.user_id=users.id LEFT JOIN comments ON posts.id=comments.post_id WHERE posts.id = '$postId'";
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
                'username' => $row['username'],
                'date' => $row['createdDate'],
                // ! LATER WE WILL INCLUDE THE NUMBER OF COMMENTS ON THE POST AND THE LATEST COMMENT.
            ]);
        }

        $query = "SELECT * FROM comments LEFT JOIN users on comments.user_id=users.id WHERE `post_id`=$postId";
        $result = mysqli_query($link, $query);
        $comments = [];
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($comments, [

                'comment' => $row['comment'],
                'reply_id' => $row['reply_id'],
                'firstName' => $row['firstName'],
                'lastName' => $row['lastName'],
                'username' => $row['username'],
                'date' => $row['dateCreated'],
                
                ]);
        }

        $query = "SELECT 'firstName', 'lastName', 'username' FROM reactions LEFT JOIN users on reactions.user_id=users.id WHERE `post_id`=$postId";
        $result = mysqli_query($link, $query);
        $reactions = [];
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($reactions, [
                'firstName' => $row['firstName'],
                'lastName' => $row['lastName'],
                'username' => $row['username'],
                ]);
        }

        echo json_encode([
            'post' => $usersFeed[0],
            'comments' => [
                'comment' => $comments,
                'commentCount' => count($comments)
            ],
            'reactions' => [
                'count' => count($reactions),
                'data' => $reactions
            ]
        ]);
    }
} else {
    
    // echo json_encode("Hey");
}
