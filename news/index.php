<?php
  ///////////////////////////////////////////////////
  // ���� "�������"
  // 2003-2006 (C) IT-������ SoftTime (http://www.softtime.ru)
  // �������� �.�. (simdyanov@softtime.ru)
  // ������� �.�. (softtime@softtime.ru)
  ///////////////////////////////////////////////////
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
<title>�������</title>
<link rel="StyleSheet" type="text/css" href="news.css">
</head>
<?php
  // ���������� ������� ��������� ������ (http://www.softtime.ru/info/articlephp.php?id_article=23)
  Error_Reporting(E_ALL & ~E_NOTICE); 

  // ���� ���� ������� ������ $pnumber ��������
  // �������������� ���������� � ����� ������
  require_once("config.php");
?>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
<p class="zagblock">�������</p>
<?php
  // �������� ����� ���������� �������� � ���� ������, ��� ���� �����
  // ��������� ���������� ������ �� ����������� �������.
  $tot = mysql_query("SELECT count(*) FROM news WHERE hide='show' AND putdate <= NOW()");
  if ($tot)
  {
    $total = mysql_result($tot,0);
    // ���� � ���� �������� ������ ��� $pnumber
    // ������� �� ��� ������ ������ "��� �������".
    if($pnumber < $total) echo "<p class='linkblock'><a href=news.php class='linkblock'>��� �������</a>";
  }
  else puterror("������ ��� ��������� � ����� ��������");
  // ����������� ��� ������� �������, �.�. ��, � ������� � ���� ������ hide='show',
  // ���� ��� ���� ����� ����� 'hide', ������� �� ����� ������������ �� ��������
  $query = "SELECT * FROM news 
            WHERE hide='show' AND putdate <= NOW()
            ORDER BY putdate DESC
            LIMIT $pnumber";
  $new = mysql_query($query);
  if(!$new) puterror("������ ��� ��������� � ����� ��������");
  if(mysql_num_rows($new) > 0)
  {
    while($news = mysql_fetch_array($new))
    {
      // ������� ��������� �������
      echo "<p class=newsblockzag><b>".$news['name']."</b></p>";
      // ��������� �����
      // ���������� $numchar �������� ���������
      // ���������� �������� � ������
      $pos = strpos(substr($news['body'],$numchar), " ");
      // ���� ������� �������, �� ������� ���������...
      if(strlen($news['body'])>$numchar) $srttmpend = "...";
      else $strtmpend = "";
      // ������� �����
      echo "<p class=newsblock>".substr($news['body'], 0, $numchar+$pos).$srttmpend;
      echo "<br><a class=anewsblock href=news.php?id_news=".$news['id_news'].">���������</a></p>";
    }
  }
?>
<br><br>