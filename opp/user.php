<?php
class User{
    private $server = "localhost";
    private $username = "root";
    private $password ;
    private $db = "user";
    private $conn;

    public function __construct(){
        try{
            // $this->conn = new mysqli($this->server, $this->username, $this->password, $this->db);
            $this->conn = mysqli_connect($this->server, $this->username, $this->password, $this->db);
            // if($this->conn){
            //     echo "successfully connnected";
            // }
        } catch (Exception $e){
            echo "connecton failed ". $e->getMessage();
        }
    }
    #Registration form
    public function register(){

        if(isset($_POST['submit'])){
            // if(isset($_POST['name'] && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['phone']))){
                if(!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['phone'])){
                    $name = $_POST['name'];
                    $email = $_POST['email'];
                    $password = $_POST['password'];
                    $phone = $_POST['phone'];

                    $insert = "INSERT INTO `user-data` (name, email, password, phone) VALUES(' $name',
                    '$email', '$password', '$phone' )";
                    $sql = mysqli_query($this->conn, $insert);
                    if($sql){
                        echo "record inserted successfully";
                        echo "<script>window.location.href = 'login.php';</script>";
                    }else{
                        echo "Failed to insert record";
                    }
                }else{
                    // echo "<script>window.alert('PLZ insert data properly')</script>";
                    echo "<h2 style='color:red; font-size: 20px; text-align: center; margin-top: 10px;' >PLZ Insert Data Properly</h2>";

            }
        }
    }
    # Login form
    public function login(){
        if(isset($_POST['submit'])){
            if(!empty($_POST['email']) && !empty($_POST['password'])){
                $email = $_POST['email'];
                $password = $_POST['password'];
                $login = "SELECT * FROM `user-data` where email = '$email' ";

                $result = mysqli_query($this->conn, $login);

                if($result){
                    $row = mysqli_fetch_assoc($result);
                    $email = $row['email'];
                    if($row['password'] === $_POST['password']){
                        session_start();
                        $_SESSION['name'] = $email;

                        header("Location: pages/home.php");
                    }else{
                        echo "<h2 style='color:red; font-size: 20px; text-align: center; margin-top: 10px;' >Invalid Credential</h2>";
                    }

                }else{
                    echo "Failed to login";
                }

            }else{
                echo "<h2 style='color:red; font-size: 20px; text-align: center; margin-top: 10px;' >PLZ Insert Data Properly</h2>";

            }

        }

    }
    # Displaying whole data in home page
    public function home(){
        $result = null;
        if(isset($_POST['search'])){
            if(!empty($_POST['search-category'])){
                $category = strtolower($_POST['search-category']);
                $fetch = "SELECT * FROM `activity` WHERE category = '$category' ";
                $data = mysqli_query($this->conn, $fetch);
                if($data){
                    while($row = mysqli_fetch_assoc($data)){
                        $result[]= $row;
                    }
                  }
                  return $result;
            }

        }else{
            $fetch = "SELECT * FROM `activity` ";
            $data = mysqli_query($this->conn, $fetch);
            if($data){
                while($row = mysqli_fetch_assoc($data)){
                    $result[]= $row;
                }
            }
        return $result;
        }


        }
    #displaying single data in the details page
       # solution of fetching single record =  https://stackoverflow.com/questions/14624509/single-result-from-database-using-mysqli
    public function details($id){
        $data = null;
        $fetch = "SELECT * FROM `activity` WHERE id = '$id'";
        $result = mysqli_query($this->conn, $fetch);
          if($result){
            $row = $result->fetch_assoc();
            $data = $row;
          }
          return $data;
    }

    # Storing data into Database
    public function store(){

            if(isset($_POST['insert'])){
                // if(!empty($_POST['title']) && !empty($_POST['category']) && !empty($_POST['uploadfile']) && !empty($_POST['description'])){

                $title = $_POST['title'];
                $category = $_POST['category'];

                $email = $_SESSION['name'];

                $description = $_POST['description'];

                $filename = $_FILES["uploadfile"]["name"];
                $tempname = $_FILES["uploadfile"]["tmp_name"];
                $folder = 'image/'.$filename;
                if(!empty($title) && !empty($category) && !empty($email) && !empty($description) && !empty($filename)){
                    $sql = "INSERT INTO `activity` (email,title,img,category,description) VALUES('$email',
                    '$title', '$filename', '$category', '$description')";

                    mysqli_query($this->conn, $sql);

                    // Now let's move the uploaded image into the folder: image
                    if (move_uploaded_file($tempname, $folder))  {
                        $msg = "Image uploaded successfully";
                        header("Location: home.php");
                    }else{
                        $msg = "Failed to upload image";
                  }
                }else{
                    echo"<h2>plz, Insert all the input field</h2>";
                }


        }

}
    # getting particuler user data
    public function userData(){
        $result = null;
        $email = $_SESSION['name'];
        $fetch = "SELECT * FROM `activity` WHERE email = '$email' ";
        $data = mysqli_query($this->conn, $fetch);
        if($data){
            while($row = mysqli_fetch_assoc($data)){
                $result[]= $row;
            }
        }
    return $result;
    }
    public function deleteUser(){
        if(isset($_POST['delete'])){
            $id = $_POST["crud_id"];
            $email = $_SESSION['name'];
            // echo $email;
            $select = "SELECT * FROM `activity` WHERE id = '$id'";
            $result = mysqli_query($this->conn, $select);
            if($result){
                $row = $result->fetch_assoc();
                $data = $row;

                if($data['email'] === $email){
                    $delete  = "DELETE FROM `activity` WHERE id = '$id'";
                    if(mysqli_query($this->conn, $delete)){
                        unlink('image/'.$data['img']);
                        header("Location: profile.php");
                    }
                }else{
                    echo'failed to delete';
                }
            }else{
                echo'failed to select';
            }

        }


    }
    public function updateUser(){
        $email =  $_SESSION['name'];
        if(isset($_POST['update'])){
            $user_id = $_POST['id'];

            $user_title = $_POST['title'];
            $user_category= $_POST['category'];
            $user_description = $_POST['description'];
            $old_image = $_POST['old_image'];
            $new_image = $_FILES['new_image']['name'];
            $update_file=null;
            if($new_image != ''){
                $update_file = $_FILES['new_image']['name'];

            }else{
                $update_file = $old_image;
            }

            if(file_exists('image/'.$_FILES['new_image']['name'])){
                echo 'image already exists';
            }else{
                $update = "UPDATE `activity` SET email ='$email', title= '$user_title' ,
                img = '$update_file', category = '$user_category', description = '$user_description'
                WHERE id = '$user_id' ";
                $query = mysqli_query($this->conn, $update);
                if($query){
                    if ($_FILES['new_image']['name'] != ''){
                        move_uploaded_file( $_FILES['new_image']['tmp_name'], "image/". $_FILES['new_image']['name']);
                        unlink("image/".$old_image);
                    }
                    header("Location: profile.php");
                }else{
                    echo"Failed to update";
                }
            }
        }
}

}
?>