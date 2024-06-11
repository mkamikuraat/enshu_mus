<?php
// echo "登録完了。";
$input = $_POST;
// var_dump($input);
$mode = $input["mode"];
$username = $input["username"];
//echo $username;
$mail = $input["mail"];
//echo $mail;
$password = $input["password"];
//echo $password;
$name = $input["name"];
//echo $name;

$gender = $input["gender"];
$seibetsu = "";
if ($gender == "1"){
    $seibetsu ="男性";
}else if ($gender == "2"){
    $seibetsu = "女性";
}else{
    $seibetsu = "無選択";
}
$dob = $input["dob"];
//echo $dob;
$address = $input["address"];
$add = "";
if($address == "1"){
    $add = "都内";
}else if ($address == "2"){
    $add = "都外";
}else{
    $add = "その他";
}
$terms = $input["terms"];
$on = "";
if($terms == "on"){
    $on = "同意しました";
}
$send = $input["send"];

$post =<<<_POST_
array(11) { 
["mode"]=> string(8) "register"
["username"]=> string(3) "asd" 
["mail"]=> string(3) "aaa" 
["password"]=> string(3) "asd" 
["confirm_password"]=> string(3) "asd" 
["name"]=> string(3) "asd" 
["gender"]=> string(1) "3" 
["dob"]=> string(10) "2024-06-09" 
["address"]=> string(1) "1" 
["terms"]=> string(2) "on" 
["send"]=> string(7) " 登録" } 
_POST_;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>確認画面</h1>
    <table>
        <tr>
            <td>ユーザー名:</td>
            <td><?php echo $username;?></td>
        </tr>
    </table>
    <table>
        <tr>
            <td>メールアドレス:</td>
            <td><?php echo $mail ?></td>
        </tr>
    </table>
    <table>
        <tr>
            <td>パスワード:</td>
            <td><?php echo $password ?></td>
        </tr>
    </table>
    <table>
        <tr>
            <td>名前:</td>
            <td><?php echo $name ?></td>
        </tr>
    </table>
    <table>
        <tr>
            <td>性別:</td>
            <td><?php echo $seibetsu ?></td>
        </tr>
    </table>
    <table>
        <tr>
            <td>生年月日:</td>
            <td><?php echo $dob ?></td>
        </tr>
    </table>
    <table>
        <tr>
            <td>住所:</td>
            <td><?php echo $add ?></td>
        </tr>
    </table>
    <table>
        <tr>
            <td>利用規約:</td>
            <td><?php echo $on ?></td>
        </tr>
    </table>
    <input type="button" value="前に戻る">
    <input type="button" value="登録完了">
</body>
</html>