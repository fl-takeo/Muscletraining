<?php
    if(!isset($_SESSION)) {
        session_start();
        if (!empty($_SESSION['user_id'])) {
            $user_id = $_SESSION['user_id'];
        }    
    }

    if(empty($_SESSION['login'])) {
        echo "このページにアクセスするには<a href='login.php'>ログイン</a>が必要です。";
        exit;
    }