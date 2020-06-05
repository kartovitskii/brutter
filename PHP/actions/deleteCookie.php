<?
setcookie('id', '-1', time() - 50000, '/');
header('Location: /auth.php');
?>