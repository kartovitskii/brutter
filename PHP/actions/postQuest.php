<?
include '../config.php'; 
if ($_COOKIE['id']) {
    $id_user = $_COOKIE['id'];
    
$id_test = $_POST['id'];
$ansArr = $_POST['ansArr'];

if($id_test && $ansArr) {
    $questions = $link->query("SELECT * FROM `questions` WHERE `test_id` = '$id_test'");
    $countRightAns = 0;
    $iteration = 0;

   while($question = $questions->fetch_assoc()) {
            if ($ansArr[$iteration] == $question['true_ans']) {
                $countRightAns++;
            }
            $iteration++;
        }
        
    $perRightAns = $countRightAns / $iteration;

    if ($perRightAns >= 0.9) {
        $mark = 5;
    } else if ($perRightAns >= 0.75) {
        $mark = 4;
    } else if ($perRightAns >= 0.5) {
        $mark = 3;
    } else {
        $mark = 2;
    }

    $date = date('d.m.yy');
    $link->query("INSERT INTO `marks` VALUES(NULL, '$id_test', '$id_user', '$mark', '$date')");
    $status = 'Выполнено';
    $link->query("INSERT INTO `status_test` VALUES(NULL, '$status', '$id_user', '$id_test')");
}
} else {
    header('Location: /auth.php');
}
?>