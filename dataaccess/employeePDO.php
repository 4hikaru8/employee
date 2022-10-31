<?php
// データベース接続
function db_open(): PDO{
    $user = 'root';// xserver='benchi_guest'
    $password = '';// xserver='benchguest'
    $opt = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_EMULATE_PREPARES => false,
        PDO::MYSQL_ATTR_MULTI_STATEMENTS => false,
    ];
    try {
        // PDOオブジェクトを生成
        // xserver='mysql:host=localhost;dbname=benchi_jinjidb'
    $dbh = new PDO('mysql:host=localhost;dbname=jinji_db', $user, $password, $opt);

    } catch (PDOException $e) {
        $message = 'エラー!: ' . stringHTML($e->getMessage()) . '<br>';
        return $message;
    }

    // 作成したPDOオブジェクトを返す
    return $dbh;
}

// ユーザIDとパスワードを利用してログイン処理を行う
function login_employee(PDO $dbh, $userID){
    // SQL文を作成して変数に代入
    $sql = 'SELECT password FROM employee WHERE id=:userID';

    // プレースホルダーを含むSQL実行準備
    $stmt = $dbh->prepare($sql);

    // プレースホルダーに引数を代入
    $stmt->bindParam(':userID', $userID, PDO::PARAM_STR); 

    // SQL文の実行
    $stmt->execute();

    // 結果オブジェクトの取得
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    // 結果オブジェクトを返す
    return $result;
}

// 一覧表示(パスワード以外)
function employee_list(PDO $dbh): PDOStatement{
    // SQL文を作成して変数に代入
    $sql = 'SELECT * FROM employee';

    // SQL文の実行
    $statment = $dbh->query($sql);

    // 結果オブジェクトを返す
    return $statment;
}

// 社員の追加
function add_employee(PDO $dbh, string $id, string $password, string $name, string $bkcode, string $position, int $gender, int $hasfe, int $hasap, string $hire_date){
        echo $id;
        // SQL文を作成して変数に代入
        $sql = 'INSERT INTO employee (id, password, name, bkcode, position, gender, hasfe, hasap, hire_date)
                VALUES (:id, :password, :name, :bkcode, :position, :gender, :hasfe, :hasap, :hire_date)';

        // プレースホルダーを含むSQL実行準備
        $stmt = $dbh->prepare($sql);

        // プレースホルダーに引数を代入
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);
        $stmt->bindParam(':password', $password, PDO::PARAM_STR);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':bkcode', $bkcode, PDO::PARAM_STR);
        $stmt->bindParam(':position', $position, PDO::PARAM_STR);
        $stmt->bindParam(':gender', $gender, PDO::PARAM_INT);
        $stmt->bindParam(':hasfe', $hasfe, PDO::PARAM_INT);
        $stmt->bindParam(':hasap', $hasap, PDO::PARAM_INT);
        $stmt->bindParam(':hire_date', $hire_date, PDO::PARAM_STR);

        // SQL文の実行
        $stmt->execute();

        // 文字列を返す
        $message = '<p>データが追加されました。<br><a href="employee_list.php">リストへ戻る</a></p>';
        return $message;
        
}

// 社員IDから1件検索
function select_employee(PDO $dbh, string $id){
    // SQL文を作成して変数に代入
    $sql = 'SELECT * FROM employee WHERE id=:id';

    // プレースホルダーを含むSQL実行準備
    $stmt= $dbh->prepare($sql);

    // プレースホルダーに引数を代入
    $stmt->bindParam(':id', $id);

    // SQL文の実行
    $stmt->execute();

    // 結果オブジェクト取得
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    // 結果オブジェクトを返す
    return $result;
}

// 社員情報の更新
function update_employee(PDO $dbh, string $id, string $password, string $name, string $bkcode, string $position, int $gender, int $hasfe, int $hasap, string $hire_date){

        // SQL文を作成して変数に代入
        $sql = 'UPDATE employee SET password = :password, name = :name, bkcode = :bkcode, 
                                    position = :position, gender = :gender, hasfe = :hasfe, 
                                    hasap = :hasap, hire_date = :hire_date WHERE id = :id';

        // プレースホルダーを含むSQL実行準備
        $stmt = $dbh->prepare($sql);

        // プレースホルダーに引数を代入
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);
        $stmt->bindParam(':password', $password, PDO::PARAM_STR);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':bkcode', $bkcode, PDO::PARAM_STR);
        $stmt->bindParam(':position', $position, PDO::PARAM_STR);
        $stmt->bindParam(':gender', $gender, PDO::PARAM_INT);
        $stmt->bindParam(':hasfe', $hasfe, PDO::PARAM_INT);
        $stmt->bindParam(':hasap', $hasap, PDO::PARAM_INT);
        $stmt->bindParam(':hire_date', $hire_date, PDO::PARAM_STR);

        // SQL文の実行
        $stmt->execute();

        // 結果メッセージを返す
        $message = '正常に更新されました。<br><a href="employee_list.php">リストへ戻る</a></p>';
        
        return $message;
}

// 社員IDからデータを削除
function delete_employee(PDO $dbh, string $id){
    // SQL文を作成して変数に代入
    $sql = 'DELETE FROM employee WHERE id=:id';

    // プレースホルダーを含むSQL実行準備
    $stmt= $dbh->prepare($sql);

    // プレースホルダーに引数を代入
    $stmt->bindParam(':id', $id);

    // SQL文の実行
    $stmt->execute();

    // 文字列を返す
    $message = '<p>データが削除されました。<br><a href="employee_list.php">リストへ戻る</a></p>';
    return $message;
}
