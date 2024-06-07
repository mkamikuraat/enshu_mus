<?php
#-----------------------------------------------------------
    # 基本設定  プログラム全体で使用する変数を初期化している。
    #-----------------------------------------------------------
 
    # 掲示板からの戻り先
    $homepage = "mus.php";
 
    # データファイルのパス
    $bbs_data = "./data/data.csv";
 
    # 記事番号を管理するファイルのパス
    //$num_data = "./data/num.dat";
 
    # テンプレートファイルのディレクトリ
    $tmpl_dir = "./tmpl";
 
    # 日本標準時(JST) に設定
    date_default_timezone_set('Asia/Tokyo');

    #-----------------------------------------------------------
    # メインの処理
    #-----------------------------------------------------------
    $in = ["mode" => "post"];//
    parse_form();//投稿されたデータの下処理
    post_data();
    if ($in["mode"] == "post") { post_data(); }//$in["mode"]の値が"post"の場合、post_data関数は投稿情報を保存。
    if ($in["mode"] == "delete") { delete(); }
    // bbs_data(); //if文にすることで、26行目がマッチしなかったときに、27行目に。
 
       #-----------------------------------------------------------
    # フォーム受け取り
    #-----------------------------------------------------------
    function parse_form(){
        global $in;
 
        $param = array();
        if (isset($_GET) && is_array($_GET)) { $param += $_GET; }
        if (isset($_POST) && is_array($_POST)) { $param += $_POST; }
 
        foreach ( $param as $key => $val) {
            # 2 次元配列ではないことを確認
            if(!is_array($val)){
                # 文字コードの処理
                $enc = mb_detect_encoding($val);
                $val = mb_convert_encoding($val,"UTF-8",$enc);
 
                # 特殊文字の処理
                $val = htmlentities($val,ENT_QUOTES, "UTF-8");
 
                # CSV ファイル保存のためにコンマを変換
                $val = str_replace(",", ",", $val);
 
                # 改行コードの変換
                $val = str_replace("\r\n", "_kaigyou_", $val);
                $val = str_replace("\r", "_kaigyou_", $val);
                $val = str_replace("\n", "_kaigyou_", $val);
 
                $in[$key] = $val;
            }
        }
        return $in;
    }
 
#-----------------------------------------------------------
# 記事書き込み
#-----------------------------------------------------------
function post_data(){
    
    global $in, $bbs_data, $num_data;
 
    # 時間取得
    $mytime = time();
 
    # IP アドレス取得
    $myip = getenv("REMOTE_ADDR");
 
    # エラーチェック
    $error_notes="";
    if($in["username"] === ""){
        $error_notes.="・ユーザー名が未入力です。<br>";
    }
    if($in["mail"] === ""){
        $error_notes.="・メールアドレスが未入力です。<br>";
    }
    if($in["password"] === ""){
        $error_notes.="・パスワードが未入力です。<br>";
    }
    if($in["name"] === ""){
        $error_notes.="・名前が未入力です。<br>";
    }
    if($in["dob"] === ""){
        $error_notes.="・生年月日が未入力です。<br>";
    }
 
    # エラーが存在する場合
    if($error_notes !== "") {
        error($error_notes);
    }
 
    
 
   
    
    // dbの接続
    $dsn = "mysql:host=localhost;dbname=mus;charaset=utf8";
    $user = "testuser";
    $pass = "testpass";
    // sql
    try{
        $dbh = new PDO($dsn,$user,$pass);
        $sql = <<<sql
        insert into user (userid,username,mail,password,name,gender,dob,address) values(?,?,?,?,?,?,?,?);
    sql;
        // バインドして実行
        $stmt = $dbh -> prepare($sql);//SQLの結果を保留
        $stmt -> bindParam(1,$in["userid"]);//プレイスホルダー(値が未確定だったところに値に紐づける)
        $stmt -> bindParam(2,$in["username"]);
        $stmt -> bindParam(3,$in["mail"]);
        $stmt -> bindParam(4,$in["password"]);
        $stmt -> bindParam(5,$in["name"]);
        $stmt -> bindParam(6,$in["gender"]);
        $stmt -> bindParam(7,$in["dob"]);
        $stmt -> bindParam(8,$in["address"]);

        $stmt -> execute(); //保留していたSQLを実行


        // $stmt = $dbh -> query($sql);

    }catch(PDOException $e){
        echo "接続失敗・・・";
        echo "エラー内容:".$e -> getMessage();
    }
    
}
#-----------------------------------------------------------
# 掲示板トップの表示
#-----------------------------------------------------------
function bbs_data(){
    global $homepage, $bbs_data, $tmpl_dir;
    global $in;

    # 記事テンプレート読み込み
    $conf = fopen("$tmpl_dir/data.tmpl", "r") or die;
    $size = filesize("$tmpl_dir/data.tmpl");
    $tmpl = fread($conf, $size);
    fclose($conf);
 
    # データ読み込み
    # DBに接続
    $dsn = "mysql:host=localhost;dbname=mus;charaset=utf8";
    $user = "testuser";
    $pass = "testpass";


    try{
        $dbh = new PDO($dsn,$user,$pass);
        if(isset($in["sort"])&&$in["sort"] === "desc"){
            $sql = <<<sql
            select * from users where flag=1 order by hiduke desc;
    sql;
        }else{
            $sql = <<<sql
            select * from users where flag=1 order by hiduke asc;
        sql; 
        }
            
         
        $stmt = $dbh -> query($sql);

    }catch(PDOException $e){
        echo "接続失敗・・・";
        echo "エラー内容:".$e -> getMessage();
    }
    $data_newpost = "";
    # sql文でDBからデータを取ってくる
    while($line = $stmt -> fetch()){
        $tmpl_replaced = $tmpl;
        $tmpl_replaced = str_replace("!userid!",$line["userid"] , $tmpl_replaced);
        $tmpl_replaced = str_replace("!username!",$line["username"] , $tmpl_replaced);
        $tmpl_replaced = str_replace("!mail!", $line["mail"], $tmpl_replaced);
        $tmpl_replaced = str_replace("!password!", $line["password"], $tmpl_replaced);
        $tmpl_replaced = str_replace("!name!", $line["name"], $tmpl_replaced);
        $tmpl_replaced = str_replace("!gender!", $line["gender"], $tmpl_replaced);
        $tmpl_replaced = str_replace("!dob!", $line["dob"], $tmpl_replaced);
        $tmpl_replaced = str_replace("!address!", $line["address"], $tmpl_replaced);
        $tmpl_replaced = str_replace("!flag!", $line["flag"], $tmpl_replaced);
        $data_newpost .=$tmpl_replaced;

    }


    $conf = fopen("$tmpl_dir/bbs.tmpl","r") or die;
    $size = filesize("$tmpl_dir/bbs.tmpl");
    $tmpl = fread($conf , $size);
    fclose($conf);
 
    # 文字変換
    $tmpl = str_replace("!homepage!", $homepage,$tmpl);
    $tmpl = str_replace("!bbs_data!", $data_newpost, $tmpl);
 
    # 掲示板表示
    echo $tmpl;
    exit;
}
 
#-----------------------------------------------------------
# エラー画面
#-----------------------------------------------------------
function error($err){
    global $tmpl_dir;
 
    # テンプレート読み込み
    $conf = fopen("$tmpl_dir/error.tmpl", "r") or die;
    $size = filesize("$tmpl_dir/error.tmpl");
    $tmpl = fread($conf, $size);
    fclose($conf);
 
    # 文字置き換え
    $tmpl = str_replace("!message!", $err, $tmpl);
    # 表示
    echo $tmpl;
    exit;
} 

//削除という名の更新変更///////////////////////////////////////////
function delete(){
    global $in;
   # データ読み込み
    # DBに接続
    $dsn = "mysql:host=localhost;dbname=mus;charaset=utf8";
    $user = "testuser";
    $pass = "testpass";

    try{
        $dbh = new PDO($dsn,$user,$pass);
        $sql = <<<sql
        update users set flag=0 where userid=?;
    sql;
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(1, $in["userid"]);
        $stmt->execute();
    
    }catch(PDOException $e){
        echo "接続失敗・・・";
        echo "エラー内容:".$e -> getMessage();
    }
}


 
?>