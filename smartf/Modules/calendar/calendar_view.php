<?php
  global $session, $theme, $path,$route;
  //var_dump($events[0]["id"],$events[0]["title"],$events[0]["notes"],$events[0]["start"],$events[0]["end"]) ;
 ?>
<link rel='stylesheet' type='text/css' href="<?php echo $path; ?>Modules/calendar/js/fullcalendar.css" />
<div id="scrollcontianer" class ="pull-right" >Press button to Scroll Calendar <a href="javascript:" id="up" class="btn" ><i class="icon-chevron-up"></i></a><a href="javascript:" id="down" class="btn" ><i class="icon-chevron-down"></i></a></div>
<br/>
<div id="container" class="Container-White" style="width:1250px; height:590px; overflow:hidden" >
<div id='modulecalendar'></div></div>
<script type="text/javascript" src="<?php echo $path; ?>Modules/calendar/js/jquery-ui-1.8.23.custom.min.js"></script>
<script type="text/javascript" src="<?php echo $path; ?>Modules/calendar/js/fullcalendar.js"></script>
<script type="text/javascript" src="<?php echo $path; ?>Modules/calendar/js/gcal.js"></script>
<script type='text/javascript'>
var date = new Date();
var d = date.getDate();
var m = date.getMonth();
var y = date.getFullYear();
		var calendar = $('#modulecalendar').fullCalendar({
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,agendaWeek,agendaDay'	
			},	
			height:590,
			defaultView:'agendaDay',
			firstHour:10,
			//lazyFetching:true,		
			selectable: true,
			selectHelper: true,
			//mouseover event
eventMouseover:function( event, jsEvent, view ) { 
	$(this).css('border-color', '#FF0000');
},
eventMouseout:function( event, jsEvent, view ) { 
	$(this).css('border-color', '#FF6A45');
},
//mouse click event show model
loading:function( isLoading, view ){$('#container').innerHTML("loading");},
			select: function(start, end, allDay) {
				var title = prompt('Event Title:');
				if (title) {
					calendar.fullCalendar('renderEvent',
						{
							title: title,
							start: start,
							end: end,
							allDay: allDay
						},
						true // make the event "stick"
					);
				}
				calendar.fullCalendar('unselect');
			},
			editable: true,
			
			  events: [
						{
							id:1,
							title: 'smart system maintanance',
							start: new Date(y, m, d)
						},
						{
							id:2,
							title: 'Smart Schedule system',
							start: new Date(y, m, d+1,10,0),
							end: new Date(y, m, d+1,11,0),
							backgroundColor:'orange'
						},
						{
							id:4,
							title: 'Low Power Price',
							start: new Date(y, m, d,10,0),
							end: new Date(y, m, d,11,0),
							backgroundColor:'orange',
							allDay:false
						},
						
						{
							id: 999,
							title: 'TV show - Dexter',
							start: new Date(y, m, d, 16, 0),
							end: new Date(y, m, d, 16, 30),
							allDay: false
						},
						{
							id:3,
							title: 'Laundry time - Consider changing the schedule',
							start: new Date(y, m, d, 19, 0),
							end: new Date(y, m, d, 21, 0),
							backgroundColor:'red',
							allDay: false
						},
					]
	}); 


		
		$('#up').bind('click' , function(){
		    $('#scrollcalendar').scrollTop( $('#scrollcalendar').scrollTop()-50);

		});
		$('#down').bind('click' , function(){
		    $('#scrollcalendar').scrollTop($('#scrollcalendar').scrollTop()+50);

		});

</script>
