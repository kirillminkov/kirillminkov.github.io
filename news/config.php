<?php
  ///////////////////////////////////////////////////
  // ���� "�������"
  // 2003-2006 (C) IT-������ SoftTime (http://www.softtime.ru)
  // �������� �.�. (simdyanov@softtime.ru)
  // ������� �.�. (softtime@softtime.ru)
  ///////////////////////////////////////////////////
  // ���������� ������� ��������� ������ (http://www.softtime.ru/info/articlephp.php?id_article=23)
  Error_Reporting(E_ALL & ~E_NOTICE); 

  // ��� ������� ���� ������, �������� $dblocation = "mysql28.noweb.ru"
  // ������ ��������� ������ ��������� ������
  $dblocation = "localhost";
  // ��� ���� ������, �� �������� ��� ��������� ������
  $dbname = "news";
  // ��� ������������ ���� ������
  $dbuser = "root";
  // ������
  $dbpasswd = "";
  // ���������� ��������, ��������� � ������
  $pnumber = 5;
  // ���������� �������� � ����� ����� ��������
  $numchar = 70;
  // ���������� ��������, ��������� �� ��������
  // ��� �������
  $all_number_news = 10;
  // ������ Web-����������
  $version = "2.0.3";
  
  // ����������� � �������� ���� ������
  $dbcnx = @mysql_connect($dblocation,$dbuser,$dbpasswd);
  if (!$dbcnx) exit("<P>� ��������� ������ ������ ���� ������ �� ��������, ������� ���������� ����������� �������� ����������.</P>");
  // �������� ���� ������
  if (!@mysql_select_db($dbname,$dbcnx)) exit("<P>� ��������� ������ ���� ������ �� ��������, ������� ���������� ����������� �������� ����������.</P>");

  // ���������� ������ �������
  $query = "SELECT VERSION()";
  $ver = mysql_query($query);
  if(!$ver) exit("������ ��� ����������� ������ MySQL-�������");
  $version = mysql_result($ver, 0);
  list($major, $minor) = explode(".", $version);
  // ���� ������ ���� 4.1 �������� �������, ��� ����� �������� �
  // ���������� cp1251
  $ver = $major.".".$minor;
  if((float)$ver >= 4.1)
  {
    mysql_query("SET NAMES 'cp1251'");
  }

  // ��������� ��������������� �������, ������� ������� ��������� �� ������
  // � ������ ������ ������� � ���� ������
  function puterror($message)
  {
    exit("<p>$message</p>");
  }
?>