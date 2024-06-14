<?php
$dsn = 'mysql:host=localhost; dbname=mus; charset=utf8';
$user = 'testuser';
$pass = 'testpass';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["title"]) && isset($_POST["dob_s"]) && isset($_POST["dob_e"]) && isset($_POST["space"]) && isset($_POST["text"]) && isset($_POST["editname"]) && isset($_POST["dob"])) {
        //$id = (int)$_POST["id"];
        $title = $_POST["title"];
        $dob_s = $_POST["dob_s"];
        $dob_e = $_POST["dob_e"];
        $space = (int)$_POST["space"];
        $text = $_POST["text"];
        $editname = htmlspecialchars($_POST["editname"], ENT_QUOTES);
        $dob = $_POST["dob"];
        //$flag = (int)$_POST["flag"];

        try {
            $dbh = new PDO($dsn, $user,$pass);
            $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO event (title,dob_s,dob_e,space,text,editname,dob) VALUES (?,?,?,?,?,?,?)";
            $stmt = $dbh->prepare($sql);
            $stmt->bindValue(1,$title, PDO::PARAM_STR);
            $stmt->bindValue(2,$dob_s, PDO::PARAM_STR);
            $stmt->bindValue(3,$dob_e, PDO::PARAM_STR);
            $stmt->bindValue(4,$space, PDO::PARAM_INT);
            $stmt->bindValue(5,$text, PDO::PARAM_STR);
            $stmt->bindValue(6,$editname, PDO::PARAM_STR);
            $stmt->bindValue(7,$dob, PDO::PARAM_STR);
        
            $stmt->execute();
            $dbh = null;
            echo "登録完了しました";

        }catch (PDOException $e){
            echo "エラー発生：" . htmlspecialchars($e->getMessage(), ENT_QUOTES) . '<br>';
            exit;
        }
    } else {
        echo "フォームデータが不足しています";
    }
} else {
    echo "このページは直接アクセスできません";
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style type="text/css">
        body { font-size:100%; background:#f0f0f0; }
    </style>
    <title>Document</title>
</head>
<body>
    <a href="event_index.php">展示・イベント管理一覧に戻る</a>
</body>
</html>