<?php
    require_once("../_php/conn.php");

    $id = base64_decode($_GET['id']);

      $data = [
        'id' => $id
      ];
      $sql = "SELECT * FROM tblstudents WHERE id = :id";
      $stmt= $conn->prepare($sql);
      $stmt->execute($data);
      $result = $stmt->fetch();
      // echo "<pre>";
      // var_dump($result);
      // die();

    if(isset($_POST['submit']))
    {
      $lname = $_POST['lname'];
      $fname = $_POST['fname'];
      $mname = $_POST['mname'];
      $course = $_POST['course'];

      $data = [
        ':id' => $id,
        ':lname' => $lname,
        ':fname' => $fname,
        ':mname' => $mname,
        ':course' => $course
      ];

      try {
        $sql = "UPDATE tblstudents SET lname=:lname, fname=:fname, mname=:mname, course=:course WHERE id=:id";
        // $sql = "UPDATE tblstudents SET (lname, fname, mname, course) 
        // VALUES (:lname, :fname, :mname, :course) WHERE id=:id";
        $stmt= $conn->prepare($sql);
        $stmt->execute($data);
      } catch(PDOException $e)
      {
        echo $e->getMessage();
    

      }

      header("location:../dashboard");
      
     


    //   $stmt = $conn->prepare("UPDATE tblstudents (lname, fname, mname)
    //                         VALUES (:lname, :fname, :mname) WHERE id=:id");
    // $stmt->bindParam(':lname', $lname);
    // $stmt->bindParam(':fname', $fname);
    // $stmt->bindParam(':mname', $mname);
    // $stmt->execute();
    }
     
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.6">
    <title>Dashboard Template · Bootstrap</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="../_assets/css/customstyle.css">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <!-- Favicons -->
<link rel="apple-touch-icon" href="/docs/4.4/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
<link rel="icon" href="/docs/4.4/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
<link rel="icon" href="/docs/4.4/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
<link rel="manifest" href="/docs/4.4/assets/img/favicons/manifest.json">
<link rel="mask-icon" href="/docs/4.4/assets/img/favicons/safari-pinned-tab.svg" color="#563d7c">
<link rel="icon" href="/docs/4.4/assets/img/favicons/favicon.ico">
<meta name="msapplication-config" content="/docs/4.4/assets/img/favicons/browserconfig.xml">
<meta name="theme-color" content="#563d7c">


    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
    <!-- Custom styles for this template -->
    <link href="dashboard.css" rel="stylesheet">
  </head>
  <body>
    <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">CSU ENROLL</a>
  <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
  <ul class="navbar-nav px-3">
    <li class="nav-item text-nowrap">
      <a class="nav-link" href="#">Sign out</a>
    </li>
  </ul>
</nav>

<div class="container-fluid">
  <div class="row">
    <nav class="col-md-2 d-none d-md-block bg-light sidebar">
      <div class="sidebar-sticky">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link active" href="#">
              <span data-feather="home"></span>
              Dashboard <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="file"></span>
              Orders
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="shopping-cart"></span>
              Products
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="users"></span>
              Customers
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="bar-chart-2"></span>
              Reports
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="layers"></span>
              Integrations
            </a>
          </li>
        </ul>

        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
          <span>Saved reports</span>
          <a class="d-flex align-items-center text-muted" href="#" aria-label="Add a new report">
            <span data-feather="plus-circle"></span>
          </a>
        </h6>
        <ul class="nav flex-column mb-2">
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="file-text"></span>
              Current month
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="file-text"></span>
              Last quarter
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="file-text"></span>
              Social engagement
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="file-text"></span>
              Year-end sale
            </a>
          </li>
        </ul>
      </div>
    </nav>

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
      

     

      <h2 class="mt-5">Section title</h2>
      <div class="table-responsive">
        <div class="container">
        <div class="row">
       
       <div class="col-md-8 offset-2">
         <h4 class="mb-3">New Student</h4>
         <form class="needs-validation" novalidate="" method='post'>
           <div class="row">
             <div class="col-md-4 mb-3">
               <label for="Lastname">Lastname</label>
               <input type="text" class="form-control" name='lname' id="firstName" placeholder="" value="<?php echo $result['lname'] ?>" required="">
               <div class="invalid-feedback">
                 Valid first name is required.
               </div>
             </div>
             <div class="col-md-4 mb-3">
               <label for="firstName">First name</label>
               <input type="text" class="form-control" name='fname' id="firstName" placeholder="" value="<?php echo $result['fname'] ?>" required="">
               <div class="invalid-feedback">
                 Valid first name is required.
               </div>
             </div>
             <div class="col-md-4 mb-3">
               <label for="lastName">Middle name</label>
               <input type="text" class="form-control" name='mname' id="lastName" placeholder="" value="<?php echo $result['mname'] ?>" required="">
               <input type="hidden" class="form-control" name='course' id="lastName" placeholder="" value="<?php echo $result['course'] ?>" required="">
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
           

           
           <hr class="mb-4">
           <button class="btn btn-primary btn-lg btn-block" name='submit' type="submit">Submit</button>
         </form>
       </div>
     </div>
        </div>
        <!-- end container -->
       
      </div>
    </main>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" ></script>
    <script>
    $(document).ready( function () {
        $('#customdt').DataTable();
    } );
    </script>
  </body>
</html>
