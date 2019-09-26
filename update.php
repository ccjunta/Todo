<?php

// Todo.phpの読み込み
require_once('Models/Todo.php');

// POST送信された情報を取得
$task = $_POST['task'];
$id = $_POST['id'];

// echo $task;
// echo $id;

// インスタンス化
$todo = new Todo();

// updateメソッドの実行
$todo->update($id, $task);

// 一覧に戻る
header('Location: index.php');