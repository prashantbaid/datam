<?php session_start(); 
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Data Porn</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <script src="js/bootstrap.js"></script>
    <!-- Le styles -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 200px;
        padding-bottom: 40px;
        background-color: #f5f5f5;
      }

      .form-signin {
        max-width: 300px;
        padding: 19px 29px 29px;
        margin: 0 auto 20px;
        background-color: #fff;
        border: 1px solid #e5e5e5;
        -webkit-border-radius: 5px;
           -moz-border-radius: 5px;
                border-radius: 5px;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
           -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
                box-shadow: 0 1px 2px rgba(0,0,0,.05);
      }
     input[type="text"], .span2 {
    width: 30px;
}
    </style>
    <link href="css/bootstrap-responsive.css" rel="stylesheet">
  </head>
  


  <body>
    <div class="container">
       <form class="form-inline form-signin" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<?php
$error="";
if (isset($_POST["regno"])) {
$con=mysqli_connect("localhost","root","","webscrap");
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
$regno='100911'.$_POST['regno'];
$sql="SELECT regno FROM userdata where regno=$regno";
$result = @mysqli_query($con,$sql);
$row_count=mysqli_num_rows($result);

if($row_count>0) {
  $_SESSION["regno"] = $regno;
  $_SESSION["authenticated"] = TRUE;
    header("Location: home.php");
} 
  $error="Incorrect Registration Number!";
}
?>   
     
        <h6 class="form-signin-heading" style="text-align:center;">Enter your Registration No.</h6>
        <center><div class="input-prepend input-append">
        <span class="add-on">100911</span>
        <input class="input-mini" id="appendedInputButton" type="text" maxlength="3" name="regno" size="3">
        <button class="btn" type="submit">Submit</button>
         </div>
         <p style="padding-top:5px; opacity:0.8;font-size:12px;"><i>(Example: 520)</i></p>
         <p style="color:red;"><?php echo '<br>'.$error; ?></p>
      </center>
      

</form>
    </div> <!-- /container -->
  <br>
  <center><strong>By Prashant Baid</strong></center>  
  </body>
</html>
