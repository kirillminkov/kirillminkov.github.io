<?php
  ///////////////////////////////////////////////////
  // ���� "�������"
  // 2003-2006 (C) IT-������ SoftTime (http://www.softtime.ru)
  // �������� �.�. (simdyanov@softtime.ru)
  // ������� �.�. (softtime@softtime.ru)
  ///////////////////////////////////////////////////
  // ���������� ������� ��������� ������ (http://www.softtime.ru/info/articlephp.php?id_article=23)
  Error_Reporting(E_ALL & ~E_NOTICE); 

  // ������������ ���������� � ����� ������
  include "../config.php";

  // �������� - ���������� �� ���������� ��� ��������� � ���� ������
  if(empty($_POST['name'])) links("����������� ���������");
  if(empty($_POST['body'])) links("���������� �� �������");
  if(empty($_POST['url_text']) && !empty($_POST['url'])) $_POST['url_text'] = $_POST['url'];
  // ��������� �������� id_news, ������������ SQL-��������
  if(!preg_match("|^[\d]*$|",$_POST['id_news'])) puterror("������ ��� ��������� � ����� ��������");
  // ����������, ������ ������ ��� ���
  if($_POST['hide'] == "on") $showhide = "show";
  else $showhide = "hide";
  // ��������� �������� � url, ���� ������������ ����� ��� ������� ���
  $_POST['url'] = strtr($_POST['url'], "HTTP", "http");
  if (!empty($_POST['url'])) { 
    if (strtolower((substr($_POST['url'], 0, 7))!="http://") && (strtolower(substr($_POST['url'], 0, 7))!="ftp://")) $url="http://".$_POST['url'];
  } 
  // ��������� �������� id_news, ������������ SQL-��������
  if(!preg_match("|^[\d]*$|",$_POST['id_news'])) puterror("������ ��� ��������� � ����� ��������");
  // ��������� �����
  if(!preg_match("|^[\d]+$|",$_POST['date_year'])) puterror("������ ��� ��������� � ����� ��������");
  if(!preg_match("|^[\d]+$|",$_POST['date_month'])) puterror("������ ��� ��������� � ����� ��������");
  if(!preg_match("|^[\d]+$|",$_POST['date_day'])) puterror("������ ��� ��������� � ����� ��������");
  if(!preg_match("|^[\d]+$|",$_POST['date_hour'])) puterror("������ ��� ��������� � ����� ��������");
  if(!preg_match("|^[\d]+$|",$_POST['date_minute'])) puterror("������ ��� ��������� � ����� ��������");

  // �������� ��������� ������� ���������, ����� �������� ���������
  // ��� ���������� ���������� � �������
  if (!get_magic_quotes_gpc())
  {
    $_POST['name'] = mysql_escape_string($_POST['name']);
    $_POST['body'] = mysql_escape_string($_POST['body']);
  }

  // ���� � ������ ������� ������� ����������� � ��������
  // ����������� ��� �������� ��� ������ ����� ����������� 
  // ��������� ������ - ������� ������ �����������
  if($_POST['chk_delete'] == "on" || $_POST['chk_filename'] == "on")
  {
    $query = "SELECT * FROM news WHERE id_news = $_POST[id_news]";
    $nws = mysql_query($query);
    if(!$nws) links("������ ��� �������������� ����� \"�������\"");
    $news = mysql_fetch_array($nws);
    if(!empty($news['url_pict']))
    {
      if(file_exists("../".$news['url_pict'])) @unlink("../".$news['url_pict']);
    }
    $path_image = "url_pict = '',";
  }

  // ���� ��������� ��������� ���� - ���������
  $path = "";
  if($_POST['chk_filename'] == "on")
  {
    if (!empty($_FILES['filename']['tmp_name']))
    {
      // ��������� ���� � �����    
      $path = "files/".date("YmdHis",time());
      // ���� �������� ������� ������������� ���� - ��������������� 
      if($_POST['chk_rename'] == "on")
      {
        // ���������, ����� �� ���� ������ � �������� ������
        $_POST['rename'] = str_replace("\\","",$_POST['rename']);
        $_POST['rename'] = str_replace("/","",$_POST['rename']);
        $_POST['rename'] = stripcslashes($_POST['rename']);
        $path = "files/".substr($_POST['rename'], 0, strrpos($_POST['rename'], ".")); 
      }
      
      // ���������, �� �������� �� ���� �������� PHP ��� Perl, html, ���� ��� ��� ����������� ��� � ������ .txt
      $extentions = array("#\.php#is",
                          "#\.phtml#is",
                          "#\.php3#is",
                          "#\.html#is",
                          "#\.htm#is",
                          "#\.hta#is",
                          "#\.pl#is",
                          "#\.xml#is",
                          "#\.inc#is",
                          "#\.shtml#is", 
                          "#\.xht#is", 
                          "#\.xhtml#is");
      // ��������� �� ����� ����� ����������
      $ext = strrchr($_FILES['filename']['name'], "."); 
      $add = $ext;
      foreach($extentions AS $exten) 
      {
        if(preg_match($exten, $ext)) $add = ".txt"; 
      }
      $path .= $add; 
  
      // ���������� ���� �� ��������� ���������� ������� �
      // ���������� /files Web-����������
      if (copy($_FILES['filename']['tmp_name'], "../".$path))
      {
        // ���������� ���� �� ��������� ����������
        unlink($_FILES['filename']['tmp_name']);
        // �������� ����� ������� � �����
        chmod("../".$path, 0644);
      }
    }
    else links("�� ������ ���� ��� ��������");
    if(!empty($path)) $path_image = "url_pict = '$path',";
  } 
  // ��������� � ��������� SQL-������ �� ���������� ��������� �������
  $query = "UPDATE news SET name='".$_POST['name']."',
                            body='".$_POST['body']."',
                            url='".$_POST['url']."',
                            url_text='".$_POST['url_text']."',
                            putdate = '".$_POST['date_year']."-".$_POST['date_month']."-".$_POST['date_day']." ".sprintf("%02d",$_POST['date_hour']).":".sprintf("%02d",$_POST['date_minute']).":00',
                            $path_image
                            hide = '$showhide'
            WHERE id_news=".$_POST['id_news'];
  if(mysql_query($query)) header("Location: index.php?page=".$_GET['page']);
  else links("������ ��� �������������� �������� (���� ������)");

  // ��������������� ������� ��� ������ ������ ��������
  function links($msg)
  {
    echo "<p>".$msg."</p>";
    echo "<p><a href=# onClick='history.back()'>��������� � ������ ��������</a></p>";
    echo "<p><a href=index.php>����������������� ��������</a></p>";
    exit();
  }
?>