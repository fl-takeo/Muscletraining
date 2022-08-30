<!--メニュー削除画面-->
<?php
    require_once __DIR__ . '/inc/login_check.php';
    require_once __DIR__ . '/inc/Connect.php';

    $connect = new Connect;
    
    $id = (int)$_GET['id'];
    $stmt = $connect->findManagementmenuById($id);

    $result = $stmt->fetch(PDO::FETCH_ASSOC);     //key値をフィールド名で取得する
    $menu = $result['menu'];
    $unit = $result['unit'];
    
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>筋トレアプリ</title>
</head>
<body>
    <header>
        <h1>～筋トレメニュー削除～</h1>
    </header>
    <p>
        <?php echo $menu . $unit ?>
    </p>
    <h2>↑本当に削除しますか？</h2>
    <p>
        <a href="delete_action.php?id=<?php  echo $id ?>">はい</a>     <!--削除するプログラム(delete.php作成予定)を起動-->
        <a href="management.php">いいえ</a>     <!--メニュー管理画面に移行-->
    </p>
    <?php include __DIR__ . '/inc/footer.php'; ?>
</body>
</html>