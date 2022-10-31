<?php
// 入力タグの無効化
function invaliXss(string $str) :string {
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

// IDの入力チェック（未入力不可）
function id_checker($id){
    if (empty($id)) {
        echo "idを指定してください";
        exit;
    }
    if (!preg_match('/\A\d{1,5}+\z/u', $id)) {
        echo "idは数字5桁で入力してください。";
        exit;
    }
}

// 氏名の入力チェック（未入力不可）
function name_checker($name){
    if (empty($name)) {
        echo "氏名の入力は必須です。";
        exit;
    }
    if (!preg_match('/\A[[:^cntrl:]]{1,30}\z/u', $name)) {
        echo "氏名は30文字までで入力してください。";
        exit;
    }
}
// パスワードの入力チェック（未入力不可）
function password_checker($password){
    if (empty($password)) {
        echo "パスワードの入力は必須です。";
        exit;
    }
    if (!preg_match('/\APASS\d{4}\z/u', $password)) {
        echo "パスワードは「PASS」+ 数字4桁で入力してください。";
        exit;
    }
}

// 部課コードの入力チェック
function bkcode_checker($bkcode){
    if (!preg_match('/\A\w{1}\d{1}\w{1}\d{2}\z/u', $bkcode)) {
        echo "部課コードのフォーマットが違います。";
        exit;
    }
}

// 役職の入力チェック
function position_checker($position){
    if (empty($position)) {
        echo "役職が入力されていません。";
        exit;
    }
}

// 性別の入力チェック（未入力不可）
function gender_checker($gender){
    if (empty($gender)) {
        echo "性別が選択されていません。";
        exit;
    }
}

//基本情報処理資格の入力チェック（未入力不可）
function hasfe_checker($hasfe){
    $hasfe = (string)$hasfe;
    if (!($hasfe == '0' or $hasfe == '1')) {
        echo $hasfe . "基本情報処理資格の有無が選択されていません。";
        exit;
    }
}

// 応用情報処理資格の入力チェック（未入力不可）
function hasap_checker($hasap){
    if (!($hasap == '0' or $hasap == '1')) {
        echo $hasap . "応用情報処理資格の有無が選択されていません。";
        exit;
    }
}

// 入社日（未入力不可）
function hire_date_checker($hire_date){
    if (empty($hire_date)) {
        echo "入社年月日の入力は必須です。";
        exit;
    }
    if (!preg_match('/\A\d{4}-\d{1,2}-\d{1,2}\z/u', $hire_date)) {
        echo "日付のフォーマットが違います。";
        exit;
    }
    $date = explode('-', $hire_date);
    if (!checkdate($date[1], $date[2], $date[0])) {
        echo "正しい日付を入力してください。";
        exit;
    }
}
