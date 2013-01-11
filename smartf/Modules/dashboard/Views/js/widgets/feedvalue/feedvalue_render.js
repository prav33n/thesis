
function feedvalue_widgetlist()
{
  var widgets = {
    "feedvalue": 
    {
      "offsetx":-40,"offsety":-30,"width":80,"height":60,
      "menu":"Widgets",
      "options":["feedname","scale","units"],
      "optionstype":["feed","value","value"]
    }
  }
  return widgets;
}

function feedvalue_init()
{
  feedvalue_draw();
}

function feedvalue_draw()
{
  $('.feedvalue').each(function(index)
  {
    var feed = $(this).attr("feedname");
    if (feed==undefined) feed = $(this).attr("feed");
    var units = $(this).attr("units");
    var val = assoc[feed];
    var scale = $(this).attr("scale");
    if (feed==undefined) val = 0;
    if (units==undefined) units = '&euro;/day';
	if (scale==undefined) scale = 1;
    if (val==undefined) val = 0;

    if (val < 100)
      val = val.toFixed(1);
    else
      val = val.toFixed(0);
	  val= val*parseFloat(scale);
	  val=val.toFixed(2);
    $(this).html(val+" "+units);
	$(this).css("font-size","22px");
	$(this).css("color","white");
  });
}

function feedvalue_slowupdate()
{
  feedvalue_draw();
}

function feedvalue_fastupdate()
{
}


