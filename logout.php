<?
session_start() ; 
$application = $_SESSION['application'];
session_destroy() ;
$msg = "<font class=blue>�͡�ҡ�к����º��������</font><br>�к����ѧ�ҷ�ҹ���˹����ѡ ��س��ͫѡ����";
include("msg_box.php");
echo "<meta http-equiv='refresh' content='2;url=login.php?application=$application'>";
exit();
?>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">