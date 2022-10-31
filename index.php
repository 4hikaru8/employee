<?php
    $page_name = '社員登録ページ';
    require_once 'check/login_checker.php';
    require_once __DIR__ . '/inc/header.php'; 	//ヘッダーを読み込む
?>
<?php
    $token = bin2hex(random_bytes(20));
    $_SESSION['token'] = $token;
?>
    <h2>メインメニュー</h2>
    <main id="index">
        <form method="post" action="employee_list.php">
            <p><input type="submit" value="社員情報一覧を表示する"></p>
        </form>
        <form method="post" action="register.php">
            <p><input type="submit" value="社員登録する"></p>
            <input type="hidden" name="token" value="<?= $token ?>">
        </form>
        <form method="post" action="employee_list.php">
            <p><input type="submit" value="社員情報を更新する表示する"></p>
        </form>
        <form method="post" action="delete_list.php">
            <p><input type="submit" value="社員情報を削除する"></p>
        </form>
    </main>
<?php require_once __DIR__ . '/inc/footer.php';?>