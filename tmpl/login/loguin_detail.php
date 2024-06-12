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
    $sql = 'SELECT * FROM  users where id = ?';
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(1, $id, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    //print_r($result);
    echo "確認画面" . "<br>";
    echo "ID：" . htmlspecialchars($result["id"],ENT_QUOTES) . '<br>' . PHP_EOL;
    echo "ユーザー名：" . htmlspecialchars($result["username"],ENT_QUOTES) . '<br>' . PHP_EOL;
    echo "メールアドレス：" . htmlspecialchars($result["mail"],ENT_QUOTES) . '<br>' . PHP_EOL;
    echo "パスワード：" . htmlspecialchars($result["password"],ENT_QUOTES) . '<br>' . PHP_EOL;
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
    //echo "住所：" . htmlspecialchars($result["address"],ENT_QUOTES) . '<br>' . PHP_EOL;
    echo '<br>';
    $terms = '';
    if ($result['terms'] == "on"){
        $terms = "同意しました";
    }
    echo '<td>利用規約：' . $terms . '</td>' . PHP_EOL;
    //echo "利用規約：" . htmlspecialchars($result["terms"],ENT_QUOTES) . '<br>' . PHP_EOL;
    $dbh = null;
} catch (PDOException $e) {
    echo "エラー発生：" . htmlspecialchars($e->getMessage(), ENT_QUOTES) . '<br>';
    exit;
}
?>