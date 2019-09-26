## TODOアプリ

### 機能
- taskの追加
- taskの一覧表示
- taskの更新
- taskの削除

### 画面
- task一覧画面
- task編集画面


### 準備
#### DB作成
- MySQLで任意の名前のDBを作成します。
  - サンプルでは `php_oop` となってます。

#### テーブル作成
作成したDBにテーブルを作成します。
`database/php_oop_sql` ファイルをphpMyAdminなどのツールでインポートするか、
ファイルに記述されてる内容をコピーしてSQLを実行してください。

#### DB設定
- 自身の環境に合わせて `config/dbconnect.php` の以下の内容を修正します。
  ※基本的にはデフォルトの設定で問題ありません。

```
$user = 'root';
$password='';
```

#### 動作確認
PHP_OOPにアクセスしてtaskの一覧画面が表示されることを確認します。