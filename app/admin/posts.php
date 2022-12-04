<?php
include "includes/admin_header.php";
?>
<div id="wrapper">
    <!-- Navigation -->
    <?php
    include "includes/admin_navigation.php";
    ?>

    <div id="page-wrapper">
        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <?php
                    if (isset($_GET['success'])) {
                        switch ($_GET['success']) {
                            case 1:
                                echo '<div class="row bg-success">
                                  <h3 class="text-center">New post has been added</h3>
                                  </div>';
                                break;
                            case 2:
                                echo '<div class="row bg-success">
                                  <h3 class="text-center">Post has been updated</h3>
                                  </div>';
                                break;
                            case 3:
                                echo '<div class="row bg-success">
                                  <h3 class="text-center">Post has been deleted</h3>
                                  </div>';
                                break;
                        }
                    }
                    ?>
                    <h1 class="page-header">
                        Welcome to Posts
                        <small><?php echo $_SESSION['username']; ?></small>
                    </h1>
                    <?php
                    if (isset($_GET['source'])) {
                        $source = $_GET['source'];
                    } else {
                        $source = '';
                    }
                    switch ($source) {
                        case '34';
                            echo 34;
                            break;
                        case 'edit_post';
                            include "includes/edit_post.php";
                            break;
                        case 'add_post';
                            include "includes/add_post.php";
                            break;
                        default:
                            include "includes/view_all_posts.php";
                            break;
                    }
                    ?>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
</div>
<!-- /#wrapper -->
<?php
include "includes/admin_footer.php";
?>