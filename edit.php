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
    id_checker($_GET['id']);


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
<?php 
    $page_name = '社員情報更新ページ';
    require_once 'inc/header.php'; 	//ヘッダーを読み込む
?>

    <section id="main">
        <form action="update.php" method="post">
            <p>
                <label for="name">氏名:</label>
                <input type="text" name="name" value="<?= $name ?>">
            </p>
            <p>
                <label for="bkcode">所属:</label>
                <input type="text" name="bkcode" value="<?= $bkcode ?>">
            </p>
            <p>
                <label for="position">役職:</label>
                <input type="text" name="position" value="<?= $position ?>">
            </p>
            <p>
                <label for="gender">性別:</label>
                <?php
                if ($gender === 1) {
                    $radio = '<p><input type="radio" name="gender" value="1" checked> 男</p>
                            <p><input type="radio" name="gender" value="2"> 女</p>';
                    echo $radio;
                } else {
                    $radio = '<p><input type="radio" name="gender" value="1"> 男</p>
                            <p><input type="radio" name="gender" value="2" checked> 女</p>';
                    echo $radio;
                }
                ?>
            </p>
            <p>
                <label for="hasfe">基本情報処理資格:</label>
                <?php
                // 基本情報処理資格の有無を判断してラジオボタンで表示
                if ($hasfe === 1) {
                    $radio = '<p><input type="radio" name="hasfe" value="1" checked> 有</p>
                            <p><input type="radio" name="hasfe" value="0"> 無</p>';
                    echo $radio;
                } else {
                    $radio = '<p><input type="radio" name="hasfe" value="1"> 有</p>
                            <p><input type="radio" name="hasfe" value="0" checked> 無</p>';
                    echo $radio;
                }
				?>
            </p>
            <p>
                <label for="hasap">応用情報処理資格:</label>
                <?php
                // 応用情報処理資格の有無を判断してラジオボタンで表示
                if ($hasap === 1) {
                    $radio = '<p><input type="radio" name="hasap" value="1" checked> 有</p>
                            <p><input type="radio" name="hasap" value="0"> 無</p>';
                    echo $radio;
                } else {
                    $radio = '<p><input type="radio" name="hasap" value="1"> 有</p>
                            <p><input type="radio" name="hasap" value="0" checked> 無</p>';
                    echo $radio;
                }
				?>
                <label for="hire_date">入社年月日:</label>
                <input type="date" name="hire_date" value="<?= $hire_date ?>">
            </p>
            
            <p class="button">
            
                <?php // 隠しフフィールド ?>
                <input type="hidden" name="id" value="<?= $_GET['id'] ?>">
                <input type="hidden" name="password" value="<?= $password ?>">
                <input type="hidden" name="token" value="<?= $token ?>">
                <input type="submit" value="送信する">
            </p>
        </form>
    </section>

<?php require_once  'inc/footer.php';	//フッターを読み込む ?>