<?php
  ///////////////////////////////////////////////////
  // ���� "�������"
  // 2003-2006 (C) IT-������ SoftTime (http://www.softtime.ru)
  // �������� �.�. (simdyanov@softtime.ru)
  // ������� �.�. (softtime@softtime.ru)
  ///////////////////////////////////////////////////
  // ���������� ������� ��������� ������ (http://www.softtime.ru/info/articlephp.php?id_article=23)
  Error_Reporting(E_ALL & ~E_NOTICE); 
?>
<table border="0" width="100%" cellpadding="15px" cellspacing="5px">
    <tr valign="top">
        <td style="border-style: solid; border-width: 1px" align="center" width=25%>
            <?
                include "index.php";
            ?>
        </td>
        <td style="border-style: solid; border-width: 1px">
            <h1 class=namepage>�������</h1>
            <?
                if (isset($_GET['id_news'])){
            ?>                                      
            <p class="link"><a href="news.php" class="link">�������� ��� �������</a></p>
            <?
                }
            ?>



<?php
  // �������������� ���������� � ����� ������
  require_once("config.php");

  // ��������� �������� page, ������������ SQL-��������
  if(!preg_match("|^[\d]*$|",$_GET['page'])) puterror("������ ��� ��������� � ����� ��������");
  // ��������� ���������� $page, ������ ����������� ������ ������ ������� �� ��������
  $page = $_GET['page'];
  if(empty($page)) $page = 1;
  $begin = ($page - 1)*$all_number_news;

  // ������ �� ������������ ��������
  if(!preg_match("|^[\d]*$|",$_GET['id_news'])) puterror("������ ��� ��������� � ����� ��������");

  // ����������� ������� id_news (��� ������ ���� ������� hide='show')
  // ���� ������� ������� ��������� ���� ��������� ������� ���������� ������ ���� �������
  if(isset($_GET['id_news']))
  {
    $query = "SELECT * FROM news WHERE hide='show' AND id_news=".$_GET['id_news'];
  }
  // ���� �������� id_news �� ���������� - ������� ��� �������
  else
  {
    $query = "SELECT id_news,
                   name,
                   body,
                   DATE_FORMAT(putdate,'%d.%m.%Y') as putdate_format,
                   url,
                   url_text,
                   url_pict,
                   hide
              FROM news 
              WHERE hide='show' AND putdate <= NOW()
              ORDER BY putdate DESC 
              LIMIT $begin, $all_number_news";
  }
  $new = mysql_query($query);
  if (!$new) puterror("������ ��� ��������� � ����� ��������");
  if(mysql_num_rows($new) > 0)
  {
    while($news = mysql_fetch_array($new))
    {
        // ������� ��������� �������
        echo "<p class='zagnews'>".$news['name']."&nbsp;&nbsp;<em class=datanews>".$news['putdate_format']."</em></p>";    // ������� ���� ������� ������� �������         

        // ������� ���� ������� �������� ������� 
        // �������� ������ � ��� <br>
        echo "<p class='text'>";
        // ������� �����������
        if(trim($news['url_pict']) != "" && trim($news['url_pict']) != "-")
        echo "<img align=right class=img src=".$news['url_pict'].">";
        
        echo nl2br($news['body'])."</p>";
        
        // ������� URL
        if(trim($news['url']) != "" && trim($news['url']) != "-")
        echo "<p class='linkr'><a class='link' href=".$news['url'].">".$news['url_text']."</a></p>";        
    }
  }

  // ������������ ���������
  $page_link = 4;
  $query = "SELECT COUNT(*) FROM news WHERE hide='show' AND putdate <= NOW()";
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
?>
        </td>   
    </tr>
</table>