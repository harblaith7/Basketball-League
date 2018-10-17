<?php
$folders = [
  'Providers',
  'Utilities',
	'Controllers'
];
foreach($folders as $folder){
  foreach(glob($folder."/*.php") as $file){
    include $file;
  }
}
$_POST = Data::convertObjToArr(json_decode(file_get_contents("php://input")));print Router::enable();
