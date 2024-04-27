<?php
//PHP:コード記述/修正の流れ
//1. insert.phpの処理をマルっとコピー。
var_dump($_POST);

$id=$_POST["id"];
$name = $_POST["name"];
$type = $_POST["type"];
$text = $_POST["text"];


//   POSTデータ受信 → DB接続 → SQL実行 → 前ページへ戻る
//2. $id = POST["id"]を追加
include("funcs.php");
// 外部のファイルを読み込み関数を動かす
$pdo = db_conn();


//３．データ登録SQL作成
$sql = "UPDATE worried_table SET name=:name,type=:type,text=:text WHERE id=:id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':name', $name, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':type', $type, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':text', $text, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':id', $id, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();      //true or faluseが入る


// //４．データ登録処理後
if ($status == false) {
//SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
sql_error($stmt);
} else {
//５．index.phpへリダイレクト
redirect("select.php");
}


?>

