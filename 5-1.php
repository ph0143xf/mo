  <!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>mission_5-1</title>
    </head>
<body>
   <form action="" method="post">
        <input type="text"name="name" placeholder="名前">
        <br>
        <input type="text"name="comment"placeholder="コメント">
        <br>
        <input type="submit"name="submit"value="送信">
    </form>
   <?php 
   //データベースへの接続
$dsn ='データベース名';
$user = 'ユーザー名';
$password = 'パスワード';
$pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
// テーブル名tbtest、カラムid,name,coment
$sql = "CREATE TABLE IF NOT EXISTS tbtest"
." ("
. "id INT AUTO_INCREMENT PRIMARY KEY,"
. "name char(32),"
. "comment TEXT"
.");";
$stmt = $pdo->query($sql);
$sql = 'SELECT * FROM tbtest';
//データの入力
$name=$_POST["name"];
$comment=$_POST["comment"];
$date=date("Y年m月d日 H時i分s秒");
if(!empty($comment) && !empty($name)){ 
    //INSERT文を使ってデータ（レコード）の登録 
 $sql = $pdo -> prepare("INSERT INTO tbtest (name, comment) VALUES (:name, :comment)"); 
 $sql -> bindParam(':name', $name, PDO::PARAM_STR); 
 $sql -> bindParam(':comment', $comment, PDO::PARAM_STR); 
 $sql -> execute(); 
} 
//入力データの表示
$sql = 'SELECT * FROM tbtest';
	$stmt = $pdo->query($sql);
	$results = $stmt->fetchAll();
	foreach ($results as $row){
		//$rowの中にはテーブルのカラム名が入る
		echo $row['id'].',';
		echo $row['name'].',';
		echo $row['comment'].'<br>';
	echo "<hr>";
	}
?>
</body>
</html>
