<?php
// SESSIONスタート
session_start();

// 関数ファイル呼び出し
require_once('funcs.php');

// LOGINチェック
sscheck();

// 登録画面から遷移した人はSESSIONにIdを持っていないためそれを格納する作業
$usermail = $_SESSION["usermail"];
if(!isset($_SESSION["userid"])){

    //PHPからDB接続
    $pdo = db_conn();

    // データ取得SQL（ユーザテーブル）
    $stmt = $pdo->prepare('SELECT id FROM gs_cm_user WHERE usermail = :usermail');
    $stmt->bindValue(':usermail', $usermail, PDO::PARAM_STR);
    $status = $stmt->execute();

    // エラーハンドリング
    if($status === false){
    sql_error($stmt);
    }

    // 格納！
    $val = $stmt->fetch();
    $_SESSION["userid"] = $val["id"];
}
echo $_SESSION["userid"];

?>

<?php include("head.php");?>
<?php include("insert.php");?><!-- 登録エリア -->
<?php include("display.php");?><!-- 表示エリア -->
<?php include("foot_main.html");?>