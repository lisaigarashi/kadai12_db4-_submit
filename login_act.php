<?php 
// 最初にsessionを開始！ここ大事！
session_start();

//post値
$lid = $_POST["lid"];
// id
$lpw = $_POST["lpw"];
// パスワード

// 1.DB接続
include("funcs.php");
$pdo=db_conn();

// 2.データ登録sql作成
// Passwordのhash化、条件lidのみ
$stmt=$pdo->prepare("SELECT * FROM user_table WHERE lid=:lid AND life_flg=0");
$stmt->bindValue(':lid',$lid, PDO::PARAM_STR);
$status = $stmt->execute();

// 3.Sql実行時にエラーがある場合STOP
if($status==false){
    sql_error($stmt);
}

// 4.抽出データ数を取得
$val = $stmt->fetch();
//$count = $stmt->fetchColumn(); //SELECT COUNT(*)で使用可能()

// 5.該当１レコードがあればSESSIOn値を代入
// 入力したpasswordと暗号化されたpasswordを比較！[戻り値:TRUE OR false]
//  $lpw = password_hash($lpw, PASSWORD_DEFAULT);   //パスワードハッシュ化
$pw = password_verify($lpw,$val["lpw"]);
if($pw){
    // login成功時
    $_SESSION["chk_ssid"]= session_id();
    $_SESSION["kanri_flg"] = $val['kanri_flg'];
    $_SESSION["name"] = $val["name"];
    // login 成功時にselect.phpへ
    redirect("select.php");
    
}else{
// login 失敗時
redirect("login.php");
}
exit();


?>