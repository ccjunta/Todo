<?php

// セッションの開始
session_start();

// ログインしているかチェック
if (!isset($_SESSION['user'])) {
    // ログインしていない場合
    // 登録画面に遷移
    header('Location: signup.html');
}

// ログイン情報の取得
$user = $_SESSION['user'];
$userId = $user['id'];

// Todoクラスの読み込み
require_once('Models/Todo.php');

// Todoクラスをインスタンス化
$todo = new Todo();

// findByUsernameメソッド使って、タスクをすべて取得
$tasks = $todo->findByUsername($userId);

//var_dump($user);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TODO APP</title>
    <link rel="stylesheet" href="assets/css/reset.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <header class="px-5 bg-primary">
        <nav class="navbar navbar-dark">
            <a href="index.php" class="navbar-brand">TODO APP</a>
            <div class="justify-content-end">
                <span class="text-light">
                    <?php echo $user['username']; ?>
                </span>
                <a class="btn btn-success" href="logout.php">ログアウト</a>
            </div>
        </nav>
    </header>
    <main class="container py-5">

        <section>
            <form class="form-row" action="create.php" method="POST">
                <div class="col-12 col-md-9 py-2">
                    <input id="input-task" type="text" name="task" class="form-control" placeholder="ADD TODO">
                </div>
                <div class="py-2 col-md-3 col-12">
                    <button id="add-button" type="submit" class="col-12 btn btn-primary btn-block">ADD</button>
                </div>
            </form>
        </section>

        <section class="mt-5">
            <table class="table table-hover">
                <thead>
                    <tr class="bg-primary text-light">
                        <th class=>TODO</th>
                        <th>DUE DATE</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>

                    <?php foreach($tasks as $task): ?>
                        <tr id="task-<?php echo $task['id']; ?>">
                            <td><?php echo $task['name']; ?></td>
                            <td><?php echo $task['due_date']; ?></td>
                            <td>
                                <a class="text-success" href="edit.php?id=<?php echo $task['id']; ?>">EDIT</a>
                            </td>
                            <td>
                                <a class="text-danger delete-button" data-id="<?php echo $task['id']; ?>" href="delete.php?id=<?php echo $task['id']; ?>">DELETE</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>

                </tbody>
            </table>
        </section>
    </main>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="assets/js/app.js"></script>
</body>
</html>