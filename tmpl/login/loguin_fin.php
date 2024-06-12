<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    if(isset($_POST["id"]) && isset($_POST["username"]) && isset($_POST["gender"])) {
        $id = htmlspecialchars($_POST["id"], ENT_QUOTES);
        $username = htmlspecialchars($_POST["username"], ENT_QUOTES);
        $gender = "";
        
        if ($_POST["gender"] == "1") {
            $gender = "男性";
        } elseif ($_POST["gender"] == "2") {
            $gender = "女性";
        } elseif ($_POST["gender"] == "3") {
            $gender = "無選択";
        }
        
        echo "ID: $id<br>";
        echo "ユーザー名: $username<br>";
        echo "性別: $gender<br>";
} else {
    echo "フォームからデータが送信されていません。";
}
    ?>
</body>
</html>
