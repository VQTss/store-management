<?php 
$file_path = realpath(dirname(__FILE__));
include_once  ($file_path.'/../lib/database.php');
include_once  ($file_path.'/../helpers/format.php');

class user  
{
    private $db;
    private $fm;
    public function __construct() {
        $this->db = new Database();
        $this->fm = new Format();
    }

 


}



?>