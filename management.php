<!--メニュー管理画面-->
<?php require_once __DIR__ . '/inc/login_check.php'; ?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>筋トレアプリ</title>
</head>
<body>
    <header>
        <h1>～筋トレメニュー管理～</h1>
    </header>
    <ul>
        <li><a href="home.php">ホームへ</a></li>     <!--筋トレを行う画面に移行-->
        <li><a href="add.php">追加</a></li>     <!--メニュー管理画面に移行-->
    </ul>

    <?php
        require_once __DIR__ . '/inc/Connect.php';
        $connect = new Connect;

        try {
            $stmt = $connect->findManagementmenuByUserid($user_id);
    ?>
            <table>
                <tr><th>メニュー名</th><th>単位</th><th>編集</th><th>削除</th></tr>
                <?php while ($row = $stmt->fetch()): ?>
                <tr>
                    <td><?php echo ($row['menu']) ?></td>
                    <td><?php echo ($row['unit']) ?></td>
                    <td><a href="update.php?id=<?php echo $row['id']; ?>">編集</a></td>     <!--パラメータを付与-->
                    <td><a href="delete.php?id=<?php echo $row['id']; ?>">削除</a></td>    <!--パラメータを付与-->
                </tr>
                <?php endwhile; ?>
            </table>
    <?php
        } catch (PDOException $e) {
            echo "エラー:" . $e->getMessage() . "<br>";     //エラー内容を表示（本番は表示させないようにする）
            exit;
        }
    ?>

    <?php include __DIR__ . '/inc/footer.php'; ?>
</body>
</html>