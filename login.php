<!--ログイン画面-->
<?php 
    session_start();
    
    if (!empty($_SESSION['login'])) {
        echo "ログイン済みです<br>";
        echo "<a href=home.php>ホームに戻る</a>";
        exit;
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
    <form method='post' action='login.php?comp=true'>
        <p>
            <label for="username">ユーザー名:</label>
            <input type="text" name="username" id="username">
        </p>
        <p>
            <label for="password">パスワード:</label>
            <input type="text" name="password" id="password">
        </p>
        <input type="submit" value="ログイン">
    </form>

    <?php
        require_once __DIR__ . '/inc/Connect.php';
        $connect = new Connect;

        if (!empty($_GET['comp'])) {
            if (empty($_POST['username'])) {
                echo "ユーザ名を入力してください";
                exit;
            }
            if (empty($_POST['password'])) {
                echo "パスワードを入力してください";
                exit;
            }

            try {
                $username = $_POST['username'];
                $stmt = $connect->findUsersByusername($username);

                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                if (!$result) {   //ユーザ名が間違っている場合（結果が得られない）
                    echo "ユーザー名を正しく入力してください";
                    exit;
                }
                if ($_POST['password'] === $result['password']) {
                    session_regenerate_id(true);     //旧いセッションを破棄して新しいセッションを生成
                    $_SESSION['login'] = true;     //ログイン状態にする
                    $_SESSION['user_id'] = $result['id'];
                    header("Location: home.php");
                } else {
                    echo "ユーザー名とパスワードの組み合わせが正しくありません";
                }
            } catch (PDOException $e) {
                echo "エラー!:" . $e->getMessage();
                exit;
            }
        }
    ?>
    
    </body>
</html>