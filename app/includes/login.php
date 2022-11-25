<?php
include "db.php";
session_start();

if (isset($_POST['login'])) {
    $submitted_username = $_POST['username'];
    $submitted_user_password = $_POST['user_password'];

    $query = $connection->prepare("SELECT * FROM users WHERE username=?");
    $query->bind_param("s", $submitted_username);
    $query->execute();
    $result = $query->get_result();
    while ($row = mysqli_fetch_assoc($result)) {
        $db_user_id = $row['user_id'];
        $db_username = $row['username'];
        $db_user_password = $row['user_password'];
        $db_user_firstname = $row['user_firstname'];
        $db_user_lastname = $row['user_lastname'];
        $db_user_role = $row['user_role'];
    }
    if ($submitted_username == $db_username && $submitted_user_password == $db_user_password) {
        $_SESSION['username'] = $db_username;
        $_SESSION['user_id'] = $db_user_id;
        $_SESSION['user_firstname'] = $db_user_firstname;
        $_SESSION['user_lastname'] = $db_user_lastname;
        $_SESSION['user_role'] = $db_user_role;
        header("Location: ../admin/index.php");
    } else {
        session_destroy();
        header("Location: ../index.php");
    }
}
