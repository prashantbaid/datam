<?php
set_time_limit(0);
include('simple_html_dom.php');
$con=mysqli_connect("localhost","root","","webscrap");
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

$result = mysqli_query($con,"SELECT url FROM urls");

while($row = mysqli_fetch_array($result))
  {
  echo sizeof($row);
  $url= $row['url'];
  $html = file_get_html($url);
  foreach($html->find('span') as $element) {
  	if($element->id=='cc_ProfileTitle_name')
  		$name=trim($element->innertext);
  	if($element->id=='cc_ProfileTitle_idValue')
  		$regno=trim($element->innertext);
  	if($element->id=='cc_ProfileTitle_sectionCode')
  		$section=trim($element->innertext);
  }
  foreach($html->find('input') as $element) {
  	if($element->id=='ProfileSummary_gender')
  		$gender=trim($element->value);
  }
  $element=$html->find('td');
  //foreach($html->find('td') as $element) {
  	$sem= trim($element[7]->innertext);
  	foreach($html->find('a') as $element) {
if($element->innertext=='Academic Status') {
	$url2='http://websismit.manipal.edu/'.$element->href;
	$html->clear();
	unset($html);
	$html=file_get_html($url2);
	foreach($html->find('span') as $element) {
		if($element->class=='large-text infobox-data-number')
			$cgpa= trim($element->innertext);
	}
break;
}
}
  
 // }
echo "Name: ".$name."<br>";
echo "Regno: ".$regno."<br>";
echo "Section: ".$section."<br>";
echo "Sem: ".$sem."<br>";
echo "Gender: ".$gender."<br>";
echo "Cgpa: ".$cgpa."<br>";
$sql="INSERT INTO userdata (regno, name, section, gender, sem, cgpa)
VALUES ($regno, '$name','$section','$gender','$sem','$cgpa')";
if (!mysqli_query($con,$sql))
  {
  die('Error: ' . mysqli_error($con));
    echo 'errror!';
  }
echo "1 record added";
}
echo memory_get_usage();
mysqli_close($con);

?>