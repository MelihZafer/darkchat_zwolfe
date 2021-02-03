<?php

function check_login($con)
{

    if (isset($_SESSION['username'])) {

        $user_name = $_SESSION['username'];
        $query = "select * from users where username = '$user_name'";

        $result = mysqli_query($con, $query);
        if ($result && mysqli_num_rows($result) > 0) {

            $user_data = mysqli_fetch_assoc($result);
            return $user_data;
        }
    }

    //redirect to login
    header("Location: login.php");
    die;
}
function check_admin($conn)
{

    if (isset($_SESSION['username'])) {

        $user_name = $_SESSION['username'];
        $query = "select * from users where username = '$user_name'";

        $result = mysqli_query($conn, $query);
        if ($result && mysqli_num_rows($result) > 0) {

            $user_data = mysqli_fetch_assoc($result);
            return $user_data;
        }
    }

    //redirect to login
    header("Location: login.php");
    die;
}
