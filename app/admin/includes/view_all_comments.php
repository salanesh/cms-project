<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>ID</th>
            <th>Author</th>
            <th>Email</th>
            <th>Comment</th>
            <th>Status</th>
            <th>In Response to</th>
            <th>Date</th>
            <th>Approve</th>
            <th>UnApprove</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $stmt = $connection->prepare("SELECT comments.*,posts.post_title FROM comments join posts WHERE comments.comment_post_id = posts.post_id;");
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            $comment_id = $row["comment_id"];
            $comment_post_id = $row["comment_post_id"];
            $comment_author = $row["comment_author"];
            $comment_email = $row["comment_email"];
            $comment_content = $row["comment_content"];
            $comment_status = $row["comment_status"];
            $comment_date = $row["comment_date"];
            $post_title = $row["post_title"];
            $comment_response = "<a href='../post.php?p_id={$comment_post_id}'>$post_title</a>";

            echo "<tr>";
            echo "<td>{$comment_id}</td>";
            // echo "<td>{$comment_post_id}</td>";
            echo "<td>{$comment_author}</td>";
            echo "<td>{$comment_email}</td>";
            echo "<td>{$comment_content}</td>";
            echo "<td>{$comment_status}</td>";
            echo "<td>{$comment_response}</td>";
            echo "<td>{$comment_date}</td>";
            echo "<td><a href='comments.php?approve={$comment_id}'>Approve</a></td>";
            echo "<td><a href='comments.php?unapprove={$comment_id}'>UnApprove</a></td>";
            echo "<td><a href='comments.php?delete={$comment_id}'>Delete</a></td>";
            echo "</tr>";
        }
        $stmt->close();
        ?>
    </tbody>
</table>
<?php
if (isset($_GET['approve'])) {
    $query = "UPDATE comments set comment_status='approved' WHERE comment_id = {$_GET['approve']}";
    mysqli_query($connection, $query);
    header("Location: comments.php");
}
if (isset($_GET['unapprove'])) {
    $query = "UPDATE comments set comment_status='unapproved' WHERE comment_id = {$_GET['unapprove']}";
    mysqli_query($connection, $query);
    header("Location: comments.php");
}
if (isset($_GET['delete'])) {
    $delete_comment_id = $_GET['delete'];
    $stmt = $connection->prepare("DELETE FROM comments WHERE comment_id=?");
    $stmt->bind_param("i", $delete_comment_id);
    $stmt->execute();
    $stmt->close();
    header("Location: comments.php");
}
?>