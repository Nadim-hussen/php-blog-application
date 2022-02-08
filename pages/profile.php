

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
    <title>User Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>
<body>
<?php include './component/nav.php' ?>
<div class="container head-h2 mt-3">
        <div class="d-flex justify-content-center mb-3">
        <a href="activity.php" class="btn bg-info">Insert Data</a>
        </div>

        <h2 class="text-center mb-3">Your Activity</h2>
    </div>
<div class="container d-flex justify-content-center mb-2">
      <div class="row mx-2">
<?php
     include '../opp/user.php';
     $user = new User();
     $delete = $user->deleteUser();
     $datas = $user->userData();
     if(!empty($datas)){
        // foreach($datas as $data){
          if(sizeof($datas)){
            foreach($datas as $data){
?>

<div class="col-5 bg-secondary mx-2" style="width: 18rem;" >
  <img  src="image/<?php echo $data['img']; ?>" class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title"><?php echo $data['title']; ?></h5>
    <p class="card-text"><?php echo $data['description']; ?></p>
    <div class="d-flex justify-content-start flex-column w-90" >
    <button class="btn fw-bold mb-2"><?php echo $data['category']; ?></button>
    <a href="edit.php?id=<?php echo $data['id'] ?>" class="btn btn-primary w-100 mx-2 mb-2">Edit</a>

    <form action="" method="post" class=" ">
    <input type="hidden" name="crud_id" value="<?php echo $data['id'] ?>">
    <button type="submit" name="delete" class="btn btn-primary w-100 mx-2">Delete</button>
    </form>
    </div>
  </div>
</div>


<?php
            }
        }
    }else{
        echo"<a href='activity.php' class='btn btn-danger mt-5'>Make Activity</a>";
    }
?>
</div>
</div>
</body>
</html>
