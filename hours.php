<?php
header('Content-Type: application/json; charset=utf-8');
$file=__DIR__.'/hours.json';
if(file_exists($file)){
  $json=file_get_contents($file);
  if($json){echo $json;exit;}
}
echo json_encode([
  'Senin'=>['open'=>'06:00','close'=>'21:00','closed'=>false],
  'Selasa'=>['open'=>'06:00','close'=>'21:00','closed'=>false],
  'Rabu'=>['open'=>'06:00','close'=>'21:00','closed'=>false],
  'Kamis'=>['open'=>'06:00','close'=>'21:00','closed'=>false],
  'Jumat'=>['open'=>'06:00','close'=>'21:00','closed'=>false],
  'Sabtu'=>['open'=>'06:00','close'=>'21:00','closed'=>false],
  'Minggu'=>['open'=>'08:00','close'=>'21:00','closed'=>false],
],JSON_UNESCAPED_UNICODE);
