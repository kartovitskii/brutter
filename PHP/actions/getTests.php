<? 
include '../config.php';

    if ($_COOKIE['id']) {
        $id = $_COOKIE['id'];
        $users = $link->query("SELECT `group_id` FROM `users` WHERE `id` = '$id' LIMIT 1");

        while($item = $users->fetch_assoc()) {
            $numberGroup = $item['group_id'];
        }

        $tests = $link->query("SELECT * FROM `tests` WHERE `group_id` = '$numberGroup'");

        while($test = $tests->fetch_assoc()) {
            $out['name'][] = $test['name'];
            $out['timer'][] = $test['timer'];
            $out['id'][] = $test['id'];
        } 

     $status = $link->query("SELECT * FROM `status_test` WHERE `user_id` = '$id'");
        
     while($sts = $status->fetch_assoc()) {
        $out['status'][] = $sts['status'];
        $out['testId'][] = $sts['test_id'];

    } 

    $videos = $link->query("SELECT * FROM `lessons` WHERE `group_id` = '$numberGroup'");
        
    while($video = $videos->fetch_assoc()) {
        $out['vid'][] = $video['id'];
       $out['vtitle'][] = $video['title'];
       $out['vurl'][] = $video['url'];
       $out['vdescription'][] = $video['description'];
   } 


        header("Content-Type: text/json; charset=utf-8");
        echo json_encode($out);

    } else {
        header('Location: /auth.php');
    }

?>