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
    $sql = 'SELECT * FROM  event where id = ?';
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
    <form action="event_update.php?id=<?=htmlspecialchars($result["id"], ENT_QUOTES) ?>" method="post">
        タイトル:<input type="text" name="title" value="<?php echo htmlspecialchars($result["title"], ENT_QUOTES) ?>"><br>
        <!-- 更新日:<input type="date" id="time" name="time" value="<?php echo htmlspecialchars($result["time"], ENT_QUOTES) ?>"><br> -->
        開始日:<input type="date" id="dob_s" name="dob_s" value="<?php echo htmlspecialchars($result["dob_s"], ENT_QUOTES) ?>"><br>
        終了日:<input type="date" id="dob_e" name="dob_e" value="<?php echo htmlspecialchars($result["dob_e"], ENT_QUOTES) ?>"><br>
        展示場所:
        <select name="space" id="space">
          <option hidden>選択してください</option>
          <option value="1" name="space" <?php if ($result["space"] == 1) echo "selected" ?>>展示室１</option>
          <option value="2" name="space" <?php if ($result["space"] == 2) echo "selected" ?>>展示室２</option>
          <option value="3" name="space" <?php if ($result["space"] == 3) echo "selected" ?>>展示室３</option>
        </select>
        <br>
        <textarea name="text" id="" cols="40" rows="10" maxlength="320">解説：<?php echo htmlspecialchars($result["text"], ENT_QUOTES) ?></textarea><br>
        <!-- 解説:<input type="" name="text" value="<?php echo htmlspecialchars($result["text"], ENT_QUOTES) ?>"><br> -->
        締切日:<input type="date" id="dob" name="dob" value="<?php echo htmlspecialchars($result["dob"], ENT_QUOTES) ?>"><br>
        編集者:<input type="text" name="editname" value="<?php echo htmlspecialchars($result["editname"], ENT_QUOTES) ?>"><br>
        
      <input type="submit" name="send" value="送信">
      <input type="hidden" name="mode" value="register">
    </form>
</body>
</html>