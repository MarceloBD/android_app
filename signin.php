<?php

require "connection.php";

$sql[] = array();

//user and pass must be cleaned in php or java
$sql['user'] = mysqli_real_escape_string($conn,$_POST["user"]);
$sql['pass'] = mysqli_real_escape_string($conn,$_POST["pass"]);
//$//sql['user'] = "marcelo";
//$sql['pass'] = "marcelo";

$mysql_qry = "SELECT email FROM acc_db  WHERE (user, pass) = ('{$sql['user']}', '{$sql['pass']}')";
$result = mysqli_query($conn, $mysql_qry);
//var_dump($result);
if(mysqli_num_rows($result)>0){
//if($result=='true'){
  //sign in sucess
  $email = mysqli_fetch_row($result);
  createSession($sql['identifier'], $sql['tokenI'], $sql['user']);
  $mysql_qry = "UPDATE acc_db SET identifier = '{$sql['identifier']}', tokenI = '{$sql['tokenI']}' WHERE (user, pass) = ('{$sql['user']}', '{$sql['pass']}')";
  mysqli_query($conn, $mysql_qry);

  header('Content-Type: application/json');
  echo json_encode(array("return"=>"true","identifier"=>$sql['identifier'], "tokenI"=>$sql['tokenI'], "email"=>$email[0]));




  //echo 'true';
}else{
  //sign in fail
  //echo 'false';
  echo json_encode(array("return"=>"false"));
}

/**
* Create a cookie for user account
**/
function createSession(&$identifier, &$tokenI, $user){
  $salt = 'GRANDMAGUS';
  $identifier = md5($salt.md5($user.$salt));
  $tokenI = md5(uniqid(rand(), TRUE));
}






?>
