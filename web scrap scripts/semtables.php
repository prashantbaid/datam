  <?php
  set_time_limit(0);
include('simple_html_dom.php');
  $url='http://websismit.manipal.edu/websis/control/createAnonSession?idValue=100911501&birthDate_i18n=1991-11-31&birthDate=1991-11-31';
  $html = file_get_html($url);
foreach($html->find('a') as $element) {
  if($element->innertext=='Academic Status') {
	  $url2='http://websismit.manipal.edu/'.$element->href;
echo $url2.'<br>';
$html->clear();
unset($html);
$html=file_get_html($url2);
foreach($html->find('a') as $element) {
  //echo $element->plaintext."<br>";
  if($element->innertext=='<span class="sprite">Information Technology Semester 3</span>') {
    $url3='http://websismit.manipal.edu'.$element->href;
$html->clear();
unset($html);
//$url3='http://websismit.manipal.edu/websis/control/StudentAcademicProfile;jsessionid=0B62B8EAB056087D1A2230917B93E483.jvm1?admissionId=11317&productCategoryId=0911-TERM-1&groupCategoryId=09CC-TERM-1';
echo $url3.'<br>';;
$html2=file_get_html($url3);
$j=1;
$i=0;
foreach($html2->find('span') as $element) {
  if($element->id=='cc_TermGradeBookSummary_productName_'.$j) {
    echo $element->innertext.'<br>';;
    $subid[$i]=$element->innertext;
    $i++;
    $j++;
    if($i==9)
      break;
  }
}
break;
  }
}
    break;
  }
}
//for($i=0;$i<sizeof($subid);$i++)
 // / echo $subid[$i]."<br>"; 
?>