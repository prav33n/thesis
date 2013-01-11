<?php

$schema['control'] = array(
  'devid' => array('type' => 'int(11)', 'Null'=>'NO', 'Key'=>'PRI', 'Extra'=>'auto_increment'),
  'userid' => array('type' => 'int(11)'),
  'content' => array('type' => 'text'),
  'devname' => array('type' => "varchar(30)", 'default'=>'no name'),
  'roomid' => array('type'=>'int(11)'),
  'devdescription' => array('type' => "varchar(255)", 'default'=>'no description'),
  'feedid' => array('type' => 'int(11)', 'default'=>1),
  'location' => array('type' => "Point"),
  'img' => array('type' => "varchar(30)", 'default'=>'empty') ,
  'ipaddr' => array('type' =>"varchar(30)")
);

?>