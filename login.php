<?php
  session_start();
	require_once __DIR__ . '/dataaccess/employeePDO.php';
?>
<!doctype html>
<html>
  <head>
    <meta charset="UTF-8">
      <link rel="stylesheet" href="css/reset.css" type="text/css">
      <link rel="stylesheet" href="css/common.css" type="text/css">
    <title>人事システムログインページ</title>
  </head>

  <body>
    <h1>人事システムにようこそ！</h1>
    <form method="post" action="login.php">
      <p>
        <label>ユーザID:</label>
        <input type="text" name="userID">
      </p>
      <p>
        <label>パスワード:</label>
        <input type="password" name="password">
      </p>
      <p>
        <input type="submit" value="ログイン">
      </p>
    </form>
    <?php
      // 入力ホームにユーザー名が入っていない、又はパスワードに何も入っていなければ表示
      if ((empty($_POST['userID'])) || (empty($_POST['password']))) {
        echo 'ユーザーID、パスワードを入力してください。<br>ID：10001　パスワード：PASS0001';
        exit;
      }
      // データベース接続の関数を呼び出して、返り値(PDOオブジェクト)を代入
      $dbh = db_open();
      // login関数で入力された情報と登録されている情報を照会して結果を返す
      $result = login_employee($dbh,$_POST['userID']);

      if (!$result) {
          echo 'ログインに失敗しました。(1)';
          exit;
      }
      // 本当はpassword_veryfy()関数で、ハッシュ化した検証をする方がいいがデモ用に使うために平打ちにしている
      if ($_POST['password'] == $result['password']) {
          // session_regenerate_id()関数で、古いセッションを破棄(通常はECサイトで決済に進むときの二重にセキュリティを掛ける為に使われる。もう一度パスワード入力など)
          session_regenerate_id(true);
          // セッションにログイン情報を残す
          $_SESSION['login'] = true;
          // header()関数でページの自動遷移
          header('Location: index.php');
      }else{
          echo 'ログインに失敗しました。(2)';
      }

    ?>

  </body>
</html>