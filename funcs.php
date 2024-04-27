<?php
function h($str)
{
    // hの関数は「表示する場所を置き換える]
    return htmlspecialchars($str, ENT_QUOTES);
}

//DB接続関数：db_conn()
function db_conn(){
    try {
        // localhostの接続は以下
    //     $db_name = "/アカウント名
    //      $db_pw   = "";          //パスワード：XAMPPはパスワード無し or MAMPはパスワード”root”に修正してください。
    //       $db_host = ""; //DBホスト

        //   さくらサーバーは以下
          $db_name = "";   //データベース名
          $db_id   = "";      //アカウント名
         $db_pw   = "";          //パスワード：XAMPPはパスワード無し or MAMPはパスワード”root”に修正してください。
        $db_host = ""; //DBホスト
         $pdo = new PDO('mysql:dbname=' . $db_name . ';charset=utf8;host=' . $db_host, $db_id, $db_pw);
        // 関数化した場合に変数に入った情報をkeepして別ページで使用することはできないので、
        // returnで変数に戻すように指示する
        return new PDO('mysql:dbname=' . $db_name . ';charset=utf8;host=' . $db_host, $db_id, $db_pw);
    } catch (PDOException $e) {
        exit('DB Connection Error:' . $e->getMessage());
    }
}


//SQLエラー関数：sql_error($stmt)
function sql_error($stmt){
    $error = $stmt->errorInfo();
    exit("SQLError:".$error[2]);
    }


//リダイレクト関数: redirect($file_name)
// $file_nameはredirect("index.php");の"index.php"が入る
//リダイレクト
function redirect($file_name){
    header("Location: ".$file_name);
    exit();
}

//SessionCheck(スケルトン)
function sschk(){
}
?>