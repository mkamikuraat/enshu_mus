<?php
$dsn = 'mysql:host=localhost; dbname=mus; charset=utf8';
$user = 'testuser';
$pass = 'testpass';

if (empty($_GET["id"])) {
    echo "IDが正しく入力してください";
    exit;
}

$id = (int)$_GET["id"]; 
$username = $_POST["username"];
$mail = $_POST["mail"];
$password = $_POST["password"];
$name = $_POST["name"];
$gender = (int)$_POST["gender"];
$dob = $_POST["dob"];
$address = (int)$_POST["address"];
$terms = $_POST["terms"];
//$flag = $_POST["flag"];
try {
    $dbh = new PDO($dsn, $user, $pass);
    $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    $sql = 'UPDATE users SET username = ?, mail = ?, password = ?, name = ?, gender = ?, dob = ?, address = ?, terms =?, flag = ? where id = ?';
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(1, $username, PDO::PARAM_STR);
    $stmt->bindValue(2, $mail, PDO::PARAM_STR);
    $stmt->bindValue(3, $password, PDO::PARAM_STR);
    $stmt->bindValue(4, $name, PDO::PARAM_STR);
    $stmt->bindValue(5, $gender, PDO::PARAM_INT);
    $stmt->bindValue(6, $dob, PDO::PARAM_STR);
    $stmt->bindValue(7, $address, PDO::PARAM_INT);
    $stmt->bindValue(8, $terms, PDO::PARAM_STR);
    $stmt->bindValue(9, $id, PDO::PARAM_INT);
    //$stmt->bindValue(10, $flag, PDO::PARAM_INT);$stmt->execute();
    $dbh = null;
    echo "ユーザー名:" . htmlspecialchars($username, ENT_QUOTES) . "さんの更新が完了しました";

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
<a href="loguin_hp.php">戻る</a>
</body>
</html>