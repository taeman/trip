   <? 
   set_time_limit(0);
   session_start();
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
  
  <table width="80%" cellpadding="1" cellspacing="1" bgcolor="#000000" align="center">
  <tr bgcolor="#6BA7D3" align="center" >
  <td>�ӴѺ</td>
  <td>ʾ�.</td>
  <td>Mandays</td>
  <td>��Ǵ��������</td>
  <td>�ӹǹ��¡��</td>
  <td>�ӹǹ�Թ</td>
  <td>�����¡��</td>
  <td>����ӹǹ�Թ</td>
  </tr>

  <?php
  $sql_site="SELECT site,siteshortname FROM eduarea_config WHERE group_type='report' ORDER BY siteshortname "; 
  $query_site=mysql_query($sql_site);
  $num_site=mysql_num_rows($query_site);
  $intRow =0;
  
  //����ӹǹ�Թ������
  $sum_cash_all=0;
  //����ӹǹ��¡�÷�����
  $sum_list_all=0;
  while ($row_site=mysql_fetch_assoc($query_site)){
  $site = $row_site['site'];
      //�ӹǹ�ѹ
  $sql_user_work="SELECT
							  Count(user_work.userid) AS num_cost,
							  user_work.userid
							  FROM
							  user_work
							  Inner Join cos_user ON user_work.userid = cos_user.userid
							  Inner Join list ON cos_user.userid = list.userid AND user_work.date_work = list.date_list
							  WHERE siteid='".$row_site['site']."'
							  GROUP BY user_work.userid";
  //�ӹǹ�����ӧҹ  ����о�鹷��
  $query_user_work=mysql_query($sql_user_work);
  $num_user_work=mysql_num_rows($query_user_work);
  
  $sql_user_date="SELECT
							  Count(user_work.date_work) AS num_cost,
							  user_work.date_work
							  FROM
							  user_work
							  Inner Join cos_user ON user_work.userid = cos_user.userid
							  Inner Join list ON cos_user.userid = list.userid AND user_work.date_work = list.date_list
							  WHERE siteid='".$row_site['site']."'
							  GROUP BY user_work.date_work";
  // �ӹǹ�ѹ���ӧҹ  ����о�鹷�� 
  $query_user_date=mysql_query($sql_user_date);
  $num_user_date=mysql_num_rows($query_user_date);
      
  $sql_CostType	="SELECT
							  SUM(list.cash_total) AS sum_cash,
							  COUNT(user_work.userid) AS num_cost,
							  type_cost.id_type_cost,
							  type_cost.type_cost
							  FROM
							  user_work
							  Inner Join cos_user ON user_work.userid = cos_user.userid
							  Inner Join list ON cos_user.userid = list.userid AND user_work.date_work = list.`date_list`
							  Inner Join type_cost ON list.id_type_cost = type_cost.id_type_cost
							  WHERE siteid='".$row_site['site']."'
							  GROUP BY type_cost.id_type_cost ";
  // ��������������� ����Դ��鹨�ԧ����� site
  
  $query_CostType=mysql_query($sql_CostType);
  $NumRow_Type=mysql_num_rows($query_CostType);
  
  if($NumRow_Type>0){
    $intRow++;
	$rowspan = ($NumRow_Type>0)?' rowspan="'.($NumRow_Type+(($num_site!=$intRow)?1:0)).'" ':' rowspan="1" ';
	$rowspan_end = ($NumRow_Type>0)?' rowspan="'.($NumRow_Type).'" ':' rowspan="1" ';
  ?>
  
  <tr bgcolor="#FFFFFF">
  <td  valign="top" align="center" <?=$rowspan?>><?=$intRow?></td>
  <td valign="top" <?=$rowspan?>><?=$row_site['siteshortname']?></td>
  <td align="center" valign="top" <?=$rowspan?>><? echo  ($num_user_work*$num_user_date);?></td>
  <?php
  if($NumRow_Type!=0){
      echo "</tr>";
 }
  if($NumRow_Type==0){
  ?>
  <td align="right">-</td>
  <td align="right">-</td>
  <td></td>
  </tr>
  <?
  }
  //����ӹǹ��¡�����л�����
  $sum_num_cost=0;
  //����ӹǹ�Թ��;�鹷��
  $sum_cash_per_type=0;
  $intRow_type=0;
  while($row_CostType=mysql_fetch_assoc($query_CostType)){
  		$arr_siteCostTypeName[$site][$row_CostType['id_type_cost']] = $row_CostType['type_cost'];
  		$arr_siteCostType[$site][$row_CostType['id_type_cost']] = $row_CostType['num_cost'];
		$arr_siteCostCash[$site][$row_CostType['id_type_cost']] = $row_CostType['sum_cash'];
		//����ӹǹ��¡������С����
  		$sum_num_cost+=$row_CostType['num_cost'];
  		//����ӹǹ�Թ����С����
  		$sum_cash_per_type+=$row_CostType['sum_cash'];
  }
  foreach($arr_siteCostTypeName[$site] as $k=>$type_cost){
  $intRow_type++;
/*    if($intRow_type!=1){
		echo '<tr bgcolor="#FFFFFF">';
	}*/
  ?>
  <tr bgcolor="#FFFFFF">
  <td align="left"><?=$type_cost?></td>
  <td align="right"><?=number_format($arr_siteCostType[$site][$k])?></td>
  <td align="right">
  <a href="cost_detail.php?siteid=<?=$site?>&id_type_cost=<?=$k?>" target="_blank"><?=number_format($arr_siteCostCash[$site][$k],2)?></a>
  </td>
  <?php 
  if($intRow_type==1){
          echo "<td $rowspan_end align='right' valign='top'>".number_format($sum_num_cost)."</td>";
          echo '<td '.$rowspan_end.' align="right" valign="top"><a href="cost_detail.php?siteid='.$site.'" target="_blank">'.number_format($sum_cash_per_type,2).'</a></td>';
      }
  ?>
  </tr>
  <?php
  //�Ҩӹǹ��¡�÷�����
  $sum_list_all+=$sum_num_cost;
  //�Ҩӹǹ�Թ������
  $sum_cash_all+=$sum_cash_per_type;
   		 }
      }
  }
  
  ?>
  <tr bgcolor="#eeeeee">
  <td colspan="6"  align="right">���</td>
  <td align="right"><?=number_format($sum_list_all)?></td>
  <td align="right"><?=number_format($sum_cash_all,2)?></td>
  </tr>
  
  </table>
  
  </body>
  </html>