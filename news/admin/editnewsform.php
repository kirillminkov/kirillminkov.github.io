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
  include "../config.php";
  // ��� ��� ��� ����������� �� ����� ������������
  // ����� ���������� ��������, ���������� ���������������
  // ������� ��������� ����������� ����������.
  $titlepage = "�������������� �������";
  $button = "���������";
  $action = "editnews.php";

  // ��������� �� ������� news ������, ���������������
  // ������������ ��������� �������
  $query = "SELECT * FROM news 
            WHERE id_news=".$_GET['id_news'];
  $new = mysql_query($query);
  if(!$new) puterror("������ ������� � ������� ��������...");
  $row = mysql_fetch_array($new);
  // ���� ���������� ��� ���������� ���������� �� ���� ������
  $name = $row['name'];
  $body = $row['body'];
  $url = $row['url'];
  $url_text = $row['url_text'];
  $url_pict = $row['url_pict'];
  $date_month = substr($row['putdate'],5,2);
  $date_day = substr($row['putdate'],8,2);
  $date_year = substr($row['putdate'],0,4);
  $date_hour = substr($row['putdate'],11,2);
  $date_minute = substr($row['putdate'],14,2);
  $_GET['id_news'] = $row['id_news'];
  // ���������� ������ ���� ��� ���
  if($row['hide'] == 'show') $showhide = "checked";
  else $showhide = "";

  // �������� ��������������
  define("EDIT",1);
  // �������� HTML-����� � �����, ������� ����� ���������
  // ������������� ���������� �� ������� news
  include "addnewsform.php";
?>