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
			<!-----------Header Section--------------->
<div id="main-wrapper">
	<div class="website-header">
		<div class=header-content>
			<img src="logo.gif" />
			<br/>
			<font color="#240BAA" face="Colonna MT" style="font-size:50px;">XYZ Public School</font>
			<br/>
			<font color="#240BAA" style="font-size:30px">area , Distt , State - 848xxx</font>
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


<?php
$name = $adm_no = $dob =  $house = $father_name = $mother_name = $address = $category = $locality =$mobile = $email =$gender = $image_name = "";
$err_msg = "";
$flag = 1;
function verify_input($data)
{
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}
/*Search from Database*/
if($_SERVER['REQUEST_METHOD'] == "GET")
{
	foreach($_GET as $key => $value)
	{
		if(empty($value))
		{
			die('<div class=error_msg>Error : No Argument Passed</div>');
		}
	}
	
	
	$adm_no = verify_input($_GET['adm_no']);
	$class  = verify_input($_GET['class']);

	$sql = "SELECT * FROM class_$class WHERE admission_no = '$adm_no'";
	$result = mysqli_query($conn ,$sql);
	
	if(mysqli_num_rows($result) > 0)
	{
		while($row = mysqli_fetch_assoc($result))
		{
			$name		 = $row['name'];
			$dob		 = $row['dob'];
			$father_name = $row['father_name'];
			$mother_name = $row['mother_name'];
			$address	 = $row['address'];
			$category	 = $row['category'];
			$locality	 = $row['locality'];
			$mobile		 = $row['mobile'];
			$email		 = $row['email'];
			$gender		 = $row['gender'];
		}
	}
}
if($_SERVER['REQUEST_METHOD']=='POST')
{
	$name			= verify_input($_POST['name']);
	$dob			= verify_input($_POST['dob']);
	$class			= verify_input($_POST['class']);
	$father_name 	= verify_input($_POST['father_name']);
	$mother_name 	= verify_input($_POST['mother_name']);
	$address 		= verify_input($_POST['address']);
	$locality		= verify_input($_POST['locality']);
	$category		= verify_input($_POST['category']);
	$mobile			= verify_input($_POST['mobile']);
	$email			= verify_input($_POST['email']);
	$gender 		= verify_input($_POST['gender']);
	$adm_no			= verify_input($_POST['adm_no']);
	$adm_no_temp 	= verify_input($_POST['adm_no_temp']);
	
	
	if($flag != 0)
	{
		$sql = "UPDATE class_$class SET 
			name = '$name' ,
			dob ='$dob',
			admission_no = '$adm_no_temp',
			father_name = '$father_name',
			mother_name = '$mother_name',
			address = '$address',
			locality = '$locality',
			category = '$category',
			mobile = '$mobile',
			email = '$email',
			gender = '$gender'
			WHERE admission_no = '$adm_no' ;";
			
		if(mysqli_query($conn ,$sql))
		{
			$err_msg = "<div class=sucess_msg>Congratulation Data Updated </div>";
		}
		else
		{
			$err_msg = "<div class=error_msg>Sorry Data Cannot Updated".mysqli_error($conn)." </div>";
		}
	}
	
}
?>


              
				<!------Body Content Section--------------->

<div id="main-wrapper">
<div id="body-outer-interface">
<h1>Explore Database</h1>
<div class="division-wrapper">

	
	<!--Left body content-->
  			
<div class="left-division">


<div id="content-wrap"><h2>Search Item</h2>
<div class="content" style="padding: 20px">

<span style="color: #D84848; font-weight: bold;" id="msg"></span>
<form id="search" onSubmit="return cheak_data()" method="get" action="search.php">
<input type="text" name="search_value" placeholder="Search"/><br/>
<input value="name" type="radio" checked="checked" name="search_type" />Name
<input value="admission_no" type="radio" name="search_type" />Adm no. <br/>
<input type="submit" value="search" />
</form>

</div>
</div>




<div id="content-wrap"><h2>Extract Data </h2>
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
<input style="margin:5px 0px" type="button" onClick="window.close()" value="Close" />

<div id="content-wrap"><h2>Manipulate Data</h2>
<div class="content" style="padding: 5px">

<div id="err_msg"><?php echo $err_msg; ?></div>



<form method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" id="new_entry" onSubmit="return submit_confirm()">

<table style="border-collapse:collapse" width="100%" class="data_entry">

<tr class="alt">
<td >Name of Student :</td>
<td>
<input type="text" value="<?php echo $name ;?>" name="name" />
</td>
</tr>


<tr>
<td >Date Of Birth [yyyy/mm/dd] :</td>
<td>
<input value="<?php echo $dob ;?>" type="date" name="dob" />
</td>
</tr>


<tr class="alt">
<td >Admission No. :</td>
<td>
<input type="text" value="<?php echo $adm_no ;?>" name="adm_no_temp" />
</td>
</tr>



<tr class="alt">
<td >Father's Name :</td>
<td>
<input value="<?php echo $father_name ;?>" type="text" name="father_name" />
</td>
</tr>


<tr>
<td >Mother's Name :</td>
<td>
<input type="text" value="<?php echo $mother_name ;?>" name="mother_name" />
</td>
</tr>


<tr class="alt">
<td >Address :</td>
<td>
<textarea name="address" ><?php echo $address ;?></textarea>
</td>
</tr>


<tr>
<td >Category :</td>
<td>
<select name="category" >
<option value="<?php echo $category ; ?>" /><?php echo $category.'   ---default---' ; ?>
<option value="General"/>General
<option value="OBC"/>OBC
<option value="SC"/>SC
<option value="ST"/>St
</select>
</td>
</tr>



<tr class="alt">
<td >Locality :</td>
<td>
<select name="locality" >
<option value="<?php echo $locality ; ?>" /><?php echo $locality.'   ---default---' ; ?>
<option value="Rural"/>Rural
<option value="Urban"/>Urban
</select>
</td>
</tr>

<tr>
<td >Mobile Number</td>
<td>
<input value="<?php echo $mobile ; ?>" type="number" maxlength="10" name="mobile" />
</td>
</tr>

<tr class="alt">
<td >Email Address:</td>
<td>
<input value="<?php echo $email ; ?>" type="email" value="" name="email" />
</td>
</tr>

<tr>
<td >Gender:</td>
<td>
<select name="gender">
<option value="<?php echo $gender ; ?>" /><?php echo $gender.'   ---default---' ; ?>
<option value="Male"/>Male
<option value="Female"/>Female
</select>
</td>
</tr>


<tr class="alt">
<td></td><td>
<input name="adm_no" type="hidden" value="<?php echo $adm_no ?>" />
<input name="class" type="hidden" value="<?php echo $class ?>" />
<input type="submit" value="Submit" />
</td>
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
		document.getElementById('msg').innerHTML ="Dont't use blank form";
		return false;
	}
}
///////////////////////////Submittion confirm
function submit_confirm()
{
	var x = document.getElementById('photo_upload').value;
	var len = x.length;
	var z = x.lastIndexOf("\\");
	if((len-z) >20)
	{
		document.getElementById('err_msg').innerHTML ="<div class=warning>WARNING : Name of photo must be less than 20 character </div>";
		return false;
	}
	var form_obj = document.getElementById('new_entry');
	var err_msg ="";
	var count = 0;
	for(i=0;i<form_obj.length;i++)
	{
		if(form_obj.elements[i].name != "email" && form_obj.elements[i].value == "")
		{
			err_msg += form_obj.elements[i].name +", ";
			count++;
		}
	}
	if(count != 0)
	{
		document.getElementById('err_msg').innerHTML ="<div class=warning>WARNING : "+ err_msg +" cannot be empty ! </div>";
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