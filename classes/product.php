<?php
$file_path = realpath(dirname(__FILE__));
include_once ($file_path.'/../lib/database.php');
include_once ($file_path.'/../helpers/format.php');


?>

<?php
class product
{

    private $db;
    private $fm;


    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function insert_product($data, $file)
    {
        $productName = mysqli_escape_string($this->db->link, $data['productName']);
        $brand = mysqli_escape_string($this->db->link, $data['brand']);
        $category = mysqli_escape_string($this->db->link, $data['category']);
        $product_desc = mysqli_escape_string($this->db->link, $data['product_desc']);
        $price = mysqli_escape_string($this->db->link, $data['price']);
        $type = mysqli_escape_string($this->db->link, $data['type']);
        $permited  = array('jpg', 'jpeg', 'png', 'gif');
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_tmp = $_FILES['image']['tmp_name'];

        $div =  explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
        $upload_image = "uploads/" . $unique_image;


        if (
            $productName == "" || $brand == ""  || $category == ""
            || $type == ""  || $price == ""  || $product_desc == ""  || $file_name == ""
        ) {
            $alert = "<span style='color: red;'>Fiels name must be not empty</span>";
            return $alert;
        } else {
            move_uploaded_file($file_tmp, $upload_image);

            $query = "INSERT INTO tbl_product(productName,catID,brandID,product_desc,types,price,images) 
                       VALUES('$productName','$category','$brand','$product_desc','$type','$price','$unique_image')";
            $result = $this->db->insert($query);
            if ($result) {
                $alert = "<span style='color: green;'>Add product success</span>";
                return $alert;
            } else {
                $alert = "<span style='color: red;'>Add product not success</span>";
                return $alert;
            }
        }
    }

    public function getAllProduct()
    {
        $query =  "SELECT * ,tbl_category.catName,tbl_brand.brandName FROM tbl_product 
        INNER JOIN tbl_category ON tbl_product.catID = tbl_category.catID 
        INNER JOIN tbl_brand ON tbl_product.brandID = tbl_brand.brandID;";
        $result = $this->db->select($query);
        return $result;
    }

    public function getProductByID($productID)
    {
        $query =  "SELECT *FROM tbl_product 
        WHERE productID = '$productID'";
        $result = $this->db->select($query);
        return $result;
    }

    public function update_product($data, $file, $productID)
    {
        $productName = mysqli_escape_string($this->db->link, $data['productName']);
        $brand = mysqli_escape_string($this->db->link, $data['brand']);
        $category = mysqli_escape_string($this->db->link, $data['category']);
        $product_desc = mysqli_escape_string($this->db->link, $data['product_desc']);
        $price = mysqli_escape_string($this->db->link, $data['price']);
        $type = mysqli_escape_string($this->db->link, $data['type']);
        $permited  = array('jpg', 'jpeg', 'png', 'gif');
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_tmp = $_FILES['image']['tmp_name'];

        $div =  explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
        $upload_image = "uploads/" . $unique_image;


        if (
            $productName == "" || $brand == ""  || $category == ""
            || $type == ""  || $price == ""  || $product_desc == ""
        ) {
            $alert = "<span style='color: red;'>Fiels name must be not empty</span>";
            return $alert;
        } else {
            // Nếu người dùng chọn ảnh
            if (!empty($file_name)) {
                if ($file_size > 2048) {
                    $alert = "<span  style='color: red;>Image size shoule be less than 2MB</span>";
                    return $alert;
                } elseif (in_array($file_ext, $permited) === false) {
                    $alert = "<span  style='color: red;>You can upload only:-" . implode(',', $permited) . "</span>";
                    return $alert;
                } else {
                    move_uploaded_file($file_tmp, $upload_image);
                    $query = "UPDATE tbl_product SET
                    productName = '$productName',
                    catID = '$category',
                    brandID = '$brand',
                    product_desc = '$product_desc',
                    types = '$type',
                    price = '$price', 
                    images = '$unique_image'
                    WHERE productID ='$productID'";
                }
            } else {
                $query = "UPDATE tbl_product SET
                productName = '$productName',
                catID = '$category',
                brandID = '$brand',
                product_desc = '$product_desc',
                types = '$type',
                price = '$price'
                WHERE productID ='$productID'";
            }
            $result = $this->db->update($query);
            if ($result) {
                $alert = "<span style='color: green;'>Update product success</span>";
                return $alert;
            } else {
                $alert = "<span style='color: red;'>Update product not success</span>";
                return $alert;
            }
        }
    }


    public function delete_product($productID)
    {
        $query = "DELETE FROM tbl_product WHERE productID = '$productID'";
        $result = $this->db->delete($query);
        if ($result == true) {
            $alert = "<span style='color: green;'>Delete category success</span>";
            return $alert;
        } else {
            $alert = "<span style='color: red;'>Delete category not success</span>";
            return $alert;
        }
    }


    public function getAllProductByType_Feathered()
    {
        $query = "SELECT * FROM tbl_product WHERE types = '0'";
        $result =  $this->db->select($query);
        return $result;
    }


    public function getProductNew()
    {
        $query = "SELECT * FROM tbl_product order by productID desc limit 4";
        $result =  $this->db->select($query);
        return $result;
    }

    public function getDetailsProduct($productID)
    {
        $query = "SELECT * from tbl_product 
        INNER JOIN tbl_category ON tbl_product.catID = tbl_category.catID 
        INNER JOIN tbl_brand ON tbl_product.brandID = tbl_brand.brandID 
        WHERE tbl_product.productID = '$productID'";
        $result =  $this->db->select($query);
        return $result;

    }


    public function getLastedProductOfBrand($brandID)
    {
        $query = "SELECT * , tbl_brand.brandName FROM tbl_product 
        LEFT OUTER JOIN tbl_brand ON tbl_product.brandID = tbl_brand.brandID 
        WHERE tbl_product.brandID = '$brandID'  ORDER BY productID DESC LIMIT 1;";
        $result = $this->db->select($query);
        return $result;
    }

    public function getProductByCategory($catID)
    {
        $query = "SELECT * FROM tbl_product WHERE catID = '$catID'";
        $result = $this->db->select($query);
        return $result;
    }



}




?>