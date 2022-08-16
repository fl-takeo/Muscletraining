<!--footerにログイン中のユーザー名を入れる-->
<footer style="position: absolute; bottom: 0; height: 100px;">
    <?php
        $user = "phpuser";
        $password = "7gCjddxEkaN]B5aM";
        $opt = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_EMULATE_PREPARES => false,
            PDO::MYSQL_ATTR_MULTI_STATEMENTS => false,
        ];
        $dbh = new PDO('mysql:host=localhost;dbname=muscletraining_db', $user, $password, $opt);
   
        $stmt = $dbh->prepare("SELECT username FROM users WHERE id = :id ");
        $id = $_SESSION['user_id'];
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);    
        $stmt->execute();
        $loginuser = $stmt->fetch();
        
        echo $loginuser['username'] . "がログイン中です。"
    ?>
</footer>