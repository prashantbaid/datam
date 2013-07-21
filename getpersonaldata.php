<?php
 session_start(); 
header('Content-Type: text/javascript');
 $regno=$_SESSION["regno"];
  $con=mysqli_connect("localhost","root","","webscrap");
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

$result = mysqli_query($con,"SELECT section, name,cgpa FROM userdata where regno=$regno");
$row = mysqli_fetch_array($result);
$sec=$row['section'];
$data['name']=$row['name'];
$cg=$row['cgpa'];
$data['mycgpa']=$row['cgpa'];
$data['mysec']=$sec;

$i=0;
$result = mysqli_query($con,"SELECT regno, name FROM userdata order by cgpa desc");
$row = mysqli_fetch_array($result);

while($row = mysqli_fetch_array($result)){
	$i++;
	if($regno==$row['regno'])
		break;
}
$data['rank']=$i;

$i=0;
$result = mysqli_query($con,"SELECT regno, name FROM userdata where section='$sec' order by cgpa desc");
while($row = mysqli_fetch_array($result)){
	$i++;
	if($regno==$row['regno'])
		break;
}
$data['secrank']=$i;

$result = mysqli_query($con,"SELECT cgpa, name FROM userdata where cgpa=(select min(cgpa) from userdata where section='$sec' and cgpa>$cg order by cgpa)");
$row = mysqli_fetch_array($result);
$data['highc']=$row['name'];
$data['highcgpa']=$row['cgpa'];

$result = mysqli_query($con,"SELECT cgpa, name FROM userdata where cgpa=(select max(cgpa) from userdata where section='$sec' and cgpa<$cg order by cgpa)");
$row = mysqli_fetch_array($result);
$data['lowc']=$row['name'];
$data['lowcgpa']=$row['cgpa'];

$result = mysqli_query($con,"SELECT count(*) as seccount FROM userdata where section='$sec'");
$row = mysqli_fetch_array($result);
$data['seccount']=$row['seccount'];


$result = mysqli_query($con,"SELECT avg(cgpa) as avgcgpa FROM userdata order by cgpa");
$row = mysqli_fetch_array($result);
$avgcgpa=$row['avgcgpa'];

$result = mysqli_query($con,"SELECT cgpa FROM userdata where regno=$regno");
$row = mysqli_fetch_array($result);
if($row['cgpa']>$avgcgpa)
	$data['avgcg']="above";
else
	$data['avgcg']="below";
$low=intval($row['cgpa']);
$high=$low++;
$result = mysqli_query($con,"SELECT count(cgpa) as cgcount FROM userdata where cgpa>=$high and cgpa<$low");
$row = mysqli_fetch_array($result);
$data['cgcount']=$row['cgcount'];

$result = mysqli_query($con,"SELECT * FROM semwise where regno=$regno");
$row = mysqli_fetch_array($result);
$data['sem1']=$row['sem1'];
$data['sem2']=$row['sem2'];
$data['sem3']=$row['sem3'];
$data['sem4']=$row['sem4'];
$data['sem5']=$row['sem5'];
$data['sem6']=$row['sem6'];

$result = mysqli_query($con,"SELECT * FROM allsemester where regno=$regno");
$row = mysqli_fetch_array($result);
	$j=1;
	$a1=0;$a=0;$b=0;$c=0;$d=0;$e=0;$f=0;$dt=0;$ill=0;$one=0;$two=0;$three=0;$four=0;
	for($i=0;$i<33;$i++) {
		$split=explode("-",$row['s'.$j]);
		if($split[0]=="A1")
			$a1++;
		if($split[0]=="A") {
			$a++;
			$split[0]="A2";
		}
		if($split[0]=="B")
			$b++;
		if($split[0]=="C")
			$c++;
		if($split[0]=="D")
			$d++;
		if($split[0]=="E")
			$e++;
		if($split[0]=="F")
			$f++;
		if($split[0]=="DT")
			$dt++;
		if($split[0]=="I")
			$ill++;

		if($split[1]=="4")
			$arr4[$four++]=$split[0];
		if($split[1]=="3")
			$arr3[$three++]=$split[0];
		if($split[1]=="2")
			$arr2[$two++]=$split[0];
		if($split[1]=="1")
			$arr1[$one++]=$split[0];
		$j++;
	}
	$grades=['A1'=>$a1,'A'=>$a,'B'=>$b,'C'=>$c,'D'=>$d,'E'=>$e,'F'=>$f,'DT'=>$dt,'I'=>$ill];
	$four=array_count_values($arr4);
	$three=array_count_values($arr3);
	$two=array_count_values($arr2);
	$one=array_count_values($arr1);
	//$arr1=[$four,$three,$two,$one];
	$arr2=['A1','A2','B','C','D','E','F','DT','I'];
	//for($i=0;$i<sizeof($arr1);$i++) { 
	for($j=0;$j<sizeof($arr2);$j++) {
		if (!array_key_exists($arr2[$j], $four)) {
			//echo "inside if";
			$four[$arr2[$j]]=0;
			//print_r($arr2[$j]);
		}
	}
		for($j=0;$j<sizeof($arr2);$j++) {
		if (!array_key_exists($arr2[$j], $three)) {
			//echo "inside if";
			$three[$arr2[$j]]=0;
			//print_r($arr2[$j]);
		}
	}
		for($j=0;$j<sizeof($arr2);$j++) {
		if (!array_key_exists($arr2[$j], $two)) {
			//echo "inside if";
			$two[$arr2[$j]]=0;
			//print_r($arr2[$j]);
		}
	}
		for($j=0;$j<sizeof($arr2);$j++) {
		if (!array_key_exists($arr2[$j], $one)) {
			//echo "inside if";
			$one[$arr2[$j]]=0;
			//print_r($arr2[$j]);
		}
	}
//}
	$data['grades']=$grades;
	$data['one']=$one;
	$data['two']=$two;
	$data['three']=$three;
	$data['four']=$four;
	//echo "<pre>";
//print_r($data);
//echo "</pre>";
echo $_GET['callback'] . '(' . json_encode($data) . ')';
?>