<?php

require_once('config/dbconnect.php');

class User {
  
  private $db_manager;

  public function __construct()
  {
    // db_managerプロパティは、
      // DbManagerクラスのインスタンス
      $this->db_manager = new DbManager();

      // データベースに接続
      $this->db_manager->connect();
  }

  // ユーザーを新規作成するメソッド
  public function create($username, $password)
  {
    // SQLを準備
    $stmt = $this->db_manager->dbh->prepare('INSERT INTO users(username, password, created_at) VALUES (?,?,now())');
    // 実行
    $stmt->execute([$username, $password]);
  }

  // ユーザー名をもとにユーザーを取得する
  public function findByUsername($username)
  {
    // SQL準備
    $stmt = $this->db_manager->dbh->prepare('SELECT * FROM `users` WHERE username = ?');
    // 実行
    $stmt->execute([$username]);
    // 結果の取得
    $user = $stmt->fetch();
    // 返却
    return $user;
  }
}