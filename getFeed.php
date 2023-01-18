<?php
include './connection.php';
require_once('./verifyToken.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    verifyToken();

    // !To GET EVERYTING WITH THE MEDIA 
    if (isset($_GET['portion']) && $_GET['portion'] == 'following') {
        $userId = $_GET['userId'];
        $query = "SELECT `followed_user_id` FROM `followers` WHERE `following_user_id` = '$userId'";
        $data = [];
        $result = mysqli_query($link, $query);

        while ($row = mysqli_fetch_assoc($result)) {
            foreach ($row as $key => $value) {

                array_push($data, $value);
            }
        }
        $following = implode("', '", $data);

        $query = "SELECT posts.id, posts.user_id, users.firstName, users.lastName, users.profile_picture, users.username, `caption`, `location`, `type`, `createdDate`, `media_url`, `orientation` FROM `posts` LEFT JOIN post_media ON posts.id=post_media.post_id LEFT JOIN users ON posts.user_id=users.id WHERE posts.user_id IN ('" . $following . "') ORDER BY posts.id DESC";
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
    } else {
        $query = "SELECT posts.id, posts.user_id, users.firstName, users.lastName, users.profile_picture, users.username, `caption`, `location`, `type`, `createdDate`, `media_url`, `orientation` FROM `posts` LEFT JOIN post_media ON posts.id=post_media.post_id LEFT JOIN users ON posts.user_id=users.id ORDER BY posts.id DESC";
        $result = mysqli_query($link, $query);
        $usersFeed = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $id = $row['id'];
            $comment = [];
            $commentQuery = $query = "SELECT `comment`, `reply_id`, `firstName`, `lastName`, `username`, `profile_picture`, `dateCreated`,`post_id`, comments.id AS commentID, users.id AS UserId FROM comments LEFT JOIN users on comments.user_id=users.id WHERE `post_id`=$id";
            $commentQueryResult = mysqli_query($link, $commentQuery);

            while ($commentRow = mysqli_fetch_assoc($commentQueryResult)) {
                array_push($comment, [
                    'id' => $commentRow['commentID'],
                'comment' => $commentRow['comment'],
                'reply_id' => $commentRow['reply_id'],
                'firstName' => $commentRow['firstName'],
                'lastName' => $commentRow['lastName'],
                'username' => $commentRow['username'],
                'UserId' => $commentRow['UserId'],
                'profile_picture' => $commentRow['profile_picture'],
                'date' => $commentRow['dateCreated'],
                'post_id' => $commentRow['post_id']
                ]);
            }

            $reactionquery = "SELECT `firstName`, `user_id`, `lastName`, `username` FROM reactions LEFT JOIN users on reactions.user_id=users.id WHERE `post_id`=$id";
            $reactionresult = mysqli_query($link, $reactionquery);
            $reactions = [];
            while ($reactionrow = mysqli_fetch_assoc($reactionresult)) {
                array_push($reactions, [
                    'firstName' => $reactionrow['firstName'],
                    'lastName' => $reactionrow['lastName'],
                    'username' => $reactionrow['username'],
                    'userId' => $reactionrow['user_id']
                    ]);
            }

                    // !SELECTING THE TAGGED USERS ON THAT POST
                $tagUserQuery = "SELECT `firstName`, `lastName`, `username`, `tagged_userid` FROM postTags LEFT JOIN users on postTags.tagged_userid=users.id WHERE `post_id`=$id";
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

            array_push(
                $usersFeed,
                [
                    'post' => [
                        'id' => $id,
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
                        // 'commentMain' => $comment
                        // ! LATER WE WILL INCLUDE THE NUMBER OF COMMENTS ON THE POST AND THE LATEST COMMENT.
                    ],

                    'comments' => [
                        'comments' => $comment,
                        'count' => count($comment)
                    ], 
                    'reactions' => [
                        'count' => count($reactions),
                        'data' => $reactions
                    ],
                    'tags' => $tags
                ]
            );
        }

        echo json_encode($usersFeed);

        // ! SELECT ONLY THE IDs THEN DO A FOR EACH LOOP THROUGH ALL THE IDs AND RUN A QUERY LIKE THE ONE IN GET POST


        // $query = "SELECT 'firstName', 'lastName', 'username' FROM reactions LEFT JOIN users on reactions.user_id=users.id WHERE `post_id`=$postId";
        // $result = mysqli_query($link, $query);
        // $reactions = [];
        // while ($row = mysqli_fetch_assoc($result)) {
        //     array_push($reactions, [
        //         'firstName' => $row['firstName'],
        //         'lastName' => $row['lastName'],
        //         'username' => $row['username'],
        //         ]);
        // } 
    }
} else {
}
