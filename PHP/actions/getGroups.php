<?
include '../config.php'; 


$items = $link->query("SELECT * FROM `groups`");

while($item = $items->fetch_assoc()) {
    $out['number'][] = $item['number'];
    $out['name'][] = $item['name'];
} 

header("Content-Type: text/json; charset=utf-8");
echo json_encode($out);
?>