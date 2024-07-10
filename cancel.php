<!-- 退会処理確認画面 -->
<?php
// SESSIONスタート
session_start();

// 関数ファイル呼び出し
require_once('funcs.php');

//LOGINチェック
sscheck();

$cancel_uid = $_SESSION["userid"];

?>

<?php include("head.php");?>
<div class="cancel_wrap">
    <h2>退会画面</h2>
    <!-- <div class="cancel_item">
        <p>データを全て消去します</p>
        <button id="bulk_delete" class="submit_btn">データ一括削除</button>
    </div> -->
    <div class="cancel_item">
        <p>退会する場合は下記のボタンを押してください</p>
        <a href="cancel_done.php?uid=<?= h($cancel_uid) ?>" class="submit_btn">退会処理</a>
    </div>
    <div class="cancel_item">
        <a class="back_btn3" href="main.php">一覧画面に戻る</a>
    </div>
</div>
<?php include("foot_others.html");?>