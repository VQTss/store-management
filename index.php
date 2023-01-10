<?php
include 'inc/header.php';
include 'inc/slider.php';
?>
<div class="main">

	<div class="content">
		<div class="content_top">
			<div class="heading">
				<h3>Feature Products</h3>
			</div>
			<div class="clear"></div>
		</div>
		<div class="section group">
			<?php
			$getProduct = $product->getAllProductByType_Feathered();
			if ($getProduct->num_rows > 0) {
				while ($rows = $getProduct->fetch_assoc()) {
			?>
					<div class="grid_1_of_4 images_1_of_4">
						<a href="preview.html"><img src="/admin/uploads/<?php echo $rows['images'] ?>" alt="" /></a>
						<h2><?php echo $rows['productName'] ?></h2>
						<p><?php echo $fm->textShorten($rows['product_desc'], 20) ?></p>
						<p><span class="price">$<?php echo $rows['price'] ?></span></p>
						<div class="button"><span>
								<a href="details.php?proID=<?php echo $rows['productID'] ?>" class="details">Details</a>
							</span>
						</div>
					</div>

			<?php
				}
			}

			?>

		</div>
		<div class="content_bottom">
			<div class="heading">
				<h3>New Products</h3>
			</div>
			<div class="clear"></div>
		</div>
		<div class="section group">

			<?php
			$getProductNew = $product->getProductNew();
			if ($getProductNew->num_rows > 0) {
				while ($rows_new_product = $getProductNew->fetch_assoc()) {
			?>
					<div class="grid_1_of_4 images_1_of_4">
						<a href="preview.html"><img src="/admin/uploads/<?php echo $rows_new_product['images'] ?>" alt="" /></a>
						<h2><?php echo $rows_new_product['productName'] ?></h2>
						<p><?php echo $fm->textShorten($rows_new_product['product_desc'], 20) ?></p>
						<p><span class="price">$<?php echo $rows_new_product['price'] ?></span></p>
						<div class="button"><span><a href="details.php?proID=<?php echo $rows_new_product['productID'] ?>" class="details">Details</a></span></div>
					</div>

			<?php
				}
			}
			?>



		</div>
	</div>
</div>
<?php
include 'inc/footer.php';

?>