<?php

$schema['calendar'] = array(
  'id' => array('type' => 'int(11)', 'Null'=>'NO', 'Key'=>'PRI', 'Extra'=>'auto_increment'),
  'userid' => array('type' => 'int(11)'),
  'title' => array('type' => 'varchar(30)'),
  'notes' => array('type' => 'text'),
  'start' => array('type' => 'datetime'),
  'end' => array('type' => 'datetime'),
  'deviceid' => array('type' => 'int(11)')  
);

?>
