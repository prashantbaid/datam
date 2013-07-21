<?php session_start(); 
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
             console.log(data);
             $('#name').html(data['name']);
             $('#mycgpa').html('<strong>'+data['mycgpa']+'<strong>');
             $('#relcgpa').html('<strong><i>'+data['avgcg']+'</i></strong>');
             $('#rank').html('<strong>'+data['rank']+'</strong>');
             $('#secrank').html('<strong>'+data['secrank']+'</strong>');
             $('#seccount').html('<strong>'+data['seccount']+'<strong>');
             $('#sec').html(data['mysec']);
             $('#sec2').html(data['mysec']);
             $('#comp').html('<strong>'+data['highc']+'</strong> ('+data['highcgpa']+') and <strong>'+data['lowc']+'</strong> ('+data['lowcgpa']+')');
             $('#pointercount').html('<strong>'+data['cgcount'] + '</strong> '+ parseInt(data['mycgpa']));

        $('#cgpa').highcharts({
            title: {
                text: 'Semester wise CGPA',
                x: -20 //center
            },
            xAxis: {
                categories: ['Semester 1', 'Semester 2', 'Semester 3', 'Semester 4', 'Semester 5', 'Semester 6']
            },
            yAxis: {
                title: {
                    text: 'GPA'
                },
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle',
                borderWidth: 0
            },
            series: [{
                name: 'GPA',
                data: [parseFloat(data['sem1']),parseFloat(data['sem2']),parseFloat(data['sem3']),parseFloat(data['sem4']),parseFloat(data['sem5']),parseFloat(data['sem6'])]
            }]
        });
    


        $('#grade').highcharts({
            chart: {
                type: 'column'
            },
            title: {
                text: 'Grades Distribution'
            },
            xAxis: {
                categories: [
                    'A+',
                    'A',
                    'B',
                    'C',
                    'D',
                    'E',
                    'F',
                    'DT',
                    'I'
                ]
            },
            yAxis: {
                min: 0,
                max: 10,
                title: {
                    text: 'CGPA'
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>{point.y:.2f} </b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [{
                name: 'Grades',
                data: [parseInt(data['grades']['A1']),parseInt(data['grades']['A']),parseInt(data['grades']['B']),parseInt(data['grades']['C']),parseInt(data['grades']['D']),parseInt(data['grades']['E']),parseInt(data['grades']['F']),parseInt(data['grades']['DT']),parseInt(data['grades']['I'])]
    
            }]
        });



  $('#creditgrade').highcharts({
            chart: {
                type: 'column'
            },
            title: {
                text: 'Credit wise grade'
            },
            xAxis: {
                categories: [
                    'A+',
                    'A',
                    'B',
                    'C',
                    'D',
                    'E',
                    'F',
                    'DT',
                    'I'
                ]
            },
            yAxis: {
                min: 0,
                max: 10,
                title: {
                    text: 'CGPA'
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>{point.y:.0f}</b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [{
                name: '4 Credits',
                data: [parseInt(data['four']['A1']),parseInt(data['four']['A2']),parseInt(data['four']['B']),parseInt(data['four']['C']),parseInt(data['four']['D']),parseInt(data['four']['E']),parseInt(data['four']['F']),parseInt(data['four']['DT']),parseInt(data['four']['I'])] 
              },{
                name: '3 Credits',
                data: [parseInt(data['three']['A1']),parseInt(data['three']['A2']),parseInt(data['three']['B']),parseInt(data['three']['C']),parseInt(data['three']['D']),parseInt(data['three']['E']),parseInt(data['three']['F']),parseInt(data['three']['DT']),parseInt(data['three']['I'])] 
              },{
                name: '2 Credits',
                data: [parseInt(data['two']['A1']),parseInt(data['two']['A2']),parseInt(data['two']['B']),parseInt(data['two']['C']),parseInt(data['two']['D']),parseInt(data['two']['E']),parseInt(data['two']['F']),parseInt(data['two']['DT']),parseInt(data['two']['I'])] 
              },{
                name: '1 Credit',
                data: [parseInt(data['one']['A1']),parseInt(data['one']['A2']),parseInt(data['one']['B']),parseInt(data['one']['C']),parseInt(data['one']['D']),parseInt(data['one']['E']),parseInt(data['one']['F']),parseInt(data['one']['DT']),parseInt(data['one']['I'])] 
         
                
    
            }]
        });




$('#gradetable')
  .html('<table class="table table-bordered"style=" margin: 0 auto; width: 300px !important"><tr><td>A+ Grade</td><td>'+data['grades']['A1']+'</td></tr><tr><td>A Grade</td><td>'+data['grades']['A']+'</td></tr><tr><td>B Grade</td><td>'+data['grades']['B']+'</td></tr><tr><td>C Grade</td><td>'+data['grades']['C']+'</td></tr><tr><td>D Grade</td><td>'+data['grades']['D']+'</td></tr><tr><td>E Grade</td><td>'+data['grades']['E']+'</td></tr><tr><td>F Grade</td><td>'+data['grades']['F']+'</td></tr><tr><td>DT Grade</td><td>'+data['grades']['DT']+'</td></tr><tr><td>I Grade</td><td>'+data['grades']['I']+'</td></tr></table>');

$('#creditgradetable')
  .html('<table class="table table-bordered"style=" margin: 0 auto;"><tr><th></th><th>A+ grade</th><th>A grade</th><th>B grade</th><th>C grade</th><th>D grade</th><th>E grade</th><th>F grade</th><th>DT grade</th><th>I grade</th></tr><tr><th>4 credit</th><td>'+data['four']['A1']+'</td><td>'+data['four']['A2']+'</td><td>'+data['four']['B']+'</td><td>'+data['four']['C']+'</td><td>'+data['four']['D']+'</td><td>'+data['four']['E']+'</td><td>'+data['four']['F']+'</td><td>'+data['four']['DT']+'</td><td>'+data['four']['I']+'</td></tr><tr><th>3 credit</th><td>'+data['three']['A1']+'</td><td>'+data['three']['A2']+'</td><td>'+data['three']['B']+'</td><td>'+data['three']['C']+'</td><td>'+data['three']['D']+'</td><td>'+data['three']['E']+'</td><td>'+data['three']['F']+'</td><td>'+data['three']['DT']+'</td><td>'+data['three']['I']+'</td></tr><tr><th>2 credit</th><td>'+data['two']['A1']+'</td><td>'+data['two']['A2']+'</td><td>'+data['two']['B']+'</td><td>'+data['two']['C']+'</td><td>'+data['two']['D']+'</td><td>'+data['two']['E']+'</td><td>'+data['two']['F']+'</td><td>'+data['two']['DT']+'</td><td>'+data['two']['I']+'</td></tr><tr><th>1 credit</th><td>'+data['one']['A1']+'</td><td>'+data['one']['A2']+'</td><td>'+data['one']['B']+'</td><td>'+data['one']['C']+'</td><td>'+data['one']['D']+'</td><td>'+data['one']['E']+'</td><td>'+data['one']['F']+'</td><td>'+data['one']['DT']+'</td><td>'+data['one']['I']+'</td></tr></table>');



           }
         });

      });
</script>
 </head>
  <body>
  <div class="container-narrow">
   <p><h1> Hello <span id="name"></span>,</h1></p>
   <br><br>
   <i>(Note: This data is based on a sample space of 141 students. Some students were not included because their data was unavailable or could not be downloaded)</i>
   <p><table class="table table-striped">
  <tr><td>Your CGPA is <span id="mycgpa" style="color: red;"></span>.</td></tr>
  <tr><td>Your CGPA is <span id="relcgpa"></span> the average cgpa of the whole batch.</td></tr>
  <tr><td>Your rank based on your CGPA is <span id="rank" style="color: red;"></span> out of <strong>141</strong> students.</td></tr>
  <tr><td>Your section rank based on your CGPA is <span id="secrank" style="color: red;"></span> out of <span id="seccount"></span> students in <span id="sec"></span>.</td></tr>
  <tr><td>Your closest competitors in <span id="sec2"></span> are <span id="comp"></span>.</td></tr>
  <tr><td>You are one of the <span id="pointercount"></span> -pointers in IT 7th sem.</td></tr> 
  </table>
  <br><hr><br>
  <div id="cgpa" style="min-width: 400px; height: 400px; margin: 0 auto"></div><br><hr><br>
  <i>(Note: Only grades from 3rd semester onwards were considered for this analysis)</i>
   <div id="grade" style="min-width: 400px; height: 400px; margin: 0 auto"></div><br><br>
   <div id="gradetable"></div>
   <br><hr><br>
     <i>(Note: Only grades from 3rd semester onwards were considered for this analysis)</i>
     <div id="creditgrade" style="min-width: 400px; height: 400px; margin: 0 auto"></div><br><br>
<div id="creditgradetable"></div>
<br><br>
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