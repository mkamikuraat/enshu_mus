<!-- <?php
session_start();

# データベースに接続
$dsn = 'mysql:host=localhost; dbname=mus; charset=utf8';
$user = 'testuser';
$pass = 'testpass';

// データベース接続情報
// $dsn = 'mysql:host=localhost;dbname=mus;charset=utf8';
// $db_user = 'username';
// $db_pass = 'password';

// データベースに接続
try {
    $dbh = new PDO($dsn, $user, $pass);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "エラー発生：" . $e->getMessage();
    die(); // エラーが発生した場合は処理を中止
}

// ログイン処理
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // 入力されたユーザー名に対応するパスワードをデータベースから取得
    $stmt = $dbh->prepare("SELECT username, password FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user["password"])) {
        // 認証成功：セッションにユーザーIDを保存
        $_SESSION["username"] = $user["username"];
        header("Location: loguin_mypage.php"); // マイページへリダイレクト
        exit;
    } else {
        $error = "ユーザー名またはパスワードが正しくありません。";
    }
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログイン</title>
</head>
<body>
    <h2>ログインフォーム</h2>
    <?php if (isset($error)) : ?>
        <p><?php echo $error; ?></p>
    <?php endif; ?>
    <form action="loguin_mypage.php" method="post">
        <label for="username">ユーザー名:</label>
        <input type="text" id="username" name="username" required>
        <br>
        <label for="password">パスワード:</label>
        <input type="password" id="password" name="password" required>
        <br>
        <button type="submit">ログイン</button>
    </form>
</body>
</html> -->
