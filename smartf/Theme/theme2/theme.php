<?php 
/*header("Content-Type: application/ce-html+xml; charset=\"UTF-8\"\n");
echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";*/
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<?php
  /*
  All Emoncms code is released under the GNU Affero General Public License.
  See COPYRIGHT.txt and LICENSE.txt.

  ---------------------------------------------------------------------
  Emoncms - open source energy visualisation
  Part of the OpenEnergyMonitor project:
  http://openenergymonitor.org
  */

  global $session, $theme, $path;
?>

<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <!-- Thanks to Baptiste Gaultier for the emoncms dial icon http://bit.ly/zXgScz -->
    <link rel="shortcut icon" href="<?php echo $path; ?>Theme/basic/favicon.png" />
    <link href="<?php print $GLOBALS['path']; ?>Lib/bootstrap/css/bootstrap.css" rel="stylesheet"/>
    <link rel="stylesheet" type="text/css" href="<?php echo $path; ?>Theme/basic/style.css"/>
    <!-- APPLE TWEAKS - thanks to Paul Dreed -->
    <meta name="apple-mobile-web-app-capable" content="yes"/>
    <meta name="apple-mobile-web-app-status-bar-style" content="black"/>
    <link rel="apple-touch-startup-image" href="<?php echo $path; ?>Theme/basic/ios_load.png"/>
    <link rel="apple-touch-icon" href="<?php echo $path; ?>Theme/basic/logo_normal.png"/>
    <title>Smart Grid</title>
  </head>
  <body style="padding-top:42px;" >
    <?php
    /*------------------------------------------------------
     * HEADER
     *------------------------------------------------------
     */
    ?>
    <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container pull-left">
          <?php if (!isset($runmenu)) $runmenu = '';
                echo $mainmenu.$runmenu;
          ?> 
        </div>
      </div>
    </div>
		
    <?php 

    if (isset($message))
    {
      $alert = 'info';
      if (count($message)==2) {
        $alert = $message[0];
        $message = $message[1];
      } 

      if ($message) { ?>     	
        <div class="alert alert-<?php echo $alert; ?>">
          <button class="close" data-dismiss="alert">×</button>
          <strong>Message: </strong><?php print $message; ?>
        </div>
      <?php 
      } 
    }

    /*------------------------------------------------------
     * GREY SUBMENU
     *------------------------------------------------------
     */

    if (isset($submenu) && ($submenu)) { ?>  
    <div  style="width:100%; max-height:40px;">
      <div class="navbar" style="margin: 0px auto; text-align:left; width:1200px; font-size:18px">
        <?php echo  $submenu; ?> 
      </div>
    </div>
    <?php } 
    /*------------------------------------------------------
     * CONTENT
     *------------------------------------------------------
     */
    ?>     	
    
    <div class="content">
   
      <?php
        if (!isset($fullwidth)) $fullwidth = false;
        if (!$fullwidth) {
          echo '<div style="margin: 0px auto; max-width:1200px; padding:10px;">';
          print $content;
          echo '</div>';
        }
        else {
          print $content;
        }

      ?>
    </div>
    
    
         
    <div style="clear:both; height:37px;"></div> 

    <div class="footer" style="visibility:hidden"><?php echo _('Powered by '); ?><a href="http://openenergymonitor.org">openenergymonitor.org</a></div>  
    
    <!-- needed for modal -->
    <!-- MOVED TO DASHBOARD_CONFIG_VIEW (declaring jquery here conflics with the jquery lib loaded by the visualisations)-->
  </body>
</html>
