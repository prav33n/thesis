<?php
    //$url="http://192.168.2.137:1925/1/ambilight/cached";
   // depthpost("http://localhost/smartf/input/post?json={power-generated:200}&apikey=95876437f3b43ac241fdcd29658770ff", "");
   //depthpost("http://192.168.2.137:1925/1/ambilight/mode",'{"current": "manual"}');
 // var_dump(json_encode('{"layer1":{"r":0,"g":255,"b":9}}'));  			//indicate to use post method
 //depthpost("http://". $tvip.":1925/1/ambilight/mode",'{"current": "manual"}');
// depthpost("http://".$tvip.":1925/1/ambilight/cached",'{"layer1":{"r":0,"g":255,"b":0}}');
function depthpost($url,$json)
{ 
	$cookie_jar = "cookie.txt";
    $options = array(       
		CURLOPT_RETURNTRANSFER => true,     // return web page        
		CURLOPT_HEADER         => false,    // don't return headers 
		CURLINFO_HEADER_OUT => true, // trace requests 
		CURLOPT_FOLLOWLOCATION => true,     // follow redirects 
		CURLOPT_USERAGENT      => "Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.2) Gecko/20090729 Firefox/3.5.2 GTB5", 		// who am i 
		CURLOPT_COOKIEJAR => $cookie_jar, //set cookies
		CURLOPT_COOKIEFILE => $cookie_jar, //send cookies in file      
		CURLOPT_ENCODING       => "",       // handle all encodings        4
		CURLOPT_HTTPHEADER => array('Content-Type: application/x-www-form-urlencoded'),
		CURLOPT_AUTOREFERER    => true,     // set referer on redirect        
		CURLOPT_CONNECTTIMEOUT => 120,      // timeout on connect        
		CURLOPT_TIMEOUT        => 120,      // timeout on response        
		CURLOPT_MAXREDIRS      => 10,       // stop after 10 redirects   
		CURLOPT_SSL_VERIFYPEER => false,		
		CURLOPT_SSL_VERIFYHOST => false,
		CURLOPT_SSL_VERIFYHOST => false,
		CURLOPT_POST => true,
		CURLOPT_POSTFIELDS => $json  			//indicate to use post method
	);
	
	$ch      = curl_init( $url);   
	curl_setopt_array( $ch, $options );    
	$content = curl_exec( $ch );    
	$err     = curl_errno( $ch );    
	$errmsg  = curl_error( $ch );    
	$header  = curl_getinfo( $ch );
	$header['errno']   = $err;    
	$header['errmsg']  = $errmsg;    
	$header['content'] = $content;
    $code = curl_getinfo($ch, CURLINFO_HTTP_CODE); 
	/*$errlog = $_POST['RESDIR']."/errorlog.txt";
        $fe = fopen($errlog, 'a') or die("Could not create file!");
        if($code == 400 || $code == 401 || $code == 403 || $code == 404 || $code == 408 || $code == 301)
        {fwrite($fe,$_POST['QNUMBER']."|".$_POST['DIR']."|".$_POST['URL']."|Http error |".$code."\r\n");}*/
	echo $header['content'];
	curl_close( $ch ); 
}
?>