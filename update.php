<?php
    //セッションの開始とトークンの実装
	require_once 'check/token_checker.php';
?>
<?php 

	// ファイルの読み込み
	require_once __DIR__ . '/dataaccess/employeePDO.php';

	// IDの入力チェック
	require_once __DIR__ . '/check/input_checker.php';
	id_checker($_POST['id']);
	$page_name = '社員情報更新ページ';
	require_once __DIR__ . '/inc/header.php'; 	//ヘッダーを読み込む
?>

<?php

    // フォームから取得した各値の代入
	id_checker($_POST['id']);
	password_checker($_POST['password']);
	name_checker($_POST['name']);
	bkcode_checker($_POST['bkcode']);
	position_checker($_POST['position']);
	gender_checker($_POST['gender']);
	hasfe_checker($_POST['hasfe']);
	hasap_checker($_POST['hasap']);
	hire_date_checker($_POST['hire_date']);

    $id = $_POST['id'];
	$password = $_POST['password'];
	$name = $_POST['name'];
	$bkcode = $_POST['bkcode'];
	$position = $_POST['position'];
	$gender = $_POST['gender'];
	$hasfe = $_POST['hasfe'];
	$hasap = $_POST['hasap'];
	$hire_date = $_POST['hire_date'];


    // データベースに接続
	$dbh = db_open();

    // データベースにレコードを追加してメッセージを取得
	$message = update_employee($dbh, $id, $password, $name, $bkcode, $position, $gender, $hasfe, $hasap, $hire_date);

	// メッセージの表示
    echo $message ;

?>

<?php require_once __DIR__ . '/inc/footer.php';	//フッターを読み込む ?>
