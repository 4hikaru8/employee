<?php
	// トークンのチェック
	require_once 'check/token_checker.php';
	// ファイルの読み込み
	require_once __DIR__ . '/dataaccess/employeePDO.php';

	// IDの入力チェック
	require_once __DIR__ . '/check/input_checker.php';
	id_checker($_POST['id']);
?>
<?php 
	$page_name = '社員情報削除ページ';
	require_once __DIR__ . '/inc/header.php'; 	//ヘッダーを読み込む
?>

<?php

	$id = $_POST['id'];

    // データベースに接続
	$dbh = db_open();

    // レコードを削除してメッセージを取得
	$message = delete_employee($dbh, $id);

	// メッセージの表示
    echo $message ;

?>

<?php require_once __DIR__ . '/inc/footer.php';	//フッターを読み込む ?>
