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
          var url="getgeneraldata.php";
          $.ajax({
            type: "GET",
            url: url,
            crossDomain: true,
            dataType: 'jsonp',
            success: function(data) {
             console.log(data);
             $(function () {
    $('#cgpa').highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false
        },
        title: {
            text: 'CGPA Division pointer-wise'
        },
        tooltip: {
          pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    color: '#000000',
                    connectorColor: '#000000',
                    format: '<b>{point.name}</b>: {point.percentage:.1f}%'
                }
            }
        },
        series: [{
            type: 'pie',
            name: 'CGPA Division',
            data: [
                ['9 pointers',   parseInt(data['nine'])],
                ['8 Pointers',       parseInt(data['eight'])],
                ['7 pointers',       parseInt(data['seven'])],
                {
                    name: '6 pointers',
                    y: parseInt(data['six']),
                    sliced: true,
                    selected: true
                },
                ['5 pointers',    parseInt(data['five'])],
                ['4 pointers',    parseInt(data['four'])],
                ['3 pointers',   parseInt(data['three'])]
            ]
        }]
    });
  $('#gender').highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false
        },
        title: {
            text: 'Gender Division'
        },
        tooltip: {
          pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    color: '#000000',
                    connectorColor: '#000000',
                    format: '<b>{point.name}</b>: {point.percentage:.1f}%'
                }
            }
        },
        series: [{
            type: 'pie',
            name: 'Gender Division',
            data: [
                ['Boys',   parseInt(data['male'])],
                {
                    name: 'Girls',
                    y: 141-parseInt(data['male']),
                    sliced: true,
                    selected: true
                }
            ]
        }]
    });

        $('#gendercgpa').highcharts({
            chart: {
                type: 'column'
            },
            title: {
                text: 'Average CGPA gender wise'
            },
            xAxis: {
                categories: [
                    'Male',
                    'Female'
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
                name: 'CGPA',
                data: [parseFloat(data['malecg']),parseFloat(data['femalecg'])]
    
            }]
        });
 
        $('#semwisecgpa').highcharts({
            chart: {
                type: 'column'
            },
            title: {
                text: 'Average and Highest CGPA per Semester'
            },
            xAxis: {
                categories: [
                    'Semester 1',
                    'Semester 2',
                    'Semester 3',
                    'Semester 4',
                    'Semester 5',
                    'Semester 6'
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
                    '<td style="padding:0"><b>{point.y:.2f}</b></td></tr>',
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
                name: 'Average CGPA',
                data: [parseFloat(data['sem1avg']),parseFloat(data['sem2avg']),parseFloat(data['sem3avg']),parseFloat(data['sem4avg']),parseFloat(data['sem5avg']),parseFloat(data['sem6avg'])] 
              },{
                name: 'Highest CGPA',
                data: [parseFloat(data['maxsem1']),parseFloat(data['maxsem2']),parseFloat(data['maxsem3']),parseFloat(data['maxsem4']),parseFloat(data['maxsem5']),parseFloat(data['maxsem6'])]
                
    
            }]
        });
   $('#secwisecgpa').highcharts({
            chart: {
                type: 'column'
            },
            title: {
                text: 'Average and Highest CGPA section wise'
            },
            xAxis: {
                categories: [
                    'Section A',
                    'Section B',
                    'Section C'
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
                    '<td style="padding:0"><b>{point.y:.2f}</b></td></tr>',
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
                name: 'Average CGPA',
                data: [parseFloat(data['secaavg']),parseFloat(data['secbavg']),parseFloat(data['seccavg'])] 
              },{
                name: 'Highest CGPA',
                data: [parseFloat(data['secamax']),parseFloat(data['secbmax']),parseFloat(data['seccmax'])]
                
    
            }]
        });
   
});
var female=141-parseInt(data['male']);
$('#cgpatable')
  .html('<tr><td>9 pointers</td><th>'+data['nine']+'</th></tr><tr><td>8 pointers</td><th>'+data['eight']+'</th></tr><tr><td>7 pointers</td><th>'+data['seven']+'</th></tr><tr><td>6 pointers</td><th>'+data['six']+'</th></tr><tr><td>5 pointers</td><th>'+data['five']+'</th></tr><tr><td>4 pointers</td><th>'+data['four']+'</th></tr><tr><td>3 pointers</td><th>'+data['three']+'</th></tr><tr class="info"><th>Total</th><th>141</th></tr>');
$('#gendertable')
  .html('<table class="table table-bordered"style=" margin: 0 auto; width: 300px !important"><tr><td>Boys</td><th>'+data['male']+'</th></tr><tr><td>Girls</td><th>'+female+'</th></tr><tr class="info"><th>Total</th><th>141</th></tr></table>');
  $('#gendercgpatable')
  .html('<table class="table table-bordered"style=" margin: 0 auto; width: 300px !important"><tr><th colaspan="100">Average CGPA gender wise</th></tr><tr><td>Boys</td><th>'+(parseFloat(data['malecg'])).toFixed(2)+'</th></tr><tr><td>Girls</td><th>'+(parseFloat(data['femalecg'])).toFixed(2)+'</th></tr></table>');
    $('#semwiseavg')
  .html('<table class="table table-bordered" style=" margin: 0 auto;"><tr><td>#</td><th>Semester 1</th><th>Semester 2</th><th>Semester 3</th><th>Semester 4</th><th>Semester 5</th><th>Semester 6</th></tr><tr><th>Average CGPA</th><td>'+(parseFloat(data['sem1avg'])).toFixed(2)+'</td><td>'+(parseFloat(data['sem2avg'])).toFixed(2)+'</td><td>'+(parseFloat(data['sem3avg'])).toFixed(2)+'</td><td>'+(parseFloat(data['sem4avg'])).toFixed(2)+'</td><td>'+(parseFloat(data['sem5avg'])).toFixed(2)+'</td><td>'+(parseFloat(data['sem6avg'])).toFixed(2)+'</td></tr><tr><th>Highest CGPA</th><td>'+(parseFloat(data['maxsem1'])).toFixed(2)+'</td><td>'+(parseFloat(data['maxsem2'])).toFixed(2)+'</td><td>'+(parseFloat(data['maxsem3'])).toFixed(2)+'</td><td>'+(parseFloat(data['maxsem4'])).toFixed(2)+'</td><td>'+(parseFloat(data['maxsem5'])).toFixed(2)+'</td><td>'+(parseFloat(data['maxsem6'])).toFixed(2)+'</td></tr><tr style="font-size:11px;"><th style="font-size:14px">Topper</th><td>'+data['sem1name']+'</td><td>'+data['sem2name']+'</td><td>'+data['sem3name']+'</td><td>'+data['sem4name']+'</td><td>'+data['sem5name']+'</td><td>'+data['sem6name']+'</td></tr></table>');
     $('#secwiseavg')
  .html('<table class="table table-bordered" style=" margin: 0 auto;"><tr><td>#</td><th>Section A</th><th>Section B</th><th>Section C</th></tr><tr><th>Average CGPA</th><td>'+(parseFloat(data['secaavg'])).toFixed(2)+'</td><td>'+(parseFloat(data['secbavg'])).toFixed(2)+'</td><td>'+(parseFloat(data['seccavg'])).toFixed(2)+'</td></tr><tr><th>Highest CGPA</th><td>'+(parseFloat(data['secamax'])).toFixed(2)+'</td><td>'+(parseFloat(data['secbmax'])).toFixed(2)+'</td><td>'+(parseFloat(data['seccmax'])).toFixed(2)+'</td></tr><tr style="font-size:14px;"><th style="font-size:14px">Topper</th><td>'+data['secaname']+'</td><td>'+data['secbname']+'</td><td>'+data['seccname']+'</td></tr></table>');
            }
          });
      });
      </script>
  </head>
  <body>
  <div class="container-narrow">
    <h4>IT 7th Sem Data Analysis</h4>
    <i>(Note: This data is based on a sample space of 141 students. Some students were not included because their data was unavailable or could not be downloaded)</i>
<div id="cgpa" style="min-width: 500px; height: 400px; margin: 0 auto"></div><br><br>
<table class="table table-bordered" id="cgpatable" style="width: 400px !important; margin: 0 auto"></table><br><hr><br>
<div class="row">
<div id="gender" style="width: 350px; height: 300px;" class="span6"></div>
<div id="gendercgpa" style="width: 350px; height: 300px;" class="span6"></div>
</div>
<br><br>
<div class="row">
<div class="span6" id="gendertable" style="width: 350px;"></div>
<div class="span6" id="gendercgpatable" style="width: 350px;"></div>
</div>
<br><hr><br>
<div id="semwisecgpa" style="min-width: 500px; height: 400px; margin: 0 auto"></div><br><br>
<div id="semwiseavg"></div>
<br><hr><br>
<div id="secwisecgpa" style="min-width: 500px; height: 400px; margin: 0 auto"></div><br><br>
<div id="secwiseavg"></div>
<br><br>
<div id="links">
<a class="btn btn-success" type="button" href="general.php">View General Data</a>
<a class="btn btn-success" type="button" href="personal.php">View Your Data</a>
<a class="btn btn-success" type="button" href="extras.php">Extras</a>
<a class="btn btn-success" type="button" href="exit.php">Exit</a>
</div>
  </div>
    
  </body>
</html>
