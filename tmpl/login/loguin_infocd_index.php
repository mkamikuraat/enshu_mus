<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style type="text/css">
    body { font-size:100%; background:#f0f0f0; }
 
  
  </style>
  <title>Document</title>
    
</head>
<body>
    
    <?php
# データベースに接続
$dsn = 'mysql:host=localhost; dbname=mus; charset=utf8';
$user = 'testuser';
$pass = 'testpass';

try {
    $dbn = new PDO ($dsn,$user, $pass);
    $dbn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $sql = 'select * from users';//SQL文の準備
    $stmt = $dbn -> query($sql);//SQLの実行して結果を問い合わせる
    $r = $stmt -> fetchAll(PDO::FETCH_ASSOC);//SQL文の結果を配列として取り出す
    
    
        
        if ($row['flag'] == 1) {
            continue; // この行をスキップして次のループに進む
        }
        echo '<tr>' . PHP_EOL;
        echo '<td>' . htmlspecialchars($row['id'], ENT_QUOTES)  . '</td>' . PHP_EOL;
        echo '<td>' . htmlspecialchars($row['username'], ENT_QUOTES) . '</td>' . PHP_EOL;
        $gender = '';
        if ($row['gender'] == "1") {
            $gender = "男性";
        } else if ($row['gender'] == "2") {
            $gender = "女性";
        } else if ($row['gender'] == "3") {
            $gender = "無選択";
        } else {
            $gender = "不明";
        }
        echo '<td>' . $gender . '</td>' . PHP_EOL;
        echo '<td>' . PHP_EOL;
        //echo '<a href = "loguin_detail.php?id=' . htmlspecialchars($row["id"],ENT_QUOTES) . '">詳細</a>' . PHP_EOL;
        echo '<a href = "loguin_edit.php?id=' . htmlspecialchars($row["id"],ENT_QUOTES) . '">編集</a>' . PHP_EOL;
        //echo '|<a href = "loguin_delete.php?id=' . htmlspecialchars($row["id"],ENT_QUOTES) . '">削除</a>' . PHP_EOL;
        echo '</td>' . PHP_EOL;
        echo '</tr>' . PHP_EOL; 

        echo '</table>' . PHP_EOL;
        //print_r($result);
        $dbn = null;
        //echo '<a href="loguin_index.php">新規会員登録ページに戻る</a>';
} catch (PDOException $e){
    echo "エラー発生：" . htmlspecialchars($e ->getMessage(), ENT_QUOTES) . '<br>';
    exit;
}
?>
</body>
</html>

