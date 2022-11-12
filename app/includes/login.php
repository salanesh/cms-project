<?php
include "db.php";

if (isset($_POST['login'])) {
    $submitted_username = $_POST['username'];
    $submitted_user_password = $_POST['user_password'];

    $query = $connection->prepare("SELECT * FROM users WHERE username=?");
    $query->bind_param("s", $submitted_username);
    $query->execute();
    $result = $query->get_result();
    if ($result->num_rows === 0) exit("Invalid");
    while ($row = mysqli_fetch_assoc($result)) {
        $db_user_id = $row['user_id'];
        $db_user_password = $row['user_password'];
        $db_user_firstname = $row['user_firstname'];
        $db_user_lastname = $row['user_lastname'];
        $db_user_role = $row['user_role'];
    }
}
