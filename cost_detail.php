 <?php
set_time_limit(0);
include ("phpconfig.php"); // ���¡����� connect.php
conn2DB();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>��§ҹ�������¡���͡��鹷���ṡ�����鹷��</title>
</head>

<body>
<p><center><strong>��§ҹ�������¡���͡��鹷���ṡ�����鹷��</strong></center></p>
<?php
//ࢵ��鹷��
$sql_edu = " SELECT
					eduarea_config.siteshortname
					FROM `eduarea_config`
					WHERE eduarea_config.group_type='report'
					AND site='".$_GET['siteid']."' ";
$query_edu = mysql_query($sql_edu);
$row_edu = mysql_fetch_assoc($query_edu);
//��Ǵ��������
$sql_typecost="SELECT
type_cost.type_cost
FROM
type_cost
WHERE
id_type_cost =  '".$_GET['id_type_cost']."'
";
$query_typecost=mysql_query($sql_typecost);
$row_typecost=mysql_fetch_assoc($query_typecost);
?>
<table width="85%" align="center" >
<tr >
<td ><strong><?=$row_edu['siteshortname']?><?=(($row_typecost['type_cost'])?"&gt;".$row_typecost['type_cost']:"")?></strong></td>
</tr>
</table>

<table width="85%" align="center" cellpadding="2" cellspacing="1" bgcolor="#000000">
<tr bgcolor="#6BA7D3" align="center">
<td width="38">�ӴѺ</td>
<td width="90">�ѹ���</td>
<td width="100">���� Trip</td>
<td width="250">���� Trip</td>
<td width="135">����-���ʡ��</td>
<td width="135">��Ǵ��������</td>
<td width="79">�ӹǹ�Թ</td>
<td >�����˵�</td>
</tr>
<?php

$sql_site="SELECT
				cos_user.name,
				cos_user.surname,
				user_work.date_work,
				list.`date`,
				list.date_list,
				list.cash_total,
				trip.tripname,
				trip.note,
				trip.tripid,
				list.id_type_cost,
				type_cost.type_cost
				FROM
				user_work
				Inner Join cos_user ON user_work.userid = cos_user.userid
				Inner Join list ON cos_user.userid = list.userid AND user_work.date_work = list.date_list
				Inner Join trip ON trip.tripid = list.tripid
				Inner Join type_cost ON list.id_type_cost = type_cost.id_type_cost
				WHERE user_work.siteid='".$_GET['siteid']."'
				".(($_GET['id_type_cost'])?" AND list.id_type_cost='".$_GET['id_type_cost']."' ":"")."
				ORDER BY
				cos_user.name ASC
"; 
$query_site=mysql_query($sql_site);
$intRow =0;
$sum_cash_total=0;
while ($row_site=mysql_fetch_assoc($query_site)){
	$intRow++;
?>
<tr bgcolor="#FFFFFF" align="center">
<td valign="top"><?=$intRow?></td>
<td valign="top">
<?
$arr_date = explode("-",$row_site['date_list']);
echo $arr_date[2]."/".$arr_date[1]."/".($arr_date[0]+543);
?></td>
<td  valign="top"><?=$row_site['tripid']?></td>
<td align="left"  valign="top"><?=$row_site['tripname']?></td>
<td align="left"  valign="top"><?=$row_site['name']." ".$row_site['surname']?></td>
<td align="left"  valign="top"><?=$row_site['type_cost']?></td>
<td align="right"  valign="top"><?=number_format ($row_site['cash_total'])?></td>
<td align="left" valign="top"><?=$row_site['note']?></td>
<?php
$sum_cash_total+=$row_site['cash_total'];
?>
</tr>

<?php } ?>
 <tr bgcolor="#eeeeee" align="center">
  <td colspan="6" align="right">���</td>
  <td align="right"><?=number_format($sum_cash_total)?></td>
  <td align="right">&nbsp;</td>
</tr>
</table>

</body>
</html>