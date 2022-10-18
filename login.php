<?Php
include './connection.php';
include './jwt.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email= $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE `email` = '$email' ";
    $result = mysqli_query($link, $query);
    $row = mysqli_fetch_assoc($result);
            if ($result->num_rows > 0) {
                $hashpassword = $row['password'];
                if (password_verify($password, $hashpassword)) {
                    generateJwt(
                        [
                            'userId' => $row['id'],
                            'fName' => $row['firstName'],
                            'lName' => $row['lastName'],
                            ]
                    );
                } else {
                    echo json_encode(false);
                }
            } else {
                echo json_encode('NO-USER');
            }
} else {
    echo json_encode("UN-AUTHORIZED");
}

