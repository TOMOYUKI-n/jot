## 開発方法

### ローカルにクローンする
```
$ git clone git@github.com:TOMOYUKI-n/jot.git

// サーバー起動
$ php artisan serve

// 別でターミナルを立ち上げてフロントのwatch
$ npm run watch

```

## テストをする
### エイリアスを登録
```
$ alias pu='clear && vendor/bin/phpunit'
$ alias pf='clear && vendor/bin/phpunit --filter '
$ source ~/.bash_profile
```

### 全てのテスト実行
```
$ pu
もしくは
$ pf [テストのクラス名]

// ex
$ pf ContactsTest
```

### 任意のテスト実行
```
$ pf [テストのメソッド名]

// ex
$ pf an_authenticated_user_can_add_a_contact
```

### DBを用意
```
$ mysql -u root -p
```
