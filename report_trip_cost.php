<?php
set_time_limit(0);
include ("checklogin.php");

include ("phpconfig.php");

Conn2DB();

function swapdatedat($rs_time){
	$arrB = explode("-",$rs_time);
	$getdayB=$arrB[2]."/".$arrB[1]."/".$arrB[0];
	return $getdayB;
}

function taskData($ProjectCode='', $filter=''){
	$cost_temp = 'cost_temp';
	$arrData = array();
	
	$connect = mysql_connect('192.168.2.13', 'sapphire', 'sprd!@#$%');
    if (!$connect) {
        die('<option value="e">Could not connect: ' . mysql_error() . '</option>');
    }

    $result = mysql_query("SET character_set_results=tis-620");
    $result = mysql_query("SET NAMES TIS620");
    mysql_select_db($cost_temp, $connect) or die('<option value="e">die2</option>');
	
	
	$sql = "SELECT  * FROM `daily_task_data_mini` WHERE ProjectCode='{$ProjectCode}' "; 
	$query = mysql_db_query($cost_temp, $sql);
	while($row = mysql_fetch_assoc($query)){
		$arrData[] = $row;
	}
	return $arrData;
}

?>
<html>
<head>
<title>รายงานค่าใช้จ่ายในการออกปฏิบัติงาน</title>
<meta http-equiv="Content-Type" content="text/html; charset=TIS-620">
<link href="cost.css" type="text/css" rel="stylesheet">

<style type="text/css">

<!--

body {  margin: 0px  0px; padding: 0px  0px}

a:link { color: #005CA2; text-decoration: none}

a:visited { color: #005CA2; text-decoration: none}

a:active { color: #0099FF; text-decoration: underline}

a:hover { color: #0099FF; text-decoration: underline}
.style1 {color: #005CA2}

-->

</style>

<link href="css/redmon_theme/redmon.custom.css" rel="stylesheet" type="text/css">
</head>

<body >

<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td valign="top" style="background-repeat: no-repeat; background-position:right bottom ">
    <table width="100%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td valign="top" bgcolor="#D3D3D3" >
		<?php 
		include("header_cost.php"); // หัวโปรแกรม
		?>
		</td>
    </tr>
	</table>
        <table width="200" border="1">
          <tr>
            <td>Task ID</td>
             <td>Cost ID</td>
            <td>รายการ</td>
            <td>จำนวนเงินแต่ละรายการ</td>
            <td>จำนวนเงินรวม</td>
          </tr>
          <?php
		  $arrTask = taskData('56EDUBKK01', $filter);
		  foreach($arrTask as $taskData){
          ?>
          <tr>
            <td><?php echo $taskData['TaskId'];?></td>
            <td><?php echo $taskData['CostId'];?></td>
            <td><?php echo $taskData['TaskName'];?></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <?php } ?>
        </table>
    </td>
  </tr>
</table>

</body>

</html>

