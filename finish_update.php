<!--メニュー更新完了画面-->
<?php require_once __DIR__ . '/inc/login_check.php'; ?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>筋トレアプリ</title>
</head>
<body>
    <header>
        <h1>～筋トレメニューの更新が完了しました！～</h1>
    </header>
    <ul>
        <li><a href="management.php">筋トレメニュー管理画面へ</a></li>     <!--筋トレメニュー管理画面へに移行-->
        <li><a href="home.php">ホームへ</a></li>     <!--筋トレを行う画面に移行-->
    </ul>
    <?php include __DIR__ . '/inc/footer.php'; ?>
</body>
</html>