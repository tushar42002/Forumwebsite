<?php
    
    $showError ="false";

    if ($_SERVER["REQUEST_METHOD"]=="POST") {
        include "dbconnect.php";
        $user_name = $_POST['signupName'];
        $user_mobile = $_POST['signupMobile'];
        $user_email = $_POST['signupEmail'];
        $user_password = $_POST['signupPassword'];
        $user_cpassword = $_POST['signupcPassword'];                            
        

        $existSql = "SELECT*FROM`users`WHERE user_email='$user_email'";
        $result = mysqli_query($conn, $existSql);
        $numRows = mysqli_num_rows($result);

        if ($numRows>0) {
            $showError = "email alredy in use";
        }else {
            if ($user_password == $user_cpassword) {
                $hash = password_hash($user_password, PASSWORD_DEFAULT);

                $sql = "INSERT INTO `users` ( `user_name`, `user_mobile`, `user_email`, `user_password`, `user_signup_time`) VALUES ( '$user_name', '$user_mobile', '$user_email', '$hash', current_timestamp())"; 
                $result = mysqli_query($conn, $sql);
                if ($result) {
                    $showAlert=true; 
                    header("location:/forum/index.php?signupsuccess=true");
                    exit();
                }
            }else {
                $showError = "passwords does not match";
            }
        }
        header("location:/forum/index.php?signupsuccess=false&error=$showError");

    }



?>