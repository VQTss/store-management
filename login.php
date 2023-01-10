<?php
include 'inc/header.php';
// include 'inc/slider.php';
?>

<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {

	$add_product = $customer->insert_customer($_POST);
}



?>

<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
	$login_customer = $customer->login_customer($_POST);
}



?>


<?php
$login_check = Session::get('customer_login');
if ($login_check) {
	header("Location: order.php");
}
?>


<div class="main">
	<div class="content">
		<div class="login_panel">
			<h3>Existing Customers</h3>
			<?php
			if (isset($login_customer)) {
				echo $login_customer;
			}
			?>
			<p>Sign in with the form below.</p>
			<form action="" method="post" id="member">
				<input type="text" name="email" class="field" placeholder="Enter email">
				<input type="password" name="password" class="field">
				<p class="note">If you forgot your passoword just enter your email and click <a href="#">here</a></p>
				<div class="buttons">
					<div><input type="submit" name="login" class="grey" value="Sign In"></div>
				</div>
			</form>
		</div>

		<div class="register_account">
			<h3>Register New Account</h3>
			<?php
			if (isset($add_product)) {
				echo $add_product;
			}
			?>
			<form action="" method="POST">
				<table>
					<tbody>
						<tr>
							<td>
								<div>
									<input type="text" name="name" placeholder="Enter name ... ">
								</div>

								<div>
									<input type="text" name="city" placeholder="Enter city ... ">
								</div>

								<div>
									<input type="text" name="zipcode" placeholder="Enter name ... ">
								</div>
								<div>
									<input type="text" name="email" placeholder="Enter email">
								</div>
							</td>
							<td>
								<div>
									<input type="text" name="address" placeholder="Enter address">
								</div>
								<div>
									<select id="country" name="country" onchange="change_country(this.value)" class="frm-field required">
									<option value="null">Select a Country</option>
										<option value="hcm">Ho Chi Minh</option>
										<option value="na">Nghe An</option>
										<option value="hn">Ha Noi</option>
										<option value="dn">Da Nang</option>
									</select>
								</div>

								<div>
									<input type="text" name="phone" placeholder="Enter phone">
								</div>

								<div>
									<input type="text" name="password" placeholder="Enter password">
								</div>
							</td>
						</tr>
					</tbody>
				</table>
				<div class="search">
					<div><input type="submit" name="submit" class="grey" value="Create Account"></div>
				</div>
				<p class="terms">By clicking 'Create Account' you agree to the <a href="#">Terms &amp; Conditions</a>.</p>
				<div class="clear"></div>
			</form>
		</div>
		<div class="clear"></div>
	</div>
</div>
<?php
include 'inc/footer.php';

?>