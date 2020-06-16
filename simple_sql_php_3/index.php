<?php
    include("/db_connection.php"); // подключаемся с бд
    // получаем список категори
    // и отсортируем по алфавиту
    $sql = mysql_query("
        SELECT * FROM `category` 
            ORDER BY `name` ASC;
    ") or die(mysql_error());
    $rows = array();
    while($r = mysql_fetch_array($sql, MYSQL_ASSOC)){
        $rows&#91;&#93; = $r;
    }
     
    /* 
    * вывод списка категорий
    * в списке сразу создаем ссылку на страницу,
    * где будет отображаться список статей той или иной категории
    */
    foreach($rows as $row){
?>
    <a href="/news_list.php?cat_id=<?php echo $row&#91;'id'&#93;; ?>"><?php echo $row&#91;'name'&#93;; ?></a>
    <br>
<?php }?>