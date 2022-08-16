<!--筋トレメニューなし画面-->
<?php require_once __DIR__ . '/inc/login_check.php'; ?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>筋トレアプリ</title>
</head>
<body>
    <header>
        <h1>筋トレメニューが１つもありません！ </h1>
    </header>
    <p>
        <a href="management.php">筋トレメニューを作成しよう！</a>
    </p>
    <?php include __DIR__ . '/inc/footer.php'; ?>
</body>
</html>