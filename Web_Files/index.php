<?php include "config.php"; ?>
<!doctype html>
<html>

<head>
<meta charset="utf-8"> 
<meta name="description" content="School Students Datbase Management System" />
<meta name="author" content="gtm0x" />  
<link rel="stylesheet" type="text/css" href="stylesheet.css" />
<title>Students Database</title>
</head>


<body>
<center>
<?php
$name = $dob = $admission_no = $class = $house = $father_name = $mother_name = $address = $mobile = $email =$gender = $image_name = "";
$report_msg = "";
$flag = 0;

function verify_input($data)
{
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}

if($_SERVER['REQUEST_METHOD']=='POST')
{
	$name			= verify_input($_POST['name']);
	$dob		 	= verify_input($_POST['dob']);
	$class		 	= verify_input($_POST['class']);
	$admission_no	= verify_input($_POST['admission_no']);
	$father_name	= verify_input($_POST['father_name']);
	$mother_name	= verify_input($_POST['mother_name']);
	$address		= verify_input($_POST['address']);
	$locality		= verify_input($_POST['locality']);
	$category		= verify_input($_POST['category']);
	$mobile		 	= verify_input($_POST['mobile']);
	$email		 	= verify_input($_POST['email']);
	$gender			= verify_input($_POST['gender']);
	
	$flag = 1;
	
	/*Verify Inputs from user */
	for($c=6;$c<=12;$c++)
	{
		$sql = "SELECT name FROM class_$c WHERE admission_no ='$admission_no';";
		$result = mysqli_query($conn ,$sql);

		if( mysqli_num_rows($result) > 0 )
		{
			while($row = mysqli_fetch_assoc($result))
			{
				$data		= $row['name'];
				$report_msg	= "<div class=error_msg>You admission no. was alredy exist with name [  $data  ] in class [ $c ]</div>";
				$flag 		= 0;
			}
		}
	}

	/*Insert Data To Its database*/
	if($flag != 0)
	{
		/*---Upload  image---*/
		$temp			= explode(".",$_FILES['photo']['name']);
		$extension		= end($temp);	
		$photo			= $admission_no.".".$extension;
		$img_path		= "photos/".$photo;
		$allowedeEXT	= array("jpg","jpeg");
		
		if(!in_array($extension,$allowedeEXT))
		{
			$report_msg = "<div class=error_msg> Upload only jpg /jpeg file</div>";
			$flag = 0;
		}
		else if($_FILES["photo"]["size"] > 100000 )
		{
			$report_msg = "<div class=error_msg> Size of photo is not more than 100KB </div>";
			$flag = 0;
		}
		else
		{
			move_uploaded_file( $_FILES['photo']['tmp_name'],$img_path);
		}
		
		/*---Insert info into Database---*/
		$sql = "INSERT INTO class_$class VALUES('$name', '$dob', '$admission_no', '$class' , '$father_name', '$mother_name', '$address', '$locality','$category', '$mobile', '$email' ,'$gender','$photo');";
		if(mysqli_query($conn ,$sql))
		{
			$report_msg = "<div class=sucess_msg> Your Information Was Submitted</div>";
		}
		else
		{
			$report_msg = "<div class=error_msg> Your Information couldn't be Submitted".mysqli_error($conn)."</div>";
		}
	}
}
?>
			<!-----------Header Section--------------->
<div id="main-wrapper">
	<div class="website-header">
		<div class=header-content>
			<img src="logo.gif"/>
			<br/>
			<font color="#240BAA" face="Colonna MT" style="font-size:50px;">XYZ Public School</font>
			<br/>
			<font color="#240BAA" style="font-size:30px">Area , Distt , State - 848xxx</font>
			<br/>
			<br/>
			<font color="#22253A" size="4">C.B.S.E. School No. - xxxxx &nbsp; &nbsp; &nbsp; &nbsp; Affiliation No. - xxxxx</font>
		</div>
		<div style="clear:both;"></div>
	</div>
</div>
<!--Welcome Section-->
<div id="main-wrapper">
	<div class="welcome-section">
		<span id="welcome"></span>
	</div>
</div>


				<!------Body Content Section--------------->
				
<div id="main-wrapper">
<div id="body-outer-interface">
<h1>Explore Database</h1>
<div class="division-wrapper">


<!--Left body content-->	
<div class="left-division">

<div id="content-wrap">
<h2>Search Item</h2>
<div class="content">
<span style="color: #D84848; font-weight: bold;" id="msg"></span>
<form id="search" onSubmit="return cheak_data()" method="get" action="search.php">
<input type="text" name="search_value" placeholder="Search"/><br/>
<input value="name" type="radio" checked="checked" name="search_type" />Name
<input value="admission_no" type="radio" name="search_type" />Adm no. <br/>
<input type="submit" value="search" />
</form>
</div>
</div>


<div id="content-wrap">
<h2>Extract Data</h2>
<div class="content" style="padding: 20px">
<div class="link_index" align="center">
<a href="get_data.php?class=6">class 6</a>
<a href="get_data.php?class=7">class 7</a>
<a href="get_data.php?class=8">class 8</a>
<a href="get_data.php?class=9">class 9</a>
<a href="get_data.php?class=10">class 10</a>
<a href="get_data.php?class=11">class 11</a>
<a href="get_data.php?class=12">class 12</a>
</div>
</div>
</div>

</div>



<!--Right body content-->
<div class="right-division">

<div id="content-wrap">
<h2>Enter Students Information</h2>

<div class="content" style="padding: 20px">
<div id="report_msg"><?php echo $report_msg; ?></div>
<form method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" id="new_entry" onSubmit="return submit_confirm()">

<table style="border-collapse:collapse" width="100%" class="data_entry">

<tr class="alt">
<td >Name of Student :</td>
<td>
<input type="text" name="name" />
</td>
</tr>

<tr>
<td >Date Of Birth [yyyy/mm/dd] :</td>
<td>
<input type="date" name="dob" />
</td>
</tr>

<tr class="alt">
<td >Upload a photo (jpg / jpeg below 100 KB) :</td>
<td>
<input id="photo_upload" type="file" name="photo" />
</td>
</tr>

<tr>
<td >Admission no :</td>
<td>
<input type="text" name="admission_no" />
</td>
</tr>

<tr class="alt">
<td >Class </td>
<td>
<select name="class">
<option value="6" />6
<option value="7" />7
<option value="8" />8
<option value="9" />9
<option value="10" />10
<option value="11" />11
<option value="12" />12
</select>
</td>
</tr>


<tr class="alt">
<td >Father's Name :</td>
<td>
<input type="text" name="father_name" />
</td>
</tr>

<tr>
<td >Mother's Name :</td>
<td>
<input type="text" name="mother_name" />
</td>
</tr>

<tr class="alt">
<td >Address :</td>
<td>
<textarea name="address" ></textarea>
</td>
</tr>

<tr>
<td >Category :</td>
<td>
<input type="radio" name="category" value="General" checked="checked"/>GENERAL
<input type="radio" name="category" value="OBC" />OBC
<input type="radio" name="category" value="SC" /> SC
<input type="radio" name="category" value="ST" />ST
</td>
</tr>

<tr class="alt">
<td >Locality :</td>
<td>
<input type="radio" name="locality" value="Rural" checked="checked" />Rural
<input type="radio" name="locality" value="Urban" /> Urban
</td>
</tr>

<tr>
<td >Mobile Number</td>
<td>
<input type="number" maxlength="10" name="mobile" />
</td>
</tr>

<tr class="alt">
<td >Email Address: (optional)</td>
<td>
<input type="email" value="" name="email" />
</td>
</tr>

<tr>
<td >Gender:</td>
<td>
<input type="radio" name="gender" checked="checked" value="Male" />Male
<input type="radio" name="gender" value="Female" />Female
</td>
</tr>

<tr class="alt">
<td></td><td><input type="submit" value="Submit" /></td>
</tr>


</table>
</form>
</div>
</div>
</div>

<div style="clear:both"></div>
</div>	   
</div>
</div>

				<!-------------Footer Content-------------------->
<footer>

<div style="margin-top: 50px; background-color: #737373;">
<div id="main-wrapper">
<div id="website-footer">

<div align="center" class="footer-content">
	<marquee direction="right" behavior="alternate" scrollamount="1">
		<font size="4"> Your Text Here </font>
	</marquee>
</div>

</div>
</div>
</div>

</footer>

<script>
/////////////////////////Search Data validate
function cheak_data()
{
	form_obj = document.getElementById('search');
	temp = form_obj.elements[0].value;
	if(temp == "")
	{
		document.getElementById('msg').innerHTML ="Plese input required value";
		return false;
	}
}
///////////////////////////Submittion confirm
function submit_confirm()
{
	var form_obj = document.getElementById('new_entry');
	var report_msg ="";
	var count = 0;
	for(i=0;i<form_obj.length;i++)
	{
		if(form_obj.elements[i].name != "email" && form_obj.elements[i].value == "")
		{
			report_msg += form_obj.elements[i].name +" / ";
			count++;
		}
	}
	if(count != 0)
	{
		document.getElementById('report_msg').innerHTML ="<div class=warn_msg>WARNING : "+ report_msg +" cannot be empty ! </div>";
		return false;
	}
	else
	{
		var ret = confirm("Do You Really Want To Submit");
		if(ret == true)
		return true;
		else
		return false;
	}
}
</script>

<script language="JavaScript">
var text_array=['W' ,'e' ,'l' ,'c' ,'o' ,'m' ,'e' ,' ' ,'T' ,'o' ,' ' ,'J' ,'N' ,'V' ,' ' ,'S' ,'a' ,'m' ,'a' ,'s' ,'t' ,'i' ,'p' ,'u' ,'r' ,'.' ,'.' ,'.' ,'.' ,'.' ,'.' ,'.' ,' ' ,' ' ,' ' ,' ' ,' ' ,' ' ,' ' ,' ' ,' ' ,' ' ,' ' ,' ' ,' ' ,' ' ,' ' ,' ' ,' ' ,' ' ,' ' ,' ' ,' ' ,' ' ,' ' ,' ' ,' ' ,' ' ,' ' ,' ' ,' ' ,' ' ,' ' ,'|' ,' ' ,'C' ,'o' ,'m' ,'e' ,' ' ,'T' ,'o' ,' ' ,'L' ,'e' ,'a' ,'r' ,'n' ,' ' ,'G' ,'o' ,' ' ,'T' ,'o' ,' ' ,'S' ,'e' ,'r' ,'v' ,'e' ,'.' ,'.' ,'.' ,'.' ,' ' ,' ' ,' ' ,' ' ,' ' ,' ' ,' ' ,' ' ,' ' ,' ' ,' ' ,' ' ,' ' ,' ' ,' ' ,' ' ,' ' ,' ' ,' ' ,' ' ,' ' ,' ' ,' ' ,' ' ,' ' ,' ' ,' ' ,' ' ,' ' ,' ' ,' ' ,' ' ,' ' ,' ' ];
//////////////// Due to string does not support in IE 8 
var c=0;
var obj = document.getElementById("welcome");
function loop_text()
{
	obj.innerHTML+=text_array[c];
	c++;
	if(text_array[c]=='|')
	{
		obj.innerHTML="";
		c++;
	}
	else if(c==text_array.length)
	{
		c=0;
		obj.innerHTML="";
	}
	setTimeout("loop_text()",200);
}      
loop_text();
</script>  

</center>
</body>
</html>