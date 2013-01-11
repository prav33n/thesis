<?php
 define('EMONCMS_EXEC', 1);
 defined('EMONCMS_EXEC') or die('Restricted access');
 require 'db.php';
 global $mysqli, $server, $username, $password, $database;
  $username = "k42457_smartf";
  $password = "test1234";
  $server   = "localhost";
  $database = "k42457_smartf";
  $serverip="http://praveenjelish.kodingen.com/smartf";
  $returnXml ="";
  db_connect();
  $result = db_query("select * from event WHERE eventtype = 2");
  $row = db_fetch_array($result);
  if($row==NULL)
  $returnXml = '<notification>
    <available>no</available> 
	<noturl>'.$serverip.'/pushnotificationlanding.php</noturl>
    <pending>FALSE</pending>
	<landingurl>'.$serverip.'</landingurl>
</notification>';
  else
  $returnXml = '<notification>
    <available>yes</available> 
	<noturl>'.$serverip.'/pushnotificationlanding.php</noturl>
    <pending>FALSE</pending>
	<landingurl>'.$serverip.'</landingurl>
</notification>';
 
  echo($returnXml);
  
?>