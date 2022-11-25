<?php
if (isset($_POST['create_user'])) {
    $username = $_POST['username'];
    $user_password = $_POST['user_password'];
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_role = $_POST['user_role'];
    $random_salt = "placeholder";

    $user_image = $_FILES['user_image']['name'];
    // $user_image = "placeholder";
    $user_image_temp = $_FILES['user_image']['tmp_name'];

    $user_email = $_POST['user_email'];
    // $user_date = date('d-m-y');
    // $user_comment_count = 0;
    move_uploaded_file($user_image_temp, "../images/$user_image");

    $stmt = $connection->prepare("INSERT INTO users (username,user_password,user_firstname,user_lastname,user_email,user_role,user_image,randSalt) VALUES(?,?,?,?,?,?,?,?)");
    $stmt->bind_param("ssssssss", $username, $user_password, $user_firstname, $user_lastname, $user_email, $user_role, $user_image, $random_salt);
    $stmt->execute();
    $stmt->close();
    echo "User Created: " . " " . "<a href='users.php'>View Users</a>";
}
?>
<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" name="username" id="username" class="form-control">
    </div>
    <div class="form-group">
        <label for="user_password">Password</label>
        <input type="password" name="user_password" id="user_password" class="form-control">
    </div>
    <div class="form-group">
        <label for="user_firstname">First Name</label>
        <input type="text" name="user_firstname" id="user_firstname" class="form-control">
    </div>
    <div class="form-group">
        <label for="user_lastname">Last Name</label>
        <input type="text" name="user_lastname" id="user_lastname" class="form-control">
    </div>

    <div class="form-group">
        <label for="user_category">User Role</label>
        <select name="user_role" id="user_role">
            <option value="admin">Admin</option>
            <option value="subscriber">Subscriber</option>
            <?php
            // $query = "SELECT user_id,user_role FROM users";
            // $result = mysqli_query($connection, $query);
            // while ($row = mysqli_fetch_assoc($result)) {
            //     echo "<option value='{$row['user_id']}'>{$row['user_role']}</option>";
            // }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="user_image">user Image</label>
        <input type="file" name="user_image" id="user_image" class="form-control">
    </div>
    <div class="form-group">
        <label for="user_email">Email Address</label>
        <input type="email" name="user_email" id="user_email" class="form-control">
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="create_user" value="Add User">
    </div>

</form>