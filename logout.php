<?php
// 必ずsession_startは最初に記述
session_start();

//SESSIOnを初期化
$_SESSION=array();

// cookieに保存してある"SESSION"の保存期間を過去にして破棄
// session_name()はセッションid名を返す関数
if(isset($_COOKIE[session_name()])){
    setcookie(session_name(), '', time()-42000, '/');

}
// サーバー側でのsession idの破棄
session_destroy();

// 処理後、login へ
header("Location:login.php");
exit();
?>
