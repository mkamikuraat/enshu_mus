<?php
$dsn = 'mysql:host=localhost; dbname=mus; charset=utf8';
$user = 'testuser';
$pass = 'testpass';

if (empty($_GET["id"])) {
    echo "IDが正しく入力してください";
    exit;
}


$title = $_POST["title"];
$dob_s = $_POST["dob_s"];
$dob_e = $_POST["dob_e"];
$space = (int)$_POST["space"];
$text = $_POST["text"];
$editname = $_POST["editname"];
$dob = $_POST["dob"];
$id = (int)$_GET["id"]; 
//$flag = $_POST["flag"];
try {
    $dbh = new PDO($dsn, $user, $pass);
    $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    $sql = 'UPDATE event SET title = ?, dob_s = ?, dob_e = ?, space = ?, text = ?, editname = ?, dob = ? where id = ?';
    $stmt = $dbh->prepare($sql);//dob_e,,text,editname,dob
    $stmt->bindValue(1, $title, PDO::PARAM_STR);
    $stmt->bindValue(2, $dob_s, PDO::PARAM_STR);
    $stmt->bindValue(3, $dob_e, PDO::PARAM_STR);
    $stmt->bindValue(4, $space, PDO::PARAM_INT);
    $stmt->bindValue(5, $text, PDO::PARAM_STR);
    $stmt->bindValue(6, $editname, PDO::PARAM_STR);
    $stmt->bindValue(7, $dob, PDO::PARAM_STR);
    $stmt->bindValue(8, $id, PDO::PARAM_STR);
    //$stmt->bindValue(9, $id, PDO::PARAM_INT);
    //$stmt->bindValue(10, $flag, PDO::PARAM_INT);
    $stmt->execute();
    $dbh = null;
    echo "ID:" . htmlspecialchars($id, ENT_QUOTES) . "の更新が完了しました";

    
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
    <style type="text/css">
        body { font-size:80%; background:#f0f0f0; }
        table{ border-collapse:collapse; margin:10px 0; border-right:1px solid #000; border-bottom:1px solid #000;}
        th,td{ border-left:1px solid #000; border-top:1px solid #000;padding:5px;}
        th{background-color: #000;}
    </style>
    <title>Document</title>
</head>
<body>
<br>    
<a href="event_index.php">展示・イベント管理一覧に戻る</a>
</body>
</html>