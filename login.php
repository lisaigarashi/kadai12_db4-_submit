<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css\login.css">
    <title>ログイン</title>
</head>
<body>
    
        <main>
            <div class="login">
            <h1>Login</h1>
                
        <form name="form1" action="login_act.php" method="POST">
           <input type="text" name="lid" placeholder="ID"><br>
           
           <input type="password" name="lpw" placeholder="PW">
           
            <button type="submit" value="login" class="btn btn-primary btn-block btn-large">
                Login</button>
            <div id="new"> <a href="user.php">新規登録はこちらから</a></div>
        </form>
        </div>
        </div>
        </main>
        
       
</body>
</html>