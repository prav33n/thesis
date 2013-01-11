<?php 
/*http://localhost/smartf/input/post?
json={power-generated:195,power-consumed:450,power-cost:10,power-light:20,power-heating:50,power-wind:20,power-solar:30,power-wind:10,power-net:100,
power-grid:10,ev-charge:40,temp:20}
*/


require "ambilight.php";
set_time_limit(60*60*12);
$serverip ="http://praveenjelish.kodingen.com";
for ($i = 0;$i<1000; $i++) {
   $data= $serverip."/smartf/input/post?json=".generategeneralconsumption()."&apikey=95876437f3b43ac241fdcd29658770ff";
   depthpost($data, "");
   if(($i%25)==0){
   	$data= $serverip."/smartf/input/post?json=".generatemidconsumption()."&apikey=95876437f3b43ac241fdcd29658770ff";
   depthpost($data, "");
   }
 if(($i%50)==0){
   $data= $serverip."/smartf/input/post?json=".generatemaxconsumption()."&apikey=95876437f3b43ac241fdcd29658770ff";
   depthpost($data, "");
   }
   var_dump($data);
   sleep(20);
}


function generategeneralconsumption(){
	$air_conditioner = rand(500, 1000);
	$light = 100;
	$thermostat = rand(500,1500);
	$computer = 100;
	$printer = 20;
	$telephone=20;
	$fridge = rand(100,150);
	$waterheater = rand(500,700);
	$power_consumed = $air_conditioner+($light*3)+$thermostat+$computer+$printer+$telephone+$fridge+$waterheater;
	$power_wind = rand(0,800);
	$power_solar = rand(0,600);	 
	$power_stored = rand(0,100);
	$power_generated = $power_solar+$power_wind;
	$power_net = $power_consumed - $power_generated;	 
$data ='{device-air-conditioner:'.$air_conditioner.
		',device-light-1:'.$light.
		',device-light-2:'.$light.
		',device-light-3:'.$light.
		',device-thermostat-1:'.$thermostat.
		',device-thermostat-2:'.$thermostat.
		',device-computer:'.$computer.
		',device-router:'.$telephone.
		',device-printer:'.$printer.
		',device-waterheater:'.$waterheater.
		',device-telephone:'.$telephone.
		',device-fridge:'.$fridge.
		',power-consumed:'.$power_consumed.
		',power-wind:'.$power_wind.
		',power-solar:'.$power_solar.
		',power-generated:'.$power_generated.
		',power-net:'.$power_net.
		'}';
return($data);
}

function generatemidconsumption(){
	
	$electricfan = 100;
	$television	= rand(200,300);
	$light = 60;
	$console = 200;
	$ev = rand(100,200);
	$coffeemachine = 300;
	$air_conditioner = rand(500, 1000);
	$light = 100;
	$thermostat = rand(500,1500);
	$computer = 100;
	$printer = 20;
	$telephone=20;
	$fridge = rand(100,150);
	$waterheater = rand(500,700);
	$power_consumed = $air_conditioner+($light*3)+$thermostat+$computer+$printer+$telephone+$fridge+$waterheater+$coffeemachine+$ev+$television+$electricfan;
	$power_wind = rand(0,800);
	$power_solar = rand(0,600);	 
	$power_stored = rand(0,100);
	$power_generated = $power_solar+$power_wind;
	$power_net = $power_consumed - $power_generated;	 
$data ='{device-air-conditioner:'.$air_conditioner.
		',device-light-1:'.$light.
		',device-light-2:'.$light.
		',device-light-3:'.$light.
		',device-thermostat-1:'.$thermostat.
		',device-thermostat-2:'.$thermostat.
		',device-computer:'.$computer.
		',device-router:'.$telephone.
		',device-printer:'.$printer.
		',device-waterheater:'.$waterheater.
		',device-telephone:'.$telephone.
		',power-consumed:'.$power_consumed.
		',power-wind:'.$power_wind.
		',power-solar:'.$power_solar.
		',power-generated:'.$power_generated.
		',power-net:'.$power_net.
		'device-efan:'.$electricfan.
	',device-tv:'.$television.
	',device-light-4:'. $light.
	',device-console:'.$console.
	',device-ev:'.$ev.
	',device-coffee-machine:'.$coffeemachine.
	'}';
return($data);	
}


function generatemaxconsumption(){
	$air_conditioner = rand(500, 1000);
	$light = 100;
	$thermostat = rand(500,1500);
	$computer = 100;
	$printer = 20;
	$telephone=20;
	$fridge = rand(100,150);
	$waterheater = rand(500,700);
	$dishwasher = rand(1200,1500);
	$washingmachine = rand(700, 1000);
	$lawnmower = 500;
	$power_consumed = $air_conditioner+($light*3)+$thermostat+$computer+$printer+$telephone+$fridge+$waterheater+$dishwasher+$washingmachine+$lawnmower;
	$power_wind = rand(0,800);
	$power_solar = rand(0,600);	 
	$power_stored = rand(0,100);
	$power_generated = $power_solar+$power_wind;
	$power_net = $power_consumed - $power_generated;	 
$data ='{device-air-conditioner:'.$air_conditioner.
		',device-light-1:'.$light.
		',device-light-2:'.$light.
		',device-light-3:'.$light.
		',device-thermostat-1:'.$thermostat.
		',device-thermostat-2:'.$thermostat.
		',device-computer:'.$computer.
		',device-router:'.$telephone.
		',device-printer:'.$printer.
		',device-waterheater:'.$waterheater.
		',device-telephone:'.$telephone.
		',power-consumed:'.$power_consumed.
		',power-wind:'.$power_wind.
		',power-solar:'.$power_solar.
		',power-generated:'.$power_generated.
		',power-net:'.$power_net.
		',device-dishwasher:'.$dishwasher.
	',device-washingmachine:'.$washingmachine.
	',lawnmower:'.$lawnmower.
	'}';
	return($data);	
}


?>