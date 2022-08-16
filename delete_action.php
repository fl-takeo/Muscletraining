<?php
    require_once __DIR__ . '/inc/Connect.php';
    $connect = new Connect;

    try {    
        $id = (int)$_GET['id'];
        $connect->deleteManagementmenu($id);

        echo header('Location:finish_update.php');    //メニュー更新完了画面にリダイレクト
        exit;
    } catch (PDOException $e) {
        echo "エラー:" . $e->getMessage() . "<br>";     //エラー内容を表示（本番は表示させないようにする）
        exit;
    }