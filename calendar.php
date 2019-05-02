<html>
<head>
<title>Calendar</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
<link href="../libary/style.css" rel="stylesheet" type="text/css">
</head>
<body>
<?php
$jump = $_GET["jump"];
if($jump != ""){

	$df 			= explode("/", $jump);
	$today 		= $df[0];
	$dfMonth 	= $df[1];
	$dfYear 	= $df[2];
	
} 

/* �ѧ���� LastDay() ������Ѻ���ѹ����ش���¢ͧ��͹/�շ���к� ���͡�����ա���˹�觤���������͹/�շ���кع���ա���ѹ */
function LastDay($m, $y) {
  for ($i=29; $i<=32; $i++) {  if(checkdate($m, $i, $y) == 0) {   return $i - 1;  }  }
}

/* $diffHour ��� $diffMinute ��͵���÷�����纨ӹǹ���������Шӹǹ�ҷշ�� ᵡ��ҧ�ѹ�����ҧ����ͧ���͹��Ѻ����ͧ��������� ����ӴѺ �蹶�����Ңͧ
   ����ͧ����繵����ǡ������Ңͧ����ͧ��������� 11 ������� 15 �ҷ� ������˹� $diffHour �� 11 ��С�˹� $diffMinute �� 15 㹷��������¹������
   ����ͧ���������Ѻ����ͧ����繵������ҵç�ѹ */
$diffHour 		= 0;
$diffMinute 	= 0;

if ($dfMonth == "") {

  $calTime = getdate(date(mktime(date("H") + $diffHour, date("i") + $diffMinute)));
  $today 	= $calTime["mday"];     //�ѹ���
  $month 	= $calTime["mon"];      //��͹
  $year 		= $calTime["year"];      //��
  
} else {
  /* �óշ���к�����ʴ���ԷԹ�ͧ��͹/��˹����� ���ա���觵���� $today,  $dfMonth ��� $dfYear ��ҹ�ҷҧ query string ���� */
  if ($dfMonth == 0) {
    /* ��ҵ���� $dfMonth �� 0 ��Ҩ��ʴ���ԷԹ�ͧ��͹�ѹ�Ҥ��ͧ�շ����� ���һշ����ѧ�ʴ����� */
    $dfMonth 	= 12;
    $dfYear 	= $dfYear - 1;
  } elseif ($dfMonth == 13) {
    /* ��ҵ���� $dfMonth �� 13 ��Ҩ��ʴ���ԷԹ�ͧ��͹���Ҥ��ͧ�շ���ҡ���һշ����ѧ�ʴ����� */
    $dfMonth 	= 1;
    $dfYear 	= $dfYear + 1;
  }
  //���ҧ�ѹ/���Ңͧ��͹��лշ�������к� �����㹵���� $calTime
  $calTime = getdate(date(mktime((date("H") + $diffHour), (date("i") + $diffMinute), 0, $dfMonth, $today, $dfYear)));
  $today 	= $calTime["mday"];     //�ѹ���
  $month 	= $calTime["mon"];      //��͹
  $year 		= $calTime["year"];      //��
}

/* ���¡�ѧ���� LastDay() ����繿ѧ���蹷��������ҧ������ͧ ������ "�ӹǹ�ѹ" �ͧ��͹��лշ����ʴ���ԷԹ �������㹵���� $Lday */
//�� timestamp �ͧ�ѹ��� 1 �ͧ��͹�����ʴ���ԷԹ ���㹵���� $FTime
//�� "�ѹ��ѻ����" (�ѹ���, �ѧ��� ���) �ͧ�ѹ��� 1 �ͧ��͹���㹵���� $wday
$Lday 		= LastDay($month, $year);
$FTime 		= getdate(date(mktime(0, 0, 0, $month, 1, $year)));
$wday 		= $FTime["wday"];

//�Ҥ�Ңͧ�ѹ�ҷԵ����͹��͹˹��
$lm			= explode("-", date("Y-m", mktime(0, 0, 0, $dfMonth, -1, $dfYear)));
$lmday		= (LastDay($lm[1], $lm[0]) - $wday);

//���ҧ����ê�Դ���������纪�����͹������
$thmonthname = array("���Ҥ�", "����Ҿѹ��", "�չҤ�", "����¹", "����Ҥ�", "�Զع�¹", "�á�Ҥ�", "�ԧ�Ҥ�", "�ѹ��¹", "���Ҥ�", "��Ȩԡ�¹", "�ѹ�Ҥ�");
$col				= array("#99CCFF", "#CCCCFF", "#FFCCFF", "#FFCC66", "#CCCC99", "#CCFF66","#66CC99","#CCCC33","#99FF66","#33CCCC");
$month_next	= date("m/Y", mktime(0, 0, 0, $month, +32, $year));
$month_prev	= date("m/Y", mktime(0, 0, 0, $month, -1, $year));
$jump_next	= $today."/".$month_next;
$jump_prev	= $today."/".$month_prev;

/*���ҧ����÷���������Ǩ�ͺ�ѹ������͹����ʴ� ����բ����š����� link */

$sqDay			= add_zero($today); 
$sqMonth		= ($dfMonth != "") ? add_zero($dfMonth) : add_zero($month) ;
$sqYear			= ($dfYear != "") ? $dfYear : $year ;

/*Query �����Ũҡ Database*/
$result 	= mysql_query($csql)or die("Query Line " . __LINE__ . " Error<hr>".mysql_error());
$row 	= mysql_num_rows($result);
if($row != 0){
	while($rs 	= mysql_fetch_assoc($result)){
		$start	= explode("-", $rs[date_list]);
		$end	= explode("-", $rs[date_list]);

		$s1 = explode(" ", $start[2]);
		$e1	= explode("-", $end[2]);

		$s[]		= $s1[0];
		$e[]		= $e1[0];
	}
}

$xcol = array();
for($i=0;$i<count($s); $i++){
	for($x=$s[$i]; $x<=$e[$i]; $x++){		
		$arr_day[remove_zero($x)] 	= $i % count($col);  		
	}
	$xcol[] = $i % count($col); 
}
mysql_free_result($result);


$img_l 	= (file_exists("../images/left.gif")) ? "../images/left.gif" : "images/left.gif" ; 
$img_r 	= (file_exists("../images/right.gif")) ? "../images/right.gif" : "images/right.gif"; 
$img_c 	= (file_exists("../images/calendar.jpg")) ? "../images/calendar.jpg" : "images/calendar.jpg"; 
?>
<table width="176" border="0" cellspacing="1" cellpadding="0" align="center" bgcolor="#404040">
<tr align="center" bgcolor="#A0A0A0">
    <td height="19" width="24"><a href="?jump=<?=$jump_prev.$cal_kwd?>&mode=<?=$mode?>&userid=<?=$_GET[userid]?>"><img src="<?=$img_l?>" width="12" height="12" border="0"></a></td>
	<td height="19" width="120" colspan="5" class="normal_blue">
	<?="<font class=brown>".$today."</font>&nbsp;".$thmonthname[$month - 1]."&nbsp;<font class=brown>".($year + 543)."</font>"?></td>
    <td height="19" width="24"><a href="?jump=<?=$jump_next.$cal_kwd?>&mode=<?=$mode?>&userid=<?=$_GET[userid]?>"><img src="<?=$img_r?>" width="12" height="12" border="0"></a></td>
</tr>
<tr align="center" bgcolor="#e3e3e3" class="normal_blue" style="font-weight:bold;">
	<td height="19" width="24" class="warn">��</td>
	<td height="19" width="24">�</td>
	<td height="19" width="24">�</td>
	<td height="19" width="24">�</td>
	<td height="19" width="24">��</td>
	<td height="19" width="24">�</td>
	<td height="19" width="24">�</td>
</tr>
<?
$iday = 1;
//�ʴ����á�ͧ��ԷԹ
for ($i=0; $i<=6; $i++) {
if ($i < $wday) {  /*�ʴ�������ҧ��͹�ѹ��� 1 �ͧ��͹*/
		//echo "<td width=\"24\" height=\"19\" bgcolor=\"#eeeeee\"><font color=\"#bbbbbb\">".($lmday=$lmday+1)."</font></td>\n";	
    if ($i == 0) { 	/*�óշ�����ѹ�ҷԵ��*/	
		$class 	= "class=\"warn\""; 	
	} else { /*�óշ�����ѹ������������ѹ�ҷԵ��*/ 
		$class 	= "class=\"normal\""; 
	}		
	echo "<td width=\"24\" height=\"19\" align=\"center\" $class bgcolor=\"#eeeeee\">&nbsp;</td>\n";
	
} else {             
	
//�ʴ��ѹ�������á�ͧ��ԷԹ    
if(is_numeric($arr_day[$iday])) { 

//	$class 	= " bgcolor=\"".$col[$arr_day[$iday]]."\" style=\"font-weight:bold;\" "; 
//	$show 	= " <a href=?jump=".add_zero($iday)."/".$sqMonth."/".$sqYear.$cal_kwd." class='link' style='text-decoration:none'>";
//	$show 	= $show."<font color=\"brown\">".$iday."</font></a> ";
	if($iday == $today){
		$class 	= " bgcolor=\"#0280D5\" style=\"font-weight:bold;\" "; 
		$show 	= " <a href=?jump=".add_zero($iday)."/".$sqMonth."/".$sqYear.$cal_kwd."&id_type_cost=".$id_type_cost."&mode=".$_GET[mode]."&userid=".$_GET[userid]." class='link' >";
		$show 	= $show."<font color=\"white\">".$iday."</font></a> ";
	} else {
		$class 	= " bgcolor=\"#ffffff\" style=\"font-weight:bold;\" "; 
		$show 	= " <a href=?jump=".add_zero($iday)."/".$sqMonth."/".$sqYear.$cal_kwd."&id_type_cost=".$id_type_cost."&mode=".$_GET[mode]."&userid=".$_GET[userid]." class='link' >";
		$show 	= $show."<font color=\"0280D5\">".$iday."</font></a> ";
	}	
	
	
} elseif($iday == $today) { 

	$class 	= " bgcolor=\"#0280D5\" style=\"font-weight:bold;\" "; 
	$show 	= "<font color=\"white\">".$iday."</font>";
	
} elseif($i == 0 && ($iday != $today)) { /*�óշ�����ѹ�ҷԵ�� ���������ѹ�Ѩ�غѹ*/ 

	$class 	= " bgcolor=\"#ffffff\" style=\"font-color:red;\" "; 
	$show 	= "<font color=\"red\">".$iday."</font>";
	
} else { 
	
	$class 	= " bgcolor=\"#ffffff\" "; 
	$show 	= $iday ;
		
}	
	
    echo "<td width=\"24\" height=\"19\" align=\"center\" $class>".$show."</td>\n";
    $iday++;
	
}  
}
$link = "";

//�ʴ��Ƿ������ͧ͢��ԷԹ (��ѧ�ҡ�ʴ����á����� ����������ҧ�ҡ 5 ��)
for ($j=0; $j<=4; $j++) {
  if ($iday <= $Lday) {
    echo "<tr>\n";
    for ($i=0; $i<=6; $i++) {
      if ($iday <= $Lday) {
	  
	    if(is_numeric($arr_day[$iday])) { 
		
//			$class 	= " bgcolor=\"".$col[$arr_day[$iday]]."\" style=\"font-weight:bold;\" "; 
//			$show 	= " <a href=?jump=".add_zero($iday)."/".$sqMonth."/".$sqYear.$cal_kwd." class='link' style='text-decoration:none'>";
//			$show 	= $show."<font color=\"brown\">".$iday."</font></a> ";
	if($iday == $today){
		$class 	= " bgcolor=\"#0280D5\" style=\"font-weight:bold;\" "; 
		$show 	= " <a href=?jump=".add_zero($iday)."/".$sqMonth."/".$sqYear.$cal_kwd."&id_type_cost=".$id_type_cost."&mode=".$_GET[mode]."&userid=".$_GET[userid]." class='link' >";
		$show 	= $show."<font color=\"white\">".$iday."</font></a> ";
	} else {
		$class 	= " bgcolor=\"#ffffff\" style=\"font-weight:bold;\" "; 
		$show 	= " <a href=?jump=".add_zero($iday)."/".$sqMonth."/".$sqYear.$cal_kwd."&id_type_cost=".$id_type_cost."&mode=".$_GET[mode]."&userid=".$_GET[userid]." class='link' >";
		$show 	= $show."<font color=\"0280D5\">".$iday."</font></a> ";
	}	
			
		} elseif($iday == $today) { 
		
			$class 	= " bgcolor=\"#0280D5\" style=\"font-weight:bold;\"";  
			$show 	= "<font color=\"ffffff\">".$iday."</font>";
			
		} elseif($i == 0 && ($iday != $today)) { 
		
			$class 	= " bgcolor=\"#ffffff\" style=\"font-color:red;\"  ";  
			$show 	= "<font color=\"red\">".$iday."</font>";
			
		} else {
		
			$class 	= " bgcolor=\"#ffffff\" ";   
			$show 	= $iday;
			
		}
		
        echo "<td width=\"24\" height=\"19\" align=\"center\" $class>".$show."</td>\n";
		 
      } else {
          echo "<td width=\"24\" height=\"19\" align=\"center\" class=\"normal\" bgcolor=\"#eeeeee\">&nbsp;</td>\n";
      }
	  
	  $iday++;
    }
    echo "</tr>\n";
  } else {
    break;
  }
}
?>
<tr bgcolor="#ffffff" align="center">
	<td height="25" colspan="7" class="normal_black">
	<div align="center" id="Add_event" style="height:20px; width: 150px; border: 1px solid black; background: #f8f8f8; padding: 1px 5px; cursor:hand;" 
	onClick="window.location.replace('<?=$PHP_SELF.$cdate_kwd?>')">
	<img src="<?=$img_c?>" width="16" height="16" align="absmiddle" border="0">&nbsp;�ѹ���Ѩ�غѹ</div></td>
</tr>
</table>
</body>
</html>