<!--筋トレ中画面-->
<?php
    session_start();

    require_once __DIR__ . '/inc/login_check.php';
    require_once __DIR__ . '/inc/Connect.php';

    $connect = new Connect;
    $flg = 0;
    
    if (!empty($_POST['menu'])) {
        $_SESSION['menu'] = $_POST['menu'];
    } else if (!empty($_GET['comp'])) {
        $comp = $_GET['comp'] - 1;
        $array = $_SESSION['menu'];
        unset($array[$comp]);     //配列を削除する
        $array = array_values($array);     //配列を組みなおす（詰める）
        if (!empty($array)) {
            $_SESSION['menu'] = $array;
        } else {     //筋トレ完了画面にリダイレクト
            $flg = 2;
            header('Location:./finish_do.php');
            exit;
        }
    } else {
        $flg = 1;
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
        <h1>～本日のメニュー～</h1>
    </header>
    <?php
        if ($flg == 0) {
            $a = 1;
            foreach ($_SESSION['menu'] as $key => $value) {
                echo $value;
                echo "<a href='doing.php?comp=$a'>完了</a><br>";
                $a = $a + 1;
            }
        } else if ($flg == 1) {
            echo "筋トレメニューを選択してください<br/>\n";
            echo "<a href=decide_menu.php>前の画面に戻る</a>";
        }
        
    ?>
    <?php include __DIR__ . '/inc/footer.php'; ?>
</body>
</html>