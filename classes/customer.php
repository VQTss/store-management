<?php 

class customer 
{
    private $db;
    private $fm;


    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }


    public function insert_customer($data)
    {
        $name = mysqli_escape_string($this->db->link,$data['name']);
        $city = mysqli_escape_string($this->db->link,$data['city']);
        $zipcode = mysqli_escape_string($this->db->link,$data['zipcode']);
        $email = mysqli_escape_string($this->db->link,$data['email']);
        $address = mysqli_escape_string($this->db->link,$data['address']);
        $country = mysqli_escape_string($this->db->link,$data['country']);
        $phone = mysqli_escape_string($this->db->link,$data['phone']);
        $password = mysqli_escape_string($this->db->link,md5($data['password']));
        if ($name == "" || $city == "" || $zipcode == "" || $email == "" ||
        $address == "" || $country == "" || $phone == "" || $password == "") {
            $alert = "<span style='color:red'>Fiels must be not empty</span>";
            return $alert;
        }else {
            $check_email = "SELECT * FROM tbl_customer WHERE email = '$email'";
            $result_check = $this->db->select($check_email);
            if ($result_check) {
                $alert = "<span style='color:red'>Email already existed!</span>";
                return $alert;
            }else {
                $query = "INSERT INTO tbl_customer(name,address,city,country,zipcode,phone,email,password)
                VALUES ('$name','$address','$city','$country','$zipcode','$phone','$email','$password')";
                $result = $this->db->insert($query);
                if ($result) {
                    $alert = "<span style='color:green'>Insert customer successfully</span>";
                    return $alert;
                }else {
                    $alert = "<span style='color:red'>Insert customer  not success</span>";
                    return $alert;
                }
        
        }
        }
    }


    public function login_customer($data)
    {
        $email = mysqli_escape_string($this->db->link,$data['email']);
        $password =  mysqli_escape_string($this->db->link,md5($data['password']));
        if (empty($email)||  empty($password)) {
            $alert = "<span style='color:red'>Fiels must be not empty</span>";
            return $alert;
        }else {
            $query = "SELECT * FROM tbl_customer WHERE email='$email' AND password='$password'";
            $result_login = $this->db->select($query);
            if ($result_login) {
                $value = $result_login->fetch_assoc();
                Session::set('customer_login',true);
                Session::set('customer_id',$value['id']);
                Session::set('customer_name',$value['name']);
                header("Location: order.php");
            }else {
                $alert = "<span style='color:red'>Email and password does not match</span>";
                return $alert;
            }
        }
    }

    public function update_customer($data,$id)
    {
        $name = mysqli_escape_string($this->db->link,$data['name']);
        $city = mysqli_escape_string($this->db->link,$data['city']);
        $zipcode = mysqli_escape_string($this->db->link,$data['zipcode']);
        // $email = mysqli_escape_string($this->db->link,$data['email']);
        $address = mysqli_escape_string($this->db->link,$data['address']);
        $country = mysqli_escape_string($this->db->link,$data['country']);
        $phone = mysqli_escape_string($this->db->link,$data['phone']);
        // $password = mysqli_escape_string($this->db->link,md5($data['password']));
        if ($name == "" || $city == "" || $zipcode == "" ||
        $address == "" || $country == "" || $phone == "") {
            $alert = "<span style='color:red'>Fiels must be not empty</span>";
            return $alert;
        }else {

                $query = "UPDATE tbl_customer SET 
                name='$name',
                city='$city', 
                zipcode = '$zipcode',
                address = '$address',
                country = '$country',
                phone = '$phone'
                WHERE id = '$id'";
                $result = $this->db->update($query);
                if ($result) {
                    header("Location: profile.php");
                }else {
                    $alert = "<span style='color:red'>Update customer  not success</span>";
                    return $alert;
                }
        
        }
    }



    public function get_customerByID($cusomterID)
    {
        $query = "SELECT * FROM tbl_customer WHERE id ='$cusomterID'";
        $result = $this->db->select($query);
        return $result;
    }









}
