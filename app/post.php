<?php
include "includes/db.php";
include "includes/header.php";
?>
<!-- Navigation -->
<?php include "includes/navigation.php"; ?>

<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">
            <?php
            if (isset($_GET['p_id'])) {
                $post_id = $_GET['p_id'];
            }

            $query = "SELECT * FROM posts WHERE post_id=$post_id";
            $result = mysqli_query($connection, $query);
            while ($row = mysqli_fetch_assoc($result)) {
                $post_id = $row['post_id'];
                $post_title = $row['post_title'];
                $post_author = $row['post_author'];
                $post_date = $row['post_date'];
                $post_image = $row['post_image'];
                $post_content = $row['post_content'];
            ?>
                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>

                <!-- First Blog Post -->
                <h2>
                    <a href="post.php?p_id=<?php echo $post_id ?>"><?php echo $post_title ?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $post_author ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image ?>" alt="">
                <hr>
                <p><?php echo $post_content ?></p>
                </p>


                <hr>
            <?php
            }
            ?>

            <!-- Blog Comments -->
            <?php
            if (isset($_POST["create_comment"])) {
                $comment_author = $_POST["comment_author"];
                $comment_email = $_POST["comment_email"];
                $comment_content = $_POST["comment_content"];
                $comment_status = "unapproved";
                $now = date("Y-m-d");
                $one = 1;

                try {
                    $connection->autocommit(FALSE);
                    $query1 = $connection->prepare("INSERT INTO comments(comment_post_id,comment_author,comment_email,comment_content,comment_status,comment_date) VALUES(?,?,?,?,?,?)");
                    $query2 = $connection->prepare("UPDATE posts SET post_comment_count=post_comment_count+? WHERE post_id=?");
                    $query1->bind_param("isssss", $post_id, $comment_author, $comment_email, $comment_content, $comment_status, $now);
                    $query2->bind_param("ii", $one, $post_id);
                    $query1->execute();
                    $query2->execute();
                    $query1->close();
                    $query2->close();
                    $connection->autocommit(TRUE);
                } catch (Exception $e) {
                    $connection->rollback();
                    throw $e;
                }
            }
            ?>
            <!-- Comments Form -->
            <div class="well">
                <h4>Leave a Comment:</h4>
                <form role="form" action="" method="post">
                    <div class="form-group">
                        <label for="comment_author">Author</label>
                        <input type="text" class="form-control" name="comment_author" id="comment_author">
                    </div>
                    <div class="form-group">
                        <label for="comment_email">Email</label>
                        <input type="email" name="comment_email" id="comment_email" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="comment_content">Your Comment</label>
                        <textarea name="comment_content" id="comment_content" class="form-control" rows="3"></textarea>
                    </div>
                    <button type="submit" name="create_comment" class="btn btn-primary">Submit</button>
                </form>
            </div>

            <hr>

            <!-- Posted Comments -->
            <?php
            $approved = 'approved';
            $stmt = $connection->prepare("SELECT * FROM comments WHERE comment_post_id=? AND comment_status=? ORDER BY comment_id DESC");
            $stmt->bind_param('is', $post_id, $approved);
            $stmt->execute();
            $result = $stmt->get_result();
            while ($row = $result->fetch_assoc()) {
                $comment_date = $row['comment_date'];
                $comment_content = $row['comment_content'];
                $comment_author = $row['comment_author'];

            ?>
                <!-- Comment -->
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $comment_author; ?>
                            <small><?php echo $comment_date; ?></small>
                        </h4>
                        <?php echo $comment_content; ?>
                    </div>
                </div>
            <?php
            }
            $stmt->close();
            ?>

        </div>

        <!-- Blog Sidebar Widgets Column -->
        <?php include "includes/sidebar.php" ?>

    </div>
    <!-- /.row -->

    <hr>

    <!-- Footer -->
    <?php
    include "includes/footer.php";
    ?>