<?php
include './connection.php';
require_once('./verifyToken.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    verifyToken();
    // ! NOTE: In this code $usersFeed is used for every response even if we are returning just one post.

    if (isset($_GET['userId'])) {
        $userId = $_GET['userId'];
        // !To GET EVERYTING WITH THE MEDIA 
        $query = "SELECT posts.id, posts.user_id, users.firstName, users.lastName, users.profile_picture, users.username, `caption`, `location`, `type`, `createdDate`, `media_url`, `orientation` FROM `posts` LEFT JOIN post_media ON posts.id=post_media.post_id LEFT JOIN users ON posts.user_id=users.id WHERE posts.user_id = '$userId' ORDER BY posts.id DESC";
        $result = mysqli_query($link, $query);
        $usersFeed = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $postId = $row['id'];

            $commentQuery = "SELECT `comment`, `reply_id`, `firstName`, `lastName`, `username`, `profile_picture`, `dateCreated`, `post_id`, comments.id AS commentID FROM comments LEFT JOIN users on comments.user_id=users.id WHERE `post_id`=$postId";
            $commentResult = mysqli_query($link, $commentQuery);
            $comments = [];
            while ($commentRow = mysqli_fetch_assoc($commentResult)) {
                array_push($comments, [
                    'id' => $commentRow['commentID'],
                    'comment' => $commentRow['comment'],
                    'reply_id' => $commentRow['reply_id'],
                    'firstName' => $commentRow['firstName'],
                    'lastName' => $commentRow['lastName'],
                    'username' => $commentRow['username'],
                    'profile_picture' => $commentRow['profile_picture'],
                    'date' => $commentRow['dateCreated'],
                    'post_id' => $commentRow['post_id']
                    
                    ]);
            }

        // !SELCTING ALL THE REACTION FOR THAT POST

        $reactionsQuery = "SELECT 'firstName', 'lastName', 'username' FROM reactions LEFT JOIN users on reactions.user_id=users.id WHERE `post_id`=$postId";
        $reactionsResult = mysqli_query($link, $reactionsQuery);
        $reactions = [];
        while ($reactionsRow = mysqli_fetch_assoc($reactionsResult)) {
            array_push($reactions, [
                'firstName' => $reactionsRow['firstName'],
                'lastName' => $reactionsRow['lastName'],
                'username' => $reactionsRow['username'],
                ]);
        }

        // !SELECTING THE TAGGED USERS ON THAT POST
        $tagUserQuery = "SELECT `firstName`, `lastName`, `username`, `tagged_userid` FROM postTags LEFT JOIN users on postTags.tagged_userid=users.id WHERE `post_id`=$postId";
                $tagUserResult = mysqli_query($link, $tagUserQuery);
                $tags = [];
                while ($taguserRow = mysqli_fetch_assoc($tagUserResult)) {
                    array_push($tags, [
                        'firstName' => $taguserRow['firstName'],
                        'lastName' => $taguserRow['lastName'],
                        'username' => $taguserRow['username'],
                        'tagged_userid' => $taguserRow['tagged_userid']
                        ]);
                }


            array_push($usersFeed, [
                'post' => [ 
                'id' => $postId,
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
                ],
                'comments' => [
                    'comments' => $comments,
                    'count' => count($comments)
                ],
                'reactions' => [
                    'count' => count($reactions),
                    'data' => $reactions
                ],
                'tags' => $tags
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

        // !SELECTING ALL THE COMMETNS FOR THAT POST

        $query = "SELECT `comment`, `reply_id`, `firstName`, `lastName`, `username`, `profile_picture`, `dateCreated`, `post_id`, comments.id AS commentID FROM comments LEFT JOIN users on comments.user_id=users.id WHERE `post_id`=$postId ORDER BY comments.id DESC";
        $result = mysqli_query($link, $query);
        $comments = [];
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($comments, [
                'id' => $row['commentID'],
                'comment' => $row['comment'],
                'reply_id' => $row['reply_id'],
                'firstName' => $row['firstName'],
                'lastName' => $row['lastName'],
                'username' => $row['username'],
                'profile_picture' => $row['profile_picture'],
                'date' => $row['dateCreated'],
                'post_id' => $row['post_id']
                
                ]);
        }

        // !SELCTING ALL THE REACTION FOR THAT POST

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

        // !SELECTING THE TAGGED USERS ON THAT POST
        $tagUserQuery = "SELECT `firstName`, `lastName`, `username`, `tagged_userid` FROM postTags LEFT JOIN users on postTags.tagged_userid=users.id WHERE `post_id`=$postId";
                $tagUserResult = mysqli_query($link, $tagUserQuery);
                $tags = [];
                while ($taguserRow = mysqli_fetch_assoc($tagUserResult)) {
                    array_push($tags, [
                        'firstName' => $taguserRow['firstName'],
                        'lastName' => $taguserRow['lastName'],
                        'username' => $taguserRow['username'],
                        'tagged_userid' => $taguserRow['tagged_userid']
                        ]);
                }

        echo json_encode([
            'post' => $usersFeed[0],
            'comments' => [
                'comments' => $comments,
                'count' => count($comments)
            ],
            'reactions' => [
                'count' => count($reactions),
                'data' => $reactions
            ],
            'tags' => $tags
        ]);
    }
} else {
    
    // echo json_encode("Hey");
}
