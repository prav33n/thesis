<?php 

  /*

  list_view.php - licence GNU GPL Affero, Author Trystan Lea

  Overview is always on a annual basis so the requirement of any energy input
  is to calculate an annual figure.

  I see there being several levels of calculator

  	1. basic inline form
  	2. auto energy monitor
 	3. detailed form calculator

  the overview page has basic inline calculator and can link to more detailed calculators.

  Each item should have a property list and a processor function

  green electric:	annual use				straight conversion
  wood:			annual use	stove efficiency	% efficiency
  oil:			annual use	boiler efficiency	
  car:			annual use	mpg	petrol		car proc

  wood: { options:{'annual m3', 'efficiency'}, convert:{ kwh:1380, unitcost:63.5 }, process_function: 2

  */

  global $path; 
?>
<script type="text/javascript" src="<?php echo $path; ?>Lib/flot/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo $path; ?>Modules/energy/stack_lib/stacks.js"></script>
<script type="text/javascript" src="<?php echo $path; ?>Modules/energy/stack_lib/stack_prepare.js"></script>

<div style="width:900px; margin-bottom:10px;" >
  <span style="font-size:24px; font-weight:bold;">Energy Items</span>
  <span style="font-size:24px; float:right;">Year 2012</span>
</div>

<div style="width:600px;  float:left; margin-right:10px;">

  <div id="energyitems"></div>

  <div style="width:600px; background-color:#efefef; margin-bottom:10px; border: 1px solid #ddd">
    <div style="padding:10px;  border-top: 1px solid #fff">
      <div style="float:left; padding-top:2px; font-weight:bold;">Add new item</div>

      <div style="float:right;">
      <select id="additemselect" style="width:160px; margin:0px;">
      <?php while ($energytype = current($energytypes)) { ?>
      <option value="<?php echo key($energytypes); ?>"><?php echo $energytype['name']; ?></option>
      <?php next($energytypes); } ?>
      </select>

      <input id="additem" type="submit" value="Add" class="btn btn-info" />
      </div>
      <div style="clear:both"></div>

    </div>
  </div>

</div>

<div style="width:300px; height:520px; float:left; margin-bottom:10px; text-align:center; border: 1px solid #ccc; padding-left:20px;">
  <canvas id="can" width="300" height="460"></canvas> 
  <i style="font-size:12px; color:#444;">To embed in dashboard goto:<br> Dashboard > Edit > Widgets > stack</i>
</div>
      <div style="clear:both"></div>
  <div style="padding:10px;">
  <div style="width:55px; float:left;"><input id="save" type="submit" value="Save" /></div><div id="saved" style="padding-top:4px; color: #444; font-size:12px;">Saved</div>
  </div>
<script type="application/javascript">
  var path = "<?php echo $path; ?>";
  var energytypes = <?php echo json_encode($energytypes); ?>;
  var energyitems = <?php echo json_encode($energyitems); ?>; 

  order_energyitems();

  for (z in energyitems)
  {
    energyitems[z]['data'] = JSON.parse(energyitems[z]['data'] || "null");
  }

  drawItems();

  var stacks = prepare_stack();
  draw_stacks(stacks,"can",300,460);

  $("#additem").click(function(){
    var tag = $("#additemselect").val();
    var item = {'tag':tag,'year':"2012",'data':{"quantity":0, "efficiency":100}}
    energyitems.push(item);
    order_energyitems();
    drawItems();

    var stacks = prepare_stack(energyitems,energytypes);
    draw_stacks(stacks,"can",300,460);

    $("#saved").html("");
  });

  $("#save").click(function(){
    $.ajax({                                      
      type: "GET",
      url: path+"energy/save.json",           
      data: "&data="+encodeURIComponent(JSON.stringify(energyitems)),
      success: function(msg) {if (msg=="saved") $("#saved").html("Saved");} 
    });
  });

  function drawItems()
  {
    var out = "";

    for (z in energyitems)
    {
      var id = z;
      var tag = energyitems[z]['tag'];
      var name = energytypes[tag]['name'];
      var units = energytypes[tag]['units'];
      var conv_kwh = energytypes[tag]['kwh'];

      var data = energyitems[z]['data'];
      var kwhd = 0;
      if (energytypes[tag]['procfn']==1) kwhd = calc_total(z);
      if (energytypes[tag]['procfn']==2) kwhd = calc_total(z);
      if (energytypes[tag]['procfn']==3) kwhd = calc_total_mpg(z);

      out += '<div style="width:600px; background-color:#f8f8f8; margin-bottom:10px; border: 1px solid #eee">';
      out += '<div style="padding:10px;  border-top: 1px solid #fff">'

      // Draw item name and kwh/d
      out += '<div style="margin-bottom:8px;">';        
      out += '<span style="font-size:20px;">'+name+'</span>';
      out += '<div style="float:right; margin-top:5px; margin-left:8px; cursor: pointer;" href="" class="removeitem" item="'+id+'"><i class="icon-trash"></i></div>'
      out += '<div style="font-size:20px; float:right; "><span id="kwhval'+id+'" >'+kwhd.toFixed(0)+'</span> kWh/d</div>';
      out += '</div>'
 

      var options = energytypes[tag]['options'];
      for (i in options)
      {
        if (data[i]==undefined) data[i] = options[i]['default'];
        out += '<div style="width:250px; float:left;"><b>'+options[i]['name']+':</b> <input class="option" tag="'+i+'" item="'+id+'" type="text" style="width:100px" value="'+data[i]+'"/ > <b>'+options[i]['units']+'</b></div>';

      }

      out += '<div style="clear:both"></div>';
      out += '</div>';
      out += '</div>';
    }

    $("#energyitems").html(out);

    $(".option").keyup(function(){
      var tag = $(this).attr('tag');
      var id = $(this).attr('item');
      var val = $(this).val();
      energyitems[id]['data'][tag] = val;

      var tag = energyitems[id]['tag'];

      var kwhd = 0;
      if (energytypes[tag]['procfn']==1) kwhd = calc_total(id);
      if (energytypes[tag]['procfn']==2) kwhd = calc_total(id);
      if (energytypes[tag]['procfn']==3) kwhd = calc_total_mpg(id);
      $("#kwhval"+id).html(kwhd.toFixed(0));

      var stacks = prepare_stack(energyitems,energytypes);
      draw_stacks(stacks,"can",300,460);
      $("#saved").html("");
    });

    $(".removeitem").click(function(){
      var id = $(this).attr('item');
      
      $.ajax({                                      
        type: "GET",
        url: path+"energy/item/remove.json",           
        data: "&tag="+energyitems[id]['tag'],
        success: function(msg) {console.log(msg);} 
      });

      energyitems.splice(id,1); 

      drawItems();
      var stacks = prepare_stack(energyitems,energytypes);
      draw_stacks(stacks,"can",300,460);
    });
  }
 
</script>
