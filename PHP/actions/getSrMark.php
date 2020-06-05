<?
include '../config.php'; 

$id = $_COOKIE['id'];

$marks = $link->query("SELECT * FROM `marks` WHERE `user_id` = '$id' ORDER BY `date`");

while($mark = $marks->fetch_assoc()) {
    $out['mark'][] = $mark['mark'];
    $out['date'][] = $mark['date'];
} 

header("Content-Type: text/json; charset=utf-8");
echo json_encode($out);
?>