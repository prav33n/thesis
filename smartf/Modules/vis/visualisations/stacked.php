<!--
   All Emoncms code is released under the GNU General Public License v3.
   See COPYRIGHT.txt and LICENSE.txt.

    ---------------------------------------------------------------------
    Emoncms - open source energy visualisation
    Part of the OpenEnergyMonitor project:
    http://openenergymonitor.org
-->
  <?php  
    global $path, $embed;
    $kwhdA = get('kwhda');
    $kwhdB = get('kwhdb');
	$kwhdC = get('kwhdc');
    $apikey = get('apikey');
  ?>

<!--[if IE]><script language="javascript" type="text/javascript" src="<?php echo $path;?>Lib/flot/excanvas.min.js"></script><![endif]-->
<script language="javascript" type="text/javascript" src="<?php echo $path;?>Lib/flot/jquery.min.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo $path;?>Lib/flot/jquery.flot.min.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo $path;?>Lib/flot/jquery.flot.selection.min.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo $path;?>Lib/flot/jquery.flot.stack.min.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo $path;?>Lib/flot/date.format.js"></script>

<script language="javascript" type="text/javascript" src="<?php echo $path;?>Modules/vis/visualisations/common/api.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo $path;?>Modules/vis/visualisations/common/daysmonthsyears.js"></script>

<?php if (!$embed) { ?>
<h2>Stacked</h2>
<?php } ?>

    <div id="test" style="height:400px; width:100%; position:relative; ">
      <div id="placeholder" style="font-family: arial;"></div>
      <div id="loading" style="position:absolute; top:0px; left:0px; width:100%; height:100%; background-color: rgba(255,255,255,0.5);"></div>
      <h2 style="position:absolute; top:0px; left:40px;"><span id="out"></span></h2>
    </div>

    <script id="source" language="javascript" type="text/javascript">
      var kwhdA = <?php echo $kwhdA; ?>;   
      var kwhdB = <?php echo $kwhdB; ?>;
      var path = "<?php echo $path; ?>";  
	  var embed = "<?php echo $embed; ?>"; 
	    $('#placeholder').width($('#test').width());
        $('#placeholder').height($('#test').height());
      if (embed) {$('#placeholder').height($(window).height()); $('#placeholder').width($(window).width()-30);  }
	  
      // API key
      var apikey = "<?php echo $apikey?>";

      var dataA = get_feed_data(kwhdA,0,0,0);
      var dataB = get_feed_data(kwhdB,0,0,0);
        $('#loading').hide();
        var view = 0;
 
        var daysA = [];
        var monthsA = [];
		var labelA, labelB;
        var daysB = [];
        var monthsB = [];
		var daysC = [];
        var monthsC = [];
        monthsA = get_months(dataA);
        monthsB = get_months(dataB);

        bargraph(monthsA.data,monthsB.data,3600*24*20,"month");

        $("#placeholder").bind("plotclick", function (event, pos, item)
        {
          if (item!=null)
          {
            if (view==1)
            {

            }
            if (view==0)
            {
              var d = new Date();
              d.setTime(item.datapoint[0]);
              daysA = get_days_month(dataA,d.getMonth(),d.getFullYear());
              daysB = get_days_month(dataB,d.getMonth(),d.getFullYear());
              bargraph(daysA,daysB,3600*22,"day");
              view = 1;
              $("#out").html("");
            }
          }
          else
          {
            
            if (view==1) { $("#out").html(""); view = 0; bargraph(monthsA.data,monthsB.data,3600*24*20,"month"); }     
            if (view==2) { $("#out").html(""); view = 1; bargraph(daysA,daysB,3600*22,"day"); }      
          }
        });

        $("#placeholder").bind("plothover", function (event, pos, item)
        {
          if (item!=null)
          {
            var d = new Date();
            d.setTime(item.datapoint[0]);
            var mdate = new Date(item.datapoint[0]);
            if (view==0) $("#out").html(item.datapoint[1].toFixed(1)+" kWh/d | Cost : "+(item.datapoint[1]*0.20).toFixed(0)+"&euro;| "+mdate.format("mmm yyyy"));
            if (view==1) $("#out").html(item.datapoint[1].toFixed(1)+" kWh/d | Cost : "+(item.datapoint[1]*0.20).toFixed(0)+"&euro;| "+mdate.format("dS mmm yyyy"));
          }
        });

        function bargraph(dataA,dataB,barwidth, mode)
        {
          $.plot($("#placeholder"), [ {data:dataA, label:"Power Generated" }, {data:dataB, label:"Power Consumed"}], 
          {
            series: {
            stack: true,
            bars: { show: true,align: "center",barWidth: (barwidth*1000),fill: true }
            },
			legend: { show:true},
  	       grid: { show: true, hoverable: true, clickable: true},
            xaxis: { mode: "time", localTimezone: true, minTickSize: [1, mode],
                 tickLength: 1, color:"#ffffff" },
		  yaxis: {color:"#ffffff"},
		  colors: ["#8533FF","#0096ff","#dba255"],
		  
          });
        }
		
	$(window).resize(function(){
    if (embed) {$('#placeholder').height($(window).height()); $('#placeholder').width($(window).width()-30);}
    bargraph(monthsA.data,monthsB.data,3600*24*20,"month");
  });
		
		
    </script>
