<?php global $session, $path, $route;?>
  <script type="text/javascript" src="<?php echo $path; ?>Lib/flot/jquery.flot.min.js"></script>
  <script type="text/javascript" src="<?php echo $path; ?>Modules/dashboard/Views/js/widgetlist.js"></script>
  <script type="text/javascript" src="<?php echo $path; ?>Modules/dashboard/Views/js/render.js"></script>
  <script language="javascript" type="text/javascript" src="<?php echo $path;?>Lib/flot/date.format.js"></script> 
  <script type="text/javascript">
 var id = <?php 
 if($route['subaction'] == "")
 echo "home";
 else
 echo $route['subaction']; ?> ;
 
				//Initial time window
  var start = ((new Date()).getTime())-timeWindow;		//Get start time
  var end = (new Date()).getTime();			

  var d = new Date();
  var curr_date = d.getDate();
  var timeWindow = (3600000*curr_data*30);
    var curr_month = d.getMonth() + 1; //Months are zero based
    var curr_year = d.getFullYear();
 
 
 $(id).addClass("active");
  </script>
  
  <?php

    $widgets = array();
    $dir = scandir("Modules/dashboard/Views/js/widgets");
    for ($i=2; $i<count($dir); $i++)
    {
      if (filetype("Modules/dashboard/Views/js/widgets/".$dir[$i])=='dir') 
      {
        if (is_file("Modules/dashboard/Views/js/widgets/".$dir[$i]."/".$dir[$i]."_widget.php"))
        {
          require_once "Modules/dashboard/Views/js/widgets/".$dir[$i]."/".$dir[$i]."_widget.php";
          $widgets[] = $dir[$i];
        }
        else if (is_file("Modules/dashboard/Views/js/widgets/".$dir[$i]."/".$dir[$i]."_render.js"))
        {
          echo "<script type='text/javascript' src='".$path."Modules/dashboard/Views/js/widgets/".$dir[$i]."/".$dir[$i]."_render.js'></script>";
          $widgets[] = $dir[$i];
        }
      }
    }

  ?>

  <div id="page-container" style="height:<?php echo $dashboard['height'];?>px; position:relative;">
    <div id="page"><?php echo $dashboard['content']; ?></div>
  </div>

<script type="application/javascript">
  var dashid = <?php echo $dashboard['id']; ?>;
  var path = "<?php echo $path; ?>";
  var apikey_read = "<?php echo $apikey_read; ?>";
  var widget = <?php echo json_encode($widgets); ?>;

  for (var z in widget)
  {
    var fname = widget[z]+"_widgetlist";
    var fn = window[fname];
    $.extend(widgets,fn());
  }

  var redraw = 1;
  var reloadiframe = 0;
  show_dashboard();
  setInterval(function() { update("<?php echo $apikey_read; ?>"); }, 10000);
  setInterval(function() { fast_update("<?php echo $apikey_read; ?>"); }, 30);

</script>
