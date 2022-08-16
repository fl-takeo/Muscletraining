<!--ホーム画面-->
<?php require_once __DIR__ . '/inc/login_check.php'; ?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <title>筋トレアプリ</title>
</head>
<body>
    <header>
        <h1><i class="fa fa-home"></i>ホーム</h1>
    </header>
    <ul>
        <li><a href="decide_menu.php">筋トレを行う</a></li>     <!--筋トレを行う画面に移行-->
        <li><a href="management.php">メニュー管理</a></li>     <!--メニュー管理画面に移行-->
    </ul>
    <p>
        <input type="button" value="ログアウトする" onclick="location.href='logout.php'">    <!--logout.phpに移行-->
    </p>
    <?php include __DIR__ . '/inc/footer.php'; ?>
</body>
</html>