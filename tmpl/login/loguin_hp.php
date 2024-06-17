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
    // ログイン処理
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // フォームが送信された場合の処理
        if (isset($_POST["username"]) && isset($_POST["password"])) {
            // ユーザー名とパスワードの取得
            $entered_username = $_POST["username"];
            $entered_password = $_POST["password"];
            
            // データベースからユーザー情報を取得
            $stmt = $dbh->prepare("SELECT * FROM users WHERE username = ?");
            $stmt->execute([$entered_username]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
            if ($user && password_verify($entered_password, $user["password"])) {
                // 認証成功：セッションにユーザー名を保存
                $_SESSION["username"] = $user["username"];
                // ユーザーが管理者でなければ、一般ユーザーのページにリダイレクト
                if($user["is_admin"] == 1){
                    // 管理者なら管理者ページにリダイレクト
                    header("Location: ../admin/admin_hp.php");
                }  else if ($user["is_admin"] == 0) {
                    header("Location: loguin_loguin.php");
                }
                exit;
            } else {
                // 認証失敗：エラーメッセージを表示するなど適切な処理を行う
                $error = "ユーザー名またはパスワードが正しくありません。112";
            }
        } else {
            // ユーザー名とパスワードが送信されていない場合のエラー処理
            echo "ユーザー名またはパスワードが送信されていません。";
        }
    }

?>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
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
    </style>
<title>homepage</title>
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
        <form action="loguin_loguin.php" method="post">
            <h2>ログイン画面</h2>
            <?php if (isset($error)) : ?>
            <p><?php echo $error; ?></p>
            <?php endif; ?>
            
                <label for="username">ユーザー名:</label>
                <input type="text" id="username" name="username" required>
                <br>
                <label for="password">パスワード:</label>
                <input type="password" id="password" name="password" required>
                <br>
                <input type="submit" value="ログイン">
        </form>


        <p>――――――――または――――――――</p>

        <form action="loguin_form.html" method="get">
            <button type="submit">新規会員登録</button>
        </form>
        
        <section>
            <a href="../HP/base.tmpl" class="botan">TOPへ</a>
        </section>
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

