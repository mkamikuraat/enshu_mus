<?php
$dsn = 'mysql:host=localhost; dbname=mus; charset=utf8';
$user = 'testuser';
$pass = 'testpass';
if (empty($_GET["id"])){
    echo "IDを正しく入力してください";
    exit;
}
try {
    $id = (int)$_GET["id"];
    $dbh = new PDO($dsn, $user, $pass);
    $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    $sql = 'SELECT * FROM  event where id = ?';
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(1, $id, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    echo "<h2>展示・イベント</h2>" . "<br>";
    //echo "ID:" . htmlspecialchars($result["id"],ENT_QUOTES) . '<br>' . PHP_EOL;
    echo "タイトル:" . htmlspecialchars($result["title"],ENT_QUOTES) . '<br>' . PHP_EOL;
    echo "開始日:" . htmlspecialchars($result["dob_s"],ENT_QUOTES) . '<br>' . PHP_EOL;
    echo "終了日:" . htmlspecialchars($result["dob_e"],ENT_QUOTES) . '<br>' . PHP_EOL;
    $space = '';
        if ($result['space'] == "1") {
            $space = "展示室１";
        } else if ($result['space'] == "2") {
            $space = "展示室２";
        } else if ($result['space'] == "3") {
            $space = "展示室３";
        } else {
            $espace = "不明";
        }
        echo '<td>展示場所：' . $space . '</td>' . PHP_EOL;
    echo '<br>';
    echo "" . htmlspecialchars($result["text"],ENT_QUOTES) . '<br>' . PHP_EOL;
    echo '<br>';
    
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
    body {background:#f0f0f0; }
  </style>
    <title>Document</title>
</head>
<body>
    <a href="index.php">展示・イベント一覧へ戻る</a>
    <br>
    <a href="../base.tmpl"> TOPへ</a>
</body>
</html>