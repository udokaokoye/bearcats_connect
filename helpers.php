<?php
include './connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_GET['helper'])) {
        $helper = $_GET['helper'];
        if ($helper == 'checkUniqueUsername') {
            $username = $_POST['username'];
            $query = "SELECT `username` FROM `users` WHERE `username` = '$username'";
            $result = mysqli_query($link, $query);
            if ($result->num_rows == 0) {
                echo json_encode('No User Found');
            }else {
                echo json_encode('User Found');
            }
        }
        
    } else {
        echo json_encode("Select Helper");
    }

} else {
    echo json_encode('UN-AUTHORIZED');
}
 