<?php
session_start();
//ini_set("display_errors","1");
include ("checklogin.php");
include ("phpconfig.php");
include ("libary/function.php");
conn2DB();
//$date_list = $getyear.'-'.$getmonth.'-'.$getday;
if ($action == "delete"){
    $xsql = mysql_query("select attach from `list` where runno = '$runno'")or die("Query line " . __LINE__ . " error<hr>".mysql_error());
    $xrs = mysql_fetch_assoc($xsql);
    if(file_exists($xrs[attach])){ unlink($xrs[attach]); }

    $sql = mysql_query("delete from list where runno = '$runno' ")or die("Query Line " . __LINE__ . " Error<hr>".mysql_error());
    $msg = "<b class='blue'>Complete</b><br>ลบข้อมูลเรียบร้อยแล้ว";
    include("msg_box.php");
    echo "<meta http-equiv='refresh' content='2;url=list.php'>" ;
    exit() ;
}elseif ($action =="endtrip")
{
    $strsql = "select * from list  where tripid='$tripid' ";
    $result = mysql_query($strsql);
    if(@mysql_num_rows($result)>0){
        $sql = "update list set  endtrip = 'y' where tripid = '$tripid' ";
        @mysql_query($sql);
        trip_status($tripid);
    }else{
        trip_status($tripid);
        $sql = "UPDATE `trip` SET `trip_status`='4' WHERE (`tripid`='$tripid')   ";
        @mysql_query($sql);
    }

    if (mysql_errno())
    {
        $msg = "ไม่สามารถบันทึกข้อมูลได้";
    }else{
        //header("Location: ?tripid=$tripid");
        echo "<meta http-equiv='refresh' content='0;url=?tripid=$tripid'>" ;
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
            $msg = "ไม่สามารถบันทึกข้อมูลได้";
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
                    <span class="style2">	ระบบได้ทำการบันทึกข้อมูลของท่านแล้ว และจะทำการติดต่อกลับเพื่อยืนยันโดยเจ้าหน้าที่รับลงทะเบียน ตามหมายเลข &nbsp; <?=$off_tel;?> และอีเมลล์ &nbsp; <?=$off_mail?>  </span>
                </tr>
                <tr align="center" >
                    <input name="" type="button" value = "   ปิด  "onClick=window.close();> &nbsp;&nbsp;
                    <input name="" type="reset"  value = "กลับหน้าหลัก"  onClick="location.href='index.php';">
                <tr>
            </table>
            <?
            exit;
        }
        else
        {
            echo "ไม่สามารถบันทึกข้อมูลได้ ";
        }
    }
}
$sql = "select * from  register   where  id='$id' ;";
$result = mysql_query($sql);
if ($result){
    $rs=mysql_fetch_array($result,MYSQL_ASSOC);
} else {
    $msg = "ไม่พบข้อมูลที่ต้องการ";
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

    <title>รายงานค่าใช้จ่ายในการออกปฏิบัติงาน</title>

    <meta http-equiv="Content-Type" content="text/html; charset=windows-874">




    <!-- check การระบุค่า  -->

    <SCRIPT LANGUAGE="JavaScript">

        <!--
        <? if($sendmail2staff==1){ ?>
        window.open('http://202.69.143.75/master/application/epm/_sendmailbycost.php','_blank','addres=no,toolbar=no,width=600,height=150');
        <? } ?>
        function ch1(){
            var f1=document.form1;
//		if (f1.refresh.value == "1"){
//			return true; //no checking for refreshing
            //	}
            if (!f1.name_office.value){
                alert("กรุณาระบุชื่อสถานประกอบการ");
                return false;
            }
            if (!f1.com_no.value){
                alert("กรุณาระบุเลขทะเบียนการค้า");
                return false;
            }
            if (!f1.off_no.value){
                alert("กรุณาระบุเลขที่สถานที่ตั้งสำนักงาน");
                return false;
            }
            if (!f1.off_province.value) {
                alert("กรุณาระบุจังหวัดสถานที่ตั้งสำนักงาน");
                return false;
            }
            if  (!f1.off_tel.value) {
                alert("กรุณาระบุเบอร์โทรศัพท์ที่ตั้งสำนักงาน ");
                return false;
            }
            if (!f1.agg.checked  &&  !f1.travel.checked  && !f1.produce.checked  && !f1.other.checked ){
                alert("กรุณาระบุประเภทธุรกิจ ");
                return false;
            }
            if (!f1.officer.value){
                alert("กรุณาระบุจำนวนพนักงานประจำ");
                return false;
            }
            if (!f1.officer_total.value){
                alert("กรุณาระบุพนักงานรวมทั้งหมด");
                return false;
            }
            if (!f1.name.value){
                alert("กรุณาระบุผู้มีอำนาจตัดสินใจ ");
                return false;
            }
            if (!f1.surname.value){
                alert("กรุณาระบุข้อมูลผู้มีอำนาจตัดสินใจ ");
                return false;
            }
            if (!f1.position.value){
                alert("กรุณาระบุตำแหน่งผู้มีอำนาจตัดสินใจ ");
                return false;
            }
            if (!f1.tel.value){
                alert("กรุณาระบุเบอร์โทรศัพท์ผู้มีอำนาจตัดสินใจ ");
                return false;
            }
            if (!f1.it_yes.checked  &&  !f1.it_no.checked   ){
                alert("กรุณาระบุเจ้าหน้าที่รับผิดชอบด้านระบบเทคโนโลยีสารสนเทศ (ไอที) ");
                return false;
            }
        }

        //-->

    </SCRIPT>

    <!-- send id to menu flash -->

    <script language=javascript>
        <!--

        //window.top.leftFrame.document.menu.SetVariable("logmenu.id","<?=$id?>");

        //	window.top.leftFrame.document.menu.SetVariable("logmenu.action","edit");
        function checkid(){  //รวบรวมสร้าง id
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
<script> window.print(); </script>
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
              <p><strong>คงเหลือ</strong></p>
          </td>
          <td align="right">
              <p>
                  <strong>
                      <?
                      $sqls = "select sum(appbudget) as app from tripvalue  where (tripid = '$tripid') ";
                      $res = mysql_query($sqls);
                      $rss = mysql_fetch_assoc($res);
                      echo number_format($rss[app],2);
                      ?>

                  </strong>
              </p>
              <p>
                  <strong>
                      <?
                      $sqls				= " select sum(cash_total) as cash_total,sum(credit_total) as credit_total  from list  where tripid = '$tripid'; ";
                      $res				= mysql_query($sqls);
                      $resc				= mysql_fetch_assoc($res);
                      $cash_total	= $resc[cash_total] + $resc[credit_total];
                      echo number_format($resc[cash_total],2);
                      ?>

                  </strong>
              </p>
              <p>
                  <strong>
                      <?=number_format($resc[credit_total],2);?>

                  </strong>
              </p>
              <p>
                  <strong>
                      <?=number_format($cash_total,2);?>

                  </strong>
              </p>
              <p>
                  <strong>
                      <?
                      $remain = $rss[app] - $resc[cash_total] ;
                      echo number_format($remain,2);
                      ?>

                      </strong>
              </p>
          </td>
          <td align="center">
              <p><strong>บาท</strong></p>
              <p><strong>บาท</strong></p>
              <p><strong>บาท</strong></p>
              <p><strong>บาท</strong></p>
              <p><strong>บาท</strong></p>
          </td>
      </tr>
</table>
    <table border="1px solid black" width="100%">
        <thead>
    <tr>
        <th colspan="5" align="left"><strong>ค่าใช้จ่ายจำแนกรายโครงการ</strong></th>
    </tr>
        </thead>
    <?
    $i=0;
    $no=0;
    /* check userid query
        If  ($pri == '100')
        {
            If ($sortfield == "")
            {
                $str = " select  sum(t1.cash_total+t1.credit_total) as total,t2.code_project,t1.id_type_project  from list t1 left join type_project t2 on t1.id_type_project = t2.id_type_project  where (t1.tripid = '$tripid')   group by  t1.id_type_project   order by date_list   ; ";
            }
            else
            {
                $str = " select  sum(t1.cash_total+t1.credit_total) as total,t2.code_project,t1.id_type_project from list t1 left join type_project t2 on t1.id_type_project = t2.id_type_project  where (t1.tripid = '$tripid')    group by  t1.id_type_project    order by $sortfield  $sort ; ";
            }
        }else
        {
                If ($sortfield == "")
            {
                $str = " select  sum(t1.cash_total+t1.credit_total) as total,t2.code_project,t1.id_type_project  from list t1 left join type_project t2 on t1.id_type_project = t2.id_type_project  where (t1.tripid = '$tripid')  and (userid= '$_SESSION[userid]')  group by  t1.id_type_project   order by date_list   ; ";
            }
            else
            {
                $str = " select  sum(t1.cash_total+t1.credit_total) as total,t2.code_project,t1.id_type_project from list t1 left join type_project t2 on t1.id_type_project = t2.id_type_project  where (t1.tripid = '$tripid')  and (userid= '$_SESSION[userid]')  group by  t1.id_type_project    order by $sortfield  $sort ; ";
            }

        }// end if privilage
        */
    If ($sortfield == "")
    {
        $str = " select  sum(t1.cash_total+t1.credit_total) as total,t2.code_project,t1.id_type_project  from list t1 left join type_project t2 on t1.id_type_project = t2.id_type_project  where (t1.tripid = '$tripid')   group by  t1.id_type_project   order by date_list   ; ";
    }
    else
    {
        $str = " select  sum(t1.cash_total+t1.credit_total) as total,t2.code_project,t1.id_type_project from list t1 left join type_project t2 on t1.id_type_project = t2.id_type_project  where (t1.tripid = '$tripid')    group by  t1.id_type_project    order by $sortfield  $sort ; ";
    }
    $result = mysql_query($str);
    while ($rs=mysql_fetch_array($result,MYSQL_ASSOC)){
        $i++;
        $no++;
        if ($i % 2) {
            $bg = "#EFEFEF";
        }else{
            $bg = "#DDDDDD";
        }
        ?>
        <tbody>
        <tr>
            <td width="40%" align="left"><?=$no?>&nbsp;โครงการ &nbsp; <?=$rs[code_project]?>&nbsp; &nbsp;&nbsp;</td>
            <td width="0%" align="center" >เป็นเงิน                              </td>
            <td width="30%" align="right" ><strong><?=number_format($rs[total],2)?></strong></td>
            <td align="center"><strong>บาท</strong></td>

        </tr>
        </tbody>
        <?
    }
    ?>
</table>
    <br>
    <table border="1px solid black" width="100%">
        <thead>
        <tr>
            <th colspan="5" align="left"><strong>ค่าใช้จ่ายจำแนกรายหมวดค่าใช้จ่าย</strong></th>
        </tr>
        </thead>
        <?
        $i=0;
        $no=0;
        If ($sortfield == "")
        {
            $str = " select  sum(t1.cash_total+t1.credit_total) as total,t2.type_cost,t1.id_type_cost  from list t1 left join type_cost t2 on t1.id_type_cost = t2.id_type_cost  where (t1.tripid = '$tripid')    group by  t1.id_type_cost     order by date_list   ; ";
        }
        else
        {
            $str = " select  sum(t1.cash_total+t1.credit_total) as total,t2.type_cost,t1.id_type_cost  from list t1 left join type_cost t2 on t1.id_type_cost = t2.id_type_cost  where (t1.tripid = '$tripid')   group by  t1.id_type_cost  order by $sortfield  $sort ; ";
        }
        $result = mysql_query($str);
        while ($rs=mysql_fetch_array($result,MYSQL_ASSOC)){
            $i++;
            $no++;
            if ($i % 2) {
                $bg = "#EFEFEF";
            }else{
                $bg = "#DDDDDD";
            }
            ?>
            <tbody>
            <tr>
                <td width="40%" align="left"><?=$no?>
                    &nbsp;
                    <?=$rs[type_cost]?>
                    &nbsp; &nbsp;&nbsp;</td>
                <td width="0%" align="center">เป็นเงิน</td>

                <td width="30%" align="right"><strong><?=number_format($rs[total],2)?></strong></td>
                <td align="center"><strong>บาท</strong></td>

            </tr>
            </tbody>
            <?
        }
        ?>
    </table>
    <br>
<table width="100%">
    <tr>
        <td width="10%"></td>
        <td width="40%">&nbsp;</td>
        <td width="40%">&nbsp;</td>
        <td width="10%">&nbsp;</td>
    </tr>
    <tr>
        <td width="10%"></td>
        <td width="40%" align="center">.......................................................</td>
        <td width="40%" align="center">.......................................................</td>
        <td width="10%"></td>
    </tr>
    <tr>
        <td width="10%"></td>
        <td width="40%" height="25" align="center">
            (<strong><?=GetTripOwner($tt)?>
            </strong>)
        </td>
        <td width="40%" align="center">(&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)</td>
        <td width="10%"></td>
    </tr>
    <tr>
        <td width="10%"></td>
        <td width="40%" height="25" align="center">วันที่ออกรายงาน
            <?=DBThaiLongDate(date("Y-m-d"));?></td>
        <td width="30%" height="25" align="center">ผู้อนุมัติ</td>
        <td width="10%"></td>
    </tr>
</table>
</div>
</center>
</body>

</html>

