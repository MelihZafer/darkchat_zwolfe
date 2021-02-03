<?php
include("conection.php");
include("functions.php");
session_start();
$sql = "select * from user_request";
$run_sql = mysqli_query($con, $sql);
$get_sql = mysqli_fetch_all($run_sql, MYSQLI_ASSOC);


$user = $_SESSION['username'];
$get_user = "select * from users where username = '$user'";
$run_user = mysqli_query($con, $get_user);
$row = mysqli_fetch_array($run_user);
$user_name = $row['username'];


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Zwolfe</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <!--  -->

    <style>
        * {
            box-sizing: border-box;
        }

        li {
            list-style: none;
        }

        body {
            width: 100%;
            background-color: beige;
        }
    </style>
</head>

<body class="d-flex justify-content-center flex-column w-100">
    <div class="btn-group d-flex justify-content-center w-100" role="group" aria-label="Basic mixed styles example">
        <a href="signup.php"><button type="button" class="btn btn-danger">Sign Up</button></a>
        <a href="login.php"> <button type="button" class="btn btn-warning">Log In </button></a>
        <a href="home.php?user_name=<?php echo $user_name; ?>"> <button type="button" class="btn btn-success">Chat</button></a>
    </div>
    <div id="body" class="container-fluid d-flex justify-content-center">

        <?php foreach ($get_sql as $user) { ?>
            <div class="card" style="width: 20rem; margin: 2rem;">

                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><?php echo htmlspecialchars($user['user_name']); ?></li>
                        <li class="list-group-item"><?php echo htmlspecialchars($user['user_email']); ?></li>
                        <li class="list-group-item"><?php echo htmlspecialchars($user['password']); ?></li>
                        <li class="list-group-item"><?php echo htmlspecialchars($user['status']); ?></li>
                    </ul>

                    <ul>
                        <li value="<?php echo $user['id']; ?>" id="accept" class="btn btn-success">Accept</li>
                        <li value="<?php echo $user['id']; ?>" id="decline" class="btn btn-danger">Decline</li>
                    </ul>

                </div>

            </div>
        <?php } ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- JS -->
    <script>
        $(document).ready(function() {
            $('#accept').click(function() {
                var selectedCard = $(this).val();


                $('#body').load("chekingoperation.php?id=" + selectedCard);
            });
            $('#decline').click(function() {
                var selectedCard = $(this).val();


                $('#body').load("decline.php?id=" + selectedCard);
            });
        });
    </script>
</body>

</html>