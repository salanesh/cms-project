<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Make Admin</th>
            <th>Make Sub</th>
            <th>Edit</th>
            <th>Delete</th>

        </tr>
    </thead>
    <tbody>
        <?php
        $stmt = $connection->prepare("SELECT user_id, username, user_firstname, user_lastname, user_email, user_image, user_role FROM users");
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            $user_id = $row["user_id"];
            $username = $row["username"];
            $user_firstname = $row["user_firstname"];
            $user_lastname = $row["user_lastname"];
            $user_email = $row["user_email"];
            $user_role = $row["user_role"];
            // $comment_response = "<a href='../post.php?p_id={$username}'>$post_title</a>";

            echo "<tr>";
            echo "<td>{$user_id}</td>";
            echo "<td>{$username}</td>";
            echo "<td>{$user_firstname}</td>";
            echo "<td>{$user_lastname}</td>";
            echo "<td>{$user_email}</td>";
            echo "<td>{$user_role}</td>";
            echo "<td><a href='users.php?approve={$user_id}'>Admin</a></td>";
            echo "<td><a href='users.php?unapprove={$user_id}'>Subscriber</a></td>";
            echo "<td><a href='users.php?source=edit_user&user_id={$user_id}'>Edit</a></td>";
            echo "<td><a href='users.php?delete={$user_id}'>Delete</a></td>";
            echo "</tr>";
        }
        $stmt->close();
        ?>
    </tbody>
</table>
<?php
if (isset($_GET['approve'])) {
    $query = "UPDATE users set user_role='admin' WHERE user_id = {$_GET['approve']}";
    mysqli_query($connection, $query);
    header("Location: users.php");
}
if (isset($_GET['unapprove'])) {
    $query = "UPDATE users set user_role='subscriber' WHERE user_id = {$_GET['unapprove']}";
    mysqli_query($connection, $query);
    header("Location: users.php");
}
if (isset($_GET['delete'])) {
    $delete_user_id = $_GET['delete'];
    $stmt = $connection->prepare("DELETE FROM users WHERE user_id=?");
    $stmt->bind_param("i", $delete_user_id);
    $stmt->execute();
    $stmt->close();
    header("Location: users.php");
}
?>