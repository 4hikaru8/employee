<?php
    //セッションの開始とトークンの実装
    require_once 'check/login_checker.php';
    $token = bin2hex(random_bytes(20));
    $_SESSION['token'] = $token;
?>
<?php
    //ファイルの読み込み
    require_once 'dataaccess/employeePDO.php';

	$page_name = '社員登録ページ';
	require_once __DIR__ . '/inc/header.php'; 	//ヘッダーを読み込む
?>

<section id="main">
    <form action="insert.php" method="post">
        <p>
            <label for="id">社員ID:</label>
            <input type="text" name="id" placeholder="00000">
        </p>
        <p>
            <label for="password">パスワード:</label>
            <input type="password" name="password" placeholder="「PASS」+ 数字4桁">
        </p>
        <p>
            <label for="name">氏名:</label>
            <input type="text" name="name" placeholder="山田　太郎">
        </p>
        <p>
            <label for="bkcode">所属:</label>
            <input type="text" name="bkcode" placeholder="A6M01">
        </p>
        <p>
            <label for="position">役職:</label>
            <input type="text" name="position" placeholder="MG">
        </p>
        <p>
            <label for="gender">性別:</label>
        </p>
        <p><input type="radio" name="gender" value="1"> 男</p>
        <p><input type="radio" name="gender" value="2"> 女</p>
        </p>
        <p>
            <label for="hasfe">基本情報処理資格:</label>
        </p>
        <p><input type="radio" name="hasfe" value="0"> 無</p>
        <p><input type="radio" name="hasfe" value="1"> 有</p>
        <p>
            <label for="hasap">応用情報処理資格:</label>
        </p>
        <p><input type="radio" name="hasap" value="0"> 無</p>
        <p> <input type="radio" name="hasap" value="1"> 有</p>
        <p>
            <label for="hire_date">入社年月日:</label>
        </p>
        <p><input type="date" name="hire_date" value="<?php echo date('Y-m-d');?>"></p>
        <p class="button">
            <input type="hidden" name="token" value="<?= $token ?>">
            <input type="submit" value="社員登録">
        </p>
    </form>
</section>


<?php require_once __DIR__ . '/inc/footer.php';