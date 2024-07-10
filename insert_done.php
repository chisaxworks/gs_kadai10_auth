<!-- 契約情報登録処理＆完了表示PHP -->
<?php

// SESSIONスタート
session_start();
// 関数ファイル呼び出し
require_once('funcs.php');
//LOGINチェック
sscheck();

// POSTデータ取得
$sname = $_POST["sname"];
$url = $_POST["url"];
$mail = $_POST["mail"];
$plan = $_POST["plan"];
$payment = $_POST["payment"];
$note = $_POST["note"];
$color = $_POST["color"];

// SESSIONからuserid取得
$userid = $_SESSION["userid"];

// OGP情報取得
  // キャッシュの初期化（このあとキャッシュには格納はするので）
  $ogpCache = [];

  // 実行（同上）
  $ogpImg = getOgpImg($url, $ogpCache);

// PHPからDB接続
$pdo = db_conn();

// データ登録SQL作成

  // 1. SQL文を用意
  $stmt = $pdo->prepare('INSERT INTO
    gs_cm_data(id, sname, url, mail, plan, payment, note, color, ogpimg, userid, createDate, modifyDate)
    VALUES(NULL, :sname, :url, :mail, :plan, :payment, :note, :color, :ogpimg, :userid, now(), now())');

  //  2. バインド変数を用意
  // Integer 数値の場合 PDO::PARAM_INT
  // String文字列の場合 PDO::PARAM_STR

  $stmt->bindValue(':sname', $sname, PDO::PARAM_STR);
  $stmt->bindValue(':url', $url, PDO::PARAM_STR);
  $stmt->bindValue(':mail', $mail, PDO::PARAM_STR);
  $stmt->bindValue(':plan', $plan, PDO::PARAM_STR);
  $stmt->bindValue(':payment', $payment, PDO::PARAM_STR);
  $stmt->bindValue(':note', $note, PDO::PARAM_STR);
  $stmt->bindValue(':color', $color, PDO::PARAM_STR);
  $stmt->bindValue(':ogpimg', $ogpImg, PDO::PARAM_STR);
  $stmt->bindValue(':userid', $userid, PDO::PARAM_STR);

  //  3. 実行
  $status = $stmt->execute();

//データ登録処理後
if($status === false){
  sql_error($stmt);
}

?>
<?php include("head.php");?>
<div class="done_wrap">
    <h2>以下の内容で登録しました</h2>
      <div class="done">
          <p><span>サービス名</span><?= h($sname) ?></p>
          <p><span>サービスURL</span><?= h($url) ?></p>
          <p><span>メール</span><?= h($mail) ?></p>
          <p><span>利用プラン</span><?= h($plan)?></p>
          <p><span>支払有無</span><?= h($payment) ?></p>
          <p><span>備考</span><?= h($note) ?></p>
      </div>
    <a class="back_btn" href="main.php">戻る</a>
</div>
<?php include("foot_others.html");?>

<!-- 背景色処理 -->
<script>
  const bgColor = "<?= h($color) ?>"
  $(".done").addClass(bgColor);
</script>