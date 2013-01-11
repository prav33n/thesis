<?php
//header('Content-Type: application/ce-html+xml; charset=UTF-8');
echo('<?xml version="1.0" encoding="UTF-8"?>');
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
  $result = db_query("select * from event WHERE eventtype = 2 OR eventtype = 3");
  $row = db_fetch_array($result);
  db_query("delete from event WHERE eventtype = 2");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
  <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="user-scalable=no, width=device-width" />
<script type="text/javascript" src="http://code.jquery.com/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="/smartf/Lib/bootstrap/js/dial.js"></script>

  <title>Push Notification</title>
<style type="text/css">
.canvas {
    background: none;
  border: 2px solid #ccc;
  border-radius: 20px 3px;
  /* box-shadow: 0 4px 10px -1px rgba(255,0,0, 0.8);*/
  box-shadow: 0 0 20px rgba(255,0,0,.6), inset 0 0 20px rgba(255,0,0,1);
}
</style>
  </head>
  <body>
<canvas id="can" height="170px" width="300px" class="canvas"> </canvas>
<?php if(isset($row["eventvalue"]))
  echo('<div id="consumption" style="font-style:bold; max-width:250px; position: absolute; top:130px; left: 22px; z-index: 5; font-size: 20px;" align="center">Your Power Consumption is above Average</div>'); ?>

<script type="application/javascript">
  var canvas = document.getElementById("can");
  var ctx = canvas.getContext("2d");
  ctx.clearRect(0,0,150,150);  
var position = 0;
  var an = 0;
  var value = <?php if(isset($row["eventvalue"]))
  echo($row["eventvalue"]); 
  else 
  echo "0"; ?>;
  var value2 = 0;
  var max_value = 5000;
//update();
//getvalue();
  setInterval(update,20);
  setInterval(getvalue,5000);
// getvalue();

  function update()
  {
    an += 0.01;
    value2 = curveValue(value2,parseFloat(value),0.02);
    draw_gauge(150,70,70,value2,max_value,"W");
  }

  function getvalue()
  {  
    $.ajax({                                      
      url: 'http://praveenjelish.kodingen.com/smartf/feed/data?id=4&start=0&end=0&dp=100&apikey=95876437f3b43ac241fdcd29658770ff',                         
      dataType: 'json',                           
      success: function(data) 
      {
	console.log(data); 
      //value = 1500;
      }
    }); 
  }

       function curveValue(start,end,rate)
       {
         return start + ((end-start)*rate);
       }
</script>
</body>
</html>
