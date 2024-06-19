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
    //var_dump($id);
    $dbh = new PDO($dsn, $user, $pass);
    $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    $sql = 'SELECT * FROM  ticket where id = ?';
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(1, $id, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    //print_r($result);
    echo "確認画面" . "<br>";
    echo "ID：" . htmlspecialchars($result["id"],ENT_QUOTES) . '<br>' . PHP_EOL;
    //echo "展示種類：" . htmlspecialchars($result["eventtype"],ENT_QUOTES) . '<br>' . PHP_EOL;
    echo "ユーザー名：" . htmlspecialchars($result["username"],ENT_QUOTES) . '<br>' . PHP_EOL;
    // echo "メールアドレス：" . htmlspecialchars($result["mail"],ENT_QUOTES) . '<br>' . PHP_EOL;
    echo "パスワード：" . htmlspecialchars($result["password"],ENT_QUOTES) . '<br>' . PHP_EOL;
    $eventtype = '';
        if ($result['eventtype'] == "1") {
            $eventtype = "「夢の中庭: イマジネーションの旅」";
        } else if ($result['eventtype'] == "2") {
            $eventtype = "「色彩の奇跡: 光と影のダンス」";
        } else if ($result['eventtype'] == "3") {
            $eventtype = "「交差する世界: 文化と遺産の対話」";
        } else if ($result['eventtype'] == "4") {
            $eventtype = "「人間の軌跡: 歴史と未来の交差点」";
        } else if ($result['eventtype'] == "5") {
            $eventtype = "「自然の詩: 森と水の物語」";
        } else {
            $eventtype = "不明";
        }
        echo '<td>展示種類：' . $eventtype . '</td>' . PHP_EOL;
        echo "<br>";
    echo "来場日：" . htmlspecialchars($result["dob_c"],ENT_QUOTES) . '<br>' . PHP_EOL;
    //echo "入場時間：" . htmlspecialchars($result["time"],ENT_QUOTES) . '<br>' . PHP_EOL;
    $time = '';
        if ($result['time'] == "1") {
            $time = "09:00";
        } else if ($result['time'] == "2") {
            $time = "10:00";
        } else if ($result['time'] == "3") {
            $time = "11:00";
        } else if ($result['time'] == "4") {
            $time = "12:00";
        } else if ($result['time'] == "5") {
            $time = "13:00";
        } else if ($result['time'] == "6") {
            $time = "14:00";
        } else if ($result['time'] == "7") {
            $time = "15:00";
        } else if ($result['time'] == "8") {
            $time = "16:00";
        } else {
            $time = "不明";
        }
        echo '<td>入場時間：' . $time . '</td>' . PHP_EOL;
        echo '<br>';
        $tickettype = '';
        if ($result['tickettype'] == "1") {
            $tickettype = "一般（65歳未満）";
        } else if ($result['tickettype'] == "2") {
            $tickettype = "学生(小学生以上)";
        } else if ($result['tickettype'] == "3") {
            $tickettype = "VIP";
        } else if ($result['tickettype'] == "4") {
            $tickettype = "その他";
        } else {
            $tickettype = "不明";
        }
        echo '<td>チケット種類：' . $tickettype . '</td>' . PHP_EOL;
        echo '<br>';
    echo "名前：" . htmlspecialchars($result["name"],ENT_QUOTES) . '<br>' . PHP_EOL;
    $gender = '';
        if ($result['gender'] == "1") {
            $gender = "男性";
        } else if ($result['gender'] == "2") {
            $gender = "女性";
        } else if ($result['gender'] == "3") {
            $gender = "無選択";
        } else {
            $gender = "不明";
        }
        echo '<td>性別：' . $gender . '</td>' . PHP_EOL;
        echo '<br>';
    //echo "性別：" . htmlspecialchars(ENT_QUOTES) . '<br>' . PHP_EOL;
    echo "生年月日：" . htmlspecialchars($result["dob"],ENT_QUOTES) . '<br>' . PHP_EOL;
    $address = '';
        if ($result['address'] == "1") {
            $address = "都内";
        } else if ($result['address'] == "2") {
            $address = "都外";
        } else if ($result['address'] == "3") {
            $address = "その他";
        } else {
            $address = "不明";
        }
        echo '<td>住所：' . $address . '</td>' . PHP_EOL;
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
    
</body>
</html>
