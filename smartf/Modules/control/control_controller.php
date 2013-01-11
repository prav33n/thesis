<?php
/*
new model added to dipaly the devices in a room
*/
  defined('EMONCMS_EXEC') or die('Restricted access');
  
  function control_controller(){
	require "Modules/feed/feed_model.php";
    require "Modules/control/control_model.php";
    global $path, $session, $route;
	$format = $route['format'];
    $action = $route['action'];
    $subaction = $route['subaction'];
    $output['content'] = "";
    $output['message'] = "";
    $submenu = get_room_list($session['userid']);
	$output['submenu'] = '<span style="float:left; color:#000; font: 22px sans-serif; font-weight:bold;">Devices : </span><ul class="nav nav-pills">';
    if($subaction == "")
    	$output['submenu'] .= '<li id="alldevices" class="active"><a href="'.$path.'control/view/">All Devices</a></li>';
   else
   		$output['submenu'] .= '<li><a id="alldevices" href="'.$path.'control/view/">All Devices</a></li>';
	foreach ($submenu as $item){
    	if($subaction == strtolower($item['roomname']))
    	$output['submenu'] .= '<li class="active"><a id="'.strtolower(trim($item['roomname'],'')).'" href="'.$path.'control/view/'.strtolower(trim($item["roomname"],"")).'">'.$item["roomname"].'</a></li>';
    	else 
    	$output['submenu'] .= '<li><a id="'.strtolower(trim($item['roomname'],'')).'" href="'.$path.'control/view/'.strtolower(trim($item["roomname"],"")).'">'.$item["roomname"].'</a></li>';
    }
	$output['submenu'] .= '<li><a id="detail" href="'.$path.'control/detail/">House Map</a></li>';
$output['submenu'].='</ul>';
	
	
	if($action =='new')
	{
		$output['message'] = "new room created";
	}
	
	if($action =='updatestatus')
	{
	update_device_status((int)$_GET["devid"],(int)$_GET["status"]);
	$output['message'] = "Device status changed";
	}
	
	
	else if($action =='view')
	{
		$apikey = get_apikey_read($session['userid']);
		$devid = intval(get('id'));
		if($devid > 0){
          	$list = get_control_interface($session['userid'],$devid);
          	$output['content'] = view("control/views/control_detail.php", array('list'=>$list, "apikey_read"=>$apikey));
        }
		else{ 
		if($subaction){
			if($subaction=="on")
			{$list = get_ondevice_list($session['userid']);}
			else{
			$roomid = get_roomid($subaction,$session['userid']);
          	$list = get_deviceroom_list($session['userid'],$roomid[0]["roomid"]);}
			$output['content'] = view("control/views/control_list_view.php", array('list'=>$list, "apikey_read"=>$apikey));
	}
        else{
      	$list = get_device_list($session['userid']);
		//$output['content'] = view("control/views/control_detail.php", array('list'=>$list, "apikey_read"=>$apikey));
		$output['content'] = view("control/views/control_list_view.php", array('list'=>$list, "apikey_read"=>$apikey));
        }
   //$output['content'] = view("control/views/control_list_view.php", array('list'=>$list, "apikey_read"=>$apikey));
	} 
}
	else if($action =='detail')
	{
		$devid = intval(get('id'));
		$list = get_device_list($session['userid']);
		$output['content'] = view("control/views/control_detail.php", array('list'=>$list));
	}
	
return $output;	
}
  
?>