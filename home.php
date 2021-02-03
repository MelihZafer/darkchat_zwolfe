<?php session_start();
include("conection.php");
include("functions.php");
$user_data = check_login($con); ?><!doctypehtml>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width,initial-scale=1" name="viewport">
        <title>Darkchat | Zwolfe</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1">
        <link href="style.css" rel="stylesheet">
        <script crossorigin="anonymous" src="https://kit.fontawesome.com/50ab71c35d.js"></script>
    </head>

    <body>
        <nav class="bg-dark menunav navbar navbar-dark navbar-expand-lg sticky-top zindex-sticky">
            <div class="container-fluid"><button class="buttonmenu navbar-toggler" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" data-bs-target="#navbarSupportedContent" data-bs-toggle="collapse" type="button"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="mb-2 mb-lg-0 mx-auto navbar-nav">
                        <li class="nav-item text-center"><a class="nav-link active" type="blank" href="http://zwolfe.epizy.com/index.php#carouselExampleCaptions" aria-current="page">Website</a></li>
                        <li class="nav-item text-center">
                            <h2 class="text-light mx-3">Darkchat</h2>
                        </li>
                        <li class="nav-item text-center dropdown"><a class="nav-link dropdown-toggle" href="#" aria-expanded="false" data-bs-toggle="dropdown" id="navbarDropdown" role="button"><?php echo $user_data['username']; ?></a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="#">Account Setting</a></li>
                                <form action="" method="post">
                                    <li><button class="dropdown-item" name="logout">Log Out</button></li>
                                </form><?php if (isset($_POST['logout'])) {
                                            $update_msg = mysqli_query($con, "UPDATE users SET log_in ='Offline' WHERE username = '$user_name'");
                                            header("Location: logout.php");
                                            exit();
                                        } ?>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container-fluid body">
            <div class="row">
                <div class="text-light bg-dark col-md-2 col-sm-12 left-slidebar px-0">
                    <div class="left-chat my-3">
                        <ul><?php include('get_users_data.php'); ?></ul>
                    </div>
                </div>
                <div class="col-md-10 col-sm-12 right-col">
                    <div class="row right-slidebar text-light"><?php $user = $_SESSION['username'];
                                                                $get_user = "select * from users where username = '$user'";
                                                                $run_user = mysqli_query($con, $get_user);
                                                                $row = mysqli_fetch_array($run_user);
                                                                $user_id = $row['id'];
                                                                $user_name = $row['username']; ?><?php if (isset($_GET['user_name'])) {
                                                                                                        $get_username = $_GET['user_name'];
                                                                                                        $get_user = "select * from users where username = '$get_username'";
                                                                                                        $run_user = mysqli_query($con, $get_user);
                                                                                                        $row_user = mysqli_fetch_array($run_user);
                                                                                                        $username = $row_user['username'];
                                                                                                        $user_profile_pic = $row_user['user_profile'];
                                                                                                    }
                                                                                                    $total_messages = "select * from users_chat where ( sender_username='$user_name' AND receiver_username='$username') OR
                    (receiver_username='$user_name' AND sender_username='$username')";
                                                                                                    $run_messages = mysqli_query($con, $total_messages);
                                                                                                    $run_messages = mysqli_num_rows($run_messages); ?><div class="col-md-12 right-header">
                            <div class="right-header-info"><img alt="" class="pp" src="<?php echo "$user_profile_pic"; ?>">
                                <h3><?php echo "$username"; ?></h3>
                            </div>
                        </div>
                    </div>
                    <div class="row chat" id="chat">
                        <div class="col right-header-contentChat">
                            <ul id="scrolling_to_bottom"><?php $update_msg = mysqli_query($con, "UPDATE users_chat SET msg_status='read' WHERE 
sender_username='$username' AND reciever_username='$user_name'");
                                                            $sel_msg = "select * from users_chat where (sender_username='$user_name' AND receiver_username='$username') OR 
(receiver_username='$user_name' AND sender_username='$username') ORDER by 1 ASC";
                                                            $run_msg = mysqli_query($con, $sel_msg);
                                                            while ($row = mysqli_fetch_array($run_msg)) {
                                                                $sender_username = $row['sender_username'];
                                                                $receiver_username = $row['receiver_username'];
                                                                $msg_content = $row['msg_content'];
                                                                $msg_date = $row['msg_date'];
                                                                if ($user_name == $sender_username && $username == $receiver_username) {
                                                                    echo "
<li>
    <div class='rightside-chat'>
        <span> <small> $msg_date</small>$sender_username </span>
        <p>$msg_content</p>
    </div>
</li>

";
                                                                } else if ($user_name == $receiver_username && $username == $sender_username) {
                                                                    echo "
    <li>
        <div class='leftside-chat'>
            <span> $sender_username <small> $msg_date</small></span>
            <p>$msg_content</p>
        </div>
    </li>
    
    ";
                                                                }
                                                            } ?></ul>
                        </div>
                    </div>
                    <div class="row inputtext">
                        <div class="col-md-12 right-chat-textbox"><input autocomplete="off" id="msg_content" name="msg_content" placeholder="Write your message.."> <button class="text-light btn-dark" name="submit" id="but" value="<?php echo $username; ?>">Send</button></div>
                    </div>
                </div>
            </div>
        </div>
        <script crossorigin="anonymous" src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW"></script>
        <script crossorigin="anonymous" src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="></script>
        <script>
            $(document).ready(function() {
                alert('Its still demo version ( DONT USE COMMAS-","!! ).');
                $("#msg_content").keypress(function(t) {
                    if (13 === t.keyCode) {
                        var a = $("#msg_content").val();
                        a = a.replace(/\s/g, "`");
                        var o = [$("#but").val(), a];
                        $("#scrolling_to_bottom").load("chat.php?array=" + o), $("#msg_content").val("")
                    }
                }), $("#but").click(function() {
                    var t = $("#msg_content").val();
                    t = t.replace(/\s/g, "`");
                    var a = [$("#but").val(), t];
                    $("#scrolling_to_bottom").load("chat.php?array=" + a), $("#msg_content").val("")
                }), setInterval(function() {
                    var t = [$("#but").val(), ""];
                    $("#scrolling_to_bottom").load("chat.php?array=" + t)
                }, 2000)

            })
        </script>
    </body>

    </html>