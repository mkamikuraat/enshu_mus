<?php
session_start();

// データベースに接続
$dsn = 'mysql:host=localhost;dbname=mus;charset=utf8';
$user = 'testuser'; 
$pass = 'testpass';

try {
    $dbh = new PDO($dsn, $user, $pass);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "データベース接続エラー：" . $e->getMessage();
    die();
}

// フォームが送信された場合の処理
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // ユーザー名とパスワードの取得
    $entered_username = $_POST["username"];
    $entered_password = $_POST["password"];

    // データベースからユーザー情報を取得
    $stmt = $dbh->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$entered_username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);


    // if ($user && password_verify($entered_password, $user["password"])) {
    //     // 認証成功：セッションにユーザー名を保存
    //     $_SESSION["username"] = $user["username"];
    //     echo "ログイン成功。";
    //     echo "ようこそ！ " . $user["username"] . "さん";
    //     // ログイン成功後の処理を記述（例：別のページにリダイレクトなど）
    // } else {
    //     // 認証失敗：エラーメッセージを表示するなど適切な処理を行う
    //     echo "ユーザー名またはパスワードが正しくありません。566";
    //     //header("Location: loguin_hp.php");
        
        
    // }
    //echo "ようこそ！ " . $user["username"] . "さん";
}

?>
<!DOCTYPE html>
<html lang="en">
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
    <title>マイページ</title>
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
        <a href="../admin/admin_hp.php"></a>
    </header>
    <main>
    <?php
        if($user["password"] == $entered_password && $user['is_admin']==1){
            echo"aaaaaaaa";
            header("Location: ../admin/admin_hp.php");
        }
        else if ($user["password"] == $entered_password) {
            // 認証成功：セッションにユーザー名を保存
            $_SESSION["username"] = $user["username"];
            //echo "ログイン成功。";
            echo "<h2>" . "ようこそ！ " . $user["username"] . "さん" . "</h2>";
            // ログイン成功後の処理を記述（例：別のページにリダイレクトなど）
        } 
        
        else {
            // 認証失敗：エラーメッセージを表示するなど適切な処理を行う
            echo "ユーザー名またはパスワードが正しくありません。566";
            //header("Location: loguin_hp.php");
            exit();
            
        }
    ?>

    
    <form action="../admin/admin_ticket/admin_ticket.html" method="get">
        <button type="submit">チケット購入</button>
    </form>
    <form action="" method="get">
        <button type="submit">チケット予約確認</button>
    </form>
    <form action="loguin_infocd.php" method="get">
        <button type="submit">登録情報の変更</button>
    </form>

    <form action="../login/loguin_logout.html" method="get">
        <button type="submit">ログアウト</button>
    </form>
    </main>
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