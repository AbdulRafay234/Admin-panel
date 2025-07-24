<?php
$con=mysqli_connect("localhost","root","","sms_db");
if(mysqli_connect_errno()){
    echo "<script>alert('error')</script>";
}else{
    // echo "<script>alert('connection build successfully')</script>";
}
?>