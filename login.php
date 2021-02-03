<?php

session_start();
include("conection.php");
include("functions.php");


$error = '';
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    //something was posted
    $username = $_POST['username'];
    $password = $_POST['password'];
    $salt = "chat";
    $hash_password = sha1($password . $salt);
    if (!empty($username) && !empty($password) && !is_numeric($username)) {

        //read from database
        $query = "select * from users where username = '$username'";
        $result = mysqli_query($con, $query);


        if ($result && mysqli_num_rows($result) > 0) {

            $user_data = mysqli_fetch_assoc($result);

            if ($user_data['password'] === $hash_password) {

                echo "<script>console.log('it works'); </script>";
                $_SESSION['username'] = $user_data['username'];
                $username_ = $user_data['username'];
                if ($user_data['status'] == 0) {
                    $update_msg = mysqli_query($con, "UPDATE users SET log_in ='Online' WHERE username = '$username'");
                    header("Location: home.php?user_name=$username_");
                    die;
                } else {
                    $update_msg = mysqli_query($con, "UPDATE users SET log_in ='Online' WHERE username = '$username'");
                    header("Location: index.php");
                    die;
                }
            }
        }


        $error = "Wrong username or password!";
    } else {
        $error = "Wrong username or password!";
    }
}

?>


<!DOCTYPE html>
<html>

<head>
    <title>Login | Zwolfe</title>
    <link rel="shortcut icon" href="img/logo.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
</head>

<body>


    <div class="container-fluid  bg-dark d-flex justify-content-center align-items-center vh-100 flex-column">
        <form method="post">
            <div class="box text-dark d-flex justify-content-center align-items-center flex-column">
                <h1 class="my-3 text-light d-flex fles-column text-decoration-none">DarkChat </h1>
                <input type="text" name="username" class="form-control my-2" id="staticUser" placeholder="Type an username" required>

                <input type="password" name="password" class="form-control my-2" id="inputPassword" placeholder="Type a password" required>
                <div class="text-danger">
                    <?php echo $error; ?>
                </div>
                <input type="submit" class="btn btn-light mt-4 " value="Login">
                <a href="signup.php" class="mt-2 text-light">Create an account</a>
        </form>
    </div>
    </div>
</body>

</html>