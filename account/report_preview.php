<?
#START
###### This Program is copyright Sapphire Research and Development co.,ltd ########
#########################################################
$ApplicationName= "Report";
$module_code = "display";
$process_id = "display";
$VERSION = "9.1";
#########################################################
#Developer::Pairoj
#DateCreate::24/04/2007
#LastUpdate::24/04/2007
#DatabaseTabel::
#END
#########################################################
session_start();
include("../../inc/authority.inc.php");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<LINK href="../../common/style.css" rel=stylesheet type="text/css">
<title>������ʹѺʹع��û�Ժѵ��Ҫ��õ�����Ѻ�ͧ �ӹѡ�ҹ��С�����á���֡�Ң�鹾�鹰ҹ </title>
<style type="text/css">
<!--
.style1 {color: #000000}
-->
</style>
</head>

<body bgcolor="#A3B2CC">
<tr bgcolor="#ffffff"><td height="20"><div align="center">
  <p><strong>������ʹѺʹع��û�Ժѵ��Ҫ��õ�����Ѻ�ͧ �ӹѡ�ҹ��С�����á���֡�Ң�鹾�鹰ҹ </strong></p>
  </div></td>
</tr>
<table border="1" align="center" cellpadding="2" cellspacing="1"  bgcolor="#080808">
<tr align="center" bgcolor="#ffffff">
  <td align="center"><strong>�ӴѺ</strong></td>
  <td align="center"><strong>��Ǫ���Ѵ</strong></td>
  <td height="20"><strong>��������´ (��Ǫ���Ѵ-�����)</strong></td>
</tr>
<tr bgcolor="#ffffff">
  <td align="center">1</td>
  <td align="center">1.4.3</td>
  <td height="20"><a href="report_sum.php?vid=100241&amp;action=sum&amp;name=�ӹǹ������ѭ�ҵ��ʶҹ�֡���������Ẻ 89 �ͧ�ӹѡ����¹��ҧ��з�ǧ��Ҵ��&amp;unit=��&amp;style=1" class="style1" target="_blank">�ӹǹ������ѭ�ҵ��ʶҹ�֡���������Ẻ 89 �ͧ�ӹѡ����¹��ҧ��з�ǧ��Ҵ��</a></td>
</tr>
<tr bgcolor="#ffffff">
  <td align="center">2</td>
  <td align="center">1.10B</td>
  <td height="20"><a href="report_sum.php?vid=100242&amp;action=sum&amp;name=�ӹǹ�ç���¹����ա�èѴ��Ἱ��Ժѵԡ�á�кǹ������¹������ɰ�Ԩ����§&amp;unit=�ç���¹&amp;style=1" class="style1" target="_blank">�ӹǹ�ç���¹����ա�èѴ��Ἱ��Ժѵԡ�á�кǹ������¹������ɰ�Ԩ����§</a></td>
</tr>
<tr bgcolor="#ffffff">
  <td align="center">3</td>
  <td align="center">1.10B</td>
  <td height="20"><a href="report_sum.php?vid=100243&amp;action=sum&amp;name=�ӹǹ�ç���¹����ա����§ҹ�š�ô��Թ���&amp;unit=�ç���¹&amp;style=1" class="style1" target="_blank">�ӹǹ�ç���¹����ա����§ҹ�š�ô��Թ���</a></td>
</tr>
<tr bgcolor="#ffffff">
  <td align="center">4</td>
  <td align="center">1.11.1B</td>
  <td height="20"><a href="report_sum.php?vid=100244&amp;action=count&amp;name=�ӹǹ�ç���¹�����ʶҹ�֡�һ��������2&amp;unit=�ç���¹&amp;style=1" class="style1" target="_blank">�ӹǹ�ç���¹�����ʶҹ�֡�һ�������� 2 </a></td>
</tr>
<tr bgcolor="#ffffff">
  <td align="center">5</td>
  <td align="center">1.11.1B</td>
  <td height="20"><a href="report_sum.php?vid=100245&amp;action=count&amp;name=�ӹǹ�ç���¹�����ʶ���֡�һ��������2����ա�������͢���&amp;unit=�ç���¹&amp;style=1" class="style1" target="_blank">�ӹǹ�ç���¹�����ʶ���֡�һ�������� 2 ����ա�������͢��� </a></td>
</tr>
<tr bgcolor="#ffffff">
  <td align="center">6</td>
  <td align="center">1.11.1C</td>
  <td height="20"><a href="report_sum.php?vid=100246&amp;action=count&amp;name=�ӹǹ�ç���¹�����ʶҹ�֡�һ��������1&amp;unit=�ç���¹&amp;style=1" class="style1" target="_blank">�ӹǹ�ç���¹�����ʶҹ�֡�һ�������� 1 </a></td>
</tr>
<tr bgcolor="#ffffff">
  <td align="center">7</td>
  <td align="center">1.11.1C</td>
  <td height="20"><a href="report_sum.php?vid=100247&amp;action=count&amp;name�ӹǹ�ç���¹�����ʶҹ�֡�һ��������1����ա�������͢���=&amp;unit=�ç���¹&amp;style=1" class="style1" target="_blank">�ӹǹ�ç���¹�����ʶҹ�֡�һ�������� 1 ����ա�������͢��� </a></td>
</tr>
<tr bgcolor="#ffffff">
  <td align="center">8</td>
  <td align="center">1.11.6B</td>
  <td height="20"><a href="report_sum.php?vid=100249&amp;action=count&amp;name=�ӹǹ�ç���¹������ç���¹��ç��õ��Ἱ�Ѳ�ҡ�����¹����͹�����ѧ���&amp;unit=�ç���¹&amp;style=1" class="style1" target="_blank">�ӹǹ�ç���¹������ç���¹��ç��õ��Ἱ�Ѳ�ҡ�����¹����͹�����ѧ���</a></td>
</tr>
<tr bgcolor="#ffffff">
  <td align="center">9</td>
  <td align="center">1.11.6B</td>
  <td height="20"><a href="report_sum.php?vid=100250&amp;action=count&amp;name=�ӹǹ�ç���¹����ա�ô��Թ��õ��Ἱ�Ѳ�ҡ�����¹����͹�����ѧ���&amp;unit=�ç���¹&amp;style=1" class="style1" target="_blank">�ӹǹ�ç���¹����ա�ô��Թ��õ��Ἱ�Ѳ�ҡ�����¹����͹�����ѧ���</a></td>
</tr>
<tr bgcolor="#ffffff">
  <td align="center">10</td>
  <td align="center">1.11.7B</td>
  <td height="20"><a href="report_sum.php?vid=100251&amp;action=avg&amp;name=�������¼����ķ���ҧ������¹�ԪҤ�Ե��ʵ���Ҥ���¹���1�ա���֡��2549&amp;unit=��ṹ&amp;style=2" class="style1" target="_blank">�������¼����ķ���ҧ������¹�ԪҤ�Ե��ʵ��  �Ҥ���¹��� 1  �ա���֡��  2549 </a></td>
</tr>
<tr bgcolor="#ffffff">
  <td align="center">11</td>
  <td align="center">1.11.7B</td>
  <td height="20"><a href="report_sum.php?vid=100252&amp;action=avg&amp;name=�������¼����ķ���ҧ������¹�ԪҤ�Ե��ʵ���Ҥ���¹���2�ա���֡��2549&amp;unit=��ṹ&amp;style=2" class="style1" target="_blank">�������¼����ķ���ҧ������¹�ԪҤ�Ե��ʵ��  �Ҥ���¹��� 2  �ա���֡��  2549 </a></td>
</tr>
<tr bgcolor="#ffffff">
  <td align="center">12</td>
  <td align="center">1.11.8B</td>
  <td height="20"><a href="report_sum.php?vid=100253&amp;action=avg&amp;name=�������¼����ķ���ҧ������¹�Ԫ��������Ҥ���¹���1�ա���֡��2549&amp;unit=��ṹ&amp;style=2" class="style1" target="_blank">�������¼����ķ���ҧ������¹�Ԫ�������  �Ҥ���¹��� 1  �ա���֡��  2549 </a></td>
</tr>
<tr bgcolor="#ffffff">
  <td align="center">13</td>
  <td align="center">1.11.8B</td>
  <td height="20"><a href="report_sum.php?vid=100254&amp;action=avg&amp;name=�������¼����ķ���ҧ������¹�Ԫ��������Ҥ���¹���2�ա���֡��2549&amp;unit=��ṹ&amp;style=2" class="style1" target="_blank">�������¼����ķ���ҧ������¹�Ԫ�������  �Ҥ���¹��� 2  �ա���֡��  2549 </a></td>
</tr>
<tr bgcolor="#ffffff">
  <td align="center">14</td>
  <td align="center">1.11.9B</td>
  <td height="20"><a href="report_sum.php?vid=100255&amp;action=avg&amp;name=�������¼����ķ���ҧ������¹�Ԫ��Է����ʵ��ͧ�ѡ���¹�ç���¹�Ҥ���¹���1�ա���֡��2549&amp;unit=��ṹ&amp;style=2" class="style1" target="_blank">�������¼����ķ���ҧ������¹�Ԫ��Է����ʵ��ͧ�ѡ���¹�ç���¹ �Ҥ���¹��� 1  �ա���֡��  2549</a></td>
</tr>
<tr bgcolor="#ffffff">
  <td align="center">15</td>
  <td align="center">1.11.9B</td>
  <td height="20"><a href="report_sum.php?vid=100256&amp;action=sum&amp;name=�������¼����ķ���ҧ������¹�Ԫ��Է����ʵ��ͧ�ѡ���¹�Ҥ���¹���2�ա���֡��2549&amp;unit=��ṹ&amp;style=2" class="style1" target="_blank">�������¼����ķ���ҧ������¹�Ԫ��Է����ʵ��ͧ�ѡ���¹�Ҥ���¹��� 2  �ա���֡��  2549 </a></td>
</tr>
<tr bgcolor="#ffffff">
  <td align="center">16</td>
  <td align="center">3.1A</td>
  <td height="20"><a href="report_sum.php?vid=100260&amp;action=count&amp;name=�ӹǹ�ç���¹������ç���¹���Ѵ������¹����͹������&amp;unit=�ç���¹&amp;style=1" class="style1" target="_blank">�ӹǹ�ç���¹������ç���¹���Ѵ������¹����͹������</a></td>
</tr>
<tr bgcolor="#ffffff">
  <td align="center">17</td>
  <td align="center">3.1A</td>
  <td height="20"><a href="report_sum.php?vid=100261&amp;action=count&amp;name=�ӹǹ�ç���¹������ç���¹�����·�����Ѻ��áӡѺ���������仵����ѡ�������ҵðҹ�س�Ҿ�ͧ��èѴ������¹���ͧ�硻�����&amp;unit=�ç���¹&amp;style=1" class="style1" target="_blank">�ӹǹ�ç���¹������ç���¹�����·�����Ѻ��áӡѺ���������仵����ѡ�������ҵðҹ�س�Ҿ�ͧ��èѴ������¹���ͧ�硻����� </a></td>
</tr>
<tr bgcolor="#ffffff">
  <td align="center">18</td>
  <td align="center">3.1B</td>
  <td height="20"><a href="report_sum.php?vid=100263&amp;action=count&amp;name=�ӹǹ�ç���¹������ç���¹�����·�����Ѻ��áӡѺ���������仵����ѡ�������ҵðҹ�س�Ҿ�ͧ��èѴ������¹���ͧ�硻����� ��м�ҹࡳ���ҵðҹ�дѺ��&amp;unit=�ç���¹&amp;style=1" class="style1" target="_blank">�ӹǹ�ç���¹������ç���¹�����·�����Ѻ��áӡѺ���������仵����ѡ�������ҵðҹ�س�Ҿ�ͧ��èѴ������¹���ͧ�硻����� ��м�ҹࡳ���ҵðҹ�дѺ�� </a></td>
</tr>
<tr bgcolor="#ffffff">
  <td align="center">19</td>
  <td align="center">3.4B</td>
  <td height="20"><a href="report_sum.php?vid=100267&amp;action=sum&amp;name=�ӹǹ���᡹����ç���¹����ͧ 8 ��������� ���������Ѻ���ͺ��&amp;unit=��&amp;style=1" class="style1" target="_blank">�ӹǹ���᡹����ç���¹����ͧ 8 ��������� ���������Ѻ���ͺ�� </a></td>
</tr>
<tr bgcolor="#ffffff">
  <td align="center">20</td>
  <td align="center">3.4C</td>
  <td height="20"><a href="report_sum.php?vid=100268&amp;action=sum&amp;name=�ӹǹ����ʶҹ�֡�Ңͧ���᡹�ӷ���դ�������������㹡�èѴ������¹����͹��������ҵðҹ������¹���&amp;unit=��&amp;style=1" class="style1" target="_blank">�ӹǹ����ʶҹ�֡�Ңͧ���᡹�ӷ���դ�������������㹡�èѴ������¹����͹��������ҵðҹ������¹���</a></td>
</tr>
<tr bgcolor="#ffffff">
  <td align="center">21</td>
  <td align="center">3.4D</td>
  <td height="20"><a href="report_sum.php?vid=100269&amp;action=sum&amp;name=�ӹǹ������͢����ʶҹ�֡����� �  �����᡹������ö���¼���������͢����դ�������������㹡�èѴ������¹����͹��������ҵðҹ������¹���&amp;unit=��&amp;style=1" class="style1" target="_blank">�ӹǹ������͢����ʶҹ�֡����� �  �����᡹������ö���¼���������͢����դ�������������㹡�èѴ������¹����͹��������ҵðҹ������¹��� </a></td>
</tr>
<tr bgcolor="#ffffff">
  <td align="center">22</td>
  <td align="center">3.7A</td>
  <td height="20"><a href="report_sum.php?vid=100270&amp;action=count&amp;name=�ӹǹ�ç���¹�����ҵðҹ����֡�Ң�鹾�鹰ҹ仨Ѵ���к���Сѹ�س�Ҿ����&amp;unit=�ç���¹&amp;style=1" class="style1" target="_blank">�ӹǹ�ç���¹�����ҵðҹ����֡�Ң�鹾�鹰ҹ仨Ѵ���к���Сѹ�س�Ҿ����</a></td>
</tr>
<tr bgcolor="#ffffff">
  <td align="center">23</td>
  <td align="center">3.7B</td>
  <td height="20"><a href="report_sum.php?vid=100271&amp;action=count&amp;name=�ӹǹ�ç���¹����ç���¹����ö���к���Сѹ�س�Ҿ����������ª��&amp;unit=�ç���¹&amp;style=1" class="style1" target="_blank">�ӹǹ�ç���¹����ç���¹����ö���к���Сѹ�س�Ҿ����������ª�� </a></td>
</tr>
<tr bgcolor="#ffffff">
  <td align="center">24</td>
  <td align="center">3.8</td>
  <td height="20"><a href="report_sum.php?vid=100272&amp;action=count&amp;name=�ӹǹ�ç���¹����Ѻ��û����Թ�ҡ�����ͺ���2�ա���֡��2549&amp;unit=�ç���¹&amp;style=1" class="style1" target="_blank">�ӹǹ�ç���¹����Ѻ��û����Թ�ҡ ���. ��ͺ���  2 �ա���֡�� 2549 </a></td>
</tr>
<tr bgcolor="#ffffff">
  <td align="center">25</td>
  <td align="center">3.8</td>
  <td height="20"><a href="report_sum.php?vid=100273&amp;action=count&amp;name=�ӹǹ�ç���¹����ҹࡳ��س�Ҿ�ҵðҹ�ҡ�����ͺ���2�ա���֡��2549&amp;unit=�ç���¹&amp;style=1" class="style1" target="_blank">�ӹǹ�ç���¹����ҹࡳ��س�Ҿ�ҵðҹ�ҡ ���. ��ͺ���  2 �ա���֡�� 2549</a></td>
</tr>
<tr bgcolor="#ffffff">
  <td align="center">26</td>
  <td align="center">3.9</td>
  <td height="20"><a href="report_sum.php?vid=100274&amp;action=count&amp;name=�ӹǹ�ç���¹�������ҹ��û����Թ�ҡ�����ͺ�á&amp;unit=�ç���¹&amp;style=1" class="style1" target="_blank">�ӹǹ�ç���¹�������ҹ��û����Թ�ҡ ���. ��ͺ�á </a></td>
</tr>
<tr bgcolor="#ffffff">
  <td align="center">27</td>
  <td align="center">3.9</td>
  <td height="20"><a href="report_sum.php?vid=100275&amp;action=count&amp;name=�ӹǹ�ç���¹�������ҹ��û����Թ�ҡ�����ͺ�á���Ѻ��û����Թ��м�ҹࡳ��س�Ҿ�ҵðҹ�ҡʾ�&amp;unit=�ç���¹&amp;style=1" class="style1" target="_blank">�ӹǹ�ç���¹�������ҹ��û����Թ�ҡ ���. ��ͺ�á ���Ѻ��û����Թ��м�ҹࡳ��س�Ҿ�ҵðҹ�ҡ ʾ�. </a></td>
</tr>
<tr bgcolor="#ffffff">
  <td align="center">28</td>
  <td align="center">3.1</td>
  <td height="20"><a href="report_sum.php?vid=100276&amp;action=count&amp;name=�ӹǹ�ç���¹������ç���¹����ҹࡳ���û����Թ����к����Ū�������͹ѡ���¹&amp;unit=�ç���¹&amp;style=1" class="style1" target="_blank">�ӹǹ�ç���¹������ç���¹����ҹࡳ���û����Թ����к����Ū�������͹ѡ���¹ </a></td>
</tr>
<tr bgcolor="#ffffff">
  <td align="center">29</td>
  <td align="center">3.11B</td>
  <td height="20"><a href="report_sum.php?vid=100277&amp;action=count&amp;name=�ӹǹ�ç���¹������ç���¹��Ҵ���  �����Ἱ�Ѳ��¡�дѺ�س�Ҿ�ҵðҹ����ա�û�ѺἹ��èѴ������¹&amp;unit=�ç���¹&amp;style=1" class="style1" target="_blank">�ӹǹ�ç���¹������ç���¹��Ҵ���  �����Ἱ�Ѳ��¡�дѺ�س�Ҿ�ҵðҹ����ա�û�ѺἹ��èѴ������¹</a></td>
</tr>
<tr bgcolor="#ffffff">
  <td align="center">30</td>
  <td align="center">3.12</td>
  <td height="20"><a href="report_sum.php?vid=100278&amp;action=sum&amp;name=�ӹǹ������¹  �ç���¹᡹���������������ѡ�����ҹ������&amp;unit=��&amp;style=1" class="style1" target="_blank">�ӹǹ������¹  �ç���¹᡹���������������ѡ�����ҹ������</a></td>
</tr>
<tr bgcolor="#ffffff">
  <td align="center">31</td>
  <td align="center">3.12</td>
  <td height="20"><a href="report_sum.php?vid=100279&amp;action=sum&amp;name=�ӹǹ������¹�ç���¹᡹���������������ѡ�����ҹ����ҹࡳ��&amp;unit=��&amp;style=1" class="style1" target="_blank">�ӹǹ������¹  �ç���¹᡹���������������ѡ�����ҹ����ҹࡳ�� </a></td>
</tr>
<tr bgcolor="#ffffff">
  <td align="center">32</td>
  <td align="center">3.13</td>
  <td height="20"><a href="report_sum.php?vid=100280&amp;action=count&amp;name=�ӹǹ�ç���¹������ç���¹᡹�ӡ�èѴ��ͧ��ش����ժ��Ե����ࡳ���û����Թ&amp;unit=�ç���¹&amp;style=1" class="style1" target="_blank">�ӹǹ�ç���¹������ç���¹᡹�ӡ�èѴ��ͧ��ش����ժ��Ե����ࡳ���û����Թ</a></td>
</tr>
<tr bgcolor="#ffffff">
  <td align="center">33</td>
  <td align="center">3.14</td>
  <td height="20"><a href="report_sum.php?vid=100281&amp;action=avg&amp;name=��ṹ��û����Թʶҹ�֡�һ�Шӻա���֡��2549&amp;unit=��ṹ&amp;style=2" class="style1" target="_blank">��ṹ��û����Թʶҹ�֡�ҷ������� �����  ���к���ͧ�ѹ  ��� ���������ѧ�ѭ�����ʾ�Դ�ʶҹ�֡�������ҧ����׹ ��Шӻա���֡�� 2549</a></td>
</tr>
<tr bgcolor="#ffffff">
  <td align="center">34</td>
  <td align="center">3.14</td>
  <td height="20"><a href="report_sum.php?vid=100282&amp;action=avg&amp;name=��ṹ��û����Թʶҹ�֡�һ�Шӻա���֡��2550&amp;unit=��ṹ&amp;style=2" class="style1" target="_blank">��ṹ��û����Թʶҹ�֡�ҷ������� �����  ���к���ͧ�ѹ  ��� ���������ѧ�ѭ�����ʾ�Դ�ʶҹ�֡�������ҧ����׹ ��Шӻա���֡�� 2550</a></td>
</tr>
<tr bgcolor="#ffffff">
  <td align="center">35</td>
  <td align="center">6</td>
  <td height="20"><a href="report_sum.php?vid=100283&amp;action=count&amp;name=�ӹǹ�ç���¹����ա�èѴ����§ҹ��ػ�š�û�Ժѵԧҹ��������&amp;unit=�ç���¹&amp;style=1" class="style1" target="_blank">�ӹǹ�ç���¹����ա�èѴ����§ҹ��ػ�š�û�Ժѵԧҹ�������� </a></td>
</tr>
<tr bgcolor="#ffffff">
  <td align="center">36</td>
  <td align="center">9.1B</td>
  <td height="20"><a href="report_sum.php?vid=100284&amp;action=sum&amp;name=����ҳ�����俿�һէ�����ҳ2546&amp;unit=˹���&amp;style=2" class="style1" target="_blank">����ҳ�����俿�� �է�����ҳ  2546 </a></td>
</tr>
<tr bgcolor="#ffffff">
  <td align="center">37</td>
  <td align="center">9.1B</td>
  <td height="20"><a href="report_sum.php?vid=100285&amp;action=sum&amp;name=����ҳ�����俿�һէ�����ҳ2550&amp;unit=˹���&amp;style=2" class="style1" target="_blank">����ҳ�����俿�� �է�����ҳ 2550</a></td>
</tr>
<tr bgcolor="#ffffff">
  <td align="center">38</td>
  <td align="center">9.2B</td>
  <td height="20"><a href="report_sum.php?vid=100286&amp;action=sum&amp;name=����ҳ��������ѹ�է�����ҳ�.�.2546&amp;unit=�Ե�&amp;style=2" class="style1" target="_blank">����ҳ��������ѹ�է�����ҳ  �.�.  2546</a></td>
</tr>
<tr bgcolor="#ffffff">
  <td align="center">39</td>
  <td align="center">9.2B</td>
  <td height="20"><a href="report_sum.php?vid=100287&amp;action=sum&amp;name=����ҳ��������ѹ�է�����ҳ�.�.2550&amp;unit=�Ե�&amp;style=2" class="style1" target="_blank">����ҳ��������ѹ �է�����ҳ �.�. 2550</a></td>
</tr>
<tr bgcolor="#ffffff">
  <td align="center">40</td>
  <td align="center">11</td>
  <td height="20"><a href="report_sum.php?vid=100288&amp;action=count&amp;name=�ӹǹ�ç���¹����ա�èѴ�ӡ�äӹǳ�鹷ع�ż�Ե���˹��������&amp;unit=�ç���¹&amp;style=1" class="style1" target="_blank">�ӹǹ�ç���¹����ա�èѴ�ӡ�äӹǳ�鹷ع�ż�Ե���˹�������� </a></td>
</tr>
<tr bgcolor="#ffffff">
  <td align="center">41</td>
  <td align="center">3.12</td>
  <td height="20"><a href="report_sum.php?vid=100291&amp;action=count&amp;name=�ӹǹ�ç���¹���������ç����������������ѡ�����ҹ&amp;unit=�ç���¹&amp;style=1" class="style1" target="_blank">�ӹǹ�ç���¹���������ç����������������ѡ�����ҹ</a></td>
</tr>
<tr bgcolor="#ffffff">
  <td align="center">42</td>
  <td align="center">3.13</td>
  <td height="20"><a href="report_sum.php?vid=100296&amp;action=count&amp;name=�ӹǹ�ç���¹������ç���¹᡹�ӡ�èѴ��ͧ��ش�ժ��Ե&amp;unit=�ç���¹&amp;style=1" class="style1" target="_blank">�ӹǹ�ç���¹������ç���¹᡹�ӡ�èѴ��ͧ��ش�ժ��Ե </a></td>
</tr>
<tr bgcolor="#ffffff">
  <td align="center">43</td>
  <td align="center">3.11B</td>
  <td height="20"><a href="report_sum.php?vid=100307&amp;action=count&amp;name=�ӹǹ�ç���¹�����ʶҹ�֡�Ң�Ҵ���&amp;unit=�ç���¹&amp;style=1" class="style1" target="_blank">�ӹǹ�ç���¹�����ʶҹ�֡�Ң�Ҵ��� </a></td>
</tr>
<tr bgcolor="#ffffff">
  <td align="center">44</td>
  <td align="center">14.5</td>
  <td height="20"><a href="report_sum.php?vid=100314&amp;action=count&amp;name=�ӹǹ�ç���¹������к����ʹ�Ȥú��ǹ㹡�ú�����&amp;unit=�ç���¹&amp;style=1" class="style1" target="_blank">�ӹǹ�ç���¹������к����ʹ�Ȥú��ǹ㹡�ú�����</a></td>
</tr>
<tr bgcolor="#ffffff">
  <td align="center">45</td>
  <td align="center">14.5</td>
  <td height="20"><a href="report_sum.php?vid=100315&amp;action=count&amp;name=�ӹǹ�ç���¹���Ѵ����§ҹ�����ŷѹ�����˹�����&amp;unit=�ç���¹&amp;style=1" class="style1" target="_blank">�ӹǹ�ç���¹���Ѵ����§ҹ������ �ѹ�����˹����� </a></td>
</tr>
<tr bgcolor="#ffffff">
  <td align="center">46</td>
  <td align="center">1.11.10B</td>
  <td height="20"><a href="report_sum.php?vid=100316&amp;action=count&amp;name=�ӹǹ�ç���¹�����������ç��á�èѴ�Ԩ�������Ἱ�Ѳ�ҡ�äԴ&amp;unit=�ç���¹&amp;style=1" class="style1" target="_blank">�ӹǹ�ç���¹�����������ç��� ��èѴ�Ԩ�������Ἱ�Ѳ�ҡ�äԴ</a></td>
</tr>
<tr bgcolor="#ffffff">
  <td align="center">47</td>
  <td align="center">1.11.10B</td>
  <td height="20"><a href="report_sum.php?vid=100317&amp;action=count&amp;name=�ӹǹ�ç���¹����ա�èѴ����§ҹ��������˹����мš�ô��Թ�ҹ&amp;unit=�ç���¹&amp;style=1" class="style1" target="_blank">�ӹǹ�ç���¹����ա�èѴ����§ҹ��������˹����мš�ô��Թ�ҹ</a></td>
</tr>
<tr bgcolor="#ffffff">
  <td align="center">48</td>
  <td align="center">1.11.2B</td>
  <td height="20"><a href="report_sum.php?vid=100320&amp;action=count&amp;name=�ӹǹ�ç���¹�����ʶҹ�֡�һ��������1����ա�ú����èѴ����֡�������ҧ�����&amp;unit=�ç���¹&amp;style=1" class="style1" target="_blank">�ӹǹ�ç���¹�����ʶҹ�֡�һ�������� 1 ����ա�ú����èѴ����֡�������ҧ�����</a></td>
</tr>
</table>
</body >


</html>
