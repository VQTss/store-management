<?php 
$file_path = realpath(dirname(__FILE__));
include_once  ($file_path.'/../lib/database.php');
include_once  ($file_path.'/../helpers/format.php');

class brand  
{
    private $db;
    private $fm;
    public function __construct() {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function insert_brand($brandName)
    {
        $brandName = $this->fm->validation($brandName);
        $brandName = mysqli_escape_string($this->db->link, $brandName);

        if (empty($brandName)) {
            $alert = "<span  style='color: red;'>Brand name can not be empty</span>";
            return $alert;
        }else {
            $query =  "INSERT INTO tbl_brand (brandName) values ('$brandName')";
            $result = $this->db->insert($query);
            if ($result == true) {
                $alert = "<span  style='color: green;'>Add brand success</span>";
                return $alert;
            }else {
                $alert = "<span  style='color: red;'>Add brand not success</span>";
                return $alert;
            }
        }
    }
    

    public function updateBrand($brandName,$brandId)
    {
        $brandName = $this->fm->validation($brandName);
        $brandName = mysqli_escape_string($this->db->link,$brandName);
        
        if (empty($brandName)) {
            $alert = "<span  style='color: red;'>Brand name can not be empty</span>";
            return $alert;
        }else {
            $query = "UPDATE  tbl_brand SET brandName = '$brandName' WHERE brandID = '$brandId'";
            $result = $this->db->update($query);
            if ($result == true) {
                $alert = "<span  style='color: green;'>Update brand success</span>";
                return $alert;
            }else {
                $alert = "<span  style='color: red;'>Update brand not success</span>";
                return $alert;
            }
        }
    }



    public function getAllBrand()
    {
        $query = "SELECT * FROM tbl_brand";
        $result = $this->db->select($query);
        return  $result;
    }


    public function getBrandByID($brandId)
    {
        $query = "SELECT * FROM tbl_brand WHERE brandID = '$brandId'";
        $result =  $this->db->select($query);
        return $result;
    }

    public function deleteBrand($idBrand)
    {
        $query = "DELETE FROM tbl_brand WHERE brandID = '$idBrand'";
        $result =  $this->db->delete($query);
        if ($result == true) {
            $alert = "<span style='color: green;'>Delete brand success</span>";
            return $alert;
        }else {
            $alert = "<span style='color: red;'>Delete brand not success</span>";
            return $alert;
        }
    }
   


}



?>