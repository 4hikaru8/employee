<?php
// 性別の読み替え
function gender_replacement($gender): string
{
    // 「1」は男性、「2」は女性として$genderを返す
    if ($gender == "1") {
        $gender = "男性";
    }
    if ($gender == "2") {
        $gender = "女性";
    }
    return $gender;
}

// 基本情報処理資格の読み替え
function hasfe_replacement($hasfe): string
{
    // 「0」は無、「1」は有として$hasfeを返す
    if ($hasfe == "0") {
        $hasfe = "無";
    }
    if ($hasfe == "1") {
        $hasfe = "有";
    }
    return $hasfe;
}

// 応用情報処理資格の読み替え
function hasap_replacement($hasap): string
{
    // 「0」は無、「1」は有として$hasapを返す
    if ($hasap == "0") {
        $hasap = "無";
    }
    if ($hasap == "1") {
        $hasap = "有";
    }
    return $hasap;
}
