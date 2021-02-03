<?php
                if (isset($_GET['user_name'])) {


                    $get_username = $_GET['user_name'];
                    $get_user = "select * from users where username = '$get_username'";

                    $run_user = mysqli_query($con, $get_user);

                    $row_user = mysqli_fetch_array($run_user);

                    $username = $row_user['username'];
                    $user_profile_pic = $row_user['user_profile'];
                }
