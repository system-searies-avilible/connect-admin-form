<?php
class mycount
{
	
function register($name,$fname,$age,$course,$gender,$email,$phone_num,$pass,$cpass,$address,$pic)
{
	session_start();
$connect=mysqli_connect("localhost","root","","educhamp");
$_SESSION['email']=$email;


$id=rand(0000,9999);
	
	$select=mysqli_query($connect,"select * from tbl_register where email='$email'");
	$num=mysqli_num_rows($select);
	if($num>0){
	echo"<script>alert('email already exist');</script>";	
		
	}
	else{
if($pass == $cpass){
	
$register=mysqli_query($connect,"insert into tbl_register values('$id','$name','$fname','$age','$course','$gender','$email','$phone_num','$pass','$address','$pic','1')");

if($register){
echo"<script>alert('register sucessfully');</script>";	
echo"<script>window.location.assign('admin/index.php');</script>";		
}
else{
echo"<script>alert('can't be register an error accor');</script>";			
}
	
}
else{
echo"<script>alert('please write the same password')</script>";
}	

}
	
}






function login($email,$pass2){
	
	$connect=mysqli_connect("localhost","root","","educhamp");
	session_start();
	$login=mysqli_query($connect,"select * from tbl_register where email='$email' and password_pass='$pass2' ");
	
	$num=mysqli_num_rows($login);
	if($num>0){
	$_SESSION['email']=$email;
echo"<script> alert('$email')</script>";	
echo"<script> alert('Login sucessfully')</script>";	
echo"<script> window.location.assign('admin/index.php')</script>";	
		
		
	}
	else{
echo"<script> alert('email not exist')</script>";		
		
	}
	
	
	
}



function showdata($email)
{
$connect=mysqli_connect("localhost","root","","educhamp");
$select=mysqli_query($connect,"select * from tbl_register where email='$email'");	
	$num=mysqli_num_rows($select);
	for($i=0; $i<$num; $i++){
$row=mysqli_fetch_array($select);
echo"<tr>";	
echo"<td>".$row[0]."</td>";	
echo"<td>".$row[1]."</td>";	
echo"<td>".$row[2]."</td>";	
echo"<td>".$row[3]."</td>";	
echo"<td>".$row[4]."</td>";	
echo"<td>".$row[5]."</td>";	
echo"<td>".$row[6]."</td>";	
echo"<td>".$row[7]."</td>";	
echo"<td>".$row[8]."</td>";	
echo"<td>".$row[9]."</td>";	
echo"<td>".$row[10]."</td>";	
echo"<td>".'<a href="add-listing.php?id='.$row[0].'">UPDATE</a>'.'&nbsp;&nbsp;/&nbsp;&nbsp;'.'<a href="delete.php?id='.$row[0].'">DELETE</a>'."</td>";	
echo"</tr>";		
		
	}
	
}


function forget_pass($email)
{
	$connect=mysqli_connect("localhost","root","","educhamp");
	session_start();
	$_SESSION['email']=$email;
	
	$forget_pass=mysqli_query($connect,"select * from tbl_register where email='$email' ");
	$num=mysqli_num_rows($forget_pass);
if($num>0){
$code=rand(111,999);
mysqli_query($connect,"insert into varification value('','$code') ");
echo"<script> window.location.assign('reset_password.php');</script>";		
		
}
else{
	echo"<script>alert('email not extist');</script>";
}
	
}

function reset_pass($code1,$pass1,$pass2)
{
$connect=mysqli_connect("localhost","root","","educhamp");
	session_start();
	$email=$_SESSION['email'];
$varify=mysqli_query($connect,"select * from varification where varify_code='$code1' ");	
	$num=mysqli_num_rows($varify);
	if($pass1==$pass2){
if($num>0){
$reset_password=mysqli_query($connect,"update  tbl_register set password_pass='$pass1' where email='$email' ");
if($reset_password){
	echo"<script>alert ('password changed sucessfully');</script>";
	
	mysqli_query($connect,"delete from varification where varify_code='$code1' ");
	echo"<script> window.location.assign('login.php');</script>";
	
}
else{
	echo"<script>alert ('Email not exist');</script>";
	
}
}
else{
echo"<script>alert ('Invalid varification code');</script>";

}	
}
else{
echo"<script>alert ('Please enter the same password');</script>";	
	
}
}


}
?>