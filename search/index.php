<?php
/**
 * Created by PhpStorm.
 * User: nidchaphon
 * Date: 1/4/2017 AD
 * Time: 15:21
 */
session_start();

include ("../phpconfig.php");
conn2DB();



//$_GET['debug'] = "on";

if ($_POST['searchBT'] != ''){
    $search = $_POST['searchBT'];
}else{
    $search = $_GET['searchBT'];
}
if ($_POST['keyword'] != ''){
    $keyword = $_POST['keyword'];
}else{
    $keyword = $_GET['keyword'];
}
if ($_POST['tripID'] != ''){
    $tripID = $_POST['tripID'];
}else{
    $tripID = $_GET['tripID'];
}
if ($_POST['userid'] != ''){
    $userid = $_POST['userid'];
}else{
    $userid = $_GET['userid'];
}
if ($_POST['money'] != ''){
    $money = $_POST['money'];
}else{
    $money = $_GET['money'];
}
if ($_POST['type'] != ''){
    $type = $_POST['type'];
}else{
    $type = $_GET['type'];
}
if ($_POST['dateStart'] != ''){
    $dateStartTxt = $_POST['dateStart'];
}else{
    $dateStartTxt = $_GET['dateStart'];
}
if ($_POST['dateEnd'] != ''){
    $dateEndTxt = $_POST['dateEnd'];
}else{
    $dateEndTxt = $_GET['dateEnd'];
}

if (isset($_POST['clear'])){
    $keyword = '';
    $tripID = '';
    $userid = '';
    $money = '';
    $type = '';
    $dateStartTxt = '';
    $dateEndTxt = '';
}

if ($_GET['showList'] == ""){
    $_GET['showList'] = "showPage";
}else{
    $_GET['showList'] = $_GET['showList'];
}

$arr_dateStart = explode("/",$dateStartTxt);
$dateStart = (($arr_dateStart[2]-543)."-".$arr_dateStart[1]."-".$arr_dateStart[0]);

$arr_dateEnd = explode("/",$dateEndTxt);
$dateEnd = (($arr_dateEnd[2]-543)."-".$arr_dateEnd[1]."-".$arr_dateEnd[0]);

if ($dateStartTxt == ''){
    $start = "";
}else {
    $start = $dateStart;
}
if ($dateEndTxt == ''){
    $end = date("Y-m-d");
}else {
    $end = $dateEnd;
}


if ($userid == ''){
    $whereuserid = "";
}else{
    $whereuserid = "AND t1.userid = '{$userid}'";
}
if ($money == ''){
    $wheremoney = "";
}else{
    $wheremoney = "AND (cash_total LIKE '{$money}' OR credit_total LIKE '{$money}') ";
}
if ($type == ''){
    $wheretype = "";
}else{
    $wheretype = "AND t1.id_type_cost = '{$type}'";
}
if ($start == '' || $end == ''){
    $wheredate = "";
}else {
    $wheredate = "AND date_list BETWEEN '{$start}' AND '{$end}'";
}

$strQueryData = "SELECT
              t1.date_list,
              t1.tripid,
              CONCAT (t2.`name`,' ',t2.surname) AS FullName,
	          t1.detail,
	          t3.code_project,
              t1.cash_total,
              t1.credit_total,
              t4.type_credit,
			type_cost.id_type_cost,
			type_cost.type_cost
            FROM list AS t1
              LEFT JOIN cos_user AS t2 ON (t1.userid = t2.userid)
              INNER JOIN type_project AS t3 ON (t1.id_type_project = t3.id_type_project)
              LEFT JOIN type_credit AS t4 ON (t1.id_type_credit = t4.id_type_credit)
			 INNER JOIN type_cost ON type_cost.id_type_cost = t1.id_type_cost
              WHERE t1.detail LIKE '%{$keyword}%'
              AND t1.tripid LIKE '%{$tripID}%'
              {$whereuserid}
              {$wheretype}
              {$wheremoney}
              {$wheredate}
            ";

$resultQueryData = mysql_query($strQueryData) or die ("Error Query [".$strQueryData."]");
$numListData = mysql_num_rows($resultQueryData);

$perPage = 50;

$page = $_GET["Page"];
if(!$_GET["Page"]) {
    $page=1;
}

$prevPage = $page-1;
$nextPage = $page+1;

$pageStart = (($perPage*$page)-$perPage);
if($numListData<=$perPage) {
    $numPages =1;
} else if(($numListData % $perPage)==0) {
    $numPages =($numListData/$perPage) ;
} else {
    $numPages =($numListData/$perPage)+1;
    $numPages = (int)$numPages;
}

if ($_GET['showList'] == "showAll"){
    $limit = "";
}else if ($_GET['showList'] == "showPage"){
    $limit = "LIMIT $pageStart , $perPage";
}

$strSort = $_GET["sort"];
if($strSort == "") {
    $strSort = "date_list";
}
$strOrder = $_GET["order"];
if($strOrder == "") {
    $strOrder = "DESC";
}

$strNewOrder = $strOrder == 'DESC' ? 'ASC' : 'DESC';

$strQueryData .="ORDER BY {$strSort} {$strOrder}
                 $limit";
$resultQueryData  = mysql_query($strQueryData);

if($_GET['debug']=='on'){
    echo 'คิวรี่ แสดงรายละเอียดการค้นหาในตาราง';
    echo "<pre>$strQueryData</pre>";
}

$strQueryListProject = "SELECT 
	          t3.code_project,
              SUM(t1.cash_total) AS cash,
	          SUM(t1.credit_total) AS credit

            FROM list AS t1
              LEFT JOIN cos_user AS t2 ON (t1.userid = t2.userid)
              INNER JOIN type_project AS t3 ON (t1.id_type_project = t3.id_type_project)

              WHERE t1.detail LIKE '%{$keyword}%'
              AND t1.tripid LIKE '%{$tripID}%'
              {$whereuserid}
              {$wheretype}
              {$wheremoney}
              {$wheredate}
              GROUP BY code_project
            ";
if($_GET['debug']=='on'){echo $strQueryListProject."<hr>" ;}
$resultQueryListProject = mysql_query($strQueryListProject);
$numListProject = mysql_num_rows($resultQueryListProject);

$strQueryTypeName = "SELECT * FROM type_cost WHERE id_type_cost = '".$type."'";
$resultQueryTypeName = mysql_query($strQueryTypeName);
$valTypeName = mysql_fetch_assoc($resultQueryTypeName);

$strQueryUserName = "SELECT CONCAT (`name`,' ',surname) AS FullName FROM cos_user WHERE userid = '".$userid."'";
$resultQueryUserName = mysql_query($strQueryUserName);
$valUserName = mysql_fetch_assoc($resultQueryUserName);

$link1 = "&searchBT=".$search."&keyword=".$keyword."&tripID=".$tripID."&userid=".$userid."&money=".$money."&type=".$type."&dateStart=".$dateStartTxt."&dateEnd=".$dateEndTxt."&order=".$strNewOrder;
$link2 = "&searchBT=".$_GET['search']."&keyword=".$_GET['txtKeyword']."&txtTripID=".$_GET['txtTripID']."&txtName=".$_GET['txtName']."&txtMoney=".$_GET['txtMoney']."&txtType=".$_GET['txtType']."&dateStart=".$_GET['dateStart']."&dateEnd=".$_GET['dateEnd']."&order=".$strNewOrder;

?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="TIS-620">
    <title>ค้นหา ::ระบบบันทึกค่าใช้จ่ายออกนอกพื้นที่::</title>

    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="datepicker/jquery-ui/jquery-ui.css">

    <script src="bootstrap/js/bootstrap.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="datepicker/jquery-ui/external/jquery/jquery.js"></script>
    <script src="datepicker/jquery-ui/jquery-ui-thai-tis.js"></script>
    <script src="datepicker/datepicker-tis.js"></script>

    <script>
        $(document).ready(function () {
            var dateEnd = new DatePickTwo("dateStart","dateEnd");
            dateEnd.maxdate1=0;
            dateEnd.maxdate2=0;
            dateEnd.Create();
        });

        $(document).ready(function(){
            $(".tip").tooltip({
                placement : 'top'
            });
        });
    </script>

</head>
<body>
<div class="row">
    <div class="col-lg-12">
        <div class="panel">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-md-6">
                        <form name="formSearch" action="<?php echo $_SERVER['SCRIPT_NAME'];?>" method="post" class="form-horizontal">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">คำค้นหา</label>
                                <div class="col-sm-7">
                                    <input type="text" name="keyword" class="form-control" placeholder="รายการ,ร้านค้า,เลขที่ใบสั่งซื้อ" value="<?php echo $keyword;?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">TripID</label>
                                <div class="col-sm-6">
                                    <input type="text" name="tripID" class="form-control" maxlength="10" value="<?php echo $tripID;?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">ชื่อ (เจ้าของทริป)</label>
                                <div class="col-sm-6">
                                    <select name="userid" class="form-control">
                                        <option value="">เลือกเจ้าของทริป</option>
                                        <?php
                                        $strQueryListUser = "
											SELECT CONCAT(`name` , ' ' , surname) AS fullName,MAX(trip.tripid) AS Maxtripid ,COUNT(trip.tripid) , cos_user.userid FROM trip INNER JOIN cos_user  ON trip.userid = cos_user.userid  GROUP BY cos_user.userid ORDER BY Maxtripid DESC ,fullName ASC
													";
                                        $resultQueryListUser = mysql_query($strQueryListUser);
                                        while ($rowListUser = mysql_fetch_assoc($resultQueryListUser)){
                                            ?>
                                            <option value="<?php echo $rowListUser['userid']; ?>"<?php if ($userid == $rowListUser['userid']){echo "SELECTED";}else{echo '';} ?>><?php echo $rowListUser['fullName']; ?></option>
                                        <?php } ?>
                                    </select>
                                    <!--                            <input type="text" name="txtName" class="form-control" value="--><?php //echo $_GET['txtName'];?><!--">-->
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">จำนวนเงิน</label>
                                <div class="col-sm-6">
                                    <input type="text" name="money" class="form-control" value="<?php echo $money;?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">ประเภทค่าใช้จ่าย</label>
                                <div class="col-sm-6">
                                    <select name="type" class="form-control">
                                        <option value="">เลือกประเภทค่าใช้จ่าย</option>
                                        <?php $strQueryTypeCost = "SELECT * FROM type_cost ORDER BY id_type_cost ASC";
                                        $resultQueryTypeCost = mysql_query($strQueryTypeCost);
                                        while ($rowTypeCost = mysql_fetch_assoc($resultQueryTypeCost)){ ?>
                                            <option value="<?php echo $rowTypeCost['id_type_cost']; ?>"<?php if ($type == $rowTypeCost['id_type_cost']){echo "SELECTED";}else{echo '';} ?>><?php echo $rowTypeCost['type_cost']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">ระหว่าง</label>
                                <div class="col-sm-9">
                                    <div class="row">
                                        <div class="col-md-1" style="width: auto;">วันที่ </div>
                                        <div class="col-md-4"> <input type="text" name="dateStart" id="dateStart" class="form-control" value="<?php echo $dateStartTxt; ?>" style="cursor: pointer !important;"></div>
                                        <div class="col-md-1">ถึง</div>
                                        <div class="col-md-4"> <input type="text" name="dateEnd" id="dateEnd" class="form-control" value="<?php echo $dateEndTxt; ?>"></div>
                                    </div>


                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-9">
                                    <button type="submit" name="searchBT" value="search" class="btn btn-default">ค้นหา</button> &nbsp;&nbsp;
                                    <button type="submit" name="clear" class="btn btn-default">ล้างค่า</button></a>
                                </div>
                            </div>
                        </form>

                    </div>
                    <?php if (isset($search)){ ?>
                    <div class="col-md-6">
                        <table class="table table-striped table-hover table-bordered">
                            <thead style="background: #eaeaea;">
                            <tr>
                                <th rowspan="2" style="text-align: center; vertical-align: middle; width: 60%">โครงการ</th>
                                <th colspan="2" style="text-align: center; width: 40%">จำนวนเงิน</th>
                            </tr>
                            <tr>
                                <th style="text-align: center; width: 20%">สด</th>
                                <th style="text-align: center; width: 20%">เครดิต</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php while ($valListProject = mysql_fetch_assoc($resultQueryListProject)){ ?>
                            <tr>
                                <td><?php echo $valListProject['code_project']; ?></td>
                                <td style="text-align: right;"><?php echo number_format($valListProject['cash'], 2); ?></td>
                                <td style="text-align: right;"><?php echo number_format($valListProject['credit'], 2); ?></td>
                            </tr>
                            <?php
                            $totalCash += $valListProject['cash'];
                            $totalCredit += $valListProject['credit'];
                            } if ($numListProject == 0){ ?>
                                <tr><td colspan="3" style="text-align: center">ไม่พบข้อมูล</td></tr>
                            <?php } ?>
                            </tbody>
                            <tfoot style="background: #eaeaea;">
                            <?php if ($numListProject != 0){ ?>
                            <tr>
                                <th style="text-align: center;">รวม</th>
                                <th style="text-align: right;"><?php echo number_format($totalCash, 2)?></th>
                                <th style="text-align: right;"><?php echo number_format($totalCredit, 2)?></th>
                            </tr>
                            <?php } ?>
                            </tfoot>

                        </table>

                    </div>
                </div>
            </div>
            <div class="panel-body">

                <div class="row">
                    <div class="col-lg-10" style="color: #ff0c0c;">
                        ค้นหาจาก
                        <?php if ($keyword){
                            echo " <strong>คำค้นหา</strong> <u>".$keyword."</u>";
                        }if ($tripID){
                            echo " <strong>TripID</strong> <u>".$tripID."</u>";
                        }if ($userid){
                            echo " <strong>ชื่อ (เจ้าของทริป)</strong> <u>".$valUserName['FullName']."</u>";
                        }if ($money){
                            echo " <strong>จำนวนเงิน</strong> <u>".$money."</u>";
                        }if ($type){
                            echo " <strong>ประเภทค่าใช้จ่าย</strong> <u>".$valTypeName['type_cost']."</u>";
                        }if ($dateStartTxt || $dateEndTxt){
                            echo " <strong>วันที่</strong> <u>".$_POST['dateStart']."</u> ถึง <u>";
                            echo $_POST['dateEnd']==''?DBThaiDate(date("Y-m-d")):$_POST['dateEnd'];
                            echo "</u>";
                        }if ($keyword == '' && $tripID == '' && $userid == '' && $money == '' && $type == '' && $dateStartTxt == '' && $dateEndTxt == ''){
                            echo "<strong>ทั้งหมด</strong>";
                        }
                        ?>
                    </div>
                    <div class="col-md-2" style="text-align: right;">
                        <strong>ผลการค้นหา </strong> <u><?php echo number_format($numListData); ?></u> <strong> รายการ</strong>
                    </div>
                </div><br>
                <div class="row">
                    <div class="col-lg-12" style="margin: auto;">
                        <table class="table table-striped table-hover table-bordered">
                            <thead style="background: #eaeaea;">
                            <tr>
                                <th rowspan="2" style="vertical-align: middle; text-align: center; width: 5%">ลำดับ</th>
                                <th rowspan="2" style="vertical-align: middle; text-align: center; width: 12%">
                                    <a href="<?php echo $_SERVER["PHP_SELF"]."?".$link1."&sort=date_list";?>">วัน เดือน ปี <span class="glyphicon glyphicon-sort" aria-hidden="true"></span></a></th>
                                <th rowspan="2" style="vertical-align: middle; text-align: center; width: 5%">
                                    <a href="<?php echo $_SERVER["PHP_SELF"]."?".$link1."&sort=tripid";?>">TripID <span class="glyphicon glyphicon-sort" aria-hidden="true"></span></a></th>
                                <th rowspan="2" style="vertical-align: middle; text-align: center; width: 18%;">
                                    <a href="<?php echo $_SERVER["PHP_SELF"]."?".$link1."&sort=`name`";?>">ชื่อ - นามสกุล (เจ้าของทริป) <span class="glyphicon glyphicon-sort" aria-hidden="true"></span></a></th>
                                <th rowspan="2" style="vertical-align: middle; text-align: center; width: 35%;">รายการ</th>
                                <th rowspan="2" style="vertical-align: middle; text-align: center; width: 10%">
                                    <a href="<?php echo $_SERVER["PHP_SELF"]."?".$link1."&sort=code_project";?>">โครงการ <span class="glyphicon glyphicon-sort" aria-hidden="true"></span></a></th>
								<th rowspan="2" style="vertical-align: middle; text-align: center; width: 35%;">ประเภท</th>
                                <th colspan="2" style="vertical-align: middle; text-align: center; width: 15%">จำนวนเงิน</th>
                            </tr>
                            <tr>
                                <th style="vertical-align: middle; text-align: center; width: 8%">
                                    <a href="<?php echo $_SERVER["PHP_SELF"]."?".$link1."&sort=cash_total";?>">สด <span class="glyphicon glyphicon-sort" aria-hidden="true"></span></a></th>
                                <th style="vertical-align: middle; text-align: center; width: 8%">
                                    <a href="<?php echo $_SERVER["PHP_SELF"]."?".$link1."&sort=credit_total";?>">เครดิต <span class="glyphicon glyphicon-sort" aria-hidden="true"></span></a></th>
                            </tr>

                            </thead>
                            <tbody>
                            <?php $i = 0;
                            if(isset($_GET['Page']) && $_GET['Page']!='1'){
                                $i=(intval($_GET['Page'])-1)*50;
                            }
                            while ($rowValSearch = mysql_fetch_assoc($resultQueryData)){
                                $i = $i+1;
                            ?>
                                <tr>
                                    <td align="center"><?php echo number_format($i); ?></td>
                                    <td><?php echo DBThaiLongDate($rowValSearch['date_list']); ?></td>
                                    <td><?php echo str_replace($tripID, "<span style='background:rgba(255,9,9,0.28);'>" .$tripID."</span>",$rowValSearch['tripid']); ?></td>
                                    <td><?php echo str_replace($valUserName['FullName'],"<span style='background:rgba(255,9,9,0.28);'>".$valUserName['FullName']."</span>",$rowValSearch['FullName']); ?></td>
                                    <td><?php echo str_replace($keyword,"<span style='background:rgba(255,9,9,0.28);'>".$keyword."</span>",$rowValSearch['detail']); ?></td>
                                    <td><?php echo $rowValSearch['code_project']; ?></td>
									<td><?php echo $rowValSearch['type_cost']; ?></td>
                                    <td align="right"><?php if ($money){echo str_replace($money,"<span style='background:rgba(255,9,9,0.28);'>".number_format($money, 2)."</span>",$rowValSearch['cash_total']);}else{echo number_format($rowValSearch['cash_total'], 2);} ?></td>
                                    <td align="right"><?php echo '<span data-toggle="tooltip" class="tip" title="'.$rowValSearch['type_credit'].'">';
                                            if ($money){echo str_replace($money,"<span style='background:rgba(255,9,9,0.28);'>".number_format($money, 2)."</span>",$rowValSearch['credit_total']);}else{echo number_format($rowValSearch['credit_total'], 2);}
                                            echo '</span>' ; ?>
                                    </td>
                                </tr>
                            <?php } if ($numListData == 0){ ?>
                                <tr><td colspan="8" style="text-align: center">ไม่พบข้อมูล</td></tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <?php if ($numListData != 0){ ?>
            <div class="panel-footer">
                <?php if ($_GET['showList'] == "showAll"){ ?>
                    <div class="row" style="text-align: right; margin-right: 5px;"><a href="index.php?showList=showPage<?php echo $link1; ?>">แบ่งหน้า</a> </div>
                <?php }else if ($_GET['showList'] == "showPage"){ ?>
                    <div class="row" style="text-align: right; margin-right: 5px;"><a href="index.php?showList=showAll<?php echo $link1; ?>">แสดงทั้งหมด</a> </div>
                    <div class="row" align="right">
                        <div class="col-lg-12">
                            <nav>
                                <ul class="pagination">
                                    <li>
                                        <?php if($prevPage) {
                                            echo "<a href='$_SERVER[SCRIPT_NAME]?Page=$prevPage$link1' aria-label='Previous'><span aria-hidden='true'>&laquo;</span></a>";
                                        } ?>
                                    </li>
                                    <?php for($i=1; $i<=$numPages; $i++){
                                        if($i != $page) {
                                            echo "<li><a href='$_SERVER[SCRIPT_NAME]?Page=$i$link1'>$i</a></li>";
                                        }else {
                                            echo "<li class='active'><a href=''>$i</a></li>";
                                        }
                                        ?>
                                    <?php } ?>
                                    <li>
                                        <?php if($page!=$numPages) {
                                            echo "<a href='$_SERVER[SCRIPT_NAME]?Page=$prevPage$link1' aria-label='Next'><span aria-hidden='true'>&raquo;</span></a>";
                                        }?>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <?php } } ?>
        </div>
    </div>
</div>

</body>
</html>