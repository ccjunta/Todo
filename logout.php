<?php

// セッション開始
session_start();

// セッションにあるログイン情報を破棄
session_destroy();

// unset($_SESSION['user']);

header('Location: signup.html');