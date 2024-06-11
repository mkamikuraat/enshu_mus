<?php


#===========================================================
#  設定完了
#===========================================================

$name = $_POST["name"];
$email = $_POST["mail"];
//$comment = $_POST["comment"];

#無効化（特殊文字のセキュリティ）
$name  = htmlentities($name,ENT_QUOTES, "UTF-8");
$email = htmlentities($email,ENT_QUOTES, "UTF-8");
//$comment = htmlentities($comment,ENT_QUOTES, "UTF-8");

# 改行処理
$name = str_replace("\r\n", "", $name);
$email = str_replace("\r\n", "", $email);
$comment = str_replace("\r\n", "\t", $comment);
$comment = str_replace("\r", "\t", $comment);
$comment = str_replace("\n", "\t", $comment);

#入力チェック
if ($name == '') { error('名前が未入力です'); }
if(!preg_match("/\w+@\w+/",$email)){error ('メールアドレスが不正です');}
if ($comment == '') { error('コメントが未入力です'); }

#確認画面
conf_form();

function conf_form(){
  global $name;
  global $email;
  global $comment;

  #テンプレート読み込み
  $conf = fopen("tmpl/template.tmpl","r") or die;
  $size = filesize("tmpl/template.tmpl");
  $data = fread($conf , $size);
  fclose($conf);

  # 文字置き換え
  $data = str_replace("!name!", $name, $data);
  $data = str_replace("!mail!", $email, $data);
  //$data = str_replace("!comment!", $comment, $data);

   # 表示
   echo $data;
   exit;
}

#-----------------------------------------------------------
#  エラー画面
#-----------------------------------------------------------
function error($msg){
  $error = fopen("tmpl/error.tmpl","r");
  $size = filesize("tmpl/error.tmpl");
  $data =  fread($error , $size);
  fclose($error);

  #文字置き換え
  $data = str_replace("!message!", $msg, $data);

  #表示
  echo $data;
  exit;
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h1>新規会員登録</h1>
    <form action="../mus.php"method="post" enctype="multipart/form-data">
      <input type="hidden" name="mode" value="post">
      <table>
        <tr>
          <!-- <p>!username!</p> -->
        </tr>
        <tr>
          <p>!mail!</p>
        </tr>
        <tr>
          <!-- <p>!password!</p> -->
        </tr>
      </table>
      <table>
        <tr>
          <p>!name!</p>
        </tr>
      </table>
      <!-- <table>
        if ($_POST["gender"] == "1")
        <input type="radio" name="gender" value="1">男性
        <input type="radio" name="gender" value="2">女性
        <input type="radio" name="gender" value="3">無選択
      </table>
      <table>
        <label for="dob">生年月日:</label>
        <input type="date" id="dob" name="dob">
      </table>
      <table>
        住所:
        <select name="address" id="address">
          <option hidden>選択してください</option>
          <option value="1">都内</option>
          <option value="2">都外</option>
          <option value="3">その他</option>
        </select>
      </table>
      <table>
        <input type="checkbox" id="terms" name="terms" required>
      <label for="terms">利用規約とプライバシーポリシーに同意する</label>
      </table> -->
      <td><input type="submit" name="send" value=" 登録"></td>
      <td><input type="hidden" name="mode" value="register"></td>
    </form>
    
</body>
</html>
