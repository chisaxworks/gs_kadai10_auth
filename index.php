<!-- ログインFORM -->
<?php
// SESSIONスタート
session_start();

// 関数ファイル呼び出し
require_once('funcs.php');

// SESSIONにエラー情報があったら表示する
if(isset($_SESSION["error_msg"])){
    $alert = '<div class="alert">' . $_SESSION['error_msg'] . '</div>';
    // echo '<script>alert("'. $alert .'");</script>';
    unset($_SESSION['error_msg']); // メッセージを表示した後にセッション変数をクリア
}

// LOGINチェック(index専用：SESSION残ってたらmainに移動する)
if(isset($_SESSION["chk_ssid"]) && $_SESSION["chk_ssid"] = session_id()){

    // セッションID払出しし直し
    session_regenerate_id(true);
    $_SESSION["chk_ssid"] = session_id();

    // メインに移動
    header('Location: main.php');
}

?>

<?php include("head_logout.php");?>

<!-- ログイン画面 -->
<div class="logreg_wrap">
    <?= $alert ?>
    <h2>ログイン画面</h2>
    <form action="login_done.php" method="post" class="input_form">
        <div class="input_item">
            <label for="usermail">メール</label>
            <input type="email" name="usermail" id="usermail" class="inputarea">
        </div>
        <div class="input_item">
            <label for="password">パスワード</label>
            <input type="password" name="password" id="password" class="inputarea">
        </div>
        <button type="submit" id="login" class="submit_btn">ログイン</button>
    </form>
    <a href="register.php" class="tologreg_btn">ユーザ登録はこちら</a>
</div>

<?php include("foot_others.html");?>