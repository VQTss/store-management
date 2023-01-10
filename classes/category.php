<?php
$file_path = realpath(dirname(__FILE__));
include_once  ($file_path.'/../lib/database.php');
include_once  ($file_path.'/../helpers/format.php');


?>

<?php
class category
{

    private $db;
    private $fm;


    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function insert_category($categoryName)
    {
        $categoryName  = $this->fm->validation($categoryName);
        $categoryName = mysqli_escape_string($this->db->link, $categoryName);

        if (empty($categoryName)) {
            $alert = "<span style='color: red;'>Category name must be not empty</span>";
            return $alert;
        } else {
            $query = "INSERT INTO tbl_category(catName) values ('$categoryName')";
            $result = $this->db->insert($query);

            if ($result == true) {
                $alert = "<span style='color: green;'>Add category success</span>";
                return $alert;
            }else {
                $alert = "<span style='color: red;'>Add category not success</span>";
                return $alert;
            }

        }
    }

    public function getAllCategory()
    {
        $query = "SELECT * FROM tbl_category order by catID desc";
        $result = $this->db->select($query);
        return $result;

    }
    

    public function getCatById($id)
    {
        $query = "SELECT * FROM tbl_category where catID ='$id'";
        $result = $this->db->select($query);
        return $result;
    }


    public function update_category($catname,$id)
    {
        $catname = $this->fm->validation($catname);
        $catname = mysqli_escape_string($this->db->link, $catname);
        $id = mysqli_escape_string($this->db->link, $id);
        
        if (empty($catname)) {
            $alert = "<span style='color: red;'>Category name must be not empty</span>";
            return $alert;
        }else {
            $query = "UPDATE tbl_category SET catName='$catname' WHERE catID ='$id'";
            $result = $this->db->update($query);
            if ($result == true) {
                $alert = "<span style='color: green;'>Update category success</span>";
                return $alert;
            }else {
                $alert = "<span style='color: red;'>Update category not success</span>";
                return $alert;
            }
        }


    }

    public function delete_cat($id)
    {
        $query = "DELETE FROM tbl_category WHERE catID = '$id'";
        $result = $this->db->delete($query);
        if ($result == true) {
            $alert = "<span style='color: green;'>Delete category success</span>";
            return $alert;
        }else {
            $alert = "<span style='color: red;'>Delete category not success</span>";
            return $alert;
        }
    }
  

}




?>