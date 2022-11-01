<?php
if (isset($_GET['p_id'])) {
    $stmt = $connection->prepare("SELECT * FROM posts where post_id = ?");
    $stmt->bind_param("i", $_GET['p_id']);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $post_id = $row["post_id"];
        $post_author = $row["post_author"];
        $post_title = $row["post_title"];
        $post_category_id = $row["post_category_id"];
        $post_status = $row["post_status"];
        $post_image = $row["post_image"];
        $post_tags = $row["post_tags"];
        $post_content = $row["post_content"];
        $post_comment_count = $row["post_comment_count"];
        $post_date = $row["post_date"];
    }
    $stmt->close();
}
if (isset($_POST['update_post'])) {
    $post_title = $_POST['post_title'];
    $post_author = $_POST['post_author'];
    $post_category_id = $_POST['post_category_id'];
    $post_status = $_POST['post_status'];

    $post_image = $_FILES['post_image']['name'];
    $post_image_temp = $_FILES['post_image']['tmp_name'];

    $post_tags = $_POST['post_tags'];
    $post_content = $_POST['post_content'];
    if (empty($post_image)) {
        $query = "SELECT post_image FROM posts WHERE post_id={$_GET['p_id']}";
        $result = mysqli_query($connection, $query);
        while ($row = mysqli_fetch_assoc($result)) {
            $post_image = $row['post_image'];
        }
    }
    move_uploaded_file($post_image_temp, "../images/$post_image");

    $stmt = $connection->prepare("UPDATE posts SET post_title=?,post_author=?,post_category_id=?,post_status=?,post_image=?,post_tags=?,post_content=? WHERE post_id = ?");
    $stmt->bind_param("ssissssi", $post_title, $post_author, $post_category_id, $post_status, $post_image, $post_tags, $post_content, $_GET['p_id']);
    $stmt->execute();
    $stmt->close();
}
?>
<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" value="<?php echo $post_title; ?>" name="post_title" id="title" class="form-control">
    </div>
    <div class="form-group">
        <label for="post_category_id">Post Category ID</label>
        <select name="post_category_id" id="post_category_id">
            <?php
            $query = "SELECT * FROM category";
            $result = mysqli_query($connection, $query);
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<option value='{$row['cat_id']}'>{$row['cat_title']}</option>";
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="author">Post Author</label>
        <input type="text" value="<?php echo $post_author; ?>" name="post_author" id="author" class="form-control">
    </div>
    <div class="form-group">
        <label for="post_status">Post Status</label>
        <input type="text" value="<?php echo $post_status; ?>" name="post_status" id="post_status" class="form-control">
    </div>
    <div class="form-group">
        <label for="post_image">Post Image</label>
        <img id="post_image" width='100' src="../images/<?php echo $post_image; ?>" alt="">
        <input type="file" name=" post_image" id="post_image" class="form-control">
    </div>
    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" value="<?php echo $post_tags; ?>" name="post_tags" id="post_tags" class="form-control">
    </div>
    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea name="post_content" id="post_content" cols="30" rows="10"><?php echo $post_content; ?></textarea>
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="update_post" value="Update Post">
    </div>

</form>