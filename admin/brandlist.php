<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php
include '../classes/brand.php';

$brand = new brand();

if (isset($_GET['delID'])) {
    $id = $_GET['delID'];
    $delCat = $brand->deleteBrand($id);
}


?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Brand List</h2>
        <?php
        if (isset($delCat)) {
            echo $delCat;
        }
        ?>
        <div class="block">
            <table class="data display datatable" id="example">
                <thead>
                    <tr>
                        <th>Serial No.</th>
                        <th>Brand Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $show_brand = $brand->getAllBrand();
                    $i = 0;
                    if ($show_brand->num_rows > 0) {
                        while ($row  =  $show_brand->fetch_assoc()) {
                            $i++;

                    ?>
                            <tr class="odd gradeX">
                                <td><?php echo $i ?></td>
                                <td><?php echo $row['brandName'] ?></td>
                                <td><a href="brandedit.php?brandID=<?php echo $row['brandID'] ?>">Edit</a> || <a onclick="return confirm('Are you want to delete?')
								" href="?delID=<?php echo $row['brandID'] ?>">Delete</a></td>
                            </tr>
                    <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        setupLeftMenu();

        $('.datatable').dataTable();
        setSidebarHeight();
    });
</script>
<?php include 'inc/footer.php'; ?>