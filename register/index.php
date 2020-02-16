<?php 
     
    require_once("../_php/conn.php");


    //random hex

    function random_strings($length_of_string) 
    { 
    
        // String of all alphanumeric character 
        $str_result = '123456789ABCDEFGHIJKLMNPQRSTUVWXYZabcdefghijklmnpqrstuvwxyz'; 
    
        // Shufle the $str_result and returns substring 
        // of specified length 
        return substr(str_shuffle($str_result),  
                        0, $length_of_string); 
    } 




    if(isset($_POST['submit']))
    {
        //declaration init
        $lname = $_POST['lname'];
        $fname = $_POST['fname'];
        $mname = $_POST['mname'];
        $username = $_POST['username'];
        $pass =  hash('sha256',$_POST['pass']);
        
      

        $data = [
            'lname' => $lname,
            'fname' => $fname,
            'mname' => $mname,
        ];
        $sql = "INSERT INTO tblstudents (lname, fname, mname) VALUES (:lname, :fname, :mname)";
        $stmt= $conn->prepare($sql);
        $stmt->execute($data);

        $lastid = $conn->lastInsertId(); 
    
        $data = [
            'username' => $username,
            'pass' => $pass,
            'fid' => $lastid,
        ];
        $sql = "INSERT INTO tblusers (useraccountid, username, password) VALUES (:fid, :username, :pass)";
        $stmt= $conn->prepare($sql);
        $stmt->execute($data);

         if($stmt->rowCount() == 1)
         {
             header("location:../login");
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
      <div class="py-5 text-center">
        <img class="d-block mx-auto mb-4" src="https://getbootstrap.com/docs/4.0/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
        <h2>New Student Application</h2>
        <p class="lead"></p>
      </div>

      <div class="row">
       
        <div class="col-md-8 offset-2">
          <h4 class="mb-3">New Student</h4>
          <form class="needs-validation" novalidate="" method='post'>
            <div class="row">
              <div class="col-md-4 mb-3">
                <label for="Lastname">Lastname</label>
                <input type="text" class="form-control" name='lname' id="firstName" placeholder="" value="" required="">
                <div class="invalid-feedback">
                  Valid first name is required.
                </div>
              </div>
              <div class="col-md-4 mb-3">
                <label for="firstName">First name</label>
                <input type="text" class="form-control" name='fname' id="firstName" placeholder="" value="" required="">
                <div class="invalid-feedback">
                  Valid first name is required.
                </div>
              </div>
              <div class="col-md-4 mb-3">
                <label for="lastName">Middle name</label>
                <input type="text" class="form-control" name='mname' id="lastName" placeholder="" value="" required="">
                <div class="invalid-feedback">
                  Valid last name is required.
                </div>
              </div>
            </div>

            <div class="mb-3">
              <label for="username">Username</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">@</span>
                </div>
                <input type="text" class="form-control" id="username" name='username' placeholder="Username" required="">
                <div class="invalid-feedback" style="width: 100%;">
                  Your username is required.
                </div>
              </div>
            </div>

            <div class="mb-3">
              <label for="username">Password</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">*</span>
                </div>
                <input type="password" class="form-control" name='pass' id="username" placeholder="Password" required="">
                <div class="invalid-feedback" style="width: 100%;">
                  Your username is required.
                </div>
              </div>
            </div>
            <div class="mb-3">
              <label for="username">Invite Code</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">@</span>
                </div>
                <input type="text" class="form-control" id="username" name='username' value="<?php echo date("dmYhis") . strtoupper(random_strings(10)); ?>" required="">
                <div class="invalid-feedback" style="width: 100%;">
                  Your username is required.
                </div>
              </div>
            </div>

            
            <hr class="mb-4">
            <button class="btn btn-primary btn-lg btn-block" name='submit' type="submit">Submit</button>
          </form>
        </div>
      </div>

      <footer class="my-5 pt-5 text-muted text-center text-small">
        <p class="mb-1">© 2017-2018 Company Name</p>
        <ul class="list-inline">
          <li class="list-inline-item"><a href="#">Privacy</a></li>
          <li class="list-inline-item"><a href="#">Terms</a></li>
          <li class="list-inline-item"><a href="#">Support</a></li>
        </ul>
      </footer>
    </div>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>