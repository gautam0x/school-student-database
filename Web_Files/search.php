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


	<!--full body content start-->
<div class="full_body">

<input style="margin:5px 0px" type="button" onClick="window.location.href='index.php'" value="Home" />
<input style="margin:5px 0px" type="button" onClick="window.location.reload()" value="Refresh" />

<?php

/*Search From Database*/
function verify_input($data)
{
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}

$search_value = $name = $adm_roll = "";
$count =0;
$alt = "";

if($_SERVER['REQUEST_METHOD'] == "GET" && isset($_GET['search_type']) && isset($_GET['search_value']) )
{
	$search_value = verify_input($_GET['search_value']);

	/*----for name wise search-----*/
	if($_GET['search_type'] == 'name')
	{	
		echo "<table class=data_list><tr><th>Photo</th><th>Name</th><th>Class</th><th>DOB</th><th>Admission no.</th><th>Mobile</th><th>Email</th><th>Gender</th><th>Action</th></tr>";		
		for($i=6 ;$i<=12;$i++)
		{
			$sql = "SELECT * FROM class_$i WHERE name LIKE '$search_value%' ORDER BY name";
			$result = mysqli_query($conn, $sql);
			if(mysqli_num_rows($result)> 0)
			{
				while($row = mysqli_fetch_assoc($result))
				{	
					echo "<tr class=$alt>
					<td><img src=photos/{$row['image']}></img></td>
					<td><a target=_blank href=full_information.php?adm_no={$row['admission_no']}&class=$i>{$row['name']}</a></td>
					<td>$i</td>
					<td>{$row['dob']}</td>
					<td>{$row['admission_no']}</td>
					<td>{$row['mobile']}</td>
					<td>{$row['email']}</td>
					<td>{$row['gender']}</td>
					<td><a target=_blank href=delete_item.php?adm_no={$row['admission_no']}&class=$i>Delete</a> <hr/>
						<a target=_blank href=edit_item.php?adm_no={$row['admission_no']}&class=$i>Modify</a></td></tr>";
					
					$alt != 'alt' ? $alt = 'alt' : $alt='';
					$count++;
				}				
			}
		}
		echo "<tr><td colspan=9> <span style=color:#aa0010>[ $count ] data found</span></td></tr></table>";	
	}
	
	/*----for Admission No. wise search-----*/
	else if($_GET['search_type'] == 'admission_no')
	{
		echo "<table class=data_list><tr><th>Photo</th><th>Name</th><th>Class</th><th>DOB</th><th>Admission no.</th><th>Mobile</th><th>Email</th><th>Gender</th><th>Action</th></tr>";
		for($i=6 ;$i<=12;$i++)
		{
			$sql = "SELECT * FROM class_$i WHERE admission_no='$search_value'  ORDER BY name;";
			$result = mysqli_query($conn, $sql);
			if(mysqli_num_rows($result)> 0)
			{
				while($row = mysqli_fetch_assoc($result))
				{	
					echo "<tr class=$alt>
					<td><img src=photos/{$row['image']}></img></td>
					<td><a target=_blank href=full_information.php?adm_no={$row['admission_no']}&class=$i>{$row['name']}</a></td>
					<td>$i</td>
					<td>{$row['dob']}</td>
					<td>{$row['admission_no']}</td>
					<td>{$row['mobile']}</td>
					<td>{$row['email']}</td>
					<td>{$row['gender']}</td>
					<td><a target=_blank href=delete_item.php?adm_no={$row['admission_no']}&class=$i>Delete</a> <hr/>
						<a target=_blank href=edit_item.php?adm_no={$row['admission_no']}&class=$i>Modify</a></td></tr>";
						
					$alt != 'alt' ? $alt = 'alt' : $alt='';
					$count++;
				}				
			}
		}
		echo "<tr><td colspan=9> <span style=color:#aa0010>[ $count ] data found</span></td></tr></table>";	
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