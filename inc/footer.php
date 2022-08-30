<!--footerにログイン中のユーザー名を入れる-->
<footer style="position: absolute; bottom: 0; height: 100px;">
    <?php
        $id = $_SESSION['user_id'];
        $stmt = $connect->findUsersById($id);

        $loginuser = $stmt->fetch();
        
        echo $loginuser['username'] . "がログイン中です。";
    ?>
</footer>