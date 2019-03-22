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

              
				<!------Body Content Section--------------->

<div id="main-wrapper">
<div id="body-outer-interface">
<h1>Explore Database</h1>
<div class="division-wrapper">

	



	<!--full body content-->

<div class="full_body">
<input style="margin:5px 0px" type="button" onClick="window.close()" value="Close" />


<?php
$err_msg = "<div class=error_msg>Sorry No Data Found</div>";
function verify_input($data)
{
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}
/*Search from database*/
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
	$class = verify_input($_GET['class']);
	
	/*display and delete table*/
	
	$sql = "SELECT name,dob,house,admission_no,mobile,email,gender,image FROM class_$class WHERE admission_no='$adm_no';";
	$retval = mysqli_query($conn, $sql);
	
	while($row = mysqli_fetch_assoc($retval))
	{
		echo "<table class=data_list><tr><th>Name</th><th>DOB</th><th>Admission no.</th><th>House </th><th>Mobile</th><th>Email</th><th>Gender</th></tr>";
		echo "<tr>
		<td>{$row['name']}</td>
		<td>{$row['dob']}</td>
		<td>{$row['admission_no']}</td>
		<td>{$row['house']}</td>
		<td>{$row['mobile']}</td>
		<td>{$row['email']}</td>
		<td>{$row['gender']}</td>
		</tr>";
		
		$temp_pic = "photos/".$row['image'];
		if(!unlink($temp_pic))
		{
			echo "<tr><td colspan=7><div class=error_msg>Photo deletion failed</div></td></tr>";
		}
		
		$sql = "DELETE FROM class_$class WHERE admission_no='$adm_no';";
		if(mysqli_query($conn,$sql))
		{
			$err_msg ="<div class=sucess_msg>{$row['name']} Has Been Deleted From Class_$class</div>";
		}
		echo "</table>";
	}
	echo $err_msg;
}
?>

</div>






</div>
<div style="clear:both"></div>
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
function cheak_data()
{
	var i;
	form_obj = document.getElementById('search');
	len = form_obj.elements.length;
	for(i=0;i<len;i++)
	{
		if(form_obj.elements[i].value == "")
		{
			document.getElementById('msg').innerHTML ="Dont't use blank Space";
			return false;
		}
	}
	
}

function submit_confirm()
{
	var ret = confirm("Do You Really Want To Submit");
	if(ret == true)
	return true;
	else
	return false;
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