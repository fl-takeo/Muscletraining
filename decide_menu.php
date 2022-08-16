<!--筋トレを行う画面-->
<?php require_once __DIR__ . '/inc/login_check.php'; ?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>筋トレアプリ</title>
</head>
<body>
    <header>
        <h1>～本日行うメニューを決めよう！～</h1>
    </header>
    <form method="post" action="doing.php">     <!--筋トレを行う画面に遷移-->
        <p class="button">
            <input type="submit" value="決定">
        </p>
        <p>
            <?php
                require_once __DIR__ . '/inc/Connect.php';
                $connect = new Connect;

                try {
                    $user_id = $_SESSION['user_id'];
                    $stmt = $connect->findManagementmenuByUserid($user_id);

                    while ($row = $stmt->fetch()) {
                        echo "<input type='checkbox' name='menu[]' value='$row[menu] $row[unit]'>";
                        echo $row['menu'] . "\t" . $row['unit'] . "<br>";
                        $flg = true;
                    }

                    if ($flg == false) {
                        header('Location:./exception.php');     //筋トレメニューなし画面に遷移
                    }

                } catch (PDOException $e) {
                    echo "エラー:" . $e->getMessage() . "<br>";     //エラー内容を表示（本番は表示させないようにする）
                    exit;
                }
            ?>
        </p>
    </form>
    <?php include __DIR__ . '/inc/footer.php'; ?>
</body>
</html>