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
        max-width: 800px;
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

        <script src="http://code.jquery.com/jquery.js"></script>
        <script src="http://code.highcharts.com/highcharts.js"></script>
<script src="http://code.highcharts.com/modules/exporting.js"></script>
<script src="js/bootstrap.min.js"></script>
<script>
      $(document).ready(function() {
          var url="getpersonaldata.php";
          $.ajax({
            type: "GET",
            url: url,
            crossDomain: true,
            dataType: 'jsonp',
            success: function(data) {
            }
          });
        });
</script>
 </head>
  <body>
  <div class="container-narrow">
    <h3>Some interesting statistics</h3>
    <hr>
    <table class="table table-striped">
      <tr><td>The top 3 students in IT are all from Section C</td></tr>
      <tr><td>Average cgpa of students who came to IT after branch change is 7.23</td></tr>
      <tr><td>Average cgpa of students excluding branch change students is 6.94</td></tr>
      <tr><td>Average cgpa excluding top 10 students is 6.85. Including them, it is 7.00.</td></tr>
      <tr><td>Average cgpa excluding bottom 10 students is 7.20. Including them, it is 7.00.</td></tr>
      <tr><td>Based on average cgpa, both boys and girls of Section C are smarter than boys and girls of other sections "respectively".</td></tr>
      <tr><td>Section B has more 7+ pointers(27) than any other section. Section C has the least(23).</td></tr>
      <tr><td>More than 74% of girls in IT have above 7 cgpa while only less than 42% of boys have above 7 cgpa.</td></tr>
      <tr><td>Girls initially in IT have better average cgpa(7.67) than girls who came after branch change(7.42). While boys who came after branch change have much better average cgpa(7.13) than initial IT boys(6.56).</td></tr>
      <tr><td>Section C has the most 6 pointers(18) in IT and the least below 6 pointers(7) in IT.</tr></td>
      <tr><td>Highest cgpa of a Male in Section A is 8.54 while highest cgpa of a Male in both the other sections are well above 9</td></tr>
    </table>
    <br><hr><br>
<h3>Some FAQS</h3>
<table class="table table-striped">
  <tr><td>
<strong>Q) Do these results include all the students in 7th sem IT?</strong>
</td></tr>
<tr><td>No, all the students were not included. Data of some students were not available or could not be downloaded. Results are based on sample space of 141 students. But if your data is available on websis portal and you are not listed here, then <a href="mailto:prashantvbaid@gmail.com">email me</a> your websis portal log in credentials. I will add your data.</td></tr>
</table>
<table class="table table-striped">
  <tr><td>
<strong>Q) Can I download this data?</strong>
</td></tr>
<tr><td>Yes, you absolutely can. Here is the <a href="db.sql">.sql</a> of all the data that I downloaded from websis portal. Create your own data analysis and statistics from this data. I am sure there are better minds here who can create better results from this data.</td></tr>
</table>
<table class="table table-striped">
  <tr><td>
<strong>Q)Can I see your code?</strong>
</td></tr>
<tr><td>Yes, in fact, I insist you do. The code is available on <a href="">Github</a>. I could not find time to document the code properly so if you have any doubts or questions regarding the code do <a href="mailto:prashantvbaid@gmail.com">email me</a>. I will be happy to help you :)</td></tr>
</table>
<table class="table table-striped">
  <tr><td>
<strong>Q)Which is the most successful English team in Europe?</strong>
</td></tr>
<tr><td style="color: red;">Liverpool FC.</td></tr>
</table>

<div id="links">
<a class="btn btn-success" type="button" href="general.php">View General Data</a>
<a class="btn btn-success" type="button" href="personal.php">View Your Data</a>
<a class="btn btn-success" type="button" href="extras.php">Extras</a>
<a class="btn btn-success" type="button" href="exit.php">Exit</a>
</div>
 </div>   
   <br>
  <center><strong>By Prashant Baid</strong></center>  
  </body>
</html>