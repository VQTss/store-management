<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include '../classes/brand.php'; ?>
<?php include '../classes/category.php'; ?>
<?php include '../classes/product.php'; ?>
<?php include_once '../helpers/format.php'; ?>
<?php

$product =  new product();
$brand  =  new brand();
$category = new category();
$fm = new Format();

if (isset($_GET['delID'])) {
	$delID = $_GET['delID'];
	$del = $product->delete_product($delID);
}


?>


<div class="grid_10">
	<div class="box round first grid">
		<h2>Product List</h2>
		<?php
        if (isset($del)) {
            echo $del;
        }
        ?>
		<div class="block">
			<table class="data display datatable" id="example">
				<thead>
					<tr>
						<th>ID</th>
						<th>Product Name</th>
						<th>Price</th>
						<th>Product Image</th>
						<th>Brand</th>
						<th>Category</th>
						<th>Description</th>
						<th>Type</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$get_all_product =  $product->getAllProduct();
					if ($get_all_product->num_rows > 0) {
						while ($rows = $get_all_product->fetch_assoc()) {
					?>

							<tr class="gradeU">
								<td><?php echo $rows['productID']; ?></td>
								<td><?php echo $rows['productName']; ?></td>
								<td><?php echo $rows['price']; ?></td>
								<td><img src="uploads/<?php echo $rows['images']; ?>" width="50"></td>
								<td><?php echo $rows['brandName']; ?></td>
								<td><?php echo $rows['catName']; ?></td>
								<td><?php
									echo  $fm->textShorten($rows['product_desc'], 20);
									?></td>
								<td><?php
									if ($rows['types'] == 0) {
										echo "Feathered";
									} else {
										echo "NON-Feathered";
									}
									?></td>
								<td><a href="productedit.php?proID=<?php echo $rows['productID'] ?>">Edit</a> || <a onclick="return confirm('Are you want to delete?')
								" href="?delID=<?php echo $rows['productID'] ?>">Delete</a></td>
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