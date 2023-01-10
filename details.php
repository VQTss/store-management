<?php
include 'inc/header.php';
// include 'inc/slider.php';
?>
<?php

if (!isset($_GET['proID']) && $_GET['proID'] == "") {
	echo "<script>window.location ='404.php'</script>";
} else {
	$productID = $_GET['proID'];
}

if (isset($_SERVER['REQUEST_METHOD']) == "POST" && isset($_POST['submit'])) {
	$quantity = $_POST['quantity'];
	$addToCart = $cart->add_to_cart($quantity,$productID);
}

?>

<div class="main">
	<div class="content">
		<div class="section group">
			<?php
			$get_product_details = $product->getDetailsProduct($productID);
			if ($get_product_details->num_rows > 0) {
				while ($rows = $get_product_details->fetch_assoc()) {
			?>
					<div class="cont-desc span_1_of_2">
						<div class="grid images_3_of_2">
							<img src="/admin/uploads/<?php echo $rows['images'] ?>" alt="" />
						</div>
						<div class="desc span_3_of_2">
							<h2><?php echo $rows['productName'] ?></h2>
							<p><?php echo $rows['product_desc'] ?></p>
							<div class="price">
								<p>Price: <span>$<?php echo $rows['price'] ?></span></p>
								<p>Category: <span><?php echo $rows['catName'] ?></span></p>
								<p>Brand:<span><?php echo $rows['brandName'] ?></span></p>
							</div>
							<div class="add-cart">
								<form action="" method="post">
									<input type="number" class="buyfield" name="quantity" min="1" value="1" />
									<input type="submit" class="buysubmit" name="submit" value="Buy Now" />
								</form>
							</div>
							<?php 
								if (isset($addToCart)) {
									echo "<span>'$addToCart'</span>";
								}
							?>
						</div>
						<div class="product-desc">
							<h2>Product Details</h2>
							<p><?php echo $rows['product_desc'] ?></p>
						</div>

					</div>
					<div class="rightsidebar span_3_of_1">
						<h2>CATEGORIES</h2>
						<ul>
							<?php
							$cate = $cat->getAllCategory();
							if ($cate->num_rows > 0) {
								while ($rows_cate = $cate->fetch_assoc()) {
							?>
									<li><a href="productbycat.php?catID=<?php echo $rows_cate['catID'] ?>"><?php echo $rows_cate['catName'] ?></a></li>

							<?php
								}
							}
							?>

						</ul>

					</div>

			<?php
				}
			}
			?>

		</div>
	</div>
	<?php
	include 'inc/footer.php';

	?>