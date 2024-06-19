<?php
$dsn = 'mysql:host=localhost; dbname=mus; charset=utf8';
$user = 'testuser';
$pass = 'testpass';
if (empty($_GET["id"])){
    echo "IDを正しく入力してください";
    exit;
}
$id = (int)$_GET["id"];
try {
    $dbh = new PDO($dsn, $user, $pass);
    $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    $sql = 'SELECT * FROM  users where id = ?';
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(1, $id, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $dbh = null;
}catch (PDOException $e) {
    echo "エラー発生：" . htmlspecialchars($e->getMessage(), ENT_QUOTES) . '<br>';
    exit;
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    ユーザー管理<br>
    <form action="loguin_update.php?id=<?=htmlspecialchars($result["id"], ENT_QUOTES) ?>" method="post">
        <input type="hidden" name="id" value="<?=htmlspecialchars($result["id"], ENT_QUOTES) ?>">
        ユーザー名:<input type="text" name="username" value="<?php echo htmlspecialchars($result["username"], ENT_QUOTES) ?>"><br>
        メールアドレス:<input type="text" name="mail" value="<?php echo htmlspecialchars($result["mail"], ENT_QUOTES) ?>"><br>
        パスワード:<input type="password" id="password" name="password" value="<?php echo htmlspecialchars($result["password"], ENT_QUOTES) ?>" required><br>
        名前:<input type="text" name="name" value="<?php echo htmlspecialchars($result["name"], ENT_QUOTES) ?>"><br>
        性別:
        <input type="radio" name="gender" value="1" <?php if ($result["gender"] == 1) echo "checked" ?>> 男性
        <input type="radio" name="gender" value="2" <?php if ($result["gender"] == 2) echo "checked" ?>>女性
        <input type="radio" name="gender" value="3" <?php if ($result["gender"] == 3) echo "checked" ?>>無選択
        <br>
        生年月日:<input type="date" id="dob" name="dob" value="<?php echo htmlspecialchars($result["dob"], ENT_QUOTES) ?>"><br>
        住所:
        <select name="address" id="address">
          <option hidden>選択してください</option>
          <option value="1" name="place[]" <?php if ($result["address"] == 1) echo "selected" ?>>都内</option>
          <option value="2" name="place[]" <?php if ($result["address"] == 2) echo "selected" ?>>都外</option>
          <option value="3" name="place[]" <?php if ($result["address"] == 3) echo "selected" ?>>その他</option>
        </select>
        <br>
        <input type="checkbox" id="terms" name="terms" value="<?php echo htmlspecialchars($result["terms"], ENT_QUOTES) ?>" required>
        利用規約とプライバシーポリシーに同意する
        <br>
      <input type="submit" name="send" value="送信">
      <input type="hidden" name="mode" value="register">
    </form>
</body>
</html>