// JavaScript Document
function increase_lumins(){
	var wid = $('#light-lumins').width(); 
	$('#light-lumins').width(wid+20);
	}

function decrease_lumins(){
	var wid = $('#light-lumins').width(); 
	$('#light-lumins').width(wid-20);
	}

function increase_temp(){
	var wid = parseInt($(document.getElementById('temprature')).html()); 
	$(document.getElementById('temprature')).html(wid+1);
}

function decrease_temp(){
	var wid = parseInt($(document.getElementById('temprature')).html()); 
	$(document.getElementById('temprature')).html(wid-1);
}
 function buttontoggle(element){
	 console.log($(element).html());
	if($(element).html()=== "ON"){
	 $(element).html("OFF");
 	$(element).attr("href","#");
	 $(element).removeClass("btn-success").addClass("btn-warning");
		}
	 else if($(element).html()=== "OFF"){
	 $(element).html("ON");
	 	 var modal = $(element).attr("mode");
	 $(element).attr("href","#"+modal);
	
    $(element).removeClass("btn-warning").addClass("btn-success");	}
	 
 }
 
 function togglecontent(element){
	$((element).attr("href")).tab('show'); 
	//console.log($(document).find('table[class*="active"]').removeClass("active"));
	//console.log($(document).find('li[class*="active"]').removeClass("active"));
	$(document).find('table[class*="in"]').removeClass("in")
	$(document).find('li[class*="active"]').removeClass("active");
	 $(element).parent(this).addClass("active");
	 $($(element).attr("href")).addClass("active in");
	 }