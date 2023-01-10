<?php
$file_path = realpath(dirname(__FILE__));
include_once($file_path . '/../lib/database.php');
include_once($file_path . '/../helpers/format.php');

class cart
{
    private $db;
    private $fm;
    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function add_to_cart($quantity, $id)
    {
        $quantity = $this->fm->validation($quantity);
        $quantity = mysqli_escape_string($this->db->link, $quantity);
        $id = mysqli_escape_string($this->db->link, $id);
        $sID  = session_id();

        $query_product = "SELECT * FROM tbl_product WHERE productID = '$id'";
        $result_product = $this->db->select($query_product)->fetch_assoc();

        $product_id = $result_product['productID'];
        $product_name = $result_product['productName'];
        $price = $result_product['price'];
        $images = $result_product['images'];

        $check_cart = "SELECT * FROM tbl_cart WHERE productID ='$id'AND sID = '$sID'";
        $update_quantity_cart = $this->db->select($check_cart);
        if ($update_quantity_cart->num_rows > 0) {
            $update_quantity_cart = $this->db->select($check_cart)->fetch_assoc();
            $res =  $this->updateToCartByQuantityOld($quantity,$update_quantity_cart['quantity'],$id,$sID);
            if ($res) {
                header("Location: cart.php");
            } else {
                header("Location: 404.php");
            }
        } else {
            $query_insert_cart = "INSERT INTO tbl_cart(productID,sID,productName,price,quantity,images)
            VALUES ('$product_id','$sID','$product_name','$price','$quantity','$images')";
            $result_cart = $this->db->insert($query_insert_cart);
            if ($result_cart) {
                header("Location: cart.php");
            } else {
                header("Location: 404.php");
            }
        }
    }

    
    public function updateToCar($cartID,$quantity)
    {
        $quantity = $this->fm->validation($quantity);
        $quantity = mysqli_escape_string($this->db->link,$quantity);
        $cartID =  $this->fm->validation($cartID);
        $cartID = mysqli_escape_string($this->db->link,$cartID);
        $query = "UPDATE tbl_cart 
        SET 
        quantity = '$quantity'
        WHERE 
        cartID = '$cartID'";
        $result_update = $this->db->update($query);
        if ($result_update) {
            $alert = "<span style='color: green;'>Product quantity update success</span>";
            return $alert;
        }else {
            $alert = "<span style='color: green;'>Product quantity update not success</span>";
            return $alert;
        }

    }

    public function updateToCartByQuantityOld($quantity,$quantity_old,$productID,$sID)
    {
        $quantity =  $this->fm->validation($quantity);
        $quantity = mysqli_escape_string($this->db->link,$quantity);
        $quantity_old = $this->fm->validation($quantity_old);
        $quantity_old = mysqli_escape_string($this->db->link,$quantity_old);
        $total = $quantity +  $quantity_old;
        $query ="UPDATE tbl_cart 
        SET 
        quantity = '$total'
        WHERE 
        productID = '$productID' AND sID = '$sID'";
        $res =  $this->db->update($query);
        return $res;
    }


    public function getAllCart()
    {
        $query = "SELECT * FROM tbl_cart";
        $result = $this->db->select($query);
        return $result;
    }

    public function delete_cart($cartID)
    {
        $query = "DELETE FROM tbl_cart WHERE cartID = '$cartID'";
        $result = $this->db->delete($query);
        return $result;
    }

    public function check_cart()
    {
        $sID = session_id();
        $query = "SELECT * FROM tbl_cart WHERE sID = '$sID'";
        $result  =  $this->db->select($query);
        return $result;
    }

    public function del_all_data()
    {
        $sID = session_id();
        $query = "DELETE FROM tbl_cart WHERE sID = '$sID'";
        $result  =  $this->db->select($query);
        return $result;
        
    }
}
