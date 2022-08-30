<!--メニュー編集画面-->
<?php
    require_once __DIR__ . '/inc/login_check.php';
    require_once __DIR__ . '/inc/Connect.php';

    $connect = new Connect;

    $emptyerrorformenu = '';
    $emptyerrorforunit = '';
    $patternerror = '';

    //フォームに表示する値を取得する
    try {
        $id = (int)$_GET['id'];
        $stmt = $connect->findManagementmenuById($id);
        
        $result = $stmt->fetch(PDO::FETCH_ASSOC);     //key値をフィールド名で取得する
        if ($_SERVER["REQUEST_METHOD"] != "POST") {     //初期画面（更新ボタンが押されていない時）
            $menu = $result['menu'];
            $unit = mb_substr($result['unit'], 0, -1, "UTF-8");      //回・秒を削除
        }
    } catch (PDOException $e) {
        echo "エラー:" . $e->getMessage() . "<br>";     //エラー内容を表示（本番は表示させないようにする）
        exit;
    }
    
?>
<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        include __DIR__ . '/inc/error_check.php';     //入力時のエラーチェックを行う
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

    <form method="post" action="update.php?id=<?php echo $id ?>">     <!--追加を押すとupdate.phpが起動-->
        <?php 
            if($_SERVER["REQUEST_METHOD"] == "POST") {
                $menu = $_POST['menu'];
                $unit = mb_substr($_POST['unit'], 0, -1, "UTF-8");
            }
        ?>

        <p>
            <label for="menu">メニュー:</label>
            <input type="text" name="menu" id="menu" value="<?php echo $menu ?>"><br>
            <?php echo $emptyerrorformenu; ?><br>
        </p>
        <p>
            <label for="value">単位:</label>
            <input type="text" name="value" id="value" value="<?php echo $unit ?>">
            <label for="unit"></label>
            <select id="unit" name="unit">
                <option value="回">回</option>
                <option value="秒">秒</option>
            </select><br>
            <?php echo $emptyerrorforunit; ?><br>
            <?php echo $patternerror; ?>
        </p>
        <p class="button">
            <input type="submit" value="更新">
        </p>      
    </form>
    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if ($emptyerrorformenu != NULL || $emptyerrorforunit != NULL || $patternerror != NULL) {
                exit;
            }
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