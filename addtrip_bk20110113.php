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

if($_GET['view']=="all"){				$_SESSION['view']="all";  $view="all";}
if($_GET['view']=="owner"){		$_SESSION['view']=""; 	$view=""; }
if($_GET['showall']=="y"){			$_SESSION['showall']="y";  $showall="y";}elseif($_GET['showall']==""){			$_SESSION['showall']="";  $showall="";}
if($_GET['nofin']=="Y"||$_GET['cleartrip']=="Y"||$_GET['close']=="Y"||$_GET['endtrip']=="Y"||$_GET['entry']=="Y"){$_SESSION['showall']="";$showall="";}

if ($_SERVER[REQUEST_METHOD] == "POST"){

			If ($tripname ==''){	exit();	}

			 if ($_POST[action]=="edit2"){
			 	
				

				$sql = "update trip set  tripname='$tripname' , note='$note' ,updatetime = now()

				 where tripid ='$tripid' ;";

				mysql_query($sql);
				
										
				if( $getdayA || $getdayB ){
					
					$arr_A = explode("/",$getdayA);
					$getdayA2 = $arr_A[2]."-".$arr_A[1]."-".$arr_A[0];
					$arr_B = explode("/",$getdayB);
					$getdayB2 = $arr_B[2]."-".$arr_B[1]."-".$arr_B[0];
					
					//echo "<pre>"; print_r($_POST); echo "</pre>";
					
					if($trip_advance == "ON" || !$schedule_id ){
						
						$no_ref = $no_ref+1;
						
						$sql = "INSERT INTO `trip_schedule` 
									(`schedule_id`,`trip_id`,`start_date`,`end_date`,`no_ref`,`comment`,`timestamp`) 
									VALUES 
									(NULL,'$tripid','$getdayA2','$getdayB2','$no_ref','$comment',NOW())
								  ";	
						$result  = mysql_query($sql);
						
					}else{
						
						$sql = "UPDATE `trip_schedule` SET
									`start_date` = '$getdayA2',
									`end_date` = '$getdayB2'
									WHERE schedule_id = '$schedule_id'
								  ";	
						$result  = mysql_query($sql);
						
					}
				}

	  			echo "<script language='javascript'>alert('��ӡ�û�Ѻ��اTrip����!');</script>" ;
				
	  			echo "<meta http-equiv='refresh' content='0;url=addtrip.php'>" ;
					  
				die;

				if (mysql_errno())

				{

					$msg = "Cannot update parameter information.";

				}

				else

				{

					header("Location: ?id=$id&action=edit&refreshpage=1");

					exit;

				}
					  
			}else if($_POST[action]=="add"){

				    $sql = "INSERT INTO  trip (tripid,tripname,note,userid,updatetime)	VALUES ('$tripid','$tripname','$note','$_SESSION[userid]',now())";

					$result  = mysql_query($sql);
					
										
					if( $getdayA || $getdayB ){
						
						$arr_A = explode("/",$getdayA);
						$getdayA2 = $arr_A[2]."-".$arr_A[1]."-".$arr_A[0];
						$arr_B = explode("/",$getdayB);
						$getdayB2 = $arr_B[2]."-".$arr_B[1]."-".$arr_B[0];
						
						$sql = "INSERT INTO `trip_schedule` 
									(`schedule_id`,`trip_id`,`start_date`,`end_date`,`no_ref`,`comment`,`timestamp`) 
									VALUES 
									(NULL,'$tripid','$getdayA2','$getdayB2','1','$comment',NOW())
								  ";	
						$result  = mysql_query($sql);
					}
					
					if($result){

			  			echo "<script language='javascript'>alert('��ӡ�úѹ�֡Trip����!');</script>" ;

			  			echo "<meta http-equiv='refresh' content='0;url=addtrip.php'>" ;

						exit;

					}else{	echo "�������ö�ѹ�֡�������� ";}

				}

}else if ($_GET[action] == 'delete'){

		$sqlc = "select * from list where tripid = '$tripid'";

		$resultc = mysql_query($sqlc);

		$rsc = mysql_num_rows($resultc);

		 if($rsc == "0")

		{

		mysql_query("delete from trip where tripid = $tripid ");

		if (mysql_errno())

			{

			$msg = "Cannot delete parameter.";

			}else

			{

			header("Location: addtrip.php"); //header("Location: ?runid=$runid&action=edit&refreshpage=1");

			exit;

			}

		}else

		{

			$msg = "<b class='blue'>Complete</b><br>�������öź�����������ͧ�ҡ�բ��������� Trip ���";

	echo $msg;

	include("msg_box.php");

	header("Location: addtrip.php");

		}

	

}elseif($_GET['action']=='edit2'){		

	 	$sql = "select * from  trip   ;";

		$result = mysql_query($sql);

		if ($result){

		$rs=mysql_fetch_array($result,MYSQL_ASSOC);

		} else {

		$msg = "Cannot find parameter information.";

		echo $msg;

		}

}

		?>

<html>

<head>

<title>��§ҹ��������㹡���͡��Ժѵԧҹ</title>

<meta http-equiv="Content-Type" content="text/html; charset=tis-620">

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
<script language="javascript">
function popWindow(url, w, h){

	var popup		= "Popup"; 
	if(w == "") 	w = 420;
	if(h == "") 	h = 300;
	var newwin 	= window.open(url, popup,'location=0,status=no,scrollbars=no,resizable=no,width=' + w + ',height=' + h + ',top=20');
	newwin.focus();

}
</script>


<SCRIPT LANGUAGE="JavaScript">

<!--

	function ch1(){

		var f1=document.form1;

		if (!f1.tripname.value){

		alert("��س��кت���Trip");

			return false;

		}else if ( f1.getdayA.value == "" || f1.getdayB.value == "" ){

		alert("��س��кت��ͪ�ǧ�ѹ�Թ�ҧ");

			return false;

		}

	}


	function show_time(x){
		var xno=document.getElementById('no_ref').value
		var xdiv=document.getElementById(x).style.display;
		var xform=document.getElementById('trip_advance').checked;
		if(xno>0){
			if( xform == true ) {	
				document.getElementById(x).style.display = "block";
			}else{
				document.getElementById(x).style.display = "none";	
			}
		}
	}

//-->

</SCRIPT>
<script language="javascript"  src="libary/popcalendar.js"></script>
<link href="css/redmon_theme/redmon.custom.css" rel="stylesheet" type="text/css">
</head>



<body >

<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">

  <tr>

    <td valign="top" style="background-repeat: no-repeat; background-position:right bottom "><table width="100%" border="0" cellpadding="0" cellspacing="0">

      <tr>

        <td valign="top" bgcolor="#D3D3D3" >
		
		<?
	include("header_cost.php"); // ��������
		?>

		<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#2C2C9E">
          <tr>
            <td height="30" colspan="2"><B class="pheader">&nbsp;��¡�� Trip ���ʡ���Թ�ҧ </B></td>

          </tr>

        </table>
		
<!--		<?
		if ($pri =='100'){

		?>

          <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#D3D3D3">

            <tr>

              <td width="0%">&nbsp;</td>

              <td width="23%" height="24" class="caption">&nbsp;</td>

              <td width="21%" class="caption">&nbsp;</td>

              <td width="27%" class="caption">&nbsp;</td>

              <td width="13%" align="center" class="caption">&nbsp;</td>

              <td width="16%" class="caption"><img src="bimg/report.gif" width="16" height="16"></td>

            </tr>

          </table>

		  <?

		  }

		  ?>-->


            <table width="100%" border="0" align="center" cellpadding="1" cellspacing="2" bgcolor="#FFFFFF">



              <tr>

                <td width="10%" align="right" bgcolor="#2A007C"><strong class="style4">Staff Name: </strong></td>

                <td bgcolor="#CCCCCC"><strong>

				&nbsp;

				<?=GetTripOwner($tripid)?>

                  <?=$_SESSION[name]?>

                  &nbsp;&nbsp;

                  <?=$_SESSION[surname]?>

				  <?=($_SESSION['avatar_mode'] == "on")?"<img src=\"images/16x16/video_camera.png\" width=\"16\" height=\"16\" ALT=\"AVATAR MODE\" TITLE=\"AVATAR MODE\">":""?>
				  
                </strong>
                
				<? $user_id = $_SESSION[userid_origin] ? $_SESSION[userid_origin] : $_SESSION[userid]?>
                
    			<a href="<?=($pri =='100')?"list_user.php":"add_user.php?action=edit&id=$user_id"?>" target="_blank"><img src="images/16x16/toolbox.png" width="16" height="16" border="0" alt="<?=($pri =='100')?"��Ѻ��ا ��ª��� User":"��Ѻ��ا User "?>"></a>
                <?
                if($pri =='100'){
				?>
    			<a href="alert_report.php" target="_blank"><img src="images/16x16/sms.png" width="16" height="16" border="0" alt="��ª��ͼ��Դ��Ի���"></a>
    			<? }?>
                </td>

              </tr>

            </table>

              <? if ($pri =='100' || $pri =='50'){?>
            <table width="100%" border="0" align="center" cellpadding="1" cellspacing="1">
<!--            <tr><td align="right"><a href="list_user.php"><img src="images/16x16/monitor.png" width="16" height="16" border="0"><strong>usermanager</strong></a></td></tr>-->
            </table>  
            <table width="100%" border="0" align="center" cellpadding="1" cellspacing="1">
              <tr>
                <td  align="left" style="background-color:#FFFFFF; display:<?=$pri =='100'?"":"none"?>; "><nobr><a href="addtrip.php<?=$view != "all" ? "?view=all" : "?view=owner"?>"><img src="images/16x16/monitor.png" width="16" height="16" border="0">��§ҹ<?=$view != "all" ? "�������ء��" : "��ǹ�ؤ��"?></a></td>
                <td  align="left" style="background-color:#FFFFFF"><nobr><a href="listallproject.php"><img src="images/16x16/monitor.png" width="16" height="16" border="0">��§ҹ��ṡ�ç��÷�����</a></td>
                <td  align="left" style="background-color:#FFFFFF"><nobr><a href="listalltypecost.php"><img src="images/16x16/monitor.png" width="16" height="16" border="0">��§ҹ��Ǵ��������</a></td>
                <td  align="left" style="background-color:#FFFFFF"><nobr><a href="report_staff.php" target="_blank"><img src="images/16x16/monitor.png" width="16" height="16" border="0">��§ҹ��Ǵ�������µ����ǧ����</a></td>
                <td  align="left" style="background-color:#FFFFFF"><nobr><a href="listprojectyear.php"><img src="images/16x16/monitor.png" width="16" height="16" border="0">��§ҹ��ػ����Թ�ҧ</a></td>
                <td  align="left" style="background-color:#FFFFFF; display:<?=$pri =='100'?"":"none"?>;"><nobr><a href="addtype_project.php"><img src="images/16x16/monitor.png" width="16" height="16" border="0">�����ç���</a></td>
                <td  align="left" style="background-color:#FFFFFF; display:<?=$pri =='100'?"":"none"?>;"><nobr><a href="setproject.php"><img src="images/16x16/monitor.png" width="16" height="16" border="0">��Ѻ�ç��÷�����</a><a href="listallproject.php"></a></td>
              </tr>
            </table>
              <? }
			   if (!$_GET[action]){
			  ?>
			  			
            <table width="100%" border="0" align="center" cellpadding="0" cellspacing="5" bgcolor="#FFFFFF">
              <tr>  
                <td align="center" class="sample">
				<!------------------------------------------------------------------>				
				<table width="90%" border="0" cellspacing="0" cellpadding="0" class="sample">
				  <tr>
					<td>

				<table width="95%" border="0" align="center" cellpadding="1" cellspacing="5">
                  <tr>
                    <td colspan="2" align="left" class="style4">&nbsp;&nbsp;��Ǵ��¡�ä�������</td>
                    </tr>
                  <tr>
                    <td width="5%" align="center"><img src="images/webcam.png" title="�ʴ�������" width="24" height="24"></td>
                    <td width="45%" style="background-color:#FFFFFF"><nobr>&nbsp;<a href="?showall=y&year_r=<?=$year_r?>&view=<?=$view?>">�ʴ�������<?=$view != "all" ? "�ͧ $_SESSION[name] $_SESSION[surname]" : "�ͧ�ء����к�"?></a>&nbsp;</td>
                    </tr>
                  <tr>
                    <td align="center"><img src="images/pie_chart2.png" title="੾�з���ѧ���Թ���" width="24" height="24"></td>
                    <td style="background-color:#FFFFFF"><nobr>&nbsp;<a href="?nonfin=y&showall=&year_r=<?=$year_r?>&view=<?=$view?>">੾�з���ѧ���Թ���</a>&nbsp;</td>
                    </tr>
                  <tr>
                    <td align="center"><img src="images/promo_violet.png" title="��ػ���������������" width="24" height="24"></td>
                    <td style="background-color:#FFFFFF"><nobr>&nbsp;<a href="?cleartrip=y&showall=&year_r=<?=$year_r?>&view=<?=$view?>">��ػ���������������</a>&nbsp;</td>
                    </tr>
                  <tr>
                    <td align="center"><img src="images/promo_green.png" title="��ҹ��õ�Ǩ�Ѻ�͡����͡��͹��ѵ�" width="24" height="24"></td>
                    <td style="background-color:#FFFFFF"><nobr>&nbsp;<a href="?close=y&showall=&year_r=<?=$year_r?>&view=<?=$view?>">��ҹ��õ�Ǩ�Ѻ�͡��� �͡��͹��ѵ�</a>&nbsp;</td>
                    </tr>
                  <tr>
                    <td align="center"><img src="images/promo_orange.png" title="�ѹ�֡��¡�ä��������������" width="24" height="24"></td>
                    <td style="background-color:#FFFFFF"><nobr>&nbsp;<a href="?endtrip=y&showall=&year_r=<?=$year_r?>&view=<?=$view?>">�ѹ�֡��¡�ä��������������</a>&nbsp;</td>
                    </tr>
                  <tr>
                    <td align="center"><img src="images/promo_red.png" title="����������ҧ��û�͹��¡��" width="24" height="24"></td>
                    <td style="background-color:#FFFFFF"><nobr>&nbsp;<a href="?entry=y&showall=&year_r=<?=$year_r?>&view=<?=$view?>">����������ҧ��û�͹��¡��</a>&nbsp;</td>
                    </tr>
                </table>
				
				</td>
				  </tr>
				</table>
				<!------------------------------------------------------------------>				
				</td>
              </tr>
            </table>

            <?
			// �һ� 					

						$previous_url = " <div align=right> &nbsp;     ";   

						$next_url = " <div align=left>&nbsp;   ";

						

						$sql_yy = "  select min(substring(tripid,1,4)) as minYY,max(substring(tripid,1,4)) as maxYY  from trip  " ; 

						$query_result = mysql_query($sql_yy);

						$result_yy = mysql_fetch_assoc($query_result) ;	

						

						$maxYY1 = $result_yy[maxYY]  ;   $minYY1 = $result_yy[minYY]  ;

						if ($year_r == "" ) {	$year_r =  $maxYY1 ;   }											

						if ($maxYY1 > $year_r ){

								$next_year =$year_r + 1 ;  		$previous_year = $year_r  - 1 ; 		

								$next_url = "<a href='?showall=y&year_r=".$next_year."'><img src=\"images/next.png\" border=\"0\"></a> ";  

						}

						if ($minYY1 < $year_r ){

								$previous_year = $year_r - 1 ; 		$next_year =$year_r + 1 ; 			

								$previous_url = "<a href='?showall=y&year_r=" . $previous_year ."&view=$view'><img src=\"images/back.png\" border=\"0\"></a> ";  

						}

						

					//====================================================================================

//===================================================================== 

?>

            <table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0">

              <tr>

                <td width="16%" align="left" valign="top">
                
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td>&nbsp;<?=$previous_url?></td>
                    <td><strong>�.�.<?=$year_r?></strong></td>
                    <td><?=$next_url?>&nbsp;</td>
                  </tr>
                </table></td>
                <td width="68%" align="center">&nbsp;</td>

                <td width="16%" align="right"><a href="?action=add"><img src="images/add.png" width="24" height="24" border="0">������¡�� Trip</a>&nbsp;&nbsp;</td>

              </tr>

            </table>
			<div>
            <table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" bgcolor="#666666">

              <tr bgcolor="#A3B2CC">

                <td width="4%" height="25" align="center" bgcolor="#2A007C" class="style4"><b>�ӴѺ</b></td>

                <td width="4%" height="25" align="center" bgcolor="#2A007C" class="style4">&nbsp;</td>

                <td width="9%" height="25" align="center" bgcolor="#2A007C" class="style4"><strong>����Trip</strong></td>

                <td width="30%" height="25" align="center" bgcolor="#2A007C" class="style4"><strong>����Trip</strong></td>

                <?

			if($pri =='100'){
			echo "<td align=\"center\" height=\"25\" align=\"center\" bgcolor=\"#2A007C\" class=\"style4\"><strong>����Staff</strong></td>";
			}
			?>
                <td width="33%" height="25" align="center" bgcolor="#2A007C" class="style4"><strong>�����˵�</strong></td>
			<?
			if($pri =='100'){
			echo "<td align=\"center\" height=\"25\" align=\"center\" bgcolor=\"#2A007C\" class=\"style4\"><nobr>&nbsp;����¡��&nbsp;</nobr>͹��ѵ�</td>";
			echo "<td align=\"center\" height=\"25\" align=\"center\" bgcolor=\"#2A007C\" class=\"style4\">�͡��§ҹ GL</td>";
			}
			?>

                <td width="12%" height="25" align="center" bgcolor="#2A007C" class="style4"><strong>����ͧ���</strong></td>
				<? if($pri == "100"){?>
                <td width="8%" align="center" bgcolor="#2A007C" class="style4"><strong>��ҧʶҹ�</strong></td>
				<? } ?>
              </tr>

       <?php

		$i = 0;
		$no=0;
		$max=0;
		if($close=="y"){
			$cond = " AND trip.trip_status = '3' ";
		}else if($endtrip=="y"){
			$cond = " AND trip.trip_status = '2' ";
		}else if($cleartrip=="y"){
			$cond = " AND trip.trip_status = '4' ";
		}else  if($entry=="y"){
			$cond = " AND trip.trip_status = '1' ";
		}else  if($showall=="y"){
			//$cond = " AND trip.trip_status <= '4' ";
		}else  if($nonfin=="y"){	
			$cond = " AND trip.trip_status < '4' ";
		}else{ // �ó� DEFAULF ��� �ѧ���������� 
			$cond = " AND trip.trip_status < '4' ";		
		}

		$inner_code=$inner_code?$inner_code:""; // Inner JOIN list  ON  trip.tripid =  list.tripid   ������ ��ա����§ ����� LEFT ����
		if($pri == '100' && $view == "all"){	
		$str1 = "
			select trip.tripid,trip.tripname,trip.note  ,trip.trip_status
			from   trip $inner_code 
			where substring(trip.tripid,1,4) = '$year_r'  
			$cond 
			group by trip.tripid order by trip.tripid ;
			";
		//echo $str1 ;
			$result = mysql_query($str1);
		}else{
		$str1 = "		
			select  trip.tripid,trip.tripname,trip.note ,trip.trip_status
				from   trip $inner_code  
				where (trip.userid = '$_SESSION[userid]') 
				and substring(trip.tripid,1,4) = '$year_r'   
				$cond  
				group by  trip.tripid order by  trip.tripid ;
			";	
			$result = mysql_query($str1);				
		}
		//echo "$str1";
		if($debug=="ON"){ echo "<pre> XD : ".$str1." <hr> $close . $endtrip . $cleartrip . $entry . $showall . $nonfin :</pre>"; }
		while ($rs=mysql_fetch_array($result,MYSQL_ASSOC)){		
		
			$str1 = "
			select  t2.userid,t2.name,t2.surname,t1.close  
			from  trip t1 LEFT join cos_user t2 on  t1.userid = t2.userid 
			where t1.tripid = '$rs[tripid]' 
			";
			$resx = mysql_query($str1);
			$rsx = mysql_fetch_assoc($resx);
			$i++;
			$no++;

			if ($rs[tripid] > $max) $max=$rs[tripid];
			if ($i % 2) {
				$bg="#FFFFFF";
			}else{
				$bg="#F0F0F0";
			}

			//echo "<pre>";	print_r($rs);	echo "</pre>";
		?>
              <tr bgcolor="<?=$bg?>">
                <td height="25" align="center"><?=$no?></td>
				<td height="25" align="center">
				<?
//				$trip = 0;
//				$closed = $ended = $cleared = true;
//				$sqlcheck = "select * from list  where tripid='$rs[tripid]' ; ";
//				$resultcheck = mysql_query($sqlcheck);
//				$resultnum = mysql_num_rows($resultcheck);
//				while ($rscheck=mysql_fetch_array($resultcheck,MYSQL_ASSOC)) {
//					if ($rscheck["close"] != "y" && $rs["close"] != "y" )  $closed = false;
//					if ($rscheck["endtrip"] != "y")  $ended = false;
//					if ($rscheck["cleartrip"] != "y")  $cleared = false;
//				}
//				
//				if ($resultnum == "0" && $rs["close"] != "y" ){
//					echo "<img src=\"images/promo_red.png\" alt=\"����������ҧ��û�͹��¡��\" width=\"24\" height=\"24\">";
//				}else{
//					if ($closed){
//						echo "<img src=\"images/promo_violet.png\" alt=\"��ػ���������������\" width=\"24\" height=\"24\">";
//					}else if ($cleared){
//						echo "<img src=\"images/promo_green.png\" alt=\"��ҹ��õ�Ǩ�Ѻ�͡����͡��͹��ѵ�\" width=\"24\" height=\"24\">";
//					}else if ($ended){
//						echo "<img src=\"images/promo_orange.png\" alt=\"�ѹ�֡��¡�ä��������������\" width=\"24\" height=\"24\">";
//					}else{
//						echo "<img src=\"images/promo_red.png\" alt=\"����������ҧ��û�͹��¡��\" width=\"24\" height=\"24\">";
//					}
//				}

				if ($rs["trip_status"] == "1" ){
						echo "<img src=\"images/promo_red.png\" alt=\"����������ҧ��û�͹��¡��\" width=\"24\" height=\"24\">";
				}else if ($rs["trip_status"] == "4" ){
						echo "<img src=\"images/promo_violet.png\" alt=\"��ػ���������������\" width=\"24\" height=\"24\">";
				}else if ($rs["trip_status"] == "3" ){
						echo "<img src=\"images/promo_green.png\" alt=\"��ҹ��õ�Ǩ�Ѻ�͡����͡��͹��ѵ�\" width=\"24\" height=\"24\">";
				}else if ($rs["trip_status"] == "2" ){
						echo "<img src=\"images/promo_orange.png\" alt=\"�ѹ�֡��¡�ä��������������\" width=\"24\" height=\"24\">";
				}else{
						echo "<img src=\"images/promo_red.png\" alt=\"����������ҧ��û�͹��¡��\" width=\"24\" height=\"24\">";
				}
				?>
				</td>
				<?

				/*

				If ($pri=="100")

				{

				echo  "

                <td align=\"left\"><a href=\"list.php?tripid=<?=$rs[tripid]?>&sname=<?=$rsx[name]?>&ssurname=<?=$rsx[surname]?>\"><?=$rs[tripid]?></a></td>  " ;

				}else

				{

				echo "<td align=\"left\"><a href=\"list.php?tripid=<?=$rs[tripid]?>\"><?=$rs[tripid]?></a></td>  " ; 

				}

				*/

				

				?>

			<td height="25" align="left"><a href="list.php?tripid=<?=$rs[tripid]?>&sname=<?=$rsx[name]?>&ssurname=<?=$rsx[surname]?>"><?=$rs[tripid]?></a></td>   
                <td height="25" align="left"><?=$rs[tripname]?>                </td>
					<?
				// echo Staff name
			if($pri =='100'){
			$resx = mysql_query("select  t2.userid,t2.name,t2.surname  from  trip t1 left join cos_user t2 on  t1.userid = t2.userid where t1.tripid = '$rs[tripid]' ");
			$rsx = mysql_fetch_assoc($resx);
		//	$_SESSION[userid] = $rsx[userid] ;
			echo "<td  align=\"center\">$rsx[name] &nbsp; &nbsp; $rsx[surname] </td>";
			}
			?>
            <td height="25"><?=$rs[note]?></td>
			<?
			if($pri =='100'){
			echo "<td align=\"center\"><strong><a href=\"closetrip.php?tripid=$rs[tripid]\">Approve</a></strong></td>";
			echo "<td align=\"center\"><strong><a href=\"account/listprojectgl.php?tripid=$rs[tripid]\" target=\"_blank\">Click</a></strong></td>";
			}
			?>
                <td height="25"  align="center"><nobr><p><a href="trip_detail.php?tripid=<?=$rs[tripid]?>"><img src="images/16x16/id_card.png" width="16" height="16" border="0" alt="��§ҹ����Թ�ҧ�����͡��Ժѵ�˹�ҷ��㹵�ҧ�ѧ��Ѵ"></a>&nbsp;&nbsp;<a href="?tripid=<?=$rs[tripid]?>&action=edit2"><img src="images/16x16/tools.png" width="16" height="16" border="0" alt="Edit"></a> &nbsp;<a href="upload.php?tripid=<?=$rs[tripid]?>"><img src="images/16x16/attachment.png" alt="�Ѵ������Ṻ" width="16" height="16" border="0"></a>
				<?
				$sqlcheck = "
				select tripid from list  where tripid='$rs[tripid]'
				UNION 
				select tripid from tripvalue where tripid = '$rs[tripid]'
				";
				$resultcheck1 = mysql_query($sqlcheck);
				$resultnum1 = @mysql_num_rows($resultcheck1);				
				
				//if($debug=="ON"){echo "<pre> ".intval($resultnum1)." : "; print_r($sqlcheck); echo "</pre>"; }
				
				if( intval($resultnum1) == '0' && $pri== "100"){
				?>
				<a href="#" onClick="if (confirm('�س�зӡ��ź��������ǹ�����������!!')) location.href='?action=delete&tripid=<?=$rs[tripid]?>';" >
				<img src="images/16x16/delete.png" width="16" height="16" border="0" alt="Delete"></a>
				<? } ?>
				</td>
				<? if($pri == "100"){ ?>
                <td  align="center"><? 
				$sql_uncheck = "
						select tripid  from list  where tripid='$rs[tripid]' and (close='y' or endtrip ='y' or cleartrip = 'y')
						UNION
						select tripid  from tripvalue  where tripid='$rs[tripid]' and (close='y' or endtrip ='y' or cleartrip = 'y')
						"; 
				//echo "<pre>$sql_uncheck </pre>";
					
				$result_unc = mysql_query($sql_uncheck);  
				$num_unc = mysql_num_rows($result_unc);
				if($num_unc > 0 ){?><img src="images/16x16/lock.png" width="16" height="16" border="0" alt="��ҧ���ʶҹ�" style="cursor:pointer" onClick="if(confirm('��ͧ��ûŴ��͡��ԧ�������')==true){popWindow('clear_status.php?tripid=<?=$rs[tripid]?>&action=clear_value','450','200'); }"><? }?></td>
				<? } ?>
              </tr>
              <?
		}
		?>
            </table>

            
            </div>
            <br>
            <p>

              <?

}


if ($_GET[action]=="edit2"){

		$sql = "select * from trip where tripid='$tripid'  ;";

		$result = mysql_query($sql);

		if ($result)

		{

		$rs=mysql_fetch_array($result,MYSQL_ASSOC);

		}





}

?>

            </p>

			<? if ($_GET[action]){ ?>

            <form  name="form1" method = POST  action = "<?  echo $PHP_SELF ; ?>" onSubmit="return ch1();">

              <INPUT TYPE="hidden" NAME="action" VALUE="<?=$_GET[action]?>">

              <a name="adddata" id="adddata"></a>

              
			  
			  
			  <table width="100%" border="0" cellspacing="1" cellpadding="2" align="center">

                <tr>

                  <td colspan=3 align="left" valign="top" bgcolor="#888888"><B class="gcaption">

                    <?=($rs[tripid]!=0?"���":"����")?>

                    Trip</B></td>

                </tr>

                <tr>

                  <td align="right" valign="middle"><strong>����Trip</strong></td>

                  <td align="left" valign="top">

				  <?

					 if ($_GET[action]=="edit2"){

				  	  echo  $rs[tripid] ;

					 }else{

					 $sqlid =  "select tripid  from trip ";

					 $resultid  = mysql_query($sqlid);

					 $rsid = mysql_num_rows($resultid);

					 while ($rsid = mysql_fetch_assoc($resultid)){	

				 		$id = substr($rsid[tripid],6);

					}

					 $id = intval($id) + 1;

				$year = date("Y")+543;

				$yearid  = $year.date("m");

				$tripid = sprintf("%s%04d",$yearid,$id);

				echo  $tripid;
				

				}

				  

				  ?>

				  <INPUT NAME="tripid" TYPE="hidden" id="tripid" VALUE="<?=$tripid?>"></td>

                </tr>



                <tr>

                  <td align="right" valign="middle" width="20%"><strong>����Trip</strong></td>

                  <td align="left" valign="top" width="60%"><input name="tripname" type="text" class="input_text" id="tripname" value="<?=$rs[tripname]?>" size="50">                  </td>

                </tr>

                <tr>

                  <td align="right" valign="top"><strong>�����˵�</strong></td>

                  <td align="left" valign="top"><textarea name="note" cols="70" rows="5" class="input_text" id="note"><?=$rs[note]?></textarea></td>

                </tr>

                <tr>
                  <td align="right" valign="top"><strong>��ǧ����</strong></td>
                  <td align="left" valign="top">
				    <?
					  $strSQL =" SELECT * FROM `trip_schedule` WHERE (`trip_id`='$tripid') order by no_ref asc  ";
					 $resultid_time  = mysql_query($strSQL);
					 while ($rs_time = mysql_fetch_assoc($resultid_time)){	
						$timeA[]=$rs_time[start_date];
						$timeB[]=$rs_time[end_date];
						
						$arrA=explode("-",$rs_time[start_date]);
						$getdayA=$arrA[2]."/".$arrA[1]."/".$arrA[0];						
						$arrB=explode("-",$rs_time[end_date]);
						$getdayB=$arrB[2]."/".$arrB[1]."/".$arrB[0];
						
						$schedule_id = $rs_time[schedule_id];
						$no_ref =  $rs_time[no_ref];
						$time_ref =  $rs_time[timestamp];
					 }			
					 if(@mysql_num_rows($resultid_time)>1){
						 $strSQL =" SELECT * FROM `trip_schedule` WHERE (`trip_id`='$tripid') AND schedule_id <> $schedule_id  order by no_ref asc  ";
						 $resultid_time  = mysql_query($strSQL);
						 while ($rs_time = mysql_fetch_assoc($resultid_time)){	
							echo "<div><strong>���駷�� $rs_time[no_ref]</strong> ������ѹ��� ".swapdatedat($rs_time[start_date])."  �֧ ".swapdatedat($rs_time[end_date])." &nbsp;&nbsp;&nbsp;&nbsp; �ѹ�֡��������� $rs_time[timestamp]</div>"; 
						 }
						 echo "<strong><i>��������ش</i></storng>";
					 }else{
						 if(@mysql_num_rows($resultid_time)==0){
							$add_news = "true";		 
						 }
					 }
					 
					 if(@mysql_num_rows($resultid_time)>0){
						echo "<div id='late_date' style='display:none'><strong>���駷�� $no_ref</strong> ������ѹ��� $getdayA  �֧ $getdayB &nbsp;&nbsp;&nbsp;&nbsp; �ѹ�֡��������� $time_ref</div>"; 	 
					 }					 
                      ?>

                  	  <input type="text" name="getdayA" id="getdayA" readonly="readonly" value="<?=$getdayA?>">
                  	  <input type='button' onClick="popUpCalendar(this, form1.getdayA, 'dd/mm/yyyy')" value=' ���͡�ѹ ' class='input'>
                   		�֧
                      <input type="text" name="getdayB" id="getdayB" readonly="readonly" value="<?=$getdayB?>">
               	    <input type='button' onClick="popUpCalendar(this, form1.getdayB, 'dd/mm/yyyy')" value=' ���͡�ѹ ' class='input'>
					  <? if ($_GET[action]=="edit2"){ ?>
                      <br />
                  	  <INPUT NAME="schedule_id" TYPE="hidden" id="schedule_id" VALUE="<?=$schedule_id?>">
                      <INPUT NAME="no_ref" TYPE="hidden" id="no_ref" VALUE="<?=$no_ref?>">
                      <input name="trip_advance" id="trip_advance" type="checkbox" value="ON" <?=$add_news=="true"?"checked":""?> onClick="show_time('late_date')"/> �к��繪�ǧ���ҵ�����ͧ�����������
                      <? } ?>
                      </td>
                </tr>
                <tr>

                  <td align="right" valign="top" width="20%">&nbsp;</td>

                  <td align="left" valign="top" width="60%"><input type="submit" name="Submit" value=" �ѹ�֡ ">

                      <input type="reset" name="Submit2" value="Reset">

                      <input type="reset" name="Submit3" value="¡��ԡ" ONCLICK="<? if ($_GET[action] == "edit2") echo "location.href='?';"; else echo "window.close();"; ?>">
                    
                    </td>

                </tr>

              </table>

          </form>          
		  
		  <? }?>
		  
		  </td>

      </tr>

    </table></td>

  </tr>

</table>

</body>

</html>
<? if($debug == "ON"){ echo "<pre>"; print_r($_SESSION); echo "</pre>"; }?>
