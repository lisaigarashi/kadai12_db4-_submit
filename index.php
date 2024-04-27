<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css\style.css">
    <title>リクエストしたい</title>
</head>
<body id="home">
  <hedader>
  <div class="navbar-header"><a class="navbar-brand" href="select.php">悩み相談室に戻る</a></div>
  <h2>お悩み相談～インド編～</h2>
  
  </hedader>
    <main>
        お悩み登録
        <form method="POST" action="insert.php">
            
            <label class="name">名前（ニックネーム可能）:<input type="text" name="name"></label><br>
            <label class="type">悩みの種類  :</label>
            <select name="type">
                <option value="">選択してください</option>
                <option value="インド人同僚との人間関係">インド人同僚との人間関係</option>
                <option value="インド人上司との人間関係">インド人上司との人間関係</option>
                <option value="食事のこと">食事のこと</option>
                <option value="宗教のこと">宗教のこと</option>
                <option value="言語のこと">言語のこと</option>
            </select><br>
        <label class="text">悩みの記入をお願いしますします！ </label>
        <label> <textArea name="text" rows="4" cols="40"></textArea></label><br>
       <br>
     <button input type="submit">投稿</button>
                
           

        </form>
      
    </main>
    <footer></footer>
</body>
</html>