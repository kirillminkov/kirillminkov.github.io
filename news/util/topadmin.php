<?php
  ///////////////////////////////////////////////////
  // ���� "������"
  // 2003-2006 (C) IT-��㤨� SoftTime (http://www.softtime.ru)
  // ����ﭮ� �.�. (simdyanov@softtime.ru)
  // ����襢 �.�. (softtime@softtime.ru)
  ///////////////////////////////////////////////////
  // ���⠢�塞 �஢��� ��ࠡ�⪨ �訡�� (http://www.softtime.ru/info/articlephp.php?id_article=23)
  Error_Reporting(E_ALL & ~E_NOTICE); 
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
<title><?php echo $titlepage; ?></title>
<?
    if (!isset($style)) {
    ?>
        <link rel="StyleSheet" type="text/css" href="<? echo $style ?>">    
    <?
    }
?>
<link rel="StyleSheet" type="text/css" href="../util/admin.css">
<link rel="StyleSheet" type="text/css" href="util/admin.css">
<body leftmargin="0" marginheight="0" marginwidth="0" rightmargin="0" bottommargin="0" topmargin="0" >
<table class=topadmin border="0" cellspacing="9">
    <tr align="center">
        <td width="10%">&nbsp;</td>
        <td><p><a href="../../company/index.php" class=link title="��������� �� �������� �������� �����" >��������� �� ����</b></a></td>
        <td width="50">&nbsp;</td>
        <td><p><a href="../index.php" class=link title="��������� �� �������� ����������������� �����">����������������� �����</b></a></td>
        <td width="50">&nbsp;</td>
    </tr>
</table>
<table border="0" cellpadding="0" cellspacing="20" >
    <tr valign="top">
        <td><nobr><h1 class=z1><? echo nl2br($titlepage); ?></h1></nobr></td>
        <td><p class=help><? echo $helppage ?></p></td>
    </tr>
</table>
<table width=100%><tr><td width=10%>&nbsp;</td><td>