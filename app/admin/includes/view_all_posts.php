<?php

if (isset($_POST["bulk"])) {
    if (isset($_POST["options"])) {
        $arr = $_POST['selected'];
        if ($_POST["options"] == 'draft' || $_POST["options"] == 'Published') {
            for ($i = 0; $i < count($arr); $i++) {
                $stmt = $connection->prepare("UPDATE posts SET post_status=? WHERE post_id=?");
                $stmt->bind_param("si", $_POST["options"], $arr[$i]);
                $stmt->execute();
                $stmt->close();
            }
            echo '<div class="row bg-success">
                                  <h3 class="text-center">Post/s Statuses have been updated</h3>
                                  </div>';
        } else {
            for ($i = 0; $i < count($arr); $i++) {
                $stmt = $connection->prepare("DELETE FROM posts WHERE post_id=?");
                $stmt->bind_param("i", $arr[$i]);
                $stmt->execute();
                $stmt->close();
            }
            echo '<div class="row bg-success">
                                  <h3 class="text-center">Post/s have been deleted</h3>
                                  </div>';
        }
    }
}

?>
<form action="" method="post">
    <select name="options" id="options">
        <option value="draft">draft</option>
        <option value="Published">publish</option>
        <option value="delete">delete</option>
    </select>
    <button type="submit" class="btn-success" name="bulk" value="bulkEdit">apply</button>
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>Select <input type="checkbox" id="checkAll"></th>
                <th>ID</th>
                <th>Author</th>
                <th>Title</th>
                <th>Category</th>
                <th>Status</th>
                <th>Image</th>
                <th>Tags</th>
                <th>Comments</th>
                <th>Date</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $stmt = $connection->prepare("SELECT p.post_id,p.post_title,p.post_author,p.post_date,p.post_image,p.post_content,p.post_tags,
        p.post_comment_count,p.post_status,c.cat_title FROM posts p,category c WHERE p.post_category_id=c.cat_id;");
            $stmt->execute();
            $result = $stmt->get_result();
            while ($row = $result->fetch_assoc()) {
                $post_id = $row["post_id"];
                $post_author = $row["post_author"];
                $post_title = $row["post_title"];
                $cat_title = $row["cat_title"];
                $post_status = $row["post_status"];
                $post_image = $row["post_image"];
                $post_tags = $row["post_tags"];
                $post_comment_count = $row["post_comment_count"];
                $post_date = $row["post_date"];
                echo "<tr>";
                echo "<td><input type='checkbox' name='selected[]' value='$post_id' class='table-boxes'></td>";
                echo "<td>{$post_id}</td>";
                echo "<td>{$post_author}</td>";
                echo "<td>{$post_title}</td>";
                echo "<td>{$cat_title}</td>";
                echo "<td>{$post_status}</td>";
                echo "<td><img width='100' src='../images/{$post_image}' alt='image'></td>";
                echo "<td>{$post_tags}</td>";
                echo "<td>{$post_comment_count}</td>";
                echo "<td>{$post_date}</td>";
                echo "<td><a href='posts.php?source=edit_post&p_id={$post_id}'>Edit</a></td>";
                echo "<td><a href='posts.php?delete={$post_id}'>Delete</a></td>";
                echo "</tr>";
            }
            $stmt->close();
            ?>
        </tbody>
    </table>
</form>
<?php
if (isset($_GET['delete'])) {
    $delete_post_id = $_GET['delete'];
    $stmt = $connection->prepare("DELETE FROM posts WHERE post_id=?");
    $stmt->bind_param("i", $delete_post_id);
    $stmt->execute();
    $stmt->close();
    header("Location: posts.php?success=3");
}
?>