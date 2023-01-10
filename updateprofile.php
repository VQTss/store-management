<?php
include 'inc/header.php';
// include 'inc/slider.php';
?>
<?php

$login_check = Session::get('customer_login');
if ($login_check == false) {
    header("Location: login.php");
}

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['save'])) {
    $id = Session::get('customer_id');
    $update_customer = $customer->update_customer($_POST,$id);   
}


?>

<div class="main">
    <div class="content">
        <div class="section group">

            <div class="content_top">
                <div class="heading">
                    <h3>Update Profile Customer</h3>
                </div>
                <div class="clear"></div>
            </div>
            <?php
                if (isset($update_customer)) {
                    echo $update_customer;
                }
            ?>
            <table class="tblone">
                <form action="" method="post">
                    <?php
                    $id = Session::get('customer_id');
                    $get_profile = $customer->get_customerByID($id);
                    if ($get_profile) {
                        while ($rows = $get_profile->fetch_assoc()) {
                    ?>
                            <tr>
                                <td>Name</td>
                                <td>:</td>
                                <td><input type="text" name="name" value="<?php echo $rows['name'] ?>"></td>
                            </tr>
                            <tr>
                                <td>City</td>
                                <td>:</td>
                                <td><input type="text" name="city" value="<?php echo $rows['city'] ?>"></td>
                            </tr>
                            <tr>
                                <td>Phone</td>
                                <td>:</td>
                                <td><input type="text" name="phone" value="<?php echo $rows['phone'] ?>"></td>
                            </tr>
                            <tr>
                                <td>Address</td>
                                <td>:</td>
                                <td><input type="text" name="address" value="<?php echo $rows['address'] ?>"></td>
                            </tr>
                            <tr>
                                <td>Country</td>
                                <td>:</td>
                                <td> <select name="country" id="">
                                        <option  value="null">Select a Country</option>
                                        <option value="hcm" <?php if ($rows['country'] == "hcm") {
                                                                echo 'selected';
                                                            } ?>>Ho Chi Minh</option>
                                        <option <?php if ($rows['country'] == "na") {
                                                    echo 'selected';
                                                } ?> value="na">Nghe An</option>
                                        <option <?php if ($rows['country'] == "hn") {
                                                    echo 'selected';
                                                } ?> value="hn">Ha Noi</option>
                                        <option <?php if ($rows['country'] == "dn") {
                                                    echo 'selected';
                                                } ?> value="dn">Da Nang</option>
                                    </select> </td>
                            </tr>
                            <tr>
                                <td>Zipcode</td>
                                <td>:</td>
                                <td><input type="text" name="zipcode" value="<?php echo $rows['zipcode'] ?>"></td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td>:</td>
                                <td><input disabled type="text" name="email" value="<?php echo $rows['email'] ?>"></td>
                            </tr>
                            <tr>
                                <td colspan="3"><input type="submit" value="Save" name="save" class="grey"></td>
                            </tr>
                    <?php
                        }
                    }
                    ?>
                </form>




            </table>
        </div>
    </div>
    <?php
    include 'inc/footer.php';

    ?>