<!--バリデーションチェック-->
<?php
if (empty($_POST['menu'])) {
    $emptyerrorformenu = "メニュー欄を入力してください";
}
if (empty($_POST['value'])) {
    $emptyerrorforunit = "単位欄を入力してください";
} else if (!preg_match('/^[0-9]+$/', $_POST['value'])) {
    $patternerror = "単位には数値のみ入力できます";
}