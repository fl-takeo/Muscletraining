<!--追加した部分-->
<?php
session_start();
$_SESSION = array();
header("Location: login.php");