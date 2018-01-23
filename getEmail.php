<?php

require "connection.php";

$sql[] = array();

//user and pass must be cleaned in php or java
$sql['identifier'] = mysqli_real_escape_string($conn,$_POST["identifier"]);
$sql['tokenI'] = mysqli_real_escape_string($conn,$_POST["tokenI"]);

$mysql_qry = "SELECT email FROM acc_db  WHERE (identifier, tokenI) = ('{$sql['identifier']}', '{$sql['tokenI']}')";
$result = mysqli_query($conn, $mysql_qry);
//var_dump($result);
if(mysqli_num_rows($result)>0){
//if($result=='true'){
  //sign in sucess
  $email = mysqli_fetch_row($result);

  header('Content-Type: application/json');
  echo json_encode(array("return"=>"true","email"=>$email[0]));


  //echo 'true';
}else{
  //sign in fail
  //echo 'false';
  echo json_encode(array("return"=>"false"));
}

?>
