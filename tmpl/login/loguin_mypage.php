<?php
session_start();


// ログインしていない場合はログインページにリダイレクト
if (!($_POST["username"] == "usera")) {
    header("Location: loguin_hp.php");
    exit;
}else{
    $_SESSION["username"] = $_POST["username"];
}
if (isset($_POST["username"])) {
    setcookie($_POST['username']);
}
// if ("admin"){

// }else if ("admin"){

// }
// var_dump($_POST);

// ログイン中のユーザーを表示
// echo "ようこそ！ " . $_SESSION["username"] . "さん";
echo "ようこそ！ " . $_SESSION["username"] . "さん";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style type="text/css">
    body { font-size:100%; background:#f0f0f0; }
  </style>
    <title>Document</title>
</head>
<body>
    <p>マイページ</p>
    <a href="../admin/admin_hp.php"></a>
    <?php echo $_SESSION["username"];?>
    <form action="../admin/admin_ticket/admin_ticket.html" method="get">
        <button type="submit">チケット購入</button>
    </form>
    <form action="" method="get">
        <button type="submit">チケット予約確認</button>
    </form>
    <form action="" method="get">
        <button type="submit">登録情報の変更</button>
    </form>

    <form action="../login/loguin_logout.html" method="get">
        <button type="submit">ログアウト</button>
    </form>
</body>
</html>