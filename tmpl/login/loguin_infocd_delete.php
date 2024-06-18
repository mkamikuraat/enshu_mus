<?php
$dsn = 'mysql:host=localhost; dbname=mus; charset=utf8';
$user = 'testuser';
$pass = 'testpass';
if (empty($_GET["id"])) {
    echo "IDが正しく入力してください";
    exit;
}
try {
    $id = (int)$_GET["id"]; 
    $dbh = new PDO($dsn, $user, $pass);
    $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    $sql = 'UPDATE users SET flag = 1 where id = ?';
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(1, $id, PDO::PARAM_INT);
    $stmt->execute();
    $affectedRows = $stmt->rowCount(); // 削除された行数を取得
    if ($affectedRows > 0) {
        echo "ID:" . htmlspecialchars($id, ENT_QUOTES) . "の削除が完了しました";
    } else {
        echo "ID:" . htmlspecialchars($id, ENT_QUOTES) . "は見つかりませんでした";
    }
    //$result = $stmt->fetch(PDO::FETCH_ASSOC);
    $dbh = null;
    //echo "ID:" . htmlspecialchars($id, ENT_QUOTES) . "の削除が完了しました";
}catch(PDOException $e){
    echo "エラー発生：" . htmlspecialchars($e->getMessage(), ENT_QUOTES) . '<br>';
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <br> 
    <a href="loguin_hp.php">ログイン画面へ戻る</a>
</body>
</html>
