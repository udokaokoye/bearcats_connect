<?php
include './connection.php';
include './jwt.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_GET['continueSignUp']) && $_GET['continueSignUp'] == 'true') {
        $userId = $_POST['userId'];
        $mobile = mysqli_real_escape_string( $link, $_POST['mobile'] ) ; 
        $bio = mysqli_real_escape_string( $link, $_POST['bio'] ) ;
        $major = $_POST['major'];
        $profilePic = null;
        $coverPicture = null;
        $campus = $_POST['campus'];

        if (isset($_FILES['profile_picture'])) {
            $path = 'Images/profile_images' . DIRECTORY_SEPARATOR;
                $file_name = str_replace(' ', '', $_FILES['profile_picture']['name']);
                $file_tmp = $_FILES['profile_picture']['tmp_name'];
                $file_type = $_FILES['profile_picture']['type'];
                $file = $path . "pp_" . $userId . "_" . $file_name;
                if ( move_uploaded_file( $file_tmp, $file ) ) {
                    // $error = false;
                    $profilePic = URLROOT . $file;
                }
        }

        if (isset($_FILES['cover_picture'])) {
            $path = 'Images/cover_images/';
                $file_name = str_replace(' ', '', $_FILES['cover_picture']['name']);
                $file_tmp = $_FILES['cover_picture']['tmp_name'];
                $file_type = $_FILES['cover_picture']['type'];
                $file = $path . "cc_" . $userId . "_" . $file_name;
                if ( move_uploaded_file( $file_tmp, $file ) ) {
                    // $error = false;
                    $coverPicture = URLROOT . $file;
                }
        }

        $query = "UPDATE users SET 
        `mobile` = '$mobile', 
        `bio` = '$bio', 
        `major` = '$major', 
        `cover_picture` = '$coverPicture', 
        `campus` = '$campus', 
        `profile_picture` = '$profilePic' WHERE `id` = '$userId'  ";


        if (mysqli_query($link, $query)) {
            $query = "SELECT * from `users` WHERE `id`= '$userId'";
            $row = mysqli_fetch_assoc(mysqli_query($link, $query));
            $token = generateJwt(
                [
                    'userId' => $row['id'],
                    'fName' => $row['firstName'],
                    'lName' => $row['lastName'],
                    'img' => $row['profile_picture'],
                    'username' => $row['username'],
                    'major' => $row['major']
                    ]
            );
            
            echo json_encode(["UPDATED", $row['id'], $token]);
        } else {
            echo json_encode(["FAILED UPDATING"]);
        }

        return false;
    } else {
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $email  = $_POST['email'];
        $username = $_POST['username'];
        $rawPassword = $_POST['password'];
        $hashedPassword = password_hash($rawPassword, PASSWORD_BCRYPT);
    
        $query = "INSERT INTO `users` (`firstName`, `lastName`, `username`, `email`, `password`) VALUES (
            '".mysqli_real_escape_string( $link, $firstName )."', 
            '".mysqli_real_escape_string( $link, $lastName )."', 
            '".mysqli_real_escape_string( $link, $username )."', 
            '".mysqli_real_escape_string( $link, $email )."', 
            '".mysqli_real_escape_string( $link, $hashedPassword )."'
        )";
    
        if (mysqli_query($link, $query)) {
            $query = "SELECT * from `users` WHERE `email`= '$email'";
            $row = mysqli_fetch_assoc(mysqli_query($link, $query));
            $token = generateJwt(
                [
                    'userId' => $row['id'],
                    'fName' => $row['firstName'],
                    'lName' => $row['lastName'],
                    'img' => $row['profile_picture'],
                    'username' => $row['username'],
                    'major' => $row['major']
                    ]
            );
            
            echo json_encode(["SUCCESS", $row['id'], $token]);
        } else {
            echo json_encode("FAILED");
        }
    }
 


    // ! UPDATE DATABASE WITH OTHER USER INFO (MOBILE NUMBER PROFILE PICTURE AND MAJOR)


 
} else {
    echo json_encode("UN-Authorized");
}