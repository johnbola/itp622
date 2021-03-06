<?php 
    require_once("../_php/conn.php");

    if(isset($_POST['submit']))
    {
          // Option 1
          // $username = $_POST['username'];
          // $pass = $_POST['pass'];

          // $data = [
          //   'username' => $username,
          //   'pass' => $pass
          // ];
          // $sql = "SELECT * FROM tblusers WHERE username=:username AND password = :pass";
          // $stmt= $conn->prepare($sql);
          // $stmt->execute($data);
          // $result = $stmt->fetch();

          // var_dump($result);
          // die();

          // if($stmt->rowCount() == 1)
          // {
          //     header("location:../dashboard");
          // }

          $username = $_POST['username'];
          $pass =  hash('sha256',$_POST['pass']);

          $data = [
            'username' => $username,
            'pass' => $pass
          ];
          // $sql = "SELECT * FROM tblusers 
          // WHERE username=:username AND password = :pass AND sstatus='approved' ";
          try {
                $sql = "SELECT * FROM tblusers INNER JOIN tblstudents
                ON tblstudents.id = tblusers.useraccountid
                WHERE username=:username AND password = :pass AND sstatus='approved'";

                $stmt= $conn->prepare($sql);
                $stmt->execute($data);
                $result = $stmt->fetch();
          } catch(PDOException $e)
          {
              echo $e->getMessage();
          }
          // echo "<pre>";
          // var_dump($result);
          // die();
          

          if($stmt->rowCount() == 1)
          {
              header("location:../dashboard");
          }

    }

?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>
    
    <div class="container">
        <div class="col-md-4 offset-4 mt-5">
            <form class="form-signin" method='post'>
                <img class="mb-4" src="https://getbootstrap.com/docs/4.0/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
                <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
                <label for="inputEmail" class="sr-only">Email address</label>
                <input type="text" id="inputEmail" class="form-control mb-1" name='username' placeholder="Username" required autofocus>
                <label for="inputPassword" class="sr-only">Password</label>
                <input type="password" id="inputPassword" name='pass' class="form-control mb-1" placeholder="Password" required>
               
                <button class="btn btn-sm btn-primary btn-block mb-2" name='submit' type="submit">Sign in</button>
                <a href="../register" class="btn btn-sm btn-warning btn-block">Register</a>
                <p class="mt-5 mb-3 text-muted">&copy; 2017-2018</p>
            </form>
        </div> 
        <!-- end col md 6 -->
    </div>
    <!-- end container -->
    

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>