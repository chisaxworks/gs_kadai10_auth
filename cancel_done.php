<!-- 退会処理＆完了表示PHP -->
<?php

// SESSIONスタート
session_start();
// 関数ファイル呼び出し
require_once('funcs.php');
//LOGINチェック
sscheck();

// GETデータ取得
$uid = $_GET['uid'];

// DB接続します
$pdo = db_conn();

// SQLでデータ取得（削除しました表示で使用するため）
$stmt1 = $pdo->prepare('SELECT username FROM gs_cm_user WHERE id = :uid');
$stmt1->bindValue(':uid', $uid, PDO::PARAM_INT);
$status1 = $stmt1->execute();
// データ取得処後
if ($status1 === false) {
    sql_error($stmt1);
} else {
    $result = $stmt1->fetch();
}

// データ更新SQL
$stmt2 = $pdo->prepare(
    'UPDATE gs_cm_user SET life_flg = 0, modifyDate = now() WHERE id = :uid;'
);
$stmt2->bindValue(':uid', $uid, PDO::PARAM_INT);
$status2 = $stmt2->execute(); //実行

//データ削除処理後
if ($status2 === false) {
    sql_error($stmt2);
}

// ログアウト処理
sslogout();

?>

<?php include("head_logout.php");?>
<div class="done_wrap">
    <h2><?= h($result['username'])?>さんの退会処理が完了しました</h2>
    <h2>ご利用ありがとうございました</h2>
    <a class="back_btn" href="index.php">サービストップに戻る（ログイン画面）</a>
</div>
<?php include("foot_others.html");?>