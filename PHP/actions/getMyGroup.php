<?
include '../config.php'; 

$id = $_COOKIE['id'];

$users = $link->query("SELECT * FROM `users` WHERE `id` = '$id'");

        while($user = $users->fetch_assoc()) {
            $group_id = $user['group_id'];
        } 


$items = $link->query("SELECT * FROM `groups` WHERE `id` = '$group_id'");

while($item = $items->fetch_assoc()) {
    $out['number'][] = $item['number'];
    $out['name'][] = $item['name'];
} 

header("Content-Type: text/json; charset=utf-8");
echo json_encode($out);
?>