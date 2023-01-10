<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include '../classes/category.php'; ?>

<?php

$cat = new category();
if (!isset($_GET['catID']) || $_GET['catID'] == '') {
    echo "<script>window.location ='catlist.php'</script>";
} else {
    $id = $_GET['catID'];
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $catName = $_POST['catName'];
    $idcat = $_POST['catIDs'];
    $update_cat = $cat->update_category($catName,$idcat);
    
}

?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Edit Category</h2>

        <div class="block copyblock">
            <?php
            if (isset($update_cat)) {
                echo $update_cat;
            }
            ?>
            <?php
            $get_cate_name = $cat->getCatById($id);
            $id_cat  = $catName = "";
            if ($get_cate_name->num_rows > 0) {

                while ($row = $get_cate_name->fetch_assoc()) {
                    $catName = $row['catName'];
                    $id_cat =  $row['catID'];
                }
            }
            ?>
            <form action="#" method="post">
                <table class="form">
                    <tr>
                        <td>
                            <input type="hidden" name="catIDs" value="<?php echo $id_cat  ?>" class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" name="catName" value="<?php echo $catName  ?>" placeholder="Edit Category Name..." class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="submit" name="submit" Value="Save" />
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>
<?php include 'inc/footer.php'; ?>