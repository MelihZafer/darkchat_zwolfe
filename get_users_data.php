<?php
$con = mysqli_connect("localhost", "root", "", "chat");
$users = "select * from users";
$run_users = mysqli_query($con, $users);

while ($row_users = mysqli_fetch_array($run_users)) {

    $user_id = $row_users['id'];
    $user_name = $row_users['username'];
    $user_profile = $row_users['user_profile'];
    $login = $row_users['log_in'];
    if ($login == 'Offline') {
        $login = '<i class="text-success far fa-circle"></i>';
    } else if ($login == 'Online') {
        $login = '<i class=" text-success fas fa-circle"></i>';
    }

    echo "
        <li>
            <div class='chat-left'>
                <img class='pp1' src='$user_profile'>
                <p class='my-0'> <a class='online ms-1' value='$user_name' href='home.php?user_name=$user_name'>$user_name</a></p> <div class='status'>$login</div>
            </div>
                </li>
            ";
}
