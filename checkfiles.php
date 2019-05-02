<?php


function readFiles($path=""){
	$arr_file = array();
	if ($handle = opendir($path)) {
		
		while ($file = readdir($handle)) {
			$arr_file[] = $file;
		}
	
		closedir($handle);
	}
	return $arr_file;
}

$sapphire_files  = readFiles('../cost/attach');
$gnis_files  = readFiles('../cost_gnis/attach');

foreach($gnis_files as $k=>$filename){
	if (in_array($filename, $sapphire_files)) {
    	echo $filename."<br/>";
	}
}

?>
 