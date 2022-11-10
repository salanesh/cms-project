<?php
if (isset($_GET['user_id'])) {
    $stmt = $connection->prepare("SELECT * FROM users where user_id = ?");
    $stmt->bind_param("i", $_GET['user_id']);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $user_id = $row["user_id"];
        $username = $row["username"];
        $user_password = $row["user_password"];
        $user_firstname = $row["user_firstname"];
        $user_lastname = $row["user_lastname"];
        $user_image = $row["user_image"];
        $user_email = $row["user_email"];
        $user_role = $row["user_role"];
    }
    $stmt->close();
}
if (isset($_POST['update_post'])) {
    $username = $_POST['username'];
    $user_password = $_POST['user_password'];
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_email = $_POST['user_email'];

    $user_image = $_FILES['user_image']['name'];
    $user_image_temp = $_FILES['user_image']['tmp_name'];

    if (empty($user_image)) {
        $query = "SELECT user_image FROM users WHERE user_id={$_GET['user_id']}";
        $result = mysqli_query($connection, $query);
        while ($row = mysqli_fetch_assoc($result)) {
            $user_image = $row['user_image'];
        }
    }
    move_uploaded_file($user_image_temp, "../images/$user_image");

    $stmt = $connection->prepare("UPDATE users SET username=?,user_password=?,user_firstname=?,user_lastname=?,user_image=?,user_email=? WHERE user_id = ?");
    $stmt->bind_param("ssssssi", $username, $user_password, $user_firstname, $user_lastname, $user_image, $user_email, $_GET['user_id']);
    $stmt->execute();
    $stmt->close();
    header("Location: users.php");
}
?>
<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" value="<?php echo $username; ?>" name="username" id="author" class="form-control">
    </div>
    <div class="form-group">
        <label for="user_password">Password</label>
        <input type="password" value="<?php echo $user_password; ?>" name="user_password" id="user_password" class="form-control">
    </div>
    <div class="form-group">
        <label for="user_firstname">First Name</label>
        <input type="text" name="user_firstname" id="user_firstname" value="<?php echo $user_firstname; ?>" class="form-control">
    </div>
    <div class="form-group">
        <label for="user_lastname">Last Name</label>
        <input type="text" name="user_lastname" id="user_lastname" value="<?php echo $user_lastname; ?>" class=" form-control">
    </div>
    <div class="form-group">
        <label for="user_email">Email Address</label>
        <input type="email" value="<?php echo $user_email; ?>" name="user_email" id="user_email" class="form-control">
    </div>
    <div class="form-group">
        <label for="user_image">User Image:</label>
        <img id="user_image" width='100' src="../images/<?php echo $user_image; ?>" alt="">
        <input type="file" name=" user_image" id="user_image" class="form-control">
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="update_post" value="Update Post">
    </div>

</form>