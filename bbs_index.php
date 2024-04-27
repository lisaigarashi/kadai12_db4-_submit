<?php
date_default_timezone_set("Asia/Tokyo");
// 変数の初期化
$current_date=null;
$message=array();
$message_array=array();
$success_message=null;
$error_message=array();
$escaped=array();
$pdo=null;
$stmt=null;
$res=null;

// データベース接続
include("funcs.php");
$pdo = db_conn();

// 送信し受け取ったデータは$_POSTの中に自動的に入る
// 投稿データがあるときだけログを表示する
if(!empty( $_POST["submitButton"])){

    // 表示名の入力チェック
    if(empty($_POST["username"])){
        $error_message[]="お名前を入力してください";
    }else{
        $escaped["username"]=htmlspecialchars($_POST["username"],ENT_QUOTES,"UTF-8");
    }

    // コメントのチェック
    if(empty($_POST["comment"])){
        $error_message[]="コメントを入力してください。";
    }else{
        // コメントを正しく入力されていれば$escapedの["comment"]に入れる
        $escaped["comment"]=htmlspecialchars($_POST["comment"],ENT_QUOTES,"UTF-8");
    }
    // エラーメッセージが何もない時だけデータを保存できる
    if(empty($error_message)){
        // var_dump($_POST);
        

    
        // ここからDB追加の時に追加
        $current_date=date("Y-m-d H:i:s");

        // とランズアクション開始
        $pdo->beginTransaction();
    
    try{
        // SQL作成
    $stmt = $pdo->prepare("INSERT INTO bbs_table (username,comment, postDate) VALUES ( :username, :comment, :current_date)");
    // 値をセット
    $stmt->bindParam(':username', $escaped["username"],PDO::PARAM_STR);
    $stmt->bindParam(':comment', $escaped["comment"],PDO::PARAM_STR);
    $stmt->bindParam(':current_date', $current_date,PDO::PARAM_STR);
    // SQLクエリの実行
    $res=$stmt->execute();

    // ここまでエラーなくできたらコミット
    $res=$pdo->commit();
        
    }catch(PDOException $e){
        // エラーが発生したときはロールバック（処理取り消し）
        $pdo->rollBack();
    
    }
    if($res){
        $success_message="コメントを書き込みました";
    }else{
        $error_message[]="書き込みに失敗しました";
    }
    $stmt=null;
    }

}

// dbからコメントデータを取得する
$sql="SELECT * FROM bbs_table ORDER BY postDate ASC";
$message_array=$pdo->query($sql);

// dbの接続を閉じる
$pdo=null;

 ?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css\bss_stlye.css">
    <title>悩みぼやき掲示板</title>
</head>
<body>
<a class="navbar-brand" href="select.php">前のページに戻る</a>
    <h1 class="title">インド人悩みボヤキ掲示板</h1>
    <hr>
    <div class="boardWrapper">
        <!-- メッセージ送信成功時 -->
        <?php if(!empty($success_message)):?>
            <p class="success_message"><?php echo $success_message?></p>
            <?php endif;?>
            <!--バリデーションチェック時 -->
            <?php if(!empty($error_message)):?>
                <?php foreach($error_message as $value):?>
                    <div class="error_message!">※<?php echo $value?></div>
                    <?php endforeach?>
                    <?php endif?>
        <section>
            <?php if (!empty($message_array)):?>
            <?php foreach($message_array as $value):?>
    <article>
        <div class="wrapper">
        <div class="nameArea">
         <p><?php echo $value["id"]?>:</p> 
        <span>名前:</span>
        <p class="username"><?php echo $value["username"]?></p><br>
        <time><?php echo date('Y/m/d H:i',strtotime( $value["postDate"]));?></time>
       </div><?php echo $value["comment"]?></p>
        </div>
    </article>
    <?php endforeach;?>
    <?php endif;?>
    </section>
   
        <form class="formWrapper" method="POST">
            <div>
                <input type="submit" value="書き込む" name="submitButton">
                <label for="">名前:</label>
                <input type="text" name="username" >
            </div>
            <div >
                <textarea class="commentTextArea" name="comment"></textarea>
            </div>
        </form>
    </div>
</body>
</html>