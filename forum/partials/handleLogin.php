<?php
    
    $showError ="false";

    if ($_SERVER["REQUEST_METHOD"]=="POST") {
        include "dbconnect.php";

        $email = $_POST['loginEmail'];
        $password = $_POST['loginPassword'];

        $sql = "SELECT*FROM `users` WHERE user_email='$email'";
        $result = mysqli_query($conn, $sql);

        $numRows = mysqli_num_rows($result);
        if ($numRows == 1) {
            $row = mysqli_fetch_assoc($result);
            if(password_verify($password, $row['user_password'])) {
                 session_start();
                 $_SESSION['loggedin'] = true;
                 $_SESSION['sno'] = $row['sno'];
                 $_SESSION['user'] = $row['user_name'];

                header("location: /forum/index.php");

            }else {
                echo'unable to login'; 
            }
        }else {
            echo'user does not exist';
        }

    }    

?>