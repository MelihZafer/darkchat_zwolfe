<?php
include("conection.php");



$error = '';
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    //something was posted
    $username = $_POST['user_name'];
    $user_email = $_POST['user_email'];
    $password = $_POST['password'];
    $pass_conf = $_POST['pass_conf'];
    $status = $_POST['status'];
    if (!empty($username) && !empty($password) && !empty($user_email) && !empty($pass_conf) && !is_numeric($username)) {

        if ($password == $pass_conf) {
            echo "<script> console.log('It works'); </script>";
            $salt = "chat";
            $hash_password = sha1($password . $salt);
            $sql = "insert into user_request(user_name, user_email, password, status) values('$username', '$user_email', '$hash_password', '$status')";
            $run = mysqli_query($con, $sql);
        } else {
            $error = "Wrong username or password!";
        }
    } else {
        $error = "Wrong username or password!";
    }
}

?>


<!DOCTYPE html>
<html>

<head>
    <title>Sign Up | Zwolfe</title>
    <link rel="shortcut icon" href="img/logo.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
</head>

<body>


    <div class="container-fluid  bg-dark d-flex justify-content-center align-items-center vh-100 flex-column">
        <form method="post" class="w-25">
            <div class="box text-dark d-flex justify-content-center align-items-center flex-column">
                <h1 class="my-3 text-light d-flex fles-column text-decoration-none">DarkChat </h1>
                <input type="text" name="user_name" class="form-control my-2" id="staticUser" placeholder="Type an username" required>
                <input type="email" name="user_email" class="form-control my-2" id="staticUser" placeholder="Type a valid email" required>

                <input type="password" name="password" class="form-control my-2" id="inputPassword" placeholder="Type a password" required>
                <input type="password" name="pass_conf" class="form-control my-2" id="inputPassword" placeholder="Type a password" required>
                <select class="btn-light w-100 m-1 p-1  " name="status" id="">
                    <option selected disabled>Open this select menu</option>
                    <option value="0">User</option>
                    <option value="1">Admin</option>
                </select>
                <div class="text-danger">
                    <?php echo $error; ?>
                </div>
                <input type="submit" class="btn btn-light mt-4 " value="Sign Up">
                <a href="login.php" class="mt-2 text-light">Log in</a>
        </form>
    </div>
    </div>
</body>

</html>