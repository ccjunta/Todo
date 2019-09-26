<?php

header("Content-type: application/json; charset=utf-8");

// Todo.phpを読み込む
require_once('Models/Todo.php');

// ユーザーが入力したタスクを変数に格納
$task = $_POST['task'];

// セッション開始
session_start();

// ログイン情報取得
$user = $_SESSION['user'];
$userId = $user['id'];

// Todoクラスのインスタンスを作成し、
// 変数todoにいれる
$todo = new Todo();

// Todoクラスのcreateメソッドを実行
$lastId = $todo->createWithUsername($task, $userId);

// 取得した最新のIDをもとに、タスクを取得
$newtask = $todo->get($lastId);

echo json_encode($newtask);
exit();
// 一覧画面に戻る
// header('Location: index.php');
