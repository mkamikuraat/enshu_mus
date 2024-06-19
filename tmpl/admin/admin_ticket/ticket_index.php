<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>チケット予約管理一覧</title>
    <style type="text/css">
        body { font-size:100%; background:#f0f0f0; }
    </style>
</head>
<body>
    <h1>チケット予約管理一覧</h1>
    <a href="../admin_hp.php">管理者画面に戻る</a>
    <br>
    <a href="admin_ticket.html">チケット登録</a>
<?php
    # データベースに接続
    $dsn = 'mysql:host=localhost; dbname=mus; charset=utf8';
    $user = 'testuser';
    $pass = 'testpass';

try {
    $dbn = new PDO ($dsn,$user, $pass);
    $dbn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $sql = 'select * from ticket';//SQL文の準備
    $stmt = $dbn -> query($sql);//SQLの実行して結果を問い合わせる
    $result = $stmt -> fetchAll(PDO::FETCH_ASSOC);//SQL文の結果を配列として取り出す
    
    echo '<table>' . PHP_EOL;//PHP_EOLは改行コード。
    echo '<tr>' . PHP_EOL;
    
    echo '<td>ID</td><td>展示種類</td><td>チケット種類</td>' . PHP_EOL;
    echo '</tr>' . PHP_EOL;
    
    foreach ($result as $row) {
        
        if ($row['flag'] == 1) {
            continue; // この行をスキップして次のループに進む
        }
        echo '<tr>' . PHP_EOL;
        echo '<td>' . htmlspecialchars($row['id'], ENT_QUOTES)  . '</td>' . PHP_EOL;
        $eventtype = '';
        if ($row['eventtype'] == "1") {
            $eventtype = "「夢の中庭: イマジネーションの旅」";
        } else if ($row['eventtype'] == "2") {
            $eventtype = "「色彩の奇跡: 光と影のダンス」";
        } else if ($row['eventtype'] == "3") {
            $eventtype = "「交差する世界: 文化と遺産の対話」";
        } else if ($row['eventtype'] == "4") {
            $eventtype = "「人間の軌跡: 歴史と未来の交差点」";
        } else if ($row['eventtype'] == "5") {
            $eventtype = "「自然の詩: 森と水の物語」";
        } else {
            $eventtype = "不明";
        }
        echo '<td>' . $eventtype . '</td>' . PHP_EOL;
        echo '<br>';
        $tickettype = '';
        if ($row['tickettype'] == "1") {
            $tickettype = "一般（65歳未満）";
        } else if ($row['tickettype'] == "2") {
            $tickettype = "学生(小学生以上)";
        } else if ($row['tickettype'] == "3") {
            $tickettype = "VIP";
        } else if ($row['tickettype'] == "4") {
            $tickettype = "その他";
        } else {
            $tickettype = "不明";
        }
        echo '<td>' . $tickettype . '</td>' . PHP_EOL;
        echo '<br>';
        //echo '<td>' . htmlspecialchars($row['tickettype'], ENT_QUOTES) . '</td>' . PHP_EOL;
        echo '<td>' . PHP_EOL;
        echo '<a href = "ticket_detail.php?id=' . htmlspecialchars($row["id"],ENT_QUOTES) . '">詳細</a>' . PHP_EOL;
        echo '|<a href = "ticket_edit.php?id=' . htmlspecialchars($row["id"],ENT_QUOTES) . '">編集</a>' . PHP_EOL;
        echo '|<a href = "ticket_delete.php?id=' . htmlspecialchars($row["id"],ENT_QUOTES) . '">削除</a>' . PHP_EOL;
        echo '</td>' . PHP_EOL;
        echo '</tr>' . PHP_EOL; 
    }
    echo '</table>' . PHP_EOL;
    //print_r($row);
    $dbn = null;
    //echo '<a href="ticket_index.php">新規会員登録ページに戻る</a>';
} catch (PDOException $e){
    echo "エラー発生：" . htmlspecialchars($e ->getMessage(), ENT_QUOTES) . '<br>';
    exit;
}
?>
</body>
</html>

