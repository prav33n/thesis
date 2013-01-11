<?php
/*
   All Emoncms code is released under the GNU Affero General Public License.
   See COPYRIGHT.txt and LICENSE.txt.

    ---------------------------------------------------------------------
    Emoncms - open source energy visualisation
    Part of the OpenEnergyMonitor project:
    http://openenergymonitor.org	
	*/

  global $session, $path, $embed;
  $clear = get("clear");
  $apikey = get("apikey");
  $showoptions = get("showoptions")?get("showoptions"):0;

  // Show options if not embeded
  if (!$embed) $showoptions = 1;
?>

<!--[if IE]><script language="javascript" type="text/javascript" src="<?php echo $path;?>Lib/flot/excanvas.min.js"></script><![endif]-->
<script language="javascript" type="text/javascript" src="<?php echo $path;?>Lib/flot/jquery.min.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo $path;?>Lib/flot/jquery.flot.min.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo $path;?>Lib/flot/jquery.flot.selection.min.js"></script>

<script language="javascript" type="text/javascript" src="<?php echo $path; ?>Modules/vis/visualisations/common/api.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo $path; ?>Modules/vis/visualisations/common/inst.js"></script>
<?php if (!$embed) { ?>
<h2>Multigraph</h2>
<?php } ?>
    <div id="graph_bound" style="height:400px; width:100%;">
    <div id="axislabely" style="position:absolute; font-size:20px; left:-15px; top:50%; transform: rotate(-90deg); color:#ffffff;">Watts</div>
     <div id="graph" style="margin-top:5px; margin-left:20px" ></div>
         <div id="holder" style="position:absolute; top:20px; right:20%;" ><div class="btn-group">
        <input class="btn btn-primary time" type="button" value="1H" time="0.04"/>
        <input class="btn btn-primary time" type="button" value="6H" time="0.25"/>
        <input class="btn btn-primary time" type="button" value="D" time="1"/>
        <input class="btn btn-primary time" type="button" value="W" time="7"/>
        <input class="btn btn-primary time" type="button" value="M" time="30"/>
        <input class="btn btn-primary time" type="button" value="Y" time="365"/> 
        <input  class="btn btn-primary" id="zoomin" type="button" value="+"/>
        <input class="btn btn-primary" id="zoomout" type="button" value="-"/>
        <input class="btn btn-primary" id="left" type="button" value="&#60;"/>
        <input class="btn btn-primary" id="right" type="button" value="&#62;"/>
</div></div>
<div id="graph-bottom" style="height:200px; padding: 0px; margin-left:20px"></div>
    </div>
  <br/>
  <?php if ($session['write']) { ?>
  <p><div id="choices"></div><input id="save" type="button" class="button05" value="Save current configuration"/></p>
  <?php } ?>

<script id="source" language="javascript" type="text/javascript">

  var showoptions = <?php echo $showoptions; ?>;

  var embed = <?php echo $embed; ?>;
  $('#graph').width($('#graph_bound').width());
  $('#graph').height($('#graph_bound').height());
 if (embed && showoptions==0) {$('#graph').height($(window).height()-210); $('#graph').width($(window).width()-30);
 $('#graph-bottom').width($(window).width()-30); }
 

  var clear = "<?php echo $clear; ?>";
  var path = "<?php echo $path; ?>";
  var apikey = "<?php echo $apikey; ?>";
  var write_apikey = "<?php echo $write_apikey; ?>";

  var movingtime = 0;
  var timeWindow = (3600000*24.0*0.25);			//Initial time window
  var start = ((new Date()).getTime())-timeWindow;		//Get start time
  var end = (new Date()).getTime();				//Get end time
  var timeWindowChanged = 0;

    var plotdata = [];

  // Load list of feeds from server

  var feedlist = get_multigraph(apikey);
 /* if (feedlist && feedlist[0] && !clear) {
    end = feedlist[0].end;
    if (end==0) end = (new Date()).getTime();
    if (feedlist[0].timeWindow) start = end - feedlist[0].timeWindow;
  } else {
    feedlist = load_feedlist(apikey);
  }

    loop();
   setInterval ( loop, 2000 );
   function loop()
   {
     start = ((new Date()).getTime())-timeWindow;		//Get start time
     end = (new Date()).getTime();				//Get end time
     vis_feed_data();
   }*/
  // Draw feed selector
  var out = "<table class='catlist' style='width:500px'>";
  out += "<tr><th>Select Feeds</th><th width=60px>Left</th><th width=60px>Right</th><th width=60px>Fill</th></tr>";

  for(var i in feedlist) {
    var checkedA = '',checkedB = '',checkedC = '';
    if (feedlist[i].selected)
    {
      if (feedlist[i].plot.yaxis==1) checkedA = 'checked="checked"';
      if (feedlist[i].plot.yaxis==2) checkedB = 'checked="checked"';
      var test = feedlist[i].plot.bars;
      if (test) { if (test.fill==true) checkedC = 'checked="checked"'; }
      var test = feedlist[i].plot.lines;
      if (test) { if (test.fill==true) checkedC = 'checked="checked"'; }
    }

    out += "<tr  class='d"+(i & 1)+"' ><td><label>" + feedlist[i].plot.label + '</label></td>';
    out += '<td><input type="checkbox" id="' + feedlist[i].id + '"' + checkedB + 'axis="2" ></td>';
    out += '<td><input type="checkbox" id="' + feedlist[i].id + '"' + checkedA + 'axis="1" ></td>';
    out += '<td><input type="checkbox" id="' + feedlist[i].id + '"' + checkedC + 'name="fill" ></td></tr>';
  }
  out += "</table>";
  if (showoptions==1) $("#choices").html(out);

  $("#choices").find("input[type='checkbox'][name!='fill']").click(function() {
    var id = $(this).attr("id");
    var axis = $(this).attr("axis");
    var checked = $(this).attr("checked");

    if (axis==1 && checked==true) $("#choices").find("input[id='"+id+"'][axis='2']").removeAttr("checked");
    if (axis==2 && checked==true) $("#choices").find("input[id='"+id+"'][axis='1']").removeAttr("checked");

    for(var i in feedlist) {
      if (feedlist[i].id==id && checked==true) {feedlist[i].selected = 1; feedlist[i].plot.yaxis = Number(axis);}
      if (feedlist[i].id==id && checked==false) feedlist[i].selected = 0;
    }
    timeWindowChanged = 0;
    vis_feed_data();
  });

  $("#choices").find("input[type='checkbox'][name='fill']").click(function() {
    var id = $(this).attr("id");
    var checked = $(this).attr("checked");

    for(var i in feedlist) {
      if (feedlist[i].id==id && feedlist[i].plot.lines) feedlist[i].plot.lines.fill = checked;
      if (feedlist[i].id==id && feedlist[i].plot.bars) feedlist[i].plot.bars.fill = checked;
    }
    timeWindowChanged = 0;
    vis_feed_data();
  });

  vis_feed_data();

  $(window).resize(function(){
    $('#graph').width($('#graph_bound').width());
  //  if (embed && showoptions==0) $('#graph').height($(window).height()-210);
    if (embed && showoptions==1) $('#graph').height($(window).height()-210);
    plot();
  });
  function load_feedlist(apikey)
  {
    var feedlist = [];
    var feedin = get_feed_list(apikey);
    var i =0 ;
    for (z in feedin) {
      if (feedin[z]['datatype']!=3) {
        feedlist[i] = {id: feedin[z]['id'], selected: 0, plot: {data: null, label: feedin[z]['name']} };

        if (feedin[z]['datatype']==1 || feedin[z]['datatype']==0) feedlist[i].plot.lines = { show: true, fill: true };
        if (feedin[z]['datatype']==2) feedlist[i].plot.bars = { show: true, align: "left", barWidth: 3600*24*1000, fill: true};
        i++;
      }
    }
    return feedlist;
  }

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
        if (!feedlist[i].plot.data) feedlist[i].plot.data = get_feed_data(feedlist[i].id,start,end,1000);
        if ( feedlist[i].plot.data) plotdata.push(feedlist[i].plot);
      }
    }
    plot();

    timeWindowChanged=0;
  }

  function plot()
  {
	  //added by praveen
	var d1 = [];
   for (var i = 0; i < plotdata[2]["data"].length; i++)
        d1.push([plotdata[2]["data"][i][0],-1*parseInt(plotdata[2]["data"][i][1])]); 
	plotdata[2]["lines"]["show"]=false;
	plotdata[2]["label"]="";
	
   var plot = $.plot($("#graph"), plotdata, {
      grid: { show: true, hoverable: false, clickable: true}, // backgroundColor: { colors: ["#FFA5A5", "#FFEA98","#CEFFBF"]}
      xaxis: { mode: "time", localTimezone: true, min: start, max: end, color:"#ffffff" },
 	  yaxis: {color:"#ffffff"},
      selection: { mode: "xy" },
      legend: { position: "nw"},
	  colors: ["#009900", "#FF3300"]
    });
	
	console.log(plotdata);
	var o;
    o = plot.pointOffset({ x:0,y:0});
    // we just append it to the placeholder which Flot already uses
    // for positioning
    $("#graph").append('<div style="position:absolute;left:' + (o.left + 4) + 'px;top:' + o.top + 'px;color:#666;font-size:smaller">Warming up</div>');

    //o = plot.pointOffset({ x:2500, y:10});
    //$("#graph").append('<div style="position:absolute;left:' + (o.left + 4) + 'px;top:' + o.top + 'px;color:#666;font-size:smaller">Actual measurements</div>');
	//added by praveen
	/*var d1 = [];
    for (var i = 0; i < plotdata[2]["data"].length; i++)
        d1.push([plotdata[2]["data"][i][0],parseInt(plotdata[2]["data"][i][1])]);*/
    
    var data = [{ data: d1, label: "Net Power", color: "#333" }];
	//console.log(data);
    // setup background areas
    var markings = [
        { color: '#000000', lineWidth: 1, yaxis: { from: 2000,to:2000 } },
        { color: '#000000',lineWidth: 1,  yaxis: { from: -2000,to:-2000 } },
     ];
    
    var placeholder = $("#graph-bottom");
    
    // plot it
    var plot = $.plot(placeholder,data, {
       // bars: { show: true, barWidth: 0.5, fill: 0.8 },
        //xaxis: { ticks: [], autoscaleMargin: 0.02 },
		xaxis: { mode: "time", localTimezone: true, min: start, max: end, show:false, color:"#ffffff"},
        yaxis: { min: -4000, max: 4000, color:"#ffffff" },
        grid: { show:true, hoverable: true, clickable: true, markings: markings, backgroundColor: { colors: ["#CEFFBF","#FFA5A5"] } }
    }); 
	
	//end section
	
	
	
	
	/*var placeholder = $("#graph-bottom");
	var plotdatanet = [];
	plotdatanet.push(plotdata[2]);
	plotdata[2]["label"] = "Net Power"
	console.log(plotdata[2]);
	for(var i =0; i< plotdata[2]["data"].length; i++)
	{ var content = [];
		content.push(0)
		content.push(parseInt(plotdata[2]["data"][i][1]));
		plotdatanet.push(content);
			}
      
   var markings = [
        { color: '#f6f6f6', yaxis: { from: 100 } },
        { color: '#f6f6f6', yaxis: { to: -100 } },
        { color: '#000', lineWidth: 1, xaxis: { from: 2, to: 2 } },
        { color: '#000', lineWidth: 1, xaxis: { from: 8, to: 8 } }
    ];
	
	 var data = [{ data: plotdatanet, label: "Net Power", color: "#333" }];
	 console.log(data);
    // plot it
    var plot = $.plot(placeholder,plotdatanet, {
       bars: { show: true, fill: true },
    	xaxis: { mode: "time", localTimezone: true, min: start, max: end },
      selection: { mode: "xy" },
        grid: {backgroundColor: { colors: ["#FF8080","#AEFF94"] } }
    });*/
	
	
  }

  $("#save").click(function (){
    feedlist[0].timeWindow = end - start;
    if (movingtime) feedlist[0].end = 0; else feedlist[0].end = end;
    movingtime = 0;
    save_multigraph(write_apikey,feedlist);
  });

  //--------------------------------------------------------------------------------------
  // Graph zooming
  //--------------------------------------------------------------------------------------
  $("#graph").bind("plotselected", function (event, ranges) 
  {
     start = ranges.xaxis.from; end = ranges.xaxis.to;
     timeWindowChanged = 1; vis_feed_data();
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

 /* console.log(document.getElementsByTagName("canvas").item(0));
  var canvas = document.getElementsByTagName("canvas").item(1);
  var context = canvas.getContext('2d');
  var height = canvas.height;
  var width =   canvas.width;
  var split = height/3;
    console.log(height);
  context.beginPath();
context.fillStyle = "#FF8080";      
context.fillRect(0, 0,width,split);
context.fillStyle="#FFE16C";
context.fillRect(0,split,width,split);
context.fillStyle="#AEFF94";
context.fillRect(0,split*2,width,split);*/

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
	
	
	/* $("#graph").bind("plothover", function (event, pos, item) {
            if (item) {
                if (previousPoint != item.dataIndex) {
                    previousPoint = item.dataIndex;
                    
                    $("#tooltip").remove();
                    var x = item.datapoint[0].toFixed(2),
                        y = item.datapoint[1].toFixed(2);
                    
                    showTooltip(item.pageX, item.pageY,
                                item.series.label+": " +y+ " = " +(y*0.003).toFixed(2)+" &euro;" );
                }
            }
            else {
                $("#tooltip").remove();
                previousPoint = null;            
            }
        
    });
	
	
	
	 $("#graph-bottom").bind("plothover", function (event, pos, item) {
            if (item) {
                if (previousPoint != item.dataIndex) {
                    previousPoint = item.dataIndex;
                    
                    $("#tooltip").remove();
                    var x = item.datapoint[0].toFixed(2),
                        y = item.datapoint[1].toFixed(2);
                    
                    showTooltip(item.pageX, item.pageY,
                                item.series.label+": " +y+ " = " +(y*0.003).toFixed(2)+" &euro;" );
                }
            }
            else {
                $("#tooltip").remove();
                previousPoint = null;            
            }
        
    });*/
	
		//new grid net power
		
/*$(function () {
    // generate a dataset
    var d1 = [];
    for (var i = 0; i < 20; ++i)
        d1.push([i, Math.sin(i)]);
    
    var data = [{ data: d1, label: "Net Power", color: "#333" }];
	console.log(data);
    // setup background areas
    var markings = [
        { color: '#f6f6f6', yaxis: { from: 100 } },
        { color: '#f6f6f6', yaxis: { to: -100 } },
        { color: '#000', lineWidth: 1, xaxis: { from: 2, to: 2 } },
        { color: '#000', lineWidth: 1, xaxis: { from: 8, to: 8 } }
    ];
    
    var placeholder = $("#graph-bottom");
    
    // plot it
    var plot = $.plot(placeholder,data, {
        bars: { show: true, barWidth: 0.5, fill: 0.9 },
        xaxis: { ticks: [], autoscaleMargin: 0.02 },
        yaxis: { min: -200, max: 200 },
        grid: { markings: markings, backgroundColor: { colors: ["#FF8080","#AEFF94"] } }
    }); 

});*/
    /*
	// add labels
    var o;

    o = plot.pointOffset({ x: 2, y: -1.2});
    // we just append it to the placeholder which Flot already uses
    // for positioning
    placeholder.append('<div style="position:absolute;left:' + (o.left + 4) + 'px;top:' + o.top + 'px;color:#666;font-size:smaller">Warming up</div>');

    o = plot.pointOffset({ x: 8, y: -1.2});
    placeholder.append('<div style="position:absolute;left:' + (o.left + 4) + 'px;top:' + o.top + 'px;color:#666;font-size:smaller">Actual measurements</div>');

    // draw a little arrow on top of the last label to demonstrate
    // canvas drawing
    var ctx = plot.getCanvas().getContext("2d");
    ctx.beginPath();
    o.left += 4;
    ctx.moveTo(o.left, o.top);
    ctx.lineTo(o.left, o.top - 10);
    ctx.lineTo(o.left + 10, o.top - 5);
    ctx.lineTo(o.left, o.top);
    ctx.fillStyle = "#000";
    ctx.fill();*/
</script>

