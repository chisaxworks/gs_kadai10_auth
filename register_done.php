<!-- ユーザ登録処理＆完了表示PHP -->
<?php

// SESSIONスタート
session_start();

// POSTデータ取得
$reg_username = $_POST["reg_username"];
$reg_usermail = $_POST["reg_usermail"];
$reg_pw = $_POST["reg_password"];
// PWハッシュ化
$pwhash = password_hash($reg_pw, PASSWORD_DEFAULT); 

// 関数ファイル呼び出し
require_once('funcs.php');
//PHPからDB接続
$pdo = db_conn();

// データ有無取得SQL（ユーザテーブル）そのメールアドレスで有効なユーザ登録があるか
$stmt1 = $pdo->prepare('SELECT COUNT(*) FROM gs_cm_user WHERE usermail = :reg_usermail AND life_flg = 1');
$stmt1->bindValue(':reg_usermail', $reg_usermail, PDO::PARAM_STR);
$status1 = $stmt1->execute();

if($status1 === false){
  sql_error($stmt1);
}

$val = $stmt1->fetch();

// データ（同じメールアドレスかつ有効）があったらアラートを出す
if($val[0] == 1){
  $_SESSION["error_msg"] = "そのメールアドレスは既に登録されています";
  header('Location: register.php');

}else{
  // メールアドレスがない、または、メールアドレスあるが有効ではない
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

}