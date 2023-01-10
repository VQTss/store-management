<?php
include 'inc/header.php';
include 'inc/slider.php';
?>
<?php
if (isset($_GET['cartID'])) {
	$id = $_GET['cartID'];
	$delCart = $cart->delete_cart($id);
}


if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['submit'])) {

	$cartID = $_POST['cartID'];
	$quantity =  $_POST['quantity'];
	if ($quantity <= 0) {
		$delCart = $cart->delete_cart($cartID);
	} else {
		$update_cart =  $cart->updateToCar($cartID, $quantity);
	}
}

if (!isset($_GET['id'])) {
	echo "<meta http-equiv='refresh content='0;URL=?id=live'>";
}

?>



<div class="main">
	<div class="content">
		<div class="cartoption">
		<div class="cartpage">
				<h2>Your Cart</h2>
				<?php
				if (isset($update_cart)) {
					echo $update_cart;
				}
				?>
				<table class="tblone">
					<tr>
						<th width="20%">Product Name</th>
						<th width="10%">Image</th>
						<th width="15%">Price</th>
						<th width="25%">Quantity</th>
						<th width="20%">Total Price</th>
						<th width="10%">Action</th>
					</tr>
					<?php
					$cart_all = $cart->getAllCart();
					if ($cart_all) {
						$toal = 0;
						$toal_quantity = 0;
						while ($rows_cart = $cart_all->fetch_assoc()) {
					?>
							<tr>
								<td><?php echo $rows_cart['productName'] ?></td>
								<td><img src="admin/uploads/<?php echo $rows_cart['images'] ?>" alt="" /></td>
								<td><?php echo $rows_cart['price'] ?></td>
								<td>
									<form action="" method="post">
										<input type="hidden" name="cartID" value="<?php echo $rows_cart['cartID'] ?>">
										<input type="number" name="quantity" min="0" value="<?php echo $rows_cart['quantity'] ?>" />
										<input type="submit" name="submit" value="Update" />
									</form>
								</td>
								<td><?php
									$sum = $rows_cart['quantity'] * $rows_cart['price'];
									echo $sum; ?></td>
								<td><a href="?cartID=<?php echo $rows_cart['cartID'] ?>">Delete</a></td>
							</tr>
					<?php
							$toal_quantity += $rows_cart['quantity'];
							$toal += $sum;
						}
					}
					?>

					<?php
					$check_cart = $cart->check_cart();
					if ($check_cart) {
					?>
						<table style="float:right;text-align:left;" width="40%">
							<tr>
								<th>Sub Total : </th>
								<td><?php
									echo $toal;
									Session::set('sum', $toal);
									Session::set('sum_quantity',$toal_quantity);
									?></td>
							</tr>
							<tr>
								<th>VAT : </th>
								<td><?php echo $toal * 0.1 ?></td>
							</tr>
							<tr>
								<th>Grand Total :</th>
								<td><?php echo $toal + ($toal * 0.1) ?></td>
							</tr>
						</table>
					<?php
					} else {
						echo '<h3 style="color:red">Your cart is empty</h3>';
					}
					?>
			</div>
			<div class="shopping">
				<div class="shopleft">
					<a href="index.php"> <img src="images/shop.png" alt="" /></a>
				</div>
				<div class="shopright">
					<a href="payment.php"> <img src="images/check.png" alt="" /></a>
				</div>
			</div>
		</div>
		<div class="clear"></div>
	</div>
</div>

<?php
include 'inc/footer.php';

?>