<?php
include('simple_html_dom.php');
$url='http://websismit.manipal.edu/websis/control/createAnonSession?idValue=100911553&birthDate_i18n=1992-03-11&birthDate=1992-03-11';
$html = file_get_html($url);
foreach($html->find('a') as $element) {
if($element->innertext=='Academic Status') {
	$url2='http://websismit.manipal.edu/'.$element->href;
	echo $url2;
	$html->clear();
	unset($html);
	$html=file_get_html($url2);
	foreach($html->find('span') as $element) {
		if($element->class=='large-text infobox-data-number')
			echo $element->innertext;
	}
break;
}
}
?>