<?
include '../config.php'; 

$password = $_POST['password'];
$email = $_POST['email'];


if($password && $email) {
   $selectUsers = $link->query("SELECT * FROM `users` WHERE `email` = '$email' LIMIT 1");
   while($item = $selectUsers->fetch_assoc()) {
       if($item['password'] === $password) {
           setcookie("id", $item['id'], time() + 50000, '/');
           echo 1;
           return;
       }
    } 
    echo 0;
}
?>