<?php
session_start();
include("funcs.php");
sschk();

// 1.POSTデータ取得




$name=filter_input(INPUT_POST,"name");
$email=filter_input(INPUT_POST,"email");
$lid=filter_input(INPUT_POST,"lid");
$lpw=filter_input(INPUT_POST,"lpw");
$kanri_flg=filter_input(INPUT_POST,"kanri_flg");
$lpw =password_hash($lpw,PASSWORD_DEFAULT);





// 2.DB接続
$pdo=db_conn();

// 3.データ登録sql作成
$sql="INSERT INTO user_table(name,email,lid,lpw,kanri_flg,life_flg)VALUES(:name,:email,:lid,:lpw,:kanri_flg,0)";
$stmt=$pdo->prepare($sql);
$stmt->bindValue(':name', $name, PDO::PARAM_STR); //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':email', $email, PDO::PARAM_STR); //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':lid', $lid, PDO::PARAM_STR); //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':lpw', $lpw, PDO::PARAM_STR); //Integer（数値の場合 PDO::PARAM_INT)::PARAM_STR); //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':kanri_flg', $kanri_flg, PDO::PARAM_INT); //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();


//４．データ登録処理後
if ($status == false) {
    sql_error($stmt);
} else {
    echo "登録が完了しました";
    redirect("login.php");
}


?>