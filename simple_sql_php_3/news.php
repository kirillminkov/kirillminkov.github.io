<?php
	include("/db_connection.php"); // подключаемся с бд
	// получаем id новости которую будем показывать
	// id передается в урле
	// если в урле ни чего не передалось, 
	// то напишем что новость не нашлась
	if(isset($_GET['id'])){
		$sqlQuery = "
			SELECT * FROM `news` 
				WHERE `id` = ".$_GET['id'].";
		";
		// делаем запрос к бд и получаем новости
		$sql = mysql_query($sqlQuery) or die(mysql_error());
		$rows = array();
		while($r = mysql_fetch_array($sql, MYSQL_ASSOC)){
			$rows[] = $r;
		}
		foreach($rows as $row){
?>
		<h1><?php echo $row['title']; ?></h1>
		<p><?php echo $row['text']; ?></p>
		<h3>Author: <?php echo $row['author']; ?></h3>
<?php 
		}
	}else{
		echo "News not found";
	}
?>