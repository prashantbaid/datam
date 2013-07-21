<?php 
set_time_limit(0);
include('simple_html_dom.php');
$con=mysqli_connect("localhost","root","","webscrap");
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
$result = mysqli_query($con,"SELECT url FROM urls");
$flag=0;
$p=0;
//while($row = mysqli_fetch_array($result)) {
 $url='http://websismit.manipal.edu/websis/control/createAnonSession?idValue=100911501&birthDate_i18n=1991-11-31&birthDate=1991-11-31';
//  $p++;
  //if($p==66)
  //  $flag=1;
  //if($flag==1)
   //{
	//$url=$row['url'];
  $html = file_get_html($url);
    foreach($html->find('span') as $element) {
      if($element->id=='cc_ProfileTitle_idValue') {
      $regno=trim($element->innertext);
      break;
    }
  }
  foreach($html->find('input') as $element) {
    if($element->id=='ProfileTitle_partyId') {
      $id=$element->value;
      break;
    }
}
foreach($html->find('a') as $element) {
  if($element->innertext=='Academic Status') {
	  $url2='http://websismit.manipal.edu/'.$element->href;
	  $html->clear();
	  unset($html);
	  break;
	}
}
//echo $url2.'<br>';
$i=0;
$n=0;
for($f=3;$f<7;$f++) {
$url=$url2.'?admissionId='.$id.'&productCategoryId=0911-TERM-'.$f;
$html = file_get_html($url);
// foreach($html->find('a') as $element) {
// 	if($element->innertext=='<span class="sprite">Information Technology Semester 1</span>') {
//     	$url='http://websismit.manipal.edu'.$element->href;
// 	  	$html->clear();
// 	  	unset($html);
// 	  	break;
// 	}
// }   
$j=1;
$m=1;
//$i=0;
//echo $url.'<br>';
$html = file_get_html($url);
foreach($html->find('span') as $element) {
	if($element->id=='cc_TermGradeBookSummary_pfinalResult_'.$j) {
    	$ele=trim($element->innertext);
      echo $ele;
      if($ele=="A&#43;") {
        $ele="A1";
        echo "changed";
      }
      $grade[$i]=$ele;
    	$i++;
    	$j++;
    }
    if($element->id=='cc_TermGradeBookSummary_credit_'.$m) {
      $elem=trim($element->innertext);
      $credit[$n]=$elem;
      $n++;
      $m++;
    }
}
}
for($i=0;$i<sizeof($grade);$i++){
  $gradecredit[$i]=$grade[$i].'-'.$credit[$i];
}
//print_r($gradecredit);
//print_r($credit);

$sql="INSERT INTO allsemester(regno,s1,s2,s3,s4,s5,s6,s7,s8,s9,s10,s11,s12,s13,s14,s15,s16,s17,s18,s19,s20,s21,s22,s23,s24,s25,s26,s27,s28,s29,s30,s31,s32,s33) VALUES ($regno,'$gradecredit[0]','$gradecredit[1]','$gradecredit[2]','$gradecredit[3]','$gradecredit[4]','$gradecredit[5]','$gradecredit[6]','$gradecredit[7]','$gradecredit[8]','$gradecredit[9]','$gradecredit[10]','$gradecredit[11]','$gradecredit[12]','$gradecredit[13]','$gradecredit[14]','$gradecredit[15]','$gradecredit[16]','$gradecredit[17]','$gradecredit[18]','$gradecredit[19]','$gradecredit[20]','$gradecredit[21]','$gradecredit[22]','$gradecredit[23]','$gradecredit[24]','$gradecredit[25]','$gradecredit[26]','$gradecredit[27]','$gradecredit[28]','$gradecredit[29]','$gradecredit[30]','$gradecredit[31]','$gradecredit[32]')";
//echo $sql;
// Execute query
unset($gradecredit);
if (mysqli_query($con,$sql))
  {
  echo "Table persons created successfully";
  }
else
  {
  echo "Error creating table: " . mysqli_error($con);
  }
//}
//}
mysqli_close($con);
