<?php
  ///////////////////////////////////////////////////
  // ���� "�������"
  // 2003-2006 (C) IT-������ SoftTime (http://www.softtime.ru)
  // �������� �.�. (simdyanov@softtime.ru)
  // ������� �.�. (softtime@softtime.ru)
  ///////////////////////////////////////////////////
  // ���������� ������� ��������� ������ (http://www.softtime.ru/info/articlephp.php?id_article=23)
  Error_Reporting(E_ALL & ~E_NOTICE); 

  // ������������� ���������� � ����� ������
  require_once("../config.php");

  // ��������� �������� id_news, ������������ SQL-��������
  if(!preg_match("|^[\d]+$|",$_GET['id_news'])) puterror("������ ��� ��������� � ����� ��������");

  // ���� ��������� ������� ����� ����������� - ������� ���
  $query = "SELECT * FROM news 
            WHERE id_news=".$_GET['id_news'];
  $new = mysql_query($query);
  if(!$new) puterror("������ ������� � ������� ��������...");
  if(mysql_num_rows($new) > 0)
  {
    $row = mysql_fetch_array($new);
    if(is_file("../".$row['url_pict'])) @unlink("../".$row['url_pict']);
  }
  // ��������� � ��������� SQL-������ �� �������� ������ � ������� news  
  $query = "DELETE FROM news WHERE id_news=".$_GET['id_news'];
  if(mysql_query($query)) header("Location: index.php?page=".$_GET['page']);
  else puterror("������ ��� ��������� � ����� ��������");
?>