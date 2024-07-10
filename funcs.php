<!-- 関数まとめPHP -->
<?php
// 関数化したものを格納

// SESSION確認
function sscheck(){
    if(!isset($_SESSION["chk_ssid"]) || $_SESSION["chk_ssid"]!=session_id()){

        $_SESSION["error_msg"] = "ログインしてください";
        header('Location: index.php');
        exit(); //処理を止める ここから下は処理されない

    }else{
        session_regenerate_id(true);
        $_SESSION["chk_ssid"] = session_id();
      
    }
}

// DB接続関数
function db_conn(){
    try {
        $pdo = new PDO('mysql:dbname=chisaxworks_gs_kadai_php;charset=utf8;host=mysql635.db.sakura.ne.jp','chisaxworks','');
        return $pdo;
    
    } catch (PDOException $e) {
        exit('DBConnectError:'.$e->getMessage());
    
    }
}

// XSS対策（echoする場所で使用）
function h($str){
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

// SQLエラー関数
function sql_error($stmt){
    $error = $stmt->errorInfo();
    exit('SQLError:' . print_r($error, true));

}

// OGPを取得する関数を切り出す
function getOgpImg($url, $cache) {

    // URLからHTMLを取得
    $html = file_get_contents($url);
    if ($html === false) {
        throw new Exception('Error fetching the URL');
    }

    // DOMDocumentを使用してHTMLを解析
    $doc = new DOMDocument();
    @$doc->loadHTML($html);
    
    $metaTags = $doc->getElementsByTagName('meta');
    $ogpImg = '';
    foreach ($metaTags as $meta) {
        if ($meta->getAttribute('property') == 'og:image') {
            $ogpImg = $meta->getAttribute('content');
            break;
        }
    }

    // キャッシュに保存
    $cache[$url] = $ogpImg;
    
    return $ogpImg;
}

?>