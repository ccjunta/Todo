<?php

require_once('config/dbconnect.php');

// Todoを操作するクラス（もの）
// - 追加する機能
// - 検索する機能
// - 編集する機能
// - 削除する機能

class Todo
{
  // プロパティ
  // - テーブル名
  // - DbManagerインスタンスを持つ変数

  // テーブル名
  private $table = 'tasks';

  // DbManagerクラスのインスタンス
  private $db_manager;

  // コンストラクタ：生まれた瞬間に実行
  function __construct()
    {
        // db_managerプロパティは、
        // DbManagerクラスのインスタンス
        $this->db_manager = new DbManager();

        // データベースに接続
        $this->db_manager->connect();
    }

  public function create($task)
  {
    // INSERT分の準備
    $stmt = $this->db_manager->dbh->prepare('INSERT INTO ' . $this->table . '(name) VALUES (?)');
    // 準備したものを実行
    $stmt->execute([$task]);

    // 今作成したタスクのIDを返す
    return $this->db_manager->dbh->lastInsertId();
  }

  // タスクをすべて取得する
  public function getAll()
  {
    // SELECT文の準備
    $stmt = $this->db_manager->dbh->prepare('SELECT * FROM ' . $this->table);

    // 準備したSQLを実行
    $stmt->execute();

    // 実行した結果を取得
    $tasks = $stmt->fetchAll();

    // 取得した結果を返す
    return $tasks;
  }

  // 削除するメソッド
  public function delete($id)
  {
    // 該当IDを削除するSQLの準備
    $stmt = $this->db_manager->dbh->prepare('DELETE FROM ' . $this->table . ' WHERE id = ?');

    // SQL実行
    $stmt->execute([$id]);
  }

  // IDをもとにタスクを1件だけ取得するメソッド
  public function get($id)
  {
    // SQL準備
    $stmt = $this->db_manager->dbh->prepare('SELECT * FROM ' . $this->table . ' WHERE id = ?');
    // 実行
    $stmt->execute([$id]);
    $task = $stmt->fetch();

    // 取得したタスクを返す
    return $task;
  }

  // 更新するメソッド
  public function update($id, $name)
  {
    // SQL準備
    $stmt = $this->db_manager->dbh->prepare('UPDATE ' . $this->table . ' SET name = ? WHERE id = ?');
    
    // 実行
    $stmt->execute([$name, $id]);
  }

  // ユーザーIDとタスク名から新規タスクを作成する
  public function createWithUsername($task, $username)
  {
    // INSERT分の準備
    $stmt = $this->db_manager->dbh->prepare('INSERT INTO ' . $this->table . '(user_id, name) VALUES (?, ?)');
    // 準備したものを実行
    $stmt->execute([$username, $task]);

    // 今作成したタスクのIDを返す
    return $this->db_manager->dbh->lastInsertId();
  }

  // ユーザーIDが一致するタスクをすべて取得する
  public function findByUsername($username)
  {
    // SELECT文の準備
    $stmt = $this->db_manager->dbh->prepare('SELECT * FROM ' . $this->table . ' WHERE user_id = ?');

    // 準備したSQLを実行
    $stmt->execute([$username]);

    // 実行した結果を取得
    $tasks = $stmt->fetchAll();

    // 取得した結果を返す
    return $tasks;
  }
}
