<!--メニュー編集画面-->
<?php
    require_once __DIR__ . '/inc/login_check.php';
    require_once __DIR__ . '/inc/Connect.php';

    $connect = new Connect;

    try {
        $id = (int)$_GET['id'];
        $stmt = $connect->findManagementmenuById($id);
        
        $result = $stmt->fetch(PDO::FETCH_ASSOC);     //key値をフィールド名で取得する
        if (empty($_GET['flg'])) {
            $menu = $result['menu'];
            $unit = mb_substr($result['unit'], 0, -1, "UTF-8");      //回・秒を削除
        }
    } catch (PDOException $e) {
        echo "エラー:" . $e->getMessage() . "<br>";     //エラー内容を表示（本番は表示させないようにする）
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
        <h1>～筋トレメニュー編集～</h1>
    </header>

    <form method="post" action="update.php?id=<?php echo $id ?>&flg=1">     <!--追加を押すとupdate.phpが起動-->
        <?php 
            if(!empty($_GET['flg'])) {
                $menu = $_POST['menu'];
                $unit = mb_substr($_POST['unit'], 0, -1, "UTF-8");
            }
        ?>

        <p>
            <label for="menu">メニュー:</label>
            <input type="text" name="menu" id="menu" value="<?php echo $menu ?>">
        </p>
        <p>
            <label for="value">単位:</label>
            <input type="text" name="value" id="value" value="<?php echo $unit ?>">
            <label for="unit"></label>
            <select id="unit" name="unit">
                <option value="回">回</option>
                <option value="秒">秒</option>
            </select>
        </p>
        <p class="button">
            <input type="submit" value="更新">
        </p>      
    </form>
    <?php
        if (!empty($_GET['flg'])) {
            include __DIR__ . '/inc/error_check.php';     //入力時のエラーチェックを行う

            try {
                $menu = $_POST['menu'];
                $unit = $_POST['value'] . $_POST['unit'];
                $id = (int)$_GET['id'];
                $connect->uppdateManagementmenu($menu, $unit, $id);

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