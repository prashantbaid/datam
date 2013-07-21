<?php session_start(); 
if(!isset($_SESSION["authenticated"])) {
  header("Location: index.php");
  exit;
}

?>
<!DOCTYPE html>
<html>
  <head>
    <title>IT 7th Sem Data</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
              <style type="text/css">
      body {
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #f5f5f5;
      }
            .jumbotron {
        margin: 60px 0;
        text-align: center;
      }
      .jumbotron h1 {
        font-size: 48px;
        line-height: 1;
      }
            .container-narrow {
         text-align: center;
        margin: 0 auto;
        max-width: 700px;
        background-color: #fff;
        padding: 19px 29px 29px;
        border: 1px solid #e5e5e5;
                -webkit-border-radius: 5px;
           -moz-border-radius: 5px;
                border-radius: 5px;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
           -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
                box-shadow: 0 1px 2px rgba(0,0,0,.05);

      }
      #links {
      	padding-top:20px;
      	padding-bottom:20px;
      }
      </style>
  </head>
  <body>
  	  <?php
  $regno=$_SESSION["regno"];
  $con=mysqli_connect("localhost","root","","webscrap");
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

$result = mysqli_query($con,"SELECT * FROM userdata where regno=$regno");
$row = mysqli_fetch_array($result);
  ?>
   <div class="container-narrow">
<div class="jumbotron">
    <h1>Hello, <?php echo $row['name'];?>!</h1>
 </div>
 	<table class="table table-bordered">
 <tr>
 	<th>Registration Number</th>
 	<td><?php echo $row['regno']; ?></td>
 </tr>
 <tr>
 	<th>CGPA</th>
 	<td><?php echo $row['cgpa']; ?></td>
 </tr>
 <tr>
 	<th>Section</th>
 	<td><?php echo $row['section']; ?></td>
 </tr>
 <tr>
 	<th>Gender</th>
 	<td><?php  if($row['gender']=="M") echo "Male"; else echo "Female"; ?></td>
 </tr>
</table>
<div id="links">
<a class="btn btn-success" type="button" href="general.php">View General Data</a>
<a class="btn btn-success" type="button" href="personal.php">View Your Data</a>
<a class="btn btn-success" type="button" href="extras.php">Extras</a>
<a class="btn btn-success" type="button" href="exit.php">Exit</a>
</div>
</div>

    <script src="http://code.jquery.com/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
      <br>
  <center><strong>By Prashant Baid</strong></center>  
  </body>
</html>