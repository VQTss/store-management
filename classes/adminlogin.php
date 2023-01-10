<?php 
$file_path = realpath(dirname(__FILE__));
include_once ($file_path.'/../lib/database.php');
include_once ($file_path.'/../lib/session.php');
include_once ($file_path.'/../helpers/format.php');
?>

<?php
class adminLogin 
{

    private $db;
    private $fm;


    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function login_admin($usernameAdmin,$passwordAdmin)
    {
        $usernameAdmin  = $this->fm->validation($usernameAdmin);
        $passwordAdmin  = $this->fm->validation($passwordAdmin);

        $usernameAdmin = mysqli_escape_string($this->db->link,$usernameAdmin);
        $passwordAdmin = mysqli_escape_string($this->db->link,$passwordAdmin);

        if (empty($usernameAdmin) || empty($passwordAdmin)) {
            $alert = "User and password must be not empty";
            return $alert;
        }else{
            $query = "SELECT * FROM `tbl_admin` WHERE adminUser = '$usernameAdmin' AND adminPass = '$passwordAdmin'";
            $result = $this->db->select($query);
            if ($result != false) {
                $values = $result->fetch_assoc();
                Session::set('adminlogin',true);
                Session::set('adminID',$values['adminID']);
                Session::set('adminUser',$values['adminUser']);
                Session::set('adminName',$values['adminName']);
                header("Location:index.php");
            }else{
                $alert = "User and Pass not match";
                return $alert;
            }
        }
    }

}


?>