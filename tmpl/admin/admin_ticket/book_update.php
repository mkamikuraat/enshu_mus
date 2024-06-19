<?php
$dsn = 'mysql:host=localhost; dbname=mus; charset=utf8';
$user = 'testuser';
$pass = 'testpass';

// if (!isset($_GET["id"])) {
//     echo "IDが正しく入力してください";
//     exit;
// }
//error_reporting(E_ERROR | E_PARSE); // E_ERROR と E_PARSE のみを表示し、E_WARNING などは非表示にする
$username = isset($_POST['username']) ? $_POST['username'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';
$id = isset($_POST['id']) ? $_POST['id'] : '';
// var_dump($_POST);
$username = $_POST["username"];
$password = $_POST["password"];
$eventtype = $_POST["eventtype"];
$dob_c = $_POST["dob_c"];
$time = $_POST["time"];
$name = $_POST["name"];
$gender = (int)$_POST["gender"];
$dob = $_POST["dob"];
$address = (int)$_POST["address"];
$tickettype = $_POST["tickettype"];
//$id = (int)$_GET["id"]; 
//$flag = $_POST["flag"];
try {
    $dbh = new PDO($dsn, $user, $pass);
    $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    $sql = 'UPDATE ticket SET eventtype = ?, dob_c = ?, time = ?, name = ?, gender = ?, dob = ?, address = ?, tickettype = ?, username = ?, password = ? where id = ?';
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(1, $eventtype, PDO::PARAM_STR);
    $stmt->bindValue(2, $dob_c, PDO::PARAM_STR);
    $stmt->bindValue(3, $time, PDO::PARAM_STR);
    $stmt->bindValue(4, $name, PDO::PARAM_STR);
    $stmt->bindValue(5, $gender, PDO::PARAM_INT);
    $stmt->bindValue(6, $dob, PDO::PARAM_STR);
    $stmt->bindValue(7, $address, PDO::PARAM_INT);
    $stmt->bindValue(8, $tickettype, PDO::PARAM_STR);
    $stmt->bindValue(9, $username, PDO::PARAM_STR);
    $stmt->bindValue(10, $password, PDO::PARAM_STR);
    $stmt->bindValue(11, $id, PDO::PARAM_INT); 
    $stmt->execute();
    $dbh = null;
    // echo  htmlspecialchars($username, ENT_QUOTES) . "更新が完了しました";
    echo   "{$username}さんの更新が完了しました";
    
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
<a href="../../login/loguin_hp.php">戻る</a>
</body>
</html>