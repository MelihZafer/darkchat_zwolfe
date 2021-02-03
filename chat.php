<?php
session_start();
include("conection.php");
include("functions.php");

$user_data = check_login($con);
?>
<?php

$user = $_SESSION['username'];
$get_user = "select * from users where username = '$user'";
$run_user = mysqli_query($con, $get_user);
$row = mysqli_fetch_array($run_user);

$user_id = $row['id'];
$user_name = $row['username'];




$array = $_GET['array'];
$explode =  explode(',', $array);
$msg = str_replace('`', " ", $explode[1]);



$get_username = $explode[0];
$get_user = "select * from users where username = '$get_username'";

$run_user = mysqli_query($con, $get_user);

$row_user = mysqli_fetch_array($run_user);

$username = $row_user['username'];



if (strlen($msg) < 52 && $msg != '') {
    $insert = "insert into users_chat(sender_username, receiver_username, msg_content, msg_status, msg_date)
    values ('$user_name', '$username', '$msg', 'unread', NOW())";
    $run_insert = mysqli_query($con, $insert);
} else if (strlen($msg) > 52) {
    echo "<script> alert('The message has not to be too long. Max: 50 ch!!!')</script>";
}

$update_msg = mysqli_query($con, "UPDATE users_chat SET msg_status='read' WHERE 
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
}
?>