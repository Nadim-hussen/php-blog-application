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
    <title>Home Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>
<body>
    <?php include './component/nav.php' ?>
    <div class="container">
    <form action="" method="post">
    <div class="input-group mb-2 w-50 mx-auto">

      <input type="search" name="search-category" class="form-control rounded " placeholder="Search By Category" aria-label="Search" aria-describedby="search-addon" />
      <button type="submit" name="search" class="btn btn-outline-primary">search</button>

    </div>
    </form>

    <table class="table table-stripedd-flex justify-content-center">
    <thead class="text-center">
    <tr>
      <th scope="col">id</th>
      <th scope="col">Title</th>
      <th scope="col">Category</th>
      <th scope="col">Details</th>

    </tr>
  </thead>

    <?php
        include '../opp/user.php';
        $user = new User();
        $datas = $user->home();
        if(!empty($datas)){
        // foreach($datas as $data){
          if(sizeof($datas)){
            foreach($datas as $data){


    ?>
     <tbody class="text-center">
     <tr>
      <td><?php echo $data['id'] ?></td>
      <td><?php echo $data['title'] ?></td>
      <td><?php echo $data['category'] ?></td>
      <td><a href="details.php?id=<?php echo $data['id'] ?>" class="btn p-1 bg-success">Details</a></td>

  </tbody>
     <?php
      }
    }
    }else{
        echo 'No Data Found';
    }
  ?>
</table>

<a class="btn bg-success" href="home.php">Refresh Data</a>
</div>
</body>
</html>