<?php
/*header("Content-Type: application/ce-html+xml;charset=\"UTF-8\";supportspointer=true\n ");*/
echo "<?xml version=\"1.0\" encoding=\"UTF-8\" ?>\n";
  /*
  All Emoncms code is released under the GNU Affero General Public License.
  See COPYRIGHT.txt and LICENSE.txt.

  ---------------------------------------------------------------------
  Emoncms - open source energy visualisation
  Part of the OpenEnergyMonitor project:
  http://openenergymonitor.org
  */

  global $session, $theme, $path,$route;
?>
<!DOCTYPE html>
<html  xmlns="http://www.w3.org/1999/xhtml" lang="en">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <!--   <meta http-equiv="content-type" content="application/ce-html+xml; charset=UTF-8" />
   Thanks to Baptiste Gaultier for the emoncms dial icon http://bit.ly/zXgScz -->
    <link rel="shortcut icon" href="<?php echo $path; ?>Theme/basic/favicon.png" />
    <link href="<?php print $GLOBALS['path']; ?>Lib/bootstrap/css/bootstrap.readable.css" rel="stylesheet"/>
    <script type="text/javascript" src="<?php echo $path; ?>Lib/flot/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo $path; ?>Theme/basic/style.css"/>
    <!-- APPLE TWEAKS - thanks to Paul Dreed -->
    <meta name="apple-mobile-web-app-capable" content="yes"/>
    <meta name="apple-mobile-web-app-status-bar-style" content="black"/>
    <link rel="apple-touch-startup-image" href="<?php echo $path; ?>Theme/basic/ios_load.png"/>
    <link rel="apple-touch-icon" href="<?php echo $path; ?>Theme/basic/logo_normal.png"/>
 <title>Smart Grid</title>
 </head>
  <body>
    <?php
    /*------------------------------------------------------
     * HEADER
     *------------------------------------------------------
     */
    ?>
    <div id="navbar" class="navbar navbar-fixed-top" style="visibility:hidden">
      <div class="navbar-inner">
        <div class="container pull-left">
          <?php if (!isset($runmenu)) $runmenu = '';
                echo $mainmenu.$runmenu;
          ?> 
        </div>
      </div>
    </div>
		
  <?php
    /*------------------------------------------------------
     * GREY SUBMENU
     *------------------------------------------------------
     */

    if (isset($submenu) && ($submenu)) { ?>  
    <div  style="margin-top:3px; margin-left:50px">
      <div id="submenu" style="margin:3px; margin-left:00px;">
        <?php echo  $submenu; ?> 
      </div>
    </div>
    <?php } 
    /*------------------------------------------------------
     * Message  CONTENT
     *------------------------------------------------------
     */
    ?>     	
  <?php 
//$message ="Turn Off the Lights";
    if (isset($message))
    {
      $alert = 'info';
      if (count($message)==2) {
        $alert = $message[0];
        $message = $message[1];
      } 

      if ($message) { ?>     	
        <div class="alert alert-<?php echo $alert; ?>">
          <button class="close" data-dismiss="alert">x</button>
          <strong>Message: </strong><?php print $message; ?>
        </div>
      <?php 
      } 
    }
?>   <div class="content" style=" margin-top:-20px;">
     <?php
        if (!isset($fullwidth)) $fullwidth = false;
        if (!$fullwidth) {
          echo '<div style="margin: 0px auto; max-width:1250px; padding:2px;">';
          print $content;
          echo '</div>';
        }
        else {
          print $content;
        }
      ?>
    </div>
    

<div id="navbar" class="navbar navbar-fixed-bottom" style="width:100%; height:35px; font-size:22px;">
<div class="navbar-inner">
<ul class="nav" style="margin:3px;">
   <li>
     <span class="label label-default" style="font-size:22px;">Press Back Button for Home</span>
  </li>
    <li class="divider-vertical"></li>
  <li>
   <span class="label label-important" style="font-size:22px;">Dashboard</span>
  </li>
 <li class="divider-vertical"></li>
    <li>
      <span class="label label-success" style="font-size:22px;">Control</span>
  </li>
    <li class="divider-vertical"></li>
    <li>
      <span class="label label-warning" style="font-size:22px;">Calendar</span>
  </li>
    <li class="divider-vertical"></li>
    <li>
     <span class="label label-info" style="font-size:22px;">Settings</span>
  </li>
</ul></div></div>
    <!-- needed for modal -->
    <!-- MOVED TO DASHBOARD_CONFIG_VIEW (declaring jquery here conflics with the jquery lib loaded by the visualisations)-->
    <script type="text/javascript">
 	var module = "<?php echo $route["controller"]?>";
	$(document.getElementById(module)).addClass("active");
	//$().addClass(active);
	
 function getKeyCode(e)
 {
  	switch (e.keyCode) 
  	{ 
  		case VK_RED: 
		location.href='<?php echo $path;?>dashboard/view';
//  	  	$(document.getElementById('dashboard')).find("a").focus();
		break;
		case VK_GREEN:
		location.href='<?php echo $path;?>control/view';
		//$(document.getElementById('control')).find("a").focus();
		break;
		case VK_YELLOW:
		location.href='<?php echo $path;?>calendar/view';
		//$(document.getElementById('calendar')).find("a").focus();
		break;
		case VK_BLUE:
		location.href='<?php echo $path;?>settings/view';
		//$(document.getElementById('settings')).find("a").focus();
		break;
  	}
  }
  document.addEventListener("keypress",getKeyCode, true);
</script>
  </body>
 </html>
