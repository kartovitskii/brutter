<? 
include '../config.php';

    if ($_COOKIE['id']) {
        $id = $_POST['id'];

        $questions = $link->query("SELECT * FROM `questions` WHERE `test_id` = '$id'");

        while($question = $questions->fetch_assoc()) {
            $out['title'][] = $question['title'];
            $out['description'][] = $question['description'];
            $out['ans1'][] = $question['ans1'];
            $out['ans2'][] = $question['ans2'];
            $out['ans3'][] = $question['ans3'];
            $out['ans4'][] = $question['ans4'];
            $out['trueAns'][] = $question['true_ans'];
        } 

        $videos = $link->query("SELECT * FROM `lessons` WHERE `id` = '$id'");
        
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