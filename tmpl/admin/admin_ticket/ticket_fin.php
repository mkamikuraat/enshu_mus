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
    if(isset($_POST["id"]) && isset($_POST["eventtype"]) && isset($_POST["tickettype"])) {
        $id = htmlspecialchars($_POST["id"], ENT_QUOTES);
        //$eventtype = htmlspecialchars($_POST["eventtype"], ENT_QUOTES);
        $eventtype = "";
        if ($_POST["eventtype"] == "1") {
            $eventtype = "「夢の中庭: イマジネーションの旅」";
        } elseif ($_POST["eventtype"] == "2") {
            $eventtype = "「色彩の奇跡: 光と影のダンス」";
        } elseif ($_POST["eventtype"] == "3") {
            $eventtype = "「交差する世界: 文化と遺産の対話」";
        } elseif ($_POST["eventtype"] == "4") {
            $eventtype = "「人間の軌跡: 歴史と未来の交差点」";
        } elseif ($_POST["eventtype"] == "5") {
            $eventtype = "「自然の詩: 森と水の物語」";
        }
        
        //$tickettype = htmlspecialchars($_POST["tickettype"], ENT_QUOTES);
        $tickettype = "";
        
        if ($_POST["tickettype"] == "1") {
            $tickettype = "一般（65歳未満）";
        } elseif ($_POST["tickettype"] == "2") {
            $tickettype = "学生(小学生以上)";
        } elseif ($_POST["tickettype"] == "3") {
            $tickettype = "VIP";
        }elseif ($_POST["tickettype"] == "4") {
            $tickettype = "その他";
        }
        
        echo "ID: $id<br>";
        echo "展示種類: $eventtype<br>";
        echo "チケット種類: $tickettype<br>";
} else {
    echo "フォームからデータが送信されていません。";
}
    ?>
</body>
</html>
