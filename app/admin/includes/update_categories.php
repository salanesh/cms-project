<form action="" method="post">
    <?php
    $query = "SELECT * FROM category WHERE cat_id = {$_GET['edit']}";
    $result = mysqli_query($connection, $query);
    while ($row = mysqli_fetch_assoc($result)) {

    ?>
        <div class="form-group">
            <label for="cat_title">Category Title:</label>
            <input type="text" name="cat_title" id="cat_title" class="form-control" value="<?php echo $row['cat_title']; ?>">
        </div>
    <?php }
    ?>
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="update" value="Update Category">
    </div>
</form>