<?php
include 'inc/header.php';
// include 'inc/slider.php';
?>

<style>
    .box-left {
        width: 50%;
        border: 1px solid #666;
        float: left;
        padding: 4px;
    }

    .box-right {
        width: 48%;
        border: 1px solid #666;
        float: right;
        padding: 4px;
    }
</style>

<div class="main">
    <form action="" method="post">
        <div class="content">
            <div class="section group">
                <div class="content_top">
                    <div class="heading">
                        <h3>Offline Payment</h3>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="box-left">
                    <div class="cartpage">
                        <table class="tblone">
                            <tr>
                                <th width="5%">ID</th>
                                <th width="20%">Product Name</th>
                                <th width="15%">Price</th>
                                <th width="25%">Quantity</th>
                                <th width="20%">Total Price</th>
                            </tr>
                            <?php
                            $cart_all = $cart->getAllCart();
                            if ($cart_all) {
                                $toal = 0;
                                $toal_quantity = 0;
                                $i = 1;
                                while ($rows_cart = $cart_all->fetch_assoc()) {
                            ?>
                                    <tr>
                                        <td><?php echo $i;
                                            $i++; ?></td>
                                        <td><?php echo $rows_cart['productName'] ?></td>
                                        <td><?php echo $rows_cart['price'] ?></td>
                                        <td>
                                            <?php echo $rows_cart['quantity'] ?>
                                        </td>
                                        <td><?php
                                            $sum = $rows_cart['quantity'] * $rows_cart['price'];
                                            echo $sum; ?></td>
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
                                            Session::set('sum_quantity', $toal_quantity);
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
                </div>
                <div class="box-right">
                    <table class="tblone">
                        <?php
                        $id = Session::get('customer_id');
                        $get_profile = $customer->get_customerByID($id);
                        if ($get_profile) {
                            while ($rows = $get_profile->fetch_assoc()) {
                        ?>
                                <tr>
                                    <td>Name</td>
                                    <td>:</td>
                                    <td><?php echo $rows['name'] ?></td>
                                </tr>
                                <tr>
                                    <td>City</td>
                                    <td>:</td>
                                    <td><?php echo $rows['city'] ?></td>
                                </tr>
                                <tr>
                                    <td>Phone</td>
                                    <td>:</td>
                                    <td><?php echo $rows['phone'] ?></td>
                                </tr>
                                <tr>
                                    <td>Address</td>
                                    <td>:</td>
                                    <td><?php echo $rows['address'] ?></td>
                                </tr>
                                <!-- <tr>
                            <td>Country</td>
                            <td>:</td>
                            <td><?php echo $rows['country'] ?></td>
                        </tr> -->
                                <tr>
                                    <td>Zipcode</td>
                                    <td>:</td>
                                    <td><?php echo $rows['zipcode'] ?></td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td>:</td>
                                    <td><?php echo $rows['email'] ?></td>
                                </tr>
                                <tr>
                                    <td colspan="3"><a href="updateprofile.php">Update Profile</a></td>
                                </tr>
                        <?php
                            }
                        }
                        ?>
                    </table>
                </div>

            </div>
            <input type="submit" value="Order" value="order">
        </div>
    </form>
    <?php
    include 'inc/footer.php';

    ?>