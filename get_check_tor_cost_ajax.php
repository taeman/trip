<?php
header('Access-Control-Allow-Origin: *');
if ($_GET['ProjectCode'] !== ''){
    $connect = mysql_connect('localhost', 'inside_system', 'System_$apph!re2014');
    if (!$connect) {
        die('<option value="e">Could not connect: ' . mysql_error() . '</option>');
    }
    $result = mysql_query("SET character_set_results=tis-620");
    $result = mysql_query("SET NAMES TIS620");
    mysql_select_db('dailyreport101', $connect) or die('<option value="e">die2</option>');
    $sqlWhere = '';
    if($_GET['TorId'] != ''){
        $sqlWhere .= "AND TorId='".$_GET['TorId']."' ";
    }
    if($_GET['CostId'] != ''){
        $sqlWhere .= "AND CostId='".$_GET['CostId']."' ";
    }
    $sql = "SELECT TorId, CostId, TorName
            FROM Daily_TOR_Data
            WHERE ProjectCode = '".$_GET['ProjectCode']."'
            {$sqlWhere}
            LIMIT 1
            ";
    $task_data = mysql_query($sql);
    $numData = 0;
    while ($row = mysql_fetch_array($task_data)){
      $numData++;
    }
    echo $numData;
    mysql_close($connect);
}
?>
