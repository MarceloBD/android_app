<?php

require "connection.php";

$user = $_POST["user"];
$pass = $_POST["pass"];
$email = $_POST["email"];
$name = $_POST["name"];
$nickname = $_POST["nickname"];

$mysql_qry = "INSERT INTO acc_db (user, pass, email, name, nickname) values ('$user', '$pass', '$email', '$name', '$nickname')";

//$mysql_qry = "INSERT INTO acc_db (user, pass, email, name, nickname) values ('134234', '12341234', '12341234', '12341234', '12341234')";
$result = mysqli_query($conn, $mysql_qry);

//var_dump($result);
if($result=='true'){
  echo 'true';
}else{
  echo 'false';
}









?>
