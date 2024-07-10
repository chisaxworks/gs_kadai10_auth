<!-- ログアウト画面 -->
<?php
// SESSIONスタート
session_start();

// SESSIONを初期化（空っぽにする）
$_SESSION = array();

// Cookieに保存してある"SessionIDの保存期間を過去にして破棄
if (isset($_COOKIE[session_name()])) { //session_name()は、セッションID名を返す関数
    setcookie(session_name(), '', time()-42000, '/');
}

// サーバ側での、セッションIDの破棄
session_destroy();
?>

<?php include("head_logout.php");?>

<!-- ログアウト画面 -->
<div class="logreg_wrap">
    <h2>ログアウトしました</h2>
    <a href="index.php" class="tologreg_btn">ログイン画面に戻る</a>
</div>

<?php include("foot_others.html");?>