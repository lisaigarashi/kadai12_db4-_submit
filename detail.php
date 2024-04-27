<?php
$id=$_GET["id"];
// var_dump($id );
// exit;
include("funcs.php");
$pdo = db_conn();


//２．データ登録SQL作成
$sql = "SELECT * FROM worried_table WHERE id=:id";
 $stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id,PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();
// var_dump($status );
// exit;



//３．データ表示
$values = "";
if($status==false) {
    sql_error($stmt);
}else{
$v =  $stmt->fetch(); //PDO::FETCH_ASSOC[カラム名のみで取得できるモード]

}

//1レコードだけ取得



// var_dump($v);
// exit;
// $json = json_encode($values,JSON_UNESCAPED_UNICODE);

?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css\detail.css">
    <title>悩みの編集</title>
</head>
<body id="home">
  <hedader>
  <h1>悩みの編集</h1>
  <div class="navbar-header"><a class="navbar-brand" href="select.php">前ページに戻る</a></div>
  </hedader>
    <main>
        
        <form method="POST" action="update.php">            
            <label class="name">名前（ニックネーム可能）:</label><input type="text" name="name" value="<?=$v["name"]?>"><br>
            <label class="neme">悩みの種類  :</label>
                <select name="type">
                <option value="">選択してください</option>
                <option value="インド人同僚との人間関係"<?= $v["type"] == "インド人同僚との人間関係" ? "selected" : "" ?>>インド人同僚との人間関係</option>
                <option value="インド人上司との人間関係"<?= $v["type"] == "インド人上司との人間関係" ? "selected" : "" ?>>インド人上司との人間関係</option>
                <option value="食事のこと"<?= $v["type"] == "食事のこと" ? "selected" : "" ?>>食事のこと</option>
                <option value="宗教のこと"<?= $v["type"] == "宗教のこと" ? "selected" : "" ?>>宗教のこと</option>
                <option value="言語のこと"<?= $v["type"] == "言語のこと" ? "selected" : "" ?>>言語のこと</option>
            </select><br>
   
        <label class="worried">悩みの記入をお願いしますします！</label>
            <textArea name="text" rows="4" cols="40"><?=$v["text"]?></textArea></label><br>
            <input type="hidden" name="id" value="<?=$v["id"]?>">
        <br>
     <button input type="submit">更新</button>
                
           

        </form>
      
    </main>
    <footer></footer>
</body>
</html>