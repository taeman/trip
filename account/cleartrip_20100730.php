<?php
session_start();
//ini_set("display_errors","1");
include ("../checklogin.php");
include ("../phpconfig.php");
include ("../libary/function.php");
conn2DB();
if ($_SERVER[REQUEST_METHOD] == "POST"){
		 if ($action =="close")
		 {
		 		Foreach ($checkbox as $key => $id)
				{
					if ($close > ""){
						$sql = "update list  set cleartrip = 'y' where runno = $id ";
					}else{
						$sql = "update list  set cleartrip  = '' where runno = $id ";
					}
					@mysql_query($sql);
				}
				if (mysql_errno())
				{
					$msg = "�������ö�ѹ�֡��������";
				}else{
					header("Location: ?tripid=$tripid");
					exit;
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
src="../bimg/swap.js"></SCRIPT>
<html>
<head>
<title>�к��ѹ�֡��������</title>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
<link href="../cost.css" type="text/css" rel="stylesheet">
<style type="text/css">
<!--
body {  margin: 0px  0px; padding: 0px  0px}
a:link { color: #005CA2; text-decoration: none}

a:visited { color: #005CA2; text-decoration: none}

a:active { color: #0099FF; text-decoration: underline}

a:hover { color: #0099FF; text-decoration: underline}
.style4 {
	color: #FFFFFF;
	font-weight: bold;
}
.style9 {color: #000000}
-->
</style>
<!-- check ����кؤ��  -->
<script language="javascript"  src="../libary/popcalendar.js"></script>
<script language=javascript>
<!--

//window.top.leftFrame.document.menu.SetVariable("logmenu.id","<?=$id?>");

//	window.top.leftFrame.document.menu.SetVariable("logmenu.action","edit");
/*
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
*/
</script>

</head>
<body >
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td valign="top" background="" style="background-repeat: no-repeat; background-position:right bottom ">
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
                          <br>
						  <form name="form2" method="post" action="?action=search">
                          <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
                            <tr>
                              <td>���͡��ǧ�ѹ���</td>
                              <td><span class="style9">
                                <input type="text" name="startday" id="Txt-Field" class="input" maxlength="10" style="width:200px;" value="<? if($rs[date_list] == ""){ echo date("d/m/").(date("Y") ); }else{ echo swapdate($rs[date_list]); }?>" >
                              </span></td>
                              <td><span class="style9">
                                <input type="text" name="endday" id="getday" class="input" maxlength="10" style="width:200px;" value="<? if($rs[date_list] == ""){ echo date("d/m/").(date("Y") ); }else{ echo swapdate($rs[date_list]); }?>">
                              </span></td>
                              <td><label>
                                <select name="show" id="show">
                                  <option value="log">�͡��÷��ѹ�֡</option>
                                  <option value="now">�͡��÷�����������ҧ��û�͹��¡��</option>
                                  <option value="close">�͡��÷��ѹ�֡���������������</option>
                                  <option value="clear">�͡��÷���ҹ��õ�Ǩ�Ѻ</option>
                                  <option value="finish">�͡��÷����ػ���������������</option>
                                </select>
                              </label></td>
                              <td>
                                <label></label>
                                  <label>
                                    <input type="submit" name="Submit" value="Submit">
                                  </label>
                                <label></label></td>
                            </tr>
                          </table>
     					 </form>
                          <br>
                          <form  name ="form1" method = POST  action = "?action=close"   >
						   <INPUT TYPE="hidden" NAME="tripid" VALUE="<?=$tripid?>">
                          <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
                            <tr>
							<!--<INPUT TYPE="hidden" NAME="tripid" VALUE="<?=$tripid?>">
                              <input type="checkbox" name="checkbox2" value="checkbox" onClick="CheckAll()"> 
                              ���͡������</td>
                              <td><a href="trip.php?tripid=<?=$tripid?>&sname=<?=$sname?>&ssurname=<?=$ssurname?>"></a></td>
                              <td>&nbsp; -->
                              <td width="1%">
							  </td>
							  <?
	$word = "��¡�ä������·���ѧ�����ӡ�ûԴ��¡�÷ҧ�ѭ�� ��� Tripid ��� $tripid";
	$i=0;
	$no=0;
	If ($sortfield == "")
	{
		$sortstring = "";
	}else
	{
		$sortstring = "order by $sortfield $sort";
	}
	$startday = swapdate($startday);
	$endday = swapdate($endday);
	If (($action == "search") and ($show == "log")) // ������ ����ѹ���Ӻѹ�֡��¡��
	{
		$str = " select * from list where date between '$startday' and '$endday' $sortstring  ";
		$word = "��§ҹ�ʴ���¡�õ���ѹ���Ӻѹ�֡��¡�� ������ѹ���".daythai($startday)." �֧ �ѹ���".daythai($endday)   ;
	}elseif (($action == "search") and ($show == "now")) // ���������͡��÷�����������ҧ�ѹ�֡��¡��
	{ 
		$str = "select * from list where (date_list between '$startday' and '$endday') and (endtrip is null or endtrip = '') ";
		$word = "��§ҹ�ʴ���¡�õ���͡��÷�����������ҧ�ѹ�֡��¡�� ������ѹ���".daythai($startday)." �֧ �ѹ���".daythai($endday)   ;	
	}elseif  (($action == "search") and ($show == "close"))  // ���������͡��÷��ѹ�֡���������������
	{
		$str = "select * from list where (date_list between '$startday' and '$endday') and (endtrip ='y') and (cleartrip  is null or cleartrip = '') ";
		$word = "��§ҹ�ʴ���¡�õ���͡��÷��ѹ�֡��������������� ������ѹ���".daythai($startday)." �֧ �ѹ���".daythai($endday)   ;	
	
	}elseif (($action == "search") and ($show == "clear"))  // ���������͡��÷���ҹ��õ�Ǩ�Ѻ
	{
		$str = "select * from list where (date_list between '$startday' and '$endday') and (endtrip ='y') and (cleartrip = 'y') and (close  is null or close = '')  ";
		$word = "��§ҹ�ʴ���¡�õ���͡��÷���ҹ��õ�Ǩ�Ѻ ������ѹ���".daythai($startday)." �֧ �ѹ���".daythai($endday)   ;	
	}elseif (($action == "search") and ($show == "finish"))  // ���������͡��÷����ػ���������������
	{
		$str = "select * from list where (date_list between '$startday' and '$endday') and (endtrip ='y') and (cleartrip = 'y') and (close = 'y')  ";
		$word = "��§ҹ�ʴ���¡�õ���͡��÷����ػ��������������� ������ѹ���".daythai($startday)." �֧ �ѹ���".daythai($endday)   ;	
	}else
	{
	 $str = " select * from list where (tripid = '$tripid') and (endtrip  = 'y')  and (cleartrip is null  or cleartrip = '' )  $sortstring ";
	}
?>
							  <td>
							<?
							  echo  $word ;
							  ?>
							 </td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                            </tr>
                          </table>
                          <table width="98%" border="0" cellspacing="2" cellpadding="2" align="center" bgcolor="black">
                            <tr bgcolor="#A3B2CC" align="center">
                              <td width="3%" rowspan="3">���͡��¡��</td>
                              <td width="3%" rowspan="3"><strong>�ӴѺ</strong></td>
                              <td rowspan="3" bgcolor="#A3B2CC"><strong><a href="?<?=$getstr?>sortfield=date_list&tripid=<?=$tripid?>&action=<?=$action?>&show=<?=$show?>&startday=<?=$startday?>&endday=<?=$endday?>">�ѹ���</a></strong></td>
                              <td rowspan="3" bgcolor="#A3B2CC">&nbsp;</td>
                              <td rowspan="3" bgcolor="#A3B2CC"><strong>��¡��</strong></td>
                              <td rowspan="3" bgcolor="#A3B2CC"><strong><a href="?<?=$getstr?>sortfield=tripid&action=<?=$action?>&show=<?=$show?>&startday=<?=$startday?>&endday=<?=$endday?>">���;�ѡ�ҹ</a></strong></td>
                              <td rowspan="3" bgcolor="#A3B2CC"><a href="?<?=$getstr?>sortfield=tripid&action=<?=$action?>&show=<?=$show?>&startday=<?=$startday?>&endday=<?=$endday?>&startday=<?=$startday?>&endday=<?=$endday?>">TripID</a></td>
                              <td colspan="2" bgcolor="#A3B2CC"><strong>�ӹǹ�Թ</strong></td>
                              <td rowspan="3" bgcolor="#A3B2CC"><strong><a href="?<?=$getstr?>sortfield=id_type_project&tripid=<?=$tripid?>&action=<?=$action?>&show=<?=$show?>&startday=<?=$startday?>&endday=<?=$endday?>">�ç���</a></strong></td>
                              <td rowspan="3" bgcolor="#A3B2CC"><strong><a href="?<?=$getstr?>sortfield=complete&tripid=<?=$tripid?>&action=<?=$action?>&show=<?=$show?>&startday=<?=$startday?>&endday=<?=$endday?>">BILL</a></strong></td>
                              <td rowspan="3" bgcolor="#A3B2CC">&nbsp;</td>
                            </tr>
                            <tr bgcolor="#A3B2CC" align="center">
                              <td><strong>CASH</strong></td>
                              <td><strong>CREDIT</strong></td>
                            </tr>
                            <tr bgcolor="#A3B2CC" align="center">
                              <td><strong>���</strong></td>
                              <td><strong>���</strong></td>
                            </tr>
    <?
	$result = mysql_query($str);
	//echo $str;
	while ($rs=mysql_fetch_array($result,MYSQL_ASSOC)){
		$i++;
		$no++;
		if ($i % 2) {
		$bg = "#EFEFEF";
		}else{
		$bg = "#DDDDDD";
		}
		if($rs[attach] != ""){ $attach = "<a href=\"../".$rs[attach]."\"><img src=\"../bimg/attach.gif\" border=\"0\"></a>"; } else { $attach = "";}		
?>
                            <tr bgcolor="<?=$bg?>" align="center">
                              <td width="3%"><label>
                                <input type="checkbox" name="checkbox[]" value="<?=$rs[runno]?>"  <? if ($c =="0") echo "disabled";?>>
                              </label></td>
                              <td width="3%"><?=$no?></td>
                              <td bgcolor="<?=$bg?>"><?=daythai($rs[date_list])?></td>
                              <td align="left" bgcolor="<?=$bg?>"><?
				$trip = 0;
				$closed = $ended = $cleared = true;
		//	//	$sqlcheck = "select * from list  where tripid='$rs[tripid]' ; ";
				$resultcheck = mysql_query($sqlcheck);
		//		while ($rscheck=mysql_fetch_array($resultcheck,MYSQL_ASSOC)) {
					if ($rs["close"] != "y")  $closed = false;
					if ($rs["endtrip"] != "y")  $ended = false;
					if ($rs["cleartrip"] != "y")  $cleared = false;
			//	}

				if ($closed){
					echo "<img src=\"../bimg/finish.gif\" width=\"15\" height=\"15\">";
				}else if ($cleared){
					echo "<img src=\"../bimg/close.gif\" width=\"15\" height=\"15\">";
				}else if ($ended){
					echo "<img src=\"../bimg/clear.gif\" width=\"15\" height=\"15\">";
				}else{
					echo "<img src=\"../bimg/start.gif\" width=\"15\" height=\"15\">";
				}
				?></td>
                              <td align="left" bgcolor="<?=$bg?>"><?="&nbsp;".$attach.$rs[detail]?>      </td>
                              <td align="left" bgcolor="<?=$bg?>">
                                <?=GetTripOwner($rs[tripid])?>
                              </td>
                              <td align="left" bgcolor="<?=$bg?>"><?=$rs[tripid]?></td>
                              <td align="right" bgcolor="<?=$bg?>"><?=number_format($rs[cash_total],2)?></td>
                              <td align="right" bgcolor="<?=$bg?>"><?=number_format($rs[credit_total],2)?></td>
                              <td bgcolor="<?=$bg?>">
							  <?
							  $res = mysql_query("select * from type_project");
							  while ($rss = mysql_fetch_assoc($res))
							  {
							  If ($rs[id_type_project] == $rss[id_type_project])
							  	{
							  		echo "$rss[code_project]";
							  	}
							  }
							  ?>							  </td>
                              <td bgcolor="<?=$bg?>"><?
							  If ($rs[complete] =="y")
							  {
							  	echo "<img src=\"../bimg/yy.png\" >";
							  }elseif ($rs[complete] =="n")
							  {
							  	echo  "<img src=\"../bimg/alert.gif\" >";
							  }
							  ?></td>
                              <td bgcolor="<?=$bg?>"><a href="cost_add.php?runno=<?=$rs[runno]?>&tripid=<?=$tripid?>&action=edit2"><img src="../bimg/b_edit.png" width="16" height="16" border="0" alt="Edit"></a> &nbsp; <a href="#" onClick="if (confirm('�س�зӡ��ź��������ǹ�����������!!')) location.href='?action=delete&runno=<?=$rs[runno]?>&tripid=<?=$tripid?>';" ><img src="../bimg/b_drop.png" width="16" height="16" border="0" alt="Delete"></a></td>
                              <?
	} //while
// List Template
?>
                          </table>
						  <br>
						  <table width="98%" border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#333333">
                            <tr valign="middle">
                              <td align="right" width="290" height="32">&nbsp;&nbsp;</td>
                              <td align="right" width="300" height="32"><input name="open" type="submit" id="open" value="�Դ��¡��">
                              &nbsp;&nbsp;
                              <input name="close" type="submit" id="close" value="�Դ��¡��">
                              &nbsp; &nbsp;&nbsp;</td>
                            </tr>
                          </table>
						  </form>
						  <table width="95%" border="0" align="center" cellpadding="1" cellspacing="1">
                            <tr>
                              <td width="20">&nbsp;</td>
                              <td>&nbsp;</td>
                            </tr>
                            <tr>
                              <td width="20"><img src="../bimg/finish.gif" width="15" height="15"></td>
                              <td>��ػ���������������</td>
                            </tr>
                            <tr>
                              <td width="20"><img src="../bimg/close.gif" width="15" height="15"></td>
                              <td>��ҹ��õ�Ǩ�Ѻ�͡��� �͡��͹��ѵ� </td>
                            </tr>
                            <tr>
                              <td width="20"><img src="../bimg/clear.gif" width="15" height="15"></td>
                              <td>�ѹ�֡��¡�ä��������������</td>
                            </tr>
                            <tr>
                              <td width="20"><img src="../bimg/start.gif" width="15" height="15"></td>
                              <td>����������ҧ��û�͹��¡��</td>
                            </tr>
                          </table>
						  <br>
	</td>
  </tr>
</table>
</body>
</html>