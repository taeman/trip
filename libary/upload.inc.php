<?
function upload($path, $file, $file_name, $type){
$file_ext 	= strtolower(getFileExtension($file_name));		
global $height;
global $width;

if($type == "all"){

	$approve = "y";
	
}elseif($type == "img"){

	$chk_img = ($file_ext != "jpg" and $file_ext != "gif" and $file_ext != "jpeg"  and $file_ext != "png") ? "n" : "y" ;
	if($chk_img == "y"){
	
		$width 		= (!isset($width) || $width == "") ? 501 : $width ; 
		$height 		= (!isset($height) || $height == "") ? 501 : $height ; 
		$img_size 	= GetImageSize($file);  
		
		if(($img_size[0] >= $width) || ($img_size[1] >= $height)) {
			$approve 	= "n";
			$status[0]	= "error_scale";
		}else{
			$approve 	= "y";
		}
		
	} else {
		$approve 	= "n";
		$status[0]	= "error_img";
	}  
	
} elseif($type == "fla") {

		$approve 	= ($file_ext != "swf") ? "n" : "y" ;
	
} elseif($type == "doc") {

	$chk_doc = ($file_ext != "doc" and $file_ext != "xls" and $file_ext != "pdf" and $file_ext != "zip" and $file_ext != "rar") ? "n" : "y" ;
	if($chk_doc == "y"){
		$approve 	= "y";
	} else {
		$approve 	= "n";
		$status[0]	= "error_doc";
	}

} else {

	$approve 	= "n";
	$status[0]	= "error_type";
	
}

/* -------------------------------------------------------------Check file Exists  */
if($type == "doc"){	
	$file_n		= chk_file($file_name, $path);
	$filename	= $path.$file_n;
} elseif($type == "img" || $type == "fla" || $type == "all") {
	$file_n		= random(6).".".$file_ext;
	$filename 	= $path.$file_n;	
}
$status[1] = $file_n;

/* ---------------------------------------------------------Begin Uploading File */
if($approve == "y"){

	if($file_size >= "2000000") {
		$status[0] = "error_size";		
	} else {	
		if(is_uploaded_file($file)){ 
			if (!copy($file,$filename)){	 
				$status[0] = "error_upload";
			} else {
				$status[0] = "complete";
			}
			unlink($file);  					
		} else { 	$status[0] = "error_cmod";	}	
	}
	
}	
return $status;

}

//Function Delete File
function del_file($temp){
	if(file_exists($temp)){ unlink($temp); }
}

//Function check file exist
function chk_file($file_name, $folder){
	if(file_exists($folder.$file_name)){ 
		
		$f 				= explode(".", $file_name);
		$f_name 	= $f[0];	
		$f_ext 		= $f[1];		

		//find number in () 
		$f_otag 		= (strrpos($f[0], "(") + 1);	
		$f_ctag 		= (strrpos($f[0], ")") - $f_otag) ;		
		$f_num		= substr($f_name, $f_otag, $f_ctag);
		
		//if is number just increse it 		
		if(is_numeric($f_num)){ 	
			$filename 	= substr($f[0],0, strrpos($f[0], "("))."(".($f_num + 1).").".$f[1];					
		} else { 
			$filename 	= $f[0]."(1).".$f[1]; 
		}
		
	} else {	 
			$filename 		= $file_name; 
	}
		
return $filename;	
}

//Status of Uploading
function upload_status($temp){
global $height;
global $width;
$button 		= "<hr size=\"1\"><button name=\"button\" style=\"width:90px;\" onClick=\"history.go(-1);\">Back</button>";
$width 		= (!isset($width) || $width == "") ? 501 : $width ; 
$height 		= (!isset($height) || $height == "") ? 501 : $height ; 

	if($temp == "error_scale"){	
		$msg = "<br><b class=\"warn\">Error</b> : ��Ҵ�ͧ�Ҿ�Թ�ҡ����˹����<br>��Ҵ�ٻ�Ҿ��ͧ����Թ 500 x 500<br>";		
	} elseif($temp == "error_img") 	{	
		$msg = "<br><b class=\"warn\">Error</b><br>�ٻẺ�ͧ file ���١��ͧ<br>�ٻ�Ҿ��ͧ�չ��ʡ���� jpg, jpeg ��� gif ��ҹ��<br>";		
	} elseif($temp == "error_type") 	{	
		$msg = "<br><b class=\"warn\">Error</b><br>�ٻẺ�ͧ file ������������١��ͧ<br>";		
	} elseif($temp == "error_size") 	{	
		$msg = "<br><b class=warn>Error</b><br>�ٻ��Ҵ�ͧ file �ҡ���ҷ���к���˹�<br>����ͧ�բ�Ҵ����Թ 800 Kilo Bytes<br>";
	} elseif($temp == "error_upload") {	
		$msg = "<br><b class=\"warn\">Warning</b><br>����ͼԴ��Ҵ㹡�� Upload ��������к�<br>�ô�Դ��ͼ�����<br>";			
	} elseif($temp == "error_cmod")	{	
		$msg = "<br><b class=\"warn\">Warning</b><br>����ͼԴ��Ҵ㹡�� Upload ��������к�<br>�ô��Ǩ�ͺ CHMOD �ͧ Folder<br>";				
	} elseif($temp == "error_doc"){	
		$msg = "<br><b class=\"warn\">Warning</b><br>�ٻẺ������١��ͧ<br>�͡��õ�ͧ�չ��ʡ���� doc, xls ��� pdf ��ҹ��<br>";			
	} 
$msg	 = ($msg != "") ? $msg.$button : "" ;
return $msg;
}

//Random Generater
function random($length){
	
	$template = "1234567890abcdefghijklmnopqrstuvwxyz";  
    
	settype($length, "integer");
    settype($rndstring, "string");
    settype($a, "integer");
    settype($b, "integer");
      
    for ($a = 0; $a <= $length; $a++) {
    	$b = mt_rand(0, strlen($template) - 1);
        $rndstring .= $template[$b];
    }
       
    return $rndstring;
}

// function ������ʴ���������´��ҧ � �ͧ files ���зӡ�� upload
function getFileExtension($str) 
{
    $i = strrpos($str,".");
    if (!$i) { return ""; }
    $l = strlen($str) - $i;
    $ext = substr($str,$i+1,$l);
	$ext = strtolower($ext);		
    return $ext;
}
?>