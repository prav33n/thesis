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
global $path, $session, $route;

?>

  <link rel="stylesheet" type="text/css" href="<?php echo $path; ?>Theme/basic/styleh.css"/>
 <link rel="stylesheet" type="text/css" href="<?php echo $path; ?>Lib/clock/jquery.jdigiclock.css" />
<script type="text/javascript" src="<?php echo $path; ?>Lib/clock/jquery.jdigiclock.js"></script>

<div id="iconmenu" style="margin-top:50px;">
        <ul class="ch-grid" >
					<li>
						<div class="ch-item ch-img-1">
                           	<div class="ch-info" onclick="javascript:location.href='<?php echo $path;?>dashboard/view'">
								<h3><a href="<?php echo $path; ?>dashboard/view">Dashboard</a></h3>
								<p><a href="<?php echo $path; ?>dashboard/view">Power Consumption  Dashboard</a></p>
							</div>
						</div>
					</li>
					<li>
						<div class="ch-item ch-img-2">
							<div class="ch-info" onclick="javascript:location.href='<?php echo $path;?>control/view'">
								<h3><a href="<?php echo $path; ?>control/view">Control</a></h3>
								<p><a href="<?php echo $path; ?>control/view">Control Household devices</a></p>
							</div>
						</div>
					</li>
					<li>
						<div class="ch-item ch-img-3">
							<div class="ch-info" onclick="javascript:location.href='<?php echo $path;?>calendar/view'">
								<h3><a href="<?php echo $path; ?>calendar/view">Calendar</a></h3>
								<p><a href="<?php echo $path; ?>calendar/view">View scheduled activities and energy price</a></p>
							</div>
						</div>
					</li>
                    	<li>
						<div class="ch-item ch-img-4">
							<div class="ch-info" onclick="javascript:location.href='<?php echo $path;?>settings/view'">
								<h3><a href="<?php echo $path; ?>settings/view">Settings</a></h3>
								<p><a href="<?php echo $path; ?>settings/view">Set automation settings and energy sharing</a></p>
							</div>
						</div>
					</li> 
				</ul> </div>
                <div id="clock" style="width:100%; text-align: center; ">
   <div id="digiclock" style="margin-top:10px; margin-left:30%;"></div></div>             
 <script type="text/javascript">
  $('#digiclock').jdigiclock({
            clockImagesPath:"<?php echo $path;?>Lib/clock/images/clock/",
			weatherImagesPath : "<?php echo $path;?>Lib/clock/images/weather/",
			weatherLocationCode :"EUR|NL|NL007|BREDA",
			weatherMetric :"C",
			proxyType:"php"
		      });
</script>