<!-- ユーザ登録処理＆完了表示PHP -->
<?php

// SESSIONスタート
session_start();

// POSTデータ取得
$reg_username = $_POST["reg_username"];
$reg_usermail = $_POST["reg_usermail"];
$reg_pw = $_POST["reg_password"];

$sid = session_id();

// PWハッシュ化
$pwhash = password_hash($reg_pw, PASSWORD_DEFAULT); 

// 関数ファイル呼び出し
require_once('funcs.php');
//PHPからDB接続
$pdo = db_conn();

// データ登録SQL（ユーザテーブル）
$stmt = $pdo->prepare('INSERT INTO
    gs_cm_user(id, username, usermail, password, admin_flg, life_flg, createDate, modifyDate)
    VALUES(NULL, :username, :usermail, :password, 0, 1, now(), now())');

$stmt->bindValue(':username', $reg_username, PDO::PARAM_STR);
$stmt->bindValue(':usermail', $reg_usermail, PDO::PARAM_STR);
$stmt->bindValue(':password', $pwhash, PDO::PARAM_STR);

$status = $stmt->execute();

// データ登録処理後
if($status === false){
  sql_error($stmt);
}

// ログイン成功と同じ処理
$_SESSION["chk_ssid"] = session_id();
$_SESSION["username"] = $reg_username;
$_SESSION["usermail"] = $reg_usermail;

// ログイン後の状態にリダイレクト
header('Location: main.php');