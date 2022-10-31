<?php
    //セッションの開始とトークンの実装
    require_once 'check/login_checker.php';
    $token = bin2hex(random_bytes(20));
    $_SESSION['token'] = $token;
    ?>
<?php
    //ファイルの読み込み
    require_once 'dataaccess/employeePDO.php';

    // IDの入力チェック
    require_once 'check/input_checker.php';
    require_once __DIR__ . '/check/replacement_checker.php';
    id_checker($_GET['id']);
    $page_name = '社員情報更新ページ';
    require_once 'inc/header.php'; 	//ヘッダーを読み込む
?>
<?php 
    try {
        // 更新したい社員情報の取得
        $result = select_employee(db_open(), $_GET['id']);

        if (!$result) {
            echo "指定したデータはありません。";
            exit;
        }
    } catch (PDOException $e) {
        echo "エラー!: " . stringHTML($e->getMessage()) . "<br>";
        exit;
    }

    // データベースから取得した各値の代入
    $password = $result['password'];
    $name = $result['name'];
    $bkcode = $result['bkcode'];
    $position = $result['position'];
    $gender = $result['gender'];
    $hasfe = $result['hasfe'];
    $hasap = $result['hasap'];
    $hire_date = $result['hire_date'];

?>

    <section id="main">
        <form action="exection.php" method="post">
            <p>
                <label>氏名:<?= $name ?></label>
            </p>
            <p>
                <label>所属:<?= $bkcode ?></label>
            </p>
            <p>
                <label>役職:<?= $position ?></label>
            </p>
            <p>
                <label>性別:<?php echo gender_replacement($gender) ?></label>
            </p>
            <p>
                <label>基本情報処理資格:<?php echo hasfe_replacement($hasfe)	?></label>
            </p>
            <p>
                <label>応用情報処理資格:<?php echo hasap_replacement($hasap)	?></label>
            </p>
            <p>
                <label>入社年月日:<?= $hire_date ?></label>
            </p>
            
            <p class="button">
            
                <?php // 隠しフフィールド ?>
                <input type="hidden" name="id" value="<?= $_GET['id'] ?>">
                <input type="hidden" name="password" value="<?= $password ?>">
                <input type="hidden" name="token" value="<?= $token ?>">
                <input type="submit" value="削除する">
            </p>
        </form>
    </section>

<?php require_once  'inc/footer.php';	//フッターを読み込む ?>