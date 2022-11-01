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
                    <h1 class="page-header">
                        Welcome to Admin
                        <small>Author</small>
                    </h1>
                    <div class="col-xs-6">
                        <?php
                        // insert category code
                        if (isset($_POST["submit"])) {
                            addCategory();
                        }
                        ?>
                        <form action="" method="post">
                            <div class="form-group">
                                <label for="cat_title">Category Title:</label>
                                <input type="text" name="cat_title" id="cat_title" class="form-control">
                            </div>
                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" name="submit" value="Add Category">
                            </div>
                        </form>
                        <?php
                        if (isset($_GET["edit"])) {
                            $cat_id = $_GET["edit"];
                            include "includes/update_categories.php";
                        }
                        if (isset($_POST["update"])) {
                            updateCategory();
                        }
                        ?>

                    </div>
                    <div class="col-xs-6">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Category Title</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // find all categories code
                                generateCategories();
                                ?>
                            </tbody>
                            <?php
                            // delete categories code
                            if (isset($_GET["delete"])) {
                                deleteCategory();
                            }
                            ?>
                        </table>
                    </div>
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