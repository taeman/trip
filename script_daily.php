<?php
set_time_limit(0);

$non_session = "ON";
$Report_Now = "ON";  // OFF = ��������  ON = ���¡����§ҹ���
$Fix_Hour = "ON";		  // OFF = ���ʹ�����  ON = ʹ�����
$Debug_Mode = "OFF";  // OFF = �Դ�͹�������  ON = �Դ�͹�������

$Mail_Online = "ON";
$TEL_Online = "ON";

$debug_Mail = "pudis@sapphire.co.th" ;
$debug_Tel = "0861860538" ;

#��˹�����
$crontab = "9" ;
$time_diff = 3 ; //��͹

//include ("checklogin.php");
include ("phpconfig.php");
include ("alert_function.php");
include ("sms_function.php");
Conn2DB();

	if(!function_exists('getmicrotime')){
		function getmicrotime(){
		list($usec, $sec) = explode(" ",microtime());
		return ((float)$usec + (float)$sec);
		}
	}

	echo "".date("Y-M-d H:i:s")."  [Crantab Time : $crontab  ]<br>";



### ��ҹ��Իᴧ

	$nowdate = date("Y-m-d");
	$strSQL=" 
		SELECT tripid , MIN(start_date) as start_date , MAX(end_date) as end_date
		FROM trip 
		Inner Join trip_schedule ON trip.tripid = trip_schedule.trip_id
		WHERE 
			`trip_status` LIKE '1'
		AND start_date != '0000-00-00'
		AND end_date  != '0000-00-00'
		/*AND end_date < '$nowdate'*/
		AND `updatetime` > DATE_SUB(NOW(),INTERVAL $time_diff MONTH)
		GROUP by trip.tripid
	";
	if( $debug == "ON" ){ echo "<pre>$strSQL</pre>"; }
	$Result = mysql_query($strSQL);
	
	
		while($Row_trip = mysql_fetch_assoc($Result)){
			//echo "<pre>";	print_r($Row_trip);	echo "</pre>";		
			$strSQL=" 
				SELECT trip_id , MIN(start_date) as start_date , MAX(end_date) as end_date
				FROM trip_schedule 
				WHERE 
					   start_date != '0000-00-00'
				AND end_date  != '0000-00-00'
				AND trip_id = '$Row_trip[tripid]'
				GROUP BY  trip_schedule.trip_id
			";
			//echo "<pre>$strSQL</pre>";
			$Result_schedule = mysql_query($strSQL);
			if(@mysql_num_rows($Result_schedule)>0){
				$mindate = $maxdate = "";
				while($Row_schedule = mysql_fetch_assoc($Result_schedule)){
					$mindate  = $Row_schedule[date_start] < $mindate ? $Row_schedule[date_start] : $mindate;
					$maxdate = $Row_schedule[end_date]  > $maxdate ? $Row_schedule[end_date]  : $maxdate;
				}
				
				
				### �ӹǳ��Ի���
				if(trip_diffdate($maxdate,$nowdate)>0 && $maxdate<$nowdate){
					//echo $Row_trip[tripid]." :: ".$maxdate."-".$nowdate."=".trip_diffdate($maxdate,$nowdate)."<br>";
					$Array_MaxTrip[$Row_trip[tripid]] 	= $maxdate;		
					$Array_LateTrip[$Row_trip[tripid]] = trip_diffdate($maxdate,$nowdate);					
					$Array_AlertMail[$Row_trip[tripid]] = trip_diffdate($maxdate,$nowdate);
					
					if(trip_diffdate($maxdate,$nowdate)>2){
						$Array_AlertSMS[$Row_trip[tripid]] = trip_diffdate($maxdate,$nowdate);
					}
				}
			}
		}
		echo "<pre>"; echo " ��͹���� E-mail <br>"; print_r($Array_AlertMail); echo " ��͹����  SMS<br>";print_r($Array_AlertSMS);  echo "</pre>";
		
		echo "<br><h3> ��¡�÷���� MAIL �� </h3>";
		
		### ������	
		if(@count($Array_AlertMail)>0 && $Mail_Online != "OFF"){
			foreach( $Array_AlertMail as $key => $val ){				
				$Array_Nfo[$key]=call_owner_trip($key);
				//echo "<pre>"; print_r($Array_Nfo[$key]); echo "</pre>";				
				$user_name = $Array_Nfo[$key][name] . " ".$Array_Nfo[$key][surname] ;
				$user_shortname = $Array_Nfo[$key][name] ;
				$tripname = $Array_Nfo[$key][tripname];
				$UserEmail = "";
				$UserTel = "";
				
				if($Array_Nfo[$key][epm_id]>0){
					$strSQL = " select * from epm.epm_staff where staffid = '".$Array_Nfo[$key][epm_id]."' limit 1";	
					$Result_epm = mysql_query($strSQL);
					$Row_epm = mysql_fetch_assoc($Result_epm);
					$UserEmail = $Row_epm['email'];
				}
				
				###############################################
				echo $Array_Nfo[$key][epm_id].". ".$Array_Nfo[$key][name]." [".$UserEmail."] �Դ��Ի��� [".$key."] : ". $Array_LateTrip[$key] ." �ѹ<br>";
				if( $debug == "ON" ){ echo "<pre>";  echo "</pre>";}
				if($UserEmail){
					
					$strSQL = " SELECT max(no_alert) as no_alert FROM `alert_list` WHERE `trip_id` = '$key' AND alert_way = 'mail' group by trip_id ";
					$Result_no = mysql_query($strSQL);
					if(@mysql_num_rows($Result_no)>0){
						$arr_no = mysql_fetch_assoc($Result_no);
						$no = $arr_no['no_alert']+1 ;
					}else{
						$no = 1 ; 	
					}
					
					###############################################
					$msgtext	= "";
					$msgtext	.= "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
					$msgtext	.= "<tr><td> <strong>����������硷�͹ԡ�� �ҡ�к��ѹ�֡���������͡��鹷�� [$key]</strong></td></tr>";
					$msgtext	.= "<tr><td> <strong>����ͧ</strong> �Դ������Դ��úѹ�֡���������͡��鹷�� ��ҧ�ԧ ��Ի $tripname ���駷�� $no</td></tr>  ";
					$msgtext	.= "<tr><td> <strong>���¹</strong> �س ".trim($user_name)." </td></tr>    ";
					$msgtext	.= "<tr><td> &nbsp;</td></tr>    ";
					$msgtext	.= "<tr><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;�к��ѹ�֡���������͡��鹷�� ����� ��ѹ ".str_replace("&nbsp;"," ",trim(daythai($Array_MaxTrip[$key])))." ������ѹ�ش���¤��������͡��鹷�������س�� ������ӷӻԴ��Ի����������������� ����Ҫ�������� ".$Array_LateTrip[$key]." �ѹ�ӡ��<br />";
					$msgtext	.= "�� ����ö����к����ͺѹ�֡��§ҹ��Ш��ѹ�� ��� <br /><br /></td></tr>";

					$msgtext	.= "<tr><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong><a href=\"http://202.129.35.106/sapphire/application/cost/login.php\" target=\"_blank\">http://202.129.35.106/sapphire/application/cost/login.php</a></strong><br /></td></tr>";
					
					$msgtext	.= "<tr><td> &nbsp;</td></tr>    ";
					$msgtext	.= "<tr><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;����ҡ�س�Դ��Ի��Ҫ���ҡ���� 2 �ѹ�ӡ�� �Ҩ���«�觡��ѧ��Ѿ��(���sms) ����Ҩ�����Ѻ�Թ��͹��Ҫ��(�����º��)�֧��͹�����ͷ�Һ!<br />";
					$msgtext	.= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;�ҡ�س����͡����ѷ ���� �͡��Ժѵԧҹ�͡��鹷�� ����ö vpn �������к��� �� user �����ҡ ��� NETWORK<br />";
					$msgtext	.= "<br /> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;�ҡ�ջѭ��㹡����ҹ �к��ѹ�֡���������͡��鹷�� �Դ��� ���� �س��è�� ��� R&amp;D<br />";
					$msgtext	.= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;�ҡ�ջѭ������ǡѺ����ԡ��������ҷ㹡�����к��ѹ�֡���������͡��鹷�� �Դ��� ���� <Strong>�س��ŸԴ� ���ºѭ�� (089-7552229,082-6950392)</Strong><br />";
					$msgtext	.= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;�ҡ�ջѭ��㹡�� VPN �к��ѹ�֡���������͡��鹷�� �Դ��� ���� �س���йѹ�� ��� NETWORK <br /><br /><br />";
					$msgtext	.= "&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; BEST REGARD<br />";
					$msgtext	.= "&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; SAPPHIRE R &amp; D </td>";
					$msgtext	.= "</tr>";
					$msgtext	.= "<tr><td>ŧ�ѹ��� ".str_replace("&nbsp;"," ",trim(daythai(date("Y-m-d"))))."</td></tr>";						
					$msgtext	.= "<tr><td>&nbsp;</td></tr>";
					$msgtext	.= "</table>";
					$workname="�� : ".trim($user_shortname)."������������������͡��鹷��[".trim($key)."]���駷��$no" ;
					$email_sys = "system@sapphire.co.th";
					
					//echo "<br/>$workname<hr/><pre>$msgtext</pre>";	//echo "-----".$UserEmail ."-----<br>";
					if( ($UserEmail && $Report_Now != "ON" ) ){ 
						if( (intval(date(H)) >= $crontab && intval(date(H)) < intval($crontab+1)) || $Fix_Hour == "OFF" ){
							$mail_sender[$UserEmail]="send";
							$UserEmail = $Debug_Mode != "ON" ? $UserEmail : $debug_Mail ;
							//echo $UserEmail ."-----<br>"; // �� ����
							$result_mail = mail_daily_request($workname, $UserEmail , $email_sys ,$msgtext,$id);	
							echo "Mail Sending ..to $UserEmail <br>";
							$sending_number++;
							
							$strSQL= "
							INSERT INTO `alert_list` 
										(`trip_id`,`alert_way`,`status_alert`,`condition_alert`,`no_alert`) 
							VALUES ('$key','mail','$result_mail','".$Array_LateTrip[$key]."','$no') ";
							@mysql_query($strSQL);
						}
					}
					###############################################					
				}				
			}
		}	

		echo "<br><hr><br><h3> ��¡�÷���� SMS ��</h3>";

		### �� sms
		if(@count($Array_AlertSMS)>0  && $TEL_Online != "OFF"){
			foreach( $Array_AlertSMS as $key => $val ){				
				$Array_SMSNfo[$key]=call_owner_trip($key);
				//echo "<pre>"; print_r($Array_Nfo[$key]); echo "</pre>";				
				$user_name = $Array_SMSNfo[$key][name] . " ".$Array_SMSNfo[$key][surname] ;
				$user_shortname = $Array_Nfo[$key][name] ;
				$tripname = $Array_Nfo[$key][tripname];
				$UserEmail = "";
				$UserTel = "";

				if($Array_SMSNfo[$key][epm_id]>0){
					$strSQL = " select * from epm.epm_staff where staffid = '".$Array_SMSNfo[$key][epm_id]."' limit 1";	
					$Result_epm = mysql_query($strSQL);
					$Row_epm = mysql_fetch_assoc($Result_epm);
					$UserTel = trim(str_replace("-","",str_replace(" ","",$Row_epm['telno'])));
				}
				
				###############################################
				echo $Array_SMSNfo[$key][epm_id].". ".$Array_Nfo[$key][name]." [".$UserTel."] �Դ��Ի����ҡ [".$key."] : ". $Array_LateTrip[$key] ." �ѹ<br>";
				if($UserTel){
					$Arr_Msn = "";
					
					$strSQL = " SELECT max(no_alert) as no_alert FROM `alert_list` WHERE `trip_id` = '$key' AND alert_way = 'sms' group by trip_id ";
					$Result_no = mysql_query($strSQL);
					if(@mysql_num_rows($Result_no)>0){
						$arr_no = mysql_fetch_assoc($Result_no);
						$no = $arr_no['no_alert']+1 ;
					}else{
						$no = 1 ; 	
					}

					$Msg = " ��سҴ��Թ��ûԴ��Ի".$key."����Ҫ��". $Array_LateTrip[$key] ."�ѹ�ӡ������(��͹���駷��".$no.")";	  // ��ͤ��������	
	
					$Arr_Msn[] = $Debug_Mode != "ON" ? $UserTel : $debug_Tel ;
					//$Arr_Msn[] = "0861860538";				// ����ҡ
					$Msn = implode(",",$Arr_Msn);		
					if( ($UserTel && $Report_Now != "ON" )){ 
						if( (intval(date(H)) >= $crontab && intval(date(H)) < intval($crontab+1)) || $Fix_Hour == "OFF" ){
							SendSMS2db($Msn,$Msg);
							echo "SMS Sending ..to $UserTel <br>";
									
							$strSQL= "
							INSERT INTO `alert_list` 
										(`trip_id`,`alert_way`,`status_alert`,`condition_alert`,`no_alert`) 
							VALUES ('$key','sms','$result_mail','".$Array_LateTrip[$key]."','$no') ";
							@mysql_query($strSQL);
							
						}
					}
				}
			}
		}
### �������� ��������


### CornTab
$strSQL=" INSERT INTO `corntab_time` set `time` = NOW() ";
@mysql_query($strSQL);

?>