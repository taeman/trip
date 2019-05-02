<?php
session_start();
//ini_set("display_errors","1");
include ("checklogin.php");
include ("phpconfig.php");
include ("libary/function.php");
conn2DB();
//$date_list = $getyear.'-'.$getmonth.'-'.$getday;
if ($action == "delete") {
    $xsql = mysql_query("select attach from `list` where runno = '$runno'") or die("Query line " . __LINE__ . " error<hr>" . mysql_error());
    $xrs = mysql_fetch_assoc($xsql);
    if (file_exists($xrs[attach])) {
        unlink($xrs[attach]);
    }

    $sql = mysql_query("delete from list where runno = '$runno' ") or die("Query Line " . __LINE__ . " Error<hr>" . mysql_error());
    $msg = "<b class='blue'>Complete</b><br>ลบข้อมูลเรียบร้อยแล้ว";
    echo $msg;
    include("msg_box.php");
//    header("Location: list.php?tripid=$tripid");
    ?>
    <SCRIPT LANGUAGE="JavaScript">
        window.location = "list.php?tripid=<?php echo $tripid; ?>";
    </SCRIPT>
    <?php
    exit;
}

if (isset($_GET['sort'])) {
    if ($_GET['sort'] == "asc") {
        $sort = "desc";
    } else {
        $sort = "asc";
    }
} else {
    $sort = "asc";
}

$getstr .= "sort=" . $sort . "&";

if($id_type_project != ''){
    $where_list = "AND t1.id_type_project='".$id_type_project."' ";
    $where_list_sum = "AND id_type_project='".$id_type_project."' ";
}else{
    $where_list = "";
    $where_list_sum = "";
}

?>

<SCRIPT language=JavaScript

        src="bimg/swap.js"></SCRIPT>

<html>

<head>

    <title>รายงานค่าใช้จ่ายในการออกปฏิบัติงาน</title>

    <meta http-equiv="Content-Type" content="text/html; charset=tis-620">




    <!-- check การระบุค่า  -->

    <SCRIPT LANGUAGE="JavaScript">

        <!--





        function ch1() {
            var f1 = document.form1;
            //		if (f1.refresh.value == "1"){
            //			return true; //no checking for refreshing
            //	}
            if (!f1.name_office.value) {
                alert("กรุณาระบุชื่อสถานประกอบการ");
                return false;
            }
            if (!f1.com_no.value) {
                alert("กรุณาระบุเลขทะเบียนการค้า");
                return false;
            }
            if (!f1.off_no.value) {
                alert("กรุณาระบุเลขที่สถานที่ตั้งสำนักงาน");
                return false;
            }
            if (!f1.off_province.value) {
                alert("กรุณาระบุจังหวัดสถานที่ตั้งสำนักงาน");
                return false;
            }
            if (!f1.off_tel.value) {
                alert("กรุณาระบุเบอร์โทรศัพท์ที่ตั้งสำนักงาน ");
                return false;
            }
            if (!f1.agg.checked && !f1.travel.checked && !f1.produce.checked && !f1.other.checked) {
                alert("กรุณาระบุประเภทธุรกิจ ");
                return false;
            }
            if (!f1.officer.value) {
                alert("กรุณาระบุจำนวนพนักงานประจำ");
                return false;
            }
            if (!f1.officer_total.value) {
                alert("กรุณาระบุพนักงานรวมทั้งหมด");
                return false;
            }
            if (!f1.name.value) {
                alert("กรุณาระบุผู้มีอำนาจตัดสินใจ ");
                return false;
            }
            if (!f1.surname.value) {
                alert("กรุณาระบุข้อมูลผู้มีอำนาจตัดสินใจ ");
                return false;
            }
            if (!f1.position.value) {
                alert("กรุณาระบุตำแหน่งผู้มีอำนาจตัดสินใจ ");
                return false;
            }
            if (!f1.tel.value) {
                alert("กรุณาระบุเบอร์โทรศัพท์ผู้มีอำนาจตัดสินใจ ");
                return false;
            }
            if (!f1.it_yes.checked && !f1.it_no.checked) {
                alert("กรุณาระบุเจ้าหน้าที่รับผิดชอบด้านระบบเทคโนโลยีสารสนเทศ (ไอที) ");
                return false;
            }
        }

        //-->

    </SCRIPT>

    <!-- send id to menu flash -->

    <script language=javascript>
        <!--

        //window.top.leftFrame.document.menu.SetVariable("logmenu.id","<?= $id ?>");

        //	window.top.leftFrame.document.menu.SetVariable("logmenu.action","edit");
        function checkid() {  //รวบรวมสร้าง id
            f1 = document.form1;
            f1.id.value = f1.id1.value + f1.id2.value + f1.id3.value + f1.id4.value + f1.id5.value;
        }
        var isNN = (navigator.appName.indexOf("Netscape") != -1);
        function autoTab(input, len, e) {
            var keyCode = (isNN) ? e.which : e.keyCode;
            var filter = (isNN) ? [0, 8, 9] : [0, 8, 9, 16, 17, 18, 37, 38, 39, 40, 46];
            if (input.value.length >= len && !containsElement(filter, keyCode)) {
                input.value = input.value.slice(0, len);
                input.form[(getIndex(input) + 1) % input.form.length].focus();
            }

            function containsElement(arr, ele) {
                var found = false, index = 0;
                while (!found && index < arr.length)
                    if (arr[index] == ele)
                        found = true;
                    else
                        index++;
                return found;
            }

            function getIndex(input) {
                var index = -1, i = 0, found = false;
                while (i < input.form.length && index == - 1)
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
    <style>

        a {
            color: black;
            text-decoration: none;
        }

        a:hover {
            color: black;
            text-decoration: none;
        }
        body{
            font-family:"TH SarabunPSK";

        }
        table tr td{
            font-size: 20px;
            color:black;
        }
        table{
            border-collapse: collapse;
        }

        .page {
            width: 21cm;
            vertical-align: middle;
            padding-right: 20px;
            padding-left: 20px;
            padding-bottom: 20px;
            padding-top: 0px;
        }
        table #head ,tr ,td, p{
            padding:5px;
        }
        thead th{
            padding:5px;
            font-size: 20px;
        }
        p{
            line-height: 0.3;
        }
        .alignleft{
            float: left;
        }
        .alignright{
            float: right;
        }
        .title h2{
            text-align: center;
        }
        #head1{
            float: left;
            width: 49%;

            padding-top: 0px;
            margin-top: 0px;

        }
        #head2{
            float: right;
            margin-bottom: 18px;
            width:49%;
        }
        @media print {
            thead {display: table-header-group;}
        }

    </style>
</head>
<body >
<script>
    window.print();
</script>
<center>
    <div class="page">
        <div id="topID">
            <h2><p class="alignleft"><strong><?php
if($_SESSION['application']=='gnis'){
echo "GNIS SMART SOLUTION CO.,LTD.";
}else{
echo "Sapphire Research & Development Co., Ltd.";
}
	?></strong></p></h2>
            <h2><p class="alignright">
                    <strong> TripID:
                        <?
                        $sqls = "select * from trip where tripid = '$tripid' ";
                        $res = mysql_query($sqls);
                        $rss = mysql_fetch_assoc($res);
                        echo "$rss[tripid] ";

                        $display = ($pri =='80' && $rss['userid'] != $_SESSION[userid]);true:false;
                        ?>
                    </strong>
                </p>
            </h2>
        </div>
        <br>
        <br>
        <br>
        <u><h1>รายงานค่าใช้จ่ายในการออกปฏิบัติงาน</h1></u>

        <table border="1px solid black" id="head1" class="alignleft">

            <tr>
                <td>
                    <p><strong>Trip Name :</strong></p>
                    <p><strong>Staff Name:</strong></p>
                    <p><strong>ช่วงเวลาออกพื้นที่ปฏิบัติงาน</strong></p>
                    <p><br></p>

                </td>
                <td>
                    <p>
                        <?=$rss[tripname]?>
                    </p>
                    <p>
                        <?
                        $tt = $rss[tripid];
                        ?>
                        <?=GetTripOwner($rss[tripid])?>
                    </p>
                    <p>
                        <?
                        $sqld = "select max(date_list) as maxdate,min(date_list) as mindate from list where tripid = '$tripid' ";
                        $resultd = mysql_query($sqld);
                        $rsd = mysql_fetch_assoc($resultd);
                        if (is_null($rsd[maxdate]))
                        {
                            echo "-";
                        }else
                        {
                            echo daythai($rsd[mindate]);
                            echo "&nbsp; - &nbsp;";
                            echo daythai($rsd[maxdate]);
                        }
                        ?>
                    </p>
                    <p><br></p>

                </td>
            </tr>
        </table>
        <table border="1px solid black" id="head2">
            <tr>
                <td>
                    <p><strong>งบประมาณที่ได้รับอนุมัติ</strong></p>
                    <p><strong>งบประมาณที่ใช้จริง - เงินสด</strong></p>
                    <p><strong>เครดิต</strong></p>
                    <p><strong>รวม</strong></p>

                </td>
                <td align="right">
                    <p>
                        <strong>
                            <?
                            $sqls = "select sum(appbudget) as app from tripvalue  where (tripid = '$tripid')  ";
                            $res = mysql_query($sqls);
                            $rss = mysql_fetch_assoc($res);
                            echo number_format($rss[app], 2);
                            ?>

                        </strong>
                    </p>
                    <p>
                        <strong>
                            <?
                            If ($pri == "100") {
                                $sqls = "select sum(cash_total) as cash_total,sum(credit_total) as credit_total  from list  where tripid = '$tripid'  and (id_type_cost = '$id_type_cost') {$where_list_sum}";
                            } else {
                                $sqls = "select sum(cash_total) as cash_total,sum(credit_total) as credit_total  from list  where tripid = '$tripid'  and userid= '$_SESSION[userid]' and (id_type_cost = '$id_type_cost') {$where_list_sum}";
                            }
                            $res = mysql_query($sqls);
                            $resc = mysql_fetch_assoc($res);
                            echo number_format($resc[cash_total], 2);
                            ?>

                        </strong>
                    </p>
                    <p>
                        <strong>
                            <?= number_format($resc[credit_total], 2); ?>

                        </strong>
                    </p>
                    <p>
                        <strong>
                            <?= number_format($resc[cash_total] + $resc[credit_total], 2); ?>

                        </strong>
                    </p>

                </td>
                <td align="center">
                    <p><strong>บาท</strong></p>
                    <p><strong>บาท</strong></p>
                    <p><strong>บาท</strong></p>
                    <p><strong>บาท</strong></p>

                </td>
            </tr>
        </table>
        <table width="100%" border="1" cellspacing="0" cellpadding="0">
            <thead>
            <tr align="center">
                <th width="5%" rowspan="2"><strong>ลำดับ</strong></th>
                <th rowspan="2" ><strong><a href="?<?= $getstr ?>sortfield=date_list&tripid=<?= $tripid ?>&id_type_cost=<?= $id_type_cost ?>">วันที่</a></strong></th>
                <th rowspan="2" ><strong>รายการ</strong></th>
                <th colspan="3" ><strong>จำนวนเงิน</strong></th>
                <th rowspan="2" b><strong><a href="?<?= $getstr ?>sortfield=id_type_project&tripid=<?= $tripid ?>&id_type_cost=<?= $id_type_cost ?>">โครงการ</a></strong></th>
                <th rowspan="2" ><strong>Cost ID</strong></th>
                <th rowspan="2" ><strong>TOR ID</strong></th>
                <th rowspan="2" ><strong><a href="?<?= $getstr ?>sortfield=complete&tripid=<?= $tripid ?>&id_type_cost=<?= $id_type_cost ?>">BILL</a></strong></th>

            </tr>
            <tr align="center">
                <th><strong>เงินสด</strong></th>
                <th><strong>เครดิต</strong></th>
                <th><strong>รวม</strong></th>

            </tr>
            </thead>


            <?
            $i = 0;
            $no = 0;

            If ($pri == '100' || $pri == '80') {
                If ($sortfield == "") {
                    $str = "select *  from list t1 left join type_cost t2 on t1.id_type_cost = t2.id_type_cost where (t1.tripid = '$tripid') and (t1. id_type_cost='$id_type_cost') {$where_list} order by date_list  ";
                } else {
                    $str = " select *  from list t1 left join type_cost t2 on t1.id_type_cost = t2.id_type_cost where (t1.tripid = '$tripid') and (t1. id_type_cost='$id_type_cost')  {$where_list} order by t1.$sortfield $sort   ";
                }
            } else {
                If ($sortfield == "") {
                    $str = "select *  from list t1 left join type_cost t2 on t1.id_type_cost = t2.id_type_cost where (t1.tripid = '$tripid') and (t1. id_type_cost='$id_type_cost') and (t1.userid = '$userid') {$where_list}order by date_list  ";
                } else {
                    $str = " select *  from list t1 left join type_cost t2 on t1.id_type_cost = t2.id_type_cost where (t1.tripid = '$tripid') and (t1. id_type_cost='$id_type_cost') and (t1.userid = '$userid') {$where_list} order by t1.$sortfield $sort   ";
                }
            }// end if privilage
            $result = mysql_query($str);
            while ($rs = mysql_fetch_array($result, MYSQL_ASSOC)) {
                $sum_cash+=$rs[cash_total];
                $sum_credit+=$rs[credit_total];
                $i++;
                $no++;
                if ($i % 2) {
                    $bg = "#EFEFEF";
                } else {
                    $bg = "#DDDDDD";
                }
                if ($rs[attach] != "") {
                    $attach = "<a href=\"" . $rs[attach] . "\"  target=\"_blank\"><img src=\"bimg/attach.gif\" border=\"0\"></a>";
                } else {
                    $attach = "";
                }
                ?>
                <tbody>
                <tr align="center">
                    <td width="5%"><?= $no ?></td>
                    <td><?= daythai($rs[date_list]) ?></td>
                    <td align="left"><?= "&nbsp;" . $attach . $rs[detail] ?></td>
                    <td align="right"><?= number_format($rs[cash_total], 2) ?></td>
                    <td align="right"><?= number_format($rs[credit_total], 2) ?></td>
                    <td align="right"><?= number_format($rs[cash_total] + $rs[credit_total], 2) ?></td>
                    <td><?
                        $res = mysql_query("select * from type_project");
                        while ($rss = mysql_fetch_assoc($res)) {
                            If ($rs[id_type_project] == $rss[id_type_project]) {
                                echo "$rss[code_project]";
                            }
                        }
                        ?></td>
                    <td align="center"><?php echo $rs['cost_id'];?></td>
                    <td align="center"><?php echo $rs['tor_id'];?></td>

                    <td>
                        <?
                        If ($rs[complete] == "y") {
                            echo "<img src=\"bimg/yy.png\" >";
                        } elseif ($rs[complete] == "n") {
                            echo "<img src=\"bimg/alert.gif\" >";
                        }
                        ?></td>

                </tr>
                <?
            } //while
            // List Template
            if (mysql_num_rows($result) > 0) {
                ?>
                <tr align="center">
                    <td colspan="3"><strong>รวม</strong></td>
                    <td align="right" ><strong>
                            <?= number_format($sum_cash, 2) ?>
                        </strong></td>
                    <td align="right" ><strong>
                            <?= number_format($sum_credit, 2) ?>
                        </strong></td>
                    <td align="right" ><strong>
                            <?= number_format($sum_cash + $sum_credit, 2) ?>
                        </strong></td>
                    <td colspan="6" ></td>
                </tr>
                <?
            } else {
                ?>
                <tr align="center">
                    <td colspan="12"><strong>ไม่มีข้อมูล</strong></td>
                </tr>
                <?
            }
            ?>
                </tbody>
        </table>
        <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
            <tr>
                <td width="50%">&nbsp;</td>
            </tr>
            <tr>
                <td width="50%" align="center">.......................................................</td>
            </tr>
            <tr>
                <td width="50%" height="25" align="center">(<strong>
                        <?= GetTripOwner($tt) ?>
                    </strong>)</td>
            </tr>
            <tr>
                <td width="50%" height="25" align="center">วันที่ออกรายงาน
                    <?= DBThaiLongDate(date("Y-m-d")); ?></td>
            </tr>
        </table>

    </div>
</center>
</body>

</html>
