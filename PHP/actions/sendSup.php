<?
include '../config.php'; 

$id = $_COOKIE['id'];

$theme = $_POST['theme'];
$problem = $_POST['problem'];

    $link->query("INSERT INTO `support` VALUES(NULL, '$id',  '$theme', '$problem')");

?>