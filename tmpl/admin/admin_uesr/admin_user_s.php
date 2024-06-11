<?php

//echo "データベース登録用のPHPファイルです";

$name = $_POST["name"];
$email = $_POST["mail"];
//$comment = $_POST["comment"];

# データベースに接続
$dsn = 'mysql:host=localhost; dbname=mus; charset=utf8';
$user = 'testuser';
$pass = 'testpass';

try{
  $dbh = new PDO($dsn, $user, $pass);
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  if ($dbh == null){
    echo "接続に失敗しました。";
  }else{
    #INSERT文の定義
    $sql = "INSERT INTO user (name, mail, comment) VALUES (:name, :mail, :comment)";
    # プリペアードステートメント
    $stmt = $dbh->prepare($sql);

    #bindParamによるパラメータ－と変数の紐付け
    $stmt -> bindParam(':name',$name);
    $stmt -> bindParam(':mail',$mail);
    //$stmt -> bindParam(':comment',$comment);

    #INSERTの実行
    $stmt->execute();
    echo("userテーブルにデータを追加しました。");
    //echo '<p><a href="form.php">お問い合わせページに進む。</a></p>';
  }
}catch (PDOException $e){
  echo('エラー内容：'.$e->getMessage());
  die();
}
$dbh = null;

?>