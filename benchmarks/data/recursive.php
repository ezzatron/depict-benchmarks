<?php

$array = array();
$array[] = &$array;
$object = (object) array();
$object->object = $object;
$object->array = $array;
$array[] = $object;

return array($array, $object);
