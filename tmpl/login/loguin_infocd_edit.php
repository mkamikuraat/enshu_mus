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
    <br>
    <form action="loguin_infocd_update.php?id=<?=htmlspecialchars($result["id"], ENT_QUOTES) ?>" method="post">
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
<script>
  function setDateRestriction() {
      var eventType = document.getElementById("eventtype").value;
      var dateInput = document.getElementById("dob_c");
  
      switch (eventType) {
          case "1":
              dateInput.min = "2024-07-01"; 
              dateInput.max = "2024-07-15"; 
              break;
          case "2":
              dateInput.min = "2024-07-16"; 
              dateInput.max = "2024-07-31";
              break;
          case "3":
              dateInput.min = "2024-06-16";
              dateInput.max = "2024-08-31";
              break;
          case "4":
              dateInput.min = "2024-06-19";
              dateInput.max = "2024-10-31";
              break;
          case "5":
              dateInput.min = "2024-09-01";
              dateInput.max = "2024-12-27"; 
              break;
          default:
              // デフォルトの制限（特になし）
              dateInput.min = ""; // 制限なし
              dateInput.max = ""; // 制限なし
              break;
      }
  }
  </script>
</html>