<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>展示・イベント管理一覧</title>
    <style type="text/css">
        body { font-size:100%; background:#f0f0f0; }
    </style>
</head>
<body>
    <h1>展示・イベント管理一覧</h1>
    <a href="../admin_hp.php">管理者画面に戻る</a>
    <br>
    <a href="event_form.html">展示・イベント情報の新規登録</a>
<?php
    # データベースに接続
    $dsn = 'mysql:host=localhost; dbname=mus; charset=utf8';
    $user = 'testuser';
    $pass = 'testpass';

try {
    $dbn = new PDO ($dsn,$user, $pass);
    $dbn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $sql = 'select * from event';//SQL文の準備
    $stmt = $dbn -> query($sql);//SQLの実行して結果を問い合わせる
    $result = $stmt -> fetchAll(PDO::FETCH_ASSOC);//SQL文の結果を配列として取り出す
    
    echo '<table>' . PHP_EOL;//PHP_EOLは改行コード。
    echo '<tr>' . PHP_EOL;
    echo '<td>ID</td><td>タイトル</td><td>開始日</td><td>終了日</td><td>展示場所</td>' . PHP_EOL;
    echo '</tr>' . PHP_EOL;

    foreach ($result as $row) {
        
        if ($row['flag'] == 1) {
            continue; // この行をスキップして次のループに進む
        }

        echo '<tr>' . PHP_EOL;
        echo '<td>' . htmlspecialchars($row['id'], ENT_QUOTES)  . '</td>' . PHP_EOL;
        echo '<td>' . htmlspecialchars($row['title'], ENT_QUOTES)  . '</td>' . PHP_EOL;
        echo '<td>' . htmlspecialchars($row['dob_s'], ENT_QUOTES)  . '</td>' . PHP_EOL;
        echo '<td>' . htmlspecialchars($row['dob_e'], ENT_QUOTES)  . '</td>' . PHP_EOL;
        $space = '';
        if ($row['space'] == "1") {
            $space = "展示室１";
        } else if ($row['space'] == "2") {
            $space = "展示室２";
        } else if ($row['space'] == "3") {
            $space = "展示室３";
        } else {
            $space = "不明";
        }
        echo '<td>' . $space . '</td>' . PHP_EOL;
        echo '<br>';
        echo '<td>' . PHP_EOL;
        echo '<a href = "event_detail.php?id=' . htmlspecialchars($row["id"],ENT_QUOTES) . '">詳細</a>' . PHP_EOL;
        echo '|<a href = "event_edit.php?id=' . htmlspecialchars($row["id"],ENT_QUOTES) . '">編集</a>' . PHP_EOL;
        echo '|<a href = "event_delete.php?id=' . htmlspecialchars($row["id"],ENT_QUOTES) . '">削除</a>' . PHP_EOL;
        echo '</td>' . PHP_EOL;
        echo '</tr>' . PHP_EOL; 
    }
    echo '</table>' . PHP_EOL;
    $dbn = null;
    
} catch (PDOException $e){
    echo "エラー発生：" . htmlspecialchars($e ->getMessage(), ENT_QUOTES) . '<br>';
    exit;
}
?>
</body>
</html>

