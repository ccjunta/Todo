<?php

// Todo.phpの読み込み
require_once('Models/Todo.php');

// 削除ボタンがクリックされたTodoのIDを取得
$id = $_GET['id'];

// Todoクラスをインスタンス化
$todo = new Todo();

// 削除の実行
$todo->delete($id);

echo json_encode($id);

// 一覧の画面に戻る
// header('Location: index.php');