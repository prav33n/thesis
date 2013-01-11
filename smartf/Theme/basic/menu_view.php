<?php
  /*
    All Emoncms code is released under the GNU Affero General Public License.
    See COPYRIGHT.txt and LICENSE.txt.

    ---------------------------------------------------------------------
    Emoncms - open source energy visualisation
    Part of the OpenEnergyMonitor project:
    http://openenergymonitor.org
  */

  global $path, $session, $menu_left, $menu_right;

?>

<ul class="nav" style="width:1200px; margin-left:-25px;">

<?php 

// Sort menu
usort($menu_left, "custom_sort");
// Define the custom sort function
function custom_sort($a,$b) {
  return $a['order']>$b['order'];
}

if (!isset($session['profile'])) $session['profile'] = 0;
if ($session['profile']==0)
{
	$id = 0;
foreach ($menu_left as $item) 
{
	if (isset($session[$item['session']]) && $session[$item['session']]==1) 
	{
	//if($id==0)
	//echo "<li id='img' style='visibility:hidden'><a href='".$path.$item['path']."'>"._($item['name'])."</a></li>";
//    else 
	if($id==0)
	echo "<li style=' width:25%; border-top: 5px solid #dd514c; text-align: center; font-weight:bold;' id='".strtolower($item['name'])."'>
	<a href='".$path.$item['path']."'>"._($item['name'])."</a></li>";
	elseif($id==1)
	echo "<li style='width:25%; border-top: 5px solid #5eb95e; text-align: center;  font-weight:bold;' id='control'>
	<a href='".$path.$item['path']."'>"._($item['name'])."</a></li>";
	elseif($id==2)
	echo "<li style='width:25%; border-top: 5px solid #faa732; text-align: center;  font-weight:bold;' id='".strtolower($item['name'])."'>
	<a href='".$path.$item['path']."'>"._($item['name'])."</a></li>";
	elseif($id==3)
	echo "<li style='width:25%; border-top: 5px solid #33B5E5; text-align: center;  font-weight:bold;' id='".strtolower($item['name'])."'>
	<a href='".$path.$item['path']."'>"._($item['name'])."</a></li>";
	else
	echo "<li id='".strtolower($item['name'])."'><a href='".$path.$item['path']."'>"._($item['name'])."</a></li>";
	$id++;
	}
} 
}
?>
</ul>

<ul class="nav pull-right" style="width:00px" >
<!-- <li><i class="icon-inbox"></i><span class="badge badge-important">6</span></li>
<li><i class="icon-info-sign"></i><span class="badge badge-success">2</span></li> -->
<?php /*
foreach ($menu_right as $item) 
{
  if (isset($session[$item['session']]) && $session[$item['session']]==1) 
    echo "<li><a href='".$path.$item['path']."' >"._($item['name'])."</a></li>";
} 
*/
?>
</ul>
