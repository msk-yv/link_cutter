<?php 
//header("Content-type: text/plain; charset=utf8");
//header("Cache-Control: no-store, no-cache, must-revalidate");
//header("Cache-Control: post-check=0, pre-check=0", false);
//sleep(1);

echo $_POST['to_cut']."<br/>";
$link = htmlspecialchars($_POST['to_cut']);
require_once('database.php');
$db = db_connect();
//$query = ;
$select = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM short WHERE url='".$link."'"));
//echo $select['url'];
if (!$select){
    $h = "QqWwEeRrTtYyUuIiOoPpAaSsDdFfGgHhJjKkLlZzXxCcVvBbNnMm1234567890"; //Выбираем символы, из которых будет состоять наш рандом
    $rand = substr(str_shuffle($h), 0, 6); //создаём ранд. Цифра 5 обозначает длину ранда
    while ($select_test = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM short WHERE random_str='".$rand."'"))){
        $rand = substr(str_shuffle($h), 0, 6);
    }
   
    mysqli_query($db, "INSERT INTO `short_url`.`short` (`url`, `random_str`) VALUES ('".$link."', '".$rand."')");
    $select = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM short WHERE url='".$link."'"));
}
$url_a = "http://".$_SERVER['HTTP_HOST']."/-".$select['random_str'];
echo $url_a;        
exit();
?>