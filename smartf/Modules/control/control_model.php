<?php
/*
 All Emoncms code is released under the GNU Affero General Public License.
 See COPYRIGHT.txt and LICENSE.txt.

 ---------------------------------------------------------------------
 Emoncms - open source energy visualisation
 Part of the OpenEnergyMonitor project:
 http://openenergymonitor.org
 */

// no direct access
defined('EMONCMS_EXEC') or die('Restricted access');

/*
 * Create a new user dashboard
 * 
 */
function new_device($devarray)
{
  // If it is first user dashboard, set it the main one or no one exists 
    db_query("INSERT INTO devices(`userid`,`devid`,`content`,`devtype`,`roomid`,`devname`,`feedid`,`ipaddress`) VALUES ('$devarray[userid]','$devarray[devid]','$devarray[content]','$devarray[devname]','$devarray[roomid]','$devarray[devdescription]','$devarray[feedid]'),'$devarray[ipaddress]'");  
    return db_insert_id();
}

function delete_device($userid, $id)
{
  $result = db_query("DELETE FROM devices WHERE userid = '$userid' AND id = '$id'");
  return $result;
}


function get_device_list($userid)
{
  $result = db_query("SELECT * FROM devices INNER JOIN room ON devices.roomid = room.roomid WHERE devices.userid='$userid' ORDER By devices.roomid");
	$list = array();
  while ($row = db_fetch_array($result)) $list[] = $row;
  return $list;
}


function get_ondevice_list($userid)
{
	$result = db_query("SELECT * FROM devices INNER JOIN room ON devices.roomid = room.roomid WHERE devices.userid='$userid' AND devices.status=1 ORDER By devices.roomid");
	$list = array();
  while ($row = db_fetch_array($result)) $list[] = $row;
  return $list;
}
 function get_control_interface($userid,$devid)
 {
	 $result = db_query("SELECT content,devtype,feedid,ipaddress,status FROM devices WHERE userid='$userid' AND devid='$devid'");
 $list = array();
  while ($row = db_fetch_array($result)) $list[] = $row;
  return $list;
 }

function get_deviceroom_list($userid,$roomid)
{ 
	$result = db_query("SELECT * FROM devices INNER JOIN  room ON devices.roomid = room.roomid WHERE devices.userid ='$userid' && devices.roomid = '$roomid'");
	$list = array();
  while ($row = db_fetch_array($result)) $list[] = $row;
  return $list;
}

 function get_roomid($roomname,$userid){
	 $result = db_query("SELECT roomid from room WHERE userid='$userid' && roomname ='$roomname'");
	$list = array();
  while ($row = db_fetch_array($result)) $list[] = $row;
  return $list;
	 }


function update_device_status($devid,$status){
	return db_query("UPDATE devices SET status ='$status' WHERE devid='$devid'");
}

function get_room_list($userid){
	$result = db_query("SELECT roomid,roomname from room WHERE userid='$userid'");
	$list = array();
  while ($row = db_fetch_array($result)) $list[] = $row;
  return $list;
	}

//add new 
function add_new_room($userid,$roomname){
	
	db_query("INSERT into room ('roomname','userid') VALUES ('$roomname','$userid')");
	 return db_insert_id();
	
	}

function  add_new_device($userid,$content,$devtype,$roomid,$devname,$feedid,$status){
	//Insert code
	}
