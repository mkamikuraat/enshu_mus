<?php
session_start();

// データベースに接続
$dsn = 'mysql:host=localhost;dbname=mus;charset=utf8';
$user = 'testuser'; 
$pass = 'testpass';

try {
    $dbh = new PDO($dsn, $user, $pass);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "データベース接続エラー：" . $e->getMessage();
    die();
}

// フォームが送信された場合の処理
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // ユーザー名とパスワードの取得
    $entered_username = $_POST["username"];
    $entered_password = $_POST["password"];

    // データベースからユーザー情報を取得
    $stmt = $dbh->prepare("SELECT * FROM users WHERE username = ?");
    
    $stmt->execute([$entered_username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    $stmt2 = $dbh->prepare("SELECT * FROM ticket WHERE username = ?");
    $stmt2->execute([$entered_username]);
    $user2 = $stmt2->fetch(PDO::FETCH_ASSOC);
    
    
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style type="text/css">
        .form1 {color: rgba(230, 89, 34, 0.795);}
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
        .form{
            border: #000 solid 1px;
            padding: 4px;
        }
    </style>
    <title>マイページ</title>
</head>
<body>
<header class="header">
        <h1 id="title"> <a href="../HP/base.tmpl">神倉美術館</a></h1>
        <nav class="nav">
            <ul>
                <li><a href="../HP/event/index.php">展覧会・イベント</a></li>
                <li><a href="../HP/ticket_hp.tmpl">チケット予約</a></li>
                <li><a href="../HP/access_hp.tmpl">アクセス</a></li>
                <li><a href="loguin_hp.php">ログイン画面</a></li>
                <li><a href="../HP/fqa_hp.tmpl">お問い合わせ</a></li>
            </ul>
        </nav>
        <a href="../admin/admin_hp.php"></a>
    </header>
    <main>
        <?php
        
            if($user["password"] == $entered_password && $user['is_admin']==1){
                header("Location: ../admin/admin_hp.php");
            }
            else if ($user["password"] == $entered_password) {
                // 認証成功：セッションにユーザー名を保存
                $_SESSION["username"] = $user["username"];
                //echo "ログイン成功。";
                echo "<h2>" . "ようこそ！ " . $user["username"] . "さん" . "</h2>";
                // ログイン成功後の処理を記述（例：別のページにリダイレクトなど）
            } 
            else {
                // 認証失敗：エラーメッセージを表示するなど適切な処理を行う
                echo "ユーザー名またはパスワードが正しくありません。";
                //header("Location: loguin_hp.php");
                exit();
                
            }
        ?>

        <h2>チケット購入</h2>
        <p>チケットの購入の際は、<a class="form1" href="../admin/admin_ticket/admin_ticket.html">チケットの購入画面</a>へお進みください。</p>
        <h2>チケット予約確認</h2>
        <?php
        
        if($user2 == true){
            
        // if ($user["username"] == $user2["username"] && $user["password"] == $user2["password"]){
            $eventtype = '';
            if ($user2['eventtype'] == "1") {
                $eventtype = "「夢の中庭: イマジネーションの旅」";
            } else if ($user2['eventtype'] == "2") {
                $eventtype = "「色彩の奇跡: 光と影のダンス」";
            } else if ($user2['eventtype'] == "3") {
                $eventtype = "「交差する世界: 文化と遺産の対話」";
            } else if ($user2['eventtype'] == "4") {
                $eventtype = "「人間の軌跡: 歴史と未来の交差点」";
            } else if ($user2['eventtype'] == "5") {
                $eventtype = "「自然の詩: 森と水の物語」";
            } else {
                $eventtype = "不明";
            }
            echo '展示種類：' . $eventtype . "<br>";
            echo "来場日：" . htmlspecialchars($user2["dob_c"],ENT_QUOTES) . '<br>' . PHP_EOL;
            $time = '';
            if ($user2['time'] == "1") {
                $time = "09:00";
            } else if ($user2['time'] == "2") {
                $time = "10:00";
            } else if ($user2['time'] == "3") {
                $time = "11:00";
            } else if ($user2['time'] == "4") {
                $time = "12:00";
            } else if ($user2['time'] == "5") {
                $time = "13:00";
            } else if ($user2['time'] == "6") {
                $time = "14:00";
            } else if ($user2['time'] == "7") {
                $time = "15:00";
            } else if ($user2['time'] == "8") {
                $time = "16:00";
            } else {
                $time = "不明";
            }
            echo '<td>入場時間：' . $time . '</td>' . PHP_EOL;
            echo '<br>';
            $tickettype = '';
            if ($user2['tickettype'] == "1") {
                $tickettype = "一般（65歳未満）";
            } else if ($user2['tickettype'] == "2") {
                $tickettype = "学生(小学生以上)";
            } else if ($user2['tickettype'] == "3") {
                $tickettype = "VIP";
            } else if ($user2['tickettype'] == "4") {
                $tickettype = "その他";
            } else {
                $tickettype = "不明";
            }
            echo '<td>チケット種類：' . $tickettype . "<br>";
            echo "名前:" . $user2["name"];
            echo "<br>";
            echo '<a  class="form" href = "../admin/admin_ticket/book_edit.php?id=' . htmlspecialchars($user2["id"],ENT_QUOTES) . '" method="post">編集</a>';  
            echo '<input class="form" type="hidden" name="username" value="$user["username"]">';
            echo '<input class="form" type="hidden" name="password" value="$user["password"]">';
            //echo '<a  class="form" href = "../admin/admin_ticket/book_delete.php?id=' . htmlspecialchars($user2["id"],ENT_QUOTES) . '">キャンセル</a>'; 
        } else{
            echo "現在予約しておりません";
        }
        
        ?>
        
        <h2>登録情報の変更</h2>
        <?php echo "ユーザー名:" . $user["username"] . "<br>";
        echo "メールアドレス:" . $user["mail"] . "<br>";
        echo "パスワード:" . $user["password"] . "<br>";
        echo "名前:" . $user["name"] . "<br>";
        $gender = '';
        if ($user['gender'] == "1") {
            $gender = "男性";
        } else if ($user['gender'] == "2") {
            $gender = "女性";
        } else if ($user['gender'] == "3") {
            $gender = "無選択";
        } else {
            $gender = "不明";
        }
        echo '性別:' . $gender . "<br>";
        
        echo "生年月日:" . $user["dob"] . "<br>";
        $address = '';
        if ($user['address'] == "1") {
            $address = "都内";
        } else if ($user['address'] == "2") {
            $address = "都外";
        } else if ($user['address'] == "3") {
            $address = "その他";
        } else {
            $address = "不明";
        }
        echo '住所:' . $address . "<br>";
        //echo ":" . $user["address"] . "<br>";
        
        echo '<a  class="form" href = "loguin_infocd_edit.php?id=' . htmlspecialchars($user["id"],ENT_QUOTES) . '">編集</a>';
        '<br>';
        
        
        ?>
        <!-- <form action="loguin_infocd_index.php" method="get">
            <button type="submit">登録情報の変更</button>
        </form> -->
    <h2></h2>
        <form action="../login/loguin_logout.html" method="get">
            <button type="submit">ログアウト</button>
        </form>
    </main>
 
<footer>
  <div class="gotop">
      <a href="#top"><img src="../../img/top.png" alt="ページトップへ戻る"></a>
  </div>
  <div>
      <p class="copyright">&copy; KAMIKURA MUSEUM</p>
  </div>
</footer>
</body>
</html>