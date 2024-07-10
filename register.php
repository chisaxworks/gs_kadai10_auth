<!-- ユーザ登録FORM -->
<?php include("head_logout.php");?>

<!-- ユーザ画面 -->
<div class="logreg_wrap">
    <h2>ユーザ登録画面</h2>
    <form action="register_done.php" method="post" class="input_form">
        <div class="input_item">
            <label for="reg_username">名前</label>
            <input type="text" name="reg_username" id="reg_username" class="inputarea">
        </div>
        <div class="input_item">
            <label for="reg_usermail">メール</label>
            <input type="email" name="reg_usermail" id="reg_usermail" class="inputarea">
        </div>
        <div class="input_item">
            <label for="reg_password">パスワード</label>
            <input type="password" name="reg_password" id="reg_password" class="inputarea">
        </div>
        <button type="submit" id="register" class="submit_btn">登録</button>
    </form>
    <a href="index.php" class="tologreg_btn">ログイン画面に戻る</a>
</div>

<?php include("foot_others.html");?>