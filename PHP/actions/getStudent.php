<? 
include '../config.php';
$id = $_COOKIE['id'];
    if ($_COOKIE['id']) {
        $users = $link->query("SELECT `group_id` FROM `users` WHERE `id` = '$id' LIMIT 1");

        while($item = $users->fetch_assoc()) {
            $numberGroup = $item['group_id'];
        }

        $users = $link->query("SELECT * FROM `users` WHERE `id` = '$id'");

        while($user = $users->fetch_assoc()) {
            $out['first_name'][] = $user['first_name'];
            $out['last_name'][] = $user['last_name'];
        } 

        header("Content-Type: text/json; charset=utf-8");
        echo json_encode($out);

    } else {
        header('Location: /auth.php');
    }

?>