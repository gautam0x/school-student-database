<!doctype html>
<html>
<head>
<meta charset="utf-8">
<?php 
include "config.php";
?> 
<meta charset="utf-8"> 
<meta name="description" content="School Students Datbase Management System" />
<meta name="author" content="gtm0x" />  
<link rel="stylesheet" type="text/css" href="full_information_style.css" />
<title>Students Database</title>

<?php
$name = $class = $adm_no = $house = $gender = $dob = $father_name = $mother_name = $email = $mobile = $address = $photo = "";

function verify_input($data)
{
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}

if($_SERVER['REQUEST_METHOD'] == 'GET')
{
	foreach($_GET as $key => $value)
	{
		if(empty($value))
		{
			die('<div class=error_msg>Error : No Argument Passed</div>');
		}
	}
	
	$class = verify_input($_GET['class']);
	$adm_no = verify_input($_GET['adm_no']);
	
	////////////////////////////Ready To Display Data
	
	$sql = "SELECT * FROM class_$class WHERE admission_no = '$adm_no' ;";
	$result = mysqli_query($conn ,$sql);
	while($row = mysqli_fetch_assoc($result))
	{
		$name = $row['name'];
		$class = $row['class'];
		$adm_no = $row['admission_no'];
		$gender = $row['gender'];
		$dob = $row['dob'];
		$father_name = $row['father_name'];
		$mother_name = $row['mother_name'];
		$email = $row['email'];
		$mobile = $row['mobile'];
		$address = $row['address'];
		$locality = $row['locality'];
		$category = $row['category'];
		$photo = $row['image'];
	}
}
?>
</head>


<body bgcolor="#C9C9C9">
<center><div class="page_wrapper"> 
<div style="border:2px solid #dfdfdf;height:860px;padding:20px 20px;">


<!------------------Table For Header------>

<table class="header" border="0">
<tr>
<td>
<img src="logo_black.gif" style="width:150px;" alt=""/>
</td>
<td>
<span style="font-size:34px">XYZ Pubic School</span>
<br/>
<span style="font-size:20px">Area , Distt , State - 84XXXX</span>
</td>

<td>
<button onClick="window.print()" >Print </button>
<br/>
</td>
</tr>

</table>

<!-------------//////-----Table ForInformation    /////     --------->

                   


<div class="info_header"> Student's Information </div>
<table border="0" class="info_detail">

<tr><td rowspan="7"><img src="<?php echo "photos/".$photo ?> "></td></tr>

<tr><td class="tag">Name</td>
<td>: <?php echo $name ?></td></tr>
<tr><td class="tag">Class </td>
<td> : <?php echo $class ?></td></tr>
<tr><td class="tag">Adm No </td>
<td>: <?php echo $adm_no ?> </td></tr>
<tr><td class="tag">Gender </td>
<td> : <?php echo $gender ?></td></tr>
<tr><td class="tag">DOB <font size=2>(yyyy/mm/dd)</font></td>
<td>: <?php echo $dob ?></td></tr>

</table>

<!-------------//////-----Table Extra Information    /////     --------->

<table class="extra_info_detail">
<tr><th colspan="2">Genreal Information</th></tr>
<tr><td class="tag">Father's Nmae </td><td>: <?php echo $father_name ?></td></tr>
<tr><td class="tag">Mother's Nmae </td><td>: <?php echo $mother_name ?></td></tr>
<tr><td class="tag">Category </td><td>: <?php echo $category ?></td></tr>
<tr><td class="tag">Email </td><td>: <?php echo $email ?></td></tr>
<tr><td class="tag">Mobile No. </td><td>: <?php echo $mobile ?> </td></tr>
<tr><td class="tag">Address  </td><td>: <?php echo $address ?></td></tr>
<tr><td class="tag">Locality  </td><td>: <?php echo $locality ?></td></tr>
</table>



</div>


</div></center>
</body>
</html>