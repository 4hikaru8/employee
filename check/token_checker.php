<?php
// セッションがセットされていない場合はセッションの開始
if (!isset($_SESSION)) {
    session_start();
}

if (empty($_POST['token'])) {
    echo "ログインエラーが発生しました。";
    exit;
}
if (!(hash_equals($_SESSION['token'], $_POST['token']))) {
    echo "ログインエラーが発生しました。[2]";
    exit;
}