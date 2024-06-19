<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>展示・イベント一覧</title>
    <style type="text/css">
        .header {padding-top: 40px; background-image: url(../../../img/stripe.png); background-repeat: repeat-x;}
        body { font-size:100%; background:#f0f0f0; }
        .detail {color: #253958;}
        #title{color:#253958; font-size: 50px; text-align: center;}
        a{text-decoration: none; color: inherit;}
        main h2{border-bottom: 2px solid #253958;}
        .nav ul {margin: 30px 0 0 0; padding: 0; list-style-type: none;
         display: flex; justify-content: center; gap: 40px;}
        .gotop {
            text-align: center; display: flex; justify-content: center;}
        .gotop a img{ width: 100px;}
        .copyright {
            padding-top: 75px;
            padding-bottom: 75px;
            background-color: #253958;
            color: #ffffff;
            text-align: center;
        }
        .div{
            border: 1px solid #000;
            margin-bottom: 40px;
            padding: 10px;
        }
        .form {color: rgba(230, 89, 34, 0.795);}
    </style>
    
</head>
<body>
<header class="header">
        <h1 id="title"> <a href="../base.tmpl">神倉美術館</a></h1>
        <nav class="nav">
            <ul>
                <li><a href="index.php">展覧会・イベント</a></li>
                <li><a href="../ticket_hp.tmpl">チケット予約</a></li>
                <li><a href="../access_hp.tmpl">アクセス</a></li>
                <li><a href="../../login/loguin_hp.php">ログイン画面</a></li>
                <li><a href="../fqa_hp.tmpl">お問い合わせ</a></li>
            </ul>
        </nav>
        
    </header>
<main>
    <h2>開催決定</h2>
    <div class="div">
        <h3>「夢の中庭: イマジネーションの旅」</h3>
        <table>
            <tr>
                <td>会期:2024年07月01日(月) ~ 2024年07月15日(土)</td>
            </tr>
            <tr>
                <td>夢の中で庭が躍る。いざ！イマジネーションの旅へ</td>
            </tr>
            <tr>
                <td><a class="form" href="../../admin/admin_ticket/admin_ticket.html">チケット予約</a></td>
            </tr>
        </table>
    </div>
    <div class="div">
        <h3>「色彩の奇跡: 光と影のダンス」</h3>
        <table>
            <tr>
                <td>会期:024年07月16日(日) ~ 2024年07月31日(水)</td>
            </tr>
            <tr>
                <td>見えることは奇跡です</td>
            </tr>
            <tr>
                <td><a class="form" href="../../admin/admin_ticket/admin_ticket.html">チケット予約</a></td>
            </tr>
        </table>
    </div>
    <div class="div">
        <h3>「交差する世界: 文化と遺産の対話」</h3>
        <table>
            <tr>
                <td>会期:024年06月16日(日) ~ 2024年08月31日(土)</td>
            </tr>
            <tr>
                <td>時代は積もっていく。だが、語られることはない。</td>
            </tr>
            <tr>
                <td><a class="form" href="../../admin/admin_ticket/admin_ticket.html">チケット予約</a></td>
            </tr>
        </table>
    </div>
    <div class="div">
        <h3>「人間の軌跡: 歴史と未来の交差点」</h3>
        <table>
            <tr>
                <td>会期:024年06月19日(水) ~ 2024年10月31日(木)</td>
            </tr>
            <tr>
                <td>人間が語る、過去と未来と現在</td>
            </tr>
            <tr>
                <td><a class="form" href="../../admin/admin_ticket/admin_ticket.html">チケット予約</a></td>
            </tr>
        </table>
    </div>
    <div class="div">
        <h3>「自然の詩: 森と水の物語」</h3>
        <table>
            <tr>
                <td>会期:024年09月01日(日) ~ 2024年12月27日(金)</td>
            </tr>
            <tr>
                <td>自然の中で詩は生まれる</td>
            </tr>
            <tr>
                <td><a class="form" href="../../admin/admin_ticket/admin_ticket.html">チケット予約</a></td>
            </tr>
        </table>
    </div>
    <h2>今後の展示・イベント一覧</h2>
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
        echo '<td>タイトル</td><td>開始日</td><td>終了日</td>' . PHP_EOL;
        echo '</tr>' . PHP_EOL;

        foreach ($result as $row) {
            
            if ($row['flag'] == 1) {
                continue; // この行をスキップして次のループに進む
            }

            echo '<tr>' . PHP_EOL;
            //echo '<td>' . htmlspecialchars($row['id'], ENT_QUOTES)  . '</td>' . PHP_EOL;
            echo '<td>' . htmlspecialchars($row['title'], ENT_QUOTES)  . '</td>' . PHP_EOL;
            echo '<td>' . htmlspecialchars($row['dob_s'], ENT_QUOTES)  . '</td>' . PHP_EOL;
            echo '<td>' . htmlspecialchars($row['dob_e'], ENT_QUOTES)  . '</td>' . PHP_EOL;
            echo '<br>';
            echo '<td>' . PHP_EOL;
            echo '<a class="detail" href = "detail.php?id=' . htmlspecialchars($row["id"],ENT_QUOTES) . '">詳細を見る</a>' . PHP_EOL;
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
</main>
<footer>
        <div class="gotop">
            <a href="#top"><img src="../../../img/top.png" alt="ページトップへ戻る"></a>
        </div>
        <div>
            <p class="copyright">&copy; KAMIKURA MUSEUM</p>
        </div>
    </footer>
</body>
</html>

