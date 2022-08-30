<!--ログイン画面-->
<?php 
    session_start();
    
    if (!empty($_SESSION['login'])) {
        echo "ログイン済みです<br>";
        echo "<a href=home.php>ホームに戻る</a>";
        exit;
    }
?>

<?php
    require_once __DIR__ . '/inc/Connect.php';

    $connect = new Connect;
    $emptyerrorforusername = '';
    $emptyerrorforpassword = '';
    $errormessage = '';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST['username']) || empty($_POST['password'])) {
            if (empty($_POST['username'])) {
                $emptyerrorforusername = "ユーザ名を入力してください";
            }
            if (empty($_POST['password'])) {
                $emptyerrorforpassword = "パスワードを入力してください";
            }
        } else {
            try {
                $username = $_POST['username'];
                $stmt = $connect->findUsersByUsername($username);

                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                if (!$result) {   //ユーザ名が間違っている場合（結果が得られない）
                    $errormessage = "ユーザー名とパスワードの組み合わせが正しくありません";
                }
                if ($_POST['password'] === $result['password']) {
                    session_regenerate_id(true);     //旧いセッションを破棄して新しいセッションを生成
                    $_SESSION['login'] = true;     //ログイン状態にする
                    $_SESSION['user_id'] = $result['id'];
                    header("Location: home.php");
                } else {
                    $errormessage = "ユーザー名とパスワードの組み合わせが正しくありません";
                }
            } catch (PDOException $e) {
                echo "エラー!:" . $e->getMessage();
                exit;
            }
        }   
    }
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>筋トレアプリ</title>
</head>
<body>
    <header>
        <h1>ログインしてください</h1>
    </header>
    <form method='post' action='login.php'>
        <p><?php echo $errormessage; ?></p>
        <p>
            <label for="username">ユーザー名:</label>
            <input type="text" name="username" id="username"><br>
            <?php echo $emptyerrorforusername; ?><br>
        </p>
        <p>
            <label for="password">パスワード:</label>
            <input type="text" name="password" id="password"><br>
            <?php echo $emptyerrorforpassword; ?><br>
        </p>
        <input type="submit" value="ログイン">
    </form>  
    </body>
</html>