<!--メニュー追加画面-->
<?php 
    require_once __DIR__ . '/inc/login_check.php';
    require_once __DIR__ . '/inc/Connect.php';
    
    $connect = new Connect;
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>筋トレアプリ</title>
</head>
<body>
    <header>
        <h1>～筋トレメニュー追加～</h1>
    </header>
    <form method="post" action="add.php">     <!--追加を押すとadd.phpが起動-->        
        <p>
            <label for="menu">メニュー:</label>
            <input type="text" name="menu" id="menu">
        </p>
        <p>
            <label for="value">単位:</label>
            <input type="text" name="value" id="value">
            <label for="unit"></label>
            <select id="unit" name="unit">
                <option value="回">回</option>
                <option value="秒">秒</option>
            </select>
        </p>
        <p class="button">
            <input type="submit" value="追加">
        </p>
    </form>
    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            include __DIR__ . '/inc/error_check.php';     //入力時のエラーチェックを行う

            try {
                $menu = $_POST['menu'];
                $user_id = $_SESSION['user_id'];
                $unit = $_POST['value'] . $_POST['unit'];
                $connect->insertManagementmenu($user_id, $menu, $unit);

                echo header('Location:finish_update.php');    //メニュー更新完了画面にリダイレクト
                exit;
            } catch (PDOException $e) {
                echo "エラー:" . $e->getMessage() . "<br>";     //エラー内容を表示（本番は表示させないようにする）
                exit;
            }
        }
    ?>
    <?php include __DIR__ . '/inc/footer.php'; ?>
</body>
</html>