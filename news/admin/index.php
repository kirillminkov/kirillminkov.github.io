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
  // ��������� ��������� �������� � ���������
  $titlepage="���������� ������\n \"�������\" $version";
  $helppage='���� � ��� �� �������� ��� Web-����������, �� ������ ������ ����� ������ �� ��� ��������� � ��������� �� ����� ������ <a href=http://www.softtime.ru/forum/>http://www.softtime.ru/forum/</a> �������� ��� ����� ����������� �������������� ����������������, � ���� ������ �� ����� ������ �������� ��� ����� � ���������� ���� �����������. ���� ���� ����������� ������������� ��������� � ���������, �� ���������� ���������� � ������ ����� ���������.';
  // ������� ����� ��������
  include "../util/topadmin.php";  


  // ��������� �������� page, ������������ SQL-��������
  if(!preg_match("|^[\d]*$|",$_POST['page'])) puterror("������ ��� ��������� � ����� ��������");
  // ��������� ���������� $page, ������ ����������� ������ ������ ������� �� ��������
  $page = $_GET['page'];
  if(empty($page)) $page = 1;
  $begin = ($page - 1)*$all_number_news;

  // ������������� �������, ����� �������, ��� ��� �������� �� 
  // ������� ��������, �� ���������� ��� �� ��������� �������
  $query = "SELECT id_news,
                   name,
                   body,
                   DATE_FORMAT(putdate,'%d.%m.%Y') as putdate_format,
                   url,
                   url_text,
                   url_pict,
                   hide
            FROM news
            ORDER BY putdate DESC 
            LIMIT $begin, $all_number_news";
  $new = mysql_query($query);
  if ($new)
  {
    // ������� ������ ���������� ���������, ����������, �������� � ��������������
    ?>
<table cellpadding="0" cellspacing="0" border="0" >
        <tr>
        <?php
    echo "<td class=boxmenu><a class=menu href=addnewsform.php?start=$start title='�������� ����� ������� �� ����' >�������� �������</a></td>";
    ?>
    </tr>
    </table><br>
    <table width=100% class=bodytable border=1 align=center cellpadding=5 cellspacing=0 bordercolorlight=gray bordercolordark=white>
      <tr class=tableheadercat align="center">
        <td width=120><p class=zagtable>����</p></td>
        <td width=60%><p class=zagtable>�������</p></td>
        <td width=40><p class=zagtable><nobr>����-�</nobr></p></td>
        <td colspan=3><p class=zagtable>��������</p></td>
      </tr>
    <?php
    while($news = mysql_fetch_array($new))
    {
    
      // ���� ������� �������� ��� ��������� (hide='hide'), �������
      // ������ "����������", ���� ��� ������� (hide='show') - "������"
      $colorrow = "";
      if($news['hide']=='show') $showhide = "<p><a href=hide.php?id_news=".$news['id_news']."&start=$start title='������ ������� � ����� ��������'>������</a>";
      else  {
        $showhide = "<p><a href=show.php?id_news=".$news['id_news']."&start=$start title='���������� ������� � ����� ��������'>����������</a>";
        $colorrow = "class='hiddenrow'";
      }
      // ��������� ������� �����������
      if ($news['url_pict'] != '' && $news['url_pict'] != '-') $url_pict="<b><a href=../".$news['url_pict'].">����</a></b>";
      else $url_pict="���";
      
      if (($news['url']!='-') and ($news['url']!='')) $news_url="<br><b>������:</b> <a href='".$news['url']."'>".$news['url_text']."</a>";
      else $news_url="";
      // ������� �������
      echo "<tr $colorrow >
              <td><p class=help align=center>".$news['putdate_format']."</p></td>
              <td><p><a title='������������� ����� �������' href=editnewsform.php?id_news=".$news['id_news']."&start=$start>".$news['name']."</a><br>".nl2br($news['body'])." ". $news_url." </td>
              <td><p>".$url_pict."</p></td>
              <td align=center>".$showhide."</td>
              <td align=center><p><a href=delnews.php?start=$start&id_news=".$news['id_news']." title='������� �������'>�������</a></td>
              <td align=center><p><a href=editnewsform.php?start=$start&id_news=".$news['id_news']." title='������������� ����� �������'>���������</a></td>
            </tr>";
    }
    echo "</table>";
  }
  else puterror("������ ��� ��������� � ����� ��������");

  // ������������ ���������
  $page_link = 4;
  $query = "SELECT COUNT(*) FROM news";
  $tot = mysql_query($query);

  $total = mysql_result($tot,0);
  $number = (int)($total/$all_number_news);
  if((float)($total/$all_number_news) - $number != 0) $number++;
  echo "<br><table><tr><td><p>";
  // ��������� ���� �� ������ �����
  if($page - $page_link > 1)
  {
    echo "<a href=$_SERVER[PHP_SELF]?page=1>[1-$all_number_news]</a>&nbsp;&nbsp;...&nbsp;";
    // ����
    for($i = $page - $page_link; $i<$page; $i++)
    {
        echo "&nbsp;<a href=$_SERVER[PHP_SELF]?page=".$i.">[".(($i - 1)*$all_number_news + 1)."-".$i*$all_number_news."]</a>&nbsp;";
    }
  }
  else
  {
    // ���
    for($i = 1; $i<$page; $i++)
    {
        echo "&nbsp;<a href=$_SERVER[PHP_SELF]?page=".$i.">[".(($i - 1)*$all_number_news + 1)."-".$i*$all_number_news."]</a>&nbsp;";
    }
  }
  // ��������� ���� �� ������ ������
  if($page + $page_link < $number)
  {
    // ����
    for($i = $page; $i<=$page + $page_link; $i++)
    {
      if($page == $i)
        echo "&nbsp;[".(($i - 1)*$all_number_news + 1)."-".$i*$all_number_news."]&nbsp;";
      else
        echo "&nbsp;<a href=$_SERVER[PHP_SELF]?page=".$i.">[".(($i - 1)*$all_number_news + 1)."-".$i*$all_number_news."]</a>&nbsp;";
    }
    echo "&nbsp;...&nbsp;<a href=$_SERVER[PHP_SELF]?page=$number>[".(($number - 1)*$all_number_news + 1)."-$total]</a>&nbsp;";
  }
  else
  {
    // ���
    for($i = $page; $i<=$number; $i++)
    {
      if($number == $i)
      {
        if($page == $i)
          echo "&nbsp;[".(($i - 1)*$all_number_news + 1)."-$total]&nbsp;";
        else
          echo "&nbsp;<a href=$_SERVER[PHP_SELF]?page=".$i.">[".(($i - 1)*$all_number_news + 1)."-$total]</a>&nbsp;";
      }
      else
      {
        if($page == $i)
          echo "&nbsp;[".(($i - 1)*$all_number_news + 1)."-".$i*$all_number_news."]&nbsp;";
        else
          echo "&nbsp;<a href=$_SERVER[PHP_SELF]?page=".$i.">[".(($i - 1)*$all_number_news + 1)."-".$i*$all_number_news."]</a>&nbsp;";
      }
    }
  }
  echo "</td></tr></table>";
  // ������� ���������� ��������
  include "../util/bottomadmin.php";
?>