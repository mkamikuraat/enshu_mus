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
    <?php
    if(isset($_POST["id"]) && isset($_POST["title"]) && isset($_POST["dob_s"])&& isset($_POST["dob_e"])&& isset($_POST["space"])) {
        $id = htmlspecialchars($_POST["id"], ENT_QUOTES);
        $title = htmlspecialchars($_POST["title"], ENT_QUOTES);
        $dob_s = htmlspecialchars($_POST["dob_s"], ENT_QUOTES);
        $dob_e = htmlspecialchars($_POST["dob_e"], ENT_QUOTES);
        $space = "";
        if ($_POST["space"] == "1") {
            $space = "展示室１";
        } elseif ($_POST["space"] == "2") {
            $space = "展示室２";
        } elseif ($_POST["space"] == "3") {
            $space = "展示室３";
        } 
        
        echo "ID: $id<br>";
        echo "タイトル: $id<br>";
        echo "開始日: $id<br>";
        echo "終了日: $id<br>";
        echo "展示場所: $space<br>";
} else {
    echo "フォームからデータが送信されていません。";
}
    ?>
</body>
</html>
