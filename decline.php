<?php
session_start();
include('conection.php');
if (isset($_GET['id'])) {

    $sql3 = "delete from user_request where id=" . $_GET['id'];
    mysqli_query($con, $sql3);
}
?>

<?php

$sql1 = "select * from user_request";
$run_sql1 = mysqli_query($con, $sql1);
$get_sql1 = mysqli_fetch_all($run_sql1, MYSQLI_ASSOC);

foreach ($get_sql1 as $user) { ?>
    <div class="card" style="width: 20rem; margin: 2rem;">

        <div class="card-body">
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><?php echo htmlspecialchars($user['user_name']); ?></li>
                <li class="list-group-item"><?php echo htmlspecialchars($user['user_email']); ?></li>
                <li class="list-group-item"><?php echo htmlspecialchars($user['password']); ?></li>
            </ul>

            <ul>
                <li value="<?php echo $user['id']; ?>" id="accept" class="btn btn-success">Accept</li>
                <li value="<?php echo $user['id']; ?>" id="decline" class="btn btn-danger">Decline</li>
            </ul>

        </div>
    <?php } ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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