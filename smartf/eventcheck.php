<?php
//require 'C:\xampp\htdocs\smartf\db.php';
define('EMONCMS_EXEC', 1);
 require "ambilight.php";
 require 'db.php';
global $mysqli, $server, $username, $password, $database;
  $username = "k42457_smartf";
  $password = "test1234";
  $server   = "localhost";
  $database = "k42457_smartf";
 
 db_connect();
 $result = db_query("select * from event where eventtype=1");
  $row = db_fetch_array($result);
print_r(json_encode($row));
  db_query("delete from event where eventtype=1");
/*set_time_limit(60*60*12);
depthpost("http://".$tvip.":1925/1/ambilight/mode",'{"current": "manual"}');
for ($i = 0; $i < 100; $i++){
 $result = db_query("select * from event where eventtype=1");
  $row = db_fetch_array($result);
  var_dump($row["eventvalue"]);
 //foreach ($item as $row )
  if((int)$row["eventvalue"] > 1500 && (int)$row["eventvalue"] < 1800){
  depthpost("http://".$tvip.":1925/1/ambilight/cached",'{"layer1":{"r":255,"g":0,"b":0}}');
  }
   if((int)$row["eventvalue"] > 1800 && (int)$row["eventvalue"] < 2500)
  depthpost("http://".$tvip.":1925/1/ambilight/cached",'{"layer1":{"r":0,"g":255,"b":0}}');
  if((int)$row["eventvalue"] > 2500)
  depthpost("http://".$tvip.":1925/1/ambilight/cached",'{"layer1":{"r":0,"g":0,"b":255}}');
  db_query("delete from event WHERE eventtype=1");
sleep(30);
}
*/
  
  
  ?>