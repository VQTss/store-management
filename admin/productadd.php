<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include '../classes/brand.php'; ?>
<?php include '../classes/category.php'; ?>
<?php include '../classes/product.php'; ?>

<?php 

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $product = new product();
    $add_product = $product->insert_product($_POST,$_FILES);
}


?>


<div class="grid_10">
    <div class="box round first grid">
        <h2>Add New Product</h2>
        <?php
            if (isset($add_product)) {
                echo $add_product;
            }
            ?>
        <div class="block">
            <form action="productadd.php" method="post" enctype="multipart/form-data">
                <table class="form">

                    <tr>
                        <td>
                            <label>Name</label>
                        </td>
                        <td>
                            <input type="text" name="productName" placeholder="Enter Product Name..." class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Category</label>
                        </td>
                        <td>
                            <select id="select" name="category">
                                <option>Select Category</option>
                                <?php
                                $cat = new category();
                                $res_cat = $cat->getAllCategory();
                                if ($res_cat->num_rows > 0) {
                                    while ($row = $res_cat->fetch_assoc()) {
                                ?>
                                        <option value="<?php echo $row['catID'] ?>"><?php echo $row['catName'] ?></option>

                                <?php
                                    }
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Brand</label>
                        </td>
                        <td>
                            <select id="select"  name="brand">
                                <option>Select Brand</option>
                                <?php
                                $brand  = new brand();
                                $res_cat = $brand->getAllBrand();
                                if ($res_cat->num_rows > 0) {
                                    while ($row = $res_cat->fetch_assoc()) {
                                ?>
                                        <option value="<?php echo $row['brandID'] ?>"><?php echo $row['brandName'] ?></option>

                                <?php
                                    }
                                }
                                ?>
                                
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td style="vertical-align: top; padding-top: 9px;">
                            <label>Description</label>
                        </td>
                        <td>
                            <textarea name="product_desc" class="tinymce"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Price</label>
                        </td>
                        <td>
                            <input type="text" name="price" placeholder="Enter Price..." class="medium" />
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>Upload Image</label>
                        </td>
                        <td>
                            <input type="file" name="image" />
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>Product Type</label>
                        </td>
                        <td>
                            <select id="select" name="type">
                                <option>Select Type</option>
                                <option value="1">Featured</option>
                                <option value="0">Non-Featured</option>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" name="submit" Value="Save" />
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>
<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function() {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<!-- Load TinyMCE -->
<?php include 'inc/footer.php'; ?>