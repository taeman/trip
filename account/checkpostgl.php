<?php
session_start();
//ini_set("display_errors","1");
include ("../checklogin.php");
include ("../phpconfig.php");
include ("../libary/function.php");
conn2DB();
/*
$myServer = "THEMAI\SQLEXPRESS"; 
$myUser = "sa"; 
$myPass = "dataadmin"; 
$myDB = "Company_001"; 
*/

$myServer = "202.69.143.78";
$myUser = "sa"; 
$myPass = ""; 
$myDB = "Company_001"; 

//$date_list = $getyear.'-'.$getmonth.'-'.$getday;
if ($action == "delete"){
	$xsql = mysql_query("select attach from `list` where runno = '$runno'")or die("Query line " . __LINE__ . " error<hr>".mysql_error());
	$xrs = mysql_fetch_assoc($xsql);
	if(file_exists($xrs[attach])){ unlink($xrs[attach]); }

	$sql = mysql_query("delete from list where runno = '$runno' ")or die("Query Line " . __LINE__ . " Error<hr>".mysql_error());
	$msg = "<b class='blue'>Complete</b><br>ź���������º��������";
	include("msg_box.php");
	echo "<meta http-equiv='refresh' content='2;url=list.php'>" ;
	exit() ;
}elseif ($action =="endtrip")
{
	$sql = "update list set  endtrip = 'y' where tripid = '$tripid' ";
				@mysql_query($sql);
				if (mysql_errno())
				{
					$msg = "�������ö�ѹ�֡��������";
				}else{
					header("Location: ?tripid=$tripid");
					exit;
				}
}
if ($_SERVER[REQUEST_METHOD] == "POST"){
		 if ($_POST[action]=="edit2")
		 {
				$sql = "update list set  date_list =  '$date_list' , no_ap = '$no_ap' , detail = '$detail' , cash = '$cash' , credit = '$credit' , id_type_credit = '$id_type_credit' , complete = '$complete' , id_type_cost = '$id_type_cost' , project = '$project' ,  note ='$note' , date = 'now()'  where runno = '$runno' ";
				@mysql_query($sql);
				if (mysql_errno())
				{
					$msg = "�������ö�ѹ�֡��������";
				}else{
					header("Location: ?tripid=$tripid");
					exit;
				}
			}
			else
			{
				$sql = "INSERT INTO  list  (date_list,no_ap,detail,cash,credit,id_type_credit,complete,id_type_cost,project,note,date) VALUES  ('$date_list','$no_ap','$detail' , '$cash' , '$credit' , '$id_type_credit' , '$complete' , '$id_type_cost' , '$project' , '$note' , now() )";
				echo $sql;
				$result  = mysql_query($sql);
				if($result)
				{
				header("Location: ?");
				?>
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr align="center">
			<span class="style2">	�к���ӡ�úѹ�֡�����Ţͧ��ҹ���� ��Шзӡ�õԴ��͡�Ѻ�����׹�ѹ�����˹�ҷ���Ѻŧ����¹ ��������Ţ &nbsp; <?=$off_tel;?> ���������� &nbsp; <?=$off_mail?>  </span>
				</tr>
				<tr align="center" >
				<input name="" type="button" value = "   �Դ  "onClick=window.close();> &nbsp;&nbsp;
				<input name="" type="reset"  value = "��Ѻ˹����ѡ"  onClick="location.href='index.php';">
				<tr>
				</table>
				<?
					exit;
				}
				else
				{	
					echo "�������ö�ѹ�֡�������� ";
				}
			}
	} 
	$sql = "select * from  register   where  id='$id' ;";
	$result = mysql_query($sql);
	if ($result){
		$rs=mysql_fetch_array($result,MYSQL_ASSOC);
	} else {
		$msg = "��辺�����ŷ���ͧ���";
	}
	
if(isset($_GET['sort'])){
	if($_GET['sort']=="asc"){
			$sort = "desc";
	}else{
			$sort = "asc";
	}
}else{
	$sort = "asc";
}

$getstr .= "sort=".$sort."&";
?>

<SCRIPT language=JavaScript 

src="bimg/swap.js"></SCRIPT>

<html>

<head>

<title>��§ҹ��������㹡���͡��Ժѵԧҹ</title>

<meta http-equiv="Content-Type" content="text/html; charset=tis-620">

<link href="../cost.css" type="text/css" rel="stylesheet">

<style type="text/css">

<!--

body {  margin: 0px  0px; padding: 0px  0px}

a:link { color: #005CA2; text-decoration: none}

a:visited { color: #005CA2; text-decoration: none}

a:active { color: #0099FF; text-decoration: underline}

a:hover { color: #0099FF; text-decoration: underline}
.style2 {
	color: #000000;
	font-weight: bold;
}
.style4 {
	color: #FFFFFF;
	font-weight: bold;
}

-->

</style>

<!-- check ����кؤ��  -->

<!-- send id to menu flash -->

<script language=javascript>
<!--

//window.top.leftFrame.document.menu.SetVariable("logmenu.id","<?=$id?>");

//	window.top.leftFrame.document.menu.SetVariable("logmenu.action","edit");
	function checkid(){  //�Ǻ������ҧ id 
		f1 = document.form1;
		f1.id.value = f1.id1.value + f1.id2.value + f1.id3.value + f1.id4.value + f1.id5.value;
	}
var isNN = (navigator.appName.indexOf("Netscape")!=-1);
function autoTab(input,len, e) {
	var keyCode = (isNN) ? e.which : e.keyCode; 
	var filter = (isNN) ? [0,8,9] : [0,8,9,16,17,18,37,38,39,40,46];
	if(input.value.length >= len && !containsElement(filter,keyCode)) {
		input.value = input.value.slice(0, len);
		input.form[(getIndex(input)+1) % input.form.length].focus();
	}

	function containsElement(arr, ele) {
	var found = false, index = 0;
		while(!found && index < arr.length)
			if(arr[index] == ele)
				found = true;
			else
				index++;
		return found;
	}

	function getIndex(input) {
		var index = -1, i = 0, found = false;
		while (i < input.form.length && index == -1)
			if (input.form[i] == input)
				index = i;
			else 
				i++;
			return index;
	}

	// add to id
	checkid();
	return true;
}

var isMain = true;
//-->
</script>
</head>
<body >
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td valign="top" background="" style="background-repeat: no-repeat; background-position:right bottom "><?
/*

if ($msg){

		echo "<h1>$msg</h1>";

		exit;
}
*/
?>
      <!-- main Table  -->
      <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#2C2C9E">
        <tr>
          <td height="30" colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">

            <tr>

              <td width="">			  </td>
              </tr>

          </table>
            <span class="style4">��§ҹ��������㹡���͡��Ժѵԧҹ</span></td>

        </tr>

        <tr bgcolor="#CACACA">

          <td width="862" bgcolor="#888888">&nbsp;</td>

          <td width="108" align="right" bgcolor="#888888"><a href="general.php"></a><font style="font-size:16px; font-weight:bold; color:#FFFFFF;">
            <input name="Button25"  title="¡��ԡ" type="button"  style="width: 50;" class="xbutton" value="Exit" onClick="location.href='showtrip.php';" >
            &nbsp;</font>&nbsp;&nbsp;          &nbsp;&nbsp; </td>
        </tr>
      </table>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td align="left" valign="top">
                          <p>&nbsp;</p>
                          <table width="90%" border="0" align="center" cellpadding="1" cellspacing="2" bgcolor="#000000">
                            <tr>
                              <td width="20%" align="center" bgcolor="#A3B2CC"><strong>������</strong></td>
                              <td width="20%" align="center" bgcolor="#A3B2CC"><strong>ʶҹ�</strong></td>
                            </tr>
                            <tr>
                              <td width="20%" align="left" bgcolor="#A3B2CC">�Ţ�����Ӥѭ����</td>
                              <td width="20%" align="center" bgcolor="#A3B2CC">
						    <? 
							  If ($nogl  != "")
							  {
							  echo "<img src=\"../bimg/yy.png\" width=\"16\" height=\"16\"></td> ";
							  $status1 = "y";
							  }else
							  {
							  echo "<img src=\"../bimg/b_drop.png\" width=\"16\" height=\"16\"> ";
							  $status1 = "n";
							  }
							  ?>                            </tr>
                            <tr>
                              <td align="left" bgcolor="#A3B2CC">���ʷ�Ի</td>
                              <td align="center" bgcolor="#A3B2CC"><? 
							  If ($tripid  != "")
							  {
							  echo "<img src=\"../bimg/yy.png\" width=\"16\" height=\"16\"></td> ";
							  $status2 = "y";
							  }else
							  {
							  echo "<img src=\"../bimg/b_drop.png\" width=\"16\" height=\"16\"> ";
							  $status2 = "n";
							  }
							  ?></td>
                            </tr>
                            <tr>
                              <td align="left" bgcolor="#A3B2CC">�����ç��èҡ������͡䫵�</td>
                              <td align="center" bgcolor="#A3B2CC"><? 
							  $sql = "select * from type_project where id_type_project = '$id_type_project' ";
							  $result = mysql_query($sql);
							  $rs = mysql_fetch_assoc($result);
							  If ($rs[code_project]  != "")
							  {
							  echo "<img src=\"../bimg/yy.png\" width=\"16\" height=\"16\"></td> ";
							  $status3 = "y";
							  }else
							  {
							  echo "<img src=\"../bimg/b_drop.png\" width=\"16\" height=\"16\"> ";
							  $status3 = "n";
							  }
							  ?></td>
                            </tr>
                            <tr>
                              <td align="left" bgcolor="#A3B2CC">�����ç��èҡ����� Accrone </td>
                              <td align="center" bgcolor="#A3B2CC">
							  <?
$docdate 		= swapdate($rsd[maxdate]);
$refdocdate 	= swapdate($rsd[maxdate]);
$detail 			= $name.$tripid.$code_project;
//$myServer		= "202.69.143.78";
$myServer 	= "192.168.2.14";
$myUser 		= "sa"; 
$myPass 		= ""; 
$myDB 			= "Company_001"; 


$db = new COM("ADODB.Connection"); 
$dsn = "Provider=sqloledb;Data Source=$myServer;Initial Catalog=$myDB;User Id=$myUser;Password=$myPass;";
@$db->Open($dsn);

	// Check Project 
	$sqlPJID	= "SELECT RecID FROM SMGe_CompProj_ShowGridMain Where Status = 1 and Active = 1  and  DocCode = '$code_project' ";
	$rsPJID 	= @$db->Execute($sqlPJID);

	If ((!$rsPJID) || $rsPJID->EOF)
	{
	$accpj = "none";	
	}else
	{
	$accpj  =  "y";
	}

							   
							  If ($accpj == "y")
							  {
							  echo "<img src=\"../bimg/yy.png\" width=\"16\" height=\"16\"></td> ";
							  $status4 = "y";
							  }else  {
							  echo "<img src=\"../bimg/b_drop.png\" width=\"16\" height=\"16\"> ";
							  $status4 = "n";
							  }
							  ?></td>
                            </tr>
                            <tr>
                              <td align="left" bgcolor="#A3B2CC">�ʹഺԷ-�ôԵ</td>
                              <td align="center" bgcolor="#A3B2CC"><? 
							  If ($sum_debit  == $sum_credit)
							  {
							  echo "<img src=\"../bimg/yy.png\" width=\"16\" height=\"16\"></td> ";
							  $status5 = "y";
							  }else
							  {
							  echo "<img src=\"../bimg/b_drop.png\" width=\"16\" height=\"16\"> ";
							  $status5 = "n";
							  }
							  ?></td>
                            </tr>
                          </table>
                          <p>&nbsp;</p>
                          <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#CCCCCC">
                            <tr>
                              <td width="15%" align="center">
							  <?
							  If (($status1 == "y") and ($status2 == "y") and ($status3 == "y") and ($status4 == "y") and ($status5 == "y"))
							  {
							  ?>
							  <img src="../bimg/report.gif" width="16" height="16"><a href="postgl.php?tripid=<?=$tripid?>&nogl=<?=$nogl?>&id_type_project=<?=$id_type_project?>&code_project=<?=$code_project?>&sum_debit=<?=$sum_debit?>&sum_credit=<?=$sum_credit?>">Post GL </a>
							  <?
							  }else
							  {
							  echo " �������ö�ʷ��������" ;
							  }
							  ?>
							  </td>
                            </tr>
                          </table>
                          <p>&nbsp;</p>
                          <p>&nbsp;</p>
                        </td>
                      </tr>
                  </table>
				  </td>
                </tr>
              </table>
</td>
        </tr>
     </table>
    </td>
  </tr>
  
 <?
@$db->Close();
  ?>
</table>
</body>
</html>

