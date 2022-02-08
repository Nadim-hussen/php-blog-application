
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
    <title>Edit Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" href="../css/activity.css">
</head>
<body>
<?php
     include '../opp/user.php';
     $user = new User();
     $id = $_REQUEST['id'];
    $update = $user->updateUser();
     $row = $user->details($id);
     if(!empty($row)){
?>
<div class="home-head">
   <div class="home-bottom">
<form action="" method="post" enctype="multipart/form-data">
        <div class="form-title">
            <label for="title">Title &nbsp; : &nbsp;</label>
            <input type="text" name="title" value="<?php echo $row['title'] ?>" id="title" placeholder="Title" /> <br/>
        </div>
        <div class="form-category">
            <label for="category">Category &nbsp; : &nbsp;</label>
            <input type="text" name="category"  value="<?php echo $row['category'] ?>" id="category" placeholder="Category" /> <br/>
        </div>
        <div class="form-img">
            <label for="img">Image &nbsp; : &nbsp;</label>
            <input type="file" name="new_image" id="img" placeholder="images" /> <br/>
            <input type="hidden" name="old_image" value="<?php echo $row['img'] ?>">
        </div>
        <div class="form-description">

            <textarea type="text" name="description" id="desc" cols="40" rows="15" placeholder="Enter The description of your Post">
            <?php echo $row['description'] ?>
            </textarea>
        </div>
        <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
        <button type="submit" name="update" class="form-btn btn btn-primary">Update</button>
    </form>
     </div>
     </div>
    <?php
     }
    ?>
</body>
</html>