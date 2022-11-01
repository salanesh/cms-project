<?php
function generateCategories()
{
    global $connection;
    $query = "SELECT * FROM category";
    $result = mysqli_query($connection, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
        <td>{$row["cat_id"]}</td>
        <td>{$row['cat_title']}</td>
        <td><a href='categories.php?delete={$row['cat_id']}'>Delete</a></td>
        <td><a href='categories.php?edit={$row['cat_id']}'>Edit</a></td>
        </tr>";
    }
}
function addCategory()
{
    global $connection;
    $cat_title = $_POST["cat_title"];
    if ($cat_title == "" || empty($cat_title)) {
        echo "Category title cannot be empty";
    } else {
        $stmt = $connection->prepare("INSERT INTO category(cat_title) VALUES(?)");
        $stmt->bind_param("s", $cat_title);
        $stmt->execute();
        $stmt->close();
    }
}
function deleteCategory()
{
    global $connection;
    $stmt = $connection->prepare("DELETE FROM category WHERE cat_id = ?");
    $stmt->bind_param("i", $_GET["delete"]);
    $stmt->execute();
    $stmt->close();
    header("Location: categories.php");
}
function updateCategory()
{
    global $connection;
    $cat_title = $_POST["cat_title"];
    $stmt = $connection->prepare("UPDATE category SET cat_title = ? WHERE cat_id = ?");
    $stmt->bind_param("si", $cat_title, $_GET["edit"]);
    $stmt->execute();
    $stmt->close();
}
