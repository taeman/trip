<?
/*****************************************************************************
Function		: ��䢢����Ţͧ epm_staff
Version			: 1.0
Last Modified	: 16/8/2548
Changes		:
*****************************************************************************/
set_time_limit(0);
include ("checklogin.php");
include ("phpconfig.php");
Conn2DB();
$report_title = "�ؤ�ҡ�";
$org_id = intval($org_id);

$epm_mode = "off";
$del_mode = "off";

if($del_user){
	#SAPPHIRE INFO
	$sql = "select * from cost.cos_user where userid = '$del_user' ";	
	$Result_Info = mysql_query($sql);
	$Row_Info = mysql_fetch_assoc($Result_Info);
	$user_name = $Row_Info[username];
	
	# COST
	$sql = "Delete from cost.cos_user where userid = '$del_user' ";	
	@mysql_query($sql);	
	$sql = "DELETE FROM cost.type_accrone WHERE `userid`= '$del_user' ";	
	@mysql_query($sql);	

	# GNIS INFO
	$sql = "select * from cost_gnis.cos_user where username = '$user_name' ";	
	$Result_Info = mysql_query($sql);
	$Row_Info = mysql_fetch_assoc($Result_Info);
	$gnis_id = $Row_Info[userid];
	# COST GNIS
	$sql = "Delete from cost_gnis.cos_user where userid = '$gnis_id' ";	
	@mysql_query($sql);	
	$sql = "DELETE FROM cost_gnis.type_accrone WHERE `userid`= '$gnis_id' ";	
	@mysql_query($sql);	
	
	echo "<script language=\"javascript\">alert(\"ź $user_name ���º����\");</script>";
}
?>


<html>
<head>
<title><?=$report_title?></title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
<LINK href="../../common/style.css" rel=StyleSheet type="text/css">
<SCRIPT language=JavaScript>
function checkFields() {
	missinginfo1 = "";
	missinginfo = "";
	if (document.form1.staffname.value == "")  {	missinginfo1 += "\n- ��ͧ���� �������ö�繤����ҧ"; }		
	if (document.form1.staffsurname.value == "")  {	missinginfo1 += "\n- ��ͧ���ʡ�� �������ö�繤����ҧ"; }		
	if (document.form1.engname.value == "")  {	missinginfo1 += "\n- ��ͧ����(�ѧ���) �������ö�繤����ҧ"; }		
	if (document.form1.engsurname.value == "")  {	missinginfo1 += "\n- ��ͧ���ʡ��(�ѧ���) �������ö�繤����ҧ"; }		
	if (missinginfo1 != "") { 
		missinginfo += "�������ö������������  ���ͧ�ҡ \n";
		missinginfo +="_____________________________\n";
		missinginfo = missinginfo + missinginfo1  ;
		missinginfo += "\n___________________________";
		missinginfo += "\n��سҵ�Ǩ�ͺ �ա����";
		alert(missinginfo);
		return false;
		}
	}
</script>

</head>

<body bgcolor="#EFEFFF">
<form action="?" method="POST" NAME="form1" ONSUBMIT="Javascript:return (checkFields());">
<INPUT TYPE="hidden" NAME="id" VALUE="<?=$id?>" >
<INPUT TYPE="hidden" NAME="step" VALUE="<?=$step?>" >
<INPUT TYPE="hidden" NAME="org_id" VALUE="<?=$org_id?>" >
<INPUT TYPE="hidden" NAME="action" VALUE="<?=$action?>"  >
<INPUT TYPE="hidden" NAME="xusername" VALUE="<?=$uname?>"  >
<INPUT TYPE="hidden" NAME="xpassword" VALUE="<?=$pwd?>"  >
<table border=0 align=center cellspacing=1 cellpadding=3 bgcolor="#DDDDDD" width="98%">
    <tr bgcolor="#a3b2cc"> 
      <td colspan=6> &nbsp; <FONT COLOR="WHITE" style="font-size:14pt;"><B><?=$title?>������<?=$report_title?></B></font></td>
    </tr>

	<tr bgcolor=white valign=top>
	  <th width="70" class="link_back">�ӴѺ</td>
	  <th class="link_back">USER</td>
	  <th class="link_back">����</td>
	  <th width="135" class="link_back">�Է���</td>
	  <th class="link_back">EPM</td>
	  <th width="100" class="link_back">����ͧ���</td>
    </tr>
	<?

	$arr_cost_userid = array();
	$sql = 'select distinct userid from type_accrone where userid>0';
	$result = mysql_query($sql, $conn);
	while($row = mysql_fetch_assoc($result)) $arr_cost_userid[$row['userid']] = true;
	unset($sql, $result, $row);

	$i=0;
    $strSQL="SELECT * FROM cost.`cos_user` ORDER BY `userid`";
	$Result = mysql_query($strSQL);
	while($Row=mysql_fetch_assoc($Result)){
		$i++;
		$Row_EPM="";
		if($Row[epm_id]){
			$strSQL="SELECT epm.epm_staff.staffid,epm.epm_staff.username FROM epm.epm_staff WHERE epm.epm_staff.staffid = '$Row[epm_id]' limit 1";
			$Result_EPM = mysql_query($strSQL);
			$Row_EPM = mysql_fetch_assoc($Result_EPM);
		}
		$bgcolor=$bgcolor=="#DEDEDE"?"#EFEFEF":"#DEDEDE";
		$pri_detail = ($Row[pri]>0)?"normal":"<span style='color:#FF0000;'>���͹حҵ�����ҹ</span>";
		$pri_detail = $Row[pri] == 30 ? " �Ţҹء�� " : $pri_detail;
		$pri_detail = $Row[pri] == 100 ? " ADMIN " : $pri_detail;
	?>
	<tr bgcolor="<?=$bgcolor?>" valign=top>
	  <td class="link_back"><?=$i?><?=$Row[epm_id]?"<img src=\"images/16x16/magnet.png\" >":""?>
      </td>
	  <td class="link_back"><?=$Row[username]?></td>
	  <td class="link_back"><?=$Row[name]." ".$Row[surname]?></td>
	  <td align="center" class="link_back"><?=$pri_detail?> <?=$Row[avatar]?"[A]":""?></td>
	  <td align="center" class="link_back"><?=$Row[epm_id]?$Row_EPM[username]:""?></td>
	  <td class="link_back" align="center"><?=!$Row_EPM[username]&&$del_mode=="ON"?"<a href=\"?del_user=$Row[userid]\" onclick=\"return confirm('��ͧ���ź $Row[surname] ��ԧ�������?')\"><img src=\"images/delete.png\" width=\"16\" height=\"16\" border=0></a>":""?>

	<a href="add_user.php?action=edit&id=<?=$Row[userid]?>"><img src="images/ico_trans_edit.gif" width="16" height="16" border=0 title="��䢢����ż����"></a>
	&nbsp;<a href="update_cost.php?id=<?=$Row['userid']?>"><img src="<?=(isset($arr_cost_userid[$Row['userid']])?'images/ic-link.png':'images/warning.png')?>" style="width:16px; hight:16px;"  title="���������§�����ҹ�Ѻ���������� GL"></a></td>
    </tr>
    <? }?>
    <tr bgcolor="#888899" valign=top> 
      <td colspan=7 align=right> 
        <INPUT TYPE="button" VALUE="    ����    " CLASS=xbutton onClick="location.href='add_user.php';">
        <INPUT TYPE="button" VALUE=" ��Ѻ˹����ѡ  " class=xbutton ONCLICK="location.href='addtrip.php';">	  </td>
    </tr>
  </table>
  <table width="98%" border="0" cellspacing="1" cellpadding="2" style="font-size:14px;" align="center">
  <tr>
    <td>�����˵�</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right"><img src="images/16x16/magnet.png" ></td>
    <td>�ա��������§�����ż����Ѻ�к� EPBM</td>
  </tr>
  <tr>
    <td align="right"><img src="images/ico_trans_edit.gif" width="16" height="16" border=0 title="��䢢����ż����"></td>
    <td>��䢢����ż����</td>
  </tr>
  <tr>
    <td align="right"><img src="images/ic-link.png" style="width:16px; hight:16px;"  title="���ա��������§�����ҹ�Ѻ���������� GL"></td>
    <td>���ա��������§�����ҹ�Ѻ���������� GL</td>
  </tr>
  <tr>
    <td align="right"><img src="images/warning.png" style="width:16px; hight:16px;"  title="�ѧ������ա��������§�����ҹ�Ѻ���������� GL"></td>
    <td>�ѧ������ա��������§�����ҹ�Ѻ���������� GL</td>
  </tr>
  <tr>
    <td align="right">[A]</td>
    <td>User �������ö��Ҷ֧����� Mode Avatar ��觼�������ҹ Mode ������ͧ���Է��� �� �Ţҹء�� ��ҹ��</td>
  </tr>
</table>
</form>
</BODY>
</HTML>
