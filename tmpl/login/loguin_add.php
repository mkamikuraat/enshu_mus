<?php
$dsn = 'mysql:host=localhost; dbname=mus; charset=utf8';
$user = 'testuser';
$pass = 'testpass';
//$id = $_POST["id"];
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
    $dbh = new PDO($dsn, $user,$pass);
    $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    $sql = "INSERT INTO users (username,mail,password,name,gender,address,terms,dob) VALUES (?,?,?,?,?,?,?,?)";
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(1,$username, PDO::PARAM_STR);
    $stmt->bindValue(2,$mail, PDO::PARAM_STR);
    $stmt->bindValue(3,$password, PDO::PARAM_STR);
    $stmt->bindValue(4,$name, PDO::PARAM_STR);
    $stmt->bindValue(5,$gender, PDO::PARAM_INT);
    $stmt->bindValue(6,$address, PDO::PARAM_INT);
    $stmt->bindValue(7,$terms, PDO::PARAM_STR);
    $stmt->bindValue(8,$dob, PDO::PARAM_STR);
    //$stmt->bindValue(9,$flag, PDO::PARAM_STR);
    $stmt->execute();
    $dbh = null;
    echo "登録完了しました";

}catch (PDOException $e){
    echo "エラー発生：" . htmlspecialchars($e->getMessage(), ENT_QUOTES) . '<br>';
    exit;
}
?>