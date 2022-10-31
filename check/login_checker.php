<?php
if(!isset($_SESSION)) {
    session_start();
}
if(empty($_SESSION['login'])) {
    header('Location: login.php');
}
echo "<!-- ログイン中-->";
// header('Location: index.php');
