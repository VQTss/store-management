<div class="header_bottom">
    <div class="header_bottom_left">
        <div class="section group">
            <?php
            $getProductLastest = $product->getLastedProductOfBrand("11");
            if ($getProductLastest) {
                while ($rows = $getProductLastest->fetch_assoc()) {
            ?>
                    <div class="listview_1_of_2 images_1_of_2">
                        <div class="listimg listimg_2_of_1">
                            <a href="details.php?proID=<?php echo $rows['productID'] ?>"> <img src="/admin/uploads/<?php echo $rows['images'] ?>" alt="" /></a>
                        </div>
                        <div class="text list_2_of_1">
                            <h2><?php echo $rows['brandName'] ?></h2>
                            <p><?php echo $fm->textShorten($rows['product_desc'], 50)  ?></p>
                            <div class="button"><span><a href="details.php?proID=<?php echo $rows['productID'] ?>">Add to cart</a></span></div>
                        </div>
                    </div>

            <?php
                }
            }
            ?>
            <?php
            $getProductLastest = $product->getLastedProductOfBrand("12");
            if ($getProductLastest) {
                while ($rows = $getProductLastest->fetch_assoc()) {
            ?>
                    <div class="listview_1_of_2 images_1_of_2">
                        <div class="listimg listimg_2_of_1">
                            <a href="details.php?proID=<?php echo $rows['productID'] ?>"> <img src="/admin/uploads/<?php echo $rows['images'] ?>" alt="" /></a>
                        </div>
                        <div class="text list_2_of_1">
                            <h2><?php echo $rows['brandName'] ?></h2>
                            <p><?php echo $fm->textShorten($rows['product_desc'], 50)  ?></p>
                            <div class="button"><span><a href="details.php?proID=<?php echo $rows['productID'] ?>">Add to cart</a></span></div>
                        </div>
                    </div>

            <?php
                }
            }
            ?>


        </div>
        <div class="section group">
            <?php
            $getProductLastest = $product->getLastedProductOfBrand("1");
            if ($getProductLastest) {
                while ($rows = $getProductLastest->fetch_assoc()) {
            ?>
                    <div class="listview_1_of_2 images_1_of_2">
                        <div class="listimg listimg_2_of_1">
                            <a href="details.php?proID=<?php echo $rows['productID'] ?>"> <img src="/admin/uploads/<?php echo $rows['images'] ?>" alt="" /></a>
                        </div>
                        <div class="text list_2_of_1">
                            <h2><?php echo $rows['brandName'] ?></h2>
                            <p><?php echo $fm->textShorten($rows['product_desc'], 50)  ?></p>
                            <div class="button"><span><a href="details.php?proID=<?php echo $rows['productID'] ?>">Add to cart</a></span></div>
                        </div>
                    </div>

            <?php
                }
            }
            ?>

            <?php
            $getProductLastest = $product->getLastedProductOfBrand("4");
            if ($getProductLastest) {
                while ($rows = $getProductLastest->fetch_assoc()) {
            ?>
                    <div class="listview_1_of_2 images_1_of_2">
                        <div class="listimg listimg_2_of_1">
                            <a href="details.php?proID=<?php echo $rows['productID'] ?>"> <img src="/admin/uploads/<?php echo $rows['images'] ?>" alt="" /></a>
                        </div>
                        <div class="text list_2_of_1">
                            <h2><?php echo $rows['brandName'] ?></h2>
                            <p><?php echo $fm->textShorten($rows['product_desc'], 50)  ?></p>
                            <div class="button"><span><a href="details.php?proID=<?php echo $rows['productID'] ?>">Add to cart</a></span></div>
                        </div>
                    </div>

            <?php
                }
            }
            ?>

        </div>
        <div class="clear"></div>
    </div>
    <div class="header_bottom_right_images">
        <!-- FlexSlider -->

        <section class="slider">
            <div class="flexslider">
                <ul class="slides">
                    <li><img src="images/1.jpg" alt="" /></li>
                    <li><img src="images/2.jpg" alt="" /></li>
                    <li><img src="images/3.jpg" alt="" /></li>
                    <li><img src="images/4.jpg" alt="" /></li>
                </ul>
            </div>
        </section>
        <!-- FlexSlider -->
    </div>
    <div class="clear"></div>
</div>