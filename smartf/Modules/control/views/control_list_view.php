<?php global $session, $path; 
?>
<script type="text/javascript" src="<?php echo $path; ?>Lib/bootstrap/js/bootstrap-modal.js"></script>
<script type="text/javascript" src="<?php echo $path; ?>Lib/bootstrap/js/bootstrap-transition.js"></script>
<script type="text/javascript" src="<?php echo $path; ?>Lib/bootstrap/js/bootstrap-tab.js"></script>
<script type="text/javascript" src="<?php echo $path; ?>Modules/control/js/lightadjust.js"></script>

<?php if(count($list) > 8)
$listno = ceil(count($list)/8);
else 
$listno =1;
echo('<div id="buttontop" class="pull-right"> <ul class="nav nav-pills">');
if($listno >1){
  for($i=0; $i< $listno;$i++){
if($i==0)
	echo('<li class="active"><a href="#list'.$i.'" data-toggle="tab" onclick="javascript:togglecontent(this)">'.($i+1).'</a></li>');
else
echo('<li><a href="#list'.$i.'" data-toggle="tab" onclick="javascript:togglecontent(this)">'.($i+1).'</a></li>');
	} }
	echo ('</ul> </div>');
		echo ('<div id="devcontent" class="tab-content"  style="margin-top:20px; margin-left:30px; background=#ffffff; width:100%;">');
for($i=0; $i< $listno;$i++){
if($i==0)
echo'<table  class="table table-bordered table-striped table-hover tab-pane fade active in" id="list'.$i.'" width="100%">
    <thead>
	    <tr>
        <th>Device Name</th>
        <th>Location</th>
        <th>Power/W</th>
        <th>Cost/month &euro;</th>
        <th>Status</th>
      </tr>
    </thead>';

	//echo '<tbody class="tab-pane active"  id="list'.$i.'">';
else
	echo'<table   class="table table-bordered table-striped table-hover tab-pane fade" id="list'.$i.'" width="100%">
    <thead>
	    <tr>
        <th>Device Name</th>
        <th>Location</th>
        <th>Power/W</th>
        <th>Cost/month &euro;</th>
        <th>Status</th>
      </tr>
    </thead>';
	//echo '<tbody  class="tab-pane"  id="list'.$i.'">';
	 /* foreach ($list as $row){
	   	echo '<td id="dname">'.$row["devname"].'</td>';
      	echo '<td id="roomname">'.$row["roomname"].'</td>'; 	
      	echo '<td id="feed" feedid="'.$row["feedid"].'">'.$row["feedid"].'</td>';
      	echo '<td id="cost" feedid="'.$row["feedid"].'">'.round($row["feedid"]*0.20).'</td>';
      	if($row['status'])
      	{      	//.$row["ipaddress"].
		if($row["devtype"] =="washmodal")
		{
			echo '<td class="status"><a class="btn btn-success" devid="'.$row["devid"].'" mode ="'.$row["devtype"].'" data-toggle="modal" href="#'.$row["devtype"].'" >ON</a></td>';
		}
		else
      		echo '<td class="status"><a class="btn btn-success" devid="'.$row["devid"].'" mode ="'.$row["devtype"].'" data-toggle="modal" href="#" onClick ="javascript:buttontoggle(this)">ON</a></td>'; //data-toggle="modal" href="#lightmodel"
      	} 
      	else
      	echo '<td class="status"><a class="btn btn-warning" devid="'.$row["devid"].'" mode ="'.$row["devtype"].'" data-toggle="modal" href="#'.$row["devtype"].'" onClick ="javascript:buttontoggle(this)">OFF</a></td>'; //href="'.$room.'&amp;id='.$row["devid"].'"
		echo'</tr>';
		//echo $row["content"];
   //   	var_dump($row);
       }*/ 
$count=0;
echo '<tbody>';
for($j=($i*8); $j< count($list); $j++){
	$count++;
		echo '<tr>';
	   	echo '<td id="dname">'.$list[$j]["devname"].'</td>';
      	echo '<td id="roomname">'.$list[$j]["roomname"].'</td>'; 	
      	echo '<td id="feed" feedid="'.$list[$j]["feedid"].'">'.round($list[$j]["feedid"]).'</td>';
      	echo '<td id="cost" feedid="'.$list[$j]["feedid"].'">'.round($list[$j]["feedid"]*0.20).'</td>';
      	if($list[$j]['status'] =="1")
      	{      	//.$row["ipaddress"].
		if($list[$j]["devtype"]=="washing")
		{
			echo '<td class="status"><a class="btn btn-success" id="'.$list[$j]["devid"].'" devid="'.$list[$j]["devid"].'" mode ="'.$list[$j]["devtype"].'" data-toggle="modal" href="#'.$list[$j]["devtype"].'" >ON</a></td>';
		}
		else
      		echo '<td class="status"><a class="btn btn-success" id="'.$list[$j]["devid"].'"  devid="'.$list[$j]["devid"].'" mode ="'.$list[$j]["devtype"].'" data-toggle="modal" href="#" onClick ="javascript:buttontoggle(this)">ON</a></td>'; //data-toggle="modal" href="#lightmodel"
      	} 
      	else
      	echo '<td class="status"><a class="btn btn-warning" id="'.$list[$j]["devid"].'"  devid="'.$list[$j]["devid"].'" mode ="'.$list[$j]["devtype"].'" data-toggle="modal" href="#'.$list[$j]["devtype"].'" onClick ="javascript:buttontoggle(this)">OFF</a></td>'; //href="'.$room.'&amp;id='.$row["devid"].'"
		echo'</tr>';
		//echo $row["content"];
   //   	var_dump($row);
  if($count ==8)
  break;
       } 
echo('</tbody></table>');
}
echo '</div>';
?>
    

<script type="text/javascript" > 
update("<?php echo $apikey_read; ?>");
setInterval(function() { update("<?php echo $apikey_read; ?>"); }, 3000);
var path = "<?php echo $path; ?>";
var apikey_read = "<?php echo $apikey_read; ?>";
var total;
// update function
function update(apikey_read)
{
  $.ajax(
  {
    url : path + "feed/list.json?apikey=" + apikey_read,
    dataType : 'json',
    success : function(data)
    { 
	$(document).find('*[feedid]').each(function(index){
		var feedid = $(this).attr("feedid");
		var type  = $(this).attr("id");
		if(data[feedid-1]["value"]== null)
		data[feedid-1]["value"]= 0;
		if(type=="feed"){
			$(this).text(""+data[feedid-1]["value"]);
						}
		else if(type=="cost"){
			$(this).text(""+((data[feedid]["value"]/1000)*0.20*30*24).toFixed(2));}
		});
    }
  });
}

$(".status").click(function (){
 	// serialize doesnt return unchecked checkboxes so manual url must be built
	console.log($($(this).html()).attr("devid"));
	var devid = $(this).find("a").attr("devid");
	var status;
	if($(this).find("a").html() =="ON")
	status = 1;
	else
	status =0;
	
	
 	$.ajax({
     type : "GET",
     url :  path+"control/updatestatus",
     //data : $('#confform').serialize()+"&amp;id="+dashid,   // serialize doesnt return unchecked checkboxes
     data : "devid="+devid+"&status="+status,     
     success : function() {console.log("success");}
     //success : location.reload()    //// if reload, the editor content not saved is lost!! what to do?
   }); 

 	$.ajax({
 	     type : "POST",
 	     url :  path+"input/post?"+ "json={power-net:"+(total-300)+"}&apikey=95876437f3b43ac241fdcd29658770ff",
 	     //data : $('#confform').serialize()+"&amp;id="+dashid,   // serialize doesnt return unchecked checkboxe   
 	      dataType : 'json',
    success : function(data) {console.log(data);}
 	     //success : location.reload()    //// if reload, the editor content not saved is lost!! what to do?
 	   });


    
 });
 </script>


<!--  light contryol -->
<div id="light" class="modal" style="display: none;">
<div class="modal-header">
<a class="close" data-dismiss="modal">x</a>
<h3>Light control</h3>
</div>
<div class="modal-body">
<h4>Lighting Settings</h4>
<div class="alert-info">
<label class="radio">
 <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" tabindex="1"></input>
  Movie
</label>
<label class="radio">
  <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2" tabindex="2"></input>
  Games
</label>
<label class="radio">
  <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2" tabindex="3"></input>
  Low Brightness
</label></div>
<div id="controllight" align="center">
<a class="btn btn-primary" tabindex="4" style= "font-size:24px;"href="javascript:void(0)" onClick="javascript:decrease_lumins()"><strong>-</strong></a><div class="progress progress-info" style="margin:5px;"><div id="light-lumins" class="bar" style="width: 60%;"></div></div>
<a class="btn btn-primary" tabindex="5" style= "font-size:24px" href="javascript:void(0)" onClick="javascript:increase_lumins()"><strong>+</strong></a></div></div>
<div class="modal-footer">
<a href="javascript:void(0)" tabindex="6" class="btn btn-success" data-dismiss="modal">OK</a>
<a href="javascript:void(0)"  tabindex="7" class="btn btn-primary" data-dismiss="modal">Close</a>
</div>
</div>

<!--  thermostat control -->
 
 <div id="thermostat" class="modal hide fade in" style="display: none;">
<div class="modal-header">
<a class="close" data-dismiss="modal">x</a>
<h3>Thermostat control</h3>
</div>
<div class="modal-body">
<div class="alert-info" id="message">
Current Outdoor Temperature : 5C <br/>
Please close the doors before turning the heater
</div>
</div>
<h4>Temperature Settings</h4>
<div id="controlheat" align="center">
<a class="btn btn-primary" style= "font-size:24px;" href="javascript:void(0)" onClick="javascript:increase_temp()"><strong>+</strong></a><h1 id="temprature" class="label-success">18</h1>
<a class="btn btn-primary" style= "font-size:24px" href="javascript:void(0)" onClick="javascript:decrease_temp()"><strong>-</strong></a></div>
<div class="modal-footer">
<a href="javascript:history.go(-1);" class="btn btn-success" data-dismiss="modal">OK</a><a href="javascript:void(0)" class="btn btn-primary" data-dismiss="modal">Close</a>
</div>
</div>

<!--  wash control -->
<div id="washing" class="modal hide fade in" style="display: none; ">
<div class="modal-header">
<a class="close" data-dismiss="modal">x</a>
<h3>Washing control</h3>
</div>
<div class="modal-body">
<div class="alert-info" id="message">
Estimated complettion time : 30 Mins <br/>
Sorry! You cant operate the device from this location
</div>
</div>
<div class="modal-footer">
<a href="javascript:history.go(-1)" class="btn btn-success" data-dismiss="modal">OK</a><a href="javascript:history.go(-1)" class="btn btn-primary" data-dismiss="modal">Close</a>
</div>
</div>

<!--  Fridge control -->
<div id="fridge" class="modal hide fade in" style="display: none; ">
<div class="modal-header">
<a class="close" data-dismiss="modal">x</a>

<h3>Fridge control</h3>
</div>
<div class="modal-body">
<div class="alert-info" id="message">
Fridge Status : Idle<br/>
Current Inside Temprature : 5C
</div>
<table id ="Foods" class="table table-bordered">
  <caption></caption>
  <thead>
    <tr>
      <th>Item Name</th>
      <th>Shelf</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>Milk</td>
      <td>1</td>
    </tr>
     <tr>
      <td>Cake</td>
      <td>2</td>
    </tr>
     <tr>
      <td>Tomatoes</td>
      <td>3</td>
    </tr>
    <tr>
      <td>Meat</td>
      <td>4</td>
    </tr>
  </tbody>
</table>
</div>
<div class="modal-footer">
<a href="javascript:history.go(-1)" class="btn btn-success" data-dismiss="modal">OK</a><a href="javascript:history.go(-1)" class="btn btn-primary" data-dismiss="modal">Close</a>
</div>
</div>

<!--  coffee machine control -->
<div id="coffeemachine" class="modal hide fade in" style="display: none;">
<div class="modal-header">
<a class="close" data-dismiss="modal">x</a>
<h3>Coffee machine</h3>
</div>
<div class="modal-body">
<h4>choice</h4>
<div class="alert-info">
<label class="radio">
 <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" tabindex="1"></input>
  Milk coffee
</label>
<label class="radio">
  <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2" tabindex="2"></input>
Coffee
</label>
<label class="radio">
  <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2" tabindex="3"></input>
Expresso
</label></div>
<div id="controllight" align="center">
Milk Level : Full<br/>
Coffee beans : 40%
</div></div>
<div class="modal-footer">
<a href="javascript:void(0)" tabindex="6" class="btn btn-success" data-dismiss="modal">OK</a>
<a href="javascript:void(0)"  tabindex="7" class="btn btn-primary" data-dismiss="modal">Close</a>
</div>
</div>



<!-- Trashcan control -->
<div id="trashcan" class="modal hide fade in" style="display: none; ">
<div class="modal-header">
<a class="close" data-dismiss="modal">x</a>
<h3>Trashcan Status</h3>
</div>
<div class="modal-body">
<div class="alert-info" id="message">
Full | Empty | 30%
</div>
</div>
<div class="modal-footer">
<a href="javascript:history.go(-1)" class="btn btn-success" data-dismiss="modal">Dismiss</a>
</div>
</div>

<!-- printer control -->
<div id="printer" class="modal hide fade in" style="display: none; ">
<div class="modal-header">
<a class="close" data-dismiss="modal">x</a>
<h3>Printer control</h3>
</div>
<div class="modal-body">
<div class="alert-info" id="message">
Printing now : test1.doc
Print queue : test2.doc | test3.doc
</div>
</div>
<div class="modal-footer">
<a href="javascript:history.go(-1)" class="btn btn-success" data-dismiss="modal">Print</a><a href="javascript:history.go(-1)" class="btn btn-primary" data-dismiss="modal">Stop</a>
</div>
</div>


<!-- Laptop control -->
<div id="laptop" class="modal hide fade in" style="display: none; ">
<div class="modal-header">
<a class="close" data-dismiss="modal">x</a>
<h3>Laptop control</h3>
</div>
<div class="modal-body">
<div class="alert-info" id="message">
Running programs List
</div>
</div>
<div class="modal-footer">
<a href="javascript:history.go(-1)" class="btn btn-success" data-dismiss="modal">Shutdown</a><a href="javascript:history.go(-1)" class="btn btn-primary" data-dismiss="modal">Sleep</a>
</div>
</div>

<!-- Oven  -->
<div id="oven" class="modal hide fade in" style="display: none; ">
<div class="modal-header">
<a class="close" data-dismiss="modal">x</a>
<h3>Oven Status</h3>
</div>
<div class="modal-body">
<div class="alert-info" id="message">
Burner 1 : Heating  <a href="javascript:history.go(-1)" class="btn btn-success">ON</a> <br/> 
Burner 2 : OFF <a href="javascript:history.go(-1)" class="btn btn-success">OFF</a>   <br/>
Burner 3 : 30 mins timer <a href="javascript:history.go(-1)" class="btn btn-success">Timer</a> <br/> </div>
</div>
<div class="modal-footer">
<a href="javascript:history.go(-1)" class="btn btn-success" data-dismiss="modal">Dismiss</a>
</div>
</div>

<!-- camera  -->
<div id="camera" class="modal hide fade in" style="display: none; ">
<div class="modal-header">
<a class="close" data-dismiss="modal">x</a>
<h3>Camera stream</h3>
</div>
<div class="modal-body">
<div class="alert-info" id="message">
Camera stream video here using video element </div>
</div>
<div class="modal-footer">
<a href="javascript:history.go(-1)" class="btn btn-success" data-dismiss="modal">Dismiss</a>
</div>
</div>

<!-- camera  -->
<div id="camera" class="modal hide fade in" style="display: none; ">
<div class="modal-header">
<a class="close" data-dismiss="modal">x</a>
<h3>Camera stream</h3>
</div>
<div class="modal-body">
<div class="alert-info" id="message">
Camera stream video here using video element </div>
</div>
<div class="modal-footer">
<a href="javascript:history.go(-1)" class="btn btn-success" data-dismiss="modal">Dismiss</a>
</div>
</div>

<!-- information  -->
<div id="info" class="modal hide fade in" style="display: none; ">
<div class="modal-header">
<a class="close" data-dismiss="modal">x</a>
<h3>Suggestions</h3>
</div>
<div class="modal-body">
<div class="alert-info" id="message">
1. Change your flouracent lights to CFL light to save on energy bill </br>
2. Please close the windows before turning ON the Heating
</div>
</div>
<div class="modal-footer">
<a href="javascript:history.go(-1)" class="btn btn-success" data-dismiss="modal">Dismiss</a>
</div>
</div>




<!-- stereo  -->
<div id="stereo" class="modal hide fade in" style="display: none; ">
<div class="modal-header">
<a class="close" data-dismiss="modal">x</a>
<h3>Streo System</h3>
</div>
<div class="modal-body">
<div class="alert-success" id="track">
Now playing : song name
</div>
<div class="playcontrol" align="center"><i class="icon-play"></i><i class=" icon-pause"></i></div>
<strong>Volume</strong>
<div id="controlmusic" align="center">
<a class="btn btn-primary" tabindex="4" style= "font-size:24px;" href="javascript:void(0)" onClick="javascript:decrease_lumins()"><strong>-</strong></a><div class="progress progress-info" style="margin:5px;"><div id="light-lumins" class="bar" style="width: 60%;"></div></div>
<a class="btn btn-primary" tabindex="5" style= "font-size:24px" href="javascript:void(0)" onClick="javascript:increase_lumins()"><strong>+</strong></a></div>
</div>
<div class="modal-footer">
<a href="javascript:history.go(-1)" class="btn btn-success" data-dismiss="modal">Off</a>
<a href="javascript:history.go(-1)" class="btn btn-success" data-dismiss="modal">Close</a>
</div>
</div>


<!-- television  -->
<div id="television" class="modal hide fade in" style="display: none; ">
<div class="modal-header">
<a class="close" data-dismiss="modal">x</a>
<h3>Philips Television</h3>
</div>
<div class="modal-body">
<div class="alert-success" id="track">
current channel : BBC
</div>
<div class="playcontrol">Pause / Play     : <i class="icon-play"></i><i class=" icon-pause"></i></div>
<div class="channelcontrol">Change Channel:<i class="icon-plus"></i><i class="icon-minus"></i></div>
Volume
<div id="controlmusic" align="center">
<a class="btn btn-primary" tabindex="4" style= "font-size:24px;" href="javascript:void(0)" onClick="javascript:decrease_lumins()"><strong>-</strong></a><div class="progress progress-info" style="margin:5px;"><div id="light-lumins" class="bar" style="width: 60%;"></div></div>
<a class="btn btn-primary" tabindex="5" style= "font-size:24px" href="javascript:void(0)" onClick="javascript:increase_lumins()"><strong>+</strong></a></div>
</div>
<div class="modal-footer">
<a href="javascript:history.go(-1)" class="btn btn-success" data-dismiss="modal">Off</a>
<a href="javascript:history.go(-1)" class="btn btn-success" data-dismiss="modal">Close</a>
</div>
</div>


<!-- efan  -->
<div id="efan" class="modal hide fade in" style="display: none;">
<div class="modal-header">
<a class="close" data-dismiss="modal">x</a>
<h3>Fan settings</h3>
</div>
<div class="modal-body">
<h4>Speed Level</h4>
<div class="alert-info">
<label class="radio">
 <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" tabindex="1"></input>
Speed level 1
</label>
<label class="radio">
  <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2" tabindex="2"></input>
Speed Level 2
</label>
<label class="radio">
  <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2" tabindex="3"></input>
Speed Level 3
</label></div>
</div>
<div class="modal-footer">
<a href="javascript:void(0)" tabindex="6" class="btn btn-success" data-dismiss="modal">OK</a>
<a href="javascript:void(0)"  tabindex="7" class="btn btn-primary" data-dismiss="modal">Close</a>
</div>
</div>


<!--solar -->
<div id="solarpanel" class="modal hide fade in" style="display: none; ">
<div class="modal-header">
<a class="close" data-dismiss="modal">x</a>
<h3>Solar Panel status</h3>
</div>
<div class="modal-body">
<div class="alert-success" id="panelstatus">
Status : Charging | Heating | ideal
</div>
<strong>Power generation Level : 50%</strong>
<div id="controlmusic" align="center">
<div class="progress progress-info" style="margin:5px;"><div id="light-lumins" class="bar" style="width: 50%;"></div></div></div>
</div>
<div class="modal-footer">
<a href="javascript:history.go(-1)" class="btn btn-success" data-dismiss="modal">Dismiss</a>
</div>
</div>

<!-- electric vehicle -->
<div id="ev" class="modal hide fade in" style="display: none; ">
<div class="modal-header">
<a class="close" data-dismiss="modal">x</a>
<h3>Electric Vehilce</h3>
</div>
<div class="modal-body">
<div class="alert-success" id="evstatus">
Status : Charging | Ideal
</div>
<strong>Charge Level : 20%</strong>
<div id="controlmusic" align="center">
<div class="progress progress-info" style="margin:5px;"><div id="light-lumins" class="bar" style="width: 60%;"></div></div></div>
</div>
<div class="modal-footer">
<a href="javascript:history.go(-1)" class="btn btn-success" data-dismiss="modal">Off</a>
<a href="javascript:history.go(-1)" class="btn btn-success" data-dismiss="modal">Close</a>
</div>
</div>

<!-- security panel  -->
<div id="security" class="modal hide fade in" style="display: none; ">
<div class="modal-header">
<a class="close" data-dismiss="modal">x</a>
<h3>Security Panel</h3>
</div>
<div class="modal-body">
<div class="alert-info" id="message">
Door 1 : <a href="javascript:" class="btn btn-success">OPEN</a> <br/> 
Door 2 : <a href="javascript:" class="btn btn-success">OPEN</a>   <br/>
Door 3 : <a href="javascript:" class="btn btn-success">CLOSED</a> <br/> </div>
</div>
<div class="modal-footer">
<a href="javascript:history.go(-1)" class="btn btn-success" data-dismiss="modal">Dismiss</a>
</div>
</div>












 