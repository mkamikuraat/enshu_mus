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
    $sql = 'UPDATE ticket SET flag = 1 where id = ?';
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
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style type="text/css">
  body { font-size:80%; background:#f0f0f0; }
  table{ border-collapse:collapse; margin:10px 0; border-right:1px solid #000; border-bottom:1px solid #000;}
  th,td{ border-left:1px solid #000; border-top:1px solid #000;padding:5px;}
  th{background-color: #000;}
</style>
    <title>Document</title>
</head>
<body>
    <a href="ticket_index.php">チケット予約管理一覧に戻る</a>
</body>
</html>
