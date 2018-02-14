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

	
	<!-----full body content---------------->
	
<div class="full_body">

<input style="margin:5px 0px" type="button" onClick="window.location.href='index.php'" value="Home" />
<input style="margin:5px 0px" type="button" onClick="window.location.reload()" value="Refresh" />

<?php

function verify_input($data)
{
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}

if($_SERVER['REQUEST_METHOD'] == "GET")
{
	foreach($_GET as $key => $value) //checking every input
	{
		if(empty($value))
		{
			die('<div class=error_msg>Error : No Argument Passed</div>');
		}
	}
	
	$class = verify_input($_GET['class']);
	
	/*Search From Database*/
	
	$count =0;
	$sql = "SELECT name,dob,admission_no,mobile,email,gender,image FROM class_$class ORDER BY name";
	$alt ="";
	$result = mysqli_query($conn, $sql);

	if( mysqli_num_rows($result) > 0)
	{
		echo "<table class=data_list><tr><th>Photo</th><th>Name</th><th>DOB</th><th>Adm no</th><th>Mobile</th><th>Email</th><th>Gender</th><th>Action</th></tr>";
		while($row = mysqli_fetch_assoc($result))
		{	
			echo "<tr class=$alt>
			<td><img width=60 height=40 src=photos/{$row['image']}></img></td>
			<td><a target=_blank href=full_information.php?adm_no={$row['admission_no']}&class=$class>{$row['name']}</a></td>
			<td>{$row['dob']}</td>
			<td>{$row['admission_no']}</td>
			<td>{$row['mobile']}</td>
			<td>{$row['email']}</td>
			<td>{$row['gender']}</td>
			<td><a target=_blank href=delete_item.php?adm_no={$row['admission_no']}&class=$class>Delete</a><hr/>
				<a target=_blank href=edit_item.php?adm_no={$row['admission_no']}&class=$class>Modify</a></tr> ";
			
			$alt != 'alt' ? $alt = 'alt' : $alt='';
			$count++;
		}
		echo "</table>";
		echo "<div class=sucess_msg> Sucess : $count result found</div>";
	}
	else
	{
		echo "<div class=error_msg>Sorry No. result found</div>";
	}
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

<script language="JavaScript">
function deletex()
{
	alert("dfhfd");
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