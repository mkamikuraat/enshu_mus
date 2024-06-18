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
    $sql = 'SELECT * FROM  ticket where id = ?';
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
    <style type="text/css">
        body { font-size:80%; background:#f0f0f0; }
        table{ border-collapse:collapse; margin:10px 0; border-right:1px solid #000; border-bottom:1px solid #000;}
        th,td{ border-left:1px solid #000; border-top:1px solid #000;padding:5px;}
        th{background-color: #000;}
    </style>
    <title>Document</title>
</head>
<body>
    ユーザー管理<br>
    <form action="ticket_update.php?id=<?=htmlspecialchars($result["id"], ENT_QUOTES) ?>" method="post">
        展示種類:
        <select name="eventtype" id="eventtype">
          <option hidden>選択してください</option>
          <option value="1" name="eventtype" <?php if ($result["eventtype"] == 1) echo "selected" ?>>「夢の中庭: イマジネーションの旅」</option>
          <option value="2" name="eventtype" <?php if ($result["eventtype"] == 2) echo "selected" ?>>「色彩の奇跡: 光と影のダンス」</option>
          <option value="3" name="eventtype" <?php if ($result["eventtype"] == 3) echo "selected" ?>>「交差する世界: 文化と遺産の対話」</option>
          <option value="4" name="eventtype" <?php if ($result["eventtype"] == 4) echo "selected" ?>>「人間の軌跡: 歴史と未来の交差点」</option>
          <option value="5" name="eventtype" <?php if ($result["eventtype"] == 5) echo "selected" ?>>「自然の詩: 森と水の物語」</option>
        </select>
        <!-- <input name="eventtype" value="<?php echo htmlspecialchars($result["eventtype"], ENT_QUOTES) ?>"><br> -->
        <br>
        来場日:<input type="date" id="dob_c" name="dob_c" value="<?php echo htmlspecialchars($result["dob_c"], ENT_QUOTES) ?>"><br>
        
        入場時間:
        <select name="time" id="time">
          <option hidden>選択してください</option>
          <option value="1" name="time" <?php if ($result["time"] == 1) echo "selected" ?>>09:00</option>
          <option value="2" name="time" <?php if ($result["time"] == 2) echo "selected" ?>>10:00</option>
          <option value="3" name="time" <?php if ($result["time"] == 3) echo "selected" ?>>11:00</option>
          <option value="4" name="time" <?php if ($result["time"] == 4) echo "selected" ?>>12:00</option>
          <option value="5" name="time" <?php if ($result["time"] == 5) echo "selected" ?>>13:00</option>
          <option value="6" name="time" <?php if ($result["time"] == 6) echo "selected" ?>>14:00</option>
          <option value="7" name="time" <?php if ($result["time"] == 7) echo "selected" ?>>15:00</option>
          <option value="8" name="time" <?php if ($result["time"] == 8) echo "selected" ?>>16:00</option>
        </select>
        <br>
        <!-- <input name="time" value="<?php echo htmlspecialchars($result["time"], ENT_QUOTES) ?>"><br> -->
        チケット種類:
        <select name="tickettype" id="tickettype">
          <option hidden>選択してください</option>
          <option value="1" name="tickettype" <?php if ($result["tickettype"] == 1) echo "selected" ?>>一般（65歳未満）</option>
          <option value="2" name="tickettype" <?php if ($result["tickettype"] == 2) echo "selected" ?>>学生(小学生以上)</option>
          <option value="3" name="tickettype" <?php if ($result["tickettype"] == 3) echo "selected" ?>>VIP</option>
          <option value="4" name="tickettype" <?php if ($result["tickettype"] == 4) echo "selected" ?>>その他</option>
        </select>
        <br>
        <!-- チケット種類:<input name="tickettype" value="<?php echo htmlspecialchars($result["tickettype"], ENT_QUOTES) ?>" required><br> -->
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
      <input type="submit" name="send" value="送信">
      <input type="hidden" name="mode" value="register">
    </form>
</body>
</html>