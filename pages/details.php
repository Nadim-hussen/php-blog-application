<?php
session_start();

if(!isset($_SESSION['name'] )){
    header("Location: ../login.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        .img{
            width:300px;
            height:250px;
        }
    </style>
</head>
<body>
  <div class="container mt-5">
      <?php
            include '../opp/user.php';
            $detail = new User();
            $id = $_REQUEST['id'];
            $row = $detail->details($id);
            if(!empty($row)){


      ?>
      <div class="d-flex justify-content-center align-items-center gap-2">
          <div>
      <img class="img" src="image/<?php echo $row['img']; ?>" alt="images" />
      </div><br>
<div>
   <p><span>Title : <?php echo $row['title']; ?></span> </p>
   <p><span>Description : <?php echo $row['description']; ?></span> </p>
   <p><span>Category : <?php echo $row['category']; ?></span> </p>
            </div>
            </div>
   <?php
            }
   ?>
   <div class="d-flex justify-content-center align-items-center">
   <a href="home.php" class="btn bg-info mx-auto">Go Back</a>
        </div>
  </div>
</body>
</html>