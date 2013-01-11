<?php

	$year = date('Y');
	$month = date('m');

	echo json_encode(array(
	
		array(
			'id' => 1,
			'title' => "washing",
			'start' => "$year-$month-29",
			'url' => "washing machine"
		),
		
		array(
			'id' => 2,
			'title' => "Drying",
			'start' => "$year-$month-29",
			'end' => "$year-$month-30",
			'url' => "Television"
		),
		
		array(
			'id' => 3,
			'title' => "TV show - Family Guy",
			'start' => "$year-$month-29",
			'end' => "$year-$month-29",
			'url' => "Television"
		)
	
	));
	

?>
