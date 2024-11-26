<?php
if(!isset($_SESSION)) {
    session_start();
}
$_SESSION['login']='';
header('Location: app/router/router1.php?action=truc');

?>

