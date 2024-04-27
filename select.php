<?php
session_start();
//2. DB接続します
include("funcs.php");


// login check
// ["chk_ssid]または["chk_ssid"]!=sessio_idが入ってない場合は
// login errorを出す
 if(!isset($_SESSION["chk_ssid"])||$_SESSION["chk_ssid"]!==session_id()){
  exit("Login Error");

}else{
  session_regenerate_id(true);
  $_SESSION["chk_ssid"]=session_id();
}



//２．データ登録SQL作成
$pdo = db_conn();
$sql = "SELECT * FROM worried_table";
$stmt = $pdo->prepare($sql);
$status = $stmt->execute();

//３．データ表示
$values = "";
if($status==false) {
  sql_error($stmt);
}


//全データ取得
$values =  $stmt->fetchAll(PDO::FETCH_ASSOC); //PDO::FETCH_ASSOC[カラム名のみで取得できるモード]
// $json = json_encode($values,JSON_UNESCAPED_UNICODE);

?>


<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<link rel="stylesheet" href="css/style.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>悩み掲示板</title>
</head>
<body id="main">
<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<div>
<h1>悩み相談室</h1>
<p>～一緒に働くインド人との関係について～</p>
    <div class="container jumbotron">
    <div class="navbar-header">
        <div id="welcome">ようこそ！<?=$_SESSION["name"]?>さん</div>
        <ul class="menu">
      <li><a href="index.php">悩みの書き込み</a></li>
      <li><a  href="bbs_index.php">悩みのはけ口</a></li>
      <li><a  href="logout.php">ログアウト</a></li>
      </ul>
      </div>
    </div>
  </nav>


<table class="table_design01">
<?php foreach($values as $value){ ?>
  <tr>
   <th>番号</th>
    <td><?= h($value["id"])?></td>
    </tr>
    <tr>
    <th>名前（ニックネーム）</th>
    <td><?= h($value["name"]) ?></td>
        </tr>
        <tr>
      <th>悩みの種類</th>
        <td><?= h($value["type"]) ?></td>
        </tr>
        <tr>
        <th>具体的な悩み</th>
        <td><?= h($value["text"] )?></td>
        </tr>
        <tr>
          <th>投稿した日</th>
          <td><?= h($value["indate"]) ?></td>
        </tr>
        <tr>
        <td><span class ="btn"><a href ="detail.php?id=<?= h($value["id"])?>">編集</a></span>
        <td><a href ="reply.php?id=<?= h($value["id"])?>">返信</a>
        <?php if($_SESSION["kanri_flg"]==1){?>
        <td><a href ="delete.php?id=<?= h($value["id"])?>" >削除</a></td>
        </tr>
        <?php }?>
      <?php } ?>
      

</table>


  </div>
</div>
<!-- Main[End] -->
<script>
  $a='<?=$json?>';
    const obj= JSON.parse($a);
    console.log(obj);

</script>
</body>
</html>