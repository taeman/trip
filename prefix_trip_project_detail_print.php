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
    $msg = "<b class='blue'>Complete</b><br>ź���������º��������";
    include("msg_box.php");
    echo "<meta http-equiv='refresh' content='2;url=?tripid=$tripid&id_type_project=$id_type_project&sname=$sname&ssurname=$ssurname'>" ;
    exit() ;
}elseif ($action =="endtrip")
{
    $sql = "update list set  endtrip = 'y' where tripid = '$tripid' ";
    @mysql_query($sql);
    if (mysql_errno())
    {
        $msg = "�������ö�ѹ�֡��������";
    }else{
        header("Location: ?tripid=$tripid");
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
            $msg = "�������ö�ѹ�֡��������";
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
                    <span class="style2">	�к���ӡ�úѹ�֡�����Ţͧ��ҹ���� ��Шзӡ�õԴ��͡�Ѻ�����׹�ѹ�����˹�ҷ���Ѻŧ����¹ ��������Ţ &nbsp; <?=$off_tel;?> ���������� &nbsp; <?=$off_mail?>  </span>
                </tr>
                <tr align="center" >
                    <input name="" type="button" value = "   �Դ  "onClick=window.close();> &nbsp;&nbsp;
                    <input name="" type="reset"  value = "��Ѻ˹����ѡ"  onClick="location.href='index.php';">
                <tr>
            </table>
            <?
            exit;
        }
        else
        {
            echo "�������ö�ѹ�֡�������� ";
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

        src="bimg/swap.js"></SCRIPT>

<html>

<head>

    <title>��§ҹ��������㹡���͡��Ժѵԧҹ</title>

    <meta http-equiv="Content-Type" content="text/html; charset=windows-874">


    <!-- check ����кؤ��  -->

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
                alert("��س��кت���ʶҹ��Сͺ���");
                return false;
            }
            if (!f1.com_no.value){
                alert("��س��к��Ţ����¹��ä��");
                return false;
            }
            if (!f1.off_no.value){
                alert("��س��к��Ţ���ʶҹ������ӹѡ�ҹ");
                return false;
            }
            if (!f1.off_province.value) {
                alert("��س��кبѧ��Ѵʶҹ������ӹѡ�ҹ");
                return false;
            }
            if  (!f1.off_tel.value) {
                alert("��س��к��������Ѿ�������ӹѡ�ҹ ");
                return false;
            }
            if (!f1.agg.checked  &&  !f1.travel.checked  && !f1.produce.checked  && !f1.other.checked ){
                alert("��س��кػ�������áԨ ");
                return false;
            }
            if (!f1.officer.value){
                alert("��س��кبӹǹ��ѡ�ҹ��Ш�");
                return false;
            }
            if (!f1.officer_total.value){
                alert("��س��кؾ�ѡ�ҹ���������");
                return false;
            }
            if (!f1.name.value){
                alert("��س��кؼ�����ӹҨ�Ѵ�Թ� ");
                return false;
            }
            if (!f1.surname.value){
                alert("��س��кآ����ż�����ӹҨ�Ѵ�Թ� ");
                return false;
            }
            if (!f1.position.value){
                alert("��س��кص��˹觼�����ӹҨ�Ѵ�Թ� ");
                return false;
            }
            if (!f1.tel.value){
                alert("��س��к��������Ѿ�������ӹҨ�Ѵ�Թ� ");
                return false;
            }
            if (!f1.it_yes.checked  &&  !f1.it_no.checked   ){
                alert("��س��к����˹�ҷ���Ѻ�Դ�ͺ��ҹ�к�෤��������ʹ�� (�ͷ�) ");
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
                    <strong> ���ʡ���Թ�ҧ:
                        <?
                        $sqls = "select * from trip where tripid = '$tripid' ";
                        $res = mysql_query($sqls);
                        $rss = mysql_fetch_assoc($res);
                        echo "$rss[tripid] ";
                        ?>
                    </strong>
                </p>
            </h2>
        </div>
        <br>
        <br>
        <br>
        <u><h1>��§ҹ����Թ�ҧ�����͡��Ժѵ�˹�ҷ��㹵�ҧ�ѧ��Ѵ</h1></u>
        <table width="100%" border="1" align="center" cellpadding="0" cellspacing="0" >
            <tr>
                <td ><strong>�Ԩ���� :</strong></td>
                <td>
                    <?=$rss[tripname]?>
                </td>
            </tr>
            <tr>
                <td><strong>����-���ʡ�� :</strong> </td>
                <td>
                    <?
                    $tt = $rss[tripid];
                    ?>
                    <?=GetTripOwner($rss[tripid])?>
                </td>
            </tr>
            <tr>
                <td ><strong>��ǧ�����͡��Ժѵԧҹ :</strong></td>
                <td>
                    <?
                    $sqld = "select max(date_list) as maxdate,min(date_list) as mindate from list where tripid = '$tripid' ";
                    $resultd = mysql_query($sqld);
                    $rsd = mysql_fetch_assoc($resultd);
                    if (is_null($rsd[maxdate]))
                    {
                        echo "-";
                    }else{
                        echo daythai($rsd[mindate]);
                        echo "&nbsp; - &nbsp;";
                        echo daythai($rsd[maxdate]);
                    }
                    $str_date=strtotime($rsd[mindate]) - strtotime($rsd[maxdate]);
                    echo ($str_date)?"�ӹǹ ".str_replace( "-","",intval(($str_date)/(60*60*24)) )." �ѹ	" : "";
                    ?>

                </td>
            </tr>
            <tr>
                <td align="left"><strong>�ç��� :</strong></td>
                <td>
                        <?
                        $i=0;
                        $no=0;
                        If ($sortfield == "")
                        {
                            $str = "
										select
											sum(t1.cash_total+t1.credit_total) as total,
											t2.code_project,
											t2.name_project,
											t1.id_type_project
										from
											list t1
											left join type_project t2 on t1.id_type_project = t2.id_type_project
										where (t1.tripid = '$tripid')
										AND (t1.id_type_project = '$id_type_project')
										group by  t1.id_type_project
										order by date_list   ; ";
                        }
                        else
                        {
                            $str = "
										select
											sum(t1.cash_total+t1.credit_total) as total,
											t2.code_project,
											t2.name_project,
											t1.id_type_project
										from
											list t1
											left join type_project t2 on t1.id_type_project = t2.id_type_project
										where (t1.tripid = '$tripid')
										AND (t1.id_type_project = '$id_type_project')
										group by  t1.id_type_project
										order by $sortfield  $sort ; ";
                        }
                        $result = mysql_query($str);
                        while ($rs=mysql_fetch_array($result,MYSQL_ASSOC)){
                            ?>

                            <a href="listproject.php?tripid=<?=$tripid?>&id_type_project=<?=$rs[id_type_project]?>&sname=<?=$sname?>&ssurname=<?=$ssurname?>">
                                <?=$rs[code_project]?"\"$rs[code_project]\"":""?>
                            </a>
                            <?=$rs[name_project] ?>

                            <?
                        }
                        ?>
                        </td>
                        </tr>
                        <tr>
                            <td>
                                <?
                                $str = "
										SELECT
										max(t1.date_list) as last_date
										FROM
										list AS t1
										where (t1.tripid = '$tripid')
										AND (t1.id_type_project = '$id_type_project')
										limit 1
										";
                                $result_lastdate = mysql_query($str);
                                $rs_lastdate=mysql_fetch_assoc($result_lastdate);
                                ?>
                                <strong>��������´�������� : </strong>
                            </td>
                            <td>������ � �ѹ���
                                <?=($rs_lastdate[last_date])?daythai($rs_lastdate[last_date])." (�ѹ����ش���·���Դ��¡�ä�������)":daythai(date("Y-m-d"))." (�ѧ����Դ��¡�ä�������)"?>
                            </td>
                        </tr>
                    </table>
        <br><br>
                    <table width="100%" border="1" align="center" cellpadding="0" cellspacing="0">
                    <thead>
                        <tr>
                            <th width="5%" rowspan="2" align="center" ><strong>�ӴѺ</strong></th>
                            <th width="30%" rowspan="2" align="center" ><strong>��Ǵ��¡��</strong></th>
                            <th colspan="3" align="center" ><strong>�ӹǹ�Թ(�ҷ)</strong></th>
                        </tr>
                        <tr>
                            <th width="20%"  align="center"><strong>�Թʴ</strong></th>
                            <th width="20%"  align="center"><strong>�ôԵ</strong></th>
                            <th width="20%"  align="center"><strong>���</strong></th>
                        </tr>
                    </thead>
                        <tbody>
                        <?
                        $i=0;
                        $no=0;
                        If ($sortfield == "")
                        {
                            $str = "
										select
											sum(t1.cash_total) as cash_total,
											sum(t1.credit_total) as credit_total,
											sum(t1.cash_total+t1.credit_total) as total,
											sum( if(t1.cash_total>0,1,0) ) as Xnum_cash,
											sum( if(t1.credit_total>0,1,0) ) as Xnum_credit	,
											t2.type_cost,
											t1.id_type_cost
										from list t1 left join type_cost t2 on t1.id_type_cost = t2.id_type_cost
										where (t1.tripid = '$tripid')
										AND (t1.id_type_project = '$id_type_project')
										group by  t1.id_type_cost     order by date_list   ; ";
                        }
                        else
                        {
                            $str = "
										select
											sum(t1.cash_total) as cash_total,
											sum(t1.credit_total) as credit_total,
											sum(t1.cash_total+t1.credit_total) as total,
											sum( if(t1.cash_total>0,1,0) ) as Xnum_cash,
											sum( if(t1.credit_total>0,1,0) ) as Xnum_credit	,
											t2.type_cost,
											t1.id_type_cost
										from list t1 left join type_cost t2 on t1.id_type_cost = t2.id_type_cost
										where (t1.tripid = '$tripid')
										AND (t1.id_type_project = '$id_type_project')
										group by  t1.id_type_cost  order by $sortfield  $sort ; ";
                        }
                        $result = mysql_query($str);
                        while ($rs=mysql_fetch_array($result,MYSQL_ASSOC)){
                            $i++;
                            $no++;
                            if ($i % 2) {$bg = "#EFEFEF";}else{	$bg = "#DDDDDD";	}
                            $sum_cash_total+=$rs[cash_total];
                            $sum_credit_total+=$rs[credit_total];
                            $sum_total+=$rs[total];
                            ?>
                            <tr>
                                <td align="center"><?=$no?></td>
                                <td align="left">&nbsp;<a href="listtypecost.php?tripid=<?=$tripid?>&id_type_project=<?php echo $_GET['id_type_project']?>&id_type_cost=<?=$rs[id_type_cost]?>&sname=<?=$sname?>&ssurname=<?=$ssurname?>"><?=$rs[type_cost]?></a>&nbsp; &nbsp;&nbsp;</td>
                                <td align="right"><!--<?=$rs[Xnum_cash]?$rs[Xnum_cash]."x":""?>--><?=number_format($rs[cash_total],2)?></td>
                                <td align="right"><!--<?=$rs[Xnum_credit]?$rs[Xnum_credit]."x":""?>--><?=number_format($rs[credit_total],2)?></td>
                                <td align="right"><?=number_format($rs[total],2)?></td>
                            </tr>
                            <?
                        }
                        ?>
                        <tr>
                            <td align="left">&nbsp;</td>
                            <td align="center"><strong>���</strong></td>
                            <td align="right"><strong>
                                    <?=number_format($sum_cash_total,2)?>
                                </strong></td>
                            <td align="right" ><strong>
                                    <?=number_format($sum_credit_total,2)?>
                                </strong></td>
                            <td align="right"><strong>
                                    <?=number_format($sum_total,2)?>
                                </strong></td>
                        </tr>
                        </tbody>
                    </table>
        <br>
                    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                        <tr>
                            <td>�����˵� ����ʴ���Ǵ��¡������ʴ�੾����Ǵ��¡�÷���Դ�������·���Դ��鹨�ԧ </td>
                        </tr>

                    </table>
        <br>
                    <table width="100%" border="1" cellspacing="2" cellpadding="0" align="center">
                        <thead>
                        <tr align="center">
                            <th width="5%" rowspan="2"><strong>�ӴѺ</strong></th>
                            <th rowspan="2"><strong><a href="?<?=$getstr?>sortfield=date_list&tripid=<?=$tripid?>&id_type_project=<?=$id_type_project?>">�ѹ���</a></strong></th>
                            <th rowspan="2"><strong>��¡��</strong></th>
                            <th colspan="3"><strong>�ӹǹ�Թ</strong></th>
                            <th rowspan="2"><strong><a href="?<?=$getstr?>sortfield=id_type_project&tripid=<?=$tripid?>&id_type_project=<?=$id_type_project?>">��Ǵ��������</a></strong></th>
                            <th rowspan="2"><strong>Cost ID</strong></th>
                            <th rowspan="2"><strong>TOR ID</strong></th>
                            <th rowspan="2"><strong><a href="?<?=$getstr?>sortfield=complete&tripid=<?=$tripid?>&id_type_project=<?=$id_type_project?>">BILL</a></strong></th>
                        </tr>
                        <tr align="center">
                            <th><strong>�Թʴ</strong></th>
                            <th><strong>�ôԵ</strong></th>
                            <th><strong>���</strong></th>

                        </tr>
                        </thead>
                        <tbody>
                        <?
                        $i=0;
                        $no=0;
                        If ($pri =='100')
                        {
                            If ($sortfield == "")
                            {
                                $str = "select *  from list t1 left join type_project t2 on t1.id_type_project = t2.id_type_project where (t1.tripid = '$tripid') and (t1. id_type_project='$id_type_project')  order by date_list  ";
                            }else
                            {
                                $str = " select *  from list t1 left join type_project t2 on t1.id_type_project = t2.id_type_project where (t1.tripid = '$tripid') and (t1. id_type_project='$id_type_project')  order by t1.$sortfield $sort  ";
                            }
                        }else
                        {
                            If ($sortfield == "")
                            {
                                $str = "select *  from list t1 left join type_project t2 on t1.id_type_project = t2.id_type_project where (t1.tripid = '$tripid') and (t1. id_type_project='$id_type_project') and (t1.userid = '$userid') order by date_list  ";
                            }else
                            {
                                $str = " select *  from list t1 left join type_project t2 on t1.id_type_project = t2.id_type_project where (t1.tripid = '$tripid') and (t1. id_type_project='$id_type_project') and (t1.userid = '$userid') order by t1.$sortfield $sort  ";
                            }
                        }// end if privilage
                        $result = mysql_query($str);
                        while ($rs=mysql_fetch_array($result,MYSQL_ASSOC)){
                            $sum_cash+=$rs[cash_total];
                            $sum_credit+=$rs[credit_total];
                            $i++;
                            $no++;
                            if ($i % 2) {
                                $bg = "#EFEFEF";
                            }else{
                                $bg = "#DDDDDD";
                            }
                            if($rs[attach] != ""){ $attach = "<a href=\"".$rs[attach]."\"  target=\"_blank\"><img src=\"bimg/attach.gif\" border=\"0\"></a>"; } else { $attach = "";}
                            ?>
                            <tr align="center">
                                <td width="5%"><?=$no?></td>
                                <td><?=daythai($rs[date_list])?></td>
                                <td align="left" ><?="&nbsp;".$attach.$rs[detail]?></td>
                                <td align="right" ><?=number_format($rs[cash_total],2)?></td>
                                <td align="right" ><?=number_format($rs[credit_total],2)?></td>
                                <td align="right"><?=number_format($rs[cash_total]+$rs[credit_total],2)?></td>
                                <td>
                                    <?
                                    $res = mysql_query("select * from type_cost");
                                    while ($rss = mysql_fetch_assoc($res)){
                                        if($rs[id_type_cost] == $rss[id_type_cost]){
                                            echo "$rss[type_cost]";
                                        }
                                    }
                                    ?>							  </td>
                                <td align="center"><?php echo $rs['cost_id'];?></td>
                                <td align="center"><?php echo $rs['tor_id'];?></td>
                                <td>
                                    <?
                                    if($rs[complete] =="y"){
                                        echo "<img src=\"bimg/yy.png\" >";
                                    }elseif ($rs[complete] =="n"){
                                        echo  "<img src=\"bimg/alert.gif\" >";
                                    }
                                    ?>							  </td>

                            </tr>
                        <? }

                        if(mysql_num_rows($result)>0){
                            ?>
                            <tr align="center">
                                <td colspan="3"><strong>���</strong></td>
                                <td align="right" ><strong>
                                        <?=number_format($sum_cash,2)?>
                                    </strong></td>
                                <td align="right" ><strong>
                                        <?=number_format($sum_credit,2)?>
                                    </strong></td>
                                <td align="right" ><strong>
                                        <?=number_format($sum_cash+$sum_credit,2)?>
                                    </strong></td>
                                <td colspan="5" ></td>
                            </tr>
                            <?
                        }else{
                            ?>
                            <tr align="center">
                                <td colspan="12"><strong>����բ�����</strong></td>
                            </tr>
                            <?
                        }
                        ?>
                        </tbody>
                    </table>
        <br>                    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                        <tr>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td align="center">.......................................................</td>
                        </tr>
                        <tr>
                            <td align="center" height="25">(<strong>
                                    <?=GetTripOwner($tt)?>
                                </strong>)</td>
                        </tr>
                        <tr>
                            <td align="center" height="25">�ѹ����͡��§ҹ
                                <?=DBThaiLongDate(date("Y-m-d"));?></td>
                        </tr>
                    </table>
    </div>
</center>
</body>

</html>
