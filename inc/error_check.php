<!--バリデーションチェック-->
<?php
if (empty($_POST['menu'])) {
    echo "メニュー欄を入力してください";
    exit;
}
if (empty($_POST['value'])) {
    echo "単位欄を入力してください";
    exit;
}
if (!preg_match('/^[0-9]+$/', $_POST['value'])) {
    echo "単位には数値のみ入力できます";
    exit;
}