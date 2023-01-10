<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include '../classes/brand.php'; ?>

<?php

$brand =  new brand();

if (!isset($_GET['brandID']) || $_GET['brandID'] == '' ) {
    echo "<script>window.location ='brandlist.php'</script>";
}else{
    $brandID = $_GET['brandID'];
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $brandName = $_POST['brandName'];
    $insert_brand =  $brand->updateBrand($brandName,$brandID);
}



?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Update New Brand</h2>

        <div class="block copyblock">
            <?php
            if (isset($insert_brand)) {
                echo $insert_brand;
            }
            ?>
            <form action="#" method="post">
                <table class="form">
                    <tr>
                        <?php 
                            $get_by_brand =  $brand->getBrandByID($brandID);
                            $nameBrand =  $iDBrand = "";
                            if ($get_by_brand->num_rows > 0) {
                                while ($row = $get_by_brand->fetch_assoc()) {
                                    $nameBrand = $row['brandName'];
                                   
                                }
                            }
                        ?>
                        <td>
                            <input type="text" name="brandName" value="<?php echo $nameBrand ?>" placeholder="Enter Brand Name..." class="medium" />
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