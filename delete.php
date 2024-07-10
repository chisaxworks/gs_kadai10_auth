<!-- 契約情報削除処理＆完了表示PHP -->
<?php

// SESSIONスタート
session_start();
// 関数ファイル呼び出し
require_once('funcs.php');
//LOGINチェック
sscheck();

//GETデータ取得
$id = $_GET['id'];

//DB接続します
$pdo = db_conn();

//SQLでデータ取得（削除しました表示で使用するため）
$stmt1 = $pdo->prepare('SELECT sname, color FROM gs_cm_data WHERE id = :id');
$stmt1->bindValue(':id', $id, PDO::PARAM_INT);
$status1 = $stmt1->execute();
//データ取得処後
if ($status1 === false) {
    sql_error($stmt1);
} else {
    $result = $stmt1->fetch();
}

//データ削除SQL作成
$stmt2 = $pdo->prepare(
    'DELETE FROM gs_cm_data WHERE id = :id;'
);

$stmt2->bindValue(':id', $id, PDO::PARAM_INT);
$status2 = $stmt2->execute(); //実行

//データ削除処理後
if ($status2 === false) {
    sql_error($stmt2);
}

?>

<?php include("head.php");?>
<div class="done_wrap">
    <h2>以下のサービス情報を削除しました</h2>
      <div class="done">
          <p><span>サービス名</span><?= h($result['sname']) ?></p>
      </div>
    <a class="back_btn" href="main.php">戻る</a>
</div>
<?php include("foot_others.html");?>

<!-- 背景色処理 -->
<script>
  const bgColor = "<?= h($result['color']) ?>"
  $(".done").addClass(bgColor);
</script>