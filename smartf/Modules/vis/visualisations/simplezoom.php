<!--
   All Emoncms code is released under the GNU Affero General Public License.
   See COPYRIGHT.txt and LICENSE.txt.

    ---------------------------------------------------------------------
    Emoncms - open source energy visualisation
    Part of the OpenEnergyMonitor project:
    http://openenergymonitor.org
-->

<?php
  $apikey = get("apikey");
  $power = get("power");
  $kwhd = get("kwhd");
  $module = get("module");
  global $path, $embed;
?>

<!--[if IE]><script language="javascript" type="text/javascript" src="<?php echo $path;?>Lib/flot/excanvas.min.js"></script><![endif]-->
<script language="javascript" type="text/javascript" src="<?php echo $path;?>Lib/flot/jquery.min.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo $path;?>Lib/flot/jquery.flot.min.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo $path;?>Lib/flot/jquery.flot.selection.min.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo $path;?>Lib/flot/date.format.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo $path; ?>Modules/vis/visualisations/common/api.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo $path; ?>Modules/vis/visualisations/common/inst.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo $path; ?>Modules/vis/visualisations/common/proc.js"></script>
<?php if (!$embed) { ?>
<h2>Simpler kWh/d zoomer</h2>
<?php } ?>

    <div id="graph_bound" style="height:400px;position:relative; margin-top:3px;">
   <div id="axislabely" style=" font-size:20px; position:absolute; left:-10px; top:50%; transform: rotate(-90deg); color:#ffffff;"></div>
      <div id="graph" style="margin-top:10px; margin-left:30px"></div>
       <div id="holder" style="position:absolute; top:10px; right:30%;" > <div class="btn-group">
		<input class="btn btn-primary"id="mode" type="button" value="power" /> 
        <input class="btn btn-primary time" type="button" value="D" time="1"/>
        <input class="btn btn-primary time" type="button" value="W" time="7"/>
        <input class="btn btn-primary time" type="button" value="M" time="30"/>
        <input class="btn btn-primary time" type="button" value="Y" time="365"/>  
        <input  class="btn btn-primary" id="zoomin" type="button" value="+"/>
        <input class="btn btn-primary" id="zoomout" type="button" value="-"/>
        <input class="btn btn-primary" id="left" type="button" value="&#60;"/>
        <input class="btn btn-primary" id="right" type="button" value="&#62;"/>
		</div></div>
        <br/><div id="textbottom" class="alert alert-info"  style="font-size:20px; width:70%; bottom:10px; margin-left:20px; margin-right:20px"></div>
        <h3 style="position:absolute; top:-20px; left:80px;"><span id="stats"></span></h3>
    </div>

<script id="source" language="javascript" type="text/javascript">

  var embed = <?php echo $embed; ?>;

  $('#graph').width($('#graph_bound').width());
  $('#graph').height($('#graph_bound').height());
  if (embed) {$('#graph').height($(window).height()-100); $('#graph').width($(window).width()-50);  }

  var path = "<?php echo $path; ?>";
  var apikey = "<?php echo $apikey; ?>";

  var power = "<?php echo $power; ?>";
  var kwhd = "<?php echo $kwhd; ?>";

  var timeWindow = (3600000*24.0*30);				//Initial time window
  var start = ((new Date()).getTime())-timeWindow;		//Get start time
  var end = (new Date()).getTime();				//Get end time
  var module = "<?php echo $module;?>";
  var kwhd_start = start; var kwhd_end = end;
  var panning = false;

//added by praveen
$("#axislabely").html("Kwhd");
   var kwh_data = get_feed_data(kwhd,0,0,0);
      
      var total = 0, ndays=0;
      for (z in kwh_data) {
        total += parseFloat(kwh_data[z][1]); ndays++;
	  }
	  var price = 0.20;
	  var currency= "&euro;";
	  
var bot_kwhd_text = "<strong> Total: "+(total).toFixed(0)+" kWh : "+currency+(total*price).toFixed(0) + " | Average: "+currency+" "+((total/ndays)*price*24).toFixed(0)+" a Month, "+currency+" "+((total/ndays)*price*365).toFixed(0)+" a year</strong>";
//end section
 $("#textbottom").html(bot_kwhd_text);
 var timeWindowChanged = 0;
 var plotdata = [];
 var feedlist = [];
  feedlist[0] = {id: power, selected: 0, plot: {data: null, lines: { show: true, fill: true } } };
  feedlist[1] = {id: kwhd, selected: 1, plot: {data: null, bars: { show: true, align: "center", barWidth: 3600*18*1000, fill: true }, yaxis:2} };

  $(window).resize(function(){
  
    $('#graph').width($('#graph_bound').width());
    if (embed) {$('#graph').height($(window).height()-100); $('#graph').width($(window).width()-50);}
    plot();
  });

  vis_feed_data();

  /*

  Handle_feeds

  For all feeds in the feedlist:
  - remove all plot data if the time window has changed
  - if the feed is selected load new data
  - add the feed to the multigraph plot
  - plot the multigraph

  */
  function vis_feed_data()
  {
    plotdata = [];
    for(var i in feedlist) {
      if (timeWindowChanged) feedlist[i].plot.data = null;
      if (feedlist[i].selected) {        
        if (!feedlist[i].plot.data) feedlist[i].plot.data = get_feed_data(feedlist[i].id,start,end,500);
        if ( feedlist[i].plot.data) plotdata.push(feedlist[i].plot);
      }
    }

    if (feedlist[0].selected) {
      var stats = power_stats(feedlist[0].plot.data);
      $("#stats").html("Average: "+stats['average'].toFixed(0)+"W | "+stats['kwh'].toFixed(2)+" kWh | Cost : "+(stats['kwh']*0.20).toFixed(2)+"&euro;");
    } else { $("#stats").html(""); }

    plot();

    timeWindowChanged=0;
  }

  function plot()
  {
  
   var markings = [
        { color: '#000000', lineWidth: 2, yaxis: { from: 2.5 ,to:2.5 } },
     ];
  
if(module=="generation"){
		var plot = $.plot($("#graph"), plotdata, {
		      selection: { mode: "x" },
		      grid: { show: true, clickable: true, hoverable: true, backgroundColor: { colors: ["#CEFFBF", "#FFEA98","#FFA5A5"]}, markings:markings },
		      xaxis: { mode: "time", localTimezone: true, min: start, max: end, color:"#ffffff" },
			  yaxis: {color:"#ffffff"},
		      colors: ["#0096ff", "#dba255", "#919733"]
		    });
   }
	else{
		 var plot = $.plot($("#graph"), plotdata, {
		      selection: { mode: "x" },
		      grid: { show: true, clickable: true, hoverable: true, backgroundColor: { colors: ["#FFA5A5", "#FFEA98","#CEFFBF"]}, markings:markings },
		      xaxis: { mode: "time", localTimezone: true, min: start, max: end, color:"#ffffff" },
			  yaxis: {color:"#ffffff"},
			  colors: ["#0096ff", "#dba255", "#919733"]
		    }); 
		}
  }

 $("#graph").bind("plothover", function (event, pos, item) { 
    if (feedlist[1].selected) {
    	if (item){  
      var mdate = new Date(item.datapoint[0]);
      $("#stats").html((item.datapoint[1]).toFixed(1)+"kWh | Cost :" +((item.datapoint[1])*0.20).toFixed(2)+" &euro; |" +mdate.format("ddd, mmm dS, yyyy"));}
    }
	
/*	if (item) { //display cost
                if (previousPoint != item.dataIndex) {
                    previousPoint = item.dataIndex;
                    
                    $("#tooltip").remove();
                    var x = item.datapoint[0].toFixed(2),
                        y = item.datapoint[1].toFixed(2);
				var mode = $("#mode").val(); 
				console.log(mode);

				if(mode=="power")            
                    showTooltip(item.pageX, item.pageY,"Cost = " +(y*0.20).toFixed(2)+" &euro;" );
				else if(mode=="kwhd")            
                    showTooltip(item.pageX, item.pageY,"Cost = " +((y/1000)*0.20).toFixed(2)+" &euro;" );
                }
            }
            else {
                $("#tooltip").remove();
                previousPoint = null;            
            }*/
	
	
  });

  //--------------------------------------------------------------------------------------
  // Graph zooming
  //--------------------------------------------------------------------------------------
  $("#graph").bind("plotselected", function (event, ranges) 
  {
     start = ranges.xaxis.from; end = ranges.xaxis.to;
     timeWindowChanged = 1; vis_feed_data();
     panning = true; setTimeout(function() {panning = false; }, 100);
  });

  //--------------------------------------------------------------------------------------
  // Graph click
  //--------------------------------------------------------------------------------------
  $("#graph").bind("plotclick", function (event, pos, item)
  {
    if (item!=null && feedlist[0].selected == 0 && !panning)
    {
      kwhd_start = start; kwhd_end = end;
      start = item.datapoint[0]; end = item.datapoint[0] + (3600000*24.0);
      timeWindowChanged = 1;
      feedlist[0].selected = 1;
      feedlist[1].selected = 0;
      $('#mode').val("kwhd");
      vis_feed_data();
    }
  });

  //----------------------------------------------------------------------------------------------
  // Operate buttons
  //----------------------------------------------------------------------------------------------
  $("#zoomout").click(function () {inst_zoomout(); vis_feed_data();});
  $("#zoomin").click(function () {inst_zoomin(); vis_feed_data();});
  $('#right').click(function () {inst_panright(); vis_feed_data();});
  $('#left').click(function () {inst_panleft(); vis_feed_data();});
  $('.time').click(function () {inst_timewindow($(this).attr("time")); vis_feed_data();});
  //-----------------------------------------------------------------------------------------------

  $('#mode').click(function () 
  {
    if ($(this).val() == "kwhd") {
      start = kwhd_start; end = kwhd_end; timeWindowChanged = 1;
      feedlist[0].selected = 0;
      feedlist[1].selected = 1;
	  $("#axislabely").html("Kwhd");
      $('#mode').val("power");
    } else if ($(this).val() == "power") {
      feedlist[0].selected = 1;
      feedlist[1].selected = 0;
      $('#mode').val("kwhd");
	  $("#axislabely").html("Kw");
    }
    vis_feed_data();
  });
  
  function showTooltip(x, y, contents) {
        $('<div id="tooltip">' + contents + '</div>').css( {
            position: 'absolute',
            display: 'none',
            top: y + 5,
            left: x + 5,
            border: '1px solid #fdd',
            padding: '2px',
            'background-color': '#fee',
            opacity: 0.80
        }).appendTo("body").fadeIn(200);
    }
	
    var previousPoint = null;
	
	
	 $("#graph").bind("plothover", function (event, pos, item) {
            
        
    });
  
  

</script>

