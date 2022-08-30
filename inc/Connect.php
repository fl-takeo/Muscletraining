<?php
//クラス化 
class Connect {
    //クラス定数の宣言
    const DB_NAME = 'muscletraining_db';
    const HOST = 'localhost';
    const UTF = 'utf8';
    const USER = 'phpuser';
    const PASS = '7gCjddxEkaN]B5aM';

    private $dbh;

    //コンストラクタ（DB接続）
    public function __construct() {
        $user = self::USER;
        $pass = self::PASS;
        $opt = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_EMULATE_PREPARES => false,
            PDO::MYSQL_ATTR_MULTI_STATEMENTS => false,
        ];
        $dbh = new PDO('mysql:host=localhost;dbname=muscletraining_db', $user, $pass, $opt);
        $this->dbh = $dbh;
    }

    //データ取得
    public function findManagementmenuByUserid ($user_id) {
        $dbh = $this->dbh;
        $sql = "SELECT * FROM management_menu WHERE user_id = :user_id ORDER BY id ASC";
        $stmt = $dbh->prepare($sql);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt;
    }
    
    public function findManagementmenuById ($id) {
        $dbh = $this->dbh;
        $sql = "SELECT * FROM management_menu WHERE id = :id ORDER BY id ASC";
        $stmt = $dbh->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt;
    }

    public function findUsersByUsername ($username) {
        $dbh = $this->dbh;
        $sql = "SELECT password, id FROM users WHERE username = :username";
        $stmt = $dbh->prepare($sql);
        $stmt->bindParam(":username", $username, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt;
    }

    public function findUsersById ($id) {
        $dbh = $this->dbh;
        $sql = "SELECT username FROM users WHERE id = :id";
        $stmt = $dbh->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);    
        $stmt->execute();
        return $stmt;
    }

    //データ追加
    public function insertManagementmenu ($user_id, $menu, $unit) {
        $dbh = $this->dbh;
        $sql = "INSERT INTO management_menu (user_id, menu, unit) values(:user_id, :menu, :unit)";
        $stmt = $dbh->prepare($sql);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->bindParam(':menu', $menu, PDO::PARAM_STR);
        $stmt->bindParam(':unit', $unit, PDO::PARAM_STR);
        $stmt->execute();
    }

    //データ更新
    public function uppdateManagementmenu ($menu, $unit, $id) {
        $dbh = $this->dbh;
        $sql = "UPDATE management_menu SET menu = :menu, unit = :unit WHERE id = :id";
        $stmt = $dbh->prepare($sql);        
        $stmt->bindParam(':menu', $menu, PDO::PARAM_STR);
        $stmt->bindParam(':unit', $unit, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }

    //データ削除
    public function deleteManagementmenu ($id) {
        $dbh = $this->dbh;
        $sql = "DELETE FROM management_menu WHERE id = :id";
        $stmt = $dbh->prepare($sql);        
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }
}