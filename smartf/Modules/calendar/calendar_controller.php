<?php
/*
new model added to dipaly the devices in a room
*/
  defined('EMONCMS_EXEC') or die('Restricted access');
  
  function calendar_controller(){
	require "Modules/feed/feed_model.php";
    require "Modules/calendar/calendar_model.php";
    global $path, $session, $route;
	$format = $route['format'];
    $action = $route['action'];
    $subaction = $route['subaction'];
    $output['content'] = "";
    $output['message'] = "";
	$output['submenu'] ="";
	if($action =='new')
	{
		$output['message'] = "new room created";
	}
	else if($action =='view')
	{
		$apikey = get_apikey_read($session['userid']);
		$calenderid = intval(get('id'));
		$events = get_events($session['userid']);
        $output['content'] = view("calendar/calendar_view.php", array("events" =>$events, "apikey_read"=>$apikey)); 
	}
	else if($action =='mapview')
	{
		$output["content"] = "Interactive map";
	}
		
			
return $output;	
}
  
?>