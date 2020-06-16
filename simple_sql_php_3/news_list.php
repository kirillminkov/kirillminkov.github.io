<?php
	include("/db_connection.php"); // подключаемся с бд
	// получаем id категории, для которой нужно вывести новости
	// id передается в урле
	// если в урле ни чего не передалось, то выведем новости всех категорий
	// Не забадте проверять, то что передаета в запрос. 
	// Я делаю без проверок, чтобы не усложнять код
	if(isset($_GET['cat_id'])){
		$sqlQuery = "
			SELECT * FROM `news` 
				WHERE `id_category` = ".$_GET['cat_id'].";
		";
	}else{
		$sqlQuery = "
			SELECT * FROM `news`;
		";
	}
	// делаем запрос к бд и получаем новости
	$sql = mysql_query($sqlQuery) or die(mysql_error());
	$rows = array();
	while($r = mysql_fetch_array($sql, MYSQL_ASSOC)){
		$rows[] = $r;
	}
	
	/* 
	* вывод списка новостей
	* в списке сразу создаем ссылку на страницу,
	* где будет отображаться полная новость
	*/
	foreach($rows as $row){
?>
	<h1><?php echo $row['title']; ?></h1>
	<p><?php echo $row['small_text']; ?></p>
	<h3>Author: <?php echo $row['author']; ?></h3>
	<a href="/news.php?id=<?php echo $row['id']; ?>">Read more</a>
	<hr/>
<?php }?>