<?php 
defined('EMONCMS_EXEC') or die('Restricted access');

function get_events($userid) {
	$result = db_query("SELECT id,title,notes,start,end,deviceid FROM calendar WHERE userid='$userid'");
	$list = array();
  while ($row = db_fetch_array($result)) $list[] = $row;
  return $list;
}

function add_event($eventarray){
	 db_query("INSERT INTO calendar (userid, title, notes, `start`, `end`, deviceid) values ('$eventarray[userid]','$eventarray[title]','$eventarray[notes]','$eventarray[start]','$eventarray[end]','$eventarray[deviceid]'");
	
}
function delete_event($id)
{
  $result = db_query("DELETE FROM devices WHERE id = '$id'");
  return $result;
}
?>