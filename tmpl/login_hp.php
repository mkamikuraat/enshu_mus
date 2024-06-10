<?php
    
    session_start();
    $username = "admin"; // ダミーのユーザー名
    $password = "password"; // ダミーのパスワード
    $error = ""; // エラーメッセージの初期化
    // ログインフォームの送信があった場合
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $entered_username = $_POST["username"];
        $entered_password = $_POST["password"];
        // 入力されたユーザー名とパスワードが正しいか確認
        if ($entered_username == $username && $entered_password == $password) {
            // セッションに管理者の情報を保存
            $_SESSION["username"] = $username;
            // ログイン成功後、管理者画面にリダイレクト
            header("Location: admin_hp.php");
            exit;
        } else {
            $error = "ユーザー名またはパスワードが正しくありません。";
        }
    }
    ?>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<style type="text/css">
  body { font-size:80%; background:#f0f0f0; }
  table{ border-collapse:collapse; margin:10px 0; border-right:1px solid #000; border-bottom:1px solid #000;}
  th,td{ border-left:1px solid #000; border-top:1px solid #000;padding:5px;}
  th{background-color: #000;}
</style>
<title>homepage</title>
</head>
<body>
    <form action="login_hp.php" method="post">
        <h2>ログイン画面</h2>
        <label for="username">ユーザー名:</label>
        <input type="text" id="username" name="username" required>
        <label for="password">パスワード:</label>
        <input type="password" id="password" name="password" required>
        <input type="submit" value="ログイン">
    </form>
   
    <?php if (isset($error)) : ?>
    <p><?php echo $error; ?></p>
    <?php endif; ?>


    <p>――――――――または――――――――</p>

    <form action="login_info.tmpl" method="get">
        <button type="submit">新規会員登録</button>
    </form>
    
    <section>
        <a href="base.tmpl" class="botan">TOPへ</a>
    </section>
    

</body>
</html>

