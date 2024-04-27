<?php 
session_start();

include "funcs.php";
 sschk();

?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css\user.css">
    <title>ユーザー登録</title>
</head>

<body>
   
    <form method="POST" action="user_insert.php">
        <div class="form-inner">
            <h2>ユーザ登録</h2>
<div>
    <div class="underline">
<input type="text" name="name" placeholder="名前">
 </div>
 </div>
 <div class="underline">
 <input type="email"  name="email" placeholder="email">

 </div>
 <div class="half">
 <div class="underline">
<input type="text" name="lid" placeholder="Login ID">

 </div>
 </div>
 <div class="half">
 <div class="underline">
 <input type="password" name="lpw" placeholder="Login PW">
 
 </div>
 <h2>管理FLG：</h2>
 <div class="flg">
 <label> 管理者</label><input type="radio" name="kanri_flg" value="1" id="kanri_flg">
 
 <label>一般</label><input type="radio" name="kanri_flg" value="0"><br>
 </div>
<input type="submit" value="送信" name="submitButton">

    </form>
    </div>
    <div class="back"><a href="login.php">ログインページに行く</a></div>
    
</body>
