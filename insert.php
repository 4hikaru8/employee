<?php
	// トークンのチェック
    require_once 'check/token_checker.php';
    // ファイルの読み込み
    require_once 'dataaccess/employeePDO.php';
    require_once __DIR__ . '/check/input_checker.php';

	$page_name = '社員登録ページ';
	require_once __DIR__ . '/inc/header.php'; 	//ヘッダーを読み込む
?>

<?php
try {

    // フォームから送られた内容の入力チェック
	id_checker($_POST['id']);
	password_checker($_POST['password']);
	name_checker($_POST['name']);
	bkcode_checker($_POST['bkcode']);
	position_checker($_POST['position']);
	gender_checker($_POST['gender']);
	hasfe_checker($_POST['hasfe']);
	hasap_checker($_POST['hasap']);
	hire_date_checker($_POST['hire_date']);

    // フォームから取得した各値の代入
    $id = $_POST['id'];
	$password = $_POST['password'];
	$name = $_POST['name'];
	$bkcode = $_POST['bkcode'];
	$position = $_POST['position'];
	$gender = $_POST['gender'];
	$hasfe = $_POST['hasfe'];
	$hasap = $_POST['hasap'];
	$hire_date = $_POST['hire_date'];

    // データベース接続関数の呼び出し
	$dbh = db_open();

    // 関数を利用したレコードの追加
	$message = add_employee($dbh, $id, $password, $name, $bkcode, $position, $gender, $hasfe, $hasap, $hire_date);

	// メッセージの表示
    echo $message;

} catch (PDOException $e) {
    echo $message;
    exit;
}
?>

<?php require_once __DIR__ . '/inc/footer.php';