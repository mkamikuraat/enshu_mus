<?php
$dsn = 'mysql:host=localhost; dbname=mus; charset=utf8';
$user = 'testuser';
$pass = 'testpass';



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["eventtype"]) && isset($_POST["dob_c"]) && isset($_POST["time"]) && isset($_POST["tickettype"]) && isset($_POST["name"]) && isset($_POST["gender"]) && isset($_POST["dob"]) && isset($_POST["address"])) {
        //$id = (int)$_POST["id"];
        $eventtype = (int)$_POST["eventtype"];
        $dob_c = $_POST["dob_c"];
        $time = (int)$_POST["time"];
        $tickettype = (int)$_POST["tickettype"];
        $name = htmlspecialchars($_POST["name"], ENT_QUOTES);
        $gender = (int)$_POST["gender"];
        $dob = $_POST["dob"];
        $address = (int)$_POST["address"];
        //$flag = (int)$_POST["flag"];

        try {
            $dbh = new PDO($dsn, $user,$pass);
            $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO ticket (eventtype,dob_c,time,tickettype,name,gender,dob,address) VALUES (?,?,?,?,?,?,?,?)";
            $stmt = $dbh->prepare($sql);
            $stmt->bindValue(1,$eventtype, PDO::PARAM_INT);
            $stmt->bindValue(2,$dob_c, PDO::PARAM_STR);
            $stmt->bindValue(3,$time, PDO::PARAM_INT);
            $stmt->bindValue(4,$tickettype, PDO::PARAM_INT);
            $stmt->bindValue(5,$name, PDO::PARAM_STR);
            $stmt->bindValue(6,$gender, PDO::PARAM_INT);
            $stmt->bindValue(7,$dob, PDO::PARAM_STR);
            $stmt->bindValue(8,$address, PDO::PARAM_INT);
            //$stmt->bindValue(9,$flag, PDO::PARAM_INT);
            //$stmt->bindValue(10,$id, PDO::PARAM_INT);
            $stmt->execute();
            $dbh = null;
            echo "予約完了しました";

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
    <a href="../../login/loguin_hp.php">ログイン画面に戻る</a>
</body>
</html>