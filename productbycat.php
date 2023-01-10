<?php
include 'inc/header.php';
// include 'inc/slider.php';
?>

<?php
if (!isset($_GET['catID']) || $_GET['catID'] == '') {
	echo "<script>window.location ='catlist.php'</script>";
} else {
	$id = $_GET['catID'];
}
?>

<div class="main">
	<div class="content">
		<div class="content_top">
			<div class="heading">
				<?php
				$get_cat = $cat->getCatById($id);
				if ($get_cat) {
					while ($a = $get_cat->fetch_assoc()) {
				?>
						<h3>Category: <?php echo $a['catName'] ?></h3>
				<?php
					}
				}
				?>
			</div>
			<div class="clear"></div>


		</div>
		<div class="section group">
			<?php
			$get_product_by_cat = $product->getProductByCategory($id);
			if ($get_product_by_cat) {
				while ($rows = $get_product_by_cat->fetch_assoc()) {
			?>
					<div class="grid_1_of_4 images_1_of_4">
						<a href="preview-3.php"><img src="/admin/uploads/<?php echo $rows['images'] ?>" alt="" /></a>
						<h2><?php echo $rows['productName'] ?></h2>
						<p><?php echo $fm->textShorten($rows['product_desc'], 100) ?></p>
						<p><span class="price"><?php echo $rows['price'] ?></span></p>
						<div class="button"><span><a href="preview.php" class="details">Details</a></span></div>
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