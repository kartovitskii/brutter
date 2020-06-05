<?
include '../config.php'; 

$firstName = trim($_POST['firstName']);
$lastName = trim($_POST['lastName']);
$password = $_POST['password'];
$group = $_POST['group'];
$email = $_POST['email'];

$groupNumber = preg_split('/ /', $group)[0];

$tokenGenerate = sprintf(
    '%04X%04X%04X%04X', 
    mt_rand(0, 65535), 
    mt_rand(0, 65535),
    mt_rand(0, 65535),
    mt_rand(16384, 20479)
);

$token = preg_replace("/[^0-9]/", '', $tokenGenerate);

if($firstName && $lastName && $password && $group && $email) {
   $groupNumberRes = $link->query("SELECT `id` FROM `groups` WHERE `number` = '$groupNumber' LIMIT 1");
   while($item = $groupNumberRes->fetch_assoc()) {
    $groupId = $item['id'];
    } 
    $link->query("INSERT INTO `users` VALUES('$token', '$email',  '$password', '$firstName', '$lastName', '$groupId')");
}

$out = array(
    'firstName' => $firstName
);
header("Content-Type: text/json; charset=utf-8");
echo json_encode($out);
?>