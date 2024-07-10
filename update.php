<!-- 契約情報取得＆編集用PHP（削除リンク含む） -->
<?php

// SESSIONスタート
session_start();
// 関数ファイル呼び出し
require_once('funcs.php');
//LOGINチェック
sscheck();

// GETでid取得
$id = $_GET['id'];

// DB接続
$pdo = db_conn();

//更新SQL
$stmt = $pdo->prepare('SELECT * FROM gs_cm_data WHERE id = :id;');
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

// データ表示
$view = '';
if ($status === false) {
    sql_error($stmt);
} else {
    $result = $stmt->fetch();
}
?>

<?php include("head.php");?>

<!-- 編集画面  -->
<div class="edit_wrap">
    <h2>契約情報編集・削除</h2>
    <form action="update_done.php" method="post" class="input_form">
        <div class="input_item">
            <label for="up_sname">サービス名</label>
            <input type="text" name="sname" id="up_sname" class="inputarea" value="<?= h($result['sname']) ?>">
        </div>
        <div class="input_item">
            <label for="up_url">サービスURL</label>
            <input type="url" name="url" id="up_url" class="inputarea" value="<?= h($result['url']) ?>">
        </div>
        <div class="input_item">
            <label for="up_mail">メールアドレス</label>
            <input type="email" name="mail" id="up_mail" class="inputarea" value="<?= h($result['mail']) ?>">
        </div>
        <div class="input_item">
            <label for="up_plan">利用プラン</label>
            <input type="text" name="plan" id="up_plan" class="inputarea" value="<?= h($result['plan']) ?>">
        </div>
        <div class="input_item">
            <label for="up_payment">支払有無</label>
            <select name="payment" id="up_payment" class="inputarea">
                <option value="無料" <?php if( $result['payment'] == "無料") echo "selected" ?>>無料</option>
                <option value="月払い" <?php if( $result['payment'] == "月払い") echo "selected" ?>>月払い</option>
                <option value="年払い" <?php if( $result['payment'] == "年払い") echo "selected" ?>>年払い</option>
                <option value="その他" <?php if( $result['payment'] == "その他") echo "selected" ?>>その他</option>
            </select>
        </div>
        <div class="input_item">
            <label for="up_note">補足</label>
            <input type="text" name="note" id="up_note" class="inputarea" value="<?= h($result['note']) ?>">
        </div>
        <div class="input_item testradio">
            <div>色選択</div>
            <div class="colors">
                <input type="radio" name="color" id="pink" value="pink" <?php if( $result['color'] == "pink"){echo 'checked';}else{echo 'class="db_unchecked"';} ?>>
                <label for="pink"><span class="color pink"></span></label>
                <input type="radio" name="color" id="yellow" value="yellow" <?php if( $result['color'] == "yellow"){echo 'checked';}else{echo 'class="db_unchecked"';} ?>>
                <label for="yellow"><span class="color yellow"></span></label>
                <input type="radio" name="color" id="green" value="green" <?php if( $result['color'] == "green"){echo 'checked';}else{echo 'class="db_unchecked"';} ?>>
                <label for="green"><span class="color green"></span></label>
                <input type="radio" name="color" id="blue" value="blue" <?php if( $result['color'] == "blue"){echo 'checked';}else{echo 'class="db_unchecked"';} ?>>
                <label for="blue"><span class="color blue"></span></label>
                <input type="radio" name="color" id="purple" value="purple" <?php if( $result['color'] == "purple"){echo 'checked';}else{echo 'class="db_unchecked"';} ?>>
                <label for="purple"><span class="color purple"></span></label>
                <input type="radio" name="color" id="gray" value="gray" <?php if( $result['color'] == "gray"){echo 'checked';}else{echo 'class="db_unchecked"';} ?>>
                <label for="gray"><span class="color gray"></span></label>
            </div>
        </div>
        <div>
            <!-- 更新とキーになるidを渡す/表示は隠す-->
            <input type="hidden" name="id" value="<?= h($result['id']) ?>">
            <input type="submit" value="更新" id="update" class="submit_btn">
        </div>
        <div class="other_btn_wrap">
            <a href="delete.php?id=<?= h($result['id']) ?>" class="delete_btn">削除</a>
            <a class="back_btn2" href="main.php">戻る</a>
        </div>
    </form>
</div>

<?php include("foot_others.html");?>