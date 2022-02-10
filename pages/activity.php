
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
    <title>Activity</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/activity.css">
</head>
<body>



    <div class="container head-h2 mt-3">
        <div class="d-flex justify-content-center ">
        <a href="profile.php" class="btn bg-info">Go Back</a>
        </div>

        <h2 class="text-center">Your Activity</h2>
    </div>
    <?php
        include '../oop/user.php';
        $user = new User();
        $data = $user->store();
    ?>
    <div class="home-head">
   <div class="home-bottom">
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-title">
            <label for="title">Title &nbsp; : &nbsp;</label>
            <input type="text" name="title" id="title" placeholder="Title" /> <br/>
        </div>
        <div class="form-category">
            <label for="category">Category &nbsp; : &nbsp;</label>
            <input type="text" name="category" id="category" placeholder="Category" /> <br/>
        </div>
        <div class="form-img">
            <label for="img">Image &nbsp; : &nbsp;</label>
            <input type="file" name="uploadfile" id="img" placeholder="images" /> <br/>
        </div>
        <div class="form-description">

            <textarea type="text" name="description"  id="desc" cols="40" rows="15" placeholder="Enter The description of your Post"></textarea>
        </div>
        <button type="submit" name="insert" class="form-btn btn btn-primary">Submit</button>
    </form>

   </div>

</body>
</html>