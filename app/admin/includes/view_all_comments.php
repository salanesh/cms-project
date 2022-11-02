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
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $stmt = $connection->prepare("SELECT * FROM comments");
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            $comment_id = $row["comment_id"];
            // $comment_post_id = $row["comment_post_id"];
            $comment_author = $row["comment_author"];
            $comment_email = $row["comment_email"];
            $comment_content = $row["comment_content"];
            $comment_status = $row["comment_status"];
            $comment_date = $row["comment_date"];
            $comment_response = "someone";

            echo "<tr>";
            echo "<td>{$comment_id}</td>";
            // echo "<td>{$comment_post_id}</td>";
            echo "<td>{$comment_author}</td>";
            echo "<td>{$comment_email}</td>";
            echo "<td>{$comment_content}</td>";
            echo "<td>{$comment_status}</td>";
            echo "<td>{$comment_response}</td>";
            echo "<td>{$comment_date}</td>";
            echo "<td><a href''>Approve</a></td>";
            echo "<td><a href''>UnApprove</a></td>";
            echo "<td><a href='comments.php?source=edit_comment&p_id={$comment_id}'>Edit</a></td>";
            echo "<td><a href='comments.php?delete={$comment_id}'>Delete</a></td>";
            echo "</tr>";
        }
        $stmt->close();
        ?>
    </tbody>
</table>
<?php
if (isset($_GET['delete'])) {
    $delete_post_id = $_GET['delete'];
    $stmt = $connection->prepare("DELETE FROM posts WHERE post_id=?");
    $stmt->bind_param("i", $delete_post_id);
    $stmt->execute();
    $stmt->close();
}
?>