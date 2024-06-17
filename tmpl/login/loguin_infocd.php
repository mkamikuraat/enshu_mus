
<?php
$dsn = 'mysql:host=localhost; dbname=mus; charset=utf8';
$user = 'testuser';
$pass = 'testpass';
if (empty($_GET["username"])){
    echo "ユーザー名を正しく入力してください";
    exit;
}
try {
    //$id = (int)$_GET["id"];
    //var_dump($id);
    $dbh = new PDO($dsn, $user, $pass);
    $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    $sql = 'SELECT * FROM  users where username = ?';
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(1, $username, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    //print_r($result);
    echo "変更画面" . "<br>";
    //echo "ID：" . htmlspecialchars($result["id"],ENT_QUOTES) . '<br>' . PHP_EOL;
    // echo "ユーザー名：" . htmlspecialchars($result["username"],ENT_QUOTES) . '<br>' . PHP_EOL;
    // echo "メールアドレス：" . htmlspecialchars($result["mail"],ENT_QUOTES) . '<br>' . PHP_EOL;
    // echo "パスワード：" . htmlspecialchars($result["password"],ENT_QUOTES) . '<br>' . PHP_EOL;
    // echo "名前：" . htmlspecialchars($result["name"],ENT_QUOTES) . '<br>' . PHP_EOL;
    // $gender = '';
    //     if ($result['gender'] == "1") {
    //         $gender = "男性";
    //     } else if ($result['gender'] == "2") {
    //         $gender = "女性";
    //     } else if ($result['gender'] == "3") {
    //         $gender = "無選択";
    //     } else {
    //         $gender = "不明";
    //     }
    //     echo '<td>性別：' . $gender . '</td>' . PHP_EOL;
    //     echo '<br>';
    //echo "性別：" . htmlspecialchars(ENT_QUOTES) . '<br>' . PHP_EOL;
    // echo "生年月日：" . htmlspecialchars($result["dob"],ENT_QUOTES) . '<br>' . PHP_EOL;
    // $address = '';
    //     if ($result['address'] == "1") {
    //         $address = "都内";
    //     } else if ($result['address'] == "2") {
    //         $address = "都外";
    //     } else if ($result['address'] == "3") {
    //         $address = "その他";
    //     } else {
    //         $address = "不明";
    //     }
    //     echo '<td>住所：' . $address . '</td>' . PHP_EOL;
    //echo "住所：" . htmlspecialchars($result["address"],ENT_QUOTES) . '<br>' . PHP_EOL;
    echo '<br>';
    // $terms = '';
    // if ($result['terms'] == "on"){
    //     $terms = "同意しました";
    // }
    // echo '<td>利用規約：' . $terms . '</td>' . PHP_EOL;
    //echo "利用規約：" . htmlspecialchars($result["terms"],ENT_QUOTES) . '<br>' . PHP_EOL;
    $dbh = null;
} catch (PDOException $e) {
    echo "エラー発生：" . htmlspecialchars($e->getMessage(), ENT_QUOTES) . '<br>';
    exit;
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style type="text/css">
        .header {padding-top: 40px; background-image: url(../../../img/stripe.png); background-repeat: repeat-x;}
        body { font-size:100%; background:#f0f0f0; }
        .detail {color: #253958;}
        #title{color:#253958; font-size: 50px; text-align: center;}
        a{text-decoration: none; color: inherit;}
        main h2{border-bottom: 2px solid #253958;}
        .nav ul {margin: 30px 0 0 0; padding: 0; list-style-type: none;
         display: flex; justify-content: center; gap: 40px;}
        .gotop {
            text-align: center; display: flex; justify-content: center;}
        .gotop a img{ width: 100px;}
        .copyright {
            padding-top: 75px;
            padding-bottom: 75px;
            background-color: #253958;
            color: #ffffff;
            text-align: center;
        }
        .div{
            border: 1px solid #000;
            margin-bottom: 40px;
            padding: 10px;
        }
    </style>
    <title>Document</title>
</head>
<body>
<header class="header">
        <h1 id="title"> <a href="../HP/base.tmpl">神倉美術館</a></h1>
        <nav class="nav">
            <ul>
                <li><a href="../HP/event/index.php">展覧会・イベント</a></li>
                <li><a href="../HP/ticket_hp.tmpl">チケット購入</a></li>
                <li><a href="../HP/access_hp.tmpl">アクセス</a></li>
                <li><a href="loguin_hp.php">ログイン画面</a></li>
                <li><a href="../HP/fqa_hp.tmpl">お問い合わせ</a></li>
            </ul>
        </nav>
<main>
    <h2>マイページ登録情報の変更/</h2>
    <form action="../login/loguin_logout.html" method="get">
        <button type="submit">ログアウト</button>
    </form>
</main>
    </header>
    <footer>
  <div class="gotop">
      <a href="#top"><img src="../../img/top.png" alt="ページトップへ戻る"></a>
  </div>
  <div>
      <p class="copyright">&copy; KAMIKURA MUSEUM</p>
  </div>
</footer>
</body>
</html>