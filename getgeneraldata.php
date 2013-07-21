<?php
 session_start(); 
header('Content-Type: text/javascript');
 $regno=$_SESSION["regno"];
  $con=mysqli_connect("localhost","root","","webscrap");
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
$result = mysqli_query($con,"SELECT AVG(cgpa) as avgcgpa FROM userdata");
$row = mysqli_fetch_array($result);
$data['avgcgpa']=$row['avgcgpa'];
$result = mysqli_query($con,"SELECT count(gender) as male, avg(cgpa) as malecg FROM userdata WHERE gender='M'");
$row = mysqli_fetch_array($result);
$data['male']=$row['male'];
$data['malecg']=$row['malecg'];
$result = mysqli_query($con,"SELECT avg(cgpa) as femalecg FROM userdata WHERE gender='F'");
$row = mysqli_fetch_array($result);
$data['femalecg']=$row['femalecg'];
$result = mysqli_query($con,"SELECT avg(sem1) as sem1avg, avg(sem2) as sem2avg, avg(sem3) as sem3avg, avg(sem4) as sem4avg,avg(sem5) as sem5avg, avg(sem6)as sem6avg FROM `semwise`");
$row = mysqli_fetch_array($result);
$data['sem1avg']=$row['sem1avg'];
$data['sem2avg']=$row['sem2avg'];
$data['sem3avg']=$row['sem3avg'];
$data['sem4avg']=$row['sem4avg'];
$data['sem5avg']=$row['sem5avg'];
$data['sem6avg']=$row['sem6avg'];



$result = mysqli_query($con,"SELECT regno, MAX(sem1) as maxsem1 FROM `semwise` where sem1=(select max(sem1) from semwise order by sem1)");
$row = mysqli_fetch_array($result);
$data['sem1reg']=$row['regno'];
$data['maxsem1']=$row['maxsem1'];
$reg=$data['sem1reg'];
$result = mysqli_query($con,"SELECT name FROM `userdata` where regno=$reg");
$row = mysqli_fetch_array($result);
$data['sem1name']=$row['name'];

$result = mysqli_query($con,"SELECT regno, MAX(sem2) as maxsem2 FROM `semwise` where sem2=(select max(sem2) from semwise order by sem2)");
$row = mysqli_fetch_array($result);
$data['sem2reg']=$row['regno'];
$data['maxsem2']=$row['maxsem2'];
$reg=$data['sem2reg'];
$result = mysqli_query($con,"SELECT name FROM `userdata` where regno=$reg");
$row = mysqli_fetch_array($result);
$data['sem2name']=$row['name'];

$result = mysqli_query($con,"SELECT regno, MAX(sem3) as maxsem3 FROM `semwise` where sem3=(select max(sem3) from semwise order by sem3)");
$row = mysqli_fetch_array($result);
$data['sem3reg']=$row['regno'];
$data['maxsem3']=$row['maxsem3'];
$reg=$data['sem3reg'];
$result = mysqli_query($con,"SELECT name FROM `userdata` where regno=$reg");
$row = mysqli_fetch_array($result);
$data['sem3name']=$row['name'];

$result = mysqli_query($con,"SELECT regno, MAX(sem4) as maxsem4 FROM `semwise` where sem4=(select max(sem4) from semwise order by sem4)");
$row = mysqli_fetch_array($result);
$data['sem4reg']=$row['regno'];
$data['maxsem4']=$row['maxsem4'];
$reg=$data['sem4reg'];
$result = mysqli_query($con,"SELECT name FROM `userdata` where regno=$reg");
$row = mysqli_fetch_array($result);
$data['sem4name']=$row['name'];

$result = mysqli_query($con,"SELECT regno, MAX(sem5) as maxsem5 FROM `semwise` where sem5=(select max(sem5) from semwise order by sem5)");
$row = mysqli_fetch_array($result);
$data['sem5reg']=$row['regno'];
$data['maxsem5']=$row['maxsem5'];
$reg=$data['sem5reg'];
$result = mysqli_query($con,"SELECT name FROM `userdata` where regno=$reg");
$row = mysqli_fetch_array($result);
$data['sem5name']=$row['name'];

$result = mysqli_query($con,"SELECT regno, MAX(sem6) as maxsem6 FROM `semwise` where sem6=(select max(sem6) from semwise order by sem6)");
$row = mysqli_fetch_array($result);
$data['sem6reg']=$row['regno'];
$data['maxsem6']=$row['maxsem6'];
$reg=$data['sem6reg'];
$result = mysqli_query($con,"SELECT name FROM `userdata` where regno=$reg");
$row = mysqli_fetch_array($result);
$data['sem6name']=$row['name'];



$result = mysqli_query($con,"SELECT avg(cgpa) as secaavg, max(cgpa)as secamax FROM `userdata` WHERE section=\"Section A\" order by cgpa");
$row = mysqli_fetch_array($result);
$data['secaavg']= $row['secaavg'];
$data['secamax']= $row['secamax'];
$maxa=$row['secamax'];
$result = mysqli_query($con,"SELECT name FROM `userdata` WHERE cgpa=(select max(cgpa) from userdata where section=\"Section A\" order by cgpa)");
$row = mysqli_fetch_array($result);
$data['secaname']=$row['name'];

$result = mysqli_query($con,"SELECT avg(cgpa) as secbavg, max(cgpa)as secbmax FROM `userdata` WHERE section=\"Section B\" order by cgpa");
$row = mysqli_fetch_array($result);
$data['secbavg']= $row['secbavg'];
$data['secbmax']= $row['secbmax'];
$maxa=$row['secbmax'];
$result = mysqli_query($con,"SELECT name FROM `userdata` WHERE cgpa=(select max(cgpa) from userdata where section=\"Section B\" order by cgpa)");
$row = mysqli_fetch_array($result);
$data['secbname']=$row['name'];

$result = mysqli_query($con,"SELECT avg(cgpa) as seccavg, max(cgpa)as seccmax FROM `userdata` WHERE section=\"Section C\" order by cgpa");
$row = mysqli_fetch_array($result);
$data['seccavg']= $row['seccavg'];
$data['seccmax']= $row['seccmax'];
$maxa=$row['seccmax'];
$result = mysqli_query($con,"SELECT name FROM `userdata` WHERE cgpa=(select max(cgpa) from userdata where section=\"Section C\" order by cgpa)");
$row = mysqli_fetch_array($result);
$data['seccname']=$row['name'];



// $result = mysqli_query($con,"SELECT cgpa FROM `userdata` order by cgpa");
// $row = mysqli_fetch_array($result);
// $cgpaArr=array();
// $i=0;
// while($row = mysqli_fetch_array($result)) {
// 	$cgpaArr[$i]=$row['cgpa'];
// 	$i++;
// }
// $data['cgpaArr']=$cgpaArr;

$result = mysqli_query($con,"SELECT count(cgpa) as seven FROM `userdata` where cgpa>=7 and cgpa<8");
$row = mysqli_fetch_array($result);
$data['seven']=$row['seven'];

$result = mysqli_query($con,"SELECT count(cgpa) as eight FROM `userdata` where cgpa>=8 and cgpa<9");
$row = mysqli_fetch_array($result);
$data['eight']=$row['eight'];

$result = mysqli_query($con,"SELECT count(cgpa) as nine FROM `userdata` where cgpa>=9");
$row = mysqli_fetch_array($result);
$data['nine']=$row['nine'];

$result = mysqli_query($con,"SELECT count(cgpa) as six FROM `userdata` where cgpa>=6 and cgpa<7");
$row = mysqli_fetch_array($result);
$data['six']=$row['six'];

$result = mysqli_query($con,"SELECT count(cgpa) as five FROM `userdata` where cgpa>=5 and cgpa<6");
$row = mysqli_fetch_array($result);
$data['five']=$row['five'];

$result = mysqli_query($con,"SELECT count(cgpa) as four FROM `userdata` where cgpa>=4 and cgpa<5");
$row = mysqli_fetch_array($result);
$data['four']=$row['four'];

$result = mysqli_query($con,"SELECT count(cgpa) as three FROM `userdata` where cgpa>=3 and cgpa<4");
$row = mysqli_fetch_array($result);
$data['three']=$row['three'];


//print_r($data);
echo $_GET['callback'] . '(' . json_encode($data) . ')';
?>