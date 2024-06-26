<?php

session_start();

// セッションに管理者の情報がない場合はログインページにリダイレクト
if (!isset($_SESSION["username"])) {
    header("Location: ../login/loguin_hp.php");
    exit;
}

// セッションに保存されているユーザーの権限を確認
// ここではダミーデータとして管理者として処理しますが、実際はデータベースからユーザー情報を取得する必要があります
$role = "admin";
if ($role === "admin") {
 ?>
    <!DOCTYPE html>
    <html lang="ja">
    <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <style type="text/css">
      body { background:#f0f0f0; }
      table{ border-collapse:collapse; margin:10px 0; border-right:1px solid #000; border-bottom:1px solid #000;}
      th,td{ border-left:1px solid #000; border-top:1px solid #000;padding:5px;}
      th{background-color: #000;}
    </style>
    <title>homepage</title>
    </head>
    <body>
      <div class="container">
        <h1>管理者画面</h1>
      </div>
      <table>
        <tr>
          <td>展示内容管理</td>
          <td>
            <form action="./admin_event/event_index.php" method="get">
            <button type="submit">編集</button>
            </form>
          </td>
        </tr>
      </table>
      <table>
        <tr>
          <td>チケット管理</td>
          <td>
            <form action="./admin_ticket/ticket_index.php" method="get">
            <button type="submit">編集</button>
            </form>
          </td>
        </tr>
      </table>
      <table>
        <tr>
          <td>ユーザー管理</td>
          <td>
            <form action="../login/loguin_index.php" method="get">
            <button type="submit">編集</button>
            </form>
          </td>
        </tr>
      </table>
    <!-- ログアウトリンクを設置 -->
    <form action="../login/loguin_logout.html" method="post">
        <input type="submit" name="logout" value="ログアウト">
    </form>
    </body>
    </html>
<?php
} else {
    // それ以外の権限の場合は別のページにリダイレクトするなどの処理を追加する
    header("Location: ../login/loguin_hp.php");
    exit;
}
?>
