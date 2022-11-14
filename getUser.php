<?php
include './connection.php';
require_once('./verifyToken.php');

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    verifyToken();
    $userId = $_GET['userId'];
    $user;

    $query = "SELECT * FROM `users` WHERE `id` = '$userId'";
    $result = mysqli_query($link, $query);
    if ($result->num_rows > 0) {
        $row = mysqli_fetch_assoc($result);
        // ! Getting all the users followers
        $query = "SELECT `following_user_id` FROM followers WHERE `followed_user_id`='$userId'";
        $followersResult = mysqli_query($link, $query);
        $followersCount =  !empty($followersResult) ? $followersResult->num_rows :  0;
        $followers= [];
        while ($followerRow = mysqli_fetch_assoc($followersResult)) {
            array_push($followers, $followerRow['following_user_id']);
        }
        
        // !Getting all acounts the user is following
        $query = "SELECT `followed_user_id` FROM followers WHERE `following_user_id`='$userId'";
        $followingResult = mysqli_query($link, $query);
        $followingCount = !empty($followingResult) ? $followingResult->num_rows :  0;
        $following = [];
        while ($followingRow = mysqli_fetch_assoc($followingResult)) {
            array_push($following, $followingRow['followed_user_id']);
        }
        // !REFINE THIS (DO NOT SEND PASSWORD WITH OTHER DATA)
        $user = [
            'id' => $row['id'],
            'firstName' => $row['firstName'],
            'lastName' => $row['lastName'],
            'username' => $row['username'],
            'profile_picture' => $row['profile_picture'],
            'cover_picture' => $row['cover_picture'],
            'mobile' => $row['mobile'],
            'email' => $row['email'],
            'registerdAt' => $row['registerdAt'],
            'bio' => $row['bio'],
            'major' => $row['major'],
            'campus' => $row['campus'],
            'followers' => [
                'followers' => $followers,
                'count' => $followersCount
            ],
            'following' => [
                'following' => $following,
                'count' => $followingCount
            ],
        ];
        echo json_encode($user);
    } else {
        echo json_encode("USER NOT FOUND");
    }
} else {
    echo json_encode("UN_AUTHORIZED");
}