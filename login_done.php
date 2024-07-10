<!-- ログイン処理PHP（リダイレクト） -->
<?php

// SESSIONスタート
session_start();

// POSTデータ取得
$usermail = $_POST["usermail"];
$pw = $_POST["password"];

// 関数ファイル呼び出し
require_once('funcs.php');
//PHPからDB接続
$pdo = db_conn();

// データ取得SQL（ユーザテーブル）
$stmt = $pdo->prepare('SELECT * FROM gs_cm_user WHERE usermail = :usermail AND life_flg = 1');
$stmt->bindValue(':usermail', $usermail, PDO::PARAM_STR);
$status = $stmt->execute();

// エラーハンドリング
if($status === false){
    sql_error($stmt);
}

// データ取得（1レコード）
$val = $stmt->fetch();

if(!$val){
    // userデータなし
    $_SESSION["error_msg"] = "ユーザ情報がありません";
    header('Location: index.php');

}else if($val["life_flg"] == 0){
    // life_flgが0のユーザはログインできない
    $_SESSION["error_msg"] = "有効なユーザ情報がありません";
    header('Location: index.php');

}else{
    //パスワード比較
    $pwcheck = password_verify($pw, $val['password']);
    if($pwcheck){ 
        //ログイン成功時
        $_SESSION["chk_ssid"] = session_id();
        $_SESSION["userid"] = $val["id"];
        $_SESSION["username"] = $val["username"];
        $_SESSION["usermail"] = $val["usermail"];

        header('Location: main.php');
    }else{
        //ログイン失敗時
        $_SESSION["error_msg"] = "パスワードが間違っています";
        header('Location: index.php');
    }
}

exit();