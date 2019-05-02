<script language="JavaScript" type="text/javascript"> 
var xmlHttp = XmlHttpRequestObject();
function XmlHttpRequestObject()
{ 
	var objXmlHttp = null
	if (navigator.userAgent.indexOf("Opera")>=0)
	{
		alert("Error creating the XMLHttpRequest object.") 
		return 
	}

	if (navigator.userAgent.indexOf("MSIE")>=0)
	{ 
		var strName	="MSXML2.XMLHTTP"
		if (navigator.appVersion.indexOf("MSIE 5.5")>=0)
		{
			strName="Microsoft.XMLHTTP"
		} try { 
			objXmlHttp	= new ActiveXObject(strName)
			return objXmlHttp
		} catch(e) { 
			alert("Error. Scripting for ActiveX might be disabled") 
			return 
		} 
	} 

	if (navigator.userAgent.indexOf("Mozilla")>=0)
	{
		objXmlHttp				= new XMLHttpRequest()
		objXmlHttp.onload	= handler
		objXmlHttp.onerror	= handler 
		return objXmlHttp
	}
}

<!-- --------------------------------------------------------Hidden Status Bar -->
function hidestatus(){
window.status=''
return true
}

if (document.layers)
document.captureEvents(Event.MOUSEOVER | Event.MOUSEOUT)

document.onmouseover	= hidestatus
document.onmouseout	= hidestatus

<!-- --------------------------------------------Flip Color when mouse Over -->
function mOvr(src,clrOver){ 
if (!src.contains(event.fromElement)){ 
src.style.cursor = 'hand'; 
src.bgColor = clrOver; 
} 
} 

<!-- ---------------------------------------------Flip Color when mouse Out -->
function mOut(src,clrIn){ 
if (!src.contains(event.toElement)){ 
src.style.cursor = 'default'; 
src.bgColor = clrIn; 
} 
} 

<!-- ------------------------------------------------------------Check Number -->
function Filter_Keyboard() {
  var keycode = window.event.keyCode;
  if( keycode >=37 && keycode <=40 ) 	return true;  // arrow left, up, right, down  
  if( keycode >=48 && keycode <=57 ) 	return true;  // key 0-9
  if( keycode >=96 && keycode <=105) 	return true;  // numpad 0-9
  if( keycode ==110 || keycode ==190) 	return true;  // dot
  if( keycode ==8) 									return true;  // backspace
  if( keycode ==9) 									return true;  // tab
  if( keycode ==45 ||  keycode ==46 || keycode ==35 || keycode ==36) return true;  // insert, del, end, home
  return false;
}
</script>
<?

//Swap date format in 2006-06-12 to 12/06/2006
function swapdate($temp){
	$kwd = strrpos($temp, "/");
	if($kwd != ""){
		$d = explode("/", $temp);
		$ndate = $d[2]."-".$d[1]."-".$d[0];
	} else { 		
		$d = explode("-", $temp);
		$ndate = $d[2]."/".$d[1]."/".$d[0];
	}
	return $ndate;
}

//function ������ʴ��ѹ���Ẻ��� ��� edocument
function daythai($temp){
if($temp != "0000-00-00"){

	$month 	= array("���Ҥ�", "����Ҿѹ��", "�չҤ�", "����¹", "����Ҥ�", "�Զع�¹", "�á�Ҥ�", "�ԧ�Ҥ�", "�ѹ��¹", "���Ҥ�", "��Ȩԡ�¹", "�ѹ�Ҥ�"); 
	$num 	= explode("-", $temp);			
	if($num[0] == "0000"){
	  $date 	= "����к�";
	} else {
	  $tyear = $num[0] +  543;
	  $date 	= remove_zero($num[2])."&nbsp;".$month[$num[1] - 1 ]."&nbsp;".$tyear;	
	}

} else {
	$date = "����к�";
}	
	return $date;
}

function shortday($temp){
if($temp != "0000-00-00"){

	$month 	= array("�.�.", "�.�.", "��.�.", "�.�.", "�.�.", "��.�.", "�.�.", "�.�.", "�.�.", "�.�.", "�.�.", "�.�."); 
	$num 	= explode("-", $temp);			
	if($num[0] == "0000"){
	  $date 	= "����к�";
	} else {
	  $tyear = $num[0] +  543;
	  $date 	= remove_zero($num[2])."&nbsp;".$month[$num[1] - 1 ]."&nbsp;".$tyear;	
	}

} else {
	$date = "����к�";
}	
	return $date;
}

//function ������ʴ��ѹ���Ẻ���
function fulldate($temp)
{
	$date = explode(" ", $temp);
	$temp = $date[0];
	$month = array("���Ҥ�", "����Ҿѹ��", "�չҤ�", "����¹", "����Ҥ�", "�Զع�¹", "�á�Ҥ�", "�ԧ�Ҥ�", "�ѹ��¹", "���Ҥ�", "��Ȩԡ�¹", "�ѹ�Ҥ�");
	$num = explode("-", $temp);		
	$day = $num[2];
	$tyear = $num[0] + 543;
	$date = "<font class=\"normal_black\">".$day."</font>&nbsp;".$month[$num[1] - 1 ]."&nbsp;�.�.&nbsp;<font class=\"normal_black\">".$tyear."</font>";	
	return $date;
}

function remove_zero($temp) 
{
	$num_chk = strlen($temp);
	if($num_chk == 2) {	
		$num_1 = substr($temp, 0, 1);  
		if($num_1 == 0){ 
			$rnum = substr($temp, 1, 2); 
		} else { 
			$rnum = $temp; 
		}
	} else { 
	$rnum = $temp; 
	}
	return $rnum;
}

function add_zero($temp) 
{
	$num_chk = strlen($temp);
	if($num_chk == 1) {	
		$rnum = "0".$temp;
	} else {
		$rnum = $temp;
	}
	return $rnum;
}

function upload($path, $file, $file_name, $type){
$file_ext 	= strtolower(getFileExtension($file_name));		
global $height;
global $width;

if($type == "all"){

	$approve = "y";
	
}elseif($type == "img"){

	$chk_img = ($file_ext != "jpg" and $file_ext != "gif" and $file_ext != "jpeg"  and $file_ext != "png") ? "n" : "y" ;
	if($chk_img == "y"){
	
		$width 		= (!isset($width) || $width == "") ? 801 : $width ; 
		$height 		= (!isset($height) || $height == "") ? 801 : $height ; 
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
$width 		= (!isset($width) || $width == "") ? 801 : $width ; 
$height 		= (!isset($height) || $height == "") ? 801 : $height ; 

	if($temp == "error_scale"){	
		$msg = "<br><b class=\"warn\">Error</b> : ��Ҵ�ͧ�Ҿ�Թ�ҡ����˹����<br>��Ҵ�ٻ�Ҿ��ͧ����Թ $height x $width<br>";		
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

//Use in AJAX for decode
function post_decode($string) {
	$str = $string;
    $res = "";
    for ($i = 0; $i < strlen($str); $i++) {
    	if (ord($str[$i]) == 224) {
        	$unicode = ord($str[$i+2]) & 0x3F;
            $unicode |= (ord($str[$i+1]) & 0x3F) << 6;
            $unicode |= (ord($str[$i]) & 0x0F) << 12;
            $res .= chr($unicode-0x0E00+0xA0);
            $i += 2;
       	} else {
            $res .= $str[$i];
        }
	}
    return $res;
}

// ��ǹ�ͧ����ʴ������š����˹��
function devide_page($all, $record, $kwd){
$per_page		= 11;
$page_all 		= ceil($all / $per_page);
global $page;

if($all >= 1){

	$table	= "<table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">";
	$table	= $table."<tr valign=\"top\" align=\"right\">";
	$table	= $table."<td width=\"80%\" align=\"left\">&nbsp;";
		
//first Eleven Page
if($page <= $per_page){

	$max		=	($all <= $per_page) ? $all : $per_page ; 			
	for($i=1;$i<=$max;$i++) 
	{
		if($i != $page){ 
			$table	= $table."<a href=\"?mode=$_GET[mode]&vmode=$_GET[vmode]&page=".$i.$kwd."\" style=\"text-decoration:none;\"><font color=\"blue\">".$i."</font></a>&nbsp;";  
		} else { 
			$table	= $table."<font color=\"red\">".$i."</font>&nbsp;";  
		}
	}
		
	if($max < $all){ 	
			$table	= $table."<a href=\"?mode=$_GET[mode]&vmode=$_GET[vmode]&page=".($i++).$kwd."\" style=\"text-decoration:none;\">></a>&nbsp;"; 
			$table	= $table."<a href=\"?mode=$_GET[mode]&vmode=$_GET[vmode]&page=".$all.$kwd."\" style=\"text-decoration:none;\">>></a>&nbsp;"; 
	}
	unset($max,$i);
	
} elseif($page > $per_page) {

	$min 	= $page - 5;		
	$max		= (($page + 5) >=  $all) ? $all : $page + 5 ;
	$table	= $table."<a href=\"?mode=$_GET[mode]&vmode=$_GET[vmode]&page=1".$kwd."\" style=\"text-decoration:none;\"><b><<</b></a>&nbsp;";
	$table	= $table."<a href=\"?mode=$_GET[mode]&vmode=$_GET[vmode]&page=".($min--).$kwd."\" style=\"text-decoration:none;\"><b><</b></a>&nbsp;";
	for($i=$min;$i<=$max;$i++) 
	{
		if($i != $page){ 
			$table	= $table."<a href=\"?mode=$_GET[mode]&vmode=$_GET[vmode]&page=$i$kwd\" style=\"text-decoration:none;\"><font color=\"blue\">".$i."</font></a>&nbsp;";  
		} else { 
			$table	= $table."<font color=\"red\">".$i."</font>&nbsp;";  
		}
	}	
	
	if($max < $all){
		$table	= $table."&nbsp;<a href=\"?mode=$_GET[mode]&vmode=$_GET[vmode]&page=".($max++).$kwd."\" style=\"text-decoration:none;\"><b>></b></a>";
		$table	= $table."&nbsp;<a href=\"?mode=$_GET[mode]&vmode=$_GET[vmode]&page=".$all.$kwd."\" style=\"text-decoration:none;\"><b>>></b></a>&nbsp;"; 
	}	
}                  
	if ($max > 1){ //����ҡ���� 1 ˹��
		$table   = $table." <A HREF=\"?mode=$_GET[mode]&vmode=$_GET[vmode]&e=1000000$kwd\" >�ʴ�������</A>";
	}

	$table	= $table."</td>";
	$table	= $table."<td width=\"10%\">".number_format($record, 0, "", ",")."&nbsp;��¡��&nbsp;</td>";
	$table	= $table."<td width=\"10%\">".number_format($all, 0, "", ",")."&nbsp;˹��&nbsp;</td>";
	$table	= $table."</tr>";
	$table	= $table."</table>";
}
 	return $table;
}


function cpdate($First, $Second)
{

	$first_date 			= explode ("-", $First);
	$second_date 		= explode ("-", $Second);

	$intFirstDay 			= $first_date[2];
	$intFirstMonth 		= $first_date[1];
	$intFirstYear 			= $first_date[0];

	$intSecondDay 		= $second_date[2];
	$intSecondMonth	= $second_date[1];
	$intSecondYear 		= $second_date[0];

	$intDate1Jul 			= gregoriantojd($intFirstMonth, $intFirstDay, $intFirstYear);
	$intDate2Jul 			= gregoriantojd($intSecondMonth, $intSecondDay, $intSecondYear);

$diff_date 	= $intDate1Jul - $intDate2Jul + 1;
//$diff_date	= ($diff_date <= 0) ? "<font color=red>".abs($diff_date)."</font>" : "<font color=green>".$diff_date."<font>";
$diff_date	= ($diff_date <= 0) ? "<font color=red>".($diff_date)."</font>" : "<font color=green>".$diff_date."<font>";
return $diff_date;
}

function swapyear($temp, $lang){
	if($temp != ""){
		
		$d	 		= explode("-", $temp);
		$year	= ($lang == "t") ? $d[0] + 543 : $d[0] - 543 ;
		return $year."-".$d[1]."-".$d[2];	
	} else {
		return false;
	}
}

//Function Trim data
function trimtxt($temp, $val){

	$txtchk = strlen($temp);
	if($txtchk > $val){ 	
		$txt= substr($temp,0 ,$val); 
		$txt = $txt."...";		
	} else { 
		$txt = $temp; 
	}
	return $txt;
}

//Email function
function sendmail($mail_to, $mail_subject, $mail_msg, $mail_from){

	$to 			= $mail_to;
	$subject 	= $mail_subject;
	$msg 		= "
	<head>
	<title> HTML content</title>
	</head>
	<body>".$mail_msg."</body>
	</html>
	";
	$headers 	= "From: ".$mail_from."\n";
	$headers	.= "Reply-To: ".$mail_from."\n";
	$headers	.= "Content-Type: text/html; charset=tis-620"; 
	mail("$to", "$subject", "$msg", "$headers");

}

function showpic($getfile_att,$getproblem,$getproblem_result,$reportid){
	if($getfile_att){
		$msg1 = "<a href=\"daily_file_attach.php?id=$reportid\"><img src=\"images/attach16.gif\" width=\"14\" height=\"14\" border=0></a>";
	}else{
		$msg1 ="";
	}	
	if($getproblem){
		$msg2 = "<a href=\"daily_report_detailview.php?id=$reportid\"><img src=\"../../images_sys/alert.gif\" width=\"14\" height=\"14\" border=0></a>";
	}else{
		$msg2 ="";
	}
	if($getproblem_result){
		$msg3 = "<a href=\"daily_report_detailview.php?id=$reportid\"><img src=\"images/alert_red.gif\" width=\"14\" height=\"14\" border=0></a>";
	}else{
		$msg3 ="";
	}
	$picview = "$msg1|||$msg2|||$msg3";
	return $picview;
}

?>