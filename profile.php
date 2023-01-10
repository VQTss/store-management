<?php
include 'inc/header.php';
// include 'inc/slider.php';
?>
<?php

$login_check = Session::get('customer_login');
if ($login_check == false) {
    header("Location: login.php");
}

?>

<div class="main">
    <div class="content">
        <div class="section group">

            <div class="content_top">
                <div class="heading">
                    <h3>Profile Customer</h3>
                </div>
                <div class="clear"></div>
            </div>
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
    <?php
    include 'inc/footer.php';

    ?>